-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 10 feb 2026 om 07:40
-- Serverversie: 8.4.7
-- PHP-versie: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoutstrooimanagement`
--
CREATE DATABASE IF NOT EXISTS `zoutstrooimanagement` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `zoutstrooimanagement`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `size`) VALUES
(1, 'Gizmo', 'A thing for a purpose', 32),
(2, 'Thingamajig', 'Something useful', 38),
(3, 'Widget', 'Thing that does someting', 14),
(4, 'a new product', 'kjhfeghu', 4),
(10, 'Julian ', 'Hij is stom', 42);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `weersomstandigheden`
--

DROP TABLE IF EXISTS `weersomstandigheden`;
CREATE TABLE `weersomstandigheden` (
  `weg_id` int NOT NULL,
  `temperatuur` int NOT NULL,
  `frequentie` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wegen`
--

DROP TABLE IF EXISTS `wegen`;
CREATE TABLE `wegen` (
  `id` int NOT NULL,
  `naam` varchar(255) NOT NULL,
  `locatie` varchar(255) NOT NULL,
  `strooiduur` int NOT NULL,
  `weglengte` int NOT NULL,
  `huidige_temperatuur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `weersomstandigheden`
--
ALTER TABLE `weersomstandigheden`
  ADD PRIMARY KEY (`weg_id`,`temperatuur`);

--
-- Indexen voor tabel `wegen`
--
ALTER TABLE `wegen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `wegen`
--
ALTER TABLE `wegen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
