<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$test = $_SESSION['fullname'];
$position = $_SESSION['position'];

if (empty($test)) {

    header('Location:../index.php');
}

$restricted = array("system_administrator");

if (in_array($position, $restricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}



?>


<head>
    <title>STTS </title>
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style_.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jsHandler/add_product.js">
       
    </script>


</head>

<body>
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
                        <a href="">
                            <span>Admin</span>
                        </a>
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
                                        <span id="more-details"><?php echo $_SESSION['fullname'] ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="p-15 p-b-0">
                                <form class="form-material">

                                </form>
                            </div>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Admin control </div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="pcoded-hasmenu">

                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="admin_dashboard.php" class="waves-effect waves-dark">

                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>

                                        </li>


                                    </ul>

                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Setup</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="setup.php" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-settings"></i><b>FC</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Setup </span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    

                                </ul>
                                <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Users &amp; Roles</div>
                                    <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-user"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">User accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">

                                        <li class="">
                                            <a href="view_registered_users.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Active Users</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="user_other_accounts.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Other occounts</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>



                                    </ul>
                                </li>

                                </ul>

                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms"> Products &amp; Pricing</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="view_all_prices.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-notepad"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Products & Prices</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="active">
                                            <a href="add_product.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-plus"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Register product</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="set_prices.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Set sell prices</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="set_buy_prices.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Set buy back prices</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                    </ul>
                            </ul>



                            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Order &amp; Sales</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="admin_pending_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-reload"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pending Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="admin_processed_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-thumb-up"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Processed Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="admin_denied_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-thumb-down"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Denied Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="admin_all_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">All Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Finacial Statemets</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="view_ledger.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-list-ol"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Ledger</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Grant Access</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="grant_access_pending.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-lock"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Pending Requests</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                    <a href="grant_access_approved.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-unlock"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Approved Requests</span>
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
                                            <h5 class="m-b-10">Register new product</h5>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="admin_dashboard.php"> <i class="fa fa-home"></i> </a>

                                            <li class="breadcrumb-item"><a href="add_product.php">Register new product</a>
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

                                    <!-- Page body start -->

                                    <!-- Basic Form Inputs card end -->
                                    <!-- Input Grid card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Register product</h5>


                                        </div>
                                        <div class="card-block">

                                          

                                                

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label>Register new crop species </label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"  id="new_crop" placeholder="Register crop" require="">
                                                    </div>
                                                    
                                                </div>





                                                <div class="form-group row">


                                                    </br></br></br>
                                                    <div>

                                                    </div>

                                                    <br>

                                                    <div class="col-sm-12">

                                                     
                                                        <button type="submit" class="btn btn-success btn-mat" name="save_crop" id="save_crop"><i class="ti ti-save"></i>Register Crop</button>




                                                    </div>






                                                    <div id="test_one">


                                                    </div>


                                                </div>

                                        </div>




                                        <!-- Input Grid card end -->
                                        <!-- Input Validation card start -->

                                        <!-- Input Validation card end -->
                                        <!-- Input Alignment card start -->

                                        <!-- Input Alignment card end -->
                                    </div>

                                    <div class="card">

                                        <div class="card-block">






                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label>Register new variety dwd </label>
                                                </div>
                                                
                                                    <div class="col-sm-12">
                                                        <select id="select_crop" name="crop" class="form-control" required="">




                                                        </select>
                                                    </div>

                                                

                                                <div class="col-sm-12">
                                                    <label for="" class="label">Variety Name</label>
                                                    <input type="text" class="form-control" name="new_variety" id="new_variety" placeholder="Enter variety name" require="">
                                                </div>
                                                                     
                                              

                                              
                                                <div class="col-sm-12">
                                               
                                                    <select id="variety_type" name="variety_type" class="form-control" required="">
                                                        <option value="-">Select variety type</option>
                                                        <option value="-">None</option>
                                                        <option value="opv">OPV (Open Polinated Variety)</option>
                                                        <option value="hybrid">Hybrid</option>
                                                       





                                                    </select>

                                                    </div>
                                            </div>





                                            <div class="form-group row">


                                                </br></br></br>
                                                <div>

                                                </div>

                                                <br>

                                                <div class="col-sm-12">

                                                   

                                                    <button type="submit" class="btn btn-info btn-mat" name="save_variety" id="save_variety"><i class="ti ti-save"></i>Register variety</button>





                                                </div>





                                                </form>
                                                <div id="test_one">


                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Page body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->
                        <div>

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
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
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
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>

    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- Custom js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
<?php


?>

</html>