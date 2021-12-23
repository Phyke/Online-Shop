-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 07:39 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Address.ID` int(11) NOT NULL,
  `User.ID` int(11) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Address.Type` varchar(30) NOT NULL,
  `Postal.Code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`Address.ID`, `User.ID`, `Address`, `Address.Type`, `Postal.Code`) VALUES
(1, 441213001, '126/45 ซอย1 จังหวัด2', 'house', '45678'),
(2, 441213002, '234/47 ซอย5 จังหวัด1', 'house', '45677'),
(3, 441213003, '346/76 ซอย4 จังหวัด3', 'house', '45679'),
(4, 441213004, '1124 อาคารA จังหวัด4', 'condo', '45680'),
(5, 441213005, '912 อาคารA จังหวัด4', 'condo', '45680'),
(6, 441213006, '788/12 ซอย2 จังหวัด5', 'house', '45681');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `User.ID` int(11) DEFAULT NULL,
  `Reward.ID` int(11) DEFAULT NULL,
  `Coupon.Code` varchar(30) NOT NULL,
  `Coupon.Description` varchar(100) DEFAULT NULL,
  `Coupon.Usage` int(11) NOT NULL,
  `Coupon.Type` varchar(30) NOT NULL,
  `Coupon.Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`User.ID`, `Reward.ID`, `Coupon.Code`, `Coupon.Description`, `Coupon.Usage`, `Coupon.Type`, `Coupon.Value`) VALUES
(441213006, 5, 'BVCXCDZ1', 'ส่วนลด 100 บาท', 1, 'cost discount', 100),
(441213006, 6, 'GSDFEGL1', 'ส่วนลด 3%', 1, 'percent discount', 3),
(441213005, 4, 'JBHXON01', 'ส่วนลด 7%', 1, 'percent discount', 7),
(441213006, 4, 'JBHXON02', 'ส่วนลด 7%', 1, 'percent discount', 7),
(441213004, 2, 'TSCZSGQ1', 'ส่วนลด 40 บาท', 4, 'cost discount', 40),
(441213005, 2, 'TSCZSGQ2', 'ส่วนลด 40 บาท', 3, 'cost discount', 40),
(441213006, 2, 'TSCZSGQ3', 'ส่วนลด 40 บาท', 2, 'cost discount', 40),
(441213004, 1, 'TWXAZF01', 'ส่วนลด 30 บาท', 3, 'cost discount', 30),
(441213004, 3, 'XCBDHWE1', 'ส่วนลด 5%', 1, 'percent discount', 5),
(441213005, 3, 'XCBDHWE2', 'ส่วนลด 5%', 2, 'percent discount', 5);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `Delivery.Method.ID` int(11) NOT NULL,
  `Delivery.Detail` varchar(100) NOT NULL,
  `Delivery.Fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`Delivery.Method.ID`, `Delivery.Detail`, `Delivery.Fee`) VALUES
(1, 'Standard Delivery จัดส่งธรรมดาโดย K&K Express', 40),
(2, 'Standard Delivery จัดส่งธรรมดาโดย Curry', 35),
(3, 'Standard Delivery จัดส่งธรรมดาโดย DDL Domestic', 40),
(4, 'Standard Delivery จัดส่งธรรมดาโดย Ninjook Van', 35),
(5, 'Standard Delivery จัดส่งธรรมดาโดย Shozada Express', 35),
(6, 'Standard Delivery จัดส่งธรรมดาโดย Lazapee Express', 30);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `Order.No` int(11) NOT NULL,
  `Order.Date.Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `User.ID` int(11) DEFAULT NULL,
  `Address.ID` int(11) DEFAULT NULL,
  `Shop.Name` varchar(30) DEFAULT NULL,
  `Payment.ID` int(30) DEFAULT NULL,
  `Delivery.Method.ID` int(11) DEFAULT NULL,
  `Coupon.Code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`Order.No`, `Order.Date.Time`, `User.ID`, `Address.ID`, `Shop.Name`, `Payment.ID`, `Delivery.Method.ID`, `Coupon.Code`) VALUES
(1, '2021-05-18 09:05:07', 441213004, 4, 'หูฟังเสียงดี', 1, 1, 'XCBDHWE1'),
(2, '2021-05-22 12:35:22', 441213005, 5, 'keycap สกรีนไทย', 4, 6, 'XCBDHWE2'),
(3, '2021-05-23 10:40:22', 441213004, 4, 'บ้านกาแฟ', 1, 5, 'TWXAZF01'),
(4, '2021-06-07 06:15:43', 441213006, 6, 'specialty coff', 6, 4, 'JBHXON02'),
(5, '2021-06-08 10:28:17', 441213005, 5, 'cool-comp shop', 5, 5, 'TSCZSGQ2'),
(6, '2021-06-13 04:18:32', 441213004, 4, 'specialty coff', 2, 4, 'TWXAZF01'),
(7, '2021-06-16 03:07:56', 441213006, 6, 'specialty coff', 7, 2, 'BVCXCDZ1'),
(8, '2021-06-16 05:03:42', 441213005, 5, 'หูฟังเสียงดี', 5, 1, 'XCBDHWE2'),
(9, '2021-06-17 07:08:48', 441213006, 6, 'cool-comp shop', 6, 5, NULL),
(10, '2021-06-17 13:25:41', 441213005, 5, 'specialty coff', 4, 2, NULL),
(11, '2021-06-17 10:23:10', 441213006, 6, 'specialty coff', 6, 2, 'JBHXON02'),
(12, '2021-06-20 10:31:04', 441213005, 5, 'หูฟังเสียงดี', 4, 1, 'JBHXON01'),
(13, '2021-06-20 15:07:45', 441213004, 4, 'หูฟังเสียงดี', 2, 3, 'TWXAZF01'),
(14, '2021-06-22 07:02:58', 441213006, 6, 'keycap สกรีนไทย', 7, 3, 'TSCZSGQ3'),
(15, '2021-06-25 10:01:24', 441213004, 4, 'specialty coff', 3, 2, 'TSCZSGQ1');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `Order.No` int(11) NOT NULL,
  `Product.ID` int(11) NOT NULL,
  `Product.Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`Order.No`, `Product.ID`, `Product.Amount`) VALUES
