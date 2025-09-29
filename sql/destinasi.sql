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
-- Struktur dari tabel `destinasi`
--

CREATE TABLE `destinasi` (
  `destinasi_KODE` varchar(4) NOT NULL,
  `destinasi_NAMA` varchar(120) NOT NULL,
  `destinasi_ALAMAT` varchar(120) NOT NULL,
  `destinasi_KET` varchar(120) NOT NULL,
  `kecamatan_KODE` char(4) NOT NULL,
  `foto_destinasi` text NOT NULL,
  `kategori_ID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `destinasi`
--

INSERT INTO `destinasi` (`destinasi_KODE`, `destinasi_NAMA`, `destinasi_ALAMAT`, `destinasi_KET`, `kecamatan_KODE`, `foto_destinasi`, `kategori_ID`) VALUES
('KD00', 'Jatim Park 3', 'Jalan Ir. Soekarno Nomor 144, Beji', 'Jatim Park 3 mengusung konsep wisata keluarga masa kini. Saat mengunjungi wisata ini kamu akan diajak untuk melihat, ber', 'KC00', 'Jatim Park 3.jpeg', 'KW01'),
('KD01', 'Merbabu via Suwanting', 'Jl. Suwanting, Suwanting, Banyuroto, Kec. Selo, Kabupaten Magelang, Jawa Tengah 56481', 'Jalur pendakian Gunung Merbabu sangat terjal, karena terbentang deretan bukit yang sangat tinggi dan curam, jalur Suwant', 'KC01', 'suwanting.jpeg', 'KW02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`destinasi_KODE`),
  ADD KEY `kecamatan_KODE` (`kecamatan_KODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
