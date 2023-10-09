-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2023 at 11:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petsmile`
--

-- --------------------------------------------------------

--
-- Table structure for table `boardingAppt`
--

CREATE TABLE `boardingAppt` (
  `BAppt_ID` varchar(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  `BAppt_StartDate` varchar(20) NOT NULL,
  `BAppt_EndDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groomingAppt`
--

CREATE TABLE `groomingAppt` (
  `GAppt_ID` varchar(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  `GAppt_Date` varchar(20) NOT NULL,
  `GAppt_Time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Cust_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Phone_No` varchar(20) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Postcode` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Cust_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Email`) VALUES
('C1', 'Chong', 'Steven', '0123457788', 'No 1, ABC', 'Perak', '39200', 'steven@gmail.com'),
('C2', 'test', 'test', '1', '1', '1', '1', '1'),
('1', '1', '1', '1', '1', '1', '1', '1'),
('1', '1', '1', '1', '1', '1', '1', '1'),
('1', '1', '1', '1', '1', '1', '1', '1'),
('C2', 'pk', 'pk', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `memberAcc`
--

CREATE TABLE `memberAcc` (
  `ID` int(11) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberAcc`
--

INSERT INTO `memberAcc` (`ID`, `Cust_ID`, `Password`) VALUES
(1, 'C1', 'customer'),
(2, '1', '1'),
(3, '1', '1'),
(4, '1', '1'),
(5, 'C2', 'pk');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `ID` int(11) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Pet_Name` varchar(20) NOT NULL,
  `Pet_Sex` varchar(20) NOT NULL,
  `Pet_Breed` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`ID`, `Pet_ID`, `Cust_ID`, `Pet_Name`, `Pet_Sex`, `Pet_Breed`) VALUES
(1, 'P1', 'C1', 'Lucky', 'Female', 'Bo Mei'),
(3, 'P2', 'C1', 'Boboooo', 'Male', 'Huskies'),
(4, 'P3', 'C1', 'Didiiiiii', 'Male', 'Blue cat'),
(5, '1', 'C1', '1', '1', '1'),
(6, 'pet', 'C2', 'pky', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ID` int(11) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Service_Type` varchar(20) NOT NULL,
  `Service_Name` varchar(20) NOT NULL,
  `Service_Desc` varchar(20) NOT NULL,
  `Price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ID`, `Service_ID`, `Service_Type`, `Service_Name`, `Service_Desc`, `Price`) VALUES
(1, 'SG1', 'Grooming', 'Bath and Brush', 'Bath and Brush', '50'),
(2, 'SG2', 'Grooming', 'Haircut and Style', 'Haircut and Style', '30'),
(3, 'SB3', 'Grooming', 'Nail Trim', 'Nail Trim', '40'),
(4, 'SB1', 'Boarding', 'Standard Boarding', 'Standard Boarding', '100'),
(5, 'SB2', 'Boarding', 'Luxury Boarding', 'Luxury Boarding', '150');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Phone_No` varchar(20) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Postcode` varchar(20) NOT NULL,
  `Position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Position`) VALUES
('S1', 'Pk', 'Pk', '1', '1', '1', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memberAcc`
--
ALTER TABLE `memberAcc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memberAcc`
--
ALTER TABLE `memberAcc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
