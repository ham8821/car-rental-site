-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2019 at 10:27 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(40) NOT NULL,
  `car_brand` varchar(20) NOT NULL,
  `car_model` varchar(80) NOT NULL,
  `car_year` int(11) NOT NULL,
  `price_per_day` double NOT NULL,
  `rented_status` tinyint(1) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_brand`, `car_model`, `car_year`, `price_per_day`, `rented_status`, `image`) VALUES
(2, 'Green tornado', 'Ford', 'Ford Ka', 2000, 85, 1, './images/car_2.jpg\r\n'),
(3, 'Rock in wheels', 'Mazda', 'Curve', 2005, 105, 1, './images/car_3.jpg\r\n'),
(4, 'Chip and pure', 'Chevrolet', 'Corsa', 2003, 70, 1, './images/car_4.jpg\r\n'),
(5, 'The best', 'Audi', 'A3', 2015, 130, 1, './images/car_5.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `days_rented` int(11) DEFAULT NULL,
  `rental_cost` double NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `reservation_status` varchar(30) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `days_rented`, `rental_cost`, `user_id`, `car_id`, `reservation_status`, `start_date`, `end_date`) VALUES
(8, 1, 85, 2, 2, 'accepted', '2019-03-13', '2019-03-14'),
(9, 12, 1260, 2, 3, 'accepted', '2019-03-30', '2019-04-11'),
(10, 13, 1690, 2, 5, 'accepted', '2019-03-23', '2019-03-10'),
(11, 7, 735, 16, 3, 'rejected', '2019-04-10', '2019-04-17'),
(12, 2, 210, 17, 3, 'accepted', '2019-03-29', '2019-03-31'),
(13, 11, 935, 2, 2, 'accepted', '2019-03-30', '2019-04-10'),
(14, 2, 170, 2, 2, 'accepted', '2019-03-28', '2019-03-30'),
(15, 3, 210, 2, 4, 'rejected', '2019-03-28', '2019-03-31'),
(16, 14, 980, 2, 4, 'rejected', '2019-04-17', '2019-05-01'),
(17, 15, 1050, 2, 4, 'rejected', '2019-03-13', '2019-03-28'),
(18, 2, 170, 2, 2, 'rejected', '2019-03-28', '2019-03-30'),
(19, 2, 170, 2, 2, 'accepted', '2019-03-28', '2019-03-30'),
(20, 2, 210, 2, 3, 'rejected', '2019-03-29', '2019-03-31'),
(21, 7, 490, 2, 4, 'rejected', '2019-04-19', '2019-04-26'),
(22, 8, 1040, 2, 5, 'rejected', '2019-04-11', '2019-04-19'),
(23, 5, 650, 2, 5, 'accepted', '2019-03-30', '2019-04-04'),
(24, 1, 85, 2, 2, 'accepted', '2019-03-30', '2019-03-31'),
(25, 1, 70, 18, 4, 'pending', '2019-03-29', '2019-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `password`, `email`, `contact_number`, `user_type_id`, `username`) VALUES
(2, 'Diego', 'Evangelisti', '1234', 'evangelistidiego@gmail.com', '0225869441', 3, 'diego'),
(3, 'admin', 'admin', '1234', 'admin-awesome-car-rental@gmail.com', '0225869441', 1, 'admin'),
(10, 'Robert', 'Parish', '1234', 'staff-awesome-car-rental1@gmail.com', '02212345678', 2, 'staff-robert'),
(11, 'Sheldon', 'Cooper', '1234', 'staff-awesome-car-rental2@gmail.com', '02201234567', 2, 'staff-sheldon'),
(12, 'James', 'Hetfield', '1234', 'staff-awesome-car-rental3@gmail.com', '02210111213', 2, 'staff-james'),
(16, 'Roman', 'Carlo', '1234', 'roman@gmail.com', '02255555555', 3, 'Roman-c'),
(17, 'Peter', 'Druker', '1234', 'peter-druker@peter.com', '022555555', 3, 'peter'),
(18, 'Emma', 'Ham', '1234', 'ham38538821@gmail.com', '0228475694', 3, 'emma');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'admin'),
(2, 'staff'),
(3, 'costumer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `car_name` (`car_name`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
