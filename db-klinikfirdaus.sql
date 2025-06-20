-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Jun 2025 pada 10.05
-- Versi server: 8.0.30
-- Versi PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-klinikfirdaus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint UNSIGNED NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatans`
--

INSERT INTO `jabatans` (`id`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Klinik', '2025-06-18 01:07:13', '2025-06-18 01:07:13'),
(2, 'Kepala Tim Marketing', '2025-06-19 06:56:46', '2025-06-19 06:56:46'),
(5, 'Kepala Tim Kreatif', '2025-06-19 07:33:42', '2025-06-19 07:33:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot_kriteria` double(8,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriterias`
--

INSERT INTO `kriterias` (`id`, `kriteria`, `bobot_kriteria`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 'Kualitas Kerja', 60.00, '-', '2025-06-19 01:21:15', '2025-06-19 05:44:23'),
(6, 'Kedisiplinan', 70.00, 'real', '2025-06-19 01:22:24', '2025-06-19 01:22:24'),
(7, 'Kerjasamai', 50.00, 'real', '2025-06-19 01:23:43', '2025-06-19 06:56:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2025_06_12_121818_create_kriterias_table', 1),
(14, '2025_06_18_025715_create_subkriterias_table', 1),
(15, '2025_06_18_074503_create_pekerjaans_table', 1),
(16, '2025_06_18_074513_create_jabatans_table', 1),
(17, '2025_06_18_075901_add_jabatan_id_and_pekerjaan_id_to_users_table', 1),
(18, '2025_06_18_112428_add_is_core_factor_to_subkriterias_table', 2),
(19, '2025_06_18_113438_create_penilaian_karyawan_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaans`
--

CREATE TABLE `pekerjaans` (
  `id` bigint UNSIGNED NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pekerjaans`
--

INSERT INTO `pekerjaans` (`id`, `pekerjaan`, `created_at`, `updated_at`) VALUES
(1, 'Dokter', '2025-06-18 01:07:42', '2025-06-18 01:07:42'),
(2, 'Perawat', '2025-06-18 01:07:48', '2025-06-18 01:07:48'),
(3, 'CS', '2025-06-19 06:57:11', '2025-06-19 06:57:11'),
(4, 'Kepala Bagian Administrasi', '2025-06-19 06:57:18', '2025-06-19 07:41:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_karyawan`
--

CREATE TABLE `penilaian_karyawan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subkriteria_id` bigint UNSIGNED NOT NULL,
  `nilai_karyawan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penilaian_karyawan`
--

INSERT INTO `penilaian_karyawan` (`id`, `user_id`, `subkriteria_id`, `nilai_karyawan`, `created_at`, `updated_at`) VALUES
(7, 7, 3, 4, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(8, 7, 4, 5, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(9, 7, 5, 3, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(10, 7, 6, 4, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(11, 7, 7, 5, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(12, 7, 8, 4, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(13, 7, 9, 5, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(14, 7, 10, 4, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(15, 7, 11, 4, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(16, 7, 12, 3, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(17, 7, 13, 5, '2025-06-19 01:40:15', '2025-06-19 01:40:15'),
(18, 7, 14, 4, '2025-06-19 01:40:15', '2025-06-19 01:40:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriterias`
--

CREATE TABLE `subkriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `subkriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_ideal` int NOT NULL,
  `is_core_factor` tinyint(1) NOT NULL DEFAULT '1',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subkriterias`
--

INSERT INTO `subkriterias` (`id`, `kriteria_id`, `subkriteria`, `nilai_ideal`, `is_core_factor`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 5, 'Ketelitian dalam Menyelesaikan Tugas', 5, 1, '-', '2025-06-19 01:28:34', '2025-06-19 01:28:34'),
(4, 5, 'Kualitas Hasil Pekerjaan', 5, 1, '-', '2025-06-19 01:29:45', '2025-06-19 01:29:45'),
(5, 5, 'Kemampuan Mencapai Target', 5, 1, '-', '2025-06-19 01:30:08', '2025-06-19 01:30:08'),
(6, 5, 'Inisiatif dalam Meningkatkan Kualitas', 5, 0, '-', '2025-06-19 01:30:25', '2025-06-19 01:30:25'),
(7, 6, 'Kehadiran Tepat Waktu', 5, 1, '-', '2025-06-19 01:30:58', '2025-06-19 01:30:58'),
(8, 6, 'Mematuhi Jam Kerja', 5, 1, '-', '2025-06-19 01:35:13', '2025-06-19 01:35:13'),
(9, 6, 'Kepatuhan Terhadap Peraturan Perusahaan', 5, 0, '-', '2025-06-19 01:35:36', '2025-06-19 01:35:36'),
(10, 6, 'Penggunaan Waktu Kerja Efektif', 5, 0, '-', '2025-06-19 01:35:52', '2025-06-19 01:35:52'),
(11, 7, 'Kemampuan Berkomunikasi dengan Rekan Kerja', 5, 1, '-', '2025-06-19 01:36:07', '2025-06-19 01:36:07'),
(12, 7, 'Kemampuan Bekerja dalam Tim', 5, 1, '-', '2025-06-19 01:36:23', '2025-06-19 01:36:23'),
(13, 7, 'Kemampuan Menyelesaikan Konflik', 5, 0, '-', '2025-06-19 01:36:48', '2025-06-19 01:36:48'),
(14, 7, 'Kemampuan Membantu Rekan Kerja eak', 5, 1, '-', '2025-06-19 01:37:02', '2025-06-19 20:34:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan_id` bigint UNSIGNED DEFAULT NULL,
  `pekerjaan_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `nik`, `tgl_lahir`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `jabatan_id`, `pekerjaan_id`) VALUES
(1, 'admin sistem', '1234567890', '2001-01-15', 'admin@gmail.com', NULL, '$2y$10$q/D2WUuPPGHDMKlkeVFP8uRueVG4ZwTE7csRyk7copEI.jgJqoYEG', 'admin', NULL, '2025-06-18 01:05:47', '2025-06-18 01:05:47', NULL, NULL),
(2, 'user karyawan', '9182823278', '2001-01-15', 'user@gmail.com', NULL, '$2y$10$EeU5UsxZ8ylbQP2T3tBt7eodc.okoLdEgX8RWgkTBN.jieBy/qmZe', 'user', NULL, '2025-06-18 01:05:47', '2025-06-18 01:05:47', NULL, NULL),
(4, 'mana', '121212121212', '2003-09-15', 'mana@gmail.com', NULL, '$2y$10$4aMHVdvdJ1G2hzDzOqZpfOYQApg8zdcpxaoovkYVUrou72s3aRuom', 'user', NULL, '2025-06-18 01:31:06', '2025-06-18 01:31:06', NULL, 1),
(6, 'anggi', '9098767678987689', '2003-12-12', 'anggi@gmail.com', NULL, '$2y$10$U7GrGIv/86PlCI51KHjli.9Y9X7oLeieBaTJFY4DABsn9hhNAUbPS', 'user', NULL, '2025-06-19 00:49:14', '2025-06-19 00:49:14', NULL, 2),
(7, 'PERCOBAAN 1', '1234567891234567', '2002-02-22', 'percobaan@gmail.com', NULL, '$2y$10$z0ev9WqHBtEoqdqiTv.cxuk4WRCXb7y5nUZrRLrXPFwE6/NCjI42S', 'user', NULL, '2025-06-19 01:38:08', '2025-06-19 06:56:11', NULL, 2),
(8, 'fgdfg', '12312456', '2005-12-12', 'and@gmail.com', NULL, '$2y$10$Nw7tAqciBIjhJFu1TFQrL.FR3YxPh4i4f9cG2QqDxmvpdV3I0GTiu', 'admin', NULL, '2025-06-19 21:09:13', '2025-06-19 21:09:13', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pekerjaans`
--
ALTER TABLE `pekerjaans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penilaian_karyawan_user_id_subkriteria_id_unique` (`user_id`,`subkriteria_id`),
  ADD KEY `penilaian_karyawan_subkriteria_id_foreign` (`subkriteria_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `subkriterias`
--
ALTER TABLE `subkriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subkriterias_kriteria_id_foreign` (`kriteria_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `users_pekerjaan_id_foreign` (`pekerjaan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pekerjaans`
--
ALTER TABLE `pekerjaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `subkriterias`
--
ALTER TABLE `subkriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  ADD CONSTRAINT `penilaian_karyawan_subkriteria_id_foreign` FOREIGN KEY (`subkriteria_id`) REFERENCES `subkriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_karyawan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriterias`
--
ALTER TABLE `subkriterias`
  ADD CONSTRAINT `subkriterias_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `pekerjaans` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
