-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 20, 2025 lúc 03:48 PM
-- Phiên bản máy phục vụ: 10.11.14-MariaDB-cll-lve-log
-- Phiên bản PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bloxv4855_shopv3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `signups` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `purchases` int(11) NOT NULL DEFAULT 0,
  `commissions` int(11) NOT NULL DEFAULT 0,
  `total_deposit` int(11) NOT NULL DEFAULT 0,
  `total_item_buy` int(11) NOT NULL DEFAULT 0,
  `total_register` int(11) NOT NULL DEFAULT 0,
  `total_boost_buy` int(11) NOT NULL DEFAULT 0,
  `total_account_buy` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `affiliates`
--

INSERT INTO `affiliates` (`id`, `code`, `clicks`, `signups`, `username`, `purchases`, `commissions`, `total_deposit`, `total_item_buy`, `total_register`, `total_boost_buy`, `total_account_buy`, `created_at`, `updated_at`) VALUES
(1, 'LQREBuFf7z50', 0, 0, 'dichvudark', 0, 0, 0, 0, 0, 0, 0, '2025-04-25 00:09:46', '2025-04-25 00:09:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affiliate_users`
--

CREATE TABLE `affiliate_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `affiliate_user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_configs`
--

CREATE TABLE `api_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `api_configs`
--

INSERT INTO `api_configs` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'charging_card', '{\"fees\":{\"VIETTEL\":\"20\",\"VINAPHONE\":\"20\",\"MOBIFONE\":\"20\",\"ZING\":\"20\",\"GARENA\":\"20\",\"VNMOBI\":\"20\"},\"api_url\":\"https:\\/\\/thecard1s.vn\\/\",\"partner_id\":\"Null\",\"partner_key\":\"Null\"}', '2023-11-17 17:31:35', '2025-05-20 01:25:54'),
(2, 'auth_google', '\"\"', '2023-12-21 20:08:44', '2023-12-21 20:08:44'),
(3, 'smtp_detail', '\"\"', '2023-12-23 13:12:01', '2023-12-23 13:12:01'),
(4, 'paypal', '\"\"', '2024-01-03 13:48:10', '2024-01-03 13:48:10'),
(5, 'web2m_vietcombank', '\"\"', '2024-01-07 21:26:57', '2024-01-07 21:26:57'),
(6, 'web2m_mbbank', '\"\"', '2024-01-08 20:49:58', '2024-01-08 20:49:58'),
(7, 'web2m_acb', '{\"api_token\":null,\"account_number\":null,\"account_password\":null}', '2024-01-20 02:00:27', '2024-01-20 15:04:28'),
(8, 'auth_.env', '\"\"', '2025-03-17 20:00:26', '2025-03-17 20:00:26'),
(9, 'auth_files.php', '\"\"', '2025-03-24 05:54:07', '2025-03-24 05:54:07'),
(10, 'auth_facebook', '\"\"', '2025-04-06 03:09:58', '2025-04-06 03:09:58'),
(11, 'auth_token', '\"\"', '2025-04-21 23:43:30', '2025-04-21 23:43:30'),
(12, 'web2m_momo', '{\"api_token\":\"dasdasdasdasd\"}', '2025-05-13 03:45:05', '2025-05-13 03:45:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `owner` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `image`, `owner`, `number`, `branch`, `status`, `created_at`, `updated_at`) VALUES
(4, 'ACB', '/uploads/29-04-2025/61164e03-c9a2-4f20-9cb6-cfe581514eab.jpg', 'LE VAN KHANH', '15873021', NULL, 1, '2025-04-29 01:58:25', '2025-04-29 01:58:25'),
(5, 'Momo', '/uploads/13-05-2025/7cfcbd2c-1ac3-4361-bdb4-3578cadd244b.png', 'LE VAN KHANH', '0397333616', NULL, 1, '2025-05-13 03:44:56', '2025-05-13 03:44:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bulk_orders`
--

CREATE TABLE `bulk_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `group` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `card_lists`
--

CREATE TABLE `card_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sys_note` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `channel_charge` varchar(255) DEFAULT NULL,
  `transaction_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `card_lists`
--

INSERT INTO `card_lists` (`id`, `type`, `code`, `serial`, `value`, `amount`, `status`, `user_id`, `username`, `sys_note`, `content`, `order_id`, `request_id`, `channel_charge`, `transaction_code`, `created_at`, `updated_at`) VALUES
(3, 'VIETTEL', '914167493548825', '10010153317256', 20000, 16000, 'Completed', '10', 'WilliamsfanKiric', NULL, 'CARD_CORRECT', '16526198', 'WilliamsfanKiric_0gljnl', 'https://thesieure.com/', 'CARD-QMYBLB', '2024-01-07 13:53:13', '2024-01-07 13:53:19'),
(4, 'MOBIFONE', '588239559614', '096892000843088', 20000, 16000, 'Completed', '13', 'Dominus', NULL, 'CARD_CORRECT', '16526268', 'Dominus_GRMePz', 'https://thesieure.com/', 'CARD-KJXXD5', '2024-01-07 14:01:54', '2024-01-07 14:02:11'),
(5, 'VIETTEL', '916174072276357', '10010248033860', 20000, 16000, 'Completed', '20', 'nguyen', NULL, 'CARD_CORRECT', '16589542', 'nguyen_EjJKQ2', 'https://thesieure.com/', 'CARD-2F0WN1', '2024-01-14 16:35:15', '2024-01-14 16:35:24'),
(6, 'VIETTEL', '013294275526287', '10010248033855', 20000, 16000, 'Completed', '20', 'nguyen', NULL, 'CARD_CORRECT', '16589559', 'nguyen_MIJwXH', 'https://thesieure.com/', 'CARD-R9UTJA', '2024-01-14 16:36:50', '2024-01-14 16:37:12'),
(7, 'VIETTEL', '313249083314197', '10010539707356', 100000, 80000, 'Completed', '21', 'longla22', NULL, 'CARD_CORRECT', '16628863', 'longla22_jCkmve', 'https://thesieure.com/', 'CARD-N0GYL4', '2024-01-19 10:01:19', '2024-01-19 10:01:25'),
(8, 'VIETTEL', '617783383514737', '10010539707351', 100000, 80000, 'Completed', '21', 'longla22', NULL, 'CARD_CORRECT', '16628875', 'longla22_q64Itz', 'https://thesieure.com/', 'CARD-ZPXKFD', '2024-01-19 10:04:12', '2024-01-19 10:04:20'),
(9, 'GARENA', '5066938522801355', '702341883', 200000, 0, 'Error', '48', 'dichvudark', NULL, 'CARD_INVALID', '20650719', 'dichvudark_clEovw', 'https://thesieure.com/', NULL, '2025-04-24 16:41:03', '2025-04-24 16:41:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `_lft`, `status`, `username`, `priority`, `created_at`, `updated_at`) VALUES
(2, 'Game Liên Quân Mobile', 'game-lien-quan-mobile', NULL, '1', 'admin123', 0, '2024-01-20 00:41:49', '2024-01-20 00:41:49'),
(5, 'THỬ VẬN MAY LIÊN QUÂN', 'thu-van-may-lien-quan', NULL, '1', 'dichvudark', 0, '2025-06-26 02:52:31', '2025-06-26 02:52:31'),
(6, 'XÉ TÚI MÙ ACC LIÊN QUÂN', 'xe-tui-mu-acc-lien-quan', NULL, '1', 'dichvudark', 0, '2025-06-26 03:09:06', '2025-06-26 03:09:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_v2_s`
--

CREATE TABLE `category_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colla_transactions`
--

CREATE TABLE `colla_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `balance_before` int(11) NOT NULL,
  `balance_after` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colla_withdraws`
--

CREATE TABLE `colla_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `user_note` varchar(255) DEFAULT NULL,
  `payment_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_info`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `configs`
--

INSERT INTO `configs` (`id`, `name`, `value`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'theme_custom', '{\"card_stats\":\"1\",\"product_info_type\":\"1\",\"buy_button_img\":\"_assets\\/images\\/stores\\/view-all.gif\",\"enable_custom_theme\":\"1\",\"show_thongbao\":\"1\",\"show_lsmua\":\"1\",\"show_banner\":\"1\",\"show_all_account_img\":\"1\",\"youtube\":\"xxj_SR3U9sI?si=cDDmvxEPUa81B8TP\",\"background_image\":\"https:\\/\\/i.imgur.com\\/ibB9Ehx.jpeg\",\"minigame_pos\":\"top\",\"minigame_show_value\":\"1\",\"product_cover\":null,\"pin_type\":\"slide\",\"type\":\"theme_custom\",\"banner\":\"\\/uploads\\/08-01-2024\\/8d99549e-2c96-441a-8037-88805a9d73db.jpg\"}', NULL, '2023-11-17 16:27:52', '2025-04-24 14:31:54'),
(2, 'shop_info', '{\"footer_text_1\":\"Mua Code N\\u00e0y T\\u1ea1i DichVuDark.VIP\",\"footer_text_2\":\"Mua Code N\\u00e0y T\\u1ea1i DichVuDark.VIP\",\"dashboard_text_1\":\"Mua Code N\\u00e0y T\\u1ea1i DichVuDark.VIP\"}', NULL, '2023-11-17 16:27:52', '2025-05-04 09:15:51'),
(3, 'general', '{\"title\":\"Shop B\\u00e1n \\u0110\\u1ed3 Roblox Uy T\\u00edn Gi\\u00e1 R\\u1ebb\",\"keywords\":\"dichvudark,thuebanquyen.pro.vn,api.vpnfast.vn,vpnfast,thueidgiare.pro.vn,khocodevip\",\"description\":\"GAMEPASS V\\u00c0 ROBUX UY T\\u00cdN V\\u00c0 GI\\u00c1 R\\u1eba NH\\u1ea4T TH\\u1eca TR\\u01af\\u1edcNG\",\"primary_color\":\"#d51a1a\",\"logo_dark\":\"\\/uploads\\/06-08-2025\\/aeb34b37-c69c-40b1-a140-8bc30ede9633.png\",\"email\":\"cskh@dichvudark.vip\",\"captcha\":\"0\",\"upload_provider\":\"public\",\"captcha_site_key\":null,\"captcha_secret_key\":null,\"time_wait_free\":\"10\",\"max_ip_reg\":\"5\",\"rate_robux\":\"100\",\"comm_percent\":\"10\",\"default_theme\":\"light\",\"logo_share\":\"\\/uploads\\/24-04-2025\\/b9213004-b9ed-4bc4-bfaf-97d6994cd948.jpg\",\"logo_light\":\"\\/uploads\\/06-08-2025\\/3555d086-2036-4354-b244-4daaee0c7aad.png\",\"favicon\":\"\\/uploads\\/24-04-2025\\/9c2817b0-e786-4c24-bf95-f5b03581e340.jpg\"}', NULL, '2023-11-17 16:27:52', '2025-08-06 02:58:51'),
(4, 'contact_info', '{\"email\":\"cskh@dichvudark.vip\",\"twitter\":null,\"discord\":null,\"facebook\":\"https:\\/\\/www.facebook.com\\/vpnfastvn\",\"telegram\":\"https:\\/\\/t.me\\/vankhanh1996\",\"phone_no\":\"0397333616\",\"instagram\":null}', NULL, '2023-11-17 16:27:52', '2025-04-24 13:43:21'),
(5, 'version_code', '6172', NULL, '2023-11-17 16:28:40', '2025-10-20 08:47:28'),
(6, 'mng_withdraw', '{\"unit\":\"Robux\",\"youtube_id\":\"Q33YRsQOecI\",\"min_withdraw\":1,\"max_withdraw\":100}', NULL, '2023-11-17 17:18:59', '2025-04-22 10:59:27'),
(7, 'deposit_info', '{\"prefix\":\"NAPSHOP\",\"discount\":0}', NULL, '2023-11-17 17:18:59', '2024-01-20 02:16:23'),
(8, 'deposit_port', '{\"card\":\"1\",\"bank\":\"1\",\"invoice\":\"1\",\"crypto\":\"0\",\"paypal\":\"1\",\"perfect_money\":\"0\"}', NULL, '2023-12-20 20:31:54', '2025-04-02 14:06:25'),
(9, 'get_gift', '{\"min\":\"10\",\"max\":\"100\",\"width\":\"500\",\"image\":\"\\/uploads\\/22-04-2025\\/5a93c233-afa0-4328-a873-83b0055e339a.gif\",\"status\":\"1\",\"balance\":\"0\"}', NULL, '2025-03-14 14:39:54', '2025-04-22 10:38:08'),
(10, 'telegram_config', NULL, NULL, '2025-03-14 14:39:54', '2025-03-14 14:39:54'),
(11, 'affiliate_config', NULL, NULL, '2025-03-14 14:39:54', '2025-03-14 14:39:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` longtext DEFAULT NULL,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `descr_seo` longtext DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `game_type` varchar(255) NOT NULL DEFAULT 'game-khac',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `image`, `type`, `slug`, `descr`, `meta_seo`, `descr_seo`, `sold`, `status`, `game_type`, `priority`, `username`, `category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(7, 'ACC REG VIP', '/uploads/26-06-2025/9113e975-c28e-4d0c-ad30-7e19e6c7f718.gif', 'account', 'acc-reg-vip', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 2, 'Game Liên Quân Mobile', '2025-06-26 02:50:37', '2025-06-26 02:50:37'),
(8, 'ACC TRÊN 5M', '/uploads/26-06-2025/4785595b-a16b-4dc7-bd98-30fe9716d0ae.gif', 'account', 'acc-tren-5m', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 2, 'Game Liên Quân Mobile', '2025-06-26 02:51:37', '2025-06-26 02:51:37'),
(9, 'THỬ VẬN MAY LQ 20k', '/uploads/26-06-2025/cf7639e8-8312-4b86-9563-67db06a2bdb1.gif', 'account', 'thu-van-may-lq-20k', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 5, 'THỬ VẬN MAY LIÊN QUÂN', '2025-06-26 02:54:49', '2025-06-26 02:54:49'),
(10, 'THỬ VẬN MAY 50K', '/uploads/26-06-2025/24cd7bb5-60b8-4c5b-bc6f-c0a6e9cd43cb.gif', 'account', 'thu-van-may-50k', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 5, 'THỬ VẬN MAY LIÊN QUÂN', '2025-06-26 02:59:59', '2025-06-26 02:59:59'),
(11, 'THỬ VẬN MAY 100K', '/uploads/26-06-2025/e1cf6623-dc26-488b-879a-7117cd35d52f.gif', 'account', 'thu-van-may-100k', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 5, 'THỬ VẬN MAY LIÊN QUÂN', '2025-06-26 03:03:30', '2025-06-26 03:03:30'),
(12, 'VẬN MAY 200K TTT', '/uploads/26-06-2025/86b6f9f0-5155-4c04-9435-ce6536bdc8d3.gif', 'account', 'van-may-200k-ttt', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 5, 'THỬ VẬN MAY LIÊN QUÂN', '2025-06-26 03:03:53', '2025-06-26 03:03:53'),
(13, 'XÉ TÚI MÙ 20K', '/uploads/26-06-2025/ebc119c5-e33f-47d9-a971-6474e67b0e4f.gif', 'account', 'xe-tui-mu-20k', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 6, 'XÉ TÚI MÙ ACC LIÊN QUÂN', '2025-06-26 03:10:35', '2025-06-26 03:10:35'),
(14, 'XÉ TÚI MÙ 50K', '/uploads/26-06-2025/aa7f3ba0-1576-4bcd-9d51-f7fd2ce1fb2c.gif', 'account', 'xe-tui-mu-50k', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '', 0, '1', 'game-khac', 0, 'dichvudark', 6, 'XÉ TÚI MÙ ACC LIÊN QUÂN', '2025-06-26 03:11:02', '2025-06-26 03:11:02'),
(15, 'XÉ TÚI MÙ 99K', '/uploads/26-06-2025/309770dd-d8b0-44bc-acb1-f40f06e8c5d2.gif', 'account', 'xe-tui-mu-99k', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 6, 'XÉ TÚI MÙ ACC LIÊN QUÂN', '2025-06-26 03:12:31', '2025-06-26 03:12:31'),
(16, 'XÉ TÚI MÙ ACC REG 200K TTT', '/uploads/26-06-2025/e6aa2a43-9700-40ae-b454-42090ec84960.gif', 'account', 'xe-tui-mu-acc-reg-200k-ttt', '<p> </p>\n<script type=\"text/javascript\"></script>', '{\"title\":null,\"keywords\":null}', '<p> </p>\n<script type=\"text/javascript\"></script>', 0, '1', 'game-khac', 0, 'dichvudark', 6, 'XÉ TÚI MÙ ACC LIÊN QUÂN', '2025-06-26 03:12:48', '2025-06-26 03:12:48'),
(17, 'Test', '/uploads/04-07-2025/19dacf8f-1ec8-46c8-b922-9e9bb5b27bb1.jpg', 'account', 'test', '', '{\"title\":null,\"keywords\":null}', '', 0, '1', 'game-khac', 0, 'dichvudark', 2, 'Game Liên Quân Mobile', '2025-07-04 15:13:07', '2025-07-04 15:13:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_v2_s`
--

CREATE TABLE `group_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` longtext DEFAULT NULL,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `descr_seo` longtext DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `game_type` varchar(255) NOT NULL DEFAULT 'game-khac',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_categories`
--

CREATE TABLE `g_b_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_groups`
--

CREATE TABLE `g_b_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` text DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_orders`
--

CREATE TABLE `g_b_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `input_user` varchar(255) NOT NULL,
  `input_pass` varchar(255) NOT NULL,
  `input_extra` varchar(500) NOT NULL,
  `payment` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `package_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `order_note` varchar(255) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `assigned_note` varchar(255) DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `assigned_type` varchar(255) DEFAULT NULL,
  `assigned_status` varchar(255) DEFAULT NULL,
  `assigned_complain` tinyint(1) NOT NULL DEFAULT 0,
  `assigned_payment` int(11) NOT NULL DEFAULT -1,
  `assigned_completed` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `g_b_packages`
--

CREATE TABLE `g_b_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `input` varchar(255) NOT NULL DEFAULT 'note',
  `price` double NOT NULL,
  `descr` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `priority` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `sold_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `histories`
--

INSERT INTO `histories` (`id`, `role`, `user_id`, `username`, `content`, `data`, `ip_address`, `domain`, `created_at`, `updated_at`) VALUES
(498, 'admin', 26, 'admin123', 'Thêm danh mục LIÊN MINH HUYỀN THOẠI', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:41:39', '2024-01-20 00:41:39'),
(499, 'admin', 26, 'admin123', 'Thêm danh mục Game Liên Quân Mobile', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:41:49', '2024-01-20 00:41:49'),
(500, 'admin', 26, 'admin123', 'Thêm danh mục Game Free Fire', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:41:56', '2024-01-20 00:41:56'),
(501, 'admin', 26, 'admin123', 'Thêm nhóm BÁN NICK FREEFIRE SEVER INDO cho danh mục Game Free Fire', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:43:51', '2024-01-20 00:43:51'),
(502, 'admin', 26, 'admin123', 'Thêm 4 sản phẩm cho nhóm BÁN NICK FREEFIRE SEVER INDO', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:45:51', '2024-01-20 00:45:51'),
(503, 'admin', 26, 'admin123', 'Thêm nhóm MUA NICK FREE FIRE SIÊU RẺ cho danh mục Game Free Fire', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:47:29', '2024-01-20 00:47:29'),
(504, 'admin', 26, 'admin123', 'Thêm 1 sản phẩm cho nhóm MUA NICK FREE FIRE SIÊU RẺ', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:49:36', '2024-01-20 00:49:36'),
(505, 'admin', 26, 'admin123', 'Thêm nhóm NICK GIÁ RẺ cho danh mục Game Liên Quân Mobile', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:50:59', '2024-01-20 00:50:59'),
(506, 'admin', 26, 'admin123', 'Thêm 1 sản phẩm cho nhóm NICK GIÁ RẺ', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:51:54', '2024-01-20 00:51:54'),
(507, 'admin', 26, 'admin123', 'Thêm nhóm ACC 499K SALE CÒN 30K cho danh mục Game Liên Quân Mobile', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:54:39', '2024-01-20 00:54:39'),
(508, 'admin', 26, 'admin123', 'Thêm 1 sản phẩm cho nhóm ACC 499K SALE CÒN 30K', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:55:50', '2024-01-20 00:55:50'),
(509, 'admin', 26, 'admin123', 'Thêm nhóm SĂN SKIN VIP SSS cho danh mục Game Liên Quân Mobile', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 00:56:53', '2024-01-20 00:56:53'),
(510, 'admin', 26, 'admin123', 'Thêm tài khoản 15873021, ngân hàng ACB Ngân hàng Á Châu', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 02:01:52', '2024-01-20 02:01:52'),
(511, 'admin', 26, 'admin123', 'Xóa tài khoản ngân hàng 9704150122240388 #1', '[]', '2402:800:6349:354c:f59f:4518:2659:dccd', NULL, '2024-01-20 02:01:57', '2024-01-20 02:01:57'),
(512, 'user', 26, 'admin123', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.250.145.134', 'shopkhanhori.com', '2024-01-20 05:07:04', '2024-01-20 05:07:04'),
(513, 'user', 26, 'admin123', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2402:800:6349:354c:55d0:fa69:51c3:1a7c', 'shopkhanhori.com', '2024-01-20 11:01:51', '2024-01-20 11:01:51'),
(514, 'user', 26, 'admin123', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2402:800:6349:354c:8c2a:6295:e20f:fe8a', 'shopkhanhori.com', '2024-01-20 14:26:24', '2024-01-20 14:26:24'),
(515, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:50e0:f5b0:7d70:1d5a:678b:84bb', 'duykhanhdev.com', '2025-03-14 14:31:20', '2025-03-14 14:31:20'),
(516, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4276:e1f0:e423:f013:4404:7e89', 'duykhanhdev.com', '2025-03-14 14:39:37', '2025-03-14 14:39:37'),
(517, 'admin', 31, 'dichvuright', 'Xóa tài khoản ngân hàng 15873021 #2', '[]', '2001:ee0:4276:e1f0:e423:f013:4404:7e89', NULL, '2025-03-14 14:42:53', '2025-03-14 14:42:53'),
(518, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4276:e1f0:bd29:76e5:cd78:61da', 'duykhanhdev.com', '2025-03-18 23:13:02', '2025-03-18 23:13:02'),
(519, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '113.164.65.142', 'duykhanhdev.com', '2025-03-27 11:10:09', '2025-03-27 11:10:09'),
(520, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.250.167.86', 'duykhanhdev.com', '2025-04-02 11:30:49', '2025-04-02 11:30:49'),
(521, 'admin', 31, 'dichvuright', 'Cập nhật thông tin của dichvuright [update-info]', '{\"role\":\"admin\",\"email\":\"khanhbts5@gmail.com\",\"status\":\"active\",\"balance_1\":\"0\",\"colla_type\":\"account\",\"colla_percent\":\"0\",\"staff_group_ids\":[]}', '171.250.167.86', NULL, '2025-04-02 11:34:06', '2025-04-02 11:34:06'),
(522, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a62:cf20:b153:64a6:d854:b5cb', 'duykhanhdev.com', '2025-04-02 14:03:19', '2025-04-02 14:03:19'),
(523, 'admin', 31, 'dichvuright', 'Thêm tài khoản 6320079999, ngân hàng Mbbank', '[]', '2001:ee0:4a62:cf20:b153:64a6:d854:b5cb', NULL, '2025-04-02 14:04:01', '2025-04-02 14:04:01'),
(524, 'admin', 31, 'dichvuright', 'Cập nhật tài khoản ngân hàng 6320079999 #3', '[]', '2001:ee0:4a62:cf20:b153:64a6:d854:b5cb', NULL, '2025-04-02 14:04:11', '2025-04-02 14:04:11'),
(525, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '116.98.255.191', 'duykhanhdev.com', '2025-04-06 02:01:25', '2025-04-06 02:01:25'),
(526, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '116.98.255.191', 'duykhanhdev.com', '2025-04-06 02:02:39', '2025-04-06 02:02:39'),
(527, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a62:cf20:15b5:5d55:90a5:3235', 'duykhanhdev.com', '2025-04-06 03:01:52', '2025-04-06 03:01:52'),
(528, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:52b0:38f0:d6b1:9f59:d84f:4178', 'duykhanhdev.com', '2025-04-06 03:10:01', '2025-04-06 03:10:01'),
(529, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a62:cf20:15b5:5d55:90a5:3235', 'duykhanhdev.com', '2025-04-06 05:35:00', '2025-04-06 05:35:00'),
(530, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:51b5:a930:3580:f6e9:fefc:bed7', 'duykhanhdev.com', '2025-04-21 14:04:20', '2025-04-21 14:04:20'),
(531, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a61:32a0:7865:7b9:1714:ae2e', 'duykhanhdev.com', '2025-04-21 15:27:18', '2025-04-21 15:27:18'),
(532, 'admin', 31, 'dichvuright', 'Tạo danh mục ghim #1 [dcm]', '[]', '2001:ee0:4a61:32a0:7865:7b9:1714:ae2e', NULL, '2025-04-21 15:29:51', '2025-04-21 15:29:51'),
(533, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', 'duykhanhdev.com', '2025-04-21 23:20:36', '2025-04-21 23:20:36'),
(534, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', 'duykhanhdev.com', '2025-04-22 05:13:21', '2025-04-22 05:13:21'),
(535, 'admin', 31, 'dichvuright', 'Thêm danh mục khanhdz', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:17:03', '2025-04-22 05:17:03'),
(536, 'admin', 31, 'dichvuright', 'Thêm nhóm Dcm cho danh mục khanhdz', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:18:15', '2025-04-22 05:18:15'),
(537, 'admin', 31, 'dichvuright', '[V2] Thêm danh mục Ok vip', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:19:27', '2025-04-22 05:19:27'),
(538, 'admin', 31, 'dichvuright', '[V2] Thêm nhóm Ok cho danh mục Ok vip', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:20:40', '2025-04-22 05:20:40'),
(539, 'admin', 31, 'dichvuright', '[V2] Thêm 1 sản phẩm cho nhóm Ok', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:21:57', '2025-04-22 05:21:57'),
(540, 'admin', 31, 'dichvuright', '[V2] Cập nhật nhóm Cv2', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:23:44', '2025-04-22 05:23:44'),
(541, 'admin', 31, 'dichvuright', '[V2] Xóa tài khoản Ok', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:28:07', '2025-04-22 05:28:07'),
(542, 'admin', 31, 'dichvuright', '[V2] Xóa sản phẩm #1', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:28:36', '2025-04-22 05:28:36'),
(543, 'admin', 31, 'dichvuright', '[V2] Thêm 1 sản phẩm cho nhóm Cv2', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:30:01', '2025-04-22 05:30:01'),
(544, 'admin', 31, 'dichvuright', '[V2] Cập nhật sản phẩm #1 -> 1', '[]', '2001:ee0:4a61:32a0:3d7b:d2d9:52ef:f6e9', NULL, '2025-04-22 05:30:58', '2025-04-22 05:30:58'),
(545, 'user', 31, 'dichvuright', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', 'duykhanhdev.com', '2025-04-22 08:31:56', '2025-04-22 08:31:56'),
(546, 'admin', 31, 'dichvuright', 'Tạo vòng quay mới (test)', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:33:03', '2025-04-22 08:33:03'),
(547, 'admin', 31, 'dichvuright', 'Cập nhật vòng quay (test)', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:38:41', '2025-04-22 08:38:41'),
(548, 'admin', 31, 'dichvuright', 'Cập nhật giải thưởng vòng quay (test)', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:40:43', '2025-04-22 08:40:43'),
(549, 'admin', 31, 'dichvuright', 'Cập nhật hệ thống tặng quà miễn phí cho người mới', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:44:51', '2025-04-22 08:44:51'),
(550, 'admin', 31, 'dichvuright', 'Cộng tiền thành công cho dichvuright [plus-money]', '{\"amount\":\"100000000\",\"reason\":null}', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:47:20', '2025-04-22 08:47:20'),
(551, 'admin', 31, 'dichvuright', 'Cập nhật vòng quay (test)', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:48:06', '2025-04-22 08:48:06'),
(552, 'admin', 31, 'dichvuright', 'Xóa danh mục ghim #1 [dcm]', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:58:29', '2025-04-22 08:58:29'),
(553, 'admin', 31, 'dichvuright', 'Tạo danh mục ghim #2 [Cày Thuê Blox Fruit]', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:59:05', '2025-04-22 08:59:05'),
(554, 'admin', 31, 'dichvuright', 'Tạo danh mục ghim #3 [TRÁI ÁC QUỶ VĨNH VIỄN BLOXFUIT]', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 08:59:58', '2025-04-22 08:59:58'),
(555, 'admin', 31, 'dichvuright', 'Tạo danh mục ghim #4 [Facebook Hỗ Trợ Shop]', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 09:01:07', '2025-04-22 09:01:07'),
(556, 'admin', 31, 'dichvuright', 'Tạo danh mục ghim #5 [Zalo Thông Báo Shop]', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 09:01:56', '2025-04-22 09:01:56'),
(557, 'admin', 31, 'dichvuright', '[V2] Thêm 1 sản phẩm cho nhóm Cv2', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 09:42:52', '2025-04-22 09:42:52'),
(558, 'admin', 31, 'dichvuright', '[V2] Cập nhật sản phẩm #2 -> 2', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 09:43:08', '2025-04-22 09:43:08'),
(559, 'admin', 31, 'dichvuright', '[V2] Cập nhật sản phẩm #2 -> 2', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 09:43:15', '2025-04-22 09:43:15'),
(560, 'admin', 31, 'dichvuright', '[V2] Cập nhật sản phẩm #1 -> 1', '[]', '2001:ee0:4a61:32a0:553b:9f6d:b31e:6c51', NULL, '2025-04-22 09:43:31', '2025-04-22 09:43:31'),
(561, 'admin', 31, 'dichvuright', 'Cập nhật hệ thống tặng quà miễn phí cho người mới', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 10:37:15', '2025-04-22 10:37:15'),
(562, 'admin', 31, 'dichvuright', 'Cập nhật hệ thống tặng quà miễn phí cho người mới', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 10:38:08', '2025-04-22 10:38:08'),
(563, 'admin', 31, 'dichvuright', 'Tạo loại phần thưởng mới thành công: Roblox', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 10:50:51', '2025-04-22 10:50:51'),
(564, 'admin', 31, 'dichvuright', 'Cập nhật vòng quay (test)', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 10:55:06', '2025-04-22 10:55:06'),
(565, 'admin', 31, 'dichvuright', 'Đã completed lịch sử rút thưởng của dichvuright', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 10:59:53', '2025-04-22 10:59:53'),
(566, 'admin', 31, 'dichvuright', 'Xóa nhóm Dcm', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 11:01:07', '2025-04-22 11:01:07'),
(567, 'admin', 31, 'dichvuright', 'Xóa danh mục khanhdz', '[]', '2001:ee0:4a61:32a0:f1ed:7977:c0a3:8d84', NULL, '2025-04-22 11:01:15', '2025-04-22 11:01:15'),
(568, 'admin', 48, 'dichvudark', 'Xóa sản phẩm #37155133', '[]', '115.79.175.110', NULL, '2025-04-24 13:38:59', '2025-04-24 13:38:59'),
(569, 'admin', 48, 'dichvudark', 'Xóa danh mục LIÊN MINH HUYỀN THOẠI', '[]', '115.79.175.110', NULL, '2025-04-24 13:39:15', '2025-04-24 13:39:15'),
(570, 'admin', 48, 'dichvudark', '[V2] Xóa tài khoản ok', '[]', '115.79.175.110', NULL, '2025-04-24 13:40:24', '2025-04-24 13:40:24'),
(571, 'admin', 48, 'dichvudark', '[V2] Xóa sản phẩm #1', '[]', '115.79.175.110', NULL, '2025-04-24 13:40:30', '2025-04-24 13:40:30'),
(572, 'admin', 48, 'dichvudark', '[V2] Xóa tài khoản cc', '[]', '115.79.175.110', NULL, '2025-04-24 13:40:37', '2025-04-24 13:40:37'),
(573, 'admin', 48, 'dichvudark', '[V2] Xóa sản phẩm #2', '[]', '115.79.175.110', NULL, '2025-04-24 13:40:43', '2025-04-24 13:40:43'),
(574, 'admin', 48, 'dichvudark', '[V2] Xóa nhóm Cv2', '[]', '115.79.175.110', NULL, '2025-04-24 13:41:02', '2025-04-24 13:41:02'),
(575, 'admin', 48, 'dichvudark', '[V2] Xóa danh mục Ok vip', '[]', '115.79.175.110', NULL, '2025-04-24 13:41:20', '2025-04-24 13:41:20'),
(576, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-24 14:04:07', '2025-04-24 14:04:07'),
(577, 'admin', 48, 'dichvudark', 'Cập nhật danh mục ghim #5 [Zalo Thông Báo Shop]', '[]', '115.79.175.110', NULL, '2025-04-24 14:05:44', '2025-04-24 14:05:44'),
(578, 'admin', 48, 'dichvudark', 'Cập nhật danh mục ghim #4 [Facebook Hỗ Trợ Shop]', '[]', '115.79.175.110', NULL, '2025-04-24 14:05:53', '2025-04-24 14:05:53'),
(579, 'admin', 48, 'dichvudark', 'Xóa danh mục ghim #3 [TRÁI ÁC QUỶ VĨNH VIỄN BLOXFUIT]', '[]', '115.79.175.110', NULL, '2025-04-24 14:05:57', '2025-04-24 14:05:57'),
(580, 'admin', 48, 'dichvudark', 'Xóa danh mục ghim #2 [Cày Thuê Blox Fruit]', '[]', '115.79.175.110', NULL, '2025-04-24 14:06:02', '2025-04-24 14:06:02'),
(581, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-24 14:20:28', '2025-04-24 14:20:28'),
(582, 'admin', 48, 'dichvudark', 'Tạo danh mục ghim #6 [Mua Code Này]', '[]', '115.79.175.110', NULL, '2025-04-24 15:08:16', '2025-04-24 15:08:16'),
(583, 'admin', 48, 'dichvudark', 'Cập nhật danh mục ghim #6 [Mua Code Này]', '[]', '115.79.175.110', NULL, '2025-04-24 15:08:29', '2025-04-24 15:08:29'),
(584, 'admin', 48, 'dichvudark', 'Tạo danh mục ghim #7 [Tạo Shop Giống Này]', '[]', '115.79.175.110', NULL, '2025-04-24 15:09:15', '2025-04-24 15:09:15'),
(585, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-24 16:38:59', '2025-04-24 16:38:59'),
(586, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '125.235.210.175', 'bloxv4.com', '2025-04-25 00:09:32', '2025-04-25 00:09:32'),
(587, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-27 07:04:12', '2025-04-27 07:04:12'),
(588, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-28 04:06:25', '2025-04-28 04:06:25'),
(589, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-28 14:12:58', '2025-04-28 14:12:58'),
(590, 'admin', 48, 'dichvudark', 'Xóa tài khoản ngân hàng 6320079999 #3', '[]', '115.79.175.110', NULL, '2025-04-28 14:34:26', '2025-04-28 14:34:26'),
(591, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-28 16:01:00', '2025-04-28 16:01:00'),
(592, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-28 16:01:20', '2025-04-28 16:01:20'),
(593, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-04-29 01:56:48', '2025-04-29 01:56:48'),
(594, 'admin', 48, 'dichvudark', 'Thêm tài khoản 15873021, ngân hàng ACB', '[]', '115.79.175.110', NULL, '2025-04-29 01:58:25', '2025-04-29 01:58:25'),
(595, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-05-02 07:02:33', '2025-05-02 07:02:33'),
(596, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-05-02 07:35:12', '2025-05-02 07:35:12'),
(597, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.175.110', 'bloxv4.com', '2025-05-04 09:15:16', '2025-05-04 09:15:16'),
(598, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-10 01:18:44', '2025-05-10 01:18:44'),
(599, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-11 07:29:54', '2025-05-11 07:29:54'),
(600, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-11 07:31:30', '2025-05-11 07:31:30'),
(601, 'admin', 48, 'dichvudark', 'Thay đổi mật khẩu thành công', '[]', '115.79.161.23', NULL, '2025-05-11 07:31:40', '2025-05-11 07:31:40'),
(602, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.251.237.109', 'bloxv4.com', '2025-05-11 07:31:56', '2025-05-11 07:31:56'),
(603, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-13 03:36:48', '2025-05-13 03:36:48'),
(604, 'admin', 48, 'dichvudark', 'Thêm tài khoản 0397333616, ngân hàng Momo', '[]', '115.79.161.23', NULL, '2025-05-13 03:44:56', '2025-05-13 03:44:56'),
(605, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.255.184.70', 'bloxv4.com', '2025-05-13 09:13:11', '2025-05-13 09:13:11'),
(606, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.255.187.173', 'bloxv4.com', '2025-05-14 00:26:31', '2025-05-14 00:26:31'),
(607, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-14 17:08:35', '2025-05-14 17:08:35'),
(608, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-16 02:03:24', '2025-05-16 02:03:24'),
(609, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-19 02:05:35', '2025-05-19 02:05:35'),
(610, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.161.23', 'bloxv4.com', '2025-05-20 01:15:30', '2025-05-20 01:15:30'),
(611, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.163.37', 'bloxv4.com', '2025-05-22 02:05:14', '2025-05-22 02:05:14'),
(612, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '14.188.252.135', 'bloxv4.com', '2025-05-25 06:43:50', '2025-05-25 06:43:50'),
(613, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '27.66.53.217', 'bloxv4.com', '2025-05-27 02:06:39', '2025-05-27 02:06:39'),
(614, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.163.37', 'bloxv4.com', '2025-05-28 02:42:38', '2025-05-28 02:42:38'),
(615, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-05-29 11:28:04', '2025-05-29 11:28:04'),
(616, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.163.37', 'bloxv4.com', '2025-05-31 06:06:49', '2025-05-31 06:06:49'),
(617, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-06-02 08:29:13', '2025-06-02 08:29:13'),
(618, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.253.250.91', 'bloxv4.com', '2025-06-08 02:06:13', '2025-06-08 02:06:13'),
(619, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-06-09 02:24:16', '2025-06-09 02:24:16'),
(620, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.163.37', 'bloxv4.com', '2025-06-11 03:32:19', '2025-06-11 03:32:19'),
(621, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.163.37', 'bloxv4.com', '2025-06-13 05:50:32', '2025-06-13 05:50:32'),
(622, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.163.37', 'bloxv4.com', '2025-06-14 01:15:08', '2025-06-14 01:15:08'),
(623, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-06-15 07:46:40', '2025-06-15 07:46:40'),
(624, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-06-16 09:37:12', '2025-06-16 09:37:12'),
(625, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.225.204.179', 'bloxv4.com', '2025-06-16 12:23:02', '2025-06-16 12:23:02'),
(626, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.225.204.179', 'bloxv4.com', '2025-06-17 03:29:11', '2025-06-17 03:29:11'),
(627, 'admin', 48, 'dichvudark', 'Cộng tiền thành công cho dichvudark [plus-money]', '{\"amount\":\"2000000\",\"reason\":null}', '171.225.204.179', NULL, '2025-06-17 03:29:46', '2025-06-17 03:29:46'),
(628, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '116.100.187.93', 'bloxv4.com', '2025-06-17 04:24:20', '2025-06-17 04:24:20'),
(629, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-06-20 07:18:41', '2025-06-20 07:18:41'),
(630, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-06-23 04:28:10', '2025-06-23 04:28:10'),
(631, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '163.5.56.253', 'bloxv4.com', '2025-06-24 06:08:37', '2025-06-24 06:08:37'),
(632, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-06-26 02:06:41', '2025-06-26 02:06:41'),
(633, 'admin', 48, 'dichvudark', 'Cập nhật nhóm NICK GIÁ RẺ', '[]', '171.249.240.161', NULL, '2025-06-26 02:09:27', '2025-06-26 02:09:27'),
(634, 'admin', 48, 'dichvudark', 'Xóa nhóm NICK GIÁ RẺ', '[]', '171.249.240.161', NULL, '2025-06-26 02:14:17', '2025-06-26 02:14:17'),
(635, 'admin', 48, 'dichvudark', 'Xóa nhóm SĂN SKIN VIP SSS', '[]', '171.249.240.161', NULL, '2025-06-26 02:14:21', '2025-06-26 02:14:21'),
(636, 'admin', 48, 'dichvudark', 'Xóa sản phẩm #71038779', '[]', '171.249.240.161', NULL, '2025-06-26 02:14:34', '2025-06-26 02:14:34'),
(637, 'admin', 48, 'dichvudark', 'Xóa nhóm ACC 499K SALE CÒN 30K', '[]', '171.249.240.161', NULL, '2025-06-26 02:14:42', '2025-06-26 02:14:42'),
(638, 'admin', 48, 'dichvudark', 'Thêm nhóm ACC REG VIP cho danh mục Game Liên Quân Mobile', '[]', '171.249.240.161', NULL, '2025-06-26 02:50:37', '2025-06-26 02:50:37'),
(639, 'admin', 48, 'dichvudark', 'Thêm nhóm ACC TRÊN 5M cho danh mục Game Liên Quân Mobile', '[]', '171.249.240.161', NULL, '2025-06-26 02:51:37', '2025-06-26 02:51:37'),
(640, 'admin', 48, 'dichvudark', 'Thêm danh mục THỬ VẬN MAY LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 02:52:31', '2025-06-26 02:52:31'),
(641, 'admin', 48, 'dichvudark', 'Thêm nhóm THỬ VẬN MAY LQ 20k cho danh mục THỬ VẬN MAY LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 02:54:49', '2025-06-26 02:54:49'),
(642, 'admin', 48, 'dichvudark', 'Thêm 1 sản phẩm cho nhóm THỬ VẬN MAY LQ 20k', '[]', '171.249.240.161', NULL, '2025-06-26 02:56:29', '2025-06-26 02:56:29'),
(643, 'admin', 48, 'dichvudark', 'Thêm nhóm THỬ VẬN MAY 50K cho danh mục THỬ VẬN MAY LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 02:59:59', '2025-06-26 02:59:59'),
(644, 'admin', 48, 'dichvudark', 'Thêm 1 sản phẩm cho nhóm THỬ VẬN MAY 50K', '[]', '171.249.240.161', NULL, '2025-06-26 03:02:14', '2025-06-26 03:02:14'),
(645, 'admin', 48, 'dichvudark', 'Thêm nhóm THỬ VẬN MAY 100K cho danh mục THỬ VẬN MAY LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:03:30', '2025-06-26 03:03:30'),
(646, 'admin', 48, 'dichvudark', 'Thêm nhóm VẬN MAY 200K TTT cho danh mục THỬ VẬN MAY LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:03:53', '2025-06-26 03:03:53'),
(647, 'admin', 48, 'dichvudark', 'Thêm 1 sản phẩm cho nhóm THỬ VẬN MAY 100K', '[]', '171.249.240.161', NULL, '2025-06-26 03:04:53', '2025-06-26 03:04:53'),
(648, 'admin', 48, 'dichvudark', 'Xóa sản phẩm #74936723', '[]', '171.249.240.161', NULL, '2025-06-26 03:08:12', '2025-06-26 03:08:12'),
(649, 'admin', 48, 'dichvudark', 'Xóa nhóm MUA NICK FREE FIRE SIÊU RẺ', '[]', '171.249.240.161', NULL, '2025-06-26 03:08:20', '2025-06-26 03:08:20'),
(650, 'admin', 48, 'dichvudark', 'Xóa 4 sản phẩm ở accounts v1', '[]', '171.249.240.161', NULL, '2025-06-26 03:08:39', '2025-06-26 03:08:39'),
(651, 'admin', 48, 'dichvudark', 'Xóa nhóm BÁN NICK FREEFIRE SEVER INDO', '[]', '171.249.240.161', NULL, '2025-06-26 03:08:49', '2025-06-26 03:08:49'),
(652, 'admin', 48, 'dichvudark', 'Xóa danh mục Game Free Fire', '[]', '171.249.240.161', NULL, '2025-06-26 03:08:56', '2025-06-26 03:08:56'),
(653, 'admin', 48, 'dichvudark', 'Thêm danh mục XÉ TÚI MÙ ACC LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:09:06', '2025-06-26 03:09:06'),
(654, 'admin', 48, 'dichvudark', 'Thêm nhóm XÉ TÚI MÙ 20K cho danh mục XÉ TÚI MÙ ACC LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:10:35', '2025-06-26 03:10:35'),
(655, 'admin', 48, 'dichvudark', 'Thêm nhóm XÉ TÚI MÙ 50K cho danh mục XÉ TÚI MÙ ACC LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:11:02', '2025-06-26 03:11:02'),
(656, 'admin', 48, 'dichvudark', 'Thêm nhóm XÉ TÚI MÙ 99K cho danh mục XÉ TÚI MÙ ACC LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:12:31', '2025-06-26 03:12:31'),
(657, 'admin', 48, 'dichvudark', 'Thêm nhóm XÉ TÚI MÙ ACC REG 200K TTT cho danh mục XÉ TÚI MÙ ACC LIÊN QUÂN', '[]', '171.249.240.161', NULL, '2025-06-26 03:12:48', '2025-06-26 03:12:48'),
(658, 'admin', 48, 'dichvudark', 'Thêm 1 sản phẩm cho nhóm XÉ TÚI MÙ 20K', '[]', '171.249.240.161', NULL, '2025-06-26 03:15:53', '2025-06-26 03:15:53'),
(659, 'admin', 48, 'dichvudark', 'Thêm 1 sản phẩm cho nhóm XÉ TÚI MÙ 50K', '[]', '171.249.240.161', NULL, '2025-06-26 03:17:31', '2025-06-26 03:17:31'),
(660, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-06-29 05:31:59', '2025-06-29 05:31:59'),
(661, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-07-02 07:46:37', '2025-07-02 07:46:37'),
(662, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-07-04 06:12:03', '2025-07-04 06:12:03'),
(663, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.991.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-07-04 15:11:40', '2025-07-04 15:11:40'),
(664, 'admin', 48, 'dichvudark', 'Thêm nhóm Test cho danh mục Game Liên Quân Mobile', '[]', '171.249.240.161', NULL, '2025-07-04 15:13:07', '2025-07-04 15:13:07'),
(665, 'admin', 48, 'dichvudark', 'Thêm 1 sản phẩm cho nhóm Test', '[]', '171.249.240.161', NULL, '2025-07-04 15:18:56', '2025-07-04 15:18:56'),
(666, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900 ₫', '[]', '171.249.240.161', 'bloxv4.com', '2025-07-06 07:04:15', '2025-07-06 07:04:15'),
(667, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900 ₫', '[]', '116.100.180.155', 'bloxv4.com', '2025-07-12 05:49:16', '2025-07-12 05:49:16'),
(668, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900,1 ₫', '[]', '27.75.166.122', 'bloxv4.com', '2025-07-22 11:34:31', '2025-07-22 11:34:31'),
(669, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900,1 ₫', '[]', '27.75.166.122', 'bloxv4.com', '2025-07-22 11:34:43', '2025-07-22 11:34:43'),
(670, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900,1 ₫', '[]', '27.75.166.122', 'bloxv4.com', '2025-07-22 11:34:50', '2025-07-22 11:34:50'),
(671, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900,1 ₫', '[]', '27.75.166.122', 'bloxv4.com', '2025-07-22 11:46:00', '2025-07-22 11:46:00'),
(672, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900,1 ₫', '[]', '27.75.166.122', 'bloxv4.com', '2025-07-30 11:26:35', '2025-07-30 11:26:35'),
(673, 'user', 48, 'dichvudark', 'Đăng nhập thành công qua WEB, số dư 1.981.900,1 ₫', '[]', '27.75.166.122', 'bloxv4.com', '2025-08-06 02:56:48', '2025-08-06 02:56:48'),
(674, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '27.64.105.75', 'bloxv4.com', '2025-08-11 02:12:00', '2025-08-11 02:12:00'),
(675, 'user', 57, 'DICHVUDARK', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '2405:4802:c3b5:91d0:ed3f:5478:e9d0:5b93', 'bloxv4.com', '2025-08-12 08:23:00', '2025-08-12 08:23:00'),
(676, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.249.240.178', 'bloxv4.com', '2025-08-23 13:59:42', '2025-08-23 13:59:42'),
(677, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.249.240.178', 'bloxv4.com', '2025-09-05 02:47:39', '2025-09-05 02:47:39'),
(678, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.236.40.247', 'bloxv4.com', '2025-09-12 08:02:12', '2025-09-12 08:02:12'),
(679, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.236.40.247', 'bloxv4.com', '2025-09-12 10:53:33', '2025-09-12 10:53:33'),
(680, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '171.236.40.247', 'bloxv4.com', '2025-09-26 00:34:55', '2025-09-26 00:34:55'),
(681, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '74.81.34.118', 'bloxv4.com', '2025-10-06 07:21:09', '2025-10-06 07:21:09'),
(682, 'user', 55, 'khanhdzme', 'Đăng nhập thành công qua WEB, số dư 0 ₫', '[]', '115.79.170.81', 'bloxv4.com', '2025-10-20 08:46:58', '2025-10-20 08:46:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ingames`
--

CREATE TABLE `ingames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT 0,
  `var_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `value`, `var_id`, `user_id`, `username`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Roblox', 151, '1', 31, 'dichvuright', 1, '2025-04-22 10:53:38', '2025-04-22 10:55:43'),
(2, 'Roblox', 240, '1', 48, 'dichvudark', 1, '2025-04-24 14:04:14', '2025-08-12 08:22:24'),
(3, 'Roblox', 26, '1', 56, 'Adminooo', 1, '2025-08-12 08:19:41', '2025-08-12 08:19:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `after_value` int(11) NOT NULL,
  `before_value` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `unit`, `unit_id`, `type`, `value`, `content`, `after_value`, `before_value`, `user_id`, `username`, `source`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 'RB', 1, 'spin', 21, 'Nhận thưởng cho người mới', 21, 0, 31, 'dichvuright', 'gift_reward', -1, '2025-04-22 10:53:38', '2025-04-22 10:53:38'),
(2, 'RB', 1, 'spin', 70, 'Bạn đã quay trúng 70 RB!', 91, 21, 31, 'dichvuright', 'lucky_wheel', 1, '2025-04-22 10:55:14', '2025-04-22 10:55:14'),
(3, 'RB', 1, 'spin', 70, 'Bạn đã quay trúng 70 RB!', 161, 91, 31, 'dichvuright', 'lucky_wheel', 1, '2025-04-22 10:55:20', '2025-04-22 10:55:20'),
(4, 'RB', 1, 'spin', 20, 'Bạn đã quay trúng 20 RB!', 181, 161, 31, 'dichvuright', 'lucky_wheel', 1, '2025-04-22 10:55:25', '2025-04-22 10:55:25'),
(5, 'RB', 1, 'spin', 18, 'Nhận thưởng cho người mới', 18, 0, 48, 'dichvudark', 'gift_reward', -1, '2025-04-24 14:04:14', '2025-04-24 14:04:14'),
(6, 'RB', 1, 'spin', 60, 'Bạn đã quay trúng 60 RB!', 78, 18, 48, 'dichvudark', 'lucky_wheel', 1, '2025-06-17 03:30:42', '2025-06-17 03:30:42'),
(7, 'RB', 1, 'spin', 40, 'Bạn đã quay trúng 40 RB!', 118, 78, 48, 'dichvudark', 'lucky_wheel', 1, '2025-06-17 03:30:48', '2025-06-17 03:30:48'),
(8, 'RB', 1, 'spin', 60, 'Bạn đã quay trúng 60 RB!', 178, 118, 48, 'dichvudark', 'lucky_wheel', 1, '2025-06-17 03:30:48', '2025-06-17 03:30:48'),
(9, 'RB', 1, 'spin', 26, 'Nhận thưởng cho người mới', 26, 0, 56, 'Adminooo', 'gift_reward', -1, '2025-08-12 08:19:41', '2025-08-12 08:19:41'),
(10, 'RB', 1, 'spin', 62, 'Nhận thưởng cho người mới', 240, 178, 57, 'DICHVUDARK', 'gift_reward', -1, '2025-08-12 08:22:24', '2025-08-12 08:22:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventory_vars`
--

CREATE TABLE `inventory_vars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `form_inputs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_inputs`)),
  `form_packages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_packages`)),
  `min_withdraw` int(11) NOT NULL DEFAULT 0,
  `max_withdraw` int(11) NOT NULL DEFAULT 1000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory_vars`
--

INSERT INTO `inventory_vars` (`id`, `name`, `unit`, `image`, `is_active`, `form_inputs`, `form_packages`, `min_withdraw`, `max_withdraw`, `created_at`, `updated_at`) VALUES
(1, 'Roblox', 'RB', '/uploads/22-04-2025/inventory_vars/14131dcf-55b5-4b26-9b8f-43bf122b0100.jpg', 1, '[{\"label\":\"T\\u00e0i kho\\u1ea3n\",\"type\":\"text\",\"options\":[]},{\"label\":\"M\\u1eadt kh\\u1ea9u\",\"type\":\"password\",\"options\":[]}]', '{\"30\":\"30 RB\",\"50\":\"50 RB\",\"100\":\"100 RB\",\"200\":\"200 RB\"}', 1, 200, '2025-04-22 10:50:51', '2025-04-22 10:50:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `request_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoices`
--

INSERT INTO `invoices` (`id`, `code`, `type`, `status`, `amount`, `user_id`, `username`, `trans_id`, `currency`, `request_id`, `description`, `payment_details`, `paid_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 'INV1743602816', 'deposit', 'processing', 10000, '31', 'dichvuright', NULL, 'VND', NULL, 'Nạp Tiền Tài Khoản', '{\"name\":\"Mbbank\",\"owner\":\"NGUYEN DUY KHANH\",\"number\":\"6320079999\"}', NULL, '2025-04-03 03:06:56', '2025-04-02 14:06:56', '2025-04-02 14:06:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `_lft` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `username` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_data`
--

CREATE TABLE `item_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'item',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `robux` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sold_count` int(11) NOT NULL DEFAULT 0,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `ingame_id` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_groups`
--

CREATE TABLE `item_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `slug` varchar(255) NOT NULL,
  `descr` text DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `priority` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `login_with` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`login_with`)),
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_orders`
--

CREATE TABLE `item_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'item',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `robux` int(11) NOT NULL DEFAULT 0,
  `rate_robux` int(11) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `input_user` varchar(255) DEFAULT NULL,
  `input_pass` varchar(255) DEFAULT NULL,
  `input_auth` varchar(255) DEFAULT NULL,
  `input_contact` varchar(255) DEFAULT NULL,
  `input_ingame` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `input_ingame_n` varchar(255) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `order_note` varchar(255) DEFAULT NULL,
  `extra_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `assigned_note` varchar(255) DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `assigned_type` varchar(255) DEFAULT NULL,
  `assigned_status` varchar(255) DEFAULT NULL,
  `assigned_complain` tinyint(1) NOT NULL DEFAULT 0,
  `assigned_payment` int(11) NOT NULL DEFAULT -1,
  `assigned_completed` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_items`
--

CREATE TABLE `list_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cost` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `domain` varchar(255) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `list_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `description` longtext DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`highlights`)),
  `priority` int(11) NOT NULL DEFAULT 0,
  `list_skin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `raw_skins` text DEFAULT NULL,
  `list_champ` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `raw_champions` text DEFAULT NULL,
  `cf_the_loai` varchar(255) DEFAULT NULL,
  `cf_vip_ingame` int(11) DEFAULT NULL,
  `cf_vip_amount` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `buyer_code` varchar(255) DEFAULT NULL,
  `buyer_paym` double NOT NULL DEFAULT 0,
  `buyer_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `staff_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `staff_payment` int(11) DEFAULT NULL,
  `staff_completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `list_items`
--

INSERT INTO `list_items` (`id`, `name`, `type`, `code`, `image`, `cost`, `price`, `domain`, `discount`, `status`, `list_image`, `currency`, `description`, `username`, `password`, `extra_data`, `highlights`, `priority`, `list_skin`, `raw_skins`, `list_champ`, `raw_champions`, `cf_the_loai`, `cf_vip_ingame`, `cf_vip_amount`, `group_id`, `buyer_name`, `buyer_code`, `buyer_paym`, `buyer_date`, `created_at`, `updated_at`, `staff_name`, `staff_status`, `staff_payment`, `staff_completed_at`) VALUES
(8, 'THỬ VẬN MAY LQ 20k', 'account', '25061704', 'https://bloxv4.com/uploads/26-06-2025/general/b41a91cf-cc5a-4c66-8a87-0fad106564ac.gif', 20000, 20000, NULL, 0, 1, '[\"https:\\/\\/bloxv4.com\\/uploads\\/26-06-2025\\/general\\/b41a91cf-cc5a-4c66-8a87-0fad106564ac.gif\"]', 'VND', '<p> </p>\n<script type=\"text/javascript\"></script>', 'USERNAME', 'PASSWORD', '2FA', '[{\"name\":\"T\\u01b0\\u1edbng\",\"value\":\"\"},{\"name\":\"Trang ph\\u1ee5c\",\"value\":\"\"},{\"name\":\"Tr\\u1ea1ng th\\u00e1i\",\"value\":\"tr\\u1eafng th\\u00f4ng tin\"}]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 9, NULL, NULL, 0, NULL, '2025-06-26 02:56:29', '2025-06-26 02:56:29', NULL, 'Pending', NULL, NULL),
(9, 'THỬ VẬN MAY 50K', 'account', '25065875', 'https://bloxv4.com/uploads/26-06-2025/general/abf36adb-41e4-4f47-a3e2-1947eff5d9f6.gif', 50000, 50000, NULL, 0, 1, '[\"https:\\/\\/bloxv4.com\\/uploads\\/26-06-2025\\/general\\/abf36adb-41e4-4f47-a3e2-1947eff5d9f6.gif\"]', 'VND', '<p> </p>\n<script type=\"text/javascript\"></script>', 'USERNAME', 'PASSWORD', '2FA', '[{\"name\":\"T\\u01b0\\u1edbng\",\"value\":\"\"},{\"name\":\"Trang ph\\u1ee5c\",\"value\":\"\"},{\"name\":\"Tr\\u1ea1ng th\\u00e1i\",\"value\":\"tr\\u1eafng th\\u00f4ng tin\"}]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 10, NULL, NULL, 0, NULL, '2025-06-26 03:02:14', '2025-06-26 03:02:14', NULL, 'Pending', NULL, NULL),
(10, 'THỬ VẬN MAY  100K THỬ VẬN MAY 100K', 'account', '25062725', 'https://bloxv4.com/uploads/26-06-2025/general/b58a47d1-88a0-4e01-bf80-cc82473593e5.gif', 100000, 100000, NULL, 0, 1, '[\"https:\\/\\/bloxv4.com\\/uploads\\/26-06-2025\\/general\\/b58a47d1-88a0-4e01-bf80-cc82473593e5.gif\"]', 'VND', '<p> </p>\n<script type=\"text/javascript\"></script>', 'USERNAME', 'PASSWORD', '2FA', '[{\"name\":\"Trang ph\\u1ee5c\",\"value\":\"\"},{\"name\":\"T\\u01b0\\u1edbng\",\"value\":\"\"},{\"name\":\"Th\\u00f4ng tin\",\"value\":\"tr\\u1eafng\"}]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 11, NULL, NULL, 0, NULL, '2025-06-26 03:04:53', '2025-06-26 03:04:53', NULL, 'Pending', NULL, NULL),
(11, 'XÉ TÚI MÙ 20K', 'account', '25063983', 'https://bloxv4.com/uploads/26-06-2025/general/d9287093-1d6c-4b49-b781-60262f99491e.gif', 20000, 20000, NULL, 0, 1, '[\"https:\\/\\/bloxv4.com\\/uploads\\/26-06-2025\\/general\\/d9287093-1d6c-4b49-b781-60262f99491e.gif\"]', 'VND', '<p> </p>\n<script type=\"text/javascript\"></script>', 'USERNAME', 'PASSWORD', '2FA', '[{\"name\":\"T\\u01b0\\u1edbng\",\"value\":\"\"},{\"name\":\"Trang ph\\u1ee5c\",\"value\":\"\"},{\"name\":\"Tr\\u1ea1ng th\\u00e1i\",\"value\":\"Tr\\u1eafng th\\u00f4ng tin\"}]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 13, NULL, NULL, 0, NULL, '2025-06-26 03:15:53', '2025-06-26 03:15:53', NULL, 'Pending', NULL, NULL),
(12, 'XÉ TÚI MÙ 50K', 'account', '25060015', 'https://bloxv4.com/uploads/26-06-2025/general/9d8a9c80-77c3-41cf-bbc9-b0149ee47fdc.gif', 50000, 50000, NULL, 0, 1, '[\"https:\\/\\/bloxv4.com\\/uploads\\/26-06-2025\\/general\\/9d8a9c80-77c3-41cf-bbc9-b0149ee47fdc.gif\"]', 'VND', '<p> </p>\n<script type=\"text/javascript\"></script>', 'USERNAME', 'PASSWORD', '2FA', '[{\"name\":\"T\\u01b0\\u1edbng\",\"value\":\"\"},{\"name\":\"Trang ph\\u1ee5c\",\"value\":\"\"},{\"name\":\"Tr\\u1ea1ng th\\u00e1i\",\"value\":\"tr\\u1eafng th\\u00f4ng tin\"}]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 14, NULL, NULL, 0, NULL, '2025-06-26 03:17:31', '2025-06-26 03:17:31', NULL, 'Pending', NULL, NULL),
(13, 'acc test', 'account', '25077567', 'https://bloxv4.com/uploads/04-07-2025/general/91006414-9c62-4e65-a45a-fd417ac7fc13.jpg', 10000, 10000, 'bloxv4.com', 0, 0, '[\"https:\\/\\/bloxv4.com\\/uploads\\/04-07-2025\\/general\\/91006414-9c62-4e65-a45a-fd417ac7fc13.jpg\"]', 'VND', '<p> </p>\n<script type=\"text/javascript\"></script>', 'USERNAME', 'PASSWORD', '2FA', '[{\"name\":\"Th\\u00f4ng tin\",\"value\":\"tr\\u1eafng\"},{\"name\":\"t\\u01b0\\u1edbng\",\"value\":\"50\"},{\"name\":\"trang ph\\u1ee5c\",\"value\":\"1000\"}]', 0, '[]', '', '[]', NULL, NULL, NULL, 0, 17, 'dichvudark', 'Y1-QFC6MA6S', 10000, '2025-07-04 15:19:32', '2025-07-04 15:18:56', '2025-07-04 15:19:32', NULL, 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_item_archives`
--

CREATE TABLE `list_item_archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_item_v2_s`
--

CREATE TABLE `list_item_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cost` double NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_bulk` int(11) NOT NULL DEFAULT 1,
  `list_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` longtext DEFAULT NULL,
  `extra_data` text DEFAULT NULL,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL,
  `resource_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_25_182626_create_configs_table', 1),
(7, '2023_07_25_182939_create_api_configs_table', 1),
(8, '2023_07_25_205042_create_notifications_table', 1),
(9, '2023_07_27_141621_create_histories_table', 1),
(10, '2023_07_27_165146_create_transactions_table', 1),
(11, '2023_07_28_201434_create_bank_accounts_table', 1),
(12, '2023_07_30_090744_create_invoices_table', 1),
(13, '2023_07_30_172801_create_posts_table', 1),
(14, '2023_07_30_204908_create_categories_table', 1),
(15, '2023_07_30_212509_create_groups_table', 1),
(16, '2023_07_30_231608_create_list_items_table', 1),
(17, '2023_07_31_003930_create_card_lists_table', 1),
(18, '2023_08_25_203135_create_item_categories_table', 1),
(19, '2023_08_25_203225_create_item_groups_table', 1),
(20, '2023_08_25_203317_create_item_data_table', 1),
(21, '2023_08_25_203409_create_item_orders_table', 1),
(22, '2023_08_26_145954_create_g_b_categories_table', 1),
(23, '2023_08_26_145958_create_g_b_groups_table', 1),
(24, '2023_08_26_150004_create_g_b_packages_table', 1),
(25, '2023_08_26_150008_create_g_b_orders_table', 1),
(26, '2023_10_17_182536_create_list_item_archives_table', 1),
(27, '2023_10_21_192813_create_group_v2_s_table', 1),
(28, '2023_10_21_192839_create_category_v2_s_table', 1),
(29, '2023_10_21_192850_create_list_item_v2_s_table', 1),
(30, '2023_10_21_193944_create_resource_v2_s_table', 1),
(31, '2023_11_02_174007_create_spin_quests_table', 1),
(32, '2023_11_02_174138_create_spin_quest_logs_table', 1),
(33, '2023_11_05_174916_create_withdraw_logs_table', 1),
(34, '2023_10_30_173059_create_wallet_logs_table', 2),
(35, '2024_01_24_232116_create_affiliates_table', 2),
(36, '2024_01_25_153939_create_affiliate_users_table', 2),
(37, '2024_03_13_231822_create_ingames_table', 2),
(38, '2024_03_16_200355_create_colla_transactions_table', 2),
(39, '2024_03_17_004628_create_colla_withdraws_table', 2),
(40, '2024_05_24_083041_add_last_login_at_to_users_table', 2),
(41, '2024_06_04_152539_add_staff_accounts_to_users', 2),
(42, '2024_06_04_152560_fix_accounts_to_resources_v2', 2),
(43, '2024_06_04_155604_add_staff_name_to_list_items', 2),
(44, '2024_06_11_005156_add_col_to_spin_quest_logs', 2),
(45, '2024_06_26_214131_create_inventories_table', 2),
(46, '2024_06_26_214240_create_inventory_vars_table', 2),
(47, '2024_06_28_211752_create_inventory_logs_table', 2),
(48, '2024_07_16_180356_create_withdraw_data_table', 2),
(49, '2024_11_08_211154_create_bulk_orders_table', 2),
(50, '2024_12_19_222036_create_pin_groups_table', 2),
(51, '2024_06_11_005186_update_balance_column', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `type`, `value`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'home_dashboard', NULL, '', NULL, '2023-11-17 16:27:52', '2024-01-20 00:38:21'),
(2, 'modal_dashboard', NULL, '<p><span style=\"font-size:72px;\"><img alt=\"\" src=\"https://cdn.discordapp.com/attachments/1140654828289282096/1195007805032255558/Them_tieu_e_5.png?ex=65b26cbe&amp;is=659ff7be&amp;hm=eab9f799e9dbd1d6a56077e4ae8138d4a6697d7baea7ec1c10046e88f84c117b&amp;\" /></span><img alt=\"\" src=\"https://i.imgur.com/TvQOZVZ.png\" /></p>', NULL, '2023-11-17 16:27:52', '2024-01-20 00:38:16'),
(3, 'header_script', NULL, NULL, NULL, '2023-11-17 16:27:52', '2025-05-04 09:16:03'),
(4, 'footer_script', NULL, '', NULL, '2023-11-17 16:27:52', '2023-11-17 16:27:52'),
(5, 'page_deposit', NULL, '', NULL, '2023-11-17 17:31:45', '2023-12-31 23:17:35'),
(6, 'page_deposit_invoice', NULL, '', NULL, '2025-04-02 14:06:51', '2025-04-02 14:06:51'),
(7, 'withdraw_v2_tut', NULL, '', NULL, '2025-04-21 14:10:24', '2025-04-21 14:10:24'),
(8, 'page_account_info', NULL, '', NULL, '2025-04-22 09:52:25', '2025-04-22 09:52:25'),
(9, 'page_affiliate', NULL, '', NULL, '2025-04-28 16:01:31', '2025-04-28 16:01:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('djadinalvaradoqh@gmail.com', '$2y$10$pjW02lt6ggePlq1R.lrkqOBb3bD/.UEy3Kbb8hn7tiP6GfDZcUrym', '2025-03-15 16:12:52'),
('djenwolfehr46@gmail.com', '$2y$10$pOs2nMcljs8pj7sqGNVSTOvbKVFgBw1YQkHsYTWWMmy.GBbHf5URu', '2025-03-21 22:42:08'),
('geiblnielsenas1997@gmail.com', '$2y$10$FhE6sa4xqamA9ioHeOMm2OlHH3K1.ahQ1MvdmIKdW2eUcxFP/cy/S', '2025-03-19 18:09:10'),
('genaflp82@gmail.com', '$2y$10$tVhJlnTQYniH93XZKPCaqu92buBxZqL8h1kMdAws4noY2vmxrIfH6', '2025-03-22 13:19:34'),
('juarezderriky2@gmail.com', '$2y$10$72y1yqwSOlxIAUTy8EtrsuFoSwSrsxPRgoG9YG5soGQcqobX6akNi', '2025-03-24 11:56:42'),
('kitoncurtis@gmail.com', '$2y$10$ydbhCUZqov/CLE1/VQZIS.DBNl1CIGsLVQ9.QSDbOdhqCIXlg6O8m', '2025-03-21 07:04:54'),
('larsoaverun1984@gmail.com', '$2y$10$fGBKsxS4mqa4l9dE1Q.5C.A4IrKWMwEc1bMdIPEOjWPqSH3zbIAHC', '2025-03-17 04:30:12'),
('poncesilvers1997@gmail.com', '$2y$10$atCDFyvjwStHnUblVRXAAOpzlmV05OHH5/OToWwC8ESVzYrZeRkV.', '2025-03-16 10:31:25'),
('shannwallu25@gmail.com', '$2y$10$EIQ2mxEFDt1vVDmaf.vVyeV5IW.gCOxpc0Ytl/JQC392tJyHZiFw6', '2025-03-14 21:00:07'),
('villasenorricardo1985@yahoo.com', '$2y$10$f0rrpkyCljKB7YmkTfdac.vaYa4T0slRItDj.i5t.ApFVWNWalWR.', '2025-03-18 09:06:48'),
('woodsingram34@gmail.com', '$2y$10$ZCawBle7NZzn7NnO69.dPeRFoYzT0KCZTctolA7Be3W55NdIjOMde', '2025-03-23 04:04:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 2, 'access_token', '630c140c5022da9c95fea1506eeb7e4fdd74ab2096e55d7643d45322252fbfd8', '[\"*\"]', NULL, NULL, '2023-12-20 20:38:31', '2023-12-20 20:38:31'),
(3, 'App\\Models\\User', 3, 'access_token', 'f18a195241d61a0c9b6c42c118ffcab6354a89bb029077eb2003e19643b18a0f', '[\"*\"]', '2024-01-09 11:19:24', NULL, '2023-12-23 16:20:53', '2024-01-09 11:19:24'),
(4, 'App\\Models\\User', 4, 'access_token', '37fea5df44f36092ff42362f39e81d464ffabe47d0b0b0463eb6217309db1137', '[\"*\"]', '2024-01-19 10:59:54', NULL, '2023-12-25 14:15:18', '2024-01-19 10:59:54'),
(5, 'App\\Models\\User', 5, 'access_token', '75aed6192098dab3e78aebbd143ed499a170aa1915d445f4cc4902a79e6a63be', '[\"*\"]', NULL, NULL, '2023-12-30 16:16:43', '2023-12-30 16:16:43'),
(6, 'App\\Models\\User', 6, 'access_token', 'bb5ea57eb7dc605d95b43797759db8d8353f9e2d4a42a4b6bac427af4f24a8e0', '[\"*\"]', NULL, NULL, '2023-12-31 23:24:41', '2023-12-31 23:24:41'),
(7, 'App\\Models\\User', 7, 'access_token', '93b081354d5af50e3c857faadd8e8bbe113ce32d54f33fdac0ebe423d88d1912', '[\"*\"]', NULL, NULL, '2024-01-03 17:26:02', '2024-01-03 17:26:02'),
(8, 'App\\Models\\User', 8, 'access_token', 'b257c4e5f65e339433059367a3d078a58ddf5722e019a56513e3b2bc98f00da5', '[\"*\"]', '2024-01-19 11:22:45', NULL, '2024-01-03 23:33:01', '2024-01-19 11:22:45'),
(9, 'App\\Models\\User', 9, 'access_token', '87d92cfc530e96ab5f790b6895a406c1058fab7fdb2200cd1477e500c306d999', '[\"*\"]', '2024-01-04 19:06:02', NULL, '2024-01-04 19:00:41', '2024-01-04 19:06:02'),
(10, 'App\\Models\\User', 10, 'access_token', 'e80e831914cc7ebe49e3fdb5a4f9e90ecb4113c3f180826d805af773ea52fe75', '[\"*\"]', '2024-01-07 14:02:38', NULL, '2024-01-04 19:08:52', '2024-01-07 14:02:38'),
(11, 'App\\Models\\User', 11, 'access_token', 'e8e497b3636093c3e9cbeba160b0f68e5fa347389db4e3c50bb3b1a95d9274ab', '[\"*\"]', '2024-01-08 20:25:37', NULL, '2024-01-05 19:31:03', '2024-01-08 20:25:37'),
(12, 'App\\Models\\User', 12, 'access_token', '92f07a700dddb4f7fbd63e4f2849be564baa171f68cbbc08aeb089ba4e621e2f', '[\"*\"]', '2024-01-07 21:24:46', NULL, '2024-01-06 17:04:24', '2024-01-07 21:24:46'),
(13, 'App\\Models\\User', 13, 'access_token', '41ce4852e1e5af6b5768738c7d892208f4094268d2624471ec81f26319ad0601', '[\"*\"]', '2024-01-09 19:43:01', NULL, '2024-01-07 14:00:40', '2024-01-09 19:43:01'),
(14, 'App\\Models\\User', 14, 'access_token', '0c5dcf5e89c818cfae948984034aa0cb1c054f3707f3c513a51d7cca7958dde7', '[\"*\"]', '2024-01-07 21:06:06', NULL, '2024-01-07 21:01:39', '2024-01-07 21:06:06'),
(15, 'App\\Models\\User', 15, 'access_token', '489df4188b5534169f2f95f9e9bda9f2dee26c954f3e13f5d1ee426c1cd2e8ce', '[\"*\"]', NULL, NULL, '2024-01-07 23:14:32', '2024-01-07 23:14:32'),
(16, 'App\\Models\\User', 16, 'access_token', '71e82066f24c42df080eb7aae4c4c863a2c33a788601da3737851ccf11c4e8c6', '[\"*\"]', '2024-01-08 18:31:45', NULL, '2024-01-08 18:15:26', '2024-01-08 18:31:45'),
(17, 'App\\Models\\User', 17, 'access_token', '37881d0730ac9b1b5ee2c09bc85f46d7d15c95446eb380a856ea72608e743e8b', '[\"*\"]', '2024-01-17 19:26:02', NULL, '2024-01-08 18:25:28', '2024-01-17 19:26:02'),
(18, 'App\\Models\\User', 18, 'access_token', 'bd8651b9c28792c2a819c403d6fd8e0cedb050b028a85a9351bdbefe3529097f', '[\"*\"]', NULL, NULL, '2024-01-09 13:42:57', '2024-01-09 13:42:57'),
(19, 'App\\Models\\User', 19, 'access_token', '2707a650e51d94984870a0d502e7c00d860f1d73d17137809878f4c5d8b0a273', '[\"*\"]', NULL, NULL, '2024-01-10 19:18:00', '2024-01-10 19:18:00'),
(20, 'App\\Models\\User', 20, 'access_token', '2a9af0c3a20c9a3895fde155769dfab873df6d40c92567effef47ab0d31665a8', '[\"*\"]', '2024-01-14 16:55:51', NULL, '2024-01-14 14:40:26', '2024-01-14 16:55:51'),
(21, 'App\\Models\\User', 21, 'access_token', '10276f33383fa4455cd4aa3d539126114c83f4040e1300703c54ef9d0101e2f1', '[\"*\"]', '2024-01-19 10:31:06', NULL, '2024-01-16 16:23:10', '2024-01-19 10:31:06'),
(22, 'App\\Models\\User', 22, 'access_token', 'f29638466667a6a1a4ce32f73c37610df1d98c78ca6d71b3eba2f2f2588eaae2', '[\"*\"]', NULL, NULL, '2024-01-16 18:06:25', '2024-01-16 18:06:25'),
(23, 'App\\Models\\User', 23, 'access_token', 'fddbc563268fa9187afe9001bacf1cd8369fbde0686d5b6763eea6335aaf1d4d', '[\"*\"]', NULL, NULL, '2024-01-17 06:29:52', '2024-01-17 06:29:52'),
(24, 'App\\Models\\User', 24, 'access_token', '346bfb10c674d55ec9fe67d213a3ace4be0332eaf19da6e0e9b03ebce3675937', '[\"*\"]', NULL, NULL, '2024-01-19 12:14:54', '2024-01-19 12:14:54'),
(25, 'App\\Models\\User', 25, 'access_token', 'f6953dbc5ca34248c27e9c3ab37ee705d7731f5c1675395b4a262818f9d3d874', '[\"*\"]', '2024-01-19 05:50:45', NULL, '2024-01-19 05:47:25', '2024-01-19 05:50:45'),
(26, 'App\\Models\\User', 26, 'access_token', 'e03f7a0259e27870c298a3da8cf3f34fdb43006589b4d533e7aa06ca6fd70822', '[\"*\"]', '2024-01-20 14:56:29', NULL, '2024-01-20 00:35:23', '2024-01-20 14:56:29'),
(27, 'App\\Models\\User', 27, 'access_token', '7daab3a86811a4276ce990a4b4d403eaab3e0b4d00f900dd2130aa9cc8bd2d4b', '[\"*\"]', NULL, NULL, '2024-01-20 03:22:53', '2024-01-20 03:22:53'),
(28, 'App\\Models\\User', 28, 'access_token', '2ab928e74cb5ceaac993f2a266da8729765ec604ba19a50687635abcbeb8863c', '[\"*\"]', '2024-01-20 05:37:52', NULL, '2024-01-20 05:37:21', '2024-01-20 05:37:52'),
(29, 'App\\Models\\User', 29, 'access_token', 'c5843bc044c81305da8adb9cd8963e12d8d71ee1788d1661c44270d6e08c93db', '[\"*\"]', '2024-01-20 10:28:22', NULL, '2024-01-20 10:28:04', '2024-01-20 10:28:22'),
(30, 'App\\Models\\User', 30, 'access_token', '7c620ecd0e61032374c5593d2c280046a189fdad87ab6d37e999d91647d8ef36', '[\"*\"]', '2024-01-20 12:28:28', NULL, '2024-01-20 12:27:40', '2024-01-20 12:28:28'),
(31, 'App\\Models\\User', 31, 'access_token', 'c3810ff85d29f4c1cb4eaffad188d15701e22efe683389aab05aa346447440dc', '[\"*\"]', '2025-04-22 11:01:02', NULL, '2025-03-14 13:58:35', '2025-04-22 11:01:02'),
(32, 'App\\Models\\User', 32, 'access_token', 'ca83a2b7201621c3547834513cf0a7c84a04f6697b03d4edad4215293809a8f5', '[\"*\"]', NULL, NULL, '2025-03-14 20:59:59', '2025-03-14 20:59:59'),
(33, 'App\\Models\\User', 33, 'access_token', '475c2523ca25c4ef5205f7e3197d6d56ef0c9c62ef9684130f408954fe014bad', '[\"*\"]', NULL, NULL, '2025-03-15 16:12:41', '2025-03-15 16:12:41'),
(34, 'App\\Models\\User', 34, 'access_token', 'e8a5c870e2569d515835414a14766b7551edfa553eaaeafa2e405ae7afd629f6', '[\"*\"]', NULL, NULL, '2025-03-16 10:31:18', '2025-03-16 10:31:18'),
(35, 'App\\Models\\User', 35, 'access_token', 'cf0ee07c754510aad4cd497bb1b77a86d123fda69cd9269f456d77f3aba9e812', '[\"*\"]', NULL, NULL, '2025-03-17 04:29:54', '2025-03-17 04:29:54'),
(36, 'App\\Models\\User', 36, 'access_token', '37e869f95bb224da8853f82b66a424ad1c36cee3f8e9c1e5b6467307f0a17d9b', '[\"*\"]', NULL, NULL, '2025-03-18 09:06:39', '2025-03-18 09:06:39'),
(37, 'App\\Models\\User', 37, 'access_token', '69060876ed8a0063a695e70bf4efbaba79943210bdb12bca548f5ae6e3d40da9', '[\"*\"]', NULL, NULL, '2025-03-19 18:08:59', '2025-03-19 18:08:59'),
(38, 'App\\Models\\User', 38, 'access_token', 'f0945e6eaa5d03efd7b98ae544bb69f7d3120707164c8865cae18ea8df298856', '[\"*\"]', NULL, NULL, '2025-03-21 07:04:38', '2025-03-21 07:04:38'),
(39, 'App\\Models\\User', 39, 'access_token', 'd4dcd54db486077519f0a0dcd1eec803eabc89c3b31190f6058e66434288ac41', '[\"*\"]', NULL, NULL, '2025-03-21 22:42:02', '2025-03-21 22:42:02'),
(40, 'App\\Models\\User', 40, 'access_token', 'a08e08f64b0903de997aa5983cc01d1eb965d87093efa5e1a2d601d11793888a', '[\"*\"]', NULL, NULL, '2025-03-22 13:19:28', '2025-03-22 13:19:28'),
(41, 'App\\Models\\User', 41, 'access_token', '473eec02d7ea757dbcce2c3f0a2a22e2afb9a3a1080d2ecd9e03af40e7bd8eb1', '[\"*\"]', NULL, NULL, '2025-03-22 20:43:09', '2025-03-22 20:43:09'),
(42, 'App\\Models\\User', 42, 'access_token', '658d835584fd545d65f8d0a5497f06d5aa511ebc62d4cbb21dc86d6fc28c4c62', '[\"*\"]', NULL, NULL, '2025-03-23 04:04:31', '2025-03-23 04:04:31'),
(43, 'App\\Models\\User', 43, 'access_token', '40820fcf928045a97236860cbdb5ab8df389c690bbdc526479464a45a5df6a43', '[\"*\"]', NULL, NULL, '2025-03-24 11:56:35', '2025-03-24 11:56:35'),
(44, 'App\\Models\\User', 44, 'access_token', 'cefa65089affa7ec78797f6baa9cd79f8475bf677d2a73726c5936e1fa7c35e2', '[\"*\"]', '2025-04-08 11:47:51', NULL, '2025-04-08 11:47:36', '2025-04-08 11:47:51'),
(45, 'App\\Models\\User', 45, 'access_token', '3a4f540e98a6ccc920c364d59b9a92c0a25a0475713d2956470e671a9f894fc4', '[\"*\"]', NULL, NULL, '2025-04-11 08:45:11', '2025-04-11 08:45:11'),
(46, 'App\\Models\\User', 46, 'access_token', 'f81dc86578f14cbc249e96e2a3942df3e178de203a4f72b45cfd5d34b344dc1d', '[\"*\"]', NULL, NULL, '2025-04-15 22:02:54', '2025-04-15 22:02:54'),
(47, 'App\\Models\\User', 47, 'access_token', '59da265b6408f5b00904914572869ab98bf32f30cc180c1b7e5a0dfe52b029d4', '[\"*\"]', '2025-04-21 14:11:58', NULL, '2025-04-21 14:09:05', '2025-04-21 14:11:58'),
(48, 'App\\Models\\User', 48, 'access_token', '2de0376e57a63c3893c2be91940653c8aad26979d1e9c5d39d3d8d6e593da8c1', '[\"*\"]', '2025-08-06 02:56:54', NULL, '2025-04-24 13:24:03', '2025-08-06 02:56:54'),
(49, 'App\\Models\\User', 49, 'access_token', '055a1cd5576cd9a2240d66d5493bd3361265988e3c6c465e943602d066e3d075', '[\"*\"]', NULL, NULL, '2025-05-18 15:04:00', '2025-05-18 15:04:00'),
(50, 'App\\Models\\User', 50, 'access_token', 'b354bba0ccde8aef58cbe1ebad8df2b027490a39f0634b4270e82b4cf73a7c05', '[\"*\"]', NULL, NULL, '2025-05-25 23:35:35', '2025-05-25 23:35:35'),
(51, 'App\\Models\\User', 51, 'access_token', 'a8763ccda40671c2f4c5994809dad39a6d64c2026fd3452050bf9ac86791abdd', '[\"*\"]', NULL, NULL, '2025-06-21 02:49:24', '2025-06-21 02:49:24'),
(52, 'App\\Models\\User', 52, 'access_token', '8603ae828171700f1b359657e0257c8e4468713eae5b893336bdc86deeb07042', '[\"*\"]', NULL, NULL, '2025-06-21 02:51:20', '2025-06-21 02:51:20'),
(53, 'App\\Models\\User', 53, 'access_token', '516131fd034e43c029cb0c7123787b157317216238b080239a487aaa1df2d62b', '[\"*\"]', NULL, NULL, '2025-06-21 03:10:35', '2025-06-21 03:10:35'),
(54, 'App\\Models\\User', 54, 'access_token', 'bbe638bcb006da1197b4d80e8eff397591eaf44bac507fc2094c83330b1587bf', '[\"*\"]', '2025-06-29 02:09:06', NULL, '2025-06-29 02:08:46', '2025-06-29 02:09:06'),
(55, 'App\\Models\\User', 55, 'access_token', '23b83866b3b435540fc76a505296f1e457ca8d54b8f32c4f5f48f0f3b4e276a8', '[\"*\"]', NULL, NULL, '2025-08-06 02:57:14', '2025-08-06 02:57:14'),
(56, 'App\\Models\\User', 56, 'access_token', 'eb13010b8595184648550f7b9fa0ba783cdab0e9505686e300d6642dab1f6384', '[\"*\"]', '2025-08-12 08:19:41', NULL, '2025-08-12 08:19:36', '2025-08-12 08:19:41'),
(57, 'App\\Models\\User', 57, 'access_token', '73f87008ac98ab104031c8273307d9a3b15e0f093a81cb6830dae6d4e274b4cb', '[\"*\"]', '2025-08-12 08:22:41', NULL, '2025-08-12 08:21:24', '2025-08-12 08:22:41'),
(58, 'App\\Models\\User', 58, 'access_token', '62b746b17f52786e76650becc8edd21c4f582aff1b8094df95de7881bb0f0742', '[\"*\"]', NULL, NULL, '2025-08-30 10:40:15', '2025-08-30 10:40:15'),
(59, 'App\\Models\\User', 59, 'access_token', '157d4a3f88ec77cf48067eff06bfa4655edb3111c4e6914e9791a22135a7daba', '[\"*\"]', NULL, NULL, '2025-09-01 12:42:57', '2025-09-01 12:42:57'),
(60, 'App\\Models\\User', 60, 'access_token', '6c7e42e9bf5096c1ce0a4e76005c6dd35bce4790b10a1dc2b94db87b9e89cd1a', '[\"*\"]', NULL, NULL, '2025-10-03 09:52:29', '2025-10-03 09:52:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pin_groups`
--

CREATE TABLE `pin_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `open_type` varchar(255) NOT NULL DEFAULT '_self',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pin_groups`
--

INSERT INTO `pin_groups` (`id`, `name`, `link`, `image`, `status`, `open_type`, `created_at`, `updated_at`) VALUES
(4, 'Facebook Hỗ Trợ Shop', 'https://www.facebook.com/vpnfastvn', '/uploads/22-04-2025/6d66fb25-9156-463c-a46d-dc22951ba4c9.jpg', 1, '_blank', '2025-04-22 09:01:07', '2025-04-24 14:05:53'),
(5, 'Zalo Thông Báo Shop', 'https://zalo.me/0397333616', '/uploads/22-04-2025/05e2ae93-4231-4533-a9da-d8b521c4df03.png', 1, '_blank', '2025-04-22 09:01:56', '2025-04-24 14:05:44'),
(6, 'Mua Code Này', 'https://dichvudark.vip/product/shop-acc-v3-cmsnt-version-6134-moi-nhat', '/uploads/24-04-2025/a7e34d64-ffde-4361-b507-372abaf37354.jpg', 1, '_blank', '2025-04-24 15:08:16', '2025-04-24 15:08:29'),
(7, 'Tạo Shop Giống Này', 'https://khocodevip.com/service/5', '/uploads/24-04-2025/2da425ea-82c6-4922-9793-be7b687d3032.webp', 1, '_blank', '2025-04-24 15:09:15', '2025-04-24 15:09:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `type` varchar(255) NOT NULL DEFAULT 'post',
  `priority` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `author_id` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `resource_v2_s`
--

CREATE TABLE `resource_v2_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'account',
  `domain` varchar(255) DEFAULT NULL,
  `is_bulk` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `extra_data` varchar(1024) DEFAULT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `buyer_code` varchar(255) DEFAULT NULL,
  `buyer_paym` varchar(255) DEFAULT NULL,
  `buyer_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spin_quests`
--

CREATE TABLE `spin_quests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'custom',
  `prizes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `image` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `descr` longtext DEFAULT NULL,
  `price` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `priority` int(11) NOT NULL DEFAULT 0,
  `invar_id` int(11) DEFAULT NULL,
  `play_times` int(11) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `spin_quests`
--

INSERT INTO `spin_quests` (`id`, `name`, `type`, `prizes`, `image`, `cover`, `descr`, `price`, `store_id`, `status`, `priority`, `invar_id`, `play_times`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'custom', '[{\"percent\":\"10\",\"value\":\"0\",\"min\":\"0\",\"max\":\"0\",\"random\":false},{\"percent\":\"10\",\"value\":\"10\",\"min\":\"10\",\"max\":\"10\",\"random\":false},{\"percent\":\"10\",\"value\":\"20\",\"min\":\"20\",\"max\":\"20\",\"random\":false},{\"percent\":\"10\",\"value\":\"30\",\"min\":\"30\",\"max\":\"30\",\"random\":false},{\"percent\":\"10\",\"value\":\"40\",\"min\":\"40\",\"max\":\"40\",\"random\":false},{\"percent\":\"10\",\"value\":\"50\",\"min\":\"50\",\"max\":\"50\",\"random\":false},{\"percent\":\"10\",\"value\":\"60\",\"min\":\"60\",\"max\":\"60\",\"random\":false},{\"percent\":\"10\",\"value\":\"70\",\"min\":\"70\",\"max\":\"70\",\"random\":false}]', '/uploads/22-04-2025/e9aa2c42-89af-4816-9cb4-4bf1dd31964e.png', '/uploads/22-04-2025/f0a88e51-5b52-424d-bf75-1f4b90fb7d4b.gif', '<p><strong>Quay đi</strong></p>', 1000, NULL, 1, 0, 1, 17, NULL, '2025-04-22 08:33:03', '2025-06-29 02:09:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `spin_quest_logs`
--

CREATE TABLE `spin_quest_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `prize` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `content` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `is_fake_data` tinyint(1) NOT NULL DEFAULT 0,
  `spin_quest_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `spin_quest_logs`
--

INSERT INTO `spin_quest_logs` (`id`, `unit`, `prize`, `price`, `status`, `content`, `user_id`, `username`, `is_fake_data`, `spin_quest_id`, `created_at`, `updated_at`) VALUES
(1, 'Robux', '60', 1000, 'Completed', 'Bạn đã nhận được 60 Robux từ trò chơi này!', 31, 'dichvuright', 0, 1, '2025-04-22 08:47:26', '2025-04-22 08:47:26'),
(2, 'Robux', '30', 1000, 'Completed', 'Bạn đã nhận được 30 Robux từ trò chơi này!', 31, 'dichvuright', 0, 1, '2025-04-22 08:52:24', '2025-04-22 08:52:24'),
(3, 'Robux', '0', 1000, 'Completed', 'Bạn đã nhận được 0 Robux từ trò chơi này!', 31, 'dichvuright', 0, 1, '2025-04-22 09:17:10', '2025-04-22 09:17:10'),
(4, 'RB', '70', 1000, 'Completed', 'Bạn đã quay trúng 70 RB!', 31, 'dichvuright', 0, 1, '2025-04-22 10:55:14', '2025-04-22 10:55:14'),
(5, 'RB', '70', 1000, 'Completed', 'Bạn đã quay trúng 70 RB!', 31, 'dichvuright', 0, 1, '2025-04-22 10:55:20', '2025-04-22 10:55:20'),
(6, 'RB', '20', 1000, 'Completed', 'Bạn đã quay trúng 20 RB!', 31, 'dichvuright', 0, 1, '2025-04-22 10:55:25', '2025-04-22 10:55:25'),
(7, 'RB', '60', 1000, 'Completed', 'Bạn đã quay trúng 60 RB!', 48, 'dichvudark', 0, 1, '2025-06-17 03:30:42', '2025-06-17 03:30:42'),
(8, 'RB', '40', 1000, 'Completed', 'Bạn đã quay trúng 40 RB!', 48, 'dichvudark', 0, 1, '2025-06-17 03:30:48', '2025-06-17 03:30:48'),
(9, 'RB', '60', 1000, 'Completed', 'Bạn đã quay trúng 60 RB!', 48, 'dichvudark', 0, 1, '2025-06-17 03:30:48', '2025-06-17 03:30:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `cost_amount` bigint(20) NOT NULL DEFAULT 0,
  `balance_after` bigint(20) NOT NULL,
  `balance_before` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `extras` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `sys_note` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `code`, `amount`, `cost_amount`, `balance_after`, `balance_before`, `type`, `extras`, `order_id`, `sys_note`, `status`, `content`, `user_id`, `username`, `domain`, `created_at`, `updated_at`) VALUES
(18, 'SP3-UB3QY2U', 30000, 0, 30000, 0, 'deposit', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#3: ', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-08 23:51:24', '2024-01-08 23:51:24'),
(19, 'GB-LATH3RYR', 30000, 0, 0, 30000, 'boosting-buy', '{\"group_id\":10,\"package_id\":125}', NULL, NULL, 'paid', 'Thuê gói cày Soul; Nhóm Haze Piece', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-08 23:52:07', '2024-01-08 23:52:07'),
(20, 'CARD-2F0WN1', 16000, 0, 16000, 0, 'deposit', '{\"card_id\":5}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010248033860; phí 20%', 20, 'nguyen', 'haiduongbbs.vn', '2024-01-14 16:35:24', '2024-01-14 16:35:24'),
(21, 'CARD-R9UTJA', 16000, 0, 32000, 16000, 'deposit', '{\"card_id\":6}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010248033855; phí 20%', 20, 'nguyen', 'haiduongbbs.vn', '2024-01-14 16:37:12', '2024-01-14 16:37:12'),
(22, 'OG-KAJJKQFX', 24000, 0, 8000, 32000, 'item-buy', '{\"group_id\":\"5\",\"account_id\":10029}', NULL, NULL, 'paid', 'Mua dịch vụ 1000000 Gem (1M gem); Nhóm Gem và Item Pet99', 20, 'nguyen', 'haiduongbbs.vn', '2024-01-14 16:37:47', '2024-01-14 16:37:47'),
(23, 'SP3-MCLHM38', 48000, 0, 48000, 0, 'deposit', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-15 13:52:34', '2024-01-15 13:52:34'),
(24, 'SP3-SFUMLFELUS', 48000, 0, 0, 48000, 'admin-change', '{\"reason\":\"\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', 'haiduongbbs.vn', '2024-01-15 13:53:12', '2024-01-15 13:53:12'),
(25, 'SP3-JP3LPPQ', 80000, 0, 80000, 0, 'deposit', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', NULL, '2024-01-16 13:48:18', '2024-01-16 13:48:18'),
(26, 'SP3-DFYARNPCVL', 80000, 0, 0, 80000, 'admin-change', '{\"reason\":\"\"}', NULL, NULL, 'paid', '#4: ', 3, 'friendshipz', NULL, '2024-01-17 08:36:49', '2024-01-17 08:36:49'),
(27, 'CARD-N0GYL4', 80000, 0, 80000, 0, 'deposit', '{\"card_id\":7}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010539707356; phí 20%', 21, 'longla22', NULL, '2024-01-19 10:01:25', '2024-01-19 10:01:25'),
(28, 'CARD-ZPXKFD', 80000, 0, 160000, 80000, 'deposit', '{\"card_id\":8}', NULL, NULL, 'paid', 'Nạp thẻ thành công #10010539707351; phí 20%', 21, 'longla22', NULL, '2024-01-19 10:04:20', '2024-01-19 10:04:20'),
(29, 'OG-MTANFB3B', 150000, 0, 10000, 160000, 'item-buy', '{\"group_id\":\"3\",\"account_id\":100}', NULL, NULL, 'paid', 'Mua dịch vụ Upgraded Titan Cinemaman; Nhóm Tollet Tower Defense', 21, 'longla22', NULL, '2024-01-19 10:06:25', '2024-01-19 10:06:25'),
(30, 'ATM-GMEKRX1', 10000, 0, 10000, 0, 'deposit', '{\"amount\":10000,\"description\":\"IBFT NAPSHOP26 GD 173791-012024 21:30:13\",\"transactionID\":2982,\"transactionDate\":1705856400000}', '2982', NULL, 'paid', 'AUTO Deposit ACB - 2982 - Rev: 10.000 ₫ - Discount: 0%', 26, 'admin123', 'shopkhanhori.com', '2024-01-20 14:55:41', '2024-01-20 14:55:41'),
(31, 'ATM-YP8RLDK', 10000, 0, 20000, 10000, 'deposit', '{\"amount\":10000,\"description\":\"IBFT NAPSHOP26 GD 252633-012024 09:17:10\",\"transactionID\":2975,\"transactionDate\":1705683600000}', '2975', NULL, 'paid', 'AUTO Deposit ACB - 2975 - Rev: 10.000 ₫ - Discount: 0%', 26, 'admin123', 'shopkhanhori.com', '2024-01-20 14:55:41', '2024-01-20 14:55:41'),
(32, 'ATM-GK5QIA0', 9000, 0, 29000, 20000, 'deposit', '{\"amount\":9000,\"description\":\"IBFT napshop26 GD 197285-012024 21:58:10\",\"transactionID\":2983,\"transactionDate\":1705856400000}', '2983', NULL, 'paid', 'AUTO Deposit ACB - 2983 - Rev: 9.000 ₫ - Discount: 0%', 26, 'admin123', 'shopkhanhori.com', '2024-01-20 14:58:26', '2024-01-20 14:58:26'),
(33, 'SP3-JAAXRXG', 100000000, 0, 100000000, 0, 'deposit-bank', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#31: ', 31, 'dichvuright', NULL, '2025-04-22 08:47:20', '2025-04-22 08:47:20'),
(34, 'MNG-OSCPD4Q', 1000, 0, 99999000, 100000000, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 60 Robux', 31, 'dichvuright', NULL, '2025-04-22 08:47:26', '2025-04-22 08:47:26'),
(35, 'MNG-OGI1Y8T', 1000, 0, 99998000, 99999000, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 30 Robux', 31, 'dichvuright', NULL, '2025-04-22 08:52:24', '2025-04-22 08:52:24'),
(36, 'MNG-ZCHPQ70', 1000, 0, 99997000, 99998000, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 0 Robux', 31, 'dichvuright', NULL, '2025-04-22 09:17:10', '2025-04-22 09:17:10'),
(37, 'Y1-N35VLBE7', 100, 111, 99996900, 99997000, 'account-buy', '{\"code\":\"37155133\",\"group_id\":\"3\",\"account_id\":6}', NULL, NULL, 'paid', 'Mua tài khoản #37155133; Nhóm NICK GIÁ RẺ', 31, 'dichvuright', NULL, '2025-04-22 09:52:24', '2025-04-22 09:52:24'),
(38, 'Y2-XBQ6VEV1', 99, 100, 99996801, 99996900, 'account-v2-buy', '{\"code\":\"1\",\"group_id\":\"1\",\"account_id\":2}', NULL, NULL, 'paid', '[V2] Mua tài khoản #1; Nhóm Cv2', 31, 'dichvuright', NULL, '2025-04-22 10:21:55', '2025-04-22 10:21:55'),
(39, 'MNG-VZ6I6ZF', 1000, 0, 99995801, 99996801, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 70 RB', 31, 'dichvuright', NULL, '2025-04-22 10:55:14', '2025-04-22 10:55:14'),
(40, 'MNG-0KBNMQK', 1000, 0, 99994801, 99995801, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 70 RB', 31, 'dichvuright', NULL, '2025-04-22 10:55:20', '2025-04-22 10:55:20'),
(41, 'MNG-I60QMKY', 1000, 0, 99993801, 99994801, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 20 RB', 31, 'dichvuright', NULL, '2025-04-22 10:55:25', '2025-04-22 10:55:25'),
(42, 'SP3-PKM6KCP', 2000000, 0, 2000000, 0, 'deposit-bank', '{\"reason\":\"\",\"change\":\"admin-change\"}', NULL, NULL, 'paid', '#48: ', 48, 'dichvudark', NULL, '2025-06-17 03:29:46', '2025-06-17 03:29:46'),
(43, 'Y1-YECR0M63', 100, 222, 1999900, 2000000, 'account-buy', '{\"code\":\"71038779\",\"group_id\":\"4\",\"account_id\":7}', NULL, NULL, 'paid', 'Mua tài khoản #71038779; Nhóm ACC 499K SALE CÒN 30K', 48, 'dichvudark', NULL, '2025-06-17 03:30:11', '2025-06-17 03:30:11'),
(44, 'Y1-GG6QTMVD', 5000, 9000, 1994900, 1999900, 'account-buy', '{\"code\":\"74936723\",\"group_id\":\"2\",\"account_id\":5}', NULL, NULL, 'paid', 'Mua tài khoản #74936723; Nhóm MUA NICK FREE FIRE SIÊU RẺ', 48, 'dichvudark', NULL, '2025-06-17 03:30:31', '2025-06-17 03:30:31'),
(45, 'MNG-DYBWGJC', 1000, 0, 1993900, 1994900, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 60 RB', 48, 'dichvudark', NULL, '2025-06-17 03:30:42', '2025-06-17 03:30:42'),
(46, 'MNG-FJ5O47Q', 1000, 0, 1992900, 1993900, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 40 RB', 48, 'dichvudark', NULL, '2025-06-17 03:30:48', '2025-06-17 03:30:48'),
(47, 'MNG-NDWYBHO', 1000, 0, 1991900, 1992900, 'play-game', '{\"id\":1,\"type\":\"spin-quest\"}', NULL, NULL, 'paid', 'Chơi trò chơi test, rev: 60 RB', 48, 'dichvudark', NULL, '2025-06-17 03:30:48', '2025-06-17 03:30:48'),
(48, 'Y1-QFC6MA6S', 10000, 10000, 1981900, 1991900, 'account-buy', '{\"code\":\"25077567\",\"group_id\":\"17\",\"account_id\":13}', NULL, NULL, 'paid', 'Mua tài khoản #25077567; Nhóm Test', 48, 'dichvudark', NULL, '2025-07-04 15:19:32', '2025-07-04 15:19:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `balance` decimal(16,2) NOT NULL DEFAULT 0.00,
  `balance_1` decimal(16,2) NOT NULL DEFAULT 0.00,
  `balance_2` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_deposit` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_withdraw` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `colla_type` varchar(255) DEFAULT NULL,
  `colla_percent` int(11) NOT NULL DEFAULT 0,
  `colla_balance` decimal(16,2) NOT NULL DEFAULT 0.00,
  `colla_pending` int(11) NOT NULL DEFAULT 0,
  `colla_withdraw` int(11) NOT NULL DEFAULT 0,
  `referral_by` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `register_by` varchar(255) DEFAULT NULL,
  `register_ip` varchar(255) DEFAULT NULL,
  `received_gift` tinyint(1) NOT NULL DEFAULT 0,
  `last_action` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `staff_group_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`staff_group_ids`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `avatar`, `balance`, `balance_1`, `balance_2`, `total_deposit`, `total_withdraw`, `status`, `role`, `colla_type`, `colla_percent`, `colla_balance`, `colla_pending`, `colla_withdraw`, `referral_by`, `referral_code`, `email_verified_at`, `access_token`, `ip_address`, `register_by`, `register_ip`, `received_gift`, `last_action`, `remember_token`, `created_at`, `updated_at`, `last_login_ip`, `last_login_at`, `staff_group_ids`) VALUES
(49, 'JasnyjTut', '$2y$10$R.fW.QrnJ3eCRse0fSDFr.Ar7wgkGmKThzv/CRgYm5QJu9sDrtt2K', NULL, 'tog@bubuk.site', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'NG0zGJ6CkT4b', NULL, 'hRwwYvifyWrUOAdrTy8D9ktBkRcMAADTNsWb8dz839e63849', NULL, 'WEB', '176.56.185.96', 0, NULL, NULL, '2025-05-18 15:04:00', '2025-05-18 15:04:00', NULL, NULL, NULL),
(50, 'Normanzew', '$2y$10$p640KLA6np8aJ0K8BtjoCe1U/gpyUmoMC8xOUbjlyEZfPWH70nA/S', NULL, '1748216135@bloxv4.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'czM9rfanPpRG', NULL, 'VQjJUOUiiRBjvs4f2S7aKI9xYj1wn0MOvFPPWiKR60d6b5fe', '31.129.170.42', 'WEB', '31.129.170.42', 0, NULL, NULL, '2025-05-25 23:35:35', '2025-05-25 23:35:35', NULL, NULL, NULL),
(51, 'namduong26092009', '$2y$10$pOJDSaFUn16Xl./sXf7c4.3ArFQZGaDJI3iUjipA7/75Fw7gnrTzS', NULL, 'namduong26092009@gmail.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'JPvwSdBZH5Fx', NULL, '9pJu6dcS6W1jhUUqu7j55CrldW1bG7PsHKofqjJrebaa0a4e', '117.6.23.197', 'WEB', '117.6.23.197', 0, NULL, NULL, '2025-06-21 02:49:24', '2025-06-21 02:49:24', NULL, NULL, NULL),
(52, 'admin11', '$2y$10$O/1Kvzkh2lsTvGoFQD7GHOXjSs5s5NF.ODw4gAsQs10VlPte0C1q.', NULL, 'chunamduong123@gmail.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'djqD0yHWEZyF', NULL, 'hJSWtQfVc9nuZiN05yPo3WSIIoPf0XVG6vJWjh7D331330f5', '117.6.23.197', 'WEB', '117.6.23.197', 0, NULL, NULL, '2025-06-21 02:51:20', '2025-06-21 02:51:20', NULL, NULL, NULL),
(53, 'cailonma', '$2y$10$FPnDTWn3.04F7tvOGuQQSeGtHA5wMz3dpLwP8Rdw9XllREgBiUTs.', NULL, 'hahha@gmail.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'WmFdqip8jyy8', NULL, 'ZJOWmKYWmbyrxr9f1zyDuDMoqDbFiclKfaak1j3e9f31d826', '117.6.23.197', 'WEB', '117.6.23.197', 0, NULL, NULL, '2025-06-21 03:10:35', '2025-06-21 03:10:35', NULL, NULL, NULL),
(54, 'admin11222', '$2y$10$Toa8uQEzxirIIHQFIdcB3uZdicC/EcgRY7KzoGZuKkuewYSh8kPom', NULL, 'cainitduongsama@gmail.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'i7UJk5pEQ4q7', NULL, '8JcdFfmvB76qtROsLy8aqoydhKVWE914JNLofWDz87b1afbc', '171.224.219.151', 'WEB', '171.224.219.151', 0, NULL, NULL, '2025-06-29 02:08:46', '2025-06-29 02:08:46', NULL, NULL, NULL),
(55, 'khanhdzme', '$2y$10$JjNB3PAuaqAuBdWu1E4SRu1EKSZcuIYtN6GC4u06py/6krQ8mg5uS', NULL, 'khanhdzme@gmail.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'admin', NULL, 0, 0.00, 0, 0, NULL, 'YdpLYc9CDULp', NULL, '6FB5KZwQ3Qnt4oeU1Y8CCQ5RaZByg5Jpm3fTix7o7b9cb25e', '115.79.170.81', 'WEB', '27.75.166.122', 0, NULL, NULL, '2025-08-06 02:57:14', '2025-10-20 08:46:58', '115.79.170.81', '2025-10-20 08:46:58', NULL),
(56, 'Adminooo', '$2y$10$0AekvUOpPnuwp/NBVKokE.khWZGYUID07CfT1XUMcGSuKvO2dwkSK', NULL, '1754986776@bloxv4.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'AIlhkIhfwgHB', NULL, '9pa5T4gti9mFH28Z5Wh5mE55uxPtY9YfwocTq5fCce6d2ae7', '2405:4802:c3b5:91d0:ed3f:5478:e9d0:5b93', 'WEB', '2405:4802:c3b5:91d0:ed3f:5478:e9d0:5b93', 1, NULL, NULL, '2025-08-12 08:19:36', '2025-08-12 08:19:41', NULL, NULL, NULL),
(57, 'DICHVUDARK', '$2y$10$scUMWO3BXrUhjQFgR7367OT9L683ZfTmIm/VQ4Ysewto./UV6ByPG', NULL, '1754986884@bloxv4.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'QynhsbdasAZZ', NULL, 'CdLI5zxxVEePRDrqEWU8Lz14n9uhMfuWJzmNXX7Eb19fb573', '2405:4802:c3b5:91d0:ed3f:5478:e9d0:5b93', 'WEB', '2405:4802:c3b5:91d0:ed3f:5478:e9d0:5b93', 1, NULL, NULL, '2025-08-12 08:21:24', '2025-08-12 08:23:00', '2405:4802:c3b5:91d0:ed3f:5478:e9d0:5b93', '2025-08-12 08:23:00', NULL),
(58, '2ds3a1da', '$2y$10$6NFqyzKcwnHK.wd7An.wk.T7QLaCdI2Jw5I7WK/7vIOTiMPbaDDEu', NULL, '1756550415@bloxv4.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'tKknZWr940bl', NULL, 'VlMhxXpYkMh4k3SDas6VgLI1ihnWEIp9zMXAkuQUb60a4417', '1.53.126.129', 'WEB', '1.53.126.129', 0, NULL, NULL, '2025-08-30 10:40:15', '2025-08-30 10:40:15', NULL, NULL, NULL),
(59, '123123143214', '$2y$10$qJLKidQS528E/qkLZA6vz.Z1XeYjaGMFESF7w/ukzAFezTcEDXHHi', NULL, '1756730577@bloxv4.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'IiiqiOefMBZK', NULL, 'JZnUSh0Qcv6z3CAghUCbEGqou0x2dCLCXkryyC470c57df03', '1.53.126.129', 'WEB', '1.53.126.129', 0, NULL, NULL, '2025-09-01 12:42:57', '2025-09-01 12:42:57', NULL, NULL, NULL),
(60, 'hoangdeptraihh', '$2y$10$ATlLCDERr17wqrOYssBSU.CJoUPydseImqHjCJ4h3UMriBrUQpjbW', NULL, 'thaitamnguyen052@gmail.com', NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 'active', 'user', NULL, 0, 0.00, 0, 0, NULL, 'gvrEEBlmGUbV', NULL, 'u9Sy0YlUrMkzUL3axNfSwxoTGviNKJXrY8hDVXjZb7ad9875', '2001:ee0:458d:aa10:f813:212:884d:6bd7', 'WEB', '2001:ee0:458d:aa10:f813:212:884d:6bd7', 0, NULL, NULL, '2025-10-03 09:52:29', '2025-10-03 09:52:29', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wallet_logs`
--

CREATE TABLE `wallet_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'default',
  `amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sys_note` varchar(255) DEFAULT NULL,
  `user_note` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `user_action` varchar(255) NOT NULL,
  `withdraw_detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`withdraw_detail`)),
  `channel_charge` varchar(255) DEFAULT NULL,
  `balance_before` int(11) NOT NULL DEFAULT 0,
  `balance_after` int(11) NOT NULL DEFAULT 0,
  `ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `withdraw_data`
--

CREATE TABLE `withdraw_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `after_value` int(11) NOT NULL,
  `before_value` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `var_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `user_inputs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`user_inputs`)),
  `admin_note` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `withdraw_data`
--

INSERT INTO `withdraw_data` (`id`, `code`, `type`, `after_value`, `before_value`, `name`, `unit`, `amount`, `var_id`, `inv_id`, `status`, `user_inputs`, `admin_note`, `user_id`, `username`, `created_at`, `updated_at`) VALUES
(1, 'UT-S4KJDDR', 'withdraw', 151, 181, 'Roblox', 'RB', 30, 1, 1, 'Approved', '[{\"label\":\"T\\u00e0i kho\\u1ea3n\",\"type\":\"text\",\"value\":\"khanh\"},{\"label\":\"M\\u1eadt kh\\u1ea9u\",\"type\":\"password\",\"value\":\"dz\"}]', 'done', 31, 'dichvuright', '2025-04-22 10:55:43', '2025-04-22 10:56:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `withdraw_logs`
--

CREATE TABLE `withdraw_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `user_note` varchar(255) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `current_balance` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `withdraw_logs`
--

INSERT INTO `withdraw_logs` (`id`, `unit`, `value`, `status`, `user_note`, `admin_note`, `user_id`, `username`, `current_balance`, `created_at`, `updated_at`) VALUES
(1, 'Robux', '10', 'Completed', 'ok|ok', NULL, 31, 'dichvuright', 80, '2025-04-22 10:58:26', '2025-04-22 10:59:53');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `affiliate_users`
--
ALTER TABLE `affiliate_users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `api_configs`
--
ALTER TABLE `api_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_configs_name_unique` (`name`);

--
-- Chỉ mục cho bảng `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bulk_orders`
--
ALTER TABLE `bulk_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `card_lists`
--
ALTER TABLE `card_lists`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `category_v2_s`
--
ALTER TABLE `category_v2_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_v2_s_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `colla_transactions`
--
ALTER TABLE `colla_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colla_transactions_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `colla_withdraws`
--
ALTER TABLE `colla_withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colla_withdraws_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `group_v2_s`
--
ALTER TABLE `group_v2_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_v2_s_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `g_b_categories`
--
ALTER TABLE `g_b_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `g_b_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `g_b_groups`
--
ALTER TABLE `g_b_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `g_b_groups_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `g_b_orders`
--
ALTER TABLE `g_b_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `g_b_packages`
--
ALTER TABLE `g_b_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `g_b_packages_code_unique` (`code`);

--
-- Chỉ mục cho bảng `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ingames`
--
ALTER TABLE `ingames`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `inventory_vars`
--
ALTER TABLE `inventory_vars`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_code_unique` (`code`);

--
-- Chỉ mục cho bảng `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `item_data`
--
ALTER TABLE `item_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_data_code_unique` (`code`);

--
-- Chỉ mục cho bảng `item_groups`
--
ALTER TABLE `item_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_groups_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_orders_code_unique` (`code`);

--
-- Chỉ mục cho bảng `list_items`
--
ALTER TABLE `list_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `list_items_code_unique` (`code`);

--
-- Chỉ mục cho bảng `list_item_archives`
--
ALTER TABLE `list_item_archives`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_item_v2_s`
--
ALTER TABLE `list_item_v2_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `list_item_v2_s_code_unique` (`code`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `pin_groups`
--
ALTER TABLE `pin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `resource_v2_s`
--
ALTER TABLE `resource_v2_s`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `spin_quests`
--
ALTER TABLE `spin_quests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `spin_quest_logs`
--
ALTER TABLE `spin_quest_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spin_quest_logs_user_id_foreign` (`user_id`),
  ADD KEY `spin_quest_logs_spin_quest_id_foreign` (`spin_quest_id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wallet_logs`
--
ALTER TABLE `wallet_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `withdraw_data`
--
ALTER TABLE `withdraw_data`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraw_logs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `affiliate_users`
--
ALTER TABLE `affiliate_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `api_configs`
--
ALTER TABLE `api_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `bulk_orders`
--
ALTER TABLE `bulk_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `card_lists`
--
ALTER TABLE `card_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `category_v2_s`
--
ALTER TABLE `category_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `colla_transactions`
--
ALTER TABLE `colla_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `colla_withdraws`
--
ALTER TABLE `colla_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `group_v2_s`
--
ALTER TABLE `group_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `g_b_categories`
--
ALTER TABLE `g_b_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `g_b_groups`
--
ALTER TABLE `g_b_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `g_b_orders`
--
ALTER TABLE `g_b_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `g_b_packages`
--
ALTER TABLE `g_b_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT cho bảng `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=683;

--
-- AUTO_INCREMENT cho bảng `ingames`
--
ALTER TABLE `ingames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `inventory_vars`
--
ALTER TABLE `inventory_vars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `item_data`
--
ALTER TABLE `item_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10091;

--
-- AUTO_INCREMENT cho bảng `item_groups`
--
ALTER TABLE `item_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `item_orders`
--
ALTER TABLE `item_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `list_items`
--
ALTER TABLE `list_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `list_item_archives`
--
ALTER TABLE `list_item_archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `list_item_v2_s`
--
ALTER TABLE `list_item_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `pin_groups`
--
ALTER TABLE `pin_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `resource_v2_s`
--
ALTER TABLE `resource_v2_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `spin_quests`
--
ALTER TABLE `spin_quests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `spin_quest_logs`
--
ALTER TABLE `spin_quest_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `wallet_logs`
--
ALTER TABLE `wallet_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `withdraw_data`
--
ALTER TABLE `withdraw_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `colla_transactions`
--
ALTER TABLE `colla_transactions`
  ADD CONSTRAINT `colla_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ràng buộc cho bảng `colla_withdraws`
--
ALTER TABLE `colla_withdraws`
  ADD CONSTRAINT `colla_withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ràng buộc cho bảng `spin_quest_logs`
--
ALTER TABLE `spin_quest_logs`
  ADD CONSTRAINT `spin_quest_logs_spin_quest_id_foreign` FOREIGN KEY (`spin_quest_id`) REFERENCES `spin_quests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
