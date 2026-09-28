-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Mar 2026 pada 16.45
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candyredis212`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `absId` int(11) NOT NULL COMMENT 'id absen',
  `absIdSiswa` int(11) DEFAULT NULL COMMENT 'id siswa',
  `absIdKelas` int(11) DEFAULT NULL COMMENT 'id kelas',
  `absTgl` date DEFAULT NULL COMMENT 'tanggal absen',
  `absJamIn` time DEFAULT NULL COMMENT 'jam masuk',
  `absJamOut` time DEFAULT NULL COMMENT 'jam keluar',
  `absStatus` varchar(5) DEFAULT NULL COMMENT 'H,T,S,I,B',
  `absJenis` int(1) DEFAULT 1,
  `absFoto` varchar(255) DEFAULT NULL,
  `absUrlFoto` varchar(255) DEFAULT NULL,
  `absCreated` timestamp NULL DEFAULT current_timestamp(),
  `absKeterangan` text DEFAULT NULL COMMENT 'Keterangan',
  `absKeterangan2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_mapel`
--

CREATE TABLE `absensi_mapel` (
  `amId` int(11) NOT NULL COMMENT 'id absen mapel',
  `amKode` varchar(10) DEFAULT NULL,
  `amKelas` int(11) DEFAULT NULL COMMENT 'id kelas',
  `amIdMapel` int(11) DEFAULT NULL COMMENT 'id mapel',
  `amIdGuru` int(11) DEFAULT NULL COMMENT 'id guru',
  `amNamaMapel` varchar(100) DEFAULT NULL COMMENT 'nama mapel',
  `amSlag` varchar(100) DEFAULT NULL,
  `amJamMulai` time DEFAULT NULL,
  `amJamAkhir` time DEFAULT NULL,
  `amHari` varchar(25) DEFAULT NULL,
  `amStatus` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_mapel_anggota`
--

