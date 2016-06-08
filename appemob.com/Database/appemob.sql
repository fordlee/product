-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-16 11:20:43
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
  `devid` varchar(255) NOT NULL COMMENT '开发者ID',
  `appid` varchar(255) DEFAULT NULL COMMENT 'APP ID',
  `name` varchar(255) DEFAULT NULL COMMENT '应用名称',
  `img` varchar(255) DEFAULT '' COMMENT '应用图片',
  `promoter_title` varchar(255) DEFAULT NULL COMMENT '应用标题',
  `description` tinytext COMMENT '应用介绍',
  `sort` varchar(255) DEFAULT '' COMMENT 'App分类',
  `country` varchar(255) NOT NULL COMMENT '国家',
  `install` varchar(255) DEFAULT NULL COMMENT '应用安装量',
  `size` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT 'android' COMMENT '系统类别',
  `os_version` varchar(255) DEFAULT '' COMMENT '应用最低兼容系统版本',
  `status` int(10) DEFAULT NULL COMMENT 'App状态',
  `time` datetime DEFAULT NULL COMMENT '数据添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `applist`
--

INSERT INTO `applist` (`id`, `devid`, `appid`, `name`, `img`, `promoter_title`, `description`, `sort`, `country`, `install`, `size`, `os`, `os_version`, `status`, `time`) VALUES
(1, 'thehotgames', 'com.JuicyBubbles', 'Juicy Bubbles', '', 'Hippo', '适合所有人', 'Puzzle', 'China', '1000', '36M', 'android', '4.0 and up', 1, '2016-03-01 16:00:05'),
(2, 'thehotgames', 'com.SpeedDating', 'Speed Dating', '', 'Hippo', ' 适合所有人', '益智', 'China', '1000', '30M', 'android', '4.0 and up', 1, '2016-03-01 16:00:10'),
(3, 'thehotgames', 'com.thehotgames.dating_birds', 'Dating Birds', '', 'Dating Birds', 'Dating birds is a lovely and challenging puzzle game.The goal is moving obstacle blocks between birds and make them succeed in dating.In every level,moving times is limited.You need to get birds near in setting moves.As level up,it is harder to complete t', 'Puzzle', 'China', '500 - 1,000', '2.1M', 'android', '4.0 and up', 1, '2016-03-01 16:00:17'),
(4, '6418760394979464117', 'com.adsk.sketchbookhdexpress', 'Express', '', 'Media & Video ', 'Autodesk SketchBook Express for Tablets is a professional-grade paint and drawing application designed for android devices with screen sizes of 4" and above. SketchBook Express offers a dedicated set of sketching tools and delivers them through a streamli', 'Creativity', 'United States', '10000000', '11M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(5, '6418760394979464117', 'com.adsk.sketchbook', 'draw and paint', '', 'Entertainment', 'Autodesk® SketchBook® is an intuitive painting and drawing application designed for people of all skill levels, who love to draw. We reimagined the paint engine, so SketchBook delivers more fluid pencils and natural painting than ever before, all while ', 'Entertainment', 'US', '10000000', '47M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(6, '6418760394979464117', 'com.adsk.sketchbookink_gen', 'Ink', '', 'Ink', 'Draw perfect, resolution-independent lines with SketchBook® Ink. This easy-to-use pen & ink drawing app enables you create amazing line art and export high-resolution images directly from your tablet (7” or larger).', 'Entertainment', 'US', '50000', '9.6M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(7, '6054197513203380012', 'com.ketchapp.twist', 'Twist', '', 'Twist', 'Stay on the platforms and do as many jumps as you can.\nJust tap the screen to jump and twist the platforms. Try not to fall off the edges!\n\nCollect gems to unlock new balls and platform colors.\n\nWhat is your best score ?', 'Arcade', ' France', '10,000,000 - 50,000,000', '27M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(8, '6054197513203380012', 'com.ketchapp.splash', 'Splash', '', 'Splash', 'Splash is the new game from the creator of ZigZag and Twist.\r\nJump on the colored cubes to blow them up, and make as many beautiful Splashes of ink on the ground as you can!\r\n\r\nJust tap the screen to make the ball move down and hit the cubes.\r\n\r\nCollect g', 'Arcade', 'France', '500,000 - 1,000,000', '25M', 'android', '3.0 and up', 1, '2016-03-14 00:00:00'),
(9, '6054197513203380012', 'com.ketchapp.stack', 'Stack', '', 'Stack', 'Stack up the blocks as high as you can!', 'Arcade', 'France', '5,000,000 - 10,000,000', '25M', 'android', '3.0 and up', 1, '2016-03-14 08:00:00'),
(10, '6054197513203380012', 'com.ketchapp.swing', '浪荡天涯', '', 'Swing', 'Swing from platform to platform. Simply tap the screen when the rope is long enough to reach the next platform. How long can you survive?\r\nCollect gems and unlock cool new characters.', 'Arcade', 'France', '1,000,000 - 5,000,000', '27M', 'android', '3.0 and up', 1, '2016-03-14 08:22:00'),
(11, '6054197513203380012', 'com.ketchapp.hophophop', '下蹿上跳', '', 'Hop Hop Hop', 'Jump into the hoops and avoid the spikes. Collect mushrooms to unlock all the funny characters!\r\nHow far can you go?\r\n\r\n→ Eat a mushroom to get 1 point\r\n→ Jump into the hoop from above to get 2 points\r\n→ You have enough skills to do it from below? G', 'Arcade', 'France', '1,000,000 - 5,000,000', '18M', 'android', '3.0 and up', 1, '2016-03-14 13:00:00'),
(12, '6054197513203380012', 'com.ketchapp.sky', '天阶', '', 'Sky', 'Fly, Jump and Clone yourself into a fantastic adventure with SKY.\r\nIn this new game developed by the same team behind Phases and The Line Zen, you''re in control of multiple characters as they run through a 3D mystical world filled with trouble.', 'Arcade', 'France', '1,000,000 - 5,000,000', '10M', 'android', '2.3.3 and up', 1, '2016-03-14 07:00:00'),
(13, '6054197513203380012', 'com.ketchapp.zigzaggame', 'ZigZag', '', 'ZigZag', 'Stay on the wall and do as many zigzags as you can!\r\nJust tap the screen to change the direction of the ball. Try not to fall off the edges!\r\n\r\nHow far can you go?', 'Arcade', 'France', '10,000,000 - 50,000,000', '21M', 'android', '2.3 and up', 1, '2016-03-14 07:00:00'),
(14, '6054197513203380012', 'com.ketchapp.arrow', 'Arrow', '', 'Arrow', 'Move through the maze without hitting the walls. Collect points to grow your tail. Smash gems to unlock cool new arrow heads and backgrounds!', 'Arcade', 'France', '1,000,000 - 5,000,000', '19M', 'android', '4.1 and up', 1, '2016-03-14 08:00:00'),
(15, '6054197513203380012', 'com.ketchapp.stickhero', '英雄难过棍子关', '', 'Stick Hero', 'Stretch the stick in order to reach and walk on the platforms. Watch out! If the stick is not long enough, you will fall down!\r\nHow far can you go?', 'Arcade', ' France', '10,000,000 - 50,000,000', '14M', 'android', '2.3 and up', 1, '2016-03-14 09:00:00'),
(16, '6054197513203380012', 'com.ketchapp.theline2', 'The Line Zen', '', 'The Line Zen', 'Welcome to The Line Zen.\r\nThe Line Zen is the sequel to 2014''s hit game, The Line, but now with a new twist. You still dart and weave through a procedurally generated world while avoiding the red shapes, but now you use friendly green shapes to your advan', 'Arcade', 'France', '1,000,000 - 5,000,000', '7.5M', 'android', '2.3.3 and up', 1, '2016-03-14 06:00:00'),
(17, '6054197513203380012', 'com.ketchapp.jellyjump', 'Jelly Jump', '', 'Jelly Jump', 'Little jellies need you more than ever before! They keep drowning over and over again. Only you can keep them safe...\r\nJump higher, survive longer and never give up!', 'Arcade', 'France', '10,000,000 - 50,000,000', '30M', 'android', '2.3 and up', 1, '2016-03-14 07:00:00'),
(18, '6054197513203380012', 'com.ketchapp.cloudpath', 'Cloud Path', '', 'Cloud Path', 'Walk on the path as fast as you can, and earn one point for each step you do. Collect gems and unlock new characters!', 'Arcade', 'France', '500,000 - 1,000,000', '23M', 'android', '2.2 and up', 1, '2016-03-14 06:00:00'),
(19, '6054197513203380012', 'com.ketchapp.donttouchthespikes', 'Don''t Touch The Spikes', '', 'Don''t Touch The Spikes', 'Make the little bird fly! Don''t touch the spikes!\r\nHow far can you make it?', 'Arcade', 'France', '10,000,000 - 50,000,000', '15M', 'android', '2.3 and up', 1, '2016-03-14 05:00:00'),
(20, '6054197513203380012', 'com.ketchapp.qubes', '圆方快跑', '', 'Qubes', 'Tap to change the direction of the bouncing ball. Collect coins and unlock new balls.\r\nHow long can you survive on the qubes?\r\n\r\nHow to play:\r\nTap anywhere on the screen to change the direction of the ball.', 'Arcade', 'France', '100,000 - 500,000', '26M', 'android', '3.0 and up', 1, '2016-03-14 00:00:00'),
(21, 'thehotgames', 'com.thehotgames.frozen_blocks', 'Frozen Blocks: Magic', '', 'Frozen Blocks: Magic', 'Frozen Blocks: Magic is a unique and creative physics based game. Stack all provided frozen blocks to keep them in a good balance. Be careful not to let them fall off the screen,or you''ll have to start again. You can unlock new challenging theme levels wh', 'Puzzle', 'China', '500 - 1,000', '2.6M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(22, 'thehotgames', 'com.thehotgames.halloween_ghost', 'Halloween Ghost', '', 'Halloween Ghost', 'Experience the fun of Halloween,a mysterious shaman in the procurement Halloween gift when it came to a group of ghost. The story began ...', 'Adventure', 'China', '1,000 - 5,000', '2.8M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(23, 'thehotgames', 'com.thehotgame.app.turtle', 'The Rolling Turtle', '', 'The Rolling Turtle', 'The Rolling Turtle like ants on a hot pan, only to reach the end you are the most secure. Game, players by turning the dial to scroll to get control of the turtle four stars. Turntable inside organs unpredictable, can you help the turtle successfully reac', 'Strategy', 'China', '50 - 100', '2.6M', 'android', '2.3.3 and up', 1, '2016-03-14 00:00:00'),
(24, '5950758182267281572', 'com.outfit7.tomsbubbles', '汤姆猫泡泡射手', '', 'Talking Tom Bubble Shooter', 'Play the exciting action-packed bubble shooter – your next favorite game from Talking Tom. Challenge your friends or play on your own as you level up and unlock Tom’s friends.\r\nDiscover new features for some seriously thrilling adventures. Crush bosse', 'Casual', 'United States', '10,000,000 - 50,000,000', NULL, 'android', '4.1 and up', 1, '2016-03-14 00:00:00'),
(25, '5950758182267281572', 'com.outfit7.mytalkingangelafree', '我的安吉拉', '', 'My Talking Angela', 'Explore Talking Angela’s world and customise her fashion, hairstyle, makeup and home - all while playing addictively cute mini games.\r\nWith over 165 million downloads already… don’t miss out on the fun!', 'Casual', 'United States', '100,000,000 - 500,000,000', '77M', 'android', '4.1 and up', 1, '2016-03-14 00:00:00'),
(26, '5950758182267281572', 'com.outfit7.tomsjetski', 'Talking Tom Jetski', '', 'Talking Tom Jetski', 'Jump on the water scooter with TALKING TOM or TALKING ANGELA and experience the most exhilarating water action out there - dashing through cool missions and daring challenges on the ride of your life.', 'Casual', 'United States', '10,000,000 - 50,000,000', NULL, 'android', '4.0.3 and up', 1, '2016-03-14 00:00:00'),
(27, '5950758182267281572', 'com.outfit7.mytalkingtomfree', 'My Talking Tom', '', 'My Talking Tom', 'Discover the #1 games app in 135 countries! Adopt your very own baby kitten and help him grow into a fully grown cat. Take good care of your virtual pet, name him and make him part of your daily life by feeding him, playing with him and nurturing him as h', 'Casual', 'United States', '100,000,000 - 500,000,000', '61M', 'android', '4.1 and up', 1, '2016-03-14 00:00:00'),
(28, '5950758182267281572', 'com.outfit7.talkingangelafree', 'Talking Angela', '', 'Talking Angela', 'Come join Talking Angela in Paris - the city of love, style and magic. There are so many surprises, you better sit down. ;) Enjoy amazing gifts, pick the latest styles, and sip magical cocktails to experience special moments. And watch out for birds - you', 'Entertainment', 'United States', '50,000,000 - 100,000,000', '45M', 'android', '4.1 and up', 1, '2016-03-14 00:00:00'),
(29, '5950758182267281572', 'com.outfit7.tomlovesangelafree', 'Tom Loves Angela', '', 'Tom Loves Angela', 'Talking Tom has climbed all the way up to the rooftop to get a glimpse of Angela. Tom will repeat what you say to Angela so help him woo her by singing a song, having a chat using the innovative “intelligent” chat function and by giving her gifts!\r\nBu', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', '4.0.3 and up', 1, '2016-03-14 00:00:00'),
(30, '5950758182267281572', 'com.outfit7.tomslovelettersfree', 'Tom''s Love Letters', '', 'Tom''s Love Letters', 'Download the cutest love app ever and show that special person how you feel about them.\r\nTalking Tom and Talking Angela are at hand to help you express your feelings. Just like Cupid, your furry friends will help you share your feelings, whether it’s wi', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', '2.3 and up', 1, '2016-03-14 00:00:00'),
(31, '5950758182267281572', 'com.outfit7.talkinggingerfree', 'Talking Ginger', '', 'Talking Ginger', 'Little Talking Ginger needs your help! Help him get ready for bed and have fun along the way!\r\nGinger provides the best company - talk to him, tickle him and play games with him. You can even see what he’s dreaming about at night!', 'Entertainment', 'United States', '100,000,000 - 500,000,000', NULL, 'android', '4.0.3 and up', 1, '2016-03-14 00:00:00'),
(32, '5950758182267281572', 'com.outfit7.talkingben', 'Talking Ben the Dog', '', 'Talking Ben the Dog', 'Ben is a retired chemistry professor who likes his quiet comfortable life of eating, drinking and reading newspapers. To make him responsive, you will have to bother him long enough that he will fold his newspaper. Then you can talk to him, poke or tickle', 'Entertainment', 'United States', '50,000,000 - 100,000,000', '50M', 'android', '4.0.3 and up', 1, '2016-03-14 00:00:00'),
(33, '5950758182267281572', 'com.outfit7.talkingnewsfree', 'Talking Tom & Ben News', '', 'Talking Tom & Ben News', 'Breaking news - Talking Tom and Talking Ben are even chattier and more entertaining as TV news anchors!\r\nJoin them in their TV studio, talk to them and watch them take it in turns to repeat what you say. Poke or swipe the screen and have them fall off the', 'Entertainment', 'United States', '50,000,000 - 100,000,000', NULL, 'android', '4.0.3 and up', 1, '2016-03-14 00:00:00'),
(34, 'Fingersoft', 'com.fingersoft.hillclimb', 'Hill Climb Racing', '', 'Hill Climb Racing', 'One of the most addictive and entertaining physics based driving game ever made! And it''s free!\r\nMeet Newton Bill, the young aspiring uphill racer. He is about to embark on a journey that takes him to where no ride has ever been before. With little respec', 'Racing', 'Finland', '100,000,000 - 500,000,000', NULL, 'android', '', 1, '2016-03-14 00:00:00'),
(35, 'Fingersoft', 'com.waybefore.fastlikeafox', 'Fast like a Fox', '', 'Fast like a Fox', 'One of the most fun and fastest platformers ever created with unique tap control! Play now for free!\nFast like a Fox uses your device’s internal sensors to detect movement. Learn the tapping technique to have the best precision.', 'Adventure', 'Finland', '1,000,000 - 5,000,000', '54M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(36, 'Fingersoft', 'com.fingersoft.nightvisioncamera', 'Night Vision Camera', '', 'Night Vision Camera', 'This application maximizes your device camera in the dark! Automatic adjustment of image parts to improve visibility in low light conditions.\r\nWe have just released Hill Climb Racing, it''s one of the most entertaining and addictive FREE driving game made ', 'Photography', 'Finland', '10,000,000 - 50,000,000', '379k', 'android', '2.2 and up', 1, '2016-03-14 00:00:00'),
(37, 'Fingersoft', 'com.fingersoft.benjibananas', 'Benji Bananas', '', 'Benji Bananas', 'The best action adventure game on your Android! And it''s free!\r\n\r\nExciting and fun physics based adventure game!\r\n\r\nFly from vine to vine, but watch out for dangers lurking in the jungle. Earn bananas to get upgrades, specials and power ups.\r\n\r\nFeatures:\r', 'Adventure', 'Finland', '50,000,000 - 100,000,000', '25M', 'android', '3.0 and up', 1, '2016-03-14 00:00:00'),
(38, 'Fingersoft', 'com.fingersoft.cartooncamera', 'Cartoon Camera', '', 'Cartoon Camera', 'One of the coolest free Android camera apps ever created!\r\nCreate cartoon and sketch like photography with your camera.\r\n\r\nWe have just released Hill Climb Racing, it''s one of the most entertaining and addictive FREE driving game made for android!', 'Photography', 'Finland', '10,000,000 - 50,000,000', '1.0M', 'android', '2.2 and up', 1, '2016-03-14 00:00:00'),
(39, 'Fingersoft', 'com.fingersoft.thermalvisioncamera', 'Thermal Camera', '', 'Thermal Camera', 'The best Thermal Camera application for Android is finally here!\r\nLike us on Facebook and stay tuned for all new cool releases and updates:', 'Photography', 'Finland', '5,000,000 - 10,000,000', '521k', 'android', '2.2 and up', 1, '2016-03-14 00:00:00'),
(40, 'Fingersoft', 'com.fingersoft.failhard', 'Fail Hard', '', 'Fail Hard', 'We bring you extremely fun physics based stunt game on Android!\r\n* Experience the evolution of becoming the greatest stuntman in the world.\r\n* Make it big in the stunt show business and don''t back down even from \r\nthe most dangerous of stunts and jumps.\r\n', 'Action', 'Finland', '10,000,000 - 50,000,000', '58M', 'android', '4.0.3 and up', 1, '2016-03-14 00:00:00'),
(41, 'Fingersoft', 'com.fingersoft.ihatefish', 'I Hate Fish', '', 'I Hate Fish', 'Shoot your way to the top of the food chain and guide Earl the worm through perilous waters filled with enemies to the safety of your homeboat.\r\n- MANEUVER and SHOOT your way through the schools of angry fish.\r\n- UPGRADE your weapons to match the growing ', 'Action', 'Finland', '1,000,000 - 5,000,000', '47M', 'android', '2.3 and up', 1, '2016-03-14 00:00:00'),
(42, 'Fingersoft', 'com.fingersoft.motioncamera', 'Motion Camera', '', 'Motion Camera', 'Create cool and unique photos with motion in them. Motion Camera blurs movement of objects into to your photos. Cars, people, you name it.\r\nCheck out our latest free game: Hill Climb Racing. It''s a fun and addictive driving game where you reach further di', 'Photography', 'Finland', '1,000,000 - 5,000,000', '252k', 'android', '2.2 and up', 1, '2016-03-14 00:00:00'),
(43, 'Fingersoft', 'com.sixminute.freeracing', 'FRZ: Free Racing Zero', '', 'FRZ: Free Racing Zero', 'FRZ: Free Racing Zero! Steer your way to victory against the competition in this comic style retro racer!\r\nFRZ: Free Racing Zero brings high-paced retro racing back to the world. It''s time to burn rubber, drift and steer your way to the finish line in thi', 'Racing', 'Finland', '100,000 - 500,000', NULL, 'android', '2.3 and up', 1, '2016-03-14 00:00:00'),
(44, '7891990035506213180', 'com.sega.sonicdash', 'Sonic Dash', '', 'Sonic Dash', 'For mobile and tablet.\r\nHow far can the world’s fastest hedgehog run?\r\n\r\nPlay as Sonic the Hedgehog as you dash, jump and spin your way across stunning 3D environments. Swipe your way over and under challenging obstacles in this fast and frenzied endles', 'Arcade', 'United States', '50,000,000 - 100,000,000', '64M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(45, '7891990035506213180', 'com.sega.cityrush', 'Crazy Taxi™ City Rush', '', 'Crazy Taxi™ City Rush', 'Drive crazy in SEGA’s all-new car racing game Crazy Taxi. Race through the city in your car to deliver your passengers on-time -- the crazier you drive the higher your rewards! Your car, your rules - speed, drift, whip around corners, weave through traf', 'Action', 'United States', '5,000,000 - 10,000,000', '79M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(46, '7891990035506213180', 'com.sega.sonic.transformed', 'Sonic Racing Transformed', '', 'Sonic Racing Transformed', 'Sonic & All Star Racing Transformed is now FREE! If you previously bought the game you still have the VIP Pass for FREE.\r\nIt’s Not Just Racing… it’s Racing Transformed!\r\n\r\nRace as Sonic and a host of legendary All-Stars and prepare to transform! Spe', 'Racing', 'United States', '10,000,000 - 50,000,000', NULL, 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(47, '7891990035506213180', 'com.sega.sonic4ep2lite', 'Sonic 4 Episode II LITE', '', 'Sonic 4 Episode II LITE', 'Take Sonic and Tails for a spin in this Lite version of Sonic The Hedgehog™ 4 Episode II!\r\nThe Sonic 4 Saga continues in Episode II with the return of a beloved side kick and fan-favorite villains!', 'Arcade', 'United States', '10,000,000 - 50,000,000', '195M', 'android', '2.3 and up', 1, '2016-03-14 00:00:00'),
(48, '7891990035506213180', 'com.sega.sonicjumpfever', 'Sonic Jump Fever', '', 'Sonic Jump Fever', 'Catch the FEVER in an explosive race against the clock! Compete with Sonic and friends in high-speed bursts of vertical jumping mayhem. FREE and based on SEGA’s hit Sonic Jump.\r\nProve you are the best. Rack up huge combos to blast past your friends’ h', 'Action', 'United States', '10,000,000 - 50,000,000', '35M', 'android', '4.0 and up', 1, '2016-03-14 00:00:00'),
(49, '7891990035506213180', 'com.sigames.fmh2016', 'Football Manager Mobile 2016', '', 'Football Manager Mobile 2016', 'Football Manager Mobile 2016 is designed to be played on the move and is the quickest way to manage your favourite club to glory with a focus on tactics and transfers.\r\nTake charge of clubs from 14 countries across the world, including all the big Europea', 'Sports', 'United States', '100,000 - 500,000', NULL, 'android', '2.3.3 and up', 1, '2016-03-14 00:00:00'),
(50, '7891990035506213180', 'com.sega.twbshogun', 'Total War Battles', '', 'Total War Battles', 'BUILD, BATTLE AND AVENGE!\r\nSpecifically developed for touchscreen platforms, Total War Battles™: SHOGUN is a new real-time strategy game from the makers of the award-winning Total War series. \r\nTotal War Battles™ delivers quick-fire, tactical combat b', 'Arcade', 'United States', '50,000 - 100,000', '273M', 'android', '2.3.3 and up', 1, '2016-03-14 00:00:00');

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

-- --------------------------------------------------------

--
-- 表的结构 `bidlist`
--

CREATE TABLE IF NOT EXISTS `bidlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `applistid` int(11) NOT NULL COMMENT 'applist表外键',
  `countryid` tinyint(11) NOT NULL COMMENT '国家id外键',
  `bid` smallint(6) NOT NULL DEFAULT '0' COMMENT '竞价大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=249 ;

--
-- 转存表中的数据 `bidlist`
--

INSERT INTO `bidlist` (`id`, `applistid`, `countryid`, `bid`) VALUES
(63, 7, 1, 20),
(64, 7, 2, 20),
(65, 7, 3, 20),
(66, 7, 4, 20),
(67, 7, 5, 20),
(68, 7, 9, 20),
(69, 7, 10, 20),
(70, 7, 11, 20),
(71, 7, 12, 20),
(72, 7, 13, 20),
(73, 7, 14, 20),
(74, 7, 15, 20),
(75, 7, 16, 20),
(119, 8, 1, 20),
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
(248, 43, 5, 20);

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
(25, 'Brazil', '巴西', 'BR', '0', '55', -11),
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
(37, 'China', '中国', 'CN', '0', '86', 0),
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
(55, 'France', '法国', 'FR', '0', '33', -8),
(56, 'French \n                      Guiana', '法属圭亚那', 'GF', '0', '594', -12),
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
(88, 'Korea', '韩国', 'KR', '0', '82', 1),
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
(177, 'Turkey', '土耳其', 'TR', '0', '90', -6),
(178, 'Turkmenistan ', '土库曼斯坦', 'TM', '0', '993', -5),
(179, 'Uganda', '乌干达', 'UG', '0', '256', -5),
(180, 'Ukraine', '乌克兰', 'UA', '0', '380', -5),
(181, 'United Arab Emirates', '阿拉伯联合酋长国', 'AE', '0', '971', -4),
(182, 'United Kiongdom', '英国', 'GB', '0', '44', -8),
(183, 'United States of America', '美国', 'US', '0', '1', -13),
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
  `userid` int(11) DEFAULT NULL COMMENT '所属用户的ID',
  `devid` varchar(255) DEFAULT NULL COMMENT '开发者ID',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `devlist`
--

INSERT INTO `devlist` (`id`, `userid`, `devid`, `name`, `email`, `address`, `website`, `level`, `token`, `token_exptime`, `status`, `time`) VALUES
(1, 1, 'thehotgames', 'thehotgames', 'thehotgames2015@gmail.com', 'wuhan,China', 'https://play.google.com/store/apps/details?id=com.thehotgames.dating_birds', 'Developer', '', 0, 0, '2016-03-14 00:00:00'),
(2, 3, '6418760394979464117', 'Autodesk Inc.', 'support@sketchbook.com', 'San Rafael, California 94903', 'http://www.autodesk.com/', 'Top Developer', '', 0, 0, '2016-03-14 00:00:00'),
(3, 2, '6054197513203380012', 'Ketchapp ', 'support@ketchappgames.com', 'Ketchapp, 75015 Paris, France', 'http://www.ketchappgames.com/', 'Top Developer', '', 0, 0, '2016-03-14 00:00:00'),
(4, 4, '5950758182267281572', 'Outfit7', 'support@outfit7.com', 'Sansome Street Suite 3500-#7091San Francisco CA 94104 United States', 'http://outfit7.com/applications/', 'Top Developer', '', 0, 0, '2016-03-14 06:00:00'),
(5, 2, 'Fingersoft', 'Fingersoft', 'support@fingersoft.net', 'Finland', 'http://fingersoft.net/', 'Top Developer', '', 0, 0, '2016-03-14 00:00:00'),
(6, 2, '7891990035506213180', 'SEGA', 'help@sega.net', 'SEGA Networks Inc\r\nFifth Floor, 612 Howard Street San Francisco CA 91405', 'https://help.sega.net/hc/en-us', 'Top Developer', '', 0, 0, '2016-03-14 00:00:00');

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
  `status` tinyint(4) DEFAULT '1' COMMENT '用户状态,禁用或正常状态',
  `time` datetime DEFAULT NULL COMMENT '数据日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `userlist`
--

INSERT INTO `userlist` (`id`, `name`, `business_name`, `email`, `passwd`, `address`, `post_code`, `city`, `country`, `token`, `token_exptime`, `status`, `time`) VALUES
(1, 'hubery', 'hellowd', 'huli_yangthze@126.com', '2016', 'wuhan', '43700', 'wuhan', 'Albania', 'd115e11a90a12deadcad2c0312698ce1', 1456395196, 1, '2016-02-25 15:17:17'),
(2, 'hubery', 'hellowd', 'hubery_lee@yeah.net', '2016', 'wuhan', '43700', 'wuhan', 'China', '1d4ef9a8f360b1c22946a5ade5d7f167', 1456469665, 1, '2016-02-25 14:54:25'),
(3, 'hubery', 'hellowd', 'hubery_lee@qq.com', '2016', 'wuhan', '43700', 'wuhan', 'china', '7e31dac6fc4f701f941d49c6d3b895ac', 1456828097, 1, '2016-02-29 18:28:17'),
(4, 'hubery', 'hellowd', 'huli_yangthze@163.com', '2016', 'wuhan', '43700', 'wuhan', 'china', '61cb94dd1b08fccbcc4a343f238b3f96', 1456828157, 1, '2016-02-29 18:29:17'),
(5, 'hubery', 'helloworld', 'hubery4@163.com', 'hubery4', 'wuhan', '437000', 'wuhan', 'China', '', 0, 1, '2016-03-14 00:00:00'),
(6, 'hubery6', 'hubery6', 'hubery6@163.com', 'hubery6', 'wuhan', '437000', 'wuhan', 'China', '', 0, 1, '2016-03-14 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
