-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: odik_shop
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'hero',
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `badge_text` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (7,NULL,'banners/uSZjEIVVoCd1TXIFsRBQOqfJkwOPoUL0IcKItk3J.webp',NULL,'hero',0,1,'2026-08-20 02:56:40','2026-08-20 02:56:40',NULL,NULL,NULL),(8,NULL,'banners/EWc1Vl2FH4rIaYJr8LBingua3y9v1xpODnkHRJVs.webp',NULL,'hero',0,1,'2026-08-20 02:56:47','2026-08-20 02:56:47',NULL,NULL,NULL);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `show_on_home` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `name_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `promo_image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `show_in_nav` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name_bn` varchar(255) DEFAULT NULL,
  `show_on_home` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Electronics','electronics',NULL,NULL,'fa-solid fa-laptop',1,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','ইলেকট্রনিক্স',0),(2,NULL,'Mobile Accessories','mobile-accessories',NULL,NULL,'fa-solid fa-mobile-screen',2,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','মোবাইল অ্যাক্সেসরিজ',0),(3,NULL,'Kitchen Gadgets','kitchen-gadgets',NULL,NULL,'fa-solid fa-blender',3,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','কিচেন গ্যাজেট',0),(4,NULL,'Home Appliances','home-appliances',NULL,NULL,'fa-solid fa-tv',4,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','হোম অ্যাপ্লায়েন্স',0),(5,NULL,'Fans & Cooling Devices','fans-cooling',NULL,NULL,'fa-solid fa-fan',5,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','ফ্যান ও কুলিং ডিভাইস',0),(6,NULL,'Sports & Fitness','sports-fitness',NULL,NULL,'fa-solid fa-dumbbell',6,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','হেলথ্ ও স্পোর্টস',0),(7,NULL,'Tools & Hardware','tools-hardware',NULL,NULL,'fa-solid fa-screwdriver-wrench',7,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','টুলস ও হার্ডওয়্যার',0),(8,NULL,'Travel & Outdoor','travel-outdoor',NULL,NULL,'fa-solid fa-suitcase',8,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','ট্রাভেল ও আউটডোর',0),(9,NULL,'Fashion','fashion',NULL,NULL,'fa-solid fa-shirt',9,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','ফ্যাশন',0),(10,NULL,'Baby & Kids','baby-kids',NULL,NULL,'fa-solid fa-baby',10,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','বাচ্চাদের পণ্য',0),(11,NULL,'Personal Care','personal-care',NULL,NULL,'fa-solid fa-pump-soap',11,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','পার্সোনাল কেয়ার',0),(12,NULL,'Others','others',NULL,NULL,'fa-solid fa-ellipsis',12,0,0,'2026-08-07 06:40:33','2026-08-20 01:45:14','অন্যান্য',0),(13,NULL,'Electrical Hi-Tech','hi-tech',NULL,'images/1771399318-10.webp','fa-solid fa-microchip',1,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','ইলেকট্রিক্যাল হাই-টেক',1),(14,NULL,'Electrical Accessories','electrical-accessories',NULL,'images/1771399329-09.webp','fa-solid fa-plug',2,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','ইলেকট্রিক্যাল অ্যাক্সেসরিজ',1),(15,NULL,'Kitchen & Home Appliances','kitchen-home-appliances',NULL,'images/1771399295-08.webp','fa-solid fa-blender',3,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','কিচেন ও হোম অ্যাপ্লায়েন্স',1),(16,NULL,'RCCB & RCBO','rccb-rcbo',NULL,'images/1771399365-11.webp','fa-solid fa-shield-halved',4,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','আরসিসিবি ও আরসিবিও',1),(17,NULL,'Transfer Switch','transfer-switch',NULL,'images/1771399121-01.webp','fa-solid fa-arrows-rotate',5,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','ট্রান্সফার সুইচ',1),(18,NULL,'Green Energy','green-energy',NULL,'images/1774761744-ecoflow-delta-.webp','fa-solid fa-solar-panel',6,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','গ্রিন এনার্জি',1),(19,NULL,'Multi Plugs','multi-plugs',NULL,'images/1771399260-05.webp','fa-solid fa-plug-circle-bolt',7,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','মাল্টিপ্লাগ',1),(20,NULL,'Bulb & LED Lights','bulb-led-lights',NULL,'images/1771402591-02.webp','fa-solid fa-lightbulb',8,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','বাল্ব ও এলইডি লাইট',1),(21,NULL,'Distribution Box','distribution-box',NULL,'images/1771399187-03.webp','fa-solid fa-box',9,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','ডিস্ট্রিবিউশন বক্স',1),(22,NULL,'Test Board & Safety','test-board-safety',NULL,'images/1771399221-04.webp','fa-solid fa-screwdriver-wrench',10,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','টেস্ট বোর্ড ও সেফটি',1),(23,NULL,'Holders & Ceiling Rose','holders-ceiling-rose',NULL,'images/1771399245-06.webp','fa-solid fa-circle-dot',11,0,1,'2026-08-20 01:41:54','2026-08-20 01:45:14','হোল্ডার ও সিলিং রোজ',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_banners`
