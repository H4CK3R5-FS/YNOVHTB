-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 10 nov. 2021 à 17:01
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
-- Structure de la table `users`
--

CREATE TABLE `users` (
	`id` int(11) NOT NULL,
	`pseudo` varchar(50) NOT NULL,
	`email` varchar(100) NOT NULL,
	`password` varchar(250) NOT NULL,
	`token` varchar(50) NOT NULL,
	`level` enum('Member','Admin') NOT NULL DEFAULT 'Member',
	`remember_token` varchar(100) DEFAULT NULL,
	`confirmation_token` varchar(100) DEFAULT NULL,
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
		'CvMcFrutNM3gV7XDrKi1OxndajKOxzbzCglIn99SbksQvh15Njzf7NwRt9ukUQtYhpuj7FqifCB4bh0AbWO02n5z7TSby836libh', 
		NULL, 
		'2021-11-10 16:21:22', 
		NULL, 
		NULL
	);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
	ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
