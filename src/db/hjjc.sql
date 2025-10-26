-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 02:38 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(3, 'HARVY123', '090619Harvy', 'example@email.com', '0000-00-00 00:00:00'),
(4, 'harvy', 'harvy', 'example@email.com', '2025-10-25 00:10:56'),
(5, 'harvy', 'harvy', 'example@email.com', '2025-10-25 02:10:17'),
(6, '1231231', '1231231', 'example@email.com', '2025-10-25 02:10:22'),
(7, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:14'),
(8, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:52'),
(9, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:54'),
(10, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:57'),
(11, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:01'),
(12, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:25'),
(13, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:38'),
(14, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:55'),
(15, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:59'),
(16, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:14'),
(17, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:26'),
(18, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:38'),
(19, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:47'),
(20, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:06'),
(21, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:07'),
(22, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:10'),
(23, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:17'),
(24, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:29'),
(25, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:29'),
(26, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:54'),
(27, 'patrick', 'qwertuiop', 'example@email.com', '2025-10-25 02:10:19'),
(28, '1231231', '123123', 'example@email.com', '2025-10-25 02:10:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
