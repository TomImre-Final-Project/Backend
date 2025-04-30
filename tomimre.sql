-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 30. 16:15
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tomimre`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'officiis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(2, 'et', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(3, 'dolor', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(4, 'maiores', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(5, 'ducimus', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(6, 'neque', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(7, 'quo', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(8, 'eaque', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(9, 'enim', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(10, 'quasi', '2025-04-30 12:14:46', '2025-04-30 12:14:46');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `courier_logs`
--

CREATE TABLE `courier_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `action` enum('claimed','delivered') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dishes`
--

CREATE TABLE `dishes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `ingredients` text NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `description`, `restaurant_id`, `category_id`, `price`, `ingredients`, `is_available`, `image`, `created_at`, `updated_at`) VALUES
(1, 'et', NULL, 8, 9, 4200, 'Esse quam officia quia cum saepe delectus hic maiores.', 0, 'https://via.placeholder.com/640x480.png/000099?text=totam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(2, 'nesciunt', NULL, 9, 10, 4774, 'Tempora aut laborum eum ratione.', 1, 'https://via.placeholder.com/640x480.png/00cc11?text=atque', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(3, 'nisi', NULL, 8, 4, 2977, 'Repellat at error magnam.', 0, 'https://via.placeholder.com/640x480.png/001166?text=qui', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(4, 'maxime', NULL, 4, 2, 2262, 'Molestiae tenetur vero aut.', 1, 'https://via.placeholder.com/640x480.png/005588?text=tempora', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(5, 'et', NULL, 1, 2, 8373, 'Aut nam optio expedita sed eos reprehenderit hic.', 0, 'https://via.placeholder.com/640x480.png/004422?text=eaque', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(6, 'deserunt', NULL, 10, 6, 8984, 'Nulla fugiat iusto natus quisquam vel.', 0, 'https://via.placeholder.com/640x480.png/00dd00?text=assumenda', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(7, 'et', NULL, 6, 2, 4724, 'Fuga quia cupiditate iure excepturi.', 0, 'https://via.placeholder.com/640x480.png/00ffee?text=error', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(8, 'sunt', NULL, 10, 10, 6752, 'Autem similique ut reiciendis odio rerum consequatur.', 1, 'https://via.placeholder.com/640x480.png/00ff66?text=magnam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(9, 'iure', NULL, 8, 9, 8090, 'Fugit quos inventore at.', 1, 'https://via.placeholder.com/640x480.png/004455?text=iure', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(10, 'quaerat', NULL, 3, 1, 9769, 'Temporibus cupiditate veritatis qui consectetur praesentium in.', 0, 'https://via.placeholder.com/640x480.png/0022bb?text=ex', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(11, 'exercitationem', NULL, 5, 9, 7016, 'Vero corrupti eveniet velit tenetur qui quia.', 1, 'https://via.placeholder.com/640x480.png/00dd88?text=non', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(12, 'et', NULL, 3, 3, 8949, 'Fugiat vel velit sit aperiam nesciunt hic aspernatur exercitationem.', 1, 'https://via.placeholder.com/640x480.png/00aa00?text=nulla', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(13, 'id', NULL, 8, 6, 4806, 'Quae nemo nesciunt a soluta dolores enim consequatur.', 1, 'https://via.placeholder.com/640x480.png/00ff77?text=illo', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(14, 'qui', NULL, 3, 10, 6216, 'Accusantium harum accusantium aut corporis.', 1, 'https://via.placeholder.com/640x480.png/00eeee?text=sequi', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(15, 'nostrum', NULL, 4, 7, 8050, 'At optio rerum est.', 1, 'https://via.placeholder.com/640x480.png/005566?text=vitae', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(16, 'sint', NULL, 3, 10, 9437, 'Quia distinctio doloribus debitis illum ut.', 1, 'https://via.placeholder.com/640x480.png/0088dd?text=corporis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(17, 'voluptates', NULL, 3, 7, 8661, 'Dolorem quod sit ipsa velit.', 1, 'https://via.placeholder.com/640x480.png/003333?text=illo', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(18, 'unde', NULL, 5, 10, 7482, 'Ea odio doloribus voluptas molestiae dolores et.', 0, 'https://via.placeholder.com/640x480.png/00ff00?text=est', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(19, 'odio', NULL, 3, 2, 7805, 'Est magni possimus est quis.', 1, 'https://via.placeholder.com/640x480.png/0066aa?text=repellendus', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(20, 'qui', NULL, 4, 3, 7131, 'Ab sunt voluptatem officiis.', 1, 'https://via.placeholder.com/640x480.png/00dd33?text=deserunt', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(21, 'officia', NULL, 8, 2, 4331, 'Architecto saepe reiciendis ratione voluptate.', 1, 'https://via.placeholder.com/640x480.png/0033dd?text=nihil', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(22, 'minima', NULL, 7, 1, 1993, 'Iure unde odio sunt porro velit voluptas et.', 0, 'https://via.placeholder.com/640x480.png/00ddcc?text=repudiandae', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(23, 'numquam', NULL, 1, 6, 5077, 'Sint praesentium fugit nesciunt.', 1, 'https://via.placeholder.com/640x480.png/00ff33?text=aut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(24, 'non', NULL, 7, 8, 9879, 'Quidem vel voluptatem temporibus voluptatem velit earum excepturi.', 0, 'https://via.placeholder.com/640x480.png/0022bb?text=ut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(25, 'dolorum', NULL, 9, 6, 7198, 'Optio amet et molestias nihil corrupti error.', 0, 'https://via.placeholder.com/640x480.png/00ee99?text=ab', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(26, 'fugit', NULL, 4, 1, 4787, 'Exercitationem dicta sint sit.', 0, 'https://via.placeholder.com/640x480.png/008855?text=debitis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(27, 'vero', NULL, 1, 10, 1738, 'Quos dolorem et et eveniet sint.', 0, 'https://via.placeholder.com/640x480.png/009944?text=at', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(28, 'ea', NULL, 2, 10, 5033, 'Accusantium voluptate aut quo hic.', 1, 'https://via.placeholder.com/640x480.png/00bbaa?text=nam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(29, 'sapiente', NULL, 6, 4, 9308, 'Inventore consequatur non aspernatur rerum ipsum repellendus.', 0, 'https://via.placeholder.com/640x480.png/002244?text=molestias', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(30, 'et', NULL, 8, 8, 4464, 'Quasi cupiditate odit hic vel maxime.', 0, 'https://via.placeholder.com/640x480.png/0022ee?text=dicta', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(31, 'facilis', NULL, 6, 5, 9103, 'Aliquid dolor sed consequatur sit est optio.', 0, 'https://via.placeholder.com/640x480.png/004444?text=libero', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(32, 'magni', NULL, 4, 4, 4788, 'Accusantium qui nostrum minus libero pariatur voluptas.', 1, 'https://via.placeholder.com/640x480.png/00ee99?text=et', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(33, 'ipsa', NULL, 3, 3, 2470, 'Corporis provident cum sapiente doloribus.', 0, 'https://via.placeholder.com/640x480.png/001122?text=quasi', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(34, 'fuga', NULL, 7, 6, 2046, 'Ut dolorem doloribus sit eos tempora reiciendis.', 1, 'https://via.placeholder.com/640x480.png/00ee55?text=quod', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(35, 'sint', NULL, 1, 7, 3214, 'Sint consequatur voluptatum dicta consequatur illum ratione.', 1, 'https://via.placeholder.com/640x480.png/00ddbb?text=modi', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(36, 'iste', NULL, 5, 5, 9698, 'Soluta corrupti ut fugit.', 0, 'https://via.placeholder.com/640x480.png/00dd33?text=ex', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(37, 'ad', NULL, 1, 4, 6421, 'Adipisci et corrupti nesciunt quidem unde.', 1, 'https://via.placeholder.com/640x480.png/00ff77?text=iusto', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(38, 'quidem', NULL, 1, 2, 9233, 'Saepe aliquid consequatur qui pariatur in blanditiis et.', 0, 'https://via.placeholder.com/640x480.png/000044?text=numquam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(39, 'molestias', NULL, 9, 10, 5485, 'Quibusdam et cupiditate cupiditate.', 0, 'https://via.placeholder.com/640x480.png/00bb33?text=dolores', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(40, 'nihil', NULL, 8, 10, 2953, 'Debitis exercitationem maiores omnis velit sed itaque.', 1, 'https://via.placeholder.com/640x480.png/00aa22?text=voluptatem', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(41, 'praesentium', NULL, 8, 8, 5098, 'Qui dolorem vel architecto non porro.', 1, 'https://via.placeholder.com/640x480.png/00eeff?text=repellendus', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(42, 'voluptatem', NULL, 3, 9, 4306, 'Amet est soluta et aut reprehenderit doloribus.', 0, 'https://via.placeholder.com/640x480.png/0011bb?text=qui', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(43, 'consequuntur', NULL, 10, 6, 5883, 'Amet animi in omnis fuga laboriosam fugit sunt.', 0, 'https://via.placeholder.com/640x480.png/008844?text=vero', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(44, 'dignissimos', NULL, 4, 10, 5783, 'Repellat dolores repellendus voluptate esse et est mollitia.', 1, 'https://via.placeholder.com/640x480.png/001199?text=eum', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(45, 'maxime', NULL, 8, 8, 3820, 'Et consequatur in adipisci nemo beatae illo distinctio.', 0, 'https://via.placeholder.com/640x480.png/006644?text=omnis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(46, 'inventore', NULL, 8, 8, 3663, 'Consequatur dolorem et alias quidem ipsam.', 1, 'https://via.placeholder.com/640x480.png/001199?text=eos', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(47, 'ut', NULL, 2, 3, 7646, 'Quis maiores voluptatem at saepe.', 1, 'https://via.placeholder.com/640x480.png/00eeee?text=porro', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(48, 'enim', NULL, 5, 1, 4003, 'Quia commodi nesciunt quasi harum illo quae repellendus corrupti.', 1, 'https://via.placeholder.com/640x480.png/001155?text=cum', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(49, 'et', NULL, 8, 6, 4760, 'Ab adipisci maxime eligendi totam non.', 0, 'https://via.placeholder.com/640x480.png/00ee11?text=illo', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(50, 'totam', NULL, 9, 4, 7364, 'Tempora vel distinctio ipsam et natus in sunt.', 1, 'https://via.placeholder.com/640x480.png/0088aa?text=aut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(51, 'esse', NULL, 3, 4, 6483, 'Eaque qui quam et ut cupiditate aperiam maiores.', 0, 'https://via.placeholder.com/640x480.png/003344?text=fuga', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(52, 'sit', NULL, 9, 3, 9931, 'Sit voluptatem sint ipsa sit doloribus molestiae officia.', 0, 'https://via.placeholder.com/640x480.png/008855?text=ut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(53, 'deserunt', NULL, 4, 1, 1461, 'Neque placeat in sapiente molestias quae.', 1, 'https://via.placeholder.com/640x480.png/000011?text=nihil', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(54, 'voluptatem', NULL, 2, 8, 9911, 'Ratione consequatur velit earum nihil quibusdam voluptates dolore quis.', 1, 'https://via.placeholder.com/640x480.png/009966?text=suscipit', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(55, 'temporibus', NULL, 5, 10, 6736, 'Accusantium et rerum mollitia ad molestiae.', 1, 'https://via.placeholder.com/640x480.png/00dd00?text=ex', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(56, 'id', NULL, 8, 1, 1029, 'Et qui porro adipisci sit est iure itaque necessitatibus.', 0, 'https://via.placeholder.com/640x480.png/0044aa?text=magni', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(57, 'nam', NULL, 10, 1, 9435, 'Dolor et tenetur ratione voluptatum nihil.', 0, 'https://via.placeholder.com/640x480.png/0044cc?text=saepe', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(58, 'est', NULL, 4, 10, 8028, 'Accusamus iure earum similique ratione facilis dolor possimus.', 0, 'https://via.placeholder.com/640x480.png/002244?text=dolorum', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(59, 'nihil', NULL, 6, 2, 3887, 'Animi sint dolores tempore illo accusantium ea veritatis aut.', 1, 'https://via.placeholder.com/640x480.png/003355?text=sit', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(60, 'necessitatibus', NULL, 5, 7, 4362, 'Consectetur expedita ut odit voluptatum incidunt aut.', 1, 'https://via.placeholder.com/640x480.png/00ddff?text=quas', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(61, 'voluptatem', NULL, 4, 4, 3088, 'Possimus officiis ex sed odit vitae iste at molestias.', 0, 'https://via.placeholder.com/640x480.png/006677?text=porro', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(62, 'culpa', NULL, 1, 2, 2572, 'Qui voluptas sint quo minima et labore iste.', 0, 'https://via.placeholder.com/640x480.png/0033cc?text=nostrum', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(63, 'asperiores', NULL, 10, 1, 6735, 'Soluta voluptatem praesentium laborum beatae odit cupiditate.', 0, 'https://via.placeholder.com/640x480.png/000033?text=ut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(64, 'praesentium', NULL, 7, 6, 8083, 'Reprehenderit et nostrum illum similique possimus illum.', 1, 'https://via.placeholder.com/640x480.png/00ff77?text=architecto', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(65, 'deleniti', NULL, 1, 2, 9081, 'Tenetur nostrum sunt fugit facilis quasi.', 1, 'https://via.placeholder.com/640x480.png/001155?text=optio', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(66, 'sequi', NULL, 2, 3, 6365, 'Aut at occaecati nulla inventore iste ipsa.', 0, 'https://via.placeholder.com/640x480.png/0066cc?text=culpa', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(67, 'et', NULL, 7, 1, 2268, 'Quod iste molestiae dolore blanditiis reprehenderit.', 0, 'https://via.placeholder.com/640x480.png/002200?text=veniam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(68, 'consectetur', NULL, 1, 4, 1872, 'Illum rerum aperiam et at quos tempora.', 1, 'https://via.placeholder.com/640x480.png/002277?text=quae', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(69, 'perferendis', NULL, 3, 2, 9452, 'Qui voluptatem facilis voluptas labore ut ut nihil.', 1, 'https://via.placeholder.com/640x480.png/003311?text=possimus', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(70, 'suscipit', NULL, 10, 2, 4107, 'Soluta ea dolorem eum reiciendis.', 1, 'https://via.placeholder.com/640x480.png/00bb22?text=doloribus', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(71, 'corrupti', NULL, 4, 6, 8603, 'Aut beatae dolorem minima nesciunt libero.', 1, 'https://via.placeholder.com/640x480.png/0099ee?text=eos', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(72, 'voluptatem', NULL, 4, 10, 5706, 'Amet illum sint non tempore error rerum perferendis.', 0, 'https://via.placeholder.com/640x480.png/000000?text=molestias', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(73, 'hic', NULL, 5, 6, 8989, 'Veniam velit optio dolor adipisci delectus alias.', 0, 'https://via.placeholder.com/640x480.png/00ff22?text=amet', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(74, 'autem', NULL, 2, 4, 6182, 'Enim consequuntur sunt voluptatem et aliquam voluptate pariatur.', 1, 'https://via.placeholder.com/640x480.png/00bb00?text=ut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(75, 'quam', NULL, 5, 6, 8128, 'Labore magni quas provident est porro velit consequatur.', 0, 'https://via.placeholder.com/640x480.png/00cc99?text=omnis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(76, 'eius', NULL, 3, 1, 8307, 'Sunt nulla rem odit consequatur laborum.', 1, 'https://via.placeholder.com/640x480.png/00ff11?text=facilis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(77, 'perferendis', NULL, 9, 1, 5960, 'Sed id ut optio voluptatem distinctio.', 1, 'https://via.placeholder.com/640x480.png/0066cc?text=sed', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(78, 'quas', NULL, 7, 9, 4739, 'Eius aperiam ut mollitia et quam et exercitationem.', 1, 'https://via.placeholder.com/640x480.png/00ddee?text=at', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(79, 'in', NULL, 5, 9, 6813, 'Officiis alias qui nisi unde vel aut blanditiis.', 0, 'https://via.placeholder.com/640x480.png/000088?text=beatae', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(80, 'dignissimos', NULL, 5, 4, 4296, 'Dolores quos animi sapiente eum quibusdam.', 1, 'https://via.placeholder.com/640x480.png/006633?text=fugiat', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(81, 'alias', NULL, 10, 7, 7352, 'Modi atque dolorum nemo repudiandae est consequatur aut.', 1, 'https://via.placeholder.com/640x480.png/00aaaa?text=cumque', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(82, 'et', NULL, 6, 7, 7882, 'Molestiae ut rerum asperiores deserunt aut aut facere.', 1, 'https://via.placeholder.com/640x480.png/003366?text=quisquam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(83, 'minima', NULL, 6, 5, 3342, 'Quas voluptatem nulla aut pariatur commodi consequatur.', 1, 'https://via.placeholder.com/640x480.png/0066bb?text=voluptas', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(84, 'atque', NULL, 2, 7, 6062, 'Iste aut rerum ipsa voluptate modi est.', 1, 'https://via.placeholder.com/640x480.png/00aa99?text=cum', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(85, 'aut', NULL, 6, 4, 9258, 'Dolorem maxime architecto quasi sit similique voluptas praesentium.', 1, 'https://via.placeholder.com/640x480.png/00aacc?text=nam', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(86, 'nam', NULL, 10, 2, 2060, 'Distinctio voluptatem corporis reiciendis.', 0, 'https://via.placeholder.com/640x480.png/00bb11?text=vel', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(87, 'dolores', NULL, 10, 3, 6349, 'Deleniti illum quis omnis quam vitae expedita ut.', 1, 'https://via.placeholder.com/640x480.png/0033bb?text=saepe', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(88, 'placeat', NULL, 6, 7, 1638, 'Soluta quibusdam maiores tempore aut nemo qui.', 1, 'https://via.placeholder.com/640x480.png/001100?text=facilis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(89, 'reiciendis', NULL, 4, 2, 7705, 'Repellat consequatur consequuntur maxime facilis consectetur.', 0, 'https://via.placeholder.com/640x480.png/00bb88?text=voluptates', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(90, 'distinctio', NULL, 7, 5, 3840, 'Vitae veritatis eos consequatur omnis dolorum iste qui unde.', 1, 'https://via.placeholder.com/640x480.png/001188?text=quis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(91, 'omnis', NULL, 10, 6, 3461, 'Voluptas nulla autem possimus explicabo nihil quo.', 1, 'https://via.placeholder.com/640x480.png/000011?text=ut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(92, 'voluptas', NULL, 9, 4, 9754, 'Aut ut id quia dignissimos quibusdam quibusdam iure reprehenderit.', 0, 'https://via.placeholder.com/640x480.png/0033bb?text=ut', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(93, 'cum', NULL, 7, 4, 5828, 'Distinctio animi et velit sunt eveniet consequatur quo.', 0, 'https://via.placeholder.com/640x480.png/001166?text=quia', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(94, 'ut', NULL, 5, 4, 8461, 'Qui facere animi ut.', 0, 'https://via.placeholder.com/640x480.png/0077ee?text=non', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(95, 'aperiam', NULL, 10, 9, 6868, 'Dolor ratione maiores voluptatem eum est facere corrupti.', 0, 'https://via.placeholder.com/640x480.png/0033dd?text=quis', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(96, 'consequatur', NULL, 2, 3, 7640, 'Autem voluptatum veritatis porro consectetur commodi dolores sapiente.', 0, 'https://via.placeholder.com/640x480.png/009999?text=non', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(97, 'omnis', NULL, 7, 7, 9038, 'Tempora nobis in et quae veritatis et voluptatem.', 0, 'https://via.placeholder.com/640x480.png/005599?text=autem', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(98, 'iusto', NULL, 3, 8, 6441, 'Et ut est atque molestiae.', 0, 'https://via.placeholder.com/640x480.png/00aa99?text=at', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(99, 'quo', NULL, 6, 6, 7097, 'Asperiores reprehenderit non aut libero quae dolore dolor.', 1, 'https://via.placeholder.com/640x480.png/008855?text=quia', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(100, 'neque', NULL, 6, 2, 8757, 'Voluptatibus consequatur placeat eum id id voluptas.', 1, 'https://via.placeholder.com/640x480.png/00ffcc?text=nostrum', '2025-04-30 12:14:46', '2025-04-30 12:14:46');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_15_073546_create_categories_table', 1),
(5, '2025_02_15_073547_create_restaurants_table', 1),
(6, '2025_02_15_073548_create_dishes_table', 1),
(7, '2025_02_15_073548_create_orders_table', 1),
(8, '2025_02_15_073549_create_order_items_table', 1),
(9, '2025_02_15_073549_create_payments_table', 1),
(10, '2025_02_15_073550_create_courier_logs_table', 1),
(11, '2025_02_15_073550_create_promotions_table', 1),
(12, '2025_02_15_073550_create_restaurant_logs_table', 1),
(13, '2025_02_15_150728_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','confirmed','preparing','ready','delivering','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `total_price` int(11) NOT NULL,
  `picked_up_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `special_instructions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `dish_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `payments`
--

CREATE TABLE `payments` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL,
  `method` enum('credit_card','paypal','bank_transfer') NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `address`, `phone`, `manager_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Torp, Kutch and Sauer', '18832 Stamm Skyway Suite 886\nJacintheburgh, DE 18246', '+1 (463) 781-2919', NULL, 'inactive', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(2, 'Murazik, Kovacek and Friesen', '507 Colby Shoals Suite 484\nMyrtieburgh, MD 41766', '815-979-1473', NULL, 'inactive', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(3, 'Okuneva, Fay and Bogisich', '4288 Hauck Shores\nEast Mireya, IA 88632', '+1-848-821-5203', NULL, 'inactive', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(4, 'Wiza, Simonis and Altenwerth', '9190 Murphy Alley Suite 346\nNorth Jakeberg, CA 72680', '+1-941-261-8089', NULL, 'active', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(5, 'Muller, Heller and Von', '85520 Witting View Apt. 343\nPort Haliestad, SC 01119-1291', '1-520-471-4217', NULL, 'active', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(6, 'Hamill-Dietrich', '266 Lebsack Camp\nNew Daniellatown, MN 03067', '563-358-6081', NULL, 'inactive', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(7, 'Hane and Sons', '31921 Deborah Street Suite 643\nSouth Albertahaven, IN 99744-3295', '(567) 834-6487', NULL, 'active', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(8, 'Pfannerstill, O\'Hara and Aufderhar', '748 Osvaldo Loop Suite 218\nLueilwitzfort, AR 66859-4606', '(830) 253-5441', NULL, 'inactive', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(9, 'Blanda Ltd', '64387 Blanda Coves\nEast Clintonchester, NH 30064-4087', '+1-920-290-2691', NULL, 'active', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(10, 'Bashirian-Hill', '339 Ratke Radial\nMafaldafurt, MO 20807-0407', '1-585-680-4341', NULL, 'inactive', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(11, 'Példa Étterem', 'Budapest, Példa utca 1.', '+36 1 234 5678', NULL, 'active', '2025-04-30 12:14:46', '2025-04-30 12:14:46'),
(12, 'Másik Étterem', 'Budapest, Másik utca 2.', '+36 1 234 5679', NULL, 'active', '2025-04-30 12:14:46', '2025-04-30 12:14:46');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `restaurant_logs`
--

CREATE TABLE `restaurant_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','restaurant_manager','customer','courier') NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'borer.devin', 'metz.napoleon@example.com', '$2y$12$xXtACF5bzKEBwH.Fi.qTc.meqy6nfvk3oQiF6jTiVF3QJEIdNiYla', 'customer', '757-557-6473', '6660 Raul Underpass Suite 140\nAnyaton, NE 38910', '2025-04-30 12:14:43', '2025-04-30 12:14:45'),
(2, 'igerhold', 'jairo.emard@example.org', '$2y$12$KZesejtamcMfGDzrZK7seePvTmfXklXph/3pZYYy13edrKaASaJ/y', 'restaurant_manager', '+18545588333', '876 Raoul Lake\nPort Elva, GA 27295-1322', '2025-04-30 12:14:43', '2025-04-30 12:14:45'),
(3, 'grady90', 'kennedi.will@example.net', '$2y$12$CWpqDEc8I.KzY/ntk0FgyOAy1YeXR.MM31paPB4jqXa3qX1BlocXa', 'restaurant_manager', '+1 (234) 372-0338', NULL, '2025-04-30 12:14:43', '2025-04-30 12:14:45'),
(4, 'ywolf', 'bianka.lang@example.net', '$2y$12$GXsXVby7QFTrBueDm0B1qOWTvn6ASmgLyXyfDWNt7exQk1CrIOK/G', 'restaurant_manager', '+19494316219', NULL, '2025-04-30 12:14:44', '2025-04-30 12:14:45'),
(5, 'asa47', 'qquitzon@example.net', '$2y$12$AMDJRrS5w0Tq3XEPFA1xSuHYwYMoRKS8tq6wtTLZXM89/t0wASwqa', 'restaurant_manager', '812-967-8886', NULL, '2025-04-30 12:14:44', '2025-04-30 12:14:45'),
(6, 'mustafa.lynch', 'ztrantow@example.net', '$2y$12$GozCDWG9RmZ6Cey1f7OEzuJUf4afXo4s9scTcNWvSmEn8PmcLIT3C', 'courier', '+1-360-397-1285', NULL, '2025-04-30 12:14:44', '2025-04-30 12:14:45'),
(7, 'giuseppe17', 'arch.goodwin@example.com', '$2y$12$g9efszc.jjooytZRI24huO96hOvUQYuerc3fXXXNfcPJalWv73o/S', 'restaurant_manager', '(678) 642-8022', NULL, '2025-04-30 12:14:44', '2025-04-30 12:14:45'),
(8, 'wolf.adela', 'zcarter@example.com', '$2y$12$1Q4fw0e5jv4fxLkqKDHN8OtqQWaVDzjll0PemxvFODFUO8ERhNlue', 'courier', '1-445-997-9743', '9896 Angelita Drive Apt. 320\nNew Ozellatown, DE 34065', '2025-04-30 12:14:44', '2025-04-30 12:14:45'),
(9, 'ikrajcik', 'mathew97@example.org', '$2y$12$qFhCWzhAzfgDLYYFEhEIi.V.uDrK054JDv34uXJJl6GfWuI97pWwq', 'restaurant_manager', '(308) 517-2223', NULL, '2025-04-30 12:14:45', '2025-04-30 12:14:45'),
(10, 'emard.valerie', 'kris.tabitha@example.com', '$2y$12$8mbGr69J0ip/cqXq7Y53G.XsVErmWTPaujoc9Yu7LPMi/4A7JOa6e', 'courier', '540-475-2682', NULL, '2025-04-30 12:14:45', '2025-04-30 12:14:45'),
(11, 'adminuser', 'admin@example.com', '$2y$12$wqgPrN5DyzCMsFr5yd.bg.t.mG8zEz8M9j.wC7w4/gR933pagsE62', 'admin', '1234567890', 'Admin Address', '2025-04-30 12:14:45', '2025-04-30 12:14:45'),
(12, 'courieruser', 'courier@example.com', '$2y$12$SMZd72xkJqjJ5cgfeC65DOqoKRpWnMMfbIfsRxbj29W9zJ9v9EaHu', 'courier', '1234567891', 'Courier Address', '2025-04-30 12:14:45', '2025-04-30 12:14:45'),
(13, 'restaurantmanager', 'restaurantmanager@example.com', '$2y$12$NAxS9/T2zuCXSc8X7HxwjuEyYKYucJWYB3Xn1uqmoC3xA1KsM9Jwy', 'restaurant_manager', '1234567892', 'Restaurant Manager Address', '2025-04-30 12:14:45', '2025-04-30 12:14:45'),
(14, 'customer', 'customer@example.com', '$2y$12$FSDetuIEeq1VDP/EMDOZkuLk/S8gTytiaHx5naNqcqtOAHCtPfgLS', 'customer', '1234567893', 'Customer Address', '2025-04-30 12:14:46', '2025-04-30 12:14:46');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- A tábla indexei `courier_logs`
--
ALTER TABLE `courier_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_logs_courier_id_foreign` (`courier_id`),
  ADD KEY `courier_logs_order_id_foreign` (`order_id`);

--
-- A tábla indexei `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dishes_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `dishes_category_id_foreign` (`category_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `orders_courier_id_foreign` (`courier_id`);

--
-- A tábla indexei `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_items_order_id_dish_id_unique` (`order_id`,`dish_id`),
  ADD KEY `order_items_dish_id_foreign` (`dish_id`);

--
-- A tábla indexei `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`order_id`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promotions_code_unique` (`code`);

--
-- A tábla indexei `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurants_manager_id_foreign` (`manager_id`);

--
-- A tábla indexei `restaurant_logs`
--
ALTER TABLE `restaurant_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_logs_restaurant_id_foreign` (`restaurant_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `courier_logs`
--
ALTER TABLE `courier_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `restaurant_logs`
--
ALTER TABLE `restaurant_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `courier_logs`
--
ALTER TABLE `courier_logs`
  ADD CONSTRAINT `courier_logs_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `courier_logs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Megkötések a táblához `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `dishes_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_dish_id_foreign` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Megkötések a táblához `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `restaurant_logs`
--
ALTER TABLE `restaurant_logs`
  ADD CONSTRAINT `restaurant_logs_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
