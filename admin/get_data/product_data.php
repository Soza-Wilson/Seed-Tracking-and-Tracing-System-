<?php

require('../../class/Product.php');

//$user = new User("","","","","","");
$product = new Product();


if (isset($_POST["updateBusiness"])) {
   $data = $_POST["updateBusiness"];
   $object->update_business($data[0], $data[1], $data[2], $data[3]);
}

if (isset($_POST["saveLogoImage"])) {

   $image = $_POST["saveLogoImage"];
   echo $get_user->save_logo($image);
}

if (isset($_POST["updateSeason"])) {
   $data = $_POST["updateSeason"];

   $object->update_season($data[0], $data[1]);
}
if (isset($_POST["approveOrder"])) {

   $data = $_POST["approveOrder"];
   echo main::admin_approve_order($data[0], $data[1]);
}

// allocate user to role 

if (isset($_POST["allocateUser"])) {

   $userInput = $_POST["allocateUser"];
   echo $user->allocate_role($userInput[2], $userInput[0], $userInput[1]);
}

// suspend user 

if (isset($_POST["suspendUser"])) {
   echo $user->suspend_user_account($_POST["suspendUser"]);
}
//   get all prices 

if (isset($_POST["getCropPrices"])) {
   $data = $_POST["getCropPrices"];
   $object_data = $product->get_prices($data[0], $data[1]);
   $return_array = $object_data["sell_breeder"] . "," . $object_data["sell_basic"] . "," . $object_data["sell_pre_basic"] . "," . $object_data["sell_certified"] . "," . $object_data["buy_breeder"] . "," . $object_data["buy_pre_basic"] . "," . $object_data["buy_basic"] . "," . $object_data["buy_certified"];
   echo $return_array;
}
//  check if new crop name already exists

if (isset($_POST["checkNewCropName"])) {
   echo $product->check_new_crop_name($_POST["checkNewCropName"]);
}



if (isset($_POST["registerCrop"])) {
   echo $product->register_crop($_POST["registerCrop"]);
}


//   checking if new variety name already exists 

if (isset($_POST["checkNewVarietyName"])) {
   $data = $_POST["checkNewVarietyName"];

   echo $product->check_new_variety_name($data[0], $data[1]);
}

// register new variety

if (isset($_POST["registerNewVariety"])) {
   $data = $_POST["registerNewVariety"];
   echo $product->register_variety($data[0], $data[1], $data[2]);
}



//    update existing prices 
if (isset($_POST["setNewPrices"])) {


   $data = $_POST["setNewPrices"];
   echo $product->set_sell_prices($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
}

if (isset($_POST["setBuyPrices"])) {
   $data = $_POST["setBuyPrices"];
   echo $product->set_buy_prices($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
}
