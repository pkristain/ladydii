-- phpMyAdmin SQL Dump
-- version 3.5.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2014 at 12:17 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ladydii_nette`
--

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_lang`
--
-- Creation: May 19, 2014 at 08:37 PM
--

DROP TABLE IF EXISTS `ladydii_lang`;
CREATE TABLE IF NOT EXISTS `ladydii_lang` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(255) NOT NULL,
  `lang_name` varchar(255) DEFAULT NULL,
  `lang_visibility` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `lang_code` (`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ladydii_lang`
--

INSERT INTO `ladydii_lang` (`lang_id`, `lang_code`, `lang_name`, `lang_visibility`) VALUES
(0, '', 'default', 1);

--
-- Triggers `ladydii_lang`
--
DROP TRIGGER IF EXISTS `lang for kind`;
DELIMITER //
CREATE TRIGGER `lang for kind` AFTER INSERT ON `ladydii_lang`
 FOR EACH ROW INSERT INTO
ladydii_page_kind (page_id, kind_lang)
SELECT
p.page_id,
new.lang_id
from
ladydii_page_page p
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `ladydii_page_all`
--
DROP VIEW IF EXISTS `ladydii_page_all`;
CREATE TABLE IF NOT EXISTS `ladydii_page_all` (
`page_id` int(11)
,`kind_id` int(11) unsigned
,`unit_id` int(11) unsigned
,`-` varchar(1)
,`page_parent` int(11)
,`page_visibility` tinyint(1)
,`page_created` timestamp
,`page_level` int(11)
,`page_order` int(11)
,`page_general_visibility` tinyint(1)
,`My_exp_-` varchar(1)
,`lang_code` varchar(255)
,`lang_name` varchar(255)
,`lang_visibility` int(1)
,`My_exp_1_-` varchar(1)
,`kind_name` varchar(255)
,`kind_alias` varchar(255)
,`kind_route` varchar(1024)
,`My_exp_2_-` varchar(1)
,`unit_active` int(1) unsigned
,`unit_name` varchar(255)
,`unit_changed` timestamp
,`unit_content` text
);
-- --------------------------------------------------------

--
-- Table structure for table `ladydii_page_kind`
--
-- Creation: May 17, 2014 at 09:21 PM
--

DROP TABLE IF EXISTS `ladydii_page_kind`;
CREATE TABLE IF NOT EXISTS `ladydii_page_kind` (
  `kind_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `kind_lang` int(11) unsigned NOT NULL,
  `kind_name` varchar(255) DEFAULT NULL,
  `kind_alias` varchar(255) DEFAULT NULL,
  `kind_route` varchar(1024) DEFAULT NULL COMMENT 'počítá se',
  `kind_unit` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`kind_id`),
  UNIQUE KEY `id-lang` (`page_id`,`kind_lang`),
  KEY `lang` (`kind_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `ladydii_page_kind`
--

INSERT INTO `ladydii_page_kind` (`kind_id`, `page_id`, `kind_lang`, `kind_name`, `kind_alias`, `kind_route`, `kind_unit`) VALUES
(64, 0, 0, NULL, NULL, NULL, NULL),
(102, 1, 0, NULL, NULL, NULL, NULL),
(109, 2, 0, NULL, NULL, NULL, NULL),
(116, 3, 0, NULL, NULL, NULL, NULL),
(123, 4, 0, NULL, NULL, NULL, NULL),
(130, 5, 0, NULL, NULL, NULL, NULL);

--
-- Triggers `ladydii_page_kind`
--
DROP TRIGGER IF EXISTS `default_unit`;
DELIMITER //
CREATE TRIGGER `default_unit` AFTER INSERT ON `ladydii_page_kind`
 FOR EACH ROW insert into ladydii_page_unit
(kind_id, unit_name, unit_active)
SELECT
new.kind_id,
'default',
1
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_page_page`
--
-- Creation: May 15, 2014 at 10:52 PM
--

DROP TABLE IF EXISTS `ladydii_page_page`;
CREATE TABLE IF NOT EXISTS `ladydii_page_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_parent` int(11) DEFAULT '0',
  `page_visibility` tinyint(1) NOT NULL DEFAULT '0',
  `page_priority` int(11) NOT NULL DEFAULT '0',
  `page_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_level` int(11) DEFAULT NULL COMMENT 'počítá se',
  `page_order` int(11) DEFAULT NULL COMMENT 'počítá se',
  `page_general_visibility` tinyint(1) DEFAULT NULL COMMENT 'počítá se',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_order` (`page_order`),
  KEY `parent` (`page_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ladydii_page_page`
--

INSERT INTO `ladydii_page_page` (`page_id`, `page_parent`, `page_visibility`, `page_priority`, `page_created`, `page_level`, `page_order`, `page_general_visibility`) VALUES
(0, NULL, 0, 0, '2014-05-21 19:20:46', NULL, NULL, NULL),
(1, 0, 0, 0, '2014-05-21 21:21:23', NULL, NULL, NULL),
(2, 0, 0, 0, '2014-05-21 21:21:31', NULL, NULL, NULL),
(3, 0, 0, 0, '2014-05-21 21:21:36', NULL, NULL, NULL),
(4, 1, 0, 0, '2014-05-21 21:21:40', NULL, NULL, NULL),
(5, 3, 0, 0, '2014-05-21 21:21:45', NULL, NULL, NULL);

--
-- Triggers `ladydii_page_page`
--
DROP TRIGGER IF EXISTS `page new`;
DELIMITER //
CREATE TRIGGER `page new` AFTER INSERT ON `ladydii_page_page`
 FOR EACH ROW insert into ladydii_page_kind
(page_id , kind_lang)
SELECT
new.page_id,
l.lang_id
FROM
ladydii_lang l
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_page_unit`
--
-- Creation: May 18, 2014 at 09:41 PM
--

DROP TABLE IF EXISTS `ladydii_page_unit`;
CREATE TABLE IF NOT EXISTS `ladydii_page_unit` (
  `unit_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kind_id` int(11) unsigned NOT NULL,
  `unit_active` int(1) unsigned NOT NULL DEFAULT '0',
  `unit_name` varchar(255) DEFAULT NULL,
  `unit_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `unit_content` text,
  PRIMARY KEY (`unit_id`),
  KEY `kind_id` (`kind_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `ladydii_page_unit`
--

INSERT INTO `ladydii_page_unit` (`unit_id`, `kind_id`, `unit_active`, `unit_name`, `unit_changed`, `unit_content`) VALUES
(46, 64, 0, 'default', '2014-05-21 19:20:46', NULL),
(71, 102, 1, 'default', '2014-05-21 21:21:23', NULL),
(75, 109, 1, 'default', '2014-05-21 21:21:31', NULL),
(79, 116, 1, 'default', '2014-05-21 21:21:36', NULL),
(83, 123, 1, 'default', '2014-05-21 21:21:40', NULL),
(87, 130, 1, 'default', '2014-05-21 21:21:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_var`
--
-- Creation: May 19, 2014 at 08:58 PM
--

DROP TABLE IF EXISTS `ladydii_var`;
CREATE TABLE IF NOT EXISTS `ladydii_var` (
  `var_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `var_code` varchar(255) NOT NULL,
  `var_name` varchar(255) DEFAULT NULL,
  `var_level` enum('global','page','kind','unit') NOT NULL,
  `var_type` enum('int','varchar') NOT NULL,
  PRIMARY KEY (`var_id`),
  UNIQUE KEY `var_code` (`var_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_var_global`
--
-- Creation: May 19, 2014 at 09:01 PM
--

DROP TABLE IF EXISTS `ladydii_var_global`;
CREATE TABLE IF NOT EXISTS `ladydii_var_global` (
  `var_id` int(10) unsigned NOT NULL,
  `var_value` varchar(255) NOT NULL,
  PRIMARY KEY (`var_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_var_kind`
--
-- Creation: May 19, 2014 at 09:15 PM
--

DROP TABLE IF EXISTS `ladydii_var_kind`;
CREATE TABLE IF NOT EXISTS `ladydii_var_kind` (
  `var_id` int(10) unsigned NOT NULL,
  `var_owner` int(11) unsigned NOT NULL,
  `var_value` varchar(255) NOT NULL,
  UNIQUE KEY `id-owner` (`var_id`,`var_owner`),
  KEY `id` (`var_id`),
  KEY `owner` (`var_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_var_lang`
--
-- Creation: May 19, 2014 at 09:29 PM
--

DROP TABLE IF EXISTS `ladydii_var_lang`;
CREATE TABLE IF NOT EXISTS `ladydii_var_lang` (
  `var_id` int(10) unsigned NOT NULL,
  `var_owner` int(11) unsigned NOT NULL,
  `var_value` varchar(255) NOT NULL,
  UNIQUE KEY `id-owner` (`var_id`,`var_owner`),
  KEY `id` (`var_id`),
  KEY `owner` (`var_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_var_page`
--
-- Creation: May 19, 2014 at 09:11 PM
--

DROP TABLE IF EXISTS `ladydii_var_page`;
CREATE TABLE IF NOT EXISTS `ladydii_var_page` (
  `var_id` int(10) unsigned NOT NULL,
  `var_owner` int(11) NOT NULL,
  `var_value` varchar(255) NOT NULL,
  UNIQUE KEY `id-owner` (`var_id`,`var_owner`),
  KEY `owner` (`var_owner`),
  KEY `id` (`var_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ladydii_var_unit`
--
-- Creation: May 19, 2014 at 09:16 PM
--

DROP TABLE IF EXISTS `ladydii_var_unit`;
CREATE TABLE IF NOT EXISTS `ladydii_var_unit` (
  `var_id` int(10) unsigned NOT NULL,
  `var_owner` int(11) unsigned NOT NULL,
  `var_value` varchar(255) NOT NULL,
  UNIQUE KEY `id-owner` (`var_id`,`var_owner`),
  KEY `id` (`var_id`),
  KEY `owner` (`var_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ladydii_page_kind`
--
ALTER TABLE `ladydii_page_kind`
  ADD CONSTRAINT `ladydii_page_kind_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `ladydii_page_page` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ladydii_page_kind_ibfk_3` FOREIGN KEY (`kind_lang`) REFERENCES `ladydii_lang` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_page_page`
--
ALTER TABLE `ladydii_page_page`
  ADD CONSTRAINT `ladydii_page_page_ibfk_1` FOREIGN KEY (`page_parent`) REFERENCES `ladydii_page_page` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_page_unit`
--
ALTER TABLE `ladydii_page_unit`
  ADD CONSTRAINT `ladydii_page_unit_ibfk_1` FOREIGN KEY (`kind_id`) REFERENCES `ladydii_page_kind` (`kind_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_var_global`
--
ALTER TABLE `ladydii_var_global`
  ADD CONSTRAINT `ladydii_var_global_ibfk_1` FOREIGN KEY (`var_id`) REFERENCES `ladydii_var` (`var_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_var_kind`
--
ALTER TABLE `ladydii_var_kind`
  ADD CONSTRAINT `ladydii_var_kind_ibfk_1` FOREIGN KEY (`var_id`) REFERENCES `ladydii_var` (`var_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ladydii_var_kind_ibfk_2` FOREIGN KEY (`var_owner`) REFERENCES `ladydii_page_kind` (`kind_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_var_lang`
--
ALTER TABLE `ladydii_var_lang`
  ADD CONSTRAINT `ladydii_var_lang_ibfk_1` FOREIGN KEY (`var_id`) REFERENCES `ladydii_var` (`var_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ladydii_var_lang_ibfk_2` FOREIGN KEY (`var_owner`) REFERENCES `ladydii_lang` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_var_page`
--
ALTER TABLE `ladydii_var_page`
  ADD CONSTRAINT `ladydii_var_page_ibfk_1` FOREIGN KEY (`var_id`) REFERENCES `ladydii_var` (`var_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ladydii_var_page_ibfk_2` FOREIGN KEY (`var_owner`) REFERENCES `ladydii_page_page` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ladydii_var_unit`
--
ALTER TABLE `ladydii_var_unit`
  ADD CONSTRAINT `ladydii_var_unit_ibfk_1` FOREIGN KEY (`var_id`) REFERENCES `ladydii_var` (`var_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ladydii_var_unit_ibfk_2` FOREIGN KEY (`var_owner`) REFERENCES `ladydii_page_unit` (`unit_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
