-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 12:48 PM
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
  `Status` varchar(20) NOT NULL DEFAULT 'Pending',
  `BAppt_CheckInDate` varchar(20) NOT NULL,
  `BAppt_CheckOutDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boardingappt`
--

INSERT INTO `boardingappt` (`BAppt_ID`, `Pet_ID`, `Service_ID`, `Staff_ID`, `BAppt_StartDate`, `BAppt_EndDate`, `Status`, `BAppt_CheckInDate`, `BAppt_CheckOutDate`) VALUES
(6, '2', 'SB2', 'S1', '2023-10-08', '2023-10-12', 'Approved', '2023-10-21', '2023-10-31'),
(7, '2', 'SB1', 'S1', '2023-10-15', '2023-10-17', 'Approved', '2023-11-17', '2023-11-20'),
(8, '1', 'SB1', 'S1', '2023-10-27', '2023-10-29', 'Canceled', '', ''),
(10, '2', 'SB2', '', '2023-10-30', '2023-10-31', 'Approved', '2023-11-20', '2023-11-21'),
(11, '2', 'SB1', '', '2023-10-28', '2023-10-31', 'Pending', '', ''),
(12, '2', 'SB1', 'S2', '2023-11-01', '2023-11-02', 'Rejected', '', ''),
(13, '2', 'SB1', 'S2', '2023-11-19', '2023-11-19', 'Completed', '', ''),
(14, '12', 'SB1', '', '2023-11-21', '2023-11-23', 'Approved', '2023-11-22', '2023-11-24');

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
(1, 'C1', 'Good', '2023-10-27'),
(2, 'Faizal', 'Good service, like it so much, thank you', '2023-11-22');

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
(1, '1', 'SG1', 'S2', '2023-10-12', '12:23', 'Approved'),
(7, '2', 'SB3', 'S1', '2023-10-12', '14:30', 'Canceled'),
(9, '2', 'SG1', '', '2023-10-27', '12:00', 'Pending'),
(11, '2', 'SG1', 'S1', '2023-11-19', '12:30', 'Canceled');

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
(1, 'Canine Parvovirus', 20, '2023-11-15', 97);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID`, `Cust_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Email`) VALUES
(1, 'C1', 'Andrew', 'Wilson', '0185346787', 'No 1, Jalan Johor', 'Johor', '80000', 'andrew@gmail.com'),
(2, 'C2', 'Adam', 'Wiliams', '0149356776', 'No 2, Jalan Subang', 'Selangor', '47500', 'adam@gmail.com'),
(3, 'C3', 'John', 'Smith', '0196674687', 'No 3, Jalan Penang', 'Penang', '11900', 'john@gmail.com'),
(4, 'C4', 'Chris', 'Morrison', '0112675656', 'No 4, Jalan Pahang', 'Pahang', '39200', 'chris@gmail.com'),
(5, 'C5', 'June', 'Miller', '0176557845', 'No 5, Jalan Kelantan', 'Kelantan', '15050', 'june@gmail.com'),
(8, 'Faizal', 'Faizal', 'Faizal', '0123456789', 'No30,Jalan bahbah', 'Petaling Jaya', '46150', 'faizal@gmail.com');

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
(2, 'C2', 'customer'),
(3, 'C3', 'customer'),
(4, 'C4', 'customer'),
(5, 'C5', 'customer'),
(9, 'Faizal', 'faizal');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `Pet_ID` int(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Pet_Name` varchar(20) NOT NULL,
  `Pet_Sex` varchar(20) NOT NULL,
  `Pet_Breed` varchar(20) NOT NULL,
  `Pet_Health` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`Pet_ID`, `Cust_ID`, `Pet_Name`, `Pet_Sex`, `Pet_Breed`, `Pet_Health`) VALUES
(1, 'C1', 'Lucky', 'Female', 'Mudi', ''),
(2, 'C1', 'Bobo', 'Male', 'Husky', ''),
(3, 'C2', 'Didi', 'Male', 'French Bulldogs', ''),
(5, 'C2', 'Sugar', 'Male', 'Golden Retrievers', ''),
(6, 'C3', 'Angel', 'Female', 'Bulldogs', ''),
(7, 'C3', 'Sunshine', 'Male', 'Ragdoll', ''),
(8, 'C4', 'Peach', 'Female', 'Devon Rex', ''),
(9, 'C4', 'Boobie', 'Male', 'Exotic Shorthair', ''),
(10, 'C5', 'Teddy Bear', 'Male', 'Boston Terriers', ''),
(11, 'C5', 'Nugget', 'Female', 'Birman', ''),
(12, 'Faizal', 'kitty', 'female', 'british short hair', '1'),
(13, 'Faizal', 'aa', 'aaa', 'aa', 'aa'),
(14, 'Faizal', 'bb', 'bb', 'bb', 'bb'),
(15, 'Faizal', 'cc', 'cc', 'cc', 'cc');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sales_ID` int(20) NOT NULL,
  `Cust_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Price` varchar(20) NOT NULL,
  `Quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sales_ID`, `Cust_ID`, `Service_ID`, `Date`, `Price`, `Quantity`) VALUES
(1, '1', 'ST1', '2023-11-22', '20', 1),
(4, 'Faizal', 'Boarding', '2023-11-22', '100', 2),
(5, 'Faizal', 'treatment', '2023-11-22', '20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ID` int(11) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Service_Type` varchar(20) NOT NULL,
  `Service_Name` varchar(20) NOT NULL,
  `Service_Desc` longtext NOT NULL,
  `Price` varchar(20) NOT NULL,
  `Img` longtext NOT NULL,
  `Inventory` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ID`, `Service_ID`, `Service_Type`, `Service_Name`, `Service_Desc`, `Price`, `Img`, `Inventory`) VALUES
