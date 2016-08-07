-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2016 at 09:24 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dtsv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tasks_qty` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `createdby` varchar(255) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id_group`, `name`, `tasks_qty`, `created`, `createdby`) VALUES
(30, 'augustÃ³w', 0, '2016-02-14 00:00:00', 'kozlowskimarekamil@gmail.com'),
(33, 'test date', 0, '2016-02-14 14:15:23', 'kozlowskimarekamil@gmail.com'),
(34, 'nono', 0, '2016-02-15 10:06:13', 'kozlowskimarekamil@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `tags` varchar(400) DEFAULT NULL,
  `created` datetime NOT NULL,
  `createdby` varchar(255) NOT NULL,
  PRIMARY KEY (`id_task`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id_task`, `title`, `content`, `tags`, `created`, `createdby`) VALUES
(2, 'Zadanie testowe 2', '<p>sprawdzam dlugosc tekstu oraz</p>\r\n\r\n<h2 style="font-style:italic;"><strong>formatowanie</strong></h2>\r\n', 'temporary no tags', '2016-02-15 12:15:14', 'kozlowskimarekamil@gmail.com'),
(3, 'test2', '<blockquote>\r\n<ul>\r\n	<li><s>asdasdaasda</s>assdasd</li>\r\n	<li>sadasddddddddddddddd</li>\r\n</ul>\r\n</blockquote>\r\n', 'temporary no tags', '2016-05-10 08:59:20', 'fiodor@dostojewski.ru');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `verification` varchar(255) CHARACTER SET latin1 NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=73 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `verification`, `isadmin`) VALUES
(63, 'Marek', 'KozÅ‚owski', 'kozlowskimarekamil@gmail.com', '$2y$10$9/BBwUdm3Pq9HlrgKdtHdeNV8GxsmN/.FpDbQqgX5IDCsizvn0sLu', 'Yes', 1),
(64, 'Michel', 'Petrucciani', 'michel@petrucciani.com', '$2y$10$Xwoso.inbYimhQWrifQyX.x80kRI65iFMKZ/W1GRJuhQITide0HuO', 'Yes', 0),
(65, 'Fiodor ', 'Dostojewski', 'fiodor@dostojewski.ru', '$2y$10$lDBPr7h9sZ5VWAyLYR.6HOPYvCI4ntdou4UaOra4lE3dD4W3uTyS6', 'Yes', 0),
(66, 'Marek', 'KozÅ‚owski', 'kontakt@kozlowskimarek.pl', '$2y$10$2y6JtDOs/Ick.TFJyJM76.r7368IJuyiKa/cuW8ezhA49F0qHx9VO', 'Yes', 1),
(67, 'Tadeusz', 'RÃ³Å¼ewicz', 'tadek@rozewicz.pl', '$2y$10$SKFWsn5Hyqax9I91GRxxauOi/Ro6vBeaXnI5PWjFWoYoDJfoeceym', 'Yes', 0),
(68, 'Alina', 'Bendiuk', 'alina@apli.com', '$2y$10$AQ3cAUd6K/7iCMC9EKHfsulgt9fWAVUB1gwnoTjK5Q4iDhKpkJEga', '6e2ce1b2d33d9a9ea1c538b4ad8a34ef', 0),
(70, 'Gynvael ', 'Coldwind', 'gynvael@coldwind.com', '$2y$10$3XszpJMRivViEJwouiUQ/eAzXgPDwFh6y3p0ZYe2gAaaS250h.7Ei', '46077c1a5b6f714c89bc1b384854b0d1', 0),
(71, 'asdasd', 'asdasd', 'asdasdas@da', '$2y$10$aVNgzW8D2mNADw7YAmsPyOr9aX8Nl7T/9Nd1u69Z9TCl4I/ytiVqa', '40924efd9f3dc57f9bb0d3eccf783c32', 0),
(72, 'asd', 'asd', 'alina@aplia.com', '$2y$10$q1YUFJa7bW5HYLL0afvb9O9hPLcmpwqHahC9wmr8NqHA.61rJCkXm', '7ad26c5f1e5867feb483ea7f53916171', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tagmap`
--

CREATE TABLE IF NOT EXISTS `tagmap` (
  `id_tagmap` int(11) NOT NULL AUTO_INCREMENT,
  `id_tag` int(11) NOT NULL,
  `id_tasks` int(11) NOT NULL,
  PRIMARY KEY (`id_tagmap`),
  UNIQUE KEY `id_tagmap` (`id_tagmap`),
  KEY `id_tagmap_2` (`id_tagmap`),
  KEY `id_tag` (`id_tag`),
  KEY `id_tag_2` (`id_tag`),
  KEY `id_tasks` (`id_tasks`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


ALTER TABLE `tagmap`
  ADD CONSTRAINT `tagmap_ibfk_2` FOREIGN KEY (`id_tasks`) REFERENCES `tasks` (`id_task`),
  ADD CONSTRAINT `tagmap_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




