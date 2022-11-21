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

$restricted = array("marketing_admin", "system_administrator", "marketing_officer");

if (in_array($position, $restricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}

$sql = "SELECT `farm_ID`, `Hectors`,crop.crop_ID,variety.variety_ID, `class`, 
`region`, `district`, `area_name`, `address`, `physical_address`, 
`EPA`,creditor.name, farm.registered_date, `previous_year_crop`, 
`other_year_crop`, `main_lot_number`, `main_quantity`, `male_lot_number`,
 `male_quantity`, `female_lot_number`, `female_quantity` FROM `farm`
  INNER JOIN crop ON farm.crop_species = crop.crop_ID INNER JOIN 
  variety ON farm.crop_variety = variety.variety_ID INNER JOIN creditor
  ON farm.creditor_ID = creditor.creditor_ID ";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $crop_ID = $row['crop_ID'];
        $variety_ID = $row['variety_ID'];
        $main_quantity = $row['main_quantity'];
        $male_quantity = $row['male_quantity'];
        $female_quantity = $row['female_quantity'];
        $class = $row['class'];
       

    }
}

if ($variety_ID=="VT003" || $variety_ID=="VT004" || $variety_ID=="VT004"){

    $main_quantity_ = "-";
    $male_quantity_ = $male_quantity;
    $female_quantity_ = $female_quantity;


}

else{
    $main_quantity_ = $main_quantity;
    $male_quantity_ = "-";
    $female_quantity_ ="-";

}


///Getting price



if($class=="certified"){

   $object = new main();
   $price = $object->grower_order_price($crop_ID,$variety_ID,$class);    
   $certificate_class="basic";
   

}

else if($class=="basic"){

    $object = new main();
    $price = $object->grower_order_price($crop_ID,$variety_ID,$class);   
    $certificate_class="prebasic";
   
}


  
?>



<head>
    <title>Mega Able bootstrap admin template by codedthemes </title>
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript">

$(document).ready(function() {
 const quntity = $("#certificate_quantity").val();
 const price = $("#price_per_kg").val();

 let total = quntity*price;

 $("#total_price").val(total);
    
});
       
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
                        <a href="index.html">
                            <span>Marketing</span>
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
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user"></h5>
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
                                <li class="active">
                                    <a href="grower_order.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-image"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Grower Order</span>
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
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-stats-up"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Transactions</span>
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
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-stats-up"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Transactions</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Payments</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="add_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Payment </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-list-ol"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Processed Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clip"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Outstanding Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>







                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Other</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>M</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Menu Levels</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Menu Level 2.1</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="pcoded-hasmenu ">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Menu Level 2.2</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Menu Level 3.1</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Menu Level 2.3</span>
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
                                            <h5 class="m-b-10">Place Order </h5>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Home</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Place Order</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="process_grower_order.php" method="POST">
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
                </div>
            </div>


            <!-- Basic Form Inputs card end -->
            <!-- Input Grid card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Grower order details</h5>


                </div>
                <div class="card-block">





                <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Crop :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="crop" class="form-control" name="crop" placeholder="Price per kg" require=""  value="<?php echo $_GET['crop'];?>">
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Variety :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="variety" class="form-control" name="variety" placeholder="Price per kg" require="" value="<?php echo $_GET['variety'];?>">
                        </div>
                    </div>


                <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Class :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="certificate_class" class="form-control" name="certificate_class" placeholder="certificate_class" require=""  value="<?php echo $certificate_class;?>">
                            <input type="hidden" name="creditor_id" value="<?php echo $_GET['creditor_id'];?>">
                            <input type="hidden" name="creditor_name" value="<?php echo $_GET['creditor_name'];?>">
                        </div>
                    </div>
                   
                    
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Certificate Quantity :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="certificate_quantity" class="form-control" name="certificate_quantity" placeholder="Price per kg" require=""  value="<?php echo $main_quantity_;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Male Certificate Quantity :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="male_quantity" class="form-control" name="male_quantity" placeholder="Price per kg" require="" value="<?php echo $male_quantity_;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Female Certificate Quantity:</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="female_quantity" class="form-control" name="female_quantity" placeholder="Price per kg" require="" value="<?php echo $female_quantity_;?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Price Per Kg :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="price_per_kg" class="form-control" name="price_per_kg" placeholder="Price per kg" require="" value="<?php echo $price;?>">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Enter Discount price:</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="discount_price" class="form-control" name="discount_price" placeholder="-" require="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Total Price :</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="total_price" id="total_price" placeholder="TOTAL PRICE">
                        </div class="form-group row" require="">



                        </br></br></br>


                        <div>

                        </div>

                        <br>
                        .
                        <div class="form-group">


                           
                            <input type="submit" name="place_order" value="place order" class="btn waves-effect waves-light btn-danger  btn-block" />

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


