<?php

require('../../class/LabTest/LabTest.php');
require('../../pdf/fpdf.php');
spl_autoload_register(function ($class) {
    if (file_exists('../../class/LabTest/' . $class . '.php')) {
        require '../../class/LabTest/' . $class . '.php';
    } elseif (file_exists('../../class/' . $class . '.php')) {
        require   '../../class/' . $class . '.php';
    }
   
});


if (isset($_POST['test_seed'])) {
    $data = $_POST['test_seed'];
    $lab_test = new AddLabTest($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]);
    echo $lab_test->register_lab_test();
}

if (isset($_POST['certify_seed_data'])) {
    $data_object = $_POST['certify_seed_data'];
    $lab_test = new LabCertifySeed($data_object['lot_number'], $data_object['stock_in_id'], $data_object['quantity'], $data_object['test_id'],$data_object['stock_in_status']);
    echo $lab_test->certify_seed();
}


if (isset($_POST['get_stock_in_status'])) {
    $inventory = new InventoryManager();
    echo $inventory->get_stock_in_status($_POST['get_stock_in_status']);


}

if(isset($_POST['generate_test_report'])) {
    $test_id = $_POST['generate_test_report'];
    // $pdf = new createPdf();
    // header("Location:../class/pdf_handler.php?");
    return "Wuksahada";

}