(1, 'SG1', 'Pet Grooming', 'Bath and Brush', 'A relaxing bathing and grooming experience for your pet, leaving them clean and refreshed.', '50', 'Bath&Brush.jpg', NULL),
(2, 'SG2', 'Pet Grooming', 'Haircut and Style', 'Transform your pet\'s appearance with a professional haircut and styling session, tailored to their breed and preferences.', '30', 'Haircut.jpg', NULL),
(3, 'SG3', 'Pet Grooming', 'Nail Trim', 'Keep your pet\'s paws healthy and comfortable with our gentle and precise nail trimming service.', '40', 'NailTrim.jpg', NULL),
(4, 'SB1', 'Pet Boarding', 'Standard Boarding', 'Affordable and comfortable boarding accommodations ensuring your pet\'s well-being during your absence.', '100', 'StandardBoarding.jpg', NULL),
(5, 'SB2', 'Pet Boarding', 'Luxury Boarding', 'Spoil your pet with a luxurious boarding experience, offering extra amenities and personalized attention.', '150', 'LuxuryBoarding.jpg', NULL),
(6, 'ST1', 'Pet Treatment', 'Vaccinations', 'Essential vaccinations to protect your pet from common diseases and ensure their long-term health and well-being.', '20', 'Vaccinations.jpg', NULL),
(7, 'SG4', 'Pet Grooming', 'Eye and Ear cleaning', 'Gentle and thorough ear cleaning to remove excess wax and debris, promoting your pet\'s ear health.', '30', 'EarCleaning.jpg', NULL),
(8, 'SG5', 'Pet Grooming', 'Teeth brushing', 'Maintain your pet\'s dental hygiene with a professional teeth brushing service, helping to prevent plaque and bad breath.', '25', 'TeethBrushing.jpg', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `Staff_ID`, `First_Name`, `Last_Name`, `Phone_No`, `Address`, `City`, `Postcode`, `Position`) VALUES
(1, 'S1', 'Ye Sheng', 'Tan', '0143457788', 'No 1, Jalan Subang', 'Subang Jaya', '45000', 'Admin'),
(2, 'S2', 'Navine', 'Tan', '01275648566', '3, Jalan PJS 11/15, ', 'Petaling Jaya', '47500 ', 'Manager');

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
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `Supplies_ID` int(20) NOT NULL,
  `Supplies_Name` varchar(20) NOT NULL,
  `Price` varchar(20) NOT NULL,
  `Quantity` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`Supplies_ID`, `Supplies_Name`, `Price`, `Quantity`) VALUES
(1, 'Vaccination', '20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `treatmentappt`
--

CREATE TABLE `treatmentappt` (
  `TAppt_ID` int(20) NOT NULL,
  `Pet_ID` varchar(20) NOT NULL,
  `Service_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) DEFAULT NULL,
  `TAppt_Date` varchar(20) NOT NULL,
  `TAppt_Time` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatmentappt`
--

INSERT INTO `treatmentappt` (`TAppt_ID`, `Pet_ID`, `Service_ID`, `Staff_ID`, `TAppt_Date`, `TAppt_Time`, `Status`) VALUES
(1, '2', 'ST1', NULL, '2023-11-22', '11:30', 'Pending'),
(2, '1', 'ST1', 'S1', '2023-11-22', '10:30', 'Approved'),
(3, '1', 'ST1', '', '2023-11-24', '14:29', 'Pending'),
(4, '13', 'ST1', '', '2023-11-22', '17:03', 'Approved'),
(5, '14', 'ST1', '', '2023-11-23', '17:04', 'Approved'),
(6, '15', 'ST1', '', '2023-11-29', '19:04', 'Approved');

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
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`Supplies_ID`);

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
  MODIFY `BAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groomingappt`
--
ALTER TABLE `groomingappt`
  MODIFY `GAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Supplies_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `memberacc`
--
ALTER TABLE `memberacc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `Pet_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sales_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffacc`
--
ALTER TABLE `staffacc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `Supplies_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatmentappt`
--
ALTER TABLE `treatmentappt`
  MODIFY `TAppt_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
