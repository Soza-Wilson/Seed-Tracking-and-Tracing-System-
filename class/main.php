<?php

// database connection
$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);



class main
{


  // system generate id functions (the unique id will include shuffled corrent time and random number concantinated with the department)

  function generate_user($department)
  {

    $user_id = "";
    $current_time = time();
    $shuffled_time = str_shuffle($current_time);

    if ($department == "1") {

      $user_id = "ADM" . $shuffled_time;
    }

    if ($department == "3") {

      $user_id = "MAR" . $shuffled_time;
    } else if ($department == "2") {

      $user_id = "PRO" . $shuffled_time;
    } else if ($department == "5") {

      $user_id = "FIN" . $shuffled_time;
    } else if ($department == "4") {

      $user_id = "MNE" . $shuffled_time;
    } else {

      $new_value = substr(strtoupper($department), 0, 3);
      $user_id = $new_value . $shuffled_time;
    }




    return $user_id;
  }


  //user log-in function


  function user_log_in($email, $password)
  {

    $Email = $email;
    $Password = $password;

    global $con;
    $sql = "SELECT * FROM user WHERE email = '$Email' AND password = '$Password'";

    $result =  $con->query($sql);

    $count = $result->num_rows;

    if ($count === 1) {

      $name = $result->fetch_assoc();
      $department =

        session_start();
      $_SESSION['user'] = $name['user_ID'];
      $_SESSION['fullname'] = $name['fullname'];
      $_SESSION['depertment'] = $name['user_type_ID'];
      $_SESSION['position'] = $name['postion'];
      if ($_SESSION['depertment'] == 1) {

        header('Location:admin/admin_dashboard.php');
      } else if ($_SESSION['depertment'] == 2 &&  $_SESSION['position'] == "warehouse_officer") {

        header('Location:production/stock_in.php');
      } else if ($_SESSION['depertment'] == 2 &&  $_SESSION['position'] == "lab_technician") {

        header('Location:production/new_test.php');
      } else if ($_SESSION['depertment'] == 2 &&  $_SESSION['position'] == "field_officer") {

        header('Location:production/grower.php');
      } else if ($_SESSION['depertment'] == 2) {

        header('Location:production/production_dashboard.php');
      } else if ($_SESSION['depertment'] == 3) {

        header('Location:marketing/');
      } else if ($_SESSION['depertment'] == 4) {

        header('Location:production/m&e_dashboard.php');
      } else if ($_SESSION['depertment'] == 5) {

        header('Location:finance/finance_dashboard.php');
      } else {
        echo ("<script> alert('Error on user identifying users type');
        </script>");
      }
    } else {
      echo ("<script> alert('wrong username or password');
        </script>");
    }
  }

  // user logout function
  function user_log_out()
  {
  }



















  function check_user_data($fullname, $department, $dob, $sex, $position, $phone, $email, $password)
  {


    global $con;

    $sql = "SELECT * FROM `user` WHERE email = '$email' OR fullname = '$fullname'";

    $result =  $con->query($sql);

    $count = $result->num_rows;

    if ($count >= 1) {
    } else {

      $this->register_user($fullname, $department, $dob, $sex, $position, $phone, $email, $password);
    }
  }











  function register_crop($crop_name)
  {
    global $con;
    $user_id = $this->generate_user("crop");
    $sql = "INSERT INTO `crop`(`crop_ID`, `crop`) VALUES ('$user_id','$crop_name')";
    $statement = $con->prepare($sql);
    $statement->execute();
  }

  function register_variety($variety_name, $crop_id)
  {


    global $con;
    $user_id = $this->generate_user("variety");
    $sql = "INSERT INTO `variety`(`variety_ID`, `variety`, `crop_ID`) VALUES ('$user_id','$variety_name','$crop_id')";
    $statement = $con->prepare($sql);
    $statement->execute();

    $this->add_price($crop_id, $user_id);
  }

  function add_price($crop_id, $variety_id)
  {

    global $con;
    $price_id = time();
    $sql = "INSERT INTO `price`(`prices_ID`, `crop_ID`, `variety_ID`, `sell_basic`, 
    `sell_pre_basic`, `sell_certified`, `buy_basic`, `buy_pre_basic`, `buy_certified`) VALUES 
    ('$price_id','$crop_id','$variety_id','0.00','0.00',
    '0.00','0.00','0.00','0.00')";

    $statement = $con->prepare($sql);
    $statement->execute();

    echo ("<script> alert('registered');
    </script>");
  }








  function register_user($fullname, $department, $dob, $sex, $position, $phone, $email, $password)
  {


    $user_id = $this->generate_user($department);
    global $con;
    $registered_date = date("d-m-Y");


    $sql = "INSERT INTO `user`(`user_ID`, `user_type_ID`, `fullname`, `DOB`,`sex`, `registered_date`,
                 `postion`, `phone`, `email`, `password`) 
                       VALUES ('$user_id','$department','$fullname','$dob','$sex','$registered_date',
                            '$position','$phone','$email','$password')";

    $statement = $con->prepare($sql);
    $statement->execute();

    echo ("<script> alert('user registered ');
                                            </script>");
  }
  function update_user($user_id, $fullname, $department, $dob, $registered_date, $position, $phone, $email, $password)
  {

    // $sql = "UPDATE `user` SET `user_type_ID`='$department',`fullname`='$fullname',
    //     `DOB`='$dob',`registered_date`='$registered_date',`postion`='$position',`phone`='$phone',`email`='$email',`password`='$password' WHERE `user_ID`=''$user_id'";

    // $sql->execute();
  }

  function delete_user()
  {

    $sql = "DELETE FROM `user` WHERE 0";
  }


  //admin set prices for all products function

  function update_user_profile($user_ID, $fullname, $phone, $email, $password)
  {

    $sql = "UPDATE `user` SET `fullname`='$fullname',`phone`='$phone',
 `email`='$email',`password`='$password' WHERE `user_ID`='$user_ID'";
    global $con;

    $statement = $con->prepare($sql);
    $statement->execute();

    header('Location:user_profile.php');
  }











  function set_sell_prices($crop, $variety, $pre_basic, $basic, $certified)
  {


    global $con;
    $sql = "SELECT `prices_ID` FROM `price` WHERE `crop_ID`='$crop' AND `variety_ID`='$variety'";
    $result =  $con->query($sql);
    $count = $result->num_rows;
    if ($count === 1) {
      $name = $result->fetch_assoc();
      $price_id = $name['prices_ID'];
      $sql = "UPDATE `price` SET `sell_basic`='$basic',`sell_pre_basic`='$pre_basic',`sell_certified`='$certified' WHERE prices_ID='$price_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      echo ("<script> alert('Prices updated ');
      </script>");
    } else {
      echo ("<script> alert('Error : no crop and variety was selected');
        </script>");
    }




    /*global $con;
      $sql=" UPDATE `price` SET `basic`='$basic',`pre_basic`='$pre_basic',`certified`='$certified' WHERE `prices_ID`='$price_id';";
      $statement->execute();
      
        */
  }

  /// set  buy back price
  function set_buy_prices($crop, $variety, $pre_basic, $basic, $certified)
  {


    global $con;
    $sql = "SELECT `prices_ID` FROM `price` WHERE `crop_ID`='$crop' AND `variety_ID`='$variety'";
    $result =  $con->query($sql);
    $count = $result->num_rows;
    if ($count === 1) {



      $name = $result->fetch_assoc();
      $price_id = $name['prices_ID'];
      $sql = "UPDATE `price` SET `buy_basic`='$basic',`buy_pre_basic`='$pre_basic',`buy_certified`='$certified' WHERE prices_ID='$price_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      echo ("<script> alert('Prices updated ');
        </script>");
    } else {
      echo ("<script> alert('Error : no crop and variety was selected');
        </script>");
    }




    /*global $con;
      $sql=" UPDATE `price` SET `basic`='$basic',`pre_basic`='$pre_basic',`certified`='$certified' WHERE `prices_ID`='$price_id';";
      $statement->execute();
      
        */
  }

  //Marketing sales functions 

  // grower order is a little different from the normal order 
   function grower_order($creditor_id,$creditor_name,$crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price,$farm_id){

    global $con;
      $order_ID = $this->generate_user("order");
      $user = $_SESSION["user"];
      $date = date("d-m-Y");
      $time = date("H:i:s");
         
      $sql ="INSERT INTO `order_table`(`order_ID`, `order_type`,
       `customer_id`, `customer_name`, `order_book_number`, 
       `user_ID`, `status`, `date`, `time`, `count`, `total_amount`) 
      VALUES ('$order_ID','grower_order','$creditor_id','$creditor_name',
      '-','$user','pending','$date','$time','1','$total_price')";

        $statement = $con->prepare($sql);
        $statement->execute(); 
        
        $sql= "UPDATE `farm` SET `order_status`='confirmed' WHERE `farm_ID`='$farm_id'";
        $statement = $con->prepare($sql);
        $statement->execute();
  
        $this->add_order_item($order_ID, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);






   }

  function temp_data($data_result, $order_note_number,$order_type, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price)
  {

    // sessions for holding temp data when order is in progress

    if (empty($_SESSION['order'])) {
      global $con;
      
      $order_ID = $this->generate_user("order");
      $_SESSION['order'] =  $order_ID;
      $_SESSION['customer_ID'] = $data_result[0];
      $_SESSION['customer_name'] = $data_result[2];
      $_SESSION['type'] = $order_type;

      

    

      $sql = "INSERT INTO `order_table`(`order_ID`) VALUES
    ('$order_ID')";
      $statement = $con->prepare($sql);
      $statement->execute();

      $this->add_order_item($order_ID, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);
    }
  }

  function check_order_book_number($order, $order_book_number, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price)
  {

    $this->add_order_item($order, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);

    // global $con;
    // $sql = "SELECT * FROM `order_table` WHERE `order_book_number`='$order_book_number'";
    // $result =  $con->query($sql);
    // $count = $result->num_rows;
    // if ($count >= 1) {
    //   echo ("<script> alert('Error: Order book number already exists ');
    //                                         </script>");
    // } else {



    //   $this->add_order_item($order, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);
    // }
  }











  function place_order()
  {

   
    $temp =  $_SESSION['order'];
 

    echo ("<script> alert('$temp!');
     </script>");

   // checking is order has items added 

    if (empty($temp)) {


      echo ("<script> alert('No items add to order !');
    </script>");
    } else {
      
      global $con;
      $status = "pending";
      $date = date("d-m-Y");
      $time = date("H:i:s");
      $sum = "";
      $count = "";
      $user_ID =  $_SESSION['user'];
      $order_ID = $_SESSION['order'];
      $order_type = $_SESSION['type'];
      $customer_id = $_SESSION['customer_ID'];
      $customer_name = $_SESSION['customer_name'];
      
     
      
      



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
        

        $sql = " UPDATE `order_table` SET `order_type`=' $order_type',
      `customer_id`='$customer_id',`customer_name`='$customer_name',`user_ID`='$user_ID',
      `status`='$status',`date`='$date',`time`='$time',
      `count`='$count',`total_amount`='$sum' WHERE order_ID ='$order_ID'";

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

      
      }

      else{

        echo ("<script> alert('Can not process order. price not added to products !');
        </script>");
      }
    }
  }
















  function order_process($order_book_number, $user_id, $customer_name, $customer_type, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $count, $total_price)
  {
    // starting order process by generating order ID and and startying the order session
    $check_cat = $_SESSION['order'];

    if (empty($check_cat)) {

      $order_ID = $this->generate_user("order");

      $order_date = date("d-m-Y");
      $order_time = date("H:i:s");
      global $con;

      $sql = "INSERT INTO `order_table`(`order_ID`, 
     `customer_name`, `order_book_number`, `user_ID`,
      `status`, `date`, `time`, `count`, `total`) VALUES
      ($order_ID','$customer_name',''$order_book_number','$user_id',
      'pending','$order_date','$order_time','$count','$total_price')";
      $statement = $con->prepare($sql);
      $statement->execute();

      $this->add_order_item($order_ID, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);
    } else {

      $this->add_order_item($_SESSION['order'], $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price);
    }
  }




















  function add_order_item($order_ID, $crop, $variety, $class, $order_quantity, $price_per_kg, $discount_price, $total_price)
  {
    global $con;
    $item_ID = $this->generate_user("item");


   
    $sql = "INSERT INTO `item`(`item_ID`, `order_ID`, `crop_ID`,
     `variety_ID`, `class`, `quantity`, `price_per_kg`, `discount_price`, 
     `total_price`) VALUES ('$item_ID','$order_ID','$crop','$variety','$class',
     '$order_quantity','$price_per_kg','$discount_price','$total_price')";

    $statement = $con->prepare($sql);
    $statement->execute();
     


      echo ("<script> alert('Item added to order');
      window.location='place_order.php';
      </script>");

  
  }

  /// update order

  function update_order()
  {

    $sql = "UPDATE `order_table` SET `order_ID`='[value-1]',`order_book_number`='[value-2]',
        `user_ID`='[value-3]',`customer_name`='[value-4]',`crop`='[value-5]',`variety`='[value-6]',
        `class`='[value-7]',`order_quantity`='[value-8]',`price_per_kg`='[value-9]',`total_price`='[value-10]' WHERE 1";
  }
  function  process_order()
  {
  }

  function delete_order()
  {
  }

  function process_receipt()
  {
  }































  // production stock in functions 



  function stock_in($creditor, $certificate, $farm, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $supporting_dir)
  {





    $stock_ID = $this->generate_user("stock");
    $user_ID = $_SESSION['user'];
    $date = date("d-m-Y");
    $time = date("H:i:s");
    global $con;  

    if($source == "External"){

      $available_quantity = $quantity;
    }
    else if($source == "MUSECO"){
 
      $available_quantity =0;

    }


    $sql = "INSERT INTO `stock_in`(`stock_in_ID`, `user_ID`, `certificate_ID`, `farm_ID`,
     `creditor_ID`, `source`, `crop_ID`, `status`, `variety_ID`, `class`, `SLN`,
      `bincard`, `number_of_bags`, `quantity`, `used_quantity`, `available_quantity`,`processed_quantity`,`grade_outs_quantity`, `trash_quantity`,
       `description`, `supporting_dir`, `date`, `time`) VALUES ('$stock_ID','$user_ID',
       '$certificate','$farm','$creditor','$source','$crop','$status','$variety','$class',
       '$srn','$bincard','$bags','$quantity',0,$available_quantity,0,0,0,'$description',
       '$supporting_dir','$date','$time')";

    $statement = $con->prepare($sql);
    $statement->execute();

    $temp_class = "";
    $temp_amount = "";

    if ($class == "pre_basic") {

      $temp_class = "buy_pre_basic";
    } else if ($class == "basic") {
      $temp_class = "buy_basic";
    } else if ($class == "certified") {
      $temp_class = "buy_certified";
    }



    //calculate amount add stock in transaction 

    $sql = "SELECT * FROM 
    `price` WHERE `crop_ID` = '$crop' AND `variety_ID`= '$variety'";
    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $temp_amount = $row["$temp_class"];
      }
    }
    $calculated_amount = $temp_amount * $quantity;
    $account_funds = "";
    $transaction_ID = $transaction_ID = $this->generate_user("transaction");
    $trans_type = "stock_in";

    // register transaction 

    $sql = "INSERT INTO `transaction`(`transaction_ID`, `type`, `action_name`,
     `action_ID`, `C_D_ID`, `amount`, `trans_date`, `trans_time`, `trans_status`, `user_ID`) VALUES
     ('$transaction_ID','creditor_buy_back','$trans_type','$stock_ID','$creditor',' $calculated_amount',
     '$date','$time','payment_pending','$user_ID')";

    $statement = $con->prepare($sql);
    $statement->execute();

    ///   update creditor funds account 
    $sql = "SELECT * FROM `creditor` WHERE `creditor_ID`= $creditor";
    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $account_funds = $row["account_funds"];
      }
    }
    $temp_funds = $account_funds - $calculated_amount;
    $sql = "UPDATE `creditor` SET `account_funds`='$temp_funds' WHERE `creditor_ID`='$creditor'";

    $statement = $con->prepare($sql);
    $statement->execute();

    echo ("<script> alert('New entry added');
       </script>");
  }























  /// production: stock out function 
  //production: stock out function is updating the item table , stock in table and its inserting data in the stock out table 
  // data is inserted depending on the quantity of the item and the stock in which the item is being subtracted from


  function stock_out($item_ID, $stock_in_ID, $item_quantity, $stock_in_quantity, $order_ID, $amount)
  {

    $stock_out_ID = $this->generate_user('stock_out');
    $user_ID = $_SESSION['user'];
    $date = date("d-m-Y");
    $time = date("H:i:s");
    global $con;

    $intItemQuantity = (int) $item_quantity;
    $intStockInQuantity = (int) $stock_in_quantity;

    if ($intStockInQuantity >= $intItemQuantity) {



      $sql = "INSERT INTO `stock_out`(`stock_out_ID`, `item_ID`, `stock_in_ID`, `order_ID`, `Quntity`, `amount`, `date`, `time`, `user_ID`) VALUES
       ('$stock_out_ID','$item_ID','$stock_in_ID','$order_ID','$item_quantity',$amount,'$date','$time','$user_ID')";


      $statement = $con->prepare($sql);
      $statement->execute();

      $sql = "UPDATE `item` SET `status`='complete' WHERE `item_ID`='$item_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();

      $sql = "UPDATE `stock_in` SET `used_quantity`='$item_quantity',`available_quantity`= available_quantity-'$item_quantity' WHERE`stock_in_ID`='$stock_in_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();

      /// update item stock .... contradiction with the stock out table .. but will leave it as it is... maybe will refactor later

      $sql = "UPDATE `item` SET `stock_out_quantity`='$item_quantity' WHERE`item_ID`='$item_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();
    } else if ($intItemQuantity >=  $intStockInQuantity) {





      $sql = "INSERT INTO `stock_out`(`stock_out_ID`, `item_ID`, `stock_in_ID`, `order_ID`, `Quntity`, `amount`, `date`, `time`, `user_ID`) VALUES
       ('$stock_out_ID','$item_ID','$stock_in_ID','$order_ID','$stock_in_quantity','$amount','$date','$time','$user_ID')";

      $statement = $con->prepare($sql);
      $statement->execute();

      $sql = "UPDATE `item` SET `status`='partly' WHERE `item_ID`='$item_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();

      $sql = "UPDATE `stock_in` SET `used_quantity`='$stock_in_quantity',`available_quantity`='0' WHERE`stock_in_ID`='$stock_in_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();


      /// update item stock .... contradiction with the stock out table .. but will leave it as it is... maybe will refactor later

      $sql = "UPDATE `item` SET `stock_out_quantity`='$item_quantity' WHERE`item_ID`='$item_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();
    }
  }
















  //production Reverse stock out (reverse stock out transaction from order item) 
  function reverse_stock_out($stock_out_ID, $item_ID, $item_quantity, $stock_in_ID)
  {

    global $con;

    $sql = "UPDATE `item` SET `status`='not added' WHERE `item_ID`='$item_ID'";

    $statement = $con->prepare($sql);
    $statement->execute();

    $sql = "UPDATE `stock_in` SET `used_quantity`= used_quantity - '$item_quantity',`available_quantity`= available_quantity + '$item_quantity' WHERE`stock_in_ID`='$stock_in_ID'";

    $statement = $con->prepare($sql);
    $statement->execute();

    $sql = "DELETE FROM `stock_out` WHERE `stock_out_ID` = '$stock_out_ID'";

    $statement = $con->prepare($sql);
    $statement->execute();

    $sql = "UPDATE `item` SET `stock_out_quantity`= stock_out_quantity - '$item_quantity' WHERE`item_ID`='$item_ID'";

    $statement = $con->prepare($sql);
    $statement->execute();
  }








  ///production process order 

  function production_process_order($order_ID, $C_D_ID, $type, $printSave)
  {


    global $con;
    $pdfType = "dispatch_note";
    $user_ID = $_SESSION['user'];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $transaction_ID = $this->generate_user("transaction");
    $amount = "";
    $total_quantity = "";
    //step 0: pass data to dispatch note pdf function


    // step 1: update order to process

    $sql = "UPDATE `order_table` SET `status` ='processed' WHERE `order_ID` = '$order_ID'";

    $statement = $con->prepare($sql);
    $statement->execute();

    //step 2: calculate the total amount for the order

    $sql = "SELECT sum(amount) as total_amount,sum(Quntity) as total_quantity  FROM `stock_out`WHERE order_ID ='$order_ID'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        $amount = $row["total_amount"];
        $total_quantity = $row["total_quantity"];
      }
    }


    //step 3: register transaction 

    $sql = "INSERT INTO `transaction`(`transaction_ID`, `type`, `action_ID`, `C_D_ID`, `amount`, 
    `trans_date`, `trans_time`, `trans_status`, `user_ID`) VALUES
     ('$transaction_ID','$type','$order_ID','$C_D_ID',
     '$amount','$date','$time','payment_pending','$user_ID')";

    $statement = $con->prepare($sql);
    $statement->execute();

    //step 4 deduct funds from customer account, call create pdf class for dispatch notes and delivery notes etc

    if ($type == "customer" || $type == "b_to_b_order" || $type == "agro_dealer_order") {

      $temp_amount = (int)$amount;

      $sql = "UPDATE `debtor` SET `account_funds`= account_funds-$temp_amount WHERE `debtor_ID`= '$C_D_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();

      if ($printSave == "print") {

        header("Location:../class/pdf_handler.php? order_ID=$order_ID & transaction_ID=$transaction_ID & total_quantity=$total_quantity & type=$pdfType");
      } else if ($printSave == "save") {

        header('location:stock_out.php');
      }
      
    } elseif ($type == "grower_order") {

  
      $temp_amount = (int)$amount;
      $sql = "UPDATE `creditor` SET `account_funds`=account_funds-$temp_amount WHERE `creditor_ID`= '$C_D_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();

      if ($printSave == "print") {

        header("Location:../class/pdf_handler.php? order_ID=$order_ID & transaction_ID=$transaction_ID & total_quantity=$total_quantity & type=$pdfType");
      } else if ($printSave == "save") {

        header('location:stock_out.php');
      }
    }
  }










  /// ledger function
  function ledger_new_entry($ledger_type, $description, $amount, $bank_ID, $transaction_ID, $reference_amount, $custome)
  {
    global $con;
    $ledger_ID = $this->generate_user('ledger');
    $user_ID = $_SESSION['user'];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $amount_to_bank = intval($amount);
    $bank_reference_amount = $this->get_reference_amount($amount, $bank_ID, $ledger_type);


    if ($custome == "user") {

      $sql = "INSERT INTO `ledger`(`ledger_ID`, `ledger_type`, `description`,
    `amount`, `bank_ID`, `transaction_ID`, `user_ID`,
     `reference_bank_amount`, `entry_date`, `entry_time`) VALUES 
    ('$ledger_ID','$ledger_type','$description','$amount','$bank_ID',
    '$transaction_ID','$user_ID','$bank_reference_amount','$date','$time')";


      $statement = $con->prepare($sql);
      $statement->execute();
      if ($ledger_type == "debit") {

        $sql = "UPDATE `bank_account` SET 
        `account_funds`= account_funds+$amount_to_bank WHERE `bank_ID`='$bank_ID'";

        $statement = $con->prepare($sql);
        $statement->execute();

        header('Location:finance_ledger.php');
      } else if ($ledger_type == "credit") {




        $sql = "UPDATE `bank_account` SET 
        `account_funds`= account_funds-$amount_to_bank WHERE `bank_ID`='$bank_ID'";

        $statement = $con->prepare($sql);
        $statement->execute();

        header('Location:finance_ledger.php');
      }
    } else if ($custome == "system") {


      $sql = "INSERT INTO `ledger`(`ledger_ID`, `ledger_type`, `description`,
    `amount`, `bank_ID`, `transaction_ID`, `user_ID`,
     `reference_bank_amount`, `entry_date`, `entry_time`) VALUES 
    ('$ledger_ID','$ledger_type','$description','$amount','$bank_ID',
    '$transaction_ID','$user_ID','$bank_reference_amount','$date','$time')";


      $statement = $con->prepare($sql);
      $statement->execute();
    }
  }








  // get bank reference amount
  function get_reference_amount($ledger_trans_amount, $bank_account_id, $type)
  {
    global $con;
    $reference_amount = "";
    $account_funds = "";
    $sql = "SELECT  `account_funds` FROM `bank_account` WHERE `bank_ID` ='$bank_account_id'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $account_funds = $row["account_funds"];
      }
    }

    if ($type = "debit") {
      $reference_amount = (int)$ledger_trans_amount + (int)$account_funds;
    } else if ($type = "credit") {
      $reference_amount = (int)$ledger_trans_amount - (int)$account_funds;
    }
    return $reference_amount;
  }







  //add creditor function 
  function add_creditor($source, $name, $phone, $email, $description, $files)
  {

    $creditor_ID = $this->generate_user("creditor");
    $user_ID = $_SESSION['user'];
    $date = date("d-m-Y");
    global $con;

    $sql = "INSERT INTO `creditor`(`creditor_ID`, `source`, `name`, `phone`, `email`, `description`, `user_ID`, `creditor_files`, `registered_date`, `account_funds`) VALUES
  ('$creditor_ID','$source','$name','$phone','$email','$description','$user_ID','$files','$date',0)";


    $statement = $con->prepare($sql);
    $statement->execute();

    echo ("<script> alert('added!');
    </script>");

    if ($source == "External") {
      header('Location:stock_in.php');
    } else {

      header('Location:grower.php');
    }
  }














  // production certicate functions 


  function add_certificate($lot_number, $crop, $variety, $class, $type, $source, $source_name, $date_tested, $expire_date, $certificate_quantity, $directory)
  {
    $user_ID = $_SESSION['user'];
    $added_date = date("d-m-Y");
    global $con;


    $sql = "INSERT INTO `certificate`(`lot_number`, `crop_ID`, `variety_ID`, `class`, `type`, `source`, 
                      `source_name`, `date_tested`, `expiry_date`, `date_added`, `certificate_quantity`, 
                      `available_quantity`, `assigned_quantity`, `status`, `directory`, `user_ID`) VALUES 
                      ('$lot_number','$crop','$variety','$class','$type','$source','$source_name',
                      '$date_tested','$expire_date','$added_date','$certificate_quantity',
                      '$certificate_quantity','$certificate_quantity','available','$directory','$user_ID')";

    $statement = $con->prepare($sql);
    $statement->execute();

    echo ("<script> alert('certificate added!');
                                </script>");
  }







  //production register grower's farm


  function register_farm(
    $hectors,
    $crop,
    $variety,
    $class,
    $region,
    $district,
    $area_name,
    $address,
    $physical_address,
    $epa,
    $grower_ID,
    $previous_year,
    $other_year,
    $main_certificate,
    $main_quantity,
    $male_certificate,
    $male_quantity,
    $female_certificate,
    $female_quantity
  ) {




    $farm_ID = $this->generate_user("farm");
    $registered_date = date("d-m-Y");
    $user_ID = $_SESSION['user'];
    global $con;

    if (!empty('$main_quantity')) {
      
      $sql ="INSERT INTO `farm`(`farm_ID`, `Hectors`, `crop_species`, 
      `crop_variety`, `class`, `region`, `district`, `area_name`,
       `address`, `physical_address`, `EPA`, `user_ID`, `creditor_ID`, 
       `registered_date`, `previous_year_crop`, `other_year_crop`, `order_status`,
        `main_lot_number`, `main_quantity`, `male_lot_number`, `male_quantity`,
         `female_lot_number`, `female_quantity`) VALUES ('$farm_ID','$hectors',
         '$crop','$variety','$class','$region','$district','$area_name',
         '$address','$physical_address','$epa','$user_ID','$grower_ID','$registered_date','$previous_year',
         '$other_year','unconfirmed','$main_certificate','$main_quantity','$male_certificate','$male_quantity','$female_certificate','$female_quantity')";



      $statement = $con->prepare($sql);
      $statement->execute();

      if ($statement = true) {

        echo ("<script> alert('farm added!');
                                </script>");

        $this->edit_quantity_certificate($main_certificate, $main_quantity, $male_certificate, $male_quantity, $female_certificate, $female_quantity, $variety);
      }
    }
  }




function grower_order_price($crop,$variety,$class){

  global $con;

   $sql="SELECT `prices_ID`, `crop_ID`, 
   `variety_ID`, `sell_basic`,
    `sell_pre_basic`, 
    `sell_certified`,
     `buy_basic`,
     `buy_pre_basic`, `buy_certified` FROM `price` WHERE `crop_ID` ='$crop' AND `variety_ID`='$variety'";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $basic= $row['sell_basic'];
        $pre_basic = $row['sell_pre_basic'];
        

    }

  if($class=="certified"){
    

   return $basic;

  }
  else if($class=="basic"){

    return $pre_basic;
  }
 
  


}

}




  // assign ungraded seed for processing

  function assign_prcessing_quantity($stock_in_id, $assigned_quantity)
  {
      

    global $con;
     $grade_ID = $this->generate_user("grade_seed");
    $user_ID = $_SESSION['user'];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $pdfType = "handover";
    $total_quantity= "";
    $stock_in_quantity = "";
    

    //Checking if all graded seed quantity are less than or equal to stock_in quantity

    $sql="SELECT SUM(assigned_quantity) AS total_graded, stock_in.quantity FROM `grading`
    INNER JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID WHERE grading.stock_in_ID = '$stock_in_id'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_quantity= $row['total_graded'];
            $stock_in_quantity = $row['quantity'];
            
 
        }
        // echo ("<script> alert('$total_quantity.$stock_in_quantity');
        // window.location='process_seed.php';
        // </script>");

        $stock = (int)$stock_in_quantity;
        $total = (int)$total_quantity+(int)$assigned_quantity;


       

        if ($total>$stock){
         
            //echo ("<scriTY\t> alert('$stock.$total'); </script>");

          echo ("<script> alert('Seed can not be assigned for processing, quantity exceeding available stock');
          window.location='grading.php';
           </script>");
  
  
        }
  
        else{
          $sql = "INSERT INTO `grading`(`grade_ID`, `assigned_date`, `assigned_time`, `assigned_quantity`, `used_quantity`, `available_quantity`, `stock_in_ID`,
          `assigned_by`, `received_ID`, `received_name`, `status`, `file_directory`) VALUES 
          ('$grade_ID','$date','$time','$assigned_quantity','0','$assigned_quantity','$stock_in_id','$user_ID','-','-','unconfirmed','-')";
      
          $statement = $con->prepare($sql);
          $statement->execute();
      
          // update stock in available quantity by subtracting assigned quantity with available 
      
      
      
          // create PDF file for assigned seed
      
          header("Location:../class/pdf_handler.php? grade_id=$grade_ID & type=$pdfType");
      
      
      
          // $sql = "INSERT INTO `grading`(`grade_ID`, `date`, `time`, `grade_out_quantity`, `trash_quantity`, `stock_in_ID`, `user_ID`) VALUES 
          // ('$grade_ID','$date','$time','$grade_out_quantity','$trash_quantity','$stock_in_id','$user_ID')";
      
      
      
          // update stock in status and available quantity  
      
          // $t_g_quantity = $grade_out_quantity + $trash_quantity;
      
  
          
        }
      
      }


      
       
      
    
     


   

  


    

    // $sql = "UPDATE `stock_in` SET `status`='uncertified',`available_quantity`= available_quantity-$t_g_quantity WHERE `stock_in_ID`='$stock_in_id'";

    // $statement = $con->prepare($sql);
    // $statement->execute();

    // echo ("<script> alert('saved!');
    // </script>");
  }

  function handover_conformation($receive_id, $received_name, $file_directory, $grade_id, $passed_quantity, $stock_in_ID)
  {
    global $con;

    $sql = "UPDATE `grading` SET `received_ID`='$receive_id',
    `received_name`='$received_name',`status`='unprocessed',
    `file_directory`='$file_directory' WHERE `grade_ID`='$grade_id'";
    $statement = $con->prepare($sql);
    $statement->execute();




    // updating stock in proceessed quantity field when hand over is complete 


    $sql = "UPDATE `stock_in` SET `processed_quantity`='$passed_quantity' WHERE `stock_in_ID` = '$stock_in_ID'";
    $statement = $con->prepare($sql);
    $statement->execute();
  }





  // clean and process seed

  function process_seed($grade_ID, $type, $assigned_quantity, $grade_outs_quantity, $trash_quantity,$available_quantity,$process_ID, $passed_process_type_id)
  {


    $process_type_ID = $this->generate_user("pr_type");
    global $con;

    //Check if all processed transaction are greater are not more than the stock in quantity 

   // $sql="SELECT SUM(assigned_quantity) AS total_processed FROM `process_seed`WHERE `process_ID` =''";


        // echo("<script>$available_quantity</script>");


    

    if ($type == "Cleaning ") {



      $process_ID = $this->generate_user("process");

      $user = $_SESSION['user'];
      $process_date = date("Y-m-d");
      $process_time = date("H:i:s");

      // update available quantity in gr
      $this->update_available_quantity_grading($grade_ID,$available_quantity,$assigned_quantity);

      $sql = "INSERT INTO `process_seed`(`process_ID`, `assigned_quantity`, `processed_date`, `processed_time`, `grade_ID`, `user_ID`) VALUES 
          ('$process_ID','$assigned_quantity','$process_date','$process_time','$grade_ID','$user')";

      $statement = $con->prepare($sql);
      $statement->execute();


      $processed_quantity = $this->get_processed_quantity($trash_quantity, $grade_outs_quantity, $assigned_quantity);

      $sql = "INSERT INTO `process_type`(`process_type_ID`, `process_ID`, `grade_outs_quantity`, `processed_quantity`, `trash_quantity`, `process_type`) 
        VALUES ('$process_type_ID','$process_ID','$grade_outs_quantity','$processed_quantity','$trash_quantity','$type')";

      $statement = $con->prepare($sql);
      $statement->execute();
      $this->update_available_quantity_grading($grade_ID,$available_quantity,$assigned_quantity);

       echo ("<script> alert('saved!');
       window.location='process_seed.php';
       </script>");
     
    } else {

      $processed_quantity = $this->get_processed_quantity($trash_quantity, $grade_outs_quantity, $assigned_quantity);


      // update cleaning status (i was lazy at the end)


      $sql = "UPDATE `process_type` SET
        `process_type`='Cleaning_' WHERE `process_type_ID`='$passed_process_type_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      $sql = "INSERT INTO `process_type`(`process_type_ID`, `process_ID`, `grade_outs_quantity`, `processed_quantity`, `trash_quantity`, `process_type`) 
        VALUES ('$process_type_ID','$process_ID','$grade_outs_quantity','$processed_quantity','$trash_quantity','$type')";

      $statement = $con->prepare($sql);
      $statement->execute();

      $sql ="UPDATE `stock_in` INNER JOIN grading ON grading.stock_in_ID = stock_in.stock_in_ID INNER JOIN process_seed ON
       process_seed.grade_ID = grading.grade_ID SET stock_in.status = 'uncertified' WHERE process_seed.process_ID='$process_ID'";

      $statement = $con->prepare($sql);
      $statement->execute();

      echo ("<script> alert('saved!');
      window.location='process_seed.php';
      </script>");
    }
  }


  function get_processed_quantity($trash_quantity, $grade_outs_quantity, $assigned_quantity)
  {
    $t = (int)$trash_quantity + (int)$grade_outs_quantity;
    $processed_quantity = (int)$assigned_quantity - $t;
    return $processed_quantity;
  }




  function update_available_quantity_grading($grade_id, $available_quantity, $assigned_quantity)
  {  

    global $con;
    $new_available_quantity = (int)$available_quantity - (int)$assigned_quantity;
    $sql = "UPDATE `grading` SET `available_quantity`=' $new_available_quantity' WHERE `grade_ID`='$grade_id'";

    $statement = $con->prepare($sql);
    $statement->execute();
  }








  // function updating certificate quantity after registering farm 

  function edit_quantity_certificate(
    $main_lot_number,
    $main_quantity,
    $male_lot_number,
    $male_quantity,
    $female_lot_number,
    $female_quantity,
    $variety
  ) {

    global $con;

    // dont know this buggy code is working ,but its working ( code for hybrid is working for normal seed )


    if ($variety == 'VT002' || $variety == 'VT003' || $variety == 'VT004') {


      echo ("<script> alert('hybrid');
                                </script>");


      $sql1 = "UPDATE `certificate` SET `assigned_quantity`= assigned_quantity - $male_quantity
                                WHERE `lot_number`= '$male_lot_number'";


      $statement2 = $con->prepare($sql1);
      $statement2->execute();



      $sql2 = "UPDATE `certificate` SET `assigned_quantity`= assigned_quantity - $female_quantity
                                WHERE `lot_number`= '$female_lot_number'";

      $statement2 = $con->prepare($sql2);
      $statement2->execute();
    } else {


      $sql = "UPDATE `certificate` SET `assigned_quantity`= assigned_quantity - $main_quantity
                                WHERE `lot_number`= '$main_lot_number'";

      $statement = $con->prepare($sql);
      $statement->execute();
    }
  }
  // function register inspection log 




  ///change date format from yyyy-mm-dd to dd-mm-yyyy

  function change_date_format($date)
  {
    $date = date_create($date);
    $date = date_format($date, "d-m-Y");
    return $date;
  }


  function register_inspection()
  {



    $sql = "INSERT INTO `inspection`(`inspection_ID`, `date`, `time`, `farm_ID`,
  `user_ID`, `type`, `isolation`, `planting_pattern`, `off_type_percetage`,
   `pest_disease_incidence`, `defective_plants`, `pollinating_females_percentage`,
    `female_receptive_skills_percentage`, `male_leimination`, `off_type_cobs_at_shelling`, 
    `defective_cobs_at_shelling`, `remarks`, `image_directory`) VALUES ('[value-1]','[value-2]',
    '[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]',
    '[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]','[value-18]')";
  }
















  // function register lab test

  function register_lab_test($stock_ID, $germ_perc, $shell_perc, $purity_perc, $defects_perc,$moisture_content,$oil_content, $grade, $crop, $variety, $farm)
  {


    $sql = "SELECT `test_ID`, `test_status` FROM `lab_test` WHERE stock_in_ID ='$stock_ID' AND test_status='active' ";

    global $con;
    $result =  $con->query($sql);
    if ($result->num_rows > 0) {

      echo ("<script> alert('action failed (test is already active)');
      </script>");
      $nn = 1;
      if ($nn == 1) {

        header('Location:new_test.php');
      }
    } else {


      $status = '';
      if ($grade == 'passed') {

        $status = 'active';
      } elseif ($grade == 'failed') {

        $status = 'inactive';
      }

      $test_ID = $this->generate_user("test");
      $test_date = date("d-m-Y");
      $test_time = date("H:m:i");
      $user_ID = $_SESSION['user'];
      global $con;

    
     
     


      $sql = "INSERT INTO `lab_test`(`test_ID`, `date`, `time`, `crop_ID`, `variety_ID`, 
      `farm_ID`, `germination_percentage`, `moisture_content`, `oil_content`,
       `shelling_percentage`, `purity_percentage`, `defects_percentage`, `grade`,
       `stock_in_ID`, `user_ID`, `test_status`) VALUES ('$test_ID','$test_date',
      '$test_time','$crop','$variety','$farm','$germ_perc','$moisture_content','$oil_content','$shell_perc','$purity_perc','$defects_perc',
      '$grade','$stock_ID','$user_ID','$status')";



      $statement = $con->prepare($sql);
      $statement->execute();
      header('Location:new_test.php');
    }
  }


















  /// marketing functions 

  // register agro dealer 
  function add_agro_dealer($name, $phone, $email, $debtor_type, $debtor_files)
  {


    if (!empty($name)) {

      $sql = "SELECT * FROM `debtor` WHERE `name` = '$name'";

      global $con;
      $result =  $con->query($sql);
      if ($result->num_rows > 0) {

        echo ("<script> alert('agro dealer name already registered');
      </script>");
      } else {

        $agro_dealer_ID = $this->generate_user("debtor");
        $user_ID = $_SESSION['user'];
        $register_date = date("d-m-Y");

        global $con;


        $sql = "INSERT INTO `debtor`(`debtor_ID`, `name`, `phone`, `email`, `description`, `debtor_type`, `user_ID`, `debtor_files`, `registered_date`,`account_funds`) 
      VALUES ('$agro_dealer_ID','$name','$phone','$email','-','$debtor_type','$user_ID','$debtor_files','$register_date',0)";

        $statement = $con->prepare($sql);
        $statement->execute();

        header('Location:agro_dealer.php');
      }
    }
  }


















  //register b_to_b

  function register_B_to_B($name, $description, $phone, $email, $debtor_type, $debtor_files)
  {


    if (!empty($name)) {



      $sql = "SELECT * FROM `debtor` WHERE `name` = '$name' AND `debtor_type` = 'b_to_b'";

      global $con;
      $result =  $con->query($sql);
      if ($result->num_rows > 0) {

        echo ("<script> alert('Business name already registered');
     </script>");
      } else {

        $agro_dealer_ID = $this->generate_user("debtor");
        $user_ID = $_SESSION['user'];
        $register_date = date("d-m-Y");
        global $con;


        $sql = "INSERT INTO `debtor`(`debtor_ID`, `name`, `phone`, `email`, `description`, `debtor_type`, `user_ID`, `debtor_files`, `registered_date`,`account_funds`) 
     VALUES ('$agro_dealer_ID','$name','$phone','$email','$description','$debtor_type','$user_ID','$debtor_files','$register_date',0)";

        $statement = $con->prepare($sql);
        $statement->execute();

        header('Location:b_to_b.php');
      }
    }
  }







  //register customer 
  function register_customer($name, $phone)
  {



    $customer_ID = $this->generate_user("debtor");
    $user_ID = $_SESSION['user'];
    $register_date = date("d-m-Y");
    global $con;

    $sql = "INSERT INTO `debtor`(`debtor_ID`, `name`, `phone`, `debtor_type`, `user_ID`,`registered_date`,`account_funds`) VALUES 
      ('$customer_ID','$name','$phone','customer','$user_ID','$register_date',0)";

    $statement = $con->prepare($sql);
    $statement->execute();
  }


  /// add payment 
















  function add_debtor_payment($type, $amount, $dir, $user_id, $transaction_id, $debtor_id, $trans_amount, $trans_status, $cheque_number, $bank_name, $account_name, $description, $save_type, $company_bank_account)
  {

    global $con;
    $payed_amount = "";
    $transaction_amount = "";
    $pdfType = "receipt";

    $newAmount = (int) $amount;
    $newTransAmount = (int) $trans_amount;

    $order_id = "";
    $date = date("d-m-Y");
    $time = date("H:m:i");
    $update_status = "";
    $payment_ID = $this->generate_user("payment");

    $sql = "SELECT * FROM `transaction` WHERE `transaction_ID`='$transaction_id'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        $order_id = $row["action_ID"];
      }
    }

    if ($trans_status == "payment_pending") {
      /// adding new payment

      $sql = "INSERT INTO `payment`(`payment_ID`, `type`, `amount`, `description`, `documents`, `cheque_number`, `bank_name`, `account_name`,`date`, `time`, `user_ID`, `transaction_ID`) VALUES 
      ('$payment_ID','$type','$amount','$description','$dir','$cheque_number','$bank_name','$account_name','$date','$time','$user_id','$transaction_id')";


      $statement = $con->prepare($sql);
      $statement->execute();
      /// checking payment amount and type 

      if ($newAmount < $newTransAmount) {
        $update_status = "partly_payed";
      } else if ($newAmount >= $newTransAmount) {
        $update_status = "fully_payed";
      }

      // update transaction status 

      $sql = "UPDATE transaction SET `trans_status`='$update_status' WHERE `transaction_ID`='$transaction_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      //update debtor funds 

      $sql = "UPDATE debtor set `account_funds` =`account_funds`+'$amount' WHERE `debtor_ID`='$debtor_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      //update bank_account
      $sql = "UPDATE `bank_account` SET `account_funds`=`account_funds`+$amount WHERE `bank_ID`='$company_bank_account'";

      $statement = $con->prepare($sql);
      $statement->execute();

      // update ledger 
      $this->ledger_new_entry("credit", $description, $amount, $company_bank_account, $transaction_id, $amount, "system");

      if ($save_type == "save") {
        header('Location:add_payment.php');
      } else {
        header("Location:../class/pdf_handler.php? order_id=$order_id & debtor_id=$debtor_id & total=$trans_amount & payment_id=$payment_ID & type=$pdfType");
      }
      //header("Location:../class/pdf_handler.php? order_id=$order_id & debtor_id=$debtor_id & total=$trans_amount & payment_id=$payment_ID");
      // header('Location:add_payment.php');


      //generate payment receipt pdf

















    } else if ($trans_status == "partly_payed") {


      $sql = "SELECT sum(amount) as total_amount FROM `payment`WHERE transaction_Id ='$transaction_id'";

      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $total_payment_amount = $row["total_amount"];
        }

        $balance = $total_payment_amount - $amount;
      }
      if ($balance = $amount) {

        $update_status = "fully_payed";

        $sql = "INSERT INTO `payment`(`payment_ID`, `type`, `amount`, `description`, `documents`, `cheque_number`, `bank_name`, `account_name`,`date`, `time`, `user_ID`, `transaction_ID`) VALUES 
          ('$payment_ID','$type','$amount','$description','$dir','$cheque_number','$bank_name','$account_name','$date','$time','$user_id','$transaction_id')";


        $statement = $con->prepare($sql);
        $statement->execute();



        // update transaction status 

        $sql = "UPDATE transaction SET `trans_status`='$update_status' WHERE `transaction_ID`='$transaction_id'";
        $statement = $con->prepare($sql);
        $statement->execute();

        //update debtor funds 

        $sql = "UPDATE debtor set `account_funds` =`account_funds`+'$amount' WHERE `debtor_ID`='$debtor_id'";
        $statement = $con->prepare($sql);
        $statement->execute();

        if ($save_type == "save") {
          header('Location:add_payment.php');
        } else {
          header("Location:../class/pdf_handler.php? order_id=$order_id & debtor_id=$debtor_id & total=$trans_amount & payment_id=$payment_ID & type=$pdfType");
        }
      } else if ($amount < $balance) {

        $update_status = "partly_payed";

        $sql = "INSERT INTO `payment`(`payment_ID`, `type`, `amount`, `description`, `documents`, `cheque_number`, `bank_name`, `account_name`,`date`, `time`, `user_ID`, `transaction_ID`) VALUES 
        ('$payment_ID','$type','$amount','$description','$dir','$cheque_number','$bank_name','$account_name','$date','$time','$user_id','$transaction_id')";


        $statement = $con->prepare($sql);
        $statement->execute();


        // update transaction status 

        $sql = "UPDATE transaction SET `trans_status`='$update_status' WHERE `transaction_ID`='$transaction_id'";
        $statement = $con->prepare($sql);
        $statement->execute();

        //update debtor funds 

        $sql = "UPDATE debtor set `account_funds` =`account_funds`+'$amount' WHERE `debtor_ID`='$debtor_id'";
        $statement = $con->prepare($sql);
        $statement->execute();

        //update ledger

        $this->ledger_new_entry("credit", $description, $amount, $company_bank_account, $transaction_id, $amount, "system");

        if ($save_type == "save") {
          header('Location:add_payment.php');
        } else {
          header("Location:../class/pdf_handler.php? order_id=$order_id & debtor_id=$debtor_id & total=$trans_amount & payment_id=$payment_ID & type=$pdfType");
        }
      } else if ($amount > $balance) {

        
      }
    }
  }









  //register new bank account
  function register_bank_account($bank_name, $account_number)
  {

    global $con;

    $sql = "SELECT * FROM bank_account WHERE `bank_name`='$bank_name' OR `account_number`='$account_number'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {

      echo ("<script> alert('Bank name or Account number already registered');
     </script>");
    } else {
      $bank_ID = $this->generate_user("bank");
      $account_funds = 0;
      $user_ID = $_SESSION['user'];
      $register_date = date("d-m-Y");



      $sql = "INSERT INTO `bank_account`(`bank_ID`, `bank_name`, `account_number`, `account_funds`, `register_date`, `user_ID`)
     VALUES ('$bank_ID','$bank_name','$account_number','$account_funds','$register_date','$user_ID')";

      $statement = $con->prepare($sql);
      $statement->execute();


      echo ("<script> alert('New bank account registered');
       </script>");
    }
  }

  // process payback function

  function add_creditor_payment($amount, $dir, $user_id, $transaction_id, $creditor_id, $trans_amount, $trans_status, $cheque_number, $bank_name, $description)
  {
    // note: trans_status is passed using trans date 
    // insert into payment

    global $con;
    $payed_amount = "";
    $transaction_amount = "";
    $date = date("d-m-Y");
    $time = date("H:m:i");
    $update_status = "";
    $payment_ID = $this->generate_user("payment");

    $newAmount = (int) $amount;
    $newTransAmount = (int)$trans_amount;

    if ($trans_status == "payment_pending") {
      /// adding new payment


      $sql = "INSERT INTO `payment`(`payment_ID`, `type`, `amount`, 
      `description`, `documents`, `cheque_number`, `bank_name`, 
      `account_name`, `date`, `time`, `user_ID`, `transaction_ID`) VALUES
       ('$payment_ID','cheque','$amount','$description','$dir',
       '$cheque_number','-','-','$date','$time','$user_id','$transaction_id')";


      $statement = $con->prepare($sql);
      $statement->execute();
      /// checking payment amount and type 

      if ($newAmount < $newTransAmount) {
        $update_status = "partly_payed";
      } else if ($newAmount >= $newTransAmount) {
        $update_status = "fully_payed";
      }

      // update transaction status 

      $sql = "UPDATE transaction SET `trans_status`='$update_status' WHERE `transaction_ID`='$transaction_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      //update creditor funds 

      $sql = "UPDATE creditor set `account_funds` = `account_funds`+$amount WHERE `creditor_ID`='$creditor_id'";
      $statement = $con->prepare($sql);
      $statement->execute();

      header('Location:add_payment.php');


      // update bank account funds 

      $sql = "UPDATE `bank_account` SET `account_funds`=`account_funds`-$amount WHERE `bank_ID`='$bank_name'";

      $statement = $con->prepare($sql);
      $statement->execute();

      header('Location:add_payback_payment.php');
    } else if ($trans_status == "partly_payed") {


      $sql = "SELECT sum(amount) as total_amount FROM `payment`WHERE transaction_Id ='$transaction_id'";

      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $total_payment_amount = $row["total_amount"];
        }
      }
      $ava_balance = $trans_amount - $total_payment_amount;


      if ($ava_balance == $amount) {

        echo ("<script> alert('$ava_balance');
      </script>");

        $update_status = "fully_payed";

        $sql = "INSERT INTO `payment`(`payment_ID`, `type`, `amount`, 
            `description`, `documents`, `cheque_number`, `bank_name`, 
            `account_name`, `date`, `time`, `user_ID`, `transaction_ID`) VALUES
             ('$payment_ID','cheque','$amount','$description','$dir',
             '$cheque_number','-','-','$date','$time','$user_id','$transaction_id')";


        $statement = $con->prepare($sql);
        $statement->execute();



        // update transaction status 

        $sql = "UPDATE transaction SET `trans_status`='$update_status' WHERE `transaction_ID`='$transaction_id'";
        $statement = $con->prepare($sql);
        $statement->execute();

        //update creditor funds 

        $sql = "UPDATE creditor set `account_funds` =`account_funds`+'$amount' WHERE `creditor_ID`='$creditor_id'";
        $statement = $con->prepare($sql);
        $statement->execute();



        /// Update company bank account


        $sql = "UPDATE `bank_account` SET `account_funds`= `account_funds`-'$amount' WHERE `bank_ID` = '$bank_name'";

        $statement = $con->prepare($sql);
        $statement->execute();

        header('Location:add_payback_payment.php');

        $this->ledger_new_entry("credit", $description, $amount, $bank_name, $transaction_id, $amount, "system");
      } else if ($amount < $ava_balance) {



        $update_status = "partly_payed";

        $sql = "INSERT INTO `payment`(`payment_ID`, `type`, `amount`, 
            `description`, `documents`, `cheque_number`, `bank_name`, 
            `account_name`, `date`, `time`, `user_ID`, `transaction_ID`) VALUES
             ('$payment_ID','cheque','$amount','$description','$dir',
             '$cheque_number','-','-','$date','$time','$user_id','$transaction_id')";


        $statement = $con->prepare($sql);
        $statement->execute();



        // update transaction status 

        $sql = "UPDATE transaction SET `trans_status`='$update_status' WHERE `transaction_ID`='$transaction_id'";
        $statement = $con->prepare($sql);
        $statement->execute();

        //update creditor funds 

        $sql = "UPDATE creditor set `account_funds` =`account_funds`+'$amount' WHERE `creditor_ID`='$creditor_id'";
        $statement = $con->prepare($sql);
        $statement->execute();



        // Update company bank account


        $sql = "UPDATE `bank_account` SET `account_funds`= `account_funds` - '$amount' WHERE `bank_ID` = '$bank_name'";

        $statement = $con->prepare($sql);
        $statement->execute();

        header('Location:add_payback_payment.php');

        //update ledger

        $this->ledger_new_entry("debit", $description, $amount, $bank_name, $transaction_id, $amount, "system");
      } else if ($amount > $ava_balance) {

        echo ("<script> alert('Error Amount greater than required balance ');
    </script>");
      }
    }
  }


  // function create pdf files using f










}
