-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 14 2024 г., 18:13
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_30_130110_create_products_types_table', 1),
(6, '2023_09_30_130118_create_products_table', 1),
(7, '2023_09_30_134312_create_users_params_table', 1),
(8, '2023_09_30_134331_create_users_users_params_table', 1),
(9, '2023_09_30_135322_create_rooms_rates_table', 1),
(10, '2023_09_30_135333_create_rooms_table', 1),
(11, '2023_09_30_135348_create_rooms_reservation_table', 1),
(12, '2023_09_30_135354_create_orders_table', 1),
(13, '2023_09_30_135400_create_orders_products_table', 1),
(14, '2023_10_07_230516_create_rooms_images_table', 1),
(15, '2023_12_15_154704_add_deleted_at_to_rooms_reservation_table', 1),
(16, '2024_05_03_211231_create_reviews_table', 1),
(17, '2024_05_03_211303_create_stocks_table', 1),
(18, '2024_05_26_021749_create_users_authorization_table', 1);

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

INSERT INTO `products` (`id`, `name`, `price`, `image`, `type_id`, `created_at`, `updated_at`) VALUES
(22, 'Кальян средний', 600, '/upload/products/22/img.jpg', 24, '2024-01-14 19:47:03', '2024-01-14 19:47:03'),
(24, 'Кальян легкий', 500, '/upload/products/24/img.jpg', 24, '2024-01-14 20:27:57', '2024-01-14 20:27:57'),
(25, 'Кальян крепкий', 700, '/upload/products/25/img.jpg', 24, '2024-01-14 20:28:23', '2024-01-14 20:28:23'),
(26, 'Капучино', 180, '/upload/products/26/img.jpg', 25, '2024-01-14 20:37:18', '2024-01-14 20:37:18'),
(27, 'Латте', 200, '/upload/products/27/img.jpg', 25, '2024-01-14 20:38:30', '2024-01-14 20:38:30'),
(28, 'Американо', 150, '/upload/products/28/img.jpg', 25, '2024-01-14 20:39:10', '2024-01-14 20:39:10');

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

INSERT INTO `products_types` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(24, 'кальян', '/upload/products_types/24/img.jpg', '2024-01-14 19:25:58', '2024-01-14 19:25:58'),
(25, 'Кофе', '/upload/products_types/25/img.jpg', '2024-01-14 20:34:31', '2024-01-14 20:34:31');
-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `content`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ex voluptas minima quia in. Repudiandae odio minus sed nam sequi. Consectetur nesciunt doloribus soluta unde. Est laborum sit voluptates.', 1, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(2, 6, 'Et dignissimos blanditiis totam distinctio nisi amet fugiat. Quia ut id accusamus sit veritatis laboriosam. Rerum expedita autem eveniet.', 4, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(3, 1, 'Similique aut dolorem et harum molestias. Sapiente non rerum ea dolorem nam repudiandae. Error eos ducimus accusamus. Aut sit sit et ipsa commodi reiciendis.', 3, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(4, 2, 'Id deleniti corrupti voluptatem quia quisquam. Quia officiis officia alias a qui. A quia rerum qui adipisci. Consequatur et sunt quos quas doloribus qui magnam voluptatibus. Enim maiores id et.', 3, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(5, 8, 'Ipsum iste veritatis vel quasi consequatur autem voluptatem. Omnis excepturi voluptates beatae id accusamus minima. Ipsum quia dolores suscipit ad quod.', 0, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(6, 6, 'Ipsa quis repellat odit voluptates optio sint laudantium harum. Sunt omnis nulla ea ducimus et. Quae consequatur et illo labore. Ut autem deleniti perspiciatis repellendus ducimus facere ut.', 2, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(7, 8, 'Reiciendis asperiores velit reiciendis perspiciatis non nemo. Autem labore quidem exercitationem et minima cumque.', 4, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(8, 10, 'Ratione veniam consequatur aspernatur dolore quia eum. Est aut voluptate eum. Est deserunt dolores molestias omnis esse. Fugit dolor doloremque quis ut culpa doloremque aspernatur dolorem.', 1, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(9, 7, 'Officia sed ut ut. Quis exercitationem doloribus voluptatem dolorum officia sed suscipit sed. Recusandae porro dolorem voluptas numquam quasi.', 2, '2024-05-04 07:37:07', '2024-05-04 07:37:07'),
(10, 3, 'Praesentium impedit qui quo occaecati. Dolores fugit quis aperiam non excepturi perferendis. Aut natus excepturi voluptatibus quos. Qui ut dolorum ab.', 2, '2024-05-04 07:37:07', '2024-05-04 07:37:07');

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

INSERT INTO `rooms` (`id`, `name`, `image`, `rate_id`, `capacity`, `created_at`, `updated_at`) VALUES
(35, 'Космическая пауза', '/upload/rooms/35/main.jpg', 22, 18, '2024-01-14 20:15:11', '2024-01-14 20:15:11'),
(36, 'Кодекс комфорта', '/upload/rooms/36/main.jpg', 23, 20, '2024-01-14 20:18:58', '2024-01-14 20:18:58'),
(37, 'Импульс Творчества', '/upload/rooms/37/main.jpg', 42, 24, '2024-01-14 20:27:22', '2024-01-14 20:27:22');

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

