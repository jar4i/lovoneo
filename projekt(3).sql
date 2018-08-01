-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Лип 23 2018 р., 12:59
-- Версія сервера: 5.7.22-0ubuntu0.16.04.1
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
-- Структура таблиці `city`
--

CREATE TABLE `city` (
  `city_c_id` int(255) NOT NULL,
  `city_names` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(32, 'f2ac92673ae90e179ffb00b513cc053f', 'sdfsdfsdfsfdsfd');

-- --------------------------------------------------------

--
-- Структура таблиці `country`
--

CREATE TABLE `country` (
  `country_c_id` int(255) NOT NULL,
  `names` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(18, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe');

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
(25, 24, 'f2ac92673ae90e179ffb00b513cc053f', 'qweweqqwe', 'what r u doing?');

-- --------------------------------------------------------

--
-- Структура таблиці `pers_data`
--

CREATE TABLE `pers_data` (
  `u_id` int(11) NOT NULL,
  `username` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `country_id` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_foto` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `more_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `pers_data`
--

INSERT INTO `pers_data` (`u_id`, `username`, `last_name`, `birth_date`, `country_id`, `city_id`, `profile_foto`, `e_mail`, `password`, `gender`, `details`, `more_info`) VALUES
(1, 'Liz', 'Maria', '1976-06-03', '12', '12', 'uploads/5.png', '', '', 'f', 'tell about yourself...123', 'card_response.php?u_id=1'),
(2, 'Annet', 'Kardi', '1956-06-05', 'Germany', 'Mainz', 'uploads/1.png', '', '', 'f', 'dsadas', 'card_response.php?u_id=2'),
(3, 'Nina', 'Richi', '1965-06-11', '12', '43', '', '', '', 'f', '#', 'card_response.php?u_id=3'),
(4, 'Anne ', 'Mark', '1982-06-11', '1', '12', '321.png', '', '', 'f', '#', ''),
(5, 'Mari', 'Ka', '1989-06-12', '12', '21', '', '', '', 'f', '#', ''),
(6, 'Gerd ', 'Mueller', '1966-06-04', '34', '23', '', '', '', 'm', '#', ''),
(7, 'Kite ', 'Eugen', '1989-06-04', '12', '21', '', '', '', 'm', '#', ''),
(8, 'Anne', 'Lisa', '1978-06-04', '123', '322', '5.png', '21', '12', 'f', '#', ''),
(9, 'Valerie', 'Kano', '1988-06-04', '12', '12', '', '3', '32', 'f', '#', ''),
(10, 'Micki', 'Chen', '1977-06-11', '12', '23', '', '23', '213', 'm', '#', ''),
(11, 'Kate', 'MAn', '1966-06-13', '12', '32', '', '123', '32', 'f', '#', ''),
(12, 'Margo', 'Drake', '1987-06-11', '21', '32', '32', '1', '32', 'f', '#', ''),
(13, 'Gerd', 'Lowig', '1976-06-18', '213', '32', '12', '32', '123', 'm', '#', ''),
(14, 'Mary', 'Kay', '1977-06-26', '2', '1', '1', '21', '23', '12', '#', '');

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `productCode` varchar(15) NOT NULL,
  `productName` varchar(70) NOT NULL,
  `productLine` varchar(50) NOT NULL,
  `productScale` varchar(10) NOT NULL,
  `productVendor` varchar(50) NOT NULL,
  `productDescription` text NOT NULL,
  `quantityInStock` smallint(6) NOT NULL,
  `buyPrice` double NOT NULL,
  `MSRP` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`productCode`, `productName`, `productLine`, `productScale`, `productVendor`, `productDescription`, `quantityInStock`, `buyPrice`, `MSRP`) VALUES
('S10_1678', '1969 Harley Davidson Ultimate Chopper', 'Motorcycles', '1:10', 'Min Lin Diecast', 'This replica features working kickstand, front suspension, gear-shift lever, footbrake lever, drive chain, wheels and steering. All parts are particularly delicate due to their precise scale and require special care and attention.', 7933, 48.81, 95.7),
('S10_1949', '1952 Alpine Renault 1300', 'Classic Cars', '1:10', 'Classic Metal Creations', 'Turnable front wheels; steering function; detailed interior; detailed engine; opening hood; opening trunk; opening doors; and detailed chassis.', 7305, 98.58, 214.3),
('S10_1950', 'adsdas', 'dsadas', 'dasads', 'dasads', 'sdasadasd', 1, 15.1, 15.1),
('S10_1234', 'dsasda', 'dsadsa', 'dsaasdds', 'dasdsasad', 'dassdaasd', 1, 15.1, 15.1),
('S10_1999', 'asdadsasd', 'saddsadas', 'dasdsa', 'dassad', 'dasasddsa', 1, 16.5, 14.3),
('S10_3244', 'saddas', 'dasds', 'asddas', 'adssda', 'dsaasdasd', 1, 15.1, 15.1);

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
  `weight` int(255) NOT NULL,
  `height` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_id`, `user_email_status`, `first_name`, `last_name`, `country`, `city`, `birth_date`, `profile_foto`, `details`, `gender`, `weight`, `height`) VALUES
(2, 'anneta43565', 'adsasd@dasaas.com', '$2y$10$2caFu9z3YRo9oGY.A3a.S.4AIGeUzE1GWVXWfgFYhzP//QzE1.bxi', 'e5a2b453706cb51e47f768848d7c5bb7', 'fdssdffsddsf', 'verified', 'Annet', 'Kardi', 'Germany', 'Leipzig', '1976-06-28', 'uploads/9.jpeg', 'i love math and biology', 'female', 55, 160),
(12, 'maria', 'vinni94@ukr.net', '$2y$10$ZBymn2PDvJcom5Jjcxj5e.5u.JCJCDZpm9hx2v0Lpk/BHQHpyhoGq', '9940ebdb87bf4d0a5f29d984de83c91c', 'rfwdcvxsdfsdf', 'verified', 'Anne', 'Lisa', 'Germany', 'Aachen', '1984-06-05', 'uploads/20.jpg', 'i\'m positive end friendly', 'female', 65, 178),
(14, 'kate', 'jaroslaw.vinnichuck@gmail.com', '$2y$10$dWgfuggqP60JEmxCN.6zFegjm4HWP1OSaZaz7X/1feREJEhu1Smxq', '34c81e116b3e95162917f0e54849d3aa', 'qewqweeqweqw', 'verified', 'Kate', 'Martin', 'Germany', 'Frankfurth', '1985-06-20', 'uploads/1.png', 'i\'m memolog', 'female', 65, 170),
(15, 'Nadya', 'werbung2010@me.com', '$2y$10$kRbYBOIgjGRRMnjFG/uHIeGp/QtiwoXtqVo6mL6q71YvSng7vIa9K', 'e5a221fef499fcd0d0707a8d4bfd94ef', 'qweweqqwe', 'verified', 'Nadya', 'Marunich', 'Germany', 'Berlin', '1977-07-17', 'uploads/8.jpg', 'i\'m your best choise', 'female', 76, 170),
(16, 'Alla', 'allakerekesa31@gmail.com', '$2y$10$VSxyjN8z/5TqvfTK5C8y4euybbRdCo1kn5y/OgqvqG1ZZH..XtjD2', '175e9349f3794703818a599b13dd4c56', 'dsfsdffdsdsfdsf', 'verified', 'Katya', 'Dovgal', 'Ukraine', 'Kiev', '1978-07-09', 'uploads/21.jpg', 'i\'m cute and clever', 'female', 48, 156),
(17, 'amoni', 'lituanortusr@gmail.com', '$2y$10$BgHjHaU1wbNYdNd0NzvQmuImZobO4Ia9dy5hvaurd7V7NFv0Lcm7.', 'e4c6ae58026c0e66d124d3ea0aa0fb6a', 'sdfdsfsdfdsgdfssdf', 'verified', 'Helen', 'Parshin', 'Ukraine', 'Kiev', '1979-07-26', 'uploads/13.jpg', 'i love hard music and sport', 'female', 49, 165),
(18, 'putin', 'upasha1996@mail.ru', '$2y$10$cneEf7nbgG.yS2P33ahAFegrsh5.8bgi7sr8otkgtnpRk5VjZUBHK', 'bddb4a1513ed10537173f42aaaeea0dc', 'fdssfdfsdsfdsdfdsf', 'verified', 'Olga', 'Kotlir', 'Ukraine', 'Kiev', '1980-07-26', 'uploads/18.jpg', 'i\'m a doctor ', 'female', 57, 163),
(19, 'Irishka', 'more.turov.kr.86@gmail.com', '$2y$10$DOMcgEAiU8YCg6/qH7QA2OclraioKFT7lJKYEkBoxzVleNQyI0u4e', '857221df6e987cad538e12c891a27c49', 'sdffdssdfsdfsdfsdffds', 'verified', 'Irina', 'Shevchenko', 'Ukraine ', 'Krivoy Rog ', '1970-07-10', 'uploads/15.jpg', 'I hope soon have happy family.  \r\nI like so much travel. I have small daughter she is 4.5 years old.  \r\nO work in travel company. ', 'female', 56, 168),
(20, 'ks ', 'Ks@gamil.com', '$2y$10$aAWph/UdhmB0Z8HlCiAdNuGsIpP.Wn9y0pRM3TfMqXjBY0XrgxAde', 'c07ceb729e8b3ad1243b892385a083a5', 'sdfsdfsdfdfssdfsdf', 'verified', 'Nadya', 'Shemdinov', 'Ukraine', 'Chernigiv', '1969-07-26', 'uploads/16.jpg', 'I love marshmello', 'female', 49, 150),
(21, 'test_user', 'test_mail@ukr.net', '$2y$10$ZBymn2PDvJcom5Jjcxj5e.5u.JCJCDZpm9hx2v0Lpk/BHQHpyhoGq', 'ccc597d3b7230aca3c5875c069c387f9', 'f2ac92673ae90e179ffb00b513cc053f', 'verified', 'Nastya', 'Zaya', 'Ukraine', 'Chernigiv', '1976-07-01', 'uploads/5.png', 'i love cats and traveling', 'female', 60, 178),
(22, 'Kristine123', 'krist@gmail.com', 'qwerty', 'ghekfu7si8eyfuk', 'fjkse48975t89yhtulsi', 'verified', 'Kristine', 'Love', 'Ukraine', 'Kiev', '1979-10-17', 'uploads/17.jpg', 'Cute', 'female', 65, 157),
(23, 'Lin123', 'Lin123@gmail.com', 'ddftgesr5324', 'fgew45ry435', 'sdfsdfsdfsfdsfd', 'verified', 'Kseshik', 'Jenita', 'Germany', 'Berlin', '1972-07-17', 'uploads/14.jpg', 'super-puper', 'female', 49, 167),
(24, 'Lin123', 'Lin123@gmail.com', 'ddftgesr5324', 'fgew45ry435', 'dsfsdfsfdsdfsdf', 'verified', 'Kseshik', 'Jenita', 'Germany', 'Berlin', '1972-07-17', 'uploads/10.jpg', 'super-puper', 'female', 54, 187),
(25, 'Lisdf123', 'Lisdf23@gmail.com', 'ddftsdf5324', 'fgewas5ry435', 'dsffsdsdfsfddsf', 'verified', 'Lena', 'Omelchendina', 'Germany', 'Berlin', '1982-07-17', 'uploads/11.jpg', 'super-puper', 'female', 60, 145),
(26, 'Licgukn123', 'Lin123@gmail.com', 'ddftgesr53rfte24', 'fgewserte5y45ry435', 'fdssfdsfsdfsd', 'verified', 'Irina', 'Linchuk', 'Ukraine', 'Luck', '1972-07-17', 'uploads/12.jpg', 'super-puper', 'female', 48, 165),
(27, 'Ligygyn123', 'Lin12wer3@gmail.com', 'ddtyuiuytiftgesr5324', 'fgedtyweyuyfw45ry435', 'sdffdssdfsdffds', 'verified', 'Lesya', 'Leckaluk', 'Germany', 'Brno', '1977-07-17', 'uploads/19.jpg', 'super-puper', 'female', 57, 172);

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `uuu_id` int(255) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`uuu_id`, `username`, `password`) VALUES
(1, 'jar', 'jar4ik3591');

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
('Upload', '11111111111111111.jpeg', 14, 'f2ac92673ae90e179ffb00b513cc053f');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `conversation`
--
ALTER TABLE `conversation`
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
-- Індекси таблиці `pers_data`
--
ALTER TABLE `pers_data`
  ADD PRIMARY KEY (`u_id`);

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
-- AUTO_INCREMENT для таблиці `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблиці `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблиці `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблиці `pers_data`
--
ALTER TABLE `pers_data`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблиці `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблиці `userfiles`
--
ALTER TABLE `userfiles`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
