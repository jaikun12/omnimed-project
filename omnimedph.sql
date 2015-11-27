-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2015 at 06:40 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omnimedph`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_admin_info`(IN `a_admin_id` INT(11), IN `a_username` VARCHAR(55), IN `a_name` VARCHAR(55), IN `a_password` VARCHAR(55), IN `a_location` VARCHAR(100), IN `a_shipping_address` VARCHAR(100), IN `a_tel_number` VARCHAR(20))
INSERT INTO admin_info_table
	(
		admin_id, 
      	username, 
        name, 
        password, 
        location, 
        shipping_address,
       	tel_number
    )
	VALUES 
    ( 
   		a_admin_id, 
      	a_username, 
        a_name, 
      	a_password, 
       	a_location, 
       	a_shipping_address,
        a_tel_number    
    )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_amount`(IN `a_quantity` INT(255), IN `a_purchaseOrder` INT(100), IN `a_client` VARCHAR(100), IN `a_articleId` VARCHAR(100))
    NO SQL
Update order_table Set `quantity` = a_quantity where purchase_order = a_purchaseOrder AND client_name = a_client AND article_no=a_articleId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_client_info`(IN `a_client_id` INT(11), IN `a_username` VARCHAR(55), IN `a_company_name` VARCHAR(55), IN `a_password` VARCHAR(55), IN `a_location` VARCHAR(100), IN `a_shipping_address` VARCHAR(100), IN `a_tel_num` VARCHAR(20), IN `a_fax_num` VARCHAR(20))
INSERT INTO client_info_table
	(
		client_id, 
      	username, 
        company_name, 
        password, 
        location, 
        shipping_address,
       	tel_num,
        fax_num
    )
VALUES 
    ( 
   		a_client_id, 
      	a_username, 
        a_company_name, 
      	a_password, 
       	a_location, 
       	a_shipping_address,
        a_tel_num,
        a_fax_num
    )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_notif_qty`(IN `client` VARCHAR(50), IN `po_num` INT(20), IN `art_num` VARCHAR(20), IN `p_change` VARCHAR(20), IN `p_prev_qty` INT(20), IN `p_new_qty` INT(20))
    NO SQL
INSERT INTO notifications_table(
    client_name,
    purchase_order,
    article_no,
    changes,
    prev_qty,
    new_qty,
	user_read)
    VALUES(
        client,
        po_num,
        art_num,
        p_change,
        p_prev_qty,
        p_new_qty,
    	0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_notif_rmv`(IN `client` VARCHAR(50), IN `po_num` INT(20), IN `art_num` VARCHAR(20), IN `p_change` VARCHAR(20))
    NO SQL
