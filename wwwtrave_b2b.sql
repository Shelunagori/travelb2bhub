-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2018 at 08:22 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwwtrave_b2b`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_promotions`
--

CREATE TABLE `hotel_promotions` (
  `id` int(10) NOT NULL,
  `user_id` int(7) NOT NULL,
  `hotel_name` varchar(150) NOT NULL,
  `hotel_location` varchar(300) NOT NULL,
  `hotel_category_id` int(7) NOT NULL,
  `cheap_tariff` float(10,2) NOT NULL,
  `expensive_tariff` float(10,2) NOT NULL,
  `website` varchar(400) NOT NULL,
  `status` text NOT NULL,
  `hotel_pic` int(11) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `total_charges` float(11,2) NOT NULL,
  `price_master_id` int(7) NOT NULL,
  `visible_date` date NOT NULL DEFAULT '0000-00-00',
  `hotel_rating` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` date NOT NULL DEFAULT '0000-00-00',
  `accept_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_promotion_price_before_renews`
--

CREATE TABLE `hotel_promotion_price_before_renews` (
  `id` int(10) NOT NULL,
  `hotel_promotion_id` int(7) NOT NULL,
  `price_master_id` int(7) NOT NULL,
  `price` int(7) NOT NULL,
  `visible_date` date NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_promotion_reports`
--

CREATE TABLE `hotel_promotion_reports` (
  `id` int(10) NOT NULL,
  `hotel_promotion_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `report_reason_id` int(7) NOT NULL,
  `comment` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_promotions`
--
ALTER TABLE `hotel_promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_promotion_price_before_renews`
--
ALTER TABLE `hotel_promotion_price_before_renews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_promotion_reports`
--
ALTER TABLE `hotel_promotion_reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_promotions`
--
ALTER TABLE `hotel_promotions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_promotion_price_before_renews`
--
ALTER TABLE `hotel_promotion_price_before_renews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_promotion_reports`
--
ALTER TABLE `hotel_promotion_reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
