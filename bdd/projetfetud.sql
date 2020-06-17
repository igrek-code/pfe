-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 juin 2020 à 21:58
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.28

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
(16, '', 58),
(0, 'verifP', 101),
(31, '', 104),
(31, '', 105),
(38, '', 106),
(46, '', 107),
(96, '', 108),
(0, 'Seba Abderezak', 109),
(0, 'Boukhechem Nadir', 110),
(0, 'Barcelo-Ordinas Jose M', 111),
(0, 'Sadi Mustapha', 112),
(89, '', 113),
(0, 'Amine Boulemtafes', 114),
(40, '', 115),
(40, '', 116),
(33, '', 117),
(33, '', 118),
(0, 'Imene Mezenner', 119),
(46, '', 120),
(45, '', 121),
(0, 'Khadidja Bennaceur', 122),
(66, '', 123),
(67, '', 124),
(42, '', 138),
(0, 'Mahseur mohamed', 139),
(32, '', 152),
(0, 'Mohamed Boubenia', 153),
(0, 'Koubai Nesrine', 154),
(55, '', 155),
(0, 'Wassila Guendouzi', 159),
(67, '', 160),
(0, 'L.Mokdad', 161),
(96, '', 164),
(76, '', 165),
(96, '', 166),
(53, '', 167);

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

--
-- Déchargement des données de la table `chapitredouvrage`
--

INSERT INTO `chapitredouvrage` (`codepro`, `titre`, `editeur`, `volume`, `url`, `idspe`, `pages`, `isbn`) VALUES
(113, 'Novel Design and Applications of Robotic', 'IGI Global', 7, 'https://www.igi-global.com/gateway/chapter/212064', 133, '188-216', '9781522552765'),
(114, 'Sensing Platforms for Prototyping and Ex', 'IGI Global', 13, 'https://www.igi-global.com/chapter/sensing-platforms-for-prototyping-and-experimenting-wearable-continuous-health-monitoring-systems/238980', 134, '212-223', '9781799810902'),
(159, 'An Enhanced Bat Echolocation Approach fo', 'Springer', 3, 'https://www.springer.com/gp/book/9783319582528', 196, '477-493', ' 978-3-319-58253-5');

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
(38, 16),
(49, 17),
(50, 18),
(30, 19),
(51, 20),
(92, 21),
(94, 22);

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
(30, 43),
(92, 44);

-- --------------------------------------------------------

--
-- Structure de la table `chefproj`
--

