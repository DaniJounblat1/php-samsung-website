-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2024 at 03:24 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydata`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `idaddress` int(11) NOT NULL,
  `address` text,
  `state` text,
  `city` text,
  `zipcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`idaddress`, `address`, `state`, `city`, `zipcode`) VALUES
(6, 'asdf dfdsf dfdsf', 'dfdsfgds', 'dsafdsf', 123456),
(7, 'hjdvj csh sdvh', 'fbsb', 'bkjx', 11),
(8, 'hjg hjv ghv', 'jnvb', 'kjbk', 1234565),
(9, 'wee ee eee', 'ewf', 'wee', 123456),
(10, 'jkb hjhj hj', 'hjh', 'hjh', 123456),
(11, 'hh hh hh', 'hhh', 'hhhh', 12),
(12, 'jjj jj jj', 'ddd', 'jjj', 122222222),
(13, 'yug hgv ghj', 'scacs', 'cacs', 123456),
(14, 'dan djdj jeh', 'jdjd', 'jdjd', 123456),
(15, 'jfjdj dbdj dhdjs', 'jdjdjd', 'bshsjs', 646464),
(16, 'hdh dhsh shs', 'djd', 'hdhd', 123456);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `user_userid` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `user_userid`, `email`, `password`) VALUES
(1, 1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `employee_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_email`, `role`, `employee_pass`) VALUES
(1, 'Technician', 'repair@gmail.com', 'Repair', 'repair123'),
(2, 'Damaged Specialist', 'crushed@gmail.com', 'Crushed products', 'crushed123'),
(3, 'Idea Expert', 'suggestion@gmail.com', 'Suggestion', 'suggestion123'),
(4, 'Feedback Analyst', 'feedback@gmail.com', 'Feedback', 'feedback123'),
(5, 'serialNumberchecker', 'serial@gmail.com', 'Serial', 'serial123');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `idfeedback` int(11) NOT NULL,
  `name` text,
  `email` varchar(45) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `feedback_type` varchar(100) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `message_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`idfeedback`, `name`, `email`, `user_userid`, `message`, `rating`, `feedback_type`, `employee_id`, `message_time`) VALUES
(71, 'admin', 'admin@gmail.com', 37, 'admin', NULL, 'Feedback', 4, '2023-06-13 00:15:11'),
(72, 'view', 'viewer@gmail.com', 39, 'hii', NULL, 'Feedback', 4, '2023-06-13 00:49:43'),
(73, 'testt', 'viewer@gmail.com', 39, 'dadda', NULL, 'Feedback', 4, '2023-06-13 01:05:36'),
(74, 'gaga', 'gaga@gmail.com', 40, 'gaag', NULL, 'Feedback', 4, '2023-06-13 01:06:35'),
(75, 'faa', 'bonmobp@gmail.com', 41, 'djjd', NULL, 'Feedback', 4, '2024-05-16 11:44:07'),
(76, 'faa', 'bonmobp@gmail.com', 41, 'djjd', NULL, 'Feedback', 4, '2024-05-16 11:46:27'),
(77, 'nsn', 'bonmobp@gmail.com', 41, 'test', 1, 'Feedback', 4, '2024-05-17 08:04:39'),
(78, 'heh', 'bonmobp@gmail.com', NULL, 'nsnsj', NULL, 'Repair', NULL, '2024-05-25 16:08:28'),
(79, 'jdj', 'bonmobp@gmail.com', NULL, 'udisis', 2, 'Suggestion', NULL, '2024-05-25 16:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `idorder` int(11) NOT NULL,
  `user_userid` int(11) DEFAULT '0',
  `idrepair` int(11) DEFAULT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idorder`, `user_userid`, `idrepair`, `order_item_id`, `transaction`) VALUES
(824, 0, NULL, NULL, 'JKES0MUQ15'),
(825, 0, 828, NULL, NULL),
(826, 0, NULL, NULL, 'AWK1PNKDM5'),
(827, 0, NULL, NULL, 'F9EOK28K37'),
(828, 0, NULL, NULL, '2U95I6SCK1');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `idpayment` int(11) NOT NULL,
  `cardnumber` varchar(100) DEFAULT NULL,
  `cardname` text,
  `year` varchar(45) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idpayment`, `cardnumber`, `cardname`, `year`, `month`, `cvv`, `email`, `password`) VALUES
(7, '1111 1111 1111 1111', 'sdfsdf dsfdsfsd dfdsgsg', '2024', 2, 123, 'aliali123@gmail.com', 'aliali123'),
(8, '8888 8888 8888 7777', 'sdvg vs scbh', '2025', 5, 1, 'bonmobp90@gmail.com', 'bonmobp90@gmail.com'),
(9, '6666 6666 6666 6669', 'gvgv hgv hjv', '2034', 11, 123, 'admin@gmailh.com', 'admin123'),
(10, '0000 0000 0000 0000', 'chsvd cshgdcf cghsc', '2034', 2, 111, 'admin1@gmail.com', 'admin123'),
(11, '4444 4444 4555 5555', 'hg hjh hh', '2024', 3, 123, 'admin@gmil.com', 'admin123'),
(12, '6555 5555 5555 5555', 'tty tt tt', '2024', 1, 1111, 'adminj@gmail.com', 'admin123'),
(13, '1111 1111 1112 2222', 'gg hh hh', '2034', 11, 111, 'adminl@gmail.com', 'admin123'),
(14, '6777 7777 7777 7778', 'achb acsbh ach', '2025', 5, 111, 'bonmobp9@gmail.com', 'bonmobp9@gmail.com'),
(15, '1111 6336 7373 7372', 'dhhdj djdj sjsj', '2028', 1, 111, 'bonmobp@gmail.com', 'dani2003'),
(16, '7373 8392 9462 5143', 'bdnd dhdh dhsh', '31', 4, 277, 'bonmob1p@gmail.com', 'dani2003'),
(17, '7372 8282 9293 9293', 'djdj djjd djsj', '30', 7, 173, 'bonmobp5@gmail.com', 'dani2003'),
(28, '9999 9900 0000 0000', 'dhsj jdjs shsj', '30', 7, 162, 'bonmobp555@gmail.com', 'dani2003'),
(29, '8383 9393 7848 4849', 'danjs dhdj djd', '28', 5, 272, 'bonmobp559@gmail.com', 'dani2003');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `producttype` varchar(100) DEFAULT NULL,
  `productname` varchar(45) DEFAULT NULL,
  `productprice` varchar(25) DEFAULT NULL,
  `productimage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `producttype`, `productname`, `productprice`, `productimage`) VALUES
