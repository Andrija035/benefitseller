-- MySQL dump 10.13  Distrib 5.7.42, for Linux (x86_64)
--
-- Host: localhost    Database: benefitseller_test
-- ------------------------------------------------------
-- Server version	5.7.42-0ubuntu0.18.04.1

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
-- Table structure for table `api_token`
--

DROP TABLE IF EXISTS `api_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7BA2F5EB4AF96AFC` (`authority`),
  UNIQUE KEY `UNIQ_7BA2F5EB5F37A13B` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_token`
--

LOCK TABLES `api_token` WRITE;
/*!40000 ALTER TABLE `api_token` DISABLE KEYS */;
INSERT INTO `api_token` VALUES (3,'benefitseller','testvalue',1,'2024-04-08 18:49:14');
/*!40000 ALTER TABLE `api_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `benefits`
--

DROP TABLE IF EXISTS `benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benefits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_965A49FE6796D554` (`merchant_id`),
  CONSTRAINT `FK_965A49FE6796D554` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benefits`
--

LOCK TABLES `benefits` WRITE;
/*!40000 ALTER TABLE `benefits` DISABLE KEYS */;
/*!40000 ALTER TABLE `benefits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` datetime NOT NULL,
  `cvv` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `funds` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4C258FD96901F54` (`number`),
  UNIQUE KEY `UNIQ_4C258FDA76ED395` (`user_id`),
  CONSTRAINT `FK_4C258FDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (22,1,'4859123456719012','2026-04-08 21:05:06','123','1234567891123456',50000,'2024-04-08 21:05:06'),(23,2,'5634123456729012','2026-04-08 21:05:06','321','9876543212987654',14000,'2024-04-08 21:05:06'),(24,3,'7890123456739012','2026-04-08 21:05:06','234','8765432103876543',29000,'2024-04-08 21:05:06'),(25,4,'1234567890143456','2026-04-08 21:05:06','543','6543210984654321',89000,'2024-04-08 21:05:06'),(26,5,'9876123456759012','2026-04-08 21:05:06','654','2345678905234567',12300,'2024-04-08 21:05:06'),(27,6,'4567123456769012','2026-04-08 21:05:06','234','3456789016345678',65000,'2024-04-08 21:05:06'),(28,7,'2345123456779012','2026-04-08 21:05:06','543','4567890127456789',7600,'2024-04-08 21:05:06'),(29,8,'8765123456789012','2026-04-08 21:05:06','876','5678901238567890',59000,'2024-04-08 21:05:06'),(30,9,'3456123456799012','2026-04-08 21:05:06','678','6789012349678901',5900,'2024-04-08 21:05:06'),(31,10,'6543123456089012','2026-04-08 21:05:06','087','7890123406789012',63000,'2024-04-08 21:05:06'),(32,12,'9876123451789012','2026-04-08 21:05:06','678','8901234167890123',21000,'2024-04-08 21:05:06'),(33,13,'4561123452789012','2026-04-08 21:05:06','456','9012345278901234',72800,'2024-04-08 21:05:06'),(34,14,'8765123453789012','2026-04-08 21:05:06','275','0123456389012345',92100,'2024-04-08 21:05:06'),(35,15,'2345123454789012','2026-04-08 21:05:06','357','5432109476543210',2890,'2024-04-08 21:05:06'),(36,16,'5634123455789012','2026-04-08 21:05:06','437','4321098565432109',17890,'2024-04-08 21:05:06'),(37,17,'3456123456789012','2026-04-08 21:05:06','286','3210987654321098',43210,'2024-04-08 21:05:06'),(38,18,'7890123457789012','2026-04-08 21:05:06','098','2109876743210987',20000,'2024-04-08 21:05:06'),(39,19,'6543123458789012','2026-04-08 21:05:06','890','0987654821098765',10000,'2024-04-08 21:05:06'),(40,20,'4859123459789012','2026-04-08 21:05:06','780','9876543910987654',14000,'2024-04-08 21:05:06'),(41,21,'9876123450789012','2026-04-08 21:05:06','375','8765432009876543',300,'2024-04-08 21:05:06'),(42,11,'1234567810123456','2026-04-08 21:05:06','632','7654324098765432',800,'2024-04-08 21:05:06');
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Lorem','2024-04-08 20:53:09'),(2,'Ipsum','2024-04-08 20:53:09'),(3,'Dolor','2024-04-08 20:53:09');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240408113316','2024-04-08 11:34:15',51594),('DoctrineMigrations\\Version20240408113327','2024-04-08 17:09:25',1);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant_categories`
--

DROP TABLE IF EXISTS `merchant_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant_categories`
--

