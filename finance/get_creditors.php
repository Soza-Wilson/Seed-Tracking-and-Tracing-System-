<?php





include('../class/marketing.php');
include('../class/main.php');


if(isset($_POST['data_value'])){ 



  $sql = "SELECT * FROM `bank_account`";

  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $bank_ID      = $row["bank_ID"];
      $bank_name    = $row["bank_name"];

      echo "
                                                                                     
      <option value='type_not_selected'>Select Bank Account</option>
      <option value='$bank_ID'>$bank_name</option>
  ";

    }

  }



}

if(isset($_POST['ledger_save_csv'])){


  $date = date('d-m-y h:i');
  $filename = "All Orders $date.csv";
  $fp = fopen('php://output', 'w');
  
  //create header 


  $header = array("Order ID","Customer name","Date","Time","count","Total");	
  fputcsv($fp, $header);
  
  //create body
  
  $sql = "SELECT * FROM `order_table`";
  $result = $con->query($sql);
  if($result->num_rows>0)
  {
      while($row=$result->fetch_assoc())
      {

      $order_ID 	 = $row["order_ID"];
                              
      $customer_name  = $row["customer_name"];
      $date    = $row['date'];
      $time = $row['time'];
      $count = $row['count'];
      $total = $row['total_amount'];
      
          $list = array($order_ID,$customer_name,$date,$time,$count,$total);
      
      fputcsv($fp, $list);
  }
  
  //close file
  fclose($fp);
  
  //download file
  header("Content-Description: File Transfer");
  header('Content-type: application/csv');
  header('Content-Disposition: attachment; filename='.$filename);
  
  exit;


}



}


if (isset($_POST['search_value'])) {

  $value = $_POST['search_value'];
  $temp = $_POST['search_result'];
  $result_value = explode(',', $temp, 2);
  $C_D_ID = $result_value[0];





  if ($_POST['type_value'] == "agro_dealer") {

    $sql = "SELECT * FROM `transaction` WHERE `C_D_ID`='$C_D_ID'";


    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $trans_ID      = $row["transaction_ID"];
        $status   = $row["trans_status"];
        $time = $row["trans_time"];
        $date = $row["trans_date"];
        $amount = $row['amount'];


        echo "
                                  <tr class='odd gradeX'>
                                      <td>$trans_ID</td>
                                      <td>$status</td>
                                      <td>$time</td>
                                      <td>$date</td>
                                      <td>$amount</td>
                                   
                                        
                                      
                                      
                                      <td><a href='view_transaction_details.php?' class='btn btn-success'>View</a></td>
                                  </tr>	
                              ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
               
                    
                  
                  
                  <td-</td>
              </tr>	
          ";
    }
  }


  if ($_POST['type_value'] == "b_to_b") {
    $sql = "SELECT * FROM `transaction` WHERE `C_D_ID`='$C_D_ID'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $trans_ID      = $row["transaction_ID"];
        $status   = $row["trans_status"];
        $time = $row["trans_time"];
        $date = $row["trans_date"];
        $amount = $row['amount'];


        echo "
                                  <tr class='odd gradeX'>
                                      <td>$trans_ID</td>
                                      <td>$status</td>
                                      <td>$time</td>
                                      <td>$date</td>
                                      <td>$amount</td>
                                   
                                        
                                      
                                      
                                      <td><a href='view_transaction_details.php?' class='btn btn-success'>View</a></td>
                                  </tr>	
                              ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
               
                    
                  
                  
                  <td-</td>
              </tr>	
          ";
    }
  }

  if ($_POST['type_value'] == "customer") {

    $sql = "SELECT * FROM `transaction` WHERE `C_D_ID`='$C_D_ID' AND trans_status = 'payment_pending' AND type='customer_order'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $trans_ID      = $row["transaction_ID"];
        $status   = $row["trans_status"];
        $time = $row["trans_time"];
        $date = $row["trans_date"];
        $amount = $row['amount'];
        $action_id = $row['action_ID'];


        echo "
                                                                                       
                                                   <tr class='odd gradeX'>
                                                       <td>$trans_ID</td>
                                                       <td>$status</td>
                                                       <td>$time</td>
                                                       <td>$date</td>
                                                       <td>$amount</td>
                                                     
                                                         
                                                       
                                                       
                                                       <td><a href='view_transaction_details.php? order_id=$action_id' class='btn btn-success'>View</a></td>
                                                   </tr>	
                                               ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
               
                    
                  
                  
                  <td-</td>
              </tr>	
          ";
    }
  }

  


  if ($_POST['type_value'] == "grower") {

    $sql = "SELECT * FROM `transaction`";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $trans_ID      = $row["transaction_ID"];
        $status   = $row["trans_status"];
        $time = $row["trans_time"];
        $date = $row["trans_date"];
        $amount = $row['amount'];


        echo "
                                  <tr class='odd gradeX'>
                                      <td>$trans_ID</td>
                                      <td>$status</td>
                                      <td>$time</td>
                                      <td>$date</td>
                                      <td>$amount</td>
                                   
                                        
                                      
                                      
                                      <td><a href='view_transaction_details.php?' class='btn btn-success'>View</a></td>
                                  </tr>	
                              ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
               
                    
                  
                  
                  <td-</td>
              </tr>	
          ";
    }
  }
 
  
}

