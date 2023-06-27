<?php



$type_value = "";

include('../class/main.php');

if (isset($_POST['createCertificateTable'])) {
  $data = $_POST['createCertificateTable'];

  $file = "assets/JSON/" . $data[3] . "_order_details.json";

  echo $file;

  $order_details = marketing::get_grower_order_details($data[0]);
  $total = (int)$data[1] * $order_details[0];


  $details = array("price" => "$order_details[0]", "crop_id" => "$order_details[1]", "crop_name" => "$order_details[2]", "variety_id" => "$order_details[3]", "variety_name" => "$order_details[4]");
  if (file_exists($file)) {

    $path = file_get_contents($file);
    $json_data[] = array(json_decode($path));


    if (!empty($json_data[0])) {

      unset($json_data[0]);

      $unsave = json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      if (file_put_contents($file, $unsave)) {
        $final_data = add_data($details);
        file_put_contents($file, $final_data);
      }
    } else {

      echo "
       <option value =''>empty</option>";
    }
  } else {

    echo "
    <option value =''>error</option>";
  }
}
if (isset($_POST['addOrderId'])) {
  $itemData = $_POST['addOrderId'];
  $orderData = marketing::add_hybrid_order($itemData);
}
if (isset($_POST['addOrderItem'])) {
  $itemData = $_POST['addOrderItem'];


  if (marketing::hybrid_item($itemData[0], $itemData[1], $itemData[2], $itemData[3], $itemData[4], $itemData[5], $itemData[6], $itemData[7]) == "registered") {
  }
}

if (isset($_POST['prepareHybridOrder'])) {
  $prepareData = $_POST['prepareHybridOrder'];
  marketing::prepare_hybred_order($prepareData[0],$prepareData[1],$prepareData[2],$prepareData[3],$prepareData[4],$prepareData[5]);
}

//function adding temp data to json file

function add_data($data)
{
  $eco_data = json_encode($data);
  return $eco_data;
}

//delete temp data from json

function delete_data($file)
{

  $json_data = json_decode(file_get_contents($file));
  unset($json_data[0]);

  $unsave = json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  file_put_contents($file, $unsave);
}





if (isset($_POST['search_value'])) {

  $value = $_POST['search_value'];



  if ($_POST['type_value'] == "agro_dealer") {

    $sql = "SELECT * FROM `debtor` WHERE `name` like '%$value%' AND `debtor_type`='agro_dealer'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        $debtor_id = $row["debtor_ID"];
        $debtor = $row["name"];
        $phone = $row["phone"];
      }
      echo "
  <option value ='$debtor_id,$phone,$debtor'>$debtor</option>";
    } else {

      echo "
    <option value ='-'>Agro dealer name not found</option>";
    }
  }


  if ($_POST['type_value'] == "b_to_b") {

    $sql = "SELECT * FROM `debtor` WHERE `name` like '%$value%' AND `debtor_type`='b_to_b'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $debtor_id = $row["debtor_ID"];
        $debtor = $row["name"];
        $des = $row["description"];
      }
      echo "
    <option value ='$debtor_id,$des,$debtor'>$debtor</option>";
    } else {

      echo "
    <option value ='-'>Business not regis
    red</option>";
    }
  }

  if ($_POST['type_value'] == "customer") {

    $sql = "SELECT * FROM `debtor` WHERE `name` like '%$value%' AND `debtor_type`='customer'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $debtor_id = $row["debtor_ID"];
        $debtor = $row["name"];
        $phone = $row["phone"];
      }
      echo "
    <option value ='$debtor_id,$phone,$debtor'>$debtor</option>";
    } else {

      echo "
    <option value ='not_selected'>customer not registered </option>";
    }
  }

  if ($_POST['type_value'] == "grower") {

    $sql = "SELECT * FROM `creditor` WHERE `name` like '%$value%'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $creditor = $row["name"];
        $phone = $row["phone"];
      }
      echo "
    <option value ='$creditor_id,$phone,$creditor'>$creditor</option>";
    } else {

      echo "
    <option value ='-'>grower's phone number</option>";
    }
  }
}





