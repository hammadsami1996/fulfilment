/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantpegasus

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 31/08/2023 17:06:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_group_class_types
-- ----------------------------
DROP TABLE IF EXISTS `account_group_class_types`;
CREATE TABLE `account_group_class_types`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `class_type` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `main_class` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `debit` double(15, 2) NULL DEFAULT NULL,
  `credit` double(15, 2) NULL DEFAULT NULL,
  `balance` double(15, 2) NULL DEFAULT NULL,
  `active` int NULL DEFAULT 1,
  `created_at` date NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `account_period_opening` double(15, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of account_group_class_types
-- ----------------------------
INSERT INTO `account_group_class_types` VALUES (1, '1', 'Assets', 'Balance Sheet', 27795747.68, 28513519.62, 212026018.30, 1, NULL, '2023-08-31 07:56:12', 212743790.24);
INSERT INTO `account_group_class_types` VALUES (2, '2', 'Liabilities', 'Balance Sheet', 13117074.00, 10284871.73, -183246867.91, 1, NULL, NULL, -186079070.18);
INSERT INTO `account_group_class_types` VALUES (3, '3', 'Capital/Equity', 'Balance Sheet', 0.00, 0.00, -30025002.00, 1, NULL, NULL, -30025002.00);
INSERT INTO `account_group_class_types` VALUES (4, '4', 'Revenues', 'Income Statement', 146043.00, 11589477.75, -128705797.34, 1, NULL, NULL, -117262362.59);
INSERT INTO `account_group_class_types` VALUES (5, '5', 'Expenses & Purchase', 'Income Statement', 9394256.42, 0.00, 130016908.23, 1, NULL, NULL, 120622651.81);

SET FOREIGN_KEY_CHECKS = 1;
