-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Лип 12 2018 р., 09:26
-- Версія сервера: 10.2.16-MariaDB
-- Версія PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Структура таблиці `country`
--

CREATE TABLE `country` (
  `country_c_id` int(255) NOT NULL,
  `names` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_id`, `user_email_status`, `first_name`, `last_name`, `country`, `city`, `birth_date`, `profile_foto`, `details`, `gender`) VALUES
(2, 'anneta43565', 'adsasd@dasaas.com', '$2y$10$2caFu9z3YRo9oGY.A3a.S.4AIGeUzE1GWVXWfgFYhzP//QzE1.bxi', 'e5a2b453706cb51e47f768848d7c5bb7', '', 'verified', 'Annet', 'Kardi', 'Germany', 'Leipzig', '1976-06-28', 'uploads/1.png', 'info', 'female'),
(12, 'maria', 'vinni95@ukr.net', '$2y$10$ZBymn2PDvJcom5Jjcxj5e.5u.JCJCDZpm9hx2v0Lpk/BHQHpyhoGq', '9940ebdb87bf4d0a5f29d984de83c91c', '', 'verified', 'Anne', 'Lisa', 'Germany', 'Aachen', '1984-06-05', 'uploads/5.png', '', 'female'),
(14, 'kate', 'jaroslaw.vinnichuck@gmail.com', '$2y$10$dWgfuggqP60JEmxCN.6zFegjm4HWP1OSaZaz7X/1feREJEhu1Smxq', '34c81e116b3e95162917f0e54849d3aa', '', 'verified', 'Kate', 'Martin', 'Germany', 'Frankfurth', '1985-06-20', 'uploads/12.png', '', 'female'),
(15, 'lothar', 'werbung2010@me.com', '$2y$10$kRbYBOIgjGRRMnjFG/uHIeGp/QtiwoXtqVo6mL6q71YvSng7vIa9K', 'e5a221fef499fcd0d0707a8d4bfd94ef', '', 'verified', 'Lothar', '', 'Germany', 'Berlin', NULL, '', '', ''),
(16, 'Alla', 'allakerekesa31@gmail.com', '$2y$10$VSxyjN8z/5TqvfTK5C8y4euybbRdCo1kn5y/OgqvqG1ZZH..XtjD2', '175e9349f3794703818a599b13dd4c56', '', 'not verified', '', '', '', '', NULL, '', '', ''),
(17, 'amoni', 'lituanortusr@gmail.com', '$2y$10$BgHjHaU1wbNYdNd0NzvQmuImZobO4Ia9dy5hvaurd7V7NFv0Lcm7.', 'e4c6ae58026c0e66d124d3ea0aa0fb6a', '', 'not verified', '', '', '', '', NULL, '', '', ''),
(18, 'putin', 'upasha1996@mail.ru', '$2y$10$cneEf7nbgG.yS2P33ahAFegrsh5.8bgi7sr8otkgtnpRk5VjZUBHK', 'bddb4a1513ed10537173f42aaaeea0dc', '', 'verified', '', '', '', '', NULL, '', '', ''),
(19, 'Irishka', 'more.turov.kr.86@gmail.com', '$2y$10$DOMcgEAiU8YCg6/qH7QA2OclraioKFT7lJKYEkBoxzVleNQyI0u4e', '857221df6e987cad538e12c891a27c49', '', 'verified', 'Irina', 'Shevchenko', 'Ukraine ', 'Krivoy Rog ', NULL, 'uploads/BeautyPlus_20180702114549030_save.jpg', 'I hope soon have happy family.  \r\nI like so much travel. I have small daughter she is 4.5 years old.  \r\nO work in travel company. ', ''),
(20, 'ks ', 'Ks@gamil.com', '$2y$10$aAWph/UdhmB0Z8HlCiAdNuGsIpP.Wn9y0pRM3TfMqXjBY0XrgxAde', 'c07ceb729e8b3ad1243b892385a083a5', '', 'not verified', '', '', '', '', NULL, '', '', ''),
(21, 'test_user', 'test_mail@ukr.net', '$2y$10$ZBymn2PDvJcom5Jjcxj5e.5u.JCJCDZpm9hx2v0Lpk/BHQHpyhoGq', 'ccc597d3b7230aca3c5875c069c387f9', 'f2ac92673ae90e179ffb00b513cc053f', 'verified', 'jar', 'vinni', 'Ukraine', 'Kyiv', NULL, 'uploads/images.jpeg', '', '');

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
-- AUTO_INCREMENT для таблиці `pers_data`
--
ALTER TABLE `pers_data`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблиці `userfiles`
--
ALTER TABLE `userfiles`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
