-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table dev_cinafappdb.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`id`, `email`, `username`, `password`, `token`, `refreshToken`, `createdAt`, `updatedAt`) VALUES
	(1, 'admin@cinaf.tv', 'CINAF', '$2y$10$WT1kUTQpXT/u5slxSKrGi.NhV5ivLl5YLX6IVC0m7bYTpZAc4hIZu', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbkBjaW5hZi50diIsImF1ZCI6IiQyeSQxMCRXVDFrVVRRcFhUL3U1c2x4U0tyR2kuTmhWNWl2TGw1WUxYNklWQzBtN2JZVHBaQWM0aEladSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwfQ.HbvI7Dm8VxglbNG5eHGIdz9tfghwQ7jAjnGqrqbL4yM', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbkBjaW5hZi50diIsImF1ZCI6IiQyeSQxMCRXVDFrVVRRcFhUL3U1c2x4U0tyR2kuTmhWNWl2TGw1WUxYNklWQzBtN2JZVHBaQWM0aEladSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwfQ.HbvI7Dm8VxglbNG5eHGIdz9tfghwQ7jAjnGqrqbL4yM', '2022-08-29 08:25:04', '2022-08-29 08:25:04');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping data for table dev_cinafappdb.cover: ~0 rows (approximately)
/*!40000 ALTER TABLE `cover` DISABLE KEYS */;
/*!40000 ALTER TABLE `cover` ENABLE KEYS */;

-- Dumping data for table dev_cinafappdb.downloaded: ~1 rows (approximately)
/*!40000 ALTER TABLE `downloaded` DISABLE KEYS */;
REPLACE INTO `downloaded` (`id`, `fkSoftware`, `createdAt`, `updatedAt`) VALUES
	(50, 77, '2022-08-29 15:44:42', '2022-08-29 15:44:42');
/*!40000 ALTER TABLE `downloaded` ENABLE KEYS */;

-- Dumping data for table dev_cinafappdb.media: ~2 rows (approximately)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
REPLACE INTO `media` (`id`, `fkSoftware`, `type`, `isCover`, `path`, `createdAt`, `updatedAt`) VALUES
	(51, 79, 'image', 1, '3059280942850c60.png', '2022-08-29 17:34:26', '2022-08-29 17:34:26'),
	(52, 79, 'image', 1, 'b681d611beb57514.png', '2022-08-29 17:35:20', '2022-08-29 17:35:20'),
	(53, 79, 'image', 1, 'c761b7f58a04525a.png', '2022-08-29 17:35:52', '2022-08-29 17:35:52');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Dumping data for table dev_cinafappdb.software: ~3 rows (approximately)
/*!40000 ALTER TABLE `software` DISABLE KEYS */;
REPLACE INTO `software` (`id`, `fkSupport`, `title`, `description`, `createdAt`, `updatedAt`, `slug`, `store`) VALUES
	(77, 3, 'CINAF', 'Si vous Ãªtes fan du cinÃ©ma camerounais ( films, sÃ©ries, web-sÃ©ries) alors CINAF est l\'application qu\'il vous faut.\r\nrendre accessible le cinÃ©ma camerounais tel est notre dÃ©fi!\r\n\r\nðŸ‘‰ðŸ» que retrouve-t-on sur CINAF ?\r\n\r\nLes sÃ©ries, les films et web-sÃ©ries dont tout le monde parle sont sur CINAF !\r\n- les films, sÃ©rie jamais diffusÃ©s... (OTAGES D\'AMOUR , MADAME MONSIEUX)\r\n- des web-sÃ©ries en exclusivitÃ©... ( LA FILLE DE MAMITON)\r\n- les meilleurs acteurs camerounais au meilleur de leur forme c\'est la meilleure application de cinÃ©ma\r\n\r\nðŸ‘‰ðŸ» quelle est la particularitÃ© de CINAF ?\r\n\r\n- une expÃ©rience utilisateur exceptionnelle\r\n- application adapte son contenu et son interface en fonction du pays de l\'utilisateur.\r\nUpdated on\r\nAug 23, 2022\r\n', '2022-08-25 14:04:17', '2022-08-25 14:04:17', 'cinaf-for-android', 'https://play.google.com/store/apps/details?id=com.cinaf.mobile.stream'),
	(78, 2, 'CINAF', 'Si vous Ãªtes fan du cinÃ©ma camerounais ( films, sÃ©ries, web-sÃ©ries) alors CINAF est l\'application qu\'il vous faut.\r\nrendre accessible le cinÃ©ma camerounais tel est notre dÃ©fi!\r\n\r\nðŸ‘‰ðŸ» que retrouve-t-on sur CINAF ?\r\n\r\nLes sÃ©ries, les films et web-sÃ©ries dont tout le monde parle sont sur CINAF !\r\n- les films, sÃ©rie jamais diffusÃ©s... (OTAGES D\'AMOUR , MADAME MONSIEUX)\r\n- des web-sÃ©ries en exclusivitÃ©... ( LA FILLE DE MAMITON)\r\n- les meilleurs acteurs camerounais au meilleur de leur forme c\'est la meilleure application de cinÃ©ma\r\n\r\nðŸ‘‰ðŸ» quelle est la particularitÃ© de CINAF ?\r\n\r\n- une expÃ©rience utilisateur exceptionnelle\r\n- application adapte son contenu et son interface en fonction du pays de l\'utilisateur.\r\nUpdated on\r\nAug 23, 2022\r\n', '2022-08-25 14:08:29', '2022-08-25 14:08:29', 'cinaf-for-tv', NULL),
	(79, 4, 'Cinaf for ios', '', '2022-08-25 14:08:55', '2022-08-25 14:08:55', 'cinaf-for-ios', 'https://play.google.com/store/apps/details?id=com.cinaf.mobile.stream');
/*!40000 ALTER TABLE `software` ENABLE KEYS */;

-- Dumping data for table dev_cinafappdb.support: ~3 rows (approximately)
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
REPLACE INTO `support` (`id`, `icon`, `title`, `createdAt`, `updatedAt`) VALUES
	(2, 'favicon.png', 'Smart TV', '2022-08-22 09:19:06', '2022-08-22 09:19:06'),
	(3, 'favicon.png', 'Android', '2022-08-22 09:19:49', '2022-08-22 09:19:49'),
	(4, 'favicon.png', 'IOS', '2022-08-22 09:20:02', '2022-08-22 09:20:02');
/*!40000 ALTER TABLE `support` ENABLE KEYS */;

-- Dumping data for table dev_cinafappdb.version: ~0 rows (approximately)
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
/*!40000 ALTER TABLE `version` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
