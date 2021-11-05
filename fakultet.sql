-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2021 at 10:48 AM
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
-- Table structure for table `Ispiti`
--

CREATE TABLE `Ispiti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ispiti`
--

INSERT INTO `Ispiti` (`id`, `naziv`) VALUES
(1, 'OIKT');

-- --------------------------------------------------------

--
-- Table structure for table `Polozeni_ispiti`
--

CREATE TABLE `Polozeni_ispiti` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `ispit_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Profesori`
--

CREATE TABLE `Profesori` (
  `id` int(11) NOT NULL,
  `ime` varchar(120) NOT NULL,
  `prezime` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Profesori`
--

INSERT INTO `Profesori` (`id`, `ime`, `prezime`) VALUES
(1, 'Dejan', 'Lukic');

-- --------------------------------------------------------

--
-- Table structure for table `Smerovi`
--

CREATE TABLE `Smerovi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Smerovi`
--

INSERT INTO `Smerovi` (`id`, `naziv`) VALUES
(1, 'ISIT'),
(2, 'OM');

-- --------------------------------------------------------

--
-- Table structure for table `Studenti`
--

CREATE TABLE `Studenti` (
  `id` int(11) NOT NULL,
  `ime` varchar(120) NOT NULL,
  `prezime` varchar(120) NOT NULL,
  `jmbg` varchar(13) NOT NULL,
  `broj_indeksa` varchar(10) NOT NULL,
  `godina_upisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Studenti`
--

INSERT INTO `Studenti` (`id`, `ime`, `prezime`, `jmbg`, `broj_indeksa`, `godina_upisa`) VALUES
(4, 'Isidora', 'Lazic', '1234748294672', '192', 2018),
(5, 'Marija', 'Jovic', '1746398789502', '362', 2018),
(12, 'Ana', 'Markovic', '8472625364732', '553', 2017);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ispiti`
--
ALTER TABLE `Ispiti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Polozeni_ispiti`
--
ALTER TABLE `Polozeni_ispiti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Polozeni ispiti_fk_1` (`student_id`),
  ADD KEY `Polozeni ispiti_fk_2` (`ispit_id`),
  ADD KEY `Polozeni ispiti_fk_3` (`profesor_id`);

--
-- Indexes for table `Profesori`
--
ALTER TABLE `Profesori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Smerovi`
--
ALTER TABLE `Smerovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Studenti`
--
ALTER TABLE `Studenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ispiti`
--
ALTER TABLE `Ispiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Polozeni_ispiti`
--
ALTER TABLE `Polozeni_ispiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Profesori`
--
ALTER TABLE `Profesori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Smerovi`
--
ALTER TABLE `Smerovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Studenti`
--
ALTER TABLE `Studenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Polozeni_ispiti`
--
ALTER TABLE `Polozeni_ispiti`
  ADD CONSTRAINT `Polozeni ispiti_fk_1` FOREIGN KEY (`student_id`) REFERENCES `Studenti` (`id`),
  ADD CONSTRAINT `Polozeni ispiti_fk_2` FOREIGN KEY (`ispit_id`) REFERENCES `Ispiti` (`id`),
  ADD CONSTRAINT `Polozeni ispiti_fk_3` FOREIGN KEY (`profesor_id`) REFERENCES `Profesori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
