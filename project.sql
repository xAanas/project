-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2015 at 05:59 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `titre`) VALUES
(1, 'ARCH'),
(2, 'FORM'),
(3, 'GDL'),
(4, 'GS'),
(5, 'IT'),
(6, 'MSYS'),
(7, 'R&D'),
(8, 'SUPP'),
(9, 'TCN');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `description`) VALUES
(1, 'Thalès', 'situé à paris'),
(2, 'Orange', NULL),
(3, 'Ooredoo', 'un nouveau operateur'),
(4, 'Talent', 'directeur adjoint Adel'),
(5, 'Vermeg', 'headquarter Lac'),
(6, 'Poulina', 'client temporaire'),
(7, 'urbaprod', 'en intra'),
(8, 'SOTUCOM', 'magic'),
(9, 'Sabrine', 'nouvelle '),
(10, 'TUCOGRA', 'en relation'),
(11, 'SVPVIDEIO', 'audioV'),
(12, 'Maestro', 'agro'),
(13, 'Gaucho', 'agro'),
(15, 'Delice', 'ex Danone'),
(16, 'GOSS site', 'nouveau');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `demande_id` int(11) NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dateCommentaire` datetime NOT NULL,
  `dateSuppression` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C18F1B3CFB88E14F` (`utilisateur_id`),
  KEY `IDX_C18F1B3C80E95E18` (`demande_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `utilisateur_id`, `demande_id`, `contenu`, `dateCommentaire`, `dateSuppression`) VALUES
(1, 1, 2, 'nous sommes là dessus ok', '2015-06-16 09:29:35', NULL),
(2, 1, 2, 'c secret', '2015-06-17 11:27:00', NULL),
(5, 1, 2, 'pas du tout', '2015-06-17 11:30:53', NULL),
(6, 1, 2, 'Non, non, je ne vais pas vous demander comment on obtient les badges secrets, ce serait trop facile, bien que je suis de l''avis de certains, qui disent que quelques indices pour guider les recherches seraient les bienvenus, car on a peu de chances de les trouver autrement que par le hasard je trouve...  Je me pose juste une petite question qui ne me semble pas avoir été soulevée ici. J''ai l''impression que plus je gagne de badges secrets, plus j''en ai qui restent à découvrir. Je m''explique : il me restait 9 badges secrets à découvrir, j''en ai découvert 1, puis on m''a indiqué qu''il m''en restait 11. Je viens d''en découvrir un autre, il m''en reste maintenant 12 à découvrir... Dois-je en déduire que certains badges secrets sont en quelque sorte la "suite" d''autres ?', '2015-06-17 11:42:59', NULL),
(7, 1, 2, 'J''ai l''impression que plus je gagne de badges secrets, plus j''en ai qui restent à découvrir. Je m''explique : il me restait 9 badges secrets à découvrir, j''en ai découvert 1, puis on m''a indiqué qu''il m''en restait 11. Je viens d''en découvrir un autre, il m''en reste maintenant 12 à découvrir...', '2015-06-22 10:41:38', NULL),
(8, 1, 2, 'essai changer etat avec commentaire', '2015-06-22 11:05:35', NULL),
(9, 1, 1, 'baddél état bel comment', '2015-06-22 11:06:22', NULL),
(10, 1, 2, 'salut', '2015-06-23 14:13:11', NULL),
(11, 1, 2, 'trah tawa', '2015-06-23 14:21:59', NULL),
(12, 3, 1, 'okkk', '2015-06-23 14:53:50', NULL),
(13, 3, 1, 'trah', '2015-06-23 14:55:33', NULL),
(14, 3, 1, 'go go go', '2015-06-23 14:56:31', NULL),
(15, 3, 1, 'aaaaaaaaaa', '2015-06-23 14:57:27', NULL),
(16, 1, 2, 'echoo', '2015-07-02 10:57:27', NULL),
(17, 1, 2, 'tawaa', '2015-07-02 11:21:09', NULL),
(18, 1, 1, 'anas.', '2015-07-02 11:22:47', NULL),
(19, 1, 1, ' anas...', '2015-07-02 11:23:07', NULL),
(20, 1, 1, 'doncc', '2015-07-02 11:49:12', NULL),
(21, 1, 1, 'donc', '2015-07-02 11:49:58', NULL),
(22, 1, 1, 'eyyy', '2015-07-02 11:51:52', NULL),
(23, 4, 2, 'mriguél', '2015-07-02 12:48:50', NULL),
(24, 1, 1, 'choo', '2015-07-06 11:59:05', NULL),
(25, 1, 1, 'lll', '2015-07-06 12:04:45', NULL),
(26, 1, 1, 'aaaa', '2015-07-06 12:05:25', NULL),
(27, 1, 1, 'ffff', '2015-07-06 12:09:09', NULL),
(28, 1, 1, 'hhhh', '2015-07-06 12:09:48', NULL),
(29, 1, 1, 'iiii', '2015-07-06 12:13:47', NULL),
(30, 1, 3, 'How to position the popover - top | bottom | left | right | auto.\nWhen "auto" is specified', '2015-07-13 10:57:01', NULL),
(31, 1, 3, 'it will dynamically reorient the popover. For example, if placement is "auto left"', '2015-07-13 10:58:27', NULL),
(32, 1, 3, 'If a selector is provided, popover objects will be delegated to the specified targets. In practice, this is used to enable dynamic HTML ', '2015-07-13 11:00:12', NULL),
(33, 1, 3, 'content to have popovers added. See this and an informative example.', '2015-07-13 12:01:25', NULL),
(34, 4, 3, 'ok', '2015-07-17 17:32:31', NULL),
(35, 4, 3, 'bien fait', '2015-07-19 23:18:47', NULL),
(36, 4, 3, 'How popover is triggered - click | hover | focus | manual. You may pass multiple triggers; separate them with a space', '2015-07-19 23:19:21', NULL),
(37, 1, 2, 'et pour ça ?', '2015-07-27 17:21:46', NULL),
(38, 4, 1, 'alors ?', '2015-07-28 11:29:09', NULL),
(39, 4, 2, 'bienn', '2015-07-28 11:29:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE IF NOT EXISTS `demandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `sites_id` int(11) NOT NULL,
  `autres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detailsMissionOne` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detailsMissionTwo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detailsMissionThree` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateLimite` datetime NOT NULL,
  `lien` longtext COLLATE utf8_unicode_ci,
  `jaime` int(11) NOT NULL,
  `jeNaimePas` int(11) NOT NULL,
  `niveauUrgence` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `confidentialite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `docGdl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `envoiePrevuLe` datetime DEFAULT NULL,
  `mettreEnCopie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datePosteDemande` datetime NOT NULL,
  `dateDernierMiseAJour` datetime NOT NULL,
  `accueil` int(11) NOT NULL,
  `auNomDe_id` int(11) DEFAULT NULL,
  `missionOne_id` int(11) DEFAULT NULL,
  `missionTwo_id` int(11) DEFAULT NULL,
  `missionThree_id` int(11) DEFAULT NULL,
  `dateLivraison` datetime DEFAULT NULL,
  `client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chefdeproject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `potentielfacturation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_44E26EEDFB88E14F` (`utilisateur_id`),
  KEY `IDX_44E26EEDAA93946F` (`auNomDe_id`),
  KEY `IDX_44E26EED7838E496` (`sites_id`),
  KEY `IDX_44E26EEDE6987884` (`missionOne_id`),
  KEY `IDX_44E26EED8DC49F4B` (`missionTwo_id`),
  KEY `IDX_44E26EED6BA31A03` (`missionThree_id`),
  KEY `IDX_44E26EEDBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `demandes`
--

INSERT INTO `demandes` (`id`, `utilisateur_id`, `sites_id`, `autres`, `detailsMissionOne`, `detailsMissionTwo`, `detailsMissionThree`, `dateLimite`, `lien`, `jaime`, `jeNaimePas`, `niveauUrgence`, `etat`, `confidentialite`, `docGdl`, `envoiePrevuLe`, `mettreEnCopie`, `datePosteDemande`, `dateDernierMiseAJour`, `accueil`, `auNomDe_id`, `missionOne_id`, `missionTwo_id`, `missionThree_id`, `dateLivraison`, `client`, `chefdeproject`, `potentielfacturation`, `categorie_id`) VALUES
(1, 1, 5, 'bachtorann', 'vray et exterieur', 'spacio en entier', 'capacitaire générale et vitre', '2015-06-24 00:00:00', NULL, 1, 1, 'urgente', 'Livrée', 'Haute', NULL, '2015-06-25 00:00:00', NULL, '2015-06-15 17:00:08', '2015-06-29 10:30:26', 1, 2, 3, 2, 4, '2015-06-29 10:30:26', NULL, NULL, NULL, NULL),
(2, 1, 5, 'rien a ajouter', 'vray et exterieur', 'spacio en entier', 'capacitaire générale et vitre', '2015-06-24 00:00:00', NULL, 2, 1, 'urgente', 'En cour', 'Normale', NULL, '2015-06-25 00:00:00', NULL, '2015-06-15 17:01:22', '2015-07-27 18:31:29', 1, 2, 3, 2, 4, NULL, NULL, NULL, NULL, NULL),
(3, 1, 6, 'c''est comme d''habitude', 'Une image est une représentation visuelle,', 'Une des plus anciennes définitions de l''image est celle donnée par Platon', 'Le mot image en français vient du latin imago', '2015-08-20 00:00:00', 'https://fr.wikipedia.org/wiki/Image', 1, 0, 'ordinaire', 'Annulée', 'Normale', 'DWG', '2015-07-31 00:00:00', 'aymen@gmail.com', '2015-07-08 10:37:56', '2015-07-17 17:37:31', 1, 2, 1, 3, 4, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire_id` int(11) DEFAULT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6FEBD6FDBA9CD190` (`commentaire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fichiers`
--

INSERT INTO `fichiers` (`id`, `commentaire_id`, `lien`) VALUES
(1, 2, '1ecf74e2e2bfc2685f79b1db028f8b9083e42c38.png'),
(2, 5, NULL),
(3, 6, 'a4dedb30de268f5899391ace625a0100e92aaf00.jpeg'),
(4, 6, '0d4ec3e02a3a7820de21a78d9ba63f080515ffd5.jpeg'),
(5, 7, '8f1cc7ba4d40a999cf9e00808d91feaaee6a5200.jpeg'),
(6, 7, '7e21aa98ce431ce955ec5c8016f4bb56ff4e5885.jpeg'),
(7, 7, '5d0981792b2a0d5dc7b2925a457564ffc57980c4.jpeg'),
(8, 8, NULL),
(9, 9, NULL),
(10, 10, NULL),
(11, 11, NULL),
(12, 12, NULL),
(13, 13, NULL),
(14, 14, NULL),
(15, 15, NULL),
(16, 37, '5a3da80b7b04283261a1feff7edfc8fd34047193.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `prenom`, `nom`) VALUES
(1, 'Anas', 'anas', 'anasbena07@gmail.com', 'anasbena07@gmail.com', 1, 's4rbvi1ob6og44gg80ww440scsc0ow0', 'wOnCJP83u6zVzHANqJCtPkEsfvyVQ94FfFdnWT5hd0Xyf9rg0hO9bCN3YRpUc42T2qhzj6F7CP3KVHJaqriT4A==', '2015-07-28 11:29:25', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'anas', 'ben haj ali'),
(2, 'Hamza', 'hamza', 'hamza.beyni@gmail.com', 'hamza.beyni@gmail.com', 1, '9s4rzvn19zk8kgg4kocgc4ksowkc0wo', 'IHe8m4vYvnyf52pav90d5tMEkMW7PiBcZ5smECLDeH5DQQEAbDf87ktHyYcVN/SAJAoE71U7veFaEWb4S+0Xcg==', '2015-07-27 17:26:33', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Hamza', 'Beyni'),
(3, 'Aymen', 'aymen', 'aymen@gmail.com', 'aymen@gmail.com', 1, 'eerltgvvwfcok84g8kcsgk8cgc4cggo', 'Bd9b2xczGD/ePrlwB7Q3Un52JuEJ4NqYqgbpzbXKkZFgbce5TIExaFMZ5C2WEzGRFtHtXWhso/ArRQqe7nzRaQ==', '2015-07-17 17:46:31', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'Ayme', 'ELLOUZE'),
(4, 'mariem', 'mariem', 'mariem@gmail.com', 'mariem@gmail.com', 1, 'g1xe4h5bp5w08owcg8gc0cg8skwcksk', '4U0IGNW64ARYa4YNLj7Q76wr7yKRlwlp/HYAb3hK+trrsiPr3nY1a4ENyNcmDIZ6ytbdmwRqOCzSObSxG9pyaA==', '2015-07-28 11:29:00', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Mariem', 'Nfaiedh');

-- --------------------------------------------------------

--
-- Table structure for table `jaime`
--

CREATE TABLE IF NOT EXISTS `jaime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur` int(11) NOT NULL,
  `demande` int(11) NOT NULL,
  `jaime` int(11) NOT NULL,
  `jaimepas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jaime`
--

INSERT INTO `jaime` (`id`, `utilisateur`, `demande`, `jaime`, `jaimepas`) VALUES
(1, 1, 1, 0, 1),
(2, 1, 2, 1, 0),
(3, 4, 2, 1, 0),
(4, 3, 1, 1, 0),
(5, 3, 2, 0, 1),
(6, 1, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `titre`, `description`) VALUES
(1, 'Nettoyage de fonds de plan', NULL),
(2, '3D SPACIO', NULL),
(3, '3D VRAY', NULL),
(4, 'Capacitaire détaillé', NULL),
(5, 'Capacitaire général', NULL),
(6, 'Implantation mobilier', NULL),
(8, 'Pastilles indiquant le nombre de postes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acteur_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `enable` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `dateNotification` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D37EFB26DA6F574A` (`acteur_id`),
  KEY `IDX_D37EFB2638B217A7` (`publication_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=133 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `acteur_id`, `publication_id`, `contenu`, `enable`, `utilisateur`, `dateNotification`) VALUES
(1, 1, 1, 'Anas a envoyé une nouvelle demande .', 0, 1, '2015-06-15 17:00:09'),
(2, 1, 1, 'Anas a envoyé une nouvelle demande .', 0, 2, '2015-06-15 17:00:09'),
(3, 1, 2, 'Anas a envoyé une nouvelle demande .', 0, 1, '2015-06-15 17:01:22'),
(4, 1, 2, 'Anas a envoyé une nouvelle demande .', 0, 2, '2015-06-15 17:01:22'),
(5, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-16 09:29:35'),
(6, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-16 09:29:35'),
(7, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-17 11:30:53'),
(8, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-17 11:30:53'),
(9, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-06-17 11:30:54'),
(10, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-06-17 11:30:54'),
(11, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-17 11:42:59'),
(12, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-17 11:42:59'),
(13, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-06-17 11:42:59'),
(14, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-06-17 11:42:59'),
(15, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-22 10:41:38'),
(16, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-22 10:41:38'),
(17, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-06-22 10:41:38'),
(18, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-06-22 10:41:38'),
(19, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-22 11:05:35'),
(20, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-22 11:05:35'),
(21, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-06-22 11:05:35'),
(22, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-06-22 11:05:35'),
(23, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-06-22 11:06:22'),
(24, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-06-22 11:06:22'),
(25, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-06-22 11:06:22'),
(26, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-06-22 11:06:22'),
(27, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-23 14:13:11'),
(28, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-23 14:13:11'),
(29, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-06-23 14:13:11'),
(30, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-06-23 14:13:11'),
(31, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-06-23 14:21:59'),
(32, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-06-23 14:21:59'),
(33, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-06-23 14:21:59'),
(34, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-06-23 14:21:59'),
(35, 3, 1, 'Aymen a commenté la demande numero 1 de Orange', 0, 1, '2015-06-23 14:56:31'),
(36, 3, 1, 'Aymen a commenté la demande numero 1 de Orange', 0, 2, '2015-06-23 14:56:31'),
(37, 3, 1, 'Aymen a commenté la demande numero 1 de Orange', 0, 3, '2015-06-23 14:56:31'),
(38, 3, 1, 'Aymen a commenté la demande numero 1 de Orange', 0, 4, '2015-06-23 14:56:32'),
(39, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-07-02 10:57:27'),
(40, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-07-02 10:57:27'),
(41, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-07-02 10:57:27'),
(42, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-07-02 10:57:27'),
(43, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 1, '2015-07-02 11:21:09'),
(44, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 2, '2015-07-02 11:21:09'),
(45, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 3, '2015-07-02 11:21:09'),
(46, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 0, 4, '2015-07-02 11:21:09'),
(47, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-02 11:22:47'),
(48, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-02 11:22:47'),
(49, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-02 11:22:47'),
(50, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-02 11:22:48'),
(51, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-02 11:23:07'),
(52, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-02 11:23:07'),
(53, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-02 11:23:07'),
(54, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-02 11:23:07'),
(55, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-02 11:49:12'),
(56, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-02 11:49:12'),
(57, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-02 11:49:12'),
(58, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-02 11:49:12'),
(59, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-02 11:49:58'),
(60, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-02 11:49:58'),
(61, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-02 11:49:58'),
(62, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-02 11:49:58'),
(63, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-02 11:51:52'),
(64, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-02 11:51:52'),
(65, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-02 11:51:52'),
(66, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-02 11:51:52'),
(67, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 0, 1, '2015-07-02 12:48:50'),
(68, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 0, 2, '2015-07-02 12:48:50'),
(69, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 0, 3, '2015-07-02 12:48:50'),
(70, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 0, 4, '2015-07-02 12:48:50'),
(71, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-06 11:59:05'),
(72, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-06 11:59:05'),
(73, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-06 11:59:05'),
(74, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-06 11:59:05'),
(75, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-06 12:04:45'),
(76, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-06 12:04:45'),
(77, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-06 12:04:45'),
(78, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-06 12:04:45'),
(79, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-06 12:05:25'),
(80, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-06 12:05:25'),
(81, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-06 12:05:25'),
(82, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-06 12:05:25'),
(83, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-06 12:09:09'),
(84, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-06 12:09:09'),
(85, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-06 12:09:09'),
(86, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-06 12:09:09'),
(87, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-06 12:09:48'),
(88, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-06 12:09:48'),
(89, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-06 12:09:48'),
(90, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-06 12:09:48'),
(91, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 1, '2015-07-06 12:13:47'),
(92, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 2, '2015-07-06 12:13:47'),
(93, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 3, '2015-07-06 12:13:47'),
(94, 1, 1, 'Anas a commenté la demande numero 1 de Orange', 0, 4, '2015-07-06 12:13:48'),
(95, 1, 3, 'Anas a envoyé une nouvelle demande .', 0, 1, '2015-07-08 10:37:57'),
(96, 1, 3, 'Anas a envoyé une nouvelle demande .', 0, 2, '2015-07-08 10:37:57'),
(97, 1, 3, 'Anas a envoyé une nouvelle demande .', 0, 3, '2015-07-08 10:37:57'),
(98, 1, 3, 'Anas a envoyé une nouvelle demande .', 0, 4, '2015-07-08 10:37:57'),
(99, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-13 10:57:01'),
(100, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-13 10:57:02'),
(101, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-13 10:57:02'),
(102, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 4, '2015-07-13 10:57:02'),
(103, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-13 10:58:27'),
(104, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-13 10:58:27'),
(105, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-13 10:58:27'),
(106, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 4, '2015-07-13 10:58:27'),
(107, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-13 11:00:12'),
(108, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-13 11:00:12'),
(109, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-13 11:00:12'),
(110, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 4, '2015-07-13 11:00:12'),
(111, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-13 12:01:25'),
(112, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-13 12:01:25'),
(113, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-13 12:01:25'),
(114, 1, 3, 'Anas a commenté la demande numero 3 de Thalès', 0, 4, '2015-07-13 12:01:25'),
(115, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-17 17:32:31'),
(116, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-17 17:32:31'),
(117, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-17 17:32:31'),
(118, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-19 23:18:47'),
(119, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-19 23:18:47'),
(120, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-19 23:18:47'),
(121, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 1, '2015-07-19 23:19:21'),
(122, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 2, '2015-07-19 23:19:21'),
(123, 4, 3, 'mariem a commenté la demande numero 3 de Thalès', 0, 3, '2015-07-19 23:19:21'),
(124, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 1, 2, '2015-07-27 17:21:47'),
(125, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 1, 3, '2015-07-27 17:21:47'),
(126, 1, 2, 'Anas a commenté la demande numero 2 de Orange', 1, 4, '2015-07-27 17:21:48'),
(127, 4, 1, 'mariem a commenté la demande numero 1 de Orange', 1, 1, '2015-07-28 11:29:09'),
(128, 4, 1, 'mariem a commenté la demande numero 1 de Orange', 1, 2, '2015-07-28 11:29:09'),
(129, 4, 1, 'mariem a commenté la demande numero 1 de Orange', 1, 3, '2015-07-28 11:29:09'),
(130, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 1, 1, '2015-07-28 11:29:14'),
(131, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 1, 2, '2015-07-28 11:29:14'),
(132, 4, 2, 'mariem a commenté la demande numero 2 de Orange', 1, 3, '2015-07-28 11:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clients_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7DC18567AB014612` (`clients_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `clients_id`, `nom`, `adresse`, `description`) VALUES
(1, 1, 'site 1', 'paris', NULL),
(4, 1, 'site 3', 'nice', NULL),
(5, 2, 'site 51', 'lyon sud west', 'c''est un nouveau site'),
(6, 1, 'site Alsas', 'Nante, 52 Est', 'c''est un nouveau site'),
(7, 11, 'Fatyilss', 'yasmine Palas', 'nooon');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_C18F1B3C80E95E18` FOREIGN KEY (`demande_id`) REFERENCES `demandes` (`id`),
  ADD CONSTRAINT `FK_C18F1B3CFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `FK_44E26EEDBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_44E26EED6BA31A03` FOREIGN KEY (`missionThree_id`) REFERENCES `missions` (`id`),
  ADD CONSTRAINT `FK_44E26EED7838E496` FOREIGN KEY (`sites_id`) REFERENCES `sites` (`id`),
  ADD CONSTRAINT `FK_44E26EED8DC49F4B` FOREIGN KEY (`missionTwo_id`) REFERENCES `missions` (`id`),
  ADD CONSTRAINT `FK_44E26EEDAA93946F` FOREIGN KEY (`auNomDe_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_44E26EEDE6987884` FOREIGN KEY (`missionOne_id`) REFERENCES `missions` (`id`),
  ADD CONSTRAINT `FK_44E26EEDFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `fichiers`
--
ALTER TABLE `fichiers`
  ADD CONSTRAINT `FK_6FEBD6FDBA9CD190` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `FK_D37EFB2638B217A7` FOREIGN KEY (`publication_id`) REFERENCES `demandes` (`id`),
  ADD CONSTRAINT `FK_D37EFB26DA6F574A` FOREIGN KEY (`acteur_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `FK_7DC18567AB014612` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
