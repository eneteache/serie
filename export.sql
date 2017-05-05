CREATE DATABASE  IF NOT EXISTS `series` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `series`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: series
-- ------------------------------------------------------
-- Server version	5.7.15-log

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
-- Table structure for table `invitaciones_email`
--

DROP TABLE IF EXISTS `invitaciones_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitaciones_email` (
  `idInvitacion` int(11) NOT NULL AUTO_INCREMENT,
  `origen` char(100) NOT NULL,
  `destino` char(100) NOT NULL,
  `codigo` char(100) NOT NULL,
  `activo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idInvitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitaciones_email`
--

LOCK TABLES `invitaciones_email` WRITE;
/*!40000 ALTER TABLE `invitaciones_email` DISABLE KEYS */;
INSERT INTO `invitaciones_email` VALUES (1,'anthony1997@hotmail.es','prueba@correo.es','c893bad68927b457dbed39460e6afd62',1);
/*!40000 ALTER TABLE `invitaciones_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitaciones_usuario`
--

DROP TABLE IF EXISTS `invitaciones_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitaciones_usuario` (
  `idInvitacion` int(11) NOT NULL AUTO_INCREMENT,
  `origen` char(30) NOT NULL,
  `codigo` char(100) NOT NULL,
  `activo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idInvitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitaciones_usuario`
--

LOCK TABLES `invitaciones_usuario` WRITE;
/*!40000 ALTER TABLE `invitaciones_usuario` DISABLE KEYS */;
INSERT INTO `invitaciones_usuario` VALUES (1,'eneteache','e10adc3949ba59abbe56e057f20f883e',0);
/*!40000 ALTER TABLE `invitaciones_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario` char(30) NOT NULL,
  `clave` char(100) NOT NULL,
  `nombre` char(30) DEFAULT NULL,
  `apellidos` char(80) DEFAULT NULL,
  `email` char(80) NOT NULL,
  `fotoUsuario` char(100) NOT NULL DEFAULT '../imagenes/sinfoto.jpg',
  `tipoUsuario` enum('Usuario','Administrador','Superadministrador') NOT NULL,
  `fechaAlta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nEntradas` int(11) NOT NULL DEFAULT '0',
  `nErrores` int(11) NOT NULL DEFAULT '0',
  `ultimaVisita` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0',
  `invitaciones` int(11) NOT NULL DEFAULT '5',
  `activada` int(11) NOT NULL DEFAULT '0',
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `superadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('eneteache','$2y$10$GUDhTkRwMVxzs5KEr46W8e8SM/XjYP00hhYl0XXZYz1nq8XBtL0ku',NULL,NULL,'anthony1997@hotmail.es','../imagenes/sinfoto.jpg','Administrador','2017-04-25 19:47:35',2,0,'2017-04-26 00:15:42',0,5,1,1,1),('prueba','$2y$10$MTIzNDU2Nzg5c2FseXBpbOpwSG9saOPEU0TgD7RhoK.NQZHJdhVuW',NULL,NULL,'prueba@correo.com','../imagenes/sinfoto.jpg','Usuario','2017-04-26 00:11:41',1,2,'2017-04-26 00:13:02',0,5,0,0,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'series'
--

--
-- Dumping routines for database 'series'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-26  8:22:08
