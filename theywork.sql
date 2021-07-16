-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 12:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theywork`
--
CREATE DATABASE IF NOT EXISTS `theywork` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `theywork`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `first_name`, `last_name`, `email`, `profession`, `cv`, `username`, `password`, `profile`, `entry_date`) VALUES
(1, 'Mufaro', 'Kaseke', 'mufarodarlington@gmail.com', 'Engineering', 'web-dev-course-guide.pdf', '$2y$10$p61fV81WwsVBkBHBYAoL1u9LlcFA9RAp6FlTrgv2U6fZ.bTCzHQZW', '$2y$10$.VPrvqNre1jSZlMUMSRsW.P.UFiGEm7Ny9UthGF8gk4aoG3Kazpqa', 'james-timothy-Kh3aTWwMH1I-unsplash.jpg', '2021-07-16 04:35:50'),
(2, 'Lorraine', 'Mafu', 'lomafu@gmail.com', 'Art', 'Data-Capture-Form.pdf', '$2y$10$GFiwaJikGu8klCLaoIlC5O9LoplKZTdjZL8NPATOgzrmYeknCmed.', '$2y$10$IMnJRPOZExXgjDyJOqeGJOBXo93rSfGgH0pcx2zwtzhZYoVXOSs.S', 'art-hauntington-jzY0KRJopEI-unsplash.jpg', '2021-07-16 04:42:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
