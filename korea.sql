-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 26 日 10:22
-- 服务器版本: 5.1.28
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `korea`
--

-- --------------------------------------------------------

--
-- 表的结构 `tcit_category`
--

CREATE TABLE IF NOT EXISTS `tcit_category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `lmID` int(5) DEFAULT NULL,
  `parentID` int(5) DEFAULT '0',
  `orderNo` int(5) DEFAULT '0',
  `categoryTitle` varchar(50) DEFAULT '未命名',
  `categoryTitle1` varchar(50) DEFAULT NULL,
  `categoryTitle2` varchar(50) DEFAULT NULL,
  `categoryBremark` varchar(50) DEFAULT NULL,
  `categoryName1` text,
  `categoryName2` text,
  `categorySmallPic` varchar(255) DEFAULT NULL,
  `categoryBigPic` varchar(255) DEFAULT NULL,
  `categoryContent1` text,
  `categoryContent2` text,
  `multiPic` text,
  `creatTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类别表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tcit_category`
--

INSERT INTO `tcit_category` (`id`, `lmID`, `parentID`, `orderNo`, `categoryTitle`, `categoryTitle1`, `categoryTitle2`, `categoryBremark`, `categoryName1`, `categoryName2`, `categorySmallPic`, `categoryBigPic`, `categoryContent1`, `categoryContent2`, `multiPic`, `creatTime`) VALUES
(1, 4, 0, 1, '作品展示', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2014),
(2, 4, 0, 2, '客片欣赏', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2014),
(3, 7, 0, 3, '热门新闻', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2014),
(4, 7, 0, 4, '热点资讯', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2014),
(5, 7, 0, 5, '服务小贴士', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2014);

-- --------------------------------------------------------

--
-- 表的结构 `tcit_grant`
--

CREATE TABLE IF NOT EXISTS `tcit_grant` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tcit_grant`
--

