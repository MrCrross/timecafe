-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 08 2023 г., 03:29
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `time_cafe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(85, '2014_10_12_000000_create_users_table', 1),
(86, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(87, '2019_08_19_000000_create_failed_jobs_table', 1),
(88, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(89, '2023_09_30_130110_create_products_types_table', 1),
(90, '2023_09_30_130118_create_products_table', 1),
(91, '2023_09_30_134312_create_users_params_table', 1),
(92, '2023_09_30_134331_create_users_users_params_table', 1),
(93, '2023_09_30_135322_create_rooms_rates_table', 1),
(94, '2023_09_30_135333_create_rooms_table', 1),
(95, '2023_09_30_135348_create_rooms_reservation_table', 1),
(96, '2023_09_30_135354_create_orders_table', 1),
(97, '2023_09_30_135400_create_orders_products_table', 1),
(98, '2023_10_07_230516_create_rooms_images_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `date_order` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `room_id`, `status`, `date_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '1986-06-13 10:38:04', NULL, NULL, NULL),
(2, 2, 1, '1972-08-03 07:58:54', NULL, NULL, NULL),
(3, 3, 1, '1996-02-04 13:11:52', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, NULL, NULL),
(2, 1, 2, 3, NULL, NULL),
(3, 1, 3, 1, NULL, NULL),
(4, 2, 1, 2, NULL, NULL),
(5, 2, 2, 3, NULL, NULL),
(6, 2, 3, 1, NULL, NULL),
(7, 3, 1, 2, NULL, NULL),
(8, 3, 2, 3, NULL, NULL),
(9, 3, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Финансовый советник', 2, 'https://via.placeholder.com/640x480.png/00bbaa?text=placeat', 1, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(2, 'Писатель', 176502383, 'https://via.placeholder.com/640x480.png/00dd66?text=atque', 2, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(3, 'Телефонистка', 706486, 'https://via.placeholder.com/640x480.png/00aaee?text=voluptatem', 3, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(4, 'Чабан', 62, 'https://via.placeholder.com/640x480.png/000066?text=soluta', 4, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(5, 'Бестиарий (гладиатор)', 18879189, 'https://via.placeholder.com/640x480.png/007700?text=enim', 5, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(6, 'Телохранитель', 537829, 'https://via.placeholder.com/640x480.png/009922?text=dolorem', 6, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(7, 'Гитарный мастер', 8780, 'https://via.placeholder.com/640x480.png/00ee66?text=omnis', 7, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(8, 'Абразивоструйщик', 94, '/upload/products/8/img.png', 8, '2023-10-18 13:09:57', '2023-10-23 14:43:55', NULL),
(9, 'Ветеринар', 1, 'https://via.placeholder.com/640x480.png/0033aa?text=velit', 9, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(10, 'Фотограф', 548075469, 'https://via.placeholder.com/640x480.png/00ddcc?text=cumque', 10, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products_types`
--

CREATE TABLE `products_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products_types`
--

INSERT INTO `products_types` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'vel', 'https://via.placeholder.com/640x480.png/008800?text=in', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(2, 'necessitatibus', 'https://via.placeholder.com/640x480.png/00aa99?text=libero', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(3, 'sit', 'https://via.placeholder.com/640x480.png/00aa11?text=consequatur', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(4, 'similique', 'https://via.placeholder.com/640x480.png/007799?text=dolor', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(5, 'est', 'https://via.placeholder.com/640x480.png/00ff66?text=et', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(6, 'eligendi', 'https://via.placeholder.com/640x480.png/00dd22?text=praesentium', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(7, 'non', 'https://via.placeholder.com/640x480.png/009944?text=est', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(8, 'beatae', 'https://via.placeholder.com/640x480.png/00bb88?text=animi', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(9, 'laborum', 'https://via.placeholder.com/640x480.png/00bbdd?text=deserunt', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(10, 'assumenda', 'https://via.placeholder.com/640x480.png/008899?text=consequuntur', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rate_id` bigint(20) UNSIGNED NOT NULL,
  `capacity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `image`, `rate_id`, `capacity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nobis', 'https://via.placeholder.com/640x480.png/003322?text=adipisci', 1, 5, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(2, 'minima', 'https://via.placeholder.com/640x480.png/0011dd?text=ratione', 2, 6, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(3, 'tempora', 'https://via.placeholder.com/640x480.png/0011bb?text=eum', 3, 1, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(4, 'repellendus', 'https://via.placeholder.com/640x480.png/004499?text=accusantium', 4, 7, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(5, 'aperiam', 'https://via.placeholder.com/640x480.png/00ccff?text=consectetur', 5, 7, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(6, 'qui', 'https://via.placeholder.com/640x480.png/007755?text=ut', 6, 7, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(7, 'rem', 'https://via.placeholder.com/640x480.png/009922?text=nesciunt', 7, 3, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(8, 'ea', 'https://via.placeholder.com/640x480.png/00bbee?text=omnis', 8, 10, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(9, 'nulla', 'https://via.placeholder.com/640x480.png/00ffaa?text=aut', 9, 4, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(10, 'vero', 'https://via.placeholder.com/640x480.png/004488?text=quia', 10, 8, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(11, 'ut', 'https://via.placeholder.com/640x480.png/00ff55?text=sed', 11, 7, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(12, 'dolor', 'https://via.placeholder.com/640x480.png/007700?text=praesentium', 12, 4, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(13, 'occaecati', 'https://via.placeholder.com/640x480.png/00aabb?text=cum', 13, 8, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(14, 'harum', 'https://via.placeholder.com/640x480.png/00cc55?text=odit', 14, 8, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(15, 'voluptas', 'https://via.placeholder.com/640x480.png/0011aa?text=voluptatum', 15, 9, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(16, 'eius', 'https://via.placeholder.com/640x480.png/007733?text=dolor', 16, 3, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(17, 'corrupti', 'https://via.placeholder.com/640x480.png/005555?text=dolore', 17, 6, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(18, 'dolorum', 'https://via.placeholder.com/640x480.png/006677?text=qui', 18, 6, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(19, 'suscipit', 'https://via.placeholder.com/640x480.png/00ffee?text=laboriosam', 19, 10, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(20, 'recusandae', 'https://via.placeholder.com/640x480.png/009999?text=et', 20, 9, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms_images`
--

CREATE TABLE `rooms_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rooms_images`
--

INSERT INTO `rooms_images` (`id`, `room_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://via.placeholder.com/640x480.png/0055bb?text=eum', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(2, 2, 'https://via.placeholder.com/640x480.png/0055dd?text=omnis', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(3, 3, 'https://via.placeholder.com/640x480.png/0077aa?text=libero', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(4, 4, 'https://via.placeholder.com/640x480.png/0044cc?text=harum', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(5, 5, 'https://via.placeholder.com/640x480.png/00aa22?text=soluta', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(6, 6, 'https://via.placeholder.com/640x480.png/004433?text=sunt', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(7, 7, 'https://via.placeholder.com/640x480.png/002244?text=consequatur', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(8, 8, 'https://via.placeholder.com/640x480.png/00bb44?text=quod', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(9, 9, 'https://via.placeholder.com/640x480.png/00bb88?text=consequatur', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(10, 10, 'https://via.placeholder.com/640x480.png/0022dd?text=voluptatem', '2023-10-18 13:09:57', '2023-10-18 13:09:57');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms_rates`
--

CREATE TABLE `rooms_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rooms_rates`
--

INSERT INTO `rooms_rates` (`id`, `name`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'id', 317, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(2, 'et', 131, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(3, 'numquam', 637, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(4, 'quo', 759, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(5, 'ab', 986, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(6, 'pariatur', 952, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(7, 'quos', 819, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(8, 'quae', 933, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(9, 'dolorem', 310, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(10, 'doloribus', 403, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(11, 'reprehenderit', 639, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(12, 'ullam', 489, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(13, 'provident', 116, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(14, 'aspernatur', 117, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(15, 'sint', 869, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(16, 'veniam', 360, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(17, 'delectus', 758, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(18, 'atque', 214, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(19, 'aut', 151, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(20, 'voluptatem', 878, '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms_reservation`
--

CREATE TABLE `rooms_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `fio` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hours` tinyint(3) UNSIGNED NOT NULL,
  `capacity` int(10) UNSIGNED NOT NULL,
  `date_reserve` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rooms_reservation`
--

INSERT INTO `rooms_reservation` (`id`, `room_id`, `fio`, `email`, `hours`, `capacity`, `date_reserve`, `created_at`, `updated_at`) VALUES
(1, 11, 'Майя Владимировна Силинаа', 'kovaleva.kseniy@grisina.org', 4, 2, '1983-08-19 07:07:51', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(2, 12, 'Абрам Фёдорович Виноградова', 'mariy.belousov@narod.ru', 4, 3, '1992-02-10 01:21:57', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(3, 13, 'Мирослав Алексеевич Орлова', 'zfilippova@gmail.com', 4, 4, '2020-09-28 13:43:39', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(4, 14, 'Горшковаа Елизавета Романовна', 'savelev.arsenii@strelkov.ru', 5, 2, '2017-09-30 15:51:09', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(5, 15, 'Исаев Сергей Сергеевич', 'denis97@ya.ru', 4, 2, '1996-12-24 10:16:14', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(6, 16, 'Лаврентьева Пётр Иванович', 'ksavina@bolsakova.ru', 3, 2, '1996-12-24 17:49:12', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(7, 17, 'Лаврентьева Доминика Романовна', 'voronov.yn@rambler.ru', 5, 1, '2002-06-22 09:27:32', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(8, 18, 'Кузьминаа Зинаида Львовна', 'hersova@yandex.ru', 1, 2, '2022-10-27 23:57:08', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(9, 19, 'Веселова Илларион Львович', 'pserbakov@bk.ru', 4, 2, '1999-06-16 10:53:55', '2023-10-18 13:09:57', '2023-10-18 13:09:57'),
(10, 20, 'Любовь Львовна Афанасьеваа', 'tgusev@saskov.org', 2, 1, '1999-08-27 23:33:30', '2023-10-18 13:09:57', '2023-10-18 13:09:57');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fio` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `status`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Администратор', 'admin', 1, 'admin@timecafe.ru', '2023-10-18 13:09:56', '$2y$10$cnT.ibfgnyAL7UaaUky4EenVQLgf83zdOS8LtD/syENVaOzNiEST2', 'EJ9lFRgxXYr7FDlAjbxuoBrqeLWuLTTmV0UFsNB4Pb3Bg00LkejBl4mBpN7O', NULL, NULL, NULL),
(2, 'Гордеева Ксения Андреевна', 'karitonov.ru', 1, 'lysy.ykovleva@example.org', '2023-10-18 13:09:56', '$2y$10$U237mGBeA47mwjUAOY4nKepvmMUf8i3nnxpxlujIWC1YvUjQfnXD.', '7YO8Jtf4wO', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(3, 'Архипова Ананий Львович', 'molcanov.ru', 1, 'florentina.kulikova@example.org', '2023-10-18 13:09:56', '$2y$10$AWC95cRisuJObUA3daLEwOUvQ/pyW4Gia4crZbCofUho.rHE8Hdze', 'GUnMcD6FKS', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(4, 'Егор Алексеевич Харитонов', 'larionov.ru', 1, 'tkalinina@example.org', '2023-10-18 13:09:56', '$2y$10$VXUFIk9XJXnPmFIiloLt5.kForAyjLnK7Hg1dLwcbzXA2ntH1ct1y', 'k6ssUMp1d7', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(5, 'Соколова Викентий Романович', 'subin.ru', 1, 'rsitnikova@example.com', '2023-10-18 13:09:56', '$2y$10$fFkuNkqo5B39MBuU3XPCv.iMg833RyNdTQlqgIAqR9AnOl9SGCpeC', 'JBqbTpouHQ', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(6, 'Тимофей Борисович Савина', 'sysoev.ru', 1, 'melnikov.gennadii@example.org', '2023-10-18 13:09:56', '$2y$10$.tQJE/146hUPNRlec5CPzujbgyhiDZL4cpqoUWpp.0jCg1993NhQy', 'FvZVO750be', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(7, 'Сава Сергеевич Тарасова', 'subbotina.ru', 1, 'stefan.burov@example.net', '2023-10-18 13:09:57', '$2y$10$gs.k4pmV4bzfTIB.LSSU6.TtvDjKyBhLgR5NjEX4HMDTKNVWE8jWe', '8CoTViu8HX', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(8, 'Стефан Фёдорович Горбачёв', 'alekseeva.ru', 1, 'donat.gurev@example.org', '2023-10-18 13:09:57', '$2y$10$rhSHG3TEJhJbwlVW/XGPFu2lr3UvIreh7.Av.JagChbHOk0aobHRm', 'JJj2hVzuVM', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(9, 'Спартак Евгеньевич Суханова', 'kudryvtev.net', 1, 'inga.bespalova@example.com', '2023-10-18 13:09:57', '$2y$10$n5fyBbEgkfYaRtXx8WQwo.yLbFNpW9bZ/Th4H1QIx9dmXl43GW3UO', 'dZgJ02dZaz', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(10, 'Антонина Романовна Барановаа', 'gordeev.ru', 1, 'sestakova.danila@example.org', '2023-10-18 13:09:57', '$2y$10$sBakkM/n0IqffgYsAdTps.79zcBGvyJyIq/VCGNmWblH3neOczlee', 'dhGYoWNYUv', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL),
(11, 'Некрасова Данила Сергеевич', 'grisina.ru', 1, 'ignatii.blokina@example.org', '2023-10-18 13:09:57', '$2y$10$zy3oTM.A2u1fnCRfapeMGO9Z6jL37EcPPCT8Xn/zL2TFQ4gPebauO', 'ZayLf331ko', '2023-10-18 13:09:57', '2023-10-18 13:09:57', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_params`
--

CREATE TABLE `users_params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `man_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_params`
--

INSERT INTO `users_params` (`id`, `name`, `man_name`, `created_at`, `updated_at`) VALUES
(1, 'products_view', 'Просмотр товаров', NULL, NULL),
(2, 'products_edit', 'Правки товаров', NULL, NULL),
(3, 'products_types_view', 'Просмотр типов товаров', NULL, NULL),
(4, 'products_types_edit', 'Правки типы товаров', NULL, NULL),
(5, 'rooms_view', 'Просмотр комнат', NULL, NULL),
(6, 'rooms_edit', 'Правки комнат', NULL, NULL),
(7, 'users_view', 'Просмотр пользователей', NULL, NULL),
(8, 'users_edit', 'Создание учетных записей', NULL, NULL),
(9, 'rooms_rates_view', 'Просмотр тарифов', NULL, NULL),
(10, 'rooms_rates_edit', 'Правки тарифов', NULL, NULL),
(11, 'orders_view', 'Просмотр заказов', NULL, NULL),
(12, 'orders_edit', 'Работа с заказами', NULL, NULL),
(13, 'reservation_view', 'Просмотр брони', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_users_params`
--

CREATE TABLE `users_users_params` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `param_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_users_params`
--

INSERT INTO `users_users_params` (`user_id`, `param_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_room_id_foreign` (`room_id`);

--
-- Индексы таблицы `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_products_order_id_product_id_unique` (`order_id`,`product_id`),
  ADD KEY `orders_products_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_type_id_foreign` (`type_id`);

--
-- Индексы таблицы `products_types`
--
ALTER TABLE `products_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_types_name_unique` (`name`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_rate_id_foreign` (`rate_id`);

--
-- Индексы таблицы `rooms_images`
--
ALTER TABLE `rooms_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_images_room_id_foreign` (`room_id`);

--
-- Индексы таблицы `rooms_rates`
--
ALTER TABLE `rooms_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_rates_name_unique` (`name`);

--
-- Индексы таблицы `rooms_reservation`
--
ALTER TABLE `rooms_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_reservation_room_id_foreign` (`room_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `users_params`
--
ALTER TABLE `users_params`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_params_name_unique` (`name`);

--
-- Индексы таблицы `users_users_params`
--
ALTER TABLE `users_users_params`
  ADD PRIMARY KEY (`user_id`,`param_id`),
  ADD KEY `users_users_params_param_id_foreign` (`param_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `products_types`
--
ALTER TABLE `products_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `rooms_images`
--
ALTER TABLE `rooms_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `rooms_rates`
--
ALTER TABLE `rooms_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `rooms_reservation`
--
ALTER TABLE `rooms_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users_params`
--
ALTER TABLE `users_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `products_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `rooms_rates` (`id`);

--
-- Ограничения внешнего ключа таблицы `rooms_images`
--
ALTER TABLE `rooms_images`
  ADD CONSTRAINT `rooms_images_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Ограничения внешнего ключа таблицы `rooms_reservation`
--
ALTER TABLE `rooms_reservation`
  ADD CONSTRAINT `rooms_reservation_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Ограничения внешнего ключа таблицы `users_users_params`
--
ALTER TABLE `users_users_params`
  ADD CONSTRAINT `users_users_params_param_id_foreign` FOREIGN KEY (`param_id`) REFERENCES `users_params` (`id`),
  ADD CONSTRAINT `users_users_params_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
