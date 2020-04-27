-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2019 at 05:51 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `blood_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `units` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WBC` int(11) DEFAULT NULL,
  `RBC` int(11) DEFAULT NULL,
  `platelet` int(11) DEFAULT NULL,
  `plasma` int(11) DEFAULT NULL,
  `date_donated` date NOT NULL,
  `exp_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `request` tinyint(1) NOT NULL DEFAULT '0',
  `expired` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`id`, `blood_num`, `blood_group`, `units`, `WBC`, `RBC`, `platelet`, `plasma`, `date_donated`, `exp_date`, `user_id`, `request`, `expired`, `created_at`, `updated_at`) VALUES
(1, 'BLD_GRP_001', 'A-', '40', 10, 10, 10, 10, '2019-02-02', '2019-03-16', 2, 1, 0, '2019-02-16 15:32:49', '2019-02-25 13:22:47'),
(2, 'BLD_GRP_002', 'A+', '40', 10, 10, 10, 10, '2019-02-10', '2019-03-24', 2, 1, 0, '2019-02-16 15:34:14', '2019-02-25 13:24:03'),
(3, 'BLD_GRP_003', 'B', '40', 10, 10, 10, 10, '2019-02-01', '2019-03-15', 2, 1, 0, '2019-02-16 15:35:12', '2019-02-25 13:19:30'),
(4, 'BLD_GRP_004', 'AB', '40', 10, 10, 10, 10, '2019-02-14', '2019-03-28', 2, 0, 0, '2019-02-16 15:35:34', '2019-02-20 14:22:49'),
(5, 'BLD_GRP_005', 'O', '40', 10, 10, 10, 10, '2019-02-15', '2019-03-29', 2, 1, 0, '2019-02-16 15:35:53', '2019-02-18 17:06:59'),
(6, 'BLD_GRP_006', 'A-', '40', 10, 10, 10, 10, '2019-02-15', '2019-03-29', 3, 1, 0, '2019-02-16 15:36:58', '2019-02-18 14:11:47'),
(7, 'BLD_GRP_007', 'A+', '40', 10, 10, 10, 10, '2019-02-15', '2019-03-29', 3, 1, 0, '2019-02-16 15:37:11', '2019-02-16 15:37:11'),
(8, 'BLD_GRP_008', 'AB', '40', 10, 10, 10, 10, '2019-02-10', '2019-03-24', 3, 0, 0, '2019-02-16 15:37:26', '2019-02-16 15:37:26'),
(9, 'BLD_GRP_009', 'B+', '40', 10, 10, 10, 10, '2019-02-02', '2019-03-16', 3, 0, 0, '2019-02-16 15:37:43', '2019-02-16 15:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_request_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_respond_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_required` date NOT NULL,
  `date_respond` datetime DEFAULT NULL,
  `user_request_notes` text COLLATE utf8_unicode_ci,
  `user_respond_notes` text COLLATE utf8_unicode_ci,
  `user_request_cancel_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `user_request_id`, `user_respond_id`, `blood_num`, `blood_group`, `status`, `date_required`, `date_respond`, `user_request_notes`, `user_respond_notes`, `user_request_cancel_notes`, `created_at`, `updated_at`) VALUES
(1, '2', '3', 'BLD_GRP_009', 'B+', 3, '2019-02-18', NULL, 'rere', NULL, 'wewrw', '2019-02-17 10:06:08', '2019-02-18 16:19:06'),
(2, '2', '3', 'BLD_GRP_009', 'B+', 3, '2019-02-18', NULL, 'rere', NULL, 'weewew', '2019-02-17 10:08:54', '2019-02-18 16:19:24'),
(3, '2', '3', 'BLD_GRP_009', 'B+', 1, '2019-02-18', NULL, 'rere', 'kamia', NULL, '2019-02-17 10:09:06', '2019-02-25 13:28:07'),
(4, '2', '3', 'BLD_GRP_007', 'A+', 0, '2019-02-07', NULL, 'trtrtrt', NULL, NULL, '2019-02-17 10:19:58', '2019-02-17 10:19:58'),
(5, '2', '3', 'BLD_GRP_008', 'AB', 3, '2019-02-22', NULL, 'lololo', NULL, 'swews', '2019-02-17 14:16:13', '2019-02-17 17:16:50'),
(6, '3', '2', 'BLD_GRP_003', 'B', 3, '2019-02-20', NULL, 'ertere', NULL, 'lolpo', '2019-02-18 02:49:08', '2019-02-18 16:23:06'),
(7, '3', '2', 'BLD_GRP_002', 'A+', 3, '2019-02-21', NULL, '', NULL, 'sdfghk', '2019-02-18 02:49:41', '2019-02-18 16:23:27'),
(8, '3', '2', 'BLD_GRP_004', 'AB', 3, '2019-02-13', NULL, 'asdrtyu', NULL, 'sdfghjkl', '2019-02-18 02:50:02', '2019-02-18 16:23:41'),
(9, '2', '3', 'BLD_GRP_006', 'A-', 0, '2019-02-20', NULL, 'dere', NULL, NULL, '2019-02-18 14:11:47', '2019-02-18 14:11:47'),
(10, '3', '2', 'BLD_GRP_003', 'B', 3, '2019-02-20', NULL, 'lopaoaua', NULL, 'hhhh', '2019-02-18 16:27:43', '2019-02-18 17:01:42'),
(11, '3', '2', 'BLD_GRP_002', 'A+', 1, '2019-02-21', NULL, 'lopaoiiaoa', 'kamia', NULL, '2019-02-18 16:28:24', '2019-02-21 16:44:43'),
(12, '3', '2', 'BLD_GRP_005', 'O', 1, '2019-02-25', NULL, 'weweweweweweewwewe', 'kam', NULL, '2019-02-18 17:06:59', '2019-02-21 16:49:20'),
(13, '3', '2', 'BLD_GRP_003', 'B', 2, '2019-02-20', NULL, 'eeeeeeee', 'hhhhhhhhhh', NULL, '2019-02-18 17:57:27', '2019-02-21 17:24:00'),
(14, '3', '2', 'BLD_GRP_004', 'AB', 3, '2019-02-21', NULL, 'rrrrrrrrrr', NULL, 'loljhbj', '2019-02-19 03:56:59', '2019-02-20 14:22:49'),
(15, '3', '2', 'BLD_GRP_004', 'AB', 0, '2019-02-21', NULL, 'rrrrrrrrrr', NULL, NULL, '2019-02-19 03:57:29', '2019-02-19 03:57:29'),
(16, '3', '2', 'BLD_GRP_003', 'B', 0, '2019-02-27', NULL, 'naitaka soon', NULL, NULL, '2019-02-25 13:19:29', '2019-02-25 13:19:29'),
(17, '3', '2', 'BLD_GRP_001', 'A-', 0, '2019-02-28', NULL, 'yes', NULL, NULL, '2019-02-25 13:22:03', '2019-02-25 13:22:03'),
(18, '3', '2', 'BLD_GRP_001', 'A-', 0, '2019-02-28', NULL, 'yes', NULL, NULL, '2019-02-25 13:22:47', '2019-02-25 13:22:47'),
(19, '3', '2', 'BLD_GRP_002', 'A+', 0, '2019-02-28', NULL, 'leo', NULL, NULL, '2019-02-25 13:24:03', '2019-02-25 13:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `blood_types`
--

CREATE TABLE `blood_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_types`
--

INSERT INTO `blood_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A-', '2019-02-16 15:17:06', '2019-02-16 15:17:06'),
(2, 'B', '2019-02-16 15:17:28', '2019-02-16 15:17:28'),
(3, 'B+', '2019-02-16 15:17:48', '2019-02-16 15:17:48'),
(4, 'A+', '2019-02-16 15:18:00', '2019-02-16 15:18:00'),
(5, 'O', '2019-02-16 15:18:11', '2019-02-16 15:18:11'),
(6, 'O+', '2019-02-16 15:18:20', '2019-02-16 15:18:20'),
(7, 'O-', '2019-02-16 15:18:29', '2019-02-16 15:18:29'),
(8, 'AB', '2019-02-16 15:18:40', '2019-02-16 15:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE `counties` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_02_12_221722_create_counties_table', 2),
(12, '2019_02_13_185733_create_blood_group_table', 3),
(13, '2019_02_13_185733_create_blood_types_table', 3),
(18, '2019_02_16_184356_create_blood_requests_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `code`, `tel`, `level`, `address`, `password`, `type`, `role`, `location`, `county`, `sub_county`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dickie', NULL, 'dickrir@gmail.com', NULL, NULL, NULL, '', '$2y$10$SHw19PcEY1XK8nfsS4bimeA0sIADYOkEOeRHHlSV2RqwQ8wX0HNYy', 'public', '1', NULL, NULL, NULL, '7WGQcpq44bYfe6icCbpnaUqCBFRnRTTJ5DXgELXyUqU7gKxtsH6U2rdXznyJ', '2019-02-12 14:58:50', '2019-02-16 15:25:31'),
(2, 'Njoro Hospital', 'njoro_hosi', 'njoro@gmail.com', '123456', '+254707691430', '5', '522 Njoro', '$2y$10$T36RBLDs8Xlyo9NmhNQv7.q6g115hnGDhtc0DaQQKUQePqfxibmG2', 'public', '0', 'Mtaro', '36', 'Kenya', 'bE0qYQIc9LdR6oCHqeupVBMrUf2lxP0nSujRDFzabIQxByw2otXTNMkxjfxX', '2019-02-12 16:11:11', '2019-02-25 13:13:22'),
(3, 'PGH NAKURU', 'pgh_naks', 'pghnakuru@gmail.com', '0000', '+254790627125', '3', '522 Njoro', '$2y$10$HBXJBWvAkI6.gcEC4AKOUeagPEYIPX2/Ei6pigBL0OtuO90uk9f9q', 'private', '0', 'Nakuru', '32', 'Nakuru', 'uYLXJ2hntPL0JD8WopyAaEoLw20KJm57Ipq1n5TDPKstajCBZpW0p1BdM4wP', '2019-02-14 12:01:50', '2019-02-25 13:25:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blood_groups_blood_num_unique` (`blood_num`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blood_types_name_unique` (`name`);

--
-- Indexes for table `counties`
--
ALTER TABLE `counties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `counties_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `blood_types`
--
ALTER TABLE `blood_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `counties`
--
ALTER TABLE `counties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
