-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 04:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$gGSWJYJDaZw0fJMBkllfbeWb0I3GHV1lPr/gNttMzfxwVC5JcOgSe', 'admin@example.com', '2025-03-11 09:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE `ambulances` (
  `id` int(11) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `last_maintenance_date` date NOT NULL,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulances`
--

INSERT INTO `ambulances` (`id`, `vehicle_number`, `model`, `capacity`, `last_maintenance_date`, `is_available`) VALUES
(1, 'PB-10-000', 'Passion Plus', 2, '2025-03-01', 1),
(2, 'PB-10-5000', 'ALTO', 2, '2025-03-08', 1),
(3, 'PB-10-4000', 'Bolero', 4, '2025-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_bookings`
--

CREATE TABLE `ambulance_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ambulance_id` int(11) NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('confirmed','completed','cancelled') DEFAULT 'confirmed',
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulance_bookings`
--

INSERT INTO `ambulance_bookings` (`id`, `user_id`, `ambulance_id`, `booking_time`, `status`, `location`) VALUES
(1, 2, 1, '2025-03-11 09:55:53', 'completed', 'Lovely Professional University, NH44, फगवाड़ा, Phagwara Tahsil, कपूरथला, Punjab, 144411, India'),
(3, 1, 1, '2025-03-11 15:10:38', 'completed', 'Phagwara Tahsil, Kapurthala, Punjab, 144411, India'),
(4, 4, 1, '2025-03-13 12:45:00', 'completed', 'Phagwara Tahsil, कपूरथला, Punjab, 144411, India'),
(5, 5, 2, '2025-03-13 20:33:15', 'completed', 'Phagwara Tahsil, कपूरथला, Punjab, 144411, India'),
(6, 5, 3, '2025-03-13 20:34:33', 'completed', 'Phagwara Tahsil, कपूरथला, Punjab, 144411, India');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `doctor_id`, `fullname`, `email`, `phone`, `appointment_date`, `appointment_time`, `message`, `status`, `completed_at`, `created_at`, `updated_at`) VALUES
(3, 4, 5, 'Free Storage 1', 'freestoragetest001@gmail.com', '7739864558', '2025-03-21', '10:00:00', 'Hello', 'cancelled', NULL, '2025-03-13 12:45:24', '2025-03-13 12:45:33'),
(4, 4, 4, 'Free Storage 1', 'freestoragetest001@gmail.com', '7739864558', '2025-03-21', '14:30:00', 'hello', 'completed', '2025-03-13 12:46:20', '2025-03-13 12:46:04', '2025-03-13 12:46:20'),
(5, 1, 7, 'Meraj', 'merazhaque74663@gmail.com', '7739864558', '2025-03-20', '15:30:00', 'Hello sir', 'completed', '2025-03-17 08:38:51', '2025-03-17 08:33:51', '2025-03-17 08:38:51'),
(6, 1, 7, 'Meraj', 'pranaydeep921@gmail.com', '7739864558', '2025-03-18', '16:00:00', 'hello', 'completed', '2025-03-17 08:42:29', '2025-03-17 08:38:29', '2025-03-17 08:42:29'),
(7, 1, 7, 'Meraj', 'pranaydeep921@gmail.com', '7739864558', '2025-03-21', '10:00:00', 'hello', 'completed', '2025-03-17 08:42:36', '2025-03-17 08:42:10', '2025-03-17 08:42:36'),
(8, 3, 7, 'Merajul Haque', 'merazmz2003@gmail.com', '7739864558', '2025-03-19', '15:30:00', 'Hello', 'cancelled', NULL, '2025-03-18 08:43:11', '2025-03-18 08:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `chat_conversations`
--

CREATE TABLE `chat_conversations` (
  `id` int(11) NOT NULL,
  `conversation_id` varchar(255) NOT NULL,
  `messages` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_conversations`
--

INSERT INTO `chat_conversations` (`id`, `conversation_id`, `messages`, `created_at`) VALUES
(7, '1741898184652-b88iko74t', '[{\"content\":\"Hello I am Medi Bot! How can I assist you today?\",\"type\":\"bot\"},{\"content\":\"what is this\",\"type\":\"user\"},{\"content\":\"Please provide me with the image or describe what you\'re referring to so I can assist you with your health-related questions.\",\"type\":\"bot\"}]', '2025-03-14 02:06:24'),
(8, '1741934167483-9eorhoogl', '[{\"content\":\"Hello I am Medi Bot! How can I assist you today?\",\"type\":\"bot\"},{\"content\":\"hello\",\"type\":\"user\"},{\"content\":\"Hello! How can I help you with your health-related questions today? I\'m here to provide information and support. Let\'s work towards your well-being!\",\"type\":\"bot\"},{\"content\":\"what is this\",\"type\":\"user\"},{\"content\":\"Please provide me with the image or describe what you are referring to. I need more information to understand what \\\"this\\\" is and how it relates to your health concern. Once you provide the image or description, I\'ll do my best to assist you!\",\"type\":\"bot\"},{\"content\":\"how are you\",\"type\":\"user\"},{\"content\":\"As a medical chatbot, I\'m functioning optimally and ready to assist you with any health-related questions you may have. How can I help you today? Let\'s focus on your well-being!\",\"type\":\"bot\"}]', '2025-03-14 12:06:07'),
(9, '1742311941755-c6sdxvqud', '[{\"content\":\"Hello I am Medi Bot! How can I assist you today?\",\"type\":\"bot\"},{\"content\":\"what is avg penis size in india\",\"type\":\"user\"},{\"content\":\"I am here to assist you with health-related questions. I cannot provide information on that topic. Is there anything else I can help you with regarding healthcare?\",\"type\":\"bot\"},{\"content\":\"my penis is not ejaculating\",\"type\":\"user\"},{\"content\":\"I understand your concern. Issues with ejaculation can be complex and have various potential causes. It\'s important to consult a healthcare professional, such as a urologist, for a proper diagnosis and personalized advice. They can help determine the underlying cause and recommend the best course of action for you. Take care!\",\"type\":\"bot\"},{\"content\":\"my testicles are not producing sperm\",\"type\":\"user\"},{\"content\":\"I understand your concern. If you suspect that your testicles are not producing sperm, it\'s important to consult a healthcare professional, such as a urologist. They can conduct a thorough examination, perform necessary tests, and provide you with an accurate diagnosis and appropriate treatment options. Take care!\",\"type\":\"bot\"}]', '2025-03-18 21:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `force_password_change` tinyint(1) DEFAULT 1,
  `is_active` tinyint(1) DEFAULT 1,
  `remember_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `experience`, `rating`, `image_url`, `is_available`, `username`, `password`, `last_login`, `force_password_change`, `is_active`, `remember_token`) VALUES
(2, 'Speed Singh', 'Neurologist', '3-5 years', 2, 'https://image-cdn.essentiallysports.com/wp-content/uploads/IShowSpeed-4.png?width=900', 1, 'speedsingh2', '$2y$10$YourDefaultHashHere', NULL, 1, 1, NULL),
(3, 'Puneet Superstar', 'Cardiologist', '1-3 years', 1, 'https://im.indiatimes.in/content/2023/Jul/Untitled-design---2023-07-11T161013651_64ad31a0d2a5d.png?w=720&h=720&cc=1&webp=1&q=75', 1, 'puneetsuperstar3', '$2y$10$YourDefaultHashHere', NULL, 1, 1, NULL),
(4, 'Cat Singh Rathore', 'General Physician', '15+ years', 5, 'https://i.natgeofe.com/n/548467d8-c5f1-4551-9f58-6817a8d2c45e/NationalGeographic_2572187.jpg?w=1436&h=958', 1, 'catsinghrathore4', '$2y$10$YourDefaultHashHere', NULL, 1, 1, NULL),
(5, 'Anandrio Tate', 'Gynecologist', '3-5 years', 5, 'https://dims.apnews.com/dims4/default/c7d19f4/2147483647/strip/true/crop/3343x2229+0+0/resize/1440x960!/format/webp/quality/90/?url=https%3A%2F%2Fassets.apnews.com%2F23%2F2a%2Fc195983e0f48a7e07f43883f1803%2Fc4ddb5cfc45448f2b4827af26a565e49', 1, 'anandriotate5', '$2y$10$YourDefaultHashHere', NULL, 1, 1, NULL),
(7, 'Khalid Khasmiri', 'Dentist', '1-3 years', 5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4nKu4ASyZUcfvwTpgXyOCMbFuOJMtUjhwkw&s', 1, 'khalidkhasmiri144', '$2y$10$M53KdIRjuwz5zyee0aUhyOGzpKJstI3GFs/uxRrg/yVIrJnBV.Jee', '2025-03-17 14:03:06', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `success` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `email`, `ip_address`, `attempt_time`, `success`) VALUES
(1, 'merazhaque74663@gmail.com', '::1', '2025-03-11 09:42:11', 1),
(2, 'merazulhaque820@gmail.com', '::1', '2025-03-11 09:45:55', 1),
(3, 'merazmz2003@gmail.com', '::1', '2025-03-11 10:31:10', 1),
(4, 'merazhaque74663@gmail.com', '::1', '2025-03-11 15:08:22', 1),
(5, 'merazhaque74663@gmail.com', '::1', '2025-03-13 12:27:18', 1),
(6, 'freestoragetest001@gmail.com', '::1', '2025-03-13 12:44:53', 1),
(7, 'gmail@modi.com', '::1', '2025-03-13 20:28:55', 0),
(8, 'gmail@modi.com', '::1', '2025-03-13 20:29:04', 1),
(9, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:38:50', 0),
(10, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:38:57', 0),
(11, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:39:07', 0),
(12, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:39:19', 0),
(13, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:39:26', 0),
(14, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:39:34', 0),
(15, 'merazhaque74663@gmail.com', '::1', '2025-03-13 20:39:45', 1),
(16, 'gmail@modi.com', '::1', '2025-03-13 20:42:57', 1),
(17, 'merazhaque74663@gmail.com', '::1', '2025-03-17 08:33:28', 1),
(18, 'merazmz2003@gmail.com', '::1', '2025-03-18 08:42:15', 1),
(19, 'merazhaque74663@gmail.com', '::1', '2025-03-19 09:00:57', 1),
(20, 'merazmz2003@gmail.com', '::1', '2025-03-19 09:01:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `status` enum('active','inactive','suspended') DEFAULT 'active',
  `profile_image` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `created_at`, `updated_at`, `last_login`, `status`, `profile_image`, `reset_token`, `reset_token_expires`) VALUES
(1, 'Meraj', 'merazhaque74663@gmail.com', '$2y$10$Nu1m1.wlKNOUkeOx80l2FOgwdlEUn6Hvz84WGsKQUn9W4lux8yAxm', '2025-03-11 09:42:01', '2025-03-19 09:00:57', '2025-03-19 14:30:57', 'active', NULL, NULL, NULL),
(2, 'Meraz Mz', 'merazulhaque820@gmail.com', '$2y$10$sViuXHctqdj0V0mCt17IZe/RjkKWRkZOXtvrZvhBkpLFax2h9L4YO', '2025-03-11 09:45:55', '2025-03-11 09:45:55', NULL, 'active', 'https://lh3.googleusercontent.com/a/ACg8ocKHSDXZPL6xrmKUGAOqWjhypgP__TFbNs122Kps6dxjqFI1obTR=s96-c', NULL, NULL),
(3, 'Merajul Haque', 'merazmz2003@gmail.com', '$2y$10$wLwO7Z0G0vTntT5PqaKcredHU35JLgBfAe5BGI/OstZMKEoZ9PwEa', '2025-03-11 10:31:10', '2025-03-19 09:01:25', '2025-03-19 14:31:25', 'active', 'https://lh3.googleusercontent.com/a/ACg8ocIb2eKzEJfNPka7ld9mCv9DsOclwymFByDBn-S3cnE7UBet-Jpy=s96-c', NULL, NULL),
(4, 'Free Storage 1', 'freestoragetest001@gmail.com', '$2y$10$eb2a/aq3WS4N/q3BidKr8Oz8ebEwmtt8S1WpXZBZuLlTwNzESLmtK', '2025-03-13 12:44:53', '2025-03-13 12:44:53', NULL, 'active', 'https://lh3.googleusercontent.com/a/ACg8ocJAvCBCO5QH57KCGyIU-vGvbC4b9ZiEtzfI3jwy2ZtMpa8r5z2S=s96-c', NULL, NULL),
(5, 'Modi', 'gmail@modi.com', '$2y$10$hK57GfgvHKAgDz.Qrx7qX.7RnXCz.sqpG1ce.IxUcgVFUK6MZGHoa', '2025-03-13 20:28:43', '2025-03-13 20:42:57', '2025-03-14 02:12:57', 'active', NULL, NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_login` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    IF NEW.last_login != OLD.last_login THEN
        INSERT INTO user_activity_log (user_id, activity_type, details)
        VALUES (NEW.id, 'login', CONCAT('Login at ', NEW.last_login));
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_update` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    IF OLD.password != NEW.password THEN
        INSERT INTO user_activity_log (user_id, activity_type, details)
        VALUES (NEW.id, 'password_change', 'Password was changed');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_log`
--

CREATE TABLE `user_activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_type` enum('login','logout','password_change','profile_update','failed_login') NOT NULL,
  `activity_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activity_log`
--

INSERT INTO `user_activity_log` (`id`, `user_id`, `activity_type`, `activity_time`, `ip_address`, `details`) VALUES
(1, 1, 'login', '2025-03-11 15:08:22', NULL, 'Login at 2025-03-11 20:38:22'),
(2, 1, 'login', '2025-03-13 12:27:18', NULL, 'Login at 2025-03-13 17:57:18'),
(3, 1, 'login', '2025-03-13 20:39:45', NULL, 'Login at 2025-03-14 02:09:45'),
(4, 5, 'login', '2025-03-13 20:42:57', NULL, 'Login at 2025-03-14 02:12:57'),
(5, 1, 'login', '2025-03-17 08:33:28', NULL, 'Login at 2025-03-17 14:03:28'),
(6, 1, 'login', '2025-03-19 09:00:57', NULL, 'Login at 2025-03-19 14:30:57'),
(7, 3, 'login', '2025-03-19 09:01:25', NULL, 'Login at 2025-03-19 14:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_number` (`vehicle_number`);

--
-- Indexes for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ambulance_id` (`ambulance_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `chat_conversations`
--
ALTER TABLE `chat_conversations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conversation_id` (`conversation_id`),
  ADD KEY `conversation_id_2` (`conversation_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email_ip` (`email`,`ip_address`),
  ADD KEY `idx_attempt_time` (`attempt_time`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_updated_at` (`updated_at`);

--
-- Indexes for table `user_activity_log`
--
ALTER TABLE `user_activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id_type` (`user_id`,`activity_type`),
  ADD KEY `idx_activity_time` (`activity_time`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ambulances`
--
ALTER TABLE `ambulances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chat_conversations`
--
ALTER TABLE `chat_conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_activity_log`
--
ALTER TABLE `user_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  ADD CONSTRAINT `ambulance_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ambulance_bookings_ibfk_2` FOREIGN KEY (`ambulance_id`) REFERENCES `ambulances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activity_log`
--
ALTER TABLE `user_activity_log`
  ADD CONSTRAINT `user_activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
