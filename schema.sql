-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 22 2019 г., 22:31
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE yeticave DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `schema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `schm_bets`
--

CREATE TABLE `schm_bets` (
  `id` int(8) UNSIGNED NOT NULL COMMENT 'номер',
  `date_reg` datetime(6) NOT NULL COMMENT 'дата регистрации',
  `bid_price` int(8) UNSIGNED NOT NULL COMMENT 'цена спроса',
  `id_user` int(8) UNSIGNED NOT NULL COMMENT 'ссылка на пользователя',
  `id_lot` int(8) UNSIGNED NOT NULL COMMENT 'ссылка на лот'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='таблица ставок';

-- --------------------------------------------------------

--
-- Структура таблицы `schm_category`
--

CREATE TABLE `schm_category` (
  `id` int(8) UNSIGNED NOT NULL COMMENT 'номер',
  `category` char(30) NOT NULL COMMENT 'категория'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='таблица категорий';

-- --------------------------------------------------------

--
-- Структура таблицы `schm_lots`
--

CREATE TABLE `schm_lots` (
  `id` int(8) NOT NULL COMMENT 'номер',
  `date_reg` datetime(6) NOT NULL COMMENT 'дата создания',
  `title` varchar(255) NOT NULL COMMENT 'название',
  `description` varchar(255) NOT NULL COMMENT 'описание',
  `image` varchar(255) NOT NULL COMMENT 'ссылка на изображение',
  `init_price` int(8) UNSIGNED NOT NULL COMMENT 'начальная цена',
  `deal_price` int(8) UNSIGNED DEFAULT NULL COMMENT 'цена сделки',
  `date_end` datetime(6) NOT NULL COMMENT 'дата завершения',
  `bid_inc` int(8) UNSIGNED NOT NULL COMMENT 'шаг ставки',
  `id_user` int(8) UNSIGNED NOT NULL COMMENT 'ссылка на пользователя',
  `id_winner` int(8) UNSIGNED DEFAULT NULL COMMENT 'ссылка на победителя',
  `id_category` int(8) UNSIGNED NOT NULL COMMENT 'ссылка на категорию'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='таблица лотов';

-- --------------------------------------------------------

--
-- Структура таблицы `schm_users`
--

CREATE TABLE `schm_users` (
  `id` int(8) UNSIGNED NOT NULL COMMENT 'номер',
  `name` varchar(30) NOT NULL COMMENT 'имя',
  `email` varchar(30) NOT NULL COMMENT 'email',
  `password` char(32) NOT NULL COMMENT 'пароль',
  `date_reg` datetime(6) NOT NULL COMMENT 'дата регистрации',
  `contact_info` varchar(255) NOT NULL COMMENT 'контактная инфо',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'ссылка на аватар'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='пользователи для БД schema';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `schm_bets`
--
ALTER TABLE `schm_bets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `schm_category`
--
ALTER TABLE `schm_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `schm_lots`
--
ALTER TABLE `schm_lots`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `schm_bets`
--
ALTER TABLE `schm_bets`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'номер', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `schm_category`
--
ALTER TABLE `schm_category`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'номер', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `schm_lots`
--
ALTER TABLE `schm_lots`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'номер', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `schm_users`
--
ALTER TABLE `schm_users`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'номер', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
