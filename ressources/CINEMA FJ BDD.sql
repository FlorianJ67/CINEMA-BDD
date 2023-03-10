-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema_fj
CREATE DATABASE IF NOT EXISTS `cinema_fj` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema_fj`;

-- Listage de la structure de table cinema_fj. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `portrait` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.acteur : ~5 rows (environ)
INSERT INTO `acteur` (`id`, `nom`, `prenom`, `sex`, `date_de_naissance`, `portrait`) VALUES
	(1, 'Lewis', 'Wilson', 'H', '1920-01-28', 'https://upload.wikimedia.org/wikipedia/commons/4/4e/Lewis_wilson.jpg'),
	(2, 'Douglas', 'Croft', 'H', '1926-08-12', 'https://images.findagrave.com/photos250/photos/2008/297/3438702_122486860604.jpg'),
	(3, 'Robert', 'Lowery', 'H', '1913-10-17', NULL),
	(4, 'Johnny', 'Duncan', 'H', '1917-02-23', NULL),
	(5, 'Lambert', 'Hillyer', 'H', '1889-07-08', NULL);

-- Listage de la structure de table cinema_fj. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `film_id` int DEFAULT NULL,
  `acteur_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  KEY `FK_casting_film` (`film_id`),
  KEY `FK_casting_acteur` (`acteur_id`),
  KEY `FK_casting_role` (`role_id`),
  CONSTRAINT `FK_casting_acteur` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`),
  CONSTRAINT `FK_casting_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  CONSTRAINT `FK_casting_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.casting : ~4 rows (environ)
INSERT INTO `casting` (`film_id`, `acteur_id`, `role_id`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(2, 3, 1),
	(2, 4, 2);

-- Listage de la structure de table cinema_fj. film
CREATE TABLE IF NOT EXISTS `film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `realisateur_id` int NOT NULL DEFAULT '0',
  `titre` varchar(50) DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `sortie` date DEFAULT NULL,
  `synopsis` text,
  `note` float DEFAULT NULL,
  `affiche` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_film_realisateur` (`realisateur_id`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.film : ~2 rows (environ)
INSERT INTO `film` (`id`, `realisateur_id`, `titre`, `duree`, `sortie`, `synopsis`, `note`, `affiche`) VALUES
	(1, 1, 'Batman', 132, '1943-02-23', 'Batman et Robin affrontent le Docteur Daka, un espion japonais qui a inventé une machine pouvant contrôler les esprits.', 3.5, 'https://antreducinema.fr/wp-content/uploads/2020/04/BATMAN-scaled.jpg'),
	(2, 2, 'Batman et Robin', 148, '1949-02-23', 'Le professeur Hammil a créé un dispositif qui lui permet de contrôler les véhicules à distance. Son invention est dérobée. Batman et Robin, assistés par la journaliste Vicki Vale, partent à la recherche de cette invention qui est tombée dans de mauvaises mains.', 4, 'https://www.cinemaffiche.fr/508/batman-et-robin.jpg');

-- Listage de la structure de table cinema_fj. filmgenre
CREATE TABLE IF NOT EXISTS `filmgenre` (
  `film_id` int DEFAULT NULL,
  `genre_id` int DEFAULT NULL,
  KEY `FK_film-genre_film` (`film_id`),
  KEY `FK_film-genre_genre` (`genre_id`),
  CONSTRAINT `FK_film-genre_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  CONSTRAINT `FK_film-genre_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.filmgenre : ~4 rows (environ)
INSERT INTO `filmgenre` (`film_id`, `genre_id`) VALUES
	(1, 1),
	(2, 1),
	(2, 2),
	(2, 3);

-- Listage de la structure de table cinema_fj. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.genre : ~3 rows (environ)
INSERT INTO `genre` (`id`, `nom`) VALUES
	(1, 'Super-héros'),
	(2, 'Fantasitque'),
	(3, 'Action'),
	(8, 'Chocolat'),
	(9, 'Poire');

-- Listage de la structure de table cinema_fj. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `portrait` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.realisateur : ~2 rows (environ)
INSERT INTO `realisateur` (`id`, `nom`, `prenom`, `sex`, `date_de_naissance`, `portrait`) VALUES
	(1, 'Lambert', 'Hillyer', 'H', '1889-07-08', NULL),
	(2, 'Spencer', 'Gordon Bennet', 'H', '1893-01-05', NULL);

-- Listage de la structure de table cinema_fj. role
CREATE TABLE IF NOT EXISTS `role` (
  `nom` varchar(50) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.role : ~2 rows (environ)
INSERT INTO `role` (`nom`, `id`) VALUES
	('Batman', 1),
	('Robin', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
