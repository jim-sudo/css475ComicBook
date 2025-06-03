-- phpMyAdmin SQL Dump
-- version 4.2.4
-- http://www.phpmyadmin.net
--
-- Host: ovid.u.washington.edu:20345
-- Generation Time: May 23, 2019 at 04:58 PM
-- Server version: 5.5.18
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comic_book`
--
CREATE DATABASE IF NOT EXISTS `comic_book_test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `comic_book_test`;

-- --------------------------------------------------------

--
-- Table structure for table `comic_book_issue`
--

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `comic_book_issue_features_character`;
DROP TABLE IF EXISTS `comic_book_issue`;
DROP TABLE IF EXISTS `series`;
SET FOREIGN_KEY_CHECKS = 1;
CREATE TABLE IF NOT EXISTS `comic_book_issue` (
  `IssueID` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `Issue_Number` int(11) NOT NULL DEFAULT '0',
  `Release_date` datetime DEFAULT NULL,
  `SeriesID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `comic_book_issue`
--

INSERT INTO `comic_book_issue` (  `IssueID`, `title`, `description`, `Issue_Number`, `Release_date`) VALUES
(12345, 'Batman Begins', 'Batmans origin story', 1, '2012-01-01 00:00:00'),
(323, 'Flash Debut', 'Flash origin comic', 1, '2014-02-01 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `character`
--

DROP TABLE IF EXISTS `character`;
CREATE TABLE IF NOT EXISTS `character` (
  `CharacterID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `character`
--

INSERT INTO `character` (  `CharacterID`, `name`, `description`) VALUES
(2, 'Batman', 'bruce wayne in a bat costume'),
(4, 'Barry Allen', 'speedster');


-- --------------------------------------------------------

--
-- Table structure for table `comic_book_issue_features_character`
--


CREATE TABLE IF NOT EXISTS `comic_book_issue_features_character` (
  `CharacterID` int(11) NOT NULL DEFAULT '0',
  `IssueID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `comic_book_issue_features_character`
--

INSERT INTO `comic_book_issue_features_character` (  `CharacterID`, `IssueID`) VALUES
(2, '12345'),
(4, '323');


-- --------------------------------------------------------

--
-- Table structure for table `series`
--


CREATE TABLE IF NOT EXISTS `series` (
  `SeriesID` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `series`
-- 
 
INSERT INTO `series` ( `SeriesID`, `title`, `description`) VALUES
(15, 'spiderman series', 'desc'),
(22, 'batman series', 'desc');


-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
