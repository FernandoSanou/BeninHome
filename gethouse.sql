-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 juin 2024 à 21:44
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gethouse`
--

-- --------------------------------------------------------

--
-- Structure de la table `blocked`
--

DROP TABLE IF EXISTS `blocked`;
CREATE TABLE IF NOT EXISTS `blocked` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `idVictim` int NOT NULL,
  `nomVictim` text NOT NULL,
  `blockage` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomMessager` text NOT NULL,
  `prenomMessager` text NOT NULL,
  `idMessager` text NOT NULL,
  `nomCorrespondant` text NOT NULL,
  `prenomCorrespondant` text NOT NULL,
  `idCorrespondant` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `nomMessager`, `prenomMessager`, `idMessager`, `nomCorrespondant`, `prenomCorrespondant`, `idCorrespondant`, `date`) VALUES
(9, 'SANOU', 'Fernando', '1', 'SANOU', 'Arthur', '2', '16-06-2024 09:16');

-- --------------------------------------------------------

--
-- Structure de la table `coomments`
--

DROP TABLE IF EXISTS `coomments`;
CREATE TABLE IF NOT EXISTS `coomments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` text NOT NULL,
  `nomAuteur` text NOT NULL,
  `prenomAuteur` text NOT NULL,
  `commentaire` text NOT NULL,
  `idPost` varchar(10) NOT NULL,
  `specialId` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `coomments`
--

