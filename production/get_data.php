<?php

include('../class/main.php');

$object = new main();

if (isset($_POST['updateStockInRequest'])) {

  $object->admin_approval($_POST['approvalId'], $_POST['depertment'], $_POST['updateStockInRequest'], $_POST['action_id'], $_POST['description'], $_POST['request_id'], $_POST['requestedName']);

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
//insert stock in

if (isset($_POST["insertStockIn"])) {

  $source = $_POST['seedSource'];
  $creditor = $_POST['insertStockIn'];
  $srn = $_POST['srn'];
  $bincard = $_POST['binCard'];
  $bags = $_POST['bags'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'];
  $crop = $_POST['crop'];
  $variety = $_POST['variety'];
  $class = $_POST['class'];
  $farm_ID = $_POST['farmID'];
  $certificate = $_POST['certificate'];
  $status = $_POST['status'];
  $status = $_POST['status'];
  $dir = $_POST['fileDirectory'];
  $user = $_POST['user'];
  $object->stock_in($creditor, $certificate, $farm_ID, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $dir, $user);
}


// update stock in 
if (isset($_POST["updateStockIn"])) {

  $stockInId = $_POST["stockInId"];
  $old_certificate = $_POST["old_certificate"];
  $new_certificate = $_POST["new_certificate"];
  $crop = $_POST["updateStockIn"];
  $variety = $_POST["variety"];
  $class = $_POST["seedClass"];
  $srn = $_POST["seedReceiveNote"];
  $binCardNumber = $_POST["binCardNumber"];
  $numberOfBags = $_POST["bags"];
  $newQuantity = $_POST["quantity"];
  $oldQuantity = $_POST["oldQuantity"];
  $description = $_POST["description"];
  $fileDirectory = $_POST["dir"];
  $creditorId = $_POST["creditorId"];
  $status = $_POST["status"];
  $object->update_stock_in($stockInId, $old_certificate, $new_certificate, $crop, $variety, $class, $srn, $binCardNumber, $numberOfBags, $newQuantity, $oldQuantity, $description, $fileDirectory, $creditorId, $status);
  // $object->update_stock_in($_POST["stockInId"],$_POST["certificate"],$_POST["updateStockIn"],
  // $_POST["variety"],$_POST["seedClass"],$_POST["seedReceiveNote"],
  // $_POST["binCardNumber"],$_POST["bags"],$_POST["quantity"],$_POST["description"],$_POST["dir"]);
  // $sql="UPDATE `stock_in` SET `stock_in_ID`='[value-1]',`user_ID`='[value-2]',`certificate_ID`='[value-3]',`farm_ID`='[value-4]',`creditor_ID`='[value-5]',`source`='[value-6]',`crop_ID`='[value-7]',`status`='[value-8]',`variety_ID`='[value-9]',`class`='[value-10]',`SLN`='[value-11]',`bincard`='[value-12]',`number_of_bags`='[value-13]',`quantity`='[value-14]',`used_quantity`='[value-15]',`available_quantity`='[value-16]',
  // `processed_quantity`='[value-17]',`grade_outs_quantity`='[value-18]',`trash_quantity`='[value-19]',`description`='[value-20]',`supporting_dir`='[value-21]',`date`='[value-22]',`time`='[value-23]' WHERE 1";


  // $sql = "UPDATE `stock_in` SET`crop_ID`='$crop',`variety_ID`='$variety',`class`='$class',`SLN`='$srn',`bincard`='$binCardNumber',`number_of_bags`='$numberOfBags',`quantity`='$quantity',`available_quantity`='$quantity',
  //       `description`='$description',`supporting_dir`='$fileDirectory',`certificate_ID`='$certificate' WHERE `stock_in_ID`='$stockInId'";
  // $statement = $con->prepare($sql);
  // $statement->execute();




}

if (isset($_POST["deleteStockIn"])) {
  $stockData = $_POST["deleteStockIn"];
  $object->delete_stock_in($stockData[0], $stockData[1], $stockData[2], $stockData[3]);
}

// Insert external creditor 

if (isset($_POST["insertExtCreditor"])) {

  $creditorData = $_POST["insertExtCreditor"];
  $object->add_creditor("External", $creditorData[0], $creditorData[1], $creditorData[2], $creditorData[3], $creditorData[4], "-");
}

if (isset($_POST["viewStockFilter"])) {

  $filterData = $_POST["viewStockFilter"];
  $creditor = $filterData[0];

  echo "<thead>
  <tr>
  <th>Stock In ID</th>
  <th>Crop</th>
  <th>Variety</th>
  <th>Class</th>
  <th>Quantity</th>
  <th>Used Quantity</th>
  <th>Available Quantity</th>
  <th>Source</th>
  <th>Source Name</th>
  <th>SRN</th>
  <th>Added By</th>
  <th>Added Date</th>
  <th>Action</th>

  </tr>
</thead>";

  $sql = "SELECT `stock_in_ID`, `fullname`,stock_in.source, `name`, `crop`, 
  `variety`, `class`, `SLN`, `bincard`, `number_of_bags`,
   `quantity`,`used_quantity`,`available_quantity`, `date` ,`supporting_dir` FROM `stock_in` 
  INNER JOIN user ON stock_in.user_ID = user.user_ID 
  INNER JOIN creditor ON stock_in.creditor_ID = creditor.creditor_ID 
  INNER JOIN crop ON stock_in.crop_ID = crop.crop_ID 
  INNER JOIN variety on stock_in.variety_ID = variety.variety_ID WHERE creditor.name like '%$filterData[0]%' AND stock_in.crop_ID ='$filterData[1]' AND stock_in.variety_ID='$filterData[2]' AND stock_in.class='$filterData[3]' AND stock_in.date BETWEEN '$filterData[4]' AND '$filterData[5]' ";

  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $stock_in_id = $row['stock_in_ID'];
      $crop      = $row['crop'];
      $source = $row['source'];
      $source_name = $row['name'];
      $variety     = $row['variety'];
      $class     = $row['class'];
      $quantity     = $row['quantity'];
      $used_quantity = $row['used_quantity'];
      $available_quantity = $row['available_quantity'];
      $date_added = $row['date'];
      $user = $row['fullname'];
      $srn = $row['SLN'];
      $dir = $row['supporting_dir'];


      $object = new main();
      $newDate = $object->change_date_format($date_added);





      echo "
<tr class='odd gradeX'>
                     <td>$stock_in_id</td>
<td>$crop</td>
<td>$variety</td>
<td>$class</td>
<td>$quantity</td>
                    <td> $used_quantity</td>
                    <td> $available_quantity</td>
                    <td>$source</td>
                    <td>$source_name</td>
                    <td>$srn</td>
                    <td>$user</td>
                    <td>$newDate</td>
                    
                   


<td><a href='stock_in_details.php? stock_in_id=$stock_in_id' class='btn btn-success'><i class='icofont icofont-eye-alt'></i>View </a>
                    
                    </td>
</tr>	
";
    }
  } else {


    echo "
                                    <tr class='odd gradeX'>
                                                         <td>Not Available</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                                        <td> -</td>
                                                        <td> -</td>
                                                        <td>-</td>
                                                        <td>-e</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        
                                                       
                                    
                                    
                                    <td>
                                                        
                                                        </td>
                                    </tr>	
                                    ";
  }
}


