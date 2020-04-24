-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2020 at 01:24 AM
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
-- Database: `id13143678_team15`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardholder`
--

CREATE TABLE `cardholder` (
  `userID` int(11) NOT NULL,
  `loginID` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `userType` varchar(45) DEFAULT '1',
  `age` varchar(45) DEFAULT NULL,
  `fines` int(11) DEFAULT 0,
  `dayLimit` int(11) NOT NULL,
  `bookLimit` int(11) NOT NULL,
  `quantityCheckedOut` int(11) DEFAULT 0,
  `dateAdded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cardholder`
--

INSERT INTO `cardholder` (`userID`, `loginID`, `password`, `firstName`, `lastName`, `email`, `userType`, `age`, `fines`, `dayLimit`, `bookLimit`, `quantityCheckedOut`, `dateAdded`) VALUES
(1, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'Muhammad', 'Abbas', 'mabbas@dbms.com', '1', '25', 10, 3, 3, 2, '2020-04-24'),
(2, 'ds168100', '5f4dcc3b5aa765d61d8327deb882cf99', 'David', 'Seijas', 'dseijas@dbms.com', '2', '20', 0, 5, 5, 1, '2020-04-24'),
(3, 'user3', '92877af70a45fd6a2ed7fe81e1236b78', 'Khoa', 'Tran', 'ktran@dbms.com', '1', '20', 0, 3, 3, 0, '2020-04-24'),
(4, 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'Karla', 'Lemus', 'klemus@dbms.com', '2', '20', 0, 5, 5, 0, '2020-04-24'),
(5, 'user5', '0a791842f52a0acfbb3a783378c066b8', 'J G', 'Hernandez', 'jghernandez@dbms.com', '1', '20', 0, 3, 3, 0, '2020-04-24'),
(7, 'tomNook', '5f4dcc3b5aa765d61d8327deb882cf99', 'Tom', 'Nook', 'tom@nookinc.com', '2', '40', 0, 5, 5, 0, '2020-04-24'),
(8, 'Jh', '373633ec8af28e5afaf6e5f4fd87469b', 'Juan', 'hernandez', 'juan.hernandez@somewhere.com', '1', '36', 0, 3, 3, 0, '2020-04-24'),
(9, 'test', '098f6bcd4621d373cade4e832627b4f6', 'Test', 'function', 'testuser@db.com', '2', '30', 0, 5, 5, 0, '2020-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `loginID` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `loginID`, `password`, `Name`) VALUES
(1, 'admin1', 'admin1', 'Admin 1');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `feeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `feeAmount` int(11) NOT NULL DEFAULT 5,
  `feeStatus` varchar(45) NOT NULL DEFAULT 'Unpaid',
  `dateCreated` date NOT NULL,
  `dateSettled` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`feeID`, `userID`, `itemID`, `title`, `feeAmount`, `feeStatus`, `dateCreated`, `dateSettled`) VALUES
(1, 5, 22, 'Entwined With You', 5, 'Paid', '2020-04-19', '2020-04-20'),
(2, 5, 22, 'Entwined With You', 5, 'Paid', '2020-04-19', '2020-04-20'),
(3, 1, 18, 'Avengers: Endgame', 5, 'Paid', '2020-04-17', '2020-04-20'),
(4, 1, 8, 'The Turn of the Key', 5, 'Unpaid', '2020-04-18', '0000-00-00'),
(5, 1, 15, 'Arrival', 5, 'Unpaid', '2020-04-19', '0000-00-00');

--
-- Triggers `fees`
--
DELIMITER $$
CREATE TRIGGER `after_fee_insert` AFTER INSERT ON `fees` FOR EACH ROW BEGIN
	UPDATE cardholder
    	SET fines = fines + 5
	WHERE userID = NEW.userID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryID` int(11) NOT NULL,
  `isbn` varchar(45) NOT NULL,
  `totalCopies` int(11) NOT NULL,
  `totalAvailable` int(11) NOT NULL,
  `totalCheckedout` int(11) DEFAULT NULL,
  `totalReserved` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryID`, `isbn`, `totalCopies`, `totalAvailable`, `totalCheckedout`, `totalReserved`) VALUES
