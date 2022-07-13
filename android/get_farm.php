<?php $localhost = "localhost";
		$username  = "root";
		$password  = "";
		$db        = "seed_tracking_db";

	    $con = new mysqli($localhost,$username,$password,$db);

	                                   $sql = "SELECT * FROM `farm`";

                                        $farm = array();				

									    $result=$con->query($sql);
										if($result->num_rows>0)
										{
											while($row=$result->fetch_assoc())

											{
												$temp = array();
												$temp['farm_id']     = $row['farm_ID'];
												$temp['hectors']     = $row['Hectors'];
												$temp['crop']     = $row['Crop_species'];
												$temp['variety']     = $row['Variety'];
												$temp['class']     = $row['Class'];
												$temp['period']     = $row['Period'];
												$temp['district']     = $row['District'];
												$temp['address']     = $row['Physical_address'];
												$temp['grower_id']     = $row['grower_ID'];

												array_push($farm, $temp);

												

											}


												}

												echo json_encode($farm);


												
 

										

												


?>