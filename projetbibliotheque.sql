-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 avr. 2024 à 21:23
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetbibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE `abonne` (
  `NumeroAbonne` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Caution` int(11) NOT NULL,
  `Adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `abonne`
--

INSERT INTO `abonne` (`NumeroAbonne`, `Nom`, `Prenom`, `Caution`, `Adresse`) VALUES
(1, 'ATH', 'Power', 6, 'Kalemie'),
(2, 'RK', 'Ben', 6, 'Goma'),
(3, 'ABECA', 'ALUHEBA', 10, 'Q. KASIKA, AV. DIKUTA'),
(4, 'ALPHANI', 'KALONDA', 1, 'Q. KYESHERO'),
(5, 'AMISSA', 'PENDEZA', 50, 'Q. HIMBI 1'),
(6, 'HARADIYA', 'MAXIME', 100, 'Q. MABANGA, Av NDAGALA, Goma ville');

-- --------------------------------------------------------

--
-- Structure de la table `auteurlivre`
--

CREATE TABLE `auteurlivre` (
  `IdAuteur` int(11) NOT NULL,
  `NumeroLivre` int(11) NOT NULL,
  `Auteur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='la table enregistre les noms des auteurs et d''autres infos';

--
-- Déchargement des données de la table `auteurlivre`
--

INSERT INTO `auteurlivre` (`IdAuteur`, `NumeroLivre`, `Auteur`) VALUES
(2, 2, 'KULE.B'),
(4, 4, 'P. KIYANA'),
(5, 5, 'H. AMURI'),
(9, 5, 'A. TCHALUBA'),
(10, 5, 'AMURI');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `IdEmprunt` int(11) NOT NULL,
  `NumeroLivre` int(11) NOT NULL,
  `NumeroAbonne` int(11) NOT NULL,
  `DateEmprunt` date NOT NULL,
  `DateRetour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`IdEmprunt`, `NumeroLivre`, `NumeroAbonne`, `DateEmprunt`, `DateRetour`) VALUES
(26, 5, 1, '2024-04-12', '2024-04-12'),
(27, 6, 3, '2024-04-12', '2024-04-12'),
(28, 1, 4, '2024-04-12', NULL),
(30, 4, 2, '2024-04-12', NULL),
(31, 2, 5, '2024-04-12', NULL),
(32, 3, 6, '2024-04-12', '2024-04-12');

-- --------------------------------------------------------

--
-- Structure de la table `identification`
--

CREATE TABLE `identification` (
  `Id` int(10) NOT NULL,
  `Identifiant` varchar(15) NOT NULL,
  `MotDePasse` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `identification`
--

INSERT INTO `identification` (`Id`, `Identifiant`, `MotDePasse`) VALUES
(1, 'A7H', '1234'),
(2, 'Pow3r', '1012');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `NumeroLivre` int(11) NOT NULL,
  `Titre` varchar(50) NOT NULL,
  `Centre` int(11) NOT NULL,
  `Editeur` varchar(50) NOT NULL,
  `Etat` varchar(50) NOT NULL,
  `DateAchat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`NumeroLivre`, `Titre`, `Centre`, `Editeur`, `Etat`, `DateAchat`) VALUES
(1, 'Et si la vie était un rève', 1, 'Robert KULE', 'Emprunté', '2024-03-26'),
(2, 'Qui sommes nous?', 2, 'R.Bella', 'Emprunté', '2024-03-19'),
(3, 'Ma mort', 1, 'ULPGL', 'Disponible', '2024-04-01'),
(4, 'le rap français ', 2, 'Bella', 'Emprunté', '2024-04-01'),
(5, 'Ou je meurs, ou je vis !', 10, 'KivuEdition', 'Disponible', '2024-01-02'),
(6, 'Le drame de la vie', 3, 'KatangaEdition', 'Disponible', '2012-03-12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`NumeroAbonne`);

--
-- Index pour la table `auteurlivre`
--
ALTER TABLE `auteurlivre`
  ADD PRIMARY KEY (`IdAuteur`),
  ADD KEY `NumeroLivre` (`NumeroLivre`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`IdEmprunt`),
  ADD KEY `NumeroLivre` (`NumeroLivre`),
  ADD KEY `NumeroAbonne` (`NumeroAbonne`);

--
-- Index pour la table `identification`
--
ALTER TABLE `identification`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`NumeroLivre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `NumeroAbonne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `auteurlivre`
--
ALTER TABLE `auteurlivre`
  MODIFY `IdAuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `IdEmprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `identification`
--
ALTER TABLE `identification`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `NumeroLivre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auteurlivre`
--
ALTER TABLE `auteurlivre`
  ADD CONSTRAINT `auteurlivre_ibfk_1` FOREIGN KEY (`NumeroLivre`) REFERENCES `livre` (`NumeroLivre`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`NumeroLivre`) REFERENCES `livre` (`NumeroLivre`),
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`NumeroAbonne`) REFERENCES `abonne` (`NumeroAbonne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
