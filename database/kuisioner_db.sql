-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 07:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuisioner_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jeniskuisioner`
--

CREATE TABLE `tb_jeniskuisioner` (
  `id_jenisKuisioner` varchar(100) NOT NULL,
  `id_kuisioner` varchar(100) NOT NULL,
  `jenis_kuisoner` text NOT NULL,
  `jumlah_pertanyaan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuisioner`
--

CREATE TABLE `tb_kuisioner` (
  `id_kuisioner` varchar(100) NOT NULL,
  `judul` text NOT NULL,
  `lokasi` text NOT NULL,
  `tahun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kuisioner`
--

INSERT INTO `tb_kuisioner` (`id_kuisioner`, `judul`, `lokasi`, `tahun`) VALUES
('1832', 'Analisis Kualitas Pelayanan pada Bandara Djalaludin di Provinsi Gorontalo', 'Bandara Djaluludin', '2022'),
('9512', 'isi dulu dang', 'dimana aja', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id_pertanyaan` varchar(100) NOT NULL,
  `id_jenisKuisioner` varchar(100) NOT NULL,
  `item_pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jeniskuisioner`
--
ALTER TABLE `tb_jeniskuisioner`
  ADD PRIMARY KEY (`id_jenisKuisioner`),
  ADD KEY `id_kuisioner` (`id_kuisioner`);

--
-- Indexes for table `tb_kuisioner`
--
ALTER TABLE `tb_kuisioner`
  ADD PRIMARY KEY (`id_kuisioner`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_kuisioner` (`id_jenisKuisioner`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
