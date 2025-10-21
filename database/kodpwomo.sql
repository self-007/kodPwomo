-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2025 at 09:46 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kodpwomo`
--

-- --------------------------------------------------------

--
-- Table structure for table `black_list`
--

DROP TABLE IF EXISTS `black_list`;
CREATE TABLE IF NOT EXISTS `black_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(70) NOT NULL,
  `refresh_token` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `black_list`
--

INSERT INTO `black_list` (`id`, `id_user`, `refresh_token`, `date`) VALUES
(1, 'USR001', 'old_refresh_token_jean_expired', '2025-09-10 15:30:00'),
(2, 'USR003', 'old_refresh_token_paul_logout', '2025-09-12 20:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `image` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'Nourriture', 'food.jpg'),
(2, 'Boissons', 'drinks.jpg'),
(3, 'Fournitures scolaires', 'supplies.jpg'),
(4, 'Vêtements', 'clothes.jpg'),
(5, 'Électronique', 'electronics.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_commande` varchar(45) NOT NULL,
  `id_agent` varchar(70) NOT NULL,
  `delivery_price` double NOT NULL,
  `note` int NOT NULL,
  `feedback` text NOT NULL,
  `status` varchar(45) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `id_commande`, `id_agent`, `delivery_price`, `note`, `feedback`, `status`, `date`) VALUES
(1, 'ORD_0303', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 50, 5, 'Livraison rapide et produit de qualité!', 'processing', '2025-09-16 12:30:00'),
(2, 'ORD_2001', 'USR002GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 70, 4, 'Bon service, quelques minutes de retard', 'completed', '2025-09-16 12:45:00'),
(3, 'ORD_0030', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 60, 5, 'Parfait! Agent très professionnel', 'completed', '2025-09-17 14:20:00'),
(4, 'ORD_4032', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 100, 3, 'Pizza un peu froide à l\'arrivée', 'completed', '2025-09-18 19:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(70) NOT NULL,
  `type` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(45) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `type`, `message`, `status`, `date`) VALUES
(1, 'USR001', 'commande', 'Votre commande #1 a été confirmée', 'read', '2025-09-16 11:00:00'),
(2, 'USR001', 'livraison', 'Votre commande #1 est en route', 'read', '2025-09-16 12:00:00'),
(3, 'USR001', 'livraison', 'Commande #1 livrée avec succès', 'read', '2025-09-16 12:30:00'),
(4, 'USR003', 'commande', 'Votre commande #3 a été confirmée', 'read', '2025-09-17 13:30:00'),
(5, 'USR002', 'agent', 'Nouvelle livraison assignée: Commande #6', 'unread', '2025-09-19 10:00:00'),
(6, 'USR001', 'promo', 'Offre spéciale: -20% sur tous les sandwichs!', 'unread', '2025-09-19 08:00:00'),
(7, 'USR003', 'commande', 'Votre commande #5 a été confirmée', 'read', '2025-09-18 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(45) NOT NULL,
  `id_user` varchar(70) NOT NULL,
  `id_product` int NOT NULL,
  `price` double NOT NULL,
  `qnt` int NOT NULL,
  `status` varchar(45) NOT NULL,
  `adresse_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `id_user`, `id_product`, `price`, `qnt`, `status`, `adresse_id`, `date`) VALUES
(1, 'ORD_0303', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 1, 2500, 2, '', 1, '2025-10-02 20:25:00'),
(2, 'ORD_0303', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 3, 1000, 1, '', 1, '2025-10-02 20:25:00'),
(3, 'ORD_0303', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 2, 4000, 1, '', 1, '2025-10-02 20:25:00'),
(4, 'ORD_0303', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 4, 1500, 3, '', 1, '2025-10-02 20:25:00'),
(5, 'ORD_2001', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 7, 6000, 1, '', 1, '2025-10-02 20:25:00'),
(6, 'ORD_2001', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 4, 500, 2, '', 1, '2025-10-02 20:25:00'),
(7, 'ORD_0030', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 6, 300, 5, '', 1, '2025-10-02 20:25:00'),
(8, 'ORD_4032', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 10, 3500, 1, '', 1, '2025-10-02 20:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_category` int NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(70) NOT NULL,
  `prices` double NOT NULL,
  `description` text NOT NULL,
  `id_university` int NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `picture`, `prices`, `description`, `id_university`, `stock`) VALUES
(1, 1, 'Sandwich Jambon-Fromage', 'image\\sandwich.jpeg', 2500, 'Délicieux sandwich avec jambon et fromage frais', 1, 6),
(2, 1, 'Riz au Poulet', 'image\\riz_poulet.jpeg', 4000, 'Riz parfumé avec morceaux de poulet grillé', 1, 9),
(3, 2, 'Coca-Cola 33cl', 'image\\coca.jpeg', 1000, 'Boisson gazeuse rafraîchissante', 1, 6),
(4, 2, 'Eau Minérale 50cl', 'image\\eau.jpeg', 500, 'Eau pure et rafraîchissante', 1, 3),
(5, 3, 'Cahier 200 pages', 'image\\cahier.jpeg', 1500, 'Cahier à spirale pour cours', 2, 9),
(6, 3, 'Stylo Bic Bleu', 'image\\stylo.png', 300, 'Stylo à bille de qualité', 2, 6),
(7, 1, 'Pizza Margherita', 'image\\pizza.jpeg', 6000, 'Pizza traditionnelle tomate-mozzarella', 3, 2),
(8, 4, 'T-shirt Uni', 'tshirt.jpg', 8000, 'T-shirt 100% coton, différentes couleurs', 1, 8),
(9, 5, 'Chargeur USB-C', 'chargeur.jpg', 3000, 'Chargeur rapide compatible Android', 2, 1),
(10, 1, 'Salade César', 'image\\salade.jpeg', 3500, 'Salade fraîche avec croûtons et parmesan', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salle_name` varchar(70) NOT NULL,
  `image` varchar(70) NOT NULL,
  `id_university` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id`, `salle_name`, `image`, `id_university`) VALUES
(1, 'Amphithéâtre A', 'amphi_a.jpg', 1),
(2, 'Salle 101', 'salle_101.jpg', 1),
(3, 'Laboratoire Info', 'lab_info.jpg', 2),
(4, 'Bibliothèque', 'biblio.jpg', 4),
(5, 'Cafétéria', 'cafeteria.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `Zone` varchar(70) NOT NULL,
  `image` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `Zone`, `image`) VALUES
(1, 'Université de Kinshasa', 'Kinshasa', 'image\\kinsasha.jpeg'),
(2, 'Université Pédagogique Nationale', 'Kinshasa', 'image\\pedagogie.jpeg'),
(3, 'Université de Lubumbashi', 'Lubumbashi', 'image\\lumubashi.jpeg'),
(4, 'Université Notre-Dame du Kasayi', 'Kananga', 'image\\kasayi.jpeg'),
(5, 'Institut Supérieur de Commerce', 'Kinshasa', 'image\\commerce.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `id_unique` varchar(300) NOT NULL,
  `otp` int NOT NULL,
  `otpExp` bigint NOT NULL,
  `finger_print` varchar(300) NOT NULL,
  `id_universite` int NOT NULL,
  `role` varchar(300) NOT NULL,
  `status` varchar(45) NOT NULL,
  `code` varchar(70) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `refresh_token` varchar(300) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `email`, `password`, `id_unique`, `otp`, `otpExp`, `finger_print`, `id_universite`, `role`, `status`, `code`, `date`, `refresh_token`, `is_verified`) VALUES
(1, 'Mukendi', 'Jean', 'jean.mukendi@unikin.ac.cd', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'USR001', 0, 0, 'fp_jean_123', 1, 'client', 'active', '', '2025-09-15 08:00:00', 'refresh_token_jean', 0),
(2, 'Kabongo', 'Marie', 'marie.kabongo@upn.ac.cd', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'USR002', 0, 0, 'fp_marie_456', 2, 'agent', 'active', '', '2025-09-14 10:30:00', 'refresh_token_marie', 0),
(3, 'Tshilobo', 'Paul', 'paul.tshilobo@unilu.ac.cd', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'USR003', 0, 0, 'fp_paul_789', 3, 'client', 'active', '', '2025-09-13 14:15:00', 'refresh_token_paul', 0),
(4, 'Kamanda', 'Grace', 'admin@kodpwomo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ADM001', 0, 0, 'fp_admin_000', 1, 'admin', 'active', '', '2025-09-10 09:00:00', 'refresh_token_admin', 0),
(5, 'Mbuyi', 'David', 'david.mbuyi@ndk.ac.cd', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'USR004', 0, 0, 'fp_david_111', 4, 'agent', 'active', '', '2025-09-12 16:45:00', 'refresh_token_david', 0),
(6, 'Bill James-sky Voltaire', 'Bill', 'voltairebilljamesky@gmail.com', '', 'GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy1', 0, 0, 'ZGF0YTppbWFnZS9wbmc7YmFzZTY0LGlW', 0, 'agent', 'active', '', '2025-09-29 19:36:03', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NTkxNzQ1NjMsImV4cCI6MTc2MDM4NDE2Mywic3ViIjoiR09PR0xFX2h3b2lQOW56Q2hiV2k3VENsUW5MV2xobEtxeTEiLCJyb2xlIjoidXNlciJ9.GMayOvj0XwMmst6pY6u5D8xgx99Fkbbs3uvNCCFlq60', 0),
(9, 'sky_Bill', 'exineau', 'billjamesskyv@gmail.com', '$2y$10$/9smStUcx2MK81SBKg4CduIrncqq18SXKNFeB8fqbNYFdjlux/sbG', 'USR68DAEF548DB8A5.07116066', 409126, 1759179630, '', 0, '', '', '', '2025-09-29 20:43:00', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NTkxNzg1ODAsImV4cCI6MTc2MDM4ODE4MCwic3ViIjoiVVNSNjhEQUVGNTQ4REI4QTUuMDcxMTYwNjYiLCJyb2xlIjoidXNlciJ9.jYBCDS9MKKP0GvjRfhsKNdoHu3jHVJDizJjkda0u4mo', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
