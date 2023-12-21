<?php

  
class Product
{

  private $con;
  function __construct()
  {
    $connect = new DbConnection();
    $this->con = $connect->connect();
  }

  // checking if variety name already exists in the database
  // function takes a crop name and returns a string
  public function check_new_crop_name($crop_name): string
  {

    $name = strtolower($crop_name);

    try {
      //code...
      $sql = "SELECT * FROM crop WHERE  `crop` LIKE '%$name%'";
      $result = $this->con->query($sql);
      if ($result->num_rows > 0) {
        return "already_exists";
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Failed to crop name :" . $th);
    }
  }


  public function register_crop($crop_name)
  {

    $crop_name = strtolower($crop_name);
    $crop_id = Util::generate_id('crop');
    try {
      //code...

      $sql = "INSERT INTO `crop`(`crop_ID`, `crop`) VALUES ('$crop_id','$crop_name')";
      $statement = $this->con->prepare($sql);
      if ($statement->execute()) {
        return "registered";
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      return ("Failed to register crop:" . $th);
    }
  }



  public function check_new_variety_name($crop, $new_variety_name):string
  {
    $variety = strtoupper($new_variety_name);


    try {
      //code...
      $sql = "SELECT * FROM variety WHERE `crop_ID`='$crop' AND `variety` LIKE '%$variety%'";
      $result =  $this->con->query($sql);
      if ($result->num_rows > 0) {
        return "already_exists";
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      return ("Failed to check variety:" . $th);
    }
  }



  public function register_variety($crop_id, $variety_name, $variety_type) 
  {

    $v_name = strtoupper($variety_name);

    $variety_id = Util::generate_id('variety');
    try {
      //code...
      $sql = "INSERT INTO `variety`(`variety_ID`, `variety`, `crop_ID`,`variety_type`) VALUES ('$variety_id','$v_name','$crop_id','$variety_type')";
      $statement = $this->con->prepare($sql);
      if ($statement->execute()) {
        return self::add_price($crop_id, $variety_id);
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Failed to register variety:" . $th);
    }
  }


  //   adding prices for products 



  public function add_price($crop_id, $variety_id)
  {


    $price_id = time();

    try {
      $sql = "INSERT INTO `price`(`prices_ID`, `crop_ID`, `variety_ID`,`sell_breeder`,`sell_basic`, 
    `sell_pre_basic`,`sell_certified`,`buy_breeder`,`buy_basic`, `buy_pre_basic`, `buy_certified`) VALUES 
    ('$price_id','$crop_id','$variety_id','0.00','0.00',
    '0.00','0.00','0.00','0.00','0.00','0.00')";
      $statement = $this->con->prepare($sql);
      if ($statement->execute()) {
        return "registered";
      } else {
        return "error";
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      return ("error: failed to add price :" . $th);
    }
  }


  //  get crop prices

  public function get_prices($crop, $variety)
  {

    try {
      $sql = "SELECT * FROM price WHERE `crop_ID`='$crop' AND `variety_ID`='$variety'";
      $result =  $this->con->query($sql);
      if ($result->num_rows > 0) {
        return $result->fetch_assoc();
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Error: Unable to get prices :" . $th);
    }
  }



  public function set_sell_prices($crop, $variety, $breeder, $pre_basic, $basic, $certified)
  {

    $price_id = self::check_price_exists($crop, $variety);
    try {
      $sql = "UPDATE `price` SET `sell_breeder`='$breeder',`sell_basic`='$basic',`sell_pre_basic`='$pre_basic',`sell_certified`='$certified' WHERE prices_ID='$price_id'";
      $statement = $this->con->prepare($sql);
      if ($statement->execute()) {
        return "updated";
      } else {

        return "error";
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      return ("error updating sell price :" . $th);
    }
  }
  //code...


  /*global $this->con;
    $sql=" UPDATE `price` SET `basic`='$basic',`pre_basic`='$pre_basic',`certified`='$certified' WHERE `prices_ID`='$price_id';";
    $statement->execute();
    
      */



  public function set_buy_prices($crop, $variety, $breeder, $pre_basic, $basic, $certified)
  {

    $price_id = self::check_price_exists($crop, $variety);
    try {
      //code...

      $sql = "UPDATE `price` SET `buy_breeder`='$breeder',`buy_basic`='$basic',`buy_pre_basic`='$pre_basic',`buy_certified`='$certified' WHERE prices_ID='$price_id'";
      $statement = $this->con->prepare($sql);
      $statement->execute();

      return "updated";
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Error adding buy back price " . $th);
    }
    /*global $this->con;
    $sql=" UPDATE `price` SET `basic`='$basic',`pre_basic`='$pre_basic',`certified`='$certified' WHERE `prices_ID`='$price_id';";
    $statement->execute();
    
      */
  }


  private function check_price_exists($crop, $variety)
  {



    try {
      $sql = "SELECT `prices_ID` FROM `price` WHERE `crop_ID`='$crop' AND `variety_ID`='$variety'";
      $result =  $this->con->query($sql);
      $count = $result->num_rows;
      if ($count == 1) {
        $name = $result->fetch_assoc();
        $price_id = $name['prices_ID'];
        return $price_id;
      } else {
        return false;
      }
      //code...
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      //throw $th;
      return ("Error getting price ID " . $th);
    }
  }
}
