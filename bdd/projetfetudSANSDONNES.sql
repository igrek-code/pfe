-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 21 juin 2020 à 17:20
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

-- --------------------------------------------------------

--
-- Structure de la table `auteurprinc`
--

CREATE TABLE `auteurprinc` (
  `idcher` int(12) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `codepro` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `pages` varchar(40) NOT NULL,
  `isbn` varchar(40) NOT NULL
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

-- --------------------------------------------------------

--
-- Structure de la table `chefproj`
--

CREATE TABLE `chefproj` (
  `idcher` int(12) NOT NULL,
  `codeproj` varchar(40) NOT NULL
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
  `gradeC` enum('Directeur de recherche','Maitre de recherche','Chargé de recherche','Attaché de recherche','Docteur','Doctorant') NOT NULL,
  `profil` enum('permanent','doctorant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `coauteurs`
--

CREATE TABLE `coauteurs` (
  `idcher` int(12) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `codepro` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `codeDomaine` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idequipe` int(12) NOT NULL,
  `nomequip` varchar(40) NOT NULL,
  `etat` enum('actif','inactif') NOT NULL DEFAULT 'actif',
  `idspe` int(12) NOT NULL,
  `idlabo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idspe` int(12) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Structure de la table `membreproj`
--

CREATE TABLE `membreproj` (
  `idcher` int(11) NOT NULL,
  `codeproj` varchar(40) NOT NULL
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
  `mot` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `motscler`
--

CREATE TABLE `motscler` (
  `codeproj` varchar(40) NOT NULL,
  `mot` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `url` varchar(40) NOT NULL,
  `isbn` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pfemaster`
--

CREATE TABLE `pfemaster` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `nprojet` varchar(100) NOT NULL,
  `idspe` int(12) NOT NULL,
  `encadreur` int(12) NOT NULL,
  `lieusout` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

CREATE TABLE `production` (
  `codepro` int(12) NOT NULL,
  `date` varchar(7) NOT NULL,
  `type` enum('communication','ouvrage','chapitreOuvrage','publication','doctorat','master') NOT NULL,
  `codeproj` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `projrecher`
--

CREATE TABLE `projrecher` (
  `codeproj` varchar(40) NOT NULL,
  `date` varchar(7) NOT NULL,
  `intitule` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `duree` int(4) NOT NULL,
  `etat` enum('en cours','reconduit','clôturé') NOT NULL,
  `codeDomaine` int(11) DEFAULT NULL,
  `fichier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `idspe` int(12) NOT NULL,
  `coderevue` int(12) NOT NULL,
  `doi` varchar(50) NOT NULL,
  `nvol` int(11) NOT NULL,
  `nissue` varchar(50) NOT NULL,
  `url` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `revue`
--

CREATE TABLE `revue` (
  `coderevue` int(12) NOT NULL,
  `nom` varchar(250) NOT NULL,
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

-- --------------------------------------------------------

--
-- Structure de la table `these`
--

CREATE TABLE `these` (
  `codepro` int(12) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `encadreur` varchar(250) NOT NULL,
  `lieusout` varchar(40) NOT NULL,
  `nordre` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `idspe` int(12) NOT NULL
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
  ADD PRIMARY KEY (`codeproj`),
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
  ADD PRIMARY KEY (`idcher`,`codeproj`),
  ADD KEY `idcher` (`idcher`),
  ADD KEY `codeproj` (`codeproj`);

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
-- Index pour la table `motscler`
--
ALTER TABLE `motscler`
  ADD PRIMARY KEY (`codeproj`,`mot`),
  ADD KEY `codeproj` (`codeproj`);

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
  ADD PRIMARY KEY (`codepro`),
  ADD KEY `codeproj` (`codeproj`);

--
-- Index pour la table `projrecher`
--
ALTER TABLE `projrecher`
  ADD PRIMARY KEY (`codeproj`),
  ADD KEY `codeDomaine` (`codeDomaine`);

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
  ADD KEY `idspe` (`idspe`);

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
  MODIFY `idcher` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conference`
--
ALTER TABLE `conference`
  MODIFY `codeconf` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `codeDomaine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `idetab` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `index`
--
ALTER TABLE `index`
  MODIFY `numindex` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `idlabo` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `codepro` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `revue`
--
ALTER TABLE `revue`
  MODIFY `coderevue` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `idspe` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `systemenotes`
--
ALTER TABLE `systemenotes`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `chef_projet_fk` FOREIGN KEY (`codeproj`) REFERENCES `projrecher` (`codeproj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chefproj_ibfk_1` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `laboratoire_ibfk_k` FOREIGN KEY (`idspe`) REFERENCES `specialite` (`idspe`);

--
-- Contraintes pour la table `membreproj`
--
ALTER TABLE `membreproj`
  ADD CONSTRAINT `membre_projet_fk` FOREIGN KEY (`codeproj`) REFERENCES `projrecher` (`codeproj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membreproj_ibfk_2` FOREIGN KEY (`idcher`) REFERENCES `chercheur` (`idcher`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Contraintes pour la table `motscler`
--
ALTER TABLE `motscler`
  ADD CONSTRAINT `motscle_projet_fk` FOREIGN KEY (`codeproj`) REFERENCES `projrecher` (`codeproj`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Contraintes pour la table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `production_projcher_fk` FOREIGN KEY (`codeproj`) REFERENCES `projrecher` (`codeproj`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `projrecher`
--
ALTER TABLE `projrecher`
  ADD CONSTRAINT `projet_domaine_fk` FOREIGN KEY (`codeDomaine`) REFERENCES `domaine` (`codeDomaine`) ON DELETE SET NULL ON UPDATE SET NULL;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
