<?php
$con = new mysqli("localhost","root","","seed_tracking_db");

$input = $_POST['search'];

$sql = "SELECT * FROM `grower` WHERE Fullname LIKE '$input'";
$result = $con->query($sql);

if($result->num_rows>0)
{
	while($row=$result->fetch_assoc())
    {
	   $name  = $row['Fullname'];		
	   $phone = $row['Fullname'];

	    echo"$phone";	
	}	
}
else{echo"error";}

?>