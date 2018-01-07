-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: govknow
-- ------------------------------------------------------
-- Server version	5.5.58-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `govknow`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `work` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `work`;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postcode` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_code` (`postcode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'SE21 8JL','England','London'),(2,'EC1A 1HQ','England','London');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_contact`
--

DROP TABLE IF EXISTS `address_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_contact_address_idx` (`address_id`),
  KEY `fk_address_contact_contact_idx` (`contact_id`),
  CONSTRAINT `fk_address_contact_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_contact_contact` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_contact`
--

LOCK TABLES `address_contact` WRITE;
/*!40000 ALTER TABLE `address_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_organisation`
--

DROP TABLE IF EXISTS `address_organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_organisation` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_organisation_address_idx` (`address_id`),
  KEY `fk_address_organisation_organisation_idx` (`organisation_id`),
  CONSTRAINT `fk_address_organisation_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_organisation_organisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_organisation`
--

LOCK TABLES `address_organisation` WRITE;
/*!40000 ALTER TABLE `address_organisation` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `submission` int(11) DEFAULT NULL,
  `entry_time` datetime DEFAULT NULL,
  `userLevel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recordType` text,
  `recordStatus` text,
  `email` varchar(45) DEFAULT NULL,
  `instruction` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `jobtitle` varchar(45) DEFAULT NULL,
  `personType` text,
  `twitter` varchar(45) DEFAULT NULL,
  `linkedln` varchar(45) DEFAULT NULL,
  `professionalInterest` varchar(45) DEFAULT NULL,
  `professionalWeb` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `telephone2` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `organisation` varchar(45) DEFAULT NULL,
  `departmentLevel1` varchar(45) DEFAULT NULL,
  `dapartmentLevel2` varchar(45) DEFAULT NULL,
  `biographyText` varchar(45) DEFAULT NULL,
  `notes` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `entry_time` datetime DEFAULT NULL,
  `postcode` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'generic','deceased','18221167541@163.com','ddds','fd','ddfd','pengfei','fddf','academic - researcher',NULL,'ddsdds','dffdfddf',NULL,'18221167541@163.com','18301982730','18301982730','bilibili','11',NULL,'dfffd','dffdfd','2017-12-20 10:49:14','2017-12-20 10:49:14','2017-12-20 10:49:14','','',''),(2,'generic','','','test','','','','job','no',NULL,'','',NULL,'','','','bilibili','',NULL,'','','2017-12-20 22:31:50','2017-12-27 01:05:55','2017-12-20 22:31:50','','china','yangpu'),(3,'generic','','18221167541@163.com','test','','feng','pengfei','job','no',NULL,'','',NULL,'18221167541@163.com','','','bilibili','',NULL,'','','2017-12-23 05:29:36','2017-12-27 01:07:35','2017-12-23 05:29:36','','pairs','yangpu'),(4,'generic','','18221167541@163.com','mo','','feng','pengfei','fd','no',NULL,'','',NULL,'18221167541@163.com','','','bilibili','',NULL,'','','2017-12-23 05:29:59','2017-12-27 13:52:34','2017-12-23 05:29:59','','England','London'),(6,'generic','','','','','','','','',NULL,'','',NULL,'','','','orz','',NULL,'','','2017-12-26 15:10:33','2017-12-26 15:10:33','2017-12-26 15:10:33','','',''),(7,'generic','','','','','','','','',NULL,'','',NULL,'','','','orz','',NULL,'','','2017-12-26 15:11:05','2017-12-26 15:11:05','2017-12-26 15:11:05','','',''),(8,'generic','','','','','','','','',NULL,'','',NULL,'','','','orz','',NULL,'','','2017-12-26 15:14:09','2017-12-26 15:14:09','2017-12-26 15:14:09','','',''),(9,'generic','','','haha','','','','','',NULL,'','',NULL,'','','','orz','',NULL,'','','2017-12-26 15:14:10','2018-01-05 12:12:22','2017-12-26 15:14:10','','',''),(22,'generic','','','gaga','','','','','',NULL,'','',NULL,'','','','test','',NULL,'','','2017-12-26 16:34:45','2017-12-26 16:34:45','2017-12-26 16:34:45','','',''),(23,'generic','','','test','','','','job','no',NULL,'','',NULL,'','','','yis','',NULL,'','','2017-12-26 16:35:01','2017-12-27 01:05:22','2017-12-26 16:35:01','SE21 8JL','England','London'),(24,'generic','delete-other','','add contact','','','','','academic - senior management',NULL,'','',NULL,'','','','orz','',NULL,'','','2017-12-27 11:36:50','2017-12-27 11:36:50','2017-12-27 11:36:50','','',''),(25,'generic','','','test0001','','','Paul','it','',NULL,'111111111','',NULL,'','','','orz12','',NULL,'','','2017-12-27 13:51:14','2017-12-27 13:51:14','2017-12-27 13:51:14','SE21 8JL','England','London'),(26,'generic','','','','','','','','',NULL,'','',NULL,'','','','','',NULL,'','','2018-01-05 04:25:44','2018-01-05 04:25:44','2018-01-05 04:25:44','','',''),(27,'generic','','','','','','','','',NULL,'','',NULL,'','','','','',NULL,'','','2018-01-05 04:25:44','2018-01-05 04:25:44','2018-01-05 04:25:44','','',''),(28,'generic','','','','','','','','',NULL,'','',NULL,'','','','','',NULL,'','','2018-01-05 04:28:43','2018-01-05 04:28:43','2018-01-05 04:28:43','','',''),(29,'generic','','','','','','','','',NULL,'','',NULL,'','','','','',NULL,'','','2018-01-05 04:40:13','2018-01-05 04:40:13','2018-01-05 04:40:13','','','');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataupload`
--

DROP TABLE IF EXISTS `dataupload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataupload` (
  `id` int(11) NOT NULL,
  `repository` text,
  `file` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataupload`
--

LOCK TABLES `dataupload` WRITE;
/*!40000 ALTER TABLE `dataupload` DISABLE KEYS */;
/*!40000 ALTER TABLE `dataupload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_category`
--

DROP TABLE IF EXISTS `org_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_org_category_category_idx` (`category_id`),
  KEY `fk_org_category_organisation_idx` (`organisation_id`),
  CONSTRAINT `fk_org_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_org_category_organisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_category`
--

LOCK TABLES `org_category` WRITE;
/*!40000 ALTER TABLE `org_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `orgType` text,
  `interestSectorAreas` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `schoolLowerAge` varchar(45) DEFAULT NULL,
  `schoolHigherAge` varchar(45) DEFAULT NULL,
  `schoolURN` varchar(45) DEFAULT NULL,
  `notes` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `postcode` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  `professionalInterest` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisation`
--

LOCK TABLES `organisation` WRITE;
/*!40000 ALTER TABLE `organisation` DISABLE KEYS */;
INSERT INTO `organisation` VALUES (9,'orz','banks','paris','export','','','','','2017-12-26 15:37:52','2017-12-27 13:55:21','','','',NULL),(10,'orz11','banks','dsds','ctest','','','','','2017-12-26 15:39:58','2017-12-27 13:56:14','','','',NULL),(13,'orz12','banks','dsds','facebook','20','30','11','ddssd','2017-12-27 01:11:20','2017-12-27 01:11:20','SE21 8JL','England','London',NULL),(14,'orz13','banks','dsds','modify','','','','','2017-12-27 01:13:02','2017-12-27 13:55:36','SE21 8JL','England','London',NULL);
/*!40000 ALTER TABLE `organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `pid` int(11) NOT NULL COMMENT '父id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '操作规则唯一标识（控制器/方法）',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '操作规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常，0禁用',
  `islink` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示状态：1 显示，0 不显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `note` text NOT NULL COMMENT '提示描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '管理员用户id',
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色(用户组)id',
  UNIQUE KEY `admin_id_group_id` (`id`,`role_id`),
  KEY `id` (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户权限组关联明细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del` int(11) DEFAULT '0',
  `up` int(11) DEFAULT '0',
  `sub` int(11) DEFAULT '0',
  `new` int(11) DEFAULT '0',
  `entry_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (1,0,0,0,1,'2017-12-21 00:00:00','2017-12-21 06:07:15','2017-12-21 06:07:15',1),(2,0,0,0,1,'2017-12-21 00:00:00','2017-12-21 06:27:30','2017-12-21 06:27:30',1),(3,0,1,0,0,'2017-12-21 13:09:13','2017-12-21 13:09:13','2017-12-21 13:09:13',1),(4,1,0,0,0,'2017-12-21 13:09:22','2017-12-21 13:09:22','2017-12-21 13:09:22',1),(5,0,1,0,0,'2017-12-21 13:09:29','2017-12-21 13:09:29','2017-12-21 13:09:29',1),(6,0,1,0,0,'2017-12-21 13:09:38','2017-12-21 13:09:38','2017-12-21 13:09:38',1),(7,0,0,0,1,'2017-12-21 13:11:15','2017-12-21 13:11:15','2017-12-21 13:11:15',1),(8,0,1,0,0,'2017-12-21 13:11:45','2017-12-21 13:11:45','2017-12-21 13:11:45',1),(9,1,0,0,0,'2017-12-21 13:12:22','2017-12-21 13:12:22','2017-12-21 13:12:22',1),(10,0,0,0,1,'2017-12-21 13:13:34','2017-12-21 13:13:34','2017-12-21 13:13:34',1),(11,0,1,0,0,'2017-12-21 13:26:14','2017-12-21 13:26:14','2017-12-21 13:26:14',1),(12,0,0,0,1,'2017-12-21 13:26:35','2017-12-21 13:26:35','2017-12-21 13:26:35',1),(13,0,1,0,0,'2017-12-21 13:27:02','2017-12-21 13:27:02','2017-12-21 13:27:02',1),(14,0,1,0,0,'2017-12-21 13:27:24','2017-12-21 13:27:24','2017-12-21 13:27:24',1),(15,0,1,0,0,'2017-12-21 13:27:33','2017-12-21 13:27:33','2017-12-21 13:27:33',1),(16,1,0,0,0,'2017-12-21 13:27:45','2017-12-21 13:27:45','2017-12-21 13:27:45',1),(17,0,1,0,0,'2017-12-21 14:30:12','2017-12-21 14:30:12','2017-12-21 14:30:12',1),(18,0,1,0,0,'2017-12-21 14:37:13','2017-12-21 14:37:13','2017-12-21 14:37:13',1),(19,0,1,0,0,'2017-12-21 14:37:44','2017-12-21 14:37:44','2017-12-21 14:37:44',1),(20,1,0,0,0,'2017-12-21 14:37:55','2017-12-21 14:37:55','2017-12-21 14:37:55',1),(21,0,1,0,0,'2017-12-21 14:38:07','2017-12-21 14:38:07','2017-12-21 14:38:07',1),(22,0,1,0,0,'2017-12-21 16:09:04','2017-12-21 16:09:04','2017-12-21 16:09:04',1),(23,1,0,0,0,'2017-12-21 16:09:59','2017-12-21 16:09:59','2017-12-21 16:09:59',1),(24,0,1,0,0,'2017-12-23 10:47:21','2017-12-23 10:47:21','2017-12-23 10:47:21',1),(25,0,1,0,0,'2017-12-23 10:56:33','2017-12-23 10:56:33','2017-12-23 10:56:33',1),(26,0,1,0,0,'2017-12-23 10:56:41','2017-12-23 10:56:41','2017-12-23 10:56:41',1),(27,0,1,0,0,'2017-12-23 11:05:57','2017-12-23 11:05:57','2017-12-23 11:05:57',1),(28,0,1,0,0,'2017-12-23 12:19:27','2017-12-23 12:19:27','2017-12-23 12:19:27',1),(29,0,1,0,0,'2017-12-23 14:25:03','2017-12-23 14:25:03','2017-12-23 14:25:03',1),(30,0,1,0,0,'2017-12-23 14:28:21','2017-12-23 14:28:21','2017-12-23 14:28:21',1),(31,0,1,0,0,'2017-12-23 14:29:07','2017-12-23 14:29:07','2017-12-23 14:29:07',1),(32,0,0,0,1,'2017-12-24 15:33:32','2017-12-24 15:33:32','2017-12-24 15:33:32',1),(33,0,1,0,0,'2017-12-24 15:47:55','2017-12-24 15:47:55','2017-12-24 15:47:55',1),(34,1,0,0,0,'2017-12-24 15:48:33','2017-12-24 15:48:33','2017-12-24 15:48:33',1),(35,0,0,0,1,'2017-12-24 15:48:49','2017-12-24 15:48:49','2017-12-24 15:48:49',1),(36,0,1,0,0,'2017-12-24 15:48:59','2017-12-24 15:48:59','2017-12-24 15:48:59',1),(37,0,1,0,0,'2017-12-24 15:55:59','2017-12-24 15:55:59','2017-12-24 15:55:59',1),(38,0,1,0,0,'2017-12-24 16:00:07','2017-12-24 16:00:07','2017-12-24 16:00:07',1),(39,0,1,0,0,'2017-12-24 16:00:28','2017-12-24 16:00:28','2017-12-24 16:00:28',1),(40,0,1,0,0,'2017-12-25 11:14:07','2017-12-25 11:14:07','2017-12-25 11:14:07',1),(41,1,0,0,0,'2017-12-25 11:14:17','2017-12-25 11:14:17','2017-12-25 11:14:17',1),(42,0,1,0,0,'2017-12-25 11:51:32','2017-12-25 11:51:32','2017-12-25 11:51:32',1),(43,0,1,0,0,'2017-12-25 15:26:23','2017-12-25 15:26:23','2017-12-25 15:26:23',1),(44,1,0,0,0,'2017-12-25 15:37:18','2017-12-25 15:37:18','2017-12-25 15:37:18',1),(45,0,1,0,0,'2017-12-25 15:59:37','2017-12-25 15:59:37','2017-12-25 15:59:37',11),(46,0,1,0,0,'2017-12-26 13:24:06','2017-12-26 13:24:06','2017-12-26 13:24:06',11),(47,0,1,0,0,'2017-12-26 13:25:58','2017-12-26 13:25:58','2017-12-26 13:25:58',11),(48,0,1,0,0,'2017-12-26 15:11:05','2017-12-26 15:11:05','2017-12-26 15:11:05',11),(49,0,1,0,0,'2017-12-26 15:14:09','2017-12-26 15:14:09','2017-12-26 15:14:09',11),(50,0,1,0,0,'2017-12-26 15:14:10','2017-12-26 15:14:10','2017-12-26 15:14:10',11),(51,0,1,0,0,'2017-12-26 15:14:36','2017-12-26 15:14:36','2017-12-26 15:14:36',11),(52,0,1,0,0,'2017-12-26 15:15:25','2017-12-26 15:15:25','2017-12-26 15:15:25',11),(53,0,1,0,0,'2017-12-26 15:15:37','2017-12-26 15:15:37','2017-12-26 15:15:37',11),(54,0,1,0,0,'2017-12-26 15:18:26','2017-12-26 15:18:26','2017-12-26 15:18:26',11),(55,0,1,0,0,'2017-12-26 15:19:19','2017-12-26 15:19:19','2017-12-26 15:19:19',11),(56,1,0,0,0,'2017-12-26 15:31:03','2017-12-26 15:31:03','2017-12-26 15:31:03',11),(57,0,1,0,0,'2017-12-26 15:36:57','2017-12-26 15:36:57','2017-12-26 15:36:57',2),(58,0,0,0,1,'2017-12-26 15:37:03','2017-12-26 15:37:03','2017-12-26 15:37:03',2),(59,0,0,0,1,'2017-12-26 15:37:52','2017-12-26 15:37:52','2017-12-26 15:37:52',2),(60,0,0,0,1,'2017-12-26 15:39:58','2017-12-26 15:39:58','2017-12-26 15:39:58',2),(61,0,1,0,0,'2017-12-26 15:40:06','2017-12-26 15:40:06','2017-12-26 15:40:06',2),(62,0,1,0,0,'2017-12-26 15:40:19','2017-12-26 15:40:19','2017-12-26 15:40:19',2),(63,1,0,0,0,'2017-12-26 15:40:29','2017-12-26 15:40:29','2017-12-26 15:40:29',2),(64,0,1,0,0,'2017-12-26 15:44:47','2017-12-26 15:44:47','2017-12-26 15:44:47',2),(65,0,0,0,1,'2017-12-26 15:45:05','2017-12-26 15:45:05','2017-12-26 15:45:05',2),(66,0,1,0,0,'2017-12-26 15:46:49','2017-12-26 15:46:49','2017-12-26 15:46:49',2),(67,0,0,0,1,'2017-12-26 15:47:37','2017-12-26 15:47:37','2017-12-26 15:47:37',2),(68,1,0,0,0,'2017-12-26 15:47:45','2017-12-26 15:47:45','2017-12-26 15:47:45',2),(69,0,0,0,1,'2017-12-26 15:48:37','2017-12-26 15:48:37','2017-12-26 15:48:37',2),(70,0,1,0,0,'2017-12-26 15:55:04','2017-12-26 15:55:04','2017-12-26 15:55:04',18),(71,0,1,0,0,'2017-12-26 15:56:06','2017-12-26 15:56:06','2017-12-26 15:56:06',18),(72,1,0,0,0,'2017-12-26 15:56:17','2017-12-26 15:56:17','2017-12-26 15:56:17',18),(73,1,0,0,0,'2017-12-26 15:57:30','2017-12-26 15:57:30','2017-12-26 15:57:30',2),(74,1,0,0,0,'2017-12-26 15:59:24','2017-12-26 15:59:24','2017-12-26 15:59:24',2),(75,1,0,0,0,'2017-12-26 16:03:05','2017-12-26 16:03:05','2017-12-26 16:03:05',2),(76,0,1,0,0,'2017-12-26 16:05:10','2017-12-26 16:05:10','2017-12-26 16:05:10',2),(77,0,1,0,0,'2017-12-26 16:06:15','2017-12-26 16:06:15','2017-12-26 16:06:15',2),(78,1,0,0,0,'2017-12-26 16:06:22','2017-12-26 16:06:22','2017-12-26 16:06:22',2),(79,1,0,0,0,'2017-12-26 16:06:26','2017-12-26 16:06:26','2017-12-26 16:06:26',2),(80,0,0,0,1,'2017-12-26 16:06:57','2017-12-26 16:06:57','2017-12-26 16:06:57',2),(81,1,0,0,0,'2017-12-26 16:07:14','2017-12-26 16:07:14','2017-12-26 16:07:14',2),(82,0,0,0,1,'2017-12-26 16:25:38','2017-12-26 16:25:38','2017-12-26 16:25:38',20),(83,0,0,0,1,'2017-12-26 16:25:54','2017-12-26 16:25:54','2017-12-26 16:25:54',20),(84,0,0,0,1,'2017-12-26 16:26:25','2017-12-26 16:26:25','2017-12-26 16:26:25',20),(85,0,0,0,1,'2017-12-26 16:27:34','2017-12-26 16:27:34','2017-12-26 16:27:34',20),(86,0,1,0,0,'2017-12-26 16:31:34','2017-12-26 16:31:34','2017-12-26 16:31:34',20),(87,0,1,0,0,'2017-12-26 16:34:45','2017-12-26 16:34:45','2017-12-26 16:34:45',20),(88,0,1,0,0,'2017-12-26 16:35:01','2017-12-26 16:35:01','2017-12-26 16:35:01',20),(89,0,0,0,1,'2017-12-26 16:35:42','2017-12-26 16:35:42','2017-12-26 16:35:42',20),(90,0,1,0,0,'2017-12-26 16:36:51','2017-12-26 16:36:51','2017-12-26 16:36:51',20),(91,0,1,0,0,'2017-12-26 16:37:03','2017-12-26 16:37:03','2017-12-26 16:37:03',20),(92,0,1,0,0,'2017-12-26 16:37:12','2017-12-26 16:37:12','2017-12-26 16:37:12',20),(93,1,0,0,0,'2017-12-27 00:27:36','2017-12-27 00:27:36','2017-12-27 00:27:36',20),(94,1,0,0,0,'2017-12-27 00:28:36','2017-12-27 00:28:36','2017-12-27 00:28:36',20),(95,0,0,0,1,'2017-12-27 00:34:00','2017-12-27 00:34:00','2017-12-27 00:34:00',20),(96,0,0,0,1,'2017-12-27 00:41:12','2017-12-27 00:41:12','2017-12-27 00:41:12',20),(97,1,0,0,0,'2017-12-27 00:41:26','2017-12-27 00:41:26','2017-12-27 00:41:26',20),(98,1,0,0,0,'2017-12-27 00:41:32','2017-12-27 00:41:32','2017-12-27 00:41:32',20),(99,0,1,0,0,'2017-12-27 00:41:54','2017-12-27 00:41:54','2017-12-27 00:41:54',20),(100,0,1,0,0,'2017-12-27 00:42:03','2017-12-27 00:42:03','2017-12-27 00:42:03',20),(101,0,1,0,0,'2017-12-27 00:42:56','2017-12-27 00:42:56','2017-12-27 00:42:56',20),(102,0,1,0,0,'2017-12-27 00:43:03','2017-12-27 00:43:03','2017-12-27 00:43:03',20),(103,0,1,0,0,'2017-12-27 01:05:22','2017-12-27 01:05:22','2017-12-27 01:05:22',20),(104,0,1,0,0,'2017-12-27 01:05:55','2017-12-27 01:05:55','2017-12-27 01:05:55',20),(105,1,0,0,0,'2017-12-27 01:06:37','2017-12-27 01:06:37','2017-12-27 01:06:37',20),(106,1,0,0,0,'2017-12-27 01:06:52','2017-12-27 01:06:52','2017-12-27 01:06:52',20),(107,1,0,0,0,'2017-12-27 01:06:55','2017-12-27 01:06:55','2017-12-27 01:06:55',20),(108,1,0,0,0,'2017-12-27 01:06:58','2017-12-27 01:06:58','2017-12-27 01:06:58',20),(109,1,0,0,0,'2017-12-27 01:07:00','2017-12-27 01:07:00','2017-12-27 01:07:00',20),(110,1,0,0,0,'2017-12-27 01:07:02','2017-12-27 01:07:02','2017-12-27 01:07:02',20),(111,1,0,0,0,'2017-12-27 01:07:04','2017-12-27 01:07:04','2017-12-27 01:07:04',20),(112,1,0,0,0,'2017-12-27 01:07:06','2017-12-27 01:07:06','2017-12-27 01:07:06',20),(113,1,0,0,0,'2017-12-27 01:07:08','2017-12-27 01:07:08','2017-12-27 01:07:08',20),(114,1,0,0,0,'2017-12-27 01:07:10','2017-12-27 01:07:10','2017-12-27 01:07:10',20),(115,0,1,0,0,'2017-12-27 01:07:35','2017-12-27 01:07:35','2017-12-27 01:07:35',20),(116,0,0,0,1,'2017-12-27 01:11:20','2017-12-27 01:11:20','2017-12-27 01:11:20',20),(117,0,0,0,1,'2017-12-27 01:13:02','2017-12-27 01:13:02','2017-12-27 01:13:02',20),(118,0,1,0,0,'2017-12-27 11:36:50','2017-12-27 11:36:50','2017-12-27 11:36:50',20),(119,0,1,0,0,'2017-12-27 13:51:14','2017-12-27 13:51:14','2017-12-27 13:51:14',20),(120,1,0,0,0,'2017-12-27 13:51:47','2017-12-27 13:51:47','2017-12-27 13:51:47',20),(121,1,0,0,0,'2017-12-27 13:51:52','2017-12-27 13:51:52','2017-12-27 13:51:52',20),(122,0,1,0,0,'2017-12-27 13:52:34','2017-12-27 13:52:34','2017-12-27 13:52:34',20),(123,1,0,0,0,'2017-12-27 13:52:39','2017-12-27 13:52:39','2017-12-27 13:52:39',20),(124,1,0,0,0,'2017-12-27 13:53:01','2017-12-27 13:53:01','2017-12-27 13:53:01',20),(125,0,0,0,1,'2017-12-27 13:53:34','2017-12-27 13:53:34','2017-12-27 13:53:34',20),(126,0,1,0,0,'2017-12-27 13:55:21','2017-12-27 13:55:21','2017-12-27 13:55:21',20),(127,0,1,0,0,'2017-12-27 13:55:36','2017-12-27 13:55:36','2017-12-27 13:55:36',20),(128,0,1,0,0,'2017-12-27 13:56:14','2017-12-27 13:56:14','2017-12-27 13:56:14',20),(129,0,1,0,0,'2018-01-05 04:25:44','2018-01-05 04:25:44','2018-01-05 04:25:44',20),(130,0,1,0,0,'2018-01-05 04:25:44','2018-01-05 04:25:44','2018-01-05 04:25:44',20),(131,0,1,0,0,'2018-01-05 04:28:43','2018-01-05 04:28:43','2018-01-05 04:28:43',20),(132,0,1,0,0,'2018-01-05 04:40:13','2018-01-05 04:40:13','2018-01-05 04:40:13',20),(133,0,1,0,0,'2018-01-05 12:09:20','2018-01-05 12:09:20','2018-01-05 12:09:20',20),(134,0,1,0,0,'2018-01-05 12:12:22','2018-01-05 12:12:22','2018-01-05 12:12:22',20);
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色(用户组)id',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '角色(用户组)中文名称',
  `rules` varchar(512) NOT NULL DEFAULT '' COMMENT '角色(用户组)拥有的规则id，多个规则","隔开',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '角色(用户组)状态：1正常，0禁用',
  `note` text NOT NULL COMMENT '角色(用户组)描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (2,'Superadmin','all',1,'');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `submission` int(11) DEFAULT NULL,
  `entry_time` datetime DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_role_idx` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (20,'admin','admin','admin','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',1,0,NULL,1,1),(26,'f','dsd','test','40bd001563085fc35165329ea1ff5c5ecbdbbeef',1,NULL,'2017-12-27 00:34:00',1,1),(27,'tom','endword','SuperAdmin','7c4a8d09ca3762af61e59520943dc26494f8941b',1,NULL,'2017-12-27 13:53:34',2,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-05 12:19:30
