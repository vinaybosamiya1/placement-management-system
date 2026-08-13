<?php

session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require "../config/database.php";

// -------------------------------------------------------------------
// 1. Read the Google credential token from the frontend
// -------------------------------------------------------------------
$json_data = file_get_contents("php://input");
$data      = json_decode($json_data, true);

if (empty($data['token'])) {
    echo json_encode(["status" => false, "message" => "No token provided."]);
    exit;
}

$token = $data['token'];

// -------------------------------------------------------------------
// 2. Decode the Google JWT token locally
//    (No cURL needed — reads the payload from the JWT directly)
// -------------------------------------------------------------------
function decodeGoogleJWT($token) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return null;
    }
    $payload = $parts[1];
    $padding = 4 - (strlen($payload) % 4);
    if ($padding !== 4) {
        $payload .= str_repeat('=', $padding);
    }
    $decoded = base64_decode(strtr($payload, '-_', '+/'));
    return json_decode($decoded, true);
}

$google_user = decodeGoogleJWT($token);

if (!$google_user) {
    echo json_encode(["status" => false, "message" => "Invalid Google token format."]);
    exit;
}

// -------------------------------------------------------------------
// 3. Basic validation — check token is not expired
// -------------------------------------------------------------------
if (isset($google_user['exp']) && $google_user['exp'] < time()) {
    echo json_encode(["status" => false, "message" => "Google token has expired. Please try again."]);
    exit;
}

// -------------------------------------------------------------------
// 4. Extract user info from token payload
// -------------------------------------------------------------------
$google_id = $google_user['sub']   ?? '';
$email     = $google_user['email'] ?? '';
$name      = $google_user['name']  ?? '';

if (empty($email)) {
    echo json_encode(["status" => false, "message" => "Could not retrieve email from Google."]);
    exit;
}

// -------------------------------------------------------------------
// 5. Check if this email is ALREADY registered
// -------------------------------------------------------------------
$db   = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT id FROM users_persontal_details WHERE email = :email LIMIT 1");
$stmt->bindParam(':email', $email);
$stmt->execute();
$existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

// -------------------------------------------------------------------
// 6. Already registered → tell user to go to Login
// -------------------------------------------------------------------
if ($existing_user) {
    echo json_encode([
        "status"  => false,
        "code"    => "ALREADY_REGISTERED",
        "message" => "This Google account is already registered. Please go to Login."
    ]);
    exit;
}

// -------------------------------------------------------------------
// 7. New user → insert into database
// -------------------------------------------------------------------
try {
    $ins = $conn->prepare(
        "INSERT INTO users_persontal_details
         (full_name, email, google_id, password)
         VALUES
         (:full_name, :email, :google_id, :password)"
    );

    // Random placeholder password — this account uses Google login
    $placeholder_password = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);

    $ins->execute([
        ':full_name' => $name ?: $email,
        ':email'     => $email,
        ':google_id' => $google_id,
        ':password'  => $placeholder_password,
    ]);

    $new_user_id = $conn->lastInsertId();

    // Start session — log the user in right after registration
    $_SESSION['user_id']    = $new_user_id;
    $_SESSION['user_email'] = $email;

    echo json_encode([
        "status"  => true,
        "message" => "Registration successful! Welcome to the Placement Portal.",
        "user"    => [
            "id"        => $new_user_id,
            "email"     => $email,
            "full_name" => $name,
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(["status" => false, "message" => "Registration failed: " . $e->getMessage()]);
}

?>