LOCK TABLES `merchant_categories` WRITE;
/*!40000 ALTER TABLE `merchant_categories` DISABLE KEYS */;
INSERT INTO `merchant_categories` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6);
/*!40000 ALTER TABLE `merchant_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchants`
--

DROP TABLE IF EXISTS `merchants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CC77B6C094F720F1` (`merchant_category_id`),
  CONSTRAINT `FK_CC77B6C094F720F1` FOREIGN KEY (`merchant_category_id`) REFERENCES `merchant_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchants`
--

LOCK TABLES `merchants` WRITE;
/*!40000 ALTER TABLE `merchants` DISABLE KEYS */;
INSERT INTO `merchants` VALUES (1,1,'sapien',5,'2024-04-08 21:58:32'),(2,2,'orci',10,'2024-04-08 21:58:32'),(3,3,'Pellentesque',15,'2024-04-08 21:58:32'),(4,4,'varius',20,'2024-04-08 21:58:32'),(5,5,'pharetra',25,'2024-04-08 21:58:32'),(6,6,'posuere',30,'2024-04-08 21:58:32');
/*!40000 ALTER TABLE `merchants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_merchant`
--

DROP TABLE IF EXISTS `package_merchant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_merchant` (
  `package_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  PRIMARY KEY (`package_id`,`merchant_id`),
  KEY `IDX_902AB18FF44CABFF` (`package_id`),
  KEY `IDX_902AB18F6796D554` (`merchant_id`),
  CONSTRAINT `FK_902AB18F6796D554` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_902AB18FF44CABFF` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_merchant`
--

LOCK TABLES `package_merchant` WRITE;
/*!40000 ALTER TABLE `package_merchant` DISABLE KEYS */;
INSERT INTO `package_merchant` VALUES (3,2),(3,4),(3,6),(6,1),(6,4),(9,5);
/*!40000 ALTER TABLE `package_merchant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_merchant_category`
--

DROP TABLE IF EXISTS `package_merchant_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_merchant_category` (
  `package_id` int(11) NOT NULL,
  `merchant_category_id` int(11) NOT NULL,
  PRIMARY KEY (`package_id`,`merchant_category_id`),
  KEY `IDX_FD973597F44CABFF` (`package_id`),
  KEY `IDX_FD97359794F720F1` (`merchant_category_id`),
  CONSTRAINT `FK_FD97359794F720F1` FOREIGN KEY (`merchant_category_id`) REFERENCES `merchant_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FD973597F44CABFF` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_merchant_category`
--

LOCK TABLES `package_merchant_category` WRITE;
/*!40000 ALTER TABLE `package_merchant_category` DISABLE KEYS */;
INSERT INTO `package_merchant_category` VALUES (1,1),(1,3),(1,6),(4,1),(4,2),(7,5);
/*!40000 ALTER TABLE `package_merchant_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_category` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9BB5C0A7979B1AD6` (`company_id`),
  CONSTRAINT `FK_9BB5C0A7979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,1,1,'2024-04-08 22:00:50'),(2,1,2,'2024-04-08 22:00:50'),(3,1,3,'2024-04-08 22:00:50'),(4,2,1,'2024-04-08 22:00:51'),(5,2,2,'2024-04-08 22:00:51'),(6,2,3,'2024-04-08 22:00:51'),(7,3,1,'2024-04-08 22:00:51'),(8,3,2,'2024-04-08 22:00:51'),(9,3,3,'2024-04-08 22:00:51');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EAA81A4C4ACC9A20` (`card_id`),
  KEY `IDX_EAA81A4C6796D554` (`merchant_id`),
  CONSTRAINT `FK_EAA81A4C4ACC9A20` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`),
  CONSTRAINT `FK_EAA81A4C6796D554` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` smallint(6) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  KEY `IDX_1483A5E9979B1AD6` (`company_id`),
  CONSTRAINT `FK_1483A5E9979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'sit@amet.com','sit','consectetur',1,'2024-04-08 21:05:06'),(2,1,'adipiscing@amet.com','adipiscing','elit',1,'2024-04-08 21:05:06'),(3,1,'Morbi@amet.com','Morbi','vitae',2,'2024-04-08 21:05:06'),(4,1,'augue@amet.com','augue','massa',2,'2024-04-08 21:05:06'),(5,1,'viverra@amet.com','viverra','posuere',2,'2024-04-08 21:05:06'),(6,1,'mattis@amet.com','mattis','ac',3,'2024-04-08 21:05:06'),(7,1,'nibh@amet.com','nibh','Sed',3,'2024-04-08 21:05:06'),(8,2,'sit@consequat.com','semper','consectetur',1,'2024-04-08 21:05:06'),(9,2,'adipiscing@consequat.com','blandit','elit',3,'2024-04-08 21:05:06'),(10,2,'Morbi@consequat.com','luctus','vitae',2,'2024-04-08 21:05:06'),(11,2,'augue@consequat.com','pretium','massa',1,'2024-04-08 21:05:06'),(12,2,'viverra@consequat.com','Donec','posuere',2,'2024-04-08 21:05:06'),(13,2,'mattis@consequat.com','sodales','ac',3,'2024-04-08 21:05:06'),(14,2,'nibh@consequat.com','tortor','Sed',3,'2024-04-08 21:05:06'),(15,3,'sit@elementum.com','eros','consectetur',1,'2024-04-08 21:05:06'),(16,3,'adipiscing@elementum.com','gravida','elit',2,'2024-04-08 21:05:06'),(17,3,'Morbi@elementum.com','tempor','vitae',3,'2024-04-08 21:05:06'),(18,3,'augue@elementum.com','pretium','massa',1,'2024-04-08 21:05:06'),(19,3,'viverra@elementum.com','ultrices','posuere',2,'2024-04-08 21:05:06'),(20,3,'mattis@elementum.com','mattis','ac',3,'2024-04-08 21:05:06'),(21,3,'nibh@elementum.com','diam','Sed',1,'2024-04-08 21:05:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-08 22:59:47