(1, '03272007', 3, 1, 0, 1),
(4, '06192001', 2, 2, 0, 0),
(6, '08312010', 2, 2, 0, 0),
(7, '02052019', 2, 2, 0, 0),
(8, '08062019', 2, 2, 0, 0),
(9, '02242015', 1, 1, 0, 0),
(13, '10022015', 2, 1, 1, 0),
(15, '09022016', 3, 3, 0, 0),
(18, '04262019', 4, 3, 0, 0),
(22, '06042013', 2, 2, 0, 0),
(24, '01011998', 2, 2, 0, 0),
(26, '01011965', 2, 2, 0, 0),
(28, '02202018', 2, 2, 0, 0),
(30, '043396522596', 1, 0, 1, 0),
(31, '671027344', 1, 0, 1, 0),
(32, 'B00AFEYUVG', 1, 0, 0, 1),
(33, '156012197', 1, 1, 0, 0),
(34, 'B01F8505M4', 1, 1, 0, 0),
(35, '1975399366', 1, 1, 0, 0),
(36, '704400023910', 1, 1, 0, 0),
(37, '013132624136', 1, 1, 0, 0),
(38, '704400070839', 1, 1, 0, 0),
(39, '9780062839701', 1, 1, 0, 0),
(40, '1573222453', 1, 1, 0, 0),
(41, '9780439023528', 1, 0, 0, 1),
(42, '0385351402', 1, 1, 0, 0),
(43, '1451648537', 1, 1, 0, 0),
(44, '34567890', 1, 0, 0, 0),
(45, '0786', 1, 1, 0, 0),
(46, 'B003O86FMW', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `inventoryID` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `type` int(45) NOT NULL,
  `isbn` varchar(44) NOT NULL,
  `status` varchar(45) NOT NULL,
  `dateAdded` date NOT NULL DEFAULT current_timestamp(),
  `checkedOutBy` varchar(255) DEFAULT NULL,
  `checkoutDate` date DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `genre` varchar(45) NOT NULL,
  `year` year(4) NOT NULL,
  `author` varchar(45) NOT NULL,
  `distributor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `userID`, `inventoryID`, `title`, `type`, `isbn`, `status`, `dateAdded`, `checkedOutBy`, `checkoutDate`, `dueDate`, `genre`, `year`, `author`, `distributor`) VALUES
(1, NULL, 1, 'The Name of the Wind', 1, '03272007', 'Reserved', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2007, 'Patrick Rothfuss', 'DAW Books'),
(2, NULL, 1, 'The Name of the Wind', 1, '03272007', 'Deleted', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2007, 'Patrick Rothfuss', 'DAW Books'),
(3, NULL, 1, 'The Name of the Wind', 1, '03272007', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2007, 'Patrick Rothfuss', 'DAW Books'),
(4, NULL, 4, 'American Gods', 1, '06192001', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2001, 'Neil Gaiman', 'Headline'),
(5, NULL, 4, 'American Gods', 1, '06192001', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2001, 'Neil Gaiman', 'Headline'),
(6, NULL, 6, 'The Way of Kings', 1, '08312010', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2010, 'Brandon Sanderson', 'Tor Books'),
(7, NULL, 7, 'The Silent Patient', 1, '02052019', 'Available', '2020-04-24', NULL, NULL, NULL, 'mystery', 2019, 'Alex Michaelides', 'Celadon Books'),
(8, NULL, 8, 'The Turn of the Key', 2, '08062019', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2019, 'Ruth Ware', 'Simon and Schuster'),
(9, NULL, 9, 'Hush Hush', 2, '02242015', 'Available', '2020-04-24', NULL, NULL, NULL, 'mystery', 2015, 'Laura Lippman', 'Faber & Faber'),
(10, NULL, 8, 'The Turn of the Key', 2, '08062019', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2019, 'Ruth Ware', 'Simon and Schuster'),
(11, NULL, 7, 'The Silent Patient', 1, '02052019', 'Available', '2020-04-24', NULL, NULL, NULL, 'mystery', 2019, 'Alex Michaelides', 'Celadon Books'),
(12, NULL, 6, 'The Way of Kings', 1, '08312010', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2010, 'Brandon Sanderson', 'Tor Books'),
(13, 1, 13, 'The Martian', 3, '10022015', 'Unavailable', '2020-04-24', 'user1', '2020-04-23', '2020-04-26', 'sciencefiction', 2015, 'Ridley Scott', 'Scott Free Productions'),
(14, NULL, 13, 'The Martian', 3, '10022015', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2015, 'Ridley Scott', 'Scott Free Productions'),
(15, NULL, 15, 'Arrival', 3, '09022016', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2016, 'Denis Villeneuve', 'Paramount Pictures'),
(16, NULL, 15, 'Arrival', 3, '09022016', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2016, 'Denis Villeneuve', 'Paramount Pictures'),
(17, NULL, 15, 'Arrival', 3, '09022016', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2016, 'Denis Villeneuve', 'Paramount Pictures'),
(18, NULL, 18, 'Avengers: Endgame', 1, '04262019', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2019, 'Joe & Anthony Russo', 'Marvel Studios'),
(19, NULL, 18, 'Avengers: Endgame', 1, '04262019', 'Deleted', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2019, 'Joe & Anthony Russo', 'Marvel Studios'),
(20, NULL, 18, 'Avengers: Endgame', 1, '04262019', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2019, 'Joe & Anthony Russo', 'Marvel Studios'),
(21, NULL, 18, 'Avengers: Endgame', 1, '04262019', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2019, 'Joe & Anthony Russo', 'Marvel Studios'),
(22, NULL, 22, 'Entwined With You', 1, '06042013', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 2013, 'Sylvia Day', 'Penguin'),
(23, NULL, 22, 'Entwined With You', 1, '06042013', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 2013, 'Sylvia Day', 'Penguin'),
(24, NULL, 24, 'Sea Swept', 1, '01011998', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 1998, 'Nora Roberts', 'Penguin'),
(25, NULL, 24, 'Sea Swept', 1, '01011998', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 1998, 'Nora Roberts', 'Penguin'),
(26, NULL, 26, 'In Cold Blood', 1, '01011965', 'Available', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 1965, 'Truman Capote', 'Penguin Random House LLC.'),
(27, NULL, 26, 'In Cold Blood', 1, '01011965', 'Available', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 1965, 'Truman Capote', 'Penguin Random House LLC.'),
(28, NULL, 28, 'Educated', 2, '02202018', 'Available', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 2018, 'Tara Westover', 'Penguin Random House LLC.'),
(29, NULL, 28, 'Educated', 2, '02202018', 'Available', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 2018, 'Tara Westover', 'Penguin Random House LLC.'),
(31, 2, 30, 'Spider-Man: Into the Spider-Verse', 3, '043396522596', 'Unavailable', '2020-04-24', 'ds168100', '2020-04-21', '2020-04-26', 'sciencefiction', 2018, 'Peter Ramsey', 'Columbia Pictures'),
(32, 1, 31, 'The Perks of Being a Wallflower', 1, '671027344', 'Unavailable', '2020-04-24', 'user1', '2020-04-23', '2020-04-26', 'sciencefiction', 1999, 'Stephen Chbosky', 'MTV Books'),
(33, NULL, 32, 'The Perks of Being a Wallflower', 3, 'B00AFEYUVG', 'Reserved', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 2013, 'Stephen Chbosky', 'Lionsgate'),
(34, NULL, 33, ' The Little Prince', 1, '156012197', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 1943, 'Antoine de Saint-Exupéry', 'Mariner Books'),
(35, NULL, 34, 'The Little Prince', 3, 'B01F8505M4', 'Available', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2015, 'Mark Osborne', 'Paramount Pictures'),
(36, NULL, 35, 'Weathering With You', 1, '1975399366', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 2019, 'Makoto Shinkai', 'Yen Press'),
(37, NULL, 36, 'Your Name.', 3, '704400023910', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 2017, 'Makoto Shinkai', 'Funimation'),
(38, NULL, 37, 'Ghost In The Shell', 3, '013132624136', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 1995, 'Mamoru Oshii', 'Manga Entertainment'),
(39, NULL, 38, 'Ghost In The Shell 2: Innocence', 3, '704400070839', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2004, 'Mamoru Oshii', 'Funimation'),
(40, NULL, 39, 'Simon vs. the Homo Sapiens Agenda', 1, '9780062839701', 'Available', '2020-04-24', NULL, NULL, NULL, 'romance', 2018, 'Becky Albertalli', 'Balzer + Bray'),
(41, NULL, 40, 'The Kite Runner', 1, '1573222453', 'Available', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 2003, 'Khaled Hosseini', 'Riverhead'),
(42, NULL, 41, 'The Hunger Games', 1, '9780439023528', 'Reserved', '2020-04-24', NULL, NULL, NULL, 'fantasy', 2010, 'Suzanne Collins', 'Scholastic'),
(43, NULL, 42, 'The Circle', 1, '0385351402', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2013, 'Dave Eggers', 'Vintage'),
(44, NULL, 43, 'Steve Jobs', 1, '1451648537', 'Available', '2020-04-24', NULL, NULL, NULL, 'nonfiction', 2011, 'Walter Isaacson', 'Simon & Schuster'),
(45, NULL, 44, 'film1', 3, '34567890', 'Deleted', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2010, 'werty', 'werty'),
(46, NULL, 45, 'testing', 1, '0786', 'Available', '2020-04-24', NULL, NULL, NULL, 'sciencefiction', 2010, 'drtyhb', 'jiftyujk'),
(47, 2, 46, 'Catching Fire', 1, 'B003O86FMW', 'Unavailable', '2020-04-24', 'ds168100', '2020-04-24', '2020-04-29', 'fantasy', 2009, 'Suzanne Collins', 'Scholastic');

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `after_item_insert` AFTER INSERT ON `item` FOR EACH ROW BEGIN

    INSERT INTO 
       inventory VALUES ( inventoryID ,NEW.isbn, 1, 1, 0, 0)
    ON DUPLICATE KEY UPDATE inventory.totalCopies = inventory.totalCopies + 1 ,
               inventory.totalAvailable = inventory.totalAvailable + 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loanID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `itemID` int(255) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `checkOutDate` date NOT NULL,
  `dueDate` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Checked Out'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loanID`, `userID`, `itemID`, `itemName`, `checkOutDate`, `dueDate`, `status`) VALUES
