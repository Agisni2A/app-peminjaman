-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 05:44 AM
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
-- Database: `spl-inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpeminjaman`
--

CREATE TABLE `detailpeminjaman` (
  `detailPeminjamanId` bigint(11) NOT NULL,
  `Description` varchar(255) DEFAULT NULL COMMENT '0=tersedia 1=dipinjam',
  `status` enum('0','1') DEFAULT NULL COMMENT '0=tersedia 1=dipinjam	',
  `kodeItemId` varchar(255) NOT NULL,
  `peminjamanId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpeminjaman`
--

INSERT INTO `detailpeminjaman` (`detailPeminjamanId`, `Description`, `status`, `kodeItemId`, `peminjamanId`) VALUES
(12, 'Untuk digunakan dalam ruangan IT', '0', 'LP-22', 'PM-2446'),
(13, 'Untuk digunakan dalam ruangan IT', '0', 'MS-01', 'PM-2446'),
(14, 'Untuk digunakan dalam ruangan IT', '0', 'LP-22', 'PM-9982'),
(15, 'Untuk digunakan dalam ruangan IT', '0', 'MT-01', 'PM-9982'),
(16, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-9982'),
(17, 'Untuk digunakan dalam ruangan IT', '0', 'LP-22', 'PM-1300'),
(18, 'Untuk digunakan dalam ruangan IT', '0', 'MS-01', 'PM-1300'),
(19, 'Untuk digunakan dalam ruangan IT', '0', 'MT-01', 'PM-1300'),
(20, 'Untuk digunakan dalam ruangan IT', '0', 'LP-10', 'PM-1087'),
(21, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-1087'),
(22, 'Untuk digunakan dalam ruangan IT', '0', 'PC-87', 'PM-1087'),
(23, 'Untuk digunakan dalam ruangan IT', '0', 'LP-10', 'PM-5919'),
(24, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-5919'),
(25, 'Untuk digunakan dalam ruangan IT', '0', 'PC-87', 'PM-5919'),
(26, 'Untuk digunakan dalam ruangan IT', '0', 'LP-10', 'PM-2794'),
(27, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-2794'),
(28, 'Untuk digunakan dalam ruangan IT', '0', 'PC-87', 'PM-2794'),
(29, 'Untuk digunakan dalam ruangan IT', '0', 'LP-10', 'PM-3403'),
(30, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-3403'),
(31, 'Untuk digunakan dalam ruangan IT', '0', 'PC-87', 'PM-3403'),
(32, 'Untuk digunakan dalam ruangan IT', '0', 'LP-10', 'PM-9384'),
(33, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-9384'),
(34, 'Untuk digunakan dalam ruangan IT', '0', 'PC-87', 'PM-9384'),
(35, 'Untuk digunakan dalam ruangan IT', '0', 'LP-10', 'PM-1003'),
(36, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-1003'),
(37, 'Untuk digunakan dalam ruangan IT', '0', 'PC-87', 'PM-1003'),
(38, 'Untuk digunakan dalam ruangan IT', '0', 'LP-22', 'PM-5172'),
(39, 'Untuk digunakan dalam ruangan IT', '0', 'MS-01', 'PM-5172'),
(40, 'Untuk digunakan dalam ruangan IT', '0', 'PC-23', 'PM-5172'),
(41, 'Untuk digunakan dalam ruangan admin', '0', 'LP-22', 'PM-7936'),
(42, 'Untuk digunakan dalam ruangan IT', '0', 'LP-22', 'PM-8202'),
(43, 'Untuk digunakan dalam ruangan admin', '0', 'MS-01', 'PM-5735'),
(44, 'Untuk digunakan dalam ruangan admin', '0', 'MT-01', 'PM-5735');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `employeId` int(11) NOT NULL COMMENT 'Primary Key',
  `nama` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0=non-aktif 1=aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`employeId`, `nama`, `status`) VALUES
(1, 'John Smith', '1'),
(2, 'Jane Doe', '1'),
(3, 'Michael Johnson', '0'),
(4, 'Emily Davis', '1'),
(5, 'David Wilson', '0'),
(6, 'Sarah Anderson', '1'),
(8, 'Robert Brown', '0');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `kodeItemId` varchar(225) NOT NULL,
  `namaItem` varchar(225) DEFAULT NULL,
  `brand` varchar(225) DEFAULT NULL,
  `type` varchar(225) DEFAULT NULL,
  `detail` varchar(225) DEFAULT NULL,
  `warehouse` varchar(225) DEFAULT NULL,
  `lokasiItem` varchar(225) DEFAULT NULL,
  `tglPembelian` date DEFAULT NULL COMMENT 'buy Time',
  `kerusakan` varchar(225) DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL,
  `kondisi` varchar(225) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0=tersedia 1=dipinjam',
  `createBy` varchar(255) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `employeId` int(11) DEFAULT NULL COMMENT 'nama peminjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`kodeItemId`, `namaItem`, `brand`, `type`, `detail`, `warehouse`, `lokasiItem`, `tglPembelian`, `kerusakan`, `keterangan`, `kondisi`, `status`, `createBy`, `createDate`, `employeId`) VALUES
('LP-10', 'LAPTOP', 'HP', '250 G5', 'RAM 8GB INTEL I3 ', NULL, NULL, '2023-09-15', NULL, NULL, 'SECOND', '0', 'PAK ASEP', '2023-09-18 20:47:51', NULL),
('LP-22', 'LAPTOP', 'HP', 'Pavilion', 'Ram 8gb Intel I9', 'SPL 1', 'RUANGAN IT', '2023-10-05', NULL, NULL, 'SECOND', '1', 'PAK ASEP', '2023-10-05 10:01:04', 1),
('MS-01', 'MOUSE', 'DIGITAL ALIANCE', 'Luna 2023', '', 'SPL 3', 'Ruangan Admin', '2023-09-20', NULL, NULL, 'BARU', '1', 'PAK ASEP', '2023-09-21 22:49:29', 6),
('MT-01', 'MONITOR', 'DELL', '', '80Hz', 'SPL 3', 'Ruangan Admin', '2023-10-06', NULL, NULL, 'BARU', '1', 'PAK ASEP', '2023-10-06 12:44:20', 6),
('PC-23', 'PC', 'HP', 'Rakitan', 'INTEL I7 Ram 8gb', NULL, NULL, '2023-10-06', NULL, NULL, 'BARU', '0', 'PAK ASEP', '2023-10-06 12:44:20', NULL),
('PC-87', 'PC', 'HP', 'Rakitan', 'Intel I7 Ram 8gb', NULL, NULL, '2023-10-19', NULL, NULL, 'SECOND', '0', 'PAK ASEP', '2023-10-04 22:15:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjamanId` varchar(11) NOT NULL,
  `jumItem` varchar(2) DEFAULT NULL COMMENT 'jumlah item dipinjam',
  `tglPinjam` date DEFAULT NULL COMMENT 'tanggal pinajm',
  `tglKembali` date DEFAULT NULL,
  `warehouse` varchar(11) DEFAULT NULL,
  `lokasiItem` varchar(225) DEFAULT NULL,
  `employeId` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`peminjamanId`, `jumItem`, `tglPinjam`, `tglKembali`, `warehouse`, `lokasiItem`, `employeId`) VALUES
('PM-1003', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-1087', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-1300', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 1),
('PM-2446', '2', '2023-10-06', '2023-10-06', 'SPL 1', 'RUANGAN IT', 1),
('PM-2794', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-2972', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-3389', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-3403', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-5172', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 1),
('PM-5735', '2', '2023-10-09', NULL, 'SPL 3', 'Ruangan Admin', 6),
('PM-5919', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-7936', '1', '2023-10-06', NULL, 'SPL 3', 'Ruangan Admin', 2),
('PM-8202', '1', '2023-10-09', NULL, 'SPL 1', 'RUANGAN IT', 1),
('PM-8394', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-9384', '3', '2023-10-06', NULL, 'SPL 1', 'RUANGAN IT', 2),
('PM-9982', '3', '2023-10-06', '2023-10-06', 'SPL 1', 'RUANGAN IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL COMMENT 'Primary Key',
  `username` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `role` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$uNWAZLz.Jg.qzxfsgUfWFuoNHIS6iDEM6zQ0NdzMSof6chQk8ObVq', 'admin'),
(2, 'agis', 'agis@example.com', '$2y$10$zsK02QdC6YSDCTuehcpza.W2lL7CC1tGcVx/.FXLODtVmUNkeQ30a', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpeminjaman`
--
ALTER TABLE `detailpeminjaman`
  ADD PRIMARY KEY (`detailPeminjamanId`),
  ADD KEY `kodeItemId` (`kodeItemId`),
  ADD KEY `peminjamanId` (`peminjamanId`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`employeId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`kodeItemId`),
  ADD KEY `employeId` (`employeId`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjamanId`),
  ADD KEY `employeId` (`employeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpeminjaman`
--
ALTER TABLE `detailpeminjaman`
  MODIFY `detailPeminjamanId` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `employeId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpeminjaman`
--
ALTER TABLE `detailpeminjaman`
  ADD CONSTRAINT `detailpeminjaman_ibfk_1` FOREIGN KEY (`kodeItemId`) REFERENCES `items` (`kodeItemId`),
  ADD CONSTRAINT `detailpeminjaman_ibfk_2` FOREIGN KEY (`peminjamanId`) REFERENCES `peminjaman` (`peminjamanId`),
  ADD CONSTRAINT `fk_detailpeminjaman_peminjaman` FOREIGN KEY (`peminjamanId`) REFERENCES `peminjaman` (`peminjamanId`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`employeId`) REFERENCES `employe` (`employeId`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`employeId`) REFERENCES `employe` (`employeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
