-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 06 月 27 日 09:58
-- 服务器版本: 5.1.28
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tcit_tcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `tcit_category`
--

CREATE TABLE IF NOT EXISTS `tcit_category` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `lm_id` int(5) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(5) unsigned NOT NULL DEFAULT '0',
  `sort` int(5) unsigned NOT NULL DEFAULT '0',
  `category_title` varchar(50) NOT NULL DEFAULT '',
  `category_title1` varchar(50) NOT NULL DEFAULT '',
  `category_title2` varchar(50) NOT NULL DEFAULT '',
  `category_bremark` varchar(50) NOT NULL DEFAULT '',
  `category_name1` text NOT NULL,
  `category_name2` text NOT NULL,
  `category_smallpic` varchar(255) NOT NULL DEFAULT '',
  `category_bigpic` varchar(255) NOT NULL DEFAULT '',
  `category_content1` text NOT NULL,
  `category_content2` text NOT NULL,
  `category_multipic` text NOT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` int(10) unsigned NOT NULL DEFAULT '0',
  `creater` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类别表' AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tcit_member`
--

CREATE TABLE IF NOT EXISTS `tcit_member` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `lm_id` int(2) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `realname` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  `vcode` varchar(4) NOT NULL DEFAULT '',
  `grant` varchar(50) NOT NULL DEFAULT '' COMMENT '权限 用“|”分隔多个权限',
  `sex` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0保密1男2女',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `addr` varchar(100) NOT NULL DEFAULT '',
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(20) NOT NULL DEFAULT '',
  `youbian` int(6) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0未激活1正常',
  `locked` int(10) NOT NULL DEFAULT '0' COMMENT '锁定时间',
  `created` int(10) NOT NULL DEFAULT '0',
  `lastdate` int(10) NOT NULL DEFAULT '0',
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tcit_menu`
--

CREATE TABLE IF NOT EXISTS `tcit_menu` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `lm_id` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `lm_name` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单标题',
  `menu_name` varchar(20) NOT NULL DEFAULT '' COMMENT '项目标题',
  `sort_no` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  `action` varchar(100) NOT NULL DEFAULT '' COMMENT '功能链接',
  `function` varchar(100) NOT NULL DEFAULT '' COMMENT '管理链接',
  `manage` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否创建管理链接',
  `seo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否创建SEO链接',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用排序',
  `grantword` varchar(10) NOT NULL DEFAULT '' COMMENT '权限',
  `database` varchar(10) NOT NULL DEFAULT '' COMMENT '数据库',
  `use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用',
  `allow_field` text NOT NULL,
  `category` varchar(10) NOT NULL DEFAULT '' COMMENT '所属类别',
  `title` varchar(10) NOT NULL DEFAULT '' COMMENT '标题名称',
  `title1` varchar(10) NOT NULL DEFAULT '',
  `title2` varchar(10) NOT NULL DEFAULT '',
  `title3` varchar(10) NOT NULL DEFAULT '',
  `title4` varchar(10) NOT NULL DEFAULT '',
  `title5` varchar(10) NOT NULL DEFAULT '',
  `title6` varchar(10) NOT NULL DEFAULT '',
  `title7` varchar(10) NOT NULL DEFAULT '',
  `title8` varchar(10) NOT NULL DEFAULT '',
  `title9` varchar(10) NOT NULL DEFAULT '',
  `title10` varchar(10) NOT NULL DEFAULT '',
  `name1` varchar(10) NOT NULL DEFAULT '',
  `name2` varchar(10) NOT NULL DEFAULT '',
  `name3` varchar(10) NOT NULL DEFAULT '',
  `name4` varchar(10) NOT NULL DEFAULT '',
  `name5` varchar(10) NOT NULL DEFAULT '',
  `content` varchar(10) NOT NULL DEFAULT '',
  `content1` varchar(10) NOT NULL DEFAULT '',
  `content2` varchar(10) NOT NULL DEFAULT '',
  `content3` varchar(10) NOT NULL DEFAULT '',
  `content4` varchar(10) NOT NULL DEFAULT '',
  `content5` varchar(10) NOT NULL DEFAULT '',
  `smallpic` varchar(10) NOT NULL DEFAULT '',
  `bigpic` varchar(10) NOT NULL DEFAULT '',
  `upload1` varchar(10) NOT NULL DEFAULT '',
  `upload2` varchar(10) NOT NULL DEFAULT '',
  `upload3` varchar(10) NOT NULL DEFAULT '',
  `upload4` varchar(10) NOT NULL DEFAULT '',
  `upload5` varchar(10) NOT NULL DEFAULT '',
  `multipic` varchar(10) NOT NULL DEFAULT '',
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
  `category_content2` varchar(10) NOT NULL DEFAULT '',
  `category_multipic` varchar(10) NOT NULL DEFAULT '',
  `uname` varchar(10) NOT NULL DEFAULT '',
  `company` varchar(10) NOT NULL DEFAULT '',
  `phone` varchar(10) NOT NULL DEFAULT '',
  `tel` varchar(10) NOT NULL DEFAULT '',
  `fax` varchar(10) NOT NULL DEFAULT '',
  `pic` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(10) NOT NULL DEFAULT '',
  `youbian` varchar(10) NOT NULL DEFAULT '',
  `addr` varchar(10) NOT NULL DEFAULT '',
  `title1_` varchar(255) NOT NULL DEFAULT '',
  `title2_` varchar(255) NOT NULL DEFAULT '',
  `title3_` varchar(255) NOT NULL DEFAULT '',
  `title4_` varchar(255) NOT NULL DEFAULT '',
  `title5_` varchar(255) NOT NULL DEFAULT '',
  `title6_` varchar(255) NOT NULL DEFAULT '',
  `title7_` varchar(255) NOT NULL DEFAULT '',
  `title8_` varchar(255) NOT NULL DEFAULT '',
  `title9_` varchar(255) NOT NULL DEFAULT '',
  `title10_` varchar(255) NOT NULL DEFAULT '',
  `seo_title` varchar(255) NOT NULL DEFAULT '',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '',
  `seo_description` varchar(255) NOT NULL DEFAULT '',
  `created` varchar(10) NOT NULL DEFAULT '' COMMENT '添加时间',
  `deleted` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='MENU菜单表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `tcit_menu`
--

INSERT INTO `tcit_menu` (`id`, `lm_id`, `lm_name`, `menu_name`, `sort_no`, `action`, `function`, `manage`, `seo`, `sort`, `grantword`, `database`, `use`, `allow_field`, `category`, `title`, `title1`, `title2`, `title3`, `title4`, `title5`, `title6`, `title7`, `title8`, `title9`, `title10`, `name1`, `name2`, `name3`, `name4`, `name5`, `content`, `content1`, `content2`, `content3`, `content4`, `content5`, `smallpic`, `bigpic`, `upload1`, `upload2`, `upload3`, `upload4`, `upload5`, `multipic`, `is_tj`, `is_gd`, `is_ab`, `is_cd`, `is_ef`, `is_gh`, `is_jk`, `is_mn`, `hits`, `no_son`, `category_title`, `category_title1`, `category_title2`, `category_smallpic`, `category_bigpic`, `category_bremark`, `category_name1`, `category_name2`, `category_content1`, `category_content2`, `category_multipic`, `uname`, `company`, `phone`, `tel`, `fax`, `pic`, `email`, `youbian`, `addr`, `title1_`, `title2_`, `title3_`, `title4_`, `title5_`, `title6_`, `title7_`, `title8_`, `title9_`, `title10_`, `seo_title`, `seo_keywords`, `seo_description`, `created`, `deleted`) VALUES
(1, 99, '栏目名称', '菜单名称', 99, '控制器名', '方法名', 0, 0, 0, '', '', 1, 'title', '所属类别', '标题名称', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '详细内容', '', '', '', '', '', '上传图片', '上传大图', '', '', '', '', '', '', '推荐', '置顶', '', '', '', '', '', '', '浏览次数', 0, '类别名称', '', '', '', '', '', '', '', '', '', '', '姓名', '单位', '手机号', '电话号码', '传真', '图片', '电子邮件', '邮编', '地址', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(2, 101, '系统参数', '数据库管理', 101, 'Database', 'index', 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(3, 102, '系统参数', '系统初始化', 102, 'Database', 'initialize', 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(4, 100, '系统参数', '参数配置', 100, 'Setting', 'index', 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(5, 200, '系统信息管理', '添加菜单', 200, 'Core', 'add', 1, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(6, 301, '系统信息管理', '回收站', 301, 'Recycle', 'index', 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
(7, 0, '', '', 0, '', '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
(8, 209, '系统信息管理', '系统信息查看', 209, 'Core', 'system', 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(9, 201, '系统信息管理', '添加用户', 201, 'User', 'add', 1, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(10, 208, '系统信息管理', '修改密码', 208, 'User', 'password', 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0),
(11, 1, '测试栏目', '添加', 1, 'News', 'add', 1, 0, 1, '', '', 1, 'title,content', '', '标题名称', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '详细内容', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '添加时间', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tcit_message`
--

