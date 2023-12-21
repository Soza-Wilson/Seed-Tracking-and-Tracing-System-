<?php

class Seedcleaning
{

    use HasSeedProcessing;
    private $date, $time;
    protected $user_id;
    private $process_id;
    public function __construct($grade_id, $processing_type, $assigned_quantity, $grade_outs_quantity, $trash_quantity, $available_quantity, $process_ID, $passed_process_type_id)
    {
        $this->grade_id = $grade_id;
        $this->processing_type = $processing_type;
        $this->assigned_quantity = $assigned_quantity;
        $this->grade_outs_quantity = $grade_outs_quantity;
        $this->trash_quantity = $trash_quantity;
        $this->available_quantity = $available_quantity;
        $this->process_ID = $process_ID;
        $this->passed_process_type_id = Util::generate_id('pr_type');;
        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->date = Util::get_current_date();
        $this->time = util::get_current_time();
        $this->user_id = $_SESSION['user'];
        $this->processed_quantity = $this->get_processed_quantity();
        $this->process_id = Util::generate_id('process');
        
    }

    public function assign_for_cleaning()
    {

        $this->register_process_seed();
        $this->register_process_type($this->passed_process_type_id, $this->process_id);
        $this->update_available_quantity_grading();
        $this->feedback();
    }


    private function register_process_seed()
    {    
        
        try {
            //code..
            $sql = "INSERT INTO `process_seed`(`process_ID`, `assigned_quantity`, `processed_date`, `processed_time`, `grade_ID`, `user_ID`) VALUES 
        ('$this->process_id','$this->assigned_quantity','$this->date','$this->time','$this->grade_id','$this->user_id')";

            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
}
