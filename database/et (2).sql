-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2023 at 09:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `et`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `department`, `password`) VALUES
(1, 'mos', 'moshiur.mos@gmail.com', 'cse', '$2y$10$m.uS8Ukcu/VqHvlxhuEGmeBH0uoKVrUkDBJVe3uIGObcSv2Hy.MUW'),
(2, 'admin', 'admin@admin.com', 'cse', '$2y$10$D/ixSJrOqd77.Zh3SFLbuOLbs8J/fM3y7iFFb6jxgKfGgkGWv/Dou'),
(3, 'test', 'test@gmail.com', 'cse', '$2y$10$Tn4RrhhbbA7nET5Wv64cSuIq6IFKsmu3YeRJpCNU5E40OMHIEcFum');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `photo` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` enum('entertainment','sports','food') NOT NULL,
  `description` text NOT NULL,
  `research` enum('sponsor','logo','info') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `time`, `photo`, `location`, `category`, `description`, `research`) VALUES
(3, 'Event 20', '2023-06-03', '18:00:00', 'uploads/event3.jpeg', 'Location 3', 'food', 'Description for Event 3', 'info'),
(4, 'Event 4', '2023-06-04', '10:15:00', 'uploads/event4.jpeg', 'Location 4', 'entertainment', 'Description for Event 4', 'sponsor'),
(5, 'Event 5', '2023-06-05', '16:45:00', 'uploads/event5.jpeg', 'Location 5', 'sports', 'Description for Event 5', 'logo'),
(6, 'Event 6', '2023-06-06', '11:30:00', 'uploads/event6.jpeg', 'Location 6', 'food', 'Description for Event 6', 'info'),
(7, 'Event 7', '2023-06-07', '13:20:00', 'uploads/event7.jpeg', 'Location 7', 'entertainment', 'Description for Event 7', 'sponsor'),
(8, 'Event 8', '2023-06-08', '15:10:00', 'uploads/event8.jpeg', 'Location 8', 'sports', 'Description for Event 8', 'logo'),
(9, 'Event 9', '2023-06-09', '17:30:00', 'uploads/event9.jpeg', 'Location 9', 'food', 'Description for Event 9', 'info'),
(10, 'Event 10', '2023-06-10', '19:45:00', 'uploads/event10.jpeg', 'Location 10', 'entertainment', 'Description for Event 10', 'sponsor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `department`, `photo`, `password`) VALUES
(1, 'Md Moshiur', 'Rahman', 'moshiur.mos@gmail.com', 'cse', 'uploads/k8sservice.png', '$2y$10$1nhVn.xCY05kZZvzTg00Hu3CQf/jIwJSYVOKnNYkL1fGoeMnf1x2u'),
(2, 'Md Moshiur', 'Rahman', 'romeomyname@gmail.com', 'cse', 'admin/uploads/Screenshot at Jun 13 10-28-27 pm.png', '$2y$10$maZbPWuVyjIV.6hI/Rn2DO6xwPEuC4l/YukOmaXo37Dr7HOqiD2eG'),
(3, 'Md Moshiur', 'Rahman', 'rr@gmail.com', 'sdfd', 'admin/uploads/Screenshot at Jul 22 9-52-33 pm.png', '$2y$10$EknxkQfSuf8WJuigIJSLMuzWV6oJ.3RxmUMw5CWemowvcBYfh/UI6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
