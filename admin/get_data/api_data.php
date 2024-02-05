<?php

spl_autoload_register(function ($class) {
    if (file_exists('../../class/' . $class . '.php')) {
        require '../../class/' . $class . '.php';
    } elseif (file_exists('../../class/API/' . $class . '.php')) {
        require '../../class/API/' . $class . '.php';
    }
});

if (isset($_POST['sync_data'])) {

    $credetials = $_POST['sync_data'];
    $api = new ApiConnection($credetials['user_name'], $credetials['access_key']);
    $response = $api->check_connection();
    $value = json_decode($response, true);
    //  if connected authenticate 
    if ($value[0]['status'] == 'connected') {
        $response = $api->authenticate();
        if ($response === "HTTP Error: 401") {
            echo 'Wrong Business-name Or Access-key (OR register if not registered )';
        } else {
            //  update token, username and access key in database 
            $value = json_decode($response, true);
            $api->update_local_api_credatials($value['token']);
            //  calling API send data class to send data to API 
            $local_data = new SendData();
            $local_data->send_data();
            //  calling API get data class to get all data from API
            $api_data = new GetData();
        }
    } else {
        echo '. Error Connecting  to API ';
    }
}

if (isset($_POST['register'])) {

    $client = new Client("", "", "");
    if ($client->is_registered()) {
        $api = new ApiConnection("", "");

        $client_data = $client->get_client_details();
        $response = $api->check_connection();
        $value = json_decode($response, true);
        //  if connected register
        if ($value[0]['status'] === 'connected') {
            $response = $api->register_client($client_data["id"], $client_data["business_name"]);
            if ($response === "HTTP Error: 400") {
                echo 'Error: Name already exists';
            } else if (($response === "HTTP Error: 500")) {
                echo 'Error: API server error, contact Technical Support ';
            } else {
                // register token, username and access key in database 
                $returned_value = json_decode($response, true);
                if (!empty($returned_value['key'])) {
                    echo $api->register_local_api_credatials($client_data['business_name'], $returned_value['key']);
                }
            }
        }
    } else {
        echo "Error: No Business profile data found. Add data at setup/ business profile  ";
    }
}


if (isset($_POST['get_api_details'])) {

    $api = new ApiConnection("", "");
    $response = $api->get_client_data();
    echo $response['user_name'] . "," . $response['access_key'];
}
