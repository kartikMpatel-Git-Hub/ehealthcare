-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 08:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealthcare1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(3) NOT NULL,
  `admin_email` varchar(25) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_name` varchar(15) NOT NULL,
  `admin_phoneno` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phoneno`) VALUES
(1, 'Admin1@gmail.com', '202cb962ac59075b964b07152d234b70', 'Kartik', '8460888834'),
(2, 'Admin2@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Rudra', '9924700970');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appo_id` int(3) NOT NULL,
  `patient_id` int(3) NOT NULL,
  `appo_no` int(3) NOT NULL,
  `sche_id` int(3) NOT NULL,
  `appo_date` date NOT NULL,
  `appo_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(3) NOT NULL,
  `doc_id` int(3) NOT NULL,
  `article_title` varchar(25) NOT NULL,
  `article_description` varchar(5000) NOT NULL,
  `article_date` date NOT NULL,
  `article_img` varchar(25) NOT NULL,
  `article_view` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cmt_id` int(3) NOT NULL,
  `article_id` int(3) NOT NULL,
  `cmt_detail` varchar(300) NOT NULL,
  `patient_id` int(3) NOT NULL,
  `cmt_date` date NOT NULL,
  `cmt_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(3) NOT NULL,
  `doc_email` varchar(25) NOT NULL,
  `doc_name` varchar(20) NOT NULL,
  `doc_password` varchar(50) NOT NULL,
  `doc_address` varchar(50) NOT NULL,
  `doc_gender` varchar(6) NOT NULL,
  `doc_phoneno` varchar(12) NOT NULL,
  `spec_id` int(2) NOT NULL,
  `doc_img` varchar(30) NOT NULL,
  `doc_charge` int(5) NOT NULL,
  `doc_dob` date DEFAULT NULL,
  `doc_experience` int(2) NOT NULL,
  `doc_about` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(3) NOT NULL,
  `doc_id` int(3) NOT NULL,
  `sche_id` int(3) NOT NULL,
  `feedback_description` varchar(200) NOT NULL,
  `patient_id` int(3) NOT NULL,
  `rating` int(1) NOT NULL,
  `appo_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(3) NOT NULL,
  `patient_email` varchar(25) NOT NULL,
  `patient_name` varchar(15) NOT NULL,
  `patient_password` varchar(50) NOT NULL,
  `patient_gender` varchar(6) NOT NULL,
  `patient_address` varchar(50) NOT NULL,
  `patient_dob` date NOT NULL,
  `patient_phoneno` varchar(12) NOT NULL,
  `patient_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `pen_doc_id` int(3) NOT NULL,
  `doc_email` varchar(25) NOT NULL,
  `doc_name` varchar(20) NOT NULL,
  `doc_password` varchar(50) NOT NULL,
  `doc_address` varchar(50) NOT NULL,
  `doc_gender` varchar(6) NOT NULL,
  `doc_phoneno` varchar(12) NOT NULL,
  `spec_id` int(2) NOT NULL,
  `doc_img` varchar(30) NOT NULL,
  `doc_charge` int(5) NOT NULL,
  `doc_dob` date DEFAULT NULL,
  `doc_experience` int(2) NOT NULL,
  `doc_about` varchar(100) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(3) NOT NULL,
  `doc_id` int(3) NOT NULL,
  `rate_total_rating` int(4) NOT NULL,
  `rate_total_review` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sche_id` int(3) NOT NULL,
  `doc_id` int(3) NOT NULL,
  `sche_title` varchar(20) NOT NULL,
  `sche_date` date NOT NULL,
  `sche_start` time NOT NULL,
  `sche_end` time NOT NULL,
  `sche_noappo` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `spec_id` int(2) NOT NULL,
  `spec_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`spec_id`, `spec_type`) VALUES
