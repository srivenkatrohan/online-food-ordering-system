-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2019 at 09:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swigfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `person_id`, `order_id`, `status`) VALUES
(1, 4, NULL, 0),
(2, 6, 19, 1),
(3, 7, NULL, 0),
(4, 8, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `hotel_name`, `item_name`, `price`, `deleted`) VALUES
(1, 'Steakhouse', 'Biryani', 300, 0),
(2, 'Steakhouse', 'Pasta', 50, 0),
(3, 'Steakhouse', 'Pasta Cake', 55, 1),
(4, 'Steakhouse', 'Pizza', 150, 0),
(5, 'BJs Resto', 'Wrap', 30, 0),
(6, 'BJs Resto', 'Tagine', 20, 0),
(7, 'Steakhouse', 'Sandwich', 25, 0),
(8, 'Steakhouse', 'Soup', 60, 1),
(9, 'Steakhouse', 'Stri-fry', 60, 0),
(10, 'Steakhouse', 'Smoothie', 80, 0),
(11, 'BJs Resto', 'Dolor', 15, 1),
(12, 'Admin', 'Loreth', 10, 0),
(13, 'Admin', 'Loreth', 10, 0),
(14, 'BJs Resto', 'Tapas', 70, 0),
(15, 'BJs Resto', 'Cde', 13, 0),
(16, 'Steakhouse', 'Quinche', 87, 0),
(17, 'Steakhouse', 'Tapas', 85, 0),
(18, 'Steakhouse', 'Tuik', 14, 0),
(19, 'BJs Resto', 'Rissotto', 55, 0),
(20, 'Steakhouse', 'Tart', 60, 0),
(21, 'China Bistro', 'Burger', 80, 0),
(22, 'China Bistro', 'Fish Pie', 70, 1),
(23, 'China Bistro', 'Chicken Salad', 100, 0),
(24, 'China Bistro', 'Omelette', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `address` varchar(300) NOT NULL,
  `area` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '3',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL,
  `notification` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `hotel_id`, `customer_id`, `person_id`, `address`, `area`, `date`, `total`, `status`, `deleted`, `description`, `notification`) VALUES
