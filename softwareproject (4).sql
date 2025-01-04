-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2024 at 01:01 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softwareproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `requestID` int NOT NULL,
  `senderID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `receiverID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`requestID`, `senderID`, `receiverID`, `status`) VALUES
(3, '5', '6', 1),
(8, '5', '7', 0),
(9, '5', '19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactID` int NOT NULL,
  `F_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `L_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `F_name`, `L_name`, `email`, `subject`, `message`) VALUES
(1, 'Zaid', 'Ibrahim', 'xyz@gmail.com', 'test', 'hi , my name is zaid');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` int NOT NULL,
  `event_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `event_description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `event_time` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `event_owner_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `event_owner_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `event_name`, `event_description`, `event_date`, `event_time`, `event_owner_id`, `event_owner_name`) VALUES
(1, 'Data 2 event', 'i am going to solve the test bank', '2024-08-18', '11:00', '6', 'salem'),
(6, 'zaid event', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzz', '2024-08-19', '12:15', '5', 'zaidfraij'),
(7, 'software', 'hi', '2002-08-18', '17:12', '6', 'salem');

-- --------------------------------------------------------

--
-- Table structure for table `events_chat`
--

CREATE TABLE `events_chat` (
  `messageID` int NOT NULL,
  `senderID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `eventID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_chat`
--

INSERT INTO `events_chat` (`messageID`, `senderID`, `eventID`, `message`) VALUES
(1, '5', '1', 'hi'),
(2, '5', '1', 'my first event'),
(3, '7', '1', 'hala zaid'),
(4, '20', '1', 'hi'),
(5, '20', '1', 'jo&#039;jfbsdoiuvfbioca'),
(6, '20', '1', 'i love you alll '),
(7, '20', '1', '12.5'),
(8, '6', '1', 'مرحباا'),
(9, '20', '1', 'اشي بجننننننننن'),
(10, '20', '1', 'هلا والله '),
(11, '6', '1', '&lt;script&gt;alert(&quot;hi&quot;)&lt;/script&gt;'),
(12, '6', '6', 'test'),
(13, '6', '1', 'test'),
(14, '5', '7', 'zzzz');

-- --------------------------------------------------------

--
-- Table structure for table `general_chat`
--

CREATE TABLE `general_chat` (
  `msgID` int NOT NULL,
  `userID` int NOT NULL,
  `message` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_chat`
--

INSERT INTO `general_chat` (`msgID`, `userID`, `message`) VALUES
(22, 6, 'zaid'),
(23, 6, 'osama'),
(25, 6, 'hi'),
(26, 5, 'weeeeeeeeeeew'),
(27, 5, 'asas'),
(28, 5, 'no'),
(29, 7, 'ana sharekeh'),
(30, 8, 'hala'),
(31, 7, 'hala'),
(32, 5, 'hala'),
(33, 5, 'z'),
(34, 5, 'z'),
(35, 5, 'z'),
(36, 5, 'a'),
(37, 5, 'z'),
(38, 5, 'zzz'),
(39, 5, ''),
(40, 5, 'z'),
(41, 5, 'z'),
(42, 5, ''),
(43, 5, 'a'),
(44, 5, 'z'),
(45, 5, 'hi'),
(46, 6, '&lt;script&gt;alert(&quot;hi&quot;)&lt;/script&gt;'),
(47, 6, '&lt;script&gt;alert(&quot;hi&quot;)&lt;/script&gt;'),
(48, 21, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobID` int NOT NULL,
  `job_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `job_description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `job_owner_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `job_owner_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobID`, `job_name`, `job_description`, `email`, `job_owner_id`, `job_owner_name`) VALUES
(2, 'zaid job', 'zazazazazazazaza', 'salem@gmail.com', '5', 'zaidfraij'),
(3, 'zaid job', 'zazazazazazazaza', 'salem@gmail.com', '5', 'zaidfraij'),
(4, 'zaid job', 'zazazazazazazaza', 'salem@gmail.com', '5', 'zaidfraij');

-- --------------------------------------------------------

--
-- Table structure for table `password_token`
--

CREATE TABLE `password_token` (
  `user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime(6) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_token`
--

INSERT INTO `password_token` (`user`, `email`, `token`, `created`, `status`) VALUES
('zaidfraij', 'zaidfraij@outlook.com', '5c030ff7168460e90c399c5b41b8d02eeb0b0e20fa20bb398d886890d48c70dc', '2024-07-20 19:12:38.000000', '2'),
('zaidfraij', 'zaidfraij@outlook.com', '7d872242018af3831554231693103f9aaefe7eca2cbb06e93519b6dec5659e3c', '2024-07-20 19:19:14.000000', '2');

-- --------------------------------------------------------

--
-- Table structure for table `postcomments`
--

CREATE TABLE `postcomments` (
  `msgID` int NOT NULL,
  `postID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senderID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postcomments`
--

INSERT INTO `postcomments` (`msgID`, `postID`, `senderID`, `message`) VALUES
(1, '57', '6', 'mnawr zaid'),
(2, '57', '6', 'halaaaaaaaa\r\n'),
(3, '57', '6', '3sl'),
(4, '57', '6', 'zzzzzzzzzzz');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int NOT NULL,
  `post_content` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `image_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `post_owner_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `post_owner_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `post_content`, `image_name`, `post_owner_id`, `post_owner_name`) VALUES
(56, 'hi', NULL, '5', 'zaidfraij'),
(57, 'hi there', 'uploadspostimage/image.png', '5', 'zaidfraij'),
(58, 'my name is salem', 'uploadspostimage/183330.jpg', '6', 'salem');