INSERT INTO `rooms_rates` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(22, 'Эконом', 120, '2023-12-21 02:42:19', '2023-12-21 02:42:19'),
(23, 'Бизнес', 180, '2023-12-21 02:43:13', '2023-12-21 02:43:13'),
(42, 'VIP', 240, '2024-01-14 20:12:43', '2024-01-14 20:12:43');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Структура таблицы `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hic', 'Asperiores assumenda sit asperiores quae ad ipsum maiores velit. Inventore ullam dolor quaerat praesentium sunt. Nam vel quasi possimus rerum unde eius. Esse deleniti architecto sit quia.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(2, 'quo', 'Laudantium odio voluptatem pariatur quasi natus quia. Aut aliquam provident quo qui aut aut est. Autem expedita assumenda quaerat id.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(3, 'rerum', 'Ut explicabo illo et doloremque voluptatem accusamus. Dolorem repudiandae saepe quae reiciendis. Quidem labore sequi nostrum ipsum voluptas veritatis. Vitae praesentium at rerum similique aliquam.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(4, 'eveniet', 'Expedita sunt maiores aliquam ut maiores facere. Et molestiae eligendi quidem occaecati ut sunt id.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(5, 'quae', 'Modi in quas adipisci maxime repellendus ut. Optio veniam eaque iusto sint corrupti. Dolores cumque ut autem qui soluta quam aliquam. Minima culpa perferendis est vero ab.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(6, 'quidem', 'Labore eveniet ex qui voluptatem aliquam placeat quia. Et id maiores sunt nulla consectetur molestiae aliquam similique. Ratione ipsa ea debitis voluptatem deleniti omnis cum.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(7, 'cumque', 'Dolore possimus et totam voluptas. Est vel id eum perspiciatis. Deleniti ullam saepe nihil sint sit. Sapiente in architecto quia quis.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(8, 'omnis', 'Doloremque voluptate rerum consequuntur eum quibusdam dolorum cumque. Aut praesentium fuga quia facilis quo nemo numquam doloremque.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(9, 'in', 'Quo quia ratione vero qui in enim. Consequatur accusamus vero ea similique. Nisi sed voluptas sunt at in nihil dolor mollitia. Facere placeat officiis odio sint rerum dolorem voluptas.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL),
(10, 'repudiandae', 'Aliquid accusantium qui voluptas modi suscipit totam. Ab excepturi magni provident est. Aut perferendis mollitia quibusdam. Sunt est ab quia quod.', '2024-05-04 07:37:07', '2024-05-04 07:37:07', NULL);

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
(1, 'Ступаченко Александр Николаевич', 'admin', 1, 'admin@timecafe.ru', '2023-10-18 13:09:56', '$2y$10$cnT.ibfgnyAL7UaaUky4EenVQLgf83zdOS8LtD/syENVaOzNiEST2', 'SmRoBEkSKPR8qel0zUbRWCaEZXaDjbMn33KGCt2vBfhaN09tpQ2LoXqxHPur', NULL, '2023-12-21 02:37:00', NULL),
(2, 'Димитров Сергей Николаевич', 'sergey', 1, 'dimitrov@gmail.com', '2023-10-18 13:09:56', '$2y$10$41ulqbaeQZIZAWPPYe4sfeGvyRsPG7lO0ylPMQ.f3MP9oBhV0uype', '7BOFnp0Ye2dWJU3iFob8XfQi7L3b53JckbUYwPFsYljpQ0WdvJGKzKyOhQ9o', '2023-10-18 13:09:57', '2024-01-14 16:41:37', NULL);

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
(1, 'products_view', 'Просмотр товаров', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(2, 'products_edit', 'Правки товаров', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(3, 'products_types_view', 'Просмотр типов товаров', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(4, 'products_types_edit', 'Правки типы товаров', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(5, 'rooms_view', 'Просмотр комнат', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(6, 'rooms_edit', 'Правки комнат', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(7, 'users_view', 'Просмотр пользователей', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(8, 'users_edit', 'Создание учетных записей', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(9, 'rooms_rates_view', 'Просмотр тарифов', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(10, 'rooms_rates_edit', 'Правки тарифов', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(11, 'orders_view', 'Просмотр заказов', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(12, 'orders_edit', 'Работа с заказами', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(13, 'reservation_view', 'Просмотр брони', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(14, 'reservation_edit', 'Правки брони', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(15, 'stocks_view', 'Просмотр акций', '2024-05-04 07:37:06', '2024-05-04 07:37:06'),
(16, 'stocks_edit', 'Правки акций', '2024-05-04 07:37:06', '2024-05-04 07:37:06');

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
(1, 13),
(1, 14),
(1, 15),
(1, 16);

create table users_authorization
(
    id         bigint unsigned auto_increment
        primary key,
    user_id    bigint unsigned                        not null,
    is_admin   tinyint(1) default 0                   not null,
    created_at timestamp  default current_timestamp() not null on update current_timestamp(),
    constraint users_authorization_user_id_foreign
        foreign key (user_id) references users (id)
)
    collate = utf8mb4_unicode_ci;
--
-- Индексы сохранённых таблиц
--

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
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_type_id_foreign` (`type_id`);

--
-- Индексы таблицы `products_types`
--
ALTER TABLE `products_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_types_name_unique` (`name`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_name_unique` (`name`),
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
-- Индексы таблицы `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
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
-- AUTO_INCREMENT для таблицы `stocks`
--
ALTER TABLE `stocks`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
