<?php


session_start();
require('../../class/Inventory/SeedProcessing.php');
require('../../class/DbConnection.php');
require('../../class/Util.php');


spl_autoload_register(function ($class) {
  if (file_exists('../../class/Inventory/' . $class . '.php')) {
    require_once '../../class/Inventory/' . $class . '.php';
  } elseif (file_exists('../../class/' . $class . '.php')) {
    require_once   '../../class/' . $class . '.php';
  }
});


$seed_processing = new SeedProcessing();

if (isset($_POST["assignForProcessing"])) {
  $data = $_POST["assignForProcessing"];
  echo $seed_processing->assign_for_processing($data[0], $data[1], $data[2]);
}

if (isset($_POST["seedHandOver"])) {
  $data = $_POST["seedHandOver"];
  echo $seed_processing->confirm_seed_handover($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
}

if (isset($_POST['cleanSeed'])) {

  $seed_data = $_POST['cleanSeed'];
  $cleaning = new Seedcleaning($seed_data[0],$seed_data[1],$seed_data[2],$seed_data[3],$seed_data[4],$seed_data[5],$seed_data[6],$seed_data[7]);
  echo $cleaning->assign_for_cleaning();
}
if (isset($_POST['processSeed'])) {
  $seed_data = $_POST['processSeed'];
  $processing = new SeedGrading($seed_data[0],$seed_data[1],$seed_data[2],$seed_data[3],$seed_data[4],$seed_data[5],$seed_data[6],$seed_data[7]);
  echo $processing->grade_seed();

  }
