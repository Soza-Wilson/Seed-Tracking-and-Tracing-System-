
<?php
include('../class/main.php');
$main = new main();
if (isset($_POST['stock_in_csv'])) {

    $date = date('D-m-y h:i');
    $filename = "Stock In $date.csv";
    $fp = fopen('php://output', 'w');
    $filter = $_POST["filter"];





    $header = array("Stock in ID", "Crop", "Variety", "Class", "Quantity", "Used Quantity", "Available Quantity", "Source", "Source Name", "Srn", "Added by", "Date");
    fputcsv($fp, $header);

    //create body
    if (empty($filter)) {







        $sql = "SELECT `stock_in_ID`, `fullname`,stock_in.source, `name`, `crop`, 
                              `variety`, `class`, `SLN`, `bincard`, `number_of_bags`,
                               `quantity`,`used_quantity`,`available_quantity`, `date` ,`supporting_dir` FROM `stock_in` 
                              INNER JOIN user ON stock_in.user_ID = user.user_ID 
                              INNER JOIN creditor ON stock_in.creditor_ID = creditor.creditor_ID 
                              INNER JOIN crop ON stock_in.crop_ID = crop.crop_ID 
                              INNER JOIN variety on stock_in.variety_ID = variety.variety_ID ORDER BY stock_in_ID DESC";

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stock_in_id = $row['stock_in_ID'];
                $crop      = $row['crop'];
                $source = $row['source'];
                $source_name = $row['name'];
                $variety     = $row['variety'];
                $class     = $row['class'];
                $quantity     = $row['quantity'];
                $used_quantity = $row['used_quantity'];
                $available_quantity = $row['available_quantity'];
                $date_added = $row['date'];
                $user = $row['fullname'];
                $srn = $row['SLN'];
                $dir = $row['supporting_dir'];


                $object = new main();
                $newDate = $object->change_date_format($date_added);

                $list = array($stock_in_id, $crop, $variety, $class, $quantity, $used_quantity, $available_quantity, $source, $source_name, $srn, $user, $newDate);
                fputcsv($fp, $list);
            }







            //close file
            fclose($fp);

            //download file
            header("Content-Description: File Transfer");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            exit;
        }
    } else {



        $fromValue = $_POST['from_hidden'];
        $toValue = $_POST['to_hidden'];
        $creditor_name = $_POST["creditor_hidden"];
        $cropValue = $_POST["cropValueHidden"];
        $varietyValue = $_POST["varietyValueHidden"];
        $classValue = $_POST["classValueHidden"];


        $sql = "SELECT `stock_in_ID`, `fullname`,stock_in.source, `name`, `crop`, 
        `variety`, `class`, `SLN`, `bincard`, `number_of_bags`,
         `quantity`,`used_quantity`,`available_quantity`, `date` ,`supporting_dir` FROM `stock_in` 
        INNER JOIN user ON stock_in.user_ID = user.user_ID 
        INNER JOIN creditor ON stock_in.creditor_ID = creditor.creditor_ID 
        INNER JOIN crop ON stock_in.crop_ID = crop.crop_ID 
        INNER JOIN variety on stock_in.variety_ID = variety.variety_ID WHERE creditor.name like '%$creditor_name%' AND stock_in.crop_ID ='$cropValue' AND stock_in.variety_ID='$varietyValue' AND stock_in.class='$classValue' AND stock_in.date BETWEEN '$fromValue' AND '$toValue' ORDER BY stock_in_ID DESC";
        $result = $con->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


                $stock_in_id = $row['stock_in_ID'];
                $crop      = $row['crop'];
                $source = $row['source'];
                $source_name = $row['name'];
                $variety     = $row['variety'];
                $class     = $row['class'];
                $quantity     = $row['quantity'];
                $used_quantity = $row['used_quantity'];
                $available_quantity = $row['available_quantity'];
                $date_added = $row['date'];
                $user = $row['fullname'];
                $srn = $row['SLN'];
                $dir = $row['supporting_dir'];


                $object = new main();
                $newDate = $object->change_date_format($date_added);

                $list = array($stock_in_id, $crop, $variety, $class, $quantity, $used_quantity, $available_quantity, $source, $source_name, $srn, $user, $newDate);
                fputcsv($fp, $list);
            }







            //close file
            fclose($fp);

            //download file
            header("Content-Description: File Transfer");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            exit;
        }
    }
}

