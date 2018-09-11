-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Сер 08 2018 р., 12:56
-- Версія сервера: 5.7.23-0ubuntu0.16.04.1
-- Версія PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `projekt`
--

-- --------------------------------------------------------

--
-- Структура таблиці `albums`
--

CREATE TABLE `albums` (
  `foto_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `upload_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблиці `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_one` varchar(255) NOT NULL,
  `user_two` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(16, '2', '1'),
(17, '2', '3'),
(18, '2', '4'),
(19, '2', '5'),
(20, '2', '6'),
(21, 'f2ac92673ae90e179ffb00b513cc053f', 'f2ac92673ae90e179ffb00b513cc053f'),
(22, 'f2ac92673ae90e179ffb00b513cc053f', 'rfwdcvxsdfsdf'),
(23, 'f2ac92673ae90e179ffb00b513cc053f', 'qewqweeqweqw'),
(24, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe'),
(25, 'f2ac92673ae90e179ffb00b513cc053f', 'fjkse48975t89yhtulsi'),
(26, 'f2ac92673ae90e179ffb00b513cc053f', 'sdfsdfsdfdfssdfsdf'),
(27, 'f2ac92673ae90e179ffb00b513cc053f', 'sdffdssdfsdfsdfsdffds'),
(28, 'f2ac92673ae90e179ffb00b513cc053f', 'fdssfdfsdsfdsdfdsf'),
(29, 'f2ac92673ae90e179ffb00b513cc053f', 'sdfdsfsdfdsgdfssdf'),
(30, 'f2ac92673ae90e179ffb00b513cc053f', 'dsfsdffdsdsfdsf'),
(31, 'f2ac92673ae90e179ffb00b513cc053f', 'dsffsdsdfsfddsf'),
(32, 'f2ac92673ae90e179ffb00b513cc053f', 'sdfsdfsdfsfdsfd'),
(33, '', 'rfwdcvxsdfsdf'),
(34, 'f2ac92673ae90e179ffb00b513cc053f', 'fdssdffsddsf'),
(35, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'fdssdffsddsf'),
(36, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'rfwdcvxsdfsdf'),
(37, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'dsfsdffdsdsfdsf'),
(38, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'sdfdsfsdfdsgdfssdf'),
(39, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'fjkse48975t89yhtulsi'),
(40, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'qewqweeqweqw'),
(41, 'c960ba19d80b1d7bfd36f8ff7a40ec44', 'fdssfdfsdsfdsdfdsf'),
(42, '565a383670b12fd7fc070b0daeb30a5c', 'dsfsdffdsdsfdsf'),
(43, '565a383670b12fd7fc070b0daeb30a5c', 'sdfdsfsdfdsgdfssdf'),
(44, '565a383670b12fd7fc070b0daeb30a5c', 'sdffdssdfsdfsdfsdffds'),
(45, 'f2ac92673ae90e179ffb00b513cc053f', 'f152d6719b1b0367b242fa38179dc0b0'),
(46, 'daa913bca7fe5d193097d8611abcc02e', 'sdfdsfsdfdsgdfssdf'),
(47, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e');

-- --------------------------------------------------------

--
-- Структура таблиці `de`
--

CREATE TABLE `de` (
  `id` int(11) NOT NULL,
  `phrase` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `de`
--

INSERT INTO `de` (`id`, `phrase`) VALUES
(1, 'LOVONEO | FIND YOUR LOVE'),
(2, 'Home'),
(3, 'Profile bearbeiten'),
(4, 'Abmelden'),
(5, 'Anmelden'),
(6, 'E-mail'),
(7, 'Kennwort'),
(8, 'Registrieren'),
(9, 'Kennwort vergessen?'),
(10, 'Anmelden'),
(11, 'Email Addresse nicht korrekt'),
(12, 'Bitte verifizieren Sie Email Adresse zu erst'),
(13, 'Kennwort inkorrekt'),
(14, 'Nachrichten'),
(15, 'Ich bin'),
(16, 'Mann'),
(17, 'Frau'),
(18, 'Ich suche nach'),
(19, 'Alter waehlen'),
(20, 'Suche'),
(21, 'Schau auch'),
(22, 'Anmelden'),
(23, 'Profile foto bearbeiten'),
(24, 'Foto abschneiden'),
(25, 'Abrechen'),
(26, 'Abschneiden'),
(27, 'Benutzername'),
(28, 'Benutzer Email'),
(29, 'Dein Kennwort'),
(30, 'Geschlecht'),
(31, 'Geburtstag'),
(32, '			<p>Hi ".$_POST[\'user_name\'].",</p>\r\n			<p>Vielen Dank fuer Anmeldung. Dein kennwort ist ".$user_password.", Dein Kennwort wird nur nach verifikation valid.</p>\r\n			<p>Bitte, oefnnen Sie ein Link um profile zu verifizieren  - ".$base_url."email_verification.php?user_activation_code=".$user_activation_code."\r\n			<p>Mit besten Gruesse,<br />Lovoneo</p>');

-- --------------------------------------------------------

--
-- Структура таблиці `en`
--

CREATE TABLE `en` (
  `id` int(11) NOT NULL,
  `phrase` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `en`
--

INSERT INTO `en` (`id`, `phrase`) VALUES
(1, 'LOVONEO | FIND YOUR LOVE'),
(2, 'Home'),
(3, 'Edit profile'),
(4, 'Log out'),
(5, 'Log in'),
(6, 'E-mail'),
(7, 'Password'),
(8, 'Register'),
(9, 'Forgot your password?'),
(10, 'Log in'),
(11, 'Wrong Email Address'),
(12, 'Please First Verify, your email address'),
(13, 'Wrong Password'),
(14, 'Message'),
(15, 'I\'m'),
(16, 'Man'),
(17, 'Woman'),
(18, 'I\'m looking for'),
(19, 'Choose age'),
(20, 'Search'),
(21, 'See also'),
(22, 'Register'),
(23, 'Edit your profile photo'),
(24, 'Crop the image'),
(25, 'Cancel'),
(26, 'Crop'),
(27, 'User Name'),
(28, 'User Email'),
(29, 'Your Password'),
(30, 'Gender'),
(31, 'Birthday'),
(32, '			<p>Hi ".$_POST[\'user_name\'].",</p>\r\n			<p>Thanks for Registration. Your password is ".$user_password.", This password will work only after your email verification.</p>\r\n			<p>Please Open this link to verified your email address - ".$base_url."email_verification.php?user_activation_code=".$user_activation_code."\r\n			<p>Best Regards,<br />Lovoneo</p>');

-- --------------------------------------------------------

--
-- Структура таблиці `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `us_us_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `files`
--

INSERT INTO `files` (`id`, `file_name`, `uploaded_on`, `us_us_id`) VALUES
(1, 'man-woman-thinking.png', '2018-07-25 09:11:16', ''),
(2, '12.png', '2018-07-25 09:12:07', ''),
(3, '1.png', '2018-07-25 09:12:12', ''),
(4, '321.png', '2018-07-25 09:12:17', ''),
(5, 'man-woman-thinking(1).png', '2018-07-25 09:12:24', ''),
(6, 'man-woman-thinking.png', '2018-07-25 09:29:35', ''),
(7, '321.png', '2018-07-25 09:53:51', ''),
(8, '12.png', '2018-07-25 09:53:51', ''),
(9, '5.png', '2018-07-25 09:53:51', ''),
(10, '1.png', '2018-07-25 09:53:51', ''),
(11, '321.png', '2018-07-25 09:58:32', 'qewqweeqweqw'),
(12, '12.png', '2018-07-25 09:58:32', 'qewqweeqweqw'),
(13, '5.png', '2018-07-25 09:58:33', 'qewqweeqweqw'),
(14, '1.png', '2018-07-25 09:58:33', 'qewqweeqweqw'),
(15, '321.png', '2018-07-25 10:11:27', 'qewqweeqweqw'),
(16, '12.png', '2018-07-25 10:11:27', 'qewqweeqweqw'),
(17, '5.png', '2018-07-25 10:11:28', 'qewqweeqweqw'),
(18, '1.png', '2018-07-25 10:11:28', 'qewqweeqweqw'),
(24, 'IMG_0178.jpg', '2018-07-27 23:28:21', 'c960ba19d80b1d7bfd36f8ff7a40ec44'),
(62, '9.jpeg', '2018-07-30 14:29:19', 'f2ac92673ae90e179ffb00b513cc053f'),
(67, 'Kropka JPG.jpg', '2018-07-30 19:56:11', 'c960ba19d80b1d7bfd36f8ff7a40ec44'),
(68, 'Kropka.jpg', '2018-07-30 19:56:15', 'c960ba19d80b1d7bfd36f8ff7a40ec44'),
(69, 'a0085e039240c91a2b861dbe5f267e3c.jpg', '2018-07-30 19:56:44', 'c960ba19d80b1d7bfd36f8ff7a40ec44'),
(70, 'd6414cdc84a8e4ede78b7f5947e1d965.jpg', '2018-07-30 19:56:50', 'c960ba19d80b1d7bfd36f8ff7a40ec44'),
(76, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 07:48:54', '2aeaab1e1c1427b54db7cd1dac36e727'),
(77, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 07:49:10', '2aeaab1e1c1427b54db7cd1dac36e727'),
(78, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 07:49:23', '2aeaab1e1c1427b54db7cd1dac36e727'),
(79, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 07:50:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(80, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 08:02:53', '2aeaab1e1c1427b54db7cd1dac36e727'),
(81, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 08:50:18', '2aeaab1e1c1427b54db7cd1dac36e727'),
(82, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-03 09:11:57', '2aeaab1e1c1427b54db7cd1dac36e727'),
(83, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(84, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(85, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(86, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(87, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(88, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', '2aeaab1e1c1427b54db7cd1dac36e727'),
(89, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', ''),
(90, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-07-30 14:29:19', ''),
(91, 'default.png', '2018-07-30 14:29:19', ''),
(100, '38164248_691772781166040_8832134218797547520_n.jpg', '2018-08-03 13:34:42', ''),
(101, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-06 12:49:22', '21c34f794c5b7c258da2fa2bf6b1f82d'),
(102, 'zend-framework-3-cookbook.pdf', '2018-08-06 12:49:24', '21c34f794c5b7c258da2fa2bf6b1f82d'),
(103, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-06 12:49:41', '21c34f794c5b7c258da2fa2bf6b1f82d'),
(104, 'girl-dandelion-yellow-flowers-160699.jpeg', '2018-08-06 12:49:48', '21c34f794c5b7c258da2fa2bf6b1f82d'),
(113, '5a6b8d0061c9f.jpg', '2018-08-06 13:51:55', ''),
(114, '5a6b8d0061c9f.jpg', '2018-08-06 13:52:54', 'daa913bca7fe5d193097d8611abcc02e');

-- --------------------------------------------------------

--
-- Структура таблиці `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `like_from` varchar(255) NOT NULL,
  `like_to` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `likes`
--

INSERT INTO `likes` (`like_id`, `like_from`, `like_to`) VALUES
(12, 'f2ac92673ae90e179ffb00b513cc053f', 'dsfsdffdsdsfdsf'),
(13, 'f2ac92673ae90e179ffb00b513cc053f', 'dsfsdffdsdsfdsf'),
(14, 'f2ac92673ae90e179ffb00b513cc053f', 'dsffsdsdfsfddsf'),
(15, 'f2ac92673ae90e179ffb00b513cc053f', 'dsffsdsdfsfddsf'),
(16, 'f2ac92673ae90e179ffb00b513cc053f', 'fdssfdfsdsfdsdfdsf'),
(17, 'f2ac92673ae90e179ffb00b513cc053f', 'qewqweeqweqw'),
(18, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe'),
(19, 'qewqweeqweqw', 'sdfsdfsdfdfssdfsdf'),
(20, '', 'fdssdffsddsf'),
(21, '', 'sdffdssdfsdfsdfsdffds'),
(22, '', 'sdfsdfsdfsfdsfd'),
(23, '', 'dsfsdfsfdsdfsdf'),
(24, '', 'fdssfdsfsdfsd'),
(25, '', 'c960ba19d80b1d7bfd36f8ff7a40ec44'),
(26, 'f2ac92673ae90e179ffb00b513cc053f', '4f902231c3a80605e7402c9697befd92'),
(27, 'daa913bca7fe5d193097d8611abcc02e', 'f2ac92673ae90e179ffb00b513cc053f'),
(28, 'daa913bca7fe5d193097d8611abcc02e', 'sdffdssdfsdffds'),
(29, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e');

-- --------------------------------------------------------

--
-- Структура таблиці `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_from` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_from`, `user_to`, `message`) VALUES
(17, 16, '2', '1', 'hello'),
(18, 16, '2', '1', 'my name is...'),
(19, 17, '2', '3', 'hello'),
(20, 16, '2', '1', 'hjhjkjhkj\n'),
(21, 21, 'f2ac92673ae90e179ffb00b513cc053f', 'f2ac92673ae90e179ffb00b513cc053f', 'adsads'),
(22, 22, 'f2ac92673ae90e179ffb00b513cc053f', 'rfwdcvxsdfsdf', 'hello\n'),
(23, 24, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe', 'hello\n'),
(24, 24, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe', 'my name is jar'),
(25, 24, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe', 'what r u doing?'),
(26, 24, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe', 'this\n\nthis'),
(27, 28, 'f2ac92673ae90e179ffb00b513cc053f', 'fdssfdfsdsfdsdfdsf', 'h\ney baby\n'),
(28, 42, '565a383670b12fd7fc070b0daeb30a5c', 'dsfsdffdsdsfdsf', 'tyjtyukuj'),
(29, 43, '565a383670b12fd7fc070b0daeb30a5c', 'sdfdsfsdfdsgdfssdf', 'tykj'),
(30, 45, 'f2ac92673ae90e179ffb00b513cc053f', 'f152d6719b1b0367b242fa38179dc0b0', 'Hello'),
(31, 47, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e', 'hello\n'),
(32, 47, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e', 'how are u?\n'),
(33, 47, 'daa913bca7fe5d193097d8611abcc02e', '6bd7e21dd50e0dba91b01056181f8d82', 'Ð´Ð¿Ð¾Ñ€Ñ‰ÑˆÐ²ÐµÐ½Ñ€Ð¾ÐµÑ‚ÑÐ°Ñ…Ñ€Ñ‚Ð²ÐºÑˆ\n'),
(34, 47, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e', 'asdasdadsads'),
(35, 47, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e', ')))'),
(36, 47, 'daa913bca7fe5d193097d8611abcc02e', '6bd7e21dd50e0dba91b01056181f8d82', 'ÐžÐ ÐžÐ¿Ð°Ð²Ð¾ÑˆÐºÐ²ÑˆÐ³\n'),
(37, 47, '6bd7e21dd50e0dba91b01056181f8d82', 'daa913bca7fe5d193097d8611abcc02e', 'asdasdasdasd');

-- --------------------------------------------------------

--
-- Структура таблиці `photo`
--

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL,
  `photo_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `photo`
--

INSERT INTO `photo` (`photo_id`, `photo_name`) VALUES
(1, '12.png'),
(2, 'no+avatar.png');

-- --------------------------------------------------------

--
-- Структура таблиці `register_user`
--

CREATE TABLE `register_user` (
  `register_user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL,
  `first_name` varchar(1000) NOT NULL,
  `last_name` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `profile_foto` varchar(1000) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_id`, `user_email_status`, `first_name`, `last_name`, `country`, `city`, `birth_date`, `profile_foto`, `details`, `gender`, `weight`, `height`) VALUES
(2, 'anneta43565', 'adsasd@dasaas.com', '$2y$10$2caFu9z3YRo9oGY.A3a.S.4AIGeUzE1GWVXWfgFYhzP//QzE1.bxi', 'e5a2b453706cb51e47f768848d7c5bb7', 'fdssdffsddsf', 'verified', 'Annet', 'Kardi', 'Germany', 'Leipzig', '1976-06-28', 'uploads/9.jpeg', 'i love math and biology', 'female', '55', '160'),
(16, 'Alla', 'allakerekesa31@gmail.com', '$2y$10$VSxyjN8z/5TqvfTK5C8y4euybbRdCo1kn5y/OgqvqG1ZZH..XtjD2', '175e9349f3794703818a599b13dd4c56', 'dsfsdffdsdsfdsf', 'verified', 'Katya', 'Dovgal', 'Ukraine', 'Kiev', '1978-07-09', 'uploads/21.jpg', 'i\'m cute and clever', 'female', '48', '156'),
(17, 'amoni', 'lituanortusr@gmail.com', '$2y$10$BgHjHaU1wbNYdNd0NzvQmuImZobO4Ia9dy5hvaurd7V7NFv0Lcm7.', 'e4c6ae58026c0e66d124d3ea0aa0fb6a', 'sdfdsfsdfdsgdfssdf', 'verified', 'Helen', 'Parshin', 'Ukraine', 'Kiev', '1979-07-26', 'uploads/13.jpg', 'i love hard music and sport', 'female', '49', '165'),
(18, 'putin', 'upasha1996@mail.ru', '$2y$10$cneEf7nbgG.yS2P33ahAFegrsh5.8bgi7sr8otkgtnpRk5VjZUBHK', 'bddb4a1513ed10537173f42aaaeea0dc', 'fdssfdfsdsfdsdfdsf', 'verified', 'Olga', 'Kotlir', 'Ukraine', 'Kiev', '1980-07-26', 'uploads/18.jpg', 'i\'m a doctor ', 'female', '57', '163'),
(19, 'Irishka', 'more.turov.kr.86@gmail.com', '$2y$10$DOMcgEAiU8YCg6/qH7QA2OclraioKFT7lJKYEkBoxzVleNQyI0u4e', '857221df6e987cad538e12c891a27c49', 'sdffdssdfsdfsdfsdffds', 'verified', 'Irina', 'Shevchenko', 'Ukraine ', 'Krivoy Rog ', '1970-07-10', 'uploads/15.jpg', 'I hope soon have happy family.  \nI like so much travel. I have small daughter she is 4.5 years old.  \nO work in travel company. ', 'female', '56', '168'),
(20, 'ks ', 'Ks@gamil.com', '$2y$10$aAWph/UdhmB0Z8HlCiAdNuGsIpP.Wn9y0pRM3TfMqXjBY0XrgxAde', 'c07ceb729e8b3ad1243b892385a083a5', 'sdfsdfsdfdfssdfsdf', 'verified', 'Nadya', 'Shemdinov', 'Ukraine', 'Chernigiv', '1969-07-26', 'uploads/16.jpg', 'I love marshmello', 'female', '49', '150'),
(21, 'test_user', 'test_mail@ukr.net', '$2y$10$9IpYbzWzPn5xOb8PQwn5du9.v1EzzPrgbyjRxzC.ek1sWzX01EJCK', 'ccc597d3b7230aca3c5875c069c387f9', 'f2ac92673ae90e179ffb00b513cc053f', 'verified', 'Alexa', 'Zaya', 'Ukraine', 'Chernigiv', '1976-07-02', 'uploads/9.jpeg', 'Im very happy', 'female', '55', '166'),
(22, 'Kristine123', 'krist@gmail.com', 'qwerty', 'ghekfu7si8eyfuk', 'fjkse48975t89yhtulsi', 'verified', 'Kristine', 'Love', 'Ukraine', 'Kiev', '1979-10-17', 'uploads/17.jpg', 'Cute', 'female', '65', '157'),
(23, 'Lin123', 'Lin123@gmail.com', 'ddftgesr5324', 'fgew45ry435', 'sdfsdfsdfsfdsfd', 'verified', 'Kseshik', 'Jenita', 'Germany', 'Berlin', '1972-07-17', 'uploads/14.jpg', 'super-puper', 'female', '49', '167'),
(24, 'Lin123', 'Lin123@gmail.com', 'ddftgesr5324', 'fgew45ry435', 'dsfsdfsfdsdfsdf', 'verified', 'Kseshik', 'Jenita', 'Germany', 'Berlin', '1972-07-17', 'uploads/10.jpg', 'super-puper', 'female', '54', '187'),
(25, 'Lisdf123', 'Lisdf23@gmail.com', 'ddftsdf5324', 'fgewas5ry435', 'dsffsdsdfsfddsf', 'verified', 'Lena', 'Omelchendina', 'Germany', 'Berlin', '1982-07-17', 'uploads/11.jpg', 'super-puper', 'female', '60', '145'),
(26, 'Licgukn123', 'Lin123@gmail.com', 'ddftgesr53rfte24', 'fgewserte5y45ry435', 'fdssfdsfsdfsd', 'verified', 'Irina', 'Linchuk', 'Ukraine', 'Luck', '1972-07-17', 'uploads/12.jpg', 'super-puper', 'female', '48', '165'),
(27, 'Ligygyn123', 'Lin12wer3@gmail.com', 'ddtyuiuytiftgesr5324', 'fgedtyweyuyfw45ry435', 'sdffdssdfsdffds', 'verified', 'Lesya', 'Leckaluk', 'Germany', 'Brno', '1977-07-17', 'uploads/19.jpg', 'super-puper', 'female', '57', '172'),
(66, '', 'vinni95@ukr.net', '$2y$10$fWV8NkunIMSrLRAl6QW2aOnL8vE3j0ij/P5bXm7FrQy/6X.mZhBv2', 'cd4009697b8e1b8f528a31f0f8020c82', '6bd7e21dd50e0dba91b01056181f8d82', 'verified', 'Helen', 'Vinni', 'Germany', 'Brno', '1967-08-22', 'uploads/Girls-Day-Hyeri.jpg', 'I hope soon have happy family.  \nI like so much travel. I have small daughter she is 4.5 years old.  \nO work in travel company. ', 'female', '45', '150'),
(67, '', 'lovoneoo@gmail.com', '$2y$10$6Q1GH5HOapGWW70zgyVSFOg/rYql0W0JP3cOvY./K7q5BYZKHMnse', '027d5885e62dbd9391d8a46dab7219e1', 'daa913bca7fe5d193097d8611abcc02e', 'verified', 'Barbara', 'Elenof', 'Ukraine', 'Kyiv', '1997-08-06', 'uploads/8.jpg', 'i\'m cute and clever', 'female', '45', '163'),
(68, 'Tetiana ', 'tanya.bondaryk.89@mail.ru', '$2y$10$35BegX2IfQLbfLZJqdFezeByVO.lSfAWlBTKbQXnN6pXNBLYzE2GK', '4f9d05e21daf50b6abcf0f7f03d4cef0', 'c0efb421b1fb6ffbccb3d9cc73d58c5d', 'not verified', 'Tanya', 'Bondaryk', '', '', '1989-01-07', 'uploads/8.jpg', 'i\'m cute and clever', 'female', '', ''),
(69, '', 'werbung2010@me.com', '$2y$10$Eid3aj/9BRVTmMeXesQTs.LswAWpVfnuEae0DVsLMA46NFZqjbz9i', '5d7065c2727c87f3f1732a37424ff8c7', 'd1e83b7232ea855ea0e4390ebf8aa5fc', 'not verified', 'Lothar', '', '', '', '1969-03-05', 'uploads/19c36f5bfbfb7a9ea603e87c4eb29f5e.jpg', '', 'male', '', ''),
(71, '', 'theksenic@gmail.comxv', '$2y$10$ntpKNF37y/rzsbJ/Zpr.UuO/lmgJiOTB1ouYFjECv04dFZcfvFctm', '97de27d499bbb60529c876d80d94d3e4', 'c82ceab724d8018a69773bdb386976ac', 'not verified', 'Ks', '', '', '', '2018-08-01', 'uploads/beautiful-girl-profile.jpg', 'male', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `userfiles`
--

CREATE TABLE `userfiles` (
  `FilePath` varchar(250) NOT NULL,
  `FileName` varchar(250) NOT NULL,
  `ID` int(20) NOT NULL,
  `user_user_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `userfiles`
--

INSERT INTO `userfiles` (`FilePath`, `FileName`, `ID`, `user_user_id`) VALUES
('eqw', 'qwe', 1, ''),
('qew', 'qwe', 2, ''),
('Upload', 'beautiful-girl-profile.jpg', 3, ''),
('Upload', 'Cool-Profile-Pictures.jpg', 4, ''),
('Upload', 'Girls-Day-Hyeri.jpg', 5, ''),
('Upload', '202440110_110bd69b929e363b19451ed7bdfd1681_800.jpg', 6, ''),
('Upload', 'imag1212es.jpeg', 7, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', 'images.jpeg', 8, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', 'Wonder-Girls-Yu1221211221bin_1442453964_af_org.jpg', 9, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', '222222.jpeg', 10, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', '131323122.jpg', 11, ''),
('Upload', '1233.jpg', 12, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', 'lovoneo.jpeg', 13, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', '11111111111111111.jpeg', 14, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', '321.png', 15, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', '5.png', 16, 'f2ac92673ae90e179ffb00b513cc053f'),
('Upload', '12.png', 17, 'f2ac92673ae90e179ffb00b513cc053f');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`foto_id`);

--
-- Індекси таблиці `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `de`
--
ALTER TABLE `de`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `en`
--
ALTER TABLE `en`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Індекси таблиці `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Індекси таблиці `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_user_id`);

--
-- Індекси таблиці `userfiles`
--
ALTER TABLE `userfiles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `albums`
--
ALTER TABLE `albums`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT для таблиці `de`
--
ALTER TABLE `de`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблиці `en`
--
ALTER TABLE `en`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблиці `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT для таблиці `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблиці `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблиці `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT для таблиці `userfiles`
--
ALTER TABLE `userfiles`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
