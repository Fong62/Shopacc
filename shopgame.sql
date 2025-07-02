-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 24, 2025 lúc 07:52 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopgame`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `groups` int(11) DEFAULT NULL,
  `account` text DEFAULT NULL,
  `chitiet` text DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `fivestar` int(11) DEFAULT NULL,
  `server` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `listimg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `groups`, `account`, `chitiet`, `createdate`, `updatedate`, `username`, `level`, `fivestar`, `server`, `img`, `money`, `status`, `listimg`) VALUES
(2, 10, 'user: 123456, pass: 123456', 'Account Genshin Impact', '2025-05-12 14:22:05', '2025-05-12 14:22:05', NULL, '60', 10, 'Asia', 'https://i.imgur.com/aDXIISA.png', 500000, 'Chưa bán', 'https://i.imgur.com/aDXIISA.png'),
(3, 5, 'user: 123456789, pass: 123456789', 'Account Wuthering Waves', '2025-05-12 14:23:26', '2025-05-19 23:34:14', NULL, '38', 10, 'SEA', 'https://i.imgur.com/4fFgUkm.png', 1000000, 'Chưa bán', 'https://i.imgur.com/4fFgUkm.png, https://i.imgur.com/4fFgUkm.png'),
(5, 5, 'user: 123123, pass: 123123', 'Account Wuthering Waves', '2025-05-13 09:58:14', '2025-05-20 22:29:35', NULL, '80', 15, 'SEA', 'https://i.imgur.com/1dgEwSv.png', 100000, 'Chưa bán', ''),
(6, 6, 'user:123456, pass:123456', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 07:01:18', 'fongbeo', '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Đã bán', ''),
(7, 6, 'user:123457, pass:123457', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-24 12:01:43', 'fongbeo', '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 200000, 'Đã bán', 'https://i.imgur.com/1dgEwSv.png, https://i.imgur.com/1dgEwSv.png'),
(8, 6, 'user: 123458, pass: 123458', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(9, 6, 'user: 123459, pass: 123459', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(10, 6, 'user: 123460, pass: 123460', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(11, 6, 'user: 123461, pass: 123461', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(12, 6, 'user: 123462, pass: 123462', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(13, 6, 'user: 123463, pass: 123463', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(14, 6, 'user: 123464, pass: 123464', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(15, 6, 'user: 123465, pass: 123465', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(16, 6, 'user: 123466, pass: 123466', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(17, 6, 'user: 123467, pass: 123467', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(18, 6, 'user: 123468, pass: 123468', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(19, 6, 'user: 123469, pass: 123469', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(20, 6, 'user: 123470, pass: 123470', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(21, 6, 'user: 123471, pass: 123471', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(22, 6, 'user: 123472, pass: 123472', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(23, 6, 'user: 123473, pass: 123473', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(24, 6, 'user: 123474, pass: 123474', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(25, 6, 'user: 123475, pass: 123475', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(26, 6, 'user: 123476, pass: 123476', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(27, 6, 'user: 123477, pass: 123477', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(28, 6, 'user: 123478, pass: 123478', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(29, 6, 'user: 123479, pass: 123479', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(30, 6, 'user: 123480, pass: 123480', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(31, 6, 'user: 123481, pass: 123481', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(32, 6, 'user: 123482, pass: 123482', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(33, 6, 'user: 123483, pass: 123483', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(34, 6, 'user: 123484, pass: 123484', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(35, 6, 'user: 123485, pass: 123485', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(36, 6, 'user: 123486, pass: 123486', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(37, 6, 'user: 123487, pass: 123487', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(38, 6, 'user: 123488, pass: 123488', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(39, 6, 'user: 123489, pass: 123489', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(40, 6, 'user: 123490, pass: 123490', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(41, 6, 'user: 123491, pass: 123491', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(42, 6, 'user: 123492, pass: 123492', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(43, 6, 'user: 123493, pass: 123493', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(44, 6, 'user: 123494, pass: 123494', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(45, 6, 'user: 123495, pass: 123495', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(46, 6, 'user: 123496, pass: 123496', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(47, 6, 'user: 123497, pass: 123497', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(48, 6, 'user: 123498, pass: 123498', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(49, 6, 'user: 123499, pass: 123499', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(50, 6, 'user: 123500, pass: 123500', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(51, 6, 'user: 123501, pass: 123501', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(52, 6, 'user: 123502, pass: 123502', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(53, 6, 'user: 123503, pass: 123503', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(54, 6, 'user: 123504, pass: 123504', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(55, 6, 'user: 123505, pass: 123505', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(56, 6, 'user: 123506, pass: 123506', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(57, 6, 'user: 123507, pass: 123507', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(58, 6, 'user: 123508, pass: 123508', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(59, 6, 'user: 123509, pass: 123509', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(60, 6, 'user: 123510, pass: 123510', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(61, 6, 'user: 123511, pass: 123511', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(62, 6, 'user: 123512, pass: 123512', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(63, 6, 'user: 123513, pass: 123513', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(64, 6, 'user: 123514, pass: 123514', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(65, 6, 'user: 123515, pass: 123515', '[SEA] UL38 ~34k Astrie + ~20 Vàng + ~61 Xanh (zin nạp x2)', '2025-05-21 03:58:26', '2025-05-21 03:58:26', NULL, '38', 1, 'SEA', '/assets/img/RerollWuwa.jpg', 100000, 'Chưa bán', ''),
(66, 6, 'user: 123456789, pass: 123456789', 'Acc level 80', '2025-05-24 11:52:14', '2025-05-24 11:53:12', 'fongbeo', '80', 15, 'SEA', 'https://i.imgur.com/1dgEwSv.png', 500000, 'Đã bán', 'https://i.imgur.com/1dgEwSv.png, https://i.imgur.com/1dgEwSv.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `stk` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `chi_nhanh` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `loaithe` varchar(32) NOT NULL,
  `menhgia` int(11) NOT NULL,
  `thucnhan` int(11) DEFAULT 0,
  `seri` text DEFAULT NULL,
  `pin` text DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `status` varchar(32) NOT NULL,
  `note` text DEFAULT NULL,
  `deletedate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cards`
--

INSERT INTO `cards` (`id`, `code`, `username`, `loaithe`, `menhgia`, `thucnhan`, `seri`, `pin`, `createdate`, `status`, `note`, `deletedate`) VALUES
(1, '', 'fongbeo', 'VIETTEL', 500000, 500000, '123456789', '123456789', '2025-05-12 14:08:18', 'hoanthanh', '', NULL),
(2, '', 'huybeo', 'VIETTEL', 500000, 500000, '123456789', '123456789', '2025-05-12 14:13:43', 'hoanthanh', '', NULL),
(3, '', 'ngoc1', 'VIETTEL', 1000000, 1000000, '123456789', '123456789', '2025-05-12 18:28:17', 'hoanthanh', '', NULL),
(4, '', 'fongbeo', 'VIETTEL', 500000, 500000, '123123', '123123', '2025-05-13 08:11:09', 'hoanthanh', '', NULL),
(5, '', 'fongbeo', 'VIETTEL', 200000, 200000, '123123', '123123', '2025-05-13 09:54:47', 'hoanthanh', '', NULL),
(6, '', 'fongbeo', 'VIETTEL', 1000000, 1000000, '123456789', '123456789', '2025-05-21 00:09:25', 'hoanthanh', 'Hủy bởi admin: fongbeo - 2025/05/21 00:18:24', NULL),
(10, '', 'fongbeo', 'MOBIFONE', 200000, 200000, '123123123', '123123123', '2025-05-21 07:00:14', 'hoanthanh', '', NULL),
(11, '', 'fongbeo', 'MOBIFONE', 500000, 500000, '1234567890', '1234567890', '2025-05-24 10:39:34', 'hoanthanh', '', NULL),
(12, '', 'fongbeo', 'MOBIFONE', 500000, 500000, '0123456789', '0123456789', '2025-05-24 10:47:34', 'hoanthanh', '', NULL),
(16, '', 'hao123', 'MOBIFONE', 500000, 500000, '0123456789', '0123456789', '2025-05-24 11:27:03', 'hoanthanh', '', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `display` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `title`, `display`, `img`) VALUES
(1, 'SHOP ACC GAME', 'SHOW', '/assets/img/contentweb/2020031919242255224.png'),
(2, 'WUTHERING WAVES', 'SHOW', '/assets/img/contentweb/2020031921140936446.png'),
(3, 'ZENLESS ZONE ZERO', 'SHOW', '/assets/img/contentweb/2020031921140936446.png'),
(4, 'GENSHIN IMPACT', 'SHOW', '/assets/img/contentweb/2020031921140936446.png'),
(5, 'HONKAI STAR RAIL', 'SHOW', '/assets/img/contentweb/2020031921140936446.png'),
(6, 'DỊCH VỤ NẠP GAME', 'SHOW', '/assets/img/contentweb/2021071716211547763.png'),
(16, 'LIÊN QUÂN', 'HIDE', '/assets/img/contentweb/2020031921140936446.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
--

CREATE TABLE `dongtien` (
  `id` int(11) NOT NULL,
  `sotientruoc` int(11) DEFAULT NULL,
  `sotienthaydoi` int(11) DEFAULT NULL,
  `sotiensau` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `noidung` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dongtien`
--

INSERT INTO `dongtien` (`id`, `sotientruoc`, `sotienthaydoi`, `sotiensau`, `thoigian`, `noidung`, `username`) VALUES
(1, 0, 500000, 500000, '2025-05-12 14:08:33', 'Nạp tiền thẻ cào seri (123456789)', 'fongbeo'),
(2, 0, 500000, 500000, '2025-05-12 14:13:53', 'Nạp tiền thẻ cào seri (123456789)', 'huybeo'),
(3, 0, 1000000, 1000000, '2025-05-12 18:30:27', 'Nạp tiền thẻ cào seri (123456789)', 'ngoc1'),
(4, 500000, 500000, 1000000, '2025-05-13 08:12:58', 'Nạp tiền thẻ cào seri (123123)', 'fongbeo'),
(5, 1000000, 200000, 1200000, '2025-05-13 09:55:03', 'Nạp tiền thẻ cào seri (123123)', 'fongbeo'),
(17, 1200000, -100000, 1100000, '2025-05-20 23:07:07', 'Mua tài khoản #6', 'fongbeo'),
(20, 1200000, -200000, 1000000, '2025-05-20 23:41:30', 'Thanh toán đơn nạp game #1', 'fongbeo'),
(21, 700000, 200000, 900000, '2025-05-20 23:41:30', 'Nhận tiền từ đơn nạp game #1', 'huybeo'),
(22, 1000000, 1000000, 2000000, '2025-05-21 00:22:00', 'Nạp tiền thẻ cào seri (123456789)', 'fongbeo'),
(25, 2000000, -100000, 1900000, '2025-05-21 00:23:37', 'Mua tài khoản #6', 'fongbeo'),
(26, 700000, 100000, 800000, '2025-05-21 00:23:37', 'Nhận tiền từ mua tài khoản #6', 'huybeo'),
(27, 1900000, 50000, 1950000, '2025-05-21 01:10:52', 'Nạp tiền momo (Admin: fongbeo)', 'fongbeo'),
(28, 1950000, 500000, 2450000, '2025-05-21 01:43:12', 'Nạp tiền momo (Admin: fongbeo)', 'fongbeo'),
(29, 2450000, -115000, 2335000, '2025-05-21 01:54:56', 'Thanh toán đơn nạp game #5', 'fongbeo'),
(30, 915000, 115000, 1030000, '2025-05-21 01:54:56', 'Nhận tiền từ đơn nạp game #5', 'huybeo'),
(31, 2335000, 200000, 2535000, '2025-05-21 07:00:28', 'Nạp tiền thẻ cào seri (123123123)', 'fongbeo'),
(32, 2535000, 500000, 3035000, '2025-05-24 10:39:52', 'Nạp tiền thẻ cào seri (1234567890)', 'fongbeo'),
(33, 3035000, 100000, 3135000, '2025-05-24 10:40:37', 'Cộng tiền chuyển khoản (Admin: fongbeo)', 'fongbeo'),
(34, 3135000, 500000, 3635000, '2025-05-24 10:47:54', 'Nạp tiền thẻ cào seri (0123456789)', 'fongbeo'),
(35, 3635000, 100000, 3735000, '2025-05-24 10:48:43', 'Cộng tiền chuyển khoản (Admin: fongbeo)', 'fongbeo'),
(39, 0, 500000, 500000, '2025-05-24 11:28:30', 'Nạp tiền thẻ cào seri (0123456789)', 'hao123'),
(40, 3735000, -500000, 3235000, '2025-05-24 11:53:12', 'Mua tài khoản #66', 'fongbeo'),
(41, 915000, 500000, 1415000, '2025-05-24 11:53:12', 'Nhận tiền từ mua tài khoản #66', 'huybeo'),
(42, 3235000, -115000, 3120000, '2025-05-24 11:58:33', 'Thanh toán đơn nạp game #6', 'fongbeo'),
(43, 1530000, 115000, 1645000, '2025-05-24 11:58:33', 'Nhận tiền từ đơn nạp game #6', 'huybeo'),
(44, 3120000, -200000, 2920000, '2025-05-24 12:01:43', 'Mua tài khoản #7', 'fongbeo'),
(45, 1530000, 200000, 1730000, '2025-05-24 12:01:43', 'Nhận tiền từ mua tài khoản #7', 'huybeo'),
(50, 500000, 500000, 1000000, '2025-05-24 12:29:32', 'Cộng tiền chuyển khoản (Admin: fongbeo)', 'hao123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `display` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `chitiet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `category`, `title`, `display`, `img`, `chitiet`) VALUES
(1, 1, 'Acc Genshin Impact', 'SHOW', '/assets/img/shop/file/73/images/2024-07-30/genshin-qD.webp', 'Danh mục tài khoản Genshin Impact'),
(2, 1, 'Acc Zenless Zone Zero', 'SHOW', '/assets/img/shop/file/73/images/2024-07-30/zzz-NK.webp', 'Danh mục tài khoản ZZZ'),
(3, 1, 'Acc Honkai Star Rail', 'SHOW', '/assets/img/shop/file/73/images/2024-07-30/sr-U0.webp', 'Danh mục tài khoản HSR'),
(4, 1, 'Acc Wuthering Waves', 'SHOW', '/assets/img/shop/file/73/images/2024-07-30/ww-4R.webp', 'Danh mục tài khoản WW'),
(5, 2, 'Wuthering Waves Account', 'SHOW', '/assets/img/shop/file/73/WW VIP GIF.gif', 'Tài khoản VIP Wuthering Waves'),
(6, 2, 'Reroll Game Wuthering', 'SHOW', '/assets/img/shop/file/73/images/2024-10-25/IMG_20241025_214305-MA.webp', 'Tài khoản reroll WW'),
(7, 3, 'Acc Vip Zenless', 'SHOW', '/assets/img/shop/file/73/gif acc vip zzz.gif', 'Tài khoản VIP ZZZ'),
(8, 3, 'Acc Normal Zenless', 'SHOW', '/assets/img/shop/file/73/gif acc normal zzz (1).gif', 'Tài khoản thường ZZZ'),
(9, 3, 'Acc Reroll Zenless', 'SHOW', '/assets/img/shop/file/73/gif acc reroll zzz.gif', 'Tài khoản reroll ZZZ'),
(10, 4, 'Acc VIP Genshin', 'SHOW', '/assets/img/shop/file/73/GS VIP GIF.gif', 'Tài khoản VIP AR60'),
(11, 4, 'Acc Reroll Genshin', 'SHOW', '/assets/img/shop/file/73/GS REROLL GIF.gif', 'Tài khoản reroll 5*'),
(12, 4, 'Acc Random Genshin', 'SHOW', '/assets/img/shop/file/73/images/2024-02-28/RANDOM (1)-0N.png', 'Tài khoản ngẫu nhiên'),
(13, 5, 'Acc Vip Star Rail', 'SHOW', '/assets/img/shop/file/73/GIF-ACC-VIP-720p.gif', 'Tài khoản VIP HSR'),
(14, 5, 'Acc Khởi đầu Star Rail', 'SHOW', '/assets/img/shop/file/73/GIF ACC STARTER 720p.gif', 'Tài khoản starter HSR'),
(15, 5, 'Acc Reroll Star Rail', 'SHOW', '/assets/img/live/52954974470_9a463baec9_o.png', 'Tài khoản reroll HSR'),
(16, 6, 'NẠP ZZZ', 'SHOW', '/assets/img/imgur/OkMBCaB.jpeg', 'Dịch vụ nạp Moonstone ZZZ'),
(17, 6, 'Nạp Wutheringwave', 'SHOW', '/assets/img/shop/file/73/images/2024-06-14/z5537410205444_50cb5e6176987408ff9e29152b89594b-97.webp', 'Dịch vụ nạp Waveplates WW'),
(18, 6, 'Nạp Genshin Impact', 'SHOW', '/assets/img/live/52955242018_0e3c2c3304_o.png', 'Dịch vụ nạp Nguyên Thạch'),
(19, 6, 'Nạp Honkai : Star Rail', 'SHOW', '/assets/img/live/52955242013_8c9a6c27b5_o.png', 'Dịch vụ nạp Star Rail Pass'),
(35, 16, 'Acc Liên Quân', 'SHOW', 'https://i.imgur.com/3kf4KLN.jpeg', ''),
(37, 1, 'Acc Liên Quân', 'HIDE', 'https://i.imgur.com/3kf4KLN.jpeg', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups_napgame`
--

CREATE TABLE `groups_napgame` (
  `id` int(11) NOT NULL,
  `groups` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `display` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups_napgame`
--

INSERT INTO `groups_napgame` (`id`, `groups`, `title`, `display`, `money`) VALUES
(1, 16, 'Inter-Knot (Inter-Knot)', 'SHOW', 105000),
(2, 16, 'Inter-Knot (Inter-Knot)x2', 'SHOW', 210000),
(3, 16, 'Inter-Knot (Inter-Knot) x3', 'SHOW', 315000),
(4, 16, 'Kế hoạch Trưởng Thành', 'SHOW', 210000),
(5, 16, 'Inter-Knot + Kế hoạch Trưởng Thành', 'SHOW', 315000),
(6, 16, 'Kế hoạch Cao Cấp', 'SHOW', 420000),
(7, 16, 'Inter-Knot + Kế hoạch Cao Cấp', 'SHOW', 530000),
(8, 16, '300 Phim Trắng Đen', 'SHOW', 105000),
(9, 16, '980 Phim Trắng Đen', 'SHOW', 310000),
(10, 16, '1980 Phim Trắng Đen', 'SHOW', 620000),
(11, 16, '3280 Phim Trắng Đen', 'SHOW', 1000000),
(12, 16, '6480 Phim Trắng Đen', 'SHOW', 2000000),
(13, 16, 'Combo Full X2 (Không có gói 22k)', 'SHOW', 4030000),
(14, 16, '6480 Phim Trắng Đen x2', 'SHOW', 4000000),
(15, 16, '6480 Phim Trắng Đen x3', 'SHOW', 6000000),
(16, 16, 'Ridu Chào Đón', 'SHOW', 25000),
(17, 16, 'Lời Mời Chân Thành', 'SHOW', 105000),
(18, 16, 'Lời Mời Yêu Thích', 'SHOW', 210000),
(19, 16, 'Lời Mời Độc Quyền', 'SHOW', 315000),
(20, 17, 'Lunite X300 (5$)', 'SHOW', 115000),
(21, 17, 'Lunite Subscription (Thẻ Tháng)', 'SHOW', 115000),
(22, 17, 'Insider channel (BP 10$)', 'SHOW', 220000),
(23, 17, 'Vault Radiant Collection 1 (10$)', 'SHOW', 220000),
(24, 17, 'Vault Forgoing Collection (10$)', 'SHOW', 220000),
(25, 17, 'Lunite X980 (15$)', 'SHOW', 330000),
(26, 17, 'Connoisseur channel (BP 20$)', 'SHOW', 440000),
(27, 17, 'Vault Tide selection (20$)', 'SHOW', 440000),
(28, 17, 'Vault\'s Monthly Aid', 'SHOW', 450000),
(29, 17, 'Vault Radiant Collection 2', 'SHOW', 660000),
(30, 17, 'Lunite X1980 (30$)', 'SHOW', 660000),
(31, 17, 'Lunite X3280 (50$)', 'SHOW', 1100000),
(32, 17, 'Lunite X6480 (100$)', 'SHOW', 2100000),
(33, 17, 'Vailt Collection', 'SHOW', 66000),
(34, 17, 'Lunite Subscription (Thẻ Tháng)', 'SHOW', 115000),
(35, 18, 'Không nguyệt chúc phúc', 'SHOW', 100000),
(36, 18, 'Không nguyệt chúc phúc x2', 'SHOW', 200000),
(37, 18, 'Không nguyệt chúc phúc x3', 'SHOW', 300000),
(38, 18, 'Nhật ký hành trình', 'SHOW', 210000),
(39, 18, 'Không nguyệt + nhật ký', 'SHOW', 314000),
(40, 18, 'Bài ca chân châu', 'SHOW', 420000),
(41, 18, 'Không nguyệt + bài ca', 'SHOW', 530000),
(42, 18, '300 Đá sáng thế', 'SHOW', 105000),
(43, 18, '980 Đá sáng thế', 'SHOW', 310000),
(44, 18, '1980 Đá sáng thế', 'SHOW', 620000),
(45, 18, '3280 Đá sáng thế', 'SHOW', 1000000),
(46, 18, '6480 Đá sáng thế', 'SHOW', 2000000),
(47, 18, 'Combo Full X2 (Không có gói 22k)', 'SHOW', 4030000),
(48, 18, '6480 Đá sáng thế x2', 'SHOW', 4000000),
(49, 18, '6480 Đá sáng thế x3', 'SHOW', 6000000),
(50, 18, '6480 Đá sáng thế x4', 'SHOW', 8000000),
(51, 18, '6480 Đá sáng thế x5', 'SHOW', 10000000),
(52, 19, 'Chứng nhận tiếp tế đội tàu (Thẻ tháng)', 'SHOW', 100000),
(53, 19, 'Chứng nhận tiếp tế đội tàu (Thẻ tháng)x2', 'SHOW', 200000),
(54, 19, 'Chứng nhận tiếp tế đội tàu (Thẻ tháng) x3', 'SHOW', 300000),
(55, 19, 'Vinh Quang Khách Vô Danh (Battle pass)', 'SHOW', 210000),
(56, 19, 'Thẻ tháng + Battle pass', 'SHOW', 315000),
(57, 19, 'Huân chương khách vô danh (Battle pass cao cấp)', 'SHOW', 420000),
(58, 19, 'Thẻ tháng + Battle pass cao cấp', 'SHOW', 530000),
(59, 19, '300 mộng ước viễn cổ', 'SHOW', 105000),
(60, 19, '980 mộng ước viễn cổ', 'SHOW', 310000),
(61, 19, '1980 mộng ước viễn cổ', 'SHOW', 620000),
(62, 19, '3280 mộng ước viễn cổ', 'SHOW', 1000000),
(63, 19, '6480 mộng ước viễn cổ', 'SHOW', 2000000),
(64, 19, 'Combo Full X2 (Không có gói 22k)', 'SHOW', 4030000),
(65, 19, '6480 mộng ước viễn cổ x2', 'SHOW', 4000000),
(66, 19, '6480 mộng ước viễn cổ x3', 'SHOW', 6000000),
(67, 19, '6480 mộng ước viễn cổ x4', 'SHOW', 8000000),
(68, 19, '6480 mộng ước viễn cổ x5', 'SHOW', 10000000),
(70, 17, 'Nạp game: 15$', 'SHOW', 300000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `request_id` varchar(64) DEFAULT NULL,
  `tranId` text DEFAULT NULL,
  `partnerId` text DEFAULT NULL,
  `partnerName` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `status` varchar(32) DEFAULT 'xuly',
  `deletedate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'tenweb', 'The Boys'),
(2, 'mota', 'Website bán acc game giá rẻ uy tín chất lượng'),
(3, 'tukhoa', 'Shop Game'),
(4, 'youtube_embed', 'https://www.youtube.com/embed/4ZKgq7Aw34s?si=7j1JN-eE-FdHk0Zv'),
(5, 'hotline_zalo', '0587289023'),
(6, 'facebook_url', 'https://www.facebook.com/FongDaWind');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_account`
--

CREATE TABLE `order_account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `groups` int(11) NOT NULL,
  `account_username` varchar(255) DEFAULT NULL,
  `account_password` varchar(255) DEFAULT NULL,
  `money` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `chitiet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_account`
--

INSERT INTO `order_account` (`id`, `username`, `category`, `groups`, `account_username`, `account_password`, `money`, `status`, `created_at`, `chitiet`) VALUES
(13, 'fongbeo', 2, 6, 'user: 123456', ' pass: 123456', 100000, 'hoanthanh', '2025-05-21 00:23:37', 'Mua tài khoản #6'),
(14, 'fongbeo', 2, 6, 'user: 123456789', ' pass: 123456789', 500000, 'hoanthanh', '2025-05-24 11:53:12', 'Mua tài khoản #66'),
(15, 'fongbeo', 2, 6, 'user:123457', ' pass:123457', 200000, 'hoanthanh', '2025-05-24 12:01:43', 'Mua tài khoản #7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_napgame`
--

CREATE TABLE `order_napgame` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `groups` int(11) NOT NULL,
  `groups_napgame` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `login_username` varchar(255) NOT NULL,
  `login_password` varchar(255) NOT NULL,
  `server` varchar(255) DEFAULT NULL,
  `character_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_napgame`
--

INSERT INTO `order_napgame` (`id`, `username`, `groups`, `groups_napgame`, `uid`, `login_username`, `login_password`, `server`, `character_name`, `phone`, `quantity`, `money`, `note`, `status`, `created_at`) VALUES
(1, 'fongbeo', 16, 25, '123456789', 'wuthering_player', 'securepassword123', 'Asia', 'Rover', '0987654321', 1, 200000, 'zalo, fb', 'xuly', '2025-05-20 17:50:29'),
(2, 'fongbeo', 16, 25, '987654321', 'zzz_fan', 'anotherpassword456', 'Global', 'Belle', '0123456789', 1, 310000, 'zalo, fb', 'hoanthanh', '2025-05-20 17:50:29'),
(3, 'fongbeo', 18, 51, '12345678', '123456', '123456', 'SEA', 'Fong', '1234567890', 1, 10000000, 'fb', 'huy', '2025-05-20 15:03:56'),
(5, 'fongbeo', 17, 34, '12345678', '123456', '123456', 'SEA', 'Fong', '1234567890', 1, 115000, 'https://www.facebook.com/FongDaWind', 'hoanthanh', '2025-05-21 01:52:15'),
(6, 'fongbeo', 17, 34, '123456', '123456789', '123456789', 'SEA', 'Fong', '0938291641', 1, 115000, 'fb', 'hoanthanh', '2025-05-24 11:57:25'),
(7, 'fongbeo', 17, 70, '12345678', '123456', '123456', 'SEA', 'Fong', '0938291641', 2, 600000, 'zalo', 'huy', '2025-05-24 12:00:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT 0,
  `level` varchar(255) DEFAULT NULL,
  `banned` int(11) DEFAULT 0,
  `createdate` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `total_money` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `money`, `level`, `banned`, `createdate`, `email`, `total_money`) VALUES
(1, 'fongbeo', 'e10adc3949ba59abbe56e057f20f883e', 'kTengSWwqxrlVHBtoPsGJhjOvfypCYbiZdcNDUMEKXFLuAzQIamR', 2920000, 'admin', 0, '2025-05-12 14:05:03', 'NULL', 4150000),
(2, 'huybeo', 'e10adc3949ba59abbe56e057f20f883e', 'sLJYKTjCwVrgzeEdyPvZXBlfRDbUkaFMcShNqGAIQuoWOminxtHp', 1730000, 'admin', 0, '2025-05-12 14:05:15', 'NULL', 1730000),
(3, 'ngoc1', 'e10adc3949ba59abbe56e057f20f883e', 'DWoZyCIUhjSwRAFEgfNalKOQGsdpLYqJexBtMrPXkVTbnHmiucvz', 1000000, NULL, 0, '2025-05-12 18:25:02', NULL, 1000000),
(9, 'hao123', 'e10adc3949ba59abbe56e057f20f883e', 'HnaeOZyGixvYtUoECPKQkSbXqTNgIAWJuzdFjRMmchfVLwplBDrs', 1000000, NULL, 1, '2025-05-24 11:26:06', '123@gmail.com', 1000000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_accounts_users` (`username`),
  ADD KEY `fk_accounts_groups` (`groups`);

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cards_users` (`username`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dongtien_users` (`username`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_groups_category` (`category`);

--
-- Chỉ mục cho bảng `groups_napgame`
--
ALTER TABLE `groups_napgame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_groups_napgame_groups` (`groups`);

--
-- Chỉ mục cho bảng `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_momo_users` (`username`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_account`
--
ALTER TABLE `order_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_users` (`username`),
  ADD KEY `fk_order_category` (`category`),
  ADD KEY `fk_order_groups` (`groups`);

--
-- Chỉ mục cho bảng `order_napgame`
--
ALTER TABLE `order_napgame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_napgame_groups` (`groups`),
  ADD KEY `fk_order_napgame_groups_napgame` (`groups_napgame`),
  ADD KEY `fk_order_napgame_users` (`username`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `groups_napgame`
--
ALTER TABLE `groups_napgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order_account`
--
ALTER TABLE `order_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `order_napgame`
--
ALTER TABLE `order_napgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_accounts_groups` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`);

--
-- Các ràng buộc cho bảng `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_cards_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD CONSTRAINT `fk_dongtien_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_groups_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `groups_napgame`
--
ALTER TABLE `groups_napgame`
  ADD CONSTRAINT `fk_groups_napgame_groups` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`);

--
-- Các ràng buộc cho bảng `momo`
--
ALTER TABLE `momo`
  ADD CONSTRAINT `fk_momo_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `order_account`
--
ALTER TABLE `order_account`
  ADD CONSTRAINT `fk_order_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_order_groups` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `fk_order_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `order_napgame`
--
ALTER TABLE `order_napgame`
  ADD CONSTRAINT `fk_order_napgame_groups` FOREIGN KEY (`groups`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `fk_order_napgame_groups_napgame` FOREIGN KEY (`groups_napgame`) REFERENCES `groups_napgame` (`id`),
  ADD CONSTRAINT `fk_order_napgame_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
