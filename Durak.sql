-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql2.njit.edu
-- Generation Time: Apr 23, 2017 at 08:13 PM
-- Server version: 5.5.29-log
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pml8`
--

-- --------------------------------------------------------

--
-- Table structure for table `Durak`
--

CREATE TABLE IF NOT EXISTS `Durak` (
`id` int(11) NOT NULL COMMENT 'ID of player',
  `name` varchar(256) NOT NULL COMMENT 'Name of player',
  `numLosses` int(11) NOT NULL COMMENT 'Number of losses',
  `numRounds` int(11) NOT NULL COMMENT 'Number of rounds played'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Durak' AUTO_INCREMENT=8 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Durak`
--
ALTER TABLE `Durak`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Durak`
--
ALTER TABLE `Durak`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of player',AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
