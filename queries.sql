-- Время создания: Фев 20 2019 г., 23:42

--
-- База данных: `schema`
--

-- --------------------------------------------------------
--
-- Структура таблицы `schm_bets`
--
INSERT INTO `schm_bets` (`date`, `bid_price`) VALUES (UNIX_TIMESTAMP(), '15000');

-- --------------------------------------------------------

--
-- Структура таблицы `schm_category`
--
INSERT INTO `schm_category` (`category`) VALUES ('Сноуборды');

-- --------------------------------------------------------

--
-- Структура таблицы `schm_lots`
--
INSERT INTO `schm_lots` (
  `date_reg`, `title`, `description`, `image`, `init_price`, `date_end`, `bid_inc`) 
  VALUES (UNIX_TIMESTAMP(), 'Лыжи Супер', 'сами едут', 'ski.jpg', '10000', UNIX_TIMESTAMP(), '10');

-- --------------------------------------------------------

--
-- Структура таблицы `schm_users`
--
INSERT INTO `schm_users` (
  `name`, `email`, `password`, `date_reg`, `contact_info`, `avatar`) 
  VALUES ('КоляА', 'koko@mail.ru', MD5('123'), UNIX_TIMESTAMP(), 'адрес', 'ava.png');