// View stock out filter 


if (isset($_POST["viewStockOutFilter"])) {

  $filterData = $_POST["viewStockOutFilter"];
  $creditor = $filterData[0];

  echo "<thead>
  <tr>
  <th>ID</th>
  <th>Crop</th>
  <th>Variety</th>
  <th>Class</th>
  <th>Customer name</th>
  <th>Quantity</th>
  <th>Date</th>
  <th>Time</th>


  <th>Action</th>

  </tr>
</thead>";

  $sql = "SELECT `stock_out_ID`, crop.crop, variety.variety, item.class,
  user.fullname, order_table.customer_name, `Quntity`, stock_out.date,
   stock_out.time FROM `stock_out` INNER JOIN item ON item.item_ID = stock_out.item_ID INNER JOIN crop
  ON crop.crop_ID = item.crop_ID INNER JOIN variety on variety.variety_ID = item.variety_ID INNER JOIN 
  user on user.user_ID = stock_out.user_ID INNER JOIN order_table on order_table.order_ID = stock_out.order_ID WHERE customer_name like 
  '%$filterData[0]%'AND item.crop_ID ='$filterData[1]' AND item.variety_ID='$filterData[2]' AND item.class='$filterData[3]' AND stock_out.date BETWEEN '$filterData[4]' AND '$filterData[5]' ORDER BY `stock_out_ID` DESC
    ";

  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      $ID      = $row["stock_out_ID"];
      $crop    = $row["crop"];
      $variety  = $row["variety"];
      $class = $row['class'];
      $customer = $row["customer_name"];
      $date    = $row['date'];
      $time = $row['time'];

      $quantity = $row['Quntity'];


      $object = new main();
      $newDate = $object->change_date_format($date);

      //  



      echo "
<tr class='odd gradeX'>
<td>$ID</td>
<td>$crop</td>
<td>$variety</td>
<td>$class</td>
<td>$customer</td>
<td>$quantity</t>
<td>$newDate</td>
<td>$time</t>
                    
                   


<td><a href='stock_in_details.php? stock_in_id=$ID' class='btn btn-success'><i class='icofont icofont-eye-alt'></i>View </a>
                    
                    </td>
</tr>	
";
    }
  } else {


    echo "
                                    <tr class='odd gradeX'>
                                                         <td>Not Available</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                                        <td> -</td>
                                                        <td> -</td>
                                                        <td>-</td>
                                                        <td>-e</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        
                                                       
                                    
                                    
                                    <td>
                                                        
                                                        </td>
                                    </tr>	
                                    ";
  }
}





