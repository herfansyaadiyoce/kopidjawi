-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 03:57 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warungkopidjawi`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `foto_menu` varchar(100) NOT NULL,
  `deskripsi_menu` text NOT NULL,
  `status_menu` varchar(10) NOT NULL DEFAULT 'ready',
  `kategori_menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga_menu`, `foto_menu`, `deskripsi_menu`, `status_menu`, `kategori_menu`) VALUES
(6, 'Mie goreng', 7000, '1_far_cry_primal_totem.jpg', 'mie goreng dengan rasa b aja adssada dddda ddddd adddddddadada dasda daasdad adssad ', 'ready', 'Minuman'),
(21, 'Random 1', 13000, '62884494-monster-hunter-wallpapers.jpg', 'gambar naga', 'ready', 'Minuman'),
(22, 'random ', 21000, '63659155-monster-hunter-wallpapers.jpg', 'random ', 'ready', 'Minuman'),
(23, 'Bebek Bakar', 28000, '60c87bb08febf.jpg', 'Bebek nikmat dibakar', 'ready', 'Makanan'),
(24, 'Mie Bahagia', 29000, 'no_mans_sky_5-wallpaper-1920x1080.jpg', 'Yang penting bahagia dehhh', 'ready', 'Makanan'),
(25, 'Nasi Kuning', 5000, 'this_is_sparta-wallpaper-1920x1080.jpg', 'Nasinya kuning gaess', 'ready', 'Makanan'),
(26, 'Mendoan', 8000, 'w644.jpg', 'Bukan tempe biasa', 'ready', 'Makanan'),
(27, 'Es Campur', 12000, 'full_moon_reflection_water-wallpaper-2048x1536.jpg', 'Campuran dari segala macam es', 'ready', 'Minuman'),
(28, 'Sate Ayam', 15000, 'longdesertroad-1508128594179-9630.jpg', 'Sate dengan ayam dibakar', 'ready', 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `nomer_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `nomer_meja`) VALUES
(1, 'Herfansya', 3),
(7, 'Saiful', 25),
(18, 'Reza', 18);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `total_pemesanan` int(11) NOT NULL,
  `status_pemesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pelanggan`, `tanggal_pemesanan`, `total_pemesanan`, `status_pemesanan`) VALUES
(1, 1, '2024-05-19 00:00:00', 28000, '0'),
(2, 2, '2024-05-19 00:00:00', 35000, '0'),
(16, 18, '2024-05-27 15:29:54', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_menu`
--

CREATE TABLE `pemesanan_menu` (
  `id_pemesanan_menu` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan_menu`
--

INSERT INTO `pemesanan_menu` (`id_pemesanan_menu`, `id_pemesanan`, `id_menu`, `jumlah`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 0, 6, 5),
(4, 0, 27, 5),
(5, 0, 21, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `pemesanan_menu`
--
ALTER TABLE `pemesanan_menu`
  ADD PRIMARY KEY (`id_pemesanan_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pemesanan_menu`
--
ALTER TABLE `pemesanan_menu`
  MODIFY `id_pemesanan_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
