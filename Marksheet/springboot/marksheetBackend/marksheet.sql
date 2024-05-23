-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2024 at 08:24 PM
-- Server version: 8.0.36
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marksheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(30) NOT NULL,
  `rollNo` int NOT NULL,
  `m_cc` int NOT NULL,
  `m_wt` int NOT NULL,
  `m_daa` int NOT NULL,
  `m_sdam` int NOT NULL,
  `e_cc` int NOT NULL,
  `e_wt` int NOT NULL,
  `e_daa` int NOT NULL,
  `e_sdam` int NOT NULL,
  `percentage` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `rollNo`, `m_cc`, `m_wt`, `m_daa`, `m_sdam`, `e_cc`, `e_wt`, `e_daa`, `e_sdam`, `percentage`) VALUES
('Swapnil Pawar', 1, 55, 55, 55, 55, 55, 55, 55, 55, 55),
('Swapnil10', 2, 77, 77, 88, 88, 77, 75, 88, 88, 82.15),
('Swapnil', 3, 99, 98, 98, 98, 99, 98, 98, 98, 98.25),
('Swapnil10', 4, 88, 88, 88, 88, 88, 88, 88, 88, 88),
('Swapnil', 5, 88, 89, 88, 88, 88, 89, 88, 88, 88.25),
('Swapnil Pawar', 6, 75, 75, 75, 75, 75, 75, 89, 75, 77.45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`rollNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
