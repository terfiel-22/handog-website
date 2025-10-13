-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 04:48 PM
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

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `type`, `description`, `created_at`) VALUES
(1, 'Serenity Lagoon', 'pool', 'A calm, crystal-clear pool surrounded by lush greenery, perfect for guests seeking peace and quiet. Ideal for morning swims or an afternoon of lounging in tranquility.', '2025-09-29 04:33:23'),
(2, 'Sunset Infinity Pool', 'pool', 'An elegant infinity pool overlooking breathtaking views. Guests can relax with cocktails in hand while watching the sun dip below the horizon.', '2025-09-29 05:26:02'),
(4, 'Family Splash Zone', 'pool', 'A vibrant pool designed for families and kids, complete with shallow areas, playful water features, and plenty of space for fun under the sun.', '2025-09-29 05:27:52'),
(5, 'Grillers', 'griller', 'Indulge in a refined outdoor dining experience with our premium grillers, designed to bring people together over flavors and fire. Perfect for private gatherings, each moment is elevated with the touch of resort-style luxury.', '2025-09-29 09:01:30'),
(6, 'Shower Rooms', 'shower_room', 'Enjoy the convenience of our outdoor grillers, perfect for family cookouts, friendly gatherings, or simply savoring a fresh meal under the open sky. After a day of fun, step into our well-equipped shower rooms designed for comfort and refreshment, ensuring you feel relaxed and ready for more.', '2025-09-29 09:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `amenity_images`
--

CREATE TABLE `amenity_images` (
  `id` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenity_images`
--

INSERT INTO `amenity_images` (`id`, `amenity_id`, `image`) VALUES
(1, 1, 'uploads/images/68da0c1410de2_pool_1.jpg'),
(2, 2, 'uploads/images/68da186ab759d_pool_2.jpg'),
(3, 4, 'uploads/images/68da18d8684e3_pool_3.jpg'),
(4, 5, 'uploads/images/68da4aeb12222_grillers_1.jpg'),
(5, 6, 'uploads/images/68da4cb79e946_shower_room_2.jpg'),
(6, 6, 'uploads/images/68da4cb79eaeb_shower_room_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `image`, `date`, `created_at`) VALUES
(1, 'Silent Sanctuary x Sunkissed Lola', 'Get Ready for an Evening of Great Music and Don’t miss this rare opportunity to see Silent Sanctuary and Sunkissed Lola share the stage. Whether you’re a longtime fan or discovering their music for the first time, this concert promises to be a night to remember. Secure your tickets now and experience the magic of these two incredible bands live!', 'uploads/images/68ebcad0826f8_event1.png', '2025-10-19 16:00:00', '2025-10-12 23:27:12'),
(3, 'Live Jam', 'The Filipino rock band that brought us many of our favorite songs like “Lunes,” “Jeepney” and “Gemini” will be bringing all the early-2000s feels alive, and then some, as they play some of their more recent hits from their double EP, Sinag/Tala.', 'uploads/images/68ebda8bc507b_event2.png', '2025-10-19 12:00:00', '2025-10-13 00:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` enum('room','cottage','event_hall','exclusive') NOT NULL,
  `available_unit` int(10) NOT NULL DEFAULT 1,
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

INSERT INTO `facilities` (`id`, `name`, `type`, `available_unit`, `description`, `capacity`, `rate_hourly`, `rate_8hrs`, `rate_12hrs`, `rate_1day`, `amenities`, `status`, `created_at`) VALUES
(1, 'Honeymoon Suite', 'room', 1, 'Experience pure romance in our Honeymoon Suite, featuring a plush king bed, private balcony with ocean views, and a marble bathroom with a soaking tub. Enjoy champagne on arrival and an intimate, elegant setting designed for unforgettable moments together.', 4, 0.00, 0.00, 1500.00, 0.00, 'TV, Shower', 'available', '2025-09-12 16:42:16'),
(2, 'Romantic Oceanfront Villa', 'room', 1, 'Escape to your private villa with breathtaking sea views, a sunlit terrace, and a spacious bathroom with a deep soaking tub. Perfect for couples seeking intimacy, elegance, and unforgettable sunsets.', 2, 0.00, 0.00, 2500.00, 0.00, 'TV, Shower, Ocean View', 'available', '2025-09-13 09:16:05'),
(6, 'Whispering Pines Cottage', 'cottage', 1, 'A cozy retreat surrounded by evergreens, perfect for relaxing by the fireplace, enjoying quiet mornings on the porch, or exploring nearby trails.', 6, 0.00, 0.00, 500.00, 0.00, '', 'available', '2025-09-23 15:57:00'),
(7, 'Event Hall', 'event_hall', 1, 'Planning a special event? Our spacious event hall is perfect for birthdays, reunions, weddings, and more. With a flexible setup, relaxing resort vibes, and access to our pool and amenities, it\'s the perfect place to celebrate. Book now and make your event easy, fun, and unforgettable!', 50, 3000.00, 0.00, 25000.00, 0.00, 'A Standard Room, Chairs and Tables', 'available', '2025-09-24 14:12:14'),
(8, 'Studio Loft', 'room', 1, 'This modern Studio Loft combines functionality with style. Ideal for solo travelers or couples, it offers a cozy space with everything you need at your fingertips.', 12, 0.00, 0.00, 1500.00, 0.00, 'Kitchen', 'available', '2025-09-25 16:23:08'),
(9, 'Nature-Inspired', 'cottage', 2, 'Nestled in a peaceful setting, this cottage combines rustic charm with modern convenience. Ideal for guests who love nature, privacy, and cozy living.', 10, 0.00, 250.00, 300.00, 0.00, '', 'available', '2025-09-26 04:11:19');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`) VALUES
(1, 'Is breakfast included in the room rate?                         ', 'Check-in is from 2:00 PM, and check-out is by 12:00 PM. Early check-in and late check-out are subject to availability.', '2025-10-13 15:06:41'),
(3, 'Do you offer free Wi-Fi?', 'Yes, complimentary high-speed Wi-Fi is available throughout the resort, including rooms, restaurants, and pool areas.', '2025-10-13 15:22:46'),
(4, 'Is a deposit required to confirm a booking?', 'Yes, a 50% down payment is required to confirm your reservation. The remaining balance can be settled upon check-in.', '2025-10-13 16:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'Oceanfront Paradise', 'An inviting view of turquoise waters and soft white sand — the perfect escape for beach lovers.', 'uploads/images/68dad0e97c575_gallery_1.jpg', '2025-09-29 18:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `payment_link` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reservation_id`, `amount`, `payment_method`, `payment_status`, `payment_link`, `created_at`, `updated_at`) VALUES
(2, 6, 450.00, 'gcash', 'half_paid', 'link_TLaQu94tBpzBYF9fLdzGLSmT', '2025-10-08 00:50:39', '2025-10-08 17:06:46'),
(3, 7, 450.00, 'gcash', 'half_paid', 'link_YaEHxAfhM4hHHAEpjougB7iU', '2025-10-08 04:29:57', '2025-10-08 05:01:33');

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
(1, 9, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-09-30 06:00:00', '2025-09-30 17:00:00', 1, 'no', 420.00, 'confirmed', '2025-09-30 11:08:57', '2025-10-03 10:17:19'),
(3, 9, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-10-06 06:00:00', '2025-10-06 18:00:00', 1, 'no', 420.00, 'confirmed', '2025-10-05 16:34:18', '2025-10-05 16:34:18'),
(4, 1, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-03-29 00:00:00', '2025-03-29 08:00:00', 1, 'no', 200.00, 'pending', '2025-10-05 19:13:52', '2025-10-05 19:13:52'),
(6, 9, 'Taki Fimito', '09384736281', 'badexek999@noidos.com', 'Manila, Philippines', '2025-10-11 00:00:00', '2025-10-11 08:00:00', 1, 'no', 450.00, 'pending', '2025-10-07 16:50:39', '2025-10-09 08:27:35'),
(7, 9, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-10-11 05:00:00', '2025-10-11 13:00:00', 1, 'no', 450.00, 'pending', '2025-10-07 20:29:57', '2025-10-09 08:28:54');

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
(1, 1, 'Taki Fimito', 22, 'adult', 'no', '2025-09-30 11:08:57', '2025-09-30 11:08:57'),
(3, 3, 'Taki Fimito', 22, 'adult', 'no', '2025-10-05 16:34:18', '2025-10-05 16:34:18'),
(4, 4, 'Taki Fimito', 22, 'adult', 'no', '2025-10-05 19:13:52', '2025-10-05 19:13:52'),
(6, 6, 'Taki Fimito', 22, 'adult', 'no', '2025-10-07 16:50:39', '2025-10-07 16:50:39'),
(7, 7, 'Taki Fimito', 22, 'adult', 'no', '2025-10-07 20:29:57', '2025-10-07 20:29:57');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `session_token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `session_token`) VALUES
(1, 'Handog Resort', 'handog@gmail.com', '$2y$10$zfm9lu1LQRLNvikO5NaB6.1d/je.oZ4YMd76UBrO/jZxI5QcHWkbm', '653b46dc1e89f3ad9054', NULL);

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
  ADD KEY `amenity_images_ibfk_1` (`amenity_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payments_reservation` (`reservation_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `amenity_images`
--
ALTER TABLE `amenity_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `facility_images`
--
ALTER TABLE `facility_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `st_rates`
--
ALTER TABLE `st_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amenity_images`
--
ALTER TABLE `amenity_images`
  ADD CONSTRAINT `amenity_images_ibfk_1` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `facility_images`
--
ALTER TABLE `facility_images`
  ADD CONSTRAINT `facility_images_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
