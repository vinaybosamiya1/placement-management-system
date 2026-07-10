<?php
class User
{
    // register();

    // login();

    // updateProfile();

    // changePassword();

    // deleteUser();

    private $conn;

    public function __construct($db){

        $this->conn = $db;

    }
    public function register($fullname,$email,$password){
        $check = "SELECT id FROM users WHERE email=:email";
        $stmt = $this->conn->prepare($check);

        $stmt->bindParam(":email",$email);

        $stmt->execute();

        if($stmt->rowCount()>0){
            return[
                "status"=>false,
                "message"=>"Email already exists"
            ];
        }

        $hashPsw = password_hash($password,PASSWORD_DEFAULT);
        $query = $this->conn->prepare(

            "INSERT INTO users
            (full_name,email,password)
            VALUES
            (:fullname,:email,:password)"

        );

        $query->bindParam(":fullname",$fullname);
        $query->bindParam(":email",$email);
        $query->bindParam(":password",$hashPsw);

        if($query->execute()){

            return [

                "status"=>true,
                "message"=>"Registration Successful"

            ];

        }
        else{
            return [

                "status"=>false,
                "message"=>"Registration Failed"

            ];
        }
    }
    
}


?>