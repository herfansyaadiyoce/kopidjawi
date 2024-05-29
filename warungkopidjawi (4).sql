-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2024 at 01:20 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `id_menu` int NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int NOT NULL,
  `foto_menu` varchar(100) NOT NULL,
  `deskripsi_menu` text NOT NULL,
  `status_menu` varchar(10) NOT NULL DEFAULT 'ready',
  `kategori_menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(28, 'Sate Ayam', 15000, 'longdesertroad-1508128594179-9630.jpg', 'Sate dengan ayam dibakar', 'ready', 'Makanan'),
(29, 'Es Cincau', 6000, 'forest_stream_black_and_white-wallpaper-3840x2160.jpg', 'Es bukan sembarang Es', 'ready', 'Minuman'),
(30, 'Es Cacing ', 21000, 'x22x5x55adb54869401b5985c1a5dc_2160yjpg.jpg', 'Cacing nikmat murce', 'ready', 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomer_meja` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `nomer_meja`) VALUES
(72, 'garyyy', 76),
(73, 'Sajaaa', 32),
(74, 'Sambo', 10),
(75, 'andika', 13),
(76, 'krisna', 16),
(77, 'Abdi', 11),
(78, 'Sendi', 17),
(79, 'aji', 13),
(80, 'Adi', 33),
(81, 'Herman', 19),
(82, 'zzzz', 66),
(83, 'www', 65),
(84, 'tyy', 44),
(85, 'Paijo', 33),
(86, 'wqw', 333),
(87, 'safei', 32),
(88, 'Rahmat', 11),
(89, 'dadads', 333),
(90, 'QQQQ', 1),
(91, 'sadasd', 3),
(92, 'vvv', 99),
(93, 'eddd', 44),
(94, 'Samsul', 17),
(95, 'asasasa', 33),
(96, 'Jamal', 32),
(97, 'asas', 2),
(98, 'aaaaa', 1),
(99, 'adaaa', 33),
(100, 'Adawww', 4),
(101, 'fff', 4),
(102, 'AAJX', 333),
(103, 'Abdissss', 2),
(104, 'aaaa', 2),
(105, 'Rahmat', 2),
(106, 'andi', 2),
(107, 'dd', 4),
(108, 'Karina', 3),
(109, 'Ahmad', 1),
(110, 'qwqw', 22),
(111, 'warrr', 11),
(112, 'reza', 11),
(113, 'Indo', 90);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pelanggan`, `id_pemesanan`, `metode_pembayaran`, `bukti_pembayaran`) VALUES
(1, 1, 1, 'bayar di kasir', 'gambar.jpg\r\n'),
(2, 95, 103, 'qris', 'gambar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `nama_menu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `total_pemesanan` int NOT NULL,
  `status_pemesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pelanggan`, `tanggal_pemesanan`, `nama_menu`, `total_pemesanan`, `status_pemesanan`) VALUES
