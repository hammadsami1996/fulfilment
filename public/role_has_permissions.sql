/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : tenantfulfilment1001

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 23/11/2023 15:41:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (51, 1);
INSERT INTO `role_has_permissions` VALUES (52, 1);
INSERT INTO `role_has_permissions` VALUES (53, 1);
INSERT INTO `role_has_permissions` VALUES (54, 1);
INSERT INTO `role_has_permissions` VALUES (55, 1);
INSERT INTO `role_has_permissions` VALUES (58, 1);
INSERT INTO `role_has_permissions` VALUES (59, 1);
INSERT INTO `role_has_permissions` VALUES (60, 1);
INSERT INTO `role_has_permissions` VALUES (61, 1);
INSERT INTO `role_has_permissions` VALUES (62, 1);
INSERT INTO `role_has_permissions` VALUES (64, 1);
INSERT INTO `role_has_permissions` VALUES (65, 1);
INSERT INTO `role_has_permissions` VALUES (66, 1);
INSERT INTO `role_has_permissions` VALUES (67, 1);
INSERT INTO `role_has_permissions` VALUES (68, 1);
INSERT INTO `role_has_permissions` VALUES (76, 1);
INSERT INTO `role_has_permissions` VALUES (77, 1);
INSERT INTO `role_has_permissions` VALUES (78, 1);
INSERT INTO `role_has_permissions` VALUES (79, 1);
INSERT INTO `role_has_permissions` VALUES (80, 1);
INSERT INTO `role_has_permissions` VALUES (82, 1);
INSERT INTO `role_has_permissions` VALUES (83, 1);
INSERT INTO `role_has_permissions` VALUES (84, 1);
INSERT INTO `role_has_permissions` VALUES (85, 1);
INSERT INTO `role_has_permissions` VALUES (86, 1);
INSERT INTO `role_has_permissions` VALUES (100, 1);
INSERT INTO `role_has_permissions` VALUES (101, 1);
INSERT INTO `role_has_permissions` VALUES (102, 1);
INSERT INTO `role_has_permissions` VALUES (103, 1);
INSERT INTO `role_has_permissions` VALUES (104, 1);
INSERT INTO `role_has_permissions` VALUES (106, 1);
INSERT INTO `role_has_permissions` VALUES (107, 1);
INSERT INTO `role_has_permissions` VALUES (108, 1);
INSERT INTO `role_has_permissions` VALUES (109, 1);
INSERT INTO `role_has_permissions` VALUES (110, 1);
INSERT INTO `role_has_permissions` VALUES (118, 1);
INSERT INTO `role_has_permissions` VALUES (119, 1);
INSERT INTO `role_has_permissions` VALUES (120, 1);
INSERT INTO `role_has_permissions` VALUES (121, 1);
INSERT INTO `role_has_permissions` VALUES (122, 1);
INSERT INTO `role_has_permissions` VALUES (124, 1);
INSERT INTO `role_has_permissions` VALUES (125, 1);
INSERT INTO `role_has_permissions` VALUES (126, 1);
INSERT INTO `role_has_permissions` VALUES (127, 1);
INSERT INTO `role_has_permissions` VALUES (128, 1);
INSERT INTO `role_has_permissions` VALUES (136, 1);
INSERT INTO `role_has_permissions` VALUES (137, 1);
INSERT INTO `role_has_permissions` VALUES (138, 1);
INSERT INTO `role_has_permissions` VALUES (139, 1);
INSERT INTO `role_has_permissions` VALUES (140, 1);
INSERT INTO `role_has_permissions` VALUES (142, 1);
INSERT INTO `role_has_permissions` VALUES (143, 1);
INSERT INTO `role_has_permissions` VALUES (144, 1);
INSERT INTO `role_has_permissions` VALUES (145, 1);
INSERT INTO `role_has_permissions` VALUES (146, 1);
INSERT INTO `role_has_permissions` VALUES (148, 1);
INSERT INTO `role_has_permissions` VALUES (149, 1);
INSERT INTO `role_has_permissions` VALUES (150, 1);
INSERT INTO `role_has_permissions` VALUES (151, 1);
INSERT INTO `role_has_permissions` VALUES (152, 1);
INSERT INTO `role_has_permissions` VALUES (154, 1);
INSERT INTO `role_has_permissions` VALUES (155, 1);
INSERT INTO `role_has_permissions` VALUES (156, 1);
INSERT INTO `role_has_permissions` VALUES (157, 1);
INSERT INTO `role_has_permissions` VALUES (158, 1);
INSERT INTO `role_has_permissions` VALUES (160, 1);
INSERT INTO `role_has_permissions` VALUES (161, 1);
INSERT INTO `role_has_permissions` VALUES (162, 1);
INSERT INTO `role_has_permissions` VALUES (163, 1);
INSERT INTO `role_has_permissions` VALUES (164, 1);
INSERT INTO `role_has_permissions` VALUES (166, 1);
INSERT INTO `role_has_permissions` VALUES (167, 1);
INSERT INTO `role_has_permissions` VALUES (168, 1);
INSERT INTO `role_has_permissions` VALUES (169, 1);
INSERT INTO `role_has_permissions` VALUES (170, 1);
INSERT INTO `role_has_permissions` VALUES (172, 1);
INSERT INTO `role_has_permissions` VALUES (173, 1);
INSERT INTO `role_has_permissions` VALUES (174, 1);
INSERT INTO `role_has_permissions` VALUES (175, 1);
INSERT INTO `role_has_permissions` VALUES (176, 1);
INSERT INTO `role_has_permissions` VALUES (178, 1);
INSERT INTO `role_has_permissions` VALUES (179, 1);
INSERT INTO `role_has_permissions` VALUES (180, 1);
INSERT INTO `role_has_permissions` VALUES (181, 1);
INSERT INTO `role_has_permissions` VALUES (182, 1);
INSERT INTO `role_has_permissions` VALUES (184, 1);
INSERT INTO `role_has_permissions` VALUES (185, 1);
INSERT INTO `role_has_permissions` VALUES (186, 1);
INSERT INTO `role_has_permissions` VALUES (187, 1);
INSERT INTO `role_has_permissions` VALUES (188, 1);
INSERT INTO `role_has_permissions` VALUES (190, 1);
INSERT INTO `role_has_permissions` VALUES (191, 1);
INSERT INTO `role_has_permissions` VALUES (192, 1);
INSERT INTO `role_has_permissions` VALUES (193, 1);
INSERT INTO `role_has_permissions` VALUES (194, 1);
INSERT INTO `role_has_permissions` VALUES (202, 1);
INSERT INTO `role_has_permissions` VALUES (203, 1);
INSERT INTO `role_has_permissions` VALUES (204, 1);
INSERT INTO `role_has_permissions` VALUES (205, 1);
INSERT INTO `role_has_permissions` VALUES (206, 1);
INSERT INTO `role_has_permissions` VALUES (208, 1);
INSERT INTO `role_has_permissions` VALUES (209, 1);
INSERT INTO `role_has_permissions` VALUES (210, 1);
INSERT INTO `role_has_permissions` VALUES (211, 1);
INSERT INTO `role_has_permissions` VALUES (212, 1);
INSERT INTO `role_has_permissions` VALUES (214, 1);
INSERT INTO `role_has_permissions` VALUES (215, 1);
INSERT INTO `role_has_permissions` VALUES (216, 1);
INSERT INTO `role_has_permissions` VALUES (217, 1);
INSERT INTO `role_has_permissions` VALUES (218, 1);
INSERT INTO `role_has_permissions` VALUES (220, 1);
INSERT INTO `role_has_permissions` VALUES (221, 1);
INSERT INTO `role_has_permissions` VALUES (222, 1);
INSERT INTO `role_has_permissions` VALUES (223, 1);
INSERT INTO `role_has_permissions` VALUES (224, 1);
INSERT INTO `role_has_permissions` VALUES (226, 1);
INSERT INTO `role_has_permissions` VALUES (227, 1);
INSERT INTO `role_has_permissions` VALUES (228, 1);
INSERT INTO `role_has_permissions` VALUES (229, 1);
INSERT INTO `role_has_permissions` VALUES (230, 1);
INSERT INTO `role_has_permissions` VALUES (232, 1);
INSERT INTO `role_has_permissions` VALUES (233, 1);
INSERT INTO `role_has_permissions` VALUES (234, 1);
INSERT INTO `role_has_permissions` VALUES (235, 1);
INSERT INTO `role_has_permissions` VALUES (236, 1);
INSERT INTO `role_has_permissions` VALUES (238, 1);
INSERT INTO `role_has_permissions` VALUES (239, 1);
INSERT INTO `role_has_permissions` VALUES (240, 1);
INSERT INTO `role_has_permissions` VALUES (241, 1);
INSERT INTO `role_has_permissions` VALUES (242, 1);
INSERT INTO `role_has_permissions` VALUES (244, 1);
INSERT INTO `role_has_permissions` VALUES (245, 1);
INSERT INTO `role_has_permissions` VALUES (246, 1);
INSERT INTO `role_has_permissions` VALUES (247, 1);
INSERT INTO `role_has_permissions` VALUES (248, 1);
INSERT INTO `role_has_permissions` VALUES (250, 1);
INSERT INTO `role_has_permissions` VALUES (251, 1);
INSERT INTO `role_has_permissions` VALUES (252, 1);
INSERT INTO `role_has_permissions` VALUES (253, 1);
INSERT INTO `role_has_permissions` VALUES (70, 1);
INSERT INTO `role_has_permissions` VALUES (71, 1);
INSERT INTO `role_has_permissions` VALUES (72, 1);
INSERT INTO `role_has_permissions` VALUES (73, 1);
INSERT INTO `role_has_permissions` VALUES (74, 1);
INSERT INTO `role_has_permissions` VALUES (262, 1);
INSERT INTO `role_has_permissions` VALUES (263, 1);
INSERT INTO `role_has_permissions` VALUES (264, 1);
INSERT INTO `role_has_permissions` VALUES (265, 1);
INSERT INTO `role_has_permissions` VALUES (266, 1);
INSERT INTO `role_has_permissions` VALUES (268, 1);
INSERT INTO `role_has_permissions` VALUES (269, 1);
INSERT INTO `role_has_permissions` VALUES (270, 1);
INSERT INTO `role_has_permissions` VALUES (271, 1);
INSERT INTO `role_has_permissions` VALUES (272, 1);
INSERT INTO `role_has_permissions` VALUES (274, 1);
INSERT INTO `role_has_permissions` VALUES (275, 1);
INSERT INTO `role_has_permissions` VALUES (276, 1);
INSERT INTO `role_has_permissions` VALUES (277, 1);
INSERT INTO `role_has_permissions` VALUES (278, 1);
INSERT INTO `role_has_permissions` VALUES (280, 1);
INSERT INTO `role_has_permissions` VALUES (281, 1);
INSERT INTO `role_has_permissions` VALUES (282, 1);
INSERT INTO `role_has_permissions` VALUES (283, 1);
INSERT INTO `role_has_permissions` VALUES (284, 1);
INSERT INTO `role_has_permissions` VALUES (285, 1);
INSERT INTO `role_has_permissions` VALUES (286, 1);
INSERT INTO `role_has_permissions` VALUES (287, 1);
INSERT INTO `role_has_permissions` VALUES (288, 1);
INSERT INTO `role_has_permissions` VALUES (289, 1);
INSERT INTO `role_has_permissions` VALUES (290, 1);
INSERT INTO `role_has_permissions` VALUES (291, 1);
INSERT INTO `role_has_permissions` VALUES (292, 1);
INSERT INTO `role_has_permissions` VALUES (293, 1);
INSERT INTO `role_has_permissions` VALUES (294, 1);
INSERT INTO `role_has_permissions` VALUES (295, 1);
INSERT INTO `role_has_permissions` VALUES (296, 1);

SET FOREIGN_KEY_CHECKS = 1;
