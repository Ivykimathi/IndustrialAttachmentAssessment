-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 11:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `industriala`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `ID` int(5) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `reg` varchar(50) NOT NULL,
  `lecturer` varchar(50) NOT NULL,
  `lec_marks` int(6) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `sup_marks` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`ID`, `student_name`, `reg`, `lecturer`, `lec_marks`, `supervisor`, `sup_marks`) VALUES
(1, 'ivy kajuju', 'eb3/49017/20', 'lyn', 15, 'qwern', 67),
(2, 'jane', 'eb3/45567/20', 'lyn', 13, 'qwern', 67),
(3, 'tom', 'Eb3/46789/2', 'lyn', 12, 'qwern', 78),
(12, 'mary', '0726-555560', 'lyn', 16, 'qwern', 61),
(13, 'asd', 'eb3/97876/22', 'mary', 15, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `industrysupreg`
--

CREATE TABLE `industrysupreg` (
  `ID` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `password` varchar(70) NOT NULL,
  `created-at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `industrysupreg`
--

INSERT INTO `industrysupreg` (`ID`, `username`, `phone`, `password`, `created-at`) VALUES
(1, 'kinya', 34567, '$2y$10$tArcvjdBeOQ/LOLkNklEh.N95FnaJrD9upztYrvnAH8', '2024-01-17 21:10:12.957440'),
(2, 'ivy', 726508594, '$2y$10$gfZo1n9T01ZCx1cE7C6qrOVavH4w1wxby8cTNKn9xG7', '2024-01-19 12:13:11.285867'),
(3, 'ivy', 726508594, '$2y$10$FDVKwEUY3iQmrOy1MxbLReLgEJxW5fSYZFuctZUHtXv', '2024-01-19 12:16:26.134442'),
(4, 'qwe', 34567, '$2y$10$FkJ20fI5Fag.cVol3brgLu.Bfcw7u2SlLBA9eFNyfo7', '2024-01-19 12:17:53.208018'),
(5, 'qwern', 34567, '$2y$10$xzv3VMyE9Uaq1WsKa7XM/uarMkZNpcPHY0pdVRlQo0LGeD0lE7nyS', '2024-01-19 12:19:31.236489');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_reg`
--

CREATE TABLE `lecturer_reg` (
  `ID` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `password` varchar(70) NOT NULL,
  `created-at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `location_assigned` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_reg`
--

INSERT INTO `lecturer_reg` (`ID`, `username`, `phone`, `password`, `created-at`, `location_assigned`) VALUES
(1, 'ivy', 726508594, '0', '2024-01-18 21:55:32.444779', 'meru'),
(2, 'kajuju', 726508594, '0', '2024-01-18 21:58:01.197670', 'chuka'),
(3, 'kim', 34567, '$2y$10$NcZE5JrG/UZtmTSaZJcd2.2w1yYWDkEegql.MDgfVu4', '2024-01-18 22:13:05.973366', 'chuka'),
(4, 'susan', 726508594, '$2y$10$7uRML3WLbsKmv19Gs1SlXuZ7FE8wug07KV21xeD2.v.', '2024-01-18 22:18:50.902794', ''),
(5, 'qwern', 34567, '$2y$10$qonWraZGJRnRvyYJQ8w1YuuQlR3pdaMKuMeSRFvWblM', '2024-01-18 22:26:53.149038', ''),
(6, 'lyn', 726508594, '$2y$10$YfujeBFOY.fuUHI4vnIBuO5oItaK6lE5.snLwhDpQWlPfH6Di2w0m', '2024-01-19 11:08:35.143919', ''),
(7, 'mary', 2147483647, '$2y$10$B7sDxJ5DSj1rZcgAt3xHm.QaZ7IyLaztbr8.OsCFdKR7IwL/r9vV6', '2024-02-16 13:28:19.265145', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `ID` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `reg_number` varchar(50) NOT NULL,
  `firm_name` varchar(50) NOT NULL,
  `location` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`ID`, `username`, `reg_number`, `firm_name`, `location`) VALUES
(1, 'mary', '0726-555560', 'chuka hospital', 'chuka'),
(2, 'jane', 'eb3/9876/29', 'laptopCare ltd', 'westlands'),
(3, 'asd', 'eb3/97876/22', 'chuka hospital', 'chuka'),
(4, 'tom', 'Eb3/46789/20', 'kra', 'meru');

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `ID` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `reg` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `created_at` datetime(5) NOT NULL DEFAULT current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`ID`, `username`, `reg`, `password`, `created_at`) VALUES
(1, 'ivy', '', '$2y$10$TZmA43cauZw82ZQHDK0Qlu0e0zcz04HDHlAKFz3UPoJ', '2024-01-17 21:02:50.14129'),
(2, 'kinya', '', '$2y$10$24q2DrVk1GJQqMYIaT4FU.Ms6uffga00SwHY/E9OXoA', '2024-01-17 21:03:18.63005'),
(3, 'kimani', '', '$2y$10$6DxqHQyKmMjP9fEkgjQ5leYypHmxtiFlmCm1rKDry0a', '2024-01-18 21:50:43.65614'),
(4, 'quenn', 'eb3/9876/22', '$2y$10$drKTZCsImwaxL/8h5yIQ0e8ood19kswKMHmAvlqpNc1', '2024-01-18 21:53:31.93287'),
(5, 'elsy', 'eb3/9876/29', '$2y$10$iKLkwrB/BpxkTJg0wXlGX.vvFUdcDtgg2VBKP4Y/BEa', '2024-01-19 11:59:06.23275'),
(6, 'asd', 'eb3/97876/22', '$2y$10$eY30yuFQMsgYHtarM5tyOO/QvFGgeLlGhiAElgWyo0G2gRzP5WfhW', '2024-01-19 12:10:27.84357'),
(7, 'tom', 'Eb3/46789/20', '$2y$10$AVwFYadLjYUA1hB.lcgh1e.ILVCSSA3hU5QZZeU29J/eFqgSOw1FS', '2024-01-22 07:32:21.68870'),
(8, 'mary', '0726-555560', '$2y$10$LP2E4PhKz0AoJBN7aEWZMOmwjiGczBqTgxPNbJa2aWVnOtL45hYu6', '2024-01-22 07:34:10.99449'),
(9, 'jane', 'eb3/9876/29', '$2y$10$6yEVYTuqu68fPNuyY8k.xulZxDXxRKhwKmIqbw.ofs7Gn95LvJgK2', '2024-01-22 09:45:48.40885');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `reg` (`reg`);

--
-- Indexes for table `industrysupreg`
--
ALTER TABLE `industrysupreg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lecturer_reg`
--
ALTER TABLE `lecturer_reg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `industrysupreg`
--
ALTER TABLE `industrysupreg`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lecturer_reg`
--
ALTER TABLE `lecturer_reg`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
