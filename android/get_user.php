<?php
$localhost = "localhost";
		$username  = "root";
		$password  = "";
		$db        = "seed_tracking_db";
	    $con = new mysqli($localhost,$username,$password,$db);

/*$name = $_POST['t1'];
$username = $_POST['t2'];
$password = $_POST['t3'];


$sql = "INSERT INTO `android_user`(`ID`, `name`, `user_name`, `password`) VALUES (NULL,'$name','$username','$password')";

 mysqli_query($con,$sql);

	 echo' user registered ';


*/

                                        $sql = "SELECT * FROM user";

                                        $user = array();				

									    $result=$con->query($sql);
										if($result->num_rows>0)
										{
											while($row=$result->fetch_assoc())
											{
												$temp = array();
												$temp['id']     = $row['user_ID'];
												$temp['department']     = $row['user_type_ID'];
												$temp['fullname']     = $row['fullname'];
												$temp['position']   = $row['postion'];
												$temp['email'] = $row['email'];
												$temp['password']  = $row['password'];

												array_push($user, $temp);

												

											}


												}

												echo json_encode($user);


												
 

										

												


?>