-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 avr. 2020 à 15:36
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
(16, '', 20);

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
(16, 8);

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
(22, 'rabaoui', 'rabaoui@usthb.dz', 'DOC', 'doctorant'),
(23, 'newdoc', 'newdoc@usthb.dz', '', 'doctorant'),
(24, 'fleur', 'fleur@usthb.dz', 'PROF', 'permanent');

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
(0, 'yes bro', 20),
(21, '', 4),
(21, '', 5),
(21, '', 20);

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
(4, 'COM23', 22, 'COM23', 1);

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
  `periodicite` enum('annuel','semestriel') NOT NULL,
  `type` enum('nationale','internationale') NOT NULL,
  `classe` enum('A','B','C') NOT NULL,
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
(37, 'pub'),
(38, 'mecanique');

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
(8, 'Traitement du langage', 5, 37);

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
(41, 'CERIST', '', 'université', '', 21355, 213, 'cerist.dz');

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
(40, 44, 'mecanique and chill', '', '', 0000, 0, 'actif', 1, 'fac mecanique', 0, '');

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
(22, 8),
(23, 8);

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
(20, 'b'),
(20, 'p'),
(20, 'u');

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
(5, 25, 'ouv55', 500, 'five', 'five.5');

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
(10, 'PM15', 30, 16, 'PM15');

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
(20, '2005-04', 'publication');

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
(2, 'p2', 5, 2, 0, 0, 0, 'p2'),
(20, 'pub', 42, 3, 0, 12, 12, 'pub');

-- --------------------------------------------------------

--
-- Structure de la table `revue`
--

CREATE TABLE `revue` (
  `coderevue` int(12) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `periodicite` varchar(20) NOT NULL,
  `issnonline` varchar(40) NOT NULL,
  `issnprint` varchar(40) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `annee` varchar(4) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `classe` enum('A*','A','B','C') NOT NULL,
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
(42, 'pub', '', 37),
(43, 'nawawi', '', 37),
(44, 'culasse', '', 38);

-- --------------------------------------------------------

--
-- Structure de la table `systemenotes`
--

CREATE TABLE `systemenotes` (
  `revueInterAA` int(2) NOT NULL,
  `revueInterA` int(2) NOT NULL,
  `revueInterB` int(2) NOT NULL,
  `revueInterC` int(2) NOT NULL,
  `revueNat` int(2) NOT NULL,
  `autre` int(2) NOT NULL,
  `comInterA` int(2) NOT NULL,
  `comInterB` int(2) NOT NULL,
  `comInterC` int(2) NOT NULL,
  `comNat` int(2) NOT NULL,
  `chapitreOuvrage` int(2) NOT NULL,
  `ouvrage` int(2) NOT NULL,
  `id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `systemenotes`
--

INSERT INTO `systemenotes` (`revueInterAA`, `revueInterA`, `revueInterB`, `revueInterC`, `revueNat`, `autre`, `comInterA`, `comInterB`, `comInterC`, `comNat`, `chapitreOuvrage`, `ouvrage`, `id`) VALUES
(60, 50, 40, 20, 20, 10, 30, 20, 10, 10, 30, 100, 1);

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
(9, 'TD10', 16, 'TD', 8, 'TD', 29);

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
(21, 'omar.rabhi@usthb.dz', 'lol', 0),
(22, 'rabaoui@usthb.dz', 'lol', 0),
(23, 'newdoc@usthb.dz', 'lol', 0),
(24, 'fleur@usthb.dz', 'lol', 1);

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
  ADD KEY `idcher` (`idcher`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chercheur`
--
ALTER TABLE `chercheur`
  MODIFY `idcher` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `conference`
--
ALTER TABLE `conference`
  MODIFY `codeconf` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `codeDomaine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `idetab` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `index`
--
ALTER TABLE `index`
  MODIFY `numindex` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `idlabo` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `codepro` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `idspe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
