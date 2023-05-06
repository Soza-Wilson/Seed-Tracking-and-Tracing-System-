<?php

$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);
include('../class/production.php');

// if(isset($_POST['search_value'])){


//     $source = $_POST['search_value'];
//     $sql="SELECT `creditor_ID`, `source`, `name`, `phone`,
//      `email`, `description`, `user_ID` FROM `creditor` WHERE `source` = '$source'";
//        $result =  $con->query($sql);			  

//        if($result->num_rows>0)
//           {
//              while($row=$result->fetch_assoc())
//                     {
//                       $creditor_ID 	= $row["creditor_ID"];
//                       $creditor_name 	= $row["name"];

//                      echo"
//                      <option value ='$creditor_ID'>$creditor_name</option>";

//                     }

//                   }

// }


if (isset($_POST['result_value'])) {

  $search_value = $_POST['result_value'];
  $search_source = $_POST['data'];


  $sql = "SELECT `creditor_ID`, `source`, `name`, `phone`, `email`, `description`, `user_ID` FROM `creditor` WHERE `name` LIKE '%$search_value%' AND `source` = '$search_source'";
  $result =  $con->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $creditor = $row["name"];
      $creditor_id = $row["creditor_ID"];


      echo "
              <option value ='$creditor_id'>$creditor</option>";
    }
  } else {

    echo "
            <option value ='not available'>name not found</option>";
  }
}

if (isset($_POST['farm_value'])) {


  $farm_search_value = $_POST['farm_value'];
  $grower_selected_value = $_POST['grower_data'];

  if (empty($grower_selected_value)) {

    echo "
  <option value =''> Please select grower first</option>";
  } else {

    // AND `farm_ID` LIKE '%$farm_search_value% WHERE `creditor_ID` = '$grower_selected_value''

    $sql = "SELECT `farm_ID`, farm.crop_variety,crop.crop, variety.variety, `class` 
 FROM `farm` INNER JOIN crop ON crop.crop_ID = farm.crop_species
  INNER JOIN variety ON variety.variety_ID = farm.crop_variety WHERE `farm_ID` LIKE '%$farm_search_value%' AND `creditor_ID` = '$grower_selected_value'";

    $result =  $con->query($sql);
    if ($result->num_rows > 0) {
      echo "<option value =''>Select Farm ID</option>";
      while ($row = $result->fetch_assoc()) {
        $farm = $row["farm_ID"];
        $crop = $row["crop"];
        $variety = $row["variety"];
        $class = $row["class"];

        echo "
                                   
                                    <option value ='$farm'>ID: <span>$farm</span> </option>";
      }
    } else {
    }
  }
}

// function retriving selected farm details and passing the through session to main page 









if (isset($_POST['search_farm_result'])) {
  $ID = $_POST['search_farm_result'];


  $sql = "SELECT farm.crop_variety,crop.crop,farm.crop_species, variety.variety,variety.variety_ID,`class`,`physical_address` 
                    FROM `farm` INNER JOIN crop ON crop.crop_ID = farm.crop_species
                                          INNER JOIN variety ON variety.variety_ID = farm.crop_variety WHERE `farm_ID`='$ID'";

  $result =  $con->query($sql);
  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      $crop = $row["crop"];
      $crop_id = $row["crop_species"];

      $crop = $row["crop"];
      $crop_id = $row["crop_species"];

      $variety = $row["variety"];
      $variety_id = $row["variety_ID"];

      $physical_address = $row["physical_address"];
      $class = $row["class"];

      // echo "
      //   <option value =''>$class</option>";
    }
  }

  $farm_data = array("crop_id" => $crop_id, "crop" => $crop, "variety_id" => $variety_id, "variety" => $variety, "address" => $physical_address, "farm_class" => $class);
  //delete_data();

  if (file_exists("farm_data.json")) {

    $path = file_get_contents('farm_data.json');
    $json_data[] = array(json_decode($path));


    if (!empty($json_data[0])) {

      unset($json_data[0]);

      $unsave = json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      if (file_put_contents('farm_data.json', $unsave)) {
        $final_data = add_data($farm_data);
        file_put_contents('farm_data.json', $final_data);
      }
    } else {

      echo "
       <option value =''>empty</option>";
    }
  } else {

    echo "
    <option value =''>error</option>";
  }
}

//function adding temp data to json file

function add_data($data)
{
  $eco_data = json_encode($data);
  return $eco_data;
}

//delete temp data from json

function delete_data()
{

  $json_data = json_decode(file_get_contents('farm_data.json'));
  unset($json_data[0]);

  $unsave = json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  file_put_contents('farm_data.json', $unsave);
}



/// other get certicate 

