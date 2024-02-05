<?php



class ReverseStockOut
{

    

    private $item_id, $item_quantity, $stock_in_id, $stock_out_id, $con;
    public function __construct($item_id, $item_quantity, $stock_in_id, $stock_out_id)
    {
        $this->item_id = $item_id;
        $this->item_quantity = $item_quantity;
        $this->stock_in_id = $stock_in_id;
        $this->stock_out_id = $stock_out_id;
        $connection = new DbConnection();
        $this->con = $connection->connect();
    }


    public function reverse_stock_out()
    {
        // bulder function for reversing stock out 
        $this->delete_stock_out();
        $this->reverse_item_data();
        $this->reverse_stock_in_data();
    }

    private function reverse_item_data()
    {
        $balance = $this->get_balance();
        $status = '';
        if ($balance > 0) {
            $status = 'partly';
        } else {
            $status = 'not_added';
        }

        try {
            //code...
            $sql = "UPDATE `item` SET `stock_out_quantity`= stock_out_quantity - '$this->item_quantity', `status`='$status' WHERE `item_ID` = '$this->item_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function get_balance()
    {

        try {
            //code...
            $sql = "SELECT SUM(quantity) as item_assigned_quantity from `stock_out` WHERE `item_ID` = '$this->item_id'";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $assigned_quantity = $row['item_assigned_quantity'];
                    return    (float)$assigned_quantity - (float)$this->item_quantity ;
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function delete_stock_out()
    {
        try {
            //code...
            $sql = "DELETE FROM `stock_out` WHERE `stock_out_ID` = '$this->stock_out_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function reverse_stock_in_data()
    {
        try {
            //code...

            $sql = "UPDATE `stock_in` SET `used_quantity`= used_quantity - '$this->item_quantity',`available_quantity`= available_quantity + '$this->item_quantity' WHERE`stock_in_ID`='$this->stock_in_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
