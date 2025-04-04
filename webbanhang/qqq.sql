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


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.account: ~2 rows (approximately)
INSERT INTO `account` (`id`, `username`, `fullname`, `password`, `role`) VALUES
	(3, 'hung', 'dung', '$2y$10$IRxk43AVwm.jV9RIU.q18uSj1sKRxi82YhVYNiqfSyP.diRIQRUZa', 'user'),
	(4, 'dung', 'd', '$2y$10$lxH7zkuxT78MkjmP5Qh16uq5bD4QbZUFIP551Ym8ULbzwUePPtiCy', 'admin');

-- Dumping structure for table my_store.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~5 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(2, 'Laptop', 'Danh mục các loại laptop'),
	(3, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(4, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(5, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro');

-- Dumping structure for table my_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~0 rows (approximately)

-- Dumping structure for table my_store.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~0 rows (approximately)

-- Dumping structure for table my_store.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~17 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(9, 'iPhone 14', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, 'uploads/iPhone-14-thumb-trang-600x600.jpg', 1),
	(10, 'Samsung Galaxy S22', 'Điện thoại Samsung Galaxy S22 với màn hình Dynamic AMOLED', 19999.99, 'uploads/49-510x510.png', 1),
	(11, 'MacBook Pro 14 inch', 'Laptop MacBook Pro 14 inch với chip M1 Pro', 34999.99, 'uploads/macbook 14 pro.jpg', 2),
	(12, 'Dell XPS 13', 'Laptop Dell XPS 13 với vi xử lý Intel Core i7 siêu rẻ', 22999.99, 'uploads/dell-xps-13-9340-ultra-7-hxrgt2-1-638708028116982814-750x500.jpg', 2),
	(13, 'iPad Pro 12.9', 'Máy tính bảng iPad Pro 12.9 inch, hỗ trợ Apple Pencil', 17999.99, 'uploads/ipad-pro-m2-5g-sliver-1-750x500.jpg', 3),
	(14, 'Samsung Galaxy Tab S8', 'Máy tính bảng Samsung Galaxy Tab S8 với màn hình 120Hz', 12999.99, 'uploads/samsung-galaxy-tab-s8-ultra-1-1-750x500.jpg', 3),
	(15, 'Tai nghe AirPods Pro', 'Tai nghe không dây AirPods Pro với chế độ chống ồn', 6599.99, 'uploads/tui-airpods-pro-nhua-cung-trong-jm-pd01-xam-1-750x500.jpg', 4),
	(16, 'Loa Bluetooth JBL Charge 5', 'Loa Bluetooth JBL Charge 5 với âm thanh mạnh mẽ và pin lâu dài', 4599.99, 'uploads/bluetooth-jbl-charge-5-1-750x500.jpg', 5),
	(17, 'Laptop MSI Modern 14 C12MO-660VN', '212', 31.00, 'uploads/msi-modern-14-c12mo-i5-660vn-glr-2-750x500.jpg', 2),
	(19, 'iPhone14', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, 'uploads/msi-modern-14-c12mo-i5-660vn-glr-2-750x500.jpg\r\n', 1),
	(26, 'iPhone146 PUT', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1),
	(31, 'iPhone146', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1),
	(32, 'iPhone146', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1),
	(33, 'iPhone146', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1),
	(34, 'iPhone146', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1),
	(35, 'iPhone146', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1),
	(36, 'iPhone146', 'Điện thoại iPhone 14 mới nhất của Apple siêu rẻ', 23999.99, '', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
