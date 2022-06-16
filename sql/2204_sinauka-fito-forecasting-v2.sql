-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 08:55 PM
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
-- Database: `2204_sinauka-fito-forecasting-v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` varchar(7) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(4) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `id_satuan`, `nama_barang`, `stok`, `harga_beli`, `harga_jual`, `tanggal`) VALUES
('BR001', 2, 'Teh Pucuk Harum ukuran 1/2 l', 100, 13000, 15000, '2022-05-18 18:04:24'),
('Kd01', 1, 'Beras', 10, 23000, 25000, '2022-05-16 17:17:01'),
('Kd02', 2, 'Kecap', 10, 5000, 7000, '2022-05-16 17:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL,
  `kd_order` varchar(40) NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `permintaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penjualan_detail`
--

INSERT INTO `tb_penjualan_detail` (`id_penjualan_detail`, `kd_order`, `kode_barang`, `permintaan`) VALUES
(28, 'KD0001', 'BR001', 10),
(29, 'KD0002', 'BR001', 15),
(30, 'KD0003', 'BR001', 12),
(31, 'KD0004', 'BR001', 13),
(32, 'KD0005', 'BR001', 10),
(33, 'KD0006', 'BR001', 10),
(34, 'KD0007', 'BR001', 12),
(35, 'KD0008', 'BR001', 14),
(36, 'KD0009', 'BR001', 16),
(37, 'KD00010', 'BR001', 15),
(38, 'KD00011', 'BR001', 15),
(39, 'KD00012', 'BR001', 11),
(40, 'KD00013', 'BR001', 12),
(41, 'KD00014', 'BR001', 9),
(42, 'KD00015', 'BR001', 8),
(43, 'KD00016', 'BR001', 10),
(44, 'KD00017', 'BR001', 13),
(45, 'KD00018', 'BR001', 16),
(46, 'KD00019', 'BR001', 15),
(47, 'KD00020', 'BR001', 16),
(48, 'KD00021', 'BR001', 14),
(49, 'KD00022', 'BR001', 12),
(50, 'KD00023', 'BR001', 10),
(51, 'KD00024', 'BR001', 10),
(52, 'KD00025', 'BR001', 9),
(53, 'KD00026', 'BR001', 9),
(54, 'KD00027', 'BR001', 10),
(55, 'KD00028', 'BR001', 16),
(56, 'KD00029', 'BR001', 13),
(57, 'KD00030', 'BR001', 14),
(58, 'KD00031', 'BR001', 10),
(59, 'KD00032', 'BR001', 12),
(60, 'KD00033', 'BR001', 15),
(61, 'KD00034', 'BR001', 13),
(62, 'KD00035', 'BR001', 10),
(63, 'KD00036', 'BR001', 10),
(64, 'KD00037', 'BR001', 10),
(65, 'KD00038', 'BR001', 9),
(66, 'KD00039', 'BR001', 8),
(67, 'KD00040', 'BR001', 10),
(68, 'KD00042', 'BR001', 12),
(69, 'KD00043', 'BR001', 15),
(70, 'KD00044', 'BR001', 15),
(71, 'KD00045', 'BR001', 17),
(72, 'KD00046', 'BR001', 18),
(73, 'KD00047', 'BR001', 19),
(74, 'KD00048', 'BR001', 20),
(75, 'KD00049', 'BR001', 17),
(76, 'KD00050', 'BR001', 15),
(77, 'KD00051', 'BR001', 13),
(78, 'KD00052', 'BR001', 15),
(79, 'KD00053', 'BR001', 11),
(80, 'KD00054', 'BR001', 12),
(81, 'KD00055', 'BR001', 10),
(82, 'KD00056', 'BR001', 9),
(83, 'KD00057', 'BR001', 10),
(84, 'KD00058', 'BR001', 10),
(85, 'KD00059', 'BR001', 12),
(86, 'KD00060', 'BR001', 10),
(87, 'KD00061', 'BR001', 10),
(88, 'KD00062', 'BR001', 12),
(89, 'KD00063', 'BR001', 14),
(90, 'KD00064', 'BR001', 14),
(91, 'KD00065', 'BR001', 12),
(92, 'KD00066', 'BR001', 11),
(93, 'KD00067', 'BR001', 15),
(94, 'KD00068', 'BR001', 17),
(95, 'KD00069', 'BR001', 12),
(96, 'KD00070', 'BR001', 9),
(97, 'KD00071', 'BR001', 9),
(98, 'KD00072', 'BR001', 11),
(99, 'KD00073', 'BR001', 15),
(100, 'KD00074', 'BR001', 15),
(101, 'KD00075', 'BR001', 16),
(102, 'KD00076', 'BR001', 17),
(103, 'KD00077', 'BR001', 12),
(104, 'KD00078', 'BR001', 10),
(105, 'KD00079', 'BR001', 10),
(106, 'KD00080', 'BR001', 15),
(107, 'KD00081', 'BR001', 17),
(108, 'KD00082', 'BR001', 15),
(109, 'KD00083', 'BR001', 16),
(110, 'KD00084', 'BR001', 14),
(111, 'KD00085', 'BR001', 12),
(112, 'KD00086', 'BR001', 12),
(113, 'KD00087', 'BR001', 10),
(114, 'KD00088', 'BR001', 10),
(115, 'KD00089', 'BR001', 15),
(116, 'KD00090', 'BR001', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_info`
--

CREATE TABLE `tb_penjualan_info` (
  `kd_order` varchar(40) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'Pengoperasian',
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penjualan_info`
--

INSERT INTO `tb_penjualan_info` (`kd_order`, `id_user`, `tanggal`) VALUES
('KD0001', 1, '2019-01-01 22:28:57'),
('KD00010', 1, '2019-01-10 22:28:57'),
('KD00011', 1, '2019-01-11 22:28:57'),
('KD00012', 1, '2019-01-12 22:28:57'),
('KD00013', 1, '2019-01-13 22:28:57'),
('KD00014', 1, '2019-01-14 22:28:57'),
('KD00015', 1, '2019-01-15 22:28:57'),
('KD00016', 1, '2019-01-16 22:28:57'),
('KD00017', 1, '2019-01-17 22:28:57'),
('KD00018', 1, '2019-01-18 22:28:57'),
('KD00019', 1, '2019-01-19 22:28:57'),
('KD0002', 1, '2019-01-02 22:28:57'),
('KD00020', 1, '2019-01-20 22:28:57'),
('KD00021', 1, '2019-01-21 22:28:57'),
('KD00022', 1, '2019-01-22 22:28:57'),
('KD00023', 1, '2019-01-23 22:28:57'),
('KD00024', 1, '2019-01-24 22:28:57'),
('KD00025', 1, '2019-01-25 22:28:57'),
('KD00026', 1, '2019-01-26 22:28:57'),
('KD00027', 1, '2019-01-27 22:28:57'),
('KD00028', 1, '2019-01-28 22:28:57'),
('KD00029', 1, '2019-01-29 22:28:57'),
('KD0003', 1, '2019-01-03 22:28:57'),
('KD00030', 1, '2019-01-30 22:28:57'),
('KD00031', 1, '2019-01-31 22:28:57'),
('KD00032', 1, '2019-02-01 22:28:57'),
('KD00033', 1, '2019-02-02 22:28:57'),
('KD00034', 1, '2019-02-03 22:28:57'),
('KD00035', 1, '2019-02-04 22:28:57'),
('KD00036', 1, '2019-02-05 22:28:57'),
('KD00037', 1, '2019-02-06 22:28:57'),
('KD00038', 1, '2019-02-07 22:28:57'),
('KD00039', 1, '2019-02-08 22:28:57'),
('KD0004', 1, '2019-01-04 22:28:57'),
('KD00040', 1, '2019-02-09 22:28:57'),
('KD00041', 1, '2019-02-10 22:28:57'),
('KD00042', 1, '2019-02-11 22:28:57'),
('KD00043', 1, '2019-02-12 22:28:57'),
('KD00044', 1, '2019-02-13 22:28:57'),
('KD00045', 1, '2019-02-14 22:28:57'),
('KD00046', 1, '2019-02-15 22:28:57'),
('KD00047', 1, '2019-02-16 22:28:57'),
('KD00048', 1, '2019-02-17 22:28:57'),
('KD00049', 1, '2019-02-18 22:28:57'),
('KD0005', 1, '2019-01-05 22:28:57'),
('KD00050', 1, '2019-02-19 22:28:57'),
('KD00051', 1, '2019-02-20 22:28:57'),
('KD00052', 1, '2019-02-21 22:28:57'),
('KD00053', 1, '2019-02-22 22:28:57'),
('KD00054', 1, '2019-02-23 22:28:57'),
('KD00055', 1, '2019-02-24 22:28:57'),
('KD00056', 1, '2019-02-25 22:28:57'),
('KD00057', 1, '2019-02-26 22:28:57'),
('KD00058', 1, '2019-02-27 22:28:57'),
('KD00059', 1, '2019-02-28 22:28:57'),
('KD0006', 1, '2019-01-06 22:28:57'),
('KD00060', 1, '2019-03-01 22:38:15'),
('KD00061', 1, '2019-03-02 22:38:15'),
('KD00062', 1, '2019-03-03 22:38:15'),
('KD00063', 1, '2019-03-04 22:38:15'),
('KD00064', 1, '2019-03-05 22:38:15'),
('KD00065', 1, '2019-03-06 22:38:15'),
('KD00066', 1, '2019-03-07 22:38:15'),
('KD00067', 1, '2019-03-08 22:38:15'),
('KD00068', 1, '2019-03-09 22:38:15'),
('KD00069', 1, '2019-03-10 22:38:15'),
('KD0007', 1, '2019-01-07 22:28:57'),
('KD00070', 1, '2019-03-11 22:38:15'),
('KD00071', 1, '2019-03-12 22:38:15'),
('KD00072', 1, '2019-03-13 22:38:15'),
('KD00073', 1, '2019-03-14 22:38:15'),
('KD00074', 1, '2019-03-15 22:38:15'),
('KD00075', 1, '2019-03-16 22:38:15'),
('KD00076', 1, '2019-03-17 22:38:15'),
('KD00077', 1, '2019-03-18 22:38:15'),
('KD00078', 1, '2019-03-19 22:38:15'),
('KD00079', 1, '2019-03-20 22:38:15'),
('KD0008', 1, '2019-01-08 22:28:57'),
('KD00080', 1, '2019-03-21 22:38:15'),
('KD00081', 1, '2019-03-22 22:38:15'),
('KD00082', 1, '2019-03-23 22:38:15'),
('KD00083', 1, '2019-03-24 22:38:15'),
('KD00084', 1, '2019-03-25 22:38:15'),
('KD00085', 1, '2019-03-26 22:38:15'),
('KD00086', 1, '2019-03-27 22:38:15'),
('KD00087', 1, '2019-03-28 22:38:15'),
('KD00088', 1, '2019-03-29 22:38:15'),
('KD00089', 1, '2019-03-30 22:38:15'),
('KD0009', 1, '2019-01-09 22:28:57'),
('KD00090', 1, '2019-03-31 22:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peramalan`
--

CREATE TABLE `tb_peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `timeframe` varchar(10) NOT NULL,
  `alpha` varchar(5) NOT NULL,
  `tanggalawal` varchar(30) NOT NULL,
  `tanggalakhir` varchar(30) NOT NULL,
  `perhitungan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`perhitungan`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peramalan`
--

INSERT INTO `tb_peramalan` (`id_peramalan`, `kode_barang`, `timeframe`, `alpha`, `tanggalawal`, `tanggalakhir`, `perhitungan`, `created_at`) VALUES
(1, 'BR001', 'week', '0.2', '1551481200', '1551394800', '{\n    \"hasil_perhitungan\": [\n        {\n            \"bulan\": \"2019-01-01\",\n            \"actual\": \"70\",\n            \"forecast\": \"70\"\n        },\n        {\n            \"bulan\": \"2019-01-07\",\n            \"actual\": \"95\",\n            \"forecast\": 70\n        },\n        {\n            \"bulan\": \"2019-01-14\",\n            \"actual\": \"87\",\n            \"forecast\": 72.5\n        },\n        {\n            \"bulan\": \"2019-01-21\",\n            \"actual\": \"74\",\n            \"forecast\": 73.95\n        },\n        {\n            \"bulan\": \"2019-01-28\",\n            \"actual\": \"53\",\n            \"forecast\": 73.95500000000001\n        },\n        {\n            \"bulan\": \"2019-02-01\",\n            \"actual\": \"40\",\n            \"forecast\": 71.85950000000001\n        },\n        {\n            \"bulan\": \"2019-02-04\",\n            \"actual\": \"57\",\n            \"forecast\": 68.67355\n        },\n        {\n            \"bulan\": \"2019-02-11\",\n            \"actual\": \"116\",\n            \"forecast\": 67.506195\n        },\n        {\n            \"bulan\": \"2019-02-18\",\n            \"actual\": \"93\",\n            \"forecast\": 72.35557550000001\n        },\n        {\n            \"bulan\": \"2019-02-25\",\n            \"actual\": \"41\",\n            \"forecast\": 74.42001795000002\n        },\n        {\n            \"bulan\": \"2019-03-01\",\n            \"actual\": \"32\",\n            \"forecast\": 71.07801615500001\n        },\n        {\n            \"bulan\": \"Hasil\",\n            \"actual\": 0,\n            \"forecast\": 67.17021453950001\n        }\n    ],\n    \"avg_mad\": 22.334028509545455,\n    \"avg_mse\": 713.4085788686809,\n    \"avg_mape\": 40.94097922261948\n}', '2022-06-16 00:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(25) NOT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nama_satuan`, `tanggal_pembuatan`) VALUES
(1, 'Pack', '2022-05-12 19:32:52'),
(2, 'botol', '2022-05-16 16:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(2) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `level` enum('Admin','Pegawai') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama`, `username`, `password`, `level`, `alamat`, `no_telp`, `dibuat_pada`) VALUES
(1, 'Alfon', 'admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Admin', 'Malang', '082131686761', '2022-05-12 19:29:34'),
(2, 'Vito', 'user', '12dea96fec20593566ab75692c9949596833adc9', 'Pegawai', 'Tumpang', '082131686761', '2022-05-12 19:31:03'),
(3, 'Alfonsus Vito', 'alfon', '7c222fb2927d828af22f592134e8932480637c0d', 'Pegawai', '  Malang', '082131686761', '2022-05-16 17:54:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tb_penjualan_info`
--
ALTER TABLE `tb_penjualan_info`
  ADD PRIMARY KEY (`kd_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
  ADD PRIMARY KEY (`id_peramalan`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `tb_satuan` (`id_satuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
