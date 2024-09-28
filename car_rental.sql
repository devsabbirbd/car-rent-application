-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 05:15 PM
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
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `daily_rent_price` decimal(10,2) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `year`, `car_type`, `daily_rent_price`, `availability`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Sedan 1', 'Toyota', 'Camry', 2020, 'Sedan', 55.00, 1, 'uploads/car/14-1727268926-car_(13).jpg', '2024-09-25 00:35:43', '2024-09-24 18:55:26'),
(2, 'Sedan 2', 'Honda', 'Accord', 2021, 'Sedan', 60.00, 1, 'uploads/car/14-1727269049-car.jpg', '2024-09-25 00:35:43', '2024-09-24 18:57:29'),
(3, 'SUV 1', 'Ford', 'Explorer', 2019, 'SUV', 80.00, 1, 'uploads/car/14-1727268872-car_(4).jpg', '2024-09-25 00:35:43', '2024-09-24 18:54:32'),
(4, 'SUV 2', 'Chevrolet', 'Tahoe', 2020, 'SUV', 85.00, 1, 'uploads/car/14-1727268816-car_(3).jpg', '2024-09-25 00:35:43', '2024-09-28 08:24:57'),
(5, 'Truck 1', 'Ram', '1500', 2021, 'Truck', 90.00, 1, 'uploads/car/14-1727268785-car_(9).jpg', '2024-09-25 00:35:43', '2024-09-24 18:53:05'),
(6, 'Truck 2', 'Ford', 'F-150', 2020, 'Truck', 95.00, 1, 'uploads/car/14-1727268774-car_(16).jpg', '2024-09-25 00:35:43', '2024-09-28 09:06:11'),
(7, 'Sports 1', 'Porsche', '911', 2022, 'Sports', 200.00, 1, 'uploads/car/14-1727268767-car_(14).jpg', '2024-09-25 00:35:43', '2024-09-28 08:24:47'),
(8, 'Sports 2', 'Chevrolet', 'Corvette', 2021, 'Sports', 180.00, 1, 'uploads/car/14-1727268735-car_(11).jpg', '2024-09-25 00:35:43', '2024-09-24 18:52:15'),
(9, 'Sedan 3', 'BMW', '5 Series', 2020, 'Sedan', 70.00, 1, 'uploads/car/14-1727268712-car_(10).jpg', '2024-09-25 00:35:43', '2024-09-28 08:24:52'),
(10, 'Sedan 4', 'Audi', 'A6', 2021, 'Sedan', 75.00, 1, 'uploads/car/14-1727268699-car_(12).jpg', '2024-09-25 00:35:43', '2024-09-24 18:51:39'),
(11, 'SUV 3', 'Jeep', 'Wrangler', 2022, 'SUV', 95.00, 1, 'uploads/car/14-1727268684-car_(15).jpg', '2024-09-25 00:35:43', '2024-09-28 09:06:20'),
(12, 'SUV 4', 'Tesla', 'Model X', 2021, 'SUV', 120.00, 1, 'uploads/car/14-1727268617-car_(1).JPG', '2024-09-25 00:35:43', '2024-09-24 18:50:17'),
(13, 'Truck 3', 'Chevrolet', 'Silverado', 2020, 'Truck', 85.00, 0, 'uploads/car/14-1727268604-car_(7).jpg', '2024-09-25 00:35:43', '2024-09-28 09:04:51'),
(14, 'Truck 4', 'Toyota', 'Tundra', 2019, 'Truck', 80.00, 1, 'uploads/car/14-1727268597-car_(6).jpg', '2024-09-25 00:35:43', '2024-09-28 08:24:42'),
(15, 'Sports 3', 'Ferrari', '488', 2021, 'Sports', 250.00, 1, 'uploads/car/14-1727268582-car_(5).jpg', '2024-09-25 00:35:43', '2024-09-28 09:06:15'),
(16, 'Sports 4', 'Lamborghini', 'Huracan', 2020, 'Sports', 270.00, 1, 'uploads/car/14-1727268570-car_(3).webp', '2024-09-25 00:35:43', '2024-09-27 09:26:42'),
(17, 'Sedan 5', 'Mercedes-Benz', 'E-Class', 2019, 'Sedan', 85.00, 1, 'uploads/car/14-1727268552-car_(2).jpg', '2024-09-25 00:35:43', '2024-09-27 17:45:52'),
(18, 'SUV 5', 'Land Rover', 'Defender', 2022, 'SUV', 110.00, 0, 'uploads/car/14-1727268530-car_(1).avif', '2024-09-25 00:35:43', '2024-09-28 09:00:34'),
(19, 'Truck 5', 'Nissan', 'Titan', 2021, 'Truck', 95.00, 1, 'uploads/car/14-1727269307-car_(7).jpg', '2024-09-25 00:35:43', '2024-09-27 17:45:56'),
(20, 'Sports 5', 'Aston Martin', 'Vantage', 2022, 'Sports', 220.00, 1, 'uploads/car/14-1727269313-car_(8).jpg', '2024-09-25 00:35:43', '2024-09-28 08:06:16'),
(21, 'Future Car', 'Unknown', 'Sk-420', 2024, 'Sports', 500.98, 1, 'uploads/car/14-1727269320-maxresdefault.jpg', '2024-09-24 18:56:39', '2024-09-28 08:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_09_23_114917_create_users_table', 1),
(3, '2024_09_23_114918_create_cars_table', 1),
(4, '2024_09_23_114919_create_rentals_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Ongoing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `car_id`, `start_date`, `end_date`, `total_cost`, `status`, `created_at`, `updated_at`) VALUES
(10, 18, 11, '2024-09-28', '2024-09-30', 190.00, 'Canceled', '2024-09-28 09:00:14', '2024-09-28 09:06:20'),
(11, 18, 18, '2024-09-28', '2024-09-30', 220.00, 'Ongoing', '2024-09-28 09:00:34', '2024-09-28 09:00:34'),
(12, 18, 15, '2024-09-28', '2024-10-30', 8000.00, 'Completed', '2024-09-28 09:00:56', '2024-09-28 09:06:15'),
(13, 14, 13, '2024-09-28', '2024-09-30', 170.00, 'Ongoing', '2024-09-28 09:04:51', '2024-09-28 09:04:51'),
(14, 14, 6, '2024-09-28', '2024-10-04', 570.00, 'Completed', '2024-09-28 09:05:14', '2024-09-28 09:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `mobile`, `address`, `created_at`, `updated_at`) VALUES
(6, 'Sabbir Mondol', 'sabbirfaridpur01@gmail.com', '123', 'admin', '013', 'Faridpur', '2024-09-28 06:41:54', '2024-09-28 12:43:05'),
(11, 'Hadassah Booth', 'lasylekive@mailinator.com', 'Pa$$w0rd!', 'customer', 'Quo magna id tempori', 'Delectus magnam est', '2024-09-28 08:33:44', '2024-09-28 08:33:44'),
(12, 'Thor Waters', 'munolyr@mailinator.com', 'Pa$$w0rd!', 'customer', 'Duis ea vel consecte', 'Laborum Vero quis i', '2024-09-28 08:33:48', '2024-09-28 08:33:48'),
(13, 'Alfreda Gates', 'lozymy@mailinator.com', 'Pa$$w0rd!', 'customer', 'Ad quasi sed non ad', 'Itaque tempor quia r', '2024-09-28 08:33:51', '2024-09-28 08:33:51'),
(14, 'Callie Stevenson', 'laqod@mailinator.com', 'Pa$$w0rd!', 'customer', 'Reiciendis est est', 'Odit qui amet tempo', '2024-09-28 08:33:55', '2024-09-28 08:33:55'),
(15, 'Aurelia Whitley', 'jybusazo@mailinator.com', 'Pa$$w0rd!', 'customer', 'Quo ut maiores qui d', 'Eius consequuntur do', '2024-09-28 08:33:59', '2024-09-28 08:33:59'),
(16, 'Raphael Ramsey', 'kiked@mailinator.com', 'Pa$$w0rd!', 'customer', 'Aspernatur exercitat', 'Sit qui omnis possim', '2024-09-28 08:34:04', '2024-09-28 08:34:04'),
(17, 'Emery Welch', 'jixuho@mailinator.com', 'Pa$$w0rd!', 'customer', 'Sed provident ut to', 'Labore doloribus qua', '2024-09-28 08:34:08', '2024-09-28 08:34:08'),
(18, 'Sabbir', 'expertsabbirbd@gmail.com', '123', 'customer', '01306098088', 'Faridpur', '2024-09-28 08:36:53', '2024-09-28 08:36:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`),
  ADD KEY `rentals_car_id_foreign` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
