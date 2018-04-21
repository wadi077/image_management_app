-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2018 at 06:14 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syarahdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1524231197),
('m180420_133026_create_user_table', 1524231203);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `type` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'moderator', 'OFWWja3rby9no1rRra9bVIW88fT60dLn', '$2y$13$jhLNYgJyd3srbHyH7Mh9JuHLry0c9csiudewEjJbjVBcxbrdCUMNG', NULL, 'moderator@yahoo.com', 10, 0, 1524234666, 1524234666),
(2, 'uploader', 'o3ehUz3dEdzVtssLltuZQ4QGvMCY3Pos', '$2y$13$aaAD5y8MlfKidnSFR.aHN.Qfh0CaM9woIVMIRZXRC3sLkwc9w9uZK', NULL, 'wadi077@yahoo.com', 10, 1, 1524239411, 1524239411),
(3, 'mod', 'eYdZbHS58PM1pwC6iHoAhn_EfGP_pDJl', '$2y$13$F2qFZOcUmVyyA4HyQd0HbOsQl7NneoxQtpu.u8rlc0lD/kMNxzi8.', NULL, 'digital_admin@yahoo.com', 10, 0, 1524239472, 1524239472),
(4, 'uploader2', 'UvUWAyQrDM42adtV1KnmGbl9L9oon15O', '$2y$13$Y6R/qtD7Tjl/b/5W7RZSD.OmvnVivs/JIbILExvnJRohuuB572Rzq', NULL, 'wadi078@yahoo.com', 10, 1, 1524264144, 1524264144),
(5, 'uploader3', 'empc9LWStXUniZdxx_LhI2RRyy1S7qyC', '$2y$13$AfSPFoRRZR5zPmAw14X/ved6moDkl7Kwbm4s0b/wmbo4JiCfjWEQ6', NULL, 'wadi079@yahoo.com', 10, 1, 1524323266, 1524323266);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
