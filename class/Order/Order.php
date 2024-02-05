<?php



spl_autoload_register(function ($class) {
  if (file_exists('../' . $class . '.php')) {
    require_once '../' . $class . '.php';
  } elseif (file_exists($class . '.php')) {
    require_once   $class . '.php';
  }
});







class Order
{

  /**
   * This class handles all functionality for Orders , from storing temp order data up to adding order item, functionality includes 
   * - register new order 
   * - start order sessions 
   * - add order items 
   * - calculate total amount for all order items 
   * - resert order session
   * - register customer order 
   * - register grower order 
   * - register B to B order 
   * 
   * 
   * 
   */


 
  private $status;
  private $date;
  private $time;
  private $user_id;
  private $order_id;
  private $order_type;
  private $customer_id;
  private $customer_name;
  private $lpoFile;
  private $sum;
  private $count;
  private $item_id;
  private $con;


  function __construct()
  {

    $this->status = 'pending';
    $this->date = Util::get_current_date();
    $this->time = Util::get_current_time();
    $this->item_id = Util::generate_id('item');
    $DB = new DbConnection;
    $this->con = $DB->connect();

    $this->get_items_data();
  }


  public function order_temp_data($data_result, $order_note_number, $order_type, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price)
  {

    // sessions for holding temp data when order is in progress
    if (empty($_SESSION['order'])) {
      $order_ID = Util::generate_id("order");
      try {
        //code...
        $this->set_order_session($data_result, $order_ID, $order_type);
        $sql = "INSERT INTO `order_table`(`order_ID`) VALUES
        ('$order_ID')";
        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {
          $this->add_item($order_ID, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);
        }
      } catch (\Throwable $th) {
        throw $th;
      }
    }
  }

  private function set_order_details()
  {

    $this->order_id = $_SESSION['order'];
    $this->user_id = $_SESSION['user'];
    $this->order_type = $_SESSION['type'];
    $this->customer_id = $_SESSION['customer_ID'];
    $this->customer_name = $_SESSION['customer_name'];
    $this->lpoFile = $_SESSION['lpoFile'];
  }



  private function set_order_session($data_result, $order_id, $order_type)
  {
    $_SESSION['order'] = $order_id;
    $_SESSION['customer_ID'] = $data_result[0];
    $_SESSION['customer_name'] = $data_result[2];
    $_SESSION['type'] = $order_type;
  }








  public function place_order()
  {
    // checking is order has items added 
    if (empty($_SESSION['order'])) {
      echo ("<script> alert('No items add to order !');
  </script>");
    } else {

      //  adding order details form session to t local varibles 

      $this->set_order_details();
      //  get and set sum and counter
      $data = $this->get_items_total($this->order_id);
      $this->sum = $data[0];
      $this->count = $data[1];



      if (!empty($this->sum)) {
        /// finalizing order by updating the total of all added atems in the order 
        try {
          $sql = " UPDATE `order_table` SET `order_type`='$this->order_type',
          `customer_id`='$this->customer_id',`customer_name`='$this->customer_name',`user_ID`='$this->user_id',
          `status`='$this->status',`date`='$this->date',`time`='$this->time',
          `count`='$this->count',`total_amount`='$this->sum',`order_files`='$this->lpoFile' WHERE order_ID ='$this->order_id'";

          $statement = $this->con->prepare($sql);
          if ($statement->execute()) {
            $this->reset_order_sessions();
          }
          mysqli_close($this->con);
        } catch (\Throwable $th) {
          throw $th;
        }
        echo ("<script> alert('Order placed !!');
      window.location='../place_order.php';
       </script>");
      } else {

        echo ("<script> alert('Can not process order. price not added to products !');
      </script>");
      }
    }
  }




  private function reset_order_sessions()
  {

    unset($_SESSION['order']);
    unset($_SESSION['type']);
    unset($_SESSION['customer_ID']);
    unset($_SESSION['customer_name']);
    unset($_SESSION['order_book_number']);
  }

  public function approve_order()
  {
  }






  public function admin_approve_order($order_id, $action)
  {

    //  function takes order_id and $action (This can be approve or deny )
    //  the the function checks if the order is a grower order 
    //  if its grower order we update the farm status 


    if ($action == "approve") {

      try {
        //code...
        $sql = "UPDATE `order_table` SET `status`='approved' WHERE `order_ID`='$order_id'";
        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {
          $this->check_farm_order($order_id, "order_approved");

          echo "approved";
        }
      } catch (\Throwable $th) {
        throw $th;
      }
    } else if ("deny") {

      try {
        //code...

        $sql = "UPDATE `order_table` SET `status`='denied' WHERE `order_ID`='$order_id'";
        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {

          $this->check_farm_order($order_id, "order_denied");

          echo "denied";
        }
      } catch (\Throwable $th) {
        throw $th;
      }
    }
  }



  private function  check_farm_order($order_id, $status): void
  {
    try {
      //code...

      $sql = "SELECT `farm_id` FROM `order_table` WHERE  `order_ID`='$order_id'";
      $result = $this->con->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $farm_id = $row["farm_id"];
          $sql = "UPDATE `farm` SET `order_status`='$status' WHERE farm_ID ='$farm_id'";
          $statement = $this->con->prepare($sql);
          $statement->execute();
        }
      }
      mysqli_close($this->con);
    } catch (\Throwable $th) {
      throw $th;
    }
  }





  private function get_items_data(): void
  {
    //getting calculating the total price and count of all items added in the order form the OrderItems Class 
    $items_data = $this->get_items_total($this->order_id);
    $this->sum = $items_data[0];
    $this->count = $items_data[1];
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
      window.location='../place_order.php';
      </script>");
  }


  public function get_items_total($order_id)
  {

    $sql = "SELECT sum(total_price) as total , COUNT(*) as total_count FROM `item` WHERE order_ID ='$order_id' ";
    $result = $this->con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sum = $row["total"];
        $count = $row["total_count"];
      }
      return [$sum, $count];
    }
  }
}
