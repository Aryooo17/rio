-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2024 pada 03.49
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_native`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery album`
--

CREATE TABLE `galery album` (
  `Album ID` int(200) NOT NULL,
  `Nama Album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `Tanggal Dibuat` date NOT NULL,
  `User ID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery foto`
--

CREATE TABLE `galery foto` (
  `foto id` int(200) NOT NULL,
  `judul foto` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `tanggal unggah` date NOT NULL,
  `Lokasi File` varchar(255) NOT NULL,
  `album id` int(200) NOT NULL,
  `user id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery komentar`
--

CREATE TABLE `galery komentar` (
  `KOMENTAR ID` int(100) NOT NULL,
  `FOTO ID` int(100) NOT NULL,
  `USER ID` int(200) NOT NULL,
  `ISI KOMENTAR` text NOT NULL,
  `TANGGAL KOMENTAR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery like`
--

CREATE TABLE `galery like` (
  `like id` int(100) NOT NULL,
  `foto id` int(100) NOT NULL,
  `user id` int(100) NOT NULL,
  `tanggal like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery user`
--

CREATE TABLE `galery user` (
  `user id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `galery album`
--
ALTER TABLE `galery album`
  ADD PRIMARY KEY (`Album ID`),
  ADD KEY `Album ID` (`Album ID`),
  ADD KEY `User ID` (`User ID`);

--
-- Indeks untuk tabel `galery foto`
--
ALTER TABLE `galery foto`
  ADD PRIMARY KEY (`foto id`),
  ADD KEY `foto id` (`foto id`),
  ADD KEY `album id` (`album id`),
  ADD KEY `user id` (`user id`);

--
-- Indeks untuk tabel `galery komentar`
--
ALTER TABLE `galery komentar`
  ADD PRIMARY KEY (`KOMENTAR ID`),
  ADD KEY `KOMENTAR ID` (`KOMENTAR ID`),
  ADD KEY `FOTO ID` (`FOTO ID`),
  ADD KEY `USER ID` (`USER ID`);

--
-- Indeks untuk tabel `galery like`
--
ALTER TABLE `galery like`
  ADD PRIMARY KEY (`like id`),
  ADD KEY `user id` (`user id`),
  ADD KEY `foto id` (`foto id`);

--
-- Indeks untuk tabel `galery user`
--
ALTER TABLE `galery user`
  ADD PRIMARY KEY (`user id`),
  ADD KEY `user id` (`user id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `galery album`
--
ALTER TABLE `galery album`
  ADD CONSTRAINT `galery album_ibfk_1` FOREIGN KEY (`User ID`) REFERENCES `galery user` (`user id`);

--
-- Ketidakleluasaan untuk tabel `galery foto`
--
ALTER TABLE `galery foto`
  ADD CONSTRAINT `galery foto_ibfk_1` FOREIGN KEY (`foto id`) REFERENCES `galery komentar` (`FOTO ID`),
  ADD CONSTRAINT `galery foto_ibfk_2` FOREIGN KEY (`album id`) REFERENCES `galery album` (`Album ID`),
  ADD CONSTRAINT `galery foto_ibfk_3` FOREIGN KEY (`user id`) REFERENCES `galery user` (`user id`);

--
-- Ketidakleluasaan untuk tabel `galery komentar`
--
ALTER TABLE `galery komentar`
  ADD CONSTRAINT `galery komentar_ibfk_1` FOREIGN KEY (`USER ID`) REFERENCES `galery user` (`user id`);

--
-- Ketidakleluasaan untuk tabel `galery like`
--
ALTER TABLE `galery like`
  ADD CONSTRAINT `galery like_ibfk_1` FOREIGN KEY (`user id`) REFERENCES `galery user` (`user id`),
  ADD CONSTRAINT `galery like_ibfk_2` FOREIGN KEY (`foto id`) REFERENCES `galery foto` (`foto id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
