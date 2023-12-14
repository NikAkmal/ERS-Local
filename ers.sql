-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2022 at 07:02 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `admin_profile_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `account_type`, `admin_profile_picture`) VALUES
(1, 'Nik Akmal Syafiq', 'NikAkmalSyafiq', '1234', 'admin', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `event_organizer_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_venue` varchar(100) NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `event_begin_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_detail` varchar(300) NOT NULL,
  `event_poster` varchar(100) NOT NULL,
  `event_brochure` varchar(100) NOT NULL,
  `event_request_status` varchar(10) NOT NULL,
  `event_category` varchar(15) NOT NULL,
  `event_qr_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `admin_id`, `event_organizer_id`, `event_name`, `event_venue`, `event_start_date`, `event_end_date`, `event_begin_time`, `event_end_time`, `event_detail`, `event_poster`, `event_brochure`, `event_request_status`, `event_category`, `event_qr_code`) VALUES
(2, 1, 1, 'Bola Baling', 'UMP Kompleks Sukan', '2021-11-26', '2021-11-29', '11:04:00', '19:01:00', 'Merit disertakan dan dijemput hadir beramai-ramai ', '/Event Registration System/Images/Event Poster/sukars_1534343077.jpg', '/Event Registration System/Images/Event Brochure/1 (2).jpg', 'APPROVE', 'sports', 'UMP HOKI TOURNAMENT'),
(7, 0, 1, 'Science Festival', 'UMP Kompleks Sukan', '2021-12-15', '2021-12-18', '08:00:00', '22:00:00', 'Merits are provided', '/Event Registration System/Images/Event Poster/poster.jpg', '/Event Registration System/Images/Event Brochure/science poster.jpg', 'Approve', 'science', '0'),
(8, 1, 1, 'Math Carnival', 'UMP Kompleks Sukan', '2021-12-20', '2021-12-20', '08:00:00', '22:00:00', 'Merits are provided', '/Event Registration System/Images/Event Poster/poster.jpg', '/Event Registration System/Images/Event Brochure/science poster.jpg', 'APPROVE', 'science', '0'),
(9, 1, 1, 'Towards Clouds Technology: Are We Ready?', 'UMP Kompleks Sukan', '2021-12-14', '2021-12-31', '08:00:00', '22:00:00', 'Merits are provided', '/Event Registration System/Images/Event Poster/poster.jpg', '/Event Registration System/Images/Event Brochure/science poster.jpg', 'APPROVE', 'science', '0'),
(10, 0, 1, 'AN EXCHANGE STUDENT IN THE NEW NORMAL', 'UMP Kompleks Sukan', '2021-12-15', '2021-12-15', '08:00:00', '22:00:00', 'Merits are provided', '/Event Registration System/Images/Event Poster/poster.jpg', '/Event Registration System/Images/Event Brochure/science poster.jpg', 'APPROVE', 'science', '1'),
(11, 0, 1, 'MY NURTURING EXPERT TALENT (MYNEXT)', 'UMP Kompleks Sukan', '2021-12-26', '2021-12-30', '08:00:00', '22:00:00', 'Merits are provided', '/Event Registration System/Images/Event Poster/poster.jpg', '/Event Registration System/Images/Event Brochure/science poster.jpg', 'APPROVE', 'science', '0'),
(12, 1, 3, 'UMP ESport', 'UMP Pekan Hall', '2021-12-23', '2021-12-25', '09:55:00', '18:59:00', 'Bring your own Laptop', '/Event Registration System/Images/Event Poster/c1_1558778_181016104512.jpg', '/Event Registration System/Images/Event Brochure/sabah_e-sport_academy.jpg', 'APPROVE', 'sports', 'UMP ESport	'),
(13, 1, 3, 'UMP HOKI TOURNAMENT', 'Padang UMP', '2021-12-22', '2021-12-24', '08:35:00', '19:00:00', 'Merit Disediakan', '/Event Registration System/Images/Event Poster/ice-hockey-poster-design-template-c2a17ab554d057d3613', '/Event Registration System/Images/Event Brochure/Poster Landskap 22.png', 'APPROVE', 'sports', 'UMP HOKI TOURNAMENT'),
(14, 1, 8, 'Poster Design Competition', 'UMP Pekan Hall', '2021-12-30', '2022-01-01', '08:20:00', '18:20:00', 'Bring your own color for the poster drawing', '/Event Registration System/Images/Event Poster/POSTER-FINAL-1-768x1077.jpg', '/Event Registration System/Images/Event Brochure/Law.pdf', 'APPROVE', 'arts', '0'),
(15, 1, 5, 'E-sport Game Competition', 'KK4', '2022-01-01', '2022-01-06', '09:32:00', '15:32:00', 'Bring your own gadget', '/Event Registration System/Images/Event Poster/print-203553681.jpg', '/Event Registration System/Images/Event Brochure/print-203553681.jpg', 'APPROVE', 'sports', 'E-Sport');

-- --------------------------------------------------------

--
-- Table structure for table `event_organizer`
--

