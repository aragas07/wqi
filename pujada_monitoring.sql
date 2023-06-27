-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 10:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pujada_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `idclass` int(11) NOT NULL,
  `Class` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`idclass`, `Class`) VALUES
(1, 'AA'),
(2, 'A'),
(3, 'B'),
(4, 'C'),
(5, 'D'),
(6, 'SA'),
(7, 'SB'),
(8, 'SC'),
(9, 'SD');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_report`
--

CREATE TABLE `monthly_report` (
  `idmonthly_report` int(11) NOT NULL,
  `Parameter_No` varchar(45) NOT NULL,
  `Station_No` varchar(45) NOT NULL,
  `January` varchar(45) NOT NULL DEFAULT '-',
  `February` varchar(45) NOT NULL DEFAULT '-',
  `March` varchar(45) NOT NULL DEFAULT '-',
  `April` varchar(45) NOT NULL DEFAULT '-',
  `May` varchar(45) NOT NULL DEFAULT '-',
  `June` varchar(45) NOT NULL DEFAULT '-',
  `July` varchar(45) NOT NULL DEFAULT '-',
  `August` varchar(45) NOT NULL DEFAULT '-',
  `September` varchar(45) NOT NULL DEFAULT '-',
  `October` varchar(45) NOT NULL DEFAULT '-',
  `November` varchar(45) NOT NULL DEFAULT '-',
  `December` varchar(45) NOT NULL DEFAULT '-',
  `CY` year(4) NOT NULL,
  `wqg` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_report`
--

INSERT INTO `monthly_report` (`idmonthly_report`, `Parameter_No`, `Station_No`, `January`, `February`, `March`, `April`, `May`, `June`, `July`, `August`, `September`, `October`, `November`, `December`, `CY`, `wqg`) VALUES
(1, '0001', '1a', '1', '7', '4', '-', '-', '-', '-', '-', '-', '-', '-', '-', 2023, 'SA'),
(2, '0004', '1a', '77', '7', '1', '-', '-', '-', '-', '-', '-', '-', '-', '-', 2023, 'SB'),
(3, '0009', '1a', '', '30', '30', '-', '-', '-', '-', '-', '-', '-', '-', '-', 2023, 'SC'),
(4, '0006', '1a', '-', '-', '-', '167 ', '-', '-', '-', '-77', '-11', '-', '-', '-', 2023, 'SD'),
(5, '0003', '1a', '-', '-', '-', '-', '777', '-', '88', '-', '-71', '-', '-', '-', 2023, 'SA'),
(6, '0008', '1a', '-', '-', '-', '151', '-', '-', '-', '-', '-', '-', '-', '-', 2023, 'SS'),
(7, '0010', '1a', '-', '-', '-', '-', '-', '70', '-', '-', '-', '-', '-', '-', 2023, 'SA');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `idnotes` int(11) NOT NULL,
  `notes` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`idnotes`, `notes`) VALUES
(1, 'MPN/100mL - Most Probable Number per 100 milliliter'),
(2, 'n/a - Not Applicable'),
(3, 'TCU - True Color Unit'),
(4, '(a) Samples shall be taken from 9:00 AM to 4:00 PM.'),
(5, '(b) The natural background temperature as detemined by EMB shall prevail if the temperature is lower or higher than the WQG; provided that the maximum increase is only up to 10 percent and that it will not cause any risk to human health and the ');

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `idparameter` int(11) NOT NULL,
  `Parameter_No` varchar(45) NOT NULL,
  `Parameter_Acronym` varchar(45) NOT NULL,
  `Parameter` varchar(45) NOT NULL,
  `Unit` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`idparameter`, `Parameter_No`, `Parameter_Acronym`, `Parameter`, `Unit`) VALUES
