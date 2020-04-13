-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 avr. 2020 à 17:57
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
  `codepro` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chapitredouvrage`
--

CREATE TABLE `chapitredouvrage` (
  `codepro` int(12) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `volume` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chefequip`
--

CREATE TABLE `chefequip` (
  `idcher` int(12) NOT NULL,
  `idequipe` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(16, 37);

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
(16, 'Sid ahmed', 'sid.ahmedl@usthb.dz', 'MCA', 'permanent');

-- --------------------------------------------------------

--
-- Structure de la table `coauteurs`
--

CREATE TABLE `coauteurs` (
  `idcher` int(12) NOT NULL,
  `codepro` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `communication`
--

CREATE TABLE `communication` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `mois` int(2) NOT NULL,
  `anne` year(4) NOT NULL,
  `url` varchar(40) NOT NULL,
  `codeconf` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `conference`
--

CREATE TABLE `conference` (
  `codeconf` int(12) NOT NULL,
  `nomconf` varchar(255) NOT NULL,
  `abrv` varchar(20) NOT NULL,
  `idspe` int(12) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `mois` int(2) NOT NULL,
  `annee` year(4) NOT NULL,
  `periodicite` varchar(20) NOT NULL,
  `type` int(2) NOT NULL,
  `classe` varchar(2) NOT NULL,
  `numindex` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'biologie');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idequipe` int(12) NOT NULL,
  `nomequip` varchar(40) NOT NULL,
  `idlabo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idequipe`, `nomequip`, `idlabo`) VALUES
(1, 'gl', 33),
(8, 'teamlol4', 37);

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
(1, 'universite des sciences et technologies houari boumediene', 'USTHB', 'université', 'el alia bab ezzouar ', 21300, 21301, 'usthb.dz');

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

INSERT INTO `laboratoire` (`idlabo`, `nom`, `abrv`, `addresse`, `anneecrea`, `tel`, `etat`, `idetab`, `structure`, `fax`, `mail`) VALUES
(33, 'sys info', 'lsi', '', 2001, 0, 'actif', 1, 'elec info', 0, ''),
(35, 'holehola', '', '', 0000, 0, 'inactif', 1, '', 0, ''),
(37, 'djzaodiazj dpzojadpoazdopazjda', '', '', 0000, 0, 'actif', 1, '', 0, '');

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

-- --------------------------------------------------------

--
-- Structure de la table `motscle`
--

CREATE TABLE `motscle` (
  `codepro` int(12) NOT NULL,
  `mot` varchar(20) NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `codepro` int(11) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `nbpages` int(4) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `mois` int(2) NOT NULL,
  `anneeparution` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pfemaster`
--

CREATE TABLE `pfemaster` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `binome` varchar(255) NOT NULL,
  `mois` int(2) NOT NULL,
  `annee` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

CREATE TABLE `production` (
  `codepro` int(12) NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `coderevue` int(12) NOT NULL,
  `doi` int(11) NOT NULL,
  `nvol` int(11) NOT NULL,
  `nissue` int(11) NOT NULL,
  `url` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `revue`
--

CREATE TABLE `revue` (
  `coderevue` int(12) NOT NULL,
  `issnonLine` varchar(40) NOT NULL,
  `issnprint` varchar(40) NOT NULL,
  `editeur` varchar(40) NOT NULL,
  `mois` int(2) NOT NULL,
  `annee` year(4) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `classe` varchar(2) NOT NULL,
  `numindex` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 'bio syntheese', 'bs', 2);

-- --------------------------------------------------------

--
-- Structure de la table `specialiteequipe`
--

CREATE TABLE `specialiteequipe` (
  `idspe` int(12) NOT NULL,
  `idequipe` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `specialiteequipe`
--

INSERT INTO `specialiteequipe` (`idspe`, `idequipe`) VALUES
(2, 8),
(3, 8),
(4, 8),
(5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `specialitelabo`
--

CREATE TABLE `specialitelabo` (
  `idspe` int(12) NOT NULL,
  `idlabo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `specialitelabo`
--

INSERT INTO `specialitelabo` (`idspe`, `idlabo`) VALUES
(1, 37),
(2, 37),
(4, 33),
(7, 35);

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
  `encadreur` varchar(40) NOT NULL,
  `mois` int(2) NOT NULL,
  `annee` year(4) NOT NULL,
  `lieusout` varchar(40) NOT NULL,
  `nordre` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(16, 'sid.ahmedl@usthb.dz', 'lol', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurprinc`
--
ALTER TABLE `auteurprinc`
  ADD PRIMARY KEY (`idcher`,`codepro`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `chapitredouvrage`
--
ALTER TABLE `chapitredouvrage`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`);

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
  ADD PRIMARY KEY (`idcher`,`codepro`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `communication`
--
ALTER TABLE `communication`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `codeconf` (`codeconf`);

--
-- Index pour la table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`codeconf`),
  ADD KEY `idspe` (`idspe`),
  ADD KEY `numindex` (`numindex`);

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
  ADD KEY `idlabo` (`idlabo`);

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
  ADD KEY `idetab` (`idetab`);

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
  ADD KEY `codepro` (`codepro`);

--
-- Index pour la table `pfemaster`
--
ALTER TABLE `pfemaster`
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codepro` (`codepro`),
  ADD KEY `idspe` (`idspe`);

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
  ADD KEY `coderevue` (`coderevue`);

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
-- Index pour la table `specialiteequipe`
--
ALTER TABLE `specialiteequipe`
  ADD PRIMARY KEY (`idspe`,`idequipe`),
  ADD KEY `idspe` (`idspe`),
  ADD KEY `idequipe` (`idequipe`);

--
-- Index pour la table `specialitelabo`
--
ALTER TABLE `specialitelabo`
  ADD PRIMARY KEY (`idspe`,`idlabo`),
  ADD KEY `idspe` (`idspe`),
  ADD KEY `idlabo` (`idlabo`);

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
  ADD KEY `codepro` (`codepro`);

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
  MODIFY `idcher` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `codeDomaine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `idetab` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `index`
--
ALTER TABLE `index`
  MODIFY `numindex` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `idlabo` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `codepro` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projrecher`
--
ALTER TABLE `projrecher`
  MODIFY `codeproj` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `revue`
--
ALTER TABLE `revue`
  MODIFY `coderevue` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `idspe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `auteurprinc_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`),
  ADD CONSTRAINT `auteurprinc_ibfk_2` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `chapitredouvrage`
--
ALTER TABLE `chapitredouvrage`
  ADD CONSTRAINT `chapitredouvrage_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

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
  ADD CONSTRAINT `coauteurs_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`),
  ADD CONSTRAINT `coauteurs_ibfk_2` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`);

--
-- Contraintes pour la table `communication`
--
ALTER TABLE `communication`
  ADD CONSTRAINT `communication_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`),
  ADD CONSTRAINT `communication_ibfk_2` FOREIGN KEY (`codeconf`) REFERENCES `conference` (`codeconf`);

--
-- Contraintes pour la table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`),
  ADD CONSTRAINT `conference_ibfk_2` FOREIGN KEY (`numindex`) REFERENCES `index` (`numindex`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_2` FOREIGN KEY (`idlabo`) REFERENCES `laboratoire` (`idlabo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  ADD CONSTRAINT `laboratoire_ibfk_1` FOREIGN KEY (`idetab`) REFERENCES `etablissement` (`idetab`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `motscle_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD CONSTRAINT `ouvrage_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `pfemaster`
--
ALTER TABLE `pfemaster`
  ADD CONSTRAINT `pfemaster_ibfk_1` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`),
  ADD CONSTRAINT `pfemaster_ibfk_2` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `projrecher`
--
ALTER TABLE `projrecher`
  ADD CONSTRAINT `projrecher_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`),
  ADD CONSTRAINT `publication_ibfk_2` FOREIGN KEY (`coderevue`) REFERENCES `revue` (`coderevue`);

--
-- Contraintes pour la table `revue`
--
ALTER TABLE `revue`
  ADD CONSTRAINT `revue_ibfk_1` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`),
  ADD CONSTRAINT `revue_ibfk_2` FOREIGN KEY (`numindex`) REFERENCES `index` (`numindex`);

--
-- Contraintes pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD CONSTRAINT `specialite_domaine_fk` FOREIGN KEY (`codeDomaine`) REFERENCES `domaine` (`codeDomaine`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `specialiteequipe`
--
ALTER TABLE `specialiteequipe`
  ADD CONSTRAINT `specialite_equipe_fk` FOREIGN KEY (`idequipe`) REFERENCES `equipe` (`idequipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `speequipe_specialite_fk` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `specialitelabo`
--
ALTER TABLE `specialitelabo`
  ADD CONSTRAINT `this_laboratoire` FOREIGN KEY (`idlabo`) REFERENCES `laboratoire` (`idlabo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `this_specialite` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `these`
--
ALTER TABLE `these`
  ADD CONSTRAINT `these_ibfk_1` FOREIGN KEY (`codepro`) REFERENCES `production` (`codepro`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
