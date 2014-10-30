-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 30 Octobre 2014 à 16:30
-- Version du serveur: 5.5.37
-- Version de PHP: 5.4.4-14+deb7u10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`id`, `address`, `title`, `description`, `url`) VALUES
(1, '6 place Charles Hernu 69100 Villeurbanne', 'Ip Formation', 'Société de formation', 'www.ip-formation.com'),
(2, '3 place Lazare Goujon 69100 Villeurbanne', 'Mairie', 'Mairie de Villeurbanne', 'www.villeurbanne.fr'),
(3, '40 rue Michel Servet 69100 Villeurbanne', 'Police municipale', 'Police municipale de Villeurbanne', 'www.villeurbanne.fr'),
(4, 'place Beauvau 75008 Paris', 'Ministère de l''Intérieur', 'Ministère de l''intérieur français', 'www.interieur.gouv.fr'),
(5, '13 place Vendôme 75001 Paris                            ', 'Ministère de la Justice', 'La Justice en France est administrée par un ministère, nommé aussi Chancellerie, dont le titulaire est le garde des Sceaux, ministre de la Justice.', 'www.justice.gouv.fr'),
(6, '111 Rue du 1er Mars 1943, 69100 Villeurbanne', 'AFIP Formations', 'Société de formation', 'www.afip-formations.com'),
(7, '35 boulevard Jodino 69200 VENISSIEUX', 'AFPA Vénissieux', 'Société de formation', 'http://www.afpa.fr'),
(8, '138 rue Marcadet 75018 Paris', 'Ligue Défense des droits de l''homme', 'Association de défense des droits de l''homme', 'www.ldh-france.org/'),
(75, '23 rue Valentin Haüy 69100 Villeurbanne        					', 'Bibliothèque du Rize', 'Une des trois médiathèques du réseau de Villeurbanne', 'www.bm.villeurbanne.fr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
