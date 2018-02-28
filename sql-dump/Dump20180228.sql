CREATE DATABASE  IF NOT EXISTS `kpadb_l4d` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kpadb_l4d`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: kpadb_l4d
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
INSERT INTO `tbl_company` VALUES (1,'43834cfa-04bb-4814-9ad0-f18a800ef9ff','PollyLoad','Trading',NULL,NULL,NULL,NULL,1,1,'2018-02-03 16:51:58','2018-02-03 16:51:58'),(2,'af59f2fa-bb7f-4f92-a2e8-17ceea97bd16','PSSPC','Trading',NULL,NULL,NULL,NULL,1,1,'2018-02-03 16:51:58','2018-02-03 16:51:58');
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
INSERT INTO `tbl_dealers_type` VALUES (1,1,'PSMA','Master',0.0000,0.0000,0,0.0000,6,NULL,NULL),(2,1,'PSMO','Mother',0.0000,0.0000,0,0.0000,5,NULL,NULL),(3,1,'PSCS','City Branch',0.0400,0.0000,600,200000.0000,4,NULL,NULL),(4,1,'PSMS','Barangay Branch',0.0300,0.0000,400,90000.0000,3,NULL,NULL),(5,1,'PSDS','Dealer',0.0250,0.0000,200,999.0000,2,NULL,NULL),(6,1,'PSRS','Reseller',0.0150,0.0000,50,499.0000,1,NULL,NULL);
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

-- Dump completed on 2018-02-28 21:58:45
