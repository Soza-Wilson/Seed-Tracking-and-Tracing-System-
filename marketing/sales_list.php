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

$restricted = array("system_administrator","marketing_officer","marketing_system_administrator");

if (in_array($position, $restricted)) {
} else {
    header('Location:../restricted_access/restricted_access.php');
}


$test = $_SESSION['fullname'];
$position = $_SESSION['position'];










if(!empty($order_ID)){

$sql="SELECT * FROM order_table WHERE `order_ID`='$order_ID'";


$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $amount = $row["total_amount"];
        $customer = $row["customer_id"];
        $user_requested = $row["user_ID"];
        $date = $row["date"];
        $time = $row["time"];
        $file = $row["order_files"];
      

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
    <script type="text/javascript">

       $(document).ready(()=>{


        const loaded = "1";

$.post('../production/get_products.php', {
    loaded: loaded

}, data => {
    $('#select_crop').html(data);




});



$('#select_crop').change(function() {



    var data = $('#select_crop').find(':selected');

    if (data.val() == "0") {
        alert("please select Crop ");
    } else {




        let crop_value = $('#select_crop').val();

        $.post('../production/get_products.php', {
            crop_value: crop_value

        }, data => {
            $('#select_variety').html(data);



        });








    }
});

$('#select_class').change(function() {

    var crop_data = $('#select_crop').val();
    var variety_data = $('#select_variety').val();
    var class_data = $('#select_class').val();

    if (crop_data == 0) {

        alert('Select crop and variety');


    } else if (variety_data == 0) {

        alert('Select crop and variety');

    } else {

        $.post('get_prices.php', {
            crop_data: crop_data,
            variety_data: variety_data,
            class_data: class_data
        }, function(data) {

            $('#price_per_kg').val(data);

        });
    }




});


        $('#openLpoFile').click(()=>{
            let directory = $('#directorHidden').val();
            if(directory=="" || directory=="-"){
            alert('LPO file not found');
            }
            else{
                window.location='../files/marketing/b_to_b_LPO/'+directory;
            } 
        });

        $('#lpo_file').hide();
        if($('#page_type_hidden').val()=="b_to_b"){

            $('#lpo_file').show();
        }
        




        $("#back").click(()=>{

            history.back();
        });

         

        $("#get_data").click(()=>{





let sales_data_filter = $('#typeValue').val();
let cropValue = $('#select_crop').val();
let varietyValue = $('#select_variety').val();
let classValue = $('#select_class').val();
let from = $('#fromDateValue').val();
let to = $('#toDateValue').val();
let page_type ="sales_list";



$('#customer_type_hidden').val(sales_data_filter);
$('#cropValueHidden').val(cropValue);
$('#varietyValueHidden').val(varietyValue);
$('#classValueHidden').val(classValue);
$('#from_hidden').val(from);
$('#to_hidden').val(to);
$('#filter').val("haghgd");




$.post('get_data.php', {
  sales_data_filter:sales_data_filter,   
    cropValue:cropValue,
    varietyValue:varietyValue,
    classValue:classValue,
    from:from,
    to:to,
    page_type:page_type,                 
    }, function(data) {
        $('#dataTable').html(data);


    })



})


        

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
                                   
                                </div>
                            </div>
                            <div class="p-15 p-b-0">



                            </div>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Admin control </div>
                           

                                <li class="pcoded-hasmenu">

                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="marketing_dashboard.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>






                                        </li>


                                    </ul>
                                    <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Order &amp; Sales</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="place_order.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-write"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Place Order</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                               

                                <li class="<?php echo $pending;?>">
                                    <a href="view_pending_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-reload"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Pending Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="<?php echo $processed;?>">
                                    <a href="view_processed_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-check"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Processed Orders </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="<?php echo $denied;?>">
                                    <a href="view_denied_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-face-sad"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Denied Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="<?php echo $all;?>">
                                    <a href="view_all_orders.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-clipboard"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">All Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                               
                    
                            </ul>
                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Agro Dealer</div>
                            <ul class="pcoded-item pcoded-left-item">
                                
                                <li class="<?php echo $agro_dealer;?>">
                                    <a href="agro_dealer.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Registered </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                    
                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">B to B</div>
                            <ul class="pcoded-item pcoded-left-item">
                                
                                <li class="<?php echo$b_to_b;?>">
                                    <a href="b_to_b.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Register Business </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                              
                                <li class="">
                                    <a href="lpo.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-file"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">LPOs </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                    
                            </ul>

                            <div class="pcoded-navigation-label" data-i18n="nav.category.other">Sales</div>
                            <ul class="pcoded-item pcoded-left-item">
                                
                                <li class="active">
                                    <a href="sales_list.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-stats-up"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">View Sales </span>
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
                                            <h5 class="m-b-10">Sales List </h5>
                                            <p class="m-b-0"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="marketing_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            
                                            
                                            </li>
                                            <li class="breadcrumb-item"><a href="sales_list.php">Sales List </a>
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
                                            <div class="card-header">
                                                <h5>Filter </h5>


                                            </div>
                                            <div class="card-block">

                                               


                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                             <label class="label bg-success">Order Type</label>
                                                        <select id="typeValue" name="typeValue" class="form-control" required="">
                                                            <option value="type_not_selected">Order Type</option>
                                                            <option value="customer">Customer</option>
                                                            <option value="agro_dealer">Agro Dealer</option>
                                                            <option value="b_to_b">Business</option>
                                                            <option value="grower">Grower</option>


                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2">

                                                    <label class="label bg-success">Select Crop</label>
                                                    <select name="select_crop" id="select_crop" class="form-control"> 
                                                        <option value="not_selected">Not Selected</option>


                                                    </select>


                                                        
                                                    </div>
                                                    
                                                    <div class="col-sm-2">

                                                    <label class="label bg-success">Select Variety</label>
                                                    <select name="select_variety" id="select_variety" class="form-control"> 
                                                        <option value="not_selected">Not Selected</option>


                                                    </select>


                                                        
                                                    </div>
                                                    <div class="col-sm-1">

                                                    <label class="label bg-success">Select Class</label>
                                                    <select name="select_class" id="select_class" class="form-control"> 
                                                        <option value="not_selected">Class</option>
                                                        <option value="pre_basic">Pre-Basic</option>
                                                        <option value="basic">Basic</option>
                                                        <option value="certified">Certified</option>


                                                    </select>


                                                        
                                                    </div>

                                                    <div class="col-sm-2">
                                                    <label class="label bg-success">From :</label>
                                                        <input type="date" class="form-control" id="fromDateValue" name="fromDateValue" placeholder="From" require="">
                                                    </div>

                                                    <div class="col-sm-2">
                                                    <label class="label bg-success">To :</label>
                                                        <input type="date" class="form-control" id="toDateValue" name="toDateValue" placeholder="TO " require="">
                                                    </div>


                                                    



                                                    <div class="col-sm-1">


    </br>
                                                        <button name="get_data" id="get_data" class="btn btn-success btn-mat btn-mat"><i class="icofont icofont-search"></i></button>


                                                      
                                                    </div>
                                                </div>


                                                <form action="marketing_csv_handler.php" method="POST">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">



                                                            <button class="btn btn-success btn-mat btn-mat " id='sales_save_csv' name='sales_save_csv'><i class="icofont icofont-download"></i> CSV</button>


                                                            <input type="hidden" name="customer_type_hidden" id="customer_type_hidden">
                                                            <input type="hidden" name="cropValueHidden" id="cropValueHidden">
                                                            <input type="hidden" name="varietyValueHidden" id="varietyValueHidden">
                                                            <input type="hidden" name="classValueHidden" id="classValueHidden">
                                                            <input type="hidden" name="from_hidden" id="from_hidden">
                                                            <input type="hidden" name="to_hidden" id="to_hidden">
                                                            <input type="hidden" name="filter" id="filter">





                                                            </select>

                                                        </div>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Items</h5>

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
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                            <th>Order ID</th>
                                                                <th>Item Number</th>
                                                                <th>Crop</th>
                                                                <th>Variety</th>
                                                                <th>Class</th>
                                                                <th>Quantity</th>
                                                                <th>price per kg</th>
                                                                <th>Discount</th>
                                                                <th>Total price</th>
                                                                <th>Order By</th>
                                                                <th>Customer Name</th>
                                                                <th>Order Type</th>
                                                                <th>Date</th>
                                                                <th>Action</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $sql = "SELECT item.order_ID,item.item_ID,crop.crop,user.fullname,variety.variety,item.class,item.price_per_kg,item.discount_price,order_table.order_type,item.quantity,item.total_price,order_table.date,order_table.customer_name
                                                             FROM item INNER JOIN crop ON crop.crop_ID = item.crop_ID INNER JOIN variety ON variety.variety_ID = item.variety_ID INNER JOIN order_table ON order_table.order_ID = item.order_ID 
                                                             INNER JOIN user ON user.user_ID = order_table.user_ID WHERE order_table.status='processed' ORDER BY order_table.order_ID DESC;";

                                                            $result = $con->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                                    $order_ID =$row["order_ID"];
                            
                                                                    $item_ID      = $row["item_ID"];
                                                                    $crop     = $row["crop"];
                                                                    $order_by=$row["fullname"];
                                                                    $customer=$row["customer_name"];
                                                                    $order_date=$row["date"];
                                                                    $variety = $row["variety"];
                                                                    $class    = $row['class'];
                                                                    $quantity = $row['quantity'];
                                                                    $price_per_kg = $row['price_per_kg'];
                                                                    $order_type = $row['order_type'];
                                                                    $discount_price = $row['discount_price'];
                                                                    $total_price = $row['total_price'];
                                                                    $page="sales_order";
                                                                    echo "
											<tr class='odd gradeX'>
                                            <td>$order_ID</td>
                                            <td>$item_ID</td>
                                            <td>$crop</td>
                                            <td>$variety</td>
                                            <td>$class</td>
                                            <td>$quantity</td>
                                            <td>$price_per_kg </td>
                                            <td>$discount_price</td>
                                            <td>$total_price</td>
                                            <td>$order_by</td>
                                            <td>$order_type</td>
                                            <td>$customer</td>
                                            <td>$order_date</td>
                                           <td><a href='order_details.php? order_ID=$order_ID & page_type=$page' class='btn btn-success btn-mat'>View Order</a></td>
                                            
												
											</tr>	
                                    
												
										";
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="card-block">

                                              
                                            
                                                
                                                

                                                
                                               

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




 
 


?>
</html>