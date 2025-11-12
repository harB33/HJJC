-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 07:24 AM
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
-- Database: `hjjc`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `address_name` varchar(150) NOT NULL,
  `address_city` varchar(150) NOT NULL,
  `address_region` varchar(50) NOT NULL,
  `address_brgy` varchar(20) NOT NULL,
  `address_postal` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `customer_id`, `address_name`, `address_city`, `address_region`, `address_brgy`, `address_postal`, `created_at`) VALUES
(1, 2, 'Baseco', 'Manila', 'Ncr', '649', '1018', '2025-11-12 05:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `temperature` enum('Hot','Iced','','') NOT NULL,
  `milk_type` enum('Dairy Milk','Oat Milk','Coconut Milk','') NOT NULL,
  `espresso_shots` enum('No Shot','LYDIA','BOSS','') NOT NULL DEFAULT 'No Shot',
  `sweetness` enum('Regular Sweet','Less Sweet','More Sweet','') NOT NULL DEFAULT 'Regular Sweet',
  `ice_level` enum('Normal Ice','Less Ice','','') DEFAULT 'Normal Ice',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `product_id`, `temperature`, `milk_type`, `espresso_shots`, `sweetness`, `ice_level`, `quantity`, `created_at`) VALUES
(39, 2, 6, 'Hot', 'Dairy Milk', 'No Shot', 'Regular Sweet', 'Normal Ice', 1, '2025-11-11 12:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) UNSIGNED NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`) VALUES
(1, 'Coffee', '2025-11-06 22:24:07'),
(2, 'Milk Tea', '2025-11-06 22:25:22'),
(3, 'Frappe', '2025-11-06 22:25:22'),
(4, 'Shake', '2025-11-10 15:00:41'),
(5, 'Pastries', '2025-11-11 03:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `address_id` int(11) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('pending','paid','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `order_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `product_img`, `product_desc`, `stock`, `category_id`, `created_at`) VALUES
(5, 'Coffee Frappé', 149.00, 'product_6912d9cf57d1b4.26714584.png', 'Coffee Frappé', 50, 5, '2025-11-11 06:38:07'),
(6, 'Coffee Frappé', 149.00, 'product_6912ff34bae382.55881612.png', 'Coffee Frappé', 50, 1, '2025-11-11 09:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `detail_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(11) UNSIGNED NOT NULL,
  `temperature` enum('Hot','Cold','','') NOT NULL,
  `milk_type` enum('Dairy Milk','Oat Milk','Coconut Milk','') NOT NULL,
  `espresso_shots` enum('No shot','LYDIA','BOSS','') NOT NULL DEFAULT 'No shot',
  `sweetness` enum('Regular Sweet','Less Sweet','More Sweet','') NOT NULL DEFAULT 'Regular Sweet',
  `ice_level` enum('Less Ice','Normal Ice','','') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `review_comment` text DEFAULT NULL,
  `review_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_id` int(11) UNSIGNED NOT NULL,
  `customer_user` varchar(100) NOT NULL,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_middlename` varchar(50) DEFAULT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_pass` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `customer_user`, `customer_firstname`, `customer_middlename`, `customer_lastname`, `customer_email`, `customer_phone`, `customer_pass`, `created_at`) VALUES
(1, 'jomarivillanueva', 'Jomari', NULL, 'Wamil', 'Villanueva@gmail.com', '09927300876', 'JomariCrushsiVillanueva1', '2025-10-29 02:01:47'),
(2, 'harvy12345', 'harvs', NULL, 'bautista', 'jwamcoc01@gmail.com', '09927300876', 'Harvy12345', '2025-10-31 13:40:41'),
(3, 'Jomari12345', 'Jomari', '', 'Wamil', 'bautistaharvy13@gmail.com', '09927300876', 'Jomari12345', '2025-11-06 00:45:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `address_ibfk_1` (`customer_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `customer_product_custom` (`customer_id`,`product_id`,`temperature`,`milk_type`,`espresso_shots`,`sweetness`,`ice_level`),
  ADD UNIQUE KEY `unique_cart_item` (`customer_id`,`product_id`,`temperature`,`milk_type`,`espresso_shots`,`sweetness`,`ice_level`),
  ADD KEY `cart_ibfk_2` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_ibfk_1` (`customer_id`),
  ADD KEY `orders_ibfk_2` (`address_id`),
  ADD KEY `orders_ibfk_3` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_details_ibfk_2` (`cart_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
