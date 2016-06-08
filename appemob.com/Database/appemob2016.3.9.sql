-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-09 04:35:58
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appemob`
--
CREATE DATABASE IF NOT EXISTS `appemob` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `appemob`;

-- --------------------------------------------------------

--
-- 表的结构 `adminlist`
--
-- 创建时间： 2016-03-02 07:45:42
--

CREATE TABLE IF NOT EXISTS `adminlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `adminlist`
--

INSERT INTO `adminlist` (`id`, `name`, `email`, `level`, `passwd`, `note`, `time`) VALUES
(1, 'admin', 'adminhw@hw.net', '1', 'hwappemob', NULL, '2016-03-02 11:43:14'),
(2, 'hubery', 'hubery@163.com', '0', 'hubery', NULL, '2016-03-05 00:00:00'),
(3, 'huli1', 'huli1@163.com', '1', 'huli1', NULL, '2016-03-05 00:00:00'),
(4, 'huli2', 'huli2@163.com', '2', 'huli2', NULL, '2016-03-05 00:00:00'),
(5, 'huli3', 'huli3@163.com', '3', 'huli3', NULL, '2016-03-05 12:05:00');

-- --------------------------------------------------------

--
-- 表的结构 `admin_loglist`
--
-- 创建时间： 2016-02-23 09:28:41
--

CREATE TABLE IF NOT EXISTS `admin_loglist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) DEFAULT NULL,
  `log` text,
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `applist`
--
-- 创建时间： 2016-02-29 03:05:22
--

CREATE TABLE IF NOT EXISTS `applist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `appid` varchar(255) DEFAULT NULL COMMENT 'APP ID',
  `name` varchar(255) DEFAULT NULL COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `title` varchar(255) DEFAULT '' COMMENT '应用标题',
  `subtitle` tinytext COMMENT '应用介绍',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `country` varchar(255) NOT NULL COMMENT '国家',
  `install` int(20) DEFAULT NULL COMMENT '应用安装量',
  `size` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `bid` varchar(255) DEFAULT '' COMMENT '竞价大小',
  `status` int(10) DEFAULT NULL COMMENT 'App状态',
  `time` datetime DEFAULT NULL COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `applist`
--

INSERT INTO `applist` (`id`, `appid`, `name`, `img`, `title`, `subtitle`, `sort`, `country`, `install`, `size`, `os`, `os_version`, `bid`, `status`, `time`) VALUES
(1, 'com.JuicyBubbles', 'Juicy Bubbles', '', 'Hippo', '适合所有人', '益智', '', 1000, '36M', 'android', 'Android系统版本要求\r\n4.0及更高版本', '', 1, '2016-03-01 16:00:05'),
(2, 'com.SpeedDating', 'Speed Dating', '', 'Hippo', ' 适合所有人', '益智', '', 1000, '30M', 'android', 'Android系统版本要求\r\n4.0及更高版本', '', 1, '2016-03-01 16:00:10'),
(3, 'com.thehotgames.dating_birds', 'Dating Birds', '', 'Hippo', '适合所有人', '益智', 'Afghanistan', 1000, '2.1M', 'android', 'Android系统版本要求\r\n4.0及更高版本', '1', 1, '2016-03-01 16:00:17');

-- --------------------------------------------------------

--
-- 表的结构 `applisttemp`
--
-- 创建时间： 2016-03-01 03:37:34
--

