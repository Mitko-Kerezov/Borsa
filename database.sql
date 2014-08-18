-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 
-- Версия на сървъра: 5.5.8
-- Версия на PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `borsa`
--

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `class` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `specifics` text CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  `authors` text CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `img` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pics/books/book_default.jpg',
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Дъмп (схема) на данните в таблицата `books`
--

INSERT INTO `books` (`id`, `genre_id`, `seller_id`, `class`, `year`, `specifics`, `authors`, `publisher_id`, `img`, `date`) VALUES
(1, 1, 1, 9, 2002, 'Издателство: Диоген\r\nНалълно запазен', 'Младен Влашки, Влери Александров', 7, 'pics/books/book_default.jpg', '2011-Feb-13 17:25:43'),
(2, 8, 1, 9, 2004, 'Добро състояние, за задължителна подготовка', 'Павел Ангелов и др.', 2, 'pics/books/book_default.jpg', '2011-Feb-13 17:27:52'),
(3, 13, 1, 8, 2004, 'Атлас по география!\r\nИздателство: DataMap\r\nНе е отварян даже.', 'DataMap', 7, 'pics/books/book_default.jpg', '2011-Feb-13 17:30:06'),
(5, 4, 14, 10, 2000, 'нов', 'heiko bock', 9, 'pics/books/book_default.jpg', '2011-Feb-23 11:58:04'),
(6, 1, 14, 10, 2006, 'стар', 'николай аретов', 5, 'pics/books/book_default.jpg', '2011-Feb-23 11:58:45'),
(7, 7, 7, 10, 2002, 'Неотварян', 'Стефан Додунеков', 6, 'pics/books/book_default.jpg', '2011-Feb-23 12:01:58'),
(8, 6, 7, 10, 2003, '-', 'Георги Марков', 2, 'pics/books/book_default.jpg', '2011-Feb-23 12:02:38'),
(10, 15, 3, 10, 2003, '-', 'Димитър Тафков', 5, 'pics/books/book_default.jpg', '2011-Feb-23 12:08:44'),
(11, 12, 3, 10, 2001, 'Малко скъсан', 'Максим Максимов', 1, 'pics/books/book_default.jpg', '2011-Feb-23 12:09:19'),
(12, 8, 11, 10, 2001, 'Малкият - 30 урока', 'Мария Шишиньова', 5, 'pics/books/book_default.jpg', '2011-Feb-23 12:12:25'),
(13, 15, 11, 10, 2003, '-', 'Димитър Тафков', 5, 'pics/books/book_default.jpg', '2011-Feb-23 12:13:02'),
(14, 5, 5, 10, 2006, 'Може да минете и без него ИТ-то в 10 клас иначе е нов и неотварян :)', 'Иван Георгиев', 2, 'pics/books/book_default.jpg', '2011-Mar-14 23:01:27'),
(18, 5, 11, 7, 2008, 'Запазен!', 'Коста Гъров', 11, 'pics/books/book_default.jpg', '2011-Apr-07 09:32:42');

-- --------------------------------------------------------

--
-- Структура на таблица `book_comments`
--

CREATE TABLE IF NOT EXISTS `book_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `comment` mediumtext CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Дъмп (схема) на данните в таблицата `book_comments`
--

INSERT INTO `book_comments` (`id`, `user_id`, `book_id`, `comment`, `date`) VALUES
(44, 13, 1, 'yvPv5fLlIPHoIOPuIODq7iDi6CDv8OXv7uTg4uAgyOLg7e7iIQ==', '2011-Mar-22 18:22:38');

-- --------------------------------------------------------

--
-- Структура на таблица `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` text CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Дъмп (схема) на данните в таблицата `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'БЕЛ'),
(2, 'Англ. език'),
(3, 'Руски език'),
(4, 'Немски език'),
(5, 'ИТ'),
(6, 'История'),
(7, 'Математика'),
(8, 'Биология'),
(9, 'Информатика'),
(10, 'Сборник'),
(11, 'Химия'),
(12, 'Физика'),
(13, 'Друг'),
(15, 'Етика и право'),
(16, 'Свят и личност'),
(17, 'Психология и логика');

-- --------------------------------------------------------

