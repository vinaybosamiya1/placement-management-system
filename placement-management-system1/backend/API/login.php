<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require "../config/database.php";
require "../models/User_register_login.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data,true);

if(!$data){

echo json_encode([
    "status"=>false,
    "message"=>"Email Or Password Invalid!, Pleasae Enter Correct Info!"
]);
exit;
}

$email = trim($data["email"]);
$password = trim($data["password"]);

if(empty($email) || empty($password)){
    echo json_encode([
        "status"=>false,
        "message"=>"All Fields Required",
    ]);
    exit;
}

$db = new Database();
$conn = $db->connect();

$user_login = New User($conn);
$res = $user_login->login($email,$password);

echo json_encode($res);

?>