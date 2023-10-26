<?php
include('../class/User.php');


   
if (isset($_POST["registerUser"])) {
    $userInput = $_POST["registerUser"];
    $user = new User($userInput[0], $userInput[4], $userInput[3], $userInput[1], $userInput[2], $userInput[5]);
    echo $user->register_user();
}

if (isset($_POST["updateProfilePicture"])) {
    $user = new User("","","","","","");
    echo $user->update_profile_picture($_POST["userId"], $_POST["updateProfilePicture"]);
}

if(isset($_POST["updateUser"])){

    $user = new User("","","","","","");
    $userData = $_POST["updateUser"];
    echo $user->update_user($userData[0],$userData[1],$userData[2],$userData[3]);

}
