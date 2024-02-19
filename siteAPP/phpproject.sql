-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 10:03 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `product_id` varchar(40) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_description` longtext DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_category` varchar(25) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catalogue`
--

INSERT INTO `catalogue` (`product_id`, `product_name`, `product_description`, `product_price`, `product_category`, `product_quantity`, `product_image`) VALUES
('XPS_15_Laptop', 'XPS 15 Laptop', '12th Gen Intel i5 512GB internal 15\"', 1699, 'Laptop', 4, 'logo\\Laptop1.jpg'),
('XPS_17_Laptop', 'XPS 17 Laptop', '12th Gen Intel i5 512GB internal 15\"', 2049, 'Laptop', 3, 'logo\\Laptop2.jpg'),
('Alienware_m15_R7_Gaming_Laptop', 'Alienware m15 R7 Gaming Laptop', '12th Gen i7-12700H RTX 3060 16GB', 2199, 'Laptop', 0, 'logo\\Laptop3.jpg'),
('G15_Gaming', 'G15 Gaming Laptop', 'AMD Ryzen 7 Windows 11 RTX™ 3050 Ti, 4 GB GDDR6\n                                   FHD 1920x1080, 120Hz, Non-Touch, AG, WVA, LED-Backlit, 250 nit, Narrow Border\n                                   16 GB\n                                   512 GB', 1299, 'Laptop', 10, 'logo\\Laptop4.jpg'),
('XPS_Desktop', 'XPS Desktop', '12th i7-12700 \n                                   Windows 11 \n                                    RTX™ 3060 Ti\n                                   32 GB, 2 x 16 GB\n                                   1 TB,', 2649, 'Desktop', 8, 'logo\\Desktop1.jpg'),
('Inspiron_Desktop', 'Inspiron Desktop', '12th i7-12700 \n                                    Windows 11\n                                    8 GB\n                                    256 GB', 850, 'Desktop', 3, 'logo\\Desktop2.jpg'),
('GAMING_Desktop', 'ALIENWARE AURORA R13 GAMING DESKTOP', '12th i7-12700 \n                                    Windows 11\n                                    RTX 3060\n                                    16 GB\n                                    512 GB', 1999, 'Desktop', 2, 'logo\\Desktop3.jpg'),
('Inspiron_24', 'Inspiron 24 All-in-One', '12th i3-12700 \n                                    Windows 11\n                                    Intel Iris\n                                    8 GB\n                                    512 GB  23.8\"', 1449, 'Desktop', 4, 'logo\\Desktop4.jpg'),
('ALIENWARE_34', 'ALIENWARE 34 CURVED QD-OLED GAMING MONITOR\n                                    ', 'The world\'s first QD-OLED gaming monitor. Featuring infinite contrast ratio and VESA DisplayHDR TrueBlack 400 for remarkably vivid colors and visuals bursting to life.', 1649, 'Monitor', 4, 'logo\\Monitor1.jpg'),
('Dell_24', 'Dell 24 Monitor', 'Enjoy the view on this 23.8\" slim-bezel Full HD display featuring AMD FreeSync™, 75Hz refresh rate, and a fixed stand.', 179, 'Monitor', 0, 'logo\\Monitor2.jpg'),
('Dell_27', 'Dell 27 Monitor', 'Enjoy the view on this 27\" slim-bezel Full HD display featuring AMD FreeSync™, 75Hz refresh rate, and a fixed stand.', 209.99, 'Monitor', 7, 'logo\\Monitor3.jpg'),
('Dell_274k', 'Dell 27 4K UHD Monitor', '27\" lifestyle-inspired 4K UHD monitor that supports HDR content playback for an amazing entertainment experience.', 429, 'Monitor', 8, 'logo\\Monitor4.jpg'),
('Logitech_G502', 'Logitech G502 Wireless Mouse', 'G502 is the best gaming mouse from Logitech G, completely redesigned from the inside out with LIGHTSPEED wireless and POWERPLAY compatibility so you can game faster and more accurately, The G502 LIGHTSPEED pc gaming mouse is built with superfast 1 ms wireless connectivity and a next-gen HERO sensor delivering 16k DPI class-leading performance and energy efficiency - get up to 60 hours of uninterrupted gaming.', 199, 'Gaming', 8, 'logo\\Gaming1.jpg'),
('Dell_Stereo', 'Dell Stereo Soundbar ', 'Enjoy audio on your favorite games, music and movies without sacrificing desk space.', 34.99, 'Gaming', 0, 'logo\\Gaming2.jpg'),
('Cloth_Gaming', 'Logitech G640 Cloth Mousepad', 'When you use low-DPI settings you benefit from moderate resistance to the mouse feet when starting or stopping a rapid or sudden movement common to low DPI gaming.', 59.99, 'Gaming', 7, 'logo\\Gaming3.jpg'),
('G613_Keyboard', 'Logitech G613 Wireless Mechanical Gaming Keyboard - Bluetooth', 'Meet the next generation wireless keyboard designed for gamers who demand the high performance of mechanical switches and the freedom of wireless gaming. ', 129, 'Gaming', 3, 'logo\\Gaming4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(64) DEFAULT NULL,
  `session_data` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `session_id` varchar(100) DEFAULT NULL,
  `product_id` varchar(40) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
