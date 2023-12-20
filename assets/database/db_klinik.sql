-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2023 pada 16.22
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_akun` varchar(500) NOT NULL,
  `id_role` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `nama_akun`, `id_role`, `status`) VALUES
(1, 'sasha', 'sasa11', 'Sasha', 1, 'aktif'),
(2, 'rahmat', 'rahmat22', 'Rahmat', 2, 'aktif'),
(3, 'hendrik', 'hendrik33', 'Dr.Hendrik', 3, 'aktif'),
(4, 'maria', 'maria44', 'Maria', 4, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pasien`
--

CREATE TABLE `data_pasien` (
  `id_pasien` int(11) NOT NULL,
  `nik_pasien` int(18) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `umur_pasien` int(3) NOT NULL,
  `jk_pasien` varchar(11) NOT NULL,
  `alamat_pasien` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pasien`
--

INSERT INTO `data_pasien` (`id_pasien`, `nik_pasien`, `nama_pasien`, `umur_pasien`, `jk_pasien`, `alamat_pasien`) VALUES
(1, 1712112121, 'Awaludin', 18, 'Laki-laki', 'Jalan Pahlawan no.4'),
(2, 2102302221, 'Jamal Renaldy', 30, 'Laki-laki', 'Jl. Haji Jole'),
(3, 2147483647, 'Toto Suherman', 35, 'Laki-laki', 'Jl. Racing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa_pasien`
--

CREATE TABLE `periksa_pasien` (
  `id_periksa` int(11) NOT NULL,
  `nik_pasien` int(18) NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `keluhan` varchar(225) NOT NULL,
  `diagnosa` varchar(225) NOT NULL,
  `obat` varchar(500) NOT NULL,
  `dokter` varchar(225) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(225) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periksa_pasien`
--

INSERT INTO `periksa_pasien` (`id_periksa`, `nik_pasien`, `no_antrian`, `keluhan`, `diagnosa`, `obat`, `dokter`, `tanggal`, `keterangan`, `id_transaksi`, `status`) VALUES
(1, 1712112121, 1, 'sakit pin', 'faktor umur', 'Paracetamol 3 plek', 'Dr.Hendrik', '2023-11-18', '', 3, 'selesai'),
(2, 2147483647, 2, 'Batuk Berdahak', 'Flu', 'Paracetamol 2 plek Amoxcilin 2 plek', 'Dr.Hendrik', '2023-11-18', '', 4, 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `record_pasien`
--

CREATE TABLE `record_pasien` (
  `id_record` int(11) NOT NULL,
  `nik_pasien` int(18) NOT NULL,
  `keluhan` varchar(225) NOT NULL,
  `diagnosa` varchar(225) NOT NULL,
  `obat` varchar(500) NOT NULL,
  `dokter` varchar(225) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(225) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `record_pasien`
--

INSERT INTO `record_pasien` (`id_record`, `nik_pasien`, `keluhan`, `diagnosa`, `obat`, `dokter`, `tanggal`, `keterangan`, `id_transaksi`) VALUES
(1, 2147483647, 'Batuk Berdahak', 'Flu', 'Paracetamol 2 plek', 'Dr.Hendrik', '2023-11-21', '', 3),
(2, 1712112121, 'sakit pin', 'faktor umur', 'Paracetamol 3 plek', 'Dr.Hendrik', '2023-12-20', '', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'registrasi'),
(3, 'dokter'),
(4, 'apoteker');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_transaksi`
--

CREATE TABLE `tbl_detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_detail_transaksi`
--

INSERT INTO `tbl_detail_transaksi` (`id_detail`, `id_transaksi`, `id_obat`, `jumlah`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 2),
(3, 3, 1, 3),
(4, 4, 1, 2),
(5, 4, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(500) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_obat`
--

INSERT INTO `tbl_obat` (`id_obat`, `nama_obat`, `stok`, `harga`) VALUES
(1, 'Paracetamol', 13, 15000),
(2, 'Amoxcilin', 16, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tagihan` int(18) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `tagihan`, `tanggal`) VALUES
(1, 60000, '2023-12-20'),
(2, 45000, '2023-12-20'),
(3, 45000, '2023-12-20'),
(4, 60000, '2023-12-20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `nik_pasien` (`nik_pasien`),
  ADD UNIQUE KEY `nik_pasien_2` (`nik_pasien`);

--
-- Indeks untuk tabel `periksa_pasien`
--
ALTER TABLE `periksa_pasien`
  ADD PRIMARY KEY (`id_periksa`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `record_pasien`
--
ALTER TABLE `record_pasien`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `periksa_pasien`
--
ALTER TABLE `periksa_pasien`
  MODIFY `id_periksa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `record_pasien`
--
ALTER TABLE `record_pasien`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `periksa_pasien`
--
ALTER TABLE `periksa_pasien`
  ADD CONSTRAINT `periksa_pasien_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `record_pasien`
--
ALTER TABLE `record_pasien`
  ADD CONSTRAINT `record_pasien_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD CONSTRAINT `tbl_detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`),
  ADD CONSTRAINT `tbl_detail_transaksi_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `tbl_obat` (`id_obat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
