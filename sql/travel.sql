-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2024 pada 14.57
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
-- Struktur dari tabel `travel`
--

CREATE TABLE `travel` (
  `travel_ID` char(4) NOT NULL,
  `travel_JUDUL` varchar(225) NOT NULL,
  `travel_SUBJUDUL` varchar(225) NOT NULL,
  `travel_KETERANGAN` varchar(255) NOT NULL,
  `travel_LINKVID` varchar(255) NOT NULL,
  `travel_FOTO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `travel`
--

INSERT INTO `travel` (`travel_ID`, `travel_JUDUL`, `travel_SUBJUDUL`, `travel_KETERANGAN`, `travel_LINKVID`, `travel_FOTO`) VALUES
('TD00', 'Perjalanan Terbaik menuju Bali', 'Travel, enjoy and live a new and full life', 'Saya melakakukan perjalanan yang sangat menarik ketika berkunjung ke Bali. Saya menuju ke pulau dewata dan menghabiskan 1 minggu dengan sangat menyenangkan.', 'https://www.youtube.com/embed/_lhdhL4UDIo', 'images/travel.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`travel_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
