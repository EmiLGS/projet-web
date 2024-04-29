-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.info.unicaen.fr:3306
-- Généré le : sam. 26 nov. 2022 à 20:39
-- Version du serveur :  10.5.11-MariaDB-1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `22002270_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `programming_languages`
--

CREATE TABLE `programming_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `creationDate` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `programming_languages`
--

INSERT INTO `programming_languages` (`id`, `name`, `creator`, `creationDate`, `logo`) VALUES
(27, 'PHP', 'Rasmus Lerdof', 1994, 'ey5m6hjrbW.png'),
(28, 'HTML', 'Tim Berners-Lee', 1993, 'ly1e1Ioiep.png'),
(29, 'CSS', ' CSS Working Group', 1996, 'sl3CwG42G6.png'),
(30, 'Python', 'Guido van Rossum', 1991, 'j0XoHpkcYK.png'),
(31, 'Scratch', 'Mitchel Resnick', 2006, 'tpVWqLo2wK.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `programming_languages`
--
ALTER TABLE `programming_languages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `programming_languages`
--
ALTER TABLE `programming_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

