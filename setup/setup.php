<?php

$con = mysqli_connect("localhost", "root", "");
$database = mysqli_query($con, "CREATE DATABASE IF NOT EXISTS seed_tracking_DB");

if ($database === true) {

  mysqli_select_db($con, "seed_tracking_DB");




  $sql = "CREATE TABLE usertype(user_type_ID INT(10) PRIMARY KEY, 		
    				 user_type varchar(100)
  							)";

  mysqli_query($con, $sql);

  $sql = "CREATE TABLE user(user_ID varchar(100) PRIMARY KEY, 
            user_type_ID INT(10),
    		fullname varchar(100),
			DOB varchar(100),
     sex varchar(100),
			registered_date varchar(100),
    		postion varchar(100),
			phone varchar(100),
    			 email varchar(100),
    			 		password varchar(100),

    			 		FOREIGN KEY(user_type_ID)REFERENCES usertype(user_type_ID)) ";


  mysqli_query($con, $sql);


  //crop table

  $sql = "CREATE TABLE crop (crop_ID varchar(100) PRIMARY KEY, 
      crop varchar(100))";

  /// variety table
  mysqli_query($con, $sql);

  $sql = "CREATE TABLE variety (variety_ID varchar(100) PRIMARY KEY, 
 variety varchar(100),
 crop_ID varchar(100),
 FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID))";

  mysqli_query($con, $sql);


  ///creditor table (goods in table. table type will specfy the source type)


  ///// table recording all stock available		
  $sql = "CREATE TABLE stock(stock_ID varchar(100) PRIMARY KEY,
                                   crop_ID varchar(100),
                                   variety_ID varchar(100),
                                   pre_basic varchar(100),
                                   basic varchar(100),
                                   certified varchar(100),
                                   stock_type varchar(100),
                                   FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID),
                                   FOREIGN KEY(variety_ID) REFERENCES variety(variety_ID))";

  mysqli_query($con, $sql);

  ///// table recording certificate details of all items added to stock

  $sql = "CREATE TABLE certificate(lot_number varchar(100) PRIMARY KEY,
                                    crop_ID varchar(100), 
                                    variety_ID varchar(100),
                                    class varchar(100),
                                    type varchar(100),
                                    source varchar(100),
                                    source_name varchar(100),
                                    date_tested varchar(100),
                                    expiry_date varchar(100),
                                    date_added varchar(100),
                                    certificate_quantity INT,
                                    available_quantity INT,
                                    assigned_quantity INT,
                                    status varchar(100),
                                    directory varchar(100),
                                    user_ID varchar(100), 
                                    FOREIGN KEY(user_ID) REFERENCES user(user_ID),
                                    FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID),
                                   FOREIGN KEY(variety_ID) REFERENCES variety(variety_ID))";

  mysqli_query($con, $sql);
  ////// creditor table (will store all details of the seed source )



  $sql = "CREATE TABLE creditor(creditor_ID varchar(100) PRIMARY KEY,
              source varchar(100), 
            name varchar(100),
           phone varchar(100),
            email varchar(100),
            description varchar(100),
            user_ID varchar(100), 
            creditor_files varchar(100),
            registered_date varchar(100),
            account_funds int,
            FOREIGN KEY(user_ID) REFERENCES user(user_ID))";


  mysqli_query($con, $sql);
// debtors (these will include agro dealer and customers )

  $sql = "CREATE TABLE debtor(debtor_ID varchar(100) PRIMARY KEY,
  
name varchar(100),
phone varchar(100),
email varchar(100),
description varchar(100),
debtor_type varchar(100),
user_ID varchar(100), 
debtor_files varchar(100),
registered_date varchar(100),
account_funds int,
FOREIGN KEY(user_ID) REFERENCES user(user_ID))";


mysqli_query($con, $sql);

///transaction table 

$sql = "CREATE TABLE transaction (transaction_ID varchar(100) PRIMARY KEY, 
type varchar(100),
action_name varchar(100),
action_ID varchar(100),
C_D_ID varchar(100),
amount varchar(100),
trans_date varchar(100),
trans_time varchar(100),

trans_status varchar(100),
user_ID varchar(100),
FOREIGN KEY(user_ID) REFERENCES user(user_ID))";

