-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2019 at 06:16 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sicial_sites`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversions`
--

CREATE TABLE `conversions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversions`
--

INSERT INTO `conversions` (`id`, `user_one`, `user_two`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 11, 14, NULL, NULL, NULL),
(4, 11, 13, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(10) UNSIGNED NOT NULL,
  `requester` int(11) NOT NULL,
  `user_requested` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `requester`, `user_requested`, `status`, `created_at`, `updated_at`) VALUES
(22, 13, 11, 1, '2019-04-03 22:57:15', '2019-04-03 22:57:15'),
(23, 13, 12, NULL, '2019-04-03 22:57:17', '2019-04-03 22:57:17'),
(24, 13, 14, NULL, '2019-04-03 22:57:19', '2019-04-03 22:57:19'),
(25, 13, 15, NULL, '2019-04-03 22:57:20', '2019-04-03 22:57:20'),
(26, 11, 12, NULL, '2019-04-04 03:22:42', '2019-04-04 03:22:42'),
(27, 11, 13, NULL, '2019-04-04 03:22:44', '2019-04-04 03:22:44'),
(28, 11, 14, NULL, '2019-04-04 03:22:45', '2019-04-04 03:22:45'),
(29, 11, 15, NULL, '2019-04-04 03:22:47', '2019-04-04 03:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `messagesses`
--

CREATE TABLE `messagesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `mgs` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messagesses`
--

INSERT INTO `messagesses` (`id`, `user_from`, `user_to`, `mgs`, `conversions_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 11, 14, 'chil', 3, 1, NULL, NULL),
(7, 11, 13, 'hi', 4, 1, NULL, NULL),
(8, 13, 14, 'How are you', 4, 1, NULL, NULL),
(9, 11, 14, 'Fine', 4, 1, NULL, NULL),
(10, 13, 14, 'ertr', 4, 1, NULL, NULL),
(11, 13, 14, 'ertr', 4, 1, NULL, NULL),
(12, 11, 14, 'Fine', 4, 1, NULL, NULL),
(13, 11, 14, 'Fine', 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_09_090432_creact_user_profiles_table', 2),
(9, '2019_01_14_105313_create_friendships_table', 3),
(10, '2019_01_29_080517_create_notifications_table', 3),
(11, '2019_01_30_083710_create_posts_table', 4),
(12, '2019_02_15_042110_create_messagesses_table', 5),
(13, '2019_02_15_042256_create_conversion_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `send_request` int(11) NOT NULL,
  `loggedin_user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `send_request`, `loggedin_user`, `status`, `note`, `created_at`, `updated_at`) VALUES
(21, 11, 13, 0, 'Accept your friend request', '2019-04-03 22:57:38', '2019-04-03 22:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(96, 11, 'new post', 0, NULL, NULL),
(97, 11, 'post in vue.js', 0, NULL, NULL),
(98, 13, 'hj', 0, NULL, NULL),
(99, 11, 't', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `city`, `country`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 11, 'dhaka', 'bangldesh', 'every one will die .and I am waiting for this universal truth', NULL, '2019-01-09 03:43:50', '2019-01-09 03:43:50'),
(2, 12, 'dhaka', 'bangldesh', 'test the identification of user', NULL, '2019-01-15 00:06:05', '2019-01-15 00:06:05'),
(3, 13, 'tangil', 'bangladeshd', 'this is title for user', NULL, '2019-01-15 00:06:35', '2019-01-15 00:06:35'),
(4, 14, NULL, NULL, NULL, NULL, '2019-01-24 03:13:28', '2019-01-24 03:13:28'),
(5, 15, NULL, NULL, NULL, NULL, '2019-01-24 03:13:58', '2019-01-24 03:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(145) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `slug`, `pic`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'alamin', '1', 'alamin', 'Penguins.jpg', 'alamin@gmail.com', NULL, '$2y$10$9/obfWAEPuxpKLSAKC.w/u42nXQBxphONb0cyeTpoN0HHx11ooWmu', 'fBF0BBQtRugVhoNdoO02CUar9OjpJyN8CP8An4La0KjnvoMOwG2WceqRSbnY', '2019-01-09 03:43:50', '2019-01-09 03:43:50'),
(12, 'female', '1', 'female', 'man.jpg', 'female@gmail.com', NULL, '$2y$10$y9VVzIG/CgH4UVPgKlpx4.B5FUas/2hSv8mgJzjr2JVQ.mH72UvJW', 'a8TmgAPLYavShilI0RbTVPupDtwAxNbVoEGbr5Yrp35Srv9SP0OExz7qLyxF', '2019-01-15 00:06:05', '2019-01-15 00:06:05'),
(13, 'admin', '2', 'admin', '2018_1545114924.jpg', 'admin@gmail.com', NULL, '$2y$10$5MdRBdPPAe/V23.KM6twhO.RY6fjbqvdV6cAbvu3sbb865.Tc1QAG', 'llDLpHn2MK0oZ2KV2BFufivrtogF3ctFTJpqHmRHs6TRg8coZ8d7atCakgjw', '2019-01-15 00:06:35', '2019-01-15 00:06:35'),
(14, 'runa', '2', 'runa', 'woman.png', 'runa@gmail.com', NULL, '$2y$10$T0JO4BuU8kh3Uajb4VYC3Oxo.dGAwGf7ceKfIV8CT6XgqLfvIorT2', 'k1E0DeDRwQAFKVMJHDtY73Llo2w3QMh2blJY0liHiTyPbCfMf0LMKVkbWzFd', '2019-01-24 03:13:27', '2019-01-24 03:13:27'),
(15, 'alamin1', '1', 'alamin1', 'man.jpg', 'alamin1@gmail.com', NULL, '$2y$10$Fg6N7DVULtLQsZNIhZ9HEeASwefvA0W.zmbeYBgB3YFs6VHT33Zh6', 'zENxnThjC2vXHncmKlOSh3hse3snnOLCFe3gkukQbTcT6oHcBBTgSHzbFEcE', '2019-01-24 03:13:58', '2019-01-24 03:13:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversions`
--
ALTER TABLE `conversions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messagesses`
--
ALTER TABLE `messagesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `conversions`
--
ALTER TABLE `conversions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `messagesses`
--
ALTER TABLE `messagesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
