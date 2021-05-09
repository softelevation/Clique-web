-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2021 at 05:40 PM
-- Server version: 8.0.23
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clique`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`clique`@`localhost` PROCEDURE `GetNearByUsers` (IN `lat` FLOAT, IN `long1` FLOAT, IN `km` INT)  BEGIN
SELECT * FROM ( SELECT *, ( ( ( acos( sin(( lat * pi() / 180)) * sin(( `current_lat` * pi() / 180)) + cos(( lat * pi() /180 )) * cos(( `current_lat` * pi() / 180)) * cos((( long1 - `current_long`) * pi()/180))) ) * 180/pi() ) * 60 * 1.1515 * 1.609344 ) as distance FROM `users_profile` ) users_profile WHERE distance <= km and distance >= -km ORDER BY distance ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `card_items`
--

CREATE TABLE `card_items` (
  `id` bigint UNSIGNED NOT NULL,
  `card_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku_id` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint DEFAULT NULL,
  `assign_user_id` bigint DEFAULT NULL,
  `is_purchase` tinyint UNSIGNED DEFAULT NULL,
  `is_sell` tinyint UNSIGNED DEFAULT NULL,
  `purchase_date` timestamp NULL DEFAULT NULL,
  `sell_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card_items`
--

INSERT INTO `card_items` (`id`, `card_id`, `sku_id`, `user_id`, `order_id`, `assign_user_id`, `is_purchase`, `is_sell`, `purchase_date`, `sell_date`, `active_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, '04362A52D55681', 2020000002, 153, 11, 153, 1, 0, '2020-12-04 08:02:15', '2020-12-04 11:10:18', NULL, '2020-12-04 08:02:15', '2020-12-04 11:10:18', NULL),
(13, '04372A52D55681', 2020000003, 193, 12, 193, 1, 0, '2020-12-09 16:06:27', '2020-12-09 16:13:24', NULL, '2020-12-09 16:06:27', '2020-12-09 16:06:34', NULL),
(16, '0x04362a52d55643', 2020000006, 198, 15, NULL, 1, 0, '2020-12-23 10:22:41', '2020-12-23 10:34:01', NULL, '2020-12-23 10:22:41', '2020-12-23 10:34:01', NULL),
(17, '04362a52d55601', 2020000007, 198, 17, NULL, 1, 0, '2020-12-23 12:25:57', '2020-12-23 12:26:43', NULL, '2020-12-23 12:25:57', '2020-12-23 12:26:43', NULL),
(18, '04362a52d55602', 2020000008, 198, 17, NULL, 1, 0, '2020-12-23 12:26:15', '2020-12-23 12:26:43', NULL, '2020-12-23 12:26:15', '2020-12-23 12:26:43', NULL),
(19, '04362a52d55603', 2020000009, 198, 16, NULL, 1, 0, '2020-12-23 12:26:23', '2020-12-23 12:27:30', NULL, '2020-12-23 12:26:23', '2020-12-23 12:27:30', NULL),
(20, '04362a52d55604', 2020000010, 198, 16, NULL, 1, 0, '2020-12-23 12:27:25', '2020-12-23 12:27:30', NULL, '2020-12-23 12:27:25', '2020-12-23 12:27:30', NULL),
(21, '04362a52d55606', 2020000011, 204, 18, 210, 1, 0, '2020-12-23 12:31:58', '2020-12-23 12:32:36', NULL, '2020-12-23 12:31:58', '2020-12-23 12:32:36', NULL),
(22, '0x04362a52d55693', 2021000012, 222, 22, 223, 1, 0, '2021-03-02 06:54:55', '2021-03-02 12:42:09', NULL, '2021-03-02 06:54:55', '2021-03-02 12:42:09', NULL),
(23, '0x04362a52d55694', 2021000013, 222, 22, 223, 1, 0, '2021-03-02 06:55:08', '2021-03-02 10:15:28', NULL, '2021-03-02 06:55:08', '2021-03-02 10:15:28', NULL),
(24, '12345678901234', 2021000014, 222, 23, 223, 1, 0, '2021-03-02 10:18:49', '2021-03-02 12:42:04', NULL, '2021-03-02 10:18:49', '2021-03-02 12:42:04', NULL),
(25, '04362a52d55753', 2021000015, NULL, 24, NULL, 1, 0, '2021-03-02 10:19:31', '2021-03-19 05:55:23', NULL, '2021-03-02 10:19:31', '2021-03-19 05:55:23', NULL),
(26, '04362a52d55876', 2021000016, NULL, 24, NULL, 1, 0, '2021-03-02 10:20:50', '2021-03-19 05:57:35', NULL, '2021-03-02 10:20:50', '2021-03-19 05:57:35', NULL),
(27, '0x04362a52d55646', 2021000017, 215, 26, NULL, 1, 0, '2021-03-08 07:05:26', '2021-03-31 13:22:43', NULL, '2021-03-08 07:05:26', '2021-03-31 13:22:43', NULL),
(28, '04CAA50A437080', 2021000018, 231, 26, 231, 1, 1, '2021-03-31 12:35:13', '2021-04-28 09:57:14', NULL, '2021-03-31 12:35:13', '2021-04-28 09:57:14', NULL),
(30, '04BF9F0A437080', 2021000019, 240, 26, 240, 1, 1, '2021-03-31 12:39:52', '2021-04-29 11:14:44', NULL, '2021-03-31 12:39:52', '2021-04-29 11:14:44', NULL),
(31, '04C01C0A437080', 2021000020, 215, 26, NULL, 1, 0, '2021-03-31 12:41:35', '2021-03-31 13:22:43', NULL, '2021-03-31 12:41:35', '2021-03-31 13:22:43', NULL),
(32, '049E700A437080', 2021000021, 215, 26, 215, 1, 1, '2021-03-31 12:43:11', '2021-04-10 12:56:28', NULL, '2021-03-31 12:43:11', '2021-04-10 12:56:28', NULL),
(33, '0498A10A437080', 2021000022, 215, 26, NULL, 1, 0, '2021-03-31 12:44:13', '2021-03-31 13:22:43', NULL, '2021-03-31 12:44:13', '2021-03-31 13:22:43', NULL),
(34, '0476A00A437081', 2021000023, 215, 26, NULL, 1, 0, '2021-03-31 12:45:17', '2021-03-31 13:22:43', NULL, '2021-03-31 12:45:17', '2021-03-31 13:22:43', NULL),
(35, '04CD9F0A437080', 2021000024, 239, 26, 239, 1, 1, '2021-03-31 12:46:43', '2021-04-29 11:05:39', NULL, '2021-03-31 12:46:43', '2021-04-29 11:05:39', NULL),
(37, '04982F12437080', 2021000026, 215, 26, NULL, 1, 0, '2021-03-31 12:48:10', '2021-03-31 13:22:43', NULL, '2021-03-31 12:48:10', '2021-03-31 13:22:43', NULL),
(38, '04B54B0A437080', 2021000027, 247, NULL, 247, 1, 1, '2021-03-31 12:49:11', '2021-05-03 14:55:50', NULL, '2021-03-31 12:49:11', '2021-05-03 14:55:50', NULL),
(39, '04339D0A437081', 2021000028, NULL, NULL, NULL, 1, 0, '2021-03-31 12:49:40', '2021-03-31 12:49:40', NULL, '2021-03-31 12:49:40', '2021-03-31 12:49:40', NULL),
(40, '04372A52D55681', 2021000029, NULL, NULL, NULL, 1, 0, '2021-03-31 13:14:11', '2021-03-31 13:14:11', NULL, '2021-03-31 13:14:11', '2021-03-31 13:14:11', NULL),
(45, '04EABB52D55682', 2021000031, NULL, NULL, NULL, 1, 0, '2021-04-09 12:46:56', '2021-04-09 12:46:56', NULL, '2021-04-09 12:46:56', '2021-04-09 12:46:56', NULL),
(48, '0413B852D55680', 2021000032, NULL, NULL, NULL, 1, 0, '2021-04-10 09:17:24', '2021-04-10 09:17:24', NULL, '2021-04-10 09:17:24', '2021-04-10 09:17:24', NULL),
(49, '04:9E:70:0A:43:70:80', 2021000033, NULL, NULL, NULL, 1, 0, '2021-04-10 12:55:36', '2021-04-10 12:55:36', NULL, '2021-04-10 12:55:36', '2021-04-10 12:55:36', NULL),
(50, '04:04:1D:12:43:70:81', 2021000034, NULL, NULL, NULL, 1, 0, '2021-04-18 10:52:34', '2021-04-18 10:52:34', NULL, '2021-04-18 10:52:34', '2021-04-18 10:52:34', NULL),
(51, '04:76:A0:0A:43:70:81', 2021000035, NULL, NULL, NULL, 1, 0, '2021-04-18 10:53:25', '2021-04-18 10:53:25', NULL, '2021-04-18 10:53:25', '2021-04-18 10:53:25', NULL),
(52, '04:12:9F:0A:43:70:80', 2021000036, NULL, NULL, NULL, 1, 0, '2021-04-18 10:53:52', '2021-04-18 10:53:52', NULL, '2021-04-18 10:53:52', '2021-04-18 10:53:52', NULL),
(55, '04:D6:46:DA:3C:70:80', 2021000037, NULL, NULL, NULL, 1, 0, '2021-05-03 14:48:30', '2021-05-03 14:48:30', NULL, '2021-05-03 14:48:30', '2021-05-03 14:48:30', NULL),
(58, '04EABB52D55680', 2021000038, 248, NULL, 248, 1, 1, '2021-05-04 10:00:42', '2021-05-04 10:01:22', NULL, '2021-05-04 10:00:42', '2021-05-04 10:01:22', NULL),
(60, '049146DA3C7080', 2021000039, NULL, NULL, NULL, 1, 0, '2021-05-04 12:32:09', '2021-05-04 12:32:09', NULL, '2021-05-04 12:32:09', '2021-05-04 12:32:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `name`, `email`, `address`, `website`, `phone`, `logo`, `description`, `number`, `facebook`, `instagram`, `linkedin`, `twitter`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 152, 'Infosys', 'Infosys@gmail.com', 'near sg business hub \r\nsg hight way', 'www.infosyis.com', '91-8787 878 787', '/avatars/152_avatar1603969365.jpeg', NULL, '91-8787 878 787', 'inforsis@facebook', 'linforsis@instagram', 'inforsis@linkedin', 'inforsis@twitter', NULL, '2020-10-29 11:02:45', '2020-10-29 13:16:08', NULL),
(2, 157, 'wipro', 'wipro@gmail.com', 'near the alfa one mall\r\nbehind the income tax office', 'www.wipro.com', '91-9898 565 643', '/avatars/157_avatar1603973474.jpeg', NULL, '91-9898 565 643', 'wipro@99', 'insta@wipro', 'wipro@linkedin', 'wipro@twitter', NULL, '2020-10-29 12:11:14', '2020-10-29 14:37:18', NULL),
(3, 158, 'tata', 'tata@gmail.com', NULL, NULL, '91-2323 456 789', '/avatars/158_avatar1603973805.jpeg', NULL, '91-2323 456 789', NULL, NULL, NULL, NULL, NULL, '2020-10-29 12:16:45', '2020-10-29 12:16:45', NULL),
(4, 159, 'webtual', 'webtual@gmail.com', NULL, NULL, '91-1254 127 787', '/avatars/159_avatar1603973895.jpg', NULL, '91-1254 127 787', NULL, NULL, NULL, NULL, NULL, '2020-10-29 12:18:15', '2020-10-29 12:18:15', NULL),
(5, 160, 'tcs', 'tcs@gmail.com', NULL, NULL, '91-8865000431', '/avatars/160_avatar1603974625.jpeg', NULL, '91-8865 000 431', NULL, NULL, NULL, NULL, NULL, '2020-10-29 12:30:25', '2020-10-29 12:30:25', NULL),
(6, 163, 'webtual2', 'laravel007.bhavesh@gmail.com', 'near the garden station road\r\nbehing the fard', 'www.webtual.com', '91-6767676767', '/avatars/163_avatar1604140620.jpg', NULL, '91-6767676767', 'webtual@99', 'webtual@99', 'linkdin@99', 'webtual@twitter', NULL, '2020-10-31 10:37:00', '2020-10-31 10:43:35', NULL),
(7, 154, 'Wipro', 'hsshhs@gmail.com', 'bbbbb', 'qfafag.com', NULL, '/company/154_logo1604396517.png', NULL, '91-1234567890', NULL, NULL, NULL, NULL, 1, '2020-11-02 11:34:38', '2021-03-05 11:57:31', NULL),
(8, 154, 'Wipro', 'jajaj@gmail.com', 'trttt', 'shwhha.com', NULL, '/company/154_logo1604316925.png', NULL, '91-2395890856', NULL, NULL, NULL, NULL, 1, '2020-11-02 11:35:25', '2021-03-05 10:49:45', NULL),
(9, 191, 'paresh', 'paresh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-27 11:24:29', '2020-11-27 11:24:29', NULL),
(10, 197, 'webtual', 'webtual@gmail.com', 'gota', 'webtual.com', NULL, '/company/197_logo1608717963.png', NULL, '91-2356895869', NULL, NULL, NULL, NULL, 1, '2020-12-23 10:06:03', '2020-12-23 10:06:03', NULL),
(11, 204, 'corporat_Androidtesting', 'androidcorporate@yopmail.com', NULL, NULL, '91-6541239870', '/avatars/204_avatar1608720284.jpg', NULL, '91-6541239870', NULL, NULL, NULL, NULL, NULL, '2020-12-23 10:44:44', '2020-12-23 10:44:44', NULL),
(12, 205, 'Webesoft23', 'webesoft23@yopmail.com', NULL, NULL, '91-6547887732', NULL, NULL, '91-6547887732', NULL, NULL, NULL, NULL, NULL, '2020-12-23 10:44:46', '2020-12-23 10:44:46', NULL),
(13, 214, 'test company', 'gsgsgsggs@gshs.com', 'hahhahaha', 'sggsgshs.com', NULL, '/company/214_logo1608889629.png', NULL, '91-3698523690', NULL, NULL, NULL, NULL, 1, '2020-12-25 09:47:09', '2020-12-25 09:47:09', NULL),
(14, 222, 'MANOJCORPORATE', 'corporateadmin@yopmail.com', NULL, NULL, '91-5467890214', '/avatars/222_avatar1614664728.jpg', NULL, '91-5467890214', NULL, NULL, NULL, NULL, NULL, '2021-03-02 05:58:48', '2021-03-02 05:58:48', NULL),
(15, 154, 'Webtual', 'jajaj@gmail.com', 'S G. Business hub, Gota, Ahmedabad', 'shwhha.com', NULL, '/user/default.png', NULL, '91-2395890856', 'Facebook@webtual', 'insta@webtual', 'LinkedIn@webtual', 'Twitter@webtual', 1, '2021-03-05 10:18:08', '2021-03-05 10:18:08', NULL),
(16, 228, 'webtual 400', 'webtual300@gmail.com', 'near the garden , station road', 'www.webtual.com', NULL, '/user/default.png', NULL, '91-8888888888', 'webtial@facebook', NULL, 'webtial@linkdin', 'twwiter@webtial', 1, '2021-03-22 10:25:39', '2021-03-22 10:25:39', NULL),
(17, 193, 'Webtual', 'wrghawruae', 'Got a, SG Highway', 'afaf', NULL, '/company/193_logo1617257896.png', NULL, '91-123466789', 'seurjfgx', 'aerha', 'xgnfnx', 'fgnsjsmsyt', 1, '2021-04-01 06:18:16', '2021-04-01 06:27:52', NULL),
(18, 193, 'Webtual', NULL, 'Got a, SG Highway', NULL, NULL, '/company/193_logo1617257953.png', NULL, '91-', NULL, NULL, NULL, NULL, 1, '2021-04-01 06:19:13', '2021-04-01 06:19:13', NULL),
(19, 219, 'Webtual', NULL, 'GOTA, AHMEDABAD', NULL, NULL, '/user/default.png', NULL, '91-1234567890', NULL, 'nmumang', NULL, NULL, 1, '2021-04-01 06:38:20', '2021-04-08 13:02:47', NULL),
(20, 219, 'Testing', NULL, 'Testing', NULL, NULL, '/user/default.png', NULL, '91-8511671085', NULL, NULL, NULL, NULL, 1, '2021-04-01 06:42:16', '2021-04-05 10:47:05', NULL),
(21, 215, 'Clique', NULL, 'No.5 Panathur Main road, Bangalore', NULL, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-29 11:25:19', '2021-04-29 11:25:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE `company_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `job_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_users`
--

INSERT INTO `company_users` (`id`, `user_id`, `company_id`, `job_position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 155, 1, 'laravel developer', '2020-10-29 11:38:31', '2020-10-29 11:38:31', NULL),
(2, 156, 1, 'wrodpress developer', '2020-10-29 11:39:19', '2020-10-29 11:39:19', NULL),
(3, 161, 2, 'Jr Laravel developer', '2020-10-29 14:39:07', '2020-10-29 14:39:07', NULL),
(4, 164, 6, 'directer', '2020-10-31 10:58:00', '2020-10-31 10:58:00', NULL),
(5, 154, 7, 'developee', '2020-11-02 11:34:38', '2020-11-02 11:34:38', NULL),
(6, 154, 8, 'tester', '2020-11-02 11:35:25', '2020-11-02 11:35:25', NULL),
(7, 186, 1, 'bbb technologies', '2020-11-03 13:19:44', '2020-11-03 13:19:44', NULL),
(8, 195, 4, NULL, '2020-12-23 09:49:41', '2020-12-23 09:49:41', NULL),
(9, 197, 10, 'tester', '2020-12-23 10:06:03', '2020-12-23 10:06:03', NULL),
(10, 199, 1, 'CEO', '2020-12-23 10:38:25', '2020-12-23 10:38:25', NULL),
(11, 210, 11, 'Manager', '2020-12-23 12:28:55', '2020-12-23 12:28:55', NULL),
(12, 214, 13, 'bsjshjsjs', '2020-12-25 09:47:09', '2020-12-25 09:47:09', NULL),
(13, 221, 4, 'Manager', '2021-03-02 05:55:56', '2021-03-02 05:55:56', NULL),
(14, 223, 14, 'BDE', '2021-03-02 10:15:06', '2021-03-02 10:15:06', NULL),
(15, 154, 15, 'tester', '2021-03-05 10:18:08', '2021-03-05 10:18:08', NULL),
(16, 228, 16, 'mmm developer', '2021-03-22 10:25:39', '2021-03-22 10:25:39', NULL),
(17, 193, 17, 'Manager', '2021-04-01 06:18:16', '2021-04-01 06:18:16', NULL),
(18, 193, 18, 'Manager', '2021-04-01 06:19:13', '2021-04-01 06:19:13', NULL),
(19, 219, 19, 'Mobile Developer', '2021-04-01 06:38:20', '2021-04-01 06:38:20', NULL),
(20, 219, 20, 'Tester', '2021-04-01 06:42:16', '2021-04-01 06:42:16', NULL),
(21, 215, 21, 'Co Founder', '2021-04-29 11:25:19', '2021-04-29 11:26:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `mobile_number`, `subject`, `comment`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 'vikas', 'vakas@gmail.com', '9904983567', 'buy card', 'This is only for testing', '2020-09-28 22:16:14', '2020-09-28 22:16:14', NULL, NULL),
(2, 'bhavesh', 'bhavesh@gmail.com', '08320008658', 'testsdf', 'this is only testig parpose', '2020-09-28 22:16:45', '2020-09-28 22:16:45', NULL, NULL),
(3, 'janak', 'janak@gmail.com', '234242423', 'testsdf', 'very nice', '2020-09-28 22:18:25', '2020-09-28 22:18:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `corporate_request`
--

CREATE TABLE `corporate_request` (
  `id` int NOT NULL,
  `corporate_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `corporate_request`
--

INSERT INTO `corporate_request` (`id`, `corporate_name`, `contact_person`, `address`, `email`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tata', 'bhavesh', 'near the garden station road\r\nbehing the fard', 'laravel007.bhavesh@gmail.com', '8320008658', '2020-11-28 03:32:35', '2020-11-28 03:32:35', NULL),
(2, 'bajaj', 'vinod', 'near the garden station road\r\nbehing the fard', 'vinod@gmail.com', '8888888888', '2020-11-28 03:36:54', '2020-11-28 03:36:54', NULL),
(3, 'infosys', 'vinod', 'shivam hingwali street , new plot bind garden', 'vania.bhavesh.soft@gmail.com', '9904983567', '2020-11-28 17:30:52', '2020-11-28 17:30:52', NULL),
(4, 'cignet', 'bhavesh', 'shivam hingwali street , new plot bind garden', 'vania.bhavesh.soft@gmail.com', '9904983567', '2020-11-28 18:51:58', '2020-11-28 18:51:58', NULL),
(5, 'joy ltd', 'bhavesh', 'near the garden station road\r\nbehing the fard', 'vania.bhavesh.soft@gmail.com', '9904983567', '2020-11-28 18:54:03', '2020-11-28 18:54:03', NULL),
(6, 'bajaj', 'vinod', 'near the garden station road\r\nbehing the fard', 'vania.bhavesh.soft@gmail.com', '9904983567', '2020-11-28 18:56:25', '2020-11-28 18:56:25', NULL),
(7, 'bajaj', 'vinod', 'near the garden station road\r\nbehing the fard', 'vania.bhavesh.soft@gmail.com', '8320008658', '2020-11-28 19:01:43', '2020-11-28 19:01:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2020_08_19_074719_create_users_profile', 3),
(5, '2020_08_27_101039_create_social_network_table', 4),
(6, '2020_08_27_101934_create_company_table', 5),
(7, '2020_09_05_193017_create_test_table', 6),
(8, '2020_09_05_194409_create_test123_table', 7),
(9, '2020_09_05_195012_create_users_otp__table', 8),
(10, '2020_09_05_195420_create_users_otp_table', 9),
(11, '2020_09_16_101733_create_company_users_table', 10),
(12, '2020_09_16_103313_create_companyusers_new_table', 11),
(13, '2020_09_16_103620_create_company_users_table', 12),
(14, '2020_09_17_071353_create_card_items_table', 13),
(15, '2020_09_21_102615_create_user_contact_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_number` varchar(15) DEFAULT NULL,
  `qty` int NOT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `firstname` varchar(155) DEFAULT NULL,
  `lastname` varchar(155) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `billing_address` text,
  `shipping_address` text,
  `country_id` int DEFAULT NULL,
  `state` varchar(155) DEFAULT NULL,
  `zip` varchar(155) DEFAULT NULL,
  `subscription_type` varchar(50) DEFAULT NULL,
  `payment_type` varchar(155) DEFAULT NULL,
  `payment_status` varchar(155) DEFAULT NULL,
  `tx_ref_id` varchar(155) DEFAULT NULL,
  `assign_card` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `qty`, `amount`, `phone`, `firstname`, `lastname`, `email`, `billing_address`, `shipping_address`, `country_id`, `state`, `zip`, `subscription_type`, `payment_type`, `payment_status`, `tx_ref_id`, `assign_card`, `created_at`, `updated_at`) VALUES
(3, NULL, 'ORD000003', 1, 100.00, '8888888888', 'vikey desoza', NULL, 'vikey@gmail.com', 'near the garden station road\r\nbehing the fard', NULL, 100, 'Gujarat', '382481', NULL, NULL, NULL, NULL, NULL, '2020-11-23 13:09:09', '2020-11-23 13:09:09'),
(11, 153, 'ORD000010', 1, 100.00, '91-8320008656', 'ashvini', NULL, 'ashvini@gmail.com', 'hshshssh', NULL, 100, 'shhshs', '123456', NULL, NULL, NULL, NULL, 153, '2020-12-04 07:46:46', '2020-12-04 08:02:22'),
(12, 193, 'ORD000011', 1, 100.00, '91-8866006401', 'bhargav', NULL, 'bmistri@webtual.com', 'this.is@addrss', NULL, 100, 'Gujarat', '382470', NULL, NULL, NULL, NULL, 193, '2020-12-09 15:53:23', '2020-12-09 16:06:34'),
(13, 154, 'ORD000012', 1, 100.00, '91-8758662075', 'Constant', NULL, 'dsiduidosoif@gmail.com', 'shhdhdu', NULL, 100, 'hshhshs', '123456', NULL, NULL, NULL, NULL, 154, '2020-12-10 07:20:19', '2020-12-10 07:20:47'),
(14, 164, 'ORD000013', 1, 100.00, '91-9978619860', 'ankit shah', NULL, 'ashah@webtual.com', 'fyyy', NULL, 100, 'ggg', '123456', NULL, NULL, NULL, NULL, 164, '2020-12-10 08:50:22', '2020-12-10 08:51:28'),
(15, 198, 'ORD000014', 1, 100.00, '91-2626262626', 'tester', NULL, 'test@gmail.com', 'Webtual Gota Ahmedabad', NULL, 100, 'Gujarat', '382481', NULL, NULL, NULL, NULL, 198, '2020-12-23 10:32:55', '2020-12-23 10:34:01'),
(17, 198, 'ORD000016', 2, 100.00, '91-2020202020', 'tester', NULL, 'test@gmail.com', 'Gota Ahmedabad', NULL, 100, 'Gujarat', '382481', NULL, NULL, NULL, NULL, 198, '2020-12-23 12:19:06', '2020-12-23 12:26:43'),
(18, 204, 'ORD000017', 1, NULL, '91-6541239870', 'corporat_Androidtesting', NULL, 'androidcorporate@yopmail.com', 'H-302, SG Business Hub, SG Highway, near Gota Bridge, Ognaj, Ahmedabad', NULL, 100, 'Gujarat', '380060', NULL, NULL, NULL, NULL, 204, '2020-12-23 12:30:57', '2020-12-23 12:32:05'),
(19, 154, 'ORD000018', 1, 100.00, '91-8758662075', 'Constant', NULL, 'testing@gmail.com', 'webtual technologies', NULL, 100, 'Gujarat', '382481', NULL, NULL, NULL, NULL, NULL, '2021-03-01 07:08:20', '2021-03-01 07:08:20'),
(20, 154, 'ORD000019', 2, 100.00, '91-8758662075', 'Constant', NULL, 'dsiduidosoif@gmail.com', 'webtual testing', NULL, 100, 'gujarat', '382481', NULL, NULL, NULL, NULL, NULL, '2021-03-01 07:09:10', '2021-03-01 07:09:10'),
(21, 154, 'ORD000020', 10, 100.00, '91-8758662075', 'Constant', NULL, 'dsiduidosoif@gmail.com', 'Webtual technologies', NULL, 100, 'Gujarat', '382480', NULL, NULL, NULL, NULL, NULL, '2021-03-01 07:11:01', '2021-03-01 07:11:01'),
(22, 222, 'ORD000021', 2, NULL, '91-5467890214', 'MANOJCORPORATE', NULL, 'corporateadmin@yopmail.com', 'H-302, SG Business Hub, SG Highway, near Gota Bridge, Ognaj, Ahmedabad', NULL, 7, 'Gujarat', '380060', NULL, NULL, NULL, NULL, 222, '2021-03-02 06:06:51', '2021-03-02 06:55:20'),
(24, NULL, 'ORD000022', 2, 100.00, '9874565111', 'Prakash', NULL, 'ptank@webtual.com', 'Test address', NULL, 100, 'Gujarat', '362100', NULL, NULL, NULL, NULL, 1, '2021-03-19 05:47:54', '2021-03-19 05:55:23'),
(25, 228, 'ORD000023', 1, 10000.00, '9904983733', 'jonson', 'martin', 'joson@gmail.com', 'near the garden satation road', 'near hign wali station', 2, 'gujartt', '364250', NULL, NULL, NULL, NULL, 228, '2021-03-22 11:14:57', '2021-04-09 11:22:21'),
(26, 215, 'ORD000024', 10, 100.00, '91-8971235696', 'Tejus', NULL, 'tejusreddy93@gmail.com', 'Clique', NULL, 100, 'Karnataka', '560087', NULL, NULL, NULL, NULL, 215, '2021-03-31 13:18:40', '2021-03-31 13:22:43'),
(27, 238, 'ORD000025', 5555, 100.00, '91-9265701475', 'Ajay', NULL, 'Mishraajay9898@gmail.com', 'Bb', NULL, 100, 'Hhhh', '99996666', NULL, NULL, NULL, NULL, NULL, '2021-04-27 08:13:26', '2021-04-27 08:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(4, 'About us', 'about-us', '<h3><b>Know More About Us</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:56:36', NULL, 1, 1, NULL),
(5, 'Terms of sale', 'terms-of-sale', '<h3><b>Terms Of Sale</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:56:21', NULL, 1, 1, NULL),
(6, 'Terms of use', 'terms-of-use', '<h3><b>Terms Of use</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:56:11', NULL, 1, 1, NULL),
(7, 'Returns', 'returns', '<h3><b>Returns</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:55:55', NULL, 1, 1, NULL),
(8, 'Privacy', 'privacy', '<h3><b>Privacy</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:55:43', NULL, 1, 1, NULL),
(9, 'Cookies', 'cookies', '<h3><b>Cookies</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:55:31', NULL, 1, 1, NULL),
(11, 'Copyright Policy', 'copyright-policy', '<h3><b>Copyright Policy</b></h3><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p><p><span style=\"font-size: 1rem;\">Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</span><br></p><p><br></p><p><br></p>', '2020-06-22 18:43:31', '2020-06-22 18:55:43', NULL, 1, 1, NULL),
(12, 'Our Story', 'our-story', '<p><b>Our Story</b></p><p><b><br></b><br>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.<br></p><p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.<br></p><p><br></p><p><br></p>', '2020-08-30 22:45:53', '2020-08-30 22:45:53', NULL, 1, 1, NULL),
(13, 'FAQ', 'faq', '<p><b>FAQ<br><br></b>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.<br><br>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.<b><br></b></p>', '2020-08-30 22:47:05', '2020-08-30 22:47:05', NULL, 1, 1, NULL),
(14, 'mypages', 'mypages', NULL, '2020-09-10 00:52:18', '2020-09-10 00:52:18', NULL, 1, 1, NULL),
(15, 'kkkkk', 'kkkkk', '<p>skdjfhskjahg askdg klsgksagkhks skdjgh</p>', '2020-09-10 00:53:56', '2020-09-10 00:53:56', NULL, 1, 1, NULL),
(16, 'ppppp', 'ppppp', NULL, '2020-09-10 00:55:01', '2020-09-10 00:55:01', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `sequence` int DEFAULT NULL,
  `role_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 : Admin, 0 : Users',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `sequence`, `role_name`, `slug`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Admin', 'admin', '1', NULL, NULL, NULL),
(2, NULL, 'Individual', 'individual', '0', NULL, NULL, NULL),
(3, NULL, 'Corporate Admin', 'corporate_admin', '0', '2020-09-10 13:00:00', NULL, NULL),
(4, NULL, 'Corporate User', 'corporate_user', '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(62, 152, 3, '2020-10-29 11:02:45', '2020-10-29 11:02:45', NULL),
(63, 153, 2, '2020-10-29 11:04:41', '2020-10-29 11:04:41', NULL),
(64, 154, 2, '2020-10-29 11:04:44', '2020-10-29 11:04:44', NULL),
(65, 155, 4, '2020-10-29 11:38:31', '2020-10-29 11:38:31', NULL),
(66, 156, 4, '2020-10-29 11:39:19', '2020-10-29 11:39:19', NULL),
(67, 157, 3, '2020-10-29 12:11:14', '2020-10-29 12:11:14', NULL),
(68, 158, 3, '2020-10-29 12:16:45', '2020-10-29 12:16:45', NULL),
(69, 159, 3, '2020-10-29 12:18:15', '2020-10-29 12:18:15', NULL),
(70, 160, 3, '2020-10-29 12:30:25', '2020-10-29 12:30:25', NULL),
(71, 161, 4, '2020-10-29 14:39:07', '2020-10-29 14:39:07', NULL),
(72, 162, 2, '2020-10-31 09:25:52', '2020-10-31 09:25:52', NULL),
(73, 163, 3, '2020-10-31 10:37:00', '2020-10-31 10:37:00', NULL),
(74, 164, 4, '2020-10-31 10:58:00', '2020-10-31 10:58:00', NULL),
(75, 165, 2, '2020-11-02 10:43:56', '2020-11-02 10:43:56', NULL),
(76, 166, 2, '2020-11-03 09:42:41', '2020-11-03 09:42:41', NULL),
(77, 167, 2, '2020-11-03 11:18:06', '2020-11-03 11:18:06', NULL),
(78, 168, 2, '2020-11-03 11:18:29', '2020-11-03 11:18:29', NULL),
(79, 169, 2, '2020-11-03 11:21:22', '2020-11-03 11:21:22', NULL),
(80, 170, 2, '2020-11-03 11:22:51', '2020-11-03 11:22:51', NULL),
(81, 171, 2, '2020-11-03 11:23:20', '2020-11-03 11:23:20', NULL),
(82, 172, 2, '2020-11-03 11:30:26', '2020-11-03 11:30:26', NULL),
(83, 173, 2, '2020-11-03 11:30:44', '2020-11-03 11:30:44', NULL),
(84, 174, 2, '2020-11-03 11:31:02', '2020-11-03 11:31:02', NULL),
(85, 175, 2, '2020-11-03 11:36:41', '2020-11-03 11:36:41', NULL),
(86, 176, 2, '2020-11-03 11:36:57', '2020-11-03 11:36:57', NULL),
(87, 177, 2, '2020-11-03 11:37:19', '2020-11-03 11:37:19', NULL),
(88, 178, 2, '2020-11-03 11:55:10', '2020-11-03 11:55:10', NULL),
(89, 179, 2, '2020-11-03 11:56:40', '2020-11-03 11:56:40', NULL),
(90, 180, 2, '2020-11-03 11:56:57', '2020-11-03 11:56:57', NULL),
(91, 181, 2, '2020-11-03 12:04:14', '2020-11-03 12:04:14', NULL),
(92, 182, 2, '2020-11-03 12:04:37', '2020-11-03 12:04:37', NULL),
(93, 183, 2, '2020-11-03 12:24:57', '2020-11-03 12:24:57', NULL),
(94, 184, 2, '2020-11-03 12:29:56', '2020-11-03 12:29:56', NULL),
(95, 185, 2, '2020-11-03 12:48:04', '2020-11-03 12:48:04', NULL),
(96, 186, 4, '2020-11-03 13:19:44', '2020-11-03 13:19:44', NULL),
(97, 187, 1, '2020-11-23 09:08:52', '2020-11-23 09:08:52', NULL),
(98, 188, 2, '2020-11-27 09:37:45', '2020-11-27 09:37:45', NULL),
(99, 189, 3, '2020-11-27 10:42:39', '2020-11-27 10:42:39', NULL),
(100, 190, 3, '2020-11-27 11:17:15', '2020-11-27 11:17:15', NULL),
(101, 191, 3, '2020-11-27 11:24:29', '2020-11-27 11:24:29', NULL),
(102, 192, 2, '2020-11-30 11:01:53', '2020-11-30 11:01:53', NULL),
(103, 193, 2, '2020-12-09 15:51:38', '2020-12-09 15:51:38', NULL),
(104, 194, 2, '2020-12-23 09:48:35', '2020-12-23 09:48:35', NULL),
(105, 195, 4, '2020-12-23 09:49:41', '2020-12-23 09:49:41', NULL),
(106, 196, 3, '2020-12-23 09:50:32', '2020-12-23 09:50:32', NULL),
(107, 197, 2, '2020-12-23 10:00:32', '2020-12-23 10:00:32', NULL),
(108, 198, 2, '2020-12-23 10:10:16', '2020-12-23 10:10:16', NULL),
(109, 199, 4, '2020-12-23 10:38:25', '2020-12-23 10:38:25', NULL),
(110, 200, 3, '2020-12-23 10:39:50', '2020-12-23 10:39:50', NULL),
(111, 201, 3, '2020-12-23 10:40:29', '2020-12-23 10:40:29', NULL),
(112, 202, 3, '2020-12-23 10:42:03', '2020-12-23 10:42:03', NULL),
(113, 203, 3, '2020-12-23 10:43:27', '2020-12-23 10:43:27', NULL),
(114, 204, 3, '2020-12-23 10:44:44', '2020-12-23 10:44:44', NULL),
(115, 205, 3, '2020-12-23 10:44:46', '2020-12-23 10:44:46', NULL),
(116, 206, 4, '2020-12-23 10:46:41', '2020-12-23 10:46:41', NULL),
(117, 207, 4, '2020-12-23 10:47:08', '2020-12-23 10:47:08', NULL),
(118, 208, 4, '2020-12-23 10:47:35', '2020-12-23 10:47:35', NULL),
(119, 209, 2, '2020-12-23 11:02:15', '2020-12-23 11:02:15', NULL),
(120, 210, 4, '2020-12-23 12:28:55', '2020-12-23 12:28:55', NULL),
(121, 211, 2, '2020-12-23 12:35:48', '2020-12-23 12:35:48', NULL),
(122, 212, 2, '2020-12-23 12:59:09', '2020-12-23 12:59:09', NULL),
(123, 213, 2, '2020-12-24 13:07:54', '2020-12-24 13:07:54', NULL),
(124, 214, 2, '2020-12-25 07:31:34', '2020-12-25 07:31:34', NULL),
(125, 215, 2, '2020-12-25 13:34:05', '2020-12-25 13:34:05', NULL),
(126, 216, 2, '2021-01-27 14:24:25', '2021-01-27 14:24:25', NULL),
(127, 217, 2, '2021-02-22 11:06:37', '2021-02-22 11:06:37', NULL),
(128, 218, 2, '2021-02-23 11:07:15', '2021-02-23 11:07:15', NULL),
(129, 219, 2, '2021-02-24 07:23:22', '2021-02-24 07:23:22', NULL),
(130, 220, 2, '2021-03-02 05:45:26', '2021-03-02 05:45:26', NULL),
(131, 221, 4, '2021-03-02 05:55:56', '2021-03-02 05:55:56', NULL),
(132, 222, 3, '2021-03-02 05:58:48', '2021-03-02 05:58:48', NULL),
(133, 223, 4, '2021-03-02 10:15:06', '2021-03-02 10:15:06', NULL),
(134, 224, 2, '2021-03-05 06:22:14', '2021-03-05 06:22:14', NULL),
(135, 225, 2, '2021-03-08 05:19:22', '2021-03-08 05:19:22', NULL),
(136, 226, 2, '2021-03-09 06:18:39', '2021-03-09 06:18:39', NULL),
(137, 227, 2, '2021-03-09 09:43:33', '2021-03-09 09:43:33', NULL),
(138, 228, 2, '2021-03-22 07:23:12', '2021-03-22 07:23:12', NULL),
(139, 229, 2, '2021-03-31 05:24:45', '2021-03-31 05:24:45', NULL),
(140, 230, 2, '2021-03-31 05:54:55', '2021-03-31 05:54:55', NULL),
(141, 231, 2, '2021-04-21 11:00:37', '2021-04-21 11:00:37', NULL),
(142, 232, 2, '2021-04-23 11:49:47', '2021-04-23 11:49:47', NULL),
(143, 233, 2, '2021-04-23 11:59:47', '2021-04-23 11:59:47', NULL),
(144, 234, 2, '2021-04-24 08:14:57', '2021-04-24 08:14:57', NULL),
(145, 235, 2, '2021-04-24 09:33:00', '2021-04-24 09:33:00', NULL),
(146, 236, 2, '2021-04-24 09:34:15', '2021-04-24 09:34:15', NULL),
(147, 237, 2, '2021-04-26 14:42:33', '2021-04-26 14:42:33', NULL),
(148, 238, 2, '2021-04-27 07:38:51', '2021-04-27 07:38:51', NULL),
(149, 239, 2, '2021-04-29 11:03:38', '2021-04-29 11:03:38', NULL),
(150, 240, 2, '2021-04-29 11:12:39', '2021-04-29 11:12:39', NULL),
(151, 241, 2, '2021-04-29 15:21:19', '2021-04-29 15:21:19', NULL),
(152, 242, 2, '2021-04-29 17:36:00', '2021-04-29 17:36:00', NULL),
(153, 243, 2, '2021-04-29 18:05:34', '2021-04-29 18:05:34', NULL),
(154, 244, 2, '2021-04-29 19:40:01', '2021-04-29 19:40:01', NULL),
(155, 245, 2, '2021-05-03 05:13:07', '2021-05-03 05:13:07', NULL),
(156, 246, 2, '2021-05-03 05:17:30', '2021-05-03 05:17:30', NULL),
(157, 247, 2, '2021-05-03 14:52:19', '2021-05-03 14:52:19', NULL),
(158, 248, 2, '2021-05-04 09:01:00', '2021-05-04 09:01:00', NULL),
(159, 249, 2, '2021-05-04 10:09:26', '2021-05-04 10:09:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_network`
--

CREATE TABLE `social_network` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `media_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_network`
--

INSERT INTO `social_network` (`id`, `user_id`, `media_type`, `media_value`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'number', '91-222222222', 1, '2020-08-26 13:00:00', '2020-09-07 01:45:04', NULL),
(3, 1, 'twitter', '@johndoe\r\n', 1, '2020-08-30 13:00:00', NULL, NULL),
(48, 154, 'website', 'www.constant.com', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(50, 154, 'socialMail', 'constant1@gmail.com', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(52, 154, 'instagram', 'constant@instagram', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(55, 154, 'facebook', 'panda@facebook', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(56, 154, 'twitter', 'constant@twitter', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(57, 154, 'twitter', 'panda@twitter', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(58, 154, 'youtube', 'constant@youtube', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(59, 154, 'youtube', 'panda@yotube', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(60, 154, 'linkdin', 'consatnt@linkdin', 1, '2020-10-29 11:11:09', '2020-10-29 11:11:09', NULL),
(61, 154, 'homeNumber', '91-1234567860', 1, '2020-10-29 11:11:09', '2021-03-05 12:06:30', NULL),
(62, 154, 'workNumber', '91-978645312', 1, '2020-10-29 11:11:09', '2021-03-05 12:06:30', NULL),
(63, 154, 'otherNumber', '91-2580258080', 1, '2020-10-29 11:11:09', '2021-03-08 06:21:36', NULL),
(64, 153, 'website', 'www.ashvini.con', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(65, 153, 'website', 'www.google.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(66, 153, 'website', '', 0, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(67, 153, 'socialMail', 'abc@gmail.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(68, 153, 'socialMail', 'xyz@yahoo.con', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(69, 153, 'instagram', 'ashvini@99', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(70, 153, 'instagram', 'adgivini@20000', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(71, 153, 'facebook', 'ashivin@bb', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(72, 153, 'twitter', 'ashvini@44', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(73, 153, 'twitter', 'ashvini@twitter', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(74, 153, 'youtube', 'youtube99.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(75, 153, 'youtube', 'youtube77.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(76, 153, 'linkdin', 'ashvini@linkedin', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(77, 153, 'homeNumber', '91-55555555555', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(78, 153, 'workNumber', '91-6666666666', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(79, 153, 'otherNumber', '91-4242424242', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(80, 155, 'website', 'hshshshs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(81, 155, 'socialMail', 'shhshshssh', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(82, 155, 'instagram', 'bsbsbshshz', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(83, 155, 'facebook', 'bshshshhs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(84, 155, 'twitter', 'bsbshshssh', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(85, 155, 'youtube', 'bzhzhzhzhz', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(86, 155, 'music', 'bzhshshshhs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(87, 155, 'payment', 'nzmskdjdjdj', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(88, 155, 'externalLink', 'ndndbsvzvsbs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(89, 156, 'website', 'www.dhoni.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(90, 156, 'website', 'www.google.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(91, 156, 'socialMail', 'bhavesh.vania.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(92, 156, 'socialMail', 'dhoni@yahoo.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(93, 156, 'instagram', 'dhoni@instadoni', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(94, 156, 'instagram', 'dhoni2@insta', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(95, 156, 'facebook', 'dhoni@facebook', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(96, 156, 'facebook', 'dhoni@facook33', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(97, 156, 'twitter', 'dhoni@twitter', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(98, 156, 'youtube', 'myyoutube.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(99, 156, 'youtube', 'myyoutube.in', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(100, 156, 'music', 'mytv.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(101, 156, 'music', 'gana.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(102, 156, 'payment', 'paypal', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(103, 156, 'payment', 'google pay', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(104, 156, 'externalLink', 'www.link.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(105, 156, 'externalLink', 'www.link2.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(116, 154, 'music', 'musiclink1', 1, '2020-11-02 10:23:09', '2020-12-15 05:57:25', NULL),
(117, 154, 'payment', 'paymentlink1', 1, '2020-11-02 10:23:09', '2020-12-15 05:57:25', NULL),
(118, 154, 'externalLink', 'external link1', 1, '2020-11-02 10:23:09', '2020-12-15 05:57:25', NULL),
(129, 153, 'music', '', 1, '2020-11-02 13:07:56', '2020-11-02 13:07:56', NULL),
(130, 153, 'payment', '', 1, '2020-11-02 13:07:56', '2020-11-02 13:07:56', NULL),
(131, 153, 'externalLink', 'https://www.google.com', 1, '2020-11-02 13:07:56', '2020-12-22 07:00:15', NULL),
(142, 185, 'website', 'www.test.com', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(143, 185, 'socialMail', 'martun@gujarat.com', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(144, 185, 'socialMail', 'martin@gmail.con', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(145, 185, 'instagram', 'maetin@ggg', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(146, 185, 'facebook', 'hbdheh@wd', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(148, 185, 'twitter', 'kkk@twitter', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(149, 185, 'youtube', 'youtube22youtube22', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(150, 185, 'youtube', '', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(151, 185, 'linkdin', 'martin@gmail.com', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(152, 185, 'homeNumber', '91-9856432568', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(153, 185, 'workNumber', '91-4875669852', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(154, 185, 'otherNumber', '91-8965845863', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(155, 186, 'website', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(156, 186, 'socialMail', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(157, 186, 'instagram', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(158, 186, 'facebook', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(159, 186, 'twitter', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(160, 186, 'youtube', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(161, 186, 'music', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(162, 186, 'payment', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(163, 186, 'externalLink', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(164, 188, 'website', 'iPhone.com', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(165, 188, 'socialMail', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(166, 188, 'instagram', 'iphone@insta', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(167, 188, 'facebook', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(168, 188, 'twitter', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(169, 188, 'youtube', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(170, 188, 'linkdin', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(171, 188, 'homeNumber', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(172, 188, 'workNumber', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(173, 188, 'otherNumber', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(175, 193, 'website', 'www.gmail.com', 1, '2020-12-09 15:53:01', '2021-04-05 11:05:46', NULL),
(176, 193, 'socialMail', 'bmistri@gmail.com', 1, '2020-12-09 15:53:01', '2021-04-05 11:05:46', NULL),
(177, 193, 'instagram', 'technothumb', 1, '2020-12-09 15:53:01', '2021-04-10 05:30:05', NULL),
(178, 193, 'facebook', 'Bhargavmistri', 1, '2020-12-09 15:53:01', '2021-04-05 16:14:21', NULL),
(179, 193, 'twitter', '', 0, '2020-12-09 15:53:01', '2021-04-02 05:26:05', NULL),
(181, 193, 'linkdin', '', 0, '2020-12-09 15:53:01', '2021-04-02 05:26:05', NULL),
(182, 193, 'homeNumber', '91-1234567890', 1, '2020-12-09 15:53:01', '2021-04-02 06:48:22', NULL),
(183, 193, 'workNumber', '91-9876543210', 1, '2020-12-09 15:53:01', '2021-04-02 06:48:22', NULL),
(184, 193, 'otherNumber', '91-1234567898', 1, '2020-12-09 15:53:01', '2021-04-02 06:48:22', NULL),
(185, 197, 'website', 'testuser.com', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(186, 197, 'socialMail', 'test1@gmail.com', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(187, 197, 'instagram', 'test.insta', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(188, 197, 'instagram', 'test2@insta', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(189, 197, 'facebook', 'test@fb', 1, '2020-12-23 10:02:16', '2020-12-23 10:07:47', NULL),
(190, 197, 'twitter', '', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(191, 197, 'youtube', '', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(192, 197, 'linkdin', '', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(193, 197, 'homeNumber', '91-2356891425', 1, '2020-12-23 10:02:16', '2020-12-23 10:07:47', NULL),
(194, 197, 'workNumber', '91-235656235', 1, '2020-12-23 10:02:16', '2020-12-23 10:07:47', NULL),
(195, 197, 'otherNumber', '', 1, '2020-12-23 10:02:16', '2020-12-23 10:02:16', NULL),
(196, 197, 'facebook', 'test2@fb', 1, '2020-12-23 10:07:47', '2020-12-23 10:07:47', NULL),
(197, 197, 'music', 'music@1', 1, '2020-12-23 10:07:47', '2020-12-23 10:07:47', NULL),
(198, 197, 'payment', 'payment1', 1, '2020-12-23 10:07:47', '2020-12-23 10:07:47', NULL),
(199, 197, 'externalLink', 'otherlink', 1, '2020-12-23 10:07:47', '2020-12-23 10:07:47', NULL),
(200, 198, 'website', 'webtual.com', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(201, 198, 'website', 'webtual123.com', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(202, 198, 'socialMail', 'tester@gmail.com', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(203, 198, 'socialMail', 'testers@gmail.com', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(204, 198, 'instagram', 'testers@gmail.com', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(205, 198, 'facebook', 'testers@gmail.com', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(206, 198, 'twitter', '', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(207, 198, 'youtube', '', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(208, 198, 'linkdin', '', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(209, 198, 'homeNumber', '91-2727272727', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(210, 198, 'workNumber', '91-2828282828', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(211, 198, 'otherNumber', '91-2929292929', 1, '2020-12-23 10:13:34', '2020-12-23 10:13:34', NULL),
(212, 198, 'music', 'soft music', 1, '2020-12-23 10:27:00', '2020-12-23 11:59:49', NULL),
(213, 198, 'payment', 'Netbanking', 1, '2020-12-23 10:27:00', '2020-12-23 11:59:49', NULL),
(214, 198, 'externalLink', 'www.xyz.com', 1, '2020-12-23 10:27:00', '2020-12-23 11:59:49', NULL),
(215, 198, 'music', '', 1, '2020-12-23 11:59:49', '2020-12-23 11:59:49', NULL),
(216, 198, 'payment', 'credit card', 1, '2020-12-23 11:59:49', '2020-12-23 11:59:49', NULL),
(217, 212, 'website', 'sghshs.com', 1, '2020-12-23 13:00:03', '2020-12-23 13:00:03', NULL),
(218, 212, 'socialMail', 'shhshsh@hhshs.com', 1, '2020-12-23 13:00:03', '2020-12-23 13:00:03', NULL),
(219, 212, 'instagram', 'test@insta1', 1, '2020-12-23 13:00:03', '2020-12-24 10:27:57', NULL),
(220, 212, 'facebook', '', 1, '2020-12-23 13:00:03', '2020-12-23 13:00:03', NULL),
(221, 212, 'twitter', 'test@twitter', 1, '2020-12-23 13:00:03', '2020-12-24 10:12:16', NULL),
(222, 212, 'youtube', 'test@youtube.com@1992', 1, '2020-12-23 13:00:03', '2020-12-24 10:09:36', NULL),
(223, 212, 'linkdin', 'test@link', 1, '2020-12-23 13:00:03', '2020-12-24 10:06:25', NULL),
(224, 212, 'homeNumber', '91-1235689235', 1, '2020-12-23 13:00:03', '2020-12-24 07:52:54', NULL),
(225, 212, 'workNumber', '91-2525252525', 1, '2020-12-23 13:00:03', '2020-12-24 10:05:14', NULL),
(226, 212, 'otherNumber', '', 1, '2020-12-23 13:00:03', '2020-12-23 13:00:03', NULL),
(227, 212, 'music', 'music1', 1, '2020-12-24 07:52:54', '2020-12-24 10:13:43', NULL),
(228, 212, 'payment', 'payment1', 1, '2020-12-24 07:52:54', '2020-12-24 10:26:39', NULL),
(229, 212, 'externalLink', '', 1, '2020-12-24 07:52:54', '2020-12-24 07:52:54', NULL),
(230, 193, 'music', 'https://open.spotify.com/playlist/4jlbTgG7gqClTD2MjpUDqI', 1, '2020-12-24 12:38:43', '2021-04-10 06:12:11', NULL),
(232, 193, 'externalLink', '', 0, '2020-12-24 12:38:43', '2021-04-02 05:26:05', NULL),
(233, 213, 'website', 'Www.webtual.com', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(234, 213, 'website', 'Tyrehub.com', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(235, 213, 'socialMail', 'Ashah@webtual.com', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(236, 213, 'socialMail', 'ankit.rshah@yahoo.com', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(237, 213, 'instagram', 'Ankit Shah', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(238, 213, 'facebook', 'Ankit Shah', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(239, 213, 'twitter', '', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(240, 213, 'youtube', 'ankit shah', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(241, 213, 'linkdin', 'Ankit shah', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(242, 213, 'homeNumber', '91-3333333333333', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(243, 213, 'workNumber', '91-222222222222', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(244, 213, 'otherNumber', '', 1, '2020-12-24 13:11:17', '2020-12-24 13:11:17', NULL),
(245, 213, 'music', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(246, 213, 'payment', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(247, 213, 'externalLink', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(248, 214, 'website', 'shhshs.com', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(249, 214, 'website', 'xbjzjs.com', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(250, 214, 'socialMail', 'hahahs@gabba.com', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(251, 214, 'socialMail', 'shhshsh@gsgs.com', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(252, 214, 'instagram', 'hzhshsh', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(253, 214, 'facebook', 'djdhhdhd', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(254, 214, 'twitter', '', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(255, 214, 'youtube', '', 1, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(256, 214, 'linkdin', '', 1, '2020-12-25 07:32:21', '2020-12-25 07:32:21', NULL),
(257, 214, 'homeNumber', '', 1, '2020-12-25 07:32:21', '2020-12-25 07:32:21', NULL),
(258, 214, 'workNumber', '', 1, '2020-12-25 07:32:21', '2020-12-25 07:32:21', NULL),
(259, 214, 'otherNumber', '', 1, '2020-12-25 07:32:21', '2020-12-25 07:32:21', NULL),
(260, 215, 'website', '', 1, '2020-12-25 13:40:14', '2020-12-25 13:40:14', NULL),
(261, 215, 'socialMail', 'tejusreddy93@gmail.com', 1, '2020-12-25 13:40:14', '2021-01-09 16:26:10', NULL),
(262, 215, 'instagram', 'tejusreddyv93', 1, '2020-12-25 13:40:14', '2021-01-09 16:26:10', NULL),
(263, 215, 'facebook', 'Tejus V Reddy', 1, '2020-12-25 13:40:14', '2021-01-09 16:26:10', NULL),
(264, 215, 'twitter', '', 1, '2020-12-25 13:40:14', '2020-12-25 13:40:14', NULL),
(265, 215, 'youtube', 'tejusreddy93', 1, '2020-12-25 13:40:14', '2021-01-09 16:26:10', NULL),
(266, 215, 'linkdin', '', 1, '2020-12-25 13:40:14', '2020-12-25 13:40:14', NULL),
(267, 215, 'homeNumber', '91-', 0, '2020-12-25 13:40:14', '2021-04-10 12:58:41', NULL),
(268, 215, 'workNumber', '91-', 0, '2020-12-25 13:40:14', '2021-04-10 12:58:41', NULL),
(269, 215, 'otherNumber', '91-', 0, '2020-12-25 13:40:14', '2021-04-10 12:58:41', NULL),
(270, 215, 'music', 'https://open.spotify.com/user/22n6miin6exwsekc6ax3iipii?si=ub7f2yYwSdKnb1N_1cnoxQ', 1, '2021-01-09 16:26:10', '2021-04-09 15:10:28', NULL),
(271, 215, 'payment', '', 0, '2021-01-09 16:26:11', '2021-04-10 12:58:41', NULL),
(272, 215, 'externalLink', 'https://www.fostrhealthcare.com', 1, '2021-01-09 16:26:11', '2021-04-09 15:12:20', NULL),
(273, 216, 'website', '', 0, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(274, 216, 'socialMail', '', 0, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(275, 216, 'socialMail', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(276, 216, 'socialMail', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(277, 216, 'instagram', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(278, 216, 'instagram', '', 0, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(279, 216, 'facebook', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(280, 216, 'twitter', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(281, 216, 'youtube', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(282, 216, 'linkdin', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(283, 216, 'homeNumber', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:25:37', NULL),
(284, 216, 'workNumber', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:26:16', NULL),
(285, 216, 'otherNumber', '', 1, '2021-01-27 14:25:37', '2021-01-27 14:26:16', NULL),
(286, 216, 'music', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(287, 216, 'payment', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(288, 216, 'externalLink', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(289, 217, 'website', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(290, 217, 'socialMail', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(291, 217, 'instagram', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(292, 217, 'facebook', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(293, 217, 'twitter', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(294, 217, 'youtube', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(295, 217, 'linkdin', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(296, 217, 'homeNumber', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(297, 217, 'workNumber', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(298, 217, 'otherNumber', '', 1, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(299, 218, 'website', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(300, 218, 'socialMail', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(301, 218, 'instagram', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(302, 218, 'facebook', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(303, 218, 'twitter', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(304, 218, 'youtube', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(305, 218, 'linkdin', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(306, 218, 'homeNumber', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(307, 218, 'workNumber', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(308, 218, 'otherNumber', '', 1, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(309, 224, 'website', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(310, 224, 'socialMail', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(311, 224, 'instagram', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(312, 224, 'facebook', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(313, 224, 'twitter', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(314, 224, 'youtube', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(315, 224, 'linkdin', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(316, 224, 'homeNumber', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(317, 224, 'workNumber', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(318, 224, 'otherNumber', '', 1, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(325, 154, 'website', 'www.webtual.com', 1, '2021-03-08 05:12:41', '2021-03-08 05:12:41', NULL),
(327, 154, 'socialMail', '', 1, '2021-03-08 06:10:45', '2021-03-08 06:10:45', NULL),
(349, 228, 'website', 'dsfdsf', 1, '2021-03-22 07:36:49', '2021-03-22 07:36:49', NULL),
(350, 228, 'website', 'dsfdgt', 0, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(351, 228, 'socialMail', 'ddfsdf@gmail.com', 0, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(352, 228, 'socialMail', 'dnhsakjdh@gmail.com', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(353, 228, 'instagram', 'safdsfds', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(354, 228, 'instagram', 'fssdfdsfdsf', 0, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(355, 228, 'facebook', 'fdsfdsfdfsfdsf', 0, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(356, 228, 'facebook', 'dfsfdsfdf', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(357, 228, 'twitter', 'retretjyj', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(358, 228, 'twitter', 'hhhhhhhh', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(359, 228, 'youtube', 'tyytyyty', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(360, 228, 'youtube', 'ttyytytytyy', 0, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(361, 228, 'linkdin', 'erretertertr', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(362, 228, 'homeNumber', '1234567890', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(363, 228, 'workNumber', '1111122222', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(364, 228, 'otherNumber', '1231231231', 1, '2021-03-22 07:36:50', '2021-03-22 07:36:50', NULL),
(365, 228, 'website', 'dsfdsf', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(366, 228, 'website', 'dsfdgt', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(367, 228, 'socialMail', 'ddfsdf@gmail.com', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(368, 228, 'socialMail', 'dnhsakjdh@gmail.com', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(369, 228, 'instagram', 'safdsfds', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(370, 228, 'instagram', 'fssdfdsfdsf', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(371, 228, 'facebook', 'fdsfdsfdfsfdsf', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(372, 228, 'facebook', 'dfsfdsfdf', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(373, 228, 'twitter', 'retretjyj', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(374, 228, 'twitter', 'hhhhhhhh', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(375, 228, 'youtube', 'tyytyyty', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(376, 228, 'youtube', 'ttyytytytyy', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(377, 228, 'linkdin', 'erretertertr', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(378, 228, 'homeNumber', '1234567890', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(379, 228, 'workNumber', '1111122222', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(380, 228, 'otherNumber', '1231231231', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(381, 229, 'website', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(382, 229, 'socialMail', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(383, 229, 'instagram', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(384, 229, 'facebook', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(385, 229, 'twitter', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(386, 229, 'youtube', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(387, 229, 'linkdin', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(388, 229, 'homeNumber', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(389, 229, 'workNumber', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(390, 229, 'otherNumber', '', 1, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(391, 230, 'website', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(392, 230, 'socialMail', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(393, 230, 'instagram', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(394, 230, 'facebook', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(395, 230, 'twitter', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(396, 230, 'youtube', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(397, 230, 'linkdin', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(398, 230, 'homeNumber', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(399, 230, 'workNumber', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(400, 230, 'otherNumber', '', 1, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(404, 193, 'payment', '', 0, '2021-04-01 13:31:12', '2021-04-02 05:26:40', NULL),
(405, 193, 'youtube', 'Temp', 1, '2021-04-02 05:24:04', '2021-04-02 06:53:49', NULL),
(410, 215, 'music', '', 0, '2021-04-09 15:12:20', '2021-04-10 12:58:41', NULL),
(411, 215, 'music', '', 0, '2021-04-09 15:12:20', '2021-04-10 12:58:41', NULL),
(412, 215, 'payment', '', 0, '2021-04-09 15:12:20', '2021-04-10 12:58:41', NULL),
(413, 231, 'website', 'www.fostrhealthcare.com', 1, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(414, 231, 'socialMail', 'ven_66@yahoo.com', 1, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(415, 231, 'instagram', 'fostrhealthcare', 1, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(416, 231, 'facebook', '', 1, '2021-04-21 11:02:24', '2021-04-21 11:02:24', NULL),
(417, 231, 'twitter', '', 0, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(418, 231, 'youtube', '', 0, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(419, 231, 'linkdin', '', 1, '2021-04-21 11:02:24', '2021-04-21 11:02:24', NULL),
(420, 231, 'homeNumber', '91-', 0, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(421, 231, 'workNumber', '91-', 0, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(422, 231, 'otherNumber', '91-', 0, '2021-04-21 11:02:24', '2021-04-28 09:59:17', NULL),
(423, 234, 'website', '', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(424, 234, 'socialMail', '', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(425, 234, 'instagram', 'frozen_mo_ment', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(426, 234, 'facebook', '', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(427, 234, 'twitter', '', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(428, 234, 'youtube', '', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(429, 234, 'linkdin', '', 1, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(430, 234, 'homeNumber', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(431, 234, 'workNumber', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(432, 234, 'otherNumber', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(433, 236, 'website', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(434, 236, 'socialMail', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(435, 236, 'instagram', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(436, 236, 'facebook', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(437, 236, 'twitter', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(438, 236, 'youtube', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(439, 236, 'linkdin', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(440, 236, 'homeNumber', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(441, 236, 'workNumber', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(442, 236, 'otherNumber', '', 1, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(443, 237, 'website', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(444, 237, 'socialMail', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(445, 237, 'instagram', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(446, 237, 'facebook', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(447, 237, 'twitter', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(448, 237, 'youtube', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(449, 237, 'linkdin', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(450, 237, 'homeNumber', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(451, 237, 'workNumber', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(452, 237, 'otherNumber', '', 1, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(453, 238, 'website', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(454, 238, 'socialMail', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(455, 238, 'instagram', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(456, 238, 'facebook', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(457, 238, 'twitter', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(458, 238, 'youtube', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(459, 238, 'linkdin', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(460, 238, 'homeNumber', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(461, 238, 'workNumber', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(462, 238, 'otherNumber', '', 1, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(463, 231, 'music', '', 0, '2021-04-28 09:56:31', '2021-04-28 09:59:17', NULL),
(464, 231, 'payment', '8971235679@upi', 1, '2021-04-28 09:56:31', '2021-04-28 09:59:17', NULL),
(465, 231, 'externalLink', '', 0, '2021-04-28 09:56:31', '2021-04-28 09:59:17', NULL),
(466, 239, 'website', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(467, 239, 'socialMail', 'raj1993santosh@gmail.com', 1, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(468, 239, 'instagram', '_santosh_raj__', 1, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(469, 239, 'facebook', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(470, 239, 'twitter', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(471, 239, 'youtube', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(472, 239, 'linkdin', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(473, 239, 'homeNumber', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(474, 239, 'workNumber', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(475, 239, 'otherNumber', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(476, 240, 'website', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(477, 240, 'socialMail', 'kotresh023@gmail.com', 1, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(478, 240, 'instagram', 'kotreshkt', 1, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(479, 240, 'facebook', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(480, 240, 'twitter', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(481, 240, 'youtube', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(482, 240, 'linkdin', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(483, 240, 'homeNumber', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(484, 240, 'workNumber', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(485, 240, 'otherNumber', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(486, 246, 'website', 'www.webtual.com', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(487, 246, 'socialMail', 'umang@umang.com', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(488, 246, 'instagram', '', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(489, 246, 'facebook', '', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(490, 246, 'twitter', '', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(491, 246, 'youtube', '', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(492, 246, 'linkdin', '', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(493, 246, 'homeNumber', '91-5434884', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(494, 246, 'workNumber', '91-8767949', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(495, 246, 'otherNumber', '91-64646493', 1, '2021-05-03 05:42:57', '2021-05-03 05:42:57', NULL),
(496, 246, 'music', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(497, 246, 'payment', 'umangdesai1111@ybl', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(498, 246, 'externalLink', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(499, 247, 'website', 'www.fostrhealthcare.com', 1, '2021-05-03 14:55:03', '2021-05-03 14:55:03', NULL),
(500, 247, 'socialMail', 'bhavana@cliquesocial.co', 1, '2021-05-03 14:55:03', '2021-05-03 14:55:03', NULL),
(501, 247, 'instagram', 'bhavana___21', 1, '2021-05-03 14:55:03', '2021-05-03 14:57:06', NULL),
(502, 247, 'facebook', 'https://www.facebook.com/bhavana.reddy.4', 1, '2021-05-03 14:55:03', '2021-05-03 14:55:03', NULL),
(503, 247, 'twitter', '', 0, '2021-05-03 14:55:03', '2021-05-03 14:55:03', NULL),
(504, 247, 'youtube', '', 0, '2021-05-03 14:55:03', '2021-05-03 14:55:03', NULL),
(505, 247, 'linkdin', '', 0, '2021-05-03 14:55:03', '2021-05-03 14:55:03', NULL),
(506, 247, 'homeNumber', '91-8971235694', 1, '2021-05-03 14:55:03', '2021-05-03 14:56:41', NULL),
(507, 247, 'workNumber', '91-', 1, '2021-05-03 14:55:03', '2021-05-03 14:56:41', NULL),
(508, 247, 'otherNumber', '91-', 1, '2021-05-03 14:55:03', '2021-05-03 14:56:41', NULL),
(509, 247, 'music', '', 1, '2021-05-03 14:56:41', '2021-05-03 14:56:41', NULL),
(510, 247, 'payment', '', 1, '2021-05-03 14:56:41', '2021-05-03 14:56:41', NULL),
(511, 247, 'externalLink', '', 1, '2021-05-03 14:56:41', '2021-05-03 14:56:41', NULL),
(512, 248, 'website', 'www.webtual.com', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(513, 248, 'socialMail', 'umangdesai111@gmail.com', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(514, 248, 'instagram', '', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(515, 248, 'facebook', '', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(516, 248, 'twitter', '', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(517, 248, 'youtube', '', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(518, 248, 'linkdin', '', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(519, 248, 'homeNumber', '91-1234567890', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(520, 248, 'workNumber', '91-9876543210', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(521, 248, 'otherNumber', '91-2580258025', 1, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_social_network`
--

CREATE TABLE `temp_social_network` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `media_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_social_network`
--

INSERT INTO `temp_social_network` (`id`, `user_id`, `media_type`, `media_value`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'number', '91-222222222', 1, '2020-08-26 13:00:00', '2020-09-07 01:45:04', NULL),
(2, 1, 'facebook', 'johndoe', 1, '2020-08-30 13:00:00', NULL, NULL),
(3, 1, 'twitter', '@johndoe\r\n', 1, '2020-08-30 13:00:00', NULL, NULL),
(64, 153, 'website', 'www.ashvini.con', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(65, 153, 'website', 'www.google.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(66, 153, 'website', '', 0, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(67, 153, 'socialMail', 'abc@gmail.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(68, 153, 'socialMail', 'xyz@yahoo.con', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(69, 153, 'instagram', 'ashvini@99', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(70, 153, 'instagram', 'adgivini@20000', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(71, 153, 'facebook', 'ashivin@bb', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(72, 153, 'twitter', 'ashvini@44', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(73, 153, 'twitter', 'ashvini@twitter', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(74, 153, 'youtube', 'youtube99.com', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(75, 153, 'youtube', 'youtube77.com', 0, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(76, 153, 'linkdin', 'ashvini@linkedin', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(77, 153, 'homeNumber', '91-55555555555', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(78, 153, 'workNumber', '91-6666666666', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(79, 153, 'otherNumber', '91-4242424242', 1, '2020-10-29 11:11:12', '2020-10-29 11:11:12', NULL),
(80, 155, 'website', 'hshshshs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(81, 155, 'socialMail', 'shhshshssh', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(82, 155, 'instagram', 'bsbsbshshz', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(83, 155, 'facebook', 'bshshshhs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(84, 155, 'twitter', 'bsbshshssh', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(85, 155, 'youtube', 'bzhzhzhzhz', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(86, 155, 'music', 'bzhshshshhs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(87, 155, 'payment', 'nzmskdjdjdj', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(88, 155, 'externalLink', 'ndndbsvzvsbs', 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(89, 156, 'website', 'www.dhoni.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(90, 156, 'website', 'www.google.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(91, 156, 'socialMail', 'bhavesh.vania.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(92, 156, 'socialMail', 'dhoni@yahoo.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(93, 156, 'instagram', 'dhoni@instadoni', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(94, 156, 'instagram', 'dhoni2@insta', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(95, 156, 'facebook', 'dhoni@facebook', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(96, 156, 'facebook', 'dhoni@facook33', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(97, 156, 'twitter', 'dhoni@twitter', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(98, 156, 'youtube', 'myyoutube.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(99, 156, 'youtube', 'myyoutube.in', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(100, 156, 'music', 'mytv.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(101, 156, 'music', 'gana.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(102, 156, 'payment', 'paypal', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(103, 156, 'payment', 'google pay', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(104, 156, 'externalLink', 'www.link.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(105, 156, 'externalLink', 'www.link2.com', 1, '2020-10-29 13:37:13', '2020-10-29 13:37:13', NULL),
(129, 153, 'music', '', 1, '2020-11-02 13:07:56', '2020-11-02 13:07:56', NULL),
(130, 153, 'payment', '', 1, '2020-11-02 13:07:56', '2020-11-02 13:07:56', NULL),
(131, 153, 'externalLink', 'https://www.google.com', 1, '2020-11-02 13:07:56', '2020-12-22 07:00:15', NULL),
(142, 185, 'website', 'www.test.com', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(143, 185, 'socialMail', 'martun@gujarat.com', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(144, 185, 'socialMail', 'martin@gmail.con', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(145, 185, 'instagram', 'maetin@ggg', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(146, 185, 'facebook', 'hbdheh@wd', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(148, 185, 'twitter', 'kkk@twitter', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(149, 185, 'youtube', 'youtube22youtube22', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(150, 185, 'youtube', '', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(151, 185, 'linkdin', 'martin@gmail.com', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(152, 185, 'homeNumber', '91-9856432568', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(153, 185, 'workNumber', '91-4875669852', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(154, 185, 'otherNumber', '91-8965845863', 1, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(155, 186, 'website', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(156, 186, 'socialMail', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(157, 186, 'instagram', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(158, 186, 'facebook', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(159, 186, 'twitter', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(160, 186, 'youtube', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(161, 186, 'music', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(162, 186, 'payment', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(163, 186, 'externalLink', '', 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(164, 188, 'website', 'iPhone.com', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(165, 188, 'socialMail', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(166, 188, 'instagram', 'iphone@insta', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(167, 188, 'facebook', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(168, 188, 'twitter', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(169, 188, 'youtube', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(170, 188, 'linkdin', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(171, 188, 'homeNumber', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(172, 188, 'workNumber', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(173, 188, 'otherNumber', '', 1, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(221, 212, 'website', 'sghshs.com', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(222, 212, 'socialMail', 'shhshsh@hhshs.com', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(223, 212, 'instagram', 'test@insta1', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(224, 212, 'facebook', '', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(225, 212, 'twitter', 'test@twitter', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(226, 212, 'youtube', 'test@youtube.com@1992', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(227, 212, 'linkdin', 'test@link', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(228, 212, 'homeNumber', '91-1235689235', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(229, 212, 'workNumber', '91-2525252525', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(230, 212, 'otherNumber', '', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(231, 212, 'music', 'music1', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(232, 212, 'payment', 'payment1', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(233, 212, 'externalLink', '', 1, '2020-12-24 10:27:57', '2020-12-24 10:27:57', NULL),
(274, 213, 'website', 'Www.webtual.com', 0, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(275, 213, 'website', 'Tyrehub.com', 0, '2020-12-24 13:12:24', '2020-12-24 13:19:59', NULL),
(276, 213, 'socialMail', 'Ashah@webtual.com', 0, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(277, 213, 'socialMail', 'ankit.rshah@yahoo.com', 0, '2020-12-24 13:12:24', '2020-12-24 13:19:59', NULL),
(278, 213, 'instagram', 'Ankit Shah', 0, '2020-12-24 13:12:24', '2020-12-24 13:19:59', NULL),
(279, 213, 'facebook', 'Ankit Shah', 1, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(280, 213, 'twitter', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(281, 213, 'youtube', 'ankit shah', 0, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(282, 213, 'linkdin', 'Ankit shah', 0, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(283, 213, 'homeNumber', '91-3333333333333', 0, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(284, 213, 'workNumber', '91-222222222222', 0, '2020-12-24 13:12:24', '2020-12-25 13:35:50', NULL),
(285, 213, 'otherNumber', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(286, 213, 'music', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(287, 213, 'payment', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(288, 213, 'externalLink', '', 1, '2020-12-24 13:12:24', '2020-12-24 13:12:24', NULL),
(289, 214, 'website', 'shhshs.com', 1, '2020-12-25 07:32:20', '2020-12-25 07:34:43', NULL),
(290, 214, 'website', 'xbjzjs.com', 0, '2020-12-25 07:32:20', '2020-12-25 07:35:59', NULL),
(291, 214, 'socialMail', 'hahahs@gabba.com', 1, '2020-12-25 07:32:20', '2020-12-25 07:34:43', NULL),
(292, 214, 'socialMail', 'shhshsh@gsgs.com', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(293, 214, 'instagram', 'hzhshsh', 1, '2020-12-25 07:32:20', '2020-12-25 07:34:43', NULL),
(294, 214, 'facebook', 'djdhhdhd', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(295, 214, 'twitter', '', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(296, 214, 'youtube', '', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(297, 214, 'linkdin', '', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(298, 214, 'homeNumber', '', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(299, 214, 'workNumber', '', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(300, 214, 'otherNumber', '', 0, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(337, 216, 'website', '', 0, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(338, 216, 'socialMail', '', 0, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(339, 216, 'socialMail', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(340, 216, 'socialMail', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(341, 216, 'instagram', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(342, 216, 'instagram', '', 0, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(343, 216, 'facebook', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(344, 216, 'twitter', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(345, 216, 'youtube', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(346, 216, 'linkdin', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(347, 216, 'homeNumber', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(348, 216, 'workNumber', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(349, 216, 'otherNumber', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(350, 216, 'music', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(351, 216, 'payment', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(352, 216, 'externalLink', '', 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(353, 217, 'website', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(354, 217, 'socialMail', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(355, 217, 'instagram', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(356, 217, 'facebook', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(357, 217, 'twitter', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(358, 217, 'youtube', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(359, 217, 'linkdin', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(360, 217, 'homeNumber', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(361, 217, 'workNumber', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(362, 217, 'otherNumber', '', 0, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(363, 218, 'website', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(364, 218, 'socialMail', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(365, 218, 'instagram', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(366, 218, 'facebook', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(367, 218, 'twitter', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(368, 218, 'youtube', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(369, 218, 'linkdin', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(370, 218, 'homeNumber', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(371, 218, 'workNumber', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(372, 218, 'otherNumber', '', 0, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(403, 224, 'website', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(404, 224, 'socialMail', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(405, 224, 'instagram', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(406, 224, 'facebook', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(407, 224, 'twitter', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(408, 224, 'youtube', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(409, 224, 'linkdin', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(410, 224, 'homeNumber', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(411, 224, 'workNumber', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(412, 224, 'otherNumber', '', 0, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(555, 154, 'website', 'www.constant.com', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(556, 154, 'website', 'www.webtual.com', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(557, 154, 'socialMail', 'constant1@gmail.com', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(558, 154, 'socialMail', '', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(559, 154, 'instagram', 'constant@instagram', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(560, 154, 'facebook', 'panda@facebook', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(561, 154, 'twitter', 'constant@twitter', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(562, 154, 'twitter', 'panda@twitter', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(563, 154, 'youtube', 'constant@youtube', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(564, 154, 'youtube', 'panda@yotube', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(565, 154, 'linkdin', 'consatnt@linkdin', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(566, 154, 'homeNumber', '91-1234567860', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(567, 154, 'workNumber', '91-978645312', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(568, 154, 'otherNumber', '91-2580258080', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(569, 154, 'music', 'musiclink1', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(570, 154, 'payment', 'paymentlink1', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(571, 154, 'externalLink', 'external link1', 1, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(572, 226, 'website', 'website', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(573, 226, 'socialMail', 'email', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(574, 226, 'instagram', 'instagram', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(575, 226, 'facebook', 'facevook', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(576, 226, 'twitter', 'twitter', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(577, 226, 'youtube', 'youtube', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(578, 226, 'linkdin', 'linkdin', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(579, 226, 'homeNumber', '91-248404', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(580, 226, 'workNumber', '91-979898.8', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(581, 226, 'otherNumber', '91-676484684', 0, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(688, 145, 'website', 'dsfdsf', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(689, 145, 'website', 'dsfdgt', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(690, 145, 'socialMail', 'ddfsdf@gmail.com', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(691, 145, 'socialMail', 'dnhsakjdh@gmail.com', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(692, 145, 'instagram', 'safdsfds', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(693, 145, 'instagram', 'fssdfdsfdsf', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(694, 145, 'facebook', 'fdsfdsfdfsfdsf', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(695, 145, 'facebook', 'dfsfdsfdf', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(696, 145, 'twitter', 'retretjyj', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(697, 145, 'twitter', 'hhhhhhhh', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(698, 145, 'youtube', 'tyytyyty', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(699, 145, 'youtube', 'ttyytytytyy', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(700, 145, 'linkdin', 'erretertertr', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(701, 145, 'homeNumber', '1234567890', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(702, 145, 'workNumber', '1111122222', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(703, 145, 'otherNumber', '1231231231', 0, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(752, 134, 'website', 'dsfdsf', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(753, 134, 'website', 'dsfdgt', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(754, 134, 'socialMail', 'ddfsdf@gmail.com', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(755, 134, 'socialMail', 'dnhsakjdh@gmail.com', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(756, 134, 'instagram', 'safdsfds', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(757, 134, 'instagram', 'fssdfdsfdsf', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(758, 134, 'facebook', 'fdsfdsfdfsfdsf', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(759, 134, 'facebook', 'dfsfdsfdf', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(760, 134, 'twitter', 'retretjyj', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(761, 134, 'twitter', 'hhhhhhhh', 0, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(762, 134, 'youtube', 'tyytyyty', 0, '2021-03-22 07:35:37', '2021-03-22 07:35:37', NULL),
(763, 134, 'youtube', 'ttyytytytyy', 0, '2021-03-22 07:35:37', '2021-03-22 07:35:37', NULL),
(764, 134, 'linkdin', 'erretertertr', 0, '2021-03-22 07:35:37', '2021-03-22 07:35:37', NULL),
(765, 134, 'homeNumber', '1234567890', 0, '2021-03-22 07:35:37', '2021-03-22 07:35:37', NULL),
(766, 134, 'workNumber', '1111122222', 0, '2021-03-22 07:35:37', '2021-03-22 07:35:37', NULL),
(767, 134, 'otherNumber', '1231231231', 0, '2021-03-22 07:35:37', '2021-03-22 07:35:37', NULL),
(768, 179, 'website', 'dsfdsf', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(769, 179, 'website', 'dsfdgt', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(770, 179, 'socialMail', 'ddfsdf@gmail.com', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(771, 179, 'socialMail', 'dnhsakjdh@gmail.com', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(772, 179, 'instagram', 'safdsfds', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(773, 179, 'instagram', 'fssdfdsfdsf', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(774, 179, 'facebook', 'fdsfdsfdfsfdsf', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(775, 179, 'facebook', 'dfsfdsfdf', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(776, 179, 'twitter', 'retretjyj', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(777, 179, 'twitter', 'hhhhhhhh', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(778, 179, 'youtube', 'tyytyyty', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(779, 179, 'youtube', 'ttyytytytyy', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(780, 179, 'linkdin', 'erretertertr', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(781, 179, 'homeNumber', '1234567890', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(782, 179, 'workNumber', '1111122222', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(783, 179, 'otherNumber', '1231231231', 0, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(800, 228, 'website', 'dsfdsf', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(801, 228, 'website', 'dsfdgt', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(802, 228, 'socialMail', 'ddfsdf@gmail.com', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(803, 228, 'socialMail', 'dnhsakjdh@gmail.com', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(804, 228, 'instagram', 'safdsfds', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(805, 228, 'instagram', 'fssdfdsfdsf', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(806, 228, 'facebook', 'fdsfdsfdfsfdsf', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(807, 228, 'facebook', 'dfsfdsfdf', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(808, 228, 'twitter', 'retretjyj', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(809, 228, 'twitter', 'hhhhhhhh', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(810, 228, 'youtube', 'tyytyyty', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(811, 228, 'youtube', 'ttyytytytyy', 0, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(812, 228, 'linkdin', 'erretertertr', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(813, 228, 'homeNumber', '1234567890', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(814, 228, 'workNumber', '1111122222', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(815, 228, 'otherNumber', '1231231231', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(816, 229, 'website', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(817, 229, 'socialMail', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(818, 229, 'instagram', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(819, 229, 'facebook', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(820, 229, 'twitter', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(821, 229, 'youtube', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(822, 229, 'linkdin', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(823, 229, 'homeNumber', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(824, 229, 'workNumber', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(825, 229, 'otherNumber', '', 0, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(826, 230, 'website', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(827, 230, 'socialMail', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(828, 230, 'instagram', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(829, 230, 'facebook', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(830, 230, 'twitter', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(831, 230, 'youtube', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(832, 230, 'linkdin', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(833, 230, 'homeNumber', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(834, 230, 'workNumber', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(835, 230, 'otherNumber', '', 0, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(1333, 193, 'website', 'www.gmail.com', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1334, 193, 'socialMail', 'bmistri@gmail.com', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1335, 193, 'instagram', 'technothumb', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1336, 193, 'facebook', 'Bhargavmistri', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1337, 193, 'twitter', '', 0, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1338, 193, 'youtube', 'Temp', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1339, 193, 'linkdin', '', 0, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1340, 193, 'homeNumber', '91-1234567890', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1341, 193, 'workNumber', '91-9876543210', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1342, 193, 'otherNumber', '91-1234567898', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1343, 193, 'music', 'https://open.spotify.com/playlist/4jlbTgG7gqClTD2MjpUDqI', 1, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1344, 193, 'payment', '', 0, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1345, 193, 'externalLink', '', 0, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(1346, 219, 'website', 'https://www.webtual.com', 0, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1347, 219, 'website', 'https://www.webtual.com', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1348, 219, 'socialMail', 'webtual@webtual.com', 0, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1349, 219, 'instagram', 'umang_d85', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1350, 219, 'facebook', 'umang.desai.96558', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1351, 219, 'twitter', 'technothumb', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1352, 219, 'youtube', 'TechnicalGuruji', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1353, 219, 'linkdin', 'Linkdin@webtual', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1354, 219, 'homeNumber', '91-8511671085', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1355, 219, 'workNumber', '91-1234567890', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1356, 219, 'otherNumber', '91-9876543210', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1357, 219, 'music', 'https://www.spotify.com/', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1358, 219, 'payment', '', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1359, 219, 'externalLink', 'https://www.youtube.com/', 1, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(1402, 234, 'website', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1403, 234, 'socialMail', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1404, 234, 'instagram', 'frozen_mo_ment', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1405, 234, 'facebook', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1406, 234, 'twitter', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1407, 234, 'youtube', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1408, 234, 'linkdin', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1409, 234, 'homeNumber', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1410, 234, 'workNumber', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1411, 234, 'otherNumber', '', 0, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(1412, 236, 'website', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1413, 236, 'socialMail', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1414, 236, 'instagram', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1415, 236, 'facebook', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1416, 236, 'twitter', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1417, 236, 'youtube', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1418, 236, 'linkdin', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1419, 236, 'homeNumber', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1420, 236, 'workNumber', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1421, 236, 'otherNumber', '', 0, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(1422, 237, 'website', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1423, 237, 'socialMail', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1424, 237, 'instagram', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1425, 237, 'facebook', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1426, 237, 'twitter', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1427, 237, 'youtube', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1428, 237, 'linkdin', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1429, 237, 'homeNumber', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1430, 237, 'workNumber', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1431, 237, 'otherNumber', '', 0, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(1432, 238, 'website', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1433, 238, 'socialMail', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1434, 238, 'instagram', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1435, 238, 'facebook', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1436, 238, 'twitter', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1437, 238, 'youtube', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1438, 238, 'linkdin', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1439, 238, 'homeNumber', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1440, 238, 'workNumber', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1441, 238, 'otherNumber', '', 0, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(1494, 231, 'website', 'www.fostrhealthcare.com', 1, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1495, 231, 'socialMail', 'ven_66@yahoo.com', 1, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1496, 231, 'instagram', 'fostrhealthcare', 1, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1497, 231, 'facebook', '', 1, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1498, 231, 'twitter', '', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1499, 231, 'youtube', '', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1500, 231, 'linkdin', '', 1, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1501, 231, 'homeNumber', '91-', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1502, 231, 'workNumber', '91-', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1503, 231, 'otherNumber', '91-', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1504, 231, 'music', '', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1505, 231, 'payment', '8971235679@upi', 1, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1506, 231, 'externalLink', '', 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(1507, 239, 'website', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1508, 239, 'socialMail', 'raj1993santosh@gmail.com', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1509, 239, 'instagram', '_santosh_raj__', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1510, 239, 'facebook', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1511, 239, 'twitter', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1512, 239, 'youtube', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1513, 239, 'linkdin', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1514, 239, 'homeNumber', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1515, 239, 'workNumber', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1516, 239, 'otherNumber', '', 0, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(1517, 240, 'website', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1518, 240, 'socialMail', 'kotresh023@gmail.com', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1519, 240, 'instagram', 'kotreshkt', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1520, 240, 'facebook', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1521, 240, 'twitter', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1522, 240, 'youtube', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1523, 240, 'linkdin', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1524, 240, 'homeNumber', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1525, 240, 'workNumber', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1526, 240, 'otherNumber', '', 0, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(1527, 215, 'website', '', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1528, 215, 'socialMail', 'tejusreddy93@gmail.com', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1529, 215, 'instagram', 'tejusreddyv93', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1530, 215, 'facebook', 'Tejus V Reddy', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1531, 215, 'twitter', '', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1532, 215, 'youtube', 'tejusreddy93', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1533, 215, 'linkdin', '', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1534, 215, 'homeNumber', '91-', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1535, 215, 'workNumber', '91-', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1536, 215, 'otherNumber', '91-', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1537, 215, 'music', 'https://open.spotify.com/user/22n6miin6exwsekc6ax3iipii?si=ub7f2yYwSdKnb1N_1cnoxQ', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1538, 215, 'music', '', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1539, 215, 'music', '', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1540, 215, 'payment', '', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1541, 215, 'payment', '', 0, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1542, 215, 'externalLink', 'https://www.fostrhealthcare.com', 1, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(1553, 246, 'website', 'www.webtual.com', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1554, 246, 'socialMail', 'umang@umang.com', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1555, 246, 'instagram', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1556, 246, 'facebook', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1557, 246, 'twitter', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1558, 246, 'youtube', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1559, 246, 'linkdin', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1560, 246, 'homeNumber', '91-5434884', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1561, 246, 'workNumber', '91-8767949', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1562, 246, 'otherNumber', '91-64646493', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1563, 246, 'music', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1564, 246, 'payment', 'umangdesai1111@ybl', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1565, 246, 'externalLink', '', 1, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(1589, 247, 'website', 'www.fostrhealthcare.com', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1590, 247, 'socialMail', 'bhavana@cliquesocial.co', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1591, 247, 'instagram', 'bhavana___21', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1592, 247, 'facebook', 'https://www.facebook.com/bhavana.reddy.4', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1593, 247, 'twitter', '', 0, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1594, 247, 'youtube', '', 0, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1595, 247, 'linkdin', '', 0, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1596, 247, 'homeNumber', '91-8971235694', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1597, 247, 'workNumber', '91-', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1598, 247, 'otherNumber', '91-', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1599, 247, 'music', '', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1600, 247, 'payment', '', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1601, 247, 'externalLink', '', 1, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(1602, 248, 'website', 'www.webtual.com', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1603, 248, 'socialMail', 'umangdesai111@gmail.com', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1604, 248, 'instagram', '', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1605, 248, 'facebook', '', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1606, 248, 'twitter', '', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1607, 248, 'youtube', '', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1608, 248, 'linkdin', '', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1609, 248, 'homeNumber', '91-1234567890', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1610, 248, 'workNumber', '91-9876543210', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL),
(1611, 248, 'otherNumber', '91-2580258025', 0, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_users_profile`
--

CREATE TABLE `temp_users_profile` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/user/default.png',
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sharing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_card_active` tinyint DEFAULT NULL,
  `current_lat` decimal(12,9) DEFAULT NULL,
  `current_long` decimal(12,9) DEFAULT NULL,
  `privacy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_file_status` tinyint(1) DEFAULT NULL,
  `resume_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_link_status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_users_profile`
--

INSERT INTO `temp_users_profile` (`id`, `user_id`, `bio`, `avatar`, `gender`, `is_read`, `is_view`, `is_sharing`, `is_card_active`, `current_lat`, `current_long`, `privacy`, `resume_file`, `resume_file_status`, `resume_link`, `resume_link_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'I have huge experince in laravel development', '/avatars/1_avatar1604086745.jpg', 'male', NULL, NULL, NULL, 1, '23.027160600', '72.508519800', NULL, NULL, NULL, NULL, NULL, '2020-08-18 13:00:00', '2020-10-30 19:39:05', '2020-08-18 13:00:00'),
(103, 152, NULL, '/avatars/152_avatar1603969365.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 11:02:45', '2020-10-29 11:02:45', NULL),
(104, 153, 'I am team leader in webtual technologies. I have high experince flutter developers', '/avatars/153_avatar1604322476.png', NULL, NULL, NULL, NULL, NULL, '21.320811200', '70.438914000', '1', NULL, 1, NULL, 1, '2020-12-23 05:27:38', '2020-12-23 05:27:38', NULL),
(106, 155, 'bsbsbsbsbbsbs', '/avatars/155_avatar1603971511.jpeg', NULL, NULL, NULL, NULL, NULL, '21.588909000', '71.225748500', '0', NULL, 1, NULL, 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(107, 156, 'my name is dhoni', '/avatars/156_avatar1603971559.jpg', NULL, NULL, NULL, NULL, NULL, '23.038997500', '72.531068000', '0', '/resume/resume1603978779.pdf', 1, 'www.nokri.com', 1, '2020-11-02 11:32:48', '2020-11-02 11:32:48', NULL),
(108, 157, NULL, '/avatars/157_avatar1603973474.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:11:14', '2020-10-29 12:11:14', NULL),
(109, 158, NULL, '/avatars/158_avatar1603973805.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:16:45', '2020-10-29 12:16:45', NULL),
(110, 159, NULL, '/avatars/159_avatar1603973895.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:18:15', '2020-10-29 12:18:15', NULL),
(111, 160, NULL, '/avatars/160_avatar1603974625.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:30:25', '2020-10-29 12:30:25', NULL),
(112, 161, NULL, '/avatars/161_avatar1603982347.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 14:39:07', '2020-10-29 14:39:07', NULL),
(114, 163, NULL, '/avatars/163_avatar1604140620.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-31 10:37:00', '2020-10-31 10:37:00', NULL),
(115, 164, NULL, '/avatars/164_avatar1604141880.jpeg', NULL, NULL, NULL, NULL, NULL, '23.092325447', '72.527827032', '0', NULL, NULL, NULL, NULL, '2020-10-31 10:58:00', '2020-12-10 09:06:50', NULL),
(136, 185, 'I am tester', '/avatars/185_avatar1604407922.png', NULL, NULL, NULL, NULL, NULL, '23.038982500', '72.531089800', '0', NULL, NULL, NULL, NULL, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(137, 186, NULL, '/avatars/186_avatar1604410246.png', NULL, NULL, NULL, NULL, NULL, '23.038986100', '72.531088000', '0', NULL, 1, NULL, 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(138, 187, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-23 09:08:52', '2020-11-23 09:08:52', NULL),
(139, 188, 'iPhone bio data user', '/avatars/188_avatar1606469984.png', NULL, NULL, NULL, NULL, NULL, '21.590412347', '71.223949042', '0', NULL, NULL, NULL, NULL, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(140, 189, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-27 10:42:39', '2020-11-27 10:42:39', NULL),
(141, 190, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-27 11:17:15', '2020-11-27 11:17:15', NULL),
(142, 191, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-27 11:24:29', '2020-11-27 11:24:29', NULL),
(143, 192, NULL, '/avatars/192_avatar1606734113.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-30 11:01:53', '2020-11-30 11:01:53', NULL),
(153, 212, NULL, '/avatars/212_avatar1608728403.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-24 11:40:15', '2020-12-24 11:40:15', NULL),
(157, 213, NULL, '/avatars/213_avatar1608815477.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-25 13:35:50', '2020-12-25 13:35:50', NULL),
(158, 214, NULL, '/avatars/214_avatar1608881540.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-25 07:35:59', '2020-12-25 07:35:59', NULL),
(162, 216, 'hhhjk', '/avatars/216_avatar1611757537.png', NULL, NULL, NULL, NULL, NULL, '-27.602673800', '-48.636657800', '0', NULL, NULL, NULL, NULL, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(163, 217, 'fgffhfhfhfhfj', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '21.593466600', '71.222290600', '0', NULL, NULL, NULL, NULL, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(164, 218, 'bchcjfjf', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.051771200', '72.521151800', '0', NULL, NULL, NULL, NULL, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(167, 224, 'dhhsbdhdbs', '/avatars/224_avatar1614925401.png', NULL, NULL, NULL, NULL, NULL, '23.092401200', '72.527936400', '0', NULL, NULL, NULL, NULL, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(177, 154, 'I am developer', '/avatars/154_avatar1615180230.png', NULL, NULL, NULL, NULL, NULL, '23.092366954', '72.527979430', '0', NULL, NULL, NULL, NULL, '2021-03-08 06:21:36', '2021-03-08 06:21:36', NULL),
(178, 226, 'I\'m working with webtual technology', '/avatars/226_avatar1615271586.png', NULL, NULL, NULL, NULL, NULL, '23.092382400', '72.527919600', '0', NULL, NULL, NULL, NULL, '2021-03-09 06:33:06', '2021-03-09 06:33:06', NULL),
(186, 145, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '/avatars/145_avatar1616135307.png', NULL, NULL, NULL, NULL, NULL, '21.530711300', '70.367568700', '1', NULL, NULL, NULL, NULL, '2021-03-19 06:28:27', '2021-03-19 06:28:27', NULL),
(190, 134, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '/avatars/134_avatar1616398536.png', NULL, NULL, NULL, NULL, NULL, '21.530711300', '70.367568700', '1', NULL, NULL, NULL, NULL, '2021-03-22 07:35:36', '2021-03-22 07:35:36', NULL),
(191, 179, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '/avatars/179_avatar1616398586.png', NULL, NULL, NULL, NULL, NULL, '21.530711300', '70.367568700', '1', NULL, NULL, NULL, NULL, '2021-03-22 07:36:26', '2021-03-22 07:36:26', NULL),
(193, 228, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '/avatars/228_avatar1616398969.png', NULL, NULL, NULL, NULL, NULL, '21.530711300', '70.367568700', '1', NULL, NULL, NULL, NULL, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(194, 229, 'Baja Abbas', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.092409473', '72.527897029', '0', NULL, NULL, NULL, NULL, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(195, 230, 'bjvvmv mm', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.092374600', '72.527893900', '0', NULL, NULL, NULL, NULL, '2021-03-31 06:39:46', '2021-03-31 06:39:46', NULL),
(231, 193, 'this is testing', '/avatars/193_avatar1608813523.png', NULL, NULL, NULL, NULL, NULL, '23.020182000', '72.439654300', '1', NULL, NULL, NULL, NULL, '2021-04-10 06:12:11', '2021-04-10 06:12:11', NULL),
(232, 219, 'I\'m working for webtual technologies', '/avatars/219_avatar1615274780.png', NULL, NULL, NULL, NULL, NULL, '23.092369606', '72.527855623', '0', NULL, NULL, NULL, NULL, '2021-04-10 06:22:13', '2021-04-10 06:22:13', NULL),
(236, 234, 'Testing application to see the flow of the app', '/avatars/234_avatar1619252240.png', NULL, NULL, NULL, NULL, NULL, '23.031948000', '72.538414100', '0', NULL, NULL, NULL, NULL, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(237, 236, 'Not yet', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '31.816154000', '76.472395000', '0', NULL, NULL, NULL, NULL, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(238, 237, 'Nothing', '/avatars/237_avatar1619448424.png', NULL, NULL, NULL, NULL, NULL, '37.785834000', '-122.406417000', '0', NULL, NULL, NULL, NULL, '2021-04-26 14:47:04', '2021-04-26 14:47:04', NULL),
(239, 238, 'Hdhddudydydydududuuddhdeherhrhrhrhrjrjrjrjrjjrrjrjhrrhrhrhrhrhrhjrjrjrjrrjjrhrhrhrrhrhjrrjrjrjrnrjrjrijrjrrjjrrjrjrnrnjrirrirjjrrjjrjrrjjrrjrnbrbrbrbrbrbrbrbrbrbrbrbhrhrhrhrhrhrhrjjrhrrjrhhrhrrhhrhrrjrhjrjrjrrjrjjrjrjjrrjrjjrjrjrjrjrjrjjrjrjrjrjrj4j4j4b4b4b4nnrb4b4b44bb4b4h4h4h4r', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.005152900', '72.633990300', '0', NULL, NULL, NULL, NULL, '2021-04-27 08:07:24', '2021-04-27 08:07:24', NULL),
(244, 231, 'Fostr Healthcare - Managing Director', '/avatars/231_avatar1619604135.png', NULL, NULL, NULL, NULL, NULL, '12.937543325', '77.709548220', '0', NULL, NULL, NULL, NULL, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(245, 239, NULL, '/avatars/239_avatar1619694322.png', NULL, NULL, NULL, NULL, NULL, '12.937512304', '77.709723041', '0', NULL, NULL, NULL, NULL, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(246, 240, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '12.937512304', '77.709723041', '0', NULL, NULL, NULL, NULL, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(247, 215, NULL, '/avatars/215_avatar1618242888.png', NULL, NULL, NULL, NULL, NULL, '12.937512304', '77.709723041', '0', NULL, NULL, NULL, NULL, '2021-04-29 11:25:24', '2021-04-29 11:25:24', NULL),
(250, 246, 'Baja did d djbdjd dkd kendo’s', '/avatars/246_avatar1620022624.png', NULL, NULL, NULL, NULL, NULL, '23.074859300', '72.569271027', '0', NULL, NULL, NULL, NULL, '2021-05-03 06:17:04', '2021-05-03 06:17:04', NULL),
(253, 247, NULL, '/avatars/247_avatar1620053703.png', NULL, NULL, NULL, NULL, NULL, '12.937513223', '77.709742109', '0', NULL, NULL, NULL, NULL, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(254, 248, 'This account is created with registration with email password', '/avatars/248_avatar1620118957.png', NULL, NULL, NULL, NULL, NULL, '23.074908411', '72.569237616', '0', NULL, NULL, NULL, NULL, '2021-05-04 09:02:37', '2021-05-04 09:02:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `tagline` varchar(155) DEFAULT NULL,
  `description` text,
  `image` varchar(155) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `tagline`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(7, 'Roahn', 'cool', 'this is cool app , very nice', '/testimonials/_logo1600679749.jpeg', '2020-09-20 22:15:49', '2020-09-20 22:15:49', NULL, 1, 1, NULL),
(8, 'Hiren', 'super duper', 'very nice , nice product \r\ni really like it', '/testimonials/_logo1600679849.jpeg', '2020-09-20 22:17:29', '2020-09-20 22:17:29', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_temp` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `remember_token`, `active`, `status`, `is_temp`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@clique.com', NULL, '$2y$10$PErf6qhprWPj9rqornVJLOy2s12or34t3TlDryygs7EGrtpTMfCOm', '91-2222222222', 'mjAfX9mAkWOFr7GYIkd99DXuLZOq09XDeXw0IKkKAGI9aTyHB5fiInI2NrdB', NULL, NULL, 0, '2020-08-18 23:45:31', '2020-10-30 10:17:31'),
(152, 'Infosys', 'Infosys@gmail.com', '$2y$10$VR3NgjC7Hx0Kmy6kY6buYu1zKZA.vCBYXjrZ6lVatfSIwTWNpJb8G', '$2y$10$tQIDvBXo1mQKttoIzESiU.d8ruXVGhCg6/Dr72NHUwRMwQR8.mSKS', '91-8787878787', NULL, NULL, '1', 0, '2020-10-29 11:02:45', '2020-10-29 11:02:45'),
(153, 'ashvini', 'ashvini@gmail.com', NULL, '$2y$10$C9fbEf924jYL4k54DXLOKu3ncOOu5cnmYiV86J65F.QZTuv9nKw5q', '91-8320008656', NULL, NULL, NULL, 0, '2020-10-29 11:04:41', '2020-12-24 06:59:48'),
(154, 'Constant', 'dsiduidosoif@gmail.com', NULL, '$2y$10$vrGjcsvph2/KJhjn/4q.z.5zWXWmUsO8OVsPbhB6U38fBZrY7GLa.', '91-8758662075', NULL, NULL, NULL, 1, '2020-10-29 11:04:44', '2021-03-30 11:50:26'),
(155, 'virat', 'virat@gmail.com', '$2y$10$3H2dS0.3oPUDRMS8/7UJAufug8I1SOMfAvLC.WPyOyk3GfD1henNe', '$2y$10$niRBpBeufaRu3pwqGHeHq.ErIMuEEdXDZSOqLgStbYlS6Tt0V4eFy', '91-3434341654', NULL, NULL, '1', 0, '2020-10-29 11:38:31', '2020-10-29 11:38:31'),
(156, 'dhoni', 'dhoni@gmail.com', '$2y$10$nbhTyovL7FFenRlkOOEZXeNkjHzPn4EC47r4IudlGeQ8V137u/eqK', '$2y$10$RFfX0yNBEOn0fidbEFIFceIc7njKLtmsFW6DnjDcgZb0rV8In8XHG', '91-6745453333', NULL, NULL, '1', 0, '2020-10-29 11:39:19', '2020-10-29 11:39:19'),
(157, 'wipro', 'wipro@gmail.com', '$2y$10$6Ac0IA6dhcuOWL8RNkDa6O2Udsjwi4FmdulUknLfWZ.eQc.40lvd.', '$2y$10$Q4Fr44m1.XpaHevTWQZPR.O.VDiyys/xBm7ESlg9pjsGF85v8uPLe', '91-9898565643', NULL, NULL, '1', 0, '2020-10-29 12:11:14', '2020-10-29 12:11:14'),
(158, 'tata', 'tata@gmail.com', '$2y$10$6YtuG6ebb/AruH8vaXeLR.mEqOoo.EVwPWbDtCLh35y5MK5Ib28LW', '$2y$10$HXgziLn8P4pgRQXFJoNgcOjc0sdVNU0ELEXYMtnk/t14Dr/2aq9eK', '91-2323456789', NULL, NULL, '1', 0, '2020-10-29 12:16:45', '2020-10-29 12:16:45'),
(159, 'webtual', 'webtual@gmail.com', '$2y$10$BESiMvX6oHJS5aY2..lrBeMdgXREUXpDiTaSqwgtRlnvEPpPudvtS', '$2y$10$0/Nq0dJsbHK5NCEFGKneX.m148DPi/lo8HuJ7MI7RF11kNXYgCsqu', '91-1254127787', NULL, NULL, '1', 0, '2020-10-29 12:18:15', '2020-10-29 12:18:15'),
(160, 'tcs', 'tcs@gmail.com', '$2y$10$TwpkmJHEBer027De6QJjruUIGYB.h6Jo6s72G2JKj17O8VukAE6FK', '$2y$10$XXgGtDPgX/wdcPvjWa9v5empqQ6BYNPogHOMRH1X3brmnlGn0SR.6', '91-8865000431', NULL, NULL, '1', 0, '2020-10-29 12:30:25', '2020-10-29 12:30:25'),
(161, 'dhruv', 'dhruv@gmail.com', '$2y$10$S9g/zqvpQ2Auxon0NdwPoeqvM2jpkq49dW4F/JoAMea9mtJyKY8OK', '$2y$10$nd/Z2emuIxzoESqkYnx7gOx76aA5SOfQYfUCh.76qVKxmX2b9DE0i', '91-1245677889', NULL, NULL, '1', 0, '2020-10-29 14:39:07', '2020-10-29 14:39:07'),
(163, 'webtual2', 'webtual2@gmail.com', '$2y$10$rMU6mAs54syS2e1FjrasgOtq3l13qvHTCG3GXVsrKG8Sn7JXSpjo.', '$2y$10$D8b5aOKz.7f2jIBPA5xHhOVPBvk1Kp0YvM6oW334I1c3IbuslSQ7a', '91-6767676767', NULL, NULL, '1', 0, '2020-10-31 10:36:59', '2020-10-31 10:36:59'),
(164, 'ankit shah', 'ashah20@webtual.com', '$2y$10$h/qhQugXo2p.ZKwJU55es.tKsiWSc7ALml3MPvwUG3VACGaBXAJq6', '$2y$10$p5kcCzk8W/EIOO0WgQSHZuwLcB2jwmPrUl9TLwjTCpPt.E9zFqr0W', '91-9978619861', NULL, NULL, '1', 0, '2020-10-31 10:58:00', '2020-10-31 10:58:00'),
(185, 'martin', 'martin@gmail.com', NULL, '$2y$10$0WCafyktvcfAAiVH5Sr57eVvBWS7xl7uNaLh/D1DSluhh00hfV6gS', '91-4545545454', NULL, NULL, NULL, 0, '2020-11-03 12:48:04', '2020-11-03 12:52:02'),
(186, 'bond', 'bond@gmail.com', '$2y$10$gmu5qbfVCv1sRej7bAMutuhLdsRVIGpnvWw3L6ZpNLE7toLyqCy3O', '$2y$10$SivuGDQw1Y0B6M39vwQPFuZhkoVsFFyJNpfr81ijdFuIPHfPRw9Su', '91-9887777777', NULL, NULL, '1', 0, '2020-11-03 13:19:44', '2020-11-03 13:19:44'),
(187, 'jeson', 'jeson@gmail.com', '$2y$10$JohXx3fvt84Ki/3ozyj6T.jAP1C3VCl2BZd3vwy9X6/ovSpIIDc6G', '$2y$10$bO02faOV.O3vPQLeCl31S.0HrHIjNVknn7f2yergZwVSmT2D5m5Lm', NULL, NULL, NULL, '1', 0, '2020-11-23 09:08:52', '2020-11-23 09:08:52'),
(188, 'iPhone users', 'iphone@gmail.com', NULL, '$2y$10$huV.FpuyyGdepltnHpvNc.tKIeMICPSSmiLWsumDkwSAY/5TV/Cga', '91-2585285258', NULL, NULL, NULL, 0, '2020-11-27 09:37:45', '2020-11-27 09:39:44'),
(189, 'ZZZ', 'ZZZ@gmail.com', '$2y$10$yeMP5IK0tG.7QkK9ygUM0OPFPI4n4YbSZa5PUYJ0kpefmuN764hBa', '$2y$10$L8aZrFdzmlK7GoMDP53B2.LOLuU.f6X7jH1tb59nsNUkPwnGoS0eO', NULL, NULL, NULL, '1', 0, '2020-11-27 10:42:39', '2020-11-27 10:42:39'),
(190, 'remo', 'remo@gmail.com', '$2y$10$wSc2Fj4MXp1Q8yqF4zQxSerAbuL4angbte9iJ3NwEDfkBDNufZ6Me', '$2y$10$.6LtgzJsd27wtPBUTeDenOsRRMyRejeZlOR7YGSjXUtgtNdrCq5NS', NULL, NULL, NULL, '1', 0, '2020-11-27 11:17:15', '2020-11-27 11:17:15'),
(191, 'paresh', 'paresh@gmail.com', '$2y$10$0HWmkam5R1B2zhSQI0.WQeNuL8ZCA7dvxiRl8pwAoljJoIdw5SRAa', '$2y$10$HgVK/kg.o7hMZNU36AH94uh0YwSZUIflA7LZKGQ8OKfxQpe4m8Rxa', NULL, NULL, NULL, '1', 0, '2020-11-27 11:24:29', '2020-11-27 11:24:29'),
(192, 'Gaurav Vaniya', 'gvaniya@webtual.com', '$2y$10$1CnPOYGoKKbBu1OOKn/xQOFeP4GXm3oggTZb2tAWpgZp1Q3sWF.y.', '$2y$10$RAYJ9kC.dv/lyYhM8hDBA.nKaPtHJ8TXfqpYDxnl2p4bg5.pbLzeq', '91-8866601116', NULL, NULL, '1', 0, '2020-11-30 11:01:53', '2020-11-30 11:01:53'),
(193, 'bhargav', 'bmistri@webtual.com', NULL, '$2y$10$skySu/kqkvTqJtg3T6QZb.lr3o0cV1cUHhsKMDzFJsOHJMbbSEE0u', '91-8866006401', NULL, NULL, NULL, 0, '2020-12-09 15:51:38', '2021-04-02 07:09:16'),
(194, 'Ayaan', 'ayaan@yopmail.com', '$2y$10$49xYOCb6ON7QHcZy5ifp0OCZbsElQq6l47S6BNmxxxL497845csp.', '$2y$10$QxZ0uyEC.4RA2yjmXRAV3e034nmHVcKzD5.P4qwtPsA7UFZ6pkBY6', '91-1234567890', NULL, NULL, '1', 0, '2020-12-23 09:48:35', '2020-12-23 09:48:35'),
(195, 'manoj', 'manojcorporate@yopmail.com', '$2y$10$l.NFr.O9clBt5bn6ZCSSeuZhbp3cyyMIXy137ME6XvsiQFJxdhc3i', '$2y$10$Eq3.T5dX2SiU0bkaklxdw.zGapTUR4i/EF/DgNsrzvXfv.DeVlxw.', '91-1234765900', NULL, NULL, '1', 0, '2020-12-23 09:49:41', '2020-12-23 09:49:41'),
(196, 'corporte_testing', 'corporate@yopmail.com', '$2y$10$dIZ9OzHdPeOOFcTOWLJ4AeFqH0nxJcKYVU6pEU9ZR/GDipDVlylGe', '$2y$10$plsgDu4KH75JUBstMzhfK.r6TJuR1S5XJqjQkb1wnvS8.W99aM3kq', '91-3214567890', NULL, NULL, '1', 0, '2020-12-23 09:50:32', '2020-12-23 09:50:32'),
(197, 'test user', 'testuser@gmail.com', NULL, '$2y$10$WRyulUgTXkWRz/Yd4.gzheu75U6CcYNe1R1AcSL1YFymV1oMMWF/2', '91-3636363636', NULL, NULL, NULL, 0, '2020-12-23 10:00:32', '2020-12-23 10:02:16'),
(198, 'tester', 'test@gmail.com', NULL, '$2y$10$OnWxnf17HFHpx0TPNNrQY.jSuDNtqehfc3dkzfum//wALrXN/b.We', '91-2626262626', NULL, NULL, NULL, 0, '2020-12-23 10:10:16', '2020-12-23 10:13:34'),
(199, 'gvaniya01', 'gvaniya01@yopmail.com', '$2y$10$PjWysV2WhKrRSOH3TfMF7eU5d.wa4u7teffNn6EmKwuDLoz29Wdjq', '$2y$10$MiiKbrEm3G/z8nkGDoCcWOSiXP3QiK5GUPSM7ltse.MTVk2B4xWLe', '91-8899904788', NULL, NULL, '1', 0, '2020-12-23 10:38:25', '2020-12-23 10:38:45'),
(200, 'Webesoft', 'webesoft@yopmail.com', '$2y$10$/QeZuvWxg8sbSozr8d7Gge9JZEtfrdfVLAhAnyGlQ6PfmaiNTCnvu', '$2y$10$ZzqL81XtAE8wgpS6OC/yz.JEHlBmtChp.regfpJU0rsCOsqDVpXNi', '91-6547887777', NULL, NULL, '1', 0, '2020-12-23 10:39:50', '2020-12-23 10:39:50'),
(201, 'Webesoft1', 'webesoft1@yopmail.com', '$2y$10$QEpsZ7EGQTpJblj9tcyeKOLozq9GJOg4jD3INPicyfBktsZx0aK16', '$2y$10$CUBhs7tssS397r1HoqQXLutExsgYBMzKlhEJDZox2M8hkitKXF7HW', '91-6547887775', NULL, NULL, '1', 0, '2020-12-23 10:40:29', '2020-12-23 10:40:29'),
(202, 'Webesoft2', 'webesoft2@yopmail.com', '$2y$10$RhQJsf.pVCTGIM0D2lI7pOR/MLLnAAOKXotIUBRCQ5QL0XD/.GuN6', '$2y$10$i8NCs/LXCoCw3vDGjHKN1eGIfPjAbXFLyyg.WJgaz22loqXs5Ft8m', '91-6547887744', NULL, NULL, '1', 0, '2020-12-23 10:42:03', '2020-12-23 10:42:03'),
(203, 'xyz', 'xyz@gmail.com', '$2y$10$B.MZDpZj5F7j5ABLSF6y1.1qs9UqP6NZBVaPsN1UHmSGz3EPl0ra2', '$2y$10$qvWV0tfixdqCUhy/y1fAnuobIu1kiQx3qHL760pVqNoO3CzxnNbru', '91-4567891010', NULL, NULL, '1', 0, '2020-12-23 10:43:27', '2020-12-23 10:43:27'),
(204, 'corporat_Androidtesting', 'androidcorporate@yopmail.com', '$2y$10$JG8w1Ia3HwmlmIRYD9NREey79rovVLWGN0NWfsL0ZuCQXXS07f6Zy', '$2y$10$CeCZu62jHmcn208TJWMfYupDMFYMG./BVp3f9yXgcY.GtFr349mVm', '91-6541239870', NULL, NULL, '1', 0, '2020-12-23 10:44:44', '2020-12-23 10:44:44'),
(205, 'Webesoft23', 'webesoft23@yopmail.com', '$2y$10$EXjzjqYWnnpqb/0lhKDm2e7t2v1Qp/1xTZ3Xb5cGq8cc/6VQybIzC', '$2y$10$Q0Vr0pYxPdwuZtBzy2BrAO9zK6pNUZf6TrsuwBHOKFFqIqbwCieba', '91-6547887732', NULL, NULL, '1', 0, '2020-12-23 10:44:46', '2020-12-23 10:44:46'),
(206, 'Ayaan', 'ayaan1@yopmail.com', '$2y$10$MpcCemS44T7mscOPDxv9veeMEF5/sSVib7JdGo63/1oIt/TiX8YS2', '$2y$10$VeSsGgoyf6p6O5Uh4W99wuTWf6AuNskAEBm9T/UwZLk4.cMiD78F.', '91-9687474250', NULL, NULL, '1', 0, '2020-12-23 10:46:41', '2020-12-23 10:46:41'),
(207, 'Ayaan', 'ayaan111@yopmail.com', '$2y$10$XHqNf5Ip7lJoyxDYFXUHHe0bXgiSESBVozgwa4/Ux3j9bUn/pNyK.', '$2y$10$6ZJf3A7GQljqRxf.tqA/he8fIimwPtq7Uulh3E8/zmubHiJ74XiOy', '91-9647874524', NULL, NULL, '1', 0, '2020-12-23 10:47:08', '2020-12-23 10:47:08'),
(208, 'Ayaan', 'ayaan14356@yopmail.com', '$2y$10$tWPZTzWwu8VXYtvz41dLbOzCLeSd2YXHt5cBWj1SZG9LImMuJoswW', '$2y$10$oK/TexBu5D5QlAeFjsyJve5VQ/d1MScX/L0dz9hGk/dUSwbS.Omwi', '91-8754091233', NULL, NULL, '1', 0, '2020-12-23 10:47:35', '2020-12-23 10:47:35'),
(209, 'sdfgdg', 'dfgdg@gmail.com', '$2y$10$TB8k.bCQH09vCUoxqYvooez31v9m6lkAY2IYwD6lTs9Db3fccwgt.', '$2y$10$JpznpzafxmYs/VQtLDc8yeOLbqIHXgyekALU2Ji6SOC4WiuaW8GT2', '91-9979094604', NULL, NULL, '1', 0, '2020-12-23 11:02:15', '2020-12-23 11:02:15'),
(210, 'Rankit', 'rankit@yopmail.com', '$2y$10$S9oqUg8zdXWMqxR59greu.M4K.rJCMY0T.X7VZ/7TPO9DwRQwB8v2', '$2y$10$EL488JSnkhe48V.iHB.n3u1jesAWiWQu6LVz2cJjnCaI4vLn28m.a', '91-8712385903', NULL, NULL, '1', 0, '2020-12-23 12:28:55', '2020-12-23 12:51:57'),
(211, 'asdf', 'asdf@gmail.com', NULL, '$2y$10$cCJ2LWOENGInH..rWybSmuZjJiWR2Ny8J1MUHXNfJz9llzfxvvNmG', '91-2525252525', NULL, NULL, NULL, 0, '2020-12-23 12:35:48', '2020-12-23 12:40:38'),
(212, 'mnb', 'tyu@gmail.com', NULL, '$2y$10$xt9MThr6y4h8XVB17ygBWe8z5b0J.Hx2QJforJ2ajHjC4VtglX6ou', '91-1231231231', NULL, NULL, NULL, 1, '2020-12-23 12:59:09', '2020-12-24 12:12:42'),
(213, 'ARShah', 'ankit.rshah@yahoo.com', NULL, '$2y$10$F9Lprhy4w9ruehd.zq1bQ.XJgOYZIjczkf0wzfv26puB3g3E.KNPe', '91-9978619860', NULL, NULL, NULL, 1, '2020-12-24 13:07:54', '2020-12-25 13:34:04'),
(214, 'ahhaha', 'shsh@gmail.com', NULL, '$2y$10$EI5.6CoZcuG6Ckgd7EQuE.p306khnzwu1gc86Zi72zObuR1Srrh7u', '91-8585858585', NULL, NULL, NULL, 0, '2020-12-25 07:31:34', '2020-12-25 08:54:38'),
(215, 'Tejus', 'tejusreddy93@gmail.com', NULL, '$2y$10$wq19AqJzZSrQh0hp4pk8x.XXYZlzRIPGY269CQBqdJE//Djamw7o6', '91-8971235696', NULL, NULL, NULL, 0, '2020-12-25 13:34:05', '2021-05-04 12:29:20'),
(216, 'joao', 'test@mail.com', NULL, '$2y$10$AI6rATuJJmZyBugDDcBuaOp30tFEVj7XPmgJP6kMwrxnvG16fzSKK', '91-8971235698', NULL, NULL, NULL, 0, '2021-01-27 14:24:25', '2021-01-27 14:25:37'),
(217, 'fghh', 'aaa@gmail.com', NULL, '$2y$10$k1xadO/Lb8L8bE96QuScYOyRtzesYeOXTn.Xd2Rv8wLz2oyEyLmXe', '91-8866171024', NULL, NULL, NULL, 0, '2021-02-22 11:06:37', '2021-02-23 06:08:14'),
(218, 'cjcjch', 'aaaa@gmail.com', NULL, '$2y$10$EXBQ5rzGgs/mqTjW.qKiK.D8qyiRMIL5HHHUPA4cc2jHIZeenslBW', '91-2536253625', NULL, NULL, NULL, 0, '2021-02-23 11:07:15', '2021-03-01 11:16:09'),
(220, 'Manoj Roy', 'manojroy@yopmail.com', '$2y$10$s9BCnO0jO1XlhO7lW8nIsebXmSFfMuc.TxrBAjeVjmYF/Uv44gV1O', '$2y$10$dlXL9KLRAudmy8ZXskb9UO0DHBbAtzYXb.nZshypZXuMm/S/JueRG', '91-8200418999', NULL, NULL, '1', 0, '2021-03-02 05:45:26', '2021-03-02 10:25:07'),
(221, 'manojroycorporate', 'corporatemanoj@yopmail.com', '$2y$10$67G7h42ZUKJpHjD4J61OgONxny4zYMxrH3qgxmvl2D9GLQ44Q3IUG', '$2y$10$J.oTUoRUC93MJQivCwh1PuGwqT2/sUB8apNgiOQaHHjXovvOZOwWC', '91-3246782222', NULL, NULL, '1', 0, '2021-03-02 05:55:56', '2021-03-02 10:09:34'),
(222, 'MANOJCORPORATE', 'corporateadmin@yopmail.com', '$2y$10$QMCtbn3jQq7BBonE5m5wvuVy6Amz43jG7d/uIwxmJzcAo3FgOhBEm', '$2y$10$7XZNAvwBzaLDPkMsLDmTo.GNOrJnTucFN5zIx0Qov51CmFrW1x3ke', '91-5467890214', NULL, NULL, '1', 0, '2021-03-02 05:58:48', '2021-03-02 05:58:48'),
(223, 'bhavesh vania', 'userbde@yopmail.com', '$2y$10$r6qf8vZGbkVhLI6qyITam.hMuVjJoxTp6ubPdN1N4VacjTTrf9yya', '$2y$10$Yn0SEVX181O038ejSS2hc.Src2MZt3cEPMPePQivTFYx7sVZNeYVW', '91-7345009876', NULL, NULL, '1', 0, '2021-03-02 10:15:06', '2021-03-02 10:15:06'),
(224, 'hwhwhw', 'qwe@gmail.com', NULL, '$2y$10$LMVgly6eLGmGqKHFh5BELuxxsKcpGHvTPiYLnOZw7pQCTHdVEQQZe', '91-9696969696', NULL, NULL, NULL, 0, '2021-03-05 06:22:14', '2021-03-05 06:23:21'),
(225, 'Umang test', 'test7108@gmail.com', NULL, '$2y$10$r2H4He8jRzjZ7p/Md3tdYepAkjgVZyKIU8cjxb9ysp/3Q93xyMxLy', '91-2580258080', NULL, NULL, NULL, 0, '2021-03-08 05:19:22', '2021-03-08 05:19:22'),
(227, 'jejeje', 'test8139@gmail.com', NULL, '$2y$10$4WJXXVGhB5s00YcjqcnKFOS/tC4C5yhZNCO6pkw.FCLADTXnI44Mu', '91-1251251250', NULL, NULL, NULL, 0, '2021-03-09 09:43:33', '2021-03-09 09:43:33'),
(228, 'ranbir', 'ranbir234@gmail.com', NULL, '$2y$10$9HluOPPmpF3sRGZee5XC9uJKyqv2cw9WYUVZ5afdOtgxvRELvxZaK', '91-9903983567', NULL, NULL, NULL, 0, '2021-03-22 07:23:12', '2021-03-22 07:36:49'),
(229, 'Umang year', 'mang@mang.com', NULL, '$2y$10$P1RqFDYoBq/1AFBzLrezJeJT.EiJ/4lMYeVhiwsSFPg..bzaMqZYO', '91-8511851185', NULL, NULL, NULL, 0, '2021-03-31 05:24:45', '2021-03-31 06:34:31'),
(230, 'desao', 'email@email.com', NULL, '$2y$10$wKKQUfwcLqaqszWGyuXgfOqZUPzRz4ugj3z8AQuboTZrIEzgn2eWS', '91-3693693690', NULL, NULL, NULL, 0, '2021-03-31 05:54:55', '2021-03-31 06:39:46'),
(231, 'Venkat Reddy', 'venkatreddy@fostrhealthcare.com', NULL, '$2y$10$fCSZZJFIxvPNoknmLMTtUuLL8liVKg/zQhoUmkyQSPUv9DKmADeLW', '91-8971235679', NULL, NULL, NULL, 0, '2021-04-21 11:00:37', '2021-04-21 11:02:24'),
(232, 'prakash', 'ptank@webtual.com', NULL, '$2y$10$l3y3ObBqSPcpiHIs1FUm9.0TV7tez7gxFLL3sbFoKdWctc7Ka6siG', NULL, NULL, NULL, NULL, 0, '2021-04-23 11:49:47', '2021-05-04 05:36:28'),
(233, 'prakash', 'ptank1@webtual.com', NULL, '$2y$10$d6DEX2A3TNtbyD3gwJXZ6.8XN9/6hmD54Qf/w/rQ9Zw.ZsZly7P.S', NULL, NULL, NULL, NULL, 0, '2021-04-23 11:59:47', '2021-04-23 11:59:47'),
(234, 'Rahul', 'Rahul@itoneclick.com', NULL, '$2y$10$Nz.zFqKSQOdaUj8nnR/kOOH3J93.fjcrj1BX2cFU2BfIFHKggPgBi', '91-9974937069', NULL, NULL, NULL, 0, '2021-04-24 08:14:57', '2021-04-24 08:17:20'),
(235, 'Test', 'test9107@gmail.com', NULL, '$2y$10$Z9MDXzy82k09nH4W09BgDebI/dlD6IVx7cDWwtrDilIHhS0gxjqPG', '91-9646467639', NULL, NULL, NULL, 0, '2021-04-24 09:33:00', '2021-04-24 09:33:00'),
(236, 'Test', 'thakurankush88@gmail.com', NULL, '$2y$10$/EvjfY8eGqHBS6k0XnSyIe0L8gVSwnRDQfE8vId5K/hwzOIF163SW', '91-7018561633', NULL, NULL, NULL, 0, '2021-04-24 09:34:15', '2021-04-24 09:34:47'),
(237, 'Bharat', 'bharat.chhabra339@gmail.com', NULL, '$2y$10$FMg4tFdgw7yWVJTwHx1eZOK7dMxKlyagoaZTZ8eqez7AGdsDwWt2W', '91-9896677443', NULL, NULL, NULL, 0, '2021-04-26 14:42:33', '2021-04-26 14:47:04'),
(238, 'Ajay', 'Mishraajay9898@gmail.com', NULL, '$2y$10$S39QpsEX6m.yalfMDc1TJe6M8MmpWFtjRgUTA18lA8.NS0aLVrivO', '91-9265701475', NULL, NULL, NULL, 0, '2021-04-27 07:38:51', '2021-04-27 08:07:24'),
(239, 'Santosh Raj', 'raj1993santosh@gmail.com', NULL, '$2y$10$pf22ZieuwbkSRqBhWgb6q.lK2cgkDELzYaRExJj9utUBgzLKI00Em', '91-9113245228', NULL, NULL, NULL, 0, '2021-04-29 11:03:38', '2021-04-29 11:05:22'),
(240, 'Kotresh K', 'kotresh023@gmail.com', NULL, '$2y$10$P7JaaPFsnIQofOy70AAXJuhjzB2kdoQ54.uBLdg19tTM41mCl17M.', '91-8951827328', NULL, NULL, NULL, 0, '2021-04-29 11:12:39', '2021-04-29 11:14:17'),
(241, 'yuuu', 'test6289@gmail.com', NULL, '$2y$10$SycyeQx6KMDuT7VnemmoR.aIYljyISF6BZa3359W6lQjKLHwRi./e', '91-74426699669965', NULL, NULL, NULL, 0, '2021-04-29 15:21:19', '2021-04-29 15:21:19'),
(242, 'gghh', 'test4302@gmail.com', NULL, '$2y$10$HPEvz5tuOmLQ9jherezL7O/4tRyrznZzbi6yUjEFhBHxW7KM0RR9y', '91-9876543210', NULL, NULL, NULL, 0, '2021-04-29 17:36:00', '2021-04-29 17:36:00'),
(243, 'hhhh', 'test6805@gmail.com', NULL, '$2y$10$/6fZvFsx/7Ecfq0BlxnTZOB7zvrMAOliUULESzG1akBEhzgQzeaR6', '91-9876543211', NULL, NULL, NULL, 0, '2021-04-29 18:05:34', '2021-04-29 18:05:34'),
(244, 'james', 'test5133@gmail.com', NULL, '$2y$10$yh8ve00FGU4uHNYC9cwro.4z9igaybYvKjzMXxtHRVqbb7hDHNjxS', '91-98765411230', NULL, NULL, NULL, 0, '2021-04-29 19:40:01', '2021-04-29 19:40:01'),
(245, 'prakash', 'ptank111@webtual.com', NULL, '$2y$10$1y2SAGh7hKbSteLUvfZy.u5r8eBGOVWIsvnTMmItfiGCvV4OuMES2', NULL, NULL, NULL, NULL, 0, '2021-05-03 05:13:07', '2021-05-03 05:13:07'),
(246, 'Prakash', 'ptank5@webtual.com', NULL, '$2y$10$XNRIVKFLErziShd2xmLrVeokpmP/GUFIHyF02WlSAux/PKDxJGsZS', '91-2580258080', NULL, NULL, NULL, 0, '2021-05-03 05:17:30', '2021-05-04 06:16:32'),
(247, 'Bhavana Lakshmi', 'test6593@gmail.com', NULL, '$2y$10$ro3NfE6LPyVcJZiYWtnSHuY9LBOkF3JFg500PBWnp2/wDAAKIjB5a', '', NULL, NULL, NULL, 0, '2021-05-03 14:52:19', '2021-05-03 14:55:03'),
(248, 'Umang email', 'udesai@webtual.com', NULL, '$2y$10$nvUiiuIjCD5DrKU1cQalVuIUNSG/bC5q6ntC6ixLv8wwbkvAF/QRO', '91-8511671085', NULL, NULL, NULL, 0, '2021-05-04 09:01:00', '2021-05-04 09:13:39'),
(249, 'Umang personal', 'umangdesai555@gmail.com', NULL, '$2y$10$mytSXfecqpJcXTLZKkn25ujeQ3Bg3vpdOfC3LhiZ1tvfgCXTg4xtG', NULL, NULL, NULL, NULL, 0, '2021-05-04 10:09:26', '2021-05-04 10:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `users_otp`
--

CREATE TABLE `users_otp` (
  `id` bigint UNSIGNED NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_otp`
--

INSERT INTO `users_otp` (`id`, `mobile`, `email`, `otp`, `created_at`, `updated_at`) VALUES
(1, '8320008656', NULL, NULL, '2020-10-29 11:04:37', '2020-12-22 06:58:03'),
(2, '8758662075', NULL, NULL, '2020-10-29 11:04:42', '2021-04-09 12:08:03'),
(3, '3434341654', NULL, NULL, '2020-10-29 11:40:02', '2020-10-29 12:39:48'),
(4, '6745453333', NULL, NULL, '2020-10-29 11:40:07', '2020-10-29 13:16:50'),
(5, '9978619860', NULL, NULL, '2020-10-31 09:25:46', '2021-01-09 10:25:33'),
(6, '2323232323', NULL, NULL, '2020-11-02 10:43:51', '2020-11-02 10:43:56'),
(7, '3698096809', NULL, NULL, '2020-11-03 09:42:39', '2020-11-03 09:42:41'),
(8, '4545545454', NULL, NULL, '2020-11-03 12:47:56', '2020-11-03 12:48:04'),
(9, '9887777777', NULL, NULL, '2020-11-03 13:20:20', '2020-11-03 13:20:24'),
(10, '2585285258', NULL, NULL, '2020-11-27 09:37:42', '2020-11-27 09:37:45'),
(11, '8866006401', NULL, NULL, '2020-12-09 15:51:36', '2021-04-27 10:54:24'),
(12, '3636363636', NULL, NULL, '2020-12-23 10:00:25', '2020-12-24 08:25:25'),
(13, '2626262626', NULL, NULL, '2020-12-23 10:10:15', '2020-12-23 10:10:16'),
(14, '2525252525', NULL, NULL, '2020-12-23 12:35:43', '2020-12-23 12:35:48'),
(15, '1231231231', NULL, NULL, '2020-12-23 12:59:06', '2020-12-25 12:50:12'),
(16, '8585858585', NULL, NULL, '2020-12-25 07:31:32', '2020-12-25 07:31:34'),
(17, '8971235696', NULL, NULL, '2020-12-25 13:34:00', '2021-05-04 11:31:34'),
(18, '8971235698', NULL, NULL, '2021-01-27 14:24:17', '2021-01-27 14:24:25'),
(19, '8866171024', NULL, NULL, '2021-02-22 10:56:09', '2021-02-22 11:06:37'),
(20, '9978619861', NULL, NULL, '2021-02-23 09:08:52', '2021-03-01 13:16:15'),
(21, '2536253625', NULL, NULL, '2021-02-23 11:07:12', '2021-02-23 11:07:15'),
(22, '8511671085', NULL, NULL, '2021-02-24 05:44:06', '2021-04-27 09:38:44'),
(23, '9696969696', NULL, NULL, '2021-03-05 06:22:12', '2021-03-05 06:22:14'),
(24, '2580258080', NULL, NULL, '2021-03-08 05:19:18', '2021-03-09 06:18:00'),
(25, '2580258088', NULL, NULL, '2021-03-09 06:18:15', '2021-03-09 06:18:39'),
(26, '1251251250', NULL, NULL, '2021-03-09 09:43:32', '2021-03-09 09:43:33'),
(27, '1234567890', NULL, NULL, '2021-03-09 11:09:58', '2021-03-19 06:10:47'),
(28, '1234567891', NULL, 3789, '2021-03-19 06:13:00', '2021-03-19 06:13:00'),
(29, '9903983567', NULL, NULL, '2021-03-22 07:19:08', '2021-03-22 07:23:12'),
(30, '1472580369', NULL, 7505, '2021-03-30 12:51:00', '2021-03-30 12:51:01'),
(31, '8511851185', NULL, NULL, '2021-03-31 05:24:40', '2021-03-31 05:24:45'),
(32, '3693693690', NULL, NULL, '2021-03-31 05:54:52', '2021-04-01 07:26:31'),
(33, '8971235679', NULL, NULL, '2021-04-21 11:00:32', '2021-04-28 09:53:10'),
(34, NULL, 'prakashtank@gmail.com', 2707, '2021-04-23 11:38:45', '2021-04-23 11:38:45'),
(35, NULL, 'ptank@webtual.com', 6976, '2021-04-23 11:46:33', '2021-05-04 06:11:37'),
(36, NULL, 'ptank1@webtual.com', 2454, '2021-04-23 11:59:28', '2021-05-03 08:45:58'),
(37, NULL, 'ptank2@webtual.com', 1221, '2021-04-24 06:55:19', '2021-04-27 12:37:22'),
(38, '9974937069', NULL, NULL, '2021-04-24 08:14:41', '2021-04-24 08:14:57'),
(39, '9646467639', NULL, NULL, '2021-04-24 09:32:54', '2021-04-24 09:33:00'),
(40, '7018561633', NULL, NULL, '2021-04-24 09:34:13', '2021-04-24 09:34:15'),
(41, '9896677443', NULL, NULL, '2021-04-26 14:42:28', '2021-04-28 12:41:29'),
(42, '9265701475', NULL, NULL, '2021-04-27 07:38:06', '2021-04-27 10:24:51'),
(43, NULL, 'udesai@webtual.com', 6375, '2021-04-27 12:26:31', '2021-05-04 09:13:27'),
(44, NULL, 'umng@webtual.com', 1912, '2021-04-27 13:13:01', '2021-04-27 13:14:16'),
(45, NULL, 'umang@webtual.com', 9972, '2021-04-27 13:14:49', '2021-04-27 13:23:30'),
(46, NULL, 'udesai@webtaul.com', 3404, '2021-04-28 09:44:41', '2021-04-28 09:45:52'),
(47, NULL, 'bmistri@gmail.com', 1135, '2021-04-28 09:52:48', '2021-04-28 09:52:48'),
(48, NULL, 'umangdesai111@gmail.com', NULL, '2021-04-28 09:53:12', '2021-05-04 10:09:26'),
(49, NULL, 'ashah20@webtaul.com', 5627, '2021-04-28 09:54:01', '2021-04-28 09:54:01'),
(50, '9113245228', NULL, NULL, '2021-04-29 11:03:36', '2021-04-29 11:03:38'),
(51, '8951827328', NULL, NULL, '2021-04-29 11:12:38', '2021-04-29 11:12:39'),
(52, '74426699669965', NULL, NULL, '2021-04-29 15:21:13', '2021-04-29 15:21:19'),
(53, '9876543210', NULL, NULL, '2021-04-29 17:35:39', '2021-04-29 17:36:00'),
(54, '9876543211', NULL, NULL, '2021-04-29 18:05:28', '2021-04-29 18:05:34'),
(55, '98765411230', NULL, NULL, '2021-04-29 19:39:54', '2021-04-29 19:40:01'),
(56, '898989898989', NULL, 8416, '2021-04-30 05:55:28', '2021-04-30 05:55:28'),
(57, NULL, 'ptank111@webtual.com', NULL, '2021-05-03 05:11:06', '2021-05-03 05:13:07'),
(58, NULL, 'ptank5@webtual.com', 7006, '2021-05-03 05:16:36', '2021-05-04 06:15:35'),
(59, '8971235694', NULL, NULL, '2021-05-03 14:52:13', '2021-05-03 14:52:19'),
(60, NULL, 'ptank1112@webtual.com', 6602, '2021-05-04 06:12:44', '2021-05-04 06:12:44'),
(61, NULL, 'ywyeh@jsjj.com', 6027, '2021-05-04 10:08:34', '2021-05-04 10:08:34'),
(62, NULL, 'tejusreddy93@gmail.com', 1692, '2021-05-04 12:27:59', '2021-05-04 12:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/user/default.png',
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sharing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_card_active` tinyint DEFAULT NULL,
  `current_lat` decimal(12,9) DEFAULT NULL,
  `current_long` decimal(12,9) DEFAULT NULL,
  `privacy` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_file_status` tinyint(1) DEFAULT NULL,
  `resume_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_link_status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `bio`, `avatar`, `gender`, `is_read`, `is_view`, `is_sharing`, `is_card_active`, `current_lat`, `current_long`, `privacy`, `resume_file`, `resume_file_status`, `resume_link`, `resume_link_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'I have huge experince in laravel development', '/avatars/1_avatar1604086745.jpg', 'male', NULL, NULL, NULL, 1, '23.027160600', '72.508519800', NULL, NULL, NULL, NULL, NULL, '2020-08-18 13:00:00', '2020-10-30 19:39:05', '2020-08-18 13:00:00'),
(103, 152, NULL, '/avatars/152_avatar1603969365.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 11:02:45', '2020-10-29 11:02:45', NULL),
(104, 153, 'I am team leader in webtual technologies. I have high experince flutter developer', '/avatars/153_avatar1604322476.png', NULL, NULL, NULL, NULL, NULL, '21.320811200', '70.438914000', '1', NULL, 1, NULL, 1, '2020-12-22 07:03:21', '2020-12-22 07:03:21', NULL),
(105, 154, 'I am developer', '/avatars/154_avatar1615180230.png', NULL, NULL, NULL, NULL, NULL, '23.092430603', '72.527967394', '0', '/resume/resume1614946207.pdf', 1, 'www.google.com', 1, '2021-03-08 06:21:36', '2021-04-09 12:08:03', NULL),
(106, 155, 'bsbsbsbsbbsbs', '/avatars/155_avatar1603971511.jpeg', NULL, NULL, NULL, NULL, NULL, '21.588909000', '71.225748500', '0', NULL, 1, NULL, 1, '2020-10-29 13:18:39', '2020-10-29 13:18:39', NULL),
(107, 156, 'my name is dhoni', '/avatars/156_avatar1603971559.jpg', NULL, NULL, NULL, NULL, NULL, '23.038997500', '72.531068000', '0', '/resume/resume1603978779.pdf', 1, 'www.nokri.com', 1, '2020-11-02 11:32:48', '2020-11-02 11:32:48', NULL),
(108, 157, NULL, '/avatars/157_avatar1603973474.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:11:14', '2020-10-29 12:11:14', NULL),
(109, 158, NULL, '/avatars/158_avatar1603973805.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:16:45', '2020-10-29 12:16:45', NULL),
(110, 159, NULL, '/avatars/159_avatar1603973895.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:18:15', '2020-10-29 12:18:15', NULL),
(111, 160, NULL, '/avatars/160_avatar1603974625.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 12:30:25', '2020-10-29 12:30:25', NULL),
(112, 161, NULL, '/avatars/161_avatar1603982347.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-29 14:39:07', '2020-10-29 14:39:07', NULL),
(114, 163, NULL, '/avatars/163_avatar1604140620.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-10-31 10:37:00', '2020-10-31 10:37:00', NULL),
(115, 164, NULL, '/avatars/164_avatar1604141880.jpeg', NULL, NULL, NULL, NULL, NULL, '23.092298813', '72.527838535', '0', NULL, NULL, NULL, NULL, '2020-10-31 10:58:00', '2021-03-01 13:16:15', NULL),
(136, 185, 'I am tester', '/avatars/185_avatar1604407922.png', NULL, NULL, NULL, NULL, NULL, '23.038982500', '72.531089800', '0', NULL, NULL, NULL, NULL, '2020-11-03 12:52:02', '2020-11-03 12:52:02', NULL),
(137, 186, NULL, '/avatars/186_avatar1604410246.png', NULL, NULL, NULL, NULL, NULL, '23.038986100', '72.531088000', '0', NULL, 1, NULL, 1, '2020-11-03 13:30:46', '2020-11-03 13:30:46', NULL),
(138, 187, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-23 09:08:52', '2020-11-23 09:08:52', NULL),
(139, 188, 'iPhone bio data user', '/avatars/188_avatar1606469984.png', NULL, NULL, NULL, NULL, NULL, '21.590412347', '71.223949042', '0', NULL, NULL, NULL, NULL, '2020-11-27 09:39:44', '2020-11-27 09:39:44', NULL),
(140, 189, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-27 10:42:39', '2020-11-27 10:42:39', NULL),
(141, 190, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-27 11:17:15', '2020-11-27 11:17:15', NULL),
(142, 191, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-27 11:24:29', '2020-11-27 11:24:29', NULL),
(143, 192, NULL, '/avatars/192_avatar1606734113.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-11-30 11:01:53', '2020-11-30 11:01:53', NULL),
(144, 193, 'this is testing', '/avatars/193_avatar1608813523.png', NULL, NULL, NULL, NULL, 1, '23.033863000', '72.585022000', '1', NULL, 1, NULL, 1, '2021-04-10 06:12:11', '2021-04-27 10:54:24', NULL),
(145, 194, NULL, '/avatars/194_avatar1608716915.jpg', NULL, NULL, NULL, NULL, NULL, '23.027160600', '72.508519800', '0', NULL, NULL, NULL, NULL, '2020-12-23 09:48:35', '2021-03-19 06:10:47', NULL),
(146, 195, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 09:49:41', '2020-12-23 09:49:41', NULL),
(147, 196, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 09:50:32', '2020-12-23 09:50:32', NULL),
(148, 197, 'test user bio data', '/avatars/197_avatar1608717736.png', NULL, NULL, NULL, NULL, NULL, '23.051793400', '72.521052800', '0', '/resume/resume1608718067.doc', 1, NULL, 1, '2020-12-23 10:07:47', '2020-12-24 08:25:25', NULL),
(149, 198, 'I am working in webtual Technologies Pvt Ltd', '/avatars/198_avatar1608724789.png', NULL, NULL, NULL, NULL, NULL, '23.092386400', '72.527924900', '1', NULL, 1, NULL, 1, '2020-12-23 12:03:56', '2020-12-23 12:03:56', NULL),
(150, 199, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:38:25', '2020-12-23 10:38:25', NULL),
(151, 200, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:39:50', '2020-12-23 10:39:50', NULL),
(152, 201, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:40:29', '2020-12-23 10:40:29', NULL),
(153, 202, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:42:03', '2020-12-23 10:42:03', NULL),
(154, 203, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:43:27', '2020-12-23 10:43:27', NULL),
(155, 204, NULL, '/avatars/204_avatar1608720284.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:44:44', '2020-12-23 10:44:44', NULL),
(156, 205, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:44:46', '2020-12-23 10:44:46', NULL),
(157, 206, NULL, '/avatars/206_avatar1608720401.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:46:41', '2020-12-23 10:46:41', NULL),
(158, 207, NULL, '/avatars/207_avatar1608720428.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:47:08', '2020-12-23 10:47:08', NULL),
(159, 208, NULL, '/avatars/208_avatar1608720455.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 10:47:35', '2020-12-23 10:47:35', NULL),
(160, 209, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 11:02:15', '2020-12-23 11:02:15', NULL),
(161, 210, NULL, '/avatars/210_avatar1608726535.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2020-12-23 12:28:55', '2020-12-23 12:28:55', NULL),
(162, 211, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.051782300', '72.521092500', NULL, NULL, NULL, NULL, NULL, '2020-12-23 12:35:48', '2020-12-23 12:35:48', NULL),
(163, 212, 'ssghshshsbs', '/avatars/212_avatar1608728403.png', NULL, NULL, NULL, NULL, NULL, '23.092381200', '72.527930100', '0', NULL, 1, NULL, 1, '2020-12-24 10:27:57', '2020-12-25 12:50:12', NULL),
(164, 213, 'Hi This is Ankit from Webtual Technologies Pvt.Ltd', '/avatars/213_avatar1608815477.png', NULL, NULL, NULL, NULL, NULL, '23.092372400', '72.527972500', '0', NULL, 1, NULL, 1, '2020-12-24 13:12:24', '2021-01-09 10:25:33', NULL),
(165, 214, 'sjsjsjjs', '/avatars/214_avatar1608881540.png', NULL, NULL, NULL, NULL, NULL, '23.092384000', '72.527931100', '0', NULL, NULL, NULL, NULL, '2020-12-25 07:32:20', '2020-12-25 07:32:20', NULL),
(166, 215, NULL, '/avatars/215_avatar1618242888.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 1, NULL, 1, '2021-04-29 11:25:24', '2021-05-04 12:29:29', NULL),
(167, 216, 'hhhjk', '/avatars/216_avatar1611757537.png', NULL, NULL, NULL, NULL, NULL, '-27.602673800', '-48.636657800', '0', NULL, 1, NULL, 1, '2021-01-27 14:26:16', '2021-01-27 14:26:16', NULL),
(168, 217, 'fgffhfhfhfhfj', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '21.593466600', '71.222290600', '0', NULL, NULL, NULL, NULL, '2021-02-23 06:08:14', '2021-02-23 06:08:14', NULL),
(169, 218, 'bchcjfjf', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.051771200', '72.521151800', '0', NULL, NULL, NULL, NULL, '2021-03-01 10:30:16', '2021-03-01 10:30:16', NULL),
(171, 220, NULL, '/avatars/220_avatar1614663926.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2021-03-02 05:45:26', '2021-03-02 05:45:26', NULL),
(172, 221, NULL, '/avatars/221_avatar1614664556.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2021-03-02 05:55:56', '2021-03-02 05:55:56', NULL),
(173, 222, NULL, '/avatars/222_avatar1614664728.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2021-03-02 05:58:48', '2021-03-02 05:58:48', NULL),
(174, 223, NULL, '/avatars/223_avatar1614680106.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2021-03-02 10:15:06', '2021-03-02 10:15:06', NULL),
(175, 224, 'dhhsbdhdbs', '/avatars/224_avatar1614925401.png', NULL, NULL, NULL, NULL, NULL, '23.092401200', '72.527936400', '0', NULL, NULL, NULL, NULL, '2021-03-05 06:23:21', '2021-03-05 06:23:21', NULL),
(176, 225, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.092410100', '72.527942200', NULL, NULL, NULL, NULL, NULL, '2021-03-08 05:19:22', '2021-03-09 06:18:00', NULL),
(178, 227, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.092401700', '72.527921200', NULL, NULL, NULL, NULL, NULL, '2021-03-09 09:43:33', '2021-03-09 09:43:33', NULL),
(179, 228, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '/avatars/228_avatar1616398969.png', NULL, NULL, NULL, NULL, NULL, '21.530711300', '70.367568700', '1', NULL, 1, 'www.test.com', 1, '2021-03-22 07:42:49', '2021-03-22 07:42:49', NULL),
(180, 229, 'Baja Abbas', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.092409473', '72.527897029', '0', NULL, NULL, NULL, NULL, '2021-03-31 06:34:31', '2021-03-31 06:34:31', NULL),
(181, 230, 'bjvvmv mm', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.033863000', '72.585022000', '0', NULL, NULL, NULL, NULL, '2021-03-31 06:39:46', '2021-04-01 07:26:31', NULL),
(182, 231, 'Fostr Healthcare - Managing Director', '/avatars/231_avatar1619604135.png', NULL, NULL, NULL, NULL, NULL, '12.937543325', '77.709548220', '0', NULL, 0, NULL, 0, '2021-04-28 10:02:15', '2021-04-28 10:02:15', NULL),
(183, 232, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-23 11:49:47', '2021-04-23 11:49:47', NULL),
(184, 233, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-23 11:59:47', '2021-04-23 11:59:47', NULL),
(185, 234, 'Testing application to see the flow of the app', '/avatars/234_avatar1619252240.png', NULL, NULL, NULL, NULL, NULL, '23.031948000', '72.538414100', '0', NULL, NULL, NULL, NULL, '2021-04-24 08:17:20', '2021-04-24 08:17:20', NULL),
(186, 235, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '31.816154000', '76.472395000', NULL, NULL, NULL, NULL, NULL, '2021-04-24 09:33:00', '2021-04-24 09:33:00', NULL),
(187, 236, 'Not yet', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '31.816154000', '76.472395000', '0', NULL, NULL, NULL, NULL, '2021-04-24 09:34:47', '2021-04-24 09:34:47', NULL),
(188, 237, 'Nothing', '/avatars/237_avatar1619448424.png', NULL, NULL, NULL, NULL, NULL, '0.000000000', '0.000000000', '0', NULL, NULL, NULL, NULL, '2021-04-26 14:47:04', '2021-04-28 12:41:29', NULL),
(189, 238, 'Hdhddudydydydududuuddhdeherhrhrhrhrjrjrjrjrjjrrjrjhrrhrhrhrhrhrhjrjrjrjrrjjrhrhrhrrhrhjrrjrjrjrnrjrjrijrjrrjjrrjrjrnrnjrirrirjjrrjjrjrrjjrrjrnbrbrbrbrbrbrbrbrbrbrbrbhrhrhrhrhrhrhrjjrhrrjrhhrhrrhhrhrrjrhjrjrjrrjrjjrjrjjrrjrjjrjrjrjrjrjrjjrjrjrjrjrj4j4j4b4b4b4nnrb4b4b44bb4b4h4h4h4r', '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.005150600', '72.633985000', '0', NULL, NULL, NULL, NULL, '2021-04-27 08:07:24', '2021-04-27 10:24:51', NULL),
(190, 239, NULL, '/avatars/239_avatar1619694322.png', NULL, NULL, NULL, NULL, NULL, '12.937512304', '77.709723041', '0', NULL, NULL, NULL, NULL, '2021-04-29 11:05:22', '2021-04-29 11:05:22', NULL),
(191, 240, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '12.937512304', '77.709723041', '0', NULL, NULL, NULL, NULL, '2021-04-29 11:14:17', '2021-04-29 11:14:17', NULL),
(192, 241, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '31.281982900', '76.433897000', NULL, NULL, NULL, NULL, NULL, '2021-04-29 15:21:19', '2021-04-29 15:21:19', NULL),
(193, 242, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '0.000000000', '0.000000000', NULL, NULL, NULL, NULL, NULL, '2021-04-29 17:36:00', '2021-04-29 17:36:00', NULL),
(194, 243, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '0.000000000', '0.000000000', NULL, NULL, NULL, NULL, NULL, '2021-04-29 18:05:34', '2021-04-29 18:05:34', NULL),
(195, 244, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '0.000000000', '0.000000000', NULL, NULL, NULL, NULL, NULL, '2021-04-29 19:40:01', '2021-04-29 19:40:01', NULL),
(196, 245, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, '23.330000000', '72.050000000', NULL, NULL, NULL, NULL, NULL, '2021-05-03 05:13:07', '2021-05-03 05:13:07', NULL),
(197, 246, 'Baja did d djbdjd dkd kendo’s', '/avatars/246_avatar1620022624.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, 0, '2021-05-03 06:17:04', '2021-05-03 06:37:28', NULL),
(198, 247, NULL, '/avatars/247_avatar1620053703.png', NULL, NULL, NULL, NULL, NULL, '12.937513223', '77.709742109', '0', NULL, 0, NULL, 0, '2021-05-03 14:57:06', '2021-05-03 14:57:06', NULL),
(199, 248, 'This account is created with registration with email password', '/avatars/248_avatar1620118957.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '2021-05-04 09:02:37', '2021-05-04 09:05:32', NULL),
(200, 249, NULL, '/user/default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-04 10:09:26', '2021-05-04 10:09:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `contact_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`id`, `user_id`, `contact_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 156, 155, '2020-10-29 12:43:38', '2020-10-29 12:43:38', NULL),
(5, 155, 156, '2020-10-29 12:43:46', '2020-10-29 12:43:46', NULL),
(8, 164, 154, '2020-10-31 11:04:26', '2020-10-31 11:04:26', NULL),
(9, 154, 155, '2020-12-17 12:25:08', '2020-12-17 12:25:08', NULL),
(10, 154, 156, '2020-12-17 12:25:16', '2020-12-17 12:25:16', NULL),
(12, 153, 1, '2020-12-22 06:58:31', '2020-12-22 06:58:31', NULL),
(15, 197, 155, '2020-12-23 10:03:52', '2020-12-23 10:03:52', NULL),
(16, 197, 185, '2020-12-23 10:04:00', '2020-12-23 10:04:00', NULL),
(17, 214, 164, '2020-12-25 09:13:13', '2020-12-25 09:13:13', NULL),
(18, 193, 164, '2020-12-25 09:34:32', '2020-12-25 09:34:32', NULL),
(19, 193, 155, '2021-01-18 10:35:01', '2021-01-18 10:35:01', NULL),
(20, 193, 156, '2021-01-18 10:35:17', '2021-01-18 10:35:17', NULL),
(32, 154, 185, '2021-03-02 09:22:07', '2021-03-02 09:22:07', NULL),
(33, 154, 219, '2021-03-02 09:58:43', '2021-03-02 09:58:43', NULL),
(37, 193, 219, '2021-04-02 05:19:26', '2021-04-02 05:19:26', NULL),
(39, 193, 213, '2021-04-10 13:12:43', '2021-04-10 13:12:43', NULL),
(40, 193, 194, '2021-04-10 13:13:46', '2021-04-10 13:13:46', NULL),
(41, 234, 197, '2021-04-24 08:18:05', '2021-04-24 08:18:05', NULL),
(42, 236, 235, '2021-04-24 09:36:18', '2021-04-24 09:36:18', NULL),
(61, 238, 234, '2021-04-27 10:25:31', '2021-04-27 10:25:31', NULL),
(62, 239, 215, '2021-04-29 11:10:44', '2021-04-29 11:10:44', NULL),
(63, 215, 231, '2021-04-29 11:24:11', '2021-04-29 11:24:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_items`
--
ALTER TABLE `card_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporate_request`
--
ALTER TABLE `corporate_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `social_network`
--
ALTER TABLE `social_network`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_network_user_id_foreign` (`user_id`);

--
-- Indexes for table `temp_social_network`
--
ALTER TABLE `temp_social_network`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_network_user_id_foreign` (`user_id`);

--
-- Indexes for table `temp_users_profile`
--
ALTER TABLE `temp_users_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_profile_user_id_foreign` (`user_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_otp`
--
ALTER TABLE `users_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_profile_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_contact_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_items`
--
ALTER TABLE `card_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `corporate_request`
--
ALTER TABLE `corporate_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `social_network`
--
ALTER TABLE `social_network`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;

--
-- AUTO_INCREMENT for table `temp_social_network`
--
ALTER TABLE `temp_social_network`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1612;

--
-- AUTO_INCREMENT for table `temp_users_profile`
--
ALTER TABLE `temp_users_profile`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `users_otp`
--
ALTER TABLE `users_otp`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `social_network`
--
ALTER TABLE `social_network`
  ADD CONSTRAINT `social_network_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD CONSTRAINT `users_profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD CONSTRAINT `user_contact_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
