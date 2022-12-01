-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: php_pro
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area` (
  `id_ar` int unsigned NOT NULL AUTO_INCREMENT,
  `area_ukr` varchar(45) DEFAULT NULL,
  `area_rus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_ar`),
  UNIQUE KEY `area_ukr_UNIQUE` (`area_ukr`),
  UNIQUE KEY `area_rus_UNIQUE` (`area_rus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='області';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Крим','Крым'),(2,'Вінницька','Винницкая'),(3,'Волиньска','Волынская'),(4,'Дніпропетровська','Днепропетровская'),(5,'Донецька','Донецкая'),(6,'Житомирська','Житомирская'),(7,'Закарпатська','Закарпатская'),(8,'Запорізька','Запорожская'),(9,'Івано-Франківська','Ивано-Франковская'),(10,'Київська','Киевская'),(11,'Київ','Киев'),(12,'Кіровоградська','Кировоградская'),(13,'Луганська','Луганская'),(14,'Львівська','Львовская'),(15,'Миколаївська','Николаевская'),(16,'Одеська','Одесская'),(17,'Полтавська','Полтавская'),(18,'Рівненська','Ровенская'),(19,'Сумська','Сумская'),(20,'Тернопільська','Тернопольская'),(21,'Харківська','Харьковская'),(22,'Херсонська','Херсонская'),(23,'Хмельницька','Хмельницкая'),(24,'Черкаська','Черкасская'),(25,'Чернівецька','Черновецкая'),(26,'Чернігівська','Черниговская'),(27,'Севастополь','Севастополь');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalog_city`
--

