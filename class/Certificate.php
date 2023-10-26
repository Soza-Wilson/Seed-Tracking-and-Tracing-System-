<?php

require ('season.php');
class Certificate
{
  


  public $con;
  private $register_date;

  function __construct()
  {
    $data = new DbConnection();
    $this->con = $data->connect();
    $this->register_date = Util::get_current_date();
  }



  /*
This function wil register new certificates to the database 
first we are passing data to the check ids function in Util 
if 

*/
  public function add_certificate($lot_number, $crop, $variety, $class, $type, $source, $source_name, $date_tested, $expire_date, $certificate_quantity, $directory, $user)
  {


    $added_date = $this->register_date;
    $check_ids = Util::check_id("certificate", "lot_number", $lot_number,$this->con);
    if ($check_ids) {
      return "Error: Lot Number already exists";
    } else {
      try {
        $sql = "INSERT INTO `certificate`(`lot_number`, `crop_ID`, `variety_ID`, `class`, `type`, `source`, 
              `source_name`, `date_tested`, `expiry_date`, `date_added`, `certificate_quantity`, 
              `available_quantity`, `assigned_quantity`, `status`, `directory`, `user_ID`) VALUES 
              ('$lot_number','$crop','$variety','$class','$type','$source','$source_name',
              '$date_tested','$expire_date','$added_date','$certificate_quantity',
              '$certificate_quantity','$certificate_quantity','available','$directory','$user')";

        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {
          return "registered";
        } else {
          return "error ";
        }
        mysqli_close($this->con);
      } catch (\Throwable $th) {
        return "failed to register certificate" . $th;
      }
    }
  }



  /**  Deleting ceritficate 
   * 
   * 

   */

  public function delete_certificate($lot_number)
  {
    try {
      //code...
      $sql = "DELETE FROM `certificate` WHERE `lot_number` ='$lot_number'";
      $statement = $this->con->prepare($sql);
      if ($statement->execute()) {
        return "Certificate deleted";
      }
    } catch (\Throwable $th) {
      return "Error deleting certificate" . $th;
    }
    mysqli_close($this->con);
  }
  /**
   * 
   * 
   * The function below is handling most of the operations done to a certificate 
   * the function takes operation type this can be  (-) or  (+) operator
   * also quantity type can be certificate quantity or assigned quantity
   * the last two arguments are the certificate ID and the quantity 
   * 
   * 
   */
  public function update_certificate_quantity($operation_type, $quantity_type, $lot_number, $quantity)
  {
    try {
      //code...
      $sql =   "UPDATE `certificate` SET `$quantity_type` = `$quantity_type` $operation_type'$quantity' WHERE `lot_number`='$lot_number'";
      $statement = $this->con->prepare($sql);
      $statement->execute();
      return "updated"; 
      
    } catch (\Throwable $th) {
      //throw $th;
      return "error updating certificate quantity" . $th;
    }
    mysqli_close($this->con);
  }



}
