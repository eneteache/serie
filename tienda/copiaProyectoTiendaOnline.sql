CREATE DATABASE  IF NOT EXISTS `proyecto` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `proyecto`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
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
INSERT INTO `categorias` VALUES (1,'Portatiles',0),(2,'Smartphones',0);
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
INSERT INTO `detallespedidos` VALUES (1,1,2,725),(1,2,1,999),(2,1,3,725),(2,2,1,999),(3,1,3,725),(3,2,1,999),(3,4,1,1200),(4,1,3,520);
/*!40000 ALTER TABLE `detallespedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id_factura` int(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `importe_total` int(11) NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes`
--

LOCK TABLES `imagenes` WRITE;
/*!40000 ALTER TABLE `imagenes` DISABLE KEYS */;
INSERT INTO `imagenes` VALUES (1,1,'../imagenes/lenovo.jpg'),(2,1,'../imagenes/lenovo2.jpg'),(3,1,'../imagenes/lenovo3.jpg'),(4,2,'../imagenes/msi.jpg'),(5,2,'../imagenes/msi2.jpg'),(6,2,'../imagenes/msi3.jpg'),(7,3,'../imagenes/a01.jpg'),(8,3,'../imagenes/a02.jpg'),(9,3,'../imagenes/a04.jpg'),(10,4,'../imagenes/3.jpg'),(11,4,'../imagenes/4.jpg');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,1,'2017-03-10 19:11:38',2449,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(2,1,'2017-03-10 19:13:40',3174,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(3,1,'2017-03-10 19:14:16',4374,'Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','En proceso'),(4,3,'2017-03-10 19:54:10',1560,'Anthon','Pogo','12345678X',67,'Murcia','Cartagena',12345,'Direccion','En proceso');
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
  `url` char(255) NOT NULL,
  `visitas` int(11) DEFAULT '0',
  PRIMARY KEY (`id_producto`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`nombre`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Lenovo IdeaPad 100S-14IBR Intel Celeron N30502GB64GB SSD14','Lenovo','Portatiles',520,'Portatil con SSD barato con 14\" de pantalla','2017-03-10 18:53:40','2017-03-10 18:53:40','../imagenes/lenovo.jpg',0),(2,'MSI GL62M 7RD-429XES Intel Core i7-7700HQ8GB1TB+256SSDGTX105015.6','MSI','Portatiles',999,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vulputate risus sed justo maximus, at rutrum arcu placerat.','2017-03-10 18:54:02','2017-03-10 18:54:02','../imagenes/msi.jpg',0),(3,'ZTE Blade L5 Gris Libre','ZTE','Smartphones',120,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vulputate risus sed justo maximus, at rutrum arcu placerat.','2017-03-10 18:54:36','2017-03-10 18:54:36','../imagenes/a01.jpg',0),(4,'Apple iPhone 7 Plus 256GB Dorado Rosa Libre','Apple','Smartphones',1200,'Smartphone de la marca Apple con capacidad de 256 GB en color rosa','2017-03-10 18:55:18','2017-03-10 18:55:18','../imagenes/3.jpg',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Admin','Admin','12345678X','admin@proyecto.com','../imagenes/sinfoto.jpg',67,'Murcia','Murcia',12345,'Direccion','$2y$10$MTIzNDU2Nzg5c2FseXBpbOY7pjqFXEOrD9QBW3gTjlGuZmruTPl4a','Admin','Admin','12345678X',67,'Murcia','Murcia',12345,'Direccion','Administrador','2017-03-06 13:56:12',14,0,'2017-03-10 23:07:25',0,1),(2,'Anthony','Pogo','49791100X','anthony1997@hotmail.es','../imagenes/sinfoto.jpg',67,'Murcia','Cartagena',30870,'Capitanes Ripoll','$2y$10$MTIzNDU2Nzg5c2FseXBpbOY7pjqFXEOrD9QBW3gTjlGuZmruTPl4a','Anthony','Pogo','49791100X',67,'Murcia','Cartagena',30870,'Capitanes Ripoll','Administrador','2017-03-06 13:56:12',9,0,'2017-03-11 01:43:09',0,0),(3,'Anthon','Pogo','12345678X','anthony1997@correo.com','../imagenes/sinfoto.jpg',67,'Murcia','Cartagena',12345,'Direccion','$2y$10$MTIzNDU2Nzg5c2FseXBpbOY7pjqFXEOrD9QBW3gTjlGuZmruTPl4a','Anthon','Pogo','12345678X',67,'Murcia','Cartagena',12345,'Direccion','Usuario','2017-03-10 19:52:03',2,0,'2017-03-10 23:10:23',0,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `fecha` char(10) NOT NULL,
  `url` text NOT NULL,
  `visitas` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES (1,'2017-03-10','http://localhost/producto.php?id=1',5),(4,'2017-03-11','http://localhost/producto.php?id=1',3),(5,'2017-03-11','http://localhost/producto.php?id=6',1),(6,'2017-03-11','http://localhost/producto.php?id=2',2),(7,'2017-03-11','http://localhost/producto.php?id=4',1),(8,'2017-03-11','http://localhost/producto.php?id=3',1);
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'proyecto'
--

--
-- Dumping routines for database 'proyecto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-11  2:07:29