--

DROP TABLE IF EXISTS `category_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_banners_category_id_foreign` (`category_id`),
  CONSTRAINT `category_banners_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_banners`
--

LOCK TABLES `category_banners` WRITE;
/*!40000 ALTER TABLE `category_banners` DISABLE KEYS */;
INSERT INTO `category_banners` VALUES (2,1,'Electronics Banner','https://loremflickr.com/1200/320/electronics,gadgets?lock=10',NULL,0,1,'2026-08-16 03:40:33','2026-08-16 03:40:33'),(3,2,'Mobile Accessories Banner','https://loremflickr.com/1200/320/headphones?lock=11',NULL,0,1,'2026-08-16 03:40:33','2026-08-16 03:40:33'),(4,3,'Kitchen Gadgets Banner','https://loremflickr.com/1200/320/kitchen?lock=12',NULL,0,1,'2026-08-16 03:40:33','2026-08-16 03:40:33'),(5,4,'Home Appliances Banner','https://loremflickr.com/1200/320/appliances?lock=13',NULL,0,1,'2026-08-16 03:40:33','2026-08-16 03:40:33'),(6,6,'Sports & Fitness Banner','https://loremflickr.com/1200/320/fitness?lock=14',NULL,0,1,'2026-08-16 03:40:33','2026-08-16 03:40:33'),(7,7,'Tools & Hardware Banner','https://loremflickr.com/1200/320/tools?lock=15',NULL,0,1,'2026-08-16 03:40:33','2026-08-16 03:40:33'),(8,13,NULL,'category-banners/Q3CRPunrSehx5LvFSvB5qty9jrMzd8Bn2b7hqLXS.jpg',NULL,0,1,'2026-08-20 02:15:53','2026-08-20 02:15:53');
/*!40000 ALTER TABLE `category_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_03_000001_create_categories_table',1),(5,'2026_08_03_000002_create_products_table',1),(6,'2026_08_03_000003_create_product_images_table',1),(7,'2026_08_03_000004_create_banners_table',1),(8,'2026_08_03_000005_create_orders_table',1),(9,'2026_08_03_000006_create_order_items_table',1),(10,'2026_08_03_000007_create_site_settings_table',1),(11,'2026_08_05_103917_add_bilingual_names_to_categories_table',1),(12,'2026_08_05_120000_merge_raimart_features',1),(13,'2026_08_08_000001_create_product_reviews_table',2),(14,'2026_08_11_190105_create_contact_messages_table',3),(15,'2026_08_13_000001_add_mobile_banking_fields_to_orders_table',4),(16,'2026_08_16_000001_add_promo_image_to_categories_table',5),(17,'2026_08_16_000002_create_category_banners_table',5),(18,'2026_08_16_000003_create_option_requests_table',5),(19,'2026_08_16_000004_update_brand_site_settings',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_requests`
--

DROP TABLE IF EXISTS `option_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_requests_product_id_foreign` (`product_id`),
  CONSTRAINT `option_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_requests`
--

LOCK TABLES `option_requests` WRITE;
/*!40000 ALTER TABLE `option_requests` DISABLE KEYS */;
INSERT INTO `option_requests` VALUES (2,46,'Type-C Auto Eject Charging Protector','Abu','Khan','hosterex','mdabutaleb.dev@gmail.com','01622243011','Bangladesh','Dhaka','savar,Dhaka','1340','hhh','2026-08-20 02:17:53','2026-08-20 02:17:53'),(3,46,'Type-C Auto Eject Charging Protector','Abu','Khan','hosterex','mdabutaleb.dev@gmail.com',NULL,'Bangladesh',NULL,'savar,Dhaka','1340','ssss','2026-08-20 02:25:16','2026-08-20 02:25:16');
/*!40000 ALTER TABLE `option_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(10) unsigned NOT NULL DEFAULT 1,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,3,'ওয়্যারলেস মাউস',899.00,2,1798.00,'2026-08-10 07:20:04','2026-08-10 07:20:04','[]');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `division` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `thana` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_zone` varchar(255) NOT NULL DEFAULT 'inside_dhaka',
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_channel` varchar(255) DEFAULT NULL,
  `payment_sender_number` varchar(255) DEFAULT NULL,
  `payment_txn_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'RM260810K4TX5',1,'Odik Admin','01700000000',NULL,'রাজবাড়ী','রাজবাড়ী সদর','dubai',NULL,1798.00,60.00,1858.00,'inside_dhaka','cod',NULL,NULL,NULL,'unpaid','processing','2026-08-10 07:20:04','2026-08-10 07:20:35');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `pp_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `raw_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`raw_response`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,42,'products/ETwt95rHNQyS52sFK2R7AWJ7MBk4JeQrHbLlRBE5.jpg',1,'2026-08-10 07:31:29','2026-08-10 07:31:29'),(2,42,'products/E2m8PlwK6SNfMoQ05rF8ZkfE0mmZYSEjiUDOSzKf.jpg',2,'2026-08-10 07:31:29','2026-08-10 07:31:29'),(3,42,'products/5bd8t9Irenvl3VjF31iCq4l68vY8PmpAycVx4hHk.jpg',3,'2026-08-10 07:31:29','2026-08-10 07:31:29'),(4,42,'products/LefA5zgrXoSriQ6BRZFqXgnteRhm08lFVN2WCeqI.jpg',4,'2026-08-10 07:31:29','2026-08-10 07:31:29');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT 5,
  `comment` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `brand_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `old_price` decimal(10,2) DEFAULT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `sku` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT 0.0,
  `reviews_count` int(10) unsigned NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_flash_sale` tinyint(1) NOT NULL DEFAULT 0,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `top_selling` tinyint(1) NOT NULL DEFAULT 0,
  `main_image` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,NULL,'সেলফি স্টিক','selfie-stick-1','প্রিমিয়াম মানের সেলফি স্টিক। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Selfie%20Stick',599.00,999.00,100,'ODK-0001',4.0,1,0,1,1,0,1,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(2,1,NULL,'এলইডি ডেস্ক ল্যাম্প','led-desk-lamp-2','প্রিমিয়াম মানের এলইডি ডেস্ক ল্যাম্প। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=LED%20Desk%20Lamp',749.00,1200.00,100,'ODK-0002',4.0,3,0,1,0,0,2,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(3,1,NULL,'ওয়্যারলেস মাউস','wireless-mouse-3','প্রিমিয়াম মানের ওয়্যারলেস মাউস। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Wireless%20Mouse',899.00,1499.00,98,'ODK-0003',5.0,2,0,1,1,0,3,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(4,1,NULL,'পাওয়ার ব্যাংক','power-bank-4','প্রিমিয়াম মানের পাওয়ার ব্যাংক। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Power%20Bank',1299.00,2000.00,100,'ODK-0004',5.0,0,1,1,0,0,4,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(5,1,NULL,'ব্লুটুথ ইয়ারবাডস','earbuds-5','প্রিমিয়াম মানের ব্লুটুথ ইয়ারবাডস। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Earbuds',1599.00,2500.00,100,'ODK-0005',5.0,1,1,1,1,0,5,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(6,1,NULL,'স্মার্ট ওয়াচ GT3','smart-watch-6','প্রিমিয়াম মানের স্মার্ট ওয়াচ GT3। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Smart%20Watch',2499.00,3999.00,100,'ODK-0006',5.0,0,1,1,0,0,6,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(7,1,NULL,'স্মার্ট প্লাগ','smart-plug-7','প্রিমিয়াম মানের স্মার্ট প্লাগ। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Smart%20Plug',899.00,1300.00,100,'ODK-0007',4.0,2,0,0,1,0,7,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(8,1,NULL,'গার্মেন্টস স্টিমার','garment-steamer-8','প্রিমিয়াম মানের গার্মেন্টস স্টিমার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Garment%20Steamer',2999.00,4500.00,100,'ODK-0008',5.0,2,0,0,1,0,8,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(9,1,NULL,'হেডফোন','headphone-9','প্রিমিয়াম মানের হেডফোন। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Headphone',3499.00,5000.00,100,'ODK-0009',4.0,0,0,0,1,0,9,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(10,1,NULL,'গেমিং মাউস','gaming-mouse-10','প্রিমিয়াম মানের গেমিং মাউস। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Gaming%20Mouse',1299.00,1900.00,100,'ODK-0010',5.0,0,0,0,1,0,10,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(11,1,NULL,'গেমিং কীবোর্ড','gaming-keyboard-11','প্রিমিয়াম মানের গেমিং কীবোর্ড। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Gaming%20Keyboard',2499.00,3800.00,100,'ODK-0011',5.0,0,0,0,1,0,11,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(12,1,NULL,'সাউন্ড বার','sound-bar-12','প্রিমিয়াম মানের সাউন্ড বার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Sound%20Bar',5999.00,8500.00,100,'ODK-0012',4.0,0,1,0,1,0,12,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(13,1,NULL,'এলইডি টিভি ৩২\"','led-tv-32-13','প্রিমিয়াম মানের এলইডি টিভি ৩২\"। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=LED%20TV%2032',18999.00,25000.00,100,'ODK-0013',5.0,0,1,0,1,0,13,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(14,NULL,NULL,'মিক্সিং বোল','mixing-bowl-14','প্রিমিয়াম মানের মিক্সিং বোল। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Mixing%20Bowl',699.00,1000.00,100,'ODK-0014',5.0,11,0,0,1,0,14,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(15,NULL,NULL,'কিচেন টুলস','kitchen-tools-15','প্রিমিয়াম মানের কিচেন টুলস। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Kitchen%20Tools',999.00,1500.00,100,'ODK-0015',5.0,3,0,0,1,0,15,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(16,NULL,NULL,'স্টোরেজ কন্টেইনার','storage-box-16','প্রিমিয়াম মানের স্টোরেজ কন্টেইনার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Storage%20Box',799.00,1200.00,100,'ODK-0016',5.0,0,0,0,1,0,16,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(17,NULL,NULL,'ব্লেন্ডার জার','blender-jar-17','প্রিমিয়াম মানের ব্লেন্ডার জার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Blender%20Jar',1299.00,1900.00,100,'ODK-0017',5.0,0,0,0,1,0,17,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(18,NULL,NULL,'কাটলারি সেট','cutlery-set-18','প্রিমিয়াম মানের কাটলারি সেট। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Cutlery%20Set',1599.00,2400.00,100,'ODK-0018',4.0,0,0,0,1,0,18,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(19,NULL,NULL,'ফ্রাইং প্যান','frying-pan-19','প্রিমিয়াম মানের ফ্রাইং প্যান। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Frying%20Pan',2499.00,3800.00,100,'ODK-0019',5.0,0,0,0,1,0,19,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(20,NULL,NULL,'মিক্সার গ্রাইন্ডার','mixer-grinder-20','প্রিমিয়াম মানের মিক্সার গ্রাইন্ডার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Mixer%20Grinder',4599.00,6200.00,100,'ODK-0020',5.0,0,0,0,0,0,20,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(21,NULL,NULL,'এয়ার ফ্রায়ার','air-fryer-21','প্রিমিয়াম মানের এয়ার ফ্রায়ার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Air%20Fryer',6599.00,8999.00,100,'ODK-0021',5.0,0,1,0,0,0,21,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(22,NULL,NULL,'ইলেকট্রিক কেটলি','electric-kettle-22','প্রিমিয়াম মানের ইলেকট্রিক কেটলি। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Electric%20Kettle',1899.00,2800.00,100,'ODK-0022',5.0,0,0,0,0,0,22,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(23,NULL,NULL,'ডিজিটাল স্কেল','digital-scale-23','প্রিমিয়াম মানের ডিজিটাল স্কেল। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Digital%20Scale',999.00,1500.00,100,'ODK-0023',4.0,0,0,0,0,0,23,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(24,NULL,NULL,'বেবি সাবান','baby-soap-24','প্রিমিয়াম মানের বেবি সাবান। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Baby%20Soap',199.00,299.00,100,'ODK-0024',5.0,1,0,0,1,0,24,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(25,NULL,NULL,'বেবি টাওয়েল','baby-towel-25','প্রিমিয়াম মানের বেবি টাওয়েল। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Baby%20Towel',399.00,599.00,100,'ODK-0025',4.0,0,0,0,1,0,25,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(26,NULL,NULL,'বেবি ওয়াইপস','baby-wipes-26','প্রিমিয়াম মানের বেবি ওয়াইপস। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Baby%20Wipes',249.00,399.00,100,'ODK-0026',5.0,0,0,0,1,0,26,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(27,NULL,NULL,'বেবি লোশন','baby-lotion-27','প্রিমিয়াম মানের বেবি লোশন। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Baby%20Lotion',349.00,550.00,100,'ODK-0027',5.0,0,0,0,1,0,27,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(28,NULL,NULL,'বেবি ফুড','baby-food-28','প্রিমিয়াম মানের বেবি ফুড। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Baby%20Food',299.00,450.00,100,'ODK-0028',5.0,0,0,0,1,0,28,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(29,NULL,NULL,'বেবি ডায়াপার','baby-diaper-29','প্রিমিয়াম মানের বেবি ডায়াপার। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Baby%20Diaper',499.00,799.00,100,'ODK-0029',5.0,0,0,0,1,0,29,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(30,NULL,NULL,'তাজা ফল প্যাক','fruit-pack-30','প্রিমিয়াম মানের তাজা ফল প্যাক। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Fruit%20Pack',699.00,1000.00,100,'ODK-0030',4.0,0,0,0,1,0,30,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(31,NULL,NULL,'বিস্কুট কম্বো','biscuit-combo-31','প্রিমিয়াম মানের বিস্কুট কম্বো। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Biscuit%20Combo',349.00,500.00,100,'ODK-0031',4.0,0,0,0,1,0,31,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(32,NULL,NULL,'অলিভ অয়েল','olive-oil-32','প্রিমিয়াম মানের অলিভ অয়েল। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Olive%20Oil',1599.00,2200.00,100,'ODK-0032',5.0,0,0,0,1,0,32,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(33,NULL,NULL,'বাসমতি রাইস','basmati-rice-33','প্রিমিয়াম মানের বাসমতি রাইস। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Basmati%20Rice',899.00,1200.00,100,'ODK-0033',5.0,0,0,0,1,0,33,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(34,NULL,NULL,'মধু','honey-34','প্রিমিয়াম মানের মধু। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Honey',599.00,899.00,100,'ODK-0034',5.0,0,1,0,1,0,34,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(35,NULL,NULL,'প্রিমিয়াম চা','premium-tea-35','প্রিমিয়াম মানের প্রিমিয়াম চা। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Premium%20Tea',399.00,599.00,100,'ODK-0035',5.0,0,0,0,0,0,35,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(36,NULL,NULL,'খেজুর প্রিমিয়াম','premium-dates-36','প্রিমিয়াম মানের খেজুর প্রিমিয়াম। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Premium%20Dates',799.00,1100.00,100,'ODK-0036',5.0,0,0,0,0,0,36,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(37,NULL,NULL,'প্রিমিয়াম টি-শার্ট','t-shirt-37','প্রিমিয়াম মানের প্রিমিয়াম টি-শার্ট। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=T-Shirt',549.00,850.00,100,'ODK-0037',4.0,0,1,0,0,0,37,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(38,NULL,NULL,'ক্যাজুয়াল পাঞ্জাবি','panjabi-38','প্রিমিয়াম মানের ক্যাজুয়াল পাঞ্জাবি। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Panjabi',1299.00,1900.00,100,'ODK-0038',5.0,0,0,0,0,0,38,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(39,NULL,NULL,'ডেনিম জিন্স','denim-jeans-39','প্রিমিয়াম মানের ডেনিম জিন্স। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Denim%20Jeans',1499.00,2200.00,100,'ODK-0039',4.0,0,0,0,0,0,39,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(40,NULL,NULL,'ফরমাল শার্ট','formal-shirt-40','প্রিমিয়াম মানের ফরমাল শার্ট। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Formal%20Shirt',999.00,1500.00,100,'ODK-0040',5.0,0,0,0,0,0,40,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(41,NULL,NULL,'উইন্টার হুডি','winter-hoodie-41','প্রিমিয়াম মানের উইন্টার হুডি। ১০০% অরিজিনাল ও খাঁটি পণ্য। ক্যাশ অন ডেলিভারিতে সারা দেশে ডেলিভারি করা হয়।','https://placehold.co/600x600/e6f2f0/008060?text=Winter%20Hoodie',1199.00,1800.00,100,'ODK-0041',5.0,0,0,0,0,0,41,'2026-08-07 06:40:33','2026-08-20 01:56:05',0,0,0,NULL,NULL,NULL),(42,11,NULL,'Baby Collection','baby-collection-hpzk','<p>sss</p>',NULL,1200.00,1500.00,30,'uiuyu',5.0,17,1,1,0,0,0,'2026-08-10 07:24:19','2026-08-20 01:56:05',1,1,0,'products/7udA3GAKZb0oFmPF6uR1EvXFWcdBTJAcva9V7gPT.jpg','sasss','[]'),(43,13,NULL,'Surge Protective Device (SPD)-AC','surge-protective-device-spd-ac','<p>বজ্রপাত ও ভোল্টেজ সার্জ থেকে আপনার বৈদ্যুতিক যন্ত্রপাতি রক্ষা করে।</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</p>',NULL,1280.00,1650.00,100,'MET-0001',5.0,0,1,1,0,1,1,'2026-08-20 01:41:55','2026-08-20 01:56:05',1,1,0,'images/products/spd-ac.webp','বজ্রপাত ও ভোল্টেজ সার্জ থেকে আপনার বৈদ্যুতিক যন্ত্রপাতি রক্ষা করে।',NULL),(44,17,NULL,'Mini Automatic Transfer Switch (ATS)-63A 2P CNC','mini-automatic-transfer-switch-ats-63a-2p-cnc','<p>বিদ্যুৎ চলে গেলে স্বয়ংক্রিয়ভাবে জেনারেটর/ব্যাকআপ লাইনে সুইচ করে — ৬৩A, ২ পোল, CNC।</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</p>',NULL,4100.00,5500.00,100,'MET-0002',5.0,0,1,1,0,1,2,'2026-08-20 01:41:55','2026-08-20 01:56:05',1,1,0,'images/products/mini-ats-63a.webp','বিদ্যুৎ চলে গেলে স্বয়ংক্রিয়ভাবে জেনারেটর/ব্যাকআপ লাইনে সুইচ করে — ৬৩A, ২ পোল, CNC।',NULL),(45,18,NULL,'Solar Light-3 Modes','solar-light-3-modes','<p>সৌরবিদ্যুৎ চালিত ৩ মোড LED লাইট — রিমোট, মোশন সেন্সর ও ওয়াটারপ্রুফ।</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</p>',NULL,999.00,1450.00,100,'MET-0003',5.0,0,1,1,0,1,3,'2026-08-20 01:41:55','2026-08-20 01:56:05',1,1,0,'images/products/solar-light-3modes.webp','সৌরবিদ্যুৎ চালিত ৩ মোড LED লাইট — রিমোট, মোশন সেন্সর ও ওয়াটারপ্রুফ।',NULL),(46,13,NULL,'Type-C Auto Eject Charging Protector','type-c-auto-eject-charging-protector','<p>ফুল চার্জ হলে স্বয়ংক্রিয়ভাবে চার্জিং বন্ধ করে ব্যাটারি ও ডিভাইস সুরক্ষিত রাখে।</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</p>',NULL,999.00,1350.00,100,'MET-0004',5.0,0,1,1,0,1,4,'2026-08-20 01:41:55','2026-08-20 01:56:05',1,1,0,'images/products/type-c-protector.webp','ফুল চার্জ হলে স্বয়ংক্রিয়ভাবে চার্জিং বন্ধ করে ব্যাটারি ও ডিভাইস সুরক্ষিত রাখে।',NULL),(47,17,NULL,'Manual Transfer Switch (MTS)-63A','manual-transfer-switch-mts-63a','<p>মেইন ও জেনারেটর লাইনের মধ্যে নিরাপদে ম্যানুয়াল সুইচিং — ৬৩A।</p><p>১০০% অরিজিনাল পণ্য। সারা দেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</p>',NULL,1450.00,1700.00,100,'MET-0005',5.0,0,1,1,0,1,5,'2026-08-20 01:41:55','2026-08-20 01:56:05',1,1,0,'images/products/mts-63a.webp','মেইন ও জেনারেটর লাইনের মধ্যে নিরাপদে ম্যানুয়াল সুইচিং — ৬৩A।',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('VviHdY66bW5s6iYErtTB1fd13EPY9czBnjSSwt3V',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTDd2YTJTUFlrMVNDV3NqcXRqZEVkWFVURThLbTVuUjV5dVNUR3hCaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1787218061);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'site_name','METAIR ENTERPRISE','2026-08-07 06:40:33','2026-08-16 02:45:14'),(2,'site_tagline','অনলাইনে কেনাকাটা করুন','2026-08-07 06:40:33','2026-08-07 06:40:33'),(3,'topbar_text','ফ্রি ডেলিভারি ও ক্যাশ অন ডেলিভারি','2026-08-07 06:40:33','2026-08-07 06:40:33'),(4,'phone','01700-000000','2026-08-07 06:40:33','2026-08-07 06:40:33'),(5,'email','support@merairenterprice.com','2026-08-07 06:40:33','2026-08-20 02:38:52'),(6,'address','Dhaka, Bangladesh','2026-08-07 06:40:33','2026-08-12 03:18:31'),(7,'facebook','https://facebook.com','2026-08-07 06:40:33','2026-08-07 06:40:33'),(8,'instagram','https://instagram.com','2026-08-07 06:40:33','2026-08-07 06:40:33'),(9,'whatsapp','01700000000','2026-08-07 06:40:33','2026-08-07 06:40:33'),(10,'shipping_inside_dhaka','60','2026-08-07 06:40:33','2026-08-07 06:40:33'),(11,'shipping_outside_dhaka','120','2026-08-07 06:40:33','2026-08-07 06:40:33'),(12,'footer_text','METAIR ENTERPRISE — your trusted online shopping platform delivering quality products across Bangladesh.','2026-08-07 06:40:33','2026-08-16 02:45:14'),(13,'business_hours',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52'),(14,'youtube',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52'),(15,'tiktok',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52'),(16,'telegram',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52'),(17,'bkash_number',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52'),(18,'nagad_number',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52'),(19,'payment_instruction',NULL,'2026-08-20 02:38:52','2026-08-20 02:38:52');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT 5,
  `text` text NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Rahim Uddin','rahim@example.com','01711000000','Dhaka',NULL,5,'Great product and very fast delivery. Highly recommended!',1,1,NULL,NULL),(2,'Karim Hasan','karim@example.com','01811000000','Chittagong',NULL,5,'The customer service is excellent. I will buy from here again.',2,1,NULL,NULL),(3,'Sadia Islam','sadia@example.com','01911000000','Sylhet',NULL,4,'Good quality products at a reasonable price.',3,1,NULL,NULL);
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'METAIR Admin','admin@metairenterprise.com','01700000000',NULL,'$2y$12$OmAAYhCFTrlptxkV5X85H.RzASmfmNiKsAnfBvF/de9x5ZE8I5ONK',1,NULL,NULL,NULL,NULL,'2026-08-07 06:40:32','2026-08-20 03:27:39'),(2,'Demo User','user@odikshop.com','01800000000',NULL,'$2y$12$sEWDCDNPvtPoAkpV/TQ3Z.aTQXUzvvDFwTh5.MDfp57s0HnKo.quK',0,NULL,NULL,NULL,NULL,'2026-08-07 06:40:33','2026-08-07 06:40:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-20 15:27:57
