-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2023 at 08:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topik_4`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_loker`
--

CREATE TABLE `apply_loker` (
  `idapply` varchar(20) NOT NULL,
  `idloker` varchar(20) NOT NULL,
  `noktp` int(17) NOT NULL,
  `tgl_apply` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apply_loker`
--

INSERT INTO `apply_loker` (`idapply`, `idloker`, `noktp`, `tgl_apply`) VALUES
('apply01', '1', 12345, '23 Oktober 2023');

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `idloker` varchar(20) NOT NULL,
  `idperusahaan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `usia_min` int(11) NOT NULL,
  `usia_max` int(11) NOT NULL,
  `gaji_min` int(20) NOT NULL,
  `gaji_max` int(25) NOT NULL,
  `nama_cp` varchar(30) NOT NULL,
  `email_cp` varchar(50) NOT NULL,
  `no_telp_cp` int(15) NOT NULL,
  `tgl_update` varchar(30) NOT NULL,
  `tgl_aktif` varchar(30) NOT NULL,
  `tgl_tutup` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`idloker`, `idperusahaan`, `nama`, `tipe`, `usia_min`, `usia_max`, `gaji_min`, `gaji_max`, `nama_cp`, `email_cp`, `no_telp_cp`, `tgl_update`, `tgl_aktif`, `tgl_tutup`, `status`) VALUES
('1', 'p1', 'IT Support', 'full-time', 18, 40, 2000, 8000, 'rozak', 'rozak@gmail.com', 81234, '22 Oktober 2023', '29 Oktober 2023', '5 November 2023', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pencaker`
--

CREATE TABLE `pencaker` (
  `noktp` int(17) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` int(15) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `tgl_daftar` varchar(30) NOT NULL,
  `file_ktp` varchar(20) NOT NULL,
  `idtahapan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencaker`
--

INSERT INTO `pencaker` (`noktp`, `nama`, `password`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `kota`, `email`, `no_telp`, `foto`, `tgl_daftar`, `file_ktp`, `idtahapan`) VALUES
(12345, 'Victor', 'victor123', 'L', 'Wonogiri', '1 Januari 2003', 'Solo, kartosuro', 'Semarang', 'piktor@gmail.com', 8123456, 'piktor.jpg', '23 Oktober 2023', 'ktppiktor.jpg', 't1');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `idperusahaan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`idperusahaan`, `nama`) VALUES
('p1', 'PT Djarum');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idpetugas` varchar(20) NOT NULL,
  `nama` char(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `email`, `password`) VALUES
('001', 'Daril', 'daril@gmail.com', 'daril123');

-- --------------------------------------------------------

--
-- Table structure for table `tahapan`
--

CREATE TABLE `tahapan` (
  `idtahapan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahapan`
--

INSERT INTO `tahapan` (`idtahapan`, `nama`) VALUES
('t1', 'wawancara');

-- --------------------------------------------------------

--
-- Table structure for table `tahapan_apply`
--

CREATE TABLE `tahapan_apply` (
  `idapply` varchar(20) NOT NULL,
  `idtahapan` varchar(20) NOT NULL,
  `nilai` varchar(20) NOT NULL,
  `tgl_update` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahapan_apply`
--

INSERT INTO `tahapan_apply` (`idapply`, `idtahapan`, `nilai`, `tgl_update`) VALUES
('apply01', 't1', 'Bagus', '24 Oktober 2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_loker`
--
ALTER TABLE `apply_loker`
  ADD PRIMARY KEY (`idapply`),
  ADD KEY `idloker` (`idloker`),
  ADD KEY `noktp` (`noktp`);

--
-- Indexes for table `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`idloker`),
  ADD KEY `idperusahaan` (`idperusahaan`);

--
-- Indexes for table `pencaker`
--
ALTER TABLE `pencaker`
  ADD PRIMARY KEY (`noktp`),
  ADD KEY `idtahapan` (`idtahapan`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`idperusahaan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`);

--
-- Indexes for table `tahapan`
--
ALTER TABLE `tahapan`
  ADD PRIMARY KEY (`idtahapan`);

--
-- Indexes for table `tahapan_apply`
--
ALTER TABLE `tahapan_apply`
  ADD KEY `idtahapan` (`idtahapan`),
  ADD KEY `idapply` (`idapply`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pencaker`
--
ALTER TABLE `pencaker`
  MODIFY `noktp` int(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12346;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply_loker`
--
ALTER TABLE `apply_loker`
  ADD CONSTRAINT `apply_loker_ibfk_1` FOREIGN KEY (`idloker`) REFERENCES `loker` (`idloker`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apply_loker_ibfk_2` FOREIGN KEY (`noktp`) REFERENCES `pencaker` (`noktp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loker`
--
ALTER TABLE `loker`
  ADD CONSTRAINT `loker_ibfk_1` FOREIGN KEY (`idperusahaan`) REFERENCES `perusahaan` (`idperusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pencaker`
--
ALTER TABLE `pencaker`
  ADD CONSTRAINT `pencaker_ibfk_1` FOREIGN KEY (`idtahapan`) REFERENCES `tahapan` (`idtahapan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tahapan_apply`
--
ALTER TABLE `tahapan_apply`
  ADD CONSTRAINT `tahapan_apply_ibfk_1` FOREIGN KEY (`idtahapan`) REFERENCES `tahapan` (`idtahapan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tahapan_apply_ibfk_2` FOREIGN KEY (`idapply`) REFERENCES `apply_loker` (`idapply`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
