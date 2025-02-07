-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 05:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `car_id`, `booking_date`, `status`) VALUES
(67, 2, 20, '2024-05-11 22:00:03', '0'),
(68, 2, 20, '2024-05-11 22:00:23', '0'),
(69, 2, 20, '2024-05-11 22:01:39', '0'),
(70, 2, 20, '2024-05-11 22:01:40', '0'),
(71, 2, 20, '2024-05-11 22:01:46', '0'),
(72, 2, 20, '2024-05-11 22:02:04', '0'),
(73, 2, 20, '2024-05-11 22:02:04', '0'),
(74, 2, 17, '2024-05-11 22:04:59', '0'),
(75, 2, 17, '2024-05-11 23:46:02', '0'),
(76, 2, 17, '2024-05-12 00:54:46', '0'),
(77, 2, 17, '2024-05-12 03:50:47', '0'),
(78, 2, 17, '2024-05-16 21:12:02', '0'),
(79, 2, 17, '2024-05-17 09:13:19', '0'),
(80, 2, 20, '2024-05-24 05:19:19', '0'),
(81, 2, 17, '2024-05-24 05:23:36', '0'),
(83, 2, 17, '2024-05-24 06:38:17', '0'),
(84, 2, 17, '2024-05-24 07:01:29', '0');

-- --------------------------------------------------------

--
-- Table structure for table `bookinghistory`
--

CREATE TABLE `bookinghistory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookinghistory`
--

INSERT INTO `bookinghistory` (`id`, `user_id`, `car_id`, `booking_date`) VALUES
(1, 2, 20, '2024-05-24 06:27:00'),
(2, 2, 17, '2024-05-24 06:27:25'),
(3, 2, 20, '2024-05-24 06:31:43'),
(4, 2, 20, '2024-05-24 06:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `image`, `seats`, `transmission`, `location`, `price`) VALUES
(1, 'Toyota Corolla', 'corolla.webp', 5, 'Automatic', 'Kathmandu', 7000.00),
(2, 'Honda Civic', 'civic.webp', 5, 'Manual', 'Pokhara', 7500.00),
(3, 'Hyundai Tucson', 'tucson.webp', 5, 'Automatic', 'Chitwan', 8500.00);

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `id` int(11) NOT NULL,
  `carName` varchar(255) NOT NULL,
  `carBrand` varchar(255) NOT NULL,
  `carType` varchar(255) NOT NULL,
  `carSeats` int(11) NOT NULL,
  `carSpace` varchar(255) NOT NULL,
  `carTransmission` varchar(255) NOT NULL,
  `carEngine` varchar(255) NOT NULL,
  `carMileage` varchar(255) NOT NULL,
  `carPrice` decimal(10,2) NOT NULL,
  `airbags` tinyint(1) NOT NULL,
  `absBrakes` tinyint(1) NOT NULL,
  `tractionControl` tinyint(1) NOT NULL,
  `audioSystem` tinyint(1) NOT NULL,
  `bluetooth` tinyint(1) NOT NULL,
  `navigation` tinyint(1) NOT NULL,
  `parkingAssistance` tinyint(1) NOT NULL,
  `airConditioning` tinyint(1) NOT NULL,
  `heating` tinyint(1) NOT NULL,
  `carImage` text DEFAULT NULL,
  `carLocation` varchar(255) NOT NULL DEFAULT 'Kathmandu',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`id`, `carName`, `carBrand`, `carType`, `carSeats`, `carSpace`, `carTransmission`, `carEngine`, `carMileage`, `carPrice`, `airbags`, `absBrakes`, `tractionControl`, `audioSystem`, `bluetooth`, `navigation`, `parkingAssistance`, `airConditioning`, `heating`, `carImage`, `carLocation`, `user_id`) VALUES
