-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2025 at 06:10 PM
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
-- Database: `handog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `entrance_rates`
--

CREATE TABLE `entrance_rates` (
  `id` int(11) NOT NULL,
  `time_slot` enum('day','night') NOT NULL,
  `adult_rate` decimal(10,2) NOT NULL,
  `kid_rate` decimal(10,2) NOT NULL,
  `senior_pwd_discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entrance_rates`
--

INSERT INTO `entrance_rates` (`id`, `time_slot`, `adult_rate`, `kid_rate`, `senior_pwd_discount`, `created_at`, `updated_at`) VALUES
(1, 'day', 120.00, 80.00, 0.20, '2025-09-20 11:57:16', '2025-09-20 11:57:16'),
(2, 'night', 200.00, 100.00, 0.20, '2025-09-20 11:57:44', '2025-09-20 11:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` enum('room','cottage','event_hall','exclusive') NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amenities` text NOT NULL,
  `status` enum('available','booked','maintenance','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This table contains all the data inside accommodation page.';

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `type`, `description`, `image`, `capacity`, `price`, `amenities`, `status`, `created_at`) VALUES
(1, 'Honeymoon Suite', 'room', 'Experience pure romance in our Honeymoon Suite, featuring a plush king bed, private balcony with ocean views, and a marble bathroom with a soaking tub. Enjoy champagne on arrival and an intimate, elegant setting designed for unforgettable moments together.', 'https://www.shutterstock.com/image-photo/cheap-hotel-room-double-bed-600nw-2595537199.jpg', 4, 900.00, 'TV, Shower', 'available', '2025-09-12 16:42:16'),
(2, 'Romantic Oceanfront Villa', 'room', 'Escape to your private villa with breathtaking sea views, a sunlit terrace, and a spacious bathroom with a deep soaking tub. Perfect for couples seeking intimacy, elegance, and unforgettable sunsets.', 'https://t3.ftcdn.net/jpg/02/71/08/28/360_F_271082810_CtbTjpnOU3vx43ngAKqpCPUBx25udBrg.jpg', 2, 1000.00, 'TV, Shower, Ocean View', 'available', '2025-09-13 09:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `entrance_rate_id` int(11) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `contact_email` varchar(150) NOT NULL,
  `contact_address` varchar(150) NOT NULL,
  `guest_count` int(11) NOT NULL DEFAULT 1,
  `rent_videoke` enum('yes','no') NOT NULL DEFAULT 'no',
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','canceled','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `facility_id`, `entrance_rate_id`, `contact_person`, `contact_no`, `contact_email`, `contact_address`, `guest_count`, `rent_videoke`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', 2, 'no', 1140.00, 'pending', '2025-09-20 15:35:26', '2025-09-20 15:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_guests`
--

CREATE TABLE `reservation_guests` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `guest_name` varchar(150) NOT NULL,
  `guest_age` int(2) NOT NULL,
  `guest_type` enum('adult','kid') NOT NULL,
  `senior_pwd` enum('yes','no') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation_guests`
--

INSERT INTO `reservation_guests` (`id`, `reservation_id`, `guest_name`, `guest_age`, `guest_type`, `senior_pwd`, `created_at`, `updated_at`) VALUES
(1, 1, 'Taki Fimito', 24, 'adult', 'no', '2025-09-20 15:35:26', '2025-09-20 15:35:26'),
(2, 1, 'Tafi Fimito', 24, 'adult', 'no', '2025-09-20 15:35:26', '2025-09-20 15:35:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entrance_rates`
--
ALTER TABLE `entrance_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `entrance_rate_id` (`entrance_rate_id`);

--
-- Indexes for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entrance_rates`
--
ALTER TABLE `entrance_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`entrance_rate_id`) REFERENCES `entrance_rates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  ADD CONSTRAINT `reservation_guests_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
