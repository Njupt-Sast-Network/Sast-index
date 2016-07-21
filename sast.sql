# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.30-0ubuntu0.14.04.1)
# Database: sast
# Generation Time: 2016-07-19 07:43:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table sast_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sast_comment`;

CREATE TABLE `sast_comment` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `commentor` varchar(255) DEFAULT NULL,
  `islike` int(255) DEFAULT NULL,
  `id` int(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` text,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table sast_like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sast_like`;

CREATE TABLE `sast_like` (
  `username` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `islike` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table sast_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sast_news`;

CREATE TABLE `sast_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `text` text NOT NULL,
  `author` tinytext NOT NULL,
  `timestamp` datetime NOT NULL,
  `img` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table sast_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sast_user`;

CREATE TABLE `sast_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `nickname` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `studentnum` tinytext NOT NULL,
  `department` tinytext NOT NULL,
  `major` tinytext NOT NULL,
  `mail` varchar(64) NOT NULL DEFAULT '',
  `phone` varchar(64) NOT NULL DEFAULT '',
  `level` set('1','2','3','4') DEFAULT '',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table sast_work
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sast_work`;

CREATE TABLE `sast_work` (
  `work_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `keyword` tinytext,
  `text` text,
  `author` tinytext,
  `department` tinytext,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
