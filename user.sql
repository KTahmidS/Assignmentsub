-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 06:31 PM
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
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(268) NOT NULL,
  `password` varchar(268) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('19202029', '$2y$10$bc5shL2XThwtYCoImONxBu9DmXI2oQ2hBnQPZkQZr7/xbsNAHbY6q'),
('araf', 'sadat'),
('new', '$2y$10$5PGpSt.jd8rhPSJm1QVzXuFd.M6WD2WgdhqJLNhibkadnz6EKikby'),
('new10', '$2y$10$FBnxlFOzfNqburndR3SvmOkx8XWvsp7H1zPkmbBYvn1sr.rh.oOZy'),
('new2', '$2y$10$x/pvryavO.dL1xmTC4.QOOG8qiTcXtXIoi/cSwLHYQb1adRHm8iri'),
('new3', '$2y$10$9lsc9oUBYb6ewDxGAZFkc.O9prfmeXWlYj9ABm5dgzOqMST34nR82'),
('new4', '$2y$10$1hQ3BlAA2zh1l0ftU535gOM1kYd9Pn.QF6AYnC4.YW/aL6w7xNt36'),
('new5', '$2y$10$Cw45HLnPaYrUZ5GZ/6AtT.o01O60CLwQA9hcnxHlj3oyTbsH5Yofm'),
('new8', '$2y$10$iPqMkSu9ABvpOX9IOVWCu.YyikhJa/VUHOohMhoof6rTJ2vxXDZuS'),
('new9', '$2y$10$prq/wfzkfB5Lv.sner79IuWY8XiaoZS1m5E.xzeuPPKCZ6MN94Yxe'),
('Priya', '$2y$10$fES21ja995zGwCzZjrRc0OAdFy/JGmCXnJVeGjypPizpoKDgq9tUm'),
('priya2', '$2y$10$exuYppB0JZf./ZIZ/2.lV.eLeSoQKn3o4u9IY6azsC7FJipL6jE1C'),
('sadat', '$2y$10$n1rpDge4IJV/isDTDl3uQuHM9ptitkhL17g3mAtM/PkhiFzVTgWeG'),
('tahmid', '$2y$10$/XgeYpzMauPISqr0T4qFnuuFFgfJSyHwNg6X1WRh2gdLbf/UD/inm');

-- --------------------------------------------------------

--
-- Table structure for table `admin2`
--

CREATE TABLE `admin2` (
  `username` varchar(268) NOT NULL,
  `password` varchar(268) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin2`
--

INSERT INTO `admin2` (`username`, `password`, `department`) VALUES
('priya', '$2y$10$6PuoO7kerLnR92VkcL0.uOYTi0HD7t2tIcnSLHS5.rHtJT5Fqg21e', 'CSE'),
('priya2', '$2y$10$6PuoO7kerLnR92VkcL0.uOYTi0HD7t2tIcnSLHS5.rHtJT5Fqg21e', 'EEE'),
('priya3', '$2y$10$6PuoO7kerLnR92VkcL0.uOYTi0HD7t2tIcnSLHS5.rHtJT5Fqg21e', 'IT'),
('priya4', '$2y$10$6PuoO7kerLnR92VkcL0.uOYTi0HD7t2tIcnSLHS5.rHtJT5Fqg21e', 'MEC');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `description`, `deadline`, `created_at`) VALUES
(2, 'chapter 8', 'page 2-3', '2025-04-24', '2025-04-21 05:12:24'),
(3, 'chapter 1', '10 pages', '2025-04-25', '2025-04-21 05:19:45'),
(4, 'Chapter 1', 'page 100', '2025-04-30', '2025-04-21 12:10:47'),
(5, 'Chapter 4', 'Page 12', '2025-04-30', '2025-04-21 12:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentseee`
--

CREATE TABLE `assignmentseee` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignmentseee`
--

INSERT INTO `assignmentseee` (`id`, `title`, `description`, `deadline`, `created_at`) VALUES
(1, 'Chapter 5', '20 Page', '2025-04-25', '2025-04-21 10:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentsit`
--

CREATE TABLE `assignmentsit` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignmentsit`
--

INSERT INTO `assignmentsit` (`id`, `title`, `description`, `deadline`, `created_at`) VALUES
(1, 'Chapter 6', 'Page 100', '2025-04-25', '2025-04-21 11:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentsmec`
--

CREATE TABLE `assignmentsmec` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignmentsmec`
--

INSERT INTO `assignmentsmec` (`id`, `title`, `description`, `deadline`, `created_at`) VALUES
(1, 'Chapter 9', 'Page 2', '2025-04-22', '2025-04-21 11:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `assignment_id` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_assignments`
--

INSERT INTO `student_assignments` (`id`, `user_id`, `assignment_id`, `file_name`, `file_path`, `submitted_at`) VALUES
(11, 'priya2', 'Chapter 4', 'readme.pdf', 'uploads/68063723c9b41_readme.pdf', '2025-04-21 12:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignmentseee`
--

CREATE TABLE `student_assignmentseee` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `assignment_id` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_assignmentseee`
--

INSERT INTO `student_assignmentseee` (`id`, `user_id`, `assignment_id`, `file_name`, `file_path`, `submitted_at`) VALUES
(2, 'priya2', 'Chapter 5', 'readme.pdf', 'uploads/68062ec4bd550_readme.pdf', '2025-04-21 11:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignmentsit`
--

CREATE TABLE `student_assignmentsit` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `assignment_id` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_assignmentsit`
--

INSERT INTO `student_assignmentsit` (`id`, `user_id`, `assignment_id`, `file_name`, `file_path`, `submitted_at`) VALUES
(1, 'priya2', 'Chapter 6', 'readme.pdf', 'uploads/680631583cdc2_readme.pdf', '2025-04-21 11:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignmentsmec`
--

CREATE TABLE `student_assignmentsmec` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `assignment_id` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_assignmentsmec`
--

INSERT INTO `student_assignmentsmec` (`id`, `user_id`, `assignment_id`, `file_name`, `file_path`, `submitted_at`) VALUES
(1, 'priya2', 'Chapter 9', 'readme.pdf', 'uploads/6806323e278ae_readme.pdf', '2025-04-21 11:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `admin2`
--
ALTER TABLE `admin2`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignmentseee`
--
ALTER TABLE `assignmentseee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignmentsit`
--
ALTER TABLE `assignmentsit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignmentsmec`
--
ALTER TABLE `assignmentsmec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `student_assignmentseee`
--
ALTER TABLE `student_assignmentseee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `student_assignmentsit`
--
ALTER TABLE `student_assignmentsit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `student_assignmentsmec`
--
ALTER TABLE `student_assignmentsmec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assignmentseee`
--
ALTER TABLE `assignmentseee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignmentsit`
--
ALTER TABLE `assignmentsit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignmentsmec`
--
ALTER TABLE `assignmentsmec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_assignments`
--
ALTER TABLE `student_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_assignmentseee`
--
ALTER TABLE `student_assignmentseee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_assignmentsit`
--
ALTER TABLE `student_assignmentsit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_assignmentsmec`
--
ALTER TABLE `student_assignmentsmec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
