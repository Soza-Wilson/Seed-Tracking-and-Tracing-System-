<?php


/**
 * 
 * 
 * This class handles all seed grading functionalities, these include assigning seed for grading and generating required documents for the seed  handover process
 */


namespace Grading;

use DbConnection;
use Util;

spl_autoload_register(function ($class) {
    require "../$class.php";
});

class SeedGrading
{


    private $con;
    private $id;
    private $user;
    private $date;
    private $time;
    private $pdfType;
    private $total_quantity;
    private $stock_in_quantity;
    private $stock_in_id;
    private $assigned_quantity;



    function __construct($stock_in_id, $assigned_quantity, $user)
    {
        $connection = new DbConnection();
        $this->con = $connection->connect();
        $this->id = Util::generate_id('grade');
        $this->user = $user;
        $this->date = date("Y-m-d");
        $this->time = date("H:i:s");
        $this->pdfType = "handover";
        $this->total_quantity = "";
        $this->stock_in_quantity = "";
        $this->stock_in_id = $stock_in_id;
        $this->assigned_quantity = $assigned_quantity;
    }

    //  

    public function grade_seed()
    {

        try {
            //code...
            $sql = "INSERT INTO `grading`(`grade_ID`, `assigned_date`, `assigned_time`, `assigned_quantity`, `used_quantity`, `available_quantity`, `stock_in_ID`,
            `assigned_by`, `received_ID`, `received_name`, `status`, `file_directory`) VALUES 
           ('$this->id','$this->date','$this->time','$this->assigned_quantity','0','$this->assigned_quantity','$this->stock_in_id','$this->user','-','-','unconfirmed','-')";

            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    //  this function takes seed quantity and stock in id and checks in the inventory if the assigned quantity is exceeding the available quantity 

    private function check_quantity_limit(): string
    {

        try {
            //code...
            $sql = "SELECT SUM(assigned_quantity) AS total_graded, stock_in.quantity FROM `grading`
            INNER JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID WHERE grading.stock_in_ID = '$this->stock_in_id'";

            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total_quantity = $row['total_graded'];
                    $stock_in_quantity = $row['quantity'];
                }
                $stock = (float)$stock_in_quantity;
                $total = (float)$total_quantity + (float)$this->assigned_quantity;

                if ($total > $stock) {
                    return True;
                }
                mysqli_close($this->con);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }


    public function update_stockIn_grading_status($status)
    {

        global $con;

        $sql = "UPDATE `stock_in` SET `status`='$status' WHERE `stock_in_ID`='$this->stock_in_id'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {

            echo "updated" . $this->stock_in_id;
        }
    }
}


//   // assign ungraded seed for processing

//   static function assign_processing_quantity($stock_in_id, $assigned_quantity, $user)
//   {



//     global $con;
//     $grade_ID = self::generate_user("grade_seed");
//     $user_ID = $user;
//     $date = date("Y-m-d");
//     $time = date("H:i:s");
//     $pdfType = "handover";
//     $total_quantity = "";
//     $stock_in_quantity = "";


//     //Checking if all graded seed quantity are less than or equal to stock_in quantity

//     $sql = "SELECT SUM(assigned_quantity) AS total_graded, stock_in.quantity FROM `grading`
//     INNER JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID WHERE grading.stock_in_ID = '$stock_in_id'";

//     $result = $con->query($sql);
//     if ($result->num_rows > 0) {
//       while ($row = $result->fetch_assoc()) {
//         $total_quantity = $row['total_graded'];
//         $stock_in_quantity = $row['quantity'];
//       }
//       // echo ("<script> alert('$total_quantity.$stock_in_quantity');
//       // window.location='process_seed.php';
//       // </script>");

//       $stock = (int)$stock_in_quantity;
//       $total = (int)$total_quantity + (int)$assigned_quantity;

//       if ($total > $stock) {

//         //echo ("<scriTY\t> alert('$stock.$total'); </script>");

//         return "quantity_exceeded";
//       } else {
//         $sql = "INSERT INTO `grading`(`grade_ID`, `assigned_date`, `assigned_time`, `assigned_quantity`, `used_quantity`, `available_quantity`, `stock_in_ID`,
//           `assigned_by`, `received_ID`, `received_name`, `status`, `file_directory`) VALUES 
//           ('$grade_ID','$date','$time','$assigned_quantity','0','$assigned_quantity','$stock_in_id','$user_ID','-','-','unconfirmed','-')";

//         $statement = $con->prepare($sql);
//         $statement->execute();

//         // update stock in available quantity by subtracting assigned quantity with available 

//         if ($total == $stock) {

//           main::update_stockIn_grading_status($stock_in_id, "handover_pending");
//         }

//         if ($total < $stock) {

//           main::update_stockIn_grading_status($stock_in_id, "partly_assigned");
//         }


//         // create PDF file for assigned seed

//         echo $grade_ID;
//       }
//     }
//   }

//   static function update_stockIn_grading_status($stock_in_id, $status)
//   {

//     global $con;

//     $sql = "UPDATE `stock_in` SET `status`='$status' WHERE `stock_in_ID`='$stock_in_id'";
//     $statement = $con->prepare($sql);
//     if ($statement->execute()) {

//       echo "updated" . $stock_in_id;
//     }
//   }

//   static function handover_conformation($receive_id, $received_name, $file_directory, $grade_id, $passed_quantity, $stock_in_ID)
//   {
//     global $con;

