-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2016 at 05:33 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loadrecords`
--

-- --------------------------------------------------------

--
-- Table structure for table `grouptags`
--

CREATE TABLE `grouptags` (
  `gTag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grouptags`
--

INSERT INTO `grouptags` (`gTag`) VALUES
('NP'),
('VP'),
('NP-GENERIC');

-- --------------------------------------------------------

--
-- Table structure for table `spectags`
--

CREATE TABLE `spectags` (
  `specTag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spectags`
--

INSERT INTO `spectags` (`specTag`) VALUES
('NOUN'),
('VERB'),
('DET'),
('ADJ');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `raw_element` varchar(150) NOT NULL,
  `groupHead` varchar(150) NOT NULL,
  `groupTag` varchar(150) NOT NULL,
  `specTag` varchar(150) NOT NULL,
  `consTohead` varchar(150) NOT NULL,
  `merge` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `parent_id`, `raw_element`, `groupHead`, `groupTag`, `specTag`, `consTohead`, `merge`) VALUES
(1, 0, 'mourhafish', 'No', 'AD', '-ish -Porter', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp_relations`
--

CREATE TABLE `temp_relations` (
  `id` int(11) NOT NULL,
  `relation_source` varchar(150) NOT NULL,
  `rel_src_gtag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
