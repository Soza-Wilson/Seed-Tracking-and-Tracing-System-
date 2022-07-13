
<?php


// database connection
$localhost = "localhost";
$username  = "root";
$password  = "";
$database        = "seed_tracking_db";
$con = new mysqli($localhost, $username, $password, $database);


class production
{
    // get certificate data and retuens lot number 
    function get_external_certificate($user_input, $quantity, $crop, $variety, $class)

    {

        global $con;

        $sql = "SELECT `lot_number`, `crop_ID`, 
        `variety_ID`, `class`, `type`, `source`, 
        `source_name`, `date_tested`, `expiry_date`,
        `date_added`, `certificate_quantity`, 
        `available_quantity`, `directory`, `user_ID` FROM
        `certificate` WHERE available_quantity >= $quantity AND
        `crop_ID` = '$crop' AND `variety_ID` = '$variety' 
        AND `source` ='External' AND `class`='$class' AND 
        `lot_number` LIKE '%$user_input%'";

        $result =  $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lot_number   = $row["lot_number"];

                return $lot_number;
            }
        } else {

            return "not working";
        }
    }


    // get stock details

    function get_lab_stock_details($id)
    {
        global $con;
        $data[] = "";
        $sql = "
        SELECT farm.farm_ID,farm.physical_address, crop.crop_ID,
        crop.crop,variety.variety,variety.variety_ID,stock_in.class,
        stock_in.quantity FROM stock_in
         INNER JOIN farm ON stock_in.farm_ID = farm.farm_ID INNER JOIN
          crop ON stock_in.crop_ID = crop.crop_ID INNER JOIN variety
           ON stock_in.variety_ID = variety.variety_ID WHERE stock_in.stock_in_ID = '$id'
        ";

        $result =  $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[0] = $id;
                $data[1] = $row["farm_ID"];
                $data[2]  = $row["crop"];
                $data[3]  = $row["variety"];
                $data[4] = $row["physical_address"];
                $data[5] = $row["quantity"];
                $data[6] = $row["class"];
                $data[7] = $row["crop_ID"];
                $data[8] = $row["variety_ID"];

            }
        }

        return $data;
    }

    function get_active_test($grade){

        global $con;
        $data[] = "";

        $sql ="SELECT lab_test.test_ID,stock_in.source,stock_in.stock_in_ID ,crop.crop,variety.variety,
        farm.class,user.fullname,farm.area_name,
        farm.physical_address,lab_test.germination_percentage,
        lab_test.shelling_percentage,lab_test.purity_percentage,
        lab_test.defects_percentage,lab_test.grade, stock_in.date, 
        stock_in.quantity FROM lab_test INNER JOIN crop ON crop.crop_ID
         = lab_test.crop_ID INNER JOIN variety ON variety.variety_ID = 
         lab_test.variety_ID INNER JOIN farm on farm.farm_ID = lab_test.farm_ID 
         INNER JOIN user ON user.user_ID = lab_test.user_ID INNER JOIN stock_in 
         ON stock_in.stock_in_ID = lab_test.stock_in_ID WHERE lab_test.grade = '$grade'
        ";

$result =  $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  
        $data[0] = $row["test_ID"];
        $data[1] = $row["source"];
        $data[2] = $row["stock_in_ID"];
        $data[3] = $row["area_name"];
        $data[4] = $row["physical_address"];
        $data[5]  = $row["crop"];
        $data[6]  = $row["variety"];
        $data[7] = $row["class"];
        $data[8] = $row["date"];
        $data[9] = $row["fullname"];
        $data[10] = $row["quantity"];
        $data[11] = $row["grade"];
       

    }
}
  
            return $data;
                            
    }

    function get_test_details($id){

        global $con;
        $data[] = "";

        $sql ="SELECT lab_test.test_ID,stock_in.source,
        stock_in.stock_in_ID ,crop.crop,variety.variety,variety.variety_ID, 
        farm.class,user.fullname,farm.area_name, 
        farm.physical_address,lab_test.germination_percentage, 
        lab_test.shelling_percentage,lab_test.purity_percentage, 
        lab_test.defects_percentage,lab_test.grade, stock_in.date,
         stock_in.quantity FROM lab_test INNER JOIN 
         crop ON crop.crop_ID = lab_test.crop_ID INNER JOIN 
         variety ON variety.variety_ID = lab_test.variety_ID 
         INNER JOIN farm on farm.farm_ID = lab_test.farm_ID 
         INNER JOIN user ON user.user_ID = lab_test.user_ID 
         INNER JOIN stock_in ON stock_in.stock_in_ID = lab_test.stock_in_ID WHERE lab_test.test_ID = '$id'
        ";

$result =  $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  
        $data[0] = $row["stock_in_ID"];
        $data[1] = $row["crop"];
        $data[2] = $row["variety"];
        $data[3] = $row["class"];
        $data[4] = $row["quantity"];
        $data[5]  = $row["germination_percentage"];
        $data[6]  = $row["shelling_percentage"];
        $data[7]  = $row["purity_percentage"];
        $data[8] = $row["defects_percentage"];
        $data[9] = $row["grade"];
        $data[10] = $row["variety_ID"];
      
       

    }
}
  
            return $data;
                            
    }


    function lab_certify_stock($quantity,$stock_in_ID,$lab_id,$lot_number){

        global $con;

        if(!empty($stock_in_ID)){

            $sql ="UPDATE `stock_in` SET `certificate_ID`='$lot_number', `status`='certified' WHERE `stock_in_ID`= '$stock_in_ID'";
            $statement = $con->prepare($sql);
            $statement->execute();
        }

        else{

            echo ("<script> alert('error 1');
            </script>");

        }

        if (!empty($quantity)){

            $sql="UPDATE `certificate` SET `available_quantity`= available_quantity - $quantity  WHERE `lot_number` ='$lot_number'";
            $statement = $con->prepare($sql);
            $statement->execute();



        }

        else{


            echo ("<script> alert('error2');
            </script>");

        }

        if(!empty($lab_id)){

            $sql="UPDATE `lab_test` SET `test_status`='certified' WHERE `test_ID`='$lab_id'";
            $statement = $con->prepare($sql);
            $statement->execute();
            echo ("<script> alert('$lab_id');
            </script>");
        }

        else{
            echo ("<script> alert('error3');
            </script>");

        }

        echo ("<script> alert('seed certified');
                                </script>");

    }

}










?>