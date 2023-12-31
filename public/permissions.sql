/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : fulfilment

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 23/11/2023 15:38:42
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
) ENGINE = InnoDB AUTO_INCREMENT = 291 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `permissions` VALUES (213, NULL, 'web', 'Chart_of_accounts', NULL, NULL, 56, '2023-10-03 12:46:22', '2023-10-03 12:46:22');
INSERT INTO `permissions` VALUES (214, 'view-chart_of_accounts', 'web', NULL, NULL, 213, NULL, '2023-10-03 12:46:22', '2023-10-03 12:46:22');
INSERT INTO `permissions` VALUES (215, 'edit-chart_of_accounts', 'web', NULL, NULL, 213, NULL, '2023-10-03 12:46:22', '2023-10-03 12:46:22');
INSERT INTO `permissions` VALUES (216, 'create-chart_of_accounts', 'web', NULL, NULL, 213, NULL, '2023-10-03 12:46:22', '2023-10-03 12:46:22');
INSERT INTO `permissions` VALUES (217, 'delete-chart_of_accounts', 'web', NULL, NULL, 213, NULL, '2023-10-03 12:46:22', '2023-10-03 12:46:22');
INSERT INTO `permissions` VALUES (218, 'export-chart_of_accounts', 'web', NULL, NULL, 213, NULL, '2023-10-03 12:46:22', '2023-10-03 12:46:22');
INSERT INTO `permissions` VALUES (219, NULL, 'web', 'Global_settings', NULL, NULL, 56, '2023-10-03 13:07:05', '2023-10-03 13:07:05');
INSERT INTO `permissions` VALUES (220, 'view-global_settings', 'web', NULL, NULL, 219, NULL, '2023-10-03 13:07:05', '2023-10-03 13:07:05');
INSERT INTO `permissions` VALUES (221, 'edit-global_settings', 'web', NULL, NULL, 219, NULL, '2023-10-03 13:07:05', '2023-10-03 13:07:05');
INSERT INTO `permissions` VALUES (222, 'create-global_settings', 'web', NULL, NULL, 219, NULL, '2023-10-03 13:07:05', '2023-10-03 13:07:05');
INSERT INTO `permissions` VALUES (223, 'delete-global_settings', 'web', NULL, NULL, 219, NULL, '2023-10-03 13:07:05', '2023-10-03 13:07:05');
INSERT INTO `permissions` VALUES (224, 'export-global_settings', 'web', NULL, NULL, 219, NULL, '2023-10-03 13:07:05', '2023-10-03 13:07:05');
INSERT INTO `permissions` VALUES (225, NULL, 'web', 'Plan', NULL, NULL, 56, '2023-10-03 13:08:10', '2023-10-03 13:08:10');
INSERT INTO `permissions` VALUES (226, 'view-plan', 'web', NULL, NULL, 225, NULL, '2023-10-03 13:08:10', '2023-10-03 13:08:10');
INSERT INTO `permissions` VALUES (227, 'edit-plan', 'web', NULL, NULL, 225, NULL, '2023-10-03 13:08:10', '2023-10-03 13:08:10');
INSERT INTO `permissions` VALUES (228, 'create-plan', 'web', NULL, NULL, 225, NULL, '2023-10-03 13:08:10', '2023-10-03 13:08:10');
INSERT INTO `permissions` VALUES (229, 'delete-plan', 'web', NULL, NULL, 225, NULL, '2023-10-03 13:08:10', '2023-10-03 13:08:10');
INSERT INTO `permissions` VALUES (230, 'export-plan', 'web', NULL, NULL, 225, NULL, '2023-10-03 13:08:10', '2023-10-03 13:08:10');
INSERT INTO `permissions` VALUES (231, NULL, 'web', 'Receive_order', NULL, NULL, 56, '2023-10-03 13:09:21', '2023-10-03 13:09:21');
INSERT INTO `permissions` VALUES (232, 'view-receive_order', 'web', NULL, NULL, 231, NULL, '2023-10-03 13:09:21', '2023-10-03 13:09:21');
INSERT INTO `permissions` VALUES (233, 'edit-receive_order', 'web', NULL, NULL, 231, NULL, '2023-10-03 13:09:21', '2023-10-03 13:09:21');
INSERT INTO `permissions` VALUES (234, 'create-receive_order', 'web', NULL, NULL, 231, NULL, '2023-10-03 13:09:22', '2023-10-03 13:09:22');
INSERT INTO `permissions` VALUES (235, 'delete-receive_order', 'web', NULL, NULL, 231, NULL, '2023-10-03 13:09:22', '2023-10-03 13:09:22');
INSERT INTO `permissions` VALUES (236, 'export-receive_order', 'web', NULL, NULL, 231, NULL, '2023-10-03 13:09:22', '2023-10-03 13:09:22');
INSERT INTO `permissions` VALUES (237, NULL, 'web', 'Required_item_stock', NULL, NULL, 56, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (238, 'view-required_item_stock', 'web', NULL, NULL, 237, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (239, 'edit-required_item_stock', 'web', NULL, NULL, 237, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (240, 'create-required_item_stock', 'web', NULL, NULL, 237, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (241, 'delete-required_item_stock', 'web', NULL, NULL, 237, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (242, 'export-required_item_stock', 'web', NULL, NULL, 237, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (243, NULL, 'web', 'Customer_category', NULL, NULL, 56, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (244, 'view-customer_category', 'web', NULL, NULL, 243, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (245, 'edit-customer_category', 'web', NULL, NULL, 243, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (246, 'create-customer_category', 'web', NULL, NULL, 243, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (247, 'delete-customer_category', 'web', NULL, NULL, 243, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (248, 'export-customer_category', 'web', NULL, NULL, 243, NULL, '2023-10-03 13:10:11', '2023-10-03 13:10:11');
INSERT INTO `permissions` VALUES (249, NULL, 'web', 'Cities', NULL, NULL, 56, '2023-10-18 06:48:33', '2023-10-18 06:48:33');
INSERT INTO `permissions` VALUES (250, 'view-cities', 'web', NULL, NULL, 249, NULL, '2023-10-18 06:48:33', '2023-10-18 06:48:33');
INSERT INTO `permissions` VALUES (251, 'edit-cities', 'web', NULL, NULL, 249, NULL, '2023-10-18 06:48:33', '2023-10-18 06:48:33');
INSERT INTO `permissions` VALUES (252, 'create-cities', 'web', NULL, NULL, 249, NULL, '2023-10-18 06:48:33', '2023-10-18 06:48:33');
INSERT INTO `permissions` VALUES (253, 'delete-cities', 'web', NULL, NULL, 249, NULL, '2023-10-18 06:48:33', '2023-10-18 06:48:33');
INSERT INTO `permissions` VALUES (254, 'export-cities', 'web', NULL, NULL, 249, NULL, '2023-10-18 06:48:33', '2023-10-18 06:48:33');
INSERT INTO `permissions` VALUES (261, NULL, 'web', 'Permission', NULL, NULL, 56, '2023-10-26 12:30:12', '2023-10-26 12:30:12');
INSERT INTO `permissions` VALUES (262, 'view-permission', 'web', NULL, NULL, 261, NULL, '2023-10-26 12:30:12', '2023-10-26 12:30:12');
INSERT INTO `permissions` VALUES (263, 'edit-permission', 'web', NULL, NULL, 261, NULL, '2023-10-26 12:30:12', '2023-10-26 12:30:12');
INSERT INTO `permissions` VALUES (264, 'create-permission', 'web', NULL, NULL, 261, NULL, '2023-10-26 12:30:12', '2023-10-26 12:30:12');
INSERT INTO `permissions` VALUES (265, 'delete-permission', 'web', NULL, NULL, 261, NULL, '2023-10-26 12:30:12', '2023-10-26 12:30:12');
INSERT INTO `permissions` VALUES (266, 'export-permission', 'web', NULL, NULL, 261, NULL, '2023-10-26 12:30:12', '2023-10-26 12:30:12');
INSERT INTO `permissions` VALUES (267, NULL, 'web', 'general_voucher', NULL, NULL, 56, '2023-11-16 06:01:59', '2023-11-16 06:01:59');
INSERT INTO `permissions` VALUES (268, 'view-general_voucher', 'web', NULL, NULL, 267, NULL, '2023-11-16 06:01:59', '2023-11-16 06:01:59');
INSERT INTO `permissions` VALUES (269, 'edit-general_voucher', 'web', NULL, NULL, 267, NULL, '2023-11-16 06:01:59', '2023-11-16 06:01:59');
INSERT INTO `permissions` VALUES (270, 'create-general_voucher', 'web', NULL, NULL, 267, NULL, '2023-11-16 06:01:59', '2023-11-16 06:01:59');
INSERT INTO `permissions` VALUES (271, 'delete-general_voucher', 'web', NULL, NULL, 267, NULL, '2023-11-16 06:01:59', '2023-11-16 06:01:59');
INSERT INTO `permissions` VALUES (272, 'export-general_voucher', 'web', NULL, NULL, 267, NULL, '2023-11-16 06:01:59', '2023-11-16 06:01:59');
INSERT INTO `permissions` VALUES (273, NULL, 'web', 'Account', NULL, NULL, 56, '2023-11-22 07:59:44', '2023-11-22 07:59:44');
INSERT INTO `permissions` VALUES (274, 'view-account', 'web', NULL, NULL, 273, NULL, '2023-11-22 07:59:44', '2023-11-22 07:59:44');
INSERT INTO `permissions` VALUES (275, 'edit-account', 'web', NULL, NULL, 273, NULL, '2023-11-22 07:59:44', '2023-11-22 07:59:44');
INSERT INTO `permissions` VALUES (276, 'create-account', 'web', NULL, NULL, 273, NULL, '2023-11-22 07:59:44', '2023-11-22 07:59:44');
INSERT INTO `permissions` VALUES (277, 'delete-account', 'web', NULL, NULL, 273, NULL, '2023-11-22 07:59:44', '2023-11-22 07:59:44');
INSERT INTO `permissions` VALUES (278, 'export-account', 'web', NULL, NULL, 273, NULL, '2023-11-22 07:59:44', '2023-11-22 07:59:44');
INSERT INTO `permissions` VALUES (279, NULL, 'web', 'Subledger', NULL, NULL, 56, '2023-11-22 11:28:44', '2023-11-22 11:28:44');
INSERT INTO `permissions` VALUES (280, 'view-subledger', 'web', NULL, NULL, 279, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (281, 'edit-subledger', 'web', NULL, NULL, 279, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (282, 'create-subledger', 'web', NULL, NULL, 279, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (283, 'delete-subledger', 'web', NULL, NULL, 279, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (284, 'export-subledger', 'web', NULL, NULL, 279, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (285, NULL, 'web', 'Order_status', NULL, NULL, 56, '2023-11-22 11:28:44', '2023-11-22 11:28:44');
INSERT INTO `permissions` VALUES (286, 'view-order_status', 'web', NULL, NULL, 285, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (287, 'edit-order_status', 'web', NULL, NULL, 285, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (288, 'create-order_status', 'web', NULL, NULL, 285, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (289, 'delete-order_status', 'web', NULL, NULL, 285, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (290, 'export-order_status', 'web', NULL, NULL, 285, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (291, NULL, 'web', 'Account_setting', NULL, NULL, 56, '2023-11-22 11:28:44', '2023-11-22 11:28:44');
INSERT INTO `permissions` VALUES (292, 'view-account_setting', 'web', NULL, NULL, 291, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (293, 'edit-account_setting', 'web', NULL, NULL, 291, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (294, 'create-account_setting', 'web', NULL, NULL, 291, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (295, 'delete-account_setting', 'web', NULL, NULL, 291, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (296, 'export-account_setting', 'web', NULL, NULL, 291, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (297, NULL, 'web', 'voucher', NULL, NULL, 56, '2023-11-22 11:28:44', '2023-11-22 11:28:44');
INSERT INTO `permissions` VALUES (298, 'view-voucher', 'web', NULL, NULL, 297, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (299, 'edit-voucher', 'web', NULL, NULL, 297, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (300, 'create-voucher', 'web', NULL, NULL, 297, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (301, 'delete-voucher', 'web', NULL, NULL, 297, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
INSERT INTO `permissions` VALUES (302, 'export-voucher', 'web', NULL, NULL, 297, NULL, '2023-11-22 11:28:45', '2023-11-22 11:28:45');
-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
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
INSERT INTO `role_has_permissions` VALUES (166, 1);
INSERT INTO `role_has_permissions` VALUES (167, 1);
INSERT INTO `role_has_permissions` VALUES (168, 1);
INSERT INTO `role_has_permissions` VALUES (169, 1);
INSERT INTO `role_has_permissions` VALUES (170, 1);
INSERT INTO `role_has_permissions` VALUES (172, 1);
INSERT INTO `role_has_permissions` VALUES (173, 1);
INSERT INTO `role_has_permissions` VALUES (174, 1);
INSERT INTO `role_has_permissions` VALUES (175, 1);
INSERT INTO `role_has_permissions` VALUES (176, 1);
INSERT INTO `role_has_permissions` VALUES (178, 1);
INSERT INTO `role_has_permissions` VALUES (179, 1);
INSERT INTO `role_has_permissions` VALUES (180, 1);
INSERT INTO `role_has_permissions` VALUES (181, 1);
INSERT INTO `role_has_permissions` VALUES (182, 1);
INSERT INTO `role_has_permissions` VALUES (184, 1);
INSERT INTO `role_has_permissions` VALUES (185, 1);
INSERT INTO `role_has_permissions` VALUES (186, 1);
INSERT INTO `role_has_permissions` VALUES (187, 1);
INSERT INTO `role_has_permissions` VALUES (188, 1);
INSERT INTO `role_has_permissions` VALUES (190, 1);
INSERT INTO `role_has_permissions` VALUES (191, 1);
INSERT INTO `role_has_permissions` VALUES (192, 1);
INSERT INTO `role_has_permissions` VALUES (193, 1);
INSERT INTO `role_has_permissions` VALUES (194, 1);
INSERT INTO `role_has_permissions` VALUES (202, 1);
INSERT INTO `role_has_permissions` VALUES (203, 1);
INSERT INTO `role_has_permissions` VALUES (204, 1);
INSERT INTO `role_has_permissions` VALUES (205, 1);
INSERT INTO `role_has_permissions` VALUES (206, 1);
INSERT INTO `role_has_permissions` VALUES (208, 1);
INSERT INTO `role_has_permissions` VALUES (209, 1);
INSERT INTO `role_has_permissions` VALUES (210, 1);
INSERT INTO `role_has_permissions` VALUES (211, 1);
INSERT INTO `role_has_permissions` VALUES (212, 1);
INSERT INTO `role_has_permissions` VALUES (214, 1);
INSERT INTO `role_has_permissions` VALUES (215, 1);
INSERT INTO `role_has_permissions` VALUES (216, 1);
INSERT INTO `role_has_permissions` VALUES (217, 1);
INSERT INTO `role_has_permissions` VALUES (218, 1);
INSERT INTO `role_has_permissions` VALUES (220, 1);
INSERT INTO `role_has_permissions` VALUES (221, 1);
INSERT INTO `role_has_permissions` VALUES (222, 1);
INSERT INTO `role_has_permissions` VALUES (223, 1);
INSERT INTO `role_has_permissions` VALUES (224, 1);
INSERT INTO `role_has_permissions` VALUES (226, 1);
INSERT INTO `role_has_permissions` VALUES (227, 1);
INSERT INTO `role_has_permissions` VALUES (228, 1);
INSERT INTO `role_has_permissions` VALUES (229, 1);
INSERT INTO `role_has_permissions` VALUES (230, 1);
INSERT INTO `role_has_permissions` VALUES (232, 1);
INSERT INTO `role_has_permissions` VALUES (233, 1);
INSERT INTO `role_has_permissions` VALUES (234, 1);
INSERT INTO `role_has_permissions` VALUES (235, 1);
INSERT INTO `role_has_permissions` VALUES (236, 1);
INSERT INTO `role_has_permissions` VALUES (238, 1);
INSERT INTO `role_has_permissions` VALUES (239, 1);
INSERT INTO `role_has_permissions` VALUES (240, 1);
INSERT INTO `role_has_permissions` VALUES (241, 1);
INSERT INTO `role_has_permissions` VALUES (242, 1);
INSERT INTO `role_has_permissions` VALUES (244, 1);
INSERT INTO `role_has_permissions` VALUES (245, 1);
INSERT INTO `role_has_permissions` VALUES (246, 1);
INSERT INTO `role_has_permissions` VALUES (247, 1);
INSERT INTO `role_has_permissions` VALUES (248, 1);
INSERT INTO `role_has_permissions` VALUES (250, 1);
INSERT INTO `role_has_permissions` VALUES (251, 1);
INSERT INTO `role_has_permissions` VALUES (252, 1);
INSERT INTO `role_has_permissions` VALUES (253, 1);
INSERT INTO `role_has_permissions` VALUES (70, 1);
INSERT INTO `role_has_permissions` VALUES (71, 1);
INSERT INTO `role_has_permissions` VALUES (72, 1);
INSERT INTO `role_has_permissions` VALUES (73, 1);
INSERT INTO `role_has_permissions` VALUES (74, 1);
INSERT INTO `role_has_permissions` VALUES (256, 1);
INSERT INTO `role_has_permissions` VALUES (257, 1);
INSERT INTO `role_has_permissions` VALUES (258, 1);
INSERT INTO `role_has_permissions` VALUES (259, 1);
INSERT INTO `role_has_permissions` VALUES (262, 1);
INSERT INTO `role_has_permissions` VALUES (263, 1);
INSERT INTO `role_has_permissions` VALUES (264, 1);
INSERT INTO `role_has_permissions` VALUES (265, 1);
INSERT INTO `role_has_permissions` VALUES (266, 1);
INSERT INTO `role_has_permissions` VALUES (267, 1);
INSERT INTO `role_has_permissions` VALUES (268, 1);
INSERT INTO `role_has_permissions` VALUES (269, 1);
INSERT INTO `role_has_permissions` VALUES (270, 1);
INSERT INTO `role_has_permissions` VALUES (271, 1);
INSERT INTO `role_has_permissions` VALUES (272, 1);

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

SET FOREIGN_KEY_CHECKS = 1;
