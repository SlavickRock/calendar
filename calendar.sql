-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Вер 20 2016 р., 16:15
-- Версія сервера: 5.5.50-0ubuntu0.14.04.1
-- Версія PHP: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `calendar`
--

-- --------------------------------------------------------

--
-- Структура таблиці `prazdniky`
--

CREATE TABLE IF NOT EXISTS `prazdniky` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(300) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=43 ;

--
-- Дамп даних таблиці `prazdniky`
--

INSERT INTO `prazdniky` (`id`, `date`, `description`) VALUES
(24, '2016-09-14', 'День города'),
(3, '2016-09-16', 'День  программиста)'),
(28, '2016-09-29', 'День строителя'),
(29, '2016-09-17', 'День безопасного Интернета'),
(36, '2016-08-02', 'День танкиста.'),
(41, '2016-10-16', 'День флага!'),
(38, '2016-09-21', 'День сурка!!!'),
(39, '2017-01-21', 'Мой день рождения:)))'),
(26, '2016-09-10', 'День смеха'),
(30, '2016-08-24', 'День независимости'),
(37, '2016-09-08', 'День любителей природы.'),
(33, '2016-08-17', 'День хорошего человека!!!'),
(35, '2016-08-29', 'День золотого теленка!!!'),
(40, '2017-01-29', 'День рождения моей Заи)))'),
(42, '2016-10-15', 'Свадьба!!!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
