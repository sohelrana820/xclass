-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 04:31 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned zerofill NOT NULL,
  `created_by` int(11) unsigned zerofill DEFAULT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `profile_pic` varchar(128) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `street_1` varchar(255) DEFAULT NULL,
  `street_2` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uuid` varchar(32) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '2' COMMENT 'role: 1 = admin, 2 = general',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'status: 1 = Active, 0 = Inactive',
  `email_verifying_code` varchar(32) NOT NULL,
  `forgot_pass_code` varchar(32) DEFAULT NULL,
  `email_verify` int(1) NOT NULL DEFAULT '0' COMMENT 'email_verify: 1 = Verified, 0 =  Unverified',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
