-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2021 at 10:07 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hakika`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `date_created`) VALUES
(1, 'admin1', '$2y$10$wALsyS0FyE2EP5.zU.J/ju9q.qKGHBtnYPgLW5pU0MxIl14Bj8P5W', '2021-04-04 00:00:00'),
(2, 'admin2', '$2y$10$kMa2uNz4qOeeXEHNBwus2uaybeoqWWUQ5p.BdQi1P3HoowZsfL4/K', '2021-04-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `depots`
--

CREATE TABLE `depots` (
  `depot_id` int(5) NOT NULL,
  `depot_name` varchar(10) NOT NULL,
  `depot_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depots`
--

INSERT INTO `depots` (`depot_id`, `depot_name`, `depot_code`) VALUES
(1, 'Main Depot', '001'),
(3, 'Duala', '002'),
(4, 'Logistics', '003'),
(5, 'Road Taine', '004'),
(6, 'Penderosa', '005');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(5) NOT NULL,
  `driver_name` varchar(30) NOT NULL,
  `national_id` int(10) NOT NULL,
  `driver_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `driver_name`, `national_id`, `driver_dob`) VALUES
(1, 'John Isutsa', 3478829, '2021-03-02'),
(2, 'Miriam Wangu', 37890094, '1994-06-23'),
(3, 'Amy Mutheu', 37287490, '1999-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `driver_trips`
--

CREATE TABLE `driver_trips` (
  `trip_id` int(5) NOT NULL,
  `driver_name` varchar(20) NOT NULL,
  `national_id` int(10) NOT NULL,
  `trip_date` date NOT NULL,
  `trip_from` varchar(20) NOT NULL,
  `trip_destination` varchar(20) NOT NULL,
  `cargo_description` varchar(150) NOT NULL,
  `trip_operation` varchar(15) NOT NULL,
  `container_number` varchar(10) NOT NULL,
  `container_size` varchar(30) NOT NULL,
  `shipping_line` varchar(15) NOT NULL,
  `trip_time` time NOT NULL DEFAULT current_timestamp(),
  `driver_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver_trips`
--

INSERT INTO `driver_trips` (`trip_id`, `driver_name`, `national_id`, `trip_date`, `trip_from`, `trip_destination`, `cargo_description`, `trip_operation`, `container_number`, `container_size`, `shipping_line`, `trip_time`, `driver_id`) VALUES
(1, 'John Isutsa', 3478829, '2021-04-01', 'Main Depot', 'Port', 'Green container', 'Repartition', 'EV001', '40 ft dry shipp', 'Evergreen', '00:26:28', 1),
(2, 'Miriam Wangu', 37890094, '2021-04-03', 'Port', 'Main Depot', 'Blue 20ft.', 'Return', 'EV003', '20 ft flat rack', 'Evergreen', '11:55:12', 2),
(3, 'Miriam Wangu', 37890094, '2021-04-03', 'Main Depot', 'Duala', 'Red container', 'Transfer', 'M001', '40 ft dry shipping container', 'Maersk', '23:10:35', 2),
(4, 'Amy Mutheu', 37287490, '2021-04-04', 'Main Depot', 'Port', 'Bulk load', 'Repartition', 'M002', '20 ft flat rack shipping conta', 'Maersk', '21:13:42', 3);

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

CREATE TABLE `trucks` (
  `truck_id` int(10) NOT NULL,
  `reg_no` varchar(10) NOT NULL,
  `truck_name` varchar(25) NOT NULL,
  `depot_name` varchar(10) NOT NULL,
  `depot_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`truck_id`, `reg_no`, `truck_name`, `depot_name`, `depot_id`) VALUES
(1, 'KBD 456H', 'Scania Truck', 'Logistics', 4),
(2, 'KBW 345R', 'Mercedes Truck 5000cc', 'Road Taine', 5),
(3, 'KTBA 717P', 'Scania Truck', 'Duala', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `depots`
--
ALTER TABLE `depots`
  ADD PRIMARY KEY (`depot_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `driver_trips`
--
ALTER TABLE `driver_trips`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`truck_id`),
  ADD KEY `depot_id` (`depot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `depots`
--
ALTER TABLE `depots`
  MODIFY `depot_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_trips`
--
ALTER TABLE `driver_trips`
  MODIFY `trip_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
  MODIFY `truck_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_trips`
--
ALTER TABLE `driver_trips`
  ADD CONSTRAINT `driver_trips_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`);

--
-- Constraints for table `trucks`
--
ALTER TABLE `trucks`
  ADD CONSTRAINT `trucks_ibfk_1` FOREIGN KEY (`depot_id`) REFERENCES `depots` (`depot_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
