-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 20, 2024 lúc 10:29 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `be`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$8OyCU72FuEhlD.oYMiA/i..Ny5fkyIoD37e3lOAS7UWvZ1RlFrmBi', NULL, '2024-06-20 02:54:26', '2024-06-20 02:54:26');

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
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(2, 27, 61, '2024-06-12 01:48:54', '2024-06-12 01:48:54');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_19_074449_create_permission_tables', 1),
(6, '2024_04_23_020815_create_post_table', 1),
(7, '2024_04_23_031534_rename_table', 1),
(8, '2024_04_26_034729_add_public_status_to_post_table', 1),
(9, '2024_06_10_064815_add_is_user_to_user_table', 1),
(10, '2024_06_10_065152_create_table_admin', 1),
(11, '2024_05_02_084645_create_sessions_table', 2),
(12, '2024_06_10_085646_delete_admin_table', 2),
(13, '2024_06_10_085905_delete_sessins_table', 3),
(14, '2024_06_11_025826_remove_is_user_from_users', 4),
(15, '2024_06_12_021257_create_like_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 4),
(2, 'Modules\\User\\src\\Models\\User', 25),
(2, 'Modules\\User\\src\\Models\\User', 32),
(3, 'Modules\\Admin\\src\\Models\\Admin', 1),
(3, 'Modules\\User\\src\\Models\\User', 26),
(3, 'Modules\\User\\src\\Models\\User', 40),
(3, 'Modules\\User\\src\\Models\\User', 41),
(3, 'Modules\\User\\src\\Models\\User', 42);

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
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(5, 'permission-edit', 'admin', '2024-04-11 19:35:02', '2024-04-11 19:35:02'),
(7, 'user-edit', 'admin', '2024-04-22 20:07:29', '2024-04-22 20:20:09'),
(8, 'user-create', 'admin', '2024-04-22 20:07:44', '2024-04-22 20:07:52'),
(9, 'user-list', 'admin', '2024-04-22 20:08:02', '2024-04-22 20:08:02'),
(10, 'user-delete', 'admin', '2024-04-22 20:08:13', '2024-04-22 20:08:13'),
(11, 'permission-list', 'admin', '2024-04-22 20:08:26', '2024-04-22 20:08:26'),
(13, 'permission-delete', 'admin', '2024-04-23 21:25:28', '2024-04-23 21:25:28'),
(14, 'role-list', 'admin', '2024-04-23 21:25:57', '2024-04-23 21:25:57'),
(15, 'role-create', 'admin', '2024-04-23 21:26:06', '2024-04-23 21:26:06'),
(16, 'role-edit', 'admin', '2024-04-23 21:26:14', '2024-04-23 21:26:14'),
(17, 'role-delete', 'admin', '2024-04-23 21:26:20', '2024-04-23 21:26:20'),
(18, 'post-list', 'admin', '2024-04-25 00:59:38', '2024-04-25 01:00:38'),
(19, 'post-create', 'admin', '2024-04-25 19:39:18', '2024-04-25 19:39:18'),
(20, 'post-edit', 'admin', '2024-04-25 19:39:36', '2024-04-25 19:39:36'),
(21, 'post-delete', 'admin', '2024-04-25 19:39:44', '2024-04-25 19:39:44');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(3, 'Modules\\User\\src\\Models\\User', 27, 'auth_token', '87cc0fc406f780b0df7cc99c2001b6353e429afc05da7ba5fb0316746eddab8f', '[\"*\"]', '2024-06-13 01:08:01', '2024-06-11 19:58:59', '2024-06-13 01:08:01'),
(5, 'Modules\\User\\src\\Models\\User', 25, 'auth_token', '8de370ee70bd581c5ba0d86f33e4d9097199d178abc1726e067a3eb1dfb44207', '[\"*\"]', '2024-06-19 21:32:46', '2024-06-14 02:43:55', '2024-06-19 21:32:46'),
(7, 'Modules\\User\\src\\Models\\User', 26, 'auth_token', '9489d861e130ea0c7551ce5a6bbd81ccb8627e6b9c591f2b82af7e169c2d9ef4', '[\"*\"]', '2024-06-19 19:37:31', '2024-06-17 01:18:02', '2024-06-19 19:37:31'),
(8, 'Modules\\Admin\\src\\Models\\Admin', 1, 'auth_token', '6144612b1575a7e32c5f8231d023d47c49c45a92a1529201c8c62bf348ef407e', '[\"*\"]', '2024-06-20 00:38:10', '2024-06-19 20:01:41', '2024-06-20 00:38:10'),
(9, 'Modules\\User\\src\\Models\\Admin', 1, 'auth_token', '14556a1ec0518c692832a403639be2d790e51db45eb0aa2534effe23faf118e0', '[\"*\"]', NULL, '2024-06-19 20:12:24', '2024-06-19 20:12:24'),
(10, 'Modules\\User\\src\\Models\\Admin', 1, 'auth_token', '3f8420d3e94f055e33e2b002f5728fd5896430e2fd56f3c55ed3b04eb5f20ab9', '[\"*\"]', NULL, '2024-06-19 20:19:21', '2024-06-19 20:19:21'),
(11, 'Modules\\User\\src\\Models\\User', 25, 'auth_token_web', '803173f6d3f74ba31c18a6c205343fa50e81cb4bc026fde7184dcbeb95b29578', '[\"*\"]', NULL, '2024-06-19 20:22:20', '2024-06-19 20:22:20'),
(12, 'Modules\\User\\src\\Models\\User', 26, 'auth_token_web', '8cfd01f9e2d269ce6a1d86f2f1ec7f9246aad56cff4ef7fb25e0525f9ecf4c66', '[\"*\"]', NULL, '2024-06-19 20:22:44', '2024-06-19 20:22:44'),
(13, 'Modules\\User\\src\\Models\\Admin', 1, 'auth_token_admin', '95884c5fdfc547ecb17060d3b9f4744e16e65dc3e51e0c31f59e44c99292677e', '[\"*\"]', NULL, '2024-06-19 20:23:56', '2024-06-19 20:23:56'),
(14, 'Modules\\User\\src\\Models\\User', 27, 'auth_token_web', '6cd7a5decde4a40c2ca2ca485c5f1fe7053feb7152010a6d925d6608a3013b8b', '[\"*\"]', NULL, '2024-06-19 21:21:40', '2024-06-19 21:21:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `author` bigint(20) UNSIGNED DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `images`, `author`, `published_at`, `created_at`, `updated_at`, `status`, `slug`) VALUES
(36, 'adf', 'asdfasdf', 'storage/uploads/1714964706.png', 27, '2024-05-06 00:00:00', '2024-05-01 15:01:26', '2024-05-05 13:05:06', 0, ''),
(43, 'abc', '41234', 'storage/uploads/1714966117.png', 27, '2024-05-06 00:00:00', '2024-05-01 17:45:40', '2024-05-05 13:28:37', 1, ''),
(44, '123123', 'AAAAA', NULL, 27, NULL, '2024-06-12 01:07:27', '2024-06-12 01:07:27', 0, ''),
(61, '123123', '123413', 'uploads/132.png', NULL, '2023-06-12 00:00:00', '2024-06-12 01:25:59', '2024-06-12 01:44:26', 0, ''),
(62, 'aaa', '123123', NULL, NULL, NULL, '2024-06-20 00:37:33', '2024-06-20 00:37:33', 0, ''),
(63, 'aaa12341234', '123123', NULL, NULL, NULL, '2024-06-20 00:37:37', '2024-06-20 00:37:37', 0, ''),
(64, 'vu minh hieu', '123123', NULL, NULL, NULL, '2024-06-20 00:37:45', '2024-06-20 00:37:45', 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Writer', 'admin', '2024-06-20 03:04:56', '2024-06-20 03:04:56'),
(3, 'Super Admin', 'admin', '2024-04-12 14:49:41', '2024-04-15 12:58:52'),
(7, 'User', 'admin', '2024-05-03 02:03:29', '2024-05-03 02:03:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(21, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, 'Writer', 'writer@gmail.com', NULL, '$2y$10$W4zONIRD7o9uCwCszqsIUOywV/MNfDT8Oz1J5oYKV4C2MIGsl95WK', NULL, '2024-04-23 20:30:26', '2024-06-19 21:34:40'),
(27, 'User', 'user@gmail.com', NULL, '$2y$10$2bzP3Ngik2uxst7.T51wBuffQ/RZ9DV9CHB5nRH04aKD2CkLHFoUm', NULL, '2024-05-03 02:10:34', '2024-05-03 02:10:34');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_author_foreign` (`author`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
