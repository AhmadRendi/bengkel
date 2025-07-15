-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2025 at 12:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaPelanggan` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `namaPelanggan`, `catatan`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Fulan 1', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-07-13 01:39:05', '2025-07-13 01:39:05'),
(2, 'Fulan 2', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-07-13 01:44:20', '2025-07-13 01:44:20'),
(3, 'Fulan 3', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-07-14 05:11:07', '2025-07-14 05:11:07'),
(4, 'Fulan', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-07-09 16:00:00', '2025-07-14 05:15:12'),
(5, 'Fulan 3', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-06-29 16:00:00', '2025-07-14 06:45:59'),
(6, 'Fulan 3', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-06-16 16:00:00', '2025-07-14 06:53:26'),
(7, 'Fulan', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-07-13 16:00:00', '2025-07-14 07:12:26'),
(8, 'Fulan', 'Tidak Tersedia', 'Tidak Tersedia', 1, '2025-07-13 16:00:00', '2025-07-14 07:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produks_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `invoices_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `produks_id`, `jumlah`, `invoices_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '2025-07-13 01:39:05', '2025-07-13 01:39:05'),
(2, 2, 3, 2, '2025-07-13 01:44:20', '2025-07-13 01:44:20'),
(3, 1, 2, 2, '2025-07-13 01:44:20', '2025-07-13 01:44:20'),
(4, 2, 1, 3, '2025-07-14 05:11:07', '2025-07-14 05:11:07'),
(5, 2, 1, 4, '2025-07-14 05:15:12', '2025-07-14 05:15:12'),
(6, 2, 1, 5, '2025-07-14 06:45:59', '2025-07-14 06:45:59'),
(7, 1, 1, 6, '2025-06-16 16:00:00', '2025-07-14 06:53:26'),
(8, 1, 1, 7, '2025-07-13 16:00:00', '2025-07-14 07:12:26'),
(9, 2, 1, 7, '2025-07-13 16:00:00', '2025-07-14 07:12:26'),
(10, 1, 1, 8, '2025-07-13 16:00:00', '2025-07-14 07:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_07_08_181317_create_produks_table', 1),
(3, '2025_07_09_143728_create_invoices_table', 1),
(4, '2025_07_09_143748_create_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `nama`, `sku`, `deskripsi`, `kategori`, `harga`, `stok`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tas', 'TAS', 'Tidak ada', 'Fashion', 100000, 9, 1, '2025-07-12 05:28:33', '2025-07-14 07:12:50'),
(2, 'Ransel', 'RNS', 'Tidak Ada', 'Fashion', 10000, 9, 1, '2025-07-13 01:43:50', '2025-07-14 07:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NpAVmKnkHyFStN6vBcTVO5YG1OvIXyvTkKSnzYgy', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS3NsajRsODE4SWZHOEdmNFpNUzRyODk5Z2xNeW5CZ3MwUjlUTDR3NiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRkLWludm9pY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1752573605),
('ocaS3ubooVjwr3veXxRI4skT2W0SiwXBboZDPylE', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/120.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGJCVjZSelJrMTlsSnBQT2x5YjBkWDNoUzh2cXFrSUQyQ3pERllvRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO319', 1752572688);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'karyawan',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Fulan', 'fulan@gmail.com', '$2y$12$NOK8znVQQfiR5UXbr3poJuoH0VgEf4wd6rEn.tAF/NPXtphZft6PK', 'karyawan', 1, '2025-07-12 05:27:44', '2025-07-12 05:44:44'),
(2, 'Fulan Kedua', 'fulasKedua@gmail.com', '$2y$12$.m2OjAYKiJUryO9aoESQIuYOl.RaefQut/vN3yUkbyS5YafWf9YEy', 'karyawan', 1, '2025-07-12 05:35:49', '2025-07-12 05:45:38'),
(3, 'admin', 'admin@gmail.com', '$2y$12$B2J5HM0uxP7Ugh6F1VrpD.UDLuaXt8dfv20MRP4r6dl/wuv1ROTWS', 'admin', 1, '2025-07-15 01:55:28', '2025-07-15 01:55:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_invoices_id_foreign` (`invoices_id`),
  ADD KEY `items_produks_id_foreign` (`produks_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produks_sku_unique` (`sku`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_invoices_id_foreign` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_produks_id_foreign` FOREIGN KEY (`produks_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
