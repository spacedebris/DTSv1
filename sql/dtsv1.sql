-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2016 at 05:59 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtsv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id_group` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tasks_qty` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `createdby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id_group`, `name`, `tasks_qty`, `created`, `createdby`) VALUES
(30, 'augustów', 0, '2016-02-14 00:00:00', 'kozlowskimarekamil@gmail.com'),
(33, 'test date', 0, '2016-02-14 14:15:23', 'kozlowskimarekamil@gmail.com'),
(34, 'ążźć', 0, '2016-02-15 10:06:13', 'kozlowskimarekamil@gmail.com'),
(35, 'ółćźż', 0, '2016-06-27 22:40:23', 'kozlowskimarekamil@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tagmap`
--

CREATE TABLE `tagmap` (
  `id_tagmap` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `id_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tagmap`
--

INSERT INTO `tagmap` (`id_tagmap`, `id_tag`, `id_task`) VALUES
(0, 0, 0),
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(10) UNSIGNED NOT NULL,
  `tag_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `tags` varchar(400) DEFAULT NULL,
  `created` datetime NOT NULL,
  `createdby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id_task`, `title`, `content`, `tags`, `created`, `createdby`) VALUES
(1, 'sda', '<p>asdads</p>\r\n', 'temporary no tags', '2016-08-01 18:26:16', 'kozlowskimarekamil@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `verification` varchar(255) CHARACTER SET latin1 NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `verification`, `isadmin`) VALUES
(63, 'Marek', 'Koz?owski', 'kozlowskimarekamil@gmail.com', '$2y$10$9/BBwUdm3Pq9HlrgKdtHdeNV8GxsmN/.FpDbQqgX5IDCsizvn0sLu', 'Yes', 1),
(64, 'Michel', 'Petrucciani', 'michel@petrucciani.com', '$2y$10$Xwoso.inbYimhQWrifQyX.x80kRI65iFMKZ/W1GRJuhQITide0HuO', 'Yes', 0),
(65, 'Fiodor ', 'Dostojewski', 'fiodor@dostojewski.ru', '$2y$10$lDBPr7h9sZ5VWAyLYR.6HOPYvCI4ntdou4UaOra4lE3dD4W3uTyS6', 'Yes', 0),
(66, 'Marek', 'KozÅ‚owski', 'kontakt@kozlowskimarek.pl', '$2y$10$2y6JtDOs/Ick.TFJyJM76.r7368IJuyiKa/cuW8ezhA49F0qHx9VO', 'Yes', 1),
(67, 'Tadeusz', 'RÃ³Å¼ewicz', 'tadek@rozewicz.pl', '$2y$10$SKFWsn5Hyqax9I91GRxxauOi/Ro6vBeaXnI5PWjFWoYoDJfoeceym', 'Yes', 0),
(68, 'Alina', 'Bendiuk', 'alina@apli.com', '$2y$10$AQ3cAUd6K/7iCMC9EKHfsulgt9fWAVUB1gwnoTjK5Q4iDhKpkJEga', '6e2ce1b2d33d9a9ea1c538b4ad8a34ef', 0),
(70, 'Gynvael ', 'Coldwind', 'gynvael@coldwind.com', '$2y$10$3XszpJMRivViEJwouiUQ/eAzXgPDwFh6y3p0ZYe2gAaaS250h.7Ei', '46077c1a5b6f714c89bc1b384854b0d1', 0),
(71, 'asdasd', 'asdasd', 'asdasdas@da', '$2y$10$aVNgzW8D2mNADw7YAmsPyOr9aX8Nl7T/9Nd1u69Z9TCl4I/ytiVqa', '40924efd9f3dc57f9bb0d3eccf783c32', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `tagmap`
--
ALTER TABLE `tagmap`
  ADD PRIMARY KEY (`id_tagmap`),
  ADD UNIQUE KEY `id_task` (`id_task`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id_group` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`id_task`) REFERENCES `tagmap` (`id_task`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
