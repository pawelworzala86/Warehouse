-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 29 Wrz 2018, 00:18
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
(1, 0x3d2affcc61a58cd37bbaabf38884b2c3, 1538170083, 1, 2, NULL, NULL, NULL, 573404, '/Files/3d2affcc61a58cd37bbaabf38884b2c3', 'speedlink-scylla-2.png', 'image/png'),
(2, 0xc8222dd3c62062b8a214cdfd92bf3548, 1538172100, 1, 2, NULL, NULL, NULL, 0, '/Files/c8222dd3c62062b8a214cdfd92bf3548.xlsx', 'helloworld.xlsx', 'application/vnd.ms-excel'),
(3, 0x8166a2dcfbf272b987c241d2cfc32724, 1538172206, 1, 2, NULL, NULL, NULL, 0, '/Files/8166a2dcfbf272b987c241d2cfc32724.xlsx', 'helloworld.xlsx', 'application/vnd.ms-excel'),
(4, 0x1aa68f985b5a971c9a115a1b47d083da, 1538172242, 1, 2, NULL, NULL, NULL, 6283, '/Files/1aa68f985b5a971c9a115a1b47d083da.xlsx', 'helloworld.xlsx', 'application/vnd.ms-excel'),
(5, 0x1178299aa8949627bac75c86c2a6166a, 1538172251, 1, 2, NULL, NULL, NULL, 6283, '/Files/1178299aa8949627bac75c86c2a6166a.xlsx', 'helloworld.xlsx', 'application/vnd.ms-excel'),
(6, 0x0faa5b8734d6b9c9045058a51d9308d3, 1538172319, 1, 2, NULL, NULL, NULL, 6283, '/Files/0faa5b8734d6b9c9045058a51d9308d3.xlsx', 'helloworld.xlsx', 'application/vnd.ms-excel');

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
(1, 1, NULL, 1538164025),
(2, 1, 1, 1538173097);

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
  `sku` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `description_short`, `description_full`, `sku`) VALUES
(1, 0xd11f4f9ac214b0d633c140a0348cc632, 1538170079, 1, 2, NULL, NULL, NULL, 1538172647, 1, 2, 'cgfdh', NULL, NULL, 'dfhh'),
(2, 0x1936cffa8afc5c9060f22b9938079b97, 1538172387, 1, 2, NULL, NULL, NULL, 1538172647, 1, 2, 'a', NULL, NULL, 'a'),
(3, 0xb6176a33f065d042007b226c65516a93, 1538172456, 1, 2, NULL, NULL, NULL, 1538172648, 1, 2, 'a', NULL, NULL, 'a'),
(4, 0x90bf86b216c947306a0755b76d50a28c, 1538172637, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'a', NULL, NULL, 'a'),
(7, 0x4c3dc8f601afb18d01296755a67c6722, 1538173085, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'a', NULL, NULL, 'aa');

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
(1, 0x466f028c025a6ab44161b54310c09977, 1538170083, 1, 2, NULL, NULL, NULL, 1538170087, 1, 2, 1, 1);

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
(68, 'dodanie VALIDACJI pól na froncie', '', 0),
(69, 'uzupełmnienie validationTrait o lepsze komunikaty i spięcie tego z frontem', '', 0),
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
(0x79452c83dd47fb6bf593ddcccd93b263461ba96c7134899157fb1dc8ba21b5f3, 1538173097, 'userId|i:1;', 2, 1, NULL);

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
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `mail`, `password`) VALUES
(1, 0x05867f4d98570fd6716b73dc00976b21, 1523047519, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'worzala86@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79');

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
-- Struktura widoku `product_file_view`
--
DROP TABLE IF EXISTS `product_file_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_file_view`  AS  select `file`.`id` AS `file_id`,`file`.`uuid` AS `file_uuid`,`file`.`added` AS `added`,`product_files`.`deleted` AS `deleted`,`file`.`size` AS `size`,`file`.`url` AS `url`,`file`.`name` AS `name`,`file`.`type` AS `type`,`product_files`.`id` AS `product_files_id`,`product_files`.`uuid` AS `product_files_uuid`,`product_files`.`product_id` AS `product_id`,`product`.`uuid` AS `product_uuid` from ((`file` left join `product_files` on((`file`.`id` = `product_files`.`id`))) left join `product` on((`product_files`.`product_id` = `product`.`id`))) ;

--
-- Indeksy dla zrzutów tabel
--

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
  ADD KEY `deleted_ip_id` (`deleted_ip_id`);

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
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `product_files`
--
ALTER TABLE `product_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `root_todo`
--
ALTER TABLE `root_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