if (isset($_POST['stock_out_csv'])) {

    $date = date('D-m-y h:i');
    $filename = "Stock Out $date.csv";
    $fp = fopen('php://output', 'w');
    $filter = $_POST["filter"];





    $header = array("ID", "Crop", "Variety", "Class", "Customer", "Quantity", "Date", "Time");
    fputcsv($fp, $header);

    //create body
    if (empty($filter)) {







        $sql = "SELECT `stock_out_ID`, crop.crop, variety.variety, item.class,
        user.fullname, order_table.customer_name, `Quntity`, stock_out.date,
         stock_out.time FROM `stock_out` INNER JOIN item ON item.item_ID = stock_out.item_ID INNER JOIN crop
        ON crop.crop_ID = item.crop_ID INNER JOIN variety on variety.variety_ID = item.variety_ID INNER JOIN 
        user on user.user_ID = stock_out.user_ID INNER JOIN order_table on order_table.order_ID = stock_out.order_ID ORDER BY `stock_out_ID` DESC
          ";

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ID      = $row["stock_out_ID"];
                $crop    = $row["crop"];
                $variety  = $row["variety"];
                $class = $row['class'];
                $customer = $row["customer_name"];
                $date    = $row['date'];
                $time = $row['time'];

                $quantity = $row['Quntity'];


                $object = new main();
                $newDate = $object->change_date_format($date);



                $list = array($ID, $crop, $variety, $class, $customer, $quantity, $newDate, $time);
                fputcsv($fp, $list);
            }







            //close file
            fclose($fp);

            //download file
            header("Content-Description: File Transfer");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            exit;
        }
    } else {



        $fromValue = $_POST['from_hidden'];
        $toValue = $_POST['to_hidden'];
        $creditor_name = $_POST["creditor_hidden"];
        $cropValue = $_POST["cropValueHidden"];
        $varietyValue = $_POST["varietyValueHidden"];
        $classValue = $_POST["classValueHidden"];


        $sql = "SELECT `stock_out_ID`, crop.crop, variety.variety, item.class,
  user.fullname, order_table.customer_name, `Quntity`, stock_out.date,
   stock_out.time FROM `stock_out` INNER JOIN item ON item.item_ID = stock_out.item_ID INNER JOIN crop
  ON crop.crop_ID = item.crop_ID INNER JOIN variety on variety.variety_ID = item.variety_ID INNER JOIN 
  user on user.user_ID = stock_out.user_ID INNER JOIN order_table on order_table.order_ID = stock_out.order_ID WHERE customer_name like 
  '%$creditor_name%'AND item.crop_ID ='$cropValue' AND item.variety_ID='$varietyValue' AND item.class='$classValue' AND stock_out.date BETWEEN '$fromValue' AND '$toValue' ORDER BY `stock_out_ID` DESC
    ";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


                $ID      = $row["stock_out_ID"];
                $crop    = $row["crop"];
                $variety  = $row["variety"];
                $class = $row['class'];
                $customer = $row["customer_name"];
                $date    = $row['date'];
                $time = $row['time'];

                $quantity = $row['Quntity'];


               
                $newDate = main::change_date_format($date);



                $list = array($ID, $crop, $variety, $class, $customer, $quantity, $newDate, $time);
                fputcsv($fp, $list);
            }







            //close file
            fclose($fp);

            //download file
            header("Content-Description: File Transfer");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            exit;
        }
    }
}


