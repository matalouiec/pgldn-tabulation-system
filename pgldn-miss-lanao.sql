/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : pgldn-miss-lanao

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 20/06/2019 15:27:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `levelid` int(10) UNSIGNED NOT NULL,
  `percentage` double(8, 2) NOT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_levels`(`levelid`) USING BTREE,
  CONSTRAINT `fk_levels` FOREIGN KEY (`levelid`) REFERENCES `levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (14, 'Question and Answer', 'Question and Answer (5 Finalists)', 0, '2018-09-10 02:42:44', '2019-06-17 22:22:18', 1, 100.00, '/judge-category/question-and-answer');
INSERT INTO `category` VALUES (15, 'Preliminary Interview', 'Preliminary Interview / Screening Proper 50/50', 0, '2018-09-19 01:01:20', '2019-06-17 21:50:09', 3, 100.00, '/judge-category/preliminary-interview');
INSERT INTO `category` VALUES (16, 'Maranao Inspired Gown', 'Maranao Inspired Gown', 0, '2018-09-19 01:01:51', '2019-06-17 21:47:25', 3, 100.00, '/judge-category/maranao-inspired-gown');
INSERT INTO `category` VALUES (17, 'Swim Wear', 'Swim Wear', 0, '2018-09-19 12:28:26', '2019-06-17 21:37:51', 3, 100.00, '/judge-category/swim-wear');
INSERT INTO `category` VALUES (18, 'Cocktail Dress', 'Cocktail Dress', 0, '2018-09-19 12:28:59', '2019-06-17 21:34:10', 3, 100.00, '/judge-category/cocktail-dress');
INSERT INTO `category` VALUES (19, 'Festival Costume', 'Festival Costume', 0, '2019-01-21 21:42:49', '2019-06-17 21:35:51', 3, 100.00, '/judge-category/festival-costume');

-- ----------------------------
-- Table structure for contestant
-- ----------------------------
DROP TABLE IF EXISTS `contestant`;
CREATE TABLE `contestant`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `representing` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `age` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `graphcolor` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `isactive` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contestant
-- ----------------------------
INSERT INTO `contestant` VALUES (21, 1, 'Erika Jane Delfin', 'Municipality of Baroy', 'From the land of beauty and bounty', '25', '1.jpg', '2018-09-19 12:11:06', '2019-06-12 03:29:00', '#90ee90', 'female', 1);
INSERT INTO `contestant` VALUES (23, 2, 'Princess Nicole Segundo', 'Municipality of Kolambugan', 'Beauty', '22', '2.jpg', '2018-09-19 12:13:42', '2019-06-12 03:29:17', '#ADD8E6', 'female', 1);
INSERT INTO `contestant` VALUES (25, 3, 'L. A. Tangaro', 'Municipality of Magsaysay', '-', '23', '1.jpg', '2018-09-19 12:15:40', '2018-09-19 12:15:42', '#adbce6', 'female', 1);
INSERT INTO `contestant` VALUES (27, 4, 'Janine Chilo Chin', 'Municipality of Maigo', '-', '25', '1.jpg', '2018-09-19 12:17:07', '2018-09-19 12:17:09', '#ade6d8', 'female', 1);
INSERT INTO `contestant` VALUES (29, 5, 'Karen Adanza', 'Municipality of Matungao', '-', '21', '1.jpg', '2018-09-19 12:18:38', '2018-09-19 12:18:40', '#e6add8', 'female', 1);
INSERT INTO `contestant` VALUES (31, 6, 'Charmane Pagkalinawan', 'Municipality of Nunungan', '-', '25', '1.jpg', '2018-09-19 12:21:35', '2018-09-19 12:21:37', '#d8e6ad', 'female', 1);
INSERT INTO `contestant` VALUES (33, 7, 'Adel C. Ebarat', 'Municipality of Sapad', '-', '20', '1.jpg', '2018-09-19 12:23:38', '2018-09-19 12:23:40', '#d8ade6', 'female', 1);
INSERT INTO `contestant` VALUES (35, 8, 'Rochelle Mae Jabla', 'Municipality of SND', '-', '24', '1.jpg', '2018-09-19 12:25:10', '2018-09-19 12:25:13', '#bbe6ad', 'female', 1);
INSERT INTO `contestant` VALUES (36, 9, 'Patricia Venus Pabes', 'Municipality of Tubod', '-', '19', '1.jpg', '2019-06-05 01:20:14', '2019-06-05 01:20:17', '#bbe6ad', 'female', 1);
INSERT INTO `contestant` VALUES (37, 10, 'Louise Andrea Wong', 'Municipality of Bacolod', '-', '21', '1.jpg', '2019-06-05 01:23:11', '2019-06-05 01:23:15', '#bbe6ad', 'female', 1);

