-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.trusty~ppa.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 05 2014 г., 20:53
-- Версия сервера: 5.5.38-0ubuntu0.14.04.1
-- Версия PHP: 5.5.16-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `trueface`
--

-- --------------------------------------------------------

--
-- Структура таблицы `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
`id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `description` mediumtext,
  `finished` tinyint(4) DEFAULT '0',
  `confirmed` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Дамп данных таблицы `forms`
--

INSERT INTO `forms` (`id`, `created_at`, `updated_at`, `user_id`, `name`, `surname`, `nickname`, `occupation`, `description`, `finished`, `confirmed`) VALUES
(134, '2014-04-19 14:22:38', '2014-04-19 14:22:58', 4, 'Leo', 'Freeman', '', '', '', 1, 0),
(135, '2014-04-19 14:23:35', '2014-04-21 08:45:12', 4, 'Bernard', 'Castro', '', '', '', 1, 1),
(136, '2014-04-19 14:24:20', '2014-04-19 16:00:12', 4, 'Aaron', 'Rogers', '', '', '', 1, 1),
(140, '2014-04-30 07:52:18', '2014-04-30 07:52:18', 5, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `forms_files`
--

CREATE TABLE IF NOT EXISTS `forms_files` (
`id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `size` int(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Дамп данных таблицы `forms_files`
--

INSERT INTO `forms_files` (`id`, `created_at`, `updated_at`, `form_id`, `name`, `thumbnail`, `type`, `extension`, `size`) VALUES
(56, '2014-04-19 14:22:43', '2014-04-19 14:22:43', 134, 'c6YW7PwAZaVXOYvIV8whPNKeSC6BO6.jpg', 'th-c6YW7PwAZaVXOYvIV8whPNKeSC6BO6.jpg', 'image', 'jpg', NULL),
(57, '2014-04-19 14:23:54', '2014-04-19 14:23:54', 135, 'nmnYUw28yzbErXmisfneclsudjxG96.jpg', 'th-nmnYUw28yzbErXmisfneclsudjxG96.jpg', 'image', 'jpg', NULL),
(58, '2014-04-19 14:24:30', '2014-04-19 14:24:30', 136, 'S8sS3ushu8Hq5WS1Yur3ebQSGHFHr5.jpg', 'th-S8sS3ushu8Hq5WS1Yur3ebQSGHFHr5.jpg', 'image', 'jpg', NULL),
(60, '2014-04-30 07:52:36', '2014-04-30 07:52:36', 140, '0BHRYFENUM6ZcavklJ3nW5AzkgTQyU.jpg', 'th-0BHRYFENUM6ZcavklJ3nW5AzkgTQyU.jpg', 'image', 'jpg', NULL),
(61, '2014-04-30 07:52:38', '2014-04-30 07:52:38', 140, 'WbUEeUXTcK8bAwWUTC1cb0TyxG7Pi6.jpg', 'th-WbUEeUXTcK8bAwWUTC1cb0TyxG7Pi6.jpg', 'image', 'jpg', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `localisation`
--

CREATE TABLE IF NOT EXISTS `localisation` (
`id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `name_ru` text COLLATE utf8_bin NOT NULL,
  `name_ro` text COLLATE utf8_bin NOT NULL,
  `name_en` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `localisation`
--

INSERT INTO `localisation` (`id`, `created_at`, `updated_at`, `name`, `name_ru`, `name_ro`, `name_en`) VALUES
(1, '2014-04-14 00:37:07', '2014-04-14 00:47:56', 'admin-panel', 'Админ панель', 'Administrator', ''),
(3, '2014-04-14 01:26:55', '2014-04-14 01:26:55', 'language-ru', 'Руский', 'Rusa', ''),
(4, '2014-04-14 01:28:10', '2014-04-14 01:28:10', 'language-ro', 'Румынский', 'Romana', '');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `name` text COLLATE utf8_bin NOT NULL,
  `text_ru` text COLLATE utf8_bin NOT NULL,
  `text_ro` text COLLATE utf8_bin NOT NULL,
  `text_en` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `created_at`, `updated_at`, `active`, `name`, `text_ru`, `text_ro`, `text_en`) VALUES
(1, '2014-04-14 00:00:38', '2014-08-04 06:31:01', 1, 'user-page-right-column', '', '<p><strong>hngfhgfh</strong></p>\n\n<p><strong><img alt="" src="/img/upload/images/2qNzGO8AQM6qKqc1LQE9qbCzd8DRMJ.jpg" style="width:100%" /></strong></p>\n', ''),
(2, '2014-04-17 09:26:44', '2014-04-21 08:44:18', 1, 'form-edit-right-column', '<h5>Вы можете добавлять неограниченное число форм абсолютно бесплатно</h5>\n\n<p>Заполните информацию об искомом человек</p>\n\n<p>Чем больше данных вы укажите тем больше шансов найти достоверную информацию</p>\n\n<p>jhhk</p>\n\n<p>knkjk</p>\n\n<p>kj</p>\n', '', ''),
(3, '2014-04-18 09:34:00', '2014-04-18 09:34:38', 1, 'form-add-image-upload', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
`id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quote_ru` text COLLATE utf8_bin NOT NULL,
  `quote_ro` text COLLATE utf8_bin NOT NULL,
  `quote_en` text COLLATE utf8_bin NOT NULL,
  `author` tinytext COLLATE utf8_bin NOT NULL,
  `confirmed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `quotes`
--

INSERT INTO `quotes` (`id`, `created_at`, `updated_at`, `quote_ru`, `quote_ro`, `quote_en`, `author`, `confirmed`) VALUES
(11, '2014-04-14 02:10:52', '2014-04-19 12:49:41', 'Как неузнаваемы девушки без макияжа! Страшно....', 'Как неузнаваемы девушки без макияжа! Страшно....', '', 'Народные цитаты', 0),
(12, '2014-04-14 02:11:13', '2014-04-14 02:11:13', 'Одно дело — перебирать и растравливать собственные горести, укрепляясь в принятом решении. И совсем другое — понять, что задуманное деяние причинит боль другим.', '', '', '', 0),
(13, '2014-04-14 08:30:27', '2014-04-14 08:35:53', 'Как неузнаваемы девушки без макияжа! Страшно...', '', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
`id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(60) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `size` int(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_id_foreign` int(11) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `responses`
--

INSERT INTO `responses` (`id`, `created_at`, `updated_at`, `description`, `price`, `paid`, `confirmed`, `name`, `type`, `extension`, `size`, `user_id`, `user_id_foreign`, `form_id`, `viewed`) VALUES
(30, '2014-04-19 14:37:12', '2014-04-19 14:47:32', 'Comment', 45, 1, 0, 'aBlHYPK8L3uvi7i87VjvaUjtaBmpR4.jpg', 'image', 'jpg', NULL, 4, 4, 136, 0),
(31, '2014-04-19 14:42:27', '2014-08-04 06:17:17', '', 0, 0, 1, '7mUbbMhI3uslEkVaNVoe4BSZyKhX9C.jpg', 'image', 'jpg', NULL, 4, 4, 136, 0),
(32, '2014-04-19 15:56:10', '2014-08-04 06:17:15', 'yhyhyhyhyhyun ybybybybb ', 45, 0, 1, 'pc7Gr2q7B89Gapd9Sk1MIy1azZxQj2.jpg', 'image', 'jpg', NULL, 5, 4, 136, 0),
(33, '2014-04-21 08:47:13', '2014-04-21 08:47:43', 'sdasdascasas as as ', 60, 0, 0, 'usvC0aIDGgqyD3Qlui4aJCWazuNR1L.jpg', 'image', 'jpg', NULL, 5, 4, 135, 0),
(34, '2014-07-15 22:03:37', '2014-08-04 06:17:13', '', 0, 0, 1, NULL, NULL, NULL, NULL, 5, 4, 135, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `key` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `admin` tinyint(4) DEFAULT '0',
  `email` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `credits` int(11) DEFAULT '0',
  `credits_referral` int(11) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `referral_code` varchar(40) DEFAULT NULL,
  `referral_user_id` int(11) DEFAULT NULL,
  `confirmation_code` varchar(40) DEFAULT NULL,
  `remember_token` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `admin`, `email`, `name`, `phone`, `credits`, `credits_referral`, `password`, `referral_code`, `referral_user_id`, `confirmation_code`, `remember_token`) VALUES
(3, '2014-03-24 18:21:47', '2014-04-19 13:43:51', 1, 'amaximblack@gmail.com', 'Maxim', 68277733, 220, NULL, '$2y$10$.J/683J6zN509/o/R/rsRO2lhLcM7dOO4.n9da6V233WEUJmiQlAe', 'GSoKt2TCFrqsf4LcC3I48YtmE1Ck5o3Mvhf4tfnd', NULL, '', 'GHex74XXLmG6ubmwdJKPh8rzxa4kW49bnFjhj4vIVe0sjjEJwrn4OzOmGTz2'),
(4, '2014-04-19 14:13:20', '2014-04-19 14:48:35', 1, '123maximblack@gmail.com', 'Maxim 2', 2147483647, 155, NULL, '$2y$10$zJcY15mAJgZfs7Fl0dajaOxvUOtpIX8NP8RBoqU1rtM2fes/9p7om', 'RHem5w0Gxofc43RTkQIdBkym3BjpzpsWF007o69Z', NULL, '', 'MwIHZxpSefBQRrraljfXVuOwW8CY3QNHkKHkM1dFWVF9WpDaZEKqAgj55XU1'),
(5, '2014-04-19 15:44:08', '2014-08-11 12:34:31', 1, 'maximblack@gmail.com', 'Maxim', 2147483647, 0, NULL, '$2y$10$rr/xjT7IABWL2csJt.Sz/e3nY7TGXQrW5jAMQwyrYFAOJBUUT1wrm', 'YNihw9GquD1bzrwAYQvCfdZ78WT5TGTM0Vf9FP9A', NULL, '', 'S8Jz1hTiGPzrzsjDylKXalW2kdlWrow8XvJLcMAYCKbBvQCNcv2vEJOC3RrP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forms_files`
--
ALTER TABLE `forms_files`
 ADD PRIMARY KEY (`id`), ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `localisation`
--
ALTER TABLE `localisation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `user_id_foreign` (`user_id_foreign`), ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `forms_files`
--
ALTER TABLE `forms_files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `localisation`
--
ALTER TABLE `localisation`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `forms`
--
ALTER TABLE `forms`
ADD CONSTRAINT `forms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `forms_files`
--
ALTER TABLE `forms_files`
ADD CONSTRAINT `forms_files_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`);

--
-- Ограничения внешнего ключа таблицы `responses`
--
ALTER TABLE `responses`
ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`user_id_foreign`) REFERENCES `users` (`id`),
ADD CONSTRAINT `responses_ibfk_3` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
