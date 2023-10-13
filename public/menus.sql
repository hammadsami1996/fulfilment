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

 Date: 13/10/2023 10:40:17
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
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Setup', '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (2, 'Purchase', '', '', NULL, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (3, 'Orders Management', '', '', NULL, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (4, 'Sales', '', '', NULL, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (5, 'Ledgers', '', '', NULL, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (6, 'Settings', '', '', NULL, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (7, 'User', '/user', 'view-user', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (8, 'Role', '/role', 'view-role', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (9, 'Permission', '/permission', 'view-permission', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (10, 'Company', '/company', 'view-company', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (11, 'Stores', '/stores', 'view-stores', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (12, 'Warehouse', '/warehouse', 'view-warehouse', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (13, 'Customer', '/customer', 'view-customer', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (14, 'User Subscription', '/user_subscription', 'view-user_subscription', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (15, 'User Dashboard', '/user_dashboard', 'view-user_dashboard', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (16, 'Cities', '/cities', 'view-cities', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (17, 'Product Category', '/product_category', 'view-product_category', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (18, 'Customer Category', '/customer_category', 'view-customer_category', 1, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (19, 'Brand', '/brand', 'view-brand', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (20, 'Suppliers', '/supplier', 'view-supplier', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (21, 'Product', '/product', 'view-product', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (22, 'Purchase', '/purchase', 'view-purchase', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (23, 'Inventory', '/inventory', 'view-inventory', 2, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (24, 'Order', '/order', 'view-order', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (25, 'Receive Order', '/receive_order', 'view-receive_order', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (26, 'Place Replacement Order', '/replacement', 'view-replacement', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (27, 'Required Item Stock', '/required_item_stock', 'view-required_item_stock', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (28, 'Fetch Order', '/fetch_order', 'view-fetch_order', 3, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (29, 'Chart of Accounts', '/coa', 'view-chart_of_accounts', 5, 'web', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (30, 'Global Settings', '/global_settings', 'view-global_settings ', 6, 'web', NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
