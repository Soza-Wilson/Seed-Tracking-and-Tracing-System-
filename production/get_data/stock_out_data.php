<?php


spl_autoload_register(function ($class) {
    if (file_exists('../../class/Inventory/' . $class . '.php')) {
        require_once '../../class/Inventory/' . $class . '.php';
    } elseif (file_exists('../../class/' . $class . '.php')) {
        require_once   '../../class/' . $class . '.php';
    }

});

if (isset($_POST['reverse_stock_out'])) {

    $props_array = $_POST['reverse_stock_out'];
    $stock_out = new ReverseStockOut($props_array[0],$props_array[1],$props_array[2],$props_array[3]);
    $stock_out->reverse_stock_out();
}
