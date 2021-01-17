-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 17, 2021 at 04:07 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`) VALUES
(1, 17, 3, 'dd'),
(2, 17, 2, 'ff'),
(3, 17, 1, 'ff'),
(4, 17, 1, 'vvv'),
(5, 17, 1, 'gg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(4, 17, 3),
(5, 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` int NOT NULL DEFAULT '0',
  `likes` int NOT NULL DEFAULT '0',
  `like_nbr` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `create_at`, `comments`, `likes`, `like_nbr`) VALUES
(1, 16, 'first post', 'https://images.pexels.com/photos/3989578/pexels-photo-3989578.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', '2020-12-24 14:11:22', 0, 0, 0),
(2, 16, 'tree', 'https://images.pexels.com/photos/1669072/pexels-photo-1669072.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '2021-01-03 03:35:22', 0, 0, 1),
(3, 16, 'shower', 'https://images.pexels.com/photos/4155490/pexels-photo-4155490.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '2021-01-03 03:35:46', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'https://www.washingtonfirechiefs.com/Portals/20/EasyDNNnews/3584/img-blank-profile-picture-973460_1280.png',
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `profile_img`, `password`, `token`, `create_date`, `verified`) VALUES
(3, 'test1', 'test@gmail.com', 'test1', 'https://www.washingtonfirechiefs.com/Portals/20/EasyDNNnews/3584/img-blank-profile-picture-973460_1280.png', '$2y$10$pW0B/Xrgz2iIyeDXO84A5eByIkEBSbkWlMVk0Fk6PkRiDJxbhRA3e', '6b889e0b32e63cca347395bdb4321ede', '2021-01-02 02:34:34', 0),
(16, 'jef', 'izweansh@effobe.com', 'jef1', 'https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '$2y$10$ZJHSTqBgNELj.alKEbKnr.J3T2RJ2T8/qQnSxP3oav6e8/2.6pBaK', 'd2bec12ee3396b65852f66a6022ee691', '2021-01-03 03:33:13', 1),
(17, 'sisok mi7fada', 'petexa9190@majorsww.com', 'sisok1', 'https://www.washingtonfirechiefs.com/Portals/20/EasyDNNnews/3584/img-blank-profile-picture-973460_1280.png', '$2y$10$NtSN1D1en0395lmjFbULyut7LBMWUfpDm0rjaOozePn.WHU7TJQFi', '7f65ea8750e2b380dab4e662898b0ee7', '2021-01-17 14:19:06', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
