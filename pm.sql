-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2022 at 05:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bb` int(11) UNSIGNED NOT NULL,
  `kd_bb` varchar(6) NOT NULL DEFAULT 'BB',
  `nm_bb` varchar(50) NOT NULL,
  `hrg_bb` int(10) NOT NULL,
  `satuan_bb` varchar(50) NOT NULL,
  `stok_bb` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tot_bb` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tgl_bb` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bb`, `kd_bb`, `nm_bb`, `hrg_bb`, `satuan_bb`, `stok_bb`, `tot_bb`, `tgl_bb`) VALUES
(27, 'BB27', 'Kayu A', 75000, 'Unit', 120, 9000000, '2022-06-26 05:10:29'),
(28, 'BB28', 'Kayu B', 175000, 'Unit', 20, 3500000, '2022-06-26 05:11:13'),
(29, 'BB29', 'Kayu \"C\"', 41000, 'Unit', 0, 0, '2022-06-26 02:02:42'),
(33, 'BB33', 'Kayu \"F\"', 109000, 'Unit', 0, 0, '2022-06-26 02:02:42'),
(34, 'BB34', 'Kayu \"G\"', 620000, 'Unit', 0, 0, '2022-06-26 02:02:42'),
(35, 'BB35', 'Triplek', 70000, 'Unit', 0, 0, '2022-06-26 02:02:42'),
(36, 'BB36', 'Kaca Rasa', 50000, 'Unit', 0, 0, '2022-06-26 02:02:42'),
(37, 'BB0', 'Max creamer', 30000, 'gram', 0, 0, '2022-06-26 02:02:42'),
(38, 'BB0', 'Max creamer', 32000, 'box', 0, 0, '2022-06-26 02:02:42'),
(39, 'BB0', 'teh', 43000, 'gram', 0, 0, '2022-06-26 02:02:42'),
(40, 'BB0', 'teh', 43000, 'gram', 0, 0, '2022-06-26 02:02:42'),
(41, 'BB0', 'Max creamer', 32000, 'box', 0, 0, '2022-06-26 02:02:42'),
(42, 'BB0', 'teh', 43000, 'gram', 0, 0, '2022-06-26 02:02:42'),
(43, 'BB0', 'gula cair', 20000, 'kg', 0, 0, '2022-06-26 02:02:42'),
(44, 'BB0', 'teh', 9000, 'gram', 0, 0, '2022-06-26 02:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_penolong`
--

CREATE TABLE `bahan_penolong` (
  `id_bp` int(11) UNSIGNED NOT NULL,
  `kd_bp` varchar(6) NOT NULL DEFAULT 'BP',
  `nm_bp` varchar(50) NOT NULL,
  `hrg_bp` int(10) NOT NULL,
  `satuan_bp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_penolong`
--

INSERT INTO `bahan_penolong` (`id_bp`, `kd_bp`, `nm_bp`, `hrg_bp`, `satuan_bp`) VALUES
(5, 'BP5', 'Paku 7 cm', 180000, 'Box'),
(6, 'BP6', 'Lem Foxi', 30000, 'Bungkus'),
(7, 'BP7', 'Paku 5 cm', 150000, 'Box'),
(8, 'BP8', 'Lem Fox', 15000, 'Bungkus'),
(9, 'BP9', 'Cat Impra', 55000, 'Liter'),
(10, 'BP10', 'Cat Clear', 50000, 'Liter'),
(11, 'BP11', 'Cat Impra Sending', 50000, 'Liter'),
(12, 'BP12', 'Tenner Super', 18000, 'Liter'),
(13, 'BP0', 'cup', 700, 'pcs'),
(14, 'BP0', 'es batu kristal', 700, 'kantong');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produksi`
--

CREATE TABLE `detail_produksi` (
  `tanggal` date NOT NULL,
  `nmr_produksi` int(15) NOT NULL,
  `jml_produksi` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `lvl` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_produksi`
--

INSERT INTO `detail_produksi` (`tanggal`, `nmr_produksi`, `jml_produksi`, `kode`, `nama`, `harga`, `keterangan`, `jumlah`, `total`, `lvl`) VALUES
('2021-02-20', 1613548462, 100, 'BOP1', 'Biaya Listrik Dan Air', 525000, '10%', 100, 525, 'BOP'),
('2021-02-20', 1613548462, 100, '1', 'Yasar Wicaksono', 20000, 'Meja', 100, 2000000, 'BTK'),
('2021-02-20', 1613548462, 100, 'BP4', 'Paku 10 cm', 210000, 'Box', 5, 1050000, 'BBP'),
('2021-02-20', 1613548462, 100, 'BP6', 'Lem Foxi', 30000, 'Bungkus', 5, 150000, 'BBP'),
('2021-02-20', 1613548462, 100, 'BB27', 'Kayu \"A\"', 75000, 'Unit', 100, 7500000, 'BBB'),
('2021-02-27', 1614401122, 200, 'BP6', 'Lem Foxi', 30000, 'Bungkus', 10, 300000, 'BBP'),
('2021-02-27', 1614401122, 200, 'BP5', 'Paku 7 cm', 180000, 'Box', 10, 1800000, 'BBP'),
('2021-02-27', 1614401122, 200, '7', 'Reform', 15000, 'Kusen Pintu', 200, 3000000, 'BTK'),
('2021-02-27', 1614401122, 200, 'BOP1', 'Biaya Listrik Dan Air', 525000, '10%', 200, 263, 'BOP');

-- --------------------------------------------------------

--
-- Table structure for table `overhead_pabrik`
--

CREATE TABLE `overhead_pabrik` (
  `kd_overp` varchar(6) NOT NULL DEFAULT 'OP',
  `nm_overp` varchar(50) NOT NULL,
  `by_overp` int(10) NOT NULL,
  `ket_overp` text NOT NULL,
  `tgl_overp` date NOT NULL,
  `id_overp` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overhead_pabrik`
--

INSERT INTO `overhead_pabrik` (`kd_overp`, `nm_overp`, `by_overp`, `ket_overp`, `tgl_overp`, `id_overp`) VALUES
('BOP1', 'Biaya Listrik Dan Air', 525000, 'Biaya listrik dan air perbulan', '2021-02-16', 1),
('BOP0', 'penyusutahn mesin', 770000, 'mesin sealer', '2022-05-27', 2),
('BOP0', 'penyusutahn mesin', 770000, 'mesin sealer', '2022-05-28', 3),
('BOP0', 'penyusutahn mesin', 770000, 'mesin sealer', '2022-05-31', 4);

-- --------------------------------------------------------

--
-- Table structure for table `persediaan_bahan_baku`
--

CREATE TABLE `persediaan_bahan_baku` (
  `tgl_pb` date NOT NULL,
  `kd_pb` varchar(6) NOT NULL,
  `nm_pb` varchar(50) NOT NULL,
  `sat_pb` varchar(50) NOT NULL,
  `hrg_pb` int(11) NOT NULL,
  `stok_pb` int(11) NOT NULL,
  `tot_pb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persediaan_bahan_baku`
--

INSERT INTO `persediaan_bahan_baku` (`tgl_pb`, `kd_pb`, `nm_pb`, `sat_pb`, `hrg_pb`, `stok_pb`, `tot_pb`) VALUES
('2021-02-20', 'BB27', 'Kayu A', 'Unit', 75000, 200, 15000000),
('2021-02-27', 'BB28', 'Kayu B', 'Unit', 175000, 200, 35000000),
('2021-02-16', 'BB29', 'Kayu \"C\"', 'Unit', 41000, 200, 8200000),
('2021-02-16', 'BB33', 'Kayu \"F\"', 'Unit', 109000, 250, 27250000),
('2021-02-27', 'BB34', 'Kayu \"G\"', 'Unit', 620000, 50, 31000000),
('2021-02-16', 'BB35', 'Triplek', 'Unit', 70000, 10, 700000),
('2021-02-26', 'BB36', 'Kaca Rasa', 'Unit', 50000, 100, 5000000),
('2022-06-25', 'BB0', 'Max creamer', 'gram', 30000, 21, 0),
('2022-06-25', 'BB0', 'Max creamer', 'box', 32000, 15, 0),
('2022-06-25', 'BB0', 'teh', 'gram', 43000, 13, 0),
('2022-06-25', 'BB0', 'teh', 'gram', 43000, 10, 0),
('2022-06-25', 'BB0', 'Max creamer', 'box', 32000, 10, 0),
('2022-06-25', 'BB0', 'teh', 'gram', 43000, 5, 0),
('2022-06-25', 'BB0', 'gula cair', 'kg', 20000, 5, 0),
('2022-06-25', 'BB0', 'teh', 'gram', 9000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `persediaan_bahan_penolong`
--

CREATE TABLE `persediaan_bahan_penolong` (
  `tgl_pb` date NOT NULL,
  `kd_pb` varchar(6) NOT NULL,
  `nm_pb` varchar(50) NOT NULL,
  `sat_pb` varchar(50) NOT NULL,
  `hrg_pb` int(11) NOT NULL,
  `stok_pb` int(11) NOT NULL,
  `tot_pb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persediaan_bahan_penolong`
--

INSERT INTO `persediaan_bahan_penolong` (`tgl_pb`, `kd_pb`, `nm_pb`, `sat_pb`, `hrg_pb`, `stok_pb`, `tot_pb`) VALUES
('2022-05-23', 'BP5', 'Paku 7 cm', 'Box', 180000, 15, 2700000),
('2021-02-27', 'BP6', 'Lem Foxi', 'Bungkus', 30000, 20, 900000),
('2021-02-16', 'BP7', 'Paku 5 cm', 'Box', 150000, 2, 300000),
('2021-02-27', 'BP8', 'Lem Fox', 'Bungkus', 15000, 50, 750000),
('2021-02-16', 'BP9', 'Cat Impra', 'Liter', 55000, 200, 11000000),
('2021-02-16', 'BP10', 'Cat Clear', 'Liter', 50000, 100, 5000000),
('2021-02-16', 'BP11', 'Cat Impra Sending', 'Liter', 50000, 100, 5000000),
('2021-02-16', 'BP12', 'Tenner Super', 'Liter', 18000, 100, 1800000),
('2022-05-31', 'BP0', 'cup', 'pcs', 700, 107, 4900),
('2022-05-31', 'BP0', 'es batu kristal', 'kantong', 700, 7, 4900);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `nmr_produksi` int(14) NOT NULL,
  `nm_produk` varchar(15) NOT NULL,
  `jml_produksi` int(11) NOT NULL,
  `bbb` int(15) NOT NULL,
  `bbp` int(15) NOT NULL,
  `btk` int(15) NOT NULL,
  `bop` int(15) NOT NULL,
  `hpp` int(11) NOT NULL,
  `tgl_produksi` date NOT NULL,
  `periode` varchar(15) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nmr_produksi`, `nm_produk`, `jml_produksi`, `bbb`, `bbp`, `btk`, `bop`, `hpp`, `tgl_produksi`, `periode`, `tahun`) VALUES
(1, 1613548462, 'Meja', 100, 7500000, 1200000, 2000000, 525, 10700525, '2021-02-17', 'Februari', 2021),
(3, 1614401122, 'Kusen Pintu', 200, 0, 2100000, 3000000, 262, 5100262, '2021-02-27', 'Februari', 2021),
(0, 1649650110, 'Kusen Pintu', 0, 0, 0, 0, 0, 0, '2022-04-11', 'April', 2022),
(0, 1649650150, 'Pintu', 6, 0, 0, 0, 0, 0, '2022-04-11', 'April', 2022),
(0, 1653301419, 'Jendela', 5, 0, 0, 0, 0, 0, '2022-05-23', 'Mei', 2022),
(0, 1653301423, 'Kusen Pintu', 0, 0, 0, 0, 0, 0, '2022-05-23', 'Mei', 2022),
(0, 1653478395, 'Pintu', 2, 0, 0, 0, 0, 0, '2022-05-25', 'Mei', 2022),
(0, 1653704233, 'Kursi', 5, 0, 0, 0, 0, 0, '2022-05-28', 'Mei', 2022),
(0, 1653704406, 'Lemari', 4, 0, 0, 0, 0, 0, '2022-05-28', 'Mei', 2022),
(0, 1654001286, 'Meja', 100, 0, 0, 0, 0, 0, '2022-05-31', 'Mei', 2022),
(0, 1654065424, 'Jendela', 100, 0, 0, 0, 0, 0, '2022-06-01', 'Juni', 2022),
(0, 1654339731, 'Meja', 3, 0, 0, 0, 0, 0, '2022-06-04', 'Juni', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `tenaker`
--

CREATE TABLE `tenaker` (
  `id_tenaker` int(11) UNSIGNED NOT NULL,
  `nm_tenaker` varchar(50) NOT NULL,
  `bag_tenaker` varchar(50) NOT NULL,
  `upah_tenaker` int(11) NOT NULL,
  `ttl_pendapatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenaker`
--

INSERT INTO `tenaker` (`id_tenaker`, `nm_tenaker`, `bag_tenaker`, `upah_tenaker`, `ttl_pendapatan`) VALUES
(1, 'Yasar Wicaksono', 'Meja', 20000, 2000000),
(5, 'Yassar', 'Meja', 20000, 0),
(7, 'Reform', 'Kusen Pintu', 15000, 3000000),
(8, 'Nais', 'Lemari', 50000, 0),
(9, 'nida', 'Lemari', 2000, 0),
(10, 'gilang', 'Kusen Jendela', 5000, 0),
(11, 'fira', 'Meja', 700, 0),
(12, 'merry', 'Jendela', 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(32) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `email`, `level`) VALUES
(1, 'gudang', '827ccb0eea8a706c4c34a16891f84e7b', 'Rachmawati', 'gudang@gmail.com', 1),
(2, 'akuntansi', '827ccb0eea8a706c4c34a16891f84e7b', 'Nais Rachmawati', 'naisrachmawati1505@gmail.com', 2),
(3, 'manajer', '7dbb20df83feda618d9991bd81f9afae', 'Narawati', 'narawati@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bb`);

--
-- Indexes for table `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  ADD PRIMARY KEY (`id_bp`);

--
-- Indexes for table `overhead_pabrik`
--
ALTER TABLE `overhead_pabrik`
  ADD PRIMARY KEY (`id_overp`);

--
-- Indexes for table `tenaker`
--
ALTER TABLE `tenaker`
  ADD PRIMARY KEY (`id_tenaker`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bb` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  MODIFY `id_bp` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `overhead_pabrik`
--
ALTER TABLE `overhead_pabrik`
  MODIFY `id_overp` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tenaker`
--
ALTER TABLE `tenaker`
  MODIFY `id_tenaker` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