(1, 'Allergology'),
(2, 'Anaesthetics'),
(3, 'Dentist'),
(4, 'Radiologiest'),
(5, 'Neurologist'),
(6, 'Cardiologist'),
(7, 'Otologist'),
(8, 'ophthalmologist'),
(9, 'Dermatology'),
(10, 'Pulmonologist'),
(11, 'Orthopedic');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tra_id` int(3) NOT NULL,
  `doc_id` int(3) NOT NULL,
  `sche_id` int(3) NOT NULL,
  `patient_id` int(3) NOT NULL,
  `appo_id` int(3) NOT NULL,
  `charge` int(5) NOT NULL,
  `tra_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `user_email` varchar(25) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_name`, `user_type`) VALUES
(1, 'Admin1@gmail.com', 'Kartik', 'A'),
(2, 'Admin2@gmail.com', 'Rudra', 'A'),
(3, 'Patient1@gmail.com', 'Patient1', 'P'),
(4, 'Doctor1@gmail.com', 'Doctor1', 'D'),
(5, 'Doctor2@gmail.com', 'Doctor2', 'D'),
(6, 'Doctor3@gmail.com', 'Doctor3', 'D'),
(7, 'Doctor4@gmail.com', 'Doctor4', 'D'),
(11, 'Patient5@gmail.com', 'patient5', 'P'),
(12, 'dockartik@gmail.com', 'Kartik', 'D'),
(13, 'Kartik@gmail.com', 'Kartik', 'P'),
(14, 'Doctor5@gmail.com', 'Doctor5', 'D'),
(16, 'Test@gmail.com', 'test', 'D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD UNIQUE KEY `admin_phoneno` (`admin_phoneno`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appo_id`),
  ADD KEY `Reference -0` (`patient_id`),
  ADD KEY `Reference -3` (`sche_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `Reference -1` (`doc_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cmt_id`),
  ADD KEY `Reference-99` (`article_id`),
  ADD KEY `Reference -98` (`patient_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `doc_email` (`doc_email`),
  ADD UNIQUE KEY `doc_phoneno` (`doc_phoneno`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `Reference -4` (`doc_id`),
  ADD KEY `Reference-5` (`patient_id`),
  ADD KEY `Reference-55` (`sche_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `patient_email` (`patient_email`),
  ADD UNIQUE KEY `patient_phoneno` (`patient_phoneno`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`pen_doc_id`),
  ADD UNIQUE KEY `doc_email` (`doc_email`),
  ADD KEY `Reference-7` (`spec_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `Reference-8` (`doc_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sche_id`),
  ADD UNIQUE KEY `sche_title` (`sche_title`),
  ADD KEY `Reference -9` (`doc_id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tra_id`),
  ADD KEY `Reference-11` (`doc_id`),
  ADD KEY `Reference-12` (`patient_id`),
  ADD KEY `Reference-13` (`sche_id`),
  ADD KEY `Reference-29` (`appo_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appo_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cmt_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `pen_doc_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sche_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `spec_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tra_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `Reference -0` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `Reference -3` FOREIGN KEY (`sche_id`) REFERENCES `schedule` (`sche_id`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `Reference -1` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Reference -98` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `Reference-99` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `Reference -2` FOREIGN KEY (`spec_id`) REFERENCES `specialist` (`spec_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `Reference -4` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`),
  ADD CONSTRAINT `Reference-5` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `Reference-55` FOREIGN KEY (`sche_id`) REFERENCES `schedule` (`sche_id`),
  ADD CONSTRAINT `Reference-6` FOREIGN KEY (`sche_id`) REFERENCES `rating` (`rate_id`);

--
-- Constraints for table `pending`
--
ALTER TABLE `pending`
  ADD CONSTRAINT `Reference-7` FOREIGN KEY (`spec_id`) REFERENCES `specialist` (`spec_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `Reference-8` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `Reference -9` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `Reference-10` FOREIGN KEY (`appo_id`) REFERENCES `appointment` (`appo_id`),
  ADD CONSTRAINT `Reference-11` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`),
  ADD CONSTRAINT `Reference-12` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `Reference-13` FOREIGN KEY (`sche_id`) REFERENCES `schedule` (`sche_id`),
  ADD CONSTRAINT `Reference-29` FOREIGN KEY (`appo_id`) REFERENCES `appointment` (`appo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
