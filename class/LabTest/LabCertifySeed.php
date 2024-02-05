<?php


class LabCertifySeed
{


    private $certificate, $stock_in_id, $quantity, $test_id, $stock_in_status, $con;
    public function __construct($certificate, $stock_in_id, $quantity, $test_id, $stock_in_status)

    {
        $this->certificate = $certificate;
        $this->stock_in_id = $stock_in_id;
        $this->quantity = $quantity;
        $this->test_id = $test_id;
        $this->stock_in_status = $stock_in_status;
        $DB = new DbConnection();
        $this->con = $DB->connect();
    }

    public function certify_seed()
    {

        if ($this->update_stock() && $this->update_certificate_quantity() && $this->update_certified_test() == 'updated') {
            return 'updated';
        }
    }

    private function update_stock()
    {

        //  we are adding seed certificate to seed that has passed lab tests
        //  we are getting the lot number from available certificates and we are updating stock in certificate and status 
        //  if stock in status is partly_graded, we will update to partl_cerfitied, so that the remaining quantity can be added for processing later (this functionality has already been done using JS )
        try {
            $sql = "UPDATE stock_in SET certificate_ID = '$this->certificate',status ='$this->stock_in_status' WHERE stock_in.stock_in_ID = '$this->stock_in_id'";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {
                return 'updated';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    private function update_certificate_quantity()
    {
        // calling the update_certificate function from Certificate class, 
        $certificate = new Certificate();
        return $certificate->update_certificate_quantity("-", "available_quantity", $this->certificate, (int)$this->quantity);
    }


    private function update_certified_test()
    {
        try {
            //code...
            $sql = "UPDATE lab_test SET test_status = 'inactive' WHERE test_ID = '$this->test_id'";
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {
                return 'updated';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
