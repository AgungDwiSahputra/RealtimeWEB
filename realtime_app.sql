-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 04:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realtime_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `no_jawaban` int(11) NOT NULL,
  `no_user` int(11) NOT NULL,
  `hasil` text NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `ttl_pengerjaan` datetime NOT NULL,
  `no_soal` int(11) NOT NULL,
  `kd_soal` varchar(10) NOT NULL,
  `status` enum('tidak','selesai') NOT NULL,
  `ttl_selesai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`no_jawaban`, `no_user`, `hasil`, `kategori`, `ttl_pengerjaan`, `no_soal`, `kd_soal`, `status`, `ttl_selesai`) VALUES
(553, 12, '', 'berhitung', '2022-06-30 21:07:58', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(554, 12, 'D', 'berhitung', '2022-06-30 21:12:11', 3, 'BER', 'selesai', '2022-06-30 09:24:54'),
(555, 12, 'C', 'berhitung', '2022-06-30 21:20:35', 3, 'BER', 'selesai', '2022-06-30 09:24:54'),
(556, 12, 'G', 'berhitung', '2022-06-30 21:24:11', 3, 'BER', 'selesai', '2022-06-30 09:24:54'),
(557, 12, 'B', 'berhitung', '2022-06-30 21:24:14', 3, 'BER', 'selesai', '2022-06-30 09:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_user2`
--

CREATE TABLE `jawaban_user2` (
  `no_jawaban` int(11) NOT NULL,
  `no_user` int(11) NOT NULL,
  `hasil` varchar(5) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `ttl_pengerjaan` datetime NOT NULL,
  `no_soal` int(11) NOT NULL,
  `kd_soal` varchar(10) NOT NULL,
  `status` enum('tidak','selesai') NOT NULL,
  `ttl_selesai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban_user2`
--

INSERT INTO `jawaban_user2` (`no_jawaban`, `no_user`, `hasil`, `kategori`, `ttl_pengerjaan`, `no_soal`, `kd_soal`, `status`, `ttl_selesai`) VALUES
(233, 79, 'E', 'berhitung', '2022-06-30 21:09:54', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(234, 79, 'E', 'berhitung', '2022-06-30 21:09:56', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(235, 79, 'E', 'berhitung', '2022-06-30 21:10:02', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(236, 79, 'E', 'berhitung', '2022-06-30 21:10:05', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(237, 79, 'F', 'berhitung', '2022-06-30 21:15:02', 3, 'BER', 'selesai', '2022-06-30 09:24:54'),
(238, 79, 'B', 'berhitung', '2022-06-30 21:23:26', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(239, 79, 'G', 'berhitung', '2022-06-30 21:23:32', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(240, 79, 'E', 'berhitung', '2022-06-30 21:23:39', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(241, 79, 'A', 'berhitung', '2022-06-30 21:23:43', 1, 'BER', 'selesai', '2022-06-30 09:24:54'),
(242, 79, 'A', 'berhitung', '2022-06-30 21:24:23', 3, 'BER', 'selesai', '2022-06-30 09:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `no_kategori` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`no_kategori`, `kategori`) VALUES
(1, 'berhitung'),
(5, 'membaca'),
(10, 'menulis');

-- --------------------------------------------------------

--
-- Table structure for table `pengerjaan`
--

CREATE TABLE `pengerjaan` (
  `no_pengerjaan` int(11) NOT NULL,
  `no_user` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `ttl_pengerjaan` datetime NOT NULL,
  `no_soal` int(11) NOT NULL,
  `ttl_selesai` datetime DEFAULT NULL,
  `status` enum('tidak','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengerjaan`
--

INSERT INTO `pengerjaan` (`no_pengerjaan`, `no_user`, `kategori`, `ttl_pengerjaan`, `no_soal`, `ttl_selesai`, `status`) VALUES
(53, 12, 'berhitung', '2022-06-30 21:07:58', 1, '2022-06-30 09:24:54', 'selesai'),
(54, 12, 'berhitung', '2022-06-30 21:12:11', 3, '2022-06-30 09:24:54', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `no_soal` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`no_soal`, `pertanyaan`, `kategori`) VALUES
(1, '1+1', 'berhitung'),
(2, '1+1+2', 'berhitung'),
(3, '3+2+10', 'berhitung'),
(4, 'Ada Apa Mengapa', 'membaca'),
(5, 'Siapa DImana Bagaimana', 'membaca'),
(6, 'Coba Tulis Huruf AB', 'menulis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `no_user` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` enum('admin1','admin2','user1','user2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`no_user`, `username`, `password`, `nama`, `level`) VALUES
(12, 'admin', 'admin', 'Agung Dwi Sahputra', 'admin1'),
(14, 'admin2', 'admin2', 'Admin ke 2', 'admin2'),
(54, 'user1', 'user1', 'User ke 1', 'user1'),
(77, 'user2', 'user2', 'User ke 2', 'user2'),
(78, 'DeCreative', '12345', 'Coba Insert Data', 'user2'),
(79, 'coba1', 'coba1', 'Coba User 2', 'user2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`no_jawaban`),
  ADD KEY `jawaban` (`no_user`),
  ADD KEY `No_Soal` (`no_soal`);

--
-- Indexes for table `jawaban_user2`
--
ALTER TABLE `jawaban_user2`
  ADD PRIMARY KEY (`no_jawaban`),
  ADD KEY `No User` (`no_user`),
  ADD KEY `No Soal` (`no_soal`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`no_kategori`);

--
-- Indexes for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD PRIMARY KEY (`no_pengerjaan`),
  ADD KEY `User` (`no_user`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`no_soal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `no_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

--
-- AUTO_INCREMENT for table `jawaban_user2`
--
ALTER TABLE `jawaban_user2`
  MODIFY `no_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `no_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  MODIFY `no_pengerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `no_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `no_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `No_Soal` FOREIGN KEY (`no_soal`) REFERENCES `soal` (`no_soal`),
  ADD CONSTRAINT `jawaban` FOREIGN KEY (`no_user`) REFERENCES `users` (`no_user`);

--
-- Constraints for table `jawaban_user2`
--
ALTER TABLE `jawaban_user2`
  ADD CONSTRAINT `No Soal` FOREIGN KEY (`no_soal`) REFERENCES `soal` (`no_soal`),
  ADD CONSTRAINT `No User` FOREIGN KEY (`no_user`) REFERENCES `users` (`no_user`);

--
-- Constraints for table `pengerjaan`
--
ALTER TABLE `pengerjaan`
  ADD CONSTRAINT `User` FOREIGN KEY (`no_user`) REFERENCES `users` (`no_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
