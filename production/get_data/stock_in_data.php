<?php

if (isset($_POST["insertStockIn"])) {

    $source = $_POST['seedSource'];
    $creditor = $_POST['insertStockIn'];
    $srn = $_POST['srn'];
    $bincard = $_POST['binCard'];
    $bags = $_POST['bags'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $crop = $_POST['crop'];
    $variety = $_POST['variety'];
    $class = $_POST['class'];
    $farm_ID = $_POST['farmID'];
    $certificate = $_POST['certificate'];
    $status = $_POST['status'];
    $status = $_POST['status'];
    $dir = $_POST['fileDirectory'];
    $user = $_POST['user'];
    $object->stock_in($creditor, $certificate, $farm_ID, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $dir, $user);
  }
  
  
  // update stock in 
  if (isset($_POST["updateStockIn"])) {
  
    $stockInId = $_POST["stockInId"];
    $old_certificate = $_POST["old_certificate"];
    $new_certificate = $_POST["new_certificate"];
    $crop = $_POST["updateStockIn"];
    $variety = $_POST["variety"];
    $class = $_POST["seedClass"];
    $srn = $_POST["seedReceiveNote"];
    $binCardNumber = $_POST["binCardNumber"];
    $numberOfBags = $_POST["bags"];
    $newQuantity = $_POST["quantity"];
    $oldQuantity = $_POST["oldQuantity"];
    $description = $_POST["description"];
    $fileDirectory = $_POST["dir"];
    $creditorId = $_POST["creditorId"];
    $status = $_POST["status"];
    $object->update_stock_in($stockInId, $old_certificate, $new_certificate, $crop, $variety, $class, $srn, $binCardNumber, $numberOfBags, $newQuantity, $oldQuantity, $description, $fileDirectory, $creditorId, $status);
    // $object->update_stock_in($_POST["stockInId"],$_POST["certificate"],$_POST["updateStockIn"],
    // $_POST["variety"],$_POST["seedClass"],$_POST["seedReceiveNote"],
    // $_POST["binCardNumber"],$_POST["bags"],$_POST["quantity"],$_POST["description"],$_POST["dir"]);
    // $sql="UPDATE `stock_in` SET `stock_in_ID`='[value-1]',`user_ID`='[value-2]',`certificate_ID`='[value-3]',`farm_ID`='[value-4]',`creditor_ID`='[value-5]',`source`='[value-6]',`crop_ID`='[value-7]',`status`='[value-8]',`variety_ID`='[value-9]',`class`='[value-10]',`SLN`='[value-11]',`bincard`='[value-12]',`number_of_bags`='[value-13]',`quantity`='[value-14]',`used_quantity`='[value-15]',`available_quantity`='[value-16]',
    // `processed_quantity`='[value-17]',`grade_outs_quantity`='[value-18]',`trash_quantity`='[value-19]',`description`='[value-20]',`supporting_dir`='[value-21]',`date`='[value-22]',`time`='[value-23]' WHERE 1";
  
  
    // $sql = "UPDATE `stock_in` SET`crop_ID`='$crop',`variety_ID`='$variety',`class`='$class',`SLN`='$srn',`bincard`='$binCardNumber',`number_of_bags`='$numberOfBags',`quantity`='$quantity',`available_quantity`='$quantity',
    //       `description`='$description',`supporting_dir`='$fileDirectory',`certificate_ID`='$certificate' WHERE `stock_in_ID`='$stockInId'";
    // $statement = $con->prepare($sql);
    // $statement->execute();
  
  
  
  
  }
  
  if (isset($_POST["deleteStockIn"])) {
    $stockData = $_POST["deleteStockIn"];
    $object->delete_stock_in($stockData[0], $stockData[1], $stockData[2], $stockData[3]);
  }