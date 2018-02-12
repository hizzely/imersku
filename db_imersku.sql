-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2017 at 05:07 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imersku`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `code` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`code`, `discount`, `active`, `created_at`) VALUES
('31242312', '75', 1, '2017-09-10 11:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `products` text COLLATE utf8_unicode_ci NOT NULL,
  `totalbill` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(5) NOT NULL DEFAULT '5',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `fullname`, `email`, `contact`, `address`, `products`, `totalbill`, `payment`, `status`, `created_at`) VALUES
('3916527423', 'qwe', 'wqeqeq', 'eqweqeq', 'qweq', '[{\":prod_id\":\"2\",\":prod_qty\":5,\":prod_price\":2200000},{\":prod_id\":\"1\",\":prod_qty\":4,\":prod_price\":1280000}]', '3480000', 'paypal', 5, '2017-09-11 01:44:36'),
('4088188550', 'sdsds', 'dsdsdsdss', 'dsds', 'sds', '[{\":prod_id\":\"2\",\":prod_qty\":\"1\",\":prod_price\":440000}]', '440000', 'bri', 5, '2017-09-11 02:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `available` int(5) NOT NULL,
  `featured` int(5) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `description`, `available`, `featured`, `created_at`) VALUES
(1, '1', 'Sepatu', '320000', 'Ini sepatu adidas', 1, 1, '2017-09-10 02:24:59'),
(2, '2', 'Tas', '440000', 'qweqweqwe', 1, 1, '2017-09-10 02:39:10'),
(3, '2', 'Sandal', '653000', 'qwewqeqweqe', 1, 1, '2017-09-10 02:54:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
