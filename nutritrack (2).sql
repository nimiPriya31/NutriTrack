-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 09:37 AM
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
-- Database: `nutritrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(0, 'sadi', 'sudip@btd.gov', '$2y$10$t5Jf8cC.txRbq.U52QQ/p.WsxENfJpjOaSj/WHaQOGlZclacCl/ZO'),
(2, 'pritom', 'pritom@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(7, 'mahdi', 'mahdi@gmail.com', 'eita onk valo project i am very happy about the wbesite .let me connect to your main index file\r\n', '2024-12-03 14:21:38'),
(8, 'ABU BOKOR', 'admin@admin.com', 'e23rw4e5r6tk7ylukjhgrefrtyulgi;oh&#039;;ulykjthrgefgthyuio;iulkyjtrhgef', '2024-12-10 06:27:41'),
(9, 'ABU BOKOR', 'admin@admin.com', 'e23rw4e5r6tk7ylukjhgrefrtyulgi;oh&#039;;ulykjthrgefgthyuio;iulkyjtrhgef', '2024-12-10 06:28:31'),
(10, 'pritom dam', 'pritom@gmail.com', 'gyuighyui', '2025-01-10 20:04:31'),
(11, 'sadi', 'singhosudip333@gmail.com', '456345435', '2025-01-10 20:05:10'),
(12, 'abu', 'admin@gmail.com', 'hgersdyhdfyh345w', '2025-01-10 20:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(20) UNSIGNED NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `food_type` varchar(100) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `calories` decimal(10,2) DEFAULT NULL,
  `protein` decimal(10,2) DEFAULT NULL,
  `carbohydrates` decimal(10,2) DEFAULT NULL,
  `fat` decimal(10,2) DEFAULT NULL,
  `fiber` decimal(10,2) DEFAULT NULL,
  `sugar` decimal(10,2) DEFAULT NULL,
  `cholesterol` decimal(10,2) DEFAULT NULL,
  `sodium` decimal(10,2) DEFAULT NULL,
  `vitamin_c` decimal(10,2) DEFAULT NULL,
  `iron` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `category`, `food_type`, `image_url`, `calories`, `protein`, `carbohydrates`, `fat`, `fiber`, `sugar`, `cholesterol`, `sodium`, `vitamin_c`, `iron`, `created_at`, `updated_at`) VALUES
(6, 'Crab', 'Beverage', 'Snacks', '../../uploads/crab.jpg', 362.00, 27.00, 73.00, 11.00, 4.00, 19.00, 90.00, 40.00, 53.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(7, 'Sweet Potato', 'Vegetarian', 'Grains', '../../uploads/sweet_potato.jpg', 182.00, 29.00, 6.00, 3.00, 7.00, 10.00, 63.00, 190.00, 100.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(8, 'Beetroot', 'Gluten-Free', 'Proteins', '../../uploads/beetroot.jpg', 154.00, 3.00, 91.00, 17.00, 5.00, 16.00, 79.00, 268.00, 56.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(9, 'Fish', 'Gluten-Free', 'Proteins', '../../uploads/fish.jpg', 329.00, 7.00, 42.00, 18.00, 2.00, 8.00, 92.00, 75.00, 69.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(10, 'Almonds', 'Gluten-Free', 'Snacks', '../../uploads/almonds.jpg', 254.00, 16.00, 76.00, 5.00, 0.00, 16.00, 70.00, 478.00, 67.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(11, 'Cheese', 'Dessert', 'Dairy', '../../uploads/cheese.jpg', 199.00, 3.00, 43.00, 7.00, 3.00, 20.00, 72.00, 243.00, 79.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(12, 'Zucchini', 'Beverage', 'Dairy', '../../uploads/zucchini.jpg', 387.00, 23.00, 98.00, 14.00, 0.00, 15.00, 86.00, 257.00, 13.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(13, 'Rice', 'Beverage', 'Snacks', '../../uploads/rice.jpg', 287.00, 2.00, 69.00, 16.00, 6.00, 19.00, 41.00, 178.00, 24.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(14, 'Carrot', 'Gluten-Free', 'Dairy', '../../uploads/carrot.jpg', 474.00, 5.00, 7.00, 5.00, 6.00, 0.00, 95.00, 413.00, 78.00, 5.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(15, 'Almonds', 'Gluten-Free', 'Dairy', '../../uploads/almonds.jpg', 339.00, 30.00, 88.00, 10.00, 0.00, 11.00, 58.00, 155.00, 81.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(16, 'Fish', 'Dessert', 'Fruits', '../../uploads/fish.jpg', 204.00, 24.00, 62.00, 1.00, 10.00, 15.00, 69.00, 15.00, 18.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(17, 'Cauliflower', 'Dessert', 'Dairy', '../../uploads/cauliflower.jpg', 215.00, 27.00, 95.00, 14.00, 9.00, 5.00, 25.00, 434.00, 22.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(18, 'Pasta', 'Vegetarian', 'Vegetables', '../../uploads/pasta.jpg', 172.00, 10.00, 94.00, 11.00, 9.00, 18.00, 72.00, 214.00, 89.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(19, 'Pork', 'Dessert', 'Proteins', '../../uploads/pork.jpg', 113.00, 22.00, 45.00, 17.00, 9.00, 14.00, 75.00, 6.00, 20.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(20, 'Potato', 'Gluten-Free', 'Vegetables', '../../uploads/potato.jpg', 418.00, 13.00, 82.00, 8.00, 3.00, 13.00, 27.00, 407.00, 40.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(21, 'Apple', 'Vegetarian', 'Grains', '../../uploads/apple.jpg', 378.00, 22.00, 93.00, 17.00, 1.00, 7.00, 66.00, 430.00, 70.00, 5.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(22, 'Rice', 'Vegetarian', 'Dairy', '../../uploads/rice.jpg', 195.00, 26.00, 62.00, 10.00, 3.00, 11.00, 90.00, 20.00, 45.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(23, 'Bell Pepper', 'Non-Vegetarian', 'Proteins', '../../uploads/bell_pepper.jpg', 282.00, 4.00, 89.00, 2.00, 4.00, 4.00, 71.00, 279.00, 64.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(24, 'Corn', 'Beverage', 'Grains', '../../uploads/corn.jpg', 370.00, 20.00, 26.00, 2.00, 3.00, 6.00, 81.00, 448.00, 97.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(25, 'Orange', 'Gluten-Free', 'Grains', '../../uploads/orange.jpg', 355.00, 27.00, 32.00, 13.00, 4.00, 15.00, 95.00, 135.00, 65.00, 0.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(26, 'Radish', 'Beverage', 'Dairy', '../../uploads/radish.jpg', 426.00, 13.00, 43.00, 6.00, 4.00, 17.00, 83.00, 59.00, 33.00, 5.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(27, 'Garlic', 'Beverage', 'Proteins', '../../uploads/garlic.jpg', 342.00, 24.00, 43.00, 14.00, 2.00, 2.00, 44.00, 19.00, 49.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(28, 'Grapes', 'Vegetarian', 'Vegetables', '../../uploads/grapes.jpg', 286.00, 13.00, 42.00, 19.00, 5.00, 6.00, 65.00, 314.00, 5.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(29, 'Pasta', 'Beverage', 'Proteins', '../../uploads/pasta.jpg', 60.00, 3.00, 2.00, 8.00, 1.00, 9.00, 7.00, 344.00, 78.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(30, 'Onion', 'Vegan', 'Dairy', '../../uploads/onion.jpg', 74.00, 23.00, 88.00, 17.00, 6.00, 3.00, 97.00, 457.00, 46.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(31, 'Lentils', 'Gluten-Free', 'Dairy', '../../uploads/lentils.jpg', 77.00, 30.00, 16.00, 1.00, 6.00, 7.00, 31.00, 401.00, 92.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(32, 'Oats', 'Dessert', 'Snacks', '../../uploads/oats.jpg', 435.00, 12.00, 95.00, 20.00, 0.00, 15.00, 11.00, 296.00, 70.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(33, 'Asparagus', 'Dessert', 'Fruits', '../../uploads/asparagus.jpg', 100.00, 30.00, 97.00, 19.00, 9.00, 11.00, 12.00, 136.00, 17.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(34, 'Pumpkin', 'Vegetarian', 'Dairy', '../../uploads/pumpkin.jpg', 249.00, 10.00, 20.00, 20.00, 5.00, 16.00, 30.00, 311.00, 63.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(35, 'Corn', 'Beverage', 'Snacks', '../../uploads/corn.jpg', 112.00, 22.00, 53.00, 9.00, 7.00, 6.00, 11.00, 410.00, 92.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(36, 'Kale', 'Beverage', 'Grains', '../../uploads/kale.jpg', 379.00, 15.00, 100.00, 4.00, 8.00, 6.00, 52.00, 278.00, 11.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(37, 'Cheese', 'Gluten-Free', 'Snacks', '../../uploads/cheese.jpg', 264.00, 2.00, 22.00, 5.00, 9.00, 8.00, 39.00, 109.00, 79.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(38, 'Salmon', 'Vegan', 'Grains', '../../uploads/salmon.jpg', 280.00, 15.00, 68.00, 1.00, 3.00, 8.00, 89.00, 178.00, 63.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(39, 'Brussels Sprouts', 'Beverage', 'Vegetables', '../../uploads/brussels_sprouts.jpg', 122.00, 17.00, 95.00, 4.00, 6.00, 13.00, 44.00, 316.00, 4.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(40, 'Broccoli', 'Gluten-Free', 'Proteins', '../../uploads/broccoli.jpg', 61.00, 8.00, 21.00, 4.00, 9.00, 6.00, 71.00, 190.00, 52.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(41, 'Rice', 'Dessert', 'Snacks', '../../uploads/rice.jpg', 482.00, 29.00, 91.00, 11.00, 4.00, 14.00, 5.00, 30.00, 30.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(42, 'Kale', 'Vegetarian', 'Snacks', '../../uploads/kale.jpg', 473.00, 24.00, 9.00, 4.00, 8.00, 12.00, 49.00, 244.00, 27.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(43, 'Bell Pepper', 'Non-Vegetarian', 'Fruits', '../../uploads/bell_pepper.jpg', 429.00, 17.00, 41.00, 8.00, 1.00, 1.00, 55.00, 72.00, 60.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(44, 'Strawberry', 'Dessert', 'Proteins', '../../uploads/strawberry.jpg', 311.00, 14.00, 34.00, 5.00, 10.00, 20.00, 66.00, 174.00, 13.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(45, 'Brussels Sprouts', 'Vegetarian', 'Dairy', '../../uploads/brussels_sprouts.jpg', 461.00, 28.00, 50.00, 16.00, 8.00, 19.00, 10.00, 360.00, 95.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(46, 'Beetroot', 'Beverage', 'Grains', '../../uploads/beetroot.jpg', 155.00, 14.00, 19.00, 13.00, 9.00, 0.00, 87.00, 491.00, 58.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(47, 'Cheese', 'Vegan', 'Dairy', '../../uploads/cheese.jpg', 118.00, 19.00, 53.00, 4.00, 4.00, 9.00, 91.00, 490.00, 20.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(48, 'Strawberry', 'Vegan', 'Snacks', '../../uploads/strawberry.jpg', 309.00, 1.00, 54.00, 16.00, 6.00, 10.00, 45.00, 201.00, 71.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(49, 'Chicken Breast', 'Gluten-Free', 'Proteins', '../../uploads/chicken_breast.jpg', 229.00, 26.00, 52.00, 9.00, 5.00, 1.00, 87.00, 228.00, 17.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(50, 'Tofu', 'Dessert', 'Vegetables', '../../uploads/tofu.jpg', 431.00, 27.00, 58.00, 15.00, 6.00, 0.00, 16.00, 335.00, 59.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(51, 'Tofu', 'Vegan', 'Fruits', '../../uploads/tofu.jpg', 182.00, 4.00, 98.00, 7.00, 7.00, 14.00, 7.00, 280.00, 71.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(52, 'Peach', 'Non-Vegetarian', 'Proteins', '../../uploads/peach.jpg', 388.00, 1.00, 95.00, 10.00, 7.00, 14.00, 62.00, 438.00, 77.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(53, 'Celery', 'Vegan', 'Fruits', '../../uploads/celery.jpg', 307.00, 24.00, 84.00, 2.00, 8.00, 5.00, 81.00, 110.00, 56.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(54, 'Sweet Potato', 'Non-Vegetarian', 'Dairy', '../../uploads/sweet_potato.jpg', 194.00, 5.00, 5.00, 19.00, 9.00, 10.00, 54.00, 137.00, 100.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(55, 'Blueberry', 'Vegan', 'Snacks', '../../uploads/blueberry.jpg', 85.00, 20.00, 28.00, 12.00, 4.00, 4.00, 7.00, 235.00, 77.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(56, 'Brussels Sprouts', 'Non-Vegetarian', 'Proteins', '../../uploads/brussels_sprouts.jpg', 253.00, 17.00, 70.00, 20.00, 9.00, 12.00, 46.00, 146.00, 51.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(57, 'Carrot', 'Gluten-Free', 'Proteins', '../../uploads/carrot.jpg', 477.00, 28.00, 76.00, 3.00, 6.00, 15.00, 47.00, 303.00, 76.00, 0.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(58, 'Cabbage', 'Non-Vegetarian', 'Dairy', '../../uploads/cabbage.jpg', 366.00, 2.00, 17.00, 14.00, 7.00, 16.00, 69.00, 246.00, 91.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(59, 'Banana', 'Beverage', 'Snacks', '../../uploads/banana.jpg', 263.00, 16.00, 4.00, 10.00, 7.00, 13.00, 30.00, 466.00, 36.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(60, 'Pumpkin', 'Vegetarian', 'Snacks', '../../uploads/pumpkin.jpg', 156.00, 5.00, 12.00, 1.00, 4.00, 11.00, 7.00, 36.00, 4.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(61, 'Salmon', 'Vegetarian', 'Dairy', '../../uploads/salmon.jpg', 382.00, 22.00, 56.00, 8.00, 3.00, 10.00, 84.00, 210.00, 17.00, 5.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(62, 'Kale', 'Dessert', 'Vegetables', '../../uploads/kale.jpg', 340.00, 21.00, 50.00, 7.00, 2.00, 3.00, 40.00, 73.00, 22.00, 0.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(63, 'Peach', 'Dessert', 'Dairy', '../../uploads/peach.jpg', 283.00, 15.00, 50.00, 1.00, 4.00, 18.00, 59.00, 293.00, 87.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(64, 'Orange', 'Vegetarian', 'Fruits', '../../uploads/orange.jpg', 431.00, 14.00, 57.00, 7.00, 10.00, 20.00, 78.00, 87.00, 37.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(65, 'Peach', 'Vegan', 'Snacks', '../../uploads/peach.jpg', 424.00, 25.00, 39.00, 8.00, 2.00, 10.00, 45.00, 285.00, 86.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(66, 'Salmon', 'Beverage', 'Fruits', '../../uploads/salmon.jpg', 181.00, 7.00, 83.00, 10.00, 10.00, 2.00, 51.00, 289.00, 83.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(67, 'Peas', 'Dessert', 'Vegetables', '../../uploads/peas.jpg', 236.00, 17.00, 48.00, 13.00, 5.00, 9.00, 43.00, 44.00, 65.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(68, 'Beetroot', 'Gluten-Free', 'Grains', '../../uploads/beetroot.jpg', 383.00, 8.00, 74.00, 14.00, 0.00, 16.00, 72.00, 0.00, 71.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(69, 'Lentils', 'Beverage', 'Fruits', '../../uploads/lentils.jpg', 173.00, 14.00, 67.00, 15.00, 0.00, 12.00, 13.00, 359.00, 45.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(70, 'Kale', 'Vegetarian', 'Fruits', '../../uploads/kale.jpg', 79.00, 6.00, 86.00, 2.00, 8.00, 18.00, 0.00, 500.00, 55.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(71, 'Oats', 'Vegan', 'Snacks', '../../uploads/oats.jpg', 146.00, 11.00, 48.00, 6.00, 7.00, 8.00, 16.00, 222.00, 59.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(72, 'Zucchini', 'Non-Vegetarian', 'Vegetables', '../../uploads/zucchini.jpg', 202.00, 12.00, 66.00, 15.00, 2.00, 4.00, 67.00, 41.00, 4.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(73, 'Broccoli', 'Beverage', 'Vegetables', '../../uploads/broccoli.jpg', 206.00, 7.00, 90.00, 4.00, 4.00, 7.00, 55.00, 348.00, 27.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(74, 'Blueberry', 'Dessert', 'Dairy', '../../uploads/blueberry.jpg', 152.00, 5.00, 70.00, 15.00, 5.00, 14.00, 90.00, 257.00, 85.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(75, 'Mushroom', 'Gluten-Free', 'Grains', '../../uploads/mushroom.jpg', 340.00, 20.00, 94.00, 3.00, 3.00, 18.00, 99.00, 132.00, 27.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(76, 'Carrot', 'Dessert', 'Vegetables', '../../uploads/carrot.jpg', 56.00, 20.00, 85.00, 19.00, 3.00, 4.00, 7.00, 289.00, 49.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(77, 'Almonds', 'Vegan', 'Fruits', '../../uploads/almonds.jpg', 278.00, 3.00, 95.00, 4.00, 6.00, 20.00, 1.00, 361.00, 53.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(78, 'Tomato', 'Vegan', 'Proteins', '../../uploads/tomato.jpg', 444.00, 30.00, 39.00, 14.00, 10.00, 3.00, 58.00, 350.00, 71.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(79, 'Blueberry', 'Gluten-Free', 'Snacks', '../../uploads/blueberry.jpg', 359.00, 10.00, 52.00, 7.00, 1.00, 1.00, 5.00, 289.00, 50.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(80, 'Artichoke', 'Vegan', 'Dairy', '../../uploads/artichoke.jpg', 236.00, 2.00, 74.00, 8.00, 6.00, 18.00, 94.00, 439.00, 13.00, 5.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(81, 'Peach', 'Vegetarian', 'Dairy', '../../uploads/peach.jpg', 289.00, 5.00, 50.00, 20.00, 2.00, 9.00, 82.00, 497.00, 43.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(82, 'Corn', 'Non-Vegetarian', 'Grains', '../../uploads/corn.jpg', 468.00, 3.00, 78.00, 9.00, 2.00, 3.00, 82.00, 415.00, 87.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(83, 'Lentils', 'Gluten-Free', 'Vegetables', '../../uploads/lentils.jpg', 191.00, 30.00, 1.00, 17.00, 9.00, 2.00, 30.00, 478.00, 4.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(84, 'Yogurt', 'Non-Vegetarian', 'Snacks', '../../uploads/yogurt.jpg', 483.00, 17.00, 85.00, 20.00, 2.00, 5.00, 43.00, 421.00, 68.00, 2.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(85, 'Strawberry', 'Non-Vegetarian', 'Snacks', '../../uploads/strawberry.jpg', 135.00, 11.00, 74.00, 19.00, 8.00, 7.00, 30.00, 55.00, 37.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(86, 'Peach', 'Dessert', 'Snacks', '../../uploads/peach.jpg', 488.00, 10.00, 99.00, 4.00, 3.00, 7.00, 37.00, 414.00, 46.00, 5.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(87, 'Pasta', 'Vegetarian', 'Fruits', '../../uploads/pasta.jpg', 411.00, 27.00, 80.00, 15.00, 4.00, 15.00, 39.00, 466.00, 86.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(88, 'Tomato', 'Dessert', 'Snacks', '../../uploads/tomato.jpg', 406.00, 15.00, 56.00, 13.00, 0.00, 19.00, 10.00, 286.00, 7.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(89, 'Tomato', 'Dessert', 'Dairy', '../../uploads/tomato.jpg', 182.00, 16.00, 65.00, 8.00, 3.00, 8.00, 87.00, 402.00, 89.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(90, 'Blueberry', 'Gluten-Free', 'Proteins', '../../uploads/blueberry.jpg', 274.00, 6.00, 44.00, 5.00, 4.00, 4.00, 87.00, 294.00, 24.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(91, 'Yogurt', 'Vegetarian', 'Dairy', '../../uploads/yogurt.jpg', 275.00, 15.00, 10.00, 14.00, 6.00, 1.00, 34.00, 372.00, 86.00, 10.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(92, 'Onion', 'Non-Vegetarian', 'Vegetables', '../../uploads/onion.jpg', 411.00, 18.00, 88.00, 16.00, 9.00, 2.00, 89.00, 402.00, 34.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(93, 'Yogurt', 'Gluten-Free', 'Dairy', '../../uploads/yogurt.jpg', 76.00, 2.00, 17.00, 13.00, 1.00, 2.00, 15.00, 317.00, 88.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(94, 'Oats', 'Vegan', 'Dairy', '../../uploads/oats.jpg', 156.00, 23.00, 94.00, 3.00, 2.00, 20.00, 18.00, 28.00, 14.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(95, 'Celery', 'Dessert', 'Vegetables', '../../uploads/celery.jpg', 492.00, 21.00, 78.00, 8.00, 10.00, 10.00, 92.00, 98.00, 15.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(96, 'Beetroot', 'Gluten-Free', 'Proteins', '../../uploads/beetroot.jpg', 51.00, 27.00, 64.00, 11.00, 6.00, 9.00, 73.00, 497.00, 83.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(97, 'Onion', 'Beverage', 'Fruits', '../../uploads/onion.jpg', 266.00, 19.00, 4.00, 10.00, 5.00, 4.00, 72.00, 382.00, 59.00, 0.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(98, 'Blueberry', 'Non-Vegetarian', 'Snacks', '../../uploads/blueberry.jpg', 415.00, 28.00, 84.00, 16.00, 10.00, 16.00, 96.00, 464.00, 14.00, 8.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(99, 'Kale', 'Gluten-Free', 'Dairy', '../../uploads/kale.jpg', 233.00, 11.00, 41.00, 4.00, 5.00, 11.00, 39.00, 4.00, 46.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(100, 'Blueberry', 'Dessert', 'Fruits', '../../uploads/blueberry.jpg', 383.00, 14.00, 71.00, 10.00, 10.00, 15.00, 46.00, 118.00, 91.00, 1.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(101, 'Cauliflower', 'Non-Vegetarian', 'Snacks', '../../uploads/cauliflower.jpg', 238.00, 20.00, 38.00, 3.00, 10.00, 5.00, 22.00, 435.00, 99.00, 3.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(102, 'Zucchini', 'Dessert', 'Proteins', '../../uploads/zucchini.jpg', 190.00, 11.00, 35.00, 11.00, 4.00, 14.00, 2.00, 97.00, 93.00, 4.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(103, 'Almonds', 'Beverage', 'Dairy', '../../uploads/almonds.jpg', 176.00, 1.00, 4.00, 6.00, 6.00, 8.00, 99.00, 141.00, 66.00, 7.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(104, 'Zucchini', 'Vegan', 'Fruits', '../../uploads/zucchini.jpg', 344.00, 5.00, 3.00, 8.00, 1.00, 15.00, 41.00, 439.00, 23.00, 9.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(105, 'Cucumber', 'Beverage', 'Proteins', '../../uploads/cucumber.jpg', 157.00, 6.00, 63.00, 18.00, 8.00, 6.00, 19.00, 140.00, 61.00, 6.00, '2025-01-10 09:16:38', '2025-01-10 09:16:38'),
(106, 'abu', 'Vegetarian', 'Fruits', '../../uploads/1.jpg', 4156.00, 545.00, 515.00, 511.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2025-01-10 10:37:01', '2025-01-10 10:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `food_intake`
--

CREATE TABLE `food_intake` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `intake_date` date NOT NULL,
  `day_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_intake`
--

INSERT INTO `food_intake` (`id`, `user_id`, `food_id`, `quantity`, `intake_date`, `day_name`) VALUES
(1, 13, 6, 2.00, '2025-01-12', ''),
(2, 13, 7, 5.00, '2025-01-12', ''),
(3, 13, 8, 5.00, '2025-01-12', ''),
(4, 13, 10, 10.00, '2025-01-12', 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `created_at`) VALUES
(1, '', 'test', 'test@test.com', '$2y$10$y3WHnGe7O4kCiSMnXDm9k.UEhtSEviLBlFdJgGyRFidDEJnIEdBMK', '2024-12-03 06:20:55'),
(3, '', 'asd', 'a@a.com', '$2y$10$iQPxTDF/PLYOhJqRoJMxO.vZkaqVzjkS3JtzmSKRgiWsScBlhgKWi', '2024-12-03 07:29:36'),
(5, '', 'asd', 'asd@g.com', '$2y$10$g3VlpW9M12SI6MatBK.QSOLGhLsQ3FIAkk1wC5z43qPpIDl5iOPCO', '2024-12-03 08:18:38'),
(6, '', 'kushal', 'kus@gmai.com', '$2y$10$aTmjgfnOuHKgt3WWwxaW..sIapqi2aIRbK6QRChi1eoaNKFkMlSxm', '2024-12-03 13:55:59'),
(7, '', 'kushu', 'kusal@gmai.com', '$2y$10$zKuL0NJy3fn1fNR0ld3LL.UEZbOg8Zs1UY9Jsl9KkDAn9vRP/dkIi', '2024-12-03 13:59:07'),
(8, '', 'kushu', 'bokor@gmil.com', '$2y$10$/adqV.VhbM6Wb.QsBO4WKOacOgKFocaGAN/s10DI9UnKX0Z7onEnO', '2024-12-03 14:02:01'),
(9, '', 'mahdi', 'mahdi@gmail.com', '$2y$10$TWTvXLHQBDqRyI1B0JvOROGMIi0yMBPfT265rdYsuNYDec8PQ05v.', '2024-12-03 14:17:55'),
(10, '', 'kushal', 'kushal@gmail.com', '$2y$10$J2y2k6uDPKUKrUf7Z3yTUekTdqVSOXXCoKv5Qz6HCkqPEYJy1Mr1q', '2024-12-05 05:26:11'),
(11, '', 'admin', 'bokorofficial2270@gmail.com', '$2y$10$D/k6Ea38vJV1vs/oiLhWK.wqEWQdx2kDFYJj/moHFGUMsN4YVPx6q', '2024-12-10 06:25:22'),
(13, 'pritom dam', 'pritom', 'pritom@gmail.com', '$2y$10$AN3b6gpk6zTiGvzMylKft.297XYrr4ncqxdxdbZja4HAgWn9899Uu', '2025-01-09 10:16:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_intake`
--
ALTER TABLE `food_intake`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `food` (`food_id`);

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
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `food_intake`
--
ALTER TABLE `food_intake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_intake`
--
ALTER TABLE `food_intake`
  ADD CONSTRAINT `food` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
