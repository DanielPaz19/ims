-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2021 at 01:48 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorymanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(30) NOT NULL,
  `bank_code` varchar(30) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_code`, `bank_name`) VALUES
(1, 'BPI', 'BPI'),
(2, 'BDO', 'BDO'),
(3, 'PNB', 'PNB'),
(4, 'East West Bank', 'East West Bank'),
(5, 'Landbank', 'Landbank'),
(6, 'AUB', 'AUB');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL,
  `customers_name` varchar(100) DEFAULT NULL,
  `customers_company` varchar(100) DEFAULT NULL,
  `customers_address` varchar(200) DEFAULT NULL,
  `customers_contact` varchar(30) DEFAULT NULL,
  `customers_note` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customers_id`, `customers_name`, `customers_company`, `customers_address`, `customers_contact`, `customers_note`) VALUES
(1, 'Customer1', 'asdasdsdsd', '213', '1231231123123', '123123'),
(2, 'Customer2', 'asdasd', 'dasdsd', 'asda', 'asdasd'),
(3, 'Customer3', 'gjg', 'ghj', 'hgj', 'sashjghj'),
(4, 'Customer4', 'adasd', 'asda', 'sdas', 'das'),
(5, 'Ramon Imbao', 'Ramon Imbao', 'Mountain Province', '', ''),
(6, 'Abby Sia', 'ABC Corporation', '321321 bako bako st. sabungan village brgy ayannglahat, balakayo jan City', '123456789909', 'none'),
(7, 'Neil Ramirez', 'Neil Ramirez', 'Malabon Manila', '123123', 'asdasd'),
(8, 'Roan Alvarez', 'Roan Alvarez', 'dasdsad', '123123', ''),
(9, 'Karl Siat', 'Karl Siat', 'Maybunga pasig City', '12312312312321', ''),
(10, 'Danielle Paz', 'Danielle Paz', 'Quezon City', '12321', '3123'),
(11, 'asdas', 'sadad', 'asdad', '12312', '3asdad'),
(12, 'Joy to the world', 'Joy to the world', 'Joy to the world', '12312312', '2sadasd'),
(13, 'Sample Company', 'Sample Company', 'Sample Company', 'Sample Company', 'Sample Company'),
(14, 'as', 'sa', 'as', 'as', 'as'),
(15, 'kjasdhaksjdh', 'asdhaskjdhaskjdh', 'kjsahdakjdhkasjh', 'dkjhasdkjash', 'sadlkjalkdjasdj'),
(16, 'hellomaniga', 'hellomaniga', 'Saturn St. Brgy Mabuhay, Pasig City', '09844652465', 'hellomaniga'),
(17, 'sample customer', 'sample customer', 'sample customer', 'sample customer', 'sample customer'),
(18, 'Dave Obera', 'PACC', 'Pasig', '1234', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE `order_payment` (
  `order_payment_id` int(50) NOT NULL,
  `payment_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `order_payment_debit` double NOT NULL,
  `order_payment_credit` double NOT NULL,
  `order_payment_balance` double NOT NULL,
  `order_payment_date` text NOT NULL,
  `order_payment_status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`order_payment_id`, `payment_id`, `order_id`, `order_payment_debit`, `order_payment_credit`, `order_payment_balance`, `order_payment_date`, `order_payment_status_id`) VALUES
(1, 0, 1, 0, 11900, 11900, '2021-10-12T15:10:57.554Z', 0),
(2, 1, 1, 900, 0, 11000, '2021-10-12T15:11:18.490Z', 0),
(3, 1, 1, 1000, 0, 10000, '2021-10-12T15:13:20.697Z', 0),
(4, 1, 1, 5000, 0, 5000, '2021-10-12T15:13:33.018Z', 0),
(5, 1, 1, 5000, 0, 0, '2021-10-12T15:13:48.966Z', 2),
(6, 0, 2, 0, 3400, 3400, '2021-10-12T15:20:47.633Z', 0),
(7, 1, 2, 400, 0, 3000, '2021-10-12T15:21:06.390Z', 0),
(8, 1, 2, 1500, 0, 1500, '2021-10-12T16:25:28.975Z', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_status`
--

CREATE TABLE `order_payment_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_payment_status`
--

INSERT INTO `order_payment_status` (`id`, `name`) VALUES
(1, 'account_receivable'),
(2, 'fully_paid'),
(0, 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `order_pay_receipt`
--

CREATE TABLE `order_pay_receipt` (
  `rcpt_id` int(50) NOT NULL,
  `order_payment_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `product_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `pos_temp_qty` double DEFAULT NULL,
  `pos_temp_price` double DEFAULT NULL,
  `pos_temp_disamount` double DEFAULT NULL,
  `pos_temp_tot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`product_id`, `order_id`, `pos_temp_qty`, `pos_temp_price`, `pos_temp_disamount`, `pos_temp_tot`) VALUES
(2, 1, 20, 250, 0, NULL),
(2, 2, 2, 250, 0, NULL),
(4, 1, 6, 800, 0, NULL),
(4, 2, 1, 800, 0, NULL),
(5, 1, 3, 700, 0, NULL),
(5, 2, 3, 700, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
(1, 'paid'),
(2, 'pending'),
(3, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `order_id` int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `customer_id` int(50) NOT NULL,
  `total` double NOT NULL,
  `pos_date` text NOT NULL,
  `order_status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`order_id`, `customer_id`, `total`, `pos_date`, `status_id`) VALUES
(1, 9, 11900, '2021-10-12T15:10:57.554Z', 1),
(2, 10, 3400, '2021-10-12T15:20:47.633Z', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(30) NOT NULL,
  `payment_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_name`) VALUES
(0, 'Initial'),
(1, 'Cash'),
(2, 'Online'),
(3, 'Cheque');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  `qty` double DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `pro_remarks` varchar(300) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  `barcode` varchar(10) DEFAULT NULL,
  `price` int(250) DEFAULT NULL,
  `cost` int(20) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `sup_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `class`, `qty`, `unit`, `pro_remarks`, `location`, `barcode`, `price`, `cost`, `dept`, `sup_id`) VALUES
(2, '000 1.5mm x 11-7/8in x 44-1/2in MM [MAC] A', 'CLEAR', 1978, 'sht ', ' none', 'B2AR18', 'ABCDEFG', 250, 99, 'FABRICATION', 0),
(3, '000 1.5mm x 12in x 48in MM B', 'CLEAR', -1101.9999526, 'sht ', 'W2=1 ', 'B2AR18', '', 900, 25, 'ACRYLIC', 0),
(4, '000 1.5mm x 13in x 38in MM B', 'CLEAR', 53, 'sht ', ' ', 'B4AP9', '', 800, 45, 'ACRYLIC', 0),
(5, '000 1.5mm x 17-15/16in x 23-5/16in MM [SUMIPEX] A', 'CLEAR', 244, 'sht ', ' ', 'B2AR18', '', 700, 50, 'ACRYLIC', 0),
(6, '000 1.5mm x 19-1/2in x 24in MM B', 'CLEAR', 123, 'sht ', 'USB=1 ', 'B2AR16', '', 600, 100, 'ACRYLIC', 0),
(7, '000 1.5mm x 21-1/2in x 27-1/2in MM A', 'CLEAR', -90, 'sht ', 'W1=1 ', 'B2AR19', '', 500, 0, 'ACRYLIC', 0),
(8, '000 1.5mm x 23-1/4in x 24in MM [SUMIPEX] A', 'CLEAR', 160, 'sht ', ' ', 'B2AR18', '', 400, 0, 'ACRYLIC', 0),
(9, '000 1.5mm x 23-5/8in x 48in MM B', 'CLEAR', 171, 'sht ', 'USB=1 ', 'B2AR18', '', 0, 0, 'ACRYLIC', 0),
(10, '000 1.5mm x 27in x 32in MM B', 'CLEAR', 76, 'sht ', 'USB=1 ', 'B2AR18', '', 0, 0, 'ACRYLIC', 0),
(11, '000 1.5mm x 31-3/8in x 48in MM [SUMIPEX] A', 'CLEAR', 180, 'sht ', ' ', 'B2AR18', '', 0, 0, 'ACRYLIC', 0),
(12, '000 1.5mm x 36in x 72in MM B', 'CLEAR', 102, 'sht ', 'USB=1 ', 'B2AR16', '', 0, 0, 'ACRYLIC', 0),
(13, '000 1.5mm x 4ft x 6ft MM [SUMIPEX] A', 'CLEAR', 102, 'sht ', ' ', 'B2AR19', '', 0, 0, 'ACRYLIC', 0),
(14, '000 1.5mm x 5-3/4in x 40in MM [MAC] A', 'CLEAR', 102, 'sht ', ' ', 'B2AR30', '', 0, 0, 'ACRYLIC', 0),
(15, '000 1.5mm x 7-3/4in x 72in MM [MAC] A', 'CLEAR', 102, 'sht ', ' ', 'B2AR30', '', 0, 0, 'ACRYLIC', 0),
(16, '000 1.5mm x 7in x 40in MM [PACC] A', 'CLEAR', 102, 'sht ', ' ', 'B2AR18', '', 0, 0, 'ACRYLIC', 0),
(17, '000 1.5mm x 8-1/2in x 72in MM [MAC] A', 'CLEAR', 102, 'sht ', ' ', 'B2AR18', '', 0, 0, 'ACRYLIC', 0),
(18, '000 1.5mm x 8in x 33-1/8in MM B', 'CLEAR', 102, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(19, '000 1.5mm x 9-7/8in x 72in MM [MAC] A', 'CLEAR', 101, 'sht ', ' ', 'B2AR18', '', 0, 0, 'ACRYLIC', 0),
(20, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=1 ', 'B2AR11', 'LG0602', 0, 0, 'ACRYLIC', 0),
(21, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=3 ', 'B2AR14', 'QA0502', 0, 0, 'ACRYLIC', 0),
(22, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=2 ', 'B2AR14', 'QA0303', 0, 0, 'ACRYLIC', 0),
(23, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=1 ', 'B2AR11', 'LO0802', 0, 0, 'ACRYLIC', 0),
(24, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=1 ', 'B2AR14', 'PU2803', 0, 0, 'ACRYLIC', 0),
(25, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'MB=3 ', 'B2AR14', 'QM2301', 0, 0, 'ACRYLIC', 0),
(26, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'MB=2 ', 'B2AR14', 'QM2302', 0, 0, 'ACRYLIC', 0),
(27, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'MB=3 ', 'B2AR15', 'RJ2906', 0, 0, 'ACRYLIC', 0),
(28, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=2 ', 'B2AR15', 'RJ2906', 0, 0, 'ACRYLIC', 0),
(29, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=4 ', 'B2AR15', 'LN1106', 0, 0, 'ACRYLIC', 0),
(30, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=2 ', 'B2AR15', 'LN1101', 0, 0, 'ACRYLIC', 0),
(31, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=1 ', 'B2AR15', 'LN1105', 0, 0, 'ACRYLIC', 0),
(32, '000 1.5mm x I KK B', 'CLEAR', 101, 'sht ', 'USB=1 ', 'B2AR14', 'QA0501', 0, 0, 'ACRYLIC', 0),
(33, '000 1.5mm x I KK C', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', 'QA1103', 0, 0, 'ACRYLIC', 0),
(34, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'USB=3 ', 'B2AR15', 'QM2301', 0, 0, 'ACRYLIC', 0),
(35, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'USB/PRE-SPLIT=1 ', 'B2AR21', 'OG2503', 0, 0, 'ACRYLIC', 0),
(36, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'USB/W1=1 ', 'B2AR15', 'OG2504', 0, 0, 'ACRYLIC', 0),
(37, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'W4=1 ', 'B2AR15', 'PD1905', 0, 0, 'ACRYLIC', 0),
(38, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'W3/PRE-SPLIT=1 ', 'B2AR21', 'PU2801', 0, 0, 'ACRYLIC', 0),
(39, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'USB/PRE-SPLIT=1 ', 'B2AR21', 'PU2805', 0, 0, 'ACRYLIC', 0),
(40, '000 1.5mm x I MM B', 'CLEAR', 101, 'sht ', 'W2=1 ', 'B2AR13', 'RF2203', 0, 0, 'ACRYLIC', 0),
(41, '000 1/16 x I KK B', 'CLEAR', 101, 'sht ', 'USB=5 ', 'B2AR15', 'KD1705', 0, 0, 'ACRYLIC', 0),
(42, '000 1/16 x I KK B', 'CLEAR', 101, 'sht ', 'USB=1 ', 'B2AR15', 'KD1704', 0, 0, 'ACRYLIC', 0),
(43, '000 1/2 x 15-1/2in x 19in MM B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(44, '000 1/2 x 6in x 11-1/2in MM B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(45, '000 1/2 x 8-1/2in x 30-1/8in K B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(46, '000 1/2 x 9-1/2in x 11in MM B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(47, '000 10.0mm x 10-15/16in x 19-15/16in MM B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(48, '000 10.0mm x 10in x 13-5/8in K B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(49, '000 10.0mm x 10in x 23-5/8in KK B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(50, '000 10.0mm x 10in x 48in K B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(51, '000 10.0mm x 11-7/8in x 31in MM B', 'CLEAR', 101, 'sht ', ' ', 'B4AP8', '', 0, 0, 'ACRYLIC', 0),
(52, 'ACRY SOLV MT 100ml', 'PRCG', 280, 'can', '', 'B2AR2', '', 180, 100, 'PRCG', 0),
(53, 'TEAR GAS', 'BOMBA', -10104.0004565, 'kgs', '', 'B2AR2', '', 900, 0, 'PRCG', 0),
(54, 'dsasd', 'adas', 21123, '213123', 'asdasd', 'dasdasd', '1adas', 12312, 12312, 'ddsad', 0),
(55, 'sample', 'sample', 123, 'pcs', 'sample', 'sample', 'sample', 123, 321, 'acrylic', 17),
(56, 'admin', 'admin', 123, 'admin', 'admin', 'admin', 'admin', 123, 123, 'admin', 18),
(57, 'dpp', 'dpp', 321, 'dpp', 'pdd', 'dpp', 'dpp', 123123, 321312, 'dpp', 0),
(58, 'Smoke Grenade', 'Bomb', 999, 'pcs', 'Di masyado mausok', 'Secret', 'AB1899', 99999, 99999, 'CODM', 28),
(59, 'Flash Grenade', 'Explosive', 99977, 'pcs', 'none', 'B2AR2', 'FG12345', 2900, 1900, 'Bomb Squad', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rcpt`
--

CREATE TABLE `rcpt` (
  `rcpt_id` int(50) NOT NULL,
  `trans_type_id` int(50) NOT NULL,
  `rcpt_date` date NOT NULL,
  `rcpt_type_id` int(50) NOT NULL,
  `rcpt_number` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rcpt_type`
--

CREATE TABLE `rcpt_type` (
  `rcpt_type_id` int(50) NOT NULL,
  `rcpt_type_name` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rcpt_type_number`
--

CREATE TABLE `rcpt_type_number` (
  `rcpt_type_id` int(50) NOT NULL,
  `rcpt_number` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sup_tb`
--

CREATE TABLE `sup_tb` (
  `sup_id` int(20) NOT NULL,
  `sup_id2` int(30) DEFAULT NULL,
  `sup_name` varchar(100) DEFAULT NULL,
  `sup_conper` varchar(50) DEFAULT NULL,
  `sup_tel` varchar(30) DEFAULT NULL,
  `sup_address` varchar(100) DEFAULT NULL,
  `sup_email` varchar(30) DEFAULT NULL,
  `sup_tin` varchar(30) DEFAULT NULL,
  `sup_terms` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup_tb`
--

INSERT INTO `sup_tb` (`sup_id`, `sup_id2`, `sup_name`, `sup_conper`, `sup_tel`, `sup_address`, `sup_email`, `sup_tin`, `sup_terms`) VALUES
(17, 1, 'Fabri Plast Industrial Corporation', 'VST', '12345678', 'San Miguel Pasig', 'fpic@gmail.com', '123456788', 'CREDIT'),
(18, 2, 'BGAN', 'CTG', '321321321', 'Binondo Manila', 'bgan@gmail.com', '123', 'CASH'),
(19, 3, 'Philippine National Bank', 'PCC', '12345678', 'Rosario, Pasig City ', 'acrychem@gmail.com', '123456', 'PDC'),
(22, 4, 'SMC', 'san mig', '3123123', 'Ortigas, Pasig City', 'smc@smc.com', '123123123', 'Change'),
(23, 5, 'Philippine Acrylic & Chemical Corporation', 'asdasd', '2131312', 'Mercedes Ave., Pasig City', 'asdadASdasd@gmail.com', '23123', 'asdasd'),
(24, 6, 'Aba Ca Da', 'Abby SIa', '123', 'Pateros MM', 'abc@gmail.com', '321312312', 'Change'),
(25, NULL, 'DPO Inc.', 'Dave Obera', '12345678', 'Pinagbuhatan, Pasig City', 'dave@obera.com', '32132121', '30 days PDC'),
(26, NULL, 'SMS Corporation', 'sismismi', '09292992', 'Malate, Manila', 'sms@gmail.com', '123456', '60days PDC'),
(27, NULL, 'asdsad', 'sad', 'sadsad', 'sadsad', 'asd@asdasd', 'sad', 'dasdsa'),
(28, NULL, 'cvvccvc', 'cvc', '321312', 'dfdfd', 'sdaasd@ashdkj.com', '123123', 'sadsadas'),
(29, NULL, 'asdasd', 'sdaasd', '12312', 'asdasd', 'asdasd@gmail.com', '12312312312', 'sadasdasd'),
(30, NULL, 'wffdf', 'dfdfdfdf', '212123123123', 'dfdf', 'dsfsdf@gmail.com', '213123123123', 'ddf'),
(31, NULL, 'Karl & karl', 'John Karl Siat', '123456789', 'Maybunga. Pasig City', 'kk@gmail.com', '3216544567897', 'Hulugan 5-6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indexes for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`order_payment_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`product_id`,`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `rcpt`
--
ALTER TABLE `rcpt`
  ADD PRIMARY KEY (`rcpt_id`);

--
-- Indexes for table `rcpt_type`
--
ALTER TABLE `rcpt_type`
  ADD PRIMARY KEY (`rcpt_type_id`);

--
-- Indexes for table `rcpt_type_number`
--
ALTER TABLE `rcpt_type_number`
  ADD PRIMARY KEY (`rcpt_type_id`,`rcpt_number`);

--
-- Indexes for table `sup_tb`
--
ALTER TABLE `sup_tb`
  ADD PRIMARY KEY (`sup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `order_payment_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `rcpt`
--
ALTER TABLE `rcpt`
  MODIFY `rcpt_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rcpt_type`
--
ALTER TABLE `rcpt_type`
  MODIFY `rcpt_type_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sup_tb`
--
ALTER TABLE `sup_tb`
  MODIFY `sup_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
