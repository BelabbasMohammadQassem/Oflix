-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 17 oct. 2024 à 09:49
-- Version du serveur : 10.11.3-MariaDB-1:10.11.3+maria~ubu2004
-- Version de PHP : 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `oflixx`
--

-- --------------------------------------------------------

--
-- Structure de la table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `actor`
--

INSERT INTO `actor` (`id`, `first_name`, `last_name`) VALUES
(47, 'Eric', 'Judor'),
(48, 'Jean Claude', 'Van Damne'),
(49, 'Jacky', 'Van Damne'),
(50, 'Jean', 'dujardin'),
(51, 'Kevin', 'Spacey'),
(52, 'Beyonce', 'Knowles'),
(53, 'Chirs', 'Pratt'),
(54, 'Tom', 'Cruise'),
(55, 'Tom', 'Hanks'),
(56, 'Scarlett', 'Johansson'),
(57, 'Robert', 'Downey Jr.'),
(58, 'Meryl', 'Streep'),
(59, 'Leonardo', 'DiCaprio'),
(60, 'Matthew', 'McConaughey'),
(61, 'Christian', 'Bale'),
(62, 'Al', 'Pacino'),
(63, 'Russell', 'Crowe'),
(64, 'Leonardo', 'DiCaprio'),
(65, 'Heath', 'Ledger'),
(66, 'Cillian', 'Murphy'),
(67, 'Michael', 'Caine'),
(68, 'Tom', 'Hanks'),
(69, 'Wesley', 'Snipes'),
(70, 'Jim', 'Carrey'),
(71, 'Jack', 'Gyllenhaal'),
(72, 'Kim', 'Kardashian'),
(73, 'Margaux', 'Godard'),
(74, 'Théophile', 'Fournier'),
(75, 'Roger', 'Normand'),
(76, 'Michelle', 'Gaillard'),
(77, 'François', 'Bernier'),
(78, 'Thierry', 'Guillou'),
(79, 'Robert', 'Gallet'),
(80, 'Théodore', 'Fernandes'),
(81, 'François', 'Lebreton'),
(82, 'Émile', 'Normand'),
(83, 'Théophile', 'Tessier'),
(84, 'Gilbert', 'Bigot'),
(85, 'Renée', 'Laporte'),
(86, 'Yves', 'Boyer'),
(87, 'Stéphane', 'Gaillard'),
(88, 'Gérard', 'Navarro'),
(89, 'Maryse', 'Bailly'),
(90, 'Marc', 'De Sousa'),
(91, 'Gabrielle', 'Barbier'),
(92, 'Sébastien', 'Coste');

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `art_work_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `credit_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`id`, `actor_id`, `art_work_id`, `role`, `credit_order`) VALUES
(1, 74, 1, 'Amelie Poulain', 1),
(2, 90, 1, 'Rocky Balboa', 2),
(3, 85, 1, 'Mary Poppins', 3),
(4, 65, 2, 'Robin Scherbatsky', 1),
(5, 79, 2, 'Regina George', 2),
(6, 84, 2, 'Sarah Connor', 3),
(7, 92, 2, 'Lou Bloom', 4),
(8, 86, 2, 'Dick Hallorann', 5),
(9, 91, 2, 'Rorschach', 6),
(10, 78, 2, 'Inigo Montoya', 7),
(11, 64, 2, 'Padme Amidala', 8),
(12, 86, 2, 'Jim Halpert', 9),
(13, 52, 2, 'Monica Geller', 10),
(14, 89, 3, 'Elastigirl', 1),
(15, 52, 3, 'Mr Brown', 2),
(16, 68, 3, 'Rorschach', 3),
(17, 69, 3, 'Rose DeWitt Bukater', 4),
(18, 55, 3, 'James Bond', 5),
(19, 54, 3, 'Jim Gordon', 6),
(20, 65, 3, 'Matt Jamison', 7),
(21, 58, 3, 'Furiosa', 8),
(22, 50, 3, 'Ethan Hunt', 9),
(23, 70, 4, 'Daenerys Targaryen', 1),
(24, 58, 4, 'Indiana Jones', 2),
(25, 87, 4, 'Ash', 3),
(26, 77, 4, 'Lando Calrissian', 4),
(27, 92, 4, 'Daisy Domergue', 5),
(28, 87, 4, 'Gabrielle Solis', 6),
(29, 55, 4, 'Panoramix', 7),
(30, 71, 5, 'R2-D2', 1),
(31, 50, 5, 'Katniss Everdeen', 2),
(32, 72, 6, 'Bella Swan', 1),
(33, 65, 6, 'David Mills', 2),
(34, 73, 6, 'Rey', 3),
(35, 48, 6, 'Selina Meyer', 4),
(36, 75, 6, 'Count Doku', 5),
(37, 70, 6, 'Lando Calrissian', 6),
(38, 65, 6, 'Jackie Brown', 7),
(39, 90, 7, 'Mystique', 1),
(40, 70, 7, 'Joseph Cooper', 2),
(41, 57, 7, 'Vincent Vega', 3),
(42, 61, 7, 'Vito Corleone', 4),
(43, 80, 7, 'Anastasia Steele', 5),
(44, 53, 8, 'Ethan Hunt', 1),
(45, 58, 8, 'Alfred Pennyworth', 2),
(46, 53, 8, 'Ron Burgundy', 3),
(47, 83, 9, 'Bill', 1),
(48, 88, 9, 'Tom Garvey', 2),
(49, 78, 9, 'Jessica Jones', 3),
(50, 92, 9, 'Xena', 4),
(51, 89, 9, 'Sergeant Hartman', 5),
(52, 78, 9, 'Phyllis Lapin', 6),
(53, 66, 10, 'Anastasia Steele', 1),
(54, 89, 10, 'Katniss Everdeen', 2),
(55, 52, 10, 'Morpheus', 3),
(56, 54, 10, 'Cher', 4),
(57, 86, 10, 'Ozymandias', 5),
(58, 75, 11, 'Woody', 1),
(59, 76, 11, 'Laurie Garvey', 2),
(60, 63, 11, 'Gandalf', 3),
(61, 60, 11, 'Claire Bennet', 4),
(62, 47, 11, 'Mr White', 5),
(63, 75, 11, 'Annalise Keating', 6),
(64, 62, 11, 'Padme Amidala', 7),
(65, 88, 12, 'Jake Sully', 1),
(66, 82, 12, 'Ash', 2),
(67, 72, 12, 'Bruce Wayne', 3),
(68, 59, 12, 'Count Doku', 4),
(69, 69, 12, 'Katniss Everdeen', 5),
(70, 68, 12, 'Marco the Mexican', 6),
(71, 51, 13, 'Hubert Bonisseur de la Bath', 1),
(72, 65, 13, 'Lou Bloom', 2),
(73, 85, 13, 'Darth Vader', 3),
(74, 49, 13, 'Rue Bennett', 4),
(75, 51, 13, 'Miranda Hobbes', 5),
(76, 76, 13, 'Peter Venkman', 6),
(77, 76, 13, 'Xena', 7),
(78, 69, 13, 'Furiosa', 8),
(79, 81, 13, 'Andy Bernard', 9),
(80, 54, 13, 'Bree Van de Kamp', 10),
(81, 79, 14, 'Rick Deckard', 1),
(82, 56, 14, 'Joseph Cooper', 2),
(83, 64, 14, 'Eleven', 3),
(84, 82, 14, 'Truman', 4),
(85, 84, 14, 'William Wallace', 5),
(86, 83, 14, 'Claire Underwood', 6),
(87, 68, 15, 'Tommy DeVito', 1),
(88, 65, 15, 'Rorschach', 2),
(89, 49, 15, 'Walt Kowalski', 3),
(90, 90, 15, 'Phoebe Buffay', 4),
(91, 59, 16, 'Odile Deray', 1),
(92, 49, 16, 'Joe Gage', 2),
(93, 91, 16, 'Margaery Tyrell', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(9, 'France'),
(10, 'USA'),
(11, 'Canada'),
(12, 'Italie'),
(13, 'Espagne'),
(14, 'Portugal'),
(15, 'Brésil'),
(16, 'Bénin');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241007104134', '2024-10-07 10:41:43', 2560);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(17, 'Action'),
(18, 'Animation'),
(19, 'Aventure'),
(20, 'Comédie'),
(21, 'Dessin animé'),
(22, 'Documentaire'),
(23, 'Drame'),
(24, 'Espionnage'),
(25, 'Famille'),
(26, 'Fantastique'),
(27, 'Historique'),
(28, 'Policier'),
(29, 'Romance'),
(30, 'Science-fiction'),
(31, 'Thriller'),
(32, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `duration` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `name`
--

CREATE TABLE `name` (
  `id` int(11) NOT NULL,
  `string` varchar(255) DEFAULT NULL,
  `actor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `person_movie`
--

CREATE TABLE `person_movie` (
  `person_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `art_work_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `rating` double DEFAULT NULL,
  `reactions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`reactions`)),
  `watched_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `art_work_id`, `user_id`, `content`, `rating`, `reactions`, `watched_at`) VALUES
(1, 1, 8, 'Pizza CalzoneMagnam aut sit qui recusandae quidem est.', 3, '[\"sleep\",\"cry\",\"smile\",\"think\",\"laugh\"]', '1929-04-08 21:09:22'),
(2, 1, 8, 'Pizza ForestièreOdio praesentium expedita est et molestiae.', 0, '[\"sleep\",\"smile\",\"think\"]', '1976-04-24 17:09:51'),
(3, 1, 9, 'Pizza NapolitaineConsequuntur dolore dolor accusantium veniam.', 1, '[\"cry\",\"laugh\",\"smile\"]', '1965-04-29 10:19:40'),
(4, 1, 9, 'Pizza CapricciosaRepudiandae ut ut laborum sunt nobis illo et sit.', 4, '[\"laugh\",\"smile\"]', '2003-12-22 11:19:29'),
(5, 1, 6, 'Pizza Quatre SaisonsCommodi vel occaecati incidunt aliquam.', 3, '[\"think\",\"laugh\",\"sleep\",\"smile\",\"cry\"]', '2018-05-04 02:17:40'),
(6, 3, 6, 'Pizza NapolitaineRepellat repudiandae provident sunt esse.', 5, '[\"think\",\"cry\",\"smile\"]', '2013-06-14 09:50:58'),
(7, 3, 8, 'Pizza SicilienneAtque sunt esse placeat placeat et vel.', 4, '[\"laugh\",\"sleep\",\"cry\",\"think\"]', '2011-09-21 15:30:30'),
(8, 4, 10, 'Pizza NormandeVelit aut ut dolorum.', 4, '[\"cry\",\"smile\"]', '2003-06-07 21:17:11'),
(9, 4, 6, 'Pizza PérigourdineExpedita hic qui ipsa cumque ab.', 0, '[\"smile\",\"cry\",\"sleep\",\"laugh\"]', '2013-01-12 17:20:27'),
(10, 4, 8, 'Pizza HawaïennePlaceat ut quae veniam laudantium ad.', 0, '[\"smile\",\"think\"]', '1940-04-25 07:07:10'),
(11, 4, 8, 'Pizza AlsacienneRerum aut ipsam adipisci molestiae.', 2, '[\"smile\",\"cry\",\"laugh\",\"sleep\",\"think\"]', '1965-08-01 08:12:18'),
(12, 5, 6, 'Pizza PepperoniVel modi rerum et totam neque possimus sed.', 4, '[\"laugh\",\"smile\",\"sleep\",\"cry\"]', '1928-10-30 08:23:34'),
(13, 5, 6, 'Pizza AlsacienneAccusamus labore voluptates reprehenderit.', 0, '[\"smile\"]', '1926-08-06 10:17:46'),
(14, 5, 9, 'Pizza ParmigianaQuae quis consectetur ipsum sed illo tempore vel.', 2, '[\"sleep\",\"smile\"]', '1969-04-10 10:21:54'),
(15, 6, 8, 'Pizza SavoyardeEt vel ad autem non ipsam enim.', 4, '[\"smile\",\"sleep\",\"think\",\"laugh\"]', '1980-05-26 04:23:52'),
(16, 6, 8, 'Pizza ReineEnim consequatur non autem dolorem.', 4, '[\"laugh\",\"sleep\",\"smile\",\"think\"]', '1992-10-20 12:21:28'),
(17, 6, 9, 'Pizza Quatre SaisonsEsse minus iure similique quis neque sint sunt.', 1, '[\"laugh\",\"cry\",\"smile\",\"sleep\"]', '1995-10-26 06:14:56'),
(18, 6, 9, 'Pizza BolognaiseTempore dolor rerum et.', 3, '[\"sleep\"]', '2012-10-05 14:29:09'),
(19, 6, 9, 'Pizza MargheritaQuod enim dignissimos quos ut.', 1, '[\"sleep\"]', '1992-12-23 16:57:52'),
(20, 7, 7, 'Pizza NormandeTenetur minus architecto suscipit iusto.', 0, '[\"laugh\",\"smile\",\"cry\",\"think\"]', '1929-07-13 14:53:01'),
(21, 7, 7, 'Pizza DiavolaNon debitis nobis consectetur delectus voluptas.', 3, '[\"think\",\"smile\",\"sleep\",\"cry\"]', '1930-08-05 00:29:25'),
(22, 7, 9, 'Pizza RusticaIn quibusdam alias quia voluptas enim cum quia.', 2, '[\"laugh\",\"sleep\",\"think\"]', '1937-06-13 11:01:57'),
(23, 7, 9, 'Pizza RusticaMolestiae quod voluptatem earum optio.', 1, '[\"smile\",\"sleep\"]', '2013-04-09 00:55:42'),
(24, 7, 6, 'Pizza CalzoneEt atque vitae sed.', 5, '[\"think\",\"cry\",\"sleep\"]', '1967-04-04 05:19:46'),
(25, 8, 9, 'Pizza ReineConsectetur et maiores sunt voluptas ipsa.', 1, '[\"sleep\",\"cry\",\"laugh\"]', '2006-06-19 10:45:35'),
(26, 8, 7, 'Pizza Fruits de MerNemo eos accusantium quasi.', 3, '[\"cry\",\"laugh\",\"sleep\"]', '2007-08-18 12:18:43'),
(27, 9, 8, 'Pizza Quatre SaisonsUt ab et perferendis sint fuga quos.', 4, '[\"sleep\",\"smile\",\"think\"]', '1992-04-11 18:55:27'),
(28, 9, 7, 'Pizza CapricciosaDolorem consequatur enim ut consequatur.', 2, '[\"sleep\",\"cry\",\"think\",\"laugh\"]', '2011-05-12 13:24:54'),
(29, 9, 6, 'Pizza Fruits de MerEst veniam eligendi labore quos nesciunt.', 5, '[\"smile\",\"cry\",\"laugh\",\"sleep\",\"think\"]', '2012-07-25 13:00:01'),
(30, 9, 7, 'Pizza HawaïenneSequi ipsam corporis reprehenderit.', 2, '[\"laugh\",\"cry\",\"smile\"]', '1955-10-04 03:52:36'),
(31, 9, 10, 'Pizza OrientaleDolores laborum eos quia officiis nam dolorum.', 0, '[\"sleep\",\"cry\",\"laugh\",\"think\",\"smile\"]', '1950-07-31 03:05:10'),
(32, 10, 8, 'Pizza VégétarienneQuisquam neque distinctio voluptatem id quo unde.', 2, '[\"sleep\",\"laugh\",\"cry\",\"think\",\"smile\"]', '2003-02-07 01:44:02'),
(33, 10, 7, 'Pizza MargheritaSit qui et adipisci ea ipsum ratione cumque sed.', 0, '[\"think\",\"laugh\",\"cry\",\"smile\"]', '1987-08-28 23:05:48'),
(34, 10, 9, 'Pizza IndienneNihil nihil voluptatem est accusamus velit.', 4, '[\"think\",\"cry\",\"smile\",\"laugh\",\"sleep\"]', '1926-01-10 01:17:06'),
(35, 10, 9, 'Pizza CapricciosaOptio occaecati omnis natus dolores quia.', 1, '[\"laugh\",\"think\",\"smile\",\"sleep\"]', '1978-12-25 13:26:47'),
(36, 10, 8, 'Pizza ParmigianaNesciunt sit non sit.', 1, '[\"smile\",\"sleep\",\"think\"]', '2003-02-12 18:28:53'),
(37, 13, 10, 'Pizza NormandeEst explicabo dolores qui qui saepe.', 5, '[\"cry\",\"think\",\"laugh\",\"smile\"]', '1982-03-13 00:58:24'),
(38, 13, 6, 'Pizza MexicaineAliquam quis laborum et vel.', 2, '[\"sleep\",\"think\"]', '1931-05-03 06:44:27'),
(39, 13, 9, 'Pizza SicilienneNulla fugiat officiis a aut quaerat.', 4, '[\"think\",\"sleep\",\"laugh\"]', '1959-06-23 09:47:39'),
(40, 13, 8, 'Pizza ReineDolorem quo expedita consequatur dolorum.', 3, '[\"sleep\",\"smile\"]', '1927-04-24 21:01:11'),
(41, 13, 8, 'Pizza SavoyardeSequi veritatis distinctio saepe labore vel.', 0, '[\"cry\"]', '1955-11-12 12:18:41'),
(42, 14, 9, 'Pizza HawaïenneDolorum maxime sit explicabo nam vel.', 0, '[\"smile\",\"cry\",\"laugh\",\"think\"]', '1934-12-19 21:45:02'),
(43, 14, 10, 'Pizza KebabIste vitae accusamus accusantium odit.', 1, '[\"think\"]', '1986-09-09 05:55:35'),
(44, 15, 7, 'Pizza CalzoneEnim possimus doloribus natus dolores.', 2, '[\"sleep\",\"cry\",\"smile\"]', '1962-05-17 16:00:37'),
(45, 15, 10, 'Pizza PepperoniCulpa consequatur qui doloribus molestiae.', 1, '[\"sleep\",\"laugh\",\"smile\",\"cry\"]', '1965-05-24 11:22:34'),
(46, 15, 9, 'Pizza BolognaiseMaiores rerum ea rerum minus at.', 3, '[\"smile\",\"laugh\",\"cry\",\"sleep\"]', '1930-01-21 13:28:49'),
(47, 15, 10, 'Pizza TartifletteEum tempore qui perspiciatis.', 2, '[\"smile\"]', '1991-04-05 14:08:34'),
(48, 16, 6, 'Pizza VégétariennePerferendis eaque facilis magni aperiam quis.', 0, '[\"think\",\"cry\"]', '2002-01-24 07:36:45'),
(49, 16, 10, 'Pizza Chèvre MielSed porro quis enim sed.', 5, '[\"smile\",\"think\",\"sleep\"]', '1943-05-21 23:46:52'),
(50, 16, 10, 'Pizza CalzoneRecusandae error quis id est quo hic odio.', 2, '[\"sleep\",\"cry\"]', '2000-09-10 16:36:05');

-- --------------------------------------------------------

--
-- Structure de la table `season`
--

CREATE TABLE `season` (
  `id` int(11) NOT NULL,
  `tv_show_id` int(11) NOT NULL,
  `number` smallint(6) NOT NULL,
  `episode_count` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `season`
--

INSERT INTO `season` (`id`, `tv_show_id`, `number`, `episode_count`) VALUES
(1, 16, 1, 23),
(2, 16, 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `show`
--

CREATE TABLE `show` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `released_at` date DEFAULT NULL COMMENT '(DC2Type:date_immutable)',
  `poster` varchar(255) DEFAULT NULL,
  `duration` smallint(6) DEFAULT NULL,
  `summary` longtext NOT NULL,
  `synopsis` longtext DEFAULT NULL,
  `rating` double NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `show`
--

INSERT INTO `show` (`id`, `type_id`, `title`, `released_at`, `poster`, `duration`, `summary`, `synopsis`, `rating`, `slug`) VALUES
(1, 4, 'Matrix', '1999-01-01', '', 15, 'Neo dans la matrice', 'Pillule bleue ou pillule rouge', 5, 'matrix'),
(2, 4, 'Usual Suspects', '1995-01-01', '', 106, 'Keyser Söze', 'Interrogé par la police à la suite de l\\\'explosion criminelle d\\\'un cargo, Verbal Kint se met à table : avec quatre autres gangsters, il s\'est vu imposer une mission périlleuse par Keyser Söze, un malfrat craint de tous mais que personne ne connaît. Qui est ce mystérieux commanditaire ? Existe-t-il vraiment ?', 5, 'usual-suspects'),
(3, 4, 'The Matrix Reloaded', '2003-05-15', '', 138, 'Neo continues his fight against the machines.', 'Neo and his allies race against time to unlock the secrets of the Matrix.', 4, 'the-matrix-reloaded'),
(4, 4, 'Le Fils du Mask', '2005-03-23', '', 15, 'Tim Avery, un dessinateur qui n\'est pas prêt à être père, se retrouve contraint d\'élever un bébé. Les pouvoirs que lui confère le masque de Loki lui permettront de mener à bien cette mission.', 'La suite vraiment naze de The Mask', 0, 'le-fils-du-mask'),
(5, 4, 'TC2000', '1993-01-01', '', 15, 'Jason Storm, un gardien des territoires souterrain', 'Un banger !', 0, 'tc2000'),
(6, 4, 'Yes Man', '2009-01-21', '', 103, 'Carl découvre avec éblouissement le pouvoir magique du \"Yes\"', 'Le mieux peut être l\'ennemi du bien, Carl va t il faire le bon choix?', 4, 'yes-man'),
(7, 4, 'The Matrix Revolutions', '2003-11-05', '', 129, 'The final battle for the fate of humanity.', 'Neo faces his ultimate challenge as he battles against the machine army to save Zion.', 3.5, 'the-matrix-revolutions'),
(8, 4, '    Cars', '2006-06-14', 'https://fr.web.img6.acsta.net/pictures/17/04/12/14/42/499210.jpg', 60, 'la course de Cars ', 'la voiture rouge', 4, 'cars'),
(9, 4, 'Star Wars - Nouvel Espoir', '1977-01-01', '', 120, 'Je suis ton pere', 'Galaxy lointaine, très lointaine', 5, 'star-wars-nouvel-espoir'),
(10, 4, 'Top Gun: Maverick', '2022-01-01', 'https://fr.web.img3.acsta.net/pictures/22/03/29/15/12/0827894.jpg', 131, 'Le retour de Maverick', 'Après plus de 30 ans de service en tant que l\'un des meilleurs aviateurs de la Marine, Pete \"Maverick\" Mitchell est à sa place, repoussant les limites en tant que pilote d\'essai courageux et esquivant l\'avancement de grade qui le mettrait à la terre. Entraînant de jeunes diplômés pour une mission spéciale, Maverick doit affronter les fantômes de son passé et ses peurs les plus profondes, aboutissant à une mission qui exige le sacrifice ultime de ceux qui choisissent de la piloter.', 5, 'top-gun-maverick'),
(11, 4, 'Le Mans 66', '2019-08-30', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/10/14/09/06/5193325.jpg', 153, 'La course des 24h du Mans 1966', 'Basé sur une histoire vraie, le film suit une équipe d\'excentriques ingénieurs américains menés par le visionnaire Carroll Shelby et son pilote britannique Ken Miles, qui sont envoyés par Henry Ford II pour construire à partir de rien une nouvelle automobile qui doit détrôner la Ferrari à la compétition du Mans de 1966.', 4.3, 'le-mans-66'),
(12, 4, 'Les Visiteurs', '1993-01-01', '', 107, 'Les couloirs du temps ', 'le vieux temps ', 5, 'les-visiteurs'),
(13, 4, 'Brice de nice', '2005-05-06', '', 98, 'Brice', 'Surfe sur la vague', 2, 'brice-de-nice'),
(14, 4, 'Menteur Menteur', '1997-03-21', '', 86, 'Un avocat, maudit pour dire la vérité pendant 24 heures.', 'Fletcher Reede, un avocat volubile, se retrouve incapable de mentir pendant 24 heures à cause du vœu d’anniversaire de son fils.', 4.5, 'menteur-menteur'),
(15, 4, 'American Beauty', '2000-02-02', '', 122, 'La vie de Lester Burnhamm', 'Une maison de rêve, un pavillon bourgeois discrètement cossu dissimule dans une banlieue résidentielle, c\'est ici que résident Lester Burnhamm, sa femme Carolyn et leur fille Jane. L\'agitation du monde et sa violence semblent bien loin ici. Mais derrière cette respectable façade se tisse une étrange et grinçante tragi-comédie familiale ou désirs inavoués, frustrations et violences refoulées conduiront inexorablement un homme vers la mort', 5, 'american-beauty'),
(16, 3, 'Vikings', '2024-10-07', '', 66, 'Battle of the thrones.', 'Vikings', 5, 'vikings');

-- --------------------------------------------------------

--
-- Structure de la table `show_country`
--

CREATE TABLE `show_country` (
  `show_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `show_country`
--

INSERT INTO `show_country` (`show_id`, `country_id`) VALUES
(1, 9),
(1, 12),
(1, 13),
(1, 16),
(2, 10),
(2, 15),
(2, 16),
(3, 12),
(3, 15),
(4, 9),
(4, 15),
(4, 16),
(5, 9),
(5, 14),
(5, 16),
(6, 9),
(6, 11),
(6, 12),
(7, 9),
(7, 11),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 15),
(8, 16),
(9, 10),
(10, 9),
(10, 12),
(10, 13),
(10, 14),
(10, 15),
(10, 16),
(11, 9),
(11, 12),
(11, 13),
(11, 15),
(11, 16),
(12, 9),
(12, 10),
(12, 11),
(12, 13),
(12, 15),
(13, 9),
(13, 13),
(13, 14),
(13, 15),
(14, 12),
(14, 15),
(15, 10),
(15, 11),
(15, 13),
(15, 14),
(15, 15),
(15, 16),
(16, 10),
(16, 11),
(16, 12),
(16, 14),
(16, 16);

