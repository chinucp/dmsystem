-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2012 at 06:50 AM
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
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `projects_id` bigint(20) unsigned NOT NULL,
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `users_id`, `projects_id`, `last_updated_date`, `effective_end_date`) VALUES
(1, 1, 1, '2012-03-31 21:06:20', '0000-00-00'),
(2, 2, 1, '2012-03-31 21:06:20', '0000-00-00'),
(3, 3, 1, '2012-03-31 21:06:20', '0000-00-00'),
(4, 6, 1, '2012-03-31 21:06:20', '0000-00-00'),
(5, 7, 1, '2012-03-31 21:06:20', '0000-00-00'),
(6, 8, 1, '2012-03-31 21:06:20', '0000-00-00'),
(7, 10, 1, '2012-03-31 21:06:20', '0000-00-00'),
(8, 1, 2, '2012-03-31 21:06:20', '0000-00-00'),
(9, 2, 2, '2012-03-31 21:06:20', '0000-00-00'),
(10, 4, 2, '2012-03-31 21:06:20', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `sort_order`, `last_updated_date`, `effective_end_date`) VALUES
(1, 'Delivery Unit Lead', 1, '2012-03-31 19:02:21', '0000-00-00'),
(2, 'Manager', 2, '2012-03-31 19:02:21', '0000-00-00'),
(3, 'Assistant Manager', 3, '2012-03-31 19:02:21', '0000-00-00'),
(4, 'Team Lead', 4, '2012-03-31 19:02:21', '0000-00-00'),
(5, 'Senior Software Engineer', 5, '2012-03-31 19:04:02', '0000-00-00'),
(6, 'Software Engineer', 6, '2012-03-31 19:02:21', '0000-00-00'),
(7, 'Assistant Software Engineer', 7, '2012-03-31 19:03:45', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

DROP TABLE IF EXISTS `indicators`;
CREATE TABLE IF NOT EXISTS `indicators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `indicator` varchar(50) NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `indicator`, `sort_order`, `last_updated_date`, `effective_end_date`) VALUES
(1, 'Good', 1, '2012-03-31 13:32:21', '0000-00-00'),
(2, 'Under Control', 2, '2012-03-31 13:32:21', '0000-00-00'),
(3, 'Alert', 3, '2012-03-31 13:32:21', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_types_id` bigint(20) unsigned NOT NULL,
  `project_statuses_id` bigint(20) unsigned NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_types_id`, `project_statuses_id`, `name`, `description`, `start_date`, `end_date`, `status`, `last_updated_date`, `effective_end_date`) VALUES
(1, 1, 1, 'Disney Career Portal', 'Disney''s Online Career Portal. All under on roof. ', '2011-01-29', '2012-09-30', 1, '2012-04-01 02:17:27', '0000-00-00'),
(2, 2, 3, 'Disney Vacation Club', NULL, '2010-02-01', '2012-03-31', 1, '2012-04-01 02:09:53', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `project_statuses`
--

DROP TABLE IF EXISTS `project_statuses`;
CREATE TABLE IF NOT EXISTS `project_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `project_statuses`
--

INSERT INTO `project_statuses` (`id`, `status`, `sort_order`, `last_updated_date`, `effective_end_date`) VALUES
(1, 'In Progress', 1, '2012-03-31 13:32:21', '0000-00-00'),
(2, 'On Hold', 2, '2012-03-31 13:32:21', '0000-00-00'),
(3, 'Completed', 3, '2012-03-31 13:32:21', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

DROP TABLE IF EXISTS `project_types`;
CREATE TABLE IF NOT EXISTS `project_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `project_types`
--

INSERT INTO `project_types` (`id`, `type`, `sort_order`, `last_updated_date`, `effective_end_date`) VALUES
(1, 'Application Development', 1, '2012-03-31 13:32:21', '0000-00-00'),
(2, 'Application Sustainment', 2, '2012-03-31 13:32:21', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `releases`
--

DROP TABLE IF EXISTS `releases`;
CREATE TABLE IF NOT EXISTS `releases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `projects_id` bigint(20) unsigned NOT NULL,
  `indicators_id` bigint(20) unsigned NOT NULL,
  `release` bigint(20) NOT NULL,
  `objective` text,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `risk` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `releases`
--

INSERT INTO `releases` (`id`, `projects_id`, `indicators_id`, `release`, `objective`, `start_date`, `end_date`, `risk`, `status`, `last_updated_date`, `effective_end_date`) VALUES
(1, 1, 1, 1, 'Clear Demo.', '2011-01-29', '2011-02-11', 'Starting', 1, '2012-04-01 02:20:06', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `sort_order` bigint(20) NOT NULL DEFAULT '0',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `sort_order`, `last_updated_date`, `effective_end_date`) VALUES
(1, 'Delivery Head', 1, '2012-03-31 18:55:45', '0000-00-00'),
(2, 'Delivery Manager', 2, '2012-03-31 18:55:45', '0000-00-00'),
(3, 'Supervisor', 3, '2012-03-31 18:57:58', '0000-00-00'),
(4, 'Developer', 4, '2012-03-31 18:57:58', '0000-00-00'),
(5, 'Tester', 5, '2012-03-31 18:57:58', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sprints`
--

DROP TABLE IF EXISTS `sprints`;
CREATE TABLE IF NOT EXISTS `sprints` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `releases_id` bigint(20) unsigned NOT NULL,
  `indicators_id` bigint(20) unsigned NOT NULL,
  `sprint` bigint(20) NOT NULL,
  `objective` text,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `risk` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sprints`
--

INSERT INTO `sprints` (`id`, `releases_id`, `indicators_id`, `sprint`, `objective`, `start_date`, `end_date`, `risk`, `status`, `last_updated_date`, `effective_end_date`) VALUES
(1, 1, 1, 1, 'Clear Demo.', '2011-01-29', '2011-02-04', 'Starting', 1, '2012-03-31 20:50:06', '0000-00-00'),
(2, 1, 1, 2, 'Clear Demo.', '2011-01-05', '2011-02-11', 'Starting', 1, '2012-03-31 20:50:06', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sprint_logs`
--

DROP TABLE IF EXISTS `sprint_logs`;
CREATE TABLE IF NOT EXISTS `sprint_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `sprints_id` bigint(20) unsigned NOT NULL,
  `hours` float(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sprint_logs`
--

INSERT INTO `sprint_logs` (`id`, `users_id`, `sprints_id`, `hours`, `status`, `last_updated_date`, `effective_end_date`) VALUES
(1, 7, 1, 45.00, 1, '2012-04-01 02:45:50', '0000-00-00'),
(2, 7, 2, 45.00, 1, '2012-04-01 02:45:50', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_types_id` bigint(20) unsigned NOT NULL,
  `designations_id` bigint(20) unsigned NOT NULL,
  `roles_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_types_id`, `designations_id`, `roles_id`, `first_name`, `last_name`, `username`, `password`, `email`, `status`, `last_updated_date`, `effective_end_date`) VALUES
(1, 4, 1, 1, 'Niraj', 'Gupta', 'niraj.gupta', '21232f297a57a5a743894a0e4a801fc3', 'niraj.gupta@accenture.com', 1, '2012-04-01 01:47:36', '0000-00-00'),
(2, 1, 2, 2, 'Balaji', 'Saranathan', 'balaji.saranathan', '21232f297a57a5a743894a0e4a801fc3', 'balaji.saranathan@accenture.com', 1, '2012-04-01 01:47:46', '0000-00-00'),
(3, 2, 4, 3, 'Venkatacharya', 'KK', 'venkatacharya.kk', '21232f297a57a5a743894a0e4a801fc3', 'venkatacharya.kk@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(4, 2, 4, 3, 'Ashish', 'Tiwari', 'ashish.tiwari', '21232f297a57a5a743894a0e4a801fc3', 'ashish.x.tiwari@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(5, 3, 4, 4, 'Jegan', 'Arockiaraj', 'jegan.arockiaraj', '21232f297a57a5a743894a0e4a801fc3', 'jegan.arockiaraj.a@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(6, 2, 4, 3, 'Deepak', 'Sathyamurthy', 'deepak.sathyamurthy', '21232f297a57a5a743894a0e4a801fc3', 'deepak.sathyamurthy@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(7, 3, 5, 4, 'Chinmay', 'Sahoo', 'chinmay.sahoo', '21232f297a57a5a743894a0e4a801fc3', 'chinmay.sahoo@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(8, 3, 5, 4, 'Sreenath', 'PB', 'sreenath.p.b', '21232f297a57a5a743894a0e4a801fc3', 'sreenath.p.b@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(9, 3, 6, 4, 'Arun', 'Nampoothiri', 'arun.nampoothiri', '21232f297a57a5a743894a0e4a801fc3', 'arun.nampoothiri@accenture.com', 1, '2012-04-01 01:48:40', '0000-00-00'),
(10, 3, 5, 5, 'Megha', 'TJ', 'megha.tj', '21232f297a57a5a743894a0e4a801fc3', 'Megha.tj@accenture.com', 1, '2012-04-01 01:48:41', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_tenures`
--

DROP TABLE IF EXISTS `user_tenures`;
CREATE TABLE IF NOT EXISTS `user_tenures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `projects_id` bigint(20) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_tenures`
--

INSERT INTO `user_tenures` (`id`, `users_id`, `projects_id`, `start_date`, `end_date`, `last_updated_date`, `effective_end_date`) VALUES
(1, 3, 1, '2011-01-29', '2012-09-30', '2012-04-01 02:50:41', '0000-00-00'),
(2, 6, 1, '2011-01-29', '2012-09-30', '2012-04-01 02:50:41', '0000-00-00'),
(3, 7, 1, '2011-01-29', '2012-09-30', '2012-04-01 02:50:41', '0000-00-00'),
(4, 8, 1, '2011-01-29', '2012-09-30', '2012-04-01 02:50:41', '0000-00-00'),
(5, 10, 1, '2011-01-29', '2012-09-30', '2012-04-01 02:50:41', '0000-00-00'),
(6, 4, 2, '2011-10-07', '2012-03-31', '2012-04-01 02:50:41', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(1) unsigned NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `last_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `effective_end_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `level`, `user_type`, `last_updated_date`, `effective_end_date`) VALUES
(1, 1, 'Level 1', '2012-04-01 00:41:52', '0000-00-00'),
(2, 2, 'Level 2', '2012-04-01 00:41:52', '0000-00-00'),
(3, 3, 'Level 3', '2012-04-01 00:41:52', '0000-00-00'),
(4, 4, 'Level 4', '2012-04-01 00:41:52', '0000-00-00');
