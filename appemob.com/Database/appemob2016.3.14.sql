-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-14 10:36:44
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
  `appid` varchar(255) DEFAULT NULL COMMENT 'APP ID',
  `devid` varchar(255) NOT NULL COMMENT '开发者ID',
  `name` varchar(255) DEFAULT NULL COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `title` varchar(255) DEFAULT '' COMMENT '应用标题',
  `subtitle` tinytext COMMENT '应用介绍',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `country` varchar(255) NOT NULL COMMENT '国家',
  `install` varchar(255) DEFAULT NULL COMMENT '应用安装量',
  `size` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `bid` varchar(255) DEFAULT '' COMMENT '竞价大小',
  `status` int(10) DEFAULT NULL COMMENT 'App状态',
  `time` datetime DEFAULT NULL COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `applist`
--

INSERT INTO `applist` (`id`, `appid`, `devid`, `name`, `img`, `title`, `subtitle`, `sort`, `country`, `install`, `size`, `os`, `os_version`, `bid`, `status`, `time`) VALUES
(1, 'com.JuicyBubbles', 'thehotgames', 'Juicy Bubbles', '', 'Hippo', '适合所有人', 'Puzzle', 'China', '1000', '36M', 'android', '4.0 and up', '', 1, '2016-03-01 16:00:05'),
(2, 'com.SpeedDating', 'thehotgames', 'Speed Dating', '', 'Hippo', ' 适合所有人', '益智', 'China', '1000', '30M', 'android', '4.0 and up', '', 1, '2016-03-01 16:00:10'),
(3, 'com.thehotgames.dating_birds', 'thehotgames', 'Dating Birds', '', 'Dating Birds', 'Dating birds is a lovely and challenging puzzle game.The goal is moving obstacle blocks between birds and make them succeed in dating.In every level,moving times is limited.You need to get birds near in setting moves.As level up,it is harder to complete t', 'Puzzle', 'China', '500 - 1,000', '2.1M', 'android', '4.0 and up', '1', 1, '2016-03-01 16:00:17'),
(4, 'com.adsk.sketchbookhdexpress', '6418760394979464117', 'Express', '', 'Media & Video ', 'Autodesk SketchBook Express for Tablets is a professional-grade paint and drawing application designed for android devices with screen sizes of 4" and above. SketchBook Express offers a dedicated set of sketching tools and delivers them through a streamli', 'Creativity', 'San Rafael, California 94903', '10000000', '11M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(5, 'com.adsk.sketchbook', '6418760394979464117', 'draw and paint', '', 'Entertainment', 'Autodesk® SketchBook® is an intuitive painting and drawing application designed for people of all skill levels, who love to draw. We reimagined the paint engine, so SketchBook delivers more fluid pencils and natural painting than ever before, all while ', 'Entertainment', 'US', '10000000', '47M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(6, 'com.adsk.sketchbookink_gen', '6418760394979464117', 'Ink', '', 'Ink', 'Draw perfect, resolution-independent lines with SketchBook® Ink. This easy-to-use pen & ink drawing app enables you create amazing line art and export high-resolution images directly from your tablet (7” or larger).', 'Entertainment', 'US', '50000', '9.6M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(7, 'com.ketchapp.twist', '6054197513203380012', 'Twist', '', 'Twist', 'Stay on the platforms and do as many jumps as you can.\nJust tap the screen to jump and twist the platforms. Try not to fall off the edges!\n\nCollect gems to unlock new balls and platform colors.\n\nWhat is your best score ?', 'Arcade', ' France', '10,000,000 - 50,000,000', '27M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(8, 'com.ketchapp.splash', '6054197513203380012', 'Splash', '', 'Splash', 'Splash is the new game from the creator of ZigZag and Twist.\r\nJump on the colored cubes to blow them up, and make as many beautiful Splashes of ink on the ground as you can!\r\n\r\nJust tap the screen to make the ball move down and hit the cubes.\r\n\r\nCollect g', 'Arcade', 'France', '500,000 - 1,000,000', '25M', 'android', '3.0 and up', '', 1, '2016-03-14 00:00:00'),
(9, 'com.ketchapp.stack', '6054197513203380012', 'Stack', '', 'Stack', 'Stack up the blocks as high as you can!', 'Arcade', 'France', '5,000,000 - 10,000,000', '25M', 'android', '3.0 and up', '', 1, '2016-03-14 08:00:00'),
(10, 'com.ketchapp.swing', '6054197513203380012', '浪荡天涯', '', 'Swing', 'Swing from platform to platform. Simply tap the screen when the rope is long enough to reach the next platform. How long can you survive?\r\nCollect gems and unlock cool new characters.', 'Arcade', 'France', '1,000,000 - 5,000,000', '27M', 'android', '3.0 and up', '', 1, '2016-03-14 08:22:00'),
(11, 'com.ketchapp.hophophop', '6054197513203380012', '下蹿上跳', '', 'Hop Hop Hop', 'Jump into the hoops and avoid the spikes. Collect mushrooms to unlock all the funny characters!\r\nHow far can you go?\r\n\r\n→ Eat a mushroom to get 1 point\r\n→ Jump into the hoop from above to get 2 points\r\n→ You have enough skills to do it from below? G', 'Arcade', 'France', '1,000,000 - 5,000,000', '18M', 'android', '3.0 and up', '', 1, '2016-03-14 13:00:00'),
(12, 'com.ketchapp.sky', '6054197513203380012', '天阶', '', 'Sky', 'Fly, Jump and Clone yourself into a fantastic adventure with SKY.\r\nIn this new game developed by the same team behind Phases and The Line Zen, you''re in control of multiple characters as they run through a 3D mystical world filled with trouble.', 'Arcade', 'France', '1,000,000 - 5,000,000', '10M', 'android', '2.3.3 and up', '', 1, '2016-03-14 07:00:00'),
(13, 'com.ketchapp.zigzaggame', '6054197513203380012', 'ZigZag', '', 'ZigZag', 'Stay on the wall and do as many zigzags as you can!\r\nJust tap the screen to change the direction of the ball. Try not to fall off the edges!\r\n\r\nHow far can you go?', 'Arcade', 'France', '10,000,000 - 50,000,000', '21M', 'android', '2.3 and up', '', 1, '2016-03-14 07:00:00'),
(14, 'com.ketchapp.arrow', '6054197513203380012', 'Arrow', '', 'Arrow', 'Move through the maze without hitting the walls. Collect points to grow your tail. Smash gems to unlock cool new arrow heads and backgrounds!', 'Arcade', 'France', '1,000,000 - 5,000,000', '19M', 'android', '4.1 and up', '', 1, '2016-03-14 08:00:00'),
(15, 'com.ketchapp.stickhero', '6054197513203380012', '英雄难过棍子关', '', 'Stick Hero', 'Stretch the stick in order to reach and walk on the platforms. Watch out! If the stick is not long enough, you will fall down!\r\nHow far can you go?', 'Arcade', ' France', '10,000,000 - 50,000,000', '14M', 'android', '2.3 and up', '', 1, '2016-03-14 09:00:00'),
(16, 'com.ketchapp.theline2', '6054197513203380012', 'The Line Zen', '', 'The Line Zen', 'Welcome to The Line Zen.\r\nThe Line Zen is the sequel to 2014''s hit game, The Line, but now with a new twist. You still dart and weave through a procedurally generated world while avoiding the red shapes, but now you use friendly green shapes to your advan', 'Arcade', 'France', '1,000,000 - 5,000,000', '7.5M', 'android', '2.3.3 and up', '', 1, '2016-03-14 06:00:00'),
(17, 'com.ketchapp.jellyjump', '6054197513203380012', 'Jelly Jump', '', 'Jelly Jump', 'Little jellies need you more than ever before! They keep drowning over and over again. Only you can keep them safe...\r\nJump higher, survive longer and never give up!', 'Arcade', 'France', '10,000,000 - 50,000,000', '30M', 'android', '2.3 and up', '', 1, '2016-03-14 07:00:00'),
(18, 'com.ketchapp.cloudpath', '6054197513203380012', 'Cloud Path', '', 'Cloud Path', 'Walk on the path as fast as you can, and earn one point for each step you do. Collect gems and unlock new characters!', 'Arcade', 'France', '500,000 - 1,000,000', '23M', 'android', '2.2 and up', '', 1, '2016-03-14 06:00:00'),
(19, 'com.ketchapp.donttouchthespikes', '6054197513203380012', 'Don''t Touch The Spikes', '', 'Don''t Touch The Spikes', 'Make the little bird fly! Don''t touch the spikes!\r\nHow far can you make it?', 'Arcade', 'France', '10,000,000 - 50,000,000', '15M', 'android', '2.3 and up', '', 1, '2016-03-14 05:00:00'),
(20, 'com.ketchapp.qubes', '6054197513203380012', '圆方快跑', '', 'Qubes', 'Tap to change the direction of the bouncing ball. Collect coins and unlock new balls.\r\nHow long can you survive on the qubes?\r\n\r\nHow to play:\r\nTap anywhere on the screen to change the direction of the ball.', 'Arcade', 'France', '100,000 - 500,000', '26M', 'android', '3.0 and up', '', 1, '2016-03-14 00:00:00'),
(21, 'com.thehotgames.frozen_blocks', 'thehotgames', 'Frozen Blocks: Magic', '', 'Frozen Blocks: Magic', 'Frozen Blocks: Magic is a unique and creative physics based game. Stack all provided frozen blocks to keep them in a good balance. Be careful not to let them fall off the screen,or you''ll have to start again. You can unlock new challenging theme levels wh', 'Puzzle', 'China', '500 - 1,000', '2.6M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(22, 'com.thehotgames.halloween_ghost', 'thehotgames', 'Halloween Ghost', '', 'Halloween Ghost', 'Experience the fun of Halloween,a mysterious shaman in the procurement Halloween gift when it came to a group of ghost. The story began ...', 'Adventure', 'China', '1,000 - 5,000', '2.8M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(23, 'com.thehotgame.app.turtle', 'thehotgames', 'The Rolling Turtle', '', 'The Rolling Turtle', 'The Rolling Turtle like ants on a hot pan, only to reach the end you are the most secure. Game, players by turning the dial to scroll to get control of the turtle four stars. Turntable inside organs unpredictable, can you help the turtle successfully reac', 'Strategy', 'China', '50 - 100', '2.6M', 'android', '2.3.3 and up', '', 1, '2016-03-14 00:00:00'),
(24, 'com.outfit7.tomsbubbles', '5950758182267281572', '汤姆猫泡泡射手', '', 'Talking Tom Bubble Shooter', 'Play the exciting action-packed bubble shooter – your next favorite game from Talking Tom. Challenge your friends or play on your own as you level up and unlock Tom’s friends.\r\nDiscover new features for some seriously thrilling adventures. Crush bosse', 'Casual', 'United States', '10,000,000 - 50,000,000', NULL, 'android', '4.1 and up', '', 1, '2016-03-14 00:00:00'),
(25, 'com.outfit7.mytalkingangelafree', '5950758182267281572', '我的安吉拉', '', 'My Talking Angela', 'Explore Talking Angela’s world and customise her fashion, hairstyle, makeup and home - all while playing addictively cute mini games.\r\nWith over 165 million downloads already… don’t miss out on the fun!', 'Casual', 'United States', '100,000,000 - 500,000,000', '77M', 'android', '4.1 and up', '', 1, '2016-03-14 00:00:00'),
(26, 'com.outfit7.tomsjetski', '5950758182267281572', 'Talking Tom Jetski', '', 'Talking Tom Jetski', 'Jump on the water scooter with TALKING TOM or TALKING ANGELA and experience the most exhilarating water action out there - dashing through cool missions and daring challenges on the ride of your life.', 'Casual', 'United States', '10,000,000 - 50,000,000', NULL, 'android', '4.0.3 and up', '', 1, '2016-03-14 00:00:00'),
(27, 'com.outfit7.mytalkingtomfree', '5950758182267281572', 'My Talking Tom', '', 'My Talking Tom', 'Discover the #1 games app in 135 countries! Adopt your very own baby kitten and help him grow into a fully grown cat. Take good care of your virtual pet, name him and make him part of your daily life by feeding him, playing with him and nurturing him as h', 'Casual', 'United States', '100,000,000 - 500,000,000', '61M', 'android', '4.1 and up', '', 1, '2016-03-14 00:00:00'),
(28, 'com.outfit7.talkingangelafree', '5950758182267281572', 'Talking Angela', '', 'Talking Angela', 'Come join Talking Angela in Paris - the city of love, style and magic. There are so many surprises, you better sit down. ;) Enjoy amazing gifts, pick the latest styles, and sip magical cocktails to experience special moments. And watch out for birds - you', 'Entertainment', 'United States', '50,000,000 - 100,000,000', '45M', 'android', '4.1 and up', '', 1, '2016-03-14 00:00:00'),
(29, 'com.outfit7.tomlovesangelafree', '5950758182267281572', 'Tom Loves Angela', '', 'Tom Loves Angela', 'Talking Tom has climbed all the way up to the rooftop to get a glimpse of Angela. Tom will repeat what you say to Angela so help him woo her by singing a song, having a chat using the innovative “intelligent” chat function and by giving her gifts!\r\nBu', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', '4.0.3 and up', '', 1, '2016-03-14 00:00:00'),
(30, 'com.outfit7.tomslovelettersfree', '5950758182267281572', 'Tom''s Love Letters', '', 'Tom''s Love Letters', 'Download the cutest love app ever and show that special person how you feel about them.\r\nTalking Tom and Talking Angela are at hand to help you express your feelings. Just like Cupid, your furry friends will help you share your feelings, whether it’s wi', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', '2.3 and up', '', 1, '2016-03-14 00:00:00'),
(31, 'com.outfit7.talkinggingerfree', '5950758182267281572', 'Talking Ginger', '', 'Talking Ginger', 'Little Talking Ginger needs your help! Help him get ready for bed and have fun along the way!\r\nGinger provides the best company - talk to him, tickle him and play games with him. You can even see what he’s dreaming about at night!', 'Entertainment', 'United States', '100,000,000 - 500,000,000', NULL, 'android', '4.0.3 and up', '', 1, '2016-03-14 00:00:00'),
(32, 'com.outfit7.talkingben', '5950758182267281572', 'Talking Ben the Dog', '', 'Talking Ben the Dog', 'Ben is a retired chemistry professor who likes his quiet comfortable life of eating, drinking and reading newspapers. To make him responsive, you will have to bother him long enough that he will fold his newspaper. Then you can talk to him, poke or tickle', 'Entertainment', 'United States', '50,000,000 - 100,000,000', '50M', 'android', '4.0.3 and up', '', 1, '2016-03-14 00:00:00'),
(33, 'com.outfit7.talkingnewsfree', '5950758182267281572', 'Talking Tom & Ben News', '', 'Talking Tom & Ben News', 'Breaking news - Talking Tom and Talking Ben are even chattier and more entertaining as TV news anchors!\r\nJoin them in their TV studio, talk to them and watch them take it in turns to repeat what you say. Poke or swipe the screen and have them fall off the', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', '4.0.3 and up', '', 1, '2016-03-14 00:00:00'),
(34, 'com.fingersoft.hillclimb', 'Fingersoft', 'Hill Climb Racing', '', 'Hill Climb Racing', 'One of the most addictive and entertaining physics based driving game ever made! And it''s free!\r\nMeet Newton Bill, the young aspiring uphill racer. He is about to embark on a journey that takes him to where no ride has ever been before. With little respec', 'Racing', 'Finland', '100,000,000 - 500,000,000', NULL, 'android', '', '', 1, '2016-03-14 00:00:00'),
(35, 'com.waybefore.fastlikeafox', 'Fingersoft', 'Fast like a Fox', '', 'Fast like a Fox', 'One of the most fun and fastest platformers ever created with unique tap control! Play now for free!\nFast like a Fox uses your device’s internal sensors to detect movement. Learn the tapping technique to have the best precision.', 'Adventure', 'Finland', '1,000,000 - 5,000,000', '54M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(36, 'com.fingersoft.nightvisioncamera', 'Fingersoft', 'Night Vision Camera', '', 'Night Vision Camera', 'This application maximizes your device camera in the dark! Automatic adjustment of image parts to improve visibility in low light conditions.\r\nWe have just released Hill Climb Racing, it''s one of the most entertaining and addictive FREE driving game made ', 'Photography', 'Finland', '10,000,000 - 50,000,000', '379k', 'android', '2.2 and up', '', 1, '2016-03-14 00:00:00'),
(37, 'com.fingersoft.benjibananas', 'Fingersoft', 'Benji Bananas', '', 'Benji Bananas', 'The best action adventure game on your Android! And it''s free!\r\n\r\nExciting and fun physics based adventure game!\r\n\r\nFly from vine to vine, but watch out for dangers lurking in the jungle. Earn bananas to get upgrades, specials and power ups.\r\n\r\nFeatures:\r', 'Adventure', 'Finland', '50,000,000 - 100,000,000', '25M', 'android', '3.0 and up', '', 1, '2016-03-14 00:00:00'),
(38, 'com.fingersoft.cartooncamera', 'Fingersoft', 'Cartoon Camera', '', 'Cartoon Camera', 'One of the coolest free Android camera apps ever created!\r\nCreate cartoon and sketch like photography with your camera.\r\n\r\nWe have just released Hill Climb Racing, it''s one of the most entertaining and addictive FREE driving game made for android!', 'Photography', 'Finland', '10,000,000 - 50,000,000', '1.0M', 'android', '2.2 and up', '', 1, '2016-03-14 00:00:00'),
(39, 'com.fingersoft.thermalvisioncamera', 'Fingersoft', 'Thermal Camera', '', 'Thermal Camera', 'The best Thermal Camera application for Android is finally here!\r\nLike us on Facebook and stay tuned for all new cool releases and updates:', 'Photography', 'Finland', '5,000,000 - 10,000,000', '521k', 'android', '2.2 and up', '', 1, '2016-03-14 00:00:00'),
(40, 'com.fingersoft.failhard', 'Fingersoft', 'Fail Hard', '', 'Fail Hard', 'We bring you extremely fun physics based stunt game on Android!\r\n* Experience the evolution of becoming the greatest stuntman in the world.\r\n* Make it big in the stunt show business and don''t back down even from \r\nthe most dangerous of stunts and jumps.\r\n', 'Action', 'Finland', '10,000,000 - 50,000,000', '58M', 'android', '4.0.3 and up', '', 1, '2016-03-14 00:00:00'),
(41, 'com.fingersoft.ihatefish', 'Fingersoft', 'I Hate Fish', '', 'I Hate Fish', 'Shoot your way to the top of the food chain and guide Earl the worm through perilous waters filled with enemies to the safety of your homeboat.\r\n- MANEUVER and SHOOT your way through the schools of angry fish.\r\n- UPGRADE your weapons to match the growing ', 'Action', 'Finland', '1,000,000 - 5,000,000', '47M', 'android', '2.3 and up', '', 1, '2016-03-14 00:00:00'),
(42, 'com.fingersoft.motioncamera', 'Fingersoft', 'Motion Camera', '', 'Motion Camera', 'Create cool and unique photos with motion in them. Motion Camera blurs movement of objects into to your photos. Cars, people, you name it.\r\nCheck out our latest free game: Hill Climb Racing. It''s a fun and addictive driving game where you reach further di', 'Photography', 'Finland', '1,000,000 - 5,000,000', '252k', 'android', '2.2 and up', '', 1, '2016-03-14 00:00:00'),
(43, 'com.sixminute.freeracing', 'Fingersoft', 'FRZ: Free Racing Zero', '', 'FRZ: Free Racing Zero', 'FRZ: Free Racing Zero! Steer your way to victory against the competition in this comic style retro racer!\r\nFRZ: Free Racing Zero brings high-paced retro racing back to the world. It''s time to burn rubber, drift and steer your way to the finish line in thi', 'Racing', 'Finland', '100,000 - 500,000', NULL, 'android', '2.3 and up', '', 1, '2016-03-14 00:00:00'),
(44, 'com.sega.sonicdash', '7891990035506213180', 'Sonic Dash', '', 'Sonic Dash', 'For mobile and tablet.\r\nHow far can the world’s fastest hedgehog run?\r\n\r\nPlay as Sonic the Hedgehog as you dash, jump and spin your way across stunning 3D environments. Swipe your way over and under challenging obstacles in this fast and frenzied endles', 'Arcade', 'United States', '50,000,000 - 100,000,000', '64M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(45, 'com.sega.cityrush', '7891990035506213180', 'Crazy Taxi™ City Rush', '', 'Crazy Taxi™ City Rush', 'Drive crazy in SEGA’s all-new car racing game Crazy Taxi. Race through the city in your car to deliver your passengers on-time -- the crazier you drive the higher your rewards! Your car, your rules - speed, drift, whip around corners, weave through traf', 'Action', 'United States', '5,000,000 - 10,000,000', '79M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(46, 'com.sega.sonic.transformed', '7891990035506213180', 'Sonic Racing Transformed', '', 'Sonic Racing Transformed', 'Sonic & All Star Racing Transformed is now FREE! If you previously bought the game you still have the VIP Pass for FREE.\r\nIt’s Not Just Racing… it’s Racing Transformed!\r\n\r\nRace as Sonic and a host of legendary All-Stars and prepare to transform! Spe', 'Racing', 'United States', '10,000,000 - 50,000,000', NULL, 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(47, 'com.sega.sonic4ep2lite', '7891990035506213180', 'Sonic 4 Episode II LITE', '', 'Sonic 4 Episode II LITE', 'Take Sonic and Tails for a spin in this Lite version of Sonic The Hedgehog™ 4 Episode II!\r\nThe Sonic 4 Saga continues in Episode II with the return of a beloved side kick and fan-favorite villains!', 'Arcade', 'United States', '10,000,000 - 50,000,000', '195M', 'android', '2.3 and up', '', 1, '2016-03-14 00:00:00'),
(48, 'com.sega.sonicjumpfever', '7891990035506213180', 'Sonic Jump Fever', '', 'Sonic Jump Fever', 'Catch the FEVER in an explosive race against the clock! Compete with Sonic and friends in high-speed bursts of vertical jumping mayhem. FREE and based on SEGA’s hit Sonic Jump.\r\nProve you are the best. Rack up huge combos to blast past your friends’ h', 'Action', 'United States', '10,000,000 - 50,000,000', '35M', 'android', '4.0 and up', '', 1, '2016-03-14 00:00:00'),
(49, 'com.sigames.fmh2016', '7891990035506213180', 'Football Manager Mobile 2016', '', 'Football Manager Mobile 2016', 'Football Manager Mobile 2016 is designed to be played on the move and is the quickest way to manage your favourite club to glory with a focus on tactics and transfers.\r\nTake charge of clubs from 14 countries across the world, including all the big Europea', 'Sports', 'United States', '100,000 - 500,000', NULL, 'android', '2.3.3 and up', '', 1, '2016-03-14 00:00:00'),
(50, 'com.sega.twbshogun', '7891990035506213180', 'Total War Battles', '', 'Total War Battles', 'BUILD, BATTLE AND AVENGE!\r\nSpecifically developed for touchscreen platforms, Total War Battles™: SHOGUN is a new real-time strategy game from the makers of the award-winning Total War series. \r\nTotal War Battles™ delivers quick-fire, tactical combat b', 'Arcade', 'United States', '50,000 - 100,000', '273M', 'android', '2.3.3 and up', '', 1, '2016-03-14 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `applisttemp`
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
-- 表的结构 `cpilist`
--

CREATE TABLE IF NOT EXISTS `cpilist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `country` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '国家或地区',
  `code` varchar(255) NOT NULL COMMENT '国家简称',
  `cpi` varchar(10) NOT NULL COMMENT 'CPI调价',
  `phone_code` varchar(100) NOT NULL,
  `time_diff` int(11) NOT NULL COMMENT '时差',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- 转存表中的数据 `cpilist`
--

INSERT INTO `cpilist` (`id`, `country`, `name`, `code`, `cpi`, `phone_code`, `time_diff`) VALUES
(1, 'Angola', '安哥拉', 'AO', '1.1', '244', -7),
(2, 'Afghanistan', '阿富汗', 'AF', '', '93', 0),
(3, 'Albania', '阿尔巴尼亚', 'AL', '1.2', '355', -7),
(4, 'Algeria', '阿尔及利亚', 'DZ', '', '213', -8),
(5, 'Andorra', '安道尔共和国', 'AD', '', '376', -8),
(6, 'Anguilla', '安圭拉岛', 'AI', '', '1264', -12),
(7, 'Antigua and Barbuda', '安提瓜和巴布达', 'AG', '', '1268', -12),
(8, 'Argentina', '阿根廷', 'AR', '', '54', -11),
(9, 'Armenia', '亚美尼亚', 'AM', '1.1', '374', -6),
(10, 'Ascension', '阿森松', ' ', '', '247', -8),
(11, 'Australia', '澳大利亚', 'AU', '', '61', 2),
(12, 'Austria', '奥地利', 'AT', '1.2', '43', -7),
(13, 'Azerbaijan', '阿塞拜疆', 'AZ', '', '994', -5),
(14, 'Bahamas', '巴哈马', 'BS', '', '1242', -13),
(15, 'Bahrain', '巴林', 'BH', '', '973', -5),
(16, 'Bangladesh', '孟加拉国', 'BD', '', '880', -2),
(17, 'Barbados', '巴巴多斯', 'BB', '1.1', '1246', -12),
(18, 'Belarus', '白俄罗斯', 'BY', '', '375', -6),
(19, 'Belgium', '比利时', 'BE', '', '32', -7),
(20, 'Belize', '伯利兹', 'BZ', '', '501', -14),
(21, 'Benin', '贝宁', 'BJ', '1.2', '229', -7),
(22, 'Bermuda \nIs.', '百慕大群岛', 'BM', '', '1441', -12),
(23, 'Bolivia', '玻利维亚', 'BO', '', '591', -12),
(24, 'Botswana', '博茨瓦纳', 'BW', '', '267', -6),
(25, 'Brazil', '巴西', 'BR', '1.1', '55', -11),
(26, 'Brunei', '文莱', 'BN', '', '673', 0),
(27, 'Bulgaria', '保加利亚', 'BG', '', '359', -6),
(28, 'Burkina-faso', '布基纳法索', 'BF', '', '226', -8),
(29, 'Burma', '缅甸', 'MM', '', '95', -1),
(30, 'Burundi', '布隆迪', 'BI', '1.2', '257', -6),
(31, 'Cameroon', '喀麦隆', 'CM', '', '237', -7),
(32, 'Canada', '加拿大', 'CA', '', '1', -13),
(33, 'Cayman Is.', '开曼群岛', ' ', '0', '1345', -13),
(34, 'Central African Republic', '中非共和国', 'CF', '', '236', -7),
(35, 'Chad', '乍得', 'TD', '', '235', -7),
(36, 'Chile', '智利', 'CL', '', '56', -13),
(37, 'China', '中国', 'CN', '', '86', 0),
(38, 'Colombia', '哥伦比亚', 'CO', '1.2', '57', 0),
(39, 'Congo', '刚果', 'CG', '', '242', -7),
(40, 'Cook Is.', '库克群岛', 'CK', '', '682', -18),
(41, 'Costa Rica', '哥斯达黎加', 'CR', '0', '506', -14),
(42, 'Cuba', '古巴', 'CU', '', '53', -13),
(43, 'Cyprus', '塞浦路斯', 'CY', '', '357', -6),
(44, 'Czech Republic ', '捷克', 'CZ', '', '420', -7),
(45, 'Denmark', '丹麦', 'DK', '', '45', -7),
(46, 'Djibouti', '吉布提', 'DJ', '1.2', '253', -5),
(47, 'Dominica \n                      Rep.', '多米尼加共和国', 'DO', '', '1890', -13),
(48, 'Ecuador', '厄瓜多尔', 'EC', '0', '593', -13),
(49, 'Egypt', '埃及', 'EG', '', '20', -6),
(50, 'EI \nSalvador', '萨尔瓦多', 'SV', '', '503', -14),
(51, 'Estonia', '爱沙尼亚', 'EE', '', '372', -5),
(52, 'Ethiopia', '埃塞俄比亚', 'ET', '', '251', -5),
(53, 'Fiji', '斐济', 'FJ', '', '679', 4),
(54, 'Finland', '芬兰', 'FI', '1.2', '358', -6),
(55, 'France', '法国', 'FR', '', '33', -8),
(56, 'French \n                      Guiana', '法属圭亚那', 'GF', '0', '594', -12),
(57, 'Gabon', '加蓬', 'GA', '', '241', -7),
(58, 'Gambia', '冈比亚', 'GM', '', '220', -8),
(59, 'Georgia ', '格鲁吉亚', 'GE', '', '995', 0),
(60, 'Germany ', '德国', 'DE', '', '49', -7),
(61, 'Ghana', '加纳', 'GH', '', '233', -8),
(62, 'Gibraltar', '直布罗陀', 'GI', '', '350', -8),
(63, 'Greece', '希腊', 'GR', '0', '30', -6),
(64, 'Grenada', '格林纳达', 'GD', '0', '1809', -14),
(65, 'Guam', '关岛', 'GU', '', '1671', 2),
(66, 'Guatemala', '危地马拉', 'GT', '', '502', -14),
(67, 'Guinea', '几内亚', 'GN', '', '224', -8),
(68, 'Guyana', '圭亚那', 'GY', '', '592', -11),
(69, 'Haiti', '海地', 'HT', '', '509', -13),
(70, 'Honduras', '洪都拉斯', 'HN', '', '504', -14),
(71, 'Hongkong', '香港', 'HK', '0', '852', 0),
(72, 'Hungary', '匈牙利', 'HU', '0', '36', -7),
(73, 'Iceland', '冰岛', 'IS', '', '354', -9),
(74, 'India', '印度', 'IN', '', '91', -2),
(75, 'Indonesia', '印度尼西亚', 'ID', '', '62', 0),
(76, 'Iran', '伊朗', 'IR', '', '98', -4),
(77, 'Iraq', '伊拉克', 'IQ', '', '964', -5),
(78, 'Ireland', '爱尔兰', 'IE', '', '353', -4),
(79, 'Israel', '以色列', 'IL', '0', '972', -6),
(80, 'Italy', '意大利', 'IT', '0', '39', -7),
(81, 'Ivory \nCoast', '科特迪瓦', ' ', '', '225', -6),
(82, 'Jamaica', '牙买加', 'JM', '', '1876', -12),
(83, 'Japan', '日本', 'JP', '', '81', 1),
(84, 'Jordan', '约旦', 'JO', '', '962', -6),
(85, 'Kampuchea (Cambodia )', '柬埔寨', 'KH', '', '855', -1),
(86, 'Kazakstan', '哈萨克斯坦', 'KZ', '', '327', -5),
(87, 'Kenya', '肯尼亚', 'KE', '0', '254', -5),
(88, 'Korea', '韩国', 'KR', '0', '82', 1),
(89, 'Kuwait', '科威特', 'KW', '', '965', -5),
(90, 'Kyrgyzstan ', '吉尔吉斯坦', 'KG', '', '331', -5),
(91, 'Laos', '老挝', 'LA', '', '856', -1),
(92, 'Latvia ', '拉脱维亚', 'LV', '', '371', -5),
(93, 'Lebanon', '黎巴嫩', 'LB', '', '961', -6),
(94, 'Lesotho', '莱索托', 'LS', '', '266', -6),
(95, 'Liberia', '利比里亚', 'LR', '0', '231', -8),
(96, 'Libya', '利比亚', 'LY', '', '218', -6),
(97, 'Liechtenstein', '列支敦士登', 'LI', '', '423', -7),
(98, 'Lithuania', '立陶宛', 'LT', '', '370', -5),
(99, 'Luxembourg', '卢森堡', 'LU', '', '352', -7),
(100, 'Macao', '澳门', 'MO', '', '853', 0),
(101, 'Madagascar', '马达加斯加', 'MG', '', '261', -5),
(102, 'Malawi', '马拉维', 'MW', '', '265', -6),
(103, 'Malaysia', '马来西亚', 'MY', '0', '60', 0),
(104, 'Maldives', '马尔代夫', 'MV', '', '960', -7),
(105, 'Mali', '马里', 'ML', '', '223', -8),
(106, 'Malta', '马耳他', 'MT', '', '356', -7),
(107, 'Mariana Is', '马里亚那群岛', ' ', '', '1670', 1),
(108, 'Martinique', '马提尼克', ' ', '', '596', -12),
(109, 'Mauritius', '毛里求斯', 'MU', '', '230', -4),
(110, 'Mexico', '墨西哥', 'MX', '0', '52', -15),
(111, 'Moldova, Republic of ', '摩尔多瓦', 'MD', '0', '373', -5),
(112, 'Monaco', '摩纳哥', 'MC', '', '377', -7),
(113, 'Mongolia ', '蒙古', 'MN', '', '976', 0),
(114, 'Montserrat \n                      Is', '蒙特塞拉特岛', 'MS', '', '1664', -12),
(115, 'Morocco', '摩洛哥', 'MA', '', '212', -6),
(116, 'Mozambique', '莫桑比克', 'MZ', '', '258', -6),
(117, 'Namibia ', '纳米比亚', 'NA', '', '264', -7),
(118, 'Nauru', '瑙鲁', 'NR', '', '674', 4),
(119, 'Nepal', '尼泊尔', 'NP', '0', '977', -2),
(120, 'Netheriands Antilles', '荷属安的列斯', ' ', '0', '599', -12),
(121, 'Netherlands', '荷兰', 'NL', '', '31', -7),
(122, 'New \nZealand', '新西兰', 'NZ', '', '64', 4),
(123, 'Nicaragua', '尼加拉瓜', 'NI', '', '505', -14),
(124, 'Niger', '尼日尔', 'NE', '', '227', -8),
(125, 'Nigeria', '尼日利亚', 'NG', '', '234', -7),
(126, 'North Korea', '朝鲜', 'KP', '', '850', 1),
(127, 'Norway', '挪威', 'NO', '', '47', -7),
(128, 'Oman', '阿曼', 'OM', '1.3', '968', -4),
(129, 'Pakistan', '巴基斯坦', 'PK', '', '92', -2),
(130, 'Panama', '巴拿马', 'PA', '', '507', -13),
(131, 'Papua New Cuinea', '巴布亚新几内亚', 'PG', '', '675', 2),
(132, 'Paraguay', '巴拉圭', 'PY', '', '595', -12),
(133, 'Peru', '秘鲁', 'PE', '', '51', -13),
(134, 'Philippines', '菲律宾', 'PH', '', '63', 0),
(135, 'Poland', '波兰', 'PL', '', '48', -7),
(136, 'French Polynesia', '法属玻利尼西亚', 'PF', '1.3', '689', 3),
(137, 'Portugal', '葡萄牙', 'PT', '', '351', -8),
(138, 'Puerto \nRico', '波多黎各', 'PR', '', '1787', -12),
(139, 'Qatar', '卡塔尔', 'QA', '', '974', -5),
(140, 'Reunion', '留尼旺', ' ', '', '262', -4),
(141, 'Romania', '罗马尼亚', 'RO', '', '40', -6),
(142, 'Russia', '俄罗斯', 'RU', '', '7', -5),
(143, 'Saint Lueia', '圣卢西亚', 'LC', '', '1758', -12),
(144, 'Saint Vincent', '圣文森特岛', 'VC', '', '1784', -12),
(145, 'Samoa \n                      Eastern', '东萨摩亚(美)', ' ', '', '684', -19),
(146, 'Samoa \n                      Western', '西萨摩亚', ' ', '', '685', -19),
(147, 'San Marino', '圣马力诺', 'SM', '', '378', -7),
(148, 'Sao Tome and Principe', '圣多美和普林西比', 'ST', '', '239', -8),
(149, 'Saudi \n                      Arabia', '沙特阿拉伯', 'SA', '', '966', -5),
(150, 'Senegal', '塞内加尔', 'SN', '', '221', -8),
(151, 'Seychelles', '塞舌尔', 'SC', '', '248', -4),
(152, 'Sierra \n                      Leone', '塞拉利昂', 'SL', '', '232', -8),
(153, 'Singapore', '新加坡', 'SG', '', '65', 0),
(154, 'Slovakia', '斯洛伐克', 'SK', '', '421', -7),
(155, 'Slovenia', '斯洛文尼亚', 'SI', '', '386', -7),
(156, 'Solomon Is', '所罗门群岛', 'SB', '', '677', 3),
(157, 'Somali', '索马里', 'SO', '', '252', -5),
(158, 'South Africa', '南非', 'ZA', '', '27', -6),
(159, 'Spain', '西班牙', 'ES', '', '34', -8),
(160, 'Sri Lanka', '斯里兰卡', 'LK', '', '94', 0),
(161, 'St.Lucia', '圣卢西亚', 'LC', '', '1758', -12),
(162, 'St.Vincent', '圣文森特', 'VC', '', '1784', -12),
(163, 'Sudan', '苏丹', 'SD', '', '249', -6),
(164, 'Suriname', '苏里南', 'SR', '', '597', -11),
(165, 'Swaziland', '斯威士兰', 'SZ', '', '268', -6),
(166, 'Sweden', '瑞典', 'SE', '', '46', -7),
(167, 'Switzerland', '瑞士', 'CH', '', '41', -7),
(168, 'Syria', '叙利亚', 'SY', '', '963', -6),
(169, 'Taiwan', '台湾省', 'TW', '', '886', 0),
(170, 'Tajikstan', '塔吉克斯坦', 'TJ', '', '992', -5),
(171, 'Tanzania', '坦桑尼亚', 'TZ', '', '255', -5),
(172, 'Thailand', '泰国', 'TH', '', '66', -1),
(173, 'Togo', '多哥', 'TG', '', '228', -8),
(174, 'Tonga', '汤加', 'TO', '', '676', 4),
(175, 'Trinidad and Tobago', '特立尼达和多巴哥', 'TT', '', '1809', -12),
(176, 'Tunisia', '突尼斯', 'TN', '', '216', -7),
(177, 'Turkey', '土耳其', 'TR', '', '90', -6),
(178, 'Turkmenistan ', '土库曼斯坦', 'TM', '', '993', -5),
(179, 'Uganda', '乌干达', 'UG', '', '256', -5),
(180, 'Ukraine', '乌克兰', 'UA', '', '380', -5),
(181, 'United Arab Emirates', '阿拉伯联合酋长国', 'AE', '', '971', -4),
(182, 'United Kiongdom', '英国', 'GB', '', '44', -8),
(183, 'United States of America', '美国', 'US', '', '1', -13),
(184, 'Uruguay', '乌拉圭', 'UY', '', '598', -10),
(185, 'Uzbekistan', '乌兹别克斯坦', 'UZ', '', '233', -5),
(186, 'Venezuela', '委内瑞拉', 'VE', '', '58', -12),
(187, 'Vietnam', '越南', 'VN', '', '84', -1),
(188, 'Yemen', '也门', 'YE', '', '967', -5),
(189, 'Yugoslavia', '南斯拉夫', 'YU', '', '381', -7),
(190, 'Zimbabwe', '津巴布韦', 'ZW', '', '263', -6),
(191, 'Zaire', '扎伊尔', 'ZR', '', '243', -7),
(192, 'Zambia', '赞比亚', 'ZM', '', '260', -6);

-- --------------------------------------------------------

--
-- 表的结构 `devlist`
--

CREATE TABLE IF NOT EXISTS `devlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '所属用户的ID',
  `devid` varchar(255) DEFAULT NULL COMMENT '开发者ID',
  `name` varchar(255) DEFAULT '' COMMENT '开发者名称',
  `email` varchar(255) DEFAULT '' COMMENT '开发者邮箱',
  `address` varchar(255) DEFAULT '' COMMENT '开发者地址',
  `website` varchar(255) DEFAULT '' COMMENT '开发者网站',
  `level` varchar(255) DEFAULT '' COMMENT '开发者级别,顶尖或普通',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `devlist`
--

INSERT INTO `devlist` (`id`, `userid`, `devid`, `name`, `email`, `address`, `website`, `level`, `time`) VALUES
(1, 1, 'thehotgames', 'thehotgames', 'thehotgames2015@gmail.com', 'wuhan,China', 'https://play.google.com/store/apps/details?id=com.thehotgames.dating_birds', 'Developer', '2016-03-14 00:00:00'),
(2, 3, '6418760394979464117', 'Autodesk Inc.', 'support@sketchbook.com', 'San Rafael, California 94903', 'http://www.autodesk.com/', 'Top Developer', '2016-03-14 00:00:00'),
(3, 3, '6054197513203380012', 'Ketchapp ', 'support@ketchappgames.com', 'Ketchapp, 75015 Paris, France', 'http://www.ketchappgames.com/', 'Top Developer', '2016-03-14 00:00:00'),
(4, 3, '5950758182267281572', 'Outfit7', 'support@outfit7.com', 'Sansome Street Suite 3500-#7091San Francisco CA 94104 United States', 'http://outfit7.com/applications/', 'Top Developer', '2016-03-14 06:00:00'),
(5, 5, 'Fingersoft', 'Fingersoft', 'support@fingersoft.net', 'Finland', 'http://fingersoft.net/', 'Top Developer', '2016-03-14 00:00:00'),
(6, 6, '7891990035506213180', 'SEGA', 'help@sega.net', 'SEGA Networks Inc\r\nFifth Floor, 612 Howard Street San Francisco CA 91405', 'https://help.sega.net/hc/en-us', 'Top Developer', '2016-03-14 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `install_detail`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `message_status`
--

INSERT INTO `message_status` (`id`, `message_id`, `user_id`, `isread`, `readtime`) VALUES
(1, 3, 1, '1', '2016-03-09 19:05:54'),
(2, 2, 1, '1', '2016-03-09 19:06:00');

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
