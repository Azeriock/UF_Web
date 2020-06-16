-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 juin 2020 à 16:23
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leboncoin_data`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `description` varchar(1000) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `date_publication` date NOT NULL,
  `statut` varchar(10) NOT NULL,
  `catégorie` varchar(100) NOT NULL,
  `id_proprietaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `titre`, `prix`, `description`, `photo`, `date_publication`, `statut`, `catégorie`, `id_proprietaire`) VALUES
(1, 'clio', 200, 'Voiture d\'occasion a vendre', NULL, '2020-06-17', 'actif', 'vehicule', 2),
(2, 'audi', 250, 'Voiture d\'occasion a vendre', NULL, '2020-06-17', 'actif', 'vehicule', 2),
(3, 'moto', 150, 'je vends ma moto', NULL, '2020-06-16', 'actif', 'vehicule', 2),
(4, 'velo', 50, 'je vends mon velo', NULL, '2020-06-16', 'actif', 'vehicule', 2),
(6, 'vetement 1', 15, 'Voici un vetement', NULL, '2020-06-18', 'actif', 'mode', 2),
(9, 'Tshirt', 15, 'voici un tshirt', NULL, '2020-06-30', 'actif', 'mode', 2);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_expediteur`, `id_destinataire`, `message`) VALUES
(7, 2, 1, 'je test'),
(8, 1, 2, 'autre test'),
(9, 2, 1, 'voici mon message'),
(10, 2, 1, 'Regarde mon message !');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `password`, `photo`) VALUES
(1, 'Pierret', 'LoicAdmin', 'Admin@live.fr', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1.png'),
(2, 'Pierret', 'Loic', 'loicpierret@live.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '2.jpg'),
(3, 'Pierrettest', 'loictest', 'loictest@live.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
