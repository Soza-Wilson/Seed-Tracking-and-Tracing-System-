<?php
// Check if the form is submitted and the file is uploaded
if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
  // Include the PHPExcel or PhpSpreadsheet library
  require 'path_to_library/PHPExcel.php'; // or require 'path_to_library/PhpSpreadsheet.php';

  // Get the temporary file path of the uploaded file
  $excelFile = $_FILES['excelFile']['tmp_name'];

  // Create a new PHPExcel or PhpSpreadsheet object
  $objPHPExcel = PHPExcel_IOFactory::load($excelFile); // or $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);

  // Connect to your database
  $dbHost = 'your_host';
  $dbName = 'your_database_name';
  $dbUser = 'your_username';
  $dbPass = 'your_password';
  $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

  // Get the active sheet in the Excel file
  $sheet = $objPHPExcel->getActiveSheet();

  // Iterate through the rows of the sheet and insert data into the database
  foreach ($sheet->getRowIterator() as $row) {
    $rowData = $row->getArrayCopy();
    $sql = "INSERT INTO your_table_name (column1, column2, column3) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($rowData);
  }

  // Close the database connection
  $conn = null;

  // Output success message
  echo "Data inserted successfully!";
} else {
  // Handle any errors that occurred during the file upload
  echo "Error uploading the file.";
}
?>



use PhpOffice\PhpSpreadsheet\IOFactory;

// Check if the form is submitted and the file is uploaded
if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
    // Get the temporary file path of the uploaded file
    $excelFile = $_FILES['excelFile']['tmp_name'];

    // Load the Excel file
    $spreadsheet = IOFactory::load($excelFile);

    // Connect to your database
    $dbHost = 'your_host';
    $dbName = 'your_database_name';
    $dbUser = 'your_username';
    $dbPass = 'your_password';
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

    // Get the active sheet in the Excel file
    $sheet = $spreadsheet->getActiveSheet();

    // Iterate through the rows of the sheet and insert data into the database
    foreach ($sheet->getRowIterator() as $row) {
        $rowData = $row->toArray();
        $sql = "INSERT INTO your_table_name (column1, column2, column3) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($rowData);
    }

    // Close the database connection
    $conn = null;

    // Output success message
    echo "Data inserted successfully!";
} else {
    // Handle any errors that occurred during the file upload
    echo "Error uploading the file.";
}
?>
