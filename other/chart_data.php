<?php

$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/marketing.php');
include('../class/main.php');
header('Content-Type: application/json');



if(isset($_POST['admin_stock_out_value'])){

   $sql="SELECT crop, SUM(stock_in.quantity) AS quantity FROM crop INNER JOIN stock_in ON stock_in.crop_ID = crop.crop_ID";
   $result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($con);

echo json_encode($data);

    echo"working";
}

?>