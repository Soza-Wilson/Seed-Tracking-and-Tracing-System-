<?php

class Util{

    //  generate random id 

 static function generate_id($type){
    $new_id = "";
    $shuffled_time = str_shuffle(time());
    $new_value = substr(strtoupper($type), 0, 3);
    $new_id = $new_value . $shuffled_time;
    return $new_id;
 }

    //  return current date
 static function get_current_date(){
    return date("Y-m-d");
 }

  ///change date format from yyyy-mm-dd to dd-mm-yyyy

 static function convert_date($date){
    $date = date_create($date);
    $date = date_format($date, "d-m-Y");
    return $date;

 }



}


?>