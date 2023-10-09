<?php 
class Database{


    
    static function connect(){

 // database connection
// $localhost = 'db';
// $username  = 'seed_tracking_DB';
// $password  = '123456sa.';
// $database  = 'seed_tracking_DB';
// $con = new mysqli($localhost, $username, $password, $database);

// $con = mysqli_connect("localhost", "root", "", "seed_tracking_db");


//$con = mysqli_connect('db', 'seed_tracking_DB', '123456sa.', 'seed_tracking_DB');
$con = mysqli_connect('localhost', 'root', 'soza123@Sa.', 'seed_tracking_DB');
return $con;
    }
}

?>