-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 03:53 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `nama_barang` text NOT NULL,
  `harga_barang` varchar(250) NOT NULL,
  `tgl_input` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `nama_barang`, `harga_barang`, `tgl_input`) VALUES
(23, 'BRG001', 'sosis kecil', '2000', '2 April 2022, 21:33'),
(24, 'BRG002', 'fishroll', '2000', '2 April 2022, 21:34'),
(25, 'BRG003', 'sosis jumbo', '5000', '2 April 2022, 21:34'),
(26, 'BRG004', 'LAMPU PHILIP 30 WATT', '32000', '4 September 2022, 13:05');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_cart` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `quantity` text NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `kembalian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laporanku`
--

CREATE TABLE `laporanku` (
  `id_cart` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `quantity` text NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `kembalian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporanku`
--

INSERT INTO `laporanku` (`id_cart`, `kode_barang`, `nama_barang`, `harga_barang`, `quantity`, `subtotal`, `tgl_input`, `no_transaksi`, `bayar`, `kembalian`) VALUES
(85, 'BRG001', 'sosis kecil', '2000', '2', '4000', '2 April 2022', 'AD20420222136', '30000', '6000'),
(86, 'BRG003', 'sosis jumbo', '5000', '4', '20000', '2 April 2022', 'AD20420222136', '30000', '6000'),
(91, 'BRG001', 'sosis kecil', '2000', '2', '4000', '3 July 2022', 'AD30720222042', '5000', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `user` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `nama_toko`, `user`, `pass`, `alamat`, `telp`) VALUES
(1, 'LOGO MART', 'admin', 'admin', 'WONOSARI-BONDOWOSO', '0852456784');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `laporanku`
--
ALTER TABLE `laporanku`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporanku`
--
ALTER TABLE `laporanku`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
