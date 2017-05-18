-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2016 at 06:18 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `church`
--

CREATE TABLE `church` (
  `church_id` int(11) NOT NULL,
  `church_acronym` varchar(255) NOT NULL,
  `church_name` varchar(255) NOT NULL,
  `pastor` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `street_number` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `year_active` varchar(100) NOT NULL,
  `image_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `church`
--

INSERT INTO `church` (`church_id`, `church_acronym`, `church_name`, `pastor`, `address`, `street_number`, `street_address`, `city`, `state`, `zip_code`, `contact_number`, `email_address`, `year_active`, `image_path`) VALUES
(11, 'ICBC', 'In Christ Baptist Church', 'Pastor Rodrigo Quirante Jr.', 'Sampaloc St. Block 7 Lot 1', '', 'Sampaloc St. Block 7 Lot 1', 'Taguig', '', '1634', '09174072626', '', '14', 'image/default_church.png'),
(12, 'SGBC', 'Sea of Galilee Baptist Church', 'Pastor Carolino', 'Anda, Pangasinan', 'Lot 1 Blk 2', '', 'Anda', 'Pangasinan', '4312', '09214567890', 'sgbc@yahoo.com', '14', 'image/default_church.png'),
(13, 'BBBC', 'Batasan Bible Believers Baptist Church', 'Bobby Colardo', 'Batasan', '147', 'palm ave. south san francisco', 'san francisco', 'CALIFORNIA', '94080', '09178402944', 'sample@gmail.com', '14', 'image/default_church.png'),
(14, 'APFHNBC', 'A People For His Name Baptist Church', 'Pastor Ben Aplaon', ' .', 'Adullam Baptist Encampment Mt. Banahaw St.', 'Sto. Nino', 'Lipa City', 'Batangas', '4217', '09295320482', 'apfhnbc@gmail.com', '10', 'image/church_image/2f660c97c4a8aa7dacfcabdd10d22c07.jpg'),
(15, 'CBC', 'Charity Baptist Church', 'Pator Tahuguiran', 'Bulacan, Central Luzon, Philippines', 'Lt 1 Blk 5', '', 'Bulacan', 'Central Luzon', '4321', '09215556666', 'CBC@yahoo.com', '', 'image/default_church.png'),
(16, 'FGTBC', 'Full of Grace and Truth Baptist Church', 'Rey Dungca', 'Pampanga, Angeles, Central Luzon, Philippines', '88', 'Pampanga, Central Luzon', 'Angeles', 'Central Luzon', '0900', '09176568811', 'fullofgrace&truth@yahoo.com', '14', 'image/default_church.png'),
(17, 'BBBC', 'Blood Bought Baptist Church', 'Arnel Pios', '', '', 'San Mateo', 'Rizal', '', '', '', '', '14', 'image/default_church.png'),
(18, 'SSBC', 'Sola Scriptura Baptist Church', 'Francis Simeon', 'Manila, NCR, Philippines', '147', '147 Air Force Homes Purok 3 Sico', 'Manila', 'NCR', '4217', '09178402944', 'sample@gmail.com', '14', 'image/default_church.png'),
(20, 'ABBC', 'Authorized Bible Baptist Church', 'Antonio Ramirez Jr. ', '', '', '', 'Victoria', 'Mindoro', '', '', '', '14', 'image/default_church.png'),
(22, 'APICBC', 'A People In Christ Baptist Church', 'Luke Bucud', 'California, United States', '', 'california', '', 'CA', '', '9999999', 'justified@yahooo.com', '14', 'image/church_image/11432.jpg'),
(23, 'JBFBC', 'Justified By Faith Baptist Church', 'Paul Carolino', 'Anda, Pangasinan', '', '', '', '', '', '09215556789', 'JBFBC@yahoo.com', '16', 'image/default_church.png'),
(24, 'WCBT', 'Washington County Baptist Tabernacle', 'Robert Patenaude', 'Indiana', '705', 'N Rush Creek Road', 'Salem', 'Indiana', '47167', '', '', '14', 'image/default_church.png'),
(25, 'LWBC', 'Living Word of God  Baptist Church', 'Antonio Ramirez Jr. ', '', '', '', 'Victoria', 'Mindoro', '', '', '', '14', 'image/default_church.png'),
(26, 'BBC', 'Berean Baptist Church', 'Efren Gerardo', 'Candaba, Pampanga', '', '', '', '', '', '09209872324', 'BBC@yahoo.com', '', 'image/default_church.png');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(100) NOT NULL,
  `course_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_description`) VALUES
('CE', 'Christian Education'),
('PT', 'Pastoral Theology');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL,
  `attendance1` int(11) NOT NULL,
  `attendance2` int(11) NOT NULL,
  `attendance3` int(11) NOT NULL,
  `attendance4` int(11) NOT NULL,
  `t_attendance` int(11) NOT NULL,
  `p_attendance` float NOT NULL,
  `quiz1` int(11) NOT NULL,
  `quiz2` int(11) NOT NULL,
  `t_quiz` int(11) NOT NULL,
  `p_quiz` float NOT NULL,
  `recitation1` int(11) NOT NULL,
  `recitation2` int(11) NOT NULL,
  `recitation3` int(11) NOT NULL,
  `recitation4` int(11) NOT NULL,
  `t_recitation` int(11) NOT NULL,
  `p_recitation` float NOT NULL,
  `proj_assign` int(11) NOT NULL,
  `t_proj_assign` int(11) NOT NULL,
  `p_proj_assign` float NOT NULL,
  `exam` int(11) NOT NULL,
  `t_exam` int(11) NOT NULL,
  `p_exam` float NOT NULL,
  `equivalent` float NOT NULL,
  `equivalent_status` int(11) NOT NULL DEFAULT '0',
  `remark` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `subject_id`, `student_number`, `year`, `attendance1`, `attendance2`, `attendance3`, `attendance4`, `t_attendance`, `p_attendance`, `quiz1`, `quiz2`, `t_quiz`, `p_quiz`, `recitation1`, `recitation2`, `recitation3`, `recitation4`, `t_recitation`, `p_recitation`, `proj_assign`, `t_proj_assign`, `p_proj_assign`, `exam`, `t_exam`, `p_exam`, `equivalent`, `equivalent_status`, `remark`, `status`) VALUES
(23, '35', '16-0031', '1', 1, 2, 3, 4, 10, 0.5, 7, 8, 15, 25, 11, 12, 13, 14, 50, 15, 17, 17, 15, 20, 20, 40, 95.5, 0, 'remark', 0),
(24, '35', '16-0001', '2', 2, 0, 0, 0, 2, 0.1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.1, 0, 'remark', 0),
(25, '35', '15-0032', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(26, '35', '14-0002', '1', 24, 25, 26, 27, 102, 5.1, 30, 31, 61, 101.67, 34, 35, 36, 37, 142, 42.6, 40, 40, 35.29, 43, 43, 86, 270.66, 0, 'remark', 0),
(27, '35', '14-0006', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(28, '35', '14-0008', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(29, '35', '14-0011', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(30, '35', '14-0027', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(31, '35', '14-0004', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(32, '35', '14-0009', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(33, '35', '14-0012', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(34, '35', '14-0014', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(35, '35', '16-0029', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(36, '35', '14-0013', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(37, '35', '14-0016', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(38, '35', '14-0018', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(39, '35', '16-0024', '1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0),
(40, '35', '14-0007', '3', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'remark', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grade_hps`
--

CREATE TABLE `grade_hps` (
  `grade_hps_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `attendance1_hps` int(11) NOT NULL,
  `attendance2_hps` int(11) NOT NULL,
  `attendance3_hps` int(11) NOT NULL,
  `attendance4_hps` int(11) NOT NULL,
  `t_attendance_hps` int(11) NOT NULL,
  `p_attendance_hps` int(11) NOT NULL,
  `quiz1_hps` int(11) NOT NULL,
  `quiz2_hps` int(11) NOT NULL,
  `t_quiz_hps` int(11) NOT NULL,
  `p_quiz_hps` int(11) NOT NULL,
  `recitation1_hps` int(11) NOT NULL,
  `recitation2_hps` int(11) NOT NULL,
  `recitation3_hps` int(11) NOT NULL,
  `recitation4_hps` int(11) NOT NULL,
  `t_recitation_hps` int(11) NOT NULL,
  `p_recitation_hps` int(11) NOT NULL,
  `proj_assign_hps` int(11) NOT NULL,
  `t_proj_assign_hps` int(11) NOT NULL,
  `p_proj_assign_hps` int(11) NOT NULL,
  `exam_hps` int(11) NOT NULL,
  `t_exam_hps` int(11) NOT NULL,
  `p_exam_hps` int(11) NOT NULL,
  `equivalent_hps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_hps`
--

INSERT INTO `grade_hps` (`grade_hps_id`, `subject_id`, `attendance1_hps`, `attendance2_hps`, `attendance3_hps`, `attendance4_hps`, `t_attendance_hps`, `p_attendance_hps`, `quiz1_hps`, `quiz2_hps`, `t_quiz_hps`, `p_quiz_hps`, `recitation1_hps`, `recitation2_hps`, `recitation3_hps`, `recitation4_hps`, `t_recitation_hps`, `p_recitation_hps`, `proj_assign_hps`, `t_proj_assign_hps`, `p_proj_assign_hps`, `exam_hps`, `t_exam_hps`, `p_exam_hps`, `equivalent_hps`) VALUES
(1, 35, 25, 25, 25, 25, 100, 5, 7, 8, 15, 25, 11, 12, 13, 14, 50, 15, 17, 17, 15, 20, 20, 40, 100);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `name`, `user_type`, `action`, `date`, `time`, `ip_address`) VALUES
(35, 'Antonio Remo', 'Admin', 'Log In', 'Jul-04-2016', '01:25 PM', '::1'),
(36, 'Antonio Remo', 'Admin', 'Log In', 'Jul-04-2016', '09:07 PM', '::1'),
(37, 'Antonio Remo', 'Admin', 'Log In', 'Jul-05-2016', '11:00 AM', '::1'),
(38, 'Antonio Remo', 'Admin', 'Log In', 'Jul-05-2016', '08:25 PM', '::1'),
(39, 'Antonio Remo', 'Admin', 'Log In', 'Jul-06-2016', '11:26 AM', '::1'),
(40, 'Antonio Remo', 'Admin', 'Log In', 'Jul-06-2016', '11:01 PM', '::1'),
(41, 'Antonio Remo', 'Admin', 'Log In', 'Jul-07-2016', '01:34 PM', '::1'),
(42, 'Antonio Remo', 'Admin', 'Log In', 'Jul-08-2016', '10:15 AM', '::1'),
(43, 'Antonio Remo', 'Admin', 'Log In', 'Jul-09-2016', '02:58 PM', '::1'),
(44, 'Antonio Remo', 'Admin', 'Log In', 'Jul-10-2016', '08:58 PM', '::1'),
(45, 'Antonio Remo', 'Admin', 'Log In', 'Jul-11-2016', '08:46 PM', '::1'),
(46, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-11-2016', '08:48 PM', '::1'),
(47, 'Antonio Remo', 'Admin', 'Log In', 'Jul-11-2016', '08:52 PM', '::1'),
(48, 'Antonio Remo', 'Admin', 'Log In', 'Jul-13-2016', '08:39 PM', '::1'),
(49, 'Antonio Remo', 'Admin', 'Log In', 'Jul-15-2016', '12:46 PM', '::1'),
(50, 'Antonio Remo', 'Admin', 'Log In', 'Jul-15-2016', '08:45 PM', '::1'),
(51, 'Antonio Remo', 'Admin', 'Log In', 'Jul-17-2016', '09:28 PM', '::1'),
(52, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-17-2016', '10:54 PM', '::1'),
(53, 'Antonio Remo', 'Admin', 'Log In', 'Jul-17-2016', '10:54 PM', '::1'),
(54, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-17-2016', '10:56 PM', '::1'),
(55, 'Veronica Canlas', 'Instructor', 'Log In', 'Jul-17-2016', '10:56 PM', '::1'),
(56, 'Veronica Canlas', 'Instructor', 'Logged Out', 'Jul-17-2016', '10:59 PM', '::1'),
(57, 'Antonio Remo', 'Admin', 'Log In', 'Jul-17-2016', '10:59 PM', '::1'),
(58, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-17-2016', '11:02 PM', '::1'),
(59, 'Veronica Canlas', 'Instructor', 'Log In', 'Jul-17-2016', '11:02 PM', '::1'),
(60, 'Veronica Canlas', 'Instructor', 'Logged Out', 'Jul-18-2016', '01:10 AM', '::1'),
(61, 'Antonio Remo', 'Admin', 'Log In', 'Jul-18-2016', '01:10 AM', '::1'),
(62, 'Antonio Remo', 'Admin', 'Log In', 'Jul-18-2016', '03:53 AM', '::1'),
(63, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-18-2016', '04:55 AM', '::1'),
(64, 'Veronica Canlas', 'Instructor', 'Log In', 'Jul-18-2016', '04:55 AM', '::1'),
(65, 'Antonio Remo', 'Admin', 'Log In', 'Jul-19-2016', '12:30 AM', '::1'),
(66, 'Antonio Remo', 'Admin', 'Log In', 'Jul-20-2016', '03:23 PM', '::1'),
(67, 'Antonio Remo', 'Admin', 'Log In', 'Jul-21-2016', '08:44 PM', '::1'),
(68, 'Antonio Remo', 'Admin', 'Log In', 'Jul-22-2016', '03:49 PM', '::1'),
(69, 'Antonio Remo', 'Admin', 'Log In', 'Jul-24-2016', '02:59 AM', '::1'),
(70, 'Antonio Remo', 'Admin', 'Log In', 'Jul-25-2016', '08:46 PM', '::1'),
(71, 'Antonio Remo', 'Admin', 'Log In', 'Jul-26-2016', '11:35 AM', '::1'),
(72, 'Antonio Remo', 'Admin', 'Log In', 'Jul-27-2016', '12:31 AM', '127.0.0.1'),
(73, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-27-2016', '01:13 AM', '::1'),
(74, 'Antonio Remo', 'Admin', 'Log In', 'Jul-27-2016', '01:14 AM', '::1'),
(75, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-27-2016', '01:14 AM', '::1'),
(76, 'Engilbert Comadre', 'Encoder', 'Log In', 'Jul-27-2016', '01:14 AM', '::1'),
(77, 'Antonio Remo', 'Admin', 'Log In', 'Jul-27-2016', '02:12 AM', '::1'),
(78, 'Engilbert Comadre', 'Encoder', 'Logged Out', 'Jul-27-2016', '03:27 AM', '::1'),
(79, 'Juan Solomon', 'Printer', 'Log In', 'Jul-27-2016', '03:27 AM', '::1'),
(80, 'Antonio Remo', 'Admin', 'Log In', 'Jul-27-2016', '07:46 AM', '::1'),
(81, 'Antonio Remo', 'Admin', 'Log In', 'Jul-28-2016', '01:49 AM', '::1'),
(82, 'Antonio Remo', 'Admin', 'Log In', 'Jul-28-2016', '07:36 PM', '::1'),
(83, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-28-2016', '07:37 PM', '::1'),
(84, 'Antonio Remo', 'Admin', 'Log In', 'Jul-28-2016', '07:43 PM', '::1'),
(85, 'Antonio Remo', 'Admin', 'Log In', 'Jul-29-2016', '01:52 AM', '::1'),
(86, 'Antonio Remo', 'Admin', 'Logged Out', 'Jul-29-2016', '02:02 AM', '::1'),
(87, 'Veronica Canlas', 'Instructor', 'Log In', 'Jul-29-2016', '02:02 AM', '::1'),
(88, 'Veronica Canlas', 'Instructor', 'Logged Out', 'Jul-29-2016', '02:04 AM', '::1'),
(89, 'Engilbert Comadre', 'Encoder', 'Log In', 'Jul-29-2016', '02:05 AM', '::1'),
(90, 'Antonio Remo', 'Admin', 'Log In', 'Jul-29-2016', '02:19 AM', '::1'),
(91, 'Engilbert Comadre', 'Encoder', 'Logged Out', 'Jul-29-2016', '02:32 AM', '::1'),
(92, 'Antonio Remo', 'Admin', 'Log In', 'Jul-29-2016', '02:33 AM', '::1'),
(93, 'Antonio Remo', 'Admin', 'Log In', 'Jul-29-2016', '11:07 AM', '::1'),
(94, 'Antonio Remo', 'Admin', 'Log In', 'Aug-02-2016', '02:35 PM', '::1'),
(95, 'Antonio Remo', 'Admin', 'Log In', 'Aug-05-2016', '02:09 PM', '::1'),
(96, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-05-2016', '02:35 PM', '::1'),
(97, 'Antonio Remo', 'Admin', 'Log In', 'Aug-05-2016', '02:48 PM', '::1'),
(98, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-05-2016', '02:49 PM', '::1'),
(99, 'Antonio Remo', 'Admin', 'Log In', 'Aug-05-2016', '08:31 PM', '::1'),
(100, 'Antonio Remo', 'Admin', 'Log In', 'Aug-06-2016', '10:22 AM', '::1'),
(101, 'Antonio Remo', 'Admin', 'Log In', 'Aug-10-2016', '11:03 AM', '::1'),
(102, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-10-2016', '11:03 AM', '::1'),
(103, 'Antonio Remo', 'Admin', 'Log In', 'Aug-10-2016', '11:03 AM', '::1'),
(104, 'Antonio Remo', 'Admin', 'Log In', 'Aug-10-2016', '11:06 AM', '::1'),
(105, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-10-2016', '01:04 PM', '::1'),
(106, 'Antonio Remo', 'Admin', 'Log In', 'Aug-10-2016', '01:04 PM', '::1'),
(107, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-10-2016', '01:10 PM', '::1'),
(108, 'Antonio Remo', 'Admin', 'Log In', 'Aug-10-2016', '01:13 PM', '::1'),
(109, 'Antonio Remo', 'Admin', 'Log In', 'Aug-10-2016', '10:59 PM', '::1'),
(110, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-10-2016', '11:19 PM', '::1'),
(111, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '11:42 AM', '::1'),
(112, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-11-2016', '11:45 AM', '::1'),
(113, 'Engilbert Comadre', 'Encoder', 'Log In', 'Aug-11-2016', '11:45 AM', '::1'),
(114, 'Engilbert Comadre', 'Encoder', 'Logged Out', 'Aug-11-2016', '11:48 AM', '::1'),
(115, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '11:48 AM', '::1'),
(116, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-11-2016', '11:48 AM', '::1'),
(117, 'Engilbert Comadre', 'Encoder', 'Log In', 'Aug-11-2016', '11:49 AM', '::1'),
(118, 'Engilbert Comadre', 'Encoder', 'Logged Out', 'Aug-11-2016', '12:43 PM', '::1'),
(119, 'Engilbert Comadre', 'Encoder', 'Log In', 'Aug-11-2016', '12:44 PM', '::1'),
(120, 'Engilbert Comadre', 'Encoder', 'Logged Out', 'Aug-11-2016', '12:44 PM', '::1'),
(121, 'Engilbert Comadre', 'Encoder', 'Log In', 'Aug-11-2016', '12:44 PM', '::1'),
(122, 'Engilbert Comadre', 'Encoder', 'Logged Out', 'Aug-11-2016', '12:45 PM', '::1'),
(123, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '12:46 PM', '::1'),
(124, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-11-2016', '12:46 PM', '::1'),
(125, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '12:49 PM', '::1'),
(126, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-11-2016', '12:51 PM', '::1'),
(127, 'GARY KANG', 'Encoder', 'Log In', 'Aug-11-2016', '12:53 PM', '::1'),
(128, 'GARY KANG', 'Encoder', 'Logged Out', 'Aug-11-2016', '12:53 PM', '::1'),
(129, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '12:54 PM', '::1'),
(130, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-11-2016', '12:55 PM', '::1'),
(131, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '12:55 PM', '::1'),
(132, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-11-2016', '12:55 PM', '::1'),
(133, 'GARY KANG', 'Encoder', 'Log In', 'Aug-11-2016', '12:55 PM', '::1'),
(134, 'GARY KANG', 'Encoder', 'Logged Out', 'Aug-11-2016', '01:14 PM', '::1'),
(135, 'GARY KANG', 'Encoder', 'Log In', 'Aug-11-2016', '01:14 PM', '::1'),
(136, 'GARY KANG', 'Encoder', 'Logged Out', 'Aug-11-2016', '01:19 PM', '::1'),
(137, 'GARY KANG', 'Encoder', 'Log In', 'Aug-11-2016', '01:19 PM', '::1'),
(138, 'GARY KANG', 'Encoder', 'Logged Out', 'Aug-11-2016', '02:31 PM', '::1'),
(139, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '02:31 PM', '::1'),
(140, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '02:40 PM', '121.54.54.129'),
(141, 'Antonio Remo', 'Admin', 'Log In', 'Aug-11-2016', '09:17 PM', '112.198.118.153'),
(142, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:28 AM', '112.198.75.173'),
(143, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '10:31 AM', '112.198.75.173'),
(144, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:31 AM', '112.198.75.173'),
(145, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:32 AM', '112.198.75.173'),
(146, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:41 AM', '112.198.75.173'),
(147, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:43 AM', '112.198.75.173'),
(148, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:43 AM', '112.198.75.173'),
(149, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:43 AM', '112.198.75.173'),
(150, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:43 AM', '112.198.75.173'),
(151, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:44 AM', '112.198.75.173'),
(152, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:47 AM', '112.198.75.173'),
(153, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:55 AM', '112.198.75.173'),
(154, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:55 AM', '112.198.75.173'),
(155, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '10:56 AM', '112.198.75.173'),
(156, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '11:36 AM', '112.198.75.173'),
(157, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '11:36 AM', '112.198.75.173'),
(158, 'JENA MAE NACAR', 'Admin', 'Log In', 'Aug-12-2016', '11:36 AM', '112.198.75.173'),
(159, 'JOANNA MARIE NACAR', 'Instructor', 'Log In', 'Aug-12-2016', '11:36 AM', '112.198.75.173'),
(160, 'JONNALYN SAGUN', 'Printer', 'Log In', 'Aug-12-2016', '11:37 AM', '112.198.75.173'),
(161, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '11:41 AM', '112.198.75.173'),
(162, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '11:42 AM', '112.198.75.173'),
(163, 'JENA MAE NACAR', 'Admin', 'Logged Out', 'Aug-12-2016', '11:43 AM', '112.198.75.173'),
(164, 'JENA MAE NACAR', 'Admin', 'Log In', 'Aug-12-2016', '11:43 AM', '112.198.75.173'),
(165, 'JONNALYN SAGUN', 'Printer', 'Logged Out', 'Aug-12-2016', '11:44 AM', '112.198.75.173'),
(166, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '11:45 AM', '112.198.75.173'),
(167, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '11:45 AM', '112.198.75.173'),
(168, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '11:46 AM', '112.198.75.173'),
(169, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '11:47 AM', '112.198.75.173'),
(170, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '11:53 AM', '112.198.75.173'),
(171, 'JOANNA MARIE NACAR', 'Instructor', 'Logged Out', 'Aug-12-2016', '11:53 AM', '112.198.75.173'),
(172, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '11:54 AM', '112.198.75.173'),
(173, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '11:54 AM', '112.198.75.173'),
(174, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '11:55 AM', '112.198.75.173'),
(175, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '11:55 AM', '112.198.75.173'),
(176, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '11:55 AM', '112.198.75.173'),
(177, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '11:56 AM', '112.198.75.173'),
(178, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '11:59 AM', '112.198.75.173'),
(179, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '11:59 AM', '112.198.75.173'),
(180, 'JONNALYN SAGUN', 'Printer', 'Log In', 'Aug-12-2016', '11:59 AM', '112.198.75.173'),
(181, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:00 PM', '112.198.75.173'),
(182, 'JONNALYN SAGUN', 'Printer', 'Logged Out', 'Aug-12-2016', '12:01 PM', '112.198.75.173'),
(183, 'JONNALYN SAGUN', 'Printer', 'Log In', 'Aug-12-2016', '12:01 PM', '112.198.75.173'),
(184, 'JENA MAE NACAR', 'Admin', 'Logged Out', 'Aug-12-2016', '12:01 PM', '112.198.75.173'),
(185, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:02 PM', '112.198.75.173'),
(186, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:02 PM', '112.198.75.173'),
(187, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '12:02 PM', '112.198.75.173'),
(188, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:02 PM', '112.198.75.173'),
(189, 'JONNALYN SAGUN', 'Printer', 'Logged Out', 'Aug-12-2016', '12:03 PM', '112.198.75.173'),
(190, 'JENA MAE NACAR', 'Admin', 'Log In', 'Aug-12-2016', '12:03 PM', '112.198.75.173'),
(191, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:03 PM', '112.198.75.173'),
(192, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '12:03 PM', '112.198.75.173'),
(193, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:04 PM', '112.198.75.173'),
(194, 'EZEKIEL JOHN DULAY', 'Instructor', 'Log In', 'Aug-12-2016', '12:05 PM', '112.198.75.173'),
(195, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:05 PM', '112.198.75.173'),
(196, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:05 PM', '112.198.75.173'),
(197, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '12:07 PM', '112.198.75.173'),
(198, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:07 PM', '112.198.75.173'),
(199, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:07 PM', '112.198.75.173'),
(200, 'EZEKIEL JOHN DULAY', 'Instructor', 'Log In', 'Aug-12-2016', '12:07 PM', '112.198.75.173'),
(201, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:08 PM', '112.198.75.173'),
(202, 'EZEKIEL JOHN DULAY', 'Instructor', 'Logged Out', 'Aug-12-2016', '12:09 PM', '112.198.75.173'),
(203, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:09 PM', '112.198.75.173'),
(204, 'EZEKIEL JOHN DULAY', 'Instructor', 'Log In', 'Aug-12-2016', '12:09 PM', '112.198.75.173'),
(205, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '12:09 PM', '112.198.75.173'),
(206, 'EZEKIEL JOHN DULAY', 'Instructor', 'Logged Out', 'Aug-12-2016', '12:11 PM', '112.198.75.173'),
(207, 'EZEKIEL JOHN DULAY', 'Instructor', 'Logged Out', 'Aug-12-2016', '12:12 PM', '112.198.75.173'),
(208, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '12:12 PM', '112.198.75.173'),
(209, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '12:14 PM', '112.198.75.173'),
(210, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '12:16 PM', '112.198.75.173'),
(211, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:25 PM', '112.198.75.173'),
(212, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:25 PM', '112.198.75.173'),
(213, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:25 PM', '112.198.75.173'),
(214, ' ', '', 'Logged Out', 'Aug-12-2016', '12:25 PM', '112.198.75.173'),
(215, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:26 PM', '112.198.75.173'),
(216, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:26 PM', '112.198.75.173'),
(217, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:26 PM', '112.198.75.173'),
(218, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:26 PM', '112.198.75.173'),
(219, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:27 PM', '203.87.133.209'),
(220, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:28 PM', '203.87.133.209'),
(221, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:28 PM', '203.87.133.209'),
(222, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:28 PM', '203.87.133.209'),
(223, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:29 PM', '203.87.133.209'),
(224, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:29 PM', '203.87.133.209'),
(225, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:32 PM', '203.87.133.209'),
(226, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '12:32 PM', '203.87.133.209'),
(227, 'REMO ANTONIO LALATA', 'Instructor', 'Log In', 'Aug-12-2016', '12:33 PM', '203.87.133.209'),
(228, 'REMO ANTONIO LALATA', 'Instructor', 'Logged Out', 'Aug-12-2016', '12:36 PM', '203.87.133.209'),
(229, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '12:36 PM', '203.87.133.209'),
(230, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:29 PM', '112.198.75.173'),
(231, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:30 PM', '112.198.75.173'),
(232, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:31 PM', '112.198.75.173'),
(233, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:32 PM', '112.198.75.173'),
(234, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:35 PM', '112.198.75.173'),
(235, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:39 PM', '112.198.75.173'),
(236, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '01:50 PM', '112.198.75.173'),
(237, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '02:23 PM', '121.54.54.49'),
(238, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '02:52 PM', '112.198.75.173'),
(239, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '02:55 PM', '112.198.75.173'),
(240, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '03:34 PM', '112.198.75.173'),
(241, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '03:35 PM', '112.198.75.173'),
(242, 'JOANNA MARIE NACAR', 'Encoder', 'Log In', 'Aug-12-2016', '03:35 PM', '112.198.75.173'),
(243, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '03:37 PM', '112.198.75.173'),
(244, 'JOANNA MARIE NACAR', 'Encoder', 'Logged Out', 'Aug-12-2016', '03:40 PM', '112.198.75.173'),
(245, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '03:43 PM', '112.198.75.173'),
(246, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:57 PM', '112.198.75.173'),
(247, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:58 PM', '112.198.75.173'),
(248, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:58 PM', '112.198.75.173'),
(249, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:58 PM', '112.198.75.173'),
(250, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:58 PM', '112.198.75.173'),
(251, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:59 PM', '112.198.75.173'),
(252, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '03:59 PM', '112.198.75.173'),
(253, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:00 PM', '112.198.75.173'),
(254, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '03:59 PM', '112.198.75.173'),
(255, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:01 PM', '112.198.75.173'),
(256, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:03 PM', '112.198.75.173'),
(257, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:04 PM', '112.198.75.173'),
(258, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:06 PM', '112.198.75.173'),
(259, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:06 PM', '112.198.75.173'),
(260, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:17 PM', '112.198.75.173'),
(261, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:19 PM', '112.198.75.173'),
(262, 'BELUNA LIN APLAON', 'Encoder', 'Log In', 'Aug-12-2016', '04:19 PM', '112.198.75.173'),
(263, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:20 PM', '112.198.75.173'),
(264, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:24 PM', '112.198.75.173'),
(265, 'BELUNA LIN APLAON', 'Encoder', 'Logged Out', 'Aug-12-2016', '04:25 PM', '112.198.75.173'),
(266, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '04:25 PM', '112.198.75.173'),
(267, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '05:14 PM', '112.198.75.173'),
(268, 'JOANNA MARIE NACAR', 'Encoder', 'Log In', 'Aug-12-2016', '05:14 PM', '112.198.75.173'),
(269, 'JOANNA MARIE NACAR', 'Encoder', 'Logged Out', 'Aug-12-2016', '05:45 PM', '112.198.75.173'),
(270, 'Antonio Remo', 'Admin', 'Log In', 'Aug-12-2016', '05:46 PM', '112.198.75.173'),
(271, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-12-2016', '06:06 PM', '112.198.75.173'),
(272, 'Antonio Remo', 'Admin', 'Log In', 'Aug-13-2016', '01:05 AM', '121.54.54.131'),
(273, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-14-2016', '03:36 PM', '::1'),
(274, 'Antonio Remo', 'Admin', 'Log In', 'Aug-14-2016', '03:36 PM', '::1'),
(275, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-14-2016', '03:37 PM', '::1'),
(276, 'REMO ANTONIO LALATA', 'Instructor', 'Log In', 'Aug-14-2016', '03:37 PM', '::1'),
(277, 'REMO ANTONIO LALATA', 'Instructor', 'Logged Out', 'Aug-14-2016', '03:37 PM', '::1'),
(278, 'REMO ANTONIO LALATA', 'Instructor', 'Log In', 'Aug-14-2016', '03:37 PM', '::1'),
(279, 'REMO ANTONIO LALATA', 'Instructor', 'Logged Out', 'Aug-14-2016', '03:37 PM', '::1'),
(280, 'Antonio Remo', 'Admin', 'Log In', 'Aug-14-2016', '03:37 PM', '::1'),
(281, 'REMO ANTONIO LALATA', 'Instructor', 'Log In', 'Aug-14-2016', '03:40 PM', '::1'),
(282, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-14-2016', '03:55 PM', '::1'),
(283, 'Antonio Remo', 'Admin', 'Log In', 'Aug-14-2016', '03:55 PM', '::1'),
(284, 'Antonio Remo', 'Admin', 'Log In', 'Aug-14-2016', '10:02 PM', '::1'),
(285, 'AA AA', 'Encoder', 'Log In', 'Aug-15-2016', '12:55 AM', '::1'),
(286, 'AA AA', 'Encoder', 'Logged Out', 'Aug-15-2016', '12:55 AM', '::1'),
(287, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-15-2016', '12:58 AM', '::1'),
(288, 'Antonio Remo', 'Admin', 'Log In', 'Aug-15-2016', '12:58 AM', '::1'),
(289, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-15-2016', '12:58 AM', '::1'),
(290, 'Antonio Remo', 'Admin', 'Log In', 'Aug-15-2016', '12:58 AM', '::1'),
(291, 'AA AA', 'Encoder', 'Log In', 'Aug-15-2016', '01:01 AM', '::1'),
(292, 'AA AA', 'Encoder', 'Logged Out', 'Aug-15-2016', '01:02 AM', '::1'),
(293, 'AA AA', 'Encoder', 'Log In', 'Aug-15-2016', '01:02 AM', '::1'),
(294, 'AA AA', 'Encoder', 'Log In', 'Aug-15-2016', '01:14 AM', '::1'),
(295, 'Antonio Remo', 'Admin', 'Log In', 'Aug-15-2016', '11:55 AM', '::1'),
(296, 'Antonio Remo', 'Admin', 'Log In', 'Aug-16-2016', '10:11 PM', '::1'),
(297, 'Antonio Remo', 'Admin', 'Log In', 'Aug-17-2016', '09:21 PM', '::1'),
(298, 'Antonio Remo', 'Admin', 'Log In', 'Aug-18-2016', '12:23 AM', '::1'),
(299, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-18-2016', '12:23 AM', '::1'),
(300, 'Antonio Remo', 'Admin', 'Log In', 'Aug-18-2016', '12:23 AM', '::1'),
(301, 'Antonio Remo', 'Admin', 'Log In', 'Aug-18-2016', '11:02 AM', '::1'),
(302, 'Antonio Remo', 'Admin', 'Log In', 'Aug-18-2016', '10:33 PM', '::1'),
(303, 'Antonio Remo', 'Admin', 'Logged Out', 'Aug-18-2016', '11:04 PM', '::1'),
(304, 'ANTONIO RAMIREZ', 'Instructor', 'Log In', 'Aug-18-2016', '11:04 PM', '::1'),
(305, 'ANTONIO RAMIREZ', 'Instructor', 'Logged Out', 'Aug-18-2016', '11:11 PM', '::1'),
(306, 'ANTONIO RAMIREZ', 'Instructor', 'Log In', 'Aug-18-2016', '11:11 PM', '::1'),
(307, 'ANTONIO RAMIREZ', 'Instructor', 'Logged Out', 'Aug-18-2016', '11:13 PM', '::1'),
(308, 'EZEKIEL JOHN DULAY', 'Instructor', 'Log In', 'Aug-18-2016', '11:13 PM', '::1'),
(309, 'EZEKIEL JOHN DULAY', 'Instructor', 'Logged Out', 'Aug-18-2016', '11:13 PM', '::1'),
(310, 'PETER SEVILLA', 'Instructor', 'Log In', 'Aug-18-2016', '11:14 PM', '::1'),
(311, 'PETER SEVILLA', 'Instructor', 'Logged Out', 'Aug-18-2016', '11:15 PM', '::1'),
(312, 'Antonio Remo', 'Admin', 'Log In', 'Aug-18-2016', '11:15 PM', '::1'),
(313, 'Antonio Remo', 'Admin', 'Log In', 'Aug-20-2016', '08:44 PM', '::1'),
(314, 'Antonio Remo', 'Admin', 'Log In', 'Aug-21-2016', '11:40 PM', '::1'),
(315, 'Antonio Remo', 'Admin', 'Log In', 'Aug-22-2016', '11:43 AM', '::1'),
(316, 'Antonio Remo', 'Admin', 'Log In', 'Aug-23-2016', '12:00 AM', '::1'),
(317, 'Antonio Remo', 'Admin', 'Log In', 'Aug-23-2016', '12:39 PM', '::1'),
(318, 'Antonio Remo', 'Admin', 'Log In', 'Aug-23-2016', '11:08 PM', '::1'),
(319, 'Antonio Remo', 'Admin', 'Log In', 'Aug-24-2016', '08:40 PM', '::1'),
(320, 'Antonio Remo', 'Admin', 'Log In', 'Aug-25-2016', '11:15 PM', '::1'),
(321, 'Antonio Remo', 'Admin', 'Log In', 'Aug-26-2016', '08:55 PM', '::1'),
(322, 'Antonio Remo', 'Admin', 'Log In', 'Aug-27-2016', '09:05 PM', '::1'),
(323, 'Antonio Remo', 'Admin', 'Log In', 'Aug-28-2016', '08:36 PM', '::1'),
(324, 'Antonio Remo', 'Admin', 'Log In', 'Aug-29-2016', '11:17 AM', '::1'),
(325, 'Antonio Remo', 'Admin', 'Log In', 'Aug-29-2016', '07:27 PM', '::1'),
(326, 'Antonio Remo', 'Admin', 'Log In', 'Aug-30-2016', '10:54 AM', '::1'),
(327, 'JOANNA MARIE NACAR', 'Encoder', 'Log In', 'Aug-30-2016', '11:19 AM', '::1'),
(328, 'JOANNA MARIE NACAR', 'Encoder', 'Logged Out', 'Aug-30-2016', '11:19 AM', '::1'),
(329, 'JOANNA MARIE NACAR', 'Encoder', 'Log In', 'Aug-30-2016', '11:20 AM', '::1'),
(330, 'Antonio Remo', 'Admin', 'Log In', 'Aug-30-2016', '08:50 PM', '::1'),
(331, 'Antonio Remo', 'Admin', 'Log In', 'Aug-31-2016', '11:29 AM', '::1'),
(332, 'Antonio Remo', 'Admin', 'Log In', 'Aug-31-2016', '11:42 AM', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` varchar(100) NOT NULL,
  `section_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_description`) VALUES
('PL', 'PAUL'),
('TIM', 'TIMOTHY'),
('TIT', 'TITUS');

-- --------------------------------------------------------

--
-- Table structure for table `settings_instructor_number`
--

CREATE TABLE `settings_instructor_number` (
  `instructor_number_id` int(11) NOT NULL,
  `instructor_number_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_instructor_number`
--

INSERT INTO `settings_instructor_number` (`instructor_number_id`, `instructor_number_count`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings_student_number`
--

CREATE TABLE `settings_student_number` (
  `student_number_id` int(11) NOT NULL,
  `student_number_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_student_number`
--

INSERT INTO `settings_student_number` (`student_number_id`, `student_number_count`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33),
(34, 34);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_number` varchar(15) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `sy` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `church` varchar(200) NOT NULL,
  `course` varchar(200) NOT NULL,
  `year` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `image_path` text NOT NULL,
  `student_status` varchar(20) NOT NULL DEFAULT 'Pre-Registered',
  `date_enrolled` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_number`, `last_name`, `first_name`, `middle_name`, `sy`, `gender`, `birthdate`, `age`, `contact_number`, `email_address`, `church`, `course`, `year`, `section`, `status`, `count`, `image_path`, `student_status`, `date_enrolled`) VALUES
('14-0002', 'Bendillo', 'Maria Fatima', '', '14', 'Female', '', 0, '', '', '14', 'CE', '1', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0003', 'Aplaon', 'Beluna Lin', 'C', '14', 'Female', '08/12/2016', 0, '6509216807', 'sample@gmail.com', '14', 'CE', '4', 'TIM', 'Single', 0, 'image/students_image/AVPI 2012 (35).JPG', 'Pre-Registered', ''),
('14-0004', 'Colardo', 'Jabes James ', '_', '14', 'Male', '12/10/87', 0, '888888', 'jabes@yahoo', '13', 'PT', '2', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0005', 'Archog', 'Charity Joy', 'B', '14', 'Female', '08/11/1999', 17, '9178402944', 'jenamaen@gmail.com', '14', 'CE', '4', 'TIM', 'Single', 0, 'image/students_image/11156901_10203201113068449_913175801_n (1).jpg', 'Pre-Registered', ''),
('14-0006', 'Bendillo', 'Maria Lourdes', '', '14', 'Female', '', 0, '', '', '14', 'CE', '1', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0007', 'Giron', 'Calvin', 'A', '14', 'Male', '08/23/2016', 0, '09219800987', 'abc@yahoo.com', '26', 'PT', '3', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 30, 2016'),
('14-0008', 'Bondoc', 'Gemima Gail', '', '14', 'Female', '', 0, '', '', '18', 'CE', '1', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0009', 'Colardo', 'Jezreel Mae', '_', '14', 'Male', '08/10/2016', 0, '000', 'colardo@yahoo.com', '13', 'CE', '2', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0010', 'Flores', 'Samuel', 'E', '14', 'Male', '06/16/1999', 17, '9178402944', 'jenamaen@gmail.com', '14', 'PT', '4', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0011', 'Catabay', 'Regine', '', '14', 'Female', '', 0, '', '', '12', 'CE', '1', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0012', 'Cuya', 'Alvin', '_', '14', 'Male', '08/10/2016', 0, '9999999', 'cuya@yahoo.com', '13', 'PT', '2', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0013', 'Liad', 'Raffie', '', '14', 'Female', '', 0, '', '', '15', 'CE', '1', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0014', 'Katimbang', 'Lamberto', '_', '14', 'Male', '08/08/2016', 0, '9999999', 'katimbang@yahoo.com', '13', 'PT', '2', 'TIM', 'Married', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0015', 'Gerardo', 'Timothy', 'B', '14', 'Male', '07/13/1998', 18, '6509216807', 'sample@gmail.com', '14', 'PT', '4', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0016', 'Maypay', 'Aaron', '', '14', 'Male', '', 0, '', '', '12', 'PT', '1', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0017', 'Anabieza ', 'Albin', 'A', '14', 'Male', '04/28/2016', 28, '09209876778', 'jhuy@yahoo.com', '13', 'PT', '3', 'TIM', 'Married', 2, 'image/default_student.png', 'Pre-Registered', ''),
('14-0018', 'Panelo', 'Adrian', '_', '14', 'Male', '08/10/88', 0, '9999999', 'panelo@yahoo.com', '25', 'PT', '2', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0019', 'Llanes', 'Jessie James', 'B', '14', 'Male', '01/01/1997', 19, '6509216807', 'jenamaen@gmail.com', '14', 'PT', '4', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0020', 'Nacar', 'Jena Mae', 'D.', '14', 'Female', '05/12/1987', 29, '9495422522', 'jenamaen@gmail.com', '14', 'CE', '4', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0021', 'Balaguer', 'Dherleen Kaye', 'C', '14', 'Female', '08/03/2016', 0, '90909898', 'sdf@yahoo.com', '14', 'CE', '3', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0022', 'Bellen', 'Christian', 'A', '14', 'Male', '08/12/2016', 0, '090797', 'dfsd@yahoo.com', '13', 'PT', '3', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0023', 'Caalim', 'Jennielyn', 'A', '14', 'Female', '08/12/2016', 0, '09879087654', 'sdff@yahoo.com', '12', 'CE', '3', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('14-0027', 'Ccb', 'Cc', 'Gh', '14', 'Male', '08/10/2016', 0, '33', 'dfghmj@yahoo', '18', 'CE', '2', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('14-0028', 'Bbb', 'Bvhhhj', 'Cvv', '14', 'Male', '08/12/2016', 0, '9879', 'hg@yahoo.com', '20', 'CE', '3', 'TIM', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('15-0032', 'Bb', 'Bb', 'Bb', '15', 'Male', '08/09/1977', 39, '', '', '12', 'CE', '2', 'PL', 'Single', 1, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('16-0001', 'Abeleda', 'Lheonelyn', '_', '2014', 'Female', '08/03/1988', 28, '0999999', 'abeleda@yahoo.com', '13', 'CE', '2', 'TIM', 'Single', 0, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('16-0024', 'Pang all access', 'Sample', 'U', '16', 'Male', '08/02/2016', 0, '0', 'svsvs@gmail', '24', 'CE', '1', 'ALLAC', 'Married', 2, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('16-0025', 'Samplenamae', 'Sample', 'Sample', '16', 'Male', '08/02/1998', 18, '09898', 'dfasdfs@gmail.com', '14', 'CE', '4', 'ALLAC', 'Single', 0, 'image/default_student.png', 'Pre-Registered', ''),
('16-0029', 'Lalata', 'Remo antonio', 'O', '16', 'Male', '06/07/1995', 21, '0907897', 'lalata.remo@gmail.com', '17', 'PT', '1', 'ALLAC', 'Single', 1, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('16-0031', 'Aa', 'Aa', 'Aa', '16', 'Male', '08/02/1977', 39, '', '', '16', 'CE', '1', 'PL', '', 1, 'image/default_student.png', 'Enrolled', 'Aug 29, 2016'),
('16-0033', 'Cc', 'Cc', 'Cc', '16', 'Male', '08/12/1978', 38, '', '', '20', 'PT', '3', 'PL', 'Single', 1, 'image/default_student.png', 'Pre-Registered', ''),
('16-0034', 'Dd', 'Dd', 'Dd', '16', 'Male', '08/17/1978', 38, '', '', '20', 'CE', '4', 'PL', 'Married', 1, 'image/default_student.png', 'Pre-Registered', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `student_subject_id` int(11) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`student_subject_id`, `subject_id`, `student_number`, `year`) VALUES
(151, '38', '14-0002', '1'),
(152, '35', '14-0002', '1'),
(153, '35', '14-0006', '1'),
(154, '38', '14-0006', '1'),
(155, '39', '14-0006', '1'),
(156, '41', '14-0011', '1'),
(157, '39', '14-0011', '1'),
(158, '35', '14-0011', '1'),
(159, '38', '14-0011', '1'),
(160, '40', '14-0011', '1'),
(161, '38', '14-0008', '1'),
(162, '35', '14-0008', '1'),
(163, '38', '14-0013', '1'),
(164, '35', '14-0013', '1'),
(165, '35', '14-0016', '1'),
(166, '38', '16-0024', '1'),
(167, '35', '16-0024', '1'),
(168, '35', '16-0029', '1'),
(169, '38', '16-0029', '1'),
(170, '38', '16-0031', '1'),
(171, '35', '16-0031', '1'),
(172, '40', '16-0031', '1'),
(173, '35', '14-0004', '2'),
(174, '35', '14-0009', '2'),
(175, '35', '14-0012', '2'),
(176, '35', '14-0014', '2'),
(177, '35', '14-0018', '2'),
(178, '35', '14-0027', '2'),
(179, '35', '15-0032', '2'),
(180, '35', '16-0001', '2'),
(181, '35', '14-0007', '3'),
(182, '38', '14-0007', '3');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_description` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `course` varchar(205) NOT NULL,
  `section` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL,
  `sy` varchar(10) NOT NULL,
  `room` varchar(255) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `time` varchar(25) NOT NULL,
  `day` varchar(255) NOT NULL,
  `no_of_hours` varchar(200) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `encoder` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_description`, `unit`, `course`, `section`, `year`, `sy`, `room`, `start_time`, `end_time`, `time`, `day`, `no_of_hours`, `instructor`, `encoder`) VALUES
(35, 'AA', 'aa', '3', 'ALL', '', '', '11', 'Room1', '08:00', '09:00', '8:00 AM-9:00 AM', 'MON-TH', '1:0', '30', '49'),
(38, 'DD', 'dd', '3', 'CE', '', '', '11', 'Room1', '09:00', '10:00', '9:00 AM-10:00 AM', 'MON-TH', '1:0', '30', '49'),
(39, 'BB', 'bb', '3', 'ALL', '', '', '11', 'Room1', '09:30', '10:30', '9:30 AM-10:30 AM', 'MON-TH', '1:0', '', '49'),
(40, 'EE', 'ee', '3', 'ALL', '', '', '11', 'Room1', '13:00', '14:00', '1:00 PM-2:00 PM', 'TUE-FRI', '1:0', '', ''),
(41, 'CC', 'cc', '3', 'ALL', '', '', '11', 'Room1', '08:30', '09:30', '8:30 AM-9:30 AM', 'TUE-FRI', '1:0', '', ''),
(42, 'FF', 'ff', '3', 'ALL', '', '', '16', 'Room1', '15:00', '16:00', '3:00 PM-4:00 PM', 'MON-TH', '1:0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject_sections`
--

CREATE TABLE `subject_sections` (
  `subject_sections_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_sections`
--

INSERT INTO `subject_sections` (`subject_sections_id`, `subject_id`, `section_id`) VALUES
(61, 35, 'PL'),
(62, 35, 'TIM'),
(65, 38, 'PL'),
(66, 38, 'TIM'),
(67, 39, 'TIT'),
(68, 40, 'PL'),
(69, 40, 'TIT'),
(70, 41, 'TIT'),
(71, 42, 'PL');

-- --------------------------------------------------------

--
-- Table structure for table `subject_years`
--

CREATE TABLE `subject_years` (
  `subject_years_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_years`
--

INSERT INTO `subject_years` (`subject_years_id`, `subject_id`, `year_id`) VALUES
(2, 30, 1),
(5, 29, 1),
(6, 29, 2),
(14, 2, 1),
(15, 5, 1),
(16, 6, 4),
(17, 8, 3),
(18, 9, 1),
(19, 10, 2),
(20, 11, 1),
(21, 12, 3),
(22, 14, 2),
(23, 15, 4),
(24, 17, 2),
(25, 22, 3),
(26, 23, 3),
(27, 24, 4),
(28, 25, 3),
(29, 28, 3),
(30, 29, 1),
(31, 30, 1),
(32, 31, 1),
(36, 35, 1),
(37, 35, 2),
(40, 38, 1),
(41, 39, 1),
(42, 40, 1),
(43, 41, 1),
(44, 42, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `instructor_number` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(1000) NOT NULL,
  `suffix_name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthdate` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `church` varchar(200) NOT NULL,
  `sy` varchar(15) NOT NULL,
  `image_path` text NOT NULL,
  `new_user` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `instructor_number`, `username`, `password`, `first_name`, `last_name`, `middle_name`, `suffix_name`, `gender`, `birthdate`, `age`, `contact_number`, `email_address`, `church`, `sy`, `image_path`, `new_user`) VALUES
(1, 'admin', '', 'admin', 'ztWoy_IL2xFlSQ4M0_bQCf2T3FkTsi4INEn4yZBzpX0,', 'Antonio', 'Remo', 'Orlino', '', 'Male', '06/07/1995', 21, '09772795285', 'lalata.remo@gmail.com', '', '2010', 'image/default_user.png', 0),
(29, 'printer', '', 'Jonna', '9b8a9d197f97e594e304c67517ce2350', 'JONNALYN', 'SAGUN', 'AGBAYANI', '', 'Female', '12/10/1984', 31, '09174072626', 'jonna_sagun@yahoo.com', '11', '', 'image/default_user.png', 0),
(30, 'instructor', '10-002', 'manongej', '48d68b4b6b1044ca3d59adbd21e4b188', 'EZEKIEL JOHN', 'DULAY', ' .', ' .', 'Male', '08/25/1995', 20, '098765432', 'heheheh@gmail.com', '14', '', 'image/default_user.png', 0),
(31, 'instructor', '10-002', 'remo', '97a53ee9f45adfe53c762a72f83f6f43', 'REMO ANTONIO', 'LALATA', 'O', '', 'Male', '08/11/1975', 41, '0907897', 'lalata.remo@gmail.com', '11', '', 'image/default_user.png', 0),
(32, 'admin', '', 'jenamaen', 'b1fd4c10661f9d985f1db63ab84002f8', 'JENA MAE', 'NACAR', 'D.', '', 'Female', '05/12/1987', 29, '09178402944', 'jenamaen@gmail.com', '14', '', 'image/user_image/me.jpg', 1),
(33, 'instructor', '14-002', 'peter', 'lgIbUrSmaqb0koH_6qEbR2BcXlw70VyZnBgZtdHGzko,', 'PETER', 'SEVILLA', '__', '', 'Male', '', 0, '09206070', 'ICBCPS@yahoo.com', '', '', 'image/default_user.png', 0),
(34, 'instructor', '14-002', 'Ben', '1396796f644d592ffe80f124f0d6306d', 'BEN', 'APLAON', 'GRIJALDO', '', 'Male', '07/20/1942', 74, '09295320482', 'BGA@yahoo.com', '14', '', 'image/default_user.png', 1),
(35, 'instructor', '14-002', 'randy', '0c01251b1ff278fcd2daa0b8f6990fb4', 'RANDY', 'MIASCO', '', '', 'Male', '', 0, '', '', '11', '', 'image/default_user.png', 1),
(36, 'instructor', '14-002', 'jofie', '3c1b8ddee26500a4d25cea9e85b049b3', 'JOFIE', 'FERNANDEZ', '', '', 'Male', '', 0, '', '', '11', '', 'image/default_user.png', 1),
(37, 'instructor', '14-002', 'Rodge', 'c4919d7d3aff8464a0fb22230ff06225', 'RODRIGO', 'QUIRANTE', '__', 'Jr.', 'Male', '03/02/1984', 32, '99999999', 'rodge@yahoo.com', '11', '', 'image/default_user.png', 1),
(40, 'instructor', '-002', 'Francis', 'dbb005a5759b102d6378c32011660d57', 'FRANCIS', 'SIMEON', '___', '', 'Male', '00/00/00', 0, '0999999', 'francis@simeoyahoo.com', '18', '', 'image/default_user.png', 1),
(41, 'instructor', '14-002', 'paul', '6d7db5f54221fac6887c75b029348488', 'PAUL', 'CAROLINO', 'H', '', 'Male', '08/20/1987', 28, '09218090', 'JBFBC@yahoo.com', '23', '', 'image/default_user.png', 1),
(42, 'instructor', '14-002', 'bob', '2f99823a80cdad7be2b1fa9650c7b8ff', 'ROBERT', 'PATENAUDE', '', '', 'Male', '', 0, '', '', '24', '', 'image/default_user.png', 1),
(43, 'instructor', '14-002', 'eric', 'af568fba60edea64dd7c1d7f3c5c1c1d', 'ERIC', 'BOADO', '', '', 'Male', '', 0, '', '', '11', '', 'image/default_user.png', 1),
(45, 'instructor', '-002', 'Dann', '0ebdfd11a16b00c46d137aae1eb668b6', 'JAZER DANN', 'GODIN', '_', '', 'Male', '00/00/00', 0, '99999', 'jdan@yahoo.com', '11', '', 'image/default_user.png', 1),
(46, 'instructor', '14-002', 'bobby', 'e2fd37e6b7531d76cc22abe52f69de3b', 'BOBBY', 'COLARDO', 'H', '', 'Male', '06/15/2016', 52, '09287080', 'bbbcbb@yahoo.com', '13', '', 'image/default_user.png', 1),
(48, 'instructor', '-002', 'anton', 'lgIbUrSmaqb0koH_6qEbR2BcXlw70VyZnBgZtdHGzko,', 'ANTONIO', 'RAMIREZ', 'N', 'Jr', 'Male', '12/10/1980', 35, '09217890', 'LWBC@yqhoo.com', '25', '', 'image/default_user.png', 0),
(49, 'encoder', '', 'joanna', 'lgIbUrSmaqb0koH_6qEbR2BcXlw70VyZnBgZtdHGzko,', 'JOANNA MARIE', 'NACAR', 'DULAY', '', 'Female', '05/22/1993', 23, '09209634217', 'blnacar17@gmail.com', '14', '', 'image/default_user.png', 0),
(50, 'encoder', '', 'bel', '5ef99f965988cb4838fd245258ca2286', 'BELUNA LIN', 'APLAON', 'CABALATUNGAN', '', 'Female', '04/14/2016', 37, '09214218878', 'smile_bel@yahoo.com', '14', '', 'image/default_user.png', 0),
(51, 'admin', '', 'ezekieljohndulay', '8a921446c82905b81140206ab0fdc727', 'EZEKIEL JOHN', 'DULAY', ' .', ' .', 'Male', '08/25/1995', 20, '09999999991', 'ezekieljohndulay@gmail.com', '22', '', 'image/default_user.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_id` int(11) NOT NULL,
  `year_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_id`, `year_description`) VALUES
(1, '1st year'),
(2, '2nd year'),
(3, '3rd year'),
(4, '4th year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `church`
--
ALTER TABLE `church`
  ADD PRIMARY KEY (`church_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `grade_hps`
--
ALTER TABLE `grade_hps`
  ADD PRIMARY KEY (`grade_hps_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `settings_instructor_number`
--
ALTER TABLE `settings_instructor_number`
  ADD PRIMARY KEY (`instructor_number_id`);

--
-- Indexes for table `settings_student_number`
--
ALTER TABLE `settings_student_number`
  ADD PRIMARY KEY (`student_number_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_number`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`student_subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_sections`
--
ALTER TABLE `subject_sections`
  ADD PRIMARY KEY (`subject_sections_id`);

--
-- Indexes for table `subject_years`
--
ALTER TABLE `subject_years`
  ADD PRIMARY KEY (`subject_years_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `church`
--
ALTER TABLE `church`
  MODIFY `church_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `grade_hps`
--
ALTER TABLE `grade_hps`
  MODIFY `grade_hps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
--
-- AUTO_INCREMENT for table `settings_instructor_number`
--
ALTER TABLE `settings_instructor_number`
  MODIFY `instructor_number_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings_student_number`
--
ALTER TABLE `settings_student_number`
  MODIFY `student_number_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `student_subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `subject_sections`
--
ALTER TABLE `subject_sections`
  MODIFY `subject_sections_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `subject_years`
--
ALTER TABLE `subject_years`
  MODIFY `subject_years_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
