-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2021 at 12:08 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'iPhone'),
(2, 'Samsung'),
(3, 'Xiaomi'),
(4, 'Sony'),
(5, 'Oppo'),
(6, 'Vsmart'),
(12, 'LG Phone'),
(13, 'Asus'),
(14, 'Vivo');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `price` float NOT NULL,
  `typeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `typeId`) VALUES
(1, 'Samsung Galaxy S21 Ultra', 23000000, 2),
(2, 'Samsung Note 21 Ultra', 25000000, 2),
(3, 'iPhone 12 Pro Max', 29000000, 1),
(4, 'iPhone 12 Mini', 18890000, 1),
(5, 'Xiaomi Pro Max', 20000000, 3),
(6, 'Xiaomi Redmi Note 9', 12000000, 3),
(7, 'iPhone 11 Pro Max', 20000000, 1),
(8, 'iPhone 12', 19500000, 1),
(11, 'Samsung Note 20', 15500000, 2),
(12, 'Sony Experia Z II', 18500000, 4),
(13, 'iPhone 11', 11500000, 1),
(14, 'iPhone 11 Pro ', 25000000, 1),
(15, 'iPhone XS Max', 12000000, 1),
(16, 'iPhone XR', 9500000, 1),
(17, 'Samsung Galaxy S21 Plus', 21000000, 2),
(18, 'Samsung Galaxy S21', 18000000, 2),
(19, 'Samsung Note 21 Plus', 21000000, 2),
(20, 'Samsung Note 20 Ultra', 20000000, 2),
(21, 'Samsung Galaxy A71', 7800000, 2),
(22, 'Samsung Galaxy M71', 6990000, 2),
(23, 'Xiaomi Redmi Note 11', 11000000, 3),
(24, 'Xiaomi Mi Mix 5', 11500000, 3),
(25, 'Xiaomi M10 T Pro 5G', 8990000, 3),
(26, 'Sony Experia XZ 2', 21500000, 4),
(27, 'Sony Experia 1 III', 14000000, 4),
(28, 'Sony Experia 2 II', 16990000, 4),
(29, 'Oppo A93 ', 5990000, 5),
(30, 'Oppo Reno 5 5G', 9990000, 5),
(31, 'Oppo A15s', 3290000, 5),
(32, 'Oppo Reno 4 F', 6990000, 5),
(33, 'Oppo Find X3', 18990000, 5),
(34, 'Oppo Find X3 Pro 5G', 21990000, 5),
(35, 'Vsmart Star 5', 2990000, 6),
(36, 'Vsmart Aris', 3990000, 6),
(37, 'Vsmart Joy 4', 2450000, 6),
(38, 'Vsmart Live 4', 2950000, 6),
(39, 'Vsmart Active 3', 2690000, 5),
(40, 'LG WINGS 5G', 19950000, 12),
(41, 'LG G8', 5890000, 12),
(42, 'LV V30', 2890000, 12),
(43, 'LG G6', 1890000, 12),
(44, 'LG V30 PLUS', 7990000, 12),
(45, 'Asus ROG Phone 2', 10990000, 13),
(46, 'Asus ROG Phone 3', 15990000, 13),
(47, 'Asus ROG Phone 5', 16690000, 13),
(48, 'Vivo V21', 3990000, 14),
(49, 'Vivo V20s', 2890000, 14),
(50, 'Vivo Y50', 4290000, 14),
(51, 'Vivo Y30i', 4490000, 14),
(53, 'iPhone Xs', 8990000, 1),
(54, 'Samsung Galaxy M20', 6890000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` text DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone_number`, `role`) VALUES
(1, 'Nguyen Huu Tuan', 'huutuandn96@gmail.com', '123456', '0936714737', 1),
(2, 'Nguyen Van A', 'abc@gmail.com', '123456', '0123456789', 0),
(3, 'Nguyen Van D', 'avcd@gmail.com', '15926', '025814736', 1),
(5, 'Nguyen Thi E', 'thithi@gmail.com', '12345', '0322152636', 0),
(11, 'Nguyen Huu A', 'huua@gmail.com', '0123456', '0123876545', 0),
(12, 'Vo Thao Thien', 'tthien@gmail.com', 'abcdef', '1234567890', 1),
(13, 'Nguyen Van Tuan', 'vantuan@gmail.com', 'abc123', '098563214', 1),
(14, 'Nguyen Tuan Tuan', 'tuantuan@gmail.com', 'timlama1', '0523146325', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products` (`typeId`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`typeId`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
