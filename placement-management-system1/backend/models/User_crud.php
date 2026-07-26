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

            "INSERT INTO users_persontal_details
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
    {
        $query = false;
        $query = "SELECT * FROM users_persontal_details WHERE email=:email";
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

    // public function updateProfile($id,$fullName,$rollNo,$branch,$completedYear,$phone,$location,$socials,$academics,$skills,$projects) 
    public function updateProfile($id,$firstName,$lastName, $fullName, $rollNo, $branch, $completedYear, $phone, $location)
    {

        $query = $this->conn->prepare("UPDATE users_persontal_details SET 
        first_name=:first_name,
        last_name=:last_name,
        full_name=:full_name,
        roll_no=:roll_no,
        Branch=:branch,
        completed_year=:completed_year,
        phone_number=:phone,
        current_location=:location 
        
        WHERE id=:id");
        // "socials=:socials,
        // academics=:academics,
        // skills=:skills,
        // projects=:projects";

        $res = $query->execute([
            ":first_name" => $firstName,
            ":last_name" => $lastName,
            ":full_name" => $fullName,
            ":roll_no" => $rollNo,
            ":branch" => $branch,
            ":completed_year" => $completedYear,
            ":phone" => $phone,
            ":location" => $location,

            // ":socials"=>json_encode($socials),

            // ":academics"=>json_encode($academics),

            // ":skills"=>json_encode($skills),

            // ":projects"=>json_encode($projects),

            ":id" => $id
        ]);
        if ($res) {
            return [
                "success" => true,
                "message" => "Profile Updated Successfully"
            ];

        }
        
        return [
            "success" => false,
            "message" => "Profile Update Failed"
        ];




    }

}


?>