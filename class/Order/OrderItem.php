<?php


/**
 * This class handles all functionality for order Items, this include :
 * - register item into the database 
 * - calculate total amount for items in Order
 * 
 * 
 * 
 */





class OrderItems
{


    private $item_id;
    private $con;



    function __construct()
    {
        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->item_id = Util::generate_id("item");
    }


    public function add_item($order_ID, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price)
    {
        //   function takes item details and inserts into items table 

        try {
            //code...
            $sql = "INSERT INTO `item`(`item_ID`, `order_ID`, `crop_ID`,
             `variety_ID`, `class`, `quantity`, `price_per_kg`, `discount_price`, 
            `total_price`) VALUES ('$this->item_id','$order_ID','$crop','$variety','$class',
            '$order_quantity','$price_per_kg','$discount_price','$total_price')";

            $statement = $this->con->prepare($sql);
            $statement->execute();
            mysqli_close($this->con);

        } catch (\Throwable $th) {
            throw $th;
        }
        echo ("<script> alert('Item added to order');
        window.location='place_order.php';
        </script>");
    }

   
    public function get_items_total($order_id)
    {

        $sql = "SELECT sum(total_price) as total , COUNT(*) as total_count FROM `item` WHERE order_ID ='$order_id'";
         $result = $con->query($sql);
         if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
          $sum    = $row["total"];
          $count = $row["total_count"];
        }
      }

    }
}
