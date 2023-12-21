<?php





class SeedProcessing
{

  /**
   * This class is handling process seed functinalty, this includes 
   * - Assigning seed for processing
   * - Checking if assigned quantity is exceeding available quantity
   * - Updating seed grading status if assigning seed is finalized. Updating grading quantity 
   * 
   * 
   * 
   */


  private $con;
  private $date;
  private $time;
  private $id;
  private $stock_in_id;
  private $assigned_quantity;



  function __construct()
  {
    $connection = new DbConnection();
    $this->con = $connection->connect();
    $this->date = date("Y-m-d");
    $this->time = date("H:i:s");
    $this->id = Util::generate_id('grade');
  }


  public function assign_for_processing($stock_in_id, $assigned_quantity, $user)
  {

    //  This function takes crop details and quantity to assign seed for processing
    //  Here we are checking if assigned quantity is exceeding the available quantity

    if ($this->check_quantity() == 'greater') {
      return "quantity_exceeded";
    } else {
      try {
        $sql = "INSERT INTO `grading`(`grade_ID`, `assigned_date`, `assigned_time`, `assigned_quantity`, `used_quantity`, `available_quantity`, `stock_in_ID`,
        `assigned_by`, `received_ID`, `received_name`, `status`, `file_directory`) VALUES 
        ('$this->id','$this->date','$this->time','$assigned_quantity','0','$assigned_quantity','$stock_in_id','$user','-','-','unconfirmed','-')";

        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {
          // updating grading status if assigning seed for processing has been executed
          $this->update_status();
          return $this->id;
        }
        mysqli_close($this->con);
      } catch (\Throwable $th) {
        return $th;
      }
    }
  }

  public function confirm_seed_handover($receive_id, $received_name, $file_directory, $grade_id, $passed_quantity, $stock_in_id)
  {

    try {
      //code...
      // Function is confirming seed hand over for prossessing, its taking user id username grade id and document directory 

      $sql = "UPDATE `grading` SET `received_ID`='$receive_id',
      `received_name`='$received_name',`status`='unprocessed',
      `file_directory`='$file_directory' WHERE `grade_ID`='$grade_id'";
      $statement = $this->con->prepare($sql);
      if ($statement->execute()) {
        $this->set_processing_status($passed_quantity, $stock_in_id);
        return 'hand over confirmed';
      }
    } catch (\Throwable $th) {
      throw $th;
    }
  }


  private function set_processing_status($passed_quantity, $stock_in_id)
  {
    // this function will check total assigned for grading quantity, if total quntity is equal to stock in quantity will update stock in status to uprocessed 
    $checkStatus = $this->get_assigned_quantity($this->stock_in_id, "unprocessed");
    if ((int)$checkStatus[0] + (int)$passed_quantity == (int)$checkStatus[1]) {
      $this->update_stockIn_grading_status($stock_in_id, "uprocessed");
    }
  }


  private function get_assigned_quantity($stock_in_id, $stage)
  {

    $sql = "SELECT SUM(assigned_quantity) AS total_graded, stock_in.quantity FROM `grading`
    INNER JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID WHERE grading.stock_in_ID = '$stock_in_id' AND grading.status='$stage'";

    $result = $this->con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $total_quantity = $row['total_graded'];
        $stock_in_quantity = $row['quantity'];
      }

      return [$total_quantity, $stock_in_quantity];
    }
  }

  private function update_status(): void
  {

    //  this function is updating the seed grading status based on the assigned quantity for gradin`g 
    if ($this->check_quantity() == 'less') {
      $this->update_stockIn_grading_status("partly_assigned");
    } elseif ($this->check_quantity() == 'equal') {
      $this->update_stockIn_grading_status("handover_pending");
    }
  }

  private function update_stockIn_grading_status($status)
  {

    try {
      //code...
      $sql = "UPDATE `stock_in` SET `status`='$status' WHERE `stock_in_ID`='$this->stock_in_id'";
      $statement = $this->con->prepare($sql);
      $statement->execute();
    } catch (\Throwable $th) {
      throw $th;
    }
  }





  private function check_quantity(): string
  {
    // This function is checking if assigned seed is exceeding the available seed quantity \
    try {
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
      }

      if ($total > $stock) {
        return 'greater';
      } else if ($total < $stock) {
        return 'less';
      } else {
        return 'equal';
      }
    } catch (\Throwable $th) {
      echo $th;
    }
  }
}
