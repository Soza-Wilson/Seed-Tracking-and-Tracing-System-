<?php


class StockOut

{
    
    /// production: stock out function 
    //  production: stock out function is updating the item table , stock in table and its inserting data in the stock out table 
    //  data is inserted depending on the quantity of the item and the stock in which the item is being subtracted from
    private $stock_out_ID, $stock_out_quantity, $date, $time, $item_ID, $stock_in_ID, $item_quantity, $stock_in_quantity, $item_price, $order_ID, $amount, $item_status, $con;
    function __construct($item_ID, $stock_in_ID, $item_price, $item_quantity, $stock_in_quantity, $order_ID)
    {

        $this->item_ID = $item_ID;
        $this->stock_in_ID = $stock_in_ID;
        $this->item_quantity = (float)$item_quantity;
        $this->stock_in_quantity = (float)$stock_in_quantity;
        $this->order_ID = $order_ID;
        $this->item_price = $item_price;
        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->stock_out_ID = Util::generate_id('sout');
        $this->date = Util::get_current_date();
        $this->time = Util::get_current_time();
    }


    public function process_stock_out()
    {
        //  builder class for processing stock in 
        if ($this->get_balance() > 0) {

            $this->set_stock_out_quantity();
            $this->set_stock_out_amount();
            $this->update_item_status();
            $this->update_item();
            $this->update_stock_in();
            $this->register_stock_out();
        }
    }





    // function for registering stock in and updating all required tables 

    private  function register_stock_out()
    {
        //    this function is inserting data into the stock out table

        try {
            //code..
            $user_ID = $_SESSION['user'];

            $sql = "INSERT INTO `stock_out`(`stock_out_ID`, `item_ID`, `stock_in_ID`, `order_ID`, `quantity`, `amount`, `date`, `time`, `user_ID`) VALUES
            ('$this->stock_out_ID','$this->item_ID','$this->stock_in_ID','$this->order_ID','$this->stock_out_quantity','$this->amount','$this->date','$this->time','$user_ID')";

            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function get_balance()
    {

        //  getting balance for item stock out quantity

        $assigned_quantity = 0;

        try {
            //code...
            $sql = "SELECT SUM(quantity) as item_assigned_quantity from `stock_out` WHERE `item_ID` = '$this->item_ID'";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $assigned_quantity = $row['item_assigned_quantity'];
                    return   (float)$this->item_quantity - $assigned_quantity;
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function set_stock_out_amount()
    {
        //  this function is calculating the stock out amount by multiplying the item price and stock out quantity 
        $this->amount = (float) $this->stock_out_quantity * (float) $this->item_price;
    }

     

    private function set_stock_out_quantity()
    {

        // getting balance
        if ($this->stock_in_quantity >= $this->get_balance()) {
            $this->stock_out_quantity = $this->get_balance();
        } else {
            $this->stock_out_quantity = $this->stock_in_quantity;
        }
    }

    private function update_item_status()
    {
        //  updating item status , if we have no balance adding item quantity we update to complete if we have balance we update it to partly (partly complete )
        if ($this->stock_in_quantity >= $this->get_balance()) {
            $this->item_status = 'complete';
        } else {

            $this->item_status = 'partly';
        }
    }



    private function update_item()
    {
        try {
            //updating items table, update item status and item out quantity 
            $sql = "UPDATE `item` SET `status`='$this->item_status', `stock_out_quantity`= stock_out_quantity + '$this->stock_out_quantity' WHERE `item_ID`='$this->item_ID'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    private function update_stock_in()
    {

        $balance = $this->get_balance();

        

        // 
        $sql = '';
        if ($this->stock_in_quantity >= $balance) {
            $sql = "UPDATE `stock_in` SET `used_quantity`=  available_quantity - '$balance' ,`available_quantity`= available_quantity-'$balance' WHERE`stock_in_ID`='$this->stock_in_ID'";
        } else {
            $sql = "UPDATE `stock_in` SET `used_quantity`= used_quantity + available_quantity ,`available_quantity`= '0' WHERE`stock_in_ID`='$this->stock_in_ID'";
        }
        try {
            //code...
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}







