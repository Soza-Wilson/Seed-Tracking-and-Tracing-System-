<?php


spl_autoload_register(function ($class) {
  if (file_exists('../../class/Order/' . $class . '.php')) {
    require_once '../../class/Order/' . $class . '.php';
  } elseif (file_exists('../../class/' . $class . '.php')) {
    require_once   '../../class/' . $class . '.php';
  }
});


if (isset($_POST['processOrder'])) {


  $orderData = $_POST['processOrder'];
  $order = new ProcessOrder($orderData[0], $orderData[1], $orderData[2], $orderData[3], $orderData[4]);
  echo $order->process_order();

  // echo "saved";
}
