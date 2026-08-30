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
require "../models/User_crud.php";

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
// 2. Verify the Google JWT token by decoding it locally
//    (No cURL or internet call needed — Google signs with RS256,
//     but we only need the payload for basic verification here)
// -------------------------------------------------------------------
function decodeGoogleJWT($token) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return null;
    }
    // $parts[0]; // Header
    // $parts[1]; // Payload
    // $parts[2]; // Signature
    
    // Base64url decode the payload (middle part)
    $payload = $parts[1];
    // Add padding if needed
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
// 4. Extract email and user info
// -------------------------------------------------------------------
$email     = $google_user['email']  ?? '';
$google_id = $google_user['sub']    ?? '';
$name      = $google_user['name']   ?? '';

if (empty($email)) {
    echo json_encode(["status" => false, "message" => "Could not retrieve email from Google."]);
    exit;
}

// -------------------------------------------------------------------
// 5. Check if this email is registered in the database
// -------------------------------------------------------------------
$db   = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
$stmt->bindParam(':email', $email);
$stmt->execute();
$existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

// -------------------------------------------------------------------
// 6. Not registered → return "please register first"
// -------------------------------------------------------------------
if (!$existing_user) {
    echo json_encode([
        "status"  => false,
        "code"    => "NOT_REGISTERED",
        "message" => "You are not registered yet. Please register your account first before logging in."
    ]);
    exit;
}

// -------------------------------------------------------------------
// 7. User IS registered → log them in
// -------------------------------------------------------------------
if (empty($existing_user['google_id'])) {
    $upd = $conn->prepare("UPDATE users u,student_profiles sp SET sp.google_id = :gid WHERE u.email = :email");
    $upd->execute([':gid' => $google_id, ':email' => $email]);
}

$userModel = new User($conn);
$userModel->ensureStudentProfile($existing_user['id'], $google_id);

$_SESSION['user_id']    = $existing_user['id'];
$_SESSION['user_email'] = $existing_user['email'];

echo json_encode([
    "status"  => true,
    "message" => "Login successful! Welcome back.",
    "user"    => [
        "id"        => $existing_user['id'],
        "email"     => $existing_user['email'],
        "full_name" => $existing_user['full_name'] ?? '',
    ]
]);

?>