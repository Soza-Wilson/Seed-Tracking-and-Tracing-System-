<?php
include('../class/main.php');
$object = new main();

if (isset($_POST["registerUser"])) {

    $userInput = $_POST["registerUser"];
    echo $object->check_user_data($userInput[0], $userInput[4], $userInput[3], $userInput[1], $userInput[2], $userInput[5]);
}

if (isset($_POST["updateProfilePicture"])) {
    echo main::update_profile_picture($_POST["userId"], $_POST["updateProfilePicture"]);
}

if(isset($_POST["updateUser"])){

    $userData = $_POST["updateUser"];
    echo main::update_user($userData[0],$userData[1],$userData[2],$userData[3]);

}
