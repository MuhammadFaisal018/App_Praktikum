-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2024 at 03:34 AM
-- Server version: 8.0.30
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `juruparkir`
--

CREATE TABLE `juruparkir` (
  `id_juru` int NOT NULL,
  `nama_juru` varchar(255) NOT NULL,
  `tempat_tgl_lahir` varchar(255) NOT NULL,
  `ktp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `wilayah_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `juruparkir`
--

INSERT INTO `juruparkir` (`id_juru`, `nama_juru`, `tempat_tgl_lahir`, `ktp`, `alamat`, `telepon`, `foto`, `wilayah_id`) VALUES
(1, 'Udin Setiadi', 'Banjarmasin, 2023-09-18', '62030405180302002', 'JL Cemara Raya', '085654142906', 'dishub.png', 1),
(4, 'Muhammad Faisal', 'kuala kapuas , 2002-03-18', '62030018032002', 'Jl. A Yani 3km', '085654142906', 'default_filename.jpg', 3),
(5, 'Nawaf Hamim', 'Banjarmasin, 12 januari 1998', '62030018031990', 'Jl Sultan Adam', '082197512152', 'default_filename.jpg', 2),
(6, 'Amat P', 'Amuntai, 1990-03-18', '62030018031990', 'Jl. Sultan Adam, Sungai Miai', '085654141644', 'default_filename.jpg', 2),
(7, 'Anang Herman', 'Kandangan, 1995-03-18', '62030018031995', 'Jl. HKSN', '082197512152', 'default_filename.jpg', 2),
(10, 'Rizal Ramadhan', 'Banjarmasin, 12 januari 1995', '62030018031990', 'Jl Kayutangi', '08216475789', 'images/65b255ccbc066_logo.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `koordinator`
--

CREATE TABLE `koordinator` (
  `id_id_koor` int NOT NULL,
  `nama_koor` varchar(255) NOT NULL,
  `tempat_tgl_lahir` varchar(255) DEFAULT NULL,
  `ktp` varchar(20) NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `wilayah_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `koordinator`
--

INSERT INTO `koordinator` (`id_id_koor`, `nama_koor`, `tempat_tgl_lahir`, `ktp`, `alamat`, `telepon`, `foto`, `wilayah_id`) VALUES
(1, 'Sholeh', 'Banjarmasin, 12 januari 1969', '62030018031969', 'Jl Flamboyan 3', '082310397846', 'default_filename.jpg', 3),
(3, 'Muhammad Faisal', 'kuala kapuas 18 maret 2002', '62030018032002', 'Jl. Flamboyan 3 ', '082197512152', 'default_filename.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `wilayah_id` int NOT NULL,
  `nama_juru` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_koor` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobil_masuk` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobil_keluar` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `tanggal`, `wilayah_id`, `nama_juru`, `nama_koor`, `mobil_masuk`, `mobil_keluar`, `jumlah`) VALUES
(1, NULL, 2, 'Udin Setiadi', 'Sholeh', '500', '300', 200),
(2, '2024-02-25', 1, 'Muhammad Faisal', 'Muhammad Faisal', '500', '250', 250);

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `id_motor` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `wilayah_id` int NOT NULL,
  `nama_juru` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_koor` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `motor_masuk` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `motor_keluar` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`id_motor`, `tanggal`, `wilayah_id`, `nama_juru`, `nama_koor`, `motor_masuk`, `motor_keluar`, `jumlah`) VALUES
(2, NULL, 3, 'Udin Setiadi', 'Sholeh', '100', '50', 80),
(3, NULL, 2, 'Muhammad Faisal', 'Sholeh', '870', '780', 90),
(4, NULL, 2, 'Nawaf Hamim', 'Muhammad Faisal', '800', '500', 300),
(5, '2024-01-24', 2, 'Udin Setiadi', 'Muhammad Faisal', '1023', '500', 523);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'faisal', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int NOT NULL,
  `nama_wilayah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `nama_wilayah`) VALUES
(1, 'Pasar Lama Blok A'),
(2, 'Pasar Sudimampir Blok A'),
(3, 'Pasar Belauran Blok B'),
(4, 'Pasar Belitung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `juruparkir`
--
ALTER TABLE `juruparkir`
  ADD PRIMARY KEY (`id_juru`),
  ADD KEY `wilayah_id` (`wilayah_id`);

--
-- Indexes for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD PRIMARY KEY (`id_id_koor`),
  ADD KEY `wilayah_id` (`wilayah_id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id_motor`),
  ADD KEY `wilayah_id` (`wilayah_id`),
  ADD KEY `nama_juru` (`nama_juru`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `juruparkir`
--
ALTER TABLE `juruparkir`
  MODIFY `id_juru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `koordinator`
--
ALTER TABLE `koordinator`
  MODIFY `id_id_koor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `id_motor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `juruparkir`
--
ALTER TABLE `juruparkir`
  ADD CONSTRAINT `juruparkir_ibfk_1` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`);

--
-- Constraints for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD CONSTRAINT `koordinator_ibfk_1` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
