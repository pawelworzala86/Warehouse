-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 30 Wrz 2018, 11:17
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

--
-- Zrzut danych tabeli `address`
--

INSERT INTO `address` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `first_name`, `last_name`, `street`, `city`, `postcode`) VALUES
(1, 0xfdb18abb6baa5db8dfa4abcd2a822ffd, 1538281612, 1, 2, NULL, NULL, NULL, 1538298519, 1, 2, 'ACME Corp.', 'Jan', 'Kowalski', 'ul .Długa 22/6', 'Tczew', '45-743'),
(2, 0xdaa6aa4803d3802084311d5add6f80cc, 1538281650, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'ACME Corp.', 'Jan', 'Kowalski', 'ul .Długa 22/6', 'Tczew', '45-743'),
(3, 0x6f019cbbf3781fb08271590fbda34161, 1538283078, 1, 2, NULL, NULL, NULL, 1538283126, 1, 2, 'ACME', NULL, NULL, NULL, NULL, NULL),
(4, 0x2a76cc1dc2b3bb95072319ffb1d805d0, 1538283126, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'ACME Corporation', 'Paweł', 'Worzała', 'ul. Wojska polskiego 12/1', 'Elbląg', '82-300'),
(5, 0x48d8f713998664c603889aaccc9c7cf4, 1538298519, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'sdf', NULL, NULL, NULL, NULL, NULL);

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
  `nip` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `contractor`
--

INSERT INTO `contractor` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `address_id`, `code`, `contact_id`, `nip`) VALUES
(1, 0x575d4c875b25d660a01b2b877f9b1f33, 1538281613, 1, 2, 1538281665, 1, 2, 0, NULL, NULL, 'ACME Corp.', 1, 'DD-4544', NULL, NULL),
(2, 0x788cf92b0d33c51a495b6c235824db23, 1538281650, 1, 2, NULL, NULL, NULL, 1538282085, 1, 2, 'ACME Corp.', 2, 'DD-4544', NULL, NULL),
(3, 0xd4a71c0a8642f339b92f2873fd975958, 1538282230, 1, 2, NULL, NULL, NULL, 1538282235, 1, 2, 'ds', NULL, NULL, NULL, NULL),
(4, 0xf03c0c63478148b709f4828a9d35d05d, 1538297074, 1, 2, NULL, NULL, NULL, 1538297312, 1, 2, 'aaaa', NULL, 'aa', NULL, '124'),
(5, 0x1a2a3933b74acc344fd62a058ad49d13, 1538297125, 1, 2, NULL, NULL, NULL, 1538297314, 1, 2, 'aaaa', NULL, 'aa', NULL, '124'),
(6, 0xbc52067f236ddfb0060b7dadf83999db, 1538297322, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'as', NULL, 'sa', NULL, 'as'),
(7, 0x70d2c8085fd8634f403c3b672531df4b, 1538297513, 1, 2, 1538297823, 1, 2, 1538298842, 1, 2, 'hh', NULL, 'hh', NULL, 'hhh'),
(8, 0xd81f7022b0abc43881866b5d820041fc, 1538297833, 1, 2, 1538297833, 1, 2, 0, NULL, NULL, 'dfg', NULL, 'g', NULL, 'dfg'),
(9, 0x57058501c2baac3481245a571063fc54, 1538298512, 1, 2, 1538298519, 1, 2, 0, NULL, NULL, 'sdf', 5, 'sdf', NULL, 'sdf');

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

--
-- Zrzut danych tabeli `contractor_contact`
--

INSERT INTO `contractor_contact` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `phone`, `fax`, `mail`, `www`, `contractor_id`) VALUES
(1, 0x2b2319d21702f64a80d38b34a489af55, 1538281650, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, '555-666-999', '999-999-999', 'test@test.pl', 'test.pl', 2),
(2, 0x14a746a1f687d4bcfdc2a9d8b0019884, 1538283127, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, '255-554-555', '45-456-45-45', 'worzala86@gmail.com', 'worzala.pl', NULL);

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
  `to_pay` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `document`
--

