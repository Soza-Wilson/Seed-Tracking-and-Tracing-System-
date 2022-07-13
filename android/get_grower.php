<?php $localhost = "localhost";
		$username  = "root";
		$password  = "";
		$db        = "seed_tracking_db";

	    $con = new mysqli($localhost,$username,$password,$db);

	                                   $sql = "SELECT `grower_ID`, `Fullname`, `Phone` FROM `grower`";

                                        $grower = array();				

									    $result=$con->query($sql);
										if($result->num_rows>0)
										{
											while($row=$result->fetch_assoc())
											{
												$temp = array();
												$temp['id']     = $row['grower_ID'];
												$temp['name']     = $row['Fullname'];
												$temp['phone']     = $row['Phone'];
												array_push($grower, $temp);

												

											}


												}

												echo json_encode($grower);


												
 

										

												


?>