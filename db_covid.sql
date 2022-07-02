-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2022 pada 02.23
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_covid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `province`
--

INSERT INTO `province` (`id`, `code`, `name`, `file`, `created_at`, `updated_at`) VALUES
(14, 'NAD', 'BANDA ACEH', 'CT3M89TPO2.png', '2022-07-01 18:30:26', '2022-07-01 18:30:26'),
(15, 'SUMSEL', 'SUMATRA SELATAN', 'uq27zQjQdz.jpeg', '2022-07-01 18:27:50', '2022-07-01 18:27:50'),
(16, 'SUMUT', 'SUMATRA UTARA', 'u9u7K0Rx4O.png', '2022-07-01 18:25:55', '2022-07-01 18:25:55'),
(17, 'JATIM', 'JAWA TIMUR', '1bkEQzMzC5.jpeg', '2022-07-01 18:23:39', '2022-07-01 18:23:39'),
(20, 'DKI', 'DKI JAKARTA', 'TqE6bq3WmM.png', '2022-07-01 18:44:10', '2022-07-01 18:44:10'),
(21, 'JABAR', 'JAWA BARAT', 'QVRGL4jbCU.png', '2022-07-01 19:35:41', '2022-07-01 19:35:41'),
(23, 'JABAR1', 'JAWA BARAT', 'tdIEEYdaGz.png', '2022-07-01 19:35:51', '2022-07-01 19:35:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
