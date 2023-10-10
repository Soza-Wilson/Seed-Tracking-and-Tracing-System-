<?php

include('class/Database.php');
class Auth
{
    function user_log_in($email, $password)
    {

        $con = Database::connect();
        $Email = $email;
        $Password = $password;
        $sql = "SELECT * FROM user WHERE email = '$Email' AND password = '$Password'";

        $result =  $con->query($sql);
        $count = $result->num_rows;

        if ($count === 1) {

            /*
            Create session for diffrent users, user will have access to pages according to their department and position
            */
            $data = $result->fetch_assoc();
            session_start();
            $_SESSION['user'] = $data['user_ID'];
            $_SESSION['fullname'] = $data['fullname'];
            $_SESSION['depertment'] = $data['user_type_ID'];
            $_SESSION['position'] = $data['postion'];
            $_SESSION['account_status'] = $data['account_status'];
            $_SESSION['profile'] = $data['profile_picture'];
            $this->navigate_user($_SESSION['depertment'], $_SESSION['position']);
        } else {
            echo ("<script> alert('wrong username or password');
          </script>");
        }
    }



    private function navigate_user($depertment, $position)
    {
        if ($depertment == 1) {
            header('Location:admin/admin_dashboard.php');
        } else if ($depertment == 2 &&  $position == "warehouse_officer") {

            header('Location:production/stock_in.php');
        } else if ($depertment == 2 &&  $position == "lab_technician") {

            header('Location:production/new_test.php');
        } else if ($depertment == 2 &&  $position == "field_officer") {

            header('Location:production/grower.php');
        } else if ($depertment == 2) {

            header('Location:production/production_dashboard.php');
        } else if ($depertment == 3) {

            header('Location:marketing/marketing_dashboard.php');
        } else if ($depertment == 4) {

            header('Location:production/m&e_dashboard.php');
        } else if ($depertment == 5) {

            header('Location:finance/finance_dashboard.php');
        } else if ($_SESSION['account_status'] == "unsigned") {
            header('Location:other/account_status.php');
        }
    }
}
