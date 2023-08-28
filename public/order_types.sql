/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantfulfilment1st

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 25/08/2023 12:44:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for order_types
-- ----------------------------
DROP TABLE IF EXISTS `order_types`;
CREATE TABLE `order_types`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_types
-- ----------------------------
INSERT INTO `order_types` VALUES (1, 'Facebook', NULL, NULL);
INSERT INTO `order_types` VALUES (2, 'Twitter', NULL, NULL);
INSERT INTO `order_types` VALUES (3, 'Instagram', NULL, NULL);
INSERT INTO `order_types` VALUES (4, 'WhatsApp', NULL, NULL);
INSERT INTO `order_types` VALUES (5, 'Call', NULL, NULL);
INSERT INTO `order_types` VALUES (6, 'SMS', NULL, NULL);
INSERT INTO `order_types` VALUES (7, 'Checkout', NULL, NULL);
INSERT INTO `order_types` VALUES (8, 'QB-Product', NULL, NULL);
INSERT INTO `order_types` VALUES (9, 'QB-Front', NULL, NULL);
INSERT INTO `order_types` VALUES (10, 'Requested For expired products', NULL, NULL);
INSERT INTO `order_types` VALUES (11, 'QB-Product', NULL, NULL);
INSERT INTO `order_types` VALUES (12, 'Guest Checkout', NULL, NULL);
INSERT INTO `order_types` VALUES (13, 'Android', NULL, NULL);
INSERT INTO `order_types` VALUES (14, 'Apple', NULL, NULL);
INSERT INTO `order_types` VALUES (15, 'Reseller Sale', NULL, NULL);
INSERT INTO `order_types` VALUES (16, 'Shop Sale', NULL, NULL);
INSERT INTO `order_types` VALUES (17, 'Daraz Sale', NULL, NULL);
INSERT INTO `order_types` VALUES (18, 'iShopping Sales ', NULL, NULL);
INSERT INTO `order_types` VALUES (19, 'Telemart Sales', NULL, NULL);
INSERT INTO `order_types` VALUES (20, 'Abandoned Cart', NULL, NULL);
INSERT INTO `order_types` VALUES (21, 'Replacement', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
