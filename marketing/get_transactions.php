<?php





$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/marketing.php');
include('../class/main.php');


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
