<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$object = '1';
$object = $_SESSION['fullname'];
$position = $_SESSION['position'];


if ($object == '1') {
    echo ("<script> alert('please log in first');
    </script>");
}
$restricted = array("system_administrator");

if (in_array($position, $restricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}

$main_certificate = $_GET["main_certificate"];
$main_quantity = $_GET["main_quantity"];
$male_certificate = $_GET["male_certificate"];
$male_quantity = $_GET["male_quantity"];
$female_certificate = $_GET["female_certificate"];
$female_quantity = $_GET["female_quantity"];





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
    <script type="text/javascript" src="assets/js/jsHandle/hybred_order.js"></script>

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript">

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
                                    <img src="../files/user_profile/<?php if ($_SESSION["profile"] == "") {
                                                                        $profile = "user.jpg";
                                                                    } else {
                                                                        $profile = $_SESSION["profile"];
                                                                    }
                                                                    echo $profile; ?>" class="img-radius" alt="User-Profile-Image">
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
                                    <img class="img-80 img-radius" src="../files/user_profile/<?php if ($_SESSION["profile"] == "") {
                                                                                                    $profile = "user.jpg";
                                                                                                } else {
                                                                                                    $profile = $_SESSION["profile"];
                                                                                                }
                                                                                                echo $profile; ?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php echo $_SESSION['fullname'] ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="../other/user_profile.php"><i class="ti-user"></i>View Profile</a>
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
                                    <a href="marketing_dashboard.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Orders &amp; Sales</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
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

                                <li class="">
                                    <a href="b_to_b.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Register Business </span>
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
                                            <h5 class="m-b-10">Order Details </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="marketing_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>

                                            <li class="breadcrumb-item"><a href="#!">Order details </a>
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









                                            </div>


                                            <!--  sale analytics end -->

                                            <!--  project and team member start -->

                                            <div class="col-xl-12 col-md-12" id="main_values">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Male seed details</h5>
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


                                                        <form>
                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Crop :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="main_crop" id="main_crop">

                                                                        <option value=""></option>
                                                                    </select>
                                                                    <input type="hidden" name="crop_id" value="<?php echo $_GET['crop_id']; ?>">
                                                                    <input type="hidden" name="variety_id" value="<?php echo $_GET['variety_id']; ?>">
                                                                    <input type="hidden" name="order_type" id="order_type" value="<?php echo $order_type; ?>">

                                                                </div>
                                                            </div>



                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Variety :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="main_variety" id="main_variety">

                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Class :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="main_class" id="main_class">

                                                                        <option value="breeder">Breeder</option>
                                                                    </select>
                                                                    <input type="hidden" name="creditor_id" value="<?php echo $_GET['creditor_id']; ?>">
                                                                    <input type="hidden" name="creditor_name" value="<?php echo $_GET['creditor_name']; ?>">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Quantity :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="main_quantity" id="main_quantity">

                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Price per KG :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="main_price" id="main_price">

                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Discount Price:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="main_discount" class="form-control" name="main_discount" placeholder="Discount price" require="" >
                                                                </div>
                                                                </br>
                                                                </br>

                                                               
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Total Price:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="main_total" class="form-control" name="main_total" placeholder="Price per kg" require="">
                                                                </div>
                                                            </div>




                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-12 inbred" id="male_values">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Male seed details</h5>
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


                                                        <form>
                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Crop :</label>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <select class="form-control" name="male_crop" id="male_crop">

                                                                        <option value=""></option>
                                                                    </select>

                                                                    <input type="hidden" name="crop_id" value="<?php echo $_GET['crop_id']; ?>">
                                                                    <input type="hidden" name="variety_id" value="<?php echo $_GET['variety_id']; ?>">
                                                                </div>
                                                            </div>



                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Variety :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="male_variety" id="male_variety">

                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Class :</label>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <select id="male_class" class="form-control" name="male_class">

                                                                        <option value="breeder">Breeder</option>
                                                                    </select>

                                                                    <input type="hidden" name="creditor_id" value="<?php echo $_GET['creditor_id']; ?>">
                                                                    <input type="hidden" name="creditor_name" value="<?php echo $_GET['creditor_name']; ?>">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Quantity :</label>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <select id="male_quantity" class="form-control" name="male_quantity">

                                                                        <option value=""></option>
                                                                    </select>



                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Price per KG :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select id="male_price" class="form-control" name="male_price">

                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Discount Price:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="male_discount" class="form-control" name="male_discount" placeholder="Discount price" require="">
                                                                </div>
                                                                </br>
                                                                </br>


                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Total Price:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="male_total" class="form-control" name="male_total" placeholder="Total Amount" require="">
                                                                </div>
                                                            </div>




                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-12 inbred" id="female_values">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Male seed details</h5>
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


                                                        <form>
                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Crop :</label>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <select class="form-control" name="female_crop" id="female_crop">

                                                                        <option value=""></option>
                                                                    </select>

                                                                    <input type="hidden" name="crop_id" value="<?php echo $_GET['crop_id']; ?>">
                                                                    <input type="hidden" name="variety_id" value="<?php echo $_GET['variety_id']; ?>">
                                                                </div>
                                                            </div>



                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Variety :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="female_variety" id="female_variety">

                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Class :</label>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <select id="female_class" class="form-control" name="female_class">

                                                                        <option value="breeder">Breeder</option>
                                                                    </select>

                                                                    <input type="hidden" name="creditor_id" value="<?php echo $_GET['creditor_id']; ?>">
                                                                    <input type="hidden" name="creditor_name" value="<?php echo $_GET['creditor_name']; ?>">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Quantity :</label>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <select id="female_quantity" class="form-control" name="female_quantity">

                                                                        <option value=""></option>
                                                                    </select>



                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Price per KG :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <select id="female_price" class="form-control" name="female_price">

                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Discount Price:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="female_discount" class="form-control" name="female_discount" placeholder="Discount price" require="">
                                                                </div>
                                                                </br>
                                                                </br>


                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label class="label bg-success">Total Price:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="female_total" class="form-control" name="female_total" placeholder="Total Amount" require="">
                                                                </div>
                                                            </div>




                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--  project and team member end -->

                                        <div class="col-xl-12 col-md-12">

                                            <div class="card" id="approval_for_discount">

                                                <div class="card-header">

                                                    <h5>Request for approval</h5>
                                                </div>

                                                <div class="card-block">


                                                    <div class="form-group row">

                                                        <div class="col-sm-5 requestDetails">
                                                            <label for="discount_price" class="label bg-primary">Original price</label>
                                                            <input type="text" id="original_price" class="form-control" name="original_price" placeholder="-" require="">
                                                            <input type="hidden" id="user_id" class="form-control" name="original_price" value="<?php echo $_SESSION['user']; ?>">
                                                            <input type="hidden" id="user_name" class="form-control" name="original_price" value="<?php echo $_SESSION['fullname']; ?>">
                                                            <input type="hidden" id="approvalId" class="form-control">
                                                            <input type="hidden" id="discount_type">

                                                        </div>
                                                        <div class="col-sm-1 requestDetails">
                                                            </br>
                                                            <label for="" class="text align-center">TO</label>
                                                        </div>
                                                        <div class="col-sm-5 requestDetails">
                                                            <label for="discount_price" class="label bg-primary">Discount price</label>
                                                            <input type="text" id="discount" class="form-control" name="discount" placeholder="-" require="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row requestDetails">

                                                        <div class="col-sm-2">

                                                            <a href="#discount" class="btn btn-success  btn-mat" id="discount_request"> <i class="icofont icofont-email"></i>Send request</a>
                                                        </div>



                                                    </div>


                                                    <div class="form-group row">
                                                        <div class="col-sm-12 approvedDetails">
                                                            <label for="discount_price" class="label bg-primary">Enter code</label>
                                                            <input type="text" id="accessCode" class="form-control" name="accessCode" placeholder="-" require="">


                                                        </div>
                                                    </div>




                                                    <div class="form-group row approvedDetails">

                                                        <div class="col-sm-2">

                                                            <a href="#original_price" class="btn btn-success  btn-mat" id="checkDiscountCode"> <i class="icofont icofont-unlock"></i>check code</a>


                                                        </div>



                                                    </div>


                                                </div>


                                            </div>



                                            <div class="card">

                                                <div class="card-block">
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-success btn-mat" id="place_order"><i class="icofont icofont-cart"></i> Place Order </button>
                                                        <input type="hidden" id="data_main_certificate" value="<?php echo $main_certificate; ?>">
                                                        <input type="hidden" id="data_main_quantity" value="<?php echo $main_quantity; ?>">
                                                        <input type="hidden" id="data_male_certificate" value="<?php echo $male_certificate; ?>">
                                                        <input type="hidden" id="data_male_quantity" value="<?php echo $male_quantity; ?>">
                                                        <input type="hidden" id="data_female_certificate" value="<?php echo $female_certificate; ?>">
                                                        <input type="hidden" id="data_female_quantity" value="<?php echo $female_quantity; ?>">
                                                        <input type="hidden" id="order_id">

                                                    </div>
                                                </div>




                                            </div>














                                        </div>

                                    </div>
                                </div>


                            </div>



                        </div>


                    </div>
                    <!-- Basic Form Inputs card end -->
                    <!-- Input Grid card start -->



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


if (isset($_POST['register'])) {

    $object = new main();
    $object->check_user_data($_POST['fullname'], $_POST['departments'], $_POST['dob'], $_POST['sex'], $_POST['role'], $_POST['phone'], $_POST['email'], $_POST['password_2']);
}

?>

</html>