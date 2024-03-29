<!DOCTYPE html>
<html lang="en">
<?php


Ob_start();
 include('../class/main.php');


session_start();

$test = $_SESSION['fullname'];
$position = $_SESSION['position'];
$user_id = $_SESSION['user'];

if (empty($test)) {

    header('Location:../index.php');
}

$restricted = array("marketing_admin", "system_administrator", "marketing_officer");

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
    <script type="text/javascript" src="assets/js/jsHandle/place_order.js"></script>


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

                    <div class="navbar-container container-fluid ">
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

                            <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Agro Dealer </span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        
                                        <li class="">
                                        <a href="active_agro_dealer.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Active Agro Dealers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="">
                                        <a href="inactive_agro_dealer.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main"> Inactive Agro Dealers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                       
                            
                                    </ul>
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

                                <li class="">
                                    <a href="sales_list.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-stats-up"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">View Sales </span>
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
                                                <a href="marketing_dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                           
                                            <li class="breadcrumb-item"><a href="#!">Place Order</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="get_data/send_order_data.php" method="POST" enctype="multipart/form-data">
                            <!-- Page-header end -->
                            <div class="pcoded-inner-content">
                                <!-- Main-body start -->
                                <div class="main-body">
                                    <div class="page-wrapper">

                                        <!-- Page body start -->
                                        <div class="page-body">



                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Select Order type</h5>


                                                    </diforderv>
                                                    <div class="card-block">


                                                        <div class="form-group row">
                                                            <div class="col-sm-6">
                                                                <select id="debtor_type" name="debtor_type" class="form-control" required="">
                                                                    <option value="type_not_selected">Select Order Type</option>
                                                                    <option value="agro_dealer">To agro dealer</option>
                                                                    <option value="b_to_b">B to B (LPO)</option>
                                                                    <option value="customer">Customer</option>



                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Search " require="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <select id="search_result" name="search_result" class="form-control" required="">
                                                                    <option value="not_selected">-</option>



                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" id="description" name="description" placeholder=" " require="">



                                                                </select>
                                                            </div>

                                                        </div>

                                                        </br>
                                                        <a href="grower_order.php" class="btn btn-success btn-mat"><i class="icofont icofont-plus"></i> Grower Order</a>


                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Order items </h5>
                                                            <div class="card-block table-border-style">
                                                                <div class="table-responsive" id="table_test">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Crop</th>
                                                                                <th>Variety</th>
                                                                                <th>class</th>
                                                                                <th>Quantity</th>
                                                                                <th>price per kg</th>
                                                                                <th>Discount</th>
                                                                                <th>Total price</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <?php
                                                                            $order_id = "";


                                                                            if (!empty($_SESSION['order'])) {

                                                                                $order_id = $_SESSION['order'];
                                                                            } else {

                                                                                $order_id = "";
                                                                            }

                                                                            if (empty($test)) {

                                                                                echo ("<script> alert('no order in progress ');
                                    </script>");
                                                                            } else {

                                                                                $sql = "SELECT `item_ID`, `order_ID`, `crop`, `variety`, `class`, `quantity`, `price_per_kg`, `discount_price`, `total_price` FROM
                                        `item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID WHERE order_ID = '$order_id'";

                                                                                $result = $con->query($sql);
                                                                                if ($result->num_rows > 0) {
                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                        $item_ID      = $row["item_ID"];
                                                                                        $crop     = $row["crop"];
                                                                                        $variety = $row["variety"];
                                                                                        $class = $row["class"];
                                                                                        $quantity = $row['quantity'];
                                                                                        $price_per_kg = $row['price_per_kg'];
                                                                                        $discount = $row['discount_price'];
                                                                                        $total_price = $row['total_price'];



                                                                                        echo "
                                                   <tr class='odd gradeX'>
                                                       <td>$item_ID</td>
                                                       <td>$crop</td>
                                                       <td>$variety</td>
                                                       <td>$class</td>
                                                       <td>$quantity</td>
                                                       <td>$price_per_kg </td>
                                                       <td>$discount</td>
                                                       <td>$total_price</td>
                                                         
                                                       
                                                       
                                                       <td><a href='view_registered_users.php?' class='ti-eye'></a>/<a href='view_registered_users.php' class='ti-trash'></a>/<a href='view_registered_users.php' class='ti-pencil-alt'></a></td>
                                                   </tr>	
                                               ";
                                                                                    }
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
            <div class="card">
                <div class="card-header">
                    <h5>Add Item</h5>


                </div>
                <div class="card-block">



                    <div class="form-group row">
                        <div class="col-sm-12">
                        <label class="label bg-primary">Crop:</label>
                            <select id="select_crop" name="crop" class="form-control" required="">
                                <option value="0">Select crop</option>
                                <option value="CP001">Maize</option>
                                <option value="CP002">Ground nuts -shelled-</option>
                                <option value="CP003">Ground nuts -unshelled-</option>
                                <option value="CP009">Soyabean </option>
                                <option value="CP005">Rice</option>
                                <option value="CP004">Sorgum</option>
                                <option value="CP006">Cowpea</option>
                                <option value="CP007">Pigeonpea</option>
                                <option value="CP008">Beans</option>




                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <label class="label bg-primary">Variety:</label>
                            <select id="select_variety" name="variety" class="form-control" required="">
                                <option value="0">Select Variety</option>



                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <label class="label bg-primary">Class:</label>
                            <select id="select_class" name="class" class="form-control" required="">
                                <option value="0">Select class</option>
                                <option value="basic">Basic</option>
                                <option value="pre_basic">Pre-Basic</option>
                                <option value="certified">Certified</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-12">
                        <label class="label bg-primary">Quantity:</label>
                            <input id="quantity" type="number" class="form-control" name="quantity" placeholder="Quantity" require="">
                        </div>


                    </div>
                    <div class="form-group row">
                        
                        <div class="col-sm-12">

                              <label class="label bg-primary">Price per KG:</label>
                            <input type="number" id="price_per_kg" class="form-control" name="price_per_kg" placeholder="Price per kg" require="">
                        </div>
                    </div>


                    <div class="form-group row">
                       
                        <div class="col-sm-12">
                        <label class="label bg-primary">Enter discount price:</label>
                            <input type="number" id="discount_price" class="form-control" name="discount_price" placeholder="-" require="">
                        </div>
                    </div>

                    <div class="form-group row">
                       
                        <div class="col-sm-12">
                        <label class="label bg-primary">Total price:</label>
                            <input type="number" class="form-control" name="total_price" id="total_price" placeholder="TOTAL PRICE">
                        </div class="form-group row" require="">
                    </div>

                    <div class="form-group row">


                       
                        <div class="col-sm-12">
                        <label class="label bg-primary">Upload LPO (Available for B_to_B Orders only (OPTIONAL)):</label>
                            <input type="file" id="image" class="form-control" name="image" placeholder="-" require="">
                        </div>

                        </br></br></br>


                        <div>

                        </div>

                        <br>
                        .
                        <div class="form-group ">


                        <div class="col-sm-12 place_order_items">
                                                                        </br>
                            <button type="submit" name="add_item" class="btn btn-success btn-block btn-mat"><i class="icofont icofont-plus"></i> Add item</button>
                                                                        </br>
                             <button type="submit" name="place order" class="btn btn-success btn-block btn-mat"><i class="icofont icofont-cart"></i> Place order</button>
                           

                                                                        </div>

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
            <div class="card" id="approval_for_discount">

                <div class="card-header">

                    <h5>Request for approval</h5>
                </div>

                <div class="card-block">


                <div class="form-group row">
                        
                        <div class="col-sm-5 requestDetails" >
                            <label for="discount_price" class="label bg-primary">Original price</label>
                            <input type="text" id="original_price" class="form-control" name="original_price" placeholder="-" require="">
                            <input type="hidden" id="user_id" class="form-control" name="original_price" value="<?php echo $user_id?>">
                            <input type="hidden" id="user_name" class="form-control" name="original_price" value="<?php echo $test;?>">
                            <input type="hidden" id="approvalId" class="form-control" >
                           
                        </div>
                        <div class="col-sm-1 requestDetails" >
                                                                        </br>
                         <label for="" class="text align-center">TO</label>
                        </div>
                        <div class="col-sm-5 requestDetails" >
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
                <div class="col-sm-12 approvedDetails" >
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