DROP TABLE IF EXISTS `catalog_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catalog_city` (
  `id` int NOT NULL,
  `name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `region_name_uk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `region_name_ru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_area` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`id_area`),
  KEY `id_idx` (`id_area`),
  CONSTRAINT `id` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_ar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalog_city`
--

LOCK TABLES `catalog_city` WRITE;
/*!40000 ALTER TABLE `catalog_city` DISABLE KEYS */;
INSERT INTO `catalog_city` VALUES (3235,'Біла Церква','Белая Церковь','Білоцерківський','Белоцерковский',11,'2019-05-15 20:21:06','2022-11-20 04:10:57','bila-tserkva'),(3477,'Гореничі','Гореничи','Києво-Святошинський','Киево-Святошинский',11,'2019-05-15 20:21:38','2022-11-20 04:10:49','gorenichi'),(3505,'Гурівщина','Гуровщина','Києво-Святошинський','Киево-Святошинский',11,'2019-05-15 20:21:40','2019-08-14 14:06:57','gurivshchina'),(3593,'Забір’я','Заборье','Києво-Святошинський','Киево-Святошинский',11,'2019-05-15 20:21:52','2022-11-20 04:10:49','zabirya'),(3714,'Ківшовата','Кившувата','Таращанський','Таращанский',11,'2019-05-15 20:22:05','2022-11-20 04:10:53','kivshovata'),(3816,'Крюківщина','Крюковщина','Києво-Святошинський','Киево-Святошинский',11,'2019-05-15 20:22:17','2022-11-20 04:10:48','kryukivshchina'),(3869,'Лукаші','Лукаши','Баришівський','Барышевский',11,'2019-05-15 20:22:27','2022-02-13 04:10:46','lukashi'),(4172,'Погреби','Погреби','Тетіївський','Тетиевский',11,'2019-05-15 20:23:03','2022-11-20 04:10:52','pogrebi'),(10708,'Кропивня','Кропивня','Іванківський','Иванковский',11,'2019-07-31 23:43:17','2022-03-06 04:13:17','kropivnya'),(10772,'Матюші','Матюши','Білоцерківський','Белоцерковский',11,'2019-07-31 23:43:23','2022-11-20 04:10:49','matyushi'),(11233,'Литвинівка','Литвиновка','Вишгородський','Вышгородский',11,'2019-07-31 23:44:04','2022-11-20 04:10:49','litvinivka'),(11325,'Ясногородка','Ясногородка','Макарівський','Макаровский',11,'2019-07-31 23:44:14','2019-08-13 17:24:30','yasnogorodka'),(11456,'Півці','Пивцы','Кагарлицький','Кагарлыцкий',11,'2019-07-31 23:44:22','2022-11-20 04:10:49','pivtsi'),(11463,'Слобода','Слобода','Кагарлицький','Кагарлыцкий',11,'2019-07-31 23:44:22','2019-08-14 14:06:15','sloboda'),(11590,'Липівка','Липовка','Макарівський','Макаровский',11,'2019-07-31 23:44:38','2019-08-14 14:05:13','lipivka'),(11662,'Македони','Македоны','Миронівський','Мироновский',11,'2019-07-31 23:44:42','2022-03-06 04:13:15','makedoni'),(12278,'Жоравка','Жоравка','Яготинський','Яготинский',11,'2019-07-31 23:45:38','2022-11-20 04:10:45','zhoravka'),(12306,'Супоївка','Супоивка','Яготинський','Яготинский',11,'2019-07-31 23:45:39','2022-11-20 04:10:48','supoivka'),(18149,'Сезенків','Сезенков','Баришівський','Барышевский',11,'2019-07-31 23:53:54','2022-11-20 04:10:44','sezenkiv');
/*!40000 ALTER TABLE `catalog_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalog_city_old`
--

DROP TABLE IF EXISTS `catalog_city_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catalog_city_old` (
  `id` int NOT NULL,
  `new_post_city_id` varchar(255) DEFAULT NULL,
  `justin_city_id` int DEFAULT NULL,
  `name_uk` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `region_name_uk` varchar(255) DEFAULT NULL,
  `area_name_uk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `region_name_ru` varchar(255) DEFAULT NULL,
  `area_name_ru` varchar(255) DEFAULT NULL,
  `ukr_poshta_city_id` int DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalog_city_old`
--

LOCK TABLES `catalog_city_old` WRITE;
/*!40000 ALTER TABLE `catalog_city_old` DISABLE KEYS */;
INSERT INTO `catalog_city_old` VALUES (3235,'db5c88ce-391c-11dd-90d9-001a92567626',73,'Біла Церква','Белая Церковь','Білоцерківський','Київська','2019-05-15 20:21:06','2022-11-20 04:10:57','Белоцерковский','Киевская',5791,'bila-tserkva'),(12278,'d63931c7-dae7-11e9-b48a-005056b24375',NULL,'Жоравка','Жоравка','Яготинський','Київська','2019-07-31 23:45:38','2022-11-20 04:10:45','Яготинский','Киевская',5869,'zhoravka'),(12306,'f78c2e69-8836-11e9-898c-005056b24375',NULL,'Супоївка','Супоивка','Яготинський','Київська','2019-07-31 23:45:39','2022-11-20 04:10:48','Яготинский','Киевская',5880,'supoivka'),(3816,'5b0cc18d-a8ee-11e3-9fa0-0050568002cf',182,'Крюківщина','Крюковщина','Києво-Святошинський','Київська','2019-05-15 20:22:17','2022-11-20 04:10:48','Киево-Святошинский','Киевская',5565,'kryukivshchina'),(11590,NULL,NULL,'Липівка','Липовка','Макарівський','Київська','2019-07-31 23:44:38','2019-08-14 14:05:13','Макаровский','Киевская',5597,'lipivka'),(11662,'a35fceb7-4d37-11ec-80fb-b8830365bd04',NULL,'Македони','Македоны','Миронівський','Київська','2019-07-31 23:44:42','2022-03-06 04:13:15','Мироновский','Киевская',5629,'makedoni'),(11233,'6640f033-9e35-11e9-898c-005056b24375',NULL,'Литвинівка','Литвиновка','Вишгородський','Київська','2019-07-31 23:44:04','2022-11-20 04:10:49','Вышгородский','Киевская',5456,'litvinivka'),(3714,'5905bca1-ff8c-11e8-ad0d-005056b24375',NULL,'Ківшовата','Кившувата','Таращанський','Київська','2019-05-15 20:22:05','2022-11-20 04:10:53','Таращанский','Киевская',5798,'kivshovata'),(10708,'ae9c3496-07dd-11eb-80fb-b8830365bd04',NULL,'Кропивня','Кропивня','Іванківський','Київська','2019-07-31 23:43:17','2022-03-06 04:13:17','Иванковский','Киевская',5208,'kropivnya'),(3505,NULL,NULL,'Гурівщина','Гуровщина','Києво-Святошинський','Київська','2019-05-15 20:21:40','2019-08-14 14:06:57','Киево-Святошинский','Киевская',5561,'gurivshchina'),(3869,NULL,NULL,'Лукаші','Лукаши','Баришівський','Київська','2019-05-15 20:22:27','2022-02-13 04:10:46','Барышевский','Киевская',5285,'lukashi'),(18149,'7d9cee21-de44-11ea-80fb-b8830365bd04',NULL,'Сезенків','Сезенков','Баришівський','Київська','2019-07-31 23:53:54','2022-11-20 04:10:44','Барышевский','Киевская',15173,'sezenkiv'),(4172,'a9cb64c7-c347-11e9-b0c5-005056b24375',206,'Погреби','Погреби','Тетіївський','Київська','2019-05-15 20:23:03','2022-11-20 04:10:52','Тетиевский','Киевская',29165,'pogrebi'),(3593,'65a62535-ffe7-11e5-899e-005056887b8d',NULL,'Забір’я','Заборье','Києво-Святошинський','Київська','2019-05-15 20:21:52','2022-11-20 04:10:49','Киево-Святошинский','Киевская',5563,'zabirya'),(11463,NULL,NULL,'Слобода','Слобода','Кагарлицький','Київська','2019-07-31 23:44:22','2019-08-14 14:06:15','Кагарлыцкий','Киевская',5541,'sloboda'),(11325,NULL,NULL,'Ясногородка','Ясногородка','Макарівський','Київська','2019-07-31 23:44:14','2019-08-13 17:24:30','Макаровский','Киевская',5619,'yasnogorodka'),(11456,'cf75f5cb-4638-11ed-a361-48df37b92096',NULL,'Півці','Пивцы','Кагарлицький','Київська','2019-07-31 23:44:22','2022-11-20 04:10:49','Кагарлыцкий','Киевская',5536,'pivtsi'),(10772,'daabecee-96ce-11ea-a970-b8830365ade4',NULL,'Матюші','Матюши','Білоцерківський','Київська','2019-07-31 23:43:23','2022-11-20 04:10:49','Белоцерковский','Киевская',5247,'matyushi'),(3477,'d1389571-a9e7-11e8-ad0d-005056b24375',NULL,'Гореничі','Гореничи','Києво-Святошинський','Київська','2019-05-15 20:21:38','2022-11-20 04:10:49','Киево-Святошинский','Киевская',5559,'gorenichi');
/*!40000 ALTER TABLE `catalog_city_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currier`
--

DROP TABLE IF EXISTS `currier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currier` (
  `id_currier` int NOT NULL AUTO_INCREMENT,
  `currier_ukr` varchar(45) NOT NULL,
  `currier_rus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_currier`),
  UNIQUE KEY `currier_ukr_UNIQUE` (`currier_ukr`),
  UNIQUE KEY `currier_rus_UNIQUE` (`currier_rus`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currier`
