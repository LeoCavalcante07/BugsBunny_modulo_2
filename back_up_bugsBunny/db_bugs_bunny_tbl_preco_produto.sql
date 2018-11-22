-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: db_bugs_bunny
-- ------------------------------------------------------
-- Server version	5.6.10-log

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
-- Table structure for table `tbl_preco_produto`
--

DROP TABLE IF EXISTS `tbl_preco_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_preco_produto` (
  `idPrecoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `preco` double NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date DEFAULT NULL,
  `promocao` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`idPrecoProduto`),
  KEY `idProduto_idx` (`idProduto`),
  CONSTRAINT `idProduto` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produto` (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_preco_produto`
--

LOCK TABLES `tbl_preco_produto` WRITE;
/*!40000 ALTER TABLE `tbl_preco_produto` DISABLE KEYS */;
INSERT INTO `tbl_preco_produto` VALUES (1,1,25,'1999-01-01','2010-11-10',0),(3,2,9,'1999-01-01','1999-01-03',0),(4,2,5,'1999-01-03','2010-11-10',0),(5,3,50,'1999-01-03','1999-01-05',0),(6,3,20,'1999-01-05',NULL,0),(7,4,500,'1999-01-10','1999-01-11',0),(8,4,100,'1999-01-11',NULL,1),(85,1,5,'2010-11-10','2010-11-11',0),(86,1,50,'2010-11-11','2010-11-11',0),(87,1,10,'2010-11-11',NULL,1),(88,2,5,'2010-11-10','2010-11-12',0),(89,2,4,'2010-11-12',NULL,1);
/*!40000 ALTER TABLE `tbl_preco_produto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-08 11:24:09