(1, 4, 1),
(1, 6, 1),
(1, 7, 1),
(2, 12, 1),
(3, 8, 3),
(3, 10, 3),
(3, 11, 3),
(4, 19, 1),
(4, 23, 1),
(4, 26, 2),
(4, 28, 2),
(5, 16, 1),
(5, 18, 3),
(6, 29, 1),
(7, 23, 1),
(7, 25, 2),
(8, 4, 1),
(8, 7, 1),
(9, 17, 2),
(10, 19, 3),
(11, 22, 1),
(11, 27, 1),
(11, 30, 1),
(12, 2, 1),
(13, 5, 1),
(14, 8, 1),
(14, 9, 1),
(15, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment.ID` int(11) NOT NULL,
  `User.ID` int(11) DEFAULT NULL,
  `Payment.Method` varchar(30) NOT NULL,
  `Payment.Partner` varchar(30) NOT NULL,
  `Reference.No` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment.ID`, `User.ID`, `Payment.Method`, `Payment.Partner`, `Reference.No`) VALUES
(1, 441213004, 'ชำระผ่านบัญชีธนาคาร', 'KBANK', 'ABCD124756'),
(2, 441213004, 'ชำระผ่านบัตรเครดิต', 'BBL', 'ABCD124757'),
(3, 441213004, 'ชำระผ่าน ATM', 'KBANK', 'ABCD124758'),
(4, 441213005, 'ชำระผ่านบัญชีธนาคาร', 'SCB', 'ABCD124759'),
(5, 441213005, 'ชำระผ่านบัตรเครดิต', 'SCB', 'ABCD124760'),
(6, 441213006, 'ชำระผ่าน ATM', 'KTB', 'ABCD124761'),
(7, 441213006, 'ชำระผ่านบัญชีธนาคาร', 'KTB', 'ABCD124762');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product.ID` int(11) NOT NULL,
  `Shop.Name` varchar(30) NOT NULL,
  `Product.Name` varchar(100) NOT NULL,
  `Product.Description` varchar(300) DEFAULT NULL,
  `Product.Price` int(11) NOT NULL,
  `Product.Stock` int(11) NOT NULL,
  `Product.Rating` varchar(30) DEFAULT NULL,
  `Promotion.ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product.ID`, `Shop.Name`, `Product.Name`, `Product.Description`, `Product.Price`, `Product.Stock`, `Product.Rating`, `Promotion.ID`) VALUES
(1, 'หูฟังเสียงดี', 'หูฟัง Inear', 'หูฟัง Inear โทนเสียงนุ่ม เวทีเสียงปานกลาง ใส่สบายใส่ได้นาน', 780, 457, '4.5', 2),
(2, 'หูฟังเสียงดี', 'หูฟัง Headphone', 'หูฟัง Headphone เบสกระชับ เสียงร้องนำ เวทีเสียงดี', 6200, 125, '4.8', 1),
(3, 'หูฟังเสียงดี', 'หูฟัง IEM 2 Driver 1BA+1DD', 'หูฟัง IEM มี1BAให้เสียงสูงที่ดี 1DDให้เสียงกลาง-เบส มีเวทีเสียงปานกลาง', 480, 350, '3.9', 2),
(4, 'หูฟังเสียงดี', 'หูฟัง IEM 5 Driver 4BA+1DD', 'หูฟัง IEM มี1BAให้เสียงสูง 2BAให้เสียงกลาง 1BAให้เสียงต่ำ และ1DD เวทีเสียงปานกลาง โทนเสียงนุ่มนวล เบสกระชับ', 5700, 78, '4.6', 1),
(5, 'หูฟังเสียงดี', 'หูฟัง IEM 8 Driver 6BA+2DD', 'หูฟัง IEM high-end มี2BAให้เสียงสูง 2BAให้เสียงกลาง 2BAให้เสียงต่ำ และ2DD เสียงที่ได้มีคุณภาพดีมาก เสียงร้อนนำเล็กน้อย เบสกระชับ เวทีเสียงดี', 16800, 32, '4.9', 1),
(6, 'หูฟังเสียงดี', 'หูฟัง True wireless', 'หูฟัง True wireless น้ำหนักเบา ให้เสียงคุณภาพปานกลาง', 580, 382, '4.1', 2),
(7, 'หูฟังเสียงดี', 'ABC-A1 DAC พกพา', 'DAC สำหรับพกพา ช่วยเพิ่มคุณภาพของเพลงให้ดีขึ้น', 2100, 52, '4.5', 1),
(8, 'บ้านกาแฟ', 'เมล็ดกาแฟ Arabica light roast', 'กาแฟ Arabica คั่วอ่อน กลิ่นออกแนวเบอร์รี่ กลิ่นดอกไม้ ปริมาณ 200 กรัม มีบริการบดฟรี!', 180, 583, '4.7', 3),
(9, 'บ้านกาแฟ', 'เมล็ดกาแฟ Arabica medium roast', 'กาแฟ Arabica คั่วกลาง รสชาติออกแนว ช็อคโกแลต ถั่ว  ปริมาณ 200 กรัมมีบริการบดฟรี!', 180, 482, '4.4', 3),
(10, 'บ้านกาแฟ', 'เมล็ดกาแฟ Arabica medium-dark roast', 'กาแฟ Arabica คั่วกลาง รสชาติออกแนว ดาร์คช็อคโกแลต บอดี้หนา เข้มข้น ปริมาณ 200 กรัม มีบริการบดฟรี!', 190, 380, '4.5', 3),
(11, 'บ้านกาแฟ', 'เมล็ดกาแฟ house blend', 'กาแฟ blend จากตัวคั่วอ่อนและคั่วกลาง มีบอดี้ปานกลาง กลิ่นดอกไม้ชัดเจน ปริมาณ 200 กรัม มีบริการบดฟรี!', 220, 720, '4.2', 3),
(12, 'keycap สกรีนไทย', 'keycap สีขาว', 'keycap สีขาว พร้อมสกรีนภาษาไทย และ ที่ดึงkeycap', 450, 52, '3.8', NULL),
(13, 'keycap สกรีนไทย', 'keycap ดำ', 'keycap สีดำ พร้อมสกรีนภาษาไทย และ ที่ดึงkeycap', 450, 18, '4.1', NULL),
(14, 'keycap สกรีนไทย', 'keycap สีชมพู', 'keycap สีชมพู พร้อมสกรีนภาษาไทย และ ที่ดึงkeycap', 450, 48, '3.9', NULL),
(15, 'keycap สกรีนไทย', 'keycap ฟ้า', 'keycap สีฟ้า พร้อมสกรีนภาษาไทย และ ที่ดึงkeycap', 450, 32, '4', NULL),
(16, 'cool-comp shop', 'Silicone gel', 'silicone สำหรับใช้ทาบริเวณกระดอง cpu ช่วยลดความร้อนของ cpu ได้ดี ขนาด 8 กรัม', 220, 25, '4.5', 5),
(17, 'cool-comp shop', 'Silicone pad', 'silicone pad สำหรับแปะระหว่าง ชิบแรม ภาคจ่าไฟ กับที่ระบายความร้อนของการ์ดจอ ความหนา 1 ซม. ขนาด 50 x 50 มม.', 480, 18, '4', 4),
(18, 'cool-comp shop', 'Cooling Fan', 'พัดลมช่วยระบายความร้อน ขนาด 120 มม.', 200, 58, '4.2', 4),
(19, 'specialty coff', 'เมล็ดกาแฟ คั่วอ่อน Ethiopia', 'เมล็ดคั่วอ่อน Anaerobic Process tasting note: berrymstrawberry พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 360, 20, '4.5', 6),
(20, 'specialty coff', 'เมล็ดกาแฟ คั่วอ่อน Kenya', 'เมล็ดคั่วอ่อน Washed Process tasting note: dark berries vanilla ,green apple, high acidity and sweetness พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 490, 25, '4.5', 6),
(21, 'specialty coff', 'เมล็ดกาแฟ คั่วกลาง Colombia', 'เมล็ดคั่วกลาง Washed Process tasting note: chocolate, caramel พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 220, 10, '4.7', 6),
(22, 'specialty coff', 'เมล็ดกาแฟ คั่วกลาง Kenya Endebess', 'เมล็ดคั่วกลาง Washed Process tasting note: jammy, blueberry พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 420, 9, '4.9', 6),
(23, 'specialty coff', 'เมล็ดกาแฟ คั่วกลาง Brazil Cerrado', 'เมล็ดคั่วกลาง Natural Process tasting note: walnut, cinnamon, chocolate พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 350, 25, '4', 6),
(24, 'specialty coff', 'เมล็ดกาแฟ คั่วเข้ม house blend', 'เมล็ดคั่วเข้ม blend ของทางร้าน Washed Process tasting note: dark chocolate, black tea, full body, low acidity พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 250, 17, '4.4', 6),
(25, 'specialty coff', 'dripper kettle', 'กาดริป ช่วยทำให้เส้นน้ำที่ได้มีขนาดคงที่ ช่วยให้ดริปกาแฟได้ดีขึ้น', 480, 20, '4', 6),
(26, 'specialty coff', 'เมล็ดกาแฟ คั่วอ่อน Maejantai', 'เมล็ดคั่วอ่อน จากหมู่บ้านแม่จันใต้ Washed Process tasting note: floral, black tea, freshy  พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g ', 180, 18, '4.6', NULL),
(27, 'specialty coff', 'เมล็ดกาแฟ คั่วเข้ม Brazil', 'เมล็ดคั่วเข้ม Natural Process tasting note: almond, chocolate พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 250, 28, '4.6', NULL),
(28, 'specialty coff', 'เมล็ดกาแฟ คั่วกลาง house blend', 'เมล็ดคั่วกลาง blend ของทางร้าน Washed Process tasting note: tea-like, floral, green apple พร้อมบอกวันที่คั่วที่ตัวสินค้า ปริมาณ 200 g', 490, 14, '4.8', NULL),
(29, 'specialty coff', 'V60 filter paper', 'กระดาษกรอง สำหรับ dirpper ทรง V60 100 แผ่น', 160, 72, '4.2', NULL),
(30, 'specialty coff', 'coffee canister', 'ที่เก็บเมล็ดกาแฟ ทำจากอลูมิเนียม และมีวาว์ลสำหรับคาย CO2 เก็บเมล็ดได้ 300 g', 500, 35, '4.1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `Promotion.ID` int(11) NOT NULL,
  `Shop.Name` varchar(30) NOT NULL,
  `Promotion.Expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Promotion.Type` varchar(30) NOT NULL,
  `Promotion.Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`Promotion.ID`, `Shop.Name`, `Promotion.Expire`, `Promotion.Type`, `Promotion.Value`) VALUES