-- ----------------------------
-- Table structure for criteria
-- ----------------------------
DROP TABLE IF EXISTS `criteria`;
CREATE TABLE `criteria`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `criteria_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double(8, 2) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `subcategoryid` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `criteria_category_id_foreign`(`category_id`) USING BTREE,
  CONSTRAINT `criteria_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 84 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of criteria
-- ----------------------------
INSERT INTO `criteria` VALUES (61, 14, 'Intelligence (Content, Grammar & Pronunciation)', 40.00, '2019-01-21 21:29:13', '2019-01-21 21:29:13', 1);
INSERT INTO `criteria` VALUES (62, 14, 'Personal Outlook (Beauty of Face)', 40.00, '2019-01-21 21:29:43', '2019-01-21 21:29:43', 1);
INSERT INTO `criteria` VALUES (63, 14, 'Overall Performance', 20.00, '2019-01-21 21:30:00', '2019-01-21 21:30:00', 1);
INSERT INTO `criteria` VALUES (65, 15, 'Intelligence (Content, Grammar & Pronunciation)', 100.00, '2019-01-21 21:31:15', '2019-01-21 21:31:15', 1);
INSERT INTO `criteria` VALUES (66, 16, 'Cultural Relevance', 30.00, '2019-01-21 21:32:25', '2019-01-21 21:32:25', 1);
INSERT INTO `criteria` VALUES (67, 16, 'Suitability to the Wearer', 20.00, '2019-01-21 21:32:52', '2019-01-21 21:32:52', 1);
INSERT INTO `criteria` VALUES (68, 16, 'Poise & Bearing Personality', 20.00, '2019-01-21 21:33:22', '2019-01-21 21:33:22', 1);
INSERT INTO `criteria` VALUES (69, 16, 'Elegance', 20.00, '2019-01-21 21:33:37', '2019-01-21 21:33:37', 1);
INSERT INTO `criteria` VALUES (70, 16, 'Beauty of the Face', 10.00, '2019-01-21 21:35:00', '2019-01-21 21:35:00', 1);
INSERT INTO `criteria` VALUES (71, 17, 'Beauty of Figure', 40.00, '2019-01-21 21:36:28', '2019-01-21 21:36:28', 1);
INSERT INTO `criteria` VALUES (72, 17, 'Beauty of the Face', 30.00, '2019-01-21 21:36:44', '2019-01-21 21:36:44', 1);
INSERT INTO `criteria` VALUES (73, 17, 'Poise & Bearing Personality', 20.00, '2019-01-21 21:37:05', '2019-01-21 21:37:05', 1);
INSERT INTO `criteria` VALUES (74, 17, 'Overall Impact', 10.00, '2019-01-21 21:37:35', '2019-01-21 21:37:35', 1);
INSERT INTO `criteria` VALUES (75, 18, 'Fitness of the Suit', 30.00, '2019-01-21 21:40:49', '2019-01-21 21:40:49', 1);
INSERT INTO `criteria` VALUES (76, 18, 'Poise & Bearing Personality', 30.00, '2019-01-21 21:41:28', '2019-01-21 21:41:28', 1);
INSERT INTO `criteria` VALUES (77, 18, 'Confidence', 20.00, '2019-01-21 21:41:53', '2019-01-21 21:41:53', 1);
INSERT INTO `criteria` VALUES (78, 18, 'Beauty of the Face', 20.00, '2019-01-21 21:42:15', '2019-01-21 21:42:15', 1);
INSERT INTO `criteria` VALUES (79, 19, 'Creativity, Style and Design of the Costume', 40.00, '2019-01-21 21:43:48', '2019-01-21 21:43:48', 1);
INSERT INTO `criteria` VALUES (80, 19, 'Ethnicity of Materials Used', 30.00, '2019-01-21 21:44:19', '2019-01-21 21:44:19', 1);
INSERT INTO `criteria` VALUES (81, 19, 'Fitness of the Attire', 20.00, '2019-01-21 21:44:57', '2019-01-21 21:44:57', 1);
INSERT INTO `criteria` VALUES (82, 19, 'Confidence/ Poise/ Projection', 10.00, '2019-01-21 21:45:41', '2019-01-21 21:45:41', 1);

