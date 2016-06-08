/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : appemob

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-02-23 17:18:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `adminlist`
-- ----------------------------
DROP TABLE IF EXISTS `adminlist`;
CREATE TABLE `adminlist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adminlist
-- ----------------------------

-- ----------------------------
-- Table structure for `admin_loglist`
-- ----------------------------
DROP TABLE IF EXISTS `admin_loglist`;
CREATE TABLE `admin_loglist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) DEFAULT NULL,
  `log` text,
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_loglist
-- ----------------------------

-- ----------------------------
-- Table structure for `applist`
-- ----------------------------
DROP TABLE IF EXISTS `applist`;
CREATE TABLE `applist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `appid` int(11) DEFAULT NULL COMMENT 'APP ID',
  `name` varchar(255) DEFAULT NULL COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `title` varchar(255) DEFAULT '' COMMENT '应用标题',
  `subtitle` tinytext COMMENT '应用介绍',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `install` int(20) DEFAULT NULL COMMENT '应用安装量',
  `size` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `bid` varchar(255) DEFAULT '' COMMENT '竞价大小',
  `status` varchar(255) DEFAULT '' COMMENT 'App状态',
  `time` varchar(255) DEFAULT '' COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of applist
-- ----------------------------

-- ----------------------------
-- Table structure for `devlist`
-- ----------------------------
DROP TABLE IF EXISTS `devlist`;
CREATE TABLE `devlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '所属用户的ID',
  `devid` int(11) DEFAULT NULL COMMENT '开发者ID',
  `name` varchar(255) DEFAULT '' COMMENT '开发者名称',
  `email` varchar(255) DEFAULT '' COMMENT '开发者邮箱',
  `address` varchar(255) DEFAULT '' COMMENT '开发者地址',
  `website` varchar(255) DEFAULT '' COMMENT '开发者网站',
  `level` varchar(255) DEFAULT '' COMMENT '开发者级别,顶尖或普通',
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of devlist
-- ----------------------------

-- ----------------------------
-- Table structure for `install_detail`
-- ----------------------------
DROP TABLE IF EXISTS `install_detail`;
CREATE TABLE `install_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_appid` int(11) DEFAULT NULL COMMENT '引导下载的APPid',
  `appid` int(11) DEFAULT NULL COMMENT '被下载的appid',
  `unique_id` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `os_version` varchar(255) DEFAULT NULL,
  `phone_model` varchar(255) DEFAULT NULL,
  `carrier` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of install_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `loglist`
-- ----------------------------
DROP TABLE IF EXISTS `loglist`;
CREATE TABLE `loglist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) DEFAULT NULL,
  `log` text,
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loglist
-- ----------------------------

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `message` text COMMENT '消息内容',
  `to_userid` int(11) DEFAULT NULL COMMENT '接收用户',
  `status` varchar(255) DEFAULT NULL COMMENT '消息阅读状态',
  `type` varchar(255) DEFAULT NULL COMMENT '消息类别,系统通知或告警,或针对个人',
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `message_status`
-- ----------------------------
DROP TABLE IF EXISTS `message_status`;
CREATE TABLE `message_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL COMMENT '消息ID',
  `status` varchar(255) DEFAULT '' COMMENT '阅读状态',
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message_status
-- ----------------------------

-- ----------------------------
-- Table structure for `report`
-- ----------------------------
DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` int(11) DEFAULT NULL,
  `impresstion` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `installs` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `bid` varchar(255) DEFAULT '' COMMENT '平均竞价',
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of report
-- ----------------------------

-- ----------------------------
-- Table structure for `report_detail`
-- ----------------------------
DROP TABLE IF EXISTS `report_detail`;
CREATE TABLE `report_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` int(11) DEFAULT NULL,
  `impresstion` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `installs` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of report_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `userlist`
-- ----------------------------
DROP TABLE IF EXISTS `userlist`;
CREATE TABLE `userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `name` varchar(255) DEFAULT '' COMMENT '姓名',
  `business name` varchar(255) DEFAULT '' COMMENT '公司名称',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `passwd` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '' COMMENT '地址',
  `postal_code` varchar(255) DEFAULT '' COMMENT '邮编',
  `city` varchar(255) DEFAULT '' COMMENT '城市',
  `country` varchar(255) DEFAULT '' COMMENT '国家',
  `status` tinyint(4) DEFAULT '1' COMMENT '用户状态,禁用或正常状态',
  `time` varchar(255) DEFAULT '' COMMENT '数据日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userlist
-- ----------------------------
