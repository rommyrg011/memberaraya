-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2025 at 02:39 PM
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
(22, 'Beruntung', 'Rommy Gunawan', 'NlvY6I7O', 'Daffa Bungas', 'Laki - laki', '75675', 'Silver', '2025-08-16 16:00:00', '2025-07-15', 'Tidak Aktif', 'QRIS', '900'),
(44, 'Manarap', 'Yuda', 'y3VXAsm9', 'mentes', 'Laki - laki', '75675', 'Silver', '2025-08-19 16:00:00', '2025-11-18', 'Aktif', 'Cash', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
