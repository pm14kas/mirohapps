-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 02 2017 г., 21:17
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `proco`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gruppa`
--

CREATE TABLE `gruppa` (
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `gruppa`
--

INSERT INTO `gruppa` (`name`) VALUES
('AM-14-2'),
('YK-12-1');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `time` tinyint(4) NOT NULL,
  `aud` text CHARACTER SET utf8 NOT NULL,
  `gruppa` text CHARACTER SET utf8 NOT NULL,
  `week` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `lesson`
--

INSERT INTO `lesson` (`id`, `time`, `aud`, `gruppa`, `week`) VALUES
(1, 1, '9-401', 'AM-14-2', 1),
(2, 3, '246', 'AM-14-2', 0),
(17, 2, '9-401', 'YK-12-1', 1),
(25, 7, '246', 'YK-12-1', 1),
(26, 1, '246', 'AM-14-2', 1),
(27, 2, '246', 'YK-12-1', 1),
(28, 3, '246', 'AM-14-2', 1),
(29, 5, '246', 'YK-12-1', 1),
(32, 5, '9-401', 'AM-14-2', 0),
(35, 3, '9-401', 'YK-12-1', 1),
(36, 1, '9-401', 'AM-14-2', 0),
(37, 2, '9-401', 'AM-14-2', 0),
(38, 3, '9-401', 'YK-12-1', 0),
(39, 7, '9-401', 'YK-12-1', 1),
(40, 7, '246', 'AM-14-2', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL,
  `name` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `time`
--

INSERT INTO `time` (`id`, `name`) VALUES
(1, '08:00:00'),
(2, '09:40:00'),
(3, '11:20:00'),
(4, '13:20:00'),
(5, '15:00:00'),
(6, '16:40:00'),
(7, '18:20:00'),
(8, '20:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gruppa`
--
ALTER TABLE `gruppa`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
