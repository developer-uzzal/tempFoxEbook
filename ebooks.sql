-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 02:00 PM
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
-- Database: `ebooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `long_des` longtext NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `long_des`, `image1`, `image2`, `image3`, `image4`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'bookDew is a platform dedicated to providing high-quality e-books for free. Whether you\'re an avid reader, a student, or simply looking to explore new knowledge, bookDew offers a vast collection across various genres. Our mission is to make reading accessible to everyone by eliminating cost barriers and ensuring a seamless, user-friendly experience. Dive into the world of literature, education, and entertainment—all at no cost. Start your reading journey today with bookDew!', 'storage/about/about1-1741689414.jpg', 'storage/about/about2-1741689414.jpg', 'storage/about/about3-1741689414.jpg', 'storage/about/about4-1741689414.jpg', NULL, '2025-03-11 04:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `publish_year` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `pageNumber` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_premium` tinyint(1) NOT NULL DEFAULT 0,
  `is_trending` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `book_language_id` bigint(20) UNSIGNED NOT NULL,
  `book_auth_id` bigint(20) UNSIGNED NOT NULL,
  `publication_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `slug`, `publish_year`, `isbn`, `description`, `image`, `price`, `pageNumber`, `is_active`, `is_premium`, `is_trending`, `category_id`, `book_language_id`, `book_auth_id`, `publication_id`, `country_id`, `created_at`, `updated_at`) VALUES
(2, 'Eveniet sed cupidit', 'eveniet-sed-cupidit', '1975', '956', 'Aliquid doloribus ea', '/storage/books/eveniet-sed-cupidit-1741425228.jpg', NULL, '993', 1, 1, 0, 5, 3, 2, 2, 1, '2025-03-08 03:13:48', '2025-03-08 03:13:48'),
(3, 'Amet officia tempor', 'amet-officia-tempor', '2001', '604', 'Et commodo provident', '/storage/books/amet-officia-tempor-1741426097.jpg', NULL, '752', 1, 1, 1, 4, 1, 4, 1, 2, '2025-03-08 03:28:17', '2025-03-08 03:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `book_auths`
--

CREATE TABLE `book_auths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_auths`
--

INSERT INTO `book_auths` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Labore non in sed do', 'labore-non-in-sed-do', NULL, '2025-03-08 03:13:20', '2025-03-08 03:13:20'),
(2, 'Perferendis aut a co', 'perferendis-aut-a-co', NULL, '2025-03-08 03:13:23', '2025-03-08 03:13:23'),
(4, 'Suscipit corporis ad', 'suscipit-corporis-ad', NULL, '2025-03-08 03:17:26', '2025-03-08 03:17:26'),
(5, 'Tempore sunt aut eo11', 'tempore-sunt-aut-eo11', NULL, '2025-03-08 03:17:29', '2025-03-08 03:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `book_languages`
--

CREATE TABLE `book_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_languages`
--

INSERT INTO `book_languages` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Urdu', 'urdu', '2025-03-08 03:12:52', '2025-03-13 04:00:29'),
(2, 'Hindi', 'hindi', '2025-03-08 03:12:56', '2025-03-13 04:00:11'),
(3, 'English', 'english', '2025-03-08 03:13:00', '2025-03-13 04:00:03'),
(4, 'Bangla', 'bangla', '2025-03-08 03:13:03', '2025-03-13 03:59:52'),
(5, 'Arabic', 'arabic', '2025-03-13 04:00:37', '2025-03-13 04:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'Accusantium consequa', 'accusantium-consequa', 0, '2025-03-08 03:12:28', '2025-03-13 04:34:52'),
(5, 'Ut quibusdam consequ', 'ut-quibusdam-consequ', 0, '2025-03-08 03:12:33', '2025-03-13 04:34:57'),
(13, 'Science & Technology', 'science-technology', 1, '2025-03-13 04:34:48', '2025-03-13 04:35:02'),
(14, 'History & Geography', 'history-geography', 1, '2025-03-13 04:35:13', '2025-03-13 04:35:13'),
(15, 'Philosophy & Psychology', 'philosophy-psychology', 1, '2025-03-13 04:35:27', '2025-03-13 04:35:27'),
(16, 'Social Sciences', 'social-sciences', 1, '2025-03-13 04:35:38', '2025-03-13 04:35:38'),
(17, 'Language & Literature', 'language-literature', 1, '2025-03-13 04:35:57', '2025-03-13 04:35:57'),
(18, 'Mathemathics', 'mathemathics', 1, '2025-03-13 04:36:21', '2025-03-13 04:36:21'),
(19, 'Arts & Painting', 'arts-painting', 1, '2025-03-13 04:36:32', '2025-03-13 04:36:32'),
(20, 'Sports & Music', 'sports-music', 1, '2025-03-13 04:36:45', '2025-03-13 04:36:45'),
(21, 'Religion', 'religion', 1, '2025-03-13 04:36:57', '2025-03-13 04:36:57'),
(22, 'Manuscript', 'manuscript', 1, '2025-03-13 04:37:09', '2025-03-13 04:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `map` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `description`, `map`, `created_at`, `updated_at`) VALUES
(1, 'sfsdfgds111444444', 'sdafgdsf33344', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14608.036955469059!2d90.36556226266988!3d23.74704994976332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b33cffc3fb%3A0x4a826f475fd312af!2sDhanmondi%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1741248308017!5m2!1sen!2sbd', NULL, '2025-03-12 00:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Praesentium blanditi', 'praesentium-blanditi', '2025-03-08 03:12:39', '2025-03-08 03:12:39'),
(2, 'Est dolore temporibu', 'est-dolore-temporibu', '2025-03-08 03:12:42', '2025-03-08 03:12:42'),
(3, 'Vel ipsam voluptas r', 'vel-ipsam-voluptas-r', '2025-03-08 03:12:47', '2025-03-08 03:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `img`, `created_at`, `updated_at`) VALUES
(1, 'storage/homeBanner/slider-1741795984.jpg', NULL, '2025-03-12 10:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_footers`
--

