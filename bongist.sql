/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80016
 Source Host           : localhost:3306
 Source Schema         : bongist

 Target Server Type    : MySQL
 Target Server Version : 80016
 File Encoding         : 65001

 Date: 26/07/2019 12:30:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `order_id` varchar(20) DEFAULT NULL,
  `expense_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of activities
-- ----------------------------
BEGIN;
INSERT INTO `activities` VALUES (4, 1, '8y5r2', NULL, NULL, NULL, 'added an order', 1562155292);
INSERT INTO `activities` VALUES (12, 10, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562165328);
INSERT INTO `activities` VALUES (14, 11, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562183444);
INSERT INTO `activities` VALUES (15, 12, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562184502);
INSERT INTO `activities` VALUES (16, 13, NULL, NULL, NULL, NULL, 'was just added as a staff', 1562184679);
INSERT INTO `activities` VALUES (20, 13, NULL, 3, NULL, NULL, 'just edited an expense', 1562239993);
INSERT INTO `activities` VALUES (21, 13, NULL, 3, NULL, NULL, 'just edited an expense', 1562240218);
INSERT INTO `activities` VALUES (37, 15, '3', NULL, NULL, NULL, 'added a note', 1562282462);
INSERT INTO `activities` VALUES (41, 15, '38oji', NULL, NULL, NULL, 'added a note', 1562283620);
INSERT INTO `activities` VALUES (43, 15, '38oji', NULL, NULL, NULL, 'added a note', 1562283801);
INSERT INTO `activities` VALUES (45, 15, NULL, NULL, NULL, NULL, 'added an expense category', 1562285977);
INSERT INTO `activities` VALUES (46, 15, NULL, 6, NULL, NULL, 'made an expense', 1562763687);
INSERT INTO `activities` VALUES (47, 1, '11fqi', NULL, NULL, NULL, 'added an order', 1562845811);
INSERT INTO `activities` VALUES (48, 1, '96ldr', NULL, NULL, NULL, 'added an order', 1562846166);
INSERT INTO `activities` VALUES (49, 1, 'b4pl4', NULL, NULL, NULL, 'added an order', 1562846613);
INSERT INTO `activities` VALUES (50, 1, 'pi21l', NULL, NULL, NULL, 'added an order', 1562846788);
INSERT INTO `activities` VALUES (51, 0, NULL, NULL, 1, NULL, 'added a payment', 1563188458);
INSERT INTO `activities` VALUES (52, 0, NULL, NULL, 2, NULL, 'added a payment', 1563189005);
INSERT INTO `activities` VALUES (53, 0, NULL, NULL, 3, NULL, 'added a payment', 1563189844);
INSERT INTO `activities` VALUES (54, 1, 'bzmld', NULL, NULL, NULL, 'added an order', 1563270911);
INSERT INTO `activities` VALUES (55, 1, 'e9rdo', NULL, NULL, NULL, 'added an order', 1563271457);
INSERT INTO `activities` VALUES (56, 1, 'wg3nz', NULL, NULL, NULL, 'added an order', 1563272673);
INSERT INTO `activities` VALUES (57, 1, 'drq63', NULL, NULL, NULL, 'added an order', 1563272786);
INSERT INTO `activities` VALUES (58, 1, 'pd2wn', NULL, NULL, NULL, 'added an order', 1563272885);
INSERT INTO `activities` VALUES (59, 1, 'b37e1', NULL, NULL, NULL, 'added an order', 1563273954);
INSERT INTO `activities` VALUES (60, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563444634);
INSERT INTO `activities` VALUES (61, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445082);
INSERT INTO `activities` VALUES (62, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445123);
INSERT INTO `activities` VALUES (63, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445160);
INSERT INTO `activities` VALUES (64, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445221);
INSERT INTO `activities` VALUES (65, 1, 'pi21l', NULL, NULL, NULL, 'added a note', 1563445249);
INSERT INTO `activities` VALUES (66, 1, NULL, 7, NULL, NULL, 'added an expense', 1563487930);
INSERT INTO `activities` VALUES (67, 1, NULL, 8, NULL, NULL, 'added an expense', 1563489027);
INSERT INTO `activities` VALUES (68, 0, NULL, NULL, 3, NULL, 'added a payment', 1563538682);
INSERT INTO `activities` VALUES (69, 1, NULL, NULL, 4, NULL, 'added a payment', 1563915195);
INSERT INTO `activities` VALUES (70, 1, NULL, NULL, 4, NULL, 'added a payment', 1563915342);
INSERT INTO `activities` VALUES (71, 1, NULL, NULL, 5, NULL, 'added a payment', 1563915515);
INSERT INTO `activities` VALUES (72, 1, NULL, NULL, 6, NULL, 'added a payment', 1563915607);
INSERT INTO `activities` VALUES (73, 1, NULL, NULL, 4, NULL, 'added a payment', 1563915619);
INSERT INTO `activities` VALUES (74, 1, NULL, NULL, 4, NULL, 'added a payment', 1563915670);
INSERT INTO `activities` VALUES (75, 1, NULL, NULL, 4, NULL, 'added a payment', 1563915675);
COMMIT;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `suspend` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customers
-- ----------------------------
BEGIN;
INSERT INTO `customers` VALUES (2, 'James Audu', 'psalm294u@gmail.com', NULL, 'avatar.png', '07037788243', '86 Atiku Abubakar Way', 0, 1561689986, 'feb', '2019');
INSERT INTO `customers` VALUES (3, 'Kenneth Ekandem', 'lilkenzy02@gmail.com', NULL, 'avatar.png', '08081730456', 'idoro', 0, 1562086602, 'may', '2019');
INSERT INTO `customers` VALUES (4, 'Ovie Tennyson', 'tennyson@codekago.com', NULL, 'avatar.png', '09067170010', '1866 Harrison Street', 0, 1563271457, 'jul', '2019');
COMMIT;

-- ----------------------------
-- Table structure for expense_category
-- ----------------------------
DROP TABLE IF EXISTS `expense_category`;
CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of expense_category
-- ----------------------------
BEGIN;
INSERT INTO `expense_category` VALUES (1, 'fuel');
INSERT INTO `expense_category` VALUES (2, 'office');
INSERT INTO `expense_category` VALUES (3, 'starch');
INSERT INTO `expense_category` VALUES (4, 'salary');
COMMIT;

-- ----------------------------
-- Table structure for expenses
-- ----------------------------
DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `cost` int(11) NOT NULL,
  `expense_type` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of expenses
-- ----------------------------
BEGIN;
INSERT INTO `expenses` VALUES (1, 1, 'this is the first expense', 3000, NULL, 1, 1562171653);
INSERT INTO `expenses` VALUES (3, 13, 'A very unusual test again', 2500, NULL, 1, 1562240218);
INSERT INTO `expenses` VALUES (5, 15, 'this is an expense', 2000, NULL, 1, 1562260120);
INSERT INTO `expenses` VALUES (6, 15, 'this is a salary expense', 10000, NULL, 4, 1562763687);
INSERT INTO `expenses` VALUES (7, 1, 'this is to test type', 2000, '0', 1, 1563487930);
INSERT INTO `expenses` VALUES (8, 1, 'this is another', 3000, '0', 3, 1563489027);
COMMIT;

-- ----------------------------
-- Table structure for order_notes
-- ----------------------------
DROP TABLE IF EXISTS `order_notes`;
CREATE TABLE `order_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(10) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `note` text,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_notes
-- ----------------------------
BEGIN;
INSERT INTO `order_notes` VALUES (1, 'd2a37', 1, 'This is awesome', 1561702013);
INSERT INTO `order_notes` VALUES (2, '38oji', 1, 'this is a test', 1562086603);
INSERT INTO `order_notes` VALUES (3, 'gzvah', 1, 'this is testing my activity', 1562153701);
INSERT INTO `order_notes` VALUES (4, 'iywwe', 1, 'okay', 1562153859);
INSERT INTO `order_notes` VALUES (5, 'kwibd', 1, 'okay', 1562154089);
INSERT INTO `order_notes` VALUES (6, '8y5r2', 1, 'okay', 1562155292);
INSERT INTO `order_notes` VALUES (10, '38oji', 15, 'this is preparation note', 1562283801);
INSERT INTO `order_notes` VALUES (11, '11fqi', 1, '5', 1562845811);
INSERT INTO `order_notes` VALUES (12, '96ldr', 1, 'okay', 1562846166);
INSERT INTO `order_notes` VALUES (13, 'b4pl4', 1, '1000', 1562846613);
INSERT INTO `order_notes` VALUES (14, 'pi21l', 1, 'this is awesome', 1562846788);
INSERT INTO `order_notes` VALUES (15, 'bzmld', 1, 'This is the testing of customer default image. ', 1563270911);
INSERT INTO `order_notes` VALUES (16, 'e9rdo', 1, 'This is to test my default customer photo.', 1563271457);
INSERT INTO `order_notes` VALUES (17, 'wg3nz', 1, 'testing twice', 1563272673);
INSERT INTO `order_notes` VALUES (18, 'drq63', 1, 'okay', 1563272786);
INSERT INTO `order_notes` VALUES (19, 'pd2wn', 1, 'just intense', 1563272885);
INSERT INTO `order_notes` VALUES (20, 'b37e1', 1, 'just okay', 1563273954);
INSERT INTO `order_notes` VALUES (21, 'pi21l', 1, 'this is a new note', 1563444634);
COMMIT;

