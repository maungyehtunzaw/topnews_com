-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2014 at 07:55 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `topnew2`
--
CREATE DATABASE IF NOT EXISTS `topnew2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `topnew2`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_name` enum('Mg','U','Ma','Daw') DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` enum('acive','pending','block') NOT NULL,
  `gender` enum('Female','Male','Undisclose') DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `address` varchar(350) DEFAULT NULL,
  `user_lvl` enum('boss','editor','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `pre_name`, `name`, `username`, `email`, `password`, `status`, `gender`, `phone`, `address`, `user_lvl`) VALUES
(1, 'Mg', 'Ye Htun', 'yeye', 'maungyehtunzaw@gmail.com', '$2y$12$62431748395380c2b33dcu3rYc6IT/YxNqJ8R9ESHMq2S58FX8pGK', 'acive', 'Male', 931463155, 'taze', 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `click_count` varchar(45) DEFAULT NULL,
  `view_count` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `keyword_` varchar(45) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `exp_date` datetime DEFAULT NULL,
  `type_` varchar(45) DEFAULT NULL,
  `status` enum('enable','disable','expire') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `status` enum('enable','disable','delete') DEFAULT 'enable',
  `view_count` int(11) DEFAULT NULL,
  `c_date` datetime NOT NULL,
  `keyword_` varchar(45) DEFAULT NULL,
  `cat_lvl` enum('top','second','third','fourth') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `parent_id`, `status`, `view_count`, `c_date`, `keyword_`, `cat_lvl`) VALUES
(1, 'National News', 0, 'enable', 200, '2014-08-21 00:00:00', 'National , Myanmar News, Burma', 'top'),
(2, 'Sport News', 0, 'enable', 30, '2014-08-21 00:00:00', 'Sport, MNL, Soccer, Football, Baseball', 'top'),
(3, 'Techlogy & Science', 0, 'enable', 0, '2014-08-21 00:00:00', 'Techlogy , Science, နည္းပညာ', 'top'),
(4, 'Health', 0, 'enable', 232, '0000-00-00 00:00:00', NULL, 'top'),
(5, 'Politics', 0, 'enable', 0, '2014-08-21 00:00:00', 'Myanmar Politics', 'top'),
(6, 'Knowledge', 0, 'enable', 11, '2014-08-21 00:00:00', 'Knowledge', 'top'),
(7, 'Myanmar', 2, 'enable', 55, '0000-00-00 00:00:00', 'Myanmar Football, Soccer', 'second'),
(8, 'England', 2, 'enable', 60, '0000-00-00 00:00:00', NULL, 'second'),
(9, 'Premier League', 8, 'enable', 200, '2014-08-21 00:00:00', NULL, 'third'),
(10, 'League Champianship', 8, 'enable', 40, '2014-08-21 00:00:00', NULL, 'third'),
(11, 'Crown News', 0, 'enable', 21, '2014-09-06 00:00:00', 'Crown', 'top');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `thumb_url` varchar(150) DEFAULT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `JID` int(11) DEFAULT NULL COMMENT 'id of link',
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='store all image to this table and link to other image need tables' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `url`, `thumb_url`, `caption`, `c_date`, `JID`, `type`) VALUES
(1, 'newsimg/koo-hye-sun.jpg', 'newsimg/thumbs/koo-hye-sun.jpg', 'i like this song so much', '2014-08-21 00:00:00', 1, 'news'),
(2, 'newsimg/knowledge_1.jpg', 'newsimg/thumbs/knowledge_1.jpg', 'test a life', '2014-08-22 10:27:33', 2, 'news'),
(3, 'newsimg/knowledge_2.jpg', 'newsimg/thumbs/knowledge_1.jpg', 'knowledge2', '2014-08-22 10:38:00', 3, 'news'),
(4, 'newsimg/rambo.jpg', 'newsimg/thumbs/rambo.jpg', 'The Rambo want to be A captain @ Arsenal', '2014-08-26 11:00:00', 6, 'news'),
(5, 'newsimg/ozil.jpg', 'newsimg/thumbs/ozil.jpg', 'newsimg/thumbs/ozil.jpg', '2014-08-26 00:00:00', 7, 'news'),
(7, '../newsimg/1409677567.jpg', '../newsimg/thumbs/thumb_1409677567.jpg', 'ye htun  zaw', NULL, NULL, NULL),
(8, 'newsimg/1409756184.jpg', 'newsimg/thumbs/thumb_1409756184.jpg', 'go hell', NULL, NULL, NULL),
(9, 'newsimg/1409757913.png', 'newsimg/thumbs/thumb_1409757913.png', 'new facebook ico intro', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) NOT NULL,
  `imgid` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `keyword_` varchar(45) NOT NULL,
  `view_count` int(11) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `c_date` datetime NOT NULL,
  `status` enum('enable','disable','pending','delete') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_news_admin1_idx` (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `adminid`, `imgid`, `title`, `content`, `tags`, `keyword_`, `view_count`, `description`, `c_date`, `status`) VALUES