CREATE TABLE `menu_footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `fav_icon` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `short_des` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `copy_right` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_footers`
--

INSERT INTO `menu_footers` (`id`, `logo`, `fav_icon`, `title`, `short_des`, `address`, `phone`, `email`, `facebook`, `twitter`, `youtube`, `year`, `copy_right`, `created_at`, `updated_at`) VALUES
(1, 'storage/menuFooter/logo-1741857806.png', 'storage/menuFooter/favicon-1741510640.png', 'Fox Ebook', 'Ebook is a leading e-book website in Bangladesh. We offer thousands of islamic, general and academic books at a zero price.', 'rtyrtuy111', '154782333', 'trtd444@gmail.com', '#', '#', '#', '2025', 'Ebook', '2025-03-09 08:14:55', '2025-03-13 03:23:26');

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
(1, '0001_01_01_000000_create_users', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_25_192740_create_book_auths_table', 1),
(5, '2025_02_25_192802_create_categories_table', 1),
(6, '2025_02_25_192916_create_book_languages_table', 1),
(7, '2025_02_25_192920_create_publications_table', 1),
(8, '2025_02_25_192921_create_countries_table', 1),
(9, '2025_02_25_192927_create_books_table', 1),
(10, '2025_02_25_192939_create_members_table', 1),
(11, '2025_03_08_090717_create_sessions_table', 2),
(14, '2025_03_09_060924_create_menu_footers_table', 3),
(15, '2025_03_09_113537_create_abouts_table', 4),
(17, '2025_03_11_113102_create_contacts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Autem id deleniti se', 'autem-id-deleniti-se', '2025-03-08 03:13:09', '2025-03-08 03:13:09'),
(2, 'Labore ipsum veniam', 'labore-ipsum-veniam', '2025-03-08 03:13:12', '2025-03-08 03:13:12'),
(3, 'Enim pariatur Sed a', 'enim-pariatur-sed-a', '2025-03-08 03:13:15', '2025-03-08 03:13:15');

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
('mkXqvOcLZDkLjsZUK0GAt6lf8MPmYxLIknq5QKkK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVhNWTJpaWNxbWNmRmM1YTg4YnBDeTQxY3VvTlpGbnVhd0J5YXVWcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kb25hdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6InVzZXJFbWFpbCI7czoxNToic2FraWJAZ21haWwuY29tIjt9', 1741863450);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `img`, `otp`, `password`, `created_at`, `updated_at`) VALUES
(1, 'sakib', 'sakib@gmail.com', '/storage/users/sakib-1741853955.png', NULL, '$2y$12$xrmxLD57ZzmflJBpXSiP7egKm1vZLoxuKyT.bnyZF6dSxJ2JEYu.6', '2025-03-08 09:08:21', '2025-03-13 02:19:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`),
  ADD KEY `books_book_language_id_foreign` (`book_language_id`),
  ADD KEY `books_book_auth_id_foreign` (`book_auth_id`),
  ADD KEY `books_publication_id_foreign` (`publication_id`),
  ADD KEY `books_country_id_foreign` (`country_id`);

--
-- Indexes for table `book_auths`
--
ALTER TABLE `book_auths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_languages`
--
ALTER TABLE `book_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_footers`
--
ALTER TABLE `menu_footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book_auths`
--
ALTER TABLE `book_auths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_languages`
--
ALTER TABLE `book_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_footers`
--
ALTER TABLE `menu_footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_book_auth_id_foreign` FOREIGN KEY (`book_auth_id`) REFERENCES `book_auths` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_book_language_id_foreign` FOREIGN KEY (`book_language_id`) REFERENCES `book_languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_publication_id_foreign` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
