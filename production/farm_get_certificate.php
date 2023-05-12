<?php
$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);



// getting registered grower 

if (isset($_POST['grower_search_value'])) {



  $search_value = $_POST['grower_search_value'];


  $sql = "SELECT `creditor_ID`, `source`, `name`, `phone`, `email`, `description`, `user_ID` FROM `creditor` WHERE `name` LIKE '%$search_value%' AND `source` = 'internal' AND `creditor_status`='active'";
  $result =  $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $creditor = $row["name"];
      $creditor_id = $row["creditor_ID"];

      echo "
                                        <option value ='$creditor_id'>$creditor</option>";
    }
  } else {
    echo "<option value ='0'>Grower not found</option>";
  }
}




//getting main crop certificate 

if (isset($_POST['main_certificate_value'])) {




  $result_value = $_POST['main_certificate_value'];
  $quantity_value = $_POST['main_quantity_value'];
  $crop_value = $_POST['crop_value'];
  $variety_value = $_POST['variety_value'];
  $class_value = $_POST['class_value'];

  if (!empty($quantity_value)) {


    $sql = "SELECT `lot_number` FROM
                                `certificate` WHERE available_quantity >= $quantity_value AND  
                               `crop_ID` = '$crop_value'  AND `variety_ID` = '$variety_value' 
                                 AND `class`='$class_value' AND `lot_number`
                                    LIKE '%$result_value%'";


    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $lot_number   = $row["lot_number"];


        echo "
                                                                <option value ='$lot_number'>$lot_number</option>";
      }
    } else {

      echo "
                                                                <option value ='null'> certificate not available</option>";
    }
  } else {
    echo "
                         <option value ='Lot Number not available'>Please add quantity first</option>
                         
                         ";
  }
}


//getting male crop certificate 

if (isset($_POST['male_certificate_value'])) {





  $result_value = $_POST['male_certificate_value'];
  $quantity_value = $_POST['male_quantity_value'];
  $crop_value = $_POST['crop_value'];
  $variety_value = $_POST['variety_value'];


  if (!empty($result_value)) {

    $sql = "SELECT `lot_number` FROM
                        `certificate` WHERE available_quantity >= $quantity_value AND  
                       `crop_ID` = '$crop_value'  AND `variety_ID` = '$variety_value' 
                         AND `type`='male' AND `lot_number`
                            LIKE '%$result_value%'";

    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $lot_number   = $row["lot_number"];


        echo "
                                                            <option value ='$lot_number'>$lot_number</option>";
      }
    } else {

      echo "
                                                <option value ='Lot Number not available'>Lot Number not available</option>";
    }
  }
}


//getting female crop certificate 


if (isset($_POST['female_certificate_value'])) {




  $result_value = $_POST['female_certificate_value'];
  $quantity_value = $_POST['female_quantity_value'];
  $crop_value = $_POST['crop_value'];
  $variety_value = $_POST['variety_value'];


  if (!empty($result_value)) {

    $sql = "SELECT `lot_number` FROM
                        `certificate` WHERE assigned_quantity >= $quantity_value AND  
                       `crop_ID` = '$crop_value'  AND `variety_ID` = '$variety_value' 
                         AND `type`='female' AND `lot_number`
                            LIKE '%$result_value%'";

    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $lot_number   = $row["lot_number"];


        echo "
                  <option value ='$lot_number'>$lot_number</option>";
      }
    } else {

      echo "
                  <option value ='Lot Number not available'>Lot Number not available</option>";
    }
  }
}






// lab get certificate 

if (isset($_POST['lab_certificate_value'])) {
;
     
  $result_value = $_POST['lab_certificate_value'];
  $quantity_value = $_POST['quantity_value'];
  $variety_value = $_POST['variety_value'];
  $class_value = $_POST['class_value'];


$sql="SELECT * FROM `certificate` WHERE `available_quantity` >= '$quantity_value' AND `variety_ID` = '$variety_value' AND  `class` = '$class_value' AND `lot_number` LIKE '%$result_value%'";
  


$result =  $con->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $lot_number   = $row["lot_number"];


    echo "
              <option value ='$lot_number'>$lot_number</option>";
  }
} else {

  echo "
              <option value ='Lot Number not available'>Lot Number not available</option>";
}


}
