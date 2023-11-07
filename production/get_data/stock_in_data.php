<?php

 require('../../class/InventoryManager.php');

 $inventory = new InventoryManager();
 

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
    $inventory->register_stock($creditor, $certificate, $farm_ID, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $dir, $user);
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
    $inventory->update_stock_details($stockInId, $old_certificate, $new_certificate, $crop, $variety, $class, $srn, $binCardNumber, $numberOfBags, $newQuantity, $oldQuantity, $description, $fileDirectory, $creditorId, $status);
    
  // delete stock 
  
  }
  
  if (isset($_POST["deleteStockIn"])) {
    $stockData = $_POST["deleteStockIn"];
    $object->delete_stock_in($stockData[0], $stockData[1], $stockData[2], $stockData[3]);
  }