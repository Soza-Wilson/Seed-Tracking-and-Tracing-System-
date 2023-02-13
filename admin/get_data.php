<?php
include('../class/main.php');
if(isset($_POST["grantUserAccess"])){

   $object = new main();
   $object->admin_confirm_approval($_POST['grantUserAccess'],$_POST['approvalCode'],$_POST['userId']);




}
if(isset($_POST["denyUserAccess"])){


   
}





?>