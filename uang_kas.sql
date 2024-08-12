-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 08:33 AM
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
-- Database: `uang_kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan_pembayaran`
--

CREATE TABLE `bulan_pembayaran` (
  `id_bulan_pembayaran` int(11) NOT NULL,
  `nama_bulan` enum('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember') NOT NULL,
  `tahun` int(4) NOT NULL,
  `pembayaran_perminggu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulan_pembayaran`
--

INSERT INTO `bulan_pembayaran` (`id_bulan_pembayaran`, `nama_bulan`, `tahun`, `pembayaran_perminggu`) VALUES
(16, 'mei', 2024, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'administrator'),
(2, 'bendahara'),
(4, 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `jumlah_pengeluaran`, `keterangan`, `tanggal_pengeluaran`, `id_user`) VALUES
(1, 10000, 'Beli Sapu 2pcs', 1717396015, 1),
(2, 10000, 'Beli Pel Lantai 1pcs', 1717395959, 4),
(3, 5000, 'Beli Wipol Pel 1pcs\r\n', 1717396039, 1);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_uang_kas` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_user`, `id_uang_kas`, `aksi`, `tanggal`) VALUES
(1, 1, 2, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1611256476),
(2, 1, 2, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1611256479),
(3, 1, 2, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1611256484),
(4, 1, 2, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 4,000', 1611256488),
(5, 1, 1, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1611256492),
(6, 1, 1, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1611256495),
(7, 1, 1, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1611256500),
(8, 1, 1, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 5,000', 1611256504),
(9, 1, 3, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1611256508),
(10, 1, 3, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1611256512),
(11, 1, 4, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 500', 1611256518),
(12, 1, 4, 'telah mengubah pembayaran minggu ke-1 dari Rp. 500 menjadi Rp. 5,000', 1611256526),
(13, 1, 5, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1611256530),
(14, 1, 5, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1611256534),
(15, 1, 2, 'telah mengubah pembayaran minggu ke-4 dari Rp. 4,000 menjadi Rp. 3,000', 1611257026),
(16, 1, 2, 'telah mengubah pembayaran minggu ke-4 dari Rp. 3,000 menjadi Rp. 5,000', 1652453172),
(17, 1, 3, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1652453181),
(18, 1, 3, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 5,000', 1652453187),
(19, 1, 4, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1652453192),
(20, 1, 4, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1652453196),
(21, 1, 4, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 5,000', 1652453201),
(22, 1, 5, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1652453205),
(23, 1, 5, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 5,000', 1652453209),
(24, 1, 11, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1652453353),
(25, 1, 11, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1652453358),
(26, 1, 11, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1652453362),
(27, 1, 11, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 5,000', 1652453366),
(28, 2, 11, 'telah mengubah pembayaran minggu ke-4 dari Rp. 5,000 menjadi Rp. 1,000', 1652454260),
(29, 2, 11, 'telah mengubah pembayaran minggu ke-4 dari Rp. 1,000 menjadi Rp. 5,000', 1652454272),
(30, 1, 12, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1716729178),
(31, 1, 2, 'telah mengubah pembayaran minggu ke-4 dari Rp. 5,000 menjadi Rp. 5,000', 1716729507),
(32, 1, 2, 'telah mengubah pembayaran minggu ke-4 dari Rp. 5,000 menjadi Rp. 4,000', 1716735960),
(33, 1, 58, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1716774819),
(34, 1, 63, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1716775410),
(35, 1, 63, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1716775418),
(36, 1, 63, 'telah mengubah pembayaran minggu ke-3 dari Rp. 0 menjadi Rp. 5,000', 1716775425),
(37, 1, 63, 'telah mengubah pembayaran minggu ke-4 dari Rp. 0 menjadi Rp. 5,000', 1716775438),
(38, 1, 81, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1716777607),
(39, 1, 80, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1716777616),
(40, 1, 79, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1716777623),
(41, 4, 81, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1717395920),
(42, 4, 80, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1717395928),
(43, 1, 79, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1717396094),
(44, 1, 82, 'telah mengubah pembayaran minggu ke-1 dari Rp. 0 menjadi Rp. 5,000', 1717396106),
(45, 1, 82, 'telah mengubah pembayaran minggu ke-2 dari Rp. 0 menjadi Rp. 5,000', 1717396111);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pengeluaran`
--

CREATE TABLE `riwayat_pengeluaran` (
  `id_riwayat_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_pengeluaran`
--

INSERT INTO `riwayat_pengeluaran` (`id_riwayat_pengeluaran`, `id_user`, `aksi`, `tanggal`) VALUES
(1, 1, 'telah menambahkan pengeluaran Pembersih lantai dengan biaya Rp. 2,000', 1611256576),
(2, 1, 'telah menambahkan pengeluaran sapu x1 dengan biaya Rp. 10,000', 1611256589),
(3, 1, 'telah mengubah pengeluaran Pembersih lantai 2x dari biaya Rp. 2,000 menjadi Rp. 2,000', 1611256595),
(4, 1, 'telah mengubah pengeluaran Pembersih lantai x2 dari biaya Rp. 2,000 menjadi Rp. 2,000', 1611256599),
(5, 1, 'telah menambahkan pengeluaran Beli Sapu 2pcs dengan biaya Rp. 20,000', 1652453635),
(6, 1, 'telah menambahkan pengeluaran Beli Pel Lantai 2pcs dengan biaya Rp. 28,000', 1652453668),
(7, 1, 'telah menambahkan pengeluaran Beli Sabun Pel 12pcs (1 renceng) dengan biaya Rp. 10,000', 1652453690),
(8, 1, 'telah menambahkan pengeluaran Beli Spidol hitam 3pcs dengan biaya Rp. 30,000', 1652453749),
(9, 1, 'telah menambahkan pengeluaran Penghapus Papan Tulis dengan biaya Rp. 9,000', 1652453779),
(10, 1, 'telah mengubah pengeluaran Beli Spidol hitam 2pcs dari biaya Rp. 30,000 menjadi Rp. 20,000', 1652453803),
(11, 1, 'telah menambahkan pengeluaran Ember Anti Pecah dengan biaya Rp. 35,000', 1652453820),
(12, 1, 'telah mengubah pengeluaran Beli Wipol Pel 12pcs (1 renceng) dari biaya Rp. 10,000 menjadi Rp. 10,000', 1652453855),
(13, 1, 'telah mengubah pengeluaran Beli Pel Lantai 1pcs dari biaya Rp. 28,000 menjadi Rp. 15,000', 1652453877),
(14, 1, 'telah mengubah pengeluaran Ember Anti Pecah dari biaya Rp. 35,000 menjadi Rp. 40,000', 1652453886),
(15, 1, 'telah mengubah pengeluaran Beli Spidol Hitam 2pcs dari biaya Rp. 20,000 menjadi Rp. 20,000', 1652453900),
(16, 1, 'telah menambahkan pengeluaran Beli soteh\r\n dengan biaya Rp. 90,900', 1716632890),
(17, 1, 'telah menambahkan pengeluaran Beli Pulpen  dengan biaya Rp. 2,000', 1716736200),
(18, 4, 'telah mengubah pengeluaran Beli Spidol Hitam 2pcs dari biaya Rp. 20,000 menjadi Rp. 20,000', 1717395943),
(19, 4, 'telah mengubah pengeluaran Beli Pel Lantai 1pcs dari biaya Rp. 15,000 menjadi Rp. 10,000', 1717395959),
(20, 1, 'telah mengubah pengeluaran Beli Sapu 2pcs dari biaya Rp. 20,000 menjadi Rp. 10,000', 1717396015),
(21, 1, 'telah mengubah pengeluaran Beli Wipol Pel 12pcs (1 renceng) dari biaya Rp. 10,000 menjadi Rp. 5,000', 1717396026),
(22, 1, 'telah mengubah pengeluaran Beli Wipol Pel 1pcs\r\n dari biaya Rp. 5,000 menjadi Rp. 5,000', 1717396040);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `no_telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `jenis_kelamin`, `no_telepon`, `email`) VALUES
(14, 'Reihan Putra', 'pria', '089897474376', 'dzka4@gmail.com'),
(15, 'Jaki Ali', 'pria', '089897474376', 'dzkal.444@gmail.com'),
(16, 'El Rey', 'wanita', '08998397593753', 'rey.444@gmail.com'),
(17, 'Fitriyeah', 'wanita', '08979664535', 'fitriyeahliana@wati');

-- --------------------------------------------------------

--
-- Table structure for table `uang_kas`
--

CREATE TABLE `uang_kas` (
  `id_uang_kas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_bulan_pembayaran` int(11) NOT NULL,
  `minggu_ke_1` int(11) DEFAULT NULL,
  `minggu_ke_2` int(11) DEFAULT NULL,
  `minggu_ke_3` int(11) DEFAULT NULL,
  `minggu_ke_4` int(11) DEFAULT NULL,
  `status_lunas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uang_kas`
--

INSERT INTO `uang_kas` (`id_uang_kas`, `id_siswa`, `id_bulan_pembayaran`, `minggu_ke_1`, `minggu_ke_2`, `minggu_ke_3`, `minggu_ke_4`, `status_lunas`) VALUES
(79, 14, 16, 5000, 5000, 0, 0, 0),
(80, 15, 16, 5000, 5000, 0, 0, 0),
(81, 16, 16, 5000, 5000, 0, 0, 0),
(82, 17, 16, 5000, 5000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `id_jabatan`) VALUES
(1, 'Sindi Epiani', 'sindi', '$2y$10$RtlG8gY2cp/2BYEeMBJ2C.tMli1qvWGCoT/jkKIZVNrRJ/4cGbbTm', 1),
(2, 'Amanda Nur', 'amanda', '$2y$10$fdeYDCtDbXiGEQGLtbiAgOjZe240BbZJfVZK.61cItcJ/VZqO.f4.', 2),
(4, 'ivana putri', 'ivana', '$2y$10$dGtVGAOWQYTskF5dNFigS.SfUpJ6S5UjZoYDND7wjNQSdnfPY.e9C', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan_pembayaran`
--
ALTER TABLE `bulan_pembayaran`
  ADD PRIMARY KEY (`id_bulan_pembayaran`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_uang_kas` (`id_uang_kas`);

--
-- Indexes for table `riwayat_pengeluaran`
--
ALTER TABLE `riwayat_pengeluaran`
  ADD PRIMARY KEY (`id_riwayat_pengeluaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `uang_kas`
--
ALTER TABLE `uang_kas`
  ADD PRIMARY KEY (`id_uang_kas`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_bulan_pembayaran` (`id_bulan_pembayaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan_pembayaran`
--
ALTER TABLE `bulan_pembayaran`
  MODIFY `id_bulan_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `riwayat_pengeluaran`
--
ALTER TABLE `riwayat_pengeluaran`
  MODIFY `id_riwayat_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `uang_kas`
--
ALTER TABLE `uang_kas`
  MODIFY `id_uang_kas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
