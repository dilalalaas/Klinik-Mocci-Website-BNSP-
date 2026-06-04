-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 03:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik-mocci`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_layanan`
--

CREATE TABLE `tb_layanan` (
  `layanan_id` int(11) NOT NULL,
  `nomor_layanan` int(11) DEFAULT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `deskripsi_layanan` text NOT NULL,
  `harga_layanan` decimal(10,0) NOT NULL,
  `gambar_layanan` varchar(255) DEFAULT NULL,
  `status` enum('disetujui','tidak_disetujui') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_layanan`
--

INSERT INTO `tb_layanan` (`layanan_id`, `nomor_layanan`, `nama_layanan`, `deskripsi_layanan`, `harga_layanan`, `gambar_layanan`, `status`) VALUES
(1, NULL, 'Facial Detox', 'Facial Detox adalah perawatan wajah  untuk membersihkan kulit secara mendalam dari kotoran, minyak berlebih, racun, dan zat-zat berbahaya lainnya yang menumpuk di permukaan kulit dan pori-pori.', '250000', 'facial detox.jpg', 'disetujui'),
(2, NULL, 'Facial Basic', 'Facial Basic adalah perawatan wajah dasar untuk membersihkan kulit wajah dari kotoran, minyak berlebih, dan sel kulit mati', '90000', 'facial basic.jpg', 'disetujui'),
(3, NULL, 'IPL Rejuve', 'IPL Rejuve (Intense Pulsed Light Rejuvenation) adalah perawatan kulit non-invasif yang menggunakan cahaya berintensitas tinggi untuk meremajakan kulit dan mengatasi berbagai masalah seperti noda hitam, flek, kemerahan, kerutan, dan tanda-tanda penuaan.', '160000', 'IPL Rejuve.jpg', 'disetujui'),
(4, NULL, 'Acne Rejuve', 'Acne Rejuve adalah perawatan kulit yang ditujukan untuk mengatasi jerawat dan peremajaan kulit secara bersamaan. ', '175000', 'Acne Rejuve.jpg', 'disetujui'),
(5, NULL, 'Eye Treatment', 'Eye treatment (perawatan mata) adalah perawatan untuk memperbaiki kondisi kulit di sekitar mata, seperti menghilangkan lingkaran hitam, kantung mata, kerutan halus, dan mata lelah.', '110000', 'Eye Treatment.jpg', 'disetujui'),
(6, NULL, 'Facial Collagen', 'Facial collagen adalah perawatan wajah yang berfokus pada penggunaan kolagen untuk meningkatkan kesehatan dan penampilan kulit.', '275000', 'Facial Collagen.jpg', 'disetujui'),
(7, NULL, 'Smooth Treatment Glowing', 'Smooth Treatment Glowing adalah perawatan kulit yang bertujuan untuk menghasilkan tampilan yang halus dan bercahaya atau glowing', '180000', 'Smooth Treatment Glowing.jpg', 'disetujui'),
(8, NULL, 'Laser Black Doll Bright', 'Laser Black Doll Bright, atau disebut juga Laser Black Doll atau Laser Peel, adalah perawatan kulit yang menggunakan teknologi laser Q-switched Nd:YAG dan masker karbon hitam (charcoal) untuk mencerahkan wajah, mengurangi flek hitam, mengecilkan pori-pori, dan merangsang produksi kolagen.', '350000', 'Laser Black Doll Bright.jpg', 'disetujui'),
(10, NULL, 'Laser Bibir Hitam', 'Laser bibir atau Lip Laser Treatment) adalah prosedur kecantikan non-invasif yang menggunakan teknologi laser untuk memperbaiki dan meningkatkan penampilan bibir.', '100000', 'Laser Bibir Hitam.jpg', 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `status_pemesanan` enum('menunggu','disetujui','ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`pemesanan_id`, `user_id`, `layanan_id`, `tanggal_pesan`, `status_pemesanan`) VALUES
(1, 3, 1, '2025-06-14 02:18:39', 'ditolak'),
(2, 4, 5, '2025-06-14 03:21:18', 'disetujui'),
(3, 4, 6, '2025-06-14 03:39:01', 'disetujui'),
(4, 4, 5, '2025-06-14 03:48:16', 'ditolak'),
(5, 4, 2, '2025-06-20 06:22:25', 'menunggu'),
(6, 4, 2, '2025-06-20 11:11:37', 'menunggu'),
(7, 4, 8, '2025-06-20 11:11:58', 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `nama`, `email`, `password`) VALUES
(1, 'klinik mocci', 'user@mocci.com', 'user123'),
(2, 'Admin Mocci Klinik', 'admin@mocci.com', 'admin123'),
(3, 'Admin Klinik', 'klinik@mocci.com', 'admin'),
(4, 'Lala User', 'lala@mocci.com', 'lala123'),
(5, 'dilala', 'dila@mocci.com', 'dila123'),
(6, 'sasa', 'sasa@mocci.com', 'sasa123'),
(7, 'fifi', 'fifi@mocci.com', 'fifi123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  ADD PRIMARY KEY (`layanan_id`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  MODIFY `layanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
