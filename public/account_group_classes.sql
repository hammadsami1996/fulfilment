/*
 Navicat Premium Data Transfer

 Source Server         : nazar
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantubaid00171

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 06/12/2023 13:40:29
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
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of account_group_classes
-- ----------------------------
INSERT INTO `account_group_classes` VALUES (1, '101', 'Cash & Bank Accounts', 1, 1, NULL, '2023-08-31 09:58:33', 27747747.68, 28513519.62, 117106231.41, 117872003.35, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (2, '102', 'Expected Payments From Customers', 1, 1, NULL, NULL, 48000.00, 0.00, 94919786.89, 94871786.89, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (3, '201', 'Credit Cards', 2, 1, NULL, '2022-01-19 11:58:32', 13117074.00, 10284871.73, 1904602.09, -927600.18, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (4, '202', 'Loan And Line Of Credit', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (5, '401', 'Sales', 4, 1, NULL, NULL, 146043.00, 11589477.75, -128705797.34, -117262362.59, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (6, '501', 'Operating Expense', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (7, '301', 'Invested Capital', 3, 1, NULL, NULL, 0.00, 0.00, -30025002.00, -30025002.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (8, '502', 'Cost of Goods Sold', 5, 1, '2019-10-22', '2019-10-22 20:25:32', 6167940.00, 0.00, 83469770.54, 77301830.54, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (9, '303', 'Retained Earnings', 3, 1, '2022-02-04', '2022-02-04 17:09:31', 0.00, 0.00, 0.00, 0.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (10, '302', 'Owners Drawing', 3, 1, '2022-02-04', '2022-02-04 17:11:13', 0.00, 0.00, 0.00, 0.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (11, '103', 'Employee Loans & Advances', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (12, '104', 'Prepayments', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (13, '105', 'Inventory', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (14, '106', 'Depreciation And Amortization', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (15, '107', 'Property, Plant, Equipment', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (16, '108', 'Other Short-Term Asset', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (17, '109', 'Other Long-Term Asset', 1, 1, '2023-08-30', '2023-08-30 08:15:31', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (18, '203', 'Expected Payments To Vendors', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (19, '204', 'Sales Taxes', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (20, '205', 'Due For Payroll', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (21, '206', 'Due To Self / Business Owners', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (22, '207', 'Customer Prepayments', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (23, '208', 'Other Short-Term Liabilities', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (24, '209', 'Other Long-Term Liability', 2, 1, NULL, NULL, 0.00, 0.00, -185151470.00, -185151470.00, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (25, '402', 'Discount', 4, 1, NULL, NULL, 146043.00, 11589477.75, -128705797.34, -117262362.59, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (26, '403', 'Other Revenue', 4, 1, NULL, NULL, 146043.00, 11589477.75, -128705797.34, -117262362.59, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (27, '404', 'Uncategorized Income', 4, 1, NULL, NULL, 146043.00, 11589477.75, -128705797.34, -117262362.59, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (28, '503', 'Financial Expense', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (29, '504', 'Sales Expense', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (30, '505', 'Payroll Expense', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (31, '506', 'Marketing Expense', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (32, '507', 'Bad Debts', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);
INSERT INTO `account_group_classes` VALUES (33, '508', 'Uncategorized Expense', 5, 1, NULL, NULL, 3226316.42, 0.00, 46547137.69, 43320821.27, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
