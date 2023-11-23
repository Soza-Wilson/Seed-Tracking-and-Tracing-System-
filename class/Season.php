<?php
spl_autoload_register(function($class){
  require"$class.php";
  });
  

class Season
{

  private $creditor;
  private $con;


  function __construct()
  {
    $connect = new DbConnection();
    $this->con = $connect->connect();
   
  }



  function update_season($opening_date, $closing_date)
  {


    $season = "";

    $sql = "SELECT max(season) AS season FROM growing_season";

    $result = $this->con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $season = $row["season"];
      }

      $date = date("Y");
      $int_value = (int)$date + 1;
      $season = $date . "-" . $int_value;

      $sql = "UPDATE `growing_season` SET `season`='$season',`opening_date`='$opening_date',`closing_date`='$closing_date'";

      $statement = $this->con->prepare($sql);
      $statement->execute();
    }
  }




  function get_season()
  {

    $sql = "SELECT max(season) AS season FROM growing_season";
    $result = $this->con->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $season = $row['season'];
      }
      return $season;
    }
  }


  function check_season_closing()
  {

    $season = $this->get_season();

    // get colosing date 
    $sql = "SELECT opening_date,closing_date FROM growing_season WHERE season='$season'";
    $result = $this->con->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $closing_date = $row['closing_date'];
        $opening_date = $row['opening_date'];
      }

      $target_date = '2023-06-01';
      $current_date = date('Y-m-d');


      $target_timestamp = strtotime($closing_date);
      $current_timestamp = strtotime($current_date);

      if ($target_timestamp < $current_timestamp) {
        // $this->creditor->deactivate_growers($season);
        $this->create_new_season($opening_date, $closing_date);
      }
    }
  }



  function create_new_season($opening_date, $closing_date)
  {
    global $con;
    $date = date("Y");
    $int_value = (int)$date + 1;
    $season = $date . "-" . $int_value;
    $sql = "INSERT INTO `growing_season`(`season`, `opening_date`, `closing_date`) VALUES ('$season','$opening_date','$closing_date')";

    $statement = $con->prepare($sql);
    $statement->execute();
  }
}
