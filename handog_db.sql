-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2025 at 06:11 PM
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
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` enum('pool','griller','shower_room') NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenity_images`
--

CREATE TABLE `amenity_images` (
  `id` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` enum('room','cottage','event_hall','exclusive') NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `rate_hourly` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rate_8hrs` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rate_12hrs` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rate_1day` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amenities` text DEFAULT NULL,
  `status` enum('available','booked','maintenance','') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='This table contains all the data inside accommodation page.';

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `type`, `description`, `capacity`, `rate_hourly`, `rate_8hrs`, `rate_12hrs`, `rate_1day`, `amenities`, `status`, `created_at`) VALUES
(1, 'Honeymoon Suite', 'room', 'Experience pure romance in our Honeymoon Suite, featuring a plush king bed, private balcony with ocean views, and a marble bathroom with a soaking tub. Enjoy champagne on arrival and an intimate, elegant setting designed for unforgettable moments together.', 4, 0.00, 0.00, 1500.00, 0.00, 'TV, Shower', 'available', '2025-09-12 16:42:16'),
(2, 'Romantic Oceanfront Villa', 'room', 'Escape to your private villa with breathtaking sea views, a sunlit terrace, and a spacious bathroom with a deep soaking tub. Perfect for couples seeking intimacy, elegance, and unforgettable sunsets.', 2, 0.00, 0.00, 2500.00, 0.00, 'TV, Shower, Ocean View', 'available', '2025-09-13 09:16:05'),
(6, 'Whispering Pines Cottage', 'cottage', 'A cozy retreat surrounded by evergreens, perfect for relaxing by the fireplace, enjoying quiet mornings on the porch, or exploring nearby trails.', 6, 0.00, 0.00, 500.00, 0.00, '', 'available', '2025-09-23 15:57:00'),
(7, 'Event Hall', 'event_hall', 'Planning a special event? Our spacious event hall is perfect for birthdays, reunions, weddings, and more. With a flexible setup, relaxing resort vibes, and access to our pool and amenities, it\'s the perfect place to celebrate. Book now and make your event easy, fun, and unforgettable!', 50, 3000.00, 0.00, 25000.00, 0.00, 'A Standard Room, Chairs and Tables', 'available', '2025-09-24 14:12:14'),
(8, 'Studio Loft', 'room', 'This modern Studio Loft combines functionality with style. Ideal for solo travelers or couples, it offers a cozy space with everything you need at your fingertips.', 12, 0.00, 0.00, 1500.00, 0.00, 'Kitchen', 'available', '2025-09-25 16:23:08'),
(9, 'Nature-Inspired', 'cottage', 'Nestled in a peaceful setting, this cottage combines rustic charm with modern convenience. Ideal for guests who love nature, privacy, and cozy living.', 10, 0.00, 250.00, 300.00, 0.00, '', 'available', '2025-09-26 04:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `facility_images`
--

CREATE TABLE `facility_images` (
  `id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_images`
--

INSERT INTO `facility_images` (`id`, `facility_id`, `image`) VALUES
(1, 1, 'uploads/images/68d2c34c3de5d_kubo.jpg'),
(2, 1, 'uploads/images/68d2c34c3de5d_kubo.jpg'),
(3, 2, 'uploads/images/68d2c34c3de5d_kubo.jpg'),
(5, 6, 'uploads/images/68d2c34c3de5d_kubo.jpg'),
(6, 7, 'uploads/images/68d3fc3ea13e7_event_hall_2.jpg'),
(7, 7, 'uploads/images/68d3fc3ea15e9_event_hall_1.jpg'),
(11, 8, 'uploads/images/68d56c6c96732_room_1.jpg'),
(13, 9, 'uploads/images/68d61268042ab_cottage_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `contact_email` varchar(150) NOT NULL,
  `contact_address` varchar(150) NOT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
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

INSERT INTO `reservations` (`id`, `facility_id`, `contact_person`, `contact_no`, `contact_email`, `contact_address`, `check_in`, `check_out`, `guest_count`, `rent_videoke`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-09-22 06:00:00', '2025-09-22 17:00:00', 1, 'no', 1020.00, 'pending', '2025-09-22 08:37:58', '2025-09-25 13:10:47'),
(2, 1, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-09-25 18:00:00', '2025-09-25 05:00:00', 2, 'no', 1300.00, 'pending', '2025-09-25 13:36:24', '2025-09-25 13:36:24'),
(4, 9, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-09-26 06:00:00', '2025-09-26 17:00:00', 1, 'no', 370.00, 'confirmed', '2025-09-26 13:29:31', '2025-09-26 13:29:31');

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
(5, 1, 'Taki Fimito', 23, 'adult', 'no', '2025-09-22 08:37:58', '2025-09-22 08:37:58'),
(16, 2, 'Taki Fimito', 25, 'adult', 'no', '2025-09-25 13:36:24', '2025-09-25 13:36:24'),
(17, 2, 'Tafi Fimito', 22, 'adult', 'no', '2025-09-25 13:36:24', '2025-09-25 13:36:24'),
(19, 4, 'Taki Fimito', 22, 'adult', 'no', '2025-09-26 13:29:31', '2025-09-26 13:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `st_rates`
--

CREATE TABLE `st_rates` (
  `id` int(11) NOT NULL,
  `adult_rate_day` decimal(10,2) NOT NULL,
  `kid_rate_day` decimal(10,2) NOT NULL,
  `adult_rate_night` decimal(10,2) NOT NULL,
  `kid_rate_night` decimal(10,2) NOT NULL,
  `senior_pwd_discount` decimal(10,2) NOT NULL,
  `videoke_rent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_rates`
--

INSERT INTO `st_rates` (`id`, `adult_rate_day`, `kid_rate_day`, `adult_rate_night`, `kid_rate_night`, `senior_pwd_discount`, `videoke_rent`) VALUES
(1, 120.00, 80.00, 200.00, 100.00, 20.00, 1500.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenity_images`
--
ALTER TABLE `amenity_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amenity_id` (`amenity_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility_images`
--
ALTER TABLE `facility_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `st_rates`
--
ALTER TABLE `st_rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenity_images`
--
ALTER TABLE `amenity_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `facility_images`
--
ALTER TABLE `facility_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `st_rates`
--
ALTER TABLE `st_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amenity_images`
--
ALTER TABLE `amenity_images`
  ADD CONSTRAINT `amenity_images_ibfk_1` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `facility_images`
--
ALTER TABLE `facility_images`
  ADD CONSTRAINT `facility_images_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  ADD CONSTRAINT `reservation_guests_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
