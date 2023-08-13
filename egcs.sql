-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 08:54 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `formid` int(11) NOT NULL,
  `student_name` varchar(25) NOT NULL,
  `office` varchar(25) NOT NULL,
  `sendStatus` varchar(25) NOT NULL,
  `sendDate` varchar(25) NOT NULL,
  `formStatus` varchar(25) NOT NULL,
  `formDate` varchar(25) NOT NULL,
  `formComments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`formid`, `student_name`, `office`, `sendStatus`, `sendDate`, `formStatus`, `formDate`, `formComments`) VALUES
(1, '1', '6', '1', '03-12-2020', '1', '03-12-2020', '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseid` int(11) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseCode` varchar(100) NOT NULL,
  `courseDepartment` varchar(25) NOT NULL,
  `courseDuration` int(11) NOT NULL,
  `courseDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `courseName`, `courseCode`, `courseDepartment`, `courseDuration`, `courseDescription`) VALUES
(1, 'Bachelor of Information Systems', 'BISM', '1', 3, 'For S.6 Leavers');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departid` int(11) NOT NULL,
  `departCode` varchar(25) NOT NULL,
  `departName` varchar(100) NOT NULL,
  `departHead` varchar(25) NOT NULL,
  `departDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageid` int(11) NOT NULL,
  `messageFrom` varchar(100) NOT NULL,
  `messageSender` varchar(100) NOT NULL,
  `messageDate` varchar(25) NOT NULL,
  `messageTitle` varchar(100) NOT NULL,
  `messageBody` text NOT NULL,
  `messageReceived` int(11) NOT NULL DEFAULT 1,
  `messageIncoming` int(11) NOT NULL DEFAULT 1,
  `messageSeen` int(11) NOT NULL DEFAULT 0,
  `messageReplied` int(11) NOT NULL DEFAULT 0,
  `messageReply` text NOT NULL,
  `messageRepliedby` varchar(25) NOT NULL,
  `messageRepliedon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageid`, `messageFrom`, `messageSender`, `messageDate`, `messageTitle`, `messageBody`, `messageReceived`, `messageIncoming`, `messageSeen`, `messageReplied`, `messageReply`, `messageRepliedby`, `messageRepliedon`) VALUES
(1, 'dj2@muni.ac.ug', 'Draku Job', '', 'Hello', '', 1, 1, 1, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `officeid` int(11) NOT NULL,
  `office_name` varchar(100) NOT NULL,
  `office_acronym` varchar(25) NOT NULL,
  `office_head` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`officeid`, `office_name`, `office_acronym`, `office_head`) VALUES
(1, 'Office of the Guild President', 'GP', ''),
(2, 'Head of Security', 'HoS', ''),
(3, 'Head, University Health Unit', 'HCU', ''),
(4, 'Head, Computer Laboratory', 'CL', ''),
(5, 'HEad, ICT Support (Systems Administrator)', 'ICT', ''),
(6, 'Head of Department', 'HoD', ''),
(7, 'Dean, Faculty of Technoscience', 'DFTS', ''),
(8, 'Director; Research, Innovation and Development', 'DIR', ''),
(9, 'University Librarian', 'Lib', ''),
(10, 'Dean of Students', 'DoS', ''),
(11, 'University Bursar', 'UB', ''),
(12, 'Academic Registrar', 'AR', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `shortname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `footer_text` text NOT NULL,
  `logo` text NOT NULL,
  `smtp_mail` varchar(100) NOT NULL,
  `smtp_host` varchar(100) NOT NULL,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_pass` text NOT NULL,
  `smtp_port` varchar(25) NOT NULL,
  `facebook_link` varchar(100) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `google_plus_link` varchar(100) NOT NULL,
  `whatsapp_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(100) NOT NULL,
  `instagram_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `shortname`, `address`, `email`, `phone`, `fax`, `footer_text`, `logo`, `smtp_mail`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `facebook_link`, `twitter_link`, `google_plus_link`, `whatsapp_link`, `linkedin_link`, `instagram_link`) VALUES
(1, 'Electronic Graduation Clearance System', 'EGCS', '', 'info@me.com', '098765098', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `idNumber` varchar(25) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `department` varchar(25) NOT NULL,
  `staffPosition` varchar(100) NOT NULL,
  `staffRole` varchar(25) NOT NULL,
  `staffOffice` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstName`, `lastName`, `username`, `password`, `idNumber`, `phoneNumber`, `emailAddress`, `department`, `staffPosition`, `staffRole`, `staffOffice`) VALUES
(2, 'Job', 'Draku', 'dj1@muni', 'a90546b13d1f2a59ca1e45980d940f5058d9ce5b', 'MU-ST002', '0786610580', 'dj1@muni.ac.ug', '1', 'Lecturer', 'HoD', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `othernames` varchar(100) NOT NULL,
  `studmail` varchar(100) NOT NULL,
  `studPhone` varchar(100) NOT NULL,
  `studCourse` varchar(100) NOT NULL,
  `regNumber` varchar(100) NOT NULL,
  `iDNumber` varchar(100) NOT NULL,
  `joinYear` varchar(25) NOT NULL,
  `studDepartment` int(11) NOT NULL,
  `dateOfCompletion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `surname`, `othernames`, `studmail`, `studPhone`, `studCourse`, `regNumber`, `iDNumber`, `joinYear`, `studDepartment`, `dateOfCompletion`) VALUES
(1, 'Draku', 'Job', 'dj1@muni.ac.ug', '0786610580', '1', 'MU014-0021G', 'MU014-0021-G', '2015', 1, '2020-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Userid` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` text NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Userphone` varchar(25) NOT NULL,
  `Usermail` varchar(100) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Userrole` int(11) NOT NULL DEFAULT 0,
  `User_status` int(11) NOT NULL DEFAULT 1,
  `officeHeaded` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Userid`, `Username`, `Password`, `Fullname`, `Userphone`, `Usermail`, `Position`, `Userrole`, `User_status`, `officeHeaded`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Academic Registrar', '0789100109', 'admin@muni.ac.ug', '', 1, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`formid`,`student_name`,`office`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`officeid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `officeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
