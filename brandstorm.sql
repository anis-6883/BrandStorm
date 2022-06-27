-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2022 at 08:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brandstorm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_order` int(11) NOT NULL DEFAULT 0,
  `category_status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_order`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Digital Marketing', 1, 'Active', '2022-06-27 11:49:17', '2022-06-27 11:51:40'),
(2, 'Print Media', 2, 'Active', '2022-06-27 11:49:35', '2022-06-27 11:51:38'),
(3, 'Bill Board', 3, 'Active', '2022-06-27 11:50:58', '2022-06-27 11:51:36'),
(4, 'TV', 4, 'Active', '2022-06-27 11:51:13', '2022-06-27 11:51:35'),
(5, 'Radio', 5, 'Active', '2022-06-27 11:51:27', '2022-06-27 11:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_16_100627_create_categories_table', 1),
(6, '2022_06_23_094031_create_subcategories_table', 1),
(7, '2022_06_23_111708_create_packages_table', 1),
(8, '2022_06_23_193153_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `discount_coupon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` double(8,2) DEFAULT NULL,
  `before_discount` double(8,2) DEFAULT NULL,
  `total_cost` double(8,2) NOT NULL,
  `order_status` enum('Ordered','Pending','Processing','Completed','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ordered',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `package_id`, `user_id`, `payment_type`, `payment_method`, `transaction_id`, `currency`, `invoice_no`, `order_date`, `discount_coupon`, `discount_amount`, `before_discount`, `total_cost`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Cash', 'Cash', 'BRANDSTORM_62b94a927024f18762', 'Doller', 'INVOICE_62b94a927026845976', '2022-06-27 12:13:38', NULL, NULL, NULL, 250.00, 'Pending', '2022-06-27 12:13:34', '2022-06-27 12:13:38'),
(2, 4, 2, 'Cash', 'Cash', 'BRANDSTORM_62b94a9c186a299054', 'Doller', 'INVOICE_62b94a9c186b944501', '2022-06-27 12:13:48', NULL, NULL, NULL, 450.00, 'Pending', '2022-06-27 12:13:45', '2022-06-27 12:13:48'),
(3, 1, 2, 'Cash', 'Cash', 'BRANDSTORM_62b94aa7c17c657386', 'Doller', 'INVOICE_62b94aa7c183958584', '2022-06-27 12:13:59', NULL, NULL, NULL, 300.00, 'Pending', '2022-06-27 12:13:55', '2022-06-27 12:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `package_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_cost` double(8,2) NOT NULL,
  `subscription_type` enum('Daily','Weekly','Monthly','Yearly') COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_discount_pct` int(11) DEFAULT NULL,
  `discount_start_date` datetime DEFAULT NULL,
  `discount_end_date` datetime DEFAULT NULL,
  `duration_hour` int(11) DEFAULT NULL,
  `reach_head` int(11) DEFAULT NULL,
  `print_ad_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billboard_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_order` int(11) NOT NULL DEFAULT 0,
  `package_status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `subcategory_id`, `package_title`, `package_slug`, `package_summary`, `package_description`, `package_cost`, `subscription_type`, `package_image`, `package_discount_pct`, `discount_start_date`, `discount_end_date`, `duration_hour`, `reach_head`, `print_ad_size`, `billboard_location`, `video_length`, `package_order`, `package_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Facebook Basic Plan', 'facebook-basic-paln-62b947e6818fb606953', '<p><span style=\"font-family: \'open sans\', sans-serif; font-size: 18px; text-align: center; background-color: #ffffff;\">Digital Marketing is an umbrella term for ultra-modern marketing techniques that utilize the internet and online-based digital technologies to sell products and services. It\'s about targeting the right audience at the right time and right moment to produce the right outcomes.</span></p>', '<ul>\r\n<li>Dedicated Digital Marketing Expert</li>\r\n<li>Keyphrases optimized up to 100</li>\r\n<li>Pages Optimized up to 20</li>\r\n<li>Competitor rankings, content, and link monitoring</li>\r\n<li>Google Data Studio Reporting Dashboard Setup up to 4</li>\r\n<li>Ongoing earned media and content marketing assets up to 1</li>\r\n</ul>', 300.00, 'Daily', 'PACKAGE_62b947e6829b9333820_The-Importance-Of-Facebook-Marketing-In-The-Digital-World.jpg', 10, '2022-06-01 00:00:00', '2022-06-30 00:00:00', 15, 100, NULL, NULL, NULL, 0, 'Active', '2022-06-27 12:02:14', '2022-06-27 12:02:14'),
