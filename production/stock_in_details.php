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


$notRestricted = array("production_admin", "system_administrator", "merl_officer", "warehouse_officer");

if (in_array($position, $notRestricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}
$stock_in_ID = $_GET["stock_in_id"];

if (!empty($stock_in_ID)) {



    $sql = "SELECT `stock_in_ID`, `certificate_ID`, `farm_ID`,creditor.name, user.fullname,
    stock_in.creditor_ID, stock_in.source,stock_in.crop_ID,stock_in.variety_ID,stock_in.certificate_ID, `crop`, stock_in.status, 
    `variety`, `class`, `SLN`, `bincard`, 
    `number_of_bags`, `quantity`, `used_quantity`,
     `available_quantity`, `processed_quantity`, 
     `grade_outs_quantity`, `trash_quantity`, 
     stock_in.description, `supporting_dir`, `date`, `time` FROM `stock_in` INNER JOIN `creditor` ON
      stock_in.creditor_ID = creditor.creditor_ID INNER JOIN user ON user.user_ID = stock_in.user_ID INNER JOIN crop ON 
      crop.crop_ID = stock_in.crop_ID INNER JOIN variety ON variety.variety_ID = stock_in.variety_ID WHERE `stock_in_ID`='$stock_in_ID'";


    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $crop = $row["crop"];
            $cropId = $row["crop_ID"];
            $varietyId = $row["variety_ID"];
            $variety = $row["variety"];
            $class = $row["class"];
            $seedCertificate = $row["certificate_ID"];
            $SRN = $row["SLN"];
            $bincard = $row["bincard"];
            $bags = $row["number_of_bags"];
            $quantity = $row["quantity"];
            $creditor = $row["name"];
            $creditorId = $row["creditor_ID"];
            $source = $row["source"];
            $user_requested = $row["fullname"];
            $date = $row["date"];
            $time = $row["time"];
            $description = $row["description"];
            $dir =  $row["supporting_dir"];
        }
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
    <link rel="stylesheet" type="text/css" href="assets/css/style_.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jsHandle/stock_in_details_.js">

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
                                <li class="active">
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
                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Grower</div>
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
                                            <h5 class="m-b-10">Stock in</h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="production_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>

                                            <li class="breadcrumb-item"><a href="view_stock_in.php">View Stock In</a>
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

                                                            <button class="btn btn-success" id="delete_request" name="delete_request"> Request for approval</button>


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
                                                            <button class="btn btn-success btn-mat" id="checkCodeDelete"><i class='icofont icofont-upload-alt'></i>Submit</button>
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
                                                        <h5 class="modal-title">Update stock in details </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="agro_dealer.php" method="POST" enctype="multipart/form-data">

                                                            <div class="card-block">






                                                                <div class="form-group row seed_details">
                                                                    <div class="col-sm-12">
                                                                        <select id="select_crop" name="crop" class="form-control" required="">
                                                                            <option value="0">Select Crop</option>





                                                                        </select>
                                                                    </div>


                                                                </div>

                                                                <div class="form-group row seed_details">
                                                                    <div class="col-sm-12">
                                                                        <select id="select_variety" name="variety" class="form-control" required="">
                                                                            <option value="0">Select Variety</option>



                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group row seed_details">
                                                                    <div class="col-sm-12">
                                                                        <select id="select_class" name="select_class" class="form-control" required="">
                                                                            <option value="0">Select class</option>
                                                                            <option value="basic">Basic</option>
                                                                            <option value="pre_basic">Pre-Basic</option>
                                                                            <option value="certified">Certified</option>

                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <div class="col-sm-4">
                                                                        <label>Quantity:</label>
                                                                    </div>

                                                                    <div class="col-sm-12">

                                                                        <input id="quantity" type="number" class="form-control" name="external_quantity" placeholder="Enter Quantity" require="" value="<?php echo $quantity; ?>">





                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label id="warning_certificate"> <span>Crop details changed. Please upload new Seed Certificate <i class="icofont icofont-warning"></i></span></label>
                                                                    </div>

                                                                </div>


                                                                <div class="form-group row">


                                                                    <span class="pcoded-mcaret"></span>


                                                                    <div class="col-sm-6">

                                                                        <select id="certificate" name="certificate" class="form-control" required="">
                                                                            <option value="<?php echo $seedCertificate; ?>"><?php echo $seedCertificate; ?></option>
                                                                            






                                                                        </select>

                                                                    </div>

                                                                    <div class="col-sm-6">

                                                                        <input id="search_certificate" type="text" class="form-control" name="search_certificate" placeholder="Search certificate" require="">



                                                                    </div>


                                                                </div>


                                                                <div class="form-group row">

                                                                    <div class="col-sm-12">

                                                                        <a href="add_certificate.php" class="btn btn-success btn-mat"><i class='icofont icofont-edit-alt'></i>
                                                                            New certificate

                                                                        </a>

                                                                    </div>


                                                                </div>


                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label>Description:</label>
                                                                </div>

                                                                <div class="col-sm-12">
                                                                    <input id="description" type="text" class="form-control" name="description" placeholder="description" require="" value="<?php echo $description; ?>">
                                                                    <label id="warning_description" class="warning-text"> <span>Please enter description <i class="icofont icofont-warning"></i></span></label>
                                                                </div>


                                                            </div>








                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label>Seed Receive Note #:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="number" id="srn" class="form-control" name="srn" placeholder="-" require="" value="<?php echo $SRN; ?>">
                                                                    <label id="warning_srn" class="warning-text"> <span>Please enter SRN <i class="icofont icofont-warning"></i></span></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label>Bin card #:</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="number" id="bin_card" class="form-control" name="bin_card" placeholder="-" require="" value="<?php echo $bincard; ?>">
                                                                    <label id="warning_bin_card" class="warning-text"> <span>Please enter bin card number <i class="icofont icofont-warning"></i></span></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label>number of bags :</label>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <input type="number" id="number_of_bags" class="form-control" name="number_of_bags" placeholder="-" require="" value="<?php echo $bags; ?>">
                                                                    <label id="warning_bags" class="warning-text"> <span>Please enter number of bags <i class="icofont icofont-warning"></i></span></label>
                                                                </div>
                                                            </div>





                                                            <div class="form-group row">

                                                                <div class="col-sm-12">
                                                                    <labe>Supporting documents :</label>
                                                                        <input id="fileDirectory" type="file" class="form-control" name="fileDirectory" accept="pdf">
                                                                        <input id="directory" type="hidden" class="form-control" name="image" placeholder="Phone number" value="<?php echo "$dir" ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="#" class="btn btn-success" id="request_approval" name="request_approval"><i class='icofont icofont-save'></i>save</a>
                                                                </div>

                                                            </div>



                                                        </form>
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
                                                            <button class="btn btn-success btn-mat" id="checkCode"><i class='icofont icofont-upload-alt'></i>Submit</button>
                                                        </div>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <form action="admin_view_order_items.php" method="POST">
                                                <div class="card-header">
                                                    <h5>Transaction Details</h5>

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

                                                            <label class="label bg-success "> ID</label>
                                                            <input id="stock_in_id" type="text" class="form-control " name="stock_in_id" value="<?php echo $stock_in_ID; ?>" require="">
                                                            <input type="hidden" id="request_id" value="<?php echo $user_id; ?>">
                                                            <input type="hidden" id="user_name" value="<?php echo $test; ?>">

                                                        </div>





                                                        <div class="col-sm-3">
                                                            <label class="label bg-success ">Transaction For</label>
                                                            <input id="customer_name" type="text" class="form-control " name="customer_name" value="<?php echo $creditor; ?>" require="">



                                                        </div>

                                                        <div class="col-sm-3">
                                                            <label class="label bg-success ">Added By</label>
                                                            <input id="requested_user" type="text" class="form-control " name="requested_user" value="<?php echo $user_requested; ?>" require="">



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="label bg-success "> Date</label>
                                                            <input id="search_main_certificate" type="text" class="form-control " name="search_main_certificate" value="<?php echo main::change_date_format($date); ?>" require="">



                                                        </div>

                                                        <div class="col-sm-2">

                                                            <label class="label bg-success ">Time</label>
                                                            <input id="time" type="text" class="form-control " name="time" value="<?php echo $time; ?>" require="">



                                                        </div>

                                                        <div class="card-block">


                                            </form>


                                            <form action="finance_csv_handler.php" method="POST">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">










                                                        <a href="../files/production/stock_in_documents/<?php echo "$dir" ?>" class="btn btn-success btn-mat"><i class='icofont icofont-file-alt'></i> View Documents</a>



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
                                    <label class="label bg-success">Crop:</label>
                                        <select class="form-control trans_details " id="crop">
                                            <option value="<?php echo $cropId; ?>"><?php echo $crop; ?></option>
                                      
                                            <select>
                                                <input type="hidden" id="stockInId" value="<?php echo $stock_in_ID; ?>">
                                                <input type="hidden" id="creditorId" value="<?php echo $creditorId; ?>">
                                    </div>

                                    
                                    <div class="col-sm-4">
                                    <label class="label bg-success">Variety:</label>
                                        <select class="form-control trans_details " id="variety">
                                            <option value="<?php echo $varietyId; ?>"><?php echo $variety; ?></option>

                                            <select>

                                    </div>

                                   
                                    <div class="col-sm-4">
                                    <label class="label bg-success">Class:</label>
                                        <select class="form-control trans_details " id="class">
                                            <option value="<?php echo $class; ?>"><?php echo $class; ?></option>

                                            <select>

                                    </div>

                                </div>




                                <div class="form-group row">
                                    
                                    <div class="col-sm-4"> 
                                    <label class="label bg-success ">Quantity (Kgs):</label>
                                        <input type="text" class="form-control trans_details " name="dob" id="ogQuantity" required="" value="<?php echo $quantity; ?>">
                                    </div>


                                   
                                    <div class="col-sm-4">
                                    <label class="label bg-success ">Seed Receive Note #:</label>
                                        <input type="text" class="form-control trans_details " name="dob" id="dob" required="" value="<?php echo $SRN; ?>">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                    <label class="label bg-success ">Number of Bags:</label>
                                        <input type="text" class="form-control trans_details " name="dob" id="dob" required="" value="<?php echo $bags; ?>">
                                    </div>

                                </div>



                                <div class="form-group row">
                                   
                                    <div class="col-sm-12">
                                    <label class="label bg-success">certificate:</label>
                                        <input type="text" class="form-control trans_details " name="seedCertificate" id="seedCertificate" required="" value="<?php echo $seedCertificate; ?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    
                                    <div class="col-sm-12">
                                    <label class="label bg-success">Bin Card #:</label>
                                        <input type="text" class="form-control trans_details " name="fullname" required="" value="<?php echo $bincard; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-sm-12">
                                    <label class="label bg-success ">Seed Source:</label>
                                        <input type="text" class="form-control trans_details " name="seed_source" id="seed_source" required="" value="<?php echo $source; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                   
                                    <div class="col-sm-12">
                                    <label class="label bg-success ">Processing status:</label>
                                        <input type="text" class="form-control trans_details " name="dob" id="dob" required="" value="<?php echo $bags; ?>">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    
                                    <div class="col-sm-12">
                                    <label class="label bg-success ">Description:</label>
                                        <input type="text" class="form-control trans_details " name="dob" id="dob" required="" value="<?php echo $description; ?>">
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <div class="col-sm-2">
                                        <button class=" btn btn-success btn-mat" id='back' data-toggle="modal" data-target="#myModal" name='back'><i class='icofont icofont-edit-alt'></i>Update</button>
                               
                                   
                                        <button class=" btn btn-danger" id='back' data-toggle="modal" data-target="#deleteModal" name='back'><i class='icofont icofont-trash'></i>Delete</button>
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