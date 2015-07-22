-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2015 at 08:36 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `staff_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_data`
--

CREATE TABLE IF NOT EXISTS `access_data` (
`id` int(100) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_suspended` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `access_data`
--

INSERT INTO `access_data` (`id`, `user_id`, `password`, `user_type`, `is_suspended`, `is_deleted`) VALUES
(1, '0001', 'nopassword', 'TutorialStaff', 0, 0),
(2, '0002', 'nopassword', 'SystemAdmin', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(100) NOT NULL,
  `employeeId` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `othernames` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_of_birth` varchar(10) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `state_of_origin` varchar(255) NOT NULL,
  `lga` varchar(255) NOT NULL,
  `employment_date` varchar(10) NOT NULL,
  `retirement_date` varchar(10) NOT NULL,
  `staff_level` varchar(255) NOT NULL,
  `biography` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employeeId`, `firstname`, `lastname`, `othernames`, `gender`, `date_of_birth`, `nationality`, `state_of_origin`, `lga`, `employment_date`, `retirement_date`, `staff_level`, `biography`) VALUES
(1, '0001', 'Chukwuemeka', 'Nwobodo', 'Joseph', 'M', '1995-3-12', 'Nigerian', 'Enugu', 'Nkanu-East', '1970-01-01', '1970-01-01', '1', 'The Gitflow Workflow defines a strict \r\nbranching model designed around the \r\nproject release. While somewhat more \r\ncomplicated than the Feature Branch Workflow,\r\nthis provides a robust framework for managing larger projects.'),
(2, '0002', 'Chukwuemeka', 'Nwobodo', 'Joseph', 'M', '1995-3-12', 'Nigerian', 'Nnugu', 'Nkanu-East', '2014-01-01', '2034-01-01', '3', 'The Gitflow Workflow defines a strict branching model designed around the project release. While somewhat more complicated than the Feature Branch Workflow, this provides a robust framework for managing larger projects.');

-- --------------------------------------------------------

--
-- Table structure for table `employee_ranks`
--

CREATE TABLE IF NOT EXISTS `employee_ranks` (
`id` int(10) NOT NULL,
  `rank_num` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `min_qualification` varchar(10) NOT NULL,
  `min_year_of_service` int(2) NOT NULL,
  `min_num_of_supervisions` int(3) NOT NULL,
  `min_num_of_publications` int(3) NOT NULL,
  `min_scopus_indexes` int(3) NOT NULL,
  `min_thompson_indexex` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE IF NOT EXISTS `publications` (
`id` int(100) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(1000) NOT NULL,
  `publication_year` int(4) NOT NULL,
  `scopus_indexed` int(1) NOT NULL,
  `thompson_indexed` int(1) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `title`, `author`, `publisher`, `publication_year`, `scopus_indexed`, `thompson_indexed`, `status`) VALUES
(3, 'New Maths World', '0001', 'Oxford Publishers', 2005, 1, 1, 'Pending'),
(5, 'Oxford Education', '0001', 'Oxford Publishers', 2013, 0, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE IF NOT EXISTS `qualifications` (
`id` int(100) NOT NULL,
  `employeeId` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date_obtained` varchar(10) NOT NULL,
  `awarding_body` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `employeeId`, `title`, `category`, `date_obtained`, `awarding_body`, `status`) VALUES
(14, '0001', 'Comp Sc', 'B.Sc', '2015-7-21', 'UNN', 'Approved'),
(15, '0001', 'Maths Degree', 'B.Sc', '2015-7-21', 'UNN', 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `supervisions`
--

CREATE TABLE IF NOT EXISTS `supervisions` (
`id` int(100) NOT NULL,
  `project` text NOT NULL,
  `supervisor` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_data`
--
ALTER TABLE `access_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `staff_id` (`employeeId`);

--
-- Indexes for table `employee_ranks`
--
ALTER TABLE `employee_ranks`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `rank_num` (`rank_num`), ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisions`
--
ALTER TABLE `supervisions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_data`
--
ALTER TABLE `access_data`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_ranks`
--
ALTER TABLE `employee_ranks`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `supervisions`
--
ALTER TABLE `supervisions`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
