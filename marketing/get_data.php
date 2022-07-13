<?php


$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/marketing.php');
include('../class/main.php');


if (isset($_POST['search_value'])) {

  $value = $_POST['search_value'];



  if ($_POST['type_value'] == "agro_dealer") {

    $sql = "SELECT * FROM `debtor` WHERE `name` like '%$value%' AND `debtor_type`='agro_dealer'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        $debtor_id = $row["debtor_ID"];
        $debtor = $row["name"];
        $phone = $row["phone"];
       
    } 
    echo "
  <option value ='$debtor_id,$phone,$debtor'>$debtor</option>";

  
  }else {

      echo "
    <option value ='-'>Agro dealer name not found</option>";
    }
  }


  if ($_POST['type_value'] == "b_to_b") {

    $sql = "SELECT * FROM `debtor` WHERE `name` like '%$value%' AND `debtor_type`='b_to_b'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $debtor_id = $row["debtor_ID"];
        $debtor = $row["name"];
        $des = $row["description"];
       
    } 
    echo "
    <option value ='$debtor_id,$des,$debtor'>$debtor</option>";

  
  }else {

      echo "
    <option value ='-'>Business not regis
    red</option>";
    }
  }

  if ($_POST['type_value'] == "customer") {

    $sql = "SELECT * FROM `debtor` WHERE `name` like '%$value%' AND `debtor_type`='customer'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $debtor_id = $row["debtor_ID"];
        $debtor = $row["name"];
        $phone = $row["phone"];
       
    } 
    echo "
    <option value ='$debtor_id,$phone,$debtor'>$debtor</option>";

  
  }else {

      echo "
    <option value ='not_selected'>customer not registered </option>";
    }
  }

  if ($_POST['type_value'] == "grower") {

    $sql = "SELECT * FROM `creditor` WHERE `name` like '%$value%'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $creditor = $row["name"];
        $phone = $row["phone"];
       
       
    } 
    echo "
    <option value ='$creditor_id,$phone,$creditor'>$creditor</option>";

  
  }else {

      echo "
    <option value ='-'>grower's phone number</option>";
    }
  }




}


if(isset($_POST['customer_value'])){

  $sql = "SELECT `debtor_ID`, `name`, `phone`, `email`, `description`, `debtor_type`, 
  `user_ID`, `debtor_files`, `registered_date`, `account_funds` FROM `debtor` WHERE  `debtor_type` = '' AND `name` like %''%";

  $result =  $con->query($sql);
    if ($result->num_rows > 0) {


    }
    else{

     $object = new main();
     $object -> register_customer($_POST['customer_name'],$_POST['customer_phone']);

    }




}


