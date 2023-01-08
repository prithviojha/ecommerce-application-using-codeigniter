-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2021 at 05:09 PM
-- Server version: 5.7.32-35-log
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dber35dghg3o6h`
--

-- --------------------------------------------------------

--
-- Table structure for table `ms_admin`
--

CREATE TABLE `ms_admin` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_admin`
--

INSERT INTO `ms_admin` (`id`, `username`, `password`, `fullname`, `login_date`) VALUES
(1, 'admin', 'admin123', 'Prithvi Ojha', '2021-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `ms_carts`
--

CREATE TABLE `ms_carts` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `session_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `rate` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_carts`
--

INSERT INTO `ms_carts` (`id`, `product_id`, `session_id`, `product_name`, `quantity`, `rate`) VALUES
(3, 1, 80562, 'seismic gps', 2, '1000'),
(4, 1, 987331, 'seismic gps', 2, '1000'),
(5, 1, 345494, 'seismic gps', 2, '1000'),
(7, 1, 378540, 'seismic gps', 2, '1000'),
(8, 1, 106438, 'seismic gps', 1, '1000'),
(14, 1, 77431, 'seismic gps', 1, '10000');

-- --------------------------------------------------------

--
-- Table structure for table `ms_categories`
--

CREATE TABLE `ms_categories` (
  `id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` date NOT NULL,
  `count_products` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_categories`
--

INSERT INTO `ms_categories` (`id`, `category_name`, `image`, `status`, `date`, `count_products`) VALUES
(1, 'GPS', 'seismic_gps.jpg', 0, '2021-07-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_orders`
--

CREATE TABLE `ms_orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `total_quantity` decimal(10,0) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `order_date` date NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `delivered_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_orders`
--

INSERT INTO `ms_orders` (`id`, `user_id`, `user_name`, `total_quantity`, `total_amount`, `order_date`, `shipping_address`, `order_status`, `delivered_date`, `payment_method`) VALUES
(1, 1, 'kumar', '2', '2000', '2021-07-14', 'bharatpur,chitwan', 'pending', '0000-00-00', 'Payment by Esewa'),
(2, 1, 'kumar', '1', '1000', '2021-07-14', 'bharatpur,nepal', 'pending', '0000-00-00', 'Cash on delivery'),
(3, 1, 'kumar', '1', '1000', '2021-07-15', 'bharatpur, chitwan', 'pending', '0000-00-00', 'Cash on delivery'),
(4, 11, 'Prithvi Ojha', '1', '1000', '2021-07-15', 'bharatpur,chitwan', 'pending', '0000-00-00', 'Cash on delivery'),
(5, 11, 'Prithvi Ojha', '1', '1000', '2021-07-15', 'bharatpur,chitwan', 'pending', '0000-00-00', 'Cash on delivery'),
(6, 12, 'Prithvi Ojha', '1', '10000', '2021-07-15', 'bharatpur,nepal', 'pending', '0000-00-00', 'Cash on delivery'),
(7, 13, 'Prithvi Ojha', '1', '10000', '2021-07-15', 'bharatpur,chitwan', 'pending', '0000-00-00', 'Cash on delivery');

-- --------------------------------------------------------

--
-- Table structure for table `ms_order_products`
--

CREATE TABLE `ms_order_products` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `rate` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_order_products`
--

INSERT INTO `ms_order_products` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `rate`) VALUES
(1, 1, 1, 'seismic gps', '2', '1000'),
(2, 2, 1, 'seismic gps', '1', '1000'),
(3, 3, 1, 'seismic gps', '1', '1000'),
(4, 4, 1, 'seismic gps', '1', '1000'),
(5, 5, 1, 'seismic gps', '1', '1000'),
(6, 6, 1, 'seismic gps', '1', '10000'),
(7, 7, 1, 'seismic gps', '1', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `ms_products`
--

CREATE TABLE `ms_products` (
  `id` int(10) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` int(1) NOT NULL,
  `upload_date` date NOT NULL,
  `count_sales` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_products`
--

INSERT INTO `ms_products` (`id`, `product_title`, `category_id`, `image`, `short_description`, `color`, `weight`, `price`, `status`, `upload_date`, `count_sales`) VALUES
(1, 'seismic gps', 1, 'seismic_gps.jpg', 'great gps', 'blue ', '500gm', '10000', 0, '2021-07-14', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ms_sold_products`
--

CREATE TABLE `ms_sold_products` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ms_temp_address`
--

CREATE TABLE `ms_temp_address` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ms_users`
--

CREATE TABLE `ms_users` (
  `id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_users`
--

INSERT INTO `ms_users` (`id`, `fullname`, `email`, `mobile_no`, `password`, `address`, `register_date`) VALUES
(1, 'kumar', 'kumar@gmail.com', '9864037363', '1234567', 'bharatpur', '2021-07-14'),
(11, 'Prithvi Ojha', 'prithvi@gmail.com', '9864037363', '1234567', 'bharatpur', '2021-07-15'),
(12, 'Prithvi Ojha', 'test@gmail.com', '9864037363', '1234567', 'bharatpur', '2021-07-15'),
(13, 'Prithvi Ojha', 'prithviojha@gmail.com', '9864037363', '1234567', 'bharatpur', '2021-07-15'),
(14, 'testing', 'testing@gmail.com', '9845045731', '1234567', 'bharatpur', '2021-07-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_admin`
--
ALTER TABLE `ms_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_carts`
--
ALTER TABLE `ms_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_categories`
--
ALTER TABLE `ms_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_orders`
--
ALTER TABLE `ms_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_order_products`
--
ALTER TABLE `ms_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_products`
--
ALTER TABLE `ms_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_sold_products`
--
ALTER TABLE `ms_sold_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_temp_address`
--
ALTER TABLE `ms_temp_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_users`
--
ALTER TABLE `ms_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ms_admin`
--
ALTER TABLE `ms_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ms_carts`
--
ALTER TABLE `ms_carts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ms_categories`
--
ALTER TABLE `ms_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ms_orders`
--
ALTER TABLE `ms_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ms_order_products`
--
ALTER TABLE `ms_order_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ms_products`
--
ALTER TABLE `ms_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ms_sold_products`
--
ALTER TABLE `ms_sold_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ms_temp_address`
--
ALTER TABLE `ms_temp_address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ms_users`
--
ALTER TABLE `ms_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
