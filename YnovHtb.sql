-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 19 jan. 2022 à 14:31
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `YnovHtb`
--

-- --------------------------------------------------------

--
-- Structure de la table `challenge`
--

CREATE TABLE `challenge` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `level` int(11) NOT NULL,
  `exp` int(11) NOT NULL DEFAULT 50,
  `categorie` varchar(20) NOT NULL,
  `path` varchar(500) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `date_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des challenges';

-- --------------------------------------------------------

--
-- Structure de la table `challenge_category`
--

CREATE TABLE `challenge_category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nb_challemges` int(11) NOT NULL DEFAULT 0,
  `token` varchar(20) NOT NULL,
  `date_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='challenges_categories';

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `object` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `dateSend` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contact';

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (
  `id`, 
  `email`, 
  `object`, 
  `message`, 
  `dateSend`
  ) VALUES (1, 
  'lroem@lorem.ol', 
  'test', 
  'test !!!', 
  '2021-11-24 13:56:36'
  );

-- --------------------------------------------------------

--
-- Structure de la table `rating_challenges`
--

CREATE TABLE `rating_challenges` (
  `id` int(11) NOT NULL,
  `rate_positive` int(11) NOT NULL,
  `rate_negative` int(11) NOT NULL,
  `token_challenge` varchar(100) NOT NULL,
  `token` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Rating challenge';

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(50) NOT NULL,
  `level` enum('member','admin') NOT NULL DEFAULT 'member',
  `remember_token` varchar(250) DEFAULT NULL,
  `confirmation_token` varchar(250) DEFAULT NULL,
  `confirmation_at` datetime DEFAULT NULL,
  `reset_token` varchar(250) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table lié aux utilisateurs';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (
  `id`, 
  `pseudo`, 
  `email`, 
  `password`, 
  `token`, 
  `level`, 
  `remember_token`, 
  `confirmation_token`, 
  `confirmation_at`, 
  `reset_token`, 
  `reset_at`
  ) VALUES (
  1, 
  'root', 
  'root@ynovhtb.com', 
  '$2y$10$5C3xzyb7Gom5h9K8V7o5PuMUqUasdfha//ulwPWwgJZ8s/XOtB10m', 
  'dITdsINuJ1gHzNFwB4uRMG761KKVbOdxAXK0fWmvx94SVe2e8E', 
  'member', 
  'OxzbzCglIn99SbksQvh15Njzf7NwRt9ukUQtYhpuj7FqifCB4bh0AbWO02n5z7TSby836libhmJAfdhckByEID7971J8AQ2hqlks', 
  NULL, 
  '2021-11-10 16:21:22', 
  NULL, 
  NULL
  );

-- --------------------------------------------------------

--
-- Structure de la table `user_challenge`
--

CREATE TABLE `user_challenge` (
  `id` int(11) NOT NULL,
  `token_user` varchar(50) NOT NULL,
  `token_challenge` varchar(50) NOT NULL,
  `progression` double NOT NULL DEFAULT 0,
  `token` varchar(20) NOT NULL,
  `modifed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User challenge';

-- --------------------------------------------------------

--
-- Structure de la table `user_progression`
--

CREATE TABLE `user_progression` (
  `id` int(11) NOT NULL,
  `token_user` varchar(100) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `grade` enum('Débutant','Intermediaire','Avancé','Expert','Master') NOT NULL DEFAULT 'Débutant',
  `token` varchar(20) NOT NULL,
  `lastEdit_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User progression';

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `date_at` (`date_at`);

--
-- Index pour la table `challenge_category`
--
ALTER TABLE `challenge_category`
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `date_at` (`date_at`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dateSend` (`dateSend`);

--
-- Index pour la table `rating_challenges`
--
ALTER TABLE `rating_challenges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_challenge` (`token_challenge`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `user_challenge`
--
ALTER TABLE `user_challenge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Index pour la table `user_progression`
--
ALTER TABLE `user_progression`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `token_user` (`token_user`(50));

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `challenge`
--
ALTER TABLE `challenge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rating_challenges`
--
ALTER TABLE `rating_challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user_challenge`
--
ALTER TABLE `user_challenge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_progression`
--
ALTER TABLE `user_progression`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
