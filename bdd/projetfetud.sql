-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 16 mai 2020 à 01:27
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetfetud`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `login` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`login`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `auteurprinc`
--

CREATE TABLE `auteurprinc` (
  `idcher` int(12) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `codepro` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `auteurprinc`
--

INSERT INTO `auteurprinc` (`idcher`, `nom`, `codepro`) VALUES
(0, 'chamakh', 2),
(16, '', 4),
(16, '', 5),
(16, '', 7),
(0, 'CH PRINC', 8),
(16, '', 51),
(16, '', 52),
(16, '', 53),
(16, '', 54),
(16, '', 55),
(16, '', 56),
(16, '', 58);

-- --------------------------------------------------------

--
-- Structure de la table `chapitredouvrage`
--

CREATE TABLE `chapitredouvrage` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `volume` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `idspe` int(12) NOT NULL,
  `pages` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chapitredouvrage`
--

INSERT INTO `chapitredouvrage` (`codepro`, `titre`, `editeur`, `volume`, `url`, `idspe`, `pages`) VALUES
(7, 'CH9', 'ch9', 9, 'CH9', 27, '129 238'),
(8, 'CH', 'CH', 4, 'CH', 28, '129 230');

-- --------------------------------------------------------

--
-- Structure de la table `chefequip`
--

