CREATE DATABASE  IF NOT EXISTS `dbestacionamento` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dbestacionamento`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 10.107.134.44    Database: dbestacionamento
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `tblcliente`
--

DROP TABLE IF EXISTS `tblcliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcliente` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(180) NOT NULL,
  `telefone` varchar(22) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcliente`
--

LOCK TABLES `tblcliente` WRITE;
/*!40000 ALTER TABLE `tblcliente` DISABLE KEYS */;
INSERT INTO `tblcliente` VALUES (1,'Julia','101010'),(2,'Julio','202020'),(3,'Judas','303030'),(4,'Jonas','404040'),(5,'Joana','505050'),(6,'Josi','606060');
/*!40000 ALTER TABLE `tblcliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcor`
--

DROP TABLE IF EXISTS `tblcor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcor`
--

LOCK TABLES `tblcor` WRITE;
/*!40000 ALTER TABLE `tblcor` DISABLE KEYS */;
INSERT INTO `tblcor` VALUES (1,'Preto'),(2,'Cinza'),(4,'Vermelho'),(5,'Marrom'),(6,'Amarelo'),(13,'rosa'),(14,'rosa'),(15,'rosa'),(16,'rosa'),(17,'rosa'),(18,'rosa'),(19,'rosa'),(20,'rosa'),(21,'rosa'),(22,'rosa'),(23,'rosa'),(24,'rosa'),(25,'rosa'),(26,'rosa');
/*!40000 ALTER TABLE `tblcor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcorredor`
--

DROP TABLE IF EXISTS `tblcorredor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcorredor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  `idSetor` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Setor_Corredor` (`idSetor`),
  CONSTRAINT `FK_Setor_Corredor` FOREIGN KEY (`idSetor`) REFERENCES `tblsetor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcorredor`
--

LOCK TABLES `tblcorredor` WRITE;
/*!40000 ALTER TABLE `tblcorredor` DISABLE KEYS */;
INSERT INTO `tblcorredor` VALUES (1,'a1',1),(2,'b1',1),(3,'c1',1),(4,'d1',1);
/*!40000 ALTER TABLE `tblcorredor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmovimentacao`
--

DROP TABLE IF EXISTS `tblmovimentacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblmovimentacao` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dataEntrada` date NOT NULL,
  `dataSaida` date DEFAULT NULL,
  `horaEntrada` time NOT NULL,
  `horaSaida` time DEFAULT NULL,
  `idVaga` int unsigned NOT NULL,
  `idVeiculo` int unsigned NOT NULL,
  `valor` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Vaga_Movimentacao` (`idVaga`),
  KEY `FK_Veiculo_Movimentacao` (`idVeiculo`),
  CONSTRAINT `FK_Vaga_Movimentacao` FOREIGN KEY (`idVaga`) REFERENCES `tblvaga` (`id`),
  CONSTRAINT `FK_Veiculo_Movimentacao` FOREIGN KEY (`idVeiculo`) REFERENCES `tblveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmovimentacao`
--

LOCK TABLES `tblmovimentacao` WRITE;
/*!40000 ALTER TABLE `tblmovimentacao` DISABLE KEYS */;
INSERT INTO `tblmovimentacao` VALUES (3,'2022-06-03',NULL,'13:52:06',NULL,3,2,NULL),(4,'2022-06-02',NULL,'13:52:06',NULL,3,5,NULL),(13,'2022-06-20','2022-06-20','12:40:55','14:00:00',5,1,NULL),(14,'2022-06-20','2022-06-20','11:00:00','11:30:00',2,1,NULL),(15,'2022-06-20','2022-06-20','15:00:00','18:00:00',3,1,NULL),(16,'2022-06-20','2022-06-20','07:00:00','11:00:00',4,1,NULL);
/*!40000 ALTER TABLE `tblmovimentacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpiso`
--

DROP TABLE IF EXISTS `tblpiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpiso` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpiso`
--

LOCK TABLES `tblpiso` WRITE;
/*!40000 ALTER TABLE `tblpiso` DISABLE KEYS */;
INSERT INTO `tblpiso` VALUES (1,'A'),(2,'B'),(3,'C'),(4,'D'),(5,'12'),(6,'12'),(7,'12'),(8,'12'),(9,'12'),(10,'12'),(11,'12'),(12,'12'),(13,'12'),(14,'12'),(15,'12');
/*!40000 ALTER TABLE `tblpiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpreco`
--

DROP TABLE IF EXISTS `tblpreco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblpreco` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `preco` double NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idTipoVeiculo` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_TipoVeiculo_Preco` (`idTipoVeiculo`),
  CONSTRAINT `FK_TipoVeiculo_Preco` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbltipoveiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpreco`
--

LOCK TABLES `tblpreco` WRITE;
/*!40000 ALTER TABLE `tblpreco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpreco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsetor`
--

DROP TABLE IF EXISTS `tblsetor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsetor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  `idPiso` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Piso_Setor` (`idPiso`),
  CONSTRAINT `FK_Piso_Setor` FOREIGN KEY (`idPiso`) REFERENCES `tblpiso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsetor`
--

LOCK TABLES `tblsetor` WRITE;
/*!40000 ALTER TABLE `tblsetor` DISABLE KEYS */;
INSERT INTO `tblsetor` VALUES (1,'a1',1),(2,'b1',1),(3,'c1',1),(4,'d1',1),(5,'a1',1),(6,'b1',1),(7,'c1',1),(8,'d1',1),(9,'1',1),(10,'uva',4),(11,'uva',4),(12,'uva',4),(13,'uva',4),(14,'uva',4),(15,'uva',4),(16,'uva',4),(17,'uva',4),(18,'uva',4),(19,'uva',4),(20,'uva',4),(21,'uva',4),(22,'uva',4),(23,'uva',4),(24,'uva',4),(25,'uva',4),(26,'uva',4),(27,'uva',4),(28,'uva',4),(29,'uva',4),(30,'uva',4),(31,'uva',4),(32,'uva',4),(33,'uva',4),(34,'uva',4),(35,'uva',4),(36,'uva',4),(37,'uva',4),(38,'uva',4),(39,'uva',4),(40,'uva',4),(41,'uva',4),(42,'uva',4),(43,'uva',4),(44,'uva',4),(45,'uva',4),(46,'uva',4),(47,'uva',4),(48,'uva',4),(49,'uva',4),(50,'uva',4),(51,'uva',4),(52,'uva',4),(53,'uva',4),(54,'uva',4),(55,'uva',4),(56,'uva',4),(57,'uva',4),(58,'uva',4),(59,'uva',4),(60,'uva',4);
/*!40000 ALTER TABLE `tblsetor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstatusvaga`
--

DROP TABLE IF EXISTS `tblstatusvaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblstatusvaga` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstatusvaga`
--

LOCK TABLES `tblstatusvaga` WRITE;
/*!40000 ALTER TABLE `tblstatusvaga` DISABLE KEYS */;
INSERT INTO `tblstatusvaga` VALUES (1,'disponivel'),(2,'ocupado'),(3,'manutenção'),(4,'5'),(5,'5'),(6,'6'),(7,'6'),(8,'6'),(9,'6'),(10,'6'),(11,'6'),(12,'6'),(13,'6'),(14,'6'),(15,'6'),(16,'6'),(17,'6'),(18,'6'),(19,'6'),(20,'6'),(21,'6'),(22,'7'),(23,'7'),(24,'7'),(25,'7'),(26,'7'),(27,'7');
/*!40000 ALTER TABLE `tblstatusvaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltipoveiculo`
--

DROP TABLE IF EXISTS `tbltipoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltipoveiculo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltipoveiculo`
--

LOCK TABLES `tbltipoveiculo` WRITE;
/*!40000 ALTER TABLE `tbltipoveiculo` DISABLE KEYS */;
INSERT INTO `tbltipoveiculo` VALUES (7,'moto'),(8,'carro'),(9,'ônibus'),(10,'vam'),(11,'lancha'),(12,'helicoptero');
/*!40000 ALTER TABLE `tbltipoveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblvaga`
--

DROP TABLE IF EXISTS `tblvaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblvaga` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `idCorredor` int unsigned NOT NULL,
  `idStatusVaga` int unsigned NOT NULL,
  `idTipoVeiculo` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Corredor_Vaga` (`idCorredor`),
  KEY `FK_StatusVaga_Vaga` (`idStatusVaga`),
  KEY `FK_TipoVeiculo_Vaga` (`idTipoVeiculo`),
  CONSTRAINT `FK_Corredor_Vaga` FOREIGN KEY (`idCorredor`) REFERENCES `tblcorredor` (`id`),
  CONSTRAINT `FK_StatusVaga_Vaga` FOREIGN KEY (`idStatusVaga`) REFERENCES `tblstatusvaga` (`id`),
  CONSTRAINT `FK_TipoVeiculo_Vaga` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbltipoveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblvaga`
--

LOCK TABLES `tblvaga` WRITE;
/*!40000 ALTER TABLE `tblvaga` DISABLE KEYS */;
INSERT INTO `tblvaga` VALUES (2,'batatinha',1,1,9),(3,'batati 343',1,1,9),(4,'batati 43',1,1,9),(5,'batati 143',1,1,9);
/*!40000 ALTER TABLE `tblvaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblveiculo`
--

DROP TABLE IF EXISTS `tblveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblveiculo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(45) NOT NULL,
  `fabricante` varchar(80) NOT NULL,
  `modelo` varchar(80) NOT NULL,
  `idCor` int unsigned NOT NULL,
  `idTipoVeiculo` int unsigned NOT NULL,
  `idCliente` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Cor_Veiculo` (`idCor`),
  KEY `FK_TipoVeiculo_Veiculo` (`idTipoVeiculo`),
  KEY `FK_Cliente_Veiculo` (`idCliente`),
  CONSTRAINT `FK_Cliente_Veiculo` FOREIGN KEY (`idCliente`) REFERENCES `tblcliente` (`id`),
  CONSTRAINT `FK_Cor_Veiculo` FOREIGN KEY (`idCor`) REFERENCES `tblcor` (`id`),
  CONSTRAINT `FK_TipoVeiculo_Veiculo` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbltipoveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblveiculo`
--

LOCK TABLES `tblveiculo` WRITE;
/*!40000 ALTER TABLE `tblveiculo` DISABLE KEYS */;
INSERT INTO `tblveiculo` VALUES (1,'aaa-111','ford','fordKa',4,8,3),(2,'ddd-111','ford','fordKa',6,11,6),(3,'bbb-111','honda','CB300',2,7,2),(4,'ccc-111','Kawasaki','Kawasaki',1,8,1),(5,'ccc-111','renalt','van',1,10,5);
/*!40000 ALTER TABLE `tblveiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-03 16:58:34
