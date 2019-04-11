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
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` int(10) UNSIGNED NOT NULL,
  `KhoaHoc_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ThanhToan_id` int(10) UNSIGNED NOT NULL,
  `TongTien` int(11) NOT NULL,
  `MaCode_id` int(10) UNSIGNED DEFAULT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `KhoaHoc_id`, `user_id`, `ThanhToan_id`, `TongTien`, `MaCode_id`, `TrangThai`, `created_at`, `updated_at`) VALUES
(1, 23, 11, 1, 320000, 1, 1, NULL, NULL),
(2, 25, 10, 2, 200000, 14, 1, NULL, '2019-04-01 04:59:39'),
(3, 25, 11, 1, 200000, 17, 1, NULL, NULL),
(6, 23, 10, 1, 320000, NULL, 0, '2019-04-01 05:13:32', '2019-04-01 05:13:32'),
(8, 26, 11, 1, 100000, NULL, 0, NULL, NULL),
(10, 25, 11, 1, 200000, NULL, 0, '2019-04-04 07:37:48', '2019-04-04 07:37:48'),
(12, 25, 14, 1, 200000, 15, 1, '2019-04-04 17:32:26', '2019-04-04 17:38:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoa_don_macode_id_foreign` (`MaCode_id`),
  ADD KEY `hoa_don_khoahoc_id_index` (`KhoaHoc_id`),
  ADD KEY `hoa_don_user_id_index` (`user_id`),
  ADD KEY `hoa_don_thanhtoan_id_index` (`ThanhToan_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_khoahoc_id_foreign` FOREIGN KEY (`KhoaHoc_id`) REFERENCES `khoa_hoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoa_don_macode_id_foreign` FOREIGN KEY (`MaCode_id`) REFERENCES `code_khoa_hoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoa_don_thanhtoan_id_foreign` FOREIGN KEY (`ThanhToan_id`) REFERENCES `thanh_toan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoa_don_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
