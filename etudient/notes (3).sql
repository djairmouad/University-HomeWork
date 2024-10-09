-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 nov. 2023 à 01:27
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
-- Base de données : `notes`
--

-- --------------------------------------------------------

--
-- Structure de la table `etude`
--

CREATE TABLE `etude` (
  `id` int(11) NOT NULL,
  `cevilite` varchar(20) NOT NULL,
  `nom_prenom` varchar(25) NOT NULL,
  `filiere` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etude`
--

INSERT INTO `etude` (`id`, `cevilite`, `nom_prenom`, `filiere`) VALUES
(33, 'Monsieur', 'djair mouad', '3isil'),
(34, 'Monsieur', 'djair mouad', '3isil'),
(35, 'Monsieur', 'djair mouad', '3isil'),
(36, 'Monsieur', 'djair mouad', '3isil'),
(37, 'Monsieur', 'sadi', '3si'),
(38, 'Monsieur', 'sadi', '3si'),
(39, 'Monsieur', 'sadi', '3si'),
(40, 'Monsieur', 'sadi', '3si'),
(41, 'Monsieur', 'Hamid', '1ing'),
(42, 'Monsieur', 'Hamid', '1ing'),
(43, 'Monsieur', 'Hamid', '1ing'),
(44, 'Monsieur', 'Hamid', '1ing');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(25) NOT NULL,
  `filiere` varchar(20) NOT NULL,
  `moduuule` varchar(20) NOT NULL,
  `CODE` int(11) NOT NULL,
  `coefficient` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `nom_prenom`, `filiere`, `moduuule`, `CODE`, `coefficient`, `note`) VALUES
(33, 'djair mouad', '3isil', 'GL', 1, 3, 15),
(34, 'djair mouad', '3isil', 'PAW', 2, 4, 18),
(35, 'djair mouad', '3isil', 'SAD', 3, 3, 16),
(36, 'djair mouad', '3isil', 'SID', 4, 3, 14),
(37, 'sadi', '3si', 'IHM', 1, 2, 12),
(38, 'sadi', '3si', 'Compilation', 2, 3, 13),
(39, 'sadi', '3si', 'ENVS', 3, 2, 17),
(40, 'sadi', '3si', 'Genie Logiciel', 4, 4, 14),
(41, 'Hamid', '1ing', 'Base de Donnee', 1, 3, 15),
(42, 'Hamid', '1ing', 'Architacteur', 2, 3, 17),
(43, 'Hamid', '1ing', 'Analyse', 3, 4, 16),
(44, 'Hamid', '1ing', 'Algebre', 3, 3, 15);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etude`
--
ALTER TABLE `etude`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etude`
--
ALTER TABLE `etude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
