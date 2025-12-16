-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 déc. 2025 à 20:00
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kodpwomo`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `category` varchar(70) NOT NULL,
  `message` text NOT NULL,
  `rating` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(70) NOT NULL,
  `user_id` varchar(70) NOT NULL,
  `allow` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `title`, `category`, `message`, `rating`, `date`, `image`, `user_id`, `allow`) VALUES
(1, 'Nouvelle fonctionnalité : Suivi en temps réel', 'actualite', 'Nous sommes ravis d\'annoncer le lancement de notre nouvelle fonctionnalité de suivi en temps réel ! Vous pouvez maintenant suivre votre commande du début à la fin avec des notifications instantanées. Cette mise à jour améliore considérablement l\'expérience utilisateur et la transparence de nos services.', 0, '2025-12-01 10:30:00', '', 'admin', 1),
(2, 'Comment passer votre première commande', 'guide', 'Guide complet pour les nouveaux utilisateurs. Étape 1 : Créez votre compte avec votre email universitaire. Étape 2 : Parcourez les produits disponibles dans votre université. Étape 3 : Ajoutez vos articles au panier. Étape 4 : Choisissez votre lieu de livraison. Étape 5 : Confirmez et suivez votre commande !', 0, '2025-11-28 14:15:00', '', 'admin', 1),
(3, 'Excellent service de livraison !', 'avis', 'J\'ai commandé hier soir et j\'ai reçu ma commande ce matin. L\'agent était très professionnel et courtois. Les produits sont arrivés en parfait état. Je recommande vivement kodPwomo à tous les étudiants !', 5, '2025-12-02 16:45:00', '', 'USR123', 1),
(4, 'Très satisfait du service', 'avis', 'Première fois que j\'utilise kodPwomo et je suis agréablement surpris. La plateforme est intuitive, les prix sont corrects et la livraison est rapide. Quelques petites suggestions : ajouter plus de choix de produits et peut-être une option de livraison express.', 4, '2025-12-01 09:20:00', '', 'USR456', 1),
(5, 'Top 5 Agents du Mois - Novembre 2025', 'top', 'Félicitations à nos meilleurs agents du mois de novembre ! ?\n\n1. Agent Patrick - 156 livraisons\n2. Agent Sophie - 142 livraisons\n3. Agent David - 138 livraisons\n4. Agent Lisa - 125 livraisons\n5. Agent Marc - 118 livraisons\n\nMerci pour votre excellent travail et votre dévouement !', 0, '2025-12-01 08:00:00', '', 'admin', 1),
(6, 'Suggestion : Programme de fidélité', 'amelioration', 'Bonjour, je suggère la création d\'un programme de fidélité pour les clients réguliers. Par exemple, après 10 commandes, offrir une réduction ou une livraison gratuite. Cela encouragerait les étudiants à utiliser plus souvent la plateforme.', 0, '2025-11-30 11:30:00', '', 'USR789', 1),
(7, 'Ajouter un système de notation des produits', 'amelioration', 'Ce serait génial de pouvoir noter et commenter les produits après achat. Ça aiderait les autres étudiants à faire de meilleurs choix et ça permettrait aussi aux vendeurs d\'améliorer leurs offres.', 0, '2025-11-29 15:10:00', '', 'USR321', 1),
(8, 'Bon service mais quelques améliorations nécessaires', 'avis', 'Dans l\'ensemble, le service est bon. La livraison est généralement rapide et les agents sont sympas. Cependant, j\'ai remarqué que certains produits ne sont pas toujours disponibles alors qu\'ils apparaissent sur le site. Il faudrait améliorer la mise à jour du stock en temps réel.', 3, '2025-11-27 13:25:00', '', 'USR654', 1),
(9, 'livraison', 'amelioration', 'le prix des livraison affiche serait bien', 0, '2025-12-15 19:51:12', '', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 0),
(10, 'livraison', 'avis', 'pas mal jdonne 3', 3, '2025-12-15 19:53:17', '', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
