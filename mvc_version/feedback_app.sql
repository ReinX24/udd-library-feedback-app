-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 05:07 AM
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
-- Database: `feedback_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `master_account` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `username`, `password`, `master_account`) VALUES
(1, 'admin', '$2y$10$WirxRlAYYmSwNG7ORH1XHeI0OtbtHdsVMaiJV0KBM7X0bHOEMXChS', 0),
(2, 'johndoe', '$2y$10$GagRg9Lv1dYwXkPzDO9N7uH/LbYixZiEmpjaRIbyVQqgPuo4JYmUy', 0),
(3, 'janedoe', '$2y$10$ziWF9VvN2r0mDJxqpBD2mesPSr/LAhivafbonDKuqvqlh142t./4.', 0),
(4, 'rein', '$2y$10$zMUGt9PyQqaDAouK6LTfB.dnW2YY/Z9YEwxU2tKtxjLQuVPLdKM3K', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`, `created_at`) VALUES
(1, 'Rein', 'This is an example of a feedback!', '2024-06-05 21:59:10'),
(4, 'Anonymous', 'This is a sample feedback!', '2024-06-22 00:42:14'),
(5, 'Rein', 'Its aight', '2024-06-25 20:05:27'),
(6, 'John', 'Lorem ipsum I forgot the other parts of the text.', '2024-06-25 20:10:25'),
(7, 'John', 'Lorem ipsum I forgot the other parts of the text.', '2024-06-25 20:10:48'),
(8, 'John', 'More random text.', '2024-06-25 20:13:43'),
(9, 'Jane', 'Hooray!', '2024-06-25 20:14:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