CREATE TABLE `absensi_mapel_anggota` (
  `amaId` int(11) NOT NULL COMMENT 'id absen anggota mapel',
  `amaIdAbsenMapel` int(11) DEFAULT NULL COMMENT 'id absen mapel',
  `amaIdSiswa` int(11) DEFAULT NULL COMMENT 'id siswa',
  `amaIdKelas` int(11) DEFAULT NULL COMMENT 'id kelas',
  `amaIdMapel` int(11) DEFAULT NULL COMMENT 'id mapel',
  `amaTgl` date DEFAULT NULL,
  `amaJamIn` time DEFAULT NULL,
  `amaStatus` varchar(5) DEFAULT NULL,
  `amaUrlFoto` varchar(255) DEFAULT NULL,
  `amaFoto` varchar(255) DEFAULT NULL,
  `amaCreated` timestamp NULL DEFAULT current_timestamp(),
  `amaKeterangan` text DEFAULT NULL COMMENT 'keterangan izin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(10) NOT NULL,
  `id_mapel` int(10) NOT NULL,
  `sesi` varchar(10) NOT NULL,
  `ruang` varchar(20) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `ikut` varchar(10) DEFAULT NULL,
  `susulan` varchar(10) DEFAULT NULL,
  `no_susulan` text DEFAULT NULL,
  `mulai` varchar(10) DEFAULT NULL,
  `selesai` varchar(10) DEFAULT NULL,
  `nama_proktor` varchar(50) DEFAULT NULL,
  `nip_proktor` varchar(50) DEFAULT NULL,
  `nama_pengawas` varchar(50) DEFAULT NULL,
  `nip_pengawas` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_ujian` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bot_telegram`
--

CREATE TABLE `bot_telegram` (
  `botId` int(11) NOT NULL,
  `botNama` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `botKode` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `botToken` text CHARACTER SET latin1 DEFAULT NULL,
  `botChatId` varchar(255) DEFAULT NULL,
  `botCreated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `botActive` int(1) DEFAULT 1,
  `botSendAbsenMapel` int(1) DEFAULT 1 COMMENT 'Send Absen Mapel',
  `botSendAbsenSekolah` int(1) DEFAULT 1 COMMENT 'Send Absen Sekolah',
  `botSendTugas` int(1) DEFAULT 1 COMMENT 'Send Absne Tugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bot_telegram`
--

INSERT INTO `bot_telegram` (`botId`, `botNama`, `botKode`, `botToken`, `botChatId`, `botCreated_at`, `botActive`, `botSendAbsenMapel`, `botSendAbsenSekolah`, `botSendTugas`) VALUES
(1, 'BUDUT', NULL, '1317773341:AAEpnmoIAoX7FS14d2UsspgnGR-tIgWXbxY', '-415714734', '2020-08-11 17:38:16', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dapodik`
--

CREATE TABLE `dapodik` (
  `dpId` int(11) NOT NULL,
  `dpToken` varchar(100) DEFAULT NULL,
  `dpUrl` varchar(100) DEFAULT NULL,
  `dpPort` varchar(10) DEFAULT NULL,
  `dpNpsn` varchar(100) DEFAULT NULL,
  `dpPengguna` varchar(100) DEFAULT NULL,
  `dpSekolah` varchar(100) DEFAULT NULL,
  `dpRombel` varchar(100) DEFAULT NULL,
  `dpGtk` varchar(100) DEFAULT NULL,
  `dpSiswa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dapodik`
--

INSERT INTO `dapodik` (`dpId`, `dpToken`, `dpUrl`, `dpPort`, `dpNpsn`, `dpPengguna`, `dpSekolah`, `dpRombel`, `dpGtk`, `dpSiswa`) VALUES
(1, 'Yxt92CPKPaIvJvm', 'localhost', '5774', '10814070', 'getPengguna', 'getSekolah', 'getRombelBelajar', 'getGtk', 'getPesertaDidik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_pendukung`
--

CREATE TABLE `file_pendukung` (
  `id_file` int(11) NOT NULL,
  `id_mapel` int(11) DEFAULT 0,
  `nama_file` varchar(50) DEFAULT NULL,
  `status_file` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `file_pendukung`
--

INSERT INTO `file_pendukung` (`id_file`, `id_mapel`, `nama_file`, `status_file`) VALUES
(1, 1, '16157040731.png', NULL),
(2, 1, '16186424661.png', NULL),
(3, 1, '161864246611.png', NULL),
(4, 1, '16186424669.png', NULL),
(5, 1, '16186424667.png', NULL),
(6, 1, '16186424664.png', NULL),
(7, 1, '16186424662.png', NULL),
(8, 1, '161864246612.png', NULL),
(9, 1, '16186424668.png', NULL),
(10, 1, '16186424666.png', NULL),
(11, 1, '16186424665.png', NULL),
(12, 1, '16186424663.png', NULL),
(13, 1, '161864246610.png', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_skl`
--

CREATE TABLE `jam_skl` (
  `jmId` int(11) NOT NULL COMMENT 'id jam sekolah',
  `jamIn` time DEFAULT NULL COMMENT 'jam masuk',
  `jamOut` time DEFAULT NULL COMMENT 'jam pulang',
  `jamOutJumat` time DEFAULT NULL COMMENT 'jam pulang jumat',
  `jamAlpah` time DEFAULT NULL COMMENT 'jam alpha',
  `jamTerlambat` time DEFAULT NULL COMMENT 'jam terlambat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam_skl`
--

INSERT INTO `jam_skl` (`jmId`, `jamIn`, `jamOut`, `jamOutJumat`, `jamAlpah`, `jamTerlambat`) VALUES
(1, '06:00:00', '13:00:00', '11:00:00', '00:00:00', '07:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `jawaban` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `jawabx` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `jenis` int(1) NOT NULL,
  `esai` text CHARACTER SET latin1 DEFAULT NULL,
  `nilai_esai` int(5) NOT NULL DEFAULT 0,
  `ragu` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_copy`
--

CREATE TABLE `jawaban_copy` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `jawaban` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `jawabx` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `jenis` int(1) NOT NULL,
  `esai` text CHARACTER SET latin1 DEFAULT NULL,
  `nilai_esai` int(5) NOT NULL DEFAULT 0,
  `ragu` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban_copy`
--

INSERT INTO `jawaban_copy` (`id_jawaban`, `id_siswa`, `id_mapel`, `id_soal`, `id_ujian`, `jawaban`, `jawabx`, `jenis`, `esai`, `nilai_esai`, `ragu`) VALUES
(121, 11, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(122, 11, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(123, 11, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(124, 11, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(125, 11, 14, 32, 21, 'A', 'A', 1, NULL, 0, 0),
(132, 12, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(133, 12, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(144, 1, 19, 517, 27, 'A', 'A', 1, NULL, 0, 0),
(145, 1, 19, 504, 27, 'A', 'A', 1, NULL, 0, 0),
(146, 1, 19, 484, 27, 'A', 'A', 1, NULL, 0, 0),
(147, 1, 19, 510, 27, 'A', 'A', 1, NULL, 0, 0),
(148, 1, 19, 496, 27, 'A', 'A', 1, NULL, 0, 0),
(149, 1, 19, 514, 27, 'B', 'B', 1, NULL, 0, 0),
(150, 1, 19, 521, 27, 'A', 'A', 1, NULL, 0, 0),
(151, 1, 19, 483, 27, 'A', 'A', 1, NULL, 0, 0),
(152, 1, 19, 498, 27, 'A', 'A', 1, NULL, 0, 0),
(153, 1, 19, 505, 27, 'A', 'A', 1, NULL, 0, 0),
(154, 1, 19, 490, 27, 'A', 'A', 1, NULL, 0, 0),
(155, 1, 19, 516, 27, 'A', 'A', 1, NULL, 0, 0),
(156, 1, 19, 494, 27, 'A', 'A', 1, NULL, 0, 0),
(157, 1, 19, 511, 27, 'A', 'A', 1, NULL, 0, 0),
(158, 1, 19, 506, 27, 'A', 'A', 1, NULL, 0, 0),
(159, 1, 19, 508, 27, 'A', 'A', 1, NULL, 0, 0),
(160, 1, 19, 500, 27, 'A', 'A', 1, NULL, 0, 0),
(161, 1, 19, 518, 27, 'A', 'A', 1, NULL, 0, 0),
(162, 1, 19, 489, 27, 'A', 'A', 1, NULL, 0, 0),
(163, 1, 19, 515, 27, 'A', 'A', 1, NULL, 0, 0),
(164, 1, 19, 499, 27, 'A', 'A', 1, NULL, 0, 0),
(165, 1, 19, 519, 27, 'A', 'A', 1, NULL, 0, 0),
(166, 1, 19, 513, 27, 'A', 'A', 1, NULL, 0, 0),
(167, 1, 19, 501, 27, 'A', 'A', 1, NULL, 0, 0),
(168, 1, 19, 497, 27, 'A', 'A', 1, NULL, 0, 0),
(169, 1, 19, 491, 27, 'A', 'A', 1, NULL, 0, 0),
(170, 1, 19, 488, 27, 'A', 'A', 1, NULL, 0, 0),
(171, 1, 19, 495, 27, 'A', 'A', 1, NULL, 0, 0),
(172, 1, 19, 520, 27, 'A', 'A', 1, NULL, 0, 0),
(173, 1, 19, 522, 27, 'A', 'A', 1, NULL, 0, 0),
(174, 1, 19, 493, 27, 'A', 'A', 1, NULL, 0, 0),
(175, 1, 19, 509, 27, 'A', 'A', 1, NULL, 0, 0),
(176, 1, 19, 507, 27, 'A', 'A', 1, NULL, 0, 0),
(177, 1, 19, 503, 27, 'A', 'A', 1, NULL, 0, 0),
(178, 1, 19, 486, 27, 'A', 'A', 1, NULL, 0, 0),
(179, 1, 19, 512, 27, 'A', 'A', 1, NULL, 0, 0),
(180, 1, 19, 485, 27, 'A', 'A', 1, NULL, 0, 0),
(181, 1, 19, 487, 27, 'A', 'A', 1, NULL, 0, 0),
(182, 1, 19, 492, 27, 'A', 'A', 1, NULL, 0, 0),
(183, 1, 19, 502, 27, 'A', 'A', 1, NULL, 0, 0),
(184, 4, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(185, 4, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(186, 4, 14, 32, 21, 'B', 'B', 1, NULL, 0, 0),
(187, 4, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(188, 4, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(189, 7, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(190, 7, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(191, 7, 14, 30, 21, 'B', 'B', 1, NULL, 0, 0),
(192, 7, 14, 32, 21, 'C', 'C', 1, NULL, 0, 0),
(193, 7, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(194, 8, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(195, 8, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(196, 8, 14, 32, 21, 'A', 'A', 1, NULL, 0, 0),
(197, 8, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(198, 8, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(199, 9, 14, 32, 21, 'A', 'A', 1, NULL, 0, 0),
(200, 9, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(201, 9, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(202, 9, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(203, 9, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(204, 1, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(205, 1, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(206, 1, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(207, 1, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(208, 1, 14, 32, 21, 'A', 'A', 1, NULL, 0, 0),
(209, 5, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(210, 5, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(211, 5, 14, 32, 21, 'A', 'A', 1, NULL, 0, 0),
(212, 5, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(213, 5, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(214, 12, 14, 34, 21, 'B', 'B', 1, NULL, 0, 0),
(215, 12, 14, 33, 21, 'A', 'A', 1, NULL, 0, 0),
(216, 12, 14, 32, 21, 'C', 'C', 1, NULL, 0, 0),
(217, 12, 14, 31, 21, 'D', 'D', 1, NULL, 0, 0),
(218, 12, 14, 30, 21, 'B', 'B', 1, NULL, 0, 0),
(219, 13, 14, 33, 21, 'D', 'D', 1, NULL, 0, 0),
(220, 13, 14, 34, 21, 'D', 'D', 1, NULL, 0, 0),
(221, 13, 14, 32, 21, 'A', 'A', 1, NULL, 0, 0),
(222, 13, 14, 30, 21, 'B', 'B', 1, NULL, 0, 0),
(223, 13, 14, 31, 21, 'A', 'A', 1, NULL, 0, 0),
(224, 14, 14, 33, 21, 'C', 'C', 1, NULL, 0, 0),
(225, 14, 14, 34, 21, 'A', 'A', 1, NULL, 0, 0),
(226, 14, 14, 32, 21, 'B', 'B', 1, NULL, 0, 0),
(227, 14, 14, 30, 21, 'A', 'A', 1, NULL, 0, 0),
(228, 14, 14, 31, 21, 'B', 'B', 1, NULL, 0, 0),
(229, 11, 3, 13, 4, 'A', 'A', 1, NULL, 0, 0),
(230, 11, 3, 11, 4, 'B', 'B', 1, NULL, 0, 0),
(231, 11, 3, 12, 4, 'C', 'C', 1, NULL, 0, 0),
(232, 11, 3, 15, 4, '', '', 2, '<p>ded<br></p>', 0, 0),
(233, 11, 3, 14, 4, '', '', 2, '<p>oke<br></p>', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_tugas`
--

CREATE TABLE `jawaban_tugas` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `jawaban` longblob DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tgl_dikerjakan` datetime DEFAULT NULL,
  `tgl_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nilai` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `catatanGuru` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama`, `status`) VALUES
('US', 'Ujian Sekolah', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` varchar(25) NOT NULL,
  `nama_jurusan_sp` varchar(100) DEFAULT NULL,
  `kurikulum` varchar(120) DEFAULT NULL,
  `jurusan_sp_id` varchar(50) DEFAULT NULL,
  `kurikulum_id` varchar(20) DEFAULT NULL,
  `sekolah_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `idkls` int(11) NOT NULL,
  `id_kelas` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `nama` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `id_level` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `id_pk` varchar(10) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`idkls`, `id_kelas`, `nama`, `id_level`, `id_pk`) VALUES
(1, 'XIITP', 'XIITP', 'XII', 'TP'),
(2, 'XIITKR', 'XIITKR', 'XII', 'TKR'),
(3, 'XIITKJ', 'XIITKJ', 'XII', 'TKJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `idlevel` int(11) NOT NULL,
  `kode_level` varchar(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`idlevel`, `kode_level`, `keterangan`) VALUES
(1, 'XII', 'XII');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `text` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_siswa`, `type`, `text`, `date`) VALUES
(1, 25, 'login', 'masuk', '2021-04-17 13:56:21'),
(2, 25, 'logout', 'keluar', '2021-04-17 13:57:19'),
(3, 24, 'login', 'masuk', '2021-04-17 13:57:24'),
(4, 24, 'logout', 'keluar', '2021-04-17 13:57:29'),
(5, 20, 'login', 'masuk', '2021-04-17 13:57:40'),
(6, 20, 'logout', 'keluar', '2021-04-17 13:57:50'),
(7, 35, 'login', 'masuk', '2021-04-17 13:58:06'),
(8, 35, 'logout', 'keluar', '2021-04-17 13:58:58'),
(9, 25, 'login', 'masuk', '2021-04-17 13:59:07'),
(10, 25, 'logout', 'keluar', '2021-04-17 13:59:16'),
(11, 3, 'login', 'masuk', '2021-04-17 16:04:25'),
(12, 3, 'testongoing', 'sedang ujian', '2021-04-17 16:04:36'),
(13, 3, 'login', 'Selesai Ujian', '2021-04-17 16:06:34'),
(14, 3, 'logout', 'keluar', '2021-04-17 16:06:43'),
(15, 5, 'login', 'masuk', '2021-04-17 16:06:58'),
(16, 5, 'logout', 'keluar', '2021-04-17 16:07:04'),
(17, 7, 'login', 'masuk', '2021-04-17 16:07:15'),
(18, 7, 'logout', 'keluar', '2021-04-17 16:07:20'),
(19, 9, 'login', 'masuk', '2021-04-17 16:07:24'),
(20, 9, 'logout', 'keluar', '2021-04-17 16:07:29'),
(21, 11, 'login', 'masuk', '2021-04-17 16:07:33'),
(22, 11, 'logout', 'keluar', '2021-04-17 16:07:41'),
(23, 21, 'login', 'masuk', '2021-04-17 16:07:53'),
(24, 21, 'logout', 'keluar', '2021-04-17 16:08:12'),
(25, 19, 'login', 'masuk', '2021-04-17 16:08:16'),
(26, 19, 'logout', 'keluar', '2021-04-17 16:08:21'),
(27, 17, 'login', 'masuk', '2021-04-17 16:08:27'),
(28, 17, 'logout', 'keluar', '2021-04-17 16:08:32'),
(29, 15, 'login', 'masuk', '2021-04-17 16:08:39'),
(30, 15, 'logout', 'keluar', '2021-04-17 16:08:44'),
(31, 13, 'login', 'masuk', '2021-04-17 16:08:49'),
(32, 13, 'logout', 'keluar', '2021-04-17 16:08:53'),
(33, 14, 'login', 'masuk', '2021-04-17 16:08:58'),
(34, 14, 'logout', 'keluar', '2021-04-17 16:09:08'),
(35, 11, 'login', 'masuk', '2021-04-17 16:09:14'),
(36, 11, 'logout', 'keluar', '2021-04-17 16:09:17'),
(37, 13, 'login', 'masuk', '2021-04-17 16:09:23'),
(38, 13, 'logout', 'keluar', '2021-04-17 16:11:48'),
(39, 13, 'login', 'masuk', '2021-04-17 16:11:54'),
(40, 13, 'logout', 'keluar', '2021-04-17 16:12:54'),
(41, 5, 'login', 'masuk', '2021-04-17 16:25:48'),
(42, 2, 'login', 'masuk', '2026-03-10 12:35:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_log` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `idpk` varchar(10) CHARACTER SET latin1 NOT NULL,
  `idguru` int(11) NOT NULL,
  `KodeMapel` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Kode Mata Pelajaran',
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `jml_soal` int(5) NOT NULL,
  `jml_esai` int(5) NOT NULL,
  `tampil_pg` int(5) NOT NULL,
  `tampil_esai` int(5) NOT NULL,
  `bobot_pg` int(5) NOT NULL,
  `bobot_esai` int(5) NOT NULL,
  `level` varchar(5) CHARACTER SET latin1 NOT NULL,
  `opsi` int(1) NOT NULL,
  `kelas` longtext CHARACTER SET latin1 NOT NULL,
  `siswa` longtext CHARACTER SET latin1 DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(2) CHARACTER SET latin1 NOT NULL,
  `statusujian` int(11) DEFAULT 0,
  `jenisSoalUjian` int(1) NOT NULL COMMENT '1 PG, 2 Esai, 3 PG Esai',
  `soalAgama` int(1) DEFAULT 0 COMMENT 'jenis soal agama',
  `soalAgamaList` varchar(100) DEFAULT 'umum' COMMENT 'list soal agama',
  `soalPaket` varchar(10) DEFAULT 'A' COMMENT 'jenis paket soal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `idpk`, `idguru`, `KodeMapel`, `nama`, `jml_soal`, `jml_esai`, `tampil_pg`, `tampil_esai`, `bobot_pg`, `bobot_esai`, `level`, `opsi`, `kelas`, `siswa`, `date`, `status`, `statusujian`, `jenisSoalUjian`, `soalAgama`, `soalAgamaList`, `soalPaket`) VALUES
(1, 'semua', 257, 'BINDO', 'UJIIPA', 40, 0, 40, 0, 100, 0, 'XII', 5, 'a:1:{i:0;s:5:\"semua\";}', '', '2021-04-17 09:12:31', '1', 0, 1, 0, 'umum', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `idmapel` int(11) NOT NULL,
  `kode_mapel` varchar(100) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `mata_pelajaran_id` varchar(100) DEFAULT NULL,
  `kode_level` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`idmapel`, `kode_mapel`, `nama_mapel`, `mata_pelajaran_id`, `kode_level`) VALUES
(1, 'BINDO', 'BAHASA INDONESIA', '', 'XII'),
(2, 'MTK', 'MATEMATIKA', '', 'XII'),
(3, 'BING', 'BAHASA INGGRIS', '', 'XII'),
(4, 'KIMIA', 'KIMIA', '', 'XII'),
(6, 'PKN', 'PENDIDIKAN KEWARGANEGARAAN', '', 'XII'),
(7, 'PJOK', 'PENJASKES', '', 'XII'),
(8, 'FISIKA', 'FISIKA', '', 'XII'),
(9, 'PAI', 'PENDIDIKAN AGAMA ISLAM', '', 'XII'),
(10, 'PRODTKJ', 'PRODUKTIF TKJ', '', 'XII');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi2`
--

CREATE TABLE `materi2` (
  `materi2_id` int(5) NOT NULL,
  `materi2_mapel` varchar(255) DEFAULT '0',
  `materi2_judul` varchar(255) DEFAULT NULL,
  `materi2_isi` longblob DEFAULT NULL,
  `materi2_file` varchar(255) DEFAULT NULL,
  `materi2_tgl_rilis` datetime DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `kelas` varchar(255) NOT NULL,
  `materi2_tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `url_youtube` longtext DEFAULT NULL,
  `url_gdrive` longtext DEFAULT NULL,
  `url_embed` varchar(255) DEFAULT NULL,
  `kode_level` varchar(20) DEFAULT NULL,
  `materi2_status` int(1) DEFAULT 1,
  `materi2_jenis` text DEFAULT NULL,
  `materi2_jenis2` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `materi2`
--

INSERT INTO `materi2` (`materi2_id`, `materi2_mapel`, `materi2_judul`, `materi2_isi`, `materi2_file`, `materi2_tgl_rilis`, `id_guru`, `kelas`, `materi2_tgl`, `url_youtube`, `url_gdrive`, `url_embed`, `kode_level`, `materi2_status`, `materi2_jenis`, `materi2_jenis2`) VALUES
(1, 'KIMIA', 'Cara Membaca', 0x3c703e43617261204d656d626163613c62723e3c2f703e, NULL, '2021-03-27 01:00:00', 1, 'a:1:{i:0;s:5:\"XIITP\";}', '2021-03-27 07:42:46', '', '', '', 'XII', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_view`
--

CREATE TABLE `materi_view` (
  `mtrViewId` int(11) NOT NULL COMMENT 'id materi view',
  `mtrViewIdSiswa` int(11) DEFAULT NULL COMMENT 'id siswa',
  `mtrViewIdMateri` int(11) DEFAULT NULL COMMENT 'id materi',
  `mtrViewJenis` int(1) DEFAULT NULL COMMENT 'jenis view',
  `mtrViewDate` datetime DEFAULT NULL COMMENT 'date time view',
  `mtrViewStatus` int(1) DEFAULT NULL COMMENT 'status view'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL COMMENT 'id ujian',
  `id_mapel` int(11) NOT NULL COMMENT 'kode bank soal',
  `id_siswa` int(11) NOT NULL,
  `kode_ujian` varchar(30) CHARACTER SET latin1 NOT NULL,
  `KodeMataPelajaran` varchar(100) DEFAULT NULL COMMENT 'kode mata pelajaran',
  `ujian_mulai` varchar(20) CHARACTER SET latin1 NOT NULL,
  `ujian_berlangsung` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `ujian_selesai` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `jml_benar` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `jml_salah` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `nilai_esai` varchar(10) CHARACTER SET latin1 DEFAULT '0',
  `skor` varchar(10) CHARACTER SET latin1 DEFAULT '0',
  `total` varchar(10) CHARACTER SET latin1 DEFAULT '0',
  `status` varchar(1) DEFAULT NULL,
  `ipaddress` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `hasil` int(2) NOT NULL,
  `jawaban` text CHARACTER SET latin1 DEFAULT NULL,
  `jawaban_esai` longtext CHARACTER SET latin1 DEFAULT NULL,
  `online` int(1) NOT NULL DEFAULT 0,
  `blok` int(2) DEFAULT 0,
  `id_soal` longtext CHARACTER SET latin1 DEFAULT NULL,
  `id_opsi` longtext CHARACTER SET latin1 DEFAULT NULL,
  `id_esai` text CHARACTER SET latin1 DEFAULT NULL,
  `nilai_esai2` longtext CHARACTER SET latin1 DEFAULT NULL,
  `selesai` int(2) DEFAULT 0,
  `cek_tombol_selesai` int(2) DEFAULT 0,
  `nilaiPaketSoal` varchar(10) DEFAULT NULL COMMENT 'Paket Soal Di Ambil Siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_pindah`
--

CREATE TABLE `nilai_pindah` (
  `id_nilai` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL COMMENT 'id ujian',
  `id_mapel` int(11) NOT NULL COMMENT 'kode bank',
  `id_siswa` int(11) NOT NULL,
  `kode_ujian` varchar(30) CHARACTER SET latin1 NOT NULL,
  `KodeMataPelajaran` varchar(100) DEFAULT NULL COMMENT 'kode mata pelajaran',
  `ujian_mulai` varchar(20) CHARACTER SET latin1 NOT NULL,
  `ujian_berlangsung` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `ujian_selesai` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `jml_benar` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `jml_salah` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `nilai_esai` varchar(10) CHARACTER SET latin1 DEFAULT '0',
  `skor` varchar(10) CHARACTER SET latin1 DEFAULT '0',
  `total` varchar(10) CHARACTER SET latin1 DEFAULT '0',
  `status` varchar(1) DEFAULT NULL,
  `ipaddress` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `hasil` int(2) NOT NULL,
  `jawaban` text CHARACTER SET latin1 DEFAULT NULL,
  `jawaban_esai` longtext CHARACTER SET latin1 DEFAULT NULL,
  `online` int(1) NOT NULL DEFAULT 0,
  `blok` int(2) DEFAULT 0,
  `id_soal` longtext CHARACTER SET latin1 DEFAULT NULL,
  `id_opsi` longtext CHARACTER SET latin1 DEFAULT NULL,
  `id_esai` text CHARACTER SET latin1 DEFAULT NULL,
  `nilai_esai2` longtext CHARACTER SET latin1 DEFAULT NULL,
  `selesai` int(2) DEFAULT 0,
  `cek_tombol_selesai` int(2) DEFAULT 0,
  `nilaiPaketSoal` varchar(10) DEFAULT NULL COMMENT 'Paket Soal Di Ambil Siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengacak`
--

CREATE TABLE `pengacak` (
  `id_pengacak` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_soal` longtext NOT NULL,
  `id_opsi` longtext DEFAULT NULL,
  `id_esai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawas`
--

CREATE TABLE `pengawas` (
  `id_pengawas` int(11) NOT NULL,
  `nip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `password` text CHARACTER SET utf8 DEFAULT NULL,
  `level` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `password2` text CHARACTER SET utf8 DEFAULT NULL,
  `id_kls` varchar(11) DEFAULT NULL,
  `id_jrs` varchar(11) DEFAULT NULL,
  `foto_pengawas` varchar(100) DEFAULT NULL,
  `pengawas_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nip`, `nama`, `jabatan`, `username`, `password`, `level`, `password2`, `id_kls`, `id_jrs`, `foto_pengawas`, `pengawas_created`) VALUES
(1, '-', 'administrator', '', 'admin', '$2y$10$3fVC8VJfm8ElEv6PNLT2R.XalOF.sFq7TOgJE54p5KQm2oL/0N1Im', 'admin', NULL, NULL, NULL, NULL, NULL),
(255, '-', 'Guru', 'guru', 'mkks', 'mkks', 'guru', NULL, '', '', '2521596532667.jpg', '2020-08-03 21:17:47'),
(257, '-', 'Guru', 'guru', 'mkks1', 'mkks1', 'guru', '', '', '', '', '2021-02-21 03:10:35'),
(258, '-', 'MKKS2', 'guru', 'mkks2', 'mkks2', 'guru', '', '', '', '', '2021-02-21 03:11:05'),
(259, '-', 'MKKS3', 'guru', 'mkks3', 'mkks3', 'guru', '', '', '', '', '2021-02-21 03:11:47'),
(260, '-', 'MKKS4', 'guru', 'mkks4', 'mkks4', 'guru', '', '', '', '', '2021-02-21 03:12:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(5) NOT NULL,
  `type` varchar(30) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `user` int(3) NOT NULL,
  `text` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pnKelas` varchar(255) DEFAULT NULL,
  `pnLevel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pk`
--

CREATE TABLE `pk` (
  `idpk` int(11) NOT NULL,
  `id_pk` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `program_keahlian` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pk`
--

INSERT INTO `pk` (`idpk`, `id_pk`, `program_keahlian`) VALUES
(1, 'TP', 'TP'),
(2, 'TKR', 'TKR'),
(3, 'TKJ', 'TKJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `referensi_jurusan`
--

CREATE TABLE `referensi_jurusan` (
  `jurusan_id` varchar(10) NOT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `untuk_sma` int(1) NOT NULL,
  `untuk_smk` int(1) NOT NULL,
  `jenjang_pendidikan_id` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `kode_ruang` varchar(10) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`kode_ruang`, `keterangan`) VALUES
('R1', 'R1'),
('R2', 'R2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `savsoft_options`
--

CREATE TABLE `savsoft_options` (
  `oid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `q_option_match` varchar(1000) DEFAULT NULL,
  `score` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `savsoft_qbank`
--

CREATE TABLE `savsoft_qbank` (
  `qid` int(11) NOT NULL,
  `question_type` varchar(100) NOT NULL DEFAULT 'Multiple Choice Single Answer',
  `question` text NOT NULL,
  `description` text NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `no_time_served` int(11) NOT NULL DEFAULT 0,
  `no_time_corrected` int(11) NOT NULL DEFAULT 0,
  `no_time_incorrected` int(11) NOT NULL DEFAULT 0,
  `no_time_unattempted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `semester_id` varchar(5) NOT NULL,
  `tahun_ajaran_id` varchar(4) NOT NULL,
  `nama_semester` varchar(50) NOT NULL,
  `semester` int(1) NOT NULL,
  `periode_aktif` enum('1','0') NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `server`
--

CREATE TABLE `server` (
  `kode_server` varchar(20) NOT NULL,
  `nama_server` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `server`
--

INSERT INTO `server` (`kode_server`, `nama_server`, `status`) VALUES
('SR01', 'SR01', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi`
--

CREATE TABLE `sesi` (
  `kode_sesi` varchar(10) NOT NULL,
  `nama_sesi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sesi`
--

INSERT INTO `sesi` (`kode_sesi`, `nama_sesi`) VALUES
('1', '1'),
('2', '2'),
('3', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session_time` varchar(10) NOT NULL,
  `session_hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `aplikasi` varchar(100) DEFAULT NULL,
  `kode_sekolah` varchar(10) DEFAULT NULL,
  `sekolah` varchar(50) DEFAULT NULL,
  `jenjang` varchar(5) DEFAULT NULL,
  `kepsek` varchar(50) DEFAULT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `XProv` varchar(50) DEFAULT NULL,
  `XKab` varchar(50) DEFAULT NULL,
  `XKec` varchar(50) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `header` text DEFAULT NULL,
  `header_kartu` text DEFAULT NULL,
  `nama_ujian` text DEFAULT NULL,
  `versi` varchar(10) DEFAULT NULL,
  `ip_server` varchar(100) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `server` varchar(50) DEFAULT NULL,
  `id_server` varchar(50) DEFAULT NULL,
  `db_folder` varchar(50) DEFAULT NULL,
  `db_host` varchar(50) DEFAULT NULL,
  `db_user` varchar(50) DEFAULT NULL,
  `db_pass` varchar(50) DEFAULT NULL,
  `db_name` varchar(50) DEFAULT NULL,
  `db_token` varchar(100) DEFAULT NULL,
  `db_token1` varchar(100) DEFAULT NULL,
  `tokenApi` varchar(255) DEFAULT NULL,
  `sekolah_id` varchar(50) DEFAULT NULL,
  `npsn` varchar(10) DEFAULT NULL,
  `kartu_atas` int(11) DEFAULT NULL,
  `kartu_kiri` int(11) DEFAULT NULL,
  `url_host` varchar(100) DEFAULT NULL,
  `kartu_tinggi` int(11) DEFAULT NULL,
  `kartu_lebar` int(11) DEFAULT NULL,
  `protek` varchar(100) DEFAULT NULL,
  `nip_protek` varchar(30) DEFAULT NULL,
  `catat_login` int(1) DEFAULT 1,
  `izin_pass` int(1) DEFAULT 0,
  `izin_materi` int(1) DEFAULT 0,
  `izin_tugas` int(1) DEFAULT 0,
  `izin_info` int(1) DEFAULT 0,
  `izin_ujian` int(1) DEFAULT 0,
  `izin_status` tinyint(1) DEFAULT 0,
  `izin_sinkron` tinyint(1) DEFAULT 0 COMMENT 'fitur sinkron',
  `elerning` tinyint(1) DEFAULT 0 COMMENT 'aktif elerning',
  `folder_admin` varchar(100) DEFAULT NULL,
  `namapjj` varchar(255) DEFAULT NULL,
  `izin_absen` int(1) DEFAULT 0 COMMENT 'izin absen sekolah',
  `izin_absen_mapel` int(1) DEFAULT 0 COMMENT 'izin absen mapel',
  `izi_foto_absen` int(1) DEFAULT 0 COMMENT 'izin upload foto absen',
  `LoginSiswaMainten` int(1) DEFAULT 0 COMMENT 'Mainten Login Siswa',
  `IsiPesanSingkat` varchar(200) DEFAULT NULL COMMENT 'Isi Pesan Singkat Login Siswa',
  `JudulPesanSingkat` varchar(100) DEFAULT NULL COMMENT 'Judul Pesan Singkat Login Siswa',
  `mode_jawab` int(1) DEFAULT 0,
  `lisensiId` varchar(255) DEFAULT NULL,
  `namaSekolah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `aplikasi`, `kode_sekolah`, `sekolah`, `jenjang`, `kepsek`, `nip`, `alamat`, `kecamatan`, `kota`, `telp`, `XProv`, `XKab`, `XKec`, `fax`, `web`, `email`, `logo`, `header`, `header_kartu`, `nama_ujian`, `versi`, `ip_server`, `waktu`, `server`, `id_server`, `db_folder`, `db_host`, `db_user`, `db_pass`, `db_name`, `db_token`, `db_token1`, `tokenApi`, `sekolah_id`, `npsn`, `kartu_atas`, `kartu_kiri`, `url_host`, `kartu_tinggi`, `kartu_lebar`, `protek`, `nip_protek`, `catat_login`, `izin_pass`, `izin_materi`, `izin_tugas`, `izin_info`, `izin_ujian`, `izin_status`, `izin_sinkron`, `elerning`, `folder_admin`, `namapjj`, `izin_absen`, `izin_absen_mapel`, `izi_foto_absen`, `LoginSiswaMainten`, `IsiPesanSingkat`, `JudulPesanSingkat`, `mode_jawab`, `lisensiId`, `namaSekolah`) VALUES
(1, 'Kemudi LMS', 'kkk', 'Kemudi LMS', 'SMK', 'NAMA KEPALA SEKOLAH', '-', 'Jl.Pisang 163 Braja Sakti Way Jepara Lampung Timur ', '', '', '021364213', '', '', '', '02195878050', 'nama web', 'redis@candy.com', 'dist/img/logo34.png', 'Laporan Ujian Sekolah', 'UJIAN SEKOLAH', 'Ujian Sekolah', '2.5', 'http://192.168.0.200', 'Asia/Jakarta', 'pusat', 'SR01', '', 'http://localhost:8082/candy_redis/', 'root', '', '', 'KdtErhRT1niCDhRsEywpahVINHxwCe', 'KdtErhRT1niCDhRsEywpahVINHxwCe', 'Ua4sVas2jHNLIHashyZigA2erXRPYT', '8cce47df-aae7-4274-83cb-5af3093eab56', '69787351', 12, 50, '', 40, 90, 'NAMA OPERATOR ', '-', 0, 1, 1, 1, 1, 1, 1, 1, 1, '0', ' ', 1, 1, 1, 0, 'Dengan Ilmu Kita Menuju Kemuliaan', 'Ki Hadjar Dewantara', 0, 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'sdn godang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sinkron`
--

CREATE TABLE `sinkron` (
  `id_singkron` int(11) NOT NULL,
  `nama_data` varchar(50) NOT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `status_sinkron` int(11) DEFAULT NULL,
  `jumlah_server` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sinkron`
--

INSERT INTO `sinkron` (`id_singkron`, `nama_data`, `jumlah`, `tanggal`, `status_sinkron`, `jumlah_server`) VALUES
(1, 'KELAS', '', '', 0, ''),
(2, 'DATA_MASTER', '', '', 0, ''),
(3, 'SISWA', '', '', 0, ''),
(4, 'MAPEL', '', '', 0, ''),
(5, 'BANK_SOAL', '', '', 0, ''),
(6, 'SOAL', '', '', 0, ''),
(7, 'JADWAL', NULL, NULL, 0, NULL),
(8, 'SETTING', NULL, NULL, 0, NULL),
(9, 'FILE_PENDUKUNG', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `idpk` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `nis` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `no_peserta` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `firt_nama` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `level` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `ruang` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `sesi` int(2) DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` text CHARACTER SET latin1 DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `server` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `jenis_kelamin` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `agama` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `status_siswa` int(1) DEFAULT 1,
  `soalPaket` varchar(10) DEFAULT 'A' COMMENT 'paket soal pada siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `idpk`, `nis`, `no_peserta`, `firt_nama`, `nama`, `level`, `ruang`, `sesi`, `username`, `password`, `foto`, `server`, `jenis_kelamin`, `agama`, `status_siswa`, `soalPaket`) VALUES
(1, 'XIITP', 'TP', '151610041', '12-248-001-8', 'Ade', 'Ade Saputra', 'XII', 'R1', 1, 'hs001', 'ps001', 'hs001.jpg', 'SR01', NULL, 'kristen', 1, 'A'),
(2, 'XIITP', 'TP', '151610043', '12-248-002-7', 'Ahmad', 'Ahmad Fauzi', 'XII', 'R1', 1, 'hs002', 'ps002', 'hs002.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(3, 'XIITP', 'TP', '151610044', '12-248-003-6', 'Ahmad', 'Ahmad Fauzi', 'XII', 'R1', 1, 'hs003', 'ps003', 'hs003.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(4, 'XIITP', 'TP', '151610045', '12-248-004-5', 'Ahmad', 'Ahmad Juliansyah', 'XII', 'R1', 1, 'hs004', 'ps004', 'hs004.jpg', 'SR01', NULL, 'kristen', 1, 'B'),
(5, 'XIITP', 'TP', '151610047', '12-248-005-4', 'Algi', 'Algi Julian', 'XII', 'R1', 1, 'hs005', 'ps005', 'hs005.jpg', 'SR01', NULL, 'islam', 0, 'A'),
(6, 'XIITP', 'TP', '151610048', '12-248-006-3', 'Anas', 'Anas Aditya', 'XII', 'R1', 1, 'hs006', 'ps006', 'hs006.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(7, 'XIITP', 'TP', '151610049', '12-248-007-2', 'Andre', 'Andre Irawan', 'XII', 'R1', 1, 'hs007', 'ps007', 'hs007.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(8, 'XIITP', 'TP', '151610042', '12-248-008-9', 'Andrian', 'Andrian Al Viansyah', 'XII', 'R1', 1, 'hs008', 'ps008', 'hs008.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(9, 'XIITP', 'TP', '151610050', '12-248-009-8', 'Andrian', 'Andrian Maulana', 'XII', 'R1', 1, 'hs009', 'ps009', 'hs009.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(10, 'XIITP', 'TP', '151610051', '12-248-010-7', 'Bambang', 'Bambang Reza Umbara', 'XII', 'R1', 1, 'hs010', 'ps010', 'hs010.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(11, 'XIITP', 'TP', '151610052', '12-248-011-6', 'Ferdi', 'Ferdi Hasan', 'XII', 'R1', 1, 'hs011', 'ps011', 'hs011.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(12, 'XIITP', 'TP', '151610053', '12-248-012-5', 'Guntur', 'Guntur Adthia Bagaskara', 'XII', 'R1', 1, 'hs012', 'ps012', 'hs012.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(13, 'XIITP', 'TP', '151610055', '12-248-013-4', 'Harun', 'Harun Syahroji Iqmal', 'XII', 'R1', 2, 'hs013', 'ps013', 'hs013.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(14, 'XIITP', 'TP', '151610054', '12-248-014-3', 'Haryadi', 'Haryadi Sajali', 'XII', 'R1', 2, 'hs014', 'ps014', 'hs014.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(15, 'XIITP', 'TP', '151610057', '12-248-015-2', 'Ismail', 'Ismail', 'XII', 'R1', 2, 'hs015', 'ps015', 'hs015.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(16, 'XIITP', 'TP', '151610062', '12-248-016-9', 'Muchtar', 'Muchtar Gana', 'XII', 'R1', 2, 'hs016', 'ps016', 'hs016.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(17, 'XIITP', 'TP', '151610058', '12-248-017-8', 'Muhamad', 'Muhamad Abdul Rahman', 'XII', 'R1', 2, 'hs017', 'ps017', 'hs017.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(18, 'XIITP', 'TP', '151610063', '12-248-018-7', 'Muhamad', 'Muhamad Ali Hapijudin', 'XII', 'R1', 2, 'hs018', 'ps018', 'hs018.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(19, 'XIITP', 'TP', '151610065', '12-248-019-6', 'Muhamad', 'Muhamad Rizal', 'XII', 'R1', 2, 'hs019', 'ps019', 'hs019.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(20, 'XIITP', 'TP', '151610066', '12-248-020-5', 'Muhammad', 'Muhammad Niji Yuki Huda Sabillah', 'XII', 'R1', 2, 'hs020', 'ps020', 'hs020.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(21, 'XIITP', 'TP', '151610059', '12-248-021-4', 'Muhammad', 'Muhammad Ogi Prayoga S.', 'XII', 'R1', 2, 'hs021', 'ps021', 'hs021.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(22, 'XIITP', 'TP', '151610067', '12-248-022-3', 'Niko', 'Niko', 'XII', 'R1', 2, 'hs022', 'ps022', 'hs022.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(23, 'XIITP', 'TP', '151610068', '12-248-023-2', 'Rahma', 'Rahma Ahmada', 'XII', 'R1', 2, 'hs023', 'ps023', 'hs023.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(24, 'XIITP', 'TP', '151610070', '12-248-024-9', 'Renaldi', 'Renaldi', 'XII', 'R1', 2, 'hs024', 'ps024', 'hs024.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(25, 'XIITP', 'TP', '151610069', '12-248-025-8', 'Renaldi', 'Renaldi', 'XII', 'R1', 2, 'hs025', 'ps025', 'hs025.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(26, 'XIITP', 'TP', '151610072', '12-248-026-7', 'Rico', 'Rico Dwi Addrian Fattah', 'XII', 'R1', 2, 'hs026', 'ps026', 'hs026.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(27, 'XIITP', 'TP', '151610073', '12-248-027-6', 'Riki', 'Riki Riyanto', 'XII', 'R1', 2, 'hs027', 'ps027', 'hs027.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(28, 'XIITP', 'TP', '151610074', '12-248-028-5', 'Riki', 'Riki S', 'XII', 'R1', 2, 'hs028', 'ps028', 'hs028.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(29, 'XIITP', 'TP', '151610075', '12-248-029-4', 'Rudi', 'Rudi Hartono', 'XII', 'R1', 2, 'hs029', 'ps029', 'hs029.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(30, 'XIITP', 'TP', '151610076', '12-248-030-3', 'Saipul', 'Saipul Anwar', 'XII', 'R1', 3, 'hs030', 'ps030', 'hs030.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(31, 'XIITP', 'TP', '151610077', '12-248-031-2', 'Satya', 'Satya Pratama', 'XII', 'R1', 3, 'hs031', 'ps031', 'hs031.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(32, 'XIITP', 'TP', '151610078', '12-248-032-9', 'Sutrisno', 'Sutrisno', 'XII', 'R1', 3, 'hs032', 'ps032', 'hs032.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(33, 'XIITP', 'TP', '151610079', '12-248-033-8', 'Syarif', 'Syarif', 'XII', 'R1', 3, 'hs033', 'ps033', 'hs033.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(34, 'XIITP', 'TP', '151610081', '12-248-034-7', 'Yobi', 'Yobi Pratama', 'XII', 'R1', 3, 'hs034', 'ps034', 'hs034.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(35, 'XIITKR', 'TKR', '151610083', '12-248-035-6', 'Adittiya', 'Adittiya', 'XII', 'R1', 3, 'hs035', 'ps035', 'hs035.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(36, 'XIITKR', 'TKR', '151610084', '12-248-036-5', 'Aef', 'Aef saefullah EDK', 'XII', 'R1', 3, 'hs036', 'ps036', 'hs036.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(37, 'XIITKR', 'TKR', '151610085', '12-248-037-4', 'Ahmad', 'Ahmad', 'XII', 'R1', 3, 'hs037', 'ps037', 'hs037.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(38, 'XIITKR', 'TKR', '151610086', '12-248-038-3', 'Ahmad', 'Ahmad dani', 'XII', 'R1', 3, 'hs038', 'ps038', 'hs038.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(39, 'XIITKR', 'TKR', '151610089', '12-248-039-2', 'Amar', 'Amar', 'XII', 'R1', 3, 'hs039', 'ps039', 'hs039.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(40, 'XIITKR', 'TKR', '151610090', '12-248-040-9', 'Andi', 'Andi', 'XII', 'R1', 3, 'hs040', 'ps040', 'hs040.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(41, 'XIITKR', 'TKR', '151610091', '12-248-041-8', 'Anggi', 'Anggi Julian Purnama', 'XII', 'R1', 3, 'hs041', 'ps041', 'hs041.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(42, 'XIITKR', 'TKR', '151610092', '12-248-042-7', 'Ardiansyah', 'Ardiansyah', 'XII', 'R1', 3, 'hs042', 'ps042', 'hs042.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(43, 'XIITKR', 'TKR', '151610093', '12-248-043-6', 'Aryanto', 'Aryanto', 'XII', 'R1', 3, 'hs043', 'ps043', 'hs043.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(44, 'XIITKR', 'TKR', '151610094', '12-248-044-5', 'Awaludin', 'Awaludin', 'XII', 'R1', 3, 'hs044', 'ps044', 'hs044.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(45, 'XIITKR', 'TKR', '151610096', '12-248-045-4', 'Dede', 'Dede Ahmad Pauji', 'XII', 'R1', 3, 'hs045', 'ps045', 'hs045.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(46, 'XIITKR', 'TKR', '151610099', '12-248-046-3', 'Egi', 'Egi Ariansyah', 'XII', 'R1', 3, 'hs046', 'ps046', 'hs046.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(47, 'XIITKR', 'TKR', '151610100', '12-248-047-2', 'Erdin', 'Erdin', 'XII', 'R1', 3, 'hs047', 'ps047', 'hs047.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(48, 'XIITKR', 'TKR', '151610101', '12-248-048-9', 'Fajar', 'Fajar Ramadhan', 'XII', 'R1', 3, 'hs048', 'ps048', 'hs048.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(49, 'XIITKR', 'TKR', '151610102', '12-248-049-8', 'Fiky', 'Fiky Zulfikar', 'XII', 'R1', 3, 'hs049', 'ps049', 'hs049.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(50, 'XIITKR', 'TKR', '151610103', '12-248-050-7', 'Habibi', 'Habibi', 'XII', 'R1', 3, 'hs050', 'ps050', 'hs050.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(51, 'XIITKR', 'TKR', '151610104', '12-248-051-6', 'Handriyansyah', 'Handriyansyah Wijaya', 'XII', 'R1', 3, 'hs051', 'ps051', 'hs051.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(52, 'XIITKR', 'TKR', '151610128', '12-248-052-5', 'Herlangga', 'Herlangga Supardi', 'XII', 'R1', 3, 'hs052', 'ps052', 'hs052.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(53, 'XIITKR', 'TKR', '151610106', '12-248-053-4', 'Ibnu', 'Ibnu Mujahidin', 'XII', 'R1', 3, 'hs053', 'ps053', 'hs053.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(54, 'XIITKR', 'TKR', '151610107', '12-248-054-3', 'Kasan', 'Kasan Wijaya Kusuma', 'XII', 'R1', 3, 'hs054', 'ps054', 'hs054.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(55, 'XIITKR', 'TKR', '151610109', '12-248-055-2', 'Muhamad', 'Muhamad Aldi Ardiansyah', 'XII', 'R1', 3, 'hs055', 'ps055', 'hs055.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(56, 'XIITKR', 'TKR', '151610108', '12-248-056-9', 'Muhammad', 'Muhammad Sutrisno', 'XII', 'R1', 1, 'hs056', 'ps056', 'hs056.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(57, 'XIITKR', 'TKR', '151610110', '12-248-057-8', 'Muhammad', 'Muhammad Ramdan', 'XII', 'R1', 1, 'hs057', 'ps057', 'hs057.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(58, 'XIITKR', 'TKR', '151610111', '12-248-058-7', 'Nur', 'Nur Arifin', 'XII', 'R1', 1, 'hs058', 'ps058', 'hs058.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(59, 'XIITKR', 'TKR', '151610112', '12-248-059-6', 'Riyo', 'Riyo Wijaya', 'XII', 'R1', 1, 'hs059', 'ps059', 'hs059.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(60, 'XIITKR', 'TKR', '151610113', '12-248-060-5', 'Rizal', 'Rizal Maulana Aziz', 'XII', 'R1', 1, 'hs060', 'ps060', 'hs060.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(61, 'XIITKR', 'TKR', '151610114', '12-248-061-4', 'Robi', 'Robi Darwis', 'XII', 'R1', 1, 'hs061', 'ps061', 'hs061.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(62, 'XIITKR', 'TKR', '151610115', '12-248-062-3', 'Roni', 'Roni Sahroni', 'XII', 'R1', 1, 'hs062', 'ps062', 'hs062.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(63, 'XIITKR', 'TKR', '151610117', '12-248-063-2', 'Saemi', 'Saemi Al Rasyid', 'XII', 'R1', 1, 'hs063', 'ps063', 'hs063.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(64, 'XIITKR', 'TKR', '151610118', '12-248-064-9', 'Said', 'Said Abdullah', 'XII', 'R1', 1, 'hs064', 'ps064', 'hs064.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(65, 'XIITKR', 'TKR', '151610119', '12-248-065-8', 'Saripudin', 'Saripudin', 'XII', 'R1', 1, 'hs065', 'ps065', 'hs065.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(66, 'XIITKR', 'TKR', '151610123', '12-248-066-7', 'Ahmad', 'Ahmad Faisal', 'XII', 'R1', 1, 'hs066', 'ps066', 'hs066.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(67, 'XIITKR', 'TKR', '151610124', '12-248-067-6', 'Aksal', 'Aksal Sobari', 'XII', 'R1', 1, 'hs067', 'ps067', 'hs067.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(68, 'XIITKR', 'TKR', '151610125', '12-248-068-5', 'Alfian', 'Alfian', 'XII', 'R1', 1, 'hs068', 'ps068', 'hs068.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(69, 'XIITKR', 'TKR', '151610126', '12-248-069-4', 'Arsad', 'Arsad sopian', 'XII', 'R1', 1, 'hs069', 'ps069', 'hs069.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(70, 'XIITKR', 'TKR', '151610127', '12-248-070-3', 'Dede', 'Dede Maulana', 'XII', 'R1', 1, 'hs070', 'ps070', 'hs070.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(71, 'XIITKR', 'TKR', '151610129', '12-248-071-2', 'Junaedi', 'Junaedi', 'XII', 'R1', 1, 'hs071', 'ps071', 'hs071.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(72, 'XIITKR', 'TKR', '151610168', '12-248-072-9', 'Muhamad', 'Muhamad Fikri Fahmi Kurniadi', 'XII', 'R1', 1, 'hs072', 'ps072', 'hs072.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(73, 'XIITKR', 'TKR', '151610130', '12-248-073-8', 'Muhamad', 'Muhamad Kevin Fadli Fauzi', 'XII', 'R1', 2, 'hs073', 'ps073', 'hs073.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(74, 'XIITKR', 'TKR', '151610132', '12-248-074-7', 'Muhamad', 'Muhamad Rifki Saputra', 'XII', 'R1', 2, 'hs074', 'ps074', 'hs074.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(75, 'XIITKR', 'TKR', '151610133', '12-248-075-6', 'Padrul', 'Padrul Cahyadi', 'XII', 'R1', 2, 'hs075', 'ps075', 'hs075.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(76, 'XIITKR', 'TKR', '151610169', '12-248-076-5', 'Pentin', 'Pentin Alamsyah', 'XII', 'R1', 2, 'hs076', 'ps076', 'hs076.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(77, 'XIITKR', 'TKR', '151610134', '12-248-077-4', 'Sobri', 'Sobri Saputra', 'XII', 'R1', 2, 'hs077', 'ps077', 'hs077.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(78, 'XIITKR', 'TKR', '151610135', '12-248-078-3', 'Sukendar', 'Sukendar', 'XII', 'R1', 2, 'hs078', 'ps078', 'hs078.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(79, 'XIITKR', 'TKR', '151610120', '12-248-079-2', 'Teguh', 'Teguh Nur Sidik', 'XII', 'R1', 2, 'hs079', 'ps079', 'hs079.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(80, 'XIITKR', 'TKR', '151610136', '12-248-080-9', 'Tubagus', 'Tubagus M. Al-Fajri', 'XII', 'R1', 2, 'hs080', 'ps080', 'hs080.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(81, 'XIITKR', 'TKR', '151610166', '12-248-081-8', 'Wahyu', 'Wahyu Pratama', 'XII', 'R1', 2, 'hs081', 'ps081', 'hs081.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(82, 'XIITKR', 'TKR', '151610172', '12-248-082-7', 'Wahyudin', 'Wahyudin AZ.', 'XII', 'R1', 2, 'hs082', 'ps082', 'hs082.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(83, 'XIITKR', 'TKR', '151610138', '12-248-083-6', 'Wiro', 'Wiro Sugianto', 'XII', 'R1', 2, 'hs083', 'ps083', 'hs083.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(84, 'XIITKR', 'TKR', '151610121', '12-248-084-5', 'Yogi', 'Yogi Priyogo', 'XII', 'R1', 2, 'hs084', 'ps084', 'hs084.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(85, 'XIITKR', 'TKR', '151610139', '12-248-085-4', 'Yuda', 'Yuda Saputra', 'XII', 'R1', 2, 'hs085', 'ps085', 'hs085.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(86, 'XIITKR', 'TKR', '151610140', '12-248-086-3', 'Yuwanda', 'Yuwanda Musyaddir', 'XII', 'R1', 2, 'hs086', 'ps086', 'hs086.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(87, 'XIITKJ', 'TKJ', '151610001', '12-248-087-2', 'Anggi', 'Anggi Gian Sapitri', 'XII', 'R1', 2, 'hs087', 'ps087', 'hs087.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(88, 'XIITKJ', 'TKJ', '151610002', '12-248-088-9', 'Cindy', 'Cindy Apriana', 'XII', 'R1', 2, 'hs088', 'ps088', 'hs088.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(89, 'XIITKJ', 'TKJ', '151610003', '12-248-089-8', 'Dwi', 'Dwi Lestari', 'XII', 'R1', 2, 'hs089', 'ps089', 'hs089.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(90, 'XIITKJ', 'TKJ', '151610004', '12-248-090-7', 'Ebih', 'Ebih', 'XII', 'R1', 2, 'hs090', 'ps090', 'hs090.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(91, 'XIITKJ', 'TKJ', '151610005', '12-248-091-6', 'Elis', 'Elis Saeti Nuraeni', 'XII', 'R1', 3, 'hs091', 'ps091', 'hs091.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(92, 'XIITKJ', 'TKJ', '151610006', '12-248-092-5', 'Euis', 'Euis Susilawati', 'XII', 'R1', 3, 'hs092', 'ps092', 'hs092.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(93, 'XIITKJ', 'TKJ', '151610007', '12-248-093-4', 'Fahmi', 'Fahmi arni', 'XII', 'R1', 3, 'hs093', 'ps093', 'hs093.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(94, 'XIITKJ', 'TKJ', '151610008', '12-248-094-3', 'Fitri', 'Fitri Widiasari', 'XII', 'R1', 3, 'hs094', 'ps094', 'hs094.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(95, 'XIITKJ', 'TKJ', '151610009', '12-248-095-2', 'Gaby', 'Gaby Cantika Oktavia', 'XII', 'R1', 3, 'hs095', 'ps095', 'hs095.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(96, 'XIITKJ', 'TKJ', '151610010', '12-248-096-9', 'Haena', 'Haena Hermawati Yuningsih', 'XII', 'R1', 3, 'hs096', 'ps096', 'hs096.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(97, 'XIITKJ', 'TKJ', '151610011', '12-248-097-8', 'Karlina', 'Karlina', 'XII', 'R1', 3, 'hs097', 'ps097', 'hs097.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(98, 'XIITKJ', 'TKJ', '151610012', '12-248-098-7', 'Kurniawati', 'Kurniawati', 'XII', 'R1', 3, 'hs098', 'ps098', 'hs098.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(99, 'XIITKJ', 'TKJ', '151610013', '12-248-099-6', 'Ladina', 'Ladina al zannah chandra', 'XII', 'R1', 3, 'hs099', 'ps099', 'hs099.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(100, 'XIITKJ', 'TKJ', '151610014', '12-248-100-5', 'Laras', 'Laras Ayu Asmanih', 'XII', 'R1', 3, 'hs100', 'ps100', 'hs100.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(101, 'XIITKJ', 'TKJ', '151610015', '12-248-101-4', 'Lastri', 'Lastri Septriani', 'XII', 'R1', 3, 'hs101', 'ps101', 'hs101.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(102, 'XIITKJ', 'TKJ', '151610016', '12-248-102-3', 'Lisah', 'Lisah Fitri Kurnia', 'XII', 'R1', 3, 'hs102', 'ps102', 'hs102.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(103, 'XIITKJ', 'TKJ', '151610018', '12-248-103-2', 'Lutfi', 'Lutfi Wisti Nandasari', 'XII', 'R2', 3, 'hs103', 'ps103', 'hs103.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(104, 'XIITKJ', 'TKJ', '151610019', '12-248-104-9', 'Maya', 'Maya Karmanih', 'XII', 'R2', 3, 'hs104', 'ps104', 'hs104.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(105, 'XIITKJ', 'TKJ', '151610020', '12-248-105-8', 'Mayang', 'Mayang Sari', 'XII', 'R2', 3, 'hs105', 'ps105', 'hs105.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(106, 'XIITKJ', 'TKJ', '151610021', '12-248-106-7', 'Mayang', 'Mayang Sari Wati', 'XII', 'R2', 3, 'hs106', 'ps106', 'hs106.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(107, 'XIITKJ', 'TKJ', '151610022', '12-248-107-6', 'Megawati', 'Megawati', 'XII', 'R2', 1, 'hs107', 'ps107', 'hs107.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(108, 'XIITKJ', 'TKJ', '151610023', '12-248-108-5', 'Narsih', 'Narsih Agus Priyanti', 'XII', 'R2', 1, 'hs108', 'ps108', 'hs108.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(109, 'XIITKJ', 'TKJ', '151610024', '12-248-109-4', 'Nuraina', 'Nuraina', 'XII', 'R2', 1, 'hs109', 'ps109', 'hs109.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(110, 'XIITKJ', 'TKJ', '151610025', '12-248-110-3', 'Pita', 'Pita Kaputri', 'XII', 'R2', 1, 'hs110', 'ps110', 'hs110.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(111, 'XIITKJ', 'TKJ', '151610026', '12-248-111-2', 'Putri', 'Putri Ayu Lestari', 'XII', 'R2', 1, 'hs111', 'ps111', 'hs111.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(112, 'XIITKJ', 'TKJ', '151610027', '12-248-112-9', 'Putri', 'Putri Hagita', 'XII', 'R2', 1, 'hs112', 'ps112', 'hs112.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(113, 'XIITKJ', 'TKJ', '151610028', '12-248-113-8', 'Rasti', 'Rasti', 'XII', 'R2', 1, 'hs113', 'ps113', 'hs113.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(114, 'XIITKJ', 'TKJ', '151610029', '12-248-114-7', 'Rizky', 'Rizky Khofifah', 'XII', 'R2', 1, 'hs114', 'ps114', 'hs114.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(115, 'XIITKJ', 'TKJ', '151610030', '12-248-115-6', 'Sahroni', 'Sahroni', 'XII', 'R2', 1, 'hs115', 'ps115', 'hs115.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(116, 'XIITKJ', 'TKJ', '151610031', '12-248-116-5', 'Samah', 'Samah Maesaroh', 'XII', 'R2', 1, 'hs116', 'ps116', 'hs116.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(117, 'XIITKJ', 'TKJ', '151610032', '12-248-117-4', 'Sarmila', 'Sarmila Febyola Putri', 'XII', 'R2', 1, 'hs117', 'ps117', 'hs117.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(118, 'XIITKJ', 'TKJ', '151610033', '12-248-118-3', 'Silpi', 'Silpi Damayanti', 'XII', 'R2', 1, 'hs118', 'ps118', 'hs118.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(119, 'XIITKJ', 'TKJ', '151610034', '12-248-119-2', 'Siti', 'Siti Kartini', 'XII', 'R2', 1, 'hs119', 'ps119', 'hs119.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(120, 'XIITKJ', 'TKJ', '151610035', '12-248-120-9', 'Siti', 'Siti Masitoh', 'XII', 'R2', 1, 'hs120', 'ps120', 'hs120.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(121, 'XIITKJ', 'TKJ', '151610036', '12-248-121-8', 'Suci', 'Suci Selawati', 'XII', 'R2', 2, 'hs121', 'ps121', 'hs121.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(122, 'XIITKJ', 'TKJ', '151610037', '12-248-122-7', 'Tania', 'Tania Pratika', 'XII', 'R2', 2, 'hs122', 'ps122', 'hs122.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(123, 'XIITKJ', 'TKJ', '151610038', '12-248-123-6', 'Tarsimah', 'Tarsimah D.', 'XII', 'R2', 2, 'hs123', 'ps123', 'hs123.jpg', 'SR01', NULL, 'islam', 1, 'A'),
(124, 'XIITKJ', 'TKJ', '151610039', '12-248-124-5', 'Trisna', 'Trisna Shalamshah', 'XII', 'R2', 2, 'hs124', 'ps124', 'hs124.jpg', 'SR01', NULL, 'islam', 1, 'B'),
(125, 'XIITKJ', 'TKJ', '151610040', '12-248-125-4', 'Yoga', 'Yoga Maulana Atmaja', 'XII', 'R2', 2, 'hs125', 'ps125', 'hs125.jpg', 'SR01', NULL, 'islam', 1, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_susulan`
--

CREATE TABLE `siswa_susulan` (
  `suId` int(11) NOT NULL,
  `suIdSiswa` int(11) DEFAULT NULL COMMENT 'id siswa',
  `suKodeMapel` varchar(100) DEFAULT NULL COMMENT 'kode mata pelajaran',
  `suIdUjian` int(11) DEFAULT NULL COMMENT 'id ujian',
  `suNamaSiswa` varchar(255) DEFAULT NULL,
  `suNamaMapel` varchar(255) DEFAULT NULL,
  `suNamaUjian` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nomor` int(5) DEFAULT NULL,
  `soal` longblob DEFAULT NULL,
  `jenis` int(1) DEFAULT NULL,
  `pilA` longblob DEFAULT NULL,
  `pilB` longblob DEFAULT NULL,
  `pilC` longblob DEFAULT NULL,
  `pilD` longblob DEFAULT NULL,
  `pilE` longblob DEFAULT NULL,
  `jawaban` varchar(1) DEFAULT NULL,
  `file` longblob DEFAULT NULL,
  `file1` longblob DEFAULT NULL,
  `fileA` longblob DEFAULT NULL,
  `fileB` longblob DEFAULT NULL,
  `fileC` longblob DEFAULT NULL,
  `fileD` longblob DEFAULT NULL,
  `fileE` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_mapel`, `nomor`, `soal`, `jenis`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `jawaban`, `file`, `file1`, `fileA`, `fileB`, `fileC`, `fileD`, `fileE`) VALUES
(1, 1, 1, 0x426168616e2079616e67206265726173616c2064617269206b656b617961616e20616c616d2079616e67206164612064696461726174616e2064616e2064696c617574616e206164616c61682070656e6765727469616e2064617269202668656c6c69703b2e, 1, 0x426168616e20416c616d2020, 0x426168616e2042756174616e, 0x426168616e20416c616d2053656d65737461, 0x426168616e2042756174616e20416c616d, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(2, 1, 2, 0x426168616e20756e74756b206b61727961206b6572616a696e616e2079616e672064697065726f6c6568206461726920616c616d2073656b697461722064616e206d65727570616b616e2073756d626572206461796120616c616d206261696b20687574616e2c62756d692c6d617570756e20706572616972616e20496e646f6e6573696120206164616c61682070656e6765727469616e2064617269202668656c6c69703b2e2e, 1, 0x426168616e204b6572617320416c616d20, 0x426168616e204b657261732042756174616e, 0x426168616e20416c616d, 0x426168616e2042756174616e, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(3, 1, 3, 0x426168616e20756e74756b206b61727961206b6572616a696e616e2079616e672064696f6c61682064616e20646963616d7075722064656e67616e20626168616e2074657274656e747520736568696e676761206d656e6a616469206b657261732c64616e206d656d696c696b69207369666174206b7561742064616e20746168616e206c616d61206164616c61682070656e6765727469616e20646172692668656c6c69703b, 1, 0x412e426168616e204b6572617320416c616d, 0x422e426168616e204b657261732042756174616e20, 0x432e426168616e20416c616d, 0x442e426168616e2042756174616e, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(4, 1, 4, 0x4c6f67616d20626573692074697069732079616e672064696c61706973692074696d6168206164616c616820626168616e20756e74756b2070656d62756174616e2668656c6c69703b2e, 1, 0x4c6f67616d, 0x422e20, 0x4b616c656e6720, 0x4669626572676c617373, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', 0x31363138363432343636312e706e67, '', '', ''),
(5, 1, 5, 0x4b61636120746572627561742064617269202668656c6c69703b, 1, 0x50617369722073696c696b612064616e206f6b7369646120, 0x50617369722073696c696b612064616e206c6f67616d, 0x50617369722073696c696b612064616e206c6f67616d20, 0x50617369722073696c6963612064616e20706572616b, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(6, 1, 6, 0x50657262656461616e20616e79616d616e2077696c617961682043697265626f6e2064656e67616e20616e79616d616e2077696c61796168206b61707561732074657264617061742070616461202668656c6c69703b, 1, 0x7761726e612064616e2062656e74756b, 0x7761726e612c64616e20636f72616b20, 0x7761726e612064616e2064657369676e, 0x7761726e612c64616e2061727469, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(7, 1, 7, 0x50657275626168616e20266e646173683b70657275626168616e206566697369656e73692064616e207072616b7469732079616e67207465726a6164692073656d7561206b6172656e61206164616e7961202668656c6c69703b2e2e, 1, 0x5065726d696e7461616e206b6f6e73756d656e, 0x5065726d696e7461616e2070726f64756b7369, 0x5065726d696e7461616e20706173617220, 0x5065726d696e7461616e207377616c6179616e, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', '', '', '', ''),
(8, 1, 8, 0x5465686e696b2070656e6765726a61616e20736562756168206b6572616a696e616e20646970656e676172756869206f6c6568202668656c6c69703b2e2079616e6720646967756e616b61, 1, 0x42656e74756b, 0x416c617420, 0x536b65747361, 0x44657369676e, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(9, 1, 9, 0x42616e79616b6e79612062656e74752070726f64616b206b6572616a696e616e20746964616b206c657061732064617269206761676173616e206174617570756e20696465206d616e757369612079616e6720202020, 1, 0x6461706174206265726177616c20646172692073756174752070696b6972616e2064616e206b6568656e64616b206d656c616c75692074696e64616b206369707461206b617273612c6164616c61682070656e6765727469616e2064617269202668656c6c69703b, 0x5072696e736970206b6572616a696e616e20626168616e206b65726173, 0x4b65756e696b6b616e20626168616e206b6572616a696e616e20, 0x4b65726167616d616e204d756174616e206e696c61692064616c616d2070726f64756b206b6572616a696e616e20, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', '', '', '', ''),
(10, 1, 10, 0x47616d626172206469206261776168206b65726167616d616e206d756174616e206e696c61692064616c616d2070726f64616b206b6572616a696e616e207465726d6173756b2064616c616d2070726f64756b202668656c6c69703b2e203c62723e, 1, 0x79616e67206d656d696c696b69206e696c6169202668656c6c69703b2e2e, 0x46756e6773696f6e616c, 0x496e666f726d61746966, 0x507265737469676520, 0x426168616e2042756174616e20416c616d, 'C', NULL, 0x3136313836343234363631312e706e67, '', '', '', '', ''),
(11, 1, 11, 0x47616d626172206469206261776168206b65726167616d616e206d756174616e206e696c61692064616c616d2070726f64616b206b6572616a696e616e207465726d6173756b2064616c616d2070726f64756b2079616e67206d656d696c696b69206e696c6169202668656c6c69703b2e2e3c62723e, 1, 0x5072657374696765, 0x53696d626f6c696b20, 0x496e666f726d61746966, 0x46756e6773696f6e616c, 0x426168616e2042756174616e20416c616d, 'B', NULL, 0x31363138363432343636392e706e67, '', '', '', '', ''),
(12, 1, 12, 0x48616c2d68616c207465727365627574206164616c61682066616b746f722d66616b746f72207065726d6173616c6168616e206f6279656b74696620736562656c756d20706572616e63616e67616e2064616c616d2066616b746f72202668656c6c69703b2e3c62723e, 1, 0x46616b746f722054656b6e6973, 0x46616b746f7220456b6f6e6f6d697320, 0x46616b746f72204572676f6e6f6d6973, 0x46616b746f72204b6f6e64697369204c696e676b756e67616e, 0x426168616e2042756174616e20416c616d, 'B', NULL, 0x31363138363432343636372e706e67, '', '', '', '', ''),
(13, 1, 13, 0x48616c2d68616c20746572736562757420206164616c61682066616b746f722d66616b746f72207065726d6173616c6168616e206f6279656b74696620736562656c756d20706572616e63616e67616e2064616c616d2066616b746f72202668656c6c69703b2e3c62723e, 1, 0x46616b746f7220456b6f6e6f6d6973, 0x46616b746f72204572676f6e6f6d6973, 0x46616b746f72205361696e732064616e2054656b6e6f6c6f676920, 0x46616b746f72204573746574696b61, 0x426168616e2042756174616e20416c616d, 'C', NULL, 0x31363138363432343636342e706e67, '', '', '', '', ''),
(14, 1, 14, 0x44617269207065726e79617461616e206469617461732079616e67207465726d6173756b20636972692d6369726920526f74616e206164616c6168206e6f6d65722668656c6c69703b2e2e3c62723e, 1, 0x312c322c332c342c35, 0x312c322c332c352c36, 0x312c332c342c362c372020, 0x312c332c342c352c37, 0x426168616e2042756174616e20416c616d, 'C', NULL, 0x31363138363432343636322e706e67, '', '', '', '', ''),
(15, 1, 15, 0x44617269207065726e79617461616e206469206261776168206d65727570616b616e206369726920266e646173683b636972692064617269202668656c6c69703b2e3c62723e, 1, 0x4b61797520, 0x42616d6275, 0x506f686f6e, 0x526f74616e, 0x426168616e2042756174616e20416c616d, 'A', NULL, 0x3136313836343234363631322e706e67, '', '', '', '', ''),
(16, 1, 16, 0x4167617220746964616b206d75646168207465726b6f726f7369206f6c6568207564617261202c6d616b61206c6f67616d2064696c6170697369202668656c6c69703b2e2e, 1, 0x506572616b, 0x54696d6168, 0x54656d62616761, 0x4b726f6d20, 0x426168616e2042756174616e20416c616d, 'D', NULL, '', '', '', '', '', ''),
(17, 1, 17, 0x44617269207065726e79617461616e2079616e6720646973656275746b616e206d65727570616b616e20636972692d636972692064617269202668656c6c69703b2e2e3c62723e, 1, 0x4b617975, 0x4b61636120, 0x4669626572676c617373, 0x4c6f67616d, 0x426168616e2042756174616e20416c616d, 'B', NULL, 0x31363138363432343636382e706e67, '', '', '', '', ''),
(18, 1, 18, 0x446172692075726169616e2079616e6720646973656275746b616e206d65727570616b616e20636972692d636972692064617269202668656c6c69703b2e2e3c62723e, 1, 0x42616d6275, 0x4c6f67616d20, 0x4b617975, 0x4b616361, 0x426168616e2042756174616e20416c616d, 'B', NULL, 0x31363138363432343636362e706e67, '', '', '', '', ''),
(19, 1, 19, 0x4461657261682070656e67686173696c206b61797520686974616d206164616c61682668656c6c69703b2e, 1, 0x53756c61776573696e2054656e67616820, 0x53756c61776573692054656e6767617261, 0x53756d6174657261206261726174, 0x756d61746572612073656c6174616e, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(20, 1, 20, 0x4461657261682079616e67207465726b656e616c2064656e67616e20756b6972616e2064616e207061686174616e6e7961206164616c6168202668656c6c69703b2e2e, 1, 0x4a6570617261, 0x41636568, 0x5375726162617961, 0x556a756e672050616e64616e67, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(21, 1, 21, 0x48616c2079616e672064696c616b756b616e2064616c616d2050726f73657320206d656e67756b69722064616e206d656d61686174206164616c61682064656e67616e20636172612668656c6c69703b, 1, 0x4d656d6275617420756b6972616e2064616e206d656d61686174206b6179752064656e67616e2070656d756b756c, 0x4d656d62756174206761726973206f75746c696e652064616e206d656d61747269, 0x4d656d6275617420736b657473612064616e206d656d61686174206b6179752064656e67616e20616c617420706168617420, 0x4d656d627561742064657369676e2064616e206469756b6972, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', '', '', '', ''),
(22, 1, 22, 0x446172692067616d626172206469206261776168206d65727570616b616e2070726f64616b206b6572616a696e616e206461726920626168616e2064617361722668656c6c69703b3c62723e, 1, 0x42616d6275, 0x526f74616e, 0x4b61797520, 0x4b616361, 0x426168616e2042756174616e20416c616d, 'C', NULL, 0x31363138363432343636352e706e67, '', '', '', '', ''),
(23, 1, 23, 0x4d656d62756174206b6572616a696e616e206b6179752079616e672064696c616b756b616e2064656e67616e20626572206261676169207465686e696b20646c616d2062616861736120496e676772697320646973656275742668656c6c69703b, 1, 0x43726166746d616e73686970, 0x576f6f646372616674, 0x46696e697368696e67, 0x576f6f646372616674, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(24, 1, 24, 0x47616d626172206469206261776168206d65727570616b616e206a656e697320526167616d2068696173206461726920646165726168202668656c6c69703b2e2e3c62723e, 1, 0x4b616c696d616e74616e, 0x4d616b61736172, 0x5061707561, 0x53756c6177657369, 0x426168616e2042756174616e20416c616d, 'C', NULL, 0x31363138363432343636332e706e67, '', '', '', '', ''),
(25, 1, 25, 0x416c616d206d656d696c696b69206d616b6e612079616e67206d656e64616c616d2064656e67616e20736567616c612062656e74756b202c736966617420736572746120736567616c612079616e67207465726a61646920646964616c616d6e7961202070656e6765727469616e20526167616d20686961732064617269506164616e672079616e672064697365627574206a7567612668656c6c69703b2e, 1, 0x416c616d2074616b616d62616e67206a6164692067757275, 0x416c616d2074616b616d62616e67206a616469206d75726964, 0x416c616d2074616b616d62616e672073656d65737461, 0x416c616d2054616b616d62616e672062657273617564617261, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(26, 1, 26, 0x526167616d2068696173206d656d696c696b69206e616d612064616e206d616b6e612073696d626f6c6973206a696b61206469617274696b616e2073656d7561206d656c616d62616e676b616e206e696c61692d6e696c6169206275646179612064616c616d206b656869647570616e20776172676120746f72616a612079616e67206861727573206d656d6174756869206c6172616e67616e20616461742064616e206d656e63696e74616920616c616d2074656d7061742074696e6767616c2c7065726e79617461616e2074657273656275742063697269206b686173206461726920726167616d206869617320646165726168202668656c6c69703b2e2e, 1, 0x4a6570617261, 0x546f72616a6120, 0x5061707561, 0x4d696e6168617361, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(27, 1, 27, 0x4e65676172612079616e67206d656d62756469646179616b616e2042616d6275206461726920646168756c75206164616c6168202668656c6c69703b2e, 1, 0x496e6469612c2042616e676c61646573682c20496e646f6e65736961, 0x496e6469612c20496e646f6e657369612c204a6570616e67, 0x4b6f7265612c20496e6469612c2042616e676c61646568, 0x42616e676c61646573682c20496e6469612c20566965746e616d, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(28, 1, 28, 0x497374696c6168204162756c6c6f205369626174616e6720706164612074616e616d616e2042616d6275206d656d696c696b6920617274692668656c6c69703b2e, 1, 0x4b6573617475616e, 0x4b6562657273616d61616e, 0x476f746f6e6720726f796f6e67, 0x50657273617475616e, 0x426168616e2042756174616e20416c616d, 'D', NULL, '', '', '', '', '', ''),
(29, 1, 29, 0x42616d62752064617061742064696a6164696b616e2062657262616761692070726f64756b206b6572616a696e616e2079616e67206265726e696c616920657374657469732064616e20656b6f6e6f6d692074696e676769202c6469616e74617261206a656e69732062616d62752079616e672062756b616e206a656e69732062616d62752079616e67206d656d696c696b6920657374657469732064616e20656b6f6e6f6d692074696e676769206164616c61682668656c6c69703b, 1, 0x42616d62752043656e64616e61, 0x42616d627520416e646f6e67, 0x42616d62752043656e676b6f726568, 0x42616d62752045727520, 0x426168616e2042756174616e20416c616d, 'D', NULL, '', '', '', '', '', ''),
(30, 1, 30, 0x59616e672062756b616e206d65727570616b616e2063617261206d656d696c69682062616d62752079616e67206261696b20756e74756b20646967756e616b6b616e206164616c61682668656c6c69703b2e, 1, 0x50696c69682062616d62752079616e6720746964616b207465726c616c75206d7564612f746964616b207465726c616c7520747561, 0x53696d70616e20646974656d7061742079616e672073656a696b2064616e206d6972696e676b616e2062616d62752068696e67676120382d31302068617269, 0x50696c69686c61682062616d62752079616e67206d656d696c696b6920727561732070616e6a616e672061676172206d7564616820646962656e74756b206b6572616a696e616e206170612073616a61, 0x536574656c6168206469746562616e67202c6c616c7520706f746f6e6720736570616e6a616e672032206174617520332072756173, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(31, 1, 31, 0x53756c61776573692064616e204b616c696d616e74616e206d65727570616b616820646165726168207465626573617220646920496e646f6e657369612079616e67206d656e67686173696c6b616e202668656c6c69703b2e, 1, 0x526f74616e20, 0x42616d6275, 0x4b617975, 0x4c6f67616d, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(32, 1, 32, 0x53656a656e69732074616e616d616e2070616c6d2079616e67206d6572616d6261742064616e2064617061742074756d627568206d656e63617061692070616e6a616e6720313030206d206c656269682064697365627574202668656c6c69703b2e, 1, 0x4b617975, 0x42616d6275, 0x4c6f67616d, 0x526f74616e20, 0x426168616e2042756174616e20416c616d, 'D', NULL, '', '', '', '', '', ''),
(33, 1, 33, 0x426167696e2064616c616d20726f74616e2061706162696c6120646962656c61686120616b616e206d656e67686173696c6b616e2074616c6920726f74616e2079616e672074697069732079616e6720646973656275742668656c6c69703b2e, 1, 0x4b75706173616e, 0x50656c6c, 0x46697472696b2f70657472696b, 0x416e79616d616e, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', '', '', '', ''),
(34, 1, 34, 0x59616e672062756b616e207761726e61206b68617320726f74616e206164616c6168202668656c6c69703b2e, 1, 0x5075746968206b656b756e696e67616e, 0x436f6b656c6174, 0x4d65726168206261746120, 0x486974616d20, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(35, 1, 35, 0x526f74616e206b75706173616e206b756c6974206c7561722064616c616d2062616769616e2062616d62752062657266756e6773692073656261676169202668656c6c69703b2e, 1, 0x50656e67696b61742064616e20626168616e20616e79616d616e20, 0x50656e67686961732070616461206b6572616a696e616e, 0x49736920726f74616e, 0x4d656c656e7475726b616e20726f74616e, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(36, 1, 36, 0x4d656d62656e74756b2070726f64616b20736573756169206465736169676e2064616c616d2070726f736573207461686170616e2070656d62756174616e20616e79616d616e20726f74616e207465726d616173756b2064616c616d207461686170616e202668656c6c69703b2e, 1, 0x50656d62756174616e206b6572616e676b61, 0x50656e67616e79616d616e, 0x50656e6765636174616e, 0x46696e697368696e67, 0x426168616e2042756174616e20416c616d, 'B', NULL, '', '', '', '', '', ''),
(37, 1, 37, 0x59616e672062756b616e20205761726e61206761726973206f75746c696e6520706164616c756b6973206b6163612061746175206c756b6973207061747269206164616c6168202668656c6c69703b2e, 1, 0x4d6572616820, 0x486974616d, 0x506572616b, 0x456d6173, 0x426168616e2042756174616e20416c616d, 'A', NULL, '', '', '', '', '', ''),
(38, 1, 38, 0x2054756a75616e2064617269204c756b6973206b616361206164616c61682668656c6c69703b2e, 1, 0x4d656d696c696b69206e696c6169206a75616c2074696e676769, 0x42616e79616b2070656d696e61746e7961, 0x4d656d706572696e646168207275616e67616e20, 0x4d75646168206d656d627561746e7961, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', '', '', '', ''),
(39, 1, 39, 0x55727574616e20636172612070656d62756174616e2077616461682f6b616c656e67206b65727570756b2079616e67207465706174206164616c6168202668656c6c69703b2e3c62723e, 1, 0x312c322c332c342c352c36, 0x312c322c332c342c362c3520, 0x312c322c332c352c342c36, 0x312c332c322c342c352c36, 0x426168616e2042756174616e20416c616d, 'B', NULL, 0x3136313836343234363631302e706e67, '', '', '', '', ''),
(40, 1, 40, 0x4d656c696e64756e67692070726f64616b2064617269206375616361202c67756e63616e67616e2064616e2062656e747572616e20266e646173683b62656e747572616e2074657268616461702062656e6461206c61696e206164616c61682074756a75616e2064617269202668656c6c69703b, 1, 0x526167616d2068696173, 0x50726f64616b206b6572616a696e616e, 0x4b656d6173616e20, 0x42656e74756b204b6572616a696e616e, 0x426168616e2042756174616e20416c616d, 'C', NULL, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `thId` int(11) NOT NULL COMMENT 'id tahun',
  `thKode` varchar(50) DEFAULT NULL,
  `thNama` varchar(50) DEFAULT NULL,
  `thAktif` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`thId`, `thKode`, `thNama`, `thAktif`) VALUES
(1, '2020', '2020', 0),
(2, '2021', '2021', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_block`
--

CREATE TABLE `tb_block` (
  `id_block` int(11) NOT NULL,
  `judul_block` varchar(50) DEFAULT NULL,
  `isi_block` varchar(100) DEFAULT NULL,
  `footer_block` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_block`
--

INSERT INTO `tb_block` (`id_block`, `judul_block`, `isi_block`, `footer_block`) VALUES
(1, 'Upssss !!!', 'Kamu di Block Karna Cantik @mryes', 'Segera Hubungi  @youngkq');

-- --------------------------------------------------------

--
-- Struktur dari tabel `telegram_bot`
--

CREATE TABLE `telegram_bot` (
  `tlId` int(11) NOT NULL COMMENT 'id telegram',
  `tlIdBotTelegram` int(11) DEFAULT NULL COMMENT 'ID Bot Telegram',
  `tlChatId` varchar(255) DEFAULT NULL COMMENT 'Id Chat Grub Telegram',
  `tlNama` varchar(100) DEFAULT NULL,
  `tlKode` varchar(10) DEFAULT NULL COMMENT 'kode telegram untuk tabel ini',
  `tlIdGuru` int(11) DEFAULT NULL COMMENT 'id guru',
  `tlCreat_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tlKelas` varchar(255) DEFAULT NULL,
  `tlLevel` varchar(20) DEFAULT NULL,
  `tlActive` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `telegram_bot`
--

INSERT INTO `telegram_bot` (`tlId`, `tlIdBotTelegram`, `tlChatId`, `tlNama`, `tlKode`, `tlIdGuru`, `tlCreat_at`, `tlKelas`, `tlLevel`, `tlActive`) VALUES
(1, 1, '966191338', NULL, NULL, 255, '2020-08-05 09:48:59', NULL, NULL, 1),
(10, 1, '0', NULL, NULL, 257, '2021-03-27 07:33:39', NULL, NULL, 1),
(11, 1, '0', NULL, NULL, 1, '2021-03-27 07:33:54', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `masa_berlaku` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`id_token`, `token`, `time`, `masa_berlaku`) VALUES
(1, 'NKEVDC', '2021-03-12 17:34:07', '00:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `total_sekolah_sinkron`
--

CREATE TABLE `total_sekolah_sinkron` (
  `tssId` int(11) NOT NULL,
  `tssKode` varchar(20) DEFAULT NULL COMMENT 'kode sekolah',
  `tssNama` varchar(255) DEFAULT NULL COMMENT 'nama sekolah',
  `tssKepalaSekolah` varchar(255) DEFAULT NULL,
  `tssOpretator` varchar(255) DEFAULT NULL,
  `tssCreatedBy` timestamp NOT NULL DEFAULT current_timestamp(),
  `tssDateSinkron` datetime DEFAULT NULL COMMENT 'tanggal sinkron',
  `tssNamaSinkron` varchar(100) DEFAULT NULL COMMENT 'nama yg di sinkron',
  `tssJmlDataOk` varchar(50) DEFAULT NULL COMMENT 'jumlah data berhasil di snkron',
  `tssJmlDataNo` varchar(50) DEFAULT NULL COMMENT 'jumlah data gagal di sinkron'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `kelas` text DEFAULT NULL,
  `mapel` varchar(255) DEFAULT '0',
  `judul` varchar(50) DEFAULT '0',
  `tugas` longblob DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT 1,
  `kode_level` varchar(20) DEFAULT NULL,
  `tugas_siswa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_guru`, `kelas`, `mapel`, `judul`, `tugas`, `file`, `tgl_mulai`, `tgl_selesai`, `tgl`, `status`, `kode_level`, `tugas_siswa`) VALUES
(1, 1, 'a:1:{i:0;s:5:\"XIITP\";}', 'BAHASA INDONESIA', 'BAHASA INDONESIA', 0x3c703e42616861736120496e646f6e657369613c62723e3c2f703e, NULL, '2021-03-27 13:00:00', '2021-03-27 23:00:00', '2021-03-27 07:36:40', 1, 'XII', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL COMMENT 'ID Ujian',
  `id_pk` varchar(10) NOT NULL COMMENT 'ID Jurusan',
  `id_guru` int(5) NOT NULL COMMENT 'ID Guru Mapel',
  `id_mapel` int(5) NOT NULL COMMENT 'ID Mata Pelajaran',
  `kode_ujian` varchar(100) DEFAULT NULL COMMENT 'Kode Ujian',
  `KodeMataPelajaran` varchar(100) DEFAULT NULL COMMENT 'kode mata pelajaran',
  `nama` varchar(100) NOT NULL COMMENT 'Kode Mapel / Bank Soal',
  `slagNama` varchar(100) DEFAULT NULL COMMENT 'Nama Mata Pelajaran',
  `jml_soal` int(5) NOT NULL,
  `jml_esai` int(5) NOT NULL,
  `bobot_pg` int(5) NOT NULL,
  `opsi` int(1) NOT NULL,
  `bobot_esai` int(5) NOT NULL,
  `tampil_pg` int(5) NOT NULL,
  `tampil_esai` int(5) NOT NULL,
  `lama_ujian` int(5) NOT NULL,
  `tgl_ujian` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `waktu_ujian` time DEFAULT NULL,
  `selesai_ujian` time DEFAULT NULL,
  `level` varchar(5) NOT NULL,
  `kelas` longtext NOT NULL,
  `siswa` longtext DEFAULT NULL,
  `sesi` varchar(10) DEFAULT NULL,
  `acak` int(1) NOT NULL,
  `token` int(1) NOT NULL,
  `status` int(1) DEFAULT 0,
  `hasil` int(1) DEFAULT NULL,
  `kkm` int(10) DEFAULT NULL,
  `ulang` int(2) DEFAULT NULL,
  `tombol_selsai` int(1) DEFAULT 0,
  `acak_opsi` int(1) DEFAULT NULL,
  `history` int(1) DEFAULT 0,
  `status_reset` int(1) DEFAULT 0,
  `jenisSoalUjian` int(1) NOT NULL COMMENT '1 PG, 2 EAI, 3 PG ESAI',
  `soalAgama` int(1) DEFAULT 0 COMMENT 'jenis soal agama',
  `soalAgamaList` varchar(100) DEFAULT 'umum' COMMENT 'list soal agama',
  `soalPaket` varchar(10) DEFAULT 'A' COMMENT 'paket soal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`absId`),
  ADD KEY `absIdSiswa` (`absIdSiswa`),
  ADD KEY `absIdKelas` (`absIdKelas`);

--
-- Indeks untuk tabel `absensi_mapel`
--
ALTER TABLE `absensi_mapel`
  ADD PRIMARY KEY (`amId`),
  ADD KEY `absensi_mapel_ibfk_1` (`amIdGuru`),
  ADD KEY `absensi_mapel_ibfk_3` (`amKelas`),
  ADD KEY `amIdMapel` (`amIdMapel`);

--
-- Indeks untuk tabel `absensi_mapel_anggota`
--
ALTER TABLE `absensi_mapel_anggota`
  ADD PRIMARY KEY (`amaId`),
  ADD KEY `absensi_mapel_anggota_ibfk_1` (`amaIdAbsenMapel`),
  ADD KEY `absensi_mapel_anggota_ibfk_2` (`amaIdSiswa`),
  ADD KEY `absensi_mapel_anggota_ibfk_3` (`amaIdKelas`),
  ADD KEY `absensi_mapel_anggota_ibfk_4` (`amaIdMapel`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `bot_telegram`
--
ALTER TABLE `bot_telegram`
  ADD PRIMARY KEY (`botId`);

--
-- Indeks untuk tabel `dapodik`
--
ALTER TABLE `dapodik`
  ADD PRIMARY KEY (`dpId`);

--
-- Indeks untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `jam_skl`
--
ALTER TABLE `jam_skl`
  ADD PRIMARY KEY (`jmId`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_siswa` (`id_siswa`,`id_mapel`,`id_soal`,`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indeks untuk tabel `jawaban_copy`
--
ALTER TABLE `jawaban_copy`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idkls`),
  ADD UNIQUE KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_pk` (`id_pk`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`idlevel`),
  ADD UNIQUE KEY `kode_level` (`kode_level`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `idguru` (`idguru`),
  ADD KEY `idguru_2` (`idguru`),
  ADD KEY `KodeMapel` (`KodeMapel`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`idmapel`),
  ADD UNIQUE KEY `kode_mapel` (`kode_mapel`),
  ADD KEY `id_level` (`kode_level`);

--
-- Indeks untuk tabel `materi2`
--
ALTER TABLE `materi2`
  ADD PRIMARY KEY (`materi2_id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `materi2_ibfk_2` (`materi2_mapel`);

--
-- Indeks untuk tabel `materi_view`
--
ALTER TABLE `materi_view`
  ADD PRIMARY KEY (`mtrViewId`),
  ADD KEY `mtrViewIdSiswa` (`mtrViewIdSiswa`),
  ADD KEY `mtrViewIdMateri` (`mtrViewIdMateri`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `nilai_pindah`
--
ALTER TABLE `nilai_pindah`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `pengacak`
--
ALTER TABLE `pengacak`
  ADD PRIMARY KEY (`id_pengacak`);

--
-- Indeks untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`id_pengawas`),
  ADD KEY `id_kls` (`id_kls`),
  ADD KEY `id_jrs` (`id_jrs`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `user` (`user`);

--
-- Indeks untuk tabel `pk`
--
ALTER TABLE `pk`
  ADD PRIMARY KEY (`idpk`),
  ADD UNIQUE KEY `id_pk` (`id_pk`);

--
-- Indeks untuk tabel `referensi_jurusan`
--
ALTER TABLE `referensi_jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indeks untuk tabel `savsoft_options`
--
ALTER TABLE `savsoft_options`
  ADD PRIMARY KEY (`oid`);

--
-- Indeks untuk tabel `savsoft_qbank`
--
ALTER TABLE `savsoft_qbank`
  ADD PRIMARY KEY (`qid`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indeks untuk tabel `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`kode_sesi`);

--
-- Indeks untuk tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `sinkron`
--
ALTER TABLE `sinkron`
  ADD PRIMARY KEY (`id_singkron`,`nama_data`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `siswa_susulan`
--
ALTER TABLE `siswa_susulan`
  ADD PRIMARY KEY (`suId`),
  ADD KEY `suIdSiswa` (`suIdSiswa`),
  ADD KEY `suIdUjian` (`suIdUjian`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`thId`);

--
-- Indeks untuk tabel `tb_block`
--
ALTER TABLE `tb_block`
  ADD PRIMARY KEY (`id_block`);

--
-- Indeks untuk tabel `telegram_bot`
--
ALTER TABLE `telegram_bot`
  ADD PRIMARY KEY (`tlId`),
  ADD KEY `telegram_bot_ibfk_1` (`tlIdGuru`),
  ADD KEY `tlIdBotTelelgram` (`tlIdBotTelegram`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `total_sekolah_sinkron`
--
ALTER TABLE `total_sekolah_sinkron`
  ADD PRIMARY KEY (`tssId`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `nama` (`nama`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id absen', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `absensi_mapel`
--
ALTER TABLE `absensi_mapel`
  MODIFY `amId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id absen mapel', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `absensi_mapel_anggota`
--
ALTER TABLE `absensi_mapel_anggota`
  MODIFY `amaId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id absen anggota mapel', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bot_telegram`
--
ALTER TABLE `bot_telegram`
  MODIFY `botId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dapodik`
--
ALTER TABLE `dapodik`
  MODIFY `dpId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `jam_skl`
--
ALTER TABLE `jam_skl`
  MODIFY `jmId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id jam sekolah', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `jawaban_copy`
--
ALTER TABLE `jawaban_copy`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idkls` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `idlevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `idmapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `materi2`
--
ALTER TABLE `materi2`
  MODIFY `materi2_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `materi_view`
--
ALTER TABLE `materi_view`
  MODIFY `mtrViewId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id materi view', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `nilai_pindah`
--
ALTER TABLE `nilai_pindah`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pengacak`
--
ALTER TABLE `pengacak`
  MODIFY `id_pengacak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id_pengawas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pk`
--
ALTER TABLE `pk`
  MODIFY `idpk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `savsoft_options`
--
ALTER TABLE `savsoft_options`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `savsoft_qbank`
--
ALTER TABLE `savsoft_qbank`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sinkron`
--
ALTER TABLE `sinkron`
  MODIFY `id_singkron` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `siswa_susulan`
--
ALTER TABLE `siswa_susulan`
  MODIFY `suId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tahun`
--
ALTER TABLE `tahun`
  MODIFY `thId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tahun', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_block`
--
ALTER TABLE `tb_block`
  MODIFY `id_block` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `telegram_bot`
--
ALTER TABLE `telegram_bot`
  MODIFY `tlId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id telegram', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `total_sekolah_sinkron`
--
ALTER TABLE `total_sekolah_sinkron`
  MODIFY `tssId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Ujian', AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`absIdSiswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`absIdKelas`) REFERENCES `kelas` (`idkls`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `absensi_mapel`
--
ALTER TABLE `absensi_mapel`
  ADD CONSTRAINT `absensi_mapel_ibfk_1` FOREIGN KEY (`amIdGuru`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_mapel_ibfk_3` FOREIGN KEY (`amKelas`) REFERENCES `kelas` (`idkls`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_mapel_ibfk_4` FOREIGN KEY (`amIdMapel`) REFERENCES `mata_pelajaran` (`idmapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `absensi_mapel_anggota`
--
ALTER TABLE `absensi_mapel_anggota`
  ADD CONSTRAINT `absensi_mapel_anggota_ibfk_1` FOREIGN KEY (`amaIdAbsenMapel`) REFERENCES `absensi_mapel` (`amId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_mapel_anggota_ibfk_2` FOREIGN KEY (`amaIdSiswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_mapel_anggota_ibfk_3` FOREIGN KEY (`amaIdKelas`) REFERENCES `kelas` (`idkls`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_mapel_anggota_ibfk_4` FOREIGN KEY (`amaIdMapel`) REFERENCES `mata_pelajaran` (`idmapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_4` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD CONSTRAINT `jawaban_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_tugas_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_tugas_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `pengawas` (`id_pengawas`);

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`idguru`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mapel_ibfk_2` FOREIGN KEY (`KodeMapel`) REFERENCES `mata_pelajaran` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi2`
--
ALTER TABLE `materi2`
  ADD CONSTRAINT `materi2_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi2_ibfk_2` FOREIGN KEY (`materi2_mapel`) REFERENCES `mata_pelajaran` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi_view`
--
ALTER TABLE `materi_view`
  ADD CONSTRAINT `materi_view_ibfk_1` FOREIGN KEY (`mtrViewIdSiswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_view_ibfk_2` FOREIGN KEY (`mtrViewIdMateri`) REFERENCES `materi2` (`materi2_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_pindah`
--
ALTER TABLE `nilai_pindah`
  ADD CONSTRAINT `nilai_pindah_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_pindah_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_pindah_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`user`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa_susulan`
--
ALTER TABLE `siswa_susulan`
  ADD CONSTRAINT `siswa_susulan_ibfk_1` FOREIGN KEY (`suIdSiswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_susulan_ibfk_2` FOREIGN KEY (`suIdUjian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `telegram_bot`
--
ALTER TABLE `telegram_bot`
  ADD CONSTRAINT `telegram_bot_ibfk_1` FOREIGN KEY (`tlIdGuru`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `telegram_bot_ibfk_2` FOREIGN KEY (`tlIdBotTelegram`) REFERENCES `bot_telegram` (`botId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `pengawas` (`id_pengawas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`nama`) REFERENCES `mapel` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