(1, 5, 3, NULL, 'hello', 'Ipsum', '2019-10-15 00:00:22', 30, -1, 1, 'N/A', 0),
(4, 2, 11, 6, 'waris', 'Ipsum', '2019-10-16 20:21:54', 120, 0, 0, 'N/A', 0),
(5, 5, 11, NULL, 'waris', 'Lorem', '2019-10-16 20:23:58', 60, -2, 1, '', 0),
(6, 5, 3, NULL, 'Hello World', 'Ipsum', '2019-10-17 02:38:03', 50, -1, 1, 'N/A', 0),
(7, 2, 3, NULL, 'Hello World', 'Ipsum', '2019-10-17 02:41:31', 30, -1, 1, 'N/A', 0),
(8, 5, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-19 23:34:23', 20, -2, 1, '', 0),
(9, 2, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-19 23:36:26', 20, -1, 1, '', 0),
(10, 5, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-19 23:55:46', 15, -1, 1, 'Due to Hello World.', 0),
(11, 5, 3, 6, 'House no. 111, Spring.', 'Ipsum', '2019-10-19 23:56:05', 20, 0, 0, '', 0),
(12, 2, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-22 23:51:37', 90, -1, 1, 'due to world hello', 0),
(13, 5, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-22 23:58:18', 20, -2, 1, '', 0),
(14, 5, 11, 8, 'waris', 'Ipsum', '2019-10-23 00:08:51', 30, 0, 0, '', -4),
(15, 2, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-25 21:29:03', 30, -2, 1, 'Hotel issue', 0),
(16, 5, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-10-29 00:13:10', 12, -2, 1, 'Hotel2 issue', 0),
(17, 2, 3, 6, 'House no. 111, Spring.', 'Ipsum', '2019-10-30 19:15:27', 24, 0, 0, '', 5),
(18, 5, 3, 4, 'House no. 111, Spring.', 'Ipsum', '2019-10-30 20:13:07', 20, 0, 0, '', -5),
(19, 2, 13, 6, 'House no.22, New Town.', 'Ipsum', '2019-10-30 20:36:57', 30, 1, 0, '', -4),
(20, 5, 14, 7, 'Hello World, Dolor.', 'Ipsum', '2019-10-30 21:20:29', 12, 0, 0, '', -2),
(21, 5, 14, 7, 'Hello World, Dolor.', 'Ipsum', '2019-10-31 05:15:16', 20, 0, 0, '', 5),
(22, 5, 14, 7, 'Hello World, Dolor.', 'Ipsum', '2019-10-31 05:39:15', 30, 0, 0, '', -5),
(23, 2, 3, 6, 'House no. 111, Spring.', 'Ipsum', '2019-11-09 10:55:11', 28, 0, 0, '', 5),
(24, 2, 3, 6, 'House no. 111, Spring.', 'Ipsum', '2019-11-09 11:10:34', 300, 0, 0, '', 5),
(25, 5, 3, 4, 'House no. 111, Spring.', 'Ipsum', '2019-11-10 02:23:03', 20, -3, 1, 'Hell', 5),
(26, 2, 3, NULL, 'House no. 111, Spring.', 'Ipsum', '2019-11-10 12:20:54', 150, 3, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 5, 1, 30),
(6, 4, 9, 4, 120),
(7, 5, 6, 3, 60),
(8, 6, 5, 1, 30),
(9, 6, 6, 1, 20),
(10, 7, 9, 1, 30),
(11, 8, 6, 1, 20),
(12, 9, 1, 1, 20),
(13, 10, 11, 1, 15),
(14, 11, 6, 1, 20),
(15, 12, 9, 3, 90),
(16, 13, 6, 1, 20),
(17, 14, 11, 2, 30),
(18, 15, 9, 1, 30),
(19, 16, 14, 1, 12),
(20, 17, 17, 1, 24),
(21, 18, 6, 1, 20),
(22, 19, 9, 1, 30),
(23, 20, 14, 1, 12),
(24, 21, 6, 1, 20),
(25, 22, 5, 1, 30),
(26, 23, 18, 2, 28),
(27, 24, 1, 1, 300),
(28, 25, 6, 1, 20),
(29, 26, 4, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `name`) VALUES
(1, 'hell'),
(2, 'world');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `area` varchar(30) NOT NULL,
  `contact` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `salt`, `email`, `address`, `area`, `contact`) VALUES
(1, 'Admin', 'Admin', 'admin', '691d58829adfbecd2a959e55baa571b8188781cadf82be79bed0cca6433f92fe', 'gFfOxwg5pD', 'admin@gmail.com', 'House no. 201, San Jose.', '', '9010101010'),
(2, 'Hotel', 'Steakhouse', 'steakhouse', '0dc1b64f480b64e5fafcc19f1b3cb069d21634d0ce0887ac73e0b69f9d8cd98e', 'BuL2kFRw1A', 'steakhouse@gmail.com', 'House no.222, Las Vegas.', 'Ipsum', '8918284562'),
(3, 'Customer', 'Customer1', 'customer1', 'fce1ca3cf1380d26b82e37cc94ee8ce8f863fbf8a50fc51c43603afa9b05626d', 'ZJ6kIB5bNq', 'customer1@gmail.com', 'House no. 111, Spring.', 'Ipsum', '7676767656'),
(4, 'Delivery', 'Delivery1', 'delivery1', '97b9a38a257a878ffa4ea9732ffc542443f9d1d9ca1e52867a7d6d12cdf8cc34', 'xhbGPEMGJB', 'delivery1@gmail.com', 'House no. 100, Fields.', 'Lorem', '5544336211'),
(5, 'Hotel', 'BJs Resto', 'bjsresto', 'daeb1d614331490fc0f3c146f67e9683f7b3bd9b0e474858e8040c224c7d5772', 'yIPsprQlAY', 'bjsresto@gmail.com', 'House no.222, New Town', 'Lorem', '9182736450'),
(6, 'Delivery', 'Delivery2', 'delivery2', '43b568ec49659d08f273477e2a125950f3231ac04be42a6eb7b66e6ef4bc24b5', 'RnYSBoyB7m', 'delivery2@gmail.com', 'House no. 111, Las Vegas.', 'Ipsum', '9182736451'),
(7, 'Delivery', 'Delivery3', 'delivery3', '6fe1db4728a4218671b66731b1d0cf10fc8da04296262fb100bcf8701e9c8922', 'n7ipmtZLIv', 'delivery3@gmail.com', 'House no. 121, Las Vegas', 'Lorem', '6724351692'),
(8, 'Delivery', 'Delivery4', 'delivery4', 'd8e1cd6fa64af10ffb46b4c3f9bc7eb6c5fd8952a382114762926e7fa3b7490e', 'vyixIsFNHW', 'delivery4@gmail.com', 'House no. 1, Las Vegas', 'Ipsum', '2739182736'),
(11, 'Customer', 'rahul', 'qazplm', '618698793a5e5a81d8e3bc141a35a90c77b6561b301f61256b81a709817e59ca', 'GFhY9ci7kD', 'sdad', 'waris', 'Ipsum', '98689'),
(12, 'Customer', 'Customer4', 'customer4', 'fe7c110d4a3928888bbc78d02bbaed4c3d58e8d4733044fd91117da57d72544b', '8WEIF9PpO0', 'customer4', 'House no.222, New Town.', 'Lorem', '8172635491'),
(13, 'Customer', 'Customer5', 'customer5', '25568e8d052131497965b5f5e36a976c58bea60b59d6b3de50993273f4522fca', 'ivUCAC4K9Q', 'customer5@outlook.co', 'House no.22, New Town.', 'Ipsum', '8181283845'),
(14, 'Customer', 'Customer6', 'customer6', 'd94485cd9f626f35e3c03754d56f8f25759f0a74f7b0773cc40a9247d2dc25d4', 'rrXuXLfZDp', 'customer6@gmail.com', 'Hello World, Dolor.', 'Ipsum', '7365218467'),
(15, 'Hotel', 'China Bistro', 'chinabistro', 'ddab96c807e879d02491e0455824a37574ab309909cd12a7dd5095070befb211', 'BcBRLoBjPn', 'chinabistro@gmail.co', 'Street No. 2, New Vegas.', 'Ipsum', '7263541098');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
