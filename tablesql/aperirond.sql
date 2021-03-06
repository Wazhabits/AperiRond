-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 19 fév. 2018 à 10:59
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `aperirond`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `stockid` int(11) NOT NULL,
  `prix` float NOT NULL,
  `satisfaction` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Tables contenant les articles';

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `nom`, `description`, `stockid`, `prix`, `satisfaction`) VALUES
(1, 'Aperi-Rond Clou de girofle', 'Une de nos recettes experimentale de cette annee', 1, 0.3, 0.5),
(2, 'Aperi-Rond Chikungugna', 'Pour les friands de proteines fraiche, croustillant. Mmmhhh', 2, 0.9, 0),
(3, 'Aperi-Rond Brocolis', 'Eh oui encore une super idee d\'apericube', 3, 0.5, 2),
(4, 'Aperi-Rond bechamelle', 'On ne sait pu quoi inventer', 4, 20, 4),
(5, 'Aperi-Rond Choux de bruxelles', 'L\'aperitif qui vous souffle vos envies !', 5, 0.1, 1),
(6, 'Aperi-Rond Calamar', 'Vous l\'aimez tellement quand il s\'accroche a vous', 6, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user`, `article`, `quantity`) VALUES
(37, 1, 1, 12),
(39, 1, 2, 8),
(38, 1, 4, 6),
(40, 1, 3, 8),
(41, 4, 2, 8),
(42, 4, 3, 10);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `num_adresse` varchar(10) NOT NULL,
  `nom_adresse` varchar(100) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(10) NOT NULL,
  `valid` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tables contenant les commandes passé et en cours';

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `user`, `ref`, `nom`, `prenom`, `num_adresse`, `nom_adresse`, `cp`, `ville`, `valid`, `paid`) VALUES
(1, 4, '4', 'Rirond', 'Ape', '2', 'bd du massacre', 'Nantes', '44200', 0, 0),
(2, 1, '1', 'Yao', 'Merle', '1', 'dev', '44000', 'Nantes', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`id`, `quantite`) VALUES
(1, 39),
(2, 300),
(3, 15),
(4, 86),
(5, 2),
(6, 100);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `numrue` int(11) DEFAULT NULL,
  `rue` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nom`, `prenom`, `telephone`, `numrue`, `rue`, `cp`, `ville`, `pays`) VALUES
(1, 'z@z.c', '4b76e078e9df24d2da36e4e288ce36a8', 'Yao', 'Merle', '0123456789', 1, 'dev', 44000, 'Nantes', 'FRANCE'),
(4, 'ape@rond.fr', '13131f7a5ebe670564562574e5e84934', 'Ape', 'Rirond', '0123456789', 2, 'bd du massacre', 44200, 'Nantes', 'FRANCE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
