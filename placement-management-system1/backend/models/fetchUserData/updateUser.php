<?php
// created at 21-7-26 and this code transfer at User_register_login.php file
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

require '../../config/database.php';


class UpdateUser{
    private $conn;
    public function __construct($db_connection){
        $this->conn = $db_connection;
    }
    public function updateProfile($id,$fname,$lname,$fullname,$email,$password,$rollNumber,$Branch,$phoneNumber,$Current_Location,$resumePdf){
        $hashPsw = password_hash($password, PASSWORD_DEFAULT);
        $query = $this->conn->prepare(

            "UPDATE users SET first_name=:fname,last_name=:lname,full_name=:fullname,email=:email,
                            password=:password,phone_number=:phonenumber,roll=:roll,Branch=:branch,
                            STATUS=:status,current_location=:location,resume=:resume"

        );

        $query->bindParam(":fname", $fname);
        $query->bindParam(":lname", $lname);
        $query->bindParam(":fullname", $fullname);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $hashPsw);
        $query->bindParam(":phonenumber", $phoneNumber);
        $query->bindParam(":roll", $rollNumber);
        $query->bindParam(":branch", $Branch);
        $query->bindParam(":location", $Current_Location);
        $query->bindParam(":resume", $resumePdf);

        if ($query->execute()) {

            return [

                "status" => true,
                "message" => "Registration Successful"

            ];

        } else {
            return [

                "status" => false,
                "message" => "Registration Failed"

            ];
        }
    }
};
?>