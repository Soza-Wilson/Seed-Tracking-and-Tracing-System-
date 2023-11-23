<?php
spl_autoload_register(function ($class) {
    require "$class.php";
});

trait HasContract

{
    private function register_contract($creditor_id, $user_id, $type, $contract_directory)
    {
        try {
            $contract_ID = $this->generate_user("contract");
            $season = $this->get_season();

            $sql = "INSERT INTO `contract`(`contract_ID`, `season`, `type`, `grower`, `dir`, `user_ID`) VALUES 
        ('$contract_ID','$season','$type','$creditor_id','$contract_directory','$user_id')";

            // echo  $creditor_id,$user_id,$type,$contract_directory;
            $statement = $this->con->prepare($sql);
            if ($statement->execute()) {
                return "contract_registered";
            } else {
                return "Error";
            }
        } catch (\Throwable $th) {

            return " error " + $th;
            //throw $th;
        }
    }
}
