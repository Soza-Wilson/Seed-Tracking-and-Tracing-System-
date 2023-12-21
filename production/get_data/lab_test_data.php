<?php


spl_autoload_register(function ($class) {
    if (file_exists('../../class/LabTest/' . $class . '.php')) {
        require '../../class/LabTest/' . $class . '.php';
    } elseif (file_exists('../../class/' . $class . '.php')) {
        require   '../../class/' . $class . '.php';
    }
});


if (isset($_POST['test_seed'])) {
    $lab_test = new AddLabTest();
}
