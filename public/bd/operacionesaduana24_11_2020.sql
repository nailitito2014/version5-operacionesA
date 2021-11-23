-- MySQL dump 10.17  Distrib 10.3.16-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: operacionesaduana
-- ------------------------------------------------------
-- Server version	10.3.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `base_datos`
--

DROP TABLE IF EXISTS `base_datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `base_datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servidor_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `base_datos`
--

LOCK TABLES `base_datos` WRITE;
/*!40000 ALTER TABLE `base_datos` DISABLE KEYS */;
/*!40000 ALTER TABLE `base_datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buque`
--

DROP TABLE IF EXISTS `buque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puerto_salida_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_viaje` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4392999DB805CBAF` (`puerto_salida_id`),
  CONSTRAINT `FK_4392999DB805CBAF` FOREIGN KEY (`puerto_salida_id`) REFERENCES `puerto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buque`
--

LOCK TABLES `buque` WRITE;
/*!40000 ALTER TABLE `buque` DISABLE KEYS */;
INSERT INTO `buque` VALUES (1,1,'Buque 1','1234','2020-11-15 16:47:45','2020-11-15'),(2,1,'Buque 2','3456','2020-11-15 16:47:57','2020-11-15');
/*!40000 ALTER TABLE `buque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_cliente`
--

DROP TABLE IF EXISTS `categoria_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_insercion` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_cliente`
--

LOCK TABLES `categoria_cliente` WRITE;
/*!40000 ALTER TABLE `categoria_cliente` DISABLE KEYS */;
INSERT INTO `categoria_cliente` VALUES (1,'Diplomatico','2020-11-13 22:21:49','2020-11-13'),(2,'Residente temporal','2020-11-13 22:23:02','2020-11-13');
/*!40000 ALTER TABLE `categoria_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primer_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_certifico_inmigracion` date NOT NULL,
  `carnet_identidad` bigint(20) NOT NULL,
  `pasaporte` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_insercion` date DEFAULT NULL,
  `categoria_cliente_id` int(11) DEFAULT NULL,
  `fecha_vencimiento_certifico_inmigracion` date DEFAULT NULL,
  `cliente_activo` tinyint(1) DEFAULT NULL,
  `fecha_desactivacion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F41C9B25C604D5C6` (`pais_id`),
  KEY `IDX_F41C9B2543BCBF82` (`categoria_cliente_id`),
  CONSTRAINT `FK_F41C9B2543BCBF82` FOREIGN KEY (`categoria_cliente_id`) REFERENCES `categoria_cliente` (`id`),
  CONSTRAINT `FK_F41C9B25C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,1,'AAA','AAA','AA','2020-11-13',7656567875,'I12344','2020-11-13 22:43:33','2020-11-13',1,'0000-00-00',NULL,'0000-00-00'),(2,1,'Alberto','Alvarez','Matias','2020-11-15',2312342312,'123','2020-11-15 16:48:33','2020-11-15',1,'2021-05-15',NULL,'0000-00-00'),(3,1,'qwww','aa','ss','2020-11-03',12121212111,'12121212121','2020-11-21 23:34:02','2020-11-21',1,'2020-11-11',1,'2020-11-23');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condicion_compra`
--

DROP TABLE IF EXISTS `condicion_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condicion_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condicion_compra`
--

LOCK TABLES `condicion_compra` WRITE;
/*!40000 ALTER TABLE `condicion_compra` DISABLE KEYS */;
INSERT INTO `condicion_compra` VALUES (1,'Condicion de compra 1','2020-11-14 01:06:59','2020-11-14'),(2,'Condicion de compra 2','2020-11-14 01:07:10','2020-11-14'),(3,'Condicion de compra 3','2020-11-14 01:07:20','2020-11-14');
/*!40000 ALTER TABLE `condicion_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenedor`
--

DROP TABLE IF EXISTS `contenedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cant_menajes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colaboradores` int(11) NOT NULL,
  `cant_bultos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kg_carga` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_envio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cant_ena` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mbl` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  `numero_contenedor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buque_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E6B58BB12D082DEB` (`buque_id`),
  CONSTRAINT `FK_E6B58BB12D082DEB` FOREIGN KEY (`buque_id`) REFERENCES `buque` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenedor`
--

LOCK TABLES `contenedor` WRITE;
/*!40000 ALTER TABLE `contenedor` DISABLE KEYS */;
INSERT INTO `contenedor` VALUES (1,'2',2,'2','12','2','2','12','2020-11-15 17:00:38','2020-11-15','kj765',NULL),(2,'3',3,'3','3','3','3','3','2020-11-15 17:00:48','2020-11-15','5678',NULL),(3,'12qw',2,'12qw','12qw','12qw','2','12qw','2020-11-15 18:42:26','2020-11-15','12qw',NULL),(4,'12qw',2,'12qw','12qw','12qw','2','12qw','2020-11-15 18:47:52','2020-11-15','18qw',NULL),(5,'12qw',2,'12qw','12qw','12qw','2','12qw','2020-11-15 18:49:30','2020-11-15','187qw',NULL),(6,'78',6,'78','98','8','8','89','2020-11-24 16:37:47','2020-11-24','567',1);
/*!40000 ALTER TABLE `contenedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_contrato_id` int(11) DEFAULT NULL,
  `numero_contrato` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `titular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_66696523458A5509` (`tipo_contrato_id`),
  CONSTRAINT `FK_66696523458A5509` FOREIGN KEY (`tipo_contrato_id`) REFERENCES `tipo_contrato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato`
--

LOCK TABLES `contrato` WRITE;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
INSERT INTO `contrato` VALUES (1,1,1234,'2020-11-15','qwwww','2020-11-15 22:14:59','2020-11-15'),(2,2,3456,'2020-11-13','gfgf','2020-11-15 22:15:11','2020-11-15'),(3,1,111,'2020-11-15','popo','2020-11-23 02:42:39','2020-11-23'),(4,1,1123,'2020-11-15','Eduardo','2020-11-23 02:48:34','2020-11-23');
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desglose_manifiesto`
--

DROP TABLE IF EXISTS `desglose_manifiesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desglose_manifiesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenedor_id` int(11) DEFAULT NULL,
  `numero_desglose_manifiesto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_mbl` int(11) NOT NULL,
  `numero_viaje` int(11) NOT NULL,
  `aduaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `multa` tinyint(1) NOT NULL,
  `fecha_arribo_buque` date NOT NULL,
  `fecha_recibo_manifiesto` date NOT NULL,
  `fecha_desglose_manifiesto` date NOT NULL,
  `coment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_notificacion_multa` date NOT NULL,
  `fecha_recibida_multa` date NOT NULL,
  `numero_multa` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1B90AB8BC1A15772` (`contenedor_id`),
  CONSTRAINT `FK_1B90AB8BC1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desglose_manifiesto`
--

LOCK TABLES `desglose_manifiesto` WRITE;
/*!40000 ALTER TABLE `desglose_manifiesto` DISABLE KEYS */;
INSERT INTO `desglose_manifiesto` VALUES (1,1,'123',123,123,'qwqw',1,'2020-11-16','2020-11-04','2020-11-19','qwqw','2020-11-11','2020-11-13',2345,'2020-11-16 18:57:16','2020-11-16'),(2,2,'6789',9090,4567,'hfhfhf',0,'2020-11-03','2020-11-05','2020-11-07','mnvbvbn','2020-11-08','2020-11-10',NULL,'2020-11-16 18:58:18','2020-11-16'),(4,1,'dmfto_04_2020',44,444,'tttt',1,'2020-10-27','2020-11-05','2020-11-18','tttt','2020-11-25','2020-11-18',4444,'2020-11-22 00:15:01','2020-11-22');
/*!40000 ALTER TABLE `desglose_manifiesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_servicio`
--

DROP TABLE IF EXISTS `estado_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_servicio`
--

LOCK TABLES `estado_servicio` WRITE;
/*!40000 ALTER TABLE `estado_servicio` DISABLE KEYS */;
INSERT INTO `estado_servicio` VALUES (1,'Iniciado','2020-11-15 16:38:24','2020-11-15'),(2,'Completado','2020-11-15 16:38:31','2020-11-15'),(3,'Terminado','2020-11-15 16:45:27','2020-11-15');
/*!40000 ALTER TABLE `estado_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expediente`
--

DROP TABLE IF EXISTS `expediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expediente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naviera_id` int(11) DEFAULT NULL,
  `contenedor_id` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  `desglose_manifiesto_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primer_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bultos` int(11) NOT NULL,
  `numero_expediente` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso_kg` double NOT NULL,
  `pies` double NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  `fecha_creacion_expediente` date NOT NULL,
  `numero_mbl` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_despacho` date NOT NULL,
  `recibido_aduana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entregado_agencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_arribo` date NOT NULL,
  `telefono_fijo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_movil` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notas` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `importacion_cubano_id` int(11) DEFAULT NULL,
  `numero_manifiesto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificoInmigracion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `franquiciaDiplomatica` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cartaOriginal` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desglose` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manifiesto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_entregado_deposito` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D59CA413D21CF971` (`naviera_id`),
  KEY `IDX_D59CA413C1A15772` (`contenedor_id`),
  KEY `IDX_D59CA413C604D5C6` (`pais_id`),
  KEY `IDX_D59CA4134E7121AF` (`provincia_id`),
  KEY `IDX_D59CA41336DDC72C` (`desglose_manifiesto_id`),
  KEY `IDX_D59CA413C3095BEE` (`importacion_cubano_id`),
  CONSTRAINT `FK_D59CA41336DDC72C` FOREIGN KEY (`desglose_manifiesto_id`) REFERENCES `desglose_manifiesto` (`id`),
  CONSTRAINT `FK_D59CA4134E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`),
  CONSTRAINT `FK_D59CA413C1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`),
  CONSTRAINT `FK_D59CA413C3095BEE` FOREIGN KEY (`importacion_cubano_id`) REFERENCES `importa_cubano` (`id`),
  CONSTRAINT `FK_D59CA413C604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`),
  CONSTRAINT `FK_D59CA413D21CF971` FOREIGN KEY (`naviera_id`) REFERENCES `naviera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expediente`
--

LOCK TABLES `expediente` WRITE;
/*!40000 ALTER TABLE `expediente` DISABLE KEYS */;
INSERT INTO `expediente` VALUES (1,1,1,1,1,1,'aaaa','aaaa','aaaa',111,'exp_0120',12,12,'2020-11-16 22:28:42','2020-11-16','2020-11-13','111','2020-11-16','22111','1111','2020-11-05','2020-10-29','1111','1111','aaasss',1,NULL,'','','','','',NULL),(2,1,1,1,1,1,'rrr','rrr','rrr',333,'exp_0002_20',4,4,'2020-11-16 22:30:39','2020-11-16','2020-11-13','333','2020-11-10','erre','errr','2020-11-11','2020-11-12','3333','3333','popoo',1,NULL,'','','','','',NULL),(3,1,1,2,1,2,'www','www','www',2,'exp_03_2020',3,3,'2020-11-16 22:31:43','2020-11-16','2020-11-26','2','2020-11-11','qqq','qqq','2020-11-03','2020-10-30','222','222','eeee',1,NULL,'','','','','',NULL),(4,1,2,1,1,NULL,'w','w','w',2,'exp_04_2020',2,2,'2020-11-18 05:06:28','2020-11-18','2020-11-03','2','2020-10-27','qwer','qwe','2020-11-10','2020-11-03',NULL,NULL,'ff',NULL,'12','16056723882189.docx',NULL,NULL,NULL,NULL,NULL),(5,1,1,1,1,NULL,'www','www','www',22,'exp_05_2020',3,3,'2020-11-18 05:12:34','2020-11-18','2020-11-11','22','2020-11-11','eggg','wwww','2020-11-12','2020-11-11',NULL,NULL,'dddd',NULL,'www','16056727541741.png',NULL,NULL,NULL,NULL,NULL),(6,1,1,1,1,NULL,'Eduardo','Lopez','Garcia',5,'exp_06_2020',4,3,'2020-11-20 02:36:43','2020-11-20','2020-11-06','23','2020-11-20','ernesto','raul','2020-11-18','2020-11-19',NULL,NULL,'rtttt',NULL,'2345','16058362034742.docx',NULL,NULL,NULL,NULL,NULL),(7,1,2,2,2,NULL,'ttt','ttt','ttt',4,'exp_07_2020',5,5,'2020-11-20 02:37:42','2020-11-20','2020-11-13','34','2020-11-05','tyyy','ttt','2020-11-06','2020-11-07',NULL,NULL,'yyyy',NULL,'45','16058362623094.docx',NULL,NULL,NULL,NULL,NULL),(8,3,3,2,1,NULL,'yyy','yyy','yyy',4,'exp_08_2020',6,6,'2020-11-20 02:40:31','2020-11-20','2020-11-09','4','2020-11-05','ernesto','raudel','2020-11-06','2020-11-08',NULL,NULL,'tytt',NULL,'67','16058364307723.docx',NULL,NULL,NULL,NULL,NULL),(9,2,3,1,2,NULL,'yu','yu','yu',6,'exp_09_2020',7,7,'2020-11-20 02:41:37','2020-11-20','2020-11-19','6','2020-11-12','yyyy','yyyy','2020-11-13','2020-11-07',NULL,NULL,'uuu',NULL,'555','16058364972607.png',NULL,NULL,NULL,NULL,NULL),(10,1,2,1,1,NULL,'rrr','rrr','rrr',2,'exp_10_2020',5,5,'2020-11-20 03:29:51','2020-11-20','2020-10-29','2','2020-11-20','qw','qwe','2020-11-12','2020-11-21',NULL,NULL,'rrrrr',NULL,'123','16058393912038.docx',NULL,NULL,NULL,NULL,NULL),(11,1,2,1,1,NULL,'ddd','ddd','dddd',3,'exp_11_2020',5,4,'2020-11-20 16:40:20','2020-11-20','2020-11-20','6','2020-11-20','rrr','rrrr','2020-11-21','2020-11-19',NULL,NULL,'rrrr',NULL,'333','.docx',NULL,NULL,NULL,NULL,NULL),(12,1,2,2,1,NULL,'ttt','tttt','tttt',3,'exp_12_2020',5,4,'2020-11-20 17:39:45','2020-11-20','2020-11-20','4','2020-11-06','eeee','eeeee','2020-11-07','2020-11-08',NULL,NULL,'eeee',NULL,'3','exp_12_2020.png',NULL,NULL,NULL,NULL,NULL),(13,1,1,1,1,NULL,'www','www','www',333,'exp_13_2020',3,3,'2020-11-20 18:34:41','2020-11-20','2020-11-20','3','2020-11-19','www','www','2020-11-13','2020-11-24',NULL,NULL,'wwww',NULL,'3','exp_13_2020.docx',NULL,NULL,NULL,NULL,NULL),(14,1,1,1,1,NULL,'ee','eee','ee',3,'exp_14_2020',4,3,'2020-11-20 18:53:39','2020-11-20','2020-11-20','4','2020-11-12','ee','eee','2020-11-13','2020-11-21',NULL,NULL,'eee',NULL,'2','exp_14_2020_CertificoInmigracion.docx',NULL,NULL,NULL,NULL,NULL),(15,1,1,1,1,NULL,'ww','ww','ww',3,'exp_15_2020',3,3,'2020-11-20 21:49:24','2020-11-20','2020-11-20','4','2020-11-19','ee','ee','2020-11-21','2020-11-25',NULL,NULL,'ee',NULL,'2','exp_15_2020_CertificoInmigracion.png',NULL,NULL,NULL,NULL,NULL),(16,1,1,1,1,NULL,'q','q','q',3,'exp_16_2020',3,3,'2020-11-20 21:53:00','2020-11-20','2020-11-20','12','2020-10-28','ee','ee','2020-11-06','2020-11-21',NULL,NULL,'wwww',NULL,'2','exp_16_2020_CertificoInmigracion.docx',NULL,NULL,NULL,NULL,NULL),(17,1,1,1,1,NULL,'qq','qq','qq',333,'exp_17_2020',3,3,'2020-11-20 23:23:06','2020-11-20','2020-11-20','111','2020-11-12','qq','qq','2020-11-13','2020-11-21',NULL,NULL,'qqq',NULL,'qq','exp_17_2020_CertificoInmigracion.docx','exp_17_202',NULL,'exp_17_2020_Desglose.png','exp_17_2020_Manifiesto.png',NULL),(18,1,1,1,1,NULL,'ee','ee','ee',23,'exp_18_2020',23,23,'2020-11-20 23:25:54','2020-11-20','2020-11-20','333','2020-11-12','eee','ee','2020-11-12','2020-11-10',NULL,NULL,'ssss',NULL,'ee','exp_18_2020_CertificoInmigracion.docx','exp_18_202','exp_18_2020_CartaOriginal.png','exp_18_2020_Desglose.png','exp_18_2020_Manifiesto.png',NULL),(19,1,1,1,1,NULL,'rrr','rrr','rrr',44,'exp_19_2020',44,444,'2020-11-20 23:48:08','2020-11-20','2020-11-20','44','2020-10-28','eeee','eeee','2020-11-05','2020-11-14',NULL,NULL,'rrr',NULL,'555','exp_19_2020_CertificoInmigracion.docx','exp_19_202','exp_19_2020_CartaOriginal.docx','exp_19_2020_Desglose.png','exp_19_2020_Manifiesto.docx',NULL);
/*!40000 ALTER TABLE `expediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exportacion`
--

DROP TABLE IF EXISTS `exportacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exportacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_servicio_id` int(11) DEFAULT NULL,
  `via_transportacion_id` int(11) DEFAULT NULL,
  `condicion_compra_id` int(11) DEFAULT NULL,
  `puerto_origen_id` int(11) DEFAULT NULL,
  `puerto_destino_id` int(11) DEFAULT NULL,
  `contenedor_id` int(11) DEFAULT NULL,
  `contrato_id` int(11) DEFAULT NULL,
  `fecha_visita` date NOT NULL,
  `numero_exportacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costo_origen` double DEFAULT NULL,
  `flete` double DEFAULT NULL,
  `destino` double DEFAULT NULL,
  `recargo` double DEFAULT NULL,
  `rx` double DEFAULT NULL,
  `descripcion_carga` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_origen` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_estimado_servicio` date NOT NULL,
  `fecha_salida_embarque` date NOT NULL,
  `fecha_arribo` date NOT NULL,
  `fecha_estimada_salida` date NOT NULL,
  `documentos_recibidos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle_servicios` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `presupuesto` double DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  `direccion_destino` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `buque_id` int(11) DEFAULT NULL,
  `fecha_desactivacion` date NOT NULL,
  `exportacion_activa` tinyint(1) DEFAULT NULL,
  `tipo_moneda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F1E7C6569806DFD` (`solicitud_servicio_id`),
  KEY `IDX_3F1E7C65A5EEE0C` (`via_transportacion_id`),
  KEY `IDX_3F1E7C6595D47C69` (`condicion_compra_id`),
  KEY `IDX_3F1E7C65DF43B33` (`puerto_origen_id`),
  KEY `IDX_3F1E7C65BEAD7FAB` (`puerto_destino_id`),
  KEY `IDX_3F1E7C65C1A15772` (`contenedor_id`),
  KEY `IDX_3F1E7C6570AE7BF1` (`contrato_id`),
  KEY `IDX_3F1E7C652D082DEB` (`buque_id`),
  KEY `IDX_3F1E7C6555188B9C` (`tipo_moneda_id`),
  CONSTRAINT `FK_3F1E7C652D082DEB` FOREIGN KEY (`buque_id`) REFERENCES `buque` (`id`),
  CONSTRAINT `FK_3F1E7C6555188B9C` FOREIGN KEY (`tipo_moneda_id`) REFERENCES `tipo_moneda` (`id`),
  CONSTRAINT `FK_3F1E7C6569806DFD` FOREIGN KEY (`solicitud_servicio_id`) REFERENCES `solicitud_servicio` (`id`),
  CONSTRAINT `FK_3F1E7C6570AE7BF1` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`id`),
  CONSTRAINT `FK_3F1E7C6595D47C69` FOREIGN KEY (`condicion_compra_id`) REFERENCES `condicion_compra` (`id`),
  CONSTRAINT `FK_3F1E7C65A5EEE0C` FOREIGN KEY (`via_transportacion_id`) REFERENCES `via_transportacion` (`id`),
  CONSTRAINT `FK_3F1E7C65BEAD7FAB` FOREIGN KEY (`puerto_destino_id`) REFERENCES `puerto` (`id`),
  CONSTRAINT `FK_3F1E7C65C1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`),
  CONSTRAINT `FK_3F1E7C65DF43B33` FOREIGN KEY (`puerto_origen_id`) REFERENCES `puerto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exportacion`
--

LOCK TABLES `exportacion` WRITE;
/*!40000 ALTER TABLE `exportacion` DISABLE KEYS */;
INSERT INTO `exportacion` VALUES (1,1,1,1,1,1,1,1,'2020-11-18','12222',12.5,12.3,22,22,23,'qqqq','qqqqqq','2020-11-16','2020-11-17','2020-11-18','2020-11-20','qqqq','qqqq','qqqq',NULL,'2020-11-16 04:04:54','2020-11-16','qqqq',NULL,'0000-00-00',NULL,2),(2,2,2,2,2,2,2,2,'2020-11-18','4567',24.8,12.55,25.5,13,25,'errr','qwer','2020-11-20','2020-11-14','2020-11-14','2020-11-18','errr','errr','errr',100.85,'2020-11-16 04:06:19','2020-11-16','errr',1,'0000-00-00',NULL,5),(3,1,1,1,2,1,1,1,'2020-11-10',NULL,3,1,1,1,1,'w','Vedado','2020-11-17','2020-11-13','2020-11-18','2020-11-20','w','w','w',7,'2020-11-17 16:51:28','2020-11-17','w',1,'0000-00-00',NULL,5),(4,1,1,2,1,2,2,1,'2020-11-10','i_04_2020',2,2,2,2,2,'ee','Playa','2020-11-17','2020-11-15','2020-11-23','2020-11-20','ee','ee','ee',10,'2020-11-17 17:01:34','2020-11-17','ee',2,'0000-00-00',NULL,5),(5,2,1,1,2,1,1,1,'2020-11-10','i_05_2020',1,1,1,1,1,'e','San Miguel','2020-11-11','2020-11-12','2020-11-13','2020-11-21','e','e','e',5,'2020-11-17 17:03:05','2020-11-17','e',1,'0000-00-00',NULL,5),(6,1,1,1,1,1,3,2,'2020-11-11','i_06_2020',5,3,3,3,3,'ee','eee','2020-11-10','2020-11-12','2020-11-18','2020-11-18','ee','ee','ee',17,'2020-11-17 17:05:13','2020-11-17','ee',1,'0000-00-00',NULL,NULL);
/*!40000 ALTER TABLE `exportacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `importa_cubano`
--

DROP TABLE IF EXISTS `importa_cubano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `importa_cubano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_id` int(11) DEFAULT NULL,
  `pais_procedencia_id` int(11) DEFAULT NULL,
  `transitario_id` int(11) DEFAULT NULL,
  `naviera_id` int(11) DEFAULT NULL,
  `desglose_manifiesto_id` int(11) DEFAULT NULL,
  `contenedor_id` int(11) DEFAULT NULL,
  `fecha_entrega_aduana` date DEFAULT NULL,
  `fecha_entrega_transito` date DEFAULT NULL,
  `fecha_autorizo_embarque` date DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  `numero_manifiesto` int(11) NOT NULL,
  `solicitud_servicio_id` int(11) DEFAULT NULL,
  `numero_importacion_cubano` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expediente_ok` tinyint(1) DEFAULT NULL,
  `estado_servicio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8ABD18B74E7121AF` (`provincia_id`),
  KEY `IDX_8ABD18B7429FFEC2` (`pais_procedencia_id`),
  KEY `IDX_8ABD18B7896D82D1` (`transitario_id`),
  KEY `IDX_8ABD18B7D21CF971` (`naviera_id`),
  KEY `IDX_8ABD18B736DDC72C` (`desglose_manifiesto_id`),
  KEY `IDX_8ABD18B7C1A15772` (`contenedor_id`),
  KEY `IDX_8ABD18B769806DFD` (`solicitud_servicio_id`),
  KEY `IDX_8ABD18B74BC64AB7` (`estado_servicio_id`),
  CONSTRAINT `FK_8ABD18B736DDC72C` FOREIGN KEY (`desglose_manifiesto_id`) REFERENCES `desglose_manifiesto` (`id`),
  CONSTRAINT `FK_8ABD18B7429FFEC2` FOREIGN KEY (`pais_procedencia_id`) REFERENCES `pais` (`id`),
  CONSTRAINT `FK_8ABD18B74BC64AB7` FOREIGN KEY (`estado_servicio_id`) REFERENCES `estado_servicio` (`id`),
  CONSTRAINT `FK_8ABD18B74E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`),
  CONSTRAINT `FK_8ABD18B769806DFD` FOREIGN KEY (`solicitud_servicio_id`) REFERENCES `solicitud_servicio` (`id`),
  CONSTRAINT `FK_8ABD18B7896D82D1` FOREIGN KEY (`transitario_id`) REFERENCES `transitario` (`id`),
  CONSTRAINT `FK_8ABD18B7C1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`),
  CONSTRAINT `FK_8ABD18B7D21CF971` FOREIGN KEY (`naviera_id`) REFERENCES `naviera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `importa_cubano`
--

LOCK TABLES `importa_cubano` WRITE;
/*!40000 ALTER TABLE `importa_cubano` DISABLE KEYS */;
INSERT INTO `importa_cubano` VALUES (1,1,1,1,1,1,1,'2020-11-16','2020-11-11','2020-11-18','2020-11-16 19:17:17','2020-11-16',234,1,NULL,0,NULL),(2,2,2,2,2,1,3,'2020-11-10','2020-11-18','2020-11-12','2020-11-16 19:17:45','2020-11-16',567,2,NULL,0,NULL),(3,NULL,NULL,1,2,NULL,1,NULL,NULL,NULL,'2020-11-16 20:13:50','2020-11-16',1234,1,NULL,0,1),(4,1,2,1,2,1,1,'2020-11-18','2020-11-19','2020-11-10','2020-11-17 16:01:52','2020-11-17',1234,1,'ic_04_2020',0,NULL),(5,1,2,1,1,1,1,'2020-11-18','2020-11-20','2020-11-13','2020-11-18 03:04:04','2020-11-18',123,1,'ic_05_2020',0,NULL),(6,NULL,NULL,1,1,NULL,NULL,NULL,NULL,NULL,'2020-11-18 04:04:41','2020-11-18',123,1,'ic_06_2020',NULL,NULL),(7,1,1,1,1,1,1,'2020-11-11',NULL,'2020-11-18','2020-11-24 04:38:00','2020-11-24',3456,1,NULL,NULL,1),(8,1,1,2,1,1,2,'2020-10-26',NULL,'2020-11-27','2020-11-24 04:39:59','2020-11-24',78,1,'ic_08_2020',NULL,1),(9,1,1,1,1,1,2,'2020-11-18',NULL,'2020-11-25','2020-11-24 04:41:30','2020-11-24',123,1,'ic_09_2020',NULL,1),(10,1,1,1,1,1,1,'2020-11-24',NULL,'2020-11-18','2020-11-24 18:33:32','2020-11-24',1234,2,'ic_10_2020',NULL,1);
/*!40000 ALTER TABLE `importa_cubano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `importacion`
--

DROP TABLE IF EXISTS `importacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `importacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condicion_compra_id` int(11) DEFAULT NULL,
  `contenedor_id` int(11) DEFAULT NULL,
  `contrato_id` int(11) DEFAULT NULL,
  `puerto_destino_id` int(11) DEFAULT NULL,
  `via_transportacion_id` int(11) DEFAULT NULL,
  `puerto_origen_id` int(11) DEFAULT NULL,
  `estado_servicio_id` int(11) DEFAULT NULL,
  `numero_importacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion_carga` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_destino` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_estimado_servicio` date NOT NULL,
  `fecha_salida_embarque` date NOT NULL,
  `fecha_arribo` date NOT NULL,
  `fecha_estimada_salida` date NOT NULL,
  `documentos_recibidos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle_servicios` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `presupuesto` double DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `costo_origen` double DEFAULT NULL,
  `flete` double DEFAULT NULL,
  `destino` double DEFAULT NULL,
  `recargo` double DEFAULT NULL,
  `rx` double DEFAULT NULL,
  `fecha_insercion` date NOT NULL,
  `solicitud_servicio_id` int(11) DEFAULT NULL,
  `desglose_manifiesto` tinyint(1) DEFAULT NULL,
  `buque_id` int(11) DEFAULT NULL,
  `importacion_activa` tinyint(1) DEFAULT NULL,
  `fecha_desactivacion` date NOT NULL,
  `tipo_moneda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F483A40E95D47C69` (`condicion_compra_id`),
  KEY `IDX_F483A40EC1A15772` (`contenedor_id`),
  KEY `IDX_F483A40E70AE7BF1` (`contrato_id`),
  KEY `IDX_F483A40EBEAD7FAB` (`puerto_destino_id`),
  KEY `IDX_F483A40EA5EEE0C` (`via_transportacion_id`),
  KEY `IDX_F483A40EDF43B33` (`puerto_origen_id`),
  KEY `IDX_F483A40E4BC64AB7` (`estado_servicio_id`),
  KEY `IDX_F483A40E69806DFD` (`solicitud_servicio_id`),
  KEY `IDX_F483A40E2D082DEB` (`buque_id`),
  KEY `IDX_F483A40E55188B9C` (`tipo_moneda_id`),
  CONSTRAINT `FK_F483A40E2D082DEB` FOREIGN KEY (`buque_id`) REFERENCES `buque` (`id`),
  CONSTRAINT `FK_F483A40E4BC64AB7` FOREIGN KEY (`estado_servicio_id`) REFERENCES `estado_servicio` (`id`),
  CONSTRAINT `FK_F483A40E55188B9C` FOREIGN KEY (`tipo_moneda_id`) REFERENCES `tipo_moneda` (`id`),
  CONSTRAINT `FK_F483A40E69806DFD` FOREIGN KEY (`solicitud_servicio_id`) REFERENCES `solicitud_servicio` (`id`),
  CONSTRAINT `FK_F483A40E70AE7BF1` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`id`),
  CONSTRAINT `FK_F483A40E95D47C69` FOREIGN KEY (`condicion_compra_id`) REFERENCES `condicion_compra` (`id`),
  CONSTRAINT `FK_F483A40EA5EEE0C` FOREIGN KEY (`via_transportacion_id`) REFERENCES `via_transportacion` (`id`),
  CONSTRAINT `FK_F483A40EBEAD7FAB` FOREIGN KEY (`puerto_destino_id`) REFERENCES `puerto` (`id`),
  CONSTRAINT `FK_F483A40EC1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`),
  CONSTRAINT `FK_F483A40EDF43B33` FOREIGN KEY (`puerto_origen_id`) REFERENCES `puerto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `importacion`
--

LOCK TABLES `importacion` WRITE;
/*!40000 ALTER TABLE `importacion` DISABLE KEYS */;
INSERT INTO `importacion` VALUES (1,1,3,1,1,1,1,1,NULL,'www','www','2020-11-01','2020-11-21','2020-11-27','2020-11-20','wwww','www','qqqq',289,'2020-11-15 22:18:05',130,123,12,12,12,'2020-11-15',1,0,1,1,'2020-11-23',2),(2,2,2,1,1,1,2,2,'i_02_2020','qq','qq','2020-11-17','2020-11-13','2020-11-15','2020-11-09','qq','qq','qq',53,'2020-11-17 16:15:06',5,12,12,12,12,'2020-11-17',1,0,1,1,'2020-11-23',5),(3,2,4,1,1,1,1,2,'i_03_2020','tt','tt','2020-11-10','2020-11-19','2020-11-20','2020-11-22','tt','tt','tt',10.5,'2020-11-17 16:43:30',2.5,2,2,2,2,'2020-11-17',1,1,1,0,'2020-11-23',5);
/*!40000 ALTER TABLE `importacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `naviera`
--

DROP TABLE IF EXISTS `naviera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `naviera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `naviera`
--

LOCK TABLES `naviera` WRITE;
/*!40000 ALTER TABLE `naviera` DISABLE KEYS */;
INSERT INTO `naviera` VALUES (1,'Naviera 1','2020-11-15 16:45:39','2020-11-15'),(2,'Naviera 2','2020-11-15 16:45:47','2020-11-15'),(3,'Naviera 3','2020-11-15 16:45:54','2020-11-15');
/*!40000 ALTER TABLE `naviera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'Cuba','2020-11-13 22:43:01','2020-11-13'),(2,'Mexico','2020-11-15 16:47:07','2020-11-15'),(3,'Holanda','2020-11-15 16:47:14','2020-11-15');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacion`
--

DROP TABLE IF EXISTS `programacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `tipo_contenedor_id` int(11) DEFAULT NULL,
  `transitario_id` int(11) DEFAULT NULL,
  `naviera_id` int(11) DEFAULT NULL,
  `contenedor_id` int(11) DEFAULT NULL,
  `observaciones` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_arribo_mariel` date NOT NULL,
  `fecha_entregado_aduana` date NOT NULL,
  `fecha_despachar` date NOT NULL,
  `deposito` int(11) NOT NULL,
  `bultos` int(11) NOT NULL,
  `numero_manifiesto` int(11) NOT NULL,
  `numero_desglose` int(11) NOT NULL,
  `detalle_carga` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14491F89DE734E51` (`cliente_id`),
  KEY `IDX_14491F89C112042C` (`tipo_contenedor_id`),
  KEY `IDX_14491F89896D82D1` (`transitario_id`),
  KEY `IDX_14491F89D21CF971` (`naviera_id`),
  KEY `IDX_14491F89C1A15772` (`contenedor_id`),
  CONSTRAINT `FK_14491F89896D82D1` FOREIGN KEY (`transitario_id`) REFERENCES `transitario` (`id`),
  CONSTRAINT `FK_14491F89C112042C` FOREIGN KEY (`tipo_contenedor_id`) REFERENCES `tipo_contenedor` (`id`),
  CONSTRAINT `FK_14491F89C1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`),
  CONSTRAINT `FK_14491F89D21CF971` FOREIGN KEY (`naviera_id`) REFERENCES `naviera` (`id`),
  CONSTRAINT `FK_14491F89DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacion`
--

LOCK TABLES `programacion` WRITE;
/*!40000 ALTER TABLE `programacion` DISABLE KEYS */;
INSERT INTO `programacion` VALUES (1,1,1,1,1,1,'www','2020-11-19','2020-11-17','2020-11-11',12,12,23,23,'ssss','2020-11-18 05:14:55','2020-11-18'),(2,1,1,1,1,1,'www','2020-11-19','2020-11-17','2020-11-11',12,12,23,23,'ssss','2020-11-18 05:15:58','2020-11-18'),(3,1,1,2,1,1,'ffff','2020-11-18','2020-11-17','2020-11-03',22,22,444,444,'rrr','2020-11-18 05:17:27','2020-11-18');
/*!40000 ALTER TABLE `programacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` VALUES (1,'Habana','2020-11-15 16:47:23','2020-11-15'),(2,'Matanzas','2020-11-15 16:47:30','2020-11-15');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puerto`
--

DROP TABLE IF EXISTS `puerto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puerto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puerto`
--

LOCK TABLES `puerto` WRITE;
/*!40000 ALTER TABLE `puerto` DISABLE KEYS */;
INSERT INTO `puerto` VALUES (1,'Puerto 1','2020-11-15 16:46:48','2020-11-15'),(2,'Puerto 2','2020-11-15 16:46:55','2020-11-15');
/*!40000 ALTER TABLE `puerto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rectificacion_desglose_manifiesto`
--

DROP TABLE IF EXISTS `rectificacion_desglose_manifiesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rectificacion_desglose_manifiesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_mbl` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aduaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `multa` tinyint(1) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  `desagrupe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_manifiesto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_rectificacion_desglose` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenedor_id` int(11) DEFAULT NULL,
  `naviera_id` int(11) DEFAULT NULL,
  `fecha_recibo_manifiesto` date NOT NULL,
  `fecha_creacion_rectificacion` date NOT NULL,
  `fecha_notificacion_multa` date NOT NULL,
  `numero_multa` int(11) DEFAULT NULL,
  `fecha_recibida_multa` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_17311FE8C1A15772` (`contenedor_id`),
  KEY `IDX_17311FE8D21CF971` (`naviera_id`),
  CONSTRAINT `FK_17311FE8C1A15772` FOREIGN KEY (`contenedor_id`) REFERENCES `contenedor` (`id`),
  CONSTRAINT `FK_17311FE8D21CF971` FOREIGN KEY (`naviera_id`) REFERENCES `naviera` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rectificacion_desglose_manifiesto`
--

LOCK TABLES `rectificacion_desglose_manifiesto` WRITE;
/*!40000 ALTER TABLE `rectificacion_desglose_manifiesto` DISABLE KEYS */;
INSERT INTO `rectificacion_desglose_manifiesto` VALUES (1,'ddd','23','wer',0,'2020-11-21 21:56:58','2020-11-21','qww','23','01_2020',1,1,'2020-11-21','2020-11-21','2020-11-21',NULL,'2020-11-21'),(2,'ddd','23','wer',0,'2020-11-21 21:58:03','2020-11-21','qww','23','02_2020',1,1,'2020-11-21','2020-11-21','2020-11-21',NULL,'2020-11-21'),(3,'ddd','23','wer',0,'2020-11-21 21:58:37','2020-11-21','qww','23','03_2020',1,1,'2020-11-21','2020-11-21','2020-11-21',NULL,'2020-11-21'),(4,'wer','2345','wer',1,'2020-11-21 22:03:50','2020-11-21','errr','1111','04_2020',1,1,'2020-11-26','2020-11-21','2020-10-29',34567,'2020-11-19'),(5,'ssss','2222','www',0,'2020-11-22 00:20:57','2020-11-22','www','2222','rdmfto_05_2020',1,1,'2020-11-13','2020-11-22','2020-10-28',NULL,'2020-11-18');
/*!40000 ALTER TABLE `rectificacion_desglose_manifiesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_servicio`
--

DROP TABLE IF EXISTS `solicitud_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_servicio_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `via_recepcion_id` int(11) DEFAULT NULL,
  `numero_solicitud` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  `solicitud_activa` tinyint(1) DEFAULT NULL,
  `fecha_desactivacion` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_511DD7EF44EE8D1F` (`tipo_servicio_id`),
  KEY `IDX_511DD7EFDE734E51` (`cliente_id`),
  KEY `IDX_511DD7EFCE90F442` (`via_recepcion_id`),
  CONSTRAINT `FK_511DD7EF44EE8D1F` FOREIGN KEY (`tipo_servicio_id`) REFERENCES `tipo_servicio` (`id`),
  CONSTRAINT `FK_511DD7EFCE90F442` FOREIGN KEY (`via_recepcion_id`) REFERENCES `via_recepcion` (`id`),
  CONSTRAINT `FK_511DD7EFDE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_servicio`
--

LOCK TABLES `solicitud_servicio` WRITE;
/*!40000 ALTER TABLE `solicitud_servicio` DISABLE KEYS */;
INSERT INTO `solicitud_servicio` VALUES (1,1,2,1,'7689','2020-11-15','2020-11-15 18:54:55','2020-11-15',NULL,'0000-00-00'),(2,2,1,2,'5432','2020-11-14','2020-11-15 18:55:17','2020-11-15',NULL,'0000-00-00'),(4,1,1,1,'sctd_04_2020','2020-11-22','2020-11-21 23:07:59','2020-11-21',NULL,'0000-00-00'),(5,1,1,1,'sctd_04_2020','2020-11-22','2020-11-22 03:41:04','2020-11-22',1,'2020-11-23'),(6,2,2,1,'sctd_05_2020','2020-11-22','2020-11-22 03:45:27','2020-11-22',1,'2020-11-23');
/*!40000 ALTER TABLE `solicitud_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_contenedor`
--

DROP TABLE IF EXISTS `tipo_contenedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_contenedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_contenedor`
--

LOCK TABLES `tipo_contenedor` WRITE;
/*!40000 ALTER TABLE `tipo_contenedor` DISABLE KEYS */;
INSERT INTO `tipo_contenedor` VALUES (1,'Tipo de contenedor 1','2020-11-15 16:36:23','2020-11-15'),(2,'Tipo de contenedor 2','2020-11-15 16:36:32','2020-11-15');
/*!40000 ALTER TABLE `tipo_contenedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_contrato`
--

DROP TABLE IF EXISTS `tipo_contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_contrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_contrato`
--

LOCK TABLES `tipo_contrato` WRITE;
/*!40000 ALTER TABLE `tipo_contrato` DISABLE KEYS */;
INSERT INTO `tipo_contrato` VALUES (1,'Fijo','2020-11-15 16:36:47','2020-11-15'),(2,'Determinado','2020-11-15 16:36:54','2020-11-15'),(3,'Indeterminado','2020-11-15 16:37:02','2020-11-15');
/*!40000 ALTER TABLE `tipo_contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_moneda`
--

DROP TABLE IF EXISTS `tipo_moneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_moneda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_moneda`
--

LOCK TABLES `tipo_moneda` WRITE;
/*!40000 ALTER TABLE `tipo_moneda` DISABLE KEYS */;
INSERT INTO `tipo_moneda` VALUES (2,'CUP','2020-11-23 16:03:08','2020-11-23'),(5,'CUC','2020-11-23 16:06:30','2020-11-23');
/*!40000 ALTER TABLE `tipo_moneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT INTO `tipo_servicio` VALUES (1,'Importacion','2020-11-15 16:35:55','2020-11-15'),(2,'Exportacion','2020-11-15 16:36:06','2020-11-15');
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transitario`
--

DROP TABLE IF EXISTS `transitario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transitario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transitario`
--

LOCK TABLES `transitario` WRITE;
/*!40000 ALTER TABLE `transitario` DISABLE KEYS */;
INSERT INTO `transitario` VALUES (1,'Transitario 1','2020-11-15 16:37:13','2020-11-15'),(2,'Transitario 2','2020-11-15 16:37:24','2020-11-15');
/*!40000 ALTER TABLE `transitario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traza`
--

DROP TABLE IF EXISTS `traza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `accion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traza`
--

LOCK TABLES `traza` WRITE;
/*!40000 ALTER TABLE `traza` DISABLE KEYS */;
/*!40000 ALTER TABLE `traza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primer_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `via_recepcion`
--

DROP TABLE IF EXISTS `via_recepcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `via_recepcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `via_recepcion`
--

LOCK TABLES `via_recepcion` WRITE;
/*!40000 ALTER TABLE `via_recepcion` DISABLE KEYS */;
INSERT INTO `via_recepcion` VALUES (1,'Via recepcion 1','2020-11-15 16:38:05','2020-11-15'),(2,'Via recepcion 2','2020-11-15 16:38:14','2020-11-15');
/*!40000 ALTER TABLE `via_recepcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `via_transportacion`
--

DROP TABLE IF EXISTS `via_transportacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `via_transportacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_insercion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `via_transportacion`
--

LOCK TABLES `via_transportacion` WRITE;
/*!40000 ALTER TABLE `via_transportacion` DISABLE KEYS */;
INSERT INTO `via_transportacion` VALUES (1,'Maritima','2020-11-15 16:37:43','2020-11-15'),(2,'Aerea','2020-11-15 16:37:52','2020-11-15');
/*!40000 ALTER TABLE `via_transportacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-24 22:54:52
