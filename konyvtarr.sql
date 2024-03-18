-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Feb 26. 21:45
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `konyvtarr`
--
CREATE DATABASE IF NOT EXISTS `konyvtarr` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `konyvtarr`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `erdeklodikor`
--

DROP TABLE IF EXISTS `erdeklodikor`;
CREATE TABLE `erdeklodikor` (
  `erd_id` int(11) NOT NULL,
  `erdeklodesikor` varchar(100) NOT NULL,
  `kedvenciro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE `forum` (
  `Id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `mikor` timestamp NOT NULL DEFAULT current_timestamp(),
  `mit` text DEFAULT NULL,
  `kep` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `iro`
--

DROP TABLE IF EXISTS `iro`;
CREATE TABLE `iro` (
  `iro_id` int(11) NOT NULL,
  `szuletes` date DEFAULT NULL,
  `halalozas` date DEFAULT NULL,
  `nev` varchar(100) DEFAULT NULL,
  `irta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

DROP TABLE IF EXISTS `kategoriak`;
CREATE TABLE `kategoriak` (
  `kategoriak_id` int(11) NOT NULL,
  `fantasy` varchar(100) NOT NULL,
  `horror` varchar(100) NOT NULL,
  `humor` varchar(100) NOT NULL,
  `ifijusagi` varchar(100) NOT NULL,
  `kepregeny` varchar(100) NOT NULL,
  `krimi` varchar(100) NOT NULL,
  `romantika` varchar(100) NOT NULL,
  `erotika` varchar(100) NOT NULL,
  `thriller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyv`
--

DROP TABLE IF EXISTS `konyv`;
CREATE TABLE `konyv` (
  `konyv_id` int(11) NOT NULL,
  `cim` varchar(100) NOT NULL,
  `iro` varchar(100) NOT NULL,
  `kiadaseve` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mufaj`
--

DROP TABLE IF EXISTS `mufaj`;
CREATE TABLE `mufaj` (
  `mufaj_id` int(11) NOT NULL,
  `mufaj` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `regisztracio`
--

DROP TABLE IF EXISTS `regisztracio`;
CREATE TABLE `regisztracio` (
  `erd_id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `szuletes` date DEFAULT NULL,
  `nem` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailmeg` varchar(100) NOT NULL,
  `jelszo` varchar(100) NOT NULL,
  `jelszomeg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `erdeklodikor`
--
ALTER TABLE `erdeklodikor`
  ADD KEY `erd_id` (`erd_id`);

--
-- A tábla indexei `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `iro`
--
ALTER TABLE `iro`
  ADD KEY `iro_id` (`iro_id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD KEY `kategoriak_id` (`kategoriak_id`);

--
-- A tábla indexei `konyv`
--
ALTER TABLE `konyv`
  ADD PRIMARY KEY (`konyv_id`);

--
-- A tábla indexei `mufaj`
--
ALTER TABLE `mufaj`
  ADD PRIMARY KEY (`mufaj_id`);

--
-- A tábla indexei `regisztracio`
--
ALTER TABLE `regisztracio`
  ADD PRIMARY KEY (`erd_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `erdeklodikor`
--
ALTER TABLE `erdeklodikor`
  MODIFY `erd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `forum`
--
ALTER TABLE `forum`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `iro`
--
ALTER TABLE `iro`
  MODIFY `iro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `kategoriak_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `konyv`
--
ALTER TABLE `konyv`
  MODIFY `konyv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `regisztracio`
--
ALTER TABLE `regisztracio`
  MODIFY `erd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `erdeklodikor`
--
ALTER TABLE `erdeklodikor`
  ADD CONSTRAINT `erdeklodikor_ibfk_1` FOREIGN KEY (`erd_id`) REFERENCES `regisztracio` (`erd_id`);

--
-- Megkötések a táblához `iro`
--
ALTER TABLE `iro`
  ADD CONSTRAINT `iro_ibfk_1` FOREIGN KEY (`iro_id`) REFERENCES `konyv` (`konyv_id`);

--
-- Megkötések a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD CONSTRAINT `kategoriak_ibfk_1` FOREIGN KEY (`kategoriak_id`) REFERENCES `mufaj` (`mufaj_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
