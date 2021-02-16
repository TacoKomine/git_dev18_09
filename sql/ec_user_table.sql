-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2021 at 09:41 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ec_user_table`
--

CREATE TABLE `ec_user_table` (
  `id` int(12) NOT NULL,
  `u_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_pw` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ec_user_table`
--

INSERT INTO `ec_user_table` (`id`, `u_name`, `u_id`, `u_pw`, `is_admin`, `indate`) VALUES
(1, 'admin', 'admin', 'admin', 1, '2021-01-15 00:00:00'),
(2, 'test', 'test', 'test', 0, '2021-01-15 02:18:02'),
(3, 'コミネ　タカヒロ', 'takahiro.komine@hogemail.com', 'passwd', 0, '2021-01-15 23:27:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ec_user_table`
--
ALTER TABLE `ec_user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ec_user_table`
--
ALTER TABLE `ec_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
