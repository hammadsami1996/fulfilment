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
INSERT INTO `statuses` VALUES (1, 'Pending', '2023-08-01 15:56:07', '2023-08-01 15:56:09', '#9E337F', NULL, NULL);
INSERT INTO `statuses` VALUES (2, 'Confirmed', '2023-08-01 15:56:19', '2023-08-01 15:56:21', '#F1C40F', 'order', NULL);
INSERT INTO `statuses` VALUES (3, 'Shipped', NULL, NULL, '#1E91A6', NULL, NULL);
INSERT INTO `statuses` VALUES (4, 'Delivered', NULL, NULL, '#438A1A', 'order', NULL);
INSERT INTO `statuses` VALUES (5, 'Cancelled', NULL, NULL, '#D33E16', 'order', NULL);
INSERT INTO `statuses` VALUES (6, 'On Hold', NULL, NULL, '#3516D3', 'order', NULL);
INSERT INTO `statuses` VALUES (7, 'Address Incomplete', NULL, NULL, '#ECAA36', 'order', NULL);
INSERT INTO `statuses` VALUES (8, 'Booked', NULL, NULL, '#85C907', 'order', NULL);
INSERT INTO `statuses` VALUES (9, 'CN print', NULL, NULL, '#D7D42A', 'order', NULL);
INSERT INTO `statuses` VALUES (10, 'Packed', NULL, NULL, '#21DCD4', 'order', NULL);
INSERT INTO `statuses` VALUES (11, 'Dispatch', NULL, NULL, '#54B01C ', 'order', NULL);
INSERT INTO `statuses` VALUES (12, 'Ready to Ship', NULL, NULL, '#7A1209 ', 'order', NULL);
INSERT INTO `statuses` VALUES (13, 'Not answering calls', '2023-08-03 13:23:06', NULL, '#FEEE02 ', 'order', NULL);
INSERT INTO `statuses` VALUES (14, 'Fake', NULL, NULL, '#FE3B02 ', 'order', NULL);
INSERT INTO `statuses` VALUES (15, 'Return Received', '2023-08-03 13:23:42', NULL, '#37E784 ', 'order', NULL);
INSERT INTO `statuses` VALUES (16, 'Return with Courier', NULL, NULL, '#319B5F ', 'order', NULL);
INSERT INTO `statuses` VALUES (17, 'Message at Whatsapp', NULL, NULL, '#ADFE17 ', 'order', NULL);
INSERT INTO `statuses` VALUES (18, 'Complete', NULL, NULL, '#035D84 ', 'order', NULL);
INSERT INTO `statuses` VALUES (19, 'In transit', NULL, NULL, '#BD1482 ', 'order', NULL);
INSERT INTO `statuses` VALUES (20, 'Order Merge', NULL, NULL, '#BD1454 ', 'order', NULL);
INSERT INTO `statuses` VALUES (21, 'Review Order', NULL, NULL, '#066278 ', 'order', NULL);
INSERT INTO `statuses` VALUES (22, 'Return-Proof-Need', NULL, NULL, '#53FDBA ', 'order', NULL);
INSERT INTO `statuses` VALUES (23, 'Draft', NULL, NULL, '#30B3A5', 'purchase', '24 , 26 , 30');
INSERT INTO `statuses` VALUES (24, 'Sent', NULL, NULL, '#53FDBA', 'purchase', '25,26,30');
INSERT INTO `statuses` VALUES (25, 'Confirmed', NULL, NULL, '#318E69', 'purchase', '27,26,30');
INSERT INTO `statuses` VALUES (26, 'Closed', NULL, NULL, '#F5A912', 'purchase', '24,30');
INSERT INTO `statuses` VALUES (27, 'Received', NULL, NULL, '#F5F512', 'purchase', '28,30');
INSERT INTO `statuses` VALUES (28, ' Bill', NULL, NULL, '#2B7CB8', 'purchase', '26');
INSERT INTO `statuses` VALUES (29, 'Partially-Received', NULL, NULL, '#FCA50E', 'purchase', '27,26,30');
INSERT INTO `statuses` VALUES (30, 'Cancelled', NULL, NULL, '#F54212', 'purchase', '24');

SET FOREIGN_KEY_CHECKS = 1;
