<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$test = $_SESSION['fullname'];
$order_ID = $_GET['order_id'];
$trans_id = $_GET['trans_id'];
$debtor_id = $_GET['debtor_id'];
$trans_date = $_GET['trans_date'];
$trans_time = $_GET['trans_time'];
$trans_type = $_GET['trans_type'];
$trans_amount = $_GET['trans_amount'];
$trans_status = $_GET['status'];
if (empty($test)) {

    header('Location:../index.php');
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

            $('#cheque_number').prop("readonly", true);
            $('#cheque_file').prop('readonly', true);

            $('#select_payment_type').change(function() {




                let payment_type = $('#select_payment_type').val();

                if (payment_type === "Cheque") {
                    $('#cheque_number').prop("readonly", false);
                    $('#cheque_file').prop('readonly', false);
                    $('#bank_name').prop('readonly', true);
                    $('#account_name').prop('readonly', true);
                } else if (payment_type === "Bank_transfer") {
                    $('#bank_name').prop('readonly', false);
                    $('#account_name').prop('readonly', false);
                    $('#cheque_number').prop("readonly", true);
                    $('#cheque_file').prop('readonly', false);

                } else if (payment_type === "Cash") {

                    $('#bank_name').prop('readonly', true);
                    $('#account_name').prop('readonly', true);
                    $('#cheque_number').prop("readonly", true);
                    $('#cheque_file').prop('readonly', true);
                }


                // var crop_data = $('#select_crop').val();
                // var variety_data = $('#select_variety').val();
                // var class_data = $('#select_class').val();

                // if (crop_data == 0) {

                //     alert('Select crop and variety');


                // } else if (variety_data == 0) {

                //     alert('Select crop and variety');

                // } else {

                //     $.post('get_prices.php', {
                //         crop_data: crop_data,
                //         variety_data: variety_data,
                //         class_data: class_data
                //     }, function(data) {

                //         $('#price_per_kg').val(data);

                //     });
                // }




            });


            $('#debtor_type').change(function() {

                var type_value = $('#debtor_type').val();

                if (type_value == 'agro_dealer') {

                    $('#customer_name').attr('placeholder', 'Search agro dealer by name');
                    $('#description').attr('placeholder', 'agro dealer phone');


                } else if (type_value == 'b_to_b') {

                    $('#customer_name').attr('placeholder', 'Search Business by name');
                    $('#description').attr('placeholder', 'Business description');



                } else if (type_value == 'customer') {

                    $('#customer_name').attr('placeholder', 'Enter customer name');
                    $('#description').attr('placeholder', 'Enter customer phone number ');


                } else if (type_value == 'grower') {

                    $('#customer_name').attr('placeholder', 'Search grower by name');
                    $('#description').attr('placeholder', 'grower farm crop and variety ');


                }



                $("#search_main_certificate").on("input", function() {


                    var main_certificate_value = $('#search_main_certificate').val();
                    var main_quantity_value = $('#main_quantity').val();
                    var crop_value = $('#select_crop').val();
                    var variety_value = $('#select_variety').val();
                    var class_result = $('#select_class').val();


                    $.post('farm_get_certificate.php', {
                        main_certificate_value: main_certificate_value,
                        main_quantity_value: main_quantity_value,
                        crop_value: crop_value,
                        variety_value: variety_value,
                        class_value: class_value
                    }, function(data) {
                        $('#main_certificate').html(data);


                    })

                });








            });

            $('#customer_name').on("input", function() {


                let type_value = $('#debtor_type').val();
                let search_value = $('#customer_name').val();
                let search_result = $('#search_result').val();

                if (type_value == "type_not_selected") {

                    alert('please select order type');
                } else if (type_value == "agro_dealer") {

                    $.post('get_data.php', {
                        type_value: type_value,
                        search_value: search_value,

                    }, function(data) {
                        $('#search_result').html(data);
                        // $('#description').attr('value',$('#search_result').val() + '  ( Agro_dealer phone number )');

                        var data = $('#search_result').val();
                        var test = data.split(',');

                        $('#description').attr('value', test[1]);


                    });

                    $.post('get_transactions.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,
                    }, data => {
                        $('#transaction_table').html(data);
                    });




                } else if (type_value == "b_to_b") {

                    $.post('get_data.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,

                    }, function(data) {
                        $('#search_result').html(data);
                        // $('#description').attr('value',$('#search_result').val() + '  ( Business description )');

                        var data = $('#search_result').val();
                        var test = data.split(',');

                        $('#description').attr('value', test[1] + ' ( Businesss description )');

                    });

                    $.post('get_transactions.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,
                    }, data => {
                        $('#transaction_table').html(data);
                    });




                } else if (type_value == "customer") {


                    $.post('get_data.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,

                    }, function(data) {
                        $('#search_result').html(data);
                        // $('#description').attr('value',$('#search_result').val() + '  ( Business description )');

                        var data = $('#search_result').val();
                        var test = data.split(',');
                        var temp_data = "-";


                        if (test == null) {

                            temp_data = "enter -"
                        } else {

                            temp_data = test[1];
                        }


                        $('#description').attr('placeholder', temp_data + ' (customer phone number) ');


                    });

                    $.post('get_transactions.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,
                    }, data => {
                        $('#transaction_table').html(data);
                    })







                } else if (type_value == "grower") {


                    $.post('get_data.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,

                    }, function(data) {
                        $('#search_result').html(data);
                        // $('#description').attr('value',$('#search_result').val() + '  ( Business description )');

                        var data = $('#search_result').val();
                        var test = data.split(',');

                        $('#description').attr('value', test[1] + ' ( grower phone number )');

                    })

                    $.post('get_transactions.php', {
                        type_value: type_value,
                        search_value: search_value,
                        search_result: search_result,
                    }, data => {
                        $('#transaction_table').html(data);
                    });


                }

            });

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
                            <span>Finance</span>
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
                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Debtor Payments</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="active">
                                    <a href="add_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Payment </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="debtor_processed_payment.php" class="waves-effect waves-dark">
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

                                <li class="pcoded-hasmenu">
                                    <a href="debtor_accounts.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-stats-up"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Debtor accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Creditor payback</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="add_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Payback Payment </span>
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
                                    <a href="debtor_outstanding_payments.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clip"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Outstanding Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="">
                                    <a href="creditors.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Creditor accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>









                            </ul>
                            </li>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Finacial Statemets</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="bank_account.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-credit-card"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Bank accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="add_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> statements</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="finance_ledger.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-list-ol"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Ledger</span>
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
                                            <h5 class="m-b-10">Add payment </h5>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Home</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Payment</a>
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


                                       

                                        <div class="card">

                                        <form action="view_transaction_details.php" method="POST" enctype="multipart/form-data">
                                                <div class="card-header">
                                                    <h5>Transaction details</h5>

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
                                                            <label class="badge badge-primary ">Transaction ID</label>
                                                            <select class="form-control" name="trans_id">
                                                                <option value="<?php echo $trans_id; ?>"><?php echo $trans_id; ?></option>
                                                            </select>



                                                        </div>

                                                        


                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary "> Type</label>
                                                            <select class="form-control" name="trans_type">
                                                                <option value="<?php echo $trans_type; ?>"><?php echo $trans_type; ?></option>
                                                            </select>



                                                        </div>




                                                        <div class="col-sm-2">

                                                            <label class="badge badge-primary ">Amount</label>
                                                            <select class="form-control" name="trans_amount">
                                                                <option value="<?php echo $trans_amount; ?>"><?php echo $trans_amount; ?> </option>
                                                            </select>



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary ">Date</label>
                                                            <select class="form-control" name="trans_date">

                                                                <option value="<?php echo $trans_status; ?>"><?php echo $trans_date; ?></option>
                                                            </select>



                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary ">Time</label>
                                                            <select class="form-control" name="trans_time">
                                                                <option value="<?php echo $trans_time; ?>"><?php echo $trans_time; ?></option>
                                                            </select>



                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label class="badge badge-primary ">Debtor ID</label>
                                                            <select class="form-control" name="debtor_id">
                                                                <option value="<?php echo $debtor_id; ?>"><?php echo $debtor_id; ?></option>
                                                            </select>



                                                        </div>







                                                    </div>




                                                </div>
                                           

                                            
                                        </div>

                                        <div class="card">
                                            
                                            <div class="card-header">
                                                <h5>Add Payment Details</h5>


                                            </div>

                                            <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-lg">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h5 class="modal-title">Save Payment</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                               




                                                                    <div class="form-group row">

                                                                        <div class="col-sm-3">
                                                                            <button class="btn btn-primary" name="print_save_payment"> Save & Print Receipt</button>
                                                                        </div>


                                                                    </div>


                                                                    <div class="form-group row">

                                                                        <div class="col-sm-3">
                                                                            <button class="btn btn-success" name = "save_payment"> Save Only</button>
                                                                        </div>


                                                                    </div>



                                                                   



                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <div class="card-block">


                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <select id="select_payment_type" name="select_payment_type" class="form-control" required="">
                                                            <option value="type_not_selected">Select Payment Type</option>

                                                            <option value="Cash">Cash</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Bank_transfer">Bank transfer</option>



                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <select id="bank_account_name" name="bank_account_name" class="form-control" required="">
                                                            <option value="type_not_selected">Select Company Bank Account</option>

                                                           
                                <?php
                                $sql = "SELECT * FROM bank_account";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {

                                  
                                  while ($row = $result->fetch_assoc()) {
                                       $name = $row["bank_name"];
                                       $bank_id = $row["bank_ID"];
                                    echo"<option value='$bank_id'>$name</option>";
                                  }
                                }

                                if ($value=1){

                                  
                                }
                              

                                ?>



                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount (MK)" require="">



                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="cheque_number" name="cheque_number" placeholder="Cheque number " require="">



                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank name" require="">



                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account name" require="">



                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="description" name="description" placeholder="Description (Optional)" require="">



                                                        </select>
                                                    </div>

                                                </div>





                                                <div class="form-group row">

                                                    <div class="col-sm-12"><label>Upload scanned cheque file / Other supporting documents</label></div>
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control" id="cheque_file" name="image" placeholder=" " require="">

                                                    </div>

                                                </div>



                                                <input type="button"  data-toggle="modal" data-target="#myModal" value="save payment"class="btn btn-success">
                                                <input type="submit" name="back" value="back" class="btn btn-primary">

                                            </div>

                                        </div>

                                        <div class="card">
                                            <div class="card-header">

                                                <?php
                                                $sql = "SELECT sum(amount) as total_amount FROM `payment`WHERE transaction_Id ='$trans_id'";
                                                $result = $con->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {

                                                        $total_payment_amount = $row["total_amount"];
                                                    }
                                                    $balance =   $trans_amount - $total_payment_amount;
                                                }
                                                ?>
                                                <h5>Previous Payments <span>Balance: MK <?php echo $balance; ?> </span></h5>


                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive" id="table_test">
                                                    <table class="table" id="transaction_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Payment_ID</th>
                                                                <th>Amount</th>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>Type</th>
                                                                <th>Added by</th>
                                                                <th>Action</th>




                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php




                                                            $order_id = $_GET['order_id'];

                                                            $sql = "SELECT `payment_ID`, payment.type, `amount`, `description`,payment.date, payment.time,`transaction_ID`, user.fullname
                                                                                 FROM `payment` INNER JOIN user ON user.user_ID = payment.user_ID  WHERE `transaction_ID`='$trans_id'";



                                                            $result = $con->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $payment_ID = $row["payment_ID"];
                                                                    $amount   = $row["amount"];
                                                                    $type = $row["type"];
                                                                    $date = $row["date"];
                                                                    $time = $row["time"];
                                                                    $added_by = $row["fullname"];



                                                                    echo "
                                                   <tr class='odd gradeX'>
                                                       <td>$payment_ID</td>
                                                       <td>$amount</td>
                                                       <td>$date</td>
                                                       <td>$time</td>
                                                       <td>$type</td>
                                                       <td>$added_by</td>
                                                       <td><a href='view_transaction_details.php?'  class='btn btn-success'>View</a></td>
                                                       
                                                         
                                                       
                                                        
                                                   </tr>	
                                               ";
                                                                }
                                                            }



                                                            ?>
                                                            <tr>
                                                                <th scope="row">-</th>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>


                                                            </tr>

                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Transaction item list</h5>
                                                        <div class="card-block table-border-style">
                                                            <div class="table-responsive" id="table_test">
                                                                <table class="table" id="transaction_table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Item_ID</th>
                                                                            <th>Crop</th>
                                                                            <th>Variety</th>
                                                                            <th>Class</th>

                                                                            <th>Quantity</th>
                                                                            <th>Price per kg</th>
                                                                            <th>Discount</th>
                                                                            <th>amount</th>


                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php




                                                                        $order_id = $_GET['order_id'];

                                                                        $sql = "SELECT `item_ID`, `crop`, `variety`, `class`, `quantity`,`price_per_kg`,`discount_price`,`total_price` FROM
                                                                                `item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID WHERE order_ID = '$order_id'";



                                                                        $result = $con->query($sql);
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                $item_ID = $row["item_ID"];
                                                                                $crop   = $row["crop"];
                                                                                $variety = $row["variety"];
                                                                                $class = $row["class"];
                                                                                $quantity = $row['quantity'];
                                                                                $price = $row['price_per_kg'];
                                                                                $discount = $row['discount_price'];
                                                                                $total_price = $row['total_price'];




                                                                                echo "
                                                   <tr class='odd gradeX'>
                                                       <td>$item_ID</td>
                                                       <td>$crop</td>
                                                       <td>$variety</td>
                                                       <td>$class</td>
                                                       <td>$quantity</td>
                                                       <td>$price</td>
                                                       <td>$discount</td>
                                                       <td>$total_price</td>
                                                    
                                                         
                                                       
                                                       
                                                   </tr>	
                                               ";
                                                                            }
                                                                        }



                                                                        ?>
                                                                        <tr>
                                                                            <th scope="row">-</th>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td>-</td>


                                                                        </tr>

                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                                </form>



                                            </div>
                                        </div>
                                    </div>


                                    <!-- Basic Form Inputs card end -->
                                    <!-- Input Grid card start -->

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

    if ($_SESSION['type'] = "customer") {



        // since reguler customer are registered when the user adds the first
        // item, the code here is trying to include the customer's id to the temp session list  

        $name = $_SESSION['customer_name'];

        echo ("<script> alert('$name !');
        </script>");


        $sql = "SELECT * FROM `debtor` WHERE `name` like '%$name%' AND `debtor_type`='customer'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {


            while ($row = $result->fetch_assoc()) {
                unset($_SESSION['customer_ID']);
                $_SESSION['customer_ID'] =  $row["debtor_ID"];
            }
        }
        $object = new main();
        $object->place_order();
    } else {
        $object = new main();
        $object->place_order();

        echo ("<script> alert('not working !');
        </script>");
    }
}




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
        $errors[] = "extension not allowed, please choose pdf.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "documents/" . $newfilename);
        echo "Success";
    } else {
        print_r($errors);
    }
}


if (isset($_POST['print_save_payment'])) {

   

    // $_POST[trans_date] is used to get the transaction payment
    $uploaded_file = $newfilename;
    $save_type="save_n_print";
    

    if ($_POST['select_payment_type'] == "Cheque") {


        $object = new main;
        $object->add_debtor_payment(
            $_POST['select_payment_type'],
            $_POST['amount'],
            $uploaded_file,
            $_SESSION['user'],
            $_POST['trans_id'],
            $_POST['debtor_id'],
            $_POST['trans_amount'],
            $_POST['trans_date'],
            $_POST['cheque_number'],
            '-',
            '-',
            $_POST['description'],
            $save_type,
            $_POST['bank_account_name']
        );
    }
    if ($_POST['select_payment_type'] == "Cash") {




        $object = new main;
        $object->add_debtor_payment(
            $_POST['select_payment_type'],
            $_POST['amount'],
            '-',
            $_SESSION['user'],
            $_POST['trans_id'],
            $_POST['debtor_id'],
            $_POST['trans_amount'],
            $_POST['trans_date'],
            '-',
            '-',
            '-',
            $_POST['description']
            ,
            $save_type,
            $_POST['bank_account_name']
            
        );
    }
    if ($_POST['select_payment_type'] == "Bank_transfer") {


        $object = new main;
        $object->add_debtor_payment(
            $_POST['select_payment_type'],
            $_POST['amount'],
            '-',
            $_SESSION['user'],
            $_POST['trans_id'],
            $_POST['debtor_id'],
            $_POST['trans_amount'],
            $_POST['trans_date'],
            '-',
            '-',
            '-',
            $_POST['description']
            ,
            $save_type, 
            $_POST['bank_account_name']
            
        );
    }
}

if(isset($_POST['save_payment'])){
      // $_POST[trans_date] is used to get the transaction payment
      $uploaded_file = $newfilename;
      $save_type="save";
      
  
      if ($_POST['select_payment_type'] == "Cheque") {
  
  
          $object = new main;
          $object->add_debtor_payment(
              $_POST['select_payment_type'],
              $_POST['amount'],
              $uploaded_file,
              $_SESSION['user'],
              $_POST['trans_id'],
              $_POST['debtor_id'],
              $_POST['trans_amount'],
              $_POST['trans_date'],
              $_POST['cheque_number'],
              '-',
              '-',
              $_POST['description'],
              $save_type,
              $_POST['bank_account_name']
          );
      }
      if ($_POST['select_payment_type'] == "Cash") {
  
  
  
  
          $object = new main;
          $object->add_debtor_payment(
              $_POST['select_payment_type'],
              $_POST['amount'],
              '-',
              $_SESSION['user'],
              $_POST['trans_id'],
              $_POST['debtor_id'],
              $_POST['trans_amount'],
              $_POST['trans_date'],
              '-',
              '-',
              '-',
              $_POST['description']
              ,
              $save_type,
              $_POST['bank_account_name']
          );
      }
      if ($_POST['select_payment_type'] == "Bank_transfer") {
  
  
          $object = new main;
          $object->add_debtor_payment(
              $_POST['select_payment_type'],
              $_POST['amount'],
              '-',
              $_SESSION['user'],
              $_POST['trans_id'],
              $_POST['debtor_id'],
              $_POST['trans_amount'],
              $_POST['trans_date'],
              '-',
              '-',
              '-',
              $_POST['description']
              ,
              $save_type,
              $_POST['bank_account_name']
              
          );
      }
}





?>

</html>