(17, 'Ferari', 'nissan', 'Offroad', 3, 'Automatic', 'Automatic', 'Diesel', 'Unlimited', 12300.00, 0, 0, 0, 0, 0, 0, 0, 0, 1, '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxIQEhAPEBAVEBAQEBUREBAWEhUSFhAVFRYWFhYRFhUYHCggGCYlGxYVITEhJisrLjAuFx8zODMtOSgtLisBCgoKDg0OGw8QGzAlHSUtLTctLisrKy0rKystLSstLy0tKzUtLSstKzgtLSstLSstKy0tLSstKy0tLS0tNystLf/AABEIAKgBLAMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAAAQIDBQYHBAj/xABDEAABAwIDBQQGCAIJBQAAAAABAAIDBBESITEFBhNBUQdhcYEiMlKRobEUI0KCksHR4WJyFTNEU1Rjc6KyF0OT4vD/xAAZAQEAAwEBAAAAAAAAAAAAAAAAAQIDBAX/xAAqEQEAAgIABAQFBQAAAAAAAAAAAQIDEQQSITEFE1GhM0FhseEiIzJxkf/aAAwDAQACEQMRAD8A7gAlkClBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFkspRBFlBVSpKCQpUBSgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAqSqlSUEhSoClAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBUlVKkoJClQFKAiIgIiICIiAiIgIipkeGgucQABck5AIKkWo7Q38gaXMgbJUubrwmGTxzyHxPgtar+0dzTYwxxnXDPXRxPA/ih9A/AoOpXUr582zvhT1D3OfUx2y+pjjmLGkCxtaOzs75n3qun7TJYY209PVFkbLhjjROkeATe2Jz7WHL0dEH0Ai+cqzefalTfg7WD7kBrSZKBzicrNLmMYT/CHknkFgqiHbMhc2SSUkGzxJVC4PRzXPuPMIPqlzgNTZUsladHA21sQV8kVO7lXkZDFc6AyNc4+AFyVabunWHPgA5dYx8HuBQfX6L5CbsStg9IRSs742n5x3+auQ7f2hCbNraphH2fpMo97b/NB9covl+h7UNrw/2syj2ZY43g+Jwh3xW17J7dZ22FXRxyjm+JxiPjgdiB94Qd1RaXu52obNrbNE/0eU2AintESToA++Bx7gbrcwUEoiICIiAiIgIi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', 'Kathmandu', NULL),
(20, 'Buggati', 'Toyota', 'Sports', 4, 'Automatic', 'Manual', 'Diesel', 'Unlimited', 124000.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, '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', 'Kathmandu', NULL),
(21, 'Ferrari', 'Toyota', 'Offroad', 4, 'Automatic', 'Manual', 'Hybrid', 'Unlimited', 13000.00, 0, 0, 0, 0, 0, 0, 1, 1, 1, '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', 'Kathmandu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `car_id`) VALUES
(4, 2, 20),
(5, 2, 21);

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `booking_id`, `price`, `date`) VALUES
(1, 74, 12348888.00, '2024-05-12'),
(14, 74, 12000.00, '2024-01-05'),
(15, 74, 15000.00, '2024-01-12'),
(16, 74, 18000.00, '2024-01-20'),
(17, 74, 11000.00, '2024-02-08'),
(18, 74, 17000.00, '2024-02-15'),
(19, 74, 14000.00, '2024-03-02'),
(20, 74, 16000.00, '2024-03-10'),
(21, 74, 19000.00, '2024-03-18'),
(22, 74, 13000.00, '2024-04-06'),
(23, 74, 20000.00, '2024-04-14'),
(24, 74, 10000.00, '2024-05-03'),
(25, 74, 17500.00, '2024-05-11'),
(26, 75, 12348888.00, '2024-05-12'),
(27, 76, 12300.00, '2024-05-12'),
(28, 77, 12300.00, '2024-05-12'),
(29, 78, 12300.00, '2024-05-16'),
(30, 79, 12300.00, '2024-05-17'),
(31, 80, 124000.00, '2024-05-24'),
(32, 81, 12300.00, '2024-05-24'),
(33, 83, 12300.00, '2024-05-24'),
(34, 84, 12300.00, '2024-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `car_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `status`, `created_at`, `car_id`, `booking_id`) VALUES
(35, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-09 08:39:34', 17, 45),
(36, 1, 'New booking request from user 2 for car 20.', 'read', '2024-05-09 08:40:37', 20, 46),
(37, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-09 08:42:19', 17, 47),
(38, 1, 'New booking request from user 2 for car 20.', '', '2024-05-09 08:47:17', 20, 48),
(39, 1, 'New booking request from user 2 for car 17.', '', '2024-05-09 08:49:24', 17, 49),
(40, 1, 'New booking request from user 2 for car 20.', 'read', '2024-05-09 08:49:56', 20, 50),
(41, 1, 'New booking request from user 2 for car 17.', '', '2024-05-09 08:52:14', 17, 51),
(42, 1, 'New booking request from user 2 for car 20.', '', '2024-05-09 08:55:46', 20, 52),
(43, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-09 08:59:07', 17, 53),
(44, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-09 09:09:12', 17, 54),
(45, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-09 09:11:17', 17, 55),
(46, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-09 09:11:37', 17, 56),
(47, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-10 07:12:57', 17, 57),
(48, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-10 07:25:57', 17, 58),
(49, 1, 'New booking request from user 2 for car 20.', 'read', '2024-05-10 07:26:57', 20, 59),
(50, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-10 07:31:33', 17, 60),
(51, 1, 'New booking request from user 2 for car 17.', 'read', '2024-05-10 07:38:47', 17, 61),
(52, 1, 'New booking request from user 2 for car 20.', 'read', '2024-05-10 07:40:47', 20, 62),
(53, 1, 'New booking request from user 2 for car 17.', 'unread', '2024-05-11 12:06:53', 17, 63),
(54, 1, 'New booking request from user 2 for car 17.', 'unread', '2024-05-11 21:56:01', 17, 64),
(55, 1, 'New booking request from user 2 for car 20.', 'read', '2024-05-11 21:58:21', 20, 65),
(56, 1, 'New booking request from user 2 for car 20.', 'read', '2024-05-11 22:00:23', 20, 68);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `car_id`, `user_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(4, 17, 2, 'Very Very good\r\n', 3, '2024-05-11 12:19:11', '2024-05-24 02:36:24'),
(5, 17, 3, 'Smooth driving experience.', 4, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(6, 17, 4, 'Good value for money.', 4, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(7, 17, 5, 'Average car, could be better.', 3, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(8, 17, 6, 'Needs improvement.', 3, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(9, 17, 7, 'Decent car, nothing special.', 3, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(10, 17, 8, 'Would not recommend.', 2, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(11, 17, 9, 'Not satisfied with the service.', 2, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(12, 17, 10, 'Poor condition, disappointed.', 1, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(13, 17, 11, 'Worst experience ever.', 1, '2024-05-11 12:19:11', '2024-05-11 12:19:11'),
(14, 17, 12, 'Terrible service.', 1, '2024-05-11 12:19:11', '2024-05-11 12:19:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `bookinghistory`
--
ALTER TABLE `bookinghistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `bookinghistory`
--
ALTER TABLE `bookinghistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `car_details`
--
ALTER TABLE `car_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_login`.`users` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`);

--
-- Constraints for table `bookinghistory`
--
ALTER TABLE `bookinghistory`
  ADD CONSTRAINT `bookinghistory_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_login`.`users` (`id`),
  ADD CONSTRAINT `bookinghistory_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`);

--
-- Constraints for table `car_details`
--
ALTER TABLE `car_details`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_login`.`users` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_login`.`users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`);

--
-- Constraints for table `finance`
--
ALTER TABLE `finance`
  ADD CONSTRAINT `finance_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_login`.`users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_login`.`users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
