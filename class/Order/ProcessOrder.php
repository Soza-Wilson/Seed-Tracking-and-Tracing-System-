<?php







class ProcessOrder
{

    /**
     * This class handles all functinality for processing order, which includes:
     * - register order trasanction 
     * - updating order status 
     * - generate pdf documents (dispatch note )
     * 
     * 
     * 
     */
    use HasTransaction;
 
    private $order_ID, $C_D_ID, $order_type, $action_type, $user_id, $order_amount,$con, $order_quantity,$transaction_id;
    function __construct($order_ID, $C_D_ID, $type, $printSave, $user)
    {
        $this->order_ID = $order_ID;
        $this->C_D_ID = $C_D_ID;
        $this->order_type = $type;
        $this->action_type = $printSave;
        $this->user_id = $user;
       
        $this->transaction_date = Util::get_current_date();
        $this->transaction_time = Util :: get_current_time();
        $this->transaction_id = Util::generate_id('transaction');
        
    }




    public function process_order()
    {
        $this->set_order_processed_total();
        $this->process_transaction();
        $this->update_order_status();
        $this->open_pdf_file();
    }


    private function update_order_status()
    {

        try {
            //code...
            $sql = "UPDATE `order_table` SET `status` ='processed' WHERE `order_ID` = '$this->order_ID'";

            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function set_order_processed_total()
    {
        // function is gettng total quantity and total amount from all stock out items in the order

        try {
            //code...
            $sql = "SELECT sum(amount) as total_amount,sum(quantity) as total_quantity  FROM `stock_out`WHERE order_ID ='$this->order_ID'";

            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $this->order_amount = $row["total_amount"];
                    $this->order_quantity = $row["total_quantity"];
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function process_transaction()
    //   function is adding new transaction and updating clients funds 
    //      
    {

        
        $this->register_transaction($this->order_type, 'process_order', $this->order_ID, $this->C_D_ID, '-', $this->order_amount, $this->user_id);
        $this->transaction_id = $this->get_transaction_id();
        if ($this->order_type == 'grower_order') {
            $this->update_creditor_funds($this->C_D_ID, $this->order_amount, 'minus');
        } else {
            $this->update_debtor_funds($this->C_D_ID, $this->order_amount, 'minus');
        }
    }

    private function open_pdf_file()
    {


        //  printing dispatch note by parsing data to the pdf_handler class
        //  if order type is grower we first pass data to a json file then we print the pdf file using javascript 
        if ($this->order_type == 'grower_order') {



            $json_array = array("order_id" => "$this->order_ID", "transaction_id" => $this->transaction_id, "total_quantity" => "$this->order_quantity", "pdfType" => "dispatch_note");
            $file = "assets/JSON/dispatch_order_details.json";
            $grower_order = new ProcessGrowerOrder($file, $json_array, $this->order_ID);
            $grower_order->process_grower_order();

            echo "customer,$this->order_ID,$this->transaction_id,$this->order_quantity,dispatch_note";

        } else {
            
         echo "customer,$this->order_ID,$this->transaction_id,$this->order_quantity,dispatch_note";
          

        }
    }
}




class ProcessGrowerOrder
{    /*
     Class handles grower order operations 
     - updating farm status
     - create a Json file for order details , updating json data 

    
    
    */

    private $file, $json_array, $order_id, $con;
    function __construct($file, $json_array, $order_id)
    {

        $this->file = $file;
        $this->json_array = $json_array;
        $this->order_id = $order_id;
        $transaction = new DbConnection();
        $this->con = $transaction->connect();
        
    }



    public function process_grower_order()
    {
        $this->update_farm_status();
        $this->register_grower_order_json();
    }

    private function get_farm_id()
    {

     

        $sql = "SELECT `farm_id` FROM `order_table` WHERE `order_ID`='$this->order_id'";
        $result = $this->con->query($sql);
        while ($row = $result->fetch_assoc()) {
            $farm_id = $row["farm_id"];
        }
        return $farm_id;
    }

    private function update_farm_status()
    {
        $farm_id = $this->get_farm_id();
        $sql = "UPDATE `farm` SET `order_status`='order_processed' WHERE `farm_ID`='$farm_id'";
        $statement = $this->con->prepare($sql);
        $statement->execute();
    }



    private function register_grower_order_json()
    {

        //  we are creating a JSON file if it does not exists, if it does we are updating the file contets 

        if (file_exists($this->file)) {

            $path = file_get_contents($this->file);
            $json_data[] = array(json_decode($path));
            if (!empty($json_data[0])) {

                unset($json_data[0]);

                $unsave = json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                if (file_put_contents($this->file, $unsave)) {
                    $final_data = $this->add_json_data($this->json_array);
                    file_put_contents($this->file, $final_data);
                }
            } else {

                echo "
           error";
            }
        } else {

            echo "
           error";
        }
    }


    private function add_json_data($data)
    {

        // function is encoding data to JSON
        $eco_data = json_encode($data);
        return $eco_data;
    }
}