(1, 'หูฟังเสียงดี', '2021-10-05 17:00:00', 'cost discount', 100),
(2, 'หูฟังเสียงดี', '2021-12-30 17:00:00', 'percent discount', 10),
(3, 'บ้านกาแฟ', '2022-05-04 17:00:00', 'percent discount', 3),
(4, 'cool-comp shop', '2021-08-08 17:00:00', 'cost discount', 25),
(5, 'cool-comp shop', '2021-07-21 17:00:00', 'percent discount', 4),
(6, 'specialty coff', '2022-12-14 17:00:00', 'percent discount', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `Reward.ID` int(11) NOT NULL,
  `Reward.Description` varchar(100) NOT NULL,
  `Reward.Price` int(11) NOT NULL,
  `Reward.Start.Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Reward.End.Time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Reward.Stock` int(11) DEFAULT NULL,
  `Reward.Type` varchar(30) NOT NULL,
  `Reward.Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`Reward.ID`, `Reward.Description`, `Reward.Price`, `Reward.Start.Time`, `Reward.End.Time`, `Reward.Stock`, `Reward.Type`, `Reward.Value`) VALUES
(1, 'ส่วนลด 30 บาท', 50, '2021-04-14 17:00:00', '2021-07-14 17:00:00', 52, 'cost discount', 30),
(2, 'ส่วนลด 40 บาท', 75, '0000-00-00 00:00:00', '2021-08-30 17:00:00', 43, 'cost discount', 40),
(3, 'ส่วนลด 5%', 100, '2021-04-29 17:00:00', '2021-08-30 17:00:00', 32, 'percent discount', 5),
(4, 'ส่วนลด 7%', 180, '2021-04-30 17:00:00', '2021-10-30 17:00:00', 12, 'percent discount', 7),
(5, 'ส่วนลด 100 บาท', 150, '2021-04-29 17:00:00', '2021-07-30 17:00:00', 23, 'cost discount', 100),
(6, 'ส่วนลด 3%', 80, '2021-03-30 17:00:00', '2021-08-14 17:00:00', 39, 'percent discount', 3);

-- --------------------------------------------------------

--
-- Table structure for table `searching`
--

CREATE TABLE `searching` (
  `User.ID` int(11) NOT NULL,
  `Searching.Word` varchar(30) NOT NULL,
  `Searching.Date.Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Searching.Destination.Product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `searching`
--

INSERT INTO `searching` (`User.ID`, `Searching.Word`, `Searching.Date.Time`, `Searching.Destination.Product`) VALUES
(441213004, 'หูฟัง', '2021-05-18 08:43:20', 1),
(441213004, 'inear', '2021-05-18 08:44:03', 1),
(441213004, 'headphone', '2021-05-18 08:44:25', 2),
(441213004, 'iem', '2021-05-18 08:44:55', 3),
(441213004, 'iem 2 driver', '2021-05-18 08:45:20', 3),
(441213004, 'iem 5 driver', '2021-05-18 08:48:34', 4),
(441213004, 'iem ba', '2021-05-18 08:50:23', 3),
(441213004, 'หูฟัง TW', '2021-05-18 08:52:18', 6),
(441213004, 'dac', '2021-05-18 08:57:19', 7),
(441213004, 'เมล็ดกาแฟ arabica', '2021-05-23 10:25:32', 8),
(441213004, 'arabica light', '2021-05-23 10:26:21', 8),
(441213004, 'dark roast', '2021-05-23 10:28:02', 10),
(441213004, 'medium roast', '2021-05-23 10:35:01', 9),
(441213004, 'เมล็ดกาแฟblend', '2021-05-23 10:38:42', 11),
(441213004, 'กาต้มน้ำ', '2021-06-12 07:01:12', NULL),
(441213004, 'กาดริปกาแฟ', '2021-06-12 07:02:01', NULL),
(441213004, 'กาดริป', '2021-06-12 07:03:25', NULL),
(441213004, 'kettle', '2021-06-13 04:07:25', 29),
(441213004, 'dripper kettle', '2021-06-13 04:09:28', 29),
(441213005, 'keycap สีดำ', '2021-05-22 12:25:32', 13),
(441213005, 'keycap สีขาว', '2021-05-22 12:27:48', 12),
(441213005, 'keycap สีฟ้า', '2021-05-22 12:30:12', 15),
(441213005, 'silicone gel', '2021-06-08 10:20:36', 16),
(441213005, 'fan', '2021-06-08 10:22:39', 18),
(441213005, 'cooling fan', '2021-06-08 10:23:41', 18),
(441213005, 'silicone pad', '2021-06-08 10:25:07', 17),
(441213006, 'เมล็ดกาแฟ', '2021-06-07 05:48:21', 8),
(441213006, 'เมล็ดกาแฟคั่วอ่อน', '2021-06-07 05:49:58', 19),
(441213006, 'คั่วอ่อน maejantai', '2021-06-07 05:51:02', 21),
(441213006, 'คั่วอ่อน kenya', '2021-06-07 05:51:48', 20),
(441213006, 'คั่วกลาง colombia', '2021-06-07 05:52:04', 22),
(441213006, 'คั่วกลาง kenya', '2021-06-07 05:53:20', 23),
(441213006, 'คั่วเข้ม Brazil', '2021-06-07 05:54:30', 25),
(441213006, 'เมล็ดคั่วกลาง', '2021-06-07 05:56:28', 22),
(441213006, 'เมล็ดคั่วเข้ม', '2021-06-07 05:58:03', 26),
(441213006, 'kettle', '2021-06-07 06:02:57', 29),
(441213006, 'dripper kettle', '2021-06-07 06:04:18', 29),
(441213006, 'filter paper', '2021-06-07 06:06:23', 28),
(441213006, 'คั่วกลาง kenya', '2021-06-16 03:02:08', 23),
(441213006, 'คั่วเข้ม brazil', '2021-06-16 03:05:12', 25);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `User.ID` int(11) DEFAULT NULL,
  `Shop.Name` varchar(30) NOT NULL,
  `Shop.Address` varchar(100) NOT NULL,
  `Shop.Rating` varchar(30) DEFAULT NULL,
  `Shop.Type` varchar(30) NOT NULL,
  `Bank.Code` varchar(30) NOT NULL,
  `Bank.Account.Number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`User.ID`, `Shop.Name`, `Shop.Address`, `Shop.Rating`, `Shop.Type`, `Bank.Code`, `Bank.Account.Number`) VALUES
(441213002, 'cool-comp shop', '234/47 ซอย5 จังหวัด1 45677', '4.2', 'ไม่มีหน้าร้าน', '12245', '54022139'),
(441213001, 'keycap สกรีนไทย', '123/45 ซอย1 จังหวัด2 45678', '4.4', 'ไม่มีหน้าร้าน', '11225', '42245369'),
(441213003, 'specialty coff', '345/76 ซอย4 จังหวัด3 45679', '4.9', 'มีหน้าร้าน', '24113', '52448975'),
(441213001, 'บ้านกาแฟ', '124/45 ซอย1 จังหวัด2 45678', '4.7', 'ไม่มีหน้าร้าน', '11223', '42245368'),
(441213001, 'หูฟังเสียงดี', '123/45 ซอย1 จังหวัด2 45678', '4.8', 'Official', '11223', '42245367');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User.ID` int(11) NOT NULL,
  `User.First.Name` varchar(30) NOT NULL,
  `User.Last.Name` varchar(30) NOT NULL,
  `User.Phone` varchar(30) NOT NULL,
  `User.Email` varchar(50) NOT NULL,
  `User.Password` varchar(30) NOT NULL,
  `Registration.Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Reward.Point.Own` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User.ID`, `User.First.Name`, `User.Last.Name`, `User.Phone`, `User.Email`, `User.Password`, `Registration.Date`, `Reward.Point.Own`) VALUES
(441213001, 'มังคุด', 'ตั้งใจขาย', '1634896652', 'mangkud@somemail.com', 'abcd123', '2016-02-17 17:00:00', 21),
(441213002, 'เขียว', 'นอนน้อย.', '5294230127', 'sogreen@somemail.com', 'efgh456', '2017-06-10 17:00:00', 50),
(441213003, 'แดง', 'ร้อนมาก', '1036527890', 'red_hot@somemail.com', 'a123bcd', '2017-12-11 17:00:00', 75),
(441213004, 'ดำ', 'ร้อนน้อย', '5987563001', 'black_co@somemail.com', 'e456fgh', '2018-05-05 17:00:00', 102),
(441213005, 'ฟ้า', 'ฟรุ้งฟริ้ง', '6230145289', 'blue_sky@somemail.com', '123aabbcc', '2018-05-16 17:00:00', 453),
(441213006, 'ส้มโอ', 'โอเคป่ะ', '1300547856', 'somsom_ok@somemail.com', '456ddeeaa', '2021-03-31 17:00:00', 732);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Address.ID`),
  ADD KEY `User.ID` (`User.ID`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`Coupon.Code`),
  ADD KEY `User.ID` (`User.ID`),
  ADD KEY `Reward.ID` (`Reward.ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Delivery.Method.ID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`Order.No`),
  ADD KEY `User.ID` (`User.ID`),
  ADD KEY `Address.ID` (`Address.ID`),
  ADD KEY `Shop.Name` (`Shop.Name`),
  ADD KEY `Payment.ID` (`Payment.ID`),
  ADD KEY `Delivery.Method.ID` (`Delivery.Method.ID`),
  ADD KEY `Coupon.Code` (`Coupon.Code`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`Order.No`,`Product.ID`),
  ADD KEY `Product.ID` (`Product.ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment.ID`),
  ADD KEY `User.ID` (`User.ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product.ID`),
  ADD KEY `Shop.Name` (`Shop.Name`),
  ADD KEY `Promotion.ID` (`Promotion.ID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`Promotion.ID`),
  ADD KEY `Shop.Name` (`Shop.Name`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`Reward.ID`);

