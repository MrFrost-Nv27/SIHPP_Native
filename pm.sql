-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2022 pada 05.47
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
(1, 'BB1', 'KAYU A', 1000, '2*4'),
(2, 'BB2', 'KAYU B', 2000, '2*4');

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
(1, 'BP1', 'Hncaplas', 1000, 'pcs');

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
('2022-06-26', 1656213480, 1, 'BB1', 'KAYU A', 1000, '2*4', 1, 1000, 'BBB'),
('2022-06-26', 1656213480, 1, 'BP1', 'Hncaplas', 1000, 'pcs', 0, 50, 'BBP'),
('2022-06-26', 1656213480, 1, '1', 'Angga', 10000, 'Meja', 1, 10000, 'BTK'),
('2022-06-26', 1656213480, 1, 'BOP1', 'overhead1', 2000, '10%', 1, 200, 'BOP'),
('2022-06-26', 1656214886, 3, 'BB1', 'KAYU A', 1000, '2*4', 3, 3000, 'BBB');

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
('BOP1', 'overhead1', 2000, 'overheda ', '2022-06-26', 1);

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
('2022-06-26', 'BB1', 'KAYU A', '2*4', 1000, 96, 100000),
('2022-06-26', 'BB2', 'KAYU B', '2*4', 2000, 10, 20000);

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
('2022-06-26', 'BP1', 'Hncaplas', 'pcs', 1000, 10, 10000);

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
(1, 1656213480, 'Kusen Pintu', 1, 1000, 50, 10000, 200, 11250, '2022-06-26', 'Juni', 2022),
(2, 1656214886, 'Kusen Jendela', 3, 3000, 0, 0, 0, 3000, '2022-06-26', 'Juni', 2022);

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

--
-- Dumping data untuk tabel `tenaker`
--

INSERT INTO `tenaker` (`id_tenaker`, `nm_tenaker`, `bag_tenaker`, `upah_tenaker`, `ttl_pendapatan`) VALUES
(1, 'Angga', 'Meja', 10000, 10000);

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
-- Indeks untuk tabel `overhead_pabrik`
--
ALTER TABLE `overhead_pabrik`
  ADD PRIMARY KEY (`id_overp`);

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
-- AUTO_INCREMENT untuk tabel `overhead_pabrik`
--
ALTER TABLE `overhead_pabrik`
  MODIFY `id_overp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tenaker`
--
ALTER TABLE `tenaker`
  MODIFY `id_tenaker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
