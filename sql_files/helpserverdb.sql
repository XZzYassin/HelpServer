-- MySQL dump 10.13  Distrib 5.1.72, for Win64 (unknown)
--
-- Host: localhost    Database: helpserverdb
-- ------------------------------------------------------
-- Server version	5.1.72-community

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
-- Table structure for table `asked_helps`
--

DROP TABLE IF EXISTS `asked_helps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asked_helps` (
  `respondent_id` int(10) DEFAULT NULL,
  `asker_id` int(10) DEFAULT NULL,
  `help_id` int(10) DEFAULT NULL,
  KEY `IX_asked_helps_asker_id_help_id` (`asker_id`,`help_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asked_helps`
--

LOCK TABLES `asked_helps` WRITE;
/*!40000 ALTER TABLE `asked_helps` DISABLE KEYS */;
INSERT INTO `asked_helps` VALUES (NULL,2,13),(NULL,2,14),(NULL,3,1),(NULL,1,2),(NULL,2,3),(NULL,1,4);
/*!40000 ALTER TABLE `asked_helps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helps`
--

DROP TABLE IF EXISTS `helps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helps` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `logitude` double(10,5) DEFAULT NULL,
  `latitude` double(10,5) DEFAULT NULL,
  `time_created` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `description` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helps`
--

LOCK TABLES `helps` WRITE;
/*!40000 ALTER TABLE `helps` DISABLE KEYS */;
INSERT INTO `helps` VALUES (1,'Feras',31.96747,35.91779,NULL,NULL,1,NULL),(2,'Madeineh circle',31.98566,35.89783,NULL,NULL,1,NULL),(3,'Home',31.97248,35.91751,NULL,NULL,2,NULL),(4,'Waha',31.99107,35.86838,NULL,NULL,1,NULL),(12,'Aba Aba',32.55550,33.66680,'1432301152','cata',1,'mylovely disc'),(13,'Aba Aba',32.55550,33.66680,'1432301163','cata',1,'mylovely disc'),(14,'Aba Aba',32.55550,33.66680,'1432301244','cata',1,'mylovely disc');
/*!40000 ALTER TABLE `helps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` text,
  `reviewed_id` int(10) DEFAULT NULL,
  `reviewer_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `rate` tinyint(3) DEFAULT NULL,
  `about` text,
  `gender` tinyint(3) DEFAULT NULL,
  `avatar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Yassin','Yassin.Mumen@gmail.com',NULL,NULL,NULL,NULL,NULL,'nashmi.jpg'),(2,'lol','email@lol.net','pass','0780810603',NULL,NULL,NULL,'super.jpg'),(3,'Ezio','ezio@mailnesia.com',NULL,NULL,NULL,NULL,NULL,'bat.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'helpserverdb'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetAroundHelps` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `GetAroundHelps`(IN x double, IN y double, IN maxDest double)
BEGIN    
    SELECT *
    FROM `helps` h
    INNER JOIN `asked_helps` ah
    ON `h`.`id`=`ah`.`help_id`
    WHERE (DEGREES(ACOS(
                SIN(RADIANS(y)) * SIN(RADIANS(`h`.`latitude`)) +
                COS(RADIANS(y)) * COS(RADIANS(`h`.`latitude`)) * COS(RADIANS(x - `h`.`logitude`))
                ))* 60 * 1.1515 * 1.609344) <= maxDest
                AND `h`.`status` = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-22 18:11:54
