-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-09 12:23:29
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

-- --------------------------------------------------------

--
-- 表的结构 `active_status`
--

CREATE TABLE IF NOT EXISTS `active_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `adminlist`
--

CREATE TABLE IF NOT EXISTS `adminlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `adminlist`
--

INSERT INTO `adminlist` (`id`, `name`, `email`, `level`, `passwd`, `note`, `time`) VALUES
(1, 'admin', 'adminhw@hw.net', 1, 'hwappemob', NULL, '2016-03-02 11:43:14'),
(2, 'hubery', 'hubery@163.com', 0, 'hubery', NULL, '2016-03-05 00:00:00'),
(3, 'huli1', 'huli1@163.com', 1, 'huli1', NULL, '2016-03-05 00:00:00'),
(4, 'huli2', 'huli2@163.com', 2, 'huli2', NULL, '2016-03-05 00:00:00'),
(5, 'huli3', 'huli3@163.com', 3, 'huli3', NULL, '2016-03-05 12:05:00');

-- --------------------------------------------------------

--
-- 表的结构 `admin_loglist`
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

CREATE TABLE IF NOT EXISTS `applist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `devid` varchar(255) NOT NULL COMMENT '开发者ID',
  `appid` varchar(255) DEFAULT '' COMMENT 'APP ID',
  `name` varchar(255) DEFAULT '' COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `description` text COMMENT '应用介绍',
  `promoter_title` text COMMENT '应用标题',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `country` varchar(255) NOT NULL COMMENT '国家',
  `install` varchar(255) DEFAULT '' COMMENT '应用安装量',
  `size` varchar(255) DEFAULT '',
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `budget` int(10) DEFAULT '100',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `status` int(10) DEFAULT NULL COMMENT 'App状态',
  `active_status` int(11) DEFAULT '0',
  `ad_control` text,
  `rate` varchar(255) DEFAULT '' COMMENT '评分',
  `date` date DEFAULT NULL COMMENT '数据添加日期',
  `time` varchar(255) DEFAULT '' COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `applist`
--

INSERT INTO `applist` (`id`, `devid`, `appid`, `name`, `img`, `description`, `promoter_title`, `sort`, `country`, `install`, `size`, `os`, `budget`, `os_version`, `status`, `active_status`, `ad_control`, `rate`, `date`, `time`) VALUES
(1, 'thehotgames', 'com.JuicyBubbles', 'Juicy Bubbles', 'fU7nzLhLQ_Q4zxUNIcfuU3D0pkIm3z4sTlZYpcNOLWDUGLgPewezM7cP_yqj5UOnLwU=', '适合所有人', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Puzzle', 'China', '1000', '36M', 'android', 2228, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.2', '2016-03-01', NULL),
(2, 'thehotgames', 'com.SpeedDating', 'Speed Dating', '-89roKLSrjVJRiUcRHs03E_QT4xo90AucqzieMnMn4sSTQ2ywDjlR7yYdhT6xx0teg=', '适合所有人', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', '益智', 'China', '1000', '30M', 'android', 11582, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.4', '2016-03-01', NULL),
(3, 'thehotgames', 'com.thehotgames.dating_birds', 'Dating Birds', 'QYpnpxLl34MNSyKc_PE23MN1QBotkbKuED4RzMWLZ6_CFJwf4u6DmIy42Tw0Mtgaqw=', 'Dating birds is a lovely and challenging puzzle game.The goal is moving obstacle blocks between birds and make them succeed in dating.In every level,moving times is limited.You need to get birds near in setting moves.As level up,it is harder to complete t', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Puzzle', 'China', '500 - 1,000', '2.1M', 'android', 9227, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.4', '2016-03-01', NULL),
(4, '6418760394979464117', 'com.adsk.sketchbookhdexpress', 'Express', 'e3s3GS6U2S878ukA6Pn67YgTGyX866n5pSjL_-J0374oSeknaHKT1T38JWyDSE_xaA=', 'Autodesk SketchBook Express for Tablets is a professional-grade paint and drawing application designed for android devices with screen sizes of 4" and above. SketchBook Express offers a dedicated set of sketching tools and delivers them through a streamli', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Creativity', 'United States', '10000000', '11M', 'android', 9392, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(5, '6418760394979464117', 'com.adsk.sketchbook', 'draw and paint', 'e0UoBQPpK9VD0uEQ6fHE8on0cceSF_1H8LwBdEUE1HZwKzvvNwMDA_1Kj5-L2ZLXWA=', 'Autodesk® SketchBook® is an intuitive painting and drawing application designed for people of all skill levels, who love to draw. We reimagined the paint engine, so SketchBook delivers more fluid pencils and natural painting than ever before, all while ', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Entertainment', 'US', '10000000', '47M', 'android', 7277, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(6, '6418760394979464117', 'com.adsk.sketchbookink_gen', 'Ink', 'RaycgRkPs3nWQykRM4Q_rkkkgZEHu3wOLzyDqMYD2--rPOaQBwx_5Vfzu4rNirSqNjo=', 'Draw perfect, resolution-independent lines with SketchBook® Ink. This easy-to-use pen & ink drawing app enables you create amazing line art and export high-resolution images directly from your tablet (7” or larger).', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Entertainment', 'US', '50000', '9.6M', 'android', 6209, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(7, '6054197513203380012', 'com.ketchapp.twist', 'Twist', 'AJ4cgeoiWAmG4KsCwabAb6BTMRzOhIWTKzKvFBt7sqiXBq_vo3coLBeVu3gG4odgNsQQ=', 'Stay on the platforms and do as many jumps as you can.\nJust tap the screen to jump and twist the platforms. Try not to fall off the edges!\n\nCollect gems to unlock new balls and platform colors.\n\nWhat is your best score ?', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Arcade', ' France', '10,000,000 - 50,000,000', '27M', 'android', 7215, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.4', '2016-03-14', NULL),
(8, '6054197513203380012', 'com.ketchapp.splash', 'Splash', 'TIQ3gMP4ef4lajqtbLBFh5XeGt5_tHHBPFopiEMriJ_bB0lsaq71jRRmiD7qtQE1g2s0=', 'Splash is the new game from the creator of ZigZag and Twist.\r\nJump on the colored cubes to blow them up, and make as many beautiful Splashes of ink on the ground as you can!\r\n\r\nJust tap the screen to make the ball move down and hit the cubes.\r\n\r\nCollect g', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Arcade', 'France', '500,000 - 1,000,000', '25M', 'android', 5450, '3.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.4', '2016-03-14', NULL),
(9, '6054197513203380012', 'com.ketchapp.stack', 'Stack', 'FucKIg8ssdAVW6Ejm1VI4ToY_c9_VuaCm2bB_mUHx6WXqit9PcTHEzwOkrBwkAkx6DI=', 'Stack up the blocks as high as you can!', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Arcade', 'France', '5,000,000 - 10,000,000', '25M', 'android', 3605, '3.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(10, '6054197513203380012', 'com.ketchapp.swing', '浪荡天涯', 'YxNr2h_XN0HhtUsvNkskqmiswlILyypWpxT6avL6xNcOPesjx8xRqnfWrx5uHdqby6M=', 'Swing from platform to platform. Simply tap the screen when the rope is long enough to reach the next platform. How long can you survive?\r\nCollect gems and unlock cool new characters.', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Arcade', 'France', '1,000,000 - 5,000,000', '27M', 'android', 9674, '3.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(11, '6054197513203380012', 'com.ketchapp.hophophop', '下蹿上跳', 'oL3fBj7RQZrxveXg_B1roG8vuIXbYijud4XAgqwxH6ilLDAby7TYyYfguCArehqpcd1-=', 'Jump into the hoops and avoid the spikes. Collect mushrooms to unlock all the funny characters!\r\nHow far can you go?\r\n\r\n→ Eat a mushroom to get 1 point\r\n→ Jump into the hoop from above to get 2 points\r\n→ You have enough skills to do it from below? G', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Arcade', 'France', '1,000,000 - 5,000,000', '18M', 'android', 5558, '3.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(12, '6054197513203380012', 'com.ketchapp.sky', '天阶', 'RoNCG1bOkA9SRYzOy4mX9lHTOsu6g-o5Ww-BN3DyJvrLD8dmU1046H3evKNe62i7WwZy=', 'Fly, Jump and Clone yourself into a fantastic adventure with SKY.\r\nIn this new game developed by the same team behind Phases and The Line Zen, you''re in control of multiple characters as they run through a 3D mystical world filled with trouble.', 'Sky', 'Arcade', 'France', '1,000,000 - 5,000,000', '10M', 'android', 6768, '2.3.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.2', '2016-03-14', NULL),
(13, '6054197513203380012', 'com.ketchapp.zigzaggame', 'ZigZag', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'Stay on the wall and do as many zigzags as you can!\r\nJust tap the screen to change the direction of the ball. Try not to fall off the edges!\r\n\r\nHow far can you go?', 'ZigZag', 'Arcade', 'France', '10,000,000 - 50,000,000', '21M', 'android', 5167, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(14, '6054197513203380012', 'com.ketchapp.arrow', 'Arrow', 's9N4L7954oGFvLYnK3OpwvrQpoCnY6UkAPr5iQAHleppiukgKsIZxj8o7X5MGMPimdo=', 'Move through the maze without hitting the walls. Collect points to grow your tail. Smash gems to unlock cool new arrow heads and backgrounds!', 'Arrow', 'Arcade', 'France', '1,000,000 - 5,000,000', '19M', 'android', 3529, '4.1 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.4', '2016-03-14', NULL),
(15, '6054197513203380012', 'com.ketchapp.stickhero', '英雄难过棍子关', 'Ph8XvfIqCZNMBH7ltkulP-iqL4OcmSKArZTj99EVhPSXvaIfEotwVQ8Rt-OfNBou3_8B=', 'Stretch the stick in order to reach and walk on the platforms. Watch out! If the stick is not long enough, you will fall down!\r\nHow far can you go?', 'Stick Hero', 'Arcade', ' France', '10,000,000 - 50,000,000', '14M', 'android', 10145, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.2', '2016-03-14', NULL),
(16, '6054197513203380012', 'com.ketchapp.theline2', 'The Line Zen', 'zgKiOEMVeMDftbYf02IrHyK-W5g_hj0o13zbkx7qrLxf2Vz-GxAd_jyFTWv4yXPphAY=', 'Welcome to The Line Zen.\r\nThe Line Zen is the sequel to 2014''s hit game, The Line, but now with a new twist. You still dart and weave through a procedurally generated world while avoiding the red shapes, but now you use friendly green shapes to your advan', 'The Line Zen', 'Arcade', 'France', '1,000,000 - 5,000,000', '7.5M', 'android', 8138, '2.3.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(17, '6054197513203380012', 'com.ketchapp.jellyjump', 'Jelly Jump', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'Little jellies need you more than ever before! They keep drowning over and over again. Only you can keep them safe...\r\nJump higher, survive longer and never give up!', 'Jelly Jump', 'Arcade', 'France', '10,000,000 - 50,000,000', '30M', 'android', 8256, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(18, '6054197513203380012', 'com.ketchapp.cloudpath', 'Cloud Path', '7kyP1cStCqnt3qWTGu3r53-kmX2pv0txwshwZwWLmBvc1sJfBMZMxzSH1Dyczq1fRlE=', 'Walk on the path as fast as you can, and earn one point for each step you do. Collect gems and unlock new characters!', 'Cloud Path', 'Arcade', 'France', '500,000 - 1,000,000', '23M', 'android', 4867, '2.2 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.4', '2016-03-14', NULL),
(19, '6054197513203380012', 'com.ketchapp.donttouchthespikes', 'Don''t Touch The Spikes', '7UbT-QkDAlZpwatlRSffPuEKfNKRgoQL490uo5NjFs85o_OIvmR6KaIChFGgfhFcuw=', 'Make the little bird fly! Don''t touch the spikes!\r\nHow far can you make it?', 'Don''t Touch The Spikes', 'Arcade', 'France', '10,000,000 - 50,000,000', '15M', 'android', 7568, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(20, '6054197513203380012', 'com.ketchapp.qubes', '圆方快跑', 'yRkn1v4KnFyLBBLbLDZM5euD36rDKuz6b9KU7bfCj-yGmoTVzE9T3aY4KcjzoLs-LXeC=', 'Tap to change the direction of the bouncing ball. Collect coins and unlock new balls.\r\nHow long can you survive on the qubes?\r\n\r\nHow to play:\r\nTap anywhere on the screen to change the direction of the ball.', 'Qubes', 'Arcade', 'France', '100,000 - 500,000', '26M', 'android', 11239, '3.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.4', '2016-03-14', NULL),
(21, 'thehotgames', 'com.thehotgames.frozen_blocks', 'Frozen Blocks: Magic', 'WYY8Z7iWaqkH2gfDUFc4X6z6mPkJ7gHtu26ovvi9y-sHy5VEZb8ISMZ4q-EXTKjQ9g=', 'Frozen Blocks: Magic is a unique and creative physics based game. Stack all provided frozen blocks to keep them in a good balance. Be careful not to let them fall off the screen,or you''ll have to start again. You can unlock new challenging theme levels wh', 'Frozen Blocks: Magic', 'Puzzle', 'China', '500 - 1,000', '2.6M', 'android', 11490, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.2', '2016-03-14', NULL),
(22, 'thehotgames', 'com.thehotgames.halloween_ghost', 'Halloween Ghost', 'SbqtHoGywvavO80C0wkjFZMM34fqysWiFD5UuoYfe9ElYHirw4UJhH2iWkyJCFGmoGc=', 'Experience the fun of Halloween,a mysterious shaman in the procurement Halloween gift when it came to a group of ghost. The story began ...', 'Halloween Ghost', 'Adventure', 'China', '1,000 - 5,000', '2.8M', 'android', 11734, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(23, 'thehotgames', 'com.thehotgame.app.turtle', 'The Rolling Turtle', 'nVJUC26JIsFNiRkc0FBdKZRdS66t7fjfLKExfh1EG_Gi6Z4sMn84aMVQiDPDyD-W7a8=', 'The Rolling Turtle like ants on a hot pan, only to reach the end you are the most secure. Game, players by turning the dial to scroll to get control of the turtle four stars. Turntable inside organs unpredictable, can you help the turtle successfully reac', 'The Rolling Turtle', 'Strategy', 'China', '50 - 100', '2.6M', 'android', 2201, '2.3.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.2', '2016-03-14', NULL),
(24, '5950758182267281572', 'com.outfit7.tomsbubbles', '汤姆猫泡泡射手', 'kmX2pv0txwshwZwWLmBvc1sJfBMZMxzSH1Dyczq1fRlE=', 'Play the exciting action-packed bubble shooter – your next favorite game from Talking Tom. Challenge your friends or play on your own as you level up and unlock Tom’s friends.\r\nDiscover new features for some seriously thrilling adventures. Crush bosse', 'Talking Tom Bubble Shooter', 'Casual', 'United States', '10,000,000 - 50,000,000', NULL, 'android', 3803, '4.1 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(25, '5950758182267281572', 'com.outfit7.mytalkingangelafree', '我的安吉拉', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'Explore Talking Angela’s world and customise her fashion, hairstyle, makeup and home - all while playing addictively cute mini games.\r\nWith over 165 million downloads already… don’t miss out on the fun!', 'My Talking Angela', 'Casual', 'United States', '100,000,000 - 500,000,000', '77M', 'android', 10411, '4.1 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.4', '2016-03-14', NULL),
(26, '5950758182267281572', 'com.outfit7.tomsjetski', 'Talking Tom Jetski', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'Jump on the water scooter with TALKING TOM or TALKING ANGELA and experience the most exhilarating water action out there - dashing through cool missions and daring challenges on the ride of your life.', 'Talking Tom Jetski', 'Casual', 'United States', '10,000,000 - 50,000,000', NULL, 'android', 8649, '4.0.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(27, '5950758182267281572', 'com.outfit7.mytalkingtomfree', 'My Talking Tom', 'BN3DyJvrLD8dmU1046H3evKNe62i7WwZy=', 'Discover the #1 games app in 135 countries! Adopt your very own baby kitten and help him grow into a fully grown cat. Take good care of your virtual pet, name him and make him part of your daily life by feeding him, playing with him and nurturing him as h', 'My Talking Tom', 'Casual', 'United States', '100,000,000 - 500,000,000', '61M', 'android', 10012, '4.1 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(28, '5950758182267281572', 'com.outfit7.talkingangelafree', 'Talking Angela', 'QYpnpxLl34MNSyKc_PE23MN1QBotkbKuED4RzMWLZ6_CFJwf4u6DmIy42Tw0Mtgaqw=', 'Come join Talking Angela in Paris - the city of love, style and magic. There are so many surprises, you better sit down. ;) Enjoy amazing gifts, pick the latest styles, and sip magical cocktails to experience special moments. And watch out for birds - you', 'Talking Angela', 'Entertainment', 'United States', '50,000,000 - 100,000,000', '45M', 'android', 2112, '4.1 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.2', '2016-03-14', NULL),
(29, '5950758182267281572', 'com.outfit7.tomlovesangelafree', 'Tom Loves Angela', '89roKLSrjVJRiUcRHs03E_QT4xo90AucqzieMnMn4sSTQ2ywDjlR7yYdhT6xx0teg=', 'Talking Tom has climbed all the way up to the rooftop to get a glimpse of Angela. Tom will repeat what you say to Angela so help him woo her by singing a song, having a chat using the innovative “intelligent” chat function and by giving her gifts!\r\nBu', 'Tom Loves Angela', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', 8524, '4.0.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.3', '2016-03-14', NULL),
(30, '5950758182267281572', 'com.outfit7.tomslovelettersfree', 'Tom''s Love Letters', 'AJ4cgeoiWAmG4KsCwabAb6BTMRzOhIWTKzKvFBt7sqiXBq_vo3coLBeVu3gG4odgNsQQ=', 'Download the cutest love app ever and show that special person how you feel about them.\r\nTalking Tom and Talking Angela are at hand to help you express your feelings. Just like Cupid, your furry friends will help you share your feelings, whether it’s wi', 'Tom''s Love Letters', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', 4285, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.4', '2016-03-14', NULL),
(31, '5950758182267281572', 'com.outfit7.talkinggingerfree', 'Talking Ginger', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'Little Talking Ginger needs your help! Help him get ready for bed and have fun along the way!\r\nGinger provides the best company - talk to him, tickle him and play games with him. You can even see what he’s dreaming about at night!', 'Talking Ginger', 'Entertainment', 'United States', '100,000,000 - 500,000,000', NULL, 'android', 3852, '4.0.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(32, '5950758182267281572', 'com.outfit7.talkingben', 'Talking Ben the Dog', 'oL3fBj7RQZrxveXg_B1roG8vuIXbYijud4XAgqwxH6ilLDAby7TYyYfguCArehqpcd1-=', 'Ben is a retired chemistry professor who likes his quiet comfortable life of eating, drinking and reading newspapers. To make him responsive, you will have to bother him long enough that he will fold his newspaper. Then you can talk to him, poke or tickle', 'Talking Ben the Dog', 'Entertainment', 'United States', '50,000,000 - 100,000,000', '50M', 'android', 4405, '4.0.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(33, '5950758182267281572', 'com.outfit7.talkingnewsfree', 'Talking Tom & Ben News', 'QYpnpxLl34MNSyKc_PE23MN1QBotkbKuED4RzMWLZ6_CFJwf4u6DmIy42Tw0Mtgaqw=', 'Breaking news - Talking Tom and Talking Ben are even chattier and more entertaining as TV news anchors!\r\nJoin them in their TV studio, talk to them and watch them take it in turns to repeat what you say. Poke or swipe the screen and have them fall off the', 'Talking Tom & Ben News', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', 8472, '4.0.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.4', '2016-03-14', NULL),
(34, 'Fingersoft', 'com.fingersoft.hillclimb', 'Hill Climb Racing', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'One of the most addictive and entertaining physics based driving game ever made! And it''s free!\r\nMeet Newton Bill, the young aspiring uphill racer. He is about to embark on a journey that takes him to where no ride has ever been before. With little respec', '[{"active":"1","code":"en","title":"ABC","subtitle":"ABC"},{"active":"0","code":"zh-CN","title":"中文","subtitle":"中文"}]', 'Racing', 'Finland', '100,000,000 - 500,000,000', NULL, 'android', 7146, '', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(35, 'Fingersoft', 'com.waybefore.fastlikeafox', 'Fast like a Fox', 'AJ4cgeoiWAmG4KsCwabAb6BTMRzOhIWTKzKvFBt7sqiXBq_vo3coLBeVu3gG4odgNsQQ=', 'One of the most fun and fastest platformers ever created with unique tap control! Play now for free!\nFast like a Fox uses your device’s internal sensors to detect movement. Learn the tapping technique to have the best precision.', 'Fast like a Fox', 'Adventure', 'Finland', '1,000,000 - 5,000,000', '54M', 'android', 8312, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(36, 'Fingersoft', 'com.fingersoft.nightvisioncamera', 'Night Vision Camera', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'This application maximizes your device camera in the dark! Automatic adjustment of image parts to improve visibility in low light conditions.\r\nWe have just released Hill Climb Racing, it''s one of the most entertaining and addictive FREE driving game made ', 'Night Vision Camera', 'Photography', 'Finland', '10,000,000 - 50,000,000', '379k', 'android', 8125, '2.2 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(37, 'Fingersoft', 'com.fingersoft.benjibananas', 'Benji Bananas', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'The best action adventure game on your Android! And it''s free!\r\n\r\nExciting and fun physics based adventure game!\r\n\r\nFly from vine to vine, but watch out for dangers lurking in the jungle. Earn bananas to get upgrades, specials and power ups.\r\n\r\nFeatures:\r', 'Benji Bananas', 'Adventure', 'Finland', '50,000,000 - 100,000,000', '25M', 'android', 3689, '3.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(38, 'Fingersoft', 'com.fingersoft.cartooncamera', 'Cartoon Camera', 'oL3fBj7RQZrxveXg_B1roG8vuIXbYijud4XAgqwxH6ilLDAby7TYyYfguCArehqpcd1-=', 'One of the coolest free Android camera apps ever created!\r\nCreate cartoon and sketch like photography with your camera.\r\n\r\nWe have just released Hill Climb Racing, it''s one of the most entertaining and addictive FREE driving game made for android!', 'Cartoon Camera', 'Photography', 'Finland', '10,000,000 - 50,000,000', '1.0M', 'android', 2072, '2.2 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.3', '2016-03-14', NULL),
(39, 'Fingersoft', 'com.fingersoft.thermalvisioncamera', 'Thermal Camera', 'AJ4cgeoiWAmG4KsCwabAb6BTMRzOhIWTKzKvFBt7sqiXBq_vo3coLBeVu3gG4odgNsQQ=', 'The best Thermal Camera application for Android is finally here!\r\nLike us on Facebook and stay tuned for all new cool releases and updates:', 'Thermal Camera', 'Photography', 'Finland', '5,000,000 - 10,000,000', '521k', 'android', 7290, '2.2 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.3', '2016-03-14', NULL),
(40, 'Fingersoft', 'com.fingersoft.failhard', 'Fail Hard', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'We bring you extremely fun physics based stunt game on Android!\r\n* Experience the evolution of becoming the greatest stuntman in the world.\r\n* Make it big in the stunt show business and don''t back down even from \r\nthe most dangerous of stunts and jumps.\r\n', 'Fail Hard', 'Action', 'Finland', '10,000,000 - 50,000,000', '58M', 'android', 8236, '4.0.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(41, 'Fingersoft', 'com.fingersoft.ihatefish', 'I Hate Fish', 'QYpnpxLl34MNSyKc_PE23MN1QBotkbKuED4RzMWLZ6_CFJwf4u6DmIy42Tw0Mtgaqw=', 'Shoot your way to the top of the food chain and guide Earl the worm through perilous waters filled with enemies to the safety of your homeboat.\r\n- MANEUVER and SHOOT your way through the schools of angry fish.\r\n- UPGRADE your weapons to match the growing ', 'I Hate Fish', 'Action', 'Finland', '1,000,000 - 5,000,000', '47M', 'android', 7312, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.3', '2016-03-14', NULL),
(42, 'Fingersoft', 'com.fingersoft.motioncamera', 'Motion Camera', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'Create cool and unique photos with motion in them. Motion Camera blurs movement of objects into to your photos. Cars, people, you name it.\r\nCheck out our latest free game: Hill Climb Racing. It''s a fun and addictive driving game where you reach further di', 'Motion Camera', 'Photography', 'Finland', '1,000,000 - 5,000,000', '252k', 'android', 9852, '2.2 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.2', '2016-03-14', NULL),
(43, 'Fingersoft', 'com.sixminute.freeracing', 'FRZ: Free Racing Zero', 'oL3fBj7RQZrxveXg_B1roG8vuIXbYijud4XAgqwxH6ilLDAby7TYyYfguCArehqpcd1-=', 'FRZ: Free Racing Zero! Steer your way to victory against the competition in this comic style retro racer!\r\nFRZ: Free Racing Zero brings high-paced retro racing back to the world. It''s time to burn rubber, drift and steer your way to the finish line in thi', 'FRZ: Free Racing Zero', 'Racing', 'Finland', '100,000 - 500,000', NULL, 'android', 5325, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.4', '2016-03-14', NULL),
(44, '7891990035506213180', 'com.sega.sonicdash', 'Sonic Dash', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'For mobile and tablet.\r\nHow far can the world’s fastest hedgehog run?\r\n\r\nPlay as Sonic the Hedgehog as you dash, jump and spin your way across stunning 3D environments. Swipe your way over and under challenging obstacles in this fast and frenzied endles', 'Sonic Dash', 'Arcade', 'United States', '50,000,000 - 100,000,000', '64M', 'android', 5067, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.4', '2016-03-14', NULL),
(45, '7891990035506213180', 'com.sega.cityrush', 'Crazy Taxi™ City Rush', 'QYpnpxLl34MNSyKc_PE23MN1QBotkbKuED4RzMWLZ6_CFJwf4u6DmIy42Tw0Mtgaqw=', 'Drive crazy in SEGA’s all-new car racing game Crazy Taxi. Race through the city in your car to deliver your passengers on-time -- the crazier you drive the higher your rewards! Your car, your rules - speed, drift, whip around corners, weave through traf', 'Crazy Taxi™ City Rush', 'Action', 'United States', '5,000,000 - 10,000,000', '79M', 'android', 7364, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.2', '2016-03-14', NULL),
(46, '7891990035506213180', 'com.sega.sonic.transformed', 'Sonic Racing Transformed', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'Sonic & All Star Racing Transformed is now FREE! If you previously bought the game you still have the VIP Pass for FREE.\r\nIt’s Not Just Racing… it’s Racing Transformed!\r\n\r\nRace as Sonic and a host of legendary All-Stars and prepare to transform! Spe', 'Sonic Racing Transformed', 'Racing', 'United States', '10,000,000 - 50,000,000', NULL, 'android', 9616, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '3.2', '2016-03-14', NULL),
(47, '7891990035506213180', 'com.sega.sonic4ep2lite', 'Sonic 4 Episode II LITE', 'AJ4cgeoiWAmG4KsCwabAb6BTMRzOhIWTKzKvFBt7sqiXBq_vo3coLBeVu3gG4odgNsQQ=', 'Take Sonic and Tails for a spin in this Lite version of Sonic The Hedgehog™ 4 Episode II!\r\nThe Sonic 4 Saga continues in Episode II with the return of a beloved side kick and fan-favorite villains!', 'Sonic 4 Episode II LITE', 'Arcade', 'United States', '10,000,000 - 50,000,000', '195M', 'android', 3991, '2.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.2', '2016-03-14', NULL),
(48, '7891990035506213180', 'com.sega.sonicjumpfever', 'Sonic Jump Fever', 'hoP-Cb5YxswXGQZIXPkpqXTM2q8_IRM8k8QnFLsdynM1N2e8uDVn8OdCDY-d2OObuN0=', 'Catch the FEVER in an explosive race against the clock! Compete with Sonic and friends in high-speed bursts of vertical jumping mayhem. FREE and based on SEGA’s hit Sonic Jump.\r\nProve you are the best. Rack up huge combos to blast past your friends’ h', 'Sonic Jump Fever', 'Action', 'United States', '10,000,000 - 50,000,000', '35M', 'android', 9106, '4.0 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.4', '2016-03-14', NULL),
(49, '7891990035506213180', 'com.sigames.fmh2016', 'Football Manager Mobile 2016', 'X1PI7PnhJnGXGV8gXGVJyFzM31wsnuzmvJESgS9Nj70dhQziYpCsM3M5rozAykLpglTP=', 'Football Manager Mobile 2016 is designed to be played on the move and is the quickest way to manage your favourite club to glory with a focus on tactics and transfers.\r\nTake charge of clubs from 14 countries across the world, including all the big Europea', 'Football Manager Mobile 2016', 'Sports', 'United States', '100,000 - 500,000', NULL, 'android', 11560, '2.3.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '2.4', '2016-03-14', NULL),
(50, '7891990035506213180', 'com.sega.twbshogun', 'Total War Battles', 'AJ4cgeoiWAmG4KsCwabAb6BTMRzOhIWTKzKvFBt7sqiXBq_vo3coLBeVu3gG4odgNsQQ=', 'BUILD, BATTLE AND AVENGE!\r\nSpecifically developed for touchscreen platforms, Total War Battles™: SHOGUN is a new real-time strategy game from the makers of the award-winning Total War series. \r\nTotal War Battles™ delivers quick-fire, tactical combat b', 'Total War Battles', 'Arcade', 'United States', '50,000 - 100,000', '273M', 'android', 8479, '2.3.3 and up', 1, NULL, '{"a":true,"b":true,"c":true}', '4.2', '2016-03-14', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `applisttemp`
--

CREATE TABLE IF NOT EXISTS `applisttemp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `devid` varchar(255) NOT NULL COMMENT '开发者ID',
  `appid` varchar(255) DEFAULT NULL COMMENT 'APP ID',
  `name` varchar(255) DEFAULT NULL COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `promoter_title` varchar(255) DEFAULT NULL COMMENT '应用标题',
  `description` tinytext COMMENT '应用介绍',
  `rate` varchar(50) NOT NULL COMMENT '应用评分',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `install` varchar(255) DEFAULT NULL COMMENT '应用安装量',
  `size` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `status` int(10) DEFAULT '0' COMMENT 'App状态',
  `date` date DEFAULT NULL COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `applisttemp`