(1, 1, 1, 'Leann Rimes – But I Do Love You Lyric', 'Leann Rimes – But I Do Love You Lyrics\r\nSend "But I Do Love You" Ringtone to your Cell\r\nSongwriters: WARREN, DIANE\r\n\r\nI don''t like to be alone in the night\r\nAnd I don''t like to hear I''m wrong when I''m right\r\nAnd I don''t like to have the rain on my shoes\r\nBut I do love you, but I do love you\r\n\r\nI don''t like to see the sky painted gray\r\nAnd I don''t like when nothing''s going my way\r\nAnd I don''t like to be the one with the blues\r\nBut I do love you, but I do love you\r\n\r\nLove everything about the way you''re loving me\r\nThe way you lay your head\r\nUpon my shoulder when you sleep\r\nAnd I love to kiss you in the rain\r\nI love everything you do, oh I do\r\n\r\nI don''t like to turn the radio on,\r\nJust to find I missed my favorite song\r\nAnd I don''t like to be the last with the news\r\nBut I do love you, but I do love you\r\n\r\nLove everything about the way you''re loving me\r\nThe way you lay your head\r\nUpon my shoulder when you sleep\r\nAnd I love to kiss you in the rain,\r\nI love everything you do, oh I do\r\n\r\nAnd I don''t like to be alone in the night\r\nAnd I don''t like to hear I''m wrong when I''m right\r\nAnd I don''t like to have the rain on my shoes\r\nBut I do love you, but I do love you\r\nBut I do love you, but I do love you', 'lyrics, songs, ', 'Leann Rimes – But I Do Love You Lyrics', 0, 'Leann Rimes – But I Do Love You Lyrics', '2013-08-21 00:00:00', 'enable'),
(2, 1, 2, 'Knowledge Article News ', '\r\ni don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.', 'knowledge, mylife, test', 'knowledge, mylife, test', 20, 'knowledge of a life', '2014-08-21 00:00:00', 'enable'),
(3, 1, 3, 'ျမန္မာ စာရလား', 'Help is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.\r\nHelp is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.Help is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.Help is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.', 'Help, Love', 'help, test', 20, 'Knowledge', '2014-08-22 00:00:00', 'enable'),
(4, 1, 3, 'How to train your knowledge of the life\r\nknowledge3_', 'Help is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.\r\nHelp is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.Help is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.Help is come from above. \r\nHelp is come from heaven\r\nDo you know a life without lucky\r\nPlease don''t make kidding me.', 'Help, Love', 'help, test', 20, 'Knowledge', '2014-08-22 11:18:24', 'enable'),
(5, 1, 2, 'Knowledge Article News 4 knowledge', '\r\ni don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.i don''t know how to try my life. \r\ndon''t haste my life on wifi.', 'knowledge, mylife, test', 'knowledge, mylife, test', 20, 'knowledge of a life', '2014-08-21 00:00:00', 'enable'),
(6, 1, 4, 'Ramsey will be captain onday, by Winger', 'I love Arsenal . i am fans of Arsenal\r\nI only love Arsenal....\r\nIf you are not AFC fans, we do not need to fight \r\nI love Arsenal . i am fans of Arsenal\r\nI only love Arsenal....\r\nIf you are not AFC fans, we do not need to fight \r\nI love Arsenal . i am fans of Arsenal\r\nI only love Arsenal....\r\nIf you are not AFC fans, we do not need to fight \r\nI love Arsenal . i am fans of Arsenal\r\nI only love Arsenal....\r\nIf you are not AFC fans, we do not need to fight \r\nI love Arsenal . i am fans of Arsenal\r\nI only love Arsenal....\r\nIf you are not AFC fans, we do not need to fight ', 'Ramsey, Arsenal, Soccser, ', 'Ramsey, Arsenal, Soccser, ', 22, 'Ramsey, Arsenal, Soccser, ', '2014-08-26 11:00:00', 'enable'),
(7, 1, 5, 'Arseanl Big Deal to Ozil from Real Marid -Transfer Talk', 'The Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is OzilThe Biggest Deal of AFC transfer is Ozil', 'Ozil, AFC, Arsenal,', 'Ozil, AFC, Arsenal,Premier League', 22, 'Arsenal Got Ozil', '2014-08-26 00:00:00', 'enable'),
(8, 1, 7, 'i will love you', '<blockquote><div align="center"><b>hello goodeness<br></b></div></blockquote>', 'this first', 'test1', NULL, 'test1 des', '0000-00-00 00:00:00', 'enable'),
(9, 1, 8, 'Myanmar News: May Myant Know Crown is rebust to', '<b>may myat know''s crown is reback to miss international group<br></b><font color="#66CC00">ဖင္ေျပာင္တာပဲ အဖတ္တင္ပါတယ္ေအ့ ဟု ေဖဘုတ္ယူဆာမ်ား ေျပာၾကား</font><br><h2></h2>', 'Myanmar', 'Myanmar', NULL, 'I love Myanmar', '0000-00-00 00:00:00', 'enable'),
(10, 1, 9, 'test, knowledge', 'facebook are popular today<br>i need to<span style="background-color: rgb(102, 51, 51);"><b> know </b></span>is all the love<br>do you feel the same<br><ol><li>Facebook</li><li>Twitter</li><li>Google+</li><li>Pinterest</li><li>Instagram</li><li>WeHeartIt</li><li>Tumblr</li><li>Yahoo<br></li></ol><div align="justify"><ol></ol></div>', 'facebook new ic: i will grow more than yestersday, exp', 'experience, test', NULL, 'test me', '0000-00-00 00:00:00', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `newscat`
--

CREATE TABLE IF NOT EXISTS `newscat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_news_has_category_category1_idx` (`catid`),
  KEY `fk_news_has_category_news1_idx` (`newsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `newscat`
--

INSERT INTO `newscat` (`id`, `newsid`, `catid`) VALUES
(1, 1, 1),
(2, 5, 3),
(3, 3, 4),
(4, 2, 5),
(5, 2, 6),
(6, 4, 6),
(7, 6, 9),
(8, 7, 9),
(9, 8, 2),
(10, 9, 7),
(11, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsid` int(11) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `rate` tinyint(4) DEFAULT NULL,
  `date` datetime NOT NULL,
  `message` varchar(250) DEFAULT NULL,
  `pluspoint` int(11) DEFAULT NULL,
  `minuspoint` int(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL COMMENT 'report email news',
  `issue` tinyint(4) DEFAULT NULL COMMENT 'for array id ',
  PRIMARY KEY (`id`),
  KEY `fk_rating_news1_idx` (`newsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `c_date` datetime NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`id`, `keyword`, `c_date`, `ip`) VALUES
(1, 'test', '2014-08-23 23:46:53', '::1'),
(2, 'test', '2014-08-26 23:43:48', '::1'),
(3, 'test', '2014-08-26 23:43:58', '::1'),
(4, 'test', '2014-09-01 22:48:01', '::1'),
(5, 'test', '2014-09-01 22:48:08', '::1'),
(6, 'test', '2014-09-03 23:43:34', '::1'),
(7, 'test', '2014-09-03 23:44:35', '::1'),
(8, 'test', '2014-09-03 23:46:37', '::1'),
(9, 'test', '2014-09-03 23:46:49', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE IF NOT EXISTS `subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` enum('pending','active','disable','delete') DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `email_code` varchar(150) DEFAULT NULL,
  `pin` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `type` enum('allcat','cust') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `name`, `status`, `c_date`, `updated`, `email_code`, `pin`, `ip`, `type`) VALUES
(1, 'maungyehtunzaw@gmail.com', 'yeye', 'active', '2014-08-25 00:00:00', '2014-08-27 10:04:27', 'yeye_53fd46e29f6686.51034694', 0, '', 'allcat'),
(2, 'yeye@gmail.com', 'yeye', 'pending', '2014-08-27 09:18:02', '0000-00-00 00:00:00', 'yeye_53fd46e29f6686.51034694', 0, '::1', 'allcat'),
(9, 'apple@gmail.com', NULL, 'pending', '2014-08-27 16:46:51', NULL, 'yeye_53fdb0133924d2.36958201', 6406, '::1', 'cust'),
(10, 'apple111@gmail.com', NULL, 'pending', '2014-08-27 16:49:14', NULL, 'yeye_53fdb0a27f8119.25862892', 8593, '::1', 'cust'),
(11, 'apple11@gmail.com', NULL, 'pending', '2014-08-27 16:57:24', NULL, 'yeye_53fdb28cda5603.71028047', 6670, '::1', 'cust'),
(12, 'apple1111@gmail.com', NULL, 'pending', '2014-08-27 17:45:36', NULL, 'yeye_53fdbdd8d781d5.06018483', 5359, '::1', 'cust'),
(13, 'manetphyan@gmail.com', NULL, 'pending', '2014-08-27 17:50:35', NULL, 'yeye_53fdbf0304d390.23138629', 6433, '::1', 'cust'),
(14, 'fullmoon.set26@gmail.com', NULL, 'pending', '2014-08-27 19:28:14', NULL, 'yeye_53fdd5e6254408.29308273', 0, '::1', 'allcat');

-- --------------------------------------------------------

--
-- Table structure for table `usercat`
--

CREATE TABLE IF NOT EXISTS `usercat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'subscriber id',
  `cat_id` int(11) NOT NULL COMMENT 'category id',
  `status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subscriber_has_category_category1_idx` (`cat_id`),
  KEY `fk_subscriber_has_category_subscriber1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `usercat`
--

INSERT INTO `usercat` (`id`, `user_id`, `cat_id`, `status`) VALUES
(3, 10, 8, NULL),
(4, 10, 3, NULL),
(5, 10, 9, NULL),
(6, 12, 10, NULL),
(7, 13, 10, NULL),
(8, 13, 8, NULL),
(9, 13, 7, NULL),
(10, 13, 2, NULL),
(11, 13, 3, NULL),
(12, 13, 5, NULL),
(13, 13, 9, NULL),
(14, 13, 1, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_admin1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `newscat`
--
ALTER TABLE `newscat`
  ADD CONSTRAINT `fk_news_has_category_category1` FOREIGN KEY (`catid`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_news_has_category_news1` FOREIGN KEY (`newsid`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_news1` FOREIGN KEY (`newsid`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usercat`
--
ALTER TABLE `usercat`
  ADD CONSTRAINT `fk_subscriber_has_category_category1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subscriber_has_category_subscriber1` FOREIGN KEY (`user_id`) REFERENCES `subscriber` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
