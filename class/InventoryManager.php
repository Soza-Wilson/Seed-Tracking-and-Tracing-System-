<?php

use Inventory\Expense;


spl_autoload_register(function ($class) {
    require "$class.php";
});


class InventoryManager
{
   
    use HasTransaction;
    
    private $con;
    private $product;
    private $certificate;
    private $expense;


    /** 
     * 
     * we are not using any data validation class because the data is already validated using jquery
     */


    public function __construct()
    {

        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->product = new Product();
        $this->expense = new Expense;
        $this->certificate = new Certificate();
        $this->transaction_date = Util::get_current_date();
        $this->transaction_time = Util::get_current_time();
        $this->transaction_id= Util::generate_id('transaction');
    }


    public function register_stock($creditor, $certificate, $farm, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $supporting_dir, $user): string
    {
        $stock_ID = Util::generate_id('stock');
        $date = Util::get_current_date();
        $time = Util::get_current_time();
        $trans_type  = 'stock_in';
        $transaction_price = $this->expense->get_seed_buy_prices($class, $crop, $variety);
        $calculated_amount = $this->expense->calculate_amount($class, $crop, $variety, $quantity);


        //  if transaction price is 0  than means the buy bback prices are not set 
        if ($transaction_price == 0) {
            return 'Not set';
        } else {
            try {
                $sql = "INSERT INTO `stock_in`(`stock_in_ID`, `user_ID`, `certificate_ID`, `farm_ID`,
           `creditor_ID`, `source`, `crop_ID`, `status`, `variety_ID`, `class`, `SLN`,
           `bincard`, `number_of_bags`, `quantity`, `used_quantity`, `available_quantity`,`processed_quantity`,`grade_outs_quantity`, `trash_quantity`,
           `description`, `supporting_dir`, `date`, `time`) VALUES ('$stock_ID','$user',
           '$certificate','$farm','$creditor','$source','$crop','$status','$variety','$class',
           '$srn','$bincard','$bags','$quantity',0,$quantity,0,0,0,'$description',
           '$supporting_dir','$date','$time')";

                $statement = $this->con->prepare($sql);
                if ($statement->execute()) {
                    try {

                        if (
                            // If register stock is complete, we will register transaction and update the certificate quantity
                            $this->register_transaction('creditor_buy_back',$trans_type, $stock_ID, $creditor, $transaction_price, $calculated_amount, $user) == "registered"
                            && $this->certificate->update_certificate_quantity("-", "available_quantity", $certificate, $quantity) == "updated"
                        ) {
                            // updating creditor account 
                            $this->update_account_funds($creditor, $calculated_amount, 'plus');
                            return "stock_registered";
                        } else {
                            return "error_registering_stock";
                        }
                    } catch (\Throwable $th) {
                        return $th;
                    }
                }
                mysqli_close($this->con);
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }










    public function update_stock_details($stockInId, $old_certificate, $new_certificate, $crop, $variety, $class, $srn, $binCardNumber, $numberOfBags, $newQuantity, $oldQuantity, $description, $fileDirectory, $creditorId, $status): string
    {

        /**
         * We are using 4 for status here because the code went through some jquery data validation
         * To find out more about status and the digits go to production/assets/js/jshandle/stock_in_details.js 
         * 
         * 
         */

        if ($status == 0) {
        } else if ($status == 4) {
            $this->stock_in_update_certificate($old_certificate, $new_certificate, $newQuantity, $oldQuantity);
        } else {
            $this->stock_in_update_transaction($creditorId, $stockInId, $newQuantity, $crop, $variety, $class);
            $this->stock_in_update_certificate($old_certificate, $new_certificate, $newQuantity, $oldQuantity);
        }

        try {
            //code...
            $sql = "UPDATE `stock_in` SET`crop_ID`='$crop',`variety_ID`='$variety',`class`='$class',`SLN`='$srn',`bincard`='$binCardNumber',`number_of_bags`='$numberOfBags',`quantity`='$newQuantity',`available_quantity`='$newQuantity',
            `description`='$description',`supporting_dir`='$fileDirectory',`certificate_ID`='$new_certificate' WHERE `stock_in_ID`='$stockInId'";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {
                return "success";
            }
            mysqli_close($this->con);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    //  update stock in helper functions 


    private function stock_in_update_transaction($creditorId, $stockInId, $quantity, $crop, $variety, $class)
    {

        //Restore old account funds amount
        $oldAmount = $this->get_old_amount($stockInId);
        if ($this->update_account_funds($creditorId, $oldAmount, 'minus')) {

            /*After creditor account restored calculate new amount and update creditor and transaction with new details.
            we are also getting transaction price and calculating the amount */

            $price = $this->expense->get_seed_buy_prices($class, $crop, $variety);
            $new_amount = (int)$price * (int)$quantity;
            /// Adding new amount tom creditor account
            if ($this->update_account_funds($creditorId, $oldAmount, 'minus')) {
                // updating transaction with new transaction price and amount
                $this->update_transaction($price, $new_amount, $stockInId);
            }
        }
    }

    private function stock_in_update_certificate($old_certificate, $new_certificate, $newQuantity, $oldQuantity): string
    {

        //  restore old certificate 
        if (
            $this->certificate->update_certificate_quantity("+", "available_quantity", $old_certificate, $oldQuantity) == 'updated' &&
            // register new certificate quantity 
            $this->certificate->update_certificate_quantity("-", "available_quantity", $new_certificate, $newQuantity) == 'updated'
        ) {
            return 'updated';
        }
    }




    // delete stock in 




    function delete_stock_in($creditor_id, $stock_in_id, $certificate, $quantity): string
    {

        // get transaction amount
        (float)$amount = $this->get_old_amount($stock_in_id);
        // Restore creditor funds account 
        $this->update_account_funds($creditor_id, $amount, 'minus');
        // Restore certificate if seed is certified
        if ($certificate == "not_certified") {
        } else {
            if ($this->certificate->update_certificate_quantity('+', 'available_quantity', $certificate, $quantity) == 'updated') {
                // Delete transaction 
                if ($this->delete_transaction($stock_in_id) == 'deleted') {
                    // Delete entery 
                    try {
                        $sql = "DELETE FROM stock_in WHERE stock_in.stock_in_ID ='$stock_in_id'";
                        $statement = $this->con->prepare($sql);
                        if ($statement->execute()) {
                            return "deleted";
                        }
                        mysqli_close($this->con);
                    } catch (\Throwable $th) {
                        return $th;
                    }
                }
            }
        }
    }



    
}
