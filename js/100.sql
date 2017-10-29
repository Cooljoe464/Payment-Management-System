-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2017 at 01:31 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reg`
--

-- --------------------------------------------------------

--
-- Table structure for table `100`
--

CREATE TABLE `100` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(256) DEFAULT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `first_name` varchar(256) DEFAULT NULL,
  `last_name` varchar(256) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `phone_number` bigint(12) DEFAULT NULL,
  `hostel_address` varchar(20) DEFAULT NULL,
  `name_of_sponsors` varchar(20) DEFAULT NULL,
  `phone_number_of_sponsors` bigint(12) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `avatar` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `100`
--

INSERT INTO `100` (`user_id`, `user_name`, `user_email`, `user_pass`, `first_name`, `last_name`, `date_of_birth`, `phone_number`, `hostel_address`, `name_of_sponsors`, `phone_number_of_sponsors`, `gender`, `department`, `avatar`) VALUES
(4, 'bhu/15/04/05/0034', 'kassandraakut@gmail.com', 'dafcc6108173f4fa342a94a7a61bff594a41db5995991dfb6292306e7f8757e4', 'Cassandra', 'Akut', '31/08/1996', 8069503257, 'Daniel Block', 'Cassandra Akut', 8069503257, 'root', 'Computer Science', 'image/14915487_723190704514499_170976154362112874_n.jpg'),
(3, 'bhu/15/04/05/0012', 'Cooljoe464@gmail.com', 'dafcc6108173f4fa342a94a7a61bff594a41db5995991dfb6292306e7f8757e4', 'Joel', 'Onyedinefu', '31/08/1996', 8102345985, 'Daniel Block', 'Joel Onyedinefu', 8102345985, 'root', 'Computer Science', 'image/Screenshot_20170301-234110.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `100`
--
ALTER TABLE `100`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `100_user_name_uindex` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `100`
--
ALTER TABLE `100`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