--
-- Indexes for table `searching`
--
ALTER TABLE `searching`
  ADD PRIMARY KEY (`User.ID`,`Searching.Date.Time`),
  ADD KEY `Searching.Destination.Product` (`Searching.Destination.Product`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`Shop.Name`),
  ADD KEY `User.ID` (`User.ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User.ID`),
  ADD UNIQUE KEY `User.Email` (`User.Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `Address.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `Delivery.Method.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `Order.No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `Promotion.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `Reward.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User.ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441213007;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`User.ID`) REFERENCES `users` (`User.ID`) ON DELETE CASCADE;

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`User.ID`) REFERENCES `users` (`User.ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`Reward.ID`) REFERENCES `reward` (`Reward.ID`) ON DELETE SET NULL;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`User.ID`) REFERENCES `users` (`User.ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`Address.ID`) REFERENCES `address` (`Address.ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `orderdetail_ibfk_3` FOREIGN KEY (`Shop.Name`) REFERENCES `shop` (`Shop.Name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_4` FOREIGN KEY (`Payment.ID`) REFERENCES `payment` (`Payment.ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `orderdetail_ibfk_5` FOREIGN KEY (`Delivery.Method.ID`) REFERENCES `delivery` (`Delivery.Method.ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `orderdetail_ibfk_6` FOREIGN KEY (`Coupon.Code`) REFERENCES `coupon` (`Coupon.Code`) ON DELETE SET NULL;

--
-- Constraints for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`Order.No`) REFERENCES `orderdetail` (`Order.No`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`Product.ID`) REFERENCES `product` (`Product.ID`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`User.ID`) REFERENCES `users` (`User.ID`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Shop.Name`) REFERENCES `shop` (`Shop.Name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Promotion.ID`) REFERENCES `promotion` (`Promotion.ID`) ON DELETE SET NULL;

--
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_ibfk_1` FOREIGN KEY (`Shop.Name`) REFERENCES `shop` (`Shop.Name`) ON UPDATE CASCADE;

--
-- Constraints for table `searching`
--
ALTER TABLE `searching`
  ADD CONSTRAINT `searching_ibfk_1` FOREIGN KEY (`User.ID`) REFERENCES `users` (`User.ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `searching_ibfk_2` FOREIGN KEY (`Searching.Destination.Product`) REFERENCES `product` (`Product.ID`) ON DELETE SET NULL;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`User.ID`) REFERENCES `users` (`User.ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
