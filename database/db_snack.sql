-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2018 at 05:39 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_snack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_username` varchar(25) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_name` varchar(40) NOT NULL,
  `admin_level` varchar(15) NOT NULL,
  `admin_created` datetime NOT NULL,
  `admin_session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_password`, `admin_name`, `admin_level`, `admin_created`, `admin_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', '2017-07-28 05:22:21', 'brdpai71qdttojq5t3lll03fl7');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_type` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_noaccount` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_type`, `bank_name`, `bank_noaccount`, `bank_id`, `bank_created`, `bank_updated`) VALUES
('BNI', 'Ali Abdul Wahid', 568772084, 2, '2018-07-17 01:32:16', '2018-07-17 10:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_created`, `category_updated`) VALUES
(1, 'Kue', '2018-07-29 20:43:39', '2018-07-29 20:43:39'),
(2, 'Keripik', '2018-07-29 20:43:55', '2018-07-29 20:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_session` varchar(255) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `driver_notelp` varchar(100) NOT NULL,
  `driver_alamat` varchar(255) NOT NULL,
  `driver_latitude` varchar(100) NOT NULL,
  `driver_longitude` varchar(100) NOT NULL,
  `driver_username` varchar(100) NOT NULL,
  `driver_password` varchar(100) NOT NULL,
  `driver_bank` varchar(100) NOT NULL,
  `driver_owner` varchar(100) NOT NULL,
  `driver_noaccount` varchar(100) NOT NULL,
  `driver_status` varchar(100) NOT NULL DEFAULT 'process',
  `driver_saldo` int(11) NOT NULL DEFAULT '0',
  `driver_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `driver_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_session`, `driver_name`, `driver_notelp`, `driver_alamat`, `driver_latitude`, `driver_longitude`, `driver_username`, `driver_password`, `driver_bank`, `driver_owner`, `driver_noaccount`, `driver_status`, `driver_saldo`, `driver_created`, `driver_updated`) VALUES
('5fbp4o7auhfdstfmcgu217ace6', 'driver', '0123456789', 'Tamansari', '-6.902917', '107.6065653', 'driver', 'e2d45d57c7e2941b65c6ccd64af4223e', ' BNI', 'driver', '12381', 'done', 0, '2018-07-30 19:45:05', '2018-08-06 22:38:05'),
('', 'driver2', 'driver2', 'driver2', '-6.903705', '107.609687', 'driver2', 'd95784faa6597a0253e483e500ced3ee', 'BNI', 'driver2', '8123719', 'process', 0, '2018-07-30 19:45:39', '2018-08-06 22:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(3) NOT NULL,
  `identitas_website` varchar(250) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_alamat` varchar(250) NOT NULL,
  `identitas_notelp` char(20) NOT NULL,
  `identitas_favicon` varchar(250) NOT NULL,
  `identitas_author` varchar(100) NOT NULL,
  `identitas_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_alamat`, `identitas_notelp`, `identitas_favicon`, `identitas_author`, `identitas_cod`) VALUES
(1, 'Makanan Ringan', 'Makanan Ringan', 'sack, website, php', 'Indonesia', '0812345689', '406921Untitled-1.png', 'Makanan Ringan', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` varchar(100) NOT NULL,
  `toko_id` varchar(100) NOT NULL,
  `pelanggan_username` varchar(100) NOT NULL,
  `invoice_item` int(11) NOT NULL,
  `invoice_ongkir` int(11) NOT NULL,
  `invoice_payment` varchar(100) NOT NULL,
  `invoice_weight` int(11) NOT NULL,
  `invoice_total` int(11) NOT NULL,
  `invoice_address` varchar(255) NOT NULL,
  `invoice_totaltoko` int(11) NOT NULL,
  `invoice_statustoko` varchar(100) NOT NULL,
  `invoice_photo` varchar(255) NOT NULL,
  `invoice_status` varchar(100) NOT NULL,
  `invoice_cancel` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_clock` varchar(100) NOT NULL,
  `invoice_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `toko_id`, `pelanggan_username`, `invoice_item`, `invoice_ongkir`, `invoice_payment`, `invoice_weight`, `invoice_total`, `invoice_address`, `invoice_totaltoko`, `invoice_statustoko`, `invoice_photo`, `invoice_status`, `invoice_cancel`, `invoice_date`, `invoice_clock`, `invoice_created`, `invoice_updated`) VALUES
('0o4l7B04', '4', 'user', 1, 100000, 'Transfer Bank', 122, 110000, 'asd', 1, 'processaccept', '218811FRONTEND.jpg', 'process', '', '0000-00-00', '', '2018-08-01 21:31:20', '2018-08-01 21:32:06'),
('K46hs7V4', '4', 'user', 1, 100000, 'Transfer Bank', 12, 110000, 'uh', 1, 'processaccept', '573883HOSTING DAN DOMAIN.jpg', 'process', '', '0000-00-00', '', '2018-08-01 21:33:57', '2018-08-01 21:35:15'),
('QVE4akqn', '3', 'user', 1, 100000, 'Transfer Bank', 100, 120000, 'asd', 1, 'doneresi', '972686HOSTING DAN DOMAIN.jpg', 'done', '', '0000-00-00', '', '2018-08-01 21:33:06', '2018-08-01 21:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `menu_weight` int(11) NOT NULL,
  `menu_photo` varchar(255) NOT NULL,
  `menu_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `toko_id`, `category_id`, `menu_name`, `menu_description`, `menu_price`, `menu_weight`, `menu_photo`, `menu_created`, `menu_updated`) VALUES
(10, 3, 1, 'Indomie Donut', 'Indomie Donut', 20000, 100, '606231INDOMIE DONUT.png', '2018-07-30 19:32:51', '2018-07-30 19:32:51'),
(11, 4, 1, 'Ceker Midun', 'Ceker Midun', 10000, 122, '690368CEKER.png', '2018-07-30 19:34:38', '2018-07-30 19:35:20'),
(12, 4, 1, 'Cilok', 'Cilok', 10000, 12, '829101CILOK SIOMAY.png', '2018-07-30 19:37:02', '2018-07-30 19:38:58'),
(13, 5, 1, 'Sosis Telur', 'Sosis Telur', 5000, 12, '758178SOSIS TELUR.png', '2018-07-30 19:40:59', '2018-07-30 19:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `ongkir_id` int(11) NOT NULL,
  `ongkir_city` varchar(100) NOT NULL,
  `ongkir_price` int(11) NOT NULL,
  `ongkir_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ongkir_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`ongkir_id`, `ongkir_city`, `ongkir_price`, `ongkir_created`, `ongkir_updated`) VALUES
(1, 'Luar Kota', 100000, '2018-07-29 20:40:41', '2018-07-30 19:20:08'),
(2, 'Dalam Kota', 20000, '2018-07-29 20:40:48', '2018-07-30 19:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_username` varchar(25) NOT NULL,
  `pelanggan_session` varchar(122) NOT NULL,
  `pelanggan_name` varchar(100) NOT NULL,
  `pelanggan_alamat` varchar(100) NOT NULL,
  `pelanggan_notelp` varchar(16) NOT NULL,
  `pelanggan_saldo` int(11) NOT NULL DEFAULT '0',
  `pelanggan_password` varchar(100) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `pelanggan_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pelanggan_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_username`, `pelanggan_session`, `pelanggan_name`, `pelanggan_alamat`, `pelanggan_notelp`, `pelanggan_saldo`, `pelanggan_password`, `toko_id`, `pelanggan_created`, `pelanggan_updated`) VALUES
('user', '5p725unnj77n2a181cbpkj08e4', 'User', 'Dwipapuri Residence Blok E No 22', '081234567890', 200000, 'ee11cbb19052e40b07aac0ca060c23ee', 0, '2018-07-30 19:21:25', '2018-08-06 22:16:28'),
('user2', '4s798005ae6au5gviv66pelvf4', 'user2', 'Bandung', '08123456789', 0, '7e58d63b60197ceb55a1c487989a3720', 0, '2018-07-30 19:33:32', '2018-07-30 19:43:58'),
('user3', 'k44eg2o7ejte2it5q13a552l72', 'user3', 'Bandung', '08123456789', 0, '92877af70a45fd6a2ed7fe81e1236b78', 0, '2018-07-30 19:39:46', '2018-07-30 19:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `saldo_id` int(11) NOT NULL,
  `pelanggan_username` varchar(255) NOT NULL,
  `saldo_photo` varchar(255) NOT NULL,
  `saldo_price` int(11) NOT NULL,
  `saldo_cancel` varchar(255) NOT NULL,
  `saldo_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saldo_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `saldo_status` varchar(100) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`saldo_id`, `pelanggan_username`, `saldo_photo`, `saldo_price`, `saldo_cancel`, `saldo_created`, `saldo_updated`, `saldo_status`) VALUES
(5, 'user', '290893FRONTEND.jpg', 200000, '', '2018-07-30 22:26:43', '2018-07-30 22:31:01', 'done'),
(6, 'user', '902557HOSTING DAN DOMAIN.jpg', 0, 'Buram', '2018-07-30 22:32:41', '2018-07-30 22:32:52', 'cancel');

-- --------------------------------------------------------

--
-- Table structure for table `saldodriver`
--

CREATE TABLE `saldodriver` (
  `saldodriver_id` int(11) NOT NULL,
  `driver_username` varchar(255) NOT NULL,
  `saldodriver_photo` varchar(255) NOT NULL,
  `saldodriver_price` int(11) NOT NULL,
  `saldodriver_cancel` varchar(255) NOT NULL,
  `saldodriver_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saldodriver_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldodriver`
--

INSERT INTO `saldodriver` (`saldodriver_id`, `driver_username`, `saldodriver_photo`, `saldodriver_price`, `saldodriver_cancel`, `saldodriver_created`, `saldodriver_updated`) VALUES
(4, 'ss', '82519bg.png', 100, '', '2018-07-30 12:15:19', '2018-07-30 12:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `saldotoko`
--

CREATE TABLE `saldotoko` (
  `saldotoko_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `saldotoko_photo` varchar(255) NOT NULL,
  `saldotoko_price` int(11) NOT NULL,
  `saldotoko_cancel` varchar(255) NOT NULL,
  `saldotoko_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `saldotoko_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `toko_id` int(11) NOT NULL,
  `pelanggan_username` varchar(255) NOT NULL,
  `toko_name` varchar(100) NOT NULL,
  `toko_status` varchar(100) NOT NULL,
  `toko_deskripsi` varchar(255) NOT NULL,
  `toko_alamat` varchar(255) NOT NULL,
  `toko_bank` varchar(100) NOT NULL,
  `toko_owner` varchar(100) NOT NULL,
  `toko_noaccount` varchar(100) NOT NULL,
  `toko_latitude` varchar(100) NOT NULL,
  `toko_longitude` varchar(100) NOT NULL,
  `toko_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `toko_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`toko_id`, `pelanggan_username`, `toko_name`, `toko_status`, `toko_deskripsi`, `toko_alamat`, `toko_bank`, `toko_owner`, `toko_noaccount`, `toko_latitude`, `toko_longitude`, `toko_created`, `toko_updated`) VALUES
(3, 'user', 'Warunk Ngemil', 'Open', 'Ngemil Kekinian, Ngemil Tanggal Tua, Ngemil Kenyang', 'Tamansari Atas', 'BRI', 'Ali', '12193', '-6.902917', '107.6065653,17', '2018-07-30 19:28:12', '2018-07-30 20:48:36'),
(4, 'user2', 'Warunk Kece', 'Open', 'Warunk Kece', 'Bandung', 'BCA', 'Si Kece', '0123712', '-6.902917', '107.6065653,17', '2018-07-30 19:34:20', '2018-07-30 20:44:33'),
(5, 'user3', 'Warunk Asik', 'Open', 'Warunk Asik', 'Bandung', 'Mandiri', 'Asik', '01238123', '-6.902917', '107.6065653,17', '2018-07-30 19:40:40', '2018-07-30 20:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `driver_username` varchar(100) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `transaction_name` varchar(100) NOT NULL,
  `transaction_qty` int(11) NOT NULL,
  `transaction_price` int(11) NOT NULL,
  `transaction_payment` varchar(100) NOT NULL,
  `transaction_status` varchar(100) NOT NULL,
  `transaction_statustoko` varchar(100) NOT NULL,
  `transaction_noresi` varchar(100) NOT NULL,
  `transaction_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `invoice_id`, `driver_username`, `toko_id`, `transaction_name`, `transaction_qty`, `transaction_price`, `transaction_payment`, `transaction_status`, `transaction_statustoko`, `transaction_noresi`, `transaction_created`, `transaction_updated`, `transaction_totalprice`) VALUES
(152, '0o4l7B04', '', 4, 'Ceker Midun', 1, 10000, 'Transfer Bank', 'process', 'processaccept', '', '2018-08-01 21:31:20', '2018-08-01 21:32:06', 10000),
(153, 'QVE4akqn', '', 3, 'Indomie Donut', 1, 20000, 'Transfer Bank', 'done', 'doneresi', 'sdhfs', '2018-08-01 21:33:06', '2018-08-01 21:35:41', 20000),
(154, 'K46hs7V4', '', 4, 'Cilok', 1, 10000, 'Transfer Bank', 'process', 'processaccept', '', '2018-08-01 21:33:57', '2018-08-01 21:35:15', 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_username`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`ongkir_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_username`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`saldo_id`);

--
-- Indexes for table `saldodriver`
--
ALTER TABLE `saldodriver`
  ADD PRIMARY KEY (`saldodriver_id`);

--
-- Indexes for table `saldotoko`
--
ALTER TABLE `saldotoko`
  ADD PRIMARY KEY (`saldotoko_id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`toko_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `ongkir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `saldo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `saldodriver`
--
ALTER TABLE `saldodriver`
  MODIFY `saldodriver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saldotoko`
--
ALTER TABLE `saldotoko`
  MODIFY `saldotoko_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `toko_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
