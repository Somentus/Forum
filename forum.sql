-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2017 at 02:33 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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
-- Table structure for table `activation_keys`
--

CREATE TABLE `activation_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `priority`, `created_at`, `updated_at`) VALUES
(9, 'Announcements', 3, '2017-11-22 08:48:59', '2017-12-12 23:59:28'),
(12, 'General', 2, '2017-11-22 09:36:53', '2017-12-12 23:59:35'),
(13, 'Saloon', 1, '2017-11-22 10:27:26', '2017-12-12 23:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_subforum` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `name`, `category_id`, `is_subforum`, `priority`, `created_at`, `updated_at`) VALUES
(2, 'Important', 9, 0, 0, '2017-11-22 10:07:49', '2017-11-28 17:26:55'),
(11, 'General', 9, 0, 0, '2017-11-22 10:35:55', '2017-11-28 17:26:55'),
(12, 'Monthly events', 9, 0, 0, '2017-11-22 12:35:32', '2017-11-28 17:26:55'),
(14, 'Videogames', 12, 0, 0, '2017-11-22 12:44:43', '2017-11-28 17:26:55'),
(15, 'Series', 12, 0, 0, '2017-11-22 12:44:49', '2017-11-28 17:26:55'),
(16, 'What are you eating today?', 13, 0, 0, '2017-11-22 12:44:57', '2017-11-28 17:26:55'),
(18, 'Funny gifs', 13, 0, 0, '2017-11-22 12:46:04', '2017-11-28 17:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `old_emails`
--

CREATE TABLE `old_emails` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_emails`
--

INSERT INTO `old_emails` (`id`, `user_id`, `email`, `created_at`, `updated_at`) VALUES
(1, 8, 'somentus@gmail.com', '2017-12-19 12:53:42', '2017-12-19 12:53:42'),
(2, 8, 'r.vd.t@hotmail.com', '2017-12-19 12:55:30', '2017-12-19 12:55:30'),
(3, 8, 'somentus@gmail.com', '2017-12-19 12:56:09', '2017-12-19 12:56:09'),
(4, 8, 'r.vd.t@hotmail.com', '2017-12-19 12:56:30', '2017-12-19 12:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `old_passwords`
--

CREATE TABLE `old_passwords` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_passwords`
--

INSERT INTO `old_passwords` (`id`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 8, '$2y$10$kpdTQRTVSuH8LvHTFPmG8O7IXMS5uNvwo5aqtI0.YYfyalmAqNPHe', '2017-12-19 13:11:33', '2017-12-19 13:11:33'),
(2, 8, '$2y$10$IU4vc4oV8wSkxRVULKoNOuP8LVAW10dcOJc//VqWl5VnUW30Uacvm', '2017-12-19 13:15:03', '2017-12-19 13:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `old_usernames`
--

CREATE TABLE `old_usernames` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `old_usernames`
--

INSERT INTO `old_usernames` (`id`, `user_id`, `username`, `created_at`, `updated_at`) VALUES
(1, 8, 'Terrie', '2017-12-19 13:02:32', '2017-12-19 13:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` varchar(512) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `user_id`, `topic_id`, `created_at`, `updated_at`) VALUES
(1, 'Hi! <3', 4, 85, '2017-11-26 00:55:52', '2017-11-26 00:55:52'),
(2, 'I think it finally worked :D', 2, 86, '2017-12-12 15:21:17', '2017-12-12 15:21:17'),
(4, 'Woah', 2, 85, '2017-12-12 19:31:48', '2017-12-12 19:31:48'),
(5, 'This works :O', 2, 85, '2017-12-12 19:32:44', '2017-12-12 19:32:44'),
(6, 'FOURTH!', 2, 85, '2017-12-12 22:59:45', '2017-12-12 22:59:45'),
(7, 'And then you\'re going to have to decide whether IC or manpower is more important, because you\'re forced to either be stuck with a permanent -30% recruitable population malus, or be trapped in the Great Depression FOREVER.\r\n\r\nWhich is total fucking bullshit.', 2, 85, '2017-12-12 23:00:05', '2017-12-12 23:00:05'),
(8, 'HOI RIK EN GIEL HIER <3', 3, 85, '2017-12-15 17:16:04', '2017-12-15 17:16:04'),
(9, '<img src=\"https://media1.tenor.com/images/efc9f6ce8923eadf351b676f29bf943c/tenor.gif\">', 5, 87, '2017-12-15 20:44:36', '2017-12-15 20:44:36'),
(10, 'tik tak tik tak', 5, 87, '2017-12-15 20:45:30', '2017-12-15 20:45:30'),
(11, 'Hallo!', 6, 85, '2017-12-18 18:36:25', '2017-12-18 18:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `profile_pictures`
--

CREATE TABLE `profile_pictures` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) CHARACTER SET latin1 NOT NULL,
  `extension` varchar(16) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_pictures`
--

INSERT INTO `profile_pictures` (`id`, `uuid`, `extension`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'e412d921-f5c6-4ff6-9a91-fccbd00a4860', 'jpg', 2, '2017-12-18 16:51:42', '2017-12-18 16:51:42'),
(7, 'b2ec28f9-7a47-44aa-a1e3-3aec4fe37c83', 'jpg', 3, '2017-12-18 17:29:07', '2017-12-18 18:29:35'),
(8, 'ea0b372c-115b-476f-b8f1-9455eab293f6', 'jpg', 6, '2017-12-18 18:41:39', '2017-12-18 19:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `reset_passwords`
--

CREATE TABLE `reset_passwords` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_passwords`
--

INSERT INTO `reset_passwords` (`id`, `user_id`, `uuid`, `created_at`, `updated_at`) VALUES
(4, 2, 'cde07ff2-8dc0-4a58-92e8-ed84f88acd4a', '2017-12-19 11:46:21', '2017-12-19 11:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `forum_id`, `user_id`, `pinned`, `created_at`, `updated_at`) VALUES
(85, 'Weekly Announcements', 2, 4, 0, '2017-11-26 00:55:52', '2017-11-26 00:55:52'),
(86, 'Last post?', 2, 2, 0, '2017-12-12 15:21:17', '2017-12-12 15:21:17'),
(87, 'HOI', 18, 5, 0, '2017-12-15 20:44:36', '2017-12-15 20:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `bio` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `birth_date`, `bio`, `is_admin`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Somentus', 'ter@gmail.com', '$2y$10$65zQRCys.vmrdKywecVlbO0Ne2bZ15RCDbDgoi/oEiXuvSqC/QAs6', '1994-12-05', 'HOI ik ben MAAIKE!', 1, 1, '2017-11-21 23:00:00', '2017-12-19 12:11:29'),
(3, 'Admin', 'admin@admin.nl', '$2y$10$vhj/B4h6ccwfFXAZZq96h.TKnX6LneGGs4m5BivlZFjh75fOTXoZq', '0000-00-00', '', 0, 1, '2017-11-22 23:00:00', '2017-12-19 12:11:29'),
(4, 'Test', 'test@test.test', '$2y$10$Tg1asW4hqzKpvmsy4ql7xOlnabYKKkz9aroN/vjbCIWt5dNLpl3y2', '0000-00-00', '', 0, 1, '2017-11-25 23:00:00', '2017-12-19 12:11:29'),
(5, 'hoiikbengiel', 'hoiikbengiel@mailinator.com', '$2y$10$4sv9Kq9mqOBB7XwdM1TGJ.1DryC3LiBzLQVrJWOuShRfeafhk5R7C', '0000-00-00', '', 0, 1, '2017-12-14 23:00:00', '2017-12-19 12:11:29'),
(6, 'Maaike', 'ma@ai.ke', '$2y$10$7wz.1Qyq4jOPjuB5Ni2kl.GCHEUVD/GQHefWfPxmFMpTBxZSulgCa', '0000-00-00', '', 0, 1, '2017-12-18 18:35:58', '2017-12-19 12:11:29'),
(7, 'Terryz', 'terry@gmail.com', '$2y$10$SNFvYyGNK/582tTV/VnysuJhbWvEIeNRYivEjPzylvjA4xIdUmcoG', '0000-00-00', '', 0, 1, '2017-12-19 11:59:31', '2017-12-19 13:02:29'),
(8, 'Terry', 'somentus@gmail.com', '$2y$10$4Chh0HcnKIQ0kXc7jBk9B.UqwYpFC03/H3kbazJ66MWcXGTbNE8Ne', '0000-00-00', '', 0, 1, '2017-12-19 12:01:14', '2017-12-19 13:15:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_keys`
--
ALTER TABLE `activation_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `old_emails`
--
ALTER TABLE `old_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_passwords`
--
ALTER TABLE `old_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_usernames`
--
ALTER TABLE `old_usernames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `activation_keys`
--
ALTER TABLE `activation_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `old_emails`
--
ALTER TABLE `old_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `old_passwords`
--
ALTER TABLE `old_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `old_usernames`
--
ALTER TABLE `old_usernames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation_keys`
--
ALTER TABLE `activation_keys`
  ADD CONSTRAINT `activation_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

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
-- Constraints for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  ADD CONSTRAINT `profile_pictures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD CONSTRAINT `reset_passwords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

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
