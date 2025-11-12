-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 12:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation_db`
--
CREATE DATABASE IF NOT EXISTS `evaluation_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `evaluation_db`;

-- --------------------------------------------------------

--
-- Table structure for table `academic_list`
--

CREATE TABLE `academic_list` (
  `id` int(30) NOT NULL,
  `year` text NOT NULL,
  `semester` int(30) NOT NULL,
  `quarter` int(30) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Start,2=Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_list`
--

INSERT INTO `academic_list` (`id`, `year`, `semester`, `quarter`, `is_default`, `status`) VALUES
(1, '2019-2020', 1, 1, 0, 0),
(2, '2019-2020', 2, 1, 0, 0),
(3, '2020-2021', 1, 1, 0, 2),
(4, '2024-2025', 0, 1, 0, 2),
(5, '2024-2025', 0, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_history_logs`
--

CREATE TABLE `admin_history_logs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `action_description` text NOT NULL,
  `target_table` varchar(100) DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL,
  `old_values` text DEFAULT NULL,
  `new_values` text DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_history_logs`
--

INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(1, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '1rn4phrl2a9e6lu6h66heu2hsq', '2025-08-11 18:11:24'),
(2, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:04:44'),
(3, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:04:54'),
(4, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:04'),
(5, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:16'),
(6, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:19'),
(7, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:29'),
(8, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:31'),
(9, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:40'),
(10, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:42'),
(11, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:44'),
(12, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:05:45'),
(13, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:01'),
(14, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:02'),
(15, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:08'),
(16, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:09'),
(17, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:25'),
(18, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:35'),
(19, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:46'),
(20, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:47'),
(21, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:53'),
(22, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:06:55'),
(23, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:07:13'),
(24, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:07:15'),
(25, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:07:21'),
(26, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:07:23'),
(27, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:07:27'),
(28, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:08:14'),
(29, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:08:32'),
(30, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:09:54'),
(31, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:10:06'),
(32, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:10:20'),
(33, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:10:22'),
(34, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:12:59'),
(35, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:15:29'),
(36, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:15:32'),
(37, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: admin@admin.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:15:54'),
(38, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:20:53'),
(39, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:36:11'),
(40, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:36:19'),
(41, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:39:08'),
(42, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:39:22'),
(43, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:40:02'),
(44, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:43:53'),
(45, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:43:57'),
(46, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:49:02'),
(47, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:49:12'),
(48, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:53:26'),
(49, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:53:43'),
(50, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:55:45'),
(51, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 15:55:49'),
(52, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:05:33'),
(53, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:06:06'),
(54, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:26:22'),
(55, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:27:24'),
(56, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:27:28'),
(57, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:30:05'),
(58, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 16:40:56'),
(59, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:32:10'),
(60, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:32:17'),
(61, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:34:41'),
(62, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:38:01'),
(63, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:38:16'),
(64, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:38:18'),
(65, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:42:06'),
(66, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '4l73ehlnlji0pl5hdp75ok6c55', '2025-08-15 18:42:15'),
(67, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'uf5dshjv84jaa9r5lfetqtj418', '2025-08-15 19:58:15'),
(68, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'uf5dshjv84jaa9r5lfetqtj418', '2025-08-15 20:43:49'),
(69, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'uf5dshjv84jaa9r5lfetqtj418', '2025-08-15 20:43:54'),
(70, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 02:50:16'),
(71, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 08:28:42'),
(72, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 08:28:50'),
(73, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 08:30:37'),
(74, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 09:13:54'),
(75, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 09:58:43'),
(76, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 16:52:09'),
(77, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: rocky Oga - ID: 4', 'faculty_list', 4, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 17:05:01'),
(78, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: rocky Oga - ID: 4', 'faculty_list', 4, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 17:05:03'),
(79, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 20:39:05'),
(80, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 20:41:10'),
(81, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 20:46:38'),
(82, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 20:52:00'),
(83, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 21:00:29'),
(84, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 21:04:40'),
(85, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 21:05:28'),
(86, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 21:50:39'),
(87, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:02:28'),
(88, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:02:28'),
(89, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:05:20'),
(90, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:07:23'),
(91, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:10:39'),
(92, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:11:29'),
(93, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:11:31'),
(94, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:11:38'),
(95, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:14:22'),
(96, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:15:43'),
(97, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:16:07'),
(98, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:17:33'),
(99, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:25:03'),
(100, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 22:27:11'),
(101, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: rocky Oga - ID: 4', 'faculty_list', 4, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:25:35'),
(102, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:31:16'),
(103, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:34:06'),
(104, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:35:34'),
(105, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:47:08'),
(106, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:49:16'),
(107, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:53:20'),
(108, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:56:29'),
(109, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-16 23:59:38'),
(110, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 00:03:17'),
(111, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 12:40:58'),
(112, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:15:58'),
(113, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:16:22'),
(114, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:22:13'),
(115, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:23:07'),
(116, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:23:12'),
(117, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:28:51'),
(118, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:28:56'),
(119, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:29:26'),
(120, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:30:02'),
(121, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:30:25'),
(122, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:04'),
(123, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:23'),
(124, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:24'),
(125, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:25'),
(126, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:25'),
(127, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:25'),
(128, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:26'),
(129, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:26'),
(130, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:26'),
(131, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:31:26'),
(132, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:45:58'),
(133, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:47:33'),
(134, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:47:52'),
(135, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 13:56:00'),
(136, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 14:12:52'),
(137, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 14:13:17'),
(138, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 14:13:18'),
(139, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 14:13:18'),
(140, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 14:13:39'),
(141, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 14:13:40'),
(142, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:05:30'),
(143, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:10:35'),
(144, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:14:50'),
(145, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:16:58'),
(146, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:16:59'),
(147, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:16:59'),
(148, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:00'),
(149, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:00'),
(150, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:01'),
(151, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:01'),
(152, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:02'),
(153, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:02'),
(154, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:03'),
(155, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:03'),
(156, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:04'),
(157, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:04'),
(158, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:05'),
(159, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:06'),
(160, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:06'),
(161, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:17:06');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(162, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:19:03'),
(163, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:24:01'),
(164, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:24:02'),
(165, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:24:02'),
(166, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 15:55:18'),
(167, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:11:41'),
(168, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:35:44'),
(169, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:49:03'),
(170, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:51:30'),
(171, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfcaulty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Trae/1.100.3 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'mpfen9s6kd1fstj1nma8j0ht65', '2025-08-17 16:53:31'),
(172, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfcaulty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Trae/1.100.3 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'mpfen9s6kd1fstj1nma8j0ht65', '2025-08-17 16:53:35'),
(173, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Trae/1.100.3 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'mpfen9s6kd1fstj1nma8j0ht65', '2025-08-17 16:53:56'),
(174, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:54:32'),
(175, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Trae/1.100.3 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'mpfen9s6kd1fstj1nma8j0ht65', '2025-08-17 16:58:41'),
(176, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:58:59'),
(177, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 16:59:00'),
(178, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Trae/1.100.3 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'mpfen9s6kd1fstj1nma8j0ht65', '2025-08-17 17:01:48'),
(179, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:01:55'),
(180, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:08:13'),
(181, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Trae/1.100.3 Chrome/132.0.6834.210 Electron/34.5.1 Safari/537.36', 'mpfen9s6kd1fstj1nma8j0ht65', '2025-08-17 17:09:54'),
(182, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:17:14'),
(183, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:17:16'),
(184, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:17:29'),
(185, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:18:51'),
(186, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:20:18'),
(187, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:20:27'),
(188, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:20:31'),
(189, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:23:23'),
(190, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:27:17'),
(191, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:30'),
(192, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:32'),
(193, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:33'),
(194, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:34'),
(195, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:40'),
(196, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:40'),
(197, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:40'),
(198, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:40'),
(199, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:40'),
(200, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:41'),
(201, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:41'),
(202, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:41'),
(203, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:41'),
(204, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:41'),
(205, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:54'),
(206, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:54'),
(207, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:54'),
(208, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 17:29:54'),
(209, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:29:38'),
(210, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:30:11'),
(211, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:32:23'),
(212, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:37:31'),
(213, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:39:28'),
(214, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:39:54'),
(215, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 18:55:00'),
(216, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:31:22'),
(217, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:31:33'),
(218, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:31:34'),
(219, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:33:10'),
(220, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:37:55'),
(221, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:38:18'),
(222, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:38:49'),
(223, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:38:49'),
(224, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:40:09'),
(225, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:40:09'),
(226, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:42:15'),
(227, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:45:47'),
(228, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:47:59'),
(229, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:48:01'),
(230, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:48:02'),
(231, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:48:02'),
(232, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:48:46'),
(233, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:48:47'),
(234, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:48:49'),
(235, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:49:14'),
(236, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:49:15'),
(237, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:49:16'),
(238, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 19:52:54'),
(239, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:23:51'),
(240, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:29:12'),
(241, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:30:15'),
(242, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:33:49'),
(243, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:37:05'),
(244, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:42:02'),
(245, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:43:59'),
(246, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:45:47'),
(247, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:53:10'),
(248, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:54:43'),
(249, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:56:13'),
(250, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:56:28'),
(251, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 20:59:47'),
(252, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:00:10'),
(253, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:00:10'),
(254, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:05:57'),
(255, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:34:07'),
(256, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:34:27'),
(257, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:48:15'),
(258, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:50:12'),
(259, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:50:20'),
(260, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:51:33'),
(261, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:52:48'),
(262, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:53:09'),
(263, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:53:38'),
(264, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:55:02'),
(265, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:56:17'),
(266, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:56:30'),
(267, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 21:59:55'),
(268, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:04:52'),
(269, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:29:26'),
(270, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:30:13'),
(271, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:30:15'),
(272, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:30:53'),
(273, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:33:25'),
(274, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:34:05'),
(275, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:35:49'),
(276, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:36:48'),
(277, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:37:17'),
(278, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:48:55'),
(279, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:50:21'),
(280, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:51:02'),
(281, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:55:06'),
(282, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:55:47'),
(283, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:57:31'),
(284, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:58:56'),
(285, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:58:59'),
(286, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 22:59:09'),
(287, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:00:23'),
(288, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:03:26'),
(289, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:06:58'),
(290, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:08:11'),
(291, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:08:58'),
(292, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:09:57'),
(293, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:09:58'),
(294, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:09:59'),
(295, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:10:49'),
(296, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:12:49'),
(297, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:15:38'),
(298, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:16:42'),
(299, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:26:52'),
(300, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '8a8gr0oki5kccji0uemvjfi2ib', '2025-08-17 23:27:15'),
(301, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '414u5oke8elu1u9uk3j2o3b5gq', '2025-08-17 23:40:25'),
(302, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '414u5oke8elu1u9uk3j2o3b5gq', '2025-08-17 23:40:42'),
(303, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:11:18'),
(304, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:13:36'),
(305, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:13:43'),
(306, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:18:12'),
(307, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:18:24'),
(308, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:18:45'),
(309, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:18:55'),
(310, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:18:56'),
(311, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:19:50'),
(312, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:20:04'),
(313, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:20:57'),
(314, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:20:58'),
(315, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:21:01'),
(316, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:21:07'),
(317, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:21:07'),
(318, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:21:09'),
(319, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:22:23');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(320, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:22:24'),
(321, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:23:15'),
(322, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:23:16'),
(323, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:23:57'),
(324, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:23:58'),
(325, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:24:23'),
(326, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:26:08'),
(327, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:26:08'),
(328, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:26:18'),
(329, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:27:00'),
(330, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:27:54'),
(331, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:27:55'),
(332, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:28:39'),
(333, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:29:16'),
(334, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:29:17'),
(335, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:30:54'),
(336, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:30:55'),
(337, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:33:56'),
(338, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:33:57'),
(339, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:37:25'),
(340, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:39:36'),
(341, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:39:37'),
(342, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:39:54'),
(343, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:41:57'),
(344, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:41:58'),
(345, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:28'),
(346, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:37'),
(347, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:37'),
(348, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:38'),
(349, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:38'),
(350, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:38'),
(351, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:38'),
(352, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:39'),
(353, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:39'),
(354, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:39'),
(355, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:39'),
(356, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:40'),
(357, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:44'),
(358, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:43:45'),
(359, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:44:38'),
(360, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:45:32'),
(361, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:45:55'),
(362, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:45:56'),
(363, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:47:16'),
(364, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:48:00'),
(365, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:48:01'),
(366, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:48:01'),
(367, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:48:20'),
(368, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:48:20'),
(369, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:48:42'),
(370, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 06:50:54'),
(371, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:02:01'),
(372, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:34'),
(373, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:50'),
(374, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:51'),
(375, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:51'),
(376, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:52'),
(377, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:52'),
(378, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:52'),
(379, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:52'),
(380, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:52'),
(381, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:52'),
(382, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:53'),
(383, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:53'),
(384, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:53'),
(385, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:53'),
(386, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:53'),
(387, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:53'),
(388, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:09:54'),
(389, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:10:10'),
(390, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:10:59'),
(391, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:11:01'),
(392, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:11:11'),
(393, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:13:58'),
(394, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:14:04'),
(395, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:14:46'),
(396, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:15:28'),
(397, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:15:29'),
(398, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:15:30'),
(399, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:15:31'),
(400, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:15:54'),
(401, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:15:55'),
(402, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:16:08'),
(403, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:19:24'),
(404, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:23:18'),
(405, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:26:13'),
(406, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:26:16'),
(407, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:26:30'),
(408, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:26:36'),
(409, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:26:37'),
(410, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:29:22'),
(411, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:41:18'),
(412, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:42:27'),
(413, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:42:28'),
(414, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:46:32'),
(415, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:47:15'),
(416, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:47:18'),
(417, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:49:18'),
(418, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:49:19'),
(419, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:49:20'),
(420, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:49:58'),
(421, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:50:02'),
(422, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:50:06'),
(423, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:50:06'),
(424, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:53:08'),
(425, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:54:10'),
(426, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:54:11'),
(427, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:54:34'),
(428, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:54:34'),
(429, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:57:13'),
(430, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:22'),
(431, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:22'),
(432, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:23'),
(433, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:24'),
(434, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:24'),
(435, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:25'),
(436, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:26'),
(437, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:26'),
(438, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:40'),
(439, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:58:43'),
(440, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:59:11'),
(441, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:59:24'),
(442, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 07:59:25'),
(443, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:18:11'),
(444, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:21:28'),
(445, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:21:42'),
(446, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:21:43'),
(447, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:21:52'),
(448, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:21:57'),
(449, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:22:06'),
(450, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'oh5fih2g714u54ndt7abtmtl0d', '2025-08-18 08:22:13'),
(451, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 09:03:58'),
(452, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 10:52:36'),
(453, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 10:52:36'),
(454, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 10:52:36'),
(455, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 10:53:00'),
(456, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 11:13:29'),
(457, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 11:15:43'),
(458, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qi0cn5haso54m1knvekl4mh69c', '2025-08-18 11:27:48'),
(459, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 15:58:00'),
(460, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 15:58:19'),
(461, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 15:59:33'),
(462, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:05:49'),
(463, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:14:32'),
(464, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:16:38'),
(465, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:28:26'),
(466, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:28:27'),
(467, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:32:17'),
(468, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:32:33'),
(469, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:36:16'),
(470, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:36:53'),
(471, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:38:49'),
(472, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:39:31'),
(473, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:45:23'),
(474, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:49:52'),
(475, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 16:49:58'),
(476, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 17:06:28'),
(477, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 17:24:30'),
(478, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 17:24:36'),
(479, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 19:30:52');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(480, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 19:31:01'),
(481, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-18 19:31:16'),
(482, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 02:03:12'),
(483, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 02:03:12'),
(484, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 02:34:58'),
(485, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 10:10:24'),
(486, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 10:13:33'),
(487, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 10:13:34'),
(488, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 10:13:35'),
(489, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 10:13:35'),
(490, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 10:13:36'),
(491, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 13:34:53'),
(492, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 13:36:08'),
(493, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 13:36:14'),
(494, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 13:51:23'),
(495, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 14:15:50'),
(496, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '85m2mtpt53s4d5crq0g6pi7o44', '2025-08-19 14:18:20'),
(497, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 18:15:02'),
(498, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 19:37:38'),
(499, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 19:50:51'),
(500, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:19:11'),
(501, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:42:20'),
(502, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:44:06'),
(503, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:44:37'),
(504, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:45:53'),
(505, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:47:01'),
(506, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:48:27'),
(507, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:50:43'),
(508, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:53:38'),
(509, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:53:50'),
(510, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:56:37'),
(511, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 20:57:44'),
(512, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:01:46'),
(513, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:03:33'),
(514, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:04:23'),
(515, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:04:52'),
(516, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:13:46'),
(517, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:14:17'),
(518, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:23:18'),
(519, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:23:31'),
(520, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:26:52'),
(521, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:26:53'),
(522, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:27:30'),
(523, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:27:45'),
(524, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:28:26'),
(525, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:29:17'),
(526, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:29:26'),
(527, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:29:27'),
(528, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:29:56'),
(529, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:29:56'),
(530, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:30:19'),
(531, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:30:24'),
(532, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:30:25'),
(533, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:31:21'),
(534, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:31:22'),
(535, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:31:22'),
(536, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:32:20'),
(537, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:32:43'),
(538, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:32:58'),
(539, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:33:33'),
(540, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:33:43'),
(541, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:33:53'),
(542, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:34:33'),
(543, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:35:12'),
(544, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:38:50'),
(545, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:41:23'),
(546, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:42:23'),
(547, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:45:14'),
(548, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:47:34'),
(549, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:47:57'),
(550, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:50:55'),
(551, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:51:01'),
(552, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:52:19'),
(553, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:52:34'),
(554, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:53:15'),
(555, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:53:22'),
(556, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:53:35'),
(557, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:53:43'),
(558, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:53:51'),
(559, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:54:01'),
(560, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:54:07'),
(561, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:54:21'),
(562, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:54:34'),
(563, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:54:35'),
(564, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:54:46'),
(565, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 21:58:28'),
(566, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 22:10:02'),
(567, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 22:11:26'),
(568, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 22:21:45'),
(569, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 22:30:08'),
(570, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-19 22:31:17'),
(571, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 06:36:17'),
(572, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 07:19:31'),
(573, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 07:32:22'),
(574, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 08:34:04'),
(575, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 09:20:09'),
(576, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 09:20:46'),
(577, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 09:39:20'),
(578, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 10:00:04'),
(579, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 10:05:38'),
(580, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 10:05:46'),
(581, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 10:20:47'),
(582, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfcaulty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '192.168.68.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'q6784a2jkmk3904e3o4duuvecd', '2025-08-20 10:31:08'),
(583, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '192.168.68.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'q6784a2jkmk3904e3o4duuvecd', '2025-08-20 10:31:19'),
(584, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '192.168.68.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'q6784a2jkmk3904e3o4duuvecd', '2025-08-20 10:31:40'),
(585, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '192.168.68.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'q6784a2jkmk3904e3o4duuvecd', '2025-08-20 10:32:42'),
(586, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 11:39:11'),
(587, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 11:44:14'),
(588, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:38:17'),
(589, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:42:15'),
(590, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:44:32'),
(591, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:47:41'),
(592, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:49:31'),
(593, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:50:04'),
(594, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:50:15'),
(595, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:50:19'),
(596, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:50:23'),
(597, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:51:52'),
(598, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:52:17'),
(599, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:52:58'),
(600, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:53:11'),
(601, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:54:16'),
(602, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:55:17'),
(603, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:55:58'),
(604, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:56:56'),
(605, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 16:59:04'),
(606, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:00:36'),
(607, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:02:36'),
(608, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:07:23'),
(609, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:07:30'),
(610, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:37:03'),
(611, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:37:08'),
(612, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:44:49'),
(613, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:48:06'),
(614, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:52:54'),
(615, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 17:55:01'),
(616, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:00:32'),
(617, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:16:52'),
(618, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:23:03'),
(619, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:23:45'),
(620, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:25:10'),
(621, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:29:27'),
(622, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:31:44'),
(623, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:35:04'),
(624, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:35:40'),
(625, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:35:55'),
(626, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 18:59:52'),
(627, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:00:10'),
(628, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:18:14'),
(629, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:22:24'),
(630, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:22:56'),
(631, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:25:54'),
(632, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:26:08'),
(633, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:30:49'),
(634, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:31:49'),
(635, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:36:05'),
(636, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:37:07'),
(637, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:39:51'),
(638, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:39:52'),
(639, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:42:23'),
(640, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:48:38'),
(641, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:49:10');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(642, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:49:49'),
(643, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:50:07'),
(644, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 19:59:23'),
(645, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:00:53'),
(646, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:03:56'),
(647, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:07:18'),
(648, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:07:38'),
(649, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:09:38'),
(650, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:12:20'),
(651, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:12:35'),
(652, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:55:27'),
(653, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 20:58:00'),
(654, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 21:02:08'),
(655, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 21:03:05'),
(656, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 21:03:12'),
(657, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 22:11:50'),
(658, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 22:23:13'),
(659, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 22:38:33'),
(660, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 22:42:44'),
(661, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 22:53:46'),
(662, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:00:14'),
(663, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:00:14'),
(664, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:02:18'),
(665, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:04:06'),
(666, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:04:06'),
(667, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:04:06'),
(668, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:04:06'),
(669, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:07:58'),
(670, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:16:43'),
(671, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:22:03'),
(672, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:23:14'),
(673, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:26:26'),
(674, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:27:54'),
(675, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:28:38'),
(676, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:30:18'),
(677, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:32:24'),
(678, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:32:51'),
(679, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:33:25'),
(680, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:35:12'),
(681, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-20 23:41:16'),
(682, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-21 00:01:55'),
(683, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-21 00:24:53'),
(684, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-21 00:37:20'),
(685, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'n6jnvn5naekmctf6fkd5n2hgri', '2025-08-21 01:04:00'),
(686, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 08:02:58'),
(687, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 08:17:04'),
(688, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 08:31:24'),
(689, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 08:32:28'),
(690, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 08:47:33'),
(691, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 08:59:54'),
(692, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 09:41:32'),
(693, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 09:42:35'),
(694, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 12:24:45'),
(695, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 12:24:50'),
(696, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 12:38:27'),
(697, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '6nk8t9qkk1ab2k50qaur7eq282', '2025-08-21 13:07:22'),
(698, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 08:53:23'),
(699, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 08:59:46'),
(700, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 09:05:38'),
(701, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 09:09:21'),
(702, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 09:11:31'),
(703, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 09:13:46'),
(704, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 09:16:15'),
(705, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 09:21:46'),
(706, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-22 13:06:52'),
(707, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:20:33'),
(708, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:35:17'),
(709, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:35:18'),
(710, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:36:44'),
(711, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:37:02'),
(712, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:37:04'),
(713, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:37:53'),
(714, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:38:18'),
(715, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:38:19'),
(716, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:40:24'),
(717, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:41:15'),
(718, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:43:07'),
(719, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:45:58'),
(720, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:49:58'),
(721, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:56:36'),
(722, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 08:59:45'),
(723, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:01:02'),
(724, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:01:18'),
(725, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:07:54'),
(726, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:09:33'),
(727, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:10:04'),
(728, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:10:48'),
(729, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:11:15'),
(730, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:12:21'),
(731, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:12:46'),
(732, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:13:41'),
(733, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:13:53'),
(734, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:13:55'),
(735, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:15:34'),
(736, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:16:11'),
(737, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:33:37'),
(738, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:33:57'),
(739, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:34:58'),
(740, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:35:43'),
(741, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:36:28'),
(742, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:38:55'),
(743, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:40:12'),
(744, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:40:21'),
(745, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:42:48'),
(746, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:43:20'),
(747, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:44:50'),
(748, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:44:52'),
(749, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:44:53'),
(750, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:44:55'),
(751, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:44:56'),
(752, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:48:02'),
(753, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 09:59:31'),
(754, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:00:11'),
(755, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:00:40'),
(756, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:01:01'),
(757, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:01:38'),
(758, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:01:45'),
(759, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:02:11'),
(760, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:03:42'),
(761, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:05:05'),
(762, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'lebs9p3v4ld03jnbv4q4s8pfhp', '2025-08-23 10:07:38'),
(763, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:08:14'),
(764, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:16:23'),
(765, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:17:32'),
(766, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:19:50'),
(767, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:23:39'),
(768, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:24:03'),
(769, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:25:20'),
(770, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:14'),
(771, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:24'),
(772, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:25'),
(773, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:26'),
(774, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:28'),
(775, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:29'),
(776, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:29'),
(777, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:30'),
(778, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:33'),
(779, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:34'),
(780, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:34'),
(781, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:35'),
(782, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:40'),
(783, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:42'),
(784, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:43'),
(785, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:45'),
(786, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:26:52'),
(787, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:27:01'),
(788, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:27:01'),
(789, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:27:05'),
(790, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:27:09'),
(791, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:27:12'),
(792, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:27:25'),
(793, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:28:32'),
(794, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:29:01'),
(795, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:29:12'),
(796, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:29:26'),
(797, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:29:57'),
(798, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:38:33'),
(799, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:38:51');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(800, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:39:20'),
(801, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:40:50'),
(802, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:43:29'),
(803, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:47:07'),
(804, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:47:42'),
(805, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:47:57'),
(806, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:48:10'),
(807, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 10:59:20'),
(808, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '83nkm2ruc26sc4qk61h1q76kbk', '2025-08-23 15:02:21'),
(809, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-24 23:58:09'),
(810, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-24 23:58:18'),
(811, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-24 23:58:19'),
(812, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-25 00:04:30'),
(813, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-25 00:06:21'),
(814, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-25 00:26:36'),
(815, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-25 00:54:15'),
(816, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'qc8i4hl9a6felj3ha0ojp6qsbt', '2025-08-25 01:08:57'),
(817, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2u4ilr0ljqdj63a6ruj9d5fvh8', '2025-08-25 13:42:47'),
(818, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2u4ilr0ljqdj63a6ruj9d5fvh8', '2025-08-25 13:57:13'),
(819, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2u4ilr0ljqdj63a6ruj9d5fvh8', '2025-08-25 13:59:03'),
(820, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2u4ilr0ljqdj63a6ruj9d5fvh8', '2025-08-25 17:47:57'),
(821, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2u4ilr0ljqdj63a6ruj9d5fvh8', '2025-08-25 18:27:13'),
(822, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ogfodpjo089h9fspo51dr85g2h', '2025-08-26 18:35:02'),
(823, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ogfodpjo089h9fspo51dr85g2h', '2025-08-26 21:36:13'),
(824, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0eipn8i0qnlgv2vq1dm4cgje1s', '2025-08-26 22:47:31'),
(825, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0eipn8i0qnlgv2vq1dm4cgje1s', '2025-08-27 02:47:59'),
(826, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'hvkctl5sjdibdum386931kq77p', '2025-08-27 08:32:30'),
(827, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'hvkctl5sjdibdum386931kq77p', '2025-08-27 10:35:52'),
(828, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'hvkctl5sjdibdum386931kq77p', '2025-08-27 10:44:19'),
(829, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'hvkctl5sjdibdum386931kq77p', '2025-08-27 10:44:24'),
(830, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'hvkctl5sjdibdum386931kq77p', '2025-08-27 14:22:19'),
(831, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-27 20:07:00'),
(832, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-27 20:07:05'),
(833, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-27 20:17:18'),
(834, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 02:48:05'),
(835, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 02:54:39'),
(836, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 02:54:55'),
(837, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 02:56:36'),
(838, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:11'),
(839, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:13'),
(840, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:14'),
(841, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:14'),
(842, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:22'),
(843, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:23'),
(844, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:23'),
(845, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:23'),
(846, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:23'),
(847, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:26'),
(848, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:51'),
(849, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 03:00:52'),
(850, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 11:28:51'),
(851, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 14:28:25'),
(852, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 14:34:47'),
(853, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-28 14:36:10'),
(854, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 02:28:28'),
(855, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 08:57:04'),
(856, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 08:57:16'),
(857, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 08:58:00'),
(858, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 09:20:34'),
(859, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:38:19'),
(860, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:38:22'),
(861, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:39:50'),
(862, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:40:04'),
(863, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:41:02'),
(864, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:41:14'),
(865, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:45:33'),
(866, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:46:13'),
(867, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:46:16'),
(868, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:46:25'),
(869, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:46:26'),
(870, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:04'),
(871, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:05'),
(872, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:19'),
(873, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:23'),
(874, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:32'),
(875, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:35'),
(876, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:40'),
(877, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:47'),
(878, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:47:51'),
(879, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:52:29'),
(880, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:52:34'),
(881, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:52:38'),
(882, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:52:50'),
(883, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:53:18'),
(884, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:54:55'),
(885, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:55:02'),
(886, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:55:28'),
(887, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:55:41'),
(888, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:57:29'),
(889, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:57:33'),
(890, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:58:12'),
(891, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:58:17'),
(892, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:59:42'),
(893, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:59:43'),
(894, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 15:59:49'),
(895, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:02:35'),
(896, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:03:01'),
(897, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:03:25'),
(898, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:03:26'),
(899, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:03:26'),
(900, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:23'),
(901, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:23'),
(902, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:23'),
(903, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:34'),
(904, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:37'),
(905, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:46'),
(906, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:50'),
(907, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:51'),
(908, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:04:54'),
(909, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:06:55'),
(910, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:07'),
(911, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:14'),
(912, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:16'),
(913, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:17'),
(914, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:17'),
(915, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:17'),
(916, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:18'),
(917, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:18'),
(918, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:18'),
(919, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:18'),
(920, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:18'),
(921, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:18'),
(922, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:19'),
(923, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:19'),
(924, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:19'),
(925, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:21'),
(926, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:21'),
(927, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:07:34'),
(928, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:08:46'),
(929, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:11:26'),
(930, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:12:36'),
(931, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:12:51'),
(932, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:15:18'),
(933, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:15:34'),
(934, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:16:43'),
(935, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:16:59'),
(936, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:17:06'),
(937, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:33:08'),
(938, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:33:17'),
(939, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:33:37'),
(940, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:37:47'),
(941, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:38:16'),
(942, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:39:02'),
(943, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:39:03'),
(944, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:39:10'),
(945, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:40:25'),
(946, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:41:14'),
(947, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:41:40'),
(948, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:42:22'),
(949, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:43:04'),
(950, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:46:09'),
(951, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:46:23'),
(952, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:46:33'),
(953, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:47:36'),
(954, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:48:12'),
(955, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 16:48:22'),
(956, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:00:32'),
(957, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:02:26'),
(958, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:02:37'),
(959, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:02:52'),
(960, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:03:10');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(961, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:04:46'),
(962, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:04:46'),
(963, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:04:59'),
(964, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:05:06'),
(965, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:05:20'),
(966, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:06:07'),
(967, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:07:07'),
(968, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:07:08'),
(969, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:09:46'),
(970, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:12:22'),
(971, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:13:09'),
(972, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:13:11'),
(973, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:13:12'),
(974, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:13:39'),
(975, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:13:40'),
(976, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:14:31'),
(977, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:16:09'),
(978, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:19:40'),
(979, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:22:42'),
(980, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:27:50'),
(981, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:28:04'),
(982, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:28:23'),
(983, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:28:30'),
(984, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:31:38'),
(985, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:31:52'),
(986, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:32:52'),
(987, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:32:52'),
(988, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:32:52'),
(989, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:32:53'),
(990, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:34:52'),
(991, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:37:20'),
(992, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:39:50'),
(993, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:39:52'),
(994, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:40:13'),
(995, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:43:11'),
(996, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:43:14'),
(997, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:44:18'),
(998, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:45:14'),
(999, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:45:21'),
(1000, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:45:22'),
(1001, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:45:23'),
(1002, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:45:55'),
(1003, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:46:45'),
(1004, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:47:08'),
(1005, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:48:31'),
(1006, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:50:38'),
(1007, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:51:39'),
(1008, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:51:52'),
(1009, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:52:00'),
(1010, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:52:14'),
(1011, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:52:24'),
(1012, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:54:22'),
(1013, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:54:32'),
(1014, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:55:47'),
(1015, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:55:47'),
(1016, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:56:02'),
(1017, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:56:06'),
(1018, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:56:27'),
(1019, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:57:10'),
(1020, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:57:17'),
(1021, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:57:21'),
(1022, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:57:34'),
(1023, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:57:54'),
(1024, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 17:59:10'),
(1025, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:00:09'),
(1026, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:00:36'),
(1027, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:00:37'),
(1028, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:04:21'),
(1029, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:04:30'),
(1030, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:04:32'),
(1031, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:04:33'),
(1032, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:07:06'),
(1033, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:09:46'),
(1034, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:11:42'),
(1035, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:14:34'),
(1036, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:15:50'),
(1037, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:15:59'),
(1038, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:16:31'),
(1039, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-29 18:17:04'),
(1040, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 08:31:51'),
(1041, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 08:33:52'),
(1042, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 09:17:38'),
(1043, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 09:18:38'),
(1044, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 16:28:53'),
(1045, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 16:36:06'),
(1046, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 16:36:38'),
(1047, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 18:21:24'),
(1048, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 19:18:22'),
(1049, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 19:18:30'),
(1050, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 19:18:38'),
(1051, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'eprmt6dm1grtve5k9g8fif2616', '2025-08-30 21:06:31'),
(1052, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:05:47'),
(1053, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:07:25'),
(1054, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:07:51'),
(1055, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:08:01'),
(1056, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:08:31'),
(1057, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:09:11'),
(1058, 2, 'Carls Pamorel', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 14:09:27'),
(1059, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:10:52'),
(1060, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:12:12'),
(1061, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:12:45'),
(1062, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:15:58'),
(1063, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:16:03'),
(1064, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:17:05'),
(1065, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:17:11'),
(1066, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:17:22'),
(1067, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:33:21'),
(1068, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:37:17'),
(1069, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:37:25'),
(1070, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:37:48'),
(1071, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:38:13'),
(1072, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:38:41'),
(1073, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:38:49'),
(1074, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:38:50'),
(1075, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:38:57'),
(1076, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '6ft66ffn4p619v3vhqrpu5vh8p', '2025-08-31 22:49:53'),
(1077, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '6ft66ffn4p619v3vhqrpu5vh8p', '2025-08-31 22:52:00'),
(1078, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '6ft66ffn4p619v3vhqrpu5vh8p', '2025-08-31 22:52:03'),
(1079, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-08-31 22:55:49'),
(1080, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '6ft66ffn4p619v3vhqrpu5vh8p', '2025-09-01 09:07:30'),
(1081, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '6ft66ffn4p619v3vhqrpu5vh8p', '2025-09-01 10:59:44'),
(1082, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '6ft66ffn4p619v3vhqrpu5vh8p', '2025-09-01 10:59:46'),
(1083, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-09-01 11:02:00'),
(1084, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0h4mmpn0m2ourd5fuvtil2mph7', '2025-09-01 11:02:44'),
(1085, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'pa3j0c8cb4lmtmm6v6rli0o4mp', '2025-09-01 11:36:54'),
(1086, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'pa3j0c8cb4lmtmm6v6rli0o4mp', '2025-09-01 12:23:01'),
(1087, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'pa3j0c8cb4lmtmm6v6rli0o4mp', '2025-09-01 12:23:51'),
(1088, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'pa3j0c8cb4lmtmm6v6rli0o4mp', '2025-09-01 15:30:29'),
(1089, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'pa3j0c8cb4lmtmm6v6rli0o4mp', '2025-09-01 19:47:15'),
(1090, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'pa3j0c8cb4lmtmm6v6rli0o4mp', '2025-09-01 19:47:38'),
(1091, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:03:22'),
(1092, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:10:43'),
(1093, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:10:46'),
(1094, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:41:18'),
(1095, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:41:38'),
(1096, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:41:46'),
(1097, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:55:15'),
(1098, 2, 'Carls Pamorel', 'Teacher Evaluation Report', 'Printed report for Teacher: Carl Cabrera - ID: 2', 'faculty_list', 2, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'ad2v9qkfeis95hjtigdgof5p6n', '2025-09-02 01:58:34'),
(1099, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'mfvjih6k85hojt0h3sf78hocqf', '2025-09-02 01:58:57'),
(1100, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 02:05:29'),
(1101, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 02:31:35'),
(1102, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 02:31:36'),
(1103, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 07:48:16'),
(1104, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'ist45a6hc3hb9sccgce4nm9l7m', '2025-09-02 09:35:06'),
(1105, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 10:00:35'),
(1106, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 10:27:04'),
(1107, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 10:39:44'),
(1108, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '5bv8m2gcvhsdeme9f25t7r15vi', '2025-09-02 10:41:59'),
(1109, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:17:59'),
(1110, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:18:14'),
(1111, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:35:34'),
(1112, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:35:38'),
(1113, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:35:39'),
(1114, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:36:00'),
(1115, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:36:06'),
(1116, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:36:06'),
(1117, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:37:23'),
(1118, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:37:58'),
(1119, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:39:52'),
(1120, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:43:08'),
(1121, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:51:38'),
(1122, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:51:40'),
(1123, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:53:46');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(1124, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:53:47'),
(1125, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:53:48'),
(1126, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:53:48'),
(1127, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:53:48'),
(1128, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:54:42'),
(1129, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:55:31'),
(1130, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:55:32'),
(1131, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:55:34'),
(1132, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:58:00'),
(1133, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 16:58:19'),
(1134, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:02:39'),
(1135, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:06'),
(1136, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:26'),
(1137, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:26'),
(1138, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:27'),
(1139, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:27'),
(1140, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:27'),
(1141, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:27'),
(1142, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:27'),
(1143, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:03:33'),
(1144, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:05:25'),
(1145, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:05:32'),
(1146, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:05:38'),
(1147, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:09:26'),
(1148, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:10:25'),
(1149, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:10:27'),
(1150, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:12:35'),
(1151, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:12:37'),
(1152, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:17:54'),
(1153, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:17:56'),
(1154, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:17:57'),
(1155, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:18:19'),
(1156, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:19:05'),
(1157, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:20:53'),
(1158, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:23:19'),
(1159, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:25:11'),
(1160, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:25:13'),
(1161, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:25:54'),
(1162, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:25:54'),
(1163, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 17:27:17'),
(1164, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:04:40'),
(1165, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:04:45'),
(1166, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:08:00'),
(1167, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:08:03'),
(1168, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:44:24'),
(1169, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:44:46'),
(1170, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:44:47'),
(1171, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:44:56'),
(1172, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:45:08'),
(1173, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 20:45:16'),
(1174, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-02 21:12:22'),
(1175, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:01:25'),
(1176, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:04:42'),
(1177, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:05:15'),
(1178, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:05:41'),
(1179, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:05:54'),
(1180, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:07:46'),
(1181, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:10:36'),
(1182, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:11:45'),
(1183, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:13:12'),
(1184, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 11:14:21'),
(1185, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:36:12'),
(1186, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:36:13'),
(1187, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:38:57'),
(1188, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:41:18'),
(1189, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:42:08'),
(1190, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:42:08'),
(1191, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:42:14'),
(1192, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:42:22'),
(1193, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:42:59'),
(1194, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:44:29'),
(1195, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:44:30'),
(1196, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 12:44:30'),
(1197, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 14:18:37'),
(1198, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 14:18:38'),
(1199, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 21:53:11'),
(1200, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-03 21:53:35'),
(1201, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 00:25:44'),
(1202, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 00:25:55'),
(1203, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 00:32:22'),
(1204, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 00:55:30'),
(1205, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 00:56:29'),
(1206, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 00:56:39'),
(1207, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:08:14'),
(1208, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:08:15'),
(1209, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:35:48'),
(1210, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:39:01'),
(1211, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:40:18'),
(1212, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:41:15'),
(1213, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:43:35'),
(1214, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:43:49'),
(1215, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:44:09'),
(1216, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:45:00'),
(1217, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:45:08'),
(1218, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:45:10'),
(1219, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:48:22'),
(1220, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:48:34'),
(1221, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:49:57'),
(1222, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 01:50:24'),
(1223, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 02:07:56'),
(1224, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 10:28:38'),
(1225, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 10:28:44'),
(1226, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 10:44:24'),
(1227, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 13:28:44'),
(1228, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: sdw@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '0r9g4kjkpgvlsmdphi35mle858', '2025-09-04 18:55:33'),
(1229, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 01:10:10'),
(1230, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 03:49:49'),
(1231, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 03:49:57'),
(1232, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 03:50:02'),
(1233, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 03:50:03'),
(1234, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 03:50:04'),
(1235, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 03:50:05'),
(1236, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:22:18'),
(1237, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:22:30'),
(1238, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:22:37'),
(1239, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:24:02'),
(1240, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:28:48'),
(1241, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:29:00'),
(1242, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:29:24'),
(1243, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:29:30'),
(1244, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:29:34'),
(1245, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:29:34'),
(1246, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:29:35'),
(1247, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:56:32'),
(1248, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:56:55'),
(1249, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:57:02'),
(1250, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 04:57:23'),
(1251, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 06:07:43'),
(1252, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 09:08:11'),
(1253, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 09:16:45'),
(1254, 2, 'Carls Pamorel', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 09:19:59'),
(1255, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 09:25:11'),
(1256, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '22ohu52q6d5dlgkrn1qpo7ejj9', '2025-09-05 11:53:59'),
(1257, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-05 19:18:41'),
(1258, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-05 19:28:04'),
(1259, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 08:37:31'),
(1260, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 08:37:46'),
(1261, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 08:38:37'),
(1262, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '0n16gi20mg0or0fvh57019tcct', '2025-09-06 09:29:42'),
(1263, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '0n16gi20mg0or0fvh57019tcct', '2025-09-06 09:29:50'),
(1264, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '0n16gi20mg0or0fvh57019tcct', '2025-09-06 09:29:54'),
(1265, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 09:32:06'),
(1266, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 09:32:14'),
(1267, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 09:33:57'),
(1268, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 09:36:46'),
(1269, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 09:49:59'),
(1270, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:40:30'),
(1271, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:40:44'),
(1272, 2, 'Carls Pamorel', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:41:55'),
(1273, 2, 'Carls Pamorel', 'LOGOUT', 'Admin Carls Pamorel logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:49:23'),
(1274, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:49:36'),
(1275, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: moistgcshs@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:49:59'),
(1276, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:51:04'),
(1277, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:51:26'),
(1278, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:51:39'),
(1279, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:51:49'),
(1280, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:53:01'),
(1281, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:53:24'),
(1282, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 10:59:48'),
(1283, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 11:03:48'),
(1284, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 11:07:32'),
(1285, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 14:55:05'),
(1286, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 14:55:10'),
(1287, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 14:55:18'),
(1288, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 14:56:31'),
(1289, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 14:56:38'),
(1290, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 14:58:25'),
(1291, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '05jjpnbnhso06ruofg3g9nq1sg', '2025-09-06 15:00:14'),
(1292, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-06 21:32:42'),
(1293, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: John Mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 15:58:01'),
(1294, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 15:58:49');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(1295, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 15:59:04'),
(1296, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: John mike Garrido - ID: 5', 'faculty_list', 5, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 16:01:16'),
(1297, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 16:36:46'),
(1298, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 16:36:56'),
(1299, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 19:19:54'),
(1300, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 19:23:47'),
(1301, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 19:24:27'),
(1302, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 19:24:34'),
(1303, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 19:27:28'),
(1304, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 19:28:23'),
(1305, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 20:22:18'),
(1306, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Denso Diosdado - ID: 3', 'faculty_list', 3, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:00:01'),
(1307, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:00:20'),
(1308, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:00:42'),
(1309, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:02:10'),
(1310, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:02:23'),
(1311, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:03:32'),
(1312, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:04:38'),
(1313, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:04:56'),
(1314, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:31:11'),
(1315, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:35:55'),
(1316, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:41:05'),
(1317, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:44:21'),
(1318, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 21:56:47'),
(1319, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 22:02:37'),
(1320, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-07 23:40:39'),
(1321, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-08 00:47:47'),
(1322, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-08 01:00:56'),
(1323, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-08 01:28:16'),
(1324, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-08 01:34:10'),
(1325, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '4lgo42fduvqrcnnhm6273rjsuu', '2025-09-08 07:38:25'),
(1326, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 13:41:58'),
(1327, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 13:44:08'),
(1328, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 14:09:09'),
(1329, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 14:14:48'),
(1330, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 14:28:08'),
(1331, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 15:52:30'),
(1332, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 15:52:52'),
(1333, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 15:53:57'),
(1334, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 15:59:01'),
(1335, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 21:54:13'),
(1336, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 21:56:41'),
(1337, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 21:57:00'),
(1338, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 21:57:50'),
(1339, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:01:34'),
(1340, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:07:42'),
(1341, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:07:58'),
(1342, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:08:50'),
(1343, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:13:41'),
(1344, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:15:11'),
(1345, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:15:29'),
(1346, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 22:16:24'),
(1347, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-08 23:20:49'),
(1348, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 00:08:11'),
(1349, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 08:21:13'),
(1350, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:22:03'),
(1351, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:22:07'),
(1352, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:28:41'),
(1353, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:29:17'),
(1354, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:30:07'),
(1355, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:32:46'),
(1356, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:52:28'),
(1357, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:55:03'),
(1358, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 09:55:36'),
(1359, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:04:23'),
(1360, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:04:39'),
(1361, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:04:41'),
(1362, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:04:41'),
(1363, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:04:42'),
(1364, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:05:05'),
(1365, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:05:06'),
(1366, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:05:07'),
(1367, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:05:07'),
(1368, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:05:13'),
(1369, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 10:05:31'),
(1370, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 13:45:38'),
(1371, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 13:46:10'),
(1372, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 15:11:11'),
(1373, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 15:11:39'),
(1374, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 15:46:53'),
(1375, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 15:49:47'),
(1376, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 15:51:44'),
(1377, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 16:01:47'),
(1378, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 16:02:25'),
(1379, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 16:03:16'),
(1380, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 16:18:38'),
(1381, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nuqsb190chgkkp0c8btm989efj', '2025-09-09 16:19:50'),
(1382, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nr6jr0p09oan6en410roptsoah', '2025-09-15 18:12:45'),
(1383, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nr6jr0p09oan6en410roptsoah', '2025-09-15 18:13:27'),
(1384, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nr6jr0p09oan6en410roptsoah', '2025-09-15 18:14:01'),
(1385, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nr6jr0p09oan6en410roptsoah', '2025-09-15 18:23:11'),
(1386, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'nr6jr0p09oan6en410roptsoah', '2025-09-15 18:24:54'),
(1387, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 19:56:40'),
(1388, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 19:56:41'),
(1389, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 19:56:42'),
(1390, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 19:56:42'),
(1391, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 19:56:49'),
(1392, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 19:56:56'),
(1393, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:16:10'),
(1394, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:16:10'),
(1395, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:17:52'),
(1396, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:18:26'),
(1397, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:18:31'),
(1398, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:31:12'),
(1399, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:46:32'),
(1400, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:46:34'),
(1401, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:46:39'),
(1402, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:46:49'),
(1403, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'j4kmqtlpg4e7gcnit5r57easa2', '2025-09-19 20:47:09'),
(1404, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 11:46:13'),
(1405, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 12:10:30'),
(1406, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 12:30:31'),
(1407, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 12:30:35'),
(1408, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 12:34:14'),
(1409, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 12:40:36'),
(1410, 2, 'Guidance Evaluation', 'Teacher Evaluation Report - Printed', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '06qdmcd7bq4fb44iqkj09rqoni', '2025-10-13 12:41:09'),
(1411, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: fernans@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-17 21:23:36'),
(1412, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-17 21:24:20'),
(1413, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-17 21:28:05'),
(1414, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-17 21:28:55'),
(1415, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-17 21:28:57'),
(1416, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:18'),
(1417, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:20'),
(1418, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:20'),
(1419, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: George Wilson - ID: 1', 'faculty_list', 1, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:20'),
(1420, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:24'),
(1421, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:39'),
(1422, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:39'),
(1423, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:39'),
(1424, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:39'),
(1425, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:43'),
(1426, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:46'),
(1427, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:46'),
(1428, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:47'),
(1429, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Ryan Jim Bachinela - ID: 10', 'faculty_list', 10, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:52:47'),
(1430, 2, 'Guidance Evaluation', 'LOGOUT', 'Admin Guidance Evaluation logged out', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '03k8tbgsqol8q22le7m0755rdh', '2025-10-18 01:53:04'),
(1431, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'jinpdvaursvna983eq5gpofikl', '2025-10-18 18:19:38'),
(1432, 0, 'Unknown', 'LOGIN_FAILED', 'Failed login attempt for email: evalfaculty@gmail.com. Error: Invalid credentials', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'jinpdvaursvna983eq5gpofikl', '2025-10-18 18:19:46'),
(1433, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'jinpdvaursvna983eq5gpofikl', '2025-10-18 18:21:30'),
(1434, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'jinpdvaursvna983eq5gpofikl', '2025-10-18 18:32:15'),
(1435, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '1r6qcbt766592jaesb7s4nj021', '2025-10-21 19:43:51'),
(1436, 2, 'Guidance Evaluation', 'LOGIN_SUCCESS', 'Admin logged in successfully with email: evalfaculty@gmail.com', NULL, NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-24 21:53:26'),
(1437, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 05:49:50'),
(1438, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 05:49:59'),
(1439, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 05:50:55'),
(1440, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 05:50:56'),
(1441, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:26:28'),
(1442, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:27:46'),
(1443, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:28:17'),
(1444, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:29:29'),
(1445, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:29:36'),
(1446, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:52'),
(1447, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:53'),
(1448, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:53'),
(1449, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:53'),
(1450, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:53'),
(1451, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:56'),
(1452, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:30:59'),
(1453, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:11'),
(1454, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:36'),
(1455, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:36');
INSERT INTO `admin_history_logs` (`id`, `admin_id`, `admin_name`, `action_type`, `action_description`, `target_table`, `target_id`, `old_values`, `new_values`, `ip_address`, `user_agent`, `session_id`, `timestamp`) VALUES
(1456, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:36'),
(1457, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:56'),
(1458, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:57'),
(1459, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:31:57'),
(1460, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:37:53'),
(1461, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:46:40'),
(1462, 2, 'Guidance Evaluation', 'DATA_ACCESS', 'Accessed Faculty List page', 'faculty_list', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:53:18'),
(1463, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Mary Con   Cugyugan - ID: 11', 'faculty_list', 11, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:54:46'),
(1464, 2, 'Guidance Evaluation', 'Teacher Evaluation Report', 'Printed report for Teacher: Mary Con   Cugyugan - ID: 11', 'faculty_list', 11, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'efjsidcv5v7lk4b9fd3okoto37', '2025-10-25 06:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(11) NOT NULL,
  `academic_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `type` enum('deadline','holiday','event') DEFAULT 'event',
  `color` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `academic_id`, `title`, `event_date`, `type`, `color`, `created_at`) VALUES
(1, NULL, 'School Holiday', '2025-09-23', 'holiday', NULL, '2025-09-09 09:46:45'),
(2, 1, 'Evaluation Starts', '2025-09-10', 'event', '#34d399', '2025-09-09 09:46:45'),
(3, 1, 'Evaluation Deadline', '2025-09-30', 'deadline', NULL, '2025-09-09 09:46:45'),
(4, 5, 'Evaluation Starts', '2025-09-01', 'event', NULL, '2025-09-09 09:50:24'),
(5, 5, 'Mid-cycle Reminder', '2025-09-15', 'event', NULL, '2025-09-09 09:50:24'),
(6, 5, 'Evaluation Deadline', '2025-09-30', 'deadline', NULL, '2025-09-09 09:50:24'),
(7, 5, 'Evaluation Starts', '2025-10-01', 'event', NULL, '2025-10-13 11:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `id` int(30) NOT NULL,
  `curriculum` text NOT NULL,
  `level` text NOT NULL,
  `section` text NOT NULL,
  `adviser_faculty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_list`
--

INSERT INTO `class_list` (`id`, `curriculum`, `level`, `section`, `adviser_faculty_id`) VALUES
(4, 'Grade', '8', 'DIAMOND', 5),
(5, 'Grade', '7', 'SAPHIRE', 3),
(6, 'Grade', '10', 'DIAMOND', 0),
(7, 'Grade', '10', 'CARNELIAN', 0),
(8, 'grade', '10', 'TURQUIOSE', 0),
(9, 'Grade', '10', 'GOLD', 0),
(10, 'Grade', '9', 'RUBY', 0),
(11, 'Grade', '9', 'JASPER', 0),
(12, 'Grade', '9', 'JADE', 0),
(13, 'Grade', '9', 'EMERALD', 0),
(14, 'Grade', '8', 'EMERALD', 0),
(15, 'Grade', '8', 'QUARTZ', 0),
(16, 'Grade', '8', 'AMETHYST', 0),
(17, 'Grade', '8', 'AQUAMARINE', 0),
(18, 'Grade', '7', 'GRANITE', 0),
(19, 'Grade', '7', 'PEARL', 0),
(20, 'Grade', '7', 'GARNET', 6),
(22, 'SHS', '11', 'TVL-COOKERY-SIMPLICITY', 11);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_list`
--

CREATE TABLE `criteria_list` (
  `id` int(30) NOT NULL,
  `criteria` text NOT NULL,
  `order_by` int(30) NOT NULL,
  `weight` decimal(4,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_list`
--

INSERT INTO `criteria_list` (`id`, `criteria`, `order_by`, `weight`) VALUES
(1, 'Teaching Performance', 0, 0.50),
(2, 'Personal and Related Teaching Qualities', 1, 0.30),
(4, 'School and community Service', 2, 0.20);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_answers`
--

CREATE TABLE `evaluation_answers` (
  `evaluation_id` int(30) NOT NULL,
  `question_id` int(30) NOT NULL,
  `rate` int(20) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_answers`
--

INSERT INTO `evaluation_answers` (`evaluation_id`, `question_id`, `rate`, `comment`) VALUES
(1, 1, 5, NULL),
(1, 6, 4, NULL),
(1, 3, 5, NULL),
(2, 1, 5, NULL),
(2, 6, 5, NULL),
(2, 3, 4, NULL),
(3, 1, 5, NULL),
(3, 6, 5, NULL),
(3, 3, 4, NULL),
(4, 1, 5, NULL),
(4, 6, 5, NULL),
(4, 3, 5, NULL),
(5, 1, 5, NULL),
(5, 6, 5, NULL),
(5, 3, 5, NULL),
(6, 1, 5, NULL),
(6, 6, 5, NULL),
(6, 7, 5, NULL),
(6, 3, 5, NULL),
(8, 1, 1, NULL),
(8, 6, 1, NULL),
(8, 7, 1, NULL),
(8, 8, 1, NULL),
(8, 9, 1, NULL),
(8, 3, 1, NULL),
(9, 1, 1, NULL),
(9, 6, 1, NULL),
(9, 7, 1, NULL),
(9, 8, 1, NULL),
(9, 9, 1, NULL),
(9, 3, 1, NULL),
(10, 1, 1, NULL),
(10, 6, 1, NULL),
(10, 7, 1, NULL),
(10, 8, 1, NULL),
(10, 9, 1, NULL),
(10, 3, 1, NULL),
(10, 10, 1, NULL),
(11, 1, 1, NULL),
(11, 6, 1, NULL),
(11, 7, 1, NULL),
(11, 8, 1, NULL),
(11, 9, 1, NULL),
(11, 11, 1, NULL),
(11, 3, 1, NULL),
(11, 10, 1, NULL),
(12, 1, 2, NULL),
(12, 6, 2, NULL),
(12, 7, 2, NULL),
(12, 8, 2, NULL),
(12, 9, 2, NULL),
(12, 11, 2, NULL),
(12, 3, 2, NULL),
(12, 10, 2, NULL),
(12, 12, 2, NULL),
(13, 1, 5, NULL),
(13, 6, 5, NULL),
(13, 7, 5, NULL),
(13, 8, 5, NULL),
(13, 9, 5, NULL),
(13, 11, 5, NULL),
(13, 3, 5, NULL),
(13, 10, 5, NULL),
(13, 12, 5, NULL),
(13, 13, 5, NULL),
(14, 1, 1, NULL),
(14, 6, 1, NULL),
(14, 7, 1, NULL),
(14, 8, 1, NULL),
(14, 9, 1, NULL),
(14, 11, 1, NULL),
(14, 3, 1, NULL),
(14, 10, 1, NULL),
(14, 12, 1, NULL),
(14, 13, 1, NULL),
(15, 1, 1, NULL),
(15, 6, 1, NULL),
(15, 7, 1, NULL),
(15, 8, 1, NULL),
(15, 9, 1, NULL),
(15, 11, 1, NULL),
(15, 3, 1, NULL),
(15, 10, 1, NULL),
(15, 12, 1, NULL),
(15, 13, 1, NULL),
(17, 1, 5, NULL),
(17, 6, 1, NULL),
(17, 7, 1, NULL),
(17, 8, 1, NULL),
(17, 9, 2, NULL),
(17, 11, 2, NULL),
(17, 14, 2, NULL),
(17, 3, 2, NULL),
(17, 10, 2, NULL),
(17, 12, 2, NULL),
(17, 13, 5, NULL),
(18, 1, 5, NULL),
(18, 6, 5, NULL),
(18, 7, 5, NULL),
(18, 8, 5, NULL),
(18, 9, 5, NULL),
(18, 11, 5, NULL),
(18, 14, 5, NULL),
(18, 3, 5, NULL),
(18, 10, 5, NULL),
(18, 12, 5, NULL),
(18, 13, 5, NULL),
(20, 1, 5, NULL),
(20, 2, 5, NULL),
(20, 3, 2, NULL),
(20, 4, 3, NULL),
(20, 5, 1, NULL),
(20, 6, 1, NULL),
(20, 7, 1, NULL),
(20, 8, 1, NULL),
(20, 9, 2, NULL),
(20, 10, 3, NULL),
(20, 11, 2, NULL),
(20, 12, 3, NULL),
(20, 13, 2, NULL),
(20, 14, 3, NULL),
(20, 15, 2, NULL),
(20, 16, 3, NULL),
(20, 25, 2, NULL),
(21, 1, 5, NULL),
(21, 2, 5, NULL),
(21, 3, 5, NULL),
(21, 4, 5, NULL),
(21, 5, 5, NULL),
(21, 6, 5, NULL),
(21, 7, 5, NULL),
(21, 8, 5, NULL),
(21, 9, 5, NULL),
(21, 10, 5, NULL),
(21, 11, 5, NULL),
(21, 12, 5, NULL),
(21, 13, 5, NULL),
(21, 14, 5, NULL),
(21, 15, 5, NULL),
(21, 16, 5, NULL),
(21, 25, 5, NULL),
(22, 1, 4, NULL),
(22, 2, 4, NULL),
(22, 3, 4, NULL),
(22, 4, 3, NULL),
(22, 5, 3, NULL),
(22, 6, 2, NULL),
(22, 7, 2, NULL),
(22, 8, 2, NULL),
(22, 9, 2, NULL),
(22, 10, 1, NULL),
(22, 11, 1, NULL),
(22, 12, 1, NULL),
(22, 13, 1, NULL),
(22, 14, 1, NULL),
(22, 15, 2, NULL),
(22, 16, 4, NULL),
(22, 25, 1, NULL),
(23, 1, 1, NULL),
(23, 2, 2, NULL),
(23, 3, 3, NULL),
(23, 4, 3, NULL),
(23, 5, 3, NULL),
(23, 6, 3, NULL),
(23, 7, 3, NULL),
(23, 8, 3, NULL),
(23, 9, 3, NULL),
(23, 10, 4, NULL),
(23, 11, 5, NULL),
(23, 12, 5, NULL),
(23, 13, 5, NULL),
(23, 14, 5, NULL),
(23, 15, 5, NULL),
(23, 16, 5, NULL),
(23, 25, 5, NULL),
(24, 1, 5, NULL),
(24, 2, 5, NULL),
(24, 3, 5, NULL),
(24, 4, 5, NULL),
(24, 5, 5, NULL),
(24, 6, 5, NULL),
(24, 7, 5, NULL),
(24, 8, 5, NULL),
(24, 9, 5, NULL),
(24, 10, 4, NULL),
(24, 11, 4, NULL),
(24, 12, 4, NULL),
(24, 13, 4, NULL),
(24, 14, 4, NULL),
(24, 15, 4, NULL),
(24, 16, 4, NULL),
(24, 25, 1, NULL),
(25, 1, 1, NULL),
(25, 2, 1, NULL),
(25, 3, 1, NULL),
(25, 4, 1, NULL),
(25, 5, 1, NULL),
(25, 6, 1, NULL),
(25, 7, 1, NULL),
(25, 8, 1, NULL),
(25, 9, 1, NULL),
(25, 10, 1, NULL),
(25, 11, 1, NULL),
(25, 12, 1, NULL),
(25, 13, 1, NULL),
(25, 14, 1, NULL),
(25, 15, 1, NULL),
(25, 16, 1, NULL),
(25, 25, 1, NULL),
(27, 26, 5, NULL),
(27, 27, 4, NULL),
(27, 28, 5, NULL),
(27, 29, 5, NULL),
(27, 30, 5, NULL),
(27, 31, 5, NULL),
(27, 32, 5, NULL),
(27, 33, 5, NULL),
(27, 34, 5, NULL),
(27, 35, 5, NULL),
(27, 36, 5, NULL),
(27, 37, 5, NULL),
(27, 38, 4, NULL),
(27, 39, 5, NULL),
(27, 40, 5, NULL),
(27, 41, 4, NULL),
(27, 42, 5, NULL),
(27, 43, 5, NULL),
(27, 44, 4, NULL),
(27, 45, 4, NULL),
(28, 26, 1, NULL),
(28, 27, 1, NULL),
(28, 28, 1, NULL),
(28, 29, 1, NULL),
(28, 30, 1, NULL),
(28, 31, 1, NULL),
(28, 32, 1, NULL),
(28, 33, 1, NULL),
(28, 34, 1, NULL),
(28, 35, 1, NULL),
(28, 36, 1, NULL),
(28, 37, 1, NULL),
(28, 38, 1, NULL),
(28, 39, 1, NULL),
(28, 40, 1, NULL),
(28, 41, 1, NULL),
(28, 42, 1, NULL),
(28, 43, 1, NULL),
(28, 44, 1, NULL),
(28, 45, 1, NULL),
(29, 26, 1, NULL),
(29, 27, 1, NULL),
(29, 28, 1, NULL),
(29, 29, 1, NULL),
(29, 30, 1, NULL),
(29, 31, 1, NULL),
(29, 32, 1, NULL),
(29, 33, 1, NULL),
(29, 34, 1, NULL),
(29, 35, 1, NULL),
(29, 36, 1, NULL),
(29, 37, 1, NULL),
(29, 38, 1, NULL),
(29, 39, 1, NULL),
(29, 40, 1, NULL),
(29, 41, 1, NULL),
(29, 42, 1, NULL),
(29, 43, 1, NULL),
(29, 44, 1, NULL),
(29, 45, 1, NULL),
(31, 26, 1, NULL),
(31, 27, 2, NULL),
(31, 28, 1, NULL),
(31, 29, 2, NULL),
(31, 30, 1, NULL),
(31, 31, 2, NULL),
(31, 32, 1, NULL),
(31, 33, 2, NULL),
(31, 34, 1, NULL),
(31, 35, 2, NULL),
(31, 36, 1, NULL),
(31, 37, 2, NULL),
(31, 38, 1, NULL),
(31, 39, 2, NULL),
(31, 40, 1, NULL),
(31, 41, 2, NULL),
(31, 42, 1, NULL),
(31, 43, 2, NULL),
(31, 44, 1, NULL),
(31, 45, 2, NULL),
(33, 26, 1, NULL),
(33, 27, 1, NULL),
(33, 28, 1, NULL),
(33, 29, 1, NULL),
(33, 30, 1, NULL),
(33, 31, 1, NULL),
(33, 32, 1, NULL),
(33, 33, 1, NULL),
(33, 34, 1, NULL),
(33, 35, 1, NULL),
(33, 36, 1, NULL),
(33, 37, 1, NULL),
(33, 38, 1, NULL),
(33, 39, 1, NULL),
(33, 40, 1, NULL),
(33, 41, 1, NULL),
(33, 42, 1, NULL),
(33, 43, 1, NULL),
(33, 44, 1, NULL),
(33, 45, 1, NULL),
(34, 26, 2, NULL),
(34, 27, 1, NULL),
(34, 28, 2, NULL),
(34, 29, 2, NULL),
(34, 30, 2, NULL),
(34, 31, 3, NULL),
(34, 32, 3, NULL),
(34, 33, 3, NULL),
(34, 34, 3, NULL),
(34, 35, 3, NULL),
(34, 36, 2, NULL),
(34, 37, 2, NULL),
(34, 38, 2, NULL),
(34, 39, 2, NULL),
(34, 40, 2, NULL),
(34, 41, 2, NULL),
(34, 42, 3, NULL),
(34, 43, 3, NULL),
(34, 44, 3, NULL),
(34, 45, 3, NULL),
(35, 26, 5, NULL),
(35, 27, 5, NULL),
(35, 28, 5, NULL),
(35, 29, 5, NULL),
(35, 30, 5, NULL),
(35, 31, 5, NULL),
(35, 32, 5, NULL),
(35, 33, 5, NULL),
(35, 34, 5, NULL),
(35, 35, 5, NULL),
(35, 36, 5, NULL),
(35, 37, 5, NULL),
(35, 38, 5, NULL),
(35, 39, 5, NULL),
(35, 40, 5, NULL),
(35, 41, 5, NULL),
(35, 42, 5, NULL),
(35, 43, 5, NULL),
(35, 44, 5, NULL),
(35, 45, 5, NULL),
(36, 26, 1, NULL),
(36, 27, 2, NULL),
(36, 28, 3, NULL),
(36, 29, 4, NULL),
(36, 30, 5, NULL),
(36, 31, 4, NULL),
(36, 32, 3, NULL),
(36, 33, 2, NULL),
(36, 34, 1, NULL),
(36, 35, 5, NULL),
(36, 36, 4, NULL),
(36, 37, 3, NULL),
(36, 38, 2, NULL),
(36, 39, 1, NULL),
(36, 40, 2, NULL),
(36, 41, 3, NULL),
(36, 42, 1, NULL),
(36, 43, 5, NULL),
(36, 44, 2, NULL),
(36, 45, 1, NULL),
(37, 26, 2, NULL),
(37, 27, 2, NULL),
(37, 28, 2, NULL),
(37, 29, 2, NULL),
(37, 30, 2, NULL),
(37, 31, 2, NULL),
(37, 32, 2, NULL),
(37, 33, 2, NULL),
(37, 34, 2, NULL),
(37, 35, 1, NULL),
(37, 36, 1, NULL),
(37, 37, 1, NULL),
(37, 38, 1, NULL),
(37, 39, 1, NULL),
(37, 40, 1, NULL),
(37, 41, 1, NULL),
(37, 42, 1, NULL),
(37, 43, 1, NULL),
(37, 44, 1, NULL),
(37, 45, 1, NULL),
(38, 26, 3, NULL),
(38, 27, 3, NULL),
(38, 28, 3, NULL),
(38, 29, 3, NULL),
(38, 30, 3, NULL),
(38, 31, 3, NULL),
(38, 32, 3, NULL),
(38, 33, 3, NULL),
(38, 34, 3, NULL),
(38, 35, 3, NULL),
(38, 36, 3, NULL),
(38, 37, 3, NULL),
(38, 38, 3, NULL),
(38, 39, 3, NULL),
(38, 40, 3, NULL),
(38, 41, 3, NULL),
(38, 42, 3, NULL),
(38, 43, 3, NULL),
(38, 44, 3, NULL),
(38, 45, 3, NULL),
(39, 46, 2, NULL),
(39, 47, 2, NULL),
(39, 48, 2, NULL),
(39, 49, 2, NULL),
(39, 50, 2, NULL),
(39, 51, 2, NULL),
(39, 52, 2, NULL),
(39, 53, 2, NULL),
(39, 54, 2, NULL),
(39, 55, 3, NULL),
(39, 56, 3, NULL),
(39, 57, 3, NULL),
(39, 58, 3, NULL),
(39, 59, 3, NULL),
(39, 60, 3, NULL),
(39, 61, 3, NULL),
(39, 62, 5, NULL),
(39, 63, 4, NULL),
(39, 64, 3, NULL),
(39, 65, 2, NULL),
(40, 46, 4, NULL),
(40, 47, 4, NULL),
(40, 48, 3, NULL),
(40, 49, 4, NULL),
(40, 50, 2, NULL),
(40, 51, 3, NULL),
(40, 52, 3, NULL),
(40, 53, 2, NULL),
(40, 54, 3, NULL),
(40, 55, 4, NULL),
(40, 56, 4, NULL),
(40, 57, 4, NULL),
(40, 58, 4, NULL),
(40, 59, 4, NULL),
(40, 60, 4, NULL),
(40, 61, 3, NULL),
(40, 62, 5, NULL),
(40, 63, 5, NULL),
(40, 64, 5, NULL),
(40, 65, 5, NULL),
(41, 46, 1, NULL),
(41, 47, 1, NULL),
(41, 48, 1, NULL),
(41, 49, 1, NULL),
(41, 50, 1, NULL),
(41, 51, 1, NULL),
(41, 52, 1, NULL),
(41, 53, 1, NULL),
(41, 54, 1, NULL),
(41, 55, 1, NULL),
(41, 56, 1, NULL),
(41, 57, 1, NULL),
(41, 58, 1, NULL),
(41, 59, 1, NULL),
(41, 60, 1, NULL),
(41, 61, 1, NULL),
(41, 62, 1, NULL),
(41, 63, 1, NULL),
(41, 64, 1, NULL),
(41, 65, 1, NULL),
(42, 46, 2, NULL),
(42, 47, 2, NULL),
(42, 48, 3, NULL),
(42, 49, 2, NULL),
(42, 50, 4, NULL),
(42, 51, 4, NULL),
(42, 52, 4, NULL),
(42, 53, 4, NULL),
(42, 54, 4, NULL),
(42, 55, 1, NULL),
(42, 56, 2, NULL),
(42, 57, 3, NULL),
(42, 58, 2, NULL),
(42, 59, 1, NULL),
(42, 60, 1, NULL),
(42, 61, 1, NULL),
(42, 62, 2, NULL),
(42, 63, 2, NULL),
(42, 64, 2, NULL),
(42, 65, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_list`
--

CREATE TABLE `evaluation_list` (
  `evaluation_id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `restriction_id` int(30) NOT NULL,
  `date_taken` datetime NOT NULL DEFAULT current_timestamp(),
  `strengths_comment` text DEFAULT NULL,
  `improvement_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_list`
--

INSERT INTO `evaluation_list` (`evaluation_id`, `academic_id`, `class_id`, `student_id`, `subject_id`, `faculty_id`, `restriction_id`, `date_taken`, `strengths_comment`, `improvement_comment`) VALUES
(1, 3, 1, 1, 1, 1, 8, '2020-12-15 16:26:51', NULL, NULL),
(2, 3, 2, 2, 2, 1, 9, '2020-12-15 16:33:37', NULL, NULL),
(3, 3, 1, 3, 1, 1, 8, '2020-12-15 20:18:49', NULL, NULL),
(4, 3, 1, 4, 1, 1, 8, '2025-08-08 18:27:51', NULL, NULL),
(5, 3, 1, 4, 1, 2, 11, '2025-08-08 19:07:18', NULL, NULL),
(6, 3, 1, 4, 1, 2, 12, '2025-08-08 21:42:49', NULL, NULL),
(7, 3, 1, 4, 5, 2, 13, '2025-08-08 22:04:58', NULL, NULL),
(8, 3, 1, 10, 4, 2, 15, '2025-08-11 15:31:45', NULL, NULL),
(9, 3, 1, 10, 1, 2, 13, '2025-08-11 15:32:24', NULL, NULL),
(10, 3, 1, 10, 2, 2, 16, '2025-08-11 15:34:21', NULL, NULL),
(11, 3, 1, 10, 3, 2, 17, '2025-08-11 15:39:04', NULL, NULL),
(12, 3, 1, 10, 5, 2, 18, '2025-08-11 15:53:43', NULL, NULL),
(13, 3, 1, 9, 5, 2, 19, '2025-08-11 17:16:51', NULL, NULL),
(14, 3, 1, 9, 1, 2, 18, '2025-08-11 17:19:43', NULL, NULL),
(15, 3, 1, 9, 6, 2, 20, '2025-08-11 17:37:33', NULL, NULL),
(17, 3, 1, 9, 2, 2, 21, '2025-08-16 10:17:00', NULL, NULL),
(18, 3, 1, 9, 2, 4, 22, '2025-08-16 17:03:13', NULL, NULL),
(20, 3, 1, 9, 6, 1, 24, '2025-08-16 23:42:57', NULL, NULL),
(21, 3, 1, 8, 6, 1, 24, '2025-08-16 23:46:08', NULL, NULL),
(22, 3, 1, 8, 2, 2, 25, '2025-08-16 23:56:21', NULL, NULL),
(23, 3, 1, 8, 3, 2, 26, '2025-08-17 13:58:01', NULL, NULL),
(24, 3, 1, 8, 5, 2, 27, '2025-08-17 15:21:01', NULL, NULL),
(25, 3, 1, 10, 5, 2, 28, '2025-08-17 17:23:18', NULL, NULL),
(27, 4, 4, 14, 4, 5, 29, '2025-08-20 11:36:53', NULL, NULL),
(28, 4, 1, 9, 5, 5, 31, '2025-08-20 16:44:23', 'Oo dili kaayo', 'walawala'),
(29, 4, 1, 10, 5, 5, 31, '2025-08-20 17:10:27', 'OO', 'adwadsdwa'),
(31, 4, 4, 8, 2, 3, 32, '2025-08-20 18:51:10', 'ug ako nalang diay', 'ngano man dili ako?'),
(32, 4, 4, 8, 4, 5, 30, '2025-08-20 21:34:05', NULL, NULL),
(33, 4, 4, 8, 4, 5, 29, '2025-08-21 08:16:50', 'Goodmorning dihaa maam', 'mayng buntag maam'),
(34, 4, 4, 9, 4, 5, 29, '2025-08-23 08:06:30', 'wala ko kabalo', 'unsaon nalang hapit na september'),
(35, 4, 4, 10, 4, 5, 29, '2025-08-23 09:44:44', NULL, NULL),
(36, 4, 4, 9, 4, 5, 30, '2025-08-29 08:51:51', 'i dont like her', 'wala'),
(37, 4, 7, 10, 20, 10, 38, '2025-09-07 20:59:44', 'George wata kabalo', 'George wata kabalo diha'),
(38, 4, 7, 10, 28, 10, 39, '2025-09-08 00:06:46', 'ambot nimo diha', 'George watakabalo'),
(39, 5, 7, 10, 20, 10, 44, '2025-09-08 01:33:46', 'ywa nabugnkag ang system', 'grabe ka malas'),
(40, 5, 7, 10, 28, 10, 45, '2025-09-08 14:35:20', NULL, NULL),
(41, 5, 7, 10, 20, 10, 47, '2025-09-09 00:07:51', 'sometimes', 'Be humble'),
(42, 5, 7, 10, 28, 10, 48, '2025-09-09 16:00:45', 'TEACHES US WELL', 'TEACHING SKILL');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_class_assignments`
--

CREATE TABLE `faculty_class_assignments` (
  `id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_class_assignments`
--

INSERT INTO `faculty_class_assignments` (`id`, `faculty_id`, `class_id`, `subject_id`, `date_created`) VALUES
(1, 10, 7, 20, '2025-09-07 19:53:28'),
(2, 10, 7, 28, '2025-09-07 20:17:04'),
(4, 10, 4, 34, '2025-09-08 01:28:42'),
(5, 10, 7, 36, '2025-09-09 00:05:46'),
(6, 5, 9, 12, '2025-09-09 15:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_list`
--

CREATE TABLE `faculty_list` (
  `id` int(30) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `role` enum('Subject Teacher','Adviser','Both') DEFAULT 'Subject Teacher',
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_list`
--

INSERT INTO `faculty_list` (`id`, `school_id`, `firstname`, `lastname`, `gender`, `role`, `email`, `password`, `avatar`, `date_created`) VALUES
(1, '20140623', 'George', 'Wilson', 'Male', 'Subject Teacher', 'gwilson@sample.com', 'd40242fb23c45206fadee4e2418f274f', '1608011100_avatar.jpg', '2020-12-15 13:45:18'),
(2, 'T-MOIST-2025-001', 'Carl', 'Cabrera', 'Male', 'Adviser', 'carlcabrera090@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'no-image-available.png', '2025-08-05 11:39:47'),
(3, 'T-MOIST-2025-002', 'Denso', 'Diosdado', 'Male', 'Subject Teacher', 'denso1@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', 'no-image-available.png', '2025-08-08 21:04:18'),
(5, 'T-2025-01', 'John mike', 'Garrido', 'Male', 'Subject Teacher', 'johnmike@gmail.com', '71b3b26aaa319e0cdf6fdb8429c112b0', 'no-image-available.png', '2025-08-20 09:20:45'),
(6, 'T-MOIST-2025-003', 'Edna', 'Mulo', 'Male', 'Adviser', 'ednamulo20@gmail.com', '55e06bc7defd13211cff0ae50ff1f0c7', 'no-image-available.png', '2025-09-03 11:04:40'),
(8, '4', 'Trixie Rose', 'Ajan', 'Male', 'Subject Teacher', 'ajan@gmail.com', '7d055a0d2791d1313454f923356ef122', 'no-image-available.png', '2025-09-03 11:10:35'),
(10, 'T-MOIST-2025-0010', 'Ryan Jim', 'Bachinela', 'Male', 'Subject Teacher', 'ryan@gmail.com', '66931728b7451f7d13ec2a04a237050a', 'no-image-available.png', '2025-09-03 11:13:11'),
(11, 'TECH-20423', 'Mary Con ', ' Cugyugan', 'Female', 'Both', 'marycon@gmail.com', '', 'no-image-available.png', '2025-10-25 06:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_history`
--

CREATE TABLE `password_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_history`
--

INSERT INTO `password_history` (`id`, `user_id`, `password_hash`, `created_at`) VALUES
(3, 2, '$2y$10$ULi9Hf2.QgDx48ZhCzxiLc.LkOoOzZi3Mn6LkOoOzZi3Mn6LkOoOzZ', '2025-09-01 11:16:12'),
(4, 2, '$2y$10$/nw2Od.g2a7rjZqYZ7NtZ.3VjyAJpFGoTENlGbYvxqF39qqcBkq4K', '2025-09-15 12:24:45'),
(5, 2, '$2y$10$tPM1fD0wZZK7ptJbOQHblOH6OEg6lXSTBdsxaPvSvVRsL3Sffowam', '2025-09-19 14:47:36'),
(6, 2, '$2y$10$KGhtLj7Qqolhq8n5rbZmw.1JbTv0O6FwiE41msJJp1e9aHKoJCtJC', '2025-10-13 05:46:03'),
(7, 2, '$2y$10$1hekFO2SZc2yR4nKcx9.Au.i5MB7Epzf.6k.3e5GaMilGlxnaa94S', '2025-10-17 15:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_attempts`
--

CREATE TABLE `password_reset_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `attempt_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_attempts`
--

INSERT INTO `password_reset_attempts` (`id`, `ip_address`, `email`, `attempt_time`) VALUES
(34, '::1', 'evalfaculty@gmail.com', '2025-09-08 07:42:14'),
(35, '::1', 'evalfaculty@gmail.com', '2025-09-09 03:31:41'),
(36, '::1', 'evalfaculty@gmail.com', '2025-09-15 12:23:19'),
(37, '::1', 'evalfaculty@gmail.com', '2025-09-19 14:47:15'),
(38, '::1', 'evalfaculty@gmail.com', '2025-10-13 05:45:34'),
(39, '::1', 'evalfaculty@gmail.com', '2025-10-17 15:23:43'),
(40, '::1', 'evalfaculty@gmail.com', '2025-10-18 12:19:52'),
(41, '::1', 'evalfaculty@gmail.com', '2025-10-18 12:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `question_list`
--

CREATE TABLE `question_list` (
  `id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `question` text NOT NULL,
  `order_by` int(30) NOT NULL,
  `criteria_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_list`
--

INSERT INTO `question_list` (`id`, `academic_id`, `question`, `order_by`, `criteria_id`) VALUES
(1, 3, 'Prepares, Organize and presents lesson well', 0, 1),
(2, 3, 'Explain the subject matter clearly', 1, 1),
(3, 3, 'Relate the subject matter to other fields', 2, 1),
(4, 3, 'Uses English language as the medium of instruction', 3, 1),
(5, 3, 'Motivates and arouses student\'s interest', 4, 1),
(6, 3, 'Answers the questions raised by the students', 5, 1),
(7, 3, 'Gives clear and purposeful assignment', 6, 1),
(8, 3, 'Uses visual aids and illustrations in his/her discussion', 7, 1),
(9, 3, 'Integrates values in his/her lessons', 8, 1),
(10, 3, 'Punctual and regular in class attendance', 9, 2),
(11, 3, 'Open to student\'s opinion and ideas', 10, 2),
(12, 3, 'Considers the student\'s academic differences and multiple intelligence', 11, 2),
(13, 3, 'Bears good appearance and composure', 12, 2),
(14, 3, 'Makes use the whole class period', 13, 2),
(15, 3, 'Checks and returns test papers and assignments', 14, 2),
(16, 3, 'Entertains the students in a calm and approachable manner', 15, 2),
(17, 3, 'Encourage students to participate in co-curricular and extra-curricular activities', 1, 3),
(18, 3, 'Available for consultation or individual conferences', 2, 3),
(19, 3, 'Encourage students to apply their knowledge and skills in serving others', 3, 3),
(20, 3, 'Integrate values and support institutional mission and objectives', 4, 3),
(21, 3, 'Encourage students to participate in co-curricular and extra-curricular activities', 1, 3),
(22, 3, 'Available for consultation or individual conferences', 2, 3),
(23, 3, 'Encourage students to apply their knowledge and skills in serving others', 3, 3),
(24, 3, 'Integrate values and support institutional mission and objectives', 4, 3),
(25, 3, 'ywwya', 16, 4),
(26, 4, 'Prepare, organize and present lesson well', 0, 1),
(27, 4, 'Explain the Subject matter clearly', 1, 1),
(28, 4, 'Relate the Subject matter to other fields', 2, 1),
(29, 4, 'Uses English Language as the medium of instruction', 3, 1),
(30, 4, 'Motivates and arouses student inerest', 4, 1),
(31, 4, 'Answers the questions raised y the student', 5, 1),
(32, 4, 'Gives clear and purposeful assignment', 6, 1),
(33, 4, 'Uses visual aids illustrator in his/her discussion', 7, 1),
(34, 4, 'integrates values in his/her lessons', 8, 1),
(35, 4, 'Punctual and regular in class attendance', 9, 2),
(36, 4, 'Open to student openion and ideas', 10, 2),
(37, 4, 'Considers the student academic differences and multiple', 11, 2),
(38, 4, 'Bears good appearance and composure', 12, 2),
(39, 4, 'Makes use the whole class period', 13, 2),
(40, 4, 'Checks and returns test papers and assignment', 14, 2),
(41, 4, 'Entertains the student in calm and approachable manner', 15, 2),
(42, 4, 'Encourage students to participants in co-curricular and extra intelligences', 16, 4),
(43, 4, 'Available for consultation or individual conferences', 17, 4),
(44, 4, 'Encourage students to apply their knowledge and skills', 18, 4),
(45, 4, 'Integerate values and support institutional mission and objectives', 19, 4),
(46, 5, 'Prepares, Organize and present lesson well', 0, 1),
(47, 5, 'Explain the subject matter clearly', 1, 1),
(48, 5, 'Relate the subject matter to other fields', 2, 1),
(49, 5, 'Uses English language as the medium of instruction', 3, 1),
(50, 5, 'Motivates and arouses students interest', 4, 1),
(51, 5, 'Answers the questions raised by the students', 5, 1),
(52, 5, 'give clear and purposeful assignment', 6, 1),
(53, 5, 'Uses visual aids and illustration in his/her discussion', 7, 1),
(54, 5, 'Integrates values in his/her lesson.', 8, 1),
(55, 5, 'Punctual and regular in class attendance', 9, 2),
(56, 5, 'Open to students opinion and ideas', 10, 2),
(57, 5, 'Considers the students academic differences and multiple intelligences.', 11, 2),
(58, 5, 'ears good appearance and composure', 12, 2),
(59, 5, 'Makes use the whole  class period', 13, 2),
(60, 5, 'Checks and returns test papers and assignments.', 14, 2),
(61, 5, 'Entertains the students in calm and approachable manner', 15, 2),
(62, 5, 'Encourage students to participate in co-curricular and extra-curricular activities', 16, 4),
(63, 5, 'Available for consultation or individual conferences', 17, 4),
(64, 5, 'Encourage students to apply their knowledge and skills in serving others', 18, 4),
(65, 5, 'Integrate values and support institutional mission and objectives', 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `restriction_list`
--

CREATE TABLE `restriction_list` (
  `id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restriction_list`
--

INSERT INTO `restriction_list` (`id`, `academic_id`, `faculty_id`, `class_id`, `subject_id`) VALUES
(24, 3, 1, 1, 1),
(25, 3, 2, 1, 1),
(26, 3, 2, 1, 1),
(27, 3, 2, 1, 1),
(28, 3, 2, 1, 5),
(38, 4, 10, 7, 7),
(47, 5, 10, 7, 20),
(48, 5, 10, 7, 28),
(49, 5, 10, 7, 36),
(50, 5, 10, 4, 34);

-- --------------------------------------------------------

--
-- Table structure for table `student_criteria_ratings`
--

CREATE TABLE `student_criteria_ratings` (
  `id` int(30) NOT NULL,
  `evaluation_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `criteria_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `rating` decimal(4,2) NOT NULL DEFAULT 0.00,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_criteria_ratings`
--

INSERT INTO `student_criteria_ratings` (`id`, `evaluation_id`, `student_id`, `criteria_id`, `faculty_id`, `subject_id`, `academic_id`, `rating`, `date_created`) VALUES
(1, 25, 10, 1, 2, 5, 3, 1.00, '2025-08-17 17:23:19'),
(2, 25, 10, 2, 2, 5, 3, 1.00, '2025-08-17 17:23:19'),
(3, 25, 10, 4, 2, 5, 3, 1.00, '2025-08-17 17:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(30) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` text NOT NULL,
  `class_id` int(30) NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `otp` varchar(6) DEFAULT NULL,
  `otp_expires` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `sms_notifications` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `student_id`, `firstname`, `lastname`, `email`, `phone`, `password`, `class_id`, `avatar`, `otp`, `otp_expires`, `date_created`, `sms_notifications`) VALUES
(4, 'C2201', 'Denso', 'Diosdada', 'denso@gmail.com', NULL, 'e35cf7b66449df565f93c607d5a81d09', 1, '1754646480_bini-gwen-on-surf-v0-zglbx5ztt8ud1.jpg', NULL, NULL, '2025-08-08 17:48:20', 0),
(5, 'T-1102', 'jie', 'grado', 'jie@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 1, 'no-image-available.png', NULL, NULL, '2025-08-09 13:48:55', 1),
(6, 'ST-2322', 'grado', 'jue', 'grado1@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1, 'no-image-available.png', NULL, NULL, '2025-08-09 15:05:33', 0),
(7, 'ST-20', 'fernan', 'Cabrera', 'fernans@gmail.com', NULL, '5eb13cb69b6e20dd7a42030f5936a9dc', 1, 'no-image-available.png', NULL, NULL, '2025-08-09 18:56:09', 0),
(8, 'ST209', 'rhonjorgs', 'cagadas', 'pamorelcabrera@gmail.com', NULL, 'e35cf7b66449df565f93c607d5a81d09', 4, 'no-image-available.png', NULL, NULL, '2025-08-09 20:38:51', 0),
(9, 'ST022', 'carls', 'pamorels', 'carlcabrera090@gmail.com', '+63 916 903 5405', 'e35cf7b66449df565f93c607d5a81d09', 4, 'no-image-available.png', NULL, NULL, '2025-08-09 20:53:00', 1),
(10, 'ST201', 'Fernando', 'pamorel', 'carlgwapo93@gmail.com', NULL, 'e35cf7b66449df565f93c607d5a81d09', 7, 'no-image-available.png', NULL, NULL, '2025-08-09 21:21:56', 0),
(11, 'ST-011', 'Rhonjords', 'cagadas', 'fernancabs8@gmail.com', NULL, '', 5, 'no-image-available.png', NULL, NULL, '2025-08-18 10:56:34', 0),
(12, 'C21-0036', 'Denso', 'Diosdado Jr.', 'diosdadodensojr@gmail.com', NULL, '', 4, 'no-image-available.png', NULL, NULL, '2025-08-20 09:22:19', 0),
(14, 'C22-0543', 'Mari', 'lanie', 'valmoriamarialanie@gmail.com', NULL, '', 4, 'no-image-available.png', '650848', '2025-08-22 11:24:52', '2025-08-20 10:59:51', 0),
(15, 'C-65356-2', 'christine', 'pamorel', 'carlpamorel6@gmail.com', NULL, '', 7, 'no-image-available.png', NULL, NULL, '2025-08-28 11:08:54', 0),
(16, 'C22-0917', 'Paulin Mae Grace', 'Rayos', 'paulinmgrayos@gmail.com', NULL, '', 5, 'no-image-available.png', NULL, NULL, '2025-08-29 09:03:21', 0),
(17, 'C-23212', 'roxanne', 'sison', 'roxannesison767@gmail.com', NULL, '', 5, 'no-image-available.png', NULL, NULL, '2025-08-30 15:26:32', 0),
(18, 'ST-2025-15', 'Maria', 'Laniee', 'marialanievalmoria009@gmail.com', NULL, '', 1, 'no-image-available.png', NULL, NULL, '2025-09-08 23:37:08', 0),
(19, '4235', 'Jella', 'Tagarda', 'tagardajella28@gmail.com', NULL, '', 1, 'no-image-available.png', NULL, NULL, '2025-09-12 17:40:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_list`
--

INSERT INTO `subject_list` (`id`, `code`, `subject`, `description`) VALUES
(3, 'MATH-7', 'Math', 'Advance Algebra '),
(4, 'Grade-9', 'Filipino', 'Panitakang pandaigdig'),
(7, 'F-7', 'Filipino', 'Wika at Panitikan'),
(8, 'Grade-8', 'Filipino', 'Paglawak nang talasalitaan/Novels'),
(9, 'Grade-10', 'Filipino', 'Panitikang Filipino'),
(10, 'MATH-8', 'Math', 'Algebra(linear equation)'),
(11, 'MATH-9', 'Math', 'Quadratic functions'),
(12, 'MATH-10', 'Math', 'Geometry, statistics'),
(13, 'SCI-7', 'Science', 'Integrated Science (cells, matter, motion, earth systems)'),
(14, 'SCI-8', 'Science', 'Chemistry at Physics (atoms, periodic table, forces, energy)'),
(15, 'SCI-9', 'Science', 'Biology'),
(16, 'SCI-10', 'Science', 'Earth and Space Science'),
(17, 'AP-7', 'Araling Panlipunan', 'Kasaysayan ng Asya (history, culture, geography)'),
(18, 'AP-8', 'Araling Panlipunan', 'Kasaysayan ng Daigdig (world history)'),
(19, 'AP-9', 'Araling Panlipunan', 'Ekonomiks (demand, supply, economic systems)'),
(20, 'AP-10', 'Araling Panlipunan', 'Contemporary Issues (globalization, environment, politics)'),
(21, 'TLE-7', 'T.L.E', 'Exploratory (cookery, ICT, agriculture, drafting, housekeeping, carpentry)'),
(22, 'TLE-8', 'T.L.E', 'Exploratory (cookery, ICT, agriculture, drafting, housekeeping, carpentry,)'),
(23, 'TLE-9', 'T.L.E', 'Specialization (Choice your track, ICT – HTML, programming; Home Economics – cookery, baking)'),
(24, 'TLE-10', 'T.L.E', 'Mastery of specialization, project-based learning, and entrepreneurship.'),
(25, 'ENG-7', 'English', 'Introduction to communication, basic grammar, short stories, and reading comprehension.'),
(26, 'ENG-8', 'English', 'More advanced grammar, essay writing, and literary appreciation (novels, plays)'),
(27, 'ENG-9', 'English', 'World literature, speech writing, persuasive writing, and critical reading.'),
(28, 'ENG-10', 'English', 'Contemporary literature, research writing, debates, and advanced communication skills'),
(29, 'MAPEH-7', 'MAPEH', 'Basics of music, drawing/arts, basic physical exercises, and nutrition.'),
(30, 'MAPEH-8', 'MAPEH', 'Philippine music and arts, dance, team sports, and health awareness.'),
(31, 'MAPEH-9', 'MAPEH', 'Asian and world music and arts, advanced physical education (sports, fitness), and substance abuse prevention.'),
(32, 'MAPEH-10', 'MAPEH', 'Contemporary music and arts, leadership in physical education, health advocacy, and first aid'),
(33, 'ESP-7', 'G7 - Values', 'Personal development, self-awareness, family and social relationships'),
(34, 'ESP-8', 'G8 - Values', 'Responsibility, respect, and love for country'),
(35, 'ESP-9', 'G9 - Values', 'Moral decision-making and social responsibility'),
(36, 'ESP-10', 'G10- Values', 'Leadership, compassion, and being patriotic and humane'),
(37, 'ICT-7', 'ICT', ' Basic computer operations, MS Word, PowerPoint, Excel'),
(38, 'ICT-8', 'ICT', 'Internet literacy, multimedia presentations, basic HTML.'),
(39, 'ICT-9', 'ICT', 'Programming fundamentals (Java, Python, or Scratch), web design basics'),
(40, 'ICT-10', 'ICT', 'Advanced ICT applications, database concepts, digital citizenship.'),
(42, 'LIT-CORE-11-TVL-11', '21st Century Literature from the Philippines and the World ', 'wala moy giahatag tawun sakoa!'),
(43, 'STACTICS-HUMSS-11', 'Stactics ngani', 'waafdwadwadwawa');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Junior high Faculty Evaluation System', 'evalfaculty@gmail.com', '09169035405', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `failed_login_attempts` int(11) DEFAULT 0,
  `lockout_until` datetime DEFAULT NULL,
  `secret_key` varchar(32) DEFAULT NULL,
  `is_2fa_enabled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `date_created`, `reset_token`, `reset_expires`, `failed_login_attempts`, `lockout_until`, `secret_key`, `is_2fa_enabled`) VALUES
(2, 'Guidance', 'Evaluation', 'evalfaculty@gmail.com', '$2y$10$a4aCozfJa8hYVelum5UhceLd7.VazqM687gQyJ2nliuoY7G5FEzbu', '1755306660_358f823a53c371e1d22c4de5b8bb86d3.jpg', '2025-08-11 17:51:11', '448740', '2025-10-18 12:36:08', 0, NULL, NULL, 0),
(3, 'A', 'A', 'carlcabrera090@gmail.com', '$2y$10$kJ/w5ALeES3yYHwpToMI8OjC.f92Ez.usNC32FjZYkjC4r9miyaZe', 'no-image-available.png', '2025-09-06 14:59:25', NULL, NULL, 0, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_list`
--
ALTER TABLE `academic_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_history_logs`
--
ALTER TABLE `admin_history_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `action_type` (`action_type`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `idx_admin_action_time` (`admin_id`,`action_type`,`timestamp`),
  ADD KEY `idx_target_lookup` (`target_table`,`target_id`);

--
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_acad_date` (`academic_id`,`event_date`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_adviser_faculty_id` (`adviser_faculty_id`);

--
-- Indexes for table `criteria_list`
--
ALTER TABLE `criteria_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_answers`
--
ALTER TABLE `evaluation_answers`
  ADD KEY `idx_evaluation_id` (`evaluation_id`),
  ADD KEY `idx_question_id` (`question_id`),
  ADD KEY `idx_eval_question` (`evaluation_id`,`question_id`);

--
-- Indexes for table `evaluation_list`
--
ALTER TABLE `evaluation_list`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD UNIQUE KEY `uniq_student_eval` (`student_id`,`academic_id`,`restriction_id`,`subject_id`,`faculty_id`),
  ADD KEY `idx_faculty_id` (`faculty_id`),
  ADD KEY `idx_student_id` (`student_id`),
  ADD KEY `idx_academic_id` (`academic_id`),
  ADD KEY `idx_class_id` (`class_id`),
  ADD KEY `idx_subject_id` (`subject_id`),
  ADD KEY `idx_faculty_academic` (`faculty_id`,`academic_id`),
  ADD KEY `idx_student_acad_restr` (`student_id`,`academic_id`,`restriction_id`),
  ADD KEY `idx_faculty_subject_acad` (`faculty_id`,`subject_id`,`academic_id`);

--
-- Indexes for table `faculty_class_assignments`
--
ALTER TABLE `faculty_class_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_assignment` (`faculty_id`,`class_id`,`subject_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `faculty_list`
--
ALTER TABLE `faculty_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_history`
--
ALTER TABLE `password_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`created_at`);

--
-- Indexes for table `password_reset_attempts`
--
ALTER TABLE `password_reset_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip_address` (`ip_address`,`attempt_time`);

--
-- Indexes for table `question_list`
--
ALTER TABLE `question_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_criteria_id` (`criteria_id`),
  ADD KEY `idx_academic_id` (`academic_id`);

--
-- Indexes for table `restriction_list`
--
ALTER TABLE `restriction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_criteria_ratings`
--
ALTER TABLE `student_criteria_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_id` (`evaluation_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `criteria_id` (`criteria_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `academic_id` (`academic_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_list`
--
ALTER TABLE `academic_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_history_logs`
--
ALTER TABLE `admin_history_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1465;

--
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `criteria_list`
--
ALTER TABLE `criteria_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluation_list`
--
ALTER TABLE `evaluation_list`
  MODIFY `evaluation_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `faculty_class_assignments`
--
ALTER TABLE `faculty_class_assignments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty_list`
--
ALTER TABLE `faculty_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_history`
--
ALTER TABLE `password_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_reset_attempts`
--
ALTER TABLE `password_reset_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `question_list`
--
ALTER TABLE `question_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `restriction_list`
--
ALTER TABLE `restriction_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `student_criteria_ratings`
--
ALTER TABLE `student_criteria_ratings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_history`
--
ALTER TABLE `password_history`
  ADD CONSTRAINT `password_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
