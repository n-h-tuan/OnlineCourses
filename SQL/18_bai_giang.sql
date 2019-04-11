-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 05, 2019 lúc 07:12 AM
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
-- Cấu trúc bảng cho bảng `bai_giang`
--

CREATE TABLE `bai_giang` (
  `id` int(10) UNSIGNED NOT NULL,
  `KhoaHoc_id` int(10) UNSIGNED NOT NULL,
  `TenBaiGiang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MoTa` longtext COLLATE utf8mb4_unicode_ci,
  `EmbededURL` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bai_giang`
--

INSERT INTO `bai_giang` (`id`, `KhoaHoc_id`, `TenBaiGiang`, `MoTa`, `EmbededURL`, `created_at`, `updated_at`) VALUES
(1, 23, 'Tên bài giảng 1', 'Mô tả 1', 'đây là embed url 5', '2019-03-30 08:00:15', '2019-03-30 08:00:15'),
(2, 23, 'Tên bài giảng 2', 'Mô tả 2', 'đây là embed url 6', '2019-03-30 08:00:15', '2019-03-30 08:00:15'),
(3, 23, 'Tên bài giảng 3', 'Mô tả 3', 'đây là embed url 7', '2019-03-30 08:00:15', '2019-03-30 08:00:15'),
(4, 23, 'Tên bài giảng 4', 'Mô tả 4', 'đây là embed url 8', '2019-03-30 08:00:15', '2019-03-30 08:00:15'),
(5, 25, 'Tên bài giảng 1', 'Mô tả 1', 'đây là embed url 1', '2019-03-30 08:00:50', '2019-03-30 08:00:50'),
(6, 25, 'Tên bài giảng 2', 'Mô tả 2', 'đây là embed url 2', '2019-03-30 08:00:50', '2019-03-30 08:00:50'),
(7, 25, 'Tên bài giảng 3', 'Mô tả 3', 'đây là embed url 3', '2019-03-30 08:00:50', '2019-03-30 08:00:50'),
(8, 25, 'Tên bài giảng 4', 'Mô tả 4', 'đây là embed url 4', '2019-03-30 08:00:51', '2019-03-30 08:00:51');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bai_giang`
--
ALTER TABLE `bai_giang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bai_giang_embededurl_unique` (`EmbededURL`),
  ADD KEY `bai_giang_khoahoc_id_index` (`KhoaHoc_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bai_giang`
--
ALTER TABLE `bai_giang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bai_giang`
--
ALTER TABLE `bai_giang`
  ADD CONSTRAINT `bai_giang_khoahoc_id_foreign` FOREIGN KEY (`KhoaHoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
