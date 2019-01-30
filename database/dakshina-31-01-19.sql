-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2019 at 08:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

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

CREATE TABLE `class_master` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table for class records';

--
-- Dumping data for table `class_master`
--

INSERT INTO `class_master` (`class_id`, `class_name`, `dept_id`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 1, 1548854019, 1548854019),
(2, 'BA', 1, 1548853934, 1548853934);

-- --------------------------------------------------------

--
-- Table structure for table `college_bank_details`
--

CREATE TABLE `college_bank_details` (
  `row_id` int(11) NOT NULL,
  `receivers_name` varchar(255) NOT NULL,
  `bank_account_no` bigint(20) NOT NULL,
  `bank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table for bank accounts for amount to deposits';

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE `department_master` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table for deparmtnet records';

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`dept_id`, `dept_name`, `created_at`, `updated_at`) VALUES
(1, 'Computer', 1548847355, 1548854422);

-- --------------------------------------------------------

--
-- Table structure for table `extra_fees_details_structure`
--

CREATE TABLE `extra_fees_details_structure` (
  `row_id` int(11) NOT NULL,
  `fees_name` varchar(255) NOT NULL,
  `fees_amt` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table maintains extra fees details';

-- --------------------------------------------------------

--
-- Table structure for table `fees_receipt_records`
--

CREATE TABLE `fees_receipt_records` (
  `fee_receipt_id` int(11) NOT NULL,
  `fee_on_name` varchar(255) NOT NULL COMMENT 'from_college_details_table',
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
  `cheque_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table records fees receipt';

-- --------------------------------------------------------

--
-- Table structure for table `fees_receipt_records_details`
--

CREATE TABLE `fees_receipt_records_details` (
  `row_id` bigint(20) NOT NULL,
  `fees_receipt_id` int(11) NOT NULL,
  `heading_name` varchar(255) NOT NULL,
  `fees_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees_structure_table`
--

CREATE TABLE `fees_structure_table` (
  `row_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `no-of_sem` int(11) NOT NULL,
  `class_tution_fees` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `fees_deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='fees structure table for various classes';

-- --------------------------------------------------------

--
-- Table structure for table `student_master`
--

CREATE TABLE `student_master` (
  `stud_id` int(11) NOT NULL,
  `enroll_no` int(11) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `stud_gender` varchar(10) DEFAULT NULL,
  `stud_father_name` varchar(255) NOT NULL,
  `stud_mobile_no` bigint(10) NOT NULL,
  `stud_class_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='student details table ';

--
-- Dumping data for table `student_master`
--

INSERT INTO `student_master` (`stud_id`, `enroll_no`, `stud_name`, `stud_gender`, `stud_father_name`, `stud_mobile_no`, `stud_class_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'as', 'Male', 'as', 9898989898, 1, 1548875448, 1548875448);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL COMMENT '1=admin,2=simple',
  `user_mobile` bigint(10) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='site user record table';

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_email`, `user_pass`, `user_type_id`, `user_mobile`, `created_at`, `updated_at`) VALUES
(1, 'admin', '698d51a19d8a121ce581499d7b701668', 1, 9898989898, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='decides types of user in site';

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'admin'),
(2, 'simple_user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_master`
--
ALTER TABLE `class_master`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`),
  ADD KEY `dept_id` (`dept_id`) USING BTREE;

--
-- Indexes for table `college_bank_details`
--
ALTER TABLE `college_bank_details`
  ADD PRIMARY KEY (`row_id`),
  ADD UNIQUE KEY `bank_account_no` (`bank_account_no`);

--
-- Indexes for table `department_master`
--
ALTER TABLE `department_master`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `extra_fees_details_structure`
--
ALTER TABLE `extra_fees_details_structure`
  ADD PRIMARY KEY (`row_id`),
  ADD UNIQUE KEY `fees_name` (`fees_name`);

--
-- Indexes for table `fees_receipt_records`
--
ALTER TABLE `fees_receipt_records`
  ADD PRIMARY KEY (`fee_receipt_id`),
  ADD KEY `stud_id` (`stud_id`,`user_id`,`stud_class_id`);

--
-- Indexes for table `fees_receipt_records_details`
--
ALTER TABLE `fees_receipt_records_details`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `fees_structure_table`
--
ALTER TABLE `fees_structure_table`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `student_master`
--
ALTER TABLE `student_master`
  ADD PRIMARY KEY (`stud_id`),
  ADD UNIQUE KEY `enroll_no` (`enroll_no`),
  ADD KEY `stud_class_id` (`stud_class_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user_email`),
  ADD UNIQUE KEY `user_mobile` (`user_mobile`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_master`
--
ALTER TABLE `class_master`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_master`
--
ALTER TABLE `department_master`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extra_fees_details_structure`
--
ALTER TABLE `extra_fees_details_structure`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_receipt_records`
--
ALTER TABLE `fees_receipt_records`
  MODIFY `fee_receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_receipt_records_details`
--
ALTER TABLE `fees_receipt_records_details`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_structure_table`
--
ALTER TABLE `fees_structure_table`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_master`
--
ALTER TABLE `student_master`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