//     $sql = "UPDATE `grading` SET `received_ID`='$receive_id',
//     `received_name`='$received_name',`status`='unprocessed',
//     `file_directory`='$file_directory' WHERE `grade_ID`='$grade_id'";
//     $statement = $con->prepare($sql);
//     if ($statement->execute()) {

//       echo "successful";
//     };




//     // Check if all stock_in quantity has been assigned for processing, if so update the status to unprocesssed 
//     $checkStatus = self::checkProcessStatus($stock_in_ID, "unprocessed");
//     if ((int)$checkStatus[0] + (int)$passed_quantity == (int)$checkStatus[1]) {
//       self::update_stockIn_grading_status($stock_in_ID, "uprocessed");
//     }
//     // $sql = "UPDATE `stock_in` SET `processed_quantity`='$passed_quantity' WHERE `stock_in_ID` = '$stock_in_ID'";
//     // $statement = $con->prepare($sql);
//     // $statement->execute();
//   }


//   static function checkProcessStatus($stock_in_id, $stage)
//   {
//     global $con;
//     $sql = "SELECT SUM(assigned_quantity) AS total_graded, stock_in.quantity FROM `grading`
//     INNER JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID WHERE grading.stock_in_ID = '$stock_in_id' AND grading.status='$stage'";

//     $result = $con->query($sql);
//     if ($result->num_rows > 0) {
//       while ($row = $result->fetch_assoc()) {
//         $total_quantity = $row['total_graded'];
//         $stock_in_quantity = $row['quantity'];
//       }

//       return [$total_quantity, $stock_in_quantity];
//     }
//   }





//   // clean and process seed

//   function process_seed($grade_ID, $type, $assigned_quantity, $grade_outs_quantity, $trash_quantity, $available_quantity, $process_ID, $passed_process_type_id)
//   {


//     $process_type_ID = $this->generate_user("pr_type");
//     global $con;

//     //Check if all processed transaction are greater are not more than the stock in quantity 

//     // $sql="SELECT SUM(assigned_quantity) AS total_processed FROM `process_seed`WHERE `process_ID` =''";


//     // echo("<script>$available_quantity</script>");




//     if ($type == "Cleaning ") {



//       $process_ID = $this->generate_user("process");

//       $user = $_SESSION['user'];
//       $process_date = date("Y-m-d");
//       $process_time = date("H:i:s");

//       // update available quantity in gr
//       $this->update_available_quantity_grading($grade_ID, $available_quantity, $assigned_quantity);

//       $sql = "INSERT INTO `process_seed`(`process_ID`, `assigned_quantity`, `processed_date`, `processed_time`, `grade_ID`, `user_ID`) VALUES 
//           ('$process_ID','$assigned_quantity','$process_date','$process_time','$grade_ID','$user')";

//       $statement = $con->prepare($sql);
//       $statement->execute();


//       $processed_quantity = $this->get_processed_quantity($trash_quantity, $grade_outs_quantity, $assigned_quantity);

//       $sql = "INSERT INTO `process_type`(`process_type_ID`, `process_ID`, `grade_outs_quantity`, `processed_quantity`, `trash_quantity`, `process_type`) 
//         VALUES ('$process_type_ID','$process_ID','$grade_outs_quantity','$processed_quantity','$trash_quantity','$type')";

//       $statement = $con->prepare($sql);
//       $statement->execute();
//       $this->update_available_quantity_grading($grade_ID, $available_quantity, $assigned_quantity);

//       echo ("<script> alert('saved!');
//        window.location='process_seed.php';
//        </script>");
//     } else {

//       $processed_quantity = $this->get_processed_quantity($trash_quantity, $grade_outs_quantity, $assigned_quantity);


//       // update cleaning status (i was lazy at the end)

//       // FIY this was not even close to the end 


//       $sql = "UPDATE `process_type` SET
//         `process_type`='Cleaning_' WHERE `process_type_ID`='$passed_process_type_id'";
//       $statement = $con->prepare($sql);
//       $statement->execute();

//       $sql = "INSERT INTO `process_type`(`process_type_ID`, `process_ID`, `grade_outs_quantity`, `processed_quantity`, `trash_quantity`, `process_type`) 
//         VALUES ('$process_type_ID','$process_ID','$grade_outs_quantity','$processed_quantity','$trash_quantity','$type')";

//       $statement = $con->prepare($sql);
//       $statement->execute();

//       $sql = "UPDATE `stock_in` INNER JOIN grading ON grading.stock_in_ID = stock_in.stock_in_ID INNER JOIN process_seed ON
//        process_seed.grade_ID = grading.grade_ID SET stock_in.status = 'uncertified' WHERE process_seed.process_ID='$process_ID'";

//       $statement = $con->prepare($sql);
//       $statement->execute();

//       echo ("<script> alert('saved!');
//       window.location='process_seed.php';
//       </script>");
//     }
//   }


//   function get_processed_quantity($trash_quantity, $grade_outs_quantity, $assigned_quantity)
//   {
//     $t = (int)$trash_quantity + (int)$grade_outs_quantity;
//     $processed_quantity = (int)$assigned_quantity - $t;
//     return $processed_quantity;
//   }




//   function update_available_quantity_grading($grade_id, $available_quantity, $assigned_quantity)
//   {

//     global $con;
//     $new_available_quantity = (int)$available_quantity - (int)$assigned_quantity;
//     $sql = "UPDATE `grading` SET `available_quantity`=' $new_available_quantity' WHERE `grade_ID`='$grade_id'";

//     $statement = $con->prepare($sql);
//     $statement->execute();
//   }