// Downlaod grower's list CSV

if (isset($_POST['grower_list'])) {

    $date = date('d-m-Y ');
    $season = $main->get_season();
    $type = $_POST['type'];
    $filename = "$season Grower's $type list $date.csv";
    $fp = fopen('php://output', 'w');


    $header = array("Grower ID ", "Name ", "Email", "Phone", "Registered Date", "Registered By");
    fputcsv($fp, $header);



    $sql = "SELECT `creditor_ID`, `source`, `name`, creditor.phone, creditor.email, `description`, `fullname`,`creditor_status`,creditor.registered_date FROM `creditor`
    INNER JOIN user ON creditor.user_ID = user.user_ID WHERE `creditor_status`='$type' ORDER BY `creditor_ID`";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $creditor_id = $row['creditor_ID'];
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];
            $registered_date = $row['registered_date'];
            $registered_by = $row['fullname'];


            $newDate = $main->change_date_format($registered_date);




            $list = array($creditor_id, $name, $email, $phone, $newDate, $registered_by);
            fputcsv($fp, $list);
        }
    }

    //close file
    fclose($fp);

    //download file
    header("Content-Description: File Transfer");
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=' . $filename);

    exit;
}



//  Download registered farms 




if (isset($_POST['registered_farms_csv'])) {


    $date = date('D-m-y h:i');
    $filename = "Grower's list $date.csv";
    $fp = fopen('php://output', 'w');
    $filter = $_POST["filter"];
    $sql = "";



    

    $header = array("Farm ID ", "Grower", "Crop", "Variety", "class", "Hectors", "Region", "District", "EPA", "Area Name ", "Address", "Physical Address", "Land History(previous year)", "Land History(Other year)");
    fputcsv($fp, $header);

    $sql = "";
    $creditor_name = $_POST["creditor_hidden"];
    $cropValue = $_POST["cropValueHidden"];
    $varietyValue = $_POST["varietyValueHidden"];
    $classValue = $_POST["classValueHidden"];
    $region = $_POST["region_hidden"];
    $district = $_POST["district_hidden"];

    





    //create body
    if (empty($filter)) {
        $sql = "SELECT `farm_ID`, `Hectors`,crop.crop,variety.variety, `class`, 
        `region`, `district`, `area_name`, `address`, `physical_address`, 
        `EPA`,creditor.name, farm.registered_date, `previous_year_crop`, 
        `other_year_crop`, `main_lot_number`, `main_quantity`, `male_lot_number`,
         `male_quantity`, `female_lot_number`, `female_quantity` FROM `farm`
          INNER JOIN crop ON farm.crop_species = crop.crop_ID INNER JOIN 
          variety ON farm.crop_variety = variety.variety_ID INNER JOIN creditor
          ON farm.creditor_ID = creditor.creditor_ID";
    } else if ($filter == "grower_filter") {

        $sql = "SELECT `farm_ID`, `Hectors`,crop.crop,variety.variety, `class`, 
        `region`, `district`, `area_name`, `address`, `physical_address`, 
        `EPA`,creditor.name, farm.registered_date, `previous_year_crop`, 
        `other_year_crop`, `main_lot_number`, `main_quantity`, `male_lot_number`,
         `male_quantity`, `female_lot_number`, `female_quantity` FROM `farm`
          INNER JOIN crop ON farm.crop_species = crop.crop_ID INNER JOIN 
          variety ON farm.crop_variety = variety.variety_ID INNER JOIN creditor
          ON farm.creditor_ID = creditor.creditor_ID WHERE creditor.name LIKE '%$creditor_name%'";
    } else if ($filter == "crop_filter") {

        $sql = "SELECT `farm_ID`, `Hectors`,crop.crop,variety.variety, `class`, 
        `region`, `district`, `area_name`, `address`, `physical_address`, 
        `EPA`,creditor.name, farm.registered_date, `previous_year_crop`, 
        `other_year_crop`, `main_lot_number`, `main_quantity`, `male_lot_number`,
         `male_quantity`, `female_lot_number`, `female_quantity` FROM `farm`
          INNER JOIN crop ON farm.crop_species = crop.crop_ID INNER JOIN 
          variety ON farm.crop_variety = variety.variety_ID INNER JOIN creditor
          ON farm.creditor_ID = creditor.creditor_ID WHERE crop.crop_ID ='$cropValue' AND variety.variety_ID ='$varietyValue' AND `class` ='$classValue'";
    } else if ($filter == "location_filter") {

        $sql = "SELECT `farm_ID`, `Hectors`,crop.crop,variety.variety, `class`, 
        `region`, `district`, `area_name`, `address`, `physical_address`, 
        `EPA`,creditor.name, farm.registered_date, `previous_year_crop`, 
        `other_year_crop`, `main_lot_number`, `main_quantity`, `male_lot_number`,
         `male_quantity`, `female_lot_number`, `female_quantity` FROM `farm`
          INNER JOIN crop ON farm.crop_species = crop.crop_ID INNER JOIN 
          variety ON farm.crop_variety = variety.variety_ID INNER JOIN creditor
          ON farm.creditor_ID = creditor.creditor_ID WHERE `region` LIKE  '%$region%' AND `district` LIKE '%$district%'";
    }

    $result = $con->query($sql);
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $farm_id = $row['farm_ID'];
            $grower_name = $row['name'];
            $crop = $row['crop'];
            $variety     = $row['variety'];
            $class     = $row['class'];
            $hectors     = $row['Hectors'];
            $registered_date = $row['registered_date'];
            $region = $row['region'];
            $district = $row['district'];
            $epa = $row['EPA'];
            $area_name = $row['area_name'];
            $address = $row['address'];
            $physical_address = $row['physical_address'];
            $previous = $row['previous_year_crop'];
            $other_previous = $row['other_year_crop'];




            $list = array($farm_id, $grower_name, $crop, $variety, $class, $hectors, $region, $district, $epa, $area_name, $address, $physical_address, $previous, $other_previous);
            fputcsv($fp, $list);
        }

        //close file
        fclose($fp);

        //download file
        header("Content-Description: File Transfer");
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        exit;
    }
} 






































