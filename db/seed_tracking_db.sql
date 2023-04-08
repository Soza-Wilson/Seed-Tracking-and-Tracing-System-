-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 11:10 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seed_tracking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `approval_ID` varchar(100) NOT NULL,
  `depertment` varchar(100) DEFAULT NULL,
  `action_name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `requested_id` varchar(100) DEFAULT NULL,
  `requested_name` varchar(100) DEFAULT NULL,
  `action_id` varchar(100) DEFAULT NULL,
  `approved_ID` varchar(100) DEFAULT NULL,
  `approval_code` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `bank_ID` varchar(100) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(100) DEFAULT NULL,
  `account_funds` int(11) DEFAULT NULL,
  `register_date` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `lot_number` varchar(100) NOT NULL,
  `crop_ID` varchar(100) DEFAULT NULL,
  `variety_ID` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `source_name` varchar(100) DEFAULT NULL,
  `date_tested` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `date_added` varchar(100) DEFAULT NULL,
  `certificate_quantity` int(11) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `assigned_quantity` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `creditor`
--

CREATE TABLE `creditor` (
  `creditor_ID` varchar(100) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `creditor_files` varchar(100) DEFAULT NULL,
  `registered_date` varchar(100) DEFAULT NULL,
  `account_funds` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `crop_ID` varchar(100) NOT NULL,
  `crop` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`crop_ID`, `crop`) VALUES
('CP001', 'maizeOPV'),
('CP0010', 'maizeHybrid'),
('CP002', 'gnuts_shelled'),
('CP003', 'gnuts_unshelled'),
('CP004', 'sorghum'),
('CP005', 'rice'),
('CP006', 'cowpea'),
('CP007', 'pigeonpea'),
('CP008', 'beans'),
('CP009', 'soyabean');

-- --------------------------------------------------------

--
-- Table structure for table `debtor`
--

CREATE TABLE `debtor` (
  `debtor_ID` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `debtor_type` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `debtor_files` varchar(100) DEFAULT NULL,
  `registered_date` varchar(100) DEFAULT NULL,
  `account_funds` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `farm_ID` varchar(100) NOT NULL,
  `Hectors` varchar(100) DEFAULT NULL,
  `crop_species` varchar(100) DEFAULT NULL,
  `crop_variety` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `area_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `physical_address` varchar(300) DEFAULT NULL,
  `EPA` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `creditor_ID` varchar(100) DEFAULT NULL,
  `registered_date` varchar(100) DEFAULT NULL,
  `previous_year_crop` varchar(100) DEFAULT NULL,
  `other_year_crop` varchar(100) DEFAULT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `main_lot_number` varchar(100) DEFAULT NULL,
  `main_quantity` varchar(100) DEFAULT NULL,
  `male_lot_number` varchar(100) DEFAULT NULL,
  `male_quantity` varchar(100) DEFAULT NULL,
  `female_lot_number` varchar(100) DEFAULT NULL,
  `female_quantity` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE `grading` (
  `grade_ID` varchar(100) NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `assigned_time` varchar(100) DEFAULT NULL,
  `assigned_quantity` int(11) DEFAULT NULL,
  `used_quantity` int(11) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `stock_in_ID` varchar(100) DEFAULT NULL,
  `assigned_by` varchar(100) DEFAULT NULL,
  `received_ID` varchar(100) DEFAULT NULL,
  `received_name` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `file_directory` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `inspection_ID` varchar(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `farm_ID` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `isolation` varchar(100) DEFAULT NULL,
  `planting_pattern` varchar(100) DEFAULT NULL,
  `off_type_percetage` varchar(100) DEFAULT NULL,
  `pest_disease_incidence` varchar(100) DEFAULT NULL,
  `defective_plants` varchar(100) DEFAULT NULL,
  `pollinating_females_percentage` varchar(100) DEFAULT NULL,
  `female_receptive_skills_percentage` varchar(100) DEFAULT NULL,
  `male_leimination` varchar(100) DEFAULT NULL,
  `off_type_cobs_at_shelling` varchar(100) DEFAULT NULL,
  `defective_cobs_at_shelling` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `image_directory` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_ID` varchar(100) NOT NULL,
  `order_ID` varchar(100) DEFAULT NULL,
  `crop_ID` varchar(100) DEFAULT NULL,
  `variety_ID` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `stock_out_quantity` int(11) DEFAULT NULL,
  `price_per_kg` varchar(100) DEFAULT NULL,
  `discount_price` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `total_price` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lab_test`
--

CREATE TABLE `lab_test` (
  `test_ID` varchar(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `crop_ID` varchar(100) DEFAULT NULL,
  `variety_ID` varchar(100) DEFAULT NULL,
  `farm_ID` varchar(100) DEFAULT NULL,
  `germination_percentage` varchar(100) DEFAULT NULL,
  `moisture_content` varchar(100) DEFAULT NULL,
  `oil_content` varchar(100) DEFAULT NULL,
  `shelling_percentage` varchar(100) DEFAULT NULL,
  `purity_percentage` varchar(100) DEFAULT NULL,
  `defects_percentage` varchar(100) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `stock_in_ID` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `test_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `ledger_ID` varchar(100) NOT NULL,
  `ledger_type` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `bank_ID` varchar(100) DEFAULT NULL,
  `transaction_ID` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `reference_bank_amount` int(11) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `entry_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `order_ID` varchar(100) NOT NULL,
  `order_type` varchar(100) DEFAULT NULL,
  `customer_id` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `order_book_number` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `count` varchar(100) DEFAULT NULL,
  `total_amount` varchar(100) DEFAULT NULL,
  `order_files` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` varchar(100) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `documents` varchar(100) DEFAULT NULL,
  `cheque_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `transaction_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `prices_ID` varchar(100) NOT NULL,
  `crop_ID` varchar(100) DEFAULT NULL,
  `variety_ID` varchar(100) DEFAULT NULL,
  `sell_basic` varchar(100) DEFAULT NULL,
  `sell_pre_basic` varchar(100) DEFAULT NULL,
  `sell_certified` varchar(100) DEFAULT NULL,
  `buy_basic` varchar(100) DEFAULT NULL,
  `buy_pre_basic` varchar(100) DEFAULT NULL,
  `buy_certified` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`prices_ID`, `crop_ID`, `variety_ID`, `sell_basic`, `sell_pre_basic`, `sell_certified`, `buy_basic`, `buy_pre_basic`, `buy_certified`) VALUES
('PRC001', 'CP001', 'VT001', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0010', 'CP002', 'VT0010', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0011', 'CP003', 'VT0011', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0012', 'CP003', 'VT0012', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0013', 'CP003', 'VT0013', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0014', 'CP003', 'VT0014', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0015', 'CP003', 'VT0015', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0016', 'CP004', 'VT0016', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0017', 'CP005', 'VT0017', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0018', 'CP005', 'VT0018', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0019', 'CP006', 'VT0019', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC002', 'CP001', 'VT002', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0020', 'CP007', 'VT0020', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0021', 'CP007', 'VT0021', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0022', 'CP008', 'VT0022', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0023', 'CP008', 'VT0023', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0024', 'CP008', 'VT0024', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0025', 'CP008', 'VT0025', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0026', 'CP009', 'VT0026', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC0027', 'CP009', 'VT0027', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC003', 'CP001', 'VT003', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC004', 'CP001', 'VT004', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC005', 'CP001', 'VT005', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC006', 'CP002', 'VT006', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC007', 'CP002', 'VT007', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC008', 'CP002', 'VT008', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('PRC009', 'CP002', 'VT009', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `process_seed`
--

CREATE TABLE `process_seed` (
  `process_ID` varchar(100) NOT NULL,
  `assigned_quantity` int(11) DEFAULT NULL,
  `processed_date` date DEFAULT NULL,
  `processed_time` varchar(100) DEFAULT NULL,
  `grade_ID` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `process_type`
--

CREATE TABLE `process_type` (
  `process_type_ID` varchar(100) NOT NULL,
  `process_ID` varchar(100) DEFAULT NULL,
  `grade_outs_quantity` int(11) DEFAULT NULL,
  `processed_quantity` int(11) DEFAULT NULL,
  `trash_quantity` int(11) DEFAULT NULL,
  `process_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_ID` varchar(100) NOT NULL,
  `crop_ID` varchar(100) DEFAULT NULL,
  `variety_ID` varchar(100) DEFAULT NULL,
  `pre_basic` varchar(100) DEFAULT NULL,
  `basic` varchar(100) DEFAULT NULL,
  `certified` varchar(100) DEFAULT NULL,
  `stock_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_ID` varchar(100) NOT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `certificate_ID` varchar(100) DEFAULT NULL,
  `farm_ID` varchar(100) DEFAULT NULL,
  `creditor_ID` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `crop_ID` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `variety_ID` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `SLN` varchar(100) DEFAULT NULL,
  `bincard` varchar(100) DEFAULT NULL,
  `number_of_bags` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `used_quantity` int(11) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `processed_quantity` int(11) DEFAULT NULL,
  `grade_outs_quantity` int(11) DEFAULT NULL,
  `trash_quantity` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `supporting_dir` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_ID` varchar(100) NOT NULL,
  `item_ID` varchar(100) DEFAULT NULL,
  `stock_in_ID` varchar(100) DEFAULT NULL,
  `order_ID` varchar(100) DEFAULT NULL,
  `Quntity` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `entry_ID` int(11) NOT NULL,
  `user_ID` varchar(100) DEFAULT NULL,
  `crop` varchar(100) DEFAULT NULL,
  `variety` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `lot_number` varchar(100) DEFAULT NULL,
  `source_name` varchar(100) DEFAULT NULL,
  `GLN_number` varchar(100) DEFAULT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_ID` varchar(100) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `action_name` varchar(100) DEFAULT NULL,
  `action_ID` varchar(100) DEFAULT NULL,
  `C_D_ID` varchar(100) DEFAULT NULL,
  `transaction_price` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_time` varchar(100) DEFAULT NULL,
  `trans_status` varchar(100) DEFAULT NULL,
  `user_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` varchar(100) NOT NULL,
  `user_type_ID` int(10) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `registered_date` varchar(100) DEFAULT NULL,
  `postion` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_type_ID`, `fullname`, `DOB`, `sex`, `registered_date`, `postion`, `phone`, `email`, `password`) VALUES
('001', 1, 'ADMIN', '0000', '-', '0000', 'system_administrator', '0000', 'admin@example.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `user_type_ID` int(10) NOT NULL,
  `user_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`user_type_ID`, `user_type`) VALUES
(1, 'ADMIN'),
(2, 'PRODUCTION'),
(3, 'MARKETING'),
(4, 'M AND E'),
(5, 'FINANCE');

-- --------------------------------------------------------

--
-- Table structure for table `variety`
--

CREATE TABLE `variety` (
  `variety_ID` varchar(100) NOT NULL,
  `variety` varchar(100) DEFAULT NULL,
  `crop_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variety`
--

INSERT INTO `variety` (`variety_ID`, `variety`, `crop_ID`) VALUES
('VT001', 'MLERA_ZM_623', 'CP001'),
('VT0010', 'CG13', 'CP002'),
('VT0011', 'CHITALA', 'CP003'),
('VT0012', 'CG7', 'CP003'),
('VT0013', 'CG9', 'CP003'),
('VT0014', 'CG11', 'CP003'),
('VT0015', 'CG13', 'CP003'),
('VT0016', 'PILIRA1', 'CP004'),
('VT0017', 'FAYA_1469', 'CP005'),
('VT0018', 'KILOMBERO', 'CP005'),
('VT0019', 'SUDAN1', 'CP006'),
('VT002', 'THANZI_MH_44A', 'CP0010'),
('VT0020', 'CHITEDZE', 'CP007'),
('VT0021', 'MWAIWATHUALIMI', 'CP007'),
('VT0022', 'MNYAMBITILA', 'CP008'),
('VT0023', 'KHOLOPHETHE', 'CP008'),
('VT0024', 'NUA45', 'CP008'),
('VT0025', 'BALABALA', 'CP008'),
('VT0026', 'TIKOLORE', 'CP009'),
('VT0027 ', 'MAKWACHA', 'CP009'),
('VT003', 'MANTHU_MH_36', 'CP0010'),
('VT004', 'NTONDO_MH_35', 'CP0010'),
('VT005', 'LIMBA_ZM_523', 'CP001'),
('VT006', 'CHITALA', 'CP002'),
('VT007', 'CG7', 'CP002'),
('VT008', 'CG9', 'CP002'),
('VT009', 'CG11', 'CP002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`approval_ID`),
  ADD KEY `approved_ID` (`approved_ID`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`lot_number`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `crop_ID` (`crop_ID`),
  ADD KEY `variety_ID` (`variety_ID`);

--
-- Indexes for table `creditor`
--
ALTER TABLE `creditor`
  ADD PRIMARY KEY (`creditor_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`crop_ID`);

--
-- Indexes for table `debtor`
--
ALTER TABLE `debtor`
  ADD PRIMARY KEY (`debtor_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`farm_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `creditor_ID` (`creditor_ID`),
  ADD KEY `crop_species` (`crop_species`),
  ADD KEY `crop_variety` (`crop_variety`);

--
-- Indexes for table `grading`
--
ALTER TABLE `grading`
  ADD PRIMARY KEY (`grade_ID`),
  ADD KEY `assigned_by` (`assigned_by`),
  ADD KEY `stock_in_ID` (`stock_in_ID`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`inspection_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `farm_ID` (`farm_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `crop_ID` (`crop_ID`),
  ADD KEY `variety_ID` (`variety_ID`);

--
-- Indexes for table `lab_test`
--
ALTER TABLE `lab_test`
  ADD PRIMARY KEY (`test_ID`),
  ADD KEY `stock_in_ID` (`stock_in_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `crop_ID` (`crop_ID`),
  ADD KEY `variety_ID` (`variety_ID`),
  ADD KEY `farm_ID` (`farm_ID`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`ledger_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `bank_ID` (`bank_ID`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `transaction_ID` (`transaction_ID`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`prices_ID`),
  ADD KEY `crop_ID` (`crop_ID`);

--
-- Indexes for table `process_seed`
--
ALTER TABLE `process_seed`
  ADD PRIMARY KEY (`process_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `grade_ID` (`grade_ID`);

--
-- Indexes for table `process_type`
--
ALTER TABLE `process_type`
  ADD PRIMARY KEY (`process_type_ID`),
  ADD KEY `process_ID` (`process_ID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_ID`),
  ADD KEY `crop_ID` (`crop_ID`),
  ADD KEY `variety_ID` (`variety_ID`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`stock_in_ID`),
  ADD KEY `creditor_ID` (`creditor_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `crop_ID` (`crop_ID`),
  ADD KEY `variety_ID` (`variety_ID`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `stock_in_ID` (`stock_in_ID`),
  ADD KEY `item_ID` (`item_ID`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`entry_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `user_type_ID` (`user_type_ID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`user_type_ID`);

--
-- Indexes for table `variety`
--
ALTER TABLE `variety`
  ADD PRIMARY KEY (`variety_ID`),
  ADD KEY `crop_ID` (`crop_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`approved_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `certificate_ibfk_2` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`),
  ADD CONSTRAINT `certificate_ibfk_3` FOREIGN KEY (`variety_ID`) REFERENCES `variety` (`variety_ID`);

--
-- Constraints for table `creditor`
--
ALTER TABLE `creditor`
  ADD CONSTRAINT `creditor_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `debtor`
--
ALTER TABLE `debtor`
  ADD CONSTRAINT `debtor_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `farm`
--
ALTER TABLE `farm`
  ADD CONSTRAINT `farm_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `farm_ibfk_2` FOREIGN KEY (`creditor_ID`) REFERENCES `creditor` (`creditor_ID`),
  ADD CONSTRAINT `farm_ibfk_3` FOREIGN KEY (`crop_species`) REFERENCES `crop` (`crop_ID`),
  ADD CONSTRAINT `farm_ibfk_4` FOREIGN KEY (`crop_variety`) REFERENCES `variety` (`variety_ID`);

--
-- Constraints for table `grading`
--
ALTER TABLE `grading`
  ADD CONSTRAINT `grading_ibfk_1` FOREIGN KEY (`assigned_by`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `grading_ibfk_2` FOREIGN KEY (`stock_in_ID`) REFERENCES `stock_in` (`stock_in_ID`);

--
-- Constraints for table `inspection`
--
ALTER TABLE `inspection`
  ADD CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `inspection_ibfk_2` FOREIGN KEY (`farm_ID`) REFERENCES `farm` (`farm_ID`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order_table` (`order_ID`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`),
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`variety_ID`) REFERENCES `variety` (`variety_ID`);

--
-- Constraints for table `lab_test`
--
ALTER TABLE `lab_test`
  ADD CONSTRAINT `lab_test_ibfk_1` FOREIGN KEY (`stock_in_ID`) REFERENCES `stock_in` (`stock_in_ID`),
  ADD CONSTRAINT `lab_test_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `lab_test_ibfk_3` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`),
  ADD CONSTRAINT `lab_test_ibfk_4` FOREIGN KEY (`variety_ID`) REFERENCES `variety` (`variety_ID`),
  ADD CONSTRAINT `lab_test_ibfk_5` FOREIGN KEY (`farm_ID`) REFERENCES `farm` (`farm_ID`);

--
-- Constraints for table `ledger`
--
ALTER TABLE `ledger`
  ADD CONSTRAINT `ledger_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `ledger_ibfk_2` FOREIGN KEY (`bank_ID`) REFERENCES `bank_account` (`bank_ID`);

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`transaction_ID`) REFERENCES `transaction` (`transaction_ID`);

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`);

--
-- Constraints for table `process_seed`
--
ALTER TABLE `process_seed`
  ADD CONSTRAINT `process_seed_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `process_seed_ibfk_2` FOREIGN KEY (`grade_ID`) REFERENCES `grading` (`grade_ID`);

--
-- Constraints for table `process_type`
--
ALTER TABLE `process_type`
  ADD CONSTRAINT `process_type_ibfk_1` FOREIGN KEY (`process_ID`) REFERENCES `process_seed` (`process_ID`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`variety_ID`) REFERENCES `variety` (`variety_ID`);

--
-- Constraints for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `stock_in_ibfk_1` FOREIGN KEY (`creditor_ID`) REFERENCES `creditor` (`creditor_ID`),
  ADD CONSTRAINT `stock_in_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `stock_in_ibfk_3` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`),
  ADD CONSTRAINT `stock_in_ibfk_4` FOREIGN KEY (`variety_ID`) REFERENCES `variety` (`variety_ID`);

--
-- Constraints for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `stock_out_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `stock_out_ibfk_2` FOREIGN KEY (`stock_in_ID`) REFERENCES `stock_in` (`stock_in_ID`),
  ADD CONSTRAINT `stock_out_ibfk_3` FOREIGN KEY (`item_ID`) REFERENCES `item` (`item_ID`);

--
-- Constraints for table `storage`
--
ALTER TABLE `storage`
  ADD CONSTRAINT `storage_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_ID`) REFERENCES `usertype` (`user_type_ID`);

--
-- Constraints for table `variety`
--
ALTER TABLE `variety`
  ADD CONSTRAINT `variety_ibfk_1` FOREIGN KEY (`crop_ID`) REFERENCES `crop` (`crop_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
