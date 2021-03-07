-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2021 at 05:52 PM
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
(5, 'logo', 'uploads/logo/signal.png', '2021-03-04 11:11:17'),
(6, 'min_balance', '50.00', '2021-03-05 12:21:38'),
(7, 'currency', '₦', '2021-03-05 12:25:26'),
(8, 'currency_code', '&#8358;', '2021-03-05 12:26:29'),
(9, 'auto_funding_charge', '80.00', '2021-03-05 12:56:54'),
(10, 'bank_stampduty', '50.00', '2021-03-05 12:58:17'),
(11, 'min_stampduty', '5000.00', '2021-03-05 12:59:33'),
(12, 'bank_details', 'Name: Aderonmu Abisogun<br>\r\nAccount Number: 0013838972<br>\r\nBank: GT Bank', '2021-03-05 16:46:29'),
(13, 'min_fund_request', '100.00', '2021-03-07 12:51:19'),
(14, 'auto_funding_bank', 'Sterling Bank', '2021-03-07 16:26:15');

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
  `auto_funding_accountId` varchar(50) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `plan` int(11) NOT NULL DEFAULT 1,
  `referred_by` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone_number`, `email`, `password`, `date_joined`, `auto_funding_accountId`, `role`, `plan`, `referred_by`, `token`, `status`) VALUES
(12, 'Global', 'Faaiz', '0909367804', 'tech@globalfaaiz.com', '$2y$12$yX6asmYJfasPL98gOpjNDOoRkA1SK1zd2h9W7pCooPoZOr7wLUrN.', '2021-03-02 15:18:23', '', 0, 0, NULL, '93969e80a96b34aa6d227726438efd6a', 1),
(13, 'Global', 'Faaiz', '09036830349', 'soliuomogbolahan01@gmail.com', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', '2021-03-02 15:19:09', '', 1, 1, NULL, 'b2453079247efe7e2a9d72059bcc4cf5', 1),
(16, 'Global', 'Faaiz', '49093678040', 'tech@globalafaaiz.com', '$2y$12$AEQNARz5tI6cVHQ35sOX7.8u5dpx.ud1.XwaDD9jLveflg5HLJ2fa', '2021-03-04 20:54:33', '', 1, 1, NULL, '9f359dcbc98d99c878c3e324685659d3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_in`
--

CREATE TABLE `wallet_in` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_balance` double NOT NULL,
  `amount` double NOT NULL,
  `balance_after` double NOT NULL,
  `method` enum('auto_fund','manual') NOT NULL,
  `reference` varchar(50) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `type` enum('1','2') NOT NULL COMMENT '1=Fund Wallet, 2=Receive Share',
  `status` enum('1','2','3') NOT NULL COMMENT '1=Pending, 2=Declined, 3=Approved',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_in`
--

INSERT INTO `wallet_in` (`id`, `user_id`, `old_balance`, `amount`, `balance_after`, `method`, `reference`, `approved_by`, `type`, `status`, `date`) VALUES
(1, 13, 0, 1500, 1500, 'auto_fund', 'FWA_i1ira', NULL, '1', '3', '2021-03-06 13:23:28'),
(2, 13, 1500, 80, 1500, 'auto_fund', 'FWA_ecehe', NULL, '1', '2', '2021-03-07 15:19:06'),
(3, 13, 1500, 80, 1500, 'auto_fund', 'FWA_i3umi', NULL, '1', '2', '2021-03-07 15:19:24'),
(4, 13, 1500, 120, 1500, 'auto_fund', 'FWA_kafi1', NULL, '1', '1', '2021-03-07 15:28:45'),
(5, 13, 1500, 20, 1500, 'auto_fund', 'FWA_ovuku', NULL, '1', '1', '2021-03-07 15:34:22'),
(6, 13, 1500, 100, 1500, 'auto_fund', 'FWA_gewu1', NULL, '1', '1', '2021-03-07 15:40:35'),
(7, 13, 1500, 120, 1500, 'auto_fund', 'FWA_e6aga', NULL, '1', '1', '2021-03-07 15:44:08'),
(8, 13, 1500, 20, 1500, 'auto_fund', 'FWA_3ipar', NULL, '1', '1', '2021-03-07 16:11:29'),
(9, 13, 1500, 20, 1520, 'auto_fund', 'FWA_manab', NULL, '1', '3', '2021-03-07 16:29:57'),
(10, 13, 1520, 720, 1520, 'auto_fund', 'FWA_upeme', NULL, '1', '1', '2021-03-07 16:31:08'),
(11, 13, 1520, 920, 1520, 'auto_fund', 'FWA_i5ate', NULL, '1', '1', '2021-03-07 16:44:40'),
(12, 13, 1520, 6999, 1520, 'auto_fund', 'FWA_ikogi', NULL, '1', '1', '2021-03-07 16:47:58'),
(13, 13, 1520, 7729, 1520, 'auto_fund', 'FWA_avute', NULL, '1', '1', '2021-03-07 16:54:08'),
(14, 13, 1520, 21134, 22645, 'auto_fund', 'FWA_oneqo', NULL, '1', '3', '2021-03-07 16:55:28'),
(15, 13, 1520, 700, 1520, 'auto_fund', 'FWA_sefak', NULL, '1', '1', '2021-03-07 16:56:07'),
(16, 13, 22654, 720, 22654, 'auto_fund', 'FWA_u2o2e', NULL, '1', '1', '2021-03-07 17:17:18'),
(17, 13, 22654, 20, 22654, 'auto_fund', 'FWA_u1alu', NULL, '1', '1', '2021-03-07 17:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_out`
--

CREATE TABLE `wallet_out` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_balance` double NOT NULL,
  `amount` double NOT NULL,
  `balance_after` double NOT NULL,
  `reference` varchar(50) NOT NULL,
  `type` enum('4','3','5') NOT NULL COMMENT '3=Share Out,4=Purchase\r\n5=Withdrawal',
  `status` int(1) NOT NULL DEFAULT 6 COMMENT '6=Successful',
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wallet_in`
--
ALTER TABLE `wallet_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wallet_out`
--
ALTER TABLE `wallet_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
