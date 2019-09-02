create database testavito;
use testavito;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- База данных: `testavito`
--

-- --------------------------------------------------------

--
-- Структура таблицы `rand`
--

CREATE TABLE `rand` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rand`
--

INSERT INTO `rand` (`id`, `value`, `type`) VALUES
(1, 'YoPzXN5w5y', '3'),
(2, '360008865561676', '1'),
(3, 'mrvTQrGCJwlsAYV', '2'),
(4, 'qjkR98QWAtoLO1IhifUjQkmxO0Z75Q', '3'),
(5, 'AEB24CA6-6943-4919-BD73-35D56D', '4'),
(6, 'dfdfdgsgaafddsdgfsddd4sfgassd4', '4asdfsdgdfsgasfdsd'),
(7, 'aadadggdgf', '4asdfsdgdfsgasfdsd');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rand`
--
ALTER TABLE `rand`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rand`
--
ALTER TABLE `rand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