if (isset($_POST['discountRequest'])) {

  $object = new main();
  $object->admin_approval($_POST['approvalId'], $_POST['depertment'], $_POST['discountRequest'], $_POST['action_id'], $_POST['description'], $_POST['request_id'], $_POST['requestedName']);


  echo '
<div class="" >
<label for="bin_card" > Request for approval sent to ADMIN</label>
</div>';
}

if (isset($_POST["checkApprovalCode"])) {

  $approvalCode = $_POST["checkApprovalCode"];
  $approvalId = $_POST["approvalId"];


  $approvalCode = $_POST["checkApprovalCode"];
  $sql = "SELECT * FROM `approval` WHERE `approval_code`='$approvalCode' AND  `approval_ID`='$approvalId'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {

    echo 'valid';
  } else {
    echo 'invalid';
  }
}





if (isset($_POST['customer_value'])) {

  $sql = "SELECT `debtor_ID`, `name`, `phone`, `email`, `description`, `debtor_type`, 
  `user_ID`, `debtor_files`, `registered_date`, `account_funds` FROM `debtor` WHERE  `debtor_type` = '' AND `name` like %''%";

  $result =  $con->query($sql);
  if ($result->num_rows > 0) {
  } else {

    $object = new main();
    $object->register_customer($_POST['customer_name'], $_POST['customer_phone']);
  }
}


if (!empty($_POST['type_value'])) {

  if ($_POST['type_value'] == "external") {

    $sql = "SELECT * FROM `creditor` WHERE `name` like '%$value%' AND `source` ='external' AND `account_funds` < 0";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $name = $row["name"];
        $phone = $row["phone"];
      }
      echo "
    <option value ='$creditor_id,$phone,$name'>$name</option>";
    } else {

      echo "
    <option value ='-'>Creditor not found</option>";
    }
  }


  if ($_POST['type_value'] == "internal") {


    $sql = "SELECT * FROM `creditor` WHERE `name` like '%$value%' AND `source` ='internal' AND `account_funds` < 0";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $name = $row["name"];
        $phone = $row["phone"];
      }
      echo "
    <option value ='$creditor_id,$phone,$name'>$name</option>";
    } else {

      echo "
    <option value ='-'>Creditor not found</option>";
    }
  }
}


if (isset($_POST["debtor_outstanding_type_filter"])) {

  $type = $_POST["debtor_outstanding_type_filter"];

  if ($type == "customer" || $type == "agro_dealer" || $type == "b_to_b") {

    $sql = "SELECT `debtor_ID`, `name` FROM `debtor` WHERE `debtor_type`='$type'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $debtor_ID = $row["debtor_ID"];
        $debtor_name = $row["name"];


        echo " 

                                                        <datalist id='names'>
                                                            <option value='$debtor_ID'>$debtor_name</option>
                                                        </datalist>
            
            ";
      }
    }
  }
}

if (isset($_POST["orders_data_filter"])) {


  echo " <tr>
          <th>Order ID</th>
                 
          <th>Customer name</th>
          <th>Order Type</th>
          <th>Requsted By</th>
          <th>Date</th>
          <th>Time</th>
          <th>count</th>
          <th>Total Price</th>
          <th>Action</th>

      </tr>";



  $fromValue = $_POST["from"];
  $toValue = $_POST["to"];
  $page_type = $_POST["page_type"];
  $customer_type = $_POST["orders_data_filter"];
  $customer_id = $_POST["debtor_id"];



  $sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.status='$page_type' AND 
order_table.order_type='$customer_type' AND order_table.customer_id ='$customer_id' AND order_table.date BETWEEN '$fromValue' AND '$toValue'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {



      $order_ID    = $row["order_ID"];

      $customer_name  = $row["customer_name"];
      $order_type = $row["order_type"];
      $order_by = $row["fullname"];
      $date    = $row['date'];
      $time = $row['time'];
      $count = $row['count'];
      $total = $row['total_amount'];
      $page = "processed_orders";


      echo "
<tr class='odd gradeX'>
<td>$order_ID</td>


<td>$customer_name</td>
<td> $order_type</td>
<td>$order_by</td>
<td>$date</td>
<td>$time</t>
<td>$count</t>
<td>$total</td>

<td><a href='order_details.php? order_ID=$order_ID & page_type=$page' class='btn btn-success'>view</a></td>

</tr>	
";
    }
  } else {



    echo "
<tr class='odd gradeX'>
<td><span>Data Not Found</span></td>


<td>-</td>
<td> -</td>
<td>-</td>
<td>-</td>
<td>-</t>
<td>-</t>
<td>-</td>

<td>-</a></td>

</tr>	
";
  }
}

