-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 11:56 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stwitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `stenden_messages`
--

CREATE TABLE `stenden_messages` (
  `msgId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `message` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stenden_messages`
--

INSERT INTO `stenden_messages` (`msgId`, `userId`, `message`) VALUES
(1, 27, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringill'),
(2, 29, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringill'),
(3, 27, ' testbericht'),
(4, 27, ' spam');

-- --------------------------------------------------------

--
-- Table structure for table `stenden_users`
--

CREATE TABLE `stenden_users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userPass` varchar(60) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userImagePath` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stenden_users`
--

INSERT INTO `stenden_users` (`userId`, `userName`, `userPass`, `userEmail`, `userImagePath`) VALUES
(27, 'testuser', '$2y$10$BP9R3F7zSSf7IYYBrS1OkOnF.NyPvrHELTG/iNG4AeNNmDSyWaW6q', 'test@test.nl', '1.jpg'),
(29, 'usertest', '$2y$10$nrGC1Toa1.E9Th2PJiVH8eHWc9.la6F0A7iw5WsuXWZ6XEmqkKqdq', 'test@tewst.nl', '2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stenden_messages`
--
ALTER TABLE `stenden_messages`
  ADD PRIMARY KEY (`msgId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `stenden_users`
--
ALTER TABLE `stenden_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stenden_messages`
--
ALTER TABLE `stenden_messages`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stenden_users`
--
ALTER TABLE `stenden_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `stenden_messages`
--
ALTER TABLE `stenden_messages`
  ADD CONSTRAINT `stenden_messages_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `stenden_users` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
