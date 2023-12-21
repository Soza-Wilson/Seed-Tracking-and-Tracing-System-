<?php


class SeedGrading
{

    /***
     * This class handles seed processing stage, functionality includes 
     * 
     *  - Register seed processing stage 
     *  - update already registered seed processing type to used
     *  - checking stock in status and update based on the status
     * 
     * 
     */

    use HasSeedProcessing;
    public function __construct($grade_id, $processing_type, $assigned_quantity, $grade_outs_quantity, $trash_quantity, $available_quantity, $process_ID, $passed_process_type_id)
    {
        $this->grade_id = $grade_id;
        $this->processing_type = $processing_type;
        $this->assigned_quantity = $assigned_quantity;
        $this->grade_outs_quantity = $grade_outs_quantity;
        $this->trash_quantity = $trash_quantity;
        $this->available_quantity = $available_quantity;
        $this->process_ID = $process_ID;
        $this->passed_process_type_id = $passed_process_type_id;
        $this->processed_quantity = $this->get_processed_quantity();
        $connection = new DbConnection();
        $this->con = $connection->connect();
    }
    public function grade_seed()
    {
        $this->update_processing_type();
        $this->register_process_type(Util::generate_id('ptype'),$this->process_ID);
        $this->update_stock_in_status();
        $this->feedback();
    }


    private function get_stock_in_id(): string
    {
        try {
            $sql = "SELECT stock_in_ID from grading WHERE grade_ID = '$this->grade_id'";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $assigned_quantity = $row['stock_in_ID'];
                    return $assigned_quantity;
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    private function get_stock_in_processed_quantity(): array
    {
        $stock_in_id = $this->get_stock_in_id();
        try {

            $sql = "SELECT sum(grading.assigned_quantity) AS total_assigned_quantity , stock_in.quantity AS stock_in_quantity FROM
             grading JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID  WHERE grading.status = 'processed' AND grading.stock_in_ID = '$stock_in_id'";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total_assigned_quantity = $row['total_assigned_quantity'];
                    $stock_in_quantity = $row['stock_in_quantity'];
                    return [$total_assigned_quantity, $stock_in_quantity];
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    private function update_stock_in_status()
    {

        /**
         * Update stock in when total seed assigned for gradding is equal to stock_in quantity 
         * if total processed quantity is less than stock in quantity upadte to partly assigned 
         */
        $stock_in_status = '';
        $quantities = $this->get_stock_in_processed_quantity();
        if ((int)$quantities[0] = (int)$quantities[1]) {
            // update stock_in status to assigned for gradding 
            $stock_in_status = 'proccessed';
        } else if ((int)$quantities[0] < (int)$quantities[1]) {
            // update to partly assigned for processing
            $stock_in_status  = 'partly_processed';
        }
        try {

            $sql = "UPDATE `stock_in` INNER JOIN grading ON grading.stock_in_ID = stock_in.stock_in_ID INNER JOIN process_seed ON
         process_seed.grade_ID = grading.grade_ID SET stock_in.status = '$stock_in_status' WHERE process_seed.process_ID='$this->process_ID'";

            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
