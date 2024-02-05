<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
session_start();


spl_autoload_register(function ($class) {
    if (file_exists('../class/LabTest/' . $class . '.php')) {
        require '../class/LabTest/' . $class . '.php';
    } elseif (file_exists('../class/' . $class . '.php')) {
        require   '../class/' . $class . '.php';
    }
});



$get_data = new GetLabTestData();
$test_row = $get_data->get_test_details($_GET["test_id"]);


$DB = new DbConnection();
$con = $DB->connect();



$test = $_SESSION['fullname'];
$position = $_SESSION['position'];

if (empty($test)) {
    header('Location:../login.php');
}

$restricted = array("production_admin", "system_administrator", "lab_technician");

if (in_array($position, $restricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
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
    <script type="text/javascript" src="assets/js/jsHandle/add_lab_test____.js"></script>

    <script type="text/javascript">

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


                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>

                        <a href="">
                            production
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
                                        <a href="auth-normal-sign-in.html">
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

                                        <li class="active">
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

                                <li class="">
                                    <a href="view_stock_out.php" class="waves-effect waves-dark">
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


                                <li>
                                    <a href="new_test.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-paint-bucket"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> New lab test </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="active">
                                    <a href="active_test.php" class="waves-effect waves-dark">


                                        <span class="pcoded-micon"><i class="ti-view-grid"></i><b>W</b></span>
                                        <span class="pcoded-mtext">Active lab test</span>
                                        <!-- <span class="pcoded-badge label label-info">6</span> -->
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
                                            <h5 class="m-b-10">Lab Test details </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="admin_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>

                                            <li class="breadcrumb-item"><a href="add_lab_test.php">New Lab Test</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="view_active_test.php">View Active Lab Test</a>
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

                                        ` <div class="card">
                                            <div class="card-header">
                                                <h5>Filter </h5>


                                            </div>
                                            <div class="card-block">




                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="label bg-success">Test Id</label>
                                                        <select name="select_crop" id="select_crop" class="form-control">
                                                            <option value="not_selected"><?php echo $test_row['test_ID'] ?></option>



                                                        </select>


                                                    </div>

                                                    <div class="col-sm-2">

                                                        <label class="label bg-success">Crop</label>
                                                        <select name="select_crop" id="select_crop" class="form-control">
                                                            <option value="not_selected"><?php echo $test_row['crop'] ?></option>



                                                        </select>




                                                    </div>

                                                    <div class="col-sm-2">

                                                        <label class="label bg-success">Variety</label>
                                                        <select name="select_variety" id="select_variety" class="form-control">
                                                            <option value="not_selected"><?php echo $test_row['variety'] ?></option>



                                                        </select>




                                                    </div>
                                                    <div class="col-sm-2">

                                                        <label class="label bg-success">Class</label>
                                                        <select name="select_class" id="select_class" class="form-control">
                                                            <option value="not_selected"><?php echo $test_row['class'] ?></option>


                                                        </select>




                                                    </div>

                                                    <div class="col-sm-2">

                                                        <label class="label bg-success">Quantity</label>
                                                        <select name="select_variety" id="select_variety" class="form-control">
                                                            <option value="not_selected"><?php echo $test_row['quantity'] ?></option>



                                                        </select>
                                                        </br>




                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label class="label bg-success">Test Date </label>
                                                        <select name="select_variety" id="select_variety" class="form-control">
                                                            <option value="not_selected"><?php echo Util::convert_date($test_row['date']) ?></option>



                                                        </select>

                                                    </div>

                                                    <div class="col-sm-12">
                                                        <label class="label bg-success">Grower /Creditor Name </label>
                                                        <input type="text" class="form-control" id="fromDateValue" name="fromDateValue" value="<?php echo $test_row['creditor'] ?>" require="">
                                                        </br>

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="label bg-success">Physical Address</Address></label>
                                                        <textarea class="form-control" id="farm_physical_address"><?php echo $test_row['physical_address']; ?>
                                                    </textarea>

                                                    </div>





                                                </div>


                                                
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">



                                                            <button class="btn btn-ifnobtn-mat " id='download_pdf_report'><i class="ti ti-receipt"></i> Download PDF</button>


                                                            <input type="hidden" name="creditor_hidden" id="creditor_hidden">
                                                            <input type="hidden" name="cropValueHidden" id="cropValueHidden">
                                                            <input type="hidden" name="varietyValueHidden" id="varietyValueHidden">
                                                            <input type="hidden" name="classValueHidden" id="classValueHidden">
                                                            <input type="hidden" name="from_hidden" id="from_hidden">
                                                            <input type="hidden" name="to_hidden" id="to_hidden">
                                                            <input type="hidden" name="filter" id="filter">
                                                            <input type="hidden" name="test_id"  value='<?php echo $_GET['test_id']?>' id="test_id">





                                                            </select>

                                                        </div>

                                                    </div>
                                                

                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Add test results </h5>


                                            </div>




                                            <div class="card-block">

                                                <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-lg">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h5 class="modal-title">Available Certificates </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-block table-border-style">
                                                                    <div class="table-responsive">


                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover" id="dataTable">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="font-weight: 600;">Lot number </th>

                                                                                        <th style="font-weight: 600;">Date tested</th>
                                                                                        <th style="font-weight: 600;">Expire Date</th>
                                                                                        <th style="font-weight: 600;">Added Date</th>
                                                                                        <th style="font-weight: 600;">Certificate Quantity</th>
                                                                                        <th style="font-weight: 600;">Available Quantity</th>
                                                                                        <th style="font-weight: 600;">Action</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    <?php
                                                                                    // SUM(assigned_quantity) AS total_graded,
                                                                                    $quantity = (float)$test_row['quantity'];
                                                                                    $crop = $test_row['crop_ID'];
                                                                                    $variety = $test_row['variety_ID'];
                                                                                    $source = $test_row['source'];
                                                                                    $class = $test_row['class'];
                                                                                    $date = date("y-m-d");
                                                                                    $test_id = $_GET['test_id'];
                                                                                    $stock_in_id =  $test_row['stock_in_ID'];


                                                                                    $sql = "SELECT `lot_number`, `crop`, `variety`, `class`, `type`, `source`, `date_tested`, `expiry_date`, `date_added`,
                                                                                    `certificate_quantity`, `available_quantity`, `assigned_quantity`,`directory`, `fullname` FROM `certificate`
                                                                                    INNER JOIN crop ON certificate.crop_ID = crop.crop_ID INNER JOIN variety ON certificate.variety_ID = variety.variety_ID 
                                                                                    INNER JOIN user ON user.user_ID = certificate.user_ID WHERE certificate.crop_ID = '$crop' AND  certificate.variety_ID = '$variety' AND certificate.class ='$class' AND
                                                                                     certificate.source = '$source' AND  `available_quantity` > $quantity AND `expiry_date` <= '$date'";
                                                                                    $result = $con->query($sql);
                                                                                    if ($result->num_rows > 0) {
                                                                                        while ($row = $result->fetch_assoc()) {
                                                                                            $lot_number = $row["lot_number"];
                                                                                            $crop      = $row["crop"];
                                                                                            $variety     = $row["variety"];
                                                                                            $class     = $row["class"];
                                                                                            $type  = $row["type"];
                                                                                            $source = $row['source'];
                                                                                            $date_tested = Util::convert_date($row['date_tested']);
                                                                                            $expire_date = Util::convert_date($row['expiry_date']);
                                                                                            $date_added = Util::convert_date($row['date_added']);
                                                                                            $dir = $row['directory'];
                                                                                            $certificate_quantity = $row['certificate_quantity'];
                                                                                            $available_quantity = $row['available_quantity'];






                                                                                            echo "
                                                                                               <tr class='odd gradeX'>
                                                                                                    <td>$lot_number</td>
                                                                                                  
                                                                                                   <td>$date_tested</td>
                                                                                                   <td>$expire_date</td>
                                                                                                   <td>$date_added</td>
                                                                                                   <td>$certificate_quantity</td>
                                                                                                   <td>$available_quantity</td>
                                                                                                 
                                                                                                   
                                                                                                   
                                                                                                   <td>
                                                                                                   <a href='lab_add_certificate.php? lot_number=$lot_number&quantity=$quantity&stock_in_id=$stock_in_id&test_id=$test_id'  class='ti-arrow-circle-right'></a>
                                                                                                  
                                                                                                  
                                                                                                   </td>
                                                                                               </tr>	
                                                                                           ";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>



                                                                        </div>
                                                                        <a href='add_certificate.php' class="btn btn-info"><i class= 'ti ti-receipt'></i> Add New certificate</a>
                                                                        <div id="pagination"></div>




                                                                    </div>
                                                                    <div id="pagination"></div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="badge badge-success">Germination (%) :</label>

                                                        <br />
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <input type="number" id="germination" class="form-control" name="germination" placeholder="-" value="<?php echo $test_row['germination_percentage']; ?>" require="">
                                                    </div>
                                                </div>








                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="badge badge-success">Shelling (%):</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="shelling" class="form-control" name="shelling" value="<?php echo $test_row['shelling_percentage']; ?>" placeholder="-" require="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="badge badge-success">Oil Content (%):</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="oil_content" class="form-control" name="oil_content" placeholder="-" require="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="badge badge-success">Moisture Content (%):</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="moisture_content" class="form-control" name="moisture_content" placeholder="-" require="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="badge badge-success">Purity (%):</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="purity" class="form-control" name="purity" placeholder="-" value="<?php echo $test_row['purity_percentage']; ?>" require="">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="badge badge-success">Defects (%) :</label>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="defects" class="form-control" name="defects" placeholder="-" value="<?php echo $test_row['defects_percentage']; ?>" require="">
                                                    </div>
                                                </div>








                                                <div class="form-group row">

                                                    <div class="col-sm-12">

                                                    </div class="form-group row" require="">






                                                    </br>


                                                    <div>

                                                    </div>

                                                    <br>
                                                    .
                                                    <div class="form-group">

                                                        <button name="" id="save" class="btn waves-effect waves-light btn-success btn-mat" data-toggle="modal" data-target="#myModal"> <i class="ti ti-plus"></i>Certify Seed </button>



                                                    </div>









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