--

INSERT INTO `applisttemp` (`id`, `devid`, `appid`, `name`, `img`, `promoter_title`, `description`, `rate`, `sort`, `install`, `size`, `os`, `os_version`, `status`, `date`) VALUES
(3, 'Netflix,+Inc.', 'com.netflix.orangeisthenewblack.app', 'Orange Is The New App', 'ALWJP3ADAlcf9yHn0_tmGFa2qYB_wK5XM4ADkDaubEPZbrpWbkfWsXLoEsScnH27GP0B=', '[{"active": "1","language": "en","title": "Orange Is The New App","subtitle": ""}]', 'Orange Is The New App, yo. This free app from Netflix lets you be Alex&#39;s little spoon, rock a sweet pornstache and show your love for your favorite Litchfield ladies. Just pick a card, customize it with your own message, add a photo, and share it with', '', NULL, '100,000 - 500,000', '19M', 'android', '4.0及更高版本', 0, '2016-04-01'),
(4, 'Disney+Publishing+Worldwide', 'disneydigitalbooks.palacepetswhiskerhaven_goo', 'Palace Pets in Whisker Haven', 'J3lh6sfMADCKwuaojOQuJ9nMayYzeFj5sone3gI_EQm3yGQVm39xJKv8FCKR5bmvLoA=', '[{"active": "1","language": "en","title": "Palace Pets in Whisker Haven","subtitle": ""}]', 'PRODUCT DESCRIPTIONThe Palace Pets are back with a brand new Pool Party Bubble Pop Game, the cutest magical rainbow accessories, and an entirely new accessory pack filled with sandcastles and sunshine!Go on ALL-NEW magical adventures with your favorite Pa', '3.9', '角色扮演', '1,000,000 - 5,000,000', '207M', 'android', '4.2及更高版本', 0, '2016-04-08'),
(5, 'King', 'com.king.candycrushsodasaga', '糖果苏打传奇', '6SwabeddgfJfU_MscHFTUXQnkVQp4Fuf3pGsy5iVeblxArv0--srqUj1nvQnZgstHWM=', '[{"active": "1","language": "en","title": "糖果苏打传奇","subtitle": ""}]', '立即免费下载《糖果苏打传奇》，Sodalicious！《糖果苏打传奇》由风靡全球的《糖果传奇》制作团队倾情推出。全新糖果、更多非凡组合和富有挑战的全新游戏模式，伴随紫色苏打和糖果熊将快', '4.3', '休闲', '100,000,000 - 500,000,000', '67M', 'android', '2.3及更高版本', 0, '2016-04-08'),
(12, 'Netflix,+Inc.', 'com.netflix.mediaclient', 'Netflix', 'gSs4M00WA2RgVosyh8vc3w3K5s2xZ2gjMpaY63izhCcaGIpCkDdGg-IAqdeJwShT4qk=', '[{"active": "1","language": "en","title": "Netflix","subtitle": ""}]', 'Netflix 提供业界领先的电影和电视节目订阅服务，方便您使用您喜爱的设备进行观看。   作为 Netflix 会员，您可以免费下载本应用程序，在您的 Android 电视设备上实时观赏数千部电影和电视节目', '4.4', NULL, '100,000,000 - 500,000,000', '因设备而异', 'android', '因设备而异', 0, '2016-04-09');

