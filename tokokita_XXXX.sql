-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 11:33 AM
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
-- Database: `tokokita_XXXX`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `idAdmin` int(2) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`idAdmin`, `userName`, `password`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `idDetailOrder` int(10) NOT NULL,
  `idOrder` int(5) DEFAULT NULL,
  `idProduk` int(5) DEFAULT NULL,
  `jumlah` int(5) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `idkat` int(5) NOT NULL,
  `namaKat` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`idkat`, `namaKat`) VALUES
(12, 'Laptop'),
(14, 'Baju'),
(20, 'Handphone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `idKonsumen` int(5) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `namaKonsumen` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `idKota` int(4) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tlpn` int(20) DEFAULT NULL,
  `statusAktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`idKonsumen`, `username`, `password`, `namaKonsumen`, `alamat`, `idKota`, `email`, `tlpn`, `statusAktif`) VALUES
(1, 'Ocha', 'aa08769cdcb26674c6706093503ff0a3', 'Ocha', 'Yogyakarta', 419, 'member@gmail.com', 1234567, 'N'),
(2, 'Ocha', 'aa08769cdcb26674c6706093503ff0a3', 'Ocha', 'Surabaya', 419, 'test@gmail.com', 12345678, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ongkir`
--

CREATE TABLE `tbl_ongkir` (
  `idOngkir` int(5) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `kurir` varchar(25) NOT NULL,
  `ongkos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ongkir`
--

INSERT INTO `tbl_ongkir` (`idOngkir`, `tujuan`, `kurir`, `ongkos`) VALUES
(2, 'Jogja', 'TIKI', 5000),
(3, 'Bandung', 'TIKI', 10000),
(6, 'Klaten', 'JNE', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `idOrder` int(5) NOT NULL,
  `idKonsumen` int(5) DEFAULT NULL,
  `idToko` int(10) NOT NULL,
  `tglOrder` date DEFAULT NULL,
  `statusOrder` enum('Belum Bayar','Dikemas','Dikirim','Diterima','Selesai','Dibatalkan') DEFAULT NULL,
  `kurir` varchar(50) NOT NULL,
  `ongkir` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`idOrder`, `idKonsumen`, `idToko`, `tglOrder`, `statusOrder`, `kurir`, `ongkir`) VALUES
(1, 2, 2, '2024-05-31', 'Belum Bayar', 'JNE OKE', 7000),
(2, 2, 8, '2024-05-31', 'Belum Bayar', 'JNE OKE', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `idProduk` int(5) NOT NULL,
  `idKat` int(5) DEFAULT NULL,
  `idToko` int(5) DEFAULT NULL,
  `namaProduk` varchar(200) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `berat` int(5) DEFAULT NULL,
  `deskripsiProduk` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`idProduk`, `idKat`, `idToko`, `namaProduk`, `foto`, `harga`, `stok`, `berat`, `deskripsiProduk`) VALUES
(8, 12, 2, 'Acer', 'black-windows-logo-coolest-desktop-29jh2m2fmq3fardr21.jpg', 12000000, 2, 3, 'Laptop Gaming'),
(9, 14, 8, 'Baju Pria', 'loh.jpeg', 99000, 100, 1, 'Bahan halus dan tahan lama');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_toko`
--

CREATE TABLE `tbl_toko` (
  `idToko` int(5) NOT NULL,
  `idKonsumen` int(5) DEFAULT NULL,
  `namaToko` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `statusAktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_toko`
--

INSERT INTO `tbl_toko` (`idToko`, `idKonsumen`, `namaToko`, `logo`, `deskripsi`, `statusAktif`) VALUES
(2, 2, 'Toko Komputer', '4k-programming-java-script-logo-3hcns7bt28muj7ih2.jpg', 'Toko Lama', 'Y'),
(8, 2, 'Toko Baju', 'toko1.jpg', 'Baju terbaik didunia', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`idDetailOrder`),
  ADD KEY `idProduk` (`idProduk`),
  ADD KEY `idOrder` (`idOrder`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`idkat`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`idKonsumen`);

--
-- Indexes for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  ADD PRIMARY KEY (`idOngkir`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idKonsumen` (`idKonsumen`),
  ADD KEY `idToko` (`idToko`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`idProduk`),
  ADD KEY `idKat` (`idKat`),
  ADD KEY `idToko` (`idToko`);

--
-- Indexes for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD PRIMARY KEY (`idToko`),
  ADD KEY `idKonsumen` (`idKonsumen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `idAdmin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `idDetailOrder` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `idkat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `idKonsumen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  MODIFY `idOngkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `idOrder` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `idProduk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
  MODIFY `idToko` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `tbl_detail_order_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `tbl_order` (`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_order_ibfk_2` FOREIGN KEY (`idProduk`) REFERENCES `tbl_produk` (`idProduk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`idKonsumen`) REFERENCES `tbl_member` (`idKonsumen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`idToko`) REFERENCES `tbl_toko` (`idToko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`idToko`) REFERENCES `tbl_toko` (`idToko`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_produk_ibfk_3` FOREIGN KEY (`idKat`) REFERENCES `tbl_kategori` (`idkat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD CONSTRAINT `tbl_toko_ibfk_1` FOREIGN KEY (`idKonsumen`) REFERENCES `tbl_member` (`idKonsumen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
