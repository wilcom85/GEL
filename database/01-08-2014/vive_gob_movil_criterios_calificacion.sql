CREATE DATABASE  IF NOT EXISTS `vive_gob_movil` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `vive_gob_movil`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: vive_gob_movil
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `criterios_calificacion`
--

DROP TABLE IF EXISTS `criterios_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterios_calificacion` (
  `id` int(3) NOT NULL,
  `criterio` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fk_id_aspectos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_aspectos` (`fk_id_aspectos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterios_calificacion`
--

LOCK TABLES `criterios_calificacion` WRITE;
/*!40000 ALTER TABLE `criterios_calificacion` DISABLE KEYS */;
INSERT INTO `criterios_calificacion` VALUES (0,'La aplicación plantea tiempos de respuesta aceptable en todas sus funcionalidades.\r\n',0),(1,'La presentación de la aplicación se puede utilizar sin tener mucho conocimiento previo.',0),(2,'La aplicación plantea tiempos de respuesta aceptable en todas sus funcionalidades.',0),(3,'La aplicación plantea un lineamiento gráfico para todas sus pantallas.',0),(4,'La aplicación manejará uniformidad de colores (cuando aplique),  y presentación agradable para el usuario.',0),(5,'Los elementos gráficos usados tienen una nitidez adecuada y comunican claramente la funcionalidad a la que representan.',0),(6,'La aplicación resuelve la problemática presentada en el reto.',0),(7,'Es viable desarrollar completamente las funcionalidades propuestas en el tiempo establecido para concluir la aplicación (8 semanas).',0),(8,'Las funcionalidades desarrolladas están completas o en un nivel avanzado de desarrollo.',0),(9,'La aplicación es innovadora.',0),(10,'La aplicación combina las fuentes de información disponibles de una manera novedosa.',0),(11,'La aplicación supone curiosidad y gusto por la renovación.',0);
/*!40000 ALTER TABLE `criterios_calificacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-08 14:47:35
