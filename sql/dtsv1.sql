-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2016 at 05:15 PM
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
CREATE DATABASE IF NOT EXISTS `dtsv1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dtsv1`;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id_group` int(10) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id_task`, `title`, `content`, `tags`, `created`, `createdby`) VALUES
(2, 'Zadanie testowe 2', '<p>sprawdzam dlugosc tekstu oraz</p>\r\n\r\n<h2 style="font-style:italic;"><strong>formatowanie</strong></h2>\r\n', 'temporary no tags', '2016-02-15 12:15:14', 'kozlowskimarekamil@gmail.com'),
(4, 'test2', '<p>ahoj</p>\r\n', 'temporary no tags', '2016-02-15 17:14:24', 'kozlowskimarekamil@gmail.com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=64 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `verification`, `isadmin`) VALUES
(63, 'Marek', 'KozÅ‚owski', 'kozlowskimarekamil@gmail.com', '$2y$10$OrcFL/5m4oAL0zwo.5/B0.551QBwHpPIISbUGG1sYCYS5N49.6wdO', 'Yes', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
