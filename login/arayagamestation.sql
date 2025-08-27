-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 03:35 PM
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
-- Database: `arayagamestation`
--

-- --------------------------------------------------------

--
-- Table structure for table `input_poin`
--

CREATE TABLE `input_poin` (
  `id_poin` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `cabang` varchar(20) NOT NULL,
  `operator` varchar(30) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `point` varchar(20) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input_poin`
--

INSERT INTO `input_poin` (`id_poin`, `id_member`, `cabang`, `operator`, `pembayaran`, `point`, `tanggal_input`) VALUES
(30, 60, 'Manarap', 'Rommy Gunawan', 'Cash', '100', '2025-08-27 07:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `cabang` varchar(20) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `memberid` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `wa` varchar(20) NOT NULL,
  `tier` varchar(20) NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `expired` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `semua_point` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `cabang`, `operator`, `memberid`, `nama`, `gender`, `wa`, `tier`, `start`, `expired`, `status`, `pembayaran`, `semua_point`) VALUES
(60, 'Manarap', 'Rommy Gunawan', 'soHSf1ir', 'Daffa Bungas', 'Laki - laki', '082150719057', 'Bronze', '2025-08-27 07:17:05', '2025-07-26', 'Tidak Aktif', 'Cash', '100'),
(61, 'Manarap', 'Yuda', 'VYiaaibJ', 'zuraida', 'Perempuan', '082150719057', 'Gold', '2025-08-27 07:17:48', '2026-02-23', 'Aktif', 'Cash', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `cabang` varchar(30) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `cabang`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'Manarap', 'Rommy Gunawan', 'admin', 'admin', 'admin'),
(2, 'Manarap', 'Yuda', 'y', 'y', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input_poin`
--
ALTER TABLE `input_poin`
  ADD PRIMARY KEY (`id_poin`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `input_poin`
--
ALTER TABLE `input_poin`
  MODIFY `id_poin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
