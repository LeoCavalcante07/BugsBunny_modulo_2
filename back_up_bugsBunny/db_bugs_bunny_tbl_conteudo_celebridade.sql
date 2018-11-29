-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: db_bugs_bunny
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_conteudo_celebridade`
--

DROP TABLE IF EXISTS `tbl_conteudo_celebridade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_conteudo_celebridade` (
  `idConteudoCelebridade` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `texto` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `idCelebridade` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idConteudoCelebridade`),
  KEY `idCelebridade_idx` (`idCelebridade`),
  CONSTRAINT `idCelebridade` FOREIGN KEY (`idCelebridade`) REFERENCES `tbl_celebridade` (`idcelebridade`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_conteudo_celebridade`
--

LOCK TABLES `tbl_conteudo_celebridade` WRITE;
/*!40000 ALTER TABLE `tbl_conteudo_celebridade` DISABLE KEYS */;
INSERT INTO `tbl_conteudo_celebridade` VALUES (32,'infancia de lulu','           Guinchou fracamente, seu fogo apagou, seu corpo caiu no chão e se transformou em cinzas negras.\r\nApós alguns segundos, as partículas das cinzas começaram a se agitar a ponto de queimarem.                                  ','arquivos/29649e774c868d164dd0bc8d41bb96d8.jpg','arquivos/1cb745860c5a52636eaad74fee7bc631.jpg',17,1),(33,'Assalto ao banco','Guinchou fracamente, seu fogo apagou, seu corpo caiu no chão e se transformou em cinzas negras.\r\nApós alguns segundos, as partículas das cinzas começaram a se agitar a ponto de queimarem.                                             ','arquivos/0204c22f2f9890e14f0357a3f30e992f.jpeg','arquivos/0a0aaefb5c6426899ed262dc5f12cb5c.jpg',17,1);
/*!40000 ALTER TABLE `tbl_conteudo_celebridade` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-27 16:55:20
