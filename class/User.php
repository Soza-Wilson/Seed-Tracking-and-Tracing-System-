<?php
include('../class/Util.php');
include('../class/Database.php');
class User
{
    private $fullname;
    private $date_of_birth;
    private $sex;
    private $phone;
    private $email;
    private $password;





    function __construct($fullname, $date_of_birth, $sex, $phone, $email, $password)
    {
        $this->fullname = $fullname;
        $this->date_of_birth = $date_of_birth;
        $this->sex = $sex;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
    }
    // checking if user or emaill alredy exists in the databas 
    private function check_if_exists($email, $fullname)
    {

        $sql = "SELECT * FROM `user` WHERE email = '$email' OR fullname = '$fullname'";
        $result =  Database::connect()->query($sql);
        $count = $result->num_rows;
        if ($count >= 1) {
            return true;
        } else {
            return false;
        }
    }

    // Register new user to the system 

    function register_user()
    {
        $con = Database::connect();
        $user_id = Util::generate_id("user");
        $registered_date = Util::get_current_date();
        $user_fullname = strtolower($this->fullname);
        $dob = $this->date_of_birth;
        $sex = $this->sex;
        $email  = $this->email;
        $phone = $this->phone;
        $password = $this->password;


        if ($this->check_if_exists($this->email, $this->fullname)) {
            return "user already exists";
        } else {
            $sql = "INSERT INTO `user`(`user_ID`, `fullname`,`DOB`,`sex`,`registered_date`,`phone`, `email`, `password`,`account_status`) 
                       VALUES ('$user_id','$user_fullname','$dob','$sex','$registered_date',
                      '$phone','$email','$password','unsigned')";
            $statement = $con->prepare($sql);
            if ($statement->execute()) {
                return "registered";
            }
        }
    }

    // update user details 

    static function update_user($user_id, $fullname, $phone, $email)
    {
        $con = Database::connect();
        $sql = "UPDATE `user` SET `fullname`='$fullname',`phone`='$phone',`email`='$email' WHERE `user_ID`='$user_id'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            return "updated";
        }
    }


    //  allocating user to role 

    static function allocate_role($userId, $department, $role)
    {
        $con = Database::connect();
        $sql = "UPDATE `user` SET `user_type_ID`='$department', `postion`='$role', `account_status`='active' WHERE `user_ID`='$userId'";

        $statement = $con->prepare($sql);
        if ($statement->execute()) {

            return "registered";
        };
    }

    //  suspend user account
    static function suspend_user_account($user_id)
    {
        $con = Database::connect();
        $sql = "UPDATE `user` SET `account_status`='suspended' WHERE `user_ID`='$user_id'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {

            return "suspended";
        }
    }


    static function update_profile_picture($userId, $file)
    {

        $con = Database::connect();
        $sql = "UPDATE `user` SET `profile_picture`='$file' WHERE `user_ID`='$userId'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            return "updated";
        }
    }
}
