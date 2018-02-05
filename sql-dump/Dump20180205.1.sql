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
INSERT INTO `tbl_company` VALUES (1,'43834cfa-04bb-4814-9ad0-f18a800ef9ff','PollyStore','Trading',NULL,NULL,NULL,NULL,1,1,'2018-02-03 16:51:58','2018-02-03 16:51:58'),(2,'af59f2fa-bb7f-4f92-a2e8-17ceea97bd16','EnghagePro','Trading',NULL,NULL,'enghagepro.com',NULL,1,1,'2018-02-03 16:51:58','2018-02-03 16:51:58');
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
  `type` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dealers`
--

LOCK TABLES `tbl_dealers` WRITE;
/*!40000 ALTER TABLE `tbl_dealers` DISABLE KEYS */;
INSERT INTO `tbl_dealers` VALUES (1,'2','1574481619310124',NULL,NULL,'09177715380',NULL,0,0,'2018-02-03 13:43:43','2018-02-03 13:43:43'),(2,'2','1448554118587286',NULL,NULL,'09127189306',NULL,0,0,'2018-02-03 13:52:13','2018-02-03 13:52:13'),(3,'2','2120506754632195',NULL,NULL,'09950912795',NULL,0,0,'2018-02-03 13:59:59','2018-02-03 13:59:59'),(4,'2','1962976130383819',NULL,NULL,'09354843531',NULL,0,0,'2018-02-03 16:51:58','2018-02-03 16:51:58'),(5,'1','1574481619310124',NULL,NULL,'09177715385',NULL,0,0,'2018-02-05 14:57:16','2018-02-05 14:57:16'),(6,'1','1574481619310124',NULL,NULL,'09177715386',NULL,0,0,'2018-02-05 14:58:49','2018-02-05 14:58:49');
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
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `ontop_percentage` decimal(18,4) DEFAULT '0.0000',
  `discount_percentage` decimal(18,4) DEFAULT '0.0000',
  `price` decimal(18,4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dealers_type`
--

