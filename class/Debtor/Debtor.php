<?php

namespace Debtor;

spl_autoload_register(function ($class) {
    require "$class.php";
});


use DbConnection;
use Util;

class Debtor
{


    /**
     * This class handle all debtor functionality
     * 
     * 
     */

    private $name, $phone, $id, $user_id, $date, $con;

    function __construct($name, $phone)
    {
        $connection = new DbConnection();
        $this->id = Util::generate_id('debtor');
        $this->con = $connection->connect();
        $this->name = $name;
        $this->phone = $phone;
        $this->date = Util::get_current_date();
    }


    public function register_debtor($type)
    {
        $this->user_id = $_SESSION['user'];
        try {
            //code...

            $sql = "INSERT INTO `debtor`(`debtor_ID`, `name`, `phone`, `debtor_type`, `user_ID`,`registered_date`,`account_funds`) VALUES 
            ('$this->id','$this->name','$this->phone','$type','$this->user_id','$this->date',0)";

            $statement = $this->con->prepare($sql);
            $statement->execute();
            mysqli_close($this->con);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
