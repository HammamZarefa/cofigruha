-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 09:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `package`
--

-- --------------------------------------------------------

--
-- Table structure for table `dep_address_mapping`
--

CREATE TABLE `dep_address_mapping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `city_code` varchar(255) DEFAULT NULL,
  `area_code` varchar(255) DEFAULT NULL,
  `dep_company_id` int(11) NOT NULL,
  `dep_country_code` varchar(255) NOT NULL,
  `dep_city_code` varchar(255) DEFAULT NULL,
  `dep_area_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dep_address_mapping`
--

INSERT INTO `dep_address_mapping` (`id`, `country_code`, `city_code`, `area_code`, `dep_company_id`, `dep_country_code`, `dep_city_code`, `dep_area_code`) VALUES
(7, 'KW', NULL, NULL, 7, 'KWT', 'Mubarak Al-Jabir', NULL),
(15, 'KW', NULL, NULL, 7, 'KWT', 'Sabhan Industrial', NULL),
(22, 'KW', NULL, NULL, 7, 'KWT', 'Rai', NULL),
(34, 'KW', NULL, NULL, 7, 'KWT', 'Qurtubah', NULL),
(44, 'KW', NULL, NULL, 7, 'KWT', 'Al Dajeej', NULL),
(46, 'KW', NULL, NULL, 7, 'KWT', 'Abdullah Port', NULL),
(55, 'KW', NULL, NULL, 7, 'KWT', 'Qibla', NULL),
(62, 'KW', NULL, NULL, 7, 'KWT', 'Jahra Industrial Area', NULL),
(63, 'KW', NULL, NULL, 7, 'KWT', 'Amghara Industrial', NULL),
(64, 'KW', NULL, NULL, 7, 'KWT', 'Sulaibiya Industrial 2', NULL),
(70, 'KW', NULL, NULL, 7, 'KWT', 'Sulaibiya Industrial 1', NULL),
(71, 'KW', NULL, NULL, 7, 'KWT', 'Shuaiba Industrial E&W', NULL),
(73, 'KW', NULL, NULL, 7, 'KWT', 'Dhaher', NULL),
(84, 'KW', NULL, NULL, 7, 'KWT', 'Sulaibiya Industrial 3', NULL),
(90, 'KW', NULL, NULL, 7, 'KWT', 'Ardiya Herafiya', NULL),
(98, 'KW', NULL, NULL, 7, 'KWT', 'Al-Shadadiya', NULL),
(115, 'KW', NULL, NULL, 7, 'KWT', 'Al-Zoor', NULL),
(117, 'KW', NULL, NULL, 7, 'KWT', 'West Abdullah Al-Mubarak', NULL),
(119, 'KW', NULL, NULL, 7, 'KWT', 'Ghornata', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dep_address_mapping`
--
ALTER TABLE `dep_address_mapping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dep_address_mapping`
--
ALTER TABLE `dep_address_mapping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
