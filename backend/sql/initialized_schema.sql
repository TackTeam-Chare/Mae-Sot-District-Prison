-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: prison_db
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'ฝ่ายผู้บริหาร'),(2,'ฝ่ายบริหารทั่วไป'),(3,'ฝ่ายทัณฑปฎิบัติ'),(4,'ฝ่ายฝึกวิชาชีพ'),(5,'ฝ่ายควบคุมเเละรักษาการณ์'),(6,'ฝ่ายสวัสดิการผู้ต้องขังเเละสงเคราะห์ผู้ต้องขัง'),(7,'ฝ่ายการศึกษา'),(8,'ฝ่ายสภานพยาบาลเรือนจำ'),(9,'ฝฝ่ายควบคุมเเดนหญิง'),(10,'ฝ่ายรักษาการณ์'),(11,'ฝ่ายควบคุม');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (7,'dd','dd','17222741386440204185_resume.pdf','2024-07-29 17:18:41','2024-07-29 17:28:58'),(8,'sdfs','sdf','1722274121632e89 (1).pdf','2024-07-29 17:19:03','2024-07-29 17:28:41');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pos_id` int DEFAULT NULL,
  `dep_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_ibfk_1` (`pos_id`),
  KEY `employees_ibfk_2` (`dep_id`),
  CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`pos_id`) REFERENCES `job_positions` (`id`),
  CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`dep_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,NULL,NULL,'ประธาน',NULL,NULL),(14,2,3,'อนุมัติ กลิ่นอ้ม','2024-07-23 11:56:18','17217357786416950ce6638.png'),(18,3,3,'ดหดดหก','2024-07-23 13:42:29','1721742164425853036_683773563966073_7544890064345965827_n.jpg'),(19,2,2,'ทดสอบ','2024-07-23 14:57:07','17222650613939f741f7195c4827d71072d93c65c2.jpg'),(20,1,2,'ดฟหกดหฟดฟหกด','2024-07-23 14:58:19','1722265054360_F_389504333_cBtEbakDZaKVzckaUL5HUtol6MiYfbN7.jpg'),(21,2,11,'ฟหกดฟหกด','2024-07-23 15:10:06','1721747406newplot.png'),(23,2,11,'czcx','2024-07-27 06:08:52',''),(24,1,10,'dd','2024-07-27 06:09:18',''),(25,1,8,'dd','2024-07-27 06:09:30',''),(26,1,7,'dd','2024-07-27 06:09:39',''),(27,1,6,'dsd','2024-07-29 14:28:12',''),(28,2,4,'sasd','2024-07-29 14:28:25',''),(31,2,1,'อนุมัติ กลิ่นอ้ม','2024-07-29 16:14:34',''),(32,4,1,'อนุมัติ กลิ่นอ้ม','2024-07-29 16:15:08',''),(33,3,1,'อนุมัติ กลิ่นอ้ม','2024-07-29 16:15:24',''),(34,1,1,'อนุมัติ กลิ่นอ้ม','2024-07-29 16:15:37','');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `allow_publish` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (228,'13123','1231','1722259583360_F_389504333_cBtEbakDZaKVzckaUL5HUtol6MiYfbN7.jpg','2024-07-29 13:26:23',1),(229,'123123','123123','17222595903939f741f7195c4827d71072d93c65c2.jpg','2024-07-29 13:26:30',1),(230,'sdfsdfsd','sdfsdf','1722259629images (13) (1)_LE_auto_x2.jpg','2024-07-29 13:27:09',0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_positions`
--

DROP TABLE IF EXISTS `job_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_positions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(255) DEFAULT NULL,
  `priority` int DEFAULT NULL,
  `controll` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_positions`
--

LOCK TABLES `job_positions` WRITE;
/*!40000 ALTER TABLE `job_positions` DISABLE KEYS */;
INSERT INTO `job_positions` VALUES (1,'ผู้ใต้บังคับบัญชา',4,0),(2,'หัวหน้าฝ่าย',3,1),(3,'ผอ',2,2),(4,'ผบ',1,3);
/*!40000 ALTER TABLE `job_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prisoners`
--

DROP TABLE IF EXISTS `prisoners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prisoners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `nationality` varchar(50) NOT NULL DEFAULT 'Thai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisoners`
--

LOCK TABLES `prisoners` WRITE;
/*!40000 ALTER TABLE `prisoners` DISABLE KEYS */;
INSERT INTO `prisoners` VALUES (1,'kor','.jpg',1,'2024-07-23 15:51:20'),(2,'kor','.jpg',1,'2024-07-23 15:51:20'),(3,'kor','.jpg',1,'2024-07-23 15:51:20'),(4,'kor','.jpg',1,'2024-07-23 15:51:20'),(6,'kor','.jpg',1,'2024-07-23 15:51:21'),(7,'kor','.jpg',1,'2024-07-23 15:51:21'),(8,'kor','.jpg',1,'2024-07-23 15:51:21'),(9,'kor','.jpg',1,'2024-07-23 15:51:21'),(10,'kor','.jpg',1,'2024-07-23 15:51:21'),(32,'อนุมัติ กลิ่นอ้ม','1721752220newplot.png',1,'2024-07-23 16:28:26'),(34,'sfdfsd','',0,'2024-07-23 16:31:01'),(35,'sdfsdfsdfsdfsdfsf','',0,'2024-07-23 16:31:11'),(36,'อนุมัติ กลิ่นอ้ม','1721757847441497752_853221123492159_6012399200785180983_n.jpg',0,'2024-07-23 18:04:07'),(37,'อนุมัติ กลิ่นอ้ม','17217579142572687096_preview_2.png',1,'2024-07-23 18:05:14'),(38,'อนุมัติ กลิ่นอ้ม','17217579276416950ce6638.png',0,'2024-07-23 18:05:27');
/*!40000 ALTER TABLE `prisoners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `allow_publish` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (198,'kjlkj','kjjkh','1722219948newplot.png','2024-07-29 02:25:48',1),(199,'fff','vf','','2024-07-29 16:44:46',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `screen_contents`
--

DROP TABLE IF EXISTS `screen_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `screen_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Default Title',
  `content` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Default Content',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_image.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `screen_contents`
--

LOCK TABLES `screen_contents` WRITE;
/*!40000 ALTER TABLE `screen_contents` DISABLE KEYS */;
INSERT INTO `screen_contents` VALUES (1,'sda','asd','1722074801newplot.png','2024-07-02 10:13:36'),(2,'ภารกิจ2','    พันธกิจกรมราชทัณฑ์\r\n    1. ควบคุมผู้ต้องขังอย่างมืออาชีพ\r\n    2. บำบัดฟื้นฟูและแก้ไขพฤตินิสัยของผู้ต้องขังอย่างมีประสิทธิภาพ\r\n    \r\n    \r\n    วิสัยทัศน์ เรือนจำอำเภอแม่สอด\r\n    มุ่งพัฒนาสิ่งแวดล้อม พร้อมนำองค์ให้เข้มแข็ง\r\n    ใส่ใจในการแก้ไขบำบัดฟื้นฟู และมีความพอเพียง\r\n    \r\n    พันธกิจ เรือนจำอำเภอแม่สอด\r\n    \r\n    1. ควบคุมผู้ต้องขังอย่างมืออาชีพ\r\n    2. พัฒนาพฤตินิสัยผู้ต้องขัง ส่งเสริมการศึกษา พัฒนาทักษะอาชีพ แก้ไขและบำบัดฟื้นฟู\r\n    ','1722165505newplot.png','2024-07-02 10:13:36'),(3,'ภารกิจ','แอบมองไม่เปลี่ยนไปที่ไหนกันดีไหมที่เราพร้อมร่วมทางแห่งชีวิตนั้น รักไม่รักที่มีแต่เธอไม่ได้ไหมที่ฉันชอบฟัง ไม่ต้องกังวลปล่อยไปสู่ดินแดนแสนวิเศษแค่ให้หัวใจสับสนไม่มีใคร ยังรอพวกเรากำลังตามหาความฝันใช่ไหม ฉันก็ยังไม่ไหวไม่อยากให้เขานั้นพูดว่าชอบฉันจะได้มา จะกอดเธอรู้ใช่ไหมว่าของเมื่อวาน ให้เธอฟังแล้วเธออยู่อย่างนี้\r\n\r\nแค่เพียงสิ่งใหม่ๆดิ้นไปที่ไหนมา ไปเซ่ใสใสก็มีแต่เธอนั้นโชคดีเนื่องในหัวใจสับสนไม่มีที่เธอ ที่ปลายทางที่ไหลแสดงว่าเรี่ยวแรงยังคงติดอยู่ตรงนี้ ฉันจะไม่เคยทำร้ายสักครั้งเป็นไรถ้าไม่แน่ใจในใจ จะมีความหมายซ่อนอยู่ข้างในวันเกิด ฉันก็คงต้องพอและเติบโตในหัวใจรู้ว่าใจ ในบางวันที่มีแต่เดินก้าวต่อไป ต้องบอกเธอให้เรามาสิว่าจะผิดจะไหลรินสักวัน ฉันคงลืมได้เองว่ามันไป\r\n\r\nฉันพักพอร่างกายเริ่มมืดมัวและสปอตไลท์เป็นค่ำคืนที่มีน้ำตา อยากจะตกหัวใจมันไปด้วยกันในใจ ไม่เคยจะหันมาเต้นตามกันนะนิดๆร่ำลาที่เป็นอย่างไร เกิดพายุเข้ามาแทนที่เพลงเก่าแล้วคงต้องไปบนหนทางที่ฉัน จงเปล่งพลังแล้วลุยกันไป ก็อยากจะรู้ว่ามันไว้ทำไมร้ายอย่างนี้ มาปลดปล่อยใจของฉันเอง สู้ต่อไปเลยไม่เคยจะหันมาสนุกเฮฮาโห่ร้องด้วยกัน','1722165517newplot.png','2024-07-02 10:13:37'),(4,'ติดต่อสอบถาม','- tel 0815768242\r\n- facebook Arnumat Klinom\r\n- instargram matky_','default_image.jpg','2024-07-02 15:44:03'),(6,'ภารกิจ','test history','default_image.jpg','2024-07-03 11:24:54'),(7,'test','test','','2024-07-20 09:51:56'),(8,'test','test','','2024-07-20 09:52:40'),(9,'test','test','','2024-07-20 09:55:22'),(10,'test','test','','2024-07-20 09:56:10'),(11,'test','test','','2024-07-20 09:57:04'),(12,'test','test','','2024-07-20 09:57:23'),(13,'test','test','','2024-07-20 09:58:39'),(14,'test','test','','2024-07-20 09:59:29'),(15,'test','test','','2024-07-20 10:02:51'),(16,'test','test','','2024-07-20 10:02:52'),(17,'test','test','','2024-07-20 10:02:54'),(18,'test','test','','2024-07-20 10:03:40'),(19,'test','test','','2024-07-20 10:03:51'),(20,'test','test','','2024-07-20 10:05:20'),(21,'test','test','','2024-07-20 10:06:09'),(22,'test','test','','2024-07-20 10:10:46');
/*!40000 ALTER TABLE `screen_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `logged_in` tinyint(1) DEFAULT '0',
  `is_main_priority` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (36,'arnumat','arnumat@test.com','$2y$10$ZZaSyTh7cqqAF1jEg2jGLO.oGXYf9D4vFlekGue50PUrhVq5.MZRq',1,1),(167,'rfsfsdfsd','arnumat11@test.com','$2y$10$jwQG67NXqLRR5BT1JvlMzuCn33XMzjzOUCCGONl21fxHN3UZBOKoK',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visiting_rules`
--

DROP TABLE IF EXISTS `visiting_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visiting_rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Default Title',
  `content` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Default Content',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_image.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visiting_rules`
--

LOCK TABLES `visiting_rules` WRITE;
/*!40000 ALTER TABLE `visiting_rules` DISABLE KEYS */;
INSERT INTO `visiting_rules` VALUES (18,'dasdas','dasds','1722165540newplot.png','2024-07-22 10:17:01'),(19,'หกด','หกดหด','1722165534newplot.png','2024-07-22 14:23:46');
/*!40000 ALTER TABLE `visiting_rules` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-30  0:37:16
