-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Bulan Mei 2026 pada 14.55
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
-- Database: `pustakadigital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `databuku`
--

CREATE TABLE `databuku` (
  `id` int(5) NOT NULL,
  `kode_buku` varchar(7) NOT NULL DEFAULT 'BK000',
  `judul` varchar(70) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `databuku`
--

INSERT INTO `databuku` (`id`, `kode_buku`, `judul`, `pengarang`, `kategori`, `stok`) VALUES
(9, 'BK001', 'Laskar Pelangi', 'Andrea Hirati', 'Fiksi', 18),
(10, 'BK002', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Fiksi', 14),
(11, 'BK003', 'Harry Potter', 'J. K. Rowling', 'Fiksi', 4),
(12, 'BK004', 'Koala Kumal', 'Raditya Dika', 'Ilmiah', 16),
(13, 'BK005', 'Home Sweet Loan', 'Almira Bastari', 'Ilmiah', 3),
(14, 'BK006', 'Perahu Kertas', 'Dee Lestari', 'Ilmiah', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapeminjam`
--

CREATE TABLE `datapeminjam` (
  `id` int(5) NOT NULL,
  `kode_peminjaman` varchar(7) NOT NULL DEFAULT 'PJ000',
  `nama_peminjam` varchar(100) NOT NULL,
  `id_buku` int(5) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `deadline` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `datapeminjam`
--

INSERT INTO `datapeminjam` (`id`, `kode_peminjaman`, `nama_peminjam`, `id_buku`, `tanggal_pinjam`, `deadline`, `tanggal_kembali`) VALUES
(1, 'PJ001', 'Ryan Gosling', 10, '2026-05-12', '2026-05-14', '2026-05-14'),
(2, 'PJ002', 'Lex Luthor', 9, '2026-05-08', '2026-05-14', '2026-05-14'),
(3, 'PJ003', 'Jason Statham', 12, '2026-05-13', '2026-05-14', NULL),
(5, 'PJ004', 'Kevin Feige', 13, '2026-05-13', '2026-05-15', NULL),
(6, 'PJ005', 'Bruce Wayne', 14, '2026-05-12', '2026-05-16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'wedneszay', 'jennaortega', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `databuku`
--
ALTER TABLE `databuku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indeks untuk tabel `datapeminjam`
--
ALTER TABLE `datapeminjam`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_peminjaman` (`kode_peminjaman`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `databuku`
--
ALTER TABLE `databuku`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `datapeminjam`
--
ALTER TABLE `datapeminjam`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `datapeminjam`
--
ALTER TABLE `datapeminjam`
  ADD CONSTRAINT `datapeminjam_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `databuku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
