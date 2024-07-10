-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 10:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhavi_invoice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advancehistory`
--

CREATE TABLE `advancehistory` (
  `id` int(11) NOT NULL,
  `Invoice_no` int(150) NOT NULL,
  `Date` date NOT NULL,
  `advance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advancehistory`
--

INSERT INTO `advancehistory` (`id`, `Invoice_no`, `Date`, `advance`) VALUES
(1, 116, '2024-01-13', 500),
(2, 118, '2024-01-13', 50),
(3, 0, '2024-01-19', 500),
(4, 121, '2024-01-13', 786),
(5, 47, '2024-01-13', 500),
(6, 19, '2024-01-13', 5),
(7, 19, '2024-01-13', 5),
(8, 49, '2024-01-17', 500),
(9, 49, '2024-01-17', 500),
(10, 49, '2024-01-17', 250),
(11, 51, '2024-01-23', 0),
(12, 53, '1970-01-01', 200),
(13, 54, '1970-01-01', 50),
(14, 55, '2024-01-11', 50),
(15, 19, '2024-01-31', 5),
(16, 19, '2024-01-31', 5),
(17, 19, '2024-01-31', 8);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `Company_name` varchar(150) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Gst_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Company_name`, `Name`, `Phone`, `Email`, `Address`, `Gst_no`) VALUES
(2, 'abhinaya', 'raj', '07498188555', 'raj@gmail.com', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', '38GN58POMVDJGJG'),
(3, 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'ram@gmail.com', 'kakinada', 'EWQRWEREW'),
(4, 'smart physiocare', 'pawan', '7730000000000', 'phanichalikonda@gmail.com', 'apsp', '2245452JNDKLWSAFC'),
(5, 'smart physiocare', 'pawan', '7730000000000', '', 'apsp', ''),
(6, 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'ram@gmail.com', 'KKD', '37AN89852');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_desc_tbl`
--

CREATE TABLE `expenditure_desc_tbl` (
  `id` int(11) NOT NULL,
  `main_expenditure_id` int(11) NOT NULL,
  `exp_name` varchar(255) NOT NULL,
  `exp_description` text NOT NULL,
  `mode_payment` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenditure_desc_tbl`
--

INSERT INTO `expenditure_desc_tbl` (`id`, `main_expenditure_id`, `exp_name`, `exp_description`, `mode_payment`, `amount`) VALUES
(1, 1, 'Rajkumar Giduthuri', 'asdsad', 'Phone-pay', 50),
(2, 1, 'Rajkumar Giduthuri', 'sadsad', 'Google-pay', 50),
(3, 3, 'Rajkumar Giduthuri', 'asdsads', 'select', 50);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_tbl`
--

CREATE TABLE `expenditure_tbl` (
  `id` int(11) NOT NULL,
  `total_amount` int(225) NOT NULL,
  `amount_in_words` text NOT NULL,
  `exp_note` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exp_name`
--

CREATE TABLE `exp_name` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exp_type`
--

CREATE TABLE `exp_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exp_type`
--

INSERT INTO `exp_type` (`id`, `name`) VALUES
(1, 'BOOKS'),
(2, 'Printing');

-- --------------------------------------------------------

--
-- Table structure for table `gst_no`
--

CREATE TABLE `gst_no` (
  `si_No` int(11) NOT NULL,
  `gst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gst_no`
--

INSERT INTO `gst_no` (`si_No`, `gst`) VALUES
(1, 0),
(2, 5),
(3, 12),
(4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Sid` int(11) NOT NULL,
  `Invoice_no` int(11) NOT NULL,
  `Invoice_date` date NOT NULL,
  `Company_name` varchar(150) NOT NULL,
  `Cname` varchar(50) NOT NULL,
  `Cphone` varchar(150) NOT NULL,
  `Caddress` text NOT NULL,
  `Cmail` varchar(150) NOT NULL,
  `Cgst` varchar(150) NOT NULL,
  `Final` double(10,2) NOT NULL,
  `Gst` int(20) NOT NULL,
  `Gst_total` double(10,2) NOT NULL,
  `Grandtotal` double(10,2) NOT NULL,
  `Totalinwords` text NOT NULL,
  `Terms` text NOT NULL,
  `Note` text NOT NULL,
  `advance` double(10,2) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `balancewords` text NOT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Sid`, `Invoice_no`, `Invoice_date`, `Company_name`, `Cname`, `Cphone`, `Caddress`, `Cmail`, `Cgst`, `Final`, `Gst`, `Gst_total`, `Grandtotal`, `Totalinwords`, `Terms`, `Note`, `advance`, `balance`, `balancewords`, `status`) VALUES
(24, 19, '2023-12-21', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 38.00, 0, 0.00, 38.00, 'thirty eight rupees only ', 'gbdfsgdfg', 'dfgdfgds', 38.00, 0.00, 'only ', 'pending'),
(25, 20, '2023-12-30', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 38.00, 12, 4.56, 42.56, 'forty two rupees and fifty six  paisa only ', 'gfdsgdsgffdg', 'sdfhgbfdgdffg', 5.00, 37.56, '', 'pending'),
(28, 21, '2023-12-30', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 95.00, 5, 4.75, 99.75, 'ninety nine rupees and seventy five  paisa only ', 'fdsssssssssssssssssssssssssssgrdfeeeeegszzzzzzzzbvtvehtrtrtrtrtrtrtrtrtrtrtrtrhghdrt', 'rethbgfuvfdluihrru ieuirgjhgreo', 50.00, 49.75, '', 'paid'),
(31, 23, '2023-12-30', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 4750.00, 5, 237.50, 4987.50, 'four thousand nine hundred and eighty seven rupees and five  paisa only ', 'sdzdgfdfgfdgfdgdf', 'gdsfgdfsgdfjgbhlrdriguyoli', 200.00, 4787.50, 'four thousand seven hundred and eighty seven rupees and five  paisa only ', 'pending'),
(34, 25, '2024-01-18', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 62040.00, 18, 11167.20, 73207.20, 'seventy three thousand two hundred and seven rupees and two  paisa only ', 'gfjgfjgfjhgj', 'gfjghfjh', 800.00, 72407.20, 'seventy two thousand four hundred and seven rupees and two  paisa only ', 'pending'),
(35, 26, '2024-01-25', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 13411.80, 50, 6705.90, 20117.70, 'twenty thousand one hundred and seventeen rupees and ninety seven  paisa only ', 'gfj hggjfgjh ', ' jgf gjhhgj', 50.00, 20067.70, 'twenty thousand and sixty seven rupees and seven  paisa only ', 'paid'),
(36, 27, '1970-01-01', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 27550.00, 5, 1377.50, 28927.50, 'twenty eight thousand nine hundred and twenty seven rupees and five  paisa only ', '', '', 1000.00, 1802.50, 'one thousand eight hundred and two rupees and five  paisa only ', 'paid'),
(37, 28, '1970-01-01', '', '', '', '', '', '', 27550.00, 0, 0.00, 27550.00, 'twenty seven thousand five hundred and fifty rupees only ', '', '', 500.00, 27050.00, 'twenty seven thousand and fifty rupees only ', 'paid'),
(38, 29, '1970-01-01', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375095.00, 0, 0.00, 2375095.00, 'twenty three lakh seventy five thousand and ninety five rupees only ', '', '', 0.00, 2375095.00, 'twenty three lakh seventy five thousand and ninety five rupees only ', 'pending'),
(39, 30, '2024-01-25', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 18, 427.50, 2802.50, 'two thousand eight hundred and two rupees and five  paisa only ', '', '', 0.00, 2802.50, 'two thousand eight hundred and two rupees and five  paisa only ', 'paid'),
(40, 30, '2024-01-25', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 18, 427.50, 2802.50, 'two thousand eight hundred and two rupees and five  paisa only ', '', '', 0.00, 2802.50, 'two thousand eight hundred and two rupees and five  paisa only ', 'paid'),
(41, 31, '2024-01-08', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 23750.00, 0, 0.00, 23750.00, 'twenty three thousand seven hundred and fifty rupees only ', '', '', 0.00, 23750.00, 'twenty three thousand seven hundred and fifty rupees only ', 'paid'),
(44, 33, '2024-01-26', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2300.00, 0, 0.00, 2300.00, 'two thousand three hundred only ', '', '', 0.00, 2300.00, 'two thousand three hundred only ', 'paid'),
(45, 34, '2024-05-08', 'smart physiocare', 'pawan', '7730000000000', 'apsp', '', '', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', '', '', 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', 'pending'),
(48, 35, '2024-01-10', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', '', '', 5.00, 2370.00, 'two thousand three hundred and seventy rupees only ', 'paid'),
(49, 19, '1970-01-01', '', '', '', '', '', '', 0.00, 0, 0.00, 38.00, '', '', '', 38.00, 0.00, 'only ', 'pending'),
(50, 36, '2024-01-11', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 18, 427.50, 2802.50, 'two thousand eight hundred and two rupees and five  paisa only ', '', '', 1300.00, 1502.50, 'one thousand five hundred and two rupees and five  paisa only ', 'paid'),
(106, 37, '2024-01-13', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 985.50, 12, 118.26, 1103.76, 'one thousand one hundred and three rupees and seventy six  paisa only ', 'bfdbhfdxh', 'fghdfhghgf', 500.00, 603.76, 'six hundred and three rupees and seventy six  paisa only ', 'pending'),
(107, 38, '2024-01-13', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 237.50, 5, 11.88, 249.38, 'two hundred and forty nine rupees and thirty eight  paisa only ', '', '', 100.00, 149.38, 'one hundred and forty nine rupees and thirty eight  paisa only ', 'pending'),
(108, 39, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 12, 285.00, 2660.00, 'two thousand six hundred and sixty rupees only ', '', '', 500.00, 2160.00, 'two thousand one hundred and sixty rupees only ', 'pending'),
(109, 39, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 12, 285.00, 2660.00, 'two thousand six hundred and sixty rupees only ', '', '', 500.00, 2160.00, 'two thousand one hundred and sixty rupees only ', 'pending'),
(110, 40, '2024-01-19', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', '', '', 50.00, 2325.00, 'two thousand three hundred and twenty five rupees only ', 'paid'),
(111, 40, '2024-01-19', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', '', '', 50.00, 2325.00, 'two thousand three hundred and twenty five rupees only ', 'paid'),
(112, 41, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 50.00, 12, 6.00, 56.00, 'fifty six rupees only ', '', '', 5.00, 51.00, 'fifty one rupees only ', 'paid'),
(113, 41, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 50.00, 12, 6.00, 56.00, 'fifty six rupees only ', '', '', 5.00, 51.00, 'fifty one rupees only ', 'paid'),
(114, 42, '1970-01-01', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 237.50, 12, 28.50, 266.00, 'two hundred and sixty six rupees only ', '', '', 50.00, 216.00, 'two hundred and sixteen rupees only ', 'paid'),
(115, 42, '1970-01-01', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 237.50, 12, 28.50, 266.00, 'two hundred and sixty six rupees only ', '', '', 50.00, 216.00, 'two hundred and sixteen rupees only ', 'paid'),
(116, 43, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 50, 1187.50, 3562.50, 'three thousand five hundred and sixty two rupees and five  paisa only ', '', '', 500.00, 3062.50, 'three thousand and sixty two rupees and five  paisa only ', 'paid'),
(117, 43, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 50, 1187.50, 3562.50, 'three thousand five hundred and sixty two rupees and five  paisa only ', '', '', 500.00, 3062.50, 'three thousand and sixty two rupees and five  paisa only ', 'paid'),
(118, 44, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', 'jghjfgj', 'ghjgfj', 50.00, 2325.00, 'two thousand three hundred and twenty five rupees only ', 'paid'),
(119, 44, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', 'jghjfgj', 'ghjgfj', 50.00, 2325.00, 'two thousand three hundred and twenty five rupees only ', 'paid'),
(120, 45, '2024-01-19', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 12, 285.00, 2660.00, 'two thousand six hundred and sixty rupees only ', '', '', 500.00, 2160.00, 'two thousand one hundred and sixty rupees only ', 'paid'),
(121, 46, '2024-01-13', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', 'dfgddf', 'dfgdfg', 786.00, 1589.00, 'one thousand five hundred and eighty nine rupees only ', 'paid'),
(122, 47, '2024-01-13', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 18, 427.50, 2802.50, 'two thousand eight hundred and two rupees and five  paisa only ', 'sfsdssg', 'fgdgfd', 500.00, 2302.50, 'two thousand three hundred and two rupees and five  paisa only ', 'pending'),
(123, 48, '2024-01-11', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', '37AN89852SADSA', 2375.00, 5, 118.75, 2493.75, 'two thousand four hundred and ninety three rupees and seventy five  paisa only ', 'fddfhgfhfdhfdgg', 'fghdfgf', 500.00, 1993.75, 'one thousand nine hundred and ninety three rupees and seventy five  paisa only ', 'pending'),
(124, 49, '2024-01-17', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', 'EWQRWEREW', 2375.00, 12, 285.00, 2660.00, 'two thousand six hundred and sixty rupees only ', '', '', 1250.00, 1410.00, 'one thousand four hundred and ten rupees only ', 'pending'),
(125, 50, '2024-01-11', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', '37AN89852SADSA', 2375.00, 5, 118.75, 2493.75, 'two thousand four hundred and ninety three rupees and seventy five  paisa only ', 'fddfhgfhfdhfdgg', 'fghdfgf', 500.00, 1993.75, 'one thousand nine hundred and ninety three rupees and seventy five  paisa only ', ' '),
(126, 51, '2024-01-23', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 1487.50, 0, 0.00, 1487.50, 'one thousand four hundred and eighty seven rupees and five  paisa only ', '', '', 0.00, 1487.50, 'one thousand four hundred and eighty seven rupees and five  paisa only ', 'pending'),
(127, 52, '2024-01-11', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', '37AN89852SADSA', 2375.00, 5, 118.75, 2493.75, 'two thousand four hundred and ninety three rupees and seventy five  paisa only ', 'fddfhgfhfdhfdgg', 'fghdfgf', 500.00, 1993.75, 'one thousand nine hundred and ninety three rupees and seventy five  paisa only ', ' '),
(128, 53, '1970-01-01', '', '', '', '', '', '', 950.00, 18, 171.00, 1121.00, 'one thousand one hundred and twenty one rupees only ', 'dbfbfdb', 'dbfbfdfdb', 200.00, 921.00, 'nine hundred and twenty one rupees only ', 'paid'),
(129, 54, '1970-01-01', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 0, 0.00, 2375.00, 'two thousand three hundred and seventy five rupees only ', 'dgdsg', 'dfgfdg', 50.00, 2325.00, 'two thousand three hundred and twenty five rupees only ', 'paid'),
(130, 55, '2024-01-11', 'smart physiocare', 'pawan', '7730000000000', 'apsp', 'phanichalikonda@gmail.com', '2245452JNDKLWSAFC', 2375.00, 12, 285.00, 2660.00, 'two thousand six hundred and sixty rupees only ', 'dgdsg', 'dfgfdg', 50.00, 2610.00, 'two thousand six hundred and ten rupees only ', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `lgtable`
--

CREATE TABLE `lgtable` (
  `Id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lgtable`
--

INSERT INTO `lgtable` (`Id`, `email`, `password`) VALUES
(1, 'rajkumar16371@gmail.com', '6e46595a57e6d7219340d2c163273ab9'),
(3, 'bhavicreations', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `Sid` int(11) NOT NULL,
  `quotation_no` int(11) NOT NULL,
  `quotation_date` date NOT NULL,
  `Company_name` varchar(150) NOT NULL,
  `Cname` varchar(50) NOT NULL,
  `Cphone` varchar(150) NOT NULL,
  `Caddress` text NOT NULL,
  `Cmail` varchar(150) NOT NULL,
  `Cgst` varchar(150) NOT NULL,
  `Final` double(10,2) NOT NULL,
  `Gst` int(20) NOT NULL,
  `Gst_total` double(10,2) NOT NULL,
  `Grandtotal` double(10,2) NOT NULL,
  `Totalinwords` text NOT NULL,
  `Terms` text NOT NULL,
  `Note` text NOT NULL,
  `advance` double(10,2) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `balancewords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`Sid`, `quotation_no`, `quotation_date`, `Company_name`, `Cname`, `Cphone`, `Caddress`, `Cmail`, `Cgst`, `Final`, `Gst`, `Gst_total`, `Grandtotal`, `Totalinwords`, `Terms`, `Note`, `advance`, `balance`, `balancewords`) VALUES
