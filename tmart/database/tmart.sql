-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `customer` varchar(200) NOT NULL,
  `cost` decimal(12,2) DEFAULT NULL,
  `totalAmount` decimal(12,2) DEFAULT NULL,
  `orderDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `customer`, `cost`, `totalAmount`, `orderDate`) VALUES
(3, 'ritwikmath@gmail.com', 3.95, 4.15, '2024-02-10'),
(4, 'test@gmail.com', 1000.00, 1050.00, '2024-02-10'),
(5, 'test1@gmail.com', 2000.00, 2100.00, '2024-02-10'),
(6, 'teast3@gmail.com', 2000.00, 2100.00, '2024-02-10'),
(7, 'teast3@gmail.com', 1000.00, 1050.00, '2024-02-11'),
(8, 'test@gmail.com', 4000.00, 4200.00, '2024-02-11'),
(9, 'test@gmail.com', 1000.00, 1050.00, '2024-02-11'),
(10, 'test@gmail.com', 5000.00, 5250.00, '2024-02-11'),
(11, 'test@gmail.com', 2000.00, 2100.00, '2024-02-12'),
(12, 'test@gmail.com', 1000.00, 1050.00, '2024-02-12'),
(13, 'test@gmail.com', 1000.00, 1050.00, '2024-02-17'),
(14, 'test@gmail.com', 2000.00, 2100.00, '2024-02-18'),
(15, 'test@gmail.com', 1000.00, 1050.00, '2024-02-18'),
(16, 'test@gmail.com', 1000.00, 1050.00, '2024-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `alias` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `name`, `price`, `description`, `image`, `alias`) VALUES
(1, 'anupama parameswaran', 1000.00, 'a bueautifull color art of anupama', 'anupama.jpg', 'featured'),
(10, 'dipika padukon', 1000.00, 'black and white sketch', 'dipika.jpg', 'featured'),
(11, 'Kalyani Priyadarshan', 2000.00, 'a bueautifull color art of kalyani', 'kalyani.jpg', 'featured'),
(12, 'Mrunal Thakur', 2000.00, 'a bueautifull color art of Mrunal', 'Watercolour.jpg', 'new'),
(14, 'billi elish', 1000.00, 'pencil color art ', 'billi.jpg', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `productordered`
--

CREATE TABLE `productordered` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `qnatity` int(11) NOT NULL,
  `cost` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `productordered`
--

INSERT INTO `productordered` (`orderID`, `productID`, `qnatity`, `cost`) VALUES
(4, 1, 1, 1000.00),
(5, 1, 1, 1000.00),
(5, 10, 1, 1000.00),
(6, 1, 1, 1000.00),
(6, 10, 1, 1000.00),
(7, 1, 1, 1000.00),
(8, 10, 4, 4000.00),
(9, 10, 1, 1000.00),
(10, 1, 1, 1000.00),
(10, 10, 1, 1000.00),
(10, 14, 3, 3000.00),
(11, 1, 1, 1000.00),
(11, 14, 1, 1000.00),
(12, 10, 1, 1000.00),
(13, 1, 1, 1000.00),
(14, 1, 1, 1000.00),
(14, 10, 1, 1000.00),
(15, 1, 1, 1000.00),
(16, 1, 1, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `userType` varchar(200) DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `userType`) VALUES
('ritwikmath@gmail.com', 'Ritwik Math', '123', 'customer'),
('student@abc.com', 'Student', '1234', 'customer'),
('teast3@gmail.com', 'test3', '123', 'customer'),
('test1@gmail.com', 'test1', '1234', 'customer'),
('test@gmail.com', 'test', '123', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productordered`
--
ALTER TABLE `productordered`
  ADD PRIMARY KEY (`orderID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `user` (`email`);

--
-- Constraints for table `productordered`
--
ALTER TABLE `productordered`
  ADD CONSTRAINT `productordered_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `productordered_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