CREATE TABLE IF NOT EXISTS `tcit_message` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `lm_id` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `news_id` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '所属文章ID',
  `uname` varchar(20) NOT NULL,
  `company` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `youbian` int(6) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` int(10) NOT NULL DEFAULT '0',
  `re_content` text NOT NULL,
  `redate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tcit_news`
--

CREATE TABLE IF NOT EXISTS `tcit_news` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `lm_id` int(2) unsigned NOT NULL DEFAULT '0',
  `category` int(2) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `title1` varchar(100) NOT NULL DEFAULT '',
  `title2` varchar(100) NOT NULL DEFAULT '',
  `title3` varchar(100) NOT NULL DEFAULT '',
  `title4` varchar(100) NOT NULL DEFAULT '',
  `title5` varchar(100) NOT NULL DEFAULT '',
  `title6` varchar(100) NOT NULL DEFAULT '',
  `title7` varchar(100) NOT NULL DEFAULT '',
  `title8` varchar(100) NOT NULL DEFAULT '',
  `title9` varchar(100) NOT NULL DEFAULT '',
  `title10` varchar(100) NOT NULL DEFAULT '',
  `name1` text NOT NULL,
  `name2` text NOT NULL,
  `name3` text NOT NULL,
  `name4` text NOT NULL,
  `name5` text NOT NULL,
  `content` text NOT NULL,
  `content1` text NOT NULL,
  `content2` text NOT NULL,
  `content3` text NOT NULL,
  `content4` text NOT NULL,
  `content5` text NOT NULL,
  `smallpic` varchar(100) NOT NULL DEFAULT '',
  `bigpic` varchar(100) NOT NULL DEFAULT '',
  `upload1` varchar(100) NOT NULL DEFAULT '',
  `upload2` varchar(100) NOT NULL DEFAULT '',
  `upload3` varchar(100) NOT NULL DEFAULT '',
  `upload4` varchar(100) NOT NULL DEFAULT '',
  `upload5` varchar(100) NOT NULL DEFAULT '',
  `multipic` text NOT NULL,
  `is_tj` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_gd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_ab` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_cd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_ef` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_gh` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_jk` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_mn` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(5) unsigned NOT NULL DEFAULT '0',
  `city` varchar(20) NOT NULL DEFAULT '',
  `area` varchar(20) NOT NULL DEFAULT '',
  `news_id` int(5) unsigned NOT NULL DEFAULT '0',
  `sort` int(5) NOT NULL DEFAULT '0',
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` int(10) NOT NULL DEFAULT '0',
  `creater` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tcit_news`