-- ----------------------------
-- Table structure for order_status
-- ----------------------------
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_status
-- ----------------------------
BEGIN;
INSERT INTO `order_status` VALUES (1, 'Pending', NULL, 'Pending');
INSERT INTO `order_status` VALUES (2, 'Digitalizing', NULL, 'Digitalizing');
INSERT INTO `order_status` VALUES (3, 'Machine Processing', NULL, 'Machine Processing');
INSERT INTO `order_status` VALUES (4, 'Finishing', NULL, 'Finishing');
INSERT INTO `order_status` VALUES (5, 'Delivered', NULL, 'Delivered');
COMMIT;

-- ----------------------------
-- Table structure for order_type
-- ----------------------------
DROP TABLE IF EXISTS `order_type`;
CREATE TABLE `order_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_type
-- ----------------------------
BEGIN;
INSERT INTO `order_type` VALUES (1, 'Sewing');
INSERT INTO `order_type` VALUES (2, 'Branding');
INSERT INTO `order_type` VALUES (3, 'Services');
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `year` varchar(100) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
INSERT INTO `orders` VALUES (11, 3, 600, '2019-07-04', 500, 1, 'pi21l', 1, 3, 6, 1562846788, 'feb', '2019', NULL);
INSERT INTO `orders` VALUES (13, 4, 1200, '2019-07-26', 500, 1, 'e9rdo', 1, 2, 1, 1563271457, 'feb', '2019', 0);
INSERT INTO `orders` VALUES (14, 4, 1000, '2019-07-18', 1000, 1, 'wg3nz', 1, 2, 3, 1563272673, 'mar', '2019', NULL);
INSERT INTO `orders` VALUES (16, 4, 500, '2019-07-18', 500, 1, 'pd2wn', 1, 3, 5, 1563272884, 'jun', '2019', NULL);
INSERT INTO `orders` VALUES (17, 4, 1300, '2019-07-20', 1200, 2, 'b37e1', 1, 2, 2, 1563273953, 'sep', '2019', NULL);
COMMIT;

-- ----------------------------
-- Table structure for payment_category
-- ----------------------------
DROP TABLE IF EXISTS `payment_category`;
CREATE TABLE `payment_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_category
-- ----------------------------
BEGIN;
INSERT INTO `payment_category` VALUES (1, 'POS');
INSERT INTO `payment_category` VALUES (2, 'Transfer');
INSERT INTO `payment_category` VALUES (3, 'Cash');
INSERT INTO `payment_category` VALUES (4, 'Wallet');
COMMIT;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ref_no` varchar(100) DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payments
-- ----------------------------
BEGIN;
INSERT INTO `payments` VALUES (2, 3, 'pi21l', 2, 500, '', 1563189005, NULL);
INSERT INTO `payments` VALUES (3, 4, 'b37e1', 2, 1200, '', 1563538681, NULL);
INSERT INTO `payments` VALUES (4, 4, 'e9rdo', 1, 900, NULL, 1563915675, NULL);
INSERT INTO `payments` VALUES (5, 4, 'e9rdo', 2, 200, NULL, 1563915515, 1);
INSERT INTO `payments` VALUES (6, 4, 'e9rdo', 3, 100, NULL, 1563915607, 1);
COMMIT;

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(200) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `suspend` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `password_reset` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of staff
-- ----------------------------
BEGIN;
INSERT INTO `staff` VALUES (1, '$2y$09$Nwz0HXUdO6zirCBmLbsrvulUFEyqldyZqMQoskskBb2ks8f7juSZe', 'admin', 'info@bongistkoncept.com', NULL, 'Shelter Afrique', 'avatar.png', 0, NULL, 1, '');
INSERT INTO `staff` VALUES (15, '$2y$09$8SXtIpJrlhtgaCop9bDcguZ63eriEyh8pt55GefOrrMvZBdBGjnCC', 'Kenneth Ekandem', 'lilkenzy02@gmail.com', '08081730456', 'Abak Road', '561c5b06e7d5bcbceedfb325344f4674612d6411.jpg', 0, 1562240971, 2, NULL);
COMMIT;

-- ----------------------------
-- Table structure for staff_role
-- ----------------------------
DROP TABLE IF EXISTS `staff_role`;
CREATE TABLE `staff_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of staff_role
-- ----------------------------
BEGIN;
INSERT INTO `staff_role` VALUES (1, 'Admin');
INSERT INTO `staff_role` VALUES (2, 'Admin Officer');
INSERT INTO `staff_role` VALUES (3, 'Manager');
INSERT INTO `staff_role` VALUES (4, 'Supervisor');
INSERT INTO `staff_role` VALUES (5, 'Operator');
INSERT INTO `staff_role` VALUES (6, 'Sewing Staff');
INSERT INTO `staff_role` VALUES (7, 'Branding Staff');
COMMIT;

-- ----------------------------
-- Table structure for type_category
-- ----------------------------
DROP TABLE IF EXISTS `type_category`;
CREATE TABLE `type_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of type_category
-- ----------------------------
BEGIN;
INSERT INTO `type_category` VALUES (1, 2, 'Monogram');
INSERT INTO `type_category` VALUES (2, 2, 'Heat Transfer');
INSERT INTO `type_category` VALUES (3, 2, 'Screen Printing');
INSERT INTO `type_category` VALUES (4, 2, 'Floss');
INSERT INTO `type_category` VALUES (5, 3, 'Button');
INSERT INTO `type_category` VALUES (6, 3, 'Stitching');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
