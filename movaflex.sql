-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 11:09 PM
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
-- Database: `movaflex`
--

-- --------------------------------------------------------

--
-- Table structure for table `cleanroom`
--

CREATE TABLE `cleanroom` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `special_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cleanroom`
--

INSERT INTO `cleanroom` (`id`, `product_name`, `product_picture`, `quantity`, `special_name`, `price`) VALUES
(1, '9551MC4-BLU', '9551MC1.jpg', 999, 'ISO 7 Cleanroom blue vinyl chair w/medium back', 5500.00),
(2, '6500-BKF', 'img_67d8a34908e256.20569562.jpg', 13986, 'Articulating seat & back tilt', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `esd`
--

CREATE TABLE `esd` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `special_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `esd`
--

INSERT INTO `esd` (`id`, `product_name`, `product_picture`, `quantity`, `special_name`, `price`) VALUES
(1, 'INTEGRA', 'INTEGRA.jpg', 999, '9000Series', 4000.00),
(2, 'dfdgfdfd', '1742250013_OACOT4020-GRAY-1-300x300.jpg', 3232, 'vf2ffff', 2344.00);

-- --------------------------------------------------------

--
-- Table structure for table `officechairs`
--

CREATE TABLE `officechairs` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `special_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officechairs`
--

INSERT INTO `officechairs` (`id`, `product_name`, `product_picture`, `quantity`, `special_name`, `price`) VALUES
(1, '4 – Seater Gang Chair', 'gang-chair-updated.jpg', 999, 'Gang Chair', 9000.00),
(2, 'Alta', 'img_67d8a62e497de8.99001901.jpg', 999, 'Premium Mid-back Office Chair', 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `officetablesanddesks`
--

CREATE TABLE `officetablesanddesks` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `special_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officetablesanddesks`
--

INSERT INTO `officetablesanddesks` (`id`, `product_name`, `product_picture`, `quantity`, `special_name`, `price`) VALUES
(1, 'OACOT4020', 'OACOT4020-BEIGE-1-300x300.jpg', 999, 'Classic Office Table (40\" x 20\")', 6000.00),
(2, 'OACOT4028', '1742236803_OACOT4020-GRAY-1-300x300.jpg', 999, 'Classic Office Table (40\" x 28\")', 7000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `stock`, `updated_at`) VALUES
(1, 'dasdasd', '', 323424.00, 'uploads/movaflex-removebg-preview.png', '2025-03-13 23:35:09', 0, '2025-03-17 15:11:51'),
(2, 'werwer', '', 123123.00, 'uploads/movaflex-removebg-preview.png', '2025-03-13 23:36:12', 0, '2025-03-17 15:11:51'),
(4, 'qweqwe1', '', 123123.00, 'uploads/movaflex-removebg-preview.png', '2025-03-13 23:36:50', 0, '2025-03-17 15:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE `standard` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `special_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `product_name`, `product_picture`, `quantity`, `special_name`, `price`) VALUES
(1, '6500-BKF', '1742250416_Integra_Scaled-173x300.jpg', 2997, 'Articulating seat & back tilt', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'test@example.com', '$2y$10$wCbvW490SKR.vNJxOkbeVOEgqFiwCENbQ0d6CpJzji90i8OK4cmgG'),
(20, 'superadmin@gmail.com', '$2y$10$DUQeLEdH5Ldsj/MbtF0Vce9WGCVjmw9w/kdPAwhjGtiS.sV1jVsyS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cleanroom`
--
ALTER TABLE `cleanroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `esd`
--
ALTER TABLE `esd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officechairs`
--
ALTER TABLE `officechairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officetablesanddesks`
--
ALTER TABLE `officetablesanddesks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standard`
--
ALTER TABLE `standard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cleanroom`
--
ALTER TABLE `cleanroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `esd`
--
ALTER TABLE `esd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `officechairs`
--
ALTER TABLE `officechairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `officetablesanddesks`
--
ALTER TABLE `officetablesanddesks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `standard`
--
ALTER TABLE `standard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
