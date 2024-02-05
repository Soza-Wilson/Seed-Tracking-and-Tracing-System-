<?php

spl_autoload_register(function($class){
    require"$class.php";
    });
    

class Creditor
{
    

    use HasContract;


    private $register_date;
    private $season;
    private $con;



    function __construct()
    {
        
        $DB= new DbConnection();
        $this->con = $DB->connect();
        $this->season = new Season();


    }



    /**
     * 
     * register  grower
     * 
     * 
     */
    public function add_creditor($source, $name, $phone, $email, $description, $user, $status)
    {

        $creditor_ID = Util::generate_id("creditor");
        $date = $this->register_date;

        try {
            //code...
            $sql = "INSERT INTO `creditor`(`creditor_ID`, `source`, `name`, `phone`, `email`, `description`, `user_ID`,`registered_date`, `account_funds`,`creditor_status`) VALUES
        ('$creditor_ID','$source','$name','$phone','$email','$description','$user','$date',0,'$status')";

            $statement = $this->con->prepare($sql);
            $statement->execute();
            return ["added", $creditor_ID];
        } catch (\Throwable $th) {
            return "Error registering grower " . $th;
        }

        mysqli_close($this->con);
    }


    function update_grower($grower_id, $grower_name, $phone, $email, $file_directory)
    {
       
        $sql = "UPDATE `creditor` SET `name`='$grower_name',`phone`='$phone',`email`='$email' WHERE `creditor_ID`='$grower_id'";
        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {

            $season = $this->season->get_season();
            // Update contract file
            $sql = "UPDATE `contract` SET `dir`='$file_directory' WHERE `season`='$season' AND `grower`='$grower_id'";
            $statement = $this->con->prepare($sql);
            $statement->execute();

            return 'updated';
        }
    }






    function activate_grower($grower_id, $file_directory, $user)
    {


       
        $sql = "UPDATE `creditor` SET `creditor_status`='active' WHERE `creditor_ID`='$grower_id'";
        $statement = $this->con->prepare($sql);
        $statement->execute();

        $return_data = $this->register_contract($grower_id, $user, "grower", $file_directory);

        if ($return_data == "grower_registered") {
            return "activated";
        } else {
            return "error";
        }
    }



    function register_contract($creditor_id, $user_id, $type, $contract_directory)
    {

       
        $contract_ID = Util::generate_id("contract");
        $season = $this->season->get_season();


        $sql = "INSERT INTO `contract`(`contract_ID`, `season`, `type`, `grower`, `dir`, `user_ID`) VALUES 
    ('$contract_ID','$season','$type','$creditor_id','$contract_directory','$user_id')";

        // echo  $creditor_id,$user_id,$type,$contract_directory;

        $statement = $this->con->prepare($sql);
        $statement->execute();
        echo "grower_registered";
    }



    function deactivate_growers($season)
    {

       
        // getting all expired contracts

        $sql = "SELECT creditor_ID FROM creditor INNER JOIN contract ON contract.grower = creditor.creditor_ID INNER JOIN growing_season ON growing_season.season = contract.season WHERE growing_season.season='$season'";
        $result = $this->con->query($sql);
        //   Update all expired grower
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $creditors[] = $row['creditor_ID'];
            }
            foreach ($creditors as $id) {
                $sql = "UPDATE `creditor` SET `creditor_status`='inactive' WHERE `creditor_ID`='$id'";

                $statement = $this->con->prepare($sql);
                $statement->execute();
            }
        }



        // New season when max season expire
    }
}
