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



?>