mysqli_query($con, $sql);


///payment table 

$sql= "CREATE TABLE payment(payment_ID varchar(100) PRIMARY KEY,
type varchar(100),amount int,description varchar(100),documents varchar(100),cheque_number varchar(100),bank_name varchar(100),
account_name varchar(100),date varchar(100),time varchar(100),
user_ID varchar(100),transaction_ID varchar(100),
FOREIGN KEY(user_ID) REFERENCES user(user_ID), 
FOREIGN KEY(transaction_ID)REFERENCES transaction(transaction_ID))";

mysqli_query($con, $sql);

  //farm table 

  $sql = "CREATE TABLE farm( farm_ID varchar(100) PRIMARY KEY,
Hectors varchar(100),     
  
       crop_species varchar(100), 
           crop_variety varchar(100),
               class varchar(100),
               region varchar(100),
               district varchar(100),
               area_name varchar(100),
               address varchar(100),
               physical_address varchar(300),
               EPA varchar(100),
               user_ID  varchar(100),
               creditor_ID varchar(100),
               registered_date varchar(100),
               previous_year_crop varchar(100),
               other_year_crop varchar(100),

               main_lot_number varchar(100),
              main_quantity varchar(100),
                                                                           
             male_lot_number varchar(100),
             male_quantity varchar(100),

             female_lot_number varchar(100),
             female_quantity varchar(100),


            FOREIGN KEY(user_ID) REFERENCES user(user_ID), 
               FOREIGN KEY(creditor_ID)REFERENCES creditor(creditor_ID), 
                     FOREIGN KEY(crop_species) REFERENCES crop(crop_ID),
                            FOREIGN KEY(crop_variety) REFERENCES variety(variety_ID))";


  mysqli_query($con, $sql);


/// Bank account table 

$sql = "CREATE TABLE bank_account(bank_ID varchar(100) PRIMARY KEY, 
bank_name varchar(100),
account_number varchar(100),
account_funds int,
register_date varchar(100),
user_ID varchar(100),
FOREIGN KEY(user_ID) REFERENCES user(user_ID))";

mysqli_query($con, $sql);


  ///// stock in (table reording all stock in transactions )    

  $sql = "CREATE TABLE stock_in(stock_in_ID varchar(100) PRIMARY KEY,
                                     user_ID varchar(100),
                                     certificate_ID varchar(100),
                                     farm_ID varchar(100),
                                     creditor_ID varchar(100),
                                     source varchar(100),
                                     crop_ID varchar(100),
                                     status varchar(100),
                                     variety_ID varchar(100),
                                     class varchar(100),
                                     SLN varchar(100),
                                     bincard varchar(100),
                                     number_of_bags varchar(100),
                                     quantity INT,
                                     used_quantity INT,
                                     available_quantity INT,
                                     description varchar(100),
                                     supporting_dir varchar(100),
                                     date varchar(100),
                                     time varchar(100),
                                     FOREIGN KEY(creditor_ID) REFERENCES creditor(creditor_ID),
                                     FOREIGN KEY(user_ID) REFERENCES user(user_ID),
                                     FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID),
                                   FOREIGN KEY(variety_ID) REFERENCES variety(variety_ID))";

  mysqli_query($con, $sql);


 
//// grading table 

$sql="CREATE TABLE grading( grade_ID varchar(100) PRIMARY KEY,
                           date varchar(100),
                           time varchar(100),
                           grade_out_quantity varchar(100),
                           trash_quantity varchar(100),
                           stock_in_ID varchar(100),
                           user_ID varchar(100),
                           FOREIGN KEY(user_ID) REFERENCES user(user_ID),
                           FOREIGN KEY(stock_in_ID) REFERENCES stock_in(stock_in_ID))";

mysqli_query($con, $sql);



