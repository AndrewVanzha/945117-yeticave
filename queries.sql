--
-- База данных: `schema`
--

-- --------------------------------------------------------

--
-- Дамп данных таблицы `schm_bets`
--

INSERT INTO `schm_bets` (`id`, `date_reg`, `bid_price`, `id_user`, `id_lot`) VALUES
(1, '2019-02-21 11:00:00.000000', 9199, 1, 1),
(2, '2019-02-21 11:30:00.000000', 9399, 2, 1),
(3, '2019-02-21 12:00:00.000000', 7150, 2, 5);

-- --------------------------------------------------------

--
-- Дамп данных таблицы `schm_category`
--

INSERT INTO `schm_category` (`id`, `category`) VALUES
(1, 'Доски и лыжи'),
(2, 'Крепления'),
(3, 'Ботинки'),
(4, 'Одежда'),
(5, 'Инструменты'),
(6, 'Разное');

-- --------------------------------------------------------

--
-- Дамп данных таблицы `schm_lots`
--

INSERT INTO `schm_lots` (`id`, `date_reg`, `title`, `description`, `image`, `init_price`, `deal_price`, `date_end`, `bid_inc`, `id_user`, `id_winner`, `id_category`) VALUES
(1, '2019-02-21 10:00:00.000000', '2014 Rossignol District Snowboard', '2014 Rossignol District Snowboard', 'img/lot-1.jpg', 10999, 10999, '2019-02-21 20:00:00.000000', 5, 3, NULL, 1),
(2, '2019-02-14 10:01:00.000000', 'DC Ply Mens 2016/2017 Snowboard', 'DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', 15999, 15999, '2019-02-21 20:03:00.000000', 5, 3, NULL, 1),
(3, '2019-02-23 10:04:00.000000', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', 8000, 8000, '2019-02-21 20:06:00.000000', 5, 2, NULL, 2),
(4, '2019-02-21 10:07:00.000000', 'Ботинки для сноуборда DC Mutiny Charocal', 'Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', 10999, 10999, '2019-02-21 19:07:00.000000', 5, 3, NULL, 3),
(5, '2019-02-21 10:10:00.000000', 'Куртка для сноуборда DC Mutiny Charocal', 'Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', 7500, 7500, '2019-02-21 20:12:00.000000', 5, 3, NULL, 4),
(6, '2019-02-21 10:14:00.000000', 'Маска Oakley Canopy', 'Маска Oakley Canopy', 'img/lot-6.jpg', 5400, 5400, '2019-02-21 20:12:00.000000', 5, 2, NULL, 6);

-- --------------------------------------------------------

--
-- Дамп данных таблицы `schm_users`
--

INSERT INTO `schm_users` (`id`, `name`, `email`, `password`, `date_reg`, `contact_info`, `avatar`) VALUES
(1, 'Андрей', 'andrew@mail.ru', '123', '2019-02-21 00:00:00.000000', 'ул.Первомая, д.22', ''),
(2, 'Николай', 'nicolas@@mail.ru', '123', '2019-02-21 00:00:00.000000', 'ул.Первомая, д.22', ''),
(3, 'Петр', 'piter@mail.ru', '123', '2019-02-21 00:00:00.000000', 'ул.Первомая, д.26', '');

-- --------------------------------------------------------

-- Запросы к таблице `schm_category`
SELECT * FROM schm_category;

-- Запросы к таблице `schm_lots`
SELECT schm_lots.title, schm_lots.init_price, schm_lots.image, schm_lots.deal_price, schm_category.category
  FROM schm_lots, schm_category WHERE (schm_lots.id_category = schm_category.id AND schm_lots.id_winner IS NULL)
  ORDER BY schm_lots.date_reg DESC LIMIT 3;

-- Запросы к таблице `schm_lots`
SELECT schm_lots.id, schm_lots.date_reg, schm_lots.title, schm_lots.description, schm_lots.image, schm_lots.init_price, 
  schm_lots.deal_price, schm_lots.date_end, schm_lots.bid_inc, schm_lots.id_user, schm_lots.id_winner,
  schm_category.category FROM schm_lots, schm_category WHERE (schm_lots.id_category = schm_category.id AND schm_lots.id=2);

-- Запросы к таблице `schm_lots`
UPDATE schm_lots SET title='2014 Rossignol District Snowboard_ddd' WHERE id=1;

-- Запросы к таблице `schm_bets`
SELECT id_lot, bid_price, date_reg FROM schm_bets WHERE (id_lot=1) ORDER BY date_reg DESC LIMIT 3;