-- ----------------------------
-- Table structure for finalist
-- ----------------------------
DROP TABLE IF EXISTS `finalist`;
CREATE TABLE `finalist`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `contestantid` int(10) NOT NULL,
  `deleted_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `num_tops` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES (1, 'final', 50, '2018-09-10 10:42:07', '2018-09-10 10:42:09');
INSERT INTO `levels` VALUES (3, 'preliminary', 50, '2018-09-10 10:42:07', '2018-09-10 10:42:07');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (6, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (7, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (8, '2018_01_31_015017_category', 1);
INSERT INTO `migrations` VALUES (9, '2018_02_01_052055_contestant', 1);
INSERT INTO `migrations` VALUES (10, '2018_02_05_054928_create_criteria_table', 1);
INSERT INTO `migrations` VALUES (11, '2018_03_01_000839_rating', 1);
INSERT INTO `migrations` VALUES (12, '2018_03_01_010106_rating_entry', 1);
INSERT INTO `migrations` VALUES (13, '2018_03_23_071527_add_column_totalrating_to_rating', 2);
INSERT INTO `migrations` VALUES (15, '2018_05_24_023219_create_levels_table', 3);
INSERT INTO `migrations` VALUES (16, '2018_05_29_022818_add_columnto_category', 4);
INSERT INTO `migrations` VALUES (17, '2018_06_06_055209_add_colorto_contestant', 5);
INSERT INTO `migrations` VALUES (18, '2018_06_22_050204_create_sub_categories_table', 6);
INSERT INTO `migrations` VALUES (19, '2018_06_22_051345_add_column_criteria', 7);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('matalouiec@gmail.com', '$2y$10$u8QyMJWmhhZZTupvNZfPW.a2kPUryE53aWCrbYWYlBV42UazSCcsK', '2019-06-06 13:59:56');

-- ----------------------------
-- Table structure for ranks
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categoryid` int(10) NOT NULL,
  `contestantid` int(10) NOT NULL,
  `rank` int(5) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ix_category`(`categoryid`) USING BTREE,
  INDEX `ix_contestant`(`contestantid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rating
-- ----------------------------
DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judgeid` int(10) UNSIGNED NOT NULL,
  `categoryid` int(10) UNSIGNED NOT NULL,
  `contestantid` int(10) UNSIGNED NOT NULL,
  `is_final` tinyint(1) NOT NULL DEFAULT 0,
  `finalized_on` datetime(0) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `totalrating` double(8, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rating_judgeid_foreign`(`judgeid`) USING BTREE,
  INDEX `rating_categoryid_foreign`(`categoryid`) USING BTREE,
  INDEX `rating_contestantid_foreign`(`contestantid`) USING BTREE,
  CONSTRAINT `rating_categoryid_foreign` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rating_contestantid_foreign` FOREIGN KEY (`contestantid`) REFERENCES `contestant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rating_judgeid_foreign` FOREIGN KEY (`judgeid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1813 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rating_entry
