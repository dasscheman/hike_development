-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2015 at 05:30 PM
-- Server version: 5.5.44-cll-lve
-- PHP Version: 5.5.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hike-v2-01`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bonuspunten`
--

CREATE TABLE IF NOT EXISTS `tbl_bonuspunten` (
  `bouspunten_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `post_ID` int(11) DEFAULT NULL,
  `group_ID` int(11) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deelnemers_event`
--

CREATE TABLE IF NOT EXISTS `tbl_deelnemers_event` (
  `deelnemers_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `rol` int(11) DEFAULT NULL,
  `group_ID` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_names`
--

CREATE TABLE IF NOT EXISTS `tbl_event_names` (
  `event_ID` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `active_day` date DEFAULT NULL,
  `max_time` time DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_friend_list`
--

CREATE TABLE IF NOT EXISTS `tbl_friend_list` (
  `friend_list_ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `friends_with_user_ID` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_groups` (
  `group_ID` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nood_envelop`
--

CREATE TABLE IF NOT EXISTS `tbl_nood_envelop` (
  `nood_envelop_ID` int(11) NOT NULL,
  `nood_envelop_name` varchar(255) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `route_ID` int(11) NOT NULL,
  `nood_envelop_volgorde` int(11) DEFAULT NULL,
  `coordinaat` varchar(255) NOT NULL,
  `opmerkingen` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_nood_envelop`
--

CREATE TABLE IF NOT EXISTS `tbl_open_nood_envelop` (
  `open_nood_envelop_ID` int(11) NOT NULL,
  `nood_envelop_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `group_ID` int(11) NOT NULL,
  `opened` tinyint(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_vragen`
--

CREATE TABLE IF NOT EXISTS `tbl_open_vragen` (
  `open_vragen_ID` int(11) NOT NULL,
  `open_vragen_name` varchar(255) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `route_ID` int(11) NOT NULL,
  `vraag_volgorde` int(11) DEFAULT NULL,
  `omschrijving` text NOT NULL,
  `vraag` varchar(255) NOT NULL,
  `goede_antwoord` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_vragen_antwoorden`
--

CREATE TABLE IF NOT EXISTS `tbl_open_vragen_antwoorden` (
  `open_vragen_antwoorden_ID` int(11) NOT NULL,
  `open_vragen_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `group_ID` int(11) NOT NULL,
  `antwoord_spelers` varchar(255) NOT NULL,
  `checked` tinyint(1) DEFAULT NULL,
  `correct` tinyint(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posten`
--

CREATE TABLE IF NOT EXISTS `tbl_posten` (
  `post_ID` int(11) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `post_volgorde` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_passage`
--

CREATE TABLE IF NOT EXISTS `tbl_post_passage` (
  `posten_passage_ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `group_ID` int(11) NOT NULL,
  `gepasseerd` tinyint(11) NOT NULL,
  `binnenkomst` datetime DEFAULT NULL,
  `vertrek` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr`
--

CREATE TABLE IF NOT EXISTS `tbl_qr` (
  `qr_ID` int(11) NOT NULL,
  `qr_name` varchar(255) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `route_ID` int(11) NOT NULL,
  `qr_volgorde` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qr_check`
--

CREATE TABLE IF NOT EXISTS `tbl_qr_check` (
  `qr_check_ID` int(11) NOT NULL,
  `qr_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `group_ID` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE IF NOT EXISTS `tbl_route` (
  `route_ID` int(11) NOT NULL,
  `route_name` varchar(255) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `day_date` date NOT NULL,
  `route_volgorde` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `macadres` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_ID` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bonuspunten`
--
ALTER TABLE `tbl_bonuspunten`
  ADD PRIMARY KEY (`bouspunten_ID`),
  ADD KEY `fk_bonuspunten_event_id` (`event_ID`),
  ADD KEY `fk_bonuspunten_post_id` (`post_ID`),
  ADD KEY `fk_bonuspunten_group_id` (`group_ID`),
  ADD KEY `fk_bonuspunten_create_user` (`create_user_ID`),
  ADD KEY `fk_bonuspunten_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_deelnemers_event`
--
ALTER TABLE `tbl_deelnemers_event`
  ADD PRIMARY KEY (`deelnemers_ID`),
  ADD UNIQUE KEY `event_ID` (`event_ID`,`user_ID`),
  ADD KEY `fk_deelnemers_user_id` (`user_ID`),
  ADD KEY `fk_deelnemers_group_ID` (`group_ID`),
  ADD KEY `fk_deelnemers_create_user` (`create_user_ID`),
  ADD KEY `fk_deelnemers_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_event_names`
--
ALTER TABLE `tbl_event_names`
  ADD PRIMARY KEY (`event_ID`),
  ADD UNIQUE KEY `event_name` (`event_name`),
  ADD KEY `fk_events_create_user_name` (`create_user_ID`),
  ADD KEY `fk_events_update_user_name` (`update_user_ID`);

--
-- Indexes for table `tbl_friend_list`
--
ALTER TABLE `tbl_friend_list`
  ADD PRIMARY KEY (`friend_list_ID`),
  ADD UNIQUE KEY `friendship_ID` (`user_ID`,`friends_with_user_ID`),
  ADD KEY `fk_friend_list_friends_with_user` (`friends_with_user_ID`),
  ADD KEY `fk_friend_list_create_user` (`create_user_ID`),
  ADD KEY `fk_friend_list_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`group_ID`),
  ADD UNIQUE KEY `event_ID` (`event_ID`,`group_name`),
  ADD KEY `fk_groups_create_user` (`create_user_ID`),
  ADD KEY `fk_groups_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_migration`
--
ALTER TABLE `tbl_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_nood_envelop`
--
ALTER TABLE `tbl_nood_envelop`
  ADD PRIMARY KEY (`nood_envelop_ID`),
  ADD UNIQUE KEY `envelop_id` (`nood_envelop_name`,`event_ID`),
  ADD KEY `fk_nood_envelop_event_id` (`event_ID`),
  ADD KEY `fk_nood_envelop_route` (`route_ID`),
  ADD KEY `fk_nood_envelop_create_user` (`create_user_ID`),
  ADD KEY `fk_nood_envelop_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_open_nood_envelop`
--
ALTER TABLE `tbl_open_nood_envelop`
  ADD PRIMARY KEY (`open_nood_envelop_ID`),
  ADD UNIQUE KEY `nood_envelop_ID` (`nood_envelop_ID`,`group_ID`),
  ADD KEY `fk_open_nood_envelop_event_id` (`event_ID`),
  ADD KEY `fk_open_nood_envelop_group_id` (`group_ID`),
  ADD KEY `fk_onood_envelop_create_user` (`create_user_ID`),
  ADD KEY `fk_onood_envelop_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_open_vragen`
--
ALTER TABLE `tbl_open_vragen`
  ADD PRIMARY KEY (`open_vragen_ID`),
  ADD UNIQUE KEY `open_vragen_name` (`open_vragen_name`),
  ADD KEY `fk_open_vragen_event_id` (`event_ID`),
  ADD KEY `fk_open_vragen_route` (`route_ID`),
  ADD KEY `fk_open_vragen_create_user` (`create_user_ID`),
  ADD KEY `fk_open_vragen_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_open_vragen_antwoorden`
--
ALTER TABLE `tbl_open_vragen_antwoorden`
  ADD PRIMARY KEY (`open_vragen_antwoorden_ID`),
  ADD UNIQUE KEY `open_vragen_ID` (`open_vragen_ID`,`group_ID`),
  ADD KEY `fk_open_vragen_antwoorden_event_id` (`event_ID`),
  ADD KEY `fk_open_vragen_antwoorden_group_id` (`group_ID`),
  ADD KEY `fk_open_vragen_antwoorden_create_user` (`create_user_ID`),
  ADD KEY `fk_open_vragen_antwoorden_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_posten`
--
ALTER TABLE `tbl_posten`
  ADD PRIMARY KEY (`post_ID`),
  ADD UNIQUE KEY `post_name` (`post_name`,`event_ID`,`date`),
  ADD KEY `fk_posten_event_name` (`event_ID`),
  ADD KEY `fk_posten_create_user` (`create_user_ID`),
  ADD KEY `fk_posten_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_post_passage`
--
ALTER TABLE `tbl_post_passage`
  ADD PRIMARY KEY (`posten_passage_ID`),
  ADD UNIQUE KEY `post_ID` (`post_ID`,`event_ID`,`group_ID`),
  ADD KEY `fk_post_passage_event_id` (`event_ID`),
  ADD KEY `fk_post_passage_group_name` (`group_ID`),
  ADD KEY `fk_post_passage_create_user` (`create_user_ID`),
  ADD KEY `fk_post_passage_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_qr`
--
ALTER TABLE `tbl_qr`
  ADD PRIMARY KEY (`qr_ID`),
  ADD UNIQUE KEY `qr_code` (`qr_code`,`event_ID`),
  ADD KEY `fk_qr_event_id` (`event_ID`),
  ADD KEY `fk_qr_route` (`route_ID`),
  ADD KEY `fk_qr_create_user` (`create_user_ID`),
  ADD KEY `fk_qr_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_qr_check`
--
ALTER TABLE `tbl_qr_check`
  ADD PRIMARY KEY (`qr_check_ID`),
  ADD UNIQUE KEY `qr_ID` (`qr_ID`,`group_ID`),
  ADD KEY `fk_qr_check_qr_event_id` (`event_ID`),
  ADD KEY `fk_qr_check_qr_group_id` (`group_ID`),
  ADD KEY `fk_qr_check_create_user` (`create_user_ID`),
  ADD KEY `fk_qr_check_update_user` (`update_user_ID`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`route_ID`),
  ADD UNIQUE KEY `event_ID` (`event_ID`,`day_date`,`route_name`),
  ADD KEY `fk_route_create_user_name` (`create_user_ID`),
  ADD KEY `fk_route_update_user_name` (`update_user_ID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bonuspunten`
--
ALTER TABLE `tbl_bonuspunten`
  MODIFY `bouspunten_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_deelnemers_event`
--
ALTER TABLE `tbl_deelnemers_event`
  MODIFY `deelnemers_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_event_names`
--
ALTER TABLE `tbl_event_names`
  MODIFY `event_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_friend_list`
--
ALTER TABLE `tbl_friend_list`
  MODIFY `friend_list_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `group_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_nood_envelop`
--
ALTER TABLE `tbl_nood_envelop`
  MODIFY `nood_envelop_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_open_nood_envelop`
--
ALTER TABLE `tbl_open_nood_envelop`
  MODIFY `open_nood_envelop_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_open_vragen`
--
ALTER TABLE `tbl_open_vragen`
  MODIFY `open_vragen_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_open_vragen_antwoorden`
--
ALTER TABLE `tbl_open_vragen_antwoorden`
  MODIFY `open_vragen_antwoorden_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_posten`
--
ALTER TABLE `tbl_posten`
  MODIFY `post_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_post_passage`
--
ALTER TABLE `tbl_post_passage`
  MODIFY `posten_passage_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_qr`
--
ALTER TABLE `tbl_qr`
  MODIFY `qr_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_qr_check`
--
ALTER TABLE `tbl_qr_check`
  MODIFY `qr_check_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bonuspunten`
--
ALTER TABLE `tbl_bonuspunten`
  ADD CONSTRAINT `fk_bonuspunten_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bonuspunten_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bonuspunten_group_id` FOREIGN KEY (`group_ID`) REFERENCES `tbl_groups` (`group_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bonuspunten_post_id` FOREIGN KEY (`post_ID`) REFERENCES `tbl_posten` (`post_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bonuspunten_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_deelnemers_event`
--
ALTER TABLE `tbl_deelnemers_event`
  ADD CONSTRAINT `fk_deelnemers_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_deelnemers_event_event_ID` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_deelnemers_group_ID` FOREIGN KEY (`group_ID`) REFERENCES `tbl_groups` (`group_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_deelnemers_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_deelnemers_user_id` FOREIGN KEY (`user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_event_names`
--
ALTER TABLE `tbl_event_names`
  ADD CONSTRAINT `fk_events_create_user_name` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_events_update_user_name` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_friend_list`
--
ALTER TABLE `tbl_friend_list`
  ADD CONSTRAINT `fk_friend_list_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_friend_list_friends_with_user` FOREIGN KEY (`friends_with_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_friend_list_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_friend_list_user` FOREIGN KEY (`user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD CONSTRAINT `fk_groups_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_groups_event_ID` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_groups_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nood_envelop`
--
ALTER TABLE `tbl_nood_envelop`
  ADD CONSTRAINT `fk_nood_envelop_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nood_envelop_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nood_envelop_route` FOREIGN KEY (`route_ID`) REFERENCES `tbl_route` (`route_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nood_envelop_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_open_nood_envelop`
--
ALTER TABLE `tbl_open_nood_envelop`
  ADD CONSTRAINT `fk_onood_envelop_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_onood_envelop_id` FOREIGN KEY (`nood_envelop_ID`) REFERENCES `tbl_nood_envelop` (`nood_envelop_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_onood_envelop_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_nood_envelop_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_nood_envelop_group_id` FOREIGN KEY (`group_ID`) REFERENCES `tbl_groups` (`group_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_open_vragen`
--
ALTER TABLE `tbl_open_vragen`
  ADD CONSTRAINT `fk_open_vragen_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_route` FOREIGN KEY (`route_ID`) REFERENCES `tbl_route` (`route_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_open_vragen_antwoorden`
--
ALTER TABLE `tbl_open_vragen_antwoorden`
  ADD CONSTRAINT `fk_open_vragen_antwoorden_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_antwoorden_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_antwoorden_group_id` FOREIGN KEY (`group_ID`) REFERENCES `tbl_groups` (`group_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_antwoorden_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_open_vragen_antwoorden_vragen_id` FOREIGN KEY (`open_vragen_ID`) REFERENCES `tbl_open_vragen` (`open_vragen_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_posten`
--
ALTER TABLE `tbl_posten`
  ADD CONSTRAINT `fk_posten_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_posten_event_name` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_posten_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_post_passage`
--
ALTER TABLE `tbl_post_passage`
  ADD CONSTRAINT `fk_post_passage_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_passage_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_passage_group_name` FOREIGN KEY (`group_ID`) REFERENCES `tbl_groups` (`group_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_passage_post_id` FOREIGN KEY (`post_ID`) REFERENCES `tbl_posten` (`post_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_passage_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_qr`
--
ALTER TABLE `tbl_qr`
  ADD CONSTRAINT `fk_qr_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_route` FOREIGN KEY (`route_ID`) REFERENCES `tbl_route` (`route_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_qr_check`
--
ALTER TABLE `tbl_qr_check`
  ADD CONSTRAINT `fk_qr_check_create_user` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_check_qr_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_check_qr_group_id` FOREIGN KEY (`group_ID`) REFERENCES `tbl_groups` (`group_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_check_qr_id` FOREIGN KEY (`qr_ID`) REFERENCES `tbl_qr` (`qr_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr_check_update_user` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD CONSTRAINT `fk_route_create_user_name` FOREIGN KEY (`create_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_route_event_id` FOREIGN KEY (`event_ID`) REFERENCES `tbl_event_names` (`event_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_route_update_user_name` FOREIGN KEY (`update_user_ID`) REFERENCES `tbl_users` (`user_ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
