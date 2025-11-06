-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 05:47 PM
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
(1, 'Silent Sanctuary x Sunkissed Lola', 'Get Ready for an Evening of Great Music and Don’t miss this rare opportunity to see Silent Sanctuary and Sunkissed Lola share the stage. Whether you’re a longtime fan or discovering their music for the first time, this concert promises to be a night to remember. Secure your tickets now and experience the magic of these two incredible bands live!', 'uploads/images/68ebcad0826f8_event1.png', '2025-11-30 16:00:00', '2025-10-12 23:27:12'),
(3, 'Live Jam', 'The Filipino rock band that brought us many of our favorite songs like “Lunes,” “Jeepney” and “Gemini” will be bringing all the early-2000s feels alive, and then some, as they play some of their more recent hits from their double EP, Sinag/Tala.', 'uploads/images/68ebda8bc507b_event2.png', '2025-12-01 12:00:00', '2025-10-13 00:42:51');

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
(9, 'Nature-Inspired', 'cottage', 1, 'Nestled in a peaceful setting, this cottage combines rustic charm with modern convenience. Ideal for guests who love nature, privacy, and cozy living.', 10, 0.00, 250.00, 300.00, 0.00, '', 'available', '2025-09-26 04:11:19'),
(13, 'Exclusive', 'exclusive', 1, 'Experience unparalleled luxury at Handog Resort, where tropical elegance meets modern comfort. Nestled along pristine shores, this exclusive getaway offers world-class amenities, personalized service, and breathtaking views at every turn. Whether you’re seeking a romantic retreat, a family adventure, or a tranquil escape, our resort promises a stay filled with sophistication, serenity, and unforgettable memories.', 200, 0.00, 0.00, 55000.00, 80000.00, 'Infinity pool, private beach access, spa and wellness center, gourmet dining, 24-hour concierge, high-speed Wi-Fi, fitness center, airport shuttle, water sports, kids’ club.', 'available', '2025-10-22 08:43:58');

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
(13, 9, 'uploads/images/68d61268042ab_cottage_1.jpg'),
(20, 13, 'uploads/images/68f8994e16711_exclusive_2.jpg'),
(21, 13, 'uploads/images/68f8994e16906_exclusive_1.jpg');

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
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Beauty of Nature', 'Check the beauty of Handog Resort.', '2025-11-06 21:56:27', '2025-11-06 22:48:09'),
(2, 'Rustic Romance at Willow Creek', 'Capturing every heartfelt moment from the vows to the first dance — a perfect blend of elegance and joy.', '2025-11-06 22:06:02', '2025-11-06 22:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `folder_id`, `image`, `created_at`, `updated_at`) VALUES
(3, 2, 'uploads/images/690cab4a51e0b_gallery_5.jpg', '2025-11-06 22:06:02', '2025-11-06 22:06:02'),
(4, 2, 'uploads/images/690cab4a5206e_gallery_4.jpg', '2025-11-06 22:06:02', '2025-11-06 22:06:02'),
(5, 2, 'uploads/images/690cab4a522ef_gallery_3.jpg', '2025-11-06 22:06:02', '2025-11-06 22:06:02'),
(6, 1, 'uploads/images/690cb52918b2d_gallery_2.jpg', '2025-11-06 22:48:09', '2025-11-06 22:48:09'),
(7, 1, 'uploads/images/690cb52918d5c_gallery_1.jpg', '2025-11-06 22:48:09', '2025-11-06 22:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(200) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed','refunded','cancelled','deposited') DEFAULT 'pending',
  `payment_type` enum('full','cancellation_refund','deposit') DEFAULT 'deposit',
  `payment_link` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reservation_id`, `amount`, `payment_method`, `payment_status`, `payment_type`, `payment_link`, `created_at`, `updated_at`) VALUES
(2, 2, 250.00, 'gcash', 'paid', 'deposit', 'link_wK4meH9QbE1eHWZoS2WUSfE6', '2025-10-22 15:37:51', '2025-10-22 23:09:57'),
(6, 2, 250.00, NULL, 'paid', 'deposit', NULL, '2025-10-22 20:25:58', '2025-10-22 17:07:13'),
(8, 4, 1620.00, 'cash', 'paid', 'full', NULL, '2025-10-29 02:48:32', '2025-10-29 02:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` enum('yes','no') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `title`, `description`, `discount_value`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '20% OFF Halloween Promo', 'Enjoy 20% off all rooms this halloween', 20.00, '2025-10-26', '2025-11-02', 'yes', '2025-10-27 05:23:28', '2025-10-27 06:42:25'),
(3, '“Escape to Paradise” Getaway', 'Enjoy 25% off your stay and experience', 25.00, '2025-10-30', '2025-11-30', 'yes', '2025-10-29 17:25:31', '2025-10-29 17:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `promo_facilities`
--

CREATE TABLE `promo_facilities` (
  `id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_facilities`
--

INSERT INTO `promo_facilities` (`id`, `promo_id`, `facility_id`) VALUES
(8, 1, 1),
(9, 1, 9),
(10, 3, 1),
(11, 3, 2);

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
  `time_range` varchar(200) NOT NULL DEFAULT '8-Hours',
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

INSERT INTO `reservations` (`id`, `facility_id`, `contact_person`, `contact_no`, `contact_email`, `contact_address`, `check_in`, `time_range`, `check_out`, `guest_count`, `rent_videoke`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(2, 9, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-11-07 00:00:00', '12-Hours', '2025-11-07 12:00:00', 1, 'no', 500.00, 'confirmed', '2025-10-21 07:37:51', '2025-10-28 18:09:22'),
(4, 8, 'Taki Fimito', '09384736281', 'taki@gmail.com', 'Manila, Philippines', '2025-10-30 12:00:00', '12-Hours', '2025-10-31 00:00:00', 1, 'no', 1620.00, 'confirmed', '2025-10-28 18:48:32', '2025-10-28 18:48:32');

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
(11, 2, 'Taki Fimito', 22, 'adult', 'no', '2025-10-21 12:25:58', '2025-10-21 12:25:58'),
(13, 4, 'Taki Fimito', 22, 'adult', 'no', '2025-10-28 18:48:32', '2025-10-28 18:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `st_logos`
--

CREATE TABLE `st_logos` (
  `id` int(11) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_logos`
--

INSERT INTO `st_logos` (`id`, `logo`, `icon`, `created_at`) VALUES
(1, 'uploads/images/690c5b783a846_handog-logo.png', 'uploads/images/690c5c61b92cf_handog-icon.png', '2025-10-29 05:48:30');

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
-- Table structure for table `st_terms_conditions`
--

CREATE TABLE `st_terms_conditions` (
  `id` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_terms_conditions`
--

INSERT INTO `st_terms_conditions` (`id`, `filepath`, `created_at`, `updated_at`) VALUES
(1, 'uploads/files/690a3ce170abd_sample-terms-conditions-agreement.pdf', '2025-11-04 17:50:25', '2025-11-04 17:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `name` varchar(100) NOT NULL,
  `work` varchar(150) DEFAULT NULL,
  `feedback` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `rating`, `name`, `work`, `feedback`, `image`, `created_at`, `updated_at`) VALUES
(1, 5, 'John Doe', 'Software Engineer', 'This platform exceeded my expectations. Excellent support and user experience!', 'uploads/images/user-1.jpg', '2025-11-05 09:16:19', '2025-11-05 09:16:19'),
(2, 1, 'Jane Smith', 'Marketing Specialist', 'Really easy to use and efficient. Saved me a lot of time!', 'uploads/images/690b88443f355_user-10.jpg', '2025-11-05 09:16:19', '2025-11-05 17:24:30'),
(3, 5, 'Michael Brown', 'Project Manager', 'Outstanding results and top-notch customer service!', 'uploads/images/user-3.jpg', '2025-11-05 09:16:19', '2025-11-05 12:12:21'),
(4, 3, 'Emily Johnson', 'Freelance Writer', 'Good overall experience, though there’s room for improvement.', 'uploads/images/user-4.jpg', '2025-11-05 09:16:19', '2025-11-05 12:12:25'),
(6, 5, 'Taki Fimito', 'Web Developer', 'This resort is the best!', 'uploads/images/690b8c8fb3492_user-7.jpg', '2025-11-05 17:42:39', '2025-11-05 17:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `session_token` varchar(200) DEFAULT NULL,
  `type` enum('admin','staff') NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `image`, `password`, `salt`, `session_token`, `type`) VALUES
(1, 'Handog Resort', 'handogresortandeventsplace2017@gmail.com', NULL, '$2y$10$jwN82I3FN1TLA1HkyzG6q.0n/L/HwhL7KscuW7JyNA/Ain9y1Lrqa', '8d6d06c6db37ae1c8d85', '$2y$10$c6s3TkL1WXMvdSEsR.lv0ex8sUVrqgP4BjXIxsYzoDVHZsRQUy9gi', 'admin'),
(3, 'Taki Fimito', 'taki@gmail.com', 'uploads/images/690b97f142ae6_user-6.jpg', '$2y$10$zGG28ZLNG7uPR.xVtUJs5uxBWgkImEDl3bXIrB8frT1rBz7AMj5n2', '63d245335938eec0136d', NULL, 'staff'),
(4, 'Tafi Fimito', 'tafi@gmail.com', 'uploads/images/690b9812ea878_user-4.jpg', '$2y$10$/IvWULzTu3XYrw4TU0UYbeTvKF24zKqOipe61PKgxC0HwbHXfaweu', '16d1de68659904d42b1d', NULL, 'admin');

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
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_ibfk_1` (`reservation_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_facilities`
--
ALTER TABLE `promo_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_id` (`promo_id`),
  ADD KEY `facility_id` (`facility_id`);

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
-- Indexes for table `st_logos`
--
ALTER TABLE `st_logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_rates`
--
ALTER TABLE `st_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_terms_conditions`
--
ALTER TABLE `st_terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `facility_images`
--
ALTER TABLE `facility_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promo_facilities`
--
ALTER TABLE `promo_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation_guests`
--
ALTER TABLE `reservation_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `st_logos`
--
ALTER TABLE `st_logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `st_rates`
--
ALTER TABLE `st_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `st_terms_conditions`
--
ALTER TABLE `st_terms_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `gallery_images_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promo_facilities`
--
ALTER TABLE `promo_facilities`
  ADD CONSTRAINT `promo_facilities_ibfk_1` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promo_facilities_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

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