--

LOCK TABLES `currier` WRITE;
/*!40000 ALTER TABLE `currier` DISABLE KEYS */;
INSERT INTO `currier` VALUES (1,'Укрпошта','Укрпочта'),(2,'Джастін','Джастин'),(3,'Нова пошта','Новая почта');
/*!40000 ALTER TABLE `currier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dest_point`
--

DROP TABLE IF EXISTS `dest_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dest_point` (
  `id_city` int NOT NULL,
  `id_cur` int NOT NULL,
  `id_point` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_city`,`id_point`),
  UNIQUE KEY `id_point_UNIQUE` (`id_point`),
  KEY `id_currier_idx` (`id_cur`),
  CONSTRAINT `id_city` FOREIGN KEY (`id_city`) REFERENCES `catalog_city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_cur` FOREIGN KEY (`id_cur`) REFERENCES `currier` (`id_currier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dest_point`
--

LOCK TABLES `dest_point` WRITE;
/*!40000 ALTER TABLE `dest_point` DISABLE KEYS */;
INSERT INTO `dest_point` VALUES (3235,1,'5791','2019-05-15 20:21:06','2022-11-20 04:10:57'),(3235,2,'73','2019-05-15 20:21:06','2022-11-20 04:10:57'),(3235,3,'db5c88ce-391c-11dd-90d9-001a92567626','2019-05-15 20:21:06','2022-11-20 04:10:57'),(3477,1,'5559','2019-05-15 20:21:38','2022-11-20 04:10:49'),(3477,3,'d1389571-a9e7-11e8-ad0d-005056b24375','2019-05-15 20:21:38','2022-11-20 04:10:49'),(3505,1,'5561','2019-05-15 20:21:40','2019-08-14 14:06:57'),(3593,1,'5563','2019-05-15 20:21:52','2022-11-20 04:10:49'),(3593,3,'65a62535-ffe7-11e5-899e-005056887b8d','2019-05-15 20:21:52','2022-11-20 04:10:49'),(3714,1,'5798','2019-05-15 20:22:05','2022-11-20 04:10:53'),(3714,3,'5905bca1-ff8c-11e8-ad0d-005056b24375','2019-05-15 20:22:05','2022-11-20 04:10:53'),(3816,2,'182','2019-05-15 20:22:17','2022-11-20 04:10:48'),(3816,1,'5565','2019-05-15 20:22:17','2022-11-20 04:10:48'),(3816,3,'5b0cc18d-a8ee-11e3-9fa0-0050568002cf','2019-05-15 20:22:17','2022-11-20 04:10:48'),(3869,1,'5285','2019-05-15 20:22:27','2022-02-13 04:10:46'),(4172,2,'206','2019-05-15 20:23:03','2022-11-20 04:10:52'),(4172,1,'29165','2019-05-15 20:23:03','2022-11-20 04:10:52'),(4172,3,'a9cb64c7-c347-11e9-b0c5-005056b24375','2019-05-15 20:23:03','2022-11-20 04:10:52'),(10708,1,'5208','2019-07-31 23:43:17','2022-03-06 04:13:17'),(10708,3,'ae9c3496-07dd-11eb-80fb-b8830365bd04','2019-07-31 23:43:17','2022-03-06 04:13:17'),(10772,1,'5247','2019-07-31 23:43:23','2022-11-20 04:10:49'),(10772,3,'daabecee-96ce-11ea-a970-b8830365ade4','2019-07-31 23:43:23','2022-11-20 04:10:49'),(11233,1,'5456','2019-07-31 23:44:04','2022-11-20 04:10:49'),(11233,3,'6640f033-9e35-11e9-898c-005056b24375','2019-07-31 23:44:04','2022-11-20 04:10:49'),(11325,1,'5619','2019-07-31 23:44:14','2019-08-13 17:24:30'),(11456,1,'5536','2019-07-31 23:44:22','2022-11-20 04:10:49'),(11456,3,'cf75f5cb-4638-11ed-a361-48df37b92096','2019-07-31 23:44:22','2022-11-20 04:10:49'),(11463,1,'5541','2019-07-31 23:44:22','2019-08-14 14:06:15'),(11590,1,'5597','2019-07-31 23:44:38','2019-08-14 14:05:13'),(11662,1,'5629','2019-07-31 23:44:42','2022-03-06 04:13:15'),(11662,3,'a35fceb7-4d37-11ec-80fb-b8830365bd04','2019-07-31 23:44:42','2022-03-06 04:13:15'),(12278,1,'5869','2019-07-31 23:45:38','2022-11-20 04:10:45'),(12278,3,'d63931c7-dae7-11e9-b48a-005056b24375','2019-07-31 23:45:38','2022-11-20 04:10:45'),(12306,1,'5880','2019-07-31 23:45:39','2022-11-20 04:10:48'),(12306,3,'f78c2e69-8836-11e9-898c-005056b24375','2019-07-31 23:45:39','2022-11-20 04:10:48'),(18149,1,'15173','2019-07-31 23:53:54','2022-11-20 04:10:44'),(18149,3,'7d9cee21-de44-11ea-80fb-b8830365bd04','2019-07-31 23:53:54','2022-11-20 04:10:44');
/*!40000 ALTER TABLE `dest_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registr`
--

DROP TABLE IF EXISTS `registr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` smallint NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `banned` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registr`
--

LOCK TABLES `registr` WRITE;
/*!40000 ALTER TABLE `registr` DISABLE KEYS */;
INSERT INTO `registr` VALUES (55,'2022-11-25 03:08:45','2022-11-25 03:08:46',0,'Andrew,','JVRehl5k7p34wKs1HjCH4UXew2oe6RitfnV8FCRc4T7il9eriEk57/V9MyqjSho9lFReJyNWfFinHEB+5xu23g==',0),(56,'2022-11-25 03:09:01','2022-11-25 03:09:01',0,'Anna','zdB1naRMvnvUjjc6uSGwfhF90hCyaz8wSEXBi67L+FyAgmWPAgc888WdiLOyWVSd4JFnovR6+j9mCZ/o9TUWMQ==',0),(57,'2022-11-25 03:09:12','2022-11-25 03:09:12',0,'Alexander','2QLXZQczrcG3sQPlidOL00mpQp00KFkQ4uHoMCkaB47as7Lk0gRIK918OWj9bwWAg9oGjD2OxpyK3SCPKugLGA==',0),(58,'2022-11-25 03:09:16','2022-11-25 03:09:16',0,'Victor','HAKZh0srcYOAblTc66Po/PNMQ+jP2pML/sHCbK4kI0Q0dySMlcGY/IbLwo2uYlMVJRmSmDBcsaFQYEnJD1cQ0w==',0),(59,'2022-11-25 03:09:18','2022-11-25 03:09:19',1,'Yaroslav','ALvDaRylYprZPd6mawHRlCsEr5j4veHmakVGaGpJxTU88lNOtybuX/j7q0erm+R3fnzipKIujU7Xzwq+xNA4kw==',0),(60,'2022-11-25 03:09:32','2022-11-25 03:09:33',1,'Karolina','qwydLbdmgE0W29QM5ViHRDOkJFt4VPLOzmHC/eCYoPRHvhHtpxBwnVBKIy+pQ89Z+ivWQldNWtcsrSpkVzqCVw==',0),(61,'2022-11-25 03:09:38','2022-11-25 03:09:38',0,'Stepan','9HyyJRE8khYVnqjEInYN3BjxPXV2iSXw5IzZw6OSErxypinYW482G+Hg+zUDEbgW+kt9Fh3Rvgj5fIbkXeMmxA==',0),(62,'2022-11-25 03:09:45','2022-11-25 03:09:49',0,'Barbara','2VP16rNEJuo3GB/sRnO/KOa7PVbmYUkQCXRt3QjOAxQP9KkZQCp1jXLRMSYmO+fuN/RSewhOcVyzHFTFplS8rw==',0),(63,'2022-11-25 03:09:55','2022-11-25 03:09:57',0,'Ivan','ECY9YY1uUK+5LGZGH3vYsWIaHsWezUZ9D0KEn/R2wggbAdTvOAFDPRUnDR8VjdNndn8u+eg0N9puPeDUKdKhAg==',0),(64,'2022-11-25 03:09:59','2022-11-25 03:09:59',1,'Irena','SoiagVROV2nlb9og/aEMp1Y5r6BWj4banPuEwe2EPscE2hrtv8ZiihNlrKMyIq8vMfPmD6WXXHCupB9XN31Jtg==',0),(65,'2022-11-25 03:10:01','2022-11-25 03:10:01',0,'Katarzyna','DCeRTuVIkbKyXxPaqV7jFS5KFnFJY8VBGE85+YcmYpfoKPEds1TY0Qyc3ofRQOTE0KXSkognu6yQFC3kLP11dQ==',0),(66,'2022-11-25 03:10:03','2022-11-25 03:10:03',0,'Nikolay','QANOi8WWcpAcTi0EHuVyHD5seU2byykzR/XyUoLhSXM2AxInjUyUIiAzr/SIOx5Ive9isBf6s8ZxIjZ+/12YfQ==',0),(67,'2022-11-25 03:10:05','2022-11-25 03:10:05',0,'Max','gUutkNj1DETq4O4VGVp00uvMl0laFlzEjilLvmjrHIg15G8JyAhXOjHJQ8IXpH8lbHk1/z9vVe52YDh0hX7jLQ==',0),(68,'2022-11-25 03:10:08','2022-11-25 03:10:12',0,'Robert','DxipuUJ5KEERcjtgUzUCDWoghktz6k49C0+OIEkc04tNxxbwj4FWYUAoSAp3qzSeo3qt6HpDG0+RKxuX7CfO0Q==',0),(69,'2022-11-25 03:10:15','2022-11-25 03:10:15',0,'Piter','N3urQoWPZqhlJ+yYo5/qIXj8vt45IlAwhKTCD/wZf+wb7JAL3jdeYx89KmAv6HWEqxBMVG3F3anznJFdqIOAzg==',0);
/*!40000 ALTER TABLE `registr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'php_pro'
--

--
-- Dumping routines for database 'php_pro'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-01  2:55:58
