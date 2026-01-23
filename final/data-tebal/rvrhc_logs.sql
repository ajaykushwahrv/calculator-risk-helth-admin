-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2025 at 06:56 PM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaimaass_databs`
--

-- --------------------------------------------------------

--
-- Table structure for table `rvrhc_logs`
--

CREATE TABLE `rvrhc_logs` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `score` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `created_at` date NOT NULL,
  `form_lead_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rvrhc_logs`
--

INSERT INTO `rvrhc_logs` (`id`, `email`, `score`, `ip`, `created_at`, `form_lead_name`) VALUES
(87, 'test@gmail.com', '3', '103.21.53.114', '2025-12-08', 'Health'),
(88, 'test@gmail.com', '23', '103.21.53.114', '2025-12-08', 'Risk'),
(89, 'test@gmail.com', '', '103.21.53.114', '2025-12-08', 'Contact');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rvrhc_logs`
--
ALTER TABLE `rvrhc_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rvrhc_logs`
--
ALTER TABLE `rvrhc_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
