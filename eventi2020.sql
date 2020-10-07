-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ott 07, 2020 alle 15:29
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventi2020`
--
CREATE DATABASE IF NOT EXISTS `eventi2020` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eventi2020`;

-- --------------------------------------------------------

--
-- Struttura della tabella `argomenti`
--

DROP TABLE IF EXISTS `argomenti`;
CREATE TABLE `argomenti` (
  `arg_id` int(10) UNSIGNED NOT NULL,
  `arg_argomento` char(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `argomenti`
--

INSERT INTO `argomenti` (`arg_id`, `arg_argomento`) VALUES
(1, 'SAGRE E FIERE'),
(2, 'SPETTACOLI'),
(3, 'MUSEI E MOSTRE'),
(4, 'EVENTI SPORTIVI'),
(5, 'VIVI LA NATURA');

-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

DROP TABLE IF EXISTS `eventi`;
CREATE TABLE `eventi` (
  `eve_id` int(10) UNSIGNED NOT NULL,
  `eve_arg_id` int(10) UNSIGNED NOT NULL,
  `eve_nome` varchar(100) NOT NULL,
  `eve_data_inizio` date NOT NULL,
  `eve_data_fine` date NOT NULL,
  `eve_dove` varchar(100) NOT NULL,
  `eve_descriz` varchar(200) NOT NULL,
  `eve_image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `eventi`
--

INSERT INTO `eventi` (`eve_id`, `eve_arg_id`, `eve_nome`, `eve_data_inizio`, `eve_data_fine`, `eve_dove`, `eve_descriz`, `eve_image`) VALUES
(1, 1, 'Sagra della Castagna', '2020-09-25', '2020-10-02', 'Rimini - Piazzale Fellini', 'La storia, le ricette, le curiosità e assaggi vari di questo meraviglioso frutto del bosco', NULL),
(2, 1, 'Fiera dei Fiori Gialli', '2020-09-26', '2020-10-01', 'Rimini - Piazzale Fellini', 'Tingiamo la bellissima piazza Felliniana del suo colore preferito ...: il Giallo!', NULL),
(3, 4, 'BikeBike we love you', '2020-09-26', '2020-09-28', 'Rimini - ciclabile da piazza Tripoli al Porto', 'bikeando bikeando tra amici', 'https://pbs.twimg.com/media/Cai3am3XIAAHwS5.jpg'),
(4, 2, 'Romeo & Juliet ', '2020-09-27', '2020-09-30', 'Rimini - Teatro Galli', 'Shakespeare e la sua visione dell\'amore   ', NULL),
(5, 3, 'Cinematografia di Fellini', '2020-09-27', '2020-10-04', 'Cesena - Biblioteca comunale', 'L\'Antologia completa della filmografia del grande regista Riminese', NULL),
(6, 5, 'Passeggiando sotto la luna piena', '2020-09-28', '2020-09-28', 'Santarcangelo - colline e dintorni', 'Una romantica passeggiata sotto la luna piena, dove poter esprimere tutti i nostri più intimi desideri', NULL),
(7, 5, 'La vie en Rose', '2020-09-25', '2020-09-30', 'Riccione - Parco sul mare', 'Inebriarsi al dolce profumo di 10.000 rose multicolore', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `statistiche`
--

DROP TABLE IF EXISTS `statistiche`;
CREATE TABLE `statistiche` (
  `sta_id` int(11) NOT NULL,
  `sta_eve_id` int(11) NOT NULL,
  `sta_data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `statistiche`
--

INSERT INTO `statistiche` (`sta_id`, `sta_eve_id`, `sta_data`) VALUES
(1, 5, '2020-10-05 13:56:40'),
(2, 3, '2020-10-04 13:57:02'),
(3, 5, '2020-10-05 13:57:26'),
(4, 4, '2020-10-05 14:40:41'),
(5, 4, '2020-10-05 14:41:13'),
(6, 3, '2020-10-04 14:41:13'),
(7, 4, '2020-10-05 14:52:16'),
(8, 3, '2020-10-05 14:52:16'),
(9, 1, '2020-10-05 14:59:07'),
(10, 1, '2020-10-05 14:59:07');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `ute_id` int(11) NOT NULL,
  `ute_login` varchar(100) NOT NULL,
  `ute_password` varchar(100) NOT NULL,
  `ute_nome` varchar(100) NOT NULL,
  `ute_email` varchar(100) NOT NULL,
  `ute_ruolo` varchar(100) NOT NULL DEFAULT 'users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`ute_id`, `ute_login`, `ute_password`, `ute_nome`, `ute_email`, `ute_ruolo`) VALUES
(1, 'user', '1234', 'The user', 'theuser@theuser.it', 'users'),
(2, 'admin', '1234', 'The Admin', 'theadmin@theadmin.it', 'admin');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `argomenti`
--
ALTER TABLE `argomenti`
  ADD PRIMARY KEY (`arg_id`);

--
-- Indici per le tabelle `eventi`
--
ALTER TABLE `eventi`
  ADD PRIMARY KEY (`eve_id`),
  ADD KEY `eve_arg_id` (`eve_arg_id`);

--
-- Indici per le tabelle `statistiche`
--
ALTER TABLE `statistiche`
  ADD PRIMARY KEY (`sta_id`),
  ADD KEY `stat_eve_id` (`sta_eve_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`ute_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `argomenti`
--
ALTER TABLE `argomenti`
  MODIFY `arg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `eventi`
--
ALTER TABLE `eventi`
  MODIFY `eve_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `statistiche`
--
ALTER TABLE `statistiche`
  MODIFY `sta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `ute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;