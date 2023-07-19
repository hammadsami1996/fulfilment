/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantgeo

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 17/07/2023 17:48:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `group_id` int NULL DEFAULT NULL,
  `menu_id` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 158 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (50, NULL, 'web', 'Role', NULL, NULL, 1, '2023-05-16 13:06:11', '2023-05-16 13:06:11');
INSERT INTO `permissions` VALUES (51, 'view-role', 'web', NULL, NULL, 50, NULL, '2023-05-16 13:06:11', '2023-05-16 13:06:11');
INSERT INTO `permissions` VALUES (52, 'edit-role', 'web', NULL, NULL, 50, NULL, '2023-05-16 13:06:11', '2023-05-16 13:06:11');
INSERT INTO `permissions` VALUES (53, 'create-role', 'web', NULL, NULL, 50, NULL, '2023-05-16 13:06:11', '2023-05-16 13:06:11');
INSERT INTO `permissions` VALUES (54, 'delete-role', 'web', NULL, NULL, 50, NULL, '2023-05-16 13:06:11', '2023-05-16 13:06:11');
INSERT INTO `permissions` VALUES (55, 'export-role', 'web', NULL, NULL, 50, NULL, '2023-05-16 13:06:11', '2023-05-16 13:06:11');
INSERT INTO `permissions` VALUES (56, NULL, 'web', NULL, 'Setting', NULL, NULL, '2023-05-16 14:57:14', '2023-05-16 14:57:14');
INSERT INTO `permissions` VALUES (57, NULL, 'web', 'User', NULL, NULL, 56, '2023-05-16 14:57:26', '2023-05-16 14:57:26');
INSERT INTO `permissions` VALUES (58, 'view-user', 'web', NULL, NULL, 57, NULL, '2023-05-16 14:57:26', '2023-05-16 14:57:26');
INSERT INTO `permissions` VALUES (59, 'edit-user', 'web', NULL, NULL, 57, NULL, '2023-05-16 14:57:26', '2023-05-16 14:57:26');
INSERT INTO `permissions` VALUES (60, 'create-user', 'web', NULL, NULL, 57, NULL, '2023-05-16 14:57:26', '2023-05-16 14:57:26');
INSERT INTO `permissions` VALUES (61, 'delete-user', 'web', NULL, NULL, 57, NULL, '2023-05-16 14:57:26', '2023-05-16 14:57:26');
INSERT INTO `permissions` VALUES (62, 'export-user', 'web', NULL, NULL, 57, NULL, '2023-05-16 14:57:26', '2023-05-16 14:57:26');
INSERT INTO `permissions` VALUES (63, NULL, 'web', 'Update_profile', NULL, NULL, 1, '2023-05-24 06:49:35', '2023-05-24 06:49:35');
INSERT INTO `permissions` VALUES (64, 'view-update_profile', 'web', NULL, NULL, 63, NULL, '2023-05-24 06:49:35', '2023-05-24 06:49:35');
INSERT INTO `permissions` VALUES (65, 'edit-update_profile', 'web', NULL, NULL, 63, NULL, '2023-05-24 06:49:35', '2023-05-24 06:49:35');
INSERT INTO `permissions` VALUES (66, 'create-update_profile', 'web', NULL, NULL, 63, NULL, '2023-05-24 06:49:35', '2023-05-24 06:49:35');
INSERT INTO `permissions` VALUES (67, 'delete-update_profile', 'web', NULL, NULL, 63, NULL, '2023-05-24 06:49:35', '2023-05-24 06:49:35');
INSERT INTO `permissions` VALUES (68, 'export-update_profile', 'web', NULL, NULL, 63, NULL, '2023-05-24 06:49:35', '2023-05-24 06:49:35');
INSERT INTO `permissions` VALUES (69, NULL, 'web', 'Permission', NULL, NULL, 1, '2023-05-24 06:58:03', '2023-05-24 06:58:03');
INSERT INTO `permissions` VALUES (70, 'view-permission', 'web', NULL, NULL, 69, NULL, '2023-05-24 06:58:03', '2023-05-24 06:58:03');
INSERT INTO `permissions` VALUES (71, 'edit-permission', 'web', NULL, NULL, 69, NULL, '2023-05-24 06:58:03', '2023-05-24 06:58:03');
INSERT INTO `permissions` VALUES (72, 'create-permission', 'web', NULL, NULL, 69, NULL, '2023-05-24 06:58:03', '2023-05-24 06:58:03');
INSERT INTO `permissions` VALUES (73, 'delete-permission', 'web', NULL, NULL, 69, NULL, '2023-05-24 06:58:03', '2023-05-24 06:58:03');
INSERT INTO `permissions` VALUES (74, 'export-permission', 'web', NULL, NULL, 69, NULL, '2023-05-24 06:58:03', '2023-05-24 06:58:03');
INSERT INTO `permissions` VALUES (75, NULL, 'web', 'Job_user', NULL, NULL, 1, '2023-05-24 07:00:08', '2023-05-24 07:00:08');
INSERT INTO `permissions` VALUES (76, 'view-job_user', 'web', NULL, NULL, 75, NULL, '2023-05-24 07:00:08', '2023-05-24 07:00:08');
INSERT INTO `permissions` VALUES (77, 'edit-job_user', 'web', NULL, NULL, 75, NULL, '2023-05-24 07:00:08', '2023-05-24 07:00:08');
INSERT INTO `permissions` VALUES (78, 'create-job_user', 'web', NULL, NULL, 75, NULL, '2023-05-24 07:00:08', '2023-05-24 07:00:08');
INSERT INTO `permissions` VALUES (79, 'delete-job_user', 'web', NULL, NULL, 75, NULL, '2023-05-24 07:00:08', '2023-05-24 07:00:08');
INSERT INTO `permissions` VALUES (80, 'export-job_user', 'web', NULL, NULL, 75, NULL, '2023-05-24 07:00:08', '2023-05-24 07:00:08');
INSERT INTO `permissions` VALUES (81, NULL, 'web', 'User_dashboard', NULL, NULL, 1, '2023-05-24 07:00:30', '2023-05-24 07:00:30');
INSERT INTO `permissions` VALUES (82, 'view-user_dashboard', 'web', NULL, NULL, 81, NULL, '2023-05-24 07:00:30', '2023-05-24 07:00:30');
INSERT INTO `permissions` VALUES (83, 'edit-user_dashboard', 'web', NULL, NULL, 81, NULL, '2023-05-24 07:00:30', '2023-05-24 07:00:30');
INSERT INTO `permissions` VALUES (84, 'create-user_dashboard', 'web', NULL, NULL, 81, NULL, '2023-05-24 07:00:30', '2023-05-24 07:00:30');
INSERT INTO `permissions` VALUES (85, 'delete-user_dashboard', 'web', NULL, NULL, 81, NULL, '2023-05-24 07:00:30', '2023-05-24 07:00:30');
INSERT INTO `permissions` VALUES (86, 'export-user_dashboard', 'web', NULL, NULL, 81, NULL, '2023-05-24 07:00:30', '2023-05-24 07:00:30');
INSERT INTO `permissions` VALUES (99, NULL, 'web', 'Candidate', NULL, NULL, 1, '2023-05-26 15:09:35', '2023-05-26 15:09:35');
INSERT INTO `permissions` VALUES (100, 'view-candidate', 'web', NULL, NULL, 99, NULL, '2023-05-26 15:09:35', '2023-05-26 15:09:35');
INSERT INTO `permissions` VALUES (101, 'edit-candidate', 'web', NULL, NULL, 99, NULL, '2023-05-26 15:09:35', '2023-05-26 15:09:35');
INSERT INTO `permissions` VALUES (102, 'create-candidate', 'web', NULL, NULL, 99, NULL, '2023-05-26 15:09:36', '2023-05-26 15:09:36');
INSERT INTO `permissions` VALUES (103, 'delete-candidate', 'web', NULL, NULL, 99, NULL, '2023-05-26 15:09:36', '2023-05-26 15:09:36');
INSERT INTO `permissions` VALUES (104, 'export-candidate', 'web', NULL, NULL, 99, NULL, '2023-05-26 15:09:36', '2023-05-26 15:09:36');
INSERT INTO `permissions` VALUES (105, NULL, 'web', 'User_type', NULL, NULL, 1, '2023-05-29 07:53:38', '2023-05-29 07:53:38');
INSERT INTO `permissions` VALUES (106, 'view-user_type', 'web', NULL, NULL, 105, NULL, '2023-05-29 07:53:38', '2023-05-29 07:53:38');
INSERT INTO `permissions` VALUES (107, 'edit-user_type', 'web', NULL, NULL, 105, NULL, '2023-05-29 07:53:38', '2023-05-29 07:53:38');
INSERT INTO `permissions` VALUES (108, 'create-user_type', 'web', NULL, NULL, 105, NULL, '2023-05-29 07:53:38', '2023-05-29 07:53:38');
INSERT INTO `permissions` VALUES (109, 'delete-user_type', 'web', NULL, NULL, 105, NULL, '2023-05-29 07:53:38', '2023-05-29 07:53:38');
INSERT INTO `permissions` VALUES (110, 'export-user_type', 'web', NULL, NULL, 105, NULL, '2023-05-29 07:53:38', '2023-05-29 07:53:38');
INSERT INTO `permissions` VALUES (117, NULL, 'web', 'Apply_job', NULL, NULL, 1, '2023-06-03 06:55:44', '2023-06-03 06:55:44');
INSERT INTO `permissions` VALUES (118, 'view-apply_job', 'web', NULL, NULL, 117, NULL, '2023-06-03 06:55:44', '2023-06-03 06:55:44');
INSERT INTO `permissions` VALUES (119, 'edit-apply_job', 'web', NULL, NULL, 117, NULL, '2023-06-03 06:55:44', '2023-06-03 06:55:44');
INSERT INTO `permissions` VALUES (120, 'create-apply_job', 'web', NULL, NULL, 117, NULL, '2023-06-03 06:55:44', '2023-06-03 06:55:44');
INSERT INTO `permissions` VALUES (121, 'delete-apply_job', 'web', NULL, NULL, 117, NULL, '2023-06-03 06:55:44', '2023-06-03 06:55:44');
INSERT INTO `permissions` VALUES (122, 'export-apply_job', 'web', NULL, NULL, 117, NULL, '2023-06-03 06:55:44', '2023-06-03 06:55:44');
INSERT INTO `permissions` VALUES (123, NULL, 'web', 'Product', NULL, NULL, 56, '2023-07-07 00:06:57', '2023-07-07 00:06:57');
INSERT INTO `permissions` VALUES (124, 'view-product', 'web', NULL, NULL, 123, NULL, '2023-07-07 00:06:57', '2023-07-07 00:06:57');
INSERT INTO `permissions` VALUES (125, 'edit-product', 'web', NULL, NULL, 123, NULL, '2023-07-07 00:06:57', '2023-07-07 00:06:57');
INSERT INTO `permissions` VALUES (126, 'create-product', 'web', NULL, NULL, 123, NULL, '2023-07-07 00:06:57', '2023-07-07 00:06:57');
INSERT INTO `permissions` VALUES (127, 'delete-product', 'web', NULL, NULL, 123, NULL, '2023-07-07 00:06:57', '2023-07-07 00:06:57');
INSERT INTO `permissions` VALUES (128, 'export-product', 'web', NULL, NULL, 123, NULL, '2023-07-07 00:06:57', '2023-07-07 00:06:57');
INSERT INTO `permissions` VALUES (129, NULL, 'web', 'Wearhouse', NULL, NULL, 56, '2023-07-07 01:26:29', '2023-07-07 01:26:29');
INSERT INTO `permissions` VALUES (130, 'view-wearhouse', 'web', NULL, NULL, 129, NULL, '2023-07-07 01:26:29', '2023-07-07 01:26:29');
INSERT INTO `permissions` VALUES (131, 'edit-wearhouse', 'web', NULL, NULL, 129, NULL, '2023-07-07 01:26:29', '2023-07-07 01:26:29');
INSERT INTO `permissions` VALUES (132, 'create-wearhouse', 'web', NULL, NULL, 129, NULL, '2023-07-07 01:26:29', '2023-07-07 01:26:29');
INSERT INTO `permissions` VALUES (133, 'delete-wearhouse', 'web', NULL, NULL, 129, NULL, '2023-07-07 01:26:29', '2023-07-07 01:26:29');
INSERT INTO `permissions` VALUES (134, 'export-wearhouse', 'web', NULL, NULL, 129, NULL, '2023-07-07 01:26:29', '2023-07-07 01:26:29');
INSERT INTO `permissions` VALUES (135, NULL, 'web', 'Stores', NULL, NULL, 56, '2023-07-07 01:51:03', '2023-07-07 01:51:03');
INSERT INTO `permissions` VALUES (136, 'view-stores', 'web', NULL, NULL, 135, NULL, '2023-07-07 01:51:03', '2023-07-07 01:51:03');
INSERT INTO `permissions` VALUES (137, 'edit-stores', 'web', NULL, NULL, 135, NULL, '2023-07-07 01:51:03', '2023-07-07 01:51:03');
INSERT INTO `permissions` VALUES (138, 'create-stores', 'web', NULL, NULL, 135, NULL, '2023-07-07 01:51:03', '2023-07-07 01:51:03');
INSERT INTO `permissions` VALUES (139, 'delete-stores', 'web', NULL, NULL, 135, NULL, '2023-07-07 01:51:03', '2023-07-07 01:51:03');
INSERT INTO `permissions` VALUES (140, 'export-stores', 'web', NULL, NULL, 135, NULL, '2023-07-07 01:51:03', '2023-07-07 01:51:03');
INSERT INTO `permissions` VALUES (141, NULL, 'web', 'Company', NULL, NULL, 56, '2023-07-07 02:10:21', '2023-07-07 02:10:21');
INSERT INTO `permissions` VALUES (142, 'view-company', 'web', NULL, NULL, 141, NULL, '2023-07-07 02:10:21', '2023-07-07 02:10:21');
INSERT INTO `permissions` VALUES (143, 'edit-company', 'web', NULL, NULL, 141, NULL, '2023-07-07 02:10:21', '2023-07-07 02:10:21');
INSERT INTO `permissions` VALUES (144, 'create-company', 'web', NULL, NULL, 141, NULL, '2023-07-07 02:10:21', '2023-07-07 02:10:21');
INSERT INTO `permissions` VALUES (145, 'delete-company', 'web', NULL, NULL, 141, NULL, '2023-07-07 02:10:21', '2023-07-07 02:10:21');
INSERT INTO `permissions` VALUES (146, 'export-company', 'web', NULL, NULL, 141, NULL, '2023-07-07 02:10:21', '2023-07-07 02:10:21');
INSERT INTO `permissions` VALUES (147, NULL, 'web', 'Inventory', NULL, NULL, 56, '2023-07-07 02:41:08', '2023-07-07 02:41:08');
INSERT INTO `permissions` VALUES (148, 'view-inventory', 'web', NULL, NULL, 147, NULL, '2023-07-07 02:41:08', '2023-07-07 02:41:08');
INSERT INTO `permissions` VALUES (149, 'edit-inventory', 'web', NULL, NULL, 147, NULL, '2023-07-07 02:41:08', '2023-07-07 02:41:08');
INSERT INTO `permissions` VALUES (150, 'create-inventory', 'web', NULL, NULL, 147, NULL, '2023-07-07 02:41:08', '2023-07-07 02:41:08');
INSERT INTO `permissions` VALUES (151, 'delete-inventory', 'web', NULL, NULL, 147, NULL, '2023-07-07 02:41:08', '2023-07-07 02:41:08');
INSERT INTO `permissions` VALUES (152, 'export-inventory', 'web', NULL, NULL, 147, NULL, '2023-07-07 02:41:08', '2023-07-07 02:41:08');
INSERT INTO `permissions` VALUES (153, NULL, 'web', 'Supplier', NULL, NULL, 56, '2023-07-14 12:35:46', '2023-07-14 12:35:46');
INSERT INTO `permissions` VALUES (154, 'view-supplier', 'web', NULL, NULL, 153, NULL, '2023-07-14 12:35:46', '2023-07-14 12:35:46');
INSERT INTO `permissions` VALUES (155, 'edit-supplier', 'web', NULL, NULL, 153, NULL, '2023-07-14 12:35:46', '2023-07-14 12:35:46');
INSERT INTO `permissions` VALUES (156, 'create-supplier', 'web', NULL, NULL, 153, NULL, '2023-07-14 12:35:46', '2023-07-14 12:35:46');
INSERT INTO `permissions` VALUES (157, 'delete-supplier', 'web', NULL, NULL, 153, NULL, '2023-07-14 12:35:46', '2023-07-14 12:35:46');
INSERT INTO `permissions` VALUES (158, 'export-supplier', 'web', NULL, NULL, 153, NULL, '2023-07-14 12:35:46', '2023-07-14 12:35:46');
INSERT INTO `permissions` VALUES (159, NULL, 'web', 'View-purchase', NULL, NULL, 56, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (160, 'view-view-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (161, 'edit-view-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (162, 'create-view-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (163, 'delete-view-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (164, 'export-view-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (51, 1);
INSERT INTO `role_has_permissions` VALUES (52, 1);
INSERT INTO `role_has_permissions` VALUES (53, 1);
INSERT INTO `role_has_permissions` VALUES (54, 1);
INSERT INTO `role_has_permissions` VALUES (55, 1);
INSERT INTO `role_has_permissions` VALUES (58, 1);
INSERT INTO `role_has_permissions` VALUES (59, 1);
INSERT INTO `role_has_permissions` VALUES (60, 1);
INSERT INTO `role_has_permissions` VALUES (61, 1);
INSERT INTO `role_has_permissions` VALUES (62, 1);
INSERT INTO `role_has_permissions` VALUES (64, 1);
INSERT INTO `role_has_permissions` VALUES (65, 1);
INSERT INTO `role_has_permissions` VALUES (66, 1);
INSERT INTO `role_has_permissions` VALUES (67, 1);
INSERT INTO `role_has_permissions` VALUES (68, 1);
INSERT INTO `role_has_permissions` VALUES (70, 1);
INSERT INTO `role_has_permissions` VALUES (71, 1);
INSERT INTO `role_has_permissions` VALUES (72, 1);
INSERT INTO `role_has_permissions` VALUES (73, 1);
INSERT INTO `role_has_permissions` VALUES (74, 1);
INSERT INTO `role_has_permissions` VALUES (76, 1);
INSERT INTO `role_has_permissions` VALUES (77, 1);
INSERT INTO `role_has_permissions` VALUES (78, 1);
INSERT INTO `role_has_permissions` VALUES (79, 1);
INSERT INTO `role_has_permissions` VALUES (80, 1);
INSERT INTO `role_has_permissions` VALUES (82, 1);
INSERT INTO `role_has_permissions` VALUES (83, 1);
INSERT INTO `role_has_permissions` VALUES (84, 1);
INSERT INTO `role_has_permissions` VALUES (85, 1);
INSERT INTO `role_has_permissions` VALUES (86, 1);
INSERT INTO `role_has_permissions` VALUES (100, 1);
INSERT INTO `role_has_permissions` VALUES (101, 1);
INSERT INTO `role_has_permissions` VALUES (102, 1);
INSERT INTO `role_has_permissions` VALUES (103, 1);
INSERT INTO `role_has_permissions` VALUES (104, 1);
INSERT INTO `role_has_permissions` VALUES (106, 1);
INSERT INTO `role_has_permissions` VALUES (107, 1);
INSERT INTO `role_has_permissions` VALUES (108, 1);
INSERT INTO `role_has_permissions` VALUES (109, 1);
INSERT INTO `role_has_permissions` VALUES (110, 1);
INSERT INTO `role_has_permissions` VALUES (118, 1);
INSERT INTO `role_has_permissions` VALUES (119, 1);
INSERT INTO `role_has_permissions` VALUES (120, 1);
INSERT INTO `role_has_permissions` VALUES (121, 1);
INSERT INTO `role_has_permissions` VALUES (122, 1);
INSERT INTO `role_has_permissions` VALUES (124, 1);
INSERT INTO `role_has_permissions` VALUES (125, 1);
INSERT INTO `role_has_permissions` VALUES (126, 1);
INSERT INTO `role_has_permissions` VALUES (127, 1);
INSERT INTO `role_has_permissions` VALUES (128, 1);
INSERT INTO `role_has_permissions` VALUES (130, 1);
INSERT INTO `role_has_permissions` VALUES (131, 1);
INSERT INTO `role_has_permissions` VALUES (132, 1);
INSERT INTO `role_has_permissions` VALUES (133, 1);
INSERT INTO `role_has_permissions` VALUES (134, 1);
INSERT INTO `role_has_permissions` VALUES (136, 1);
INSERT INTO `role_has_permissions` VALUES (137, 1);
INSERT INTO `role_has_permissions` VALUES (138, 1);
INSERT INTO `role_has_permissions` VALUES (139, 1);
INSERT INTO `role_has_permissions` VALUES (140, 1);
INSERT INTO `role_has_permissions` VALUES (142, 1);
INSERT INTO `role_has_permissions` VALUES (143, 1);
INSERT INTO `role_has_permissions` VALUES (144, 1);
INSERT INTO `role_has_permissions` VALUES (145, 1);
INSERT INTO `role_has_permissions` VALUES (146, 1);
INSERT INTO `role_has_permissions` VALUES (148, 1);
INSERT INTO `role_has_permissions` VALUES (149, 1);
INSERT INTO `role_has_permissions` VALUES (150, 1);
INSERT INTO `role_has_permissions` VALUES (151, 1);
INSERT INTO `role_has_permissions` VALUES (152, 1);
INSERT INTO `role_has_permissions` VALUES (154, 1);
INSERT INTO `role_has_permissions` VALUES (155, 1);
INSERT INTO `role_has_permissions` VALUES (156, 1);
INSERT INTO `role_has_permissions` VALUES (157, 1);
INSERT INTO `role_has_permissions` VALUES (158, 1);
INSERT INTO `role_has_permissions` VALUES (160, 1);
INSERT INTO `role_has_permissions` VALUES (161, 1);
INSERT INTO `role_has_permissions` VALUES (162, 1);
INSERT INTO `role_has_permissions` VALUES (163, 1);
INSERT INTO `role_has_permissions` VALUES (164, 1);
INSERT INTO `role_has_permissions` VALUES (64, 3);
INSERT INTO `role_has_permissions` VALUES (118, 3);
INSERT INTO `role_has_permissions` VALUES (119, 3);
INSERT INTO `role_has_permissions` VALUES (120, 3);
INSERT INTO `role_has_permissions` VALUES (121, 3);
INSERT INTO `role_has_permissions` VALUES (122, 3);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', 'web', '2023-05-16 10:17:48', '2023-05-16 10:17:48');
INSERT INTO `roles` VALUES (2, 'Employee', 'web', '2023-05-16 11:50:42', '2023-05-16 11:50:42');
INSERT INTO `roles` VALUES (3, 'Candidate', 'web', '2023-05-16 11:50:57', '2023-05-16 11:50:57');

SET FOREIGN_KEY_CHECKS = 1;