<?php
class User
{
    // register();

    // login();

    // updateProfile();

    // changePassword();

    // deleteUser();

    private $conn;

    public function __construct($db_connection)
    {

        $this->conn = $db_connection;

    }
    public function register($fullname, $email, $password)
    {


        $hashPsw = password_hash($password, PASSWORD_DEFAULT);
        $query = $this->conn->prepare(

            "INSERT INTO users
            (full_name,email,password)
            VALUES
            (:fullname,:email,:password)"

        );

        $query->bindParam(":fullname", $fullname);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $hashPsw);

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

    public function login($email, $password)
    {   $query = false;
        $query = "SELECT * FROM users WHERE email=:email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return [
                "status" => false,
                "message" => "Email not found"
            ];
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user["password"])) {

            return [
                "status" => true,
                "message" => "Login Successful",
                "user" => $user
            ];
        }

        return [
            "status" => false,
            "message" => "Wrong Password"
        ];
    }

}


?>