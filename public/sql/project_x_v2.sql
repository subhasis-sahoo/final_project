-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 10:11 AM
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
  `receiver_role` enum('faculty advisor','accounts section') NOT NULL,
  `supporting_documents` varchar(255) NOT NULL,
  `application_type` enum('exam registration','admit card') NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `current_stage` enum('faculty advisor','accounts section','dean','examination cell') NOT NULL,
  `apply_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_registrations`
--

CREATE TABLE `exam_registrations` (
  `registration_id` int(11) NOT NULL,
  `student_sic` varchar(255) NOT NULL,
  `registration_start_date` date NOT NULL DEFAULT '2025-09-05',
  `registration_end_date` date NOT NULL DEFAULT '2025-09-16',
  `is_approved` tinyint(1) DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `registration_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_registrations`
--

INSERT INTO `exam_registrations` (`registration_id`, `student_sic`, `registration_start_date`, `registration_end_date`, `is_approved`, `approval_date`, `registration_data`) VALUES
(8, '25MMCI19', '2025-09-05', '2025-09-16', NULL, NULL, '{\"subject_list\":[{\"subject_code\":\"MCCS-T-PC-015\",\"subject_name\":\"Computer Networks\",\"amount\":0,\"registration_last_date\":\"16-09-2025\",\"is_checked\":true},{\"subject_code\":\"MCCS-T-PC-089\",\"subject_name\":\"Software Engineering\",\"amount\":0,\"registration_last_date\":\"16-09-2025\",\"is_checked\":true},{\"subject_code\":\"MCCS-T-PC-073\",\"subject_name\":\"Cloud Computing\",\"amount\":0,\"registration_last_date\":\"16-09-2025\",\"is_checked\":true},{\"subject_code\":\"MCCS-T-PC-092\",\"subject_name\":\"Mobile Application Develo\",\"amount\":0,\"registration_last_date\":\"16-09-2025\",\"is_checked\":true},{\"subject_code\":\"MCCS-T-PC-034\",\"subject_name\":\"Internet of Things\",\"amount\":0,\"registration_last_date\":\"16-09-2025\",\"is_checked\":true},{\"subject_code\":\"MCCS-T-PC-056\",\"subject_name\":\"Software Testing\",\"amount\":0,\"registration_last_date\":\"16-09-2025\",\"is_checked\":true}],\"student_due\":\"0\"}');

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
  `semester` enum('1','2','3','4') DEFAULT NULL,
  `program` varchar(10) NOT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sic`, `full_name`, `email`, `password`, `semester`, `program`, `profile_photo_path`) VALUES
('25MMCI19', 'Suresh Patel', 'mca.25mmci19@silicon.ac.in', 'suresh@19', '3', 'MCA', NULL),
('25MMCI24', 'Kavita Desai', 'mca.25mmci24@silicon.ac.in', 'kavita@24', '2', 'MCA', NULL),
('25MMCI27', 'Vikram Malhotra', 'mca.25mmci27@silicon.ac.in', 'vikram@27', '1', 'MCA', NULL),
('25MMCI31', 'Rajesh Kumar', 'mca.25mmci31@silicon.ac.in', 'rajesh@31', '1', 'MCA', NULL),
('25MMCI38', 'Divya Kapoor', 'mca.25mmci38@silicon.ac.in', 'divya@38', '2', 'MCA', NULL),
('25MMCI42', 'Aditya Sharma', 'mca.25mmci42@silicon.ac.in', 'aditya@42', '3', 'MCA', NULL),
('25MMCI47', 'Sunita Rao', 'mca.25mmci47@silicon.ac.in', 'sunita@47', '4', 'MCA', NULL),
('25MMCI53', 'Nisha Verma', 'mca.25mmci53@silicon.ac.in', 'nisha@53', '4', 'MCA', NULL),
('25MMCI59', 'Mohan Choudhary', 'mca.25mmci59@silicon.ac.in', 'mohan@59', '1', 'MCA', NULL),
('25MMCI65', 'Anjali Singh', 'mca.25mmci65@silicon.ac.in', 'anjali@65', '4', 'MCA', NULL),
('25MMCI72', 'Rahul Gupta', 'mca.25mmci72@silicon.ac.in', 'rahul@72', '1', 'MCA', NULL),
('25MMCI78', 'Priya Mehta', 'mca.25mmci78@silicon.ac.in', 'priya@78', '2', 'MCA', NULL),
('25MMCI83', 'Arjun Iyer', 'mca.25mmci83@silicon.ac.in', 'arjun@83', '3', 'MCA', NULL),
('25MMCI84', 'Meena Reddy', 'mca.25mmci84@silicon.ac.in', 'meena@84', '2', 'MCA', NULL),
('25MMCI96', 'Karan Joshi', 'mca.25mmci96@silicon.ac.in', 'karan@96', '3', 'MCA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_dues`
--

CREATE TABLE `student_dues` (
  `due_id` int(11) NOT NULL,
  `student_sic` varchar(255) NOT NULL,
  `due_type` varchar(25) DEFAULT NULL,
  `amount` decimal(8,0) NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_dues`
--

INSERT INTO `student_dues` (`due_id`, `student_sic`, `due_type`, `amount`, `is_paid`) VALUES
(1, '25MMCI42', NULL, 0, 1),
(2, '25MMCI78', NULL, 50000, 0),
(3, '25MMCI31', NULL, 100000, 1),
(4, '25MMCI65', NULL, 35000, 1),
(5, '25MMCI19', NULL, 0, 0),
(6, '25MMCI84', NULL, 89500, 1),
(7, '25MMCI27', NULL, 10000, 1),
(8, '25MMCI53', NULL, 15000, 0),
(9, '25MMCI96', NULL, 0, 1),
(10, '25MMCI38', NULL, 0, 1),
(11, '25MMCI72', NULL, 25001, 0),
(12, '25MMCI47', NULL, 25809, 1),
(13, '25MMCI83', NULL, 300550, 1),
(14, '25MMCI24', NULL, 0, 1),
(15, '25MMCI59', NULL, 30000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(15) NOT NULL,
  `subject_name` varchar(25) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `semester`) VALUES
(1, 'MCCS-T-PC-001', 'Database Management Syste', 2),
(2, 'MCCS-T-PC-023', 'Data Structures and Algor', 1),
(3, 'MCCS-T-PC-042', 'Object Oriented Programmi', 1),
(4, 'MCCS-T-PC-015', 'Computer Networks', 3),
(5, 'MCCS-T-PC-078', 'Web Development', 2),
(6, 'MCCS-T-PC-036', 'Operating Systems', 2),
(7, 'MCCS-T-PC-089', 'Software Engineering', 3),
(8, 'MCCS-T-PC-017', 'Artificial Intelligence', 4),
(9, 'MCCS-T-PC-054', 'Machine Learning', 4),
(10, 'MCCS-T-PC-073', 'Cloud Computing', 3),
(11, 'MCCS-T-PC-092', 'Mobile Application Develo', 3),
(12, 'MCCS-T-PC-045', 'Information Security', 4),
(13, 'MCCS-T-PC-028', 'Computer Graphics', 2),
(14, 'MCCS-T-PC-061', 'Big Data Analytics', 4),
(15, 'MCCS-T-PC-034', 'Internet of Things', 3),
(16, 'MCCS-T-PC-087', 'Distributed Systems', 4),
(17, 'MCCS-T-PC-019', 'Programming Fundamentals', 1),
(18, 'MCCS-T-PC-056', 'Software Testing', 3),
(19, 'MCCS-T-PC-074', 'Network Security', 2),
(20, 'MCCS-T-PC-031', 'Data Mining', 2),
(21, 'MCCS-T-PC-068', 'Computer Architecture', 1),
(22, 'MCCS-T-PC-093', 'Digital Logic Design', 1);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_sic`, `full_name`, `email`, `password`, `role`) VALUES
('10MMUD04', 'DR Debabrata Kar', 'ude.10mmud04.silicon.ac.in', 'debabrata@04', 'DEAN'),
('12MMUA07', 'Gopal Chandra Das', 'uac.12mmua07.silicon.ac.in', 'goapl@07', 'Accounts'),
('12MMUE24', 'Subham Sahoo', 'uec.12mmue24.silicon.ac.in', 'subham@24', 'Examination Cell'),
('14MMUF13', 'DR Mukti Routray', 'ufa.14mmuf13@silicon.ac.in', 'mukti@13', 'Faculty Advisor');

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
-- Indexes for table `exam_registrations`
--
ALTER TABLE `exam_registrations`
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
  ADD KEY `fk_subject_id` (`semester`);

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
-- AUTO_INCREMENT for table `exam_registrations`
--
ALTER TABLE `exam_registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faculty_advisors`
--
ALTER TABLE `faculty_advisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_dues`
--
ALTER TABLE `student_dues`
  MODIFY `due_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `fk_student_sic_new` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`);

--
-- Constraints for table `exam_registrations`
--
ALTER TABLE `exam_registrations`
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`);

--
-- Constraints for table `faculty_advisors`
--
ALTER TABLE `faculty_advisors`
  ADD CONSTRAINT `fk_stud_sic` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`),
  ADD CONSTRAINT `fk_user_sic` FOREIGN KEY (`user_sic`) REFERENCES `users` (`u_sic`);

--
-- Constraints for table `student_dues`
--
ALTER TABLE `student_dues`
  ADD CONSTRAINT `fk_students_sic` FOREIGN KEY (`student_sic`) REFERENCES `students` (`sic`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
