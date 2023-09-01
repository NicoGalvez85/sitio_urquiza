-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: pp2sitio
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accesos` (
  `id_accesos` int NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime NOT NULL,
  `persona_cuil` bigint NOT NULL,
  `persona_id_rol` int NOT NULL,
  PRIMARY KEY (`id_accesos`,`persona_cuil`,`persona_id_rol`),
  KEY `fk_accesos_persona_idx` (`persona_cuil`,`persona_id_rol`),
  CONSTRAINT `fk_accesos_persona` FOREIGN KEY (`persona_cuil`, `persona_id_rol`) REFERENCES `persona` (`cuil`, `id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `cuil` bigint NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id_rol` int NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cuil`,`id_rol`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  KEY `fk_persona_rol1_idx` (`id_rol`),
  CONSTRAINT `fk_persona_rol1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'ejnombre','ejapellido','e@mly','987654',0,1),(123,'Emanuel','Galvez','nicolasgalvz1985@gmail.com1','123',1,1),(4565,'Emanuel','Galvez','nicolasgalvez1985@gmail.com1','456',1,1),(20318650,'Nicolas','Galvez','nicogalvez1985@gmail.com','$2y$10$9EYSrL0UdTERN8RhPjtBZ.oS3Nxn3rH9yzfeY5ejUzgzWpYWMkiVu',1,1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicación`
--

DROP TABLE IF EXISTS `publicación`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publicación` (
  `id_publicación` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `persona_cuil` bigint NOT NULL,
  PRIMARY KEY (`id_publicación`,`persona_cuil`),
  KEY `fk_publicación_persona_idx` (`persona_cuil`),
  CONSTRAINT `fk_publicación_persona` FOREIGN KEY (`persona_cuil`) REFERENCES `persona` (`cuil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicación`
--

LOCK TABLES `publicación` WRITE;
/*!40000 ALTER TABLE `publicación` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicación` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id_rol` int NOT NULL,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (0,'administrador'),(1,'regente'),(2,'profesor'),(3,'alumno'),(4,'bedel'),(5,'secretario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-01 20:14:57
