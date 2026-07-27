<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

require "../../config/database.php";

try {

    // $conn = new Pdo("mysql:host=localhost;dbname=placement_db", "root", "");
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db = new Database();
    $conn = $db->connect();
    

    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            "success" => false,
            "message" => "User not logged in"
        ]);
        exit;
    }

    $stmt = $conn->prepare("SELECT
id,
first_name,
last_name,
full_name,
email,
phone_number,
roll_no,
Branch,
current_location,
completed_year,
resume_path
FROM users_persontal_details
WHERE id=?");
    $stmt->execute([$_SESSION['user_id']]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "user" => $user
    ]);

}catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);

}


?>