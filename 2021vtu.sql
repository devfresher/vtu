-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2021 at 08:36 AM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `date`) VALUES
(1, 'Airtime Topup', '2021-03-10 15:12:02'),
(2, 'Data Bundle', '2021-03-10 15:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `location` enum('toolbar','quick_user','user_profile_aside') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `parent_id`, `role`, `location`) VALUES
(1, 'Dashboard', 'dashboard', NULL, '1,2,3', 'toolbar'),
(2, 'My Account', 'javascript:;', NULL, '1,2,3', 'toolbar'),
(3, 'Airtime Topup', 'airtime-topup', NULL, '1,2,3', 'toolbar'),
(4, 'Data Bundles', 'javascript:;', NULL, '1,2,3', 'toolbar'),
(5, 'Subscriptions', 'javascript:;', NULL, '1,2,3', 'toolbar'),
(6, 'Others', 'javascript', NULL, '1,2,3', 'toolbar'),
(7, 'Fund Wallet', 'wallet', 2, '1,2,3', 'toolbar'),
(8, 'Share Money', 'share-money', 2, '1,2,3', 'toolbar'),
(9, 'Commission', 'commissions', 2, '1,2,3', 'toolbar'),
(10, 'Price List', 'price-list', 2, '1,2,3', 'toolbar'),
(11, 'MTN Bundles', 'mtn-bundle', 4, '1,2,3', 'toolbar'),
(12, 'Other GSM Bundles', 'other-gsm-bundles', 4, '1,2,3', 'toolbar'),
(13, 'Broadband Bundle', 'broad-band-bundle', 4, '1,2,3', 'toolbar'),
(14, 'Cable Tv', 'cable-tv', 5, '1,2,3', 'toolbar'),
(15, 'Electricity', 'electricity', 5, '1,2,3', 'toolbar'),
(16, 'Bulk SMS', 'bulk-sms', 6, '1,2,3', 'toolbar'),
(17, 'WAEC Result Checker', 'waec-result-checker', 6, '1,2,3', 'toolbar');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_icon` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_icon`, `date`) VALUES
(1, 'MTN NG', 'uploads/mtn1.png', '2021-03-10 15:13:07'),
(2, 'GLO', 'uploads/glo1.png', '2021-03-10 15:13:07'),
(3, '9mobile', 'uploads/9mobile.jpg', '2021-03-10 15:13:07'),
(4, 'Airtel', 'uploads/airtel1.png', '2021-03-10 15:13:07'),
(5, 'MTN Data Bundle', 'uploads/mtn1.png', '2021-03-11 10:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_plan`
--

CREATE TABLE `product_plan` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `cat_id` int(1) NOT NULL,
  `product_plan_name` varchar(255) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `cost_price` double DEFAULT NULL,
  `percentage_discount` double(3,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_plan`
--

INSERT INTO `product_plan` (`id`, `product_id`, `product_code`, `cat_id`, `product_plan_name`, `plan_id`, `cost_price`, `percentage_discount`, `status`) VALUES
(1, 1, 'mtn', 1, 'MTN', 1, NULL, 1.00, 1),
(2, 2, 'glo', 1, 'GLO', 1, NULL, 1.00, 1),
(3, 3, '9mobile', 1, '9MOBILE', 1, NULL, 1.00, 1),
(4, 4, 'airtel', 1, 'AIRTEL', 1, NULL, 1.00, 1),
(5, 5, 'mtn_sme_1', 2, 'MTN 1GB/30days SME', 1, 1200, 1.50, 1),
(7, 5, 'mtn_sme_2', 2, 'MTN 2GB/30days SME', 1, 1500, 1.50, 1),
(8, 5, 'mtn_sme_5', 2, 'MTN 5GB/30days SME', 2, 1000, 1.50, 1);

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
(14, 'auto_funding_bank', 'Sterling Bank', '2021-03-07 16:26:15'),
(15, 'network_codes', '{\r\n	\"MTN NG\": [\"07025\", \"07026\", \"0703\", \"0704\", \"0706\", \"0913\", \"0803\", \"0806\", \"0810\", \"0813\", \"0814\", \"0816\", \"0903\", \"0906\"],\r\n	\"Globacom NG\": [\"0705\", \"0805\", \"0807\", \"0811\", \"0815\", \"0905\"],\r\n	\"Airtel NG\": [\"0701\", \"0708\", \"0802\", \"0808\", \"0812\", \"0901\", \"0902\", \"0904\", \"0907\"],\r\n	\"9mobile\": [\"0809\", \"0817\", \"0818\", \"0909\", \"0908\"]\r\n}', '2021-03-10 11:28:50'),
(16, 'min_airtime_vending', '1', '2021-03-11 12:12:22'),
(17, 'max_airtime_vending', '2500', '2021-03-11 12:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `product_plan_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('1','2','3','4','5') NOT NULL COMMENT '1=Pending, \r\n2=Declined, 3=Approved,\r\n4=Succesful,\r\n5= Refund',
  `amount` double NOT NULL,
  `amount_charged` double DEFAULT NULL,
  `old_balance` double NOT NULL,
  `balance_after` double NOT NULL,
  `received_by` varchar(100) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `reference`, `order_id`, `product_plan_id`, `date`, `status`, `amount`, `amount_charged`, `old_balance`, `balance_after`, `received_by`, `message`, `user_id`) VALUES
(1, 'ATM_magod', NULL, 1, '2021-03-13 17:28:49', '2', 1, 0, 12125.83, 12125.83, '09036830349', 'Minimum airtime purchase is N10', 13),
(2, 'ATM_zurul', NULL, 1, '2021-03-13 17:38:11', '2', 5, 0, 12125.83, 12125.83, '09036830349', 'Minimum airtime purchase is N10', 13),
(3, 'ATM_lixek', '716914693455', 1, '2021-03-13 18:20:05', '4', 10, 9.9, 12125.83, 12115.93, '09036830349', 'Order successful', 13),
(4, 'ATM_eco8e', NULL, 2, '2021-03-13 20:17:06', '2', 10, 0, 12115.93, 12115.93, '08119900857', 'Airtime topup not completed', 13),
(5, 'ATM_li5ig', NULL, 2, '2021-03-13 20:18:09', '2', 50, 0, 12115.93, 12115.93, '08119900857', 'Airtime topup not completed', 13),
(6, 'ATM_bobo8', NULL, 2, '2021-03-13 20:23:25', '2', 1, 0, 12115.93, 12115.93, '08119900857', 'Airtime topup not completed', 13),
(7, 'ATM_utona', NULL, 2, '2021-03-13 20:24:16', '2', 1, 0, 12115.93, 12115.93, '08119900857', 'Airtime topup not completed', 13),
(8, 'ATM_7emeg', NULL, 2, '2021-03-13 20:25:23', '2', 1, 0, 12115.93, 12115.93, '08119900857', 'Minimum airtime purchase is N10', 13),
(9, 'ATM_3uhoy', NULL, 2, '2021-03-13 20:28:27', '2', 1, 0, 12115.93, 12115.93, '08119900857', 'Minimum airtime purchase is N10', 13),
(10, 'ATM_vakok', '897496945096', 2, '2021-03-13 20:29:55', '1', 10, 9.9, 12115.93, 12106.03, '08119900857', 'Order successful', 13),
(11, 'ATM_2osa2', '697167098192', 4, '2021-03-14 15:59:55', '1', 10, 9.9, 5209.7, 5199.8, '09041732405', 'Order successful', 12);

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
  `transaction_pin` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone_number`, `email`, `password`, `date_joined`, `auto_funding_accountId`, `role`, `plan`, `referred_by`, `token`, `transaction_pin`, `status`) VALUES
(12, 'Usman', 'Soliu', '08119900857', 'fresher.dev01@gmail.com', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', '2021-03-02 15:18:23', '', 1, 1, NULL, '93969e80a96b34aa6d227726438efd6a', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', 1),
(13, 'Global', 'Faaiz', '09036830349', 'soliuomogbolahan01@gmail.com', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', '2021-03-02 15:19:09', '', 1, 1, NULL, 'b2453079247efe7e2a9d72059bcc4cf5', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', 1),
(16, 'Global', 'Faaiz', '49093678040', 'tech@globalafaaiz.com', '$2y$12$AEQNARz5tI6cVHQ35sOX7.8u5dpx.ud1.XwaDD9jLveflg5HLJ2fa', '2021-03-04 20:54:33', '', 1, 1, NULL, '9f359dcbc98d99c878c3e324685659d3', '$2y$12$QHT7.Kpdv1dR1KQYAypSHOOZYO18FDSbMroFySA4w53nlxy2knigu', 1);

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
  `method` enum('auto_fund','manual') DEFAULT NULL,
  `reference` varchar(50) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `type` enum('1','2','6') NOT NULL COMMENT '1=Fund Wallet, 2=Receive Share,\r\n6=Refund Wallet',
  `status` enum('1','2','3') NOT NULL COMMENT '1=Pending, 2=Declined, 3=Approved',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_in`
--

INSERT INTO `wallet_in` (`id`, `user_id`, `old_balance`, `amount`, `balance_after`, `method`, `reference`, `approved_by`, `type`, `status`, `date`) VALUES
(56, 12, 0, 4950, 4950, 'manual', 'FWA_a6igi', NULL, '1', '3', '2021-03-10 05:36:04'),
(57, 13, 0, 2000, 2000, NULL, 'SWA_9usuz', NULL, '2', '3', '2021-03-10 05:37:13'),
(58, 12, 2950, 8420, 2950, 'auto_fund', 'FWA_ka8um', NULL, '1', '3', '2021-03-10 08:52:17'),
(59, 12, 11370, 7950, 11370, 'manual', 'FWA_posig', NULL, '1', '1', '2021-03-10 09:13:07'),
(60, 12, 11370, 4245, 11370, 'auto_fund', 'FWA_ipi1i', NULL, '1', '1', '2021-03-10 09:13:18'),
(61, 13, 2000, 400, 2400, NULL, 'SWA_ocapu', NULL, '2', '3', '2021-03-10 09:14:00'),
(62, 13, 2400, 600, 3000, NULL, 'SWA_xaqew', NULL, '2', '3', '2021-03-10 09:14:15'),
(63, 13, 3000, 10000, 13000, NULL, 'SWA_vawur', NULL, '2', '3', '2021-03-10 09:14:31'),
(64, 13, 12106.03, 100, 12206.03, 'manual', 'FWA_alu1a', NULL, '1', '3', '2021-03-14 10:19:12'),
(65, 12, 3.700000000008, 10, 13.700000000008, NULL, 'SWA_e6e8u', NULL, '2', '3', '2021-03-14 15:17:36'),
(66, 12, 13.700000000008, 4300, 4313.7, NULL, 'SWA_0iwov', NULL, '2', '3', '2021-03-14 15:38:23'),
(67, 12, 4313.7, 896, 5209.7, NULL, 'SWA_elo1e', NULL, '2', '3', '2021-03-14 15:40:40');

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
  `order_id` varchar(50) DEFAULT NULL,
  `type` enum('4','3','5') NOT NULL COMMENT '3=Share Out,4=Purchase\r\n5=Withdrawal',
  `status` int(1) NOT NULL DEFAULT 4 COMMENT '4=Successful',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_out`
--

INSERT INTO `wallet_out` (`id`, `user_id`, `old_balance`, `amount`, `balance_after`, `reference`, `order_id`, `type`, `status`, `date`) VALUES
(32, 12, 4950, 2000, 2950, 'SWA_9usuz', NULL, '3', 4, '2021-03-10 05:37:13'),
(33, 12, 11370, 400, 10970, 'SWA_ocapu', NULL, '3', 4, '2021-03-10 09:14:00'),
(34, 12, 10970, 600, 10370, 'SWA_xaqew', NULL, '3', 4, '2021-03-10 09:14:15'),
(35, 12, 10370, 10000, 370, 'SWA_vawur', NULL, '3', 4, '2021-03-10 09:14:31'),
(38, 13, 13000, 99, 12901, 'ATM_olevi', NULL, '4', 4, '2021-03-12 11:41:28'),
(39, 13, 12901, 99, 12802, 'ATM_mo3i3', NULL, '4', 4, '2021-03-12 11:41:59'),
(40, 13, 12802, 99, 12703, 'ATM_4a1er', NULL, '4', 4, '2021-03-12 12:45:31'),
(41, 13, 12703, 118.8, 12584.2, 'ATM_aruka', NULL, '4', 4, '2021-03-12 12:50:46'),
(42, 13, 12584.2, 118.8, 12465.4, 'ATM_du7an', NULL, '4', 4, '2021-03-12 12:54:25'),
(43, 13, 12465.4, 118.8, 12346.6, 'ATM_8ohuc', NULL, '4', 4, '2021-03-12 12:56:27'),
(44, 13, 12346.6, 99, 12247.6, 'ATM_go6ad', NULL, '4', 4, '2021-03-12 13:01:21'),
(45, 13, 12247.6, 121.77, 12125.83, 'ATM_etofa', NULL, '4', 4, '2021-03-12 13:04:46'),
(51, 12, 370, 9.9, 360.1, 'ATM_2i2op', NULL, '4', 4, '2021-03-12 15:53:37'),
(52, 12, 360.1, 9.9, 350.2, 'ATM_jigeh', NULL, '4', 4, '2021-03-12 15:55:03'),
(53, 12, 350.2, 9.9, 340.3, 'ATM_3afox', NULL, '4', 4, '2021-03-12 15:57:49'),
(54, 12, 340.3, 9.9, 330.4, 'ATM_lesow', NULL, '4', 4, '2021-03-12 16:00:07'),
(55, 12, 330.4, 9.9, 320.5, 'ATM_9alup', NULL, '4', 4, '2021-03-12 16:01:13'),
(56, 12, 320.5, 9.9, 310.6, 'ATM_tavex', NULL, '4', 4, '2021-03-12 16:01:49'),
(57, 12, 310.6, 9.9, 300.7, 'ATM_uzu6e', NULL, '4', 4, '2021-03-12 16:02:50'),
(58, 12, 300.7, 9.9, 290.8, 'ATM_5e3am', NULL, '4', 4, '2021-03-12 16:04:57'),
(59, 12, 290.8, 9.9, 280.9, 'ATM_bivup', NULL, '4', 4, '2021-03-12 16:48:21'),
(60, 12, 280.9, 9.9, 271, 'ATM_amepa', NULL, '4', 4, '2021-03-12 16:48:50'),
(61, 12, 271, 9.9, 261.1, 'ATM_a9uri', NULL, '4', 4, '2021-03-12 16:49:42'),
(62, 12, 261.1, 9.9, 251.2, 'ATM_nuvot', NULL, '4', 4, '2021-03-12 16:50:21'),
(63, 12, 251.2, 9.9, 241.3, 'ATM_e3aya', NULL, '4', 4, '2021-03-12 16:52:22'),
(64, 12, 241.3, 9.9, 231.4, 'ATM_fa5i7', NULL, '4', 4, '2021-03-12 16:53:03'),
(65, 12, 231.40000000001, 9.9, 221.50000000001, 'ATM_livaq', NULL, '4', 4, '2021-03-12 16:53:55'),
(66, 12, 221.50000000001, 9.9, 211.60000000001, 'ATM_vinif', NULL, '4', 4, '2021-03-12 16:54:45'),
(67, 12, 211.60000000001, 9.9, 201.70000000001, 'ATM_vo6ij', NULL, '4', 4, '2021-03-12 17:08:27'),
(68, 12, 201.70000000001, 9.9, 191.80000000001, 'ATM_ojuja', NULL, '4', 4, '2021-03-12 17:09:28'),
(69, 12, 191.80000000001, 9.9, 181.90000000001, 'ATM_porof', NULL, '4', 4, '2021-03-12 17:36:47'),
(70, 12, 181.90000000001, 9.9, 172.00000000001, 'ATM_cehiy', NULL, '4', 4, '2021-03-12 17:37:29'),
(71, 12, 172.00000000001, 9.9, 162.10000000001, 'ATM_getey', NULL, '4', 4, '2021-03-12 17:40:47'),
(72, 12, 162.10000000001, 9.9, 152.20000000001, 'ATM_li3al', NULL, '4', 4, '2021-03-12 17:41:29'),
(73, 12, 152.20000000001, 49.5, 102.70000000001, 'ATM_quxed', NULL, '4', 4, '2021-03-12 18:24:33'),
(74, 12, 102.70000000001, 99, 3.700000000008, 'ATM_uxu2a', NULL, '4', 4, '2021-03-13 11:56:20'),
(75, 13, 12125.83, 9.9, 12115.93, 'ATM_lixek', '716914693455', '4', 4, '2021-03-13 18:20:05'),
(76, 13, 12115.93, 9.9, 12106.03, 'ATM_vakok', '897496945096', '4', 4, '2021-03-13 20:29:55'),
(77, 13, 12206.03, 10, 12196.03, 'SWA_e6e8u', NULL, '3', 6, '2021-03-14 15:17:36'),
(78, 13, 12196.03, 4300, 7896.03, 'SWA_0iwov', NULL, '3', 6, '2021-03-14 15:38:23'),
(79, 13, 7896.03, 896, 7000.03, 'SWA_elo1e', NULL, '3', 6, '2021-03-14 15:40:40'),
(80, 12, 5209.7, 9.9, 5199.8, 'ATM_2osa2', '697167098192', '4', 4, '2021-03-14 15:59:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_plan`
--
ALTER TABLE `product_plan`
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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Indexes for table `wallet_out`
--
ALTER TABLE `wallet_out`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_plan`
--
ALTER TABLE `product_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_options`
--
ALTER TABLE `site_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wallet_in`
--
ALTER TABLE `wallet_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `wallet_out`
--
ALTER TABLE `wallet_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
