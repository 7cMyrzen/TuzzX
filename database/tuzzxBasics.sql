-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2025 at 11:13 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuzzx`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `ship_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ship_id` (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Class Tuzz', 'Une sélection de vaisseau entièrement validée par Tuzz l’Eblair et son équipe.'),
(2, 'Class Giant', 'Les vaisseaux les plus imposants que vous pourrez trouvez dans cette galaxie'),
(3, 'Class War', 'Les vaisseaux de professionnels pour les membres de Star Command, à utiliser avec précaution.'),
(4, 'Class Classic', 'Vaisseau utilisable au quotidien pour des déplacements de planètes en planètes et accessible pour tous.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `billing_address_id` int NOT NULL,
  `shipping_address_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `billing_address_id` (`billing_address_id`),
  KEY `shipping_address_id` (`shipping_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `ship_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `ship_id` (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ship_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text,
  `review_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

DROP TABLE IF EXISTS `ships`;
CREATE TABLE IF NOT EXISTS `ships` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `publication_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`id`, `name`, `description`, `price`, `image_path`, `publication_date`, `author_id`, `category_id`) VALUES
(1, 'StarTuzz', 'Regarde mont bau vèso, il è tro sublim OK ? STAR COMMAND MEU LA DONNE ME GEME PA OK', 99999999.99, 'public/uploads/ships/tuzz.jpg', '2035-05-09 12:00:57', 1, 1),
(2, 'Crimson Reaver', 'Le Crimson Reaver est un vaisseau de guerre sanglant, traînant la réputation d\'un tueur d’étoiles, dévastant tout sur son passage avec une redoutable puissance de feu.', 100000.00, 'public/uploads/ships/vaisseau1w.png', '2025-01-21 15:53:13', 8, 3),
(3, 'Lunar Speedster', 'Le Lunar Speedster est un petit vaisseau rapide et maniable, idéal pour des voyages courts ou des missions de reconnaissance dans des environnements lunaires ou planétaires.', 40000.00, 'public/uploads/ships/vaisseau1c.png', '2025-01-21 15:56:12', 7, 4),
(4, 'Exodus Titan', 'Un vaisseau massif conçu pour traverser les galaxies, l’Exodus Titan est une véritable forteresse mobile, capable de transporter une armée tout en résistant aux pires conditions spatiales.', 250000.00, 'public/uploads/ships/vaisseau1g.png', '2025-01-21 15:59:05', 10, 2),
(5, 'Thunderclash', 'Le Thunderclash est un vaisseau de guerre équipé de canons à énergie dévastateurs, capable de provoquer des explosions retentissantes dans l’espace.', 200000.00, 'public/uploads/ships/vaisseau2w.png', '2025-01-21 16:02:29', 8, 3),
(6, 'Starbound Leviathan', 'Le Starbound Leviathan est un vaisseau colossal de colonisation, capable d’embarquer des milliers de colons et d’établir des colonies dans les recoins les plus inexplorés de l\'univers.', 5000000.00, 'public/uploads/ships/vaisseau2g.png', '2025-01-21 16:08:33', 5, 2),
(7, 'Celestial Behemoth', 'Le Celestial Behemoth est un véritable titan spatial, conçu pour être une base flottante, avec une capacité d’accueil et une puissance de feu exceptionnelle.', 500000.00, 'public/uploads/ships/vaisseau3g.png', '2025-01-21 16:13:47', 6, 2),
(8, 'Aether Monarch', 'Le Aether Monarch est un vaisseau géant de commandement, équipé des meilleurs systèmes de navigation et de défense, servant de bastion flottant au cœur de l’espace lointain.', 700000.00, 'public/uploads/ships/vaisseau4g.jpg', '2025-01-21 16:17:16', 5, 2),
(9, 'Void Vanguard', 'Le Void Vanguard est un titan spatial de reconnaissance, équipé pour les explorations à long terme dans les zones les plus dangereuses de l\'univers.', 290000.00, 'public/uploads/ships/vaisseau5g.jpg', '2025-01-21 16:19:52', 15, 2),
(10, 'Nova Racer', 'Le Nova Racer est un vaisseau léger et élégant, taillé pour la vitesse, capable de traverser les champs d\'astéroïdes à des vitesses vertigineuses.', 35000.00, 'public/uploads/ships/vaisseau2c.png', '2025-01-21 16:21:18', 12, 4),
(11, 'Quantum Sprint', 'Le Quantum Sprint est un vaisseau de course équipé de moteurs quantiques, permettant des accélérations instantanées et des déplacements supersoniques dans tout l\'univers.', 20000.00, 'public/uploads/ships/vaisseau3c.png', '2025-01-21 16:23:38', 11, 4),
(12, 'Cosmic Hawk', 'Le Cosmic Hawk est un vaisseau de vitesse conçu pour glisser à travers l’espace avec une maniabilité exceptionnelle, parfait pour les courses et les missions secrètes.', 60000.00, 'public/uploads/ships/vaisseau4c.jpg', '2025-01-21 16:25:53', 12, 4),
(13, 'Solar Raptor', 'Le Solar Raptor est un vaisseau rapide comme l’éclair, utilisant l’énergie solaire pour se propulser à des vitesses incroyables dans tout le système solaire.', 15000.00, 'public/uploads/ships/vaisseau5c.jpg', '2025-01-21 16:28:05', 9, 4),
(14, 'Nebula Warden', 'Le Nebula Warden est un vaisseau de surveillance armé, dédié à protéger les territoires sensibles tout en surveillant les mouvements ennemis dans les nébuleuses.', 845000.00, 'public/uploads/ships/vaisseau3w.jpg', '2025-01-21 16:32:28', 8, 3),
(15, 'Shadowblade', 'Le Shadowblade est un vaisseau de guerre furtif, capable de se dissimuler dans l’ombre de l’espace et de frapper rapidement avec des armes de précision.', 154000.00, 'public/uploads/ships/vaisseau4w.jpg', '2025-01-21 16:37:37', 14, 3),
(16, 'Vigilance Strike', 'Le Vigilance Strike est un vaisseau de guerre hautement réactif, conçu pour frapper vite et avec précision avant de disparaître dans le vide spatial.', 456000.00, 'public/uploads/ships/vaisseau5w.jpg', '2025-01-21 16:39:26', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ships_wfv`
--

DROP TABLE IF EXISTS `ships_wfv`;
CREATE TABLE IF NOT EXISTS `ships_wfv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `publication_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ship_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ship_id` (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `profile_pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `balance`, `profile_pic`, `role`) VALUES
(1, 'Tuzz L\'Eblair', 'tuzz.eblair@starcommand.space', '$2y$10$uj1iUQOBxkYaCelx0wp7G.ebbtJJ0XVQ4H0h8kL3/aHctNWqJKtui', 99999999.99, 'uploads/profile_pics/tuzz.png', 'admin'),
(2, 'Commandant', 'commandant@starcommand.space', '$2y$10$DjpNC0YPwq/7ifP.zOGHU.oaZ4oxDe3GBRMKsdieHUIGW5sJfN.H.', 100000.00, 'uploads/profile_pics/commander.png', 'admin'),
(3, 'Zorg', 'zorglegoat@destrucstar.pew', '$2y$10$N.9boJMPlwQNceZuMCHq5ebFyJWbJ0npvYJeYqaKgPhgOcwPldCju', 666666.00, 'uploads/profile_pics/zurg.png', 'admin'),
(4, 'Sox', 'croquette@starcommand.space', '$2y$10$1zslhuxtMDKzGV6a1gQMTufiTrlwwxaUUG5ZaN1kPIPSw3/1CFvcK', 0.00, 'uploads/profile_pics/Sox.png', 'admin'),
(5, 'StarCommand', 'qgprincipal@starcommand.space', '$2y$10$aIkEbCrVifvus7W6IPs59efplBehqiANS7AlvjbdC.rHLR.KQG4FC', 0.00, 'uploads/profile_pics/star_command.png', 'admin'),
(6, 'MarchandGalactique', 'marchand.galactique@galaxiashop.fr', '$2y$10$x23zilwNsm15Oc.2LAOSL.nHEfWdLQK8uU5duJlON0bRM192ILj0i', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(7, 'AstroPort', 'astro.port@galaxiashop.fr', '$2y$10$3XS2/SU9yrv9GxiXIxqPkOBWG5yslJexiU/mYBFE6AJHHyN6/Pmcy', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(8, 'MarsOuCrève', 'mars.ou.creve@galaxiashop.fr', '$2y$10$z/VokpcfL64wTaFmYbVSGObpeCu7ZbxwITWfuHE6Qk3PARpEvpcvK', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(9, 'CapitaineObvious', 'capitaine.obvious@galaxiashop.fr', '$2y$10$8bP65oNg7iSMSXfwvYYaou67vX..85fRu8JIfbQtXRkrCctBxnN1C', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(10, 'AstéroïdeFou', 'asteroide.fou@galaxiashop.fr', '$2y$10$rSWNR3oUyMprcE3rS8uc3.ycXw1h6hABPAJiFXerzVsyhDiz8OBA.', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(11, 'ExplorateurLunaire', 'explorateur.lunaire@galaxiashop.fr', '$2y$10$6nBqsUtf8AnfRRBjHhoaXO8/J11cO.XeVI3SQqwDwKxnng7ahAX9O', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(12, 'PropulseurNova', 'propulseur.nova@galaxiashop.fr', '$2y$10$NbfksUMNp6oPhjCmZAAWVe0CWe5Zopga.dd83LenNn.9s21dNmG.C', 35000.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(13, 'MétéoreExpress', 'meteore.express@galaxiashop.fr', '$2y$10$0fWbO1/CtRImm0Fr26rv/uNOfR9pigByHDmWMMvhtRg5AFinX0LcC', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(14, 'CosmomouteCommerçant', 'cosmomoute.commercant@galaxiashop.fr', '$2y$10$Q3jfUqN4zUVpXsSyIYWcUOSYDMS/XnCrywFrLK2YS8Ri8VGjlgs3K', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(15, 'VendeurD’Étoiles', 'vendeur.etoiles@galaxiashop.fr', '$2y$10$r.vpafkLCjgcXnpV1pNJueN5/T/dcBHOJp4kSQ7qszdIBHsuk.rqK', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(16, 'ExplorateurDÉtoiles', 'explorateur.etoiles@galaxieconnecte.fr', '$2y$10$GIFPNHfn5OAsUOdD/.PhUupWbJ6ohztuYhZJczCT.hDUmJ7jH7xO.', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(17, 'VoyageurLunaire', 'voyageur.lunaire@cosmique.fr', '$2y$10$4fKf16WYsyD00WIJPI2BlOgXGFiwmytPEYCjFLOu8XkFzZnZt4MVy', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(18, 'PionnierCosmique', 'pionnier.cosmique@stellaire.net', '$2y$10$PaI8r1CAKGr6ZjgywaDNYe5adTbwvfdfEUrB0SSa9xW4VcBg5roU2', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(19, 'NavigateurGalactique', 'navigateur.galactique@spatial-explorer.fr', '$2y$10$qfOhk1FGJVyDUm6IqzYslOU3KCUG17MbY0IX64HtyrYTOE0loMXiu', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(20, 'PiloteAstral', 'pilote.astral@universconnect.fr', '$2y$10$VhJp5/1lHeVwAvHx.qRej.ncVkJdmFP5nCx2QoRCyhBPFsPLIw.5S', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(21, 'AstronauteCurieux', 'astronaute.curieux@explorationspatiale.fr', '$2y$10$8YD2/ethFk59SjHLKYGzye/7UXajF6UQpFDRz6aXMaJLP4azsy0.W', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(22, 'VagabondDesÉtoiles', 'vagabond.desetoiles@expeditiongalactique.fr', '$2y$10$yWDxQhvzDYYTBV865lVGCeZJlgieLJUI5jDJd8kV4jT8KYeImRSTu', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(23, 'CollecteurDeComètes', 'collecteur.cometes@cosmospirit.fr', '$2y$10$zXgcI2znt0qE5hWWW/dpyeuktuiISwWTeJlUtvGZ/H2lRn/QG7H4e', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(24, 'RoverIntergalactique', 'rover.intergalactique@missioninterstellaire.fr', '$2y$10$kBmcCyQ.8GE6lbhyAEUo4u1v1AvGXZhQn5N4/b/pc8NKl.RHBrKaq', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(25, 'ExplorateurDeLInfini', 'explorateur.infini@observationuniverselle.fr', '$2y$10$8pBPAmFRwqLsMrCw8/2Y3.xI7707JfqmEaBxW5pLxGW2QTx7IPRjG', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(26, 'AventurierLunaire', 'aventurier.lunaire@sejourspatiaux.fr', '$2y$10$5Zr6c0INwPyg9IAEQZZlmORu85A6WGzrM6DucvFvp3yMPStxUvGoC', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(27, 'VoyageurDuVide', 'voyageur.duvide@explorationsiderales.fr', '$2y$10$E65QxAfroEOpCYqDpUH3kuqdRvfe1LSGcmXR8PxLh02ZRGAWQpNgS', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(28, 'HérosDeLaVoieLactée', 'heros.voielactee@voyageintergalactique.fr', '$2y$10$CJJolXRdmTT8tEhHLj.obemT9NrfK.W6j4hlr084bh.ny9ZbinQA6', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(29, 'AcheteurDePlanètes', 'acheteur.planetes@explorationscosmiques.fr', '$2y$10$Ss7oj.WHN5C3zdoJucv10.qD7A6jwEJ2.oSb4OSJfcvQukUwF8r72', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user'),
(30, 'StellaireAcheteur', 'stellaire.acheteur@recherchegalactique.fr', '$2y$10$KmxcwN/S3QXdWsFSWxw9M.SiMw/jn3EOJcrBsmSdJghqxRbsQuCAO', 0.00, 'images/profile_pics/defaultUserPicture.jpeg', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`billing_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`shipping_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ships`
--
ALTER TABLE `ships`
  ADD CONSTRAINT `ships_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ships_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
