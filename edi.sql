-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 02:36 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edi`
--

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `sid` int(10) NOT NULL,
  `issueid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `upvote` int(5) NOT NULL DEFAULT '0',
  `report` int(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`sid`, `issueid`, `userid`, `message`, `upvote`, `report`) VALUES
(1, 13, 24, 'Lawn is not maintained properly.', 1, 2),
(2, 13, 23, 'Yes, I agree. Some measures should be taken by college.', 1, 2),
(4, 13, 23, 'Any suggestions?', 0, 9),
(5, 13, 23, 'Yes, I have one suggestion', 0, 8),
(6, 13, 23, 'Okay, what is it?', 2, 2),
(12, 13, 23, 'A proper maintainance schedule should be maintained', 0, 1),
(13, 13, 25, 'YES!', 4, 4),
(14, 13, 23, 'OK', 0, 1),
(15, 28, 33, 'I think the prices for some items in canteen are pretty much high', 1, 0),
(17, 28, 30, 'Yes, I also think the same.', 0, 0),
(18, 28, 30, 'Those who have problem with the prices, we all should gather and talk with the canteen owner', 2, 0),
(19, 28, 36, 'But i think the canteen owner will not entertain us. We need some authority to look into the matter', 0, 0),
(20, 28, 34, 'Contactiong the student coordinator might help', 0, 0),
(21, 28, 30, 'We should all assemble and discuss the issue first with the student coordinator', 3, 0),
(22, 28, 30, 'Can someone contact student coordinator and see his free slots', 0, 0),
(23, 29, 30, 'Vishwakarandak is the annual inter department fest organized by vit. A platform for students to showcase their skills in various fields. Each year theme is decided for vishwakarandak.', 1, 0),
(24, 29, 30, 'So what do you guys suggest??What should be the theme this year??', 0, 0),
(25, 29, 37, '\"Quest for justice\"', 2, 0),
(26, 29, 34, '\"Quest for justice\" would be nice. Various departments can be categorized as members of justice league', 0, 0),
(27, 29, 33, 'What about \"Pirates of Caribbean\"??', 3, 0),
(28, 29, 35, '\"Avengers : Civil War\" - Each department would be fighting for their favorite superhero', 0, 0),
(29, 29, 36, 'Chemical Department wants Thor if avengers is decided as theme', 0, 0),
(30, 29, 34, 'Desh guys Should  we take iron man??', 0, 0),
(31, 29, 34, 'This year desh would win with the iron man', 0, 0),
(32, 13, 30, 'Yes, I also think the same.', 0, 0),
(33, 13, 30, 'This is a great idea!', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `organisation_id` int(5) NOT NULL,
  `form_id` varchar(8) NOT NULL,
  `question_id` int(10) NOT NULL,
  `Question` varchar(100) NOT NULL,
  `option1` varchar(50) NOT NULL,
  `option2` varchar(50) NOT NULL,
  `option3` varchar(50) NOT NULL,
  `option4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`organisation_id`, `form_id`, `question_id`, `Question`, `option1`, `option2`, `option3`, `option4`) VALUES
(1, '7c28d3db', 1, 'When should Vishwakarandak be held?', 'August', 'September', 'October', 'November'),
(1, '7c28d3db', 2, 'Theme?', 'Avengers', 'Pirates of Carribean', 'Justice League', 'Wrath of Gods'),
(1, '7c28d3db', 3, 'Dress code?', 'Traditional', 'Costumes', 'Western', 'Halloween'),
(3, '004a207e', 4, 'How good is our food?', 'Excellent', 'Good', 'Average', 'Bad'),
(3, '004a207e', 5, 'How is our management?', 'Excellent', 'Good', 'Average', 'Bad'),
(3, '004a207e', 6, 'How is our ambience?', 'Excellent', 'Good', 'Average', 'Bad'),
(3, '004a207e', 7, 'Where can we set up a branch?', 'Sinhgad Road', 'Swargate', 'FC Road', 'Kothrud');

-- --------------------------------------------------------

--
-- Table structure for table `form_description`
--

CREATE TABLE `form_description` (
  `form_id` varchar(8) NOT NULL,
  `form_name` varchar(30) NOT NULL,
  `form_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_description`
--

INSERT INTO `form_description` (`form_id`, `form_name`, `form_description`) VALUES
('004a207e', 'Feedback Form', 'Help us improve!'),
('7c28d3db', 'Vishwakarandak 2020', 'Vishwakarandak is an annual inter-departmental fest.');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `iid` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `level_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`iid`, `name`, `level_id`, `user_id`) VALUES
(13, 'maintainence', 5, 24),
(15, 'usage', 5, 24),
(28, 'prices', 4, 27),
(29, 'theme', 6, 27),
(30, 'quality', 4, 27),
(31, 'infrastructure', 9, 30),
(32, 'issue1', 5, 36),
(33, 'issue2', 5, 30),
(34, 'hygiene', 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `org_id` int(5) NOT NULL,
  `lid` int(10) NOT NULL,
  `lname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`org_id`, `lid`, `lname`) VALUES
(1, 4, 'canteen'),
(1, 5, 'lawn'),
(1, 6, 'vishwakarandak'),
(1, 9, 'classroom'),
(1, 10, 'research'),
(3, 11, 'Hygiene'),
(3, 12, 'Ambience'),
(4, 13, 'Placement'),
(4, 14, 'Mindspark');

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(5) NOT NULL,
  `org_name` varchar(30) NOT NULL,
  `admin_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`id`, `org_name`, `admin_id`) VALUES
