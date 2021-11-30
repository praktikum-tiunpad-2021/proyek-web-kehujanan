-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 10:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kehujanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(10) NOT NULL,
  `nama_tag` varchar(255) NOT NULL,
  `id_tugas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id_tag`, `nama_tag`, `id_tugas`) VALUES
(18, 'abc', 28),
(19, 'bcd', 28),
(20, 'efg', 28),
(26, 'abc', 19),
(27, 'cde', 19),
(28, 'bed', 19),
(29, 'aeugh', 21),
(33, 'abc', 31),
(34, 'abc', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(10) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `nama_tugas`, `deskripsi`, `deadline`, `status`, `id_user`) VALUES
(17, 'ayonima', 'sadfg', '2021-11-09 14:46:00', 1, 3),
(18, 'ayo the pizza is here', 'ow n', '2021-11-21 15:00:00', 0, 4),
(19, 'asdfgfhgkj', 'adsfg', '2021-11-27 18:24:00', 0, 5),
(21, 'abcede', 'wdafsdafsd', '2021-11-20 13:03:00', 1, 5),
(22, 'advsbfdndbsd', 'afdsafds', '2021-11-05 22:03:00', 0, 5),
(23, 'asdffafdgsv', 'adfsadvadacs', '2021-11-06 22:03:00', 0, 5),
(24, 'asdvaccasacs', 'assacsacasda', '2021-11-04 22:04:00', 0, 5),
(28, 'adsfbgfnh', 'dsgfnhdsgg', '2021-11-24 08:13:00', 1, 7),
(29, 'dfghjk', 'asdfhg', '2021-11-11 08:14:00', 0, 7),
(31, 'adsfadvsf', 'qegsbrfavds', '2021-11-27 20:49:00', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `nama_user`, `created_at`, `updated_at`) VALUES
(3, 'faiq2003@gmail.com', '$2y$10$tHEqvwImdW60SuYvwiwVX.B28bDy.6tdToGtbh4W2zXYiRNXgWMUW', '', '2021-11-20 23:36:32', '2021-11-20 23:36:32'),
(4, 'faiq@gmail.com', '$2y$10$PUuqyhqBdwrlsDwuxbRgwu.XKLVCT5m16bxIQydedfICiRh96U8EK', '', '2021-11-21 01:59:28', '2021-11-21 01:59:28'),
(5, 'faiqq@gmail.com', '$2y$10$pf.VoEhgSIUPekyoVFAQ/uc1zRwa13R7eeRHtg0SfjQC.7RXd6VAy', 'Faiq Muhammad', '2021-11-21 07:52:50', '2021-11-27 09:04:47'),
(6, 'faiqq2003@gmail.com', '$2y$10$Nmgb/FKLDXEo/ZXiBENh.ea7bMneVJN0fn2ThtyJkH.8fBg4xLsAK', '', '2021-11-22 01:19:16', '2021-11-22 01:19:16'),
(7, 'faiqm2003@gmail.com', '$2y$10$oZheQBlhzyIB09StLuP0EuF6vyWY/Ar/N3SBS1WK5WAIkxDQKv2jW', '', '2021-11-23 19:12:40', '2021-11-23 19:12:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`),
  ADD KEY `tugas_tag` (`id_tugas`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `user_tugas` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tugas_tag` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `user_tugas` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
