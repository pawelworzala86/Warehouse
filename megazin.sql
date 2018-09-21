-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Sty 2018, 23:02
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `megazin`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) DEFAULT NULL,
  `surname` varchar(250) DEFAULT NULL,
  `postcode` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `street` varchar(250) DEFAULT NULL,
  `number` varchar(250) DEFAULT NULL,
  `subnumber` varchar(250) DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `address`
--

INSERT INTO `address` (`id`, `firstname`, `surname`, `postcode`, `city`, `street`, `number`, `subnumber`, `sys_unique_id`) VALUES
(1, 'Paweł', 'Worzała', '83-200', 'Starogard', 'Sucumin 93', '93', '', '3r4Uhsy9aro9YywO'),
(2, 'jan', 'kowalski', '83-200', 'warszawa', 'długa', '13', '1', 't2UQOj5iQCleVnRf'),
(3, 'jan', 'kowalski', '32-566', 'starpgard', 'ulica', '12', '', 'zhy6JEOysoIj3nTK'),
(4, 'jan', 'kowalski', '32-566', 'starpgard', 'ulica', '12', '', 'X8AVcLrmit6ErrNM'),
(5, 'jan', 'kowalski', '32-566', 'starpgard', 'ulica', '12', '', 'mafSmo83DAFMGZPb'),
(6, 'jan', 'kowalski', '32-566', 'starpgard', 'ulica', '12', '', 'wsuIPp27U3W2OXFV'),
(7, 'Paweł', 'Worzała', '83-200', 'Starogard', 'Sucumin 93', '', '', 'P7sOQcWt4uB99yM6'),
(8, 'Paweł', 'Worzała', '83-200', 'Starogard', 'Sucumin 93', '', '', '4miZf8zADnArTRLT'),
(9, 'Paweł', 'Worzała', '83-200', 'Starogard', 'Sucumin 93', '', '', 'OijLhLZmbZmGqvxx'),
(10, 'Paweł I', 'Worzała', '83-200', 'Starogard', 'Sucumin 93', '', '', 'Eumqq5XvDCVgB1NR');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `user_id`, `company_id`, `sys_unique_id`, `deleted`, `parent_id`) VALUES
(1, 'test', 1, 1, '5DyXTt96VpH3RK4l', 1517080532, NULL),
(2, 'kuku', 1, 1, '8f4pL50CWEiI2Q7J', 1517080536, NULL),
(3, 'gh', 1, 1, '3qZzsho4TkQXzIE3', 1517080537, NULL),
(4, 'cvb', 1, 1, 'XMIcvgXaaaFKKM5R', 1517080537, NULL),
(5, 'fghdfh', 1, 1, 'PETlecuG6Zsli6NM', 1517080537, NULL),
(6, 'test', 1, 1, 'WxBr7ZRbAcO82MGM', 1517080538, NULL),
(7, 'dupa', 1, 1, 'mhzBgpzZC0dQZg58', 1517080538, NULL),
(8, 'sdfsdf', 1, 1, 'r7LwOptDy4rUOJ31', 1517080537, 5),
(9, 'sdfsdf', 1, 1, 'o2heL7zz0lQFForV', 1517080537, 5),
(10, '123', 1, 1, 'cADAgAmixkLfkrSK', 1517080532, 1),
(11, 'fgh', 1, 1, 'LdCgSaYGuaXOmrLi', 1517080538, 7),
(12, '123', 1, 1, 'dcjmMXP19BN8oUKQ', 1517080538, NULL),
(13, 'ooo', 1, 1, '9JRuTQEhTVqVSDnO', 1517080533, 1),
(14, 'sadf', 1, 1, 'D1H20kCowTxRLU3C', 1517080533, 1),
(15, '123', 1, 1, 'Su5p8l3cCoYubxG4', 1517080533, 1),
(16, '123123', 1, 1, '0vzNGhFdMqX6RYcr', 1517080534, 15),
(17, 'fdg', 1, 1, 'hAgDDif3b1n1VVpr', 1517080539, NULL),
(18, 'asd', 1, 1, 'itBiiCreWpll29LA', 1517080539, NULL),
(19, 'dfg', 1, 1, 'nvGh6cIM89CCzHlK', 1517080534, 1),
(20, 'dfgdfg', 1, 1, 'EG8tX3dIRaNJYVbg', 1517080539, NULL),
(21, 'fdgd', 1, 1, 'lC9W1QpgDene1rRo', 1517080535, 1),
(22, 'sdf', 1, 1, 'cClfcXz93jY275Wn', 1517080536, 1),
(23, 'sdf', 1, 1, 'QDcPhowcsV3BMmTS', 1517080544, NULL),
(24, 'csdf', 1, 1, '2qNihV1LtCdUHxa2', 1517080536, 1),
(25, 'fff', 1, 1, 'IjKbwXEFmHzqxxsX', 1517080533, 10),
(26, 'fff', 1, 1, 'xDCW02dxkZMQHlKh', 1517080543, 23),
(27, 'dsd', 1, 1, 'cW0Epp020uiKJxWQ', 1517080533, 10),
(28, '123', 1, 1, 'Tl3OJWurFm5scoeO', 1517080528, 25),
(29, '35', 1, 1, 'QBdT0O4268daMJl6', 1517080529, 25),
(30, 'fd', 1, 1, 'z06gVDVXnWhzDydc', 1517080530, 25),
(31, 'sdf', 1, 1, 'N0opOP8iSZe5pTew', 1517080503, 28),
(32, 'sdfsdfsfd', 1, 1, 'HJaZtM2X0bLdAvnn', NULL, 31),
(33, 'sdfsdfsfdsdsdf', 1, 1, 'GYLYenscpxQ98H7U', 1517080428, 32),
(34, 'kjjk', 1, 1, 'm54zgOu1ghhMHcQ2', 1517080500, 31),
(35, 'cvxc', 1, 1, 'U3fQErgOsZ6rTBvk', NULL, 31),
(36, 'df', 1, 1, 'MWQE3cfl9gOV4KzC', 1517080306, 32),
(37, 'dfgdfg', 1, 1, 'kScfrrkWy8eqJfZ1', 1517080498, 32),
(38, 'gdf', 1, 1, 'RsqMoGxN51sIeV0f', 1517080531, 25),
(39, 'dsd', 1, 1, 'a9NnH1nUeFBD8OkI', 1517082498, NULL),
(40, 'fdfsd', 1, 1, 'zsxqeiDAylooxcY4', 1517081613, NULL),
(41, '', 1, 1, '0hrstlEXO8FRDxQX', 1517081610, NULL),
(42, '', 1, 1, '3MyLOZjWQNh3ThID', 1517081624, NULL),
(43, '123', 1, 1, '8uSCVlLh4HU96InF', 1517082376, NULL),
(44, 'xcv', 1, 1, '8Qy046fQZAsnH0JD', 1517081769, NULL),
(45, '213', 1, 1, 'mzvCxbrxyIm7IhTk', 1517082546, NULL),
(46, 'sdf', 1, 1, 'GGhCi7TLyZlruB3G', 1517082574, NULL),
(47, 'ccczx', 1, 1, '6wJf7OLwNQUnHm5h', NULL, NULL),
(48, 'ccczx', 1, 1, 'QiF44w3oygKAhBc6', NULL, NULL),
(49, 'sda', 1, 1, '7eEjYyzSY8221qom', NULL, NULL),
(50, 'dfg', 1, 1, '0jUWkbIywc3In2sI', NULL, NULL),
(51, 'dfg', 1, 1, 'mb4wRDNuS5spX5c1', NULL, NULL),
(52, 'fgh', 1, 1, 'Rkq2Ih7WfmGMAm8e', NULL, 43),
(53, 'c', 1, 1, 'jdBsiUOgkpPhSJ6t', NULL, 43),
(54, 'sdf', 1, 1, 'g4MWaiPevYf4GnfP', NULL, 43),
(55, 'fghfgh', 1, 1, 'vKovqnYNbJQXNoYk', NULL, 43),
(56, 'sdfsdf', 1, 1, 'lIOcyNVDC2miuQPU', NULL, 43),
(57, 'sdfsdfsdfsfd', 1, 1, '9s8WkQ61WdgKCY17', NULL, 43),
(58, 'sdfsdfsdfsfd', 1, 1, 'OjzAAgwuzbMA8A05', NULL, 43),
(59, 'sdfsdf3535', 1, 1, 'nzVpzuv1SCI4lXC2', NULL, 43),
(60, '325235', 1, 1, 'VwROeLV4X6zW3sOv', NULL, 54),
(61, 'fsfsd', 1, 1, 'qg7rrjTFuw0v5w76', NULL, 54),
(62, 'sdf', 1, 1, 'yaQAkHGweoUgwfBt', NULL, 39),
(63, 'sdsdf', 1, 1, 'tIcYnl7Izqnj49pn', NULL, 39),
(64, 'sdfsdfsdfsfd', 1, 1, 'vPxVE0M9MzfYFRYT', NULL, 39),
(65, 'sdf', 1, 1, 'yk21zgos5lfu2any', NULL, 45),
(66, 'sdfsdfsdfsfd', 1, 1, '3Pl172doplJgdhsP', NULL, 45),
(67, 'sdfsdfsdf', 1, 1, 'M6l8RnpEbAffRBzX', NULL, 45),
(68, 'sdf', 1, 1, 'wbbk7c3QLB2k51mz', NULL, 46),
(69, 'sdfsdf', 1, 1, 'gYAU9mh62GtfA28c', NULL, 46),
(70, 'sdfsdf', 1, 1, 'mrbIaaKtgKPXKoMC', NULL, 46),
(71, 'asdd', 1, 1, 'dQ8q2UakYMkXXakJ', NULL, 47),
(72, 'asdasd', 1, 1, 'KBFqQtW9Z3uByZTb', NULL, 47),
(73, 'asasd', 1, 1, 'NzQUBXk9NJNPC5Oq', NULL, 47),
(74, 'hh', 1, 1, 'nLOciY6BUSfPvREB', NULL, 49);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contractor`
--

CREATE TABLE `contractor` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `provider` tinyint(1) DEFAULT NULL,
  `recipient` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `contractor`
--

INSERT INTO `contractor` (`id`, `name`, `user_id`, `sys_unique_id`, `deleted`, `code`, `phone`, `fax`, `mail`, `address_id`, `nip`, `company_id`, `provider`, `recipient`) VALUES
(1, 'Paweł Worzała', 1, 'hlhtM57yuXOvI0oT', NULL, 'ACME', '532275755', '532275755', 'worzala.pawel@gmail.com', 1, '123-465-78-98', 1, 0, 1),
(2, 'ACME Dostawca Sp. Zoo', 1, 'AHl1avHaKB0ea6xI', NULL, 'ACME Dost', '532275755', '532275755', 'worzala.pawel@gmail.com', 2, '123-465-78-98', 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `number` varchar(250) DEFAULT NULL,
  `kind` varchar(10) DEFAULT NULL,
  `date_add` int(11) DEFAULT NULL,
  `date_act` int(11) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `date_pay` int(11) DEFAULT NULL,
  `payment` varchar(20) DEFAULT NULL,
  `payed` float DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `production_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `document`