CREATE TABLE IF NOT EXISTS `applisttemp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `token` varchar(255) NOT NULL COMMENT '开发邮箱验证token',
  `token_exptime` int(11) NOT NULL COMMENT '开发邮箱验证token过期',
  `appid` varchar(255) DEFAULT NULL COMMENT 'APP ID',
  `name` varchar(255) DEFAULT NULL COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `title` varchar(255) DEFAULT '' COMMENT '应用标题',
  `subtitle` tinytext COMMENT '应用介绍',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `country` varchar(255) NOT NULL COMMENT '国家',
  `install` int(20) DEFAULT NULL COMMENT '应用安装量',
  `size` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `app_email` varchar(255) DEFAULT NULL COMMENT '开发者邮箱',
  `status` int(10) DEFAULT NULL COMMENT 'App状态',
  `time` varchar(255) DEFAULT '' COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `applisttemp`
--

INSERT INTO `applisttemp` (`id`, `token`, `token_exptime`, `appid`, `name`, `img`, `title`, `subtitle`, `sort`, `country`, `install`, `size`, `os`, `os_version`, `app_email`, `status`, `time`) VALUES
(1, '5dbdd319c9adbc5785ef4e290eeb86b8', 1456905002, 'com.thehotgames.dating_birds', 'Dating Birds', '', 'Hippo', '适合所有人', '益智', 'Andorra', 1000, '2.1M', 'android', 'Android系统版本要求\r\n4.0及更高版本', 'huberyleee@gmail.com', 1, ''),
(2, '3c45fc4790c72f8d8358556dca68f989', 1456904999, 'com.SpeedDating', 'Speed Dating', '', 'Hippo', ' 适合所有人', '益智', '', 1000, '30M', 'android', 'Android系统版本要求\r\n4.0及更高版本', 'huberyleee@gmail.com', 1, ''),
(3, 'cb9568cf6c3ca261523a765d8ba75a5f', 1457519584, 'com.JuicyBubbles', 'Juicy Bubbles', '', 'Hippo', '适合所有人', '益智', '', 1000, '36M', 'android', 'Android系统版本要求\r\n4.0及更高版本', 'huberyleee@gmail.com', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `devlist`
--
-- 创建时间： 2016-02-23 09:28:42
--

CREATE TABLE IF NOT EXISTS `devlist` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `install_detail`
--
-- 创建时间： 2016-02-23 09:28:42
--

CREATE TABLE IF NOT EXISTS `install_detail` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `loglist`
--
-- 创建时间： 2016-02-23 09:28:42
--

CREATE TABLE IF NOT EXISTS `loglist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) DEFAULT NULL,
  `log` text,
  `time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--
-- 创建时间： 2016-03-08 04:21:21
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(255) NOT NULL COMMENT '消息标题',
  `message` text COMMENT '消息内容',
  `to_userid` int(11) DEFAULT NULL COMMENT '接收用户',
  `isactive` int(11) DEFAULT NULL COMMENT '消息阅读状态',
  `type` int(11) DEFAULT NULL COMMENT '消息类别,系统通知或告警,或针对个人',
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `title`, `message`, `to_userid`, `isactive`, `type`, `addtime`) VALUES
(1, 'This is the first sysmessage!', 'Today is a good day!May I invite you to have a walk!', NULL, 1, 1, '2016-03-09 00:00:00'),
(2, 'This is a user''s message!', '<p>wo men dou shi ge hao hai zi !<br/></p>', NULL, 1, 0, '2016-03-09 09:03:58'),
(3, '这是一封系统消息！', '<p>这是一封系统消息！请注意查收！！！<br/></p>', NULL, 1, 1, '2016-03-09 11:03:54');

-- --------------------------------------------------------

--
-- 表的结构 `message_status`
--
-- 创建时间： 2016-03-07 06:12:28
--

CREATE TABLE IF NOT EXISTS `message_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL COMMENT '消息ID',
  `user_id` int(11) NOT NULL COMMENT '接收用户id',
  `isread` varchar(255) DEFAULT NULL COMMENT '阅读状态',
  `readtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `message_status`
--

INSERT INTO `message_status` (`id`, `message_id`, `user_id`, `isread`, `readtime`) VALUES
(1, 2, 1, '1', '2016-03-09 11:34:00'),
(2, 1, 0, '1', '2016-03-09 11:33:54'),
(3, 3, 0, '1', '2016-03-09 11:33:52');

-- --------------------------------------------------------

--
-- 表的结构 `report`
--
-- 创建时间： 2016-02-23 09:28:42
--

CREATE TABLE IF NOT EXISTS `report` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `report_detail`
--
-- 创建时间： 2016-02-23 09:28:42
--

CREATE TABLE IF NOT EXISTS `report_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` int(11) DEFAULT NULL,
  `impresstion` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `installs` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `userlist`
--
-- 创建时间： 2016-02-24 07:41:36
--

CREATE TABLE IF NOT EXISTS `userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `token` varchar(255) NOT NULL COMMENT '激活码',
  `token_exptime` int(11) NOT NULL COMMENT '激活码过期',
  `name` varchar(255) DEFAULT '' COMMENT '姓名',
  `business_name` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `passwd` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '' COMMENT '地址',
  `post_code` varchar(255) DEFAULT NULL COMMENT '邮编',
  `city` varchar(255) DEFAULT '' COMMENT '城市',
  `country` varchar(255) DEFAULT '' COMMENT '国家',
  `status` tinyint(4) DEFAULT '1' COMMENT '用户状态,禁用或正常状态',
  `time` datetime DEFAULT NULL COMMENT '数据日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `userlist`
--

INSERT INTO `userlist` (`id`, `token`, `token_exptime`, `name`, `business_name`, `email`, `passwd`, `address`, `post_code`, `city`, `country`, `status`, `time`) VALUES
(1, 'd115e11a90a12deadcad2c0312698ce1', 1456395196, 'hubery', 'hellowd', 'huli_yangthze@126.com', '2016', 'wuhan', '43700', 'wuhan', 'Albania', 1, '2016-02-25 15:17:17'),
(2, '1d4ef9a8f360b1c22946a5ade5d7f167', 1456469665, 'hubery', 'hellowd', 'hubery_lee@yeah.net', '2016', 'wuhan', '43700', 'wuhan', 'China', 1, '2016-02-25 14:54:25'),
(6, '7e31dac6fc4f701f941d49c6d3b895ac', 1456828097, 'hubery', 'hellowd', 'hubery_lee@qq.com', '2016', 'wuhan', '43700', 'wuhan', 'china', 0, '2016-02-29 18:28:17'),
(7, '61cb94dd1b08fccbcc4a343f238b3f96', 1456828157, 'hubery', 'hellowd', 'huli_yangthze@163.com', '2016', 'wuhan', '43700', 'wuhan', 'china', 1, '2016-02-29 18:29:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
