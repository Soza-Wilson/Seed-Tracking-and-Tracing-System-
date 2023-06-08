<!DOCTYPE html>
<html lang="en">
<?php

Ob_start();
include('../class/main.php');
// include('../class/production.php');
session_start();

$test = $_SESSION['fullname'];


$user_ID =  $_SESSION['user'];
$fullname = "";
$DOB = "";
$registered_date = "";
$position = "";
$phone = "";
$email = "";
$passoword = "";

$sql = "SELECT `user_ID`, usertype.user_type `type`, `fullname`, 
`DOB`, `sex`, `registered_date`, `postion`, `phone`,
 `email`, `password`, `account_status`, 
 `profile_picture` FROM `user` INNER JOIN 
 usertype ON user.user_type_ID = usertype.user_type_ID WHERE `user_ID`='$user_ID'";
global $con;

$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_ID = $row["user_ID"];
        $fullname  = $row["fullname"];
        $dob  = $row["DOB"];
        $department = $row["type"];
        $registered_date = $row["registered_date"];
        $position = $row["postion"];
        $phone  = $row["phone"];
        $email  = $row["email"];
        $password  = $row["password"];
        $profile = $row["profile_picture"];
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

    <link rel="icon" href="../assets/images/main_icon.png" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="assets/pages/notification/notification.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style_.css">

    <script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/jsHandle/user_profile.js">

    </script>

</head>

<body themebg-pattern="theme3">
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

    <div class="container-fluid">
        <div class="row">
            </br></br></br>
        </div>

    </div>


    <section>
        <div class="col-md-12">



            <div class="card">

                <div class="card-header">


                    <h5>Profile</h5>
                </div>


                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title">Update Profile Picture</h5>
                            </div>
                            <div class="modal-body">
                            <form action="user_profile.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group row">

                                    <div class="col-sm-12">
                                        <labe>Picture Directory :</label>
                                            <input type="file" class="form-control" name="file_directory" accept=".jpg" id="file_directory">
                                            <input type="hidden" class="form-control" name="tempFile" id="tempFile">
                                            <input type="hidden" class="form-control" id="user" value="<?php echo $user_ID; ?>">

                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="save_image" value="Save" class="btn waves-effect waves-light btn-success  btn-mat"><i class="icofont icofont-save"></i> Save</button>
                                    </div>

                                </div>
                                  

                            </form>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card-block ">

                    <div class="form-group row">

                        <!-- Nav tabs -->
                        <!-- <div class="nav nav-tabs md-tabs img-tabs b-none col-sm-2">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#home8" role="tab">
                                                                    <img src="assets/images/avatar-1.jpg" class="img-fluid img-circle" alt="">

                                                                </a>
                                                            </li>

                                                        </div> -->

                        <?php
                        $position_data = "";
                        if ($position == "") {
                            $position_data = "-";
                        } else {
                            $position_data = $position;
                        } ?>



                        <div class="align-middle m-b-10 col-sm-12">
                            <img src="../files/user_profile/<?php if ($profile == "") {
                                                                echo "user.jpg";
                                                            } else {
                                                                echo $profile;
                                                            } ?>" alt="user image" class="img-radius img-100 align-middle m-r-15">


                            <div class="d-inline-block">
                                <h6><?php echo $fullname; ?></h6>
                                <p class="text-muted m-b-0"><?php echo $position_data ?></p>
                            </div>
                        </div>

                        <div class=" col-sm-12">

                            <button class="btn btn-inverse btn-round btn-mini img-radius img-100 align-middle m-r-15" data-toggle="modal" data-target="#myModal"><i class="icofont icofont-camera"></i>update</button>

                        </div>



                    </div>
                </div>





            </div>








        </div>

    </section>



    <section>

        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Account details</h5>
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


                    <form>
                        <div class="form-group row">



                            <dt class="col-sm-2">Full name : </dt>
                            <dd class="col-sm-10"> <input type="text"  id="fullname" class="form-control" value="<?php echo $fullname ?>"></dd>

                        </div>
                        <div class="form-group row">
                            <dt class="col-sm-2">Depertment : </dt>
                            <dd class="col-sm-10"> <select class="form-control">
                                    <option value="<?php echo $type ?>"><?php echo $department;?></option>
                                </select></dd>
                        </div>
                        <div class="form-group row">
                            <dt class="col-sm-2">Position : </dt>
                            <dd class="col-sm-10"> <select class="form-control">
                                    <option value="<?php echo $position ?>"><?php echo $position ?></option>
                                </select></dd>
                        </div>
                        <div class="form-group row">
                            <dt class="col-sm-2">Phone : </dt>
                            <dd class="col-sm-10"> <input type="text" id="phone" class="form-control" value="<?php echo $phone ?>"></dd>
                        </div>
                        <div class="form-group row">
                            <dt class="col-sm-2">Email : </dt>
                            <dd class="col-sm-10"> <input type="text" id="email" class="form-control" value="<?php echo $email ?>"></dd>
                        </div>




                    </form>

                </div>
            </div>
        </div>
    </section>


    <section>

        <div class="col-xl-12 col-md-12">
            <div class="card">

                <div class="card-block">

                    <button class="btn btn-success btn-mat" id="update_user"><i class="icofont icofont-save"></i> Update</button>
                    <button class="btn btn-danger btn-mat" id="back"><i class="icofont icofont-warning"></i> Back</button>





                </div>
            </div>
        </div>
    </section>
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
                    <img src="../assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../assets/images/browser/ie.png" alt="">
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
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../assets/js/SmoothScroll.js"></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="../assets/js/common-pages.js"></script>
</body>

</html>