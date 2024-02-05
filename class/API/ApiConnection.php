<?php

use PhpParser\Node\Stmt\Return_;

class ApiConnection
{
    use Requests;
    private $user_name, $access_key, $con;
    public function __construct($user_name, $access_key)
    {
       
        $DB = new DbConnection();
        $this->con = $DB->connect();
        $this->access_key = $access_key;
        $this->user_name = $user_name;
    }



    public function check_connection()
    {
        try {
            return $api_connection = $this->send_get_request($this->host . "/requests/connection");
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function authenticate()
    {
        try {
            //code...
            $api_data = ["user_name" => $this->user_name, "key" => $this->access_key];
            $json_data = json_encode($api_data);
            $auth = $this->send_post_request($this->host . "/auth/logIn", $json_data);
            $response = $auth;
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function register_client($client_id, $name)
    {

        try {
            //code...
            $api_data = ["id" => $client_id, "company_name" => $name];
            $json_data = json_encode($api_data);
            $auth = $this->send_post_request($this->host . "/auth/registerCompany", $json_data);
            $response = $auth;
            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function register_local_api_credatials($user_name, $access_key): string
    {
        try {
            //code...

            $sql = "INSERT INTO `api`(`user_name`, `access_key`) VALUES ('$user_name','$access_key')";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {
                return 'registered';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update_local_api_credatials($token)
    {
        try {
            //code...
            $sql = "UPDATE `api` SET `token`='$token'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_client_data(): array
    {
        $data = array();
        $sql = "SELECT * FROM api";
        $result =  $this->con->query($sql);
        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }
        return $data;
    }
}
