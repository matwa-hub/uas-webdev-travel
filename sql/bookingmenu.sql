-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2024 pada 14.56
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pariwisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookingmenu`
--

CREATE TABLE `bookingmenu` (
  `booking_ID` char(4) NOT NULL,
  `booking_NAMA` varchar(100) NOT NULL,
  `booking_DESKRIPSI` varchar(250) NOT NULL,
  `booking_TGL` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookingmenu`
--

INSERT INTO `bookingmenu` (`booking_ID`, `booking_NAMA`, `booking_DESKRIPSI`, `booking_TGL`) VALUES
('BM00', 'Paket Wisata A', 'Paket wisata pantai di Bali, termasuk transportasi.', '2025-03-03'),
('BM01', 'Paket Wisata B', 'Paket wisata petualangan ke Gunung Rinjani.', '2024-11-11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookingmenu`
--
ALTER TABLE `bookingmenu`
  ADD PRIMARY KEY (`booking_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
