-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2022 at 08:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `forename` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contactnumber` text NOT NULL,
  `created` datetime NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `forename`, `email`, `password`, `contactnumber`, `created`, `lastlogin`) VALUES
(1, 'Admin 101', 'admin@gmail.com', '', '06980599595', '2022-03-07 13:30:00', '2022-03-07 13:30:00'),
(2, 'Admin 523', 'viktinho56@gmail.com', '$2y$10$jOfsIJZba/crefUPt8N6BOelYwHCC9Wvse4HfscW4.on3D6N1FBqG', '06980599595', '2022-03-07 14:46:50', '2022-03-09 01:46:24'),
(3, 'Admin 5234', 'viktinho@yahoo.com', '$2y$10$zUlR5dCGxKMrpPXk5HA9L.QOP0SiOXl5ESY/0kTjscU9Y56Sq2DE6', '07069701471', '2022-03-07 19:07:08', '2022-03-07 19:45:26'),
(4, 'John James', 'John@gmail.com', '$2y$10$DeEyavgPFFXcZ.IVPXhtJe8EAtOwLEGZLHy8sj3f/2Nzvr/xUTZF2', '07069701471', '2022-03-07 20:08:47', '2022-03-10 20:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `adminstoken`
--

CREATE TABLE `adminstoken` (
  `tokenid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `token` text NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_orders`
--

CREATE TABLE `assigned_orders` (
  `assigned_id` int(11) NOT NULL,
  `driverid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assigned_orders`
--

INSERT INTO `assigned_orders` (`assigned_id`, `driverid`, `orderid`, `created`) VALUES
(1, 2, 1, '2022-03-10 20:18:52'),
(2, 2, 2, '2022-03-10 20:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `businessid` int(11) NOT NULL,
  `nameofcompany` text NOT NULL,
  `maincontactperson` text NOT NULL,
  `companytype` text NOT NULL,
  `typeofbusiness` text NOT NULL,
  `addressone` text NOT NULL,
  `addresstwo` text DEFAULT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `postcode` text DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contactnumber` varchar(200) DEFAULT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `notification` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`businessid`, `nameofcompany`, `maincontactperson`, `companytype`, `typeofbusiness`, `addressone`, `addresstwo`, `city`, `state`, `country`, `postcode`, `email`, `contactnumber`, `password`, `avatar`, `created`, `updated`, `lastlogin`, `status`, `notification`) VALUES
