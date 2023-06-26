-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hospital_system
CREATE DATABASE IF NOT EXISTS `hospital_system` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci */;
USE `hospital_system`;

-- Dumping structure for table hospital_system.hastabilgileri
CREATE TABLE IF NOT EXISTS `hastabilgileri` (
  `hastaid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `tcno` varchar(11) DEFAULT NULL,
  `adres` varchar(255) DEFAULT 'Henüz Bilgi Girilmemiş',
  `tlfno` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT 'Henüz Bilgi Girilmemiş',
  `cinsiyet` varchar(1) DEFAULT 'B',
  PRIMARY KEY (`hastaid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hospital_system.hastabilgileri: ~2 rows (approximately)
INSERT INTO `hastabilgileri` (`hastaid`, `adi`, `soyad`, `tcno`, `adres`, `tlfno`, `email`, `cinsiyet`) VALUES
	(15, 'Gökçen', 'Tuğ', '21481274127', 'Yok', '2819741241', 'test@gmail.com', 'E'),
	(16, 'Ahmet', 'Serdengeçti', '29421805583', 'Henüz Bilgi Girilmemiş', '2184721408', 'Henüz Bilgi Girilmemiş', 'E');

-- Dumping structure for table hospital_system.resimler
CREATE TABLE IF NOT EXISTS `resimler` (
  `resim_id` int(11) NOT NULL AUTO_INCREMENT,
  `tcno` varchar(11) DEFAULT NULL,
  `resimbilgisi` longtext CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`resim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table hospital_system.resimler: ~2 rows (approximately)
INSERT INTO `resimler` (`resim_id`, `tcno`, `resimbilgisi`) VALUES
	(21, '21481274127', 'data:image/png;base64,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'),
	(22, '29421805583', 'data:image/png;base64,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');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
