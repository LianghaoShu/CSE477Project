-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Host: mysql-user.cse.msu.edu
-- Generation Time: Feb 16, 2015 at 01:46 PM
-- Server version: 5.5.41-0+wheezy1-log
-- PHP Version: 5.4.36-0+deb7u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cbowen`
--

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

DROP TABLE IF EXISTS `breed`;
CREATE TABLE IF NOT EXISTS `breed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3014 ;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`id`, `name`) VALUES
(3009, 'Domestic Shorthair'),
(3010, 'Siamese'),
(3011, 'Persian'),
(3012, 'Manx'),
(3013, 'Sphynx');

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

DROP TABLE IF EXISTS `cat`;
CREATE TABLE IF NOT EXISTS `cat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `age` int(10) NOT NULL,
  `breedid` int(10) NOT NULL,
  `gender` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `name`, `age`, `breedid`, `gender`) VALUES
(101, 'Fluffy', 6, 3011, 'M'),
(103, 'Jennifer', 13, 3009, 'F'),
(104, 'Furball', 8, 3013, 'F'),
(106, 'Skipper', 4, 3011, 'M'),
(107, 'Samantha', 3, 3010, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

DROP TABLE IF EXISTS `own`;
CREATE TABLE IF NOT EXISTS `own` (
  `ownerid` int(10) NOT NULL,
  `catid` int(10) NOT NULL,
  PRIMARY KEY (`ownerid`,`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `own`
--

INSERT INTO `own` (`ownerid`, `catid`) VALUES
(1001, 101),
(1003, 106),
(1007, 104),
(1011, 103),
(1011, 107),
(1012, 103),
(1012, 107);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `last` varchar(40) NOT NULL,
  `first` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1013 ;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `last`, `first`) VALUES
(1001, 'Hall', 'Sam'),
(1003, 'Simon', 'Carly'),
(1007, 'Stinson', 'Barney'),
(1011, 'Farber', 'Warren'),
(1012, 'Farber', 'Karen');

-- --------------------------------------------------------