if (isset($_POST['fromDateValue'])) {
  $fromDateValue = $_POST['fromDateValue'];
  $toDateValue = $_POST['toDateValue'];
  $typeValue = $_POST['typeValue'];
  $bankAccount = $_POST['bankAccount'];



  if ($typeValue == "all") {


    echo"
    <tr>
    <th>Entry ID</th>
    <th>Transaction type</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Bank account name</th>
    <th>Reference Amount</th>
    <th>Current Amount</th>
    <th>Entry_date</th>
    <th>Entry_time</th>
    <th>Entry_by</th>
   

    <th>Action</th>
</tr>
    ";
    
    $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
    `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
     `reference_bank_amount`, `entry_date`, `entry_time` FROM 
   `ledger` INNER JOIN user ON user.user_ID = ledger.user_ID 
   INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID WHERE bank_account.bank_ID = '$bankAccount' AND ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue' ORDER BY `ledger_ID` DESC";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $ledger_ID      = $row["ledger_ID"];
        $ledger_type   = $row["ledger_type"];
        $description = $row["description"];
        $amount = $row["amount"];
        $transaction_ID = $row["transaction_ID"];
        $user = $row["fullname"];
        $bank_name = $row["bank_name"];
        $account_funds = $row["account_funds"];
        $reference_bank_amount = $row["reference_bank_amount"];
        $entry_date = $row["entry_date"];
        $entry_time = $row["entry_time"];

        echo "

       
                                                                          
                                                                                       
                                                   <tr class='odd gradeX'>
                                                   <td>$ledger_ID</td>
                                                   <td>$ledger_type</td>
                                                   <td>$amount</td>
                                                   <td>$description</td>
                                                   <td>$bank_name</td>
                                                   <td>$reference_bank_amount</td>
                                                   <td>$account_funds</td>
                                                   <td>$entry_date</td>
                                                   <td>$entry_time</td>
                                                   <td>$user</td>


                                                    <td><a href='view_transaction_details.php?' class='btn btn-success'>View</a></td>
                                                   
                                                  
                                                       
                                                   </tr>	
                                               ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  
              </tr>	
          ";
    }
  }

  else if($typeValue == "credit"){

    echo"
    <tr>
    <th>Entry ID</th>
    <th>Transaction type</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Bank account name</th>
    <th>Reference Amount</th>
    <th>Current Amount</th>
    <th>Entry_date</th>
    <th>Entry_time</th>
    <th>Entry_by</th>
   

    <th>Action</th>
</tr>";

      
    $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
    `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
     `reference_bank_amount`, `entry_date`, `entry_time` FROM 
   `ledger` INNER JOIN user ON user.user_ID = ledger.user_ID 
   INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID  WHERE bank_account.bank_ID = '$bankAccount' AND ledger.ledger_type = 'credit' AND ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue' ORDER BY `ledger_ID` DESC";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $ledger_ID      = $row["ledger_ID"];
        $ledger_type   = $row["ledger_type"];
        $description = $row["description"];
        $amount = $row["amount"];
        $transaction_ID = $row["transaction_ID"];
        $user = $row["fullname"];
        $bank_name = $row["bank_name"];
        $account_funds = $row["account_funds"];
        $reference_bank_amount = $row["reference_bank_amount"];
        $entry_date = $row["entry_date"];
        $entry_time = $row["entry_time"];

        echo "

       
                                                                          
                                                                                       
                                                   <tr class='odd gradeX'>
                                                   <td>$ledger_ID</td>
                                                   <td>$ledger_type</td>
                                                   <td>$amount</td>
                                                   <td>$description</td>
                                                   <td>$bank_name</td>
                                                   <td>$reference_bank_amount</td>
                                                   <td>$account_funds</td>
                                                   <td>$entry_date</td>
                                                   <td>$entry_time</td>
                                                   <td>$user</td>


                                                    <td><a href='view_transaction_details.php?' class='btn btn-success'>View</a></td>
                                                   
                                                       
                                                   </tr>	
                                               ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  
              </tr>	
          ";
    }

  }

  else if($typeValue == "debit"){


    echo"
    <tr>
    <th>Entry ID</th>
    <th>Transaction type</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Bank account name</th>
    <th>Reference Amount</th>
    <th>Current Amount</th>
    <th>Entry_date</th>
    <th>Entry_time</th>
    <th>Entry_by</th>
   

    <th>Action</th>
</tr>";
      
    $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
    `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
     `reference_bank_amount`, `entry_date`, `entry_time` FROM 
   `ledger` INNER JOIN user ON user.user_ID = ledger.user_ID 
   INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID WHERE bank_account.bank_ID = '$bankAccount' AND ledger.ledger_type = 'debit' AND ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue' ORDER BY `ledger_ID` DESC";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $ledger_ID      = $row["ledger_ID"];
        $ledger_type   = $row["ledger_type"];
        $description = $row["description"];
        $amount = $row["amount"];
        $transaction_ID = $row["transaction_ID"];
        $user = $row["fullname"];
        $bank_name = $row["bank_name"];
        $account_funds = $row["account_funds"];
        $reference_bank_amount = $row["reference_bank_amount"];
        $entry_date = $row["entry_date"];
        $entry_time = $row["entry_time"];

        echo "

       
                                                                          
                                                                                       
                                                   <tr class='odd gradeX'>
                                                   <td>$ledger_ID</td>
                                                   <td>$ledger_type</td>
                                                   <td>$amount</td>
                                                   <td>$description</td>
                                                   <td>$bank_name</td>
                                                   <td>$reference_bank_amount</td>
                                                   <td>$account_funds</td>
                                                   <td>$entry_date</td>
                                                   <td>$entry_time</td>
                                                   <td>$user</td>


                                                    <td><a href='view_transaction_details.php?' class='btn btn-success'>View</a></td>
                                                   
                                                   </tr>	
                                               ";
      }
    } else {

      echo "
                                                                                       
              <tr class='odd gradeX'>
                  <td><h3>Unavailable !!</h3></td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  <td-</td>
                  
              </tr>	
          ";
    }
    
  }
}


if (isset($_POST['creditor_name_search'])){


    $creditor_name = $_POST['creditor_name_search'];

  
  $sql = "SELECT * FROM creditor WHERE `name`  like '%$creditor_name%' ";



  $result = $con->query($sql);

echo" <thead>
<tr>
    <th>ID </th>
    <th>Name</th>

    <th>Phone</th>
    <th>Registered by</th>
    <th>Registered date</th>
    <th>Account funds (MK)</th>
    <th>Actions</th>



</tr>
</thead>";  


  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $creditor_ID = $row["creditor_ID"];
          $name = $row["name"];

          $phone = $row["phone"];
          $by = $row["user_ID"];
          $date = $row['registered_date'];
          $funds = $row['account_funds'];





          echo "

         
<tr class='odd gradeX'>
<td>$creditor_ID</td>
<td>$name</td>

<td>$phone</td>
<td>$by</td>
<td>$date</td>
<td>$funds</td>
<td><a href='stock_out_check_items.php? '  class='btn btn-success'>view</a> </td>


                                         



</tr>	
";
      }




}
else{

  echo "
  <tr class='odd gradeX'>
  <td>Unavailable !</td>
  <td>-</td>
  
  <td>-</td>
  <td>-</td>
  <td>-</td>
  <td>-</td>
  <td>-</td>
  
  
                                           
  
  
  
  </tr>	
  ";


}

}

if(isset($_POST['debtor_name_search'])){


  $debtor_name = $_POST['debtor_name_search'];

  
  $sql = "SELECT * FROM debtor WHERE `name`  like '%$debtor_name%'";

       echo" <thead>
       <tr>
           <th>ID </th>
           <th>Name</th>
           <th>Type</th>
           <th>Phone</th>
           <th>Registered by</th>
           <th>Registered date</th>
           <th>Account funds (MK)</th>
           <th>Actions</th>
           

         
       </tr>
   </thead> ";                                                                

  $result = $con->query($sql);
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $debtor_ID = $row["debtor_ID"];
          $name = $row["name"];
          $type  = $row["debtor_type"];
          $phone = $row["phone"];
          $by = $row["user_ID"];
          $date = $row['registered_date'];
          $funds = $row['account_funds'];
          
       



          echo "

                  
<tr class='odd gradeX'>
<td>$debtor_ID</td>
<td>$name</td>
<td>$type</td>
<td>$phone</td>
<td>$by</td>
<td>$date</td>
<td>$funds</td>
<td><a href='stock_out_check_items.php? '  class='btn btn-success'>view</a> </td>


                             



</tr>	
";



      }
}

else{

  echo "
  <tr class='odd gradeX'>
  <td>Unavailable !</td>
  <td>-</td>
  
  <td>-</td>
  <td>-</td>
  <td>-</td>
  <td>-</td>
  <td>-</td>
  
  
                                           
  
  
  
  </tr>	
  ";


}
}