(76, 72, '2024-05-28 08:33:12', NULL, 462000, 'belum'),
(77, 73, '2024-05-28 09:21:36', NULL, 7000, 'belum'),
(78, 74, '2024-05-28 09:22:01', NULL, 7000, 'belum'),
(79, 74, '2024-05-28 09:22:09', NULL, 0, 'belum'),
(80, 75, '2024-05-28 09:23:01', NULL, 7000, 'belum'),
(81, 75, '2024-05-28 09:23:21', NULL, 0, 'belum'),
(82, 76, '2024-05-28 09:23:37', NULL, 7000, 'belum'),
(83, 76, '2024-05-28 14:42:25', NULL, 0, 'belum'),
(84, 77, '2024-05-28 15:13:22', NULL, 112000, 'belum'),
(85, 77, '2024-05-28 15:13:28', NULL, 0, 'belum'),
(86, 78, '2024-05-28 15:14:24', NULL, 112000, 'belum'),
(87, 79, '2024-05-28 15:42:23', NULL, 0, 'belum'),
(88, 80, '2024-05-28 15:49:34', NULL, 0, 'belum'),
(89, 81, '2024-05-28 15:56:26', NULL, 25000, 'belum'),
(90, 82, '2024-05-28 15:56:55', NULL, 29000, 'belum'),
(91, 83, '2024-05-28 15:58:45', NULL, 6000, 'belum'),
(92, 84, '2024-05-28 16:09:54', NULL, 0, 'belum'),
(93, 85, '2024-05-28 16:12:00', NULL, 0, 'belum'),
(94, 86, '2024-05-28 16:14:08', NULL, 21000, 'belum'),
(95, 87, '2024-05-28 17:24:02', NULL, 13000, 'belum'),
(96, 88, '2024-05-28 17:32:17', NULL, 0, 'belum'),
(97, 89, '2024-05-28 17:41:58', NULL, 0, 'belum'),
(98, 90, '2024-05-28 17:44:55', NULL, 7000, 'belum'),
(99, 91, '2024-05-28 18:20:31', NULL, 13000, 'belum'),
(100, 92, '2024-05-28 18:21:16', NULL, 28000, 'diproses'),
(101, 93, '2024-05-28 18:32:26', NULL, 7000, 'diproses'),
(102, 94, '2024-05-29 04:27:10', NULL, 7000, 'Belum Diproses'),
(103, 95, '2024-05-29 04:48:19', NULL, 21000, 'belum diproses'),
(104, 96, '2024-05-29 04:55:41', NULL, 21000, 'belum diproses'),
(105, 97, '2024-05-29 05:04:56', NULL, 0, 'belum'),
(106, 98, '2024-05-29 05:14:04', NULL, 6000, 'belum diproses'),
(107, 99, '2024-05-29 05:14:35', NULL, 12000, 'belum diproses'),
(108, 100, '2024-05-29 05:16:03', NULL, 8000, 'belum diproses'),
(109, 101, '2024-05-29 05:19:57', NULL, 28000, 'belum diproses'),
(110, 102, '2024-05-29 05:28:15', NULL, 28000, 'belum diproses'),
(111, 103, '2024-05-29 05:31:08', NULL, 12000, 'belum diproses'),
(112, 104, '2024-05-29 05:37:48', NULL, 7000, 'belum diproses'),
(113, 105, '2024-05-29 05:47:45', NULL, 0, 'belum'),
(114, 106, '2024-05-29 05:48:21', NULL, 0, 'belum'),
(115, 107, '2024-05-29 05:51:44', NULL, 6000, 'belum diproses'),
(116, 108, '2024-05-29 05:53:13', NULL, 29000, 'selesai'),
(117, 109, '2024-05-29 08:22:47', NULL, 13000, 'belum'),
(118, 110, '2024-05-29 08:38:57', NULL, 21000, 'selesai'),
(119, 111, '2024-05-29 13:03:26', NULL, 0, 'selesai'),
(120, 112, '2024-05-29 13:11:05', NULL, 7000, 'diproses'),
(121, 113, '2024-05-29 13:15:21', NULL, 0, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_menu`
--

CREATE TABLE `pemesanan_menu` (
  `id_pemesanan_menu` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `id_menu` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan_menu`
--

INSERT INTO `pemesanan_menu` (`id_pemesanan_menu`, `id_pemesanan`, `id_menu`, `jumlah`) VALUES
(40, 76, 30, 22),
(41, 82, 6, 1),
(42, 84, 30, 5),
(43, 84, 6, 1),
(44, 86, 30, 5),
(45, 86, 6, 1),
(46, 89, 27, 1),
(47, 89, 21, 1),
(48, 90, 30, 1),
(49, 90, 26, 1),
(50, 91, 29, 1),
(51, 94, 30, 1),
(52, 95, 21, 1),
(53, 98, 6, 1),
(54, 99, 21, 1),
(55, 100, 22, 1),
(56, 100, 6, 1),
(57, 101, 6, 1),
(58, 102, 6, 1),
(59, 103, 30, 1),
(60, 104, 30, 1),
(61, 106, 29, 1),
(62, 107, 27, 1),
(63, 108, 26, 1),
(64, 109, 23, 1),
(65, 110, 23, 1),
(66, 111, 27, 1),
(67, 112, 6, 1),
(68, 115, 29, 1),
(69, 116, 24, 1),
(70, 117, 21, 1),
(71, 118, 22, 1),
(72, 120, 6, 1);

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
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

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
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `pemesanan_menu`
--
ALTER TABLE `pemesanan_menu`
  MODIFY `id_pemesanan_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
