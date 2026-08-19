<?php

session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require "../config/database.php";

// -------------------------------------------------------------------
// 1. Must be logged in (session must exist from Google registration)
// -------------------------------------------------------------------
if (empty($_SESSION['user_id'])) {
    echo json_encode(["status" => false, "message" => "Session expired. Please register again."]);
    exit;
}

// -------------------------------------------------------------------
// 2. Read the new password from request body
// -------------------------------------------------------------------
$json_data = file_get_contents("php://input");
$data      = json_decode($json_data, true);

$new_password     = trim($data['password']         ?? '');
$confirm_password = trim($data['confirm_password'] ?? '');

if (empty($new_password)) {
    echo json_encode(["status" => false, "message" => "Password cannot be empty."]);
    exit;
}

if (strlen($new_password) < 6) {
    echo json_encode(["status" => false, "message" => "Password must be at least 6 characters."]);
    exit;
}

if ($new_password !== $confirm_password) {
    echo json_encode(["status" => false, "message" => "Passwords do not match."]);
    exit;
}

// -------------------------------------------------------------------
// 3. Hash and update the password in the database
// -------------------------------------------------------------------
$db   = new Database();
$conn = $db->connect();

$hashed = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "UPDATE users SET password = :password WHERE id = :id"
);
$stmt->execute([
    ':password' => $hashed,
    ':id'       => $_SESSION['user_id'],
]);

if ($stmt->rowCount() > 0) {
    echo json_encode([
        "status"  => true,
        "message" => "Password set successfully! You can now login with email and password."
    ]);
} else {
    echo json_encode([
        "status"  => false,
        "message" => "Could not update password. Please try again."
    ]);
}

?>