--

INSERT INTO `tcit_news` (`id`, `lm_id`, `category`, `title`, `title1`, `title2`, `title3`, `title4`, `title5`, `title6`, `title7`, `title8`, `title9`, `title10`, `name1`, `name2`, `name3`, `name4`, `name5`, `content`, `content1`, `content2`, `content3`, `content4`, `content5`, `smallpic`, `bigpic`, `upload1`, `upload2`, `upload3`, `upload4`, `upload5`, `multipic`, `is_tj`, `is_gd`, `is_ab`, `is_cd`, `is_ef`, `is_gh`, `is_jk`, `is_mn`, `hits`, `city`, `area`, `news_id`, `sort`, `created`, `deleted`, `creater`) VALUES
(1, 1, 0, '11', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '&lt;strong&gt;123&lt;/strong&gt;', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 1403855567, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tcit_setting`
--

CREATE TABLE IF NOT EXISTS `tcit_setting` (
  `key` varchar(50) NOT NULL DEFAULT '',
  `text` varchar(10) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tcit_setting`
--

INSERT INTO `tcit_setting` (`key`, `text`, `value`) VALUES
('title', '网站标题(勿删)', '网站标题(勿删)'),
('keywords', '网站关键字(勿删)', '网站关键字(勿删)'),
('description', '网站描述(勿删)', '网站描述(勿删)');

-- --------------------------------------------------------

--
-- 表的结构 `tcit_user`
--

CREATE TABLE IF NOT EXISTS `tcit_user` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `grant` varchar(255) NOT NULL COMMENT '权限',
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
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0', 1, 1391998314, 1391998314, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
