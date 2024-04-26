-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 04:45 PM
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
  `event_link` varchar(255) DEFAULT NULL,
  `allDay` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `user_email`, `event_title`, `start_date`, `end_date`, `event_description`, `event_link`, `allDay`, `color`) VALUES
(1, 'yawebor859@dxice.com', 'TGC Office Hours', '2024-04-28 18:00:00', '2024-04-28 19:00:00', NULL, '', 0, 'green'),
(2, 'yawebor859@dxice.com', 'Astroworld Concert', '2024-04-09 19:33:00', '2024-04-11 07:34:00', NULL, '', 0, '#a5b00b'),
(3, 'banak88869@funvane.com', 'Spectrum: 2024', '2024-04-27 19:40:00', '2024-04-29 07:40:00', NULL, '', 0, 'blue');

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
  `bio` text NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `JP` varchar(255) DEFAULT NULL,
  `EI` varchar(255) DEFAULT NULL,
  `SN` varchar(255) DEFAULT NULL,
  `TF` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`user_id`, `DOB`, `m_status`, `gender`, `Religion`, `Caste`, `Age`, `imgurl`, `bio`, `user_email`, `JP`, `EI`, `SN`, `TF`) VALUES
(5, '2001-07-12', 'Single', 'Male', 'Christian', '', 22, '../../../uploads/IMG-662bb5877afb39.86875677.png', 'Hey there, I\'m Connor Anderson—a spirited guy with a love for adventure. Hailing from Istanbul, I\'ve found fulfillment in my career as a Engineer. When I\'m not working, you can catch me hitting the trails, trying out new hobbies, or simply enjoying the company of good friends.', 'banak88869@funvane.com', 'J', 'E', 'N', 'F'),
(4, '2000-07-14', 'Single', 'Female', 'Christian', '', 23, '../../../uploads/IMG-662bb2fd183278.41334309.jpg', 'Hi, I\'m Sophia Williams—a compassionate woman with a zest for life. Originally from Cuba, I\'ve built a fulfilling career as a Doctor. You\'ll often find me exploring new cuisines, hiking, or indulging in creative pursuits. Family is paramount to me, and I\'m eager to find a partner who shares my', 'yawebor859@dxice.com', 'J', 'E', 'S', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `gis`
--

CREATE TABLE `gis` (
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `ghost` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gis`
--

INSERT INTO `gis` (`latitude`, `longitude`, `user_email`, `ghost`) VALUES
(15.6002, 73.826, 'yawebor859@dxice.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interest_requests`
--

CREATE TABLE `interest_requests` (
  `request_id` int(11) NOT NULL,
  `status` enum('pending','accepted') DEFAULT 'pending',
  `sender_id` varchar(255) DEFAULT NULL,
  `receiver_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kundali`
--

CREATE TABLE `kundali` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `birth_time` time NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matched_pairs`
--

CREATE TABLE `matched_pairs` (
  `user1` varchar(255) DEFAULT NULL,
  `user2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matched_pairs`
--

INSERT INTO `matched_pairs` (`user1`, `user2`) VALUES
('yawebor859@dxice.com', 'banak88869@funvane.com'),
('banak88869@funvane.com', 'yawebor859@dxice.com');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` varchar(255) DEFAULT NULL,
  `outgoing_msg_id` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 'yawebor859@dxice.com', 'banak88869@funvane.com', 'Hey Sophia!');

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
(4, 'salelkarayush@gmail.com', 280957, '2023-09-30 16:43:42'),
(5, 'yawebor859@dxice.com', 402793, '2024-04-26 19:33:16'),
(6, 'banak88869@funvane.com', 224812, '2024-04-26 19:46:14');

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
  `user_password` varchar(256) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `user_name`, `user_email`, `user_password`, `status`) VALUES
(5, 'Connor Anderson', 'banak88869@funvane.com', '$2y$10$EqCjbxXSlh9OzXCkZMKQeOl/pek4tDckfVBvBh/AYyIcYgw73GiHa', 'Offline'),
(4, 'Sophia Williams', 'yawebor859@dxice.com', '$2y$10$fyxhvaF9S0TlVgWXGKUPLe611Dc/VYKQ3FXW438Xn3Hg4Tn75xC0e', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`user_email`);

--
-- Indexes for table `gis`
--
ALTER TABLE `gis`
  ADD PRIMARY KEY (`user_email`);

--
-- Indexes for table `interest_requests`
--
ALTER TABLE `interest_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `kundali`
--
ALTER TABLE `kundali`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kundali`
--
ALTER TABLE `kundali`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otp_data`
--
ALTER TABLE `otp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
