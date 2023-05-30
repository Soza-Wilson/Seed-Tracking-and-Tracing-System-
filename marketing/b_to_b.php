<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start(); 

$test = $_SESSION['fullname'];

if(empty($test)){

    header('Location:../login.php');


}

// if($position !="marketing_admin" || $position !="admin" || $position !="marketing_officer"){
     
//     header('Location:javascript://history.go(-1)');

// }


?>

<head>
    <title>STTS</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->
      <link rel="icon" href="assets/images/main_icon.png" type="image/x-icon">
      <!-- Google font-->    
      <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style_.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
  </head>
  <body>
    <!-- Pre-loader start -->
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="">MArketing</a>
                        
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
            
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                           
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="assets/images/user.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span><?php echo $_SESSION['fullname'] ?></span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    
                                    <li class="waves-effect waves-light">
                                        <a href="../other/user_profile.php">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    
                                    <li class="waves-effect waves-light">
                                        <a href="../logout.php">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
    
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="assets/images/user.jpg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php echo $_SESSION['fullname'] ?></i></span>
                                    </div>
                                </div>
                        
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 p-b-0">
                                   
                                
                                
                            </div>
                           
                            
                          
                            
                                
                               
                            
                                 
                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Home</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="marketing_dashboard.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                            </ul>
                    
                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Orders &amp; Sales</div>
                    <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="place_order.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Place Order</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="view_pending_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-reload"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pending Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="view_processed_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-check"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Processed Orders </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="view_denied_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-face-sad"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Denied Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="view_all_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clipboard"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">All Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                               
                
                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Agro Dealer</div>
                            <ul class="pcoded-item pcoded-left-item">
                                
                                <li class="">
                                    <a href="agro_dealer.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Registered </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                               
                    
                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">B to B</div>
                            <ul class="pcoded-item pcoded-left-item">
                                
                                <li class="active">
                                    <a href="b_to_b.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Register Business </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="lpo.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-file"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">LPOs </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                    
                            </ul>
                            

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Sales</div>
                            <ul class="pcoded-item pcoded-left-item">
                                
                                <li class="">
                                    <a href="sales_list.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-stats-up"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">View Sales </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                    
                            </ul>

                           
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Business</h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="marketing_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            
                                            <li class="breadcrumb-item"><a href="grower.php">Business</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!-- Basic table card start -->
                                        <!-- Basic table card end -->
                                        <!-- Inverse table card start -->
                                        
                                        <!-- Inverse table card end -->
                                        <!-- Hover table card start -->
                                       
                                        <!-- Hover table card end -->
                                        <!-- Contextual classes table starts -->
                                        
                                            
                                        <!-- Contextual classes table ends -->
                                        <!-- Background Utilities table start -->
                                        <div class="card">
                                            <div class="card-header">

                                            <button type="button" class="btn btn-success btn-mat " data-toggle="modal" data-target="#myModal">Add new Business</button>

                                    <!-- Modal -->
                                                <div id="myModal" class="modal fade" role="dialog">
                                                     <div class="modal-dialog modal-lg">

                                                     <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                             <h5 class="modal-title">Register new Business</h5>
                                                            </div>
                                                                <div class="modal-body">
                                                                <form action="b_to_b.php" method="POST" enctype="multipart/form-data">

                                                                <div class="form-group row">
                                                                            
                                                                            <div class="col-sm-12">
                                                                                <input id="debtor_name" type="text" class="form-control" name="debtor_name"
                                                                                placeholder="Name" require="">
                                                                            </div>

                                                                            
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            
                                                                            <div class="col-sm-12">
                                                                                <input id="debtor_description" type="text" class="form-control" name="debtor_description"
                                                                                placeholder="Description" require="">
                                                                            </div>

                                                                            
                                                                        </div>




                                                                        <div class="form-group row">
                                                                            
                                                                            <div class="col-sm-12">
                                                                                <input id="debtor_phone" type="text" class="form-control" name="debtor_phone"
                                                                                placeholder="Phone number" require="">
                                                                            </div>

                                                                            
                                                                        </div>

                                                                       

                                                                        <div class="form-group row">
                                                                            
                                                                            <div class="col-sm-12">
                                                                                <input id="debtor_email" type="text" class="form-control" name="debtor_email"
                                                                                placeholder="Email" require="">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                            <input type="submit" name="register_business" value="Save" class="btn waves-effect waves-light btn-success btn-mat btn-block" />
                                                                          </div>
                                                                            
                                                                        </div>


                                                                         
                                                                        

                                                                        

                                                                </form>
                                                                    </div>
                                                                         <div class="modal-footer">
                                                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                          </div>
                                                                         </div>

                                                                             </div>
                                                                                        </div>

                                                                                        </div></div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Registred Businesses </h5>
                                              
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                                <th>Fullname</th>
                                                                <th>Description</th>
                                                                <th>Email </th>
                                                                <th>phone</th>
                                                                <th>Registered date</th>
                                                                <th>registered by</th>
                                                               
                                                                <th>Action</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php

                                   
                              $sql="SELECT `debtor_ID`, `name`, debtor.phone, debtor.email, `description`, `fullname`, `debtor_files`, debtor.registered_date FROM `debtor`
                              INNER JOIN user ON debtor.user_ID = user.user_ID WHERE `debtor_type` = 'b_to_b' ";

								$result = $con->query($sql);
								if($result->num_rows>0)
								{
									while($row=$result->fetch_assoc())
									{    $name= $row['name'];
                                        $description= $row['description'];
                                        $debtor_id=$row['debtor_ID'];
										$phone= $row['phone'];
                                        $email =$row['email'];
                                        $registered_date =$row['registered_date'];
										$registered_by = $row['fullname'];
                                        $dir = $row['debtor_files'];
                                        $page_type="b_to_b";
									
										
										
										
										
										
										echo"
											<tr class='odd gradeX'>
                                                 <td>$name</td>
                                                 <td>$description</td>
											    <td>$email</td>
												<td>$phone</td>
												<td>$registered_date</td>
												<td>$registered_by</td>
                                               
                                                
                                               
	
												<td><a href='account_details.php? debtor_id=$debtor_id&page_type=$page_type' class='btn btn-success'>View</a>
                                                
											</tr>	
										";
									}
								} 	
							    ?> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <!-- Background Utilities table end -->
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="assets/images/browser/chrome.png" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="assets/images/browser/firefox.png" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="assets/images/browser/opera.png" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="assets/images/browser/safari.png" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="assets/images/browser/ie.png" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js "></script>
    <!-- Custom js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>



</html>

<?php
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["image"]["name"]));


    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $extensions = array("pdf");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a pdf file .";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../files/marketing/agro_dealer_documents/" . $newfilename);
        echo "Success";
    } else {
        print_r($errors);
    }
}

if(isset($_POST['register_business']))

{

  
   
    $object = new main();

    $object -> register_B_to_B($_POST['debtor_name'],$_POST['debtor_description'],$_POST['debtor_phone'],$_POST['debtor_email'],"b_to_b","-");




}
?>
