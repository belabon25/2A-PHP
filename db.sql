-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 14 déc. 2021 à 21:31
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbyogourves`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idList` int(11) NOT NULL,
  `isDone` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `name`, `idList`, `isDone`) VALUES
(36, 'Dire bonjour', 13, 0),
(37, 'Vous', 13, 0),
(38, 'Dire bonjour', 14, 1),
(39, 'Et oui jamy', 15, 0),
(40, 'Manger', 16, 0),
(41, 'Faire la lessive', 16, 0),
(42, 'Boire', 16, 0),
(43, 'Sert à afficher la 2e page', 17, 0),
(44, 'Anglais', 18, 0),
(45, 'Je m&#39;en vais', 19, 0),
(46, 'Anglais', 20, 0),
(47, 'Boire de l&#39;alcool', 20, 0),
(48, 'Dire bonjour', 21, 0),
(49, 'Sert à afficher la 2e page', 22, 0),
(50, 'Nous', 23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isPrivate` tinyint(1) NOT NULL DEFAULT 0,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `userName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `todolist`
--

INSERT INTO `todolist` (`id`, `name`, `isPrivate`, `isDone`, `userName`) VALUES
(13, 'Liste publique 1', 0, 0, NULL),
(14, 'Liste publique 2', 0, 0, NULL),
(15, 'Liste publique 3', 0, 0, NULL),
(16, 'Liste publique 4', 0, 0, NULL),
(17, 'Liste publique 5', 0, 0, NULL),
(18, 'Liste privée Testeur', 1, 0, 'Testeur'),
(19, 'Testeur', 1, 0, 'Testeur'),
(20, 'Examens', 1, 0, 'Testeur'),
(21, 'Bonjour', 1, 0, 'Testeur'),
(22, '2e Page !', 1, 0, 'Testeur'),
(23, 'Testeur2', 1, 0, 'Testeur2');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `name` varchar(30) NOT NULL,
  `hashPasswd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`name`, `hashPasswd`) VALUES
('Testeur', '$2y$10$nFfNR.4xxQT54VdYwNtVm.llXRXnX.VXswqt1THPgdS8QQ4ZyvjG6'),
('Testeur2', '$2y$10$w/StWgW/bfwJvxozNQ9.cepO3X3qwWeTpBJd6C0GYz3f9IBqfGXZO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Task` (`idList`);

--
-- Index pour la table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_todolist` (`userName`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_Task` FOREIGN KEY (`idList`) REFERENCES `todolist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `todolist`
--
ALTER TABLE `todolist`
  ADD CONSTRAINT `fk_todolist` FOREIGN KEY (`userName`) REFERENCES `user` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;