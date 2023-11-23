<?php

require('../../class/Inventory/SeedProcessing.php');
use Grading\SeedProcessing;

if (isset($_POST["assignForProcessing"])) {
    $data = $_POST["assignForProcessing"];
    $seedProcessing = new SeedProcessing($data[0], $data[1], $data[2]);
    echo "yeah";
  }




