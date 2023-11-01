-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2023 at 06:46 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21372879_voteaiddatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `Questionnaire`
--

CREATE TABLE `Questionnaire` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `ElectionId` bigint(20) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `Questions` varchar(8000) NOT NULL,
  `State` varchar(10) NOT NULL,
  `ZipCodes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Questionnaire`
--
ALTER TABLE `Questionnaire`
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `state_idx` (`State`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Questionnaire`
--
ALTER TABLE `Questionnaire`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
