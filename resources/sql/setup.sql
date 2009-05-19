-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2009 at 10:19 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zf`
--

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(8192) collate latin1_general_ci NOT NULL,
  `urlkey` varchar(16) collate latin1_general_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `urlkey` (`urlkey`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `urlevent`
--

CREATE TABLE IF NOT EXISTS `urlevent` (
  `id` int(11) NOT NULL auto_increment,
  `url_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `url_id` (`url_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;
