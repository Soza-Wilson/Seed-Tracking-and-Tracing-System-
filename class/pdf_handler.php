<?php
include('../class/main.php');
require('../pdf/fpdf.php');

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

class pdf_handler extends main {

    function create_receipt(){



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
$pdf->SetFont('Arial','','',12);

/// customer details
$pdf->Cell(20,5,'Name :',0,0,'C');
$pdf->Ln();
$pdf->Cell(18,5,'Date :',0,0,'C');
$pdf->Ln();
$pdf->Cell(29,5,'Payment ID :',0,0,'C');
$pdf->Ln();
$pdf->Cell(32,5,'Payment type :',0,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','B','',12);
$pdf->Cell(60,20,'',0,0,'C');
$pdf->Cell(60,20,'Transaction Details',0,0,'C');
$pdf->Ln();


$pdf->SetFont('Arial','B','',10);
$pdf->Cell(30,5,'Quantity',1,0,'C');
$pdf->Cell(120,5,'Description',1,0,'C');
$pdf->Cell(30,5,'Amount',1,0,'C');
$pdf->Ln();

// get trasac

$sql = "SELECT `item_ID`, `crop`, `variety`, `class`, `quantity`,`price_per_kg`,`discount_price`,`total_price` FROM
`item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID";



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

$pdf->SetFont('Arial','','',10);
$pdf->Cell(30,5,$quantity,1,0,'C');
$pdf->Cell(120,5,"$crop / $variety / $class",1,0,'C');
$pdf->Cell(30,5, $price,1,0,'C');
$pdf->Ln();

}
}

$pdf->Output();



        
    }


}





?>

