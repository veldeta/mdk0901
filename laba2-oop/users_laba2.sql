-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 12 2021 г., 19:15
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users_laba2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `_date` timestamp NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name_user`, `_date`, `email`, `admin`) VALUES
(1, 'good', '12345678', 'Никита Ульянов', '2021-10-09 21:00:00', '100001@student.spb-rtk.ru', 'false'),
(2, 'veldeta1', '12345678', 'Вячеслав Сергеевич Архипов', '2021-10-09 21:00:00', 'terminatorslava38@gmail.com', 'false'),
(3, 'veldeta11', '12345678', 'Вячеслав Сергеевич Архипов', '2021-10-09 21:00:00', 'terminatorslava38@gmail.com', 'false'),
(9, 'veldeta111', '12345678', 'Вячеслав Сергеевич Архипов', '2021-10-09 21:00:00', 'terminatorslava38@gmail.com', 'false'),
(16, 'good2002', '12345678', 'Никита Ульянов', '2021-10-09 21:00:00', '100001@student.spb-rtk.ru', 'false'),
(17, 'veldeta', '19010311Slava', 'Вячеслав Сергеевич Архипов', '2000-10-08 21:00:00', 'terminatorslava38@gmail.com', 'false'),
(18, 'good2002&&&&&', '$2y$10$iZxc8vs62QrqpxmPjE2tJupXd.BYQRyDkW8M22bwUUM4SKJexVtry', 'Сергей Ульянов', '1993-10-19 21:00:00', '100001@student.spb-rtk.ru', 'false'),
(19, 'admin', '$2y$10$NI6fOvNxBw3ddA2S0iJVWe0hEzHlbzKN.6MnYJiJ87UgVKYv55e.i', 'Романов Эрнест Георгиевич', '2000-10-08 21:00:00', 'admi@admin.ru', 'true');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
