-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2018 at 03:48 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricwarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `isread` int(11) NOT NULL COMMENT '1="read" 0="unread"',
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile_no` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `subject`, `message`, `isread`, `name`, `email`, `mobile_no`, `status`, `create_date`, `modify_date`) VALUES
(1, '', 'Hi i want to active my accout', 0, 'mukesh', 'nirbhay.espsofttech@gmail.com', '+8962327488', 1, '2017-12-30 10:24:43', '2017-12-30 10:24:43'),
(2, '', 'Hi i want to active my accout', 0, 'mukesh', 'nirbhay.espsofttech@gmail.com', '+8962327488', 1, '2017-12-30 10:26:28', '2017-12-30 10:26:28'),
(3, '', 'Hi i want to active my accout', 0, 'mukesh', 'nirbhay.espsofttech@gmail.com', '+8962327488', 1, '2017-12-30 10:27:23', '2017-12-30 10:27:23'),
(4, '', 'Hi i want to active my accout', 0, 'mukesh', 'nirbhay.espsofttech@gmail.com', '+8962327488', 1, '2017-12-30 10:29:05', '2017-12-30 10:29:05'),
(5, 'activation', 'Hi i want to active my accout', 0, 'mukesh', 'nirbhay.espsofttech@gmail.com', '+8962327488', 1, '2017-12-30 10:32:30', '2017-12-30 10:32:30'),
(6, 'XYZ', 'hiii ', 0, 'pp', 'nirbhay.espsofttech@gmail.com', '1234567890', 1, '2018-01-03 05:26:29', '2018-01-03 05:26:29'),
(7, 'activation', 'Hi i want to active my accout', 0, 'mukesh', 'nirbhay.espsofttech@gmail.com', '+8962327488', 1, '2018-01-04 07:33:21', '2018-01-04 07:33:21'),
(8, 'hw rcu ?', 'hw rcu ?', 0, 'mayur', 'nirbhay.espsofttech@gmail.com', '99771489895', 1, '2018-01-04 08:12:10', '2018-01-04 08:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `ISO_636-1_Code` varchar(250) NOT NULL,
  `ISO_3166-1` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0="Deactive" 1="Active" 3="Deactive"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `ISO_636-1_Code`, `ISO_3166-1`, `status`) VALUES
(1, 'English', 'en', 'gb', 1),
(2, 'Urdu', 'ur', 'pk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `roleid` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`roleid`, `name`, `status`) VALUES
(1, 'Admin', 1),
(2, 'User', 1),
(3, 'Tipper', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `reg_id` varchar(250) NOT NULL,
  `login_id` varchar(250) NOT NULL,
  `login_type` int(11) NOT NULL COMMENT '1="api" 2="FB" 3="Google"',
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `show_password` varchar(250) NOT NULL,
  `mobile_no` varchar(250) NOT NULL,
  `mobile_status` int(11) NOT NULL COMMENT '1="verify" 0="unverify"',
  `dob` date NOT NULL,
  `language_id` varchar(250) NOT NULL DEFAULT '1',
  `login_status` int(11) NOT NULL COMMENT '0="offline" 1="online"',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0="deactive" 1="active" 3="Delete"',
  `image` varchar(250) NOT NULL,
  `user_background_image` varchar(250) NOT NULL,
  `userrole` int(11) NOT NULL COMMENT '|1|Leader |2|Executive |3|Head Department |4|Assistance |5|Front Disk |6|Call Center: |7|Online Jobs |8|Marketing A |9|Marketing B |10|Driver |11|Customer',
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_date` datetime NOT NULL,
  `address` text NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL,
  `fcm_token` text NOT NULL,
  `device_type` smallint(5) NOT NULL COMMENT '1="ios" 2="android"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `reg_id`, `login_id`, `login_type`, `name`, `email`, `password`, `show_password`, `mobile_no`, `mobile_status`, `dob`, `language_id`, `login_status`, `status`, `image`, `user_background_image`, `userrole`, `modify_date`, `create_date`, `address`, `latitude`, `longitude`, `fcm_token`, `device_type`) VALUES
(1, '45454545', '', 0, 'Admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '', '89898989899', 0, '2017-12-23', '1', 0, 1, '', '', 1, '2017-12-22 18:30:00', '2017-12-23 00:00:00', 'Indore', '', '', '', 0),
(26, 'HSSJMMEQ', '', 0, 'Pradeep', 'pradeep@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '+918962327475', 0, '0000-00-00', '123456', 0, 1, 'http://localhost/cricwarm/uploads/1515420159.jpg', '', 2, '2018-01-08 13:56:25', '2018-01-08 14:56:25', 'Rajwada, Indore, Madhya Pradesh, India', '22.71771000', '75.85448480', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
