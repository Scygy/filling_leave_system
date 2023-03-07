-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 11:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `full_name`, `role`) VALUES
(1, 'admin', 'admin', 'admin1', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL,
  `id_no` varchar(150) NOT NULL,
  `full_name` varchar(225) NOT NULL,
  `department` varchar(200) NOT NULL,
  `date_hired` varchar(100) NOT NULL,
  `remaining_leave` varchar(150) NOT NULL DEFAULT '24',
  `status` varchar(255) NOT NULL DEFAULT 'Not on Leave'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `id_no`, `full_name`, `department`, `date_hired`, `remaining_leave`, `status`) VALUES
(1, '111', 'John Doe', 'IT', '2022-03-16', '22', 'On Leave(Whole)'),
(2, '222', 'Jane Doe', 'Accounting', '2022-04-16', '16', 'Not on Leave');

-- --------------------------------------------------------

--
-- Table structure for table `leave_table`
--

CREATE TABLE `leave_table` (
  `id` int(20) NOT NULL,
  `id_no` varbinary(150) DEFAULT NULL,
  `full_name` varbinary(255) DEFAULT NULL,
  `datefrom` varbinary(100) DEFAULT NULL,
  `dateto` varbinary(100) DEFAULT NULL,
  `reason` varbinary(255) DEFAULT NULL,
  `leave_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_table`
--

INSERT INTO `leave_table` (`id`, `id_no`, `full_name`, `datefrom`, `dateto`, `reason`, `leave_type`) VALUES
(1, 0x313131, 0x4a6f686e20446f65, 0x323032332d30332d3036, 0x323032332d30332d3133, 0x617364736164, 'Whole Day'),
(5, 0x323232, 0x4a616e6520446f65, 0x323032332d30332d30382031343a3137, 0x6e2f61, 0x617364617364617364, 'Half Day');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_table`
--
ALTER TABLE `leave_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_table`
--
ALTER TABLE `leave_table`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
