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

$firstName     = trim($_POST["firstName"] ?? "");
$lastName      = trim($_POST["lastName"] ?? "");
$fullName      = trim($_POST["fullName"] ?? "");
$rollNo        = trim($_POST["rollNo"] ?? "");
$branch        = trim($_POST["branch"] ?? "");
$completedYear = trim($_POST["completedYear"] ?? "");
$phone         = trim($_POST["phone"] ?? "");
$location      = trim($_POST["location"] ?? "");
 
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "success" => false,
        "message" => "Invalid Request"
    ]);
    exit;
}

// fetch the resume
// $originalName =  $_FILES['resume']["name"];
// $originalName = str_replace(" ", "_", $originalName);
// $time = time();
// // $fileName = time() . "_" . basename($_FILES["resume"]["name"]);
// // $fileName = $time . "_" . $originalName;
// $fileName = time() . "_" . uniqid() . "_" . $originalName;
// $uploadDir = "../uploads/resumes/";
// $filePath = $uploadDir . $fileName;

// move_uploaded_file($_FILES["resume"]["tmp_name"],$filePath);

$resumePath = null;
if(isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0){
    $originalName = $_FILES["resume"]["name"];

    // Replace spaces with _
    $originalName = str_replace(" ", "_", $originalName);

    // Create unique filename
    $fileName = time() . "_" . uniqid() . "_" . $originalName;

    $uploadDir = "../uploads/resumes/";

    // Physical path on server
    $filePath = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $filePath)) {
        $resumePath = "uploads/resumes/" . $fileName;
    }else {

        echo json_encode([
            "success" => false,
            "message" => "Resume upload failed."
        ]);

        exit;
    }
}

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

    $resumePath,

    // $socials,

    // $academics,

    // $skills,

    // $projects

);
echo json_encode($result);
exit;

?>