(2, 1, '2024-01-11', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'KKD', 'ram@gmail.com', '37AN89852SADSA', 2375.00, 5, 118.75, 2493.75, 'two thousand four hundred and ninety three rupees and seventy five  paisa only ', 'fddfhgfhfdhfdgg', 'fghdfgf', 500.00, 1993.75, 'one thousand nine hundred and ninety three rupees and seventy five  paisa only '),
(4, 2, '2024-01-13', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 237.50, 5, 11.88, 249.38, 'two hundred and forty nine rupees and thirty eight  paisa only ', '', '', 100.00, 149.38, 'one hundred and forty nine rupees and thirty eight  paisa only '),
(5, 3, '2024-01-13', 'abhinaya', 'raj', '07498188555', '5-155 ysr colony madhavapatnam eg dist kakinada ap india 533005', 'raj@gmail.com', '38GN58POMVD', 985.50, 12, 118.26, 1103.76, 'one thousand one hundred and three rupees and seventy six  paisa only ', 'bfdbhfdxh', 'fghdfhghgf', 500.00, 603.76, 'six hundred and three rupees and seventy six  paisa only '),
(6, 4, '2024-01-25', 'Bhavi Creations', 'Rajkumar Giduthuri', '09848012555', 'hyd', 'ram@gmail.com', 'EWQRWEREW', 237.50, 0, 0.00, 237.50, 'two hundred and thirty seven rupees and five  paisa only ', '', '', 100.00, 137.50, 'one hundred and thirty seven rupees and five  paisa only ');