if (isset($_POST["all_orders_data_filter"])) {


  echo " <tr>
           <th>Order ID</th>
                  
           <th>Customer name</th>
           <th>Order Type</th>
           <th>Requsted By</th>
           <th>Date</th>
           <th>Time</th>
           <th>Count</th>
           <th>Total Price</th>
           <th>Action</th>
 
       </tr>";



  $fromValue = $_POST["from"];
  $toValue = $_POST["to"];

  $customer_type = $_POST["all_orders_data_filter"];
  $customer_id = $_POST["debtor_id"];



  $sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
 order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.order_type='$customer_type' AND order_table.customer_id ='$customer_id' AND order_table.date BETWEEN '$fromValue' AND '$toValue'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {



      $order_ID    = $row["order_ID"];

      $customer_name  = $row["customer_name"];
      $order_type = $row["order_type"];
      $order_by = $row["fullname"];
      $date    = $row['date'];
      $time = $row['time'];
      $count = $row['count'];
      $total = $row['total_amount'];
      $page = "all_orders";


      echo "
 <tr class='odd gradeX'>
 <td>$order_ID</td>
 
 
 <td>$customer_name</td>
 <td> $order_type</td>
 <td>$order_by</td>
 <td>$date</td>
 <td>$time</t>
 <td>$count</t>
 <td>$total</td>
 
 <td><a href='order_details.php? order_ID=$order_ID & page_type=$page' class='btn btn-success'>view</a></td>
 
 </tr>	
 ";
    }
  } else {



    echo "
 <tr class='odd gradeX'>
 <td><span>Data Not Found</span></td>
 
 
 <td>-</td>
 <td> -</td>
 <td>-</td>
 <td>-</td>
 <td>-</t>
 <td>-</t>
 <td>-</td>
 
 <td>-</a></td>
 
 </tr>	
 ";
  }
}


if (isset($_POST["lpo_data_filter"])) {


  echo " <tr>
           <th>Order ID</th>
                  
           <th>Customer name</th>
           <th>Order Type</th>
           <th>Requsted By</th>
           <th>Date</th>
           <th>Time</th>
           <th>Count</th>
           <th>Total Price</th>
           <th>Action</th>
 
       </tr>";



  $fromValue = $_POST["from"];
  $toValue = $_POST["to"];
  $customer_name = $_POST["lpo_data_filter"];




  $sql = "SELECT `order_ID`,`order_files`,`order_type`,order_table.status, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, order_table.time, `count`, `total_amount` FROM `order_table` 
 INNER JOIN user ON user.user_ID = order_table.user_ID WHERE `order_type`='b_to_b' AND order_files !='' AND order_files !='-' AND order_table.date BETWEEN '$fromValue' AND '$toValue' AND `customer_name` LIKE '%$customer_name%' ORDER BY `order_ID` DESC";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {



      $order_ID    = $row["order_ID"];

      $customer_name  = $row["customer_name"];
      $order_type = $row["order_type"];
      $order_by = $row["fullname"];
      $date    = $row['date'];
      $time = $row['time'];
      $count = $row['count'];
      $total = $row['total_amount'];
      $status = $row['status'];
      $page = "lpo";
      $files = $row['order_files'];



      echo "
 <tr class='odd gradeX'>
 <td>$order_ID</td>
 
 
 <td>$customer_name</td>
 <td> $order_type</td>
 <td>$order_by</td>
 <td>$date</td>
 <td>$time</t>
 <td>$count</t>
 <td>$total</td>
 
 <td><a href='../files/marketing/b_to_b_LPO/$files' class='btn btn-primary'>File</a><a href='order_details.php? order_ID=$order_ID & page_type=$page' class='btn btn-success'>view</a></td>
 
 </tr>	
 ";
    }
  } else {



    echo "
 <tr class='odd gradeX'>
 <td><span>Data Not Found</span></td>
 
 
 <td>-</td>
 <td> -</td>
 <td>-</td>
 <td>-</td>
 <td>-</t>
 <td>-</t>
 <td>-</td>
 
 <td>-</a></td>
 
 </tr>	
 ";
  }
}

