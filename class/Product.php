<?php

class Product
{

  // checking if variety name already exists in the database
  static function check_new_crop_name($crop_name)
  {
    $con = Database::connect();
    $name = strtolower($crop_name);

    try {
      //code...
      $sql = "SELECT * FROM crop WHERE  `crop` LIKE '%$name%'";
      $result =  $con->query($sql);
      if ($result->num_rows > 0) {
        return "already_exists";
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Failed to crop name :" . $th);
    }
  }


  static function register_crop($crop_name)
  {
    $con = Database::connect();
    $crop_name = strtolower($crop_name);
    $crop_id = Util::generate_id('crop');
    try {
      //code...

      $sql = "INSERT INTO `crop`(`crop_ID`, `crop`) VALUES ('$crop_id','$crop_name')";
      $statement = $con->prepare($sql);
      if ($statement->execute()) {
        return "registered";
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      return ("Failed to register crop:" . $th);
    }
  }



  static function check_new_variety_name($crop, $new_variety_name)
  {
    $variety = strtoupper($new_variety_name);
    $con = Database::connect();

    try {
      //code...
      $sql = "SELECT * FROM variety WHERE `crop_ID`='$crop' AND `variety` LIKE '%$variety%'";
      $result =  $con->query($sql);
      if ($result->num_rows > 0) {
        return "already_exists";
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      return ("Failed to check variety:" . $th);
    }
  }



  static function register_variety($crop_id, $variety_name, $variety_type)
  {

    $v_name = strtoupper($variety_name);
    $con = Database::connect();
    $variety_id = Util::generate_id('variety');
    try {
      //code...
      $sql = "INSERT INTO `variety`(`variety_ID`, `variety`, `crop_ID`,`variety_type`) VALUES ('$variety_id','$v_name','$crop_id','$variety_type')";
      $statement = $con->prepare($sql);
      if ($statement->execute()) {
        return self::add_price($crop_id, $variety_id);
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Failed to register variety:" . $th);
    }
  }


  //   adding prices for products 



  function add_price($crop_id, $variety_id)
  {

    $con = Database::connect();
    $price_id = time();

    try {
      $sql = "INSERT INTO `price`(`prices_ID`, `crop_ID`, `variety_ID`,`sell_breeder`,`sell_basic`, 
    `sell_pre_basic`,`sell_certified`,`buy_breeder`,`buy_basic`, `buy_pre_basic`, `buy_certified`) VALUES 
    ('$price_id','$crop_id','$variety_id','0.00','0.00',
    '0.00','0.00','0.00','0.00','0.00','0.00')";
      $statement = $con->prepare($sql);
      if ($statement->execute()) {
        return "registered";
      } else {
        return "error";
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      return ("error: failed to add price :" . $th);
    }
  }


  //  get crop prices

  static function get_prices($crop, $variety)
  {
    $con = Database::connect();
    try {
      $sql = "SELECT * FROM price WHERE `crop_ID`='$crop' AND `variety_ID`='$variety'";
      $result =  $con->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          return $row["sell_breeder"] . "," . $row["sell_basic"] . "," . $row["sell_pre_basic"] . "," . $row["sell_certified"] . "," . $row["buy_breeder"] . "," . $row["buy_basic"] . "," . $row["buy_pre_basic"] . "," . $row["buy_certified"];
        }
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Error: Unable to get prices :" . $th);
    }
  }



  static function set_sell_prices($crop, $variety, $breeder, $pre_basic, $basic, $certified)
  {
    $con = Database::connect();
    $price_id = self::check_price_exists($crop,$variety);
    try {
      $sql = "UPDATE `price` SET `sell_breeder`='$breeder',`sell_basic`='$basic',`sell_pre_basic`='$pre_basic',`sell_certified`='$certified' WHERE prices_ID='$price_id'";
      $statement = $con->prepare($sql);
      if ($statement->execute()) {
        return "updated";
      } else {

        return "error";
      }
      mysqli_close($con);
    } catch (\Throwable $th) {
      return ("error updating sell price :" . $th);
    }
  }
  //code...


  /*global $con;
    $sql=" UPDATE `price` SET `basic`='$basic',`pre_basic`='$pre_basic',`certified`='$certified' WHERE `prices_ID`='$price_id';";
    $statement->execute();
    
      */



  static function set_buy_prices($crop, $variety, $breeder, $pre_basic, $basic, $certified)
  {
    $con = Database::connect();
    $price_id = self::check_price_exists($crop,$variety);
    try {
      //code...

      $sql = "UPDATE `price` SET `buy_breeder`='$breeder',`buy_basic`='$basic',`buy_pre_basic`='$pre_basic',`buy_certified`='$certified' WHERE prices_ID='$price_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      return "updated";
      mysqli_close($con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Error adding buy back price " . $th);
    }
     
   






    /*global $con;
    $sql=" UPDATE `price` SET `basic`='$basic',`pre_basic`='$pre_basic',`certified`='$certified' WHERE `prices_ID`='$price_id';";
    $statement->execute();
    
      */
  }


  private function check_price_exists($crop, $variety)
  {

    $con = Database::connect();

    try {
      $sql = "SELECT `prices_ID` FROM `price` WHERE `crop_ID`='$crop' AND `variety_ID`='$variety'";
      $result =  $con->query($sql);
      $count = $result->num_rows;
      if ($count == 1) {
        $name = $result->fetch_assoc();
        $price_id = $name['prices_ID'];
        return $price_id;
      } else {
        return false;
      }
      //code...
      mysqli_close($con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Error getting price ID " . $th);
    }
  }
}
