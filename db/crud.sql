-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 08:00 PM
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
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `title`, `content`, `date`) VALUES
(30, 'wwo11', 'w12111', '2024-03-25'),
(31, '651', '561', '2024-03-25'),
(32, 'wey', 'wey', '2024-03-25'),
(33, 'wer', '1we', '2024-03-25'),
(34, 'we', 'we', '2024-03-25'),
(36, 'g', 'g', '2024-03-25'),
(37, 'b', 'b', '2024-03-25'),
(38, 'w', '1', '2024-03-25'),
(39, 'gb1', 'gb1', '2024-03-25'),
(40, '1', '1', '2024-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id` int(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id`, `name`, `password`) VALUES
(5, 'we@gmail.com', '$2y$10$0x.FG5khBewPp/xNCGByiOLWOHxK4swyQo0jJzeLghe7n.vN4XZ5K'),
(6, 'hariells@gmail.com', '$2y$10$5sntKxOMgCYs.2O/hiG.v.7s5DbvBthbmLklKhFuBEfNHHW4lYAMq'),
(7, '1@gmail.com', '$2y$10$IyuoPbUlwSokkx43PpXdSuTLHQxBHEFU5tQrN/7jHbfmgOcFylKk6'),
(8, 'wewe@gmail.com', '$2y$10$1TB.LIz7qBLee4HAL9HN.uGhDEAzrR2ofI3jhNYIuhuPb/jWB1Tn6'),
(9, 'hariells@gmail.com', '$2y$10$I2UhR/qz/E2Cn.JFVn1e6eMZGffKUlobwdGaS9vrCieH0rOyfGO6W'),
(10, 'g@gmail.com', '$2y$10$0jz8J2w8XUCPXZyVtOKzquKEIQle6kSt2OhaYPOvtdZpuYCX4jdR2'),
(11, 'g@gmail.com', '$2y$10$yzeqi0.h4hmOD63QbeV6gea4o0tK0gzSGimIiSUd1JrpkyokXHWf2'),
(12, 'jan@gmail.com', '$2y$10$oiPLIOmqbFKywuCnNZtJv.7nLJVunfgMuHhjfDbKYm..pLPoH5m1u'),
(13, 'kev@gmail.com', '$2y$10$edsNGlXTT9HyQ3IzqJC7uOaIdv015uD.TMSyJOBlSdZ61jjivu/X.'),
(14, 'qwe@gmaik.com', '$2y$10$aKFiaw02StSnMTG9LCO/vO.Wd2Mhxw5wyhVF5bhHMAscknjKvASDq'),
(15, 'qwe@gmail.com', '$2y$10$R972ScSh5/u0wBN7h8OydesInHB.miUaakSjkTyES3UIUQBM1beRq');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `tbl_notes_id` int(11) NOT NULL,
  `note_title` text NOT NULL,
  `note` longtext NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_favorite` tinyint(1) NOT NULL,
  `is_archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`tbl_notes_id`, `note_title`, `note`, `date_time`, `is_favorite`, `is_archived`) VALUES
(3, 'HTML?', '21', '2024-04-10 09:24:02', 1, 1),
(6, 'What is CSS?s', 'jkguguygvigvbu', '2024-04-10 09:24:32', 0, 1),
(11, 'What is CSS?s', '12526526', '2024-04-11 00:34:08', 0, 1),
(12, 'What is CSS?s', '123', '2024-04-11 00:34:18', 1, 1),
(14, '123', '123', '2024-04-11 00:34:20', 1, 1),
(15, '2', '2', '2024-04-11 00:34:22', 0, 1),
(17, '3', '3', '2024-04-11 01:31:31', 0, 1),
(20, 'we', '7', '2024-04-11 01:26:08', 1, 1),
(22, 'w', 'w', '2024-04-11 01:29:21', 1, 1),
(29, 'HTML?', '123efsdfds', '2024-04-11 01:26:25', 0, 1),
(30, 'What is CS', 'sfsdgsfdg', '2024-04-11 01:29:36', 0, 1),
(31, 'What is CSS?s', 'we', '2024-04-11 01:31:21', 0, 1),
(32, 'What is CSS?s', 'Cascading Style Sheets (CSS) is a style sheet language used for specifying the presentation and styling of a document written in a markup language such as HTML or XML (including XML dialects such as SVG, MathML or XHTML). CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript. CSS is designed to enable the separation of content and presentation, including layout,', '2024-04-11 02:36:34', 1, 0),
(33, '1', '1', '2024-04-10 09:13:48', 0, 0),
(34, 'g', 'g', '2024-04-10 09:13:18', 0, 0),
(35, 'h', 'h', '2024-04-04 12:17:05', 0, 0),
(36, 'jjjjjjjjj', 'jjjjjj', '2024-04-11 01:32:03', 1, 0),
(39, 'h', 'h', '2024-04-11 01:32:05', 1, 0),
(40, 'we', 'wwe', '2024-04-10 09:19:09', 0, 0),
(41, 'we', 'we', '2024-04-10 09:14:35', 0, 0),
(42, '1', '1', '2024-04-04 13:26:10', 0, 0),
(43, 'y', 'y', '2024-04-04 13:50:36', 0, 0),
(44, 'What is CSS?s', 'gg', '2024-04-08 08:42:18', 0, 0),
(45, 'jhjhj', 'hjhjhj', '2024-04-08 21:30:58', 0, 0),
(46, 'w', 'w', '2024-04-08 23:17:59', 0, 0),
(47, 'What is CSS?ss', 'Cascading Style Sheets (CSS) is a style sheet language used for specifying the presentation and styling of a document written in a markup language such as HTML or XML (including XML dialects such as SVG, MathML or XHTML). CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript. CSS is designed to enable the separation of content and presentation, including layout, colo... Wikipedia', '2024-04-10 01:29:04', 0, 0),
(48, 'wewe', 'ewewewewewe', '2024-04-10 02:06:57', 0, 0),
(49, 'WHAT IS CSS?SS', 'WHAT IS CSS?SS\r\nCascading Style Sheets (CSS) is a style sheet language used for specifying the presentation and styl...', '2024-04-10 09:22:22', 0, 0),
(50, 'we', 'we', '2024-04-10 20:44:22', 0, 0),
(51, '33', '33', '2024-04-12 08:18:29', 0, 0),
(52, 'eeee', 'eeeee', '2024-04-12 08:19:36', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `user_id, note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_favorites`
--

INSERT INTO `user_favorites` (`user_id, note_id`, `user_id`, `note_id`) VALUES
(1, 5, 2),
(2, 5, 3),
(3, 5, 6),
(4, 5, 12),
(5, 5, 32),
(6, 5, 18),
(7, 5, 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`tbl_notes_id`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`user_id, note_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `tbl_notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `user_id, note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
