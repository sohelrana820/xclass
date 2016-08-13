-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2016 at 04:37 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `task-manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(32) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `comment` text,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'status: 1 = active, 2 = Inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `changing_status` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `comment_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `color_code` varchar(24) DEFAULT 'eeeeee',
  `created_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'status: 1 = active,  = Inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `profile_pic` varchar(128) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL COMMENT 'gender: 1 = Male, 2 = Female, 0 = N/A',
  `birthday` date DEFAULT NULL,
  `street_1` varchar(255) DEFAULT NULL,
  `street_2` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `created_by` (`created_by`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(32) NOT NULL,
  `created_by` int(11) NOT NULL,
  `task` text NOT NULL,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'status: 1 = open,  2 = closed, 3 = reopen',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks_labels`
--

CREATE TABLE IF NOT EXISTS `tasks_labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `label_id` (`label_id`),
  KEY `label_id_2` (`label_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(32) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'default password<123456>: $2y$10$QRvZkbtezmQ9ujWFpgqTeOJ3mqbyt78CAIUqAoB3Us1XlmDWH4j2a',
  `role` int(1) NOT NULL DEFAULT '2' COMMENT 'role: 1 = admin, 2 = user',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'status: 1 = Active, 0 = Inactive',
  `email_verifying_code` varchar(32) NOT NULL,
  `forgot_pass_code` varchar(32) DEFAULT NULL,
  `email_verify` int(1) NOT NULL DEFAULT '0' COMMENT 'email_verify: 1 = Verified, 0 =  Unverified',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_tasks`
--

CREATE TABLE IF NOT EXISTS `users_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `labels_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks_labels`
--
ALTER TABLE `tasks_labels`
  ADD CONSTRAINT `tasks_labels_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `tasks_labels_ibfk_2` FOREIGN KEY (`label_id`) REFERENCES `labels` (`id`);

--
-- Constraints for table `users_tasks`
--
ALTER TABLE `users_tasks`
  ADD CONSTRAINT `users_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);
