-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 03:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `boardingappt`
--

CREATE TABLE `boardingappt` (
  `BAppt_ID` int(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) DEFAULT NULL,
  `BAppt_StartDate` varchar(20) NOT NULL,
  `BAppt_EndDate` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boardingappt`
--

INSERT INTO `boardingappt` (`BAppt_ID`, `Pet_ID`, `Service_ID`, `Staff_ID`, `BAppt_StartDate`, `BAppt_EndDate`, `Status`) VALUES
(6, '2', 'SB2', 'S1', '2023-10-08', '2023-10-12', 'Pending'),
(7, '3', 'SB1', 'S1', '2023-10-15', '2023-10-17', 'Canceled'),
(8, '1', 'SB1', 'S1', '2023-10-27', '2023-10-29', 'Pending'),
(10, '2', 'SB2', '', '2023-10-30', '2023-10-31', 'Pending'),
(11, '3', 'SB1', '', '2023-10-28', '2023-10-31', 'Pending'),
(12, '2', 'SB1', '', '2023-10-31', '2023-11-02', 'Pending'),
(13, '6', 'SB1', '', '2023-12-08', '2023-11-24', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_ID` int(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Feedback_Desc` varchar(50) NOT NULL,
  `Feedback_Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_ID`, `Cust_ID`, `Feedback_Desc`, `Feedback_Date`) VALUES
(1, 'C1', 'Good', '2023-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `groomingappt`
--

CREATE TABLE `groomingappt` (
  `GAppt_ID` int(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) DEFAULT NULL,
  `GAppt_Date` varchar(20) NOT NULL,
  `GAppt_Time` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groomingappt`
--

INSERT INTO `groomingappt` (`GAppt_ID`, `Pet_ID`, `Service_ID`, `Staff_ID`, `GAppt_Date`, `GAppt_Time`, `Status`) VALUES
(1, '1', 'SG1', 'S1', '2023-10-11', '11:00', 'Canceled'),
(7, '3', 'SB3', 'S1', '2023-10-12', '14:30', 'Canceled'),
(8, '2', 'SG2', 'S1', '2023-10-13', '11:11', 'Canceled'),
(9, '2', 'SG1', '', '2023-10-27', '12:00', 'Pending'),
(10, '1', 'SB3', '', '2023-10-28', '12:30', 'Pending'),
(11, '1', 'SG2', '', '2023-11-30', '09:41', 'Pending'),
(12, '6', 'SG2', '', '2023-11-30', '09:43', 'Pending'),
(13, '6', 'SG1', '', '2023-11-24', '09:48', 'Pending'),
(14, '6', 'SG1', '', '2023-12-02', '09:56', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Supplies_ID` int(11) NOT NULL,
  `Supplies_Name` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Supplies_ID`, `Supplies_Name`, `Price`, `Date`, `Quantity`) VALUES
(1, 'Canine Parvovirus', 20, '2023-11-15', 100);

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
  `Address` varchar(255) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Postcode` varchar(20) NOT NULL,
  `Email` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID`, `Cust_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Email`) VALUES
(1, 'C1', 'Chong', 'Steven', '0123457788', '3, Jalan PJS 11/15, Bandar Sunway', 'Petaling Jaya', '47500 ', 'steven@gmail.com'),
(2, 'C2', 'Ye Sheng', 'Tan', '01275648566', '3, Jalan PJS 11/11, Bandar Sunway,', 'Subang Jaya', '47500', 'Ye Sheng@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `memberacc`
--

CREATE TABLE `memberacc` (
  `ID` int(11) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `memberacc`
--

INSERT INTO `memberacc` (`ID`, `Cust_ID`, `Password`) VALUES
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`Pet_ID`, `Cust_ID`, `Pet_Name`, `Pet_Sex`, `Pet_Breed`) VALUES
(1, 'C1', 'Luckyyyyy', 'Female', 'Bo Mei'),
(2, 'C1', 'Boboooo', 'Male', 'Husky'),
(3, 'C1', 'Didiiiiii', 'Male', 'Blue cat'),
(6, 'C2', 'GG', 'Male', 'American Pit Bull Te');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sales_ID` int(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Price` varchar(20) NOT NULL,
  `Quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sales_ID`, `Cust_ID`, `Service_ID`, `Price`, `Quantity`) VALUES
(1, '1', 'ST1', '20', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Address` varchar(255) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Postcode` varchar(20) NOT NULL,
  `Position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `Staff_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Position`) VALUES
(1, 'S1', 'Kenny', 'Leong', '0163728857', '110, Jalan SS 15/6a, Ss 15', 'Subang Jaya', '47500', 'Selangor');

-- --------------------------------------------------------

--
-- Table structure for table `staffacc`
--

CREATE TABLE `staffacc` (
  `ID` int(11) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffacc`
--

INSERT INTO `staffacc` (`ID`, `Staff_ID`, `Password`) VALUES
(1, 'S1', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `treatmentappt`
--

CREATE TABLE `treatmentappt` (
  `TAppt_ID` int(11) NOT NULL,
  `Pet_ID` int(11) NOT NULL,
  `Service_ID` int(11) NOT NULL,
  `Staff_ID` int(11) DEFAULT NULL,
  `TAppt_Date` date NOT NULL,
  `TAppt_Time` time NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardingappt`
--
ALTER TABLE `boardingappt`
  ADD PRIMARY KEY (`BAppt_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `groomingappt`
--
ALTER TABLE `groomingappt`
  ADD PRIMARY KEY (`GAppt_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Supplies_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `memberacc`
--
ALTER TABLE `memberacc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`Pet_ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sales_ID`);

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
-- Indexes for table `staffacc`
--
ALTER TABLE `staffacc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `treatmentappt`
--
ALTER TABLE `treatmentappt`
  ADD PRIMARY KEY (`TAppt_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boardingappt`
--
ALTER TABLE `boardingappt`
  MODIFY `BAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groomingappt`
--
ALTER TABLE `groomingappt`
  MODIFY `GAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Supplies_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `memberacc`
--
ALTER TABLE `memberacc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `Pet_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sales_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `staffacc`
--
ALTER TABLE `staffacc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatmentappt`
--
ALTER TABLE `treatmentappt`
  MODIFY `TAppt_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
