-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 25 2021 г., 01:47
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mosiaeva_db`
--
CREATE DATABASE IF NOT EXISTS `mosiaeva_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mosiaeva_db`;

-- --------------------------------------------------------

--
-- Структура таблицы `ord`
--

DROP TABLE IF EXISTS `ord`;
CREATE TABLE `ord` (
  `id` int NOT NULL,
  `time` varchar(11) NOT NULL,
  `price` float NOT NULL,
  `user_id` int NOT NULL,
  `product` text NOT NULL,
  `status` enum('closed','processed','overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL,
  `category` enum('Гоночные','Горные','Городские','Электротранспорт') NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `property` text NOT NULL,
  `price` float NOT NULL,
  `vender_id` int NOT NULL,
  `status` enum('empty','take','not') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category`, `name`, `description`, `img`, `property`, `price`, `vender_id`, `status`) VALUES
(56, 'Электротранспорт', 'HAIBIKE SDURO Trekking 2.5 men (2', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QBmRXhpZgAATU0AKgAAAAgABQMBAAUAAAABAAAASgMCAAIAAAAMAAAAUlEQAAEAAAABAQAAAFERAAQAAAABAAAOwlESAAQAAAABAAAOwgAAAAAAAYagAACxjklDQyBQcm9maWxlAP/iDFhJQ0NfUFJPRklMRQABAQAADEhMaW5vAhAAAG1udHJSR0IgWFlaIAfOAAIACQAG', '{\"name\":[],\"value\":[]}', 238900, 1, 'take'),
(57, 'Гоночные', 'Cervelo Aspero Disc Force eTap AXS 1 (2020)', '123', 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABGAAD/4QOFaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4Onht', '{\"name\":[],\"value\":[]}', 445500, 2, 'take'),
(59, 'Горные', 'Stark Tank 29.1 HD (2021)', '123', 'data:image/jpeg;base64,/9j/4RaZRXhpZgAATU0AKgAAAAgADAEAAAMAAAABFa4AAAEBAAMAAAABDnQAAAECAAMAAAADAAAAngEGAAMAAAABAAIAAAESAAMAAAABAAEAAAEVAAMAAAABAAMAAAEaAAUAAAABAAAApAEbAAUAAAABAAAArAEoAAMAAAABAAIAAAExAAIAAAAfAAAAtAEyAAIAAAAUAAAA04dpAAQAAAABAAAA6AAAASAACAAI', '{\"name\":[],\"value\":[]}', 25650, 3, 'take'),
(60, 'Городские', 'Stels Navigator 250 Gent 26 Z010', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QCuRXhpZgAATU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAZKGAAcAAAB6AAAALAAAAABVTklDT0RFAABDAFIARQBBAFQATwBSADoAIABnAGQALQBqAHAAZQBnACAAdgAxAC4AMAAgACgAdQBzAGkAbgBnACAASQBKAEcAIABKAFAARQBHACAAdgA2ADIAKQAsACAAcQB1', '{\"name\":[],\"value\":[]}', 12050, 4, 'take'),
(61, 'Гоночные', 'Cervelo Aspero Apex 1 (2020)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD//gA7Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2NjIpLCBxdWFsaXR5ID0gNzUK/9sAQwAIBgYHBgUIBwcHCQkICgwUDQwLCwwZEhMPFB0aHx4dGhwcICQuJyAiLCMcHCg3KSwwMTQ0NB8nOT04MjwuMzQy/9sAQwEJCQkMCwwYDQ0YMiEcITIyMjIy', '{\"name\":[],\"value\":[]}', 243000, 2, 'take'),
(62, 'Гоночные', 'Merida Speeder GT-R (80) (2021)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wAARCAVKCcQDASIAAhEB', '{\"name\":[],\"value\":[]}', 41997, 5, 'take'),
(63, 'Гоночные', 'Merida REACTO TEAM-E (2021)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wAARCAYdCcQDASIAAhEB', '{\"name\":[],\"value\":[]}', 494550, 5, 'take'),
(64, 'Горные', 'Stinger PYTHON STD 27.5 (2021)', '123', 'data:image/jpeg;base64,/9j/4RgYRXhpZgAATU0AKgAAAAgADAEAAAMAAAABE6kAAAEBAAMAAAABE6kAAAECAAMAAAADAAAAngEGAAMAAAABAAIAAAESAAMAAAABAAEAAAEVAAMAAAABAAMAAAEaAAUAAAABAAAApAEbAAUAAAABAAAArAEoAAMAAAABAAIAAAExAAIAAAAiAAAAtAEyAAIAAAAUAAAA1odpAAQAAAABAAAA7AAAASQACAAI', '{\"name\":[],\"value\":[]}', 28000, 6, 'take'),
(65, 'Горные', 'Stark Pusher 1 (2020)', '123', 'data:image/jpeg;base64,/9j/4RXDRXhpZgAATU0AKgAAAAgADAEAAAMAAAABFa4AAAEBAAMAAAABDnQAAAECAAMAAAADAAAAngEGAAMAAAABAAIAAAESAAMAAAABAAEAAAEVAAMAAAABAAMAAAEaAAUAAAABAAAApAEbAAUAAAABAAAArAEoAAMAAAABAAIAAAExAAIAAAAiAAAAtAEyAAIAAAAUAAAA1odpAAQAAAABAAAA7AAAASQACAAI', '{\"name\":[],\"value\":[]}', 46580, 3, 'take'),
(66, 'Горные', 'Black One Monster 24 D (2021)', '123', 'data:image/jpeg;base64,/9j/4Rj/RXhpZgAATU0AKgAAAAgADAEAAAMAAAABFa4AAAEBAAMAAAABDnQAAAECAAMAAAADAAAAngEGAAMAAAABAAIAAAESAAMAAAABAAEAAAEVAAMAAAABAAMAAAEaAAUAAAABAAAApAEbAAUAAAABAAAArAEoAAMAAAABAAIAAAExAAIAAAAiAAAAtAEyAAIAAAAUAAAA1odpAAQAAAABAAAA7AAAASQACAAI', '{\"name\":[],\"value\":[]}', 19990, 7, 'take'),
(67, 'Городские', 'SCOTT Sub Cross 30 Lady (2021)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/7QBEUGhvdG9zaG9wIDMuMAA4QklNA+4AAAAAAA0MVHJhbnNwYXJlbmN5ADhCSU0D7wAAAAAADgAC//////////8AZAEA/+IL4ElDQ19QUk9GSUxFAAEBAAAL0G5vbmUCAAAAbW50clJHQiBYWVogB9QABwAVABIAOQAqYWNzcAAAAAAAAAAASUVDIHNSR0IAAAABAAAAAAAA', '{\"name\":[],\"value\":[]}', 66600, 8, 'take'),
(68, 'Городские', 'Stels Cross-150 D Lady 28 V010', '123', 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABGAAD/4QOFaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4Onht', '{\"name\":[],\"value\":[]}', 40050, 4, 'take'),
(69, 'Городские', 'Stark Terros 700 S (2021)', '123', 'data:image/jpeg;base64,/9j/4RRnRXhpZgAATU0AKgAAAAgADAEAAAMAAAABFa4AAAEBAAMAAAABDnQAAAECAAMAAAADAAAAngEGAAMAAAABAAIAAAESAAMAAAABAAEAAAEVAAMAAAABAAMAAAEaAAUAAAABAAAApAEbAAUAAAABAAAArAEoAAMAAAABAAIAAAExAAIAAAAfAAAAtAEyAAIAAAAUAAAA04dpAAQAAAABAAAA6AAAASAACAAI', '{\"name\":[],\"value\":[]}', 19120, 3, 'take'),
(70, 'Электротранспорт', 'HAIBIKE XDURO AllMtn 3.0 (2020)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QBaRXhpZgAATU0AKgAAAAgABQMBAAUAAAABAAAASgMDAAEAAAABAAAAAFEQAAEAAAABAQAAAFERAAQAAAABAAAuIlESAAQAAAABAAAuIgAAAAAAAYagAACxj//bAEMAAgEBAgEBAgICAgICAgIDBQMDAwMDBgQEAwUHBgcHBwYHBwgJCwkICAoIBwcKDQoKCwwMDAwHCQ4P', '{\"name\":[],\"value\":[]}', 499900, 1, 'take'),
(71, 'Электротранспорт', 'HAIBIKE XDURO NDURO 10.0 (2020)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QBmRXhpZgAATU0AKgAAAAgABQMBAAUAAAABAAAASgMCAAIAAAAMAAAAUlEQAAEAAAABAQAAAFERAAQAAAABAAAOwlESAAQAAAABAAAOwgAAAAAAAYagAACxjklDQyBQcm9maWxlAP/iDFhJQ0NfUFJPRklMRQABAQAADEhMaW5vAhAAAG1udHJSR0IgWFlaIAfOAAIACQAG', '{\"name\":[],\"value\":[]}', 969900, 1, 'take'),
(72, 'Электротранспорт', 'HAIBIKE XDURO Nduro 5.0 (2020)', '123', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QBaRXhpZgAATU0AKgAAAAgABQMBAAUAAAABAAAASgMDAAEAAAABAAAAAFEQAAEAAAABAQAAAFERAAQAAAABAAAOw1ESAAQAAAABAAAOwwAAAAAAAYagAACxj//bAEMAAgEBAgEBAgICAgICAgIDBQMDAwMDBgQEAwUHBgcHBwYHBwgJCwkICAoIBwcKDQoKCwwMDAwHCQ4P', '{\"name\":[],\"value\":[]}', 699900, 1, 'take');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `status` enum('admin','employee','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vender`
--

DROP TABLE IF EXISTS `vender`;
CREATE TABLE `vender` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `inn` varchar(12) NOT NULL,
  `director` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `legal_address` varchar(255) NOT NULL,
  `actual_address` varchar(255) NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vender`
--
ALTER TABLE `vender`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ord`
--
ALTER TABLE `ord`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `vender`
--
ALTER TABLE `vender`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
