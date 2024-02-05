<?php
require('../pdf/fpdf.php');
spl_autoload_register(function ($class) {
    if (file_exists('../class/LabTest/' . $class . '.php')) {
        require '../class/LabTest/' . $class . '.php';
    } elseif (file_exists('../class/' . $class . '.php')) {
        require   '../class/' . $class . '.php';
    }
});
$document = $_GET['document'];

class CreatePdf
{
    
    private $pdf;
    public function __construct()
    {
        $this->pdf = new FPDF();
    }


   

    private function check_if_empty($data): string
    {

        if ($data == '') {
            return '-';
        } else {
            return $data . " %";
        }
    }


    public function create_test_report($id)
    {
        $getData = new GetLabTestData();
        $test_details = $getData->get_test_details($id);

        // return 'aadd';
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B',  20);
        $this->pdf->Cell(200, 10, '                                                                        LAB TEST ', 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(190, 1.5, '', 1, 0, '', true);
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(200, 10, '                                                                        Test Details', 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(150, 6, 'TEST ID :   ' . $test_details['test_ID'], 0, 0, 'right');
        $this->pdf->Cell(150, 6, 'Tested Date:   ' . Util::convert_date($test_details['date']), 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(150, 5, 'Crop :          ' . $test_details['crop'], 0, 0, 'right');
        $this->pdf->Cell(150, 6, 'Tested Date:   ' . $test_details['time'], 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(150, 5, 'Variety :       ' . $test_details['variety'], 0, 0, 'right');
        $this->pdf->Cell(150, 5, 'Tested By:   ' . $test_details['fullname'], 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(100, 5, 'Class:          ' . $test_details['class'], 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(190, 1.5, '', 1, 0, '', true);
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(200, 10, '                                                                        Field Details', 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(150, 5, 'Grower Name / Source Name :   ' . $test_details['creditor'], 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(150, 5, 'Physical Address:                        ' . $test_details['physical_address'], 0, 0, 'right');

        $this->pdf->Ln();
        $this->pdf->Cell(190, 1.5, '', 1, 0, '', true);
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(200, 10, '                                                                        Test Results', 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 9);

        $this->pdf->Cell(150, 5, 'Germination Percentage : ', 0, 0, 'right');
        $this->pdf->Cell(150, 6,  $test_details['germination_percentage'] . " %", 0, 0, 'right');
        $this->pdf->Ln();
        $this->pdf->Cell(190, 0.3, '', 1, 0, '', true);
        $this->pdf->Ln();

        $this->pdf->Cell(150, 5, 'Shelling Percentage :', 0, 0, 'right');
        $this->pdf->Cell(150, 6,  $this->check_if_empty($test_details['shelling_percentage']), 0, 0, 'right');
        $this->pdf->Ln();

        $this->pdf->Cell(190, 0.3, '', 1, 0, '', true);
        $this->pdf->Ln();

        $this->pdf->Cell(150, 5, 'Oil Content Percentage:', 0, 0, 'right');
        $this->pdf->Cell(150, 6, $this->check_if_empty($test_details['oil_content']), 0, 0, 'right');
        $this->pdf->Ln();

        $this->pdf->Cell(190, 0.3, '', 1, 0, '', true);
        $this->pdf->Ln();

        $this->pdf->Cell(150, 5, 'Moisture Content :          ', 0, 0, 'right');
        $this->pdf->Cell(150, 6, $this->check_if_empty($test_details['moisture_content']), 0, 0, 'right');
        $this->pdf->Ln();

        $this->pdf->Cell(190, 0.3, '', 1, 0, '', true);
        $this->pdf->Ln();

        $this->pdf->Cell(150, 5, 'Purity Percentage :          ', 0, 0, 'right');
        $this->pdf->Cell(150, 6,  $test_details['purity_percentage'] . " %", 0, 0, 'right');
        $this->pdf->Ln();

        $this->pdf->Cell(190, 0.3, '', 1, 0, '', true);
        $this->pdf->Ln();

        $this->pdf->Cell(150, 5, 'Defects Percentage:          ', 0, 0, 'right');
        $this->pdf->Cell(150, 6,  $test_details['defects_percentage'] . " %", 0, 0, 'right');
        $this->pdf->Ln();

        $this->pdf->Cell(190, 0.3, '', 1, 0, '', true);
        $this->pdf->Ln();
        $this->pdf->Cell(190, 30, '', 0, 0, '', false);
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial', '', 11);


        $this->pdf->Cell(150, 5, 'Overall Result:          ', 0, 0, 'right');
        $this->pdf->Cell(150, 6,  $test_details['grade'], 0, 0, 'right');
        $this->pdf->Ln();

        $this->pdf->Cell(190, 2, '', 1, 0, '', true);
        $this->pdf->Ln();

        $this->pdf->Cell(190, 100, '', 0, 0, '', FALSE);
        $this->pdf->Ln();




        // Arial italic 8
        $this->pdf->SetFont('Arial', 'I', 8);
        // Page number
        $this->pdf->Cell(0, 10, 'Page ' . $this->pdf->PageNo() . '/{nb}', 0, 0, 'C');

        $this->pdf->Output();
    }
}

$object = new CreatePdf();
switch ($document) {
    case "test_report":
        $test_id = $_GET['test_id'];
        $object->create_test_report($test_id);
        break;
}
