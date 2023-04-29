-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 04:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surgery`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `const_id` int(11) NOT NULL,
  `const_fullnames` varchar(200) DEFAULT NULL,
  `const_lastname` varchar(200) DEFAULT NULL,
  `const_cellno` varchar(50) DEFAULT NULL,
  `const_email` varchar(150) DEFAULT NULL,
  `const_passport` varchar(50) DEFAULT NULL,
  `const_gender` varchar(50) DEFAULT NULL,
  `const_disab` varchar(50) DEFAULT NULL,
  `const_physad` varchar(255) DEFAULT NULL,
  `const_highblood` varchar(10) DEFAULT NULL,
  `const_heartdisease` varchar(10) DEFAULT NULL,
  `const_cholestrol` varchar(10) DEFAULT NULL,
  `const_diabetes` varchar(10) DEFAULT NULL,
  `const_bleedingdisord` varchar(10) DEFAULT NULL,
  `const_surgery` varchar(10) DEFAULT NULL,
  `const_allergies` varchar(10) DEFAULT NULL,
  `const_aboutallergies` longtext DEFAULT NULL,
  `const_aboutconsultation` longtext DEFAULT NULL,
  `const_status` varchar(50) DEFAULT NULL,
  `const_doc` varchar(100) DEFAULT NULL,
  `const_dom` varchar(100) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `k_id` int(11) DEFAULT NULL,
  `const_paystat` varchar(50) DEFAULT NULL,
  `const_schedate` varchar(50) DEFAULT NULL,
  `const_schedtime` varchar(50) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `const_amodue` varchar(255) DEFAULT NULL,
  `const_audi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL,
  `doc_name` varchar(200) DEFAULT NULL,
  `doc_doc` varchar(150) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `doc_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `eme_num` int(11) NOT NULL,
  `eme_fullnames` varchar(100) DEFAULT NULL,
  `eme_lastname` varchar(100) DEFAULT NULL,
  `eme_email` varchar(50) DEFAULT NULL,
  `eme_cellno` varchar(20) DEFAULT NULL,
  `eme_gender` varchar(10) DEFAULT NULL,
  `eme_nature` longtext DEFAULT NULL,
  `eme_status` varchar(50) DEFAULT NULL,
  `eme_paystat` varchar(50) DEFAULT NULL,
  `eme_doc` varchar(50) DEFAULT NULL,
  `eme_amodue` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_fullnames` varchar(200) DEFAULT NULL,
  `emp_lastname` varchar(200) DEFAULT NULL,
  `emp_email` varchar(150) DEFAULT NULL,
  `emp_cellno` varchar(50) DEFAULT NULL,
  `emp_position` varchar(100) DEFAULT NULL,
  `emp_status` varchar(100) DEFAULT NULL,
  `emp_doc` varchar(50) DEFAULT NULL,
  `emp_dom` varchar(50) DEFAULT NULL,
  `emp_password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `intake`
--

CREATE TABLE `intake` (
  `const_id` int(11) NOT NULL,
  `const_status` varchar(50) DEFAULT NULL,
  `cosnt_mod` varchar(30) DEFAULT NULL,
  `emp_email` varchar(150) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`const_id`, `const_status`, `cosnt_mod`, `emp_email`, `emp_id`) VALUES
(1, 'Open', '11/22/22', 'koketsobura80@yahoo.com', 1012);

-- --------------------------------------------------------

--
-- Table structure for table `kin`
--

CREATE TABLE `kin` (
  `k_id` int(11) NOT NULL,
  `k_fullnames` varchar(200) DEFAULT NULL,
  `k_lastname` varchar(200) DEFAULT NULL,
  `k_cellno` varchar(20) DEFAULT NULL,
  `k_email` varchar(150) DEFAULT NULL,
  `k_password` varchar(50) DEFAULT NULL,
  `k_passport` varchar(30) DEFAULT NULL,
  `k_gender` varchar(10) DEFAULT NULL,
  `k_disab` varchar(10) DEFAULT NULL,
  `k_phyad` varchar(255) DEFAULT NULL,
  `k_dob` varchar(100) DEFAULT NULL,
  `k_doc` varchar(100) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `rest`
--

CREATE TABLE `rest` (
  `r_id` int(11) NOT NULL,
  `r_token` longtext DEFAULT NULL,
  `r_doc` varchar(100) DEFAULT NULL,
  `r_status` varchar(100) DEFAULT NULL,
  `r_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_fullnames` varchar(200) DEFAULT NULL,
  `u_lastname` varchar(200) DEFAULT NULL,
  `u_cellno` varchar(20) DEFAULT NULL,
  `u_email` varchar(150) DEFAULT NULL,
  `u_password` varchar(50) DEFAULT NULL,
  `u_passport` varchar(30) DEFAULT NULL,
  `u_gender` varchar(10) DEFAULT NULL,
  `u_disab` varchar(10) DEFAULT NULL,
  `u_phyad` varchar(255) DEFAULT NULL,
  `u_dob` varchar(100) DEFAULT NULL,
  `u_doc` varchar(100) DEFAULT NULL,
  `u_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`const_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `k_id` (`k_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`eme_num`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `intake`
--
ALTER TABLE `intake`
  ADD PRIMARY KEY (`const_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `kin`
--
ALTER TABLE `kin`
  ADD PRIMARY KEY (`k_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `rest`
--
ALTER TABLE `rest`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `const_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `eme_num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1016;

--
-- AUTO_INCREMENT for table `intake`
--
ALTER TABLE `intake`
  MODIFY `const_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kin`
--
ALTER TABLE `kin`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rest`
--
ALTER TABLE `rest`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`k_id`) REFERENCES `kin` (`k_id`),
  ADD CONSTRAINT `consultations_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `intake`
--
ALTER TABLE `intake`
  ADD CONSTRAINT `intake_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `kin`
--
ALTER TABLE `kin`
  ADD CONSTRAINT `kin_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