CREATE TABLE `chefproj` (
  `idcher` int(12) NOT NULL,
  `codeproj` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chefproj`
--

INSERT INTO `chefproj` (`idcher`, `codeproj`) VALUES
(30, 'C00L07UN160420180002'),
(38, 'C00L07UN160420180017'),
(39, 'C00L07UN160420180016'),
(49, 'B*00220130123');

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

--
-- Déchargement des données de la table `chercheur`
--

INSERT INTO `chercheur` (`idcher`, `nom`, `mail`, `grade`, `gradeC`, `profil`) VALUES
(16, 'Sid ahmed', 'sid.ahmedl@usthb.dz', 'MCA', 'Directeur de recherche', 'permanent'),
(21, 'omar rabhi', 'omar.rabhi@usthb.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(23, 'newdoc', 'newdoc@usthb.dz', '', 'Directeur de recherche', 'doctorant'),
(24, 'fleur', 'fleur@usthb.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(26, 'xwqinsosiqdioqsn', 'newdoc@usthb.dz', '', 'Directeur de recherche', 'doctorant'),
(27, 'new doc 5', 'newdoc5@usthb.dz', 'MCA', 'Directeur de recherche', 'permanent'),
(28, 'omar rabhi', 'omar@usthb.dz', 'MCB', 'Directeur de recherche', 'permanent'),
(30, 'Belkhir Abdelkader', 'kaderbelkhir@hotmail.com', 'PROF', 'Directeur de recherche', 'permanent'),
(31, 'Bouyakoub Fayçal', 'fbouyakoub@usthb.dz', 'PROF', 'Maitre de recherche', 'permanent'),
(32, 'Bouyakoub Samia', 'sbouyakoub@usthb.dz', 'MCB', 'Maitre de recherche', 'permanent'),
(33, 'Tiberkak Allel', 'allal.tiberkak@gmail.com', 'MAA', 'Attaché de recherche', 'permanent'),
(34, 'Guebli Wassila', 'guebliwas@gmail.com', 'MAA', 'Attaché de recherche', 'permanent'),
(35, 'Belkhirat Ahmed', 'belkhirat@yahoo.fr', 'MAA', 'Directeur de recherche', 'permanent'),
(36, 'Zebbouchi Karima', 'Zebouchi_karima@live.fr', '', 'Doctorant', 'doctorant'),
(37, 'Boubenia Mohamed', 'mboubenia@live.fr', '', 'Doctorant', 'doctorant'),
(38, 'Ahmed Nacer Mohamed	', 'anacer@mail.cerist.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(39, 'Boukra Abdelmadjid', 'amboukra@yahoo.fr', 'PROF', 'Directeur de recherche', 'permanent'),
(40, 'Berbar Ahmed', 'berbar@hotmail.com', 'MAA', 'Directeur de recherche', 'permanent'),
(41, 'Boussaid Ilhem', 'Ilhem_boussaid@yahoo.fr', 'MCB', 'Attaché de recherche', 'permanent'),
(42, 'Benabidallah Rymel', 'relym@hotmail.fr', '', 'Doctorant', 'doctorant'),
(43, 'Hachichi Assia', 'Assia.hachichi@gmail.com', 'MCB', 'Attaché de recherche', 'permanent'),
(44, 'Djouadi Mohamed', 'djouadi@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(45, 'Khemissa Hamid', 'hkhemissa@gmail.com', 'MCB', 'Attaché de recherche', 'permanent'),
(46, 'Hachemi Asma', 'Asma_hachemi@yahoo.fr', 'MAB', 'Attaché de recherche', 'permanent'),
(47, 'Berghida Meriem', 'Computer1989@live.fr', '', 'Doctorant', 'doctorant'),
(48, 'Ichallamen Linda', 'lichallamen@yahoo.com', '', 'Doctorant', 'doctorant'),
(49, 'Alimazighi Zaia', 'zalimazighi@usthb.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(50, 'Mazouz Samia', 'Mazouz_63@yahoo.com', 'MCA', 'Directeur de recherche', 'permanent'),
(51, 'Badache Nadjib', 'badache@mail.cerist.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(52, 'Boukhalfa Kamel', 'kboukhalfa@usthb.dz', 'MCA', 'Chargé de recherche', 'permanent'),
(53, 'Boukheddouma Saida', 'sboukhedouma@usthb.dz', 'MAA', 'Chargé de recherche', 'permanent'),
(54, 'Derbal Khalissa', 'kderbal@usthb.dz', 'MAA', 'Chargé de recherche', 'permanent'),
(55, 'Selmoune Nazih', 'nselmoune@usthb.dz', 'MAA', 'Chargé de recherche', 'permanent'),
(56, 'Djiroun Rahma', 'rdjiroun@usthb.dz', 'MAA', 'Chargé de recherche', 'permanent'),
(57, 'Hamdah Mohamed', 'hamdah_m@yahoo.fr', 'MAA', 'Chargé de recherche', 'permanent'),
(58, 'Hamdah Mohamed', 'hamdah_m@yahoo.fr', 'MAA', 'Chargé de recherche', 'permanent'),
(59, 'Ouahrani Leila', 'louahrano@hotmail.com', 'MAA', 'Maitre de recherche', 'permanent'),
(60, 'Ouahrani Leila', 'louahrano@hotmail.com', 'MAA', 'Directeur de recherche', 'permanent'),
(61, 'Azzouz Mahdia', 'peace_maha@yahoo.fr', 'MAA', 'Attaché de recherche', 'permanent'),
(62, 'Challal Zakia	MAB', 'zakiachallal@usthb.dz', 'MAB', 'Attaché de recherche', 'permanent'),
(63, 'Frihi Ibtissem', 'i.frihi@gmail.com', 'MAB', 'Attaché de recherche', 'permanent'),
(64, 'Kessi Kahina', 'kakessi@hotmail.fr', '', 'Doctorant', 'doctorant'),
(65, 'Bentarzi Nassim', 'nbentarzi@usthb.dz', '', 'Doctorant', 'doctorant'),
(66, 'Abdelli Abdelkrim', 'abdelli@hotmail.com', 'PROF', 'Directeur de recherche', 'permanent'),
(67, 'Hammal Youcef', 'yhammal@hotmail.com', 'MCB', 'Directeur de recherche', 'permanent'),
(68, 'Benkaouha Haroun', 'benkaouha@lsi-usthb.dz', 'MAA', 'Chargé de recherche', 'permanent'),
(69, 'Djouamaa Amir', 'djouama.amir@gmail.com', 'MCB', 'Attaché de recherche', 'permanent'),
(70, 'Benchaiba Mahfoud', 'mbenchaiba@usthb.dz', 'MCA', 'Chargé de recherche', 'permanent'),
(71, 'Benzaid Chafika', 'cbenzaid@usthb.dz', 'MCB', 'Attaché de recherche', 'permanent'),
(72, 'Chenail Manel', 'mchenait@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(73, 'Chenail Manel', 'mchenait@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(74, 'Zebbane Bahia', 'bzebbane@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(75, 'Aliouane Linda', 'laliouane@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(76, 'Saadi Abdelfetah', 'afsaadi@gmail.com', 'MAA', 'Attaché de recherche', 'permanent'),
(77, 'Haddouche Nadia', 'mhaddouche@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(78, 'Bouziane Nabila', 'mbouziane@usthb.dz', 'MAA', 'Attaché de recherche', 'permanent'),
(79, 'Lalouani Wassila', 'Lalouani_wassila@yahoo.fr', 'MAA', 'Attaché de recherche', 'permanent'),
(80, 'Zerraoulia Khaled', 'kzeraoulia@usthb.dz', 'MAA', 'Directeur de recherche', 'permanent'),
(81, 'Hadj Henni M’hamed', 'hadjhenni@gmail.com', 'MAA', 'Attaché de recherche', 'permanent'),
(82, 'Rouibeh Said.', 'saidrouibeh@gmail.com', 'MAA', 'Attaché de recherche', 'permanent'),
(83, 'zamusta@yahoo.fr', 'zamusta@yahoo.fr', 'MAA', 'Directeur de recherche', 'permanent'),
(84, 'Seddiki Manel', 'Sed.manel@gmail.com', 'DOC', 'Docteur', 'permanent'),
(85, 'Belguerche Nadia', 'n.belguerche@yahoo.fr', 'MAA', 'Attaché de recherche', 'permanent'),
(86, 'Dib Chahrazed', 'chehrazeddib@hotmail.fr', 'MAB', 'Attaché de recherche', 'permanent'),
(87, 'Gati Hania', 'Hani.gati@gmail.com', 'MAB', 'Attaché de recherche', 'permanent'),
(88, 'Bouyahia Karima', 'Bouyahia.k@gmail.com', 'MAB', 'Attaché de recherche', 'permanent'),
(89, 'Allali Sarah', 'allalisarah@gmail.com', 'DOC', 'Doctorant', 'permanent'),
(90, 'Medjadba Sana', 's.medjadba@gmail.com', 'MAA', 'Attaché de recherche', 'permanent'),
(91, 'Saiah Amin', 'a.saiah@univ.chlef.dz', 'MAB', 'Attaché de recherche', 'permanent'),
(92, 'Habiba Drias', 'driass@usthb.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(93, 'lyès Khennak', 'lyesKhennak@usthb.dz', 'MCB', 'Chargé de recherche', 'permanent'),
(94, 'Saliha Aouat', 'SalihaAouat@usthb.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(95, 'Nadia Baha-Touzène', 'NadiaBahaTouzene@usthb.dz', 'PROF', 'Directeur de recherche', 'permanent'),
(96, 'Rahmani Moufida', 'RahmaniMoufida@usthb.dz', '', 'Doctorant', 'doctorant');

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
(0, ' L.MOKDAD', 124),
(0, 'Abdelfetah Hentout', 117),
(0, 'Abdelfetah Hentout', 118),
(0, 'Abdelkader Bellarbi', 118),
(0, 'Abderazzak Henni', 165),
(0, 'Amad Mourad', 112),
(0, 'another one', 5),
(0, 'C23', 4),
(0, 'CH CO9', 7),
(0, 'com8', 58),
(0, 'Doudou Messaoud', 111),
(0, 'Garcia-Vidal Jorge', 111),
(0, 'L.MOKDAD', 123),
(0, 'Mourad Oussalah', 121),
(0, 'Mourad Oussalah', 165),
(0, 'Nadia Zenati', 118),
(0, 'Nouali-Taboudjemat Nadia', 109),
(0, 'Samir Benbelkacem', 118),
(0, 'seba hamida', 109),
(0, 'what ', 4),
(0, 'yacine Meraihi', 139),
(21, '', 5),
(23, '', 52),
(23, '', 53),
(23, '', 54),
(23, '', 55),
(23, '', 56),
(30, '', 104),
(30, '', 105),
(30, '', 115),
(30, '', 116),
(30, '', 117),
(30, '', 152),
(31, '', 119),
(31, '', 152),
(31, '', 153),
(31, '', 154),
(32, '', 119),
(34, '', 152),
(38, '', 120),
(38, '', 122),
(38, '', 138),
(39, '', 106),
(39, '', 139),
(39, '', 159),
(49, '', 155),
(49, '', 167),
(51, '', 109),
(51, '', 110),
(51, '', 111),
(51, '', 112),
(51, '', 114),
(66, '', 124),
(66, '', 160),
(66, '', 161),
(67, '', 123),
(70, '', 107),
(70, '', 108),
(70, '', 113),
(70, '', 160),
(70, '', 164),
(70, '', 166),
(84, '', 160),
(84, '', 164);

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
(115, 'e-health platform', 135, 'url', 2),
(116, 'Identification in the service of national solidarity', 137, 'http://www.medi-ast.org/sca19/index.html', 3),
(117, 'Computing and Communication Technologies for Home Health care in Algeria: A Review of the Literature', 139, 'url', 4),
(118, 'Developing an Enhanced NAT-Traversal Approach for Collaborative Augmented Reality e-Maintenance Platforms', 141, 'url', 5),
(119, 'Towards a time editor for orchestrating connected objects in web of things', 143, 'url', 6),
(120, 'Software Process Patterns Reuse', 145, 'www.icbicc.org/ueditor/php/upload/file/2', 7),
(121, 'Quality Model to the Adaptive Guidance', 147, 'https://cseit2019.org/ps.html', 8),
(122, 'Training Function Stability in Anomaly Intrusion Detection based Deep Learning', 149, 'url', 9),
(123, 'ISOCOV: a New MCDM Method to Handle Value Constraints in Web Service Selection ', 151, 'url', 10),
(124, 'Formal Approach for Compatibility Checking of Orchestrations of Composite Semantic Web Services', 152, 'url', 10),
(138, 'Utilisation des états d’un système de systèmes pour l’identification des comportements émergents négatifs', 170, 'url', 11),
(139, 'Improved Quantum Chaotic Animal Migration Optimization algorithm for QoS multicast routing problem', 172, 'url', 12),
(152, 'Smart airport: an IoT-based Airport Management System', 186, 'url', 13),
(153, 'Toward a Smart Restaurant with Context Management. In Smart Cities Symposium', 188, 'url', 14),
(154, 'Toward a Smart Restaurant with Context Management', 190, 'url', 15),
(160, 'Formal Specification and Analysis of a Cross-Layer Overlay P2P Construction Protocol over MANETs', 198, 'http://ieeexplore.ieee.org/document/7925', 16),
(161, 'Admission Control based on WRR', 199, 'http://ieeexplore.ieee.org/document/7925', 16),
(164, 'A Clustering-based Replication Strategy for Mobile P2P networks', 203, 'url', 17),
(165, 'An approach for the dynamic reconfiguration of software architecture', 204, 'url', 17);

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
(2, 'World Conference on Smart Trends in Systems, Security and Sustainability ', 'WS42019', '2019', 107, 'Smart Trends in Systems, Security and Sustainability', 'annuel', 'internationale', 'A', '', 0),
(3, 'International Conference on Smart City Applications ', 'SCA 2019', '2019', 136, 'Smart City Applications', 'annuel', 'internationale', 'A', '', 0),
(4, 'International Conference on Networking Telecommunications, Biomedical Engineering and Applications', 'ICNTBA’19)', '2019', 138, 'Networking Telecommunications, Biomedical Engineering and Applications', 'annuel', 'nationale', '', 'Algérie', 0),
(5, '7th International Conference on Control Engineering & Information Technology', 'CEIT2019', '2019', 140, 'Control Engineering & Information Technology', 'annuel', 'internationale', 'A', '', 0),
(6, 'International conference on Theoretical and applicative aspects of computer science', 'ctaacs', '2019', 142, 'Theoretical and applicative aspects of computer science', 'annuel', 'nationale', '', 'Algerie', 0),
(7, 'International Conference on Software Engineering and Computational Intelligence', 'CSECI 2019', '2019', 144, ' Software Engineering and Computational Intelligence', 'annuel', 'internationale', 'A', '', 0),
(8, '6th International Conference on Computer Science, Engineering and Information Technology ', 'CSEIT-2019', '2019', 146, 'Computer Science, Engineering and Information Technology ', 'annuel', 'internationale', 'A', '', 0),
(9, 'Conference on Control Automation and Diagnosis', 'ICCAD\'19', '2019', 148, 'Control Automation and Diagnosis', 'annuel', 'internationale', 'A', '', 0),
(10, 'IEEE ISCC Barcelona', 'IEEE ISCC', '2019', 150, 'IEEE ISCC Barcelona', 'annuel', 'internationale', 'A', '', 0),
(11, '27th IEEE International Conference on Enabling Track on Adaptive and Reconfigurable systems and architectures', 'AROSA', '2018', 169, 'Systeme', 'annuel', 'internationale', 'B', '', 0),
(12, '6th IFIP International Conference on Computational Intelligence and Its Applications', 'IFIP CIIA2018 ', '2018', 171, 'intelligence artificielle', 'annuel', 'nationale', '', 'Algerie', 0),
(13, 'International Conference on Future Networks and Distributed Systems', 'FTND', '2017', 185, 'Distributed Systems', 'annuel', 'internationale', 'A', '', 0),
(14, 'International Symposium on Programming and Systems', 'ISPS', '2018', 187, 'Systeme', 'annuel', 'internationale', 'A', '', 0),
(15, 'In Smart Cities Symposium', 'SCS2018', '2018', 189, 'informatique', 'annuel', 'internationale', 'B', '', 0),
(16, 'IEEE Wireless Communications and Networking Conference ', 'WCNC\'2017', '2017', 197, 'Wireless Communications and Networking', 'annuel', 'internationale', 'A', '', 0),
(17, 'IEEE International Conference Applied Smart Systems', 'ICASS2018', '2018', 201, 'Smart Systems', 'annuel', 'internationale', 'B', '', 0);

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
(78, 'com8'),
(79, 'verifP'),
(80, 'verifP'),
(81, 'verifP'),
(82, 'verif2'),
(83, 'yihoiolnmoijlkl'),
(84, 'yihoiolnmoijlkl'),
(85, 'yihoiolnmoijlkl'),
(91, 'yihoiolnmoijlkl'),
(94, 'lôkpokjpôk'),
(95, 'lôkpok'),
(96, 'informatique'),
(97, 'informatique'),
(98, 'informatique'),
(99, 'informatique'),
(100, 'informatique'),
(101, 'informatique'),
(102, 'informatique'),
(103, 'informatique'),
(104, 'informatique'),
(105, 'informatique'),
(106, 'biologie'),
(107, 'informatique'),
(108, 'informatique'),
(109, 'informatique'),
(110, 'informatique'),
(111, 'informatique'),
(112, 'informatique'),
(113, 'informatique'),
(114, 'informatique'),
(115, 'informatique'),
(116, 'informatique'),
(117, 'informatique'),
(118, 'informatique'),
(119, 'informatique'),
(120, 'informatique'),
(121, 'informatique'),
(122, 'informatique'),
(123, 'informatique'),
(124, 'informatique'),
(125, 'informatique'),
(126, 'informatique'),
(127, 'informatique'),
(128, 'informatique'),
(129, 'informatique'),
(130, 'informatique'),
(131, 'informatique'),
(132, 'informatique'),
(133, 'informatique'),
(134, 'informatique'),
(135, 'informatique'),
(136, 'informatique'),
(137, 'informatique'),
(138, 'informatique'),
(139, 'informatique'),
(140, 'informatique'),
(141, 'informatique'),
(142, 'informatique'),
(143, 'informatique'),
(144, 'informatique'),
(145, 'informatique'),
(146, 'informatique'),
(147, 'informatique'),
(148, 'informatique'),
(149, 'informatique'),
(150, 'informatique'),
(151, 'cloud'),
(152, 'informatique'),
(153, 'informatique'),
(154, 'informatique'),
(155, 'informatique'),
(156, 'C2C3'),
(157, 'C2C3'),
(158, 'informatique'),
(159, 'informatique'),
(160, 'informatique'),
(161, 'informatique'),
(162, 'informatique'),
(163, 'informatique'),
(164, 'informatique'),
(165, 'informatique'),
(166, 'informatique'),
(167, 'informatique'),
(168, 'informatique'),
(169, 'informatique'),
(170, 'informatique'),
(171, 'informatique'),
(172, 'informatique'),
(173, 'informatique'),
(174, 'informatique'),
(175, 'informatique'),
(176, 'informatique'),
(177, 'informatique'),
(178, 'informatique'),
(179, 'informatique'),
(180, 'informatique'),
(181, 'informatique'),
(182, 'informatique'),
(183, 'informatique'),
(184, 'informatique'),
(185, 'informatique'),
(186, 'informatique'),
(187, 'informatique'),
(188, 'informatique'),
(189, 'informatique'),
(190, 'informatique'),
(191, 'informatique'),
(192, 'informatique'),
(193, 'informatique'),
(194, 'informatique'),
(195, 'informatique'),
(196, 'informatique'),
(197, 'informatique'),
(198, 'informatique'),
(199, 'informatique'),
(200, 'informatique'),
(201, 'informatique'),
(202, 'informatique');

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

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idequipe`, `nomequip`, `etat`, `idspe`, `idlabo`) VALUES
(16, 'Génie Logiciel', 'actif', 95, 43),
(17, 'Ingénierie des Systèmes d’information', 'actif', 96, 43),
(18, 'Modélisation et Vérification des Système', 'actif', 97, 43),
(19, 'Web Technologie et Sécurité Informatique', 'actif', 98, 43),
(20, 'Mobilité', 'actif', 99, 43),
(21, 'Intelligence Artificielle et Data Mining', 'actif', 110, 44),
(22, 'Bio-Informatique et Robotique', 'actif', 111, 44),
(23, 'Optimisation, Raisonnement et Applicatio', 'actif', 112, 44),
(24, 'Représentation de Connaissances et Systè', 'actif', 113, 44),
(25, 'Traitement et Synthèse d’Images', 'actif', 114, 44);

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
(1, 'universite des sciences et technologies houari boumediene', 'USTHB', 'université', 'BP 32, El Alia, Bab Ezzouar, 16111 Alger', 21247911, 21247911, 'usthb.dz'),
(41, 'CERIST', '', 'centre de recherche', ' Rue Frères Aissou, Ben Aknoun 16028', 23255403, 23255403, 'cerist.dz'),
(43, 'L\'université d\'Alger Benyoucef Benkhedda', '', 'université', '2 Rue Didouche Mourad, Alger Ctre 16000', 21637765, 21637765, 'www.univ-alger.dz'),
(44, 'Ecole Nationale Polytechnique', '', 'université', '10 Rue des Frères OUDEK, El Harrach 1620', 21525303, 21525303, 'www.enp.ed'),
(45, 'Université des Sciences et de la Technologie d\'Oran - Mohamed Boudiaf', 'USTO', 'université', 'El Mnaouar، BP 1505, Bir El Djir 31000', 41557097, 41627172, 'www.univ-usto.dz');

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

