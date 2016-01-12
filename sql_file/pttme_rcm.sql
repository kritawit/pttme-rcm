-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2016 at 10:16 PM
-- Server version: 5.5.44-0ubuntu0.14.10.1-log
-- PHP Version: 5.5.12-2ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pttme_rcm`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_basic_failure`
--

CREATE TABLE IF NOT EXISTS `asset_basic_failure` (
`id` int(11) NOT NULL,
  `part_id` int(11) DEFAULT NULL COMMENT 'ได้มาจาก L8 ดึงย้อน Cat_id,Type_id ของ L7 มา Reference กัน',
  `basic_failure_id` int(11) NOT NULL,
  `node` int(11) DEFAULT NULL,
  `rpn` int(11) DEFAULT NULL,
  `worst_case` varchar(255) DEFAULT NULL,
  `failure_effect_remark` varchar(255) DEFAULT NULL,
  `failure_effect` varchar(255) DEFAULT NULL,
  `severity` int(11) DEFAULT NULL,
  `occur` int(11) DEFAULT NULL,
  `detect` int(11) DEFAULT NULL,
  `ref1` varchar(255) DEFAULT NULL,
  `ref2` varchar(255) DEFAULT NULL,
  `ref3` varchar(255) DEFAULT NULL,
  `ref4` varchar(255) DEFAULT NULL,
  `ref5` varchar(255) DEFAULT NULL,
  `ref6` varchar(255) DEFAULT NULL,
  `ref7` varchar(255) DEFAULT NULL,
  `ref8` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `asset_basic_failure`
--

INSERT INTO `asset_basic_failure` (`id`, `part_id`, `basic_failure_id`, `node`, `rpn`, `worst_case`, `failure_effect_remark`, `failure_effect`, `severity`, `occur`, `detect`, `ref1`, `ref2`, `ref3`, `ref4`, `ref5`, `ref6`, `ref7`, `ref8`, `color`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`, `project_id`) VALUES
(1, 1, 2, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-01-12 06:23:59', NULL, 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_complex_detail`
--

CREATE TABLE IF NOT EXISTS `asset_complex_detail` (
`id` int(11) NOT NULL,
  `node` int(11) DEFAULT NULL,
  `complex_id` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `columns` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL COMMENT '1 = info\n2 = occur\n3 = detect\n4 = severity\n5 = color\n6 = header\n7 = color header',
  `ref1` varchar(255) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `asset_complex_detail`
--

INSERT INTO `asset_complex_detail` (`id`, `node`, `complex_id`, `rows`, `columns`, `description`, `type`, `ref1`, `ref_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`, `project_id`) VALUES
(1, 38, 2, 8, 0, 'Can know unusual sign before failure occuring', 3, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(2, 38, 2, 10, 0, 'Can not know any sign before failure occuring', 3, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(3, 38, 2, 1, 0, 'Extreme Unlikelihood', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(4, 38, 2, 2, 0, 'Remote likelihood', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(5, 38, 2, 1, 1, '< 0.3 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(6, 38, 2, 3, 0, 'Very low likelihood', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(7, 38, 2, 1, 2, '< 0.1 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(8, 38, 2, 4, 0, 'Low likelihood', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(9, 38, 2, 1, 3, '< 0.01 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(10, 38, 2, 5, 0, 'Moderate', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(11, 38, 2, 1, 4, 'No/Slight Effect', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(12, 38, 2, 1, 1, '#00B050', 5, 'Non Critical', 42, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(13, 38, 2, 6, 0, 'Medium', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(14, 38, 2, 1, 5, '"- No or Slight impact to Community, Reputation and Customer\r\n- No fault or insignificant fault of complying with laws/articles of association."', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(15, 38, 2, 7, 0, 'Moderately High', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(16, 38, 2, 1, 6, '"- No injury or First Aid case\r\n- No or very low health effect\r\n-  No or Minimal morale impact"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(17, 38, 2, 0, 1, '1-20', 7, 'Critical', 79, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(18, 38, 2, 8, 0, 'High', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(19, 38, 2, 2, 1, '0.3 - <3 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(20, 38, 2, 9, 0, 'Very High', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(21, 38, 2, 2, 2, '0.1 - <1 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(22, 38, 2, 1, 2, '#00B050', 5, 'Non Critical', 43, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(23, 38, 2, 0, 2, '21-40', 7, 'Critical', 80, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(24, 38, 2, 10, 0, 'Extremely Likely', 2, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(25, 38, 2, 2, 3, '0.01 - < 0.1 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(26, 38, 2, 2, 4, 'Minor Effect', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(27, 38, 2, 2, 5, '"- Minor impact with short term recovery\r\n- Local media\r\n- Verbal complaints\r\n- Partly comply with laws/articles of association."', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(28, 38, 2, 2, 6, '"- Medical treatment or Restrict to work\r\n-  Low health effect\r\n- Short-term morale impact"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(29, 38, 2, 3, 1, '3 - <30 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(30, 38, 2, 3, 2, '1 - <10 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(31, 38, 2, 3, 3, '0.1 - <1 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(32, 38, 2, 3, 4, 'Moderate Effect', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(33, 38, 2, 3, 5, '"- Moderate impact with long term recovery\r\n- Regional media\r\n- Official letter complaint\r\n- Non-compliance with laws/articles of association"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(34, 38, 2, 1, 3, '#FFFF00', 5, 'Critical', 44, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(35, 38, 2, 0, 3, '41-60', 7, 'Critical', 81, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(36, 38, 2, 3, 6, '"- Loss time injury\r\n- Medium health effect\r\n- Long-term morale impact"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(37, 38, 2, 1, 4, '#FFFF00', 5, 'Critical', 45, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(38, 38, 2, 0, 4, '61-80', 7, 'Critical', 82, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(39, 38, 2, 4, 1, '30 - <300 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(40, 38, 2, 1, 5, '#FFFF00', 5, 'Critical', 46, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(41, 38, 2, 0, 5, '81-100', 7, 'Critical', 83, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(42, 38, 2, 4, 2, '10 - <100 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(43, 38, 2, 2, 1, '#00B050', 5, 'Non Critical', 47, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(44, 38, 2, 2, 2, '#FFFF00', 5, 'Critical', 48, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(45, 38, 2, 4, 3, '1 - <10 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(46, 38, 2, 2, 3, '#FFFF00', 5, 'Critical', 49, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(47, 38, 2, 4, 4, 'Major Effect', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(48, 38, 2, 2, 4, '#FFC000', 5, 'Critical', 50, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(49, 38, 2, 4, 5, '"- Major impact with national concern\r\n- National media\r\n- Customer less purchase\r\n- Violate the laws/ articles of association.\r\n"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(50, 38, 2, 0, 1, '"GPC \r(THB)"', 6, 'Critical', 36, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(51, 38, 2, 2, 5, '#FFC000', 5, 'Critical', 51, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(52, 38, 2, 4, 6, '"- Single fatality or Permanent total disabilities\r\n- High health effect\r\n- Protesters rally or official complaint"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(53, 38, 2, 0, 2, '" BU \r(THB)"', 6, 'Critical', 37, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(54, 38, 2, 5, 1, '>300 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(55, 38, 2, 3, 1, '#FFFF00', 5, 'Critical', 52, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(56, 38, 2, 0, 3, 'Small BU (THB)', 6, 'Critical', 38, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(57, 38, 2, 3, 2, '#FFFF00', 5, 'Critical', 53, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(58, 38, 2, 5, 2, '>100 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(59, 38, 2, 0, 4, 'Environment', 6, 'Critical', 39, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(60, 38, 2, 3, 3, '#FFC000', 5, 'Critical', 54, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(61, 38, 2, 5, 3, '>10 M', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(62, 38, 2, 0, 5, '"(Community, Reputation, \rCustomer, Law &Regulation)"', 6, 'Critical', 40, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(63, 38, 2, 3, 4, '#FF0000', 5, 'Critical', 55, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(64, 38, 2, 0, 6, '(Safety, Health, Morale)', 6, 'Critical', 41, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(65, 38, 2, 5, 4, 'Massive Effect', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(66, 38, 2, 3, 5, '#FF0000', 5, 'Critical', 56, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(67, 38, 2, 5, 5, '"- Massive impact with international concern\r\n- International media\r\n- Customer stop purchase\r\n- Violate the laws/ articles of association, and/or subject to order to dissolve the company\r\n"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(68, 38, 2, 4, 1, '#FFFF00', 5, 'Critical', 57, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(69, 38, 2, 5, 6, '"-  Many fatalities\r\n- High health effect\r\n- Employees or Contractors strike"', 1, 'Critical', NULL, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(70, 38, 2, 1, 0, '2', 4, 'Critical', 31, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(71, 38, 2, 4, 2, '#FFC000', 5, 'Critical', 58, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(72, 38, 2, 4, 3, '#FF0000', 5, 'Critical', 59, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(73, 38, 2, 4, 4, '#FF0000', 5, 'Critical', 60, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(74, 38, 2, 2, 0, '4', 4, 'Critical', 32, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(75, 38, 2, 4, 5, '#C00000', 5, 'Critical', 61, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(76, 38, 2, 3, 0, '6', 4, 'Critical', 33, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(77, 38, 2, 4, 0, '8', 4, 'Critical', 34, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(78, 38, 2, 5, 1, '#FFC000', 5, 'Critical', 62, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(79, 38, 2, 5, 2, '#FFC000', 5, 'Critical', 63, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(80, 38, 2, 5, 0, '10', 4, 'Critical', 35, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(81, 38, 2, 5, 3, '#FF0000', 5, 'Critical', 64, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(82, 38, 2, 5, 4, '#C00000', 5, 'Critical', 65, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(83, 38, 2, 5, 5, '#C00000', 5, 'Critical', 66, '2016-01-12 09:32:52', 1, NULL, NULL, 1, 2),
(84, 40, 2, 8, 0, 'Can know unusual sign before failure occuring', 3, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(85, 40, 2, 10, 0, 'Can not know any sign before failure occuring', 3, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(86, 40, 2, 1, 1, '< 0.3 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(87, 40, 2, 0, 1, '1-20', 7, 'Critical', 79, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(88, 40, 2, 1, 2, '< 0.1 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(89, 40, 2, 1, 1, '#00B050', 5, 'Non Critical', 42, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(90, 40, 2, 0, 2, '21-40', 7, 'Critical', 80, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(91, 40, 2, 1, 3, '< 0.01 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(92, 40, 2, 0, 3, '41-60', 7, 'Critical', 81, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(93, 40, 2, 1, 4, 'No/Slight Effect', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(94, 40, 2, 0, 4, '61-80', 7, 'Critical', 82, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(95, 40, 2, 1, 5, '"- No or Slight impact to Community, Reputation and Customer\r\n- No fault or insignificant fault of complying with laws/articles of association."', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(96, 40, 2, 0, 5, '81-100', 7, 'Critical', 83, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(97, 40, 2, 1, 6, '"- No injury or First Aid case\r\n- No or very low health effect\r\n-  No or Minimal morale impact"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(98, 40, 2, 1, 2, '#00B050', 5, 'Non Critical', 43, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(99, 40, 2, 2, 1, '0.3 - <3 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(100, 40, 2, 1, 3, '#FFFF00', 5, 'Critical', 44, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(101, 40, 2, 2, 2, '0.1 - <1 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(102, 40, 2, 1, 4, '#FFFF00', 5, 'Critical', 45, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(103, 40, 2, 0, 1, '"GPC \r(THB)"', 6, 'Critical', 36, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(104, 40, 2, 2, 3, '0.01 - < 0.1 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(105, 40, 2, 1, 0, 'Extreme Unlikelihood', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(106, 40, 2, 1, 5, '#FFFF00', 5, 'Critical', 46, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(107, 40, 2, 0, 2, '" BU \r(THB)"', 6, 'Critical', 37, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(108, 40, 2, 2, 4, 'Minor Effect', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(109, 40, 2, 2, 1, '#00B050', 5, 'Non Critical', 47, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(110, 40, 2, 0, 3, 'Small BU (THB)', 6, 'Critical', 38, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(111, 40, 2, 2, 5, '"- Minor impact with short term recovery\r\n- Local media\r\n- Verbal complaints\r\n- Partly comply with laws/articles of association."', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(112, 40, 2, 2, 2, '#FFFF00', 5, 'Critical', 48, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(113, 40, 2, 0, 4, 'Environment', 6, 'Critical', 39, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(114, 40, 2, 2, 0, 'Remote likelihood', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(115, 40, 2, 2, 6, '"- Medical treatment or Restrict to work\r\n-  Low health effect\r\n- Short-term morale impact"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(116, 40, 2, 2, 3, '#FFFF00', 5, 'Critical', 49, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(117, 40, 2, 0, 5, '"(Community, Reputation, \rCustomer, Law &Regulation)"', 6, 'Critical', 40, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(118, 40, 2, 3, 1, '3 - <30 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(119, 40, 2, 2, 4, '#FFC000', 5, 'Critical', 50, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(120, 40, 2, 0, 6, '(Safety, Health, Morale)', 6, 'Critical', 41, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(121, 40, 2, 3, 2, '1 - <10 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(122, 40, 2, 2, 5, '#FFC000', 5, 'Critical', 51, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(123, 40, 2, 3, 3, '0.1 - <1 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(124, 40, 2, 3, 1, '#FFFF00', 5, 'Critical', 52, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(125, 40, 2, 3, 2, '#FFFF00', 5, 'Critical', 53, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(126, 40, 2, 3, 4, 'Moderate Effect', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(127, 40, 2, 1, 0, '2', 4, 'Critical', 31, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(128, 40, 2, 3, 0, 'Very low likelihood', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(129, 40, 2, 3, 3, '#FFC000', 5, 'Critical', 54, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(130, 40, 2, 3, 5, '"- Moderate impact with long term recovery\r\n- Regional media\r\n- Official letter complaint\r\n- Non-compliance with laws/articles of association"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(131, 40, 2, 3, 4, '#FF0000', 5, 'Critical', 55, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(132, 40, 2, 3, 6, '"- Loss time injury\r\n- Medium health effect\r\n- Long-term morale impact"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(133, 40, 2, 2, 0, '4', 4, 'Critical', 32, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(134, 40, 2, 4, 1, '30 - <300 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(135, 40, 2, 3, 5, '#FF0000', 5, 'Critical', 56, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(136, 40, 2, 3, 0, '6', 4, 'Critical', 33, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(137, 40, 2, 4, 2, '10 - <100 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(138, 40, 2, 4, 1, '#FFFF00', 5, 'Critical', 57, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(139, 40, 2, 4, 0, '8', 4, 'Critical', 34, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(140, 40, 2, 4, 2, '#FFC000', 5, 'Critical', 58, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(141, 40, 2, 4, 3, '1 - <10 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(142, 40, 2, 4, 0, 'Low likelihood', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(143, 40, 2, 5, 0, '10', 4, 'Critical', 35, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(144, 40, 2, 4, 3, '#FF0000', 5, 'Critical', 59, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(145, 40, 2, 4, 4, 'Major Effect', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(146, 40, 2, 4, 4, '#FF0000', 5, 'Critical', 60, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(147, 40, 2, 4, 5, '"- Major impact with national concern\r\n- National media\r\n- Customer less purchase\r\n- Violate the laws/ articles of association.\r\n"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(148, 40, 2, 4, 5, '#C00000', 5, 'Critical', 61, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(149, 40, 2, 4, 6, '"- Single fatality or Permanent total disabilities\r\n- High health effect\r\n- Protesters rally or official complaint"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(150, 40, 2, 5, 1, '#FFC000', 5, 'Critical', 62, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(151, 40, 2, 5, 1, '>300 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(152, 40, 2, 5, 2, '>100 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(153, 40, 2, 5, 2, '#FFC000', 5, 'Critical', 63, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(154, 40, 2, 5, 3, '#FF0000', 5, 'Critical', 64, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(155, 40, 2, 5, 3, '>10 M', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(156, 40, 2, 5, 4, '#C00000', 5, 'Critical', 65, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(157, 40, 2, 5, 4, 'Massive Effect', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(158, 40, 2, 5, 5, '#C00000', 5, 'Critical', 66, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(159, 40, 2, 5, 5, '"- Massive impact with international concern\r\n- International media\r\n- Customer stop purchase\r\n- Violate the laws/ articles of association, and/or subject to order to dissolve the company\r\n"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(160, 40, 2, 5, 6, '"-  Many fatalities\r\n- High health effect\r\n- Employees or Contractors strike"', 1, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(161, 40, 2, 5, 0, 'Moderate', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(162, 40, 2, 6, 0, 'Medium', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(163, 40, 2, 7, 0, 'Moderately High', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(164, 40, 2, 8, 0, 'High', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(165, 40, 2, 9, 0, 'Very High', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(166, 40, 2, 10, 0, 'Extremely Likely', 2, 'Critical', NULL, '2016-01-12 09:37:07', 1, NULL, NULL, 1, 2),
(167, 13, 2, 1, 1, '#00B050', 5, 'Non Critical', 42, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(168, 13, 2, 1, 2, '#00B050', 5, 'Non Critical', 43, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(169, 13, 2, 1, 3, '#FFFF00', 5, 'Critical', 44, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(170, 13, 2, 0, 1, '1-20', 7, 'Critical', 79, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(171, 13, 2, 1, 4, '#FFFF00', 5, 'Critical', 45, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(172, 13, 2, 1, 5, '#FFFF00', 5, 'Critical', 46, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(173, 13, 2, 0, 2, '21-40', 7, 'Critical', 80, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(174, 13, 2, 2, 1, '#00B050', 5, 'Non Critical', 47, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(175, 13, 2, 2, 2, '#FFFF00', 5, 'Critical', 48, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(176, 13, 2, 0, 3, '41-60', 7, 'Critical', 81, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(177, 13, 2, 2, 3, '#FFFF00', 5, 'Critical', 49, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(178, 13, 2, 2, 4, '#FFC000', 5, 'Critical', 50, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(179, 13, 2, 0, 4, '61-80', 7, 'Critical', 82, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(180, 13, 2, 8, 0, 'Can know unusual sign before failure occuring', 3, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(181, 13, 2, 2, 5, '#FFC000', 5, 'Critical', 51, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(182, 13, 2, 3, 1, '#FFFF00', 5, 'Critical', 52, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(183, 13, 2, 0, 5, '81-100', 7, 'Critical', 83, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(184, 13, 2, 3, 2, '#FFFF00', 5, 'Critical', 53, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(185, 13, 2, 3, 3, '#FFC000', 5, 'Critical', 54, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(186, 13, 2, 3, 4, '#FF0000', 5, 'Critical', 55, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(187, 13, 2, 3, 5, '#FF0000', 5, 'Critical', 56, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(188, 13, 2, 4, 1, '#FFFF00', 5, 'Critical', 57, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(189, 13, 2, 4, 2, '#FFC000', 5, 'Critical', 58, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(190, 13, 2, 4, 3, '#FF0000', 5, 'Critical', 59, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(191, 13, 2, 4, 4, '#FF0000', 5, 'Critical', 60, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(192, 13, 2, 0, 1, '"GPC \r(THB)"', 6, 'Critical', 36, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(193, 13, 2, 10, 0, 'Can not know any sign before failure occuring', 3, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(194, 13, 2, 4, 5, '#C00000', 5, 'Critical', 61, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(195, 13, 2, 5, 1, '#FFC000', 5, 'Critical', 62, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(196, 13, 2, 0, 2, '" BU \r(THB)"', 6, 'Critical', 37, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(197, 13, 2, 5, 2, '#FFC000', 5, 'Critical', 63, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(198, 13, 2, 0, 3, 'Small BU (THB)', 6, 'Critical', 38, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(199, 13, 2, 5, 3, '#FF0000', 5, 'Critical', 64, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(200, 13, 2, 0, 4, 'Environment', 6, 'Critical', 39, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(201, 13, 2, 5, 4, '#C00000', 5, 'Critical', 65, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(202, 13, 2, 0, 5, '"(Community, Reputation, \rCustomer, Law &Regulation)"', 6, 'Critical', 40, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(203, 13, 2, 5, 5, '#C00000', 5, 'Critical', 66, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(204, 13, 2, 0, 6, '(Safety, Health, Morale)', 6, 'Critical', 41, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(205, 13, 2, 1, 0, '2', 4, 'Critical', 31, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(206, 13, 2, 2, 0, '4', 4, 'Critical', 32, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(207, 13, 2, 3, 0, '6', 4, 'Critical', 33, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(208, 13, 2, 4, 0, '8', 4, 'Critical', 34, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(209, 13, 2, 5, 0, '10', 4, 'Critical', 35, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(210, 13, 2, 1, 1, '< 0.3 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(211, 13, 2, 1, 2, '< 0.1 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(212, 13, 2, 1, 3, '< 0.01 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(213, 13, 2, 1, 4, 'No/Slight Effect', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(214, 13, 2, 1, 5, '"- No or Slight impact to Community, Reputation and Customer\r\n- No fault or insignificant fault of complying with laws/articles of association."', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(215, 13, 2, 1, 6, '"- No injury or First Aid case\r\n- No or very low health effect\r\n-  No or Minimal morale impact"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(216, 13, 2, 2, 1, '0.3 - <3 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(217, 13, 2, 2, 2, '0.1 - <1 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(218, 13, 2, 2, 3, '0.01 - < 0.1 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(219, 13, 2, 2, 4, 'Minor Effect', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(220, 13, 2, 2, 5, '"- Minor impact with short term recovery\r\n- Local media\r\n- Verbal complaints\r\n- Partly comply with laws/articles of association."', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(221, 13, 2, 2, 6, '"- Medical treatment or Restrict to work\r\n-  Low health effect\r\n- Short-term morale impact"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(222, 13, 2, 3, 1, '3 - <30 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(223, 13, 2, 3, 2, '1 - <10 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(224, 13, 2, 3, 3, '0.1 - <1 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(225, 13, 2, 1, 0, 'Extreme Unlikelihood', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(226, 13, 2, 3, 4, 'Moderate Effect', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(227, 13, 2, 2, 0, 'Remote likelihood', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(228, 13, 2, 3, 5, '"- Moderate impact with long term recovery\r\n- Regional media\r\n- Official letter complaint\r\n- Non-compliance with laws/articles of association"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(229, 13, 2, 3, 6, '"- Loss time injury\r\n- Medium health effect\r\n- Long-term morale impact"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(230, 13, 2, 3, 0, 'Very low likelihood', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(231, 13, 2, 4, 1, '30 - <300 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(232, 13, 2, 4, 2, '10 - <100 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(233, 13, 2, 4, 0, 'Low likelihood', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(234, 13, 2, 4, 3, '1 - <10 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(235, 13, 2, 4, 4, 'Major Effect', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(236, 13, 2, 5, 0, 'Moderate', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(237, 13, 2, 4, 5, '"- Major impact with national concern\r\n- National media\r\n- Customer less purchase\r\n- Violate the laws/ articles of association.\r\n"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(238, 13, 2, 4, 6, '"- Single fatality or Permanent total disabilities\r\n- High health effect\r\n- Protesters rally or official complaint"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(239, 13, 2, 6, 0, 'Medium', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(240, 13, 2, 5, 1, '>300 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(241, 13, 2, 5, 2, '>100 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(242, 13, 2, 7, 0, 'Moderately High', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(243, 13, 2, 5, 3, '>10 M', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(244, 13, 2, 5, 4, 'Massive Effect', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(245, 13, 2, 8, 0, 'High', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(246, 13, 2, 5, 5, '"- Massive impact with international concern\r\n- International media\r\n- Customer stop purchase\r\n- Violate the laws/ articles of association, and/or subject to order to dissolve the company\r\n"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(247, 13, 2, 9, 0, 'Very High', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(248, 13, 2, 5, 6, '"-  Many fatalities\r\n- High health effect\r\n- Employees or Contractors strike"', 1, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1),
(249, 13, 2, 10, 0, 'Extremely Likely', 2, 'Critical', NULL, '2016-01-12 15:13:30', 1, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_registers`
--

CREATE TABLE IF NOT EXISTS `asset_registers` (
`id` int(10) unsigned NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `asset_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(10) unsigned DEFAULT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `level` int(10) unsigned NOT NULL,
  `rpn` int(10) unsigned NOT NULL,
  `drawing` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `severity` int(11) DEFAULT NULL,
  `occur` int(11) DEFAULT NULL,
  `detect` int(11) DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_unicode_ci DEFAULT '#A0A0A0',
  `complex_node` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `asset_registers`
--

INSERT INTO `asset_registers` (`id`, `parent`, `asset_name`, `description`, `cat_id`, `type_id`, `level`, `rpn`, `drawing`, `picture_path`, `severity`, `occur`, `detect`, `color`, `complex_node`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 0, 'PTT GLOBAL CHEMICAL', '', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:04:22', '2015-12-28 23:04:22'),
(2, 1, 'ARO-ARO1', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:04:41', '2015-12-28 23:04:41'),
(3, 1, 'ARO-ARO2', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:04:53', '2015-12-28 23:04:53'),
(4, 1, 'CH', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:04:58', '2015-12-28 23:04:58'),
(5, 1, 'EO-EG', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:05', '2015-12-28 23:05:05'),
(6, 1, 'GREEN-TOL', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:12', '2015-12-28 23:05:12'),
(7, 1, 'OLE II', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:20', '2015-12-28 23:05:20'),
(8, 1, 'OLE-UT', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:27', '2015-12-28 23:05:27'),
(9, 1, 'OLEFINS', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:32', '2015-12-28 23:05:32'),
(10, 1, 'POLYMER', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:38', '2015-12-28 23:05:38'),
(11, 1, 'REFINERY AND SHARE FACILITY', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:05:46', '2015-12-28 23:05:46'),
(12, 2, 'REFORMER', '', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:06:03', '2015-12-28 23:06:03'),
(13, 2, '', 'AROMATICS', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', 13, 1, 1, 1, 1, '2015-12-28 23:06:08', '2016-01-12 08:13:30'),
(14, 2, 'UTILITY', '', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:06:16', '2015-12-28 23:06:16'),
(15, 13, 'ARO1 0320', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:06:30', '2015-12-28 23:06:30'),
(16, 13, 'ARO1 0370', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:06:39', '2015-12-28 23:06:39'),
(17, 13, 'ARO1 0380', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:06:48', '2015-12-28 23:06:48'),
(18, 13, 'ARO1 0390', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:06:57', '2015-12-28 23:06:57'),
(19, 13, 'ARO1 0430', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:07:05', '2015-12-28 23:07:05'),
(20, 13, 'ARO1 0431', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:07:11', '2015-12-28 23:07:11'),
(21, 13, 'ARO1 0432', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:07:19', '2015-12-28 23:07:19'),
(22, 13, 'ARO1 0433', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:07:26', '2015-12-28 23:07:26'),
(23, 13, 'ARO1 0500', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:07:35', '2015-12-28 23:07:35'),
(24, 13, 'ARO1 0540', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:07:42', '2015-12-28 23:07:42'),
(25, 15, 'RCM-320-C1', '', NULL, NULL, 5, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:08:05', '2015-12-28 23:08:05'),
(26, 15, 'RCM-320-C3', '', NULL, NULL, 5, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:08:12', '2015-12-28 23:08:12'),
(27, 25, '320-C3 REFRIGERANT COMPRESSOR', '', NULL, NULL, 6, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2015-12-28 23:08:31', '2015-12-28 23:08:31'),
(28, 27, 'COMPRESSOR UNIT', '', 1, 1, 7, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2016-01-11 23:20:25', '2016-01-11 23:20:25'),
(29, 28, '0-320-C-003', '', NULL, NULL, 8, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 1, '2016-01-11 23:20:51', '2016-01-11 23:20:51'),
(30, 0, 'Test', '', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 0, 1, '2016-01-11 23:37:59', '2016-01-11 23:38:23'),
(31, 0, 'PTTLNG', 'Project RCM at pttlng', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 1, 2, '2016-01-12 01:57:54', '2016-01-12 01:58:22'),
(32, 0, 'Test', '', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 0, 2, '2016-01-12 02:10:03', '2016-01-12 02:10:17'),
(33, 31, 'BOG', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:10:13', '2016-01-12 02:10:13'),
(34, 33, 'In tank', '', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 0, 2, '2016-01-12 02:10:25', '2016-01-12 02:10:30'),
(35, 31, 'Intank pump', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:10:38', '2016-01-12 02:10:38'),
(36, 31, 'HP pump', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:10:53', '2016-01-12 02:10:53'),
(37, 31, 'IA compressor', '', NULL, NULL, 2, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:12:09', '2016-01-12 02:12:09'),
(38, 33, '', 'Boil off gas', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 1, 2, '2016-01-12 02:21:02', '2016-01-12 02:32:52'),
(39, 33, '', 'Boil off gas', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 1, 2, '2016-01-12 02:21:10', '2016-01-12 02:33:45'),
(40, 33, '', 'Boil off gas C', NULL, NULL, 3, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 1, 2, '2016-01-12 02:34:58', '2016-01-12 02:37:07'),
(41, 40, 'Pump', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 0, 2, '2016-01-12 02:39:01', '2016-01-12 02:40:53'),
(42, 41, 'seal', '', NULL, NULL, 5, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 0, 2, '2016-01-12 02:39:10', '2016-01-12 02:39:39'),
(43, 40, 'LNG - 0001', '', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:41:15', '2016-01-12 02:41:15'),
(44, 40, 'LNG - 003', 'test', NULL, NULL, 4, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 1, 2, '2016-01-12 02:41:25', '2016-01-12 02:44:08'),
(45, 44, 'BOG compressor', '', NULL, NULL, 5, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 1, 0, 2, '2016-01-12 02:46:41', '2016-01-12 02:50:09'),
(46, 44, 'BOG Compressor', '', NULL, NULL, 5, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:50:53', '2016-01-12 02:50:53'),
(47, 44, 'BOG Compressor1', '', NULL, NULL, 5, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:51:06', '2016-01-12 02:51:06'),
(48, 46, 'Pump', '', NULL, NULL, 6, 0, '', NULL, NULL, NULL, NULL, '#A0A0A0', NULL, 1, 0, 1, 2, '2016-01-12 02:51:13', '2016-01-12 02:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `basic_equipments`
--

CREATE TABLE IF NOT EXISTS `basic_equipments` (
`id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `part_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `basic_equipments`
--

INSERT INTO `basic_equipments` (`id`, `category_id`, `type_id`, `part_id`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 0, 1, 1, '2015-12-30 21:50:37', '2015-12-30 21:50:37'),
(2, 1, 2, 1, 1, 0, 1, 1, '2015-12-30 21:50:53', '2015-12-30 21:50:53'),
(3, 1, 3, 1, 1, 0, 1, 1, '2015-12-30 21:51:04', '2015-12-30 21:51:04'),
(4, 1, 4, 2, 1, 0, 1, 1, '2015-12-30 21:51:43', '2015-12-30 21:51:43'),
(5, 1, 5, 2, 1, 0, 1, 1, '2015-12-30 21:53:30', '2015-12-30 21:53:30'),
(6, 1, 6, 2, 1, 0, 1, 1, '2015-12-30 21:53:43', '2015-12-30 21:53:43'),
(7, 1, 7, 2, 1, 0, 1, 1, '2015-12-30 21:53:55', '2015-12-30 21:53:55'),
(8, 1, 8, 3, 1, 0, 1, 1, '2015-12-30 21:54:08', '2015-12-30 21:54:08'),
(9, 1, 8, 4, 1, 0, 1, 1, '2015-12-30 21:54:21', '2015-12-30 21:54:21'),
(10, 1, 8, 5, 1, 0, 1, 1, '2015-12-30 21:54:35', '2015-12-30 21:54:35'),
(11, 1, 8, 6, 1, 0, 1, 1, '2015-12-30 21:54:57', '2015-12-30 21:54:57'),
(12, 1, 8, 7, 1, 0, 1, 1, '2015-12-30 21:55:12', '2015-12-30 21:55:12'),
(13, 1, 8, 8, 1, 0, 1, 1, '2015-12-30 21:55:25', '2015-12-30 21:55:25'),
(14, 1, 8, 9, 1, 0, 1, 1, '2015-12-30 21:55:36', '2015-12-30 21:55:36'),
(15, 1, 8, 10, 1, 0, 1, 1, '2015-12-30 21:55:49', '2015-12-30 21:55:49'),
(16, 1, 8, 11, 1, 0, 1, 1, '2015-12-30 21:55:57', '2015-12-30 21:55:57'),
(17, 1, 8, 12, 1, 0, 1, 1, '2015-12-30 21:56:09', '2015-12-30 21:56:09'),
(18, 1, 8, 13, 1, 0, 1, 1, '2015-12-30 21:56:19', '2015-12-30 21:56:19'),
(19, 1, 8, 14, 1, 0, 1, 1, '2015-12-30 21:56:36', '2015-12-30 21:56:36'),
(20, 1, 9, 15, 1, 0, 1, 1, '2015-12-30 21:56:54', '2015-12-30 21:56:54'),
(21, 1, 9, 16, 1, 0, 1, 1, '2015-12-30 21:57:06', '2015-12-30 21:57:06'),
(22, 1, 9, 17, 1, 0, 1, 1, '2015-12-30 21:57:22', '2015-12-30 21:57:22'),
(23, 1, 9, 18, 1, 0, 1, 1, '2015-12-30 21:57:35', '2015-12-30 21:57:35'),
(24, 1, 9, 19, 1, 0, 1, 1, '2015-12-30 21:57:56', '2015-12-30 21:57:56'),
(25, 1, 9, 20, 1, 0, 1, 1, '2015-12-30 21:58:09', '2015-12-30 21:58:09'),
(26, 1, 9, 21, 1, 0, 1, 1, '2015-12-30 21:58:20', '2015-12-30 21:58:20'),
(27, 1, 9, 22, 1, 0, 1, 1, '2015-12-30 21:58:32', '2015-12-30 21:58:32'),
(28, 1, 9, 23, 1, 0, 1, 1, '2015-12-30 21:58:42', '2015-12-30 21:58:42'),
(29, 1, 9, 24, 1, 0, 1, 1, '2015-12-30 21:58:56', '2015-12-30 21:58:56'),
(30, 1, 9, 25, 1, 0, 1, 1, '2015-12-30 21:59:08', '2015-12-30 21:59:08'),
(31, 1, 9, 26, 1, 0, 1, 1, '2015-12-30 21:59:23', '2015-12-30 21:59:23'),
(32, 1, 9, 27, 1, 0, 1, 1, '2015-12-30 21:59:37', '2015-12-30 21:59:37'),
(33, 1, 9, 28, 1, 0, 1, 1, '2015-12-30 21:59:51', '2015-12-30 21:59:51'),
(34, 1, 9, 29, 1, 0, 1, 1, '2015-12-30 22:00:03', '2015-12-30 22:00:03'),
(35, 1, 9, 30, 1, 0, 1, 1, '2015-12-30 22:00:15', '2015-12-30 22:00:15'),
(36, 1, 9, 31, 1, 0, 1, 1, '2015-12-30 22:00:28', '2015-12-30 22:00:28'),
(37, 1, 9, 32, 1, 0, 1, 1, '2015-12-30 22:00:42', '2015-12-30 22:00:42'),
(38, 1, 9, 33, 1, 0, 1, 1, '2015-12-30 22:00:55', '2015-12-30 22:00:55'),
(39, 1, 10, 34, 1, 0, 1, 1, '2015-12-30 22:01:22', '2015-12-30 22:01:22'),
(40, 1, 10, 8, 1, 0, 1, 1, '2015-12-30 22:01:34', '2015-12-30 22:01:34'),
(41, 1, 10, 35, 1, 0, 1, 1, '2015-12-30 22:02:01', '2015-12-30 22:02:01'),
(42, 1, 10, 36, 1, 0, 1, 1, '2015-12-30 22:02:11', '2015-12-30 22:02:11'),
(43, 1, 10, 37, 1, 0, 1, 1, '2015-12-30 22:02:22', '2015-12-30 22:02:22'),
(44, 1, 10, 38, 1, 0, 1, 1, '2015-12-30 22:02:35', '2015-12-30 22:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `basic_failures`
--

CREATE TABLE IF NOT EXISTS `basic_failures` (
`id` int(10) unsigned NOT NULL,
  `mode_id` int(10) unsigned NOT NULL,
  `cause_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=246 ;

--
-- Dumping data for table `basic_failures`
--

INSERT INTO `basic_failures` (`id`, `mode_id`, `cause_id`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, 1, 1, '2015-12-30 22:03:41', '2015-12-30 22:03:41'),
(2, 1, 2, 1, 0, 1, 1, '2015-12-30 22:04:09', '2015-12-30 22:04:09'),
(3, 1, 3, 1, 0, 1, 1, '2015-12-30 22:04:18', '2015-12-30 22:04:18'),
(4, 1, 4, 1, 0, 1, 1, '2015-12-30 22:04:26', '2015-12-30 22:04:26'),
(5, 1, 5, 1, 0, 1, 1, '2015-12-30 22:04:31', '2015-12-30 22:04:31'),
(6, 1, 6, 1, 0, 1, 1, '2015-12-30 22:04:42', '2015-12-30 22:04:42'),
(7, 1, 7, 1, 0, 1, 1, '2015-12-30 22:04:52', '2015-12-30 22:04:52'),
(8, 1, 8, 1, 0, 1, 1, '2015-12-30 22:05:01', '2015-12-30 22:05:01'),
(9, 1, 9, 1, 0, 1, 1, '2015-12-30 22:05:06', '2015-12-30 22:05:06'),
(10, 2, 10, 1, 0, 1, 1, '2015-12-30 22:06:04', '2015-12-30 22:06:04'),
(11, 3, 11, 1, 0, 1, 1, '2015-12-30 22:06:27', '2015-12-30 22:06:27'),
(12, 3, 12, 1, 0, 1, 1, '2015-12-30 22:06:35', '2015-12-30 22:06:35'),
(13, 4, 13, 1, 0, 1, 1, '2015-12-30 22:06:50', '2015-12-30 22:06:50'),
(14, 4, 14, 1, 0, 1, 1, '2015-12-30 22:07:10', '2015-12-30 22:07:10'),
(15, 5, 1, 1, 0, 1, 1, '2015-12-30 22:07:21', '2015-12-30 22:07:21'),
(16, 5, 15, 1, 0, 1, 1, '2015-12-30 22:07:54', '2015-12-30 22:07:54'),
(17, 5, 16, 1, 0, 1, 1, '2015-12-30 22:08:04', '2015-12-30 22:08:04'),
(18, 5, 5, 1, 0, 1, 1, '2015-12-30 22:08:12', '2015-12-30 22:08:12'),
(19, 5, 6, 1, 0, 1, 1, '2015-12-30 22:08:20', '2015-12-30 22:08:20'),
(20, 5, 9, 1, 0, 1, 1, '2015-12-30 22:08:27', '2015-12-30 22:08:27'),
(21, 5, 17, 1, 0, 1, 1, '2015-12-30 22:08:36', '2015-12-30 22:08:36'),
(22, 6, 9, 1, 0, 1, 1, '2015-12-30 22:08:56', '2015-12-30 22:08:56'),
(23, 6, 6, 1, 0, 1, 1, '2015-12-30 22:09:06', '2015-12-30 22:09:06'),
(24, 7, 9, 1, 0, 1, 1, '2015-12-30 22:09:18', '2015-12-30 22:09:18'),
(25, 7, 1, 1, 0, 1, 1, '2015-12-30 22:09:28', '2015-12-30 22:09:28'),
(26, 7, 4, 1, 0, 1, 1, '2015-12-30 22:09:36', '2015-12-30 22:09:36'),
(27, 7, 5, 1, 0, 1, 1, '2015-12-30 22:09:49', '2015-12-30 22:09:49'),
(28, 7, 6, 1, 0, 1, 1, '2015-12-30 22:09:59', '2015-12-30 22:09:59'),
(29, 7, 17, 1, 0, 1, 1, '2015-12-30 22:10:09', '2015-12-30 22:10:09'),
(30, 7, 18, 1, 0, 1, 1, '2015-12-30 22:10:27', '2015-12-30 22:10:27'),
(31, 7, 19, 1, 0, 1, 1, '2015-12-30 22:10:37', '2015-12-30 22:10:37'),
(32, 7, 20, 1, 0, 1, 1, '2015-12-30 22:10:44', '2015-12-30 22:10:44'),
(33, 7, 21, 1, 0, 1, 1, '2015-12-30 22:10:53', '2015-12-30 22:10:53'),
(34, 7, 22, 1, 0, 1, 1, '2015-12-30 22:11:01', '2015-12-30 22:11:01'),
(35, 7, 10, 1, 0, 1, 1, '2015-12-30 22:11:11', '2015-12-30 22:11:11'),
(36, 7, 23, 1, 0, 1, 1, '2015-12-30 22:11:17', '2015-12-30 22:11:17'),
(37, 1, 24, 1, 0, 1, 1, '2015-12-30 22:12:35', '2015-12-30 22:12:35'),
(38, 1, 17, 1, 0, 1, 1, '2015-12-30 22:12:43', '2015-12-30 22:12:43'),
(39, 1, 25, 1, 0, 1, 1, '2015-12-30 22:12:56', '2015-12-30 22:12:56'),
(40, 1, 26, 1, 0, 1, 1, '2015-12-30 22:13:20', '2015-12-30 22:13:20'),
(41, 1, 27, 1, 0, 1, 1, '2015-12-30 22:13:33', '2015-12-30 22:13:33'),
(42, 1, 19, 1, 0, 1, 1, '2015-12-30 22:13:41', '2015-12-30 22:13:41'),
(43, 1, 28, 1, 0, 1, 1, '2015-12-30 22:13:51', '2015-12-30 22:13:51'),
(44, 1, 29, 1, 0, 1, 1, '2015-12-30 22:14:00', '2015-12-30 22:14:00'),
(45, 1, 30, 1, 0, 1, 1, '2015-12-30 22:14:12', '2015-12-30 22:14:12'),
(46, 1, 31, 1, 0, 1, 1, '2015-12-30 22:14:39', '2015-12-30 22:14:39'),
(47, 1, 32, 1, 0, 1, 1, '2015-12-30 22:15:10', '2015-12-30 22:15:10'),
(48, 1, 33, 1, 0, 1, 1, '2015-12-30 22:15:22', '2015-12-30 22:15:22'),
(49, 1, 34, 1, 0, 1, 1, '2015-12-30 22:15:27', '2015-12-30 22:15:27'),
(50, 1, 35, 1, 0, 1, 1, '2015-12-30 22:15:33', '2015-12-30 22:15:33'),
(51, 8, 36, 1, 0, 1, 1, '2015-12-30 22:15:57', '2015-12-30 22:15:57'),
(52, 9, 37, 1, 0, 1, 1, '2015-12-30 22:16:15', '2015-12-30 22:16:15'),
(53, 9, 38, 1, 0, 1, 1, '2015-12-30 22:16:30', '2015-12-30 22:16:30'),
(54, 9, 36, 1, 0, 1, 1, '2015-12-30 22:16:44', '2015-12-30 22:16:44'),
(55, 10, 39, 1, 0, 1, 1, '2015-12-30 22:17:00', '2015-12-30 22:17:00'),
(56, 11, 26, 1, 0, 1, 1, '2015-12-30 22:17:15', '2015-12-30 22:17:15'),
(57, 11, 36, 1, 0, 1, 1, '2015-12-30 22:17:46', '2015-12-30 22:17:46'),
(58, 12, 26, 1, 0, 1, 1, '2015-12-30 22:18:28', '2015-12-30 22:18:28'),
(59, 12, 39, 1, 0, 1, 1, '2015-12-30 22:18:38', '2015-12-30 22:18:38'),
(60, 12, 40, 1, 0, 1, 1, '2015-12-30 22:18:50', '2015-12-30 22:18:50'),
(61, 5, 25, 1, 0, 1, 1, '2015-12-30 22:19:18', '2015-12-30 22:19:18'),
(62, 5, 27, 1, 0, 1, 1, '2015-12-30 22:19:30', '2015-12-30 22:19:30'),
(63, 5, 19, 1, 0, 1, 1, '2015-12-30 22:19:39', '2015-12-30 22:19:39'),
(64, 5, 41, 1, 0, 1, 1, '2015-12-30 22:19:56', '2015-12-30 22:19:56'),
(65, 5, 35, 1, 0, 1, 1, '2015-12-30 22:20:03', '2015-12-30 22:20:03'),
(66, 6, 17, 1, 0, 1, 1, '2015-12-30 22:20:20', '2015-12-30 22:20:20'),
(67, 6, 31, 1, 0, 1, 1, '2015-12-30 22:20:38', '2015-12-30 22:20:38'),
(68, 6, 34, 1, 0, 1, 1, '2015-12-30 22:20:46', '2015-12-30 22:20:46'),
(69, 7, 25, 1, 0, 1, 1, '2015-12-30 22:21:19', '2015-12-30 22:21:19'),
(70, 7, 32, 1, 0, 1, 1, '2015-12-30 22:22:20', '2015-12-30 22:22:20'),
(71, 7, 35, 1, 0, 1, 1, '2015-12-30 22:22:36', '2015-12-30 22:22:36'),
(72, 7, 42, 1, 0, 1, 1, '2015-12-30 22:22:43', '2015-12-30 22:22:43'),
(73, 1, 43, 1, 0, 1, 1, '2015-12-30 22:23:35', '2015-12-30 22:23:35'),
(74, 8, 44, 1, 0, 1, 1, '2015-12-30 22:23:51', '2015-12-30 22:23:51'),
(75, 9, 45, 1, 0, 1, 1, '2015-12-30 22:24:11', '2015-12-30 22:24:11'),
(76, 12, 46, 1, 0, 1, 1, '2015-12-30 22:24:25', '2015-12-30 22:24:25'),
(77, 7, 46, 1, 0, 1, 1, '2015-12-30 22:25:56', '2015-12-30 22:25:56'),
(78, 7, 47, 1, 0, 1, 1, '2015-12-30 22:26:08', '2015-12-30 22:26:08'),
(79, 7, 48, 1, 0, 1, 1, '2015-12-30 22:26:45', '2015-12-30 22:26:45'),
(80, 1, 49, 1, 0, 1, 1, '2015-12-30 22:27:51', '2015-12-30 22:27:51'),
(81, 1, 50, 1, 0, 1, 1, '2015-12-30 22:28:12', '2015-12-30 22:28:12'),
(82, 1, 52, 1, 0, 1, 1, '2015-12-30 22:28:28', '2015-12-30 22:28:28'),
(83, 3, 53, 1, 0, 1, 1, '2015-12-30 22:29:02', '2015-12-30 22:29:02'),
(84, 4, 54, 1, 0, 1, 1, '2015-12-30 22:29:17', '2015-12-30 22:29:17'),
(85, 13, 55, 1, 0, 1, 1, '2015-12-30 22:29:49', '2015-12-30 22:29:49'),
(86, 5, 49, 1, 0, 1, 1, '2015-12-30 22:30:38', '2015-12-30 22:30:38'),
(87, 5, 51, 1, 0, 1, 1, '2015-12-30 22:30:51', '2015-12-30 22:30:51'),
(88, 5, 4, 1, 0, 1, 1, '2015-12-30 22:31:02', '2015-12-30 22:31:02'),
(89, 5, 52, 1, 0, 1, 1, '2015-12-30 22:31:30', '2015-12-30 22:31:30'),
(90, 6, 52, 1, 0, 1, 1, '2015-12-30 22:31:53', '2015-12-30 22:31:53'),
(91, 7, 56, 1, 0, 1, 1, '2015-12-30 22:32:53', '2015-12-30 22:32:53'),
(92, 7, 49, 1, 0, 1, 1, '2015-12-30 22:33:00', '2015-12-30 22:33:00'),
(93, 7, 52, 1, 0, 1, 1, '2015-12-30 22:33:07', '2015-12-30 22:33:07'),
(94, 9, 53, 1, 0, 1, 1, '2015-12-30 22:35:53', '2015-12-30 22:35:53'),
(95, 1, 51, 1, 0, 1, 1, '2015-12-30 22:38:45', '2015-12-30 22:38:45'),
(96, 1, 57, 1, 0, 1, 1, '2015-12-30 22:39:27', '2015-12-30 22:39:27'),
(97, 4, 53, 1, 0, 1, 1, '2015-12-30 22:39:52', '2015-12-30 22:39:52'),
(98, 12, 56, 1, 0, 1, 1, '2015-12-30 22:40:10', '2015-12-30 22:40:10'),
(99, 12, 57, 1, 0, 1, 1, '2015-12-30 22:40:19', '2015-12-30 22:40:19'),
(100, 5, 57, 1, 0, 1, 1, '2015-12-30 22:41:15', '2015-12-30 22:41:15'),
(101, 7, 57, 1, 0, 1, 1, '2015-12-30 22:42:30', '2015-12-30 22:42:30'),
(102, 1, 58, 1, 0, 1, 1, '2015-12-30 22:43:37', '2015-12-30 22:43:37'),
(103, 12, 58, 1, 0, 1, 1, '2015-12-30 22:44:27', '2015-12-30 22:44:27'),
(104, 5, 58, 1, 0, 1, 1, '2015-12-30 22:45:19', '2015-12-30 22:45:19'),
(105, 7, 58, 1, 0, 1, 1, '2015-12-30 22:46:11', '2015-12-30 22:46:11'),
(106, 1, 59, 1, 0, 1, 1, '2015-12-30 22:46:53', '2015-12-30 22:46:53'),
(107, 1, 60, 1, 0, 1, 1, '2015-12-30 22:47:05', '2015-12-30 22:47:05'),
(108, 9, 65, 1, 0, 1, 1, '2015-12-30 22:48:12', '2015-12-30 22:48:12'),
(109, 14, 56, 1, 0, 1, 1, '2015-12-30 22:48:29', '2015-12-30 22:48:29'),
(110, 15, 66, 1, 0, 1, 1, '2015-12-30 22:48:46', '2015-12-30 22:48:46'),
(111, 15, 68, 1, 0, 1, 1, '2015-12-30 22:49:05', '2015-12-30 22:49:05'),
(112, 15, 61, 1, 0, 1, 1, '2015-12-30 22:49:19', '2015-12-30 22:49:19'),
(113, 15, 69, 1, 0, 1, 1, '2015-12-30 22:49:30', '2015-12-30 22:49:30'),
(114, 9, 66, 1, 0, 1, 1, '2015-12-30 22:49:59', '2015-12-30 22:49:59'),
(115, 9, 68, 1, 0, 1, 1, '2015-12-30 22:50:23', '2015-12-30 22:50:23'),
(116, 9, 61, 1, 0, 1, 1, '2015-12-30 22:50:53', '2015-12-30 22:50:53'),
(117, 9, 69, 1, 0, 1, 1, '2015-12-30 22:51:17', '2015-12-30 22:51:17'),
(118, 1, 70, 1, 0, 1, 1, '2015-12-30 22:52:06', '2015-12-30 22:52:06'),
(119, 7, 59, 1, 0, 1, 1, '2015-12-30 22:52:31', '2015-12-30 22:52:31'),
(120, 7, 3, 1, 0, 1, 1, '2015-12-30 22:52:53', '2015-12-30 22:52:53'),
(121, 7, 71, 1, 0, 1, 1, '2015-12-30 22:53:02', '2015-12-30 22:53:02'),
(122, 7, 2, 1, 0, 1, 1, '2015-12-30 22:53:27', '2015-12-30 22:53:27'),
(123, 1, 73, 1, 0, 1, 1, '2015-12-30 22:53:55', '2015-12-30 22:53:55'),
(124, 7, 72, 1, 0, 1, 1, '2015-12-30 22:54:54', '2015-12-30 22:54:54'),
(125, 7, 30, 1, 0, 1, 1, '2015-12-30 22:55:02', '2015-12-30 22:55:02'),
(126, 7, 28, 1, 0, 1, 1, '2015-12-30 22:55:11', '2015-12-30 22:55:11'),
(127, 7, 73, 1, 0, 1, 1, '2015-12-30 22:55:19', '2015-12-30 22:55:19'),
(128, 1, 74, 1, 0, 1, 1, '2015-12-30 22:56:08', '2015-12-30 22:56:08'),
(129, 6, 75, 1, 0, 1, 1, '2015-12-30 22:56:35', '2015-12-30 22:56:35'),
(130, 6, 68, 1, 0, 1, 1, '2015-12-30 22:56:43', '2015-12-30 22:56:43'),
(131, 6, 77, 1, 0, 1, 1, '2015-12-30 22:56:48', '2015-12-30 22:56:48'),
(132, 7, 68, 1, 0, 1, 1, '2015-12-30 22:57:24', '2015-12-30 22:57:24'),
(133, 7, 76, 1, 0, 1, 1, '2015-12-30 22:57:42', '2015-12-30 22:57:42'),
(134, 5, 68, 1, 0, 1, 1, '2015-12-30 22:58:14', '2015-12-30 22:58:14'),
(135, 5, 76, 1, 0, 1, 1, '2015-12-30 22:58:24', '2015-12-30 22:58:24'),
(136, 9, 67, 1, 0, 1, 1, '2015-12-30 22:59:09', '2015-12-30 22:59:09'),
(137, 16, 2, 1, 0, 1, 1, '2015-12-30 22:59:22', '2015-12-30 22:59:22'),
(138, 16, 3, 1, 0, 1, 1, '2015-12-30 22:59:30', '2015-12-30 22:59:30'),
(139, 17, 56, 1, 0, 1, 1, '2015-12-30 23:00:05', '2015-12-30 23:00:05'),
(140, 1, 62, 1, 0, 1, 1, '2015-12-30 23:00:20', '2015-12-30 23:00:20'),
(141, 18, 67, 1, 0, 1, 1, '2015-12-30 23:00:38', '2015-12-30 23:00:38'),
(142, 19, 67, 1, 0, 1, 1, '2015-12-30 23:01:00', '2015-12-30 23:01:00'),
(143, 20, 64, 1, 0, 1, 1, '2015-12-30 23:01:12', '2015-12-30 23:01:12'),
(144, 20, 63, 1, 0, 1, 1, '2015-12-30 23:01:22', '2015-12-30 23:01:22'),
(145, 20, 78, 1, 0, 1, 1, '2015-12-30 23:01:35', '2015-12-30 23:01:35'),
(146, 12, 78, 1, 0, 1, 1, '2015-12-30 23:01:48', '2015-12-30 23:01:48'),
(147, 21, 67, 1, 0, 1, 1, '2015-12-30 23:02:17', '2015-12-30 23:02:17'),
(148, 8, 67, 1, 0, 1, 1, '2015-12-30 23:03:15', '2015-12-30 23:03:15'),
(149, 12, 79, 1, 0, 1, 1, '2015-12-30 23:03:34', '2015-12-30 23:03:34'),
(150, 12, 80, 1, 0, 1, 1, '2015-12-30 23:03:55', '2015-12-30 23:03:55'),
(151, 10, 79, 1, 0, 1, 1, '2015-12-30 23:04:11', '2015-12-30 23:04:11'),
(152, 10, 80, 1, 0, 1, 1, '2015-12-30 23:04:21', '2015-12-30 23:04:21'),
(153, 20, 79, 1, 0, 1, 1, '2015-12-30 23:04:44', '2015-12-30 23:04:44'),
(154, 20, 80, 1, 0, 1, 1, '2015-12-30 23:04:54', '2015-12-30 23:04:54'),
(155, 22, 81, 1, 0, 1, 1, '2015-12-30 23:05:24', '2015-12-30 23:05:24'),
(156, 22, 82, 1, 0, 1, 1, '2015-12-30 23:05:33', '2015-12-30 23:05:33'),
(157, 22, 83, 1, 0, 1, 1, '2015-12-30 23:05:45', '2015-12-30 23:05:45'),
(158, 4, 84, 1, 0, 1, 1, '2015-12-30 23:16:36', '2015-12-30 23:16:36'),
(159, 4, 85, 1, 0, 1, 1, '2015-12-30 23:16:48', '2015-12-30 23:16:48'),
(160, 4, 90, 1, 0, 1, 1, '2015-12-30 23:17:02', '2015-12-30 23:17:02'),
(161, 4, 92, 1, 0, 1, 1, '2015-12-30 23:17:22', '2015-12-30 23:17:22'),
(162, 22, 86, 1, 0, 1, 1, '2015-12-30 23:17:50', '2015-12-30 23:17:50'),
(163, 22, 99, 1, 0, 1, 1, '2015-12-30 23:18:04', '2015-12-30 23:18:04'),
(164, 22, 51, 1, 0, 1, 1, '2015-12-30 23:18:25', '2015-12-30 23:18:25'),
(165, 22, 100, 1, 0, 1, 1, '2015-12-30 23:18:35', '2015-12-30 23:18:35'),
(166, 4, 93, 1, 0, 1, 1, '2015-12-30 23:19:14', '2015-12-30 23:19:14'),
(167, 13, 100, 1, 0, 1, 1, '2015-12-30 23:19:40', '2015-12-30 23:19:40'),
(168, 12, 100, 1, 0, 1, 1, '2015-12-30 23:19:50', '2015-12-30 23:19:50'),
(169, 12, 99, 1, 0, 1, 1, '2015-12-30 23:20:00', '2015-12-30 23:20:00'),
(170, 23, 101, 1, 0, 1, 1, '2015-12-30 23:20:20', '2015-12-30 23:20:20'),
(171, 24, 101, 1, 0, 1, 1, '2015-12-30 23:20:37', '2015-12-30 23:20:37'),
(172, 24, 94, 1, 0, 1, 1, '2015-12-30 23:20:55', '2015-12-30 23:20:55'),
(173, 24, 87, 1, 0, 1, 1, '2015-12-30 23:21:06', '2015-12-30 23:21:06'),
(174, 1, 104, 1, 0, 1, 1, '2015-12-30 23:21:52', '2015-12-30 23:21:52'),
(175, 1, 105, 1, 0, 1, 1, '2015-12-30 23:22:00', '2015-12-30 23:22:00'),
(176, 1, 107, 1, 0, 1, 1, '2015-12-30 23:22:11', '2015-12-30 23:22:11'),
(177, 1, 111, 1, 0, 1, 1, '2015-12-30 23:22:35', '2015-12-30 23:22:35'),
(178, 1, 91, 1, 0, 1, 1, '2015-12-30 23:22:45', '2015-12-30 23:22:45'),
(179, 1, 112, 1, 0, 1, 1, '2015-12-30 23:23:21', '2015-12-30 23:23:21'),
(180, 1, 113, 1, 0, 1, 1, '2015-12-30 23:23:29', '2015-12-30 23:23:29'),
(181, 1, 114, 1, 0, 1, 1, '2015-12-30 23:23:38', '2015-12-30 23:23:38'),
(182, 7, 111, 1, 0, 1, 1, '2015-12-30 23:24:03', '2015-12-30 23:24:03'),
(183, 7, 115, 1, 0, 1, 1, '2015-12-30 23:24:28', '2015-12-30 23:24:28'),
(184, 7, 91, 1, 0, 1, 1, '2015-12-30 23:25:03', '2015-12-30 23:25:03'),
(185, 7, 116, 1, 0, 1, 1, '2015-12-30 23:25:45', '2015-12-30 23:25:45'),
(186, 5, 111, 1, 0, 1, 1, '2015-12-30 23:26:17', '2015-12-30 23:26:17'),
(187, 5, 59, 1, 0, 1, 1, '2015-12-30 23:26:28', '2015-12-30 23:26:28'),
(188, 12, 52, 1, 0, 1, 1, '2015-12-30 23:26:54', '2015-12-30 23:26:54'),
(189, 12, 102, 1, 0, 1, 1, '2015-12-30 23:27:21', '2015-12-30 23:27:21'),
(190, 12, 118, 1, 0, 1, 1, '2015-12-30 23:27:30', '2015-12-30 23:27:30'),
(191, 12, 2, 1, 0, 1, 1, '2015-12-30 23:27:42', '2015-12-30 23:27:42'),
(192, 25, 2, 1, 0, 1, 1, '2015-12-30 23:27:56', '2015-12-30 23:27:56'),
(193, 25, 3, 1, 0, 1, 1, '2015-12-30 23:28:04', '2015-12-30 23:28:04'),
(194, 25, 43, 1, 0, 1, 1, '2015-12-30 23:28:13', '2015-12-30 23:28:13'),
(195, 25, 72, 1, 0, 1, 1, '2015-12-30 23:28:25', '2015-12-30 23:28:25'),
(196, 25, 9, 1, 0, 1, 1, '2015-12-30 23:28:35', '2015-12-30 23:28:35'),
(197, 25, 69, 1, 0, 1, 1, '2015-12-30 23:28:50', '2015-12-30 23:28:50'),
(198, 25, 112, 1, 0, 1, 1, '2015-12-30 23:28:58', '2015-12-30 23:28:58'),
(199, 25, 113, 1, 0, 1, 1, '2015-12-30 23:29:05', '2015-12-30 23:29:05'),
(200, 25, 114, 1, 0, 1, 1, '2015-12-30 23:29:14', '2015-12-30 23:29:14'),
(201, 25, 119, 1, 0, 1, 1, '2015-12-30 23:29:22', '2015-12-30 23:29:22'),
(202, 6, 102, 1, 0, 1, 1, '2015-12-30 23:29:53', '2015-12-30 23:29:53'),
(203, 6, 118, 1, 0, 1, 1, '2015-12-30 23:30:19', '2015-12-30 23:30:19'),
(204, 6, 120, 1, 0, 1, 1, '2015-12-30 23:30:32', '2015-12-30 23:30:32'),
(205, 1, 95, 1, 0, 1, 1, '2015-12-30 23:31:07', '2015-12-30 23:31:07'),
(206, 1, 88, 1, 0, 1, 1, '2015-12-30 23:31:18', '2015-12-30 23:31:18'),
(207, 1, 120, 1, 0, 1, 1, '2015-12-30 23:31:33', '2015-12-30 23:31:33'),
(208, 22, 102, 1, 0, 1, 1, '2015-12-30 23:32:01', '2015-12-30 23:32:01'),
(209, 22, 118, 1, 0, 1, 1, '2015-12-30 23:32:11', '2015-12-30 23:32:11'),
(210, 6, 82, 1, 0, 1, 1, '2015-12-30 23:32:38', '2015-12-30 23:32:38'),
(211, 14, 102, 1, 0, 1, 1, '2015-12-30 23:32:54', '2015-12-30 23:32:54'),
(212, 14, 118, 1, 0, 1, 1, '2015-12-30 23:33:04', '2015-12-30 23:33:04'),
(213, 14, 122, 1, 0, 1, 1, '2015-12-30 23:33:12', '2015-12-30 23:33:12'),
(214, 1, 86, 1, 0, 1, 1, '2015-12-30 23:33:41', '2015-12-30 23:33:41'),
(215, 1, 108, 1, 0, 1, 1, '2015-12-30 23:33:55', '2015-12-30 23:33:55'),
(216, 4, 106, 1, 0, 1, 1, '2015-12-30 23:34:54', '2015-12-30 23:34:54'),
(217, 13, 109, 1, 0, 1, 1, '2015-12-30 23:35:20', '2015-12-30 23:35:20'),
(218, 13, 117, 1, 0, 1, 1, '2015-12-30 23:35:30', '2015-12-30 23:35:30'),
(219, 13, 96, 1, 0, 1, 1, '2015-12-30 23:35:45', '2015-12-30 23:35:45'),
(220, 1, 47, 1, 0, 1, 1, '2015-12-30 23:37:18', '2015-12-30 23:37:18'),
(221, 1, 72, 1, 0, 1, 1, '2015-12-30 23:37:25', '2015-12-30 23:37:25'),
(222, 6, 103, 1, 0, 1, 1, '2015-12-30 23:39:10', '2015-12-30 23:39:10'),
(223, 26, 103, 1, 0, 1, 1, '2015-12-30 23:39:23', '2015-12-30 23:39:23'),
(224, 26, 118, 1, 0, 1, 1, '2015-12-30 23:39:33', '2015-12-30 23:39:33'),
(225, 1, 68, 1, 0, 1, 1, '2015-12-30 23:42:16', '2015-12-30 23:42:16'),
(226, 1, 123, 1, 0, 1, 1, '2015-12-30 23:42:49', '2015-12-30 23:42:49'),
(227, 1, 77, 1, 0, 1, 1, '2015-12-30 23:43:00', '2015-12-30 23:43:00'),
(228, 1, 121, 1, 0, 1, 1, '2015-12-30 23:43:23', '2015-12-30 23:43:23'),
(229, 7, 86, 1, 0, 1, 1, '2015-12-30 23:44:21', '2015-12-30 23:44:21'),
(230, 7, 77, 1, 0, 1, 1, '2015-12-30 23:44:34', '2015-12-30 23:44:34'),
(231, 5, 86, 1, 0, 1, 1, '2015-12-30 23:45:52', '2015-12-30 23:45:52'),
(232, 6, 51, 1, 0, 1, 1, '2015-12-30 23:46:18', '2015-12-30 23:46:18'),
(233, 6, 1, 1, 0, 1, 1, '2015-12-30 23:46:40', '2015-12-30 23:46:40'),
(234, 6, 72, 1, 0, 1, 1, '2015-12-30 23:46:59', '2015-12-30 23:46:59'),
(235, 27, 95, 1, 0, 1, 1, '2015-12-30 23:52:01', '2015-12-30 23:52:01'),
(236, 27, 86, 1, 0, 1, 1, '2015-12-30 23:52:18', '2015-12-30 23:52:18'),
(237, 27, 2, 1, 0, 1, 1, '2015-12-30 23:52:28', '2015-12-30 23:52:28'),
(238, 27, 110, 1, 0, 1, 1, '2015-12-30 23:52:44', '2015-12-30 23:52:44'),
(239, 27, 69, 1, 0, 1, 1, '2015-12-30 23:53:59', '2015-12-30 23:53:59'),
(240, 27, 72, 1, 0, 1, 1, '2015-12-30 23:54:10', '2015-12-30 23:54:10'),
(241, 27, 68, 1, 0, 1, 1, '2015-12-30 23:54:20', '2015-12-30 23:54:20'),
(242, 28, 135, 1, 0, 1, 1, '2015-12-30 23:55:09', '2015-12-30 23:55:09'),
(243, 1, 89, 1, 0, 1, 1, '2015-12-30 23:55:39', '2015-12-30 23:55:39'),
(244, 1, 97, 1, 0, 1, 1, '2015-12-30 23:56:07', '2015-12-30 23:56:07'),
(245, 1, 69, 1, 0, 1, 1, '2015-12-30 23:56:50', '2015-12-30 23:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `basic_tasks`
--

CREATE TABLE IF NOT EXISTS `basic_tasks` (
`id` int(10) unsigned NOT NULL,
  `cause_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `list_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complex`
--

CREATE TABLE IF NOT EXISTS `complex` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complex`
--

INSERT INTO `complex` (`id`, `name`, `created_at`, `updated_at`, `active`, `project_id`) VALUES
(1, '4 * 4', '2015-12-07 05:46:33', '2015-12-07 05:46:42', 1, NULL),
(2, '5 * 5', '2015-12-07 05:46:51', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complex_detail_default`
--

CREATE TABLE IF NOT EXISTS `complex_detail_default` (
`id` int(11) NOT NULL,
  `complex_id` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `columns` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL COMMENT '1 = info\n2 = occur\n3 = detect\n4 = severity\n5 = color\n6 = header\n7 = color header',
  `ref1` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `complex_detail_default`
--

INSERT INTO `complex_detail_default` (`id`, `complex_id`, `rows`, `columns`, `description`, `type`, `ref1`, `created_by`, `created_at`, `updated_at`, `updated_by`, `active`, `project_id`) VALUES
(1, 2, 1, 1, '< 0.3 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(2, 2, 1, 2, '< 0.1 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(3, 2, 1, 3, '< 0.01 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(4, 2, 1, 4, 'No/Slight Effect', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(5, 2, 1, 5, '"- No or Slight impact to Community, Reputation and Customer\r- No fault or insignificant fault of complying with laws/articles of association."', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(6, 2, 1, 6, '"- No injury or First Aid case\r- No or very low health effect\r-  No or Minimal morale impact"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(7, 2, 2, 1, '0.3 - <3 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(8, 2, 2, 2, '0.1 - <1 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(9, 2, 2, 3, '0.01 - < 0.1 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(10, 2, 2, 4, 'Minor Effect', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(11, 2, 2, 5, '"- Minor impact with short term recovery\r- Local media\r- Verbal complaints\r- Partly comply with laws/articles of association."', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(12, 2, 2, 6, '"- Medical treatment or Restrict to work\r-  Low health effect\r- Short-term morale impact"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(13, 2, 3, 1, '3 - <30 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(14, 2, 3, 2, '1 - <10 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(15, 2, 3, 3, '0.1 - <1 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(16, 2, 3, 4, 'Moderate Effect', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(17, 2, 3, 5, '"- Moderate impact with long term recovery\r- Regional media\r- Official letter complaint\r- Non-compliance with laws/articles of association"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(18, 2, 3, 6, '"- Loss time injury\r- Medium health effect\r- Long-term morale impact"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(19, 2, 4, 1, '30 - <300 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(20, 2, 4, 2, '10 - <100 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(21, 2, 4, 3, '1 - <10 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(22, 2, 4, 4, 'Major Effect', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(23, 2, 4, 5, '"- Major impact with national concern\r- National media\r- Customer less purchase\r- Violate the laws/ articles of association.\r"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(24, 2, 4, 6, '"- Single fatality or Permanent total disabilities\r- High health effect\r- Protesters rally or official complaint"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(25, 2, 5, 1, '>300 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-09 16:14:13', 0, 1, 0),
(26, 2, 5, 2, '>100 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-09 16:14:26', 0, 1, 0),
(27, 2, 5, 3, '>10 M', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-09 16:14:39', 0, 1, 0),
(28, 2, 5, 4, 'Massive Effect', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(29, 2, 5, 5, '"- Massive impact with international concern\r- International media\r- Customer stop purchase\r- Violate the laws/ articles of association, and/or subject to order to dissolve the company\r"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(30, 2, 5, 6, '"-  Many fatalities\r- High health effect\r- Employees or Contractors strike"', 1, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(31, 2, 1, 0, '2', 4, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(32, 2, 2, 0, '4', 4, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(33, 2, 3, 0, '6', 4, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(34, 2, 4, 0, '8', 4, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(35, 2, 5, 0, '10', 4, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(36, 2, 0, 1, '"GPC \r(THB)"', 6, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(37, 2, 0, 2, '" BU \r(THB)"', 6, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(38, 2, 0, 3, 'Small BU (THB)', 6, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(39, 2, 0, 4, 'Environment', 6, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(40, 2, 0, 5, '"(Community, Reputation, \rCustomer, Law &Regulation)"', 6, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(41, 2, 0, 6, '(Safety, Health, Morale)', 6, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(42, 2, 1, 1, '#00B050', 5, 'Non Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(43, 2, 1, 2, '#00B050', 5, 'Non Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(44, 2, 1, 3, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(45, 2, 1, 4, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(46, 2, 1, 5, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(47, 2, 2, 1, '#00B050', 5, 'Non Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(48, 2, 2, 2, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(49, 2, 2, 3, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(50, 2, 2, 4, '#FFC000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(51, 2, 2, 5, '#FFC000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(52, 2, 3, 1, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(53, 2, 3, 2, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(54, 2, 3, 3, '#FFC000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(55, 2, 3, 4, '#FF0000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(56, 2, 3, 5, '#FF0000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(57, 2, 4, 1, '#FFFF00', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(58, 2, 4, 2, '#FFC000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(59, 2, 4, 3, '#FF0000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(60, 2, 4, 4, '#FF0000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(61, 2, 4, 5, '#C00000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(62, 2, 5, 1, '#FFC000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(63, 2, 5, 2, '#FFC000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(64, 2, 5, 3, '#FF0000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(65, 2, 5, 4, '#C00000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(66, 2, 5, 5, '#C00000', 5, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(67, 2, 1, 0, 'Extreme Unlikelihood', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(68, 2, 2, 0, 'Remote likelihood', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(69, 2, 3, 0, 'Very low likelihood', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(70, 2, 4, 0, 'Low likelihood', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(71, 2, 5, 0, 'Moderate', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(72, 2, 6, 0, 'Medium', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(73, 2, 7, 0, 'Moderately High', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(74, 2, 8, 0, 'High', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(75, 2, 9, 0, 'Very High', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(76, 2, 10, 0, 'Extremely Likely', 2, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(77, 2, 8, 0, 'Can know unusual sign before failure occuring', 3, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(78, 2, 10, 0, 'Can not know any sign before failure occuring', 3, 'Critical', 0, '0000-00-00 00:00:00', '2015-12-07 05:48:18', 0, 1, 0),
(79, 2, 0, 1, '1-20', 7, 'Critical', NULL, '2015-12-07 07:14:05', NULL, NULL, 1, NULL),
(80, 2, 0, 2, '21-40', 7, 'Critical', NULL, '2015-12-07 07:14:26', NULL, NULL, 1, NULL),
(81, 2, 0, 3, '41-60', 7, 'Critical', NULL, '2015-12-07 07:14:53', NULL, NULL, 1, NULL),
(82, 2, 0, 4, '61-80', 7, 'Critical', NULL, '2015-12-07 07:15:15', NULL, NULL, 1, NULL),
(83, 2, 0, 5, '81-100', 7, 'Critical', NULL, '2015-12-07 07:15:31', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `level` int(11) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level`, `description`, `type_name`) VALUES
(1, 'Company Name', 'COMPANY'),
(2, 'Business Name', 'BUSINESS UNIT'),
(3, 'Complex Name', 'COMPLEX'),
(4, 'Location Name', 'LOCATION'),
(5, 'Function Group Name', 'FUNCTION GROUP'),
(6, 'Package Name', 'PACKAGE'),
(7, 'Assembly Name', 'ASSEMBLY'),
(8, 'Sub Assembly Name', 'SUB ASSEMBLY');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1' COMMENT '3 = administrator ,2 = User, 1 = Observer',
  `active` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `name`, `username`, `password`, `role`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', 'Administrator', 'admin', '$2y$10$UMBBwNbOgRWb5DVy8llu8eV/kq01TJqyamCG02YY6.3sdQUsPLMgO', 3, 1, 'YAK5Dh9PjlBcaXGWRClXwiGwE3jS4fPp7sSY4VcjHJ8Abjs1uWViTImhEUM0', '2015-11-03 16:43:34', '2016-01-12 02:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_09_23_035815_create_members_table', 1),
('2015_09_25_180338_create_projects_table', 1),
('2015_09_26_155618_create_ref_types_table', 1),
('2015_09_26_161759_create_ref_parts_table', 1),
('2015_09_26_192418_create_ref_categories_table', 1),
('2015_10_11_160253_create_table_ref_failure_mode', 1),
('2015_10_11_163409_create_table_basic_equipments', 2),
('2015_10_11_163619_create_table_ref_failure_cause', 3),
('2015_10_11_174609_create_ref_task_types_table', 4),
('2015_10_11_174616_create_ref_task_lists_table', 4),
('2015_10_11_181352_create_ref_task_intervals_table', 5),
('2015_10_17_154103_create_basic_failures_table', 6),
('2015_10_17_170549_create_basic_tasks_table', 7),
('2015_10_17_185523_create_ref_task_lists_table', 8),
('2015_10_17_191111_create_basic_tasks_table', 9),
('2015_11_01_093506_create_asset_registers_table', 10),
('2015_11_25_155640_create_package_assumptions_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `package_assumptions`
--

CREATE TABLE IF NOT EXISTS `package_assumptions` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `package_assumptions`
--

INSERT INTO `package_assumptions` (`id`, `name`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'BOG compressor', 'Boil off gas', 1, 1, 0, 2, '2016-01-12 02:03:11', '2016-01-12 02:19:34'),
(2, 'BOG compressor', 'test', 1, 1, 1, 2, '2016-01-12 02:45:19', '2016-01-12 02:45:32'),
(3, 'LNG - 0001', 'test', 1, 0, 1, 2, '2016-01-12 02:46:06', '2016-01-12 02:46:06'),
(4, 'BOG compressor', 'vvv', 1, 0, 1, 2, '2016-01-12 02:46:52', '2016-01-12 02:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `member_id`, `created_by`, `updated_by`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PTT GLOBAL CHEMICAL', 1, 1, 0, 1, '2015-12-28 23:00:25', '2015-12-28 23:00:25'),
(2, 'Test', 1, 1, 0, 1, '2016-01-12 01:54:16', '2016-01-12 01:54:16'),
(3, 'test 1', 1, 1, 0, 0, '2016-01-12 01:54:44', '2016-01-12 01:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `ref_activity_status`
--

CREATE TABLE IF NOT EXISTS `ref_activity_status` (
`activity_status_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'Existing Task\nChange Detail',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Evident\nHidden\n',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `project_id` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ref_activity_status`
--

INSERT INTO `ref_activity_status` (`activity_status_id`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`, `project_id`) VALUES
(1, 'Existing Task', '2015-12-21 16:21:20', NULL, NULL, NULL, 1, 0),
(2, 'Change Detail', '2015-12-21 16:21:22', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_categories`
--

CREATE TABLE IF NOT EXISTS `ref_categories` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ref_categories`
--

INSERT INTO `ref_categories` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Electric', 1, 0, 1, 1, '2015-12-28 23:15:43', '2015-12-28 23:15:43'),
(2, 'Instrument', 1, 0, 1, 1, '2015-12-28 23:15:47', '2015-12-28 23:15:47'),
(3, 'Mechanic', 1, 0, 1, 1, '2015-12-28 23:15:51', '2015-12-28 23:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `ref_evident`
--

CREATE TABLE IF NOT EXISTS `ref_evident` (
`evident_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Evident\nHidden\n',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ref_evident`
--

INSERT INTO `ref_evident` (`evident_id`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`, `project_id`) VALUES
(1, 'Evident', '2015-12-21 16:10:41', NULL, NULL, NULL, 1, 0),
(2, 'Hidden', '2015-12-21 16:10:43', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_failure_cause`
--

CREATE TABLE IF NOT EXISTS `ref_failure_cause` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=136 ;

--
-- Dumping data for table `ref_failure_cause`
--

INSERT INTO `ref_failure_cause` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Misalignment', 1, 0, 1, 1, '2015-12-29 20:42:29', '2015-12-29 20:42:29'),
(2, 'Corrosion', 1, 0, 1, 1, '2015-12-29 20:42:45', '2015-12-29 20:42:45'),
(3, 'Erosion', 1, 0, 1, 1, '2015-12-29 20:43:00', '2015-12-29 20:43:00'),
(4, 'Looseness (Bearing)', 1, 0, 1, 1, '2015-12-29 20:43:14', '2015-12-29 20:43:14'),
(5, 'Looseness (Internal Parts)', 1, 0, 1, 1, '2015-12-29 20:43:37', '2015-12-29 20:43:37'),
(6, 'Insufficient Lubrication (Bearing)', 1, 0, 1, 1, '2015-12-29 20:44:03', '2015-12-29 20:44:03'),
(7, 'Breakage (Radial Bearing)', 1, 0, 1, 1, '2015-12-29 20:44:24', '2015-12-29 20:44:24'),
(8, 'Breakage (Thrust Bearing)', 1, 0, 1, 1, '2015-12-29 20:44:44', '2015-12-29 20:44:44'),
(9, 'Surge', 1, 0, 1, 1, '2015-12-29 20:44:57', '2015-12-29 20:44:57'),
(10, 'Blockage/Plugged (Fouling)', 1, 0, 1, 1, '2015-12-29 20:45:18', '2015-12-29 20:45:18'),
(11, 'Leakage (Shaft Seal or Flange or Casing)', 1, 0, 1, 1, '2015-12-29 20:45:41', '2015-12-29 20:45:41'),
(12, 'Leakage (Dry Gas Seal or Oil Film Seal or Labyrinth Seal)', 1, 0, 1, 1, '2015-12-29 20:46:11', '2015-12-29 20:46:11'),
(13, 'Leakage (Lube Oil)', 1, 0, 1, 1, '2015-12-29 20:46:29', '2015-12-29 20:46:29'),
(14, 'Leakage (Seal Oil)', 1, 0, 1, 1, '2015-12-29 20:46:35', '2015-12-29 20:46:35'),
(15, 'Looseness (Radial Bearing)', 1, 0, 1, 1, '2015-12-29 20:46:47', '2015-12-29 20:46:47'),
(16, 'Looseness (Thrust Bearing)', 1, 0, 1, 1, '2015-12-29 20:46:55', '2015-12-29 20:46:55'),
(17, 'Breakage (Bearing)', 1, 0, 1, 1, '2015-12-29 20:47:08', '2015-12-29 20:47:08'),
(18, 'Breakage (Impeller)', 1, 0, 1, 1, '2015-12-29 20:47:26', '2015-12-29 20:47:26'),
(19, 'Breakage (Shaft)', 1, 0, 1, 1, '2015-12-29 20:47:37', '2015-12-29 20:47:37'),
(20, 'Unbalance (Rotating Parts)', 1, 0, 1, 1, '2015-12-29 20:47:48', '2015-12-29 20:47:48'),
(21, 'Wear (Internal Parts)', 1, 0, 1, 1, '2015-12-29 20:47:58', '2015-12-29 20:47:58'),
(22, 'Structural Deficiency (Footing or Base Plate)', 1, 0, 1, 1, '2015-12-29 20:48:13', '2015-12-29 20:48:13'),
(23, 'Process Deviation', 1, 0, 1, 1, '2015-12-29 20:48:21', '2015-12-29 20:48:21'),
(24, 'Breakage (Bolt)', 1, 0, 1, 1, '2015-12-29 20:48:40', '2015-12-29 20:48:40'),
(25, 'Breakage (Crosshead and Crosshead Pin)', 1, 0, 1, 1, '2015-12-29 20:49:27', '2015-12-29 20:49:27'),
(26, 'Breakage (Diaphagm)', 1, 0, 1, 1, '2015-12-29 20:49:55', '2015-12-29 20:49:55'),
(27, 'Breakage (Plunger)', 1, 0, 1, 1, '2015-12-29 20:50:21', '2015-12-29 20:50:21'),
(28, 'Deformation (Shaft)', 1, 0, 1, 1, '2015-12-29 20:50:57', '2015-12-29 20:50:57'),
(29, 'Fatigue (Crosshead Pin)', 1, 0, 1, 1, '2015-12-29 20:51:16', '2015-12-29 20:51:16'),
(30, 'Fatigue (Shaft)', 1, 0, 1, 1, '2015-12-29 20:51:37', '2015-12-29 20:51:37'),
(31, 'Insufficient Lubrication (Crosshead)', 1, 0, 1, 1, '2015-12-29 20:52:17', '2015-12-29 20:52:17'),
(32, 'Looseness (Bolt)', 1, 0, 1, 1, '2015-12-29 20:52:52', '2015-12-29 20:52:52'),
(33, 'Overpressure', 1, 0, 1, 1, '2015-12-29 20:53:09', '2015-12-29 20:53:09'),
(34, 'Overpressure (Relief Valve Malfunction)', 1, 0, 1, 1, '2015-12-29 20:53:28', '2015-12-29 20:53:28'),
(35, 'Wear (Crosshead)', 1, 0, 1, 1, '2015-12-29 20:53:47', '2015-12-29 20:53:47'),
(36, 'Material Deterioration (O-Ring, Packing)', 1, 0, 1, 1, '2015-12-29 20:54:14', '2015-12-29 20:54:14'),
(37, 'Leakage (Packing)', 1, 0, 1, 1, '2015-12-29 20:54:33', '2015-12-29 20:54:33'),
(38, 'Leakage (Shaft Seal or Compressor Casing)', 1, 0, 1, 1, '2015-12-29 20:54:54', '2015-12-29 20:54:54'),
(39, 'Control Failure (Capacity Control)', 1, 0, 1, 1, '2015-12-29 20:55:12', '2015-12-29 20:55:12'),
(40, 'Leakage (Relief Valve, Suction Valve, Discharge Valve)', 1, 0, 1, 1, '2015-12-29 20:55:35', '2015-12-29 20:55:35'),
(41, 'Leakage (Relief Valve Malfunction)', 1, 0, 1, 1, '2015-12-29 20:55:51', '2015-12-29 20:55:51'),
(42, 'Wear (Shaft)', 1, 0, 1, 1, '2015-12-29 20:56:08', '2015-12-29 20:56:08'),
(43, 'Fatigue', 1, 0, 1, 1, '2015-12-29 20:56:31', '2015-12-29 20:56:31'),
(44, 'Material Deterioration (Mechanical Seal)', 1, 0, 1, 1, '2015-12-29 20:56:47', '2015-12-29 20:56:47'),
(45, 'Material Deterioration (Seal Oil)', 1, 0, 1, 1, '2015-12-29 20:56:59', '2015-12-29 20:56:59'),
(46, 'Clearance Failure (Screw)', 1, 0, 1, 1, '2015-12-29 20:57:09', '2015-12-29 20:57:09'),
(47, 'Looseness', 1, 0, 1, 1, '2015-12-29 20:57:33', '2015-12-29 20:57:33'),
(48, 'Wear (Bearing)', 1, 0, 1, 1, '2015-12-29 20:57:44', '2015-12-29 20:57:44'),
(49, 'Cavitation', 1, 0, 1, 1, '2015-12-29 20:58:16', '2015-12-29 20:58:16'),
(50, 'Dry Running (Loss Suction)', 1, 0, 1, 1, '2015-12-29 20:58:54', '2015-12-29 20:58:54'),
(51, 'Dry Running', 1, 0, 1, 1, '2015-12-29 20:59:04', '2015-12-29 20:59:04'),
(52, 'Recirculation', 1, 0, 1, 1, '2015-12-29 21:00:16', '2015-12-29 21:00:16'),
(53, 'Leakage (Shaft Seal)', 1, 0, 1, 1, '2015-12-29 21:00:38', '2015-12-29 21:00:38'),
(54, 'Leakage (Cooling Water)', 1, 0, 1, 1, '2015-12-29 21:00:46', '2015-12-29 21:00:46'),
(55, 'Leakage (Baliler Fluide)', 1, 0, 1, 1, '2015-12-29 21:01:13', '2015-12-29 21:01:13'),
(56, 'Blockage/Plugged', 1, 0, 1, 1, '2015-12-29 21:01:28', '2015-12-29 21:01:28'),
(57, 'Wear (Screw)', 1, 0, 1, 1, '2015-12-29 21:07:53', '2015-12-29 21:07:53'),
(58, 'Wear (Gear)', 1, 0, 1, 1, '2015-12-29 21:10:52', '2015-12-29 21:10:52'),
(59, 'Breakage (Blade)', 1, 0, 1, 1, '2015-12-29 21:11:46', '2015-12-29 21:11:46'),
(60, 'Breakage (Thermal Shock)', 1, 0, 1, 1, '2015-12-29 21:12:04', '2015-12-29 21:12:04'),
(61, 'Breakage (Only Carbon Ring)', 1, 0, 1, 1, '2015-12-29 21:12:25', '2015-12-29 21:12:25'),
(62, 'Breakage (Bolt, Casing)', 1, 0, 1, 1, '2015-12-29 21:13:33', '2015-12-29 21:13:33'),
(63, 'Erosion (Valve Seat)', 1, 0, 1, 1, '2015-12-29 21:13:50', '2015-12-29 21:13:50'),
(64, 'Corrosion (Valve Seat)', 1, 0, 1, 1, '2015-12-29 21:14:29', '2015-12-29 21:14:29'),
(65, 'Material Failure - General (Gasket)', 1, 0, 1, 1, '2015-12-29 21:15:09', '2015-12-29 21:15:09'),
(66, 'Material Failure - General', 1, 0, 1, 1, '2015-12-29 21:15:17', '2015-12-29 21:15:17'),
(67, 'Material Failure - General (Gasket, O-Ring, Packing)', 1, 0, 1, 1, '2015-12-29 21:15:45', '2015-12-29 21:15:45'),
(68, 'Clearance Failure', 1, 0, 1, 1, '2015-12-29 21:16:06', '2015-12-29 21:16:06'),
(69, 'Wear', 1, 0, 1, 1, '2015-12-29 21:16:30', '2015-12-29 21:16:30'),
(70, 'Fatigue (Blade)', 1, 0, 1, 1, '2015-12-29 21:16:50', '2015-12-29 21:16:50'),
(71, 'Rubbing (Between Blade and Casing)', 1, 0, 1, 1, '2015-12-29 21:17:25', '2015-12-29 21:17:25'),
(72, 'Rubbing', 1, 0, 1, 1, '2015-12-29 21:17:27', '2015-12-29 21:17:27'),
(73, 'Wear (Shaft, Bearing Position)', 1, 0, 1, 1, '2015-12-29 21:18:07', '2015-12-29 21:18:07'),
(74, 'Loss of Lubrication (Roller Bearing and Oil Bath Type)', 1, 0, 1, 1, '2015-12-29 21:18:52', '2015-12-29 21:18:52'),
(75, 'Loss of Lubrication (Roller Bearing, Ball Bearing)', 1, 0, 1, 1, '2015-12-29 21:19:17', '2015-12-29 21:19:17'),
(76, 'Looseness (Bearing, Bearing Housing)', 1, 0, 1, 1, '2015-12-29 21:19:36', '2015-12-29 21:19:36'),
(77, 'Excessive Load', 1, 0, 1, 1, '2015-12-29 21:19:59', '2015-12-29 21:19:59'),
(78, 'Malfunction (Stuck)', 1, 0, 1, 1, '2015-12-29 21:20:12', '2015-12-29 21:20:12'),
(79, 'Stuck (Internal Parts)', 1, 0, 1, 1, '2015-12-29 21:20:23', '2015-12-29 21:20:23'),
(80, 'Leakage (Hydraulic Actuator)', 1, 0, 1, 1, '2015-12-29 21:20:43', '2015-12-29 21:20:43'),
(81, 'Electrical Failure', 1, 0, 1, 1, '2015-12-29 21:21:08', '2015-12-29 21:21:08'),
(82, 'Control Failure', 1, 0, 1, 1, '2015-12-29 21:21:34', '2015-12-29 21:21:34'),
(83, 'Breakage (Coupling, Pump Casing Crack)', 1, 0, 1, 1, '2015-12-29 21:22:37', '2015-12-29 21:22:37'),
(84, 'Breakage (Pipe)', 1, 0, 1, 1, '2015-12-29 21:22:44', '2015-12-29 21:22:44'),
(85, 'Breakage (Host)', 1, 0, 1, 1, '2015-12-29 21:22:53', '2015-12-29 21:22:53'),
(86, 'Breakage', 1, 0, 1, 1, '2015-12-29 21:23:04', '2015-12-29 21:23:04'),
(87, 'Breakage (Filter)', 1, 0, 1, 1, '2015-12-29 21:23:24', '2015-12-29 21:23:24'),
(88, 'Breakage (Liner)', 1, 0, 1, 1, '2015-12-29 21:23:46', '2015-12-29 21:23:46'),
(89, 'Breakage (Casing)', 1, 0, 1, 1, '2015-12-29 21:24:25', '2015-12-29 21:24:25'),
(90, 'Looseness (Host)', 1, 0, 1, 1, '2015-12-29 21:25:17', '2015-12-29 21:25:17'),
(91, 'Looseness (Blade)', 1, 0, 1, 1, '2015-12-29 21:25:35', '2015-12-29 21:25:35'),
(92, 'Material Deterioration (O-Ring)', 1, 0, 1, 1, '2015-12-29 21:28:26', '2015-12-29 21:28:26'),
(93, 'Material Deterioration (O-Ring, Gasket)', 1, 0, 1, 1, '2015-12-29 21:28:48', '2015-12-29 21:28:48'),
(94, 'Material Deterioration (Filter)', 1, 0, 1, 1, '2015-12-29 21:29:04', '2015-12-29 21:29:04'),
(95, 'Material Deterioration', 1, 0, 1, 1, '2015-12-29 21:29:22', '2015-12-29 21:29:22'),
(96, 'Material Deterioration (Filter Element)', 1, 0, 1, 1, '2015-12-29 21:30:20', '2015-12-29 21:30:20'),
(97, 'Material Deterioration (Gasket)', 1, 0, 1, 1, '2015-12-29 21:31:03', '2015-12-29 21:31:03'),
(98, 'Material Deterioration (Expansion Joint)', 1, 0, 1, 1, '2015-12-29 21:31:39', '2015-12-29 21:31:39'),
(99, 'Leakage', 1, 0, 1, 1, '2015-12-29 21:31:57', '2015-12-29 21:31:57'),
(100, 'Wear (Piston, Cylinder)', 1, 0, 1, 1, '2015-12-29 21:34:00', '2015-12-29 21:34:00'),
(101, 'Dust or Dirty (Filter)', 1, 0, 1, 1, '2015-12-29 21:35:11', '2015-12-29 21:35:11'),
(102, 'Dust or Dirty', 1, 0, 1, 1, '2015-12-29 21:35:27', '2015-12-29 21:35:27'),
(103, 'Dust or Dirty (Blade, Nozzle)', 1, 0, 1, 1, '2015-12-29 21:35:54', '2015-12-29 21:35:54'),
(104, 'Corrosion (Blade)', 1, 0, 1, 1, '2015-12-29 21:36:38', '2015-12-29 21:36:38'),
(105, 'Erosion (Blade)', 1, 0, 1, 1, '2015-12-29 21:38:26', '2015-12-29 21:38:26'),
(106, 'Corrosion (Filter Housing)', 1, 0, 1, 1, '2015-12-29 21:38:57', '2015-12-29 21:38:57'),
(107, 'Deformation (Blade)', 1, 0, 1, 1, '2015-12-29 21:40:05', '2015-12-29 21:40:05'),
(108, 'Deformation (Fuel Nozzle, Burner)', 1, 0, 1, 1, '2015-12-29 21:40:27', '2015-12-29 21:40:27'),
(109, 'Deformation (Filter Element)', 1, 0, 1, 1, '2015-12-29 21:40:40', '2015-12-29 21:40:40'),
(110, 'Deformation', 1, 0, 1, 1, '2015-12-29 21:41:02', '2015-12-29 21:41:02'),
(111, 'Rubbing (Blade)', 1, 0, 1, 1, '2015-12-29 21:42:53', '2015-12-29 21:42:53'),
(112, 'DOF (Domestic Flying Object)', 1, 0, 1, 1, '2015-12-29 21:45:46', '2015-12-29 21:45:46'),
(113, 'FOD (Foreign Object Damage)', 1, 0, 1, 1, '2015-12-29 21:46:27', '2015-12-29 21:46:27'),
(114, 'Control Failure (IGV, VSV)', 1, 0, 1, 1, '2015-12-29 21:47:10', '2015-12-29 21:47:10'),
(115, 'Unbalance', 1, 0, 1, 1, '2015-12-29 21:48:03', '2015-12-29 21:48:03'),
(116, 'Misalignment (Only Industrial Type)', 1, 0, 1, 1, '2015-12-29 21:49:01', '2015-12-29 21:49:01'),
(117, 'Breakage (Filter Element)', 1, 0, 1, 1, '2015-12-29 21:50:06', '2015-12-29 21:50:06'),
(118, 'Fouling', 1, 0, 1, 1, '2015-12-29 21:50:37', '2015-12-29 21:50:37'),
(119, 'Stuck (IGV, VSV)', 1, 0, 1, 1, '2015-12-29 21:51:22', '2015-12-29 21:51:22'),
(120, 'Insufficient Cooling', 1, 0, 1, 1, '2015-12-29 21:51:54', '2015-12-29 21:51:54'),
(121, 'Insufficient Lubrication', 1, 0, 1, 1, '2015-12-29 21:52:17', '2015-12-29 21:52:17'),
(122, 'Contamination', 1, 0, 1, 1, '2015-12-29 21:53:30', '2015-12-29 21:53:30'),
(123, 'Contamination (Lube Oil)', 1, 0, 1, 1, '2015-12-29 21:53:41', '2015-12-29 21:53:41'),
(124, 'Creep', 1, 0, 1, 1, '2015-12-29 21:54:41', '2015-12-29 21:54:41'),
(125, 'Breakage (Belt)', 1, 0, 1, 1, '2015-12-29 22:07:11', '2015-12-29 22:07:11'),
(126, 'Breakage (Key)', 1, 0, 1, 1, '2015-12-29 22:07:18', '2015-12-29 22:07:18'),
(127, 'Breakage (Pulley)', 1, 0, 1, 1, '2015-12-29 22:07:38', '2015-12-29 22:07:38'),
(128, 'Material Deterioration (Belt)', 1, 0, 1, 1, '2015-12-29 22:08:42', '2015-12-29 22:08:42'),
(129, 'Unbalance (Blade)', 1, 0, 1, 1, '2015-12-29 22:09:39', '2015-12-29 22:09:39'),
(130, 'Wear (Belt)', 1, 0, 1, 1, '2015-12-29 22:09:57', '2015-12-29 22:09:57'),
(131, 'Wear (Pulley)', 1, 0, 1, 1, '2015-12-29 22:10:03', '2015-12-29 22:10:03'),
(132, 'Low Tension (Belt Slip)', 1, 0, 1, 1, '2015-12-29 22:10:28', '2015-12-29 22:10:28'),
(133, 'High Tension', 1, 0, 1, 1, '2015-12-29 22:10:48', '2015-12-29 22:10:48'),
(134, 'Corrosion (Tube)', 1, 0, 1, 1, '2015-12-29 22:11:08', '2015-12-29 22:11:08'),
(135, '-', 1, 0, 1, 1, '2015-12-30 23:54:55', '2015-12-30 23:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `ref_failure_effect`
--

CREATE TABLE IF NOT EXISTS `ref_failure_effect` (
`failure_effect_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'Safety\nEconomic\nEnvironment\nLaw/ Social',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ref_failure_effect`
--

INSERT INTO `ref_failure_effect` (`failure_effect_id`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`, `project_id`) VALUES
(1, 'Safety', NULL, NULL, NULL, NULL, 1, 0),
(2, 'Economic', NULL, NULL, NULL, NULL, 1, 0),
(3, 'Environment', NULL, NULL, NULL, NULL, 1, 0),
(4, 'Law/ Social', NULL, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_failure_mode`
--

CREATE TABLE IF NOT EXISTS `ref_failure_mode` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ref_failure_mode`
--

INSERT INTO `ref_failure_mode` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Breakdown', 1, 0, 1, 1, '2015-12-29 20:29:07', '2015-12-29 20:29:07'),
(2, 'Erratic Output', 1, 0, 1, 1, '2015-12-29 20:29:21', '2015-12-29 20:29:21'),
(3, 'External Leakage - Process Medium', 1, 0, 1, 1, '2015-12-29 20:29:35', '2015-12-29 20:29:35'),
(4, 'External Leakage - Utility Medium', 1, 0, 1, 1, '2015-12-29 20:29:47', '2015-12-29 20:29:47'),
(5, 'Noise', 1, 0, 1, 1, '2015-12-29 20:29:55', '2015-12-29 20:29:55'),
(6, 'Overheating', 1, 0, 1, 1, '2015-12-29 20:30:06', '2015-12-29 20:30:06'),
(7, 'Vibration', 1, 0, 1, 1, '2015-12-29 20:30:16', '2015-12-29 20:30:16'),
(8, 'External Leakage - Process', 1, 0, 1, 1, '2015-12-29 20:30:45', '2015-12-29 20:30:45'),
(9, 'External Leakage - Utility', 1, 0, 1, 1, '2015-12-29 20:31:00', '2015-12-29 20:31:00'),
(10, 'High Output', 1, 0, 1, 1, '2015-12-29 20:31:11', '2015-12-29 20:31:11'),
(11, 'Internal Leakage - Process', 1, 0, 1, 1, '2015-12-29 20:31:22', '2015-12-29 20:31:22'),
(12, 'Low Output', 1, 0, 1, 1, '2015-12-29 20:31:31', '2015-12-29 20:31:31'),
(13, 'Internal Leakage', 1, 0, 1, 1, '2015-12-29 20:32:48', '2015-12-29 20:32:48'),
(14, 'Plugged/Choked', 1, 0, 1, 1, '2015-12-29 20:35:30', '2015-12-29 20:35:30'),
(15, 'Internal Leakage - Utility (Between Stage to Stage)', 1, 0, 1, 1, '2015-12-29 20:35:49', '2015-12-29 20:35:49'),
(16, 'Internal Leakage - Utility (Shell and Tube)', 1, 0, 1, 1, '2015-12-29 20:36:24', '2015-12-29 20:36:24'),
(17, 'Low Output (Can''t Create Vacuum)', 1, 0, 1, 1, '2015-12-29 20:36:39', '2015-12-29 20:36:39'),
(18, 'External Leakage - Utility (Hydraulic Oil)', 1, 0, 1, 1, '2015-12-29 20:37:01', '2015-12-29 20:37:01'),
(19, 'External Leakage - Process (Stream)', 1, 0, 1, 1, '2015-12-29 20:37:11', '2015-12-29 20:37:11'),
(20, 'Failure to Stop on Demand', 1, 0, 1, 1, '2015-12-29 20:37:23', '2015-12-29 20:37:23'),
(21, 'Internal Leakage (Only Hydraulic Type)', 1, 0, 1, 1, '2015-12-29 20:37:40', '2015-12-29 20:37:40'),
(22, 'Failure to Start on Demand', 1, 1, 1, 1, '2015-12-29 20:38:07', '2015-12-29 20:38:15'),
(23, 'Plugged/Choked (Filter)', 1, 0, 1, 1, '2015-12-29 20:38:44', '2015-12-29 20:38:44'),
(24, 'Breakdown (Filter)', 1, 0, 1, 1, '2015-12-29 20:38:53', '2015-12-29 20:38:53'),
(25, 'Breakdown (Vane)', 1, 0, 1, 1, '2015-12-29 20:39:10', '2015-12-29 20:39:10'),
(26, 'Plugged/Choked (Turbine Blade)', 1, 0, 1, 1, '2015-12-29 20:39:43', '2015-12-29 20:39:43'),
(27, 'Leakage', 1, 0, 1, 1, '2015-12-29 20:40:02', '2015-12-29 20:40:02'),
(28, 'Copy Control Valve from Another Equipment', 1, 0, 1, 1, '2015-12-29 20:40:20', '2015-12-29 20:40:20'),
(29, 'External Leakage', 1, 0, 1, 1, '2015-12-29 20:41:04', '2015-12-29 20:41:04'),
(30, 'Abnormal Noise', 1, 0, 1, 1, '2015-12-29 20:41:39', '2015-12-29 20:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `ref_order_type`
--

CREATE TABLE IF NOT EXISTS `ref_order_type` (
`order_type_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT 'name       description\nPM	Operation\nTM	Maintenance\n',
  `description` varchar(255) DEFAULT NULL COMMENT 'Safety\nEconomic\nEnvironment\nLaw/ Social\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `project_id` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ref_order_type`
--

INSERT INTO `ref_order_type` (`order_type_id`, `name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `active`, `project_id`) VALUES
(1, 'PM', 'Operation', '2015-12-21 16:18:39', NULL, NULL, NULL, 1, 0),
(2, 'TM', 'Maintenance', '2015-12-21 16:18:42', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_parts`
--

CREATE TABLE IF NOT EXISTS `ref_parts` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `ref_parts`
--

INSERT INTO `ref_parts` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Compressor', 1, 1, 1, 1, '2015-12-29 20:09:08', '2015-12-29 20:09:24'),
(2, 'Pump', 1, 0, 1, 1, '2015-12-29 20:09:12', '2015-12-29 20:09:12'),
(3, 'Diaphagm', 1, 0, 1, 1, '2015-12-29 20:10:37', '2015-12-29 20:10:37'),
(4, 'Nozzle', 1, 0, 1, 1, '2015-12-29 20:10:47', '2015-12-29 20:10:47'),
(5, 'Casing Drain (Gate Valve)', 1, 0, 1, 1, '2015-12-29 20:11:00', '2015-12-29 20:11:00'),
(6, 'Seal (Labyrinth, Gland Packing, Carbon Ring)', 1, 0, 1, 1, '2015-12-29 20:11:15', '2015-12-29 20:11:15'),
(7, 'Blade and Shroud', 1, 0, 1, 1, '2015-12-29 20:11:25', '2015-12-29 20:11:25'),
(8, 'Shaft', 1, 0, 1, 1, '2015-12-29 20:11:33', '2015-12-29 20:11:33'),
(9, 'Thrust and Radial Bearing', 1, 0, 1, 1, '2015-12-29 20:11:48', '2015-12-29 20:11:48'),
(10, 'Condenser', 1, 0, 1, 1, '2015-12-29 20:11:56', '2015-12-29 20:11:56'),
(11, 'Tube (In Case of Shell and Tube Type Only)', 1, 0, 1, 1, '2015-12-29 20:12:17', '2015-12-29 20:12:17'),
(12, 'Stream Ejector', 1, 0, 1, 1, '2015-12-29 20:12:27', '2015-12-29 20:12:27'),
(13, 'Trip Throttle Valve', 1, 0, 1, 1, '2015-12-29 20:12:37', '2015-12-29 20:12:37'),
(14, 'Governer Valve', 1, 0, 1, 1, '2015-12-29 20:12:51', '2015-12-29 20:12:51'),
(15, 'Start Energy (Support)', 1, 0, 1, 1, '2015-12-29 20:13:05', '2015-12-29 20:13:05'),
(16, 'Starting Unit', 1, 0, 1, 1, '2015-12-29 20:13:09', '2015-12-29 20:13:09'),
(17, 'Air Inlet', 1, 0, 1, 1, '2015-12-29 20:13:13', '2015-12-29 20:13:13'),
(18, 'Compresor Rotor', 1, 0, 1, 1, '2015-12-29 20:13:19', '2015-12-29 20:13:19'),
(19, 'Compressor Stator', 1, 0, 1, 1, '2015-12-29 20:13:48', '2015-12-29 20:13:48'),
(20, 'Combustion Chamber', 1, 0, 1, 1, '2015-12-29 20:13:58', '2015-12-29 20:13:58'),
(21, 'Burners (Include Fuel Nozzle)', 1, 0, 1, 1, '2015-12-29 20:14:10', '2015-12-29 20:14:10'),
(22, 'Fuel Filter', 1, 0, 1, 1, '2015-12-29 20:14:19', '2015-12-29 20:14:19'),
(23, 'HP Turbine', 1, 0, 1, 1, '2015-12-29 20:14:25', '2015-12-29 20:14:25'),
(24, 'Thrust Bearing', 1, 0, 1, 1, '2015-12-29 20:14:34', '2015-12-29 20:14:34'),
(25, 'Radial Bearing', 1, 0, 1, 1, '2015-12-29 20:14:45', '2015-12-29 20:14:45'),
(26, 'Seals (Labyrinth, Honeycomb)', 1, 0, 1, 1, '2015-12-29 20:15:01', '2015-12-29 20:15:01'),
(27, 'Fuel Valves (Control Valve)', 1, 0, 1, 1, '2015-12-29 20:15:13', '2015-12-29 20:15:13'),
(28, 'Compressor Casing', 1, 0, 1, 1, '2015-12-29 20:15:22', '2015-12-29 20:15:22'),
(29, 'High Pressure Turbine Casing', 1, 0, 1, 1, '2015-12-29 20:15:43', '2015-12-29 20:15:43'),
(30, 'Rotor', 1, 0, 1, 1, '2015-12-29 20:15:50', '2015-12-29 20:15:50'),
(31, 'Stator', 1, 0, 1, 1, '2015-12-29 20:15:56', '2015-12-29 20:15:56'),
(32, 'Seals (Honeycomb)', 1, 0, 1, 1, '2015-12-29 20:16:11', '2015-12-29 20:16:11'),
(33, 'Exhaust', 1, 0, 1, 1, '2015-12-29 20:16:17', '2015-12-29 20:16:17'),
(34, 'Key', 1, 0, 1, 1, '2015-12-29 20:16:26', '2015-12-29 20:16:26'),
(35, 'Bearing', 1, 0, 1, 1, '2015-12-29 20:16:34', '2015-12-29 20:16:34'),
(36, 'Blade', 1, 0, 1, 1, '2015-12-29 20:16:36', '2015-12-29 20:16:36'),
(37, 'Plenum', 1, 0, 1, 1, '2015-12-29 20:16:40', '2015-12-29 20:16:40'),
(38, 'Tube', 1, 0, 1, 1, '2015-12-29 20:16:48', '2015-12-29 20:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `ref_task_intervals`
--

CREATE TABLE IF NOT EXISTS `ref_task_intervals` (
`id` int(10) unsigned NOT NULL,
  `interval` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ref_task_intervals`
--

INSERT INTO `ref_task_intervals` (`id`, `interval`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Hr', 'Hour', 1, 0, 1, 1, '2015-12-29 22:14:36', '2015-12-29 22:14:36'),
(2, 'S', 'Shift', 1, 0, 1, 1, '2015-12-29 22:14:40', '2015-12-29 22:14:40'),
(3, 'W', 'Week', 1, 0, 1, 1, '2015-12-29 22:14:44', '2015-12-29 22:14:44'),
(4, 'M', 'Month', 1, 0, 1, 1, '2015-12-29 22:14:47', '2015-12-29 22:14:47'),
(5, 'Y', 'Year', 1, 0, 1, 1, '2015-12-29 22:14:51', '2015-12-29 22:14:51'),
(6, 'TA', 'Turnaround', 1, 0, 1, 1, '2015-12-29 22:14:56', '2015-12-29 22:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `ref_task_lists`
--

CREATE TABLE IF NOT EXISTS `ref_task_lists` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `ref_task_lists`
--

INSERT INTO `ref_task_lists` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Vibration Check', 1, 0, 1, 1, '2015-12-29 22:17:39', '2015-12-29 22:17:39'),
(2, 'Scheduled Realignment', 1, 0, 1, 1, '2015-12-29 22:18:20', '2015-12-29 22:18:20'),
(3, 'Check as Request', 1, 0, 1, 1, '2015-12-29 22:18:44', '2015-12-29 22:18:44'),
(4, 'Visual Check (Internal Part)', 1, 0, 1, 1, '2015-12-29 22:19:03', '2015-12-29 22:19:03'),
(5, 'Clearance Check (Journal Bearing)', 1, 0, 1, 1, '2015-12-29 22:19:35', '2015-12-29 22:19:35'),
(6, 'BEC Visual Check', 1, 0, 1, 1, '2015-12-29 22:20:24', '2015-12-29 22:20:24'),
(7, 'PT Check (Journal Bearing)', 1, 0, 1, 1, '2015-12-29 22:20:50', '2015-12-29 22:20:50'),
(8, 'UT Check (Journal Bearing)', 1, 0, 1, 1, '2015-12-29 22:21:17', '2015-12-29 22:21:17'),
(9, 'PT Check (Thrust Bearing)', 1, 0, 1, 1, '2015-12-29 22:21:38', '2015-12-29 22:21:38'),
(10, 'UT Check (Thrust Bearing)', 1, 0, 1, 1, '2015-12-29 22:22:03', '2015-12-29 22:22:03'),
(11, 'Condition Check (Recycle Valve)', 1, 0, 1, 1, '2015-12-29 22:22:21', '2015-12-29 22:22:21'),
(12, 'Cleaning and Inspection', 1, 0, 1, 1, '2015-12-29 22:22:42', '2015-12-29 22:22:42'),
(13, 'Reconditioning (Dry Gas Seal)', 1, 0, 1, 1, '2015-12-29 22:22:59', '2015-12-29 22:22:59'),
(14, 'Scheduled Replacement (Oil Film Seal or Labyrinth Seal)', 1, 0, 1, 1, '2015-12-29 22:23:22', '2015-12-29 22:23:22'),
(15, 'Check Clearance (Thrust Bearing)', 1, 0, 1, 1, '2015-12-29 22:23:38', '2015-12-29 22:23:38'),
(16, 'PT Check', 1, 0, 1, 1, '2015-12-29 22:23:53', '2015-12-29 22:23:53'),
(17, 'Balancing Rotor (In Case Changed Impeller or Shaft)', 1, 0, 1, 1, '2015-12-29 22:24:10', '2015-12-29 22:24:10'),
(18, 'Check Clearance (Internal Parts)', 1, 0, 1, 1, '2015-12-29 22:24:21', '2015-12-29 22:24:21'),
(19, 'Check Soft Foot', 1, 0, 1, 1, '2015-12-29 22:24:26', '2015-12-29 22:24:26'),
(20, 'Inspection Suction Strainer', 1, 0, 1, 1, '2015-12-29 22:24:32', '2015-12-29 22:24:32'),
(21, 'Dimension Check', 1, 0, 1, 1, '2015-12-29 22:24:54', '2015-12-29 22:24:54'),
(22, 'Dimension Check (Crosshead Pin and Liner)', 1, 0, 1, 1, '2015-12-29 22:25:15', '2015-12-29 22:25:15'),
(23, 'Dimension Check (Plunger and Cylinder)', 1, 0, 1, 1, '2015-12-29 22:25:30', '2015-12-29 22:25:30'),
(24, 'Changed on Condition Vibration Check (Roller Bearing)', 1, 0, 1, 1, '2015-12-29 22:26:25', '2015-12-29 22:26:25'),
(25, 'Oil Analysis', 1, 0, 1, 1, '2015-12-29 22:26:46', '2015-12-29 22:26:46'),
(26, 'PT Check (Crosshead)', 1, 0, 1, 1, '2015-12-29 22:28:16', '2015-12-29 22:28:16'),
(27, 'Visual Check (Crosshead Pin)', 1, 0, 1, 1, '2015-12-29 22:28:50', '2015-12-29 22:28:50'),
(28, 'Visual Check', 1, 0, 1, 1, '2015-12-29 22:29:04', '2015-12-29 22:29:04'),
(29, 'Changed on Condition', 1, 0, 1, 1, '2015-12-29 22:29:42', '2015-12-29 22:29:42'),
(30, 'Check Clearance (Main Bearing)', 1, 0, 1, 1, '2015-12-29 22:30:46', '2015-12-29 22:30:46'),
(31, 'Web Deflection', 1, 0, 1, 1, '2015-12-29 22:31:07', '2015-12-29 22:31:07'),
(32, 'Scheduled Replacement', 1, 0, 1, 1, '2015-12-29 22:31:29', '2015-12-29 22:31:29'),
(33, 'Cleaning (Oil Pot, Oil Hole)', 1, 0, 1, 1, '2015-12-29 22:32:16', '2015-12-29 22:32:16'),
(34, 'Scheduled Calibration', 1, 0, 1, 1, '2015-12-29 22:32:47', '2015-12-29 22:32:47'),
(35, 'Clearance Check', 1, 0, 1, 1, '2015-12-29 22:33:15', '2015-12-29 22:33:15'),
(36, 'Function Test', 1, 0, 1, 1, '2015-12-29 22:33:26', '2015-12-29 22:33:26'),
(37, 'UT Check', 1, 0, 1, 1, '2015-12-29 22:34:34', '2015-12-29 22:34:34'),
(38, 'UT Check (Subsurface Crack)', 1, 0, 1, 1, '2015-12-29 22:34:47', '2015-12-29 22:34:47'),
(39, 'Changed on Condition Vibration Check', 1, 0, 1, 1, '2015-12-30 21:45:36', '2015-12-30 21:45:36'),
(40, 'Regrease', 1, 0, 1, 1, '2015-12-30 21:47:33', '2015-12-30 21:47:33'),
(41, 'Shaft Runout and Shaft End Play Check', 1, 0, 1, 1, '2015-12-30 21:47:57', '2015-12-30 21:47:57'),
(42, 'Realignment', 1, 0, 1, 1, '2015-12-30 21:48:21', '2015-12-30 21:48:21'),
(43, 'Check and Adjust Belt Tension', 1, 0, 1, 1, '2015-12-30 21:48:48', '2015-12-30 21:48:48'),
(44, 'Pressure Test', 1, 0, 1, 1, '2015-12-30 21:49:17', '2015-12-30 21:49:17'),
(45, 'Visual Inspection', 1, 0, 1, 1, '2015-12-30 21:49:30', '2015-12-30 21:49:30'),
(46, 'Scheduled Cleaning', 1, 0, 1, 1, '2015-12-30 21:49:44', '2015-12-30 21:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `ref_task_types`
--

CREATE TABLE IF NOT EXISTS `ref_task_types` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ref_task_types`
--

INSERT INTO `ref_task_types` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, '-', 1, 0, 1, 1, '2015-12-29 22:13:18', '2015-12-29 22:13:18'),
(2, 'OC (On-Condition Task)', 1, 0, 1, 1, '2015-12-29 22:13:26', '2015-12-29 22:13:26'),
(3, 'SD (Schedule Discard)', 1, 0, 1, 1, '2015-12-29 22:13:36', '2015-12-29 22:13:36'),
(4, 'SR (Schedule Restoration)', 1, 0, 1, 1, '2015-12-29 22:13:46', '2015-12-29 22:13:46'),
(5, 'FF (Failure Finding)', 1, 0, 1, 1, '2015-12-29 22:13:52', '2015-12-29 22:13:52'),
(6, 'CB (Combination Task)', 1, 0, 1, 1, '2015-12-29 22:13:58', '2015-12-29 22:13:58'),
(7, 'RD (Re-Design)', 1, 0, 1, 1, '2015-12-29 22:14:07', '2015-12-29 22:14:07'),
(8, 'RTF (Run To Fail)', 1, 0, 1, 1, '2015-12-29 22:14:18', '2015-12-29 22:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `ref_types`
--

CREATE TABLE IF NOT EXISTS `ref_types` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ref_types`
--

INSERT INTO `ref_types` (`id`, `description`, `created_by`, `updated_by`, `active`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'Centrifugal Compressor', 1, 0, 1, 1, '2015-12-29 20:04:39', '2015-12-29 20:04:39'),
(2, 'Reciprocating Compressor', 1, 0, 1, 1, '2015-12-29 20:04:52', '2015-12-29 20:04:52'),
(3, 'Screw Compressor', 1, 0, 1, 1, '2015-12-29 20:05:01', '2015-12-29 20:05:01'),
(4, 'Centrifugal Pump', 1, 0, 1, 1, '2015-12-29 20:05:14', '2015-12-29 20:05:14'),
(5, 'Reciprocating Pump', 1, 0, 1, 1, '2015-12-29 20:05:25', '2015-12-29 20:05:25'),
(6, 'Screw Pump', 1, 0, 1, 1, '2015-12-29 20:05:34', '2015-12-29 20:05:34'),
(7, 'Gear Pump', 1, 0, 1, 1, '2015-12-29 20:05:41', '2015-12-29 20:05:41'),
(8, 'Stream Turbine', 1, 0, 1, 1, '2015-12-29 20:05:50', '2015-12-29 20:05:50'),
(9, 'Gas Turbine', 1, 0, 1, 1, '2015-12-29 20:06:00', '2015-12-29 20:06:00'),
(10, 'Fin-Fan', 1, 0, 1, 1, '2015-12-29 20:06:08', '2015-12-29 20:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `task_selection`
--

CREATE TABLE IF NOT EXISTS `task_selection` (
`task_selection_id` int(11) NOT NULL,
  `node` int(11) DEFAULT NULL,
  `asset_basic_failure_id` int(11) DEFAULT NULL,
  `failure_effect_id` int(11) DEFAULT NULL,
  `evident_id` int(11) DEFAULT NULL,
  `order_type_id` int(11) DEFAULT NULL,
  `interval_num` int(50) DEFAULT NULL,
  `interval` varchar(255) DEFAULT NULL,
  `basic_task_id` int(11) DEFAULT NULL,
  `activity_status_id` int(11) DEFAULT NULL,
  `activity_detail` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `project_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_basic_failure`
--
ALTER TABLE `asset_basic_failure`
 ADD PRIMARY KEY (`id`,`basic_failure_id`);

--
-- Indexes for table `asset_complex_detail`
--
ALTER TABLE `asset_complex_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_registers`
--
ALTER TABLE `asset_registers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_equipments`
--
ALTER TABLE `basic_equipments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_failures`
--
ALTER TABLE `basic_failures`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_tasks`
--
ALTER TABLE `basic_tasks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complex`
--
ALTER TABLE `complex`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complex_detail_default`
--
ALTER TABLE `complex_detail_default`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`level`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_assumptions`
--
ALTER TABLE `package_assumptions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_activity_status`
--
ALTER TABLE `ref_activity_status`
 ADD PRIMARY KEY (`activity_status_id`), ADD UNIQUE KEY `type_id_UNIQUE` (`activity_status_id`);

--
-- Indexes for table `ref_categories`
--
ALTER TABLE `ref_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_evident`
--
ALTER TABLE `ref_evident`
 ADD PRIMARY KEY (`evident_id`), ADD UNIQUE KEY `type_id_UNIQUE` (`evident_id`);

--
-- Indexes for table `ref_failure_cause`
--
ALTER TABLE `ref_failure_cause`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_failure_effect`
--
ALTER TABLE `ref_failure_effect`
 ADD PRIMARY KEY (`failure_effect_id`), ADD UNIQUE KEY `type_id_UNIQUE` (`failure_effect_id`);

--
-- Indexes for table `ref_failure_mode`
--
ALTER TABLE `ref_failure_mode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_order_type`
--
ALTER TABLE `ref_order_type`
 ADD PRIMARY KEY (`order_type_id`), ADD UNIQUE KEY `type_id_UNIQUE` (`order_type_id`);

--
-- Indexes for table `ref_parts`
--
ALTER TABLE `ref_parts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_task_intervals`
--
ALTER TABLE `ref_task_intervals`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_task_lists`
--
ALTER TABLE `ref_task_lists`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_task_types`
--
ALTER TABLE `ref_task_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_types`
--
ALTER TABLE `ref_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_selection`
--
ALTER TABLE `task_selection`
 ADD PRIMARY KEY (`task_selection_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_basic_failure`
--
ALTER TABLE `asset_basic_failure`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `asset_complex_detail`
--
ALTER TABLE `asset_complex_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `asset_registers`
--
ALTER TABLE `asset_registers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `basic_equipments`
--
ALTER TABLE `basic_equipments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `basic_failures`
--
ALTER TABLE `basic_failures`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `basic_tasks`
--
ALTER TABLE `basic_tasks`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complex_detail_default`
--
ALTER TABLE `complex_detail_default`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `package_assumptions`
--
ALTER TABLE `package_assumptions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_activity_status`
--
ALTER TABLE `ref_activity_status`
MODIFY `activity_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_categories`
--
ALTER TABLE `ref_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_evident`
--
ALTER TABLE `ref_evident`
MODIFY `evident_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_failure_cause`
--
ALTER TABLE `ref_failure_cause`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `ref_failure_effect`
--
ALTER TABLE `ref_failure_effect`
MODIFY `failure_effect_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ref_failure_mode`
--
ALTER TABLE `ref_failure_mode`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `ref_order_type`
--
ALTER TABLE `ref_order_type`
MODIFY `order_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_parts`
--
ALTER TABLE `ref_parts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `ref_task_intervals`
--
ALTER TABLE `ref_task_intervals`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ref_task_lists`
--
ALTER TABLE `ref_task_lists`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `ref_task_types`
--
ALTER TABLE `ref_task_types`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ref_types`
--
ALTER TABLE `ref_types`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `task_selection`
--
ALTER TABLE `task_selection`
MODIFY `task_selection_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
