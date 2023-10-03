/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantfulfilmentf

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 27/09/2023 18:27:20
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
) ENGINE = InnoDB AUTO_INCREMENT = 207 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `permissions` VALUES (159, NULL, 'web', 'Purchase', NULL, NULL, 56, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (160, 'view-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (161, 'edit-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (162, 'create-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (163, 'delete-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (164, 'export-purchase', 'web', NULL, NULL, 159, NULL, '2023-07-17 12:36:20', '2023-07-17 12:36:20');
INSERT INTO `permissions` VALUES (165, NULL, 'web', 'Order', NULL, NULL, 56, '2023-07-19 21:43:16', '2023-07-19 21:43:16');
INSERT INTO `permissions` VALUES (166, 'view-order', 'web', NULL, NULL, 165, NULL, '2023-07-19 21:43:16', '2023-07-19 21:43:16');
INSERT INTO `permissions` VALUES (167, 'edit-order', 'web', NULL, NULL, 165, NULL, '2023-07-19 21:43:16', '2023-07-19 21:43:16');
INSERT INTO `permissions` VALUES (168, 'create-order', 'web', NULL, NULL, 165, NULL, '2023-07-19 21:43:16', '2023-07-19 21:43:16');
INSERT INTO `permissions` VALUES (169, 'delete-order', 'web', NULL, NULL, 165, NULL, '2023-07-19 21:43:16', '2023-07-19 21:43:16');
INSERT INTO `permissions` VALUES (170, 'export-order', 'web', NULL, NULL, 165, NULL, '2023-07-19 21:43:16', '2023-07-19 21:43:16');
INSERT INTO `permissions` VALUES (171, NULL, 'web', 'Customer', NULL, NULL, 56, '2023-07-19 21:43:31', '2023-07-19 21:43:31');
INSERT INTO `permissions` VALUES (172, 'view-customer', 'web', NULL, NULL, 171, NULL, '2023-07-19 21:43:31', '2023-07-19 21:43:31');
INSERT INTO `permissions` VALUES (173, 'edit-customer', 'web', NULL, NULL, 171, NULL, '2023-07-19 21:43:31', '2023-07-19 21:43:31');
INSERT INTO `permissions` VALUES (174, 'create-customer', 'web', NULL, NULL, 171, NULL, '2023-07-19 21:43:32', '2023-07-19 21:43:32');
INSERT INTO `permissions` VALUES (175, 'delete-customer', 'web', NULL, NULL, 171, NULL, '2023-07-19 21:43:32', '2023-07-19 21:43:32');
INSERT INTO `permissions` VALUES (176, 'export-customer', 'web', NULL, NULL, 171, NULL, '2023-07-19 21:43:32', '2023-07-19 21:43:32');
INSERT INTO `permissions` VALUES (177, NULL, 'web', 'Product_category', NULL, NULL, 56, '2023-08-02 07:14:53', '2023-08-02 07:14:53');
INSERT INTO `permissions` VALUES (178, 'view-product_category', 'web', NULL, NULL, 177, NULL, '2023-08-02 07:14:53', '2023-08-02 07:14:53');
INSERT INTO `permissions` VALUES (179, 'edit-product_category', 'web', NULL, NULL, 177, NULL, '2023-08-02 07:14:53', '2023-08-02 07:14:53');
INSERT INTO `permissions` VALUES (180, 'create-product_category', 'web', NULL, NULL, 177, NULL, '2023-08-02 07:14:53', '2023-08-02 07:14:53');
INSERT INTO `permissions` VALUES (181, 'delete-product_category', 'web', NULL, NULL, 177, NULL, '2023-08-02 07:14:53', '2023-08-02 07:14:53');
INSERT INTO `permissions` VALUES (182, 'export-product_category', 'web', NULL, NULL, 177, NULL, '2023-08-02 07:14:53', '2023-08-02 07:14:53');
INSERT INTO `permissions` VALUES (183, NULL, 'web', 'Brand', NULL, NULL, 56, '2023-08-15 07:41:44', '2023-08-15 07:41:44');
INSERT INTO `permissions` VALUES (184, 'view-brand', 'web', NULL, NULL, 183, NULL, '2023-08-15 07:41:44', '2023-08-15 07:41:44');
INSERT INTO `permissions` VALUES (185, 'edit-brand', 'web', NULL, NULL, 183, NULL, '2023-08-15 07:41:44', '2023-08-15 07:41:44');
INSERT INTO `permissions` VALUES (186, 'create-brand', 'web', NULL, NULL, 183, NULL, '2023-08-15 07:41:44', '2023-08-15 07:41:44');
INSERT INTO `permissions` VALUES (187, 'delete-brand', 'web', NULL, NULL, 183, NULL, '2023-08-15 07:41:44', '2023-08-15 07:41:44');
INSERT INTO `permissions` VALUES (188, 'export-brand', 'web', NULL, NULL, 183, NULL, '2023-08-15 07:41:44', '2023-08-15 07:41:44');
INSERT INTO `permissions` VALUES (189, NULL, 'web', 'Replacement', NULL, NULL, 56, '2023-08-26 12:46:56', '2023-08-26 12:46:56');
INSERT INTO `permissions` VALUES (190, 'view-replacement', 'web', NULL, NULL, 189, NULL, '2023-08-26 12:46:56', '2023-08-26 12:46:56');
INSERT INTO `permissions` VALUES (191, 'edit-replacement', 'web', NULL, NULL, 189, NULL, '2023-08-26 12:46:56', '2023-08-26 12:46:56');
INSERT INTO `permissions` VALUES (192, 'create-replacement', 'web', NULL, NULL, 189, NULL, '2023-08-26 12:46:56', '2023-08-26 12:46:56');
INSERT INTO `permissions` VALUES (193, 'delete-replacement', 'web', NULL, NULL, 189, NULL, '2023-08-26 12:46:56', '2023-08-26 12:46:56');
INSERT INTO `permissions` VALUES (194, 'export-replacement', 'web', NULL, NULL, 189, NULL, '2023-08-26 12:46:56', '2023-08-26 12:46:56');
INSERT INTO `permissions` VALUES (201, NULL, 'web', 'Warehouse', NULL, NULL, 56, '2023-09-26 07:21:37', '2023-09-26 07:21:37');
INSERT INTO `permissions` VALUES (202, 'view-warehouse', 'web', NULL, NULL, 201, NULL, '2023-09-26 07:21:37', '2023-09-26 07:21:37');
INSERT INTO `permissions` VALUES (203, 'edit-warehouse', 'web', NULL, NULL, 201, NULL, '2023-09-26 07:21:37', '2023-09-26 07:21:37');
INSERT INTO `permissions` VALUES (204, 'create-warehouse', 'web', NULL, NULL, 201, NULL, '2023-09-26 07:21:37', '2023-09-26 07:21:37');
INSERT INTO `permissions` VALUES (205, 'delete-warehouse', 'web', NULL, NULL, 201, NULL, '2023-09-26 07:21:37', '2023-09-26 07:21:37');
INSERT INTO `permissions` VALUES (206, 'export-warehouse', 'web', NULL, NULL, 201, NULL, '2023-09-26 07:21:37', '2023-09-26 07:21:37');
INSERT INTO `permissions` VALUES (207, NULL, 'web', 'Fetch_order', NULL, NULL, 56, '2023-09-27 13:22:24', '2023-09-27 13:22:24');
INSERT INTO `permissions` VALUES (208, 'view-fetch_order', 'web', NULL, NULL, 207, NULL, '2023-09-27 13:22:25', '2023-09-27 13:22:25');
INSERT INTO `permissions` VALUES (209, 'edit-fetch_order', 'web', NULL, NULL, 207, NULL, '2023-09-27 13:22:25', '2023-09-27 13:22:25');
INSERT INTO `permissions` VALUES (210, 'create-fetch_order', 'web', NULL, NULL, 207, NULL, '2023-09-27 13:22:25', '2023-09-27 13:22:25');
INSERT INTO `permissions` VALUES (211, 'delete-fetch_order', 'web', NULL, NULL, 207, NULL, '2023-09-27 13:22:25', '2023-09-27 13:22:25');
INSERT INTO `permissions` VALUES (212, 'export-fetch_order', 'web', NULL, NULL, 207, NULL, '2023-09-27 13:22:25', '2023-09-27 13:22:25');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', 'web', '2023-05-16 10:17:48', '2023-05-16 10:17:48');
INSERT INTO `roles` VALUES (2, 'Employee', 'web', '2023-05-16 11:50:42', '2023-05-16 11:50:42');
INSERT INTO `roles` VALUES (3, 'Candidate', 'web', '2023-05-16 11:50:57', '2023-05-16 11:50:57');

SET FOREIGN_KEY_CHECKS = 1;
