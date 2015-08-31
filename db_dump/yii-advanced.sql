-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 31 2015 г., 09:46
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yii-advanced`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `userId`, `message`, `updateDate`) VALUES
(7, 1, 'тестовое сообщение № 1', '2015-08-31 06:30:19'),
(8, 2, 'сообщение от Романа № 1', '2015-08-31 06:30:54'),
(9, 2, 'сообщение от Романыча № 2', '2015-08-31 06:34:50'),
(10, 3, 'тест № 1', '2015-08-31 06:36:21'),
(11, 6, 'админ сообщение № 1', '2015-08-31 06:45:52');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `status` int(50) DEFAULT NULL,
  `homepage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `status`, `homepage`) VALUES
(1, 'igor', 'adzhantis@ukr.net', '$2y$13$g14E5v2Ie6/sZ8ezQF9pcePyYZ5AmSTvruRoJ1e69M/FROyjLXYGS', 'Ji_uw7UQjVWXC6oJsAZAyijOWRfWG8M4', NULL, NULL, NULL, NULL, 1440528637, 1440528637, 0, 10, ''),
(2, 'roman', 'adzhantis@gmal.ocm', '$2y$10$YbmJYllS64pheF3mUNZWtOS8BjEUz5O62IOhnIXd1Ks4EttrR.1/y', 'bcyJ0zVh7mNykhf2OAv6qe80qTK3Dfmf', NULL, NULL, NULL, '127.0.0.1', 1440530734, 1440530734, 0, NULL, ''),
(3, 'demo', 'test@ukr.net', '$2y$13$7lRmYDCyG2c2F2ogRTGyFO2eulzG5.hhReFf7L.CAG6HlTylOPh4i', '', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL),
(6, 'admin', 'adzhanti@ukr.net', '$2y$13$89l2HfcVQItytibdXryO3u3H8Vll5mORKdFO0/3kDrWGklCiXJiJ2', '', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
