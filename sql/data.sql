-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 09, 2023 at 03:57 PM
-- Server version: 10.10.2-MariaDB-1:10.10.2+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamecenterrr`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamelists`
--

CREATE TABLE `gamelists` (
  `gameListId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gamelists`
--

INSERT INTO `gamelists` (`gameListId`, `userId`, `name`, `description`) VALUES
(140, 21, 'My List', 'Top games'),
(144, 21, 'Test games', 'Simple test for the games'),
(146, 22, 'TestList', 'TO BUY'),
(147, 22, 'Another Test List', 'Collectors Edition');

-- --------------------------------------------------------

--
-- Table structure for table `gamelist_item`
--

CREATE TABLE `gamelist_item` (
  `gameListId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gamelist_item`
--

INSERT INTO `gamelist_item` (`gameListId`, `itemId`) VALUES
(140, 9),
(140, 16),
(144, 2),
(144, 7),
(144, 13),
(146, 7),
(146, 9),
(146, 11),
(146, 16),
(147, 1),
(147, 3),
(147, 4),
(147, 6),
(147, 8),
(147, 12),
(147, 15);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `title`, `creator`) VALUES
(1, 'Minecraft Collector\'s Edition', 'Mojang'),
(2, 'Rainbow 6 Siege', 'Ubisoft'),
(3, 'God Of War 4 Collector\'s Edition', 'Santa Monica Studios'),
(4, 'God Of War Ragnarok Collector\'s Edition', 'Santa Monica Studios'),
(5, 'The Division Hearthlands', 'Ubisoft'),
(6, 'FarCry6 Collector\'s Edition', 'Ubisoft'),
(7, 'Valorant', 'Riot Games'),
(8, 'Uncharted Collector\'s Edition', 'Naughty Dog'),
(9, 'Call Of Duty MW2', 'Activision'),
(10, 'Call Of Duty Modern Warfare', 'Activision'),
(11, 'Devil May Cry', 'Capcom'),
(12, 'Red Dead Redemption 2 Special', 'Rockstar'),
(13, 'Spider-Man Miles Morales', 'Sony Interactive Entertainment'),
(14, 'Horizon New Dawn', 'Guerrilla Games'),
(15, 'The Division Collector\'s Edition', 'Ubisoft'),
(16, 'Escape From Tarkov', 'Battle State Games');

-- --------------------------------------------------------

--
-- Table structure for table `mgames`
--

CREATE TABLE `mgames` (
  `itemId` int(11) NOT NULL,
  `mprice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mgames`
--

INSERT INTO `mgames` (`itemId`, `mprice`) VALUES
(1, 12),
(2, 32),
(5, 56),
(7, 60),
(9, 59),
(10, 12),
(15, 33),
(16, 90);

-- --------------------------------------------------------

--
-- Table structure for table `sgames`
--

CREATE TABLE `sgames` (
  `itemId` int(11) NOT NULL,
  `sprice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sgames`
--

INSERT INTO `sgames` (`itemId`, `sprice`) VALUES
(3, 45),
(4, 37),
(6, 49),
(8, 90),
(11, 9),
(12, 161),
(13, 92),
(14, 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`) VALUES
(21, 'Alex', '85f406a99fa14c0477cdc34d6e088770', 'alextest@test.com'),
(22, 'TestUser', 'e16b2ab8d12314bf4efbd6203906ea6c', 'testuser@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gamelists`
--
ALTER TABLE `gamelists`
  ADD PRIMARY KEY (`gameListId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `gamelist_item`
--
ALTER TABLE `gamelist_item`
  ADD PRIMARY KEY (`gameListId`,`itemId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `mgames`
--
ALTER TABLE `mgames`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `sgames`
--
ALTER TABLE `sgames`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gamelists`
--
ALTER TABLE `gamelists`
  MODIFY `gameListId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gamelists`
--
ALTER TABLE `gamelists`
  ADD CONSTRAINT `gamelists_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `gamelist_item`
--
ALTER TABLE `gamelist_item`
  ADD CONSTRAINT `gamelist_item_ibfk_1` FOREIGN KEY (`gameListId`) REFERENCES `gamelists` (`gameListId`),
  ADD CONSTRAINT `gamelist_item_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`);

--
-- Constraints for table `mgames`
--
ALTER TABLE `mgames`
  ADD CONSTRAINT `mgames_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`);

--
-- Constraints for table `sgames`
--
ALTER TABLE `sgames`
  ADD CONSTRAINT `sgames_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;