// Insert seed certificate 


if (isset($_POST["insertCertificate"])) {

  $test = $_POST["insertCertificate"];

  $object->add_certificate(
    $test[4],
    $test[0],
    $test[1],
    $test[2],
    $test[3],
    $test[6],
    $test[7],
    $test[8],
    $test[9],
    $test[5],
    $test[10],
    $test[11]
  );
}


//assign seed for grading 



if (isset($_POST["assignSeed"])) {



  //   $seedData = $_POST["assignSeed"];
  //   $object->assign_prcessing_quantity($seedData[0], $seedData[1]);
  // }


}

//  if (isset($_POST["inventoryFilter"])) {



//     $data = $_POST["inventoryFilter"];


//     echo "

//       <th>Crop</th>
//       <th>Variety</th>
//       <th>Quantity</th>

//       ";

//     $sql = "SELECT crop.crop,variety.variety,stock_in.class, SUM(stock_in.quantity) 
//      AS quantity FROM stock_in INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID 
//      INNER JOIN variety ON variety.variety_ID =stock_in.variety_ID WHERE
//      stock_in.crop_ID ='$data[0]' AND stock_in.variety_ID='$data[1]' AND stock_in.class='$data[2]'
//      AND stock_in.status='$data[3]' GROUP BY crop.crop_ID DESC";

//     $result = $con->query($sql);
//     if ($result->num_rows > 0) {
//       while ($row = $result->fetch_assoc()) {
//         $crop    = $row["crop"];
//         $variety  = $row["variety"];
//         $quantity = $row['quantity'];




//         echo "
//   <tr class='odd gradeX'>

//   <td>$crop</td>
//   <td>$variety</td>
//   <td>$class</td>

//   <td>$quantity</t>







//                       </td>
//   </tr>	
//   ";
//       }
//     }  else {


//       echo "
//                                       <tr class='odd gradeX'>
//                                                            <td>Not Available</td>
//                                       <td>-</td>
//                                       <td>-</td>
//                                       <td>-</td>
//                                       <td>-</td>
//                                                           <td> -</td>
//                                                           <td> -</td>
//                                                           <td>-</td>
//                                                           <td>-e</td>
//                                                           <td>-</td>
//                                                           <td>-</td>
//                                                           <td>-</td>




//                                       <td>

//                                                           </td>
//                                       </tr>	
//                                       ";
//     }
//   }



if (isset($_POST["inventoryFilter"])) {

  $filterData = $_POST["inventoryFilter"];
  $data = $filterData;



  echo "<thead>
    <tr>
 
    <th>Crop</th>
    <th>Variety</th>
  
    <th>Quantityyyyy</th>
   
  
    </tr>
  </thead>";

  $sql = "SELECT crop.crop,variety.variety, SUM(stock_in.quantity) AS quantity FROM stock_in INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID INNER JOIN variety ON variety.variety_ID =stock_in.variety_ID WHERE  stock_in.crop_ID ='$data[0]' AND stock_in.variety_ID='$data[1]' AND stock_in.class='$data[2]'
  AND stock_in.status='$data[3]' GROUP BY crop.crop_ID DESC";

  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      $crop      = $row['crop'];
      $variety   = $row['variety'];
      $quantity  = $row['quantity'];


      echo "
  <tr class='odd gradeX'>
                      
  <td>$crop</td>
  <td>$variety</td>

  <td>$quantity</td>
                      
                      
                     
  
  
  
                      
                      </td>
  </tr>	
  ";
    }
  } else {


    echo "
                                      <tr class='odd gradeX'>
                                                           <td>Unvailable</td>
                                      <td>-</td>
                                      <td>-</td>
                                 
                                  
                                                         
                                      
                                      
                                      <td>
                                                          
                                                          </td>
                                      </tr>	
                                      ";
  }
}



