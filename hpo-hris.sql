-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2015 at 07:12 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hpo-hris`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
`id` int(10) unsigned NOT NULL,
  `department_code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'WebDev', 'Web Development', 'Web Developers, Software Devs, Mobile Devs', '2015-08-05 06:31:05', '0000-00-00 00:00:00'),
(2, 'ADMIN', 'Administrator', 'Admin office staffs', '2015-08-08 07:19:39', '0000-00-00 00:00:00'),
(3, 'SysAd', 'System Administrator', 'Maintains technical problems', '2015-08-08 00:07:38', '2015-08-08 00:07:38'),
(4, 'Sales&Mar', 'Sales and Marketing', '', '2015-08-08 06:15:58', '2015-08-08 06:15:58'),
(5, 'QA', 'Quality Assurance', '', '2015-08-08 06:17:12', '2015-08-08 06:17:12'),
(6, 'ENGAGEIQ', 'Engage IQ', 'Sample ', '2015-08-15 07:14:27', '2015-08-14 23:14:27'),
(7, 'Creative', 'Creative', '', '2015-08-14 23:11:01', '2015-08-14 23:11:01'),
(8, 'PMO', 'PMO', '', '2015-08-14 23:13:05', '2015-08-14 23:13:05'),
(9, 'IM', 'IM', '', '2015-08-14 23:15:54', '2015-08-14 23:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(10) unsigned NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `department_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `middle_name`, `last_name`, `status`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 802005, 'Leonardo Jr.', 'Alcantara', 'Galos', '1', 3, '2015-08-15 07:09:13', '2015-08-14 23:09:13'),
(2, 805067, 'Romeo Jr.', 'Ibañez', 'Mangaya-ay', '1', 1, '2015-08-14 17:56:56', '2015-08-14 17:56:56'),
(3, 810079, 'Ali ', 'Calderon', 'Mofan ', '1', 3, '2015-08-15 07:08:50', '2015-08-14 23:08:50'),
(4, 410001, 'Juan Paulo', 'Santos ', 'Saravia', '1', 4, '2015-08-15 07:08:25', '2015-08-14 23:08:25'),
(5, 506001, 'Gene Voltaire', 'Acuesta', 'Dequito', '1', 1, '2015-08-14 17:56:56', '2015-08-14 17:56:56'),
(6, 702003, 'Ares', 'Lacap', 'Cabahug', '1', 7, '2015-08-15 07:11:35', '2015-08-14 23:11:35'),
(7, 706009, 'Roque Jay', 'Lampios', 'Maneja', '1', 7, '2015-08-15 07:11:23', '2015-08-14 23:11:23'),
(8, 710026, 'Enrico Rafael', 'De Jesus', 'Macaraig', '1', 7, '2015-08-15 07:12:40', '2015-08-14 23:12:40'),
(9, 801002, 'Rea May', 'Apita', 'Fuentes', '1', 9, '2015-08-15 07:16:26', '2015-08-14 23:16:26'),
(10, 801001, 'Daniel', 'Intong', 'Revil', '1', 7, '2015-08-15 07:11:12', '2015-08-14 23:11:12'),
(11, 806048, 'Dennis', 'Semilla', 'Lucero', '1', 2, '2015-08-15 07:09:29', '2015-08-14 23:09:29'),
(12, 811086, 'Queency', 'Panisal', 'Alfante', '1', 9, '2015-08-15 07:16:37', '2015-08-14 23:16:37'),
(13, 904061, 'Elaine Ingrid', 'Neri', 'Manlangit', '1', 2, '2015-08-15 07:09:58', '2015-08-14 23:09:58'),
(14, 911131, 'Aaron Paul', 'Tito', 'Duhaylungsod', '1', 9, '2015-08-15 07:18:19', '2015-08-14 23:18:19'),
(15, 1006041, 'April Rose ', 'Relampagos', 'Alforque', '1', 2, '2015-08-15 07:09:43', '2015-08-14 23:09:43'),
(16, 1010062, 'Rian Ree', 'Patron', 'Barrientos', '1', 1, '2015-08-14 17:56:56', '2015-08-14 17:56:56'),
(17, 1101010, 'Jose Bernard', 'Pond', 'Sevilla', '1', 9, '2015-08-15 07:17:20', '2015-08-14 23:17:20'),
(18, 1104022, 'Dann Robert', 'Tan', 'Yu', '1', 6, '2015-08-15 07:14:17', '2015-08-14 23:14:17'),
(19, 1108042, 'John Cesar', 'Enriquez', 'Manlangit', '1', 1, '2015-08-14 17:56:57', '2015-08-14 17:56:57'),
(20, 1109044, 'Anna Liza', 'Doro-on', 'Masangkay', '1', 8, '2015-08-15 07:13:32', '2015-08-14 23:13:32'),
(21, 1103018, 'Montgomery', 'Cabillan', 'Magbanua', '1', 6, '2015-08-15 07:14:52', '2015-08-14 23:14:52'),
(22, 1203008, 'Jhecyl Mae', 'Arias', 'Cuevas', '1', 9, '2015-08-15 07:17:52', '2015-08-14 23:17:52'),
(23, 1203014, 'Craig John', 'Castañeda', 'Neniel', '1', 9, '2015-08-15 07:16:54', '2015-08-14 23:16:54'),
(24, 1203020, 'Carlo Franco', 'Bayani', 'Lozano', '1', 5, '2015-08-15 07:07:35', '2015-08-14 23:07:35'),
(25, 1203026, 'Jessa Mae', 'Calamba', 'Deloy', '1', 6, '2015-08-15 07:15:37', '2015-08-14 23:15:37'),
(26, 1203029, 'Ma. Louiselle', 'Digamon', 'Jose', '1', 9, '2015-08-15 07:16:10', '2015-08-14 23:16:10'),
(27, 1203035, 'Brylle', 'Duco', 'Seraspe', '1', 1, '2015-08-14 17:56:57', '2015-08-14 17:56:57'),
(28, 1203036, 'Mark', 'Billones', 'Tacatani', '1', 8, '2015-08-15 07:13:56', '2015-08-14 23:13:56'),
(29, 1203042, 'Jayson', 'Miparanum', 'Aso', '1', 9, '2015-08-15 07:16:46', '2015-08-14 23:16:46'),
(30, 1203049, 'Ariel', 'Cacanog', 'Magbanua', '1', 1, '2015-08-14 17:56:57', '2015-08-14 17:56:57'),
(31, 1203050, 'Reu Salvy', 'Sagmit', 'Delima', '1', 9, '2015-08-15 07:18:07', '2015-08-14 23:18:07'),
(32, 1203056, 'Michael Angelo', 'Giducos', 'Leones', '1', 2, '2015-08-15 07:10:29', '2015-08-14 23:10:29'),
(33, 1203064, 'Jake', 'Velasco', 'Duldulao', '1', 1, '2015-08-14 17:56:57', '2015-08-14 17:56:57'),
(34, 1203069, 'Reynand', 'Dulay', 'Collado', '1', 9, '2015-08-15 07:18:34', '2015-08-14 23:18:34'),
(35, 1203072, 'Ivy Frances', 'Sarsalejo', 'Labitan', '1', 9, '2015-08-15 07:17:09', '2015-08-14 23:17:09'),
(36, 1203080, 'Donna Mae', 'Quitong', 'Tabuno', '1', 3, '2015-08-15 07:08:59', '2015-08-14 23:08:59'),
(37, 1203082, 'Olive', 'Nazareno', 'Sumampong', '1', 2, '2015-08-15 07:10:12', '2015-08-14 23:10:12'),
(38, 1203085, 'Daniel', 'Rubiato', 'Laurel', '1', 1, '2015-08-14 17:56:57', '2015-08-14 17:56:57'),
(39, 1203089, 'Chiara', 'Bangoy', 'Patrimonio', '1', 8, '2015-08-15 07:13:17', '2015-08-14 23:13:17'),
(40, 1203090, 'Melvin Rey', 'Antiquin', 'Basco', '1', 7, '2015-08-15 07:11:51', '2015-08-14 23:11:51'),
(41, 1203091, 'Dexter Ken', 'Nerosa', 'Candia', '1', 1, '2015-08-14 17:56:57', '2015-08-14 17:56:57'),
(42, 1203094, 'Rika Joahnah', 'Fiel', 'Sison', '1', 8, '2015-08-15 07:14:06', '2015-08-14 23:14:06'),
(43, 1203107, 'Jayvee', 'Rizon', 'Sumande', '1', 1, '2015-08-14 17:56:58', '2015-08-14 17:56:58'),
(44, 1203110, 'Johneil', 'Celestial', 'Quijano', '1', 1, '2015-08-14 17:56:58', '2015-08-14 17:56:58'),
(45, 1203120, 'Julius Ryan', 'Arboleda', 'Paches', '1', 1, '2015-08-14 17:56:58', '2015-08-14 17:56:58'),
(46, 1203126, 'Ma. Luisa Andrea', 'Quillo', 'Coloso', '1', 6, '2015-08-15 07:15:23', '2015-08-14 23:15:23'),
(47, 140502, 'Nepthaly', 'Caro', 'Talavera', '1', 2, '2015-08-19 04:51:13', '2015-08-18 20:51:13'),
(48, 140702, 'Hazel Love', 'Coloma', 'Rosales', '1', 8, '2015-08-15 07:13:43', '2015-08-14 23:13:43'),
(49, 140902, 'Arriz', 'Divinagracia', 'San Juan', '1', 7, '2015-08-15 07:12:15', '2015-08-14 23:12:15'),
(50, 140903, 'Edward John', 'Paglinawan', 'Diola', '1', 7, '2015-08-15 07:12:02', '2015-08-14 23:12:02'),
(51, 140904, 'Gerard Albert', 'Pimentel', 'Cañada', '1', 6, '2015-08-15 07:15:07', '2015-08-14 23:15:07'),
(52, 140905, 'Patrick Angelo', 'Galve', 'Cameguing', '1', 1, '2015-08-14 17:56:58', '2015-08-14 17:56:58'),
(66, 141002, 'Karla', NULL, 'Librero', '1', 1, '2015-08-16 19:39:48', '2015-08-16 19:39:48'),
(67, 141103, 'Dave Francis', 'Mansilita', 'Cancio', '1', 9, '2015-08-17 04:54:33', '2015-08-16 20:54:33'),
(68, 150102, 'Michael Angelo', 'Omero', 'Tarongoy', '1', 1, '2015-08-16 19:39:48', '2015-08-16 19:39:48'),
(69, 150103, 'Edward Jonathan ', 'Opinion', 'Potot', '1', 8, '2015-08-17 04:55:19', '2015-08-16 20:55:19'),
(70, 150401, 'Marwil', 'Yder', 'Burton', '1', 6, '2015-08-17 04:55:51', '2015-08-16 20:55:51'),
(71, 150403, 'Norgen', 'Balo', 'Tapel', '1', 9, '2015-08-17 04:56:18', '2015-08-16 20:56:18'),
(72, 150501, 'Javin Jet', 'Agustin', 'Tevar', '1', 4, '2015-08-17 04:56:42', '2015-08-16 20:56:42'),
(73, 150502, 'Juan Basilio', 'Teves', 'Espinoza', '1', 9, '2015-08-17 04:57:05', '2015-08-16 20:57:05'),
(74, 150503, 'Xander John', 'Mina', 'Dacyon', '1', 1, '2015-08-16 19:39:48', '2015-08-16 19:39:48'),
(75, 150506, 'John Jason', 'Marquez', 'Baladiang', '1', 1, '2015-08-16 19:39:48', '2015-08-16 19:39:48'),
(76, 150801, 'Vincent Jake', NULL, 'Calag', '1', 1, '2015-08-16 19:39:48', '2015-08-16 19:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `employee_dtr`
--

CREATE TABLE IF NOT EXISTS `employee_dtr` (
`id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `start_of_duty` datetime DEFAULT NULL,
  `first_out` datetime DEFAULT NULL,
  `first_in` datetime DEFAULT NULL,
  `second_out` datetime DEFAULT NULL,
  `second_in` datetime DEFAULT NULL,
  `third_out` datetime DEFAULT NULL,
  `third_in` datetime DEFAULT NULL,
  `end_of_duty` datetime DEFAULT NULL,
  `undertime` time NOT NULL DEFAULT '00:00:00',
  `late` time NOT NULL DEFAULT '00:00:00',
  `overbreak` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3475 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_shifts`
--

CREATE TABLE IF NOT EXISTS `employee_shifts` (
`id` int(10) unsigned NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `shift_id` int(11) unsigned NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `employee_shifts`
--

INSERT INTO `employee_shifts` (`id`, `employee_id`, `shift_id`, `date_from`, `date_to`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2015-07-01', '2015-12-31', '2015-08-15 11:29:46', '0000-00-00 00:00:00'),
(2, 3, 9, '2015-07-01', '2015-12-31', '2015-08-15 11:31:25', '0000-00-00 00:00:00'),
(3, 4, 21, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(4, 5, 9, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(5, 6, 9, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(6, 7, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(7, 8, 8, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(8, 9, 3, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(9, 10, 3, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(10, 11, 9, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(11, 12, 3, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(12, 13, 18, '2015-07-01', '2015-12-31', '2015-08-18 06:18:34', '2015-08-17 22:18:34'),
(13, 20, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(14, 21, 19, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(15, 22, 3, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(16, 23, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(17, 24, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(18, 25, 3, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(19, 26, 3, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(20, 27, 15, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(21, 28, 14, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(22, 29, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(23, 30, 8, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(24, 31, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:51', '2015-08-16 17:43:51'),
(25, 32, 9, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:51'),
(26, 33, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(27, 34, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(28, 35, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(29, 36, 18, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(30, 37, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(31, 38, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(32, 39, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(33, 40, 25, '2015-07-01', '2015-12-31', '2015-08-18 06:15:30', '2015-08-17 22:15:30'),
(34, 41, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(35, 42, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(36, 43, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(37, 44, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(38, 45, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(39, 46, 9, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(40, 47, 18, '2015-07-01', '2015-12-31', '2015-08-18 05:27:49', '2015-08-17 21:27:49'),
(41, 48, 4, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(42, 49, 25, '2015-07-01', '2015-12-31', '2015-08-18 06:22:14', '2015-08-17 22:22:14'),
(43, 51, 8, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(44, 52, 10, '2015-07-01', '2015-12-31', '2015-08-17 01:43:52', '2015-08-16 17:43:52'),
(45, 66, 8, '2015-07-01', '2015-12-31', '2015-08-17 06:06:47', '0000-00-00 00:00:00'),
(46, 67, 4, '2015-07-01', '2015-12-31', '2015-08-17 06:07:39', '0000-00-00 00:00:00'),
(47, 68, 14, '2015-07-01', '2015-12-31', '2015-08-17 06:08:23', '0000-00-00 00:00:00'),
(48, 69, 10, '2015-07-01', '2015-12-31', '2015-08-17 06:08:54', '0000-00-00 00:00:00'),
(49, 70, 8, '2015-07-01', '2015-12-31', '2015-08-17 06:09:20', '0000-00-00 00:00:00'),
(50, 72, 4, '2015-07-01', '2015-12-31', '2015-08-17 06:10:21', '0000-00-00 00:00:00'),
(51, 73, 4, '2015-07-01', '2015-12-31', '2015-08-17 06:10:48', '0000-00-00 00:00:00'),
(52, 74, 19, '2015-07-01', '2015-12-31', '2015-08-17 06:11:32', '0000-00-00 00:00:00'),
(53, 71, 24, '2015-07-01', '2015-12-31', '2015-08-17 06:13:11', '0000-00-00 00:00:00'),
(54, 75, 10, '2015-07-01', '2015-12-31', '2015-08-17 06:13:53', '0000-00-00 00:00:00'),
(55, 76, 4, '2015-07-01', '2015-12-31', '2015-08-17 06:14:15', '0000-00-00 00:00:00'),
(56, 14, 3, '2015-07-01', '2015-12-31', '2015-08-18 04:38:56', '0000-00-00 00:00:00'),
(57, 15, 10, '2015-07-01', '2015-12-31', '2015-08-18 04:39:44', '0000-00-00 00:00:00'),
(58, 16, 8, '2015-07-01', '2015-12-31', '2015-08-18 04:40:44', '0000-00-00 00:00:00'),
(59, 17, 3, '2015-07-01', '2015-12-31', '2015-08-18 04:41:24', '0000-00-00 00:00:00'),
(60, 18, 19, '2015-07-01', '2015-12-31', '2015-08-18 04:42:08', '0000-00-00 00:00:00'),
(61, 19, 4, '2015-07-01', '2015-12-31', '2015-08-18 04:43:04', '0000-00-00 00:00:00'),
(62, 50, 25, '2015-07-01', '2015-12-31', '2015-08-18 06:10:25', '0000-00-00 00:00:00'),
(73, 47, 19, '2015-08-19', '2015-08-21', '2015-08-19 05:04:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift_days`
--

CREATE TABLE IF NOT EXISTS `employee_shift_days` (
`id` int(10) unsigned NOT NULL,
  `employee_shift_id` int(10) unsigned NOT NULL,
  `day` enum('mon','tue','wed','thu','fri','sat','sun') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;

--
-- Dumping data for table `employee_shift_days`
--

INSERT INTO `employee_shift_days` (`id`, `employee_shift_id`, `day`) VALUES
(36, 41, 'mon'),
(37, 41, 'tue'),
(38, 41, 'wed'),
(39, 41, 'thu'),
(40, 41, 'fri'),
(41, 62, 'mon'),
(42, 62, 'tue'),
(43, 62, 'wed'),
(44, 62, 'thu'),
(45, 62, 'fri'),
(52, 45, 'mon'),
(53, 45, 'wed'),
(54, 45, 'fri'),
(60, 59, 'mon'),
(61, 59, 'tue'),
(62, 59, 'wed'),
(63, 59, 'thu'),
(64, 59, 'fri'),
(65, 59, 'sat'),
(171, 73, 'mon'),
(172, 73, 'tue'),
(173, 73, 'wed'),
(174, 73, 'thu'),
(175, 40, 'mon'),
(176, 40, 'tue'),
(177, 40, 'wed'),
(178, 40, 'thu'),
(179, 40, 'fri');

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
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE IF NOT EXISTS `shifts` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `shift_from` time NOT NULL,
  `shift_to` time NOT NULL,
  `working_hours` time NOT NULL,
  `break` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `description`, `shift_from`, `shift_to`, `working_hours`, `break`, `created_at`, `updated_at`) VALUES
(3, 'Shift 1', '09:00:00', '17:00:00', '08:00:00', '00:30:00', '2015-08-15 02:55:35', '0000-00-00 00:00:00'),
(4, 'Shift 2', '08:30:00', '17:30:00', '09:00:00', '01:30:00', '2015-08-15 02:55:35', '0000-00-00 00:00:00'),
(5, 'Shift 3', '22:00:00', '06:00:00', '08:00:00', '00:30:00', '2015-08-15 02:57:34', '0000-00-00 00:00:00'),
(6, 'Shift 4', '23:00:00', '08:00:00', '09:00:00', '01:30:00', '2015-08-18 06:09:11', '0000-00-00 00:00:00'),
(7, 'Shift 5', '14:00:00', '22:00:00', '08:00:00', '00:30:00', '2015-08-15 02:58:09', '0000-00-00 00:00:00'),
(8, 'Shift 6', '06:00:00', '14:00:00', '08:00:00', '00:30:00', '2015-08-15 03:00:06', '0000-00-00 00:00:00'),
(9, 'Shift 7', '10:00:00', '18:00:00', '08:00:00', '00:30:00', '2015-08-15 03:00:39', '0000-00-00 00:00:00'),
(10, 'Shift 8', '09:00:00', '18:00:00', '09:00:00', '01:30:00', '2015-08-15 03:01:13', '0000-00-00 00:00:00'),
(11, 'Shift 9', '07:00:00', '15:00:00', '08:00:00', '00:30:00', '2015-08-15 03:03:42', '0000-00-00 00:00:00'),
(12, 'Shift 10', '13:00:00', '21:00:00', '08:00:00', '00:30:00', '2015-08-15 03:14:36', '0000-00-00 00:00:00'),
(13, 'Shift 11', '00:00:00', '08:00:00', '08:00:00', '00:30:00', '2015-08-15 03:16:25', '0000-00-00 00:00:00'),
(14, 'Shift 12', '16:00:00', '00:00:00', '08:00:00', '00:30:00', '2015-08-18 06:08:26', '0000-00-00 00:00:00'),
(15, 'Shift 13', '16:00:00', '01:00:00', '09:00:00', '01:30:00', '2015-08-15 03:19:19', '0000-00-00 00:00:00'),
(17, 'Shift 14', '06:00:00', '15:00:00', '09:00:00', '01:30:00', '2015-08-18 06:05:46', '2015-08-14 19:59:56'),
(18, 'Shift 15', '08:00:00', '17:00:00', '09:00:00', '01:30:00', '2015-08-18 06:06:57', '2015-08-14 20:02:41'),
(19, 'Shift 16', '08:00:00', '16:00:00', '08:00:00', '00:30:00', '2015-08-15 04:22:45', '0000-00-00 00:00:00'),
(20, 'Shift 17', '07:00:00', '17:00:00', '09:00:00', '01:30:00', '2015-08-15 04:23:20', '0000-00-00 00:00:00'),
(21, 'Shift 18', '11:00:00', '19:00:00', '08:00:00', '00:30:00', '2015-08-15 04:24:04', '0000-00-00 00:00:00'),
(22, 'Shift 19', '10:00:00', '19:00:00', '09:00:00', '01:30:00', '2015-08-18 06:07:35', '0000-00-00 00:00:00'),
(23, 'Shift 20', '07:00:00', '16:00:00', '09:00:00', '01:30:00', '2015-08-15 11:04:58', '0000-00-00 00:00:00'),
(24, 'Shift 21', '05:00:00', '14:00:00', '09:00:00', '01:30:00', '2015-08-18 06:03:32', '2015-08-16 22:12:14'),
(25, 'Shift 22', '23:00:00', '07:00:00', '08:00:00', '00:30:00', '2015-08-18 06:02:46', '2015-08-17 22:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('admin') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Rosemale-John II C. Villacorta', 'rosemalejohn@gmail.com', 'rosemalejohn', '$2y$10$FuqYG4eDr6kTW00RwvWVJ.EHPPkVrOO273CQ7mRROIRYSBVZ9NrPG', 'admin', 'qfVu9Ih5biwFm3bOwo6vZsptgqML8U1fVvLVjjr0EeIQ0K2gbPriCHwD5y4u', '2015-08-14 23:34:32', '2015-08-18 20:50:34'),
(8, 'Nepthaly Talavera', 'nepthaly.talavera@hpoutsourcinginc.com', 'ntalavera', '$2y$10$SLQ2sCBXWHB6MKzhsHMBxOj5glIkOrSMjCRPAM1EbR9.jLfXmDe1m', 'admin', NULL, '2015-08-17 17:56:03', '2015-08-17 17:56:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `employee_id` (`employee_id`), ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `employee_dtr`
--
ALTER TABLE `employee_dtr`
 ADD PRIMARY KEY (`id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
 ADD PRIMARY KEY (`id`), ADD KEY `employee_id` (`employee_id`), ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `employee_shift_days`
--
ALTER TABLE `employee_shift_days`
 ADD PRIMARY KEY (`id`), ADD KEY `employee_shift_id` (`employee_shift_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `employee_dtr`
--
ALTER TABLE `employee_dtr`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3475;
--
-- AUTO_INCREMENT for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `employee_shift_days`
--
ALTER TABLE `employee_shift_days`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_dtr`
--
ALTER TABLE `employee_dtr`
ADD CONSTRAINT `employee_dtr_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
ADD CONSTRAINT `employee_shifts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `employee_shifts_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_shift_days`
--
ALTER TABLE `employee_shift_days`
ADD CONSTRAINT `employee_shift_days_ibfk_1` FOREIGN KEY (`employee_shift_id`) REFERENCES `employee_shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
