<?php


class SendData
{
    use Requests;
    private $con;
    private $client_id;
    public function __construct()
    {
        $DB = new DbConnection();
        $this->con = $DB->connect();
        $client = new Client("", "", "");
        $data = $client->get_client_details();
        $this->client_id = $data['id'];
    }

    public function send_data()
    {
        $request_issues = [];
        array_push($request_issues, " , ", $this->send_user_data(), $this->send_crops_data(), $this->send_varieties_data(), $this->send_growers_data(), $this->send_farm_data());
        return $request_issues;
    }

    private function send_user_data()
    {

        try {
            //code...

            $sql = "SELECT * FROM `user`
            INNER JOIN usertype ON usertype.user_type_ID =user.user_type_ID WHERE `account_status`='active'";

            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $jsonData = ["id" => $row['user_ID'], "fullname" => $row["fullname"], "email" => $row["email"], "password" => $row["password"], "profilePicture" => $row["profile_picture"]];
                    $apiData = json_encode($jsonData);
                    $response = $this->send_post_request($this->host . "/requests/user", $apiData);
                }
                return $response;
            } else {

                return "No users data founds  ,";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function send_crops_data()
    {


        try {
            //code...
            $sql = "SELECT * FROM `crop`";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $jsonData = ["crop_id" => $row['crop_ID'], "crop_name" => $row["crop"]];
                    $apiData = json_encode($jsonData);

                    $response = $this->send_post_request($this->host . "/requests/crop", $apiData);
                }

                return $response;
            } else {

                echo "Error: No Crop spicies data found.   ";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function send_varieties_data()
    {


        try {
            //code...
            $sql = "SELECT * FROM `variety`";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $jsonData = ["variety_id" => $row['variety_ID'], "variety_name" => $row["variety"], "crop_id" => $row["crop_ID"]];
                    $apiData = json_encode($jsonData);

                    $response = $this->send_post_request($this->host . "/requests/variety", $apiData);
                }

                return $response;
            } else {

                echo "Error: No variety data found.   ";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function send_growers_data()
    {



        try {
            //code...
            $sql = "SELECT * FROM `creditor` WHERE `source` = 'internal' AND `creditor_status`='active'";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $jsonData = ["grower_id" => $row['creditor_ID'], "fullname" => $row["name"], "phone" => $row["phone"]];
                    $apiData = json_encode($jsonData);

                    $response = $this->send_post_request($this->host . "/requests/grower", $apiData);
                }

                return $response;
            } else {

                echo "Error: No grower data found.    ";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function send_farm_data()
    {


        try {
            //code...

            $sql = "SELECT `farm_ID`, `Hectors`,crop.crop_ID,variety.variety_ID,
            `class`, `region`, `district`, `area_name`, `address`, `physical_address`,
            `EPA`,creditor.name,creditor.creditor_ID, farm.registered_date, `previous_year_crop`,
             `other_year_crop`, `main_lot_number`, `main_quantity`, 
             `male_lot_number`, `male_quantity`, `female_lot_number`, 
             `female_quantity` FROM `farm` INNER JOIN crop
            ON farm.crop_species = crop.crop_ID INNER JOIN variety 
            ON farm.crop_variety = variety.variety_ID INNER JOIN 
            creditor ON farm.creditor_ID = creditor.creditor_ID WHERE `order_status`='order_processed'";

            $result = $this->con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $jsonData = ["farm_id" => $row['farm_ID'], "hectors" => $row["Hectors"], "region" => $row["region"], 
                    "district" => $row["district"], "area_name" => $row["area_name"], "address" => $row["address"], "physical_address" => $row["physical_address"],
                    "epa" => $row["EPA"], "crop_id" => $row["crop_ID"], "variety_id" => $row["variety_ID"], "grower_id" => $row["creditor_ID"], "client_id" => $this->client_id];
                    $apiData = json_encode($jsonData);

                    $response = $this->send_post_request($this->host . "/requests/farm", $apiData);
                }

                return $response;
            } else {
                echo "Error: No farm data found.    ";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
