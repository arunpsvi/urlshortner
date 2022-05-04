-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 09:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urlshortner`
--

-- --------------------------------------------------------

--
-- Table structure for table `svi_settings`
--

CREATE TABLE `svi_settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svi_settings`
--

INSERT INTO `svi_settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'URL Shortner'),
(2, 'system_title', 'URL Shortner');

-- --------------------------------------------------------

--
-- Table structure for table `svi_shorturl`
--

CREATE TABLE `svi_shorturl` (
  `url_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `long_url` longtext NOT NULL,
  `short_url` varchar(100) NOT NULL,
  `added_by` int(4) NOT NULL,
  `date_added` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `svi_users`
--

CREATE TABLE `svi_users` (
  `user_id` int(11) NOT NULL,
  `role` tinyint(5) NOT NULL DEFAULT 2,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(30) NOT NULL DEFAULT '',
  `last_name` varchar(30) NOT NULL,
  `address1` varchar(50) NOT NULL DEFAULT '',
  `address2` varchar(50) NOT NULL DEFAULT '',
  `zipcode` varchar(6) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svi_users`
--

INSERT INTO `svi_users` (`user_id`, `role`, `username`, `password`, `first_name`, `last_name`, `address1`, `address2`, `zipcode`, `city`, `mobile`, `email`, `date_created`, `status`) VALUES
(1, 2, 'arun', '827ccb0eea8a706c4c34a16891f84e7b', 'Arun', 'Pandey', '', '', '', '', '9919113035', 'arun.softvisionindia@gmail.com', '2020-06-25 16:31:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `svi_user_role`
--

CREATE TABLE `svi_user_role` (
  `role_id` tinyint(1) NOT NULL,
  `role_display` varchar(10) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svi_user_role`
--

INSERT INTO `svi_user_role` (`role_id`, `role_display`, `role_name`) VALUES
(2, 'Admin', 'ADMIN'),
(3, 'Employee', 'EMPLOYEE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `svi_settings`
--
ALTER TABLE `svi_settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `svi_shorturl`
--
ALTER TABLE `svi_shorturl`
  ADD PRIMARY KEY (`url_id`),
  ADD KEY `type_of_work` (`name`),
  ADD KEY `hours` (`short_url`),
  ADD KEY `date_added` (`date_added`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `short_url` (`short_url`);

--
-- Indexes for table `svi_users`
--
ALTER TABLE `svi_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `status` (`status`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `svi_user_role`
--
ALTER TABLE `svi_user_role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_display` (`role_display`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `svi_settings`
--
ALTER TABLE `svi_settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `svi_shorturl`
--
ALTER TABLE `svi_shorturl`
  MODIFY `url_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `svi_users`
--
ALTER TABLE `svi_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `svi_user_role`
--
ALTER TABLE `svi_user_role`
  MODIFY `role_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
