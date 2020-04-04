-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2020 at 12:51 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team15DB`
--
CREATE DATABASE IF NOT EXISTS `team15DB` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `team15DB`;

-- --------------------------------------------------------

--
-- Table structure for table `cardholder`
--

CREATE TABLE `cardholder` (
  `userID` int(11) NOT NULL,
  `loginID` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `userType` varchar(45) NOT NULL,
  `age` varchar(45) NOT NULL,
  `fines` int(11) DEFAULT NULL,
  `dayLimit` int(11) NOT NULL,
  `bookLimit` int(11) NOT NULL,
  `quantityCheckedOut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cardholder`
--

INSERT INTO `cardholder` (`userID`, `loginID`, `firstName`, `lastName`, `email`, `userType`, `age`, `fines`, `dayLimit`, `bookLimit`, `quantityCheckedOut`) VALUES
(1615846, 1615846, 'David', 'Seijas', 'deseijas@uh.edu', 'Student', '20', 0, 7, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `loginID` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `hireDate` varchar(45) NOT NULL,
  `terminationDate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `feeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `feeAmount` int(11) NOT NULL,
  `feeStatus` varchar(45) NOT NULL,
  `dateCreated` varchar(45) NOT NULL,
  `dateSettled` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryID` int(11) NOT NULL,
  `totalCopies` int(11) NOT NULL,
  `totalAvailable` int(11) NOT NULL,
  `totalCheckedOut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `User ID` int(11) NOT NULL,
  `inventoryID` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `checkedOutBy` int(11) DEFAULT NULL,
  `checkoutDate` varchar(45) DEFAULT NULL,
  `dueDate` varchar(45) DEFAULT NULL,
  `genre` varchar(45) NOT NULL,
  `year` int(11) NOT NULL,
  `authorName` varchar(45) NOT NULL,
  `distributor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginID` int(11) NOT NULL,
  `userPassword` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginID`, `userPassword`) VALUES
(1615846, '04191999');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `reservationDate` varchar(45) NOT NULL,
  `experationDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardholder`
--
ALTER TABLE `cardholder`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `User Login ID_idx` (`loginID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD KEY `Employee Login ID_idx` (`loginID`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`feeID`),
  ADD KEY `FUser ID_idx` (`userID`),
  ADD KEY `FItem ID_idx` (`itemID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `User ID_idx` (`User ID`),
  ADD KEY `Inventory ID_idx` (`inventoryID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `User ID_idx` (`userID`),
  ADD KEY `Item ID_idx` (`itemID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cardholder`
--
ALTER TABLE `cardholder`
  ADD CONSTRAINT `User Login ID` FOREIGN KEY (`loginID`) REFERENCES `login` (`loginID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `Employee Login ID` FOREIGN KEY (`loginID`) REFERENCES `login` (`loginID`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `FItem ID` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`),
  ADD CONSTRAINT `FUser ID` FOREIGN KEY (`userID`) REFERENCES `cardholder` (`userID`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Inventory ID` FOREIGN KEY (`inventoryID`) REFERENCES `inventory` (`inventoryID`),
  ADD CONSTRAINT `User ID` FOREIGN KEY (`User ID`) REFERENCES `cardholder` (`userID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `RItem ID` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`),
  ADD CONSTRAINT `RUser ID` FOREIGN KEY (`userID`) REFERENCES `cardholder` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
