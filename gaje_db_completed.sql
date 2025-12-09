-- gaje_db schema
CREATE DATABASE IF NOT EXISTS `gaje_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gaje_db`;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(191) NOT NULL
);

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(191) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `category_id` INT DEFAULT NULL,
  FOREIGN KEY (`category_id`) REFERENCES categories(`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `customers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(191) NOT NULL,
  `email` VARCHAR(191),
  `phone` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_id` INT NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`customer_id`) REFERENCES customers(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `price` DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES orders(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES products(`id`) ON DELETE CASCADE
);

-- sample categories
INSERT INTO categories (name) VALUES ('Default'), ('Electronics'), ('Books');

-- sample products
INSERT INTO products (name, price, category_id) VALUES
('Sample Item A', 9.99, 1),
('Headphones', 29.99, 2),
('Novel', 14.50, 3);
