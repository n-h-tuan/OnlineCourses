-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 05, 2019 lúc 07:13 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `online_course`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ngan_hang`
--

CREATE TABLE `ngan_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenNganHang` varchar(300) NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ngan_hang`
--

INSERT INTO `ngan_hang` (`id`, `TenNganHang`, `created_at`, `updated_at`) VALUES
(1, 'ACB - Á Châu', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(2, 'ABB - An Bình', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(3, 'Vietinbank - Công thương Việt Nam', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(4, 'BIDV - Đầu tư và Phát triển Việt Nam', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(5, 'EAB - Đông Á ', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(6, 'TECHCOMBANK - Kỹ Thương', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(7, 'VCB - Ngoại Thương Việt Nam', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(8, 'HDBank - Phát triển TP. Hồ Chí Minh', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(9, 'MB - Quân Đội', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(10, 'SCB - Sài Gòn', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(11, 'SGB - Sài Gòn Công Thương', '2019-04-03 09:47:00', '2019-04-03 09:47:00'),
(12, 'Eximbank - Xuất Nhập Khẩu', '2019-04-03 09:47:00', '2019-04-03 09:47:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ngan_hang`
--
ALTER TABLE `ngan_hang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ngan_hang`
--
ALTER TABLE `ngan_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