if (isset($_POST["sales_data_filter"])) {


  echo "  <tr>
  <th>Order ID</th>
      <th>Item Number</th>
      <th>Crop</th>
      <th>Variety</th>
      <th>Class</th>
      <th>Quantity</th>
      <th>price per kg</th>
      <th>Discount</th>
      <th>Total price</th>
      <th>Order By</th>
      <th>Customer Name</th>
      <th>Order Type</th>
      <th>Date</th>
      <th>Action</th>


  </tr>";


  $customerType = $_POST["sales_data_filter"];
  $fromValue = $_POST["from"];
  $toValue = $_POST["to"];
  $cropValue = $_POST["cropValue"];
  $varietyValue = $_POST["varietyValue"];
  $classValue = $_POST["classValue"];





  $sql = "SELECT item.order_ID,item.item_ID,crop.crop,user.fullname,variety.variety,item.class,item.price_per_kg,item.discount_price,order_table.order_type,item.quantity,item.total_price,order_table.date,order_table.customer_name
  FROM item INNER JOIN crop ON crop.crop_ID = item.crop_ID INNER JOIN variety ON variety.variety_ID = item.variety_ID INNER JOIN order_table ON order_table.order_ID = item.order_ID 
  INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.order_type='$customerType' AND order_table.status='processed' AND item.crop_ID='$cropValue' AND item.variety_ID='$varietyValue' AND item.class='$classValue' AND order_table.date BETWEEN '$fromValue' AND '$toValue' ORDER BY order_table.order_ID DESC;";

  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      $order_ID = $row["order_ID"];

      $item_ID      = $row["item_ID"];
      $crop     = $row["crop"];
      $order_by = $row["fullname"];
      $customer = $row["customer_name"];
      $order_date = $row["date"];
      $variety = $row["variety"];
      $class    = $row['class'];
      $quantity = $row['quantity'];
      $price_per_kg = $row['price_per_kg'];
      $order_type = $row['order_type'];
      $discount_price = $row['discount_price'];
      $total_price = $row['total_price'];


      echo "
      <tr class='odd gradeX'>
      <td>$order_ID</td>
      <td>$item_ID</td>
      <td>$crop</td>
      <td>$variety</td>
      <td>$class</td>
      <td>$quantity</td>
      <td>$price_per_kg </td>
      <td>$discount_price</td>
      <td>$total_price</td>
      <td>$order_by</td>
      <td>$order_type</td>
      <td>$customer</td>
      <td>$order_date</td>
      <td><a href='' class='btn btn-success'>View Order</a><td>
      

</tr>	
 ";
    }
  } else {



    echo "
 <tr class='odd gradeX'>
 <td><span>Data Not Found</span></td>
 
 
 <td>-</td>
 <td> -</td>
 <td>-</td>
 <td>-</td>
 <td>-</t>
 <td>-</t>
 <td>-</td>
 
 <td>-</a></td>
 
 </tr>	
 ";
  }
}
