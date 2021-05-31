-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Waktu pembuatan: 31 Bulan Mei 2021 pada 13.43
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_smbd_inventaris`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cekDenda` (`id` INT, `tglKembali` DATE) RETURNS INT(11) BEGIN
    DECLARE denda int;

    set denda = (SELECT IF((tglKembali-peminjaman.tgl_peminjaman-7)*2000 > 0, (tglKembali-peminjaman.tgl_peminjaman-7)*2000, 0) AS denda
    FROM peminjaman
    WHERE peminjaman.id_peminjaman = id);

    RETURN denda;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `nim` varchar(32) NOT NULL,
  `nama_anggota` varchar(128) NOT NULL,
  `jenis_kelamin_anggota` enum('L','P') NOT NULL,
  `tgl_lahir_anggota` date DEFAULT NULL,
  `no_tlp_anggota` varchar(15) NOT NULL,
  `alamat_anggota` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`nim`, `nama_anggota`, `jenis_kelamin_anggota`, `tgl_lahir_anggota`, `no_tlp_anggota`, `alamat_anggota`) VALUES
('190441100129', 'Khoirul Anam', 'L', '2001-10-30', '085232261008', 'Kamal'),
('190441100175', 'Riki Pratama', 'L', '2000-05-12', '081123482947', 'Sampang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `merk_barang` varchar(128) DEFAULT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `kondisi_barang` varchar(128) DEFAULT NULL,
  `tgl_barang_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `merk_barang`, `jumlah_barang`, `kondisi_barang`, `tgl_barang_masuk`) VALUES
(1, 'Komputer', 'HP', 200, 'Baik', '2021-05-18'),
(2, 'Mouse', 'Logitech', 300, 'Baik', '2021-05-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `tipe_log` varchar(128) DEFAULT NULL,
  `nama_tabel` varchar(128) DEFAULT NULL,
  `id_tabel` varchar(128) DEFAULT NULL,
  `waktu_log` datetime DEFAULT NULL,
  `user_petugas` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `denda` int(11) NOT NULL DEFAULT 0,
  `petugas_id_petugas` int(11) NOT NULL,
  `barang_id_barang` int(11) NOT NULL,
  `anggota_nim` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tgl_peminjaman`, `tgl_kembali`, `denda`, `petugas_id_petugas`, `barang_id_barang`, `anggota_nim`) VALUES
(2, '2021-05-07', '2021-05-31', 34000, 1, 1, '190441100129'),
(3, '2021-05-29', '2021-05-31', 0, 1, 1, '190441100129'),
(4, '2021-05-31', NULL, 0, 1, 2, '190441100175'),
(5, '2021-05-23', '2021-05-31', 0, 1, 2, '190441100129');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(128) NOT NULL,
  `jenis_kelamin_petugas` enum('L','P') NOT NULL,
  `tgl_lahir_petugas` date DEFAULT NULL,
  `no_tlp_petugas` varchar(15) DEFAULT NULL,
  `alamat_petugas` varchar(128) NOT NULL,
  `username_petugas` varchar(128) DEFAULT NULL,
  `password_petugas` varchar(128) DEFAULT NULL,
  `level_petugas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `jenis_kelamin_petugas`, `tgl_lahir_petugas`, `no_tlp_petugas`, `alamat_petugas`, `username_petugas`, `password_petugas`, `level_petugas`) VALUES
(1, 'admin', 'L', '2001-10-30', '085232261008', 'Kamal', 'admin', 'admin', 'Super Admin');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `viewpeminjaman`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `viewpeminjaman` (
`id_peminjaman` int(11)
,`tgl_peminjaman` date
,`nama_petugas` varchar(128)
,`nama_barang` varchar(128)
,`nama_anggota` varchar(128)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `viewpengembalian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `viewpengembalian` (
`id_peminjaman` int(11)
,`tgl_peminjaman` date
,`tgl_kembali` date
,`denda` int(11)
,`nama_petugas` varchar(128)
,`nama_barang` varchar(128)
,`nama_anggota` varchar(128)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `viewpeminjaman`
--
DROP TABLE IF EXISTS `viewpeminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewpeminjaman`  AS  select `peminjaman`.`id_peminjaman` AS `id_peminjaman`,`peminjaman`.`tgl_peminjaman` AS `tgl_peminjaman`,`petugas`.`nama_petugas` AS `nama_petugas`,`barang`.`nama_barang` AS `nama_barang`,`anggota`.`nama_anggota` AS `nama_anggota` from (((`peminjaman` join `petugas` on(`peminjaman`.`petugas_id_petugas` = `petugas`.`id_petugas`)) join `barang` on(`peminjaman`.`barang_id_barang` = `barang`.`id_barang`)) join `anggota` on(`peminjaman`.`anggota_nim` = `anggota`.`nim`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `viewpengembalian`
--
DROP TABLE IF EXISTS `viewpengembalian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewpengembalian`  AS  select `peminjaman`.`id_peminjaman` AS `id_peminjaman`,`peminjaman`.`tgl_peminjaman` AS `tgl_peminjaman`,`peminjaman`.`tgl_kembali` AS `tgl_kembali`,`peminjaman`.`denda` AS `denda`,`petugas`.`nama_petugas` AS `nama_petugas`,`barang`.`nama_barang` AS `nama_barang`,`anggota`.`nama_anggota` AS `nama_anggota` from (((`peminjaman` join `petugas` on(`peminjaman`.`petugas_id_petugas` = `petugas`.`id_petugas`)) join `barang` on(`peminjaman`.`barang_id_barang` = `barang`.`id_barang`)) join `anggota` on(`peminjaman`.`anggota_nim` = `anggota`.`nim`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_peminjaman_petugas_idx` (`petugas_id_petugas`),
  ADD KEY `fk_peminjaman_barang1_idx` (`barang_id_barang`),
  ADD KEY `fk_peminjaman_anggota1_idx` (`anggota_nim`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username_petugas_UNIQUE` (`username_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_anggota1` FOREIGN KEY (`anggota_nim`) REFERENCES `anggota` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peminjaman_barang1` FOREIGN KEY (`barang_id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_peminjaman_petugas` FOREIGN KEY (`petugas_id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
