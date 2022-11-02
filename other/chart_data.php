<?php







require_once('../class/main.php');
header('Content-Type: application/json');





  $sql = "SELECT * FROM `bank_account`";
$sql="SELECT crop, SUM(stock_in.quantity) AS quantity FROM crop INNER JOIN stock_in ON stock_in.crop_ID = crop.crop_ID";
$result = mysqli_query($con,$sql);

  $result = $con->query($sql);

  $data = array();
  foreach($result as $row){
           $data[] = $row;



  mysqli_close($con);

echo json_encode($data);

}
 
?>




