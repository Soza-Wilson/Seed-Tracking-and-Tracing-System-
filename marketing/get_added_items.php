<?php
include('../class/main.php');

if(isset($_POST['class_data'])){
    

   /* $crop = htmlentities($_POST['crop_data']);
    $variety = htmlentities($_POST['variety_data']);
    $class = htmlentities($_POST['class_data']);

    
    if(!empty($class)){
        

         $sql = "SELECT  `variety_ID`, `basic`, `pre_basic`, `certified` FROM `price` WHERE `variety_ID` ='$variety' AND `crop_ID` ='$crop'";
								$result = $con->query($sql);
								if($result->num_rows>0)
								{
									while($row=$result->fetch_assoc())
									{
										$pre_basic	 = $row["pre_basic"];
										$basic	 = $row["basic"];
										$certified = $row["certified"];

                    
                                       

                                      if($class == "basic"){

                                        echo $basic ;
                                       }
                                       if($class == "pre_basic"){
                                        echo $pre_basic ;

                                      }

                                       if ($class == "certified"){
                                        echo $certified ;
                                       

                                      }
                                       
                                       
                                      
                  }

                  

                                }
                               
                            }

                            */
        //SELECT  `variety_ID`, `basic`, `pre_basic`, `certified` FROM `price` WHERE 1
    }

    
    

 

?>