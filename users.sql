-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 28 2023 г., 17:16
-- Версия сервера: 5.7.33-log
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `phone_number`, `email`, `password`) VALUES
(1, 'Evgen', 1234566778, 'evgen@mail.ru', '$2y$10$ez9GCGXk189G3b/Tw8cjjenl4LYlORDoxBLz3tLQzrgDzVIpYaAOC'),
(2, 'Oleg', 1234567890, 'oleg@gmail.com', '$2y$10$Chs5lJHV90Il.g3z.m20ruE.DSs2rFB1LbNE19pEb/bvOSwqNBOwK'),
(3, 'Raul', 1234567899, 'raul@ya.ru', '$2y$10$TbX6Xzg7aW6BDO5ziShxcOd..GCF1yp4db0mX9G4H6EX67azouFM2'),
(4, 'John', 1234567888, 'john@gmail.com', '$2y$10$fPp/eMRCyDcPFDeGLh0t1eTdoK0DfSrk49HE/QQGKnImMFbR7FVqe'),
(5, 'Artem', 1234567877, 'artem@gmail.com', '$2y$10$8D/zXHIRFCLgCU0LI2O6Su.sa348fKpitE47nU6UjWYSvxDjFXfJ6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
