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
-- Cấu trúc bảng cho bảng `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0395fc06a80254122fdab21aefd2f34c51bffd90511ca622a37d845e8a28a882d6983468e51134ba', 9, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:32:04', '2019-03-30 06:32:04', '2020-03-30 13:32:04'),
('06f9749ce441c74caea26c35dcc5b74d82616abe570e10f60803f38911386edcfe468485c24560a0', 8, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:31:02', '2019-03-30 06:31:02', '2020-03-30 13:31:02'),
('3a44646e02cccf6c2e4772e6ad9eb47224fda048a07cb08ca34b1e3f3ecb471c7a599913554b24b3', 8, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:31:02', '2019-03-30 06:31:02', '2020-03-30 13:31:02'),
('3d155a8a30e884857bc47d0f0f980730c0b4bacff139807ae4c3821c6c7e34eb5a03e642e3d91e34', 13, 1, 'Personal Access Token', '[]', 0, '2019-04-01 05:21:49', '2019-04-01 05:21:49', '2020-04-01 12:21:49'),
('4f1b58c27d11dadeed2a55659cc72f6949e4df8c2dfdfd964979a15f5a1d7b0cfb3d69cce928b6b7', 11, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:32:39', '2019-03-30 06:32:39', '2020-03-30 13:32:39'),
('693d48eba5b540e9f452a1556450cd60459f65a2a656f4b005365a5c8d5eeda73dd80351cbcca037', 10, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:32:25', '2019-03-30 06:32:25', '2020-03-30 13:32:25'),
('80a551d380b2117f1bd49eda57019e2cca9554c23a51296ee25cf5aa4fbeb3fa5f2be32bd3502d13', 12, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:33:50', '2019-03-30 06:33:50', '2020-03-30 13:33:50'),
('8575fee461f6637def085e8faaf876e304c531958440874b2876358377a9941c8bcae548db685060', 11, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:32:39', '2019-03-30 06:32:39', '2020-03-30 13:32:39'),
('923ba0236ef67a4d7b2aa9dd85a2913c3201e9e512d89da48e90f50172207cd2bcd3439b2c41ccd2', 10, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:32:25', '2019-03-30 06:32:25', '2020-03-30 13:32:25'),
('9afe4074f1c7bcbcf18f79827f351f66cd0e9cfb0c54be492b2d0f8584475c2d0588e5a8b68fb31e', 14, 1, 'Personal Access Token', '[]', 0, '2019-04-04 17:28:53', '2019-04-04 17:28:53', '2020-04-05 00:28:53'),
('b7122c17f943b62807e8ced014a07ecc852cd3783ee6319f3177292b7d0267ba5a9d9d34d69fa606', 9, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:32:05', '2019-03-30 06:32:05', '2020-03-30 13:32:05'),
('bda24114038eee1928404d0f1feab6e7fdedface73249fbfebddd1d6ef447b2f2045d4bf3c06464b', 14, 1, 'Personal Access Token', '[]', 0, '2019-04-04 17:28:54', '2019-04-04 17:28:54', '2020-04-05 00:28:54'),
('c80087e64508d7060f75edd3483e032cda30002c9320e3a8c49dea9588ac407b6fb07df2676d7d7f', 13, 1, 'Personal Access Token', '[]', 0, '2019-04-01 05:21:49', '2019-04-01 05:21:49', '2020-04-01 12:21:49'),
('ea9d4331e105c7c6fa4c40fab7657f994344c47d753e0c5ce213c11d9d4d524a0b201e7a7ce32efc', 12, 1, 'Personal Access Token', '[]', 0, '2019-03-30 06:33:50', '2019-03-30 06:33:50', '2020-03-30 13:33:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
