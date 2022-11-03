<?php







require_once('../class/main.php');
header('Content-Type: application/json');





$sql="SELECT * FROM `test`";
$result = mysqli_query($con,$sql);

  $result = $con->query($sql);

  $data = array();
  foreach ($result as $row){
           $data[] = $row;



 

echo json_encode($data);

}
 
?>




