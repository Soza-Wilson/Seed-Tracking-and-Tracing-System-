<?php


require('../fpdf/fpdf.php');
$date = date("d-m-Y");
$time = date("H:i:s"); 

class pdf_handler{

      
    

function create_qr(){



}


function create_dispatch($order_id){

    $sql = "SELECT * FROM `stock_out` WHERE `order_ID`= '$order_id'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {





             $name   = $row["name"];
            

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial','',13);
            $pdf->Cell(150,10,'MultiSeeds Company LTD!',0,0);
            $pdf->Cell(52,10,'INVOICE',0,1);
            $pdf->Cell(150,11,'Along Bwemba road',0,0);
            $pdf->Cell(15,10,'Date:',0,0);
            $pdf->Cell(26,10,$name,0,1);
            $pdf->Cell(150,11,'Along Bwemba road',0,0);
            $pdf->Cell(15,10,$name,0,0);
            $pdf->Cell(26,10,$value,0,1);
            $pdf->Output();
            
        }

    }


}

function create_pdf($type,$customer_data,$details_dat){


    /// the function needs to be getting the document type, customer info in an array, and details info in an array


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',13);
$pdf->Cell(150,10,'MultiSeeds Company LTD!',0,0);
$pdf->Cell(52,10,'INVOICE',0,1);
$pdf->Cell(150,11,'Along Bwemba road',0,0);
$pdf->Cell(15,10,'Date:',0,0);
$pdf->Cell(26,10,$value,0,1);
$pdf->Cell(150,11,'Along Bwemba road',0,0);
$pdf->Cell(15,10,'time:',0,0);
$pdf->Cell(26,10,$value,0,1);
$pdf->Output();







}


}





?>