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

$restricted = array("system_administrator", "finance_admin", "cashier");

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
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- am chart export.css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style_.css">
</head>

<body>

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {

            // var data_value = "admin_stock_out_chart";
            Stock_bar_chart();
            stock_pie_chart();
            seed_stock();
            // $.post('', {
            //     admin_stock_out_value : data_value;
            // }, function(data) {
            //     $('#stock_out_chart').html(data);





            // });




            // $('#get_data').click(() => {




            //     let fromDateValue = $('#fromDateValue').val();
            //     let toDateValue = $('#toDateValue').val();
            //     let typeValue = $('#typeValue').val();
            //     let bankAccount = $('#select_bank_name').val();


            //     $.post('../finance/get_creditors.php', {
            //         fromDateValue: fromDateValue,
            //         toDateValue: toDateValue,
            //         typeValue: typeValue,
            //         bankAccount: bankAccount   
            //     }, data => {
            //         $('#ledger_table').html(data);

            //     });


            // });




            var data_value = "bank";

            $.post('../finance/get_creditors.php', {
                data_value: data_value
            }, function(data) {
                $('#select_bank_name').html(data);


            });


        });


        function Stock_bar_chart() {

            <?php
            $sql = "SELECT DATE_FORMAT(stock_in.date, '%M') AS month_name, SUM(stock_in.available_quantity) AS quantity FROM stock_in INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID GROUP BY stock_in.month_name";

            ?>


            const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Stock out Quantity For 2022',
                    backgroundColor: [
                        'rgba(41, 173, 72, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)',
                        // 'rgba(255, 205, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(201, 203, 207, 0.2)',
                        // 'rgba(45, 189, 79, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)',
                        // 'rgba(255, 205, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(201, 203, 207, 0.2)',

                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(45, 189, 79,)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',

                    ],
                    borderWidth: 1,

                    data: [70, 10, 5, 2, 20, 30, 30, 5, 10, 5, 2, 20, 3, 45],
                }]
            };

            const config = {
                type: 'line',
                data: data,
            };
            const myChart = new Chart(
                document.getElementById('stock_out_chart'),
                config
            );

        }


        function stock_pie_chart() {


            <?php

            $sql = "SELECT stock_in.status, SUM(stock_in.available_quantity) AS quantity FROM stock_in INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID GROUP BY stock_in.status;";
            $result = mysqli_query($con, $sql);

            $result = $con->query($sql);
            foreach ($result as $row) {
                $labels[] = $row['status'];
                $amount[] = $row['quantity'];
            }


            ?>



            const data = {
                labels: <?php echo json_encode($labels) ?>,
                datasets: [{
                    label: 'My First Dataset',
                    data: <?php echo json_encode($amount) ?>,
                    backgroundColor: [
                        'rgb(90,171, 77)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            const config = {
                type: 'doughnut',
                data: data,
            };

            const myChart = new Chart(
                document.getElementById('inventory_chart'),
                config
            );



        }


        function seed_stock() {



            <?php

            $sql = "SELECT crop.crop_ID,crop.crop, SUM(stock_in.quantity) AS quantity FROM stock_in
             INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID GROUP BY crop.crop_ID";
            $result = mysqli_query($con, $sql);

            $result = $con->query($sql);
            foreach ($result as $row) {
                $day[] = $row['crop'];
                $amount[] = $row['quantity'];
            }


            ?>



            let test = <?php echo json_encode($amount) ?>;


            const data = {
                labels: <?php echo json_encode($day) ?>,
                datasets: [{
                    label: 'Stock out Quantity For 2022',
                    backgroundColor: [
                        'rgba(41, 173, 72, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(45, 189, 79, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',

                    ],
                    borderColor: [
                        'rgb(30, 128, 53)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(45, 189, 79,)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',

                    ],
                    borderWidth: 1,

                    data: <?php echo json_encode($amount) ?>,
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            };
            const myChart = new Chart(
                document.getElementById('seed_stock'),
                config
            );



        }
    </script>
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
                                    <ul>
                                        <li class="more-details">
                                            <a href="../other/user_profile.php"><i class="ti-user"></i>View Profile</a>

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
                                        <li class="active">
                                            <a href="admin_dashboard.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
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
                                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Quick Setup </span>
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
                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms"> Products &amp; Pricing</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="view_all_prices.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-notepad"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Products & Prices</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="add_product.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-plus"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Register Product</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="set_prices.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Set Sell Prices</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="set_buy_prices.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Set Buyback Prices</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                    </ul>


                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Order &amp; Sales</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="admin_pending_orders.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-reload"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pending Orders</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="admin_approved_orders.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-thumb-up"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Approved Orders</span>
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
                                            <a href="admin_processed_orders.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-check"></i><b>FC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.form-components.main">Processed Orders</span>
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
                                            <h5 class="m-b-10">Dashboard</h5>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="production_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Dashboard</a>
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
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-purple">$0</h4>
                                                                <h6 class="text-muted m-b-0">All Earnings</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-bar-chart f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">

                                                            </div>
                                                            <div class="col-3 text-right">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-green">0 kg</h4>
                                                                <h6 class="text-muted m-b-0">Seed in Stock</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="ti-writes"></i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">

                                                            </div>
                                                            <div class="col-3 text-right">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-red">0 kg</h4>
                                                                <h6 class="text-muted m-b-0">Stock In</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="ti-arrow-down"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-red">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">

                                                            </div>
                                                            <div class="col-3 text-right">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue">0 kg</h4>
                                                                <h6 class="text-muted m-b-0">Stock Out </h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="ti-arrow-up "></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">

                                                            </div>
                                                            <div class="col-3 text-right">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->

                                            <!--  sale analytics start -->
                                            <div class="col-xl-8 col-md-12">
                                                <div class="card">

                                                    <div>
                                                        <canvas id="stock_out_chart"></canvas>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12">

                                                <div class="card">
                                                    <div>
                                                        <canvas id="inventory_chart"></canvas>
                                                    </div>

                                                </div>

                                            </div>
                                            <!--  sale analytics end -->

                                            <!--  project and team member start -->
                                            <div class="col-xl-8 col-md-12">

                                                <div class="card">

                                                    <div>
                                                        <canvas id="seed_stock"></canvas>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card ">
                                                    <div class="card-header">
                                                        <h5>Bank Accounts </h5>
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
                                                        <div class="align-middle m-b-30">
                                                            <img src="assets/images/avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>David Jones</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                        <div class="align-middle m-b-30">
                                                            <img src="assets/images/avatar-1.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>David Jones</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                        <div class="align-middle m-b-30">
                                                            <img src="assets/images/avatar-3.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>David Jones</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                        <div class="align-middle m-b-30">
                                                            <img src="assets/images/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>David Jones</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                        <div class="align-middle m-b-10">
                                                            <img src="assets/images/avatar-5.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>David Jones</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <a href="#!" class="b-b-success text-success">View all Projects</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  project and team member end -->
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
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
    <script type="text/javascript" src="assets/pages/widget/excanvas.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="assets/js/chart.js/Chart.js"></script>
    <!-- amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="assets/pages/widget/amchart/gauge.js"></script>
    <script src="assets/pages/widget/amchart/serial.js"></script>
    <script src="assets/pages/widget/amchart/light.js"></script>
    <script src="assets/pages/widget/amchart/pie.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="assets/js/script.js "></script>
</body>

</html>