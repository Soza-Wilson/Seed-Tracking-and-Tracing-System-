<?php

require_once('../../class/Auth.php');

$object = new Auth();

if (isset($_POST["grantUserAccess"])) {

    echo $object->admin_confirm_approval($_POST['grantUserAccess'], $_POST['approvalCode'], $_POST['userId']);
 }
 if (isset($_POST["denyUserAccess"])) {
 
   echo $object->admin_deny_requested_access($_POST['denyUserAccess']);
 }