INSERT INTO notifications_table(
    client_name,
    purchase_order,
    article_no,
    changes,
    prev_qty,
    new_qty)
   	VALUES(
        client,
        po_num,
        art_num,
        p_change,
        '',
        '',
    	0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_order`(IN `a_purchase_order` INT(11), IN `a_client_name` VARCHAR(30), IN `a_article` VARCHAR(30), IN `a_article_no` VARCHAR(30), IN `a_description` VARCHAR(100), IN `a_location` VARCHAR(100), IN `a_quantity` INT(11), IN `a_code` VARCHAR(30))
    NO SQL
INSERT INTO order_table(
    purchase_order,
    client_name,
    article,
    article_no,
    description,
    location,
    quantity,
    code 
    )
    VALUES(
        a_purchase_order,
   	 	a_client_name,
    	a_article,
    	a_article_no,
    	a_description,
    	a_location,
    	a_quantity,
    	a_code
        )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_order_info`(IN `a_purchase_order` INT(11), IN `a_client_name` VARCHAR(30), IN `a_shipping_address` VARCHAR(300), IN `a_ship_to_location` VARCHAR(100), IN `a_shipped_date` DATE, IN `a_volume` DECIMAL(10,0), IN `a_invoice_no` INT(11), IN `a_status` VARCHAR(10))
    NO SQL
INSERT INTO order_info_table(
    purchase_order,
    client_name,
    shipping_address,
    ship_to_location,
    shipped_date,
    volume,
    invoice_no,
    status
    )
    VALUES(
        a_purchase_order,
    	a_client_name,
   		a_shipping_address,
    	a_ship_to_location,
    	a_shipped_date,
    	a_volume,
    	a_invoice_no,
    	a_status
        )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user`(IN `a_username` VARCHAR(55), IN `a_password` VARCHAR(55), IN `a_role` VARCHAR(10))
INSERT INTO users_table(
    username,
    passsword,
    role
    )
    VALUES(
        a_username,
        a_password,
        a_role
        )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_admin_info`(IN `d_username` VARCHAR(55))
    NO SQL
DELETE FROM `admin_info_table` WHERE username = d_username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_client_info`(IN `d_username` VARCHAR(55))
    NO SQL
DELETE FROM `client_info_table` WHERE username = d_username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_users`(IN `d_username` VARCHAR(55))
    NO SQL
DELETE FROM `users_table` WHERE username = d_username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_order_status`(IN `client` VARCHAR(50), IN `order_number` INT(12))
    NO SQL
UPDATE order_info_table SET status = "On Production" WHERE client_name = client AND purchase_order = order_number$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info_table`
--

CREATE TABLE IF NOT EXISTS `admin_info_table` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `location` varchar(100) NOT NULL,
  `shipping_address` varchar(100) NOT NULL,
  `tel_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info_table`
--

INSERT INTO `admin_info_table` (`admin_id`, `username`, `name`, `password`, `location`, `shipping_address`, `tel_number`) VALUES
(1, 'admin1', 'omnimed', '1234', 'Location, Philippines', '23 Cabrera Rd., Bgy Dolores Taytay Rizal, Philippines', '632 650 3189'),
(2, 'admin2', 'Mae', '1234', 'Manila', 'Philippines', '16001600');

-- --------------------------------------------------------

--
-- Table structure for table `client_info_table`
--

CREATE TABLE IF NOT EXISTS `client_info_table` (
  `client_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `company_name` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `location` varchar(100) NOT NULL,
  `shipping_address` varchar(100) NOT NULL,
  `tel_num` varchar(20) NOT NULL,
  `fax_num` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_info_table`
--

INSERT INTO `client_info_table` (`client_id`, `username`, `company_name`, `password`, `location`, `shipping_address`, `tel_num`, `fax_num`) VALUES
(1, 'client1', 'Salzmann AG', '1234', 'Zuerich, Switzerland', 'Salzmann MEDICO Rorschacherstrasse 304 CH 9016 St. Gallen', '+41 71 2821212  ', '+41 71 2821211');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_table`
--

CREATE TABLE IF NOT EXISTS `notifications_table` (
  `order_key` int(20) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `purchase_order` int(20) NOT NULL,
  `article_no` varchar(20) NOT NULL,
  `changes` varchar(50) NOT NULL,
  `prev_qty` int(20) NOT NULL,
  `new_qty` int(20) NOT NULL,
  `time` timestamp(2) NOT NULL DEFAULT CURRENT_TIMESTAMP(2) ON UPDATE CURRENT_TIMESTAMP(2),
  `user_read` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications_table`
--

INSERT INTO `notifications_table` (`order_key`, `client_name`, `purchase_order`, `article_no`, `changes`, `prev_qty`, `new_qty`, `time`, `user_read`) VALUES
(1, 'Salzmann AG', 513348, 'KN66502', 'Changed Quantity', 100, 200, '2015-11-27 04:56:32.93', 1),
(2, 'Salzmann AG', 513348, 'KN66502', 'Removed', 0, 0, '2015-11-27 04:56:32.93', 1),
(3, 'Salzmann AG', 513348, 'OM85143', 'Changed Quantity', 30, 50, '2015-11-27 05:19:31.49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_info_table`
--

CREATE TABLE IF NOT EXISTS `order_info_table` (
  `order_key` int(20) NOT NULL,
  `purchase_order` int(11) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `shipping_address` varchar(300) NOT NULL,
  `ship_to_location` varchar(100) NOT NULL,
  `shipped_date` date DEFAULT NULL,
  `volume` decimal(10,0) DEFAULT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_info_table`
--

INSERT INTO `order_info_table` (`order_key`, `purchase_order`, `client_name`, `shipping_address`, `ship_to_location`, `shipped_date`, `volume`, `invoice_no`, `status`, `issue_date`) VALUES
(6, 513348, 'Salzmann AG', 'Salzmann MEDICO Rorschacherstrasse 304 CH 9016 St. Gallen', 'Zuerich, Switzerland', NULL, NULL, NULL, 'On Production', '2015-11-19 14:28:03'),
(7, 423532, 'Salzmann AG', 'Salzmann MEDICO Rorschacherstrasse 304 CH 9016 St. Gallen', 'Zuerich, Switzerland', NULL, NULL, NULL, 'Shipped', '2015-11-20 06:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE IF NOT EXISTS `order_table` (
  `order_key` int(20) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `purchase_order` int(11) NOT NULL,
  `article` varchar(30) NOT NULL,
  `article_no` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `code` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`order_key`, `client_name`, `purchase_order`, `article`, `article_no`, `description`, `location`, `quantity`, `code`) VALUES
(1, 'Salzmann AG', 513348, ' ', 'KN66502', 'Ortho Manu Dual Wrist Brace', 'MEDICO', 200, 'ST'),
(2, 'Salzmann AG', 513348, ' ', 'OM85143', 'Intrinsic Plus 4 finger brace', 'MEDICO', 50, 'ST'),
(3, 'Salzmann AG', 513348, ' ', 'OM85148', 'Intrinsic Plus 4 finger brace', 'MEDICO', 20, 'ST'),
(4, 'Salzmann AG', 513348, ' ', 'OM85211', 'Wrist splint', 'MEDICO', 20, 'ST'),
(5, 'Salzmann AG', 513348, ' ', 'OM85214', 'Wrist splint', 'MEDICO', 15, 'ST'),
(6, 'Salzmann AG', 513348, ' ', 'OM85217', 'Wrist splint', 'MEDICO', 15, 'ST'),
(7, 'Salzmann AG', 513348, ' ', 'OM85219', 'Wrist splint', 'MEDICO', 20, 'ST'),
(8, 'Salzmann AG', 513348, ' ', 'OM85284', 'Protect Soft ThoraFix Easy Thorax Support', 'MEDICO', 80, 'ST'),
(9, 'Salzmann AG', 513348, ' ', 'OM85285', 'Protect Soft ThoraFix Easy Thorax Support', 'MEDICO', 50, 'ST'),
(10, 'Salzmann AG', 513348, ' ', 'OM87068', 'Ortho Omo Arm Sling with pad', 'MEDICO', 100, 'ST'),
(11, 'Salzmann AG', 513348, ' ', 'OM88158', 'Foot immobilizer with buckle', 'MEDICO', 24, 'ST'),
(12, 'Salzmann AG', 513348, ' ', 'OM87011', 'Intrinsic Plus 1 Finger pad, black', 'MEDICO', 70, 'ST'),
(13, 'Salzmann AG', 513348, ' ', 'OM87012', 'Intrin Plus 1 Finger pad, black', 'MEDICO', 30, 'ST'),
(14, 'Salzmann AG', 513348, ' ', 'OM87013', 'Intrin Plus 1 Finger pad, black', 'MEDICO', 50, 'ST'),
(15, 'Salzmann AG', 513348, ' ', 'SX50203', 'Ortho Manu CTS Wrist Brace', 'MEDICO', 10, 'ST'),
(16, 'Salzmann AG', 513348, ' ', 'SX50204', 'Ortho Manu CTS Wrist Brace', 'MEDICO', 20, 'ST'),
(17, 'Salzmann AG', 513348, ' ', 'TL29132', 'TALE Flexible Thumb Support', 'MEDICO', 10, 'ST'),
(18, 'Salzmann AG', 513348, ' ', 'TL30525', 'Rib Belt for Ladies', 'MEDICO', 70, 'ST'),
(19, 'Salzmann AG', 513348, ' ', 'TL30601', '3 Panel Abdominal Binder', 'MEDICO', 60, 'ST'),
(20, 'Salzmann AG', 513348, ' ', 'TL30611', '4 Panel Abdominal Binder', 'MEDICO', 20, 'ST'),
(21, 'Salzmann AG', 513348, ' ', 'TL30612', '4 Panel Abdominal Binder', 'MEDICO', 40, 'ST'),
(22, 'Salzmann AG', 423532, ' ', 'OM85214', 'Wrist splint', 'MEDICO', 15, 'ST'),
(23, 'Salzmann AG', 423532, ' ', 'OM85284', 'Protect Soft ThoraFix Easy Thorax Support', 'MEDICO', 80, 'ST'),
(24, 'Salzmann AG', 423532, ' ', 'OM85285', 'Protect Soft ThoraFix Easy Thorax Support', 'MEDICO', 50, 'ST'),
(25, 'Salzmann AG', 423532, ' ', 'OM88158', 'Foot immobilizer with buckle', 'MEDICO', 24, 'ST'),
(26, 'Salzmann AG', 423532, ' ', 'OM87011', 'Intrinsic Plus 1 Finger pad, black', 'MEDICO', 70, 'ST'),
(27, 'Salzmann AG', 423532, ' ', 'OM87012', 'Intrin Plus 1 Finger pad, black', 'MEDICO', 30, 'ST'),
(28, 'Salzmann AG', 423532, ' ', 'OM87013', 'Intrin Plus 1 Finger pad, black', 'MEDICO', 50, 'ST'),
(29, 'Salzmann AG', 423532, ' ', 'SX50203', 'Ortho Manu CTS Wrist Brace', 'MEDICO', 10, 'ST'),
(30, 'Salzmann AG', 423532, ' ', 'SX50204', 'Ortho Manu CTS Wrist Brace', 'MEDICO', 20, 'ST'),
(31, 'Salzmann AG', 423532, ' ', 'TL29132', 'TALE Flexible Thumb Support', 'MEDICO', 10, 'ST'),
(32, 'Salzmann AG', 423532, ' ', 'TL30525', 'Rib Belt for Ladies', 'MEDICO', 70, 'ST'),
(33, 'Salzmann AG', 423532, ' ', 'TL30601', '3 Panel Abdominal Binder', 'MEDICO', 60, 'ST'),
(34, 'Salzmann AG', 423532, ' ', 'TL30611', '4 Panel Abdominal Binder', 'MEDICO', 20, 'ST'),
(35, 'Salzmann AG', 423532, ' ', 'TL30612', '4 Panel Abdominal Binder', 'MEDICO', 40, 'ST');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_info`
--

CREATE TABLE IF NOT EXISTS `shipment_info` (
  `client_name` varchar(50) NOT NULL,
  `purchase_order` int(20) NOT NULL,
  `shipment_address` varchar(50) NOT NULL,
  `shipment_date` date NOT NULL,
  `box_mark` varchar(20) NOT NULL,
  `box_volume` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE IF NOT EXISTS `users_table` (
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`username`, `password`, `role`) VALUES
('admin1', '1234', 'admin'),
('client1', '1234', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info_table`
--
ALTER TABLE `admin_info_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `client_info_table`
--
ALTER TABLE `client_info_table`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `notifications_table`
--
ALTER TABLE `notifications_table`
  ADD PRIMARY KEY (`order_key`);

--
-- Indexes for table `order_info_table`
--
ALTER TABLE `order_info_table`
  ADD PRIMARY KEY (`order_key`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_key`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications_table`
--
ALTER TABLE `notifications_table`
  MODIFY `order_key` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_info_table`
--
ALTER TABLE `order_info_table`
  MODIFY `order_key` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `order_key` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
