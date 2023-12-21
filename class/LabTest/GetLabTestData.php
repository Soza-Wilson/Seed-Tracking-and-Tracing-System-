<?php

class GetLabTestData
{

    private $con;
    public function __construct()
    {

        $connection = new DbConnection();
        $this->con = $connection->connect();
    }


    public function get_stock_in_details($stock_in_id)
    {   
        $data [] ='';
        $sql = "
        SELECT farm.farm_ID,farm.physical_address, crop.crop_ID,
        crop.crop,variety.variety,variety.variety_ID,stock_in.class,
        stock_in.quantity FROM stock_in
        INNER JOIN farm ON stock_in.farm_ID = farm.farm_ID INNER JOIN
        crop ON stock_in.crop_ID = crop.crop_ID INNER JOIN variety
        ON stock_in.variety_ID = variety.variety_ID WHERE stock_in.stock_in_ID = '$stock_in_id'";

        $result =  $this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[0] = $stock_in_id;
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

    function get_active_test($grade)
    {
        $data [] ='';
        $sql = "SELECT lab_test.test_ID,stock_in.source,stock_in.stock_in_ID ,crop.crop,variety.variety,
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

        $result =  $this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[0] = $row["test_ID"];
                $data[1] = $row["source"];
                $data[2] = $row["stock_in_ID"];
                $data[3] = $row["area_name"];
                $data[4] = $row["physical_address"];
                $data[5] = $row["crop"];
                $data[6] = $row["variety"];
                $data[7] = $row["class"];
                $data[8] = $row["date"];
                $data[9] = $row["fullname"];
                $data[10] = $row["quantity"];
                $data[11] = $row["grade"];
            }
        }

        return $data;
    }
}
