-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2020 pada 16.57
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_ci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `nim` varchar(30) DEFAULT NULL,
  `no_hp_lama` varchar(30) DEFAULT NULL,
  `no_hp_baru` varchar(30) DEFAULT NULL,
  `tgl_diubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id`, `nim`, `no_hp_lama`, `no_hp_baru`, `tgl_diubah`) VALUES
(7, '161240000595', '082334794796', '082334794799', '2019-11-03 19:58:49'),
(8, '161240000595', '082334794799', '082334794790', '2019-11-03 19:58:53'),
(9, '161240000577', '08975758587', '08975758587', '2019-11-03 20:27:06'),
(10, '161240000579', '08975758587', '082334794796', '2019-11-04 09:47:52'),
(11, '161240000595', '082334794796', '082334794796', '2019-11-04 12:28:25'),
(12, '161240000595', '082334794796', '082334794796', '2019-11-04 12:35:23'),
(13, '123', '082334794796', '082334794796', '2019-11-05 20:56:14'),
(14, '161240000595', '082334794796', '082334794796', '2019-11-06 19:03:14'),
(15, '161240000595', '082334794796', '082334794796', '2019-11-06 23:00:47'),
(16, '161240000595', '082334794796', '082334794796', '2019-11-06 23:00:54'),
(17, 'ddd', 'dd', 'dd', '2019-12-03 12:36:33'),
(18, 'dshd', 'dyd', 'dyd', '2019-12-03 12:36:43'),
(19, 'yyyyyyy', 'yyyyyyyyy', 'yyyyyyyyy', '2019-12-03 12:36:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhs`
--

CREATE TABLE `mhs` (
  `id` int(11) NOT NULL,
  `nim` varchar(40) DEFAULT NULL,
  `nama_mhs` varchar(40) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mhs`
--

INSERT INTO `mhs` (`id`, `nim`, `nama_mhs`, `jenis_kelamin`, `alamat`, `no_hp`) VALUES
(18, '161240000595', 'Sakti', 'L', 'Mlonggo', '082334794796'),
(19, '123', 'Devi Nurlita Andriyani', 'P', 'Mlonggo', '08975758587'),
(20, '161240000533', 'Bodong', 'L', 'Kauman', '0822222222222'),
(21, '123', 'sak', 'L', 'Mlonggo', '082334794796'),
(22, '161240000595', 'Devi Nurlita Andriyani', 'L', 'Mlonggo', '082334794796'),
(23, '161240000597', 'oooooooo', 'L', 'Mlonggo', '082334794796'),
(24, '112', 'djdj', 'P', 'dhdh', '000099'),
(25, '161240000557', 'dhdhd', 'P', 'eyeye', '98888'),
(27, '161240000557', 'Sakti', 'P', 'edhdeyd', '7777'),
(28, '161240000557', 'edee', 'P', 'dehhd', '098222'),
(29, '161240000597', 'dhjdjd', 'L', 'dhyd', '888888'),
(30, '333333333333', 'Devi Nurlita Andriyani', 'P', 'Mlonggo', 'dd'),
(31, '11111111111111', 'dhdhd', 'L', 'dhdh', 'dyd'),
(32, '11111111111', 'shgdhd', 'P', 'dhdhd', 'dgdjdd'),
(33, '444444444444444', 'yyyyyyyyy', 'P', 'yyyyyyyyyy', 'yyyyyyyyy');

--
-- Trigger `mhs`
--
DELIMITER $$
CREATE TRIGGER `before_update` BEFORE UPDATE ON `mhs` FOR EACH ROW BEGIN 
INSERT INTO log
set nim = OLD.nim,
no_hp_baru=new.no_hp,
no_hp_lama=old.no_hp,
tgl_diubah=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `tampil`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `tampil` (
`id` int(11)
,`nim` varchar(40)
,`nama_mhs` varchar(40)
,`jenis_kelamin` varchar(1)
,`alamat` varchar(30)
,`no_hp` varchar(20)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `tampil`
--
DROP TABLE IF EXISTS `tampil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil`  AS  (select `mhs`.`id` AS `id`,`mhs`.`nim` AS `nim`,`mhs`.`nama_mhs` AS `nama_mhs`,`mhs`.`jenis_kelamin` AS `jenis_kelamin`,`mhs`.`alamat` AS `alamat`,`mhs`.`no_hp` AS `no_hp` from `mhs`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
