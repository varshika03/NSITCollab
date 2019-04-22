-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2018 at 12:00 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `post_master`
--

CREATE TABLE `post_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_posted` text NOT NULL,
  `type` text NOT NULL,
  `picture` text NOT NULL,
  `comment` varchar(280) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_alumni`
--

CREATE TABLE `users_alumni` (
  `id` int(10) NOT NULL,
  `username` text NOT NULL,
  `name` varchar(170) CHARACTER SET utf8 NOT NULL,
  `picture` varchar(200) CHARACTER SET utf8 NOT NULL,
  `graduate_year` varchar(4) CHARACTER SET utf8 NOT NULL,
  `major` varchar(50) CHARACTER SET utf8 NOT NULL,
  `field_interests` varchar(500) CHARACTER SET utf8 NOT NULL,
  `bio` varchar(500) CHARACTER SET utf8 NOT NULL,
  `achievements` varchar(200) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8 NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8 NOT NULL,
  `behance` varchar(100) CHARACTER SET utf8 NOT NULL,
  `codepen` varchar(100) CHARACTER SET utf8 NOT NULL,
  `github` varchar(100) CHARACTER SET utf8 NOT NULL,
  `snapchat` varchar(100) CHARACTER SET utf8 NOT NULL,
  `instagram` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tumblr` varchar(100) CHARACTER SET utf8 NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8 NOT NULL,
  `skills` varchar(500) CHARACTER SET utf8 NOT NULL,
  `software` varchar(500) CHARACTER SET utf8 NOT NULL,
  `languages` varchar(500) CHARACTER SET utf8 NOT NULL,
  `portfolio_link` varchar(350) CHARACTER SET utf8 NOT NULL,
  `resume_upload` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_alumni`
--

INSERT INTO `users_alumni` (`id`, `username`, `name`, `picture`, `graduate_year`, `major`, `field_interests`, `bio`, `achievements`, `facebook`, `linkedin`, `behance`, `codepen`, `github`, `snapchat`, `instagram`, `tumblr`, `twitter`, `skills`, `software`, `languages`, `portfolio_link`, `resume_upload`) VALUES
(4, 'quinteno', 'quinteno', '', '', '', '', 'quinten oneal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_employer`
--

