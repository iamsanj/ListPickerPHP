-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2017 at 03:44 PM
-- Server version: 5.5.52-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intellis_scratch`
--

-- --------------------------------------------------------

--
-- Table structure for table `listpicker_item`
--

CREATE TABLE IF NOT EXISTS `listpicker_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` text NOT NULL,
  `item_name` text NOT NULL,
  `claimed_by` text NOT NULL,
  `updated` int(11) NOT NULL,
  `added` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `listpicker_list`
--

CREATE TABLE IF NOT EXISTS `listpicker_list` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` text NOT NULL,
  `password` text NOT NULL,
  `hash` text NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
