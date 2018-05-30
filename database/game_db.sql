/*
 Navicat Premium Data Transfer

 Source Server         : un-mysql
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost
 Source Database       : game_db

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : utf-8

 Date: 05/30/2018 16:14:30 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tbl_player_game`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_player_game`;
CREATE TABLE `tbl_player_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `line` int(11) NOT NULL COMMENT 'n of row (3x3 board)',
  `col` int(11) NOT NULL COMMENT 'n of column',
  `play` int(11) DEFAULT NULL COMMENT 'n# of play',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

SET FOREIGN_KEY_CHECKS = 1;
