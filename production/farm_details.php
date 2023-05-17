<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$test = $_SESSION['fullname'];
$user_id = $_SESSION['user'];
$position = $_SESSION['position'];

if (empty($test)) {

    header('Location:../login.php');
}

$main = new main();
$notRestricted = array("production_admin", "system_administrator", "merl_officer", "warehouse_officer");

if (in_array($position, $notRestricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}
$farm_id = $_GET["farm_id"];

if (!empty($farm_id)) {



    $sql = "SELECT `farm_ID`, `Hectors`, `crop_species`,crop.crop, 
    `crop_variety`,variety.variety, `class`, `region`, `district`,
     `area_name`, `address`, user.fullname,`physical_address`, `EPA`, farm.user_ID, 
     farm.creditor_ID,creditor.name, farm.registered_date, `previous_year_crop`,
      `other_year_crop`, `breeding_type`, `main_lot_number`, 
      `main_quantity`, `male_lot_number`, `male_quantity`, `female_lot_number`, 
    `female_quantity` FROM `farm` INNER JOIN crop ON 
    crop.crop_ID= farm.crop_species INNER JOIN variety 
    ON variety.variety_ID = farm.crop_variety INNER JOIN creditor ON
     creditor.creditor_ID=farm.creditor_ID INNER JOIN user ON user.user_ID = farm.user_ID  WHERE `farm_ID`='$farm_id'";


    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $crop = $row["crop"];
            $cropId = $row["crop_species"];
            $varietyId = $row["crop_variety"];
            $variety = $row["variety"];
            $class = $row["class"];
            $hectors = $row["Hectors"];

            $grower_name = $row["name"];
            $grower_id = $row["creditor_ID"];
            $registered_by = $row["fullname"];
            $registered_date = $main->change_date_format($row["registered_date"]);


            // certificates data


            $main_lot_number = $row['main_lot_number'];
            $main_quantity = $row['main_quantity'];



            $male_lot_number = $row['male_lot_number'];
            $male_quantity = $row['male_quantity'];



            $female_lot_number = $row['female_lot_number'];
            $female_quantity = $row['female_quantity'];



            // region data 


            $region = $row["region"];
            $district = $row["district"];
            $area_name = $row["area_name"];
            $address = $row["address"];
            $physical_address = $row["physical_address"];
            $epa = $row["EPA"];


            // land history

            $previous_year = $row["previous_year_crop"];
            $other_year = $row["other_year_crop"];
        }
    }
} else {

    header("Location: registered_farms.php");
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
    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jsHandle/farm_details.js">

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

                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="p-15 p-b-0">



                            </div>








                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Home</div>
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
                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Grower</div>
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
                                <li>
                                    <a href="register_farm.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-map-alt"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Register Farm</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="active">
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
                                            <h5 class="m-b-10">Farm Details</h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="production_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>

                                            <li class="breadcrumb-item"><a href="farm_details.php">Farm Details</a>
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

                                        <div id="deleteModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h5 class="modal-title">Delete entry </h5>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="card-block">

                                                            <button class="btn btn-primary" id="delete_request" name="delete_request"> Request for approval</button>


                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">

                                                        <div class="col-sm-4">
                                                            <label for="bin_card" id="approval_label"> Enter Admin Approval Code</label>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <input type="text" id="accessCodeDelete" class="form-control" name="accessCodeDelete" placeholder="Enter code" require="">
                                                            <div id="code_validity">


                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button class="btn btn-primary" id="checkCodeDelete"><i class='icofont icofont-upload-alt'></i>Submit</button>
                                                        </div>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h5 class="modal-title">Update farm details </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>Enter crop details</h5>

                                                            </div>
                                                            <div class="card-block">

                                                                <div class="form-group row">

                                                                    <div class="col-sm-12">
                                                                    <label for="physsical_address" class="label bg-primary"> Select crop</label>
                                                                        <select id="select_crop" name="crop" class="form-control" required="">





                                                                        </select>
                                                                        <label id="warning_crop" class="warning_text"> <span>Please select crop <i class="icofont icofont-warning"></i></span></label>

                                                                    </div>


                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">

                                                                    <label for="physsical_address" class="label bg-primary"> Select variety</label>
                                                                        <select id="select_variety" name="variety" class="form-control" required="">
                                                                            <option value="variety_not_selected">Select Variety</option>

                                                                        </select>
                                                                        <label id="warning_variety" class="warning_text"> <span>Please select variety<i class="icofont icofont-warning"></i></span></label>

                                                                    </div>

                                                                    <div class="col-sm-1">

                                                                        <label id="warning_variety" class="label bg-primary"> Variety type</label>

                                                                    </div>

                                                                    <div class="col-sm-5">
                                                                        <select id="variety_type" name="variety_type" class="form-control" required="">
                                                                            <option value="-">-</option>


                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">

                                                                    <label for="physsical_address" class="label bg-primary"> Select Seed Class</label>
                                                                        <select id="select_class" name="select_class" class="form-control" required="">
                                                                            <option value="0">Select class</option>
                                                                            <option value="Pre_basic">Basic</option>
                                                                            <option value="basic">Pre-Basic</option>
                                                                            <option value="certified">certified</option>




                                                                        </select>
                                                                        <label id="warning_class" class="warning_text"> <span>Please Select class <i class="icofont icofont-warning"></i></span></label>
                                                                    </div>

                                                                </div>


                                                                <div class="form-group row">


                                                                    <div class="col-sm-12">

                                                                    <label for="physsical_address" class="label bg-primary"> Enter assigned hectors</label>

                                                                        <input id="hectors" type="number" class="form-control" name="hectors" placeholder="Hectors" require="">
                                                                        <label id="warning_hectors" class="warning_text"> <span>Please enter assigned hectors <i class="icofont icofont-warning"></i></span></label>



                                                                    </div>



                                                                </div>






                                                            </div>


                                                        </div>


                                                        <!-- Slelect breeding type -->

                                                        <div class="card hybrid_items">
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


                                                        <!-- certificates -->


                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>Select certificate</h5>




                                                            </div>
                                                            <div class="card-block">

                                                                <div class="form-group row">


                                                                    <span class="pcoded-mcaret"></span>


                                                                    <div class="col-sm-6 inbred_items">
                                                                    <label for="physsical_address" class="label bg-primary"> Other Previous Year</label>
                                                                        <select id="main_certificate" class="form-control">
                                                                            <option value="no_certificate_selected">Select Certificate</option>
                                                                            <option value="no_certificate_selected">-</option>






                                                                        </select>
        
                                                                        <label id="warning_main_certificate" class="warning_text"> <span>Please Select Certificate <i class="icofont icofont-warning"></i></span></label>

                                                                    </div>



                                                                    <div class="col-sm-3 inbred_items">

                                                                         
                                                                    <label for="physsical_address" class="label bg-primary">search for lot number</label>
                                                                        <input id="search_main_certificate" type="text" class="form-control" name="search_main_certificate" placeholder="Search certificate" require="">




                                                                    </div>

                                                                    <div class="col-sm-3 inbred_items">
                                                                    <label for="physsical_address" class="label bg-primary"> Enter Certificate quantity</label>
                                                                        <input id="main_quantity" type="number" class="form-control" name="main_quantity" placeholder="Quantity" require="">
                                                                        <label id="warning_certificate_quantity" class="warning_text"> <span>Please enter seed quantity<i class="icofont icofont-warning"></i></span></label>


                                                                    </div>



                                                                </div>
                                                                <div class="card-header hybrid_items">

                                                                    <!--                                                                                                             /*
add hybrid male crop certificate 
*/      -->




                                                                    <h5 class="single_cross_items">Hybrid Certificates</h5>




                                                                </div>


                                                                <div class="form-group row hybrid_items">


                                                                    <span class="pcoded-mcaret"></span>


                                                                    <div class="col-sm-6 single_cross_items">
                                                                    <label for="physsical_address" class="label bg-primary">Male certificate</label>
                                                                        <select id="male_certificate" name="male_certificate" class="form-control" required="">
                                                                            <option value="no_certificate_selected">Select Male Certificate</option>
                                                                            <option value="no_certificate_selected">-</option>






                                                                        </select>

                                                                        <label id="warning_male_certificate" class="warning_text"> <span>Please select male certificate <i class="icofont icofont-warning"></i></span></label>


                                                                    </div>

                                                                    <div class="col-sm-3 single_cross_items">
                                                                    <label for="physsical_address" class="label bg-primary"> Search for lot number</label>
                                                                        <input id="search_male_certificate" type="text" class="form-control" name="search_male_certificate" placeholder="Search Male certificate" require="">



                                                                    </div>

                                                                    <div class="col-sm-3 single_cross_items">
                                                                    <label for="physsical_address" class="label bg-primary">Enter Male certificate quantity</label>
                                                                        <input id="male_quantity" type="number" class="form-control" name="male_quantity" placeholder="Male Quantity" require="">
                                                                        <label id="warning_male_quantity" class="warning_text"> <span>Please enter male seed quantity<i class="icofont icofont-warning"></i></span></label>



                                                                    </div>





                                                                </div>



                                                                <!--                                                                                                            /*
add hybrid female crop certificate 
*/   -->



                                                                <div class="form-group row hybrid_items">


                                                                    <span class="pcoded-mcaret"></span>


                                                                    <div class="col-sm-6 single_cross_items">

                                                                    <label for="physsical_address" class="label bg-primary">Female certificate</label>
                                                                        <select id="female_certificate" name="female_certificate" class="form-control" required="">
                                                                            <option value="no_certificate_selected">Select Female Certificate</option>
                                                                            <option value="no_certificate_selected">-</option>






                                                                        </select>
                                                                        <label id="warning_female_certificate" class="warning_text"> <span>Please select female certificate <i class="icofont icofont-warning"></i></span></label>


                                                                    </div>

                                                                    <div class="col-sm-3 single_cross_items"> 
                                                                    <label for="physsical_address" class="label bg-primary"> Searchfor lot number</label>

                                                                        <input id="search_female_certificate" type="text" class="form-control" name="search_female_certificate" placeholder="Search Female Certificate" require="">



                                                                    </div>

                                                                    <div class="col-sm-3 single_cross_items">
                                                                    <label for="physsical_address" class="label bg-primary">enter  Female certificate quantity</label>

                                                                        <input id="female_quantity" type="number" class="form-control" name="female_quantity" placeholder="Female Quantity" require="">
                                                                        <label id="warning_female_quantity" class="warning_text"> <span>Please enter female seed quantity<i class="icofont icofont-warning"></i></span></label>



                                                                    </div>






                                                                </div>

                                                                <div class="col-sm-12">

                                                                    <a href="add_certificate.php" class="btn btn-primary btn-mat"><i class="icofont icofont-plus"></i>
                                                                        New certificate

                                                                    </a>

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
                                           
                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">
                                                <label for="physsical_address" class="label bg-primary"> Previous Year</label>
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


                                            


                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">

                                                <label for="physsical_address" class="label bg-primary"> Other Previous Year</label>
                                                    <select id="other_select_crop" name="other_select_crop" class="form-control" required="">
                                                        <option value="0">Select crop</option>
                                                        <option value="fallow" selected>Fallow</option>
                                                        <option value="maize">Maize</option>
                                                        <option value="G/nuts">Ground nuts </option>

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
                                                <label for="physsical_address" class="label bg-primary">Region</label>
                                                    <select id="select_region" name="select_region" class="form-control" required="">
                                                        <option value="0">Select Region</option>
                                                        <option value="central">Central Region</option>
                                                        <option value="northern">Northern Region</option>
                                                        <option value="southern">Southern Region</option>





                                                    </select>
                                                    <label id="warning_region" class="warning_text"> <span>Please select legion<i class="icofont icofont-warning"></i></span></label>
                                                </div>

                                                <div class="col-sm-3">
                                                <label for="physsical_address" class="label bg-primary">District</label>
                                                    <select id="select_district" name="select_district" class="form-control" required="">
                                                        <option value="0">Select District</option>






                                                    </select>
                                                    <label id="warning_district" class="warning_text"> <span>Please select district<i class="icofont icofont-warning"></i></span></label>
                                                </div>
                                                <div class="col-sm-3">
                                                    
                                                <label for="physsical_address" class="label bg-primary">EPA</label>
                                                    <input id="epa" type="text" class="form-control" name="epa" placeholder="EPA / Trading center " require="" value="<?php echo $epa?>">
                                                    <label id="warning_epa" class="warning_text"> <span>Please enter EPA / Area<i class="icofont icofont-warning"></i></span></label>



                                                </div>




                                            </div>

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">

                                                <label for="area_name" class="label bg-primary">Area Name</label>

                                                    <input id="area_name" type="text" class="form-control" name="area_name" placeholder="Area name / Estate" require="" value="<?php echo $area_name ?>">
                                                    <label id="warning_area_name" class="warning_text"> <span>Please enter area name<i class="icofont icofont-warning"></i></span></label>



                                                </div>

                                                




                                            </div>

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                               

                                                <div class="col-sm-12">

                                                <label for="address" class="label bg-primary"> Address</label>

                                                <textarea id="address" class="form-control" name="address"  name="" id="" cols="30" rows="3"><?php echo $address?></textarea>

                                                <label id="warning_address" class="warning_text"> <span>Please add directions <i class="icofont icofont-warning"></i></span></label>

                                                   



                                                </div>




                                            </div>

                                            <div class="form-group row">


                                                <span class="pcoded-mcaret"></span>


                                                <div class="col-sm-12">
                                                 
                                                <label for="physical_address" class="label bg-primary">Physical Address</label>
                                                <textarea id="physical_address" type="textarea" class="form-control" name="physical_address" placeholder="Directions " name="" id="" cols="30" rows="3"><?php echo $physical_address;?></textarea>

                                                  
                                                    <label id="warning_physical_address" class="warning_text"> <span>Please add directions <i class="icofont icofont-warning"></i></span></label>



                                                </div>







                                            </div>
                                            <div class="col-sm-12">



                                                <!-- <button type="submit" id="save_farm" value="save farm" class="btn btn-primary btn-mat ">save</button> -->
                                                <button class="btn btn-primary btn-mat" id="update_farm_details" ><i class="icofont icofont-save"></i>Save</button>

                                                </br>
                                                </br>

                                                <a href="register_farm.php" class="btn btn-danger btn-mat"><i class="icofont icofont-warning"></i>
                                                    Cancle

                                                </a>


                                            </div>




                                        </div>






                                    </div>




                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <div class="col-sm-4">
                                                            <label for="bin_card" id="approval_label"> Enter Admin Approval Code</label>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <input type="text" id="accessCode" class="form-control" name="accessCode" placeholder="Enter code" require="">
                                                            <div id="code_validity">


                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button class="btn btn-primary" id="checkCode"><i class='icofont icofont-upload-alt'></i>Submit</button>
                                                        </div>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <form action="admin_view_order_items.php" method="POST">
                                                <div class="card-header">
                                                    <h5>Registred Farm Details</h5>

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


                                                        <div class="col-sm-3">

                                                            <label class="label bg-primary "> Farm ID</label>
                                                            <input id="farm_id" type="text" class="form-control " name="farm_id" value="<?php echo $farm_id; ?>" require="">
                                                            <input type="hidden" id="request_id" value="<?php echo $user_id; ?>">
                                                            <input type="hidden" id="user_name" value="<?php echo $test; ?>">

                                                        </div>





                                                        <div class="col-sm-3">
                                                            <label class="label bg-primary ">Grower Name</label>
                                                            <input id="grower_name" type="text" class="form-control " name="grower_name" value="<?php echo $grower_name; ?>" require="">



                                                        </div>

                                                        <div class="col-sm-3">
                                                            <label class="label bg-primary ">Added By</label>
                                                            <input id="registered_by" type="text" class="form-control " name="registered_by" value="<?php echo $registered_by; ?>" require="">



                                                        </div>

                                                        <div class="col-sm-3">
                                                            <label class="label bg-primary "> Registered Date</label>
                                                            <input id="registered_date" type="text" class="form-control " name="registered_date" value="<?php echo $registered_date; ?>" require="">



                                                        </div>



                                                        <div class="card-block">


                                            </form>


                                            <form action="finance_csv_handler.php" method="POST">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">













                                                        <input type="hidden" name="customer_name" id="customer_name">
                                                        <input type="hidden" name="order_id" id="order_id">
                                                        <input type="hidden" name="approvalId" id="approvalId">

                                                        <input type="hidden" name="processed_value" id="processed_value" value="<?php echo $processed; ?>">
                                                        <input type="hidden" name="oustanding_value" id="outstanding_value" value="<?php echo $outstanding; ?>">







                                                        </select>

                                                    </div>

                                                </div>
                                            </form>




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h5>Details</h5>

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

                                    <div class="col-sm-4">
                                        <label class="label bg-primary">Crop :</label>

                                        <select class="form-control trans_details text-details" id="crop">
                                            <option value="<?php echo $cropId; ?>"><?php echo $crop; ?></option>

                                            <select>
                                                <input type="hidden" id="stockInId" value="<?php echo $stock_in_ID; ?>">
                                                <input type="hidden" id="creditorId" value="<?php echo $creditorId; ?>">
                                    </div>


                                    <div class="col-sm-4">
                                        <label class="label bg-primary">Variety:</label>

                                        <select class="form-control trans_details text-details" id="variety">
                                            <option value="<?php echo $varietyId; ?>"><?php echo $variety; ?></option>

                                            <select>

                                    </div>


                                    <div class="col-sm-4">
                                        <label class="label bg-primary">Class:</label>

                                        <select class="form-control trans_details text-details" id="class">
                                            <option value="<?php echo $class; ?>"><?php echo $class; ?></option>

                                            <select>

                                    </div>

                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-12">
                                        <label class="label bg-primary">Hectors:</label>
                                        <input type="text" class="form-control trans_details text-details" name="seedCertificate" id="seedCertificate" required="" value="<?php echo $hectors; ?>">
                                    </div>
                                </div>



                                <div class="form-group row">




                                    <div class="col-sm-6">
                                        <label class="label bg-primary">certificate Lot Number :</label>

                                        <select class="form-control trans_details text-details" id="variety">
                                            <option value="<?php echo $main_lot_number; ?>"><?php echo $main_lot_number; ?></option>

                                            <select>

                                    </div>


                                    <div class="col-sm-6">
                                        <label class="label bg-primary">assigned Quantity:</label>

                                        <select class="form-control trans_details text-details" id="class">
                                            <option value="<?php echo $main_quantity; ?>"><?php echo $main_quantity; ?></option>

                                            <select>

                                    </div>

                                </div>



                                <div class="form-group row">




                                    <div class="col-sm-6">

                                        <label class="label bg-primary">Male Lot Number :</label>
                                        <select class="form-control trans_details text-details" id="variety">
                                            <option value="<?php echo $male_lot_number; ?>"><?php echo $male_lot_number; ?></option>

                                            <select>

                                    </div>


                                    <div class="col-sm-6">
                                        <label class="label bg-primary">Assigned Quantity:</label>
                                        <select class="form-control trans_details text-details" id="class">
                                            <option value="<?php echo $male_quantity; ?>"><?php echo $male_quantity; ?></option>

                                            <select>

                                    </div>

                                </div>


                                <div class="form-group row">




                                    <div class="col-sm-6">

                                        <label class="label bg-primary">Female Lot Number:</label>
                                        <select class="form-control trans_details text-details" id="variety">
                                            <option value="<?php echo $female_lot_number; ?>"><?php echo $female_lot_number; ?></option>

                                            <select>

                                    </div>


                                    <div class="col-sm-6">

                                        <label class="label bg-primary">assigned Quantity:</label>
                                        <select class="form-control trans_details text-details" id="class">
                                            <option value="<?php echo $female_quantity; ?>"><?php echo $female_quantity; ?></option>

                                            <select>

                                    </div>

                                </div>






                                <div class="form-group row">

                                    <div class="col-sm-4">
                                        <label class="label bg-primary">Region:</label>
                                        <select class="form-control trans_details text-details" id="crop">

                                            <option value="<?php echo $cropId; ?>"><?php echo $region; ?></option>

                                            <select>
                                                <input type="hidden" id="stockInId" value="<?php echo $stock_in_ID; ?>">
                                                <input type="hidden" id="creditorId" value="<?php echo $creditorId; ?>">
                                    </div>


                                    <div class="col-sm-4">
                                        <label class="label bg-primary">District: </label>

                                        <select class="form-control trans_details text-details" id="variety">
                                            <option value="<?php echo $varietyId; ?>"><?php echo $district; ?></option>

                                            <select>

                                    </div>


                                    <div class="col-sm-4">
                                        <label class="label bg-primary">Area name:</label>

                                        <select class="form-control trans_details text-details" id="class">
                                            <option value="<?php echo $class; ?>"><?php echo $area_name; ?></option>

                                            <select>

                                    </div>

                                </div>


                                <div class="form-group row">

                                    <div class="col-sm-12">

                                        <label class="label bg-primary">Address:</label>
                                        <textarea class="form-control trans_details text-details" name="" id="address" cols="30" rows="3"><?php echo $address; ?>



                                        </textarea>

                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-12">

                                        <label class="label bg-primary">Physical Address:</label>
                                        <textarea class="form-control trans_details text-details" name="" id="address" cols="30" rows="3"><?php echo $physical_address; ?>



                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-12">
                                        <label class="label bg-primary">EPA:</label>
                                        <input type="text" class="form-control trans_details text-details" name="seedCertificate" id="seedCertificate" required="" value="<?php echo $epa; ?>">
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label class="label bg-primary ">land History (Previous year):</label>
                                        <input type="text" class="form-control trans_details text-details" name="dob" id="ogQuantity" required="" value="<?php echo $previous_year; ?>">
                                    </div>



                                    <div class="col-sm-6">
                                        <label class="label bg-primary ">land History (Other year):</label>
                                        <input type="text" class="form-control trans_details text-details" name="dob" id="dob" required="" value="<?php echo $other_year; ?>">
                                    </div>


                                </div>





                                <div class="form-group row">

                                    <div class="col-sm-3">
                                        <button class=" btn btn-primary btn-mat" id='back' data-toggle="modal" data-target="#myModal" name='back'><i class='icofont icofont-edit-alt'></i>Update</button>

                                        <button class=" btn btn-danger btn-mat" id='back' data-toggle="modal" data-target="#deleteModal" name='back'><i class='icofont icofont-trash'></i>Delete</button>
                                    </div>

                                </div>


                            </div>




                            <!-- Background Utilities table end -->
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