// Download certificate CSV

if (isset($_POST['certificate_csv'])) {


    $type = $_POST['certificate_type'];
    $date = date('D-m-y h:i');
    $filename = "$type certificates $date.csv";
    $fp = fopen('php://output', 'w');
    $filter = $_POST["filter"];
    $sql = "";






    $header = array("Lot number ", "Crop", "Variety", "Class", "Type", "Source", "Date Tested", "Expire Date", "Date Added", "Certificate Quantity", "Available Quantity", "Added By");
    fputcsv($fp, $header);

    //create body
    if (empty($filter)) {



        if ($type == "available") {

            $date = date("Y-m-d");
            $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
            `certificate_quantity`, `available_quantity`, `directory`, `fullname` FROM `certificate`
            INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
            INNER JOIN user ON user.user_ID = certificate.user_ID WHERE `available_quantity` > 0 AND `expiry_date` > '$date' ";
        } else if ($type == "used") {
            $date = date("Y-m-d");
            $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
              `certificate_quantity`, `available_quantity`, `directory`, `fullname` FROM `certificate`
              INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
              INNER JOIN user ON user.user_ID = certificate.user_ID WHERE `available_quantity` <= 0";
        } else if ($type == "expired") {
            $date = date("Y-m-d");
            $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, 
            `expiry_date`, `date_added`, `certificate_quantity`, `available_quantity`, `directory`, 
            `fullname` FROM `certificate` INNER JOIN crop ON certificate.crop_ID = crop.crop_ID 
            INNER JOIN variety ON certificate.variety_ID = variety.variety_ID INNER JOIN user ON
             user.user_ID = certificate.user_ID WHERE `expiry_date` < '$date' ";
        }





        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lot_number = $row["lot_number"];
                $crop      = $row["crop"];
                $variety     = $row["variety"];
                $class     = $row["class"];
                $type  = $row["type"];
                $source = $row['source'];
                $date_tested = $row['date_tested'];
                $expire_date = $row['expiry_date'];
                $date_added = $row['date_added'];
                $dir = $row['directory'];
                $certificate_quantity = $row['certificate_quantity'];
                $available_quantity = $row['available_quantity'];
                $fullname = $row['fullname'];



                $newDate = $main->change_date_format($date_added);




                $list = array($lot_number, $crop, $variety, $class, $type, $source, $date_tested, $expire_date, $date_added, $certificate_quantity, $available_quantity, $fullname);
                fputcsv($fp, $list);
            }







            //close file
            fclose($fp);

            //download file
            header("Content-Description: File Transfer");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            exit;
        }
    } else {


        $type = $_POST['certificate_type'];
        $fromValue = $_POST['from_hidden'];
        $toValue = $_POST['to_hidden'];
        $creditor_name = $_POST["creditor_hidden"];
        $cropValue = $_POST["cropValueHidden"];
        $varietyValue = $_POST["varietyValueHidden"];
        $classValue = $_POST["classValueHidden"];


        if ($type == "available") {

            $date = date("Y-m-d");
            $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
            `certificate_quantity`, `available_quantity`, `directory`, `fullname` FROM `certificate`
            INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
            INNER JOIN user ON user.user_ID = certificate.user_ID WHERE `available_quantity` > 0 AND `expiry_date` > '$date' AND certificate.crop_ID ='$cropValue' AND certificate.variety_ID ='$varietyValue' AND `class`='$classValue' ORDER BY `lot_number` DESC";
        } else if ($type == "used") {
            $date = date("Y-m-d");
            $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
              `certificate_quantity`, `available_quantity`, `directory`, `fullname` FROM `certificate`
              INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
              INNER JOIN user ON user.user_ID = certificate.user_ID WHERE `available_quantity` <= 0 AND certificate.crop_ID ='$cropValue' AND certificate.variety_ID ='$varietyValue' AND `class`='$classValue'  ORDER BY `lot_number` DESC";
        } else if ($type == "expired") {
            $date = date("Y-m-d");
            $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, 
            `expiry_date`, `date_added`, `certificate_quantity`, `available_quantity`, `directory`, 
            `fullname` FROM `certificate` INNER JOIN crop ON certificate.crop_ID = crop.crop_ID 
            INNER JOIN variety ON certificate.variety_ID = variety.variety_ID INNER JOIN user ON
             user.user_ID = certificate.user_ID WHERE `expiry_date` < '$date' AND certificate.crop_ID ='$cropValue' AND certificate.variety_ID ='$varietyValue' AND `class`='$classValue' ORDER BY `lot_number` DESC";
        }

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


                $lot_number = $row["lot_number"];
                $crop      = $row["crop"];
                $variety     = $row["variety"];
                $class     = $row["class"];
                $type  = $row["type"];
                $source = $row['source'];
                $date_tested = $row['date_tested'];
                $expire_date = $row['expiry_date'];
                $date_added = $row['date_added'];
                $dir = $row['directory'];
                $certificate_quantity = $row['certificate_quantity'];
                $available_quantity = $row['available_quantity'];
                $fullname = $row['fullname'];


                $object = new main();
                $newDate = $object->change_date_format($date_added);




                $list = array($lot_number, $crop, $variety, $class, $type, $source, $date_tested, $expire_date, $date_added, $certificate_quantity, $available_quantity, $fullname);
                fputcsv($fp, $list);
            }







            //close file
            fclose($fp);

            //download file
            header("Content-Description: File Transfer");
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename=' . $filename);

            exit;
        }
    }
}
