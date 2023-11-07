<?php

require('Product.php');

class InventoryManager
{

    private $con;
    private $product;
    private $transaction;
    private $certificate;


    /** 
     * 
     * we are not using any data validation class because the data is already validated using jquery
     */


    public function __construct()
    {

        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->product = new Product();
        $this->transaction = new Transaction();
        $this->certificate = new Certificate();
    }


    /**
     * 
     * 
     * We are parsing class crop variety and getting the price
     */
    private function get_seed_buy_prices($class, $crop, $variety): int
    {
        $price_array = $this->product->get_prices($crop, $variety);
        if ($class == "breeder") {
            return $price_array[0];
        } else if ($class == "pre_basic") {
            return $price_array[1];
        } else if ($class == "basic") {
            return $price_array[2];
        } else if ($class == "certified") {
            return $price_array[3];
        }
    }

    /**
     * 
     * 
     * This function is working with the product class to calculate stock in funds amount
     */

    private function calculate_amount($seed_class, $crop, $variety, $seed_quantity): int
    {
        $amount = $this->get_seed_buy_prices($seed_class, $crop, $variety);
        return $amount * (int)$seed_quantity;
    }


    public function register_stock($creditor, $certificate, $farm, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $supporting_dir, $user): string
    {
        $stock_ID = Util::generate_id('stock');
        $date = Util::get_current_date();
        $time = Util::get_current_time();
        $trans_type  = 'stock_in';
        $transaction_price = $this->get_seed_buy_prices($class, $crop, $variety);
        $calculated_amount = $this->calculate_amount($class, $crop, $variety, $quantity);
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

                if (

                    // If register stock is complete, we will register transaction and update the certificate quantity

                    $this->transaction->register_transaction(Util::generate_id('trans'), $trans_type, $stock_ID, $creditor, $transaction_price, $calculated_amount, $user) == "registered"
                    && $this->certificate->update_certificate_quantity("-", "available_quantity", $certificate, $quantity) == "updated"
                ) {
                    return "stock_registered";
                } else {
                    return "error_registering_stock";
                }
            }
            mysqli_close($this->con);
        } catch (\Throwable $th) {
            return $th;
        }
    }










    public function update_stock_details($stockInId, $old_certificate, $new_certificate, $crop, $variety, $class, $srn, $binCardNumber, $numberOfBags, $newQuantity, $oldQuantity, $description, $fileDirectory, $creditorId, $status) :string
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
            return "success".$status;
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
        $oldAmount = $this->transaction->get_old_amount($stockInId);
        if ($this->transaction->update_account_funds($creditorId, $oldAmount, 'minus')) {

            /*After creditor account restored calculate new amount and update creditor and transaction with new details.
            Getting transaction price and calculating the amount */

            $price = $this->get_seed_buy_prices($class, $crop, $variety);
            $new_amount = (int)$price * (int)$quantity;
            /// Adding new amount tom creditor account
            if ($this->transaction->update_account_funds($creditorId, $oldAmount, 'minus')) {
                // updating transaction with new transaction price and amount
                $this->transaction->update_transaction($price, $new_amount, $stockInId);
            }
        }
    }

    private function stock_in_update_certificate($old_certificate, $new_certificate, $newQuantity, $oldQuantity):string
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




    function delete_stock_in($creditor_id, $stock_in_id, $certificate, $quantity):string
    {

        // get transaction amount
        (int)$amount = $this->transaction->get_old_amount($stock_in_id);
        // Restore creditor funds account 
        $this->transaction->update_account_funds($creditor_id, $amount, 'minus');
        // Restore certificate if seed is certified
        if ($certificate == "not_certified") {
        } else {
            if ($this->certificate->update_certificate_quantity('+', 'available_quantity', $certificate, $quantity) == 'updated') {
                // Delete transaction 
                if ($this->transaction->delete_transaction($stock_in_id) == 'deleted') {
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
