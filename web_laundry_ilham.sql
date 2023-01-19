-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2022 at 01:37 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_laundry_ilham`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL,
  `id_paket` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL,
  `qty` double NOT NULL,
  `keterangan` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES
(2, 'ZYfOWw98', '1', 2, 'adad'),
(3, '8xqvwdSF', '1', 3, 'adad'),
(4, 'MMhOEPgA', '1', 2, 'p'),
(5, 'MMhOEPgA', '1', 5, 'j'),
(6, '6yA5iUbR', '1', 1, 'ssf'),
(7, 'd0g8HwX8', '2', 3, 'l'),
(8, 'M9xSKSpf', '1', 1, '1 Barang coy'),
(9, 'M9xSKSpf', '2', 2, '2 Barang');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` varchar(11) COLLATE utf8_swedish_ci NOT NULL,
  `nama_member` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8_swedish_ci NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') COLLATE utf8_swedish_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `alamat`, `jenis_kelamin`, `telp`) VALUES
('jIr5Z', 'Shubkhi ilham', 'aaa', 'Perempuan', '086676736'),
('lsJ', 'Ilham Shubkhi', 'Jl. ppp', 'Laki-Laki', '08778368');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` varchar(11) COLLATE utf8_swedish_ci NOT NULL,
  `nama_outlet` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `alamat` text COLLATE utf8_swedish_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `alamat`, `telp`) VALUES
('9Kzd', 'Outlet 1', 'Jl. Outlet 1', '08766726 (WA)'),
('c4So', 'Outlet 5', 'Jl. Outlet 5', '08766633 (WA)'),
('TnTb', 'Outlet 2', 'Jl. Outlet 2', '08767353 (WA)'),
('yAvw', 'Outlet 3', 'Jl. Outlet 3', '086556353 (WA)'),
('yogZ', 'Outlet 4', 'Jl. Outlet 4', '088736366 (WA)');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` varchar(11) COLLATE utf8_swedish_ci NOT NULL,
  `id_outlet` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL,
  `jenis` enum('kiloan','selimut','bed_cover','kaos','lain') COLLATE utf8_swedish_ci NOT NULL,
  `nama_paket` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `id_outlet`, `jenis`, `nama_paket`, `harga`) VALUES
('1', '9Kzd', 'kiloan', 'Paket Mini Kiloan', 5000),
('2', 'TnTb', 'kaos', 'Paket Hemat Kiloan', 9000),
('3', 'yAvw', 'bed_cover', 'Paket Sultan Kiloan', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(11) COLLATE utf8_swedish_ci NOT NULL,
  `id_outlet` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL,
  `kode_invoice` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `id_member` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL,
  `tgl` datetime NOT NULL,
  `batas_waktu` date NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `pajak` int(11) NOT NULL,
  `status` enum('baru','proses','selesai','diambil') COLLATE utf8_swedish_ci NOT NULL,
  `dibayar` enum('dibayar','belum_dibayar') COLLATE utf8_swedish_ci NOT NULL,
  `id_user` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_outlet`, `kode_invoice`, `id_member`, `tgl`, `batas_waktu`, `tgl_bayar`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `dibayar`, `id_user`) VALUES
('6yA5iUbR', 'TnTb', 'PurYZsXk4', 'jIr5Z', '2022-12-03 18:34:00', '2022-12-04', '2022-12-03 18:34:00', 0, 0, 0, 'selesai', 'dibayar', 'Wuszo'),
('8xqvwdSF', '9Kzd', 'PzKqbbfqk', 'jIr5Z', '2022-12-03 15:44:00', '2022-12-04', '2022-12-03 15:45:00', 1000, 0, 0, 'diambil', 'belum_dibayar', '1'),
('d0g8HwX8', '9Kzd', 'Az1cfep9Y', 'jIr5Z', '2022-12-07 08:00:00', '2022-12-07', '2022-12-07 08:00:00', 0, 0, 0, 'proses', 'dibayar', 'Wuszo'),
('M9xSKSpf', '9Kzd', 'AQIWXzqft', 'jIr5Z', '2022-12-07 16:34:00', '2022-12-07', '2022-12-07 16:34:00', 5000, 0, 0, 'baru', 'belum_dibayar', '1'),
('MMhOEPgA', 'TnTb', 'h3LkXm7HA', 'jIr5Z', '2022-12-03 15:46:00', '2022-12-04', '2022-12-03 15:46:00', 0, 0, 0, 'baru', 'belum_dibayar', '1'),
('ZYfOWw98', '9Kzd', 'YRrMsqRhA', 'lsJ', '2022-12-03 14:34:00', '2022-12-04', '2022-12-03 14:34:00', 0, 0, 0, 'selesai', 'belum_dibayar', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `nama_user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `id_outlet` varchar(11) COLLATE utf8_swedish_ci DEFAULT NULL,
  `posisi` enum('admin','kasir','owner') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `id_outlet`, `posisi`) VALUES
('1', 'admin', '$2y$10$KcWJzL/vsj4QxCI/7aSuBOS7gaYnCapzgE7tKiMhusD7ukRhEMwqS', 'Admin', '9Kzd', 'admin'),
('oQJbN', 'owner', '$2y$10$70BO9iPSCUYCcQqSjTIVleTx4.ZCLYFu57ijHglQHBTTGlAoFIUFm', 'Owner', '9Kzd', 'owner'),
('Wuszo', 'kasir', '$2y$10$1NBmiEwUSvS1sLx3x3LjzO9bQQAEX6w6ewV/AIaWGEp9QyDZzJXEm', 'Kasir', '9Kzd', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `kode_invoice` (`kode_invoice`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_outlet` (`id_outlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `outlet` (`id_outlet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
