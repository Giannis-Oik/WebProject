-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 12 Σεπ 2023 στις 18:21:22
-- Έκδοση διακομιστή: 10.4.28-MariaDB
-- Έκδοση PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `web_project`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tokens` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `monthly_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `password`, `email`, `tokens`, `score`, `monthly_score`) VALUES
(1, 'Giannis', 'Giannis1!', 'giannis@gmail.com', 0, 0, 0),
(2, 'Nikos', 'Nikos1!', 'nikos@gmail.com', 0, 0, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `awards`
--

CREATE TABLE `awards` (
  `awards_id` tinyint(4) NOT NULL DEFAULT 1,
  `tokens` int(11) DEFAULT 0,
  `made` tinyint(1) NOT NULL DEFAULT 0,
  `given` tinyint(1) NOT NULL DEFAULT 0
) ;

--
-- Άδειασμα δεδομένων του πίνακα `awards`
--

INSERT INTO `awards` (`awards_id`, `tokens`, `made`, `given`) VALUES
(1, 300, 0, 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `categories`
--

CREATE TABLE `categories` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
('662418cbd02e435280148dbb8892782a', 'Για κατοικίδια'),
('8e8117f7d9d64cf1a931a351eb15bd69', 'Προσωπική φροντίδα'),
('a8ac6be68b53443bbd93b229e2f9cd34', 'Ποτά - Αναψυκτικά'),
('ee0022e7b1b34eb2b834ea334cda52e7', 'Τρόφιμα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `subcategory`) VALUES
(774, 'Purina One Γατ/Φή Ξηρά Βοδ/Σιτ 800γρ', '662418cbd02e435280148dbb8892782a', '926262c303fe402a8542a5d5cf3ac7eb'),
(897, 'Purina Gold Gourmet Γατ/Φή Μους Ψάρι 85γρ', '662418cbd02e435280148dbb8892782a', '926262c303fe402a8542a5d5cf3ac7eb'),
(930, 'Friskies Γατ/Φή Πατέ Κοτ/Λαχ 400γρ', '662418cbd02e435280148dbb8892782a', '926262c303fe402a8542a5d5cf3ac7eb'),
(978, 'Μήλα Φουτζι Εγχ ', 'ee0022e7b1b34eb2b834ea334cda52e7', 'ea47cc6b2f6743169188da125e1f3761'),
(980, 'Πορτοκ Μερλίν - Λανε Λειτ- Ναβελ Λειτ Εγχ Χυμ Συσκ/Να', 'ee0022e7b1b34eb2b834ea334cda52e7', 'ea47cc6b2f6743169188da125e1f3761'),
(1018, 'Friskies Γατ/Φή Πατέ Μοσχάρι 400γρ', '662418cbd02e435280148dbb8892782a', '926262c303fe402a8542a5d5cf3ac7eb'),
(1060, 'Ντομάτες Εισ Α', 'ee0022e7b1b34eb2b834ea334cda52e7', '9bc82778d6b44152b303698e8f72c429'),
(1077, 'Coca Cola 250ml', 'a8ac6be68b53443bbd93b229e2f9cd34', '3010aca5cbdc401e8dfe1d39320a8d1a'),
(1110, 'Whiskas Γατ/Φή Πουλ Σε Σάλτσα 100γρ', '662418cbd02e435280148dbb8892782a', '926262c303fe402a8542a5d5cf3ac7eb'),
(1112, 'Κολοκυθάκια Εγχ Με Ανθό', 'ee0022e7b1b34eb2b834ea334cda52e7', '9bc82778d6b44152b303698e8f72c429'),
(1142, 'Μήλα Στάρκιν Χύμα', 'ee0022e7b1b34eb2b834ea334cda52e7', 'ea47cc6b2f6743169188da125e1f3761'),
(1152, 'Coca Cola 2Χ1,5λιτ', 'a8ac6be68b53443bbd93b229e2f9cd34', '3010aca5cbdc401e8dfe1d39320a8d1a'),
(1153, 'Sprite 6X330ml', 'a8ac6be68b53443bbd93b229e2f9cd34', '3010aca5cbdc401e8dfe1d39320a8d1a'),
(1178, 'Όλυμπος Φυσικός Χυμός Πορτοκάλι 1,5λιτ', 'a8ac6be68b53443bbd93b229e2f9cd34', '4f1993ca5bd244329abf1d59746315b8'),
(1201, 'Καρπούζια Μίνι Εγχ', 'ee0022e7b1b34eb2b834ea334cda52e7', 'ea47cc6b2f6743169188da125e1f3761'),
(1203, 'Frulite Φρουτοπoτό Πορτ/Βερικ 500ml', 'a8ac6be68b53443bbd93b229e2f9cd34', '4f1993ca5bd244329abf1d59746315b8'),
(1224, 'Κρεμμύδια Ξανθά Ξερά Εισ', 'ee0022e7b1b34eb2b834ea334cda52e7', '9bc82778d6b44152b303698e8f72c429'),
(1236, 'Ντομάτες Εγχ Υπαιθρ Β ', 'ee0022e7b1b34eb2b834ea334cda52e7', '9bc82778d6b44152b303698e8f72c429'),
(1260, 'Μπρόκολα Πράσινα Εγχ', 'ee0022e7b1b34eb2b834ea334cda52e7', '9bc82778d6b44152b303698e8f72c429'),
(1266, 'Cool Hellas Χυμός Πορτοκαλ Συμπ 1λιτ', 'a8ac6be68b53443bbd93b229e2f9cd34', '4f1993ca5bd244329abf1d59746315b8'),
(1305, 'Frulite Σαγκουίνι/Μανταρίνι 1λιτ', 'a8ac6be68b53443bbd93b229e2f9cd34', '4f1993ca5bd244329abf1d59746315b8'),
(1322, 'Fanta Πορτοκαλάδα 1,5λιτ', 'a8ac6be68b53443bbd93b229e2f9cd34', '3010aca5cbdc401e8dfe1d39320a8d1a'),
(1332, 'Tuborg Σόδα 330ml', 'a8ac6be68b53443bbd93b229e2f9cd34', '3010aca5cbdc401e8dfe1d39320a8d1a'),
(1336, 'Πορτοκ Μερλίν - Λανε Λειτ- Ναβελ Λειτ Κατ Α Εγχ Ε/Ζ', 'ee0022e7b1b34eb2b834ea334cda52e7', 'ea47cc6b2f6743169188da125e1f3761'),
(1337, 'Όλυμπος Φυσικός Χυμός Πορτοκάλι 1λιτ', 'a8ac6be68b53443bbd93b229e2f9cd34', '4f1993ca5bd244329abf1d59746315b8');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `name` varchar(255) NOT NULL,
  `shop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `shops`
--

INSERT INTO `shops` (`id`, `lat`, `lon`, `name`, `shop`) VALUES
(2, 38.28931, 21.7806567, 'The Mart', 'supermarket'),
(3, 38.2633511, 21.7434265, 'Lidl', 'supermarket'),
(4, 38.2952086, 21.7908028, 'Σουπερμάρκετ Ανδρικόπουλος', 'supermarket'),
(5, 38.2104365, 21.7642075, 'Σκλαβενίτης', 'supermarket'),
(6, 38.23553, 21.7622778, 'Papakos', 'convenience'),
(7, 38.2312926, 21.740082, 'Lidl', 'supermarket'),
(8, 38.3013087, 21.7814957, 'Σκλαβενίτης', 'supermarket'),
(9, 38.2596476, 21.7489662, 'Σκλαβενίτης', 'supermarket'),
(10, 38.2613806, 21.7436127, 'Ρουμελιώτης SUPER Market', 'supermarket'),
(11, 38.2585236, 21.741582, 'Σκλαβενίτης', 'supermarket'),
(12, 38.2323892, 21.7473265, 'My market', 'supermarket'),
(13, 38.2322376, 21.7257294, 'ΑΒ Βασιλόπουλος', 'supermarket'),
(14, 38.2644973, 21.7603629, 'Markoulas', 'supermarket'),
(15, 38.3067563, 21.8051332, 'Lidl', 'supermarket'),
(16, 38.2399863, 21.736371, 'Ανδρικόπουλος', 'supermarket'),
(17, 38.2364945, 21.7373409, 'Σκλαβενίτης', 'supermarket'),
(18, 38.2427052, 21.7342362, 'My Market', 'supermarket'),
(19, 38.2568618, 21.7396708, 'My market', 'supermarket'),
(20, 38.1951968, 21.7323293, 'Ανδρικόπουλος', 'supermarket'),
(21, 38.2565589, 21.7418506, 'ΑΒ ΒΑΣΙΛΟΠΟΥΛΟΣ', 'supermarket'),
(22, 38.2434859, 21.733285, 'Σκλαβενίτης', 'supermarket'),
(23, 38.2512732, 21.7423925, 'Kaponis', 'supermarket'),
(24, 38.2427963, 21.7302559, 'Ανδρικόπουλος', 'supermarket'),
(25, 38.2795377, 21.7667136, 'Carna', 'convenience'),
(26, 38.3052409, 21.7770011, 'Mini Market', 'convenience'),
(27, 38.2425794, 21.7296435, 'Kronos', 'supermarket'),
(28, 38.2585639, 21.7504681, 'Φίλιππας', 'convenience'),
(29, 38.2498065, 21.7363349, 'No supermarket', 'supermarket'),
(30, 38.2490852, 21.735128, 'Kiosk', 'convenience'),
(31, 38.2493169, 21.7349115, 'Kiosk', 'convenience'),
(32, 38.2489563, 21.7344427, 'Kiosk', 'convenience'),
(33, 38.2569875, 21.7413066, 'Kiosk', 'convenience'),
(34, 38.2561434, 21.7409531, 'Kiosk', 'convenience'),
(35, 38.2691937, 21.7481501, 'Ανδρικόπουλος - Supermarket', 'supermarket'),
(36, 38.2690963, 21.7497014, 'Σκλαβενίτης', 'supermarket'),
(37, 38.233827, 21.7251655, 'ENA food cash $ cary', 'supermarket'),
(38, 38.3277388, 21.8764222, 'Mini Market', 'convenience'),
(39, 38.2170935, 21.7357783, 'ΑΒ Βασιλόπουλος', 'supermarket'),
(40, 38.2160259, 21.7321204, 'Mini Market', 'convenience'),
(41, 38.2504514, 21.7396687, '3A', 'supermarket'),
(42, 38.2486316, 21.7389771, 'Spar', 'supermarket'),
(43, 38.2481545, 21.7383224, 'ΑΝΔΡΙΚΟΠΟΥΛΟΣ', 'supermarket'),
(44, 38.2429466, 21.7308044, 'ΑΝΔΡΙΚΟΠΟΥΛΟΣ', 'supermarket'),
(45, 38.2392836, 21.7265283, 'MyMarket', 'supermarket'),
(46, 38.2346622, 21.7253472, 'Ena Cash And Carry', 'supermarket'),
(47, 38.2358002, 21.7294915, 'ΚΡΟΝΟΣ - (Σκαγιοπουλείου)', 'supermarket'),
(48, 38.2379176, 21.7306406, 'Ανδρικόπουλος Super Market', 'supermarket'),
(49, 38.2375068, 21.7328984, '3Α Αράπης', 'supermarket'),
(50, 38.2361127, 21.733787, 'Γαλαξίας', 'supermarket'),
(51, 38.2360129, 21.7283123, 'Super Market Θεοδωρόπουλος', 'supermarket'),
(52, 38.2390442, 21.7340723, 'Super Market ΚΡΟΝΟΣ', 'supermarket'),
(53, 38.2601801, 21.7428703, 'Σκλαβενίτης', 'supermarket'),
(54, 38.2586424, 21.7460078, '3A ARAPIS', 'supermarket'),
(55, 38.2454669, 21.7355058, 'Masoutis', 'supermarket'),
(56, 38.24957, 21.7380288, 'ΑΒ Shop & Go', 'supermarket'),
(57, 38.2398789, 21.7455558, '3Α ΑΡΑΠΗΣ', 'supermarket'),
(58, 38.2554443, 21.7408745, 'Περίπτερο', 'convenience');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `subcategories`
--

CREATE TABLE `subcategories` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`) VALUES
('3010aca5cbdc401e8dfe1d39320a8d1a', 'Αναψυκτικά - Ενεργειακά Ποτά', 'a8ac6be68b53443bbd93b229e2f9cd34'),
('4f1993ca5bd244329abf1d59746315b8', 'Χυμοί', 'a8ac6be68b53443bbd93b229e2f9cd34'),
('926262c303fe402a8542a5d5cf3ac7eb', 'Pet shop/Τροφή γάτας', '662418cbd02e435280148dbb8892782a'),
('9bc82778d6b44152b303698e8f72c429', 'Φρέσκα/Λαχανικά', 'ee0022e7b1b34eb2b834ea334cda52e7'),
('ea47cc6b2f6743169188da125e1f3761', 'Φρέσκα/Φρούτα', 'ee0022e7b1b34eb2b834ea334cda52e7');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tokens` int(11) NOT NULL,
  `monthly_tokens` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `monthly_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `email`, `tokens`, `monthly_tokens`, `score`, `monthly_score`) VALUES
(1, 'User1', 'User12345!', 'user@gmail.com', 5000, 0, 2000, 0),
(2, 'User2', 'User12345!', 'user2@gmail.com', 4000, 0, 1500, 0),
(3, 'user3', 'User123456!', 'user3@gmail.com', 3000, 0, 1200, 0);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`awards_id`);

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catkey` (`category`),
  ADD KEY `subcatkey` (`subcategory`);

--
-- Ευρετήρια για πίνακα `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopkey` (`shop_id`),
  ADD KEY `productkey` (`product_id`),
  ADD KEY `userkey` (`user_id`);

--
-- Ευρετήρια για πίνακα `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT για πίνακα `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `catkey` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subcatkey` FOREIGN KEY (`subcategory`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `productkey` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopkey` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userkey` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
