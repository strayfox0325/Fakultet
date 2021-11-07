-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2021 at 06:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fakultet`
--

-- --------------------------------------------------------

--
-- Table structure for table `ispiti`
--

CREATE TABLE `ispiti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ispiti`
--

INSERT INTO `ispiti` (`id`, `naziv`) VALUES
(1, 'OIKT'),
(2, 'Ekonomija');

-- --------------------------------------------------------

--
-- Table structure for table `polozeni_ispiti`
--

CREATE TABLE `polozeni_ispiti` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `ispit_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `datum` varchar(120) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profesori`
--

CREATE TABLE `profesori` (
  `id` int(11) NOT NULL,
  `ime` varchar(120) NOT NULL,
  `prezime` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profesori`
--

INSERT INTO `profesori` (`id`, `ime`, `prezime`) VALUES
(1, 'Dejan', 'Lukic'),
(2, 'Dragan', 'Lazic');

-- --------------------------------------------------------

--
-- Table structure for table `smerovi`
--

CREATE TABLE `smerovi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smerovi`
--

INSERT INTO `smerovi` (`id`, `naziv`) VALUES
(1, 'ISIT'),
(2, 'OM');

-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

CREATE TABLE `studenti` (
  `id` int(11) NOT NULL,
  `ime` varchar(120) NOT NULL,
  `prezime` varchar(120) NOT NULL,
  `jmbg` varchar(13) NOT NULL,
  `broj_indeksa` varchar(10) NOT NULL,
  `godina_upisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studenti`
--

INSERT INTO `studenti` (`id`, `ime`, `prezime`, `jmbg`, `broj_indeksa`, `godina_upisa`) VALUES
(4, 'Isidora', 'Lazic', '1234748294672', '192', 2018),
(5, 'Marija', 'Jovic', '1746398789502', '362', 2018),
(12, 'Ana', 'Markovic', '8472625364732', '553', 2017),
(14, 'Marija', 'Jovic', '5847385849495', '111', 2019);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ispiti`
--
ALTER TABLE `ispiti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polozeni_ispiti`
--
ALTER TABLE `polozeni_ispiti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Polozeni ispiti_fk_1` (`student_id`),
  ADD KEY `Polozeni ispiti_fk_2` (`ispit_id`),
  ADD KEY `Polozeni ispiti_fk_3` (`profesor_id`);

--
-- Indexes for table `profesori`
--
ALTER TABLE `profesori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smerovi`
--
ALTER TABLE `smerovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ispiti`
--
ALTER TABLE `ispiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `polozeni_ispiti`
--
ALTER TABLE `polozeni_ispiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profesori`
--
ALTER TABLE `profesori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `smerovi`
--
ALTER TABLE `smerovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `polozeni_ispiti`
--
ALTER TABLE `polozeni_ispiti`
  ADD CONSTRAINT `Polozeni ispiti_fk_1` FOREIGN KEY (`student_id`) REFERENCES `studenti` (`id`),
  ADD CONSTRAINT `Polozeni ispiti_fk_2` FOREIGN KEY (`ispit_id`) REFERENCES `ispiti` (`id`),
  ADD CONSTRAINT `Polozeni ispiti_fk_3` FOREIGN KEY (`profesor_id`) REFERENCES `profesori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