INSERT INTO `document` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `contractor_id`, `date`, `description`, `net`, `gross`, `tax`, `pay_date`, `payment`, `bank_name`, `swift`, `bank_number`, `issue_place`, `delivery_date`, `payed`, `to_pay`) VALUES
(1, 0x9a196945c45bbafbf9274d887c10ccd9, 1538281781, 1, 2, 1538286886, 1, 2, 0, NULL, NULL, 'FV/234/2018', 1, '2018-09-30', 'opis ble ble', 48.76, 59.97, 11.21, '2018-09-30', 'money', 'mBank', NULL, '88888888888888888888', 'Gdynia', '2018-09-30', 57, 2.97),
(2, 0x459aa2b48696329a82033d74dc5fd437, 1538282502, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'FV/33/2018', 1, '2018-09-30', NULL, 24.38, 29.99, 5.61, '2018-09-30', 'money', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0x45c9349d3b2a8acd171cc553331b05d2, 1538282981, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'FV/34/2018', 1, '2018-09-30', NULL, 97.52, 119.95, 22.43, '2018-09-30', 'money', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 0x693ada8759f0396607ab466d3c81b184, 1538291913, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'FV/4546/2018', 1, '2018-09-30', NULL, 60.41, 72.27, 11.86, '2018-09-30', 'money', NULL, NULL, NULL, 'Tczew', '2018-09-30', 29.99, 0);

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
  `vat` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `document_product`
--

