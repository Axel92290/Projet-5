-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 23 sep. 2022 à 15:32
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pword` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_connexion` datetime NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `pword`, `date_creation`, `date_connexion`, `role`) VALUES
(1, 'Chasseloup', 'Axel', 'axel.chasselouppro@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$cFN4cWNRZC5jMTRMSlVHSA$JEeoC0gbnpQwdqyrpY6q5wGKzmxKlKnej+cjMiQZ4DM', '2022-09-20 18:11:07', '2022-09-23 15:11:14', 1),
(2, 'Rossi', 'Adalberto', 'AdalbertoRossi@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NFhoNVFyNi5HWjgyTDN6Tw$yAMSCyuQZCz9MGDcsTNc4SLL0DR5EY+3QEb4DAFO8b4', '2022-09-23 08:25:13', '2022-09-23 08:25:13', 0),
(3, 'Lanoie', 'Delphine', 'DelphineLanoie@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Z1haZ2xRLk9ONElsNHBMVg$lsY/Y1peY28evrdrdHaX3ba6ohh47IsAFK8SV8houO0', '2022-09-23 08:26:39', '2022-09-23 08:26:39', 0),
(4, 'Caouette', 'Gérard', 'GerardCaouette@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$LmlKMXJBLnd0dVI4S1FpZQ$+cnG2HVCRC/GbcfBJLYjWHiVgs+MxyDRvLONFSR9+uw', '2022-09-23 08:27:27', '2022-09-23 08:27:27', 0),
(5, 'Bordeaux', 'Lirienne', 'LirienneBordeaux@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$RGZuLkhWYVp5cjdWU2l5dg$pv3laK9KktuE0KDwMs8Le4d+YHZJzXWXMtEfezqOseE', '2022-09-23 08:28:05', '2022-09-23 08:28:05', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
