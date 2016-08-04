-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-08-04 05:18:17
-- 服务器版本： 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sast`
--

-- --------------------------------------------------------

--
-- 表的结构 `sast_back`
--

CREATE TABLE `sast_back` (
  `mail` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `back_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_comment`
--

CREATE TABLE `sast_comment` (
  `com_id` int(11) NOT NULL,
  `commentor` varchar(255) DEFAULT NULL,
  `islike` int(255) DEFAULT NULL,
  `id` int(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` text,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_like`
--

CREATE TABLE `sast_like` (
  `username` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `islike` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_news`
--

CREATE TABLE `sast_news` (
  `news_id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `keywords` tinytext NOT NULL,
  `text` text NOT NULL,
  `img` tinytext NOT NULL,
  `simple` tinytext NOT NULL,
  `author` tinytext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_talk`
--

CREATE TABLE `sast_talk` (
  `talk_id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `keywords` tinytext NOT NULL,
  `text` text NOT NULL,
  `img` tinytext NOT NULL,
  `simple` tinytext NOT NULL,
  `author` tinytext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_user`
--

CREATE TABLE `sast_user` (
  `uid` int(10) UNSIGNED NOT NULL,
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
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_wiki`
--

CREATE TABLE `sast_wiki` (
  `wiki_id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `keywords` tinytext NOT NULL,
  `text` text NOT NULL,
  `img` tinytext NOT NULL,
  `simple` tinytext NOT NULL,
  `author` tinytext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sast_work`
--

CREATE TABLE `sast_work` (
  `work_id` int(11) UNSIGNED NOT NULL,
  `title` tinytext,
  `keyword` tinytext,
  `text` text,
  `author` tinytext,
  `department` tinytext,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sast_back`
--
ALTER TABLE `sast_back`
  ADD PRIMARY KEY (`back_id`);

--
-- Indexes for table `sast_comment`
--
ALTER TABLE `sast_comment`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `sast_news`
--
ALTER TABLE `sast_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `sast_talk`
--
ALTER TABLE `sast_talk`
  ADD PRIMARY KEY (`talk_id`);

--
-- Indexes for table `sast_user`
--
ALTER TABLE `sast_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `sast_wiki`
--
ALTER TABLE `sast_wiki`
  ADD PRIMARY KEY (`wiki_id`);

--
-- Indexes for table `sast_work`
--
ALTER TABLE `sast_work`
  ADD PRIMARY KEY (`work_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sast_back`
--
ALTER TABLE `sast_back`
  MODIFY `back_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `sast_comment`
--
ALTER TABLE `sast_comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `sast_news`
--
ALTER TABLE `sast_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `sast_talk`
--
ALTER TABLE `sast_talk`
  MODIFY `talk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `sast_user`
--
ALTER TABLE `sast_user`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `sast_wiki`
--
ALTER TABLE `sast_wiki`
  MODIFY `wiki_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `sast_work`
--
ALTER TABLE `sast_work`
  MODIFY `work_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