-- ----------------------------
DROP TABLE IF EXISTS `rating_entry`;
CREATE TABLE `rating_entry`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parentid` int(10) UNSIGNED NOT NULL,
  `judgeid` int(10) UNSIGNED NOT NULL,
  `categoryid` int(10) UNSIGNED NOT NULL,
  `criteriaid` int(10) UNSIGNED NOT NULL,
  `contestantid` int(10) UNSIGNED NOT NULL,
  `acquired_rating` double(8, 2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rating_entry_parentid_foreign`(`parentid`) USING BTREE,
  INDEX `rating_entry_judgeid_foreign`(`judgeid`) USING BTREE,
  INDEX `rating_entry_categoryid_foreign`(`categoryid`) USING BTREE,
  INDEX `rating_entry_criteriaid_foreign`(`criteriaid`) USING BTREE,
  INDEX `rating_entry_contestantid_foreign`(`contestantid`) USING BTREE,
  CONSTRAINT `rating_entry_categoryid_foreign` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rating_entry_contestantid_foreign` FOREIGN KEY (`contestantid`) REFERENCES `contestant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rating_entry_criteriaid_foreign` FOREIGN KEY (`criteriaid`) REFERENCES `criteria` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rating_entry_judgeid_foreign` FOREIGN KEY (`judgeid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rating_entry_parentid_foreign` FOREIGN KEY (`parentid`) REFERENCES `rating` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 976 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sub_category
-- ----------------------------
DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE `sub_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_category
-- ----------------------------
INSERT INTO `sub_category` VALUES (1, 'PERFORMANCE', '2018-06-23 04:06:34', '2018-06-23 04:06:40');
INSERT INTO `sub_category` VALUES (2, 'MUSICALITY', '2018-06-23 04:06:50', '2018-06-23 04:06:53');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 102 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Jojo Bragais', 'judge1', '$2y$10$bZ2NN6XMrWbpyOjEbikVPe29oAov03Rwo.yL/vvS7DRynISpUmblq', '6r6f7pLFxXTImCKGl4KmvqeEgtfeyTfZNzVN7NxUZNvlCzybLA5sfWjuDrFX', 0, '2018-03-16 00:33:16', '2018-03-16 00:33:16');
INSERT INTO `users` VALUES (3, 'Jody Baines Saliba', 'judge2', '$2y$10$oOp4vBim9Juf5O9rq4rET.sAUPZeP8La1rkqN9sAXmGiVY7GLbzAy', 'MyCOaV6AlQaS5SAE3idtTAvJKESmyjatThAohqL6Kqf9jCP218t1DM9QI2Ag', 0, '2018-05-23 16:08:05', '2018-05-23 16:08:05');
INSERT INTO `users` VALUES (4, 'Arnold Mercado', 'judge3', '$2y$10$NKs34x0L3WDcUxadW00ihuqdtKteHRObMXtaQaxSAacTSwsByHzWS', 'xJdxxQlCm4LccIVtWQu7ZUx5fqJ9dvN83hOHe7nlrmPGOUI3psI9Lb10Gdem', 0, '2018-06-26 20:33:42', '2018-06-26 20:33:42');
INSERT INTO `users` VALUES (5, 'Maureen Montagne', 'judge4', '$2y$10$7vz2P/9yP2n/gNjOMmvsJOuUrvco3Yt9Dvi0c1nyYtOphjZms6bKG', 'xZuGDQ0OOjuv2eLbMsdy1AzalawPIOxNAko4tDPAqX4UYr584GJiTiG7XWYq', 0, '2018-03-16 00:33:55', '2018-03-16 00:33:55');
INSERT INTO `users` VALUES (6, 'Dir. Marie Elaine S. Unchuan', 'judge5', '$2y$10$7vz2P/9yP2n/gNjOMmvsJOuUrvco3Yt9Dvi0c1nyYtOphjZms6bKG', '4IKbi32MhgXwdyMb0fcU2jC2mOB9kLUPbQQRz5LgHK8WpGWY0MUhyqxHUFqC', 0, '2018-03-16 00:33:55', '2018-03-16 00:33:55');
INSERT INTO `users` VALUES (100, 'System Administrator', 'matalouiec@gmail.com', '$2y$10$7vz2P/9yP2n/gNjOMmvsJOuUrvco3Yt9Dvi0c1nyYtOphjZms6bKG', 'ZhKDdqcb2zcWeJU3YEa4EmsEXFQl22MpwGBrBVvIlI2FL6XuaC3KInQHuBIq', 1, '2018-03-16 00:33:55', '2018-03-16 00:33:55');

-- ----------------------------
-- View structure for per_judge_qa
-- ----------------------------
DROP VIEW IF EXISTS `per_judge_qa`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `per_judge_qa` AS select `xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`Interpretation` AS `Interpretation`,`xx`.`Choreography` AS `Choreography`,`xx`.`Costume` AS `Costume`,`xx`.`Sagayan Beat` AS `Sagayan_Beat`,`xx`.`Rhythm` AS `Rhythm`,`xx`.`TOTAL` AS `TOTAL` from (select `re`.`judgeid` AS `Judge`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,sum(case when `cr`.`id` = 37 then `re`.`acquired_rating` end) AS `Interpretation`,sum(case when `cr`.`id` = 38 then `re`.`acquired_rating` end) AS `Choreography`,sum(case when `cr`.`id` = 39 then `re`.`acquired_rating` end) AS `Costume`,sum(case when `cr`.`id` = 40 then `re`.`acquired_rating` end) AS `Sagayan Beat`,sum(case when `cr`.`id` = 41 then `re`.`acquired_rating` end) AS `Rhythm`,sum(`re`.`acquired_rating`) AS `TOTAL` from ((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for per_judge_ranking
-- ----------------------------
DROP VIEW IF EXISTS `per_judge_ranking`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `per_judge_ranking` AS select `xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`Interpretation` AS `Interpretation`,`xx`.`Choreography` AS `Choreography`,`xx`.`Costume` AS `Costume`,`xx`.`Sagayan Beat` AS `Sagayan_Beat`,`xx`.`Rhythm` AS `Rhythm`,`xx`.`TOTAL` AS `TOTAL` from (select `re`.`judgeid` AS `Judge`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,sum(case when `cr`.`id` = 37 then `re`.`acquired_rating` end) AS `Interpretation`,sum(case when `cr`.`id` = 38 then `re`.`acquired_rating` end) AS `Choreography`,sum(case when `cr`.`id` = 39 then `re`.`acquired_rating` end) AS `Costume`,sum(case when `cr`.`id` = 40 then `re`.`acquired_rating` end) AS `Sagayan Beat`,sum(case when `cr`.`id` = 41 then `re`.`acquired_rating` end) AS `Rhythm`,sum(`re`.`acquired_rating`) AS `TOTAL` from ((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for vw_cocktaildress
-- ----------------------------
DROP VIEW IF EXISTS `vw_cocktaildress`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cocktaildress` AS select `xx`.`contestantid` AS `contestantid`,`xx`.`categoryid` AS `categoryid`,`xx`.`representing` AS `representing`,`xx`.`isFinal` AS `isFinal`,`xx`.`parent` AS `parent`,`xx`.`backcolor` AS `backcolor`,`xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`fitness` AS `fitness`,`xx`.`poise` AS `poise`,`xx`.`confidence` AS `confidence`,`xx`.`beauty` AS `beauty`,`xx`.`TOTAL` AS `TOTAL` from (select `r`.`is_final` AS `isFinal`,`re`.`parentid` AS `parent`,`re`.`judgeid` AS `Judge`,`c`.`id` AS `contestantid`,`cr`.`category_id` AS `categoryid`,`c`.`representing` AS `representing`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,`c`.`graphcolor` AS `backcolor`,`c`.`gender` AS `gender`,sum(case when `cr`.`id` = 75 then `re`.`acquired_rating` end) AS `fitness`,sum(case when `cr`.`id` = 76 then `re`.`acquired_rating` end) AS `poise`,sum(case when `cr`.`id` = 77 then `re`.`acquired_rating` end) AS `confidence`,sum(case when `cr`.`id` = 78 then `re`.`acquired_rating` end) AS `beauty`,sum(`re`.`acquired_rating`) AS `TOTAL` from (((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) join `pgldn-miss-lanao`.`rating` `r` on(`re`.`parentid` = `r`.`id`)) where `cr`.`category_id` = 18 group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for vw_festivalcostume
-- ----------------------------
DROP VIEW IF EXISTS `vw_festivalcostume`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vw_festivalcostume` AS select `xx`.`contestantid` AS `contestantid`,`xx`.`categoryid` AS `categoryid`,`xx`.`representing` AS `representing`,`xx`.`isFinal` AS `isFinal`,`xx`.`parent` AS `parent`,`xx`.`backcolor` AS `backcolor`,`xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`col1` AS `creativity`,`xx`.`col2` AS `ethnicity`,`xx`.`col3` AS `fitness`,`xx`.`col4` AS `confidence`,`xx`.`TOTAL` AS `TOTAL` from (select `r`.`is_final` AS `isFinal`,`re`.`parentid` AS `parent`,`re`.`judgeid` AS `Judge`,`c`.`id` AS `contestantid`,`cr`.`category_id` AS `categoryid`,`c`.`representing` AS `representing`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,`c`.`graphcolor` AS `backcolor`,`c`.`gender` AS `gender`,sum(case when `cr`.`id` = 79 then `re`.`acquired_rating` end) AS `col1`,sum(case when `cr`.`id` = 80 then `re`.`acquired_rating` end) AS `col2`,sum(case when `cr`.`id` = 81 then `re`.`acquired_rating` end) AS `col3`,sum(case when `cr`.`id` = 82 then `re`.`acquired_rating` end) AS `col4`,sum(`re`.`acquired_rating`) AS `TOTAL` from (((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) join `pgldn-miss-lanao`.`rating` `r` on(`re`.`parentid` = `r`.`id`)) where `cr`.`category_id` = 19 group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for vw_interview
-- ----------------------------
DROP VIEW IF EXISTS `vw_interview`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vw_interview` AS select `xx`.`contestantid` AS `contestantid`,`xx`.`categoryid` AS `categoryid`,`xx`.`representing` AS `representing`,`xx`.`isFinal` AS `isFinal`,`xx`.`backcolor` AS `backcolor`,`xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`parent` AS `parent`,`xx`.`col2` AS `intelligence`,`xx`.`TOTAL` AS `TOTAL` from (select `r`.`is_final` AS `isFinal`,`re`.`judgeid` AS `Judge`,`re`.`parentid` AS `parent`,`c`.`id` AS `contestantid`,`cr`.`category_id` AS `categoryid`,`c`.`representing` AS `representing`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,`c`.`graphcolor` AS `backcolor`,`c`.`gender` AS `gender`,sum(case when `cr`.`id` = 65 then `re`.`acquired_rating` end) AS `col2`,sum(`re`.`acquired_rating`) AS `TOTAL` from (((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) join `pgldn-miss-lanao`.`rating` `r` on(`re`.`parentid` = `r`.`id`)) where `cr`.`category_id` = 15 group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for vw_maranao
-- ----------------------------
DROP VIEW IF EXISTS `vw_maranao`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vw_maranao` AS select `xx`.`contestantid` AS `contestantid`,`xx`.`categoryid` AS `categoryid`,`xx`.`representing` AS `representing`,`xx`.`isFinal` AS `isFinal`,`xx`.`parent` AS `parent`,`xx`.`backcolor` AS `backcolor`,`xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`col1` AS `relevance`,`xx`.`col2` AS `wearer`,`xx`.`col3` AS `personality`,`xx`.`col4` AS `elegance`,`xx`.`col5` AS `face`,`xx`.`TOTAL` AS `TOTAL` from (select `r`.`is_final` AS `isFinal`,`re`.`parentid` AS `parent`,`re`.`judgeid` AS `Judge`,`c`.`id` AS `contestantid`,`cr`.`category_id` AS `categoryid`,`c`.`representing` AS `representing`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,`c`.`graphcolor` AS `backcolor`,`c`.`gender` AS `gender`,sum(case when `cr`.`id` = 66 then `re`.`acquired_rating` end) AS `col1`,sum(case when `cr`.`id` = 67 then `re`.`acquired_rating` end) AS `col2`,sum(case when `cr`.`id` = 68 then `re`.`acquired_rating` end) AS `col3`,sum(case when `cr`.`id` = 69 then `re`.`acquired_rating` end) AS `col4`,sum(case when `cr`.`id` = 70 then `re`.`acquired_rating` end) AS `col5`,sum(`re`.`acquired_rating`) AS `TOTAL` from (((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) join `pgldn-miss-lanao`.`rating` `r` on(`re`.`parentid` = `r`.`id`)) where `cr`.`category_id` = 16 group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for vw_qa
-- ----------------------------
DROP VIEW IF EXISTS `vw_qa`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vw_qa` AS select `xx`.`contestantid` AS `contestantid`,`xx`.`categoryid` AS `categoryid`,`xx`.`representing` AS `representing`,`xx`.`isFinal` AS `isFinal`,`xx`.`parent` AS `parent`,`xx`.`backcolor` AS `backcolor`,`xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`col1` AS `intelligence`,`xx`.`col2` AS `outlook`,`xx`.`col3` AS `performance`,`xx`.`TOTAL` AS `TOTAL` from (select `r`.`is_final` AS `isFinal`,`re`.`parentid` AS `parent`,`re`.`judgeid` AS `Judge`,`c`.`id` AS `contestantid`,`cr`.`category_id` AS `categoryid`,`c`.`representing` AS `representing`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,`c`.`graphcolor` AS `backcolor`,`c`.`gender` AS `gender`,sum(case when `cr`.`id` = 61 then `re`.`acquired_rating` end) AS `col1`,sum(case when `cr`.`id` = 62 then `re`.`acquired_rating` end) AS `col2`,sum(case when `cr`.`id` = 63 then `re`.`acquired_rating` end) AS `col3`,sum(`re`.`acquired_rating`) AS `TOTAL` from (((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) join `pgldn-miss-lanao`.`rating` `r` on(`re`.`parentid` = `r`.`id`)) where `cr`.`category_id` = 14 group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

-- ----------------------------
-- View structure for vw_swimwear
-- ----------------------------
DROP VIEW IF EXISTS `vw_swimwear`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `vw_swimwear` AS select `xx`.`contestantid` AS `contestantid`,`xx`.`categoryid` AS `categoryid`,`xx`.`representing` AS `representing`,`xx`.`isFinal` AS `isFinal`,`xx`.`parent` AS `parent`,`xx`.`backcolor` AS `backcolor`,`xx`.`Judge` AS `Judge`,concat('#',`xx`.`seqno`,' - ',`xx`.`Contestants`) AS `Contestants`,`xx`.`col1` AS `figure`,`xx`.`col2` AS `face`,`xx`.`col3` AS `personality`,`xx`.`col4` AS `impact`,`xx`.`TOTAL` AS `TOTAL` from (select `r`.`is_final` AS `isFinal`,`re`.`parentid` AS `parent`,`re`.`judgeid` AS `Judge`,`c`.`id` AS `contestantid`,`cr`.`category_id` AS `categoryid`,`c`.`representing` AS `representing`,`c`.`number` AS `seqno`,`c`.`name` AS `Contestants`,`c`.`graphcolor` AS `backcolor`,`c`.`gender` AS `gender`,sum(case when `cr`.`id` = 71 then `re`.`acquired_rating` end) AS `col1`,sum(case when `cr`.`id` = 72 then `re`.`acquired_rating` end) AS `col2`,sum(case when `cr`.`id` = 73 then `re`.`acquired_rating` end) AS `col3`,sum(case when `cr`.`id` = 74 then `re`.`acquired_rating` end) AS `col4`,sum(`re`.`acquired_rating`) AS `TOTAL` from (((`pgldn-miss-lanao`.`rating_entry` `re` join `pgldn-miss-lanao`.`contestant` `c` on(`re`.`contestantid` = `c`.`id`)) join `pgldn-miss-lanao`.`criteria` `cr` on(`re`.`criteriaid` = `cr`.`id`)) join `pgldn-miss-lanao`.`rating` `r` on(`re`.`parentid` = `r`.`id`)) where `cr`.`category_id` = 17 group by `c`.`name`,`re`.`judgeid` order by `cr`.`id`) `xx` order by `xx`.`TOTAL` desc;

SET FOREIGN_KEY_CHECKS = 1;
