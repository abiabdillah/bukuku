-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2026 pada 08.19
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
-- Database: `tokobuku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_kategori_buku` int(11) DEFAULT NULL,
  `judul_buku` varchar(150) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` char(4) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `id_kategori_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `harga`, `gambar`) VALUES
(2, 5, 'terbitlah mataharikua sdasd', 'asdasdas', 'asdasdasd', '2029', '24000', 'WhatsApp Image 2026-06-08 at 07.18.40.jpeg'),
(3, 4, 'AASCASCASC', 'ASCASCASC', 'ASCASCASC', '2028', '12000', 'tugas 1.jpeg'),
(5, 4, 'sgasdfaf', 'sdvasdv', 'asdvasdv', '2019', '21000', 'tugas 1.jpeg'),
(6, 5, 'ketika cinta bertasbih', 'abi', 'abi', '1234', '24000', 'WhatsApp Image 2026-06-08 at 07.18.40.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_user`, `id_buku`, `jumlah`) VALUES
(7, 3, '4'),
(7, 5, '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` varchar(3) NOT NULL,
  `harga_satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_pesanan`, `id_buku`, `jumlah`, `harga_satuan`) VALUES
(3, 3, '1', '12000'),
(4, 5, '1', '21000'),
(5, 6, '1', '24000'),
(6, 6, '1', '24000'),
(7, 6, '1', '24000'),
(8, 6, '1', '24000'),
(9, 5, '1', '21000'),
(10, 3, '2', '12000'),
(10, 5, '2', '21000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama`) VALUES
(4, 'alam'),
(5, 'Sejarah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('Konfirmasi Pembayaran','Pengiriman','Selesai') NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_user`, `status`, `tanggal`) VALUES
(3, 7, 'Pengiriman', '2026-06-12 09:57:27'),
(4, 7, 'Konfirmasi Pembayaran', '2026-06-12 10:31:33'),
(5, 7, 'Konfirmasi Pembayaran', '2026-06-12 10:38:30'),
(6, 14, 'Konfirmasi Pembayaran', '2026-06-12 10:39:50'),
(7, 7, 'Konfirmasi Pembayaran', '2026-06-12 10:59:21'),
(8, 7, 'Konfirmasi Pembayaran', '2026-06-12 11:00:42'),
(9, 7, 'Konfirmasi Pembayaran', '2026-06-12 11:00:54'),
(10, 7, 'Konfirmasi Pembayaran', '2026-06-12 11:07:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `role` enum('Admin','User') NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `role`, `alamat`, `email`, `no_telp`, `jenis_kelamin`) VALUES
(5, 'admin', 'admin', 'ABI ABDILLAH', 'Admin', 'Bekasi', 'abiabdillah569@gmail.com', '08973884597', 'L'),
(7, 'abi', 'abi', 'abi', 'User', 'bekasi', 'abi@gmail.com', '34343434', 'L'),
(8, 'abi123', 'abi123', 'abiabi', 'User', 'bekasi', 'abiabi@gmail.com', '56565656', 'L'),
(11, 'bambang', 'bambang', 'bambang', 'User', 'bekasi', 'bambang123@gmail.com', '089234234234', 'L'),
(12, 'p4jp', 'p4jp', 'p4jp', 'User', 'bekasi', 'abiabdillah569@gmail.com', '08973884597', 'L'),
(13, 'anwar', 'anwar', 'anwar', 'User', 'jl. tarumajaya ', 'anwar@gmail.com', '08973884597', 'L'),
(14, 'user', 'user', 'user', 'User', 'jl. tarumajaya bekasi', 'user@gmail.com', '089771271273123', 'L'),
(15, 'p4', 'p4jp', 'jakpus', 'User', 'Jl. Lapangan Banteng Jakarta Pusat', 'p4jp@gmail.com', '08971231231', 'L');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_buku` (`id_kategori_buku`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_user`,`id_buku`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_pesanan`,`id_buku`),
  ADD KEY `id_pesanan` (`id_pesanan`) USING BTREE,
  ADD KEY `id_buku` (`id_buku`) USING BTREE;

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori_buku`) REFERENCES `kategori_buku` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