// mysqli_query($con, $sql);



  $sql = "CREATE TABLE inspection( inspection_ID varchar(100) PRIMARY KEY,
   date varchar(100),
   time varchar(100),
   farm_ID varchar(100),
   user_ID varchar(100),
   type varchar(100),
   isolation varchar(100),
   planting_pattern varchar(100),
   off_type_percetage varchar(100),
   pest_disease_incidence varchar(100),
   defective_plants varchar(100),
   pollinating_females_percentage varchar(100),
   female_receptive_skills_percentage varchar(100),
   male_leimination varchar(100),
   off_type_cobs_at_shelling varchar(100),
   defective_cobs_at_shelling varchar(100),
   remarks varchar(100),
   image_directory varchar(100),


   FOREIGN KEY(user_ID) REFERENCES user(user_ID), 
                      FOREIGN KEY(farm_ID)REFERENCES farm(farm_ID))";

  mysqli_query($con, $sql);



  $sql = "CREATE TABLE storage (entry_ID int(11) PRIMARY KEY, 
     				user_ID varchar(100),crop varchar(100), 
     						variety varchar(100), 
     							class varchar(100),
     								 quantity varchar(100),
     								 	 source varchar(100), 
     								 	 	lot_number varchar(100), 
     								 	 	source_name varchar(100),
     								 	 		GLN_number varchar(100),
     								 	 			receiver_name varchar(100),
     								 	 					 date varchar(100),
     								 	 					 		time varchar(100),description varchar(300), FOREIGN KEY(user_ID)REFERENCES user(user_ID))";

  mysqli_query($con, $sql);




  $sql = "CREATE TABLE price (prices_ID varchar(100) PRIMARY KEY, 
crop_ID varchar(100),
variety_ID varchar(100),
sell_basic varchar(100),
sell_pre_basic varchar(100),
sell_certified varchar(100),
buy_basic varchar(100),
buy_pre_basic varchar(100),
buy_certified varchar(100),
FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID))";

  mysqli_query($con, $sql);

  //// user place order table
  $sql = "CREATE TABLE order_table( order_ID varchar(100) PRIMARY KEY,
                                      
                                    order_type varchar(100),  
                                    customer_id varchar(100),
                                    customer_name varchar(100),
	                          order_book_number varchar(100),
		                             user_ID varchar(100),            
							                    status varchar(100),
							                      date varchar(100),
							                      time varchar(100),
                                    count varchar(100),
						                      	total_amount varchar(100),
								
							
                 FOREIGN KEY(user_ID) REFERENCES user(user_ID))";

  mysqli_query($con, $sql);


  ///user add item to placed order (item table )


  $sql = "CREATE TABLE Item( item_ID varchar(100) PRIMARY KEY, 
                              order_ID varchar(100),
							                 crop_ID varchar(100),
							                  variety_ID varchar(100),
							                    class varchar(100),
                                  quantity INT,
                                  stock_out_quantity INT,
                                  price_per_kg varchar(100),
                                  discount_price varchar(100),
                                  status varchar(100),
								                  total_price varchar(100),
                                  FOREIGN KEY(order_ID) REFERENCES order_table(order_ID),
                                  FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID),
                                  FOREIGN KEY(variety_ID) REFERENCES variety(variety_ID))";

  mysqli_query($con, $sql);

  ///// stock out table( table recording all stock out details)


  $sql = "CREATE TABLE stock_out(stock_out_ID varchar(100) PRIMARY KEY,
                                 item_ID varchar(100),
                                 stock_in_ID varchar(100),
                                 order_ID varchar(100),
                                 Quntity INT,
                                 amount INT,
                                 date varchar(100),
                                 time varchar(100),
                                 user_ID varchar(100),
                                 FOREIGN KEY(user_ID) REFERENCES user(user_ID),
                                 FOREIGN KEY(stock_in_ID) REFERENCES stock_in(stock_in_ID),
                                 FOREIGN KEY(item_ID) REFERENCES item(item_ID)
                                 )";

