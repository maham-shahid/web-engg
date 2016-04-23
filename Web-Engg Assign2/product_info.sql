-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2014 at 03:49 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE IF NOT EXISTS `product_info` (
  `Prod_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prod_Name` varchar(200) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Image` varchar(500) NOT NULL,
  PRIMARY KEY (`Prod_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`Prod_ID`, `Prod_Name`, `Category`, `Price`, `Quantity`, `Image`) VALUES
(1, 'Adobe Photoshop', 'Photo Editor', 250, 22, 'http://adobe.ly/1vFr8XJ'),
(2, 'Visual Studio 2013', 'Development', 100, 40, 'http://bit.ly/1zkyfBZ'),
(3, 'Adobe Lightroom', 'Photo Editor', 300, 8, 'http://bit.ly/1zkyHjQ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
