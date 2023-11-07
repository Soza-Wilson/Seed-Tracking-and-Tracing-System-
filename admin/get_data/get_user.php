<?php


if(isset($_POST["saveLogoImage"])){

    $image=$_POST["saveLogoImage"];
    echo main::save_logo($image);
 }
