-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2018 at 11:41 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `xclass`
--
INSERT INTO `users` (`id`, `uuid`, `username`, `student_id`, `password`, `role`, `status`, `email_verifying_code`, `forgot_pass_code`, `email_verify`, `created`, `modified`) VALUES
(1, '6dad6afc-0c08-4e5b-a410-9a41eaff698a', 'admin@example.com', NULL, '$2y$10$6LBg9OBs.8/lHB9/iJXpzuscp4BSIV1j3OUeVyq8xgmo63v.6tQFW', 1, 1, 'f6d7e2a7-8b9d-46e7-9b37-8adf5cc7', NULL, 0, '2018-03-24 23:10:06', '2018-03-24 23:10:06'),
(2, '6d509e0d-674d-4b33-9bc0-2b233cfa2389', 'student01@example.com', '101', '$2y$10$ZwTtRzDTT5Uts09b5V81OOvHeEvtDfoA7d/1MTOBBcM7JU3Cv0J6y', 2, 0, '92437e88-acdc-4fe9-9b4f-92ff8c41', NULL, 0, '2018-03-24 23:36:15', '2018-03-24 23:36:15'),
(3, 'ee6b2ba0-2f29-4cd8-b60a-df7796dd3961', 'student02@example.com', '102', '$2y$10$UI9D15UgX6yaKWCmdys5oe/9SEmMnMwlZNE6HsN1gcwhwbrbtI05q', 2, 1, '90881a53-4510-43ad-9b68-48075aec', NULL, 0, '2018-03-24 23:37:34', '2018-03-24 23:37:34'),
(4, '54a80e11-b2a1-4e1c-852e-b989b61df389', 'student03@example.com', '103', '$2y$10$xCYHmYD890BZheIf9ZeozO5oqL3OVkc/DEBPmAA9ox.uN5l.B4zWW', 2, 1, '7a667117-ea67-45fa-ab01-6a5b3e67', NULL, 0, '2018-03-24 23:38:16', '2018-03-24 23:38:16');
--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `created_by`, `name`, `description`, `status`, `created`, `modified`) VALUES
(1, 1, 'Microsoft Excel', 'Microsoft Excel', 1, '2018-03-24 23:32:16', '2018-03-24 23:32:16'),
(2, 1, 'Microsoft Powerpoint', 'Microsoft Powerpoint', 1, '2018-03-24 23:32:37', '2018-03-24 23:32:37'),
(3, 1, 'Adobe Indesign', 'Adobe Indesign', 0, '2018-03-24 23:32:55', '2018-03-24 23:32:55'),
(4, 1, 'Basic PHP', 'Basic PHP', 1, '2018-03-24 23:33:12', '2018-03-24 23:33:12'),
(5, 1, 'Advance PHP', 'Advance PHP', 1, '2018-03-24 23:33:28', '2018-03-24 23:33:28'),
(6, 1, 'Web Development', 'Web Development', 1, '2018-03-24 23:34:11', '2018-03-24 23:34:11'),
(7, 1, 'Android Development', 'Android Development', 1, '2018-03-24 23:34:32', '2018-03-24 23:34:32'),
(8, 1, 'iOS Development', 'iOS Development', 1, '2018-03-24 23:34:46', '2018-03-24 23:34:46'),
(9, 1, 'NodeJS', 'NodeJS', 1, '2018-03-24 23:34:56', '2018-03-24 23:34:56'),
(10, 1, 'Ruby', 'Ruby', 1, '2018-03-24 23:35:14', '2018-03-24 23:35:14');

--
-- Dumping data for table `courses_users`
--

INSERT INTO `courses_users` (`id`, `course_id`, `user_id`, `created`, `modified`) VALUES
(1, 1, 2, '2018-03-24 23:36:16', '2018-03-24 23:36:16'),
(2, 2, 2, '2018-03-24 23:36:16', '2018-03-24 23:36:16'),
(3, 10, 3, '2018-03-24 23:37:34', '2018-03-24 23:37:34'),
(4, 4, 4, '2018-03-24 23:38:16', '2018-03-24 23:38:16'),
(5, 5, 4, '2018-03-24 23:38:16', '2018-03-24 23:38:16'),
(6, 6, 4, '2018-03-24 23:38:16', '2018-03-24 23:38:16');

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `created_by`, `first_name`, `last_name`, `profile_pic`, `gender`, `birthday`, `street_1`, `street_2`, `phone`, `city`, `state`, `postal_code`, `country`, `created`, `modified`) VALUES
(1, 1, NULL, 'xClass', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-24 23:10:06', '2018-03-24 23:10:06'),
(2, 2, 1, 'Student', 'One', NULL, NULL, NULL, '', '', '', '', 'Choose state', '', '-1', '2018-03-24 23:36:15', '2018-03-24 23:36:15'),
(3, 3, 1, 'Student', 'Two', NULL, NULL, NULL, '', '', '', '', 'Choose state', '', '-1', '2018-03-24 23:37:34', '2018-03-24 23:37:34'),
(4, 4, 1, 'Student', 'Three', NULL, NULL, NULL, '', '', '', '', 'Choose state', '', '-1', '2018-03-24 23:38:16', '2018-03-24 23:38:16');

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `meta`, `value`, `created`, `modified`) VALUES
(1, 'name', 'xClass', '2018-03-24 23:31:04', '2018-03-24 23:31:04'),
(2, 'copyright', 'Copyright 2018', '2018-03-24 23:31:04', '2018-03-24 23:31:04'),
(3, 'users_per_page', '10', '2018-03-24 23:31:04', '2018-03-24 23:31:04'),
(4, 'documents_per_page', '20', '2018-03-24 23:31:04', '2018-03-24 23:31:04'),
(5, 'history_per_page', '50', '2018-03-24 23:31:04', '2018-03-24 23:31:04'),
(6, 'logo', 'logo.png', '2018-03-24 23:31:04', '2018-03-24 23:31:04');

--
-- Dumping data for table `users`
--


