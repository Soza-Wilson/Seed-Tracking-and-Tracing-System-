<?php

class Order{



function __construct()
{
    
}


function place_order()
{


  $temp =  $_SESSION['order'];


  // checking is order has items added 

  if (empty($temp)) {


    echo ("<script> alert('No items add to order !');
  </script>");
  } else {

    global $con;
    $status = "pending";
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $sum = "";
    $count = "";
    $user_ID =  $_SESSION['user'];
    $order_ID = $_SESSION['order'];
    $order_type = $_SESSION['type'];
    $customer_id = $_SESSION['customer_ID'];
    $customer_name = $_SESSION['customer_name'];
    $lpoFile = $_SESSION['lpoFile'];







    //calculating the total price and count of all items added in the order 
    $sql = "SELECT sum(total_price) as total , COUNT(*) as total_count FROM `item` WHERE order_ID ='$order_ID'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sum    = $row["total"];
        $count = $row["total_count"];
      }
    }



    if (!empty($sum)) {
      /// finalizing order by updating the total of all added atems in the order 


      $sql = " UPDATE `order_table` SET `order_type`='$order_type',
    `customer_id`='$customer_id',`customer_name`='$customer_name',`user_ID`='$user_ID',
    `status`='$status',`date`='$date',`time`='$time',
    `count`='$count',`total_amount`='$sum',`order_files`='$lpoFile' WHERE order_ID ='$order_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();



      unset($_SESSION['order']);
      unset($_SESSION['type']);
      unset($_SESSION['customer_ID']);
      unset($_SESSION['customer_name']);
      unset($_SESSION['order_book_number']);





      echo ("<script> alert('Order placed !!');
      window.location='place_order.php';
       </script>");
    } else {

      echo ("<script> alert('Can not process order. price not added to products !');
      </script>");
    }
  }
}


}