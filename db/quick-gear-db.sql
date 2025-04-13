-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 11:27 PM
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
-- Database: `quick-gear-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `message` text DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `product_id`, `full_name`, `email`, `phone`, `start_date`, `end_date`, `message`, `booking_date`, `status`) VALUES
(5, 2, 2, 'priyanshu', 'priyanshu@example.in', '9876543211', '2025-03-05', '2025-03-10', 'Weekend gaming session with friends', '2025-02-26 18:30:00', 'confirmed'),
(6, 2, 4, 'priyanshu', 'priyanshu@example.in', '9876543211', '2025-02-19', '2025-02-23', 'Need drone for sister\'s wedding shoot', '2025-03-10 18:30:00', 'pending'),
(7, 2, 6, 'priyanshu', 'priyanshu@example.in', '9876543211', '2025-01-20', '2025-01-25', 'Christmas decoration lighting setup', '2025-01-15 18:30:00', 'pending'),
(8, 3, 1, 'kiran', 'kiran@example.in', '9876543212', '2024-11-06', '2024-11-08', 'Photography project for college assignment', '2024-11-02 18:30:00', 'completed'),
(9, 3, 3, 'kiran', 'kiran@example.in', '9876543212', '2025-01-22', '2025-01-26', 'Birthday party DJ setup', '2025-01-18 18:30:00', 'confirmed'),
(10, 3, 5, 'kiran', 'kiran@example.in', '9876543212', '2025-01-10', '2025-01-13', 'Power backup for home event', '2025-01-04 18:30:00', 'cancelled'),
(11, 3, 7, 'kiran', 'kiran@example.in', '9876543212', '2024-12-31', '2025-01-05', 'Garden maintenance at new house', '2024-12-24 18:30:00', 'cancelled'),
(12, 4, 2, 'varun', 'varun@example.in', '9876543213', '2024-11-07', '2024-11-11', 'Gaming night with colleagues', '2024-10-31 18:30:00', 'pending'),
(13, 4, 4, 'varun', 'varun@example.in', '9876543213', '2024-10-04', '2024-10-08', 'Drone footage for travel vlog', '2024-09-24 18:30:00', 'completed'),
(14, 4, 6, 'varun', 'varun@example.in', '9876543213', '2024-12-12', '2024-12-13', 'Product photography lighting', '2024-12-02 18:30:00', 'confirmed'),
(15, 4, 1, 'varun', 'varun@example.in', '9876543213', '2025-02-03', '2025-02-08', 'Wildlife photography trip', '2025-01-27 18:30:00', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_type` varchar(20) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `features` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `price`, `price_type`, `deposit`, `status`, `image`, `features`) VALUES
(1, 'DSLR Camera', 'tech', 'Professional Canon 5D Mark IV with lens kit', 999.00, 'day', 2500.00, 'available', './data/products/canon_camera_with_lens_kit.png', '4K Video, 30.4MP, Dual Pixel AF'),
(2, 'PlayStation 5', 'tech', 'Gaming console with 2 controllers and 3 games', 499.00, 'day', 1500.00, 'coming_soon', './data/products/ps5_with_controller.png', '2 Controllers, 3 Games Included, 4K Gaming'),
(3, 'Professional DJ Setup', 'events', 'Complete DJ system with speakers and lights', 2500.00, 'day', 5500.00, 'available', './data/products/professional_dj_setup_with_lights_and_speakers.png', '2000W Speakers, DMX Lights, Pioneer Controller'),
(4, 'Drone with 4K Camera', 'tech', 'DJI Mavic Air 2 with extra batteries', 1500.00, 'day', 2000.00, 'rented', './data/products/drone_with_extra_batteries.png', '4K 60fps, 48MP Photos, 34min Flight Time'),
(5, 'Power Generator', 'tools', '5500W Portable Generator', 800.00, 'day', 2100.00, 'available', './data/products/portable_generator.png', '5500W Output, Low Noise, Fuel Efficient'),
(6, 'Professional Lighting Kit', 'events', 'Studio lighting setup with softboxes', 1200.00, 'day', 3000.00, 'coming_soon', './data/products/professional_studio_light_with_soft_lights.png', '3-Point Setup, LED Panels, Wireless Control'),
(7, 'Heavy Duty Lawn Mower', 'tools', 'Professional grade gas-powered mower', 600.00, 'day', 1200.00, 'available', './data/products/heavy_duty_lawn_mower.png', 'Self-Propelled, 21-inch Deck, Mulching Capable');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `user_id`, `product_id`, `rating`, `review_text`, `created_at`) VALUES
(1, 13, 4, 4, 3, 'Thanks, Good Product btw!', '2025-04-11 07:51:00'),
(2, 8, 3, 1, 4, 'Loved it :>)', '2025-04-11 08:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `role`, `created_at`, `updated_at`) VALUES
(1, 'm4vi', 'admin@quickgear.in', 'm4vi01', NULL, 'admin', '2024-12-31 18:30:00', '2024-12-31 18:30:00'),
(2, 'Priyanshu', 'priyanshu@example.in', 'pass123', '9876543211', 'user', '2025-03-31 12:47:05', '2025-04-11 08:36:54'),
(3, 'Kiran', 'kiran@example.in', 'pass123', '9876543212', 'user', '2025-03-31 12:47:05', '2025-04-11 08:25:42'),
(4, 'Varun', 'varun@example.in', 'pass123', '9876543213', 'user', '2025-03-31 12:47:05', '2025-04-11 08:26:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bookings_product` (`product_id`),
  ADD KEY `fk_bookings_user` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;