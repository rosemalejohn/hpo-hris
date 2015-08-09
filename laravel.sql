-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2015 at 02:12 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel`
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'WebDev', 'Web Development', 'Web Developers, Software Devs, Mobile Devs', '2015-08-05 06:31:05', '0000-00-00 00:00:00'),
(2, 'ADMIN', 'Administrator', 'Admin office staffs', '2015-08-08 07:19:39', '0000-00-00 00:00:00'),
(3, 'SysAd', 'System Administrator', 'Maintains technical problems', '2015-08-08 00:07:38', '2015-08-08 00:07:38'),
(4, 'Sales&Mar', 'Sales and Marketing', '', '2015-08-08 06:15:58', '2015-08-08 06:15:58'),
(5, 'QA', 'Quality Assurance', '', '2015-08-08 06:17:12', '2015-08-08 06:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(10) unsigned NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `department_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `name`, `status`, `department_id`, `created_at`, `updated_at`) VALUES
(3, 1203110, 'J.Quijano', '1', 1, '2015-08-05 07:10:30', '0000-00-00 00:00:00'),
(4, 1010062, 'Rian Barrientos', '1', 1, '2015-08-06 12:13:32', '0000-00-00 00:00:00'),
(6, 150102, 'Michael Tarongoy', '1', 1, '2015-08-07 22:25:34', '2015-08-07 22:25:34'),
(7, 140502, 'Nepthaly Talavera', '1', 2, '2015-08-08 06:00:48', '2015-08-08 06:00:48'),
(8, 150501, 'Javin Jet Tevar', '1', 4, '2015-08-08 06:16:16', '2015-08-08 06:16:16'),
(9, 1203020, 'Carlo Lozano', '1', 5, '2015-08-08 06:17:33', '2015-08-08 06:17:33');

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
  `undertime` time NOT NULL,
  `late` time NOT NULL,
  `overbreak` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_shifts`
--

INSERT INTO `employee_shifts` (`id`, `employee_id`, `shift_id`, `date_from`, `date_to`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2015-08-10', '2015-08-21', '2015-08-08 02:08:59', '0000-00-00 00:00:00'),
(2, 4, 1, '2015-08-02', '2015-08-07', '2015-08-06 12:14:12', '0000-00-00 00:00:00'),
(3, 3, 2, '2015-08-10', '2015-08-21', '2015-08-08 02:47:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift_days`
--

CREATE TABLE IF NOT EXISTS `employee_shift_days` (
`id` int(10) unsigned NOT NULL,
  `employee_shift_id` int(10) unsigned NOT NULL,
  `day` enum('mon','tues','wed','thurs','fri','sat','sun') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_shift_days`
--

INSERT INTO `employee_shift_days` (`id`, `employee_shift_id`, `day`) VALUES
(8, 1, 'mon'),
(9, 1, 'wed'),
(10, 1, 'fri'),
(11, 3, 'tues'),
(12, 3, 'thurs'),
(13, 2, 'mon'),
(14, 2, 'tues'),
(15, 2, 'wed'),
(16, 2, 'thurs'),
(17, 2, 'fri');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `description`, `shift_from`, `shift_to`, `working_hours`, `break`, `created_at`, `updated_at`) VALUES
(1, 'Regular Shift (8:30 AM to 5:30 PM)', '08:30:00', '05:30:00', '08:00:00', '01:00:00', '2015-08-07 23:19:08', '0000-00-00 00:00:00'),
(2, 'Afternoon Shift (2:00 PM to 10:00 PM)', '14:00:00', '22:00:00', '08:00:00', '01:00:00', '2015-08-08 02:48:02', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rosemale-John II C. Villacorta', 'rosemalejohn@gmail.com', 'rosemalejohn', '$2y$10$A2/p.e7KpHfQvB3mmFchpOJQDmH/lAQiwtxokUHsiQ0UtjEXbCFJi', 'admin', 'XrDBxPrIkcHCctlczG93POeQ6LuGZX7iysg5n9nm39e8Nobr4SgT7Akq5lQS', '2015-08-04 06:08:12', '2015-08-08 16:00:03');

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee_dtr`
--
ALTER TABLE `employee_dtr`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=460;
--
-- AUTO_INCREMENT for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee_shift_days`
--
ALTER TABLE `employee_shift_days`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
