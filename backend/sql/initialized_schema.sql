CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'ฝ่ายผู้บริหาร'),(2,'ฝ่ายบริหารทั่วไป'),(3,'ฝ่ายทัณฑปฎิบัติ'),(4,'ฝ่ายผู้บริหาร'),(5,'ฝ่ายควบคุมเเละรักษาการณ์'),(6,'ฝ่ายสวัสดิการผู้ต้องขังเเละสงเคราะห์ผู้ต้องขัง'),(7,'ฝ่ายการศึกษา'),(8,'ฝ่ายสภานพยาบาลเรือนจำ'),(9,'ฝฝ่ายควบคุมเเดนหญิง'),(10,'ฝ่ายรักษาการณ์'),(11,'ฝ่ายควบคุม');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,NULL,NULL,'ประธาน',NULL,NULL),(13,1,1,'อนุมัติ กลิ่นอ้ม','2024-07-23 11:52:04','1721735524441497752_853221123492159_6012399200785180983_n.jpg'),(14,2,3,'อนุมัติ กลิ่นอ้ม','2024-07-23 11:56:18','17217357786416950ce6638.png'),(16,1,1,'arnumat','2024-07-23 13:00:43','1721741255no_image.png'),(17,3,1,'อนุมัติ กลิ่นอ้มsadasdasdasda','2024-07-23 13:24:47','1721741520woord.jpg'),(18,3,3,'ดหดดหก','2024-07-23 13:42:29','1721742164425853036_683773563966073_7544890064345965827_n.jpg'),(19,2,2,'ทดสอบ','2024-07-23 14:57:07','1721746627download_image_1711442605246.png'),(20,1,2,'ดฟหกดหฟดฟหกด','2024-07-23 14:58:19','1721746699download_image_1711473099297.png'),(21,2,11,'ฟหกดฟหกด','2024-07-23 15:10:06','1721747406newplot.png');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (201,'test','test','','2024-07-20 10:10:57',0),(202,'testdsfsa','testfsdfs','1721642648-images.jpg','2024-07-20 10:10:58',0),(212,'fsfs','fsdf','1721755074441497752_853221123492159_6012399200785180983_n.jpg','2024-07-23 17:17:54',1),(213,'fsfs','fsdf','','2024-07-23 17:21:51',0),(214,'fsfs','fsdf','','2024-07-23 17:22:00',0),(215,'dfgdfg','ergdfgddfgd','','2024-07-23 18:26:54',0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `job_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_positions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(255) DEFAULT NULL,
  `priority` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_positions` WRITE;
/*!40000 ALTER TABLE `job_positions` DISABLE KEYS */;
INSERT INTO `job_positions` VALUES (1,'ระดับสูง',2),(2,'ระดับบกลาง',1),(3,'ระดับบต่ำ',0);
/*!40000 ALTER TABLE `job_positions` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `prisoners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prisoners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `prisoners` WRITE;
/*!40000 ALTER TABLE `prisoners` DISABLE KEYS */;
INSERT INTO `prisoners` VALUES (1,'kor','.jpg',1,'2024-07-23 15:51:20'),(2,'kor','.jpg',1,'2024-07-23 15:51:20'),(3,'kor','.jpg',1,'2024-07-23 15:51:20'),(4,'kor','.jpg',1,'2024-07-23 15:51:20'),(6,'kor','.jpg',1,'2024-07-23 15:51:21'),(7,'kor','.jpg',1,'2024-07-23 15:51:21'),(8,'kor','.jpg',1,'2024-07-23 15:51:21'),(9,'kor','.jpg',1,'2024-07-23 15:51:21'),(10,'kor','.jpg',1,'2024-07-23 15:51:21'),(32,'อนุมัติ กลิ่นอ้ม','1721752220newplot.png',1,'2024-07-23 16:28:26'),(33,'sdfsd','',0,'2024-07-23 16:30:56'),(34,'sfdfsd','',0,'2024-07-23 16:31:01'),(35,'sdfsdfsdfsdfsdfsf','',0,'2024-07-23 16:31:11'),(36,'อนุมัติ กลิ่นอ้ม','1721757847441497752_853221123492159_6012399200785180983_n.jpg',0,'2024-07-23 18:04:07'),(37,'อนุมัติ กลิ่นอ้ม','17217579142572687096_preview_2.png',1,'2024-07-23 18:05:14'),(38,'อนุมัติ กลิ่นอ้ม','17217579276416950ce6638.png',0,'2024-07-23 18:05:27');
/*!40000 ALTER TABLE `prisoners` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (186,'test','test','1721471683default_image.png','2024-07-20 10:34:43',0),(187,'test','test','','2024-07-20 10:34:57',0),(188,'test','test','','2024-07-20 10:34:58',0),(189,'fsdfsd','sfsdsfdfsf','1721643169images.jpg','2024-07-22 10:10:24',0),(190,'34534534','453445','1721755882newplot.png','2024-07-23 17:31:22',0),(193,'asdas','das','1721757619441497752_853221123492159_6012399200785180983_n.jpg','2024-07-23 18:00:19',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `screen_contents` WRITE;
/*!40000 ALTER TABLE `screen_contents` DISABLE KEYS */;
INSERT INTO `screen_contents` VALUES (1,'dfsdkljfsdl;kgmdfg','fskldfjlaskfjlsdfsdfsfหดหกดฟหกดฟหกดฟหกดฟห\r\nะ้ดเ้เ้ด้ด้ดเ้ดเ้ดเ้ด\r\nเ้เ่ด่ดเ้กเ้ด้ดเ้ดเ้ดเ้ด้ดเ้','1721661934Screenshot 2024-04-03 225929.png','2024-07-02 10:13:36'),(2,'ภารกิจ2','    พันธกิจกรมราชทัณฑ์\r\n    1. ควบคุมผู้ต้องขังอย่างมืออาชีพ\r\n    2. บำบัดฟื้นฟูและแก้ไขพฤตินิสัยของผู้ต้องขังอย่างมีประสิทธิภาพ\r\n    \r\n    \r\n    วิสัยทัศน์ เรือนจำอำเภอแม่สอด\r\n    มุ่งพัฒนาสิ่งแวดล้อม พร้อมนำองค์ให้เข้มแข็ง\r\n    ใส่ใจในการแก้ไขบำบัดฟื้นฟู และมีความพอเพียง\r\n    \r\n    พันธกิจ เรือนจำอำเภอแม่สอด\r\n    \r\n    1. ควบคุมผู้ต้องขังอย่างมืออาชีพ\r\n    2. พัฒนาพฤตินิสัยผู้ต้องขัง ส่งเสริมการศึกษา พัฒนาทักษะอาชีพ แก้ไขและบำบัดฟื้นฟู\r\n    ','1721643736images.jpg','2024-07-02 10:13:36'),(3,'ภารกิจ','แอบมองไม่เปลี่ยนไปที่ไหนกันดีไหมที่เราพร้อมร่วมทางแห่งชีวิตนั้น รักไม่รักที่มีแต่เธอไม่ได้ไหมที่ฉันชอบฟัง ไม่ต้องกังวลปล่อยไปสู่ดินแดนแสนวิเศษแค่ให้หัวใจสับสนไม่มีใคร ยังรอพวกเรากำลังตามหาความฝันใช่ไหม ฉันก็ยังไม่ไหวไม่อยากให้เขานั้นพูดว่าชอบฉันจะได้มา จะกอดเธอรู้ใช่ไหมว่าของเมื่อวาน ให้เธอฟังแล้วเธออยู่อย่างนี้\r\n\r\nแค่เพียงสิ่งใหม่ๆดิ้นไปที่ไหนมา ไปเซ่ใสใสก็มีแต่เธอนั้นโชคดีเนื่องในหัวใจสับสนไม่มีที่เธอ ที่ปลายทางที่ไหลแสดงว่าเรี่ยวแรงยังคงติดอยู่ตรงนี้ ฉันจะไม่เคยทำร้ายสักครั้งเป็นไรถ้าไม่แน่ใจในใจ จะมีความหมายซ่อนอยู่ข้างในวันเกิด ฉันก็คงต้องพอและเติบโตในหัวใจรู้ว่าใจ ในบางวันที่มีแต่เดินก้าวต่อไป ต้องบอกเธอให้เรามาสิว่าจะผิดจะไหลรินสักวัน ฉันคงลืมได้เองว่ามันไป\r\n\r\nฉันพักพอร่างกายเริ่มมืดมัวและสปอตไลท์เป็นค่ำคืนที่มีน้ำตา อยากจะตกหัวใจมันไปด้วยกันในใจ ไม่เคยจะหันมาเต้นตามกันนะนิดๆร่ำลาที่เป็นอย่างไร เกิดพายุเข้ามาแทนที่เพลงเก่าแล้วคงต้องไปบนหนทางที่ฉัน จงเปล่งพลังแล้วลุยกันไป ก็อยากจะรู้ว่ามันไว้ทำไมร้ายอย่างนี้ มาปลดปล่อยใจของฉันเอง สู้ต่อไปเลยไม่เคยจะหันมาสนุกเฮฮาโห่ร้องด้วยกัน','1721643875images.jpg','2024-07-02 10:13:37'),(4,'ติดต่อสอบถาม','- tel 0815768242\r\n- facebook Arnumat Klinom\r\n- instargram matky_','default_image.jpg','2024-07-02 15:44:03'),(6,'ภารกิจ','test history','default_image.jpg','2024-07-03 11:24:54'),(7,'test','test','','2024-07-20 09:51:56'),(8,'test','test','','2024-07-20 09:52:40'),(9,'test','test','','2024-07-20 09:55:22'),(10,'test','test','','2024-07-20 09:56:10'),(11,'test','test','','2024-07-20 09:57:04'),(12,'test','test','','2024-07-20 09:57:23'),(13,'test','test','','2024-07-20 09:58:39'),(14,'test','test','','2024-07-20 09:59:29'),(15,'test','test','','2024-07-20 10:02:51'),(16,'test','test','','2024-07-20 10:02:52'),(17,'test','test','','2024-07-20 10:02:54'),(18,'test','test','','2024-07-20 10:03:40'),(19,'test','test','','2024-07-20 10:03:51'),(20,'test','test','','2024-07-20 10:05:20'),(21,'test','test','','2024-07-20 10:06:09'),(22,'test','test','','2024-07-20 10:10:46');
/*!40000 ALTER TABLE `screen_contents` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_in` tinyint(1) DEFAULT '0',
  `is_main_priority` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (36,'arnumat','arnumat@test.com','$2y$10$ZZaSyTh7cqqAF1jEg2jGLO.oGXYf9D4vFlekGue50PUrhVq5.MZRq',1,1),(167,'rfsfsdfsd','arnumat11@test.com','$2y$10$jwQG67NXqLRR5BT1JvlMzuCn33XMzjzOUCCGONl21fxHN3UZBOKoK',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

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
