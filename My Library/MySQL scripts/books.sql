-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2022 at 03:41 PM
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
-- Database: `mylibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `sno` int(11) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_desc` varchar(255) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `sub_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`sno`, `book_title`, `book_desc`, `book_author`, `sub_date`) VALUES
(2, 'Warrior of the Light (Cover image may vary)', 'Warrior of the Light is a timeless and inspirational companion to The Alchemistâ€”an international bestseller that has beguiled millions of readers around the world. Every short passage invites us to live out our dreams, to embrace the uncertainty of life', 'Paulo Coelho', '2022-02-03 13:44:45'),
(4, 'Death in the Sunshine (The Retired Detectives Club', 'After a long career as a police officer, Moira hopes a move to a luxury retirement community will mean she can finally leave the detective work to the youngsters and focus on a quieter life. But it turns out The Homestead is far from paradise. When she di', 'Steph Broadribb', '2022-02-03 13:46:32'),
(5, 'The Astronaut and the Star', 'Astronaut Regina â€œReggieâ€ Hayes wants to be the first woman on the moonâ€”itâ€™s all sheâ€™s ever dreamed of. But after a PR disaster, Reggie is off the list for a lunar mission. To rehabilitate her reputation with NASA, she agrees to a different kind', 'Jen Comfort', '2022-02-03 13:47:33'),
(6, 'time in space', 'good book', 'rutumbara chakor', '2022-02-06 18:48:30'),
(7, 'rigveda', 'hisotry', 'rugved chakor', '2022-02-06 18:49:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