INSERT INTO `document_product` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `document_id`, `product_id`, `count`, `net`, `sum_net`, `sum_gross`, `vat`) VALUES
(1, 0x3c67b18af15f6080c8f181b07a383b39, 1538281781, 1, 2, 1538286886, 1, 2, 0, NULL, NULL, 1, 1, 2, 24.38, 48.76, 59.97, 23),
(2, 0x2f90bd497745abab96b2891807f79c0c, 1538282502, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 2, 1, 1, 24.38, 24.38, 29.99, 23),
(3, 0xd1d3a3098662c1a3733d36bf34b522b9, 1538282981, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 3, 1, 4, 24.38, 97.52, 119.95, 23),
(4, 0xca8c3f1c631ac95a34a700c98b267f40, 1538291913, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 4, 1, 1, 24.38, 24.38, 29.99, 23),
(5, 0x2ffa85b0ff0027266dd90d144030cd30, 1538291913, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 4, 3, 5, 2, 11.65, 14.33, 23),
(6, 0x79527651359f599f041086a14111468d, 1538291913, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 4, 1, 1, 24.38, 24.38, 29.99, 23);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `document_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `document_view` (
`id` binary(16)
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
(1, 0x489fad5184727223a273443016a0892b, 1538281550, 1, 2, 0, NULL, NULL, 407306, '/Files/489fad5184727223a273443016a0892b', 'sennheiser-hd25_1.png', 'image/png'),
(2, 0x0b3223b52b4d0dbf12580782dbc7d39f, 1538295347, 1, 2, 0, NULL, NULL, 618875, '/Files/0b3223b52b4d0dbf12580782dbc7d39f', 'klipsch-kg300_1.png', 'image/png'),
(3, 0xdb5f441c8b4c68b3f651d41583a3a5dc, 1538295350, 1, 2, 0, NULL, NULL, 219020, '/Files/db5f441c8b4c68b3f651d41583a3a5dc', 'encore-rockmaster-live.png', 'image/png'),
(4, 0xf1879b3b03662c42f29c8af1f9f04b30, 1538296512, 1, 2, 0, NULL, NULL, 6311, '/Files/f1879b3b03662c42f29c8af1f9f04b30.xlsx', 'files.xlsx', 'application/vnd.ms-excel');

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
(1, 1, NULL, 1538281370),
(2, 1, 1, 1538299047);

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
(1, 0x39dd036dc03276a867f942f2aff9d4c9, 1538281444, 1, 2, 1538281545, 1, 2, 0, NULL, NULL, 'Słuchawki douszne bardzo wygodne', NULL, NULL, 'FF-A1-GZZ', 1, NULL, 24.38, 29.99, '23'),
(2, 0x8a22d87f1b7700849d643d76f7757cf7, 1538282098, 1, 2, NULL, NULL, NULL, 1538282217, 1, 2, 'ss', NULL, NULL, 'ss', 1, NULL, 3, 3.69, '23'),
(3, 0x04fc599dfb87f2215bf4bd0dc815a490, 1538291835, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'Małe słuchaweczki', NULL, NULL, 'GG-6-TTY', 1, NULL, 12, 15.44, '23');

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
(1, 0x2a81322c1f1bbfd12d4ada3447243d6d, 1538281550, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 1),
(2, 0x22a0a9202901cb8611cd7cad014cf035, 1538295347, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 2, 3),
(3, 0xba55278c34f35f1ddca43431cc882ca4, 1538295350, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 3, 3);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `product_file_view`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `product_file_view` (
`file_id` int(11)
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
-- Struktura tabeli dla tabeli `root_todo`
--

CREATE TABLE `root_todo` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `done` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `root_todo`
--

INSERT INTO `root_todo` (`id`, `name`, `description`, `done`) VALUES
(6, 'GetCatalogCategories', 'Dodanie metody w API', 1),
(7, 'lista kategori w frontendzie', '', 1),
(8, 'dodawanie nowej kategori w frontendzie', '', 1),
(9, 'typy danych - validacja', 'Dodanie walidacji pól takich jak mail', 0),
(10, 'usuniecie śmieci z api', 'usuniecie pozostałości po testach z api', 1),
(11, 'CreateCatalogCategory', 'Dodanie na froncie obsługi', 1),
(13, 'Zmiana grafiki w Doc', '', 1),
(14, 'Zmiana grafiki w Test', '', 1),
(15, 'Zrobienie kolekcji i usuniecie pozostałości po iteratorze w modelu', '', 1),
(16, 'usuniecie kontrollerów i przeniesienie ich funkcji do handlerów', '', 1),
(17, 'usuwanie kategorii', '', 1),
(18, 'edycja kategorii', '', 1),
(19, 'tree view w kategoriach', '', 1),
(20, 'zapis struktury katalogu i kolejności elementów', '', 1),
(21, 'useId w clasie statycznej jest nulem', 'Prawdopodobnie trzeba będzie przerobic sesję o odczyt userId z bazy albo coś', 1),
(22, 'SESSION-ID', 'stworzenie metody która będzie zwracała id sessji i usuwała sessię z bazy danych', 1),
(23, 'CURL - TESTY', 'dodanie obsługi SESSION-ID', 1),
(24, 'dodkończenie rejestracji nowego konta - mailing', '', 1),
(25, 'SessionCreate', '', 1),
(26, 'SessionDelete', '', 1),
(27, 'poprawienie zapisu kategorii o ustawianie lp', '', 1),
(28, 'dodanie rodziców dla kategorii w katalogu', '', 1),
(29, 'dodanie ładowania drzewka kategori - rekurencja', '', 1),
(30, 'dodanie edycji kategorii', '', 1),
(31, 'dodanie usuwania kategorii', '', 1),
(32, 'poprawienie requestu że jak zmienna ma wartość domyślną null to jej nie wymaga', '', 1),
(33, 'mass update lp w modelu kategorii', '', 1),
(34, 'naprawienie sesji', '', 1),
(35, 'naprawa okienek modalnych', '', 1),
(36, 'dodać w testach api - wyświetlanie nowych niezaimplementowanych itd', '', 1),
(37, 'testy - linkowanie zmiennych miedzy zakładkami w testach', 'Zapisanie zmiennych na dysku - aby linkowało automatycznie i żeby można było układać testy', 1),
(38, 'testy - poprawienie grafiki testów', '', 1),
(39, 'ulepszenie grafiki strony zalogowanego użytkownika', '', 0),
(40, 'testy - sprawdzanie pól w responsie ', '', 0),
(41, 'testy - przemyśleć kontrolę wersji', '', 0),
(42, 'przerobienie modelu aby nie był kolekcją jednocześnie', '', 1),
(43, 'zmiana grafiki katalogu', '', 1),
(44, 'zmiana nazwy listy categori na bardziej przejrzystą', '', 1),
(45, 'dodanie do testów loremipsum - autorskiego', '', 1),
(46, 'testy - linkowanie trzeba dać o zagłębianie się do kolejnych elementów', '', 0),
(47, 'zmiana category_id na parent_id w bazie i modelach', '', 0),
(48, 'naprawienei usuwania w modelu i w kategoriach', '', 0),
(49, 'usuwanie podkategorii razem z kategorią główną', '', 0),
(50, 'testy - dodanie hooka systemowego', '', 0),
(51, 'testy - usuwanie linku', '', 0),
(52, 'produkty - dodawanie', 'dodawanie produktów zawieracjących pola: nazwa, opis, sku', 0),
(53, 'TODO - przepisać na jquery ajax', '', 0),
(54, 'dodanie FPDF', '', 0),
(55, 'przygotowanie faktury i testu', '', 0),
(56, 'dodanie do handlerów wymaganego zalogowania lub nie', '', 0),
(57, 'Testy - po wysłaniu posta i utworzeniu wpisu zasetować od nowa wartości dla nastepnego posta', '', 0),
(58, 'Przygotowanie do translacji - adresy URL, ewentualne Napisy', '', 0),
(59, 'request - wymagane pole a null w posicie', '', 0),
(60, 'dodanie ładowania commons dla zalogowanego użytkownika', 'commons w rootScope - stawki VAT, kraje itd', 0),
(61, 'przerobienie tabel na dyrektywy', '', 0),
(62, 'ujednolicenie PUT i POST - w handlerach', '', 0),
(63, 'dodanie paginacji', '', 0),
(64, 'dodanie filtórw', '', 0),
(65, 'dodanie sortowania', '', 0),
(66, 'zrobić porządek z nazwami - liczby mnogie itp', '', 0),
(67, 'ogolne zmienne - dodanie filtrów - rodzajów do ładowania na start systemu', '', 0),
(68, 'dodanie VALIDACJI pól na froncie', '', 1),
(69, 'uzupełmnienie validationTrait o lepsze komunikaty i spięcie tego z frontem', '', 1),
(70, 'rozwiązać - wspólna metoda GET w Request, Response i Type', '', 0),
(71, 'dodać zapis filtrów we froncie', '', 0),
(72, 'dodanie uploadu plików w api', '', 1),
(73, 'dodanie widoku na pliki użytkownika', '', 1),
(74, 'powiązanie zdjęć z produktem i wyświetlanie tego', '', 1);

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
(0x79452c83dd47fb6bf593ddcccd93b263461ba96c7134899157fb1dc8ba21b5f3, 1538299047, 'userId|i:1;', 2, 1, NULL);

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
  `document_product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `stock`
