-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июл 25 2024 г., 18:21
-- Версия сервера: 5.7.24
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `films`
--

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int(10) NOT NULL,
  `Title` varchar(60) NOT NULL,
  `Year` int(11) NOT NULL,
  `Budjet` int(20) NOT NULL,
  `Studio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `Title`, `Year`, `Budjet`, `Studio_id`) VALUES
(1, 'Alien', 1979, 11000000, 1),
(2, 'The Matrix', 1999, 63000000, 2),
(3, 'The Lord of the Rings', 2001, 281000000, 3),
(4, 'Drunken Master', 1978, 16500000, 4),
(5, 'Deadpool', 2016, 58000000, 1),
(6, 'Spirited Away', 2001, 19000000, 5),
(7, 'Pirates of the Caribbean: The Curse of The Black Pearl', 2003, 140000000, 6),
(8, 'Princess Mononoke', 1997, 23500000, 5),
(9, 'The Shawshank Redemption', 1994, 25000000, 7),
(10, 'The Wolf of Wall Street', 2013, 100000000, 8),
(11, 'The Gangster, the Cop, the Devil', 2019, 6500000, 9),
(12, 'Yip Man', 2008, 11715578, 10),
(13, 'Taxi', 1998, 8700000, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `studios`
--

CREATE TABLE `studios` (
  `id` int(4) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Country` varchar(40) NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `studios`
--

INSERT INTO `studios` (`id`, `Name`, `Country`, `Year`) VALUES
(1, '20th Century Fox', 'USA', 1933),
(2, 'Warner Bros.', 'USA', 1923),
(3, 'New Line Cinema', 'USA', 1967),
(4, 'Seasonal Film Corporation', 'China', 1974),
(5, 'Studio Ghibli', 'Japan', 1985),
(6, 'Walt Disney Pictures', 'USA', 1923),
(7, 'Castle Rock Entertainment', 'USA', 1985),
(8, 'Appian Way Productions', 'USA', 2004),
(9, 'B.A. Entertainment', 'The Republic of Korea', 2013),
(10, 'Mandarin Films Distribution', 'China', 1991),
(11, 'Le Studio Canal+', 'France', 1988);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Studio_id` (`Studio_id`);

--
-- Индексы таблицы `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `studios`
--
ALTER TABLE `studios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`Studio_id`) REFERENCES `studios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
