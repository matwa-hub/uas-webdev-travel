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
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `testimoni_ID` char(4) NOT NULL,
  `testimoni_JUDUL` varchar(30) NOT NULL,
  `testimoni_FOTO` text NOT NULL,
  `testimoni_ISI` varchar(250) NOT NULL,
  `testimoni_NAMA` varchar(50) NOT NULL,
  `testimoni_KOTA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`testimoni_ID`, `testimoni_JUDUL`, `testimoni_FOTO`, `testimoni_ISI`, `testimoni_NAMA`, `testimoni_KOTA`) VALUES
('TS01', 'What People Say About Us', 'foto.jpg', 'On the window talking painted pasture yet its express parties use. Sure last upon he same as knew next. Of belived or diverted no.', 'Michael Jackson', 'New York, US'),
('TS02', 'Hallo semuanya, apa kabar???', 'foto2.jpg', 'Ini bagus sekali buat kamu yang agak kurang suka kecut, mungkin bisa skip. Ini sari lemon ya gais, katanya juga bagus buat program diet. ', 'Lilly ', 'California, US'),
('TS03', 'Testimonial customer', 'foto3.jpg', 'Cocok banget ini mah dimakan pas panas â€“ panas gini! Kamu pecinta es krim pokoknya harus coba! Ini varian rasanya juga ada banyak, ada coklat, strawberry, vanilla, anggur, sama durian.', 'Michelle Tan', 'Beijing, Tiongkok');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`testimoni_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