--

INSERT INTO `document` (`id`, `user_id`, `deleted`, `type`, `sys_unique_id`, `contractor_id`, `added`, `number`, `kind`, `date_add`, `date_act`, `city`, `date_pay`, `payment`, `payed`, `company_id`, `production_id`) VALUES
(1, 1, NULL, 'add', 'yiiHcLQIpW1kro7A', 2, 1517029192, 'PZ/1/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(2, 1, NULL, 'dec', 'cBOUMznXAsKfOa0a', NULL, 1517029212, 'RW/1/2018', 'RW', 1517007600, 1517007600, 'Elbląg', 1517007600, 'none', 0, 1, 1),
(3, 1, NULL, 'add', 'C3MM7112zXXwHXJt', NULL, 1517029220, 'PW/1/2018', 'PW', 1517007600, 1517007600, 'Elbląg', 1517007600, 'none', 0, 1, 1),
(4, 1, NULL, 'add', 'jZ8nPIxVs49WRJI6', 2, 1517034372, 'PZ/2/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(5, 1, NULL, 'add', 'voJddf9gIWRBubyg', 2, 1517037238, 'PZ/3/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(6, 1, NULL, 'add', 'Gitwry538mpyIQ41', 2, 1517037251, 'PZ/4/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(7, 1, NULL, 'add', 'Hydn7EUx7sye9Tko', 2, 1517037267, 'PZ/5/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(8, 1, NULL, 'add', 'iB4Pk0pB5YRn4bei', 2, 1517037275, 'PZ/6/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(9, 1, NULL, 'add', 'gE29zPV7ABDusfU2', 2, 1517037529, 'PZ/7/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(10, 1, NULL, 'add', 'rAJEziKumWc2LBEP', 2, 1517037551, 'PZ/8/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(11, 1, NULL, 'add', 'CNf5PhBbZrosu3uW', 2, 1517037563, 'PZ/9/2018', 'PZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(12, 1, NULL, 'dec', 'liGlitHM8yenUoLR', 2, 1517050092, 'WZ/1/2018', 'WZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(13, 1, NULL, 'dec', 'FZ3HINMevmFIO42j', 1, 1517050339, 'WZ/2/2018', 'WZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(14, 1, NULL, 'dec', 'Oo4L4dID3TKKurwY', 1, 1517052449, 'FV/1/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(15, 1, NULL, 'dec', 'CuDtvzTbp0gTsYss', 1, 1517052449, 'FV/2/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(16, 1, NULL, 'add', 'xCxSy10D9RviwT5J', NULL, 1517052449, 'FV/3/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(17, 1, NULL, 'dec', '8vgYTYX1cxzn5vmh', 1, 1517052483, 'FV/4/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(18, 1, NULL, 'dec', 'wbym6oxxcC2JAqbq', NULL, 1517062946, 'FV/5/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(19, 1, NULL, 'dec', 'JXeLXscrrAncjXEM', NULL, 1517062946, 'FV/6/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(20, 1, NULL, 'add', 'c6JrO9HBY4hAohl3', NULL, 1517062946, 'FV/7/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(21, 1, NULL, 'add', 'NgsHx37NQYy6zskh', NULL, 1517068080, 'PW/2/2018', 'PW', 1517007600, 1517007600, 'Elbląg', 1517007600, 'none', 0, 1, 1),
(22, 1, NULL, 'add', 'LRYTE6E416XdMG2p', NULL, 1517068091, 'PW/3/2018', 'PW', 1517007600, 1517007600, 'Elbląg', 1517007600, 'none', 0, 1, 1),
(23, 1, NULL, 'dec', 'F02nHZPuZkADf4jD', 1, 1517068110, 'WZ/3/2018', 'WZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(24, 1, NULL, 'dec', 'CAWmpraxEWMP578h', 1, 1517068110, 'WZ/4/2018', 'WZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(25, 1, NULL, 'add', 'p8a7VHPrqRJQgZsX', NULL, 1517068110, 'WZ/5/2018', 'WZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(26, 1, NULL, 'dec', 'mU5rFCsPHsOPdAsC', 2, 1517068166, 'FV/8/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(27, 1, NULL, 'dec', 'UzHztP8yxj3zxBBk', 2, 1517068166, 'FV/9/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(28, 1, NULL, 'add', 'VnbgD7lcmxj78Dp5', NULL, 1517068166, 'FV/10/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(29, 1, NULL, 'dec', 'hDacrVUj4MQVYLI4', 1, 1517068525, 'FV/11/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(30, 1, NULL, 'dec', 'n83jhDuy18r7PtO5', 1, 1517068525, 'FV/12/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(31, 1, NULL, 'add', 'Txy9U5grltwu4oTv', NULL, 1517068525, 'FV/13/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(32, 1, NULL, 'dec', 'cwGb5rSUv3vasDjj', 2, 1517068548, 'FV/14/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(33, 1, NULL, 'dec', 'uV3WlZ8kXrCdTpqx', 2, 1517068548, 'FV/15/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(34, 1, NULL, 'add', 'E02ccsvOTQeCjN7Y', NULL, 1517068548, 'FV/16/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(35, 1, NULL, 'dec', 'AqeCcfOokdSJeifW', 1, 1517068740, 'FV/17/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(36, 1, NULL, 'dec', 'tGm4sfbgIBS5ktI2', 1, 1517068740, 'FV/18/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(37, 1, NULL, 'add', 'z5EXqPT7BemdJlP4', NULL, 1517068740, 'FV/19/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(38, 1, NULL, 'dec', 'YKJro7DZUMSDizBE', 2, 1517068771, 'FV/20/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(39, 1, NULL, 'dec', 'i9SrxRA9tSrFJ7AD', 2, 1517068771, 'FV/21/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(40, 1, NULL, 'add', 'Em4XxvhvFkCxg5tX', NULL, 1517068771, 'FV/22/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(41, 1, NULL, 'dec', 'VXx6y8VR5VchlgFN', 1, 1517068818, 'FV/23/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(42, 1, NULL, 'dec', 'Zc3rHJBfpgIh7d86', 1, 1517068818, 'FV/24/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(43, 1, NULL, 'add', '2tlaHU3P1bOjw92O', NULL, 1517068818, 'FV/25/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(44, 1, NULL, 'dec', 'TzExwG6oVxg0QXhb', NULL, 1517068891, 'FV/26/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(45, 1, NULL, 'dec', 'Z5bYQTA0EVaQ21SL', NULL, 1517068891, 'FV/27/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(46, 1, NULL, 'add', 's0kfGThFKeOOXrgm', NULL, 1517068891, 'FV/28/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(47, 1, NULL, 'dec', 'RGt5hlMuVspSBVd3', NULL, 1517068914, 'FV/29/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(48, 1, NULL, 'dec', 'HW9Rl54PYbmyqGoq', NULL, 1517068914, 'FV/30/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(49, 1, NULL, 'add', 'iptDZBCFbWPlqkgU', NULL, 1517068914, 'FV/31/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(50, 1, NULL, 'dec', 'rZ6vdZZDK22aviiJ', 1, 1517069209, 'FV/32/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(51, 1, NULL, 'add', 'bUJ9GAfMxD7klbgL', NULL, 1517069209, 'FV/33/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(52, 1, NULL, 'dec', 'Ru8zXstJ8TI28bve', 2, 1517069307, 'FV/34/2018', 'FV', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL),
(53, 1, NULL, 'dec', 'ow8C5N4idHOMXS50', 2, 1517069892, 'WZ/6/2018', 'WZ', 1517007600, 1517007600, 'Elbląg', 1517007600, 'wire', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `document_product`
--

CREATE TABLE `document_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` float DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `document_product_id` int(11) DEFAULT NULL,
  `buy_net` float DEFAULT NULL,
  `buy_tax` varchar(10) DEFAULT NULL,
  `buy_gross` float DEFAULT NULL,
  `sell_net` float DEFAULT NULL,
  `sell_tax` varchar(10) DEFAULT NULL,
  `sell_gross` float DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `document_product`
--

INSERT INTO `document_product` (`id`, `product_id`, `count`, `document_id`, `document_product_id`, `buy_net`, `buy_tax`, `buy_gross`, `sell_net`, `sell_tax`, `sell_gross`, `sys_unique_id`) VALUES
(1, 1, 80, 1, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'G3bFlkYSN21aK89R'),
(2, 2, 92, 1, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'z4AC56NXUFv6xKIG'),
(3, 1, 20, 2, 1, 8, '23', 8, 8, '23', 9.84, 'krOkQUvmhzd5BRQI'),
(4, 2, 20, 2, 2, 8, '23', 8, 8, '23', 9.84, 'ozpVzdxnVlxhdVOd'),
(5, 3, 20, 3, NULL, NULL, NULL, NULL, 45, '23%', 55.35, 'ycVFHq2DS1tZAJ5s'),
(6, 1, 7, 4, NULL, 7.97, '23', 9.8, NULL, NULL, NULL, 'zGdoKtWBplzD3CTJ'),
(7, 2, 11, 4, NULL, 8.11, '23', 9.98, NULL, NULL, NULL, 'LIkG1cjNUsT763aN'),
(8, 1, 4, 5, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'MC0TZk9Oy61t4xzn'),
(9, 2, 6, 5, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'rIqehP41fL9O7fGs'),
(10, 1, 8, 6, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'nwfoMqp6bRSkTeqc'),
(11, 2, 11, 6, NULL, 8, '23', 9.84, NULL, NULL, NULL, '37q6ufCNb9ItwdJ3'),
(12, 1, 5, 7, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'H9VLOj0UD5gbYixM'),
(13, 2, 8, 7, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'z79O8DdcQnqPQ8NA'),
(14, 1, 9, 8, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'XbGuRT4AsGZnSh8R'),
(15, 1, 100, 9, NULL, 0.12, '23', 0.15, NULL, NULL, NULL, 'wS3MpGvVgwVn0vHU'),
(16, 2, 6, 9, NULL, 0.12, '23', 0.15, NULL, NULL, NULL, 'vn6PY6TLyUWZdKVv'),
(17, 1, 1, 9, NULL, 7, '23', 8.61, NULL, NULL, NULL, 'Lw0epq1D4mdlfTcY'),
(18, 1, 4, 10, NULL, 0.12, '23', 0.15, NULL, NULL, NULL, 'UquB3gj60qpu7pfA'),
(19, 2, 44, 10, NULL, 0.12, '23', 0.15, NULL, NULL, NULL, '5NOwnnW3ffAZoVzN'),
(20, 4, 9, 10, NULL, 0.12, '23', 0.15, NULL, NULL, NULL, '7RZCXvsWLBt5Bnuq'),
(21, 4, 1000, 11, NULL, 0.12, '23', 0.15, NULL, NULL, NULL, 'bTZfusl0hMIwv7KJ'),
(22, 3, 1, 12, 5, NULL, NULL, NULL, 0.12, '23', 0.15, '55JsKMCk9hBOfWuc'),
(23, 3, 10, 13, 5, NULL, NULL, NULL, 45, '23', 55.35, '95xgWkiGiIZedM4S'),
(24, 3, 4, 14, 5, NULL, NULL, NULL, 45, '23', 55.35, 'f3kiAXrEZD3rMzfk'),
(25, 3, 4, 15, 5, NULL, NULL, NULL, 45, '23', 55.35, 'mJwKylfDERF6AoI2'),
(26, 3, 4, 16, NULL, 45, '23', 55.35, NULL, NULL, NULL, '3oZiApOvAZKM1QFg'),
(27, 3, 1, 17, 5, NULL, NULL, NULL, 45, '23', 55.35, 'HKb6C1qGyXLkdbl5'),
(28, 1, 1, 18, 1, 8, '23', 8, 2.89, '23', 3.55, 'wVnFqjOexuvXwaeX'),
(29, 2, 1, 18, 2, 8, '23', 8, 8, '23', 9.84, 'zYyUKS6gftkHVmmJ'),
(30, 1, 1, 19, 1, 8, '23', 8, 2.89, '23', 3.55, 'hiOxfTO0n7pwHnDK'),
(31, 2, 1, 19, 2, 8, '23', 8, 8, '23', 9.84, '5h3SsOqaqmUvN66o'),
(32, 1, 1, 20, NULL, 2.89, '23', 3.55, NULL, NULL, NULL, '50NaQpd2Fg99s58N'),
(33, 2, 1, 20, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'cDVi9Z8I0pxl7Xxn'),
(34, 3, 1, 21, NULL, NULL, NULL, NULL, 45, '23%', 55.35, 'uWdFvqHX92NPrX76'),
(35, 3, 50, 22, NULL, NULL, NULL, NULL, 45, '23%', 55.35, 'DvkxB6uKNV4WoraH'),
(36, 3, 1, 23, 34, NULL, NULL, NULL, 45, '23', 55.35, 'vZfrAWTMsoAECItu'),
(37, 3, 1, 24, 35, NULL, NULL, NULL, 45, '23', 55.35, 'SXIy4hK9yntBNocB'),
(38, 3, 1, 25, NULL, 45, '23', 55.35, NULL, NULL, NULL, 'I3wePIkFrVtsFrrk'),
(39, 3, 2, 26, 35, NULL, NULL, NULL, 45, '23', 55.35, 'BMaY3zv0rw4XVFWA'),
(40, 3, 2, 27, 35, NULL, NULL, NULL, 45, '23', 55.35, 'qqdltYyUBFd91RoE'),
(41, 3, 2, 28, NULL, 45, '23', 55.35, NULL, NULL, NULL, 'ouzbNE2TcfawT0Ca'),
(42, 3, 2, 29, 35, NULL, NULL, NULL, 45, '23', 55.35, 'dZJ8Yh2ifeR1jGWb'),
(43, 3, 2, 30, 35, NULL, NULL, NULL, 45, '23', 55.35, 'gfAZeIG4SwwseTgU'),
(44, 3, 2, 31, NULL, 45, '23', 55.35, NULL, NULL, NULL, 'c9IvI9vl1DQCnMTe'),
(45, 1, 1, 32, 1, 8, '23', 8, 2.89, '23', 3.55, 'IQKyvIPJGkardOjX'),
(46, 1, 1, 33, 1, 8, '23', 8, 2.89, '23', 3.55, 'v4gY57ODW7VXeoKl'),
(47, 1, 1, 34, NULL, 2.89, '23', 3.55, NULL, NULL, NULL, 'YKpPGMAyh5tAB8qX'),
(48, 2, 1, 35, 2, 8, '23', 8, 8, '23', 9.84, 'pW0exfQqqRLqysMW'),
(49, 2, 1, 36, 2, 8, '23', 8, 8, '23', 9.84, 'WrF9XUmQzcroKUmC'),
(50, 2, 1, 37, NULL, 8, '23', 9.84, NULL, NULL, NULL, 'AhI8WjcDGreHYtdJ'),
(51, 3, 1, 38, 35, NULL, NULL, NULL, 45, '23', 55.35, 'hQj6csZwawzs5Vow'),
(52, 3, 1, 39, 35, NULL, NULL, NULL, 45, '23', 55.35, 'Yz6ugwA6zF9EFus5'),
(53, 3, 1, 40, NULL, 45, '23', 55.35, NULL, NULL, NULL, 'BrIxaTVyT42ZdiD1'),
(54, 3, 1, 41, 35, NULL, NULL, NULL, 45, '23', 55.35, 'cvuRw9pBdaYDC9lG'),
(55, 3, 1, 42, 35, NULL, NULL, NULL, 45, '23', 55.35, 'TNiYGbScMioY3CNU'),
(56, 3, 1, 43, NULL, 45, '23', 55.35, NULL, NULL, NULL, 'uibLUFyoadpb4coK'),
(57, 3, 3, 50, 35, NULL, NULL, NULL, 45, '23', 55.35, 'CPbvtMcQZWyEhtNi'),
(58, 3, 3, 51, NULL, 45, '23', 55.35, NULL, NULL, NULL, 'AFsMcRmtJBPU2Lje'),
(59, 3, 4, 52, 35, NULL, NULL, NULL, 45, '23', 55.35, 'VEOFz79RTeVqMPoD'),
(60, 2, 4, 53, 2, 8, '23', 8, 8, '23', 9.84, 'hck5u49JQSVLMayu');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `link` varchar(250) DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `file`
--

INSERT INTO `file` (`id`, `link`, `sys_unique_id`) VALUES
(1, '/Files/Product/1000/fmuXDPXx0oS8YVhp3dJD4mrq6Kp4yL6x.jpg', 'MRTIlBNrqHFCQPQT'),
(2, '/Files/Product/250/bivKtFNJ77UViXgUseepsNjPGBq8SdFc.jpg', 'kfWJmwapYmc2bgk3'),
(3, '/Files/Product/1000/w2KRTYLThEHOMVwxQWdp6Khvw4jlwh7O.jpg', '8mOv5AgTMptMVyN3'),
(4, '/Files/Product/250/ByNHmfm7tcJYbeqeIoK8raBZdziEVDHI.jpg', 'yyyNkyTs2M4wTESz'),
(5, '/Files/Product/1000/R4ihbUO8A8SOnqi2EmPLFmAwuY2bmKyG.png', 'mJNhEKBeG9WO2tdH'),
(6, '/Files/Product/250/9mqOAhRRSK2sdUYEfcQZtLTlGt7Ue0wC.png', 'unl8kbd6NoqB9sup'),
(7, '/Files/Product/1000/cfuF6N4IuUf0KOoCMb2ZuW0VEtEUkPuI.jpg', 'TNkI3RZ1Z5gZd5bM'),
(8, '/Files/Product/250/IV2aCSzRCjDdOhIzebPcOhWh05rRM3IC.jpg', 'Y45dVPrF2tulOLqM');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_privilage`
--

CREATE TABLE `group_privilage` (
  `id` int(11) NOT NULL,
  `privilage_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `group_privilage`
--

INSERT INTO `group_privilage` (`id`, `privilage_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ip`
--

CREATE TABLE `ip` (
  `id` int(11) NOT NULL,
  `ip` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ip`
--

INSERT INTO `ip` (`id`, `ip`, `user_id`, `date`) VALUES
(1, 1, NULL, 1517028569);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `privilage`
--

CREATE TABLE `privilage` (
  `id` int(11) NOT NULL,
  `key` varchar(50) DEFAULT NULL,
  `description` text,
  `tag` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `privilage`
--

INSERT INTO `privilage` (`id`, `key`, `description`, `tag`) VALUES
(1, 'product-list', 'Dostęp do listy produktów', 'product'),
(2, 'product-del', 'Możliwość usuwania produktów', 'product'),
(3, 'product-edit', 'Możliwość edycji produktu', 'product'),
(4, 'werhouse-add', 'Przyjmowanie produktów', 'werhouse'),
(5, 'werhouse-dec', 'Wydawanie produktów', 'werhouse'),
(6, 'werhouse-list', 'Lista produktów', 'werhouse'),
(7, 'contractor-list', 'Dostęp do listy kontrahentów', 'contractor'),
(8, 'contractor-del', 'Możliwość usuwania kontrahentów', 'contractor'),
(9, 'contractor-edit', 'Możliwość edycji kontrahentów', 'contractor'),
(10, 'document-list', 'Dostęp do listy dokumentów', 'document'),
(11, 'document-del', 'Możliwość usuwania dokumentów', 'document'),
(12, 'document-print', 'Możliwość drukowania dokumentów', 'document'),
(13, 'production-list', 'Dostęp do listy produkcji', 'production'),
(14, 'production-del', 'Możliwość usuwania produkcji', 'production'),
(15, 'production-edit', 'Możliwość edycji produkcji', 'production'),
(16, 'production-income', 'Możliwość dodawania przychodów', 'production'),
(17, 'production-outcome', 'Możliwość dodawania rozchodów', 'production'),
(18, 'production-worker', 'Możliwość dodawania pracowników', 'production'),
(19, 'worker-list', 'Dostęp do listy pracowników', 'worker'),
(20, 'worker-del', 'Możliwość usuwania pracowników', 'worker'),
(21, 'worker-edit', 'Możliwość edycji pracowników', 'worker');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `sku` varchar(250) DEFAULT NULL,
  `net` float DEFAULT NULL,
  `tax` varchar(10) DEFAULT NULL,
  `gross` float DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `description_short` text,
  `description` text,
  `company_id` int(11) DEFAULT NULL,
  `intermediate` tinyint(1) DEFAULT NULL,
  `own` tinyint(1) DEFAULT NULL,
  `provider` varchar(250) DEFAULT NULL,
  `mark` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `name`, `user_id`, `deleted`, `sku`, `net`, `tax`, `gross`, `sys_unique_id`, `description_short`, `description`, `company_id`, `intermediate`, `own`, `provider`, `mark`) VALUES
(1, 'Półprodukt do wyrobu słuchawek', 1, NULL, 'PR001', 2.89, '23%', 3.55, 'aBhiPLPwEYUYiT7T', '', '<br>', 1, 1, 0, '', ''),
(2, 'Magnesy', 1, NULL, 'ASR23432', 8, '23%', 9.84, 'oRIDdIbPKz7mj2On', '', '<br>', 1, 1, 0, '', ''),
(3, 'Słuchawki małe', 1, NULL, '42342', 45, '23%', 55.35, 'J2Itd5auSWvdMH99', '', '<br>', 1, 0, 1, '', ''),
(4, 'Śrubka', 1, NULL, 'SR', 0.12, '23%', 0.15, 'Csnl0hHa3Atc0Ouo', '', '<br>', 1, 1, 0, '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `date_start` int(11) DEFAULT NULL,
  `date_end` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `production`
--

INSERT INTO `production` (`id`, `name`, `user_id`, `deleted`, `sys_unique_id`, `company_id`, `date_start`, `date_end`) VALUES
(1, 'Montaż słuchawek', 1, NULL, 'oc1bb3vm1lBAg3og', 1, 1517007600, 1517353200);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `production_day`
--

CREATE TABLE `production_day` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `production_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `production_day`
--

INSERT INTO `production_day` (`id`, `company_id`, `user_id`, `production_id`, `deleted`, `sys_unique_id`, `date`) VALUES
(1, 1, 1, 1, NULL, '43F3t2H9mMORfnnv', 1517007600);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `production_day_worker`
--

CREATE TABLE `production_day_worker` (
  `id` int(11) NOT NULL,
  `production_day_id` int(11) DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `sollary` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `production_day_worker`
--

INSERT INTO `production_day_worker` (`id`, `production_day_id`, `worker_id`, `hours`, `sollary`) VALUES
(1, 1, 1, 8, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `production_worker`
--

CREATE TABLE `production_worker` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `production_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `production_worker`
--

INSERT INTO `production_worker` (`id`, `user_id`, `company_id`, `worker_id`, `hours`, `sys_unique_id`, `deleted`, `production_id`) VALUES
(1, 1, 1, 1, 8, 'QEX4Pcykd6poSOl0', NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_auction`
--

CREATE TABLE `product_auction` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `auction` varchar(250) DEFAULT NULL,
  `outerid` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `added` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product_auction`
--

INSERT INTO `product_auction` (`id`, `product_id`, `auction`, `outerid`, `link`, `sys_unique_id`, `added`) VALUES
(1, 1, 'allegro', '6958414523', NULL, 'n5uVeb184OF3olQq', 1517055574),
(2, 2, 'allegro', '6958414524', NULL, 'UaWrAEkhDPzYowjp', 1517055577),
(3, 3, 'allegro', '6958414525', NULL, 'sP8V0BVWhxqGgcZC', 1517055579);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_catalog`
--

CREATE TABLE `product_catalog` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `catalog_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product_catalog`
--

INSERT INTO `product_catalog` (`id`, `product_id`, `catalog_id`) VALUES
(70, 1, 49),
(69, 1, 48),
(68, 1, 72),
(67, 1, 71),
(66, 1, 47);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_file`
--

CREATE TABLE `product_file` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `deleted` int(11) DEFAULT NULL,
  `thumb_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product_file`
--

INSERT INTO `product_file` (`id`, `product_id`, `file_id`, `sys_unique_id`, `deleted`, `thumb_id`) VALUES
(1, 1, 1, '6ajknG4ZkzXC8XzI', NULL, 2),
(2, 2, 3, 'hVNeQPK8MgUcYeL6', NULL, 4),
(3, 3, 5, '2PhgKsIppsMggbRm', NULL, 6),
(4, 4, 7, 'KPdpKzWE2Ob1Mj7y', NULL, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `session`
--

CREATE TABLE `session` (
  `id` varchar(32) NOT NULL,
  `access` int(10) UNSIGNED DEFAULT NULL,
  `data` text,
  `ip_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `session`
--

INSERT INTO `session` (`id`, `access`, `data`, `ip_id`) VALUES
('o33fpspp8hhb97mshqlt13bhib', 1517090557, 'userId|s:1:\"1\";userSuperAdmin|s:1:\"0\";companyId|s:1:\"1\";werhouseId|s:1:\"1\";products|a:1:{s:6:\"filter\";a:8:{s:4:\"name\";s:0:\"\";s:3:\"sku\";s:0:\"\";s:12:\"intermediate\";b:0;s:3:\"own\";b:0;s:10:\"price_from\";s:0:\"\";s:8:\"price_to\";s:0:\"\";s:8:\"provider\";s:0:\"\";s:4:\"mark\";s:0:\"\";}}workers|a:1:{s:6:\"filter\";a:1:{s:4:\"name\";N;}}productions|a:1:{s:6:\"filter\";a:1:{s:4:\"name\";s:0:\"\";}}productions-workers|a:1:{s:6:\"filter\";a:1:{s:4:\"name\";N;}}werhouse|a:1:{s:6:\"filter\";a:2:{s:4:\"name\";s:0:\"\";s:3:\"sku\";s:0:\"\";}}werhouses|a:1:{s:6:\"filter\";a:1:{s:4:\"name\";N;}}contractors|a:1:{s:6:\"filter\";a:4:{s:4:\"code\";N;s:4:\"name\";N;s:8:\"provider\";N;s:9:\"recipient\";N;}}productions-days|a:1:{s:6:\"filter\";a:1:{s:4:\"date\";N;}}documents|a:1:{s:6:\"filter\";a:2:{s:4:\"name\";N;s:6:\"number\";N;}}stat-product-buy|a:1:{s:6:\"filter\";a:6:{s:4:\"name\";s:0:\"\";s:3:\"sku\";s:0:\"\";s:9:\"date_from\";s:10:\"27-01-2018\";s:7:\"date_to\";s:10:\"27-01-2018\";s:10:\"price_from\";s:0:\"\";s:8:\"price_to\";s:0:\"\";}}userCurrency|s:3:\"PLN\";', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `document_product_id` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `werhouse_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `count`, `user_id`, `document_product_id`, `sys_unique_id`, `company_id`, `werhouse_id`) VALUES
(1, 1, 56, 1, 1, 'eeerIRN3aIbi5114', 1, 1),
(2, 2, 64, 1, 2, 'HSOTiE1jOewyddPI', 1, 1),
(3, 3, 0, 1, 5, 'giZxtvnG5kPSZzT2', 1, 1),
(4, 1, 7, 1, 6, 'hYscv13aAYAFtErt', 1, 1),
(5, 2, 11, 1, 7, 'thK8RUg1BEpuPXuK', 1, 1),
(6, 1, 4, 1, 8, '9Laq1lh7oNyKClI4', 1, 1),
(7, 2, 6, 1, 9, 'ErbenCM9mKtpIUO4', 1, 1),
(8, 1, 8, 1, 10, 'jd2ijFGveJGZLFDd', 1, 1),
(9, 2, 11, 1, 11, 'TRY1stqsCk3f2OIG', 1, 1),
(10, 1, 5, 1, 12, 'xrkQiR95pCfjZvFL', 1, 1),
(11, 2, 8, 1, 13, '59ujKPHhMmuIDO5w', 1, 1),
(12, 1, 9, 1, 14, 'vyFImC2NdZOd2aWM', 1, 1),
(13, 1, 100, 1, 15, '0emnfaAvuFnAtsFK', 1, 1),
(14, 2, 6, 1, 16, '5b13P90zmk376TdV', 1, 1),
(15, 1, 1, 1, 17, '53wyXs7fhl1tgsEI', 1, 1),
(16, 1, 4, 1, 18, 'G1GUDum4lLWEy912', 1, 1),
(17, 2, 44, 1, 19, 'Z4REZS73EVjyA5dB', 1, 1),
(18, 4, 9, 1, 20, 'jeh2eiEfVhtMmnmp', 1, 1),
(19, 4, 1000, 1, 21, 'U0mqw66VYRJXs5RW', 1, 1),
(20, 3, 0, 1, 34, 'BAGQW1CJiB4lvUKS', 1, 1),
(21, 3, 30, 1, 35, 'n78mMxAu0s41gfsL', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `sys_unique_id` varchar(16) NOT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `delete_hash` varchar(16) DEFAULT NULL,
  `activate_hash` varchar(16) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `super_admin` tinyint(1) DEFAULT '0',
  `werhouse_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'PLN',
  `nip` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `sys_unique_id`, `mail`, `password`, `company_id`, `delete_hash`, `activate_hash`, `deleted`, `super_admin`, `werhouse_id`, `address_id`, `currency`, `nip`) VALUES
(1, 'C1zaxcRYdZ1F4BkY', 'worzala.pawel@gmail.com', 'fe01ce2a7fbac8fafaed7c982a04e229', 1, NULL, NULL, NULL, 0, 1, 10, 'PLN', '123-456-78-62');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `werhouse`
--

CREATE TABLE `werhouse` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `werhouse`
--

INSERT INTO `werhouse` (`id`, `name`, `company_id`, `user_id`, `sys_unique_id`) VALUES
(1, 'Magazyn główny', 1, 1, 'EluoKd3OJV3vKmAl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `worker`
--

CREATE TABLE `worker` (
  `id` int(11) NOT NULL,
  `sys_unique_id` varchar(16) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `sollary` float DEFAULT NULL,
  `occupation` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `worker`
--

INSERT INTO `worker` (`id`, `sys_unique_id`, `name`, `user_id`, `company_id`, `deleted`, `sollary`, `occupation`) VALUES
(1, 'IBV00HN4eJPslOxg', 'Jan Kowalski', 1, 1, NULL, 12, 'Monter');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `contractor`
--
ALTER TABLE `contractor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `number` (`number`),
  ADD KEY `kind` (`kind`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `production_id` (`production_id`);

--
-- Indexes for table `document_product`
--
ALTER TABLE `document_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `document_product_id` (`document_product_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_privilage`
--
ALTER TABLE `group_privilage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privilage_id` (`privilage_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `privilage`
--
ALTER TABLE `privilage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `production_day`
--
ALTER TABLE `production_day`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `production_id` (`production_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`);

--
-- Indexes for table `production_day_worker`
--
ALTER TABLE `production_day_worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `production_day_id` (`production_day_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `production_worker`
--
ALTER TABLE `production_worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `production_id` (`production_id`);

--
-- Indexes for table `product_auction`
--
ALTER TABLE `product_auction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`);

--
-- Indexes for table `product_catalog`
--
ALTER TABLE `product_catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `catalog_id` (`catalog_id`);

--
-- Indexes for table `product_file`
--
ALTER TABLE `product_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `thumb_id` (`thumb_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip_id` (`ip_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `werhouse_id` (`werhouse_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`,`deleted`),
  ADD KEY `sys_unique_id` (`sys_unique_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `delete_hash` (`delete_hash`),
  ADD KEY `activate_hash` (`activate_hash`),
  ADD KEY `werhouse_id` (`werhouse_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `werhouse`
--
ALTER TABLE `werhouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sys_unique_id` (`sys_unique_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT dla tabeli `contractor`
--
ALTER TABLE `contractor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT dla tabeli `document_product`
--
ALTER TABLE `document_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT dla tabeli `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `group_privilage`
--
ALTER TABLE `group_privilage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `privilage`
--
ALTER TABLE `privilage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `production_day`
--
ALTER TABLE `production_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `production_day_worker`
--
ALTER TABLE `production_day_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `production_worker`
--
ALTER TABLE `production_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `product_auction`
--
ALTER TABLE `product_auction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `product_catalog`
--
ALTER TABLE `product_catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT dla tabeli `product_file`
--
ALTER TABLE `product_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `werhouse`
--
ALTER TABLE `werhouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