(0, '0001', 'DO', 'Dissolved Oxygen(a) Minimum', 'mg/L'),
(0, '0002', 'BOD', 'BOD', 'mg/L'),
(0, '0003', 'Color', 'Color', 'TCU'),
(0, '0004', 'pH', 'pH(Range)', ''),
(0, '0005', 'Chloride', 'Chloride', 'mg/L'),
(0, '0006', 'FC', 'Fecal Coliform', 'MPN/100mL'),
(0, '0007', 'Nitrate as NO3-N', 'Nitrate', 'mg/L'),
(0, '0008', 'Phosphate', 'Phosphate', 'mg/L'),
(0, '0009', 'Temp', 'Temperature(b)', '°C'),
(0, '0010', 'TSS', 'Total Suspended Solids', 'mg/L'),
(0, '0011', 'ZZ', 'Sample', 'MG/L'),
(0, '0013', 'Z', 'Sam', 'MG/L');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `idregion` int(11) NOT NULL,
  `Region_No` varchar(45) NOT NULL,
  `Region_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`idregion`, `Region_No`, `Region_Name`) VALUES
(11, '0011', 'XI');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `idstation` int(11) NOT NULL,
  `Region_No` varchar(45) NOT NULL,
  `Station_No` varchar(45) NOT NULL,
  `Station_Identification` varchar(245) NOT NULL,
  `Latitude` varchar(145) NOT NULL,
  `Longitude` varchar(145) NOT NULL,
  `Class` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`idstation`, `Region_No`, `Station_No`, `Station_Identification`, `Latitude`, `Longitude`, `Class`) VALUES
(1, '0011', '1a', 'At Brgy. Lawigan', '6°48’14.43”N', '126°18’39.37”E', 'SA'),
(2, '0011', '1', 'At. Brgy Tamisan, Approx. 37m from the shoreline at Low Tide', '6°50’42.40”N', '126°17’8.94”E', 'SA'),
(9, '0011', '2', 'At Gregorio Beach Resort, Brgy. Bobon, Approx. 80m from the shorline at Low Tide', '6°52’0.21”N', '126°17’41.02”E', 'SB'),
(13, '0011', '3', 'At Bajia Beach Resort, Brgy. Dahican, Approx. 37m from the shoreline at Low Tide', '6°53’4.66”N', '126°16’19.03”E', 'SB'),
(14, '0011', '4', 'At Brgy. maitom, Approx. 15m from the shoreline at Low Tide', '6°55’45.60”N', '126°15’38.34”E', 'SC'),
(15, '0011', '5', 'At Brgy. Matiao near Interco, Approx. 40m from the shoreline at Low Tide', '6°56’11.81”N', '126°14’31.07”E', 'SC'),
(16, '0011', '6', 'At Brgy. Central, near the Public Market, Approx. 2m from the shoreline at Low Tide ', '6°57’9.42”N', '126°12’26.60”E', 'SB'),
(17, '0011', '7', 'At Brgy. Badas, near Sunrise Beach Resort, Approx. 15m from the shoreline at High Tide', '6°56’24.84”N', '126°11’27.64”E', 'SB'),
(18, '0011', '8', 'At Balete Bay at Brgy. Mamali, Approx. 2m from the shoreline at High Tide', '6°52’43.94”N', '126°10’15.62”E', 'SC'),
(19, '0011', '9', 'At Sitio Tambak, Brgy. Macambol, Approx. 18m from the shoreline at High Tide', '6°48’45.13”N', '126°12’50.65”E', 'SA'),
(20, 'Select..', '234', '324', '13°4’1”E', '7°7’7”N', 'AA'),
(21, '0011', '14', 'ambot', '7°7’7”E', '7°7’7”N', 'AA'),
(22, '0011', 'a', '1', '1°4’1”4', '1°1’1”1', 'AA'),
(23, '0011', 'ad', 'as', '1°4’5”N', '2°1’5”E', 'AA'),
(30, '0011', '151', '15', '1°1’1”N', '4°2’1”E', 'AA'),
(36, '0011', 'ewrr', '32414', '1°1’1”N', '4°1’1”E', 'AA'),
(37, '0011', '1777', '16437', '1°1’1”N', '4°1’1”E', 'B'),
(38, '0011', '1451', '154678', '1°11’9”N', '1°1’1”E', 'AA'),
(39, 'Select..', '091', '146889', '1°1’1”1', '1°1’1”1', 'AA'),
(40, '0011', '23477', '777777', '1°1’1”1', '1°1’1”1', 'AA'),
(41, '0011', '5277', '777', '1°1’1”1', '1°1’1”1', 'AA');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `No_User` int(11) NOT NULL,
  `User_ID` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Firstname` varchar(45) NOT NULL,
  `Lastname` varchar(45) NOT NULL,
  `Middlename` varchar(45) NOT NULL,
  `Suffix` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Account_Type` varchar(45) NOT NULL,
  `img` varchar(45) NOT NULL DEFAULT 'prof.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`No_User`, `User_ID`, `Username`, `Firstname`, `Lastname`, `Middlename`, `Suffix`, `Email`, `Password`, `Account_Type`, `img`) VALUES
(1, '0000-0000', 'Sample', 'Sample', 'Sample', 'Sample', 'Sample', 'Sample@gmail.com', 'Sample', 'Admin', 'prof.png'),
(8, '0000-0002', 'edd', 'edi ikaw', 'edd', 'edd', 'edd', 'Sample123@gmail.com', 'eddd123', 'Admin', 'prof.png'),
(9, '0000-0003', 'grego', 'argie', 'ragas', 'N/A', 'N/A', 'argieragasd8d7@gmail.com', 'argie', 'Admin', 'prof.png');

-- --------------------------------------------------------

--
-- Table structure for table `water_body_classification`
--

CREATE TABLE `water_body_classification` (
  `idwater_body_classification` int(11) NOT NULL,
  `Parameter_No` varchar(45) NOT NULL,
  `SA` varchar(45) NOT NULL DEFAULT 'n/a',
  `SB` varchar(45) NOT NULL DEFAULT 'n/a',
  `SC` varchar(45) NOT NULL DEFAULT 'n/a',
  `SD` varchar(45) NOT NULL DEFAULT 'n/a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_body_classification`
