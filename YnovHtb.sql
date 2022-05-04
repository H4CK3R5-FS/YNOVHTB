-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 04 mai 2022 à 11:21
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Ynovhtb`
--

-- --------------------------------------------------------

--
-- Structure de la table `challenge`
--

CREATE TABLE `challenge` (
  `id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_flag` varchar(255) NOT NULL,
  `c_description` text NOT NULL,
  `c_add_infos` text DEFAULT NULL,
  `exp` int(11) NOT NULL DEFAULT 50,
  `c_category` varchar(20) NOT NULL,
  `path` varchar(500) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `token_uploader` varchar(50) NOT NULL,
  `Status` enum('Confirmed','Pendding') NOT NULL DEFAULT 'Pendding',
  `date_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des challenges';

--
-- Déchargement des données de la table `challenge`
--

INSERT INTO `challenge` (`id`, `c_name`, `c_flag`, `c_description`, `c_add_infos`, `exp`, `c_category`, `path`, `token`, `token_uploader`, `Status`, `date_at`) VALUES
(1, 'Challenge n001', 'KJSDFGHJKrtyujnbvf34567', 'Challenge N001', '', 100, 'Craking', NULL, 'YiHquoPiEh0rwxhVYYON', 'YiHquoPiEh0rwxhVYYONfBzMaZ2Drxt5SqW6mhkfJn33ej9iTv', 'Pendding', '2022-05-04 02:34:18'),
(2, 'Challenge n002', 'LGFDSZERTHKUYTVHYTRDCVBHYTRY22', 'Test', '', 100, 'Reverse engineering', NULL, 'fyYRR2rNTZ0OvrCGj6YK', 'YiHquoPiEh0rwxhVYYONfBzMaZ2Drxt5SqW6mhkfJn33ej9iTv', 'Confirmed', '2022-05-04 02:39:48'),
(4, 'Challenge n0032', 'LGFDSZERTHKUYTVHYTRDCVBHYTRY22', '', '', 100, 'Forensic', NULL, 'ZuOLgPXFIs1JIXbOvnuG', 'Y9xMgda2fgdeQCL4Wj2cpP6lGdJyQ9OMVGAvg52nSvOSMXASDC', 'Pendding', '2022-05-04 04:57:27'),
(5, 'Challenge n0033', 'eqsdqsNBVGBYTRDCVGYTFCVBJ', '', '', 100, 'Craking', NULL, 'm4xXHq129PRl5yMVWEYe', 'Y9xMgda2fgdeQCL4Wj2cpP6lGdJyQ9OMVGAvg52nSvOSMXASDC', 'Pendding', '2022-05-04 05:00:33'),
(6, 'Challenge n0034', 'JHUIJHGYUKOIUHJUISOKSY7SYHS7YS7Z77Z78U8282UGUHHJ', 'Test 517', '', 100, 'Craking', 'recent/challenges/challenge-6271ecb44d1d4.yml', 'UMNSh6xVhVeYlehaMqIJ', 'Y9xMgda2fgdeQCL4Wj2cpP6lGdJyQ9OMVGAvg52nSvOSMXASDC', 'Pendding', '2022-05-04 05:02:12'),
(7, 'Challenge n0039', 'lkqjkdsjqsdioqdnqiqudsnqqkmqkdqsmjdqslkdq', 'Test', '', 100, 'Craking', NULL, 'mvQzM2i7PbbAhv0KTGX4', 'Y9xMgda2fgdeQCL4Wj2cpP6lGdJyQ9OMVGAvg52nSvOSMXASDC', 'Pendding', '2022-05-04 05:10:05');

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

INSERT INTO `contact` (`id`, `email`, `object`, `message`, `dateSend`) VALUES
(1, 'lroem@lorem.ol', 'test', 'test !!!', '2021-11-24 13:56:36');

-- --------------------------------------------------------

--
-- Structure de la table `rating_challenges`
--

