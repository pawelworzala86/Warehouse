-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 04 Paź 2018, 05:20
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

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `name`, `lp`, `category_id`) VALUES
(1, 0x6f04694b52560784ca9a16064a620276, 1538582393, 1, 2, 1538582438, 1, 2, 0, NULL, NULL, 'kuku55', 1, NULL),
(2, 0x9066d0b797985d2c48738588738b2bd9, 1538582397, 1, 2, 1538582441, 1, 2, 0, NULL, NULL, 'test', 2, NULL),
(3, 0x964a66bb821c18d2aa4cc632b741c574, 1538603388, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'fsdf', 1, NULL),
(4, 0x4747f995a03bfc84287494c788b6b857, 1538604944, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'gf', 1, NULL),
(5, 0xdcada3ff503a016c852f93b29f02da12, 1538605281, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'jghjghj676767', 1, NULL),
(6, 0x6321b79d6a9127494dcb601bb872cfc9, 1538605338, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, '999', 1, NULL),
(7, 0x41921a37f89c589629f3b0b66b1b6b54, 1538605342, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, '999', 1, NULL),
(8, 0x6f5f06fd76d66f1c8d334f07c8b2a238, 1538605367, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, '666', 1, NULL),
(9, 0x15d5a9cda3bdb4924c4db5f5f0444057, 1538605375, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'hh', 1, NULL),
(10, 0xcff2b9da6c2bb5001710195d7bc7b623, 1538605381, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'hh', 1, NULL),
(11, 0x73b4b39f940438f858f031a253a60d01, 1538606700, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'gdfg777', 1, NULL),
(12, 0x5d3630b36db26258115a12cc4a90b6fa, 1538606761, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'op', 1, NULL),
(13, 0x76757c6a0f17d9a0d4b14dca9709b3a7, 1538606835, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'ghj', 1, NULL),
(14, 0x470dcb7279b04f7a27d4a4395d15d1dd, 1538606858, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, 'gdfg', 1, NULL),
(15, 0xb6719c3b18b17c9add47a9d21c9a80c6, 1538606953, 1, 2, NULL, NULL, NULL, 0, NULL, NULL, '999', 1, NULL);

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
  `name_from` varchar(250) DEFAULT NULL
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
(1, 0x489fad5184727223a273443016a0892b, 1538281550, 1, 2, 1538611399, 1, 2, 407306, '/Files/489fad5184727223a273443016a0892b', 'sennheiser-hd25_1.png', 'image/png'),
(2, 0x0b3223b52b4d0dbf12580782dbc7d39f, 1538295347, 1, 2, 1538611399, 1, 2, 618875, '/Files/0b3223b52b4d0dbf12580782dbc7d39f', 'klipsch-kg300_1.png', 'image/png'),
(3, 0xdb5f441c8b4c68b3f651d41583a3a5dc, 1538295350, 1, 2, 1538611399, 1, 2, 219020, '/Files/db5f441c8b4c68b3f651d41583a3a5dc', 'encore-rockmaster-live.png', 'image/png'),
(4, 0xf1879b3b03662c42f29c8af1f9f04b30, 1538296512, 1, 2, 1538611399, 1, 2, 6311, '/Files/f1879b3b03662c42f29c8af1f9f04b30.xlsx', 'files.xlsx', 'application/vnd.ms-excel'),
(5, 0x33f8f2dfcd03311969123a935a347f0f, 1538582514, 1, 2, 1538611399, 1, 2, 355723, '/Files/33f8f2dfcd03311969123a935a347f0f', 'SLUCHAWKIBEZPRZEWODOWEAHEADKREAFUNK11.png', 'image/png'),
(6, 0x600551cda41220abd656a4901042889f, 1538582522, 1, 2, 1538611399, 1, 2, 407306, '/Files/600551cda41220abd656a4901042889f', 'sennheiser-hd25_1.png', 'image/png'),
(7, 0x4d6f13c2bc71f248d5d8a574c72c34fb, 1538611539, 1, 2, 0, NULL, NULL, 6346, '/Files/72603f6f9379bf95bcb5db20850d4539.xlsx', 'products.xlsx', 'application/vnd.ms-excel'),
(8, 0xd317fd5fb31980c4878694350db18d6b, 1538612028, 1, 2, 0, NULL, NULL, 6376, '/Files/4893708bd631b00981f5ff2588104422.xlsx', 'documents.xlsx', 'application/vnd.ms-excel'),
(9, 0xd1cf0d1af3770dd265f2ba8a4ccc4017, 1538612098, 1, 2, 0, NULL, NULL, 6377, '/Files/6324ba6b91b729d33277d16b10f7df2a.xlsx', 'documents.xlsx', 'application/vnd.ms-excel'),
(10, 0x9b9152bf7d0bd1fb1d134d31514f0a24, 1538612254, 1, 2, 0, NULL, NULL, 6314, '/Files/6766f0aa31b47849c34f17925c8c96af.xlsx', 'contractors.xlsx', 'application/vnd.ms-excel'),
(11, 0x374f1c411f4a20f6a69c901b61b0109d, 1538612499, 1, 2, 0, NULL, NULL, 6313, '/Files/44712a693f3ad42586afd2f690118919.xlsx', 'stocks.xlsx', 'application/vnd.ms-excel'),
(12, 0xad2a6833286b4125533916548b7175aa, 1538612531, 1, 2, 0, NULL, NULL, 6396, '/Files/9ccfc6d08804c7b62d607da07838b2d0.xlsx', 'stocks.xlsx', 'application/vnd.ms-excel'),
(13, 0xdff54d294335516873518662dc6bcb2f, 1538612667, 1, 2, 0, NULL, NULL, 6480, '/Files/dff54d294335516873518662dc6bcb2f.xlsx', 'files.xlsx', 'application/vnd.ms-excel'),
(14, 0xc9a6f9f1c566f055bd3cbd2460b41c43, 1538613052, 1, 2, 0, NULL, NULL, 0, '/Files/03cf50d623230aa15b95c583b7a8c1b6.pdf', 'products.pdf', 'application/pdf'),
(15, 0xd43dd8c455f58f2c1b5cf522557c0c9a, 1538613737, 1, 2, 0, NULL, NULL, 0, '/Files/91b28275c08632aa0cc126421d73b138.pdf', 'products.pdf', 'application/pdf'),
(16, 0x98b1759017ff0cca0bb371d91da713fc, 1538613748, 1, 2, 0, NULL, NULL, 0, '/Files/37532d6ca7f285585995f8202a27392a.pdf', 'products.pdf', 'application/pdf'),
(17, 0x06807db2c97319033bb79f1cca62ab11, 1538613789, 1, 2, 0, NULL, NULL, 0, '/Files/2682942700110c682192235fc5b86614.pdf', 'products.pdf', 'application/pdf'),
(18, 0x5a29179a19f897c9fa1780b47ac144db, 1538613807, 1, 2, 0, NULL, NULL, 20569, '/Files/ad9843b6b83033f74a72cb053bc94d16.pdf', 'products.pdf', 'application/pdf'),
(19, 0x74df295b773b7f3226f9aacb9ac04682, 1538613892, 1, 2, 0, NULL, NULL, 20473, '/Files/4d6c7c7572a0c4a73d848d1bddf15221.pdf', 'products.pdf', 'application/pdf'),
(20, 0xa7487475248b108513f815335fa35a13, 1538614285, 1, 2, 0, NULL, NULL, 20518, '/Files/91d996da0146bb403f52fa75660f6556.pdf', 'documents.pdf', 'application/pdf'),
(21, 0x7f90affd5d30625dd27c76d2db1abdd4, 1538614426, 1, 2, 0, NULL, NULL, 20395, '/Files/3fb80a0292ab5fa7a317bb1b7713008c.pdf', 'contractors.pdf', 'application/pdf'),
(22, 0x8c4f2a501f7619db6cb95246215acbf0, 1538614472, 1, 2, 0, NULL, NULL, 20395, '/Files/fb55cb483217263790b96dc668a98230.pdf', 'contractors.pdf', 'application/pdf'),
(23, 0xb2a8025a78b39f747dccc9b2f37759b4, 1538614488, 1, 2, 0, NULL, NULL, 20395, '/Files/d7459a4c4f1fb623a2a7b07c8f57f338.pdf', 'contractors.pdf', 'application/pdf'),
(24, 0x7437c2d67a6df03db6bff148b4882769, 1538614541, 1, 2, 0, NULL, NULL, 20429, '/Files/c3885a318f77fab5b894f7bc08c0f165.pdf', 'contractors.pdf', 'application/pdf'),
(25, 0xf1cf33dbabd501bd0901add5335983f8, 1538614683, 1, 2, 0, NULL, NULL, 20527, '/Files/c6f240b07857c4339a844d894d57cdc3.pdf', 'contractors.pdf', 'application/pdf'),
(26, 0x6138c007dd431711f22779ba8ab37d8c, 1538614714, 1, 2, 0, NULL, NULL, 20429, '/Files/07dc1573db269c2b4529d5b7815295b3.pdf', 'contractors.pdf', 'application/pdf'),
(27, 0x07ab90b38fa38c303b58c029b314216c, 1538614718, 1, 2, 0, NULL, NULL, 20518, '/Files/d952445399652960033d98f03854f04c.pdf', 'documents.pdf', 'application/pdf'),
(28, 0xbc365ab4906490c41a68bcf3a7805485, 1538614722, 1, 2, 0, NULL, NULL, 20527, '/Files/2db5c8bf9259ba189aa32278cac13265.pdf', 'stocks.pdf', 'application/pdf'),
(29, 0xd3db94fc3981393d3da4c9238814d841, 1538614905, 1, 2, 0, NULL, NULL, 21077, '/Files/04df0a0b3c1a7744a517d13c39cf707c.pdf', 'files.pdf', 'application/pdf'),
(30, 0x257823414ff2cb12dcb59316c4a46893, 1538614966, 1, 2, 0, NULL, NULL, 20527, '/Files/b8cd355d973c2da793c85b947a963dc1.pdf', 'files.pdf', 'application/pdf'),
(31, 0xdf3b2d86c23aba5b78f8f8f759c0c037, 1538617341, 1, 2, 0, NULL, NULL, 573404, '/Files/df3b2d86c23aba5b78f8f8f759c0c037', 'speedlink-scylla-2.png', 'image/png'),
(32, 0xa35d81cf39cd148dc6a725a58aa9b237, 1538617475, 1, 2, 0, NULL, NULL, 573404, '/Files/a35d81cf39cd148dc6a725a58aa9b237', 'speedlink-scylla-2.png', 'image/png'),
(33, 0x4f311d953afb44f87a1f59879f7d7c53, 1538618277, 1, 2, 0, NULL, NULL, 425143, '/Files/4f311d953afb44f87a1f59879f7d7c53', 'Philips_Sluchawki_nauszne_Bluetooth_Philips_SHB4405BK00_59604173_0_1000_1000.png', 'image/png'),
(34, 0x6b06d84203d2c808d1142cd1d629a87d, 1538618451, 1, 2, 0, NULL, NULL, 618875, '/Files/6b06d84203d2c808d1142cd1d629a87d', 'klipsch-kg300_1.png', 'image/png'),
(35, 0x8c1795822a26819bbbbbbcd6331dc2f8, 1538618460, 1, 2, 0, NULL, NULL, 618875, '/Files/8c1795822a26819bbbbbbcd6331dc2f8', 'klipsch-kg300_1.png', 'image/png'),
(36, 0x244fc6db5f788a1785879876c0046f36, 1538618539, 1, 2, 0, NULL, NULL, 219020, '/Files/244fc6db5f788a1785879876c0046f36', 'encore-rockmaster-live.png', 'image/png'),
(37, 0x2d9f7f1315d20d552d0fafbba24b4b37, 1538618620, 1, 2, 0, NULL, NULL, 341913, '/Files/2d9f7f1315d20d552d0fafbba24b4b37', 'aeec585c44853ed74cd056f4483e8654.png', 'image/png'),
(38, 0xc14c59919802f388a7338124416bd088, 1538618678, 1, 2, 0, NULL, NULL, 618875, '/Files/c14c59919802f388a7338124416bd088', 'klipsch-kg300_1.png', 'image/png'),
(39, 0x9f0d75d7db978f9c283c35764dc5d055, 1538619923, 1, 2, 0, NULL, NULL, 407306, '/Files/9f0d75d7db978f9c283c35764dc5d055', 'sennheiser-hd25_1.png', 'image/png'),
(40, 0x011c897fff60bb8bc02462d90563369a, 1538619926, 1, 2, 0, NULL, NULL, 256878, '/Files/011c897fff60bb8bc02462d90563369a', 'i_bose_quietcomfort__leTtu.png', 'image/png'),
(41, 0x37b541ff4f2340fb00aa657db0c8f307, 1538620026, 1, 2, 0, NULL, NULL, 407306, '/Files/37b541ff4f2340fb00aa657db0c8f307', 'sennheiser-hd25_1.png', 'image/png'),
(42, 0x258f4540337499fdbcaa878f5b4d5db3, 1538620028, 1, 2, 0, NULL, NULL, 219020, '/Files/258f4540337499fdbcaa878f5b4d5db3', 'encore-rockmaster-live.png', 'image/png'),
(43, 0x8a823652b707a6c16a14c67d9100a7a4, 1538620102, 1, 2, 0, NULL, NULL, 618875, '/Files/8a823652b707a6c16a14c67d9100a7a4', 'klipsch-kg300_1.png', 'image/png'),
(44, 0xb75ba01d9884613b68c1c34559058520, 1538620241, 1, 2, 0, NULL, NULL, 407306, '/Files/b75ba01d9884613b68c1c34559058520', 'sennheiser-hd25_1.png', 'image/png'),
(45, 0x206af4b1c7b4b71ffda2992b175713dc, 1538621044, 1, 2, 0, NULL, NULL, 476956, '/Files/206af4b1c7b4b71ffda2992b175713dc', 'Focus100_black_1_e4d2e6d6.png', 'image/png'),
(46, 0xd1ccc5507d1027b9bd9476dc162850f1, 1538622370, 1, 2, 0, NULL, NULL, 425143, '/Files/d1ccc5507d1027b9bd9476dc162850f1', 'Philips_Sluchawki_nauszne_Bluetooth_Philips_SHB4405BK00_59604173_0_1000_1000.png', 'image/png'),
(47, 0x79b9194600858087f976542c16b71895, 1538622373, 1, 2, 0, NULL, NULL, 256878, '/Files/79b9194600858087f976542c16b71895', 'i_bose_quietcomfort__leTtu.png', 'image/png'),
(48, 0x2995b1af8df665347004d1833a2942a0, 1538622376, 1, 2, 0, NULL, NULL, 596123, '/Files/2995b1af8df665347004d1833a2942a0', 'eleoskep_pl_sluchawki_bezprzewodowe_bluetooth_LED_14.png', 'image/png');

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
(2, 1, 1, 1538623186);

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
(0x79452c83dd47fb6bf593ddcccd93b263461ba96c7134899157fb1dc8ba21b5f3, 1538623186, 'userId|i:1;', 2, 1, NULL);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `document_view`  AS  select `document`.`uuid` AS `uuid`,`document`.`id` AS `id`,`document`.`name` AS `name`,`document`.`date` AS `date`,`document`.`added_by` AS `added_by`,`document`.`deleted` AS `deleted`,`contractor`.`name` AS `contractor_name`,`document`.`gross` AS `gross`,`contractor`.`uuid` AS `contractor_id` from (`document` left join `contractor` on((`contractor`.`id` = `document`.`contractor_id`))) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT dla tabeli `document`
--
ALTER TABLE `document`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT dla tabeli `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product_attachment`
--
ALTER TABLE `product_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product_files`
--
ALTER TABLE `product_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `root_todo`
--
ALTER TABLE `root_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
