<?php

include('../class/main.php');
if(isset($_POST['save_csv']))
{


  
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


?>