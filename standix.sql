/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80016
 Source Host           : localhost:3306
 Source Schema         : standix

 Target Server Type    : MySQL
 Target Server Version : 80016
 File Encoding         : 65001

 Date: 25/07/2019 07:51:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `referral` varchar(100) DEFAULT NULL,
  `verification_code` varchar(100) DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT '0',
  `suspend` int(11) NOT NULL DEFAULT '0',
  `password_reset` varchar(100) DEFAULT NULL,
  `auth_login` int(11) NOT NULL DEFAULT '0',
  `auth_code` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `sax` varchar(20) NOT NULL DEFAULT '10',
  `bonus` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------
BEGIN;
INSERT INTO `accounts` VALUES (1, 'psalm29', 'Samuel Ogu', 'psalm294u@gmail.com', NULL, '$2y$10$7qVuYmSd.qWsX9UidA77quRrfoxYbYCUFuQyPPRPXUHRwOCzEwL8i', 'avatar.png', '', '', 1, 0, NULL, 0, NULL, 1548409765, '10', '0');
COMMIT;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `referral` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for bonus
-- ----------------------------
DROP TABLE IF EXISTS `bonus`;
CREATE TABLE `bonus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `investment_id` varchar(100) DEFAULT NULL,
  `amount` varchar(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for conversations
-- ----------------------------
DROP TABLE IF EXISTS `conversations`;
CREATE TABLE `conversations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(30) DEFAULT NULL,
  `receiver` varchar(30) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for deposit
-- ----------------------------
DROP TABLE IF EXISTS `deposit`;
CREATE TABLE `deposit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `amount` varchar(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for matrix
-- ----------------------------
DROP TABLE IF EXISTS `matrix`;
CREATE TABLE `matrix` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matrix_id` varchar(100) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `referral` varchar(20) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for packs
-- ----------------------------
DROP TABLE IF EXISTS `packs`;
CREATE TABLE `packs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `sax_bonus` int(11) NOT NULL DEFAULT '0',
  `direct_referral` int(11) DEFAULT NULL,
  `indirect_referral` int(11) DEFAULT NULL,
  `investment` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of packs
-- ----------------------------
BEGIN;
INSERT INTO `packs` VALUES (1, 'BRONZE SAX PACK', 10, NULL, 0, 5, 5, '28005.40');
INSERT INTO `packs` VALUES (2, 'SILVER SAX PACK', 50, NULL, 10, 5, 5, '140027');
INSERT INTO `packs` VALUES (3, 'GOLD SAX PACK', 100, NULL, 20, 5, 5, '280054');
INSERT INTO `packs` VALUES (4, 'PLATINIUM SAX PACK', 200, NULL, 40, 5, 5, '560108');
INSERT INTO `packs` VALUES (5, 'DIAMOND X2 SAX PACK', 400, NULL, 80, 5, 5, '1120216');
INSERT INTO `packs` VALUES (6, 'TITANIUM', 1000, NULL, 160, 5, 5, '2800050.40');
COMMIT;

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pack_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase
-- ----------------------------
BEGIN;
INSERT INTO `purchase` VALUES (1, 1, 'psalm29', 4567866);
INSERT INTO `purchase` VALUES (2, 1, 'david', 123456);
INSERT INTO `purchase` VALUES (3, 1, 'solo', 12332343);
INSERT INTO `purchase` VALUES (4, 1, 'wisdom', 65432345);
INSERT INTO `purchase` VALUES (5, 1, 'brenda', 76543234);
INSERT INTO `purchase` VALUES (6, 1, 'james', 2147483647);
INSERT INTO `purchase` VALUES (7, 1, 'miracle', 4565434);
INSERT INTO `purchase` VALUES (8, 1, 'ogu', 234565);
INSERT INTO `purchase` VALUES (9, 2, 'psalm29', 1550069492);
COMMIT;

-- ----------------------------
-- Table structure for referral
-- ----------------------------
DROP TABLE IF EXISTS `referral`;
CREATE TABLE `referral` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `referral` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of referral
-- ----------------------------
BEGIN;
INSERT INTO `referral` VALUES (1, 'sam', 'psalm29', 234567);
COMMIT;

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `wallet` varchar(100) DEFAULT NULL,
  `btc_amount` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `sax` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for wallets
-- ----------------------------
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE `wallets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `balance` varchar(11) NOT NULL DEFAULT '0',
  `address` varchar(100) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `last_updated` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  `referral` varchar(11) NOT NULL DEFAULT '0',
  `bonus` varchar(11) NOT NULL DEFAULT '0',
  `standix` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wallets
-- ----------------------------
BEGIN;
INSERT INTO `wallets` VALUES (1, 'BTC Wallet', 'psalm29', '0', '3B5ec2gemxpPjdUfeJJ3zuBs5xcgMdxJuZ', 'psalm29', 1548505210, 1548505210, '0', '0', '3B5ec2gemxpPjdUfeJJ3zuBs5xcgMdxJuZ');
COMMIT;

-- ----------------------------
-- Table structure for withdrawal
-- ----------------------------
DROP TABLE IF EXISTS `withdrawal`;
CREATE TABLE `withdrawal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `amount` varchar(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
