-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2026 at 06:45 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabasco_india`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `module` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_general_ci,
  `new_value` text COLLATE utf8mb4_general_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `module`, `old_value`, `new_value`, `ip_address`, `created_at`) VALUES
('58578cb6-c555-42e2-8d6b-990db1e082e6', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGIN', 'AUTH', NULL, NULL, '::1', '2026-06-11 04:41:48'),
('57c34cb3-c233-424b-bab9-0ade84e3161e', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGOUT', 'AUTH', NULL, NULL, '::1', '2026-06-11 04:42:19'),
('aac20851-445c-4eab-9a6e-d04db72ad82f', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGIN', 'AUTH', NULL, NULL, '::1', '2026-06-11 04:42:29'),
('f2e895c9-c00e-4505-928b-494c00bfb5ee', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGOUT', 'AUTH', NULL, NULL, '::1', '2026-06-11 05:45:29'),
('ce026cc4-4c04-4341-9ffe-2a0dbeebb3e5', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGIN', 'AUTH', NULL, NULL, '::1', '2026-06-11 05:51:16'),
('5451e534-351e-40ea-966a-ff91c76caf91', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGOUT', 'AUTH', NULL, NULL, '::1', '2026-06-11 05:53:11'),
('d780a541-ccee-4ecb-ad1d-2075aacd7abc', '074f00e7-d8bb-4483-a944-4123d4e36024', 'LOGIN', 'AUTH', NULL, NULL, '::1', '2026-06-11 05:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-06-10-140000', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1781083930, 1),
(2, '2026-06-10-141000', 'App\\Database\\Migrations\\CreatePermissionsTable', 'default', 'App', 1781083930, 1),
(3, '2026-06-10-142000', 'App\\Database\\Migrations\\CreateAuditLogsTable', 'default', 'App', 1781083930, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` enum('owner','accountant','sales','site_office') COLLATE utf8mb4_general_ci NOT NULL,
  `module` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT '0',
  `can_create` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '0',
  `can_approve` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_module` (`role`,`module`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role`, `module`, `can_view`, `can_create`, `can_edit`, `can_approve`) VALUES
(1, 'owner', 'projects', 1, 1, 1, 1),
(2, 'owner', 'units', 1, 1, 1, 1),
(3, 'owner', 'sales', 1, 1, 1, 1),
(4, 'owner', 'customers', 1, 1, 1, 1),
(5, 'owner', 'emi', 1, 1, 1, 1),
(6, 'owner', 'expenses', 1, 1, 1, 1),
(7, 'owner', 'petty_cash', 1, 1, 1, 1),
(8, 'owner', 'loans', 1, 1, 1, 1),
(9, 'owner', 'brokerage', 1, 1, 1, 1),
(10, 'owner', 'reports', 1, 1, 1, 1),
(11, 'owner', 'users', 1, 1, 1, 1),
(12, 'accountant', 'emi', 1, 1, 1, 0),
(13, 'accountant', 'expenses', 1, 1, 1, 0),
(14, 'accountant', 'loans', 1, 1, 1, 0),
(15, 'accountant', 'brokerage', 1, 1, 1, 0),
(16, 'accountant', 'reports', 1, 1, 1, 0),
(17, 'accountant', 'sales', 1, 0, 0, 0),
(18, 'sales', 'sales', 1, 1, 1, 0),
(19, 'sales', 'customers', 1, 1, 1, 0),
(20, 'sales', 'units', 1, 1, 1, 0),
(21, 'site_office', 'petty_cash', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('owner','accountant','sales','site_office') COLLATE utf8mb4_general_ci NOT NULL,
  `system` enum('india','uae') COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `system`, `is_active`, `created_at`, `updated_at`) VALUES
('074f00e7-d8bb-4483-a944-4123d4e36024', 'Admin User', 'admin@tabasco.in', '$2y$10$Jd8BWSBqrz28iEeBBQV6Ge96BEc3taSxrj6IkPTVpiSWUEwYPJokG', 'owner', 'india', 1, '2026-06-10 18:06:05', '2026-06-10 18:06:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
