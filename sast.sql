-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2016 �?07 �?17 �?10:10
-- 服务器版本: 5.6.11
-- PHP 版本: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `sast`
--
CREATE DATABASE IF NOT EXISTS `sast` DEFAULT CHARACTER SET utf32 COLLATE utf32_unicode_ci;
USE `sast`;

-- --------------------------------------------------------

--
-- 表的结构 `sast_comment`
--

CREATE TABLE IF NOT EXISTS `sast_comment` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `commentor` varchar(255) DEFAULT NULL,
  `islike` int(255) DEFAULT NULL,
  `id` int(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `sast_like`
--

CREATE TABLE IF NOT EXISTS `sast_like` (
  `username` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `islike` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `sast_news`
--

CREATE TABLE IF NOT EXISTS `sast_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `text` text NOT NULL,
  `author` tinytext NOT NULL,
  `timestamp` datetime NOT NULL,
  `img` varchar(128) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- 表的结构 `sast_user`
--

CREATE TABLE IF NOT EXISTS `sast_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `nickname` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `studentnum` tinytext NOT NULL,
  `department` tinytext NOT NULL,
  `major` tinytext NOT NULL,
  `mail` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL DEFAULT '',
  `level` set('1','2','3','4') DEFAULT '',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- 表的结构 `sast_work`
--

CREATE TABLE IF NOT EXISTS `sast_work` (
  `work_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `keyword` tinytext,
  `text` text,
  `author` tinytext,
  `department` tinytext,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
