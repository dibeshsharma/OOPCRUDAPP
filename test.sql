-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 11:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `citycount` (IN `country` CHAR(3), OUT `cities` INT)   BEGIN
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
(193, '53c49fe3ce954', '2022-06-26 00:00:00', 'item name 24', '3', '1', '88.00', 1),
(194, '80615650ec0df', '2022-06-10 00:00:00', 'item name 23', '1', '3', '55.00', 1),
(196, 'f29ab01f210c0', '2022-06-25 00:00:00', 'item name 24', '2', '2', '80.00', 0),
(198, '427b88f7b48fc', '2022-07-16 00:00:00', 'item name 23', '1', '2', '85.00', 0),
(202, '1aa19b51e017e', '2022-10-30 00:00:00', 'item name 23', '1', '1', '12.00', 0);

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

-- --------------------------------------------------------

--
-- Stand-in structure for view `manftest`
-- (See below for the actual view)
--
CREATE TABLE `manftest` (
);

-- --------------------------------------------------------

--
-- Structure for view `manftest`
--
DROP TABLE IF EXISTS `manftest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `manftest`  AS SELECT json_object('manf',group_concat(distinct `groupbycheck`.`manf` separator ',')) AS `md` FROM `groupbycheck` GROUP BY `groupbycheck`.`order_no``order_no`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ds_crud_categories`
--
ALTER TABLE `ds_crud_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_crud_items`
--
ALTER TABLE `ds_crud_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `search_index` (`id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `ds_crud_locations`
--
ALTER TABLE `ds_crud_locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ds_crud_categories`
--
ALTER TABLE `ds_crud_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ds_crud_items`
--
ALTER TABLE `ds_crud_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `ds_crud_locations`
--
ALTER TABLE `ds_crud_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
