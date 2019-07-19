-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 07:09 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bongist`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `order_id` varchar(20) DEFAULT NULL,
  `expense_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `staff_id`, `order_id`, `expense_id`, `comment`, `timestamp`) VALUES
(4, 1, '8y5r2', NULL, 'just added an order', 1562155292),
(12, 10, NULL, NULL, 'was just added as a staff', 1562165328),
(13, 1, NULL, 1, 'just made an expense', 1562171653),
(14, 11, NULL, NULL, 'was just added as a staff', 1562183444),
(15, 12, NULL, NULL, 'was just added as a staff', 1562184502),
(16, 13, NULL, NULL, 'was just added as a staff', 1562184679),
(17, 13, NULL, 2, 'just made an expense', 1562231432),
(18, 13, NULL, 3, 'just made an expense', 1562232228),
(20, 13, NULL, 3, 'just edited an expense', 1562239993),
(21, 13, NULL, 3, 'just edited an expense', 1562240218),
(22, 14, NULL, NULL, 'was just added as a staff', 1562240814),
(23, 15, NULL, NULL, 'was just added as a staff', 1562240971),
(24, 15, NULL, 4, 'just made an expense', 1562254887),
(25, 15, NULL, 4, 'just edited an expense', 1562254941),
(26, 15, NULL, 0, 'just edited an order', 1562258563),
(27, 15, NULL, 0, 'just edited an order', 1562258921),
(28, 15, NULL, NULL, 'just deleted an expense', 1562260097),
(29, 15, NULL, 5, 'just made an expense', 1562260120);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `suspend` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, customer_name, `email`, `password`, `photo`, `phone`, `address`, `suspend`, `timestamp`) VALUES
(2, 'James Audu', 'psalm294u@gmail.com', NULL, 'avatar.png', '07037788243', '86 Atiku Abubakar Way', 0, 1561689986),
(3, 'Kenneth Ekandem', 'lilkenzy02@gmail.com', NULL, 'avatar.png', '08081730456', 'idoro', 0, 1562086602);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `cost` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `staff_id`, `title`, `cost`, `category_id`, `timestamp`) VALUES
(1, 1, 'this is the first expense', 3000, 1, 1562171653),
(3, 13, 'A very unusual test again', 2500, 1, 1562240218),
(5, 15, 'this is an expense', 2000, 1, 1562260120);

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, category) VALUES
(1, 'fuel'),
(2, 'office');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `date_of_delivery` varchar(100) DEFAULT NULL,
  `initial_deposit` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `cost`, `date_of_delivery`, `initial_deposit`, `staff_id`, `status`, `timestamp`, `order_id`) VALUES
(2, 2, 2300, '2019-07-16', 1000, 1, 1, 1561702013, 'd2a37'),
(3, 3, 3000, '2019-07-11', 1000, 1, 1, 1562086602, '38oji'),
(7, 3, 2000, '2019-07-26', 2000, 1, 4, 1562155292, '8y5r2');

-- --------------------------------------------------------

--
-- Table structure for table `order_notes`
--

CREATE TABLE `order_notes` (
  `id` int(11) NOT NULL,
  `order_id` varchar(10) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `note` text,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_notes`
--

INSERT INTO `order_notes` (`id`, `order_id`, `staff_id`, `note`, `timestamp`) VALUES
(1, 'd2a37', 1, 'This is awesome', 1561702013),
(2, '38oji', 1, 'this is a test', 1562086603),
(3, 'gzvah', 1, 'this is testing my activity', 1562153701),
(4, 'iywwe', 1, 'okay', 1562153859),
(5, 'kwibd', 1, 'okay', 1562154089),
(6, '8y5r2', 1, 'okay', 1562155292);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_name`, `color`, `slug`) VALUES
(1, 'Pending', NULL, 'pending'),
(2, 'Cutting', NULL, 'cutting'),
(3, 'Preparation', NULL, 'preparation'),
(4, 'Finishing', NULL, 'finishing'),
(5, 'Ready', NULL, 'ready'),
(6, 'Delivered', NULL, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) UNSIGNED NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `suspend` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `password`, `name`, `email`, `phone`, `address`, `photo`, `suspend`, `timestamp`, `role`) VALUES
(1, '$2y$09$0Ics1ubaJMl9y81h2gJOXu8LtSBRqg1TuOgFgnRPbC8.UavCAtbCC', 'admin', 'info@bongistkoncept.com', NULL, NULL, 'avatar.png', 0, NULL, 2),
(15, '$2y$09$8SXtIpJrlhtgaCop9bDcguZ63eriEyh8pt55GefOrrMvZBdBGjnCC', 'Kenneth Ekandem', 'lilkenzy02@gmail.com', '08081730456', 'idoro', '73ab468b61144a3ba3179a35a56fc05b4d943f25.jpg', 0, 1562240971, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_notes`
--
ALTER TABLE `order_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_notes`
--
ALTER TABLE `order_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
