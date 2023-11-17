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

 Date: 16/11/2023 11:07:20
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
  `guard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` int NULL DEFAULT NULL,
  `sort` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Setup', '', '', NULL, '', NULL, 1, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (2, 'Purchase', '', '', NULL, 'web', NULL, 2, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (3, 'Orders Management', '', '', NULL, 'web', NULL, 4, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (4, 'Sales', '', '', NULL, 'web', NULL, 6, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (5, 'Ledgers', '', '', NULL, 'web', NULL, 5, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (6, 'Settings', '', '', NULL, 'web', NULL, 7, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (7, 'Inventory', '', '', NULL, 'web', NULL, 3, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (8, 'User', '/user', 'view-user', 1, 'web', NULL, 1, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (9, 'Role', '/role', 'view-role', 1, 'web', NULL, 2, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (10, 'Permission', '/permission', 'view-permission', 1, 'web', NULL, 3, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (11, 'Company', '/company', 'view-company', 1, 'web', NULL, 4, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (12, 'Stores', '/stores', 'view-stores', 1, 'web', NULL, 6, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (13, 'Warehouse', '/warehouse', 'view-warehouse', 1, 'web', NULL, 5, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (14, 'Customer', '/customer', 'view-customer', 1, 'web', NULL, 7, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (15, 'User Subscription', '/user_subscription', 'view-user_subscription', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (16, 'User Dashboard', '/user_dashboard', 'view-user_dashboard', 1, 'web', NULL, 9, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (17, 'Cities', '/cities', 'view-cities', 1, 'web', NULL, 10, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (18, 'Product Category', '/product_category', 'view-product_category', 7, 'web', NULL, 2, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (19, 'Customer Category', '/customer_category', 'view-customer_category', 1, 'web', NULL, 8, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (20, 'Brand', '/brand', 'view-brand', 7, 'web', NULL, 4, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (21, 'Suppliers', '/supplier', 'view-supplier', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (22, 'Product', '/product', 'view-product', 7, 'web', NULL, 1, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (23, 'Purchase', '/purchase', 'view-purchase', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (24, 'Inventory', '/inventory', 'view-inventory', 7, 'web', NULL, 3, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (25, 'Order', '/order', 'view-order', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (26, 'Receive Order', '/receive_order', 'view-receive_order', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (27, 'Place Replacement Order', '/replacement', 'view-replacement', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (28, 'Required Item Stock', '/required_item_stock', 'view-required_item_stock', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (29, 'Fetch Order', '/fetch_order', 'view-fetch_order', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (30, 'Chart of Accounts', '/coa', 'view-chart_of_accounts', 5, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (31, 'Global Settings', '/global_settings', 'view-global_settings ', 6, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (32, 'General Voucher', '/voucher', 'view-voucher', 5, 'web', NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
