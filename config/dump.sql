-- MariaDB dump 10.17  Distrib 10.4.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	10.4.12-MariaDB-1:10.4.12+maria~bionic

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
-- Current Database: `store`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `store` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `store`;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (3,'Samsung'),(4,'ASUS'),(5,'Apple'),(6,'AMD'),(7,'Dell'),(8,'RaspberryPi'),(9,'Xiaomi'),(10,'Sony'),(11,'Microsoft'),(12,'HP');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands_images`
--

DROP TABLE IF EXISTS `brands_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_brand` int(10) unsigned NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_brand` (`id_brand`),
  CONSTRAINT `brands_images_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands_images`
--

LOCK TABLES `brands_images` WRITE;
/*!40000 ALTER TABLE `brands_images` DISABLE KEYS */;
INSERT INTO `brands_images` VALUES (1,3,'samsung_brand.jpg'),(2,4,'asus_brand.png'),(3,5,'apple_brand.jpg'),(4,6,'amd_brand.png'),(5,7,'dell_brand.png'),(6,8,'raspberry-pi_brand.jpg'),(7,9,'xiaomi-logo.png'),(8,10,'sony-logo.png'),(9,11,'microsoft_logo.jpg'),(14,12,'hp-logo.png');
/*!40000 ALTER TABLE `brands_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sub` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'alimento'),(2,NULL,'bebidas'),(3,NULL,'eletronicos');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `coupon_type` int(11) NOT NULL,
  `coupon_value` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'Cor'),(2,'Tamanho'),(3,'Memória RAM'),(4,'Polegadas');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(10) unsigned NOT NULL,
  `id_brand` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `price` float NOT NULL,
  `price_from` float NOT NULL,
  `rating` float NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `sale` tinyint(1) NOT NULL,
  `bestseller` tinyint(1) NOT NULL,
  `new_product` tinyint(1) NOT NULL,
  `options` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  KEY `id_brand` (`id_brand`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,3,3,'Samsung Pocket','Smartphone brabissimo',100,799.99,799.89,3,1,0,1,1,NULL),(3,3,4,'ZenBook 13 Ultra Slim Laptop','Um otimo notebook para quem gosta de velocidade.',20,3000.99,2880.99,5,1,0,1,1,NULL),(4,3,5,'Iphone 11 128GB Preto 4GB RAM','Seu sistema operacional iOS 13 incorpora atualicoes importantes, como o Dark Mode',8,5899,4499,4,1,1,1,1,NULL),(5,3,3,'Samsung Galaxy A50 64gb Preto Semi-novo + Galaxy Fit Preto','Galaxy A50 64GB Preto Com TV Digital Semi-Novo Em Estado de Zero',230,1999,1999,3,0,1,0,1,NULL),(6,3,6,'Processador gamer AMD Ryzen 5 2600 YD2600BBAFBOX de 6 nucleos e 3.9GHz de frequencia','Fundamental no rendimento de teus computadores de mesa, voce ja nao tera que pensar em como asignar o tempo e acoes.',10,1148,1148,5,1,1,1,0,NULL),(7,3,5,'Apple Macbook Pro 13 1.4ghz/8gb/256gb Touchbar Space Gray','Voce vai ficar pobre mas pelo menos voce tera um belo Macbook',2,12989,12988,4,1,1,1,1,NULL),(8,3,7,'Notebook Dell Inspiron 3583-u05p Pentium 4gb 500gb 15.6 Linux','Mobilidade e design: facil de levar com voce para todos os lugares, seu exterior elegante faz dele um item indispensvel no seu dia a dia',100,3049,2749,3,0,1,1,1,NULL),(9,3,8,'Raspberry Pi4 Pi 4 Model B Gigabit Usb 3.0 1 Gb Memoria','Aqui vem a 4th geracao Raspberry Pi Raspberry Pi modelo B !',80,400,419,4,1,1,1,0,NULL),(10,3,9,'Xiaomi Redmi Note 8 Dual SIM 64 GB Preto-espacial 4 GB RAM','Celular confiavel tem nome, e nao e friboi, e Xiaomi Redmi Note 8',205,1335.95,1335.95,5,1,1,1,1,NULL),(11,3,9,'Xiaomi Redmi Note 9S Dual SIM 64 GB Interstellar gray 4 GB RAM','O sistema operacional inovador Android 10 incorpora respostas inteligentes e acoes sugeridas para todos os seus aplicativos.',156,1705,1704,3,1,0,1,1,NULL),(12,3,9,'Asus ZenFone Max Shot ZB634KL Dual SIM 64 GB Preto 4 GB RAM','Sua memoria RAM de 4GB, lhe permitira executar varios aplicativos ao mesmo tempo, jogar e navegar rapidamente sem inconvenientes.',43,1499.9,1099,3,0,0,0,1,NULL),(13,3,10,'Sony PlayStation 4 Slim 1TB','Melhor que o XCaixa',400,4000,3214.9,5,1,1,1,1,NULL),(14,3,11,'Microsoft Xbox One S 1TB Standard branco','Melhor que o PlayNada',300,2605.95,2185,1,1,1,1,1,NULL),(16,3,12,'Impressora a cor multifuncional HP DeskJet Ink Advantage 2676 com Wi-Fi 100V/240V dreamy teal','Imprima arquivos, digitalize documentos e faca todas as fotocopias necessarias com esta impressora multifuncional HP, sempre pronta para simplificar sua rotina de trabalho ou estudo.',62,517.9,512,4,0,0,0,1,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `products_images_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES (1,1,'samsung-pocket.jpg'),(3,3,'zenbook-13.jpg'),(5,4,'iphone-11.webp'),(6,5,'samsung-galaxy-a50.webp'),(7,6,'asus-ryzen.webp'),(8,7,'macbook-pro-13.webp'),(9,8,'notebook-dell-inspiron-3583.webp'),(11,9,'raspberry-pi4-model-b.webp'),(12,1,'samsung-pocket-2.jpg'),(13,10,'Xiaomi_Redmi_Note_8.webp'),(14,10,'Xiaomi_Redmi_Note_8-2.webp'),(15,10,'Xiaomi_Redmi_Note_8-3.webp'),(16,11,'Xiaomi_Redmi_Note_95.webp'),(17,11,'Xiaomi_Redmi_Note_95-2.webp'),(18,11,'Xiaomi_Redmi_Note_95-3.webp'),(19,11,'Xiaomi_Redmi_Note_95-4.webp'),(20,12,'Asus_Zenfone_ZB634KL.webp'),(21,12,'Asus_Zenfone_ZB634KL-2.webp'),(22,13,'playstation_4.webp'),(23,14,'xbox_one.webp'),(24,14,'xbox_one-2.webp'),(25,14,'xbox_one-3.webp'),(28,16,'hp-deskjet-2676.webp'),(29,16,'hp-deskjet-2676_2.webp');
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options`
--

DROP TABLE IF EXISTS `products_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `p_value` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options`
--

LOCK TABLES `products_options` WRITE;
/*!40000 ALTER TABLE `products_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_transactions`
--

DROP TABLE IF EXISTS `purchase_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_purchase` int(11) NOT NULL,
  `amount` float NOT NULL,
  `transaction_code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_transactions`
--

LOCK TABLES `purchase_transactions` WRITE;
/*!40000 ALTER TABLE `purchase_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_coupon` int(11) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases_products`
--

DROP TABLE IF EXISTS `purchases_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases_products`
--

LOCK TABLES `purchases_products` WRITE;
/*!40000 ALTER TABLE `purchases_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_rated` datetime NOT NULL,
  `points` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rates`
--

LOCK TABLES `rates` WRITE;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'samue Roberto Martins Kruszynski','samuel2pgames@gmail.com','$2y$10$G7Lt.7MqUwkPpkJOELDrSeBJme7aBt53zrF.CeLHo5SqtBsOUWldu','13566676453','dsdadada'),(2,'samue Roberto Martins Kruszynski','samuel2pgames@gmail.com','$2y$10$ajRryJECOyDXTRn2dGLMSuIAN.jq5eZSctkcr5OxYJZSJBDesJWp.','13566676453',''),(3,'samue Roberto Martins Kruszynski','samuel2pgames@gmail.com','$2y$10$INb4eay0IcT8FpVsoYB7IOpFjvqvU9YxrOfEdohWB4mqsVdt9CZwm','13566676453',''),(4,'samue Roberto Martins Kruszynski','samuel2pgames@gmail.com','$2y$10$5QoCjzfpObvyXQbfvcxiBezKn9HFM4rM1fjni3VrOOUB6hSNTJ9k2','13566676453',''),(5,'samue Roberto Martins Kruszynski','samuel2pgames@gmail.com','$2y$10$UoabLEgLjdgVY494cY646uYTp0YjoQNGoPTiG5ydltJ0pDhE88xWO','13566676453','dsdadada'),(6,'samue Roberto Martins Kruszynski','samuel2pgames@gmail.com','$2y$10$0wSaaTb7.S/geyLiW5X4we4R49pirfCJV.SLZB1IfhLIZQwfNw1EC','13566676453','dsdadada');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-30  0:58:30
