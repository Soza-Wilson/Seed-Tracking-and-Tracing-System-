<?php


spl_autoload_register(function ($class) {
   if (file_exists('../../class/' . $class . '.php')) {
     require_once '../../class/' . $class . '.php';
   } 
 });



if (isset($_POST["updateBusiness"])) {
   $data = $_POST["updateBusiness"];
   $object = new Client($data[0], $data[1], $data[2], $data[3]);
   
   echo  $object->add_profile_data();
}

if (isset($_POST["saveLogoImage"])) {
   $object = new Client("","","","");
   $image = $_POST["saveLogoImage"];
   echo $object->save_logo($image);
}

// if (isset($_POST["updateSeason"])) {
//    $data = $_POST["updateSeason"];

//    $object->update_season($data[0], $data[1]);
// }
