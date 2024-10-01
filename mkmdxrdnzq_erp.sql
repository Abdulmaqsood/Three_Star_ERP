-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2024 at 05:18 AM
-- Server version: 10.6.19-MariaDB-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mkmdxrdnzq_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address_1`, `address_2`, `city`, `province`, `postal_code`, `country`, `customer_id`, `created_at`, `updated_at`) VALUES
(7, 'address_1', 'address_2', 'lahore', 'Punjab', '121312', 'Pakistan', 1, '2024-06-28 09:23:55', '2024-08-01 10:06:10'),
(11, 'address_1', '123-A  Shalimar Housing Scheme', 'lahore', 'Punjab', '121312', 'Pakistan', 3, '2024-07-17 06:32:53', '2024-08-02 04:23:28'),
(15, 'address 1', 'address 2', 'dadw', 'asdawdw', '1231421', 'sadasdwa', 5, '2024-07-24 07:04:11', '2024-08-13 08:27:48'),
(19, 'sndhgsv', 'dha scheme', 'sialkot', 'Punjab', '24342', 'Pakistan', 79, '2024-08-13 11:31:02', '2024-08-15 08:21:40'),
(20, 'address 1', NULL, 'lahore', 'Punjab', '24352', 'Pakistan', 80, '2024-08-13 11:56:34', '2024-08-13 11:57:03'),
(21, 'shalimar', 'bahria', 'lahore', 'Punjab', '345667', 'Pakistan', 81, '2024-08-13 14:45:14', '2024-08-13 14:46:02'),
(22, '1696 St Clair Ave W, Toronto, ON, M6N 1J1', '1696', 'Toronto', 'Ontario', 'M6N 1J1', 'Canada', 82, '2024-08-15 08:20:53', '2024-08-15 08:20:53'),
(23, '1696 St Clair Ave East', NULL, 'Toronto', 'Ontario', 'M6N 1J1', 'Canada', 83, '2024-08-25 06:50:30', '2024-08-25 07:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@admin.com|182.185.182.212', 'i:2;', 1725559778),
('admin@admin.com|182.185.182.212:timer', 'i:1725559778;', 1725559778),
('admin@admin.com|39.34.109.43', 'i:1;', 1725876682),
('admin@admin.com|39.34.109.43:timer', 'i:1725876682;', 1725876682);

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
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Groceries & Pets', NULL, NULL, '2024-08-01 04:41:20', '2024-08-01 04:41:20'),
(2, 'Health & Beauty', NULL, NULL, '2024-08-01 04:41:35', '2024-08-01 04:41:35'),
(3, 'Men\'s Fashion', NULL, NULL, '2024-08-01 04:41:47', '2024-08-01 04:41:47'),
(4, 'Women\'s Fashion', NULL, NULL, '2024-08-01 04:42:07', '2024-08-01 04:42:07'),
(5, 'Mother & Baby', NULL, NULL, '2024-08-01 04:42:22', '2024-08-01 04:42:22'),
(6, 'Home & Lifestyle', NULL, NULL, '2024-08-01 04:42:36', '2024-08-01 04:42:36'),
(7, 'Electronic Devices', NULL, NULL, '2024-08-01 04:42:52', '2024-08-01 04:42:52'),
(8, 'Electronic Accessories', NULL, NULL, '2024-08-01 04:43:05', '2024-08-01 04:43:05'),
(9, 'TV & Home Appliances', NULL, NULL, '2024-08-01 04:43:19', '2024-08-01 04:43:19'),
(10, 'Sports & Outdoor', NULL, NULL, '2024-08-01 04:43:32', '2024-08-01 04:43:32'),
(11, 'Watches, Bags & Jewellery', NULL, NULL, '2024-08-01 04:43:46', '2024-08-01 04:43:46'),
(12, 'Automotive & Motorbike', NULL, NULL, '2024-08-01 04:43:58', '2024-08-01 04:43:58'),
(13, 'category update', NULL, NULL, '2024-08-13 15:24:39', '2024-09-06 17:32:07'),
(14, 'Garbage Bags', NULL, NULL, '2024-08-25 07:01:57', '2024-08-25 07:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `business_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `contact_number`, `email`, `registration_number`, `business_number`, `created_at`, `updated_at`) VALUES
(1, 'THREE STAR SAFETY, CLEANING AND GENERAL SUPPLIES', '1696 St. Clair Avenue West Toronto ON M6N 1J1', '4166561852', 'info@3star.ca', 'R108891862', '108891862 RT0001', '2024-08-08 06:53:51', '2024-08-08 06:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quickbook_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `cheque_print_name` varchar(255) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `business_number` varchar(255) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `quickbook_id`, `title`, `first_name`, `middle_name`, `last_name`, `email`, `suffix`, `company`, `display_name`, `phone_number`, `mobile_number`, `fax`, `other`, `website`, `cheque_print_name`, `terms`, `business_number`, `payment_method_id`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'customer Title', 'Usman', 'Ahsan', 'Ahsan', 'ahsan@ail.comAA', 'suffix', 'Techons', 'Justanotherpanel', '987654321', '98765432', '122455', 'other notes', 'sacascfs.com', 'Usama Ahsan', 'Net 10 Days', '056546845', 3, 'user-image1719584635121.jpeg', NULL, NULL, '2024-06-28 04:23:55', '2024-08-12 23:19:12'),
(3, '3', 'Testing Area', 'Testing', 'mid', 'Last', 'm@email.com', 'suffix', 'newCOmpany', 'Testing Update', '03051689848', '03051689848', '122455', 'other notes', 'sacascfs.com', 'Testing', 'null', '12345678', 2, 'user-image1721215972168.jpg', NULL, NULL, '2024-07-17 01:32:52', '2024-08-12 23:19:16'),
(5, '5', 'ANC', 'akram', 'ahmed', 'shabaz', 'tenantadas1@tenant.com', '65dg', 'Techlogix', 'Testing', '123456789034', '123456789034', '122455', 'other', 'website', 'anc abdul', 'null', '23421324', 2, 'user-image1721822651195.png', NULL, NULL, '2024-07-24 02:04:11', '2024-08-13 08:27:48'),
(79, '27', 'Salman Ibrahim', 'salman', 'mid', 'Ibrahimx2', 'sal@email.com', 'customer', 'LogicRack', 'Salman Ibrahim', '03051689845', '03051689845', '123123', 'Salman Ibrahim Description', 'sac.com', 'Salman Cheque', 'Net 30 Days', '040506076578', 4, NULL, NULL, NULL, '2024-08-13 11:31:02', '2024-08-15 08:21:40'),
(80, '28', 'developer', 'Mateen', NULL, 'Shahbaz', 'mateenshahbaz@gmail.com', '112233', 'Techons', 'tech', '1234567654', NULL, NULL, NULL, NULL, NULL, 'null', NULL, 3, NULL, NULL, NULL, '2024-08-13 11:56:34', '2024-08-13 12:05:29'),
(81, '29', 'Asad', 'Asad', 'aSAGHAR', 'Shahid', 'asad@example.com', 'customer', 'LogixGrid', 'Asad Shahid', '12876546712', '87512312389', '3456765', 'here Description', 'cors.com', 'Asad Shahid', 'Net 40 Days', '12312431223209', 1, NULL, NULL, NULL, '2024-08-13 14:45:14', '2024-08-13 14:46:02'),
(82, '30', 'three star fake', 'usama', NULL, 'mahmood', 'mahmood.usama@gmail.com', NULL, 'abc', 'abc', '123333333', NULL, NULL, NULL, NULL, 'Nunalink', 'Net 30 Days', NULL, 1, NULL, NULL, NULL, '2024-08-15 08:20:53', '2024-08-15 08:21:53'),
(83, '31', 'USAMA MAHMOOD', 'Usama', NULL, 'Mahmood', 'umahmood@3star.ca', NULL, 'Three Star Safety', 'UMahmood', '4166561852', NULL, NULL, NULL, NULL, 'Arshad Mahmood', 'Net 30 Days', '108891862', 2, NULL, NULL, NULL, '2024-08-25 06:50:30', '2024-08-25 06:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `customer_products`
--

CREATE TABLE `customer_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assign_price` decimal(8,2) NOT NULL,
  `profit` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_products`
--

INSERT INTO `customer_products` (`id`, `assign_price`, `profit`, `quantity`, `product_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 85000.00, '1114.29%', '10', 15, 32, '2024-09-05 12:46:09', '2024-09-05 22:27:26'),
(2, 2000.00, '11.11%', '0', 16, 33, '2024-09-05 18:49:33', '2024-09-05 18:49:33'),
(3, 8000.00, '14.29%', '10', 15, 33, '2024-09-05 18:49:33', '2024-09-05 18:49:33'),
(4, 2200.00, '22.22%', '0', 16, 30, '2024-09-05 22:42:11', '2024-09-05 22:42:11'),
(5, 2500.00, '38.89%', '0', 16, 34, '2024-09-06 08:07:14', '2024-09-06 08:07:51'),
(6, 10000.00, '42.86%', '10', 15, 34, '2024-09-06 08:07:14', '2024-09-07 07:14:52'),
(8, 2200.00, '22.22%', '0', 16, 35, '2024-09-06 16:40:53', '2024-09-06 16:40:53'),
(9, 900.00, '80.00%', 'Quis excepturi ut te', 17, 35, '2024-09-06 16:40:53', '2024-09-06 16:40:53'),
(11, 100.00, '150.00%', '4/cs', 18, 34, '2024-09-07 07:14:52', '2024-09-08 09:02:55'),
(12, 50000.00, '25.00%', '9', 19, 37, '2024-09-08 08:48:19', '2024-09-08 08:48:19'),
(13, 10000.00, '42.86%', '10', 15, 37, '2024-09-08 08:48:19', '2024-09-08 08:48:19'),
(14, 65.00, '62.50%', '4/cs', 18, 37, '2024-09-08 08:48:19', '2024-09-08 09:00:36'),
(15, 230.00, '52.32%', '5 Gallon/Pail', 22, 38, '2024-09-14 07:34:50', '2024-09-14 07:34:50'),
(16, 15.00, '87.50%', '4/cs', 20, 38, '2024-09-14 07:34:50', '2024-09-14 07:34:50'),
(17, 500.00, '25.00%', '4/sd', 17, 38, '2024-09-14 07:34:50', '2024-09-14 07:34:50'),
(18, 60.00, '50.00%', '4/cs', 18, 38, '2024-09-14 07:34:50', '2024-09-14 07:34:50');

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `sub_total` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit_price` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `sub_total` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `email`, `image`, `address`, `city`, `state`, `country`, `postal_code`, `contact_number`, `website`, `created_at`, `updated_at`) VALUES
(5, 'ManufacturerName', 'man@email.com', 'manufacturer-image1719581151146.jpeg', 'address,abc', 'city', 'pujab', 'pakis', '121312', '1234567890', 'sacascfs.com', '2024-06-28 08:25:51', '2024-08-01 07:00:00'),
(6, 'shhbaz ltd.', 'ma@email.com', 'manufacturer-image1719581856167.jpeg', 'address,abc', 'sahiwal', 'punjab', 'Pakistan', '121312', '1234567890', NULL, '2024-06-28 08:37:36', '2024-06-28 08:37:36'),
(7, 'akram corp.', 'ak@email.com', 'manufacturer-image1719581911160.png', 'abcd adedfasfs, 1234', 'Multan', 'punjab', 'Pakistan', '121312', '1234567890', NULL, '2024-06-28 08:38:31', '2024-08-13 12:03:56'),
(10, 'Abdul updte', 'abduk@gmail.com', NULL, 'adhs', 'lahire', 'ounjab', 'oakistan', 'hdh67', '08765433216', NULL, '2024-08-13 15:47:48', '2024-08-13 15:48:26'),
(11, 'Ever Eco', 'abc@gmail.com', NULL, '123 abc street', NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-25 07:04:37', '2024-08-25 07:04:37'),
(12, 'FORDIS', 'abc@fordis.com', NULL, '123 abc street', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 07:59:43', '2024-09-06 07:59:43'),
(13, 'Ashraf', 'ashraf@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 13:36:41', '2024-09-06 13:37:17');

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
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(10, '2024_06_25_072702_create_manufacturers_table', 4),
(11, '2024_06_25_072714_create_vendors_table', 5),
(14, '2024_06_26_071633_create_payment_methods_table', 7),
(23, '2024_06_26_070827_create_addresses_table', 14),
(36, '2024_07_05_111851_create_quick_books_tokens_table', 17),
(46, '2024_06_24_062652_create_categories_table', 24),
(47, '2024_06_24_063534_create_sub_categories_table', 25),
(50, '0001_01_01_000000_create_users_table', 26),
(61, '2024_08_08_111945_create_companies_table', 32),
(67, '2024_08_08_140127_create_shippings_table', 33),
(70, '2024_06_24_062348_create_products_table', 34),
(71, '2024_06_28_034846_create_customers_table', 35),
(75, '2024_08_12_100810_modify_shipping_id_nullable_in_invoices_table', 37),
(76, '2024_06_26_144532_create_customer_products_table', 38),
(77, '2024_07_01_123700_create_invoices_table', 39),
(78, '2024_07_01_132257_create_invoice_items_table', 39);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 'Cash Description', '2024-06-28 08:23:07', '2024-06-28 08:23:07'),
(2, 'Cheque', 'cheque description', '2024-06-26 03:21:30', '2024-06-28 08:26:44'),
(3, 'Credit Card', 'credit card description', '2024-06-26 03:21:58', '2024-06-26 03:21:58'),
(4, 'Debit Card', 'debit Card Descrioption', '2024-06-26 03:22:24', '2024-06-26 03:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quickbook_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `profit` varchar(255) NOT NULL,
  `pack` varchar(255) DEFAULT NULL,
  `vendor_code` varchar(255) DEFAULT NULL,
  `manufacturer_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manufacturer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `quickbook_id`, `sku`, `name`, `type`, `price`, `cost`, `profit`, `pack`, `vendor_code`, `manufacturer_code`, `description`, `category_id`, `sub_category_id`, `vendor_id`, `manufacturer_id`, `created_at`, `updated_at`) VALUES
