<?php




class DbConnection
{
   protected $host;
   protected $username;
   protected $password;
   protected $database;
   protected $port;


   function __construct()
   {

    $this->host = 'localhost';
    $this->username = 'root';
    $this->password = '';
    $this->database = 'seed_tracking_DB';
    $this->port = 3306;
    
    
   }

   public function connect()
    {

        try {

            // database connection
           
            $con = mysqli_connect($this->host, $this->username, $this->password, $this->database, $this->port);
            return $con;
        } catch (\Throwable $th) {
            die("Connection failed :" . $th);
        }
    }
}
