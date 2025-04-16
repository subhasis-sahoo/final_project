-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 06:14 PM
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
-- Database: `project_x`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `student_sic` varchar(255) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `reciver_role` enum('faculty advisor','accounts section') NOT NULL,
  `supporting_documents` varchar(255) NOT NULL,
  `application_type` enum('exam registration','admit card') NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `current_stage` enum('faculty advisor','accounts section','dean','examination cell') NOT NULL,
  `apply_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_registration`
--

CREATE TABLE `exam_registration` (
  `registration_id` int(11) NOT NULL,
  `student_sic` varchar(255) NOT NULL,
  `registration_start_date` date NOT NULL,
  `registration_end_date` date NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `approval_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_advisors`
--

CREATE TABLE `faculty_advisors` (
  `id` int(11) NOT NULL,
  `user_sic` varchar(255) NOT NULL,
  `student_sic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sic` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `profile_photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_dues`
--

CREATE TABLE `student_dues` (
  `due_id` int(11) NOT NULL,
  `student_sic` varchar(255) NOT NULL,
  `due_type` varchar(25) NOT NULL,
  `amount` decimal(8,0) NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(15) NOT NULL,
  `subject_name` varchar(25) NOT NULL,
  `program` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_sic` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `fk_student_sic_new` (`student_sic`);

--
-- Indexes for table `exam_registration`
--
ALTER TABLE `exam_registration`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `fk_student_id` (`student_sic`);

--
-- Indexes for table `faculty_advisors`
--
ALTER TABLE `faculty_advisors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_sic` (`user_sic`),
  ADD KEY `fk_stud_sic` (`student_sic`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `profile_photo_path` (`profile_photo_path`),
  ADD KEY `fk_subject_id` (`subject_id`);

--
-- Indexes for table `student_dues`
--
ALTER TABLE `student_dues`
  ADD PRIMARY KEY (`due_id`),
  ADD KEY `fk_students_sic` (`student_sic`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_sic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_registration`
--
ALTER TABLE `exam_registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_advisors`
--
ALTER TABLE `faculty_advisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_dues`
--
ALTER TABLE `student_dues`
  MODIFY `due_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `fk_student_sic_new` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`);

--
-- Constraints for table `exam_registration`
--
ALTER TABLE `exam_registration`
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`);

--
-- Constraints for table `faculty_advisors`
--
ALTER TABLE `faculty_advisors`
  ADD CONSTRAINT `fk_stud_sic` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`),
  ADD CONSTRAINT `fk_user_sic` FOREIGN KEY (`user_sic`) REFERENCES `users` (`u_sic`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `student_dues`
--
ALTER TABLE `student_dues`
  ADD CONSTRAINT `fk_students_sic` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
