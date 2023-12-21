<?php


spl_autoload_register(function ($class) {
    if (file_exists('../../class/' . $class . '.php')) {
        require_once '../../class/' . $class . '.php';
    } elseif (file_exists('../../class/Order/' . $class . '.php')) {
        require_once '../../class/Order/' . $class . '.php';
    }
});


$order = new Order();

if (isset($_POST["approveOrder"])) {

    $data = $_POST["approveOrder"];
    echo $order->admin_approve_order($data[0], $data[1]);
}
