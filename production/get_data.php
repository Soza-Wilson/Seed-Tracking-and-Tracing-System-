<?php

include('../class/main.php');

if(isset($_POST['updateStockInRequest'])){

$object = new main();
$object->admin_approval($_POST['depertment'],$_POST['updateStockInRequest'],$_POST['action_id'],$_POST['description'],$_POST['request_id'],$_POST['requestedName']);

echo'
<div class="" >
<label for="bin_card" > Request for approval sent to ADMIN</label>
</div>';

}

if(isset($_POST["checkApprovalCode"])){

    $approvalCode = $_POST["checkApprovalCode"];
    $sql="SELECT * FROM `approval` WHERE `approval_code`='$approvalCode'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
 
       echo'<input type="hidden" id="code_validity" class="form-control" placeholder="Enter code" require="" value="valid">';
 
        
    }
 
    else{
       echo'<input type="hidden" id="code_validity" class="form-control" placeholder="Enter code" require="" value="invalid">';
 
 
    }
 
 
 
 }

?>