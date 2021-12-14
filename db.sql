-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 déc. 2021 à 20:58
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
(31, 'Et oui jamy ', 11, 1),
(32, 'esperons', 12, 1),
(33, 'que', 12, 1),
(34, 'ca', 12, 1),
(35, 'marche', 12, 1);

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
(1, 'Liste publique 1', 0, 0, ''),
(2, 'Liste publique 2', 0, 0, ''),
(3, 'Liste publique 3', 0, 0, ''),
(4, 'Liste publique 4', 0, 0, ''),
(5, 'Liste publique 5', 0, 0, ''),
(6, 'Liste privée Testeur', 1, 0, ''),
(7, 'Examens', 1, 0, ''),
(8, 'Tâche privée Testeur2', 1, 0, ''),
(9, 'Bonjour', 1, 0, ''),
(10, 'Au revoir', 1, 0, ''),
(11, '2e Page !', 1, 0, ''),
(12, 'Liste Testeur 1', 1, 0, '');

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
('Testeur', '$2y$10$u9tn0okNjlmrnUTjj4vHr.E8KNy9r62tV2fYEcTihm.gM.XS4eEry');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_Task` FOREIGN KEY (`idList`) REFERENCES `todolist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
