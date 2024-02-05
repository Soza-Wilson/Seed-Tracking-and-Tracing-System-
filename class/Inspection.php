<?php

class Inspection
{

    private $con;

    public  function __construct()
    {
        $DB = new DbConnection();
        $this->con = $DB->connect();
    }



    public function register_inspection_data(
        $inspection_id,
        $date,
        $time,
        $farm,
        $user,
        $type,
        $isolation_distance,
        $planting_pattern,
        $off_type_percentage,
        $pest_disease_incidence,
        $defective_plants,
        $pollinating_females,
        $female_receptive_skills,
        $male_elamination,
        $off_type_cobs_at_shelling,
        $defective_cobs_at_shelling,
        $remarks
    ) {

        try {

            $sql = "INSERT INTO `inspection`(`inspection_ID`, `date`, `time`, `farm_ID`, `user_ID`,
             `type`, `isolation`, `planting_pattern`, `off_type_percetage`, `pest_disease_incidence`, 
             `defective_plants`, `pollinating_females_percentage`, `female_receptive_skills_percentage`,
             `male_leimination`, `off_type_cobs_at_shelling`, `defective_cobs_at_shelling`, `remarks`) VALUES ('[value-1]',
            '$inspection_id','$date','$time','$farm','$user','$type','$isolation_distance','$planting_pattern','$off_type_percentage','$pest_disease_incidence','$defective_plants',
            '$pollinating_females','$female_receptive_skills','$male_elamination','$off_type_cobs_at_shelling','$defective_cobs_at_shelling','$remarks')";
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function register_inspection_images()
    {
    }


    private function move_images()
    {
    }
}
