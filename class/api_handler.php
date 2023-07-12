<?php
include('../class/main.php');



class api_handler extends main
{
    static function send_data()
    {
        $request_issues = [];
        array_push($request_issues, self::send_user_data(), self::send_crops_data(), self::send_varieties_data());

        return $request_issues;
    }

    static function send_user_data()
    {
        global $con;
        $sql = "SELECT * FROM `user`
       INNER JOIN usertype ON usertype.user_type_ID =user.user_type_ID WHERE `account_status`='active'";

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jsonData = ["id" => $row['user_ID'], "fullname" => $row["fullname"], "email" => $row["email"], "password" => $row["password"], "profilePicture" => $row["profile_picture"]];
                $apiData = json_encode($jsonData);



                $issue = self::send_request("localhost:8080/requests/user", $apiData);
            }

            return $issue;
        } else {

            return "error on user";
        }
    }

    static function send_crops_data()
    {
        global $con;

        $sql = "SELECT * FROM `crop`";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jsonData = ["crop_id" => $row['crop_ID'], "crop_name" => $row["crop"]];
                $apiData = json_encode($jsonData);

                $issue = self::send_request("localhost:8080/requests/crop", $apiData);
            }

            return $issue;
        } else {

            echo "error on crop";
        }
    }

    static function send_varieties_data()
    {

        global $con;

        $sql = "SELECT * FROM `variety`";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jsonData = ["variety_id" => $row['variety_ID'], "variety_name" => $row["variety"], "crop_id" => $row["crop_ID"]];
                $apiData = json_encode($jsonData);

                $issue = self::send_request("localhost:8080/requests/variety", $apiData);
            }

            return $issue;
        } else {

            echo "error on crop";
        }
    }

    static function send_request($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode === 200) {
                return 'API response: ' . $response;
            } else {
                return 'HTTP Error: ' . $httpCode;
            }
        }

        curl_close($ch);
    }
}
