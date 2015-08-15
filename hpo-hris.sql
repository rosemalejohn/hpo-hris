-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2015 at 10:22 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `department_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

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
(47, 140502, 'Nepthaly', 'Caro', 'Talavera', '1', 2, '2015-08-15 06:55:34', '2015-08-14 22:55:34'),
(48, 140702, 'Hazel Love', 'Coloma', 'Rosales', '1', 8, '2015-08-15 07:13:43', '2015-08-14 23:13:43'),
(49, 140902, 'Arriz', 'Divinagracia', 'San Juan', '1', 7, '2015-08-15 07:12:15', '2015-08-14 23:12:15'),
(50, 140903, 'Edward John', 'Paglinawan', 'Diola', '1', 7, '2015-08-15 07:12:02', '2015-08-14 23:12:02'),
(51, 140904, 'Gerard Albert', 'Pimentel', 'Cañada', '1', 6, '2015-08-15 07:15:07', '2015-08-14 23:15:07'),
(52, 140905, 'Patrick Angelo', 'Galve', 'Cameguing', '1', 1, '2015-08-14 17:56:58', '2015-08-14 17:56:58');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_shifts`
--

CREATE TABLE IF NOT EXISTS `employee_shifts` (
`id` int(10) unsigned NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `shift_id` int(11) unsigned NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift_days`
--

CREATE TABLE IF NOT EXISTS `employee_shift_days` (
`id` int(10) unsigned NOT NULL,
  `employee_shift_id` int(10) unsigned NOT NULL,
  `day` enum('mon','tue','wed','thu','fri','sat','sun') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `description`, `shift_from`, `shift_to`, `working_hours`, `break`, `created_at`, `updated_at`) VALUES
(3, 'Shift 1', '09:00:00', '17:00:00', '08:00:00', '00:30:00', '2015-08-15 02:55:35', '0000-00-00 00:00:00'),
(4, 'Shift 2', '08:30:00', '17:30:00', '09:00:00', '01:30:00', '2015-08-15 02:55:35', '0000-00-00 00:00:00'),
(5, 'Shift 3', '22:00:00', '06:00:00', '08:00:00', '00:30:00', '2015-08-15 02:57:34', '0000-00-00 00:00:00'),
(6, 'Shift 4', '23:00:00', '08:00:00', '08:00:00', '00:30:00', '2015-08-15 02:57:34', '0000-00-00 00:00:00'),
(7, 'Shift 5', '14:00:00', '22:00:00', '08:00:00', '00:30:00', '2015-08-15 02:58:09', '0000-00-00 00:00:00'),
(8, 'Shift 6', '06:00:00', '14:00:00', '08:00:00', '00:30:00', '2015-08-15 03:00:06', '0000-00-00 00:00:00'),
(9, 'Shift 7', '10:00:00', '18:00:00', '08:00:00', '00:30:00', '2015-08-15 03:00:39', '0000-00-00 00:00:00'),
(10, 'Shift 8', '09:00:00', '18:00:00', '09:00:00', '01:30:00', '2015-08-15 03:01:13', '0000-00-00 00:00:00'),
(11, 'Shift 9', '07:00:00', '15:00:00', '08:00:00', '00:30:00', '2015-08-15 03:03:42', '0000-00-00 00:00:00'),
(12, 'Shift 10', '13:00:00', '21:00:00', '08:00:00', '00:30:00', '2015-08-15 03:14:36', '0000-00-00 00:00:00'),
(13, 'Shift 11', '00:00:00', '08:00:00', '08:00:00', '00:30:00', '2015-08-15 03:16:25', '0000-00-00 00:00:00'),
(14, 'Shift 12', '16:00:00', '00:00:00', '08:00:00', '00:30:00', '2015-08-15 03:17:39', '0000-00-00 00:00:00'),
(15, 'Shift 13', '16:00:00', '01:00:00', '09:00:00', '01:30:00', '2015-08-15 03:19:19', '0000-00-00 00:00:00'),
(17, 'Shift 14', '06:00:00', '15:00:00', '08:00:00', '00:30:00', '2015-08-15 04:00:13', '2015-08-14 19:59:56'),
(18, 'Shift 15', '08:00:00', '17:00:00', '09:00:00', '00:30:00', '2015-08-15 04:21:46', '2015-08-14 20:02:41'),
(19, 'Shift 16', '08:00:00', '16:00:00', '08:00:00', '00:30:00', '2015-08-15 04:22:45', '0000-00-00 00:00:00'),
(20, 'Shift 17', '07:00:00', '17:00:00', '09:00:00', '01:30:00', '2015-08-15 04:23:20', '0000-00-00 00:00:00'),
(21, 'Shift 18', '11:00:00', '19:00:00', '08:00:00', '00:30:00', '2015-08-15 04:24:04', '0000-00-00 00:00:00'),
(22, 'Shift 19', '10:00:00', '19:00:00', '08:00:00', '00:30:00', '2015-08-15 04:24:50', '0000-00-00 00:00:00'),
(23, '', '07:00:00', '16:00:00', '09:00:00', '01:30:00', '2015-08-15 04:25:17', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Rosemale-John II C. Villacorta', 'rosemalejohn@gmail.com', 'rosemalejohn', '$2y$10$FuqYG4eDr6kTW00RwvWVJ.EHPPkVrOO273CQ7mRROIRYSBVZ9NrPG', 'admin', NULL, '2015-08-14 23:34:32', '2015-08-14 23:34:32');

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `employee_dtr`
--
ALTER TABLE `employee_dtr`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_shift_days`
--
ALTER TABLE `employee_shift_days`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
