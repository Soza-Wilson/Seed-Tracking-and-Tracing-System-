<?php

use function PHPSTORM_META\type;

require('../pdf/fpdf.php');
require('main.php');
$pdf_type = "receipt"; 



 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../pdf/logo.png',0,5,0);
    // Arial bold 15
    $this->SetFont('Arial','',10);
    // Move to the right
     $this->Cell(80);
    // Title
    // $this->Cell(20,10,'   P.O Box 2281, Lilongwe,Malawi',0,0,'');
    // //
    // $this->Cell(20,24,'Along Likuni Road',0,0,'c');
    // $this->Cell(20,31,'Tel: +265 (0) 994870500/400/500',0,0,'c');
    // $this->Cell(20,39,'info@musecomalawi.com',0,0,'c');
    // $this->Cell(20,46,'www.musecomalawi.com',0,0,'c');
    

    // Line break
    $this->Ln(20);
   
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


class pdf_handler{

    function create_receipt(){

     $debtor_name=""; 
     $debtor_phone=""; 
     $user_name="";
     $payment_date="";
     $payment_time="";
     $payment_id="";
     $payment_type="";
     $order_id =$_GET['order_id']; 
     $total =$_GET['total']; 
     //$payment_id =$$_GET['payment_id'];

//getting customer details

$sql="SELECT `debtor_ID`, `name`, `phone`, `email`,
 `description`, `debtor_type`, `user_ID`, 
 `debtor_files`, `registered_date`, `account_funds` FROM `debtor` ";
    global $con;

$result = $con->query($sql);
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $debtor_name = $row["name"];
         $debtor_phone  = $row["phone"];
         

     }
    }


// getting payment details 

$sql="SELECT `payment_ID`,user.fullname, `type`, `amount`, `description`, `documents`, `cheque_number`,
 `bank_name`, `account_name`, payment.date, payment.time, `transaction_ID` FROM `payment` INNER JOIN user ON payment.user_ID = user.user_ID";

$result = $con->query($sql);
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $user_name = $row["fullname"];
         $payment_date = $row["date"];
         $payment_time = $row["time"];
         $payment_id = $row["payment_ID"];
         $payment_type = $row["type"];

     }
    }

 // Instanciation of inherited class
 $pdf = new PDF();
 $pdf->AliasNbPages();
 $pdf->AddPage();
 $pdf->SetFont('Arial','B','',18);
 // for($i=1;$i<=20;$i++)
 //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
 $pdf->Cell(65,40,'',0,0,'c');
 $pdf->Cell(60,40,'           RECEIPT ',0);
 $pdf->Ln();
 $pdf->SetFont('Times','','',12);
 
 /// customer details
 $pdf->Cell(20,5,"Name________: $debtor_name",0,0,'');
 $pdf->Ln();
 $pdf->Cell(20,5,"phone________: $debtor_phone",0,0,'');
 $pdf->Ln();
 $pdf->Cell(20,5,"Date_________: $payment_date",0,0,'');
 $pdf->Ln();
 $pdf->Cell(20,5,"Time_________: $payment_time",0,0,'');
 $pdf->Ln();
 $pdf->Cell(20,5,"Payment ID____: $payment_id",0,0,'');
 $pdf->Ln();
 $pdf->Cell(20,5,"Payment type__: $payment_type",0,0,'');
 $pdf->Ln();
 
 $pdf->SetFont('Times','B','',12);
 $pdf->Cell(60,20,'',0,0,'C');
 $pdf->Cell(60,20,'Transaction Details',0,0,'C');
 $pdf->Ln();
 
 
 $pdf->SetFont('Times','B','',10);
 $pdf->Cell(30,5,'Quantity',1,0,'C');
 $pdf->Cell(120,5,'Description',1,0,'C');
 $pdf->Cell(30,5,'Amount',1,0,'C');
 $pdf->Ln();
 
 // get order details through transaction ID 
 
 $sql = "SELECT `item_ID`, `crop`, `variety`, `class`, `quantity`,`price_per_kg`,`discount_price`,`total_price` FROM
 `item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID WHERE `order_ID`='$order_id'";
  global $con;
 
 
 $result = $con->query($sql);
 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         $item_ID = $row["item_ID"];
         $crop   = $row["crop"];
         $variety = $row["variety"];
         $class = $row["class"];
         $quantity = $row['quantity'];
         $price = $row['price_per_kg'];
         $discount = $row['discount_price'];
         $total_price = $row['total_price'];
 
 //transaction table
 
 $pdf->SetFont('Times','','',10);
 $pdf->Cell(30,5,$quantity,1,0,'C');
 $pdf->Cell(120,5,"$crop / $variety / $class",1,0,'C');
 $pdf->Cell(30,5, $total_price,1,0,'C');
 $pdf->Ln();
 
 }
 }

 //Items total
 $pdf->SetFont('Times','B','',10);
 $pdf->Cell(150,5,'TOTAL',0,0,'R');
 $pdf->Cell(30,5,"$total",1,0,'C');
 $pdf->Ln();


 
 $pdf->Output();
 



    }


}

if ($pdf_type="receipt"){
    $object = new pdf_handler();
    $object->create_receipt();
    
    }


        
  





?>

