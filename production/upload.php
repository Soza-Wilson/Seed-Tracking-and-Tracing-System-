
<?php




if (isset($_FILES['file'])) {

    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["file"]["name"]));
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["file"]["tmp_name"], "../files/production/stock_in_documents/" . $newfilename);
        
    } else {
       
    }

    $data = array("filename" =>"$newfilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}

if (isset($_FILES['file_certificate'])) {

    $errors = array();
    $file_name = $_FILES['file_certificate']['name'];
    $file_size = $_FILES['file_certificate']['size'];
    $file_tmp = $_FILES['file_certificate']['tmp_name'];
    $file_type = $_FILES['file_certificate']['type'];

    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["file_certificate"]["name"]));
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["file_certificate"]["tmp_name"], "../files/production/seed_certificate/" . $newfilename);
        
    } else {
       
    }

    $data = array("filename" =>"$newfilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}

if (isset($_FILES['growerFile'])) {

    $errors = array();
    $file_name = $_FILES['growerFile']['name'];
    $file_size = $_FILES['growerFile']['size'];
    $file_tmp = $_FILES['growerFile']['tmp_name'];
    $file_type = $_FILES['growerFile']['type'];

    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["growerFile"]["name"]));
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["growerFile"]["tmp_name"], "../files/production/creditor_documents/" . $newfilename);
        
    } else {
       
    }

    $data = array("filename" =>"$newfilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}

// $file_name = $_FILES['file']['name'];
// $file_size = $_FILES['file']['size'];















?>