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
    public function updateProfile($id, $firstName, $lastName, $fullName, $rollNo, $branch, $completedYear, $phone, $location, $resume_path)
    {
        if ($resume_path !== null) {
            $sql = "
UPDATE users_persontal_details
SET
first_name=:first_name,
last_name=:last_name,
full_name=:full_name,
roll_no=:roll_no,
Branch=:branch,
completed_year=:completed_year,
phone_number=:phone,
current_location=:location,
resume_path=:resume
WHERE id=:id
";
        }else {
            $sql = "
UPDATE users_persontal_details
SET
first_name=:first_name,
last_name=:last_name,
full_name=:full_name,
roll_no=:roll_no,
Branch=:branch,
completed_year=:completed_year,
phone_number=:phone,
current_location=:location
WHERE id=:id
";
        }
        // "socials=:socials,
        // academics=:academics,
        // skills=:skills,
        // projects=:projects";
        $query = $this->conn->prepare($sql);

        $query->bindParam(":first_name", $firstName);
        $query->bindParam(":last_name", $lastName);
        $query->bindParam(":full_name", $fullName);
        $query->bindParam(":roll_no", $rollNo);
        $query->bindParam(":branch", $branch);
        $query->bindParam(":completed_year", $completedYear);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":location", $location);
        if($resume_path !== null){

            $query->bindParam(":resume", $resume_path);
            }
        $query->bindParam(":id", $id);
        $res = null;
        try {
            $res = $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
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