if (isset($_POST['place_order'])) {

    echo ("<script> alert('Key working !');
   </script>");


   $object = new main();
   $object ->grower_order($_POST['creditor_id'],$_POST['creditor_name'],
   $_POST['crop'],$_POST['variety'],$_POST['certificate_class'], $_POST['quantity'],
    $_POST['price_per_kg'],$_POST['discount_price'], $_POST['total_price']);
  

   




    // if ($_SESSION['type'] = "customer") {



    //     // since regular customer are registered when the user adds the first
    //     // item, the code here is trying to include the customer's id to the temp session list  

    //     $name = $_SESSION['customer_name'];




    //     $sql = "SELECT * FROM `debtor` WHERE `name` like '%$name%' AND `debtor_type`='customer'";
    //     $result = $con->query($sql);
    //     if ($result->num_rows > 0) {


    //         while ($row = $result->fetch_assoc()) {
    //             unset($_SESSION['customer_ID']);
    //             $_SESSION['customer_ID'] =  $row["debtor_ID"];

    //         }
    //     }
    //     $object = new main();
    //     $object->place_order();
    // } else {
    //     $object = new main();
    //     $object->place_order();

    //     echo ("<script> alert('not working !');
    //     </script>");
    // }
}

if (isset($_POST['add_item'])) {

    //checking if user has added customer details before adding items to order

    $debtor_type = "";

    if (!empty($_SESSION['order'])) {

        $debtor_type = $_SESSION['type'];
    } else {
        $debtor_type = $_POST['debtor_type'];
    }


    switch ($debtor_type) {

        case "agro_dealer":
             

            //checking if user has selected customer from the selected debtor type 
            if ($_POST['search_result'] == "not_selected" && empty($_SESSION['type'])) {


                

                echo ("<script> alert('please select agro dealer');
            </script>");
            } else {


                //checking if order is in progress by checking is the order session is empty 

                if (empty($_SESSION['order'])) {

                    $test =  $_POST['search_result'];
                    $data_result = explode(",", $test);

                    $object = new main();
                    $object->temp_data(
                        $data_result,
                        $_POST['order_book_number'],
                        $_POST['debtor_type'],
                        $_POST['crop'],
                        $_POST['variety'],
                        $_POST['class'],
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                } else {

                    $order = $_SESSION['order'];
                    $order_book = $_POST['order_book_number'];
                    $crop =  $_POST['crop'];
                    $variety = $_POST['variety'];
                    $class = $_POST['class'];

                    $object = new main();
                    $object->check_order_book_number($order, $order_book, $crop, $variety, $class, $_POST['quantity'], $_POST['price_per_kg'], $_POST['discount_price'], $_POST['total_price']);
                }
            }
            break;
        case "b_to_b":

            //checking if user has selected customer from the selected debtor type 
            if ($_POST['search_result'] == "not_selected" && empty($_SESSION['type'])) {

                echo ("<script> alert('Please select Business first');
            </script>");
            } else {


                //checking if order is in progress by checking is the order session is empty 

                if (empty($_SESSION['order'])) {

                    $test =  $_POST['search_result'];
                    $data_result = explode(",", $test);

                    $object = new main();
                    $object->temp_data(
                        $data_result,
                        $_POST['order_book_number'],
                        $_POST['debtor_type'],
                        $_POST['crop'],
                        $_POST['variety'],
                        $_POST['class'],
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                } else {

                    $order = $_SESSION['order'];
                    $order_book = $_POST['order_book_number'];
                    $crop =  $_POST['crop'];
                    $variety = $_POST['variety'];
                    $class = $_POST['class'];

                    $object = new main();
                    $object->check_order_book_number(
                        $order,
                        $order_book,
                        $crop,
                        $variety,
                        $class,
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                }
            }




            break;

        case "grower":

            //checking if user has selected customer from the selected debtor type 
            if ($_POST['search_result'] == "not_selected" && empty($_SESSION['type'])) {

                echo ("<script> alert('please select agro dealer');
            </script>");
            } else {


                //checking if order is in progress by checking is the order session is empty 

                if (empty($_SESSION['order'])) {

                    $test =  $_POST['search_result'];
                    $data_result = explode(",", $test);

                    $object = new main();
                    $object->temp_data(
                        $data_result,
                        $_POST['order_book_number'],
                        $_POST['debtor_type'],
                        $_POST['crop'],
                        $_POST['variety'],
                        $_POST['class'],
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                } else {

                    $order = $_SESSION['order'];
                    $order_book = $_POST['order_book_number'];
                    $crop =  $_POST['crop'];
                    $variety = $_POST['variety'];
                    $class = $_POST['class'];

                    $object = new main();
                    $object->check_order_book_number(
                        $order,
                        $order_book,
                        $crop,
                        $variety,
                        $class,
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                }
            }

            break;

        case "customer":



            if ($_POST['search_result'] == "not_selected" && empty($_SESSION['type'])) {


                //register customer (figure out how to get customer ID)

                $object = new main();
                $object->register_customer($_POST['customer_name'], $_POST['description']);
                $array_data[]  = "";
                $array_data[0] = "-";
                $array_data[1] = $_POST['description'];
                $array_data[2] = $_POST['customer_name'];

                $object->temp_data(
                    $array_data,
                    $_POST['order_book_number'],
                    $_POST['debtor_type'],
                    $_POST['crop'],
                    $_POST['variety'],
                    $_POST['class'],
                    $_POST['quantity'],
                    $_POST['price_per_kg'],
                    $_POST['discount_price'],
                    $_POST['total_price']
                );
            } else {


                //checking if order is in progress by checking is the order session is empty 

                if (empty($_SESSION['order'])) {

                    $test =  $_POST['search_result'];
                    $data_result = explode(",", $test);

                    $object = new main();
                    $object->temp_data(
                        $data_result,
                        $_POST['order_book_number'],
                        $_POST['debtor_type'],
                        $_POST['crop'],
                        $_POST['variety'],
                        $_POST['class'],
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                } else {

                    $order = $_SESSION['order'];
                    $order_book = $_POST['order_book_number'];
                    $crop =  $_POST['crop'];
                    $variety = $_POST['variety'];
                    $class = $_POST['class'];

                    $object = new main();
                    $object->check_order_book_number(
                        $order,
                        $order_book,
                        $crop,
                        $variety,
                        $class,
                        $_POST['quantity'],
                        $_POST['price_per_kg'],
                        $_POST['discount_price'],
                        $_POST['total_price']
                    );
                }
            }

            break;


        default:

            echo ("<script> alert('Please add customer details');
        </script>");;
    }
}





?>

</html>