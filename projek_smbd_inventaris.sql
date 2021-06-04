-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Waktu pembuatan: 04 Jun 2021 pada 03.16
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
-- Prosedur
--
CREATE DEFINER=`admin`@`%` PROCEDURE `peminjaman` (IN `id` INT)  BEGIN
  UPDATE barang SET barang.jumlah_barang = barang.jumlah_barang - 1
  WHERE barang.id_barang = id;
END$$

CREATE DEFINER=`admin`@`%` PROCEDURE `pengembalian` (IN `id` INT)  BEGIN
  UPDATE barang SET barang.jumlah_barang = barang.jumlah_barang + 1
  WHERE barang.id_barang = id;
END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cekDenda` (`id` INT, `tglKembali` DATE) RETURNS INT(11) BEGIN
    DECLARE denda int;

    set denda = (SELECT IF((datediff(tglKembali,peminjaman.tgl_peminjaman)-6)>0,(datediff(tglKembali,peminjaman.tgl_peminjaman)-6)*2000,0) AS denda
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
('190441100128', 'Nafiul Anam', 'L', '2021-06-16', '082332924207', ''),
('190441100129', 'Khoirul Anam', 'L', '2001-10-30', '085232261008', 'Kamal'),
('190441100154', 'Alfini Nuril Insani', 'P', '2001-09-17', '082421482412', 'Sumenep'),
('190441100175', 'Riki Pratama', 'L', '2000-05-12', '081123482947', 'Sampang');

--
-- Trigger `anggota`
--
DELIMITER $$
CREATE TRIGGER `log_delete_anggota` AFTER DELETE ON `anggota` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "D", "anggota", old.nim, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_anggota` AFTER INSERT ON `anggota` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "I", "anggota", new.nim, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_anggota` AFTER UPDATE ON `anggota` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "U", "anggota", old.nim, NOW(), USER());
END
$$
DELIMITER ;

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
(1, 'Komputer', 'HP', 198, 'Baik', '2021-05-18'),
(2, 'Mouse', 'Logitech', 301, 'Baik', '2021-05-18'),
(6, 'AC', 'Sharp', 2, 'Baik', '2021-06-01'),
(12, 'Headset', 'HP', 200, 'Baik', '2021-06-08'),
(15, 'LCD', 'Sony', 200, 'Baik', '2021-06-02');

--
-- Trigger `barang`
--
DELIMITER $$
CREATE TRIGGER `log_delete_barang` AFTER DELETE ON `barang` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "D", "barang", old.id_barang, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_barang` AFTER INSERT ON `barang` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "I", "barang", new.id_barang, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_barang` AFTER UPDATE ON `barang` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "U", "barang", old.id_barang, NOW(), USER());
END
$$
DELIMITER ;

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

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `tipe_log`, `nama_tabel`, `id_tabel`, `waktu_log`, `user_petugas`) VALUES
(2, 'I', 'barang', '7', '2021-06-01 10:00:24', 'root@localhost'),
(3, 'I', 'barang', '8', '2021-06-01 10:09:16', 'root@localhost'),
(4, 'I', 'barang', '9', '2021-06-01 10:11:32', 'root@localhost'),
(5, 'I', 'barang', '10', '2021-06-01 10:25:52', 'root@localhost'),
(6, 'I', 'barang', '11', '2021-06-01 10:27:37', 'anam@%'),
(7, 'I', 'barang', '12', '2021-06-01 11:05:21', 'anam@%'),
(8, 'I', 'barang', '13', '2021-06-01 11:05:40', 'anam@%'),
(9, 'I', 'barang', '14', '2021-06-01 11:07:22', 'admin@localhost'),
(10, 'D', 'barang', '14', '2021-06-01 11:09:40', 'admin@localhost'),
(11, 'U', 'barang', '12', '2021-06-01 11:09:56', 'admin@localhost'),
(12, 'I', 'peminjaman', '9', '2021-06-01 11:13:51', 'admin@localhost'),
(13, 'U', 'peminjaman', '6', '2021-06-01 11:13:58', 'admin@localhost'),
(14, 'D', 'peminjaman', '5', '2021-06-01 11:14:03', 'admin@localhost'),
(15, 'I', 'anggota', '190441100154', '2021-06-01 11:16:34', 'anam@localhost'),
(16, 'U', 'anggota', '190441100154', '2021-06-01 11:17:01', 'anam@localhost'),
(17, 'I', 'anggota', '123123', '2021-06-01 11:17:19', 'anam@localhost'),
(18, 'D', 'anggota', '123123', '2021-06-01 11:17:24', 'anam@localhost'),
(19, 'I', 'petugas', '5', '2021-06-01 11:19:52', 'admin@localhost'),
(20, 'U', 'petugas', '5', '2021-06-01 11:21:11', 'anam@localhost'),
(21, 'I', 'petugas', '6', '2021-06-01 11:21:27', 'anam@localhost'),
(22, 'D', 'petugas', '6', '2021-06-01 11:21:33', 'anam@localhost'),
(23, 'I', 'peminjaman', '10', '2021-06-01 14:12:40', 'admin@localhost'),
(24, 'U', 'barang', '1', '2021-06-01 14:12:40', 'admin@localhost'),
(25, 'U', 'peminjaman', '10', '2021-06-01 14:25:53', 'admin@localhost'),
(26, 'U', 'peminjaman', '2', '2021-06-01 14:27:19', 'admin@localhost'),
(27, 'I', 'peminjaman', '11', '2021-06-01 14:27:50', 'admin@localhost'),
(28, 'U', 'barang', '2', '2021-06-01 14:27:50', 'admin@localhost'),
(29, 'U', 'peminjaman', '11', '2021-06-01 14:28:01', 'admin@localhost'),
(30, 'U', 'peminjaman', '9', '2021-06-01 14:28:43', 'admin@localhost'),
(31, 'U', 'barang', '1', '2021-06-01 14:28:43', 'admin@localhost'),
(32, 'U', 'peminjaman', '4', '2021-06-01 14:28:56', 'admin@localhost'),
(33, 'U', 'barang', '2', '2021-06-01 14:28:56', 'admin@localhost'),
(34, 'U', 'peminjaman', '7', '2021-06-01 14:29:14', 'admin@localhost'),
(35, 'U', 'barang', '2', '2021-06-01 14:29:14', 'admin@localhost'),
(36, 'I', 'anggota', '190441100128', '2021-06-02 12:42:30', 'admin@localhost'),
(37, 'I', 'petugas', '7', '2021-06-02 12:51:32', 'admin@localhost'),
(38, 'U', 'petugas', '7', '2021-06-02 12:52:12', 'admin@localhost'),
(39, 'I', 'petugas', '8', '2021-06-02 12:52:51', 'admin@localhost'),
(40, 'D', 'petugas', '8', '2021-06-02 12:52:58', 'admin@localhost'),
(41, 'I', 'petugas', '9', '2021-06-02 14:33:02', 'anam@localhost'),
(42, 'I', 'petugas', '10', '2021-06-02 14:34:07', 'anam@localhost'),
(43, 'D', 'petugas', '9', '2021-06-02 14:36:42', 'anam@localhost'),
(44, 'D', 'petugas', '10', '2021-06-02 14:36:42', 'anam@localhost'),
(45, 'I', 'petugas', '13', '2021-06-02 14:37:52', 'anam@localhost'),
(46, 'D', 'petugas', '13', '2021-06-02 14:38:41', 'anam@localhost'),
(47, 'I', 'petugas', '14', '2021-06-02 14:41:58', 'anam@localhost'),
(48, 'D', 'petugas', '14', '2021-06-02 14:42:42', 'anam@localhost'),
(49, 'I', 'petugas', '15', '2021-06-02 14:54:27', 'anam@localhost'),
(50, 'D', 'petugas', '15', '2021-06-02 14:54:51', 'anam@localhost'),
(51, 'I', 'petugas', '19', '2021-06-02 15:24:21', 'admin@localhost'),
(52, 'I', 'petugas', '20', '2021-06-02 16:46:54', 'admin@localhost'),
(53, 'I', 'petugas', '21', '2021-06-02 16:47:45', 'admin@localhost'),
(54, 'I', 'petugas', '22', '2021-06-02 16:48:56', 'admin@localhost'),
(55, 'D', 'petugas', '22', '2021-06-02 16:51:29', 'admin@localhost'),
(56, 'D', 'petugas', '21', '2021-06-02 16:51:32', 'admin@localhost'),
(57, 'D', 'petugas', '20', '2021-06-02 16:51:35', 'admin@localhost'),
(58, 'D', 'petugas', '19', '2021-06-02 16:51:38', 'admin@localhost'),
(59, 'I', 'petugas', '23', '2021-06-02 16:51:58', 'admin@localhost'),
(60, 'I', 'petugas', '24', '2021-06-02 16:54:26', 'admin@localhost'),
(61, 'D', 'petugas', '24', '2021-06-02 16:58:08', 'admin@localhost'),
(62, 'D', 'petugas', '23', '2021-06-02 16:58:17', 'admin@localhost'),
(63, 'D', 'petugas', '7', '2021-06-02 17:00:26', 'admin@localhost'),
(64, 'D', 'petugas', '5', '2021-06-02 17:00:36', 'admin@localhost'),
(65, 'I', 'petugas', '25', '2021-06-02 17:01:06', 'admin@localhost'),
(66, 'D', 'barang', '13', '2021-06-02 19:47:52', 'anam@localhost'),
(67, 'D', 'barang', '11', '2021-06-02 19:48:06', 'anam@localhost'),
(68, 'D', 'barang', '10', '2021-06-02 19:48:10', 'anam@localhost'),
(69, 'U', 'barang', '12', '2021-06-02 19:50:21', 'anam@localhost'),
(70, 'I', 'barang', '15', '2021-06-02 19:51:41', 'anam@localhost'),
(71, 'D', 'peminjaman', '11', '2021-06-02 19:52:02', 'anam@localhost'),
(72, 'U', 'peminjaman', '10', '2021-06-02 19:52:14', 'anam@localhost'),
(73, 'I', 'peminjaman', '12', '2021-06-02 19:52:28', 'anam@localhost'),
(74, 'U', 'barang', '1', '2021-06-02 19:52:28', 'anam@localhost'),
(75, 'I', 'petugas', '26', '2021-06-02 19:53:24', 'anam@localhost'),
(76, 'U', 'petugas', '26', '2021-06-02 19:54:09', 'anam@localhost'),
(77, 'D', 'petugas', '26', '2021-06-02 19:54:22', 'anam@localhost'),
(78, 'I', 'petugas', '27', '2021-06-03 09:33:07', 'admin@localhost'),
(85, 'I', 'peminjaman', '16', '2021-06-04 08:14:50', 'admin@localhost'),
(86, 'U', 'barang', '1', '2021-06-04 08:14:50', 'admin@localhost');

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
(2, '2021-05-26', '2021-06-01', 38000, 1, 1, '190441100129'),
(3, '2021-05-29', '2021-06-01', 0, 1, 1, '190441100129'),
(4, '2021-05-31', '2021-06-01', 0, 1, 2, '190441100175'),
(6, '2021-05-31', '2021-06-01', 0, 1, 1, '190441100129'),
(7, '2021-05-30', '2021-06-01', 0, 1, 2, '190441100129'),
(8, '2021-05-25', '2021-06-01', 2000, 1, 1, '190441100129'),
(9, '2021-06-01', '2021-06-01', 0, 1, 1, '190441100175'),
(10, '2021-06-01', NULL, 0, 1, 1, '190441100129'),
(12, '2021-06-02', NULL, 0, 25, 1, '190441100128'),
(16, '2021-06-04', NULL, 0, 1, 1, '190441100175');

--
-- Trigger `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `log_delete_peminjaman` AFTER DELETE ON `peminjaman` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "D", "peminjaman", old.id_peminjaman, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_peminjaman` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "I", "peminjaman", new.id_peminjaman, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_peminjaman` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "U", "peminjaman", old.id_peminjaman, NOW(), USER());
END
$$
DELIMITER ;

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
(1, 'admin', 'L', '2001-10-30', '085232261008', 'Kamal', 'admin', 'admin', 'Super Admin'),
(25, 'Khoirul Anam', 'L', '2001-10-30', '085232261008', 'Kamal', 'anam', 'anam', 'Super Admin'),
(27, 'Archi', 'P', '2021-06-03', '085232261001', 'asd', 'archi', 'archi', 'Admin');

--
-- Trigger `petugas`
--
DELIMITER $$
CREATE TRIGGER `log_delete_petugas` AFTER DELETE ON `petugas` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "D", "petugas", old.id_petugas, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_petugas` AFTER INSERT ON `petugas` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "I", "petugas", new.id_petugas, NOW(), USER());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_update_petugas` AFTER UPDATE ON `petugas` FOR EACH ROW BEGIN
    INSERT INTO log
    VALUES(NULL, "U", "petugas", old.id_petugas, NOW(), USER());
END
$$
DELIMITER ;

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
