<?php
include('../class/main.php');
$object = new main();

if (isset($_POST["registerUser"])) {

    

    $userInput = $_POST["registerUser"];
    echo $object->check_user_data($userInput[0],$userInput[4],$userInput[3],$userInput[1],$userInput[2],$userInput[5]);
}