CREATE TABLE `users_employer` (
  `id` int(10) NOT NULL,
  `username` text NOT NULL,
  `company_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `picture` varchar(200) CHARACTER SET utf8 NOT NULL,
  `company_overview` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `company_address` varchar(200) CHARACTER SET utf8 NOT NULL,
  `requirements` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `achievements` varchar(200) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(250) CHARACTER SET utf8 NOT NULL,
  `linkedin` varchar(250) CHARACTER SET utf8 NOT NULL,
  `website` varchar(350) CHARACTER SET utf8 NOT NULL,
  `career_link` varchar(500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_employer`
--

INSERT INTO `users_employer` (`id`, `username`, `company_name`, `picture`, `company_overview`, `company_address`, `requirements`, `achievements`, `facebook`, `linkedin`, `website`, `career_link`) VALUES
(3, 'bob', 'bob ross', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_following`
--

CREATE TABLE `users_following` (
  `followingID` int(11) NOT NULL,
  `followerID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_following`
--

INSERT INTO `users_following` (`followingID`, `followerID`) VALUES
(4, 2),
(2, 3),
(7, 4),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users_master`
--

CREATE TABLE `users_master` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_master`
--

INSERT INTO `users_master` (`id`, `username`, `email`, `password`, `type`) VALUES
(7, 'sonic', 'sonic@sega.com', 'f4143ed3d2857a843df06fa52d35e74679af7a8f', 'student'),
(2, 'test', 'test@example.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'professor'),
(3, 'bob', 'bob@ross.com', '58c08b5c98f630dafad5a60edf67e9927a19f9b2', 'employer'),
(4, 'quinteno', 'qtylero@gmail.com', 'c8ffdc0f8a0da307d9fd3f07f7bf4e66d7ed5c65', 'alumni'),
(5, 'asdsd', 'hello@example.com', '331a4f44a6a875b2ce139ae0c9ce5bb5e1ec0d97', 'student'),
(6, 'cheezit', 'cheez@it.com', '2bd655133ebf01420395863208e11b69230d5b94', 'professor'),
(8, 'testuser', 'testuser@gmail.com', '4864ccb4939929874a71c5255d77f90846dede54', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `users_professor`
--

CREATE TABLE `users_professor` (
  `id` int(10) NOT NULL,
  `username` text NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `picture` varchar(200) CHARACTER SET utf8 NOT NULL,
  `career_field` varchar(150) CHARACTER SET utf8 NOT NULL,
  `committee` varchar(250) CHARACTER SET utf8 NOT NULL,
  `research` varchar(500) CHARACTER SET utf8 NOT NULL,
  `bio` varchar(500) CHARACTER SET utf8 NOT NULL,
  `achievements` varchar(300) CHARACTER SET utf8 NOT NULL,
  `linkedin` varchar(200) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(200) CHARACTER SET utf8 NOT NULL,
  `behance` varchar(200) CHARACTER SET utf8 NOT NULL,
  `codepen` varchar(200) CHARACTER SET utf8 NOT NULL,
  `github` varchar(200) CHARACTER SET utf8 NOT NULL,
  `snapchat` varchar(100) CHARACTER SET utf8 NOT NULL,
  `instagram` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tumblr` varchar(100) CHARACTER SET utf8 NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_professor`
--

INSERT INTO `users_professor` (`id`, `username`, `name`, `picture`, `career_field`, `committee`, `research`, `bio`, `achievements`, `linkedin`, `facebook`, `behance`, `codepen`, `github`, `snapchat`, `instagram`, `tumblr`, `twitter`, `email`) VALUES
(2, 'test', 'testacct', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'cheezit', 'cheez it', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_student`
--

CREATE TABLE `users_student` (
  `id` int(10) NOT NULL,
  `username` text NOT NULL,
  `name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `picture` varchar(200) CHARACTER SET utf8 NOT NULL,
  `school_year` varchar(50) CHARACTER SET utf8 NOT NULL,
  `major` varchar(50) CHARACTER SET utf8 NOT NULL,
  `field_interests` varchar(500) CHARACTER SET utf8 NOT NULL,
  `bio` varchar(500) CHARACTER SET utf8 NOT NULL,
  `achievements` varchar(200) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8 NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8 NOT NULL,
  `behance` varchar(100) CHARACTER SET utf8 NOT NULL,
  `codepen` varchar(100) CHARACTER SET utf8 NOT NULL,
  `github` varchar(100) CHARACTER SET utf8 NOT NULL,
  `snapchat` varchar(100) CHARACTER SET utf8 NOT NULL,
  `instagram` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tumblr` varchar(100) CHARACTER SET utf8 NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8 NOT NULL,
  `skills` varchar(500) CHARACTER SET utf8 NOT NULL,
  `software` varchar(500) CHARACTER SET utf8 NOT NULL,
  `languages` varchar(500) CHARACTER SET utf8 NOT NULL,
  `organizations` varchar(500) CHARACTER SET utf8 NOT NULL,
  `portfolio_link` varchar(350) CHARACTER SET utf8 NOT NULL,
  `resume_upload` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_student`
--

INSERT INTO `users_student` (`id`, `username`, `name`, `picture`, `school_year`, `major`, `field_interests`, `bio`, `achievements`, `facebook`, `linkedin`, `behance`, `codepen`, `github`, `snapchat`, `instagram`, `tumblr`, `twitter`, `skills`, `software`, `languages`, `organizations`, `portfolio_link`, `resume_upload`) VALUES
(5, 'asdsd', 'heasdasd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'sonic', 'sonic the hedgehog', 'IMG_2360.JPG', '', '', '', 'GOTTA GO FAST!', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'testuser', 'testuser', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_master`
--
ALTER TABLE `users_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_master`
--
ALTER TABLE `users_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
