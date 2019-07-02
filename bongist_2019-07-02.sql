# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25)
# Database: bongist
# Generation Time: 2019-07-02 11:59:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `suspend` int(11) NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `photo`, `phone`, `address`, `suspend`, `timestamp`)
VALUES
	(2,'James Audu','psalm294u@gmail.com',NULL,'avatar.png','07037788243','86 Atiku Abubakar Way',0,1561689986);

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_notes`;

CREATE TABLE `order_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(10) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `note` text,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_notes` WRITE;
/*!40000 ALTER TABLE `order_notes` DISABLE KEYS */;

INSERT INTO `order_notes` (`id`, `order_id`, `staff_id`, `note`, `timestamp`)
VALUES
	(1,'d2a37',1,'This is awesome',1561702013);

/*!40000 ALTER TABLE `order_notes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_status`;

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;

INSERT INTO `order_status` (`id`, `name`, `color`, `slug`)
VALUES
	(1,'Pending',NULL,'pending'),
	(2,'Cutting',NULL,'cutting'),
	(3,'Preparation',NULL,'preparation'),
	(4,'Finishing',NULL,'finishing'),
	(5,'Ready',NULL,'ready'),
	(6,'Delivered',NULL,'delivered');

/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `date_of_delivery` varchar(100) DEFAULT NULL,
  `initial_deposit` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `customer_id`, `cost`, `date_of_delivery`, `initial_deposit`, `staff_id`, `status`, `timestamp`, `order_id`)
VALUES
	(2,2,2300,'2019-07-16',1000,1,1,1561702013,'d2a37');

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table staff
# ------------------------------------------------------------

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;

INSERT INTO `staff` (`id`, `password`, `name`, `email`, `phone`, `address`, `photo`, `suspend`, `timestamp`, `role`)
VALUES
	(1,'$2y$09$0Ics1ubaJMl9y81h2gJOXu8LtSBRqg1TuOgFgnRPbC8.UavCAtbCC','admin','info@bongistkoncept.com',NULL,NULL,'avatar.png',0,NULL,2);

/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
