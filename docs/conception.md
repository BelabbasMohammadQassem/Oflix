# Toute la conception d'oflix

## MCD

```raw
:
:
Actor: actor code, actor name
:

:
:
is played by, 1N Show, 0N Actor: character name
Country: country name

Type: type name
has type, 11 Show, 0N Type
Show: show code, title, release_year, poster, duration, summary, synopsis, rating 
produced in, 1N Show, 0N Country

:
:
has genre, 1N Show, 0N Genre
Genre: genre name
```

## MLD

```raw
Actor (_Actor Code_, Actor Name)
Casting (_#Actor Code_, _#Show Code_, character name)
Country(_country name_)
Genre (_genre name_)
HasGenre (_#Genre_, _#Show_)
Show (_show code_, title, release_year, poster, duration, summary, synopsis, rating, #type name, #country code)
Type (_type name_)
```

## MPD

```sql
DROP TABLE IF EXISTS `show_actor`;
DROP TABLE IF EXISTS `show_country`;
DROP TABLE IF EXISTS `show_genre`;
DROP TABLE IF EXISTS `show`;
DROP TABLE IF EXISTS `actor`;
DROP TABLE IF EXISTS `country`;
DROP TABLE IF EXISTS `genre`;
DROP TABLE IF EXISTS `type`;


CREATE TABLE `actor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) NOT NULL
);

CREATE TABLE `country` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(200) NOT NULL
);

CREATE TABLE `genre` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL
);

CREATE TABLE `type` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(10) NOT NULL
);

CREATE TABLE `show` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL,
  `release_year` datetime NOT NULL,
  `poster` varchar(255) NULL,
  `duration` smallint unsigned NULL,
  `summary` tinytext not null,
  `synopsis` longtext not null,
  `rating` float unsigned NOT NULL,
  `type_id` int unsigned NOT NULL
);

CREATE TABLE `show_actor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `show_id` int unsigned NOT NULL,
  `actor_id` int unsigned NOT NULL,
  `character_name` varchar(255) NOT NULL
);

CREATE TABLE `show_country` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `show_id` int unsigned NOT NULL,
  `country_id` int unsigned NOT NULL
);

CREATE TABLE `show_genre` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `show_id` int unsigned NOT NULL,
  `genre_id` int unsigned NOT NULL
);

ALTER TABLE `show` ADD FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
ALTER TABLE `show_actor` ADD FOREIGN KEY (`show_id`) REFERENCES `show` (`id`);
ALTER TABLE `show_actor` ADD FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`);

ALTER TABLE `show_country` ADD FOREIGN KEY (`show_id`) REFERENCES `show` (`id`);
ALTER TABLE `show_country` ADD FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

ALTER TABLE `show_genre` ADD FOREIGN KEY (`show_id`) REFERENCES `show` (`id`);
ALTER TABLE `show_genre` ADD FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);


INSERT INTO `actor` (`name`) VALUES ('Keanu Reeves');
INSERT INTO `actor` (`name`) VALUES ('Laurence Fishburne');
INSERT INTO `actor` (`name`) VALUES ('Carrie-Anne Moss');
INSERT INTO `actor` (`name`) VALUES ('Hugo Weaving');
INSERT INTO `actor` (`name`) VALUES ('Joe Pantoliano');
INSERT INTO `actor` (`name`) VALUES 
('Robert De Niro'),
('Al Pacino'),
('Meryl Streep'),
('Leonardo DiCaprio'),
('Tom Hanks');

INSERT INTO `genre` (`name`) VALUES ('Action');
INSERT INTO `genre` (`name`) VALUES ('Science Fiction');
INSERT INTO `genre` (`name`) VALUES ('Thriller');
INSERT INTO `genre` (`name`) VALUES ('Adventure');
INSERT INTO `genre` (`name`) VALUES ('Fantasy');

INSERT INTO `country` (`name`) VALUES ('France');
INSERT INTO `country` (`name`) VALUES ('Allemagne');
INSERT INTO `country` (`name`) VALUES ('Italie');
INSERT INTO `country` (`name`) VALUES ('USA');
INSERT INTO `country` (`name`) VALUES ('Thaïlande');

INSERT INTO `type` (`name`) VALUES ('Film');
INSERT INTO `type` (`name`) VALUES ('Série');

INSERT INTO `show` (`title`, `release_year`, `poster`, `duration`, `summary`, `synopsis`, `rating`, `type_id`) VALUES 
('1001 pates', '2000-01-01', 'https://picsum.photos/200/300', 200, 'Krung Thep Mahanakhon Amon', 'Krung Thep Mahanakhon Amon Rattanakosin Mahinthara Ayuthaya Mahadilok Phop Noppharat Ratchathani Burirom Udomratchaniwet Mahasathan Amon Piman Awatan Sathit Sakkathattiya Witsanukam Prasit', 3, 1),
 ('Matrix', '1999-03-31', 'https://m.media-amazon.com/images/I/71x7df0yZdL._AC_UF1000,1000_QL80_.jpg', 136, 'A computer hacker learns about the true nature of his reality.', 'In a dystopian future, humanity is unknowingly trapped inside a simulated reality.', 5, 1),
  ('Matrix - la série', '2009-03-31', 'https://m.media-amazon.com/images/I/71x7df0yZdL._AC_UF1000,1000_QL80_.jpg', 136, 'A computer hacker learns about the true nature of his reality.', 'In a dystopian future, humanity is unknowingly trapped inside a simulated reality.', 4.5, 2)
;

INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (2, 1, 'Néo');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (2, 2, 'Morphéus');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (2, 3, 'Trinity');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (2, 4, 'Agent Smith');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (2, 5, 'Cypher');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (1, 6, 'La reine');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (1, 7, 'Le ver de terre');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (1, 8, 'Le papillon');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (1, 9, 'La coccinelle');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (3, 1, 'Néo');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (3, 2, 'Morphéus');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (3, 3, 'Trinity');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (3, 4, 'Agent Smith');
INSERT INTO `show_actor` (`show_id`, `actor_id`, `character_name`) VALUES (3, 5, 'Cypher');


INSERT INTO `show_country` (`show_id`, `country_id`) VALUES (1, 4);
INSERT INTO `show_country` (`show_id`, `country_id`) VALUES (1, 5);
INSERT INTO `show_country` (`show_id`, `country_id`) VALUES (2, 4);
INSERT INTO `show_country` (`show_id`, `country_id`) VALUES (3, 4);

INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (1, 4);
INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (1, 5);
INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (2, 1);
INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (2, 2);
INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (2, 4);
INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (3, 4);
INSERT INTO `show_genre` (`show_id`, `genre_id`) VALUES (3, 5);

```