<?php
spl_autoload_register(function($class){
    require"$class.php";
    });
class Farm
{
    
 

    private $id;
    private $register_date;
    private $certificate;


    function __construct()
    {
        
        $this->id = Util::generate_id("farm");
        $this->register_date = Util::get_current_date();
        $this->certificate = new Certificate();
        
       
    }



    /**
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     */


    function register_farm(
        $hectors,
        $crop,
        $variety,
        $class,
        $region,
        $district,
        $area_name,
        $address,
        $physical_address,
        $epa,
        $grower_ID,
        $previous_year,
        $other_year,
        $main_certificate,
        $main_quantity,
        $male_certificate,
        $male_quantity,
        $female_certificate,
        $female_quantity,
        $user,
        $hybrid_type

    ) {



        $farm_ID = $this->id;
        $registered_date = $this->register_date;
        $operation = '';

        if (!empty('$main_quantity')) {

            try {
                $sql = "INSERT INTO `farm`(`farm_ID`, `Hectors`, `crop_species`, 
                `crop_variety`, `class`, `region`, `district`, `area_name`,
                 `address`, `physical_address`, `EPA`, `user_ID`, `creditor_ID`, 
                 `registered_date`, `previous_year_crop`, `other_year_crop`, `order_status`,
                  `main_lot_number`, `main_quantity`, `male_lot_number`, `male_quantity`,
                   `female_lot_number`, `female_quantity`,`breeding_type`) VALUES ('$farm_ID','$hectors',
                   '$crop','$variety','$class','$region','$district','$area_name',
                   '$address','$physical_address','$epa','$user','$grower_ID','$registered_date','$previous_year',
                   '$other_year','unconfirmed','$main_certificate','$main_quantity','$male_certificate','$male_quantity','$female_certificate','$female_quantity','$hybrid_type')";

                $statement = $this->certificate->con->prepare($sql);
                $statement->execute();
            } catch (\Throwable $th) {
                return "error" . $th;
            }

            $new_certificate = [$main_certificate, $main_quantity, $male_certificate, $male_quantity, $female_certificate, $female_quantity];
            $operation = self::assign_farm_certificate_quantity($hybrid_type, $new_certificate);

            if ($operation == "updated") {
                return "added";
            } else {
                return "Error";
            }

            mysqli_close($this->certificate->con);
        }
    }


    /**
     * 
     * 
     * 
     * 
     * 
     * 
     */


    function update_farm(

        $hectors,
        $crop,
        $variety,
        $class,
        $region,
        $district,
        $area_name,
        $address,
        $physical_address,
        $epa,
        $farm_ID,
        $previous_year,
        $other_year,
        $main_certificate,
        $main_quantity,
        $male_certificate,
        $male_quantity,
        $female_certificate,
        $female_quantity,
        $user,
        $hybrid_type,
        $old_main_certificate,
        $old_main_quantity,
        $old_male_certificate,
        $old_male_quantity,
        $old_female_certificate,
        $old_female_quantity,
        $old_hybrid_type



    ) {


        $sql = "UPDATE `farm` SET `Hectors`='$hectors',`crop_species`='$crop',
        `crop_variety`='$variety',`class`='$class',`region`='$region',`district`='$district',
        `area_name`='$area_name',`address`='$address',`physical_address`='$physical_address',`EPA`='$epa',
        `previous_year_crop`='$previous_year',`other_year_crop`='$other_year',
        `main_lot_number`='$main_certificate',`main_quantity`='$main_quantity',
        `male_lot_number`='$male_certificate',`male_quantity`='$male_quantity',`female_lot_number`='$female_certificate',`female_quantity`='$female_quantity',`breeding_type`='$hybrid_type' WHERE `farm_ID`='$farm_ID'";

        $statement = $this->certificate->con->prepare($sql);
        if ($statement->execute()) {

            $old_certificate = [$old_main_certificate, $old_main_quantity, $old_male_certificate, $old_male_quantity, $old_female_certificate, $old_female_quantity];
            $new_certificate = [$main_certificate, $main_quantity, $male_certificate, $male_quantity, $female_certificate, $female_quantity];

            self::restore_assigned_seed_certificates($old_hybrid_type, $old_certificate);
            self::assign_farm_certificate_quantity($hybrid_type, $new_certificate);

            return  "updated";
        } else {
            return "Error";
        }

        mysqli_close($this->certificate->con);
    }
    /**
     * 
     * 
     * restoring certificate quantity 
     * 
     * 
     * 
     */



    function delete_farm(
        $farm_ID,
        $old_hybrid_type,
        $old_main_certificate,
        $old_main_quantity,
        $old_male_certificate,
        $old_male_quantity,
        $old_female_certificate,
        $old_female_quantity


    ) {

        try {
            $sql = "DELETE FROM `farm` WHERE `farm_ID`='$farm_ID'";
            $statement =$this->certificate->con->prepare($sql);
            $statement->execute();
            $old_certificate = [$old_main_certificate, $old_main_quantity, $old_male_certificate, $old_male_quantity, $old_female_certificate, $old_female_quantity];
            if (self::restore_assigned_seed_certificates($old_hybrid_type, $old_certificate) == "updated") {
                return "deleted";
            } else {
                return "error";
            }
        } catch (\Throwable $th) {
            return "error" . $th;
        }
    }



    /** 
     * 
     * private function
     * for  updateing certificate quantiity 
     * and restoring certificate quantity
     * 
     * 
     */


    private function restore_assigned_seed_certificates(
        $hybrid_type,
        $old_certificates

    ) {


        $result = '';

        if ($hybrid_type == "-") {
            $oldMainQuantity = (int)$old_certificates[1];
            $result = $this->certificate->update_certificate_quantity("+", "assigned_quantity", $old_certificates[0], $oldMainQuantity);
        } else  if ($hybrid_type == "hybrid_inbred") {
            $oldMaleQuantity = (int)$old_certificates[3];
            $oldFemaleQuantity = (int)$old_certificates[5];


            /**
             * Because hybrid seed require two certificats we have to check if both are updated 
             * so we have a nested if statements to check if both are updated 
             * 
             */

            if (
                // restoring Male certificate 
                $this->certificate->update_certificate_quantity("+", "assigned_quantity", $old_certificates[2], $oldMaleQuantity) == 'updated' &&

                //  restoring Female certificate
                $this->certificate->update_certificate_quantity("+", "assigned_quantity", $old_certificates[4], $oldFemaleQuantity)
            ) {
                $result = 'updated';
            } else {
                $result = "error";
            }
        }
        return $result;
    }



    /** 
     * 
     * private function
     * parsing data to the update_certificate quantity in the certificate class 
     * 
     * 
     * 
     */



    private  function assign_farm_certificate_quantity(
        $hybrid_type,
        $new_certificates
    ) {
        if ($hybrid_type == "-") {
            $newMainQuantity = (int)$new_certificates[1];
            return $this->certificate->update_certificate_quantity("-", "assigned_quantity", $new_certificates[0], $newMainQuantity);
        } else  if ($hybrid_type == "hybrid_inbred") {

            $newMaleQuantity = (int)$new_certificates[3];
            $newFemaleQuantity = (int)$new_certificates[5];
            /**
             * here we are doing the exact same thing we did in the restoring certificate quantity functioon 
             */
            if (
                $this->certificate->update_certificate_quantity("-", "assigned_quantity", $new_certificates[2], $newMaleQuantity) == 'updated' &&
                $this->certificate->update_certificate_quantity("-", "assigned_quantity", $new_certificates[4], $newFemaleQuantity == 'updated')
            ) {
                return "updated";
            } else {
                return 'error';
            }
        }
    }
}
