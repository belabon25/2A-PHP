-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 13 déc. 2021 à 14:09
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
(1, 'Manger', 1, 0),
(2, 'Faire la lessive', 1, 0),
(3, 'Boire', 1, 0),
(4, 'Dormir', 1, 0),
(5, 'Être social', 2, 1),
(6, 'Boire de l&#39;alcool', 2, 1),
(7, 'Nous', 3, 0),
(8, 'Sommes', 3, 0),
(9, 'En', 3, 0),
(10, 'Manque', 3, 0),
(11, 'D&#39;idées', 3, 0),
(12, 'Bonjour', 4, 0),
(13, 'Vous', 4, 0),
(14, 'Allez', 4, 0),
(15, 'Bien ?', 4, 0),
(16, 'Sert à afficher la 2e page', 5, 0),
(17, 'Bonjour je suis privée', 6, 0),
(18, 'Anglais', 7, 0),
(19, 'PHP', 7, 0),
(20, 'Modélisations mathématiques', 7, 0),
(21, 'Expression', 7, 0),
(22, 'PPP', 7, 0),
(23, 'Conception', 7, 0),
(24, 'Gestion SI', 7, 0),
(25, 'ProgSYS', 7, 0),
(26, 'Projet Tuteuré', 7, 1),
(27, 'Projet Java', 7, 0),
(28, 'Faire un second utilisateur marche youpi', 8, 1),
(29, 'Dire bonjour', 9, 0),
(30, 'Je m&#39;en vais', 10, 0),
(31, 'Et oui jamy ', 11, 1);

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
(1, 'Liste publique 1', 0, 0, 1),
(2, 'Liste publique 2', 0, 0, 1),
(3, 'Liste publique 3', 0, 0, 1),
(4, 'Liste publique 4', 0, 0, 1),
(5, 'Liste publique 5', 0, 0, 1),
(6, 'Liste privée Testeur', 1, 0, 1),
(7, 'Examens', 1, 0, 1),
(8, 'Tâche privée Testeur2', 1, 0, 2),
(9, 'Bonjour', 1, 0, 1),
(10, 'Au revoir', 1, 0, 1),
(11, '2e Page !', 1, 0, 1);

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
(1, 'Testeur', '$2y$10$sKJYSV/vvVKwZjcMLnaZk.vy9JenRy0dyv/RvxAebwvTE/RlzPPJ.'),
(2, 'Testeur2', '$2y$10$2Ebm9r3ANLt9xI.27EN43eVn15XdQlYDZNrt0oUPucY2u7vTe5uxe');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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