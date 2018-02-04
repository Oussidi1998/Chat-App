-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Dim 04 Février 2018 à 22:01
-- Version du serveur :  5.7.15-log
-- Version de PHP :  5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `likefb`
--

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `id_invit` int(11) NOT NULL,
  `id_accept` int(11) NOT NULL,
  `datee` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id`, `id_invit`, `id_accept`, `datee`) VALUES
(1, 1, 2, '2018-01-25 19:59:08');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `civil` varchar(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `pays` varchar(40) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `avatar` varchar(120) NOT NULL,
  `confirmkey` bigint(20) NOT NULL,
  `confirmer` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `nom`, `prenom`, `civil`, `email`, `username`, `password`, `adresse`, `pays`, `ville`, `zipcode`, `avatar`, `confirmkey`, `confirmer`) VALUES
(1, 'Oussidi', 'Mohamed', 'homme', 'osidi1998@gmail.com', 'osidi1998', '25f9e794323b453885f5181f1b624d0b', '14 rue 8 quartier boulili rich', 'Maroc', 'Rich', 52400, 'OussidiMohamed.jpg', 1196560512, 1),
(2, 'Assofi', 'Salah', 'homme', 'salah.dev@gmail.com', 'Mugiwara', '25f9e794323b453885f5181f1b624d0b', '12 rue tajdin quartier tahmidant', 'Maroc', 'rich', 52400, 'AssofiSalah.jpg', , 1359485493, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_reciever` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `datee` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `id_sender`, `id_reciever`, `content`, `datee`) VALUES
(1, 1, 2, 'Helllo Mr salah how are you ? ', '2018-01-25 00:09:20'),
(2, 2, 1, 'Hi Mohamed i am fine thanks ? ', '2018-01-25 00:10:53'),
(3, 1, 2, 'nice to hear that man', '2018-01-25 00:11:12'),
(4, 2, 1, 'thanks for asking', '2018-01-25 00:19:27'),
(5, 1, 2, 'hi again ', '2018-01-25 00:43:20'),
(6, 2, 1, 'hi man what\'s up going with you ', '2018-01-25 00:43:57'),
(7, 2, 1, 'you put me in torrible  ', '2018-01-25 00:44:24'),
(8, 1, 2, 'No just I wanna ask you about something', '2018-01-25 00:45:22'),
(9, 1, 2, 'Do you know which exams we have after holiday', '2018-01-25 00:45:58'),
(10, 2, 1, 'Well I think we have about 3 exams one for faraji will be in first day after holiday second french  and than Mathematic ', '2018-01-25 00:52:05');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
