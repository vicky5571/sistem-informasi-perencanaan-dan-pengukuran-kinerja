-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 06:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipuja`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengukuran`
--

CREATE TABLE `pengukuran` (
  `id` int(9) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL,
  `capaian_kinerja` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengukuran`
--

INSERT INTO `pengukuran` (`id`, `unit_kerja`, `tahun`, `capaian_kinerja`) VALUES
(1, 'Badan Kependudukan dan Keluarga Berencana Nasional (BKKBN)', 2022, 'W1,TW2'),
(2, 'Unit Kerja 2', 2024, 'TW2');

-- --------------------------------------------------------

--
-- Table structure for table `perencanaan`
--

CREATE TABLE `perencanaan` (
  `id` int(50) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perencanaan`
--

INSERT INTO `perencanaan` (`id`, `unit_kerja`, `tahun`) VALUES
(1, 'Badan Kependudukan dan Keluarga Berencana Nasional (BKKBN)', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `perjanjian`
--

CREATE TABLE `perjanjian` (
  `id` int(9) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perjanjian`
--

INSERT INTO `perjanjian` (`id`, `unit_kerja`, `tahun`) VALUES
(1, 'Badan Kependudukan dan Keluarga Berencana Nasional (BKKBN)', 2021),
(2, 'Sekretariat Utama', 2021),
(3, 'Irspektorat Utama', 2022),
(4, 'UKE 1', 2021),
(5, 'UKE 2', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_satker`
--

CREATE TABLE `realisasi_satker` (
  `nama_satker` varchar(250) NOT NULL,
  `persentase` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `realisasi_satker`
--

INSERT INTO `realisasi_satker` (`nama_satker`, `persentase`) VALUES
('Bidang Keluarga Sejahtera dan Pemberdayaan Keluarga', 44.1),
('Bidang Pengendalian Penduduk', 46.5),
('Bidang Keluarga Berencana dan Kesehatan Reproduksi', 55.1),
('Bidang Advokasi, Penggerakan dan Informasi', 62.25),
('Direktorat Komunikasi, Informasi, dan Edukasi', 63.1),
('Bidang Pelatihan, Penelitian dan Pengembangan', 40.48),
('Pusat Pendidikan dan Pelatihan KKB', 42.1),
('Sekretariat Utama', 65.55),
('Inspektorat Utama', 51.75);

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_satker_line`
--

CREATE TABLE `realisasi_satker_line` (
  `date` varchar(10) NOT NULL,
  `persentase` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `realisasi_satker_line`
--

INSERT INTO `realisasi_satker_line` (`date`, `persentase`) VALUES
('Jan-23', 5.55),
('Feb-23', 10.12),
('Mar-23', 25.25),
('Apr-23', 30.4),
('May-23', 44.75),
('Jun-23', 52.25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perencanaan`
--
ALTER TABLE `perencanaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perjanjian`
--
ALTER TABLE `perjanjian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perencanaan`
--
ALTER TABLE `perencanaan`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perjanjian`
--
ALTER TABLE `perjanjian`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
