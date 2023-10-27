-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2023 at 12:17 PM
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
  `BAppt_ID` int(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) DEFAULT NULL,
  `BAppt_StartDate` varchar(20) NOT NULL,
  `BAppt_EndDate` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boardingAppt`
--

INSERT INTO `boardingAppt` (`BAppt_ID`, `Pet_ID`, `Service_ID`, `Staff_ID`, `BAppt_StartDate`, `BAppt_EndDate`, `Status`) VALUES
(6, '2', 'SB2', 'S1', '2023-10-08', '2023-10-12', 'Pending'),
(7, '3', 'SB1', 'S1', '2023-10-15', '2023-10-17', 'Canceled'),
(8, '1', 'SB1', 'S1', '2023-10-27', '2023-10-29', 'Pending'),
(10, '2', 'SB2', '', '2023-10-30', '2023-10-31', 'Pending'),
(11, '3', 'SB1', '', '2023-10-28', '2023-10-31', 'Pending'),
(12, '2', 'SB1', '', '2023-10-31', '2023-11-02', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_ID` int(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Feedback_Desc` varchar(50) NOT NULL,
  `Feedback_Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_ID`, `Cust_ID`, `Feedback_Desc`, `Feedback_Date`) VALUES
(1, 'C1', 'Good', '2023-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `groomingAppt`
--

CREATE TABLE `groomingAppt` (
  `GAppt_ID` int(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) DEFAULT NULL,
  `GAppt_Date` varchar(20) NOT NULL,
  `GAppt_Time` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groomingAppt`
--

INSERT INTO `groomingAppt` (`GAppt_ID`, `Pet_ID`, `Service_ID`, `Staff_ID`, `GAppt_Date`, `GAppt_Time`, `Status`) VALUES
(1, '1', 'SG1', 'S1', '2023-10-11', '11:00', 'Canceled'),
(7, '3', 'SB3', 'S1', '2023-10-12', '14:30', 'Canceled'),
(8, '2', 'SG2', 'S1', '2023-10-13', '11:11', 'Canceled'),
(9, '2', 'SG1', '', '2023-10-27', '12:00', 'Pending'),
(10, '1', 'SB3', '', '2023-10-28', '12:30', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL,
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

INSERT INTO `member` (`ID`, `Cust_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Email`) VALUES
(1, 'C1', 'Chong', 'Steven', '0123457788', 'No 1, ABC', 'Perak', '48300', 'steven@gmail.com'),
(2, 'C2', 'test', 'test', '1', '1', '1', '1', '1');

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
(5, 'C2', 'pk');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `Pet_ID` int(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Pet_Name` varchar(20) NOT NULL,
  `Pet_Sex` varchar(20) NOT NULL,
  `Pet_Breed` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`Pet_ID`, `Cust_ID`, `Pet_Name`, `Pet_Sex`, `Pet_Breed`) VALUES
(1, 'C1', 'Luckyyyyy', 'Female', 'Bo Mei'),
(2, 'C1', 'Boboooo', 'Male', 'Husky'),
(3, 'C1', 'Didiiiiii', 'Male', 'Blue cat'),
(5, 'C1', 'Test', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sales_ID` varchar(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Price` varchar(20) NOT NULL,
  `Stock` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Price` varchar(20) NOT NULL,
  `Img` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ID`, `Service_ID`, `Service_Type`, `Service_Name`, `Service_Desc`, `Price`, `Img`) VALUES
(1, 'SG1', 'Pet Grooming', 'Bath and Brush', 'Bath and Brush', '50', 'Bath&Brush.jpg'),
(2, 'SG2', 'Pet Grooming', 'Haircut and Style', 'Haircut and Style', '30', 'Haircut.jpg'),
(3, 'SB3', 'Pet Grooming', 'Nail Trim', 'Nail Trim', '40', 'NailTrim.jpg'),
(4, 'SB1', 'Pet Boarding', 'Standard Boarding', 'Standard Boarding', '100', 'StandardBoarding.jpg'),
(5, 'SB2', 'Pet Boarding', 'Luxury Boarding', 'Luxury Boarding', '150', 'LuxuryBoarding.jpg'),
(6, 'ST1', 'Pet Treatment', 'Vaccinations', 'Vaccinations', '20', 'Vaccinations.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
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

INSERT INTO `staff` (`ID`, `Staff_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Position`) VALUES
(1, 'S1', 'Staff1', 'Staff1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `staffAcc`
--

CREATE TABLE `staffAcc` (
  `ID` int(11) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffAcc`
--

INSERT INTO `staffAcc` (`ID`, `Staff_ID`, `Password`) VALUES
(1, 'S1', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardingAppt`
--
ALTER TABLE `boardingAppt`
  ADD PRIMARY KEY (`BAppt_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `groomingAppt`
--
ALTER TABLE `groomingAppt`
  ADD PRIMARY KEY (`GAppt_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `memberAcc`
--
ALTER TABLE `memberAcc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`Pet_ID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staffAcc`
--
ALTER TABLE `staffAcc`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boardingAppt`
--
ALTER TABLE `boardingAppt`
  MODIFY `BAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groomingAppt`
--
ALTER TABLE `groomingAppt`
  MODIFY `GAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `memberAcc`
--
ALTER TABLE `memberAcc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `Pet_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staffAcc`
--
ALTER TABLE `staffAcc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
