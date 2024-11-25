-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 06:44 AM
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
-- Database: `acmegrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullName` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `reset_token` varchar(500) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `username`, `email`, `password`, `reset_token`, `token_expiry`) VALUES
(6, 'Utkarsh Jain', 'utkarsh_12', 'utkarshjain@gmail.com', 'utkarsh@123', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `userId`, `productId`, `createdDate`, `name`) VALUES
(388, 3, 88, '2024-07-23 08:32:51', ''),
(417, 1, 96, '2024-11-06 11:14:17', ''),
(423, 1, 96, '2024-11-06 11:16:17', ''),
(425, 1, 97, '2024-11-19 19:12:37', ''),
(426, 11, 100, '2024-11-19 21:52:02', ''),
(495, 11, 109, '2024-11-20 17:47:46', ''),
(496, 11, 109, '2024-11-20 17:47:54', ''),
(497, 11, 109, '2024-11-20 17:47:57', ''),
(498, 12, 109, '2024-11-20 17:48:21', ''),
(499, 12, 109, '2024-11-20 17:48:25', ''),
(500, 12, 110, '2024-11-20 17:56:29', ''),
(502, 12, 111, '2024-11-21 17:27:24', ''),
(503, 12, 111, '2024-11-21 17:33:52', ''),
(504, 12, 111, '2024-11-21 17:34:09', ''),
(519, 12, 113, '2024-11-22 18:36:33', ''),
(526, 12, 112, '2024-11-23 13:28:12', ''),
(527, 12, 114, '2024-11-23 15:11:22', ''),
(528, 12, 112, '2024-11-25 05:09:05', ''),
(530, 12, 115, '2024-11-25 05:18:38', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `productName` varchar(500) NOT NULL,
  `customerName` varchar(500) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `email`, `mobile`, `address`, `street`, `city`, `state`, `zip`, `created_at`, `productName`, `customerName`, `productId`) VALUES
(123, 'ujain5818@gmail.com', '6037269112', 'G-58, Govind Puram', '58A', 'Ghaziabad', 'Uttar Pradesh', '201013', '2024-11-23 18:17:13', 'Utkarsh Jain', 'Utkarsh Jain', 114),
(124, 'ujain5818@gmail.com', '8130247749', 'G-Block, Govindpuram', '58A', 'Ghaziabad', 'Uttar Pradesh', '201013', '2024-11-23 18:19:27', 'Calculator', 'Arpit Jain', 113),
(126, 'ujain5818@gmail.com', '0987654367', 'G-58, Govind Puram', 'ghj', 'Ghaziabad', 'Uttar Pradesh', '201013', '2024-11-25 05:09:52', 'Book', 'Utkarsh Jain', 112);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `price` float NOT NULL,
  `imgpath` varchar(500) NOT NULL,
  `owner` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `detail` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `name`, `price`, `imgpath`, `owner`, `created_date`, `detail`) VALUES
(112, 'Book', 900, 'productImgistockphoto-173015527-612x612.jpg', 1, '2024-11-21 17:35:06', 'Web Development'),
(113, 'Calculator', 1, 'productImgCalculator.png', 1, '2024-11-22 16:30:55', 'Scanner'),
(115, 'Laptop', 90000, 'productImgIMG-20241125-WA0008.jpg', 5, '2024-11-25 05:13:43', 'Mac Book pro ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `fullName` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `reset_token`, `token_expiry`, `fullName`) VALUES
(12, 'uttu_1', 'uttu@gmail.com', 'uttu@123', NULL, NULL, 'Uttu'),
(16, 'sam_492', 'sanyam262004@gmail.com', 'Utkarsh@123', '59e95160d037e65900315d8f42f9c1da', '2024-11-24 20:14:02', 'Sanyam Jain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
