<?php 

require('../class/main.php');


require 'PhpOffice/PhpSpreadsheet/src/PhpSpreadsheet/IOFactory.php';


use PhpOffice\PhpSpreadsheet\IOFactory;





// Rest of the code...





// Check if the form is submitted and the file is uploaded

if(isset($_POST["upload_excel"])){

   
}
if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
    // Get the temporary file path of the uploaded file
    $excelFile = $_FILES['excelFile']['tmp_name'];

    // Load the Excel file
    $spreadsheet = IOFactory::load($excelFile);

    // Connect to your database
    // Get the active sheet in the Excel file
    $sheet = $spreadsheet->getActiveSheet();

    // Iterate through the rows of the sheet and insert data into the database
    foreach ($sheet->getRowIterator() as $row) {
        //$rowData = $row->toArray();
        $sql = "INSERT INTO your_table_name (column1, column2, column3) VALUES (?, ?, ?)";
        $statement = $con->prepare($sql);
        $statement->execute($rowData);
    }

    // Close the database connection
    $conn = null;

    // Output success message
    echo "Data inserted successfully!";
} else {
    // Handle any errors that occurred during the file upload
    echo "Error uploading the file.";
}