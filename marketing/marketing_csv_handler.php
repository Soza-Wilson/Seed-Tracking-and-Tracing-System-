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
if(isset($_POST['orders_save_csv'])){

    $date = date('d-m-y h:i');
    $filename = "Processed Orders $date.csv";
    $fp = fopen('php://output', 'w');
    $filter= $_POST["filter"];
    
    //create header 


    $header = array("Order ID","Customer Name","Order Type","Requested By", "Date","Time","Count","Total Price");	
    fputcsv($fp, $header);
    
    //create body
    
     if(empty($filter)){

        $sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
    order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID WHERE status = 'processed'";
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

            $list = array($order_ID,$customer_name,$order_type,$order_by,$date,$time,$count,$total);
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
        $page_type = $_POST["order_type_hidden"];
        $customer_type = $_POST["customer_type_hidden"];
        $customer_id =$_POST["customer_id_hidden"];

        

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
    
                $list = array($order_ID,$customer_name,$order_type,$order_by,$date,$time,$count,$total);
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

if(isset($_POST['all_orders_save_csv'])){

    $date = date('d-m-y h:i');
    $filename = "All Orders $date.csv";
    $fp = fopen('php://output', 'w');
    $filter= $_POST["filter"];
    
    //create header 


    $header = array("Order ID","Customer Name","Order Type","Requested By", "Date","Time","Count","Total Price");	
    fputcsv($fp, $header);
    
    //create body
    
     if(empty($filter)){

        $sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
    order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID";
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

            $list = array($order_ID,$customer_name,$order_type,$order_by,$date,$time,$count,$total);
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
        $page_type = $_POST["order_type_hidden"];
        $customer_type = $_POST["customer_type_hidden"];
        $customer_id =$_POST["customer_id_hidden"];

        

        $sql = "SELECT `order_ID`, `order_type`, user.fullname, `customer_name`, `order_book_number`, `status`, order_table.date, 
        order_table.time, `count`, `total_amount` FROM `order_table` INNER JOIN user ON user.user_ID = order_table.user_ID WHERE
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
    
                $list = array($order_ID,$customer_name,$order_type,$order_by,$date,$time,$count,$total);
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

if(isset($_POST['sales_save_csv'])){

    $date = date('D-m-y h:i');
    $filename = "Sales $date.csv";
    $fp = fopen('php://output', 'w');
    $filter= $_POST["filter"];
    




    $header = array("Order ID","Item Number","Crop","Variety", "Class","Quantity","Price Per Kg","Discount","Total price","Order By","Customer Name","Order Type","Date");	
    fputcsv($fp, $header);
    
    //create body
    
     if(empty($filter)){

        $sql = "SELECT item.order_ID,item.item_ID,crop.crop,user.fullname,variety.variety,item.class,item.price_per_kg,item.discount_price,order_table.order_type,item.quantity,item.total_price,order_table.date,order_table.customer_name
        FROM item INNER JOIN crop ON crop.crop_ID = item.crop_ID INNER JOIN variety ON variety.variety_ID = item.variety_ID INNER JOIN order_table ON order_table.order_ID = item.order_ID 
        INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.status='processed' ORDER BY order_table.order_ID DESC;";

       $result = $con->query($sql);
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {

               $order_ID =$row["order_ID"];

               $item_ID      = $row["item_ID"];
               $crop     = $row["crop"];
               $order_by=$row["fullname"];
               $customer=$row["customer_name"];
               $order_date=$row["date"];
               $variety = $row["variety"];
               $class    = $row['class'];
               $quantity = $row['quantity'];
               $price_per_kg = $row['price_per_kg'];
               $order_type = $row['order_type'];
               $discount_price = $row['discount_price'];
               $total_price = $row['total_price'];

            $list = array($order_ID,$item_ID,$crop,$variety,$class,$quantity,$price_per_kg,$discount_price,$total_price,$order_by,$customer,$order_type,$order_date);
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
        $customerType=$_POST["customer_type_hidden"];
        $cropValue = $_POST["cropValueHidden"];
        $varietyValue = $_POST["varietyValueHidden"];
        $classValue = $_POST["classValueHidden"];
        

        $sql = "SELECT item.order_ID,item.item_ID,crop.crop,user.fullname,variety.variety,item.class,item.price_per_kg,item.discount_price,order_table.order_type,item.quantity,item.total_price,order_table.date,order_table.customer_name
        FROM item INNER JOIN crop ON crop.crop_ID = item.crop_ID INNER JOIN variety ON variety.variety_ID = item.variety_ID INNER JOIN order_table ON order_table.order_ID = item.order_ID 
        INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.status='processed' AND order_table.order_type='$customerType' AND item.crop_ID='$cropValue' AND item.variety_ID='$varietyValue' AND item.class='$classValue'
         AND order_table.date BETWEEN '$fromValue' AND '$toValue' ORDER BY order_table.order_ID DESC;";
       
        $result = $con->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
    
    
                $order_ID =$row["order_ID"];

               $item_ID      = $row["item_ID"];
               $crop     = $row["crop"];
               $order_by=$row["fullname"];
               $customer=$row["customer_name"];
               $order_date=$row["date"];
               $variety = $row["variety"];
               $class    = $row['class'];
               $quantity = $row['quantity'];
               $price_per_kg = $row['price_per_kg'];
               $order_type = $row['order_type'];
               $discount_price = $row['discount_price'];
               $total_price = $row['total_price'];

            $list = array($order_ID,$item_ID,$crop,$variety,$class,$quantity,$price_per_kg,$discount_price,$total_price,$order_by,$customer,$order_type,$order_date);
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
