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
    <script type="text/javascript">
        $(document).ready(function() {



            selectedType = "";

            $('#typeValue').change(() => {
                selectedType = $('#typeValue').val();



                if (selectedType == "internal") {

                    let internal_creditor_value = 'c';

                    $.post('get_creditors.php', {
                        internal_creditor_value: internal_creditor_value,

                    }, function(data) {
                        $('#names').html(data);
                    })

                } else if (selectedType == "external") {

                    let external_creditor_value = 'c';

                    $.post('get_creditors.php', {
                        external_creditor_value: external_creditor_value,

                    }, function(data) {
                        $('#names').html(data);
                    })


                }





            });

            $("#get_data").click(() => {

                let outstanding_creditor_data_filter = $('#typeValue').val();
                let creditor = $('#search_by_credname').val();
                let from = $('#fromDateValue').val();
                let to = $('#toDateValue').val();
                let page_type = "processed";


                $('#trans_type_hidden').val(outstanding_creditor_data_filter);
                $('#debtor_hidden').val(creditor);
                $('#from_hidden').val(from);
                $('#to_hidden').val(to);
                $('#filter').val("haghgd");


                $.post('get_creditors.php', {
                    outstanding_creditor_data_filter: outstanding_creditor_data_filter,
                    creditor: creditor,
                    from: from,
                    to: to,
                    page_type: page_type,
                }, function(data) {
                    $('#dataTable').html(data);


                })






            });

            $("#search_by_credname").on("input", () => {

                if (selectedType == 'type_not_selected') {
                    alert("Please select Creditor type");
                }

            });


            $('#cheque_number').prop("readonly", true);
            $('#cheque_file').prop('readonly', true);

           

           



               

            

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
                        <a href="">
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
                                    <a href="finance_dashboard.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Debtor Payments</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="">
                                    <a href="add_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Payment </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="debtor_processed_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-list-ol"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Processed Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="">
                                    <a href="debtor_outstanding_payments.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clip"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Outstanding Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="">
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
                                    <a href="add_payback_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Payback Payment </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="creditor_processed_payments.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-list-ol"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Processed Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="active">
                                    <a href="creditor_outstanding_payments.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clip"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Outstanding Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="">
                                    <a href="creditor_accounts.php" class="waves-effect waves-dark">
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
                                            <h5 class="m-b-10">Creditor OutStanding Payments</h5>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="finance_dashboard.php"> <i class="fa fa-home"></i> </a>

                                            <li class="breadcrumb-item"><a href="creditor_outstanding_payments.php"> Outstanding Creditor Payment</a>
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
                                            <div class="card-header">
                                                <h5>Filter </h5>


                                            </div>
                                            <div class="card-block">

                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label>Transaction Type</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Search by name</label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>From :</label>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label>To :</label>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <select id="typeValue" name="typeValue" class="form-control" required="">
                                                            <option value="type_not_selected">Creditor Type</option>
                                                            <option value="internal">Internal</option>
                                                            <option value="external">external</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">


                                                        <input list="names" id="search_by_credname" name="search_by_creadname" class="form-control" required="">

                                                        <datalist id="names">

                                                        </datalist>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <input type="date" class="form-control" id="fromDateValue" name="fromDateValue" placeholder="From" require="">
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <input type="date" class="form-control" id="toDateValue" name="toDateValue" placeholder="TO " require="">
                                                    </div>


                                                    <input type="hidden" name="typeValueHidden" id="typeValueHidden">
                                                    <input type="hidden" name="creditorHidden" id="creditorHidden">
                                                    <input type="hidden" name="from_hidden" id="from_hidden">
                                                    <input type="hidden" name="to_hidden" id="to_hidden">
                                                    <input type="hidden" name="filter" id="filter">



                                                    <div class="col-sm-3">



                                                        <button name="get_data" id="get_data" class="ti-search btn btn-success btn-mat"></button>


                                                        <a href="creditor_processed_payments.php" class="ti-loop btn btn-danger"></a>
                                                    </div>
                                                </div>


                                                <form action="finance_csv_handler.php" method="POST">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">







                                                            </select>

                                                        </div>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Transaction list</h5>
                                                        <div class="card-block table-border-style">
                                                            <div class="table-responsive" id="table_test">
                                                                <table class="table" id="dataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Type</th>
                                                                            <th>Amount</th>
                                                                            <th>Date</th>

                                                                            <th>Time</th>
                                                                            <th>Status</th>
                                                                            <th>Actions</th>



                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php






                                                                        // $sql = "SELECT `transaction_ID`, `type`, `action_name`, `action_ID`, `C_D_ID`, `amount`,
                                                                        //  `trans_date`, `trans_time`, `trans_status`, `user_ID` FROM `transaction` WHERE `type` = 'creditor_buy_back'";

                                                                        $sql = "SELECT `transaction_ID`, `type`, `action_name`, `action_ID`, `C_D_ID`, `amount`,
                                                                                 `trans_date`, `trans_time`, `trans_status`, `user_ID` FROM `transaction` WHERE `trans_status` = 'partly_payed' OR `trans_status` = 'payment_pending' AND `type` ='creditor_buy_back'";



                                                                        $result = $con->query($sql);
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                $transaction_ID = $row["transaction_ID"];
                                                                                $stock_in_ID = $row["action_ID"];
                                                                                $type  = $row["type"];
                                                                                $amount = $row["amount"];
                                                                                $trans_date = $row["trans_date"];
                                                                                $trans_time = $row['trans_time'];
                                                                                $trans_status = $row['trans_status'];
                                                                                $trans_details = "creditor_outstanding";




                                                                                echo "
                                                   <tr class='odd gradeX'>
                                                       <td>$stock_in_ID</td>
                                                       <td>$type</td>
                                                       <td>$amount</td>
                                                       <td>$trans_date</td>
                                                       <td>$trans_time</td>
                                                       <td>$trans_status</td>

                                                       


                                                       <td><a href='creditor_transaction_details.php?stock_in_id=$stock_in_ID & transaction_details=$trans_details'  class='btn btn-success'>view</a> </td>
                                                       
                                                     
                                                                                                           
                                                         
                                                       
                                                        
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


</html>