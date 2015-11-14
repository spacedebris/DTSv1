-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2015 at 08:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dts`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `verification`, `isadmin`) VALUES
(2, 'Marek', 'Kozlowski', 'kozlowskimarekamil@gmail.com', 'e061c9aea5026301e7b3ff09e9aca2cf', '84175bd99c6e10cf5b76b271edc33f5c', 1),
(3, 'Irina', 'Tweedie', 'irina@gmail.com', '6f7fd4324bfad39ae260c84609f89566', 'fd7955cf3113de5d39b4b7ee37d8af8e', 0),
(4, 'Bartek', 'Bartosiewicz', 'bartek@bartek.com', 'e061c9aea5026301e7b3ff09e9aca2cf', 'eec6d62a9666eea249b1d247b58725ca', 0),
(5, 'bar', 'masd', 'mad@ma', '0bde667aa88e8832b61bf68c0d4e34a4', 'bdbe767d789c0a71121d10380397e627', 0),
(6, 'Alice', 'Coltrane', 'alice', '6384e2b2184bcbf58eccf10ca7a6563c', '56cf1ff6b536a99c08d716cc4ebd5fdf', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
