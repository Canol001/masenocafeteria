-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cafe
CREATE DATABASE IF NOT EXISTS `cafe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cafe`;

-- Dumping structure for table cafe.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Main Dish',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cafe.menu_items: ~13 rows (approximately)
INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image`, `created_at`, `category`) VALUES
	(1, 'Vegetable Samosa', 'Crispy pastry filled with spiced vegetables', 50.00, 'images/samosa.jpg', '2025-04-26 09:22:49', 'Snack'),
	(2, 'Beef Pilau', 'Fragrant rice with tender beef', 200.00, 'images/pilau.jpeg', '2025-04-26 09:22:49', 'Main Dish'),
	(3, 'Fish Fingers', 'Crispy fried fish fingers served with tartar sauce', 150.00, 'images/biriani.jpeg', '2025-04-26 09:25:19', 'Snack'),
	(4, 'Grilled Chicken', 'Juicy grilled chicken with herb marinade', 250.00, 'images/kuku.jpeg', '2025-04-26 09:25:19', 'Main Dish'),
	(5, 'Ugali Omena', 'All the way from the luo lakesides', 100.00, 'images/ugali_omena.jpeg', '2025-04-26 09:25:19', 'Main Dish'),
	(6, 'French Fries', 'Golden crispy potato fries', 80.00, 'images/hero-delicous.jpg', '2025-04-26 09:25:19', 'Snack'),
	(7, 'Beef Burger', 'Classic beef burger with cheese and lettuce', 200.00, 'images/pilau nyama.jpeg', '2025-04-26 09:25:19', 'Main Dish'),
	(8, 'Fruit Salad', 'Fresh mix of seasonal fruits', 70.00, 'images/mango.jpeg', '2025-04-26 09:25:19', 'Snack'),
	(9, 'Chapati and Beans', 'Soft chapatis served with spicy beans', 120.00, 'images/chapati_beans.jpg', '2025-04-26 09:25:19', 'Main Dish'),
	(10, 'Pancakes', 'Fluffy pancakes served with syrup', 100.00, 'images/pancakes.jpg', '2025-04-26 09:25:19', 'Snack'),
	(11, 'Roast Beef', 'Tender roast beef served with gravy', 300.00, 'images/roast_beef.jpeg', '2025-04-26 09:25:19', 'Main Dish'),
	(12, 'Chicken Wings', 'Spicy and crispy chicken wings', 170.00, 'images/chicken_wings.jpg', '2025-04-26 09:25:19', 'Snack'),
	(13, 'Ugali Samaki', 'Delicious Tilapia from HomaBay Luoland', 300.00, 'images/fish.jpg', '2025-04-26 13:25:18', 'Main Dish');

-- Dumping structure for table cafe.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cafe.orders: ~0 rows (approximately)

-- Dumping structure for table cafe.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `menu_item_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cafe.order_items: ~0 rows (approximately)

-- Dumping structure for table cafe.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('customer','admin') COLLATE utf8mb4_general_ci DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cafe.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
	(7, NULL, 'Moses Andrew', 'mosesbaraka606@gmail.com', '$2y$10$2MqlOysgGtKB3mI3RwLpSe/Rc/nis1ANC87tXpmNGpTHmWHLgrcki', '0798362136', 'customer', '2025-04-05 17:52:12'),
	(9, NULL, 'Moses Andrew', 'mosesbaraka66@gmail.com', '$2y$10$OUTObFOWJYqBQbUFepsZ4.N6fuv91if94wrOZk/gq4o42j7UjksxW', '0798362136', 'customer', '2025-04-05 17:55:00'),
	(10, NULL, 'Moses Andrew', 'mm@gmail.com', '$2y$10$jb1i3NK/N.dkuV3Vz7RJ3uH/aIMhSP/8dxnynvOj0pYMKYTBySUSi', '0741811118', 'customer', '2025-04-06 13:36:23'),
	(12, NULL, 'Moses Andrew', 'mm1@gmail.com', '$2y$10$jazWpEgYLRFvkKKaNACUPOMUsddhkPSqDYVMbzDRSCDDbpTSWTlWO', '0741811118', 'customer', '2025-04-06 14:48:16'),
	(13, 'Canol001', 'Owano Canol OKOTH', 'canolowana5@gmail.com', '$2y$10$bkt5YEXvKpl.cAauljaQJezKai9tQKwWsLWDYOOJcs9DQwsI7pKoS', '0790502670', 'customer', '2025-04-26 08:28:24'),
	(14, '', ' ', '', '$2y$10$KrBZq.7rYYb4PGi.ismC9OYqlbjhq0H/kPKs8ndCuOUDsTD93sIiq', '', 'customer', '2025-04-26 09:34:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