CREATE TABLE `chefequip` (
  `idcher` int(12) NOT NULL,
  `idequipe` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chefequip`
--

INSERT INTO `chefequip` (`idcher`, `idequipe`) VALUES
(16, 8),
(28, 14);

-- --------------------------------------------------------

--
-- Structure de la table `cheflabo`
--

CREATE TABLE `cheflabo` (
  `idcher` int(12) NOT NULL,
  `idlabo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cheflabo`
--

INSERT INTO `cheflabo` (`idcher`, `idlabo`) VALUES
(16, 37),
(24, 38);

-- --------------------------------------------------------

--
-- Structure de la table `chefproj`
--

CREATE TABLE `chefproj` (
  `idcher` int(12) NOT NULL,
  `codeproj` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chercheur`
--

CREATE TABLE `chercheur` (
  `idcher` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `grade` enum('DOC','MAB','MAA','MCB','MCA','PROF') NOT NULL,
  `profil` enum('permanent','doctorant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chercheur`
--

INSERT INTO `chercheur` (`idcher`, `nom`, `mail`, `grade`, `profil`) VALUES
(16, 'Sid ahmed', 'sid.ahmedl@usthb.dz', 'MCA', 'permanent'),
(21, 'omar rabhi', 'omar.rabhi@usthb.dz', 'PROF', 'permanent'),
(23, 'newdoc', 'newdoc@usthb.dz', '', 'doctorant'),
(24, 'fleur', 'fleur@usthb.dz', 'PROF', 'permanent'),
(26, 'xwqinsosiqdioqsn', 'newdoc@usthb.dz', '', 'doctorant'),
(27, 'new doc 5', 'newdoc5@usthb.dz', 'MCA', 'permanent'),
(28, 'omar rabhi', 'omar@usthb.dz', 'MCB', 'permanent');

-- --------------------------------------------------------

--
-- Structure de la table `coauteurs`
--

CREATE TABLE `coauteurs` (
  `idcher` int(12) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `codepro` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `coauteurs`
--

INSERT INTO `coauteurs` (`idcher`, `nom`, `codepro`) VALUES
(0, 'another one', 5),
(0, 'C23', 4),
(0, 'CH CO9', 7),
(0, 'com8', 58),
(21, '', 4),
(21, '', 5),
(23, '', 52),
(23, '', 53),
(23, '', 54),
(23, '', 55),
(23, '', 56);

-- --------------------------------------------------------

--
-- Structure de la table `communication`
--

CREATE TABLE `communication` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `url` varchar(40) NOT NULL,
  `codeconf` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `communication`
--

INSERT INTO `communication` (`codepro`, `titre`, `idspe`, `url`, `codeconf`) VALUES
(4, 'COM23', 22, 'COM23', 1),
(58, 'com8', 89, 'com8', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conference`
--

CREATE TABLE `conference` (
  `codeconf` int(12) NOT NULL,
  `nomconf` varchar(255) NOT NULL,
  `abrv` varchar(20) NOT NULL,
  `annee` varchar(4) NOT NULL,
  `idspe` int(12) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `periodicite` enum('annuel','semestriel','biannuel','quadrimestriel','trimestriel','bimestriel','mensuel','bimensuel') NOT NULL,
  `type` enum('nationale','internationale') NOT NULL,
  `classe` enum('A','B','C','Autre') NOT NULL,
  `pays` varchar(40) NOT NULL,
  `numindex` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conference`
--

INSERT INTO `conference` (`codeconf`, `nomconf`, `abrv`, `annee`, `idspe`, `theme`, `periodicite`, `type`, `classe`, `pays`, `numindex`) VALUES
(0, 'c', 'c', '2010', 18, 'c', 'semestriel', 'internationale', 'C', 'vide', 0),
(1, 'C2C', 'C2C', '2020', 23, 'C2C', 'semestriel', 'nationale', 'A', 'ALGERIE', 0);

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `codeDomaine` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`codeDomaine`, `nom`) VALUES
(1, 'informatique'),
(2, 'biologie'),
(3, 's revue'),
(4, 's'),
(5, 'cc'),
(6, 'cc'),
(7, 'cc'),
(8, 'cc'),
(9, 'cc'),
(10, 'cc'),
(11, 'cc'),
(12, 'cc'),
(13, 'cc'),
(14, 'c'),
(15, 'cc'),
(16, 'cc'),
(17, 'C2C3'),
(18, 'C2C'),
(19, 'C2'),
(20, 'OU'),
(21, 'CH'),
(22, 'CH9'),
(23, 'CH'),
(24, 'TD10'),
(25, 'PM15'),
(26, 'PR2'),
(28, 'P2'),
(29, 'P2'),
(30, 'P2'),
(36, 'rpub'),
(38, 'mecanique'),
(39, 'pm5'),
(40, 'cherMi'),
(41, 'MB'),
(42, 'MB2'),
(43, 'MB2'),
(44, 'MB2'),
(45, 'MB2'),
(46, 'MB2'),
(47, 'MB2'),
(48, 'MB2'),
(49, 'MB2'),
(50, 'MB2'),
(51, 'MB2'),
(52, 'MB2'),
(53, 'MB2'),
(54, 'MB2'),
(55, 'MB2'),
(56, 'MB2'),
(57, 'MB2'),
(58, 'MB2'),
(59, 'MB2'),
(60, 'MB2'),
(61, 'MB2'),
(62, 'MB3'),
(63, 'MB3'),
(64, 'MB3'),
(65, 'MB3'),
(66, 'MB3'),
(67, 'MB3'),
(68, 'DB'),
(69, 'OB'),
(70, 'OB2'),
(71, 'OB2'),
(72, 'OB2'),
(73, 'OB2'),
(74, 'OB2'),
(75, 'INFORMATIQUE'),
(76, 'informatique'),
(77, 'com8'),
(78, 'com8');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idequipe` int(12) NOT NULL,
  `nomequip` varchar(40) NOT NULL,
  `idspe` int(12) NOT NULL,
  `idlabo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idequipe`, `nomequip`, `idspe`, `idlabo`) VALUES
(8, 'Traitement du langage', 5, 37),
(14, 'we see the future', 48, 37);

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `idetab` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `abrv` varchar(20) NOT NULL,
  `type` enum('université','centre de recherche') NOT NULL,
  `addresse` varchar(255) NOT NULL,
  `tel` int(12) NOT NULL,
  `fax` int(12) NOT NULL,
  `siteweb` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`idetab`, `nom`, `abrv`, `type`, `addresse`, `tel`, `fax`, `siteweb`) VALUES
(1, 'universite des sciences et technologies houari boumediene', 'USTHB', 'université', 'el alia bab ezzouar ', 21300, 21301, 'usthb.dz'),
(41, 'CERIST', '', 'université', '', 21355, 213, 'cerist.dz'),
(42, 'Universitéd\'oran', 'usto', 'université', 'oran', 213, 213, 'usto.dz');

-- --------------------------------------------------------

--
-- Structure de la table `index`
--

CREATE TABLE `index` (
  `numindex` int(12) NOT NULL,
  `nomindex` varchar(40) NOT NULL,
  `valeur` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire`
--

CREATE TABLE `laboratoire` (
  `idlabo` int(12) NOT NULL,
  `idspe` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `abrv` varchar(20) NOT NULL,
  `addresse` varchar(255) NOT NULL,
  `anneecrea` year(4) NOT NULL,
  `tel` int(20) NOT NULL,
  `etat` enum('actif','inactif') NOT NULL,
  `idetab` int(12) NOT NULL,
  `structure` varchar(150) NOT NULL,
  `fax` int(20) NOT NULL,
  `mail` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `laboratoire`
--

INSERT INTO `laboratoire` (`idlabo`, `idspe`, `nom`, `abrv`, `addresse`, `anneecrea`, `tel`, `etat`, `idetab`, `structure`, `fax`, `mail`) VALUES
(37, 5, 'Intelligence artificielle', '', '', 0000, 0, 'actif', 1, '', 0, ''),
(38, 7, 'vegeteble life', 'vlf', 'we here', 2020, 213, 'actif', 1, 'fac de biologie', 213, ''),
(39, 43, 'nawawi and friends', '', '', 0000, 0, 'actif', 1, 'fac physique', 0, ''),
(40, 44, 'mecanique and chill', '', '', 0000, 0, 'actif', 1, 'fac mecanique', 0, ''),
(41, 85, 'new info', 'inf', '', 0000, 0, 'actif', 1, '', 0, ''),
(42, 87, 'fzefzefzefze', '', '', 2010, 0, 'actif', 1, '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `membreproj`
--

CREATE TABLE `membreproj` (
  `idcher` int(11) NOT NULL,
  `codepro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menbrequip`
--

CREATE TABLE `menbrequip` (
  `idcher` int(12) NOT NULL,
  `idequipe` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menbrequip`
--

INSERT INTO `menbrequip` (`idcher`, `idequipe`) VALUES
(23, 8),
(26, 8),
(27, 8);

-- --------------------------------------------------------

--
-- Structure de la table `motscle`
--

CREATE TABLE `motscle` (
  `codepro` int(12) NOT NULL,
  `mot` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `motscle`
--

INSERT INTO `motscle` (`codepro`, `mot`) VALUES
(4, '2'),
(4, 'b'),
(5, 'A'),
(5, 'E'),
(7, 'CH1'),
(7, 'CH2'),
(7, 'CH3'),
(7, 'CH9'),
(8, 'CH1'),
(8, 'CH2'),
(8, 'CH3'),
(9, '10'),
(9, 'D'),
(9, 'T'),
(10, '15'),
(10, 'M'),
(21, '5'),
(21, 'm'),
(21, 'p'),
(23, 'MB'),
(24, 'MB2'),
(25, 'MB2'),
(26, 'MB2'),
(27, 'MB2'),
(28, 'MB2'),
(29, 'MB2'),
(30, 'MB2'),
(31, 'MB2'),
(32, 'MB2'),
(33, 'MB2'),
(34, 'MB2'),
(35, 'MB2'),
(36, 'MB2'),
(37, 'MB2'),
(38, 'MB2'),
(39, 'MB2'),
(40, 'MB2'),
(41, 'MB2'),
(42, 'MB2'),
(43, 'MB2'),
(44, 'MB3'),
(45, 'MB3'),
(46, 'MB3'),
(47, 'MB3'),
(48, 'MB3'),
(49, 'MB3'),
(50, 'DB'),
(51, 'OB'),
(52, 'OB2'),
(53, 'OB2'),
(54, 'OB2'),
(55, 'OB2'),
(56, 'OB2'),
(58, '8'),
(58, 'c'),
(58, 'm'),
(58, 'o');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idcher` int(12) NOT NULL DEFAULT 0,
  `titre` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `type` enum('urgent','pasUrgent') NOT NULL,
  `admin` int(1) NOT NULL,
  `forEquipe` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`idcher`, `titre`, `date`, `type`, `admin`, `forEquipe`) VALUES
(16, 'bilan svp faite vite', '2020-05-31', 'pasUrgent', 0, 0),
(16, 'ddzdaz', '2020-05-26', 'urgent', 0, 1),
(16, 'whateverlol', '2020-05-28', 'pasUrgent', 0, 0),
(28, 'vous devez yes', '2020-05-30', 'urgent', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `codepro` int(11) NOT NULL,
  `idspe` int(12) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `nbpages` int(4) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `url` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`codepro`, `idspe`, `titre`, `nbpages`, `editeur`, `url`) VALUES
(5, 25, 'ouv55', 500, 'five', 'five.5'),
(51, 79, 'OB', 200, 'OB', 'OB'),
(52, 80, 'OB2', 500, 'OB2', 'OB2'),
(53, 81, 'OB2', 500, 'OB2', 'OB2'),
(54, 82, 'OB2', 500, 'OB2', 'OB2'),
(55, 83, 'OB2', 500, 'OB2', 'OB2'),
(56, 84, 'OB2', 500, 'OB2', 'OB2');

-- --------------------------------------------------------

--
-- Structure de la table `pfemaster`
--

CREATE TABLE `pfemaster` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `encadreur` int(12) NOT NULL,
  `lieusout` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pfemaster`
--

INSERT INTO `pfemaster` (`codepro`, `titre`, `idspe`, `encadreur`, `lieusout`) VALUES
(10, 'PM15', 30, 16, 'PM15'),
(21, 'pm5', 49, 16, 'pm5'),
(23, 'MB', 51, 16, 'MB'),
(24, 'MB2', 52, 16, 'MB2'),
(25, 'MB2', 53, 16, 'MB2'),
(26, 'MB2', 54, 16, 'MB2'),
(27, 'MB2', 55, 16, 'MB2'),
(28, 'MB2', 56, 16, 'MB2'),
(29, 'MB2', 57, 16, 'MB2'),
(30, 'MB2', 58, 16, 'MB2'),
(31, 'MB2', 59, 16, 'MB2'),
(32, 'MB2', 60, 16, 'MB2'),
(33, 'MB2', 61, 16, 'MB2'),
(34, 'MB2', 62, 16, 'MB2'),
(35, 'MB2', 63, 16, 'MB2'),
(36, 'MB2', 64, 16, 'MB2'),
(37, 'MB2', 65, 16, 'MB2'),
(38, 'MB2', 66, 16, 'MB2'),
(39, 'MB2', 67, 16, 'MB2'),
(40, 'MB2', 68, 16, 'MB2'),
(41, 'MB2', 69, 16, 'MB2'),
(42, 'MB2', 70, 16, 'MB2'),
(43, 'MB2', 71, 16, 'MB2'),
(44, 'MB3', 72, 16, 'MB3'),
(45, 'MB3', 73, 16, 'MB3'),
(46, 'MB3', 74, 16, 'MB3'),
(47, 'MB3', 75, 16, 'MB3'),
(48, 'MB3', 76, 16, 'MB3'),
(49, 'MB3', 77, 16, 'MB3');

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

CREATE TABLE `production` (
  `codepro` int(12) NOT NULL,
  `date` varchar(7) NOT NULL,
  `type` enum('communication','ouvrage','chapitreOuvrage','publication','doctorat','master') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `production`
--

INSERT INTO `production` (`codepro`, `date`, `type`) VALUES
(2, '2020-04', 'publication'),
(3, '2010-03', 'communication'),
(4, '2014-02', 'communication'),
(5, '2009-01', 'ouvrage'),
(6, '2020-03', 'chapitreOuvrage'),
(7, '2017-03', 'chapitreOuvrage'),
(8, '2020-03', 'chapitreOuvrage'),
(9, '2015-04', 'doctorat'),
(10, '2012-04', 'master'),
(12, '2020-04', 'publication'),
(13, '2020-04', 'publication'),
(14, '2020-04', 'publication'),
(21, '2020-04', 'master'),
(23, '2020-04', 'master'),
(24, '2020-04', 'master'),
(25, '2020-04', 'master'),
(26, '2020-04', 'master'),
(27, '2020-04', 'master'),
(28, '2020-04', 'master'),
(29, '2020-04', 'master'),
(30, '2020-04', 'master'),
(31, '2020-04', 'master'),
(32, '2020-04', 'master'),
(33, '2020-04', 'master'),
(34, '2020-04', 'master'),
(35, '2020-04', 'master'),
(36, '2020-04', 'master'),
(37, '2020-04', 'master'),
(38, '2020-04', 'master'),
(39, '2020-04', 'master'),
(40, '2020-04', 'master'),
(41, '2020-04', 'master'),
(42, '2020-04', 'master'),
(43, '2020-04', 'master'),
(44, '2020-04', 'master'),
(45, '2020-04', 'master'),
(46, '2020-04', 'master'),
(47, '2020-04', 'master'),
(48, '2020-04', 'master'),
(49, '2020-04', 'master'),
(50, '2020-04', 'doctorat'),
(51, '2020-04', 'ouvrage'),
(52, '2020-04', 'ouvrage'),
(53, '2020-04', 'ouvrage'),
(54, '2020-04', 'ouvrage'),
(55, '2020-04', 'ouvrage'),
(56, '2020-04', 'ouvrage'),
(57, '2020-05', 'communication'),
(58, '2020-05', 'communication');

-- --------------------------------------------------------

--
-- Structure de la table `projrecher`
--

CREATE TABLE `projrecher` (
  `codeproj` int(12) NOT NULL,
  `intitule` varchar(50) NOT NULL,
  `annee` year(4) NOT NULL,
  `mois` int(2) NOT NULL,
  `description` text NOT NULL,
  `duree` int(4) NOT NULL,
  `codepro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `idspe` int(12) NOT NULL,
  `coderevue` int(12) NOT NULL,
  `doi` int(11) NOT NULL,
  `nvol` int(11) NOT NULL,
  `nissue` int(11) NOT NULL,
  `url` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`codepro`, `titre`, `idspe`, `coderevue`, `doi`, `nvol`, `nissue`, `url`) VALUES
(2, 'p2', 5, 2, 0, 0, 0, 'p2');

-- --------------------------------------------------------

--
-- Structure de la table `revue`
--

CREATE TABLE `revue` (
  `coderevue` int(12) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `periodicite` enum('annuel','semestriel','biannuel','quadrimestriel','trimestriel','bimestriel','mensuel','bimensuel') NOT NULL,
  `issnonline` varchar(40) NOT NULL,
  `issnprint` varchar(40) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `annee` varchar(4) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `classe` enum('A*','A','B','C','Autre') NOT NULL,
  `numindex` int(12) NOT NULL,
  `type` enum('nationale','internationale') NOT NULL,
  `pays` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `revue`
--

INSERT INTO `revue` (`coderevue`, `nom`, `periodicite`, `issnonline`, `issnprint`, `editeur`, `annee`, `theme`, `idspe`, `classe`, `numindex`, `type`, `pays`) VALUES
(1, 's revue', 'annuel', 's', 's', 's', '1998', 's', 8, 'A*', 0, 'internationale', ''),
(2, 'PR2', 'annuel', 'PR2', 'PR2', 'PR2', '1970', 'PR2', 31, '', 0, 'nationale', 'FRANCE'),
(3, 'rpub', 'annuel', 'rpub', 'rpub', 'rpub', '1987', 'rpub', 41, 'A*', 0, 'internationale', '');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `idspe` int(12) NOT NULL,
  `nomspe` varchar(255) NOT NULL,
  `abrv` varchar(20) NOT NULL,
  `codeDomaine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`idspe`, `nomspe`, `abrv`, `codeDomaine`) VALUES
(1, 'systemees informatiques', 'si', 1),
(2, 'genie logiciel', 'gl', 1),
(3, 'ingenierie des systemes d\'information', 'isi', 1),
(4, 'modelisation et verification des systemes paralleles', 'moves', 1),
(5, 'web semantique, securite informatique', 'vaal', 1),
(6, 'mobilite', 'mobilite', 1),
(7, 'bio syntheese', 'bs', 2),
(8, 's revue', '', 3),
(9, 's', '', 4),
(10, 'cc', '', 5),
(11, 'cc', '', 6),
(12, 'cc', '', 7),
(13, 'cc', '', 8),
(14, 'cc', '', 9),
(15, 'cc', '', 10),
(16, 'cc', '', 11),
(17, 'cc', '', 12),
(18, 'cc', '', 13),
(19, 'c', '', 14),
(20, 'cc', '', 15),
(21, 'cc', '', 16),
(22, 'C2C3', '', 17),
(23, 'C2C', '', 18),
(24, 'C2', '', 19),
(25, 'OU', '', 20),
(26, 'CH', '', 21),
(27, 'CH9', '', 22),
(28, 'CH', '', 23),
(29, 'TD10', '', 24),
(30, 'PM15', '', 25),
(31, 'PR2', '', 26),
(33, 'P2', '', 28),
(34, 'P2', '', 29),
(35, 'P2', '', 30),
(41, 'rpub', '', 36),
(44, 'culasse', '', 38),
(45, 'informatique', '', 1),
(46, 'informatique', '', 1),
(47, 'informatique', '', 1),
(48, 'vision', '', 1),
(49, 'pm5', '', 39),
(50, 'cherMi', '', 40),
(51, 'MB', '', 41),
(52, 'MB2', '', 42),
(53, 'MB2', '', 43),
(54, 'MB2', '', 44),
(55, 'MB2', '', 45),
(56, 'MB2', '', 46),
(57, 'MB2', '', 47),
(58, 'MB2', '', 48),
(59, 'MB2', '', 49),
(60, 'MB2', '', 50),
(61, 'MB2', '', 51),
(62, 'MB2', '', 52),
(63, 'MB2', '', 53),
(64, 'MB2', '', 54),
(65, 'MB2', '', 55),
(66, 'MB2', '', 56),
(67, 'MB2', '', 57),
(68, 'MB2', '', 58),
(69, 'MB2', '', 59),
(70, 'MB2', '', 60),
(71, 'MB2', '', 61),
(72, 'MB3', '', 62),
(73, 'MB3', '', 63),
(74, 'MB3', '', 64),
(75, 'MB3', '', 65),
(76, 'MB3', '', 66),
(77, 'MB3', '', 67),
(78, 'DB', '', 68),
(79, 'OB', '', 69),
(80, 'OB2', '', 70),
(81, 'OB2', '', 71),
(82, 'OB2', '', 72),
(83, 'OB2', '', 73),
(84, 'OB2', '', 74),
(85, 'intelligence artificielle', '', 75),
(86, 'vision etc', '', 1),
(87, 'secutzefze', '', 76),
(88, 'com8', '', 77),
(89, 'com8', '', 78);

-- --------------------------------------------------------

--
-- Structure de la table `systemenotes`
--

CREATE TABLE `systemenotes` (
  `revueInterAA` int(2) NOT NULL,
  `revueInterA` int(2) NOT NULL,
  `revueInterB` int(2) NOT NULL,
  `revueInterC` int(2) NOT NULL,
  `revueInterAutre` int(2) NOT NULL,
  `revueNat` int(2) NOT NULL,
  `autre` int(2) NOT NULL,
  `comInterA` int(2) NOT NULL,
  `comInterB` int(2) NOT NULL,
  `comInterC` int(2) NOT NULL,
  `comInterAutre` int(2) NOT NULL,
  `comNat` int(2) NOT NULL,
  `chapitreOuvrage` int(2) NOT NULL,
  `ouvrage` int(2) NOT NULL,
  `doctorat` int(2) NOT NULL,
  `master` int(2) NOT NULL,
  `id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `systemenotes`
--

INSERT INTO `systemenotes` (`revueInterAA`, `revueInterA`, `revueInterB`, `revueInterC`, `revueInterAutre`, `revueNat`, `autre`, `comInterA`, `comInterB`, `comInterC`, `comInterAutre`, `comNat`, `chapitreOuvrage`, `ouvrage`, `doctorat`, `master`, `id`) VALUES
(60, 50, 40, 20, 10, 20, 5, 30, 20, 10, 10, 10, 30, 100, 15, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `these`
--

CREATE TABLE `these` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `encadreur` int(12) NOT NULL,
  `lieusout` varchar(40) NOT NULL,
  `nordre` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `idspe` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `these`
--

INSERT INTO `these` (`codepro`, `titre`, `encadreur`, `lieusout`, `nordre`, `url`, `idspe`) VALUES
(9, 'TD10', 16, 'TD', 8, 'TD', 29),
(50, 'DB', 16, 'DB', 5, 'DB', 78);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idcher` int(12) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actif` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idcher`, `mail`, `password`, `actif`) VALUES
(16, 'sid.ahmedl@usthb.dz', 'lol', 1),
(26, 'newdoc@usthb.dz', 'lol', 1),
(27, 'newdoc5@usthb.dz', 'lol', 1),
(28, 'omar@usthb.dz', 'lol', 1);

-- --------------------------------------------------------

--
-- Structure de la table `validationproduction`
--

CREATE TABLE `validationproduction` (
  `codepro` int(12) NOT NULL,
  `idcher` int(12) NOT NULL,
  `type` enum('publication','communication','ouvrage','chapitreOuvrage','doctorat','master') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurprinc`
--
ALTER TABLE `auteurprinc`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `chapitredouvrage`
--
ALTER TABLE `chapitredouvrage`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `chefequip`
--
ALTER TABLE `chefequip`
  ADD PRIMARY KEY (`idcher`),
  ADD UNIQUE KEY `idequipe_2` (`idequipe`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `idequipe` (`idequipe`);

--
-- Index pour la table `cheflabo`
--
ALTER TABLE `cheflabo`
  ADD PRIMARY KEY (`idcher`,`idlabo`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `idlabo` (`idlabo`);

--
-- Index pour la table `chefproj`
--
ALTER TABLE `chefproj`
  ADD PRIMARY KEY (`idcher`,`codeproj`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `codeproj` (`codeproj`);

--
-- Index pour la table `chercheur`
--
ALTER TABLE `chercheur`
  ADD PRIMARY KEY (`idcher`);

--
-- Index pour la table `coauteurs`
--
ALTER TABLE `coauteurs`
  ADD PRIMARY KEY (`idcher`,`nom`,`codepro`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `communication`
--
ALTER TABLE `communication`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `codeconf` (`codeconf`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`codeconf`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`codeDomaine`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`idequipe`),
  ADD KEY `idlabo` (`idlabo`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`idetab`);

--
-- Index pour la table `index`
--
ALTER TABLE `index`
  ADD PRIMARY KEY (`numindex`);

--
-- Index pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  ADD PRIMARY KEY (`idlabo`),
  ADD KEY `idetab` (`idetab`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `membreproj`
--
ALTER TABLE `membreproj`
  ADD PRIMARY KEY (`idcher`,`codepro`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `menbrequip`
--
ALTER TABLE `menbrequip`
  ADD PRIMARY KEY (`idcher`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `idequipe` (`idequipe`);

--
-- Index pour la table `motscle`
--
ALTER TABLE `motscle`
  ADD PRIMARY KEY (`codepro`,`mot`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idcher`,`titre`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `pfemaster`
--
ALTER TABLE `pfemaster`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `idspe` (`idspe`),
  ADD KEY `encadreur` (`encadreur`);

--
-- Index pour la table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`codepro`);

--
-- Index pour la table `projrecher`
--
ALTER TABLE `projrecher`
  ADD PRIMARY KEY (`codeproj`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `coderevue` (`coderevue`),
  ADD KEY `idspe` (`idspe`);

--
-- Index pour la table `revue`
--
ALTER TABLE `revue`
  ADD PRIMARY KEY (`coderevue`),
  ADD KEY `idspe` (`idspe`),
  ADD KEY `numindex` (`numindex`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`idspe`),
  ADD KEY `specialite_domaine_fk` (`codeDomaine`);

--
-- Index pour la table `systemenotes`
--
ALTER TABLE `systemenotes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `these`
--
ALTER TABLE `these`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `idspe` (`idspe`),
  ADD KEY `encadreur` (`encadreur`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idcher`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `idcher` (`idcher`);

--
-- Index pour la table `validationproduction`
--
ALTER TABLE `validationproduction`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `idcher` (`idcher`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chercheur`
--
ALTER TABLE `chercheur`
  MODIFY `idcher` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `conference`
--
ALTER TABLE `conference`
  MODIFY `codeconf` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `codeDomaine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `idetab` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `index`
--
ALTER TABLE `index`
  MODIFY `numindex` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `idlabo` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `codepro` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `projrecher`
--
ALTER TABLE `projrecher`
  MODIFY `codeproj` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `revue`
--
ALTER TABLE `revue`
  MODIFY `coderevue` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `idspe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `systemenotes`
--
ALTER TABLE `systemenotes`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auteurprinc`
--
ALTER TABLE `auteurprinc`
  ADD CONSTRAINT `auteurprinc_ibfk_2` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chapitredouvrage`
--
ALTER TABLE `chapitredouvrage`
  ADD CONSTRAINT `chapitredouvrage_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapitredouvrage_spe_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chefequip`
--
ALTER TABLE `chefequip`
  ADD CONSTRAINT `chefequip_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chefequip_ibfk_2` FOREIGN KEY (`idequipe`) REFERENCES `equipe` (`idequipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cheflabo`
--
ALTER TABLE `cheflabo`
  ADD CONSTRAINT `cheflabo_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cheflabo_ibfk_2` FOREIGN KEY (`idlabo`) REFERENCES `laboratoire` (`idlabo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chefproj`
--
ALTER TABLE `chefproj`
  ADD CONSTRAINT `chefproj_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`),
  ADD CONSTRAINT `chefproj_ibfk_2` FOREIGN KEY (`codeproj`) REFERENCES `projrecher` (`codeproj`);

--
-- Contraintes pour la table `coauteurs`
--
ALTER TABLE `coauteurs`
  ADD CONSTRAINT `coauteurs_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `communication`
--
ALTER TABLE `communication`
  ADD CONSTRAINT `communication_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `communication_ibfk_2` FOREIGN KEY (`codeconf`) REFERENCES `conference` (`codeconf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `communication_spe_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`);

--
-- Contraintes pour la table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_2` FOREIGN KEY (`idlabo`) REFERENCES `laboratoire` (`idlabo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipe_spe_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  ADD CONSTRAINT `laboratoire_ibfk_1` FOREIGN KEY (`idetab`) REFERENCES `etablissement` (`idetab`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laboratoire_spe_fk` FOREIGN KEY (`idetab`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `membreproj`
--
ALTER TABLE `membreproj`
  ADD CONSTRAINT `membreproj_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `projrecher` (`codeproj`),
  ADD CONSTRAINT `membreproj_ibfk_2` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`);

--
-- Contraintes pour la table `menbrequip`
--
ALTER TABLE `menbrequip`
  ADD CONSTRAINT `menbrequip_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menbrequip_ibfk_2` FOREIGN KEY (`idequipe`) REFERENCES `equipe` (`idequipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `motscle`
--
ALTER TABLE `motscle`
  ADD CONSTRAINT `motscle_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD CONSTRAINT `ouvrage_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ouvrage_spe_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `pfemaster`
--
ALTER TABLE `pfemaster`
  ADD CONSTRAINT `pfemaster_chercheur_fk` FOREIGN KEY (`encadreur`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pfemaster_ibfk_1` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pfemaster_ibfk_2` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projrecher`
--
ALTER TABLE `projrecher`
  ADD CONSTRAINT `projrecher_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publication_ibfk_2` FOREIGN KEY (`coderevue`) REFERENCES `revue` (`coderevue`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publication_spe_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `revue`
--
ALTER TABLE `revue`
  ADD CONSTRAINT `revue_ibfk_1` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`);

--
-- Contraintes pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD CONSTRAINT `specialite_domaine_fk` FOREIGN KEY (`codeDomaine`) REFERENCES `domaine` (`codeDomaine`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `these`
--
ALTER TABLE `these`
  ADD CONSTRAINT `these_checheur_fk` FOREIGN KEY (`encadreur`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `these_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `these_spe_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `validationproduction`
--
ALTER TABLE `validationproduction`
  ADD CONSTRAINT `validation_chercheur_fk` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `validation_production_fk` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `suppNotif` ON SCHEDULE EVERY 1 HOUR STARTS '2020-05-14 14:52:39' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `projetfetud`.`notification` WHERE `date` < CURDATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
