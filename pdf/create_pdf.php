<?php
require('../fpdf/fpdf.php');
class create_pdf{








}


$value = "22,10,2022";

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
?>