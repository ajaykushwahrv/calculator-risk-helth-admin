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
-- Table structure for table `rvrhc_leads`
--

CREATE TABLE `rvrhc_leads` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `form_lead_name` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rvrhc_leads`
--

INSERT INTO `rvrhc_leads` (`id`, `username`, `mobile`, `email`, `services`, `message`, `form_lead_name`, `created_at`) VALUES
(96, 'test', '9876543210', 'test@gmail.com', 'New Health Insurance Inquiry Received from Website', 'a dasdasd asdasdasdad', 'Health', '2025-12-08'),
(97, 'test', '9876543210', 'test@gmail.com', 'New Risk Profile Inquiry Received from Website', 'zas dasdasdasasd a asd asdas', 'Risk', '2025-12-08'),
(98, 'test', '9876543210', 'test@gmail.com', 'Tax Services', 'xcv x sdfasf df', 'Contact', '2025-12-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rvrhc_leads`
--
ALTER TABLE `rvrhc_leads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rvrhc_leads`
--
ALTER TABLE `rvrhc_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
