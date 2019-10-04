-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 01:05 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patients`
--

-- --------------------------------------------------------

--
-- Table structure for table `identification`
--

CREATE TABLE `identification` (
  `id` int(11) NOT NULL,
  `generated_id` varchar(40) NOT NULL,
  `patients_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `age` int(30) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `generated_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `age`, `gender`, `registration_date`, `generated_id`) VALUES
(1, 'YAOVI', 'SAMAH', 36, 'Male', '0000-00-00 00:00:00', NULL),
(2, 'LANDRY ADJELE', 'WILSON', 16, 'Male', '0000-00-00 00:00:00', NULL),
(4, 'karim', 'AMOUZOU', 26, 'Male', '2018-08-13 12:00:00', NULL),
(5, 'Itelios', 'EDEM', 36, 'Male', '2018-08-13 12:00:00', NULL),
(6, 'SAM', 'OMONGOU', 26, 'Male', '2018-08-14 12:00:00', NULL),
(7, 'KOFFI', 'ASSAMOA', 26, 'Male', '2018-08-14 01:00:00', NULL),
(8, 'SEKOU', 'YAO', 36, 'Male', '2018-08-14 12:00:00', NULL),
(11, 'FROILAND', 'NAHEL', 16, 'Male', '2018-08-14 12:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `user_role` varchar(45) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(20) DEFAULT NULL,
  `password_reset_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `picture`, `user_role`, `login_session_key`, `email_status`, `password_reset_key`) VALUES
(1, 'YAOVI', 'SAMAH', '$2y$10$hYJ3RTI6opZOaWGIoyOiy.KA7TiBKXFgFBAbCjTU037YJRzyFBGXK', 'SAMAH4049@GMAIL.COM', '', 'Administrator', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `identification`
--
ALTER TABLE `identification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `generated_id` (`generated_id`),
  ADD KEY `fk_identification_patients_idx` (`patients_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `identification`
--
ALTER TABLE `identification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
