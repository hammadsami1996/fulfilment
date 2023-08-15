/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantfulfilment9

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 15/08/2023 12:42:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `head_id` int NULL DEFAULT NULL,
  `guard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `sort` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Main', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (2, 'User', '/user', 'view-user', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (3, 'Role', '/role', 'view-role', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (4, 'Plan', '/plan', 'view-plan', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (8, 'User Dashboard', '/user_dashboard', 'view-user_dashboard', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (15, 'Permission', '/permission', 'view-permission', 1, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (20, 'Product', '/product', 'view-product', 1, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (21, 'Wearhouse', '/wearhouse', 'view-wearhouse', 1, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (22, 'Stores', '/stores', 'view-stores', 1, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (23, 'Company', '/company', 'view-company', 1, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (24, 'Inventory', '/inventory', 'view-inventory', 1, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (25, 'Suppliers', '/supplier', 'view-supplier', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (26, 'Purchase', '/purchase', 'view-purchase', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (27, 'Order', '/order', 'view-order', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (28, 'Customer', '/customer', 'view-customer', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (29, 'Product Category', '/product_category', 'view-product_category', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (30, 'Receive Order', '/receive_order', 'view-receive_order', 1, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (31, 'Brand', '/brand', 'view-brand', 1, 'web', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