CREATE TABLE `event_organizer` (
  `event_organizer_id` int(11) NOT NULL,
  `event_organizer_name` varchar(100) NOT NULL,
  `event_organizer_username` varchar(30) NOT NULL,
  `event_organizer_password` varchar(30) NOT NULL,
  `event_organizer_phone_number` varchar(15) NOT NULL,
  `event_organizer_address` varchar(100) NOT NULL,
  `event_organizer_account_status` varchar(15) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `event_organizer_profile_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_organizer`
--

INSERT INTO `event_organizer` (`event_organizer_id`, `event_organizer_name`, `event_organizer_username`, `event_organizer_password`, `event_organizer_phone_number`, `event_organizer_address`, `event_organizer_account_status`, `account_type`, `event_organizer_profile_picture`) VALUES
(1, 'Event Organizer ', 'EventOrganizer', '1234', '0195425880', 'Sungai Petani Kedah', 'Unblacklisted', 'organizer', 'none'),
(3, 'Amato', 'Amato', 'Amato', '01144334310', 'BUMI', 'Unblacklisted', 'organizer', '/Event Registration System/Images/Profile Picture/Screenshot (842).png'),
(5, 'ERS Test 2', 'test2', '1234', '0195425880', 'NO 512 Jalan BPJ 3A/10B Bandar Puteri Jaya, 08000, Sungai Petani Kedah', 'Unblacklisted', 'organizer', '/Event Registration System/Images/Profile Picture/Sufian_Suhaimi_on_MeleTOP.jpg'),
(8, 'ERS Test 3', 'test3', '1234', '01114434310', 'Bulan', 'Unblacklisted', 'organizer', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(100) NOT NULL,
  `participant_username` varchar(30) NOT NULL,
  `participant_password` varchar(30) NOT NULL,
  `participant_matric_id` varchar(11) NOT NULL,
  `participant_phone_number` varchar(15) NOT NULL,
  `participant_address` varchar(100) NOT NULL,
  `participant_account_status` varchar(15) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `participant_profile_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`participant_id`, `participant_name`, `participant_username`, `participant_password`, `participant_matric_id`, `participant_phone_number`, `participant_address`, `participant_account_status`, `account_type`, `participant_profile_picture`) VALUES
(1, 'Nik Akmal Syafiq bin Nek Li', 'Participant', '1234', 'CB18071', '0165597923', 'UMP GAMBANG PAHANG', 'Unblacklisted', 'participant', 'none'),
(3, 'Muhammad Wafiy Amsyar Bin Wisha Qarani', 'Participant 2', '1234', 'CT18011', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (851).png'),
(4, 'Ammar Danial', 'PT33', '123456', 'BN2024', '123456', 'asdasdasd', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(5, 'Syafiq Akmal bin Akmal Syafiq', 'PT 2', '1234', 'CK18492', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(6, 'Muhammad Adam Iman', 'PT 2', '1234', 'CM18690', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(7, 'Muhammad Afzan ', 'PT 2', '1234', 'CL18290', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(8, 'Muhammad Haziq bin Muhammad Daud', 'PT 2', '1234', 'CL18222', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(9, 'Muhammad Arfan bin Muhammad Haikal', 'PT 2', '1234', 'CB18601', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(10, 'Muhammad Haikal Suhaimi bin Sufian', 'PT 2', '1234', 'CB18771', '1234', '1234', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/Screenshot (1176).png'),
(12, 'ERS Test 1', 'test1', '1234', 'CB18071', '0165597923', 'No 513 Jalan BPJ 3A/10B Bandar Puteri Jaya, 08000, Sungai Petani Kedah', 'Unblacklisted', 'participant', '/Event Registration System/Images/Profile Picture/shahrukh-khan-20190625140849-86.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration_record`
--

CREATE TABLE `registration_record` (
  `event_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `registration_time` time NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_record`
--

INSERT INTO `registration_record` (`event_id`, `participant_id`, `registration_time`, `registration_date`) VALUES
(2, 1, '16:09:58', '2021-12-20'),
(10, 1, '18:13:34', '2021-12-20'),
(11, 3, '01:00:58', '2021-12-24'),
(11, 3, '01:00:58', '2021-12-24'),
(8, 3, '02:38:39', '2021-12-29'),
(7, 3, '02:38:39', '2021-12-29'),
(8, 3, '02:38:39', '2021-12-29'),
(7, 3, '02:38:39', '2021-12-29'),
(9, 3, '14:08:49', '2021-12-29'),
(11, 3, '02:38:39', '2021-12-29'),
(9, 3, '14:08:49', '2021-12-29'),
(11, 3, '02:38:39', '2021-12-29'),
(12, 1, '01:00:58', '2021-12-24'),
(11, 3, '02:38:39', '2021-12-29'),
(12, 1, '01:00:58', '2021-12-24'),
(11, 3, '02:38:39', '2021-12-29'),
(12, 1, '14:08:49', '2021-12-29'),
(13, 3, '02:38:39', '2021-12-29'),
(12, 1, '14:08:49', '2021-12-29'),
(13, 3, '02:38:39', '2021-12-29'),
(15, 12, '03:37:12', '2021-12-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_organizer`
--
ALTER TABLE `event_organizer`
  ADD PRIMARY KEY (`event_organizer_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`participant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event_organizer`
--
ALTER TABLE `event_organizer`
  MODIFY `event_organizer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
