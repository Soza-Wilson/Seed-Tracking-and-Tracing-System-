<?php





$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
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



  if ($typeValue == "all") {
    
    $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
    `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
     `reference_bank_amount`, `entry_date`, `entry_time` FROM 
   `ledger` INNER JOIN user ON user.user_ID = ledger.user_ID 
   INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID WHERE ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $ledger_ID      = $row["ledger_ID"];
        $ledger_type   = $row["ledger_type"];
        $description = $row["description"];
        $amount = $row["amount"];
        $transaction_ID = $row["transaction_ID"];
        $fullname = $row["fullname"];
        $bank_name = $row["bank_name"];
        $account_funds = $row["account_funds"];
        $reference_bank_amount = $row["reference_bank_amount"];
        $entry_date = $row["entry_date"];
        $entry_time = $row["entry_time"];

        echo "
                                                                                       
                                                   <tr class='odd gradeX'>
                                                       <td>$ledger_ID</td>
                                                       <td>$ledger_type</td>
                                                       <td>$description</td>
                                                       <td>$amount</td>
                                                       <td>$transaction_ID</td>
                                                       <td>$fullname</td>
                                                       <td>$bank_name</td>
                                                       <td>$account_funds</td>
                                                       <td>$reference_bank_amount</td>
                                                       <td>$entry_date</td>
                                                       <td>$entry_time</td>
                                                       
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

      
    $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
    `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
     `reference_bank_amount`, `entry_date`, `entry_time` FROM 
   `ledger` INNER JOIN user ON user.user_ID = ledger.user_ID 
   INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID  WHERE ledger.ledger_type = 'credit' AND ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $ledger_ID      = $row["ledger_ID"];
        $ledger_type   = $row["ledger_type"];
        $description = $row["description"];
        $amount = $row["amount"];
        $transaction_ID = $row["transaction_ID"];
        $fullname = $row["fullname"];
        $bank_name = $row["bank_name"];
        $account_funds = $row["account_funds"];
        $reference_bank_amount = $row["reference_bank_amount"];
        $entry_date = $row["entry_date"];
        $entry_time = $row["entry_time"];

        echo "
                                                                                       
                                                   <tr class='odd gradeX'>
                                                       <td>$ledger_ID</td>
                                                       <td>$ledger_type</td>
                                                       <td>$description</td>
                                                       <td>$amount</td>
                                                       <td>$transaction_ID</td>
                                                       <td>$fullname</td>
                                                       <td>$bank_name</td>
                                                       <td>$account_funds</td>
                                                       <td>$reference_bank_amount</td>
                                                       <td>$entry_date</td>
                                                       <td>$entry_time</td>
                                                       
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

      
    $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
    `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
     `reference_bank_amount`, `entry_date`, `entry_time` FROM 
   `ledger` INNER JOIN user ON user.user_ID = ledger.user_ID 
   INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID WHERE ledger.ledger_type = 'debit' AND ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $ledger_ID      = $row["ledger_ID"];
        $ledger_type   = $row["ledger_type"];
        $description = $row["description"];
        $amount = $row["amount"];
        $transaction_ID = $row["transaction_ID"];
        $fullname = $row["fullname"];
        $bank_name = $row["bank_name"];
        $account_funds = $row["account_funds"];
        $reference_bank_amount = $row["reference_bank_amount"];
        $entry_date = $row["entry_date"];
        $entry_time = $row["entry_time"];

        echo "
                                                                                       
                                                   <tr class='odd gradeX'>
                                                       <td>$ledger_ID</td>
                                                       <td>$ledger_type</td>
                                                       <td>$description</td>
                                                       <td>$amount</td>
                                                       <td>$transaction_ID</td>
                                                       <td>$fullname</td>
                                                       <td>$bank_name</td>
                                                       <td>$account_funds</td>
                                                       <td>$reference_bank_amount</td>
                                                       <td>$entry_date</td>
                                                       <td>$entry_time</td>
                                                       
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