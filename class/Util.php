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

 static function get_current_time(){
   return date("H:i:s");
}

  ///change date format from yyyy-mm-dd to dd-mm-yyyy

 static function convert_date($date){
    $date = date_create($date);
    $date = date_format($date, "d-m-Y");
    return $date;

 }

private function hash_function(){

  
}

 

//   This function checks if an exists in any table in the database 
// takes table name



 static function check_id($table_name, $id_title, $id_value,$con){
 try {
   //code...
   $sql = "SELECT * FROM `" . $table_name . "` WHERE `" . $id_title . "` ='$id_value'";
   $result =  $con->query($sql);
   if ($result->num_rows > 0) {
     return true;
   } else {
     return false;
   }
   mysqli_close($con);
 } catch (\Throwable $th) {
   return "error checking ID".$th;
 }
    
 }


}
