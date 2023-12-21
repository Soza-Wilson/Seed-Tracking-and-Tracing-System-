<?php
spl_autoload_register(function ($class) {
    require "$class.php";
});


trait HasTransaction
{


    private $con;
    private $transaction_id;
    private $transaction_date;
    private $transaction_time;


    function __construct()
    {
        $connection = new DbConnection();
        $this->con = $connection->connect();
       
    }


    //  register tracation functiom


    private function register_transaction($transaction_type, $action_name, $action_id, $account_id, $transaction_price, $calculated_amount, $user_ID): string

    //  function takes transaction arguments, register's the data to the trasaction table in the seed_tracking_DB
    {

        try {
            //code...

            $sql = "INSERT INTO `transaction`(`transaction_ID`, `type`, `action_name`,
        `action_ID`, `C_D_ID`,`transaction_price`, `amount`, `trans_date`, `trans_time`, `trans_status`, `user_ID`) VALUES
        ('$this->transaction_id','$transaction_type','$action_name','$action_id','$account_id','$transaction_price','$calculated_amount',
        '$this->transaction_date','$this->transaction_time','payment_pending','$user_ID')";

            $statement = $this->con->prepare($sql);
            $statement->execute();
            return 'registered';
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

        /**
         * 
         * The account here is the creditor or debtor account NOT !! the bank account 
         * 
         */
        mysqli_close($this->con);
    }

    private function get_old_amount($action_id)
    {

        try {
            $sql = "SELECT  `transaction_price`, `amount` FROM `transaction` WHERE `action_ID`='$action_id'";
            $result =  $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $amount = $row["amount"];
                }
                return $amount;
            }
            mysqli_close($this->con);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    private function get_transaction_id(){
        return $this->transaction_id;
    }

    private function update_account_funds($id, $funds, $type)

    {
        $operation = '';
        if ($type == "plus") {
            $operation = '+';
        } else {
            $operation = '-';
        }
        try {
            //code...
            $sql = "UPDATE `creditor` SET `account_funds`= account_funds $operation '$funds' WHERE `creditor_ID`='$id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            return $th;
        }
    }


    private function update_creditor_funds($id, $funds, $type)
    {

        //  this function is updating  debtor account funds , function takes creaditor id ,account funds and type (plus or minus)
        $operation = '';
        if ($type == "plus") {
            $operation = '+';
        } else {
            $operation = '-';
        }
        try {
            //code...
            $sql = "UPDATE `creditor` SET `account_funds`= account_funds $operation '$funds' WHERE `creditor_ID`='$id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update_debtor_funds($id, $funds, $type)
    {

        //  this function is updating  debtor account funds , function takes creaditor id ,account funds and type (plus or minus)

        $operation = '';
        if ($type == "plus") {
            $operation = '+';
        } else {
            $operation = '-';
        }
        try {
            //code...
            $sql = "UPDATE `debtor` SET `account_funds`= account_funds $operation '$funds' WHERE `debtor_ID`='$id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            return $th;
        }
    }



    public function update_transaction($new_transaction_price, $amount, $action_id)
    {

        try {
            $sql = "UPDATE `transaction` SET      
          `transaction_price`='$new_transaction_price',`amount`='$amount' 
         WHERE `action_ID`='$action_id',";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete_transaction($action_id)
    {
        try {
            $sql = "DELETE FROM `transaction` WHERE transaction.action_ID ='$action_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            return $th;
        }
    }
    private function update_bank_account()
    {
    }
}
