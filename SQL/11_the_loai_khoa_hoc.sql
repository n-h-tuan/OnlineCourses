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
-- Cấu trúc bảng cho bảng `the_loai_khoa_hoc`
--

CREATE TABLE `the_loai_khoa_hoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `TenTheLoai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `the_loai_khoa_hoc`
--

INSERT INTO `the_loai_khoa_hoc` (`id`, `TenTheLoai`, `created_at`, `updated_at`) VALUES
(1, 'Công nghệ thông tin', '2019-03-30 04:41:06', NULL),
(2, 'Kinh tế', '2019-03-30 04:41:06', NULL),
(3, 'Giáo dục', '2019-03-30 04:41:06', NULL),
(4, 'Y tế', '2019-03-30 04:41:06', NULL),
(5, 'Âm nhạc', '2019-03-30 04:41:06', NULL),
(6, 'Thời Trang', '2019-04-03 15:44:28', '2019-04-03 15:44:28'),
(7, 'Sắc Đẹp', '2019-04-03 15:47:14', '2019-04-03 15:47:14'),
(8, 'Nghệ Thuật', '2019-04-04 03:27:50', '2019-04-04 03:27:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `the_loai_khoa_hoc`
--
ALTER TABLE `the_loai_khoa_hoc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `the_loai_khoa_hoc`
--
ALTER TABLE `the_loai_khoa_hoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
