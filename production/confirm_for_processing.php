<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$test = $_SESSION['fullname'];
$stock_in = $_GET['stock_in'];
$grade_ID = $_GET['grade_id'];
$crop = $_GET['crop'];
$variety = $_GET['variety'];
$class = $_GET['class'];
$quantity = $_GET['quantity'];
$received_ID = $_GET['user_ID'];
$received_name = $_GET['user_name'];


if (empty($test)) {

    header('Location:../login.php');
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
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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

                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/user.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
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
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Admin control </div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="pcoded-hasmenu">

                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="admin_dashboard" class="waves-effect waves-dark">
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

                                        <li class="">
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

                                        <li class="active">
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
                                <li class="">
                                    <a href="add_certificate.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-agenda"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add certificate </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="available_certificates.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-files"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">available certificates</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="used_certificates.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-na"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">used certificates</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="expired_certificates.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-trash"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Expired Certificates</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Grower </div>
                            <ul class="pcoded-item pcoded-left-item">


                                <li class="">
                                    <a href="grower.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Grower </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
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
                                    <a href="#" class="waves-effect waves-dark">
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
                                            <h5 class="m-b-10">Grade seed </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="admin_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="admin_pending_orders.php">Grade seed </a>

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
                                            <form action="confirm_for_processing.php" method="POST" enctype="multipart/form-data">
                                                <!-- // " -->
                                                <div class="card-header">
                                                    <h5>Seed details </h5>

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
                                                            <label class="badge badge-primary ">stock in ID</label>
                                                            <select class="form-control" name="grade_id">
                                                                <option value="<?php echo $grade_ID; ?>"><?php echo $grade_ID; ?></option>
                                                            </select>



                                                        </div>


                                                        <div class="col-sm-2">

                                                            <label class="badge badge-primary ">Crop</label>
                                                            <select class="form-control" name="crop">
                                                                <option value="<?php echo $crop; ?>"><?php echo $crop; ?></option>
                                                            </select>



                                                        </div>



                                                        <div class="col-sm-2">

                                                            <label class="badge badge-primary ">Variety</label>
                                                            <select class="form-control" name="variety">
                                                                <option value="<?php echo $variety; ?>"><?php echo $variety; ?></option>
                                                            </select>



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary ">Class</label>
                                                            <select class="form-control" name="class">
                                                                <option value="<?php echo $class; ?>"><?php echo $class; ?></option>
                                                            </select>



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary ">Quantity</label>
                                                            <select class="form-control" name="quantity">
                                                                <option value="<?php echo $quantity; ?>"><?php echo $quantity; ?></option>
                                                            </select>



                                                        </div>



                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary ">Stock In Date</label>
                                                            <select class="form-control" name="">
                                                                <option value="<?php echo $quantity; ?>"><?php echo $quantity; ?></option>
                                                            </select>



                                                        </div>







                                                        <div class="card-block">






                                                        </div>



                                                    </div>




                                                </div>
                                        </div>



                                        <!-- Background Utilities table end -->
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Confirm received seed</h5>

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

                                        <div class="card-block">























                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label>Upload Corfimation Document</label>


                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="file" id="conformation_file" class="form-control" name="conformation_file" placeholder="-" require="">
                                                    <input type="hidden" name="grade" value="<?php echo $grade_ID; ?>">
                                                    <input type="hidden" name="receive_id" value="<?php echo $received_ID; ?>">
                                                    <input type="hidden" name="receive_name" value="<?php echo $received_name; ?>">
                                                    <input type="hidden" name="passed_quantity" value="<?php echo $quantity; ?>">
                                                    <input type="hidden" name="stock_in_ID" value="<?php echo $stock_in; ?>">

                                                </div>
                                            </div>








                                            <div class="form-group row">







                                                </br></br></br>


                                                <div>

                                                </div>

                                                <br>
                                                .
                                                <div class="form-group">


                                                    <input type="submit" name="confirm" value="Confirm" class="btn waves-effect waves-light btn-success btn-block" />
                                                    <input type="submit" name="cancle_stock_in" value="Back" class="btn waves-effect waves-light btn-danger  btn-block" />

                                                </div>





                                                </form>



                                            </div>

                                        </div>
                                        <!-- Input Grid card end -->
                                        <!-- Input Validation card start -->

                                        <!-- Input Validation card end -->
                                        <!-- Input Alignment card start -->

                                        <!-- Input Alignment card end -->
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

//upload conformation document

if (isset($_FILES['conformation_file'])) {
    $errors = array();
    $file_name = $_FILES['conformation_file']['name'];
    $file_size = $_FILES['conformation_file']['size'];
    $file_tmp = $_FILES['conformation_file']['tmp_name'];
    $file_type = $_FILES['conformation_file']['type'];

    $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["conformation_file"]["name"]));


    $file_ext = strtolower(end(explode('.', $_FILES['conformation_file']['name'])));

    $extensions = array("pdf");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["conformation_file"]["tmp_name"], "../files/production/handover_conformation_documents/" . $newfilename);
        echo "Success";
    } else {
        $error = implode($errors);
        echo ("<script> alert('$error');
            window.location.href = 'process_seed.php';
        </script>");
    }
}

if (isset($_POST['confirm'])) {

    $object = new main();
    $grade_id = $_POST['grade'];
    $id = $_POST['receive_id'];
    $name = $_POST['receive_name'];
    $passed_quantity = $_POST['passed_quantity'];
    $stock_in = $_POST['stock_in_ID'];
    $object->handover_conformation($id, $name, $newfilename, $grade_id, $passed_quantity, $stock_in);
}



?>

</html>