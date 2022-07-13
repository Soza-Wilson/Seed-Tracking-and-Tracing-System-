<?php
include('../class/main.php');

if(isset($_POST['data2_selected'])){

    $data = htmlentities($_POST['data_selected']);
    $data2 = htmlentities($_POST['data2_selected']);
    if(!empty($data)){
        

         $sql = "SELECT  `variety_ID`, `basic`, `pre_basic`, `certified` FROM `price` WHERE `variety_ID` ='$data2' AND `crop_ID` ='$data'";
								$result = $con->query($sql);
								if($result->num_rows>0)
								{
									while($row=$result->fetch_assoc())
									{
										$pre_basic	 = $row["pre_basic"];
										$basic	 = $row["basic"];
										$certified = $row["certified"];

                                        echo $pre_basic;
                                        ;
                                      
                                    }

                                }

        //SELECT  `variety_ID`, `basic`, `pre_basic`, `certified` FROM `price` WHERE 1
    }

    
    
}
 

?>