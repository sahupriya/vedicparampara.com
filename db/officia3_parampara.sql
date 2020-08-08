-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.2
-- Generation Time: Aug 04, 2020 at 09:07 AM
-- Server version: 5.7.30-33-log
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `officia3_parampara`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `username`, `password`, `entrydt`) VALUES
(1, 'Admin', 'admin', '12345', '2020-01-25 14:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `ayojan`
--

CREATE TABLE `ayojan` (
  `ayojan_id` int(11) NOT NULL,
  `ayojan_name` varchar(110) NOT NULL,
  `description` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `Convenience_Fee` varchar(20) NOT NULL,
  `GST` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `entrydt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ayojan`
--

INSERT INTO `ayojan` (`ayojan_id`, `ayojan_name`, `description`, `image`, `price`, `Convenience_Fee`, `GST`, `status`, `entrydt`) VALUES
(5, 'AAAAAAAAAAAA', 'dffs', 'uploads/ayojan/599191.png', '100', '50', '10', 1, '0000-00-00 00:00:00'),
(6, 'bbbbbbbbbbbbbbb', 'ggfghj', 'uploads/ayojan/27522IMG_20161119_094851.jpg', '222', '111', '10', 1, '0000-00-00 00:00:00'),
(7, 'Sundarkand', 'Jai Bajrangbali', '', '1500', '250', '10', 1, '0000-00-00 00:00:00'),
(8, 'Mundan', 'Mundan', '', '3000', '200', '18', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bhavya_ayojan`
--

CREATE TABLE `bhavya_ayojan` (
  `booking_id` int(11) NOT NULL,
  `ayojan_id` int(11) NOT NULL,
  `ayojan_name` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `amount` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `lattitude` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `entry_date` datetime NOT NULL,
  `pay_type` varchar(100) NOT NULL,
  `panditId` int(11) NOT NULL,
  `status` varchar(110) NOT NULL,
  `accepted_by` int(11) NOT NULL,
  `accepted_by_name` varchar(100) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `pandit_rating` int(11) NOT NULL,
  `pandit_feedback` varchar(200) NOT NULL,
  `user_feedback` varchar(200) NOT NULL,
  `transection_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bhavya_ayojan`
--

INSERT INTO `bhavya_ayojan` (`booking_id`, `ayojan_id`, `ayojan_name`, `user_id`, `user_name`, `date`, `time`, `amount`, `address`, `longitude`, `lattitude`, `pincode`, `city`, `entry_date`, `pay_type`, `panditId`, `status`, `accepted_by`, `accepted_by_name`, `user_rating`, `pandit_rating`, `pandit_feedback`, `user_feedback`, `transection_id`) VALUES
(1, 5, 'AAAAAAAAAAAA', 1, 'demo user', '2020-07-31', '02:10:00', '160', 'A-16, Kanpur', '80.2928457', '26.4287928', '208027', 'Kanpur Nagar', '2020-07-29 16:05:00', 'cash', 0, 'pending', 0, '', 0, 0, '', '', '51zbr3h096'),
(2, 5, 'AAAAAAAAAAAA', 1, 'demo user', '2020-07-31', '10:12:00', '160', 'A-16, Kanpur', '80.2928457', '26.4287928', '208027', 'Kanpur Nagar', '2020-07-29 16:11:00', 'cash', 9, 'accepted', 9, 'Ganesh', 0, 0, '', '', 'brx95wl4dg');

-- --------------------------------------------------------

--
-- Table structure for table `carousel_slider`
--

CREATE TABLE `carousel_slider` (
  `id` int(11) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `is_display` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carousel_slider`
--

INSERT INTO `carousel_slider` (`id`, `url`, `is_display`) VALUES
(12, 'uploads/slider/2020-05-23-11-19-15-banner3.jpg', 1),
(18, 'uploads/slider/2020-06-26-11-48-24-1.png', 1),
(19, 'uploads/slider/2020-06-26-11-49-01-IMG_20161119_094851.jpg', 1),
(20, 'uploads/slider/2020-07-03-09-35-14-png new.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `image` varchar(100) NOT NULL,
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`, `image`, `entrydt`) VALUES
(5, 'Idols', 1, 'uploads/category/11.jpeg', '2020-06-24 05:53:11'),
(12, 'Ratans/Stones', 1, 'uploads/category/jpg icon.jpg', '2020-07-11 17:44:21'),
(13, 'Spiritual Books', 1, 'uploads/category/download.jfif', '2020-07-29 17:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(11) NOT NULL,
  `commision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `commision`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `dailypandit`
--

CREATE TABLE `dailypandit` (
  `id` int(11) NOT NULL,
  `pandit_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `subscription_for` varchar(11) NOT NULL,
  `subscription_status` int(11) NOT NULL,
  `subscription_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dailypandit`
--

INSERT INTO `dailypandit` (`id`, `pandit_id`, `subscription_id`, `subscription_for`, `subscription_status`, `subscription_date`) VALUES
(4, 4, 1, 'office', 1, '2020-07-10'),
(5, 4, 3, 'office', 1, '2020-07-10'),
(6, 1, 1, 'office', 1, '2020-07-10'),
(7, 1, 3, 'office', 1, '2020-07-10'),
(8, 4, 2, 'home', 1, '2020-07-10'),
(9, 2, 7, 'home', 1, '2020-07-11'),
(10, 5, 1, 'office', 1, '2020-07-23'),
(11, 9, 2, 'home', 1, '2020-07-29'),
(12, 9, 6, 'office', 1, '2020-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `dailypandit_booking`
--

CREATE TABLE `dailypandit_booking` (
  `booking_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `organization` varchar(40) NOT NULL,
  `pandit_id` int(11) NOT NULL,
  `pay_type` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `entry_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `transection_id` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `lattitude` varchar(200) NOT NULL,
  `pincode` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dailypandit_booking`
--

INSERT INTO `dailypandit_booking` (`booking_id`, `subscription_id`, `user_id`, `user_name`, `email`, `mobile`, `organization`, `pandit_id`, `pay_type`, `price`, `entry_date`, `status`, `transection_id`, `address`, `longitude`, `lattitude`, `pincode`, `date`, `time`) VALUES
(1, 6, 14, '12:54', 'Nikhil Kumar', 'nk390338@gmail.', '', 9, 'cash', '1000', '2020-07-29 21:53:00', 0, '0zhw9n49yy', '27, Kanpur', '80.25148317217827', '26.496414948757273', '208017', '2020-07-31', '00:00:00'),
(2, 1, 16, '13:01', 'Please Enter Name', 'ganesh.bajpai@g', '', 0, 'cash', '100', '2020-07-31 13:46:00', 0, 'de9phvkru5', '10, Kanpur', '80.2781838', '26.4896608', '208025', '2020-08-02', '00:00:00'),
(3, 2, 16, '19:30', 'Ganesh', 'ganesh.bajpai@g', '', 9, 'cash', '200', '2020-08-02 15:48:00', 0, '3jvfqa7oev', '10, Kanpur', '80.2781846', '26.489662', '208025', '2020-08-05', '838:59:59'),
(4, 6, 16, '19:30', 'ganesh', 'ganesh.bajpai@g', '', 9, 'cash', '1000', '2020-08-02 15:53:00', 0, 'euykabo7fs', '24, Kanpur', '80.2780995', '26.4899284', '208025', '2020-08-06', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dailypandit_subscription`
--

CREATE TABLE `dailypandit_subscription` (
  `id` int(20) NOT NULL,
  `subscription_for` varchar(20) NOT NULL,
  `subscription_type` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dailypandit_subscription`
--

INSERT INTO `dailypandit_subscription` (`id`, `subscription_for`, `subscription_type`, `price`) VALUES
(1, 'office', '1', '100'),
(2, 'home', '1', '200'),
(3, 'office', '2', '300'),
(4, 'home', '3', '400'),
(6, 'office', '3', '1000'),
(7, 'home', '5', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donation_id` int(11) NOT NULL,
  `donation_cause` varchar(50) NOT NULL,
  `donation_discription` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donation_id`, `donation_cause`, `donation_discription`, `status`, `entrydate`) VALUES
(1, 'Corrona', 'eople may be sick with the virus for 1 to 14 days before developing symptoms. The most common symptoms of coronavirus disease (COVID-19) are fever, tiredness, and dry cough. Most people (about 80%) recover from the disease without needing special treatment.\r\nMore rarely, the disease can be serious and even fatal. Older people, and people with other medical conditions (such as asthma, diabetes, or heart disease), may be more vulnerable to becoming severely ill.', 1, '2020-04-08 16:24:33'),
(2, 'asadasd', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, '2020-06-26 19:47:01'),
(3, 'xyz', 'hhghgjj', 1, '2020-06-29 06:57:16'),
(4, 'Cow', 'for Gaushala', 1, '2020-07-11 11:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `donationlisting`
--

CREATE TABLE `donationlisting` (
  `donationListing_id` int(11) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `lattitude` varchar(200) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `cause` int(50) NOT NULL,
  `discription` text NOT NULL,
  `amt` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transection_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donationlisting`
--

INSERT INTO `donationlisting` (`donationListing_id`, `userId`, `userName`, `address`, `longitude`, `lattitude`, `pincode`, `city`, `cause`, `discription`, `amt`, `note`, `mode`, `status`, `entrydate`, `transection_id`) VALUES
(1, '1', 'demo user', 'A-16, Kanpur', '0.0', '0.0', '208027', 'Kanpur NagarIndia', 3, 'hhghgjj', '1000', 'fhjj', 'Paytm', '1', '2020-07-29 13:00:46', 'w3g5mlbzwy'),
(2, '14', 'Nikhil Kumar', '27, Kanpur', '0.0', '0.0', '208017', 'Kanpur NagarIndia', 4, 'for Gaushala', '200', 'xyydud', 'Paytm', '1', '2020-08-01 17:04:46', 'ujwqdeqzzr'),
(3, '1', 'demo user', 'A-16, Kanpur', '0.0', '0.0', '208027', 'Kanpur NagarIndia', 1, 'eople may be sick with the virus for 1 to 14 days before developing symptoms. The most common symptoms of coronavirus disease (COVID-19) are fever, tiredness, and dry cough. Most people (about 80%) recover from the disease without needing special treatment.\r\nMore rarely, the disease can be serious and even fatal. Older people, and people with other medical conditions (such as asthma, diabetes, or heart disease), may be more vulnerable to becoming severely ill.', '10000', 'fhjk', 'Paytm', '1', '2020-08-02 17:50:34', 'soqs41jryh');

-- --------------------------------------------------------

--
-- Table structure for table `kundali`
--

CREATE TABLE `kundali` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `dob` date NOT NULL,
  `place_birth` varchar(30) NOT NULL,
  `price` varchar(15) NOT NULL,
  `description` varchar(200) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `time_of_birth` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `language` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kundali`
--

INSERT INTO `kundali` (`id`, `user_id`, `name`, `date_time`, `dob`, `place_birth`, `price`, `description`, `contact`, `email`, `gender`, `time_of_birth`, `address`, `language`) VALUES
(1, 14, 'Nikhil Kumar', '2020-07-28 17:04:00', '1997-03-31', 'Kanpur', '300', '', '', '', '', '', '', 'Male'),
(2, 14, 'Nikhil Kumar', '2020-07-29 11:54:00', '1997-07-31', 'Kanpur', '300', '', '', '', 'Male', '', '', ''),
(3, 14, 'Nikhil Kumar', '2020-07-29 11:55:00', '2020-07-31', 'Kanpur', '300', '', '', '', 'Male', '', '', ''),
(4, 14, 'Nikhil Kumar', '2020-07-29 12:12:00', '1997-07-31', 'Kanpur', '300', 'hdhhd hhshd  hdhhs ', '8840011286', 'nk390338@gmail.', 'Male', '11:55 PM', 'Kanpur ', 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `mandal`
--

CREATE TABLE `mandal` (
  `mandal_id` int(11) NOT NULL,
  `mandali_name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `Convenience_Fee` varchar(20) NOT NULL,
  `GST` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandal`
--

INSERT INTO `mandal` (`mandal_id`, `mandali_name`, `description`, `image`, `price`, `Convenience_Fee`, `GST`, `status`, `entrydt`) VALUES
(1, 'Shiva Tandav', 'The Rahul mandali is famous for deliver Shiva tandav . more then 12 year of experience in this field and large number of group member.', 'uploads/mandal/13971c5054082-04ca-4642-90e0-7123a28e3dd0.png', '10000', '500', '18', 1, '2020-06-25 11:01:29'),
(2, 'Jagran', '', 'uploads/mandal/98048Hydrangeas.jpg', '5000', '250', '18', 1, '2020-06-25 11:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `mandal_booked`
--

CREATE TABLE `mandal_booked` (
  `booking_id` int(11) NOT NULL,
  `mandal_id` int(11) NOT NULL,
  `mandali_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL DEFAULT '00:00:00.000000',
  `amount` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `lattitude` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pay_type` varchar(100) NOT NULL,
  `panditId` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `accepted_by` int(11) NOT NULL,
  `accepted_by_name` varchar(100) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `pandit_rating` int(11) NOT NULL,
  `pandit_feedback` varchar(100) NOT NULL,
  `user_feedback` varchar(100) NOT NULL,
  `transection_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandal_booked`
--

INSERT INTO `mandal_booked` (`booking_id`, `mandal_id`, `mandali_name`, `user_id`, `user_name`, `date`, `time`, `amount`, `address`, `longitude`, `lattitude`, `pincode`, `city`, `entry_date`, `pay_type`, `panditId`, `status`, `accepted_by`, `accepted_by_name`, `user_rating`, `pandit_rating`, `pandit_feedback`, `user_feedback`, `transection_id`) VALUES
(1, 1, 'Shiva Tandav', 1, 'demo user', '2020-07-31', '03:59:00.000000', 10000, 'A-16, Kanpur', '80.2928457', '26.4287928', '208027', 'Kanpur Nagar', '2020-07-29 16:58:02', 'cash', 9, 'accepted', 9, 'Ganesh', 0, 0, '', '', '6v21bv1i6c'),
(2, 1, 'Shiva Tandav', 1, 'demo user', '2020-07-31', '03:55:00.000000', 10000, 'A-16, Kanpur', '80.2928457', '26.4287928', '208027', 'Kanpur Nagar', '2020-07-29 16:57:01', 'cash', 9, 'accepted', 9, 'Ganesh', 0, 0, '', '', 'a3304x08kz');

-- --------------------------------------------------------

--
-- Table structure for table `my_cart`
--

CREATE TABLE `my_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(200) NOT NULL,
  `prod_image` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `notify_by` text NOT NULL,
  `notify_by_name` text NOT NULL,
  `notify_by_image` varchar(100) NOT NULL DEFAULT 'uploads/user/default-user.jpg',
  `notify_to` text NOT NULL,
  `message` text NOT NULL,
  `link` text NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `notify_by`, `notify_by_name`, `notify_by_image`, `notify_to`, `message`, `link`, `seen`, `entrydt`) VALUES
(1, '30', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://ambitious.in.net/new/parampara/index.php/site/vendor', 1, '2020-03-16 17:29:53'),
(2, '31', 'qwertty', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://ambitious.in.net/new/parampara/index.php/site/vendor', 1, '2020-03-16 17:30:27'),
(3, '32', 'aajju', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://ambitious.in.net/new/parampara/index.php/site/vendor', 0, '2020-03-16 18:41:31'),
(4, '42', 'aaryanblue', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://ambitious.in.net/new/parampara/index.php/site/vendor', 0, '2020-03-17 09:25:33'),
(5, '43', 'shekhar', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://ambitious.in.net/new/parampara/index.php/site/vendor', 0, '2020-03-17 13:32:50'),
(6, '47', 'mahesh', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://ambitious.in.net/new/parampara/index.php/site/vendor', 0, '2020-03-17 17:09:41'),
(7, '48', 'Rakul preet', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-19 08:11:35'),
(8, '49', 'rakul', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-19 08:16:13'),
(9, '2', 'Rahul', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-19 10:12:25'),
(10, '14', 'munshi', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-21 11:25:06'),
(11, '15', 'munshi', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-21 11:25:39'),
(12, '20', 'amit tiwary', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-23 09:34:51'),
(13, '21', 'maheshwar', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-23 12:38:46'),
(14, '23', 'atul singh', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-29 11:10:19'),
(15, '29', 'raj mehrotra', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-31 19:08:50'),
(16, '30', 'raj mehrotra', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-03-31 19:09:25'),
(17, '31', 'Virend', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-04-01 04:43:05'),
(18, '32', 'Virend', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-04-01 04:43:05'),
(19, '33', 'Virend', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-04-01 04:43:05'),
(20, '46', 'naresh', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-19 16:52:43'),
(21, '47', 'aaryan', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-19 17:06:45'),
(22, '48', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-20 01:48:33'),
(23, '49', 'bikram', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-22 06:24:36'),
(24, '50', 'amit pujari', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-26 08:29:13'),
(25, '51', 'amit pujari', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-26 08:30:06'),
(26, '52', 'amit pujari', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-26 08:32:46'),
(27, '53', 'amit pujari', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-26 08:47:28'),
(28, '54', 'lalit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-26 08:58:30'),
(29, '55', 'hello', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-26 10:50:13'),
(30, '56', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 00:30:17'),
(31, '57', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 00:32:47'),
(32, '58', 'bikr', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 05:46:10'),
(33, '59', 'bikr', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 05:46:22'),
(34, '60', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 08:26:40'),
(35, '61', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 09:23:53'),
(36, '62', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 09:24:02'),
(37, '63', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 09:24:06'),
(38, '64', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 10:44:07'),
(39, '65', 'siddharth', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 10:49:05'),
(40, '66', 'bikram', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:02:13'),
(41, '67', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:28:31'),
(42, '68', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:31:26'),
(43, '69', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:33:52'),
(44, '70', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:36:02'),
(45, '71', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:38:53'),
(46, '72', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:43:57'),
(47, '73', 'birkm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 14:52:50'),
(48, '74', 'bikrm', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-27 15:04:50'),
(49, '75', 'pandir', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-04-28 05:27:18'),
(50, '76', 'bikram', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-01 08:21:04'),
(51, '77', 'bikram', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-01 08:36:03'),
(52, '78', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-01 16:36:26'),
(53, '79', 'rabwidkj', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-01 20:21:13'),
(54, '80', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 05:55:00'),
(55, '81', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 05:59:58'),
(56, '82', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 06:06:48'),
(57, '83', 'Siddharth', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 06:16:00'),
(58, '84', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 06:30:46'),
(59, '85', 'Siddharth', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 06:30:52'),
(60, '86', 'Siddharth', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 06:31:55'),
(61, '87', 'Siddharth', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-02 06:32:45'),
(62, '88', 'Bajpai', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-05-04 06:44:22'),
(63, '89', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-05-14 11:30:59'),
(64, '90', 'Bajpai.G', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-06 11:57:53'),
(65, '91', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-06 15:05:05'),
(66, '92', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-06 15:06:31'),
(67, '93', 'test', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-06 15:07:05'),
(68, '94', 'rahul pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-08 05:12:29'),
(69, '95', 'ib', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-08 08:50:07'),
(70, '96', 'ib', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-08 09:07:55'),
(71, '97', 'MD AZEEM ', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'https://parapara-dev.herokuapp.com/index.php/site/vendor', 0, '2020-06-09 16:40:46'),
(72, '98', 'sonu pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-25 10:59:54'),
(73, '99', 'Nikhil', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-25 11:56:41'),
(74, '100', 'aaryan', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-25 11:57:51'),
(75, '101', 'riya', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-26 16:12:24'),
(76, '102', 'demo pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-28 07:59:22'),
(77, '103', 'Nagendra', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-28 09:51:21'),
(78, '104', 'Nagendra', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-28 09:51:26'),
(79, '105', 'Nagendra', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-28 09:51:30'),
(80, '106', 'Nagendra', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-28 09:51:40'),
(81, '107', 'Ravi', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-28 16:02:19'),
(82, '108', 'rupendra', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-29 05:05:26'),
(83, '109', 'rupendra', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-29 05:06:43'),
(84, '110', 'Ravi', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-30 11:38:45'),
(85, '111', 'new pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-06-30 12:12:48'),
(86, '112', 'demo pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-02 07:39:55'),
(87, '113', 'xyz', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-04 07:44:15'),
(88, '114', 'new pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-04 09:42:03'),
(89, '115', 'new pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-04 09:42:58'),
(90, '116', 'testing', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-04 09:45:15'),
(91, '117', 'vicky', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-05 11:51:43'),
(92, '118', 'Vick', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-05 11:53:48'),
(93, '1', 'demo pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-06 12:46:00'),
(94, '1', 'demo pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-06 12:48:45'),
(95, '2', 'ganesh', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-06 15:44:39'),
(96, '3', 'xyz', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-07 07:42:24'),
(97, '4', 'xyz pandit', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-07 08:35:24'),
(98, '5', 'Nikhil Kumar', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-20 06:49:54'),
(99, '6', 'Ashish Handa', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-28 04:52:43'),
(100, '7', 'xyz', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-29 10:26:58'),
(101, '8', 'Nikhil Kumar', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-29 11:42:58'),
(102, '9', 'Ganesh', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-07-29 15:28:56'),
(103, '10', 'Ganesh', 'uploads/user/default-user.jpg', 'admin', 'A new Pandit has been Register, Please Approve The Pandit.', 'http://officialastitva.com/index.php/site/vendor', 0, '2020-08-02 10:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `officia3_parampara`
--

CREATE TABLE `officia3_parampara` (
  `admin_id` text,
  `admin_name` text,
  `username` text,
  `password` text,
  `entrydt` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officia3_parampara`
--

INSERT INTO `officia3_parampara` (`admin_id`, `admin_name`, `username`, `password`, `entrydt`) VALUES
('1', 'Admin', 'admin', '12345', '2020-01-25 17:08:47'),
('category_id', 'category_name', 'status', 'image', 'entrydt'),
('1', 'Fruits', '1', 'uploads/product/983520200419_193718.jpg', '2020-05-03 20:15:35'),
('2', 'Samagri', '1', '', '2020-03-29 10:33:59'),
('3', 'Spiritual Books', '1', '', '2020-05-03 20:14:41'),
('4', 'Flowers', '1', '', '2020-05-03 20:15:50'),
('5', 'Idols', '1', '', '2020-05-03 20:16:15'),
('6', 'Category 6', '1', '', '2020-04-04 13:06:05'),
('7', 'Category 7', '1', '', '2020-04-04 13:06:19'),
('8', 'category 8', '1', '', '2020-04-04 13:06:30'),
('9', 'Ratans/Stones', '1', '', '2020-05-03 19:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendorId` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL COMMENT '0=place,1=accept,2=packed,3=deliver,4=delivered,5=cancel by user,6=cancel by vender,7=cancel by admin,8=expierd',
  `updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) NOT NULL,
  `admin_amount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_rating` int(11) NOT NULL,
  `vender_rating` int(11) NOT NULL,
  `vendor_feedback` mediumtext NOT NULL,
  `user_feedback` mediumtext NOT NULL,
  `transection_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `vendorId`, `user_name`, `category_id`, `category_name`, `product_id`, `product_name`, `address`, `state`, `city`, `pincode`, `latitude`, `longitude`, `status`, `updateTime`, `amount`, `admin_amount`, `quantity`, `payment_mode`, `entry_date`, `user_rating`, `vender_rating`, `vendor_feedback`, `user_feedback`, `transection_id`) VALUES
(1, 1, '10', 'demo user', 5, 'Idols', 1, 'xyz', 'A-16, KanpurKanpur Nagar', 'null', 'Kanpur Nagar', '208027', '26.4287928', '80.2928457', '3', '0000-00-00 00:00:00', 390, 20, 2, 'cash', '2020-07-29 11:01:26', 0, 0, '', '', 'fanl31d09h'),
(2, 16, '42', 'Ganesh', 13, 'Spiritual Books', 2, 'Ramayan', '10, KanpurKanpur Nagar, Uttar Pradesh', 'Uttar Pradesh', 'Kanpur Nagar', '208025', '26.489662', '80.2781846', '6', '0000-00-00 00:00:00', 487, 25, 1, 'cash', '2020-08-02 11:04:52', 0, 0, '', '', 'q423utp4qb'),
(3, 1, '42', 'demo user', 13, 'Spiritual Books', 2, 'Ramayan', 'A-16, KanpurKanpur Nagar', 'null', 'Kanpur Nagar', '208027', '26.4287928', '80.2928457', '0', '0000-00-00 00:00:00', 974, 50, 2, 'cash', '0000-00-00 00:00:00', 0, 0, '', '', 'rrf73q3qtc');

-- --------------------------------------------------------

--
-- Table structure for table `pandit`
--

CREATE TABLE `pandit` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `logitude` varchar(50) NOT NULL,
  `lattitude` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `alternate_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `social_type` text NOT NULL,
  `social_id` text NOT NULL,
  `image` text NOT NULL,
  `aadhar_no` text NOT NULL,
  `aadhar_image` text NOT NULL,
  `dob` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `pancard_no` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `bank_ac_no` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `acc_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'USER',
  `status` int(11) NOT NULL DEFAULT '1',
  `register_id` varchar(255) NOT NULL,
  `pooja` text NOT NULL,
  `otp` text NOT NULL,
  `otp_verified` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0' COMMENT 'approved by admin',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avg_rating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pandit`
--

INSERT INTO `pandit` (`user_id`, `username`, `mobile`, `email`, `address`, `logitude`, `lattitude`, `password`, `alternate_no`, `gender`, `city`, `state`, `social_type`, `social_id`, `image`, `aadhar_no`, `aadhar_image`, `dob`, `country`, `pincode`, `skills`, `account_type`, `pancard_no`, `degree`, `bank_ac_no`, `experience`, `ifsc_code`, `acc_holder_name`, `bank_name`, `bio`, `type`, `status`, `register_id`, `pooja`, `otp`, `otp_verified`, `approved`, `entrydt`, `avg_rating`) VALUES
(1, 'demo pandit', '7905531241', 'p@gmail.com', 'B-768, Barra World Bank, Barra, Kanpur, Uttar Pradesh 208027, India', '80.293782', '26.4288732', 'HapjY1', '9087654123', 'Female', 'Kanpur Nagar', 'Uttar Pradesh', '', '', '', '987456321110', '', '7- 06- 2020', 'India', '208027', ' satyanarayan pooja , Sunderkaand, Navdurga Pooja, Ganesh Sthapna, Shop Opening', 'Saving Account', 'fhh125', 'ghj', '74123', '6 months', 'dg1', 'dgg', 'fhj', 'ghjk', 'PANDIT', 1, '', '', '3167', 1, 1, '2020-07-06 12:55:56', ''),
(7, 'xyz', '9889146893', 'xyz@gmail.com', '27, Panki Rd, Uptron Estate, Panki Industrial Area, Kalyanpur, Kanpur, Uttar Pradesh 208017, India', '80.25147411972284', '26.49642215018473', 'Priya@05', '9889146893', 'Female', 'Kanpur Nagar', 'Uttar Pradesh', '', '', '', '123456987120', '', '7- 26- 2020', 'India', '208017', 'Ganesh Sthapna', 'Saving Account', 'gh1346778', 'fhnj', '123456789', '6 months', 'er1356', 'dghj', 'fhjk', 'fhkk', 'PANDIT', 1, 'dfi84LrZRf2OJC8ppd7Tnf:APA91bGiwA_llcbNo_GRAChJXbC_vGxPGQuDWzyLM2TTmch1Tv3eP9kiXLq2_omwiR0VOob-XBYkz0SqyAWIoBb5LnYPeElbSX2E9vMhNdhOGKR-vE0U7z4mqCeY2hwNlHrloKMEmhwN', '', '2417', 1, 1, '2020-07-29 10:51:54', ''),
(8, 'Nikhil Kumar', '8840011286', 'nk12@gmail.com ', '27, Panki Rd, Uptron Estate, Panki Industrial Area, Kalyanpur, Kanpur, Uttar Pradesh 208017, India', '80.25151401758194', '26.49642094994685', 'wbLE1h', '', 'Male', 'Kanpur Nagar', 'Uttar Pradesh', '', '', '', '644646466446', '', '7- 01- 2020', 'India', '208017', 'Ganesh Sthapna', 'Saving Account', '727ggdgdgdg', '12', '6464545', 'More Than 2yr', 'ieieu626626', ' Nikhil Kumar', 'pnb', 'bxhg', 'PANDIT', 1, '', '', '3611', 1, 0, '2020-07-29 12:35:29', ''),
(9, 'Ganesh', '7505630792', 'ganesh.bajpai@gmail.com', '10, Vinayakpur, Sharda Nagar, Kanpur, Uttar Pradesh 208025, India', '80.27818355709314', '26.489660411263056', 'Ganesh@1234', '', '', 'Kanpur Nagar', 'Uttar Pradesh', '', '', '', '1234567812345678', '', '', 'India', '208025', ' satyanarayan pooja ', 'Saving Account', 'apcph7659b', 'BA', '586932475', 'Select Experience', 'kkbk001', 'Ganesh', 'kotak', '', 'PANDIT', 1, 'dkOmeF8yQ2e2FRGypq0LlX:APA91bHi-IRRODItRJ71_UnUG3R3SGf_AeNoyufWLDCRXmFAaRQ3NT7Dp3-yTj4I8XCOsx7KfKfIH4N1fIL9Wb8m3Pny7ON9ENyzYhrZJyTaXGuPp_HsUwLzzylDBIn1vnyourE2Eijv', '', '4336', 1, 1, '2020-07-29 16:54:25', ''),
(10, 'Ganesh', '9315841898', 'ganesh.bajpai@gmail.com', '10, Vinayakpur, Sharda Nagar, Kanpur, Uttar Pradesh 208025, India', '0.0', '0.0', 'Ganesh@1234', '', 'Male', 'Kanpur Nagar', 'Uttar Pradesh', '', '', '', '18523692580758', '', '9- 18- 1986', 'India', '208025', 'xyz', 'Saving Account', 'abhfdhjk', 'mba', '65328546', 'More Than 2yr', 'kkbk1234b', 'ganesh', 'kotak', '', 'PANDIT', 0, '', '', '8842', 1, 2, '2020-08-02 10:51:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `paramarsh`
--

CREATE TABLE `paramarsh` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `dob` date NOT NULL,
  `place_birth` varchar(50) NOT NULL,
  `question` varchar(100) NOT NULL,
  `preffered_timing` varchar(15) NOT NULL,
  `call_option` varchar(10) NOT NULL,
  `price` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `dob_time` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `prefered_language` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paramarsh`
--

INSERT INTO `paramarsh` (`id`, `user_id`, `name`, `date_time`, `dob`, `place_birth`, `question`, `preffered_timing`, `call_option`, `price`, `description`, `dob_time`, `email`, `gender`, `contact`, `prefered_language`) VALUES
(1, 16, 'Ganesh', '2020-07-31 13:39:00', '1986-09-18', 'kanpur', 'hello', '03:00 pm', 'Video', '700', 'hello', '10:55 AM', 'ganesh.bajpai@gmail.com', 'Male', '9990370943', 'English'),
(2, 14, 'Nikhil Kumar', '2020-08-01 20:05:00', '2020-08-01', 'Kanpur', 'hcufuf', '02:00 pm', 'Video', '700', 'n jvkvitjv', '8:5 PM', 'nk390338@gmail.com', 'Male', '9721892022', 'English'),
(3, 16, 'Ganesh', '2020-08-02 15:56:00', '1986-09-18', 'kanpur', 'problem', '03:00 pm', 'Video', '700', '???', '10:55 AM', 'ganesh.bajpai@gmail.com', 'Male', '9990370943', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `pooja`
--

CREATE TABLE `pooja` (
  `pooja_id` int(11) NOT NULL,
  `pooja_name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price_with_item` text NOT NULL,
  `price_without_item` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`pooja_id`, `pooja_name`, `description`, `image`, `price_with_item`, `price_without_item`, `status`, `entrydt`) VALUES
(1, ' satyanarayan pooja ', 'The Satyanarayan Puja is a religious worship of the Hindu god Vishnu. Satya means “truth” and narayana means, “The highest being” so Satyanarayan means “The highest being who is an embodiment of Truth”. Vrat or Puja means a religious vow, religious observance, or obligation', 'uploads/pooja/12680sta3.jpg,uploads/pooja/32181sat2.jpg,uploads/pooja/74064sat.jpg', '2500', '1200', 1, '2020-03-23 11:07:40'),
(3, 'Sunderkaand', 'Sundara Kaanda , is the fifth book in the Hindu epic, the Ramayana. The original Sundara Kanda is in Sanskrit and was composed by Valmiki, who was the first to scripturally record the Ramayana. Sundara Kanda is the only chapter of the Ramayana in which the hero is not Rama, but rather Hanuman. The work depicts the adventures of Hanuman and his selflessness, strength, and devotion to Rama are emphasized in the text. Hanuman was fondly called “Sundara” by his mother Anjani and Sage Valmiki chose this name over others as the Sundara Kanda is about Hanuman\'s journey to Lanka.', 'uploads/pooja/67707sunderkand.jpg', '2000', '1000', 1, '2020-03-23 11:06:47'),
(4, 'Navdurga Pooja', 'Durga Puja , also called Durgotsava , is an annual Hindu festival originating in the Indian subcontinent which reveres and pays homage to the Hindu goddess, Durga. It is particularly popular in the Indian states of West Bengal, Assam, Bihar, Tripura, and Odisha, the country of Bangladesh, and the diaspora from this region, and also in Nepal, where it is celebrated as Dashain. The festival is observed in the Indian calendar month of Ashwin, which corresponds to the months of September–October in the Gregorian calendar,and is a ten-day festival, of which the last five are of significance.The puja is performed in homes and in the public, the latter featuring temporary stage and structural decorations (known as pandals). The festival is also marked by scripture recitations, performance arts, revelry, gift giving, family visits, feasting, and public processions. Durga puja is an important festival in the Shaktism tradition of Hinduism.', 'uploads/pooja/51215navdurga.jpg', '2800', '1500', 1, '2020-03-23 11:10:57'),
(5, 'Ganesh Sthapna', 'Ganesh Chaturthi , also known as Vinayaka Chaturthi , is a Hindu festival celebrating the arrival of Ganesha to earth from Kailash Parvat with his mother goddess Parvati/Gauri. The festival is marked with the installation of Ganesha clay idols privately in homes, or publicly on elaborate pandals (temporary stages). Observations include chanting of Vedic hymns and Hindu texts such as, prayers and brata (fasting).[3] Offerings and prasadam from the daily prayers, that are distributed from the pandal to the community, include sweets such as modaka as it is believed to be a favourite of Lord Ganesh. The festival ends on the tenth day after start, when the idol is carried in a public procession with music and group chanting, then immersed in a nearby body of water such as a river or sea. In Mumbai alone, around 150,000 statues are immersed annually.[6] Thereafter the clay idol dissolves and Ganesha is believed to return to Mount Kailash to Parvati and Shiva.\r\n\r\n', 'uploads/pooja/55336Lalbaugh_Ganesha.jpg', '5000', '4000', 1, '2020-03-23 10:59:46'),
(6, 'Shop Opening', 'Shop Opening Pooja', 'uploads/pooja/11516icon.png', '1600', '1100', 1, '2020-05-03 17:04:24'),
(8, 'Mundan', 'Mundan Sanskar pooja', 'uploads/pooja/570894K-Carnival-Mask-Wallpaper-For-Desktop-1024x640.jpg', '2000', '1500', 1, '2020-06-12 16:40:45'),
(9, 'xyz', 'ttfytyutu', 'uploads/pooja/56742IMG_20161119_094851.jpg', '100', '200', 1, '2020-06-26 19:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `pooja_booking`
--

CREATE TABLE `pooja_booking` (
  `pooja_booking_id` int(11) NOT NULL,
  `pooja_id` int(11) NOT NULL,
  `pooja_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `panditId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `flat` text NOT NULL,
  `landmark` text NOT NULL,
  `colony` text NOT NULL,
  `pin` text NOT NULL,
  `city` text NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `lattitude` varchar(50) NOT NULL,
  `state` text NOT NULL,
  `with_item` text NOT NULL,
  `samagri` varchar(255) NOT NULL,
  `price` text NOT NULL,
  `payment_type` text NOT NULL,
  `status` text NOT NULL COMMENT '0-requested, 1-Accepted, 2- Expired,\r\n3- Pooja Completed,\r\n4- Cancelled By User,\r\n5- Cancelled By Pandit,\r\n6- Cancelled By Admin,\r\n7- Forwarded to another',
  `accepted_by` int(11) NOT NULL,
  `accepted_by_name` varchar(50) NOT NULL,
  `forwarded_by` int(11) NOT NULL,
  `forwarded_by_name` varchar(50) NOT NULL,
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_rating` int(11) NOT NULL,
  `pandit_rating` int(11) NOT NULL,
  `pandit_feedback` mediumtext NOT NULL,
  `user_feedback` mediumtext NOT NULL,
  `transection_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pooja_booking`
--

INSERT INTO `pooja_booking` (`pooja_booking_id`, `pooja_id`, `pooja_name`, `user_id`, `panditId`, `username`, `date`, `time`, `flat`, `landmark`, `colony`, `pin`, `city`, `longitude`, `lattitude`, `state`, `with_item`, `samagri`, `price`, `payment_type`, `status`, `accepted_by`, `accepted_by_name`, `forwarded_by`, `forwarded_by_name`, `entrydt`, `user_rating`, `pandit_rating`, `pandit_feedback`, `user_feedback`, `transection_id`) VALUES
(1, 1, ' satyanarayan pooja ', 14, 1, 'Nikhil Kumar', '2020-7-31', '15:00', '27, Kanpur Kanpur Nagar', 'kux bhi', 'India', '208017', '', '80.25148317217827', '26.496414948757273', '', '1', '', 'Rs 2500 /-', 'cash', 'pending', 0, '0', 1, 'demo user', '2020-07-25 17:26:07', 0, 0, '', '', '6oq0ze3fhk'),
(2, 1, ' satyanarayan pooja ', 1, 5, 'demo user', '2020-7-28', '18:00', 'A-16, Kanpur Kanpur Nagar', 'ghj', 'India', '208027', '', '80.2928457', '26.4287928', '', '0', '', 'Rs 1200 /-', 'cash', 'pending', 0, '0', 5, 'Vicky', '2020-07-27 10:36:24', 0, 0, '', '', '1zj7zv73ll'),
(3, 4, 'Navdurga Pooja', 16, 9, 'Ganesh', '2020-8-4', '10:30', '10, Kanpur Kanpur Nagar, Uttar Pradesh', 'temple', 'India', '208025', '', '80.27823485434055', '26.489703322282985', '', '1', '', 'Rs 2800 /-', 'cash', 'pending', 0, '0', 9, '', '2020-08-02 10:09:01', 0, 0, '', '', '405a9xx3vu'),
(4, 3, 'Sunderkaand', 16, 0, 'Ganesh', '2020-8-4', '10:30', '10, Kanpur Kanpur Nagar, Uttar Pradesh', 'near chapeda pulia', 'India', '208025', '', '80.2781843', '26.4896618', '', '1', '', 'Rs 2000 /-', 'cash', 'pending', 0, '', 0, '', '2020-08-02 10:01:42', 0, 0, '', '', 'reuopz8tkz'),
(5, 1, ' satyanarayan pooja ', 1, 0, 'demo user', '2020-8-16', '16:00', 'A-16, Kanpur Kanpur Nagar', 'ghj', 'India', '208027', '', '80.2928457', '26.4287928', '', '1', '', 'Rs 2500 /-', 'cash', 'pending', 0, '', 0, '', '2020-08-02 15:16:01', 0, 0, '', '', 'bhtj2v3ny4');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `privacy_policy` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `privacy_policy`) VALUES
(1, 'hghghghjgj6666666666666666666666');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `gst_no` varchar(30) NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` int(11) NOT NULL,
  `qty_type` varchar(50) NOT NULL,
  `avg_rating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `vendorId`, `category_id`, `category_name`, `name`, `gst_no`, `delivery_charge`, `price`, `description`, `image`, `status`, `entrydt`, `qty`, `qty_type`, `avg_rating`) VALUES
(1, 10, 5, 'Idols', 'xyz', '5', 100, 100, 'dgbj', 'uploads/product/3258Screenshot_2020-07-22-00-03-40-85.png', 1, '2020-07-29 11:01:20', 3, 'Kg', ''),
(2, 42, 13, 'Spiritual Books', 'Ramayan', '3', 100, 400, 'Book', 'uploads/product/965220200802_162754.jpg', 1, '2020-08-02 11:04:04', 3, 'Piece', '');

-- --------------------------------------------------------

--
-- Table structure for table `pujaassignpandit`
--

CREATE TABLE `pujaassignpandit` (
  `id` int(11) NOT NULL,
  `poojaId` int(11) NOT NULL,
  `panditId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pujaassignpandit`
--

INSERT INTO `pujaassignpandit` (`id`, `poojaId`, `panditId`) VALUES
(1, 1, 3),
(2, 1, 2),
(4, 1, 6),
(9, 2, 3),
(10, 2, 3),
(11, 3, 4),
(12, 2, 4),
(23, 5, 49),
(28, 4, 49),
(32, 4, 64),
(33, 1, 64),
(34, 0, 0),
(35, 0, 0),
(36, 0, 0),
(37, 0, 0),
(38, 0, 0),
(39, 0, 0),
(40, 0, 0),
(41, 0, 0),
(42, 0, 0),
(43, 0, 0),
(54, 3, 64),
(55, 5, 64),
(57, 4, 75),
(58, 3, 75),
(59, 5, 75),
(61, 5, 74),
(62, 4, 74),
(69, 3, 79),
(70, 4, 79),
(71, 5, 79),
(74, 4, 77),
(75, 3, 77),
(77, 1, 77),
(78, 1, 82),
(79, 5, 82),
(80, 4, 83),
(81, 3, 83),
(82, 5, 83),
(83, 3, 84),
(84, 5, 84),
(85, 1, 84),
(91, 1, 88),
(92, 3, 88),
(93, 4, 88),
(94, 5, 88),
(95, 6, 88),
(96, 1, 89),
(97, 3, 89),
(98, 4, 89),
(99, 5, 77),
(100, 7, 77),
(102, 1, 24),
(103, 3, 24),
(105, 1, 94),
(106, 8, 94),
(107, 6, 94),
(108, 5, 94),
(109, 4, 94),
(110, 1, 93),
(111, 4, 93),
(112, 5, 93),
(113, 8, 93),
(114, 6, 93),
(115, 3, 93),
(116, 6, 97);

-- --------------------------------------------------------

--
-- Table structure for table `range_limits`
--

CREATE TABLE `range_limits` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `distance_range` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `range_limits`
--

INSERT INTO `range_limits` (`id`, `name`, `distance_range`) VALUES
(1, 'pandit_seach', 15);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `sub_category_name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `terms` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `terms`) VALUES
(1, '1111111111111111111111113333333333333333333333335555555555555');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `data1` text NOT NULL,
  `data2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `data`, `data1`, `data2`) VALUES
(1, '\"{\\\"responseCode\\\":\\\"3001\\\",\\\"response\\\":\\\"11582069025410\\\"}\"', '9131692451', '');

-- --------------------------------------------------------

--
-- Table structure for table `theme_active`
--

CREATE TABLE `theme_active` (
  `theme_id` int(11) NOT NULL,
  `theme_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme_active`
--

INSERT INTO `theme_active` (`theme_id`, `theme_name`) VALUES
(1, 'css/theme-default.css');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `logitude` varchar(50) NOT NULL,
  `lattitude` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `alternate_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `flat` varchar(200) NOT NULL,
  `landmark` varchar(200) NOT NULL,
  `social_type` text NOT NULL,
  `social_id` text NOT NULL,
  `image` text NOT NULL,
  `aadhar_no` text NOT NULL,
  `aadhar_image` text NOT NULL,
  `dob` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `pancard_no` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `bank_ac_no` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `acc_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'USER',
  `status` int(11) NOT NULL DEFAULT '1',
  `register_id` varchar(255) NOT NULL,
  `pooja` text NOT NULL,
  `otp` text NOT NULL,
  `otp_verified` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0' COMMENT 'approved by admin',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kundali_status` int(3) NOT NULL,
  `paramars_status` int(4) NOT NULL,
  `poojabooking_status` int(11) NOT NULL,
  `ayojanbooking_status` int(11) NOT NULL,
  `mandalbooking_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `mobile`, `email`, `address`, `logitude`, `lattitude`, `password`, `alternate_no`, `gender`, `city`, `state`, `flat`, `landmark`, `social_type`, `social_id`, `image`, `aadhar_no`, `aadhar_image`, `dob`, `country`, `pincode`, `skills`, `account_type`, `pancard_no`, `degree`, `bank_ac_no`, `experience`, `ifsc_code`, `acc_holder_name`, `bank_name`, `bio`, `type`, `status`, `register_id`, `pooja`, `otp`, `otp_verified`, `approved`, `entrydt`, `kundali_status`, `paramars_status`, `poojabooking_status`, `ayojanbooking_status`, `mandalbooking_status`) VALUES
(1, 'demo user', '9889146893', 'p@gmail.com', 'A-16, Kanpur', '80.2928457', '26.4287928', 'Priya@05', '9087456321', '', 'Kanpur Nagar', 'Uttar Pradesh', '', 'ghj', '', '', '', '', '', '', 'India', '208027', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'd04mcOw3Qs6U3XqmUbIQNO:APA91bEYP-BqQGXw4hIyP-pNpaCy6Cv7LPexTL0VHLHf7vQSyCoN6jNaIgpD_Fh31oToTstyP02DzzU3XiT7ZJXHsUAn2QAQmMLJ9iGyDcUMOcgsYMQDh1WzkVpX6iKtPGYAER65jhrN', '', '1861', 1, 1, '2020-07-29 10:30:36', 0, 0, 0, 0, 0),
(16, 'Ganesh', '9990370943', 'ganesh.bajpai@gmail.com', '', '0.0', '0.0', 'Ganesh@1234', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'cBoyNxSSRAapLl4K6p1w85:APA91bHdZUDnOjp63MpxQXIxuPWfaaG1EtKjAVxFLGClu9FCm4DQ2pN9xSRWd9-kh5xarj5l4Qs9KS-MrokaLfBIrVb_H7UyEcneXWYTspZrnmX9eKc2CeXKkWkPNihjXicsM_i1bDEd', '', '8605', 1, 1, '2020-07-30 04:10:34', 0, 0, 0, 0, 0),
(17, 'lalit', '9935098056', 'lkm0027@gmail.com', '', '0.0', '0.0', 'Knp@12345', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'fYjj4s6XRlm4twOgszh6mL:APA91bFqxD28VnwJdb9MM-QpqrSBbxifykSRDgtg6V-itAzmSxjce1t18qXOiyJj2f5UAQ5JzSgESDYCe6penyoQTwn3B8CXE94n6OqaCReRrHTPJtvR7q43Y74Vhih-dYoVeY4FrQY2', '', '3222', 1, 1, '2020-08-01 17:38:32', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userselectedproduct`
--

CREATE TABLE `userselectedproduct` (
  `id` int(11) NOT NULL,
  `userId` varchar(11) NOT NULL,
  `productId` varchar(11) NOT NULL,
  `productQuanitiy` int(11) NOT NULL,
  `entryDate` varchar(100) NOT NULL,
  `updateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vender`
--

CREATE TABLE `vender` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `shopName` varchar(100) NOT NULL,
  `flatNo` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `panCard` varchar(100) NOT NULL,
  `adharCard` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `aadhar_image` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankAccountNumber` varchar(100) NOT NULL,
  `ifscCode` varchar(100) NOT NULL,
  `accountHolderName` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `isActive` varchar(100) NOT NULL,
  `createTime` datetime NOT NULL,
  `updateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vender`
--

INSERT INTO `vender` (`id`, `name`, `email`, `contact`, `shopName`, `flatNo`, `address`, `password`, `gender`, `panCard`, `adharCard`, `image`, `aadhar_image`, `bankName`, `bankAccountNumber`, `ifscCode`, `accountHolderName`, `latitude`, `longitude`, `otp`, `isActive`, `createTime`, `updateTime`) VALUES
(10, 'aaryanblue', 'aaryan@gmail.com', '9889146893', 'mystore', 'fhjk', '27, Panki Rd, Uptron Estate, Panki Industrial Area, Kalyanpur, Kanpur, Uttar Pradesh 208017, India', 'Atul@7888', 'Male', 'df135', '123456789098', '', 'uploads/user/aadhar3476IMG20200725001927.jpg', 'dgh', '123456', 'wr357', 'fghj', '26.4964026', '80.2514793', '1991', '2', '0000-00-00 00:00:00', '2020-04-28 11:15:16'),
(41, 'Nikhil Kumar', 'nk12@gmail.com ', '9721892022', 'bshs', '', '', 'Kumarr@v1', '', '', '', '', '', '', '', '', '', '0.0', '0.0', '6654', '1', '0000-00-00 00:00:00', '2020-07-29 14:47:23'),
(42, 'Ganesh', 'ganesh.bajpai@gmail.com', '9315841898', 'shri shop', '32/23', 'Kalyanpur\n', 'Ganesh@1234', 'Male', 'agichk112h', '122679964457899', '', '', 'icici', '123568965', 'icic564', 'ganesh', '0.0', '0.0', '6123', '2', '0000-00-00 00:00:00', '2020-08-02 13:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `virtualservice`
--

CREATE TABLE `virtualservice` (
  `virtual_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `userId` varchar(10) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `query` text NOT NULL,
  `dob` varchar(50) NOT NULL,
  `tob` varchar(50) NOT NULL,
  `cob` varchar(50) NOT NULL,
  `virtual_assumed` varchar(1) NOT NULL DEFAULT '1',
  `entry_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `virtual_service`
--

CREATE TABLE `virtual_service` (
  `id` int(11) NOT NULL,
  `virtual_service` varchar(100) NOT NULL,
  `price` varchar(1000) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `virtual_service`
--

INSERT INTO `virtual_service` (`id`, `virtual_service`, `price`, `description`) VALUES
(1, 'Paramars', '700', 'paramars description'),
(2, 'Kundali', '300', 'kundali description');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ayojan`
--
ALTER TABLE `ayojan`
  ADD PRIMARY KEY (`ayojan_id`);

--
-- Indexes for table `bhavya_ayojan`
--
ALTER TABLE `bhavya_ayojan`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `carousel_slider`
--
ALTER TABLE `carousel_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailypandit`
--
ALTER TABLE `dailypandit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailypandit_booking`
--
ALTER TABLE `dailypandit_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `dailypandit_subscription`
--
ALTER TABLE `dailypandit_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `donationlisting`
--
ALTER TABLE `donationlisting`
  ADD PRIMARY KEY (`donationListing_id`);

--
-- Indexes for table `kundali`
--
ALTER TABLE `kundali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandal`
--
ALTER TABLE `mandal`
  ADD PRIMARY KEY (`mandal_id`);

--
-- Indexes for table `mandal_booked`
--
ALTER TABLE `mandal_booked`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `my_cart`
--
ALTER TABLE `my_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pandit`
--
ALTER TABLE `pandit`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `paramarsh`
--
ALTER TABLE `paramarsh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pooja`
--
ALTER TABLE `pooja`
  ADD PRIMARY KEY (`pooja_id`);

--
-- Indexes for table `pooja_booking`
--
ALTER TABLE `pooja_booking`
  ADD PRIMARY KEY (`pooja_booking_id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `pujaassignpandit`
--
ALTER TABLE `pujaassignpandit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `range_limits`
--
ALTER TABLE `range_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `userselectedproduct`
--
ALTER TABLE `userselectedproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vender`
--
ALTER TABLE `vender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `virtualservice`
--
ALTER TABLE `virtualservice`
  ADD PRIMARY KEY (`virtual_id`);

--
-- Indexes for table `virtual_service`
--
ALTER TABLE `virtual_service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ayojan`
--
ALTER TABLE `ayojan`
  MODIFY `ayojan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bhavya_ayojan`
--
ALTER TABLE `bhavya_ayojan`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carousel_slider`
--
ALTER TABLE `carousel_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dailypandit`
--
ALTER TABLE `dailypandit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dailypandit_booking`
--
ALTER TABLE `dailypandit_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dailypandit_subscription`
--
ALTER TABLE `dailypandit_subscription`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donationlisting`
--
ALTER TABLE `donationlisting`
  MODIFY `donationListing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kundali`
--
ALTER TABLE `kundali`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mandal`
--
ALTER TABLE `mandal`
  MODIFY `mandal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mandal_booked`
--
ALTER TABLE `mandal_booked`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `my_cart`
--
ALTER TABLE `my_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pandit`
--
ALTER TABLE `pandit`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paramarsh`
--
ALTER TABLE `paramarsh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pooja`
--
ALTER TABLE `pooja`
  MODIFY `pooja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pooja_booking`
--
ALTER TABLE `pooja_booking`
  MODIFY `pooja_booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pujaassignpandit`
--
ALTER TABLE `pujaassignpandit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `range_limits`
--
ALTER TABLE `range_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userselectedproduct`
--
ALTER TABLE `userselectedproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vender`
--
ALTER TABLE `vender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `virtualservice`
--
ALTER TABLE `virtualservice`
  MODIFY `virtual_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `virtual_service`
--
ALTER TABLE `virtual_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
