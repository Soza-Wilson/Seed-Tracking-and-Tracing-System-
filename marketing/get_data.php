<?php


$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";

$type_value="";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/marketing.php');
include('../class/main.php');


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

  
  }else {

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

  
  }else {

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

  
  }else {

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

  
  }else {

      echo "
    <option value ='-'>grower's phone number</option>";
    }
  }




}




if(isset($_POST['customer_value'])){

  $sql = "SELECT `debtor_ID`, `name`, `phone`, `email`, `description`, `debtor_type`, 
  `user_ID`, `debtor_files`, `registered_date`, `account_funds` FROM `debtor` WHERE  `debtor_type` = '' AND `name` like %''%";

  $result =  $con->query($sql);
    if ($result->num_rows > 0) {


    }
    else{

     $object = new main();
     $object -> register_customer($_POST['customer_name'],$_POST['customer_phone']);

    }




}


if(!empty($_POST['type_value'])){
  
  if ($_POST['type_value'] == "External") {

    $sql = "SELECT * FROM `creditor` WHERE `name` like '%$value%' AND `source` ='External' AND `account_funds` < 0";
    
  
    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $name = $row["name"];
        $phone= $row["phone"];
       
    } 
    echo "
    <option value ='$creditor_id,$phone,$name'>$name</option>";
  
  
  }else {
  
      echo "
    <option value ='-'>Creditor not found</option>";
    }
  }
  
  
  if ($_POST['type_value'] == "MUSECO") {
  
  
    $sql = "SELECT * FROM `creditor` WHERE `name` like '%$value%' AND `source` ='MUSECO' AND `account_funds` < 0";
    
  
    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $creditor_id = $row["creditor_ID"];
        $name = $row["name"];
        $phone= $row["phone"];
       
    } 
    echo "
    <option value ='$creditor_id,$phone,$name'>$name</option>";
  
  
  }else {
  
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

if(isset($_POST["orders_data_filter"])){


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
$customer_id =$_POST["debtor_id"];


  
$sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.status='$page_type' AND 
order_table.order_type='$customer_type' AND order_table.customer_id ='$customer_id' AND order_table.date BETWEEN '$fromValue' AND '$toValue'";
$result = $con->query($sql);
if($result->num_rows>0)
{
while($row=$result->fetch_assoc())
{



$order_ID 	 = $row["order_ID"];

$customer_name  = $row["customer_name"];
$order_type = $row["order_type"];
$order_by =$row["fullname"];
$date    = $row['date'];
$time = $row['time'];
$count = $row['count'];
$total = $row['total_amount'];
$page="processed_orders";


echo"
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
}


else{

  

echo"
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

if(isset($_POST["all_orders_data_filter"])){


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

 $customer_type = $_POST["all_orders_data_filter"];
 $customer_id =$_POST["debtor_id"];
 
 
   
 $sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
 order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.order_type='$customer_type' AND order_table.customer_id ='$customer_id' AND order_table.date BETWEEN '$fromValue' AND '$toValue'";
 $result = $con->query($sql);
 if($result->num_rows>0)
 {
 while($row=$result->fetch_assoc())
 {
 
 
 
 $order_ID 	 = $row["order_ID"];
 
 $customer_name  = $row["customer_name"];
 $order_type = $row["order_type"];
 $order_by =$row["fullname"];
 $date    = $row['date'];
 $time = $row['time'];
 $count = $row['count'];
 $total = $row['total_amount'];
 $page="all_orders";
 
 
 echo"
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
 }
 
 
 else{
 
   
 
 echo"
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




  