LOCK TABLES `tbl_dealers_type` WRITE;
/*!40000 ALTER TABLE `tbl_dealers_type` DISABLE KEYS */;
INSERT INTO `tbl_dealers_type` VALUES (1,'CITY',NULL,0.0700,0.0000,1800.0000,NULL,NULL),(2,'MOBILE',NULL,0.0600,0.0000,1200.0000,NULL,NULL),(3,'DEALER',NULL,0.0500,0.0000,600.0000,NULL,NULL),(4,'RESELLER',NULL,0.0400,0.0000,300.0000,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_load_product_codes`
--

LOCK TABLES `tbl_load_product_codes` WRITE;
/*!40000 ALTER TABLE `tbl_load_product_codes` DISABLE KEYS */;
INSERT INTO `tbl_load_product_codes` VALUES (37,2,'REGULAR LOAD','Regular Load',1,10.00,'10','10','2882'),(38,2,'REGULAR LOAD','Regular Load',1,15.00,'15','15','2882'),(39,2,'REGULAR LOAD','Regular Load',1,20.00,'20','20','2882'),(40,2,'REGULAR LOAD','Regular Load',1,25.00,'25','25','2882'),(41,2,'REGULAR LOAD','Regular Load',1,30.00,'30','30','2882'),(42,2,'REGULAR LOAD','Regular Load',1,50.00,'50','50','2882'),(43,2,'REGULAR LOAD','Regular Load',1,60.00,'60','60','2882'),(44,2,'REGULAR LOAD','Regular Load',1,80.00,'80','80','2882'),(45,2,'REGULAR LOAD','Regular Load',1,90.00,'90','90','2882'),(46,2,'REGULAR LOAD','Regular Load',1,100.00,'100','100','2882'),(47,2,'REGULAR LOAD','Regular Load',1,150.00,'150','150','2882'),(48,2,'REGULAR LOAD','Regular Load',1,300.00,'300','300','2882'),(49,3,'REGULAR LOAD','Regular Load',1,10.00,'WSOTH10','10','247'),(50,3,'REGULAR LOAD','Regular Load',1,15.00,'WSOTH15','15','247'),(51,3,'REGULAR LOAD','Regular Load',1,20.00,'WSOTH20','20','247'),(52,3,'REGULAR LOAD','Regular Load',1,25.00,'WSOTH25','25','247'),(53,3,'REGULAR LOAD','Regular Load',1,30.00,'WSOTH30','30','247'),(54,3,'REGULAR LOAD','Regular Load',1,50.00,'WSOTH50','50','247'),(55,3,'REGULAR LOAD','Regular Load',1,75.00,'WSOTH75','75','247'),(56,3,'REGULAR LOAD','Regular Load',1,100.00,'WSOTH100','100','247'),(57,3,'REGULAR LOAD','Regular Load',1,150.00,'WSOTH150','150','247'),(58,3,'REGULAR LOAD','Regular Load',1,300.00,'WSOTH300','300','247'),(59,3,'REGULAR LOAD','Regular Load',1,500.00,'WSOTH500','500','247'),(89,1,'REGULAR LOAD','Regular Load',1,30.00,'W30','30','343'),(90,1,'REGULAR LOAD','Regular Load',1,60.00,'W60','60','343'),(91,1,'SMART','SMART',1,20.00,'WP20',NULL,'343'),(92,1,'REGULAR LOAD','Regular Load',1,115.00,'W115','115','343'),(93,1,'REGULAR LOAD','Regular Load',1,300.00,'W300','300','343'),(94,1,'REGULAR LOAD','Regular Load',1,500.00,'W500','500','343'),(95,1,'REGULAR LOAD','Regular Load',1,1000.00,'W1000','1000','343'),(96,1,'SMART','SMART',1,10.00,'WTOT10',NULL,'343'),(97,1,'SMART','SMART',1,20.00,'WTOT20',NULL,'343'),(98,1,'SMART','SMART',1,30.00,'WTOT30',NULL,'343'),(99,1,'SMART','SMART',1,200.00,'W200',NULL,'343'),(100,1,'SMART','SMART',1,30.00,'WGA30',NULL,'343'),(101,1,'SMART','SMART',1,55.00,'WGA55',NULL,'343'),(102,1,'SMART','SMART',1,99.00,'WGA99',NULL,'343'),(103,1,'SMART','SMART',1,15.00,'WTC15',NULL,'343'),(104,1,'SMART','SMART',1,20.00,'WG20',NULL,'343'),(105,1,'SMART','SMART',1,10.00,'W10',NULL,'343'),(106,1,'SMART','SMART',1,20.00,'W20',NULL,'343'),(107,1,'SMART','SMART',1,35.00,'W35',NULL,'343'),(108,1,'SMART','SMART',1,70.00,'W70',NULL,'343'),(109,1,'SMART','SMART',1,20.00,'WU20',NULL,'343'),(110,1,'SMART','SMART',1,130.00,'W130',NULL,'343'),(111,1,'SMART','SMART',1,25.00,'W25',NULL,'343'),(112,1,'SMART','SMART',1,5.00,'WEXTRA5',NULL,'343'),(113,1,'SMART','SMART',1,10.00,'WEXTRA10',NULL,'343'),(114,1,'SMART','SMART',1,300.00,'WUA300',NULL,'343'),(115,1,'SMART','SMART',1,20.00,'WUA20',NULL,'343'),(116,1,'SMART','SMART',1,15.00,'WTOT15',NULL,'343'),(117,1,'SMART','SMART',1,150.00,'WU150',NULL,'343'),(118,1,'SMART','SMART',1,15.00,'WUA15',NULL,'343'),(119,1,'SMART','SMART',1,5.00,'WPANALO5',NULL,'343'),(120,1,'SMART','SMART',1,1.00,'W1','1','343'),(121,1,'SMART','SMART',1,5.00,'W5','5','343'),(122,1,'SMART','SMART',1,30.00,'WL30',NULL,'343'),(123,1,'SMART','SMART',1,10.00,'WSBRO1',NULL,'343'),(124,1,'SMART','SMART',1,20.00,'WSBRO2',NULL,'343'),(125,1,'SMART','SMART',1,30.00,'WSBRO3',NULL,'343'),(126,1,'SMART','SMART',1,40.00,'WSBRO4',NULL,'343'),(127,1,'SMART','SMART',1,50.00,'WSBRO5',NULL,'343'),(128,1,'SMART','SMART',1,60.00,'WSBRO6',NULL,'343'),(129,1,'SMART','SMART',1,15.00,'WS15',NULL,'343'),(130,1,'SMART','SMART',1,15.00,'WSTEX15',NULL,'343'),(131,1,'SMART','SMART',1,30.00,'WSTEX30',NULL,'343'),(132,1,'SMART','SMART',1,15.00,'WSTALK15',NULL,'343'),(133,1,'SMART','SMART',1,30.00,'WSTALK30',NULL,'343'),(134,1,'SMART','SMART',1,30.00,'WSTX30',NULL,'343'),(135,1,'SMART','SMART',1,60.00,'WSTX60',NULL,'343'),(136,1,'SMART','SMART',1,20.00,'WL20',NULL,'343'),(137,1,'SMART','SMART',1,100.00,'WT100',NULL,'343'),(138,1,'SMART','SMART',1,5.00,'WB5',NULL,'343'),(139,1,'SMART','SMART',1,10.00,'WUP10',NULL,'343'),(140,1,'SMART','SMART',1,10.00,'WLOAD10',NULL,'343'),(141,1,'SMART','SMART',1,10.00,'WUTNT',NULL,'343'),(142,1,'SMART','SMART',1,15.00,'W15',NULL,'343'),(143,1,'SMART','SMART',1,20.00,'WWU20',NULL,'343'),(144,1,'SMART','SMART',1,20.00,'WT20',NULL,'343'),(145,1,'SMART','SMART',1,5.00,'WUNLI5',NULL,'343'),(146,1,'SMART','SMART',1,115.00,'WUNLI15',NULL,'343'),(147,1,'SMART','SMART',1,5.00,'WLOAD5',NULL,'343'),(148,1,'SMART','SMART',1,1.00,'WPISO',NULL,'343'),(149,1,'SMART','SMART',1,50.00,'W50',NULL,'343'),(150,1,'SMART','SMART',1,100.00,'W100',NULL,'343'),(151,1,'SMART','SMART',1,50.00,'WSULITIDD50',NULL,'343'),(152,1,'SMART','SMART',1,100.00,'WSULITIDD100',NULL,'343'),(153,1,'SMART','SMART',1,500.00,'WSULITIDD500',NULL,'343'),(154,1,'SMART','SMART',1,10.00,'WGT10',NULL,'343'),(155,1,'SMART','SMART',1,20.00,'WGT20',NULL,'343'),(156,1,'SMART','SMART',1,30.00,'WG30',NULL,'343'),(157,1,'SMART','SMART',1,30.00,'WU30',NULL,'343'),(158,1,'SMART','SMART',1,15.00,'WGU15',NULL,'343'),(159,2,'REGULAR LOAD','Airtime Load',1,500.00,'500','500','2882'),(160,2,'GLOBE','*IDD calls valid for 3 days',1,30.00,'GOTIPIDD30',NULL,'2882'),(161,2,'GLOBE','*IDD calls valid for 7 days',1,50.00,'GOTIPIDD50',NULL,'2882'),(162,2,'GLOBE','*IDD calls valid for 15 days',1,100.00,'GOTIPIDD100',NULL,'2882'),(163,2,'GLOBE','GLOBE',1,200.00,'GOIDD200',NULL,'2882'),(164,2,'GLOBE','GLOBE',1,999.00,'WEBGODUOTM999',NULL,'2882'),(165,2,'GLOBE','GLOBE',1,999.00,'WEBGODUO999',NULL,'2882'),(166,2,'GLOBE','GLOBE',1,20.00,'WEBATXTPLUS20',NULL,'2882'),(167,2,'GLOBE','GLOBE',1,30.00,'WEBGOUNLI30',NULL,'2882'),(168,2,'GLOBE','GLOBE',1,80.00,'WEBGOUNLI80',NULL,'2882'),(169,2,'GLOBE','GLOBE',1,180.00,'WEBGOUNLI180',NULL,'2882'),(170,2,'GLOBE','GLOBE',1,750.00,'WEBGOUNLI750',NULL,'2882'),(171,2,'GLOBE','GLOBE',1,15.00,'WEBSULITXT',NULL,'2882'),(172,2,'GLOBE','GLOBE',1,25.00,'WEBSUPERUNLI25',NULL,'2882'),(173,2,'GLOBE','GLOBE',1,30.00,'WEBASTIGTXT30',NULL,'2882'),(174,2,'GLOBE','GLOBE',1,10.00,'WEBCOMBO10',NULL,'2882'),(175,2,'GLOBE','GLOBE',1,15.00,'WEBCOMBO15',NULL,'2882'),(176,2,'GLOBE','GLOBE',1,20.00,'WEBUNLITXT',NULL,'2882'),(177,2,'GLOBE','GLOBE',1,40.00,'WEBUNLITXT40',NULL,'2882'),(178,2,'GLOBE','GLOBE',1,80.00,'WEBUNLITXT80',NULL,'2882'),(179,2,'GLOBE','GLOBE',1,149.00,'WEBSUPERIDD149',NULL,'2882'),(180,2,'GLOBE','GLOBE',1,15.00,'WEBASTIGTXT15',NULL,'2882'),(181,2,'GLOBE','GLOBE',1,5.00,'WEBSULITXT5',NULL,'2882'),(182,3,'Text Unlimited','SUN',1,10.00,'WRTSWIN10',NULL,'247'),(183,3,'Text Unlimited','SUN',1,15.00,'WRTSTU15',NULL,'247'),(184,3,'Text Unlimited','SUN',1,20.00,'WRTSTU20',NULL,'247'),(185,3,'Text Unlimited','SUN',1,50.00,'WRTSTU50',NULL,'247'),(186,3,'Text Unlimited','SUN',1,60.00,'WRTSTU60',NULL,'247'),(187,3,'Text Unlimited','SUN',1,150.00,'WRTSTU150',NULL,'247'),(188,3,'Text Unlimited','SUN',1,200.00,'WRTSTU200',NULL,'247'),(189,3,'Text Unlimited','SUN',1,300.00,'WRTSTU300',NULL,'247'),(190,3,'Calls & Text Unlimited','SUN',1,25.00,'WRTSCTU25',NULL,'247'),(191,3,'Calls & Text Unlimited','SUN',1,30.00,'WRTSCTU30',NULL,'247'),(192,3,'Calls & Text Unlimited','SUN',1,50.00,'WRTSCTU50',NULL,'247'),(193,3,'Calls & Text Unlimited','SUN',1,100.00,'WRTSCTU100',NULL,'247'),(194,3,'Calls & Text Unlimited','SUN',1,150.00,'WRTSCTU150',NULL,'247'),(195,3,'Calls & Text Unlimited','SUN',1,450.00,'WRTSCTU450',NULL,'247'),(196,3,'Daylite Call & Text Unlimited','SUN',1,100.00,'WRTSDCTU100',NULL,'247'),(197,3,'Budgetxt','SUN',1,5.00,'WRTSBGT5',NULL,'247'),(198,3,'Budgetxt','SUN',1,20.00,'WRTSBGT20',NULL,'247'),(199,3,'Call & Text Combo','SUN',1,10.00,'WRTSCTC10',NULL,'247'),(200,3,'Call & Text Combo','SUN',1,20.00,'WRTSCTC20',NULL,'247'),(201,3,'Call & Text Combo','SUN',1,30.00,'WRTSCTC30',NULL,'247'),(202,3,'Call & Text Combo','SUN',1,50.00,'WRTSCTC50',NULL,'247'),(203,3,'Call & Text Combo','SUN',1,150.00,'WRTSCTC150',NULL,'247'),(204,3,'Flexi Load','SUN',1,30.00,'WRTSFlexi30',NULL,'247'),(205,3,'Flexi Load','SUN',1,50.00,'WRTSFlexi50',NULL,'247'),(206,3,'Sulit Calls','SUN',1,30.00,'WRTSSULIT30',NULL,'247'),(207,3,'Text All','SUN',1,15.00,'WRTSTEXTALL15',NULL,'247'),(208,3,'Text All','SUN',1,20.00,'WRTSTEXTALL20',NULL,'247'),(209,3,'Text All','SUN',1,25.00,'WRTSTAPLUS25',NULL,'247'),(210,3,'Text All','SUN',1,100.00,'WRTSTEXTALL100',NULL,'247'),(211,3,'Todo IDD Tawag','SUN',1,30.00,'WRTSIDDCB30',NULL,'247'),(212,3,'Todo IDD Tawag','SUN',1,300.00,'WRTSTODOIDD300',NULL,'247'),(213,3,'Unlimited Mix','SUN',1,25.00,'WRTSUM25',NULL,'247'),(214,3,'Unlimited Mix','SUN',1,100.00,'WRTSUM100',NULL,'247'),(215,3,'Trio Plus','SUN',1,20.00,'WRTSUTEXTRIO20',NULL,'247'),(216,3,'Trio Plus','SUN',1,30.00,'WRTSTRINET300',NULL,'247'),(217,3,'Mobile Internet','SUN',1,25.00,'WRTSI25',NULL,'247'),(218,3,'Mobile Internet','SUN',1,50.00,'WRTSI50',NULL,'247'),(219,3,'Mobile Internet','SUN',1,999.00,'WRTSI999',NULL,'247'),(220,3,'Sun Broadband Wireless','SUN',1,50.00,'WRTSSBW50',NULL,'247'),(221,3,'Sun Broadband Wireless','SUN',1,100.00,'WRTSSBW100',NULL,'247'),(222,3,'Sun Broadband Wireless','SUN',1,250.00,'WRTSSBW250',NULL,'247'),(223,3,'Sun Broadband Wireless','SUN',1,300.00,'WRTSSBW300',NULL,'247'),(224,1,'UCT','Unli On-net calls,Unli Trinet SMS, 50 All-Net SMS, Free Viber + FB for 1day',1,25.00,'WUCT25','UCT25','343');
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
  `status` tinyint(4) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_loading_transactions`
--

LOCK TABLES `tbl_loading_transactions` WRITE;
/*!40000 ALTER TABLE `tbl_loading_transactions` DISABLE KEYS */;
INSERT INTO `tbl_loading_transactions` VALUES (1,'1802036884045048',1,'FEB7370044D5363EF89BC00433306C927285722E','09127189302','W15',15.00,1,'2018-02-03 13:57:54','2018-02-03 13:57:54'),(2,'1802041050605980',1,'17D18FC28DBA3FA02804218608299B4AC0320258','09127189306','W5',5.00,1,'2018-02-04 09:16:53','2018-02-04 09:16:53'),(3,'1802052007675737',3,'68FC51A961DC021A3F4EA9EFE80A6296A8D975F6','09233702338','WSOTH10',10.00,1,'2018-02-05 13:02:27','2018-02-05 13:02:27'),(4,'1802052007675737',1,'FF387B8F8EEB378E3EB86B370EFAD1AFB4D90F18','09995233848','W5',5.00,1,'2018-02-05 13:03:28','2018-02-05 13:03:28'),(5,'1802053185254630',3,'89CC00D7A288A91992F0404C4DCA410FE5B820FB','09233702338','WSOTH10',10.00,1,'2018-02-05 13:42:16','2018-02-05 13:42:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sms_queue`
--

LOCK TABLES `tbl_sms_queue` WRITE;
/*!40000 ALTER TABLE `tbl_sms_queue` DISABLE KEYS */;
INSERT INTO `tbl_sms_queue` VALUES (1,4,'09177715380','0','09177715380','288721 is your EnghagePro confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-03 13:41:27','2018-02-03 13:41:12'),(2,4,'09177715380','0','09177715380','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-03 13:43:44','2018-02-03 13:43:43'),(3,4,'09177715380','0','09177715380','314520 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-03 13:45:37','2018-02-03 13:45:36'),(4,4,'09177715380','0','09177715380','247087 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-03 13:47:19','2018-02-03 13:47:18'),(5,4,'09127189306','0','09127189306','290244 is your EnghagePro confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-03 13:51:30','2018-02-03 13:51:29'),(6,4,'09127189306','0','09127189306','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-03 13:52:14','2018-02-03 13:52:13'),(7,4,'09127189306','0','09127189306','214640 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-03 13:57:01','2018-02-03 13:56:38'),(8,4,'09950912795','0','09950912795','122758 is your EnghagePro confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-03 13:59:31','2018-02-03 13:59:30'),(9,4,'09950912795','0','09950912795','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-03 14:00:01','2018-02-03 13:59:59'),(10,4,'09177715380','0','09177715380','114581 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-03 15:29:01','2018-02-03 15:28:49'),(11,4,'09177715380','0','09177715380','173094 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-03 15:31:01','2018-02-03 15:30:48'),(12,4,'09354843531','0','09354843531','114548 is your EnghagePro confirmation code. Please do not share this code with anyone. Thank You!',1,'2018-02-03 16:51:01','2018-02-03 16:50:49'),(13,4,'09354843531','0','09354843531','Welcome to EnghagePro, you are now successfully registered.',1,'2018-02-03 16:52:01','2018-02-03 16:51:58'),(14,4,'09950912795','0','09950912795','150506 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-03 19:12:03','2018-02-03 19:12:02'),(15,4,'09127189306','0','09127189306','184485 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-04 09:16:01','2018-02-04 09:15:59'),(16,4,'09177715380','0','09177715380','321398 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-05 12:17:16','2018-02-05 12:16:43'),(17,4,'09177715380','0','09177715380','236608 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-05 12:24:16','2018-02-05 12:23:50'),(18,4,'09177715380','0','09177715380','162619 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-05 13:21:48','2018-02-05 13:21:48'),(19,4,'09177715380','0','09177715380','122453 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-05 13:41:46','2018-02-05 13:41:45'),(20,4,'09177715380','0','09177715380','116338 is your EnghagePro One-Time-Password or OTP. Please do not share this code with anyone. Thank you!',1,'2018-02-05 13:47:48','2018-02-05 13:47:47'),(21,4,'09177715385','0','09177715385','Welcome to EnghagePro, you are now successfully registered.',0,'2018-02-05 14:57:16','2018-02-05 14:57:16'),(22,4,'09177715386','0','09177715386','Welcome to EnghagePro, you are now successfully registered.',0,'2018-02-05 14:58:49','2018-02-05 14:58:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_wallet`
--

LOCK TABLES `tbl_wallet` WRITE;
/*!40000 ALTER TABLE `tbl_wallet` DISABLE KEYS */;
INSERT INTO `tbl_wallet` VALUES (1,1,'XXXXXXXXXXX','XXXXXXXXXXX',100000.00,1,1,'2018-02-03 13:43:43','2018-02-03 13:43:43'),(2,1,'1802031158965101','BUY',5.00,0,0,'2018-02-03 13:45:36','2018-02-03 13:45:36'),(3,1,'1802032323348717','BUY',5.00,0,0,'2018-02-03 13:47:18','2018-02-03 13:47:18'),(4,2,'XXXXXXXXXXX','XXXXXXXXXXX',50.00,1,1,'2018-02-03 13:43:43','2018-02-03 13:43:43'),(5,2,'1802036884045048','BUY',15.00,0,1,'2018-02-03 13:57:54','2018-02-03 13:56:38'),(6,3,'XXXXXXXXXXX','XXXXXXXXXXX',100.00,1,1,'2018-02-03 13:57:54','2018-02-03 13:57:54'),(7,1,'1802037795518446','BUY',15.00,0,0,'2018-02-03 15:28:49','2018-02-03 15:28:49'),(8,1,'1802033227290135','BUY',15.00,0,0,'2018-02-03 15:30:48','2018-02-03 15:30:48'),(9,3,'1802032197458192','BUY',15.00,0,0,'2018-02-03 19:12:02','2018-02-03 19:12:02'),(10,2,'1802041050605980','BUY',5.00,0,1,'2018-02-04 09:16:53','2018-02-04 09:15:59'),(11,1,'1802053236093334','BUY',10.00,0,0,'2018-02-05 12:16:43','2018-02-05 12:16:43'),(12,1,'1802052007675737','BUY',10.00,0,1,'2018-02-05 13:03:28','2018-02-05 12:23:50'),(13,1,'1802052689092847','BUY',10.00,0,0,'2018-02-05 13:21:48','2018-02-05 13:21:48'),(14,1,'1802053185254630','BUY',10.00,0,1,'2018-02-05 13:42:16','2018-02-05 13:41:45'),(15,4,'XXXXXXXXXXX','XXXXXXXXXXX',50.00,1,1,'2018-02-05 13:42:16','2018-02-05 13:42:16'),(16,1,'1802052489861017','BUY',15.00,0,0,'2018-02-05 13:47:47','2018-02-05 13:47:47');
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

-- Dump completed on 2018-02-05 22:02:24
