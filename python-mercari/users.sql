/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : vingtorderdb

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 11/02/2021 03:42:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@example.com', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441');
INSERT INTO `users` VALUES (2, 'test1', 'test1@example.com', '*06C0BF5B64ECE2F648B5F048A71903906BA08E5C');
INSERT INTO `users` VALUES (3, 'test2', 'test2@example.com', '*7CEB3FDE5F7A9C4CE5FBE610D7D8EDA62EBE5F4E');
INSERT INTO `users` VALUES (4, 'test3', 'test3@example.com', '*F357E78CABAD76FD3F1018EF85D78499B6ACC431');
INSERT INTO `users` VALUES (5, 'test4', 'test4@example.com', '*D159BBDA31273BE3F4F00715B4A439925C6A0F2D');
INSERT INTO `users` VALUES (6, 'test5', 'test5@example.com', '*30B3620A8C3D75549E8B7F077424EF88B6C798E6');
INSERT INTO `users` VALUES (7, 'test6', 'test6@example.com', '*CFB0272DC9E549723E685BB74CBC3D05E4C2AF54');
INSERT INTO `users` VALUES (8, 'test7', 'test7@example.com', '*DBB670647A544F1A6C7715B6CEB0B386518E30B8');
INSERT INTO `users` VALUES (9, 'test8', 'test8@example.com', '*F88810FD53132CA89291BA2AE8FD63D5A9F031FA');
INSERT INTO `users` VALUES (10, 'test9', 'test9@example.com', '*34521800E7C207ED39F616B4132496F98D6C2A9F');
INSERT INTO `users` VALUES (11, 'test10', 'test10@example.com', '*A112739E5B6A174DC9A8C9D20657467B3A64A5A7');

SET FOREIGN_KEY_CHECKS = 1;
