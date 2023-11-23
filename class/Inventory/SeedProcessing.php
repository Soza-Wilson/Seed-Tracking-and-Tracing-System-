<?php



namespace Grading;


spl_autoload_register(function ($class) {
  require "../$class.php";
});

use DbConnection;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use Util;






class SeedProcessing
{

  /**
   * This class is handling process seed functinalty, this includes 
   * - Assigning seed for processing
   * - Checking if assigned quantity is exceeding available quantity
   * - Updating seed grading status if assigning seed is finalized. Updating grading quantity will use gradingSeed class 
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
  private $user_id;


  function __construct($stock_in_id, $assigned_quantity, $user)
  {
    $connection = new DbConnection();
    $this->con = $connection->connect();
    $this->date = date("Y-m-d");
    $this->time = date("H:i:s");
    $this->id = Util::generate_id('grade');
    $this->$stock_in_id = $stock_in_id;
    $this->$assigned_quantity = $assigned_quantity;
    $this->user_id = $user;
  }


  public function assign_for_processing()
  {
    //  This function takes crop details and quantity to assign seed for processing
    //  Here we are checking if assigned quantity is exceeding the available quantity
    if ($this->check_quantity() == 'greater') {
      return "quantity_exceeded";
    } else {
      try {
        $sql = "INSERT INTO `grading`(`grade_ID`, `assigned_date`, `assigned_time`, `assigned_quantity`, `used_quantity`, `available_quantity`, `stock_in_ID`,
        `assigned_by`, `received_ID`, `received_name`, `status`, `file_directory`) VALUES 
        ('$this->id','$this->date','$this->time','$this->assigned_quantity','0','$this->assigned_quantity','$this->stock_in_id','$this->user_id','-','-','unconfirmed','-')";

        $statement = $this->con->prepare($sql);
        if ($statement->execute()) {
          // updating grading status if assigning seed for processing has been executed
          $this->update_status();
        }
        mysqli_close($this->$this->con);
      } catch (\Throwable $th) {
        return $th;
      }
    }
  }


  private function update_status(): void
  {
    $grading = new SeedGrading($this->stock_in_id, $this->assigned_quantity,"");
    //  this function is updating the seed grading status based on the assigned quantity for gradin`g 
    if ($this->check_quantity() == 'less') {
      $grading->update_stockIn_grading_status("handover_pending");
    } elseif ($this->check_quantity() == 'equal') {
      $grading->update_stockIn_grading_status("handover_pending");
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