if (isset($_POST["certificateFilter"])) {

  $filterData = $_POST["certificateFilter"];
  $data = $filterData;
 
 
  echo "<thead>
  <tr>

  <th>Lot number</th>
                                                              <th>crop</th>
                                                              <th>Variety</th>
                                                              <th>Class</th>
                                                              <th>Certificate type</th>
                                                              <th>Source</th>
                                                              <th>Date tested</th>
                                                              <th>Expire date</th>
                                                              <th>Added date</th>
                                                              <th>certificate quantity</th>
                                                              <th>available quantity</th>
                                                              <th>added by</th>
                                                              <th>Action</th>

  </tr>
</thead>";
  $sql = "";

  if ($data[0] == "available") {

    $date = date("Y-m-d");
    $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
    `certificate_quantity`, `available_quantity`, `directory`, `fullname` FROM `certificate`
    INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
    INNER JOIN user ON user.user_ID = certificate.user_ID WHERE `available_quantity` > 0 AND `expiry_date` > '$date' AND certificate.crop_ID ='$data[1]' AND certificate.variety_ID ='$data[2]' AND `class`='$data[3]' ORDER BY `lot_number` DESC";
  } else if ($data[0] == "used") {
    $date = date("Y-m-d");
    $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
      `certificate_quantity`, `available_quantity`, `directory`, `fullname` FROM `certificate`
      INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
      INNER JOIN user ON user.user_ID = certificate.user_ID WHERE `available_quantity` <= 0 AND certificate.crop_ID ='$data[1]' AND certificate.variety_ID ='$data[2]' AND `class`='$data[3]'  ORDER BY `lot_number` DESC";

  } else if ($data[0] == "expired") {
    $date = date("Y-m-d");
    $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, 
    `expiry_date`, `date_added`, `certificate_quantity`, `available_quantity`, `directory`, 
    `fullname` FROM `certificate` INNER JOIN crop ON certificate.crop_ID = crop.crop_ID 
    INNER JOIN variety ON certificate.variety_ID = variety.variety_ID INNER JOIN user ON
     user.user_ID = certificate.user_ID WHERE `date_added` BETWEEN '$data[4]' AND '$data[5]' AND  `expiry_date` < '$date' ANDcertificate.crop_ID ='$data[1]' AND certificate.variety_ID ='$data[2]' AND `class`='$data[3]'  ORDER BY `lot_number` DESC";
  }

 
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $lot_number = $row["lot_number"];
        $crop      = $row["crop"];
        $variety     = $row["variety"];
        $class     = $row["class"];
        $type  = $row["type"];
        $source = $row['source'];
        $date_tested = $row['date_tested'];
        $expire_date = $row['expiry_date'];
        $date_added = $row['date_added'];
        $dir = $row['directory'];
        $certificate_quantity = $row['certificate_quantity'];
        $available_quantity = $row['available_quantity'];
        $fullname = $row['fullname'];




        echo "
  <tr class='odd gradeX'>

  <td>$lot_number</td>
  <td>$crop</td>
<td>$variety</td>
<td>$class</td>
<td>$type</td>
<td>$source</td>
                        <td>$date_tested</td>
                        <td>$expire_date</td>
                        <td>$date_added</td>
                      
                        <td>$certificate_quantity</td>
                        <td>$available_quantity</td>
                        <td>$fullname</td>


<td><a href='view_registered_users.php' class='ti-eye'></a>/
                        <a href='view_registered_users.php' class='ti-trash'></a>/
                        <a href='view_registered_users.php' class='ti-pencil-alt'></a>
                        <a href='certificate/$dir' class='ti-bookmark-alt'></a>
                        </td>
  </tr>	
  ";
      }
    } else {


      echo "
                                      <tr class='odd gradeX'>
                                                           <td>Unvailable</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>




                                      <td>

                                                          </td>
                                      </tr>	
                                      ";
    }
}
