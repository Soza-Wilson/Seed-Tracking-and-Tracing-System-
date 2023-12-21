<?php

use Debtor\Debtor;


spl_autoload_register(function ($class) {
    if (file_exists('../../class/Order/' . $class . '.php')) {
        require_once '../../class/Order/' . $class . '.php';
    } elseif (file_exists('../../class/Debtor/' . $class . '.php')) {
        require_once '../../class/Debtor/' . $class . '.php';
    } elseif (file_exists('../../class/' . $class . '.php')) {
        require_once '../../class/' . $class . '.php';
    }
});


$order_class = new Order();
$connection = new DbConnection();
$con = $connection->connect();


session_start();



if (isset($_POST['place_order'])) {

    $type = $_SESSION['type'];

    switch ($type) {
        case "customer":

            // since regular customer are registered when the user adds the first
            // item, the code here is trying to include the customer's id to the temp session list  
            $name = $_SESSION['customer_name'];

            $sql = "SELECT * FROM `debtor` WHERE `name` like '%$name%' AND `debtor_type`='customer'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    unset($_SESSION['customer_ID']);
                    $_SESSION['customer_ID'] =  $row["debtor_ID"];
                }
            }
            $order_class->place_order();
            break;
        case "agro_dealer":
            $order_class->place_order();
            break;
        case "b_to_b":
            $order_class->place_order();
            break;
    }
}


if (isset($_FILES['image'])) {

    if (!empty($_SESSION['order'])) {

        $type = $_SESSION['type'];
    } else {
        $type = $_POST['debtor_type'];
    }


    if ($type == 'b_to_b') {

        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["image"]["name"]));


        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        $extensions = array("pdf");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a pdf file .";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../files/marketing/b_to_b_LPO/" . $newfilename);
            echo "success btn-mat btn-mat";
        } else {
            print_r($errors);
        }

        if (empty($_SESSION['lpoFile'])) {

            $_SESSION['lpoFile'] = $newfilename;
        } else {

            unset($_SESSION['lpoFile']);
            $_SESSION['lpoFile'] = $newfilename;
        }
    } else {

        $_SESSION['lpoFile'] = "-";
    }
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


                    $order_class->order_temp_data(
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


                    $order_class->add_item($order, $order_book, $crop, $variety, $class, $_POST['quantity'], $_POST['price_per_kg'], $_POST['discount_price'], $_POST['total_price']);
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


                    $order_class->order_temp_data(
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


                    $order_class->add_item(
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

                $debtor = new Debtor($_POST['customer_name'], $_POST['description']);
                $debtor->register_debtor('customer');
                $array_data[]  = "";
                $array_data[0] = "-";
                $array_data[1] = $_POST['description'];
                $array_data[2] = $_POST['customer_name'];

                $order_class->order_temp_data(
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

 
                    $order_class->order_temp_data(
                        $data_result,
                        '',
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
                    $order_book = '';
                    $crop =  $_POST['crop'];
                    $variety = $_POST['variety'];
                    $class = $_POST['class'];

                    ;
                    $order_class->add_item(
                        $order,
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
            window.location='../place_order.php';
        </script>");
    }
}
