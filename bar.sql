-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 22 Mai 2017 à 20:33
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bar`
--
CREATE DATABASE IF NOT EXISTS `bar` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bar`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `name`, `description`, `categorie_id`, `prix`) VALUES
(1, 'Coca-cola', 'Attention aux bulles !', 1, 1),
(2, 'Coca zero', 'Les bulles sont sans sucre !', 1, 1),
(3, 'Jus d\'orange', 'Quand c\'est trop c\'est tropico.', 1, 1),
(4, 'Jus de pomme', 'C\'est trognon comme boisson.', 1, 1),
(5, 'Jus d\'abricot', 'Sans noyau.', 1, 1),
(6, 'Jus d\'ananas', 'Les ananas de la belle...', 1, 1),
(7, 'Jus de pamplemousse', 'Meilleur avec du vin blanc.', 1, 1),
(8, 'Jus de tomate', 'La tomate est un fruit, c\'est un fait.', 1, 1),
(9, 'Jus de fraise', 'La boisson de charlotte.', 1, 1),
(10, 'Orangina', 'Secouez, sinon la pulpe, elle reste en bas.', 1, 1),
(11, 'Schweppes agrum', 'What did you expect.', 1, 1),
(12, 'Limonade', 'Bulle + citron + eau.', 1, 1),
(13, 'Perrier', 'Un sirop dedans ?', 1, 1),
(14, 'Evian', '(De quel massif montagneux ca vient çà déjà ?)', 1, 1),
(15, 'Cristaline', 'C\'est clair', 1, 0.5),
(16, 'la Seinoise', 'Riche en urinium, et en oligo-excréments.', 1, 0.5),
(17, 'Grim (bouteille)', 'La bière des hommes', 2, 1.5),
(18, 'Grim Rouge', 'La bière des femmes', 2, 1.5),
(19, '1664', 'Idéal avant de retourner sur le chantier', 2, 1.3),
(20, '1664 (bouteille)', 'Idéal avant de retourner sur le chantier', 2, 1.5),
(21, 'Panaché', 'Servi avec panache !', 2, 1.3),
(22, 'Monaco', 'Une peu de fruit pour les vitamines !', 2, 1.3),
(23, 'PCB', 'Un picon ch\'tit biloute !', 2, 1.8),
(24, 'Bière du mois', 'Selon arrivages', 2, 1.5),
(25, 'Martini', 'Martini dry... Avec ou sans olives ?', 3, 1.5),
(26, 'Muscat', 'Une velle robe dorée', 3, 1.5),
(27, 'Pineau', 'À commander en charentaises', 3, 1.5),
(28, 'Rosé pamplemousse', 'Teneur en fruit non garantie', 3, 1.4),
(29, 'Vin blanc', 'Belle robe dorée', 3, 1.4),
(30, 'Vin mousseux', 'Le vin qui pique !', 3, 1.4),
(31, 'Cidre (75cl)', 'Mangez des pommes !', 3, 5),
(32, 'Kir vin blanc', '', 3, 1.5),
(33, 'Kir royal', 'Mure ou cassis ?', 3, 1.5),
(34, 'Chips', 'Le roi de la pomme de terre', 4, 2),
(35, 'Saucisson', 'Préciser "A l\'ail" si possible', 4, 2.9),
(36, 'Chorizo', 'Aux épices', 4, 2.9),
(37, 'Olives', 'Fraichement cueillies dans le bocal', 4, 2),
(38, 'Carre filet', 'Aucune idée mais c\'est sur la carte....', 4, 3.5),
(39, 'Espresso', 'Du bon nectar.', 5, 0.5),
(40, 'Double Espresso', 'Que j\'aime ta couleur...', 5, 1),
(41, 'Décaféiné', 'C\'est pas du café en gros ?', 5, 0.5),
(42, 'Chocolat', 'Le meilleurs c\'est choky !', 5, 0.5),
(43, 'Capuccino', 'À l\'italienne', 5, 0.5),
(44, 'Thé', 'Tea time', 5, 0.5);

-- --------------------------------------------------------

--
-- Structure de la table `bar`
--

CREATE TABLE `bar` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bar_article`
--

CREATE TABLE `bar_article` (
  `id` int(11) NOT NULL,
  `bar_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`, `icon`) VALUES
(1, 'Soft', '&#xEB41;'),
(2, 'Binouzes', '&#xE544;'),
(3, 'Boissons alcoolisées', '&#xE540;'),
(4, 'Miam-miam', '&#xE552;'),
(5, 'Boissons Chaudes', '&#xE541;');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users_articles`
--

CREATE TABLE `users_articles` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E66BCF5E72D` (`categorie_id`);

--
-- Index pour la table `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bar_article`
--
ALTER TABLE `bar_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_901F2A7A89A253A` (`bar_id`),
  ADD KEY `IDX_901F2A7A7294869C` (`article_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D6495E237E06` (`name`);

--
-- Index pour la table `users_articles`
--
ALTER TABLE `users_articles`
  ADD PRIMARY KEY (`user_id`,`article_id`),
  ADD UNIQUE KEY `UNIQ_C49C1AB27294869C` (`article_id`),
  ADD KEY `IDX_C49C1AB2A76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `bar`
--
ALTER TABLE `bar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `bar_article`
--
ALTER TABLE `bar_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `bar_article`
--
ALTER TABLE `bar_article`
  ADD CONSTRAINT `FK_901F2A7A7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_901F2A7A89A253A` FOREIGN KEY (`bar_id`) REFERENCES `bar` (`id`);

--
-- Contraintes pour la table `users_articles`
--
ALTER TABLE `users_articles`
  ADD CONSTRAINT `FK_C49C1AB27294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_C49C1AB2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
