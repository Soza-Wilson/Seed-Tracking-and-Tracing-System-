
<?php



if (isset($_FILES['conformationFile'])) {

    $errors = array();
    $file_name = $_FILES['conformationFile']['name'];
    $file_size = $_FILES['conformationFile']['size'];
    $file_tmp = $_FILES['conformationFile']['tmp_name'];
    $file_type = $_FILES['conformationFile']['type'];

    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["conformationFile"]["name"]));
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["conformationFile"]["tmp_name"], "../files/production/handover_conformation_documents/" . $newfilename);
    } else {
    }

    $data = array("filename" => "$newfilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}

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

    $data = array("filename" => "$newfilename");
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

    $data = array("filename" => "$newfilename");
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

    $data = array("filename" => "$newfilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}

// if (isset($_FILES['logo_image'])) {

//     $errors = array();
//     $file_name = $_FILES['logo_image']['name'];
//     $file_size = $_FILES['logo_image']['size'];
//     $file_tmp = $_FILES['logo_image']['tmp_name'];
//     $file_type = $_FILES['logo_image']['type'];

//     $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["logo_image"]["name"]));
//     if ($file_size > 2097152) {
//         $errors[] = 'File size must be excately 2 MB';
//     }

//     if (empty($errors) == true) {
//         move_uploaded_file($_FILES["logo_image"]["tmp_name"], "../files/business_logo/" . $newfilename);
//     } else {
//     }

//     $data = array("filename" => "$newfilename");
//     $eco_data = json_encode($data);
//     echo $eco_data;
// }
if (isset($_FILES['logo_image'])) {


    $uploadedFile = $_FILES['logo_image']['tmp_name'];

    $sourceImage = imagecreatefromjpeg($uploadedFile);

    // Get the dimensions of the uploaded image
    $sourceWidth = imagesx($sourceImage);
    $sourceHeight = imagesy($sourceImage);

    // Calculate the new dimensions for the resized image
    $thumbnailSize = min($sourceWidth, $sourceHeight);

    // Create a blank canvas for the resized image
    $thumbnailImage = imagecreatetruecolor($thumbnailSize, $thumbnailSize);

    // Resize the image
    imagecopyresampled($thumbnailImage, $sourceImage, 0, 0, 0, 0, $thumbnailSize, $thumbnailSize, $sourceWidth, $sourceHeight);

    // Generate a unique filename for the resized image
    $thumbnailFilename = uniqid('thumbnail_') . '.jpg';

    // save in ne file location
    $uploadDirectory = "../files/business_logo/";

    // Save the resized image to the upload directory
    imagejpeg($thumbnailImage, $uploadDirectory . $thumbnailFilename);

    // Clean up resources
    imagedestroy($sourceImage);
    imagedestroy($thumbnailImage);


    //$resizedImagePath = "../files/user_profile/" . $newfilename;


    $data = array("filename" => "$thumbnailFilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}


// if (isset($_FILES['profile'])) {

//     $errors = array();
//     $file_name = $_FILES['profile']['name'];
//     $file_size = $_FILES['profile']['size'];
//     $file_tmp = $_FILES['profile']['tmp_name'];
//     $file_type = $_FILES['profile']['type'];

//     $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["profile"]["name"]));
//     if ($file_size > 2097152) {
//         $errors[] = 'File size must be excately 2 MB';
//     }

//     if (empty($errors) == true) {
//         move_uploaded_file($_FILES["profile"]["tmp_name"], "../files/user_profile/" . $newfilename);

//     } else {

//     }

//     $data = array("filename" =>"$newfilename");
//     $eco_data = json_encode($data);
//     echo $eco_data;
// }


if (isset($_FILES['profile'])) {


    $uploadedFile = $_FILES['profile']['tmp_name'];

    $sourceImage = imagecreatefromjpeg($uploadedFile);

    // Get the dimensions of the uploaded image
    $sourceWidth = imagesx($sourceImage);
    $sourceHeight = imagesy($sourceImage);

    // Calculate the new dimensions for the resized image
    $thumbnailSize = min($sourceWidth, $sourceHeight);

    // Create a blank canvas for the resized image
    $thumbnailImage = imagecreatetruecolor($thumbnailSize, $thumbnailSize);

    // Resize the image
    imagecopyresampled($thumbnailImage, $sourceImage, 0, 0, 0, 0, $thumbnailSize, $thumbnailSize, $sourceWidth, $sourceHeight);

    // Generate a unique filename for the resized image
    $thumbnailFilename = uniqid('thumbnail_') . '.jpg';

    // save in ne file location
    $uploadDirectory = "../files/user_profile/";

    // Save the resized image to the upload directory
    imagejpeg($thumbnailImage, $uploadDirectory . $thumbnailFilename);

    // Clean up resources
    imagedestroy($sourceImage);
    imagedestroy($thumbnailImage);


    //$resizedImagePath = "../files/user_profile/" . $newfilename;


    $data = array("filename" => "$thumbnailFilename");
    $eco_data = json_encode($data);
    echo $eco_data;
}






// $file_name = $_FILES['file']['name'];
// $file_size = $_FILES['file']['size'];















?>