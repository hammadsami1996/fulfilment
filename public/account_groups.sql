/*
 Navicat Premium Data Transfer

 Source Server         : nazar
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantubaid00197

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 21/12/2023 14:59:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_groups
-- ----------------------------
DROP TABLE IF EXISTS `account_groups`;
CREATE TABLE `account_groups`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `groupname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `class_id` int NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT 0,
  `company_id` int NULL DEFAULT NULL,
  `debit` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `credit` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `account_period_opening` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of account_groups
-- ----------------------------
INSERT INTO `account_groups` VALUES (1, '101001', 'test', 1, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:34:38', '2023-12-14 10:34:38');
INSERT INTO `account_groups` VALUES (2, '102001', 'test0010', 2, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:34:59', '2023-12-14 10:34:59');
INSERT INTO `account_groups` VALUES (3, '103001', 'test123', 11, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:35:55', '2023-12-14 10:35:55');
INSERT INTO `account_groups` VALUES (4, '104001', 'testpayment', 12, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:37:46', '2023-12-14 10:37:46');
INSERT INTO `account_groups` VALUES (5, '105001', 'testInvantry', 13, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:38:16', '2023-12-14 10:38:16');
INSERT INTO `account_groups` VALUES (6, '106001', 'test_dep', 14, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:38:38', '2023-12-14 10:38:38');
INSERT INTO `account_groups` VALUES (7, '107001', 'test_property', 15, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:39:13', '2023-12-14 10:39:13');
INSERT INTO `account_groups` VALUES (8, '108001', 'test_short', 16, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:39:29', '2023-12-14 10:39:29');
INSERT INTO `account_groups` VALUES (9, '109001', 'test_long', 17, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:39:43', '2023-12-14 10:39:43');
INSERT INTO `account_groups` VALUES (10, '201001', 'credit card', 3, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:43:36', '2023-12-14 10:43:36');
INSERT INTO `account_groups` VALUES (11, '202001', 'Loan', 4, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:44:30', '2023-12-14 10:44:30');
INSERT INTO `account_groups` VALUES (12, '203001', 'expected_payment', 18, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:52:37', '2023-12-14 10:52:37');
INSERT INTO `account_groups` VALUES (13, '204001', 'sale_tax', 19, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:52:54', '2023-12-14 10:52:54');
INSERT INTO `account_groups` VALUES (14, '205001', 'test_due', 20, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:53:13', '2023-12-14 10:53:13');
INSERT INTO `account_groups` VALUES (15, '301001', 'Invested', 7, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:58:15', '2023-12-14 10:58:15');
INSERT INTO `account_groups` VALUES (16, '303001', 'retained', 9, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:58:33', '2023-12-14 10:58:33');
INSERT INTO `account_groups` VALUES (17, '302001', 'Owners', 10, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:58:47', '2023-12-14 10:58:47');
INSERT INTO `account_groups` VALUES (18, '401001', 'sales', 5, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:59:43', '2023-12-14 10:59:43');
INSERT INTO `account_groups` VALUES (19, '402001', 'discount', 25, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 10:59:53', '2023-12-14 10:59:53');
INSERT INTO `account_groups` VALUES (20, '403001', 'Revenue', 26, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:00:12', '2023-12-14 11:00:12');
INSERT INTO `account_groups` VALUES (21, '404001', 'Income', 27, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:00:31', '2023-12-14 11:00:31');
INSERT INTO `account_groups` VALUES (22, '501001', 'operating', 6, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:01:06', '2023-12-14 11:01:06');
INSERT INTO `account_groups` VALUES (23, '502001', 'goods Gold', 8, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:01:36', '2023-12-14 11:01:36');
INSERT INTO `account_groups` VALUES (24, '503001', 'Financial', 28, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:01:53', '2023-12-14 11:01:53');
INSERT INTO `account_groups` VALUES (25, '504001', 'sales expense', 29, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:02:15', '2023-12-14 11:02:15');
INSERT INTO `account_groups` VALUES (26, '505001', 'payroll', 30, 1, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, '2023-12-14 11:03:39', '2023-12-14 11:03:39');

SET FOREIGN_KEY_CHECKS = 1;
