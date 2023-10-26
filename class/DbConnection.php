<?php


class DbConnection
{
   

   public function connect()
    {

        try {

            // database connection
            // $username  = 'seed_tracking_DB';
            // $password  = '123456sa.';
            // $database  = 'seed_tracking_DB';
            // $con = new mysqli($localhost, $username, $password, $database);
            $con = mysqli_connect("localhost", "root", "", "seed_tracking_db");
            //$con = mysqli_connect('db', 'seed_tracking_DB', '123456sa.', 'seed_tracking_DB');

            //code...
            // $con = mysqli_connect('localhost', 'root', 'soza123@Sa.', 'seed_tracking_DB');
            return $con;
        } catch (\Throwable $th) {
            die("Connection failed :" . $th);
        }
    }
}