(2, 2, 'YouTube Basic Plan', 'youtube-basic-plan-62b94832f1a16741217', '<p><span style=\"font-family: \'open sans\', sans-serif; font-size: 18px; text-align: center; background-color: #ffffff;\">Digital Marketing is an umbrella term of ultra-modern marketing techniques that utilize the internet and online-based digital technologies to sell products and services. It\'s about targeting the right audience at the right time and right moment to produce the right outcomes.</span></p>', '<ol>\r\n<li>Dedicated Digital Marketing Expert</li>\r\n<li>Keyphrases optimized up to 100</li>\r\n<li>Pages Optimized up to 20</li>\r\n<li>Competitor rankings, content, and link monitoring</li>\r\n<li>Google Data Studio Reporting Dashboard Setup up to 4</li>\r\n<li>Ongoing earned media and content marketing assets up to 1</li>\r\n</ol>', 400.00, 'Weekly', 'PACKAGE_62b94832f1a4d134995_YouTube-marketing-strategy.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Active', '2022-06-27 12:03:31', '2022-06-27 12:03:31'),
(3, 3, 'SEO Standard Plan', 'seo-standard-plan-62b94882e4b90724570', '<p><span style=\"font-family: \'open sans\', sans-serif; font-size: 18px; text-align: center; background-color: #ffffff;\">Digital Marketing is an umbrella term of ultra-modern marketing techniques that utilize the internet and online-based digital technologies to sell products and services. It\'s about targeting the right audience at the right time and right moment to produce the right outcomes.</span></p>', '<ol>\r\n<li>Dedicated Digital Marketing Expert</li>\r\n<li>Keyphrases optimized up to 100</li>\r\n<li>Pages Optimized up to 20</li>\r\n<li>Competitor rankings, content, and link monitoring</li>\r\n<li>Google Data Studio Reporting Dashboard Setup up to 4</li>\r\n<li>Ongoing earned media and content marketing assets up to 1</li>\r\n</ol>', 250.00, 'Monthly', 'PACKAGE_62b94882e4bbf298533_1603954182-seo-article-header.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Active', '2022-06-27 12:04:50', '2022-06-27 12:04:50'),
(4, 4, 'Page Optimization Basic Plan', 'page-optimization-basic-plan-62b948c04d78f602507', '<p><span style=\"font-family: \'open sans\', sans-serif; font-size: 18px; text-align: center; background-color: #ffffff;\">Digital Marketing is an umbrella term of ultra-modern marketing techniques that utilize the internet and online-based digital technologies to sell products and services. It\'s about targeting the right audience at the right time and right moment to produce the right outcomes.</span></p>', '<ol>\r\n<li>Dedicated Digital Marketing Expert</li>\r\n<li>Keyphrases optimized up to 100</li>\r\n<li>Pages Optimized up to 20</li>\r\n<li>Competitor rankings, content, and link monitoring</li>\r\n<li>Google Data Studio Reporting Dashboard Setup up to 4</li>\r\n<li>Ongoing earned media and content marketing assets up to 1</li>\r\n</ol>', 450.00, 'Weekly', 'PACKAGE_62b948c04d825206745_page-speed-optimization-PageSpeed-shutterstock_504546391-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Active', '2022-06-27 12:05:52', '2022-06-27 12:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `subcategory_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_status`, `subcategory_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Facebook Marketing', 'Active', 1, '2022-06-27 11:53:47', '2022-06-27 11:53:54'),
(2, 1, 'YouTube Marketing', 'Active', 2, '2022-06-27 11:54:12', '2022-06-27 11:58:28'),
(3, 1, 'SEO Marketing', 'Active', 3, '2022-06-27 11:54:29', '2022-06-27 11:58:27'),
(4, 1, 'Page Optimization', 'Active', 4, '2022-06-27 11:54:48', '2022-06-27 11:58:26'),
(5, 2, 'Newspaper', 'Active', 1, '2022-06-27 11:55:10', '2022-06-27 11:58:22'),
(6, 2, 'Magazine', 'Active', 2, '2022-06-27 11:55:28', '2022-06-27 11:58:25'),
(7, 3, 'Analog Bill Board', 'Active', 1, '2022-06-27 11:55:55', '2022-06-27 11:58:20'),
(8, 3, 'Digital Bill Board', 'Active', 0, '2022-06-27 11:56:13', '2022-06-27 11:58:19'),
(9, 4, 'BTV', 'Active', 1, '2022-06-27 11:56:53', '2022-06-27 11:58:18'),
(10, 4, 'NTV', 'Active', 2, '2022-06-27 11:57:13', '2022-06-27 11:58:17'),
(11, 5, 'Radio FM', 'Active', 1, '2022-06-27 11:57:41', '2022-06-27 11:58:16'),
(12, 5, 'Radio Foorti', 'Active', 2, '2022-06-27 11:58:02', '2022-06-27 11:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `user_type` enum('Regular','Admin','Manager') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Regular',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(31) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `user_status`, `user_type`, `address`, `mobile`, `dob`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin6883', 'admin6883@email.com', NULL, '$2y$10$P/uoPqQExNIXdhoRKgv77uY9T7YCcCbbsCjfHpXkiF6RKutdNuWTy', 'Active', 'Admin', NULL, NULL, NULL, NULL, 'RANDOM_62b9446b5fd87859153_TOKEN', '2022-06-27 11:47:23', '2022-06-27 11:47:23'),
(2, 'test6883', 'test6883@email.com', NULL, '$2y$10$gcTuGQUv/wtwAL3mvhb1pujN8EdvntHKhXL6lMzDo7aT8pq70X9Qq', 'Active', 'Regular', NULL, NULL, NULL, NULL, 'RANDOM_62b944a361425405077_TOKEN', '2022-06-27 11:48:19', '2022-06-27 11:48:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_package_id_foreign` (`package_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id_subcategory_name_unique` (`category_id`,`subcategory_name`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
