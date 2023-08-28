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

 Date: 23/08/2023 17:22:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for shippeds
-- ----------------------------
DROP TABLE IF EXISTS `shippeds`;
CREATE TABLE `shippeds`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shippeds
-- ----------------------------
INSERT INTO `shippeds` VALUES (2, NULL, '	Leopards Overland', NULL, NULL, NULL, NULL);
INSERT INTO `shippeds` VALUES (3, NULL, 'Trax Saverplus', NULL, NULL, NULL, NULL);
INSERT INTO `shippeds` VALUES (4, NULL, '	Rider Overland', '', NULL, NULL, NULL);
INSERT INTO `shippeds` VALUES (5, NULL, 'Karachi Courier', NULL, NULL, NULL, NULL);
INSERT INTO `shippeds` VALUES (6, NULL, 'Trax Rush', NULL, NULL, NULL, NULL);
INSERT INTO `shippeds` VALUES (7, NULL, 'Leopards Overnight', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
