-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.2
-- Generation Time: Aug 04, 2020 at 09:26 AM
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
-- Database: `vedicpar_parampara`
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`, `entrydt`) VALUES
(1, 'Fruit', 1, '2020-03-29 07:34:31'),
(2, 'Samagri', 1, '2020-03-29 07:33:59'),
(3, 'Vegetable', 1, '2020-03-29 07:34:44'),
(4, 'Sport', 1, '2020-03-29 07:34:56'),
(5, 'category 5', 1, '2020-04-04 10:05:43'),
(6, 'Category 6', 1, '2020-04-04 10:06:05'),
(7, 'Category 7', 1, '2020-04-04 10:06:19'),
(8, 'category 8', 1, '2020-04-04 10:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donation_id` int(11) NOT NULL,
  `donation_cause` varchar(50) NOT NULL,
  `donation_discription` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donation_id`, `donation_cause`, `donation_discription`, `status`, `entrydate`) VALUES
(1, 'Corrona', 'eople may be sick with the virus for 1 to 14 days before developing symptoms. The most common symptoms of coronavirus disease (COVID-19) are fever, tiredness, and dry cough. Most people (about 80%) recover from the disease without needing special treatment.\r\nMore rarely, the disease can be serious and even fatal. Older people, and people with other medical conditions (such as asthma, diabetes, or heart disease), may be more vulnerable to becoming severely ill.', 1, '2020-04-08 16:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `donationlisting`
--

CREATE TABLE `donationlisting` (
  `donationListing_id` int(11) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `cause` varchar(50) NOT NULL,
  `discription` text NOT NULL,
  `amt` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` int(1) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandal`
--

INSERT INTO `mandal` (`mandal_id`, `mandali_name`, `description`, `image`, `price`, `Convenience_Fee`, `GST`, `status`, `entrydt`) VALUES
(1, 'Shiva Tandav', 'The Rahul mandali is famous for deliver Shiva tandav . more then 12 year of experience in this field and large number of group member.', 'uploads/mandal/13971c5054082-04ca-4642-90e0-7123a28e3dd0.png,uploads/mandal/98048Hydrangeas.jpg', '10000', '500', '18', 1, '2020-03-29 19:16:04');

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
  `time` datetime(6) NOT NULL,
  `amount` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `amount` int(10) NOT NULL,
  `quantity` int(5) NOT NULL,
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
  `seen` int(1) NOT NULL DEFAULT '0',
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
(19, '33', 'Virend', 'uploads/user/default-user.jpg', 'admin', 'A new Vendor has been Register, Please Approve The Vendor.', 'http://webnxt.online/index.php/site/vendor', 0, '2020-04-01 04:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `amount` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` int(1) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pooja`
--

INSERT INTO `pooja` (`pooja_id`, `pooja_name`, `description`, `image`, `price_with_item`, `price_without_item`, `status`, `entrydt`) VALUES
(1, ' satyanarayan pooja ', 'The Satyanarayan Puja is a religious worship of the Hindu god Vishnu. Satya means “truth” and narayana means, “The highest being” so Satyanarayan means “The highest being who is an embodiment of Truth”. Vrat or Puja means a religious vow, religious observance, or obligation', 'uploads/pooja/12680sta3.jpg,uploads/pooja/32181sat2.jpg,uploads/pooja/74064sat.jpg', '2500', '1200', 1, '2020-03-23 11:07:40'),
(3, 'Sunderkaand', 'Sundara Kaanda , is the fifth book in the Hindu epic, the Ramayana. The original Sundara Kanda is in Sanskrit and was composed by Valmiki, who was the first to scripturally record the Ramayana. Sundara Kanda is the only chapter of the Ramayana in which the hero is not Rama, but rather Hanuman. The work depicts the adventures of Hanuman and his selflessness, strength, and devotion to Rama are emphasized in the text. Hanuman was fondly called “Sundara” by his mother Anjani and Sage Valmiki chose this name over others as the Sundara Kanda is about Hanuman\'s journey to Lanka.', 'uploads/pooja/67707sunderkand.jpg', '2000', '1000', 1, '2020-03-23 11:06:47'),
(4, 'Navdurga Pooja', 'Durga Puja , also called Durgotsava , is an annual Hindu festival originating in the Indian subcontinent which reveres and pays homage to the Hindu goddess, Durga. It is particularly popular in the Indian states of West Bengal, Assam, Bihar, Tripura, and Odisha, the country of Bangladesh, and the diaspora from this region, and also in Nepal, where it is celebrated as Dashain. The festival is observed in the Indian calendar month of Ashwin, which corresponds to the months of September–October in the Gregorian calendar,and is a ten-day festival, of which the last five are of significance.The puja is performed in homes and in the public, the latter featuring temporary stage and structural decorations (known as pandals). The festival is also marked by scripture recitations, performance arts, revelry, gift giving, family visits, feasting, and public processions. Durga puja is an important festival in the Shaktism tradition of Hinduism.', 'uploads/pooja/51215navdurga.jpg', '2800', '1500', 1, '2020-03-23 11:10:57'),
(5, 'Ganesh Sthapna', 'Ganesh Chaturthi , also known as Vinayaka Chaturthi , is a Hindu festival celebrating the arrival of Ganesha to earth from Kailash Parvat with his mother goddess Parvati/Gauri. The festival is marked with the installation of Ganesha clay idols privately in homes, or publicly on elaborate pandals (temporary stages). Observations include chanting of Vedic hymns and Hindu texts such as, prayers and brata (fasting).[3] Offerings and prasadam from the daily prayers, that are distributed from the pandal to the community, include sweets such as modaka as it is believed to be a favourite of Lord Ganesh. The festival ends on the tenth day after start, when the idol is carried in a public procession with music and group chanting, then immersed in a nearby body of water such as a river or sea. In Mumbai alone, around 150,000 statues are immersed annually.[6] Thereafter the clay idol dissolves and Ganesha is believed to return to Mount Kailash to Parvati and Shiva.\r\n\r\n', 'uploads/pooja/55336Lalbaugh_Ganesha.jpg', '5000', '4000', 1, '2020-03-23 10:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `pooja_booking`
--

CREATE TABLE `pooja_booking` (
  `pooja_booking_id` int(11) NOT NULL,
  `pooja_id` int(11) NOT NULL,
  `pooja_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `flat` text NOT NULL,
  `landmark` text NOT NULL,
  `colony` text NOT NULL,
  `pin` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `with_item` text NOT NULL,
  `samagri` varchar(255) NOT NULL,
  `price` text NOT NULL,
  `payment_type` text NOT NULL,
  `status` text NOT NULL,
  `accepted_by` int(11) NOT NULL,
  `accepted_by_name` varchar(50) NOT NULL,
  `forwarded_by` int(11) NOT NULL,
  `forwarded_by_name` varchar(50) NOT NULL,
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pooja_booking`
--

INSERT INTO `pooja_booking` (`pooja_booking_id`, `pooja_id`, `pooja_name`, `user_id`, `username`, `date`, `time`, `flat`, `landmark`, `colony`, `pin`, `city`, `state`, `with_item`, `samagri`, `price`, `payment_type`, `status`, `accepted_by`, `accepted_by_name`, `forwarded_by`, `forwarded_by_name`, `entrydt`) VALUES
(40, 3, '', 4, '', '2020-3-31', '09:30', 'hyhy', 'yyhu', 'huyh', '565656', '', '', '1', '', '2000', 'cash', 'pending', 0, '', 0, '', '2020-04-01 09:52:07'),
(41, 3, '', 4, '', '2020-3-31', '12:00', 'ghgh', 'huhg', 'huugg', '525252', '', '', '1', '', '2000', 'cash', 'pending', 0, '', 0, '', '2020-04-01 09:52:02'),
(42, 5, '', 1, '', '2020-5-1', '12:00', '100', 'laal bangla', 'cant', '208001', '', '', '1', '', '5000', 'cash', 'accepted', 3, '', 0, '0', '2020-03-31 11:38:26'),
(43, 1, '', 25, '', '2020-4-15', '09:00', 'b 1011', 'Gaurcity 1', '6th avenue', '201306', '', '', '1', '', '2500', 'cash', 'accepted', 20, '', 0, 'ganesh.bajpai', '2020-04-01 09:57:44'),
(44, 4, '', 4, 'hrishique', '2020-3-31', '17:23', 'yyg', 'guggf', 'guugy', '966966', '', '', '1', '', '2800', 'cash', 'accepted', 0, '', 0, '', '2020-04-01 09:50:53'),
(45, 5, 'Ganesh Sthapna', 4, 'hrishique', '2020-3-31', '18:03', 'hyhy', 'huhh', 'huhgy', '808080', '', '', '1', '', '5000', 'cash', 'accepted', 30, '', 0, '', '2020-04-01 09:51:59'),
(46, 1, ' satyanarayan pooja ', 11, 'amit', '2020-4-30', '10:32', 'haha', 'gsgs', 'css', '649797', '', '', '1', '', '2500', 'cash', 'accepted', 23, '', 0, '', '2020-04-02 14:18:51'),
(47, 3, '', 11, '', '2020-4-9', '15:25', 'hcc', 'gghh', 'hhh', '474001', '', '', '1', '', '2000', 'cash', 'pending', 0, '', 0, '', '2020-03-31 19:16:24'),
(48, 5, 'Ganesh Sthapna', 10, 'rajat mehrotra', '2020-4-1', '08:00', '204', 'paras garden', 'barra', '208027', '', '', '1', '', '5000', 'cash', 'accepted', 30, 'rajat mehrotra', 0, '', '2020-03-31 19:42:09'),
(49, 4, 'Navdurga Pooja', 4, 'hrishique', '2020-4-25', '15:23', 'hello', 'hello', 'hello', '565656', '', '', '0', '', '1500', 'cash', 'accepted', 20, '', 0, '', '2020-04-01 09:54:18'),
(50, 1, ' satyanarayan pooja ', 4, 'hrishique', '2020-4-1', '15:44', 'huuh', 'huuhb', 'buububu', '525252', '', '', '0', '', '1200', 'cash', 'accepted', 20, 'amit tiwary', 0, 'amit tiwary', '2020-04-01 16:11:32'),
(51, 1, ' satyanarayan pooja ', 11, 'amit', '2020-4-15', '10:40', 'rgg', 'dfc', 'asdfgg', '208408', '', '', '1', '', '2500', 'cash', 'accepted', 23, 'hrishique', 0, '', '2020-04-02 14:37:02'),
(52, 3, 'Sunderkaand', 11, 'amit', '2020-4-10', '07:10', 'hg', 'st', 'ef', '208024', '', '', '1', '', '2000', 'cash', 'accepted', 23, '', 0, '', '2020-04-02 14:20:34'),
(53, 1, ' satyanarayan pooja ', 39, 'test', '2020-4-2', '19:56', 'shyam nagar', 'kanpur', 'shyam nagar', '208003', '', '', '1', '', '2500', 'cash', 'accepted', 23, 'hrishique', 0, '', '2020-04-02 14:37:06'),
(54, 1, ' satyanarayan pooja ', 40, 'khemesh', '2020-4-3', '09:13', 'test', 'test', 'test', '225522', '', '', '0', '', '1200', 'cash', 'pending', 0, '', 0, '', '2020-04-02 18:45:06'),
(55, 5, '', 25, '', '2020-4-5', '10:00', 'B 1011', 'gaurcity', '6 th avenue', '201301', '', '', '1', '', '5000', 'cash', 'pending', 0, '', 0, '', '2020-04-04 12:59:11'),
(56, 3, 'Sunderkaand', 43, 'popat', '2020-4-24', '10:02', 'haga', 'sgsbs', 'C-270', '201301', '', '', '1', '', '2000', 'cash', 'pending', 0, '', 0, '', '2020-04-07 05:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `category_name`, `name`, `price`, `description`, `image`, `status`, `entrydt`) VALUES
(1, 2, '', 'burger', 50, 'Kapoor is used to cure everything', 'uploads/product/95707burger.jpg', 1, '2020-04-08 11:24:45'),
(2, 4, '', 'Cricket', 2000, 'Cricket is a bat-and-ball game played between two teams of eleven players on a field at the centre of which is a 20-metre (22-yard) pitch with a wicket at each end, each comprising two bails balanced on three stumps. The batting side scores runs by striking the ball bowled at the wicket with the bat, while the bowling and fielding side tries to prevent this and dismiss each player (so they are \"out\"). Means of dismissal include being bowled, when the ball hits the stumps and dislodges the bails, and by the fielding side catching the ball after it is hit by the bat, but before it hits the ground. When ten players have been dismissed, the innings ends and the teams swap roles. The game is adjudicated by two umpires, aided by a third umpire and match referee in international matches. They communicate with two off-field scorers who record the match\'s statistical information.', 'uploads/product/69783cricket.jpg', 1, '2020-03-29 07:37:02'),
(3, 1, '', 'Banana', 80, 'A banana is an edible fruit – botanically a berry[1][2] – produced by several kinds of large herbaceous flowering plants in the genus Musa.[3] In some countries, bananas used for cooking may be called \"plantains\", distinguishing them from dessert bananas. The fruit is variable in size, color, and firmness, but is usually elongated and curved, with soft flesh rich in starch covered with a rind, which may be green, yellow, red, purple, or brown when ripe. The fruits grow in clusters hanging from the top of the plant. Almost all modern edible seedless (parthenocarp) bananas come from two wild species – Musa acuminata and Musa balbisiana. The scientific names of most cultivated bananas are Musa acuminata, Musa balbisiana, and Musa × paradisiaca for the hybrid Musa acuminata × M. balbisiana, depending on their genomic constitution. The old scientific name for this hybrid, Musa sapie', 'uploads/product/32688banana.jpg', 1, '2020-03-29 07:39:10'),
(4, 3, '', 'Onion', 30, 'he onion (Allium cepa L., from Latin cepa \"onion\"), also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium. Its close relatives include the garlic, shallot, leek, chive,[2] and Chinese onion.[3]\r\n\r\nThis genus also contains several other species variously referred to as onions and cultivated for food, such as the Japanese bunching onion (Allium fistulosum), the tree onion (A. ×proliferum), and the Canada onion (Allium canadense). The name \"wild onion\" is applied to a number of Allium species, but A. cepa is exclusively known from cultivation. Its ancestral wild original form is not known, although escapes from cultivation have become established in some regions.[4] The onion is most frequently a biennial or a perennial plant, but is usually treated as an annual and harvested in its first growing season.\r\n\r\nThe onion plant has a fan of hollow, bluish-green leaves and its bulb at t', 'uploads/product/48556onion.jpg', 1, '2020-03-29 07:40:29'),
(5, 5, '', 'product 1', 10, 'product Brad', 'uploads/product/48022bradpitt.jpg', 1, '2020-04-04 10:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `sub_category_name` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` int(1) NOT NULL DEFAULT '1',
  `register_id` varchar(255) NOT NULL,
  `pooja` text NOT NULL,
  `otp` text NOT NULL,
  `otp_verified` int(1) NOT NULL DEFAULT '0',
  `approved` int(1) NOT NULL DEFAULT '0' COMMENT 'approved by admin',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `mobile`, `email`, `address`, `password`, `alternate_no`, `gender`, `city`, `state`, `social_type`, `social_id`, `image`, `aadhar_no`, `aadhar_image`, `dob`, `country`, `pincode`, `skills`, `account_type`, `pancard_no`, `degree`, `bank_ac_no`, `experience`, `ifsc_code`, `acc_holder_name`, `bank_name`, `bio`, `type`, `status`, `register_id`, `pooja`, `otp`, `otp_verified`, `approved`, `entrydt`) VALUES
