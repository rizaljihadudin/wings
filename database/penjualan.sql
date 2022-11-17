-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 03:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(18) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` decimal(6,0) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `discount` int(6) DEFAULT NULL,
  `dimension` varchar(50) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `product_name`, `price`, `currency`, `discount`, `dimension`, `unit`, `photo`) VALUES
(2, 'TESTx', 'So Klinx', '20000', 'IDR', 20, '13 cm x 10 cm', '10', 'soklin.png'),
(3, 'COLEK01', 'SABUN COLEK', '15000', 'IDR', 15, '13 cm x 10 cm', '10', 'images.jpg'),
(4, 'SKM001', 'SABUN LAGI', '17000', 'IDR', 0, '13 cm x 10 cm', '10', 'cuci_piring.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_temp`
--

CREATE TABLE `product_temp` (
  `id_product` int(11) NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `document_code` varchar(3) NOT NULL,
  `document_number` varchar(10) NOT NULL,
  `product_code` varchar(18) NOT NULL,
  `price` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `sub_total` int(10) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`document_code`, `document_number`, `product_code`, `price`, `quantity`, `unit`, `sub_total`, `currency`) VALUES
('TRX', '001', 'TESTx', 20000, 10, '10', 160000, 'IDR'),
('TRX', '001', 'COLEK01', 15000, 11, '10', 140250, 'IDR'),
('TRX', '2', 'TESTx', 20000, 1, '10', 16000, 'IDR'),
('TRX', '2', 'COLEK01', 15000, 0, '10', 0, 'IDR'),
('TRX', '003', 'TESTx', 20000, 1, '10', 16000, 'IDR'),
('TRX', '003', 'COLEK01', 15000, 2, '10', 25500, 'IDR');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_header`
--

CREATE TABLE `transaction_header` (
  `document_code` varchar(3) NOT NULL,
  `document_number` varchar(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `total` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_header`
--

INSERT INTO `transaction_header` (`document_code`, `document_number`, `user`, `total`, `date`) VALUES
('TRX', '001', 'admin', 300250, '2022-11-17 14:20:04'),
('TRX', '003', 'admin', 41500, '2022-11-17 14:25:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