if (isset($_POST['certificate_value'])) {




  $result_value = $_POST['certificate_value'];
  $quantity_value = $_POST['data'];
  $result_value = $_POST['certificate_value'];
  $crop_value = $_POST['crop_value'];
  $variety_value = $_POST['variety_value'];
  $class_value = $_POST['class_value'];


  if (!empty($result_value)) {

    $sql = "SELECT `lot_number`, `crop_ID`, `variety_ID`, `class`, `type`, `source`, `source_name`, `date_tested`, `expiry_date`, `date_added`, `certificate_quantity`, `available_quantity`, `directory`, `user_ID` FROM
     `certificate` WHERE available_quantity >= $quantity_value AND `crop_ID` = '$crop_value' AND `variety_ID` = '$variety_value' AND `source` ='external' AND `class`='$class_value' AND `lot_number` LIKE '%$result_value%'";

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

//stock in get certificate
if (isset($_POST['stockIn_certificate'])) {

  $result_value = $_POST['stockIn_certificate'];
  $quantity_value = $_POST['stockIn_quantity'];
  $crop_value = $_POST['crop_value'];
  $variety_value = $_POST['variety_value'];
  $class_value = $_POST['class_value'];


  $sql = "SELECT `lot_number`, `crop_ID`, 
  `variety_ID`, `class`, `type`, `source`, 
  `source_name`, `date_tested`, `expiry_date`,
  `date_added`, `certificate_quantity`, 
  `available_quantity`, `directory`, `user_ID` FROM
  `certificate` WHERE available_quantity >= $quantity_value AND
  `crop_ID` = '$crop_value' AND `variety_ID` = '$variety_value' 
  AND `source` ='external' AND `class`='$class_value' AND 
  `lot_number` LIKE '%$result_value%'";

  $result =  $con->query($sql);
  if ($result->num_rows > 0) {
    echo "<option value='no_certificate_selected'>Select Certificate</option>";
 
    while ($row = $result->fetch_assoc()) {
      $lot_number   = $row["lot_number"];
     echo"<option value ='$lot_number'>$lot_number</option>";     
    }
    echo "<option value='not_certified'>Seed not certified</option>";
  } else {
   echo "<option value='not_found'>Certificate not found</option>
   <option value='not_certified'>Seed not certified</option>";
    
  }



  //   $object = new production();
  //   $data=$object->get_external_certificate($result_value,$quantity_value,$crop_value,$variety_value,$class_value);

  // echo "
  // <option value='no_certificate_selected'>Select Certificate</option>
  // <option value='not_certified'>Seed not certified</option>
  // <option value ='$data'>$data</option>";

  // while($data>0)



  // WHERE available_quantity >= $quantity_value AND
  // `crop_ID` = '$crop_value' AND `variety_ID` = '$variety_value' 
  // AND `source` ='external' AND `class`='$class_value' AND 
  // `lot_number` LIKE '%$result_value%'


  //   




  //   if (!empty($result_value)) {

  //     echo "
  //     <option value ='hkhkkkk'>$quantity_value</option>";

  //     $sql = "SELECT `lot_number`, `crop_ID`, 
  //     `variety_ID`, `class`, `type`, `source`, 
  //     `source_name`, `date_tested`, `expiry_date`,
  //      `date_added`, `certificate_quantity`, 
  //      `available_quantity`, `directory`, `user_ID` FROM
  //    `certificate` ";

  // $result =  $con->query($sql);
  //   if ($result->num_rows > 0) {
  //     while ($row = $result->fetch_assoc()) {
  //       $lot_number   = $row["lot_number"];


  //       echo "
  //               <option value ='$lot_number'>$lot_number</option>";
  //     }
  //   } else {

  //     echo "
  //               <option value ='Lot Number not available'>Lot Number not available</option>";
  //   }

  //   }

  //  $sql = "SELECT `lot_number`, `crop_ID`, `variety_ID`, `class`, `type`, `source`, `source_name`, `date_tested`, `expiry_date`, `date_added`, `certificate_quantity`, `available_quantity`, `directory`, `user_ID` FROM
  //  `certificate` WHERE available_quantity >= $quantity_value AND `crop_ID` = '$crop_value' AND `variety_ID` = '$variety_value' AND `source` ='external' AND `class`='$class_value' AND `lot_number` LIKE '%$result_value%'";

  //   $result =  $con->query($sql);
  //   if ($result->num_rows > 0) {
  //     while ($row = $result->fetch_assoc()) {
  //       $lot_number   = $row["lot_number"];


  //       echo "
  //               <option value ='$lot_number'>$lot_number</option>";
  //     }
  //   } else {

  //     echo "
  //               <option value ='Lot Number not available'>Lot Number not available</option>";
  //   }
  //






}