-- --------------------------------------------------------

--
-- Table structure for table `quservice`
--

CREATE TABLE `quservice` (
  `Id` int(11) NOT NULL,
  `Sid` int(11) NOT NULL,
  `Sname` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` double(10,2) NOT NULL,
  `Totalprice` double(10,2) NOT NULL,
  `Discount` int(20) NOT NULL,
  `Finaltotal` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quservice`
--

INSERT INTO `quservice` (`Id`, `Sid`, `Sname`, `Description`, `Qty`, `Price`, `Totalprice`, `Discount`, `Finaltotal`) VALUES
(1, 1, 'Google My Business', 'dfgdsfg', 2, 50.00, 100.00, 5, 95),
(2, 1, 'Log-Design', 'fdgfdg', 5, 50.00, 250.00, 5, 238),
(3, 2, 'Website', 'dfgdfg', 50, 50.00, 2500.00, 5, 2375),
(4, 3, 'Social Media Management', 'dgdsfg', 50, 50.00, 2500.00, 8, 2300),
(5, 4, 'Log-Design', '', 50, 5.00, 250.00, 5, 238),
(6, 5, 'Log-Design', 'dhffghfg', 50, 5.00, 250.00, 5, 238),
(7, 5, 'SEO', 'hgfhgf', 80, 5.00, 400.00, 5, 380),
(8, 5, 'Letter Heads', 'dhfhdghgfh', 80, 5.00, 400.00, 8, 368),
(9, 6, 'Google My Business', '', 50, 5.00, 250.00, 5, 238);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `Id` int(11) NOT NULL,
  `Sid` int(11) NOT NULL,
  `Sname` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` double(10,2) NOT NULL,
  `Totalprice` double(10,2) NOT NULL,
  `Discount` int(20) NOT NULL,
  `Finaltotal` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`Id`, `Sid`, `Sname`, `Description`, `Qty`, `Price`, `Totalprice`, `Discount`, `Finaltotal`) VALUES
(1, 1, 'Printing', '', 5, 10.00, 50.00, 5, 48),
(2, 2, 'Log-Design', '', 2, 10.00, 200.00, 5, 48),
(3, 2, 'Image Designing', '', 5, 20.00, 100.00, 2, 98),
(4, 3, 'Log-Design', '', 2, 10.00, 200.00, 5, 48),
(5, 4, 'Log-Design', '', 2, 10.00, 200.00, 5, 48),
(6, 5, 'Log-Design', '', 2, 10.00, 200.00, 5, 48),
(7, 6, 'Log-Design', 'hfghgfh', 2, 10.00, 200.00, 5, 48),
(8, 6, 'Log-Design', 'fdhgfdfh', 5, 20.00, 100.00, 2, 98),
(9, 7, 'Log-Design', 'fgjjngfjhngfjhgfhjgggggggggggggggggggggggfhgj', 5, 20.00, 100.00, 5, 95),
(10, 7, 'Social Media Management', 'dsgfdgdrfxhgfdhgfjhgfjhhgjytghhgjjhggggggggggggggggggggggggggggghj', 5, 20.00, 100.00, 3, 97),
(11, 7, 'Log-Design', '', 1, 565.00, 444.00, 959, 44),
(12, 7, 'Log-Design', '', 1, 565.00, 444.00, 959, 44),
(13, 8, 'Image Designing', 'hgjhgjhgj', 2, 20.00, 40.00, 5, 38),
(14, 9, 'Video Creation', '', 2, 20.00, 40.00, 5, 38),
(15, 10, 'Video Creation', '', 2, 20.00, 40.00, 5, 38),
(16, 11, 'Video Creation', '', 2, 20.00, 40.00, 5, 38),
(17, 12, 'Log-Design', '', 2, 20.00, 40.00, 5, 38),
(18, 13, 'Log-Design', '', 2, 20.00, 40.00, 5, 38),
(19, 14, 'Letter Heads', 'jhgbcfcdjhggj', 2, 20.00, 40.00, 5, 38),
(20, 14, 'Pamphlet', 'fjhghfjytgjytfj', 2, 50.00, 100.00, 5, 95),
(21, 15, 'Letter Heads', 'jhgbcfcdjhggj', 2, 20.00, 40.00, 5, 38),
(22, 15, 'Pamphlet', 'fjhghfjytgjytfj', 2, 50.00, 100.00, 5, 95),
(23, 16, 'Log-Design', 'fdhxhbfgh', 2, 20.00, 40.00, 5, 38),
(24, 17, 'Image Designing', 'gdfgd', 2, 20.00, 40.00, 5, 38),
(25, 18, 'physiotherapy report', '10 days unadu', 10, 5000.00, 50000.00, 10, 45000),
(26, 19, 'Website', 'i need good pics', 2, 10.00, 20.00, 5, 19),
(27, 20, 'Google My Business', '', 2, 50.00, 100.00, 5, 95),
(28, 21, 'Log-Design', '', 2, 50.00, 100.00, 5, 95),
(29, 21, 'Visiting Cards', '', 5, 20.00, 100.00, 1, 99),
(30, 21, 'Visiting Cards', '', 8, 50.00, 400.00, 5, 380),
(31, 21, 'Letter Heads', '', 5, 20.00, 100.00, 5, 95),
(32, 21, 'Visiting Cards', '', 8, 50.00, 400.00, 5, 380),
(33, 21, 'Flex', '', 8, 50.00, 400.00, 0, 400),
(34, 21, 'Pamphlet', '', 20, 8.00, 160.00, 0, 160),
(35, 21, 'Printing', '', 80, 9.00, 720.00, 0, 720),
(36, 21, 'Visiting Cards', '', 8, 1.00, 8.00, 2, 8),
(37, 21, 'Social Media Management', '', 8, 64.00, 512.00, 2, 502),
(38, 22, 'Log-Design', '', 2, 50.00, 100.00, 5, 95),
(39, 22, 'Visiting Cards', '', 5, 20.00, 100.00, 1, 99),
(40, 22, 'Visiting Cards', '', 8, 50.00, 400.00, 5, 380),
(41, 22, 'Letter Heads', '', 5, 20.00, 100.00, 5, 95),
(42, 22, 'Visiting Cards', '', 8, 50.00, 400.00, 5, 380),
(43, 22, 'Flex', '', 8, 50.00, 400.00, 0, 400),
(44, 22, 'Pamphlet', '', 20, 8.00, 160.00, 0, 160),
(45, 22, 'Printing', '', 80, 9.00, 720.00, 0, 720),
(46, 22, 'Visiting Cards', '', 8, 1.00, 8.00, 2, 8),
(47, 22, 'Social Media Management', '', 8, 64.00, 512.00, 2, 502),
(48, 23, 'Log-Design', '', 2, 50.00, 100.00, 5, 95),
(49, 23, 'Log-Design', '', 5, 20.00, 100.00, 1, 99),
(50, 23, 'Log-Design', '', 8, 50.00, 400.00, 5, 380),
(51, 23, 'Log-Design', '', 5, 20.00, 100.00, 5, 95),
(52, 23, 'Log-Design', '', 8, 50.00, 400.00, 5, 380),
(53, 23, 'Log-Design', '', 8, 50.00, 400.00, 0, 400),
(54, 23, 'Log-Design', '', 20, 8.00, 160.00, 0, 160),
(55, 23, 'Log-Design', '', 80, 9.00, 720.00, 0, 720),
(56, 23, 'Log-Design', '', 8, 1.00, 8.00, 2, 8),
(57, 23, 'Log-Design', '', 8, 50.00, 400.00, 2, 392),
(58, 23, 'Log-Design', '', 2, 10.00, 20.00, 2, 20),
(59, 23, 'Log-Design', '', 5, 10.00, 50.00, 2, 49),
(60, 23, 'Log-Design', '', 5, 10.00, 50.00, 5, 48),
(61, 23, 'Log-Design', '', 2, 20.00, 40.00, 5, 38),
(62, 23, 'Log-Design', '', 1, 10.00, 10.00, 5, 10),
(63, 23, 'Log-Design', '', 1, 5000.00, 5000.00, 8, 4600),
(64, 23, 'Log-Design', '', 1, 5000.00, 5000.00, 5, 4750),
(65, 23, 'Log-Design', '', 10, 5000.00, 50000.00, 8, 46000),
(66, 23, 'Log-Design', '', 2, 10.00, 20.00, 5, 19),
(67, 23, 'Log-Design', '', 10, 10.00, 100.00, 9, 91),
(68, 23, 'Log-Design', '', 1, 50.00, 50.00, 4, 48),
(69, 23, 'Log-Design', '', 10, 50.00, 500.00, 2, 490),
(70, 24, 'Log-Design', '', 2, 20.00, 40.00, 5, 38),
(71, 25, 'Log-Design', 'dsfewsfdfgdsfgdsgd', 2, 20.00, 40.00, 5, 38),
(72, 26, 'Log-Design', 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrtttttttttttttttrtuytiuytkm,jhmherghreirhgfierfgejbdsjhewuyefguyerbevfvyyeguer', 23, 22.00, 506.00, 3, 491),
(73, 26, 'Visiting Cards', 'dfvrgbthnyu', 22, 22.00, 484.00, 3, 469),
(74, 26, 'Calenders', 'trgtrhtytjhytjhtjytj', 22, 22.00, 484.00, 2, 474),
(75, 27, 'Log-Design', 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 23, 22.00, 506.00, 3, 491),
(76, 27, 'Visiting Cards', 'dfvrgbthnyu', 22, 22.00, 484.00, 3, 469),
(77, 27, 'Calenders', 'trgtrhtytjhytjhtjytj', 22, 22.00, 484.00, 2, 474),
(78, 28, 'Log-Design', 'fdsdffffffffffffffffffffffffhfgrdtrhtryrhtrhghbnhtyyyyyyyyyyyyyyyyyyyyyyyyytrhtyyyyyyyyyyyhhhhhhhhhhhhhrtythjhytytytytyt', 2, 50.00, 100.00, 5, 95),
(79, 29, 'Log-Design', 'i need good logo with 1515*20', 45, 5000.00, 225000.00, 5, 213750),
(80, 30, 'Log-Design', 'i need good logo with 1515*20', 45, 5000.00, 225000.00, 5, 213750),
(81, 31, 'Log-Design', 'dffgggdsdsdsdsdsdsgfdggggggf', 50, 100.00, 5000.00, 5, 4750),
(82, 32, 'Log-Design', 'ggggggggggggggggggggggggggggggggggg', 4, 40.00, 160.00, 11, 142),
(83, 33, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375),
(84, 34, 'Log-Design', '', 50, 80.00, 4000.00, 5, 3800),
(85, 34, 'Log-Design', '', 80, 800.00, 64000.00, 9, 58240),
(86, 35, 'Log-Design', 'lhluidffh h', 50, 50.00, 2500.00, 5, 2375),
(87, 35, 'Log-Design', 'fghfh fgjh ', 58, 80.00, 4640.00, 8, 4269),
(88, 35, 'Log-Design', 'fdgd hfg dfg', 80, 90.00, 7200.00, 6, 6768),
(211, 107, 'Log-Design', '', 50, 5.00, 250.00, 5, 238),
(212, 109, 'Website', 'safsaf', 50, 50.00, 2500.00, 5, 2375),
(213, 111, 'Log-Design', 'jfgfg', 50, 50.00, 2500.00, 5, 2375),
(214, 113, 'Log-Design', '', 2, 50.00, 100.00, 50, 50),
(215, 115, 'Google My Business', 'jghjhg', 50, 5.00, 250.00, 5, 238),
(216, 117, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375),
(217, 119, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375),
(218, 120, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375),
(219, 4, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375),
(220, 122, 'Log-Design', 'dsgdsf', 50, 50.00, 2500.00, 5, 2375),
(221, 123, 'Website', 'dfgdfg', 50, 50.00, 2500.00, 5, 2375),
(222, 124, 'Log-Design', '', 500, 5.00, 2500.00, 5, 2375),
(223, 125, 'Website', 'dfgdfg', 50, 50.00, 2500.00, 5, 2375),
(224, 126, 'Log-Design', 'fdgfd', 50, 50.00, 2500.00, 50, 1250),
(225, 126, 'Letter Heads', '', 5, 50.00, 250.00, 5, 238),
(226, 127, 'Website', 'dfgdfg', 50, 50.00, 2500.00, 5, 2375),
(227, 128, 'Log-Design', '', 20, 50.00, 1000.00, 5, 950),
(228, 129, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375),
(229, 130, 'Log-Design', '', 50, 50.00, 2500.00, 5, 2375);

-- --------------------------------------------------------

--
-- Table structure for table `service_names`
--

CREATE TABLE `service_names` (
  `si_No` int(11) NOT NULL,
  `service_Name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_names`
--

INSERT INTO `service_names` (`si_No`, `service_Name`) VALUES
(1, 'Log-Design'),
(2, 'Google My Business'),
(3, 'Website'),
(4, 'Social Media Management'),
(5, 'Image Designing'),
(6, 'Video Creation'),
(7, 'Video Editing'),
(8, 'SEO'),
(9, 'Printing'),
(10, 'Visiting Cards'),
(11, 'Letter Heads'),
(12, 'Pamphlet'),
(13, 'Flex'),
(14, 'Brouchers'),
(15, 'Viny Stickers'),
(16, 'Calenders'),
(17, 'Diary'),
(21, 'Website');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `stock_name` text NOT NULL,
  `stock_desc` text NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `stock_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advancehistory`
--
ALTER TABLE `advancehistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `expenditure_desc_tbl`
--
ALTER TABLE `expenditure_desc_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure_tbl`
--
ALTER TABLE `expenditure_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_name`
--
ALTER TABLE `exp_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_type`
--
ALTER TABLE `exp_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst_no`
--
ALTER TABLE `gst_no`
  ADD PRIMARY KEY (`si_No`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Sid`);

--
-- Indexes for table `lgtable`
--
ALTER TABLE `lgtable`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`Sid`);

--
-- Indexes for table `quservice`
--
ALTER TABLE `quservice`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `service_names`
--
ALTER TABLE `service_names`
  ADD PRIMARY KEY (`si_No`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advancehistory`
--
ALTER TABLE `advancehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenditure_desc_tbl`
--
ALTER TABLE `expenditure_desc_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenditure_tbl`
--
ALTER TABLE `expenditure_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exp_name`
--
ALTER TABLE `exp_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exp_type`
--
ALTER TABLE `exp_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gst_no`
--
ALTER TABLE `gst_no`
  MODIFY `si_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `lgtable`
--
ALTER TABLE `lgtable`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `Sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quservice`
--
ALTER TABLE `quservice`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `service_names`
--
ALTER TABLE `service_names`
  MODIFY `si_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
