-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 10:52 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `email_guru` char(50) NOT NULL,
  `nama_guru` char(80) NOT NULL,
  `id_kelas` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`email_guru`, `nama_guru`, `id_kelas`, `status`) VALUES
('apriadiwijaya9e3@gmail.com', 'Willy', 4, 1),
('willychai04@gmail.com', 'LOL', 2, 1),
('willychai05@gmail.com', 'Willy', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` tinyint(3) UNSIGNED NOT NULL,
  `nama_kelas` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'P1 Empathy'),
(2, 'P1 Integrity'),
(3, 'P2 Enthusiasm'),
(4, 'P2 Respect'),
(5, 'P3 Independence'),
(6, 'P3 Tolerance'),
(7, 'P4 Inquirers'),
(8, 'P4 Communicator'),
(9, 'P5 Knowledgeable'),
(10, 'P5 Principled'),
(11, 'P6 Open-Minded'),
(12, 'P6 Thinker');

-- --------------------------------------------------------

--
-- Table structure for table `ortu`
--

CREATE TABLE `ortu` (
  `email` char(100) NOT NULL,
  `pass` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ortu`
--

INSERT INTO `ortu` (`email`, `pass`) VALUES
('willychai05@gmail.com', '5c4330d2455f1d57b9ac118c058b752b78dcf956');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_report` mediumint(8) UNSIGNED NOT NULL,
  `nik` int(10) UNSIGNED NOT NULL,
  `id_kelas` tinyint(3) UNSIGNED NOT NULL,
  `mid1` char(255) DEFAULT NULL,
  `term1` char(255) DEFAULT NULL,
  `mid2` char(255) DEFAULT NULL,
  `term2` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id_report`, `nik`, `id_kelas`, `mid1`, `term1`, `mid2`, `term2`) VALUES
(1, 12391283, 1, '../tbuser/rapot/154e4b78ffb8702121c6f72f43b85bee2.pdf', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nik` int(10) UNSIGNED NOT NULL,
  `nama` char(70) NOT NULL,
  `id_kelas` tinyint(3) UNSIGNED NOT NULL,
  `user` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nik`, `nama`, `id_kelas`, `user`) VALUES
(12391283, 'Willy', 1, 'willychai05@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` char(50) NOT NULL,
  `pass` char(100) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `pass`, `status`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0),
('apriadiwijaya9e3@gmail.com', '7cf54730eefbd4872ec7b26cb7fc0669059de779', 1),
('willy', '990c37a323daf1549bdd24197927625080ee16b8', 1),
('willychai04@gmail.com', '953e4a1edc765f855cf70e948a9b2f5f9cfb7f63', 1),
('willychai05@gmail.com', 'fe40c1bce5c507adba9505907d84f9f7eb0e0acf', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`email_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `ortu`
--
ALTER TABLE `ortu`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
