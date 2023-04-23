-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 21, 2023 at 04:54 AM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u938498053_scart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `username`, `email`, `password`, `is_verified`, `resettoken`, `resettokenexpire`) VALUES
(2, 'Ashley Fernandes', 'placidoashley9@gmail.com', '$2y$10$y9hll9z2dVDuGH2BLbLNcOXGN98hWuheHjIkzOhvQCfgCGXAftUdm', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `esp_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `esp_id`) VALUES
(101, 'ESP30');

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ver_code` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`customer_id`, `username`, `email`, `contact`, `password`, `ver_code`, `is_verified`, `resettoken`, `resettokenexpire`) VALUES
(93, 'Ashley', 'placidoashley9@gmail.com', '7030304288', '$2y$10$sd92aMsakFaTf1QVquA.J.vCDHpmeuTnxsJTOILoZzhfeOqs5S6.2', 'ddb6c9ac1f5de814', 1, NULL, NULL),
(80, 'jeevi04', 'jeevitaverekar133@gmail.com', '9145066278', '$2y$10$0/vcDLIqLjdt2Eu4msHqLe/pp..ct7i8/OrgKGFK6JMJAjrJrcLaa', '51ceb5d9b7134d52', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_product`
--

CREATE TABLE `ordered_product` (
  `order_id` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` varchar(11) NOT NULL,
  `order_date` date NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordered_product`
--

INSERT INTO `ordered_product` (`order_id`, `product_id`, `tag_id`, `order_date`, `price`) VALUES
(36338492, 8907, '043ABA32', '2023-04-19', '499'),
(36338492, 7899, '0413B832', '2023-04-19', '459');

--
-- Triggers `ordered_product`
--
DELIMITER $$
CREATE TRIGGER `update_sales` AFTER INSERT ON `ordered_product` FOR EACH ROW BEGIN
UPDATE sales s
SET s.sales=s.sales + 1
WHERE MONTH(New.order_date)=s.month;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `customer_id`, `cart_id`, `order_date`, `total_amount`) VALUES
(36338492, 93, 101, '2023-04-19', '958');

-- --------------------------------------------------------

--
-- Table structure for table `pdt_invt`
--

CREATE TABLE `pdt_invt` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pdt_invt`
--

INSERT INTO `pdt_invt` (`product_id`, `product_name`, `product_price`, `quantity`) VALUES
(1256, 'White t-shirt', '499', 4),
(5664, 'Maxi Dress', '569', 2),
(7899, 'Shorts', '459', 0),
(8907, 'Long Denim Pants', '499', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pdt_tag`
--

CREATE TABLE `pdt_tag` (
  `tag_id` varchar(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pdt_tag`
--

INSERT INTO `pdt_tag` (`tag_id`, `product_id`, `flag`) VALUES
('0440B832', 1256, 0),
('04187932', 1256, 0),
('0423B932', 1256, 0),
('040CB732', 1256, 0),
('0413B832', 7899, 1),
('0442BA32', 5664, 0),
('04107932', 5664, 0),
('0438B832', 8907, 0),
('043ABA32', 8907, 1);

--
-- Triggers `pdt_tag`
--
DELIMITER $$
CREATE TRIGGER `after_delete` AFTER DELETE ON `pdt_tag` FOR EACH ROW BEGIN
UPDATE pdt_invt pit
SET pit.quantity=pit.quantity - 1
WHERE pit.product_id = OLD.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_flag` AFTER UPDATE ON `pdt_tag` FOR EACH ROW BEGIN
UPDATE pdt_invt pit
SET pit.quantity=pit.quantity + 1
WHERE pit.product_id = OLD.product_id
&& NEW.flag=0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_flag_change` AFTER UPDATE ON `pdt_tag` FOR EACH ROW BEGIN
UPDATE pdt_invt pit
SET pit.quantity=pit.quantity - 1
WHERE pit.product_id = OLD.product_id
&& NEW.flag=1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_quantity` AFTER INSERT ON `pdt_tag` FOR EACH ROW BEGIN
UPDATE pdt_invt pit
SET pit.quantity=pit.quantity + 1
WHERE pit.product_id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `month` int(10) NOT NULL,
  `sales` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`month`, `sales`) VALUES
(1, 2),
(2, 3),
(3, 2),
(4, 42),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `esp_id` (`esp_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `ordered_product`
--
ALTER TABLE `ordered_product`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`) USING BTREE,
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `pdt_invt`
--
ALTER TABLE `pdt_invt`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `pdt_tag`
--
ALTER TABLE `pdt_tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
