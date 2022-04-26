-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 21 mars 2022 à 11:54
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
-- Base de données : `aid`
--

-- --------------------------------------------------------

--
-- Structure de la table `archivechat`
--

CREATE TABLE `archivechat` (
  `id` int(11) NOT NULL,
  `id_user_send` varchar(255) NOT NULL,
  `id_user_received` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `like` longtext NOT NULL,
  `vu` int(11) NOT NULL,
  `date_add` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `archivechat`
--

INSERT INTO `archivechat` (`id`, `id_user_send`, `id_user_received`, `message`, `like`, `vu`, `date_add`) VALUES
(1, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'chat', '', 0, '2022-02-09 10:09:04'),
(2, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'coucou', '', 0, '2022-02-09 10:49:41'),
(3, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'chat', '', 0, '2022-02-09 10:50:08'),
(4, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum tenetur dolore cupiditate itaque, incidunt dolorem ipsa fugiat magni. Similique officiis amet accusamus in corrupti animi velit aliquid placeat quos odit.', '', 0, '2022-02-09 10:51:37'),
(5, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'oui', '', 0, '2022-02-09 11:01:57'),
(6, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'ok', '', 0, '2022-02-09 11:02:46'),
(7, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'chat', '', 0, '2022-02-09 11:02:56'),
(8, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'chat', '', 0, '2022-02-09 11:04:11'),
(9, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'chat', '', 0, '2022-02-09 11:04:25'),
(10, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'chat', '', 0, '2022-02-09 11:05:20'),
(11, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'oui et toi ?', '', 0, '2022-02-09 11:06:16'),
(12, '8036006201232ac43258.76332936', '4268956200ce8d6839b1.11334889', 'oui', '', 0, '2022-02-09 11:23:22'),
(13, '8036006201232ac43258.76332936', '4268956200ce8d6839b1.11334889', 'oui', '', 0, '2022-02-09 11:23:53'),
(14, '8036006201232ac43258.76332936', '4268956200ce8d6839b1.11334889', 'oui', '', 0, '2022-02-09 11:24:43');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `id_user_send` varchar(255) NOT NULL,
  `id_user_received` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `like` longtext NOT NULL,
  `date_add` datetime NOT NULL,
  `vu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `id_user_send`, `id_user_received`, `message`, `like`, `date_add`, `vu`) VALUES
(2, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'coucou', '', '2022-02-09 10:49:41', 1),
(4, '8036006201232ac43258.76332936', '4268956200ce8d6839b1.11334889', 'salut ça va ?', '', '2022-02-09 10:51:37', 1),
(11, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 'oui et toi ?', '', '2022-02-09 11:06:16', 1),
(14, '8036006201232ac43258.76332936', '4268956200ce8d6839b1.11334889', 'oui', '', '2022-02-09 11:24:43', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `id_user_note` varchar(255) NOT NULL,
  `id_user_noted` varchar(255) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `id_user_note`, `id_user_noted`, `note`) VALUES
(1, '8036006201232ac43258.76332936', '4268956200ce8d6839b1.11334889', 3),
(2, '4268956200ce8d6839b1.11334889', '8036006201232ac43258.76332936', 3);

-- --------------------------------------------------------

--
-- Structure de la table `publi`
--

CREATE TABLE `publi` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `id_publi` text NOT NULL,
  `titre` varchar(255) NOT NULL,
  `descript` longtext NOT NULL,
  `date_add` datetime NOT NULL,
  `made` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publi`
--

INSERT INTO `publi` (`id`, `id_user`, `id_publi`, `titre`, `descript`, `date_add`, `made`) VALUES
(1, '4268956200ce8d6839b1.11334889', '268.2936200fd184181e5.32419255', 'Machine à laver', 'Bonjour,J&#039;ai une machine à laver à descendre de mon appartement et je ne pourrais pas le faire seul alors je vous sollicite pour savoir si une âme charitable voudrais bien m&#039;aider.Cordialement.', '2014-04-10 10:21:27', 0),
(2, '4268956200ce8d6839b1.11334889', '368.2156246b69d59e671.81911534', 'Association', 'Bonjour,Nous somme une nouvelle association', '2022-04-01 10:23:57', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `mail_connect` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `mail`, `mdp`, `id_user`, `date_add`, `mail_connect`) VALUES
(1, 'bayet', 'paul', 'paulpierrebayet@gmail.com', '$2y$12$ptpRejCT/CuPllfpiU/pkeHq0loTlRSrPRSCk9RNvxB.F07NUxdSK', '4268956200ce8d6839b1.11334889', '2022-02-07 08:47:25', 'paulpierrebayet@gmail.com'),
(2, 'noblet', 'solène', 'helo.nari@gmail.com', '$2y$12$fXe92rXfuTyfy1.mWPHlzujyDd8zga0.WXXP.pbBWCXZcIX0ihbLe', '8036006201232ac43258.76332936', '2022-02-07 14:48:26', 'helo.nari@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `archivechat`
--
ALTER TABLE `archivechat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `publi`
--
ALTER TABLE `publi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `archivechat`
--
ALTER TABLE `archivechat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `publi`
--
ALTER TABLE `publi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