INSERT INTO `tcit_grant` (`id`, `name`, `value`, `status`) VALUES
(1, 'ALL', '管理员', 1),
(2, 'User', '用户管理', 1),
(3, 'Password', '用户名和密码', 1),
(4, 'Backup', '数据库管理', 1),
(5, 'add', '添加信息', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tcit_member`
--

CREATE TABLE IF NOT EXISTS `tcit_member` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `lmID` int(2) DEFAULT NULL,
  `userID` varchar(20) DEFAULT NULL,
  `realName` varchar(10) DEFAULT NULL,
  `passWord` varchar(50) DEFAULT NULL,
  `mailCode` varchar(4) DEFAULT NULL,
  `grantWord` varchar(50) DEFAULT NULL COMMENT '权限 用“|”分隔多个权限',
  `sex` int(1) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `addr` varchar(80) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `youbian` int(6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `creatTime` int(10) DEFAULT NULL,
  `loginTime` int(10) DEFAULT NULL,
  `attributeData` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tcit_menu`
--

CREATE TABLE IF NOT EXISTS `tcit_menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `lm_id` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `lm_name` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单标题',
  `menu_name` varchar(20) NOT NULL DEFAULT '' COMMENT '项目标题',
  `sort_no` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  `action` varchar(100) NOT NULL DEFAULT '' COMMENT '功能链接',
  `function` varchar(100) NOT NULL DEFAULT '' COMMENT '管理链接',
  `manage` tinyint(1) unsigned NOT NULL COMMENT '是否创建管理链接',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用排序',
  `grantword` varchar(10) NOT NULL DEFAULT '' COMMENT '权限',
  `database` varchar(10) NOT NULL DEFAULT '' COMMENT '数据库',
  `use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用',
  `allow_field` text NOT NULL,
  `category` varchar(10) NOT NULL DEFAULT '所属类别' COMMENT '所属类别',
  `title` varchar(10) NOT NULL DEFAULT '标题名称' COMMENT '标题名称',
  `title1` varchar(10) NOT NULL DEFAULT 'title1',
  `title2` varchar(10) NOT NULL DEFAULT 'title2',
  `title3` varchar(10) NOT NULL DEFAULT 'title3',
  `title4` varchar(10) NOT NULL DEFAULT 'title4',
  `title5` varchar(10) NOT NULL DEFAULT 'title5',
  `title6` varchar(10) NOT NULL DEFAULT 'title6',
  `title7` varchar(10) NOT NULL DEFAULT 'title7',
  `title8` varchar(10) NOT NULL DEFAULT 'title8',
  `title9` varchar(10) NOT NULL DEFAULT 'title9',
  `title10` varchar(10) NOT NULL DEFAULT 'title10',
  `name1` varchar(10) NOT NULL DEFAULT 'name1',
  `name2` varchar(10) NOT NULL DEFAULT 'name2',
  `name3` varchar(10) NOT NULL DEFAULT 'name3',
  `name4` varchar(10) NOT NULL DEFAULT 'name4',
  `name5` varchar(10) NOT NULL DEFAULT 'name5',
  `content` varchar(10) NOT NULL DEFAULT '内容',
  `content1` varchar(10) NOT NULL DEFAULT 'content1',
  `content2` varchar(10) NOT NULL DEFAULT 'content2',
  `content3` varchar(10) NOT NULL DEFAULT 'content3',
  `content4` varchar(10) NOT NULL DEFAULT 'content4',
  `content5` varchar(10) NOT NULL DEFAULT 'content5',
  `smallpic` varchar(10) NOT NULL DEFAULT '上传小图',
  `bigpic` varchar(10) NOT NULL DEFAULT '上传大图',
  `upload1` varchar(10) NOT NULL DEFAULT 'upload1',
  `upload2` varchar(10) NOT NULL DEFAULT 'upload2',
  `upload3` varchar(10) NOT NULL DEFAULT 'upload3',
  `upload4` varchar(10) NOT NULL DEFAULT 'upload4',
  `upload5` varchar(10) NOT NULL DEFAULT 'upload5',
  `multiPic` varchar(10) NOT NULL DEFAULT '',
  `is_tj` varchar(10) NOT NULL DEFAULT '',
  `is_gd` varchar(10) NOT NULL DEFAULT '',
  `is_ab` varchar(10) NOT NULL DEFAULT '',
  `is_cd` varchar(10) NOT NULL DEFAULT '',
  `is_ef` varchar(10) NOT NULL DEFAULT '',
  `is_gh` varchar(10) NOT NULL DEFAULT '',
  `is_jk` varchar(10) NOT NULL DEFAULT '',
  `is_mn` varchar(10) NOT NULL DEFAULT '',
  `hits` varchar(10) NOT NULL DEFAULT '',
  `no_son` tinyint(1) NOT NULL,
  `category_title` varchar(10) NOT NULL,
  `category_title1` varchar(10) NOT NULL DEFAULT '',
  `category_title2` varchar(10) NOT NULL,
  `category_smallpic` varchar(10) NOT NULL,
  `category_bigpic` varchar(10) NOT NULL,
  `category_bremark` varchar(10) NOT NULL,
  `category_name1` varchar(10) NOT NULL,
  `category_name2` varchar(10) NOT NULL,
  `category_content1` varchar(10) NOT NULL,
  `category_content2` varchar(10) NOT NULL,
  `category_multipic` varchar(10) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `company` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `fax` varchar(10) NOT NULL,
  `pic` varchar(10) NOT NULL,
  `email` varchar(10) NOT NULL,
  `youbian` varchar(10) NOT NULL,
  `addr` varchar(10) NOT NULL,
  `title1_` varchar(255) NOT NULL,
  `title2_` varchar(255) NOT NULL,
  `title3_` varchar(255) NOT NULL,
  `title4_` varchar(255) NOT NULL,
  `title5_` varchar(255) NOT NULL,
  `title6_` varchar(255) NOT NULL,
  `title7_` varchar(255) NOT NULL,
  `title8_` varchar(255) NOT NULL,
  `title9_` varchar(255) NOT NULL,
  `title10_` varchar(255) NOT NULL,
  `created` varchar(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `deleted` int(10) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='MENU菜单表' AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `tcit_menu`
--

INSERT INTO `tcit_menu` (`id`, `lm_id`, `lm_name`, `menu_name`, `sort_no`, `action`, `function`, `manage`, `sort`, `grantword`, `database`, `use`, `allow_field`, `category`, `title`, `title1`, `title2`, `title3`, `title4`, `title5`, `title6`, `title7`, `title8`, `title9`, `title10`, `name1`, `name2`, `name3`, `name4`, `name5`, `content`, `content1`, `content2`, `content3`, `content4`, `content5`, `smallpic`, `bigpic`, `upload1`, `upload2`, `upload3`, `upload4`, `upload5`, `multiPic`, `is_tj`, `is_gd`, `is_ab`, `is_cd`, `is_ef`, `is_gh`, `is_jk`, `is_mn`, `hits`, `no_son`, `category_title`, `category_title1`, `category_title2`, `category_smallpic`, `category_bigpic`, `category_bremark`, `category_name1`, `category_name2`, `category_content1`, `category_content2`, `category_multipic`, `uname`, `company`, `phone`, `tel`, `fax`, `pic`, `email`, `youbian`, `addr`, `title1_`, `title2_`, `title3_`, `title4_`, `title5_`, `title6_`, `title7_`, `title8_`, `title9_`, `title10_`, `created`, `deleted`) VALUES
(1, 1000, '栏目名称', '菜单名称', 99, '控制器名', '方法名', 0, 0, '', '', 1, 'title', '所属类别', '标题名称', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '详细内容', '', '', '', '', '', '上传图片', '上传大图', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '浏览次数', 0, '类别名称', '', '', '', '', '', '', '', '', '', '', '姓名', '单位', '手机号', '电话号码', '传真', '图片', '电子邮件', '邮编', '地址', '', '', '', '', '', '', '', '', '', '', '添加时间', 1401085658),
(2, 1000, '数据库管理', '恢复数据库', 101, 'Other', 'dbrestore', 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 1401085767),
(3, 1000, '数据库管理', '备份数据库', 100, 'Other', 'dbbackup', 0, 0, 'Backup', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(4, 1000, '数据库管理', '系统初始化', 102, 'Other', 'dbinitialize', 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(5, 1000, '系统信息管理', '添加菜单', 200, 'Core', 'add', 1, 0, 'Core', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(6, 1000, '系统信息管理', '权限管理', 300, 'Core', 'grant', 0, 0, 'Grant', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(7, 1000, '系统信息管理', '用户权限管理', 301, 'Core', 'grant', 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(8, 1000, '系统信息管理', '系统信息查看', 209, 'Core', 'system', 0, 0, 'System', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(9, 1000, '系统信息管理', '添加用户', 201, 'User', 'add', 1, 0, 'User', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(10, 1000, '系统信息管理', '修改密码', 208, 'User', 'password', 0, 0, 'Password', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(11, 1, '测试栏目', '测试菜单', 1, 'News', 'add', 1, 1, 'add', 'news', 1, 'noadd,nodel,nomod,title,content,category,smallpic,bigpic,is_tj,is_gd,title1_select,content1,content2,name1,name2,hits,created,category_title,no_son,huifu,uname,company,phone', '所属类别', '标题名称', 'Title', 'Keywords', 'Descriptio', '', '', '', '', '', '', '', 'name1', 'name2', '', '', '', '详细内容', 'content1', 'content2', '', '', '', '上传图片', '上传大图', '', '', '', '', '', '', 'is_tj', 'is_gd', '', '', '', '', '', '', '浏览次数', 0, '类别名称', '', '', '', '', '', '', '', '', '', '', '姓名', 'company', 'phone', '', '', '', '', '', '', '作品展示|客片欣赏', '', '', '', '', '', '', '', '', '', '添加时间', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tcit_message`
--

CREATE TABLE IF NOT EXISTS `tcit_message` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `lmID` int(2) DEFAULT '0' COMMENT '栏目ID',
  `newsID` int(5) DEFAULT '0' COMMENT '所属文章ID',
  `msgID` int(11) DEFAULT '0',
  `uname` varchar(20) DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `youbian` int(6) DEFAULT NULL,
  `addr` varchar(100) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `content` text,
  `creatTime` int(10) DEFAULT NULL,
  `reContent` text,
  `reTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tcit_news`
--

CREATE TABLE IF NOT EXISTS `tcit_news` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `lmID` int(2) NOT NULL,
  `categoryID` int(2) DEFAULT NULL,
  `categorysID` int(2) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `title1` varchar(100) DEFAULT NULL,
  `title2` varchar(100) DEFAULT NULL,
  `title3` varchar(100) DEFAULT NULL,
  `title4` varchar(100) DEFAULT NULL,
  `title5` varchar(100) DEFAULT NULL,
  `title6` varchar(100) DEFAULT NULL,
  `title7` varchar(100) DEFAULT NULL,
  `title8` varchar(100) DEFAULT NULL,
  `title9` varchar(100) DEFAULT NULL,
  `title10` varchar(100) DEFAULT NULL,
  `name1` text,
  `name2` text,
  `name3` text,
  `name4` text,
  `name5` text,
  `content` text,
  `content1` text,
  `content2` text,
  `content3` text,
  `content4` text,
  `content5` text,
  `smallpic` varchar(50) DEFAULT NULL,
  `bigpic` varchar(50) DEFAULT NULL,
  `upload1` varchar(50) DEFAULT NULL,
  `upload2` varchar(50) DEFAULT NULL,
  `upload3` varchar(50) DEFAULT NULL,
  `upload4` varchar(50) DEFAULT NULL,
  `upload5` varchar(50) DEFAULT NULL,
  `multiPic` text,
  `is_tj` tinyint(1) DEFAULT NULL,
  `is_gd` tinyint(1) DEFAULT NULL,
  `is_ab` tinyint(1) DEFAULT NULL,
  `is_cd` tinyint(1) DEFAULT NULL,
  `is_ef` tinyint(1) DEFAULT NULL,
  `is_gh` tinyint(1) DEFAULT NULL,
  `is_jk` tinyint(1) DEFAULT NULL,
  `is_mn` tinyint(1) DEFAULT NULL,
  `hits` int(5) NOT NULL DEFAULT '0',
  `city` varchar(20) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `likeNews` int(5) DEFAULT NULL,
  `creatTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tcit_news`
--

INSERT INTO `tcit_news` (`id`, `lmID`, `categoryID`, `categorysID`, `title`, `title1`, `title2`, `title3`, `title4`, `title5`, `title6`, `title7`, `title8`, `title9`, `title10`, `name1`, `name2`, `name3`, `name4`, `name5`, `content`, `content1`, `content2`, `content3`, `content4`, `content5`, `smallpic`, `bigpic`, `upload1`, `upload2`, `upload3`, `upload4`, `upload5`, `multiPic`, `is_tj`, `is_gd`, `is_ab`, `is_cd`, `is_ef`, `is_gh`, `is_jk`, `is_mn`, `hits`, `city`, `area`, `likeNews`, `creatTime`) VALUES
(1, 1, NULL, NULL, '网站全局配置信息', '超凡知识产权代理有限公司', '超凡知识产权代理有限公司', '超凡知识产权代理有限公司', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1394761713),
(2, 4, 1, NULL, '作品展示', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/photo/201403/20140319_164601_6741.jpg', NULL, '/wedding/201403/20140317_170047_8116.jpg', NULL, NULL, NULL, NULL, '|/photo/201403/20140317_170053_7262.jpg||0\r\n\n|/photo/201403/20140317_170055_6235.jpg||0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395046325),
(3, 5, NULL, NULL, '梦幻场景', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '当斯卡拉大剧院的爱情剧目一次次的上演。王子对公主的宠爱依然让人艳羡。在韩国艺匠，模特化身王室的公主，等候着她的勇敢王子来到她的身边。飘渺的蕾丝婚纱配上韩国最火热的。', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '/scene/201403/20140317_174228_4384.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '|/scene/201403/20140317_174240_1752.jpg||0', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1395049312),
(4, 5, NULL, NULL, '场景梦幻', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '/scene/201403/20140318_092059_1908.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '|/scene/201403/20140318_092106_6222.jpg||0\n|/scene/201403/20140318_092107_5561.jpg||0\n|/scene/201403/20140318_092110_7611.jpg||0', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1395105635),
(5, 6, NULL, NULL, '梦幻套系', '12899', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '梦幻套系梦幻套系', NULL, NULL, NULL, NULL, NULL, '/price/201403/20140318_094224_2690.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1395106916),
(6, 6, NULL, NULL, '套餐名称2', '2999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '套餐名称2', NULL, NULL, NULL, NULL, NULL, '/price/201403/20140318_094258_2499.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1395106962),
(7, 7, 3, NULL, '热门新闻测试1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '热门新闻测试', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395107585),
(8, 7, 3, NULL, '热门新闻测试2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '热门新闻测试', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395107608),
(9, 3, NULL, NULL, 'baidu一下你就知道', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.baidu.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395108397),
(10, 3, NULL, NULL, '链接标题', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.google.com.cn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395108431),
(11, 2, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '#', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/201403/20140318_101341_8608.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1395108774),
(12, 2, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '#', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/201403/20140318_101358_1396.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1395108828),
(13, 8, NULL, NULL, '活动名称1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '标题名称标题名称', '', '', '', '', '', '/active/201403/20140318_103404_9798.jpg', '/active/201403/20140318_103407_1370.jpg', '/active/201403/20140318_103407_1370.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1395109976),
(14, 9, NULL, NULL, '关于我们', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '关于我们关于我们', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395110440),
(15, 9, NULL, NULL, '联系我们', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '联系我们', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1395110504),
(16, 8, NULL, NULL, '活动名称122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '活动名称122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, 1395221486);

-- --------------------------------------------------------

--
-- 表的结构 `tcit_user`
--

CREATE TABLE IF NOT EXISTS `tcit_user` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `grant` varchar(255) NOT NULL DEFAULT '' COMMENT '权限',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0禁用 1正常',
  `created` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tcit_user`
--

INSERT INTO `tcit_user` (`id`, `username`, `password`, `grant`, `status`, `created`, `lastdate`, `deleted`) VALUES
(1, 'cloud', '85b789dd35ccd43710c905d097732af1', '0', 1, 1391998314, 1391998314, 0),
(2, 'admin', '85b789dd35ccd43710c905d097732af1', '8', 1, 1391998314, 1391998314, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
