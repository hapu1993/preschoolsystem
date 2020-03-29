/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : pre_school_db

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 29/03/2020 00:30:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absence_letters
-- ----------------------------
DROP TABLE IF EXISTS `absence_letters`;
CREATE TABLE `absence_letters`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  `from` datetime(0) NOT NULL,
  `to` datetime(0) NOT NULL,
  `reason` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of absence_letters
-- ----------------------------
INSERT INTO `absence_letters` VALUES (1, '12345', NULL, '2020-03-05 00:00:00', '2020-03-12 00:00:00', 'edeeeeeeeeeeeeeeee', '2020-03-12 19:06:53', '2020-03-12 19:06:53');
INSERT INTO `absence_letters` VALUES (2, '12345', NULL, '2020-03-05 00:00:00', '2020-03-07 00:00:00', 'ccccccccccccccccc', '2020-03-12 19:11:24', '2020-03-12 19:11:24');
INSERT INTO `absence_letters` VALUES (3, '1', NULL, '2020-03-10 00:00:00', '2020-03-05 00:00:00', 'ddcdcdddcd', '2020-03-26 16:50:45', '2020-03-26 16:50:45');
INSERT INTO `absence_letters` VALUES (4, '{\"id\":1,\"reg_no\":\"123456\",\"name\":\"Dilki\",\"class_id\":1,\"level_id\":1,\"created_at\":null,\"updated_at\":null,\"parent_id\":0}', 1, '2020-03-06 00:00:00', '2020-03-03 00:00:00', 'sddsc', '2020-03-26 16:59:39', '2020-03-26 16:59:39');

-- ----------------------------
-- Table structure for attendences
-- ----------------------------
DROP TABLE IF EXISTS `attendences`;
CREATE TABLE `attendences`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `date` datetime(0) NOT NULL,
  `attend` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of attendences
-- ----------------------------
INSERT INTO `attendences` VALUES (5, 1, '2020-03-28 00:00:00', 0, '2020-03-28 17:16:16', '2020-03-28 18:05:25');
INSERT INTO `attendences` VALUES (6, 2, '2020-03-28 00:00:00', 1, '2020-03-28 17:16:17', '2020-03-28 17:22:37');
INSERT INTO `attendences` VALUES (7, 1, '2020-03-27 00:00:00', 0, '2020-03-28 17:22:06', '2020-03-28 17:22:48');
INSERT INTO `attendences` VALUES (8, 2, '2020-03-27 00:00:00', 1, '2020-03-28 17:22:06', '2020-03-28 17:35:20');
INSERT INTO `attendences` VALUES (9, 1, '2020-03-20 00:00:00', 1, '2020-03-28 17:26:18', '2020-03-28 17:47:14');
INSERT INTO `attendences` VALUES (10, 2, '2020-03-20 00:00:00', 1, '2020-03-28 17:26:18', '2020-03-28 17:47:14');
INSERT INTO `attendences` VALUES (11, 1, '2020-03-10 00:00:00', 1, '2020-03-28 17:39:10', '2020-03-28 17:39:10');
INSERT INTO `attendences` VALUES (12, 2, '2020-03-10 00:00:00', 1, '2020-03-28 17:39:10', '2020-03-28 17:39:10');
INSERT INTO `attendences` VALUES (13, 1, '2020-03-26 00:00:00', 1, '2020-03-28 17:47:58', '2020-03-28 17:47:58');
INSERT INTO `attendences` VALUES (14, 2, '2020-03-26 00:00:00', 1, '2020-03-28 17:47:58', '2020-03-28 17:47:58');

-- ----------------------------
-- Table structure for classes
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES (1, 'A', NULL, NULL);

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime(0) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES (1, 'UPPER', NULL, NULL);
INSERT INTO `levels` VALUES (2, 'DOWN', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_03_12_171202_create_teacher_class_map_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_03_12_171334_create_students_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_03_12_171359_create_attendences_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_03_12_171429_create_absence_letters_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_03_12_171806_create_classes_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_03_12_171824_create_levels_table', 1);
INSERT INTO `migrations` VALUES (10, '2020_03_12_172345_create_events_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_03_12_173105_create_roles_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_03_26_161326_add_parent_id_to_students_table', 2);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'Teacher', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'Parent', NULL, NULL);

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (1, '123456', 'Dilki', 1, 1, NULL, NULL, 2);
INSERT INTO `students` VALUES (2, '67890', 'Kasun', 1, 1, NULL, NULL, 3);

-- ----------------------------
-- Table structure for teacher_class_map
-- ----------------------------
DROP TABLE IF EXISTS `teacher_class_map`;
CREATE TABLE `teacher_class_map`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of teacher_class_map
-- ----------------------------
INSERT INTO `teacher_class_map` VALUES (1, 3, 1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `role` int(11) NOT NULL COMMENT '1-admin 2-teacher 3-parent',
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Pre School Admin', 'preschooladmin@gmail.com', NULL, 1, '$2y$10$f0iIW/AYc8fvBSvdxBnfMuobXSKArCpZjVyu3T6qx0LSbzarcvDpu', NULL, '2020-03-12 17:55:24', '2020-03-12 17:55:24');
INSERT INTO `users` VALUES (2, 'Pre School Parent 1', 'parent1@gmail.com', NULL, 3, '$2y$10$SF83.mWTE1MAoCSOuslu0uNyXxk7WRuBIvn4IJBVaKcoAkx6Es.Fy', NULL, '2020-03-12 18:00:06', '2020-03-12 18:00:06');
INSERT INTO `users` VALUES (3, 'Pre School Teacher 1', 'teacher1@gmail.com', NULL, 2, '$2y$10$SF83.mWTE1MAoCSOuslu0uNyXxk7WRuBIvn4IJBVaKcoAkx6Es.Fy', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
