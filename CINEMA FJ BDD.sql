-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinema_fj
CREATE DATABASE IF NOT EXISTS `cinema_fj` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cinema_fj`;

-- Listage de la structure de la table cinema_fj. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.acteur : ~5 rows (environ)
DELETE FROM `acteur`;
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id`, `nom`, `prenom`, `sex`, `date_de_naissance`) VALUES
	(1, 'Lewis', 'Wilson', 'H', '1920-01-28'),
	(2, 'Douglas', 'Croft', 'H', '1926-08-12'),
	(3, 'Robert', 'Lowery', 'H', '1913-10-17'),
	(4, 'Johnny', 'Duncan', 'H', '1917-02-23'),
	(5, 'Lambert', 'Hillyer', 'H', '1889-07-08');
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_fj. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `film_id` int(11) DEFAULT NULL,
  `acteur_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  KEY `FK_casting_film` (`film_id`),
  KEY `FK_casting_acteur` (`acteur_id`),
  KEY `FK_casting_role` (`role_id`),
  CONSTRAINT `FK_casting_acteur` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`),
  CONSTRAINT `FK_casting_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  CONSTRAINT `FK_casting_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.casting : ~4 rows (environ)
DELETE FROM `casting`;
/*!40000 ALTER TABLE `casting` DISABLE KEYS */;
INSERT INTO `casting` (`film_id`, `acteur_id`, `role_id`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(2, 3, 1),
	(2, 4, 2);
/*!40000 ALTER TABLE `casting` ENABLE KEYS */;

-- Listage de la structure de la table cinema_fj. film
CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realisateur_id` int(11) NOT NULL DEFAULT '0',
  `titre` varchar(50) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `sortie` date DEFAULT NULL,
  `synopsis` text,
  `note` varchar(50) DEFAULT NULL,
  `affiche` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_film_realisateur` (`realisateur_id`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.film : ~2 rows (environ)
DELETE FROM `film`;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id`, `realisateur_id`, `titre`, `duree`, `sortie`, `synopsis`, `note`, `affiche`) VALUES
	(1, 1, 'Batman', 42000, '1943-02-23', 'Batman et Robin affrontent le Docteur Daka, un espion japonais qui a inventé une machine pouvant contrôler les esprits.', '3', NULL),
	(2, 2, 'Batman et Robin', 42300, '1949-02-23', 'Le professeur Hammil a créé un dispositif qui lui permet de contrôler les véhicules à distance. Son invention est dérobée. Batman et Robin, assistés par la journaliste Vicki Vale, partent à la recherche de cette invention qui est tombée dans de mauvaises mains.', '4', NULL);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema_fj. film-genre
CREATE TABLE IF NOT EXISTS `film-genre` (
  `film_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  KEY `FK_film-genre_film` (`film_id`),
  KEY `FK_film-genre_genre` (`genre_id`),
  CONSTRAINT `FK_film-genre_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  CONSTRAINT `FK_film-genre_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.film-genre : ~4 rows (environ)
DELETE FROM `film-genre`;
/*!40000 ALTER TABLE `film-genre` DISABLE KEYS */;
INSERT INTO `film-genre` (`film_id`, `genre_id`) VALUES
	(1, 1),
	(2, 1),
	(2, 2),
	(2, 3);
/*!40000 ALTER TABLE `film-genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_fj. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.genre : ~3 rows (environ)
DELETE FROM `genre`;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id`, `nom`) VALUES
	(1, 'super-héros'),
	(2, 'fantasitque'),
	(3, 'action');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_fj. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.realisateur : ~2 rows (environ)
DELETE FROM `realisateur`;
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id`, `nom`, `prenom`, `sex`, `date_de_naissance`) VALUES
	(1, 'Lambert', 'Hillyer', 'H', '1889-07-08'),
	(2, 'Spencer', 'Gordon Bennet', 'H', '1893-01-05');
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_fj. role
CREATE TABLE IF NOT EXISTS `role` (
  `nom` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_fj.role : ~2 rows (environ)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`nom`, `id`) VALUES
	('Batman', 1),
	('Robin', 2);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
