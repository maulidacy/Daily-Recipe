-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2024 pada 04.58
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
-- Database: `best_recipe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(2, 'Onde-onde', 'Onde-onde isi kacang hijau adalah camilan tradisional Indonesia yang terkenal dengan tekstur kenyal dan rasa manis yang menggugah selera. Terbuat dari tepung ketan', '20241227163522.jpeg', '2024-12-27 16:35:22', 'admin'),
(11, 'Serabi', 'Serabi adalah makanan tradisional Indonesia yang populer, khususnya di Pulau Jawa. Terbuat dari adonan tepung beras, santan, dan sedikit garam, serabi memiliki tekstur yang lembut', '20241227163509.jpeg', '2024-12-27 16:35:09', 'admin'),
(12, 'Bolu Marmer', 'Bolu marmer panggang adalah kue yang lezat dan menarik, terkenal dengan pola marmer yang cantik. Terbuat dari campuran adonan tepung', '20241227163456.jpeg', '2024-12-27 16:34:56', 'admin'),
(22, 'Roti Sobek Keju', 'Roti sobek keju adalah jenis roti manis yang populer dengan tekstur yang lembut dan lezat. Terbuat dari adonan roti yang lembut dan mengembang, roti ini diisi dengan', '20241227163444.jpeg', '2024-12-27 16:34:44', 'admin'),
(24, 'Bolu Pisang Panggang', 'Bolu pisang panggang adalah hidangan penutup yang populer dan lezat. Terbuat dari campuran pisang matang yang dihancurkan', '20241227163418.jpeg', '2024-12-27 16:34:18', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
