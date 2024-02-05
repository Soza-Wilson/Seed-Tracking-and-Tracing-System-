<?php

use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class Client
{

    /***
     * This class is handling all the logic for business profile 
     * 
     * 
     */
    private $con, $id, $name, $country, $physical_address;
    public function __construct($name, $country, $physical_address)
    {
        $DB = new DbConnection();
        $this->con = $DB->connect();
        $this->id = Util::generate_id('client');
        $this->name = $name;
        $this->country = $country;
        $this->physical_address = $physical_address;
    }

    private function check_registered()
    {
        $sql = 'SELECT * FROM `client`';
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function  add_profile_data()
    {
        if ($this->check_registered()) {
            return $this->update_business_profile();
        } else {
            return  $this->register_business_profile();
        }
    }


    private function register_business_profile()
    {
        try {
            //code...
            $sql = "INSERT INTO `client`(`id`, `business_name`, `country`, `physical_address`) VALUES ('$this->id','$this->name','$this->country','$this->physical_address')";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {
                return "updated";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function update_business_profile()
    {
        try {
            //code...
            $sql = "UPDATE `client` SET `business_name`='$this->name',`country`='$this->country',`physical_address`='$this->physical_address'";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {

                return "updated";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // save business logo image
    public function save_logo($image)
    {
        try {
            //code...
            $sql = "UPDATE `client` SET `logo`='$image'";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {

                return "saved";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function is_registered(): bool
    {
        try {
            //code...
            $sql = "SELECT * FROM client";
            $result =  $this->con->query($sql);
            $count = $result->num_rows;
            if ($count >= 1) {
                return true;
            } else {
                return   false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function get_client_details(): array
    {
        try {
            //code...
            $data = array();
            $sql = "SELECT * FROM client";
            $result =  $this->con->query($sql);
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
