-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 11 août 2023 à 11:35
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage_parrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_brand` varchar(30) NOT NULL,
  `car_type` varchar(80) NOT NULL,
  `car_price` int(11) NOT NULL,
  `car_year` varchar(4) NOT NULL,
  `car_km` int(11) NOT NULL,
  `car_desc` text NOT NULL,
  `car_img_face` varchar(255) NOT NULL,
  `car_img_side` varchar(255) NOT NULL,
  `car_img_inside` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day` text NOT NULL,
  `morning_start` text NOT NULL,
  `morning_end` text NOT NULL,
  `afternoon_start` text NOT NULL,
  `afternoon_end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `schedule`
--

INSERT INTO `schedule` (`id`, `day`, `morning_start`, `morning_end`, `afternoon_start`, `afternoon_end`) VALUES
(1, 'Lundi', '08:45', '12:00', '14:00', '18:00'),
(2, 'Mardi', '08:45', '12:00', '14:00', '18:00'),
(3, 'Mercredi', '08:45', '12:00', '14:00', '18:00'),
(4, 'Jeudi', '08:45', '12:00', '14:00', '18:00'),
(5, 'Vendredi', '08:45', '12:00', '14:00', '18:00'),
(6, 'Samedi', '08:45', '12:00', '', ''),
(7, 'Dimanche', 'Fermé', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `service_name` text NOT NULL,
  `included` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `service_name`, `included`, `price`) VALUES
(0, 'Basique', 'Vidange, pression des pneus, appoint des liquides.', 299),
(1, 'Confort', 'Tout le forfait \'Basique\', changement des plaquettes de freins.', 499),
(2, 'Premium', 'Tout le forfait \'Confort\', changement du liquide de refroidissement, changement de la courroie de distribution.', 899),
(3, 'Climatisation', 'Recharge climatisation.', 59),
(4, 'Montage pneu', 'Prix pour changement d\'un pneu.', 48);

-- --------------------------------------------------------

--
-- Structure de la table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `testimonial` text NOT NULL,
  `client` text NOT NULL,
  `writer` text NOT NULL,
  `note` int(1) NOT NULL,
  `authorized` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `secret` text NOT NULL,
  `creation_date` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `secret`, `creation_date`) VALUES
(0, 'contact@vparrot.fr', 'bx14252392bd4a5098bf6f9c162df0faff9c00c3f29123', '989d26c5f19b7738bf2ad370d0d5c085c85553301689079323', 2147483647);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
