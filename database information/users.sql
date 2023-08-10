-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 01:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(200) NOT NULL COMMENT 'The email of user.',
  `pWord` varchar(255) NOT NULL COMMENT 'The password of user.',
  `progress1` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'The reading progress for "Dementia Symptoms"',
  `progress2` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'The reading progress for "Dealing with Dementia Behaviors".',
  `progress3` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'The reading progress for "Communication Tips".',
  `score_topic1` int(11) NOT NULL DEFAULT 0 COMMENT 'The quiz result for "Dementia Symptoms".',
  `score_topic2` int(11) NOT NULL DEFAULT 0 COMMENT 'The quiz result for "Dealing with Dementia Behaviors".',
  `score_topic3` int(11) NOT NULL DEFAULT 0 COMMENT 'The quiz result for "Communication Tips".',
  `uName` varchar(50) NOT NULL COMMENT 'The name of user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `pWord`, `progress1`, `progress2`, `progress3`, `score_topic1`, `score_topic2`, `score_topic3`, `uName`) VALUES
('junhao@gmail.com', '$2y$10$49.YOpNgtASvCu7oKYpgoemgu2frKnZl7pMA9QLvrwFnqzhZy6t.a', 100, 100, 100, 100, 100, 100, 'Jun Hao');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
