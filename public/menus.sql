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

 Date: 27/09/2023 18:18:26
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
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (33, 'Setup', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (34, 'User', '/user', 'view-user', 33, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (35, 'Role', '/role', 'view-role', 33, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (36, 'Permission', '/permission', 'view-permission', 33, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (37, 'User Subscription', '/user_subscription', 'view-user_subscription', 33, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (38, 'Company', '/company', 'view-company', 33, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (39, 'Warehouse', '/warehouse', 'view-warehouse', 33, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (40, 'Purchase', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (41, 'Product', '/product', 'view-product', 40, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (42, 'Inventory', '/inventory', 'view-inventory', 40, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (43, 'Product Category', '/product_category', 'view-product_category', 40, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (44, 'Brand', '/brand', 'view-brand', 40, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (45, 'Orders', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (46, 'Order', '/order', 'view-order', 45, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (47, 'Receive Order', '/receive_order', 'view-receive_order', 45, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (48, 'Sales', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (49, 'Ledgers', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (51, 'Suppliers', '/supplier', 'view-supplier', 48, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (52, 'Place Replacement Order', '/replacement', 'view-replacement', 45, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (53, 'Stores', '/stores', 'view-stores', 33, 'web', '', '2023-05-25 11:23:56', NULL, NULL);
INSERT INTO `menus` VALUES (54, 'Settings', NULL, NULL, NULL, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (55, 'Global_settings', '/global_settings', 'view-global_settings', 54, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (56, 'Chart of Accounts', '/coa', 'view-chart_of_accounts', 49, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (57, 'Required Item Stock', '/required_item_stock', 'view-required_item_stock', 45, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (58, 'Customer', '/customer', 'view-customer', 33, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (59, 'User Dashboard', '/user_dashboard', 'view-user_dashboard', 33, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (60, 'Purchase', '/purchase', 'view-purchase', 40, 'web', NULL, NULL, NULL, NULL);
INSERT INTO `menus` VALUES (61, 'Fetch Order', '/fetch_order', 'view-fetch_order', 45, 'web', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
