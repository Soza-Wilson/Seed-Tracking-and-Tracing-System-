<?php

class AddLabTest
{


    /**
     * This class handles lab test functionality 
     * - checking if stock in already has active lab tests
     * - register new lab test 
     * 
     * 
     * 
     */



    private $con, $test_id, $test_date, $test_time, $status, $stock_ID, $germ_perc, $shell_perc, $purity_perc, $defects_perc, $moisture_content, $oil_content, $grade, $crop, $variety, $farm, $user_id;

    public function __construct($stock_ID, $germ_perc, $shell_perc, $purity_perc, $defects_perc, $moisture_content, $oil_content, $grade, $crop, $variety, $farm, $user_id)
    {
        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->test_id = Util::generate_id('test');
        $this->test_date = Util::get_current_date();
        $this->test_time = Util::get_current_time();
        $this->stock_ID = $stock_ID;
        $this->germ_perc = $germ_perc;
        $this->shell_perc = $shell_perc;
        $this->purity_perc = $purity_perc;
        $this->defects_perc = $defects_perc;
        $this->moisture_content = $moisture_content;
        $this->oil_content = $oil_content;
        $this->grade = $grade;
        $this->crop = $crop;
        $this->variety = $variety;
        $this->farm = $farm;
        $this->user_id = $user_id;
        $this->status = $this->get_test_status();
    }


    private function check_lab_test(): bool
    {

        try {
            $sql = "SELECT `test_ID`,
             `test_status` FROM `lab_test` WHERE stock_in_ID ='$this->stock_ID' AND test_status='active'";
            $result =  $this->con->query($sql);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function get_test_status()
    {
        $status = '';
        if ($this->grade == 'passed') {
            $status = 'active';
        } elseif ($this->grade == 'failed') {
            $status = 'inactive';
        }
        return $status;
    }


    public function register_lab_test()
    {
        if ($this->check_lab_test()) {
            return 'already_active';
        } else {
            try {
                //code..
                $sql = "INSERT INTO `lab_test`(`test_ID`, `date`, `time`, `crop_ID`, `variety_ID`, 
                `farm_ID`, `germination_percentage`, `moisture_content`, `oil_content`,
                 `shelling_percentage`, `purity_percentage`, `defects_percentage`, `grade`,
                 `stock_in_ID`, `user_ID`, `test_status`) VALUES ('$this->test_id','$this->test_date',
                '$this->test_time','$this->crop','$this->variety','$this->farm','$this->germ_perc','$this->moisture_content','$this->oil_content','$this->shell_perc','$this->purity_perc','$this->defects_perc',
                '$this->grade','$this->stock_ID','$this->user_id','$this->status')";

                $statement = $this->con->prepare($sql);
                if ($statement->execute()) {
                    return 'test_registered';
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }


}
