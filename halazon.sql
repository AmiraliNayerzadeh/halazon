-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 02, 2024 at 10:13 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halazon`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_title_unique` (`title`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `title_en`, `image`, `description`, `parent_id`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'هنر', 'art', '/storage/photos/1/7-Tips-to-Finding-Art-Inspiration-Header-1024x649.jpg', 'هنر چیزیه روح انسان رو شفا میده! و البته این متن از متن اصلی ثبت میباشد.', NULL, 'art', 'آموزش تخصصی هنر برای کودکان', 'هنرمند، هنر مند کوچک', 'این هم متادیسکرپشن هنر میباشد.', NULL, '2024-07-29 08:50:28', '2024-07-29 08:50:28'),
(2, 'موسیقی', 'music', NULL, NULL, 1, 'music', NULL, NULL, NULL, NULL, '2024-07-29 08:56:43', '2024-07-29 08:56:43'),
(3, 'نقاشی', 'paint', NULL, NULL, 1, 'paint', NULL, NULL, NULL, NULL, '2024-07-29 08:56:56', '2024-07-29 09:02:45'),
(4, 'خطاطی', 'werite', NULL, NULL, 1, 'werite', NULL, NULL, NULL, NULL, '2024-07-29 08:57:14', '2024-07-29 08:57:14'),
(5, 'زبان', 'language', NULL, NULL, NULL, 'language', NULL, NULL, NULL, NULL, '2024-07-29 09:03:10', '2024-07-29 09:03:10'),
(6, 'ورزش', 'sport', NULL, NULL, NULL, 'sport', NULL, NULL, NULL, NULL, '2024-07-29 09:14:39', '2024-07-29 09:14:39'),
(7, 'پینگ پنگ', 'table-tenis', NULL, NULL, 6, 'table-tenit', NULL, NULL, NULL, NULL, '2024-07-29 09:14:54', '2024-07-29 09:15:13'),
(8, 'تنیس', 'tenis', NULL, NULL, 6, 'tenis', NULL, NULL, NULL, NULL, '2024-07-29 09:15:24', '2024-07-29 09:15:49'),
(9, 'شطرنج', 'chest', NULL, NULL, 6, 'chest', NULL, NULL, NULL, NULL, '2024-07-29 09:15:31', '2024-07-29 09:16:00'),
(10, 'کامپیوتر', 'computer', NULL, NULL, NULL, 'computer', NULL, NULL, NULL, NULL, '2024-07-29 09:16:14', '2024-07-29 09:16:14'),
(11, 'هوش مصنوعی', 'ai', NULL, NULL, 10, 'ai', NULL, NULL, NULL, NULL, '2024-07-29 09:16:25', '2024-07-29 09:16:32'),
(12, 'ای سی دی ال', 'acdl', NULL, NULL, 10, 'acdl', NULL, NULL, NULL, NULL, '2024-07-29 09:16:49', '2024-07-29 09:16:49'),
(13, 'برنامه نویسی', 'porgraming', NULL, NULL, 10, 'porgraming', NULL, NULL, NULL, NULL, '2024-07-29 09:16:59', '2024-07-29 09:17:11'),
(14, 'انگلیسی', 'en', NULL, NULL, 5, 'en', NULL, NULL, NULL, NULL, '2024-07-29 09:17:27', '2024-07-29 09:17:51'),
(15, 'آلمانی', 'gertmany', NULL, NULL, 5, 'gertmany', NULL, NULL, NULL, NULL, '2024-07-29 09:17:43', '2024-07-29 09:17:43'),
(16, 'مهارت های اجتماعی', 'social', NULL, NULL, NULL, 'social', NULL, NULL, NULL, NULL, '2024-07-29 09:22:53', '2024-07-29 09:22:53'),
(17, 'سیاه قلم', 'siyah Ghalam', NULL, NULL, 3, 'siyah-Ghalam', NULL, NULL, NULL, NULL, '2024-07-29 09:51:17', '2024-07-29 09:51:17'),
(18, 'طراحی پرتره', 'porteait', NULL, NULL, 3, 'porteait', NULL, NULL, NULL, NULL, '2024-07-29 09:51:42', '2024-07-29 09:51:42'),
(19, 'نقاشی با مداد رنگی', 'medad rangi', NULL, NULL, 3, 'medad-rangi', NULL, NULL, NULL, NULL, '2024-07-29 09:51:52', '2024-07-29 09:52:15'),
(20, 'پیانو', 'piani', NULL, NULL, 2, 'piani', NULL, NULL, NULL, NULL, '2024-07-29 09:52:38', '2024-07-29 09:52:48'),
(21, 'گیتار', 'giutar', NULL, NULL, 2, 'giutar', NULL, NULL, NULL, NULL, '2024-07-29 09:53:01', '2024-07-29 09:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `category_course`
--

DROP TABLE IF EXISTS `category_course`;
CREATE TABLE IF NOT EXISTS `category_course` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_course_category_id_foreign` (`category_id`),
  KEY `category_course_course_id_foreign` (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_course`
--

INSERT INTO `category_course` (`id`, `category_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(3, 19, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `age_from` int DEFAULT NULL,
  `age_to` int DEFAULT NULL,
  `class_duration` int DEFAULT NULL,
  `weeks` int DEFAULT NULL,
  `minutes` int DEFAULT NULL,
  `capacity` bigint UNSIGNED DEFAULT NULL,
  `price` bigint UNSIGNED DEFAULT NULL,
  `discount_price` bigint UNSIGNED DEFAULT NULL,
  `homework` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_teacher_id_foreign` (`teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `type`, `image`, `description`, `teacher_id`, `age_from`, `age_to`, `class_duration`, `weeks`, `minutes`, `capacity`, `price`, `discount_price`, `homework`, `status`, `is_draft`, `slug`, `meta_title`, `meta_keywords`, `meta_description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'رنگ آمیزی کودکان', 'online', '/storage/photos/1/colouringingovernessaustralia.jpg', '<p>این کلاس بسیار بسیار میفید هست.&nbsp;</p><p>خلاقیت رو افزایش میده.&nbsp;</p><p>عجله کنید تا ظرفیت تموم نشده!</p>', 2, 4, 8, 12, 2, 30, 24, 220000, NULL, 'تکلیف ها به صورت فردی در تلگرام استاد به صورت هفتگی ارسال میشود.', 'در انتظار تایید اولیه', 0, 'رنگ-آمیزی-کودکان', NULL, NULL, NULL, NULL, '2024-07-30 08:29:14', '2024-07-30 08:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `course_schedules`
--

DROP TABLE IF EXISTS `course_schedules`;
CREATE TABLE IF NOT EXISTS `course_schedules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint UNSIGNED NOT NULL,
  `schedule_id` bigint UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_schedules_course_id_foreign` (`course_id`),
  KEY `course_schedules_schedule_id_foreign` (`schedule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_17_155552_create_tokens_table', 1),
(5, '2024_07_29_120332_create_categories_table', 2),
(10, '2024_07_29_214042_create_courses_table', 3),
(13, '2024_07_29_371158_create_part_times_table', 4),
(14, '2024_07_30_164425_create_course_schedules_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `part_times`
--

DROP TABLE IF EXISTS `part_times`;
CREATE TABLE IF NOT EXISTS `part_times` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `part_times_course_id_foreign` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HEKLhODkrwQy2IoQKtdyycfTmhH1CJlPC52aQ40u', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVBVcElPRlFJUlVja3o4YmpZWnp6UUtOcE5QMlVxOElFWDVEOEtNSiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvdXJzZXMvc2NoZWR1bGVzLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722362446),
('QNU0hRLDSRzx5doIQbqNGViaa5125zmz5iF8E9Y0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR283VEJmRTJZNVF0NjNOSllxMnRiZkhhZ0hwQzdiZjZqWXh0NHlLcyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NhdGVnb3J5LzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722374579),
('awJR9fzOqSecKTnta4MLVgaG1EzkHJSxXACdwSkg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRnpLcExhWGhWQ0tYUERjSjNrNURSMXJSREE4TlBGck1rMzNUbVNWNCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1722446234),
('et3YU4POD6B5BFSJyvZzMxyI3UkqgLSv5xtqsYL5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVZNa3haTDBjVzlSRGl2TU4wTXU0c1F4Y2hNRVdEb2pYSzIwSlVoTCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1722446234),
('kiaFvQEE5hD5gIqIAhiBVFhuZPDij8Uk1FAwjprI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNjdRajFYY1JJWG9Db0N0c0pxa1V4b2FVaVNEU1c1eXVyelFGdHBoOCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2ZpbGVtYW5hZ2VyP3R5cGU9aW1hZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722298263),
('Fhct1Pf0swt2ZehcUBjB7CzrjjZ8UeGuFI0AOMaP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVjhoeHlTWG5xb2F3R0FxVnpHSmlmN2FCUWxncVpoY1NiWGlabE5MeSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvdXJzZXMvMS9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJhbGVydCI7YTowOnt9fQ==', 1722345733),
('gm4e8i7gRAo3lFWY0pU4xxpYs2xntM0Z8tz1KAFW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSDZ1NGpRenNrMkNWdk4yRWxid0dZM211c0FvN3JmeW1hdnZlcTN2OCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvdXJzZXMvc2NoZWR1bGVzLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722449838),
('YEzGrH5pF48wHeYPIV0S055Kq3QbJY2quSiLZ5d3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMEFRRE9SRmhMemo2dkpVcHI0TUEwY1VOVEZLWkNVcEN6dkRXSFRJbiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvdXJzZXMvc2NoZWR1bGVzLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6ImFsZXJ0IjthOjA6e319', 1722593570);

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED DEFAULT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tokens_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `type`, `code`, `phone`, `user_id`, `used`, `created_at`, `updated_at`) VALUES
(1, 'register', '8124', NULL, NULL, 0, '2024-07-27 20:37:08', '2024-07-27 20:37:08'),
(2, 'register', '3956', NULL, NULL, 0, '2024-07-27 20:38:03', '2024-07-27 20:38:03'),
(3, 'register', '7198', 'register', NULL, 0, '2024-07-27 20:39:27', '2024-07-27 20:39:27'),
(4, 'register', '6867', '09352973455', NULL, 0, '2024-07-27 20:40:49', '2024-07-27 20:40:49'),
(5, 'register', '8394', '09352973455', NULL, 0, '2024-07-27 20:49:41', '2024-07-27 20:49:41'),
(6, 'register', '2639', '09352973455', NULL, 0, '2024-07-27 20:50:10', '2024-07-27 20:50:10'),
(7, 'register', '3911', '09352973455', NULL, 0, '2024-07-27 20:57:14', '2024-07-27 20:57:14'),
(8, 'register', '2900', '09352973455', NULL, 0, '2024-07-27 20:57:35', '2024-07-27 20:57:35'),
(9, 'register', '2097', '09352973455', NULL, 0, '2024-07-27 20:58:11', '2024-07-27 20:58:11'),
(10, 'register', '4476', '09352973455', NULL, 0, '2024-07-27 21:00:10', '2024-07-27 21:00:10'),
(11, 'register', '1253', '09352973455', NULL, 0, '2024-07-27 21:01:50', '2024-07-27 21:01:50'),
(12, 'register', '1679', '09352973455', NULL, 0, '2024-07-27 21:02:08', '2024-07-27 21:02:08'),
(13, 'register', '1007', '09352973455', NULL, 0, '2024-07-27 21:04:46', '2024-07-27 21:04:46'),
(14, 'register', '8042', '09352973455', NULL, 0, '2024-07-27 21:19:11', '2024-07-27 21:19:11'),
(15, 'register', '1499', '09352973455', NULL, 0, '2024-07-27 21:20:06', '2024-07-27 21:20:06'),
(16, 'register', '4091', '09352973455', NULL, 0, '2024-07-27 21:20:44', '2024-07-27 21:20:44'),
(17, 'register', '9291', '09352973455', NULL, 0, '2024-07-27 21:22:53', '2024-07-27 21:22:53'),
(18, 'register', '8889', '09352973455', NULL, 1, '2024-07-27 21:23:46', '2024-07-27 21:23:55'),
(19, 'register', '1584', '09352973455', NULL, 1, '2024-07-27 21:26:02', '2024-07-27 21:26:11'),
(20, 'login', '9317', NULL, 1, 0, '2024-07-27 21:27:21', '2024-07-27 21:27:21'),
(21, 'login', '5944', NULL, 1, 0, '2024-07-27 21:28:41', '2024-07-27 21:28:41'),
(22, 'login', '3277', NULL, 1, 0, '2024-07-27 21:29:22', '2024-07-27 21:29:22'),
(23, 'login', '3721', NULL, 1, 0, '2024-07-27 21:30:35', '2024-07-27 21:30:35'),
(24, 'login', '1595', '09352973455', 1, 1, '2024-07-27 21:31:59', '2024-07-27 21:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
  `nationalCode` int DEFAULT NULL,
  `birthday` text COLLATE utf8mb4_unicode_ci,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `postalCode` int DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `gender`, `phone`, `email`, `is_teacher`, `nationalCode`, `birthday`, `address`, `postalCode`, `avatar`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'امیرعلی', 'نیّرزاده نوری', 'male', '09352973455', 'amiralinayerzadeh@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$2kCVWRjclxcSel5jHSB4z.jmzvg3393kvLcQo1.vUlwcV/GD0Op.2', 1, 'da7GEuCmXNyGE78NJ028gn88eAtnygsCIJqxNLe0R4tKxSzdJwU8Cl6L74Xv', '2024-07-27 21:26:11', '2024-07-29 08:20:10'),
(2, 'ماریا', 'حجازی فر', 'female', '09021104699', 'hejazifarmaria@gmail.com', 1, NULL, '2000-08-02', NULL, NULL, '/storage/photos/1/avatar/photo_2023-04-03_11-55-02.jpg', NULL, '$2y$12$HO9ntCKRGVgE/o/04LaLruLH0CcGDahkWpUso0PUtsSas/GXiLZEG', 0, NULL, '2024-07-28 10:31:02', '2024-07-30 08:45:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
