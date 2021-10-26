-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 01:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

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
(1, 'asda', 'sda'),
(2, 'adas', 'dad'),
(3, 'sssss', 'ssssss');

-- --------------------------------------------------------

--
-- Table structure for table `class_tb`
--

CREATE TABLE `class_tb` (
  `class_id` int(250) NOT NULL,
  `class_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_tb`
--

INSERT INTO `class_tb` (`class_id`, `class_name`) VALUES
(1, 'CLEAR'),
(2, 'FABRICATION'),
(3, '881'),
(4, '622'),
(5, '7715'),
(6, '622'),
(7, '802'),
(8, '06136'),
(9, 'SERVICES'),
(10, '000-1.5mm'),
(11, 'ADHESIVE');

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
(18, 'hhh', 'hhhhhh', 'hh', 'hhh', 'hhh'),
(19, 'J9 Advertising', 'J9 Advertising', 'Pasig City', '321654', ''),
(20, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dept_tb`
--

CREATE TABLE `dept_tb` (
  `dept_id` int(250) NOT NULL,
  `dept_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dept_tb`
--

INSERT INTO `dept_tb` (`dept_id`, `dept_name`) VALUES
(1, 'PRCG'),
(2, 'FABRICATION'),
(3, 'ACRYLIC');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE `employee_tb` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `dept_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`emp_id`, `emp_name`, `dept_id`) VALUES
(1, 'L.Ramos', 2),
(2, 'D.PAZ', 2),
(3, 'D. OBERA', 1),
(4, 'M.BAGUINAON', 2),
(5, 'P. Relova', 1),
(6, 'C. Olog', 1),
(7, 'L. Rodriguez', 2);

-- --------------------------------------------------------

--
-- Table structure for table `loc_tb`
--

CREATE TABLE `loc_tb` (
  `loc_id` int(250) NOT NULL,
  `loc_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loc_tb`
--

INSERT INTO `loc_tb` (`loc_id`, `loc_name`) VALUES
(1, 'B2AR1'),
(2, 'B2AR2');

-- --------------------------------------------------------

--
-- Table structure for table `move_product`
--

CREATE TABLE `move_product` (
  `move_id` int(30) NOT NULL,
  `product_id` int(20) NOT NULL,
  `bal_qty` double NOT NULL,
  `in_qty` double NOT NULL,
  `out_qty` double NOT NULL,
  `mov_type_id` int(20) NOT NULL,
  `move_ref` int(20) NOT NULL,
  `mov_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `move_product`
--

INSERT INTO `move_product` (`move_id`, `product_id`, `bal_qty`, `in_qty`, `out_qty`, `mov_type_id`, `move_ref`, `mov_date`) VALUES
(1, 2, 0, 100, 0, 3, 3, '2021-09-22 06:17:34'),
(2, 1, 0, 100, 0, 3, 3, '2021-09-22 06:17:34'),
(3, 2, 100, 0, 97, 2, 5, '2021-09-22 06:19:13'),
(4, 1, 100, 0, 98, 2, 5, '2021-09-22 06:19:13'),
(5, 2, 3, 20, 0, 1, 8, '0000-00-00 00:00:00'),
(6, 1, 2, 10, 0, 1, 8, '0000-00-00 00:00:00'),
(7, 1, 12, 0, 10.00054, 2, 6, '2021-09-28 05:47:50'),
(8, 3, 100, 1, 0, 1, 9, '0000-00-00 00:00:00'),
(9, 7, 5, 1, 0, 1, 9, '0000-00-00 00:00:00'),
(10, 9, 14945, 1, 0, 1, 9, '0000-00-00 00:00:00'),
(11, 1, 1.99946, 1, 0, 1, 9, '0000-00-00 00:00:00'),
(12, 14, 100, 1, 0, 1, 9, '0000-00-00 00:00:00'),
(13, 1, 2.99946, 0, 5.0000045, 2, 7, '2021-09-29 08:04:27'),
(14, 2, 23, 1, 0, 1, 12, '0000-00-00 00:00:00'),
(15, 1, 99.1234567, 1, 0, 1, 12, '0000-00-00 00:00:00'),
(16, 2, 24, 0, 2, 2, 8, '2021-09-29 10:59:21'),
(17, 1, 100.1234567, 0, 2, 2, 8, '2021-09-29 10:59:21'),
(18, 1, 98.1234567, 123, 0, 1, 13, '2021-09-29 11:07:22'),
(19, 1, 221.1234567, 123, 0, 1, 14, '2021-10-01 03:37:02'),
(20, 2, 22, 25, 0, 1, 15, '2021-10-01 03:41:14'),
(21, 3, 101, 35, 0, 1, 15, '2021-10-01 03:41:14'),
(22, 7, 6, 500, 0, 1, 15, '2021-10-01 03:41:14'),
(23, 16, 123, 100, 0, 1, 15, '2021-10-01 03:41:14'),
(24, 1, 344.1234567, 30, 0, 1, 15, '2021-10-01 03:41:14'),
(25, 14, 101, 5001, 0, 1, 15, '2021-10-01 03:41:14'),
(26, 2, 47, 123, 0, 1, 11, '2021-10-02 11:05:58'),
(27, 1, 374.1234567, 666, 0, 1, 11, '2021-10-02 11:05:58'),
(28, 1, 1040.1234567, 33, 0, 1, 10, '2021-10-02 11:06:38'),
(29, 1, 1073.1234567, 1, 0, 1, 16, '2021-10-02 11:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `move_type`
--

CREATE TABLE `move_type` (
  `mov_type_id` int(20) NOT NULL,
  `mov_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `move_type`
--

INSERT INTO `move_type` (`mov_type_id`, `mov_type_name`) VALUES
(1, 'STOCK IN '),
(2, 'STOCK OUT'),
(3, 'RECIEVING'),
(4, 'pos');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE `order_payment` (
  `order_payment_id` int(50) NOT NULL,
  `payment_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `pos_temp_price` int(50) NOT NULL,
  `pos_temp_disamount` int(50) NOT NULL,
  `pos_temp_tot` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `order_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `pos_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'asdasd'),
(2, 'fdgdfg'),
(3, 'asdad'),
(4, 'asdasd'),
(5, 'efsdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `pinv_tb`
--

CREATE TABLE `pinv_tb` (
  `pinv_id` int(11) NOT NULL,
  `pinv_code` varchar(30) DEFAULT NULL,
  `pinv_title` varchar(30) DEFAULT NULL,
  `pinv_date` date DEFAULT NULL,
  `pinv_checkby` varchar(30) DEFAULT NULL,
  `pinv_appby` varchar(30) DEFAULT NULL,
  `pinv_remarks` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinv_tb`
--

INSERT INTO `pinv_tb` (`pinv_id`, `pinv_code`, `pinv_title`, `pinv_date`, `pinv_checkby`, `pinv_appby`, `pinv_remarks`) VALUES
(1, 'PHINV2021', 'checktesttitle', '2021-06-10', 'DEF', 'ABC', 'Remarks'),
(2, 'asdasd', 'sdasad', '2021-06-25', 'asdsa', 'dsasad', 'sadsadsad'),
(3, 'asdas', 'dsadasd', '2021-06-25', 'asdas', 'sad', 'sadasd'),
(4, 'sadasd', 'asdasd', '2021-06-25', 'dsasad', 'sad', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `po_product`
--

CREATE TABLE `po_product` (
  `product_id` int(250) NOT NULL,
  `po_id` int(250) NOT NULL,
  `item_qtyorder` int(20) DEFAULT NULL,
  `item_cost` double NOT NULL,
  `item_disamount` float DEFAULT NULL,
  `po_temp_tot` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_product`
--

INSERT INTO `po_product` (`product_id`, `po_id`, `item_qtyorder`, `item_cost`, `item_disamount`, `po_temp_tot`) VALUES
(1, 2, 100, 2600, 0, '260000.00'),
(1, 3, 100, 2600, 0, '260000.00'),
(2, 3, 100, 0, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `po_tb`
--

CREATE TABLE `po_tb` (
  `po_id` int(20) NOT NULL,
  `po_code` varchar(10) DEFAULT NULL,
  `po_title` varchar(20) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_remarks` varchar(300) DEFAULT NULL,
  `po_terms` varchar(250) DEFAULT NULL,
  `sup_id` int(30) DEFAULT NULL,
  `closed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_tb`
--

INSERT INTO `po_tb` (`po_id`, `po_code`, `po_title`, `po_date`, `po_remarks`, `po_terms`, `sup_id`, `closed`) VALUES
(2, 'po2', 'po2', '2021-09-22', 'po2', 'po2', 31, 1),
(3, 'PO321', 'PO321', '2021-09-22', 'PO321', 'PO321', 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `class_id` int(250) NOT NULL,
  `qty` double DEFAULT NULL,
  `unit_id` int(250) DEFAULT NULL,
  `pro_remarks` varchar(300) DEFAULT NULL,
  `loc_id` int(250) NOT NULL,
  `barcode` varchar(10) DEFAULT NULL,
  `price` int(250) DEFAULT NULL,
  `cost` int(20) DEFAULT NULL,
  `dept_id` int(250) DEFAULT NULL,
  `sup_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `class_id`, `qty`, `unit_id`, `pro_remarks`, `loc_id`, `barcode`, `price`, `cost`, `dept_id`, `sup_id`) VALUES
(1, '000 3.0mm x 48in x 96in MM A [MAC]', 9, 1074.1234567, 4, 'dfsdfsdf', 1, 'AB1899', 123, 321, 2, 0),
(2, 'ACRYPANEL/BJ: 000 30mmT x 322in x 322in ', 2, 170, 1, '234234234', 1, 'ASDASDASD', 123, 123123, 2, 0),
(3, '000 6.0mm x 41-1/4in x 92in  MM A', 3, 136, 1, 'asdasd', 2, 'adsad', 0, 0, 2, 0),
(4, 'LASER CUTTING', 1, 99999998, 2, 'asdjhaskdjhaskjdasd', 1, 'asdasd', 123123, 123123, 2, 0),
(5, 'asdasd', 3, 502, 2, 'asdasd', 1, 'asdasd', 0, 0, 2, 31),
(6, 'Sample Item', 3, 123, 1, 'asdasd', 2, '', 654654, 465465, 3, 0),
(7, 'ACRY BOX 000 x 4mmT x 16in x 16in x 13-1/2inH', 2, 506, 1, '', 1, '', 0, 0, 2, 0),
(8, 'ACRY TABLE SHIELD L SHAPE 000 3mmT x 120cm x 91cm x 85cm', 2, 2, 1, '', 0, '', 0, 0, 2, 0),
(9, 'BULLDOG SUPER GLUE', 2, 14946, 2, '100ml', 2, 'asdasd', 123, 90, 2, 31),
(10, 'sample item', 1, 100, 2, 'asdasd', 2, '', 0, 0, 1, 0),
(11, 'Sample Item', 1, 100, 1, 'sample', 1, 'sample', 100, 50, 2, 31),
(12, 'asdasd', 0, 123, 0, '', 0, '', 0, 0, 0, 0),
(13, 'ACRYPANEL [MAC]', 1, 100, 3, 'wala', 1, 'wala', 3200, 3000, 3, 1),
(14, '622-STN 3.0mm x 48in x 96in MM A', 4, 5102, 3, 'asd', 1, '', 3200, 2300, 3, 0),
(15, 'WATER', 2, 125.0004, 2, '', 1, '', 9999, 9822, 1, 25),
(16, 'FAX MACHINE 220v MOL-FAX-L38S S/N:GMR02', 9, 223, 2, '', 1, '', 0, 0, 2, 25),
(17, 'aaaa', 2, 12123, 2, 'asdasd', 2, 'asdasd', 123, 111, 2, 17),
(18, 'aa', 3, 2, 1, '', 1, '', 0, 0, 3, 0);

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
-- Table structure for table `srr_product`
--

CREATE TABLE `srr_product` (
  `product_id` int(255) NOT NULL,
  `srr_id` int(255) NOT NULL,
  `srr_qty` int(255) NOT NULL,
  `srr_ref` varchar(255) NOT NULL,
  `sup_id` int(255) NOT NULL,
  `srr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `srr_product`
--

INSERT INTO `srr_product` (`product_id`, `srr_id`, `srr_qty`, `srr_ref`, `sup_id`, `srr_date`) VALUES
(1, 2, 100, 'PO-02', 1, '0000-00-00'),
(1, 3, 1, 'PO-021', 17, '2021-09-30'),
(1, 4, 1, 'PO-01', 30, '2021-09-29'),
(3, 5, 11, 'ref2', 19, '2021-09-29'),
(14, 2, 200, 'PO-02', 2, '0000-00-00'),
(14, 4, 1, 'SI6592', 31, '2021-09-29'),
(14, 5, 10, 'ref1', 1, '2021-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `srr_tb`
--

CREATE TABLE `srr_tb` (
  `srr_id` int(255) NOT NULL,
  `srr_no` int(255) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `srr_tb`
--

INSERT INTO `srr_tb` (`srr_id`, `srr_no`, `emp_id`) VALUES
(2, 1, '2'),
(3, 0, '2'),
(4, 5001, '3'),
(5, 5002, '2');

-- --------------------------------------------------------

--
-- Table structure for table `stin_product`
--

CREATE TABLE `stin_product` (
  `product_id` int(50) NOT NULL,
  `stin_id` int(50) NOT NULL,
  `stin_temp_qty` double DEFAULT NULL,
  `stin_temp_cost` double DEFAULT NULL,
  `stin_temp_disamount` double DEFAULT NULL,
  `stin_temp_tot` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stin_product`
--

INSERT INTO `stin_product` (`product_id`, `stin_id`, `stin_temp_qty`, `stin_temp_cost`, `stin_temp_disamount`, `stin_temp_tot`) VALUES
(1, 2, 3123123, 321, 0, '202.99946'),
(1, 3, 3123123, 321, 0, '202.99946'),
(1, 4, 3123123, 321, 0, '202.99946'),
(1, 5, 3123123, 321, 0, '202.99946'),
(1, 6, 3123123, 321, 0, '202.99946'),
(1, 7, 3123123, 321, 0, '202.99946'),
(1, 8, 3123123, 321, 0, '202.99946'),
(1, 9, 3123123, 321, 0, '202.99946'),
(1, 10, 33, 321, 0, '123125.99946'),
(1, 11, 666, 321, 0, '1001.99946'),
(1, 12, 1, 321, 0, '321.00'),
(1, 13, 123, 321, 0, '39483.00'),
(1, 14, 123, 321, 0, '222.1234567'),
(1, 15, 30, 321, 0, '345.1234567'),
(1, 16, 1, 321, 0, '321.00'),
(2, 8, 20, 0, 0, '0.00'),
(2, 11, 123, 123123, 123, '143'),
(2, 12, 1, 123123, 0, '123123.00'),
(2, 15, 25, 123123, 0, '23'),
(3, 9, 1, 0, 0, '0.00'),
(3, 15, 35, 25, 0, '102'),
(7, 9, 1, 0, 0, '0.00'),
(7, 15, 500, 25, 1, '7'),
(9, 9, 1, 90, 0, '90.00'),
(14, 9, 1, 2300, 0, '2300.00'),
(14, 15, 5001, 2300, 0, '102'),
(16, 15, 100, 0, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `stin_tb`
--

CREATE TABLE `stin_tb` (
  `stin_id` int(20) NOT NULL,
  `stin_code` varchar(250) DEFAULT NULL,
  `stin_title` varchar(30) NOT NULL,
  `stin_date` date NOT NULL,
  `stin_remarks` varchar(250) NOT NULL,
  `emp_id` int(250) NOT NULL,
  `closed` tinyint(1) NOT NULL,
  `stin_close_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stin_tb`
--

INSERT INTO `stin_tb` (`stin_id`, `stin_code`, `stin_title`, `stin_date`, `stin_remarks`, `emp_id`, `closed`, `stin_close_date`) VALUES
(0, 'test1', 'test1', '2021-10-02', 'test1', 2, 0, '0000-00-00'),
(1, 'TON1', '', '0000-00-00', '', 0, 0, '0000-00-00'),
(2, 'TON2', 'TON2', '2021-09-22', 'TON2', 2, 1, '0000-00-00'),
(3, 'TOn3', 'TOn3', '2021-09-22', 'TOn3', 2, 1, '0000-00-00'),
(4, 'Ton5', 'Ton5', '2021-09-22', 'Ton5', 2, 1, '0000-00-00'),
(5, 'Ton6', 'Ton6', '2021-09-22', 'Ton6', 2, 1, '0000-00-00'),
(6, 'ton7', 'ton7', '2021-09-22', 'ton7', 1, 1, '0000-00-00'),
(7, 'asdasd', 'asdasd', '2021-09-22', 'asd', 2, 1, '0000-00-00'),
(8, 'TON-21', 'TON-21', '2021-09-22', 'TON-21', 3, 1, '0000-00-00'),
(9, 'TOn898', 'TOn898', '2021-09-28', 'TOn898', 2, 1, '0000-00-00'),
(10, 'Sample ASDASD', 'sdsd', '2021-09-28', 'sdsdsd', 3, 1, '0000-00-00'),
(11, 'TON123456', 'TON123456', '2021-09-29', 'TON123456', 2, 1, '0000-00-00'),
(12, 'TON-9', 'TON-9', '2021-09-29', 'TON-9', 2, 1, '0000-00-00'),
(13, 'asdasdasd', 'asdasdasd', '2021-09-29', 'asdasdasd', 3, 1, '0000-00-00'),
(14, 'SAMPLE', 'SAMPLE', '2021-10-07', 'SAMPLE', 3, 1, '0000-00-00'),
(15, 'SAMPLE CPDE1231123', 'SAMPLE CPDE', '2021-10-01', 'SAMPLE CPDE', 3, 1, '0000-00-00'),
(16, 'test1', 'test1', '2021-10-02', 'test1', 4, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `stout_product`
--

CREATE TABLE `stout_product` (
  `product_id` int(50) NOT NULL,
  `stout_id` int(50) NOT NULL,
  `stout_temp_qty` double DEFAULT NULL,
  `stout_temp_cost` double DEFAULT NULL,
  `stout_temp_disamount` double DEFAULT NULL,
  `stout_temp_tot` varchar(30) DEFAULT NULL,
  `stout_temp_remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stout_product`
--

INSERT INTO `stout_product` (`product_id`, `stout_id`, `stout_temp_qty`, `stout_temp_cost`, `stout_temp_disamount`, `stout_temp_tot`, `stout_temp_remarks`) VALUES
(1, 2, 100, 2600, 0, '260000.00', 'aaa'),
(1, 3, 2103, 2600, 0, '5467800.00', 'asdasd'),
(1, 4, 1, 2600, 0, '2600.00', ''),
(1, 5, 98, 2600, 0, '254800.00', 'asd'),
(1, 6, 10.00054, 321, 0, '3210.17', 'asasd'),
(1, 7, 5.0000045, 321, 0, '1605.00', 'asdasd'),
(1, 8, 32, 321, 12, '642.00', ''),
(1, 9, 25, 321, 0, '8025.00', 'Ci: 100mm x 100mm  - 100pcs'),
(2, 5, 97, 0, 0, '0.00', 'asdasdasdasd'),
(2, 8, 546546, 123123, 321, '246246.00', ''),
(2, 9, 26, 123123, 0, '3201198.00', 'CI: 200mm x 200mm - 200pcs');

-- --------------------------------------------------------

--
-- Table structure for table `stout_tb`
--

CREATE TABLE `stout_tb` (
  `stout_id` int(20) NOT NULL,
  `stout_code` varchar(30) DEFAULT NULL,
  `stout_title` varchar(30) DEFAULT NULL,
  `stout_date` date NOT NULL,
  `stout_remarks` varchar(300) DEFAULT NULL,
  `itemdesc` varchar(250) DEFAULT NULL,
  `emp_id` int(250) NOT NULL,
  `closed` tinyint(1) NOT NULL,
  `stout_close_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stout_tb`
--

INSERT INTO `stout_tb` (`stout_id`, `stout_code`, `stout_title`, `stout_date`, `stout_remarks`, `itemdesc`, `emp_id`, `closed`, `stout_close_date`) VALUES
(1, NULL, NULL, '0000-00-00', NULL, NULL, 0, 0, NULL),
(2, 'RS2', 'RS2', '2021-09-22', NULL, 'RS2', 2, 1, NULL),
(3, 'rs123', 'rs123', '2021-09-22', NULL, 'rs123', 2, 1, NULL),
(4, 'asdasd', 'asd', '2021-09-07', NULL, 'asdasd', 2, 1, NULL),
(5, 'RS-321654', '321456', '2021-09-22', NULL, 'asdasdasdasd', 2, 1, NULL),
(6, 'asdasdasdasd', 'asdasdasdasd', '2021-09-15', NULL, 'asdasdasdasd', 1, 1, NULL),
(7, 'asdad', 'asdasdsad', '2021-09-29', NULL, 'asdasd', 5, 1, NULL),
(8, 'RS3', '321321321', '2021-09-29', NULL, 'RS3', 2, 1, NULL),
(9, 'RSWwe', 'JOWwe', '2021-10-01', NULL, 'Acry Panel', 4, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sup_tb`
--

CREATE TABLE `sup_tb` (
  `sup_id` int(20) NOT NULL,
  `sup_name` varchar(100) DEFAULT NULL,
  `sup_conper` varchar(50) DEFAULT NULL,
  `sup_tel` varchar(30) DEFAULT NULL,
  `sup_address` varchar(100) DEFAULT NULL,
  `sup_email` varchar(30) DEFAULT NULL,
  `sup_tin` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup_tb`
--

INSERT INTO `sup_tb` (`sup_id`, `sup_name`, `sup_conper`, `sup_tel`, `sup_address`, `sup_email`, `sup_tin`) VALUES
(1, 'MODERN ART CORPORATION', 'Sample Tao', '092323232', 'Quezon CIty ', 'mac@gmail.com', '123123123'),
(17, 'Fabri Plast Industrial Corporation', 'VST', '12345678', 'San Miguel Pasig', 'fpic@gmail.com', '123456788'),
(18, 'BGAN', 'CTG', '321321321', 'Binondo Manila', 'bgan@gmail.com', '123'),
(19, 'Philippine National Bank', 'PCC', '12345678', 'Rosario, Pasig City ', 'acrychem@gmail.com', '123456'),
(22, 'SMC', 'san mig', '3123123', 'Ortigas, Pasig City', 'smc@smc.com', '123123123'),
(23, 'Philippine Acrylic & Chemical Corporation', 'asdasd', '2131312', 'Mercedes Ave., Pasig City', 'asdadASdasd@gmail.com', '23123'),
(24, 'Aba Ca Da', 'Abby SIa', '123', 'Pateros MM', 'abc@gmail.com', '321312312'),
(25, 'DPO Inc.', 'Dave Obera', '12345678', 'Pinagbuhatan, Pasig City', 'dave@obera.com', '32132121'),
(26, 'SMS Corporation', 'sismismi', '09292992', 'Malate, Manila', 'sms@gmail.com', '123456'),
(27, 'asdsad', 'sad', 'sadsad', 'sadsad', 'asd@asdasd', 'sad'),
(28, 'cvvccvc', 'cvc', '321312', 'dfdfd', 'sdaasd@ashdkj.com', '123123'),
(29, 'asdasd', 'sdaasd', '12312', 'asdasd', 'asdasd@gmail.com', '12312312312'),
(30, 'wffdf', 'dfdfdfdf', '212123123123', 'dfdf', 'dsfsdf@gmail.com', '213123123123'),
(31, 'Karl & karl', 'John Karl Siat', '123456789', 'Maybunga. Pasig City', 'kk@gmail.com', '3216544567897'),
(32, 'sample supllier', 'sample tao', '123', 'Muntinlupa City', 'asad@gmail.com', '213123');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `trans_type_id` int(50) NOT NULL,
  `trans_name` varchar(50) NOT NULL,
  `trans_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit_tb`
--

CREATE TABLE `unit_tb` (
  `unit_id` int(250) NOT NULL,
  `unit_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_tb`
--

INSERT INTO `unit_tb` (`unit_id`, `unit_name`) VALUES
(1, 'PCS'),
(2, 'KGS'),
(3, 'SHT'),
(4, 'MM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `class_tb`
--
ALTER TABLE `class_tb`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indexes for table `dept_tb`
--
ALTER TABLE `dept_tb`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `loc_tb`
--
ALTER TABLE `loc_tb`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `move_product`
--
ALTER TABLE `move_product`
  ADD PRIMARY KEY (`move_id`);

--
-- Indexes for table `move_type`
--
ALTER TABLE `move_type`
  ADD PRIMARY KEY (`mov_type_id`);

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
-- Indexes for table `pinv_tb`
--
ALTER TABLE `pinv_tb`
  ADD PRIMARY KEY (`pinv_id`);

--
-- Indexes for table `po_product`
--
ALTER TABLE `po_product`
  ADD PRIMARY KEY (`product_id`,`po_id`);

--
-- Indexes for table `po_tb`
--
ALTER TABLE `po_tb`
  ADD PRIMARY KEY (`po_id`);

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
-- Indexes for table `srr_product`
--
ALTER TABLE `srr_product`
  ADD PRIMARY KEY (`product_id`,`srr_id`);

--
-- Indexes for table `srr_tb`
--
ALTER TABLE `srr_tb`
  ADD PRIMARY KEY (`srr_id`);

--
-- Indexes for table `stin_product`
--
ALTER TABLE `stin_product`
  ADD PRIMARY KEY (`product_id`,`stin_id`);

--
-- Indexes for table `stin_tb`
--
ALTER TABLE `stin_tb`
  ADD PRIMARY KEY (`stin_id`);

--
-- Indexes for table `stout_product`
--
ALTER TABLE `stout_product`
  ADD PRIMARY KEY (`product_id`,`stout_id`);

--
-- Indexes for table `stout_tb`
--
ALTER TABLE `stout_tb`
  ADD PRIMARY KEY (`stout_id`);

--
-- Indexes for table `sup_tb`
--
ALTER TABLE `sup_tb`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`trans_type_id`);

--
-- Indexes for table `unit_tb`
--
ALTER TABLE `unit_tb`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_tb`
--
ALTER TABLE `class_tb`
  MODIFY `class_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dept_tb`
--
ALTER TABLE `dept_tb`
  MODIFY `dept_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_tb`
--
ALTER TABLE `employee_tb`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loc_tb`
--
ALTER TABLE `loc_tb`
  MODIFY `loc_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `move_product`
--
ALTER TABLE `move_product`
  MODIFY `move_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `move_type`
--
ALTER TABLE `move_type`
  MODIFY `mov_type_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `order_payment_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `srr_tb`
--
ALTER TABLE `srr_tb`
  MODIFY `srr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sup_tb`
--
ALTER TABLE `sup_tb`
  MODIFY `sup_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `unit_tb`
--
ALTER TABLE `unit_tb`
  MODIFY `unit_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
