-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2016 at 12:05 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `info`
--
CREATE DATABASE IF NOT EXISTS `info` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `info`;

-- --------------------------------------------------------

--
-- Table structure for table `appfile`
--

CREATE TABLE IF NOT EXISTS `appfile` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(32) NOT NULL COMMENT '名字',
  `description` mediumtext NOT NULL COMMENT '描述',
  `poster` varchar(32) NOT NULL COMMENT '上传者',
  `posttime` date NOT NULL COMMENT '上传时间',
  `filename` varchar(32) NOT NULL COMMENT '纯粹文件名',
  `path` varchar(128) NOT NULL COMMENT '路径',
  `size` varchar(32) NOT NULL COMMENT '大小',
  `self` tinyint(4) NOT NULL COMMENT '公开性，0公开，1不公开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `appfile`
--

INSERT INTO `appfile` (`id`, `name`, `description`, `poster`, `posttime`, `filename`, `path`, `size`, `self`) VALUES
(18, 'Hidex', 'internet useful', '史明明', '2016-09-07', 'HedExLite.exe', '../../uploads/app/', '1459200', 0),
(19, 'df ', 'dsf ', '史明明', '2016-09-07', '8.1.txt', '../../uploads/app/', '43', 1),
(20, '鼎折覆餗', '工恭恭敬敬', '杨春', '2016-09-07', 'HedExLite.exe', '../../uploads/app/', '1459200', 0),
(21, '霜霜', '已子孙', '杨春', '2016-09-07', 'EditPlus.exe', '../../uploads/app/', '2394112', 0),
(22, '顶替', '顶替', '杨春', '2016-09-07', 'W3CSchool.chm', '../../uploads/app/', '11818410', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `author` varchar(40) NOT NULL COMMENT '作者',
  `description` text COMMENT '内容简介',
  `dateline` date NOT NULL COMMENT '日期',
  `poster` varchar(40) NOT NULL COMMENT '上传者',
  `self` tinyint(4) NOT NULL COMMENT '是否公开：0为是，1为否',
  `filename` varchar(32) NOT NULL COMMENT '纯粹文件名',
  `path` varchar(128) NOT NULL,
  `type` varchar(32) NOT NULL COMMENT '格式',
  `size` varchar(32) NOT NULL COMMENT '大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `author`, `description`, `dateline`, `poster`, `self`, `filename`, `path`, `type`, `size`) VALUES
(15, '压根没有', '李厚霖', '东风风神 ', '2016-09-07', '杨春', 0, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0'),
(16, '桂丰大厦', '磊', '大', '2016-09-07', '杨春', 0, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0'),
(17, '霜霜', '木', '压标', '2016-09-07', '杨春', 1, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0'),
(18, '硒鼓', '顶替', '桂', '2016-09-07', '杨春', 0, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0'),
(19, '硒鼓', '顶替', '少时诵诗书', '2016-09-07', '杨春', 1, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0'),
(20, '史莱克兄弟', '大卫。科波菲尔', '桂林', '2016-09-07', '史明明', 0, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0'),
(21, '学习做网页', 'Franceyang', '这是一个神奇的网站 ', '2016-09-16', '杨春', 0, '111.docx', 'C:/wamp/www/DepartmentWeb/uploads/article/', 'Word', '0');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `filename` varchar(40) NOT NULL COMMENT '标题',
  `description` varchar(1024) NOT NULL COMMENT '描述',
  `poster` varchar(32) NOT NULL COMMENT '上传者',
  `type` varchar(32) NOT NULL COMMENT '格式',
  `size` varchar(64) NOT NULL COMMENT '大小',
  `date` date NOT NULL COMMENT '日期',
  `path` varchar(128) NOT NULL COMMENT '路径',
  `self` tinyint(4) NOT NULL COMMENT '公开性，0为公开，1为不公开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `filename`, `description`, `poster`, `type`, `size`, `date`, `path`, `self`) VALUES
(1, '1.jpg', 'sdfsdfsdfsdf', '杨春', 'jpg', '296632', '2016-09-09', '../../uploads/picture/', 0),
(5, '奋斗.jpg', '这是一张神奇的图片\r\n', '杨春', 'jpg', '126567', '2016-09-09', '../../uploads/picture/', 0),
(6, '没东哥的合照.jpg', '天妒英才\r\n人间豪杰', '杨春', 'jpg', '115756', '2016-09-10', '../../uploads/picture/', 1),
(7, '以前的飞哥2.jpg', '这就是为什么咯', '杨春', 'jpg', '56634', '2016-09-10', '../../uploads/picture/', 0),
(8, '蜜飞.jpg', '嘿嘿', '杨春', 'jpg', '96987', '2016-09-10', '../../uploads/picture/', 0),
(9, '六班合照.jpg', '六班合照', '杨春', 'jpg', '943386', '2016-09-10', '../../uploads/picture/', 0),
(10, '以前的飞哥1.jpg', 'fsfsdfsf', '杨春', 'jpg', '69117', '2016-09-11', '../../uploads/picture/', 0),
(11, '携程.jpg', 'dfsfsdfsdf', '杨春', 'jpg', '2810', '2016-09-11', '../../uploads/picture/', 0),
(12, 'Lang-8.jpg', 'sfsdfsdf', '杨春', 'jpg', '3031', '2016-09-11', '../../uploads/picture/', 0),
(13, '1.jpg', '', '杨春', 'jpg', '296632', '2016-09-11', '../../uploads/picture/', 0),
(14, '2.jpg', 'dfsfsdf', '杨春', 'jpg', '25053', '2016-09-11', '../../uploads/picture/', 0),
(15, '2.jpg', '', '杨春', 'jpg', '25053', '2016-09-19', '../../uploads/picture/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(40) NOT NULL COMMENT '名字',
  `maker` varchar(40) NOT NULL COMMENT '编程者',
  `description` mediumtext NOT NULL COMMENT '描述',
  `poster` varchar(32) NOT NULL COMMENT '上传者',
  `filename` varchar(32) NOT NULL COMMENT '纯粹文件名',
  `size` varchar(32) NOT NULL COMMENT '大小',
  `path` varchar(128) NOT NULL COMMENT '文件路径',
  `posttime` date NOT NULL COMMENT '日期',
  `self` tinyint(4) NOT NULL COMMENT '公开性，0为公开，1为不公开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `name`, `maker`, `description`, `poster`, `filename`, `size`, `path`, `posttime`, `self`) VALUES
(3, '笑傲江湖', 'France yang', '这是一个无敌的程序', '史明明', 'gsLauncherSetup.exe', '105880', '../../uploads/exe/', '2016-09-07', 0),
(4, '李厚霖', '顶替', '顶替', '史明明', '8.1.txt', '43', '../../uploads/exe/', '2016-09-07', 1),
(5, '顶替', '杨春', '娶娶又', '杨春', 'gsLauncherSetup.exe', '105880', '../../uploads/exe/', '2016-09-07', 0),
(7, '顶替', 'sfdssssss', 'xvcxv', '杨春', 'example.php', '4486', '../../uploads/exe/', '2016-09-07', 0),
(8, 'fsd ', 'sfd ', 'sdsssss', '杨春', 'W3CSchool.chm', '11818410', '../../uploads/exe/', '2016-09-07', 0),
(9, '微点杀毒软件', '顶替', '枯', '杨春', '微点杀毒软件.exe', '80803424', '../../uploads/exe/', '2016-09-07', 0),
(10, '图片', '村', '顶替', '杨春', '百度.jpg', '4781', '../../uploads/exe/', '2016-09-07', 0),
(11, 'fgfd ', 'gdffg', 'dfgdfg', '杨春', '微点杀毒软件.exe', '80803424', '../../uploads/exe/', '2016-09-07', 0),
(12, 'sdfsf', 'sff', 'aaaaaa', '杨春', 'ysyy_v4.0.4.0_Setup_1001.exe', '62452936', '../../uploads/exe/', '2016-09-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(40) DEFAULT NULL COMMENT '密码',
  `power` tinyint(4) NOT NULL COMMENT '权限：0为总管理员，1为其它管理员，2为普通用户，3保留',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `power`) VALUES
(4, '杨春', '123456', 0),
(5, '杨春', '111', 2),
(10, 'student', 'dianzi', 3),
(11, '史明明', '111', 2),
(12, '章瑞东', '666', 2),
(13, '玄老师', 'xuan', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
