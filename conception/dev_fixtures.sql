-- Adminer 4.8.1 MySQL 10.3.39-MariaDB-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526CA5BC2E0E` (`trip_id`),
  CONSTRAINT `FK_9474526CA5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comment` (`id`, `user_id`, `trip_id`, `rating`, `content`) VALUES
(1,	20,	2,	2,	'commentaire 1'),
(2,	20,	3,	2,	'commentaire 2'),
(3,	22,	3,	3,	'commentaire 1'),
(4,	19,	4,	1,	'commentaire 3'),
(5,	21,	4,	2,	'commentaire 2'),
(6,	19,	4,	1,	'commentaire 1'),
(7,	22,	5,	1,	'commentaire 5'),
(8,	24,	5,	3,	'commentaire 4'),
(9,	20,	5,	3,	'commentaire 3'),
(10,	22,	5,	3,	'commentaire 2'),
(11,	23,	5,	1,	'commentaire 1');

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `country` (`id`, `name`) VALUES
(15,	'France'),
(16,	'Allemagne'),
(17,	'Italie'),
(18,	'Espagne'),
(19,	'Portugal'),
(20,	'Suisse'),
(21,	'Grèce');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240614074344',	'2024-06-14 07:43:51',	412);

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tag` (`id`, `name`) VALUES
(15,	'sport'),
(16,	'famille'),
(17,	'détente'),
(18,	'plage'),
(19,	'montagne'),
(20,	'randonnée'),
(21,	'nature');

DROP TABLE IF EXISTS `trip`;
CREATE TABLE `trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `destination` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `next_departure` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trip` (`id`, `img`, `name`, `description`, `destination`, `price`, `next_departure`) VALUES
(2,	'https://picsum.photos/id/219/800/600',	'Voyage aux antilles',	'La montagne, la plage, le soleil et le rhum',	'Fort de France',	419,	'2024-06-23 08:22:10'),
(3,	'https://picsum.photos/id/228/800/600',	'Hyper trail',	'10 km ... de denivellé',	'Réunion',	1270,	'2024-06-20 08:22:10'),
(4,	'https://picsum.photos/id/314/800/600',	'Socle PHP',	'Du code, de la musique et de l ananas',	'Titre Pro',	1668,	'2024-06-21 08:22:10'),
(5,	'https://picsum.photos/id/373/800/600',	'Voyage au Groland',	'On vous laisse la surprise',	'Présipauté ',	451,	'2024-07-08 08:22:10');

DROP TABLE IF EXISTS `trip_country`;
CREATE TABLE `trip_country` (
  `trip_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`trip_id`,`country_id`),
  KEY `IDX_659F8CCBA5BC2E0E` (`trip_id`),
  KEY `IDX_659F8CCBF92F3E70` (`country_id`),
  CONSTRAINT `FK_659F8CCBA5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_659F8CCBF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trip_country` (`trip_id`, `country_id`) VALUES
(2,	17),
(2,	18),
(2,	21),
(3,	21),
(4,	18),
(4,	21),
(5,	17),
(5,	19),
(5,	21);

DROP TABLE IF EXISTS `trip_tag`;
CREATE TABLE `trip_tag` (
  `trip_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`trip_id`,`tag_id`),
  KEY `IDX_8F404E39A5BC2E0E` (`trip_id`),
  KEY `IDX_8F404E39BAD26311` (`tag_id`),
  CONSTRAINT `FK_8F404E39A5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8F404E39BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trip_tag` (`trip_id`, `tag_id`) VALUES
(2,	16),
(2,	20),
(2,	21),
(3,	15),
(3,	18),
(3,	21),
(4,	15),
(4,	16),
(4,	20),
(4,	21),
(5,	15),
(5,	20);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `user_name`) VALUES
(17,	'Manu'),
(18,	'JP'),
(19,	'Vivi'),
(20,	'Kév'),
(21,	'Mous'),
(22,	'Nikko'),
(23,	'Clém'),
(24,	'Gwegz');

-- 2024-06-14 08:23:07