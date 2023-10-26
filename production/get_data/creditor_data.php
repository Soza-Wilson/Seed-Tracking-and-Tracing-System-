<?php
require('../../class/Creditor.php');

$creditorObject = new Creditor();

if (isset($_POST["registerGrower"])) {

    $growerData = $_POST["registerGrower"];
    $growerName = strtolower($growerData[1]);
    $returnData = $creditorObject->add_creditor($growerData[0], $growerName, $growerData[2], $growerData[3], "-", $growerData[4], "active");
    echo $returnData[1];
  }


  if (isset($_POST["updateGrowerDetails"])) {

    $creditorData = $_POST["updateGrowerDetails"];
    $returnedData =  $creditorObject->update_grower($creditorData[0], $creditorData[1], $creditorData[2], $creditorData[3], $creditorData[4]);
    echo $returnedData;
  }
  if (isset($_POST["activateGrower"])) {
    $growerData = $_POST["activateGrower"];
    $returnedData =  $creditorObject->activate_grower($growerData[0], $growerData[1], $growerData[2]);
    echo $returnedData;
  }
  

  if (isset($_POST["checkGrowerName"])) {
    $name = $_POST["checkGrowerName"];
  
    $sql = "SELECT `name` FROM `creditor` WHERE `source`='internal' AND `name` LIKE '$name'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      echo true;
    } else {
      echo false;
    }
  }

  if (isset($_POST["registerContract"])) {

    $creditorData = $_POST["registerContract"];
    $creditorObject->register_contract($creditorData[0], $creditorData[1], "grower", $creditorData[2]);
  }
  