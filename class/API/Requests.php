<?php


trait Requests

{
    private $host = "localhost:8080";
    private function send_post_request($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);

        if ($response == false) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode === 200) {
                return $response;
            } else {
                return 'HTTP Error: ' . $httpCode;
            }
        }

        curl_close($ch);
    }


    private function send_get_request($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $response = curl_exec($ch);

        if ($response == false) {
            echo 'Error: failed to connect ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode === 200) {
                return $response;
            } else {
                return 'HTTP Error: ' . $httpCode;
            }
        }

        curl_close($ch);
    }
}
