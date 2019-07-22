-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 10:51 AM
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
  `payment_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `staff_id`, `order_id`, `expense_id`, `payment_id`, `customer_id`, `comment`, `timestamp`) VALUES
(4, 1, '8y5r2', NULL, NULL, NULL, 'added an order', 1562155292),
(12, 10, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562165328),
(14, 11, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562183444),
(15, 12, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562184502),
(16, 13, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562184679),
(20, 13, NULL, 3, NULL, NULL, 'just edited an expense', 1562239993),
(21, 13, NULL, 3, NULL, NULL, 'just edited an expense', 1562240218),
(37, 15, '3', NULL, NULL, NULL, 'added a note', 1562282462),
(41, 15, '38oji', NULL, NULL, NULL, 'added a note', 1562283620),
(43, 15, '38oji', NULL, NULL, NULL, 'added a note', 1562283801),
(45, 15, NULL, NULL, NULL, NULL, 'added an expense category', 1562285977),
(46, 15, NULL, 6, NULL, NULL, 'made an expense', 1562763687),
(47, 1, '11fqi', NULL, NULL, NULL, 'added an order', 1562845811),
(48, 1, '96ldr', NULL, NULL, NULL, 'added an order', 1562846166),
(49, 1, 'b4pl4', NULL, NULL, NULL, 'added an order', 1562846613),
(50, 1, 'pi21l', NULL, NULL, NULL, 'added an order', 1562846788),
(51, 0, NULL, NULL, 1, NULL, 'added a payment', 1563188458),
(52, 0, NULL, NULL, 2, NULL, 'added a payment', 1563189005),
(53, 0, NULL, NULL, 3, NULL, 'added a payment', 1563189844),
(54, 1, 'bzmld', NULL, NULL, NULL, 'added an order', 1563270911),
(55, 1, 'e9rdo', NULL, NULL, NULL, 'added an order', 1563271457),
(56, 1, 'wg3nz', NULL, NULL, NULL, 'added an order', 1563272673),
(57, 1, 'drq63', NULL, NULL, NULL, 'added an order', 1563272786),
(58, 1, 'pd2wn', NULL, NULL, NULL, 'added an order', 1563272885),
(59, 1, 'b37e1', NULL, NULL, NULL, 'added an order', 1563273954),
(60, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563444634),
(61, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445082),
(62, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445123),
(63, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445160),
(64, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445221),
(65, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445249),
(66, 1, NULL, 7, NULL, NULL, 'added an expense', 1563487930),
(67, 1, NULL, 8, NULL, NULL, 'added an expense', 1563489027),
(68, 0, NULL, NULL, 3, NULL, 'added a payment', 1563538682);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `suspend` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `email`, `password`, `photo`, `phone`, `address`, `suspend`, `timestamp`, `month`, `year`) VALUES
(2, 'James Audu', 'psalm294u@gmail.com', NULL, 'avatar.png', '07037788243', '86 Atiku Abubakar Way', 0, 1561689986, 'feb', '2019'),
(3, 'Kenneth Ekandem', 'lilkenzy02@gmail.com', NULL, 'avatar.png', '08081730456', 'idoro', 0, 1562086602, 'may', '2019'),
(4, 'Ovie Tennyson', 'tennyson@codekago.com', NULL, 'avatar.png', '09067170010', '1866 Harrison Street', 0, 1563271457, 'jul', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `cost` int(11) NOT NULL,
  `expense_type` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `staff_id`, `title`, `cost`, `expense_type`, `category_id`, `timestamp`) VALUES
(1, 1, 'this is the first expense', 3000, NULL, 1, 1562171653),
(3, 13, 'A very unusual test again', 2500, NULL, 1, 1562240218),
(5, 15, 'this is an expense', 2000, NULL, 1, 1562260120),
(6, 15, 'this is a salary expense', 10000, NULL, 4, 1562763687),
(7, 1, 'this is to test type', 2000, '0', 1, 1563487930),
(8, 1, 'this is another', 3000, '0', 3, 1563489027);

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `category`) VALUES
(1, 'fuel'),
(2, 'office'),
(3, 'starch'),
(4, 'salary');

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
  `status` int(11) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `subcat_id` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `cost`, `date_of_delivery`, `initial_deposit`, `status`, `order_id`, `staff_id`, `type_id`, `subcat_id`, `timestamp`, `month`, `year`) VALUES
(11, 3, 600, '2019-07-04', 500, 1, 'pi21l', 1, 3, 6, 1562846788, 'feb', '2019'),
(13, 4, 1200, '2019-07-26', 1000, 1, 'e9rdo', 1, 2, 1, 1563271457, 'feb', '2019'),
(14, 4, 1000, '2019-07-18', 1000, 1, 'wg3nz', 1, 2, 3, 1563272673, 'mar', '2019'),
(16, 4, 500, '2019-07-18', 500, 1, 'pd2wn', 1, 3, 5, 1563272884, 'jun', '2019'),
(17, 4, 1300, '2019-07-20', 1200, 2, 'b37e1', 1, 2, 2, 1563273953, 'sep', '2019');

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
(6, '8y5r2', 1, 'okay', 1562155292),
(10, '38oji', 15, 'this is preparation note', 1562283801),
(11, '11fqi', 1, '5', 1562845811),
(12, '96ldr', 1, 'okay', 1562846166),
(13, 'b4pl4', 1, '1000', 1562846613),
(14, 'pi21l', 1, 'this is awesome', 1562846788),
(15, 'bzmld', 1, 'This is the testing of customer default image. ', 1563270911),
(16, 'e9rdo', 1, 'This is to test my default customer photo.', 1563271457),
(17, 'wg3nz', 1, 'testing twice', 1563272673),
(18, 'drq63', 1, 'okay', 1563272786),
(19, 'pd2wn', 1, 'just intense', 1563272885),
(20, 'b37e1', 1, 'just okay', 1563273954),
(21, 'pi21l', 1, 'this is a new note', 1563444634);

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
(1, 'Pending', NULL, 'Pending'),
(2, 'Digitalizing', NULL, 'Digitalizing'),
(3, 'Machine Processing', NULL, 'Machine Processing'),
(4, 'Finishing', NULL, 'Finishing'),
(5, 'Delivered', NULL, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `order_type`
--

CREATE TABLE `order_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_type`
--

INSERT INTO `order_type` (`id`, `type`) VALUES
(1, 'Sewing'),
(2, 'Branding'),
(3, 'Services');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `order_id`, `payment_method`, `amount`, `ref_no`, `timestamp`) VALUES
(2, 3, 'pi21l', 2, 500, '', 1563189005),
(3, 4, 'b37e1', 2, 1200, '', 1563538681);

-- --------------------------------------------------------

--
-- Table structure for table `payment_category`
--

CREATE TABLE `payment_category` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_category`
--

