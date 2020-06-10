-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 May 2019, 21:28:56
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `todolist`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ci_session`
--

CREATE TABLE `ci_session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `aciklama` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completedDate` datetime NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `surname` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `emailConfirmed` tinyint(1) NOT NULL DEFAULT '1',
  `registerDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `email`, `emailConfirmed`, `registerDate`, `isActive`) VALUES
(1, 'admin', 'CF8D8C66B1212720E569B0BD67695451', 'Emre', 'Bodur', 'todoadmin@emrebodur.com', 1, '2019-03-27 19:34:27', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_login_log`
--

CREATE TABLE `user_login_log` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `platform` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `geo_loc` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=FIXED;


-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `user_login_log`
--
ALTER TABLE `user_login_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `user_login_log`
--
ALTER TABLE `user_login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
