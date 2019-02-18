-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 19 2019 г., 01:25
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `schema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `schm_users`
--

CREATE TABLE `schm_users` (
  `id` int(8) UNSIGNED NOT NULL COMMENT 'id',
  `name` varchar(30) NOT NULL COMMENT 'имя',
  `email` varchar(30) NOT NULL COMMENT 'email',
  `password` char(32) NOT NULL COMMENT 'пароль',
  `date_reg` int(10) UNSIGNED NOT NULL COMMENT 'дата регистрации',
  `contact_info` varchar(255) NOT NULL COMMENT 'контактная инфо',
  `avatar` varchar(255) NOT NULL COMMENT 'ссылка на аватар'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='пользователи для БД schema';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `schm_users`
--
ALTER TABLE `schm_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `schm_users`
--
ALTER TABLE `schm_users`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