(11, '15', 'SKU-01', 'PSR-V', 'Inventory', '9000', '7000', '22.22%', '10', 'ven-3423', 'man-211', NULL, 8, 14, 7, 6, '2024-09-05 11:10:41', '2024-09-09 11:45:19'),
(12, '16', 'band update', 'mateen', 'Inventory', '2000', '1800', '10.00%', '20', 'vne-323', 'man-1232131', NULL, 3, 10, 11, 12, '2024-09-05 18:47:49', '2024-09-09 11:37:02'),
(13, '17', 'new', 'Oleg Whitney', 'Inventory', '792', '400', '49.49%', '4/sd', 'Quia sequi et itaque', 'Ullamco neque adipis', NULL, 14, 2, 7, 7, '2024-09-05 22:24:49', '2024-09-09 11:47:23'),
(14, '18', '12346', 'Stride Neutral Cleaner', 'Inventory', '65', '40', '38.46%', '4/cs', NULL, NULL, NULL, 13, NULL, 6, 12, '2024-09-06 08:01:00', '2024-09-08 09:01:22'),
(15, '19', '90', 'Pixel', 'Inventory', '45000', '40000', '11.11%', '9', NULL, NULL, NULL, 7, NULL, 10, 6, '2024-09-06 17:06:45', '2024-09-09 11:44:38'),
(16, '20', '9876', 'neutral floor', 'Inventory', '10', '8', '20.00%', '4/cs', '', NULL, NULL, 11, NULL, NULL, NULL, '2024-09-08 08:49:26', '2024-09-08 08:49:26'),
(17, '21', 'abc-sku', 'Cricket Bat', 'Inventory', '4000', '3500', '12.50%', '100', 'ven-haroon', 'man-akram', NULL, 10, 13, 10, 7, '2024-09-09 12:24:42', '2024-09-09 12:32:11'),
(18, '22', '1000', 'Castleguard Floor Finish', 'Inventory', '219.99', '151', '31.36%', '5 Gallon/Pail', '5555', NULL, NULL, 14, 8, 14, 11, '2024-09-14 06:23:33', '2024-09-14 06:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `quick_books_tokens`
--

CREATE TABLE `quick_books_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `access_token` varchar(1000) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quick_books_tokens`
--

INSERT INTO `quick_books_tokens` (`id`, `access_token`, `refresh_token`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..6AqjLu6yiArX1FW_nRaOJw.Idka68iwvvJAMIUFbuCGJ7UJEIEfYDBm4JRtVGROvcWJn_UBDaXWF9lqZhXlVjmUT-KB-2pEskcZgrE1WX0mLZwwDUX_RJII9PIR08R5lYHuAbYq2LCD6MmN2Qw6aykW7397Epd9dU7m1vYqzaAu-ZGiiphICu9ZeLfopCL83egu_9A1taIwmtVp2x5wsrofzU4JPa2wJdLWrDaU9HnVWDsi_fpKDrFnbdothTf59gCRAcXbR7HrxwdzqdDOMEursPRrfox3b0skDG4RqpBd1rkVJmzDOSKf67seV08F3fe6JpdSw_m_RRyzVkHcdtU2KyC-YXVAbATbYX5WxLSzNEhbCfe1fpywqcm8rT7WPl54gI7P-vOs586nQrDHdM5-gMv3jkJISQgGY2A2OTyJRT68VNeD41Wcr3M2x-jY5MOmnEtLPuisSgtVE0vs8KDSyGqytlQXAb5kD1u0UwU_7z8wKxZE7xs5WIRs-FMKJh8-thFuuBc2ir_ysTnWquJDYQey6xWI2GI8tPkiW4P7WBx8tGMo75RAZC9cPFZcx33sJX5NZwLYoqKcAvLEKbN6LufDaGmKmsKxKiJIh8YLIi6f9ZUjAqY0g5h8d9zkuVOK33QZLpd8F-wyy0_8f-K1C7mvm0rR2QaX68du9fl25fXaIm6Nce3hbSjfs_UwiIuuuX3z5dOkIPhtpgmQycG4a4haGiysjS_zrPwyvUwM7lLJqqjSKayFVuuxgzw6sYQ.84-Y0qLqsW0f1UnPm7FtEA', 'AB11735006924zJY5l6XX61uOLzqDljQlf5KBbI8LEvGuSMNJc', '2024-09-14 04:53:09', '2024-08-13 12:38:37', '2024-09-14 08:53:09');

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
('26odzmm0wDm0OVBlwEuqDFyiSGifnc9pAvfvxTa8', NULL, '209.97.133.200', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFBCUllCU282MmJnUGhTTFZkV3FlR2Z0ZWJ5VnljY1puY3o5cFZVZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vdGVzdC50ZWNob25zLmNvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1726305250),
('7ErD1GOA26oM4FByjVrLd0Gd2GljulSBQPVuk8ry', NULL, '206.80.249.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0ZQd3FPZlZCR2Y5b3p5eFZVZ2hrZFRKeThxWkt2WDNheXZJNzNYRCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vYWRtaW4vYWRkL2ludm9pY2UiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726282574),
('bDBNNRpvnlDuqwP9qMW07ZxzqZfj8gXQIg034FE9', NULL, '182.189.69.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkw4NmVXZ1c4ZXJZRWpVZUJLbEN4aFpJT1drQWQxaElJZ2pNZkU5bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vdGVzdC50ZWNob25zLmNvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1726500123),
('BKf7w4S4EgXsx1W6gEs9oi7OiYOaULLRJyVImPku', NULL, '216.239.90.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOTdsd2pVUnNjbVRRWFNvNFlPSVlDdkVVT0E1dFN4amx4QTBkVzFnaSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vYWRtaW4vcHJvZHVjdHMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726280485),
('c4nczGmuz4Lu1Gpr9x2tJHhaBhZ5JTXk6xFXUwEV', NULL, '209.91.176.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibW1xQzBQalpkZ3dscHlXd0VhTkFJOWF5QlpYUHExMVA4U1RGZUdoWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vYWRtaW4vYWRkL3Byb2R1Y3QiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726280548),
('MBCKnKk2ijvp6hghrfEesgm1Xx6h0A1fy5P3Afa4', NULL, '216.239.90.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUhSWEZmRFZUZzNaNDlYQXlBT25YWTFWZ3owSXkxczNVenZqWG9kciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cHM6Ly90ZXN0LnRlY2hvbnMuY28vYWRtaW4vYWRkL2N1c3RvbWVyIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdGVzdC50ZWNob25zLmNvL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1726280726),
('qtsbe5e9EnZgmlzQRdox8onpVHZAwA3hfz8ZdG7F', 1, '174.95.65.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSXAzVEVMRktGTGxPSkV5VWpZUlJqOUhRSlhPSVNsS3IzRDlGRkhVSCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwczovL3Rlc3QudGVjaG9ucy5jby9hZG1pbi9hZGQvaW52b2ljZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1726289590);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `address`, `city`, `province`, `country`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'TSCC 1950/1958 The Mosaic', 'Toronto', 'Toronto ON M5S 2J6', 'Australia', 1, '2024-08-08 10:31:51', '2024-08-09 02:08:26'),
(2, 'TSCC 1950/1958 The Mosaic', 'Toronto', 'Toronto ON M5S 2J6', 'Canada', 1, '2024-08-09 06:53:08', '2024-08-09 06:53:08'),
(4, 'TSCC 1950/1958 The Mosaic', 'Toronto', 'Toronto ON M5S 2J6', 'Canada', 1, '2024-08-12 09:27:30', '2024-08-12 09:27:30'),
(5, '1696 St Clair Ave W, Toronto, ON, M6N 1J1', 'Toronto', 'Ontario', 'Canada', 83, '2024-08-25 22:55:41', '2024-08-25 22:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Breakfast, Choco & Snacks', NULL, NULL, '2024-08-01 05:10:18', '2024-08-01 05:10:18'),
(2, 'Beverages update', NULL, NULL, '2024-08-01 05:10:38', '2024-08-13 15:25:40'),
(3, 'Frozen Food', NULL, NULL, '2024-08-01 05:10:53', '2024-08-01 05:10:53'),
(4, 'Frozen Food', NULL, NULL, '2024-08-01 05:10:53', '2024-08-01 05:10:53'),
(5, 'Beauty Tools', NULL, NULL, '2024-08-01 05:11:14', '2024-08-01 05:11:14'),
(6, 'Beauty Tools', NULL, NULL, '2024-08-01 05:11:15', '2024-08-01 05:11:15'),
(7, 'Skin Care', NULL, NULL, '2024-08-01 05:11:29', '2024-08-01 05:11:29'),
(8, 'Hair Care', NULL, NULL, '2024-08-01 05:11:39', '2024-08-01 05:11:39'),
(9, 'Men\'s Care', NULL, NULL, '2024-08-01 05:12:09', '2024-08-01 05:12:09'),
(10, 'Personal Care', NULL, NULL, '2024-08-01 05:12:20', '2024-08-01 05:12:20'),
(11, 'Clothing & Acessories', NULL, NULL, '2024-08-01 05:12:52', '2024-08-01 05:12:52'),
(12, 'Laundary & Cleaning', NULL, NULL, '2024-08-01 05:13:12', '2024-08-01 05:13:12'),
(13, 'Smart watches', NULL, NULL, '2024-08-01 05:13:27', '2024-08-01 05:13:27'),
(14, 'Gaming Consoles', NULL, NULL, '2024-08-01 05:13:37', '2024-08-01 05:13:37'),
(15, 'Camera Accesories', NULL, NULL, '2024-08-01 05:13:59', '2024-08-01 05:13:59'),
(16, 'Black Garbage Bags', NULL, NULL, '2024-08-25 07:02:16', '2024-08-25 07:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','super_admin') NOT NULL DEFAULT 'admin',
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', 'super_admin', 'admin-image1722506753185.png', NULL, '$2y$12$Xp/NhDTKCEUchXTbSvMukuiSVQcPqY1KdIpvnsWT6k7QZw7wYbTLi', NULL, '2024-08-01 10:06:16', '2024-08-01 05:05:53'),
(3, 'ali Shahbaz', 'mateenshahbaz@gmail.com', 'super_admin', NULL, NULL, '$2y$12$aPkOvt3WmXgX.dmI19Bq4.NwonuEJlwbdRlW0kcg/C/dKw2yfs3cu', NULL, '2024-08-13 11:54:09', '2024-09-06 16:58:44'),
(5, 'Usama Mahmood', 'mahmood.usama@gmail.com', 'super_admin', NULL, NULL, '$2y$12$rQm/dnqa6oQYtf6Dydre4Ob3mtujVFDhBzhosx0/6I0fUYiK4yNnW', NULL, '2024-08-25 06:45:18', '2024-08-25 06:45:18'),
(6, 'Haroon', 'harron1@gmail.com', 'admin', NULL, NULL, '$2y$12$0MjdXSLOBGL/2UoaU/PQW.q1mFqUqMfPkNOfu2nfgvu6Yno5Qmqje', NULL, '2024-09-06 17:28:45', '2024-09-06 17:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `address`, `image`, `created_at`, `updated_at`) VALUES
(6, 'Ahmed Usama', 'ah@email.com', 'address,abc', 'vendor-image1719581712101.jpeg', '2024-06-28 08:35:12', '2024-09-06 13:10:56'),
(7, 'Waqas', 'wa@email.com', 'abcd adedfasfs, 1234', 'vendor-image1719581739119.png', '2024-06-28 08:35:39', '2024-06-28 08:35:39'),
(8, 'Rashid', 'ra@email.com', 'dadssdfsdfsf', 'vendor-image1719581776177.jpeg', '2024-06-28 08:36:16', '2024-06-28 08:36:16'),
(9, 'Bilal', 'bilal@gmail.com', 'street# 123 , abc', 'vendor-image1721647839194.jpg', '2024-07-22 06:30:39', '2024-07-22 06:30:39'),
(10, 'Haroon Shahbaz', 'haroon@gmail.com', 'Lahore 234', NULL, '2024-08-13 12:02:15', '2024-08-13 12:02:34'),
(11, 'EVER Eco', 'evereco@hotmail.com', '123 abc street', NULL, '2024-08-25 07:02:50', '2024-08-25 07:02:50'),
(14, 'R3 Redistribution', NULL, NULL, NULL, '2024-09-07 07:16:10', '2024-09-07 07:16:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_customer_id_foreign` (`customer_id`);

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `customer_products`
--
ALTER TABLE `customer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
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
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `products_manufacturer_id_foreign` (`manufacturer_id`);

--
-- Indexes for table `quick_books_tokens`
--
ALTER TABLE `quick_books_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `customer_products`
--
ALTER TABLE `customer_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quick_books_tokens`
--
ALTER TABLE `quick_books_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_manufacturer_id_foreign` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
