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
-- Cấu trúc bảng cho bảng `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id` int(10) UNSIGNED NOT NULL,
  `MangKH_id` int(10) UNSIGNED NOT NULL,
  `GiangVien_id` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TomTat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `GiaTien` double NOT NULL,
  `GiamGia` int(11) DEFAULT '0',
  `ThanhTien` double DEFAULT NULL,
  `DanhGia` int(11) NOT NULL DEFAULT '0',
  `SoLuotXem` int(11) NOT NULL DEFAULT '0',
  `HinhAnh` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id`, `MangKH_id`, `GiangVien_id`, `TenKH`, `TomTat`, `GiaTien`, `GiamGia`, `ThanhTien`, `DanhGia`, `SoLuotXem`, `HinhAnh`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'WordPress', 'Khóa học về đồ họa ', 268816, 0, NULL, 5, 199, NULL, NULL, NULL),
(2, 1, 2, 'Photoshop', 'Khóa học về đồ họa ', 191771, 0, NULL, 3, 453, NULL, NULL, NULL),
(3, 2, 1, 'Xử lý bo mạch', 'Khóa học về phần cứng máy tính ', 326498, 0, NULL, 1, 484, NULL, NULL, NULL),
(4, 2, 2, 'Sửa chữa điện thoại di động', 'Khóa học về phần cứng máy tính ', 356030, 0, NULL, 4, 969, NULL, NULL, NULL),
(5, 3, 1, 'Lập trình di động', 'Khóa học về phần mềm máy tính ', 380956, 0, NULL, 5, 596, NULL, NULL, NULL),
(6, 3, 1, 'Thiết kế website', 'Khóa học về phần mềm máy tính ', 142102, 0, NULL, 1, 283, NULL, NULL, NULL),
(7, 4, 3, 'Thiết lập router', 'Khóa học về phần mạng máy tính ', 339582, 0, NULL, 4, 466, NULL, NULL, NULL),
(8, 4, 1, 'Vấn đề về kết nối mạng', 'Khóa học về mạng máy tính ', 462040, 0, NULL, 1, 101, NULL, NULL, NULL),
(9, 5, 3, 'Phân tích tài chính', 'Khóa học về tài chính ', 468349, 0, NULL, 3, 387, NULL, NULL, NULL),
(10, 5, 2, 'Cổ phần thương mại', 'Khóa học về tài chính ', 181547, 0, NULL, 2, 254, NULL, NULL, NULL),
(11, 6, 1, 'Kỹ thuật sales', 'Khóa học về sales ', 385311, 0, NULL, 1, 801, NULL, NULL, NULL),
(12, 6, 2, 'Chiến lực kinh doanh', 'Khóa học về sales ', 463205, 0, NULL, 5, 790, NULL, NULL, NULL),
(13, 7, 1, 'Mô hình kinh doanh', 'Khóa học về chiến lược kinh tế ', 101416, 0, NULL, 1, 535, NULL, NULL, NULL),
(14, 8, 1, 'Toán logic', 'Khóa học về toán học ', 173853, 0, NULL, 4, 143, NULL, NULL, NULL),
(15, 9, 1, 'Tần số radio', 'Khóa học về khoa học ', 223063, 0, NULL, 1, 608, NULL, NULL, NULL),
(16, 10, 3, 'Ngữ pháp tiếng anh', 'Khóa học về ngôn ngữ học ', 228322, 0, NULL, 2, 937, NULL, NULL, NULL),
(17, 11, 1, 'Trái tim vàng', 'Khóa học về dinh dưỡng ', 414035, 0, NULL, 5, 174, NULL, NULL, NULL),
(18, 12, 1, 'Bữa ăn cho người tập luyện', 'Khóa học về Yoga-Fitness ', 113481, 0, NULL, 1, 864, NULL, NULL, NULL),
(19, 13, 2, 'Sơ cứu tức thời', 'Khóa học về sơ cứu ', 242029, 0, NULL, 3, 832, NULL, NULL, NULL),
(20, 14, 1, 'Làm thế nào để lấy được cao độ', 'Khóa học về thanh nhạc ', 267131, 0, NULL, 5, 892, NULL, NULL, NULL),
(21, 15, 2, 'Guitar classic', 'Khóa học về kỹ thuật nhạc cổ điện ', 185458, 0, NULL, 5, 781, NULL, NULL, NULL),
(22, 15, 1, 'Hướng dẫn Adobe Audition CC 2019', 'Khóa học về phần mềm âm nhạc ', 215409, 0, NULL, 4, 779, NULL, NULL, NULL),
(23, 2, 4, 'Thiết kế CPU', 'Khóa học về phần cứng máy tính', 320000, 0, 320000, 0, 0, 'https://res.cloudinary.com/tuannguyen/image/upload/v1/khoa_hoc/6sZvOp_dims.jpg', '2019-03-30 06:46:34', '2019-03-30 06:46:34'),
(25, 2, 5, 'Bảo trì máy tính hiệu quả', 'Khóa học về phần cứng máy tính', 200000, 0, 200000, 0, 0, 'https://res.cloudinary.com/tuannguyen/image/upload/v1/khoa_hoc/ZFT2L9_download.jpg', '2019-03-30 06:53:29', '2019-03-30 06:53:29'),
(26, 2, 4, 'Sửa chửa ổ cứng', 'Khóa học về phần cứng máy tính', 100000, 0, 100000, 0, 0, 'https://res.cloudinary.com/tuannguyen/image/upload/v1/khoa_hoc/PBVRtW_2789757.jpg', '2019-04-01 06:18:34', '2019-04-01 06:18:34');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_hoc_mangkh_id_index` (`MangKH_id`),
  ADD KEY `khoa_hoc_giangvien_id_index` (`GiangVien_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD CONSTRAINT `khoa_hoc_giangvien_id_foreign` FOREIGN KEY (`GiangVien_id`) REFERENCES `giang_vien` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `khoa_hoc_mangkh_id_foreign` FOREIGN KEY (`MangKH_id`) REFERENCES `mang_khoa_hoc` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