CREATE TABLE `rating_challenges` (
  `id` int(11) NOT NULL,
  `rate_positive` int(11) DEFAULT NULL,
  `rate_negative` int(11) DEFAULT NULL,
  `token_user` varchar(50) NOT NULL,
  `token_challenge` varchar(100) NOT NULL,
  `token` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Rating challenge';

--
-- Déchargement des données de la table `rating_challenges`
--

INSERT INTO `rating_challenges` (`id`, `rate_positive`, `rate_negative`, `token_user`, `token_challenge`, `token`) VALUES
(1, 1, NULL, 'YiHquoPiEh0rwxhVYYONfBzMaZ2Drxt5SqW6mhkfJn33ej9iTv', 'YiHquoPiEh0rwxhVYYON', 'D5KJhro2od0mUMqLGsRK'),
(12, 1, NULL, 'YiHquoPiEh0rwxhVYYONfBzPds2Drxt5SqW6mhkfJn33ej9iTv', 'YiHquoPiEh0rwxhVYYON', 'D5KJhro2od0mUMqLsdRK'),
(24, 1, NULL, 'YiHquoPiEh0rwxhVYYONfBzMaZ2Drxt5SqW6mhkfJn33ej9iTv', 'mvQzM2i7PbbAhv0KTGX4', 'BXK8DixM0OkqYaIfJllR');

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

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `token`, `level`, `remember_token`, `confirmation_token`, `confirmation_at`, `reset_token`, `reset_at`) VALUES
(2, 'killer91', 'boufala.yacine.pro@gmail.com', '$2y$10$ExrrGLbr9MFIOA/uvQYxuuHLWdamW9CLCXXszLRVcTdE/xSRHSH5y', 'YiHquoPiEh0rwxhVYYONfBzMaZ2Drxt5SqW6mhkfJn33ej9iTv', 'member', 'NhT1FlA4N3sUQYwZFG6jknNcCKzsD0EMuSDnVcryDy778sPFEGay6gpJPQV1WznC34CWifbtMRXjFCxSQQbivucPYgOgkuyIuIeafj5rbSeDrGJ96yfTZsV3rOsZewE8ygIKcJ5oOsO6coZekFb8AgqwCPfeoVVuKZhOZSf7i66Bw9MkOwZCpG47lWu9QMnMKoJO5dms6M6BUkShS8sUjSAe0GqChvTtbHcb7tDr21UtwwsnHCr6KnBzcv', NULL, '2022-04-06 01:20:33', 'etT8RE3zhmBcNNx4rvF72wTS7V7F4zv7AhVFkBECCIQGEDelRYQFwYUTW0Ey3NaLMr38RsPfIgD90H7ZGLEQI18N1JIlpFGa2aNtHvFlHgBvQt680Ar7tQstPMPJlmFTa3cQcnLqTyXd4LUxkangyEtRGk8CkEEEub49merFY9rqfYzMcuomkZ8lJgP7G63Cpr0Xtd38lz4elpBzktDAiasQF7CKhDv2w4I0A1ZM2gCqawPXN3Tq7lDRz1', '2022-05-04 11:05:46'),
(3, 'alex', 'alex_lima@ynov.com', '$2y$10$vVm/17sDplesWV49xjHgUu1OeIdybo15AXMz1UdAipD26lD19oVDC', 'ITsmtOJUgYZuPjD21RAHelKrFH1M7gl4INnw5ZKhC72NQzQGU5', 'member', NULL, NULL, '2022-04-20 15:09:17', NULL, NULL),
(6, 'rayan', 'admin.data@deco-perso.dp', '$2y$10$m4yORU5ls0/57LizCOgQ7elO7XYHHT5odBLJttApP54zqMtT8mghK', 'Y9xMgda2fgdeQCL4Wj2cpP6lGdJyQ9OMVGAvg52nSvOSMXASDC', 'member', NULL, NULL, '2022-05-04 04:47:36', NULL, NULL),
(7, 'coriane', 'nextu@gmail.com', '$2y$10$0BL4O.qnbAVWLvv4f7/DRehxcgBEZmAMVQWoEPFWmcr.APbX6F6XG', 'yNp8LGkwN0fctrplbJ8QKkVkYPB9YGkZxXbVImEuUoqB9KqKQb', 'member', NULL, NULL, '2022-05-04 04:47:40', NULL, NULL),
(8, 'hacker99', 'dr.routage@deco-perso.dp', '$2y$10$DYTclWlC6ZUOY2qeAcvCse4fIDjBxwcU63FT8VuWahSeSwLSp0Gsm', '4X7mhQXLy1Y1GRddEB7AwJ23bXfBQ9zRKb4sfIUMA3zuhIkNVI', 'member', NULL, NULL, '2022-05-04 04:48:52', NULL, NULL);

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
  `grade` enum('Débutant','Intermediaire','Avancé','Expert','Master') NOT NULL DEFAULT 'Débutant',
  `token` varchar(20) NOT NULL,
  `lastEdit_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User progression';

--
-- Déchargement des données de la table `user_progression`
--

INSERT INTO `user_progression` (`id`, `token_user`, `exp`, `grade`, `token`, `lastEdit_at`) VALUES
(1, 'YiHquoPiEh0rwxhVYYONfBzMaZ2Drxt5SqW6mhkfJn33ej9iTv', 234567, 'Débutant', '1uGqLaPE6yVxsPZuuaFf', '2022-04-06 01:19:37'),
(2, 'ITsmtOJUgYZuPjD21RAHelKrFH1M7gl4INnw5ZKhC72NQzQGU5', 0, 'Débutant', 'tbC2ZN8mZQzljuOYv626', '2022-04-20 15:07:59'),
(3, 'Y9xMgda2fgdeQCL4Wj2cpP6lGdJyQ9OMVGAvg52nSvOSMXASDC', 0, 'Débutant', 'fZvoPLiYTz0ebZGfaVoq', '2022-05-04 04:46:53'),
(4, 'yNp8LGkwN0fctrplbJ8QKkVkYPB9YGkZxXbVImEuUoqB9KqKQb', 0, 'Débutant', 'lYLFTHelyqvMLufzoh8J', '2022-05-04 04:47:20'),
(5, '4X7mhQXLy1Y1GRddEB7AwJ23bXfBQ9zRKb4sfIUMA3zuhIkNVI', 0, 'Débutant', 'XGNB3KMuwcq2xW6lxIFo', '2022-05-04 04:48:42');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `date_at` (`date_at`),
  ADD UNIQUE KEY `title` (`c_name`);

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
  ADD UNIQUE KEY `token` (`token`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `reset_token` (`reset_token`),
  ADD UNIQUE KEY `confirmation_token` (`confirmation_token`),
  ADD UNIQUE KEY `reset_at` (`reset_at`),
  ADD UNIQUE KEY `confirmation_at` (`confirmation_at`),
  ADD UNIQUE KEY `remember_token` (`remember_token`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rating_challenges`
--
ALTER TABLE `rating_challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user_challenge`
--
ALTER TABLE `user_challenge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_progression`
--
ALTER TABLE `user_progression`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
