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
u.id,
u.first_name,
u.last_name,
u.full_name,
u.email,
u.phone_number,
COALESCE(sp.roll_no, u.roll_no) AS roll_no,
COALESCE(sp.Branch, u.Branch) AS Branch,
COALESCE(sp.current_location, u.current_location) AS current_location,
COALESCE(sp.completed_year, u.completed_year) AS completed_year,
COALESCE(sp.resume_path, u.resume_path) AS resume_path,
sp.cgpa,
sp.backlogs,
sp.twelfth_percentage,
sp.tenth_percentage,
sp.linkedin_url,
sp.github_url,
sp.skills,
sp.projects
FROM users u
LEFT JOIN student_profiles sp ON u.id = sp.user_id
WHERE u.id=?");
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