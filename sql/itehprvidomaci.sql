-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 12:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itehprvidomaci`
--

-- --------------------------------------------------------

--
-- Table structure for table `doktor`
--

CREATE TABLE `doktor` (
  `id_doktora` int(11) NOT NULL,
  `ime_prez` varchar(51) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doktor`
--

INSERT INTO `doktor` (`id_doktora`, `ime_prez`) VALUES
(1, 'Mirko Spasic'),
(2, 'Ana Stanic'),
(3, 'Zeljko Mirkovic'),
(4, 'Jovana Djeric'),
(5, 'Marija Milic'),
(6, 'Stefan Kocic');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `sifra` int(11) NOT NULL,
  `kor_ime` varchar(20) NOT NULL,
  `lozinka` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`sifra`, `kor_ime`, `lozinka`) VALUES
(1, 'admin', 'admin'),
(2, 'stanmil', '123abc'),
(3, 'elab', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `id_prijave` int(11) NOT NULL,
  `odeljenje` varchar(30) DEFAULT NULL,
  `sala` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `id_korisnika` int(11) DEFAULT NULL,
  `id_doktora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`id_prijave`, `odeljenje`, `sala`, `datum`, `id_korisnika`, `id_doktora`) VALUES
(1, 'logopedija', 30, '2022-12-08', 3, 1),
(2, 'logopedija', 111, '2022-12-03', 3, 4),
(3, 'logopedija', 111, '2022-12-03', 3, 4),
(4, 'Otorinolaringologija', 111, '2022-12-10', 3, 2),
(5, 'logopedija', 15, '2022-12-10', 3, 1),
(6, 'logopedija', 435, '2022-12-03', 1, 2),
(7, 'Torakalno', 111, '2022-12-10', 2, 2),
(8, 'Otorinolaringologija', 30, '2022-12-08', 2, 4),
(9, 'Stomatologija', 435, '2022-12-09', 2, 3),
(10, 'logopedija', 111, '2022-12-10', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doktor`
--
ALTER TABLE `doktor`
  ADD PRIMARY KEY (`id_doktora`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`sifra`);

--
-- Indexes for table `prijava`
--
ALTER TABLE `prijava`
  ADD PRIMARY KEY (`id_prijave`),
  ADD KEY `id_korisnika` (`id_korisnika`),
  ADD KEY `id_doktora` (`id_doktora`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `prijava_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`sifra`),
  ADD CONSTRAINT `prijava_ibfk_2` FOREIGN KEY (`id_doktora`) REFERENCES `doktor` (`id_doktora`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
