-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 05:23 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Allergies'),
(4, 'Headaches');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `invoice_number` varchar(1024) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `orderId`, `invoice_number`, `amount`) VALUES
(1, 3, 'PHARM02015634', 90),
(2, 3, 'PHARM02015636', 131),
(3, 1, 'PHARM02015218', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `qty` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `amount`, `qty`) VALUES
(1, 1, '0', '0'),
(2, 2, '1750', '2'),
(3, 3, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `productId`, `qty`, `price`, `paid`) VALUES
(1, 2, 5, 3, '750', 1),
(3, 2, 4, 1, '1000', 1),
(4, 2, 6, 1, '750', 1),
(5, 3, 3, 1, '90', 1),
(11, 3, 8, 1, '40', 1),
(14, 3, 10, 1, '20', 1),
(15, 3, 7, 1, '21', 1),
(25, 3, 9, 1, '50', 1),
(33, 1, 13, 1, '1200', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `price` varchar(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `tags`, `price`, `image`, `qty`, `categoryId`, `description`) VALUES
(3, '4head', 'pain relief, headaches, stress, fever', '90', 'images/avatar/f55f64f198.jpg', 89, 4, 'Pain relief'),
(4, 'Anadin Extra', 'pain relief, headaches, stress, fever', '1000', 'images/avatar/7143b1a5f5.jpg', 0, 4, 'pain relief'),
(5, 'Anadin Ultra', 'pain relief, headaches, stress, fever', '250', 'images/avatar/16e3c113a9.jpg', 40, 4, 'pain relief'),
(6, 'Calpol', 'pain relief, headaches, stress, fever', '750', 'images/avatar/d90410bd38.jpg', 11, 4, 'pain relief'),
(7, 'Cocodamol', 'pain relief, headaches, stress, fever', '21', 'images/avatar/5fd651077c.jpg', 199, 4, 'pain relief'),
(8, 'Codis', 'pain relief, headaches, stress, fever', '40', 'images/avatar/0363d8fc94.jpg', 99, 4, 'pain relief, headaches'),
(9, 'Cuprofen', 'pain relief, headaches, stress, fever', '50', 'images/avatar/8231fbb832.jpg', 21, 4, 'pain relief, headaches, stress, fever'),
(10, 'Cuprofen Tablets', 'pain relief, headaches, stress, fever', '20', 'images/avatar/c446df85fe.jpg', 99, 4, 'tablets'),
(11, 'Aspirin', 'pain relief, headaches, stress, fever', '200', 'images/avatar/168b47386a.jpg', 15, 4, 'pain relief, headaches, stress, fever'),
(12, 'Hedex Extra', 'pain relief, headaches, stress, fever', '70', 'images/avatar/d0bab67762.jpg', 250, 4, 'pain relief, headaches, stress, fever'),
(13, 'Imigran Recovery', 'pain relief, headaches, stress, fever', '1200', 'images/avatar/3c66b2fa1e.jpg', 9, 4, 'pain relief, headaches, stress, fever'),
(14, 'Kooln Soothe', 'fever, children, sweet', '2500', 'images/avatar/7100996b26.jpg', 20, 4, 'fever, children'),
(15, 'Migraine kooln Soothe', 'sweet, drug', '2300', 'images/avatar/b64c2a4a94.jpg', 20, 4, 'pain relief, headaches'),
(16, 'Migraleve', 'Allergies, pain, cough ', '2300', 'images/avatar/48c4a3c8fa.jpg', 40, 3, 'Allergies, aches, pain');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_no` varchar(64) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone_no`, `birthday`, `state`, `address`, `username`, `type`) VALUES
(1, 'mrjobosco@gmail.com', 'password', 'Joseph', 'Ehikioya', '2347037370494', '12/03/1994', 'EDO', 'No 17 Sultan Abubakar Road sokoto state, Nigeria', 'joey', 0),
(2, 'josephehikioya@yahoo.com', 'password', 'admin', 'admin', '2347037370494', '06/07/1994', 'EDO', 'No 17 Sultan Abubakar Road sokoto state, Nigeria', 'admin', 1),
(3, 'voddy14@gmail.com', 'password', 'Joseph', 'Ehikioya', '08032348542', '01/07/2010', 'ABIA', 'dsdsd', 'hamza', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productId` (`productId`),
  ADD KEY `orderId` (`orderId`,`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
