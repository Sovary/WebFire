/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : dbfire

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-04-22 15:29:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fcm_info
-- ----------------------------
DROP TABLE IF EXISTS `fcm_info`;
CREATE TABLE `fcm_info` (
  `fcm_token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