-- --------------------------------------------------------

--
-- 表的结构 `balance`
--

CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT '0' COMMENT '最终收支',
  `event` varchar(255) DEFAULT NULL COMMENT '收支事件',
  `amount` int(11) DEFAULT '0' COMMENT '事件金额',
  `type` tinyint(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `balance`
--

INSERT INTO `balance` (`id`, `userid`, `balance`, `event`, `amount`, `type`, `date`, `time`) VALUES
(1, 1, 1582, 'Charge and Income for 2016-04-05', -18, 1, '2016-04-06', '1459935244'),
(2, 2, 311, 'Charge and Income for 2016-04-05', 11, 1, '2016-04-06', '1459935244'),
(3, 3, 6000, 'Charge and Income for 2016-04-05', 0, 1, '2016-04-06', '1459935244'),
(4, 4, 156, 'Charge and Income for 2016-04-05', 6, 1, '2016-04-06', '1459935245'),
(5, 5, 2563, 'Charge and Income for 2016-04-05', 0, 1, '2016-04-06', '1459935245'),
(6, 6, 798, 'Charge and Income for 2016-04-05', 0, 1, '2016-04-06', '1459935245'),
(7, 1, 1573, 'Charge and Income for 2016-04-06', 0, 1, '2016-04-07', '1460016758'),
(8, 2, 315, 'Charge and Income for 2016-04-06', 0, 1, '2016-04-07', '1460016758'),
(9, 3, 6000, 'Charge and Income for 2016-04-06', 0, 1, '2016-04-07', '1460016758'),
(10, 4, 160, 'Charge and Income for 2016-04-06', 0, 1, '2016-04-07', '1460016759'),
(11, 5, 2563, 'Charge and Income for 2016-04-06', 0, 1, '2016-04-07', '1460016759'),
(12, 6, 798, 'Charge and Income for 2016-04-06', 0, 1, '2016-04-07', '1460016759');

-- --------------------------------------------------------

--
-- 表的结构 `bidlist`
--

CREATE TABLE IF NOT EXISTS `bidlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `applistid` int(11) NOT NULL COMMENT 'applist表外键',
  `countryid` int(11) NOT NULL COMMENT '国家id外键',
  `bid` int(11) NOT NULL DEFAULT '0' COMMENT '竞价大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=281 ;

--
-- 转存表中的数据 `bidlist`
--

INSERT INTO `bidlist` (`id`, `applistid`, `countryid`, `bid`) VALUES
(68, 7, 9, 20),
(69, 7, 10, 20),
(70, 7, 11, 20),
(71, 7, 12, 20),
(72, 7, 13, 20),
(73, 7, 14, 20),
(74, 7, 15, 20),
(75, 7, 16, 20),
(119, 8, 1, 21),
(120, 8, 10, 20),
(121, 8, 11, 20),
(122, 8, 12, 20),
(123, 8, 13, 20),
(124, 8, 14, 20),
(125, 8, 15, 20),
(126, 8, 16, 20),
(127, 8, 17, 20),
(128, 8, 91, 20),
(129, 8, 96, 20),
(130, 8, 107, 20),
(131, 8, 117, 20),
(132, 9, 7, 20),
(133, 9, 8, 20),
(134, 9, 15, 20),
(135, 9, 16, 20),
(136, 9, 75, 20),
(137, 9, 83, 20),
(138, 9, 97, 20),
(139, 9, 125, 20),
(140, 10, 10, 20),
(141, 10, 18, 20),
(142, 10, 26, 20),
(143, 10, 86, 20),
(144, 10, 91, 20),
(145, 10, 101, 20),
(146, 10, 105, 20),
(147, 10, 107, 20),
(148, 10, 12, 20),
(149, 10, 27, 20),
(150, 10, 2, 20),
(151, 11, 42, 20),
(152, 11, 66, 20),
(153, 11, 92, 20),
(154, 11, 95, 20),
(155, 11, 108, 20),
(156, 11, 109, 20),
(157, 11, 127, 20),
(158, 11, 127, 20),
(159, 12, 42, 20),
(160, 12, 92, 20),
(161, 12, 105, 20),
(162, 12, 107, 20),
(163, 12, 108, 20),
(164, 12, 127, 20),
(165, 12, 127, 20),
(166, 12, 127, 20),
(167, 13, 5, 20),
(168, 13, 13, 20),
(169, 13, 66, 20),
(170, 13, 95, 20),
(171, 13, 109, 20),
(172, 13, 127, 20),
(173, 14, 6, 20),
(174, 14, 14, 20),
(175, 14, 74, 20),
(176, 14, 96, 20),
(177, 14, 117, 20),
(178, 14, 127, 20),
(215, 15, 2, 20),
(216, 15, 7, 20),
(217, 15, 8, 20),
(218, 15, 15, 20),
(219, 15, 16, 20),
(220, 15, 75, 20),
(221, 15, 83, 20),
(222, 15, 97, 20),
(223, 15, 99, 20),
(224, 15, 125, 20),
(225, 10, 20, 20),
(226, 35, 1, 20),
(227, 35, 9, 20),
(228, 35, 17, 20),
(229, 35, 85, 20),
(230, 35, 101, 20),
(231, 35, 127, 20),
(237, 36, 1, 20),
(238, 36, 2, 20),
(239, 36, 3, 20),
(240, 36, 4, 20),
(241, 36, 5, 20),
(242, 36, 6, 20),
(244, 43, 1, 10),
(245, 43, 2, 10),
(246, 43, 3, 20),
(247, 43, 4, 20),
(248, 43, 5, 20),
(255, 28, 1, 0),
(256, 28, 9, 0),
(257, 28, 17, 0),
(258, 28, 37, 0),
(266, 1, 1, 20),
(267, 1, 9, 0),
(268, 1, 17, 0),
(269, 1, 37, 0),
(275, 3, 3, 0),
(276, 3, 4, 0),
(277, 3, 5, 0),
(278, 3, 10, 0),
(279, 3, 18, 0),
(280, 3, 42, 0);

-- --------------------------------------------------------

--
-- 表的结构 `contactlist`
--

CREATE TABLE IF NOT EXISTS `contactlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ustemp_id` int(11) NOT NULL COMMENT '临时用户表id',
  `company_name` varchar(50) NOT NULL COMMENT '联系人公司',
  `contact_message` text NOT NULL COMMENT '联系人内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `contactlist`
--

INSERT INTO `contactlist` (`id`, `ustemp_id`, `company_name`, `contact_message`) VALUES
(1, 1, 'hellowworld', 'wrwqrwerwe'),
(2, 1, 'wuhan', 'adfasdfsdfaf');

-- --------------------------------------------------------

--
-- 表的结构 `cpilist`
--

CREATE TABLE IF NOT EXISTS `cpilist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `country` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '国家或地区',
  `code` varchar(255) NOT NULL COMMENT '国家简称',
  `cpi` varchar(10) NOT NULL DEFAULT '0' COMMENT 'CPI调价',
  `phone_code` varchar(100) NOT NULL,
  `time_diff` int(11) NOT NULL COMMENT '时差',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- 转存表中的数据 `cpilist`
--

INSERT INTO `cpilist` (`id`, `country`, `name`, `code`, `cpi`, `phone_code`, `time_diff`) VALUES
(1, 'Angola', '安哥拉', 'AO', '2', '244', -7),
(2, 'Afghanistan', '阿富汗', 'AF', '2', '93', 0),
(3, 'Albania', '阿尔巴尼亚', 'AL', '2', '355', -7),
(4, 'Algeria', '阿尔及利亚', 'DZ', '2', '213', -8),
(5, 'Andorra', '安道尔共和国', 'AD', '2', '376', -8),
(6, 'Anguilla', '安圭拉岛', 'AI', '1', '1264', -12),
(7, 'Antigua and Barbuda', '安提瓜和巴布达', 'AG', '1', '1268', -12),
(8, 'Argentina', '阿根廷', 'AR', '1', '54', -11),
(9, 'Armenia', '亚美尼亚', 'AM', '3', '374', -6),
(10, 'Ascension', '阿森松', ' ', '3', '247', -8),
(11, 'Australia', '澳大利亚', 'AU', '3', '61', 2),
(12, 'Austria', '奥地利', 'AT', '4', '43', -7),
(13, 'Azerbaijan', '阿塞拜疆', 'AZ', '4', '994', -5),
(14, 'Bahamas', '巴哈马', 'BS', '4', '1242', -13),
(15, 'Bahrain', '巴林', 'BH', '5', '973', -5),
(16, 'Bangladesh', '孟加拉国', 'BD', '5', '880', -2),
(17, 'Barbados', '巴巴多斯', 'BB', '5', '1246', -12),
(18, 'Belarus', '白俄罗斯', 'BY', '2.2', '375', -6),
(19, 'Belgium', '比利时', 'BE', '0', '32', -7),
(20, 'Belize', '伯利兹', 'BZ', '0', '501', -14),
(21, 'Benin', '贝宁', 'BJ', '0', '229', -7),
(22, 'Bermuda \nIs.', '百慕大群岛', 'BM', '0', '1441', -12),
(23, 'Bolivia', '玻利维亚', 'BO', '0', '591', -12),
(24, 'Botswana', '博茨瓦纳', 'BW', '0', '267', -6),
(25, 'Brazil', '巴西', 'BR', '2.2', '55', -11),
(26, 'Brunei', '文莱', 'BN', '2.2', '673', 0),
(27, 'Bulgaria', '保加利亚', 'BG', '0', '359', -6),
(28, 'Burkina-faso', '布基纳法索', 'BF', '0', '226', -8),
(29, 'Burma', '缅甸', 'MM', '0', '95', -1),
(30, 'Burundi', '布隆迪', 'BI', '0', '257', -6),
(31, 'Cameroon', '喀麦隆', 'CM', '0', '237', -7),
(32, 'Canada', '加拿大', 'CA', '0', '1', -13),
(33, 'Cayman Is.', '开曼群岛', ' ', '0', '1345', -13),
(34, 'Central African Republic', '中非共和国', 'CF', '0', '236', -7),
(35, 'Chad', '乍得', 'TD', '0', '235', -7),
(36, 'Chile', '智利', 'CL', '0', '56', -13),
(37, 'China', '中国', 'CN', '2', '86', 0),
(38, 'Colombia', '哥伦比亚', 'CO', '0', '57', 0),
(39, 'Congo', '刚果', 'CG', '0', '242', -7),
(40, 'Cook Is.', '库克群岛', 'CK', '0', '682', -18),
(41, 'Costa Rica', '哥斯达黎加', 'CR', '0', '506', -14),
(42, 'Cuba', '古巴', 'CU', '2.2', '53', -13),
(43, 'Cyprus', '塞浦路斯', 'CY', '0', '357', -6),
(44, 'Czech Republic ', '捷克', 'CZ', '0', '420', -7),
(45, 'Denmark', '丹麦', 'DK', '0', '45', -7),
(46, 'Djibouti', '吉布提', 'DJ', '0', '253', -5),
(47, 'Dominica \n                      Rep.', '多米尼加共和国', 'DO', '0', '1890', -13),
(48, 'Ecuador', '厄瓜多尔', 'EC', '0', '593', -13),
(49, 'Egypt', '埃及', 'EG', '0', '20', -6),
(50, 'EI \nSalvador', '萨尔瓦多', 'SV', '0', '503', -14),
(51, 'Estonia', '爱沙尼亚', 'EE', '0', '372', -5),
(52, 'Ethiopia', '埃塞俄比亚', 'ET', '0', '251', -5),
(53, 'Fiji', '斐济', 'FJ', '0', '679', 4),
(54, 'Finland', '芬兰', 'FI', '0', '358', -6),
(55, 'France', '法国', 'FR', '4', '33', -8),
(56, 'French \n                      Guiana', '法属圭亚那', 'GF', '3.5', '594', -12),
(57, 'Gabon', '加蓬', 'GA', '0', '241', -7),
(58, 'Gambia', '冈比亚', 'GM', '0', '220', -8),
(59, 'Georgia ', '格鲁吉亚', 'GE', '0', '995', 0),
(60, 'Germany ', '德国', 'DE', '0', '49', -7),
(61, 'Ghana', '加纳', 'GH', '0', '233', -8),
(62, 'Gibraltar', '直布罗陀', 'GI', '0', '350', -8),
(63, 'Greece', '希腊', 'GR', '0', '30', -6),
(64, 'Grenada', '格林纳达', 'GD', '0', '1809', -14),
(65, 'Guam', '关岛', 'GU', '0', '1671', 2),
(66, 'Guatemala', '危地马拉', 'GT', '2.2', '502', -14),
(67, 'Guinea', '几内亚', 'GN', '0', '224', -8),
(68, 'Guyana', '圭亚那', 'GY', '0', '592', -11),
(69, 'Haiti', '海地', 'HT', '0', '509', -13),
(70, 'Honduras', '洪都拉斯', 'HN', '0', '504', -14),
(71, 'Hongkong', '香港', 'HK', '0', '852', 0),
(72, 'Hungary', '匈牙利', 'HU', '0', '36', -7),
(73, 'Iceland', '冰岛', 'IS', '0', '354', -9),
(74, 'India', '印度', 'IN', '2.2', '91', -2),
(75, 'Indonesia', '印度尼西亚', 'ID', '2.2', '62', 0),
(76, 'Iran', '伊朗', 'IR', '0', '98', -4),
(77, 'Iraq', '伊拉克', 'IQ', '0', '964', -5),
(78, 'Ireland', '爱尔兰', 'IE', '0', '353', -4),
(79, 'Israel', '以色列', 'IL', '0', '972', -6),
(80, 'Italy', '意大利', 'IT', '0', '39', -7),
(81, 'Ivory \nCoast', '科特迪瓦', ' ', '0', '225', -6),
(82, 'Jamaica', '牙买加', 'JM', '0', '1876', -12),
(83, 'Japan', '日本', 'JP', '2.2', '81', 1),
(84, 'Jordan', '约旦', 'JO', '0', '962', -6),
(85, 'Kampuchea (Cambodia )', '柬埔寨', 'KH', '7.6', '855', -1),
(86, 'Kazakstan', '哈萨克斯坦', 'KZ', '7.6', '327', -5),
(87, 'Kenya', '肯尼亚', 'KE', '0', '254', -5),
(88, 'Korea', '韩国', 'KR', '4', '82', 1),
(89, 'Kuwait', '科威特', 'KW', '0', '965', -5),
(90, 'Kyrgyzstan ', '吉尔吉斯坦', 'KG', '0', '331', -5),
(91, 'Laos', '老挝', 'LA', '2.2', '856', -1),
(92, 'Latvia ', '拉脱维亚', 'LV', '6', '371', -5),
(93, 'Lebanon', '黎巴嫩', 'LB', '0', '961', -6),
(94, 'Lesotho', '莱索托', 'LS', '0', '266', -6),
(95, 'Liberia', '利比里亚', 'LR', '7.6', '231', -8),
(96, 'Libya', '利比亚', 'LY', '7.6', '218', -6),
(97, 'Liechtenstein', '列支敦士登', 'LI', '7.6', '423', -7),
(98, 'Lithuania', '立陶宛', 'LT', '0', '370', -5),
(99, 'Luxembourg', '卢森堡', 'LU', '2.2', '352', -7),
(100, 'Macao', '澳门', 'MO', '0', '853', 0),
(101, 'Madagascar', '马达加斯加', 'MG', '6', '261', -5),
(102, 'Malawi', '马拉维', 'MW', '0', '265', -6),
(103, 'Malaysia', '马来西亚', 'MY', '0', '60', 0),
(104, 'Maldives', '马尔代夫', 'MV', '0', '960', -7),
(105, 'Mali', '马里', 'ML', '7.6', '223', -8),
(106, 'Malta', '马耳他', 'MT', '0', '356', -7),
(107, 'Mariana Is', '马里亚那群岛', ' ', '7.6', '1670', 1),
(108, 'Martinique', '马提尼克', ' ', '7.6', '596', -12),
(109, 'Mauritius', '毛里求斯', 'MU', '6', '230', -4),
(110, 'Mexico', '墨西哥', 'MX', '0', '52', -15),
(111, 'Moldova, Republic of ', '摩尔多瓦', 'MD', '0', '373', -5),
(112, 'Monaco', '摩纳哥', 'MC', '0', '377', -7),
(113, 'Mongolia ', '蒙古', 'MN', '0', '976', 0),
(114, 'Montserrat \n                      Is', '蒙特塞拉特岛', 'MS', '0', '1664', -12),
(115, 'Morocco', '摩洛哥', 'MA', '0', '212', -6),
(116, 'Mozambique', '莫桑比克', 'MZ', '0', '258', -6),
(117, 'Namibia ', '纳米比亚', 'NA', '6', '264', -7),
(118, 'Nauru', '瑙鲁', 'NR', '0', '674', 4),
(119, 'Nepal', '尼泊尔', 'NP', '0', '977', -2),
(120, 'Netheriands Antilles', '荷属安的列斯', ' ', '0', '599', -12),
(121, 'Netherlands', '荷兰', 'NL', '0', '31', -7),
(122, 'New \nZealand', '新西兰', 'NZ', '0', '64', 4),
(123, 'Nicaragua', '尼加拉瓜', 'NI', '0', '505', -14),
(124, 'Niger', '尼日尔', 'NE', '0', '227', -8),
(125, 'Nigeria', '尼日利亚', 'NG', '6', '234', -7),
(126, 'North Korea', '朝鲜', 'KP', '0', '850', 1),
(127, 'Norway', '挪威', 'NO', '0', '47', -7),
(128, 'Oman', '阿曼', 'OM', '0', '968', -4),
(129, 'Pakistan', '巴基斯坦', 'PK', '0', '92', -2),
(130, 'Panama', '巴拿马', 'PA', '0', '507', -13),
(131, 'Papua New Cuinea', '巴布亚新几内亚', 'PG', '0', '675', 2),
(132, 'Paraguay', '巴拉圭', 'PY', '0', '595', -12),
(133, 'Peru', '秘鲁', 'PE', '6', '51', -13),
(134, 'Philippines', '菲律宾', 'PH', '0', '63', 0),
(135, 'Poland', '波兰', 'PL', '0', '48', -7),
(136, 'French Polynesia', '法属玻利尼西亚', 'PF', '1.3', '689', 3),
(137, 'Portugal', '葡萄牙', 'PT', '0', '351', -8),
(138, 'Puerto \nRico', '波多黎各', 'PR', '0', '1787', -12),
(139, 'Qatar', '卡塔尔', 'QA', '0', '974', -5),
(140, 'Reunion', '留尼旺', ' ', '0', '262', -4),
(141, 'Romania', '罗马尼亚', 'RO', '0', '40', -6),
(142, 'Russia', '俄罗斯', 'RU', '6', '7', -5),
(143, 'Saint Lueia', '圣卢西亚', 'LC', '0', '1758', -12),
(144, 'Saint Vincent', '圣文森特岛', 'VC', '1.3', '1784', -12),
(145, 'Samoa \n                      Eastern', '东萨摩亚(美)', ' ', '0', '684', -19),
(146, 'Samoa \n                      Western', '西萨摩亚', ' ', '0', '685', -19),
(147, 'San Marino', '圣马力诺', 'SM', '0', '378', -7),
(148, 'Sao Tome and Principe', '圣多美和普林西比', 'ST', '0', '239', -8),
(149, 'Saudi \n                      Arabia', '沙特阿拉伯', 'SA', '0', '966', -5),
(150, 'Senegal', '塞内加尔', 'SN', '0', '221', -8),
(151, 'Seychelles', '塞舌尔', 'SC', '1.3', '248', -4),
(152, 'Sierra \n                      Leone', '塞拉利昂', 'SL', '1.3', '232', -8),
(153, 'Singapore', '新加坡', 'SG', '6', '65', 0),
(154, 'Slovakia', '斯洛伐克', 'SK', '0', '421', -7),
(155, 'Slovenia', '斯洛文尼亚', 'SI', '0', '386', -7),
(156, 'Solomon Is', '所罗门群岛', 'SB', '0', '677', 3),
(157, 'Somali', '索马里', 'SO', '0', '252', -5),
(158, 'South Africa', '南非', 'ZA', '0', '27', -6),
(159, 'Spain', '西班牙', 'ES', '1.3', '34', -8),
(160, 'Sri Lanka', '斯里兰卡', 'LK', '1.3', '94', 0),
(161, 'St.Lucia', '圣卢西亚', 'LC', '0', '1758', -12),
(162, 'St.Vincent', '圣文森特', 'VC', '0', '1784', -12),
(163, 'Sudan', '苏丹', 'SD', '0', '249', -6),
(164, 'Suriname', '苏里南', 'SR', '0', '597', -11),
(165, 'Swaziland', '斯威士兰', 'SZ', '0', '268', -6),
(166, 'Sweden', '瑞典', 'SE', '0', '46', -7),
(167, 'Switzerland', '瑞士', 'CH', '0', '41', -7),
(168, 'Syria', '叙利亚', 'SY', '0', '963', -6),
(169, 'Taiwan', '台湾省', 'TW', '0', '886', 0),
(170, 'Tajikstan', '塔吉克斯坦', 'TJ', '0', '992', -5),
(171, 'Tanzania', '坦桑尼亚', 'TZ', '0', '255', -5),
(172, 'Thailand', '泰国', 'TH', '0', '66', -1),
(173, 'Togo', '多哥', 'TG', '0', '228', -8),
(174, 'Tonga', '汤加', 'TO', '0', '676', 4),
(175, 'Trinidad and Tobago', '特立尼达和多巴哥', 'TT', '0', '1809', -12),
(176, 'Tunisia', '突尼斯', 'TN', '0', '216', -7),
(177, 'Turkey', '土耳其', 'TR', '1.5', '90', -6),
(178, 'Turkmenistan ', '土库曼斯坦', 'TM', '0', '993', -5),
(179, 'Uganda', '乌干达', 'UG', '0', '256', -5),
(180, 'Ukraine', '乌克兰', 'UA', '0', '380', -5),
(181, 'United Arab Emirates', '阿拉伯联合酋长国', 'AE', '0', '971', -4),
(182, 'United Kiongdom', '英国', 'GB', '4', '44', -8),
(183, 'United States of America', '美国', 'US', '4', '1', -13),
(184, 'Uruguay', '乌拉圭', 'UY', '0', '598', -10),
(185, 'Uzbekistan', '乌兹别克斯坦', 'UZ', '0', '233', -5),
(186, 'Venezuela', '委内瑞拉', 'VE', '0', '58', -12),
(187, 'Vietnam', '越南', 'VN', '0', '84', -1),
(188, 'Yemen', '也门', 'YE', '0', '967', -5),
(189, 'Yugoslavia', '南斯拉夫', 'YU', '0', '381', -7),
(190, 'Zimbabwe', '津巴布韦', 'ZW', '0', '263', -6),
(191, 'Zaire', '扎伊尔', 'ZR', '0', '243', -7),
(192, 'Zambia', '赞比亚', 'ZM', '0', '260', -6);

-- --------------------------------------------------------

--
-- 表的结构 `devlist`
--

CREATE TABLE IF NOT EXISTS `devlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '所属用户的ID',
  `devid` varchar(255) NOT NULL COMMENT '开发者ID',
  `name` varchar(255) DEFAULT '' COMMENT '开发者名称',
  `email` varchar(255) DEFAULT '' COMMENT '开发者邮箱',
  `address` varchar(255) DEFAULT '' COMMENT '开发者地址',
  `website` varchar(255) DEFAULT '' COMMENT '开发者网站',
  `level` varchar(255) DEFAULT '' COMMENT '开发者级别,顶尖或普通',
  `token` varchar(255) NOT NULL COMMENT '开发者验证token',
  `token_exptime` int(11) NOT NULL COMMENT '开发者验证token过期',
  `status` int(11) NOT NULL COMMENT '开发者邮箱验证状态',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `devlist`
--

INSERT INTO `devlist` (`id`, `userid`, `devid`, `name`, `email`, `address`, `website`, `level`, `token`, `token_exptime`, `status`, `time`) VALUES
(1, 2, 'thehotgames', 'thehotgames', 'thehotgames2015@gmail.com', 'wuhan,China', 'https://play.google.com/store/apps/details', '2', '', 0, 1, '2016-03-14 00:00:00'),
(2, 3, '6418760394979464117', 'Autodesk Inc.', 'support@sketchbook.com', 'San Rafael, California 94903', 'http://www.autodesk.com/', '1', '', 0, 1, '2016-03-14 00:00:00'),
(3, 3, '6054197513203380012', 'Ketchapp ', 'support@ketchappgames.com', 'Ketchapp, 75015 Paris, France', 'http://www.ketchappgames.com/', '1', '', 0, 1, '2016-03-14 00:00:00'),
(4, 2, '5950758182267281572', 'Outfit7', 'support@outfit7.com', 'Sansome Street Suite 3500-#7091San Francisco CA 94104 United States', 'http://outfit7.com/applications/', '2', '', 0, 1, '2016-03-14 06:00:00'),
(5, 2, 'Fingersoft', 'Fingersoft', 'support@fingersoft.net', 'Finland', 'http://fingersoft.net/', '1', '', 0, 1, '2016-03-14 00:00:00'),
(6, 1, '7891990035506213180', 'SEGA', 'help@sega.net', 'SEGA Networks Inc\r\nFifth Floor, 612 Howard Street San Francisco CA 91405', 'https://help.sega.net/hc/en-us', '1', '', 0, 1, '2016-03-14 00:00:00'),
(7, 2, 'Disney+Publishing+Worldwide', 'Disney Publishing Worldwide', 'memberservices@disneydigitalbooks.com', 'Disney Publishing Worldwide\n1101 Flower Street\nGlendale, CA 91201-2415', 'http://www.disneystories.com', '2', '', 0, 0, '2016-04-08 17:50:16'),
(8, 2, 'King', 'King', 'candycrushsoda.techhelp@king.com', 'King.com Limited\nAragon Business Centre, Level 4, Dragonara Road, St Julians STJ3140, Malta', 'http://candycrushsodasaga.com/help/', '2', '', 0, 0, '2016-04-08 18:38:42'),
(9, 2, 'Netflix,+Inc.', 'Netflix, Inc.', 'playstore@netflix.com', '100 Winchester Circle\nLos Gatos, CA 95032-1815\nUSA', 'http://www.netflix.com', '2', '', 0, 0, NULL),
(10, 2, 'Rendered+Ideas', 'Rendered Ideas', 'support@renderedideas.com', NULL, 'http://www.renderedideas.com', '2', '', 0, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `install_detail`
--

CREATE TABLE IF NOT EXISTS `install_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_appid` varchar(255) DEFAULT NULL COMMENT '引导下载的APPid',
  `appid` varchar(255) DEFAULT NULL COMMENT '被下载的appid',
  `unique_id` int(30) DEFAULT NULL,
  `country_code` varchar(30) DEFAULT NULL,
  `language` varchar(30) DEFAULT NULL,
  `os_version` varchar(255) DEFAULT NULL,
  `phone_model` varchar(255) DEFAULT NULL,
  `carrier` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` int(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `install_detail`
--

INSERT INTO `install_detail` (`id`, `lead_appid`, `appid`, `unique_id`, `country_code`, `language`, `os_version`, `phone_model`, `carrier`, `cost`, `date`, `time`) VALUES
(1, 'com.ketchapp.splash', 'com.thehotgames.frozen_blocks', 2147483647, 'US', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-03', 1459632186),
(2, 'com.ketchapp.splash', 'com.thehotgames.dating_birds', 2147483647, 'BR', 'pt', 'Android 4.3', 'TianTian,18', '135487', '3.5', '2016-04-03', 1459632186),
(3, 'com.fingersoft.hillclimb', 'com.thehotgames.frozen_blocks', 2147483647, 'AR', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-03', 1459632186),
(4, 'com.fingersoft.hillclimb', 'com.thehotgames.dating_birds', 2147483647, 'AT', 'en', 'Android 4.3', 'TianTian,18', '135487', '3.5', '2016-04-03', 1459632186),
(5, 'com.outfit7.talkingnewsfree', 'com.thehotgames.frozen_blocks', 2147483647, 'US', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-03', 1459632186),
(6, 'com.ketchapp.splash', 'com.thehotgames.frozen_blocks', 2147483647, 'US', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-01', 1459483498),
(7, 'com.ketchapp.splash', 'com.thehotgames.dating_birds', 2147483647, 'BR', 'pt', 'Android 4.3', 'TianTian,18', '135487', '3.5', '2016-04-01', 1459483498),
(8, 'com.fingersoft.hillclimb', 'com.thehotgames.frozen_blocks', 2147483647, 'AR', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-01', 1459483498),
(9, 'com.fingersoft.hillclimb', 'com.thehotgames.dating_birds', 2147483647, 'AT', 'en', 'Android 4.3', 'TianTian,18', '135487', '3.5', '2016-04-01', 1459483498),
(10, 'com.outfit7.talkingnewsfree', 'com.thehotgames.frozen_blocks', 2147483647, 'US', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-02', 1459565189),
(15, 'com.sega.sonicdash', 'com.thehotgames.frozen_blocks', 2147483647, 'DE', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-01', 1459483498),
(16, 'com.outfit7.tomsjetski', 'com.thehotgames.frozen_blocks', 2147483647, 'FR', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-01', 1459483498),
(17, 'com.outfit7.tomsjetski', 'com.thehotgames.dating_birds', 2147483647, 'KR', 'en', 'Android 4.3', 'TianTian,18', '135487', '3.5', '2016-04-01', 1459483498),
(19, 'com.sega.sonicdash', 'com.thehotgames.frozen_blocks', 2147483647, 'DE', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-01', 1459483498),
(20, 'com.outfit7.tomsjetski', 'com.thehotgames.frozen_blocks', 2147483647, 'FR', 'en', 'Android 4.3', 'TianTian,18', '135487', '1.5', '2016-04-03', 1459632186),
(21, 'com.outfit7.tomsjetski', 'com.thehotgames.dating_birds', 2147483647, 'KR', 'en', 'Android 4.3', 'TianTian,18', '135487', '3.5', '2016-04-03', 1459632186);

-- --------------------------------------------------------

--
-- 表的结构 `loglist`
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
(1, 'This is a user''s message!', '<p>俺师傅的说法是否<br/></p>', 1, 0, 0, '2016-03-09 14:03:40'),
(2, '这是一封系统消息！', '<p>dfSFADFSFaggasgagag<br/></p>', NULL, 1, 1, '2016-03-09 14:03:29'),
(3, 'asfsafds', 'asfdafasfa', NULL, 1, 1, '2016-03-09 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `message_status`
--

CREATE TABLE IF NOT EXISTS `message_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL COMMENT '消息ID',
  `user_id` int(11) NOT NULL COMMENT '接收用户id',
  `isread` varchar(255) DEFAULT NULL COMMENT '阅读状态',
  `readtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `message_status`
--

INSERT INTO `message_status` (`id`, `message_id`, `user_id`, `isread`, `readtime`) VALUES
(1, 3, 1, '1', '2016-03-09 19:05:54'),
(2, 2, 1, '1', '2016-03-09 19:06:00'),
(3, 2, 2, '1', '2016-03-16 18:25:56'),
(4, 3, 2, '1', '2016-03-16 18:26:00');

-- --------------------------------------------------------

--
-- 表的结构 `report`
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

CREATE TABLE IF NOT EXISTS `report_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) DEFAULT NULL,
  `imp` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `installs` int(11) DEFAULT NULL,
  `cost` varchar(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=451 ;

--
-- 转存表中的数据 `report_detail`
--

INSERT INTO `report_detail` (`id`, `appid`, `imp`, `clicks`, `installs`, `cost`, `date`, `time`) VALUES
(1, 'com.JuicyBubbles', 250207, 12510, 125, '188', '2016-04-01', '1459477010'),
(2, 'com.SpeedDating', 288440, 11538, 231, '554', '2016-04-01', '1459477010'),
(3, 'com.thehotgames.dating_birds', 350891, 7018, 351, '386', '2016-04-01', '1459477010'),
(4, 'com.adsk.sketchbookhdexpress', 225061, 9002, 90, '135', '2016-04-01', '1459477010'),
(5, 'com.adsk.sketchbook', 298450, 2985, 90, '197', '2016-04-01', '1459477010'),
(6, 'com.adsk.sketchbookink_gen', 358557, 3586, 108, '301', '2016-04-02', '1459549362'),
(7, 'com.ketchapp.twist', 392884, 23573, 943, '1980', '2016-04-02', '1459549362'),
(8, 'com.ketchapp.splash', 188928, 11336, 227, '408', '2016-04-02', '1459549362'),
(9, 'com.ketchapp.stack', 134191, 5368, 54, '134', '2016-04-03', '1459629645'),
(10, 'com.ketchapp.swing', 416175, 24971, 499, '949', '2016-04-03', '1459629645'),
(11, 'com.ketchapp.hophophop', 222375, 11119, 445, '1290', '2016-04-03', '1459629645'),
(12, 'com.ketchapp.sky', 140295, 8418, 168, '471', '2016-04-06', '1459915939'),
(13, 'com.ketchapp.zigzaggame', 157434, 1574, 79, '205', '2016-04-06', '1459915939'),
(14, 'com.ketchapp.arrow', 461292, 18452, 923, '1661', '2016-04-06', '1459915939'),
(15, 'com.ketchapp.stickhero', 239368, 9575, 479, '527', '2016-04-05', '1459794441'),
(16, 'com.ketchapp.theline2', 479163, 14375, 719, '1797', '2016-03-02', '1456870724'),
(17, 'com.ketchapp.jellyjump', 368176, 18409, 184, '423', '2016-03-02', '1456870724'),
(18, 'com.ketchapp.cloudpath', 493909, 19756, 395, '909', '2016-03-02', '1456870724'),
(19, 'com.ketchapp.donttouchthespikes', 443860, 17754, 355, '426', '2016-03-02', '1456870724'),
(20, 'com.ketchapp.qubes', 405530, 20277, 406, '1176', '2016-03-02', '1456870724'),
(21, 'com.thehotgames.frozen_blocks', 366419, 14657, 293, '498', '2016-03-02', '1456870724'),
(22, 'com.thehotgames.halloween_ghost', 114025, 3421, 68, '103', '2016-03-02', '1456870724'),
(23, 'com.thehotgame.app.turtle', 435852, 17434, 872, '872', '2016-03-02', '1456870724'),
(24, 'com.outfit7.tomsbubbles', 319397, 9582, 287, '546', '2016-03-02', '1456870724'),
(25, 'com.outfit7.mytalkingangelafree', 152160, 4565, 228, '639', '2016-03-02', '1456870724'),
(26, 'com.outfit7.tomsjetski', 121643, 6082, 304, '426', '2016-03-02', '1456870724'),
(27, 'com.outfit7.mytalkingtomfree', 215344, 10767, 431, '1077', '2016-03-02', '1456870724'),
(28, 'com.outfit7.talkingangelafree', 220764, 11038, 221, '353', '2016-03-02', '1456870724'),
(29, 'com.outfit7.tomlovesangelafree', 125402, 3762, 113, '169', '2016-03-02', '1456870724'),
(30, 'com.outfit7.tomslovelettersfree', 116760, 4670, 140, '280', '2016-03-02', '1456870724'),
(31, 'com.outfit7.talkinggingerfree', 182336, 1823, 91, '146', '2016-03-02', '1456870724'),
(32, 'com.outfit7.talkingben', 109631, 5482, 274, '548', '2016-03-02', '1456870724'),
(33, 'com.outfit7.talkingnewsfree', 286145, 8584, 258, '515', '2016-03-02', '1456870724'),
(34, 'com.fingersoft.hillclimb', 499378, 4994, 200, '240', '2016-03-02', '1456870724'),
(35, 'com.waybefore.fastlikeafox', 336829, 10105, 101, '243', '2016-03-02', '1456870724'),
(36, 'com.fingersoft.nightvisioncamera', 385999, 11580, 232, '255', '2016-03-02', '1456870724'),
(37, 'com.fingersoft.benjibananas', 234387, 9375, 375, '825', '2016-03-02', '1456870724'),
(38, 'com.fingersoft.cartooncamera', 469495, 9390, 282, '338', '2016-03-02', '1456870724'),
(39, 'com.fingersoft.thermalvisioncamera', 278821, 16729, 669, '1941', '2016-03-02', '1456870724'),
(40, 'com.fingersoft.failhard', 249866, 9995, 200, '600', '2016-03-02', '1456870724'),
(41, 'com.fingersoft.ihatefish', 370130, 22208, 222, '444', '2016-03-02', '1456870724'),
(42, 'com.fingersoft.motioncamera', 427112, 25627, 256, '461', '2016-03-02', '1456870724'),
(43, 'com.sixminute.freeracing', 408313, 12249, 367, '367', '2016-03-02', '1456870724'),
(44, 'com.sega.sonicdash', 101232, 2025, 20, '28', '2016-03-02', '1456870724'),
(45, 'com.sega.cityrush', 293372, 5867, 235, '352', '2016-03-02', '1456870724'),
(46, 'com.sega.sonic.transformed', 372229, 7445, 223, '246', '2016-03-02', '1456870724'),
(47, 'com.sega.sonic4ep2lite', 325305, 3253, 65, '195', '2016-03-02', '1456870724'),
(48, 'com.sega.sonicjumpfever', 340100, 13604, 408, '1061', '2016-03-02', '1456870724'),
(49, 'com.sigames.fmh2016', 404114, 16165, 485, '1358', '2016-03-02', '1456870724'),
(50, 'com.sega.twbshogun', 304846, 3048, 91, '110', '2016-03-02', '1456870724'),
(51, 'com.JuicyBubbles', 242505, 2425, 121, '364', '2016-03-10', '1457541372'),
(52, 'com.SpeedDating', 129370, 5175, 207, '373', '2016-03-10', '1457541372'),
(53, 'com.thehotgames.dating_birds', 368579, 3686, 184, '276', '2016-03-10', '1457541372'),
(54, 'com.adsk.sketchbookhdexpress', 397632, 7953, 398, '437', '2016-03-10', '1457541372'),
(55, 'com.adsk.sketchbook', 254028, 7621, 305, '732', '2016-03-10', '1457541372'),
(56, 'com.adsk.sketchbookink_gen', 175268, 3505, 105, '252', '2016-03-10', '1457541372'),
(57, 'com.ketchapp.twist', 198852, 1989, 20, '60', '2016-03-10', '1457541372'),
(58, 'com.ketchapp.splash', 162280, 4868, 243, '268', '2016-03-10', '1457541372'),
(59, 'com.ketchapp.stack', 103051, 4122, 165, '462', '2016-03-10', '1457541372'),
(60, 'com.ketchapp.swing', 258667, 5173, 52, '150', '2016-03-10', '1457541372'),
(61, 'com.ketchapp.hophophop', 266626, 13331, 400, '520', '2016-03-10', '1457541372'),
(62, 'com.ketchapp.sky', 364429, 18221, 729, '729', '2016-03-10', '1457541372'),
(63, 'com.ketchapp.zigzaggame', 189575, 5687, 114, '239', '2016-03-10', '1457541372'),
(64, 'com.ketchapp.arrow', 379566, 11387, 342, '410', '2016-03-10', '1457541372'),
(65, 'com.ketchapp.stickhero', 171899, 3438, 103, '268', '2016-03-10', '1457541372'),
(66, 'com.ketchapp.theline2', 204077, 4082, 82, '245', '2016-03-10', '1457541372'),
(67, 'com.ketchapp.jellyjump', 113598, 6816, 68, '157', '2016-03-10', '1457541372'),
(68, 'com.ketchapp.cloudpath', 137963, 8278, 414, '662', '2016-03-10', '1457541372'),
(69, 'com.ketchapp.donttouchthespikes', 314673, 9440, 378, '1057', '2016-03-10', '1457541372'),
(70, 'com.ketchapp.qubes', 481226, 4812, 241, '674', '2016-03-10', '1457541372'),
(71, 'com.thehotgames.frozen_blocks', 275122, 5502, 55, '83', '2016-03-10', '1457541372'),
(72, 'com.thehotgames.halloween_ghost', 333862, 13354, 134, '254', '2016-03-10', '1457541372'),
(73, 'com.thehotgame.app.turtle', 294946, 5899, 118, '224', '2016-03-10', '1457541372'),
(74, 'com.outfit7.tomsbubbles', 395874, 3959, 40, '99', '2016-03-10', '1457541372'),
(75, 'com.outfit7.mytalkingangelafree', 274145, 5483, 219, '351', '2016-03-10', '1457541372'),
(76, 'com.outfit7.tomsjetski', 167260, 5018, 50, '105', '2016-03-10', '1457541372'),
(77, 'com.outfit7.mytalkingtomfree', 112719, 5636, 56, '113', '2016-03-10', '1457541372'),
(78, 'com.outfit7.talkingangelafree', 348023, 6960, 139, '306', '2016-03-10', '1457541372'),
(79, 'com.outfit7.tomlovesangelafree', 110668, 6640, 199, '538', '2016-03-10', '1457541372'),
(80, 'com.outfit7.tomslovelettersfree', 438160, 13145, 657, '1512', '2016-03-10', '1457541372'),
(81, 'com.outfit7.talkinggingerfree', 167993, 1680, 50, '50', '2016-03-10', '1457541372'),
(82, 'com.outfit7.talkingben', 337671, 16884, 507, '912', '2016-03-10', '1457541372'),
(83, 'com.outfit7.talkingnewsfree', 184692, 3694, 148, '399', '2016-03-10', '1457541372'),
(84, 'com.fingersoft.hillclimb', 346558, 17328, 693, '1663', '2016-03-10', '1457541372'),
(85, 'com.waybefore.fastlikeafox', 460767, 4608, 46, '138', '2016-03-10', '1457541372'),
(86, 'com.fingersoft.nightvisioncamera', 364819, 7296, 146, '204', '2016-03-10', '1457541372'),
(87, 'com.fingersoft.benjibananas', 496216, 14886, 298, '476', '2016-03-10', '1457541372'),
(88, 'com.fingersoft.cartooncamera', 292456, 5849, 58, '140', '2016-03-10', '1457541372'),
(89, 'com.fingersoft.thermalvisioncamera', 191040, 11462, 573, '1089', '2016-03-10', '1457541372'),
(90, 'com.fingersoft.failhard', 429468, 8589, 86, '258', '2016-03-10', '1457541372'),
(91, 'com.fingersoft.ihatefish', 245239, 4905, 49, '69', '2016-03-10', '1457541372'),
(92, 'com.fingersoft.motioncamera', 275854, 16551, 497, '1192', '2016-03-10', '1457541372'),
(93, 'com.sixminute.freeracing', 158813, 4764, 95, '162', '2016-03-10', '1457541372'),
(94, 'com.sega.sonicdash', 131616, 2632, 79, '190', '2016-03-10', '1457541372'),
(95, 'com.sega.cityrush', 231763, 13906, 278, '640', '2016-03-10', '1457541372'),
(96, 'com.sega.sonic.transformed', 296753, 17805, 712, '1638', '2016-03-10', '1457541372'),
(97, 'com.sega.sonic4ep2lite', 364087, 14563, 728, '1820', '2016-03-10', '1457541372'),
(98, 'com.sega.sonicjumpfever', 271265, 10851, 543, '922', '2016-03-10', '1457541372'),
(99, 'com.sigames.fmh2016', 455787, 9116, 456, '912', '2016-03-10', '1457541372'),
(100, 'com.sega.twbshogun', 355152, 3552, 178, '391', '2016-03-10', '1457541372'),
(101, 'com.JuicyBubbles', 406861, 12206, 610, '1343', '2016-03-11', '1457652183'),
(102, 'com.SpeedDating', 448413, 4484, 90, '90', '2016-03-11', '1457652183'),
(103, 'com.thehotgames.dating_birds', 117309, 2346, 94, '253', '2016-03-11', '1457652183'),
(104, 'com.adsk.sketchbookhdexpress', 451050, 13532, 541, '1028', '2016-03-11', '1457652183'),
(105, 'com.adsk.sketchbook', 287134, 2871, 57, '167', '2016-03-11', '1457652183'),
(106, 'com.adsk.sketchbookink_gen', 263061, 15784, 316, '726', '2016-03-11', '1457652183'),
(107, 'com.ketchapp.twist', 416333, 24980, 1249, '2873', '2016-03-11', '1457652183'),
(108, 'com.ketchapp.splash', 184448, 1844, 55, '94', '2016-03-11', '1457652183'),
(109, 'com.ketchapp.stack', 404907, 12147, 607, '1518', '2016-03-11', '1457652183'),
(110, 'com.ketchapp.swing', 115209, 5760, 115, '173', '2016-03-11', '1457652183'),
(111, 'com.ketchapp.hophophop', 152856, 4586, 138, '399', '2016-03-11', '1457652183'),
(112, 'com.ketchapp.sky', 355347, 21321, 213, '277', '2016-03-11', '1457652183'),
(113, 'com.ketchapp.zigzaggame', 360181, 10805, 540, '1621', '2016-03-11', '1457652183'),
(114, 'com.ketchapp.arrow', 404859, 24292, 243, '656', '2016-03-11', '1457652183'),
(115, 'com.ketchapp.stickhero', 126879, 5075, 152, '350', '2016-03-11', '1457652183'),
(116, 'com.ketchapp.theline2', 163745, 9825, 393, '1179', '2016-03-11', '1457652183'),
(117, 'com.ketchapp.jellyjump', 152954, 3059, 61, '147', '2016-03-11', '1457652183'),
(118, 'com.ketchapp.cloudpath', 332007, 9960, 398, '677', '2016-03-11', '1457652183'),
(119, 'com.ketchapp.donttouchthespikes', 338403, 10152, 406, '1137', '2016-03-11', '1457652183'),
(120, 'com.ketchapp.qubes', 409644, 4096, 205, '512', '2016-03-11', '1457652183'),
(121, 'com.thehotgames.frozen_blocks', 183227, 9161, 458, '1328', '2016-03-11', '1457652183'),
(122, 'com.thehotgames.halloween_ghost', 296655, 17799, 178, '498', '2016-03-11', '1457652183'),
(123, 'com.thehotgame.app.turtle', 387427, 3874, 116, '244', '2016-03-11', '1457652183'),
(124, 'com.outfit7.tomsbubbles', 293042, 11722, 117, '223', '2016-03-11', '1457652183'),
(125, 'com.outfit7.mytalkingangelafree', 451001, 27060, 1353, '2977', '2016-03-11', '1457652183'),
(126, 'com.outfit7.tomsjetski', 298804, 14940, 448, '717', '2016-03-11', '1457652183'),
(127, 'com.outfit7.mytalkingtomfree', 273950, 8219, 164, '394', '2016-03-11', '1457652183'),
(128, 'com.outfit7.talkingangelafree', 213940, 4279, 43, '56', '2016-03-11', '1457652183'),
(129, 'com.outfit7.tomlovesangelafree', 156274, 9376, 188, '450', '2016-03-11', '1457652183'),
(130, 'com.outfit7.tomslovelettersfree', 338452, 20307, 812, '2112', '2016-03-11', '1457652183'),
(131, 'com.outfit7.talkinggingerfree', 397974, 11939, 478, '764', '2016-03-11', '1457652183'),
(132, 'com.outfit7.talkingben', 172339, 3447, 172, '483', '2016-03-11', '1457652183'),
(133, 'com.outfit7.talkingnewsfree', 499048, 19962, 200, '319', '2016-03-11', '1457652183'),
(134, 'com.fingersoft.hillclimb', 415601, 4156, 166, '216', '2016-03-11', '1457652183'),
(135, 'com.waybefore.fastlikeafox', 359497, 7190, 144, '259', '2016-03-11', '1457652183'),
(136, 'com.fingersoft.nightvisioncamera', 168237, 5047, 151, '303', '2016-03-11', '1457652183'),
(137, 'com.fingersoft.benjibananas', 279321, 16759, 168, '302', '2016-03-11', '1457652183'),
(138, 'com.fingersoft.cartooncamera', 130249, 5210, 156, '328', '2016-03-11', '1457652183'),
(139, 'com.fingersoft.thermalvisioncamera', 158520, 7926, 159, '476', '2016-03-11', '1457652183'),
(140, 'com.fingersoft.failhard', 201635, 10082, 101, '121', '2016-03-11', '1457652183'),
(141, 'com.fingersoft.ihatefish', 297095, 2971, 89, '258', '2016-03-11', '1457652183'),
(142, 'com.fingersoft.motioncamera', 282397, 8472, 85, '246', '2016-03-11', '1457652183'),
(143, 'com.sixminute.freeracing', 195044, 11703, 468, '468', '2016-03-11', '1457652183'),
(144, 'com.sega.sonicdash', 272534, 5451, 164, '392', '2016-03-11', '1457652183'),
(145, 'com.sega.cityrush', 152368, 9142, 183, '530', '2016-03-11', '1457652183'),
(146, 'com.sega.sonic.transformed', 472046, 9441, 378, '529', '2016-03-11', '1457652183'),
(147, 'com.sega.sonic4ep2lite', 469068, 23453, 469, '938', '2016-03-11', '1457652183'),
(148, 'com.sega.sonicjumpfever', 380933, 3809, 152, '229', '2016-03-11', '1457652183'),
(149, 'com.sigames.fmh2016', 245141, 7354, 221, '397', '2016-03-11', '1457652183'),
(150, 'com.sega.twbshogun', 299194, 8976, 90, '180', '2016-03-11', '1457652183'),
(151, 'com.JuicyBubbles', 180591, 5418, 108, '206', '2016-03-13', '1457840695'),
(152, 'com.SpeedDating', 126831, 1268, 51, '132', '2016-03-13', '1457840695'),
(153, 'com.thehotgames.dating_birds', 175415, 7017, 351, '596', '2016-03-13', '1457840695'),
(154, 'com.adsk.sketchbookhdexpress', 163842, 8192, 164, '426', '2016-03-13', '1457840695'),
(155, 'com.adsk.sketchbook', 129614, 6481, 259, '726', '2016-03-13', '1457840695'),
(156, 'com.adsk.sketchbookink_gen', 310230, 6205, 186, '279', '2016-03-13', '1457840695'),
(157, 'com.ketchapp.twist', 343189, 13728, 549, '1428', '2016-03-13', '1457840695'),
(158, 'com.ketchapp.splash', 465992, 13980, 280, '839', '2016-03-13', '1457840695'),
(159, 'com.ketchapp.stack', 316138, 18968, 569, '1480', '2016-03-13', '1457840695'),
(160, 'com.ketchapp.swing', 131128, 6556, 131, '315', '2016-03-13', '1457840695'),
(161, 'com.ketchapp.hophophop', 348462, 6969, 348, '836', '2016-03-13', '1457840695'),
(162, 'com.ketchapp.sky', 405640, 8113, 162, '211', '2016-03-13', '1457840695'),
(163, 'com.ketchapp.zigzaggame', 340161, 13606, 408, '531', '2016-03-13', '1457840695'),
(164, 'com.ketchapp.arrow', 389527, 11686, 584, '701', '2016-03-13', '1457840695'),
(165, 'com.ketchapp.stickhero', 191235, 9562, 191, '191', '2016-03-13', '1457840695'),
(166, 'com.ketchapp.theline2', 382788, 7656, 77, '130', '2016-03-13', '1457840695'),
(167, 'com.ketchapp.jellyjump', 201684, 4034, 202, '202', '2016-03-13', '1457840695'),
(168, 'com.ketchapp.cloudpath', 285425, 5709, 114, '240', '2016-03-13', '1457840695'),
(169, 'com.ketchapp.donttouchthespikes', 271509, 13575, 136, '367', '2016-03-13', '1457840695'),
(170, 'com.ketchapp.qubes', 397437, 11923, 358, '680', '2016-03-13', '1457840695'),
(171, 'com.thehotgames.frozen_blocks', 300708, 9021, 361, '577', '2016-03-13', '1457840695'),
(172, 'com.thehotgames.halloween_ghost', 218823, 6565, 197, '551', '2016-03-13', '1457840695'),
(173, 'com.thehotgame.app.turtle', 189282, 9464, 189, '246', '2016-03-13', '1457840695'),
(174, 'com.outfit7.tomsbubbles', 449585, 26975, 270, '566', '2016-03-13', '1457840695'),
(175, 'com.outfit7.mytalkingangelafree', 237231, 7117, 285, '342', '2016-03-13', '1457840695'),
(176, 'com.outfit7.tomsjetski', 189721, 9486, 379, '531', '2016-03-13', '1457840695'),
(177, 'com.outfit7.mytalkingtomfree', 344556, 6891, 276, '799', '2016-03-13', '1457840695'),
(178, 'com.outfit7.talkingangelafree', 139233, 5569, 111, '256', '2016-03-13', '1457840695'),
(179, 'com.outfit7.tomlovesangelafree', 411255, 4113, 41, '70', '2016-03-13', '1457840695'),
(180, 'com.outfit7.tomslovelettersfree', 198120, 3962, 158, '317', '2016-03-13', '1457840695'),
(181, 'com.outfit7.talkinggingerfree', 337329, 13493, 540, '648', '2016-03-13', '1457840695'),
(182, 'com.outfit7.talkingben', 266382, 7991, 240, '551', '2016-03-13', '1457840695'),
(183, 'com.outfit7.talkingnewsfree', 422779, 12683, 634, '698', '2016-03-13', '1457840695'),
(184, 'com.fingersoft.hillclimb', 244018, 2440, 73, '190', '2016-03-13', '1457840695'),
(185, 'com.waybefore.fastlikeafox', 167602, 6704, 335, '905', '2016-03-13', '1457840695'),
(186, 'com.fingersoft.nightvisioncamera', 431031, 17241, 517, '1190', '2016-03-13', '1457840695'),
(187, 'com.fingersoft.benjibananas', 271802, 10872, 109, '163', '2016-03-13', '1457840695'),
(188, 'com.fingersoft.cartooncamera', 327417, 3274, 33, '33', '2016-03-13', '1457840695'),
(189, 'com.fingersoft.thermalvisioncamera', 235376, 4708, 94, '94', '2016-03-13', '1457840695'),
(190, 'com.fingersoft.failhard', 233179, 13991, 280, '644', '2016-03-13', '1457840695'),
(191, 'com.fingersoft.ihatefish', 358325, 10750, 322, '903', '2016-03-13', '1457840695'),
(192, 'com.fingersoft.motioncamera', 448316, 8966, 269, '377', '2016-03-13', '1457840695'),
(193, 'com.sixminute.freeracing', 140649, 7032, 141, '323', '2016-03-13', '1457840695'),
(194, 'com.sega.sonicdash', 472828, 18913, 946, '2080', '2016-03-13', '1457840695'),
(195, 'com.sega.cityrush', 282349, 16941, 339, '339', '2016-03-13', '1457840695'),
(196, 'com.sega.sonic.transformed', 206714, 8269, 413, '744', '2016-03-13', '1457840695'),
(197, 'com.sega.sonic4ep2lite', 283423, 14171, 425, '1063', '2016-03-13', '1457840695'),
(198, 'com.sega.sonicjumpfever', 349976, 7000, 140, '280', '2016-03-13', '1457840695'),
(199, 'com.sigames.fmh2016', 443872, 8877, 266, '586', '2016-03-13', '1457840695'),
(200, 'com.sega.twbshogun', 402613, 8052, 81, '169', '2016-03-13', '1457840695'),
(201, 'com.JuicyBubbles', 263696, 13185, 132, '211', '2016-03-14', '1457893566'),
(202, 'com.SpeedDating', 264624, 5292, 212, '360', '2016-03-14', '1457893566'),
(203, 'com.thehotgames.dating_birds', 442896, 4429, 221, '509', '2016-03-14', '1457893566'),
(204, 'com.adsk.sketchbookhdexpress', 236011, 2360, 24, '57', '2016-03-14', '1457893566'),
(205, 'com.adsk.sketchbook', 481470, 9629, 481, '818', '2016-03-14', '1457893566'),
(206, 'com.adsk.sketchbookink_gen', 216772, 6503, 325, '455', '2016-03-14', '1457893566'),
(207, 'com.ketchapp.twist', 279419, 16765, 838, '1090', '2016-03-14', '1457893566'),
(208, 'com.ketchapp.splash', 106909, 1069, 53, '134', '2016-03-14', '1457893566'),
(209, 'com.ketchapp.stack', 136743, 5470, 109, '306', '2016-03-14', '1457893566'),
(210, 'com.ketchapp.swing', 206421, 12385, 619, '619', '2016-03-14', '1457893566'),
(211, 'com.ketchapp.hophophop', 353443, 7069, 353, '459', '2016-03-14', '1457893566'),
(212, 'com.ketchapp.sky', 415308, 12459, 498, '1296', '2016-03-14', '1457893566'),
(213, 'com.ketchapp.zigzaggame', 429517, 17181, 859, '2319', '2016-03-14', '1457893566'),
(214, 'com.ketchapp.arrow', 233569, 9343, 467, '1261', '2016-03-14', '1457893566'),
(215, 'com.ketchapp.stickhero', 264966, 7949, 238, '548', '2016-03-14', '1457893566'),
(216, 'com.ketchapp.theline2', 361206, 21672, 433, '1170', '2016-03-14', '1457893566'),
(217, 'com.ketchapp.jellyjump', 159790, 4794, 192, '307', '2016-03-14', '1457893566'),
(218, 'com.ketchapp.cloudpath', 298218, 8947, 268, '564', '2016-03-14', '1457893566'),
(219, 'com.ketchapp.donttouchthespikes', 413990, 8280, 166, '364', '2016-03-14', '1457893566'),
(220, 'com.ketchapp.qubes', 344605, 17230, 689, '1792', '2016-03-14', '1457893566'),
(221, 'com.thehotgames.frozen_blocks', 127563, 7654, 77, '107', '2016-03-14', '1457893566'),
(222, 'com.thehotgames.halloween_ghost', 400366, 16015, 160, '256', '2016-03-14', '1457893566'),
(223, 'com.thehotgame.app.turtle', 400513, 24031, 721, '2163', '2016-03-14', '1457893566'),
(224, 'com.outfit7.tomsbubbles', 365503, 14620, 731, '1901', '2016-03-14', '1457893566'),
(225, 'com.outfit7.mytalkingangelafree', 332837, 3328, 133, '293', '2016-03-14', '1457893566'),
(226, 'com.outfit7.tomsjetski', 140014, 7001, 210, '630', '2016-03-14', '1457893566'),
(227, 'com.outfit7.mytalkingtomfree', 224536, 2245, 22, '61', '2016-03-14', '1457893566'),
(228, 'com.outfit7.talkingangelafree', 423902, 21195, 1060, '2543', '2016-03-14', '1457893566'),
(229, 'com.outfit7.tomlovesangelafree', 375611, 22537, 901, '1713', '2016-03-14', '1457893566'),
(230, 'com.outfit7.tomslovelettersfree', 317163, 9515, 381, '875', '2016-03-14', '1457893566'),
(231, 'com.outfit7.talkinggingerfree', 286060, 5721, 57, '80', '2016-03-14', '1457893566'),
(232, 'com.outfit7.talkingben', 119799, 2396, 120, '264', '2016-03-14', '1457893566'),
(233, 'com.outfit7.talkingnewsfree', 255884, 10235, 102, '266', '2016-03-14', '1457893566'),
(234, 'com.fingersoft.hillclimb', 131811, 1318, 66, '99', '2016-03-14', '1457893566'),
(235, 'com.waybefore.fastlikeafox', 185083, 11105, 222, '666', '2016-03-14', '1457893566'),
(236, 'com.fingersoft.nightvisioncamera', 253198, 12660, 506, '962', '2016-03-14', '1457893566'),
(237, 'com.fingersoft.benjibananas', 373657, 22419, 897, '1973', '2016-03-14', '1457893566'),
(238, 'com.fingersoft.cartooncamera', 383960, 3840, 192, '538', '2016-03-14', '1457893566'),
(239, 'com.fingersoft.thermalvisioncamera', 321606, 9648, 482, '724', '2016-03-14', '1457893566'),
(240, 'com.fingersoft.failhard', 424097, 16964, 339, '509', '2016-03-14', '1457893566'),
(241, 'com.fingersoft.ihatefish', 328931, 19736, 789, '2131', '2016-03-14', '1457893566'),
(242, 'com.fingersoft.motioncamera', 273608, 5472, 164, '312', '2016-03-14', '1457893566'),
(243, 'com.sixminute.freeracing', 295630, 11825, 591, '591', '2016-03-14', '1457893566'),
(244, 'com.sega.sonicdash', 232495, 9300, 372, '409', '2016-03-14', '1457893566'),
(245, 'com.sega.cityrush', 121704, 6085, 61, '128', '2016-03-14', '1457893566'),
(246, 'com.sega.sonic.transformed', 200757, 8030, 161, '482', '2016-03-14', '1457893566'),
(247, 'com.sega.sonic4ep2lite', 107153, 3215, 32, '45', '2016-03-14', '1457893566'),
(248, 'com.sega.sonicjumpfever', 478394, 28704, 1435, '3875', '2016-03-14', '1457893566'),
(249, 'com.sigames.fmh2016', 151977, 3040, 122, '316', '2016-03-14', '1457893566'),
(250, 'com.sega.twbshogun', 165405, 3308, 132, '251', '2016-03-14', '1457893566'),
(251, 'com.JuicyBubbles', 156176, 1562, 62, '181', '2016-03-15', '1457974763'),
(252, 'com.SpeedDating', 361792, 10854, 109, '239', '2016-03-15', '1457974763'),
(253, 'com.thehotgames.dating_birds', 419751, 12593, 504, '957', '2016-03-15', '1457974763'),
(254, 'com.adsk.sketchbookhdexpress', 167553, 1676, 17, '49', '2016-03-15', '1457974763'),
(255, 'com.adsk.sketchbook', 442701, 13281, 531, '584', '2016-03-15', '1457974763'),
(256, 'com.adsk.sketchbookink_gen', 282690, 2827, 28, '45', '2016-03-15', '1457974763'),
(257, 'com.ketchapp.twist', 125024, 3751, 38, '83', '2016-03-15', '1457974763'),
(258, 'com.ketchapp.splash', 207202, 2072, 21, '37', '2016-03-15', '1457974763'),
(259, 'com.ketchapp.stack', 166723, 5002, 250, '600', '2016-03-15', '1457974763'),
(260, 'com.ketchapp.swing', 241089, 14465, 723, '2170', '2016-03-15', '1457974763'),
(261, 'com.ketchapp.hophophop', 467798, 4678, 234, '304', '2016-03-15', '1457974763'),
(262, 'com.ketchapp.sky', 284351, 8531, 85, '222', '2016-03-15', '1457974763'),
(263, 'com.ketchapp.zigzaggame', 128247, 2565, 103, '267', '2016-03-15', '1457974763'),
(264, 'com.ketchapp.arrow', 236987, 2370, 95, '209', '2016-03-15', '1457974763'),
(265, 'com.ketchapp.stickhero', 248071, 7442, 372, '558', '2016-03-15', '1457974763'),
(266, 'com.ketchapp.theline2', 398999, 23940, 239, '311', '2016-03-15', '1457974763'),
(267, 'com.ketchapp.jellyjump', 327271, 13091, 524, '890', '2016-03-15', '1457974763'),
(268, 'com.ketchapp.cloudpath', 270386, 8112, 81, '114', '2016-03-15', '1457974763'),
(269, 'com.ketchapp.donttouchthespikes', 265845, 10634, 213, '553', '2016-03-15', '1457974763'),
(270, 'com.ketchapp.qubes', 151147, 6046, 242, '484', '2016-03-15', '1457974763'),
(271, 'com.thehotgames.frozen_blocks', 363794, 21828, 1091, '1855', '2016-03-15', '1457974763'),
(272, 'com.thehotgames.halloween_ghost', 341284, 3413, 102, '266', '2016-03-15', '1457974763'),
(273, 'com.thehotgame.app.turtle', 121118, 3634, 36, '94', '2016-03-15', '1457974763'),
(274, 'com.outfit7.tomsbubbles', 340796, 13632, 273, '736', '2016-03-15', '1457974763'),
(275, 'com.outfit7.mytalkingangelafree', 237817, 11891, 476, '1332', '2016-03-15', '1457974763'),
(276, 'com.outfit7.tomsjetski', 449683, 22484, 899, '1529', '2016-03-15', '1457974763'),
(277, 'com.outfit7.mytalkingtomfree', 213891, 12833, 257, '385', '2016-03-15', '1457974763'),
(278, 'com.outfit7.talkingangelafree', 167944, 8397, 336, '403', '2016-03-15', '1457974763'),
(279, 'com.outfit7.tomlovesangelafree', 349341, 10480, 419, '1132', '2016-03-15', '1457974763'),
(280, 'com.outfit7.tomslovelettersfree', 195581, 9779, 391, '1095', '2016-03-15', '1457974763'),
(281, 'com.outfit7.talkinggingerfree', 144165, 1442, 58, '81', '2016-03-15', '1457974763'),
(282, 'com.outfit7.talkingben', 432593, 4326, 216, '368', '2016-03-15', '1457974763'),
(283, 'com.outfit7.talkingnewsfree', 298364, 14918, 149, '224', '2016-03-15', '1457974763'),
(284, 'com.fingersoft.hillclimb', 378980, 3790, 152, '258', '2016-03-15', '1457974763'),
(285, 'com.waybefore.fastlikeafox', 311939, 3119, 94, '215', '2016-03-15', '1457974763'),
(286, 'com.fingersoft.nightvisioncamera', 334741, 13390, 669, '1473', '2016-03-15', '1457974763'),
(287, 'com.fingersoft.benjibananas', 484888, 29093, 1164, '1513', '2016-03-15', '1457974763'),
(288, 'com.fingersoft.cartooncamera', 199878, 5996, 120, '324', '2016-03-15', '1457974763'),
(289, 'com.fingersoft.thermalvisioncamera', 317212, 15861, 634, '1332', '2016-03-15', '1457974763'),
(290, 'com.fingersoft.failhard', 274390, 8232, 329, '856', '2016-03-15', '1457974763'),
(291, 'com.fingersoft.ihatefish', 108911, 4356, 174, '366', '2016-03-15', '1457974763'),
(292, 'com.fingersoft.motioncamera', 458277, 4583, 229, '344', '2016-03-15', '1457974763'),
(293, 'com.sixminute.freeracing', 159985, 3200, 32, '90', '2016-03-15', '1457974763'),
(294, 'com.sega.sonicdash', 251538, 7546, 226, '657', '2016-03-15', '1457974763'),
(295, 'com.sega.cityrush', 370435, 3704, 37, '63', '2016-03-15', '1457974763'),
(296, 'com.sega.sonic.transformed', 354175, 3542, 71, '163', '2016-03-15', '1457974763'),
(297, 'com.sega.sonic4ep2lite', 240259, 4805, 240, '601', '2016-03-15', '1457974763'),
(298, 'com.sega.sonicjumpfever', 266186, 13309, 133, '146', '2016-03-15', '1457974763'),
(299, 'com.sigames.fmh2016', 469458, 14084, 704, '1690', '2016-03-15', '1457974763'),
(300, 'com.sega.twbshogun', 287573, 2876, 115, '115', '2016-03-15', '1457974763'),
(301, 'com.JuicyBubbles', 158032, 1580, 16, '16', '2016-03-16', '1458084989'),
(302, 'com.SpeedDating', 318335, 3183, 96, '124', '2016-03-16', '1458084989'),
(303, 'com.thehotgames.dating_birds', 405982, 12179, 122, '231', '2016-03-16', '1458084989'),
(304, 'com.adsk.sketchbookhdexpress', 258472, 7754, 310, '496', '2016-03-16', '1458084989'),
(305, 'com.adsk.sketchbook', 313306, 15665, 470, '1222', '2016-03-16', '1458084989'),
(306, 'com.adsk.sketchbookink_gen', 407984, 24479, 1224, '1714', '2016-03-16', '1458084989'),
(307, 'com.ketchapp.twist', 180005, 1800, 54, '130', '2016-03-16', '1458084989'),
(308, 'com.ketchapp.splash', 266870, 2669, 107, '246', '2016-03-16', '1458084989'),
(309, 'com.ketchapp.stack', 306079, 3061, 92, '275', '2016-03-16', '1458084989'),
(310, 'com.ketchapp.swing', 135131, 6757, 338, '507', '2016-03-16', '1458084989'),
(311, 'com.ketchapp.hophophop', 191528, 5746, 115, '207', '2016-03-16', '1458084989'),
(312, 'com.ketchapp.sky', 312769, 15638, 469, '1314', '2016-03-16', '1458084989'),
(313, 'com.ketchapp.zigzaggame', 136352, 1364, 55, '131', '2016-03-16', '1458084989'),
(314, 'com.ketchapp.arrow', 299780, 17987, 899, '1349', '2016-03-16', '1458084989'),
(315, 'com.ketchapp.stickhero', 440552, 17622, 352, '775', '2016-03-16', '1458084989'),
(316, 'com.ketchapp.theline2', 396167, 19808, 198, '238', '2016-03-16', '1458084989'),
(317, 'com.ketchapp.jellyjump', 204126, 10206, 102, '286', '2016-03-16', '1458084989'),
(318, 'com.ketchapp.cloudpath', 101928, 2039, 82, '122', '2016-03-16', '1458084989'),
(319, 'com.ketchapp.donttouchthespikes', 127075, 3812, 191, '286', '2016-03-16', '1458084989'),
(320, 'com.ketchapp.qubes', 117065, 7024, 281, '478', '2016-03-16', '1458084989'),
(321, 'com.thehotgames.frozen_blocks', 109399, 1094, 11, '22', '2016-03-16', '1458084989'),
(322, 'com.thehotgames.halloween_ghost', 341577, 17079, 512, '666', '2016-03-16', '1458084989'),
(323, 'com.thehotgame.app.turtle', 451099, 27066, 1083, '1840', '2016-03-16', '1458084989'),
(324, 'com.outfit7.tomsbubbles', 275464, 8264, 413, '826', '2016-03-16', '1458084989'),
(325, 'com.outfit7.mytalkingangelafree', 252173, 5043, 101, '222', '2016-03-16', '1458084989'),
(326, 'com.outfit7.tomsjetski', 218725, 8749, 437, '525', '2016-03-16', '1458084989'),
(327, 'com.outfit7.mytalkingtomfree', 212622, 2126, 85, '255', '2016-03-16', '1458084989'),
(328, 'com.outfit7.talkingangelafree', 471363, 28282, 283, '650', '2016-03-16', '1458084989'),
(329, 'com.outfit7.tomlovesangelafree', 232446, 4649, 232, '302', '2016-03-16', '1458084989'),
(330, 'com.outfit7.tomslovelettersfree', 133374, 5335, 107, '320', '2016-03-16', '1458084989'),
(331, 'com.outfit7.talkinggingerfree', 211645, 2116, 42, '42', '2016-03-16', '1458084989'),
(332, 'com.outfit7.talkingben', 304761, 15238, 152, '396', '2016-03-16', '1458084989'),
(333, 'com.outfit7.talkingnewsfree', 450220, 22511, 900, '1261', '2016-03-16', '1458084989'),
(334, 'com.fingersoft.hillclimb', 485523, 24276, 728, '1966', '2016-03-16', '1458084989'),
(335, 'com.waybefore.fastlikeafox', 448169, 26890, 269, '565', '2016-03-16', '1458084989'),
(336, 'com.fingersoft.nightvisioncamera', 175659, 10540, 105, '295', '2016-03-16', '1458084989'),
(337, 'com.fingersoft.benjibananas', 105493, 1055, 11, '26', '2016-03-16', '1458084989'),
(338, 'com.fingersoft.cartooncamera', 475171, 4752, 143, '328', '2016-03-16', '1458084989'),
(339, 'com.fingersoft.thermalvisioncamera', 122192, 2444, 49, '103', '2016-03-16', '1458084989'),
(340, 'com.fingersoft.failhard', 484058, 9681, 387, '1123', '2016-03-16', '1458084989'),
(341, 'com.fingersoft.ihatefish', 398267, 3983, 159, '398', '2016-03-16', '1458084989'),
(342, 'com.fingersoft.motioncamera', 102319, 5116, 102, '184', '2016-03-16', '1458084989'),
(343, 'com.sixminute.freeracing', 433716, 13011, 651, '651', '2016-03-16', '1458084989'),
(344, 'com.sega.sonicdash', 429956, 21498, 430, '1247', '2016-03-16', '1458084989'),
(345, 'com.sega.cityrush', 128540, 7712, 231, '301', '2016-03-16', '1458084989'),
(346, 'com.sega.sonic.transformed', 166967, 6679, 67, '87', '2016-03-16', '1458084989'),
(347, 'com.sega.sonic4ep2lite', 182739, 3655, 146, '424', '2016-03-16', '1458084989'),
(348, 'com.sega.sonicjumpfever', 413355, 12401, 496, '1438', '2016-03-16', '1458084989'),
(349, 'com.sigames.fmh2016', 496314, 14889, 744, '819', '2016-03-16', '1458084989'),
(350, 'com.sega.twbshogun', 269116, 13456, 538, '1507', '2016-03-16', '1458084989'),
(351, 'com.JuicyBubbles', 169262, 10156, 508, '863', '2016-03-17', '1458193076'),
(352, 'com.SpeedDating', 434253, 13028, 651, '1824', '2016-03-17', '1458193076'),
(353, 'com.thehotgames.dating_birds', 301587, 12063, 362, '688', '2016-03-17', '1458193076'),
(354, 'com.adsk.sketchbookhdexpress', 408765, 4088, 41, '90', '2016-03-17', '1458193076'),
(355, 'com.adsk.sketchbook', 393286, 3933, 118, '165', '2016-03-17', '1458193076'),
(356, 'com.adsk.sketchbookink_gen', 492652, 19706, 985, '2562', '2016-03-17', '1458193076'),
(357, 'com.ketchapp.twist', 344360, 10331, 310, '496', '2016-03-17', '1458193076'),
(358, 'com.ketchapp.splash', 185913, 7437, 149, '223', '2016-03-17', '1458193076'),
(359, 'com.ketchapp.stack', 454810, 4548, 91, '191', '2016-03-17', '1458193076'),
(360, 'com.ketchapp.swing', 188550, 11313, 566, '1358', '2016-03-17', '1458193076'),
(361, 'com.ketchapp.hophophop', 224634, 2246, 90, '207', '2016-03-17', '1458193076'),
(362, 'com.ketchapp.sky', 400562, 8011, 240, '673', '2016-03-17', '1458193076'),
(363, 'com.ketchapp.zigzaggame', 353833, 21230, 637, '1083', '2016-03-17', '1458193076'),
(364, 'com.ketchapp.arrow', 321948, 12878, 515, '1082', '2016-03-17', '1458193076'),
(365, 'com.ketchapp.stickhero', 342407, 10272, 308, '586', '2016-03-17', '1458193076'),
(366, 'com.ketchapp.theline2', 252710, 5054, 101, '192', '2016-03-17', '1458193076'),
(367, 'com.ketchapp.jellyjump', 490357, 14711, 147, '338', '2016-03-17', '1458193076'),
(368, 'com.ketchapp.cloudpath', 492847, 14785, 296, '532', '2016-03-17', '1458193076'),
(369, 'com.ketchapp.donttouchthespikes', 297681, 8930, 268, '643', '2016-03-17', '1458193076'),
(370, 'com.ketchapp.qubes', 142358, 4271, 43, '43', '2016-03-17', '1458193076'),
(371, 'com.thehotgames.frozen_blocks', 464380, 18575, 186, '316', '2016-03-17', '1458193076'),
(372, 'com.thehotgames.halloween_ghost', 301245, 9037, 361, '470', '2016-03-17', '1458193076'),
(373, 'com.thehotgame.app.turtle', 490455, 9809, 490, '932', '2016-03-17', '1458193076'),
(374, 'com.outfit7.tomsbubbles', 469507, 28170, 1127, '2479', '2016-03-17', '1458193076'),
(375, 'com.outfit7.mytalkingangelafree', 275903, 8277, 166, '364', '2016-03-17', '1458193076'),
(376, 'com.outfit7.tomsjetski', 147143, 5886, 59, '177', '2016-03-17', '1458193076'),
(377, 'com.outfit7.mytalkingtomfree', 120727, 6036, 181, '417', '2016-03-17', '1458193076'),
(378, 'com.outfit7.talkingangelafree', 434156, 13025, 260, '287', '2016-03-17', '1458193076'),
(379, 'com.outfit7.tomlovesangelafree', 324927, 3249, 32, '49', '2016-03-17', '1458193076'),
(380, 'com.outfit7.tomslovelettersfree', 430542, 4305, 43, '103', '2016-03-17', '1458193076'),
(381, 'com.outfit7.talkinggingerfree', 388501, 23310, 699, '1119', '2016-03-17', '1458193076'),
(382, 'com.outfit7.talkingben', 436304, 8726, 262, '550', '2016-03-17', '1458193076'),
(383, 'com.outfit7.talkingnewsfree', 211450, 6344, 317, '603', '2016-03-17', '1458193076'),
(384, 'com.fingersoft.hillclimb', 351441, 17572, 176, '316', '2016-03-17', '1458193076'),
(385, 'com.waybefore.fastlikeafox', 493775, 29627, 1481, '2815', '2016-03-17', '1458193076'),
(386, 'com.fingersoft.nightvisioncamera', 475953, 14279, 571, '1713', '2016-03-17', '1458193076'),
(387, 'com.fingersoft.benjibananas', 335474, 10064, 201, '221', '2016-03-17', '1458193076'),
(388, 'com.fingersoft.cartooncamera', 309839, 15492, 775, '852', '2016-03-17', '1458193076'),
(389, 'com.fingersoft.thermalvisioncamera', 436548, 17462, 698, '698', '2016-03-17', '1458193076'),
(390, 'com.fingersoft.failhard', 153100, 6124, 245, '441', '2016-03-17', '1458193076'),
(391, 'com.fingersoft.ihatefish', 296997, 2970, 148, '178', '2016-03-17', '1458193076'),
(392, 'com.fingersoft.motioncamera', 305737, 18344, 734, '1834', '2016-03-17', '1458193076'),
(393, 'com.sixminute.freeracing', 216821, 13009, 520, '624', '2016-03-17', '1458193076'),
(394, 'com.sega.sonicdash', 267749, 2677, 80, '209', '2016-03-17', '1458193076'),
(395, 'com.sega.cityrush', 496021, 19841, 992, '2381', '2016-03-17', '1458193076'),
(396, 'com.sega.sonic.transformed', 339136, 6783, 68, '109', '2016-03-17', '1458193076'),
(397, 'com.sega.sonic4ep2lite', 234595, 2346, 23, '54', '2016-03-17', '1458193076'),
(398, 'com.sega.sonicjumpfever', 419898, 20995, 420, '504', '2016-03-17', '1458193076'),
(399, 'com.sigames.fmh2016', 132544, 7953, 159, '398', '2016-03-17', '1458193076'),
(400, 'com.sega.twbshogun', 410034, 20502, 615, '1784', '2016-03-17', '1458193076'),
(401, 'com.JuicyBubbles', 489869, 29392, 1470, '3380', '2016-03-18', '1458280981'),
(402, 'com.SpeedDating', 209546, 10477, 419, '796', '2016-03-18', '1458280981'),
(403, 'com.thehotgames.dating_birds', 406568, 20328, 1016, '1423', '2016-03-18', '1458280981'),
(404, 'com.adsk.sketchbookhdexpress', 118432, 4737, 189, '360', '2016-03-18', '1458280981'),
(405, 'com.adsk.sketchbook', 182641, 5479, 55, '71', '2016-03-18', '1458280981'),
(406, 'com.adsk.sketchbookink_gen', 436695, 26202, 262, '655', '2016-03-18', '1458280981'),
(407, 'com.ketchapp.twist', 118090, 3543, 177, '230', '2016-03-18', '1458280981'),
(408, 'com.ketchapp.splash', 264331, 10573, 423, '1269', '2016-03-18', '1458280981'),
(409, 'com.ketchapp.stack', 112915, 4517, 135, '149', '2016-03-18', '1458280981'),
(410, 'com.ketchapp.swing', 301343, 6027, 121, '362', '2016-03-18', '1458280981'),
(411, 'com.ketchapp.hophophop', 467115, 23356, 467, '1028', '2016-03-18', '1458280981'),
(412, 'com.ketchapp.sky', 447730, 22387, 895, '1701', '2016-03-18', '1458280981'),
(413, 'com.ketchapp.zigzaggame', 280688, 11228, 225, '449', '2016-03-18', '1458280981'),
(414, 'com.ketchapp.arrow', 203491, 12209, 366, '513', '2016-03-18', '1458280981'),
(415, 'com.ketchapp.stickhero', 253638, 15218, 152, '304', '2016-03-18', '1458280981'),
(416, 'com.ketchapp.theline2', 268628, 5373, 161, '467', '2016-03-18', '1458280981'),
(417, 'com.ketchapp.jellyjump', 285962, 5719, 114, '206', '2016-03-18', '1458280981'),
(418, 'com.ketchapp.cloudpath', 143139, 5726, 115, '206', '2016-03-18', '1458280981'),
(419, 'com.ketchapp.donttouchthespikes', 277661, 11106, 111, '311', '2016-03-18', '1458280981'),
(420, 'com.ketchapp.qubes', 127026, 7622, 381, '648', '2016-03-18', '1458280981'),
(421, 'com.thehotgames.frozen_blocks', 128735, 6437, 322, '805', '2016-03-18', '1458280981'),
(422, 'com.thehotgames.halloween_ghost', 120288, 6014, 60, '126', '2016-03-18', '1458280981'),
(423, 'com.thehotgame.app.turtle', 139184, 1392, 42, '104', '2016-03-18', '1458280981'),
(424, 'com.outfit7.tomsbubbles', 422925, 21146, 634, '1586', '2016-03-18', '1458280981'),
(425, 'com.outfit7.mytalkingangelafree', 209009, 10450, 418, '920', '2016-03-18', '1458280981'),
(426, 'com.outfit7.tomsjetski', 134936, 8096, 324, '777', '2016-03-18', '1458280981'),
(427, 'com.outfit7.mytalkingtomfree', 238208, 7146, 143, '143', '2016-03-18', '1458280981'),
(428, 'com.outfit7.talkingangelafree', 356323, 21379, 855, '1026', '2016-03-18', '1458280981'),
(429, 'com.outfit7.tomlovesangelafree', 126782, 5071, 254, '710', '2016-03-18', '1458280981'),
(430, 'com.outfit7.tomslovelettersfree', 187085, 5613, 56, '146', '2016-03-18', '1458280981'),
(431, 'com.outfit7.talkinggingerfree', 174731, 5242, 105, '283', '2016-03-18', '1458280981'),
(432, 'com.outfit7.talkingben', 327222, 6544, 262, '497', '2016-03-18', '1458280981'),
(433, 'com.outfit7.talkingnewsfree', 282056, 5641, 113, '259', '2016-03-18', '1458280981'),
(434, 'com.fingersoft.hillclimb', 276733, 2767, 83, '224', '2016-03-18', '1458280981'),
(435, 'com.waybefore.fastlikeafox', 348755, 3488, 140, '153', '2016-03-18', '1458280981'),
(436, 'com.fingersoft.nightvisioncamera', 335620, 16781, 671, '1678', '2016-03-18', '1458280981'),
(437, 'com.fingersoft.benjibananas', 274829, 8245, 165, '462', '2016-03-18', '1458280981'),
(438, 'com.fingersoft.cartooncamera', 403882, 24233, 727, '2036', '2016-03-18', '1458280981'),
(439, 'com.fingersoft.thermalvisioncamera', 360278, 10808, 324, '843', '2016-03-18', '1458280981'),
(440, 'com.fingersoft.failhard', 381519, 11446, 343, '343', '2016-03-18', '1458280981'),
(441, 'com.fingersoft.ihatefish', 105102, 3153, 95, '199', '2016-03-18', '1458280981'),
(442, 'com.fingersoft.motioncamera', 168530, 1685, 51, '142', '2016-03-18', '1458280981'),
(443, 'com.sixminute.freeracing', 209302, 8372, 335, '1005', '2016-03-18', '1458280981'),
(444, 'com.sega.sonicdash', 464917, 13948, 139, '209', '2016-03-18', '1458280981'),
(445, 'com.sega.cityrush', 172876, 3458, 173, '432', '2016-03-18', '1458280981'),
(446, 'com.sega.sonic.transformed', 370679, 11120, 222, '600', '2016-03-18', '1458280981'),
(447, 'com.sega.sonic4ep2lite', 295825, 5917, 59, '130', '2016-03-18', '1458280981'),
(448, 'com.sega.sonicjumpfever', 185815, 9291, 372, '706', '2016-03-18', '1458280981'),
(449, 'com.sigames.fmh2016', 478150, 19126, 956, '1626', '2016-03-18', '1458280981'),
(450, 'com.sega.twbshogun', 210327, 12620, 631, '1641', '2016-03-18', '1458280981');

-- --------------------------------------------------------

--
-- 表的结构 `userlist`
--

CREATE TABLE IF NOT EXISTS `userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `name` varchar(255) DEFAULT '' COMMENT '姓名',
  `business_name` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `passwd` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '' COMMENT '地址',
  `post_code` varchar(255) DEFAULT NULL COMMENT '邮编',
  `city` varchar(255) DEFAULT '' COMMENT '城市',
  `country` varchar(255) DEFAULT '' COMMENT '国家',
  `token` varchar(255) NOT NULL COMMENT '激活码',
  `token_exptime` int(11) NOT NULL COMMENT '激活码过期',
  `balance_temp` double NOT NULL,
  `balance` double NOT NULL COMMENT '初始积分数',
  `last_check` date NOT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态,禁用或正常状态',
  `time` datetime DEFAULT NULL COMMENT '数据日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `userlist`
--

INSERT INTO `userlist` (`id`, `name`, `business_name`, `email`, `passwd`, `address`, `post_code`, `city`, `country`, `token`, `token_exptime`, `balance_temp`, `balance`, `last_check`, `status`, `time`) VALUES
(1, 'hubery', 'hellowd', 'huli_yangthze@126.com', '2016', 'wuhan', '43700', 'wuhan', 'Albania', 'd115e11a90a12deadcad2c0312698ce1', 1456395196, -25.23, 2000, '0000-00-00', 1, '2016-02-25 15:17:17'),
(2, 'hubery', 'hellowd', 'hubery_lee@yeah.net', '2016', 'wuhan', '43700', 'wuhan', 'China', '1d4ef9a8f360b1c22946a5ade5d7f167', 1456469665, 98, 2000, '0000-00-00', 1, '2016-02-25 14:54:25'),
(3, 'hubery', 'hellowd', 'hubery_lee@qq.com', '2016', 'wuhan', '43700', 'wuhan', 'china', '7e31dac6fc4f701f941d49c6d3b895ac', 1456828097, 15, 2000, '0000-00-00', 1, '2016-02-29 18:28:17'),
(4, 'hubery', 'hellowd', 'huli_yangthze@163.com', '2016', 'wuhan', '43700', 'wuhan', 'china', '61cb94dd1b08fccbcc4a343f238b3f96', 1456828157, 204.223, 2000, '0000-00-00', 1, '2016-02-29 18:29:17'),
(5, 'hubery', 'helloworld', 'hubery4@163.com', 'hubery4', 'wuhan', '437000', 'wuhan', 'China', '', 0, -36, 2000, '0000-00-00', 1, '2016-03-14 00:00:00'),
(6, 'hubery6', 'hubery6', 'hubery6@163.com', 'hubery6', 'wuhan', '437000', 'wuhan', 'China', '', 0, -10, 2000, '0000-00-00', 1, '2016-03-14 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `userlisttemp`
--

CREATE TABLE IF NOT EXISTS `userlisttemp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `name` varchar(255) DEFAULT '' COMMENT '姓名',
  `business_name` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `passwd` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '' COMMENT '地址',
  `post_code` varchar(255) DEFAULT NULL COMMENT '邮编',
  `city` varchar(255) DEFAULT '' COMMENT '城市',
  `country` varchar(255) DEFAULT '' COMMENT '国家',
  `token` varchar(255) NOT NULL COMMENT '激活码',
  `token_exptime` int(11) NOT NULL COMMENT '激活码过期',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态,禁用或正常状态',
  `time` datetime DEFAULT NULL COMMENT '数据日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