-- --------------------------------------------------------

--
-- Structure de la table `show_genre`
--

CREATE TABLE `show_genre` (
  `show_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `show_genre`
--

INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES
(1, 31),
(2, 18),
(2, 19),
(2, 20),
(2, 22),
(2, 24),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 32),
(3, 17),
(3, 19),
(3, 20),
(3, 22),
(3, 24),
(3, 25),
(3, 26),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(4, 25),
(4, 28),
(5, 17),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 31),
(5, 32),
(6, 17),
(6, 18),
(6, 21),
(6, 22),
(6, 24),
(6, 25),
(6, 27),
(6, 31),
(6, 32),
(7, 18),
(7, 21),
(7, 22),
(7, 26),
(7, 28),
(7, 32),
(8, 18),
(8, 20),
(8, 21),
(8, 22),
(8, 23),
(8, 24),
(8, 26),
(8, 30),
(8, 31),
(9, 19),
(9, 24),
(9, 30),
(10, 21),
(10, 22),
(11, 17),
(11, 18),
(11, 20),
(11, 21),
(11, 23),
(11, 24),
(11, 28),
(11, 29),
(11, 30),
(11, 32),
(12, 17),
(12, 24),
(12, 28),
(12, 31),
(13, 17),
(13, 18),
(13, 21),
(13, 22),
(13, 26),
(13, 27),
(13, 29),
(13, 31),
(13, 32),
(14, 26),
(14, 29),
(15, 18),
(15, 19),
(15, 23),
(15, 25),
(15, 27),
(15, 32),
(16, 19),
(16, 22),
(16, 25),
(16, 29),
(16, 30);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `destination` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `next_departure` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trip_country`
--

CREATE TABLE `trip_country` (
  `trip_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trip_tag`
--

CREATE TABLE `trip_tag` (
  `trip_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(3, 'Série'),
(4, 'Film');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`) VALUES
(6, 'admin@oflix.fr', '[\"ROLE_ADMIN\"]', '$2y$13$5H6PatkwSGz/lFh68QHCP.nkl11aZCdBj/JO0...U/V2YtjGynBua', 'admin'),
(7, 'manager@oflix.fr', '[\"ROLE_MANAGER\"]', '$2y$13$U4oPJRsZzuQ0vKuv7jXDPeVSJ8VtLC1rVVWteK9qZR0NjlPQZc8Xi', 'manager'),
(8, 'user@oflix.fr', '[\"ROLE_USER\"]', '$2y$13$Wa4wahavITIy2gBaHNRP2.Nn9ArB0H9bOunUYbcgLyv8bxLCFsUZe', 'user'),
(9, 'julien@oflix.fr', '[\"ROLE_USER\"]', '$2y$13$yzUib2Q1LkrYQB1Fy6odXOkQ86mSDu4tGGD87/9nvNoriGHYXrrlC', 'julien'),
(10, 'virginie@oflix.fr', '[\"ROLE_USER\"]', '$2y$13$xFXpUf0go0l8L9n2yXBItetnmwUCFtIrNMb2XLW1YekAzebX1t8KG', 'virginie');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D11BBA5010DAF24A` (`actor_id`),
  ADD KEY `IDX_D11BBA50F7052A7` (`art_work_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA5BC2E0E` (`trip_id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `name`
--
ALTER TABLE `name`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `person_movie`
--
ALTER TABLE `person_movie`
  ADD PRIMARY KEY (`person_id`,`movie_id`),
  ADD KEY `IDX_B168EDAB217BBB47` (`person_id`),
  ADD KEY `IDX_B168EDAB8F93B6FC` (`movie_id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C6F7052A7` (`art_work_id`),
  ADD KEY `IDX_794381C6A76ED395` (`user_id`);

--
-- Index pour la table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F0E45BA95E3A35BB` (`tv_show_id`);

--
-- Index pour la table `show`
--
ALTER TABLE `show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_320ED901C54C8C93` (`type_id`);

--
-- Index pour la table `show_country`
--
ALTER TABLE `show_country`
  ADD PRIMARY KEY (`show_id`,`country_id`),
  ADD KEY `IDX_3421E485D0C1FC64` (`show_id`),
  ADD KEY `IDX_3421E485F92F3E70` (`country_id`);

--
-- Index pour la table `show_genre`
--
ALTER TABLE `show_genre`
  ADD PRIMARY KEY (`show_id`,`genre_id`),
  ADD KEY `IDX_81E15724D0C1FC64` (`show_id`),
  ADD KEY `IDX_81E157244296D31F` (`genre_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trip_country`
--
ALTER TABLE `trip_country`
  ADD PRIMARY KEY (`trip_id`,`country_id`),
  ADD KEY `IDX_659F8CCBA5BC2E0E` (`trip_id`),
  ADD KEY `IDX_659F8CCBF92F3E70` (`country_id`);

--
-- Index pour la table `trip_tag`
--
ALTER TABLE `trip_tag`
  ADD PRIMARY KEY (`trip_id`,`tag_id`),
  ADD KEY `IDX_8F404E39A5BC2E0E` (`trip_id`),
  ADD KEY `IDX_8F404E39BAD26311` (`tag_id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT pour la table `casting`
--
ALTER TABLE `casting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `name`
--
ALTER TABLE `name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `season`
--
ALTER TABLE `season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `show`
--
ALTER TABLE `show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `FK_D11BBA5010DAF24A` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`),
  ADD CONSTRAINT `FK_D11BBA50F7052A7` FOREIGN KEY (`art_work_id`) REFERENCES `show` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `person_movie`
--
ALTER TABLE `person_movie`
  ADD CONSTRAINT `FK_B168EDAB217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B168EDAB8F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_794381C6F7052A7` FOREIGN KEY (`art_work_id`) REFERENCES `show` (`id`);

--
-- Contraintes pour la table `season`
--
ALTER TABLE `season`
  ADD CONSTRAINT `FK_F0E45BA95E3A35BB` FOREIGN KEY (`tv_show_id`) REFERENCES `show` (`id`);

--
-- Contraintes pour la table `show`
--
ALTER TABLE `show`
  ADD CONSTRAINT `FK_320ED901C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `show_country`
--
ALTER TABLE `show_country`
  ADD CONSTRAINT `FK_3421E485D0C1FC64` FOREIGN KEY (`show_id`) REFERENCES `show` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3421E485F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `show_genre`
--
ALTER TABLE `show_genre`
  ADD CONSTRAINT `FK_81E157244296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_81E15724D0C1FC64` FOREIGN KEY (`show_id`) REFERENCES `show` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `trip_country`
--
ALTER TABLE `trip_country`
  ADD CONSTRAINT `FK_659F8CCBA5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_659F8CCBF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `trip_tag`
--
ALTER TABLE `trip_tag`
  ADD CONSTRAINT `FK_8F404E39A5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8F404E39BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
