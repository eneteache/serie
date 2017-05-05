-- MySQL dump 10.13  Distrib 5.7.15, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto
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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_categoria`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Portátiles',0),(2,'Smartphones',0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallespedidos`
--

DROP TABLE IF EXISTS `detallespedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallespedidos` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `nUnidades` int(11) NOT NULL,
  `precioUnitario` float NOT NULL,
  PRIMARY KEY (`idPedido`,`idProducto`),
  CONSTRAINT `detallespedidos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallespedidos`
--

LOCK TABLES `detallespedidos` WRITE;
/*!40000 ALTER TABLE `detallespedidos` DISABLE KEYS */;
INSERT INTO `detallespedidos` VALUES (1,1,1,730),(2,1,1,730),(3,1,1,730),(5,1,1,730),(6,1,1,730),(7,1,1,730),(8,1,1,730),(11,1,1,730),(12,1,1,730),(13,1,1,730),(14,1,1,730),(15,1,1,730),(19,1,1,730),(20,1,1,730),(21,1,1,730),(22,1,1,730),(23,1,1,730),(27,1,1,730),(28,1,1,730),(29,1,1,730),(30,1,1,730),(31,1,1,730),(34,1,1,730),(35,1,1,730),(36,1,1,730),(37,1,1,730),(38,1,1,730),(42,1,1,730),(43,1,1,730),(44,1,1,730),(45,1,1,730),(46,1,1,730),(50,1,1,730),(51,1,1,730),(52,1,1,730),(53,1,1,730),(54,1,1,730),(58,1,1,730),(59,1,1,730),(60,1,1,730),(61,1,1,730),(62,1,1,730),(63,1,1,730),(67,1,1,730),(68,1,1,730);
/*!40000 ALTER TABLE `detallespedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes` (
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `url` char(255) DEFAULT NULL,
  PRIMARY KEY (`idImagen`,`idProducto`),
  KEY `idProducto` (`idProducto`),
  CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes`
--

LOCK TABLES `imagenes` WRITE;
/*!40000 ALTER TABLE `imagenes` DISABLE KEYS */;
INSERT INTO `imagenes` VALUES (1,28,'../imagenes/acer1.jpg'),(2,28,'../imagenes/acer2.jpg'),(3,28,'../imagenes/acer3.jpg'),(4,29,'../imagenes/1111.jpg'),(5,29,'../imagenes/1112.jpg'),(6,29,'../imagenes/1113.jpg'),(13,1,'../imagenes/acer1.jpg'),(14,1,'../imagenes/acer2.jpg'),(15,1,'../imagenes/acer3.jpg'),(16,2,'../imagenes/1111.jpg'),(17,2,'../imagenes/1112.jpg'),(18,2,'../imagenes/1113.jpg'),(19,3,'../imagenes/lenovo.jpg'),(20,3,'../imagenes/lenovo2.jpg'),(21,3,'../imagenes/lenovo3.jpg'),(22,4,'../imagenes/msi.jpg'),(23,4,'../imagenes/msi2.jpg'),(24,4,'../imagenes/msi3.jpg'),(25,5,'../imagenes/1.jpg'),(26,5,'../imagenes/2.jpg'),(27,6,'../imagenes/3.jpg'),(28,6,'../imagenes/4.jpg'),(29,7,'../imagenes/a1.jpg'),(30,7,'../imagenes/a3.jpg'),(31,7,'../imagenes/a4.jpg'),(32,8,'../imagenes/f1.jpg'),(33,8,'../imagenes/f2.jpg'),(34,8,'../imagenes/f3.jpg'),(35,9,'../imagenes/huawei-p8-lite-negro-libre.jpg'),(36,9,'../imagenes/huawei-p8-lite-negro-libre-2.jpg'),(37,9,'../imagenes/huawei-p8-lite-negro-libre-4.jpg'),(38,10,'../imagenes/samsung-j3-4g-blanco-libre.jpg'),(39,10,'../imagenes/samsung-j3-4g-blanco-libre-1.jpg'),(40,10,'../imagenes/samsung-j3-4g-blanco-libre-2.jpg'),(41,11,'../imagenes/1.jpg'),(42,11,'../imagenes/2.jpg'),(43,11,'../imagenes/3.jpg'),(44,12,'../imagenes/a01.jpg'),(45,12,'../imagenes/a02.jpg'),(46,12,'../imagenes/a04.jpg');
/*!40000 ALTER TABLE `imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` char(100) DEFAULT NULL,
  `continente` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Aruba','North America'),(2,'Afghanistan','Asia'),(3,'Angola','Africa'),(4,'Anguilla','North America'),(5,'Albania','Europe'),(6,'Andorra','Europe'),(7,'Netherlands Antilles','North America'),(8,'United Arab Emirates','Asia'),(9,'Argentina','South America'),(10,'Armenia','Asia'),(11,'American Samoa','Oceania'),(12,'Antarctica','Antarctica'),(13,'French Southern territories','Antarctica'),(14,'Antigua and Barbuda','North America'),(15,'Australia','Oceania'),(16,'Austria','Europe'),(17,'Azerbaijan','Asia'),(18,'Burundi','Africa'),(19,'Belgium','Europe'),(20,'Benin','Africa'),(21,'Burkina Faso','Africa'),(22,'Bangladesh','Asia'),(23,'Bulgaria','Europe'),(24,'Bahrain','Asia'),(25,'Bahamas','North America'),(26,'Bosnia and Herzegovina','Europe'),(27,'Belarus','Europe'),(28,'Belize','North America'),(29,'Bermuda','North America'),(30,'Bolivia','South America'),(31,'Brazil','South America'),(32,'Barbados','North America'),(33,'Brunei','Asia'),(34,'Bhutan','Asia'),(35,'Bouvet Island','Antarctica'),(36,'Botswana','Africa'),(37,'Central African Republic','Africa'),(38,'Canada','North America'),(39,'Cocos (Keeling) Islands','Oceania'),(40,'Switzerland','Europe'),(41,'Chile','South America'),(42,'China','Asia'),(43,'Côte d’Ivoire','Africa'),(44,'Cameroon','Africa'),(45,'Congo, The Democratic Republic of the','Africa'),(46,'Congo','Africa'),(47,'Cook Islands','Oceania'),(48,'Colombia','South America'),(49,'Comoros','Africa'),(50,'Cape Verde','Africa'),(51,'Costa Rica','North America'),(52,'Cuba','North America'),(53,'Christmas Island','Oceania'),(54,'Cayman Islands','North America'),(55,'Cyprus','Asia'),(56,'Czech Republic','Europe'),(57,'Germany','Europe'),(58,'Djibouti','Africa'),(59,'Dominica','North America'),(60,'Denmark','Europe'),(61,'Dominican Republic','North America'),(62,'Algeria','Africa'),(63,'Ecuador','South America'),(64,'Egypt','Africa'),(65,'Eritrea','Africa'),(66,'Western Sahara','Africa'),(67,'Spain','Europe'),(68,'Estonia','Europe'),(69,'Ethiopia','Africa'),(70,'Finland','Europe'),(71,'Fiji Islands','Oceania'),(72,'Falkland Islands','South America'),(73,'France','Europe'),(74,'Faroe Islands','Europe'),(75,'Micronesia, Federated States of','Oceania'),(76,'Gabon','Africa'),(77,'United Kingdom','Europe'),(78,'Georgia','Asia'),(79,'Ghana','Africa'),(80,'Gibraltar','Europe'),(81,'Guinea','Africa'),(82,'Guadeloupe','North America'),(83,'Gambia','Africa'),(84,'Guinea-Bissau','Africa'),(85,'Equatorial Guinea','Africa'),(86,'Greece','Europe'),(87,'Grenada','North America'),(88,'Greenland','North America'),(89,'Guatemala','North America'),(90,'French Guiana','South America'),(91,'Guam','Oceania'),(92,'Guyana','South America'),(93,'Hong Kong','Asia'),(94,'Heard Island and McDonald Islands','Antarctica'),(95,'Honduras','North America'),(96,'Croatia','Europe'),(97,'Haiti','North America'),(98,'Hungary','Europe'),(99,'Indonesia','Asia'),(100,'India','Asia'),(101,'British Indian Ocean Territory','Africa'),(102,'Ireland','Europe'),(103,'Iran','Asia'),(104,'Iraq','Asia'),(105,'Iceland','Europe'),(106,'Israel','Asia'),(107,'Italy','Europe'),(108,'Jamaica','North America'),(109,'Jordan','Asia'),(110,'Japan','Asia'),(111,'Kazakstan','Asia'),(112,'Kenya','Africa'),(113,'Kyrgyzstan','Asia'),(114,'Cambodia','Asia'),(115,'Kiribati','Oceania'),(116,'Saint Kitts and Nevis','North America'),(117,'South Korea','Asia'),(118,'Kuwait','Asia'),(119,'Laos','Asia'),(120,'Lebanon','Asia'),(121,'Liberia','Africa'),(122,'Libyan Arab Jamahiriya','Africa'),(123,'Saint Lucia','North America'),(124,'Liechtenstein','Europe'),(125,'Sri Lanka','Asia'),(126,'Lesotho','Africa'),(127,'Lithuania','Europe'),(128,'Luxembourg','Europe'),(129,'Latvia','Europe'),(130,'Macao','Asia'),(131,'Morocco','Africa'),(132,'Monaco','Europe'),(133,'Moldova','Europe'),(134,'Madagascar','Africa'),(135,'Maldives','Asia'),(136,'Mexico','North America'),(137,'Marshall Islands','Oceania'),(138,'Macedonia','Europe'),(139,'Mali','Africa'),(140,'Malta','Europe'),(141,'Myanmar','Asia'),(142,'Mongolia','Asia'),(143,'Northern Mariana Islands','Oceania'),(144,'Mozambique','Africa'),(145,'Mauritania','Africa'),(146,'Montserrat','North America'),(147,'Martinique','North America'),(148,'Mauritius','Africa'),(149,'Malawi','Africa'),(150,'Malaysia','Asia'),(151,'Mayotte','Africa'),(152,'Namibia','Africa'),(153,'New Caledonia','Oceania'),(154,'Niger','Africa'),(155,'Norfolk Island','Oceania'),(156,'Nigeria','Africa'),(157,'Nicaragua','North America'),(158,'Niue','Oceania'),(159,'Netherlands','Europe'),(160,'Norway','Europe'),(161,'Nepal','Asia'),(162,'Nauru','Oceania'),(163,'New Zealand','Oceania'),(164,'Oman','Asia'),(165,'Pakistan','Asia'),(166,'Panama','North America'),(167,'Pitcairn','Oceania'),(168,'Peru','South America'),(169,'Philippines','Asia'),(170,'Palau','Oceania'),(171,'Papua New Guinea','Oceania'),(172,'Poland','Europe'),(173,'Puerto Rico','North America'),(174,'North Korea','Asia'),(175,'Portugal','Europe'),(176,'Paraguay','South America'),(177,'Palestine','Asia'),(178,'French Polynesia','Oceania'),(179,'Qatar','Asia'),(180,'Réunion','Africa'),(181,'Romania','Europe'),(182,'Russian Federation','Europe'),(183,'Rwanda','Africa'),(184,'Saudi Arabia','Asia'),(185,'Sudan','Africa'),(186,'Senegal','Africa'),(187,'Singapore','Asia'),(188,'South Georgia and the South Sandwich Islands','Antarctica'),(189,'Saint Helena','Africa'),(190,'Svalbard and Jan Mayen','Europe'),(191,'Solomon Islands','Oceania'),(192,'Sierra Leone','Africa'),(193,'El Salvador','North America'),(194,'San Marino','Europe'),(195,'Somalia','Africa'),(196,'Saint Pierre and Miquelon','North America'),(197,'Sao Tome and Principe','Africa'),(198,'Suriname','South America'),(199,'Slovakia','Europe'),(200,'Slovenia','Europe'),(201,'Sweden','Europe'),(202,'Swaziland','Africa'),(203,'Seychelles','Africa'),(204,'Syria','Asia'),(205,'Turks and Caicos Islands','North America'),(206,'Chad','Africa'),(207,'Togo','Africa'),(208,'Thailand','Asia'),(209,'Tajikistan','Asia'),(210,'Tokelau','Oceania'),(211,'Turkmenistan','Asia'),(212,'East Timor','Asia'),(213,'Tonga','Oceania'),(214,'Trinidad and Tobago','North America'),(215,'Tunisia','Africa'),(216,'Turkey','Asia'),(217,'Tuvalu','Oceania'),(218,'Taiwan','Asia'),(219,'Tanzania','Africa'),(220,'Uganda','Africa'),(221,'Ukraine','Europe'),(222,'United States Minor Outlying Islands','Oceania'),(223,'Uruguay','South America'),(224,'United States','North America'),(225,'Uzbekistan','Asia'),(226,'Holy See (Vatican City State)','Europe'),(227,'Saint Vincent and the Grenadines','North America'),(228,'Venezuela','South America'),(229,'Virgin Islands, British','North America'),(230,'Virgin Islands, U.S.','North America'),(231,'Vietnam','Asia'),(232,'Vanuatu','Oceania'),(233,'Wallis and Futuna','Oceania'),(234,'Samoa','Oceania'),(235,'Yemen','Asia'),(236,'Yugoslavia','Europe'),(237,'South Africa','Africa'),(238,'Zambia','Africa'),(239,'Zimbabwe','Africa'),(240,'Default','Europe');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `fechaPedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `importeTotal` int(11) NOT NULL,
  `nombre_envio` char(30) NOT NULL,
  `apellidos_envio` char(80) NOT NULL,
  `ndocumento_envio` char(9) NOT NULL,
  `pais_envio` int(11) NOT NULL,
  `provincia_envio` char(50) NOT NULL,
  `ciudad_envio` char(50) NOT NULL,
  `codigopostal_envio` int(5) NOT NULL,
  `direccion_envio` char(200) DEFAULT NULL,
  `estado` enum('En proceso','Enviado','Entregado') DEFAULT 'En proceso',
  PRIMARY KEY (`idPedido`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,1,'2017-03-01 03:50:31',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(2,1,'2017-03-02 03:50:35',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(3,1,'2017-03-03 03:50:36',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(4,1,'2017-03-04 03:50:36',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(5,1,'2017-03-05 05:05:05',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(6,1,'2017-03-06 03:50:37',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(7,1,'2017-03-06 03:50:37',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(8,1,'2017-03-06 03:50:38',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(9,1,'2017-03-07 03:50:38',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(10,1,'2017-03-08 03:50:38',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(11,1,'2017-03-09 03:50:39',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(12,1,'2017-03-10 03:50:39',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(13,1,'2017-03-11 03:50:39',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(14,1,'2017-03-12 03:50:39',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(15,1,'2017-03-13 03:50:40',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(16,1,'2017-03-14 03:50:40',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(17,1,'2017-03-15 03:50:40',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(18,1,'2017-03-16 03:50:40',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(19,1,'2017-03-17 03:50:41',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(20,1,'2017-03-18 03:50:41',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(21,1,'2017-03-19 03:50:41',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(22,1,'2017-03-20 03:50:41',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(23,1,'2017-03-21 03:50:42',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(24,1,'2017-03-22 03:50:42',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(25,1,'2017-03-23 03:50:42',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(26,1,'2017-03-24 03:50:42',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(27,1,'2017-03-25 03:50:43',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(28,1,'2017-03-26 03:50:43',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(29,1,'2017-03-27 03:50:43',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(30,1,'2017-03-28 03:50:43',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(31,1,'2017-03-29 03:50:44',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(32,1,'2017-03-30 03:50:44',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(33,1,'2017-03-31 03:50:44',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(34,1,'2017-03-01 03:50:45',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(35,1,'2017-03-01 03:50:45',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(36,1,'2017-03-15 03:50:45',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(37,1,'2017-03-15 03:50:45',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(38,1,'2017-03-15 03:50:46',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(39,1,'2017-03-15 03:50:46',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(40,1,'2017-03-15 03:50:46',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(41,1,'2017-03-15 03:50:46',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(42,1,'2017-03-15 03:50:47',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(43,1,'2017-03-18 03:50:47',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(44,1,'2017-03-10 03:50:47',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(45,1,'2017-03-10 03:50:47',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(46,1,'2017-03-23 03:50:48',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(47,1,'2017-03-23 03:50:48',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(48,1,'2017-03-23 03:50:48',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(49,1,'2017-03-23 03:50:48',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(50,1,'2017-03-23 03:50:49',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(51,1,'2017-03-23 03:50:49',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(52,1,'2017-03-23 03:50:49',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(53,1,'2017-03-23 03:50:49',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(54,1,'2017-03-30 03:50:50',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(55,1,'2017-03-23 03:50:50',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(56,1,'2017-03-23 03:50:50',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(57,1,'2017-03-23 03:50:50',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(58,1,'2017-03-23 03:50:51',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(59,1,'2017-03-23 03:50:51',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(60,1,'2017-03-23 03:50:51',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(61,1,'2017-03-10 03:50:51',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(62,1,'2017-03-10 03:50:51',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(63,1,'2017-03-10 03:50:52',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(64,1,'2017-03-10 03:50:52',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(65,1,'2017-03-23 03:50:52',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(66,1,'2017-03-23 03:50:52',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(67,1,'2017-03-10 03:50:53',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(68,1,'2017-03-10 03:50:54',730,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(100) NOT NULL,
  `marca` char(50) NOT NULL,
  `categoria` char(50) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` char(255) DEFAULT NULL,
  `f_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `f_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visitas` int(11) DEFAULT '0',
  PRIMARY KEY (`id_producto`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`nombre`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(30) NOT NULL,
  `apellidos` char(80) DEFAULT NULL,
  `ndocumento` char(9) DEFAULT NULL,
  `email` char(80) NOT NULL,
  `fotoUsuario` char(100) NOT NULL DEFAULT '../imagenes/sinfoto.jpg',
  `pais` int(11) DEFAULT NULL,
  `provincia` char(50) DEFAULT NULL,
  `ciudad` char(50) DEFAULT NULL,
  `codigopostal` int(5) DEFAULT NULL,
  `direccion` char(200) DEFAULT NULL,
  `clave` char(100) NOT NULL,
  `nombre_envio` char(30) DEFAULT NULL,
  `apellidos_envio` char(80) DEFAULT NULL,
  `ndocumento_envio` char(9) DEFAULT NULL,
  `pais_envio` int(11) DEFAULT NULL,
  `provincia_envio` char(50) DEFAULT NULL,
  `ciudad_envio` char(50) DEFAULT NULL,
  `codigopostal_envio` int(5) DEFAULT NULL,
  `direccion_envio` char(200) DEFAULT NULL,
  `tipoUsuario` enum('Usuario','Administrador','Superadministrador') NOT NULL,
  `fechaAlta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nEntradas` int(11) NOT NULL DEFAULT '0',
  `nErrores` int(11) NOT NULL DEFAULT '0',
  `ultimaVisita` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0',
  `superadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  KEY `pais` (`pais`),
  KEY `pais_envio` (`pais_envio`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `paises` (`id_pais`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`pais_envio`) REFERENCES `paises` (`id_pais`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Admin','Admin','12345678X','admin@proyecto.com','../imagenes/sinfoto.jpg',67,'Murcia','Murcia',12345,'Direccion','$2y$10$MTIzNDU2Nzg5c2FseXBpbOY7pjqFXEOrD9QBW3gTjlGuZmruTPl4a','Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','Administrador','2017-03-06 13:56:12',9,0,'2017-03-10 13:29:17',0,1),(2,'Anthony','Pogo','49791100X','anthony1997@hotmail.es','../imagenes/sinfoto.jpg',67,'Murcia','Cartagena',30870,'Capitanes Ripoll','$2y$10$MTIzNDU2Nzg5c2FseXBpbOY7pjqFXEOrD9QBW3gTjlGuZmruTPl4a','Anthony','Pogo','49791100X',67,'Murcia','Cartagena',30870,'Capitanes Ripoll','Administrador','2017-03-06 13:56:12',8,0,'2017-03-09 20:52:02',0,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-10 13:31:42
