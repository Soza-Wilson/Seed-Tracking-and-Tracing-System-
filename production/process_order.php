<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$test = $_SESSION['fullname'];

if (empty($test)) {

    header('Location:../login.php');
}

$order_ID = $_GET['order_ID'];
$order_type = "";
$customer = "";
$customer_ID = "";
$user_requested = "";
$date = "";
$time = "";

$sql = "SELECT user.fullname,`order_ID`, `order_type`, `customer_id`, 
  `customer_name`, `order_book_number`, `status`, `date`, `time`, `count`,
    `total_amount` FROM `order_table` INNER JOIN user ON order_table.user_ID = user.user_ID
         WHERE order_table.order_ID = '$order_ID'";


$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {


        $order_type = $row["order_type"];
        $customer = $row["customer_name"];
        $customer_ID = $row["customer_id"];
        $user_requested = $row["fullname"];
        $date = $row['date'];
        $time = $row['time'];
    }
}

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

    <!-- waves.css -->
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

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jsHandle/process_order.js">

    </script>
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

                        <a href="">
                            <span>Production</span>
                        </a>

                        <a href="production"></a>
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
                                    <img src="../files/user_profile/<?php  if ($_SESSION["profile"] =="") {
                                                                                $profile = "user.jpg";
                                                                            } else {
                                                                                $profile = $_SESSION["profile"];
                                                                            }echo $profile;?>" class="img-radius" alt="User-Profile-Image">
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
                                    <img class="img-80 img-radius" src="../files/user_profile/<?php  if ($_SESSION["profile"] =="") {
                                                                                $profile = "user.jpg";
                                                                            } else {
                                                                                $profile = $_SESSION["profile"];
                                                                            }echo $profile;?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php echo $_SESSION['fullname'] ?></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                   
                                </div>
                            </div>
                            <div class="p-15 p-b-0">



                            </div>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Admin control </div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="pcoded-hasmenu">

                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="production_dashboard" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>






                                        </li>


                                    </ul>

                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Stock</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li>
                                            <a href="stock_in.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Add Stock </span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="view_stock_in.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-import"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">view Stock In </span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                    <a href="grading.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-brush-alt"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Grading </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                        <li class="active">
                                            <a href="stock_out.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-shopping-cart-full"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Stock out</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="view_stock_out.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-export"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">view Stock out</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="inventory.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-clipboard"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">inventory</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>




                                    </ul>


                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Seed processing</div>
                                    <ul class="pcoded-item pcoded-left-item">

                                        <li class="">
                                            <a href="process_seed.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-settings"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Process seed </span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_processed_seed.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-bookmark-alt"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">View Processed seed </span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="labels.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-receipt"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Generate Labels</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">certificate</div>
                            <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-book"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Seed Certificates </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        
                                    <li >
                                    <a href="add_certificate.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-agenda"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Register Certificate </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="available_certificates.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-files"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Available Certificates</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="used_certificates.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-na"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Used Certificates</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="expired_certificates.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-trash"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Expired Certificates</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                       
                            
                                    </ul>
                                </li>

                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Grower </div>
                            <ul class="pcoded-item pcoded-left-item">


                               
                            <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Growers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        
                                        <li class="">
                                        <a href="active_growers.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Active Growers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="">
                                        <a href="inactive_growers.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Inactive Growers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                       
                            
                                    </ul>
                                </li>
                                <li>
                                    <a href="register_farm.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-map-alt"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Register Farm</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="registered_farms.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-gallery"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Registered farms</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="inspection.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-car"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Inspection</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Lab test</div>

                            <ul class="pcoded-item pcoded-left-item">


                                <li class="">
                                    <a href="new_test.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-paint-bucket"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> New lab test </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="active_test.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-reload"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Active lab test </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="test_history.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-book"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Test History</span>
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
                                            <h5 class="m-b-10">Order items </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="production_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>

                                            <li class="breadcrumb-item"><a href="process_order.php">process order </a>
                                            </li>
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
                                            <!-- <form action="process_order.php" method="POST"> -->
                                                <div class="card-header">
                                                    <h5>Order details</h5>

                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                                            <li><i class="fa fa-trash close-card"></i></li>
                                                        </ul>
                                                    </div>



                                                    <div class="form-group row">


                                                        <span class="pcoded-mcaret"></span>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-success ">Order ID</label>
                                                            <select class="form-control" name="order_ID">
                                                                <option value="<?php echo $order_ID; ?>"><?php echo $order_ID; ?></option>
                                                            </select>



                                                        </div>


                                                        <div class="col-sm-2">
                                                            <label class="badge badge-success ">Order Type</label>
                                                            <select class="form-control" name="order_type">
                                                                <option value="<?php echo $order_type; ?>"><?php echo $order_type; ?></option>
                                                            </select>



                                                        </div>




                                                        <div class="col-sm-2">

                                                            <label class="badge badge-success ">Order for</label>
                                                            <select class="form-control" name="order_for">
                                                                <option value="<?php echo $customer_ID; ?>"><?php echo $customer; ?> </option>
                                                            </select>



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-success ">Requested by</label>
                                                            <select class="form-control" name="requested_by">

                                                                <option value="<?php echo $user_requested; ?>"><?php echo $user_requested; ?></option>
                                                            </select>



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-success ">Order date</label>
                                                            <select class="form-control" name="date">
                                                                <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
                                                            </select>



                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label class="badge badge-success ">Order time</label>
                                                            <select class="form-control" name="time">
                                                                <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
                                                            </select>



                                                        </div>







                                                    </div>




                                                </div>
                                        </div>




                                        <div class="card">
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h5 class="modal-title">Process Order</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">

                                                                <div class="col-sm-3">
                                                                    <button class="btn btn-success btn-mat" id ="print_dispatch" name="print_process_order_btn"><i class="ti ti-printer"></i> Save & Print Dispatch note</button>
                                                                </div>


                                                            </div>


                                                            

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-header">
                                                <h5>Items</h5>

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
                                                                <th>Item ID</th>
                                                                <th>Crop</th>
                                                                <th>Variety</th>
                                                                <th>class</th>
                                                                <th>Quantity</th>
                                                                <th>price per kg</th>
                                                                <th>Discount</th>
                                                                <th>Total price</th>
                                                                <th>status</th>
                                                                <th>Action</th>



                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $sql = "SELECT `item_ID`, `order_ID`,item.crop_ID,item.status, `crop`,variety.variety_ID,`variety`, `class`, `quantity`, `price_per_kg`, `discount_price`, `total_price` FROM
                                                             `item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID WHERE `order_ID` = '$order_ID'";

                                                            $result = $con->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {


                                                                    $item_ID      = $row["item_ID"];
                                                                    $order_ID = $row["order_ID"];
                                                                    $crop_ID = $row["crop_ID"];
                                                                    $crop     = $row["crop"];
                                                                    $variety_ID = $row["variety_ID"];
                                                                    $variety = $row["variety"];
                                                                    $class    = $row['class'];
                                                                    $quantity = $row['quantity'];
                                                                    $price_per_kg = $row['price_per_kg'];
                                                                    $discount_price = $row['discount_price'];
                                                                    $status =  $row['status'];
                                                                    $total_price = $row['total_price'];

                                                                    echo "
											<tr class='odd gradeX'>
                                            <td>$item_ID</td>
                                            <td>$crop</td>
                                            <td>$variety</td>
                                            <td>$class</td>
                                            <td>$quantity</td>
                                            <td>$price_per_kg </td>
                                            <td>$discount_price</td>
                                            <td>$total_price</td>
                                            <td>$status</td>
                                            <td>$total_price</td>

                                     
                                            <td><a href='stock_out_check_items.php? crop_ID=$crop_ID & variety_ID=$variety_ID & seed_class=$class & item_ID=$item_ID & quantity=$quantity & order_ID=$order_ID & discount_price=$discount_price & item_price=$price_per_kg'  class='btn btn-success btn-mat'>check inventory</a> </td>
                                            

												
											</tr>	
                                    
												
										";
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="card-block">
                                                  

                                                    <!-- <button value="process order" name="process_order_btn" class='btn btn-success'>Process Order</button> -->

                                                    <button type="button" class="btn btn-success btn-mat" data-toggle="modal" data-target="#myModal">Process Order</button>


                                                    <a href='stock_out.php' class='btn btn-danger btn-mat'>Back </a>

                                                   

                                                    <input type="hidden" id="order_id" value="<?php echo $order_ID?>">
                                                    <input type="hidden" id="c_d_id" value="<?php echo $customer_ID?>">
                                                    <input type="hidden" id="type" value="<?php echo $order_type?>">
                                                    <input type="hidden" id="user_id" value="<?php echo $_SESSION['user']?>">
                                                    





                                                </div>
                                                <!-- </form> -->
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
<?php

if (isset($_POST['print_process_order_btn'])) {

    $type = "";
    $printSave = "print";



    $order_ID = $_POST['order_ID'];
    $C_D_ID = $_POST['order_for'];
    $type = $_POST['order_type'];



    $object = new main();
    // $object->production_process_order($order_ID, $C_D_ID, $type, $printSave);
}

if (isset($_POST['process_order_btn'])) {

    $type = "";
    $printSave = "save";

    $order_ID = $_POST['order_ID'];
    $C_D_ID = $_POST['order_for'];
    $type = $_POST['order_type'];



    $object = new main();
    // $object->production_process_order($order_ID, $C_D_ID, $type, $printSave);
}






?>

</html>