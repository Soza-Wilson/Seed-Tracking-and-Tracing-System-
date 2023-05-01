<?php
include('../class/main.php');
$object = new main();
if(isset($_POST["grantUserAccess"])){

  
   $object->admin_confirm_approval($_POST['grantUserAccess'],$_POST['approvalCode'],$_POST['userId']);




}
if(isset($_POST["denyUserAccess"])){
 
   $object->admin_deny_requested_access($_POST['denyUserAccess']);

   
}

if(isset($_POST["updateBusiness"])){
   $data =$_POST["updateBusiness"];

      $object->update_business($data[0], $data[1], $data[2], $data[3]);
  }

 if(isset($_POST["updateSeason"])){
   $data =$_POST["updateSeason"];
 
 $object->update_season($data[0],$data[1]);

  



 } 

   









?>