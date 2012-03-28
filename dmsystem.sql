-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2012 at 05:10 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dmsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `milestone` varchar(255) NOT NULL,
  `milestoneType` varchar(255) NOT NULL,
  `plannedDate` date NOT NULL,
  `forcastDate` date NOT NULL,
  `comments` text NOT NULL,
  `achievements` text NOT NULL,
  `keyIssues` text NOT NULL,
  `planForNextPeriod` text NOT NULL,
  `summary` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `projectId`, `milestone`, `milestoneType`, `plannedDate`, `forcastDate`, `comments`, `achievements`, `keyIssues`, `planForNextPeriod`, `summary`) VALUES
(1, 1, 'sprint 1', 'sprint', '2012-03-05', '2012-03-18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac eros vitae neque interdum tincidunt eu et metus. Donec porttitor lorem accumsan lacus sagittis convallis dictum nulla commodo. Maecenas fermentum placerat mauris a dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac eros vitae neque interdum tincidunt eu et metus. Donec porttitor lorem accumsan lacus sagittis convallis dictum nulla commodo. Maecenas fermentum placerat mauris a dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac eros vitae neque interdum tincidunt eu et metus. Donec porttitor lorem accumsan lacus sagittis convallis dictum nulla commodo. Maecenas fermentum placerat mauris a dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac eros vitae neque interdum tincidunt eu et metus. Donec porttitor lorem accumsan lacus sagittis convallis dictum nulla commodo. Maecenas fermentum placerat mauris a dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac eros vitae neque interdum tincidunt eu et metus. Donec porttitor lorem accumsan lacus sagittis convallis dictum nulla commodo. Maecenas fermentum placerat mauris a dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectName` varchar(255) NOT NULL,
  `projectType` varchar(255) NOT NULL,
  `currentMilestone` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectName`, `projectType`, `currentMilestone`, `startDate`, `endDate`) VALUES
(1, 'WDPRO BAR', 'Managed Delevery', 'Release 1.1', '2012-02-27', '2012-03-05'),
(2, 'Disney Careers Portal', 'Managed Delevery', 'Release 8.3', '2012-03-05', '2012-03-12'),
(3, 'DLR IBC', 'Sustainment', 'Release x.y', '2012-03-05', '2012-03-12'),
(4, 'WDW OPS', 'Sustainment', 'Release x.y', '2012-03-05', '2012-03-12');
