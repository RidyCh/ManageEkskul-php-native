-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 05:26 AM
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
-- Database: `ekskul_managemen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `kelas` varchar(15) NOT NULL,
  `id_ekskul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama_anggota`, `kelas`, `id_ekskul`) VALUES
(1, 'ren', '12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekskul`
--

CREATE TABLE `tb_ekskul` (
  `id_ekskul` int(11) NOT NULL,
  `ekskul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ekskul`
--

INSERT INTO `tb_ekskul` (`id_ekskul`, `ekskul`) VALUES
(1, 'Basket'),
(2, 'Futsal'),
(3, 'Cospala');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `tanggal_ekskul` date NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `jam_mulai` time(6) NOT NULL,
  `jam_selesai` time(6) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi`
--

CREATE TABLE `tb_presensi` (
  `id_presensi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `kehadiran` enum('Hadir','Tidak Hadir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `id_ekskul` int(11) NOT NULL,
  `nama_pembina` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `id_ekskul`, `nama_pembina`) VALUES
(1, 'admin-basket', 'password', 'ketua basket', 1, ''),
(2, 'admin-futsal', 'password', 'ketua futsal', 2, ''),
(3, 'admin-cospala', 'password', 'ketua cospala', 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `anggota_ibfk_1` (`id_ekskul`);

--
-- Indexes for table `tb_ekskul`
--
ALTER TABLE `tb_ekskul`
  ADD PRIMARY KEY (`id_ekskul`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_ibfk_1` (`id_ekskul`);

--
-- Indexes for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `presensi_ibfk_1` (`id_anggota`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `tb _user_ibfk_1` (`id_ekskul`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ekskul`
--
ALTER TABLE `tb_ekskul`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_ekskul`) REFERENCES `tb_user` (`id_ekskul`);

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_ekskul`) REFERENCES `tb_user` (`id_ekskul`);

--
-- Constraints for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD CONSTRAINT `tb_presensi_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`),
  ADD CONSTRAINT `tb_presensi_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `tb_jadwal` (`id_jadwal`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb _user_ibfk_1` FOREIGN KEY (`id_ekskul`) REFERENCES `tb_ekskul` (`id_ekskul`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
