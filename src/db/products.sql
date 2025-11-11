-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 08:57 AM
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
(1, 'Basketball', 700.00, 'https://www.sport-thieme.be/Ballen/Basketballen/art=3058927', 'bola bago droga', 1, 2, '2025-11-02 04:06:59'),
(2, 'Basketball', 700.00, 'https://www.sport-thieme.be/Ballen/Basketballen/art=3058927', 'bola bago droga', 1, 2, '2025-11-02 06:59:19'),
(3, 'Intel® Core™ Ultra 9 285K Desktop Processor', 38600.00, 'product_69081dedd70cb7.48696548.webp', 'INTEL CORE ULTRA 9 285K (UP TO 5.70GHZ)40MB/24CORES/24THREADS/2GHZ INTELGRAPHICS/3NM/ARROWLAKE/15TH GEN/LGA1851 PROCESSOR', 174, 1, '2025-11-03 03:13:49'),
(4, 'Intel® Core™ Ultra 9 285K Desktop Processor', 70000.00, 'product_6911bffa02eb57.46320880.png', 'safwfawfawdfasfawe', 64, 2, '2025-11-10 10:35:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
