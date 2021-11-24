-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 07:14 AM
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
(14, 'abcd', 27),
(15, 'aiueo', 27),
(16, 'aeugh', 27),
(17, 'anjaymabar', 27),
(18, 'abc', 28),
(19, 'bcd', 28),
(20, 'efg', 28);

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
  `id_user` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `nama_tugas`, `deskripsi`, `deadline`, `status`, `id_user`, `created_at`, `updated_at`) VALUES
(17, 'ayonima', 'sadfg', '2021-11-09 14:46:00', 1, 3, '2021-11-21 01:46:57', '2021-11-21 01:46:57'),
(18, 'ayo the pizza is here', 'ow n', '2021-11-21 15:00:00', 0, 4, '2021-11-21 02:01:02', '2021-11-21 02:01:02'),
(19, 'asdfgfhgkj', 'adsfg', '2021-11-05 22:58:00', 1, 5, '2021-11-21 07:53:23', '2021-11-21 09:38:25'),
(21, 'abcede', 'wdafsdafsd', '2021-11-12 22:03:00', 0, 5, '2021-11-21 09:03:40', '2021-11-21 09:03:40'),
(22, 'advsbfdndbsd', 'afdsafds', '2021-11-05 22:03:00', 0, 5, '2021-11-21 09:03:48', '2021-11-21 09:03:48'),
(23, 'asdffafdgsv', 'adfsadvadacs', '2021-11-06 22:03:00', 0, 5, '2021-11-21 09:03:56', '2021-11-21 09:03:56'),
(24, 'asdvaccasacs', 'assacsacasda', '2021-11-04 22:04:00', 0, 5, '2021-11-21 09:04:04', '2021-11-21 09:04:04'),
(26, 'abcedeeeee', 'asdgfdng', '2021-11-12 23:27:00', 0, 5, NULL, NULL),
(27, 'abcedeeeeeaaa', 'asdgfdng TAGS PLZ', '2021-11-12 23:27:00', 1, 5, NULL, NULL),
(28, 'adsfbgfnh', 'dsgfnhdsgg', '2021-11-24 08:13:00', 1, 7, NULL, NULL),
(29, 'dfghjk', 'asdfhg', '2021-11-11 08:14:00', 0, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `nama_user`, `universitas`, `created_at`, `updated_at`) VALUES
(3, 'faiq2003@gmail.com', '$2y$10$tHEqvwImdW60SuYvwiwVX.B28bDy.6tdToGtbh4W2zXYiRNXgWMUW', '', NULL, '2021-11-20 23:36:32', '2021-11-20 23:36:32'),
(4, 'faiq@gmail.com', '$2y$10$PUuqyhqBdwrlsDwuxbRgwu.XKLVCT5m16bxIQydedfICiRh96U8EK', '', NULL, '2021-11-21 01:59:28', '2021-11-21 01:59:28'),
(5, 'faiqq@gmail.com', '$2y$10$XQhUabc6GQovspy1Z3/1l.omWTBQW5yiaM5dCVKV83wf2.PMIiweK', 'faiq Muhammad', NULL, '2021-11-21 07:52:50', '2021-11-21 07:52:50'),
(6, 'faiqq2003@gmail.com', '$2y$10$Nmgb/FKLDXEo/ZXiBENh.ea7bMneVJN0fn2ThtyJkH.8fBg4xLsAK', '', NULL, '2021-11-22 01:19:16', '2021-11-22 01:19:16'),
(7, 'faiqm2003@gmail.com', '$2y$10$oZheQBlhzyIB09StLuP0EuF6vyWY/Ar/N3SBS1WK5WAIkxDQKv2jW', '', NULL, '2021-11-23 19:12:40', '2021-11-23 19:12:40');

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
  MODIFY `id_tag` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