--
-- Структура на таблица `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `date` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `read` enum('NO','YES') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Дъмп (схема) на данните в таблицата `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `date`, `message`, `read`) VALUES
(2, 1, 3, '2011-Feb-12 17:10:52', 'zf/s4CDr6CDk4CDx6CDk7uHg4uj4IPP35eHt6PboLCDt5fnuLi4uIM3/7OD4IOvoIPHy4PDoIPP35eHt6PboIOfgIO/w7uTg7T8g0uLgIOLl9+Ug5SDu9Oj26ODr7eDy4CDi5fDx6P8sIPLz6iDs7ublIOTgIPHoIOrg9+Lg7OUg8uDq7uLg8uAuIM7x4uXtIPLu4uAg8evl5OLg+e7y7iDt5fnuIOru5fLuIPnlIO3g7+j44CD55SDlIPPk5eHl6+Xt7ijo6+gg7+7t5SDh6CDy8P/h4uDr7iDk4CDh+uTlKSDK4OboIOzoIOTg6+gg5SDz5OXh5evl7e4g6OvoIOLo5uTg+CDy4OPu4uXy5SDn4CBodG1sOg0KJmx0O2ImZ3Q70+Tl4eXr5e3uJmx0Oy9iJmd0Ow==', 'YES'),
(10, 11, 13, '2011-Feb-23 21:59:13', 'we7w8eDy4CDw4OHu8ugg7O3u4+4g5O7h8OUhISE=', 'YES'),
(14, 23, 6, '2011-Mar-23 23:27:34', 'YXdlIG1haSB0ZSBwb3puYXZhdCB0aSBkYSBuZSBzaSBlZGluIGZpZmEg', 'NO');

-- --------------------------------------------------------

--
-- Структура на таблица `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(35) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  `last_name` varchar(35) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  `residence` varchar(35) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  `avatar` varchar(140) COLLATE latin1_general_ci NOT NULL DEFAULT 'pics/avatars/avatar_default.gif',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=28 ;

--
-- Дъмп (схема) на данните в таблицата `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `residence`, `avatar`) VALUES
(1, 1, 'Венци', 'Конов', 'Пловдив', 'pics/avatars/avatar_default.gif'),
(3, 3, 'Страшимир', 'Рашев', 'Пловдив', 'pics/avatars/avatar_default.gif'),
(4, 4, '', '', '', 'pics/avatars/avatar_default.gif'),
(5, 5, '', '', 'Plovdiv', 'http://alfa.kachi-snimka.info/images/bwy1300136688v.jpg'),
(6, 6, '', '', '', 'pics/avatars/avatar_default.gif'),
(7, 7, '', '', '', 'pics/avatars/avatar_default.gif'),
(9, 9, '', '', '', 'pics/avatars/avatar_default.gif'),
(11, 11, 'Стоян', 'Тодоров', 'Пловдив', 'pics/avatars/avatar_default.gif'),
(14, 14, 'Roskata', '', 'Plovdiv', 'pics/avatars/avatar_default.gif'),
(13, 13, 'Димитър', 'Керезов', 'Пловдив', 'pics/avatars/avatar_default.gif'),
(15, 15, '', '', '', 'pics/avatars/avatar_default.gif'),
(18, 18, '', '', '', 'pics/avatars/avatar1.gif'),
(19, 19, '', '', '', 'pics/avatars/avatar_default.gif'),
(20, 20, '', '', '', 'pics/avatars/avatar_default.gif'),
(21, 21, '', '', '', 'pics/avatars/avatar_default.gif'),
(23, 23, '', '', '', 'pics/avatars/avatar_default.gif'),
(25, 25, '', '', '', 'pics/avatars/avatar_default.gif'),
(27, 27, '', '', '', 'pics/avatars/avatar_default.gif');

-- --------------------------------------------------------

