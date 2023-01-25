-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2023 pada 17.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_legislasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `legislasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tahapan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `legislasi_id`, `judul`, `deskripsi`, `tahapan_id`, `created_at`, `updated_at`) VALUES
(23, 13, 'RUU Usulan Komisi/Anggota/Badan Legislasi', 'Penyusunan RUU tentang Perubahan Kedua UU No 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-Undangan', 1, '2023-01-12 01:47:58', '2023-01-12 01:47:58'),
(24, 13, 'Penetapan Usul DPR', 'Pengambilan Keputusan hasil penyusunan RUU tentang Perubahan kedua atas UU Nomor 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-undangan menjadi Usul DPR RI', 1, '2023-01-12 01:51:02', '2023-01-12 01:51:02'),
(25, 13, 'Pembicaraan Tingkat I', 'Raker dengan MENKO POLHUKAM, MENKO PERKONOMIAN dan MENKUMHAM dalam rangka Pembahasan RUU tentang Perubahan Kedua atas UU Nomor 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-Undangan', 2, '2023-01-12 01:52:29', '2023-01-12 01:52:29'),
(26, 14, 'Perancangan 001', 'Kita lagi merancang', 2, '2023-01-16 08:53:24', '2023-01-16 08:53:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda_file`
--

CREATE TABLE `agenda_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `legislasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `agenda_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agenda_file`
--

