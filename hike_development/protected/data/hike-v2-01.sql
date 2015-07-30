-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2015 at 09:10 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bonuspunten`
--

INSERT INTO `tbl_bonuspunten` (`bouspunten_ID`, `event_ID`, `date`, `post_ID`, `group_ID`, `omschrijving`, `score`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(2, 6, NULL, NULL, 4, 'testasd', NULL, '2015-07-07 07:25:46', 2, '2015-07-07 07:25:46', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_deelnemers_event`
--

INSERT INTO `tbl_deelnemers_event` (`deelnemers_ID`, `event_ID`, `user_ID`, `rol`, `group_ID`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 1, 1, 1, NULL, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(2, 1, 2, 3, 1, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(3, 1, 3, 3, 2, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(4, 2, 1, 1, NULL, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(5, 2, 2, 3, 3, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(6, 2, 3, 3, 4, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(7, 3, 1, 1, NULL, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(8, 3, 2, 3, 5, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1),
(9, 3, 3, 3, 6, '2014-08-25 12:49:00', 1, '2014-08-25 12:49:00', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_names`
--

INSERT INTO `tbl_event_names` (`event_ID`, `event_name`, `start_date`, `end_date`, `status`, `active_day`, `max_time`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 'opstart', '2014-09-05', '2014-09-06', 1, NULL, NULL, '2014-08-25 12:47:51', 1, '2015-07-28 16:03:11', 2),
(2, 'introductie', '2015-02-25', '2015-03-31', 2, NULL, NULL, '2015-02-23 19:45:17', 2, '2015-02-23 19:45:17', 2),
(3, 'gestart', '2015-02-25', '2015-02-29', 3, '2015-02-27', '12:00:00', '2015-02-23 19:46:08', 2, '2015-07-10 14:36:10', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_friend_list`
--

INSERT INTO `tbl_friend_list` (`friend_list_ID`, `user_ID`, `friends_with_user_ID`, `status`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 1, 2, 2, '2015-01-26 13:14:37', 2, '2015-01-26 13:14:37', 2),
(2, 1, 3, 2, '2015-01-26 13:14:37', 2, '2015-01-26 13:14:37', 2),
(3, 2, 1, 2, '2015-01-26 13:14:37', 2, '2015-01-26 13:14:37', 2),
(4, 2, 3, 2, '2015-01-26 13:14:37', 2, '2015-01-26 13:14:37', 2),
(5, 3, 1, 2, '2015-01-26 13:14:37', 2, '2015-01-26 13:14:37', 2),
(6, 3, 2, 2, '2015-01-26 13:14:37', 2, '2015-01-26 13:14:37', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`group_ID`, `group_name`, `event_ID`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 'groep A opstart', 1, '2014-08-25 21:44:36', 2, '2014-08-31 11:48:15', 2),
(2, 'groep B opstart', 1, '2014-08-25 21:44:52', 2, '2014-08-31 11:47:46', 2),
(3, 'groep A introductie', 2, '2014-08-25 21:45:04', 2, '2014-08-31 21:42:09', 2),
(4, 'groep B introductie', 2, '2014-08-25 21:45:17', 2, '2014-08-31 11:48:00', 2),
(5, 'groep A gestart', 3, '2014-08-25 21:45:44', 2, '2014-08-31 11:47:11', 2),
(6, 'groep B gestart', 3, '2014-08-31 11:48:30', 2, '2014-09-04 20:52:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m131112_211037_hike_tables', 1420373075);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nood_envelop`
--

INSERT INTO `tbl_nood_envelop` (`nood_envelop_ID`, `nood_envelop_name`, `event_ID`, `route_ID`, `nood_envelop_volgorde`, `coordinaat`, `opmerkingen`, `score`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(4, ' ''Coördinaat startpunt van "Niet te doen"''', 6, 26, 2040, '190971, 417461', 'Je had uit de richting van  300 graden moeten komen', 5, '2014-08-30 11:30:06', 2, '2014-08-30 11:30:06', 2),
(5, ' ''Coördinaat eerste punt van "Good old..."''', 6, 25, 2030, '190319, 418016', 'Je had moeten komen vanuit de richting 325 graden. ', 5, '2014-08-30 11:31:31', 2, '2014-08-30 11:31:31', 2),
(6, ' ''Coördinaat eerste kruispunt van "Kruispuntjepuzzelen"''', 6, 27, 2050, '191934, 416899', 'Je had uit de richting van  300 graden moeten komen', 5, '2014-08-30 11:36:53', 2, '2014-08-30 11:36:53', 2),
(7, ' ''Coordinaat eerste punt van "Evert, bedankt!"''', 6, 28, 2065, '192056, 416942', 'Je had uit de richting van  200 graden moeten komen', 5, '2014-08-30 12:31:38', 2, '2014-08-30 12:31:38', 2),
(8, 'Coördinaat eerste punt van de eerste Origami', 6, 29, 2070, '193174, 417140', 'Start met de eerste richting op dit punt. ', 5, '2014-08-30 12:34:46', 2, '2014-08-30 12:34:46', 2),
(9, 'Coördinaat eerste punt van de tweede Origami', 6, 29, 2075, '193466, 416919', 'Schiet het eerste richting vanaf dit punt. ', 5, '2014-08-30 12:36:43', 2, '2014-08-30 12:36:43', 2),
(10, ' ''Coördinaat punt van "Tja"''', 6, 30, 2080, '194208, 416799', 'Spreekt voor zich', 5, '2014-08-30 12:39:00', 2, '2014-08-30 12:39:00', 2),
(11, ' ''Coördinaat van startpunt van "Kruispeiling"''', 6, 31, 2090, '194348, 416803', 'geen', 5, '2014-08-30 12:51:26', 2, '2014-08-30 12:51:26', 2),
(12, ' ''Coördinaat van startpunt "Even die grijze massa aanzwengelen" ''', 6, 32, 2100, '194533, 417343', 'geen', 5, '2014-08-30 12:53:36', 2, '2014-08-30 12:53:36', 2),
(13, ' ''Coordinaat van het startpunt van "We want more,  we want more"''', 6, 33, 2110, '194465, 418060', 'geen', 5, '2014-08-30 13:02:15', 2, '2014-08-30 13:02:15', 2),
(14, ' ''Coordinaat eerste punt van "Stadswandeling"''', 6, 16, 1020, '187544, 428947', 'Je had uit de richting van 20 graden moeten komen', 5, '2014-08-30 13:20:39', 2, '2014-08-30 13:20:39', 2),
(15, ' ''Coordinaat eerste punt van "Kan het makkelijker" ''', 6, 17, 1030, '187636, 428722', 'Je had uit de richting van 40 graden moeten komen', 5, '2014-08-30 13:23:25', 2, '2014-08-30 13:23:25', 2),
(16, ' ''Coördinaat van het startpunt van "En vraag niet naar de weg"''', 6, 18, 1040, '187502, 428700', 'geen', 5, '2014-08-30 13:28:16', 2, '2014-08-30 13:28:16', 2),
(17, ' ''Coördinaat van het startpunt van "Meneer van Dalen wacht op antwoord"''', 6, 19, 1050, '187361, 428634', 'geen', 5, '2014-08-30 13:30:19', 2, '2015-07-17 16:09:21', 2),
(19, ' ''Coördinaat van het startpunt van "Je gaat het pas zien als je het door hebt"''', 6, 21, 1070, '189154, 420264', 'geen', 5, '2014-08-30 13:39:16', 2, '2014-08-30 13:39:16', 2),
(20, ' ''Coördinaat van het startpunt van "In Vogelvlucht"''', 6, 22, 1085, '189239, 419691', 'geen', 5, '2014-08-30 13:53:12', 2, '2014-08-30 13:55:54', 2),
(21, ' ''Coördinaat van het startpunt van "Homerun"''', 6, 40, 1090, '189306, 418952', 'Ga richting 190* Dit is de richting van de pijl bij de getekende kruising bij deel 8.', 5, '2014-08-30 14:09:19', 2, '2014-08-30 14:09:19', 2),
(22, ' ''Coördinaat van het startpunt van "Er zit muziek in de lucht"''', 6, 34, 2120, '194562, 418702', 'ga NO richting', 5, '2014-08-30 14:21:27', 2, '2014-08-30 14:21:27', 2),
(23, ' ''Coördinaat van het startpunt van "Rosetta"''', 6, 35, 2135, '193626, 419819', 'Ga richting 317 graden', 5, '2014-08-30 14:24:27', 2, '2014-08-30 14:24:27', 2),
(24, ' ''Coördinaat van het startpunt van "Sultan" ''', 6, 36, 2140, '192265, 420239', 'geen', 5, '2014-08-30 14:25:34', 2, '2014-08-30 14:25:34', 2),
(25, ' ''Coördinaat van het startpunt van "Net even anders"''', 6, 37, 2150, '191815, 421139', 'ga richting 327 graden', 5, '2014-08-30 14:28:14', 2, '2014-08-30 14:28:14', 2),
(26, ' ''Coördinaat van startpunt "Aquarellen"''', 6, 38, 2160, '191090, 420920', 'geen', 5, '2014-08-30 14:29:18', 2, '2014-08-30 14:29:18', 2),
(27, ' ''Coordinaat van startpunt "Spiegeltje-spiegeltje aan de.."''', 6, 39, 2170, '189366, 420584', 'geen', 5, '2014-08-30 14:30:36', 2, '2014-08-30 14:30:36', 2),
(28, ' ''Coördinaat van het eindpunt van "Meneer van Dalen wacht op antwoord".''', 6, 19, 1055, '187067, 428300', 'geen', 5, '2014-09-04 21:53:39', 2, '2015-07-17 16:09:21', 2),
(29, ' ''Uitleg routeonderdeel "In vogelvlucht''', 6, 22, 1080, '0000', 'Je moet naar de punaise die onderaan de afbeelding staat. Het coördinaat dat daarbij staat moet je negeren; dat is in Elburg. Grofweg rechtsboven kan je nog een kleine punaise zien. Dat is het eindpunt van routedeel 7.', 2, '2014-09-04 22:15:07', 2, '2014-09-04 22:15:07', 2),
(30, ' ''Uitleg van routeonderdeel "Rosetta"	''', 6, 35, 2130, '00000', 'Doe per opgave eerst wat in het vakje staat. Dit slaat op 1 kruising. Als er twee bolle-pijltjes staan dan moet je die combineren. N en O wordt dus NO. Het dingetje daarnaast gaat in bij de volgende kruising. Dit is een gewone strippenkaart. Lezen van lin', 2, '2014-09-04 22:23:14', 2, '2014-09-04 22:23:14', 2),
(31, ' ''Uitleg van routeonderdeel "Evert,  bedankt!" ''', 6, 20, 2060, '0000', 'Je hoeft deze niet helemaal uit te werken. Je moet een kleuren volgorde van drie de kleuren volgen. Dus eerste groen, de twee andere kleuren en dan weer groen enzenz.', 2, '2014-09-04 22:27:00', 2, '2014-09-04 22:27:00', 2),
(32, ' ''Uitleg van routeonderdeel "Even die grijze massa aanzwengelen" ''', 6, 32, 2105, '0000', 'Op deze site staat uitgelegd hoe je het kruispunt van twee snijdende lijnen kan berekenen:  http://www.esri.nl/technische-artikelen/twee-snijdende-lijnen-wat-het-snijpunt ', 2, '2014-09-04 22:32:55', 2, '2014-09-04 22:32:55', 2),
(33, ' ''Hint voor op het eindpunt van "Meneer van Dalen wacht op antwoord"''', 6, 19, 1059, '0000', 'Er hangen treinkaartje op of bij het huisregeldbord.', 2, '2014-09-05 08:33:58', 2, '2014-09-05 08:33:58', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_open_nood_envelop`
--

INSERT INTO `tbl_open_nood_envelop` (`open_nood_envelop_ID`, `nood_envelop_ID`, `event_ID`, `group_ID`, `opened`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 14, 6, 9, 1, '2014-09-05 21:03:04', 35, '2014-09-05 21:03:04', 35),
(2, 14, 6, 6, 1, '2014-09-05 21:43:15', 26, '2014-09-05 21:43:15', 26),
(3, 17, 6, 8, 1, '2014-09-05 22:55:27', 29, '2014-09-05 22:55:27', 29),
(4, 29, 6, 6, 1, '2014-09-06 01:27:51', 27, '2014-09-06 01:27:51', 27),
(5, 20, 6, 8, 1, '2014-09-06 01:32:51', 29, '2014-09-06 01:32:51', 29),
(6, 29, 6, 8, 1, '2014-09-06 01:39:38', 29, '2014-09-06 01:39:38', 29),
(7, 29, 6, 9, 1, '2014-09-06 01:54:23', 35, '2014-09-06 01:54:23', 35),
(8, 10, 6, 9, 1, '2014-09-06 14:51:16', 35, '2014-09-06 14:51:16', 35),
(9, 22, 6, 5, 1, '2014-09-06 16:35:31', 25, '2014-09-06 16:35:31', 25),
(10, 13, 6, 7, 1, '2014-09-06 17:34:20', 20, '2014-09-06 17:34:20', 20),
(11, 24, 6, 8, 1, '2014-09-06 17:39:14', 29, '2014-09-06 17:39:14', 29),
(12, 22, 6, 7, 1, '2014-09-06 17:41:45', 20, '2014-09-06 17:41:45', 20),
(13, 30, 6, 7, 1, '2014-09-06 20:44:39', 21, '2014-09-06 20:44:39', 21),
(14, 24, 6, 9, 1, '2014-09-06 21:19:05', 35, '2014-09-06 21:19:05', 35),
(15, 27, 6, 6, 1, '2014-09-06 21:41:17', 26, '2014-09-06 21:41:17', 26);

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_open_vragen`
--

INSERT INTO `tbl_open_vragen` (`open_vragen_ID`, `open_vragen_name`, `event_ID`, `route_ID`, `vraag_volgorde`, `omschrijving`, `vraag`, `goede_antwoord`, `score`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(14, 'Info bord', 6, 25, 203, 'Locatie: voor hek halverwege de strippenkaart ', 'Waar is het voormalig landgoed beroemd om volgens het bord? ', 'bronbeekjes', 3, '2014-08-25 22:09:39', 2, '2014-09-05 10:55:13', 2),
(15, 'Bankje voor...', 6, 26, 204, 'Locatie: Bij tweede haakse bocht naar rechts. ', 'Bij een van de twee haakse bochten in het oleaat staat een bankje. Ter nagedachtenis aan wie  is deze neergezet? ', 'Frans baron van Verschuer ', 3, '2014-08-25 22:11:30', 2, '2014-08-28 21:05:07', 2),
(16, 'Papier-mache', 6, 27, 205, 'Locatie: bij laatste kruising, die bij de watermolen. ', ' ''Wanneer is de "papier fabriek" gebouwd? ''', '1725.', 3, '2014-08-25 22:13:24', 2, '2014-09-05 11:12:18', 2),
(17, 'Nenenenenenenenene......', 6, 28, 206, 'Locatie: bij vleermuis ', 'Op het bord staat een foto van een dier dat ’s avonds insecten vangt. Wat is de naam van dit  dier?', 'Franjestaart', 3, '2014-08-25 22:14:40', 2, '2014-08-28 21:05:42', 2),
(18, 'De koeien hebben staarten.', 6, 29, 207, 'locatie. Eind zeven/begin acht. ', 'Hoe hoog is de berg? ', '67meter ', 3, '2014-08-25 22:16:59', 2, '2014-09-05 10:56:11', 2),
(27, 'Fahrrad Knoten Punkt', 6, 32, 210, 'Locatie: bij Grafwegen, uitkomst opgave bij Routedeel 10.', 'Wat is het nummer van het fietsknooppunt waar je op uitkomt? ', '79 ', 3, '2014-08-28 21:12:50', 2, '2014-08-28 21:12:50', 2),
(28, ' ‘Men’s barber’', 6, 15, 102, 'Locatie: start van de route ', 'Hoe heet de ‘Men’s barber’ op de hoek? ', 'Jan de Vos', 3, '2014-08-30 10:08:06', 2, '2015-07-17 15:53:25', 2),
(29, 'ouwe shit', 6, 15, 101, 'Locatie: ‘glashuis’ kapel einde van het doolhof ', ' Rond wanneer is de oorspronkelijke ‘glashuis’ kapel gesticht? ', ' rond 1400', 3, '2014-08-30 10:12:55', 2, '2015-07-17 15:53:25', 2),
(30, 'Proost', 6, 16, 102, 'Locatie: bij het de waag plein ', 'Je loopt langs de oudste van Nijmegen met een houten gevel, hoe heet deze? ', 'Cafe in de Blaauwe Hand ', 3, '2014-08-30 10:15:36', 2, '2014-08-30 10:15:36', 2),
(31, 'Lopen jullie nu al achter?!', 6, 17, 103, 'Locatie: bij de tweede kruising ', 'Achter wat loop je? ', 'straatnaam is: Achter Valburg ', 4, '2014-08-30 10:16:54', 2, '2015-02-23 17:04:26', 2),
(32, 'Als je het maar niet verschiet', 6, 18, 104, 'Locatie: Toren in het kronenburgerpark ', 'Hoe heet de toren? ', 'De kruittoren ', 3, '2014-08-30 10:18:17', 2, '2014-08-30 10:18:17', 2),
(33, 'bejaarden', 6, 27, 205, 'Locatie: twee bankjes net voor kruising watermolen langs de weg ', 'hoe oud zijn Olga Kühn en John Clarke samen geworden ', '154', 3, '2014-08-30 10:24:23', 2, '2014-08-30 10:24:23', 2),
(34, 'snake', 6, 34, 212, 'Locatie: Bij eerste of tweede rechtdoor. Niet ver vanaf eindpunt van routedeel 10 ', ' Welke slangachtige staat rechtsonder op het bord? ', 'Ringslang ', 3, '2014-08-30 10:46:37', 2, '2014-08-30 10:46:37', 2),
(35, 'Is de goedkoopste niet goed?!?', 6, 35, 213, 'Locatie: Na noordwest te zijn gegaan bij onderdeel 3. ', 'In het tankstation langs de provinciale weg kun je hele goede olie kopen. Wat is het eerste  merk als je kiest voor personenwagens via Merk en Type? ', 'Abarth', 3, '2014-08-30 10:47:41', 2, '2014-08-30 10:47:41', 2),
(36, 'speedlimit', 6, 36, 214, 'Locatie: aan begin Schietbaan aan de autoweg ‘Rijlaan’. Het is de max snelheid voor auto op de  schietbaan. ', ' Bij rood-witte slagboom staat een verkeersbord. Hoe hard mogen auto’s hier? ', '30', 3, '2014-08-30 10:48:24', 2, '2014-08-30 10:48:24', 2),
(37, 'Een stukje proza...', 6, 37, 215, 'Locatie: Op plek waar lopers afdalen naar de spoorlijn. ', 'Je komt langs een grote steen met daarop een gedicht. Wie heeft dit gedicht geschreven? ', 'P.J.M. van Stokkum', 3, '2014-08-30 10:50:20', 2, '2014-08-30 10:50:20', 2),
(38, 'Knooppunt', 6, 38, 216, 'Op plek waar lopers de autoweg (Bisseltsebaan) oversteken', 'Wat is het nummer van het fietsknooppunt? ', '33', 3, '2014-08-30 10:51:16', 2, '2014-08-30 10:51:16', 2),
(39, 'Makkie', 6, 41, 1, 'geen', 'Waar staat RD-coordinaten voor?', 'Rijksdriehoekscoördinaten', 1, '2014-08-31 12:34:54', 2, '2015-07-07 21:22:29', 2),
(40, 'Nog zo''n makkie', 6, 41, 2, 'Zou er een reden zijn waarom er vragen zijn over RD?!?', 'Wat is het centrale punt van RD-coordinaten en wat zijn daar de coordinaten van?', 'De spits van de Onze Lieve Vrouwetoren (''Lange Jan'') in Amersfoort. 155 000, 463 000.', 2, '2014-08-31 12:46:11', 2, '2015-07-07 21:22:30', 2),
(41, 'rdmd544', 6, 41, 3, 'Dit is het startpunt voor vrijdagavond', 'Het startpunt ligt op:  31fefc0e570cb3860f2a6d4b38c6490d – 8638096e4ddb49a0dd6592c57d9f50ab, 75fc093c0ee742f6dddaa13fff98f104 – bf97f24695f24fac060bc44b4e97acc1 Waar is dit?', ' rd coordinaat: 187–099, 429–046', 5, '2014-08-31 12:48:53', 2, '2015-02-23 16:57:02', 2),
(42, 'Oleaat Introductie', 6, 41, 4, 'geen', 'Op de eerste pagina staat een link naar een oleaat. Van waar, naar waar gaat dit oleaat?', 'Van het Slot naar de Dom', 3, '2014-09-03 19:49:09', 2, '2015-02-23 15:30:39', 2),
(43, 'Vind je deze lastig? wacht maar tot de hike. ', 6, 41, 5, 'geen', 'Je begint op de Bison, je gaat eerst 1801 meter in de richting van 15,4 graden. Dan ga je 463 meter 290 graden en dan 1895 meter 181,3 graden. Waar kom je dan uit?', 'De zelfde plek, de Bison (146582, 454941)', 3, '2014-09-03 19:51:06', 2, '2015-02-23 15:30:39', 2),
(44, 'ldgsdf', 10, 46, 1, 'dfgsdfg', 'dfgds?', '!!', 3, '2015-07-12 18:36:02', 2, '2015-07-12 18:51:21', 2),
(45, 'asdasdf', 10, 46, 2, 'asdfsadf', 'sadf', 'asdfasdf', 66, '2015-07-12 18:51:07', 2, '2015-07-12 18:51:21', 2),
(46, 'test', 6, 41, 6, 'SFDAD', 'SADFSADF', 'ASDFASDF', 2, '2015-07-13 10:16:47', 2, '2015-07-13 10:16:47', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_open_vragen_antwoorden`
--

INSERT INTO `tbl_open_vragen_antwoorden` (`open_vragen_antwoorden_ID`, `open_vragen_ID`, `event_ID`, `group_ID`, `antwoord_spelers`, `checked`, `correct`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(3, 39, 6, 5, 'Rijksdriehoekscoördinaten', 1, 1, '2014-08-31 13:46:28', 25, '2014-08-31 13:48:55', 2),
(4, 40, 6, 5, ' ''de spits van de Onze Lieve Vrouwetoren (''''Lange Jan'''') in Amersfoort. Met coördinaten x = 155 000,  y = 463 000.''', 1, 1, '2014-08-31 13:49:10', 25, '2014-08-31 13:50:22', 2),
(5, 39, 6, 6, 'Rijksdriehoekscoördinaten', 1, 1, '2014-08-31 14:19:14', 26, '2014-08-31 14:19:31', 2),
(6, 40, 6, 6, ' ''Het centrale punt van het stelsel is de spits van de Onze Lieve Vrouwetoren (''''Lange Jan'''') in Amersfoort. Dit punt heeft de coördinaten x = 155 000,  y = 463 000.''', 1, 1, '2014-08-31 14:24:03', 26, '2014-08-31 14:28:43', 2),
(7, 39, 6, 4, 'rijksdriehoekscoördinaten', 1, 1, '2014-08-31 14:36:25', 17, '2014-08-31 15:35:21', 5),
(8, 40, 6, 4, 'Onze Lieve Vrouwetoren Amersfoort', 1, 1, '2014-08-31 14:37:22', 17, '2014-08-31 15:35:24', 5),
(9, 39, 6, 8, 'Rijksdriehoekscoördinaten', 1, 1, '2014-08-31 14:56:36', 30, '2014-08-31 15:35:03', 5),
(10, 40, 6, 8, 'Onze Lieve Vrouwetoren Amersfoort (coördinaten (+155 000 m +463 000 m))', 1, 1, '2014-08-31 15:10:18', 30, '2014-08-31 15:35:08', 5),
(11, 39, 6, 7, 'Rijksdriehoekscoördinaten', 1, 1, '2014-08-31 15:27:39', 20, '2014-08-31 15:35:12', 5),
(12, 40, 6, 7, 'Onze Lieve Vrouwetoren Amersfoort (coördinaten (+155 000 m +463 000 m))	', 1, 1, '2014-08-31 15:28:58', 20, '2014-08-31 15:35:17', 5),
(13, 41, 6, 7, ' ''187-099, 429-046,  is de waalhaven bij Nijmegen (51.84907,  5.85306)''\r\n', 1, 1, '2014-08-31 15:43:12', 20, '2014-08-31 18:29:42', 5),
(14, 41, 6, 8, ' ''187099,  429046 rd,  waalbandijk 81''\r\n', 1, 1, '2014-08-31 16:09:20', 36, '2014-08-31 17:03:23', 5),
(15, 41, 6, 6, ' ''x = 187099 m,  y = 429046 m (Waalbandijk 81 te Nijmegen)''', 1, 1, '2014-08-31 16:52:40', 26, '2014-08-31 17:03:36', 5),
(16, 41, 6, 4, 'Waalbandijk Nijmegen', 1, 1, '2014-08-31 17:17:04', 17, '2014-08-31 23:30:16', 5),
(17, 41, 6, 5, ' ''RD coördinaat:187099,  429046 googlemaps coördinaat:N 51 50 56.6,  E 5 51 11.0 startpunt:tussen de Waalbandijk  Voorstadslaan en Simon langendampad in Nijmegen''\r\n', 1, 1, '2014-09-01 12:45:06', 25, '2014-09-01 12:55:48', 2),
(18, 43, 6, 7, 'op de Bison', 1, 1, '2014-09-03 23:18:28', 20, '2014-09-03 23:36:47', 5),
(19, 39, 6, 9, 'Rijksdriehoekscoördinaten', 1, 1, '2014-09-04 07:19:51', 35, '2014-09-04 07:20:09', 5),
(20, 40, 6, 9, ' ''Het centrale punt van het stelsel is de spits van de Onze Lieve Vrouwetoren (''''Lange Jan'''') in Amersfoort. Daarom wordt ook wel gesproken van Amersfoortcoördinaten. Dit punt heeft de coördinaten x = 155 000,  y = 463 000.''', 1, 1, '2014-09-04 07:20:44', 35, '2014-09-04 07:25:24', 5),
(21, 41, 6, 9, ' ''Nijmegen,  bij de Waalhaven''', 1, 1, '2014-09-04 07:31:04', 35, '2014-09-04 07:34:49', 5),
(22, 43, 6, 8, 'De Bison(zelfde plek)', 1, 1, '2014-09-04 12:12:00', 30, '2014-09-04 20:47:40', 2),
(23, 43, 6, 6, 'op De Bison', 1, 1, '2014-09-04 17:17:55', 26, '2014-09-04 20:47:43', 2),
(24, 43, 6, 4, 'Je komt weer terug bij de Bison', 1, 1, '2014-09-04 20:08:45', 17, '2014-09-04 20:47:48', 2),
(25, 43, 6, 5, 'Op de Bison', 1, 1, '2014-09-04 20:52:17', 25, '2014-09-04 21:56:03', 5),
(26, 42, 6, 5, 'Oleaat is tussen de Dom en de voorkant van het Slot Zeist', 1, 1, '2014-09-04 21:49:42', 25, '2014-09-04 21:56:00', 5),
(27, 28, 6, 7, 'Jan de Vos', 1, 1, '2014-09-05 19:29:14', 20, '2014-09-05 19:48:29', 2),
(28, 28, 6, 9, 'Jan de Vos', 1, 1, '2014-09-05 19:51:06', 35, '2014-09-05 19:53:24', 2),
(29, 29, 6, 7, '15e eeuw', 1, 1, '2014-09-05 20:07:50', 20, '2014-09-05 20:11:51', 2),
(30, 29, 6, 9, 'Rond 1400', 1, 1, '2014-09-05 20:12:09', 35, '2014-09-05 20:17:09', 2),
(31, 30, 6, 7, 'Bakker Arend', 1, 0, '2014-09-05 20:25:12', 21, '2014-09-05 20:26:58', 2),
(32, 28, 6, 4, 'Jan de Vos', 1, 1, '2014-09-05 20:25:29', 17, '2014-09-05 20:26:42', 2),
(33, 29, 6, 8, 'rond 1400', 1, 1, '2014-09-05 20:37:36', 29, '2014-09-05 20:37:58', 2),
(34, 28, 6, 8, 'Jan de Vos', 1, 1, '2014-09-05 20:43:58', 29, '2014-09-05 20:44:30', 2),
(35, 31, 6, 7, 'Valburg', 1, 1, '2014-09-05 20:49:14', 20, '2014-09-05 20:52:55', 2),
(36, 30, 6, 5, 'café in de blaauwe hand', 1, 1, '2014-09-05 20:49:51', 25, '2014-09-05 20:52:45', 2),
(37, 30, 6, 8, 'de blaauwe hand', 1, 1, '2014-09-05 20:55:43', 29, '2014-09-05 21:01:20', 2),
(38, 28, 6, 5, 'Jan de Vos', 1, 1, '2014-09-05 20:58:37', 25, '2014-09-05 21:01:23', 2),
(39, 29, 6, 5, '1438', 1, 1, '2014-09-05 21:03:34', 25, '2014-09-05 21:05:16', 2),
(40, 28, 6, 6, 'Jan de Vos', 1, 1, '2014-09-05 21:06:54', 26, '2014-09-05 21:11:04', 2),
(41, 32, 6, 7, 'Kruittoren', 1, 1, '2014-09-05 21:11:31', 20, '2014-09-05 21:17:26', 2),
(42, 31, 6, 5, 'Achter Valburg', 1, 1, '2014-09-05 21:16:37', 25, '2014-09-05 21:17:28', 2),
(43, 31, 6, 8, 'achter valburg', 1, 1, '2014-09-05 21:23:09', 29, '2014-09-05 21:25:10', 2),
(44, 32, 6, 5, 'Kronenburgertoren', 1, 1, '2014-09-05 21:24:45', 25, '2014-09-05 21:35:59', 2),
(45, 32, 6, 8, 'kronenburgertoren', 1, 1, '2014-09-05 21:28:48', 29, '2014-09-05 21:35:29', 2),
(46, 29, 6, 6, '1400', 1, 1, '2014-09-05 21:33:27', 26, '2014-09-05 21:37:14', 2),
(47, 29, 6, 4, 'rond 1400', 1, 1, '2014-09-05 21:37:53', 32, '2014-09-05 21:38:46', 2),
(48, 30, 6, 9, 'Cafe in de blauwe hand', 1, 1, '2014-09-05 21:42:09', 35, '2014-09-05 21:52:58', 2),
(49, 30, 6, 4, 'cafe in de blaauwe hand', 1, 1, '2014-09-05 22:00:15', 32, '2014-09-05 22:02:39', 2),
(50, 32, 6, 9, 'Kronenburgertoren', 1, 1, '2014-09-05 22:05:17', 35, '2014-09-05 22:07:19', 2),
(51, 30, 6, 6, 'cafe in de blaauwe hand', 1, 1, '2014-09-05 22:06:35', 27, '2014-09-05 22:07:23', 2),
(52, 32, 6, 6, 'kronenburger toren', 1, 1, '2014-09-05 22:26:47', 27, '2014-09-05 22:27:43', 2),
(53, 31, 6, 6, 'het kronenburgerpark', 1, 0, '2014-09-05 22:28:43', 27, '2014-09-05 22:56:11', 2),
(54, 31, 6, 4, 'valburg', 1, 1, '2014-09-05 22:41:39', 32, '2014-09-05 22:56:19', 2),
(55, 32, 6, 4, 'kruittoren', 1, 1, '2014-09-05 22:53:21', 32, '2014-09-05 22:56:34', 2),
(56, 14, 6, 6, 'om zijn bronbeekjes', 1, 1, '2014-09-06 10:12:00', 27, '2014-09-06 11:01:41', 5),
(57, 15, 6, 6, 'Frans baron Van Verschuer', 1, 1, '2014-09-06 10:24:22', 27, '2014-09-06 11:01:25', 5),
(58, 14, 6, 7, 'zijn bronbeekjes', 1, 1, '2014-09-06 10:35:21', 21, '2014-09-06 11:01:11', 5),
(59, 14, 6, 4, 'bronbeekjes', 1, 1, '2014-09-06 10:43:47', 32, '2014-09-06 11:01:52', 5),
(60, 14, 6, 5, 'bekent om de slag bij mookerheide', 1, 0, '2014-09-06 11:12:27', 25, '2014-09-06 11:19:22', 5),
(61, 15, 6, 5, 'Frans baron van verschuer', 1, 1, '2014-09-06 11:18:05', 25, '2014-09-06 11:19:06', 5),
(62, 16, 6, 6, '1725', 1, 1, '2014-09-06 11:18:34', 27, '2014-09-06 11:18:48', 5),
(63, 14, 6, 8, 'om zijn bronbeekjes', 1, 1, '2014-09-06 11:22:18', 29, '2014-09-06 11:26:30', 5),
(64, 15, 6, 7, 'Frans baron Van Verschuer', 1, 1, '2014-09-06 11:23:09', 21, '2014-09-06 11:26:47', 5),
(65, 15, 6, 4, 'Frans baron Van Verschuer', 1, 1, '2014-09-06 11:34:28', 32, '2014-09-06 11:58:41', 2),
(66, 15, 6, 8, 'Frans baron Van Verschuer', 1, 1, '2014-09-06 11:40:20', 29, '2014-09-06 11:45:17', 5),
(67, 14, 6, 9, 'Slag om De Mokerheide', 1, 0, '2014-09-06 11:51:42', 35, '2014-09-06 11:53:55', 5),
(68, 15, 6, 9, 'Wethouder Verschuur', 1, 1, '2014-09-06 11:53:09', 35, '2014-09-06 11:53:48', 5),
(69, 16, 6, 9, '1725', 1, 1, '2014-09-06 11:54:00', 35, '2014-09-06 11:57:02', 5),
(70, 16, 6, 7, '1725', 1, 1, '2014-09-06 11:59:41', 21, '2014-09-06 12:12:29', 5),
(71, 16, 6, 5, ' ''exact jaartal is onbekend vermoedelijk 15de eeuw. op de gevel staat 1725,  maar is een verbouwing jaartal''', 1, 1, '2014-09-06 12:02:08', 25, '2014-09-06 12:10:14', 5),
(72, 33, 6, 7, '154', 1, 1, '2014-09-06 12:11:57', 21, '2014-09-06 12:15:01', 5),
(73, 16, 6, 4, '1725', 1, 1, '2014-09-06 12:28:16', 32, '2014-09-06 12:30:20', 2),
(74, 17, 6, 7, 'Franjestaart', 1, 1, '2014-09-06 12:44:03', 21, '2014-09-06 12:52:37', 5),
(75, 17, 6, 5, ' ''grootoorvleesmuis,  watervleesmuis,  franjestaart''\r\n', 1, 0, '2014-09-06 12:54:06', 25, '2014-09-06 12:57:04', 5),
(76, 17, 6, 4, 'De Franjestaart (vleermuis)', 1, 1, '2014-09-06 12:56:53', 32, '2014-09-06 13:04:20', 2),
(77, 33, 6, 9, '154', 1, 1, '2014-09-06 12:58:07', 35, '2014-09-06 13:03:55', 2),
(78, 18, 6, 7, '66 meter', 1, 1, '2014-09-06 13:10:56', 21, '2014-09-06 13:26:34', 2),
(79, 16, 6, 8, '1725', 1, 1, '2014-09-06 13:18:34', 29, '2014-09-06 13:26:14', 2),
(80, 17, 6, 9, 'franjestaart', 1, 1, '2014-09-06 13:40:13', 35, '2014-09-06 14:08:06', 4),
(81, 18, 6, 4, '67 meter', 1, 1, '2014-09-06 13:45:50', 32, '2014-09-06 14:08:03', 4),
(82, 17, 6, 8, 'franjestaart', 1, 1, '2014-09-06 13:47:51', 29, '2014-09-06 14:13:25', 2),
(83, 18, 6, 5, ' ''De Kiekberg 80,  de Maartensberg 67 en de Sint-Jansberg 55 meter hoog''', 1, 0, '2014-09-06 14:01:28', 25, '2014-09-06 14:14:09', 2),
(84, 27, 6, 5, '79', 1, 1, '2014-09-06 14:32:40', 25, '2014-09-06 15:02:16', 2),
(85, 27, 6, 4, '79', 1, 1, '2014-09-06 15:36:34', 32, '2014-09-06 15:58:48', 5),
(86, 18, 6, 9, '55 meter', 1, 0, '2014-09-06 15:42:24', 35, '2014-09-06 15:57:58', 5),
(87, 17, 6, 6, 'Franjestaart', 1, 1, '2014-09-06 15:54:46', 27, '2014-09-06 15:59:06', 5),
(88, 18, 6, 6, '67 meter Sintmaartensberg', 1, 1, '2014-09-06 15:55:34', 27, '2014-09-06 15:58:33', 5),
(89, 27, 6, 6, '79 Grafwegen', 1, 1, '2014-09-06 15:56:46', 27, '2014-09-06 15:58:05', 5),
(90, 34, 6, 6, 'Ringslang', 1, 1, '2014-09-06 16:32:24', 26, '2014-09-06 16:51:27', 2),
(91, 27, 6, 9, '79', 1, 1, '2014-09-06 17:07:56', 35, '2014-09-06 17:24:42', 2),
(92, 34, 6, 4, 'ringslang', 1, 1, '2014-09-06 17:19:36', 17, '2014-09-06 17:24:57', 2),
(93, 34, 6, 5, 'ringslang', 1, 1, '2014-09-06 18:08:27', 25, '2014-09-06 18:25:13', 2),
(94, 34, 6, 9, 'ringslang', 1, 1, '2014-09-06 19:38:17', 35, '2014-09-06 19:50:35', 2),
(95, 35, 6, 4, 'Abarth', 1, 1, '2014-09-06 19:44:59', 17, '2014-09-06 20:04:09', 2),
(96, 35, 6, 5, 'Abarth', 1, 1, '2014-09-06 19:50:28', 25, '2014-09-06 19:51:01', 2),
(97, 36, 6, 4, '30 km per uur', 1, 1, '2014-09-06 20:20:20', 32, '2014-09-06 20:48:50', 4),
(98, 36, 6, 5, '30 km/h', 1, 1, '2014-09-06 20:33:28', 25, '2014-09-06 20:49:02', 4),
(99, 35, 6, 9, 'blue one 95', 1, 0, '2014-09-06 21:07:52', 35, '2014-09-06 21:37:19', 2),
(100, 35, 6, 7, 'Tankstation is dicht', 1, 1, '2014-09-06 21:17:23', 20, '2014-09-06 21:56:22', 5),
(101, 18, 6, 8, '67', 1, 1, '2014-09-06 21:24:54', 29, '2014-09-06 21:32:34', 2),
(102, 33, 6, 8, '164', 1, 0, '2014-09-06 21:30:05', 29, '2014-09-06 21:32:06', 2),
(103, 34, 6, 8, 'ringslang', 1, 1, '2014-09-06 21:32:49', 29, '2014-09-06 21:55:42', 5),
(104, 37, 6, 5, 'P. J. M. van Stokkum', 1, 1, '2014-09-06 21:46:58', 25, '2014-09-06 21:56:12', 5),
(105, 36, 6, 8, '15', 1, 0, '2014-09-06 22:12:57', 37, '2014-09-06 22:33:57', 2),
(106, 37, 6, 4, 'P.J.M. van Stokkum', 1, 1, '2014-09-06 22:15:36', 17, '2014-09-06 22:34:15', 2),
(107, 38, 6, 5, '33', 1, 1, '2014-09-06 22:20:20', 25, '2014-09-06 22:34:07', 2),
(108, 38, 6, 8, '33', 1, 1, '2014-09-06 22:41:40', 37, '2014-09-06 22:48:43', 5),
(109, 36, 6, 6, '30kmh', 1, 1, '2014-09-06 22:42:06', 26, '2014-09-06 22:48:47', 5),
(110, 38, 6, 4, '33', 1, 1, '2014-09-06 22:46:01', 32, '2014-09-06 22:48:57', 5),
(111, 36, 6, 9, '30 km per uur', 1, 1, '2014-09-06 22:47:49', 35, '2014-09-06 22:48:39', 5),
(112, 36, 6, 7, '15', 1, 0, '2014-09-06 23:30:25', 21, '2014-09-06 23:37:56', 2),
(113, 38, 6, 7, '33', 1, 1, '2014-09-06 23:35:45', 21, '2014-09-06 23:37:35', 2),
(114, 37, 6, 6, 'P. J. M. van Stokkum', 1, 1, '2014-09-06 23:47:21', 27, '2014-09-06 23:56:30', 2),
(115, 37, 6, 8, 'J.P stokken', 1, 0, '2014-09-07 00:13:16', 29, '2014-09-07 00:14:57', 4),
(116, 38, 6, 6, '32', 1, 0, '2014-09-07 00:16:47', 27, '2014-09-07 00:47:21', 6),
(117, 27, 6, 8, '23', 1, 0, '2014-09-07 00:36:31', 37, '2014-09-07 00:47:32', 6),
(118, 35, 6, 8, 'Texaco Diesel. ', 1, 0, '2014-09-07 00:40:55', 37, '2014-09-07 00:47:28', 6),
(119, 37, 6, 9, 'PJM van Stokkum', 1, 1, '2014-09-07 01:40:23', 35, '2014-09-07 02:05:23', 4),
(120, 38, 6, 9, '33', 1, 1, '2014-09-07 01:41:33', 35, '2014-09-07 02:05:15', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_posten`
--

INSERT INTO `tbl_posten` (`post_ID`, `post_name`, `event_ID`, `date`, `post_volgorde`, `score`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 'Tijd voor een biertje. ', 6, '2014-09-05', 1, 13, '2014-08-30 10:53:28', 2, '2015-07-15 12:53:08', 2),
(2, 'Een afzakkertje voor het laatste stukje', 6, '2014-09-05', 2, 13, '2014-08-30 10:54:06', 2, '2015-07-15 12:53:08', 2),
(3, 'Je weet maar nooit of we ze nog ergens moeten opvangen...', 6, '2014-09-05', 3, 13, '2014-08-30 10:54:43', 2, '2015-07-13 17:40:59', 2),
(4, 'Nog maar een kopjekoffie om op gang te komen', 6, '2014-09-06', 5, 13, '2014-08-30 10:55:45', 2, '2015-07-15 12:53:16', 2),
(5, 'Tijd voor lunch?', 6, '2014-09-06', 6, 13, '2014-08-30 10:56:19', 2, '2015-07-15 12:53:16', 2),
(6, 'Snacky?', 6, '2014-09-06', 7, 13, '2014-08-30 10:57:09', 2, '2014-08-30 14:38:06', 2),
(7, 'Is het al tijd voor een biertje?', 6, '2014-09-06', 8, 13, '2014-08-30 10:57:38', 2, '2014-08-30 14:38:12', 2),
(8, 'Dinner', 6, '2014-09-06', 10, 13, '2014-08-30 10:59:30', 2, '2015-07-27 12:21:09', 2),
(9, 'test', 6, '2014-09-06', 9, 34, '2015-07-27 12:20:55', 2, '2015-07-27 12:21:09', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post_passage`
--

INSERT INTO `tbl_post_passage` (`posten_passage_ID`, `post_ID`, `event_ID`, `group_ID`, `gepasseerd`, `binnenkomst`, `vertrek`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 1, 6, 5, 1, '2014-09-05 20:47:00', '2014-09-05 20:55:00', '2014-09-05 20:47:54', 6, '2014-09-05 20:50:46', 6),
(2, 1, 6, 8, 1, '2014-09-05 20:55:00', '2014-09-05 20:57:00', '2014-09-05 20:55:34', 6, '2014-09-05 20:57:48', 6),
(3, 1, 6, 7, 1, '2014-09-05 21:38:00', '2014-09-05 22:05:00', '2014-09-05 21:38:56', 6, '2014-09-05 22:05:59', 6),
(4, 1, 6, 9, 1, '2014-09-05 21:40:00', '2014-09-05 21:46:00', '2014-09-05 21:40:43', 6, '2014-09-05 21:53:58', 6),
(5, 1, 6, 4, 1, '2014-09-05 22:01:00', '2014-09-05 22:13:00', '2014-09-05 22:01:17', 6, '2014-09-05 22:13:10', 6),
(6, 1, 6, 6, 1, '2014-09-05 22:01:00', '2014-09-05 22:12:00', '2014-09-05 22:01:45', 6, '2014-09-05 22:12:56', 6),
(7, 2, 6, 5, 1, '2014-09-05 23:31:00', '2014-09-06 00:02:00', '2014-09-05 23:31:55', 2, '2014-09-06 00:02:27', 2),
(8, 2, 6, 4, 1, '2014-09-06 00:44:00', '2014-09-06 01:34:00', '2014-09-06 00:45:20', 2, '2014-09-06 01:34:54', 5),
(9, 2, 6, 8, 1, '2014-09-06 00:45:00', '2014-09-06 01:36:00', '2014-09-06 00:46:18', 2, '2014-09-06 01:36:19', 5),
(10, 2, 6, 6, 1, '2014-09-06 01:01:00', '2014-09-06 01:35:00', '2014-09-06 01:01:40', 5, '2014-09-06 01:35:32', 5),
(11, 3, 6, 5, 1, '2014-09-06 01:03:00', '2014-09-06 10:22:00', '2014-09-06 01:03:48', 2, '2014-09-06 10:22:43', 6),
(12, 2, 6, 9, 1, '2014-09-06 01:08:00', '2014-09-06 01:09:00', '2014-09-06 01:08:35', 5, '2014-09-06 01:10:50', 5),
(13, 2, 6, 7, 1, '2014-09-06 01:31:00', '2014-09-06 01:52:00', '2014-09-06 01:31:36', 5, '2014-09-06 01:52:36', 5),
(14, 3, 6, 7, 1, '2014-09-06 02:58:00', '2014-09-06 09:56:00', '2014-09-06 02:59:02', 2, '2014-09-06 09:56:17', 6),
(15, 3, 6, 8, 1, '2014-09-06 02:59:00', '2014-09-06 10:05:00', '2014-09-06 03:00:35', 2, '2014-09-06 10:05:25', 6),
(16, 3, 6, 9, 1, '2014-09-06 03:11:00', '2014-09-06 09:45:00', '2014-09-06 03:11:17', 2, '2014-09-06 09:45:34', 2),
(17, 3, 6, 6, 1, '2014-09-06 03:25:00', '2014-09-06 09:36:00', '2014-09-06 03:25:48', 2, '2014-09-06 09:36:29', 2),
(18, 3, 6, 4, 1, '2014-09-06 03:28:00', '2014-09-06 10:15:00', '2014-09-06 03:29:21', 2, '2014-09-06 10:15:38', 2),
(19, 4, 6, 6, 1, '2014-09-06 10:58:00', '2014-09-06 10:59:00', '2014-09-06 10:59:28', 5, '2014-09-06 11:00:03', 5),
(20, 4, 6, 7, 1, '2014-09-06 11:42:00', '2014-09-06 12:05:00', '2014-09-06 11:44:21', 5, '2014-09-06 12:05:59', 5),
(21, 4, 6, 5, 1, '2014-09-06 11:54:00', '2014-09-06 12:19:00', '2014-09-06 11:55:14', 5, '2014-09-06 12:19:16', 5),
(22, 4, 6, 4, 1, '2014-09-06 11:59:00', '2014-09-06 12:21:00', '2014-09-06 11:59:25', 5, '2014-09-06 12:21:28', 5),
(23, 4, 6, 8, 1, '2014-09-06 12:20:00', '2014-09-06 13:09:00', '2014-09-06 12:20:23', 5, '2014-09-06 13:09:55', 5),
(24, 4, 6, 9, 1, '2014-09-06 12:45:00', '2014-09-06 12:55:00', '2014-09-06 12:45:37', 5, '2014-09-06 12:55:46', 5),
(25, 5, 6, 6, 1, '2014-09-06 15:47:00', '2014-09-06 16:28:00', '2014-09-06 15:48:22', 2, '2014-09-06 16:28:26', 5),
(26, 5, 6, 4, 1, '2014-09-06 16:21:00', '2014-09-06 17:15:00', '2014-09-06 16:21:48', 2, '2014-09-06 17:16:06', 6),
(27, 5, 6, 5, 1, '2014-09-06 17:18:00', '2014-09-06 18:03:00', '2014-09-06 17:18:51', 6, '2014-09-06 18:03:58', 5),
(28, 5, 6, 7, 1, '2014-09-06 18:43:00', '2014-09-06 18:44:00', '2014-09-06 18:43:57', 4, '2014-09-06 18:44:20', 4),
(29, 5, 6, 9, 1, '2014-09-06 19:07:00', '2014-09-06 19:09:00', '2014-09-06 19:07:55', 6, '2014-09-06 19:09:41', 6),
(30, 8, 6, 8, 1, '2014-09-06 20:17:00', '2014-09-06 21:15:00', '2014-09-06 20:17:51', 4, '2014-09-06 21:15:37', 4),
(31, 8, 6, 4, 1, '2014-09-06 20:18:00', '2014-09-06 21:34:00', '2014-09-06 20:19:02', 4, '2014-09-06 21:34:54', 4),
(32, 8, 6, 5, 1, '2014-09-06 20:19:00', '2014-09-06 21:12:00', '2014-09-06 20:20:39', 4, '2014-09-06 21:12:52', 4),
(33, 8, 6, 7, 1, '2014-09-06 21:42:00', NULL, '2014-09-06 21:43:59', 2, '2014-09-06 21:43:59', 2),
(34, 8, 6, 6, 1, '2014-09-06 22:05:00', '2014-09-06 22:47:00', '2014-09-06 22:06:34', 2, '2014-09-06 22:47:58', 5),
(35, 8, 6, 9, 1, '2014-09-06 22:47:00', '2014-09-06 22:48:00', '2014-09-06 22:47:32', 5, '2014-09-06 22:48:23', 5),
(36, 6, 6, 5, 1, '2014-09-06 23:14:00', NULL, '2014-09-06 23:14:55', 2, '2014-09-06 23:14:55', 2),
(37, 6, 6, 8, 1, '2014-09-06 23:25:00', NULL, '2014-09-06 23:25:41', 2, '2014-09-06 23:25:41', 2),
(38, 6, 6, 4, 1, '2014-09-07 00:04:00', NULL, '2014-09-07 00:04:50', 6, '2014-09-07 00:04:50', 6),
(39, 6, 6, 7, 1, '2014-09-07 00:23:00', NULL, '2014-09-07 00:24:10', 2, '2014-09-07 00:24:10', 2),
(40, 6, 6, 9, 1, '2014-09-07 02:03:00', NULL, '2014-09-07 02:04:43', 4, '2014-09-07 02:04:43', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qr`
--

INSERT INTO `tbl_qr` (`qr_ID`, `qr_name`, `qr_code`, `event_ID`, `route_ID`, `qr_volgorde`, `score`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(3, 'Vrijdag - Kan het makkelijker', '1wDlYLbS8Ws9EutrUMjNv6', 6, 17, 3, 3, '2014-08-30 14:44:11', 2, '2014-08-30 14:44:11', 2),
(4, 'Vrijdag - En vraag niet naar de weg', '6hUg3eWLzE4qOcvoFwId1K', 6, 18, 4, 3, '2014-08-30 14:44:42', 2, '2014-08-30 14:45:32', 2),
(5, 'Vrijdag - Meneer van Dalen wacht op antwoord', 'swqYfNxRPvikX6KE41cTmH', 6, 19, 5, 3, '2014-08-30 14:45:01', 2, '2014-08-30 14:45:46', 2),
(6, 'Vrijdag - Aan de wandel', 'iYMPtVWjXc1EparqnxCeAZ', 6, 20, 7, 3, '2014-08-30 14:46:31', 2, '2014-08-30 14:46:31', 2),
(7, 'Vrijdag - Je gaat het pas zien als je het door heb', 'FpoSea4nYzKQ6IOW27NCBm', 6, 21, 7, 3, '2014-08-30 14:46:51', 2, '2014-08-30 14:46:51', 2),
(8, 'Vrijdag - In vogelvlucht', 'gNHpBGPb9EcTLs1Ih8Ov5i', 6, 22, 8, 3, '2014-08-30 14:47:05', 2, '2014-08-30 14:48:34', 2),
(9, 'Vrijdag - Homerun', 'uG5HA806ZjaEr2lICVWT4b', 6, 40, 9, 3, '2014-08-30 14:47:16', 2, '2014-08-30 14:48:49', 2),
(10, ' ''Zaterdag - Alle begin is moeilijk,  again''', 'KtJ4rTi1svaLgqOpSyoV98', 6, 23, 11, 3, '2014-08-30 14:47:27', 2, '2015-07-17 18:11:17', 2),
(13, 'Zaterdag - Metrostelsel', 'xhW1CXYEBM2vPezGgVaHNO', 6, 24, 12, 3, '2014-08-30 14:49:40', 2, '2014-08-30 14:49:40', 2),
(14, 'Zaterdag - Good old...', 'OkmX1FnEc48y6gHNGAeKfh', 6, 25, 13, 3, '2014-08-30 14:49:54', 2, '2014-08-30 14:49:54', 2),
(15, 'Zaterdag - Niet te doen...', 'd5IevhQXwjG1k4rAmVxEYN', 6, 26, 14, 3, '2014-08-30 14:50:36', 2, '2014-08-30 14:50:36', 2),
(16, 'Zaterdag - Kruispuntenpuzzelen', 'wMX7n5vqiEQ1TLYV9Klrah', 6, 27, 15, 3, '2014-08-30 14:51:13', 2, '2014-08-30 14:51:13', 2),
(17, ' ''Zaterdag – Evert,  bedankt!''', 'Qk0FJIXzDaqBidLuMlA3hg', 6, 28, 16, 3, '2014-08-30 14:51:27', 2, '2014-08-30 14:55:07', 2),
(18, 'Zaterdag - Knippen maar!!', 'HkVsZQbveWPDjxiGXUCM0c', 6, 29, 16, 3, '2014-08-30 14:51:40', 2, '2014-08-30 14:51:40', 2),
(19, 'Zaterdag - Tja.', '4Jxu0FhsPonANZjvYtrSy2', 6, 30, 17, 3, '2014-08-30 14:51:56', 2, '2014-08-30 14:51:56', 2),
(20, 'Zaterdag - Kruispijling', 'zBjxLvRsArI9w12K8DfiVX', 6, 31, 18, 3, '2014-08-30 14:52:15', 2, '2014-08-30 14:52:15', 2),
(21, 'Zaterdag - Even die grijze massa aanzwengelen', 'eMHj9qVE1sZl6dSOk7LUtg', 6, 32, 19, 3, '2014-08-30 14:52:33', 2, '2014-08-30 14:52:33', 2),
(22, ' ''Zaterdag - We want more,  we want more!''', 'HjQB5pDYIwgW1NfFA2Octk', 6, 33, 20, 3, '2014-08-30 14:52:50', 2, '2014-08-30 14:52:50', 2),
(23, 'Zaterdag - Er zit muziek in de lucht', 'w0YHnW7pUZKsuXeJfjyEFI', 6, 34, 21, 3, '2014-08-30 14:53:08', 2, '2014-08-30 14:53:08', 2),
(24, 'Zaterdag - Rosetta', 'b9CJ01W4Pl6ETgySmLwNqo', 6, 35, 22, 3, '2014-08-30 14:53:21', 2, '2014-08-30 14:53:21', 2),
(25, 'Zaterdag - Sultan', 'M3Q74GNuP6seVI8vda2tRL', 6, 36, 23, 3, '2014-08-30 14:53:30', 2, '2014-08-30 14:53:30', 2),
(26, 'Zaterdag - Net even anders', '7Sxkzmo0q5dlevhrW3RTKw', 6, 37, 24, 3, '2014-08-30 14:53:44', 2, '2014-08-30 14:53:44', 2),
(27, 'Zaterdag - Aquarellen', '6yx3lEcDdCHubr9W42TOmo', 6, 38, 25, 3, '2014-08-30 14:53:59', 2, '2014-08-30 14:53:59', 2),
(28, 'Zaterdag - Spiegeltje-spiegeltje', 'nqHZSR3YrBFE7PmILoUt9N', 6, 39, 26, 3, '2014-08-30 14:54:15', 2, '2014-08-30 14:54:15', 2),
(29, 'Introductie', 'U4JgOidwKeBDAGImcot0s2', 6, 41, 7, 2, '2014-08-31 11:16:17', 2, '2015-07-07 21:22:19', 2),
(36, 'Introductie twee', '9oeg0mj2aZXb5f7kYtSchR', 6, 41, 9, 5, '2015-07-13 10:20:23', 2, '2015-07-13 10:21:48', 2),
(37, 'Introductie', 'ZakmUAOWfq8pB1XynjsuRY', 6, 41, 8, 5, '2015-07-13 10:20:42', 2, '2015-07-13 10:21:48', 2),
(38, 'blabla', 'Tj0ncupdwxCsOG9aYgP5o1', 6, 23, 12, 4, '2015-07-17 16:09:54', 2, '2015-07-17 18:11:17', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_qr_check`
--

INSERT INTO `tbl_qr_check` (`qr_check_ID`, `qr_ID`, `event_ID`, `group_ID`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(12, 29, 6, 6, '2014-08-31 14:03:05', 26, '2014-08-31 14:03:05', 26),
(13, 29, 6, 8, '2014-08-31 14:06:44', 30, '2014-08-31 14:06:44', 30),
(15, 29, 6, 5, '2014-08-31 14:19:03', 25, '2014-08-31 14:19:03', 25),
(16, 29, 6, 4, '2014-08-31 14:30:00', 17, '2014-08-31 14:30:00', 17),
(18, 29, 6, 7, '2014-08-31 15:22:24', 20, '2014-08-31 15:22:24', 20),
(19, 29, 6, 9, '2014-09-02 13:35:47', 35, '2014-09-02 13:35:47', 35),
(20, 5, 6, 5, '2014-09-05 23:05:34', 25, '2014-09-05 23:05:34', 25),
(21, 6, 6, 5, '2014-09-05 23:18:41', 25, '2014-09-05 23:18:41', 25),
(22, 5, 6, 4, '2014-09-05 23:48:06', 32, '2014-09-05 23:48:06', 32),
(23, 5, 6, 6, '2014-09-05 23:53:05', 27, '2014-09-05 23:53:05', 27),
(24, 5, 6, 8, '2014-09-05 23:54:03', 37, '2014-09-05 23:54:03', 37),
(25, 5, 6, 7, '2014-09-05 23:55:47', 19, '2014-09-05 23:55:47', 19),
(26, 6, 6, 6, '2014-09-06 00:19:37', 27, '2014-09-06 00:19:37', 27),
(27, 6, 6, 8, '2014-09-06 00:37:51', 37, '2014-09-06 00:37:51', 37),
(28, 13, 6, 6, '2014-09-06 09:43:02', 27, '2014-09-06 09:43:02', 27),
(29, 14, 6, 9, '2014-09-06 10:11:56', 35, '2014-09-06 10:11:56', 35),
(30, 13, 6, 7, '2014-09-06 10:12:00', 20, '2014-09-06 10:12:00', 20),
(31, 14, 6, 6, '2014-09-06 10:22:19', 27, '2014-09-06 10:22:19', 27),
(32, 14, 6, 7, '2014-09-06 10:31:14', 19, '2014-09-06 10:31:14', 19),
(33, 15, 6, 6, '2014-09-06 10:33:34', 27, '2014-09-06 10:33:34', 27),
(34, 14, 6, 5, '2014-09-06 10:46:56', 25, '2014-09-06 10:46:56', 25),
(35, 16, 6, 6, '2014-09-06 11:01:43', 27, '2014-09-06 11:01:43', 27),
(36, 16, 6, 9, '2014-09-06 11:02:27', 35, '2014-09-06 11:02:27', 35),
(37, 15, 6, 5, '2014-09-06 11:27:23', 25, '2014-09-06 11:27:23', 25),
(38, 16, 6, 7, '2014-09-06 11:41:38', 19, '2014-09-06 11:41:38', 19),
(39, 15, 6, 4, '2014-09-06 11:42:02', 32, '2014-09-06 11:42:02', 32),
(40, 15, 6, 8, '2014-09-06 11:49:35', 37, '2014-09-06 11:49:35', 37),
(41, 16, 6, 5, '2014-09-06 11:52:56', 25, '2014-09-06 11:52:56', 25),
(42, 16, 6, 4, '2014-09-06 11:57:31', 32, '2014-09-06 11:57:31', 32),
(43, 17, 6, 9, '2014-09-06 12:10:28', 35, '2014-09-06 12:10:28', 35),
(44, 16, 6, 8, '2014-09-06 12:13:16', 37, '2014-09-06 12:13:16', 37),
(45, 17, 6, 7, '2014-09-06 12:16:20', 19, '2014-09-06 12:16:20', 19),
(46, 17, 6, 5, '2014-09-06 12:25:45', 25, '2014-09-06 12:25:45', 25),
(47, 17, 6, 4, '2014-09-06 12:32:52', 32, '2014-09-06 12:32:52', 32),
(48, 17, 6, 8, '2014-09-06 13:21:40', 37, '2014-09-06 13:21:40', 37),
(49, 18, 6, 5, '2014-09-06 13:28:25', 25, '2014-09-06 13:28:25', 25),
(50, 18, 6, 4, '2014-09-06 13:30:45', 17, '2014-09-06 13:30:45', 17),
(51, 19, 6, 5, '2014-09-06 13:52:46', 25, '2014-09-06 13:52:46', 25),
(52, 18, 6, 8, '2014-09-06 14:04:43', 37, '2014-09-06 14:04:43', 37),
(53, 20, 6, 5, '2014-09-06 14:06:32', 25, '2014-09-06 14:06:32', 25),
(54, 19, 6, 4, '2014-09-06 14:20:02', 32, '2014-09-06 14:20:02', 32),
(55, 19, 6, 7, '2014-09-06 14:32:22', 19, '2014-09-06 14:32:22', 19),
(56, 20, 6, 4, '2014-09-06 14:43:30', 32, '2014-09-06 14:43:30', 32),
(57, 21, 6, 5, '2014-09-06 14:58:34', 25, '2014-09-06 14:58:34', 25),
(58, 19, 6, 8, '2014-09-06 15:12:00', 37, '2014-09-06 15:12:00', 37),
(59, 21, 6, 4, '2014-09-06 15:35:15', 32, '2014-09-06 15:35:15', 32),
(60, 20, 6, 8, '2014-09-06 15:43:45', 37, '2014-09-06 15:43:45', 37),
(61, 21, 6, 6, '2014-09-06 16:01:15', 27, '2014-09-06 16:01:15', 27),
(62, 20, 6, 6, '2014-09-06 16:01:33', 27, '2014-09-06 16:01:33', 27),
(63, 18, 6, 6, '2014-09-06 16:01:45', 27, '2014-09-06 16:01:45', 27),
(64, 17, 6, 6, '2014-09-06 16:02:04', 27, '2014-09-06 16:02:04', 27),
(65, 22, 6, 4, '2014-09-06 16:19:42', 32, '2014-09-06 16:19:42', 32),
(66, 21, 6, 9, '2014-09-06 16:59:53', 35, '2014-09-06 16:59:53', 35),
(67, 23, 6, 6, '2014-09-06 17:03:56', 27, '2014-09-06 17:03:56', 27),
(68, 23, 6, 5, '2014-09-06 18:35:41', 25, '2014-09-06 18:35:41', 25),
(69, 23, 6, 4, '2014-09-06 18:52:35', 17, '2014-09-06 18:52:35', 17),
(70, 24, 6, 4, '2014-09-06 19:22:30', 32, '2014-09-06 19:22:30', 32),
(71, 23, 6, 7, '2014-09-06 19:22:47', 20, '2014-09-06 19:22:47', 20),
(72, 24, 6, 5, '2014-09-06 19:32:08', 25, '2014-09-06 19:32:08', 25),
(73, 22, 6, 9, '2014-09-06 19:34:02', 35, '2014-09-06 19:34:02', 35),
(74, 24, 6, 7, '2014-09-06 20:05:52', 20, '2014-09-06 20:05:52', 20),
(75, 25, 6, 4, '2014-09-06 20:14:44', 32, '2014-09-06 20:14:44', 32),
(76, 24, 6, 6, '2014-09-06 20:15:46', 27, '2014-09-06 20:15:46', 27),
(77, 23, 6, 9, '2014-09-06 20:21:43', 35, '2014-09-06 20:21:43', 35),
(78, 25, 6, 5, '2014-09-06 20:23:24', 25, '2014-09-06 20:23:24', 25),
(79, 26, 6, 4, '2014-09-06 22:01:21', 17, '2014-09-06 22:01:21', 17),
(80, 26, 6, 5, '2014-09-06 22:11:34', 25, '2014-09-06 22:11:34', 25),
(81, 26, 6, 7, '2014-09-06 22:41:35', 19, '2014-09-06 22:41:35', 19),
(82, 27, 6, 4, '2014-09-06 22:49:40', 17, '2014-09-06 22:49:40', 17),
(83, 28, 6, 5, '2014-09-06 23:03:48', 25, '2014-09-06 23:03:48', 25),
(84, 28, 6, 4, '2014-09-06 23:57:42', 17, '2014-09-06 23:57:42', 17),
(85, 27, 6, 9, '2014-09-07 00:51:50', 35, '2014-09-07 00:51:50', 35);

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_route`
--

INSERT INTO `tbl_route` (`route_ID`, `route_name`, `event_ID`, `day_date`, `route_volgorde`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(40, '9 - Homerun', 6, '2014-09-05', 9, NULL, 2, NULL, NULL),
(41, 'Introductie', 6, '0000-00-00', 1, NULL, 2, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_ID`, `username`, `voornaam`, `achternaam`, `email`, `password`, `macadres`, `birthdate`, `last_login_time`, `create_time`, `create_user_ID`, `update_time`, `update_user_ID`) VALUES
(1, 'organisatie', 'organisatie', 'organisatie', 'daheman1@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', NULL, '0000-00-00', '2015-07-28 15:47:22', '2015-07-10 07:05:13', NULL, '2015-07-10 07:05:13', NULL),
(2, 'deelnemera', 'deelnemersa', 'deelnemersa', 'daheman2@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', NULL, '0000-00-00', '2015-07-28 15:47:22', '2015-07-10 07:05:13', NULL, '2015-07-10 07:05:13', NULL),
(3, 'deelnemerb', 'deelnemersb', 'deelnemersb', 'daheman3@hotmail.com', '098f6bcd4621d373cade4e832627b4f6', NULL, '0000-00-00', '2015-07-28 15:47:22', '2015-07-10 07:05:13', NULL, '2015-07-10 07:05:13', NULL);


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
  MODIFY `bouspunten_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_deelnemers_event`
--
ALTER TABLE `tbl_deelnemers_event`
  MODIFY `deelnemers_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbl_event_names`
--
ALTER TABLE `tbl_event_names`
  MODIFY `event_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_friend_list`
--
ALTER TABLE `tbl_friend_list`
  MODIFY `friend_list_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `group_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_nood_envelop`
--
ALTER TABLE `tbl_nood_envelop`
  MODIFY `nood_envelop_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_open_nood_envelop`
--
ALTER TABLE `tbl_open_nood_envelop`
  MODIFY `open_nood_envelop_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_open_vragen`
--
ALTER TABLE `tbl_open_vragen`
  MODIFY `open_vragen_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tbl_open_vragen_antwoorden`
--
ALTER TABLE `tbl_open_vragen_antwoorden`
  MODIFY `open_vragen_antwoorden_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `tbl_posten`
--
ALTER TABLE `tbl_posten`
  MODIFY `post_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_post_passage`
--
ALTER TABLE `tbl_post_passage`
  MODIFY `posten_passage_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_qr`
--
ALTER TABLE `tbl_qr`
  MODIFY `qr_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `tbl_qr_check`
--
ALTER TABLE `tbl_qr_check`
  MODIFY `qr_check_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
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
