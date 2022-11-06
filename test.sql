-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 07:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `citycount` (IN `country` CHAR(3), OUT `cities` INT)  BEGIN
         SELECT COUNT(*) INTO cities FROM world.city
         WHERE CountryCode = country;
       END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ds_crud_categories`
--

CREATE TABLE `ds_crud_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ds_crud_categories`
--

INSERT INTO `ds_crud_categories` (`id`, `category`) VALUES
(1, 'Master Item'),
(2, 'Child Item'),
(3, 'Flock Item');

-- --------------------------------------------------------

--
-- Table structure for table `ds_crud_items`
--

CREATE TABLE `ds_crud_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_location` varchar(255) DEFAULT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ds_crud_items`
--

INSERT INTO `ds_crud_items` (`id`, `item_id`, `date_added`, `item_name`, `item_category`, `item_location`, `item_price`, `available`) VALUES
(0, '411b45823becd', '2022-11-06 00:00:00', 'item name 25', '1', '3', '58.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ds_crud_locations`
--

CREATE TABLE `ds_crud_locations` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ds_crud_locations`
--

INSERT INTO `ds_crud_locations` (`id`, `location`) VALUES
(1, 'Warehouse A'),
(2, 'Warehouse B'),
(3, 'Warehouse C');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
