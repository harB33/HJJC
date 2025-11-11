-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 12:40 PM
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
(23, 2, 5, 'Hot', 'Dairy Milk', 'No Shot', 'Regular Sweet', 'Normal Ice', 1, '2025-11-11 11:39:55'),
(24, 2, 5, 'Iced', 'Oat Milk', 'LYDIA', 'Less Sweet', 'Less Ice', 1, '2025-11-11 11:40:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `customer_product_custom` (`customer_id`,`product_id`,`temperature`,`milk_type`,`espresso_shots`,`sweetness`,`ice_level`),
  ADD UNIQUE KEY `unique_cart_item` (`customer_id`,`product_id`,`temperature`,`milk_type`,`espresso_shots`,`sweetness`,`ice_level`),
  ADD KEY `cart_ibfk_2` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`customer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
