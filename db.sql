-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 06 déc. 2021 à 21:09
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

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
(41, 'Polluer moins', 7, 1),
(42, 'Tuer moins d&#39;animaux', 7, 1),
(43, 'Faire un suicide collectif', 7, 1),
(44, 'Lessive', 8, 1),
(45, 'Repasser', 8, 1),
(46, 'Manger', 8, 1),
(47, 'Dormir', 8, 1),
(68, 'esperons', 18, 1),
(69, 'que', 18, 1),
(70, 'ca', 18, 1),
(71, 'marche', 18, 1),
(72, 'esperons', 19, 1),
(73, 'qdsf', 19, 1),
(74, 'dqsf', 19, 1),
(75, 'gfdh', 19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isPrivate` tinyint(1) NOT NULL DEFAULT 0,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `todolist`
--

INSERT INTO `todolist` (`id`, `name`, `isPrivate`, `isDone`, `idUser`) VALUES
(7, 'Pour sauver la planète', 0, 0, NULL),
(8, 'Ce que tout le monde doit faire', 0, 0, NULL),
(18, 'ajouterDepuisL&#39;appli', 1, 0, 1),
(19, 'test', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `hashPasswd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `hashPasswd`) VALUES
(1, 'test', 'azerty'),
(2, 'jean', 'claude'),
(3, 'jean', 'claude');

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
  ADD KEY `FK_todo` (`idUser`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `FK_todo` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
