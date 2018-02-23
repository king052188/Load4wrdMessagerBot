CREATE DATABASE  IF NOT EXISTS `kpadb_l4d` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kpadb_l4d`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: kpadb_l4d
-- ------------------------------------------------------
-- Server version	5.6.38-log

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
-- Table structure for table `tbl_company`
--

DROP TABLE IF EXISTS `tbl_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_company` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(100) DEFAULT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `business_type` varchar(1000) DEFAULT NULL,
  `business_mobile` varchar(15) DEFAULT NULL,
  `business_email` varchar(100) DEFAULT NULL,
  `business_domain` varchar(100) DEFAULT NULL,
  `business_webhook` varchar(100) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_company`
--

LOCK TABLES `tbl_company` WRITE;
/*!40000 ALTER TABLE `tbl_company` DISABLE KEYS */;
INSERT INTO `tbl_company` VALUES (1,'43834cfa-04bb-4814-9ad0-f18a800ef9ff','PollyStore','Trading',NULL,NULL,NULL,NULL,1,1,'2018-02-03 16:51:58','2018-02-03 16:51:58'),(2,'af59f2fa-bb7f-4f92-a2e8-17ceea97bd16','PSSPC','Trading',NULL,NULL,NULL,NULL,1,1,'2018-02-03 16:51:58','2018-02-03 16:51:58');
/*!40000 ALTER TABLE `tbl_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dealers`
--

DROP TABLE IF EXISTS `tbl_dealers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dealers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(45) DEFAULT NULL,
  `facebook_id` varchar(50) DEFAULT 'N/A',
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `connected_to` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dealers`
--

LOCK TABLES `tbl_dealers` WRITE;
/*!40000 ALTER TABLE `tbl_dealers` DISABLE KEYS */;
INSERT INTO `tbl_dealers` VALUES (1,'1','1801668056570291',NULL,NULL,'09177715380',NULL,NULL,1,1,'2018-02-10 12:24:28','2018-02-10 09:15:36'),(2,'1','1858392504202557',NULL,NULL,'09995233848',NULL,1,3,1,'2018-02-10 18:20:19','2018-02-10 11:37:14'),(3,'1','1680585698719227',NULL,NULL,'09771819050',NULL,1,6,1,'2018-02-10 18:49:43','2018-02-10 18:47:54'),(4,'1','N/A',NULL,NULL,'09951234568',NULL,1,6,0,'2018-02-11 08:09:01','2018-02-11 08:09:01'),(5,'1','N/A',NULL,NULL,'09233702338',NULL,2,3,1,'2018-02-11 20:08:34','2018-02-11 09:37:17'),(6,'1','N/A',NULL,NULL,'09955024304',NULL,2,2,1,'2018-02-11 21:37:49','2018-02-11 10:05:59'),(7,'1','1693040817414067',NULL,NULL,'09276602206',NULL,2,5,1,'2018-02-11 20:25:43','2018-02-11 10:33:58');
/*!40000 ALTER TABLE `tbl_dealers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dealers_type`
--

DROP TABLE IF EXISTS `tbl_dealers_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dealers_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `ontop_percentage` decimal(18,4) DEFAULT '0.0000',
  `discount_percentage` decimal(18,4) DEFAULT '0.0000',
  `reseller_credits` smallint(6) DEFAULT NULL,
  `price` decimal(18,4) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dealers_type`
--

LOCK TABLES `tbl_dealers_type` WRITE;
/*!40000 ALTER TABLE `tbl_dealers_type` DISABLE KEYS */;
INSERT INTO `tbl_dealers_type` VALUES (1,1,'PSMA','Master',0.0700,0.0000,0,0.0000,6,NULL,NULL),(2,1,'PSMO','Mother',0.0600,0.0000,0,0.0000,5,NULL,NULL),(3,1,'PSCS','City / Master Branch',0.0500,0.0000,600,3599.0000,4,NULL,NULL),(4,1,'PSMS','Mobile / Mother Branch',0.0450,0.0000,400,1799.0000,3,NULL,NULL),(5,1,'PSDS','Dealer',0.0400,0.0000,200,899.0000,2,NULL,NULL),(6,1,'PSRS','Reseller',0.0350,0.0000,50,399.0000,1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_dealers_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_load_product_codes`
--

DROP TABLE IF EXISTS `tbl_load_product_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_load_product_codes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `network` int(11) DEFAULT NULL,
  `load_type` text,
  `description` longtext,
  `days` tinyint(4) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `keyword` varchar(15) DEFAULT NULL,
  `custom_cmd` varchar(15) DEFAULT NULL,
  `gateway` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_load_product_codes`
--

LOCK TABLES `tbl_load_product_codes` WRITE;
/*!40000 ALTER TABLE `tbl_load_product_codes` DISABLE KEYS */;
INSERT INTO `tbl_load_product_codes` VALUES (37,2,'REGULAR LOAD','Regular Load',1,10.00,'10','10','2882'),(38,2,'REGULAR LOAD','Regular Load',1,15.00,'15','15','2882'),(39,2,'REGULAR LOAD','Regular Load',1,20.00,'20','20','2882'),(40,2,'REGULAR LOAD','Regular Load',1,25.00,'25','25','2882'),(41,2,'REGULAR LOAD','Regular Load',1,30.00,'30','30','2882'),(42,2,'REGULAR LOAD','Regular Load',1,50.00,'50','50','2882'),(43,2,'REGULAR LOAD','Regular Load',1,60.00,'60','60','2882'),(44,2,'REGULAR LOAD','Regular Load',1,80.00,'80','80','2882'),(45,2,'REGULAR LOAD','Regular Load',1,90.00,'90','90','2882'),(46,2,'REGULAR LOAD','Regular Load',1,100.00,'100','100','2882'),(47,2,'REGULAR LOAD','Regular Load',1,150.00,'150','150','2882'),(48,2,'REGULAR LOAD','Regular Load',1,300.00,'300','300','2882'),(49,3,'REGULAR LOAD','Regular Load',1,10.00,'WSOTH10','10','247'),(50,3,'REGULAR LOAD','Regular Load',1,15.00,'WSOTH15','15','247'),(51,3,'REGULAR LOAD','Regular Load',1,20.00,'WSOTH20','20','247'),(52,3,'REGULAR LOAD','Regular Load',1,25.00,'WSOTH25','25','247'),(53,3,'REGULAR LOAD','Regular Load',1,30.00,'WSOTH30','30','247'),(54,3,'REGULAR LOAD','Regular Load',1,50.00,'WSOTH50','50','247'),(55,3,'REGULAR LOAD','Regular Load',1,75.00,'WSOTH75','75','247'),(56,3,'REGULAR LOAD','Regular Load',1,100.00,'WSOTH100','100','247'),(57,3,'REGULAR LOAD','Regular Load',1,150.00,'WSOTH150','150','247'),(58,3,'REGULAR LOAD','Regular Load',1,300.00,'WSOTH300','300','247'),(59,3,'REGULAR LOAD','Regular Load',1,500.00,'WSOTH500','500','247'),(89,1,'REGULAR LOAD','Regular Load',1,30.00,'W30','30','343'),(90,1,'REGULAR LOAD','Regular Load',1,60.00,'W60','60','343'),(91,1,'REGULAR LOAD','Regular Load',1,20.00,'WP20','20','343'),(92,1,'REGULAR LOAD','Regular Load',1,115.00,'W115','115','343'),(93,1,'REGULAR LOAD','Regular Load',1,300.00,'W300','300','343'),(94,1,'REGULAR LOAD','Regular Load',1,500.00,'W500','500','343'),(95,1,'REGULAR LOAD','Regular Load',1,1000.00,'W1000','1000','343'),(96,1,'Flexi Max 10','Flexi Max 10',1,10.00,'WTOT10','FM10','343'),(99,1,'REGULAR LOAD','Regular Load',1,200.00,'W200','200','343'),(105,1,'All Text 10','Unlimited all-net SMS, Unli FB and Viber data valid for 1 day',1,10.00,'W10','AT10','343'),(106,1,'All Out Surf 20','150 MB data,20 minutes tri-net calls,Unli all-net text,Free Facebook',1,20.00,'W20','AS20','343'),(120,1,'REGULAR LOAD','Regular Load',1,100.00,'W100','100','343'),(121,1,'REGULAR LOAD','Regular Load',1,5.00,'W5','5','343'),(149,1,'REGULAR LOAD','Regular Load',1,50.00,'W50','50','343'),(159,2,'REGULAR LOAD','Regular Load',1,500.00,'500','500','2882'),(190,3,'Calls & Text Unlimited','Unlimited Sun Calls and Texts, Unlimited Texts to ALL networks, Unli chat valid for 1 day',1,25.00,'WRTSCTU25','CTU25','247'),(191,3,'Calls & Text Unlimited','Unlimited calls and texts to Sun, Smart, TNT Unlimited Texts to ALL networks, Unli chat valid for 1 day',1,30.00,'WRTSCTU30','CTU30','247'),(192,3,'Calls & Text Unlimited','Unlimited calls to Sun, Smart, TNT, Unlimited texts to ALL networks, 50MB mobile internet valid for 3 days',1,50.00,'WRTSCTU50','CTU50','247'),(193,3,'Calls & Text Unlimited','Unlimited calls to Sun, Smart, TNT, Unlimited texts to ALL networks, Unlimited Facebook valid for 5 days',1,100.00,'WRTSCTU100','CTU100','247'),(194,3,'Calls & Text Unlimited','Unlimited calls to Sun, Smart, TNT, Unlimited texts to ALL networks, Unlimited Facebook valid for 5 days',1,150.00,'WRTSCTU150','CTU150','247'),(195,3,'Calls & Text Unlimited','Unlimited calls to Sun, Smart, TNT, Unlimited texts to ALL networks, Unlimited Facebook valid for 30 days',1,450.00,'WRTSCTU450','CTU450','247'),(224,1,'UCT','Unli On-net calls,Unli Trinet SMS, 50 All-Net SMS, Free Viber + FB for 1day',1,25.00,'WUCT25','UCT25','343'),(226,1,'UCT','100MB Data with Unli Trinet calls,Unli All Net SMS for 1 Day',1,30.00,'UCT30','UCT30','343'),(227,1,'UCT','150MB open access, Unli All-Net SMS, unli Trinet Calls, 5 PLDT num unli calls valid for 7days',1,100.00,'WUCT100','UCT100','343'),(228,1,'UCT','Unli All-net SMS,Unli Tri-net calls,500 MB Data ',1,300.00,'WUCT350','UCT300','343');
/*!40000 ALTER TABLE `tbl_load_product_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_load_request_logs`
--

DROP TABLE IF EXISTS `tbl_load_request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_load_request_logs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` int(11) DEFAULT NULL,
  `reference` varchar(60) DEFAULT NULL,
  `description` text,
  `amount` decimal(18,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_load_request_logs`
--

LOCK TABLES `tbl_load_request_logs` WRITE;
/*!40000 ALTER TABLE `tbl_load_request_logs` DISABLE KEYS */;
INSERT INTO `tbl_load_request_logs` VALUES (1,1,'1802104304939095','DEBIT',5.00,0,0,'2018-02-10 10:21:10','2018-02-10 10:21:10'),(2,1,'1802102321676231','DEBIT',5.00,0,1,'2018-02-10 10:22:03','2018-02-10 10:21:31'),(3,1,'1802105095178064','DEBIT',5.00,0,0,'2018-02-10 10:24:19','2018-02-10 10:24:19'),(4,1,'1802103949674353','DEBIT',5.00,0,1,'2018-02-10 10:27:50','2018-02-10 10:26:59'),(5,1,'1802103268962344','DEBIT',5.00,0,0,'2018-02-10 18:28:05','2018-02-10 18:28:05'),(6,1,'1802103317396039','DEBIT',5.00,0,1,'2018-02-10 18:40:08','2018-02-10 18:37:37'),(7,3,'1802101705006085','DEBIT',30.00,0,1,'2018-02-10 18:55:53','2018-02-10 18:54:54'),(8,3,'1802102760357863','DEBIT',115.00,0,0,'2018-02-10 20:19:07','2018-02-10 20:19:07'),(9,3,'1802103074487206','DEBIT',115.00,0,1,'2018-02-10 20:22:33','2018-02-10 20:21:27'),(10,1,'1802113341644411','DEBIT',5.00,0,0,'2018-02-11 08:15:52','2018-02-11 08:15:52'),(11,1,'1802112636999180','DEBIT',5.00,0,1,'2018-02-11 08:31:07','2018-02-11 08:31:03'),(12,1,'1802111407168897','DEBIT',5.00,0,1,'2018-02-11 08:32:08','2018-02-11 08:32:05'),(13,2,'1802114499366406','DEBIT',5.00,0,0,'2018-02-11 09:23:31','2018-02-11 09:23:31'),(14,2,'1802111396847327','DEBIT',5.00,0,0,'2018-02-11 09:25:12','2018-02-11 09:25:12'),(15,2,'1802114219086330','DEBIT',5.00,0,0,'2018-02-11 09:25:40','2018-02-11 09:25:40'),(16,2,'1802114935881654','DEBIT',5.00,0,0,'2018-02-11 09:26:01','2018-02-11 09:26:01'),(17,2,'1802113563327385','DEBIT',5.00,0,0,'2018-02-11 09:26:46','2018-02-11 09:26:46'),(18,2,'1802113332695981','DEBIT',5.00,0,1,'2018-02-11 09:28:46','2018-02-11 09:28:40'),(19,2,'1802117234759648','DEBIT',5.00,0,0,'2018-02-11 09:30:23','2018-02-11 09:30:23'),(20,2,'1802113305366911','DEBIT',5.00,0,0,'2018-02-11 09:32:55','2018-02-11 09:32:55'),(21,2,'1802113430324097','DEBIT',5.00,0,0,'2018-02-11 09:33:15','2018-02-11 09:33:15'),(22,2,'1802114350118066','DEBIT',5.00,0,0,'2018-02-11 09:33:42','2018-02-11 09:33:42'),(23,2,'1802111023342888','DEBIT',5.00,0,1,'2018-02-11 09:34:57','2018-02-11 09:34:51'),(24,5,'1802113072459036','DEBIT',5.00,0,1,'2018-02-11 09:43:45','2018-02-11 09:43:40'),(25,1,'1802114929058043','DEBIT',10.00,0,1,'2018-02-11 10:17:22','2018-02-11 10:11:10'),(26,1,'1802116818755130','DEBIT',5.00,0,0,'2018-02-11 10:19:09','2018-02-11 10:19:09'),(27,1,'1802114626839139','DEBIT',5.00,0,0,'2018-02-11 17:15:44','2018-02-11 17:15:44'),(28,6,'1802114679574603','DEBIT',5.00,0,1,'2018-02-11 21:41:05','2018-02-11 21:40:58'),(29,2,'1802123429622581','DEBIT',150.00,0,0,'2018-02-12 11:18:55','2018-02-12 11:18:55');
/*!40000 ALTER TABLE `tbl_load_request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_loading_transactions`
--

DROP TABLE IF EXISTS `tbl_loading_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_loading_transactions` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(60) DEFAULT NULL,
  `network_provider` tinyint(4) DEFAULT NULL,
  `transaction_number` varchar(60) DEFAULT NULL,
  `target_mobile_number` varchar(15) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_loading_transactions`
--

LOCK TABLES `tbl_loading_transactions` WRITE;
/*!40000 ALTER TABLE `tbl_loading_transactions` DISABLE KEYS */;
INSERT INTO `tbl_loading_transactions` VALUES (1,'1802102321676231',1,'4DC405763250830E7B68D304E70B018B1CE10518','09995233848','W5',5.00,1,'2018-02-10 10:22:03','2018-02-10 10:22:03'),(2,'1802103949674353',1,'D1BB9B02E3A60315D72FE2837FC4D0AD363CBD16','09995233848','W5',5.00,1,'2018-02-10 10:27:50','2018-02-10 10:27:50'),(3,'1802103317396039',1,'74C76E868A6887F3548FBD1CC1488EF4ACFD80F7','09995233848','W5',5.00,1,'2018-02-10 18:40:08','2018-02-10 18:40:08'),(4,'1802101705006085',1,'6EE9EE8C7E6A16691E348B5FAD81E9A87D4631D7','09125513902','W30',30.00,1,'2018-02-10 18:55:53','2018-02-10 18:55:53'),(5,'1802103074487206',1,'9766BEB25E43DFFE75D8FED8FE7E21F3B7963099','09283732867','W115',115.00,1,'2018-02-10 20:22:33','2018-02-10 20:22:33'),(6,'1802111407168897',1,'F8966D81F95292C5F51302BF2F401BE93483FFDC','09995233848','W5',5.00,1,'2018-02-11 08:32:08','2018-02-11 08:32:08'),(7,'1802113332695981',1,'19FF41C883EE3566D5190233E83A13802CC241F2','09995233848','W5',5.00,1,'2018-02-11 09:28:46','2018-02-11 09:28:46'),(8,'1802111023342888',1,'AB5C6EDC3F2D76D130E89422EF5AFA552FBAD725','09491667621','W5',5.00,1,'2018-02-11 09:34:57','2018-02-11 09:34:57'),(9,'1802113072459036',1,'AA90D7A3BC2DFDFB9FE7A89166AAE65EA50EA449','09995233848','W5',5.00,1,'2018-02-11 09:43:45','2018-02-11 09:43:45'),(10,'1802114929058043',3,'45B3822E45EAB3AEC986E01C35CC9FEC19F18A3E','09432855957','WSOTH10',10.00,1,'2018-02-11 10:17:22','2018-02-11 10:17:22'),(11,'1802114679574603',1,'A7C4DC76C67F03155AFA3F96AEC2F352DFC6CB86','09995233848','W5',5.00,1,'2018-02-11 21:41:05','2018-02-11 21:41:05');
/*!40000 ALTER TABLE `tbl_loading_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sms_queue`
--

DROP TABLE IF EXISTS `tbl_sms_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sms_queue` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `company_uid` int(11) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `user_ip_address` varchar(20) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `message` longtext,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sms_queue`
--

LOCK TABLES `tbl_sms_queue` WRITE;
/*!40000 ALTER TABLE `tbl_sms_queue` DISABLE KEYS */;
INSERT INTO `tbl_sms_queue` VALUES (1,4,'09177715380','0','09177715380','429718 is your PollyStore confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-10 18:41:34','2018-02-10 09:15:15'),(2,4,'09177715380','0','09177715380','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-10 18:41:34','2018-02-10 09:15:36'),(3,4,'09177715380','0','09177715380','284500 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:41:34','2018-02-10 10:21:10'),(4,4,'09177715380','0','09177715380','395589 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:41:35','2018-02-10 10:21:31'),(5,4,'09177715380','0','09177715380','401905 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:41:35','2018-02-10 10:24:19'),(6,4,'09177715380','0','09177715380','382138 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:41:35','2018-02-10 10:26:59'),(7,4,'09995233848','0','09995233848','235781 is your PollyStore confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-10 18:41:36','2018-02-10 11:34:03'),(8,4,'09995233848','0','09995233848','169055 is your PollyStore confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-10 18:41:36','2018-02-10 11:36:40'),(9,4,'09995233848','0','09995233848','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-10 18:41:36','2018-02-10 11:37:14'),(10,4,'09177715380','0','09177715380','316071 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:41:36','2018-02-10 18:28:05'),(11,4,'09177715380','0','09177715380','151582 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:41:37','2018-02-10 18:37:37'),(12,4,'09771819050','0','09771819050','300159 is your PollyStore confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-10 18:46:06','2018-02-10 18:46:02'),(13,4,'09771819050','0','09771819050','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-10 18:47:58','2018-02-10 18:47:54'),(14,4,'09771819050','0','09771819050','347620 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 18:54:59','2018-02-10 18:54:54'),(15,4,'09771819050','0','09771819050','P4899 pesos have been loaded to your wallet, reference# 1802103611799464 date 2018-02-10 20:08:39. Thank you!',1,'2018-02-10 20:08:39','2018-02-10 20:08:39'),(16,4,'09177715380','0','09177715380','P4,899.00 pesos have been loaded to your wallet, reference# 1802101243610637 date 2018-02-10 20:12:07. Thank you!',1,'2018-02-10 20:12:08','2018-02-10 20:12:07'),(17,4,'09177715380','0','09177715380','₱2,000.00 pesos have been loaded to your wallet, reference# 1802103957053975 date 2018-02-10 20:16:04. Thank you!',1,'2018-02-10 20:16:06','2018-02-10 20:16:04'),(18,4,'09177715380','0','09177715380','P2,000.00 pesos have been loaded to your wallet, reference# 1802103277023184 date 2018-02-10 20:16:44. Thank you!',1,'2018-02-10 20:16:47','2018-02-10 20:16:44'),(19,4,'09771819050','0','09771819050','271739 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 20:19:09','2018-02-10 20:19:07'),(20,4,'09771819050','0','09771819050','253140 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-10 20:21:32','2018-02-10 20:21:27'),(21,4,'09995233848','0','09995233848','P100.00 pesos have been loaded to your wallet, reference# 1802101427171020 date 2018-02-10 20:50:43. Thank you!',1,'2018-02-10 20:50:48','2018-02-10 20:50:43'),(22,4,'09995233848','0','09995233848','P100.00 pesos have been loaded to your wallet, reference# 1802113948965427 date 2018-02-11 08:01:29. Thank you!',1,'2018-02-11 09:08:21','2018-02-11 08:01:29'),(23,4,'09951234568','0','09951234568','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-11 09:08:21','2018-02-11 08:09:01'),(24,4,'09177715380','0','09177715380','287658 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-11 09:08:22','2018-02-11 08:15:52'),(25,4,'09233702338','0','09233702338','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-11 09:37:22','2018-02-11 09:37:17'),(26,4,'09233702338','0','09233702338','P100.00 pesos have been loaded to your wallet, reference# 1802111945414827 date 2018-02-11 09:41:37. Thank you!',1,'2018-02-11 09:41:42','2018-02-11 09:41:37'),(27,4,'09995233848','0','09995233848','P3,000.00 pesos have been loaded to your wallet, reference# 1802111179274962 date 2018-02-11 10:03:36. Thank you!',1,'2018-02-11 10:03:50','2018-02-11 10:03:36'),(28,4,'09955024304','0','09955024304','Welcome to PollyStore, you are now successfully registered.',1,'2018-02-11 10:06:00','2018-02-11 10:05:59'),(29,4,'09177715380','0','09177715380','442725 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-11 10:11:15','2018-02-11 10:11:10'),(30,4,'09177715380','0','09177715380','311710 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-11 10:19:10','2018-02-11 10:19:09'),(31,4,'09276602206','0','09276602206','Welcome to PollyStore, you are now successfully registered.',1,'2018-02-11 10:34:03','2018-02-11 10:33:58'),(32,4,'09177715380','0','09177715380','310804 is your PollyStore One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-11 17:15:46','2018-02-11 17:15:44'),(33,4,'09951234568','0','09951234568','233961 is your PollyStore confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-11 18:28:42','2018-02-11 18:28:35'),(34,4,'09276602206','0','09276602206','419398 is your PollyStore confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-11 19:35:02','2018-02-11 19:35:02'),(35,4,'09276602206','0','09276602206','Welcome to PollyStore, you are now successfully registered.',1,'2018-02-11 19:38:34','2018-02-11 19:38:33'),(36,4,'09276602206','0','09276602206','Congrats, your mobile# has been activated and good to go for loading business. Thank You!',1,'2018-02-11 20:02:34','2018-02-11 20:02:28'),(37,4,'09276602206','0','09276602206','Congrats, your mobile# has been activated and good to go for loading business. Thank You!',1,'2018-02-11 20:08:38','2018-02-11 20:08:34'),(38,4,'09276602206','0','09276602206','Congrats, your mobile# has been activated and good to go for loading business. Thank You!',1,'2018-02-11 20:25:45','2018-02-11 20:25:43'),(39,4,'09955024304','0','09955024304','Congrats, your mobile# has been activated and good to go for loading business. Thank You!',1,'2018-02-11 21:37:51','2018-02-11 21:37:49'),(40,4,'09955024304','0','09955024304','P1,060.00 pesos have been loaded to your wallet, reference# 1802114752607258 date 2018-02-11 21:39:25. Thank you!',1,'2018-02-11 21:39:29','2018-02-11 21:39:25');
/*!40000 ALTER TABLE `tbl_sms_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_wallet`
--

DROP TABLE IF EXISTS `tbl_wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_wallet` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` int(11) DEFAULT NULL,
  `reference` varchar(60) DEFAULT NULL,
  `description` text,
  `amount` decimal(18,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_wallet`
--

LOCK TABLES `tbl_wallet` WRITE;
/*!40000 ALTER TABLE `tbl_wallet` DISABLE KEYS */;
INSERT INTO `tbl_wallet` VALUES (1,1,'xxx','xxx',5000.00,1,1,'2018-02-10 09:15:36','2018-02-10 09:15:36'),(2,1,'1802102321676231','DEBIT',5.00,0,1,'2018-02-10 10:22:03','2018-02-10 10:22:03'),(3,1,'1802103949674353','DEBIT',5.00,0,1,'2018-02-10 10:27:50','2018-02-10 10:27:50'),(4,1,'1802103317396039','DEBIT',5.00,0,1,'2018-02-10 18:40:08','2018-02-10 18:40:08'),(5,3,'xxx','xxx',100000.00,1,1,'2018-02-10 18:40:08','2018-02-10 18:40:08'),(6,3,'1802101705006085','DEBIT',30.00,0,1,'2018-02-10 18:55:53','2018-02-10 18:55:53'),(7,1,'1802103611799464','TRANSFER DEBIT',4899.00,0,1,'2018-02-10 20:08:39','2018-02-10 20:08:39'),(8,3,'1802103611799464','TRANSFER CREDIT',4899.00,1,1,'2018-02-10 20:08:39','2018-02-10 20:08:39'),(9,3,'1802101243610637','TRANSFER DEBIT',4899.00,0,1,'2018-02-10 20:12:07','2018-02-10 20:12:07'),(10,1,'1802101243610637','TRANSFER CREDIT',4899.00,1,1,'2018-02-10 20:12:07','2018-02-10 20:12:07'),(11,3,'1802103987570668','TRANSFER DEBIT',2000.00,0,1,'2018-02-10 20:13:19','2018-02-10 20:13:19'),(12,1,'1802103987570668','TRANSFER CREDIT',2000.00,1,1,'2018-02-10 20:13:19','2018-02-10 20:13:19'),(13,3,'1802101168456683','TRANSFER DEBIT',2000.00,0,1,'2018-02-10 20:15:21','2018-02-10 20:15:21'),(14,1,'1802101168456683','TRANSFER CREDIT',2000.00,1,1,'2018-02-10 20:15:21','2018-02-10 20:15:21'),(15,3,'1802103957053975','TRANSFER DEBIT',2000.00,0,1,'2018-02-10 20:16:04','2018-02-10 20:16:04'),(16,1,'1802103957053975','TRANSFER CREDIT',2000.00,1,1,'2018-02-10 20:16:04','2018-02-10 20:16:04'),(17,3,'1802103277023184','TRANSFER DEBIT',2000.00,0,1,'2018-02-10 20:16:44','2018-02-10 20:16:44'),(18,1,'1802103277023184','TRANSFER CREDIT',2000.00,1,1,'2018-02-10 20:16:44','2018-02-10 20:16:44'),(19,3,'1802103074487206','DEBIT',115.00,0,1,'2018-02-10 20:22:33','2018-02-10 20:22:33'),(20,1,'1802101427171020','TRANSFER DEBIT',100.00,0,1,'2018-02-10 20:50:43','2018-02-10 20:50:43'),(21,2,'1802101427171020','TRANSFER CREDIT',100.00,1,1,'2018-02-10 20:50:43','2018-02-10 20:50:43'),(22,1,'1802113948965427','TRANSFER DEBIT',100.00,0,1,'2018-02-11 08:01:29','2018-02-11 08:01:29'),(23,2,'1802113948965427','TRANSFER CREDIT',100.00,1,1,'2018-02-11 08:01:29','2018-02-11 08:01:29'),(24,1,'1802111407168897','DEBIT',5.00,0,1,'2018-02-11 08:32:08','2018-02-11 08:32:08'),(25,2,'1802113332695981','DEBIT',5.00,0,1,'2018-02-11 09:28:46','2018-02-11 09:28:46'),(26,2,'1802111023342888','DEBIT',5.00,0,1,'2018-02-11 09:34:57','2018-02-11 09:34:57'),(27,2,'1802111945414827','TRANSFER DEBIT',100.00,0,1,'2018-02-11 09:41:37','2018-02-11 09:41:37'),(28,5,'1802111945414827','TRANSFER CREDIT',100.00,1,1,'2018-02-11 09:41:37','2018-02-11 09:41:37'),(29,5,'1802113072459036','DEBIT',5.00,0,1,'2018-02-11 09:43:45','2018-02-11 09:43:45'),(30,1,'1802111179274962','TRANSFER DEBIT',3000.00,0,1,'2018-02-11 10:03:36','2018-02-11 10:03:36'),(31,2,'1802111179274962','TRANSFER CREDIT',3000.00,1,1,'2018-02-11 10:03:36','2018-02-11 10:03:36'),(32,1,'1802114929058043','DEBIT',10.00,0,1,'2018-02-11 10:17:22','2018-02-11 10:17:22'),(33,2,'1802114752607258','TRANSFER DEBIT',1060.00,0,1,'2018-02-11 21:39:25','2018-02-11 21:39:25'),(34,6,'1802114752607258','TRANSFER CREDIT',1060.00,1,1,'2018-02-11 21:39:25','2018-02-11 21:39:25'),(35,6,'1802114679574603','DEBIT',5.00,0,1,'2018-02-11 21:41:05','2018-02-11 21:41:05');
/*!40000 ALTER TABLE `tbl_wallet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-12 11:58:32