--
-- Структура на таблица `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET cp1251 COLLATE cp1251_general_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Дъмп (схема) на данните в таблицата `publisher`
--

INSERT INTO `publisher` (`id`, `name`) VALUES
(1, 'Булвест 2000'),
(2, 'Просвета'),
(3, 'Летера'),
(4, 'Екстрем'),
(5, 'Анубис'),
(6, 'Регалия 6'),
(7, 'Друго'),
(8, 'Longman'),
(9, 'Hueber'),
(11, 'Изкуства');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('SADMIN','ADMIN','USER') COLLATE utf8_unicode_ci NOT NULL,
  `e-mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GSM` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gsm_viewable` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `skype` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `skype_viewable` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `design` enum('green','blue','black','red','yellow') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'green',
  `lang` enum('bg','en') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=28 ;

--
-- Дъмп (схема) на данните в таблицата `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `e-mail`, `GSM`, `gsm_viewable`, `skype`, `skype_viewable`, `design`, `lang`) VALUES
(1, 'LucasBoy', '20176a3768ab817aeac4bfa8296a2a56', 'SADMIN', 'ventsi.konov@gmail.com', '0886347273', 'YES', 'lucasboy_k', 'YES', 'blue', 'en'),
(3, 'CyberSirius', '3c1b3d790e3320bd76eb04b83737e3b4', 'USER', 'sirius.rashev@gmail.com', '0899965173', 'NO', 'cybersirius', 'NO', 'black', 'bg'),
(4, 'user', '6ad14ba9986e3615423dfca256d04e3f', 'USER', 'user@abv.bg', '', 'NO', '', 'NO', 'green', 'bg'),
(5, 'darkstep', 'e10adc3949ba59abbe56e057f20f883e', 'USER', 'headless94@gmail.com', '', 'NO', 'darkstep94', 'YES', 'blue', 'bg'),
(6, 'crew', '910b56b46aa03f5ad500ff563f86d128', 'USER', 'crew@mail.bg', '', 'NO', '', 'NO', 'green', 'bg'),
(7, 'kalikolitko', '670b14728ad9902aecba32e22fa4f6bd', 'USER', 'kalikolitko1@mail.bg', '', 'NO', '', 'NO', 'green', 'en'),
(9, 'ico0', 'bb66fd9d8f42aa9d7a3fa6508b1af10f', 'USER', 'ih999@abv.bg', '', 'NO', '', 'NO', 'green', 'bg'),
(11, 'xstox', 'cc7d4575adba4363cdcdb4f65eda24be', 'USER', 'st.todorov9@gmail.com', '0889875085', 'YES', '', 'YES', 'green', 'bg'),
(14, 'mmuhata', 'c10be958781a5b9662f3b8ac4625e314', 'USER', 'roko994@abv.bg', '', 'NO', '', 'NO', 'green', 'bg'),
(13, 'orokhan', '9d85cd8bf53996df44dddb9a988da293', 'ADMIN', 'deadpool@abv.bg', '0893380622', 'NO', 'orokhan', 'NO', 'green', 'bg'),
(15, 'emodivaka', '48b89c16d617d5ecd7020ff41a6d935a', 'USER', 'emilslavc@abv.bg', '', 'NO', '', 'NO', 'green', 'bg'),
(19, 'wyterzzz', '46f94c8de14fb36680850768ff1b7f2a', 'USER', 'wyterzzz@hotmail.com', '', 'NO', '', 'NO', 'yellow', 'bg'),
(18, 'tery', '9d82467029afecd6b6cc1757fea275da', 'USER', 'tery@abv.bg', '123', 'YES', 'fff', 'YES', 'green', 'bg'),
(20, 'user123', 'ee11cbb19052e40b07aac0ca060c23ee', 'USER', 'user@abv.bg', '', 'NO', '', 'NO', 'green', 'bg'),
(21, 'demouser', '91017d590a69dc49807671a51f10ab7f', 'USER', 'demo@user.bg', '', 'NO', '', 'NO', 'blue', 'bg'),
(23, 'cefothe', '670b14728ad9902aecba32e22fa4f6bd', 'USER', 'cefothe@gmail.com', '', 'NO', '', 'NO', 'yellow', 'bg'),
(25, 'alex687', 'e95b09ff9c72d55b0794f8c4c5456923', 'USER', 'pro687@abv.bg', '', 'NO', '', 'NO', 'blue', 'bg'),
(27, 'tester', '098f6bcd4621d373cade4e832627b4f6', 'USER', 'tester@test.org', '', 'NO', '', 'NO', 'green', 'bg');
