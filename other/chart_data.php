<?php

$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/marketing.php');
include('../class/main.php');



if(isset($_POST['admin_stock_out_value'])){

    echo"working";
}

?>