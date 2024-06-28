-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 03:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12


SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `school_fees`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reiims_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `school_fees`
--

CREATE TABLE `school_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_fees`
--

INSERT INTO `school_fees` (`id`, `name`, `description`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Tuition', 'For all grade levels', 18000, '2024-03-10 23:41:35', '2024-03-10 23:41:35'),
(4, 'Miscellaneous', 'for grade 1', 11000, '2024-03-10 23:47:07', '2024-03-10 23:47:07'),
(5, 'Developmental Fee', 'for all student', 1000, '2024-03-10 23:48:45', '2024-03-10 23:48:45'),
(6, 'Enrolment Fee', 'for all student', 500, '2024-03-10 23:49:32', '2024-03-10 23:49:32'),
(7, 'Medical/Dental', 'for all', 300, '2024-03-10 23:50:14', '2024-03-10 23:50:14'),
(8, 'School ID', 'for all students', 200, '2024-03-10 23:51:49', '2024-03-10 23:51:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school_fees`
--
ALTER TABLE `school_fees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school_fees`
--
ALTER TABLE `school_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
