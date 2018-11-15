-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2018 at 05:10 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shuttle_system`
--
CREATE DATABASE IF NOT EXISTS `shuttle_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shuttle_system`;

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(50) NOT NULL,
  `uwi_id` int(10) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `pickup_time` datetime(6) DEFAULT NULL,
  `time_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `uwi_id`, `destination`, `pickup_time`, `time_requested`, `status`) VALUES
(1, 417000571, 'lazaretto', NULL, '2018-11-06 02:02:10', 0),
(2, 417000571, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-06 02:06:05', 1),
(3, 417000571, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-06 02:09:24', 1),
(4, 417000571, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-06 02:09:57', 1),
(5, 417000571, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-06 02:14:35', 1),
(6, 417000571, 'heightsterraces', '2018-11-14 21:04:52.000000', '2018-11-06 02:17:57', 1),
(7, 417000571, 'lazaretto', NULL, '2018-11-12 02:25:21', 0),
(8, 417000571, 'heightsterraces', '2018-11-14 21:04:52.000000', '2018-11-12 02:25:26', 1),
(9, 417000571, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-12 02:25:30', 1),
(10, 417000571, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-12 02:25:34', 1),
(11, 417000571, 'lazaretto', NULL, '2018-11-12 02:25:38', 0),
(12, 417000571, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-12 02:29:57', 1),
(13, 417000571, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-12 02:31:00', 1),
(14, 417000571, 'heightsterraces', '2018-11-14 21:04:52.000000', '2018-11-12 02:31:27', 1),
(15, 417000001, 'bridgetown', '2018-11-14 04:25:14.000000', '2018-11-12 14:55:50', 1),
(16, 417000001, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-12 14:55:54', 1),
(17, 417000001, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-12 14:55:54', 1),
(18, 417000001, 'heightsterraces', '2018-11-14 21:04:52.000000', '2018-11-12 14:55:57', 1),
(19, 417000001, 'lazaretto', NULL, '2018-11-12 14:56:01', 0),
(20, 417000571, 'heightsterraces', '2018-11-14 21:04:52.000000', '2018-11-13 00:25:41', 1),
(21, 417000571, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-14 02:56:17', 1),
(22, 417000571, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-14 02:56:41', 1),
(23, 417000571, 'warrens', '2018-11-14 18:49:36.000000', '2018-11-14 17:49:00', 1),
(24, 417000571, 'lazaretto', NULL, '2018-11-14 18:22:06', 0),
(25, 417000571, 'bridgetown', '2018-11-15 05:15:28.000000', '2018-11-14 20:53:42', 1),
(26, 417000002, 'bridgetown', '2018-11-15 16:53:21.000000', '2018-11-15 15:53:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uwi_id` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uwi_id`, `password`, `admin`, `email`, `first_name`, `last_name`) VALUES
(417000001, '$2y$10$ok7NbbuBMgpLT8UNhd.d/.RGIUeaTFKXLjPF2Y.Vdn7vWgXwH1.Wu', 0, 'test@test.com', 'Janae', 'Rivas'),
(417000002, '$2y$10$VdBol.hOVbTlhB2oVeh33ugMCwk1PPt59QzksekQxg9DeFnZrKECm', 0, 'test@test.com', 'Deegan', 'Holland'),
(417000003, '$2y$10$ZuBn5k8iDa3chOJjbI7FbeubSJgh5V7C07cSGNbMpyLBkm70bpiPi', 0, '', 'Chelsea', 'Butler'),
(417000555, '$2y$10$iHpBtj42V9KXub3wRHOXiewDRe8mpZQthCucDWdo4Ijo3wYCS6Bxu', 1, 'test@test.com', 'John', 'Doe'),
(417000571, '$2y$10$5rYOco9OmSsSzxINwJdrJ.AwxGyPxYSuGbbUb.xz7OXScI7HG/uGS', 0, 'andre.hyland@mycavehill.uwi.edu', 'Andre', 'Hyland');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uwi_id` (`uwi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uwi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uwi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417000572;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `fk_uwi_id` FOREIGN KEY (`uwi_id`) REFERENCES `users` (`uwi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
