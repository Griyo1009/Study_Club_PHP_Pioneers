-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2024 pada 17.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id_account`, `username`, `password`) VALUES
(19, 'adm', '123'),
(22, 'admin', '123'),
(23, 'Griyo11', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `completed_tasks`
--

CREATE TABLE `completed_tasks` (
  `id_project` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `completed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `completed_tasks`
--

INSERT INTO `completed_tasks` (`id_project`, `project_name`, `owner`, `start_date`, `end_date`, `completed_date`) VALUES
(16, 'Web Development', 'Griyo', '2024-08-09', '2024-08-18', '2024-08-17 08:29:47'),
(17, 'Tugas Basis Data', 'Shakilla', '2024-08-15', '2024-08-23', '2024-08-17 10:37:06'),
(18, 'Project Study Club', 'Shakilla, Davina, Griyo', '2024-08-09', '2024-08-18', '2024-08-17 10:37:06'),
(20, 'Belanja', 'Griyo', '2024-08-16', '2024-08-20', '2024-08-17 10:37:14'),
(21, 'Tugas Alpro', 'Davina', '2024-08-16', '2024-08-30', '2024-08-17 10:37:14'),
(24, 'Project Study Club', 'Griyo', '2024-08-15', '2024-08-22', '2024-08-17 14:48:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `nama`, `email`, `pesan`) VALUES
(350, 'Griyo', 'gg@gmail.com', 'masih banyak bugs'),
(351, 'admin', 'gg@gmail.com', 'web perlu banyak perbaikan'),
(352, 'admin', 'gg@gmail.com', 'banyak bugs'),
(353, 'Griyo11', 'griyonugroho10@gmail.com', 'aaaaaa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `progress` int(3) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id_project`, `project_name`, `progress`, `owner`, `start_date`, `end_date`) VALUES
(43, 'Tugas Basis Data', 64, 'Griyo11', '2024-08-16', '2024-08-23'),
(44, 'Project Study Club', 100, 'Griyo', '2024-08-10', '2024-08-14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `completed_tasks`
--
ALTER TABLE `completed_tasks`
  ADD PRIMARY KEY (`id_project`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `completed_tasks`
--
ALTER TABLE `completed_tasks`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
