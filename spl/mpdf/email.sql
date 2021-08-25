-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2020 at 05:42 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `memo` varchar(50) NOT NULL,
  `pdf` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`memo`, `pdf`) VALUES
('snfkss', 'jsncsns'),
('৯৪০৭৭১', '৯৪০৭৭১pdf'),
('১৬২৮১৯', '১৬২৮১৯.pdf'),
('২৫৮৪৫২', '২৫৮৪৫২.pdf'),
('২৭৬০১২', '২৭৬০১২.pdf'),
('৭৬২০১৫', '৭৬২০১৫.pdf'),
('৫৯৫৩৯৭', '৫৯৫৩৯৭.pdf'),
('', '.pdf'),
('', '.pdf'),
('৫২৯৯৩৫', '৫২৯৯৩৫.pdf'),
('৯৯৫৩৭৫', '৯৯৫৩৭৫.pdf'),
('৫০৭৩৬৮', '৫০৭৩৬৮.pdf'),
('৮৪৭৯৬১', '৮৪৭৯৬১.pdf'),
('', '.pdf'),
('২৪৫৪১৮', '২৪৫৪১৮.pdf'),
('৮৪৯১৩০', '৮৪৯১৩০.pdf'),
('৫৫৭৫৮১', '৫৫৭৫৮১.pdf'),
('৪৪৪৮২৯', '৪৪৪৮২৯.pdf'),
('২৯২৮১৪', '২৯২৮১৪.pdf'),
('', '.pdf'),
('১৪২৩০১', '১৪২৩০১.pdf'),
('৯৬৮৬৫৫', '৯৬৮৬৫৫.pdf'),
('৮৯৯২১৯', '৮৯৯২১৯.pdf'),
('৩৩৯৮৬৫', '৩৩৯৮৬৫.pdf'),
('৬৮৯২৩৮', '৬৮৯২৩৮.pdf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