-- --------------------------------------------------------

--
-- Table structure for table `private_chat`
--

CREATE TABLE `private_chat` (
  `msgID` int NOT NULL,
  `chatID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senderID` int NOT NULL,
  `receiverID` int NOT NULL,
  `message` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `private_chat`
--

INSERT INTO `private_chat` (`msgID`, `chatID`, `senderID`, `receiverID`, `message`) VALUES
(38, '3011', 5, 6, 'hi'),
(39, '3011', 5, 6, 'how are u'),
(40, '3011', 6, 5, 'hala'),
(41, '4213', 6, 7, 'صباح الخير'),
(42, '3512', 5, 7, 'صباح الفل'),
(43, '3512', 5, 7, 'hi'),
(44, '3011', 5, 6, 'http://localhost/SoftwareProject/post.php?postID=57');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectID` int NOT NULL,
  `project_leader_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `leader_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `project_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `project_description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectID`, `project_leader_id`, `leader_name`, `project_name`, `project_description`) VALUES
(1, '5', 'zaidfraij', 'zzzzzzzzzzzz', 'azazazazaazazazazazaza'),
(2, '6', 'salem', 'Software Project', 'I need four developers for software project');

-- --------------------------------------------------------

--
-- Table structure for table `regevents`
--

CREATE TABLE `regevents` (
  `regID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `eventID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `userID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regevents`
--

INSERT INTO `regevents` (`regID`, `eventID`, `userID`) VALUES
('120-19', '1', '20'),
('15-4', '1', '5'),
('16-5', '1', '6'),
('17-6', '1', '7'),
('660', '6', '6'),
('752', '7', '5'),
('761', '7', '6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `userSecret` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `salt`, `userSecret`, `role`) VALUES
(5, 'zaidfraij', 'zaidfraij@outlook.com', '5379091a9e1b88ad5c05ab683c161be4733ee5ebf1e9f562261cbb52d96c8691', '1321330212669be3fb280641.70953812', '5IGLFPCIGQ3HZSUK', 'student'),
(6, 'salem', 'salem@gmail.com', '72da434b271acb83d2709e6be9e4fd8cda292897d0d63307a747434e9b1d3167', '12232591666995055e9da11.47606687', 'TEEOJ24V7BJ3QQDG', 'alumni'),
(7, 'saif', 'saif@gmail.com', 'ca6d9ef4dc3ed8d7fbe2d3739462bbac1f15ccb9dd693105a8921a0d037b23be', '731929275669a5c9f3a9f14.01064414', '4M67AS2KR4A64PSK', 'company'),
(8, 'omar', 'omar@gmail.com', 'd523dfd093c04619fd9b75071696393fd096c64c41d17bd1770aa0bb6b1df5da', '773833911669bf8fb990e94.34547105', 'WNKY5QKGPJY322X2', 'student'),
(19, 'ahmad', 'ahmad@gmail.com', '5819b37ddb9eeafb604f42e08d8bc77345a3c2553a5043fbaac2d5a133bc850d', '66980459066be5141e392e6.22066012', '3226GJFY7NPM2M3O', 'alumni'),
(20, 'Mohammad', 'mohammadaltaher354@gmail.com', '344606f0da5ef684d592f59a9718a0227f5704cba2427a4e47493cf10c3f4515', '54670747766c1d0c97f4140.32415840', 'HYHCWY5VMFMPQ3QI', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `users_information`
--

CREATE TABLE `users_information` (
  `userID` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `F_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `L_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Phone_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'uploadsimage/default.jpg',
  `CV_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `available` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_information`
--

INSERT INTO `users_information` (`userID`, `F_name`, `L_name`, `about`, `Phone_number`, `image_name`, `CV_name`, `available`) VALUES
('19', NULL, NULL, NULL, NULL, 'uploadsimage/default.jpg', NULL, 1),
('20', 'mohammad', 'Altaher', 'I love doctor Hamad', '', 'uploadsimage/default.jpg', NULL, 0),
('21', NULL, NULL, NULL, NULL, 'uploadsimage/default.jpg', NULL, 0),
('23', NULL, NULL, NULL, NULL, 'uploadsimage/default.jpg', NULL, 0),
('24', NULL, NULL, NULL, NULL, 'uploadsimage/default.jpg', NULL, 0),
('5', 'Zaid', 'Ibrahim', 'cyber security student', '+962796305479', 'uploadsimage/Screenshot 2024-05-02 164948.png', 'uploadsCV/Zaid_Ibrahim_CV.pdf', 0),
('6', 'salem', 'Nsour', 'hi I am salem', '+962797528466', 'uploadsimage/183330.jpg', NULL, 1),
('7', NULL, NULL, NULL, NULL, 'uploadsimage/default.jpg', NULL, 0),
('8', NULL, NULL, NULL, NULL, 'uploadsimage/default.jpg', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `events_chat`
--
ALTER TABLE `events_chat`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `general_chat`
--
ALTER TABLE `general_chat`
  ADD PRIMARY KEY (`msgID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`msgID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `private_chat`
--
ALTER TABLE `private_chat`
  ADD PRIMARY KEY (`msgID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectID`);

--
-- Indexes for table `regevents`
--
ALTER TABLE `regevents`
  ADD PRIMARY KEY (`regID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`,`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_information`
--
ALTER TABLE `users_information`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `requestID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events_chat`
--
ALTER TABLE `events_chat`
  MODIFY `messageID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `general_chat`
--
ALTER TABLE `general_chat`
  MODIFY `msgID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `msgID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `private_chat`
--
ALTER TABLE `private_chat`
  MODIFY `msgID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
