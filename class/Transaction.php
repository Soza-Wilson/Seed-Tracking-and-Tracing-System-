<?php


class Transaction
{


    private $con;

    function __construct()
    {
        $connection = new DbConnection();
        $this->con = $connection->connect();
    }



    public function register_transaction($transaction_ID, $trans_type, $stock_ID, $creditor, $transaction_price, $calculated_amount, $user_ID)
    {


        $date = date("Y-m-d");
        $time = date("H:i:s");
        global $con;

        $sql = "INSERT INTO `transaction`(`transaction_ID`, `type`, `action_name`,
        `action_ID`, `C_D_ID`,`transaction_price`, `amount`, `trans_date`, `trans_time`, `trans_status`, `user_ID`) VALUES
        ('$transaction_ID','creditor_buy_back','$trans_type','$stock_ID','$creditor','$transaction_price','$calculated_amount',
        '$date','$time','payment_pending','$user_ID')";

        $statement = $con->prepare($sql);
        $statement->execute();

        /**
         * 
         * The account refgereed here is the creditor or debtor account NOT !! the bank account 
         * 
         */
    }

    public function get_old_amount($action_id)
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



    public function update_account_funds($creditor_id, $funds, $type)
    {
        $operation = '';
        if ($type == "plus") {
            $operation = '+';
        } else {
            $operation = '-';
        }
        try {
            //code...
            $sql = "UPDATE `creditor` SET `account_funds`= account_funds $operation '$funds' WHERE `creditor_ID`='$creditor_id'";
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
