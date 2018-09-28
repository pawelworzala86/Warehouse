-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2018, 14:49
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.3

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
  `deleted` int(11) DEFAULT NULL,
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
(1, 0x856805b70397462aa84fd3080518f193, 1523047553, 1, 2, 1523633597, 1, 2, 1523916810, 1, 2, 'test XXX', 5, NULL),
(2, 0xa82d1768df4939107d401fc049257a85, 1523047557, 1, 2, 1523120629, 1, 2, 1523172457, 1, 2, 'test 22', 18, 9),
(3, 0xc3af38f002d60c6a7bffa057a0478afb, 1523047562, 1, 2, 1523633593, 1, 2, 1523916784, 1, 2, 'kuku', 1, NULL),
(4, 0xfaadcbc5f09b2d11c447234d19f189b0, 1523049855, 1, 2, 1523085225, 1, 2, NULL, NULL, NULL, 'test kategori 1', 7, NULL),
(5, 0xcf330d046b8b2b3a241b3f5f9b64845d, 1523049860, 1, 2, 1523172317, 1, 2, NULL, NULL, NULL, 'test kategori 2', 6, NULL),
(6, 0x227889dc052afa210898c663d8a5328b, 1523049863, 1, 2, 1523543654, 1, 2, NULL, NULL, NULL, 'test kategori 3435', 0, 1),
(7, 0xc290f1d82623f17ad4da05b971145853, 1523049867, 1, 2, 1523168169, 1, 2, NULL, NULL, NULL, 'test kategori 4', -1, 11),
(8, 0x0d5263397daf1866f6824c4669c9f297, 1523054958, 1, 2, 1523120257, 1, 2, 1523168154, 1, 2, 'test podkategori 111', 18, 13),
(9, 0x253b7bd396adb7d211bb9453720329f8, 1523055107, 1, 2, 1523121117, 1, 2, 1523172461, 1, 2, 'test podkategori 2', -1, 4),
(10, 0x63376237376233303361396435343063, 1523056077, 1, 2, 1523120362, 1, 2, 1523167729, 1, 2, 'test podkategori 222', 19, 13),
(11, 0x38643538666434326630376262363662, 1523056488, 1, 2, 1523121114, 1, 2, NULL, NULL, NULL, 'test podkategori 2', 8, NULL),
(12, 0x63323131366337393038623533643135, 1523057505, 1, 2, 1523120624, 1, 2, NULL, NULL, NULL, 'test podkategori 666', 18, 13),
(13, 0x39613433313763613239313037623861, 1523057541, 1, 2, 1523119986, 1, 2, 1523168159, 1, 2, 'test podkategori 999', -1, 11),
(14, 0x39363136396635393366383430363766, 1523126998, 1, 2, NULL, NULL, NULL, 1523916828, 1, 2, 'kuku8', 9, NULL),
(15, 0x00000000000000000000000000000000, 1523127823, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'kuku2', 10, NULL),
(16, 0x64616663333832323931643864643362, 1523129540, 1, 2, NULL, NULL, NULL, 1523985824, 1, 2, 'kuku2', 12, NULL),
(17, 0x35306264333836396361646364663064, 1523130130, 1, 2, NULL, NULL, NULL, 1523916841, 1, 2, 'kuku3', 13, NULL),
(18, 0xdfd0f1b944551d52d9a20d7adb92ab0c, 1523131021, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'kuku2', 14, NULL),
(19, 0x6ff1353a66cd0c2d10997b17d1c0b947, 1523163398, 1, 2, NULL, NULL, NULL, 1523985821, 1, 2, 'kuku2', 15, NULL),
(20, 0x8ddfbbd20b45924f52d20b02481d9fd7, 1523164476, 1, 2, 1523916893, 1, 2, 1523916896, 1, 2, 'kuku2 436346', 16, NULL),
(21, 0x7255f469a8497983a8a67bb031b97711, 1523170121, 1, 2, NULL, NULL, NULL, 1523916883, 1, 2, 'ffff', 17, NULL),
(22, 0x8923cb4f909ac209051b8b9369b47b5f, 1523173833, 1, 2, NULL, NULL, NULL, 1523916886, 1, 2, 'hhh', 18, NULL),
(23, 0x8fb4c6151a544d2c66cc7b603b1a78b7, 1523183367, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '12345', 19, NULL),
(24, 0x48603318352935d3204d35962b93a0f4, 1523937363, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 20, NULL),
(25, 0x89cf6aa89152a40b89f40c7a08f87c5f, 1523937376, 1, 2, NULL, NULL, NULL, 1523985818, 1, 2, 'kuku', 21, NULL),
(26, 0x0f1bd38d7bfbdf4fca941ba6bb1b7062, 1523937459, 1, 2, 1524053039, 1, 2, NULL, NULL, NULL, 'test', 8, 24),
(27, 0x0f91dcc5ab2a444dd0394860c7c8af78, 1523937476, 1, 2, 1524053033, 1, 2, NULL, NULL, NULL, 'test', 8, 24),
(28, 0xc0cfd1877d2ff8a4cdd205082f0d69c0, 1523937510, 1, 2, 1524053038, 1, 2, NULL, NULL, NULL, 'kuku', 7, 24),
(29, 0xaa8446cadf6498b5d337f30ad82b8f6a, 1523937520, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 22, NULL),
(30, 0xcc338244940b7a53b880f2a14044566c, 1523937524, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'kategoria', 23, NULL),
(31, 0xa421c3d78b15a88c7cd9389b4d5c5b6d, 1523969618, 1, 2, 1524053045, 1, 2, NULL, NULL, NULL, 'sdfsfd', 5, 30),
(32, 0x6b89387284102c2f692aba435519344a, 1523969621, 1, 2, 1524053050, 1, 2, NULL, NULL, NULL, 'sdfsdf', 6, 30),
(33, 0x7a9fb37505d5cc182d0c9f92a932fb31, 1523969623, 1, 2, 1524053089, 1, 2, NULL, NULL, NULL, 'sdfsdf', 2, NULL),
(34, 0xa1f8b5c0cb37030cd145164ab5017c41, 1523975799, 1, 2, 1524053061, 1, 2, NULL, NULL, NULL, 'gdfg 3434', 4, 33),
(35, 0x5534a66f564db4b0c301a9501994c3c2, 1523975883, 1, 2, 1524053069, 1, 2, NULL, NULL, NULL, 'gdg', 11, NULL),
(36, 0x4ad97c79dbc51030123f50bcd06f84a0, 1523982912, 1, 2, 1523982925, 1, 2, NULL, NULL, NULL, 'fsdfsdf', 1, 37),
(37, 0xa064a5c4a804c65123505daa7774cb4b, 1523982915, 1, 2, 1523983005, 1, 2, NULL, NULL, NULL, 'sdfsdf', 3, NULL),
(38, 0x9ac8b62c92f315c8328543a08fd15743, 1523982916, 1, 2, 1524053062, 1, 2, NULL, NULL, NULL, 'sdfsdf', 0, 35),
(39, 0xd6f11c3211f706531bf3d9ad909ba139, 1523982923, 1, 2, 1523982980, 1, 2, NULL, NULL, NULL, 'sdfsdf', 4, NULL),
(40, 0x4c6b4266aba53b93a555ccca8908c774, 1524023113, 1, 2, 1524053076, 1, 2, NULL, NULL, NULL, 'fsdfsf', 3, 35);

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
  `deleted` int(11) DEFAULT NULL,
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
(1, 0x81f56ff7f2772892aa80550f58769942, 1524046917, 1, 2, 1524048252, 1, 2, 19537, '/Files/81f56ff7f2772892aa80550f58769942', '1.JBL-E50BT.jpg', 'image/jpeg'),
(2, 0x111f73b4a77f8526d79cda53990841b2, 1524047285, 1, 2, 1524048252, 1, 2, 19537, '/Files/111f73b4a77f8526d79cda53990841b2', '1.JBL-E50BT.jpg', 'image/jpeg'),
(3, 0x3b0b3408fbf9d18915c17667faf1f595, 1524047689, 1, 2, 1524048569, 1, 2, 25560, '/Files/3b0b3408fbf9d18915c17667faf1f595', 'jabra_halo_fusion_1400x1400-fu-r-tabelle.jpg', 'image/jpeg'),
(4, 0x9cd3db1d711b23494b8b58982f20ac98, 1524047691, 1, 2, 1524048569, 1, 2, 25560, '/Files/9cd3db1d711b23494b8b58982f20ac98', 'jabra_halo_fusion_1400x1400-fu-r-tabelle.jpg', 'image/jpeg'),
(5, 0x03fc310c36430dd8cafcbd6a79322c95, 1524048625, 1, 2, 1524048662, 1, 2, 19537, '/Files/03fc310c36430dd8cafcbd6a79322c95', '1.JBL-E50BT.jpg', 'image/jpeg'),
(6, 0x5a9cfb0f133667641db858252241df56, 1524048625, 1, 2, 1524048662, 1, 2, 25560, '/Files/5a9cfb0f133667641db858252241df56', '1.JBL-E50BT.jpg', 'image/jpeg'),
(7, 0x928ca97d2bc8f1ab26152139b24a6232, 1524048625, 1, 2, 1524048662, 1, 2, 12066, '/Files/928ca97d2bc8f1ab26152139b24a6232', '1.JBL-E50BT.jpg', 'image/jpeg'),
(8, 0x1b7d5d7bb16abb455a5897494b386bb0, 1524048629, 1, 2, 1524048662, 1, 2, 19537, '/Files/1b7d5d7bb16abb455a5897494b386bb0', '1.JBL-E50BT.jpg', 'image/jpeg'),
(9, 0x4b07274f2951f81889c4f0d0a7c0b116, 1524048629, 1, 2, 1524048694, 1, 2, 25560, '/Files/4b07274f2951f81889c4f0d0a7c0b116', '1.JBL-E50BT.jpg', 'image/jpeg'),
(10, 0xc2a1768cc32f074190205b82db657d12, 1524048629, 1, 2, 1524048694, 1, 2, 12066, '/Files/c2a1768cc32f074190205b82db657d12', '1.JBL-E50BT.jpg', 'image/jpeg'),
(11, 0x9a3dc191304c1dd679d6fdb769543740, 1524048779, 1, 2, 1524048802, 1, 2, 19537, '/Files/9a3dc191304c1dd679d6fdb769543740', '1.JBL-E50BT.jpg', 'image/jpeg'),
(12, 0x48fcc37fc95d169b10c9d1037257a54f, 1524048779, 1, 2, 1524048802, 1, 2, 25560, '/Files/48fcc37fc95d169b10c9d1037257a54f', '1.JBL-E50BT.jpg', 'image/jpeg'),
(13, 0x2900acb64a283168c8111f135d8ffd84, 1524048779, 1, 2, 1524048968, 1, 2, 12066, '/Files/2900acb64a283168c8111f135d8ffd84', '1.JBL-E50BT.jpg', 'image/jpeg'),
(14, 0xfcd380cbc6cd4884ac1643c77b1b4b54, 1524048783, 1, 2, 1524048968, 1, 2, 19537, '/Files/fcd380cbc6cd4884ac1643c77b1b4b54', '1.JBL-E50BT.jpg', 'image/jpeg'),
(15, 0xa2b98a9359167cd209f64d4b4adda9fd, 1524048783, 1, 2, 1524049032, 1, 2, 25560, '/Files/a2b98a9359167cd209f64d4b4adda9fd', '1.JBL-E50BT.jpg', 'image/jpeg'),
(16, 0xaa973bf52a15f78106fbf0c61700307d, 1524048783, 1, 2, 1524049032, 1, 2, 12066, '/Files/aa973bf52a15f78106fbf0c61700307d', '1.JBL-E50BT.jpg', 'image/jpeg'),
(17, 0xf43824688573c8d637423d61df948a8c, 1524048788, 1, 2, 1524049335, 1, 2, 25560, '/Files/f43824688573c8d637423d61df948a8c', '1.JBL-E50BT.jpg', 'image/jpeg'),
(18, 0x767575a281f2aa73855c2d643f6b1f0d, 1524048788, 1, 2, 1524049336, 1, 2, 19537, '/Files/767575a281f2aa73855c2d643f6b1f0d', '1.JBL-E50BT.jpg', 'image/jpeg'),
(19, 0x534a6440f4a6ddab4d9adbb52260a50c, 1524048788, 1, 2, 1524049594, 1, 2, 12066, '/Files/534a6440f4a6ddab4d9adbb52260a50c', '1.JBL-E50BT.jpg', 'image/jpeg'),
(20, 0x4c4c5279536327694c2c01cb873081f6, 1524049578, 1, 2, 1524049633, 1, 2, 19537, '/Files/4c4c5279536327694c2c01cb873081f6', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(21, 0xa1cf06c1bfa6bb22b9df98acf09dbd40, 1524049578, 1, 2, 1524049881, 1, 2, 19537, '/Files/a1cf06c1bfa6bb22b9df98acf09dbd40', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(22, 0xca67f04d3bfd75692f34289afa522771, 1524049578, 1, 2, 1524049881, 1, 2, 19537, '/Files/ca67f04d3bfd75692f34289afa522771', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(23, 0xf1a7d94b5ccb38f31cdc6bb4dddc9f15, 1524049578, 1, 2, 1524049993, 1, 2, 25560, '/Files/f1a7d94b5ccb38f31cdc6bb4dddc9f15', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(24, 0xc360a8af378ff505f8b0293f265b6fa1, 1524049578, 1, 2, 1524049984, 1, 2, 19537, '/Files/c360a8af378ff505f8b0293f265b6fa1', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(25, 0x60c35411446cb8729dc5c33359d47337, 1524049578, 1, 2, 1524050157, 1, 2, 25560, '/Files/60c35411446cb8729dc5c33359d47337', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(26, 0x649678529d971d821720139cac7c6aa2, 1524049579, 1, 2, 1524050157, 1, 2, 25560, '/Files/649678529d971d821720139cac7c6aa2', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(27, 0x96bb18cf17f7b453a86f0d72f2df83af, 1524049579, 1, 2, 1524050267, 1, 2, 25560, '/Files/96bb18cf17f7b453a86f0d72f2df83af', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(28, 0xc8a16b7cab09a97930d753377fa84f65, 1524049579, 1, 2, 1524050267, 1, 2, 12066, '/Files/c8a16b7cab09a97930d753377fa84f65', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(29, 0x0b00f930f35068ca9b423c88b026dcaa, 1524049579, 1, 2, 1524050315, 1, 2, 12066, '/Files/0b00f930f35068ca9b423c88b026dcaa', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(30, 0xadc59445878728dda4a981a8f7075f34, 1524049579, 1, 2, 1524050315, 1, 2, 12066, '/Files/adc59445878728dda4a981a8f7075f34', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(31, 0xad83b117981480336b09501f2814a10c, 1524049579, 1, 2, 1524050384, 1, 2, 12066, '/Files/ad83b117981480336b09501f2814a10c', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(32, 0x6b0d15b5b6f8a3433dcf078297cf275a, 1524050436, 1, 2, 1524050444, 1, 2, 19537, '/Files/6b0d15b5b6f8a3433dcf078297cf275a', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(33, 0x057b8cdd34c724601025bc0b802884b4, 1524050436, 1, 2, 1524050444, 1, 2, 25560, '/Files/057b8cdd34c724601025bc0b802884b4', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(34, 0x6a228f503a226c71f7968371068fc47a, 1524050436, 1, 2, 1524050515, 1, 2, 19537, '/Files/6a228f503a226c71f7968371068fc47a', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(35, 0xbab51f06955dba6c2f3abfda5ad92531, 1524050436, 1, 2, 1524050515, 1, 2, 25560, '/Files/bab51f06955dba6c2f3abfda5ad92531', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(36, 0x2208292d26b186d1a02c22dd005bbca2, 1524050436, 1, 2, 1524050549, 1, 2, 19537, '/Files/2208292d26b186d1a02c22dd005bbca2', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(37, 0xb908371d8d912027d93dfd58cda56769, 1524050436, 1, 2, 1524050549, 1, 2, 19537, '/Files/b908371d8d912027d93dfd58cda56769', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(38, 0x974d83422588d9760372c2418854baa1, 1524050437, 1, 2, 1524050758, 1, 2, 25560, '/Files/974d83422588d9760372c2418854baa1', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(39, 0x4d1b9f0539529078bc3cc2bd426af7fa, 1524050437, 1, 2, 1524050758, 1, 2, 12066, '/Files/4d1b9f0539529078bc3cc2bd426af7fa', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(40, 0x224fad7615627a6311f43da2a57d7a16, 1524050437, 1, 2, 1524050872, 1, 2, 25560, '/Files/224fad7615627a6311f43da2a57d7a16', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(41, 0x22800051b62a860b5373a96d08cf8b0f, 1524050437, 1, 2, 1524050872, 1, 2, 12066, '/Files/22800051b62a860b5373a96d08cf8b0f', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(42, 0x785f260f8fc3fd35fa1f4dd439a73f07, 1524050437, 1, 2, 1524050939, 1, 2, 12066, '/Files/785f260f8fc3fd35fa1f4dd439a73f07', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(43, 0xf4b4186da8100f84594cc91250799792, 1524050437, 1, 2, 1524050939, 1, 2, 12066, '/Files/f4b4186da8100f84594cc91250799792', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(44, 0x01a0d62d6bfb9d7d4b147549d87380d9, 1524051123, 1, 2, 1524051130, 1, 2, 19537, '/Files/01a0d62d6bfb9d7d4b147549d87380d9', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(45, 0x14588094974b985553121dab51f8f5b9, 1524051123, 1, 2, 1524051148, 1, 2, 19537, '/Files/14588094974b985553121dab51f8f5b9', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(46, 0x011c5b529185fa85dd0df33f8226c764, 1524051123, 1, 2, 1524051183, 1, 2, 19537, '/Files/011c5b529185fa85dd0df33f8226c764', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(47, 0x2979c479f4dc420afb5d62fa8b602137, 1524051123, 1, 2, 1524051183, 1, 2, 19537, '/Files/2979c479f4dc420afb5d62fa8b602137', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(48, 0x51bd8f280785cb970d604973ba3aa272, 1524051123, 1, 2, 1524051242, 1, 2, 25560, '/Files/51bd8f280785cb970d604973ba3aa272', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(49, 0x111d7a8b82f68377f9ca60ba5671a90f, 1524051123, 1, 2, 1524051242, 1, 2, 25560, '/Files/111d7a8b82f68377f9ca60ba5671a90f', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(50, 0x5864353b45f5ab7b8fc7ff8a4b400d85, 1524051124, 1, 2, 1524051279, 1, 2, 25560, '/Files/5864353b45f5ab7b8fc7ff8a4b400d85', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(51, 0x2a6dc478f43460d0f07575bb3fc40fdd, 1524051124, 1, 2, 1524051279, 1, 2, 12066, '/Files/2a6dc478f43460d0f07575bb3fc40fdd', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(52, 0x9c940d3238cf64c615b297f1cca9948f, 1524051124, 1, 2, 1524051349, 1, 2, 12066, '/Files/9c940d3238cf64c615b297f1cca9948f', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(53, 0x5566100a93ca97d1768626cbcf7bd938, 1524051124, 1, 2, 1524051349, 1, 2, 25560, '/Files/5566100a93ca97d1768626cbcf7bd938', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(54, 0x4c9aad8c00860d287140f36c685595ca, 1524051124, 1, 2, 1524051440, 1, 2, 12066, '/Files/4c9aad8c00860d287140f36c685595ca', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(55, 0xa001136cd29bf28604dd6c7f54d682c2, 1524051124, 1, 2, 1524051440, 1, 2, 12066, '/Files/a001136cd29bf28604dd6c7f54d682c2', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(56, 0x634bd416cc3302bd56b905252625715f, 1524051496, 1, 2, 1524051504, 1, 2, 19537, '/Files/634bd416cc3302bd56b905252625715f', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(57, 0xf902005aa07d6dfaa8d27c4fa37b9d00, 1524051496, 1, 2, 1524051504, 1, 2, 19537, '/Files/f902005aa07d6dfaa8d27c4fa37b9d00', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(58, 0x29c815a3809b696544b2fbd2899d89b5, 1524051496, 1, 2, 1524051636, 1, 2, 19537, '/Files/29c815a3809b696544b2fbd2899d89b5', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(59, 0x4bb971292f9d8045f88516ccb8749112, 1524051496, 1, 2, 1524051636, 1, 2, 25560, '/Files/4bb971292f9d8045f88516ccb8749112', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(60, 0x0fdd547b511d5878392afa012f80653d, 1524051496, 1, 2, 1524053627, 1, 2, 25560, '/Files/0fdd547b511d5878392afa012f80653d', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(61, 0x7ba60aa5a9cff267895f05973cfd3459, 1524051496, 1, 2, 1524051715, 1, 2, 19537, '/Files/7ba60aa5a9cff267895f05973cfd3459', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(62, 0xf4078b8c1100fbd49b12863155f39376, 1524051496, 1, 2, 1524053627, 1, 2, 25560, '/Files/f4078b8c1100fbd49b12863155f39376', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(63, 0x047b225bd5f355c0f63c9a8611a2162b, 1524051496, 1, 2, 1524053645, 1, 2, 25560, '/Files/047b225bd5f355c0f63c9a8611a2162b', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(64, 0x351cfd193908c077866018035f32a5f8, 1524051496, 1, 2, NULL, NULL, NULL, 12066, '/Files/351cfd193908c077866018035f32a5f8', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(65, 0x3aa8bfc04018cda4a9120ad6953ca1dc, 1524051496, 1, 2, 1524051715, 1, 2, 12066, '/Files/3aa8bfc04018cda4a9120ad6953ca1dc', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(66, 0x97664bdbb505ff78a217036cf37a4995, 1524051496, 1, 2, NULL, NULL, NULL, 12066, '/Files/97664bdbb505ff78a217036cf37a4995', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(67, 0x374f6a479a54b50da1a0d67a10113c9d, 1524051496, 1, 2, NULL, NULL, NULL, 12066, '/Files/374f6a479a54b50da1a0d67a10113c9d', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(68, 0x91387bfa656745090502fb47b031fc5f, 1524053882, 1, 2, NULL, NULL, NULL, 19537, '/Files/91387bfa656745090502fb47b031fc5f', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(69, 0x6d8c610c089900cb88d7a28755d6458b, 1524053882, 1, 2, NULL, NULL, NULL, 25560, '/Files/6d8c610c089900cb88d7a28755d6458b', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(70, 0x49bc8960d212c62c7f9a27bccddc00c9, 1524053882, 1, 2, NULL, NULL, NULL, 12066, '/Files/49bc8960d212c62c7f9a27bccddc00c9', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(71, 0xf7f57d8f8f1114b3aba327085c4039d7, 1524055692, 1, 2, NULL, NULL, NULL, 12066, '/Files/f7f57d8f8f1114b3aba327085c4039d7', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(72, 0xbd072dbc7980a4d1b4bf5336ad9885d2, 1524055692, 1, 2, NULL, NULL, NULL, 19537, '/Files/bd072dbc7980a4d1b4bf5336ad9885d2', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg'),
(73, 0x728a9168ad4675cb201c727fcdb31609, 1524055692, 1, 2, NULL, NULL, NULL, 25560, '/Files/728a9168ad4675cb201c727fcdb31609', '1.JBL-E50BT - Kopia (2).jpg', 'image/jpeg');

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
(1, 1, NULL, 1523040323),
(2, 1, 1, 1524055693);

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
  `deleted` int(11) DEFAULT NULL,
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
(2, 0x30831b0077161645367af051624289af, 1523902821, 1, 2, 1524047186, 1, 2, 1524052321, 1, 2, 'test 1', 'gfdgdf', 'gdfg', 'sku'),
(3, 0x886fba5503007028afa6c7bc7dfb4132, 1523902834, 1, 2, NULL, NULL, NULL, 1524052266, 1, 2, 'dfg', 'dfg', 'dfg', 'gdfg'),
(4, 0x8fa972310cb78249204d0b606592fa7f, 1523908449, 1, 2, NULL, NULL, NULL, 1524052333, 1, 2, 'test', 'etstset', 'setset', 'setet'),
(5, 0x883b2d19460f735cd91d6d17053a39c7, 1523912284, 1, 2, NULL, NULL, NULL, 1523917208, 1, 2, 'afs', 'asfasf', 'asfsa', 'asfasf'),
(6, 0x90121a73a7f9a92b87696f78c993166d, 1523918113, 1, 2, 1523976121, 1, 2, 1524052192, 1, 2, 'test 222', 'gfdgdf', 'gdfg', 'sku'),
(7, 0x56cdf7cd427bb40d1f5458abccca5c8d, 1523918119, 1, 2, NULL, NULL, NULL, 1524052266, 1, 2, 'test 222', 'gfdgdf', 'gdfg', 'sku'),
(8, 0xcb19d05d6d1c730529c1c08ff3a76562, 1523918388, 1, 2, 1523918463, 1, 2, 1524052192, 1, 2, 'test 222 6', 'gfdgdf', 'gdfg', 'sku'),
(9, 0x441238a743a0d4533791c4172f68bb3f, 1523927301, 1, 2, NULL, NULL, NULL, 1524052547, 1, 2, 'dfgdfg', NULL, NULL, 'dfgdfg'),
(10, 0xabd47980037667f57f4c07b724861730, 1523927305, 1, 2, NULL, NULL, NULL, 1524052266, 1, 2, 'sdg', NULL, NULL, 'hdf'),
(11, 0xd4b3a65196aca69b5998fc287d8395c4, 1523927307, 1, 2, NULL, NULL, NULL, 1524052547, 1, 2, 'dfhdf', NULL, NULL, 'dfhdfh'),
(12, 0x7ba6149c555b8fa0b0526af15262dd53, 1523935306, 1, 2, NULL, NULL, NULL, 1524052333, 1, 2, 'gdfgdfg', NULL, NULL, 'gdfgdsku'),
(13, 0x31aacf63df4b247279924b199d1d7fbb, 1523936571, 1, 2, NULL, NULL, NULL, 1524052801, 1, 2, 'fdgdfg', NULL, NULL, 'fsdfsdfsku'),
(14, 0xa7384b19b625877767a50347f36bb5b6, 1523937546, 1, 2, NULL, NULL, NULL, 1524052801, 1, 2, 'fdsg', NULL, NULL, 'sdg'),
(15, 0x9f878887bc585b52781b8f080c9233cf, 1523937550, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'sdgsdg', NULL, NULL, 'sdgsgdsku'),
(16, 0xb944aa91a94392a20cf3d0444b7f010c, 1523937556, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'sdgsd', NULL, NULL, 'sdgsdg'),
(17, 0x8a9b5a524c951c76bc116f441681fd73, 1523972926, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'erte', NULL, NULL, 'dgd'),
(18, 0xbcbdf295ca7a7b48b055911d17166344, 1523972936, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'sdg', NULL, NULL, 'sdgsdg'),
(19, 0x45c1d62185b9d882038d135162899a26, 1523974004, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'dfg', NULL, NULL, 'dfg'),
(20, 0xa8dbbca7c2badf9822a8d0cbafc6022c, 1523974079, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'sdfsd', NULL, NULL, 'sdf'),
(21, 0x57f6506af1954798f5d324cabc0acd9d, 1523974808, 1, 2, NULL, NULL, NULL, 1524052889, 1, 2, 'sdf', NULL, NULL, 'dfgfds'),
(22, 0xf4c86203a117f51a56335313a13593bb, 1523974819, 1, 2, NULL, NULL, NULL, 1524052906, 1, 2, 'sdf', NULL, NULL, 'sdf'),
(23, 0xf98d8dd1970d0675b980372b2dd5d362, 1523974875, 1, 2, NULL, NULL, NULL, 1524052906, 1, 2, 'sss', NULL, NULL, 'sss'),
(24, 0x7b1f820236b0a7a81d6911b99ab763af, 1523982774, 1, 2, NULL, NULL, NULL, 1524052906, 1, 2, 'gdfg', NULL, NULL, 'dfg'),
(25, 0x25477dc9dcff9103f82c0bf4af5c91bb, 1523984008, 1, 2, NULL, NULL, NULL, 1524052910, 1, 2, 'gd', NULL, NULL, 'dfg'),
(26, 0x939ac904c88326449df983d154cdc8f7, 1524039000, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'dgreg', NULL, NULL, 'sdfs'),
(27, 0x0c6a4c982163cd195b7cd9c041563682, 1524046897, 1, 2, NULL, NULL, NULL, 1524053604, 1, 2, 'fggfd', NULL, NULL, 'dfhdfh');

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
  `deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_ip_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product_files`
--

INSERT INTO `product_files` (`id`, `uuid`, `added`, `added_by`, `added_ip_id`, `updated`, `updated_by`, `updated_ip_id`, `deleted`, `deleted_by`, `deleted_ip_id`, `file_id`, `product_id`) VALUES
(1, NULL, 1524044681, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 16, 2),
(2, NULL, 1524044713, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 17, 2),
(3, NULL, 1524044722, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 18, 2),
(4, NULL, 1524046443, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 19, 2),
(5, NULL, 1524046917, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2),
(6, NULL, 1524047285, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2),
(7, NULL, 1524047689, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2),
(8, NULL, 1524047691, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2),
(9, NULL, 1524048779, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 11, 2),
(10, NULL, 1524048779, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 12, 2),
(11, NULL, 1524048779, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 13, 2),
(12, NULL, 1524048783, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 14, 2),
(13, NULL, 1524048783, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 15, 2),
(14, NULL, 1524048783, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 16, 2),
(15, NULL, 1524048788, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 17, 2),
(16, NULL, 1524048788, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 18, 2),
(17, NULL, 1524048788, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 19, 2),
(18, NULL, 1524053882, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 68, 26),
(19, NULL, 1524053882, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 69, 26),
(20, NULL, 1524053882, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 70, 26);

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
(72, 'dodanie uploadu plików w api', '', 0),
(73, 'dodanie widoku na pliki użytkownika', '', 0),
(74, 'powiązanie zdjęć z produktem i wyświetlanie tego', '', 0);

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
(0x3471a333f572f6bbd1840dc7fca08ad5c421d8c525b765a12f682dd4309d8f33, 1523060352, 'userId|i:1;', 2, 1, NULL),
(0x7dc646cab5197ad5393a94f909ac734616743bf80a793c7d60393579f7b34d23, 1523047520, '', 1, NULL, NULL),
(0xbb02f8bd111c4d1a21f16a3772f307ffd96bc1dacd0d48f99f89726cbc5fd751, 1523082827, 'userId|i:1;', 2, 1, NULL),
(0xbf8a8c3829faafb90cdff351b882cc7a1477b267102987507ffba40770df7f41, 1524055693, 'userId|i:1;', 2, 1, 1523164482),
(0xc9ac3b40386a12b68d4139cd9f9691a0fd80b4f5c700d459fd87f432b896b253, 1523047520, '', 1, NULL, NULL);

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
(1, 0x05867f4d98570fd6716b73dc00976b21, 1523047519, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'worzala.pawel@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79');

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
  `deleted` int(11) DEFAULT NULL,
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
(1, 0x10c9cd4209b12f8939898ba78bfdfc21, 1523047174, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'worzala.pawel@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', 'f4d73961a0dbd89936592d59afbaad31'),
(2, 0x74538b23c7f44605f7fc189d925c8308, 1523047344, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'worzala.pawel@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', 'a1716c8bb95453b230070b6434817cdb'),
(3, 0x38f0914914a273a8af5a7f8b8638f8b1, 1523047446, NULL, 1, NULL, NULL, NULL, 1523047520, NULL, 1, 'worzala.pawel@gmail.com', '26c669cd0814ac40e5328752b21c4aa6450d16295e4eec30356a06a911c23983aaebe12d5da38eeebfc1b213be650498df8419194d5a26c7e0a50af156853c79', '8a45ff768752a252cc6205c9666db8dc'),
(4, 0x36666436643437663937356164306438, 1523125739, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'convallis@megazin.pl', '29e950db9005f1dbca52aee3d1d2fde1a959579b03bf31b4ce27797b1fcbab5f0b2737f5215399a5075649a20629a49b14ef1abe4941c2010bad2744f1312dc8', 'ad9c942df82277681704d73c7537d552'),
(5, 0x37323563333161646466663532323134, 1523125741, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'risus@megazin.pl', 'd5e72904c9ef74a5db3aff94d8385af290469c32d2397f51e046b275294593dbeec6271102f75834dfc5f67f390a8e1e9bdd10500e38ab33c3cc2c41c88d1b56', '4902a579b41221246adc32ad0460f75b'),
(6, 0x61646136373362643163393939393434, 1523125745, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'ridiculus.enim@megazin.pl', '25eb05f319c488c8b75cfd03e9cd2fc5591acb3682fcc556e8d9a2325584bec63b810c119a1ee4ad8882c2882500f4e106c9ed73aad7cffb17d4e938e6def9e6', '5da2a5999a04470aa95bd542b644832d'),
(7, 0x64633961343637316137613234386263, 1523126718, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pharetra@megazin.pl', '33a9afb54cb1ace624f227a3681029cd85c69162a5023be47f4954e69641ad716ccdfd6f573bcd09c82ca1a35683311812a0f87b7fc0de69c29727e4b9bc627c', 'ac7db70481a5f507b996828224483ac3'),
(8, 0x00000000000000000000000000000000, 1523127263, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ''),
(39, 0x38313862383664663735303533326364, 1523129239, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'b0c74fac7597f6dd491a9844f1110b7a'),
(40, 0x585d37683aac5b173f503814d218a253, 1523129277, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'eros@megazin.pl', '034e433bdf8c3ac8f220aae9fb2bf0eb18570818756f8da3ea67936006b4d22913e1b110f71f136b9fad6ee108217d17de58a2506b11b63318f5aa4fab59a22b', '99fad8a46c945d68b028102c87f28aff'),
(41, 0x487d26a86120b86872d9ab42f0ac71f5, 1523129495, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'egestas@megazin.pl', 'c454863ccd832c4cd307357fdf0d190d0e1d37b3f72cd790a9aad8a321a97aee412082ac8872276871e81fd0ec2543de68b0ef77ea6863005d12b4f5d022f6e5', '06fd8b83d150f81f8b7677ff919a86a9'),
(42, 0x8faf1800bd57942633f726940937115a, 1523129531, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'consequat@megazin.pl', 'f80e08d560b7cdf139abaeebb2a8c126c94487cb4a1862271941276da93bc5324264c950fd18e12792629b85efc400fe107cea245ec02b7dd70c4d3f642b3b0e', '38028513163dba05b13336bd675f949b'),
(43, 0xa612425aabadc56605aa86b2c10134dd, 1523130125, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'maecenas@megazin.pl', 'e0cf0677084947bc29caca5351eab9e868522fc98c92c2de67ebb06b7fcf1b6161b7dfa0db8a8db7ccf23c7c290967f5ca46d27e1246a7d7e5af67066bbfd992', 'ba8d227b98f1c4c87bd355835f29d318'),
(44, 0x30afa12c5fb78c1a187f33f862d295fb, 1523131015, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'porttitor@megazin.pl', 'b7bb1e0e35102ae7981686b82105ce415bc6c071bc68064b97987d0e251fd3dcb67a59e1eb133c672fb217016ecaa3f5df86f7061fd5a52753eeb898115f45fc', 'c35642f704a7fb03620f629d5cb16832'),
(45, 0x88477f0499a34b948f298c890dc91d2b, 1523131208, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'mattis@megazin.pl', '58caf69037da154351742f1545662370b0a970bb01e411f4436eb61f1dcd49e7f463f020e6b198921ca76b8d2503d9f20fb961811ba6fe9fae055a6081770f6f', '7967a11ca89828c8126913faf6268004'),
(46, 0x9b546cc895a3bc35460478c95ab87d40, 1523135711, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'cras.fringilla@megazin.pl', 'e37d08af497f3fa04d0d6d30a82e27c98afb562e900ba41a5fdb2eb38320bdf57efd0b6a47a6501fff5d9bf2bb7fc9430bc0b622802eccd5aacfca0bea98a595', '513dfa375856f9f88579fa1d5a0b832c'),
(47, 0x44fbb8f4584c3cd53d3ba5150a235644, 1523137788, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'etiam@megazin.pl', '9295a5ca929594fde8e72605b324d7ced00f0d7d0c2821ef8b41836717bb1d166c3d4f93f9fac692fb3326b58ddd17ee4e6613f1603e84fa6b2e7a0297a1eef9', '2bfbd1db09056b64c63cf912292f0aa1'),
(48, 0x0ab554b41f291d3927a44a80869b67b1, 1523137971, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'et@megazin.pl', '0f8daf8b4e919518446fd6af8fc4b24d761c6b02f5ab7be928e568b00cfd5793a62518f696b2f21afbc0c7da5d30320eddb946746af4b54f62b14234fbe91b41', '0c4cb5df753631da406d73246b16490d'),
(49, 0x1b781181255527b8b1b01260a3f7d779, 1523138213, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'nisl@megazin.pl', '4651d1d6c7b5ae9b36038750ab9127e8c4a747bcedcb8422a74255089ed2cded4f6ce00b3e7d11b1bcc127c1bfa11ff8243f66ac9ceee5701584fb33887edd6e', '3a7bf51baf7bfc91ff51260689905c3f'),
(50, 0xc0b29163186b585512349815842489aa, 1523138301, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', 'ff6951c121249c60ab06458b09c04afa'),
(51, 0xf0cf3bdd781d5776085474507444f303, 1523138882, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '31baf96db7f2fc5347fa75cb7f0b9636'),
(52, 0xcdb8dff5d14da5090a715908fb893685, 1523140515, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '1c8cc021a439448067c27d8c25778365'),
(53, 0x155051b966a8b0943c96f29b40bf0ab1, 1523162991, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '84d514badb2d91ab17fa3318389677fc'),
(54, 0x0685056db4884d697aa5d0288010509a, 1523163479, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '46d14096c157842da719cf8986c77c51'),
(55, 0xa17f3ba1b50c234bf607066cc8acd9a9, 1523163544, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '131d294809db65bd3a271b0a6c0176ff'),
(56, 0xa1b02870d61a1c6918d98d019f7c08b1, 1523164096, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '9d46106c292cb826625f8453220348f3'),
(57, 0xc9f0270d9f87505c62f55ff6f1f19789, 1523164239, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '28182bd8aa80ad833c8f090b69d6324f'),
(58, 0x7fdffa1b6d929df63a1f5318b6597230, 1523164483, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '106f945721c3d72366280f6f968444b2'),
(59, 0x786b7aabd796762f2cb1a2fac4d40414, 1523170707, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', 'c8925d824fd5333b9d4cf403b0fa8591'),
(60, 0xb33f69f7b67828c823f94d4859b15bb7, 1523633533, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', 'a5f5c107b980c6c198639f200cb96cb8'),
(61, 0xb09cdd881c48baa6c18df69139c95d9c, 1523633536, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', '1a529d501fd41b7f47f357466f4d9ff7'),
(62, 0xca86bd1ab0395f783c2149657b947c52, 1524053370, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'pellentesque@megazin.pl', '944985ee25fbd157dfaca7c8faadb4eb98ff49de4b4afd286878eafcdefa719f0c6c45667ea68873e0710780a5b6541ec1d31dfa7545e63238cbad14da595695', 'c08da1f8437ba727f419a994cac59c69');

-- --------------------------------------------------------

--
-- Struktura widoku `product_file_view`
--
DROP TABLE IF EXISTS `product_file_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_file_view`  AS  select `file`.`id` AS `file_id`,`file`.`uuid` AS `file_uuid`,`file`.`added` AS `added`,`file`.`deleted` AS `deleted`,`file`.`size` AS `size`,`file`.`url` AS `url`,`file`.`name` AS `name`,`file`.`type` AS `type`,`product_files`.`id` AS `product_files_id`,`product_files`.`uuid` AS `product_files_uuid`,`product_files`.`product_id` AS `product_id`,`product`.`uuid` AS `product_uuid` from ((`file` left join `product_files` on((`file`.`id` = `product_files`.`id`))) left join `product` on((`product_files`.`product_id` = `product`.`id`))) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT dla tabeli `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `product_files`
--
ALTER TABLE `product_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
