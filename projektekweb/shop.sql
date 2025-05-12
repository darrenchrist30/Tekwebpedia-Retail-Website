-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 04:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 17, 'darren', 'darren123@gmail.com', '13345643', 'bagus'),
(5, 17, 'darren', 'darren123@gmail.com', '353666534334', 'test'),
(6, 17, 'vier', 'vier123@gmail.com', '0837238238', 'ready ga ambientnya?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(3, 17, 'darren', '081672537283', 'darren123@gmail.com', 'BRI', 'Alamat : Jawa tengah Semarang Teuku umar 47389', ', yss  x 1, turbo flex F55 x 2, saber x 2', 29600000, '2023-12-17', 'completed'),
(4, 17, 'vier', '3242345343', 'vier123@gmail.com', 'Mandiri', 'Alamat : jawa timur, kediri, citraland 36746', ', turbo flex F55 x 1, velg enkei x 3, yss  x 2', 85200000, '2023-12-17', 'completed'),
(5, 17, 'darren', '8593859405', 'darren123@gmail.com', 'BCA', 'Alamat : jawa timur, madiun, madiun 38489', ', pro7 P770RV x 1, saber x 2', 18600000, '2023-12-18', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `details` varchar(300) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(16, 'turbo flex F55', 'turbo', 'gacorrr', 5000000, 'turbo1.jpeg'),
(18, 'yss ', 'shockbreaker', 'yss thailand palsu', 800000, 'shock1.jpg'),
(20, 'saber', 'lampu', 'saber projector headlamp', 2000000, 'saber.jpg'),
(21, 'TE37', 'velg', 'produk favorit', 8500000, 'velg3.jpg'),
(22, 'TEIN', 'shockbreaker', 'Thailand', 15000000, 'shock2.jpg'),
(23, 'f44', 'turbo', 'turbo F44', 7500000, 'turbo2.jpg'),
(24, 'profender', 'shockbreaker', 'profender thailand', 5500000, 'shock.jpg'),
(25, 'pro7 P770RV', 'lampu', 'pro7', 5300000, 'pro7.jpg'),
(26, 'saber mini projie', 'lampu', 'mini projie', 1200000, 'miniprojie.jpg'),
(27, 'flex pro', 'turbo', 'turbo flex pro', 10000000, 'flexpro.jpg'),
(28, 'tc105x', 'velg', 'ori japan ', 8500000, 'velg1.jpg'),
(30, 'ze40 gold', 'velg', 'ori japan', 12000000, 'ze40.png'),
(31, 'yss shock', 'shockbreaker', 'thailand made', 5500000, 'yssmobil.png'),
(33, 'rpf gunmetal', 'velg', 'gun metal barang terfavorit', 9000000, 'rpf.png'),
(34, 'queen series for 2gd', 'shockbreaker', 'recommended for innova and fortuner', 20000000, 'queenseries.png'),
(35, 'saber projector', 'lampu', 'saber projector SR900 evo', 2500000, 'saberprojector.png'),
(36, 'kiwami', 'velg', 'warna gold(diskon 10% khusus hari ini)', 15000000, 'kiwami.png'),
(37, 'flex r-31', 'turbo', 'power 200hp', 10000000, 'flexpro.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(15, 'admin02', 'admin02@yahoo.com', '6e60a28384bc05fa5b33cc579d040c56', 'admin', 'patrick.png'),
(17, 'darren', 'darren123@gmail.com', 'ac638a13498ffe51c65a6ae0bf7089fd', 'user', 'kar.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(1, 3, 1, 'apple', 2, 'apple.png'),
(2, 8, 4, 'steak', 4, 'beef steak.png'),
(18, 17, 21, 'TE37', 8500000, 'velg3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
