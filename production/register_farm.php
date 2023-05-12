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

$restricted = array("production_admin", "system_administrator", "field_officer");

if (in_array($position, $restricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}


// if( $position !="production_admin" || $position !="admin" || $position !="field_officer"){

//     header('Location:javascript://history.go(-1)');

// }

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
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jsHandle/register_farm_.js"></script>


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
                        <a href="index.html">
                            <span>Production</span>
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
                                        <span id="more-details"><?php echo $_SESSION['fullname'] ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                                            <a href="#!"><i class="ti-settings"></i>Settings</a>
                                            <a href="../logout.php"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 p-b-0">

                            </div>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Home</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="production_dashboard.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Stock</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="#" class="waves-effect waves-dark">
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

                            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">certificate</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-book"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Seed Certificates </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">

                                        <li>
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
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Growers</span>
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
                                <li class="active">
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

                                <li class="">
                                    <a href="active_test.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-reload"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Active lab test </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
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
                                            <h5 class="m-b-10">Register farm </h5>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="production_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>

                                            <li class="breadcrumb-item"><a href="register_farm">Register farm</a>
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
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">

                                                        <!-- <form action="register_farm.php" method="POST"> -->
                                                            <!-- /*
get registered grower form
*/ -->

                                                            <h5>Select grower</h5>

                                                            <div>
                                                            </div>
                                                            <div class=" card-block">

                                                                <div class="form-group row">
                                                                </div>

                                                                <div class="form-group row">
                                                                    <span class="pcoded-mcaret"></span>
                                                                    <div class="col-sm-6">
                                                                        <select id="grower_search_result" name="grower_search_result" class="form-control">

                                                                            <option value="0">Select Creditor</option>

                                                                        </select>
                                                                        <label id="warning_select_creditor" class="warning_text"> <span>Please Select grower <i class="icofont icofont-warning"></i></span></label>

                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <input id="grower_search" type="text" class="form-control" name="grower_search" placeholder="Search creditor by name" require="">
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-sm-2">



                                                            </div>
                                                            <div class="col-sm-6">

                                                                <a href="grower.php" class="btn btn-success btn-mat"><i class="icofont icofont-plus"></i>
                                                                    new grower

                                                                </a>

                                                            </div>

                                                    </div>

                                                </div>

                                                <div class="card">
                                                    <div class="card-header">

                                                        <!-- <form action="register_farm.php" method="POST"> -->
                                                            <!-- /*
get registered grower form
*/ -->

                                                            <h5>Upload grower's farm list (Optional)</h5>

                                                            <div>
                                                            </div>
                                                            <div class=" card-block">

                                                                <div class="form-group row">
                                                                </div>

                                                                <div class="form-group row">
                                                                    <span class="pcoded-mcaret"></span>
                                                                    <div class="col-sm-10">
                                                                        
                                                                    <input type="file" class="form-control" accept=".csv">

                                                                    </div>

                                                                    <div class="col-sm-1">
                                                                    <a href="grower.php" class="btn btn-success btn-mat"><i class="icofont icofont-upload"></i>
                                                                    Upload

                                                                </a>
                                                                    </div>

                                                                    <div class="col-sm-1">
                                                                    <a href="grower.php" class="btn btn-info btn-mat"><i class="icofont icofont-info"></i>
                                                                    Tips

                                                                </a>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                           

                                                    </div>

                                                </div>


                                                <!--                                           /*
get crop details
*/    -->

                                                .

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Enter crop details</h5>

                                        </div>
                                        <div class="card-block">

                                            <div class="form-group row">

                                                <div class="col-sm-12">
                                                    <select id="select_crop" name="crop" class="form-control" required="">





                                                    </select>
                                                    <label id="warning_crop" class="warning_text"> <span>Please select crop <i class="icofont icofont-warning"></i></span></label>

                                                </div>


                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <select id="select_variety" name="variety" class="form-control" required="">
                                                        <option value="variety_not_selected">Select Variety</option>

                                                    </select>
                                                    <label id="warning_variety" class="warning_text"> <span>Please select variety<i class="icofont icofont-warning"></i></span></label>

                                                </div>

                                                <div class="col-sm-1">
                                                   
                                                    <label id="warning_variety" >Variety type</label>

                                                </div>

                                                <div class="col-sm-5"  >
                                                <select id="variety_type" name="variety_type" class="form-control" required="">
                                                        <option value="-">-</option>
                                                      

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <select id="select_class" name="select_class" class="form-control" required="">
                                                        <option value="0">Select class</option>
                                                        <option value="basic">Basic</option>
                                                        <option value="pre_basic">Pre-Basic</option>
                                                        <option value="certified">Certified</option>

                                                    </select>
                                                    <label id="warning_class" class="warning_text"> <span>Please Select class <i class="icofont icofont-warning"></i></span></label>
                                                </div>
                                                
                                            </div>


                                            <div class="form-group row">


                                                <div class="col-sm-12">

                                                    <input id="hectors" type="number" class="form-control" name="hectors" placeholder="Hectors" require="">
                                                    <label id="warning_hectors" class="warning_text"> <span>Please enter assigned hectors <i class="icofont icofont-warning"></i></span></label>



                                                </div>



                                            </div>






                                        </div>


                                    </div>


                                    <!--                                          /*
add main crop certificate 
*/     -->

                                    <div class="card hybrid_items" >
                                        <div class="card-header">
                                            <h5>Breeding </h5>


                                        </div>

                                        <div class="card-block">

                                            <div class="form-group row">

                                                <div class="col-sm-12">

                                                    <select id="seed_breeding" name="seed_breeding" class="form-control" required="">
                                                        <option value="not_selected">Select breeding type</option>
                                                        <option value="inbred">inbred </option>
                                                        <option value="single_cross">single cross</option>
                                                        
                                                       

                                                    </select>
                                                    <label id="warning_breeding" class="warning_text"> <span>Please select breeding type<i class="icofont icofont-warning"></i></span></label>

                                               

                                                </div>




                                            </div>

                                        </div>



                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Select certificate</h5>




                                        </div>
                                        <div class="card-block">

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-6">

                                                    <select id="main_certificate"  class="form-control" >
                                                        <option value="no_certificate_selected">Select Certificate</option>
                                                        <option value="no_certificate_selected">-</option>






                                                    </select>

                                                    <label id="warning_main_certificate" class="warning_text"> <span>Please Select Certificate <i class="icofont icofont-warning"></i></span></label>

                                                </div>



                                                <div class="col-sm-3">

                                                    <input id="search_main_certificate" type="text" class="form-control" name="search_main_certificate" placeholder="Search certificate" require="">




                                                </div>

                                                <div class="col-sm-3">

                                                    <input id="main_quantity" type="number" class="form-control" name="main_quantity" placeholder="Quantity" require="">
                                                    <label id="warning_certificate_quantity" class="warning_text"> <span>Please enter seed quantity<i class="icofont icofont-warning"></i></span></label>


                                                </div>



                                            </div>
                                            <div class="card-header hybrid_items">

                                                <!--                                                                                                             /*
add hybrid male crop certificate 
*/      -->




                                                <h5>Hybrid Certificate</h5>




                                            </div>


                                            <div class="form-group row hybrid_items">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-6">

                                                    <select id="male_certificate" name="male_certificate" class="form-control" required="">
                                                        <option value="no_certificate_selected">Select Male Certificate</option>
                                                        <option value="no_certificate_selected">-</option>






                                                    </select>

                                                    <label id="warning_male_certificate" class="warning_text"> <span>Please select male certificate <i class="icofont icofont-warning"></i></span></label>


                                                </div>

                                                <div class="col-sm-3">

                                                    <input id="search_male_certificate" type="text" class="form-control" name="search_male_certificate" placeholder="Search Male certificate" require="">



                                                </div>

                                                <div class="col-sm-3">

                                                    <input id="male_quantity" type="number" class="form-control" name="male_quantity" placeholder="Male Quantity" require="">
                                                    <label id="warning_male_quantity" class="warning_text"> <span>Please enter male seed quantity<i class="icofont icofont-warning"></i></span></label>



                                                </div>





                                            </div>



                                            <!--                                                                                                            /*
add hybrid female crop certificate 
*/   -->



                                            <div class="form-group row hybrid_items">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-6">

                                                    <select id="female_certificate" name="female_certificate" class="form-control" required="">
                                                        <option value="no_certificate_selected">Select Female Certificate</option>
                                                        <option value="no_certificate_selected">-</option>






                                                    </select>
                                                    <label id="warning_female_certificate" class="warning_text"> <span>Please select female certificate <i class="icofont icofont-warning"></i></span></label>


                                                </div>

                                                <div class="col-sm-3">

                                                    <input id="search_female_certificate" type="text" class="form-control" name="search_female_certificate" placeholder="Search Female Certificate" require="">



                                                </div>

                                                <div class="col-sm-3">

                                                    <input id="female_quantity" type="number" class="form-control" name="female_quantity" placeholder="Female Quantity" require="">
                                                    <label id="warning_female_quantity" class="warning_text"> <span>Please enter female seed quantity<i class="icofont icofont-warning"></i></span></label>



                                                </div>






                                            </div>

                                            <div class="col-sm-12">

                                                <a href="add_certificate.php" class="btn btn-success btn-mat"><i class="icofont icofont-plus"></i>
                                                    New certificate

                                                </a>

                                            </div>


                                        </div>




                                    </div>

                                    <div class="card">
                                        <div class="card-header">

                                            <!--                                                                                                              /*
form add land history
*/  -->



                                            <h5>Add Land History</h5>


                                        </div>
                                        <div class="card-block">
                                            <label>
                                                Previous year
                                            </label>

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">
                                                    <select id="pre_select_crop" name="pre_crop" class="form-control" required="">
                                                        <option value="0">Select crop</option>
                                                        <option value="fallow">Fallow</option>
                                                        <option value="maize">Maize</option>
                                                        <option value="G/nuts">Ground nuts</option>
                                                        <option value="soyabean">Soyabean </option>
                                                        <option value="rice">Rice</option>
                                                        <option value="sorgum">Sorgum</option>
                                                        <option value="cowpea">Cowpea</option>
                                                        <option value="pegeonpea">Pigeonpea</option>
                                                        <option value="beans">Beans</option>




                                                    </select>
                                                    <label id="warning_pre_year" class="warning_text"> <span>Please select crop<i class="icofont icofont-warning"></i></span></label>

                                                </div>





                                            </div>


                                            <label>

                                                Other Previous Year
                                            </label>


                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">
                                                    <select id="other_select_crop" name="other_select_crop" class="form-control" required="">
                                                        <option value="0">Select crop</option>
                                                        <option value="fallow">Fallow</option>
                                                        <option value="maize">Maize</option>
                                                        <option value="G/nuts">Ground nuts -shelled-</option>

                                                        <option value="soyabean">Soyabean </option>
                                                        <option value="rice">Rice</option>
                                                        <option value="sorgum">Sorgum</option>
                                                        <option value="cowpea">Cowpea</option>
                                                        <option value="pegeonpea">Pigeonpea</option>
                                                        <option value="beans">Beans</option>



                                                    </select>
                                                    <label id="warning_other_pre_year" class="warning_text"> <span>Please select crop<i class="icofont icofont-warning"></i></span></label>
                                                </div>






                                            </div>






                                        </div>

                                    </div>


                                    <div class="card">

                                        <!--                                                                                                               /*
form adding farm location details
*/        -->



                                        <div class="card-header">
                                            <h5>Location</h5>


                                        </div>

                                        <div class="card-block">


                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-6">
                                                    <select id="select_region" name="select_region" class="form-control" required="">
                                                        <option value="0">Select Region</option>
                                                        <option value="central">Central Region</option>
                                                        <option value="northern">Northern Region</option>
                                                        <option value="southern">Southern Region</option>





                                                    </select>
                                                    <label id="warning_region" class="warning_text"> <span>Please select legion<i class="icofont icofont-warning"></i></span></label>
                                                </div>

                                                <div class="col-sm-3">
                                                    <select id="select_district" name="select_district" class="form-control" required="">
                                                        <option value="0">Select District</option>






                                                    </select>
                                                    <label id="warning_district" class="warning_text"> <span>Please select district<i class="icofont icofont-warning"></i></span></label>
                                                </div>
                                                <div class="col-sm-3">

                                                    <input id="epa" type="text" class="form-control" name="epa" placeholder="EPA / Trading center " require="">
                                                    <label id="warning_epa" class="warning_text"> <span>Please enter EPA / Area<i class="icofont icofont-warning"></i></span></label>



                                                </div>




                                            </div>

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-6">

                                                    <input id="area_name" type="text" class="form-control" name="area_name" placeholder="Area name / Estate" require="">
                                                    <label id="warning_area_name" class="warning_text"> <span>Please enter area name<i class="icofont icofont-warning"></i></span></label>



                                                </div>

                                                <div class="col-sm-6">

                                                    <input id="address" type="text" class="form-control" name="address" placeholder="Address" require="">
                                                    <label id="warning_address" class="warning_text"> <span>Please enter address<i class="icofont icofont-warning"></i></span></label>



                                                </div>




                                            </div>

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">

                                                    <input id="physical_address" type="textarea" class="form-control" name="physical_address" placeholder="Directions " require="">
                                                    <label id="warning_physical_address" class="warning_text"> <span>Please add directions <i class="icofont icofont-warning"></i></span></label>



                                                </div>







                                            </div>
                                            <div class="col-sm-12">



                                                <!-- <button type="submit" id="save_farm" value="save farm" class="btn btn-success btn-mat ">save</button> -->
                                                <button class="btn btn-success btn-mat" id=save_farm ><i class="icofont icofont-save"></i>Save</button>

                                                </br>
                                                </br>

                                                <a href="register_farm.php" class="btn btn-danger btn-mat"><i class="icofont icofont-warning"></i>
                                                    Cancle

                                                </a>


                                            </div>




                                        </div>






                                    </div>



                                    <!-- Basic Form Inputs card end -->
                                    <!-- Input Grid card start -->






                                  



                                </div>

                            </div>
                            <!-- Input Grid card end -->
                            <!-- Input Validation card start -->

                            <!-- Input Validation card end -->
                            <!-- Input Alignment card start -->

                            <!-- Input Alignment card end -->
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





//main class object and passing register farm required variables 

if (isset($_POST['save_farm'])) {





    if ($_POST['variety'] == 'VT002' || $_POST['variety'] == 'VT003' || $_POST['variety'] == 'VT004') {






        $class = "hybrid";
        $male = $_POST['male_certificate'];
        $male_quantity = $_POST['male_quantity'];
        $female = $_POST['female_certificate'];
        $female_quantity = $_POST['female_quantity'];
        $main = "-";
        $main_quantity = "-";
    } else {




        $class = $_POST['select_class'];
        $male = "-";
        $male_quantity = "-";
        $female = "-";
        $female_quantity = "-";
        $main = $_POST['main_certificate'];
        $main_quantity = $_POST['main_quantity'];
    }

    $object = new main();
    $object->register_farm(
        $_POST['hectors'],
        $_POST['crop'],
        $_POST['variety'],
        $class,
        $_POST['select_region'],
        $_POST['select_district'],
        $_POST['area_name'],
        $_POST['address'],
        $_POST['physical_address'],
        $_POST['epa'],
        $_POST['grower_search_result'],
        $_POST['pre_crop'],
        $_POST['other_select_crop'],
        $main,
        $main_quantity,
        $male,
        $male_quantity,
        $female,
        $female_quantity
    );
}










?>

</html>