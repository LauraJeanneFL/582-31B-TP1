-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 15 nov. 2024 à 03:21
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `librairie`
--
CREATE DATABASE IF NOT EXISTS `librairie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `librairie`;

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--
-- Création : ven. 08 nov. 2024 à 15:15
-- Dernière modification : ven. 15 nov. 2024 à 01:13
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE `auteur` (
  `id_auteur` int(45) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `auteur`:
--

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `prenom`, `nom`) VALUES
(1, 'Laura-Jeanne', 'Fournier '),
(3, '123', 'blabla'),
(5, '12333', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--
-- Création : ven. 15 nov. 2024 à 00:26
-- Dernière modification : ven. 15 nov. 2024 à 01:12
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE `emprunt` (
  `id_emprunt` int(45) NOT NULL,
  `id_livre` int(45) NOT NULL,
  `nom_emprunteur` varchar(100) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `emprunt`:
--   `id_livre`
--       `livre` -> `id_livre`
--

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `id_livre`, `nom_emprunteur`, `date_emprunt`, `date_retour`) VALUES
(6, 1, 'bloblo', '2024-11-14', '2024-11-15'),
(8, 1, 'testets', '2024-11-14', '2024-11-15');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--
-- Création : ven. 08 nov. 2024 à 15:27
-- Dernière modification : ven. 15 nov. 2024 à 01:14
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id_genre` int(45) NOT NULL,
  `nom_genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `genre`:
--

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
(1, 'Fantatique'),
(3, 'Roman'),
(4, 'Policer'),
(16, 'Romantique');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--
-- Création : ven. 08 nov. 2024 à 15:45
-- Dernière modification : ven. 15 nov. 2024 à 01:53
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE `livre` (
  `id_livre` int(45) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `annee_publication` int(45) NOT NULL,
  `id_auteur` int(45) NOT NULL,
  `id_genre` int(45) NOT NULL,
  `quantite_disponible` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `livre`:
--   `id_auteur`
--       `auteur` -> `id_auteur`
--   `id_genre`
--       `genre` -> `id_genre`
--

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `titre`, `annee_publication`, `id_auteur`, `id_genre`, `quantite_disponible`) VALUES
(1, 'Orgueil et préjugé', 1990, 1, 16, 10),
(5, 'titre', 9991, 1, 1, 50);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id_auteur`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `id_livre` (`id_livre`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_livre`),
  ADD KEY `id_auteur` (`id_auteur`),
  ADD KEY `id_genre` (`id_genre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id_auteur` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emprunt` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id_livre` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`id_livre`) REFERENCES `livre` (`id_livre`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `livre_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `auteur` (`id_auteur`),
  ADD CONSTRAINT `livre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
