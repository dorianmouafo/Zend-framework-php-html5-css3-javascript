-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Vendredi 15 Septembre 2006 à 23:04
-- Version du serveur: 4.1.9
-- Version de PHP: 4.3.10
-- 
-- Base de données: `exemple`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `classe`
-- 

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(3) NOT NULL default '0',
  `code` varchar(10) NOT NULL default '',
  `nom` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `classe`
-- 

INSERT INTO `classe` VALUES (1, '1ere', 'Premi&egrave;re ann&eacute;e');
INSERT INTO `classe` VALUES (2, '2&egrave;m', 'Deuxi&egrave;me ann&eacute;e');

-- --------------------------------------------------------

-- 
-- Structure de la table `etudiant`
-- 

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(10) NOT NULL default '0',
  `matricule` varchar(10) NOT NULL default '',
  `nom` varchar(50) NOT NULL default '',
  `prenom` varchar(20) NOT NULL default '',
  `id_classe` char(3) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `etudiant`
-- 

INSERT INTO `etudiant` VALUES (2, 'M002', 'Durant', 'Paul', '2');
INSERT INTO `etudiant` VALUES (1, 'M001', 'Dupont', 'Jean', '1');