(4, 'TV', 'Samsung Neo QLED 8K 85\'', '6000', ' /img/Neo41.png'),
(5, 'TV', 'The Frame 85\'', '2000', ' /img/frame.png'),
(6, 'TV', 'Samsung Neo QLED 4K 55\'', '2399', ' /img/Neo.png'),
(7, 'Buds', 'Galaxy Buds Pro', '99.99', ' /img/budspro.png'),
(8, 'Buds', 'Galaxy Buds 2', '139.99', ' /img/buds2.png'),
(9, 'Buds', 'Galaxy Buds 2 Pro', '159.99', ' /img/buds2pro.png'),
(11, 'Samsung A Series', 'Samsung A54', '350', ' /img/A54.jpg'),
(12, 'Samsung A Series', 'Samsung A71', '230', ' /img/a71.png'),
(13, 'Samsung A Series', 'Samsung A70', '190', ' /img/a70.png'),
(14, 'Samsung A Series', 'SamsungZ A50', '150', ' /img/a50.png'),
(15, 'Samsung A Series', 'Samsung A30', '113', ' /img/a30.png'),
(16, 'Samsung A Series', 'Samsung A21s', '100', ' /img/a21s.png'),
(17, 'Samsung S Series', 'Samsung S 23 Ultra', '1200', ' /img/S23 ultra.png'),
(18, 'Samsung S Series', 'Samsung S 23', '899', ' /img/s23.png'),
(19, 'Samsung S Series', 'Samsung S 22 Ultra', '900', ' /img/S22 ultra.png'),
(20, 'Samsung S Series', 'Samsung S 22', '649', ' /img/S22.jpg'),
(21, 'Samsung S Series', 'Samsung S 21 Ultra', '328', ' /img/S21Ultra.jpg'),
(22, 'Samsung S Series', 'Samsung S 20 Ultra', '239', ' /img/S20Ultra.jpg'),
(23, 'Samsung Z Series', 'Samsung Z Flip 4', '590', ' /img/flip4.png'),
(24, 'Samsung Z Series', 'Samsung Z Flip 3', '373.99', ' /img/flip3.png'),
(25, 'Samsung Z Series', 'Samsung Z Filp 5G', '259.99', ' /img/flip5g.png'),
(26, 'Samsung Z Series', 'SamsungZ Fold 4', '1089.99', ' /img/fold4.png'),
(27, 'Samsung Z Series', 'Samsung Z Fold 3', '900', ' /img/fold3.png'),
(28, 'Samsung Z Series', 'Samsung Z Fold 2', '650', ' /img/fold2.png'),
(31, 'Watch', 'Galaxy watch 4', '119.99', ' /img//watch4.png'),
(32, 'Watch', 'Galaxy Watch 3', '100', ' /img/watch2.png'),
(35, 'Samsung A Series', 'samsung note', '100', ' /img/A54.jpg'),
(38, 'Samsung A Series', 'testt', '0', '../img/a71.png'),
(39, 'Watch', 'new', '500', ' /img/a71.png'),
(40, 'Samsung S Series', 'same time', '400', ' /img/a71.png');

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `idrepair` int(11) NOT NULL,
  `serialnb` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`idrepair`, `serialnb`) VALUES
(1, 'hfjdhjdhjlk'),
(2, 'hfjdhjdhjlk'),
(3, 'hfjdhjdhjlk'),
(4, '17364737373');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `idshipping` int(11) NOT NULL,
  `shippingdate` date NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`idshipping`, `shippingdate`, `order_id`) VALUES
(1, '2024-05-25', 828);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address_idaddress` int(11) DEFAULT NULL,
  `payment_idpayment` int(11) DEFAULT NULL,
  `userType` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `useremail`, `password`, `address_idaddress`, `payment_idpayment`, `userType`) VALUES
(1, 'danjs dhdj djd', 'bonmobp559@gmail.com', 'dani2003', 16, 29, 'customer'),
(2, 'heh', 'bonmobp@gmail.com', NULL, NULL, NULL, 'viewer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`idaddress`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`idfeedback`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idorder`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idpayment`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`idrepair`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`idshipping`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `useremail` (`useremail`),
  ADD KEY `address_idaddress` (`address_idaddress`),
  ADD KEY `payment_idpayment` (`payment_idpayment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `idaddress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `idfeedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=829;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idpayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `idrepair` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `idshipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
