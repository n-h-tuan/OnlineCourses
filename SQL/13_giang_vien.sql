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
-- Cấu trúc bảng cho bảng `giang_vien`
--

CREATE TABLE `giang_vien` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `TenGiangVien` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TomTat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoLuongHocVien` int(11) DEFAULT '0',
  `SoLuongKhoaHoc` int(11) DEFAULT '0',
  `ThoiHanGV_id` int(10) UNSIGNED NOT NULL,
  `NgayHetHan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giang_vien`
--

INSERT INTO `giang_vien` (`id`, `user_id`, `TenGiangVien`, `TomTat`, `SoLuongHocVien`, `SoLuongKhoaHoc`, `ThoiHanGV_id`, `NgayHetHan`, `TrangThai`, `created_at`, `updated_at`) VALUES
(1, 2, 'GV_1', 'Tôi là giảng viên GV_1', 0, 0, 1, NULL, 1, '2019-03-30 04:41:06', NULL),
(2, 3, 'GV_2', 'Tôi là giảng viên GV_2', 0, 0, 2, NULL, 1, '2019-03-30 04:41:06', NULL),
(3, 4, 'GV_3', 'Tôi là giảng viên GV_3', 0, 0, 1, NULL, 1, '2019-03-30 04:41:06', NULL),
(4, 8, 'Hoàng Tuấn', 'Tôi là giảng viên Nguyễn Hoàng Tuấn', 0, 0, 1, '25-12-2019 13:39:07', 1, '2019-03-30 06:39:07', '2019-04-01 05:51:53'),
(5, 9, 'Khánh Duy', 'Tôi là giảng viên Tiêu Khánh Duy', 0, 0, 1, '28-06-2019 13:39:55', 1, '2019-03-30 06:39:54', '2019-03-30 06:39:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giang_vien_user_id_index` (`user_id`),
  ADD KEY `giang_vien_thoihangv_id_index` (`ThoiHanGV_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `giang_vien`
--
ALTER TABLE `giang_vien`
  ADD CONSTRAINT `giang_vien_thoihangv_id_foreign` FOREIGN KEY (`ThoiHanGV_id`) REFERENCES `thoi_han_gv` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `giang_vien_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
