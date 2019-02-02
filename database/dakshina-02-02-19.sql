-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2019 at 06:56 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dakshina`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_master`
--

DROP TABLE IF EXISTS `class_master`;
CREATE TABLE IF NOT EXISTS `class_master` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `class_tution_fees` int(11) NOT NULL,
  `class_fees_deadline` date NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_name` (`class_name`),
  KEY `dept_id` (`dept_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='table for class records';

--
-- Dumping data for table `class_master`
--

INSERT INTO `class_master` (`class_id`, `class_name`, `dept_id`, `class_tution_fees`, `class_fees_deadline`, `created_at`, `updated_at`) VALUES
(1, 'BCA SEM-1', 1, 5000, '2019-02-05', 1549003792, 1549004116);

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

DROP TABLE IF EXISTS `department_master`;
CREATE TABLE IF NOT EXISTS `department_master` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='table for deparmtnet records';

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`dept_id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, 'Computer', 1549003747, 1549003747);

-- --------------------------------------------------------

--
-- Table structure for table `extra_fees_details_structure`
--

DROP TABLE IF EXISTS `extra_fees_details_structure`;
CREATE TABLE IF NOT EXISTS `extra_fees_details_structure` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `fees_name` varchar(255) NOT NULL,
  `fees_amt` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `fees_name` (`fees_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table maintains extra fees details';

-- --------------------------------------------------------

--
-- Table structure for table `fees_receipt_records`
--

DROP TABLE IF EXISTS `fees_receipt_records`;
CREATE TABLE IF NOT EXISTS `fees_receipt_records` (
  `fee_receipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receipt_date` datetime NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `stud_class_id` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `late_fees` int(11) NOT NULL,
  `final_total` int(11) NOT NULL,
  `description` text NOT NULL,
  `mode_of_payment` int(11) NOT NULL COMMENT '1 = Cash , 2 = cheqno , 3 = Online',
  `payment_id` varchar(255) NOT NULL,
  `payed_amount` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  PRIMARY KEY (`fee_receipt_id`),
  KEY `stud_id` (`stud_id`,`user_id`,`stud_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table records fees receipt';

-- --------------------------------------------------------

--
-- Table structure for table `fees_receipt_records_details`
--

DROP TABLE IF EXISTS `fees_receipt_records_details`;
CREATE TABLE IF NOT EXISTS `fees_receipt_records_details` (
  `row_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fees_receipt_id` int(11) NOT NULL,
  `heading_name` varchar(255) NOT NULL,
  `fees_amt` int(11) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `row_id` int(11) NOT NULL,
  `settings_key` varchar(255) NOT NULL,
  `settings_value` varchar(255) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `bank_account_no` (`settings_value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table for bank accounts for amount to deposits';

-- --------------------------------------------------------

--
-- Table structure for table `student_master`
--

DROP TABLE IF EXISTS `student_master`;
CREATE TABLE IF NOT EXISTS `student_master` (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `enroll_no` int(11) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `stud_gender` varchar(10) DEFAULT NULL,
  `stud_father_name` varchar(255) NOT NULL,
  `stud_mobile_no` bigint(10) NOT NULL,
  `stud_class_id` int(11) NOT NULL,
  `stud_sem_no` int(11) NOT NULL,
  PRIMARY KEY (`stud_id`),
  UNIQUE KEY `enroll_no` (`enroll_no`),
  KEY `stud_class_id` (`stud_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='student details table ';

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `user_master`;
CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_type_id` int(1) NOT NULL COMMENT '1=admin,2=simple',
  `user_mobile` bigint(10) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`user_email`),
  UNIQUE KEY `user_mobile` (`user_mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='site user record table';

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_email`, `user_pass`, `user_type_id`, `user_mobile`, `user_image`, `created_at`, `updated_at`) VALUES
(1, 'admin@dakshina.com', '698d51a19d8a121ce581499d7b701668', 1, 9898989898, 'user_img_1.png', NULL, 1549080228);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='decides types of user in site';

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'admin'),
(2, 'simple_user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_master`
--
ALTER TABLE `class_master`
  ADD CONSTRAINT `class_department_link` FOREIGN KEY (`dept_id`) REFERENCES `department_master` (`dept_id`);

--
-- Constraints for table `student_master`
--
ALTER TABLE `student_master`
  ADD CONSTRAINT `student_class_link` FOREIGN KEY (`stud_class_id`) REFERENCES `class_master` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
