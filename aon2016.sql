-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table aon2016.app
CREATE TABLE IF NOT EXISTS `app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` enum('ID','EN') NOT NULL,
  `vendor` tinyint(4) NOT NULL,
  `vendor_code` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `quesioner` varchar(200) NOT NULL,
  `com_1` text NOT NULL,
  `com_2` text NOT NULL,
  `dem_1` smallint(6) NOT NULL,
  `dem_2` tinyint(4) NOT NULL,
  `dem_3` tinyint(4) NOT NULL,
  `dem_4` tinyint(4) NOT NULL,
  `dem_5` tinyint(4) NOT NULL,
  `dem_6` tinyint(4) NOT NULL,
  `audit` enum('Y','') NOT NULL,
  `salah` enum('Y','') NOT NULL DEFAULT '',
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aon2016.app: ~0 rows (approximately)
/*!40000 ALTER TABLE `app` DISABLE KEYS */;
/*!40000 ALTER TABLE `app` ENABLE KEYS */;


-- Dumping structure for table aon2016.divisi
CREATE TABLE IF NOT EXISTS `divisi` (
  `code` int(11) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aon2016.divisi: ~130 rows (approximately)
/*!40000 ALTER TABLE `divisi` DISABLE KEYS */;
INSERT INTO `divisi` (`code`, `divisi`, `posisi`, `country`) VALUES
	(4112, 'Business services', 'Balinusa', 'ID'),
	(4113, 'Business services', 'Jawa Tengah', 'ID'),
	(4114, 'Business services', 'Central Sumatera', 'ID'),
	(4115, 'Business services', 'Jawa Timur', 'ID'),
	(4116, 'Business services', 'Jakarta', 'ID'),
	(4117, 'Business services', 'Kalimantan', 'ID'),
	(4118, 'Business services', 'Makassar', 'ID'),
	(4119, 'Business services', 'National Office', 'ID'),
	(4120, 'Business services', 'Cibitung', 'ID'),
	(4121, 'Business services', 'Northern Sumatera', 'ID'),
	(4122, 'Business services', 'Papua Maluku', 'ID'),
	(4123, 'Business services', 'Southern Sumatera', 'ID'),
	(4124, 'Business services', 'Jawa Barat', 'ID'),
	(4125, 'Finance & Governance', 'Balinusa', 'ID'),
	(4126, 'Finance & Governance', 'Jawa Tengah', 'ID'),
	(4127, 'Finance & Governance', 'Central Sumatera', 'ID'),
	(4128, 'Finance & Governance', 'Jawa Timur', 'ID'),
	(4129, 'Finance & Governance', 'Jakarta', 'ID'),
	(4130, 'Finance & Governance', 'Kalimantan', 'ID'),
	(4131, 'Finance & Governance', 'Makassar', 'ID'),
	(4132, 'Finance & Governance', 'National Office', 'ID'),
	(4133, 'Finance & Governance', 'Cibitung', 'ID'),
	(4134, 'Finance & Governance', 'Northern Sumatera', 'ID'),
	(4135, 'Finance & Governance', 'Papua Maluku', 'ID'),
	(4136, 'Finance & Governance', 'Southern Sumatera', 'ID'),
	(4137, 'Finance & Governance', 'Jawa Barat', 'ID'),
	(4138, 'Finance & Governance', 'Cikedokan', 'ID'),
	(4139, 'Human Resources', 'Balinusa', 'ID'),
	(4140, 'Human Resources', 'Jawa Tengah', 'ID'),
	(4141, 'Human Resources', 'Central Sumatera', 'ID'),
	(4142, 'Human Resources', 'Cikedokan', 'ID'),
	(4143, 'Human Resources', 'Jawa Timur', 'ID'),
	(4144, 'Human Resources', 'Jakarta', 'ID'),
	(4145, 'Human Resources', 'Kalimantan', 'ID'),
	(4146, 'Human Resources', 'Makassar', 'ID'),
	(4147, 'Human Resources', 'National Office', 'ID'),
	(4148, 'Human Resources', 'Cibitung', 'ID'),
	(4149, 'Human Resources', 'Northern Sumatera', 'ID'),
	(4150, 'Human Resources', 'Papua Maluku', 'ID'),
	(4151, 'Human Resources', 'Southern Sumatera', 'ID'),
	(4152, 'Human Resources', 'Jawa Barat', 'ID'),
	(4153, 'Information Technology', 'Balinusa', 'ID'),
	(4154, 'Information Technology', 'Jawa Tengah', 'ID'),
	(4155, 'Information Technology', 'Central Sumatera', 'ID'),
	(4156, 'Information Technology', 'Jawa Timur', 'ID'),
	(4157, 'Information Technology', 'Jakarta', 'ID'),
	(4158, 'Information Technology', 'Kalimantan', 'ID'),
	(4159, 'Information Technology', 'Makassar', 'ID'),
	(4160, 'Information Technology', 'National Office', 'ID'),
	(4161, 'Information Technology', 'Northern Sumatera', 'ID'),
	(4162, 'Information Technology', 'Southern Sumatera', 'ID'),
	(4163, 'Information Technology', 'Jawa Barat', 'ID'),
	(4164, 'Information Technology', 'Papua Maluku', 'ID'),
	(4165, 'Supply Chain', 'Balinusa', 'ID'),
	(4166, 'Supply Chain', 'Jawa Tengah', 'ID'),
	(4167, 'Supply Chain', 'Central Sumatera', 'ID'),
	(4168, 'Supply Chain', 'Cikedokan', 'ID'),
	(4169, 'Supply Chain', 'Jawa Timur', 'ID'),
	(4170, 'Supply Chain', 'National Office', 'ID'),
	(4171, 'Supply Chain', 'Cibitung', 'ID'),
	(4172, 'Supply Chain', 'Northern Sumatera', 'ID'),
	(4173, 'Supply Chain', 'Packaging Services', 'ID'),
	(4174, 'Supply Chain', 'Southern Sumatera', 'ID'),
	(4175, 'Supply Chain', 'Jawa Barat', 'ID'),
	(4176, 'Supply Chain', 'Jakarta', 'ID'),
	(4177, 'Supply Chain', 'Kalimantan', 'ID'),
	(4178, 'Supply Chain', 'Makassar', 'ID'),
	(4179, 'Sales General Trade', 'Balinusa', 'ID'),
	(4180, 'Sales General Trade', 'Jawa Tengah', 'ID'),
	(4181, 'Sales General Trade', 'Central Sumatera', 'ID'),
	(4182, 'Sales General Trade', 'Jawa Timur', 'ID'),
	(4183, 'Sales General Trade', 'Jakarta', 'ID'),
	(4184, 'Sales General Trade', 'Kalimantan', 'ID'),
	(4185, 'Sales General Trade', 'Makassar', 'ID'),
	(4186, 'Sales General Trade', 'National Office', 'ID'),
	(4187, 'Sales General Trade', 'Northern Sumatera', 'ID'),
	(4188, 'Sales General Trade', 'Papua Maluku', 'ID'),
	(4189, 'Sales General Trade', 'Southern Sumatera', 'ID'),
	(4190, 'Sales General Trade', 'Jawa Barat', 'ID'),
	(4191, 'Sales Modern Trade', 'Balinusa', 'ID'),
	(4192, 'Sales Modern Trade', 'Jawa Tengah', 'ID'),
	(4193, 'Sales Modern Trade', 'Central Sumatera', 'ID'),
	(4194, 'Sales Modern Trade', 'Jawa Timur', 'ID'),
	(4195, 'Sales Modern Trade', 'Jakarta', 'ID'),
	(4196, 'Sales Modern Trade', 'Kalimantan', 'ID'),
	(4197, 'Sales Modern Trade', 'Makassar', 'ID'),
	(4198, 'Sales Modern Trade', 'National Office', 'ID'),
	(4199, 'Sales Modern Trade', 'Northern Sumatera', 'ID'),
	(4200, 'Sales Modern Trade', 'Southern Sumatera', 'ID'),
	(4201, 'Sales Modern Trade', 'Jawa Barat', 'ID'),
	(4202, 'Management & Corporate Planning', 'National Office', 'ID'),
	(4073, 'Finance Administration', 'Finance ', 'EN'),
	(4074, 'Finance Administration', 'Finance & Administration - Commercial ', 'EN'),
	(4075, 'Finance Administration', 'Financial Control ', 'EN'),
	(4076, 'Finance Administration', 'Planning & Reporting ', 'EN'),
	(4077, 'Finance Administration', 'Regional Operations - Highlands ', 'EN'),
	(4078, 'Finance Administration', 'Regional Operations - Momase ', 'EN'),
	(4079, 'Finance Administration', 'Regional Operations - NGI ', 'EN'),
	(4080, 'Finance Administration', 'Regional Operations - Southern ', 'EN'),
	(4081, 'Finance Administration', 'Security & Fraud Control ', 'EN'),
	(4082, 'National Sales & Distribution', 'Regional Operations - Highlands ', 'EN'),
	(4083, 'National Sales & Distribution', 'Regional Operations - Momase ', 'EN'),
	(4084, 'National Sales & Distribution', 'Regional Operations - NGI ', 'EN'),
	(4085, 'National Sales & Distribution', 'Regional Operations - Southern ', 'EN'),
	(4086, 'CDES', 'Regional Operations - NGI ', 'EN'),
	(4087, 'CDES', 'Regional Operations - Highlands ', 'EN'),
	(4088, 'CDES', 'Regional Operations - Southern ', 'EN'),
	(4089, 'CDES', 'Regional Operations - Momase ', 'EN'),
	(4090, 'CDES', 'CDES ', 'EN'),
	(4091, 'Human Resources', 'Human Resources ', 'EN'),
	(4092, 'Human Resources', 'Regional Operations - Highlands ', 'EN'),
	(4093, 'Management', 'Management ', 'EN'),
	(4094, 'Marketing', 'Regional Operations - NGI ', 'EN'),
	(4095, 'Marketing', 'Regional Operations - Momase ', 'EN'),
	(4096, 'Marketing', 'Marketing ', 'EN'),
	(4097, 'Marketing', 'Regional Operations - Highlands ', 'EN'),
	(4098, 'Marketing', 'Regional Operations - Southern ', 'EN'),
	(4099, 'Supply Chain', 'Regional Operations - Southern ', 'EN'),
	(4100, 'Supply Chain', 'Sales & Operations Planning ', 'EN'),
	(4101, 'Supply Chain', 'Regional Operations - NGI ', 'EN'),
	(4102, 'Supply Chain', 'Regional Operations - Momase ', 'EN'),
	(4103, 'Supply Chain', 'Regional Operations - Highlands ', 'EN'),
	(4104, 'Supply Chain', 'Operations - Southern ', 'EN'),
	(4105, 'Supply Chain', 'Northern WH & Distribution ', 'EN'),
	(4106, 'Supply Chain', 'National Warehouse & Distribution ', 'EN'),
	(4107, 'Supply Chain', 'National Procurement ', 'EN'),
	(4108, 'Supply Chain', 'Manufacturing ', 'EN'),
	(4109, 'Supply Chain', 'Technical Operations ', 'EN'),
	(4110, 'Supply Chain', 'National Operations ', 'EN'),
	(4111, 'Business Services', 'Business Services ', 'EN');
/*!40000 ALTER TABLE `divisi` ENABLE KEYS */;


-- Dumping structure for table aon2016.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ip_login` varchar(50) NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `date_login` datetime NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_update` varchar(50) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table aon2016.user: ~19 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `level`, `status`, `ip_login`, `user_agent`, `date_login`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	(1, 'Adam Prasetia', 'damz', 'A267796', 1, 1, '::1', 'Windows 7(Google Chrome 53.0.2785.116)', '2016-10-04 12:34:07', '', '2015-09-30 09:35:33', '1', '2015-09-30 15:07:19'),
	(2, 'Teguh Santoso', 'teguh', 'cleopatra', 1, 1, '192.168.10.31', 'Windows 7(Google Chrome 53.0.2785.116)', '2016-10-04 09:51:25', '', '2015-09-30 09:35:52', '', '0000-00-00 00:00:00'),
	(7, 'Firman Rusbandy', 'firman', '10020', 3, 1, '192.168.10.178', 'Windows XP(Mozilla Firefox 41.0)', '2015-10-16 08:24:07', '1', '2015-10-08 14:35:06', '1', '2015-10-08 14:35:06'),
	(8, 'Julius', 'Julius', '11073', 3, 1, '192.168.10.175', 'Windows XP(Mozilla Firefox 14.0.1)', '2015-10-21 12:43:36', '1', '2015-10-08 14:41:32', '1', '2015-10-08 14:41:32'),
	(9, 'Asri Rahayu', 'asri', '15041', 3, 1, '192.168.10.177', 'Windows XP(Mozilla Firefox 37.0)', '2015-10-21 11:27:41', '1', '2015-10-08 15:24:11', '1', '2015-10-08 15:24:11'),
	(10, 'Alfiyani Dewi', 'alfiyani', 'aliyani', 3, 1, '192.168.10.176', 'Windows XP(Mozilla Firefox 24.0)', '2015-10-21 11:26:39', '1', '2015-10-08 15:24:22', '1', '2015-10-08 15:24:22'),
	(11, 'wiwi nurhaeni', 'wiwi', 'wiwi', 3, 1, '::1', 'Windows 7(Google Chrome 53.0.2785.116)', '2016-10-04 12:31:06', '', '2015-10-09 07:49:21', '', '0000-00-00 00:00:00'),
	(12, 'fathiah', 'thia', '230192', 3, 1, '192.168.10.154', 'Windows XP(Mozilla Firefox 20.0)', '2015-10-09 12:51:43', '', '2015-10-09 07:49:51', '', '0000-00-00 00:00:00'),
	(13, 'bogie septino', 'bogie', '130913', 3, 1, '192.168.10.65', 'Windows 7(Mozilla Firefox 41.0)', '2015-10-21 08:01:08', '', '2015-10-09 07:58:46', '', '0000-00-00 00:00:00'),
	(14, 'naila', 'nay', 'azmiprasetya', 3, 1, '192.168.10.155', 'Windows XP(Mozilla Firefox 13.0.1)', '2015-10-09 11:14:53', '', '2015-10-09 07:59:37', '', '0000-00-00 00:00:00'),
	(15, 'rahmat febriawan', 'febi', 'febi', 3, 1, '192.168.10.158', 'Windows XP(Mozilla Firefox 14.0.1)', '2015-10-09 13:02:13', '', '2015-10-09 08:29:54', '', '0000-00-00 00:00:00'),
	(16, 'Altobelly Giovanno', 'agiovanno', 'goodluck', 3, 1, '192.168.10.180', 'Windows XP(Mozilla Firefox 41.0)', '2015-10-27 07:41:31', '', '2015-10-09 09:45:10', '', '0000-00-00 00:00:00'),
	(17, 'wiwit ria meliyani', 'wiwit', '14147', 3, 1, '192.168.10.180', 'Windows XP(Mozilla Firefox 41.0)', '2015-10-15 14:26:56', '', '2015-10-09 10:02:47', '', '0000-00-00 00:00:00'),
	(18, 'De Admin', 'deadmin', 'deadmin123', 3, 1, '192.168.10.71', 'Windows 7(Mozilla Firefox 41.0)', '2015-10-22 07:13:19', '', '2015-10-09 18:21:28', '', '0000-00-00 00:00:00'),
	(19, 'Astri Leoni Agustin', 'leony', '200895', 3, 1, '192.168.10.60', 'Windows XP(Mozilla Firefox 41.0)', '2015-10-27 15:32:40', '', '2015-10-12 07:35:29', '', '0000-00-00 00:00:00'),
	(20, 'damara kartika sari', 'damara', '021293', 3, 1, '192.168.10.155', 'Windows XP(Mozilla Firefox 13.0.1)', '2015-10-13 15:36:12', '', '2015-10-13 07:23:58', '', '0000-00-00 00:00:00'),
	(21, 'shinta tri lestari', 'shinta15', 'shinta150991', 3, 1, '192.168.10.154', 'Windows XP(Mozilla Firefox 20.0)', '2015-10-13 07:38:44', '', '2015-10-13 07:26:55', '', '0000-00-00 00:00:00'),
	(22, 'gelin mandasari', 'gelin', 'pinkstar', 3, 1, '192.168.10.153', 'Windows XP(Mozilla Firefox 20.0)', '2015-10-13 07:53:53', '', '2015-10-13 07:53:38', '', '0000-00-00 00:00:00'),
	(23, 'Ratih Fadjarini', 'ratih', '14051', 3, 1, '192.168.10.156', 'Windows XP(Mozilla Firefox 41.0)', '2015-10-13 15:52:16', '', '2015-10-13 07:57:19', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table aon2016.vendor
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table aon2016.vendor: ~11 rows (approximately)
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;
INSERT INTO `vendor` (`id`, `name`) VALUES
	(1, 'POSEXPRESS'),
	(2, 'JNE'),
	(3, 'PANDU LOGISTIC'),
	(4, 'NA'),
	(5, 'TIKI'),
	(6, 'TNT'),
	(7, 'INDO PACIFIC'),
	(8, 'PLATINUM LOGISTIC'),
	(9, 'KERTA GAYA PUSAKA'),
	(10, 'PCP EXPRESS'),
	(11, 'NCS');
/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