(1, 5, 9, 'Hush Hush', '2020-04-14', '2020-04-17', 'Returned'),
(2, 5, 18, 'Avengers: Endgame', '2020-04-16', '2020-04-19', 'Returned'),
(3, 5, 19, 'Avengers: Endgame', '2020-04-16', '2020-04-19', 'Returned'),
(4, 5, 20, 'Avengers: Endgame', '2020-04-20', '2020-04-23', 'Returned'),
(5, 5, 28, 'Educated', '2020-04-17', '2020-04-20', 'Returned'),
(6, 5, 9, 'Hush Hush', '2020-04-20', '2020-04-23', 'Returned'),
(7, 5, 9, 'Hush Hush', '2020-04-20', '2020-04-23', 'Returned'),
(8, 5, 22, 'Entwined With You', '2020-04-17', '2020-04-19', 'Returned'),
(9, 1, 18, 'Avengers: Endgame', '2020-04-14', '2020-04-17', 'Returned'),
(10, 1, 8, 'The Turn of the Key', '2020-04-15', '2020-04-18', 'Returned'),
(11, 1, 15, 'Arrival', '2020-04-16', '2020-04-19', 'Returned'),
(12, 1, 26, 'In Cold Blood', '2020-04-20', '2020-04-23', 'Returned'),
(13, 2, 15, 'Arrival', '2020-04-21', '2020-04-26', 'Returned'),
(14, 8, 15, 'Arrival', '2020-04-21', '2020-04-24', 'Returned'),
(15, 1, 18, 'Avengers: Endgame', '2020-04-21', '2020-04-24', 'Returned'),
(16, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(17, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(18, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(19, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(20, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(21, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(22, 2, 34, ' The Little Prince', '2020-04-21', '2020-04-26', 'Returned'),
(23, 2, 36, 'Weathering With You', '2020-04-21', '2020-04-26', 'Returned'),
(24, 2, 31, 'Spider-Man: Into the Spider-Verse', '2020-04-21', '2020-04-26', 'Checked Out'),
(25, 1, 13, 'The Martian', '2020-04-23', '2020-04-26', 'Checked Out'),
(26, 1, 32, 'The Perks of Being a Wallflower', '2020-04-23', '2020-04-26', 'Checked Out'),
(27, 2, 47, 'Catching Fire', '2020-04-24', '2020-04-29', 'Checked Out');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `reservationDate` varchar(45) NOT NULL,
  `expirationDate` varchar(45) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationID`, `userID`, `itemID`, `itemName`, `reservationDate`, `expirationDate`, `status`) VALUES
(2, 5, 28, 'Educated', '2020-04-15', '2020-04-22', 'Canceled'),
(3, 5, 4, 'American Gods', '2020-04-15', '2020-04-22', 'Canceled'),
(4, 1, 15, 'Arrival', '2020-04-16', '2020-04-23', 'Picked Up'),
(5, 1, 13, 'The Martian', '2020-04-17', '2020-04-24', 'Picked Up'),
(6, 1, 8, 'The Turn of the Key', '2020-04-17', '2020-04-24', 'Picked Up'),
(7, 1, 7, 'The Silent Patient', '2020-04-18', '2020-04-25', 'Canceled'),
(8, 1, 26, 'In Cold Blood', '2020-04-19', '2020-04-26', 'Picked Up'),
(9, 1, 1, 'The Name of the Wind', '2020-04-19', '2020-04-26', 'Reserved'),
(10, 2, 36, 'Weathering With You', '2020-04-21', '2020-04-28', 'Canceled'),
(11, 2, 36, 'Weathering With You', '2020-04-21', '2020-04-28', 'Canceled'),
(12, 2, 36, 'Weathering With You', '2020-04-21', '2020-04-28', 'Canceled'),
(13, 2, 36, 'Weathering With You', '2020-04-21', '2020-04-28', 'Canceled'),
(14, 2, 36, 'Weathering With You', '2020-04-21', '2020-04-28', 'Picked Up'),
(15, 2, 33, 'The Perks of Being a Wallflower', '2020-04-21', '2020-04-28', 'Reserved'),
(16, 2, 31, 'Spider-Man: Into the Spider-Verse', '2020-04-21', '2020-04-28', 'Canceled'),
(17, 1, 42, 'The Hunger Games', '2020-04-23', '2020-04-30', 'Reserved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardholder`
--
ALTER TABLE `cardholder`
  ADD PRIMARY KEY (`userID`);

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
  ADD PRIMARY KEY (`inventoryID`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `User ID_idx` (`userID`),
  ADD KEY `Inventory ID_idx` (`inventoryID`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loanID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `User ID_idx` (`userID`),
  ADD KEY `Item ID_idx` (`itemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cardholder`
--
ALTER TABLE `cardholder`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `feeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loanID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_invID` FOREIGN KEY (`inventoryID`) REFERENCES `inventory` (`inventoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`id13143678_root`@`%` EVENT `issue_fees` ON SCHEDULE EVERY 1 DAY STARTS '2020-04-19 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO fees (userID, itemID, title, dateCreated) SELECT userID, itemID, itemName, dueDate FROM loans WHERE dueDate = CURRENT_DATE AND status = "Checked Out"$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
