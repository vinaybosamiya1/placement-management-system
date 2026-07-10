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
require '../models/User.php';

$data = json_decode(file_get_contents("php://input"),true);

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

$user = new User($conn);
$res = $user->register(
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