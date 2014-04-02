-- phpMyAdmin SQL Dump
-- version 2.11.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2010 at 10:16 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jmc7tp_artistExchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `Artist`
--

CREATE TABLE `Artist` (
  `id` int(11) NOT NULL,
  `photoFile` varchar(128) collate utf8_bin default NULL,
  `musicFile` varchar(128) collate utf8_bin default NULL,
  `musicMime` varchar(128) collate utf8_bin default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Artist`
--

INSERT INTO `Artist` (`id`, `photoFile`, `musicFile`, `musicMime`) VALUES
(10, NULL, NULL, NULL),
(11, 'Handel.jpg', 'Hallelujah.mp3', 'audio/mpeg'),
(12, 'Mendelssohn.jpg', NULL, NULL),
(13, NULL, 'The_Clock.mp3', 'audio/mpeg'),
(14, 'Vivaldi.jpg', 'La_primavera.mp3', 'audio/mpeg'),
(15, 'Beethoven.jpg', 'Fifth_Symphony.mp3', 'audio/mpeg'),
(16, 'Bach.jpg', 'Toccatta_and_Fugue_in_D_minor.mp3', 'audio/mpeg'),
(17, 'Mozart.jpg', 'Piano_Sonata_K_545.mp3', 'audio/mpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ArtistVote`
--

CREATE TABLE `ArtistVote` (
  `userId` int(11) NOT NULL,
  `artistId` int(11) NOT NULL,
  `voteId` int(11) NOT NULL,
  PRIMARY KEY  (`userId`,`artistId`),
  KEY `artistId` (`artistId`),
  KEY `voteId` (`voteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ArtistVote`
--

INSERT INTO `ArtistVote` (`userId`, `artistId`, `voteId`) VALUES
(1, 11, 1),
(1, 12, 2),
(1, 13, 3),
(14, 12, 3),
(1, 14, 4),
(12, 14, 4),
(15, 14, 4),
(1, 15, 5),
(15, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) collate utf8_bin NOT NULL,
  `email` varchar(64) collate utf8_bin NOT NULL,
  `username` varchar(32) collate utf8_bin NOT NULL,
  `password` char(32) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'doe', '5f4dcc3b5aa765d61d8327deb882cf99'),
(10, 'Hector Berlioz', 'hector.berlioz@example.com', 'berlioz', '5f4dcc3b5aa765d61d8327deb882cf99'),
(11, 'George Frideric Handel', 'george.handel@example.com', 'handel', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 'Felix Mendelssohn', 'felix.mendelssohn@example.com', 'mendelssohn', '5f4dcc3b5aa765d61d8327deb882cf99'),
(13, 'Joseph Haydn', 'joseph.haydn@example.com', 'haydn', '5f4dcc3b5aa765d61d8327deb882cf99'),
(14, 'Antonio Vivaldi', 'antonio.vivaldi@example.com', 'vivaldi', '8b274c5c785aeac4efac16d34f5b9177'),
(15, 'Ludwig van Beethoven', 'ludwig.van.beethoven@example.com', 'beethoven', '76dd7289deee43233b153a7b7bdc1166'),
(16, 'Johann Sebastian Bach', 'johann.bach@example.com', 'bach', 'ac2569b1f966cc624e24c7b908b732ec'),
(17, 'Wolfgang Amadeus Mozart', 'wolfgang.mozart@example.com', 'mozart', '95febafcb2c82d04846fd874e773b708');

-- --------------------------------------------------------

--
-- Table structure for table `Vote`
--

CREATE TABLE `Vote` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(64) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Vote`
--

INSERT INTO `Vote` (`id`, `description`) VALUES
(1, 'Horrible'),
(2, 'Worse than average'),
(3, 'Neutral'),
(4, 'Better than most'),
(5, 'Excellent');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Artist`
--
ALTER TABLE `Artist`
  ADD CONSTRAINT `Artist_ibfk_1` FOREIGN KEY (`id`) REFERENCES `User` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ArtistVote`
--
ALTER TABLE `ArtistVote`
  ADD CONSTRAINT `ArtistVote_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ArtistVote_ibfk_2` FOREIGN KEY (`artistId`) REFERENCES `Artist` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ArtistVote_ibfk_3` FOREIGN KEY (`voteId`) REFERENCES `Vote` (`id`) ON UPDATE CASCADE;
