-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2017 at 06:46 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderId` int(11) NOT NULL,
  `productCode` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderId`, `productCode`, `quantity`) VALUES
(25, 10063112, 1),
(25, 10064440, 2),
(25, 10062412, 1),
(26, 10064908, 3),
(27, 10065324, 2),
(30, 10065480, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_main`
--

CREATE TABLE `order_main` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_main`
--

INSERT INTO `order_main` (`orderId`, `userId`) VALUES
(25, 54),
(26, 55),
(27, 56),
(30, 59);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productCode` bigint(20) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `productPrice` float NOT NULL,
  `productImg` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productCode`, `productName`, `productPrice`, `productImg`) VALUES
(4, 10063112, 'Xbox Live Gold Members:', 1.99, 'https://static.slickdealscdn.com/attachment//2/5/1/6/8/8/6/200x200/5432892.thumb'),
(5, 10064440, 'TP-Link HS100 WiFi-Enabled Smart', 17.99, 'https://static.slickdealscdn.com/attachment//6/3/5/1/6/200x200/5432772.thumb'),
(6, 10062412, 'ADD-ON ITEM: Walkers Shortbread', 4.19, 'https://static.slickdealscdn.com/attachment//1/6/7/9/8/1/2/200x200/5432712.thumb'),
(7, 10064908, 'Ringke cases for Galaxy', 0.42, 'https://static.slickdealscdn.com/attachment//3/5/9/4/0/2/8/200x200/5433088.thumb'),
(8, 10065324, 'Logan Pre-Order (4K Ultra', 25.99, 'https://static.slickdealscdn.com/attachment//2/8/9/1/1/200x200/5433276.thumb'),
(9, 10065324, 'Logan Pre-Order (4K Ultra', 25.99, 'https://static.slickdealscdn.com/attachment//2/8/9/1/1/200x200/5433276.thumb'),
(10, 10065324, 'Logan Pre-Order (4K Ultra', 25.99, 'https://static.slickdealscdn.com/attachment//2/8/9/1/1/200x200/5433276.thumb'),
(11, 10065480, '4-Pack Honeywell Allergen Plus', 19.99, 'https://static.slickdealscdn.com/attachment//1/8/6/7/1/1/4/200x200/5433420.thumb');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPhone` bigint(20) NOT NULL,
  `userAddress` varchar(350) NOT NULL,
  `userPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPhone`, `userAddress`, `userPassword`) VALUES
(54, 'Varsha', 'ubhrani.varsha@gmail.com', 3612285724, '440 Dixon Landing Road, # P 306', 'jjjkkk'),
(55, 'VarshaUUUU', 'ubhrani.varsha@gmail.com', 3000285724, '3939 Monroe Ave, 258', 'heyya'),
(56, 'vvv', 'yyuu@k.com', 3612285724, 'nnnn', ''),
(59, 'Vishal', 'varsha.pramod.selenium@gmail.com', 3612285724, '3939 Monroe Ave, Apt#258', 'ubhRani@13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `orderId` (`orderId`),
  ADD KEY `orderId_2` (`orderId`);

--
-- Indexes for table `order_main`
--
ALTER TABLE `order_main`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_main`
--
ALTER TABLE `order_main`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_main` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_main`
--
ALTER TABLE `order_main`
  ADD CONSTRAINT `user_table` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
