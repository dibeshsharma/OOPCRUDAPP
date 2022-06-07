-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 04:20 AM
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
(111, '0', '2022-06-07 00:00:00', 'item name 23', 'category_01', 'location_02', '45.00', 1),
(112, '0', '2022-06-07 00:00:00', 'item name 23', 'category_01', 'location_01', '48.00', 1),
(113, '45', '2022-06-07 00:00:00', 'item name 24', 'category_02', 'location_01', '48.00', 1),
(114, '45', '2022-06-07 00:00:00', 'item name 23', 'category_01', 'location_02', '5.00', 1),
(115, '45', '2022-06-07 00:00:00', 'item name 23', 'category_02', 'location_01', '56.00', 1),
(116, '45', '2022-06-07 00:00:00', 'item name 23', 'category_01', 'location_02', '0.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ds_crud_items`
--
ALTER TABLE `ds_crud_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ds_crud_items`
--
ALTER TABLE `ds_crud_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
