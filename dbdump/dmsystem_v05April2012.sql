-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2012 at 01:22 AM
-- Server version: 5.1.50
-- PHP Version: 5.3.9-ZS5.6.0

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
-- Table structure for table `dms_indicator`
--

DROP TABLE IF EXISTS `dms_indicator`;
CREATE TABLE IF NOT EXISTS `dms_indicator` (
  `dms_indicator_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_indicator_name` varchar(255) NOT NULL,
  `dms_indicator_sort` bigint(20) NOT NULL,
  `dms_indicator_active` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_indicator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dms_indicator`
--

INSERT INTO `dms_indicator` (`dms_indicator_id`, `dms_indicator_name`, `dms_indicator_sort`, `dms_indicator_active`) VALUES
(1, 'Good', 1, '1'),
(2, 'Under Control', 2, '1'),
(3, 'Alert', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dms_projects`
--

DROP TABLE IF EXISTS `dms_projects`;
CREATE TABLE IF NOT EXISTS `dms_projects` (
  `dms_projects_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_projects_name` varchar(255) NOT NULL,
  `dms_projects_projecttype_id` bigint(20) unsigned NOT NULL,
  `dms_projects_start_date` date NOT NULL,
  `dms_projects_end_date` date NOT NULL,
  `dms_projects_objectives` text,
  `dms_projects_indicator_id` bigint(20) unsigned NOT NULL,
  `dms_projects_status_id` bigint(20) unsigned NOT NULL,
  `dms_projects_active` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_projects_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dms_projects`
--

INSERT INTO `dms_projects` (`dms_projects_id`, `dms_projects_name`, `dms_projects_projecttype_id`, `dms_projects_start_date`, `dms_projects_end_date`, `dms_projects_objectives`, `dms_projects_indicator_id`, `dms_projects_status_id`, `dms_projects_active`) VALUES
(1, 'Careers Portal', 1, '2011-01-03', '2012-10-30', 'Develop a Careers Site of diffrent brand and business of client', 1, 1, '1'),
(2, 'Vacation club', 2, '2010-04-05', '2012-07-09', 'objective to provide sustainment support.', 1, 1, '1'),
(3, 'BAR WDW', 1, '2011-09-09', '2012-03-30', 'objective to setup bar option', 1, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dms_project_type`
--

DROP TABLE IF EXISTS `dms_project_type`;
CREATE TABLE IF NOT EXISTS `dms_project_type` (
  `dms_projecttype_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_projecttype_name` varchar(255) NOT NULL,
  `dms_projecttype_alias` varchar(255) DEFAULT NULL,
  `dms_projecttype_sort` bigint(20) NOT NULL,
  `dms_projecttype_active` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_projecttype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dms_project_type`
--

INSERT INTO `dms_project_type` (`dms_projecttype_id`, `dms_projecttype_name`, `dms_projecttype_alias`, `dms_projecttype_sort`, `dms_projecttype_active`) VALUES
(1, 'Application Development', 'AD', 1, '1'),
(2, 'Application Sustainment', 'AM', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dms_releases`
--

DROP TABLE IF EXISTS `dms_releases`;
CREATE TABLE IF NOT EXISTS `dms_releases` (
  `dms_releases_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_releases_projects_id` bigint(20) unsigned NOT NULL,
  `dms_releases_name` varchar(255) NOT NULL,
  `dms_releases_start_date` date NOT NULL,
  `dms_releases_cutoff_date` date NOT NULL,
  `dms_releases_end_date` date NOT NULL,
  `dms_releases_objectives` text,
  `dms_releases_riskinfo` text,
  `dms_releases_indicator_id` bigint(20) unsigned NOT NULL,
  `dms_releases_status_id` bigint(20) unsigned NOT NULL,
  `dms_releases_active` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_releases_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dms_releases`
--

INSERT INTO `dms_releases` (`dms_releases_id`, `dms_releases_projects_id`, `dms_releases_name`, `dms_releases_start_date`, `dms_releases_cutoff_date`, `dms_releases_end_date`, `dms_releases_objectives`, `dms_releases_riskinfo`, `dms_releases_indicator_id`, `dms_releases_status_id`, `dms_releases_active`) VALUES
(1, 1, 'Release 9', '2011-12-19', '2012-01-20', '2012-01-24', 'Enhancement and work relate to content changes in different brand careers site', 'No major issue at present', 1, 2, '1'),
(2, 1, 'Release 10', '2012-01-23', '2012-02-29', '2012-03-05', 'Enhancement and some low priority defect fixes', 'No risk at present release', 1, 2, '1'),
(3, 1, 'Release 11', '2012-03-01', '2012-03-29', '2012-04-02', 'New brand site development with single page and integrate with live site.', 'No risk at present site', 1, 2, '1'),
(4, 1, 'Release 12', '2012-03-30', '2012-04-12', '2012-04-24', 'Some changes in already developed tool', 'No risk at present', 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dms_sprints`
--

DROP TABLE IF EXISTS `dms_sprints`;
CREATE TABLE IF NOT EXISTS `dms_sprints` (
  `dms_sprints_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_sprints_releases_id` bigint(20) unsigned NOT NULL,
  `dms_sprints_name` varchar(255) NOT NULL,
  `dms_sprints_start_date` date NOT NULL,
  `dms_sprints_cutoff_date` date NOT NULL,
  `dms_sprints_end_date` date NOT NULL,
  `dms_sprints_objectives` text,
  `dms_sprints_riskinfo` text,
  `dms_sprints_indicator_id` bigint(20) unsigned NOT NULL,
  `dms_sprints_status_id` bigint(20) unsigned NOT NULL,
  `dms_sprints_active` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_sprints_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dms_sprints`
--

INSERT INTO `dms_sprints` (`dms_sprints_id`, `dms_sprints_releases_id`, `dms_sprints_name`, `dms_sprints_start_date`, `dms_sprints_cutoff_date`, `dms_sprints_end_date`, `dms_sprints_objectives`, `dms_sprints_riskinfo`, `dms_sprints_indicator_id`, `dms_sprints_status_id`, `dms_sprints_active`) VALUES
(1, 1, 'Sprint 1', '2011-12-19', '2012-01-20', '2012-01-20', 'Enhancement', 'No major risk or issues available', 1, 2, '1'),
(2, 2, 'Sprint 1', '2012-01-23', '2012-02-29', '2012-02-29', 'Enhancement', 'No major risk or issues available', 1, 2, '1'),
(3, 3, 'Sprint 1', '2012-03-01', '2012-03-13', '2012-03-13', 'Enhancement and new site implementation', 'No major risks and issues available', 1, 2, '1'),
(4, 3, 'Sprint 2', '2012-03-14', '2012-03-29', '2012-03-29', 'Enhancement and content changes', 'No major risks or issues identified', 1, 2, '1'),
(5, 4, 'Sprint 1', '2012-03-30', '2012-04-11', '2012-04-27', 'Enhancement & objective', 'No major risks & issues identified', 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dms_sprints_log`
--

DROP TABLE IF EXISTS `dms_sprints_log`;
CREATE TABLE IF NOT EXISTS `dms_sprints_log` (
  `dms_sprintslog_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_sprintslog_sprints_id` bigint(20) unsigned NOT NULL,
  `dms_sprintslog_estimated` bigint(20) NOT NULL,
  `dms_sprintslog_dev` bigint(20) NOT NULL,
  `dms_sprintslog_test` bigint(20) NOT NULL,
  `dms_sprintslog_stories` bigint(20) NOT NULL,
  `dms_sprintslog_storypoints` bigint(20) NOT NULL,
  `dms_sprintslog_majordefects` bigint(20) NOT NULL,
  `dms_sprintslog_minordefects` bigint(20) NOT NULL,
  `dms_sprintslog_reworkdev` bigint(20) NOT NULL,
  `dms_sprintslog_reworktest` bigint(20) NOT NULL,
  `dms_sprintslog_nonspe` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`dms_sprintslog_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dms_sprints_log`
--

INSERT INTO `dms_sprints_log` (`dms_sprintslog_id`, `dms_sprintslog_sprints_id`, `dms_sprintslog_estimated`, `dms_sprintslog_dev`, `dms_sprintslog_test`, `dms_sprintslog_stories`, `dms_sprintslog_storypoints`, `dms_sprintslog_majordefects`, `dms_sprintslog_minordefects`, `dms_sprintslog_reworkdev`, `dms_sprintslog_reworktest`, `dms_sprintslog_nonspe`) VALUES
(1, 1, 370, 145, 115, 7, 13, 3, 7, 32, 25, 40),
(2, 2, 425, 202, 156, 5, 16, 0, 2, 15, 12, 35),
(3, 3, 405, 145, 115, 11, 26, 4, 7, 65, 35, 45),
(4, 4, 380, 149, 124, 8, 17, 2, 1, 25, 10, 40),
(5, 5, 415, 100, 95, 6, 12, 2, 1, 28, 20, 24);

-- --------------------------------------------------------

--
-- Table structure for table `dms_status`
--

DROP TABLE IF EXISTS `dms_status`;
CREATE TABLE IF NOT EXISTS `dms_status` (
  `dms_status_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_status_name` varchar(255) NOT NULL,
  `dms_status_sort` bigint(20) NOT NULL,
  `dms_status_active` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dms_status`
--

INSERT INTO `dms_status` (`dms_status_id`, `dms_status_name`, `dms_status_sort`, `dms_status_active`) VALUES
(1, 'In Progress', 1, '1'),
(2, 'Completed', 2, '1'),
(3, 'Not Started', 3, '1'),
(4, 'Rescheduled', 4, '1'),
(5, 'Hold', 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dms_users`
--

DROP TABLE IF EXISTS `dms_users`;
CREATE TABLE IF NOT EXISTS `dms_users` (
  `dms_users_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dms_users_firstname` varchar(255) NOT NULL,
  `dms_users_lastname` varchar(255) DEFAULT NULL,
  `dms_users_username` varchar(255) NOT NULL,
  `dms_users_password` varchar(255) NOT NULL,
  `dms_users_email` varchar(255) NOT NULL,
  `dms_users_status` enum('0','1','2') NOT NULL DEFAULT '1',
  PRIMARY KEY (`dms_users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dms_users`
--

INSERT INTO `dms_users` (`dms_users_id`, `dms_users_firstname`, `dms_users_lastname`, `dms_users_username`, `dms_users_password`, `dms_users_email`, `dms_users_status`) VALUES
(1, 'Administrator', NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@dmsystem123.com', '1');
