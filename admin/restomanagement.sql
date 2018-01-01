-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2018 at 08:24 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restomanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `pwd` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `pwd`) VALUES
(1, 'admin01', '12345'),
(2, 'admin02', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `orderID` int(11) NOT NULL,
  `food` int(11) DEFAULT NULL,
  `cleanliness` int(11) DEFAULT NULL,
  `staff` int(11) DEFAULT NULL,
  `suggestions` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `himsagar`
--

CREATE TABLE `himsagar` (
  `restoID` int(11) DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `RasMalai` int(11) DEFAULT '0',
  `Sadha Dosa` int(11) DEFAULT '0',
  `Thali` int(11) DEFAULT '0',
  `Medu Vada` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `menuName` text NOT NULL,
  `path` varchar(250) DEFAULT NULL,
  `picName` varchar(100) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `menuTypeID` int(11) NOT NULL,
  `discription` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `menuName`, `path`, `picName`, `price`, `menuTypeID`, `discription`) VALUES
(1, 'RasMalai', 'upload/5a4a887ef41663.56761052.jpg', '5a4a887ef41663.56761052.jpg', 100, 8, 'North Indian Desert\r\n	'),
(2, 'Sadha Dosa', 'upload/5a4a89171ad357.58740027.jpg', '5a4a89171ad357.58740027.jpg', 75, 2, 'Something about food.....\r\n	'),
(3, 'Thali', 'upload/5a4a8932e64e99.35056548.jpg', '5a4a8932e64e99.35056548.jpg', 250, 7, 'Something about food.....\r\n	'),
(4, 'Medu Vada', 'upload/5a4a896c051646.51092082.jpg', '5a4a896c051646.51092082.jpg', 50, 1, 'Something about food.....\r\n	');

-- --------------------------------------------------------

--
-- Table structure for table `menutype`
--

CREATE TABLE `menutype` (
  `restoID` int(11) NOT NULL,
  `menuTypeID` int(11) NOT NULL,
  `menuType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menutype`
--

INSERT INTO `menutype` (`restoID`, `menuTypeID`, `menuType`) VALUES
(2, 1, 'Papad'),
(2, 2, 'Dosa'),
(2, 3, 'Juices'),
(2, 4, 'Dal'),
(2, 5, 'Parathas'),
(2, 6, 'Rice'),
(2, 7, 'Complete Thali'),
(2, 8, 'Desert');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `orderID` int(11) NOT NULL,
  `orderTime` date DEFAULT NULL,
  `status` text,
  `totalBill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resto`
--

CREATE TABLE `resto` (
  `restoID` int(11) NOT NULL,
  `restoName` varchar(100) DEFAULT NULL,
  `location` text,
  `orderTableName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resto`
--

INSERT INTO `resto` (`restoID`, `restoName`, `location`, `orderTableName`) VALUES
(2, 'Himsagar Family Restaurant', 'Ghatkopar', 'himsagar');

-- --------------------------------------------------------

--
-- Table structure for table `restoadmin`
--

CREATE TABLE `restoadmin` (
  `restoID` int(11) DEFAULT NULL,
  `restoadminID` int(11) NOT NULL,
  `restoadminName` varchar(100) DEFAULT NULL,
  `pwd` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restoadmin`
--

INSERT INTO `restoadmin` (`restoID`, `restoadminID`, `restoadminName`, `pwd`) VALUES
(3, 1, 'BananaLeaf01', '12345'),
(4, 2, 'PMC01', '12345'),
(2, 3, 'HFM01', '12345'),
(2, 4, 'HMF02', '12345'),
(3, 5, 'BL02', '12345'),
(4, 6, 'PMC02', '12345'),
(2, 7, 'HMF03', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `restokitchen`
--

CREATE TABLE `restokitchen` (
  `restoID` int(11) NOT NULL,
  `restokitchenID` int(11) NOT NULL,
  `restokitchenName` varchar(100) NOT NULL,
  `pwd` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restokitchen`
--

INSERT INTO `restokitchen` (`restoID`, `restokitchenID`, `restokitchenName`, `pwd`) VALUES
(2, 1, 'HMFkitchen01', '12345'),
(2, 2, 'HMFkitchen02', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `restomenu`
--

CREATE TABLE `restomenu` (
  `restoID` int(11) DEFAULT NULL,
  `menuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restomenu`
--

INSERT INTO `restomenu` (`restoID`, `menuID`) VALUES
(2, 2),
(2, 4),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 1),
(2, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `restotable`
--

CREATE TABLE `restotable` (
  `restoID` int(11) DEFAULT NULL,
  `restotableID` int(11) NOT NULL,
  `restotableName` varchar(100) DEFAULT NULL,
  `pwd` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restotable`
--

INSERT INTO `restotable` (`restoID`, `restotableID`, `restotableName`, `pwd`) VALUES
(2, 1, 'HMFtable01', '12345'),
(2, 2, 'HMFtable02', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tableorder`
--

CREATE TABLE `tableorder` (
  `tableID` int(11) DEFAULT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `adminName` (`adminName`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `menutype`
--
ALTER TABLE `menutype`
  ADD PRIMARY KEY (`menuTypeID`),
  ADD KEY `restoID` (`restoID`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `resto`
--
ALTER TABLE `resto`
  ADD PRIMARY KEY (`restoID`),
  ADD UNIQUE KEY `orderTableName` (`orderTableName`);

--
-- Indexes for table `restoadmin`
--
ALTER TABLE `restoadmin`
  ADD PRIMARY KEY (`restoadminID`),
  ADD KEY `restoID` (`restoID`);

--
-- Indexes for table `restokitchen`
--
ALTER TABLE `restokitchen`
  ADD PRIMARY KEY (`restokitchenID`),
  ADD KEY `restoID` (`restoID`);

--
-- Indexes for table `restotable`
--
ALTER TABLE `restotable`
  ADD PRIMARY KEY (`restotableID`),
  ADD KEY `restoID` (`restoID`);

--
-- Indexes for table `tableorder`
--
ALTER TABLE `tableorder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `tableID` (`tableID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menutype`
--
ALTER TABLE `menutype`
  MODIFY `menuTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resto`
--
ALTER TABLE `resto`
  MODIFY `restoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restoadmin`
--
ALTER TABLE `restoadmin`
  MODIFY `restoadminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `restokitchen`
--
ALTER TABLE `restokitchen`
  MODIFY `restokitchenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restotable`
--
ALTER TABLE `restotable`
  MODIFY `restotableID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
