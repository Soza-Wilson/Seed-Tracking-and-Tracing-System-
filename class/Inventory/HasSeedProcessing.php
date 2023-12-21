<?php


trait HasSeedProcessing
{
    private $grade_id, $processing_type, $assigned_quantity, $grade_outs_quantity, $trash_quantity, $available_quantity, $process_ID, $passed_process_type_id, $processed_quantity, $con;

    private function update_available_quantity_grading()
    {
        try {
            //code...
            $new_available_quantity = (float)$this->available_quantity - (float)$this->assigned_quantity;
            $sql = "UPDATE `grading` SET `available_quantity`=' $new_available_quantity' WHERE `grade_ID`='$this->grade_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function get_processed_quantity()
    {
        $t = (float)$this->trash_quantity + (float)$this->grade_outs_quantity;
        $processed_quantity = (float)$this->assigned_quantity - $t;
        return $processed_quantity;
    }

    private function register_process_type($process_type_id,$process_id)
    {

        try {
            $sql = "INSERT INTO `process_type`(`process_type_ID`, `process_ID`, `grade_outs_quantity`, `processed_quantity`, `trash_quantity`, `process_type`) 
            VALUES ('$process_type_id','$process_id','$this->grade_outs_quantity','$this->processed_quantity','$this->trash_quantity','$this->processing_type')";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function update_processing_type()
    {

      
        try {
            //code...
            $sql = "UPDATE `process_type` SET
            `process_type`='Cleaning_' WHERE `process_type_ID`='$this->passed_process_type_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    private function feedback()
    {
       echo 'saved';
    }
}
