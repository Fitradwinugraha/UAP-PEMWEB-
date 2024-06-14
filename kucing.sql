-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 05:26 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kucing`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `namakaryawan` varchar(255) NOT NULL,
  `jeniskelamin` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `notelepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `namakaryawan`, `jeniskelamin`, `posisi`, `notelepon`) VALUES
(1, 'Jeniffer Mahalini', 'Laki Laki', 'helper grooming', '081256789021'),
(2, 'Putri Cendekia', 'perempuan', 'penjaga', '089567895124'),
(6, 'Moana', 'perempuan', 'staf media sosial', '089567846720');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama_pemilik`, `no_telepon`, `alamat`) VALUES
(2, 'Lila', '082245678901', 'Kampung Baru, jl. Bumi Manti II'),
(4, 'Dania', '081234567890', 'jl. Abdul Muis gg Anggrek Gedong Meneng'),
(5, 'Ica', '081245678902', 'Kampung Baru, jl. Bumi Manti I');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kucing`
--

CREATE TABLE `tabel_kucing` (
  `id` int(11) NOT NULL,
  `nama_kucing` varchar(50) NOT NULL,
  `jenis_kucing` varchar(50) NOT NULL,
  `berat` varchar(20) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_kucing`
--

INSERT INTO `tabel_kucing` (`id`, `nama_kucing`, `jenis_kucing`, `berat`, `nama_pemilik`) VALUES
(10, 'Milo', 'Persia', '3 kg', 'Lila'),
(12, 'Miki', 'Ragdoll', '2 kg', 'Dania'),
(14, 'Coco', 'Anggora', '2 kg', 'Ica');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengguna`
--

CREATE TABLE `tabel_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_pengguna`
--

INSERT INTO `tabel_pengguna` (`id`, `username`, `password`) VALUES
(1, 'adilla', '123'),
(2, 'fitra', '456'),
(3, 'evi', '789');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi`
--

CREATE TABLE `tabel_transaksi` (
  `id` int(11) NOT NULL,
  `id_kucing` varchar(50) NOT NULL,
  `tanggal_penitipan` date NOT NULL,
  `tanggal_ambil` date NOT NULL,
  `harga_per_hari` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status_pengambilan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_transaksi`
--

INSERT INTO `tabel_transaksi` (`id`, `id_kucing`, `tanggal_penitipan`, `tanggal_ambil`, `harga_per_hari`, `total_harga`, `status_pengambilan`) VALUES
(3, '10', '2024-06-05', '2024-06-06', 70000.00, 70000.00, 'Sudah Diambil'),
(6, '11', '2024-06-05', '2024-06-07', 50000.00, 100000.00, 'Belum Diambil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `tabel_kucing`
--
ALTER TABLE `tabel_kucing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tabel_kucing`
--
ALTER TABLE `tabel_kucing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
