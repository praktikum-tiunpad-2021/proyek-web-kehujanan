-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2021 pada 18.44
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

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
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(10) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama_matkul`, `created_at`, `updated_at`) VALUES
(1, 'xyz', '2021-10-25 12:38:11', '2021-10-25 12:38:11'),
(2, 'wxyz', '2021-10-25 12:38:11', '2021-10-25 12:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(10) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `id_matkul` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `nama_tugas`, `deskripsi`, `deadline`, `status`, `id_user`, `id_matkul`, `created_at`, `updated_at`) VALUES
(1, 'tugas 1222222', 'tugas 1', '2021-10-28 23:10:00', NULL, 1, 1, '2021-10-25 12:39:12', '2021-10-26 11:10:33'),
(2, 'tugas 2', 'tugas 2', '2021-10-25 12:40:19', NULL, 1, 1, '2021-10-25 12:40:19', '2021-10-25 12:40:19'),
(3, 'tugas 3', 'tugas 3', '2021-10-25 12:41:15', NULL, 1, 2, '2021-10-25 12:41:15', '2021-10-25 12:41:15'),
(4, 'tugas 4', 'tugas 4', '2021-10-25 12:41:34', NULL, 2, 1, '2021-10-25 12:41:34', '2021-10-25 12:41:34'),
(11, 'ayonima', 'afdgs', '2021-10-26 17:17:00', NULL, 1, 2, '2021-10-26 05:17:49', '2021-10-26 05:17:49'),
(12, 'abced', 'adsfvdb', '2021-10-26 17:22:00', NULL, 1, 1, '2021-10-26 05:22:13', '2021-10-26 05:22:13'),
(13, 'abced', 'adsfvdb', '2021-10-27 19:11:00', NULL, 1, 1, '2021-10-26 07:12:01', '2021-10-26 07:12:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nama_user`, `universitas`, `created_at`, `updated_at`) VALUES
(1, 'abcd@gmail.com', 'aiueo', 'abcd', NULL, '2021-10-25 12:36:40', '2021-10-25 12:36:40'),
(2, 'abcde@gmail.com', 'aiueo', 'abcde', NULL, '2021-10-25 12:36:40', '2021-10-25 12:36:40');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `user_tugas` (`id_user`),
  ADD KEY `matkul_tugas` (`id_matkul`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `matkul_tugas` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`),
  ADD CONSTRAINT `user_tugas` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
