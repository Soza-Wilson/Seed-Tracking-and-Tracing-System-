<?php
include('../class/main.php');
if(isset($_POST['stock_in_csv'])){

    $date = date('D-m-y h:i');
    $filename = "Stock In $date.csv";
    $fp = fopen('php://output', 'w');
    $filter= $_POST["filter"];
    
    
    
    
    
    $header = array("Stock in ID","Crop","Variety", "Class","Quantity","Used Quantity","Available Quantity","Source","Source Name","Srn","Added by","Date");	
    fputcsv($fp, $header);
    
    //create body
    if(empty($filter)){


        
    
       


$sql = "SELECT `stock_in_ID`, `fullname`,stock_in.source, `name`, `crop`, 
                              `variety`, `class`, `SLN`, `bincard`, `number_of_bags`,
                               `quantity`,`used_quantity`,`available_quantity`, `date` ,`supporting_dir` FROM `stock_in` 
                              INNER JOIN user ON stock_in.user_ID = user.user_ID 
                              INNER JOIN creditor ON stock_in.creditor_ID = creditor.creditor_ID 
                              INNER JOIN crop ON stock_in.crop_ID = crop.crop_ID 
                              INNER JOIN variety on stock_in.variety_ID = variety.variety_ID ORDER BY stock_in_ID DESC";
    
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
            $newDate = $object-> change_date_format($date_added);
    
            $list = array($stock_in_id,$crop,$variety,$class,$quantity,$used_quantity,$available_quantity,$source,$source_name,$srn,$user,$newDate);
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
        $creditor_name=$_POST["creditor_hidden"];
        $cropValue = $_POST["cropValueHidden"];
        $varietyValue = $_POST["varietyValueHidden"];
        $classValue = $_POST["classValueHidden"];
    
    
        $sql = "SELECT `stock_in_ID`, `fullname`,stock_in.source, `name`, `crop`, 
        `variety`, `class`, `SLN`, `bincard`, `number_of_bags`,
         `quantity`,`used_quantity`,`available_quantity`, `date` ,`supporting_dir` FROM `stock_in` 
        INNER JOIN user ON stock_in.user_ID = user.user_ID 
        INNER JOIN creditor ON stock_in.creditor_ID = creditor.creditor_ID 
        INNER JOIN crop ON stock_in.crop_ID = crop.crop_ID 
        INNER JOIN variety on stock_in.variety_ID = variety.variety_ID WHERE creditor.name like '%$creditor_name%' AND stock_in.crop_ID ='$cropValue' AND stock_in.variety_ID='$varietyValue' AND stock_in.class='$classValue' AND stock_in.date BETWEEN '$fromValue' AND '$toValue' ORDER BY stock_in_ID DESC";
        $result = $con->query($sql);


        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
    
    
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
                $newDate = $object-> change_date_format($date_added);
        
                $list = array($stock_in_id,$crop,$variety,$class,$quantity,$used_quantity,$available_quantity,$source,$source_name,$srn,$user,$newDate);
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