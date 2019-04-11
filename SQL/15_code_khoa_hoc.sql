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
-- Cấu trúc bảng cho bảng `code_khoa_hoc`
--

CREATE TABLE `code_khoa_hoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KhoaHoc_id` int(10) UNSIGNED NOT NULL,
  `TrangThai` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `code_khoa_hoc`
--

INSERT INTO `code_khoa_hoc` (`id`, `code`, `KhoaHoc_id`, `TrangThai`, `created_at`, `updated_at`) VALUES
(1, 'HqxiCsbPDJ', 23, 0, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(2, 'i8AMp8xLs0', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(3, '2OymsN6Swz', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(4, 'zfwQ5B6Zhw', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(5, 'cbAZxs8dao', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(6, '9TlDw6oPs3', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(7, 'VKYg2f3sW3', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(8, 'UXqQWjAQH8', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(9, 'DETeSx78Vl', 23, 0, '2019-03-30 07:20:05', '2019-04-01 05:02:09'),
(10, 'wH7WQqxH8M', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(11, 'b7XC0UjaSG', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(12, 'cBegH5CePA', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(13, 'fL4fq17O09', 23, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(14, 'TZ9D5VQ9VR', 25, 0, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(15, 'BSzoVOhL6H', 25, 0, '2019-03-30 07:20:05', '2019-04-04 17:38:46'),
(16, 'UFSsO0kIoo', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(17, 'CGYTb0aRCQ', 25, 0, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(18, 'PW3tqjKH1A', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(19, '1IwJtg6e6p', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(20, 'aF63LnrMez', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(21, 'SQDhJSwfyn', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(22, 'OTzbis3AXf', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(23, 'NGE2zeoOcO', 25, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05'),
(24, 'rGAXxa54lP', 5, 1, '2019-03-30 07:20:05', '2019-03-30 07:20:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `code_khoa_hoc`
--
ALTER TABLE `code_khoa_hoc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_khoa_hoc_code_unique` (`code`),
  ADD KEY `code_khoa_hoc_khoahoc_id_index` (`KhoaHoc_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `code_khoa_hoc`
--
ALTER TABLE `code_khoa_hoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `code_khoa_hoc`
--
ALTER TABLE `code_khoa_hoc`
  ADD CONSTRAINT `code_khoa_hoc_khoahoc_id_foreign` FOREIGN KEY (`KhoaHoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
