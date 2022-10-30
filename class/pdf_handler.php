

<?php

use function PHPSTORM_META\type;

require('../pdf/fpdf.php');
require('main.php');
session_start();
//$type = $_GET['type'];
$pdf_type = "labels";





class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../pdf/logo.png', 0, 5, 0);
        // Arial bold 15
        $this->SetFont('Arial', '', 10);
        // Move to the right
        $this->Cell(80);
        // Title
        // $this->Cell(20,10,'   P.O Box 2281, Lilongwe,Malawi',0,0,'');
        // //
        // $this->Cell(20,24,'Along Likuni Road',0,0,'c');
        // $this->Cell(20,31,'Tel: +265 (0) 994870500/400/500',0,0,'c');
        // $this->Cell(20,39,'info@musecomalawi.com',0,0,'c');
        // $this->Cell(20,46,'www.musecomalawi.com',0,0,'c');


        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

class labels_pdf extends FPDF
{
}


class pdf_handler
{

    function create_receipt()
    {

        $debtor_name = "";
        $debtor_phone = "";
        $user_name = "";
        $payment_date = "";
        $payment_time = "";
        $payment_id = "";
        $payment_type = "";
        $order_id = "";
        $total = "";
        $order_id = $_GET['order_id'];
        $total = $_GET['total'];
        $payment_id = $_GET['payment_id'];

        //getting customer details

        $sql = "SELECT `debtor_ID`, `name`, `phone`, `email`,
 `description`, `debtor_type`, `user_ID`, 
 `debtor_files`, `registered_date`, `account_funds` FROM `debtor` ";
        global $con;

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $debtor_name = $row["name"];
                $debtor_phone  = $row["phone"];
            }
        }


        // getting payment details 

        $sql = "SELECT `payment_ID`,user.fullname, `type`, `amount`, `description`, `documents`, `cheque_number`,
 `bank_name`, `account_name`, payment.date, payment.time, `transaction_ID` FROM `payment` INNER JOIN user ON payment.user_ID = user.user_ID WHERE `payment_ID`='$payment_id'";

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_name = $row["fullname"];
                $payment_date = $row["date"];
                $payment_time = $row["time"];

                $payment_type = $row["type"];
            }
        }

        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', '', 24);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Cell(80, 40, '', 0, 0, 'c');
        $pdf->Cell(60, 40, 'SALES RECEIPT ', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', '', 12);

        /// customer details
        $pdf->Cell(20, 5, "Name________: $debtor_name", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "phone________: $debtor_phone", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Date_________: $payment_date", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Time_________: $payment_time", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Payment ID____: $payment_id", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(60, 5, '', 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 12);
        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Cell(60, 20, 'Transaction Details', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(30, 5, 'Quantity', 1, 0, 'C');
        $pdf->Cell(70, 5, 'Description', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Unit price', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Discount price', 1, 0, 'C');

        $pdf->Cell(30, 5, 'Amount', 1, 0, 'C');
        $pdf->Ln();

        // get order details through transaction ID 

        $sql = "SELECT `item_ID`, `crop`, `variety`, `class`, `quantity`,`price_per_kg`,`discount_price`,`total_price` FROM
 `item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID WHERE `order_ID`='$order_id'";
        global $con;


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

                //transaction table

                $pdf->SetFont('Times', '', '', 10);
                $pdf->Cell(30, 5, $quantity, 1, 0, 'C');
                $pdf->Cell(70, 5, "$crop / $variety / $class", 1, 0, 'C');
                $pdf->Cell(30, 5, $price, 1, 0, 'C');
                $pdf->Cell(30, 5, $discount, 1, 0, 'C');
                $pdf->Cell(30, 5, $total_price, 1, 0, 'C');
                $pdf->Ln();
            }
        }

        //Items total
        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(160, 5, 'GRAND TOTAL', 0, 0, 'R');
        $pdf->Cell(30, 5, "$total", 1, 0, 'C');
        $pdf->Ln();


        $pdf->Cell(60, 5, '', 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();

        // payment details 


        $pdf->SetFont('Times', 'B', '', 12);
        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Cell(60, 20, 'Payment Details', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(50, 5, 'Payment Method', 1, 0, 'C');
        $pdf->Cell(90, 5, 'Description', 1, 0, 'C');
        $pdf->Cell(50, 5, 'Payment Amount', 1, 0, 'C');
        $pdf->Ln();




        $sql = "SELECT `payment_ID`, `type`, `description`,`amount`,user.fullname
 FROM `payment` INNER JOIN user ON payment.user_ID = user.user_ID  WHERE `payment_ID`='$payment_id'";
        global $con;



        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


                $payment_type = $row["type"];
                $description  = $row["description"];
                $amount = $row["amount"];
                $user_name = $row["fullname"];

                //retrieve payment details

                $pdf->SetFont('Times', '', '', 10);
                $pdf->Cell(50, 5, $payment_type, 1, 0, 'C');
                $pdf->Cell(90, 5, $description, 1, 0, 'C');
                $pdf->Cell(50, 5, $amount, 1, 0, 'C');
                $pdf->Ln();
            }
        }

        $pdf->Cell(60, 5, '', 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Cell(60, 40, '', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(60, 5, "Issued by: $user_name", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(100, 10, 'Signature : .........................', 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(60, 5, 'With thanks', 0, 0, '');
        $pdf->Ln();



        $pdf->Output();
    }











    function create_delivery_note()
    {

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', '', 24);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Cell(80, 60, '', 0, 0, 'c');
        $pdf->Cell(60, 35, 'DELIVERY NOTE', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', '', 12);

        $pdf->Cell(20, 5, "Date________:", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Time________:", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Transaction ID_____:", 0, 0, '');

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(30, 5, 'NO', 1, 0, 'C');
        $pdf->Cell(130, 5, 'Description', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Quantity', 1, 0, 'C');
        $pdf->Ln();

        $i = 1;
        while ($i <= 20) {

            $pdf->SetFont('Times', '', '', 10);
            $pdf->Cell(30, 5, $i, 1, 0, 'C');
            $pdf->Cell(130, 5, '', 1, 0, 'C');
            $pdf->Cell(30, 5, '', 1, 0, 'C');
            $pdf->Ln();
            $i++;
        }
        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(160, 5, 'TOTAL QUANTITY', 0, 0, 'R');
        $pdf->Cell(30, 5, "", 1, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(100, 5, "Issued by: ", 0, 0, '');
        $pdf->Cell(100, 5, "Received by: ................................................. ", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
        $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();


        $pdf->Output();
    }

    function create_invoice()
    {

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', '', 24);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Cell(80, 60, '', 0, 0, 'c');
        $pdf->Cell(60, 35, 'DELIVERY NOTE', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', '', 12);

        $pdf->Cell(20, 5, "Date________:", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Time________:", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Transaction ID_____:", 0, 0, '');

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(30, 5, 'NO', 1, 0, 'C');
        $pdf->Cell(130, 5, 'Description', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Quantity', 1, 0, 'C');
        $pdf->Ln();

        $i = 1;
        while ($i <= 20) {

            $pdf->SetFont('Times', '', '', 10);
            $pdf->Cell(30, 5, $i, 1, 0, 'C');
            $pdf->Cell(130, 5, '', 1, 0, 'C');
            $pdf->Cell(30, 5, '', 1, 0, 'C');
            $pdf->Ln();
            $i++;
        }
        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(160, 5, 'TOTAL QUANTITY', 0, 0, 'R');
        $pdf->Cell(30, 5, "", 1, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(100, 5, "Issued by: ", 0, 0, '');
        $pdf->Cell(100, 5, "Received by: ................................................. ", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
        $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();


        $pdf->Output();
    }














    function create_handover()
    {

        $grade_ID = $_GET['grade_id'];

        $sql = "SELECT `grade_ID`, `assigned_date`, `assigned_time`,user.fullname,
      `assigned_quantity`,crop.crop,variety.variety,stock_in.class FROM `grading`
     INNER JOIN stock_in ON stock_in.stock_in_ID = grading.stock_in_ID
     INNER JOIN user ON grading.assigned_by = user.user_ID
      INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID 
      INNER JOIN variety ON variety.variety_ID = stock_in.variety_ID WHERE `grade_ID`= '$grade_ID';";

        global $con;
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $grade_ID = $row["grade_ID"];
                $assigned_date = $row["assigned_date"];
                $assigned_time = $row["assigned_time"];
                $fullname = $row["fullname"];
            }
        }

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', '', 24);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Cell(80, 60, '', 0, 0, 'c');
        $pdf->Cell(60, 35, 'SEED HANDOVER', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', '', 12);

        $pdf->Cell(20, 5, "Date________: $assigned_date", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Time________: $assigned_time", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Grade ID_____: $grade_ID", 0, 0, '');

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(30, 5, 'NO', 1, 0, 'C');
        $pdf->Cell(130, 5, 'Description', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Quantity', 1, 0, 'C');
        $pdf->Ln();
        $i = 1;
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {



                $crop  = $row["crop"];
                $variety = $row["variety"];
                $class = $row["class"];
                $quantity = $row["assigned_quantity"];

                //retrieve payment details



                $pdf->SetFont('Times', '', '', 10);
                $pdf->Cell(30, 5, $i++, 1, 0, 'C');
                $pdf->Cell(130, 5, "$crop / $variety / $class", 1, 0, 'C');
                $pdf->Cell(30, 5, $quantity, 1, 0, 'C');
                $pdf->Ln();
            }
        }





        while ($i <= 20) {

            $pdf->SetFont('Times', '', '', 10);
            $pdf->Cell(30, 5, $i, 1, 0, 'C');
            $pdf->Cell(130, 5, '', 1, 0, 'C');
            $pdf->Cell(30, 5, '', 1, 0, 'C');
            $pdf->Ln();
            $i++;
        }
        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(160, 5, 'TOTAL QUANTITY', 0, 0, 'R');
        $pdf->Cell(30, 5, "$quantity", 1, 0, 'C');
        $pdf->Ln();

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(100, 5, "Issued by: $fullname ", 0, 0, '');
        $pdf->Cell(100, 5, "Received by: ................................................. ", 0, 0, '');

        $pdf->Ln();

        $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
        $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');

        $pdf->Ln();


        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();

        $pdf->Cell(100, 10, "                                                           Supervised by: ................................................. ", 0, 0, '');

        $pdf->Ln();
        $pdf->Cell(100, 10, '                                                            Signature : ....................................................', 0, 0, '');

        $pdf->Ln();
        $pdf->Cell(190, 0, '', 1, 0, '');
        $pdf->Ln();


        $pdf->Output();
    }

































    //
    function create_dispatch_note()
    {
        $user_ID = $_SESSION['user'];
        $fullname = "";
        $issued_fullname = "";
        $transaction_ID =  $_GET['transaction_ID'];
        $order_ID = $_GET['order_ID'];
        $total_quantity = $_GET['total_quantity'];

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', '', 24);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Cell(80, 60, '', 0, 0, 'c');
        $pdf->Cell(60, 35, 'DISPATCH NOTE', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', '', 12);
        $date = date("d-m-Y");
        $time = date("H:i:s");

        $pdf->Cell(20, 5, "Date___________:$date", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Time___________:$time", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(20, 5, "Transaction ID__:$transaction_ID", 0, 0, '');

        $pdf->Cell(60, 20, '', 0, 0, 'C');
        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        $pdf->Cell(30, 5, 'NO', 1, 0, 'C');
        $pdf->Cell(130, 5, 'Description', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Quantity', 1, 0, 'C');
        $pdf->Ln();

        $sql = "SELECT `item_ID`, `crop`, `variety`, `class`, `quantity`,`price_per_kg`,`discount_price`,`stock_out_quantity`,`total_price` FROM
        `item`INNER JOIN crop ON item.crop_ID = crop.crop_ID INNER JOIN variety ON item.variety_ID = variety.variety_ID WHERE `order_ID`='$order_ID'";
        global $con;
        $i = 1;

        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {


                $crop   = $row["crop"];
                $variety = $row["variety"];
                $class = $row["class"];
                $stock_out_quantity = $row['stock_out_quantity'];


                //transaction table



                $pdf->SetFont('Times', '', '', 10);
                $pdf->Cell(30, 5, $i++, 1, 0, 'C');
                $pdf->Cell(130, 5, "$crop / $variety / $class", 1, 0, 'C');
                $pdf->Cell(30, 5, $stock_out_quantity, 1, 0, 'C');
                $pdf->Ln();
            }


            while ($i <= 20) {

                $pdf->SetFont('Times', '', '', 10);
                $pdf->Cell(30, 5, $i, 1, 0, 'C');
                $pdf->Cell(130, 5, '', 1, 0, 'C');
                $pdf->Cell(30, 5, '', 1, 0, 'C');
                $pdf->Ln();
                $i++;
            }
            $pdf->SetFont('Times', 'B', '', 10);
            $pdf->Cell(160, 5, 'TOTAL QUANTITY', 0, 0, 'R');
            $pdf->Cell(30, 5, "$total_quantity", 1, 0, 'C');
            $pdf->Ln();

            $pdf->Cell(60, 20, '', 0, 0, 'C');
            $pdf->Ln();

            $sql = "SELECT fullname FROM `user` WHERE `user_ID`='$user_ID'";

            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {


                    $fullname = $row["fullname"];
                }
            }

            $sql = "SELECT fullname FROM `order_table` INNER JOIN `user` ON user.user_ID = order_table.user_ID WHERE `order_ID`= '$order_ID' ";

            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {


                    $issued_fullname = $row["fullname"];
                }
            }
            $pdf->SetFont('Times', 'B', '', 10);
            $pdf->Cell(100, 5, "Issued by : $fullname", 0, 0, '');
            $pdf->Cell(100, 5, "Received by: $issued_fullname", 0, 0, '');
            $pdf->Ln();

            $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
            $pdf->Cell(100, 10, 'Signature : ....................................................', 0, 0, '');
            $pdf->Ln();

            $pdf->Cell(190, 0, '', 1, 0, '');
            $pdf->Ln();


            $pdf->Output();
        }
    }

    function create_labels()
    {


        $number = $_GET['lot_number'];
        
        $sql = "SELECT `lot_number`, `crop`,`variety`, `class`,
    `date_tested`, `expiry_date` FROM `certificate` 
    INNER JOIN crop ON crop.crop_ID = certificate.crop_ID
     INNER JOIN variety ON variety.variety_ID = certificate.variety_ID WHERE `lot_number` = '$number'";
        global $con;
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {



                $lot_number = $row["lot_number"];
                $crop = $row["crop"];
                $variety = $row["variety"];
                $class = $row["class"];
                $tested_date = $row["date_tested"];
                $expire_date = $row["expiry_date"];
            }
        }

        $object = new main();
        $test_date = $object->change_date_format($tested_date);
        $exp_date = $object->change_date_format($expire_date);

        $pdf = new labels_pdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        /// Manyi you can do bettter

        $pdf->SetFont('Times', 'B', '', 10);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        // $pdf->Cell(80, 40, '', 0, 0, 'c');
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(10, 10, 'Multi Seeds Company LTD ', 0);





        $pdf->Ln();
        $pdf->SetFont('', '', '', 8);

        /// customer details
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(30, 5, "Crop: $crop", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(20, 5, "Variety: $variety", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(20, 5, "Class: $class", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(20, 5, "lot Number:", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(20, 5, "$lot_number", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(20, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(20, 5, "Expire Date: $exp_date", 0, 0, '');

        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        // $pdf->Cell(80, 40, '', 0, 0, 'c');
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(10, 10, 'Multi Seeds Company LTD ', 0);





        $pdf->Ln();
        $pdf->SetFont('', '', '', 8);

        /// customer details
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(30, 5, "Crop: $crop", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(20, 5, "Variety: $variety", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(20, 5, "Class: $class", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(20, 5, "lot Number:", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(20, 5, "$lot_number", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(20, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(20, 5, "Expire Date: $exp_date", 0, 0, '');

        $pdf->Ln();


        $pdf->SetFont('Times', 'B', '', 10);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        // $pdf->Cell(80, 40, '', 0, 0, 'c');
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(10, 10, 'Multi Seeds Company LTD ', 0);





        $pdf->Ln();
        $pdf->SetFont('', '', '', 8);

        /// customer details
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(30, 5, "Crop: $crop", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(20, 5, "Variety: $variety", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(20, 5, "Class: $class", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(20, 5, "lot Number:", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(20, 5, "$lot_number", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(20, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(20, 5, "Expire Date: $exp_date", 0, 0, '');

        $pdf->Ln();
        $pdf->SetFont('Times', 'B', '', 10);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        // $pdf->Cell(80, 40, '', 0, 0, 'c');
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(10, 10, 'Multi Seeds Company LTD ', 0);





        $pdf->Ln();
        $pdf->SetFont('', '', '', 8);

        /// customer details
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(30, 5, "Crop: $crop", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(20, 5, "Variety: $variety", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(20, 5, "Class: $class", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(20, 5, "lot Number:", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(20, 5, "$lot_number", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(20, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(20, 5, "Expire Date: $exp_date", 0, 0, '');

        $pdf->Ln();


        

        $pdf->SetFont('Times', 'B', '', 10);
        // for($i=1;$i<=20;$i++)
        //     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        // $pdf->Cell(80, 40, '', 0, 0, 'c');
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(70, 10, 'Multi Seeds Company LTD ', 0);
        $pdf->Cell(10, 10, 'Multi Seeds Company LTD ', 0);





        $pdf->Ln();
        $pdf->SetFont('', '', '', 8);

        /// customer details
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(70, 5, "Crop: $crop", 0, 0, '');
        $pdf->Cell(30, 5, "Crop: $crop", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(70, 5, "Variety: $variety", 0, 0, '');
        $pdf->Cell(20, 5, "Variety: $variety", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(70, 5, "Class: $class", 0, 0, '');
        $pdf->Cell(20, 5, "Class: $class", 0, 0, '');
        $pdf->Ln();
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(70, 5, "lot Number:", 0, 0, '');
        $pdf->Cell(20, 5, "lot Number:", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(70, 5, "$lot_number", 0, 0, '');
        $pdf->Cell(20, 5, "$lot_number", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(70, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Cell(20, 5, "Tested Date: $test_date", 0, 0, '');
        $pdf->Ln();

        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(70, 5, "Expire Date: $exp_date", 0, 0, '');
        $pdf->Cell(20, 5, "Expire Date: $exp_date", 0, 0, '');




        
       



        $pdf->Output();
    }
}


$object = new pdf_handler();
switch ($pdf_type) {
    case "receipt":
        $object->create_receipt();
        break;

    case "dispatch_note":
        $object->create_dispatch_note();
        break;

    case "delivery_note":
        $object->create_delivery_note();
        break;

    case "invoice":
        $object->create_invoice();
        break;

    case "handover":
        $object->create_handover();
        break;

    case "labels":
        $object->create_labels();
        break;
}

// if ($pdf_type="receipt"){
//         $object = new pdf_handler();
//         $object->create_receipt();

//         }

//  else if ($pdf_type = "dispatch_note") {
//     $object = new pdf_handler();
//     $object->create_dispatch_note();
// }      


//  if($pdf_type="invoice"){
//         $object = new pdf_handler();
//         $object->create_invoice();


// if($pdf_type="delivery_note"){
//         $object = new pdf_handler();
//         $object->create_delivery_note();

//         }

// /
















?>

