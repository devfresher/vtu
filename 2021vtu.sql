-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2021 at 01:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2021vtu`
--

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(50) NOT NULL,
  `migration_fee` double NOT NULL,
  `referral_fee` double NOT NULL,
  `allow_referral` tinyint(1) NOT NULL,
  `sales_target` int(11) NOT NULL,
  `lock` tinyint(1) NOT NULL,
  `purchase_limit` int(11) NOT NULL,
  `plan_type` enum('private','public') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_name`, `migration_fee`, `referral_fee`, `allow_referral`, `sales_target`, `lock`, `purchase_limit`, `plan_type`, `created_by`, `created_date`, `status`) VALUES
(1, 'Starter', 0, 0, 1, 0, 1, 0, 'public', 1, '2021-03-01 20:49:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permission`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `created_by`, `created_date`, `permission`) VALUES
(1, 'user', 1, '2021-03-01 20:49:40', '{\"user\":{\"create\": 0, \"edit\": 0, \"delete\": 0, \"update\": 0}}');

-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

CREATE TABLE `site_options` (
  `id` int(11) NOT NULL,
  `option_key` varchar(50) NOT NULL,
  `option_value` longtext NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` (`id`, `option_key`, `option_value`, `updated`) VALUES
(1, 'site_title', '2021 VTU', '2021-03-04 10:08:59'),
(2, 'site_slug', 'We make the world with data', '2021-03-04 10:09:38'),
(5, 'logo', 'uploads/logo/signal.png', '2021-03-04 11:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_joined` datetime NOT NULL,
  `role` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone_number`, `email`, `password`, `date_joined`, `role`, `plan`, `referred_by`, `token`, `status`) VALUES
(12, 'Global', 'Faaiz', '+234909367804', 'tech@globalsofaaiz.com', '$2y$12$yX6asmYJfasPL98gOpjNDOoRkA1SK1zd2h9W7pCooPoZOr7wLUrN.', '2021-03-02 15:18:23', 0, 0, NULL, '93969e80a96b34aa6d227726438efd6a', 1),
(13, 'Global', 'Faaiz', '09036830349', 'soliuomogbolahan01@gmail.com', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', '2021-03-02 15:19:09', 1, 1, NULL, 'b2453079247efe7e2a9d72059bcc4cf5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_in`
--

CREATE TABLE `wallet_in` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `amount` double NOT NULL,
  `reference` varchar(50) NOT NULL,
  `method` enum('bank','admin','online','') NOT NULL,
  `status` enum('pending','declined','approved','') NOT NULL,
  `approvedBy` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_out`
--

CREATE TABLE `wallet_out` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `amount` double NOT NULL,
  `reference` varchar(50) NOT NULL,
  `method` enum('bank','admin','online','') NOT NULL,
  `status` enum('pending','declined','approved','') NOT NULL,
  `approvedBy` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_options`
--
ALTER TABLE `site_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_in`
--
ALTER TABLE `wallet_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_out`
--
ALTER TABLE `wallet_out`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_options`
--
ALTER TABLE `site_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wallet_in`
--
ALTER TABLE `wallet_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_out`
--
ALTER TABLE `wallet_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
