<?php


//finance ledger create csv file 



include('../class/main.php');

if (isset($_POST['fromDateValue'])) {

    
   
    
    //create header 


    



    $fromDateValue = $_POST['fromDateValue'];
    $toDateValue = $_POST['toDateValue'];
    $typeValue = $_POST['typeValue'];
    $bankAccount = $_POST['bankAccount'];
  
  
  
    if ($typeValue == "all") {
  
  
      
      
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


          $list = array($ledger_ID,$ledger_type,$amount,$description,$bank_name,$reference_bank_amount,$account_funds,$entry_date,$entry_time,$user);

          json_encode($list);
           
         
  
        }

        
       
   
      } else {
  
        
      }
    }
  
    else if($typeValue == "credit"){


  
  
        
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


          $list = array($ledger_ID,$ledger_type,$amount,$description,$bank_name,$reference_bank_amount,$account_funds,$entry_date,$entry_time,$user);
          
          json_encode($list);
           
         
  
          
        }


            //close file
       
      

      } else {
  
        
      }
  
    }
  
    else if($typeValue == "debit"){
  
  
   
        
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

          
          $list = array($ledger_ID,$ledger_type,$amount,$description,$bank_name,$reference_bank_amount,$account_funds,$entry_date,$entry_time,$user);
   
          json_encode($list);
         
        }

        
            //close file
     


      } else {
  
     
      }
      
    }
  }

  if(isset($_POST['create_csv_file'])){

   

    $filter =$_POST['filter'];

    if(empty($filter)){


      $date = date('d-m-y h:i');
      $filename = "Ledger $date.csv";
      $fp = fopen('php://output', 'w');
      
      //create header 


      $header = array("ID","Transaction Type","Amount","Description","Bank Account Name","Reference Amount","Current Amount", "Entry Date","Entry Time","Entry by");	
      fputcsv($fp, $header);
      
      //create body
      
      $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
      `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
       `reference_bank_amount`, `entry_date`, `entry_time` FROM 
     `ledger`  INNER JOIN user ON user.user_ID = ledger.user_ID 
     INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID ORDER BY `ledger_ID` DESC";
      $result = $con->query($sql);
      if($result->num_rows>0)
      {
          while($row=$result->fetch_assoc())
          {

          $ledger_ID 	 = $row["ledger_ID"];                                 
          $ledger_type = $row["ledger_type"];
          $description    = $row['description'];
          $amount = $row['amount'];
          $transaction_ID = $row['transaction_ID'];
          $fullname = $row['fullname'];
          $bank_account = $row['bank_name'];
          $account_funds = $row['account_funds'];
          $reference_bank_amount = $row['reference_bank_amount'];
          $entry_date = $row['entry_date'];
          $entry_time = $row['entry_time'];
        
          
              $list = array($ledger_ID,$ledger_type,$amount,$description,$bank_account,$reference_bank_amount,$account_funds,$entry_date,$entry_time,$fullname);
          
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

    else{

      $bankAccount = $_POST['bank_name_hidden'];
      $fromDateValue = $_POST['from_hidden'];
      $toDateValue = $_POST['to_hidden'];
      $ledger_type = $_POST['ledger_type_hidden'];
      $date = date('d-m-y h:i');
      $filename = "Ledger $date.csv";
      $fp = fopen('php://output', 'w');
      
      //create header 


      $header = array("ID","Transaction Type","Amount","Description","Bank Account Name","Reference Amount","Current Amount", "Entry Date","Entry Time","Entry by");	
      fputcsv($fp, $header);
      
      //create body
      
      $sql = "SELECT `ledger_ID`, `ledger_type`, `description`,
      `amount`, `transaction_ID`,user.fullname,bank_account.bank_name,account_funds,
       `reference_bank_amount`, `entry_date`, `entry_time` FROM 
     `ledger`  INNER JOIN user ON user.user_ID = ledger.user_ID 
     INNER JOIN bank_account ON bank_account.bank_ID = ledger.bank_ID WHERE
      bank_account.bank_ID = '$bankAccount' AND ledger.ledger_type = 'debit'
       AND ledger.entry_date BETWEEN '$fromDateValue' AND '$toDateValue' ORDER BY `ledger_ID` DESC";
      $result = $con->query($sql);
      if($result->num_rows>0)
      {
          while($row=$result->fetch_assoc())
          {

          $ledger_ID 	 = $row["ledger_ID"];                                 
          $ledger_type = $row["ledger_type"];
          $description    = $row['description'];
          $amount = $row['amount'];
          $transaction_ID = $row['transaction_ID'];
          $fullname = $row['fullname'];
          $bank_account = $row['bank_name'];
          $account_funds = $row['account_funds'];
          $reference_bank_amount = $row['reference_bank_amount'];
          $entry_date = $row['entry_date'];
          $entry_time = $row['entry_time'];
        
          
              $list = array($ledger_ID,$ledger_type,$amount,$description,$bank_account,$reference_bank_amount,$account_funds,$entry_date,$entry_time,$fullname);
          
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

   


  }


  if(isset($_POST["debtor_outstanding_filter"])){


    $filter =$_POST['filter'];
  
    if(empty($filter)){


      $date = date('d-m-y h:i');
      $filename = "Outstanding Transactions $date.csv";
      $fp = fopen('php://output', 'w');
      
      //create header 


      $header = array("ID","Transaction Type","Amount", "Entry Date","Entry Time","status");	
      fputcsv($fp, $header);
      
      //create body

      $sql ="SELECT `transaction_ID`, `type`, `action_name`, `action_ID`, `C_D_ID`, `amount`,
      `trans_date`, `trans_time`, `trans_status`, `user_ID` FROM `transaction` WHERE 
      `trans_status` = 'partly_payed' OR `trans_status` = 'payment_pending' ORDER BY `transaction_ID` DESC";
      
      $result = $con->query($sql);
      if($result->num_rows>0)
      {
          while($row=$result->fetch_assoc())
          {

          $transaction_ID = $row["transaction_ID"];                                 
          $type = $row["type"];
          $amount  = $row['amount'];
          $trans_date = $row['trans_date'];
          $trans_time= $row['trans_time'];
          $trans_status = $row['trans_status'];
         
        
          
              $list = array($transaction_ID,$type,$amount,$trans_date,$trans_time,$trans_status);
          
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

    else{

      
      $fromValue = $_POST['from_hidden'];
      $toValue = $_POST['to_hidden'];
      $typeValue = $_POST['trans_type_hidden'];


      $date = date('d-m-y h:i');
      $filename = "Outstanding Transactions $date.csv";
      $fp = fopen('php://output', 'w');
      
      //create header 


      $header = array("ID","Transaction Type","Amount", "Entry Date","Entry Time","status");	
      fputcsv($fp, $header);
      
      //create body
      
      




$sql = "SELECT `transaction_ID`, `type`, `action_name`,
 `action_ID`, `C_D_ID`, `amount`,
`trans_date`, `trans_time`, `trans_status`,
 `user_ID` FROM `transaction` WHERE `type` = '$typeValue' AND
  `trans_date` BETWEEN '$fromValue' AND '$toValue' ORDER BY `transaction_ID` DESC";

      $result = $con->query($sql);
      if($result->num_rows>0)
      {
          while($row=$result->fetch_assoc())
          {

          $transaction_ID = $row["transaction_ID"];                                 
          $type = $row["type"];
          $amount  = $row['amount'];
          $trans_date = $row['trans_date'];
          $trans_time= $row['trans_time'];
          $trans_status = $row['trans_status'];
        
          
          $list = array($transaction_ID,$type,$amount,$trans_date,$trans_time,$trans_status);
          
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





  }


  ///filter for debtor processed pay



  if(isset($_POST["debtor_processed_filter"])){


    $filter =$_POST['filter'];
  
    if(empty($filter)){


      $date = date('d-m-y h:i');
      $filename = "Processed Transactions $date.csv";
      $fp = fopen('php://output', 'w');
      
      //create header 


      $header = array("ID","Transaction Type","Amount", "Entry Date","Entry Time","status");	
      fputcsv($fp, $header);
      
      //create body

      $sql ="SELECT `transaction_ID`, `type`, `action_name`, `action_ID`, `C_D_ID`, `amount`,
      `trans_date`, `trans_time`, `trans_status`, `user_ID` FROM `transaction` WHERE 
      `trans_status` = 'partly_payed' OR `trans_status` = 'fully_payed' ORDER BY `transaction_ID` DESC";
      
      $result = $con->query($sql);
      if($result->num_rows>0)
      {
          while($row=$result->fetch_assoc())
          {

          $transaction_ID = $row["transaction_ID"];                                 
          $type = $row["type"];
          $amount  = $row['amount'];
          $trans_date = $row['trans_date'];
          $trans_time= $row['trans_time'];
          $trans_status = $row['trans_status'];
         
        
          
              $list = array($transaction_ID,$type,$amount,$trans_date,$trans_time,$trans_status);
          
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

    else{

      
      $fromValue = $_POST['from_hidden'];
      $toValue = $_POST['to_hidden'];
      $typeValue = $_POST['trans_type_hidden'];


      $date = date('d-m-y h:i');
      $filename = "Processed Transactions $date.csv";
      $fp = fopen('php://output', 'w');
      
      //create header 


      $header = array("ID","Transaction Type","Amount", "Entry Date","Entry Time","status");	
      fputcsv($fp, $header);
      
      //create body
      
      




$sql = "SELECT `transaction_ID`, `type`, `action_name`,
 `action_ID`, `C_D_ID`, `amount`,
`trans_date`, `trans_time`, `trans_status`,
 `user_ID` FROM `transaction` WHERE `type` = '$typeValue' AND `trans_status` = 'fully_payed' AND
  `trans_date` BETWEEN '$fromValue' AND '$toValue' ORDER BY `transaction_ID` DESC";

      $result = $con->query($sql);
      if($result->num_rows>0)
      {
          while($row=$result->fetch_assoc())
          {

          $transaction_ID = $row["transaction_ID"];                                 
          $type = $row["type"];
          $amount  = $row['amount'];
          $trans_date = $row['trans_date'];
          $trans_time= $row['trans_time'];
          $trans_status = $row['trans_status'];
        
          
          $list = array($transaction_ID,$type,$amount,$trans_date,$trans_time,$trans_status);
          
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





  }

  if(isset($_POST["debtor_outstanding_order_details"])){



          
    $order_ID = $_POST['order_id'];
    $customer = $_POST['customer_name'];
    


    $date = date('d-m-y h:i');
    $filename = "Order for $customer - $date.csv";
    $fp = fopen('php://output', 'w');
    
    //create header 


    $header = array("Item ID","Crop","Variety","Class","Quantity","Price Per Kg","Discount","Total");	
    fputcsv($fp, $header);
    
    //create body
    
    




$sql = "SELECT `item_ID`, `order_ID`, `crop_ID`, `variety_ID`,
`class`, `quantity`, `stock_out_quantity`, `price_per_kg`,
 `discount_price`, `status`, `total_price` FROM `item` WHERE `order_ID` ";

    $result = $con->query($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {

        $transaction_ID = $row["transaction_ID"];                                 
        $type = $row["type"];
        $amount  = $row['amount'];
        $trans_date = $row['trans_date'];
        $trans_time= $row['trans_time'];
        $trans_status = $row['trans_status'];
      
        
        $list = array($transaction_ID,$type,$amount,$trans_date,$trans_time,$trans_status);
        
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
