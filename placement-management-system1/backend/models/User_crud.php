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
    public function ensureStudentProfile($userId, $googleId = null)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, google_id FROM student_profiles WHERE user_id = :user_id LIMIT 1");
            $stmt->execute([':user_id' => $userId]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$existing) {
                $ins = $this->conn->prepare("INSERT INTO student_profiles (user_id, google_id) VALUES (:user_id, :google_id)");
                $ins->execute([
                    ':user_id' => $userId,
                    ':google_id' => $googleId
                ]);
            } else if ($googleId && empty($existing['google_id'])) {
                $upd = $this->conn->prepare("UPDATE student_profiles SET google_id = :google_id WHERE user_id = :user_id AND google_id IS NULL");
                $upd->execute([
                    ':google_id' => $googleId,
                    ':user_id' => $userId
                ]);
            }
        } catch (PDOException $e) {
            error_log("Error in ensureStudentProfile: " . $e->getMessage());
        }
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
            $newUserId = $this->conn->lastInsertId();
            $this->ensureStudentProfile($newUserId);

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
            $this->ensureStudentProfile($user["id"], $user["google_id"] ?? null);

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
    // public function updateProfile($id, $firstName, $lastName, $fullName, $rollNo, $branch, $completedYear, $phone, $location, $resume_path, $cgpa, $backlogs, $twelfth, $tenth, $github, $linkedin, $skills, $project_title,$project_techStack,$project_description,$project_link)
    public function updateProfile($id, $firstName, $lastName, $fullName, $rollNo, $branch, $completedYear, $phone, $location, $resume_path, $cgpa, $backlogs, $twelfth, $tenth, $github, $linkedin, $skills, $projects)
    {

        try {

            // Start transaction
            $this->conn->beginTransaction();

            /*
            ====================================
            1. UPDATE USERS TABLE
            ====================================
            */
            $sql = "UPDATE users
            SET
                first_name = :first_name,
                last_name = :last_name,
                full_name = :full_name,
                roll_no = :roll_no,
                phone_number = :phone
            WHERE id = :id";
            $query = $this->conn->prepare($sql);

            $users_params = [
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':full_name' => $fullName,
                ':roll_no' => $rollNo,
                ':phone' => $phone,
                ':id' => $id
            ];

            $query->execute($users_params);



            // $query->bindParam(':first_name', $firstName);
            // $query->bindParam(':last_name', $lastName);
            // $query->bindParam(':full_name', $fullName);
            // $query->bindParam(':roll_no', $rollNo);
            // $query->bindParam(':phone', $phone);
            // $query->bindParam(':id', $id);
            // $query->execute();

            /*
            ====================================
            2. ENSURE STUDENT PROFILE EXISTS
            ====================================
            */
            $this->ensureStudentProfile($id);


            /*
            ====================================
            3. UPDATE STUDENT PROFILE
            ====================================
            */
            if ($resume_path !== null) {
                $sql = "
                    UPDATE student_profiles
                    SET

                    Branch=:branch,
                    completed_year=:completed_year,
                    current_location=:location,
                    resume_path=:resume,

                    cgpa=:cgpa,
                    backlogs=:backlogs,
                    tenth_percentage=:tenth,
                    twelfth_percentage=:twelfth,
                    github_url=:github,
                    linkedin_url=:linkedin

                    WHERE user_id=:id
                    ";
            } else {
                $sql = "
                    UPDATE student_profiles
                    SET

                    Branch=:branch,
                    completed_year=:completed_year,
                    current_location=:location,

                    cgpa=:cgpa,
                    backlogs=:backlogs,
                    tenth_percentage=:tenth,
                    twelfth_percentage=:twelfth,
                    github_url=:github,
                    linkedin_url=:linkedin

                    WHERE user_id=:id
                    ";
            }
            $query = $this->conn->prepare($sql);

            $params = [
                ':branch' => $branch,
                ':completed_year' => $completedYear,
                ':location' => $location,

                ':cgpa' => $cgpa,
                ':backlogs' => $backlogs,
                ':tenth' => $tenth,
                ':twelfth' => $twelfth,
                ':github' => $github,
                ':linkedin' => $linkedin,

                ':id' => $id
            ];

            // Only add resume parameter if a new resume exists
            if ($resume_path !== null) {
                $params[':resume'] = $resume_path;
            }
            $query->execute($params);

            /*
            ====================================
            4. GET STUDENT PROFILE ID
            ====================================
            */
            $sql = "SELECT id from student_profiles WHERE user_id=:id LIMIT 1";
            $query = $this->conn->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            $studentprofileId = $query->fetchColumn(); // fetch id column

            /*
            ====================================
            5. DELETE OLD SKILLS
            ====================================
            */
            $sql = "
                DELETE FROM skills
                WHERE student_profile_id = :student_profile_id
            ";

            $query = $this->conn->prepare($sql);
            $query->execute([
                ':student_profile_id'=> $studentprofileId
            ]);

            /*
            ====================================
            6. INSERT NEW SKILLS
            ====================================
            */
            if(!empty($skills) && is_array($skills)){
                $sql = "
                    INSERT INTO skills 
                    (student_profile_id,user_id, skill ) 
                    VALUES
                    (:student_profile_id, :user_id, :skill)
                ";

                $query = $this->conn->prepare($sql);

                foreach($skills as $skill){
                    $skill = ucfirst(trim($skill));

                    if(!empty($skill)){
                        $query->execute([
                            ':student_profile_id'=>$studentprofileId,
                            ':user_id'=> $id,
                            ':skill' => $skill
                        ]);
                    }
                }


            }

            /*
            ====================================
            DELETE OLD USER_PROJECTS
            ====================================
            */
            $sql = "DELETE FROM user_project WHERE student_profile_id = :student_profile_id";
            $query = $this->conn->prepare($sql);
            $query->execute([
                ':student_profile_id'=>$studentprofileId
            ]);


            /*
            ====================================
            INSERT NEW USER_PROJECTS
            ====================================
            */
            $sql = "INSERT INTO user_project (users_id,student_profile_id,ProjectTitle,TechStack,project_description,project_link) 
                    VALUES 
                    (
                    :user_id,
                    :student_profile_id,
                    :project_title,
                    :project_techStack,
                    :project_description,
                    :project_link
                    )
            ";
            $query = $this->conn->prepare($sql);
            foreach($projects as $project){
                $title = ucfirst(trim($project['title']));
                $techStack = ucfirst(trim($project['techStack']));
                $desc = ucfirst(trim($project['description']));
                $link = ucfirst(trim($project['link']));

                if (!empty($title) && !empty($techStack) && !empty($desc) && !empty($link)){
                    
                        $query->execute([
                        ':user_id'=>$id,
                        ':student_profile_id'=>$studentprofileId,
                        ':project_title'=>$title,
                        ':project_techStack'=>$techStack,
                        ':project_description'=>$desc,
                        ':project_link'=>$link
                    ]);
                }                
            }
            // if($query->rowCount() === 0){
            //     $truncatesql = 'TRUNCATE TABLE user_project';
            //     $query = $this->conn->prepare($truncatesql);
            //     $query->execute();
            // }
            /*
        ====================================
        COMMIT TRANSACTION
        ====================================
        */

        $this->conn->commit();

        // by me
            // $sql = "UPDATE skills SET student_profile_id = :sp_id, skill = :s where id = :id";
            // $query = $this->conn->prepare($sql);
            // $query->bindParam(':sp_id', $studentprofileId);
            // $query->bindParam(':s', $skills);
            // $query->bindParam(':id', $id);
            // $query->execute();

            return [
                "success" => true,
                "message" => "Profile Updated Successfully"
            ];
        } catch (PDOException $e) {

            return [
                "success" => false,
                "message" => "Profile Update Failed: " . $e->getMessage()
            ];
        }



        // $res = null;    
        // try {
        //     $res = $query->execute();
        // } catch (PDOException $e) {
        //     die($e->getMessage());
        // }
        // if ($res) {
        //     // Ensure student_profiles row exists and sync profile fields
        //     $this->ensureStudentProfile($id);
        //     if ($resume_path !== null) {
        //         $spSql = "UPDATE student_profiles SET roll_no=:roll_no, Branch=:branch, completed_year=:completed_year, current_location=:location, resume_path=:resume WHERE user_id=:id";
        //     } else {
        //         $spSql = "UPDATE student_profiles SET roll_no=:roll_no, Branch=:branch, completed_year=:completed_year, current_location=:location WHERE user_id=:id";
        //     }
        //     $spQuery = $this->conn->prepare($spSql);
        //     $spQuery->bindParam(":roll_no", $rollNo);
        //     $spQuery->bindParam(":branch", $branch);
        //     $spQuery->bindParam(":completed_year", $completedYear);
        //     $spQuery->bindParam(":location", $location);
        //     if ($resume_path !== null) {
        //         $spQuery->bindParam(":resume", $resume_path);
        //     }
        //     $spQuery->bindParam(":id", $id);
        //     $spQuery->execute();

        //     return [
        //         "success" => true,
        //         "message" => "Profile Updated Successfully"
        //     ];

        // }

        // return [
        //     "success" => false,
        //     "message" => "Profile Update Failed"
        // ];
    }

}


?>