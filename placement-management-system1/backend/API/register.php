<?php
// WRITE THIS CODE AT 6-7-26
//  start login backed with php dt - 2/7/26  
// header("Content-Type: application/json");
// header("Access-Control-Allow-Origin: http://localhost:5173");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require '../config/database.php';
require '../models/User_register_login.php';
// "php://input" -> this contains json data sent by the frontend (vue.js)
// file_get_contents() this function is used to read data of the "php://input"

$json_data = file_get_contents("php://input"); //json not understoond by php so we use this "file_get_contents("php://input");" , this help to php for understood json data 
$data = json_decode($json_data,true); //this convert json to php array, The true tells PHP to convert JSON into an associative array. and without true not convert data from json to php array 

// json_encode() convert php array to json for understood for vuejs (frontend)
if(!$data){

    echo json_encode([
        "status"=>false,
        "message"=>"No Data Received"
    ]);
    exit;
}

$fullname = trim($data["full_name"]);
$email = trim($data["email"]);
$password = trim($data["password"]);

if(empty($fullname) || empty($email) || empty($password)){
    echo json_encode([
        "status"=>false,
        "message"=>"All Fields Required"
    ]);

    exit;
}

$db = new Database();
$conn = $db->connect();

$user_register = new User($conn);
$res = $user_register->register(
    $fullname,
    $email,
    $password,
);
echo json_encode($res);


// class username
// {
//     private PDO $conn;
//     public function __construct(PDO $db)
//     {
//         $this->conn = $db;
//     }

//     public function user_register(string $fullname, string $email, string $password)
//     {
//         try {
//             $fullname = trim($fullname);
//             $email = trim($email);

//             if (empty($fullname)) {
//                 return [
//                     "status" => false,
//                     "message" => "Full Name Required."
//                 ];
//             }
            
//             if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
//                 return [
//                     "status" => false,
//                     "message" => "Invalid email address."
//                 ];
//             }

//             if (strlen($password) < 6) {
//                 return [
//                     "status" => false,
//                     "message" => "Password must be at least 6 characters."
//                 ];
//             }


//             $checkQuery = "SELECT id FROM users WHERE email = :email LIMIT 1";
//             $checkstmt = $this->conn->prepare($checkQuery);
//             $checkstmt->bindValue(":email", $email, PDO::PARAM_STR);
//             $checkstmt->execute();
//             if($checkstmt->rowCount() > 0){
//                 return[
//                     "status" => false,
//                     "message" => "Email already exists.",
//                 ];
//             }
//                 // WRITE THIS CODE AT 7-7-2026
//             $hashpsw = password_hash($password, PASSWORD_DEFAULT);

//             $insertQuery = "INSERT INTO USERS(full_name,email,password,phone) VALUES (:fullname,:email,:psw,:phone)";
//             $stmt = $this->conn->prepare($insertQuery);
//             $stmt->bindValue(":fullname",$fullname,PDO::PARAM_STR);
//             $stmt->bindValue(":email",$email,PDO::PARAM_STR);
//             $stmt->bindValue(":psw",$password,PDO::PARAM_STR);

//             if($stmt->execute()){
//                 return[
//                     "status"=>true,
//                     "message" => "Registration successful.",
//                 ];
//             }
//             return[
//                 "status" => false,
//                 "message" => "Registration failed."
//             ];


//         } catch(PDOException $e){
//             error_log($e->getMessage());
//             return [
//                 "status" => false,
//                 "message" => "Something went wrong. Please try again later."
//             ];
//         }
//     }
// }

// // come from database.php 
// // or 
// // object of database class that contains in database.php
// $database = new Database();
// $conn = $database->connect();

// $user = new username($conn);



?>