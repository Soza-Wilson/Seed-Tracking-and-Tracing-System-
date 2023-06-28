<?php
include('../class/main.php');
$object = new main();
if (isset($_POST["grantUserAccess"])) {


   $object->admin_confirm_approval($_POST['grantUserAccess'], $_POST['approvalCode'], $_POST['userId']);
}
if (isset($_POST["denyUserAccess"])) {

   $object->admin_deny_requested_access($_POST['denyUserAccess']);
}

if (isset($_POST["updateBusiness"])) {
   $data = $_POST["updateBusiness"];
   $object->update_business($data[0], $data[1], $data[2], $data[3]);
}

if (isset($_POST["updateSeason"])) {
   $data = $_POST["updateSeason"];

   $object->update_season($data[0], $data[1]);
}
if(isset($_POST["approveOrder"])){
   
   $data = $_POST["approveOrder"];
   echo main::admin_approve_order($data[0],$data[1]);

}

if (isset($_POST["allocateUser"])) {

   $userInput = $_POST["allocateUser"];
   echo main::allocate_role_to_user($userInput[2], $userInput[0], $userInput[1]);
}

if (isset($_POST["suspendUser"])) {
   echo main::suspend_user_account($_POST["suspendUser"]);
}

if (isset($_POST["setNewPrices"])) {

   $data = $_POST["setNewPrices"];
   echo main::set_sell_prices($data[0], $data[1], $data[2], $data[3],$data[4], $data[5]);
}

if(isset($_POST["setBuyPrices"])){
   $data = $_POST["setBuyPrices"];
   echo main::set_buy_prices($data[0], $data[1], $data[2], $data[3],$data[4], $data[5]);


}