--
-- Déchargement des données de la table `laboratoire`
--

INSERT INTO `laboratoire` (`idlabo`, `idspe`, `nom`, `abrv`, `addresse`, `anneecrea`, `tel`, `etat`, `idetab`, `structure`, `fax`, `mail`) VALUES
(43, 94, 'LABORATOIRE DES SYSTÈMES INFORMATIQUES', 'LSI', 'BP 32 Bab Ezzouar, 16111  ALGER', 2000, 21247911, 'actif', 1, '', 21247911, 'lsi@ushb.dz'),
(44, 100, 'Recherche en Intelligence Artificielle', 'LRIA', 'BP 32 Bab Ezzouar, 16111  ALGER', 2000, 21247911, 'actif', 1, '', 21247911, 'lria@ushb.dz'),
(51, 109, 'Laboratoire d\'écologie végétale et d\'environnement', 'LEVE', 'USTHB, BP32 EL ALIA, BAB EZZOUAR, ALGER, ALGERIE. ', 2010, 2147483647, 'actif', 1, '', 2147483647, 'hykadihanifi@yahoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `membreproj`
--

CREATE TABLE `membreproj` (
  `idcher` int(11) NOT NULL,
  `codeproj` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membreproj`
--

INSERT INTO `membreproj` (`idcher`, `codeproj`) VALUES
(31, 'C00L07UN160420180002'),
(32, 'C00L07UN160420180002'),
(33, 'C00L07UN160420180002'),
(34, 'C00L07UN160420180002'),
(41, 'C00L07UN160420180017'),
(43, 'C00L07UN160420180017'),
(45, 'C00L07UN160420180017'),
(47, 'C00L07UN160420180016'),
(53, 'B*00220130123'),
(61, 'B*00220130123');

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
(39, 16),
(40, 16),
(41, 16),
(42, 16),
(43, 16),
(44, 16),
(45, 16),
(46, 16),
(47, 16),
(48, 16),
(52, 17),
(53, 17),
(54, 17),
(55, 17),
(56, 17),
(57, 17),
(58, 17),
(59, 17),
(60, 17),
(61, 17),
(62, 17),
(63, 17),
(64, 17),
(65, 17),
(73, 17),
(66, 18),
(67, 18),
(68, 18),
(69, 18),
(31, 19),
(32, 19),
(33, 19),
(34, 19),
(35, 19),
(36, 19),
(37, 19),
(70, 20),
(71, 20),
(72, 20),
(74, 20),
(75, 20),
(76, 20),
(77, 20),
(78, 20),
(79, 20),
(80, 20),
(81, 20),
(82, 20),
(83, 20),
(84, 20),
(85, 20),
(86, 20),
(87, 20),
(88, 20),
(89, 20),
(90, 20),
(91, 20),
(96, 20),
(93, 21),
(95, 22);

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
(58, 'o'),
(101, 'verifP'),
(102, 'verif2'),
(104, 'E-tourism'),
(104, 'Web Services Researc'),
(105, ''),
(105, 'Computing'),
(105, 'Digital Systems'),
(106, ' cloud computing'),
(106, 'agility'),
(106, 'Algeria.'),
(106, 'CC'),
(106, 'KMS'),
(106, 'knowledge management'),
(106, 'small to medium-size'),
(106, 'SMO'),
(107, 'réseau'),
(107, 'sécurité'),
(107, 'système'),
(108, 'peer-to-peer'),
(109, 'Computer Application'),
(109, 'Network'),
(110, ' Wireless Sensor'),
(110, 'Actuator Networks'),
(111, 'sensor networks'),
(112, 'mobile Ad Hoc networ'),
(113, 'Robotics Technologie'),
(114, 'Health Monitoring Sy'),
(114, 'prototype'),
(115, 'sécurité'),
(115, 'système'),
(116, ' Urban Logistics Inn'),
(117, 'Home Health care'),
(117, 'technologies'),
(118, ' e-Maintenance Platf'),
(118, 'Augmented Reality'),
(119, ' orchestrating conne'),
(119, 'web of things'),
(120, 'Computational Intell'),
(120, 'Software Engineering'),
(121, 'Adaptive Guidance'),
(121, 'Quality Model'),
(122, ' Deep Learning'),
(123, 'Web Service'),
(124, 'Web Services'),
(125, 'application'),
(128, 'application'),
(129, 'processus Workflow'),
(130, 'cloud'),
(131, 'cloud'),
(132, 'système d’extraction'),
(135, 'réseau'),
(135, 'robots'),
(135, 'système'),
(136, 'réseau'),
(136, 'robots'),
(136, 'système'),
(137, 'WSN'),
(138, 'système'),
(139, 'algorithmique'),
(140, 'service web'),
(141, 'domotique'),
(142, 'informatique'),
(142, 'services basée'),
(143, 'réseau'),
(143, 'robots'),
(143, 'système'),
(144, 'réseau'),
(144, 'robots'),
(144, 'système'),
(145, 'routage'),
(145, 'sécurité'),
(146, 'réseaux'),
(146, 'wsn'),
(147, 'bioinformatique'),
(148, 'robot'),
(149, 'réseau'),
(150, 'robot'),
(151, 'BPEL'),
(152, 'management'),
(153, 'smart city'),
(154, 'Management'),
(155, 'design'),
(156, 'géo-décisionnel'),
(157, 'Web Service'),
(158, 'WS-CDL'),
(159, 'sécurité'),
(159, 'système'),
(160, 'Analysis'),
(160, 'Formal Specification'),
(161, 'control'),
(161, 'wrr'),
(162, 'génie logiciel'),
(164, 'peer-to-peer'),
(165, 'software architectur'),
(166, 'peer-to-peer'),
(167, 'hierarchical Petri-n'),
(168, 'Web Service'),
(169, 'Web Service');

-- --------------------------------------------------------

--
-- Structure de la table `motscler`
--

CREATE TABLE `motscler` (
  `codeproj` varchar(40) NOT NULL,
  `mot` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `motscler`
--

INSERT INTO `motscler` (`codeproj`, `mot`) VALUES
('B*00220130123', 'informatique'),
('C00L07UN160420180002', 'Identité numérique'),
('C00L07UN160420180002', 'services basés IoT'),
('C00L07UN160420180016', ' sécurité dans les réseaux'),
('C00L07UN160420180016', 'Cloud'),
('C00L07UN160420180016', 'informatique'),
('C00L07UN160420180016', 'Routage'),
('C00L07UN160420180017', 'informatique');

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
(28, 'vous devez yes', '2020-05-30', 'urgent', 0, 0),
(30, 'etablir bilan', '2020-06-11', 'urgent', 0, 0),
(92, 'etablir bilan', '2020-06-01', 'urgent', 0, 1);

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

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`codepro`, `idspe`, `titre`, `nbpages`, `editeur`, `url`, `isbn`) VALUES
(51, 79, 'OB', 200, 'OB', 'OB', ''),
(52, 80, 'OB2', 500, 'OB2', 'OB2', ''),
(53, 81, 'OB2', 500, 'OB2', 'OB2', ''),
(54, 82, 'OB2', 500, 'OB2', 'OB2', ''),
(55, 83, 'OB2', 500, 'OB2', 'OB2', ''),
(56, 84, 'OB2', 500, 'OB2', 'OB2', '');

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

--
-- Déchargement des données de la table `pfemaster`
--

INSERT INTO `pfemaster` (`codepro`, `titre`, `nprojet`, `idspe`, `encadreur`, `lieusout`) VALUES
(125, 'plateforme de services basée IoT : application à la e-santé', '', 153, 30, 'usthb'),
(128, 'Conception et réalisation d’une application pour l’évaluation de la performance commerciale d’une entreprise', '', 156, 53, 'usthb'),
(129, 'Analyse des modèles de processus Workflow orientés services sur la base de métriques', '', 157, 53, 'usthb'),
(130, 'Approche de recommandation de services basée sur les Réseaux Sociaux dans un Cloud', '', 158, 56, 'usthb'),
(131, 'Approche de recommandation et de design de cubes de données dans un Cloud', '', 159, 56, 'usthb'),
(132, 'Conception et réalisation d’un système d’extraction et d’intégration des Linked Open Data dans un contexte de Business Intelligence', '', 160, 56, 'usthb'),
(135, 'Détection et réparation de trous dans les réseaux de capteurs et de robots sans fil', '09/2019', 166, 85, 'usthb'),
(136, 'Relocation de capteurs dans les réseaux de capteurs et robots sans fils', '010/2019', 167, 85, 'usthb'),
(137, 'Dissémination tolérante aux pannes avec QoS dans les WSNs basés smart cities', '011/2019', 168, 68, 'usthb'),
(142, 'plateforme de services basée IoT : application à la e-santé', '012/2020', 175, 30, 'usthb'),
(143, 'Intelligence d\'essaim pour la coopération de robots mobiles : Approche colonie de Fourmiesessaim particulaire ', '013/2018', 176, 39, 'usthb'),
(144, 'Approche Bio-inspirée pour la coordination de robots dans un milieu hostile : Approche colonie de Fourmies-firefly', '014/2018', 177, 39, 'usthb'),
(146, 'Minimisation de la consommation d’énergie dans les réseaux de capteurs (wsn) par une approche coopérative de méta heuristiques', '015/2019', 179, 39, 'usthb'),
(147, 'Contribution à la Résolution Coopérative Approchée de problèmes en Bioinformatique : assemblage de Fragments d’ADN et Alignement de Séquences', '01/2017', 180, 39, 'usthb'),
(150, 'Exploration d\'un espace à environnement hostile par des robots en utilisant une approche bioinspirée: colonie de Fourmiescolonie d\'abeilles', '02/2017', 183, 39, 'usthb'),
(151, 'Edition de modèles de processus BPEL temporisé', '04/2017', 184, 32, 'usthb'),
(156, 'Vers un service géo-décisionnel multi-profils dans le cloud appliqué à l’accidentologie', '010/2018', 193, 55, 'usthb'),
(157, 'Monitorage et vérification à l’exécution des compositions de web service', '015/2018', 194, 67, 'usthb'),
(158, 'Raffinement et analyse formelle d\'une chorégraphe WS‐CDL.', '022/2018', 195, 67, 'usthb');

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

--
-- Déchargement des données de la table `production`
--

INSERT INTO `production` (`codepro`, `date`, `type`, `codeproj`) VALUES
(2, '2020-04', 'publication', NULL),
(3, '2010-03', 'communication', NULL),
(4, '2014-02', 'communication', NULL),
(5, '2009-01', 'ouvrage', NULL),
(6, '2020-03', 'chapitreOuvrage', NULL),
(7, '2017-03', 'chapitreOuvrage', NULL),
(8, '2020-03', 'chapitreOuvrage', NULL),
(9, '2015-04', 'doctorat', NULL),
(10, '2012-04', 'master', NULL),
(12, '2020-04', 'publication', NULL),
(13, '2020-04', 'publication', NULL),
(14, '2020-04', 'publication', NULL),
(21, '2020-04', 'master', NULL),
(23, '2020-04', 'master', NULL),
(24, '2020-04', 'master', NULL),
(25, '2020-04', 'master', NULL),
(26, '2020-04', 'master', NULL),
(27, '2020-04', 'master', NULL),
(28, '2020-04', 'master', NULL),
(29, '2020-04', 'master', NULL),
(30, '2020-04', 'master', NULL),
(31, '2020-04', 'master', NULL),
(32, '2020-04', 'master', NULL),
(33, '2020-04', 'master', NULL),
(34, '2020-04', 'master', NULL),
(35, '2020-04', 'master', NULL),
(36, '2020-04', 'master', NULL),
(37, '2020-04', 'master', NULL),
(38, '2020-04', 'master', NULL),
(39, '2020-04', 'master', NULL),
(40, '2020-04', 'master', NULL),
(41, '2020-04', 'master', NULL),
(42, '2020-04', 'master', NULL),
(43, '2020-04', 'master', NULL),
(44, '2020-04', 'master', NULL),
(45, '2020-04', 'master', NULL),
(46, '2020-04', 'master', NULL),
(47, '2020-04', 'master', NULL),
(48, '2020-04', 'master', NULL),
(49, '2020-04', 'master', NULL),
(50, '2020-04', 'doctorat', NULL),
(51, '2020-04', 'ouvrage', NULL),
(52, '2020-04', 'ouvrage', NULL),
(53, '2020-04', 'ouvrage', NULL),
(54, '2020-04', 'ouvrage', NULL),
(55, '2020-04', 'ouvrage', NULL),
(56, '2020-04', 'ouvrage', NULL),
(57, '2020-05', 'communication', NULL),
(58, '2020-05', 'communication', NULL),
(100, '2010-05', 'master', NULL),
(101, '2020-05', 'publication', NULL),
(102, '2020-05', 'master', NULL),
(104, '2019-04', 'publication', NULL),
(105, '2019-08', 'publication', NULL),
(106, '2019-10', 'publication', NULL),
(107, '2019-11', 'publication', NULL),
(108, '2019-01', 'publication', NULL),
(109, '2019-01', 'publication', NULL),
(110, '2019-01', 'publication', NULL),
(111, '2019-01', 'publication', NULL),
(112, '2019-06', 'publication', NULL),
(113, '2019-01', 'chapitreOuvrage', NULL),
(114, '2019-01', 'chapitreOuvrage', NULL),
(115, '2019-07', 'communication', NULL),
(116, '2019-10', 'communication', NULL),
(117, '2019-11', 'communication', NULL),
(118, '2019-10', 'communication', NULL),
(119, '2019-12', 'communication', NULL),
(120, '2019-07', 'communication', NULL),
(121, '2019-11', 'communication', NULL),
(122, '2020-07', 'communication', NULL),
(123, '2019-07', 'communication', NULL),
(124, '2019-07', 'communication', NULL),
(125, '2019-07', 'master', NULL),
(128, '2019-06', 'master', 'B*00220130123'),
(129, '2019-06', 'master', 'B*00220130123'),
(130, '2019-07', 'master', NULL),
(131, '2019-07', 'master', NULL),
(132, '2020-07', 'master', NULL),
(135, '2019-07', 'master', NULL),
(136, '2019-07', 'master', NULL),
(137, '2019-07', 'master', NULL),
(138, '2018-06', 'communication', NULL),
(139, '2018-05', 'communication', NULL),
(140, '2018-07', 'doctorat', NULL),
(141, '2019-07', 'doctorat', NULL),
(142, '2019-07', 'master', NULL),
(143, '2018-06', 'master', NULL),
(144, '2018-06', 'master', NULL),
(145, '2019-02', 'doctorat', NULL),
(146, '2019-09', 'master', NULL),
(147, '2017-07', 'master', NULL),
(148, '2017-07', 'doctorat', NULL),
(149, '2020-10', 'doctorat', NULL),
(150, '2017-06', 'master', NULL),
(151, '2017-06', 'master', NULL),
(152, '2017-07', 'communication', NULL),
(153, '2018-04', 'communication', NULL),
(154, '2018-04', 'communication', NULL),
(155, '2017-01', 'publication', NULL),
(156, '2018-06', 'master', NULL),
(157, '2018-06', 'master', NULL),
(158, '2018-06', 'master', NULL),
(159, '2017-08', 'chapitreOuvrage', NULL),
(160, '2017-03', 'communication', NULL),
(161, '2017-03', 'communication', NULL),
(162, '2018-10', 'doctorat', NULL),
(164, '2018-11', 'communication', NULL),
(165, '2018-11', 'communication', NULL),
(166, '2018-05', 'publication', NULL),
(167, '2018-04', 'publication', NULL),
(168, '2017-04', 'doctorat', NULL),
(169, '2017-12', 'doctorat', NULL);

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

--
-- Déchargement des données de la table `projrecher`
--

INSERT INTO `projrecher` (`codeproj`, `date`, `intitule`, `description`, `duree`, `etat`, `codeDomaine`, `fichier`) VALUES
('B*00220130123', '2019-07', 'Agilité des systemes inter-organisationnels : modèles et outils', 'Agilité des systemes inter-organisationnels : modèles et outils Agilité des systemes inter-organisationnels : modèles et outils', 6, 'en cours', 155, 'B*00220130123.rar'),
('C00L07UN160420180002', '2019-06', 'Identité numérique et services basés IoT', 'Identité numérique et services basés IoT Identité numérique et services basés IoT', 12, 'en cours', 154, 'C00L07UN160420180002.rar'),
('C00L07UN160420180016', '2018-01', 'Développement de méthodes de résolution approchées pour des problèmes difficiles', 'Développement de méthodes de résolution approchées pour des problèmes difficiles\r\nDéveloppement de méthodes de résolution approchées pour des problèmes difficiles', 120, 'en cours', 165, 'C00L07UN160420180016.rar'),
('C00L07UN160420180017', '2019-01', 'Modélisation des procédés logiciels dans le cadre multi-contexte de Cloud Computing, d’environnement à base d’architectures logicielles réutilisables et de systèmes de systèmes (SoS)', 'Modélisation des procédés logiciels dans le cadre multi-contexte de Cloud Computing, d’environnement à base d’architectures logicielles réutilisables et de systèmes de systèmes (SoS)', 12, 'en cours', 153, 'C00L07UN160420180017.rar');

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

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`codepro`, `titre`, `idspe`, `coderevue`, `doi`, `nvol`, `nissue`, `url`) VALUES
(104, 'An E-negotiation Agent for an E-tourism Platform', 116, 4, ' 10.4018/IJWSR.2019040104', 16, '4', 'url'),
(105, 'MyRestaurant: A Smart\r\nRestaurant with a Recommendation System', 118, 5, '10.12785/ijcds/080206', 8, '2210-142X', 'url'),
(106, 'Agility and Cloud Computing: Key Enablers for Knowledge Management Systems Implementation in Algerian Small to Medium-Sized Organisations', 120, 6, '10.1504/IJKMS.2019.103349', 10, '4', 'https://www.inderscience.com/info/inarti'),
(107, ' Conflict resolution in process\r\nmodels merging', 122, 7, '10.1007/s12652-018-0808-1', 0, '0', 'https://www.eventbrite.com/e/4th-interna'),
(108, 'PCSM: an efficient multihop proximity aware clustering scheme for mobile peer-to-peer systems', 124, 8, '10.1504/IJIPT.2019.103705', 12, '4', 'http://www.inderscience.com/offer.php?id'),
(109, '’A review on security challenges of wireless communications in disaster emergency response and crisis management situations', 126, 9, '10.1016/j.jnca.2018.11.010 ', 126, '1', 'https://www.sciencedirect.com/science/ar'),
(110, 'SANSync: An Accurate Time Synchronization Protocol for Wireless Sensor and Actuator Networks', 128, 10, '951–972', 105, '3', 'https://link.springer.com/article/10.100'),
(111, 'Self-calibration methods for uncontrolled environments in sensor networks: A reference survey', 130, 11, '10.1016/j.adhoc.2019.01.008', 88, '142', 'https://www.sciencedirect.com/science/ar'),
(112, 'HiCo-MoG: Hierarchical consensus-based group membership service in mobile Ad Hoc networks', 132, 12, '10.3233/JHS190609', 25, '2', 'https://content.iospress.com/articles/jo'),
(155, 'Toward a Smart Restaurant with Context Management', 192, 13, '10.4018/IJKBO.2017010101', 18, '1', 'url'),
(166, 'PCSM: An Efficient Multihop Proximity aware Clustering Scheme for Mobile Peer-to-Peer Systems', 205, 8, '10.1007/s12652-018-0808-1', 1, '10', ' https://link.springer.com/article/10.10'),
(167, 'An approach based on hierarchical Petri-nets for the verification of Inteconnected BPEL processes', 207, 14, '10.4018/IJISMD.2018040103', 2, '9', 'https://www.researchgate.net/publication');

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

--
-- Déchargement des données de la table `revue`
--

INSERT INTO `revue` (`coderevue`, `nom`, `periodicite`, `issnonline`, `issnprint`, `editeur`, `annee`, `theme`, `idspe`, `classe`, `numindex`, `type`, `pays`) VALUES
(4, 'An E-negotiation Agent for an E-tourism Platform', 'annuel', '1546-5004', '1545-7362', 'Idea Group Publishing', '2019', 'Web Services Research', 115, 'A', 0, 'internationale', ''),
(5, 'International Journal of Computing and Digital Systems', '', '4', '5', 'University of Bahrain', '2019', 'Computing and Digital Systems', 117, 'B', 0, 'internationale', ''),
(6, 'International Journal of Knowledge Management Studies', '', '17438276, 17438268', '1743-8276', 'Inderscience Publishers', '2019', 'Business, Management and Accounting Management Information Systems Management of Technology and Innovation', 119, 'A*', 0, 'internationale', ''),
(7, 'International Conference on System Reliability and Safety', 'annuel', 'null', 'null', 'null', '2019', 'System Reliability and Safety', 121, 'C', 0, 'internationale', ''),
(8, 'Journal of Ambient Intelligence and Humanized Computing ', 'annuel', '18685137', '1868-5137', 'Springer Verlag', '2019', 'Computer Science', 123, 'A', 0, 'internationale', ''),
(9, 'Journal of Network and Computer Applications', '', '10958592', '10848045', 'Elsevier Inc', '2019', 'Computer Science', 125, 'A', 0, 'internationale', ''),
(10, 'Journal of Wireless Personal Communications', '', '1572-834X', '0929-6212', 'Springer Science+Business Media', '2019', 'Ingénierie', 127, 'A', 0, 'internationale', ''),
(11, 'Journal of Ad Hoc Networks', '', '1570-8705', '1570-8705', 'ELSEVIER SCIENCE', '2019', 'Engineering', 129, 'A', 0, 'internationale', ''),
(12, ' Journal of High Speed Networks', '', '1875-8940', '0926-6801', 'IOS Press', '2019', ' Computer & Communication Sciences, Computer Science, Telecommunication', 131, 'A', 0, 'internationale', ''),
(13, 'International Journal of KnowledgeBased Organizations (IJKBO)', '', '2155-6407', '2155-6393', 'IGI Global publisher', '2017', 'informatique', 191, 'A', 0, 'internationale', ''),
(14, 'International Journal of Information System Modeling and Design ', '', '1947-8194', '1947-8186', 'IGI Global publisher', '2018', 'Information System Modeling and Design ', 206, 'A', 0, 'internationale', '');

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
(89, 'com8', '', 78),
(90, 'verifP', '', 79),
(91, 'verifP', '', 80),
(92, 'verifP', '', 81),
(93, 'verif2', '', 82),
(94, 'systèmes informatiques', '', 96),
(95, ' Génie Logiciel', '', 96),
(96, 'Systèmes d’information', '', 96),
(97, 'modelisation et verification des systemes paralleles', '', 96),
(98, 'Web Technologie et Sécurité Informatique', '', 96),
(99, 'Mobilité', '', 96),
(100, 'Intelligence Artificielle', '', 97),
(101, 'résolution des problèmes combinatoires', '', 98),
(102, 'résolution des problèmes combinatoires', '', 99),
(103, 'résolution des problèmes combinatoires', '', 100),
(104, 'résolution des problèmes combinatoires', '', 101),
(105, 'résolution des problèmes combinatoires', '', 102),
(106, 'résolution des problèmes combinatoires', '', 103),
(107, 'sécurité', '', 104),
(108, 'sécurité', '', 105),
(109, 'écologie végétale et d\'environnement', '', 106),
(110, 'Intelligence Artificielle et Data Mining ', '', 97),
(111, 'Bio-Informatique et Robotique', '', 97),
(112, 'Optimisation, Raisonnement et Applications', '', 97),
(113, 'Représentation de Connaissances et Systèmes d’Inférence', '', 97),
(114, 'Traitement et Synthèse d’Images', '', 97),
(115, 'Web Services Research', '', 107),
(116, 'Web Services Research', '', 108),
(117, 'Reconfigurable Computing & Embedded systems,Computer Communications and Networking', '', 109),
(118, 'Computing,Digital Systems', '', 110),
(119, 'Business, Management , Accounting Management Information Systems Management of Technology and Innovation', '', 111),
(120, 'agility,cloud computing,CC,knowledge management system', '', 112),
(121, 'System Reliability,Safety', '', 113),
(122, 'réseau', '', 114),
(123, 'Computer Science', '', 115),
(124, 'peer-to-peer', '', 116),
(125, 'Computer Networks,Communications Computer Science Applications Hardware,Architecture', '', 117),
(126, 'Network and Computer Applications', '', 118),
(127, 'mobile communications,computing,investigates theoretical, engineering,', '', 119),
(128, 'Wireless Sensor,Actuator Networks', '', 120),
(129, 'Engineering', '', 121),
(130, 'sensor networks', '', 122),
(131, ' Computer & Communication Sciences, Computer Science, Telecommunication', '', 123),
(132, 'mobile Ad Hoc networks', '', 124),
(133, 'Applications of Robotics Technologies', '', 125),
(134, 'Health Monitoring Systems', '', 126),
(135, 'sécurité', '', 127),
(136, ' Urban Logistics Innovations,Smart Grids, Social impacts,Territorial Intelligence', '', 128),
(137, ' Urban Logistics Innovations', '', 129),
(138, 'Networking Telecommunications, Biomedical Engineering,Applications', '', 130),
(139, 'Home Health care', '', 131),
(140, 'Control Engineering,Information Technology', '', 132),
(141, 'Augmented Reality e-Maintenance Platforms', '', 133),
(142, 'Theoretical ,applicative aspects of computer science', '', 134),
(143, ' orchestrating connected objects,web of things', '', 135),
(144, ' Software Engineering,Computational Intelligence', '', 136),
(145, 'Software Engineering,Computational Intelligence', '', 137),
(146, 'Computer Science, Engineering,Information Technology ', '', 138),
(147, ' Adaptive Guidance', '', 139),
(148, 'Control Automation and Diagnosis', '', 140),
(149, ' Deep Learning', '', 141),
(150, 'IEEE ISCC Barcelona', '', 142),
(151, 'Web Service', '', 143),
(152, 'Web Services', '', 144),
(153, 'application', '', 145),
(154, 'réseaux,robots', '', 146),
(155, 'réseaux,robots', '', 147),
(156, 'application', '', 148),
(157, 'processus Workflow', '', 149),
(158, 'cloud', '', 150),
(159, 'Cloud', '', 151),
(160, 'système d’extraction et d’intégration', '', 152),
(161, 'test', '', 96),
(162, 'du du du', '', 96),
(163, 'du du du', '', 96),
(164, 'C2C3', '', 156),
(165, 'OU', '', 157),
(166, 'réseaux,robots', '', 158),
(167, 'réseaux,robots', '', 159),
(168, 'QOS', '', 160),
(169, 'systeme,archi', '', 161),
(170, 'identification des comportements', '', 162),
(171, 'intelligence artificielle', '', 163),
(172, 'Optimization algorithm', '', 164),
(173, 'service web', '', 166),
(174, 'domotique', '', 167),
(175, 'services basée,informatique', '', 168),
(176, 'robot', '', 169),
(177, 'réseaux,robots', '', 170),
(178, 'routage', '', 171),
(179, 'réseaux', '', 172),
(180, 'bioinformatique', '', 173),
(181, 'robot', '', 174),
(182, 'réseau', '', 175),
(183, 'robot', '', 176),
(184, 'processus', '', 177),
(185, 'Distributed Systems', '', 178),
(186, 'management', '', 179),
(187, 'systeme', '', 180),
(188, 'smart city', '', 181),
(189, 'smart city', '', 182),
(190, 'Management', '', 183),
(191, 'KnowledgeBased Organizations', '', 184),
(192, 'design', '', 185),
(193, 'géo-décisionnel', '', 186),
(194, 'Web Services', '', 187),
(195, 'WS-CDL', '', 188),
(196, 'sécurité', '', 189),
(197, 'Wireless Communications and Networking', '', 190),
(198, 'manet', '', 191),
(199, 'control', '', 192),
(200, 'genie logiciel', '', 193),
(201, 'Smart Systems', '', 194),
(202, 'peer-to-peer', '', 195),
(203, 'peer-to-peer', '', 196),
(204, 'software architecture', '', 197),
(205, 'peer-to-peer', '', 198),
(206, 'Information System Modeling and Design ', '', 199),
(207, 'hierarchical Petri-nets', '', 200),
(208, 'Web Services', '', 201),
(209, 'Web Services', '', 202);

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
  `nordre` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `idspe` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `these`
--

INSERT INTO `these` (`codepro`, `titre`, `encadreur`, `lieusout`, `nordre`, `url`, `idspe`) VALUES
(9, 'DB', 16, 'DB', '5', 'DB', 29),
(50, 'DB', 16, 'DB', '5', 'DB', 78),
(140, 'Composition de services web basée temps', 30, 'usthb', '02/2018', 'url', 173),
(141, 'environnement domotique pour la esanté', 30, 'usthb', '03/2018', 'url', 174),
(145, 'Optimisation mono-objectif et multiobjectif approchée des paramètres de qualité de service (QoS) dans un Routage multicast d’un réseau d’ordinateurs Date de soutenance', 39, 'usthb', '04/2019', 'url', 178),
(148, 'Approche Bio-inspirée pour la coordination de robots dans un milieu hostile : Approche colonie de Fourmies-firefly ', 39, 'usthb', '04/2017', 'url', 181),
(149, 'Approches Bio-inspirées pour la détection d’intrusions dans un réseau d’ordinateurs', 39, 'usthb', '05/2017', 'url', 182),
(162, 'La composition des patrons de modèles de procédés logiciels', 38, 'usthb', '04/2018', 'url', 200),
(168, 'Framework pour la sélection automatique des services Web : Approche basée sur la similarité du profil contextuel', 30, 'usthb', '033/2017', 'url', 208),
(169, 'Découverte de services mobiles ', 30, 'usthb', '035/2017', 'url', 209);

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
(30, 'kaderbelkhir@hotmail.com', 'admin', 1),
(31, 'fbouyakoub@usthb.dz', 'admin', 1),
(32, 'sbouyakoub@usthb.dz', 'admin', 1),
(33, 'allal.tiberkak@gmail.com', 'admin', 1),
(34, 'guebliwas@gmail.com', 'admin', 1),
(35, 'belkhirat@yahoo.fr', 'admin', 1),
(36, 'Zebouchi_karima@live.fr', 'admin', 1),
(37, 'mboubenia@live.fr', 'admin', 1),
(38, 'anacer@mail.cerist.dz', 'admin', 1),
(39, 'amboukra@yahoo.fr', 'admin', 1),
(40, 'berbar@hotmail.com', 'admin', 1),
(41, 'Ilhem_boussaid@yahoo.fr', 'admin', 1),
(42, 'relym@hotmail.fr', 'admin', 1),
(43, 'Assia.hachichi@gmail.com', 'admin', 1),
(44, 'djouadi@usthb.dz', 'admin', 1),
(45, 'hkhemissa@gmail.com', 'admin', 1),
(46, 'Asma_hachemi@yahoo.fr', 'admin', 1),
(47, 'Computer1989@live.fr', 'admin', 1),
(48, 'lichallamen@yahoo.com', 'admin', 1),
(49, 'zalimazighi@usthb.dz', 'admin', 1),
(50, 'Mazouz_63@yahoo.com', 'admin', 1),
(51, 'badache@mail.cerist.dz', 'admin', 1),
(52, 'kboukhalfa@usthb.dz', 'admin', 1),
(53, 'sboukhedouma@usthb.dz', 'admin', 1),
(54, 'kderbal@usthb.dz', 'admin', 1),
(55, 'nselmoune@usthb.dz', 'admin', 1),
(56, 'rdjiroun@usthb.dz', 'admin', 1),
(57, 'hamdah_m@yahoo.fr', 'admin', 1),
(59, 'louahrano@hotmail.com', 'admin', 1),
(61, 'peace_maha@yahoo.fr', 'admin', 1),
(62, 'zakiachallal@usthb.dz', 'admin', 1),
(63, 'i.frihi@gmail.com', 'admin', 1),
(64, 'kakessi@hotmail.fr', 'admin', 1),
(65, 'nbentarzi@usthb.dz', 'admin', 1),
(66, 'abdelli@hotmail.com', 'admin', 1),
(67, 'yhammal@hotmail.com', 'admin', 1),
(68, 'benkaouha@lsi-usthb.dz', 'admin', 1),
(69, 'djouama.amir@gmail.com', 'admin', 1),
(70, 'mbenchaiba@usthb.dz', 'admin', 1),
(71, 'cbenzaid@usthb.dz', 'admin', 1),
(72, 'mchenait@usthb.dz', 'admin', 1),
(74, 'bzebbane@usthb.dz', 'admin', 1),
(75, 'laliouane@usthb.dz', 'admin', 1),
(76, 'afsaadi@gmail.com', 'admin', 1),
(77, 'mhaddouche@usthb.dz', 'admin', 1),
(78, 'mbouziane@usthb.dz', 'admin', 1),
(79, 'Lalouani_wassila@yahoo.fr', 'admin', 1),
(80, 'kzeraoulia@usthb.dz', 'admin', 1),
(81, 'hadjhenni@gmail.com', 'admin', 1),
(82, 'saidrouibeh@gmail.com', 'admin', 1),
(84, 'Sed.manel@gmail.com', 'admin', 1),
(85, 'n.belguerche@yahoo.fr', 'admin', 1),
(86, 'chehrazeddib@hotmail.fr', 'admin', 1),
(87, 'Hani.gati@gmail.com', 'admin', 1),
(88, 'Bouyahia.k@gmail.com', 'admin', 1),
(89, 'allalisarah@gmail.com', 'admin', 1),
(90, 's.medjadba@gmail.com', 'admin', 1),
(91, 'a.saiah@univ.chlef.dz', 'admin', 1),
(92, 'driass@usthb.dz', 'admin', 1),
(93, 'lyesKhennak@usthb.dz', 'admin', 1),
(94, 'SalihaAouat@usthb.dz', 'admin', 1),
(95, 'NadiaBahaTouzene@usthb.dz', 'admin', 0),
(96, 'RahmaniMoufida@usthb.dz', 'admin', 1);

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
-- Déchargement des données de la table `validationproduction`
--

INSERT INTO `validationproduction` (`codepro`, `idcher`, `type`) VALUES
(106, 38, 'publication'),
(145, 39, 'doctorat'),
(148, 39, 'doctorat'),
(149, 39, 'doctorat');

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
  MODIFY `idcher` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `conference`
--
ALTER TABLE `conference`
  MODIFY `codeconf` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `codeDomaine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `idetab` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `index`
--
ALTER TABLE `index`
  MODIFY `numindex` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `idlabo` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `codepro` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT pour la table `revue`
--
ALTER TABLE `revue`
  MODIFY `coderevue` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `idspe` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

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
