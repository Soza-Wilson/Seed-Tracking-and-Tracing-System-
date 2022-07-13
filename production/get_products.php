<?php


$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/production.php');

if(isset($_POST['loaded'])){

$sql ="SELECT `crop_ID`, `crop` FROM `crop`";
$result =  $con->query($sql);
if ($result->num_rows > 0) {
    echo "
            <option value ='0'>Select crop</option>";
    while ($row = $result->fetch_assoc()) {
        $crop= $row["crop"];
        $crop_ID= $row["crop_ID"];


        echo "
            <option value ='$crop_ID'>$crop</option>";
    }
}


}


if (isset($_POST['crop_value'])) {

       $crop_ID = $_POST['crop_value'];

    $sql = "SELECT * FROM `variety` WHERE `crop_ID`='$crop_ID'";
    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
        echo "
                <option value ='not_selected'>Select Variety</option>";
        while ($row = $result->fetch_assoc()) {
            $variety= $row["variety"];
            $variety_ID= $row["variety_ID"];
    
    
            echo "
                <option value ='$variety_ID'>$variety</option>";
        }
    }


}