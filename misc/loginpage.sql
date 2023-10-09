-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 07:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginpage`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_description` text DEFAULT NULL,
  `event_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `user_id` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `m_status` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `Religion` varchar(50) NOT NULL,
  `Caste` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `imgurl` text NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`user_id`, `DOB`, `m_status`, `gender`, `Religion`, `Caste`, `Age`, `imgurl`, `bio`) VALUES
(0, '2023-09-07', 'single', 'male', 'hindu', 'kshatriya', 34, 'IMG-65180907b29158.54003895.jpg', 'dkgsjk sj kldg jsk fdfgklj'),
(0, '2023-10-12', 'married', 'Female', 'hindu', 'brahmin', 19, '../../../uploads/IMG-651a4c2e6152e5.27876049.jpg', 'dsjfhakj haksdhfk hskdhf'),
(0, '2023-10-20', 'married', 'Female', 'muslim', 'shia', 34, '../../../uploads/IMG-651a51cc5a32c6.65209471.jpg', 'hdhjfghs hjds hfkg hsdf g'),
(0, '2023-10-12', 'single', 'male', 'hindu', 'brahmin', 34, '../../../uploads/IMG-651a51f5546a66.06056856.jpg', 'fgskh hsjf g jhsdj '),
(0, '2003-02-10', 'single', 'male', 'hindu', 'brahmin', 20, '../../../uploads/IMG-651a545c18fcf6.34443257.jpg', 'fskfkljal jklasjf jkl jdklf '),
(3, '2023-10-11', 'single', 'male', 'hindu', 'brahmin', 20, '../../../uploads/IMG-651a54b022c902.74839294.jpg', 'nsjkhfk jhasjk dhf hjkh sjkdfhjk');

-- --------------------------------------------------------

--
-- Table structure for table `otp_data`
--

CREATE TABLE `otp_data` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `otp_code` int(11) NOT NULL,
  `otp_expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_data`
--

INSERT INTO `otp_data` (`id`, `user_email`, `otp_code`, `otp_expiry`) VALUES
(1, 'deeptejdhauskar2003@gmail.com', 406963, '2023-09-17 13:51:47'),
(2, 'avnishcabral@gmail.com', 987486, '2023-09-30 16:14:33'),
(3, 'salelkarayush@gmail.com', 745398, '2023-09-30 16:43:38'),
(4, 'salelkarayush@gmail.com', 280957, '2023-09-30 16:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `user_email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `otp_expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Avnish', 'avnishcabral@gmail.com', '$2y$10$TAX93d9wxZvTtgyjEEOope1th5sVuG0pPgd0.LCm62ulkQQ6Gj69K'),
(2, 'Deeptej', 'deeptejdhauskar2003@gmail.com', '$2y$10$/GlOt9tYTWG6pRedJSN6SefjW/GWGjyNr/ngcT1pmF1n0DbTR.wm6'),
(3, 'ayush', 'salelkarayush@gmail.com', '$2y$10$EXrz/qtVf35Dddk.MnWXTubXtdCWUl/UntFmrIBlWTS2VqGsnfoA.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_data`
--
ALTER TABLE `otp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`user_email`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_data`
--
ALTER TABLE `otp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