// , 
// FOREIGN KEY(stock_in_ID) REFERENCES stock_in(stock_in_ID), 
// FOREIGN KEY(item) REFERENCES item(item_ID)

  mysqli_query($con, $sql);

  // create lab test table 

  $sql = "CREATE TABLE lab_test(test_ID varchar(100)  PRIMARY KEY, 
                                 date varchar(100),
                                 time varchar(100),
                                 crop_ID varchar(100),
							                   variety_ID varchar(100),
                                 farm_ID varchar(100),
                                 germination_percentage varchar(100),
                                 shelling_percentage varchar(100),
                                 purity_percentage varchar(100),
                                 defects_percentage varchar(100),
                                 grade varchar(100),
                                 stock_in_ID varchar(100),
                                 user_ID varchar(100),    
                                 test_status varchar(100),
                                 FOREIGN KEY(stock_in_ID) REFERENCES stock_in(stock_in_ID),
                                 FOREIGN KEY(user_ID) REFERENCES user(user_ID),
                                 FOREIGN KEY(crop_ID) REFERENCES crop(crop_ID),
                                  FOREIGN KEY(variety_ID) REFERENCES variety(variety_ID),
                                  FOREIGN KEY(farm_ID)REFERENCES farm(farm_ID)
                                 )";


  mysqli_query($con, $sql);





  $sql = "insert into usertype
values ('001','ADMIN'),
('2','PRODUCTION'),
('3','MARKETING'),
 ('4','M AND E'),

('5','FINANCE');";

  mysqli_query($con, $sql);

  $sql = "insert into user
values ('001','01','ADMIN','0000','-','0000','system_administrator','0000','admin@example.com','0000');";

  mysqli_query($con, $sql);

  $sql = "INSERT INTO `crop`(`crop_ID`, `crop`) VALUES ('CP001','maize'),
('CP002','gnuts_shelled'),
('CP003','gnuts_unshelled'),
('CP004','sorghum'),
('CP005','rice'),
('CP006','cowpea'),
('CP007','pigeonpea'),
('CP008','beans'),
('CP009','soyabean')";

  mysqli_query($con, $sql);


  $sql = "INSERT INTO `variety`(`variety_ID`, `variety`, `crop_ID`)
VALUES ('VT001','MLERA_ZM_623','CP001'),
('VT002','THANZI_MH_44A','CP001'),
('VT003','MANTHU_MH_36','CP001'),
('VT004','NTONDO_MH_35','CP001'),
('VT005','LIMBA_ZM_523','CP001'),
('VT006','CHITALA','CP002'),
('VT007','CG7','CP002'),
('VT008','CG9','CP002'),
('VT009','CG11','CP002'),
('VT0010','CG13','CP002'),
('VT0011','CHITALA','CP003'),
('VT0012','CG7','CP003'),
('VT0013','CG9','CP003'),
('VT0014','CG11','CP003'),
('VT0015','CG13','CP003'),
('VT0016','PILIRA1','CP004'),
('VT0017','FAYA_1469','CP005'),
('VT0018','KILOMBERO','CP005'),
('VT0019','SUDAN1','CP006'),
('VT0020','CHITEDZE','CP007'),
('VT0021','MWAIWATHUALIMI','CP007'),
('VT0022','MNYAMBITILA','CP008'),
('VT0023','KHOLOPHETHE','CP008'),
('VT0024','NUA45','CP008'),
('VT0025','BALABALA','CP008'),
('VT0026','TIKOLORE','CP009'),
('VT0027 ','MAKWACHA','CP009')";

  mysqli_query($con, $sql);

  $sql = "INSERT INTO `price`(`prices_ID`, `crop_ID`, `variety_ID`, `sell_basic`, `sell_pre_basic`, `sell_certified`,`buy_basic`,`buy_pre_basic`,`buy_certified`) 
VALUES ('PRC001','CP001','VT001','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC002','CP001','VT002','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC003','CP001','VT003','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC004','CP001','VT004','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC005','CP001','VT005','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC006','CP002','VT006','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC007','CP002','VT007','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC008','CP002','VT008','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC009','CP002','VT009','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0010','CP002','VT0010','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0011','CP003','VT0011','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0012','CP003','VT0012','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0013','CP003','VT0013','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0014','CP003','VT0014','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0015','CP003','VT0015','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0016','CP004','VT0016','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0017','CP005','VT0017','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0018','CP005','VT0018','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0019','CP006','VT0019','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0020','CP007','VT0020','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0021','CP007','VT0021','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0022','CP008','VT0022','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0023','CP008','VT0023','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0024','CP008','VT0024','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0025','CP008','VT0025','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0026','CP009','VT0026','0.00','0.00','0.00','0.00','0.00','0.00'),
('PRC0027','CP009','VT0027','0.00','0.00','0.00','0.00','0.00','0.00')";

  mysqli_query($con, $sql);



}