(1, 'Jack Jones', 'Adeleke', 'Solopreneur', 'Information Technology', 'No 23 c Close Kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'viktinho56@gmail.com', 'UK +4407069701471', '$2y$10$NAA.syyZtUAL6KTWi8i9heJY0OHt2v99fj1cpibSJUv1OVQ8owIA6', 'https://res.cloudinary.com/viktinho/image/upload/v1646645920/20220205_101900_bkdqly.jpg', '2022-03-07 10:38:41', '2022-03-07 10:38:41', '2022-03-10 18:36:23', 0, 1),
(3, 'Tinsoft Technologies', 'Tinsoft Technologies', 'Solopreneur', 'Information Technology', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'viktinho@yahoo.com', '2347069701471', '$2y$10$xOW8ZaGudoGFSX1E.CVdVeTJNpx1OSR5MVRVKqSUBBYNQFOF.NmZK', 'https://res.cloudinary.com/viktinho/image/upload/v1646934454/20220205_101900_q227js.jpg', '2022-03-10 18:47:35', '2022-03-10 18:47:35', '2022-03-10 18:47:46', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `businesspin`
--

CREATE TABLE `businesspin` (
  `pinid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `pin` text NOT NULL,
  `created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businesspin`
--

INSERT INTO `businesspin` (`pinid`, `businessid`, `pin`, `created`) VALUES
(1, 1, '1111', '2022-03-07 10:38:41'),
(2, 2, '1135', '2022-03-10 18:44:01'),
(3, 3, '2579', '2022-03-10 18:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `businesstoken`
--

CREATE TABLE `businesstoken` (
  `tokenid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `token` text NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businesstoken`
--

INSERT INTO `businesstoken` (`tokenid`, `businessid`, `token`, `expires`) VALUES
(1, 2, 'xd7pj927sejyq128mmct', '1645723810202'),
(2, 1, 'poiz16kobfb2cft0ma7h', '1645723969672'),
(3, 2, '7zgvwuu421tvpr84plrs', '1645724027065');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverid` int(11) NOT NULL,
  `forename` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contactnumber` text NOT NULL,
  `created` datetime NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverid`, `forename`, `email`, `password`, `contactnumber`, `created`, `lastlogin`) VALUES
(1, 'Driver 101', 'driver@gmail.com', '$2y$10$kJ4CJA7qkCjDjuRcOP4qKeOXuYl3gSm9o4FGzKPjEyaJLUKGckD9a', '06980599595', '2022-03-07 13:30:00', '2022-03-07 13:30:00'),
(2, 'Driver 012', 'viktinho56@gmail.com', '$2y$10$kJ4CJA7qkCjDjuRcOP4qKeOXuYl3gSm9o4FGzKPjEyaJLUKGckD9a', '0706070606', '2022-03-07 14:50:46', '2022-03-10 20:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `driverstoken`
--

CREATE TABLE `driverstoken` (
  `tokenid` int(11) NOT NULL,
  `driverid` int(11) NOT NULL,
  `token` text NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `sender_destination` text NOT NULL,
  `sender_forename` text NOT NULL,
  `sender_adresslineone` text NOT NULL,
  `sender_adresslinetwo` text NOT NULL,
  `sender_city` text NOT NULL,
  `sender_state` text NOT NULL,
  `sender_country` text NOT NULL,
  `sender_postcode` text DEFAULT NULL,
  `receiver_forename` text NOT NULL,
  `receiver_contact` text DEFAULT NULL,
  `receiver_adresslineone` text NOT NULL,
  `receiver_adresslinetwo` text NOT NULL,
  `receiver_city` text NOT NULL,
  `receiver_state` text NOT NULL,
  `receiver_country` text NOT NULL,
  `receiver_postcode` text NOT NULL,
  `pickup_destination` text NOT NULL,
  `pickup_forename` text NOT NULL,
  `pickup_adresslineone` text NOT NULL,
  `pickup_adresslinetwo` text NOT NULL,
  `pickup_city` text NOT NULL,
  `pickup_state` text NOT NULL,
  `pickup_country` text NOT NULL,
  `pickup_postcode` text DEFAULT NULL,
  `delivery_method` text NOT NULL,
  `sea_freight` varchar(45) DEFAULT NULL,
  `air_freight` varchar(45) DEFAULT NULL,
  `weight` text NOT NULL,
  `items` text NOT NULL,
  `items_description` text NOT NULL,
  `amount` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `tracking_number` varchar(250) DEFAULT NULL,
  `sender_email` varchar(250) NOT NULL,
  `receiver_email` varchar(250) NOT NULL,
  `sender_contact` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `sender_destination`, `sender_forename`, `sender_adresslineone`, `sender_adresslinetwo`, `sender_city`, `sender_state`, `sender_country`, `sender_postcode`, `receiver_forename`, `receiver_contact`, `receiver_adresslineone`, `receiver_adresslinetwo`, `receiver_city`, `receiver_state`, `receiver_country`, `receiver_postcode`, `pickup_destination`, `pickup_forename`, `pickup_adresslineone`, `pickup_adresslinetwo`, `pickup_city`, `pickup_state`, `pickup_country`, `pickup_postcode`, `delivery_method`, `sea_freight`, `air_freight`, `weight`, `items`, `items_description`, `amount`, `created`, `updated`, `payment_status`, `order_status`, `tracking_number`, `sender_email`, `receiver_email`, `sender_contact`) VALUES
(1, 'Kenya', 'Victor', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'Victor Fola', '07069701471', 'No 23 c close ademola close', '', 'Kado', 'FCT', 'Nigeria', '', 'Kenya', 'Victor', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'standard_delivery', 'N/A', 'N/A', '67', 'test items', 'hshhshhs', '201', '2022-03-10 17:24:15', '2022-03-10 20:27:20', 1, 2, 'PNM900477097260Sd', 'viktinho56@gmail.com', 'viktinho56@gmail.com', '+2347069701471'),
(2, 'Kenya', 'Tinsoft Technologies', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'Victor Eniola', '07069701471', 'No 23 c close ademola close', '', 'test city', 'test state', 'Morocco', '', 'Kenya', 'Tinsoft Technologies', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'standard_delivery', 'N/A', 'N/A', '45', '3 jhdhhdhd', 'dgdgdgdgs', '135', '2022-03-10 18:49:06', '2022-03-10 20:20:02', 1, 1, 'PNM359716732801Sd', 'viktinho@yahoo.com', 'Adeleke@gmail.com', '2347069701471'),
(3, 'Kenya', 'Tinsoft Technologies', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'Victor Eniola', '07069701471', 'No 23 c close ademola close', '', 'test city', 'test state', 'Morocco', '', 'Kenya', 'Tinsoft Technologies', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'standard_delivery', 'N/A', 'N/A', '45', '3 jhdhhdhd', 'dgdgdgdgs', '500', '2022-03-10 19:10:41', '2022-03-10 19:10:41', 0, 0, '', 'viktinho@yahoo.com', 'Adeleke@gmail.com', '2347069701471');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `transactiontype` text DEFAULT NULL,
  `amount` text NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionid`, `businessid`, `transactiontype`, `amount`, `status`, `created`, `updated`) VALUES
(1, 1, 'Test Transaction', '5000', 0, '2022-03-05 12:17:15', '2022-03-05 12:17:15'),
(2, 1, 'Test Transaction', '5000', 0, '2022-03-05 12:17:45', '2022-03-05 12:17:45'),
(3, 2, 'Test Transaction', '5000', 0, '2022-03-05 16:45:35', '2022-03-05 16:45:35'),
(4, 2, 'Test Transaction', '5000', 0, '2022-03-05 16:53:53', '2022-03-05 16:53:53'),
(5, 2, 'Test Transaction', '5000', 0, '2022-03-05 16:55:54', '2022-03-05 16:55:54'),
(6, 3, 'Test Transaction', '5000', 0, '2022-03-05 18:27:41', '2022-03-05 18:27:41'),
(7, 1, 'Card Top Up Transaction', '2000', 0, '2022-03-07 11:09:26', '2022-03-07 11:09:26'),
(8, 1, 'Card Top Up Transaction', '9000', 0, '2022-03-07 19:12:02', '2022-03-07 19:12:02'),
(9, 1, 'Card Top Up Transaction', '10000', 0, '2022-03-07 20:12:44', '2022-03-07 20:12:44'),
(10, 1, 'Card Top Up Transaction', '10', 0, '2022-03-08 02:18:09', '2022-03-08 02:18:09'),
(11, 1, 'Card Top Up Transaction', '4', 0, '2022-03-08 02:20:42', '2022-03-08 02:20:42'),
(12, 1, 'Card Top Up Transaction', '6', 0, '2022-03-08 02:24:08', '2022-03-08 02:24:08'),
(13, 1, 'Card Top Up Transaction', '23', 0, '2022-03-08 02:27:35', '2022-03-08 02:27:35'),
(14, 3, 'Card Top Up Transaction', '1', 0, '2022-03-10 20:11:04', '2022-03-10 20:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `forenames` text NOT NULL,
  `surname` text NOT NULL,
  `addressone` text NOT NULL,
  `addresstwo` text DEFAULT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `postcode` text DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contactnumber` varchar(200) DEFAULT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `notification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `forenames`, `surname`, `addressone`, `addresstwo`, `city`, `state`, `country`, `postcode`, `email`, `contactnumber`, `password`, `avatar`, `created`, `updated`, `lastlogin`, `status`, `notification`) VALUES
(1, 'Victor', 'Fadipe', 'No 23 C Close kado', '', 'Lagos', 'Lagos', 'Nigeria', '', 'viktinho56@gmail.com', '+2347069701471', '$2y$10$UvvlYspUhXi1AZexBhjxdeS/Vm4Lv82LPgCA6Kv8W8J1DiaufUuRe', 'https://res.cloudinary.com/viktinho/image/upload/v1646925280/20220205_101900_jwtxef.jpg', '2022-03-10 16:14:41', '2022-03-10 16:14:41', '2022-03-10 16:15:23', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userstoken`
--

CREATE TABLE `userstoken` (
  `tokenid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `token` text NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userstoken`
--

INSERT INTO `userstoken` (`tokenid`, `userid`, `token`, `expires`) VALUES
(1, 1, 'o8737iscz2zajdha8b2x', '1645400328367'),
(2, 2, '1g9oiy4xtvjdv9bwtqb7', '1645713219882');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `walletid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `current_balance` text DEFAULT NULL,
  `spendinglimit` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`walletid`, `businessid`, `current_balance`, `spendinglimit`, `created`, `updated`) VALUES
(1, 1, '93404', '1000', '2022-03-05 18:16:28', '2022-03-07 10:54:37'),
(2, 2, '10000', '100', '2022-03-05 22:43:12', '0000-00-00 00:00:00'),
(3, 3, '5001', '100', '2022-03-06 00:24:49', '2022-03-06 00:24:49'),
(5, 2, '0', '100', '2022-03-10 18:44:01', '2022-03-10 18:44:01'),
(6, 3, '5001', '100', '2022-03-10 18:47:35', '2022-03-10 18:47:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `adminstoken`
--
ALTER TABLE `adminstoken`
  ADD PRIMARY KEY (`tokenid`);

--
-- Indexes for table `assigned_orders`
--
ALTER TABLE `assigned_orders`
  ADD PRIMARY KEY (`assigned_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`businessid`);

--
-- Indexes for table `businesspin`
--
ALTER TABLE `businesspin`
  ADD PRIMARY KEY (`pinid`);

--
-- Indexes for table `businesstoken`
--
ALTER TABLE `businesstoken`
  ADD PRIMARY KEY (`tokenid`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverid`);

--
-- Indexes for table `driverstoken`
--
ALTER TABLE `driverstoken`
  ADD PRIMARY KEY (`tokenid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `userstoken`
--
ALTER TABLE `userstoken`
  ADD PRIMARY KEY (`tokenid`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`walletid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adminstoken`
--
ALTER TABLE `adminstoken`
  MODIFY `tokenid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assigned_orders`
--
ALTER TABLE `assigned_orders`
  MODIFY `assigned_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `businessid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `businesspin`
--
ALTER TABLE `businesspin`
  MODIFY `pinid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `businesstoken`
--
ALTER TABLE `businesstoken`
  MODIFY `tokenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driverstoken`
--
ALTER TABLE `driverstoken`
  MODIFY `tokenid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userstoken`
--
ALTER TABLE `userstoken`
  MODIFY `tokenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `walletid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