--

INSERT INTO `water_body_classification` (`idwater_body_classification`, `Parameter_No`, `SA`, `SB`, `SC`, `SD`) VALUES
(1, '0002', 'n/a', 'n/a', 'n/a', 'n/a'),
(2, '0003', '5', '50', '75', '150'),
(3, '0001', '6', '6', '5', '2'),
(4, '0004', '7.0-8.5', '7.0-8.5', '6.5-8.5', '6.0-9.0'),
(5, '0005', 'n/a', 'n/a', 'n/a', 'n/a'),
(6, '0006', '<1.1', '100', '200', '400'),
(7, '0007', '10', '10', '10', '15'),
(8, '0008', '0.1', '0.5', '0.5', '5'),
(9, '0009', '26-30', '26-30', '25-31', '25-32'),
(10, '0010', '25', '50', '80', '110'),
(11, '0011', '1', '1', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`idclass`,`Class`),
  ADD UNIQUE KEY `Class_UNIQUE` (`Class`);

--
-- Indexes for table `monthly_report`
--
ALTER TABLE `monthly_report`
  ADD PRIMARY KEY (`idmonthly_report`,`Parameter_No`,`Station_No`),
  ADD KEY `Parameter_No_idx` (`Parameter_No`),
  ADD KEY `Station_No_idx` (`Station_No`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`idnotes`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`idparameter`,`Parameter_No`,`Parameter_Acronym`,`Parameter`),
  ADD UNIQUE KEY `Parameter_No_UNIQUE` (`Parameter_No`),
  ADD UNIQUE KEY `Parameter_Acronym_UNIQUE` (`Parameter_Acronym`),
  ADD UNIQUE KEY `Parameter_Identification_UNIQUE` (`Parameter`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`idregion`,`Region_No`,`Region_Name`),
  ADD UNIQUE KEY `Region_Name_UNIQUE` (`Region_Name`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`idstation`,`Station_No`,`Region_No`),
  ADD UNIQUE KEY `Station Identifacation_UNIQUE` (`Station_Identification`),
  ADD UNIQUE KEY `Station_No_UNIQUE` (`Station_No`),
  ADD KEY `Region_No_idx` (`Region_No`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`No_User`,`User_ID`,`Username`),
  ADD UNIQUE KEY `username_UNIQUE` (`Username`),
  ADD UNIQUE KEY `User_ID_UNIQUE` (`User_ID`);

--
-- Indexes for table `water_body_classification`
--
ALTER TABLE `water_body_classification`
  ADD PRIMARY KEY (`idwater_body_classification`,`Parameter_No`),
  ADD KEY `Parameter_No_idx` (`Parameter_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `idclass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `monthly_report`
--
ALTER TABLE `monthly_report`
  MODIFY `idmonthly_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `idnotes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `idregion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `idstation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `No_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `water_body_classification`
--
ALTER TABLE `water_body_classification`
  MODIFY `idwater_body_classification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `water_body_classification`
--
ALTER TABLE `water_body_classification`
  ADD CONSTRAINT `Parameter_No` FOREIGN KEY (`Parameter_No`) REFERENCES `parameter` (`Parameter_No`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
