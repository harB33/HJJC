-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 04, 2025 at 08:03 PM
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
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `address_name` varchar(150) DEFAULT NULL,
  `address_line1` varchar(250) DEFAULT NULL,
  `address_line2` varchar(250) DEFAULT NULL,
  `address_city` varchar(150) DEFAULT NULL,
  `address_region` varchar(50) DEFAULT NULL,
  `address_brgy` varchar(20) DEFAULT NULL,
  `address_postal` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `product_id`) VALUES
(1, 1, 4),
(2, 2, 7),
(12, 2, 4),
(13, 2, 4),
(14, 2, 4),
(15, 2, 4);

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
(1, 'Electronics & Gadgets', '2025-11-02 01:31:50'),
(2, 'Fashion & Apparel', '2025-11-02 01:31:50'),
(3, 'Home & Living', '2025-11-02 01:31:50'),
(4, 'Beauty & Personal', '2025-11-02 01:31:50'),
(5, 'Health & Wellness', '2025-11-02 01:31:50'),
(6, 'Baby & Kids', '2025-11-02 01:31:50'),
(7, 'Pets Supplies', '2025-11-02 01:31:50'),
(8, 'Sports & Outdoors', '2025-11-02 01:31:50'),
(9, 'Automotive & Tools', '2025-11-02 01:35:19'),
(10, 'Arts & Stationery', '2025-11-02 01:35:19'),
(11, 'Books & Education', '2025-11-02 01:35:19'),
(12, 'Food & Beverages', '2025-11-02 01:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `address_id` int(11) UNSIGNED DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('pending','paid','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `order_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `product_img`, `product_desc`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(4, 'MSI GeForce RTX™ 5090 GAMING TRIO OC 32GB GDDR7 512-bit Graphics Card', 174850.00, 'rtx5090.png', 'Building on MSI\'s heritage, GAMING TRIO embodies the passion of gamers with a sleek exterior that erupts with vibrant lights amidst bold lines and sharp edges. LED lighting is diffused through a frosted cover and a dragon totem that radiate energy.', 1, 10, '2025-11-02 15:17:23', '2025-11-03 15:17:23'),
(7, 'MSI GeForce RTX™ 5090 GAMING TRIO OC 32GB GDDR7 512-bit Graphics Card', 150000.00, 'product_6907cfad9afde7.47862183.png', 'asd', 1, 1, '2025-11-02 21:39:57', '2025-11-02 21:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
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
  `customer_lastname` varchar(50) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_pass` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_id`, `customer_user`, `customer_firstname`, `customer_lastname`, `customer_email`, `customer_phone`, `customer_pass`, `created_at`) VALUES
(1, 'jomarivillanueva', 'Jomari', 'Wamil', 'Villanueva@gmail.com', '09927300876', 'JomariCrushsiVillanueva1', '2025-10-29 02:01:47'),
(2, 'harvy12345', 'harvs', 'bautista', 'jwamcoc01@gmail.com', '09927300876', 'Harvy12345', '2025-10-31 13:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `costumer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

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
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

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
  MODIFY `address_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `customer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

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