(1, 'VIT', 28),
(3, 'nimantran', 31),
(4, 'coep', 32);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `response_id` int(10) NOT NULL,
  `form_id` varchar(8) NOT NULL,
  `qid` int(5) NOT NULL,
  `option_no` int(1) NOT NULL,
  `response_count` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`response_id`, `form_id`, `qid`, `option_no`, `response_count`) VALUES
(179, '7c28d3db', 1, 1, 1),
(180, '7c28d3db', 1, 2, 3),
(181, '7c28d3db', 1, 3, 1),
(182, '7c28d3db', 1, 4, 1),
(183, '7c28d3db', 2, 1, 2),
(184, '7c28d3db', 2, 2, 3),
(185, '7c28d3db', 2, 3, 0),
(186, '7c28d3db', 2, 4, 1),
(187, '7c28d3db', 3, 1, 1),
(188, '7c28d3db', 3, 2, 5),
(189, '7c28d3db', 3, 3, 0),
(190, '7c28d3db', 3, 4, 0),
(191, '004a207e', 4, 1, 1),
(192, '004a207e', 4, 2, 0),
(193, '004a207e', 4, 3, 0),
(194, '004a207e', 4, 4, 0),
(195, '004a207e', 5, 1, 0),
(196, '004a207e', 5, 2, 1),
(197, '004a207e', 5, 3, 0),
(198, '004a207e', 5, 4, 0),
(199, '004a207e', 6, 1, 0),
(200, '004a207e', 6, 2, 0),
(201, '004a207e', 6, 3, 1),
(202, '004a207e', 6, 4, 0),
(203, '004a207e', 7, 1, 0),
(204, '004a207e', 7, 2, 0),
(205, '004a207e', 7, 3, 0),
(206, '004a207e', 7, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(5) NOT NULL,
  `division` varchar(1) NOT NULL,
  `year` varchar(10) NOT NULL,
  `teacher_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `division`, `year`, `teacher_name`) VALUES
(26, 'E', 'TY', 'Mahesh Dube'),
(27, 'E', 'TY', 'Manikrao Dhore');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `email`, `password`, `role`) VALUES
(28, 'admin@vit.edu', 'vit', 1),
(30, '$2y$10$44jsGtDRnGHpYwVTiZ6EIOhvU1562hGWcPn2lu.grJsShOri9.p9.', 'apurv', 0),
(31, 'manager_nimantran@gmail.com', 'nimantran', 1),
(32, 'admin@coep.edu', 'coep', 1),
(33, '$2y$10$C9Q/iv7oHNAPJpd8hzEGrOmV2LiVgzuboSJmSuaQXMqT0oLSOrUmu', 'gargi', 0),
(34, '$2y$10$LMSUC80il9VCFU4UmMs0PeguY33Hkq92oRS6sK7R8OKrnOD/38ef.', 'abhijeet', 0),
(35, '$2y$10$i2XcgvQ/Czu5fP9hobnGO.ueHJ5cmpsiE4ONsGEZnyjlH/htiK5pW', 'vedang', 0),
(36, '$2y$10$kcaBIKGeeK8BUpqhpMwAu.q6pfaqd2BgikG1n7Ucc4QxahXK05nNS', 'ankita', 0),
(37, '$2y$10$usiXeGdHJv5652uXc41wiONm7lDAlb9mkvznywmvEe8.6bq7XMPS.', 'anuja', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `feedback_id` int(10) NOT NULL,
  `org_id` int(5) NOT NULL,
  `feedback` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`feedback_id`, `org_id`, `feedback`) VALUES
(10, 1, 'Except the infrastructure, the whole atmosphere feels really good'),
(11, 1, 'Academics in vit is really good. Lot of companies visit here for placements. '),
(12, 1, 'I was selected for the HOF program. This was only possible because of proficient faculty of VIT. I will always cherish this time of my life which has transfigured my future'),
(13, 3, 'Had a great time!'),
(14, 3, 'Rude Manager'),
(15, 3, 'Excellent food, good ambience, must visit!!!'),
(16, 4, 'One of the best engineering colleges in India'),
(17, 1, 'I like to study in VIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `form_description`
--
ALTER TABLE `form_description`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`lid`),
  ADD UNIQUE KEY `lname` (`lname`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `iid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `lid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `response_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
