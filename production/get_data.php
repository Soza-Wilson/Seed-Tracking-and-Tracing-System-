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

?>