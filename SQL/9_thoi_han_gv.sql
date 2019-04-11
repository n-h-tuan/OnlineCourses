-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 05, 2019 lúc 07:14 AM
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
-- Cấu trúc bảng cho bảng `thoi_han_gv`
--

CREATE TABLE `thoi_han_gv` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenThoiHan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoNgay` int(11) NOT NULL,
  `GiaTien` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thoi_han_gv`
--

INSERT INTO `thoi_han_gv` (`id`, `TenThoiHan`, `SoNgay`, `GiaTien`, `created_at`, `updated_at`) VALUES
(1, '3 tháng', 90, 100000.00, '2019-03-30 04:41:06', NULL),
(2, '6 tháng', 180, 180000.00, '2019-03-30 04:41:06', NULL),
(3, '1 năm', 365, 340000.00, '2019-03-30 04:41:06', NULL),
(4, 'Trọn đời', 9999999, 800000.00, '2019-03-30 04:41:06', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `thoi_han_gv`
--
ALTER TABLE `thoi_han_gv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `thoi_han_gv`
--
ALTER TABLE `thoi_han_gv`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
