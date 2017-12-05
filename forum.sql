-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2017 at 09:08 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `priority`, `created_at`, `updated_at`) VALUES
(9, 'Announcements', 1, '2017-11-22 08:48:59', '2017-11-26 00:39:23'),
(12, 'General', 0, '2017-11-22 09:36:53', '2017-11-22 09:36:53'),
(13, 'saloon', 2, '2017-11-22 10:27:26', '2017-11-22 11:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_subforum` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `name`, `category_id`, `is_subforum`, `priority`, `created_at`, `updated_at`) VALUES
(2, 'important', 9, 0, 0, '2017-11-22 10:07:49', '2017-11-22 10:36:49'),
(11, 'general', 9, 0, 0, '2017-11-22 10:35:55', '2017-11-22 10:35:55'),
(12, 'monthly events', 9, 0, 0, '2017-11-22 12:35:32', '2017-11-22 12:35:32'),
(13, 'boardgames', 12, 0, 0, '2017-11-22 12:44:21', '2017-11-22 12:44:21'),
(14, 'videogames', 12, 0, 0, '2017-11-22 12:44:43', '2017-11-22 12:44:43'),
(15, 'series', 12, 0, 0, '2017-11-22 12:44:49', '2017-11-22 12:44:49'),
(16, 'what are you eating today?', 13, 0, 0, '2017-11-22 12:44:57', '2017-11-22 12:44:57'),
(17, 'random chat', 13, 0, 0, '2017-11-22 12:45:57', '2017-11-22 12:45:57'),
(18, 'funny gifs', 13, 0, 0, '2017-11-22 12:46:04', '2017-11-22 12:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` varchar(512) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `user_id`, `topic_id`, `created_at`, `updated_at`) VALUES
(0, 'Hi! <3', 4, 85, '2017-11-26 00:55:52', '2017-11-26 00:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `forum_id`, `user_id`, `pinned`, `created_at`, `updated_at`) VALUES
(1, 'First post!', 11, 2, 0, '2017-11-23 09:21:50', '2017-11-23 09:21:50'),
(2, 'Test #1', 11, 3, 0, '2017-11-23 09:57:04', '2017-11-23 09:57:04'),
(3, 'Rules', 11, 3, 0, '2017-11-23 09:57:20', '2017-11-23 09:57:20'),
(4, 'Hoi', 11, 2, 0, '2017-11-23 10:42:57', '2017-11-23 10:42:57'),
(5, 'Hoi', 11, 2, 0, '2017-11-23 10:45:32', '2017-11-23 10:45:32'),
(79, 'Hoi', 11, 2, 0, '2017-11-26 00:15:47', '2017-11-26 00:15:47'),
(80, 'Hoi', 11, 2, 0, '2017-11-26 00:32:33', '2017-11-26 00:32:33'),
(81, 'Hoi', 11, 2, 0, '2017-11-26 00:32:55', '2017-11-26 00:32:55'),
(85, 'Weekly Announcements', 2, 4, 0, '2017-11-26 00:55:52', '2017-11-26 00:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(2, 'Somentus', 'somentus@gmail.com', '$2y$10$ojB0SIK3wxGbffeRu33h7edpeIFEKRXkjG7Qll6SzHb3Rlk6HpFc2', 1, '2017-11-22', '2017-11-22'),
(3, 'Admin', 'admin@admin.nl', '$2y$10$vhj/B4h6ccwfFXAZZq96h.TKnX6LneGGs4m5BivlZFjh75fOTXoZq', 0, '2017-11-23', '2017-11-23'),
(4, 'Test', 'test@test.test', '$2y$10$Tg1asW4hqzKpvmsy4ql7xOlnabYKKkz9aroN/vjbCIWt5dNLpl3y2', 0, '2017-11-26', '2017-11-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;