INSERT INTO `coomments` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `commentaire`, `idPost`, `specialId`, `date`) VALUES
(1, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '4', '17152738182896173561715273818', '09/05/2024 16:56'),
(2, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '4', '17152738182896173561715273818', '09/05/2024 16:56'),
(3, '3', 'asus', 'asus', 'OK C4EST BON ALOES', '4', '17152738182896173561715273818', '09/05/2024 16:56'),
(4, '3', 'asus', 'asus', 'maitenant il y a du changmeent', '4', '17152738182896173561715273818', '10/05/2024 19:39'),
(5, '3', 'asus', 'asus', 'maitenant il y a du changmeent', '4', '17152738182896173561715273818', '10/05/2024 19:39'),
(6, '3', 'asus', 'asus', 'maitenant il y a du changmeent', '4', '17152738182896173561715273818', '10/05/2024 19:39'),
(7, '3', 'asus', 'asus', 'maitenant il y a du changmeent', '4', '17152738182896173561715273818', '10/05/2024 19:41'),
(8, '3', 'asus', 'asus', 'my first comment', '2', '171353613416529498401713536134', '10/05/2024 20:44'),
(9, '1', 'SANOU', 'Fernando', 'OK C4EST BON ALOES', '2', '171353613416529498401713536134', '15/05/2024 07:48'),
(10, '1', 'SANOU', 'Fernando', 'ok good', '5', '17169068414715056621716906842', '28/05/2024 14:34'),
(11, '1', 'SANOU', 'Fernando', 'ok good', '4', '17152738182896173561715273818', '28/05/2024 18:18'),
(12, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '1', '1713076180393718441713076180', '29/05/2024 20:35'),
(13, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '6', '171701525114837132741717015251', '29/05/2024 20:54'),
(14, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:17'),
(15, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:18'),
(16, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:21'),
(17, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:21'),
(18, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:21'),
(19, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:21'),
(20, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:23'),
(21, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:23'),
(22, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:23'),
(23, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:23'),
(24, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:23'),
(25, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:23'),
(26, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:24'),
(27, '1', 'SANOU', 'Fernando', 'ok k o k k k ', '6', '171701525114837132741717015251', '30/05/2024 13:25'),
(28, '1', 'SANOU', 'Fernando', 'non inh moi la j\'ai fort pour ous qoui', '7', '171707600811757232441717076008', '30/05/2024 14:18'),
(29, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '7', '171707600811757232441717076008', '30/05/2024 14:27'),
(30, '2', 'SANOU', 'Arthur', 'merci alors', '7', '171707600811757232441717076008', '30/05/2024 14:30'),
(31, '1', 'SANOU', 'Fernando', 'OK C4EST BON ALOES', '9', '171711016816635904971717110168', '30/05/2024 23:16'),
(32, '1', 'SANOU', 'Fernando', 'my first comment', '12', '17171161861212494041717116186', '01/06/2024 23:24'),
(33, '1', 'SANOU', 'Fernando', 'my first comment', '13', '17172868536161986011717286853', '06-06-2024 11:38'),
(34, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '13', '17172868536161986011717286853', '08-06-2024 17:19'),
(35, '2', 'SANOU', 'Arthur', 'merci alors', '14', '171786914512889095241717869145', '09-06-2024 15:01'),
(36, '2', 'SANOU', 'Arthur', 'ok ok c\'est bon', '14', '171786914512889095241717869145', '09-06-2024 15:02'),
(37, '2', 'SANOU', 'Arthur', 'merci alors', '15', '171794559220481647861717945592', '09-06-2024 15:06'),
(38, '2', 'SANOU', 'Arthur', 'merci alors', '12', '17171161861212494041717116186', '10-06-2024 05:27'),
(39, '2', 'SANOU', 'Arthur', 'maitenant il y a du changmeent', '13', '17172868536161986011717286853', '10-06-2024 17:02');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` varchar(30) NOT NULL,
  `prenomAuteur` varchar(60) NOT NULL,
  `typeDemande` text NOT NULL,
  `prix` varchar(25) NOT NULL,
  `typeDeChambre` text NOT NULL,
  `quartier` varchar(30) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `IndicationParticulaire` varchar(60) NOT NULL,
  `socialSituation` varchar(60) NOT NULL,
  `date` text NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `typeDemande`, `prix`, `typeDeChambre`, `quartier`, `ville`, `IndicationParticulaire`, `socialSituation`, `date`, `type`) VALUES
(1, 1, 'SANOU', 'Fernando', 'ChambreALouer', '2500', 'Entré couché', 'zongo', 'bohicon', 'carrelé et Sanitaire', 'etudiante', '2024-06-13 18:20', 'Locataire'),
(3, 1, 'SANOU', 'Fernando', 'ChambreALouer', '2500', 'Entré couché', 'zongo', 'bohicon', 'carrelé et Sanitaire', 'etudiantedd', '2024-06-13 18:22', 'Locataire'),
(4, 1, 'SANOU', 'Fernando', 'ChambreALouer', '2500', 'Entré couché', 'zongo', 'bohicon', 'carrelé et Sanitaire', 'etudiantedd', '2024-06-13 18:24', 'Locataire');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `raison` text NOT NULL,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `name` varchar(30) NOT NULL,
  `bin` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `types` text NOT NULL,
  `size` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `raison`, `idAuteur`, `nomAuteur`, `name`, `bin`, `types`, `size`) VALUES
(1, 'profile', 1, 'SANOU', 'jiraya.jpg', '../images/1714922242701883354', 'image/jpeg', '189727'),
(15, 'message', 2, 'SANOU', 'photo_2023-12-03_21-22-03.jpg', '../images/1717446385798624303', 'image/jpeg', '166395'),
(3, 'profile', 3, 'asus', 'jiraya.jpg', '../images/17151919671117104306', 'image/jpeg', '189727'),
(4, 'profile', 3, 'asus', 'jiraya.jpg', '../images/1715192655606685329', 'image/jpeg', '189727'),
(5, 'profile', 3, 'asus', 'jiraya.jpg', '../images/17151928762141162840', 'image/jpeg', '189727'),
(8, 'profile', 2, 'SANOU', 'photo_2023-12-18_23-20-15.jpg', '../images/17172896391174122072', 'image/jpeg', '105473'),
(14, 'message', 2, 'SANOU', 'photo_2023-12-03_21-22-03.jpg', '../images/1717446254251255162', 'image/jpeg', '166395'),
(13, 'message', 2, 'SANOU', 'photo_2023-12-03_21-22-04.jpg', '../images/17173743971585363951', 'image/jpeg', '160607'),
(16, 'message', 2, 'SANOU', 'photo_2023-12-03_21-22-04.jpg', '../images/17174466651064125253', 'image/jpeg', '160607'),
(17, 'message', 2, 'SANOU', 'photo_2023-12-03_21-22-04.jpg', '../images/17174487141883269388', 'image/jpeg', '160607'),
(18, 'message', 2, 'SANOU', 'istockphoto-901953048-612x612.', '../images/17185519262001160493', 'image/jpeg', '33019');

-- --------------------------------------------------------

--
-- Structure de la table `imagesdemande`
--

DROP TABLE IF EXISTS `imagesdemande`;
CREATE TABLE IF NOT EXISTS `imagesdemande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idRequete` int NOT NULL,
  `raison` varchar(30) NOT NULL,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `bin` varchar(100) NOT NULL,
  `size` int NOT NULL,
  `date` text NOT NULL,
  `typeDechambre` text NOT NULL,
  `ville` text NOT NULL,
  `quartier` text NOT NULL,
  `indicationParticuliaire` text NOT NULL,
  `socialSituation` text NOT NULL,
  `short` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `imagesdemande`
--

INSERT INTO `imagesdemande` (`id`, `idRequete`, `raison`, `idAuteur`, `nomAuteur`, `name`, `bin`, `size`, `date`, `typeDechambre`, `ville`, `quartier`, `indicationParticuliaire`, `socialSituation`, `short`) VALUES
(8, 1, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-11.jpg', '../images/imageOffres/17135361761327989932', 166993, '19/04/2024', '3 chambres 1 salon', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '11ooC9t8HSU8U'),
(7, 1, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-11 (2).jpg', '../images/imageOffres/17135361761876721340', 233968, '19/04/2024', '3 chambres 1 salon', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '11ooC9t8HSU8U'),
(6, 1, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-09.jpg', '../images/imageOffres/1713536176570243653', 164622, '19/04/2024', '3 chambres 1 salon', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '11ooC9t8HSU8U'),
(5, 1, 'imagePrincipale', 2, 'SANOU', 'photo_2023-12-03_21-22-05.jpg', '../images/imageOffres/17135361761028693697', 172287, '19/04/2024', '3 chambres 1 salon', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '11ooC9t8HSU8U'),
(9, 1, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-12 (2).jpg', '../images/imageOffres/1713536176219599502', 158019, '19/04/2024', '3 chambres 1 salon', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '11ooC9t8HSU8U'),
(10, 2, 'imagePrincipale', 2, 'SANOU', 'photo_2023-12-03_21-22-02.jpg', '../images/imageOffres/17170997432077339718', 167789, '30/05/2024', '1 chambre 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '58l8F54J1aEyk'),
(11, 2, 'otherImage', 2, 'SANOU', 'luffy kid joboy.jpg', '../images/imageOffres/171709974457506921', 56129, '30/05/2024', '1 chambre 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '58l8F54J1aEyk'),
(12, 2, 'otherImage', 2, 'SANOU', 'naruto aquarelle.jpg', '../images/imageOffres/1717099745885464962', 175517, '30/05/2024', '1 chambre 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '58l8F54J1aEyk'),
(13, 2, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-21-58 (2).jpg', '../images/imageOffres/17170997451522091875', 167420, '30/05/2024', '1 chambre 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '58l8F54J1aEyk'),
(14, 2, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-03.jpg', '../images/imageOffres/1717099745837819792', 166395, '30/05/2024', '1 chambre 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '58l8F54J1aEyk'),
(15, 3, 'imagePrincipale', 2, 'SANOU', 'photo_2023-12-18_23-20-10.jpg', '../images/imageOffres/17172902191276439419', 170684, '02/06/2024', 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '12fDFvIRdKV8k'),
(16, 3, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-11 (2).jpg', '../images/imageOffres/1717290219782748906', 233968, '02/06/2024', 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '12fDFvIRdKV8k'),
(17, 3, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-11.jpg', '../images/imageOffres/17172902191723476100', 166993, '02/06/2024', 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '12fDFvIRdKV8k'),
(18, 3, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-12 (2).jpg', '../images/imageOffres/1717290219233459543', 158019, '02/06/2024', 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '12fDFvIRdKV8k'),
(19, 3, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-12.jpg', '../images/imageOffres/17172902196420765', 150130, '02/06/2024', 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '12fDFvIRdKV8k'),
(20, 3, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-13.jpg', '../images/imageOffres/17172902191248910213', 185412, '02/06/2024', 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '12fDFvIRdKV8k'),
(21, 4, 'imagePrincipale', 1, 'SANOU', 'fdepc4K_8486_capitaine_pirate.jpg', '../images/imageOffres/17173312867806582', 179332, '2024-06-02 12:27', 'Entré couché', 'fernando', 'zongo', 'carrelé et Sanitaire', 'etudiante', '11ooC9t8HSU8U'),
(22, 4, 'otherImage', 1, 'SANOU', 'photo_2023-12-18_23-20-17.jpg', '../images/imageOffres/17173312861532603916', 159332, '2024-06-02 12:27', 'Entré couché', 'fernando', 'zongo', 'carrelé et Sanitaire', 'etudiante', '11ooC9t8HSU8U'),
(23, 4, 'otherImage', 1, 'SANOU', 'photo_2023-12-18_23-20-19.jpg', '../images/imageOffres/171733128620616989', 142305, '2024-06-02 12:27', 'Entré couché', 'fernando', 'zongo', 'carrelé et Sanitaire', 'etudiante', '11ooC9t8HSU8U'),
(24, 4, 'otherImage', 1, 'SANOU', 'photo_2023-12-18_23-20-24 (2).jpg', '../images/imageOffres/1717331286692781601', 125584, '2024-06-02 12:27', 'Entré couché', 'fernando', 'zongo', 'carrelé et Sanitaire', 'etudiante', '11ooC9t8HSU8U'),
(25, 4, 'otherImage', 1, 'SANOU', 'photo_2023-12-18_23-20-24.jpg', '../images/imageOffres/171733128732132338', 125584, '2024-06-02 12:27', 'Entré couché', 'fernando', 'zongo', 'carrelé et Sanitaire', 'etudiante', '11ooC9t8HSU8U'),
(26, 5, 'imagePrincipale', 2, 'SANOU', 'photo_2023-12-03_21-22-04.jpg', '../images/imageOffres/1717997393176851023', 160607, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2'),
(27, 5, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-00.jpg', '../images/imageOffres/1717997393213498169', 235366, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2'),
(28, 5, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-02 (2).jpg', '../images/imageOffres/1717997395538234423', 126744, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2'),
(29, 5, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-02.jpg', '../images/imageOffres/1717997395969603671', 167789, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2'),
(30, 5, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-03.jpg', '../images/imageOffres/17179973961897734465', 166395, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2'),
(31, 5, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-04.jpg', '../images/imageOffres/1717997396909399727', 160607, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2'),
(32, 5, 'otherImage', 2, 'SANOU', 'photo_2023-12-03_21-22-05 (2).jpg', '../images/imageOffres/1717997396547945652', 164119, '2024-06-10 05:28', '2 chambres 1 salon', 'lokossa', 'ginkome', 'carrelé et Sanitaire', 'étudiant', '81C6MxBRj.CY2');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` varchar(25) NOT NULL,
  `prenomAuteur` text NOT NULL,
  `idCorrespondant` int NOT NULL,
  `nomCorrespondant` text NOT NULL,
  `prenomCorrespondant` text NOT NULL,
  `message` text NOT NULL,
  `lastMessage` text NOT NULL,
  `vueMessager` varchar(10) NOT NULL DEFAULT 'false',
  `vueCorrespondant` varchar(10) NOT NULL DEFAULT 'false',
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `idCorrespondant`, `nomCorrespondant`, `prenomCorrespondant`, `message`, `lastMessage`, `vueMessager`, `vueCorrespondant`, `date`) VALUES
(34, 1, 'SANOU', 'Fernando', 2, 'SANOU', 'Arthur', 'ok c\'est bon ainsi', '', 'true', 'true', '16-06-2024 15:45'),
(33, 1, 'SANOU', 'Fernando', 2, 'SANOU', 'Arthur', 'SALUT', '', 'true', 'true', '16-06-2024 15:41'),
(32, 2, 'SANOU', 'Arthur', 1, 'SANOU', 'Fernando', '../images/17185519262001160493', '', 'true', 'true', '16/06/2024'),
(31, 2, 'SANOU', 'Arthur', 1, 'SANOU', 'Fernando', 'non ne te\'zwxdcfghjjnkl,k;', '', 'true', 'true', '16-06-2024 15:31'),
(30, 2, 'SANOU', 'Arthur', 1, 'SANOU', 'Fernando', 'mais pourquoi', '', 'true', 'true', '16-06-2024 09:24'),
(29, 2, 'SANOU', 'Arthur', 1, 'SANOU', 'Fernando', 'es ce que cz mrtche', '', 'true', 'true', '16-06-2024 09:19'),
(28, 1, 'SANOU', 'Fernando', 2, 'SANOU', 'Arthur', 'ok d\'acore', '', 'true', 'true', '16-06-2024 09:16');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `prenomAuteur` text NOT NULL,
  `idVictim` int NOT NULL,
  `nomVictim` text NOT NULL,
  `prenomVictim` text NOT NULL,
  `type` text NOT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `view` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'false',
  `globalView` varchar(20) NOT NULL DEFAULT 'false',
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `idVictim`, `nomVictim`, `prenomVictim`, `type`, `link`, `view`, `globalView`, `date`) VALUES
(38, 0, '', '', 1, 'SANOU', 'Fernando', 'Publication', 'posts.php?idAuteur=1&nomAuteur=SANOU&prenomAuteur=Fernando&idPost=16&specialId=17185330215702552651718533021', '0', 'true', '16-06-2024 10:17');

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` text NOT NULL,
  `nomAuteur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenomAuteur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `typeDemande` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix` int NOT NULL,
  `typeDeChambre` text NOT NULL,
  `quartier` varchar(20) NOT NULL,
  `ville` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IndicationParticulaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `socialSituation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` text NOT NULL,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `short` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `typeDemande`, `prix`, `typeDeChambre`, `quartier`, `ville`, `IndicationParticulaire`, `socialSituation`, `date`, `type`, `short`) VALUES
(1, '2', 'SANOU', 'Arthur', 'ChambreALouer', 2000, '3 chambres 1 salon', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '30-05-2024', 'Proprietaire', '11ooC9t8HSU8U'),
(5, '2', 'SANOU', 'Arthur', 'ChambreALouer', 14414, '2 chambres 1 salon', 'ginkome', 'lokossa', 'carrelé et Sanitaire', 'étudiant', '2024-06-10 05:28', 'Proprietaire', '81C6MxBRj.CY2'),
(3, '2', 'SANOU', 'Arthur', 'ChambreALouer', 2000, 'Entré couché', 'ginkome', 'lokossa', 'Sanitiaire', 'étudiant', '02-06-2024', 'Proprietaire', '12fDFvIRdKV8k'),
(4, '1', 'SANOU', 'Fernando', 'ChambreALouer', 2500, 'Entré couché', 'zongo', 'bohicon', 'carrelé et Sanitaire', 'etudiante', '02-06-2024 12:27', 'Proprietaire', '11ooC9t8HSU8U');

-- --------------------------------------------------------

--
-- Structure de la table `pulications`
--

DROP TABLE IF EXISTS `pulications`;
CREATE TABLE IF NOT EXISTS `pulications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `prenomAuteur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `text` text NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `template` text NOT NULL,
  `date` text NOT NULL,
  `specialId` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pulications`
--

INSERT INTO `pulications` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `text`, `image`, `template`, `date`, `specialId`) VALUES
(13, 1, 'SANOU', 'azertyssqq', 'Votre publication', '', 'template9', '02/06/2024 00:07', '17172868536161986011717286853'),
(16, 1, 'SANOU', 'Fernando', 'Votre publication', '', 'template5', '16-06-2024 10:17', '17185330215702552651718533021'),
(15, 2, 'SANOU', 'Arthur', 'Votre publication', '', 'template7', '09-06-2024 15:06', '171794559220481647861717945592'),
(12, 1, 'SANOU', 'Fernando', 'serieux la  dddeeed', '', 'template1', '02-06-2024 08:51', '17171161861212494041717116186');

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

DROP TABLE IF EXISTS `signalement`;
CREATE TABLE IF NOT EXISTS `signalement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `idVictim` int NOT NULL,
  `nomVictim` varchar(25) NOT NULL,
  `raison` text NOT NULL,
  `commentaire` text NOT NULL,
  `vueAdmin` varchar(10) NOT NULL DEFAULT 'false',
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`id`, `idAuteur`, `nomAuteur`, `idVictim`, `nomVictim`, `raison`, `commentaire`, `vueAdmin`, `date`) VALUES
(1, 2, 'SANOU', 1, 'SANOU', 'Suicide ou automutilation', 'il a se tue', 'true', '29/05/2024');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `type` varchar(30) NOT NULL,
  `mode` varchar(10) NOT NULL DEFAULT 'light',
  `number` int NOT NULL,
  `ville` text NOT NULL,
  `password` varchar(250) NOT NULL,
  `short` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `online` varchar(10) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `type`, `mode`, `number`, `ville`, `password`, `short`, `online`) VALUES
(1, 'SANOU', 'Fernando', 'fernandosanou2@gmail.com', 'Locataire', 'light', 60421373, 'Cotonou', '$2y$10$pmQnlynAmVHzbqZY6CYDB.BU/INCTtIjS48d0AKwyo9xTgdBAfiwa', '$2y$10$qmrk860637IwRLBcMDOzNerWOpHzyO9uRmTDDtrpywHtzty.J69g6', 'true'),
(2, 'SANOU', 'Arthur', 'fernandosanou@gmail.com', 'Proprietaire', 'light', 68218393, 'lokossa', '$2y$10$lcziajwqaK88GBcnZdJgcuqRhyX4gD.wndzwT7Sz6DXrYs/kZWoV6', '$2y$10$hMuoHX4oy08kxR9ZEx5W8OU53OZlStYgPNsCxVPCZJ0YCWH5FOlW.', 'true'),
(3, 'asus', 'asus', 'asus@gmail.com', 'Locataire', 'light', 56565656, 'asus', '$2y$10$SYxvLA86zv77vSXPSTRj8OFG1zDP9nRJ6LPU77xUknFyJ8JdgsI3a', '$2y$10$9kKXYo0RV6jia5NzhGYh7e8amDcrn4JmoJ3BmleEqbtY9udLUb9z', 'true'),
(5, 'azerty', 'azerty', 'azerty@gmail.com', 'Locataire', 'light', 0, 'azerty', '$2y$10$Qz3lwnLTkV0f6qalR3kJ/egW4ppXoeeZnEf.3823Lb2rrjaK3F3vK', '$2y$10$WHSFOnsNgdehWauph0qOEOKFt74hG4GJDfdKYmVTzGNep37PbKLpW', 'true'),
(8, 'kerol', 'chabi', 'freddy', '', 'light', 96054541, 'abomey', '$2y$10$ReYzI.Xw4Ne1OvYNUkPsYevxEBspFS4Ej.YANaPMVn8rdGAA3sGzG', '$2y$10$7a4A5oe09cYoD03Zzybwj.45vB6JM3qM1NuMi7S9zaOF/q9M63eBG', 'true');

-- --------------------------------------------------------

--
-- Structure de la table `view`
--

DROP TABLE IF EXISTS `view`;
CREATE TABLE IF NOT EXISTS `view` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idAuteur` int NOT NULL,
  `nomAuteur` text NOT NULL,
  `prenomAuteur` text NOT NULL,
  `view` text NOT NULL,
  `idPost` int NOT NULL,
  `specialId` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `view`
--

INSERT INTO `view` (`id`, `idAuteur`, `nomAuteur`, `prenomAuteur`, `view`, `idPost`, `specialId`, `date`) VALUES
(5, 2, 'SANOU', 'Arthur', 'true', 4, '17152738182896173561715273818', '09/05/2024 16:56'),
(6, 2, 'SANOU', 'Arthur', 'true', 4, '17152738182896173561715273818', '09/05/2024 16:56'),
(7, 2, 'SANOU', 'Arthur', 'true', 4, '17152738182896173561715273818', '09/05/2024 16:56'),
(8, 2, 'SANOU', 'Arthur', 'true', 4, '17152738182896173561715273818', '09/05/2024 16:56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
