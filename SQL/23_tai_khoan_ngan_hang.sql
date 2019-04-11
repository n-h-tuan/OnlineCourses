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
-- Cấu trúc bảng cho bảng `tai_khoan_ngan_hang`
--

CREATE TABLE `tai_khoan_ngan_hang` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `SoTaiKhoan` varchar(19) NOT NULL,
  `ChuTaiKhoan` varchar(255) NOT NULL,
  `NganHang_id` int(10) UNSIGNED NOT NULL,
  `ChiNhanhNganHang` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan_ngan_hang`
--

INSERT INTO `tai_khoan_ngan_hang` (`id`, `user_id`, `SoTaiKhoan`, `ChuTaiKhoan`, `NganHang_id`, `ChiNhanhNganHang`, `created_at`, `updated_at`) VALUES
(1, 8, '123456789123', 'Nguyễn Hoàng Tuấn', 3, 'PGD Quang Trung', '2019-04-03 11:00:01', '2019-04-03 11:00:01');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tai_khoan_ngan_hang`
--
ALTER TABLE `tai_khoan_ngan_hang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SoTaiKhoan` (`SoTaiKhoan`),
  ADD KEY `tai_khoan_ngan_hang_users_id_foreign` (`user_id`),
  ADD KEY `tai_khoan_ngan_hang_nganhang_id_foreign` (`NganHang_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tai_khoan_ngan_hang`
--
ALTER TABLE `tai_khoan_ngan_hang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tai_khoan_ngan_hang`
--
ALTER TABLE `tai_khoan_ngan_hang`
  ADD CONSTRAINT `tai_khoan_ngan_hang_nganhang_id_foreign` FOREIGN KEY (`NganHang_id`) REFERENCES `ngan_hang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tai_khoan_ngan_hang_users_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
