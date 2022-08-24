-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 06:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maidneed`
--

-- --------------------------------------------------------

--
-- Table structure for table `maid`
--

CREATE TABLE `maid` (
  `id` int(5) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `phoneno` int(11) NOT NULL,
  `area` text NOT NULL,
  `gender` text NOT NULL,
  `expertise` text NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maid`
--

INSERT INTO `maid` (`id`, `name`, `address`, `phoneno`, `area`, `gender`, `expertise`, `age`) VALUES
(7, 'Jorina', 'erddff', 990808, 'azimpur', 'female', 'cook', 30),
(8, 'morjina', 'nnntyt', 2147483647, 'newmakrket', 'female', 'wash cloths', 22),
(9, 'Golapi', 'dfvg', 646, 'newmakrket', 'female', 'cook, washing', 33),
(10, 'Joba', 'nnntyt', 7777, 'newmakrket', 'female', 'babysitting', 21),
(11, 'Shiyuli', 'wecec', 7765543, 'dhanmondi', 'female', 'cleaner', 43),
(13, 'priyo', 'cvdsdf', 54355, 'dhanmondi', 'male', 'cleaner', 40),
(15, 'ejaz', 'vbdb', 8677, 'lalmatia', 'male', 'cook', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `maidid` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneno` int(11) NOT NULL,
  `nid` int(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `status` enum('pending','confirmed','','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `maidid`, `name`, `email`, `phoneno`, `nid`, `address`, `status`) VALUES
(1, 3, 'azad', '', 42343, 0, 'azad@mail.com', 'pending'),
(6, 1, 'sadasd', '', 2312, 0, 'asdsd@amsadas', 'confirmed'),
(8, 4, 'asdasd', '', 432, 343, 'asdsad', 'pending'),
(13, 8, 'gg', '', 2147483647, 2147483647, 'iqbal252206@nbobd.com', 'pending'),
(16, 15, 'shama', '', 454543232, 65756, 'dgg', 'confirmed');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `upd_conf_list` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
    IF OLD.status <> new.status THEN
        INSERT INTO user_has_maid(user_id,maid_id, active)
        VALUES(old.id, old.maidid, 'Active');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_has_maid`
--

CREATE TABLE `user_has_maid` (
  `user_id` int(11) NOT NULL,
  `maid_id` int(11) NOT NULL,
  `active` enum('Active','Deactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_has_maid`
--

INSERT INTO `user_has_maid` (`user_id`, `maid_id`, `active`) VALUES
(6, 1, 'Active'),
(11, 8, 'Active'),
(16, 15, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maid`
--
ALTER TABLE `maid`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maidid` (`maidid`);

--
-- Indexes for table `user_has_maid`
--
ALTER TABLE `user_has_maid`
  ADD UNIQUE KEY `user_id_2` (`user_id`,`maid_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `maid_id` (`maid_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maid`
--
ALTER TABLE `maid`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
