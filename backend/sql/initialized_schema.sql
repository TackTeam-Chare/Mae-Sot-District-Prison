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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (201,'test','test','','2024-07-20 10:10:57'),(202,'testdsfsa','testfsdfs','1721642648-images.jpg','2024-07-20 10:10:58');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (186,'test','test','1721471683default_image.png','2024-07-20 10:34:43'),(187,'test','test','','2024-07-20 10:34:57'),(188,'test','test','','2024-07-20 10:34:58'),(189,'fsdfsd','sfsdsfdfsf','1721643169images.jpg','2024-07-22 10:10:24');
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
INSERT INTO `screen_contents` VALUES (1,'dfsdkljfsdl;kgmdfg','fskldfjlaskfjlsdfsdfsf','1721643979images.jpg','2024-07-02 10:13:36'),(2,'ภารกิจ2','    พันธกิจกรมราชทัณฑ์\r\n    1. ควบคุมผู้ต้องขังอย่างมืออาชีพ\r\n    2. บำบัดฟื้นฟูและแก้ไขพฤตินิสัยของผู้ต้องขังอย่างมีประสิทธิภาพ\r\n    \r\n    \r\n    วิสัยทัศน์ เรือนจำอำเภอแม่สอด\r\n    มุ่งพัฒนาสิ่งแวดล้อม พร้อมนำองค์ให้เข้มแข็ง\r\n    ใส่ใจในการแก้ไขบำบัดฟื้นฟู และมีความพอเพียง\r\n    \r\n    พันธกิจ เรือนจำอำเภอแม่สอด\r\n    \r\n    1. ควบคุมผู้ต้องขังอย่างมืออาชีพ\r\n    2. พัฒนาพฤตินิสัยผู้ต้องขัง ส่งเสริมการศึกษา พัฒนาทักษะอาชีพ แก้ไขและบำบัดฟื้นฟู\r\n    ','1721643736images.jpg','2024-07-02 10:13:36'),(3,'ภารกิจ','แอบมองไม่เปลี่ยนไปที่ไหนกันดีไหมที่เราพร้อมร่วมทางแห่งชีวิตนั้น รักไม่รักที่มีแต่เธอไม่ได้ไหมที่ฉันชอบฟัง ไม่ต้องกังวลปล่อยไปสู่ดินแดนแสนวิเศษแค่ให้หัวใจสับสนไม่มีใคร ยังรอพวกเรากำลังตามหาความฝันใช่ไหม ฉันก็ยังไม่ไหวไม่อยากให้เขานั้นพูดว่าชอบฉันจะได้มา จะกอดเธอรู้ใช่ไหมว่าของเมื่อวาน ให้เธอฟังแล้วเธออยู่อย่างนี้\r\n\r\nแค่เพียงสิ่งใหม่ๆดิ้นไปที่ไหนมา ไปเซ่ใสใสก็มีแต่เธอนั้นโชคดีเนื่องในหัวใจสับสนไม่มีที่เธอ ที่ปลายทางที่ไหลแสดงว่าเรี่ยวแรงยังคงติดอยู่ตรงนี้ ฉันจะไม่เคยทำร้ายสักครั้งเป็นไรถ้าไม่แน่ใจในใจ จะมีความหมายซ่อนอยู่ข้างในวันเกิด ฉันก็คงต้องพอและเติบโตในหัวใจรู้ว่าใจ ในบางวันที่มีแต่เดินก้าวต่อไป ต้องบอกเธอให้เรามาสิว่าจะผิดจะไหลรินสักวัน ฉันคงลืมได้เองว่ามันไป\r\n\r\nฉันพักพอร่างกายเริ่มมืดมัวและสปอตไลท์เป็นค่ำคืนที่มีน้ำตา อยากจะตกหัวใจมันไปด้วยกันในใจ ไม่เคยจะหันมาเต้นตามกันนะนิดๆร่ำลาที่เป็นอย่างไร เกิดพายุเข้ามาแทนที่เพลงเก่าแล้วคงต้องไปบนหนทางที่ฉัน จงเปล่งพลังแล้วลุยกันไป ก็อยากจะรู้ว่ามันไว้ทำไมร้ายอย่างนี้ มาปลดปล่อยใจของฉันเอง สู้ต่อไปเลยไม่เคยจะหันมาสนุกเฮฮาโห่ร้องด้วยกัน','1721643875images.jpg','2024-07-02 10:13:37'),(4,'ติดต่อสอบถาม','- tel 0815768242\r\n- facebook Arnumat Klinom\r\n- instargram matky_00 ','default_image.jpg','2024-07-02 15:44:03'),(6,'ภารกิจ','test history','default_image.jpg','2024-07-03 11:24:54'),(7,'test','test','','2024-07-20 09:51:56'),(8,'test','test','','2024-07-20 09:52:40'),(9,'test','test','','2024-07-20 09:55:22'),(10,'test','test','','2024-07-20 09:56:10'),(11,'test','test','','2024-07-20 09:57:04'),(12,'test','test','','2024-07-20 09:57:23'),(13,'test','test','','2024-07-20 09:58:39'),(14,'test','test','','2024-07-20 09:59:29'),(15,'test','test','','2024-07-20 10:02:51'),(16,'test','test','','2024-07-20 10:02:52'),(17,'test','test','','2024-07-20 10:02:54'),(18,'test','test','','2024-07-20 10:03:40'),(19,'test','test','','2024-07-20 10:03:51'),(20,'test','test','','2024-07-20 10:05:20'),(21,'test','test','','2024-07-20 10:06:09'),(22,'test','test','','2024-07-20 10:10:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `visiting_rules` VALUES (18,'dasdas','dasds','1721643636Screenshot 2024-04-03 225929.png','2024-07-22 10:17:01'),(19,'หกด','หกดหด','1721658226Screenshot 2024-04-03 225929.png','2024-07-22 14:23:46');
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

-- Dump completed on 2024-07-22 22:18:54
