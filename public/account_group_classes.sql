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

 Date: 31/08/2023 17:06:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_group_classes
-- ----------------------------
DROP TABLE IF EXISTS `account_group_classes`;
CREATE TABLE `account_group_classes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `classname` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `class_type_id` int NULL DEFAULT NULL,
  `active` int NULL DEFAULT 1,
  `created_at` date NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `debit` double(15, 2) NULL DEFAULT NULL,
  `credit` double(15, 2) NULL DEFAULT NULL,
  `balance` double(15, 2) NULL DEFAULT NULL,
  `account_period_opening` double(15, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of account_group_classes
-- ----------------------------
INSERT INTO `account_group_classes` VALUES (1, '101', 'Current Asset', 1, 1, NULL, '2023-08-31 09:58:33', 27747747.68, 28513519.62, 117106231.41, 117872003.35);
INSERT INTO `account_group_classes` VALUES (2, '102', 'Fixed Asset', 1, 1, NULL, NULL, 48000.00, 0.00, 94919786.89, 94871786.89);
INSERT INTO `account_group_classes` VALUES (3, '201', 'Current Liabilities', 2, 1, NULL, '2022-01-19 11:58:32', 13117074.00, 10284871.73, 1904602.09, -927600.18);
INSERT INTO `account_group_classes` VALUES (4, '202', 'Long Term Liabilties', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00);
INSERT INTO `account_group_classes` VALUES (5, '401', 'Income', 4, 1, NULL, NULL, 146043.00, 11589477.75, -128705797.34, -117262362.59);
INSERT INTO `account_group_classes` VALUES (6, '501', 'Expenses', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27);
INSERT INTO `account_group_classes` VALUES (7, '301', 'Equity', 3, 1, NULL, NULL, 0.00, 0.00, -30025002.00, -30025002.00);
INSERT INTO `account_group_classes` VALUES (8, NULL, 'Cost of Goods Sold', 5, 1, '2019-10-22', '2019-10-22 20:25:32', 6167940.00, 0.00, 83469770.54, 77301830.54);
INSERT INTO `account_group_classes` VALUES (9, NULL, 'dRAWING', 3, 1, '2022-02-04', '2022-02-04 17:09:31', 0.00, 0.00, 0.00, 0.00);
INSERT INTO `account_group_classes` VALUES (10, '302', 'DRAWING', 3, 1, '2022-02-04', '2022-02-04 17:11:13', 0.00, 0.00, 0.00, 0.00);
INSERT INTO `account_group_classes` VALUES (11, '103', 'Long Term Assets', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
