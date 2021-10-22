-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 12:54 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateCreated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Id`, `firstName`, `lastName`, `email`, `password`, `dateCreated`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admins', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `Id` int(10) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`Id`, `categoryName`, `description`, `dateCreated`) VALUES
(3, 'Life Insurance', 'For life insurancessss', '2021-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicy`
--

CREATE TABLE `tblpolicy` (
  `Id` int(10) NOT NULL,
  `categoryId` varchar(10) NOT NULL,
  `subCategoryId` varchar(10) NOT NULL,
  `policyNumber` varchar(255) NOT NULL,
  `policyName` varchar(255) NOT NULL,
  `sumAssured` varchar(50) NOT NULL,
  `premiumTermId` varchar(50) NOT NULL,
  `premiumAmount` varchar(50) NOT NULL,
  `interest` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpolicy`
--

INSERT INTO `tblpolicy` (`Id`, `categoryId`, `subCategoryId`, `policyNumber`, `policyName`, `sumAssured`, `premiumTermId`, `premiumAmount`, `interest`, `description`, `dateCreated`) VALUES
(4, '3', '1', '123444', 'Full Policy', '12300', '2', '2100', '1000', 'For life insurances', '2021-09-18'),
(5, '3', '2', '121000', 'another policy', '19000', '3', '21003', '700', 'testing', '2021-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicyreg`
--

CREATE TABLE `tblpolicyreg` (
  `Id` int(10) NOT NULL,
  `policyId` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `isApproved` varchar(50) NOT NULL,
  `isCompleted` varchar(50) NOT NULL,
  `isPaid` varchar(20) NOT NULL,
  `dateCreated` varchar(50) NOT NULL,
  `dateApproved` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpolicyreg`
--

INSERT INTO `tblpolicyreg` (`Id`, `policyId`, `userId`, `isApproved`, `isCompleted`, `isPaid`, `dateCreated`, `dateApproved`) VALUES
(4, '4', '2', '2', '0', '1', '2021-09-18', '2021-09-19'),
(6, '5', '2', '0', '0', '0', '2021-09-18', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicyregpayments`
--

CREATE TABLE `tblpolicyregpayments` (
  `Id` int(10) NOT NULL,
  `policyRegId` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `amountPaid` varchar(50) NOT NULL,
  `bankName` varchar(255) NOT NULL,
  `accountName` varchar(255) NOT NULL,
  `accountNumber` varchar(255) NOT NULL,
  `depositorsName` varchar(255) NOT NULL,
  `datePaid` varchar(50) NOT NULL,
  `paymentDetails` varchar(255) NOT NULL,
  `isApproved` varchar(10) NOT NULL,
  `dateApproved` varchar(50) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpolicyregpayments`
--

INSERT INTO `tblpolicyregpayments` (`Id`, `policyRegId`, `userId`, `amountPaid`, `bankName`, `accountName`, `accountNumber`, `depositorsName`, `datePaid`, `paymentDetails`, `isApproved`, `dateApproved`, `dateCreated`) VALUES
(3, '4', '2', '120009', 'GTBank', 'Salami Adekunle', '0099882711', 'Salami Adekunle', '2021-09-24', 'testing', '2', '2021-09-19', '2021-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblpremiumterm`
--

CREATE TABLE `tblpremiumterm` (
  `Id` int(10) NOT NULL,
  `premiumTermName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpremiumterm`
--

INSERT INTO `tblpremiumterm` (`Id`, `premiumTermName`) VALUES
(1, 'Monthly'),
(2, 'Quarterly'),
(3, 'Annually');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `Id` int(10) NOT NULL,
  `categoryId` varchar(10) NOT NULL,
  `subCategoryName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`Id`, `categoryId`, `subCategoryName`, `description`, `dateCreated`) VALUES
(1, '3', 'Full Coverage', 'For all life insurance package', '2021-09-18'),
(2, '3', 'half coverage', 'Testing', '2021-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`Id`, `firstName`, `lastName`, `otherName`, `emailAddress`, `password`, `dob`, `gender`, `phone`, `address`, `state`, `dateCreated`) VALUES
(1, 'Samuel', 'Sam', 'Ola', 'Ahmedsodiq77@gmail.com', '', '12-09-1998', 'Male', '', '23,Agunlejika', 'Lagos', '2021-09-18'),
(2, 'Sadiqu', 'Bamidelesss', 'Kunlesky', 'test@gmail.com', '11111', '12-09-1998', 'Female', '099999998888', '22, Iseyin Street', 'Abeokuta', '2021-09-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblpolicy`
--
ALTER TABLE `tblpolicy`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblpolicyreg`
--
ALTER TABLE `tblpolicyreg`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblpolicyregpayments`
--
ALTER TABLE `tblpolicyregpayments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblpremiumterm`
--
ALTER TABLE `tblpremiumterm`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpolicy`
--
ALTER TABLE `tblpolicy`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpolicyreg`
--
ALTER TABLE `tblpolicyreg`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblpolicyregpayments`
--
ALTER TABLE `tblpolicyregpayments`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpremiumterm`
--
ALTER TABLE `tblpremiumterm`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
