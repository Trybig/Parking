-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 29 2020 г., 19:22
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `parking`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `at_parking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `color`, `car_number`, `at_parking`) VALUES
(1, 'FORD', 'FOCUS', 'серый', 'ВК384У', 'yes'),
(2, 'KIA', 'SPECTRA', 'черный', 'Р070РО', 'no'),
(3, 'lexus', 'lx 570', 'белый', 'В015НО', 'yes'),
(4, 'honda', 'civic', 'зеленый', 'У985БА', 'no'),
(5, 'hyundai', 'solaris', 'серый', 'М564НУ', 'yes'),
(6, 'mitsubishi ', 'lancer', 'черный', 'М326ВА', 'no'),
(7, 'toyota', 'corolla', 'белый', 'Н476ОБ', 'yes'),
(8, 'toyota ', 'camry', 'синий', 'М214КО', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `phone_number`, `adress`, `car`) VALUES
(1, 'Петров Петр', 'male', '89996541236', 'ул. Дзержинского', 2),
(2, 'Александров Александр', 'male', '+79023589515', 'ул. Николаевская', 1),
(3, 'Светланова Светлана', 'female', '+79515323625', 'улица Козловская', 4),
(4, 'Николаев Николай', 'male', '+79516248584', '', 2),
(5, 'Алексеев Алексей', 'male', '89996543211', 'ул.Новороссийская', 1),
(6, 'Катеринова Екатерина', 'female', '89512563215', '', 1),
(7, 'Олеговский Олег', 'male', '89542163524', 'ул. Шекснинская', 2),
(8, 'Иванов Иван', 'male', '89625644125', '', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
