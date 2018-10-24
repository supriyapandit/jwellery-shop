-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2018 at 06:57 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mant`
--

-- --------------------------------------------------------

--
-- Table structure for table `jewels`
--

CREATE TABLE IF NOT EXISTS `jewels` (
  `id` int(11) NOT NULL,
  `item_name` varchar(200) DEFAULT NULL,
  `item_description` text,
  `price` varchar(250) DEFAULT NULL,
  `size` varchar(250) DEFAULT NULL,
  `weight` varchar(250) DEFAULT NULL,
  `width` varchar(250) DEFAULT NULL,
  `instructions` text,
  `other` text,
  `status` varchar(250) DEFAULT NULL,
  `image_path` varchar(250) DEFAULT NULL,
  `alternate_image1` varchar(250) DEFAULT NULL,
  `alternate_image2` varchar(250) DEFAULT NULL,
  `folder_name` varchar(200) DEFAULT NULL,
  `jewel_type` varchar(100) DEFAULT NULL,
  `unique_id` varchar(200) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jewels`
--

INSERT INTO `jewels` (`id`, `item_name`, `item_description`, `price`, `size`, `weight`, `width`, `instructions`, `other`, `status`, `image_path`, `alternate_image1`, `alternate_image2`, `folder_name`, `jewel_type`, `unique_id`) VALUES
(14, 'mant', 'abc', '12121', '12', '12', '12', 'abc', 'abc', NULL, '83a100ec3c2c30751156cea2d60aacbe.jpg-5cdf0f9533d6b4c0984fc5ae00913459.jpg-', NULL, NULL, 'Bangles', 'Gold', '94');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `mobile`, `username`, `email`, `password`, `created_at`, `updated_at`, `role`, `status`) VALUES
(1, 'supriya Pandit', '888888888', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 'admin', 1),
(7, 'mahantesh', '8888888888', 'admina', 'xxx@cc.com', 'e10adc3949ba59abbe56e057f20f883e', '2018-04-04 10:19:19', '2018-04-04 10:19:19', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jewels`
--
ALTER TABLE `jewels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jewels`
--
ALTER TABLE `jewels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
