-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Már 25. 12:57
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `elfelejtett`
--
CREATE DATABASE IF NOT EXISTS `elfelejtett` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `elfelejtett`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `erdeklodesikor`
--

CREATE TABLE `erdeklodesikor` (
  `id` int(11) NOT NULL,
  `erdeklodesikor` datetime NOT NULL,
  `kedvenciro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `felhasznalonev` varchar(100) NOT NULL,
  `jelszo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `forumkapcsolat`
--

CREATE TABLE `forumkapcsolat` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `hozzaszolas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzaszolasok`
--

CREATE TABLE `hozzaszolasok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `hozzaszolas` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `hozzaszolasok`
--

INSERT INTO `hozzaszolasok` (`id`, `felhasznalonev`, `hozzaszolas`, `datum`) VALUES
(10, 'Reni', 'ddd', '2024-03-20 11:29:48'),
(11, 'Valaki', 'fskcnjfsc', '2024-03-20 11:45:39'),
(12, 'Valaki', 'cccc', '2024-03-20 11:46:02'),
(13, 'Reni', 'https://www.bing.com/images/search?view=detailV2&amp;ccid=TZZ28qLZ&amp;id=2E4C10E739A2EF3FA3C6DF2351AD5D7A53A9188B&amp;thid=OIP.TZZ28qLZJjzBntwtUmM8zwHaEK&amp;mediaurl=https%3a%2f%2fc.wallhere.com%2fphotos%2f73%2f09%2flandscape-249027.jpg!d&amp;cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.4d9676f2a2d9263cc19edc2d52633ccf%3frik%3dixipU3pdrVEj3w%26pid%3dImgRaw%26r%3d0&amp;exph=900&amp;expw=1600&amp;q=forum+h%c3%a1tt%c3%a9rk%c3%a9pek&amp;simid=607988948298069958&amp;FORM=IRPRST&amp;ck=AE2B08E1E4CC5E66917C44A5C98FA7F6&amp;selectedIndex=57&amp;itb=0&amp;ajaxhist=0&amp;ajaxserp=0', '2024-03-20 11:59:09');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `iro`
--

CREATE TABLE `iro` (
  `iro_id` int(11) NOT NULL,
  `szuletese` date NOT NULL,
  `halalozasa` date DEFAULT NULL,
  `nev` varchar(255) NOT NULL,
  `irta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kapcsolatok`
--

CREATE TABLE `kapcsolatok` (
  `id` int(11) NOT NULL,
  `mufajd_id` int(11) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `erd_id` int(11) NOT NULL,
  `iro_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `komment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(11) NOT NULL,
  `fantasy` int(11) DEFAULT NULL,
  `horror` int(11) DEFAULT NULL,
  `humor` int(11) DEFAULT NULL,
  `romantika` int(11) DEFAULT NULL,
  `thriller` int(11) DEFAULT NULL,
  `erotika` int(11) DEFAULT NULL,
  `ifijusagi` int(11) DEFAULT NULL,
  `kepregeny` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyv`
--

CREATE TABLE `konyv` (
  `id` int(11) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `iro` varchar(255) NOT NULL,
  `kiadaseve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mufaj`
--

CREATE TABLE `mufaj` (
  `id` int(11) NOT NULL,
  `mufaj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `erdeklodesikor`
--
ALTER TABLE `erdeklodesikor`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `forumkapcsolat`
--
ALTER TABLE `forumkapcsolat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FELHASZNALO_FK` (`felhasznalo_id`),
  ADD KEY `HOZZASZOLAS_FK` (`hozzaszolas_id`);

--
-- A tábla indexei `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `iro`
--
ALTER TABLE `iro`
  ADD PRIMARY KEY (`iro_id`);

--
-- A tábla indexei `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MUFAJ_FK` (`mufajd_id`),
  ADD KEY `KATEGORIA_FK` (`kategoria_id`),
  ADD KEY `KONYV_FK` (`konyv_id`),
  ADD KEY `ERD_FK` (`erd_id`),
  ADD KEY `IRO_FK` (`iro_id`),
  ADD KEY `FEL_FK` (`felhasznalo_id`),
  ADD KEY `KOMMENT_FK` (`komment_id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `konyv`
--
ALTER TABLE `konyv`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `mufaj`
--
ALTER TABLE `mufaj`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `erdeklodesikor`
--
ALTER TABLE `erdeklodesikor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `forumkapcsolat`
--
ALTER TABLE `forumkapcsolat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `iro`
--
ALTER TABLE `iro`
  MODIFY `iro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `konyv`
--
ALTER TABLE `konyv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `mufaj`
--
ALTER TABLE `mufaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `forumkapcsolat`
--
ALTER TABLE `forumkapcsolat`
  ADD CONSTRAINT `forumkapcsolat_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forumkapcsolat_ibfk_2` FOREIGN KEY (`hozzaszolas_id`) REFERENCES `hozzaszolasok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  ADD CONSTRAINT `kapcsolatok_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoriak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapcsolatok_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `konyv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapcsolatok_ibfk_3` FOREIGN KEY (`mufajd_id`) REFERENCES `mufaj` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapcsolatok_ibfk_4` FOREIGN KEY (`erd_id`) REFERENCES `erdeklodesikor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapcsolatok_ibfk_5` FOREIGN KEY (`iro_id`) REFERENCES `iro` (`iro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapcsolatok_ibfk_6` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapcsolatok_ibfk_7` FOREIGN KEY (`komment_id`) REFERENCES `hozzaszolasok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