(1, 'Pawan', '9532673860', 'easyweb85@gmail.com', 'Rawatpur2', 'Pawan@9044', '9044527805', '', 'kanpur', 'u.p', '', '', 'uploads/user/4821IMG_20200319_110130.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'fOb5jPYjbw0:APA91bFYnBl7H9kdRFFVXo-Ks0ECR-tjWVNDgc-jiIt1XVm79WfGrU3MkTncTfyHe0RhUnsU66m_mD_UU2S_fFJabq5I4lyDJ8kQIuelkUaMd8W-O2d9OLF-x0LKUTq5juQTACJTMJPI', '', '7179', 1, 1, '2020-03-22 17:08:39'),
(3, 'Rahul', '9044527805', 'rahul@gmail.com', 'Kalyanpur', 'Pawan@9044', '9532673860', 'Male', 'kanpur', 'u.p', '', '', '', '123456789012345678', '', '3- 19- 1988', 'india', '208014', 'all type of pooja', 'Account Type', 'asq4455j', 'nill', '9045213480707', 'Select Experience', 'hafajsj6g', 'rahul', 'sbj', 'hshshs', 'VENDOR', 1, 'd6mv-p0vLIY:APA91bGSPvZpicTgTEvQP0KXxImsa_fUO5-QCCvJt13YfV2o6hK8cCC6zBVZBiM7KyvKznoAp79oHRrmtqjiRIZjKd4h-FjEkRzUHNY1rR7UL2K9H1VhSNrGJxfDG5IbCFvaXs5nPXqK', '', '8981', 1, 1, '2020-03-24 08:55:02'),
(4, 'hrishique', '7985025413', 'hello@hello.com', 'iit', 'Hello@12', '7777777777', '', 'mnaup', 'up', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'eajyApE6vQA:APA91bGnwVbTozYg0Pr2TzYBIz55NZxTr-sznbESRYXUHtDKCYSsuS2tvoFNsiafvXe508OT1m9j6Lf7Es3L6tX1kX5BC1nxHHhnHgmgdZG8160NKVJOL_1MOVQE-5pRznJLdU240LZa', '', '9432', 1, 1, '2020-03-22 13:55:17'),
(5, 'cj174', '+919982917736', 'junejachirag020@gmail.com', '', 'chirag@123A', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'd34N4NgvYco:APA91bF2ebtSHlZgtoq4Tb8mpz84arWGrguHX4pRB8ZPaVfbqwAnv_fVBnE_LUuaHXSDw44gtjbWWjCeG3M8YffNOx_w9kn7gs7pb3CTFfhyYLHebJqqqStUQejvQ5hWwiREkZJ_pu5g', '', '6190', 1, 1, '2020-03-20 16:26:33'),
(6, 'divyanshu', '8318397381', 'ds9918731300@gmail.com', '', 'DiVyAnSHu.123@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'dlIUyVq75sc:APA91bGbjgYB3rCAhZBmGNE6AW66J7K-uNbOeSpWSBgm_hrPOE_gkFqAWbNGtH67qFfkVDTE0-6oTZ2NL7GFzpJ3g_xN3q4CRnPBUPql5yomcIF32NuWebrZZDJndIKOzBugTZqvO2M8', '', '3871', 1, 1, '2020-03-20 16:51:44'),
(7, 'abcd', '8726605665', 'abdulbasit.ab67@gmail.com', '', 'Qwerty123@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'eHUbyGfxJHY:APA91bFtYgYLwqwQ1pH_Q_IFWCcwjlj8-_D5p6_NomvnmUyk5CohiLJvWRF3EvRU73hagzFBg8rVDYQzSw1a5aWbIcNMDZIJVHQUm8Wv5CWes3ypuvc7hRFp7In7LmJBQaXQ9d5W-g9Z', '', '6208', 0, 1, '2020-03-20 16:53:12'),
(8, 'assdf', '8726608665', 'asft@gmail.com', '', 'Qwerty12@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'eHUbyGfxJHY:APA91bFtYgYLwqwQ1pH_Q_IFWCcwjlj8-_D5p6_NomvnmUyk5CohiLJvWRF3EvRU73hagzFBg8rVDYQzSw1a5aWbIcNMDZIJVHQUm8Wv5CWes3ypuvc7hRFp7In7LmJBQaXQ9d5W-g9Z', '', '969', 1, 1, '2020-03-20 17:00:03'),
(9, 'prakharshukla', '8303092007', 'prakhar.shukla003@gmail.com', '', 'Naruto!12', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'fqtcW2Ej03U:APA91bHm3ZxPTM1lhA9VUpLXLKRrM-B2aPWSGpfB5YWfPJN7-EvsmPncEPbA7VT-gzGkb9zBLv_pbZfYlS1tpygcccAEgxAhGi-oi8sSIXX5XMp7s5WDSZ4qN3YQsZK4i4-GgmwAzw5D', '', '7050', 1, 1, '2020-03-20 17:53:06'),
(10, 'rajat mehrotra', '8881987988', 'rajbusiness1606@gmail.com', '', 'Rajatmehrotra123@', '8707280894', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '4025', 1, 1, '2020-03-20 18:18:23'),
(11, 'amit', '8750200899', 'amit@gmail.com', 'vikash nagar', 'OEXnef', '', '', '', '', '', '', 'uploads/user/3116DSC_0591.JPG', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'dKXFShbquY4:APA91bGpHQR__snLK1as8n44_TuX8Wh_u67AWfZ88Ivvxx2RiSgQkf4er7t0xH4GsYCOmuWaOC0MXUVOhfT6KNEQxv6xLbPqVZ4fSvp1F1mXb_cD-0Xi_EfyNl79kwzE_brT1p-r4mTo', '', '5245', 1, 1, '2020-04-07 10:13:27'),
(12, 'pawan', '9044527805', 'pawan@gmail.com', 'azad nagar', 'Pawan@9044', '9532673860', '', 'kanpur', 'u.p', '', '', 'uploads/user/964020200321_000439.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'fQrmJLwrUa4:APA91bF8n3ABxPA5SOiMO0NS1EgaNF5Fh0Q_BgxNbLl3EF7aU7pSmYnV0v0IDCt8m42g-S7_bEVeg5a5yKoDM2fSxmzYq_wVxv1RCE5LPRnxT-2t5mGvCg01fDbNlE9xSTdITqkTMPMt', '', '2381', 1, 1, '2020-03-20 18:35:58'),
(13, 'theuniquechord', '8826332588', 'ianshulshrma@gmail.com', '', 'India@123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '1074', 1, 1, '2020-03-21 08:41:45'),
(15, 'munshi', '7985025413', 'bey@bey.com', '', 'cUromT', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'fTCI5Mluj_g:APA91bHkXvJUFK9SZyDiVaYV9BYkxbU1j4S6ez8_18vMVtJAkhV9jBrfaaJf5cpivRms71voHYUXYAcqq4cLAWtomTSIvEU-HmJ7SNVNsryxth_Kdmb1nrUbS9ccdK4-IB7rE3pvzKBs', '', '4004', 0, 1, '2020-03-22 13:37:06'),
(16, 'rahulsrvstv', '8840600771', 'rahulsrvstv2021@gmail.com', 'sansanati gali rahul2', 'Rahul@1234567', '1733141733', '', 'kanpur', 'u.p', '', '', 'uploads/user/208920200317_121713.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'c6SJmZ-dD7I:APA91bFFKBW6RvzzuNZNXfOAo-GpIyO0k6eJsAwcV10kBAZBGIb-gihoL_aonCejoMHLwqwCImVcK-ouGeCFP9RVlt1C9NDQ5gPt8fTM1_gGOIcbFd5ZCfTykT4KH5m1I_99HKrMbcCZ', '', '3184', 1, 1, '2020-03-22 17:12:11'),
(17, 'Ashish Handa', '7007973681', 'ashish@gmail.com', 'Govind Nagar2', 'Pawan@9044', '', '', '', '', '', '', 'uploads/user/0d0321d1-b8c3-4665-b701-ee6fc4744b0c.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'fOb5jPYjbw0:APA91bFYnBl7H9kdRFFVXo-Ks0ECR-tjWVNDgc-jiIt1XVm79WfGrU3MkTncTfyHe0RhUnsU66m_mD_UU2S_fFJabq5I4lyDJ8kQIuelkUaMd8W-O2d9OLF-x0LKUTq5juQTACJTMJPI', '', '7808', 1, 1, '2020-03-22 17:09:46'),
(18, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '', 0, 1, '2020-03-22 17:35:31'),
(19, 'sumit', '7000000000', 'sumit@gmail.com', 'azad2', '123456', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, '', '', '', 0, 1, '2020-03-22 17:43:53'),
(20, 'amit tiwary', '7985025413', 'amit@tiwary.com', '', 'Amit@12', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'fTCI5Mluj_g:APA91bHkXvJUFK9SZyDiVaYV9BYkxbU1j4S6ez8_18vMVtJAkhV9jBrfaaJf5cpivRms71voHYUXYAcqq4cLAWtomTSIvEU-HmJ7SNVNsryxth_Kdmb1nrUbS9ccdK4-IB7rE3pvzKBs', '', '3160', 1, 1, '2020-03-26 11:23:50'),
(21, 'maheshwar', '8750200899', 'mahesh@hotmail.com', 'hagagahha', 'OEXnef', '1234567890', 'Male', 'bsbsvsbhs', 'bsnnn', '', '', '', '6454123456582136', '', '3- 23- 1961', 'nanabsb', '208024', 'Jyotish ', 'Account Type', '123465', 'yhavah', '', 'Select Experience', 'gahaga', 'aljj', 'gaha', 'hahah', 'VENDOR', 1, 'dWSG2buLMMk:APA91bF8f6-auSGmG1zkIe8xh04kJ6qAXU6-QUuVgWrg3sWOs3bnoZpqVaWMSxaXbdi-5kG9hmwMOrxpJQD_4xEKcaa8jSe0x_3k8zm-CC4S6MsNMn97198RQfAfKIO9xHJp_-Pfm3zL', '', '3826', 1, 1, '2020-04-02 14:29:10'),
(22, 'akansha', '8960120004', 'akansha.shukla1005@gmail.com', '', 'Akansha123!#', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'fMaqUpWGswE:APA91bHn2XDU-VRAsrBXpOO0RZC2btjtJffqA0f5d8YoTnHFZJNc1CgZd8S3HsK_AE9fnMvLi4ar7qsrIGo7HRBHAl1Qpk1WVo_6P3y2uyUV0VEbQIaY3bLkQyiZYBhzWPyd9-2wHfuc', '', '4727', 1, 1, '2020-03-24 05:58:00'),
(23, 'atul singh', '8750200899', 'hbk.atul@gmail.com', '', 'OEXnef', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'dNwsw5pnuXk:APA91bFQ7awwUNlpNksaDZy_CcM1JvL6qtOjGua9VBOJAM6FTbeWpajezXbhjU9dvBWExjP4BqJgmhp9d2VKPc0BeLV8my3WXTzfmZ8fdUW3mdbAFJsaDCHv9ra_l41I_gc4bvQprWmC', '', '6926', 1, 1, '2020-04-02 14:35:06'),
(24, 'lalit', '9935098056', 'lkm0027@gmail.com', '', 'Akki@12345', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '4670', 1, 1, '2020-03-30 12:06:44'),
(25, 'ganesh.bajpai', '9990370943', 'ganesh.bajpai@gmail.com', '', 'Bajpai@786', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '3656', 1, 1, '2020-03-31 11:27:33'),
(26, 'Test User', '8888888888', 'test@gmail.com', '', 'Ilove@143', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '1260', 0, 1, '2020-03-31 18:45:00'),
(27, 'rohit', '7747982346', 'rohit@gmail.com', '', 'Rohit@123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '7063', 0, 1, '2020-03-31 19:05:37'),
(28, 'rohit', '7747982342', 'rohit@gmail.com', '', 'Rohit@123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '9805', 0, 1, '2020-03-31 19:08:13'),
(29, 'raj mehrotra', '8707280894', 'mehrotra.rajatolyex@gmail.com', '', 'Rajat123!', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'emqfYupl1Io:APA91bHPaucBskwxiaxVHbzDfUCvfNv-bjN1ejFi4pQPevXPexgpFrtHCgmSVFwXMz3RtzOX4vJQnmorF0mKxqTwCozB8LRCm2hjp0vhltGEciiZp6N2q0NQtlfCp7uxaXZcQW1Tk-DF', '', '4535', 0, 1, '2020-03-31 19:39:24'),
(30, 'raj mehrotra', '7617007739', 'mehrotra.rajatolyex@gmail.com', '', 'Rajat123!', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'emqfYupl1Io:APA91bHPaucBskwxiaxVHbzDfUCvfNv-bjN1ejFi4pQPevXPexgpFrtHCgmSVFwXMz3RtzOX4vJQnmorF0mKxqTwCozB8LRCm2hjp0vhltGEciiZp6N2q0NQtlfCp7uxaXZcQW1Tk-DF', '', '7802', 1, 1, '2020-03-31 19:39:17'),
(31, 'Virend', '9575313678', 'virendmeena1122@gmail.com', '', 'Virend123@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'c6EONbD4L2o:APA91bGnrkmgZ37VwHs-bzGnV4E9IWMLNUAK9UgP8dJru0NlLo7JcYDGU01CUnV4LMA7qRYGDjyKa5v2ULuwRJ95HwVFSsIBWAvOb453dYCeXchWkJ-x0gZyxdBA2YC1u5T4q3e2JU7v', '', '6835', 0, 0, '2020-04-01 04:43:03'),
(32, 'Virend', '9575313678', 'virendmeena1122@gmail.com', '', 'Virend123@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'c6EONbD4L2o:APA91bGnrkmgZ37VwHs-bzGnV4E9IWMLNUAK9UgP8dJru0NlLo7JcYDGU01CUnV4LMA7qRYGDjyKa5v2ULuwRJ95HwVFSsIBWAvOb453dYCeXchWkJ-x0gZyxdBA2YC1u5T4q3e2JU7v', '', '9845', 0, 0, '2020-04-01 04:43:03'),
(33, 'Virend', '9575313678', 'virendmeena1122@gmail.com', '', 'Virend123@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'VENDOR', 1, 'c6EONbD4L2o:APA91bGnrkmgZ37VwHs-bzGnV4E9IWMLNUAK9UgP8dJru0NlLo7JcYDGU01CUnV4LMA7qRYGDjyKa5v2ULuwRJ95HwVFSsIBWAvOb453dYCeXchWkJ-x0gZyxdBA2YC1u5T4q3e2JU7v', '', '8022', 0, 1, '2020-04-01 12:21:17'),
(34, 'akash', '9540920134', 'akash1996@gmail.co', '', 'Ak1234@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '2040', 0, 1, '2020-04-01 07:49:57'),
(35, 'akash', '8920433711', 'akash1996@gmail.com', '', 'vl83h5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'dhDOdHnSKOU:APA91bFlwnpOqmawv05pImytcvv2dHg2l994Q64vx_Faybljn7a32SQD-keTC1TBTfJt52Yi6DLo8uk3kdYiWFfVDsT-G01ss5R6FCdXx9eOth7q2CFTpsb6d6nLrm4N_gvV0tCsEs6a', '', '1555', 1, 1, '2020-04-04 14:59:12'),
(36, 'usama', '345642648454', 'usamaarif773@gmail.com', '', 'Usama12@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'deQaQ8tJ8CY:APA91bHPbeBbOyV235-jkAer7OftQ1tIlsnXYMhAW7bsHDDVOcFU0x7IaONFPKyi9JPoJ5aF3lrvBcYv-QkrPVZYAsmUsMKbd6trzPwcakXpoMxGxVEcO9bNHbzWoFNsOazsZI01elEB', '', '3465', 0, 1, '2020-04-01 13:24:36'),
(37, 'Mufeez', '03162836033', 'mufeezsiddiqui2015@gmail.com', '', 'Mufeez@123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'dKXFShbquY4:APA91bGpHQR__snLK1as8n44_TuX8Wh_u67AWfZ88Ivvxx2RiSgQkf4er7t0xH4GsYCOmuWaOC0MXUVOhfT6KNEQxv6xLbPqVZ4fSvp1F1mXb_cD-0Xi_EfyNl79kwzE_brT1p-r4mTo', '', '4259', 0, 1, '2020-04-04 13:16:10'),
(38, 'mufeez', '03112388136', 'mufeezsiddiqui2015@gmail.com', '', 'Mufeez@123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, 'dKXFShbquY4:APA91bGpHQR__snLK1as8n44_TuX8Wh_u67AWfZ88Ivvxx2RiSgQkf4er7t0xH4GsYCOmuWaOC0MXUVOhfT6KNEQxv6xLbPqVZ4fSvp1F1mXb_cD-0Xi_EfyNl79kwzE_brT1p-r4mTo', '', '7155', 0, 1, '2020-04-01 13:49:42'),
(39, 'test', '7839923276', 'agnihotrishriya9@gmail.com', '', 'Shriya.@24', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '8241', 1, 1, '2020-04-02 14:21:52'),
(40, 'khemesh', '8920258509', 'baghelkhemesh@gmail.com', '', 'Bantu$1994', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '9409', 1, 1, '2020-04-02 18:40:34'),
(41, 'popat', '9580500040', 'popat@gmail.com', '', 'Popat@1234', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '9065', 0, 1, '2020-04-07 05:03:17'),
(42, 'cj174', '9982917736', 'junejachirag020@gmail.com', '', 'chirag@123A', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '3459', 1, 1, '2020-04-07 05:04:20'),
(43, 'popat', '9910827459', 'abc@gmail.com', '', 'Atul@123', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '9879', 1, 1, '2020-04-07 05:05:59'),
(44, 'lbuser', '7896541230', 'lbuser@gmail.com', '', 'Vip125javo@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '3330', 0, 1, '2020-04-08 11:34:50'),
(45, 'lbusertest', '8982891432', 'lbusertest@gmail.com', '', 'Vip125Javo@', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'USER', 1, '', '', '3174', 1, 1, '2020-04-08 11:36:32');

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

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
-- Indexes for table `virtualservice`
--
ALTER TABLE `virtualservice`
  ADD PRIMARY KEY (`virtual_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donationlisting`
--
ALTER TABLE `donationlisting`
  MODIFY `donationListing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandal`
--
ALTER TABLE `mandal`
  MODIFY `mandal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mandal_booked`
--
ALTER TABLE `mandal_booked`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `my_cart`
--
ALTER TABLE `my_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pooja`
--
ALTER TABLE `pooja`
  MODIFY `pooja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pooja_booking`
--
ALTER TABLE `pooja_booking`
  MODIFY `pooja_booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `virtualservice`
--
ALTER TABLE `virtualservice`
  MODIFY `virtual_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
