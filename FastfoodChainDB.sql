CREATE DATABASE  IF NOT EXISTS `test1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `test1`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: test1
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `apothiki`
--

DROP TABLE IF EXISTS `apothiki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apothiki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topothesia` varchar(50) NOT NULL,
  `kodikos_katasthmatos` char(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kodikos_katasthmatos` (`kodikos_katasthmatos`),
  CONSTRAINT `apothiki_ibfk_1` FOREIGN KEY (`kodikos_katasthmatos`) REFERENCES `katasthma` (`kodikos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apothiki`
--

LOCK TABLES `apothiki` WRITE;
/*!40000 ALTER TABLE `apothiki` DISABLE KEYS */;
INSERT INTO `apothiki` VALUES (1,'Αθήνα Κεντρική','A1001'),(2,'Θεσσαλονίκη Β','B2002');
/*!40000 ALTER TABLE `apothiki` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geyma`
--

DROP TABLE IF EXISTS `geyma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `geyma` (
  `kodikos` char(4) NOT NULL,
  `onomasia` varchar(35) NOT NULL,
  `timi` decimal(6,2) NOT NULL,
  `kathgoria` varchar(20) DEFAULT NULL,
  `perigrafi` text DEFAULT NULL,
  PRIMARY KEY (`kodikos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geyma`
--

LOCK TABLES `geyma` WRITE;
/*!40000 ALTER TABLE `geyma` DISABLE KEYS */;
INSERT INTO `geyma` VALUES ('G101','Burger Classic',5.50,'Burger','Ζουμερό μπιφτέκι με τυρί και λαχανικά'),('G102','Pizza Special',8.20,'Pizza','Χειροποίητη πίτσα με αγνά υλικά'),('G103','Salad Healthy',4.00,'Salad','Φρέσκια σαλάτα με ποικιλία λαχανικών'),('G104','Pasta Carbonara',7.50,'Pasta','Κλασική ιταλική καρμπονάρα με μπέικον'),('G105','Chicken Wrap',6.80,'Wrap','Τορτίγια με κοτόπουλο και λαχανικά');
/*!40000 ALTER TABLE `geyma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `katasthma`
--

DROP TABLE IF EXISTS `katasthma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `katasthma` (
  `kodikos` char(5) NOT NULL,
  `poli` varchar(25) NOT NULL,
  `emvadon` decimal(8,2) NOT NULL,
  `tilefono` varchar(15) DEFAULT NULL,
  `hmer_rydrisis` date DEFAULT NULL,
  PRIMARY KEY (`kodikos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `katasthma`
--

LOCK TABLES `katasthma` WRITE;
/*!40000 ALTER TABLE `katasthma` DISABLE KEYS */;
INSERT INTO `katasthma` VALUES ('A1001','Αθήνα',120.50,'2101234567','2005-06-15'),('B2002','Θεσσαλονίκη',90.75,'2310234567','2010-08-20'),('C3003','Πάτρα',110.00,'2610234567','2015-02-10'),('D4004','Ηράκλειο',150.20,'2810234567','2012-05-18'),('E5005','Λάρισα',95.60,'2410234567','2018-09-30');
/*!40000 ALTER TABLE `katasthma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paraggelia`
--

DROP TABLE IF EXISTS `paraggelia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paraggelia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hmerominia` date NOT NULL,
  `kodikos_katasthmatos` char(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kodikos_katasthmatos` (`kodikos_katasthmatos`),
  CONSTRAINT `paraggelia_ibfk_1` FOREIGN KEY (`kodikos_katasthmatos`) REFERENCES `katasthma` (`kodikos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paraggelia`
--

LOCK TABLES `paraggelia` WRITE;
/*!40000 ALTER TABLE `paraggelia` DISABLE KEYS */;
INSERT INTO `paraggelia` VALUES (1,'2023-06-15','A1001'),(2,'2023-07-20','B2002'),(3,'2023-08-10','C3003');
/*!40000 ALTER TABLE `paraggelia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelaths`
--

DROP TABLE IF EXISTS `pelaths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelaths` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onomateponymo` varchar(40) NOT NULL,
  `tilefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelaths`
--

LOCK TABLES `pelaths` WRITE;
/*!40000 ALTER TABLE `pelaths` DISABLE KEYS */;
INSERT INTO `pelaths` VALUES (1,'Δημήτρης Παπαδόπουλος','6987654321'),(2,'Ελένη Μανωλά','6912345678');
/*!40000 ALTER TABLE `pelaths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promitheytis`
--

DROP TABLE IF EXISTS `promitheytis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promitheytis` (
  `kodikos` char(6) NOT NULL,
  `epwnymia` varchar(40) NOT NULL,
  `tilefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kodikos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promitheytis`
--

LOCK TABLES `promitheytis` WRITE;
/*!40000 ALTER TABLE `promitheytis` DISABLE KEYS */;
INSERT INTO `promitheytis` VALUES ('P6001','Ελληνικά Κρεατικά','2109876543'),('P6002','Φρέσκα Λαχανικά Α.Ε.','2310987654'),('P6003','Pizza Supreme','2410123456');
/*!40000 ALTER TABLE `promitheytis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prosfora`
--

DROP TABLE IF EXISTS `prosfora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prosfora` (
  `kodikos_katasthmatos` char(5) NOT NULL,
  `kodikos_geymatos` char(4) NOT NULL,
  PRIMARY KEY (`kodikos_katasthmatos`,`kodikos_geymatos`),
  KEY `kodikos_geymatos` (`kodikos_geymatos`),
  CONSTRAINT `prosfora_ibfk_1` FOREIGN KEY (`kodikos_katasthmatos`) REFERENCES `katasthma` (`kodikos`),
  CONSTRAINT `prosfora_ibfk_2` FOREIGN KEY (`kodikos_geymatos`) REFERENCES `geyma` (`kodikos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prosfora`
--

LOCK TABLES `prosfora` WRITE;
/*!40000 ALTER TABLE `prosfora` DISABLE KEYS */;
INSERT INTO `prosfora` VALUES ('A1001','G101'),('B2002','G102'),('B2002','G103'),('C3003','G101'),('D4004','G104'),('E5005','G105');
/*!40000 ALTER TABLE `prosfora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ypallhlos`
--

DROP TABLE IF EXISTS `ypallhlos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ypallhlos` (
  `ar_tautotitas` int(11) NOT NULL,
  `onomateponymo` varchar(30) NOT NULL,
  `misthos` decimal(8,2) NOT NULL,
  `kodikos_katasthmatos` char(5) NOT NULL,
  `thesi` varchar(20) DEFAULT NULL,
  `hmer_proslipsis` date DEFAULT NULL,
  PRIMARY KEY (`ar_tautotitas`),
  KEY `kodikos_katasthmatos` (`kodikos_katasthmatos`),
  CONSTRAINT `ypallhlos_ibfk_1` FOREIGN KEY (`kodikos_katasthmatos`) REFERENCES `katasthma` (`kodikos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ypallhlos`
--

LOCK TABLES `ypallhlos` WRITE;
/*!40000 ALTER TABLE `ypallhlos` DISABLE KEYS */;
INSERT INTO `ypallhlos` VALUES (1001,'Γιώργος Παπαδόπουλος',1200.00,'A1001','Ταμίας','2018-03-12'),(1002,'Μαρία Καραγιάννη',1350.00,'A1001','Μάγειρας','2016-11-25'),(1003,'Νίκος Αντωνίου',1100.00,'B2002','Σερβιτόρος','2019-07-14'),(1004,'Ελένη Φωτίου',1250.00,'C3003','Υπεύθυνος Βάρδιας','2020-01-10'),(1005,'Ανδρέας Παυλίδης',1300.00,'D4004','Διανομέας','2021-06-05');
/*!40000 ALTER TABLE `ypallhlos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-05  8:34:22
