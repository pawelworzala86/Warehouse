-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 19 Paź 2018, 00:41
-- Wersja serwera: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- Wersja PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `werhouse`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `street` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `postcode` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cash_document`
--

CREATE TABLE `cash_document` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `number` varchar(250) DEFAULT NULL,
  `kind` varchar(10) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `cash_document_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `cash_document_view` (
`id` int(11)
,`uuid` binary(16)
,`number` varchar(250)
,`added_by` int(11)
,`amount` float
,`kind` varchar(10)
,`added` int(11)
,`date` date
,`hour` varchar(10)
,`document_number` varchar(90)
,`document_id` binary(16)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `cash_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `cash_view` (
`ballance` double
,`added_by` int(11)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `lp` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `host` varchar(250) DEFAULT NULL,
  `key` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `channel`
--

INSERT INTO `channel` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `host`, `key`) VALUES
(1, 0x1c36aa6095f6c562b0d79978d27d531c, 1539889118, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'prestashop', 'prestashop.localhost', 'K58254STF7AP6HT7S884BU4XWE2PKMG6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contractor`
--

CREATE TABLE `contractor` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `code` varchar(90) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `nip` varchar(250) DEFAULT NULL,
  `supplier` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contractor_contact`
--

CREATE TABLE `contractor_contact` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `fax` varchar(250) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `www` varchar(250) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contractor_integration`
--

CREATE TABLE `contractor_integration` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `presta_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `debtor_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `debtor_view` (
`uuid` binary(16)
,`id` int(11)
,`added_by` int(11)
,`deleted` int(11)
,`debt` double(19,2)
,`name` varchar(250)
,`code` varchar(90)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text,
  `net` float DEFAULT NULL,
  `gross` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `payment` varchar(250) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `swift` varchar(250) DEFAULT NULL,
  `bank_number` varchar(250) DEFAULT NULL,
  `issue_place` varchar(250) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `payed` float DEFAULT NULL,
  `to_pay` float DEFAULT NULL,
  `kind` varchar(3) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `name_from` varchar(250) DEFAULT NULL,
  `owner_address_id` int(11) DEFAULT NULL,
  `contractor_address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `document_financial`
--

CREATE TABLE `document_financial` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `financial_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `document_number`
--

CREATE TABLE `document_number` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `document_product`
--

CREATE TABLE `document_product` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` float DEFAULT NULL,
  `net` float DEFAULT NULL,
  `sum_net` float DEFAULT NULL,
  `sum_gross` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `document_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `document_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `document_view` (
`uuid` binary(16)
,`id` int(11)
,`name` varchar(90)
,`date` date
,`added_by` int(11)
,`deleted` int(11)
,`contractor_name` varchar(250)
,`gross` float
,`contractor_id` binary(16)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `file`
--

INSERT INTO `file` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `size`, `url`, `name`, `type`) VALUES
(1, 0x71f6c87616f5596df3b75ac9ff37a173, 1539889134, 1, 2, 0, NULL, NULL, 200842, '/Files/Hummingbird-printed-sweater1.jpg', 'Hummingbird-printed-sweater1', 'image/jpg'),
(2, 0xaba3f78bd9113ac879bb8876d2ff5c67, 1539889135, 1, 2, 0, NULL, NULL, 58328, '/Files/The-best-is-yet-to-come\'-Framed-poster1.jpg', 'The-best-is-yet-to-come\'-Framed-poster1', 'image/jpg'),
(3, 0x72594a1d2d43144c8ac604f9977f1c43, 1539889135, 1, 2, 0, NULL, NULL, 58196, '/Files/The-adventure-begins-Framed-poster1.jpg', 'The-adventure-begins-Framed-poster1', 'image/jpg'),
(4, 0x2811bf47b095564170058a9f55759846, 1539889136, 1, 2, 0, NULL, NULL, 54621, '/Files/Today-is-a-good-day-Framed-poster1.jpg', 'Today-is-a-good-day-Framed-poster1', 'image/jpg'),
(5, 0xa9b750fa1967bb79531f48729ac9d0f1, 1539889137, 1, 2, 0, NULL, NULL, 51833, '/Files/Mug-The-best-is-yet-to-come1.jpg', 'Mug-The-best-is-yet-to-come1', 'image/jpg'),
(6, 0xdd69b825a87a94026f96468048568055, 1539889137, 1, 2, 0, NULL, NULL, 52963, '/Files/Mug-The-adventure-begins1.jpg', 'Mug-The-adventure-begins1', 'image/jpg'),
(7, 0xa88c6955655003ab408b1046f5641c05, 1539889138, 1, 2, 0, NULL, NULL, 67272, '/Files/Mountain-fox-cushion1.jpg', 'Mountain-fox-cushion1', 'image/jpg'),
(8, 0xcd783c419995af569c82b9299c5dc66c, 1539889138, 1, 2, 0, NULL, NULL, 57062, '/Files/Mountain-fox-cushion2.jpg', 'Mountain-fox-cushion2', 'image/jpg'),
(9, 0x8d54549a575036dcbd433738bd2d452c, 1539889139, 1, 2, 0, NULL, NULL, 64597, '/Files/Brown-bear-cushion1.jpg', 'Brown-bear-cushion1', 'image/jpg'),
(10, 0xad80b13f7ca5ff9d0445263d3c1c06df, 1539889139, 1, 2, 0, NULL, NULL, 58162, '/Files/Brown-bear-cushion2.jpg', 'Brown-bear-cushion2', 'image/jpg'),
(11, 0x60d009134f1991213a68436afdb4f81b, 1539889139, 1, 2, 0, NULL, NULL, 67788, '/Files/Hummingbird-cushion1.jpg', 'Hummingbird-cushion1', 'image/jpg'),
(12, 0xaf0c51f68abb8b7ad0d6185c3fdcd5d9, 1539889140, 1, 2, 0, NULL, NULL, 58477, '/Files/Hummingbird-cushion2.jpg', 'Hummingbird-cushion2', 'image/jpg'),
(13, 0x41cb97a4953979f991d7bcc9cf5c1784, 1539889140, 1, 2, 0, NULL, NULL, 55588, '/Files/Mountain-fox---Vector-graphics1.jpg', 'Mountain-fox---Vector-graphics1', 'image/jpg'),
(14, 0xa5001974bd093627a661a09241690409, 1539889141, 1, 2, 0, NULL, NULL, 56297, '/Files/Brown-bear---Vector-graphics1.jpg', 'Brown-bear---Vector-graphics1', 'image/jpg'),
(15, 0xd0213ff7b27112f7d82cbd9d91f9fc90, 1539889141, 1, 2, 0, NULL, NULL, 64027, '/Files/Pack-Mug-+-Framed-poster1.jpg', 'Pack-Mug-+-Framed-poster1', 'image/jpg'),
(16, 0x0f796d745a640cc54afbb39f9cc66a31, 1539889142, 1, 2, 0, NULL, NULL, 124799, '/Files/Hummingbird-printed-t-shirt1.jpg', 'Hummingbird-printed-t-shirt1', 'image/jpg'),
(17, 0x4669c499a4bdab38d1951cb33d0a8442, 1539889142, 1, 2, 0, NULL, NULL, 123033, '/Files/Brown-bear-notebook1.jpg', 'Brown-bear-notebook1', 'image/jpg'),
(18, 0xfd7dfa8a158312c4c3ddf5ff74b21939, 1539889143, 1, 2, 0, NULL, NULL, 126050, '/Files/Hummingbird-notebook1.jpg', 'Hummingbird-notebook1', 'image/jpg'),
(19, 0xd7b5d4fd3344789b28c5d92289acf481, 1539889143, 1, 2, 0, NULL, NULL, 48922, '/Files/Mug-Today-is-a-good-day1.jpg', 'Mug-Today-is-a-good-day1', 'image/jpg'),
(20, 0xa44b1f244402a4470d9118ff982d5186, 1539889144, 1, 2, 0, NULL, NULL, 59274, '/Files/Hummingbird---Vector-graphics1.jpg', 'Hummingbird---Vector-graphics1', 'image/jpg'),
(21, 0xd9765f39368f768ff6091d3876f3cfb8, 1539889144, 1, 2, 0, NULL, NULL, 43429, '/Files/Customizable-mug1.jpg', 'Customizable-mug1', 'image/jpg'),
(22, 0xb3f501d44c3b63d90d97356511a1dd4c, 1539889145, 1, 2, 0, NULL, NULL, 66269, '/Files/Hummingbird-printed-t-shirt1.jpg', 'Hummingbird-printed-t-shirt1', 'image/jpg'),
(23, 0x4a7d781f264fbf660232db706009dd99, 1539889145, 1, 2, 0, NULL, NULL, 61493, '/Files/Hummingbird-printed-t-shirt2.jpg', 'Hummingbird-printed-t-shirt2', 'image/jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `financial`
--

CREATE TABLE `financial` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `integration`
--

CREATE TABLE `integration` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ip`
--

CREATE TABLE `ip` (
  `id` int(11) NOT NULL,
  `ip` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ip`
--

INSERT INTO `ip` (`id`, `ip`, `user_id`, `date`) VALUES
(1, 1, NULL, 1539142245),
(2, 1, 1, 1539901986);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oauth`
--

CREATE TABLE `oauth` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `token` text,
  `refresh_token` text,
  `integration_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `oauth`
--

INSERT INTO `oauth` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `token`, `refresh_token`, `integration_id`) VALUES
(1, 0xb7a198731516b765b54c57fcb99d40d1, 1539890972, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1Mzk5MzQxNzIsInVzZXJfbmFtZSI6IjQ0MDY3NDAxIiwianRpIjoiN2ViMDAxMDUtNDhjZS00YjFlLWI2MjAtODBjNTcxMjc5YTZkIiwiY2xpZW50X2lkIjoiYjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTAiLCJzY29wZSI6WyJhbGxlZ3JvX2FwaSJdfQ.OBG3GR3mrRUZuPchDR0dbw0bhXDkFLcez1n4MmihqQ0K7B8EllL4QA5twGmvM5KsWjJUzbA5PMk2WLSwSHw05poOiKk2JAwJ_f2eVmpck-_DyGG8Kfv5rWIZ5ktT8UHWHaq2jcZJ0qBbHBY8KrqZEyMKZbZXuK6ehxB0gwJFE9h66S-xgU3KFdWIpYDYD1_t3BFV49e7SDLK_9ghsW0MdzrEHvm7DIV2E4iuiLCnvtt6SJl3nDv578s8_rz1i4W47x5vEuvaMS4zcP6zKT15yekmBEkFZOhesEyCZZI_y88woayQ4HL6lIEEKAYHI-ihi6CosuKDNNQm66K9O2NZUQ', 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1NzE0MjY5NzIsInVzZXJfbmFtZSI6IjQ0MDY3NDAxIiwianRpIjoiYzJlOTc2MTQtOTNkMi00OTY5LWE3MzMtZWUxNGU0N2JjNzQ1IiwiY2xpZW50X2lkIjoiYjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTAiLCJzY29wZSI6WyJhbGxlZ3JvX2FwaSJdLCJhdGkiOiI3ZWIwMDEwNS00OGNlLTRiMWUtYjYyMC04MGM1NzEyNzlhNmQifQ.Kkxpr1zJjXTvIfLgr0tBZxywQxrwHLi7T5_SaCcuTg_8LJYNHCF8zDS1Ur9WxshxcEIsjsWJlwy-UkIRsCMy9UPte0EXxnSm3mEglRxlcoVRM3PEf_JWXNKH1MX5BimwvUZmWNnHt1TVEY67m7GPZ3UT9iltSZCF7jwrnylCP-jIOvDpRoTqvaOe8XRYnGGjLYP_NpuasI8NwwEki51Y9t78cZX7fiZVHrnJKam_2UZYxNd6wYUrDoeSPvVi8nTiMaWkOrr86OWhShvlHINu-8DiexA80gLrb98d89RLcB4DeIqlT_EtMKsJS3C9FvkOS_jCERbuDQDe7i_X5TbuAg', 1),
(2, 0xbb6c84263a7fccbcfc1dc5c973d672cf, 1539891681, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1Mzk5MzQ4ODEsInVzZXJfbmFtZSI6IjQ0MDY3NDAxIiwianRpIjoiZDczNWMyM2EtM2E5Yi00NTQ3LTgyYzctYTI5ZTUxZGI2MDdkIiwiY2xpZW50X2lkIjoiYjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTAiLCJzY29wZSI6WyJhbGxlZ3JvX2FwaSJdfQ.cAnC_ak_fE9jfMPUdYGS1XwTlFEYZz7-x3R1_nuNIzaNdZKynIg7U4yePO6uiwgCyZFoK_DwxivWKcgECpmW1hq41d4EjhH-urq4HJXZo4kJ_00a1Qrc7QQgWr_PRh22vdUlzApoW81IJUUSQYCon2YqdGDtTjPYMwY2l_MR6l8kO2cAhHklrBS-6sK2h74oC2pIDeM0Sx5gVdxhifcYUz1zwiYc3q1SOKeiFBzRjLZVDnpPAnYwVDuy-m55yVXuCK9SiTSsVW6yDLWXqEn5lu7kedzjNR8nC_D4qGfUih8_Q3sjkxwnGpLvbOP61nOKKylxPrTn5Wjz0U42VBvekg', 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1NzE0Mjc2ODEsInVzZXJfbmFtZSI6IjQ0MDY3NDAxIiwianRpIjoiZGNkNjlhMGUtMGRiZi00MDg1LTk1MjItOTA2ZjdkZmJmYTU2IiwiY2xpZW50X2lkIjoiYjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTAiLCJzY29wZSI6WyJhbGxlZ3JvX2FwaSJdLCJhdGkiOiJkNzM1YzIzYS0zYTliLTQ1NDctODJjNy1hMjllNTFkYjYwN2QifQ.HWSwLKTTJkqOOWjFL3t4JYQw8o1fiQ6s2BKIXZG5osiZMADqQPdrOeKUqGH3zUcY6-QccjOwRy7QXIIHEi6b21ZmXH6X3R_fmBur5xGbzeDC6o82po96whqlqj0FMcNo2bvhtSxf2h4BNLqRLuq_k4Tx1s7DQpHMMb8UFFXw9eznl3JwcIRA8nIbi7mzMxyVKwIZDmJfRu0MOoeDQue_LtEIe6S6k0qkcEpNeoiubtiIw7w1fE_UkkpHdKlwclNTl5nYa6Vx4ChaItnnAEw5ZcdUGyRTzn7zCATIuPp3ZSjKgA6HO3Ovl_d1OWjJvNzbvII1lMqdOOtdLtJEddvnSw', 1),
(3, 0x5dc7c2f7396f6755a14389d24fd51ff8, 1539891682, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1Mzk5MzQ4ODIsInVzZXJfbmFtZSI6IjQ0MDY3NDAxIiwianRpIjoiN2I2NGU3ZjUtNDYwMS00ZTgzLWE0YWUtNWY2YjAwYjYzODQ2IiwiY2xpZW50X2lkIjoiYjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTAiLCJzY29wZSI6WyJhbGxlZ3JvX2FwaSJdfQ.gG1bH8GuB552qeUWurNAhY7rxCbbNSASfxKBSUkkc-5cwjSQZ293R64cYounp0feGo3J8oMNNBxHjYRaVDxSMmKQ968qYWhfqcwvBpwSCxNRwWmP3ZretTR9ziSa-8krDONSS-IVzk18rx4ZChuPvo_zX_ld7gbSIVi4DJJEQEmS5BH3MYoEy2n2umHLYcJfOSnZFk7fBK-z3gPTfV-drD7lidm-xCU6oLHfPM0GuA-bAQWYq2OpjIc7qoM66zv_RRbD9vGFDPtEoibdJKqtwIeyi27GuUdOTc5IJN6GWf7b9lMYUjXzjGTUzYG2T00EP4l3YudYpayVF2pxErMkIw', 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1NzE0Mjc2ODIsInVzZXJfbmFtZSI6IjQ0MDY3NDAxIiwianRpIjoiYjQyYWQ0ODYtMWFjNy00ZDg4LWFjZjctNGRmMWJjYTNkMTkxIiwiY2xpZW50X2lkIjoiYjU4NTg2MWE3NjBlNGRhYWI2NmFjNDQwZTM1MTUzMTAiLCJzY29wZSI6WyJhbGxlZ3JvX2FwaSJdLCJhdGkiOiI3YjY0ZTdmNS00NjAxLTRlODMtYTRhZS01ZjZiMDBiNjM4NDYifQ.yhmGVoiRZfkj-dMlNoThxrjCnAprlpY2QVTTSF62NWZNt6erT7L03Iu9Fjn42HEHdPxn_l_Qhh9zxiIBqR3NKCuYf3E4oR6uYdklSUStLE8xxOmeRewl0C1XX1_7W26hnTUefre6Ht7U0Z1c_dcwwkMCoaWoCT9SCgAKFgyYucUkerUHEM13wwEKnaXPHJbRtVbGwSD2mXtDX1rJhoKGf5YoMVTo-_BOVTusrxSKY2bCN4RgaGbYYggMOHD0JTcVTaX1xE3sF1SUPs9CQP-AkNw3xwqugnRoL896qy0n1dtjgs2TK3Hz-qGh142hSofIkG0VJZoGbKm1a2rd_hpYQA', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `number` varchar(90) DEFAULT NULL,
  `courier` varchar(250) DEFAULT NULL,
  `courier_number` varchar(250) DEFAULT NULL,
  `courier_price` float DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `courier_number_second` varchar(250) DEFAULT NULL,
  `pickup` varchar(250) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sum_net` float DEFAULT NULL,
  `sum_gross` float DEFAULT NULL,
  `sum_vat` float DEFAULT NULL,
  `total_paid` float DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_integration`
--

CREATE TABLE `order_integration` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `presta_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `count` float DEFAULT NULL,
  `net` float DEFAULT NULL,
  `sum_net` float DEFAULT NULL,
  `sum_gross` float DEFAULT NULL,
  `vat` varchar(10) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `sku` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description_short` text,
  `description_full` text,
  `sku` varchar(250) DEFAULT NULL,
  `to_sell` tinyint(1) DEFAULT '1',
  `partial` tinyint(1) DEFAULT '0',
  `sell_net` float DEFAULT NULL,
  `sell_gross` float DEFAULT NULL,
  `vat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `description_short`, `description_full`, `sku`, `to_sell`, `partial`, `sell_net`, `sell_gross`, `vat`) VALUES
(1, 0xa44bd90f01b29bb156a998f876442c59, 1539889134, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Hummingbird printed sweater', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Regular fit, round neckline, long sleeves. 100% cotton, brushed inner side for extra comfort. </span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\"><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Studio Design\' PolyFaune collection features classic products with colorful patterns, inspired by the traditional japanese origamis. To wear with a chino or jeans. The sublimation textile printing process provides an exceptional color rendering and a color, guaranteed overtime.</span></span></p>', 'demo_3', 1, 0, 44.16, 54.32, '23'),
(2, 0x73680f4767ff8753a2a2803853c29384, 1539889134, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'The best is yet to come\' Framed poster', '<p><span style=\"font-size:10pt;font-family:Arial;font-weight:normal;font-style:normal;color:#000000;\">Printed on rigid matt paper and smooth surface.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.</span></p>', 'demo_6', 1, 0, 43.87, 53.96, '23'),
(3, 0xa7214029f635bc36c651f2753c102732, 1539889135, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'The adventure begins Framed poster', '<p><span style=\"font-size:10pt;font-family:Arial;font-weight:normal;font-style:normal;color:#000000;\">Printed on rigid matt finish and smooth surface.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.</span></p>', 'demo_5', 1, 0, 43.87, 53.96, '23'),
(4, 0xf7bbd35031ac1d052cb58fdba94b861a, 1539889136, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Today is a good day Framed poster', '<p><span style=\"font-size:10pt;font-family:Arial;font-weight:normal;font-style:normal;color:#000000;\">Printed on rigid paper with matt finish and smooth surface.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.</span></p>', 'demo_7', 1, 0, 43.87, 53.96, '23'),
(5, 0x8680103b9cbd2d3fc9b962979b96b204, 1539889136, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Mug The best is yet to come', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">White Ceramic Mug, 325ml.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The best is yet to come! Start the day off right with a positive thought. 8,2cm diameter / 9,5cm height / 0.43kg. Dishwasher-proof.</span></p>', 'demo_11', 1, 0, 18.01, 22.15, '23'),
(6, 0x39c99b4430a582d9179f4fc85bfd156c, 1539889137, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Mug The adventure begins', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">White Ceramic Mug. 325ml</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The adventure begins with a cup of coffee. Set out to conquer the day! 8,2cm diameter / 9,5cm height / 0.43kg. Dishwasher-proof.</span></p>', 'demo_12', 1, 0, 18.01, 22.15, '23'),
(7, 0x3c114dba472500104b15bb4db251a102, 1539889138, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Mountain fox cushion', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Cushion with removable cover and invisible zip on the back. 32x32cm</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-weight:normal;font-style:normal;color:#000000;\">The mountain fox cushion will add a graphic and colorful touch to your sofa, armchair or bed. Create a modern and zen atmosphere that inspires relaxation. Cover 100% cotton, machine washable at 60° / Filling 100% hypoallergenic polyester.</span></p>', 'demo_15', 1, 0, 28.6, 35.18, '23'),
(8, 0x303b9fc4d5f16fc78035221a2c100bb5, 1539889138, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Brown bear cushion', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Cushion with removable cover and invisible zip on the back. 32x32cm</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-weight:normal;font-style:normal;color:#000000;\">The brown bear cushion will add a graphic and colorful touch to your sofa, armchair or bed. Create a modern and zen atmosphere that inspires relaxation. Cover 100% cotton, machine washable at 60° / Filling 100% hypoallergenic polyester.</span></p>', 'demo_16', 1, 0, 28.6, 35.18, '23'),
(9, 0x12a0f6bfacd183c6b71d1f4fb8d97ff2, 1539889139, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Hummingbird cushion', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Cushion with removable cover and invisible zip on the back. 32x32cm</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-weight:normal;font-style:normal;color:#000000;\">The hummingbird cushion will add a graphic and colorful touch to your sofa, armchair or bed. Create a modern and zen atmosphere that inspires relaxation. Cover 100% cotton, machine washable at 60° / Filling 100% hypoallergenic polyester.</span></p>', 'demo_17', 1, 0, 28.6, 35.18, '23'),
(10, 0x0c3b4bd26a8938a803b1d0d1b5454b58, 1539889140, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Mountain fox - Vector graphics', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Vector graphic, format: svg. Download for personal, private and non-commercial use.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">You have a custom printing creative project? The vector graphic Mountain fox illustration can be used for printing purpose on any support, without size limitation. </span></p>', 'demo_18', 1, 0, 13.62, 16.75, '23'),
(11, 0x7100613c6c05b24858b3d506437a8dc3, 1539889140, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Brown bear - Vector graphics', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Vector graphic, format: svg. Download for personal, private and non-commercial use.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">You have a custom printing creative project? The vector graphic Mountain fox illustration can be used for printing purpose on any support, without size limitation. </span></p>', 'demo_19', 1, 0, 13.62, 16.75, '23'),
(12, 0x8d64bd9488c0f03319f4b95a9c170d1a, 1539889141, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Pack Mug + Framed poster', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Mug The Adventure Begins + Framed poster Today is a good day 40x60cm </span></p>', '', 'demo_21', 1, 0, 52.95, 65.13, '23'),
(13, 0xd40680ac8f352686960927146ac1c257, 1539889141, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Hummingbird printed t-shirt', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Regular fit, round neckline, short sleeves. Made of extra long staple pima cotton. </span></p>\n<p></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\"><span style=\"font-size:10pt;font-family:Arial;font-style:normal;color:#efefef;\">Symbol of lightness and delicacy, the hummingbird evokes curiosity and joy.</span><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\"> Studio Design\' PolyFaune collection features classic products with colorful patterns, inspired by the traditional japanese origamis. To wear with a chino or jeans. The sublimation textile printing process provides an exceptional color rendering and a color, guaranteed overtime.</span></span></p>', 'demo_1', 1, 0, 29.4, 36.16, '23'),
(14, 0xd8087631b37416964878b8fc174191b2, 1539889142, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Brown bear notebook', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">120 sheets notebook with hard cover made of recycled cardboard. 16x22cm</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The Mountain fox notebook is the best option to write down your most ingenious ideas. At work, at home or when traveling, its endearing design and manufacturing quality will make you feel like writing! 90 gsm paper / double spiral binding.</span></p>', 'demo_9', 1, 0, 19.52, 24.01, '23'),
(15, 0x33d0d028731b2d891d45f325d3a16a19, 1539889142, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Hummingbird notebook', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">120 sheets notebook with hard cover made of recycled cardboard. 16x22cm</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">The Mountain fox notebook is the best option to write down your most ingenious ideas. At work, at home or when traveling, its endearing design and manufacturing quality will make you feel like writing! 90 gsm paper / double spiral binding.</span></p>', 'demo_10', 1, 0, 19.52, 24.01, '23'),
(16, 0x08f45d391427fd0db5903f753210db01, 1539889143, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Mug Today is a good day', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">White Ceramic Mug. 325ml</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Add an optimistic touch to your morning coffee and start the day in a good mood! 8,2cm diameter / 9,5cm height / 0.43kg. Dishwasher-proof.</span></p>', 'demo_13', 1, 0, 11.9, 14.64, '23'),
(17, 0x15205b60a3ff33ccdd386f060a38c3ab, 1539889143, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Hummingbird - Vector graphics', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Vector graphic, format: svg. Download for personal, private and non-commercial use.</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">You have a custom printing creative project? The vector graphic Mountain fox illustration can be used for printing purpose on any support, without size limitation. </span></p>', 'demo_20', 1, 0, 13.62, 16.75, '23'),
(18, 0x6c26aad7420a655d7ad78ccbc4241d5f, 1539889144, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Customizable mug', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">White Ceramic Mug. 325ml</span></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\"><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Customize your mug with the text of your choice. A mood, a message, a quote... It\'s up to you! Maximum number of characters:</span><span style=\"font-size:10pt;font-family:Arial;font-style:normal;color:#ff9900;\"> ---</span></span></p>', 'demo_14', 1, 0, 21.03, 25.87, '23'),
(19, 0xc489c6d1fa12a97d450cf53a251adf42, 1539889145, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Hummingbird printed t-shirt', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\">Regular fit, round neckline, short sleeves. Made of extra long staple pima cotton. </span></p>\n<p></p>', '<p><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\"><span style=\"font-size:10pt;font-family:Arial;font-style:normal;color:#efefef;\">Symbol of lightness and delicacy, the hummingbird evokes curiosity and joy.</span><span style=\"font-size:10pt;font-family:Arial;font-style:normal;\"> Studio Design\' PolyFaune collection features classic products with colorful patterns, inspired by the traditional japanese origamis. To wear with a chino or jeans. The sublimation textile printing process provides an exceptional color rendering and a color, guaranteed overtime.</span></span></p>', 'demo_1', 1, 0, 23.9, 29.4, '23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `production_document`
--

CREATE TABLE `production_document` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `production_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `production_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `production_view` (
`id` int(11)
,`uuid` binary(16)
,`added_by` int(11)
,`name` varchar(250)
,`buy_net` double(19,2)
,`sell_net` double(19,2)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_allegro`
--

CREATE TABLE `product_allegro` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `allegro_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `product_allegro`
--

INSERT INTO `product_allegro` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `product_id`, `allegro_id`) VALUES
(1, 0x394d50543637439880623114cb7a324c, 1539899888, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, '6205688011'),
(2, 0x05fb9539199807260d08148480958330, 1539900132, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, '6205688012'),
(3, 0xcdc79dc3f5f62c25566989b018b9165b, 1539900133, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, '6205688013'),
(4, 0x5b0cf8d32186457691fc2a66d0d020d7, 1539900973, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, '6205688030'),
(5, 0x19cc3c3ccc657df514f26351b79bac57, 1539901011, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, '6205688032');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_attachment`
--

CREATE TABLE `product_attachment` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `product_attachment_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `product_attachment_view` (
`file_id` int(11)
,`id` int(11)
,`file_uuid` binary(16)
,`added` int(11)
,`deleted` int(11)
,`size` int(11)
,`url` varchar(250)
,`name` varchar(250)
,`type` varchar(250)
,`product_files_id` int(11)
,`product_files_uuid` binary(16)
,`product_id` int(11)
,`product_uuid` binary(16)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_files`
--

CREATE TABLE `product_files` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product_files`
--

INSERT INTO `product_files` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `file_id`, `product_id`) VALUES
(1, 0x802238d11732c10b6d5880168fd5f73d, 1539889134, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 1),
(2, 0x8acb1850145014590f994dd07ba61339, 1539889135, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 2, 2),
(3, 0x3d08c7d4d978b8292b9af50a8224245c, 1539889136, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 3, 3),
(4, 0x6046232f479a8c946738af13af728f63, 1539889136, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 4, 4),
(5, 0xd6f1fa0573b5782a67afb81c70bc75f7, 1539889137, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 5, 5),
(6, 0xbcd034dabd4a029132dd7dc17f2d6331, 1539889137, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 6, 6),
(7, 0x5b84063b221a849c57b3ca962a90b250, 1539889138, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 7, 7),
(8, 0xd3b572c76694774aa36980f06d16d312, 1539889138, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 8, 7),
(9, 0x8321794caa21a7b7b42f9a92ba1ff799, 1539889139, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 9, 8),
(10, 0xa1580b80aacaa6d4ad6b6368520cf578, 1539889139, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 10, 8),
(11, 0x11d0c7a71c3d487a3c1c4c2ff52fa223, 1539889140, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 11, 9),
(12, 0x4c4690c94fbbb6c4cb5a44bc9f94d771, 1539889140, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 12, 9),
(13, 0xf3df76f63548412a1c6c041af90b9820, 1539889140, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 13, 10),
(14, 0xf2d971ada533594c739aaa0743742811, 1539889141, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 14, 11),
(15, 0x17455a9cdb09624b23585d3a44fddab2, 1539889141, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 15, 12),
(16, 0xa2879459a06a241742f5ffbbb3d26137, 1539889142, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 16, 13),
(17, 0xa3c5bacfbbd26b080b6916357d2ccdda, 1539889142, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 17, 14),
(18, 0xb7515ca9ab3b9158d8f560d90c8c5301, 1539889143, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 18, 15),
(19, 0x85332f8563a5582517dcc21af8113933, 1539889143, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, 16),
(20, 0x55b323afbd713fd7002c5b8bff447f71, 1539889144, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 20, 17),
(21, 0x0316d193784220c7c1d2b60afa953127, 1539889144, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 21, 18),
(22, 0x7c9db59c21fa4323da53cd8fabc3dadf, 1539889145, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 22, 19),
(23, 0x0688bdfc36896c0bfa320d2d61031128, 1539889145, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 23, 19);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `product_file_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `product_file_view` (
`file_id` int(11)
,`id` int(11)
,`file_uuid` binary(16)
,`added` int(11)
,`deleted` int(11)
,`size` int(11)
,`url` varchar(250)
,`name` varchar(250)
,`type` varchar(250)
,`product_files_id` int(11)
,`product_files_uuid` binary(16)
,`product_id` int(11)
,`product_uuid` binary(16)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_integration`
--

CREATE TABLE `product_integration` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `sku` varchar(250) DEFAULT NULL,
  `presta_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `product_integration`
--

INSERT INTO `product_integration` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `product_id`, `channel_id`, `sku`, `presta_id`) VALUES
(1, 0x5f789c27506c06d4369c1d45526a6348, 1539889134, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 'demo_3', '2'),
(2, 0xab71c21103cb98497392d87d27b1783c, 1539889134, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 2, 1, 'demo_6', '3'),
(3, 0x77108858d8ff13b03d8988d343769a60, 1539889135, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 3, 1, 'demo_5', '4'),
(4, 0x0994f1f0d1241060fc824ab57510396c, 1539889136, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 4, 1, 'demo_7', '5'),
(5, 0x229226f95f370255424948c38948fc05, 1539889136, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 5, 1, 'demo_11', '6'),
(6, 0x0c08fd22528bd1814c61d2c823f8790b, 1539889137, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 6, 1, 'demo_12', '7'),
(7, 0x51f3f70b58bbc10adb52197c58209298, 1539889138, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 7, 1, 'demo_15', '9'),
(8, 0x203b31bb3c56b1fc66b065a1aa372416, 1539889138, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 8, 1, 'demo_16', '10'),
(9, 0x2b27ac4db63a1caacb015a65549914b3, 1539889139, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 9, 1, 'demo_17', '11'),
(10, 0x4527995da531255ba5062fc7ac7b647d, 1539889140, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 10, 1, 'demo_18', '12'),
(11, 0xad9b8745d24333d9748262a5333382da, 1539889141, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 11, 1, 'demo_19', '13'),
(12, 0xb27f8030fb53d0c8844f7d66c1822556, 1539889141, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 12, 1, 'demo_21', '15'),
(13, 0xcb6da67a4950a54973665a1b849d88a0, 1539889142, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 13, 1, 'demo_1', '16'),
(14, 0xc325d455bb8bb3456942a2ba98804865, 1539889142, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 14, 1, 'demo_9', '17'),
(15, 0x9594a1c46b70c3bcfd7967a5bc4059f8, 1539889143, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 15, 1, 'demo_10', '18'),
(16, 0x79b863ba8414a69b11bd8416fd646985, 1539889143, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 16, 1, 'demo_13', '8'),
(17, 0xc2f979745049c7d2690150325cda75c2, 1539889144, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 17, 1, 'demo_20', '14'),
(18, 0x07f89812f3b319f2aaf933a77b7b9f1d, 1539889144, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 18, 1, 'demo_14', '19'),
(19, 0x203fc9f5f7bc3dac290016b5f359dc7f, 1539889145, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 19, 1, 'demo_1', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `session`
--

CREATE TABLE `session` (
  `sessid` binary(32) NOT NULL,
  `access` int(10) UNSIGNED DEFAULT NULL,
  `data` text,
  `ip_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `session`
--

INSERT INTO `session` (`sessid`, `access`, `data`, `ip_id`, `user_id`, `deleted`) VALUES
(0x24aaac32ad8b584a3569818dd4355735f58b9a815751713d9642fca04b98745a, 1539292617, '', 1, NULL, NULL),
(0x6aaa8162273360bbc41765b15363c68d91363f5ab62658b77031b96c563127bc, 1539292573, '', 1, NULL, NULL),
(0x79452c83dd47fb6bf593ddcccd93b263461ba96c7134899157fb1dc8ba21b5f3, 1539901986, 'userId|i:1;', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` float DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `document_product_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `stock_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `stock_view` (
`id` int(11)
,`uuid` binary(16)
,`product_id` int(11)
,`count` double
,`added_by` int(11)
,`deleted` int(11)
,`name` varchar(250)
,`sku` varchar(250)
,`net` float
,`vat` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `bank_swift` varchar(250) DEFAULT NULL,
  `issue_place` varchar(250) DEFAULT NULL,
  `bank_number` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `mail`, `password`, `address_id`, `contact_id`, `bank_name`, `bank_swift`, `issue_place`, `bank_number`) VALUES
(1, 0x83c65ff4ffdb372f5c008a9a2918827d, 1539131697, NULL, 1, 1539166858, 1, 2, NULL, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', 3, 3, 'mBank', 'MBANK', 'Elbląg', '1234567891234567891212');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_register`
--

CREATE TABLE `user_register` (
  `id` int(11) NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_ip_id` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `confirmation_code` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user_register`
--

INSERT INTO `user_register` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `mail`, `password`, `confirmation_code`) VALUES
(1, 0x4fb745caa06761f1f3129f3a8df9175f, 1539383857, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', '80addf4755c078dd7bf70da16bda1852'),
(2, 0xa5583bf6039130ffbc727f1fa70b98a3, 1539383957, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', '19caf06fb41709a91b947bc9989cf6c9'),
(3, 0x3bdb20020adc1f8239ad59832666af6a, 1539383962, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', '098f2098ba098b2493057b7afb02fba2'),
(4, 0x989c087f26735d1df5af1a011a13c7d6, 1539384476, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', '4a326a1ad2afad4642025b70d58f2667'),
(5, 0x2f18394bf3bb59c806d56501373d1ba4, 1539385659, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', '????l#+uZ??#?p?');

-- --------------------------------------------------------

--
-- Struktura widoku `cash_document_view`
--
DROP TABLE IF EXISTS `cash_document_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cash_document_view`  AS  select `cash_document`.`id` AS `id`,`cash_document`.`uuid` AS `uuid`,`cash_document`.`number` AS `number`,`cash_document`.`added_by` AS `added_by`,`cash_document`.`amount` AS `amount`,`cash_document`.`kind` AS `kind`,`cash_document`.`added` AS `added`,`cash_document`.`date` AS `date`,date_format(from_unixtime(`cash_document`.`added`),'%k:%i') AS `hour`,`document`.`name` AS `document_number`,`document`.`uuid` AS `document_id` from (`cash_document` left join `document` on((`document`.`id` = `cash_document`.`document_id`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `cash_view`
--
DROP TABLE IF EXISTS `cash_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cash_view`  AS  select sum((if((`cash_document`.`kind` = 'kp'),`cash_document`.`amount`,0) - if((`cash_document`.`kind` = 'kw'),`cash_document`.`amount`,0))) AS `ballance`,`cash_document`.`added_by` AS `added_by` from `cash_document` where (`cash_document`.`added` > coalesce((select `c`.`added` from `cash_document` `c` where ((`c`.`added_by` = `cash_document`.`added_by`) and (`c`.`kind` = 'kz')) order by `c`.`added` desc limit 1),0)) group by `cash_document`.`added_by` ;

-- --------------------------------------------------------

--
-- Struktura widoku `debtor_view`
--
DROP TABLE IF EXISTS `debtor_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `debtor_view`  AS  select `contractor`.`uuid` AS `uuid`,`contractor`.`id` AS `id`,`contractor`.`added_by` AS `added_by`,`contractor`.`deleted` AS `deleted`,coalesce(round((select sum(`document`.`to_pay`) from `document` where (`document`.`contractor_id` = `contractor`.`id`)),2),0) AS `debt`,`contractor`.`name` AS `name`,`contractor`.`code` AS `code` from `contractor` ;

-- --------------------------------------------------------

--
-- Struktura widoku `document_view`
--
DROP TABLE IF EXISTS `document_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `document_view`  AS  select `document`.`uuid` AS `uuid`,`document`.`id` AS `id`,`document`.`name` AS `name`,`document`.`date` AS `date`,`document`.`added_by` AS `added_by`,`document`.`deleted` AS `deleted`,`contractor`.`name` AS `contractor_name`,`document`.`gross` AS `gross`,`contractor`.`uuid` AS `contractor_id` from (`document` left join `contractor` on((`contractor`.`id` = `document`.`contractor_id`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `production_view`
--
DROP TABLE IF EXISTS `production_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `production_view`  AS  select `production`.`id` AS `id`,`production`.`uuid` AS `uuid`,`production`.`added_by` AS `added_by`,`production`.`name` AS `name`,round(coalesce(sum(if((`document`.`type` = 'rw'),`document`.`net`,0)),0),2) AS `buy_net`,round(coalesce(sum(if((`document`.`type` = 'pw'),`document`.`net`,0)),0),2) AS `sell_net` from ((`production` left join `production_document` on((`production_document`.`production_id` = `production`.`id`))) left join `document` on((`document`.`id` = `production_document`.`document_id`))) where (`production`.`deleted` = 0) group by `production`.`id` ;

-- --------------------------------------------------------

--
-- Struktura widoku `product_attachment_view`
--
DROP TABLE IF EXISTS `product_attachment_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_attachment_view`  AS  select `file`.`id` AS `file_id`,`product_attachment`.`id` AS `id`,`file`.`uuid` AS `file_uuid`,`file`.`added` AS `added`,`product_attachment`.`deleted` AS `deleted`,`file`.`size` AS `size`,`file`.`url` AS `url`,`file`.`name` AS `name`,`file`.`type` AS `type`,`product_attachment`.`id` AS `product_files_id`,`product_attachment`.`uuid` AS `product_files_uuid`,`product_attachment`.`product_id` AS `product_id`,`product`.`uuid` AS `product_uuid` from ((`product_attachment` left join `file` on((`file`.`id` = `product_attachment`.`file_id`))) left join `product` on((`product_attachment`.`product_id` = `product`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `product_file_view`
--
DROP TABLE IF EXISTS `product_file_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_file_view`  AS  select `file`.`id` AS `file_id`,`product_files`.`id` AS `id`,`file`.`uuid` AS `file_uuid`,`file`.`added` AS `added`,`product_files`.`deleted` AS `deleted`,`file`.`size` AS `size`,`file`.`url` AS `url`,`file`.`name` AS `name`,`file`.`type` AS `type`,`product_files`.`id` AS `product_files_id`,`product_files`.`uuid` AS `product_files_uuid`,`product_files`.`product_id` AS `product_id`,`product`.`uuid` AS `product_uuid` from ((`product_files` left join `file` on((`file`.`id` = `product_files`.`file_id`))) left join `product` on((`product_files`.`product_id` = `product`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `stock_view`
--
DROP TABLE IF EXISTS `stock_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_view`  AS  select `product`.`id` AS `id`,`product`.`uuid` AS `uuid`,`stock`.`product_id` AS `product_id`,sum(`stock`.`count`) AS `count`,`stock`.`added_by` AS `added_by`,`stock`.`deleted` AS `deleted`,`product`.`name` AS `name`,`product`.`sku` AS `sku`,`product`.`sell_net` AS `net`,`product`.`vat` AS `vat` from (`stock` left join `product` on((`product`.`id` = `stock`.`product_id`))) where (`stock`.`deleted` = 0) group by `stock`.`product_id` ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `cash_document`
--
ALTER TABLE `cash_document`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `contractor`
--
ALTER TABLE `contractor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indeksy dla tabeli `contractor_contact`
--
ALTER TABLE `contractor_contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `added_by_2` (`added_by`,`deleted`,`contractor_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `contractor_id` (`contractor_id`);

--
-- Indeksy dla tabeli `contractor_integration`
--
ALTER TABLE `contractor_integration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `presta_id` (`presta_id`(191));

--
-- Indeksy dla tabeli `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `added_by_2` (`added_by`,`deleted`,`name`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `owner_address_id` (`owner_address_id`),
  ADD KEY `contractor_address_id` (`contractor_address_id`);

--
-- Indeksy dla tabeli `document_financial`
--
ALTER TABLE `document_financial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `financial_id` (`financial_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indeksy dla tabeli `document_number`
--
ALTER TABLE `document_number`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `document_product`
--
ALTER TABLE `document_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `document_product_id` (`document_product_id`);

--
-- Indeksy dla tabeli `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `financial`
--
ALTER TABLE `financial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `integration`
--
ALTER TABLE `integration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `oauth`
--
ALTER TABLE `oauth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `integration_id` (`integration_id`);

--
-- Indeksy dla tabeli `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `number` (`number`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indeksy dla tabeli `order_integration`
--
ALTER TABLE `order_integration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `presta_id` (`presta_id`(191));

--
-- Indeksy dla tabeli `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- Indeksy dla tabeli `production_document`
--
ALTER TABLE `production_document`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `production_id` (`production_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indeksy dla tabeli `product_allegro`
--
ALTER TABLE `product_allegro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `product_attachment`
--
ALTER TABLE `product_attachment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `product_files`
--
ALTER TABLE `product_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `deleted` (`deleted`,`file_id`,`product_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `product_integration`
--
ALTER TABLE `product_integration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `presta_id` (`presta_id`(191));

--
-- Indeksy dla tabeli `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessid`),
  ADD KEY `ip_id` (`ip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `document_product_id` (`document_product_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indeksy dla tabeli `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `mail` (`mail`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `cash_document`
--
ALTER TABLE `cash_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `contractor`
--
ALTER TABLE `contractor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `contractor_contact`
--
ALTER TABLE `contractor_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `contractor_integration`
--
ALTER TABLE `contractor_integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `document_financial`
--
ALTER TABLE `document_financial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `document_number`
--
ALTER TABLE `document_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `document_product`
--
ALTER TABLE `document_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `financial`
--
ALTER TABLE `financial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `integration`
--
ALTER TABLE `integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `oauth`
--
ALTER TABLE `oauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `order_integration`
--
ALTER TABLE `order_integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `production_document`
--
ALTER TABLE `production_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product_allegro`
--
ALTER TABLE `product_allegro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `product_attachment`
--
ALTER TABLE `product_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product_files`
--
ALTER TABLE `product_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `product_integration`
--
ALTER TABLE `product_integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
