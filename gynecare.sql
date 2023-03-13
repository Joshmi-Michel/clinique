-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 fév. 2019 à 12:26
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gynecare`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheter`
--

DROP TABLE IF EXISTS `acheter`;
CREATE TABLE IF NOT EXISTS `acheter` (
  `idAch` int(11) NOT NULL AUTO_INCREMENT,
  `refProd` int(11) NOT NULL,
  `dateAchat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qte` int(11) DEFAULT NULL,
  `prixAchat` decimal(10,2) DEFAULT NULL,
  `livree` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomAdmin` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nomAdmin`, `login`, `password`) VALUES
(1, 'Joshmi Michel', 'Joshmi', 'joshverbek');

-- --------------------------------------------------------

--
-- Structure de la table `aprov`
--

DROP TABLE IF EXISTS `aprov`;
CREATE TABLE IF NOT EXISTS `aprov` (
  `idAp` int(11) NOT NULL AUTO_INCREMENT,
  `qteAp` int(11) NOT NULL,
  `dateAp` timestamp NOT NULL,
  `prodAprov` int(11) NOT NULL,
  PRIMARY KEY (`idAp`),
  KEY `prodAprov` (`prodAprov`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

DROP TABLE IF EXISTS `chauffeur`;
CREATE TABLE IF NOT EXISTS `chauffeur` (
  `numChauf` int(11) NOT NULL AUTO_INCREMENT,
  `nomChauf` varchar(20) NOT NULL,
  `immVtr` varchar(10) NOT NULL,
  `dispo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`numChauf`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chauffeur`
--

INSERT INTO `chauffeur` (`numChauf`, `nomChauf`, `immVtr`, `dispo`) VALUES
(1, 'sofera1', '1254 TAL', 1),
(2, 'sofera 2', '4565 XG', 1),
(3, 'sofera 3', '4589 FD', 1),
(4, 'sofera 4', '5823 TTF', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `numCli` int(11) NOT NULL AUTO_INCREMENT,
  `nomCli` char(32) DEFAULT NULL,
  `prenomCli` char(32) DEFAULT NULL,
  `adCli` char(32) DEFAULT NULL,
  `cpCli` char(32) DEFAULT NULL,
  `telCli` char(32) DEFAULT NULL,
  `mailCli` char(32) DEFAULT NULL,
  PRIMARY KEY (`numCli`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numCli`, `nomCli`, `prenomCli`, `adCli`, `cpCli`, `telCli`, `mailCli`) VALUES
(2, 'rasolo', 'keli', 'Tana', '12', '12 635 46 56', 'mail@client.fr'),
(3, 'ramisa', 'grand', 'Diego', '54', '52 522 55 555', 'mail@client2.fr');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `dateliv` datetime DEFAULT NULL,
  `idAch` int(11) NOT NULL,
  `idLiv` int(11) NOT NULL AUTO_INCREMENT,
  `numChauf` int(11) NOT NULL,
  PRIMARY KEY (`idLiv`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`dateliv`, `idAch`, `idLiv`, `numChauf`) VALUES
('2017-10-16 08:58:53', 5, 1, 1),
('2017-10-16 09:10:30', 6, 2, 2),
('2017-10-16 09:21:56', 7, 3, 4),
('2017-10-16 09:36:04', 8, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `design` varchar(100) NOT NULL,
  `qteAchete` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `dateAchat` timestamp NOT NULL,
  `idProPan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `design`, `qteAchete`, `pu`, `montant`, `dateAchat`, `idProPan`) VALUES
(172, 'vitamine', 2, 12000, 24000, '2019-01-30 11:56:33', 19);

-- --------------------------------------------------------

--
-- Structure de la table `panier2`
--

DROP TABLE IF EXISTS `panier2`;
CREATE TABLE IF NOT EXISTS `panier2` (
  `id2` int(11) NOT NULL AUTO_INCREMENT,
  `nomP` varchar(100) NOT NULL,
  `prixP` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `dateP2` timestamp NOT NULL,
  PRIMARY KEY (`id2`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `refProd` int(11) NOT NULL AUTO_INCREMENT,
  `design` varchar(100) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `peremption` text NOT NULL,
  `pu` int(11) DEFAULT NULL,
  `dateEntrer` timestamp NOT NULL,
  `numU` int(11) NOT NULL,
  PRIMARY KEY (`refProd`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`refProd`, `design`, `qte`, `peremption`, `pu`, `dateEntrer`, `numU`) VALUES
(18, 'betadine', 15, 'le 11-01-2030', 6000, '2019-01-30 12:24:24', 11),
(19, 'vitamine', 55, 'le 11-01-2030', 12000, '2019-01-30 12:26:14', 12),
(20, 'compresse', 60, 'le 12-04-2020', 4000, '2019-01-30 11:46:50', 11);

-- --------------------------------------------------------

--
-- Structure de la table `usine`
--

DROP TABLE IF EXISTS `usine`;
CREATE TABLE IF NOT EXISTS `usine` (
  `numU` int(11) NOT NULL AUTO_INCREMENT,
  `nomU` char(32) DEFAULT NULL,
  `telU` char(32) DEFAULT NULL,
  `mailU` char(32) DEFAULT NULL,
  PRIMARY KEY (`numU`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `usine`
--

INSERT INTO `usine` (`numU`, `nomU`, `telU`, `mailU`) VALUES
(11, 'oph', '0346744579', 'mahazina'),
(12, 'LVB', '0346744579', 'anatanifotsy');

-- --------------------------------------------------------

--
-- Structure de la table `vendre`
--

DROP TABLE IF EXISTS `vendre`;
CREATE TABLE IF NOT EXISTS `vendre` (
  `refProd` int(11) NOT NULL,
  `numAg` int(11) NOT NULL,
  PRIMARY KEY (`refProd`,`numAg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