INSERT INTO `payment_category` (`id`, `type`) VALUES
(1, 'POS'),
(2, 'Transfer'),
(3, 'Cash'),
(4, 'Wallet');

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
(1, '$2y$09$0Ics1ubaJMl9y81h2gJOXu8LtSBRqg1TuOgFgnRPbC8.UavCAtbCC', 'admin', 'info@bongistkoncept.com', NULL, 'Shelter Afrique', 'avatar.png', 0, NULL, 1),
(15, '$2y$09$8SXtIpJrlhtgaCop9bDcguZ63eriEyh8pt55GefOrrMvZBdBGjnCC', 'Kenneth Ekandem', 'lilkenzy02@gmail.com', '08081730456', 'Abak Road', '561c5b06e7d5bcbceedfb325344f4674612d6411.jpg', 0, 1562240971, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staff_role`
--

CREATE TABLE `staff_role` (
  `id` int(11) NOT NULL,
  `role_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_role`
--

INSERT INTO `staff_role` (`id`, `role_type`) VALUES
(1, 'Admin'),
(2, 'Admin Officer'),
(3, 'Manager'),
(4, 'Supervisor'),
(5, 'Operator'),
(6, 'Sewing Staff'),
(7, 'Branding Staff');

-- --------------------------------------------------------

--
-- Table structure for table `type_category`
--

CREATE TABLE `type_category` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_category`
--

INSERT INTO `type_category` (`id`, `type_id`, `category`) VALUES
(1, 2, 'Monogram'),
(2, 2, 'Heat Transfer'),
(3, 2, 'Screen Printing'),
(4, 2, 'Floss'),
(5, 3, 'Button'),
(6, 3, 'Stitching');

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
-- Indexes for table `order_type`
--
ALTER TABLE `order_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_category`
--
ALTER TABLE `payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_role`
--
ALTER TABLE `staff_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_category`
--
ALTER TABLE `type_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_notes`
--
ALTER TABLE `order_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_type`
--
ALTER TABLE `order_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_category`
--
ALTER TABLE `payment_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff_role`
--
ALTER TABLE `staff_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_category`
--
ALTER TABLE `type_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
