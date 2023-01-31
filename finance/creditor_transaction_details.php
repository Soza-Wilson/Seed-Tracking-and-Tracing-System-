<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
session_start();

$test = $_SESSION['fullname'];
$position = $_SESSION['position'];
$stock_in_ID = $_GET['stock_in_id'];
$page_type = $_GET['transaction_details'];


if(!empty($page_type)){

    if($page_type=="creditor_processed"){

        $processed ="active";
    $outstanding="-";
    $account_details="-";
    
    
    
    }
    else if($page_type=="creditor_outstanding"){
    
    $processed ="-";
    $outstanding="active";
    $account_details="-";

    
    }

    else if($page_type=="creditor_details"){

        $processed ="-";
        $outstanding="-";
        $account_details="active";


    }

    
}

else{

    

    if($post_page_type=="debtor_processed"){

        $processed ="active";
    $outstanding="-";
    
    
    
    }
    else if($post_page_type=="debtor_outstanding"){
    
    $processed ="-";
    $outstanding="active";
    
    }





}





if(!empty($stock_in_ID)){



$sql="SELECT `stock_in_ID`, `certificate_ID`, `farm_ID`,creditor.name, user.fullname,
stock_in.creditor_ID, stock_in.source, `crop`, `status`, 
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
        $variety =$row["variety"];
        $class = $row["class"];
        $SRN = $row["SLN"];
        $bincard =$row["bincard"];
        $bags = $row["number_of_bags"];
        $quantity = $row["quantity"];
        $creditor = $row["name"];
        $user_requested = $row["fullname"];
        $date = $row["date"];
        $time = $row["time"];
        $description = $row["description"];
        $dir =  $row["supporting_dir"];
      

    }

}


}

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
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript">

       $(document).ready(()=>{


        $("#back").click(()=>{

let processsed_value = $("#processed_value").val();
if(processsed_value=='active'){
    window.location='creditor_processed_payments.php';
}
else if(outstanding_value=='active'){
window.location='creditor_outstanding_payments.php';
}

else{
    window.location='creditor_accounts.php';
}

});

       
          
             

        });

        


        

     

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
                        <a href="">

                        <span>finance</span>
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
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Admin control </div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="pcoded-hasmenu">

                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="admin_dashboard" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>






                                        </li>


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
                                    <a href="add_payment.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-money"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Payback Payment </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="<?php echo $processed; ?>">
                                    <a href="creditor_processed_payments.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-list-ol"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Processed Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="<?php echo $outstanding; ?>">
                                    <a href="creditor_outstanding_payments.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clip"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Outstanding Payments</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>

                                <li class="<?php echo $account_details; ?>">
                                    <a href="creditor_accounts.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Creditor accounts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>









                            
                            </ul>

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

                           
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Transaction Details </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="finance_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            
                                            
                                            </li>
                                            <li class="breadcrumb-item"><a href="admin_view_order_items.php">Transaction Details </a>
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

                                                        <label class="badge badge-primary "> ID</label>
                                                        <input id="order_id" type="text" class="form-control" name="order_id" value= "<?php echo $stock_in_ID; ?>" require="">

                                                    </div>



                                                    <div class="col-sm-2">

                                                        <label class="badge badge-primary ">Quantity</label>
                                                        <input id="order_type" type="text" class="form-control " name="order_type" value="<?php echo $quantity; ?>" require="">



                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label class="badge badge-primary ">Transaction For</label>
                                                        <input id="customer_name" type="text" class="form-control" name="customer_name" value="<?php echo $creditor; ?>" require="">



                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label class="badge badge-primary ">Added By</label>
                                                        <input id="requested_user" type="text" class="form-control" name="requested_user" value="<?php echo $user_requested; ?>" require="">



                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label class="badge badge-primary "> Date</label>
                                                        <input id="search_main_certificate" type="text" class="form-control" name="search_main_certificate" value="<?php echo $date; ?>" require="">



                                                    </div>

                                                    <div class="col-sm-2">

                                                        <label class="badge badge-primary ">Time</label>
                                                        <input id="time" type="text" class="form-control" name="time" value="<?php echo $time; ?>" require="">
                                                       


                                                    </div>
                                              
                                                    <div class="card-block">


                                                    </form>
                                               

                                                    <form action="finance_csv_handler.php" method="POST">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">



                                                        



                                                
                                                   

                                                        <a href="../files/production/stock_in_documents/<?php echo"$dir"?>" class="btn btn-success"> View Documents</a>


                                                            
                                                            <input type="hidden" name="customer_name" id="customer_name">
                                                            <input type="hidden" name="order_id" id="order_id">

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
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary">Crop:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="user_id" id="user_id" required="" value="<?php echo $crop; ?>">
                                                        </div>
                                                    </div>



                                                    <div class="form-group row">
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary">Variety:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="fullname" required="" value="<?php echo $variety; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary ">Class:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="dob" id="dob" required="" value="<?php echo $class; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary">Seed Receive Note #:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="user_id" id="user_id" required="" value="<?php echo $SRN; ?>">
                                                        </div>
                                                    </div>



                                                    <div class="form-group row">
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary">Bin Card #:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="fullname" required="" value="<?php echo $bincard; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary ">Number of Bags:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="dob" id="dob" required="" value="<?php echo $bags; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-1">
                                                            <label class="badge badge-primary ">Description:</label>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control trans_details" name="dob" id="dob" required="" value="<?php echo $description; ?>">
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">

                                                    <div class="col-sm-4">

                                                 

                                                    <button class=" btn btn-success" id='back' name='back'>Back</button>


                                                    

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
<?php

if(isset($_POST['back'])){

    echo"<script>alert('$page_type')</script>";


    // if($page_type=="creditor_processed"){

    //     header("Location:creditor_processed_payments.php");


    // }

    // else if ($page_type=="creditor_outstanding"){

    //     header("Location:creditor_outstanding_payments.php");


    // }

 

  


}


 
 


?>
</html>