INSERT INTO `agenda_file` (`id`, `legislasi_id`, `agenda_id`, `name`, `keterangan`, `created_at`, `updated_at`) VALUES
(17, 13, 23, 'laporan-1673488078.pdf', 'ket', '2023-01-12 01:47:59', '2023-01-12 01:47:59'),
(18, 13, 24, 'laporan-3-1673488262.pdf', 'ket', '2023-01-12 01:51:02', '2023-01-12 01:51:02'),
(19, 13, 25, 'laporan-4-1673488349.pdf', 'ket', '2023-01-12 01:52:29', '2023-01-12 01:52:29'),
(20, 14, 26, 'laporan-5-1673859204.pdf', 'sdad', '2023-01-16 08:53:24', '2023-01-16 08:53:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_buat` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nik` int(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `kabupaten` bigint(20) UNSIGNED DEFAULT NULL,
  `kecamatan` bigint(20) UNSIGNED DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `aspirasi` varchar(255) DEFAULT NULL,
  `komisi` varchar(255) DEFAULT NULL,
  `isu` varchar(255) DEFAULT NULL,
  `urusan` varchar(255) DEFAULT NULL,
  `skpd` bigint(255) DEFAULT NULL,
  `anggaran` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `sasaran` varchar(255) DEFAULT NULL,
  `dewan` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aspirasi`
--

INSERT INTO `aspirasi` (`id`, `tgl_buat`, `user_id`, `nik`, `name`, `telp`, `kabupaten`, `kecamatan`, `alamat`, `aspirasi`, `komisi`, `isu`, `urusan`, `skpd`, `anggaran`, `lampiran`, `sasaran`, `dewan`, `created_at`, `updated_at`) VALUES
(7, '2023-01-24', 30, 2147483647, 'Dsfsdfsfasfdd', '234234324325', 136, 1576, 'ewrewrwer', 'werrrrr', 'ewrrrrrr', 'ewrwerwer', 'werwerwerwerewr', 2, '3242343242343234', 'aspirasi-1674566215.sql', '3242323', 1, '2023-01-24 13:16:55', '2023-01-24 13:16:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `legislasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`id`, `parent_id`, `legislasi_id`, `user_id`, `name`, `email`, `comment`, `nik`, `telp`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 13, 21, 'hendrimusta', 'hendrimusta8832@gmail.com', '3242342343223432', '2332423432423324324234', 'asdsda343434', '1', '2023-01-12 06:58:06', '2023-01-12 06:58:06'),
(2, 0, 13, 23, '32424', '323wqewwqew2@gmail.com', 'wqewq', '2333', '323232', '1', '2023-01-14 09:46:11', '2023-01-14 09:46:11'),
(3, 0, 13, 23, '32424', '323wqewwqew2@gmail.com', 'wqewq', '2333', '323232', '1', '2023-01-14 09:46:21', '2023-01-14 09:46:21'),
(4, 0, 13, 23, '32424', '323wqewwqew2@gmail.com', 'wqewq', '2333', '323232', '1', '2023-01-14 09:46:26', '2023-01-14 09:46:26'),
(5, 0, 13, 23, '32424', '323wqewwqew2@gmail.com', 'wqewq', '2333', '323232', '1', '2023-01-14 09:46:29', '2023-01-14 09:46:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dewan`
--

CREATE TABLE `dewan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dewan`
--

INSERT INTO `dewan` (`id`, `name`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Dewan A', 'deskripsi', '2023-01-06 05:11:59', '2023-01-06 05:11:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_aspirasi`
--

CREATE TABLE `form_aspirasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `form_aspirasi`
--

INSERT INTO `form_aspirasi` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'nik', 1, NULL, '2023-01-24 13:13:56'),
(3, 'name', 1, NULL, NULL),
(4, 'telp', 1, NULL, NULL),
(5, 'kabupaten', 1, NULL, NULL),
(6, 'kecamatan', 1, NULL, NULL),
(7, 'alamat', 1, NULL, NULL),
(8, 'aspirasi', 1, NULL, NULL),
(9, 'komisi', 1, NULL, NULL),
(10, 'isu', 1, NULL, NULL),
(11, 'urusan', 1, NULL, NULL),
(12, 'skpd', 1, NULL, NULL),
(13, 'anggaran', 1, NULL, NULL),
(14, 'lampiran', 1, NULL, NULL),
(15, 'sasaran', 1, NULL, NULL),
(16, 'dewan', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varbinary(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `name`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 0x53757065722041646d696e, 'Super Admin (FULL AKSES)', '2023-01-06 05:30:43', '2023-01-06 05:30:43'),
(3, 0x5761726761, 'warga', '2023-01-12 02:30:29', '2023-01-12 02:30:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_user`
--

CREATE TABLE `jabatan_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan_user`
--

INSERT INTO `jabatan_user` (`id`, `jabatan_id`, `user_id`) VALUES
(3, 2, 1),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `provinsi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `name`, `provinsi_id`, `created_at`, `updated_at`) VALUES
(123, 'LAMPUNG UTARA', 8, NULL, NULL),
(124, 'WAY KANAN', 8, NULL, NULL),
(125, 'LAMPUNG TENGAH', 8, NULL, NULL),
(126, 'MESUJI', 8, NULL, NULL),
(127, 'PRINGSEWU', 8, NULL, NULL),
(128, 'LAMPUNG TIMUR', 8, NULL, NULL),
(129, 'LAMPUNG SELATAN', 8, NULL, NULL),
(130, 'TULANG BAWANG', 8, NULL, NULL),
(131, 'TULANG BAWANG BARAT', 8, NULL, NULL),
(132, 'TANGGAMUS', 8, NULL, NULL),
(133, 'LAMPUNG BARAT', 8, NULL, NULL),
(134, 'PESISIR BARAT', 8, NULL, NULL),
(135, 'PESAWARAN', 8, NULL, NULL),
(136, 'BANDAR LAMPUNG', 8, NULL, NULL),
(137, 'METRO', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoriranperda`
--

CREATE TABLE `kategoriranperda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategoriranperda`
--

INSERT INTO `kategoriranperda` (`id`, `name`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'Kategori Ranperda A', 'Deskripsi kategori ranperda A', '2023-01-05 10:54:42', '2023-01-05 10:54:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `kabupaten_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `name`, `kabupaten_id`, `created_at`, `updated_at`) VALUES
(1574, 'ULUBELU', 132, NULL, NULL),
(1575, 'PULAU PANGGUNG', 132, NULL, NULL),
(1576, 'AIR NANINGAN', 132, NULL, NULL),
(1583, 'LIMAU', 132, NULL, NULL),
(1586, 'SUMBEREJO', 132, NULL, NULL),
(1590, 'BANDAR NEGERI SEMUONG', 132, NULL, NULL),
(1592, 'PUGUNG', 132, NULL, NULL),
(1620, 'WONOSOBO', 132, NULL, NULL),
(1628, 'TALANG PADANG', 132, NULL, NULL),
(1638, 'SEMAKA', 132, NULL, NULL),
(1645, 'GUNUNG ALIP', 132, NULL, NULL),
(1651, 'CUKUH BALAK', 132, NULL, NULL),
(1652, 'BULOK', 132, NULL, NULL),
(1659, 'GISTING', 132, NULL, NULL),
(1660, 'KOTA AGUNG BARAT', 132, NULL, NULL),
(1664, 'KOTA AGUNG (KOTA AGUNG PUSAT)', 132, NULL, NULL),
(1670, 'KOTA AGUNG TIMUR', 132, NULL, NULL),
(1672, 'KELUMBAYAN BARAT', 132, NULL, NULL),
(1678, 'PEMATANG SAWA', 132, NULL, NULL),
(1770, 'KELUMBAYAN', 132, NULL, NULL),
(6998, NULL, 132, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `legislasi`
--

CREATE TABLE `legislasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengusul_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tahapan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `legislasi`
--

INSERT INTO `legislasi` (`id`, `pengusul_id`, `judul`, `deskripsi`, `tahapan_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(13, 1, 'RUU tentang Perubahan atas Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara', '<p>Telah dilakukan uji materiil oleh MK dengan putusan sebagai berikut:</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://peraturan.bpk.go.id/Home/DownloadUjiMateri/35/8_PUU-XIII_2015.pdf\">8/PUU-XIII/2015</a><br />\r\n	<em>Pasal 124 ayat (2) Udang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil bertentangan dengan UUD NRI Tahun 1945 dan tidak mempunyai kekuatan hukum mengikat sepanjang mengenai frasa &quot;2 (dua) tahun&quot; dalam ketentuan tersebut tidak dimaknai &quot;5 (lima) tahun&quot;.</em></li>\r\n	<li><a href=\"https://peraturan.bpk.go.id/Home/DownloadUjiMateri/142/PULB_MK_87PUUXVI2018_2018%20(1).PDF\">PUTUSAN Nomor 87/PUU-XVI/2018</a><br />\r\n	<em>Menyatakan frasa &ldquo;dan/atau pidana umum&rdquo; dalam Pasal 87 ayat (4) huruf b Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 6, Tambahan Lembaran Negara Republik Indonesia Nomor 5494) bertentangan dengan Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 dan tidak mempunyai kekuatan hukum mengikat, sehingga Pasal 87 ayat (4) huruf b Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara menjadi berbunyi, &ldquo;dihukum penjara atau kurungan berdasarkan putusan pengadilan yang telah memiliki kekuatan hukum tetap karena melakukan tindak pidana kejahatan jabatan atau tindak pidana kejahatan yang ada hubungannya dengan jabatan&rdquo;;</em></li>\r\n</ul>', 2, 'Tahap Perencanaan', '2023-01-12 01:51:16', '2023-01-12 01:51:16'),
(14, 1, 'Perancangan RANPERDA 09', '<p>Latar Belakang dan Tujuan Penyusunan</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Keputusan MK No. 92/PUU-X/2012 terkait pengujian UU MD3 dan UU No. 12 Tahun 2011 (P3) menyatakan beberapa ketentuan dalam UU P3 tidak memiliki kekuatan berlaku karena tidak memperjelas proses keterlibatan DPD dalam proses pembentukan UU yang terkait dengan kewenangan DPD sebagaimana dimaksud dalam Pasal 22D UUDNRI Tahun 1945.</p>\r\n\r\n	<p>Keterlibatan DPD dalam Pembentukan RUU dimulai sejak perencanaan, pembentukan, pembahasan, sampai penyebarluasan. Dengan demikian ada perubahan yang cukup signifikan terhadap&nbsp; konsep dan mekanisme pembahasan RUU di DPR<strong>&nbsp; yang harus mengubah UU No. 12 Tahun&nbsp; 2011.</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Sasaran yang ingin Diwujudkan</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Mengubah UU 12 Tahun 2011 agar lebih komprehensif, pasti, dan harmonis dengan peraturan perundang-undangan lainnya baik secara vertikal maupun horizontal.</p>\r\n	</li>\r\n</ul>', 1, 'Sedang dalam tahapan perencanaan', '2023-01-16 10:42:30', '2023-01-16 10:42:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `legislasi_tahapanlegislasi`
--

CREATE TABLE `legislasi_tahapanlegislasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `legislasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tahapan_legislasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `legislasi_tahapanlegislasi`
--

INSERT INTO `legislasi_tahapanlegislasi` (`id`, `legislasi_id`, `tahapan_legislasi_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(13, 13, 1, 'wewweweqe', '2023-01-10 09:13:55', '2023-01-10 09:13:55'),
(14, 13, 3, 'wewweweqe', '2023-01-11 10:26:07', '2023-01-11 10:26:07'),
(15, 13, 2, 'wewweweqe', '2023-01-11 10:27:04', '2023-01-11 10:27:04'),
(16, 13, 1, 'Tahap Perencanaan', '2023-01-12 01:46:17', '2023-01-12 01:46:17'),
(17, 13, 2, 'Tahap Perencanaan', '2023-01-12 01:51:16', '2023-01-12 01:51:16'),
(18, 14, 2, 'Sedang dalam tahapan perencanaan', '2023-01-16 08:52:27', '2023-01-16 08:52:27'),
(19, 14, 1, 'Sedang dalam tahapan perencanaan', '2023-01-16 10:42:30', '2023-01-16 10:42:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_managers`
--

CREATE TABLE `menu_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` tinyint(4) NOT NULL DEFAULT 0,
  `menu_permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_managers`
--

INSERT INTO `menu_managers` (`id`, `parent_id`, `menu_permission_id`, `role_id`, `title`, `path_url`, `icon`, `type`, `sort`) VALUES
(17, 0, 1, 1, NULL, NULL, NULL, NULL, 1),
(18, 0, NULL, 1, 'Master Data', NULL, 'fas fa-database', NULL, 2),
(19, 18, 2, 1, NULL, NULL, NULL, NULL, 1),
(20, 0, NULL, 1, 'Settings', NULL, 'fas fa-wrench', NULL, 6),
(21, 20, 4, 1, NULL, NULL, NULL, NULL, 4),
(22, 20, 3, 1, NULL, NULL, NULL, NULL, 3),
(23, 20, 6, 1, NULL, NULL, NULL, NULL, 2),
(24, 20, 5, 1, NULL, NULL, NULL, NULL, 1),
(25, 18, 10, 1, NULL, NULL, NULL, NULL, 7),
(26, 18, 12, 1, NULL, NULL, NULL, NULL, 9),
(27, 18, 11, 1, NULL, NULL, NULL, NULL, 8),
(28, 18, 13, 1, NULL, NULL, NULL, NULL, 2),
(29, 18, 14, 1, NULL, NULL, NULL, NULL, 3),
(30, 0, NULL, 1, 'Settings Front', NULL, 'fas fa-hockey-puck', NULL, 7),
(31, 18, 15, 1, NULL, NULL, NULL, NULL, 4),
(32, 18, 16, 1, NULL, NULL, NULL, NULL, 5),
(33, 18, 17, 1, NULL, NULL, NULL, NULL, 6),
(34, 18, 18, 1, NULL, NULL, NULL, NULL, 10),
(35, 0, NULL, 1, 'Legislasi', NULL, 'fas fa-sticky-note', NULL, 3),
(36, 0, NULL, 1, 'Survey', NULL, 'fas fa-poll-h', NULL, 4),
(37, 0, NULL, 1, 'Aspirasi', NULL, 'fas fa-question-circle', NULL, 5),
(38, 35, 19, 1, NULL, NULL, NULL, NULL, 1),
(39, 36, 20, 1, NULL, NULL, NULL, NULL, 1),
(40, 37, 21, 1, NULL, NULL, NULL, NULL, 1),
(41, 30, 23, 1, NULL, NULL, NULL, NULL, 2),
(42, 30, 24, 1, NULL, NULL, NULL, NULL, 1),
(43, 35, 25, 1, NULL, NULL, NULL, NULL, 2),
(44, 37, 28, 1, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_permissions`
--

CREATE TABLE `menu_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'fas fa-address-card',
  `type` enum('backend','frontend') COLLATE utf8mb4_unicode_ci DEFAULT 'backend'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_permissions`
--

INSERT INTO `menu_permissions` (`id`, `title`, `slug`, `path_url`, `icon`, `type`) VALUES
(1, 'Dashboard', 'backend dashboard', '/backend/dashboard', 'fas fa-home', 'backend'),
(2, 'Akun Admin', 'backend users', '/backend/users', 'fas fa-users', 'backend'),
(3, 'Permissions', 'backend permissions', '/backend/permissions', 'fa fa-tasks', 'backend'),
(4, 'Menu Settings', 'backend menu', '/backend/menu', 'fa fa-cog', 'backend'),
(5, 'Settings Web', 'backend settings', '/backend/settings', 'fab fa-deviantart', 'backend'),
(6, 'Roles', 'backend roles', '/backend/roles', 'fa fa-id-card', 'backend'),
(10, 'Provinsi', 'backend provinsi', '/backend/provinsi', 'fa fa-map', 'backend'),
(11, 'Kabupaten', 'backend kabupaten', '/backend/kabupaten', 'fas fa-map-marked', 'backend'),
(12, 'Kecamatan', 'backend kecamatan', '/backend/kecamatan', 'fas fa-map-marked-alt', 'backend'),
(13, 'Jabatan', 'backend jabatan', '/backend/jabatan', 'fab fa-mizuni', 'backend'),
(14, 'Kategori Ranperda', 'backend kategoriranperda', '/backend/kategoriranperda', 'fas fa-border-style', 'backend'),
(15, 'Pengusul', 'backend pengusul', '/backend/pengusul', 'fas fa-hourglass-end', 'backend'),
(16, 'Dewan', 'backend dewan', '/backend/dewan', 'fas fa-i-cursor', 'backend'),
(17, 'SKPD', 'backend skpd', '/backend/skpd', 'fab fa-superpowers', 'backend'),
(18, 'Tahapan Legislasi', 'backend tahapanlegislasi', '/backend/tahapanlegislasi', 'fab fa-superpowers', 'backend'),
(19, 'E Legislasi', 'backend Legislasi', '/backend/legislasi', 'fas fa-sticky-note', 'backend'),
(20, 'E Survey', 'backend survey', '/backend/survey', 'fas fa-poll-h', 'backend'),
(21, 'E Aspirasi', 'backend aspirasi', '/backend/aspirasi', 'fas fa-question-circle', 'backend'),
(22, 'E-LEGISLASI', 'e-legislasi', '/e-legislasi', NULL, 'frontend'),
(23, 'Image Slider', 'backend imageslider', '/backend/imageslider', 'fas fa-images', 'backend'),
(24, 'Settings Web Front', 'backend settingsfront', '/backend/settingsfront', 'fab fa-keycdn', 'backend'),
(25, 'Agenda', 'backend agenda', '/backend/agenda', 'fab fa-magento', 'backend'),
(26, 'E-SURVEY', 'e-survey', '/e-survey', NULL, 'frontend'),
(27, 'E-ASPIRASI', 'e-aspirasi', '/e-aspirasi', NULL, 'frontend'),
(28, 'Form Aspirasi', 'backend formaspirasi', '/backend/formaspirasi', 'fas fa-align-justify', 'backend');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(26, '2014_10_12_000000_create_users_table', 1),
(27, '2014_10_12_100000_create_password_resets_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2021_08_01_112328_create_menu_permissions_table', 1),
(31, '2021_08_19_115023_create_roles_table', 1),
(32, '2021_08_19_115145_create_permissions_table', 1),
(33, '2021_08_19_115611_create_permission_role_table', 1),
(34, '2021_08_19_115638_create_role_user_table', 1),
(35, '2021_10_07_130202_create_menu_managers_table', 1),
(36, '2021_10_07_142145_add_role_user_table', 1),
(41, '2021_10_18_151629_create_sessions_table', 2),
(42, '2022_12_28_091756_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `udpated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `participants`
--

CREATE TABLE `participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_id` bigint(20) UNSIGNED NOT NULL,
  `users_warga_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `participants`
--

INSERT INTO `participants` (`id`, `survey_id`, `users_warga_id`, `created_at`, `updated_at`) VALUES
(1, 11, 15, '2022-01-12 12:52:47', '2022-01-12 12:52:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengusul`
--

CREATE TABLE `pengusul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengusul`
--

INSERT INTO `pengusul` (`id`, `name`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Pengusul A', 'Deskripsi Pengusul A', '2023-01-05 11:13:02', '2023-01-05 11:13:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_permission_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('backend','frontend') COLLATE utf8mb4_unicode_ci DEFAULT 'backend'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `menu_permission_id`, `name`, `slug`, `type`) VALUES
(1, 1, 'Dashboard List', 'backend-dashboard-list', 'backend'),
(2, 1, 'Dashboard Create', 'backend-dashboard-create', 'backend'),
(3, 1, 'Dashboard Edit', 'backend-dashboard-edit', 'backend'),
(4, 1, 'Dashboard Delete', 'backend-dashboard-delete', 'backend'),
(5, 2, 'Akun Admin List', 'backend-users-list', 'backend'),
(6, 2, 'Akun Admin Create', 'backend-users-create', 'backend'),
(7, 2, 'Akun Admin Edit', 'backend-users-edit', 'backend'),
(8, 2, 'Akun Admin Delete', 'backend-users-delete', 'backend'),
(9, 3, 'Permissions List', 'backend-permissions-list', 'backend'),
(10, 3, 'Permissions Create', 'backend-permissions-create', 'backend'),
(11, 3, 'Permissions Edit', 'backend-permissions-edit', 'backend'),
(12, 3, 'Permissions Delete', 'backend-permissions-delete', 'backend'),
(13, 4, 'Menu Settings List', 'backend-menu-list', 'backend'),
(14, 4, 'Menu Settings Create', 'backend-menu-create', 'backend'),
(15, 4, 'Menu Settings Edit', 'backend-menu-edit', 'backend'),
(16, 4, 'Menu Settings Delete', 'backend-menu-delete', 'backend'),
(17, 5, 'Settings Web List', 'backend-settings-list', 'backend'),
(18, 5, 'Settings Web Create', 'backend-settings-create', 'backend'),
(19, 5, 'Settings Web Edit', 'backend-settings-edit', 'backend'),
(20, 5, 'Settings Web Delete', 'backend-settings-delete', 'backend'),
(21, 6, 'Roles List', 'backend-roles-list', 'backend'),
(22, 6, 'Roles Create', 'backend-roles-create', 'backend'),
(23, 6, 'Roles Edit', 'backend-roles-edit', 'backend'),
(24, 6, 'Roles Delete', 'backend-roles-delete', 'backend'),
(37, 10, 'Provinsi List', 'backend-provinsi-list', 'backend'),
(38, 10, 'Provinsi Create', 'backend-provinsi-create', 'backend'),
(39, 10, 'Provinsi Edit', 'backend-provinsi-edit', 'backend'),
(40, 10, 'Provinsi Delete', 'backend-provinsi-delete', 'backend'),
(41, 11, 'Kabupaten List', 'backend-kabupaten-list', 'backend'),
(42, 11, 'Kabupaten Create', 'backend-kabupaten-create', 'backend'),
(43, 11, 'Kabupaten Edit', 'backend-kabupaten-edit', 'backend'),
(44, 11, 'Kabupaten Delete', 'backend-kabupaten-delete', 'backend'),
(45, 12, 'Kecamatan List', 'backend-kecamatan-list', 'backend'),
(46, 12, 'Kecamatan Create', 'backend-kecamatan-create', 'backend'),
(47, 12, 'Kecamatan Edit', 'backend-kecamatan-edit', 'backend'),
(48, 12, 'Kecamatan Delete', 'backend-kecamatan-delete', 'backend'),
(49, 13, 'Jabatan List', 'backend-jabatan-list', 'backend'),
(50, 13, 'Jabatan Create', 'backend-jabatan-create', 'backend'),
(51, 13, 'Jabatan Edit', 'backend-jabatan-edit', 'backend'),
(52, 13, 'Jabatan Delete', 'backend-jabatan-delete', 'backend'),
(53, 14, 'Kategori Ranperda List', 'backend-kategoriranperda-list', 'backend'),
(54, 14, 'Kategori Ranperda Create', 'backend-kategoriranperda-create', 'backend'),
(55, 14, 'Kategori Ranperda Edit', 'backend-kategoriranperda-edit', 'backend'),
(56, 14, 'Kategori Ranperda Delete', 'backend-kategoriranperda-delete', 'backend'),
(57, 15, 'Pengusul List', 'backend-pengusul-list', 'backend'),
(58, 15, 'Pengusul Create', 'backend-pengusul-create', 'backend'),
(59, 15, 'Pengusul Edit', 'backend-pengusul-edit', 'backend'),
(60, 15, 'Pengusul Delete', 'backend-pengusul-delete', 'backend'),
(61, 16, 'Dewan List', 'backend-dewan-list', 'backend'),
(62, 16, 'Dewan Create', 'backend-dewan-create', 'backend'),
(63, 16, 'Dewan Edit', 'backend-dewan-edit', 'backend'),
(64, 16, 'Dewan Delete', 'backend-dewan-delete', 'backend'),
(65, 17, 'SKPD List', 'backend-skpd-list', 'backend'),
(66, 17, 'SKPD Create', 'backend-skpd-create', 'backend'),
(67, 17, 'SKPD Edit', 'backend-skpd-edit', 'backend'),
(68, 17, 'SKPD Delete', 'backend-skpd-delete', 'backend'),
(69, 18, 'Tahapan Legislasi List', 'backend-tahapanlegislasi-list', 'backend'),
(70, 18, 'Tahapan Legislasi Create', 'backend-tahapanlegislasi-create', 'backend'),
(71, 18, 'Tahapan Legislasi Edit', 'backend-tahapanlegislasi-edit', 'backend'),
(72, 18, 'Tahapan Legislasi Delete', 'backend-tahapanlegislasi-delete', 'backend'),
(73, 19, 'E legislasi List', 'backend-legislasi-list', 'backend'),
(74, 19, 'E legislasi Create', 'backend-legislasi-create', 'backend'),
(75, 19, 'E legislasi Edit', 'backend-legislasi-edit', 'backend'),
(76, 19, 'E legislasi Delete', 'backend-legislasi-delete', 'backend'),
(77, 20, 'E Survey List', 'backend-survey-list', 'backend'),
(78, 20, 'E Survey Create', 'backend-survey-create', 'backend'),
(79, 20, 'E Survey Edit', 'backend-survey-edit', 'backend'),
(80, 20, 'E Survey Delete', 'backend-survey-delete', 'backend'),
(81, 21, 'E Aspirasi List', 'backend-aspirasi-list', 'backend'),
(82, 21, 'E Aspirasi Create', 'backend-aspirasi-create', 'backend'),
(83, 21, 'E Aspirasi Edit', 'backend-aspirasi-edit', 'backend'),
(84, 21, 'E Aspirasi Delete', 'backend-aspirasi-delete', 'backend'),
(85, 22, 'E-LEGISLASI List', 'e-legislasi-list', ''),
(86, 22, 'E-LEGISLASI Create', 'e-legislasi-create', ''),
(87, 22, 'E-LEGISLASI Edit', 'e-legislasi-edit', ''),
(88, 22, 'E-LEGISLASI Delete', 'e-legislasi-delete', ''),
(89, 23, 'Image Slider List', 'backend-imageslider-list', ''),
(90, 23, 'Image Slider Create', 'backend-imageslider-create', ''),
(91, 23, 'Image Slider Edit', 'backend-imageslider-edit', ''),
(92, 23, 'Image Slider Delete', 'backend-imageslider-delete', ''),
(93, 24, 'Settings Web Front List', 'backend-settingsfront-list', ''),
(94, 24, 'Settings Web Front Create', 'backend-settingsfront-create', ''),
(95, 24, 'Settings Web Front Edit', 'backend-settingsfront-edit', ''),
(96, 24, 'Settings Web Front Delete', 'backend-settingsfront-delete', ''),
(97, 25, 'Agenda List', 'backend-agenda-list', ''),
(98, 25, 'Agenda Create', 'backend-agenda-create', ''),
(99, 25, 'Agenda Edit', 'backend-agenda-edit', ''),
(100, 25, 'Agenda Delete', 'backend-agenda-delete', ''),
(101, 26, 'E-SURVEY List', 'e-survey-list', ''),
(102, 26, 'E-SURVEY Create', 'e-survey-create', ''),
(103, 26, 'E-SURVEY Edit', 'e-survey-edit', ''),
(104, 26, 'E-SURVEY Delete', 'e-survey-delete', ''),
(105, 27, 'E-ASPIRASI List', 'e-aspirasi-list', ''),
(106, 27, 'E-ASPIRASI Create', 'e-aspirasi-create', ''),
(107, 27, 'E-ASPIRASI Edit', 'e-aspirasi-edit', ''),
(108, 27, 'E-ASPIRASI Delete', 'e-aspirasi-delete', ''),
(109, 28, 'Form Aspirasi List', 'backend-formaspirasi-list', ''),
(110, 28, 'Form Aspirasi Create', 'backend-formaspirasi-create', ''),
(111, 28, 'Form Aspirasi Edit', 'backend-formaspirasi-edit', ''),
(112, 28, 'Form Aspirasi Delete', 'backend-formaspirasi-delete', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions_roles`
--

CREATE TABLE `permissions_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_manager_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions_roles`
--

INSERT INTO `permissions_roles` (`id`, `menu_manager_id`, `permission_id`, `role_id`) VALUES
(1, 17, 1, 1),
(2, 17, 2, 1),
(3, 17, 3, 1),
(4, 17, 4, 1),
(5, 19, 5, 1),
(6, 19, 6, 1),
(7, 19, 7, 1),
(8, 19, 8, 1),
(9, 21, 13, 1),
(10, 21, 14, 1),
(11, 21, 15, 1),
(12, 21, 16, 1),
(13, 22, 9, 1),
(14, 22, 10, 1),
(15, 22, 11, 1),
(16, 22, 12, 1),
(17, 23, 21, 1),
(18, 23, 22, 1),
(19, 23, 23, 1),
(20, 23, 24, 1),
(21, 24, 17, 1),
(22, 24, 18, 1),
(23, 24, 19, 1),
(24, 24, 20, 1),
(25, 25, 37, 1),
(26, 25, 38, 1),
(27, 25, 39, 1),
(28, 25, 40, 1),
(29, 26, 45, 1),
(30, 26, 46, 1),
(31, 26, 47, 1),
(32, 26, 48, 1),
(33, 27, 41, 1),
(34, 27, 42, 1),
(35, 27, 43, 1),
(36, 27, 44, 1),
(37, 28, 49, 1),
(38, 28, 50, 1),
(39, 28, 51, 1),
(40, 28, 52, 1),
(41, 29, 53, 1),
(42, 29, 54, 1),
(43, 29, 55, 1),
(44, 29, 56, 1),
(45, 31, 57, 1),
(46, 31, 58, 1),
(47, 31, 59, 1),
(48, 31, 60, 1),
(49, 32, 61, 1),
(50, 32, 62, 1),
(51, 32, 63, 1),
(52, 32, 64, 1),
(53, 33, 65, 1),
(54, 33, 66, 1),
(55, 33, 67, 1),
(56, 33, 68, 1),
(57, 34, 69, 1),
(58, 34, 70, 1),
(59, 34, 71, 1),
(60, 34, 72, 1),
(61, 38, 73, 1),
(62, 38, 74, 1),
(63, 38, 75, 1),
(64, 38, 76, 1),
(65, 39, 77, 1),
(66, 39, 78, 1),
(67, 39, 79, 1),
(68, 39, 80, 1),
(69, 40, 81, 1),
(70, 40, 82, 1),
(71, 40, 83, 1),
(72, 40, 84, 1),
(73, 41, 89, 1),
(74, 41, 90, 1),
(75, 41, 91, 1),
(76, 41, 92, 1),
(77, 42, 93, 1),
(78, 42, 94, 1),
(79, 42, 95, 1),
(80, 42, 96, 1),
(81, 43, 97, 1),
(82, 43, 98, 1),
(83, 43, 99, 1),
(84, 43, 100, 1),
(85, 44, 109, 1),
(86, 44, 110, 1),
(87, 44, 111, 1),
(88, 44, 112, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id`, `name`, `created_at`, `updated_at`) VALUES
(8, 'LAMPUNG', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`) VALUES
(1, 'Super Admin', 'super-admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(7, 1, 1),
(9, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout_width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topbar_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `name`, `sidebar_logo`, `favicon`, `icon`, `layout`, `layout_mode`, `layout_position`, `layout_width`, `topbar_color`, `sidebar_size`, `sidebar_color`, `created_at`, `updated_at`) VALUES
(1, 'E-LEGISLASI', 'white-background-geo-shapes-1655474280-1672242464.jpg', 'white-background-geo-shapes-1672242465.jpg', 'white-background-geo-shapes-1672242465.jpg', 'vertical', 'light', 'fixed', 'fluid', 'light', 'lg', 'dark', NULL, '2023-01-12 10:39:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skpd`
--

CREATE TABLE `skpd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skpd`
--

INSERT INTO `skpd` (`id`, `name`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'Skpd1', 'skpd', '2023-01-06 05:21:58', '2023-01-06 05:21:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider_image`
--

CREATE TABLE `slider_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `menu_permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `urut` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider_image`
--

INSERT INTO `slider_image` (`id`, `judul`, `deskripsi`, `image`, `menu_permission_id`, `urut`, `created_at`, `updated_at`) VALUES
(4, 'E-LEGISLASI', 'Rancangan Undang-Undang (RUU) terkait otonomi daerah, hubungan pusat dan daerah', 'e-legislasi-1673515051.jpg', 22, 2, '2023-01-12 09:17:33', '2023-01-12 09:17:33'),
(5, 'E-SURVEY', 'Tujuan survey adalah untuk memperoleh gambaran secara objektif mengenai tanggapan masyarakat', 'e-survey-1673517256.jpg', 26, 3, '2023-01-12 09:54:18', '2023-01-12 09:54:18'),
(6, 'E-ASPIRASI', 'Menampung Pendapat Baik Berupa Saran, Pertanyaan, Informasi dan Keluhan', 'e-aspirasi-1673517310.jpg', 27, 4, '2023-01-12 10:13:25', '2023-01-12 10:13:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahapanlegislasi`
--

CREATE TABLE `tahapanlegislasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahapanlegislasi`
--

INSERT INTO `tahapanlegislasi` (`id`, `name`, `badge`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Perencanaan', 'warning', 'fas fa-check-double', '2023-01-11 06:57:23', '2023-01-11 06:57:23'),
(2, 'Penyusunan', 'success', 'fas fa-check-double', '2023-01-11 06:57:15', '2023-01-11 06:57:15'),
(3, 'Pembahasan', 'primary', 'fas fa-check-double', '2023-01-11 06:56:42', '2023-01-11 06:56:42'),
(4, 'Pengesahan Atau Penetapan', 'info', 'fas fa-check-double', '2023-01-11 06:57:09', '2023-01-11 06:57:09'),
(5, 'Pengundangan', 'danger', 'fas fa-check-double', '2023-01-11 06:57:01', '2023-01-11 06:57:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `active`, `jabatan_id`, `nik`, `last_seen`, `created_at`, `updated_at`) VALUES
(1, '24234', 'asik-kecamatan4-1672758153.png', '@gmail.com', 'mantap', '2022-12-28 02:36:06', '$2y$10$VmhFUKikJr76Cm0NFIEjgu5jfTVcemcVX47ADJXU/fnWiTste8vzS', 'pI15do9TLE2V3qmM6ccien0ygIOPwPI6uZfoOAZUBNbAsNKgmZAqwGhhuaAS', '1', 2, NULL, '2023-01-24 23:06:00', '2022-12-28 02:36:06', '2023-01-24 16:06:00'),
(4, 'Naim', NULL, 'hendrimusta88@gmail.com', 'Naim', '2023-01-06 05:45:41', '$2y$10$rJbRih9vEYvuqc2dszZP1OiWafig7djdfiUsX6pQWrDhuo0iJF3xi', NULL, '1', 2, NULL, NULL, '2023-01-06 05:45:40', '2023-01-06 05:55:39'),
(9, 'hendri mustakim', NULL, 'hendrimustakim@gmail.com', NULL, NULL, '', NULL, '1', 2, NULL, NULL, '2023-01-12 05:34:26', '2023-01-12 05:34:26'),
(10, 'asdsda', NULL, 'admi213n@gmail.com', NULL, NULL, '', NULL, '1', 2, NULL, NULL, '2023-01-12 05:47:21', '2023-01-12 05:47:21'),
(13, 'asdsda', NULL, 'admi23333n@gmail.com', NULL, NULL, '', NULL, '1', 2, '2333333333333312', NULL, '2023-01-12 05:48:47', '2023-01-12 05:48:47'),
(14, 'henmus', NULL, 'henmusta@gmail.com', NULL, NULL, '', NULL, '1', 2, '2332423432423', NULL, '2023-01-12 05:54:29', '2023-01-12 05:54:29'),
(15, 'ew', NULL, 'rweewrerw@gmail.com', NULL, NULL, '', NULL, '1', 2, '243232r23r', NULL, '2023-01-12 06:42:26', '2023-01-12 06:42:26'),
(16, 'qweqwewqdasdsad', NULL, 'sadsadsad@gmail.com', NULL, NULL, '', NULL, '1', 2, '234234234', NULL, '2023-01-12 06:44:23', '2023-01-12 06:44:23'),
(17, '323232', NULL, '3232@gmail.com', NULL, NULL, '', NULL, '1', 2, '323232', NULL, '2023-01-12 06:47:11', '2023-01-12 06:47:11'),
(18, '2332', NULL, '323232@gmail.com', NULL, NULL, '', NULL, '1', 2, '24', NULL, '2023-01-12 06:48:14', '2023-01-12 06:48:14'),
(19, 'wqeew', NULL, 'hendrimarketing@gmail.com', NULL, NULL, '', NULL, '1', 2, 'qweqwe', NULL, '2023-01-12 06:53:42', '2023-01-12 06:53:42'),
(20, 'wqewqwq', NULL, 'hendrimarwqewqketing@gmail.com', NULL, NULL, '', NULL, '1', 2, 'qwwqe32332', NULL, '2023-01-12 06:54:55', '2023-01-12 06:54:55'),
(21, 'hendrimusta', NULL, 'hendrimusta8832@gmail.com', NULL, NULL, '', NULL, '1', 2, '2332423432423324324234', NULL, '2023-01-12 06:58:06', '2023-01-12 06:58:06'),
(23, '32424', NULL, '323wqewwqew2@gmail.com', NULL, NULL, '', NULL, '1', 2, '2333', NULL, '2023-01-14 09:46:11', '2023-01-14 09:46:11'),
(24, 'wrerewr', NULL, '', NULL, NULL, '', NULL, '1', 2, '3243324', NULL, '2023-01-24 11:48:10', '2023-01-24 11:48:10'),
(26, 'qewewqewq', NULL, '23432423@gmail.com', NULL, NULL, '', NULL, '1', 2, '23432423', NULL, '2023-01-24 12:05:26', '2023-01-24 12:05:26'),
(29, 'wwerewr', NULL, '12321231123@gmail.com', NULL, NULL, '', NULL, '1', 2, '12321231123', NULL, '2023-01-24 13:15:39', '2023-01-24 13:15:39'),
(30, 'dsfsdfsfasfdd', NULL, '1232423545435@gmail.com', NULL, NULL, '', NULL, '1', 2, '1232423545435', NULL, '2023-01-24 13:16:55', '2023-01-24 13:16:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `legislasi_id` (`legislasi_id`);

--
-- Indeks untuk tabel `agenda_file`
--
ALTER TABLE `agenda_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `legislasi_id` (`legislasi_id`);

--
-- Indeks untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `legislasi_id` (`legislasi_id`);

--
-- Indeks untuk tabel `dewan`
--
ALTER TABLE `dewan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `form_aspirasi`
--
ALTER TABLE `form_aspirasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan_user`
--
ALTER TABLE `jabatan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_id` (`jabatan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `prov_id` (`provinsi_id`);

--
-- Indeks untuk tabel `kategoriranperda`
--
ALTER TABLE `kategoriranperda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kab_id` (`kabupaten_id`);

--
-- Indeks untuk tabel `legislasi`
--
ALTER TABLE `legislasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengusul_id` (`pengusul_id`);

--
-- Indeks untuk tabel `legislasi_tahapanlegislasi`
--
ALTER TABLE `legislasi_tahapanlegislasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `legislasi_id` (`legislasi_id`),
  ADD KEY `tahapan_legislasi_id` (`tahapan_legislasi_id`);

--
-- Indeks untuk tabel `menu_managers`
--
ALTER TABLE `menu_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_managers_menu_permission_id_foreign` (`menu_permission_id`),
  ADD KEY `menu_managers_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`survey_id`),
  ADD KEY `user_id` (`users_warga_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengusul`
--
ALTER TABLE `pengusul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_menu_permission_id_foreign` (`menu_permission_id`);

--
-- Indeks untuk tabel `permissions_roles`
--
ALTER TABLE `permissions_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_roles_permission_id_foreign` (`permission_id`),
  ADD KEY `permissions_roles_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skpd`
--
ALTER TABLE `skpd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider_image`
--
ALTER TABLE `slider_image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahapanlegislasi`
--
ALTER TABLE `tahapanlegislasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `agenda_file`
--
ALTER TABLE `agenda_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `form_aspirasi`
--
ALTER TABLE `form_aspirasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jabatan_user`
--
ALTER TABLE `jabatan_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT untuk tabel `kategoriranperda`
--
ALTER TABLE `kategoriranperda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6999;

--
-- AUTO_INCREMENT untuk tabel `legislasi`
--
ALTER TABLE `legislasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `legislasi_tahapanlegislasi`
--
ALTER TABLE `legislasi_tahapanlegislasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `menu_managers`
--
ALTER TABLE `menu_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengusul`
--
ALTER TABLE `pengusul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `permissions_roles`
--
ALTER TABLE `permissions_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `skpd`
--
ALTER TABLE `skpd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `slider_image`
--
ALTER TABLE `slider_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tahapanlegislasi`
--
ALTER TABLE `tahapanlegislasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`legislasi_id`) REFERENCES `legislasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `agenda_file`
--
ALTER TABLE `agenda_file`
  ADD CONSTRAINT `agenda_file_ibfk_1` FOREIGN KEY (`legislasi_id`) REFERENCES `legislasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`legislasi_id`) REFERENCES `legislasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jabatan_user`
--
ALTER TABLE `jabatan_user`
  ADD CONSTRAINT `jabatan_user_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jabatan_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`);

--
-- Ketidakleluasaan untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id`);

--
-- Ketidakleluasaan untuk tabel `legislasi`
--
ALTER TABLE `legislasi`
  ADD CONSTRAINT `legislasi_ibfk_1` FOREIGN KEY (`pengusul_id`) REFERENCES `pengusul` (`id`);

--
-- Ketidakleluasaan untuk tabel `legislasi_tahapanlegislasi`
--
ALTER TABLE `legislasi_tahapanlegislasi`
  ADD CONSTRAINT `legislasi_tahapanlegislasi_ibfk_1` FOREIGN KEY (`legislasi_id`) REFERENCES `legislasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `legislasi_tahapanlegislasi_ibfk_2` FOREIGN KEY (`tahapan_legislasi_id`) REFERENCES `tahapanlegislasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu_managers`
--
ALTER TABLE `menu_managers`
  ADD CONSTRAINT `menu_managers_menu_permission_id_foreign` FOREIGN KEY (`menu_permission_id`) REFERENCES `menu_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_managers_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_menu_permission_id_foreign` FOREIGN KEY (`menu_permission_id`) REFERENCES `menu_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permissions_roles`
--
ALTER TABLE `permissions_roles`
  ADD CONSTRAINT `permissions_roles_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permissions_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
