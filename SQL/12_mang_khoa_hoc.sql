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
-- Cấu trúc bảng cho bảng `mang_khoa_hoc`
--

CREATE TABLE `mang_khoa_hoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `TheLoaiKH_id` int(10) UNSIGNED NOT NULL,
  `TenMangKH` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mang_khoa_hoc`
--

INSERT INTO `mang_khoa_hoc` (`id`, `TheLoaiKH_id`, `TenMangKH`, `created_at`, `updated_at`) VALUES
(1, 1, 'Đồ họa', '2019-03-30 04:41:06', NULL),
(2, 1, 'Phần cứng', '2019-03-30 04:41:06', NULL),
(3, 1, 'Phần mềm', '2019-03-30 04:41:06', NULL),
(4, 1, 'Mạng máy tính', '2019-03-30 04:41:06', NULL),
(5, 2, 'Tài chính', '2019-03-30 04:41:06', NULL),
(6, 2, 'Sales', '2019-03-30 04:41:06', NULL),
(7, 2, 'Chiến lược kinh tế', '2019-03-30 04:41:06', NULL),
(8, 3, 'Toán học', '2019-03-30 04:41:06', NULL),
(9, 3, 'Khoa học', '2019-03-30 04:41:06', NULL),
(10, 3, 'Ngôn ngữ học', '2019-03-30 04:41:06', NULL),
(11, 4, 'Dinh dưỡng', '2019-03-30 04:41:06', NULL),
(12, 4, 'Yoga-Fitness', '2019-03-30 04:41:06', NULL),
(13, 4, 'Sơ cứu', '2019-03-30 04:41:06', NULL),
(14, 5, 'Thanh nhạc', '2019-03-30 04:41:06', NULL),
(15, 5, 'Kỹ thuật nhạc cổ điển', '2019-03-30 04:41:06', NULL),
(16, 5, 'Phần mềm âm nhạc', '2019-03-30 04:41:06', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `mang_khoa_hoc`
--
ALTER TABLE `mang_khoa_hoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mang_khoa_hoc_theloaikh_id_index` (`TheLoaiKH_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `mang_khoa_hoc`
--
ALTER TABLE `mang_khoa_hoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `mang_khoa_hoc`
--
ALTER TABLE `mang_khoa_hoc`
  ADD CONSTRAINT `mang_khoa_hoc_theloaikh_id_foreign` FOREIGN KEY (`TheLoaiKH_id`) REFERENCES `the_loai_khoa_hoc` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