--

INSERT INTO `stock` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `product_id`, `count`, `document_id`, `document_product_id`) VALUES
(1, 0x4835f20cf107318841bdd7a341572b07, 1538281781, 1, 2, 1538286886, 1, 2, 0, NULL, NULL, 1, 2, 1, 1),
(2, 0x648d3ddd86fa8c69db68927507dc3c05, 1538282502, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 2, 2),
(3, 0xd2ca9d1766f2d5f7c84ada93d06c51d3, 1538282982, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 4, 3, 3),
(4, 0x389cb8d86d000207d4860848b57d77cc, 1538291913, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 4, 4),
(5, 0x2fb27d8c0837d606b83f88aaa24cac5f, 1538291913, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 3, 5, 4, 5),
(6, 0xffda0b36d2bb8302693d538a5b568985, 1538291914, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 4, 6);

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
  `contact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `mail`, `password`, `address_id`, `contact_id`) VALUES
(1, 0x05867f4d98570fd6716b73dc00976b21, 1523047519, NULL, 1, 1538283127, 1, 2, NULL, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', 4, 2);

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

-- --------------------------------------------------------

--
-- Struktura widoku `document_view`
--
DROP TABLE IF EXISTS `document_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `document_view`  AS  select `document`.`uuid` AS `id`,`document`.`name` AS `name`,`document`.`date` AS `date`,`document`.`added_by` AS `added_by`,`document`.`deleted` AS `deleted`,`contractor`.`name` AS `contractor_name`,`document`.`gross` AS `gross`,`contractor`.`uuid` AS `contractor_id` from (`document` left join `contractor` on((`contractor`.`id` = `document`.`contractor_id`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `product_file_view`
--
DROP TABLE IF EXISTS `product_file_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_file_view`  AS  select `file`.`id` AS `file_id`,`file`.`uuid` AS `file_uuid`,`file`.`added` AS `added`,`product_files`.`deleted` AS `deleted`,`file`.`size` AS `size`,`file`.`url` AS `url`,`file`.`name` AS `name`,`file`.`type` AS `type`,`product_files`.`id` AS `product_files_id`,`product_files`.`uuid` AS `product_files_uuid`,`product_files`.`product_id` AS `product_id`,`product`.`uuid` AS `product_uuid` from ((`file` left join `product_files` on((`file`.`id` = `product_files`.`file_id`))) left join `product` on((`product_files`.`product_id` = `product`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktura widoku `stock_view`
--
DROP TABLE IF EXISTS `stock_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_view`  AS  select `product`.`id` AS `id`,`product`.`uuid` AS `uuid`,`stock`.`product_id` AS `product_id`,sum(`stock`.`count`) AS `count`,`stock`.`added_by` AS `added_by`,`stock`.`deleted` AS `deleted`,`product`.`name` AS `name`,`product`.`sku` AS `sku`,`product`.`sell_net` AS `net`,`product`.`vat` AS `vat` from (`stock` left join `product` on((`product`.`id` = `stock`.`product_id`))) group by `stock`.`product_id` ;

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
  ADD KEY `contractor_id` (`contractor_id`);

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
  ADD KEY `product_id` (`product_id`);

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
-- Indeksy dla tabeli `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `added_by_2` (`added_by`,`deleted`,`sku`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_ip_id` (`added_ip_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `updated_ip_id` (`updated_ip_id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

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
-- Indeksy dla tabeli `root_todo`
--
ALTER TABLE `root_todo`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `document_product_id` (`document_product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `contractor`
--
ALTER TABLE `contractor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `contractor_contact`
--
ALTER TABLE `contractor_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `document_product`
--
ALTER TABLE `document_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `product_files`
--
ALTER TABLE `product_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `root_todo`
--
ALTER TABLE `root_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT dla tabeli `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
