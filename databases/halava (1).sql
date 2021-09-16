-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Sep 2021 um 23:57
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `halava`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` varchar(255) NOT NULL,
  `cat_status` tinyint(4) NOT NULL DEFAULT 0,
  `cat_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`cat_id`, `added_by`, `cat_name`, `cat_desc`, `cat_status`, `cat_date`) VALUES
(2, 43, 'Sport', 'All things that are familaire with Sport', 0, '2021-09-11 09:36:46'),
(3, 48, 'films', 'good film', 1, '2021-09-11 10:16:37'),
(4, 48, 'hassan', 'sss', 1, '2021-09-12 13:37:51'),
(6, 52, 'Sport', 'all about sport', 1, '2021-09-12 19:01:30'),
(10, 43, 'medical', 'all medical items', 1, '2021-09-14 23:49:06'),
(16, 57, '7out', 'ytgtyugo_uho', 1, '2021-09-15 22:58:08'),
(17, 58, '9mar', '9amer w moléha rabi', 1, '2021-09-16 19:04:22');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `this_user_works_under` int(11) DEFAULT NULL,
  `item_titel` varchar(255) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `item_price` int(11) NOT NULL DEFAULT 0,
  `item_currency` varchar(10) NOT NULL DEFAULT 'TND',
  `item_photo` varchar(255) NOT NULL,
  `item_upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `item_status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`item_id`, `user_id`, `cat_id`, `this_user_works_under`, `item_titel`, `item_desc`, `item_price`, `item_currency`, `item_photo`, `item_upload_date`, `item_status`) VALUES
(113, 48, 3, NULL, 'tiekn', 'good ', 3, 'TND', '../Users_Info/Id_User_Nr48/images/pmp5637303470.jpeg', '2021-09-11 10:17:42', 0),
(118, 46, 10, 43, 'fatma okkito', 'alles ist gut', 20000, 'USA', '../Users_Info/Id_User_Nr46/images/4925687337__63099647792157285n732539389713_1337464140903108.png', '2021-09-12 15:58:55', 0),
(119, 51, 3, 48, 'mano', 'dsjcfis', 520, 'USA', '../Users_Info/Id_User_Nr51/images/39879937n221345562_101509822480_38051332309970_870127436608.jpeg', '2021-09-12 16:05:05', 1),
(120, 52, 6, NULL, 'protein', 'gfn', 250, 'USA', '../Users_Info/Id_User_Nr52/images/UNv6SH470056883012.jpeg', '2021-09-12 19:02:04', 1),
(121, 48, 3, NULL, 'protein', 'fih 24g ', 154, 'TND', '../Users_Info/Id_User_Nr48/images/NHvS6U366974139238.jpeg', '2021-09-12 19:03:58', 1),
(122, 52, 6, NULL, 'protein', 'fih 24g ', 154, 'TND', '../Users_Info/Id_User_Nr52/images/HU6vNS855940142186.jpeg', '2021-09-12 19:05:02', 0),
(124, 43, 2, NULL, 'protein', 'fih 24g ', 154, 'TND', '../Users_Info/Id_User_Nr43/images/2_333053183298n1645027259170_0079_9093524881293746058720639.jpeg', '2021-09-14 23:52:07', 1),
(125, 43, 2, NULL, 'vélo', 'asass', 1545, 'TND', '../Users_Info/Id_User_Nr43/images/5_6711501930403891_322n850810_43908299444885755856271932873.jpeg', '2021-09-15 16:50:04', 0),
(127, 43, 2, NULL, 'bandage', 'scbvsbbckbsc', 15500, 'TND', '../Users_Info/Id_User_Nr43/images/76307380_23591_899085976211225n5677_1112759151262477307996.jpeg', '2021-09-15 22:40:07', 1),
(128, 57, 16, NULL, 'bori', 'bori weld b7ar', 7, 'TND', '../Users_Info/Id_User_Nr57/images/6SHvUN740099567412.jpeg', '2021-09-15 23:01:02', 1),
(129, 58, 17, NULL, 'protein', 'ngnng', 52, 'TND', '../Users_Info/Id_User_Nr58/images/6HvSUN60760419874.jpeg', '2021-09-16 19:05:29', 1),
(133, 46, 2, 43, 'fatma wlh mrigl', 'ffsffs', 20, 'TND', '../Users_Info/Id_User_Nr46/images/vHN6SU79686322333.jpeg', '2021-09-16 22:57:27', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `working_under` int(11) NOT NULL DEFAULT 0,
  `registered Date` datetime NOT NULL DEFAULT current_timestamp(),
  `groupID` tinyint(4) NOT NULL DEFAULT 0,
  `zugangberichtigung` tinyint(1) NOT NULL DEFAULT 1,
  `email_code` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`, `working_under`, `registered Date`, `groupID`, `zugangberichtigung`, `email_code`) VALUES
(43, 'saif.askri@outlook.de', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'saif askri', 0, '2021-08-29 12:28:13', 1, 1, NULL),
(46, 'fatmaxt0000@gmail.com', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'Fatma Askri', 43, '2021-08-29 18:39:38', 0, 1, NULL),
(48, 'hssan.h@gmail.ciom', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'hassan askri', 0, '2021-09-01 17:42:48', 1, 1, NULL),
(51, 'mano@fdij.df', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'mano askri', 48, '2021-09-12 16:03:44', 0, 1, NULL),
(52, 'ihebbejaouiisg@gmail.com', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'iheb bejaoui', 0, '2021-09-12 18:54:09', 1, 1, '187e765'),
(54, 'fezjbzfe@feu.de', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'dedeqqde', 53, '2021-09-13 00:54:38', 0, 1, NULL),
(55, 'babaaskri@s.sc', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'baba askri', 43, '2021-09-13 01:01:54', 0, 1, NULL),
(57, 'hassenbj33@gmail.com', '09ffa27aad0407cd55e1e4b42cb33bd50556076f', 'hassen33', 0, '2021-09-15 22:47:56', 1, 1, NULL),
(58, 'hamzowski.9@gmail.com', '5241af08ed1900e4821aab0162b9938d45edd8d5', 'hamza 55', 0, '2021-09-16 19:00:28', 1, 1, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `user_item_id` (`user_id`),
  ADD KEY `item_cat` (`cat_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_cat` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_item_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
