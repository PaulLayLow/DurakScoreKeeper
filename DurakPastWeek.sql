-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql2.njit.edu
-- Generation Time: Apr 23, 2017 at 08:14 PM
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
-- Table structure for table `DurakPastWeek`
--

CREATE TABLE IF NOT EXISTS `DurakPastWeek` (
`id` int(11) NOT NULL COMMENT 'ID of entry',
  `week` date NOT NULL COMMENT 'Last day of the week',
  `loser` varchar(256) NOT NULL COMMENT 'Name of loser',
  `percentage` float NOT NULL COMMENT 'What percentage they had'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Durak results per week' AUTO_INCREMENT=2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DurakPastWeek`
--
ALTER TABLE `DurakPastWeek`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DurakPastWeek`
--
ALTER TABLE `DurakPastWeek`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of entry',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
