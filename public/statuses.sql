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

 Date: 17/08/2023 16:35:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `responses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `stock_qty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sort` int NULL DEFAULT NULL,
   `email` int NULL DEFAULT 1,
   `sms` int NULL DEFAULT 1,
   `active` int NULL DEFAULT 1,
   `sales_on` int NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `head` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `head_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES (1, 'Pending',NULL,NULL,NULL,NULL,1,1,1,1, '2023-08-01 15:56:07', '2023-08-01 15:56:09', '#9E337F', 'order', NULL); 
INSERT INTO `statuses` VALUES (2, 'Confirmed',NULL,NULL,NULL,NULL,1,1,1,1, '2023-08-01 15:56:19', '2023-08-01 15:56:21', '#F1C40F', 'order', NULL); 
INSERT INTO `statuses` VALUES (3, 'Delivered',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#438A1A', 'order', NULL); 
INSERT INTO `statuses` VALUES (4, 'Cancelled',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#D33E16', 'order', NULL); 
INSERT INTO `statuses` VALUES (5, 'Payment Done',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#3516D3', 'order', NULL); 
INSERT INTO `statuses` VALUES (6, 'Booked',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#85C907', 'order', NULL);
INSERT INTO `statuses` VALUES (7, 'Not answering calls',NULL,NULL,NULL,NULL,1,1,1,1, '2023-08-03 13:23:06', NULL, '#FEEE02 ', 'order', NULL); 
INSERT INTO `statuses` VALUES (8, 'Fake',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#FE3B02 ', 'order', NULL); 
INSERT INTO `statuses` VALUES (9, 'Return Received',NULL,NULL,NULL,NULL,1,1,1,1, '2023-08-03 13:23:42', NULL, '#37E784 ', 'order', NULL); 
INSERT INTO `statuses` VALUES (10, 'Return with Courier',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#319B5F ', 'order', NULL); 
INSERT INTO `statuses` VALUES (11, 'In transit',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#BD1482 ', 'order', NULL); 
INSERT INTO `statuses` VALUES (12, 'Draft',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#30B3A5', 'purchase', '24 , 26 , 30');
INSERT INTO `statuses` VALUES (13, 'Sent',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#53FDBA', 'purchase', '25,26,30');
INSERT INTO `statuses` VALUES (14, 'Confirmed',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#318E69', 'purchase', '27,26,30');
INSERT INTO `statuses` VALUES (15, 'Closed',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#F5A912', 'purchase', '24,30');
INSERT INTO `statuses` VALUES (16, 'Received',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#F5F512', 'purchase', '28,30');
INSERT INTO `statuses` VALUES (17, 'Bill',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#2B7CB8', 'purchase', '26');
INSERT INTO `statuses` VALUES (18, 'Partially-Received',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#FCA50E', 'purchase', '27,26,30');
INSERT INTO `statuses` VALUES (19, 'Cancelled',NULL,NULL,NULL,NULL,1,1,1,1, NULL, NULL, '#F54212', 'purchase', '24');
-- INSERT INTO `statuses` VALUES (18, 'Partially-Received', NULL, NULL, '#FCA50E', 'purchase', '27,26,30');
-- INSERT INTO `statuses` VALUES (19, 'Cancelled', NULL, NULL, '#F54212', 'purchase', '24');

SET FOREIGN_KEY_CHECKS = 1;
