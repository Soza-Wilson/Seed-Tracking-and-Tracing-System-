<?php


require "../../class/main.php";

$object = new main();




if (isset($_POST["updateBusiness"])) {
   $data = $_POST["updateBusiness"];
   echo  $object->update_business($data[0], $data[1], $data[2], $data[3]);
}

if (isset($_POST["saveLogoImage"])) {

   $image = $_POST["saveLogoImage"];
   echo main::save_logo($image);
}

if (isset($_POST["updateSeason"])) {
   $data = $_POST["updateSeason"];

   $object->update_season($data[0], $data[1]);
}
