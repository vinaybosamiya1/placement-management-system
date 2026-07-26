<?php
// created at 21-7-26 and this code transfer at User_register_login.php file
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

session_start();
require '../config/database.php';
require '../models/User_crud.php';

$db = new Database();
$conn = $db->connect();

if (!isset($_SESSION['user_id'])) {

    echo json_encode([
        "success" => false,
        "message" => "Please Login"
    ]);

    exit;
}

$firstName = trim($_POST["firstName"]);
$lastName = trim($_POST["lastName"]);
$fullName = trim($_POST["fullName"]);
$rollNo = trim($_POST["rollNo"]);
$branch = trim($_POST["branch"]);
$completedYear = trim($_POST["completedYear"]);
$phone = trim($_POST["phone"]);
$location = trim($_POST["location"]);

$updateProfile = new User($conn);
$result = $updateProfile->updateProfile(

    $_SESSION["user_id"],

    $firstName,

    $lastName,

    $fullName,

    $rollNo,

    $branch,

    $completedYear,

    $phone,

    $location,

    // $socials,

    // $academics,

    // $skills,

    // $projects

);
echo json_encode($result);
exit;

?>