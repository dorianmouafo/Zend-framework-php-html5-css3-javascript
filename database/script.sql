-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 11 Juillet 2013 à 13:07
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `worldplay`
--

-- --------------------------------------------------------

--
-- Structure de la table `advertisings`
--

CREATE TABLE `advertisings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `iOSImage` varchar(256) DEFAULT NULL,
  `iOSUrl` varchar(256) DEFAULT NULL,
  `AndroidUrl` varchar(256) DEFAULT NULL,
  `AndroidImage` varchar(256) DEFAULT NULL,
  `WindowsUrl` varchar(256) DEFAULT NULL,
  `WindowsImage` varchar(256) DEFAULT NULL,
  `WebUrl` varchar(256) DEFAULT NULL,
  `WebImage` varchar(256) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `iOSImage` (`iOSImage`),
  UNIQUE KEY `iOSUrl` (`iOSUrl`),
  UNIQUE KEY `AndroidUrl` (`AndroidUrl`),
  UNIQUE KEY `AndroidImage` (`AndroidImage`),
  UNIQUE KEY `WindowsUrl` (`WindowsUrl`),
  UNIQUE KEY `WindowsImage` (`WindowsImage`),
  UNIQUE KEY `WebUrl` (`WebUrl`),
  UNIQUE KEY `WebImage` (`WebImage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `ques_uuid` char(36) DEFAULT NULL,
  `ans_1` varchar(128) DEFAULT NULL,
  `ans_2` varchar(128) DEFAULT NULL,
  `ans_3` varchar(128) DEFAULT NULL,
  `ans_4` varchar(255) DEFAULT NULL,
  `sol_1` int(11) DEFAULT '0',
  `sol_2` int(11) DEFAULT '0',
  `sol_3` int(11) DEFAULT '0',
  `sol_4` int(11) DEFAULT '0',
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `ques_uuid_idxfk` (`ques_uuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `contests`
--

CREATE TABLE `contests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `cp_id` char(36) DEFAULT NULL,
  `teach_id` char(36) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `data` varchar(256) NOT NULL,
  `blob_questions` mediumblob,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `cp_id_idxfk` (`cp_id`),
  KEY `teach_id_idxfk` (`teach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contestsparams`
--

CREATE TABLE `contestsparams` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `time_1` int(11) DEFAULT '15',
  `time_2` int(11) DEFAULT '30',
  `time_3` int(11) DEFAULT '45',
  `points` int(11) DEFAULT '1',
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` varchar(36) DEFAULT NULL,
  `blob_questions` varchar(700) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_uuid` varchar(36) DEFAULT NULL,
  `level_uuid` varchar(36) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `name` (`name`),
  KEY `price_idxfk` (`price`),
  KEY `FK_FCT_PRS` (`user_uuid`),
  KEY `FK_FCT_LEVL` (`level_uuid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lang_id` char(36) DEFAULT NULL,
  `lev_id` char(36) DEFAULT NULL,
  `lev_goal_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `points_questions` int(11) DEFAULT NULL,
  `points_answers` int(11) DEFAULT NULL,
  `blob_ques_points` varchar(700) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `lang_id_idxfk` (`lang_id`),
  KEY `lev_id_idxfk` (`lev_id`),
  KEY `lev_goal_id_idxfk` (`lev_goal_id`),
  KEY `user_id_idxfk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `teach_id` char(36) DEFAULT NULL,
  `cat_id` char(36) DEFAULT NULL,
  `qt_id` char(36) DEFAULT NULL,
  `lang_id` char(36) DEFAULT NULL,
  `lev_id` char(36) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `points` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `teach_id_idxfk_1` (`teach_id`),
  KEY `cat_id_idxfk` (`cat_id`),
  KEY `qt_id_idxfk` (`qt_id`),
  KEY `lang_id_idxfk_1` (`lang_id`),
  KEY `lev_id_idxfk_1` (`lev_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

-- --------------------------------------------------------

--
-- Structure de la table `questiontypes`
--

CREATE TABLE `questiontypes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `styles`
--

CREATE TABLE `styles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` varchar(32) NOT NULL,
  `url` varchar(32) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uuid_price` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `FK_FCT_STYLE` (`uuid_price`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `name` char(32) NOT NULL,
  `email` char(32) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `isprof` char(8) NOT NULL,
  `blob_styles` blob,
  `blob_products` blob,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(32) NOT NULL,
  `etat` int(2) NOT NULL,
  `avatar` blob,
  `domaine` varchar(128) DEFAULT NULL,
  `admin` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`ques_uuid`) REFERENCES `questions` (`uuid`);

--
-- Contraintes pour la table `contests`
--
ALTER TABLE `contests`
  ADD CONSTRAINT `contests_ibfk_1` FOREIGN KEY (`cp_id`) REFERENCES `contestsparams` (`uuid`),
  ADD CONSTRAINT `contests_ibfk_2` FOREIGN KEY (`teach_id`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_FCT_LEVL` FOREIGN KEY (`level_uuid`) REFERENCES `levels` (`uuid`),
  ADD CONSTRAINT `FK_FCT_PRS` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`price`) REFERENCES `prices` (`uuid`);

--
-- Contraintes pour la table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`uuid`),
  ADD CONSTRAINT `profiles_ibfk_2` FOREIGN KEY (`lev_id`) REFERENCES `levels` (`uuid`),
  ADD CONSTRAINT `profiles_ibfk_3` FOREIGN KEY (`lev_goal_id`) REFERENCES `levels` (`uuid`),
  ADD CONSTRAINT `profiles_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`teach_id`) REFERENCES `users` (`uuid`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`uuid`),
  ADD CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`qt_id`) REFERENCES `questiontypes` (`uuid`),
  ADD CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`uuid`),
  ADD CONSTRAINT `questions_ibfk_5` FOREIGN KEY (`lev_id`) REFERENCES `levels` (`uuid`);

--
-- Contraintes pour la table `styles`
--
ALTER TABLE `styles`
  ADD CONSTRAINT `FK_FCT_STYLE` FOREIGN KEY (`uuid_price`) REFERENCES `prices` (`uuid`);
