-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2022 pada 21.25
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bb` int(11) NOT NULL,
  `kd_bb` varchar(6) NOT NULL DEFAULT 'BB',
  `nm_bb` varchar(50) NOT NULL,
  `hrg_bb` int(10) NOT NULL,
  `satuan_bb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bb`, `kd_bb`, `nm_bb`, `hrg_bb`, `satuan_bb`) VALUES
(1, 'BB1', 'gula', 7000, 'kg'),
(2, 'BB2', 'kopi biasa', 5000, 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_penolong`
--

CREATE TABLE `bahan_penolong` (
  `id_bp` int(11) NOT NULL,
  `kd_bp` varchar(6) NOT NULL DEFAULT 'BP',
  `nm_bp` varchar(50) NOT NULL,
  `hrg_bp` int(10) NOT NULL,
  `satuan_bp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan_penolong`
--

INSERT INTO `bahan_penolong` (`id_bp`, `kd_bp`, `nm_bp`, `hrg_bp`, `satuan_bp`) VALUES
(1, 'BP1', 'hancaplas', 2131, 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_produk`
--

CREATE TABLE `detail_produk` (
  `id` int(12) NOT NULL,
  `kode` varchar(12) NOT NULL,
  `id_produk` varchar(12) NOT NULL,
  `id_bb` varchar(12) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `satuan` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_produk`
--

INSERT INTO `detail_produk` (`id`, `kode`, `id_produk`, `id_bb`, `jumlah`, `satuan`) VALUES
(16, 'DPR001', '1', '', 0, ''),
(17, 'DPR002', '1', '', 0, ''),
(18, 'DPR003', '1', '', 0, ''),
(19, 'DPR004', '1', '', 0, ''),
(20, 'DPR005', '1', '', 0, ''),
(21, 'DPR006', '1', '', 0, ''),
(22, 'DPR007', '1', '', 0, ''),
(23, 'DPR008', '1', '', 0, ''),
(24, 'DPR009', '1', '', 0, ''),
(25, 'DPR010', '1', '', 0, ''),
(26, 'DPR011', '1', '', 0, ''),
(27, 'DPR012', '1', '', 0, ''),
(28, 'DPR013', '1', '', 0, ''),
(29, 'DPR014', '1', '', 0, ''),
(30, 'DPR015', '1', '', 0, ''),
(32, 'DPR016', '1', '', 0, ''),
(33, 'DPR017', '1', '', 0, ''),
(34, 'DPR018', '1', '', 0, ''),
(35, 'DPR019', '1', '', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_produksi`
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
-- Dumping data untuk tabel `detail_produksi`
--

INSERT INTO `detail_produksi` (`tanggal`, `nmr_produksi`, `jml_produksi`, `kode`, `nama`, `harga`, `keterangan`, `jumlah`, `total`, `lvl`) VALUES
('2022-07-08', 1657298257, 3, 'BB1', 'gula', 7000, 'kg', 1, 7000, 'BBB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `overhead_pabrik`
--

CREATE TABLE `overhead_pabrik` (
  `kd_overp` varchar(6) NOT NULL DEFAULT 'OP',
  `nm_overp` varchar(50) NOT NULL,
  `by_overp` int(10) NOT NULL,
  `ket_overp` text NOT NULL,
  `tgl_overp` date NOT NULL,
  `id_overp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `overhead_pabrik`
--

INSERT INTO `overhead_pabrik` (`kd_overp`, `nm_overp`, `by_overp`, `ket_overp`, `tgl_overp`, `id_overp`) VALUES
('BOP1', '', 2000, 'dd', '2022-07-08', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `persediaan_bahan_baku`
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
-- Dumping data untuk tabel `persediaan_bahan_baku`
--

INSERT INTO `persediaan_bahan_baku` (`tgl_pb`, `kd_pb`, `nm_pb`, `sat_pb`, `hrg_pb`, `stok_pb`, `tot_pb`) VALUES
('2022-07-08', 'BB1', 'gula', 'kg', 7000, 99, 700000),
('2022-07-08', 'BB2', 'kopi biasa', 'pcs', 5000, 100, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `persediaan_bahan_penolong`
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
-- Dumping data untuk tabel `persediaan_bahan_penolong`
--

INSERT INTO `persediaan_bahan_penolong` (`tgl_pb`, `kd_pb`, `nm_pb`, `sat_pb`, `hrg_pb`, `stok_pb`, `tot_pb`) VALUES
('2022-07-08', 'BP1', 'hancaplas', 'pcs', 2131, 100, 213100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(12) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_produk` varchar(63) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama_produk`, `created_at`) VALUES
(3, 'DPR002', 'Kopi kapal api yang ga pake gula', '2022-07-08 21:23:22.000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
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
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nmr_produksi`, `nm_produk`, `jml_produksi`, `bbb`, `bbp`, `btk`, `bop`, `hpp`, `tgl_produksi`, `periode`, `tahun`) VALUES
(1, 1657298231, '1', 1, 0, 0, 0, 0, 0, '2022-07-08', 'Juli', 2022),
(2, 1657298257, 'Kopi Luak', 3, 7000, 0, 0, 0, 7000, '2022-07-08', 'Juli', 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tenaker`
--

CREATE TABLE `tenaker` (
  `id_tenaker` int(11) NOT NULL,
  `nm_tenaker` varchar(50) NOT NULL,
  `bag_tenaker` varchar(50) NOT NULL,
  `upah_tenaker` int(11) NOT NULL,
  `ttl_pendapatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `email`, `level`) VALUES
(1, 'gudang', '827ccb0eea8a706c4c34a16891f84e7b', 'Rachmawati', 'gudang@gmail.com', 1),
(2, 'akuntansi', '827ccb0eea8a706c4c34a16891f84e7b', 'Nais Rachmawati', 'naisrachmawati1505@gmail.com', 2),
(3, 'manajer', '7dbb20df83feda618d9991bd81f9afae', 'Narawati', 'narawati@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bb`);

--
-- Indeks untuk tabel `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  ADD PRIMARY KEY (`id_bp`);

--
-- Indeks untuk tabel `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `overhead_pabrik`
--
ALTER TABLE `overhead_pabrik`
  ADD PRIMARY KEY (`id_overp`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indeks untuk tabel `tenaker`
--
ALTER TABLE `tenaker`
  ADD PRIMARY KEY (`id_tenaker`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bahan_penolong`
--
ALTER TABLE `bahan_penolong`
  MODIFY `id_bp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_produk`
--
ALTER TABLE `detail_produk`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `overhead_pabrik`
--
ALTER TABLE `overhead_pabrik`
  MODIFY `id_overp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tenaker`
--
ALTER TABLE `tenaker`
  MODIFY `id_tenaker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
