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



  if ($_POST['type_value'] == "external") {

   

    $sql="SELECT * FROM `creditor` WHERE `account_funds` < 0 AND `source` ='external' AND `name` LIKE '%$value%'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        $creditor_id = $row["creditor_ID"];
        $creditor = $row["creditor"];
        $phone = $row["phone"];
       
    } 
    echo "
  <option value ='$creditor_id,$phone,$debtor'>$creditor</option>";

  
  }else {

      echo "
    <option value ='-'>Creditor name not found</option>";
    }
  }


  if ($_POST['type_value'] == "internal") {

    $sql="SELECT * WHERE `account_funds` < 0 AND `source` ='internal' AND `name` LIKE '%$value%'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $creditor = $row["creditor"];
        $phone = $row["phone"];
       
    } 
    echo "
    <option value ='$creditor_id,$phone,$debtor'>$creditor</option>";

  
  }else {

      echo "
      <option value ='-'>Creditor name not found</option>";
    }
  }

  

  




}




