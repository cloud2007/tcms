/* This file is created by TcitCMS.MySQLReback 2014-06-12 09:44:20 */
 /* 创建表结构 `tcit_category` */
 DROP TABLE IF EXISTS `tcit_category`;/* MySQLReback Separation */ CREATE TABLE `tcit_category` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='类别表';/* MySQLReback Separation */
 /* 插入数据 `tcit_category` */
 INSERT INTO `tcit_category` VALUES ('1','1','0','0','公司新闻','','','','','','','','','','','1402309183','0','0'),('2','1','0','2','行业资讯','','','','','','','','','','','0','0','0'),('3','1','1','0','公司动态','','','','','','/test/201405/20140530_100514_2700.jpg','','','','|/test/201405/20140530_100832_7104.jpg||0
|/test/201405/20140530_100833_1477.jpg||0
|/test/201405/20140530_100834_6751.jpg||0','0','0','0'),('4','1','1','0','公司业务','','','','','','','','','','','0','0','0'),('5','1','2','0','行业快递','','','','','','','','','','','0','0','0');/* MySQLReback Separation */
 /* 创建表结构 `tcit_grant` */
 DROP TABLE IF EXISTS `tcit_grant`;/* MySQLReback Separation */ CREATE TABLE `tcit_grant` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `tcit_grant` */
 INSERT INTO `tcit_grant` VALUES ('1','ALL','管理员','1'),('2','User','用户管理','1'),('3','Password','用户名和密码','1'),('4','Backup','数据库管理','1'),('5','add','添加信息','1');/* MySQLReback Separation */
 /* 创建表结构 `tcit_member` */
 DROP TABLE IF EXISTS `tcit_member`;/* MySQLReback Separation */ CREATE TABLE `tcit_member` (
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `tcit_member` */
 INSERT INTO `tcit_member` VALUES ('37','2','3293304','','c4ca4238a0b923820dcc509a6f75849b','','','0','','','','','190296465@qq.com','0','1','0','1401957559','0','1402043591'),('38','2','112611405','','c4ca4238a0b923820dcc509a6f75849b','','','1','','','','','190296465@qq.com','0','1','0','1401961228','0','0'),('39','2','110794204','gary','21218','','','1','18180820312','13888888888','成都市大业路10号','','190296465@qq.com','610000','0','0','1401961456','0','0');/* MySQLReback Separation */
 /* 创建表结构 `tcit_menu` */
 DROP TABLE IF EXISTS `tcit_menu`;/* MySQLReback Separation */ CREATE TABLE `tcit_menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='MENU菜单表';/* MySQLReback Separation */
 /* 插入数据 `tcit_menu` */
 INSERT INTO `tcit_menu` VALUES ('1','1000','栏目名称','菜单名称','99','控制器名','方法名','0','0','0','','','1','title','所属类别','标题名称','','','','','','','','','','','','','','','','详细内容','','','','','','上传图片','上传大图','','','','','','','','','','','','','','','浏览次数','0','类别名称','','','','','','','','','','','姓名','单位','手机号','电话号码','传真','图片','电子邮件','邮编','地址','','','','','','','','','','','','','','添加时间','0'),('2','1000','系统参数','数据库管理','101','Database','index','0','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('3','1000','系统参数','系统初始化','102','Database','initialize','0','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('4','1000','系统参数','参数配置','100','Setting','index','0','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('5','1000','系统信息管理','添加菜单','200','Core','add','1','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('6','1000','','','0','','','0','0','0','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('7','1000','','','0','','','0','0','0','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('8','1000','系统信息管理','系统信息查看','209','Core','system','0','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('9','1000','系统信息管理','添加用户','201','User','add','1','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('10','1000','系统信息管理','修改密码','208','User','password','0','0','0','','','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','添加时间','0'),('11','1','测试栏目','添加','1','News','add','1','1','1','','','1','title,content,category,smallpic,bigpic,is_tj,is_gd,title1,title1_select,title2,title2_select,title2_check,title3,content1,content2,name1,name2,upload1,upload2,multipic,is_cd,hits,created,category_title,category_title1,category_title2,category_smallpic,category_bigpic,category_bremark,category_name1,category_name2,category_content1,category_content2,category_multipic','所属类别','标题名称','Title','Keywords','Descriptio','','','','','','','','name1','name2','','','','详细内容','content1','content2','','','','上传图片','上传大图','upload1','upload2','','','','多图上传','is_tj','is_gd','','is_cd','','','','','浏览次数','0','类别名称','category_t','category_t','category_s','category_b','category_b','category_n','category_n','category_c','category_c','category_m','姓名','company','phone','','','','','','','作品展示|客片欣赏','作品展示|客片欣赏','','','','','','','','','TITLE','KEYWORDS','DESCRIPTION','添加时间','0');/* MySQLReback Separation */
 /* 插入数据 `tcit_menu` */
 INSERT INTO `tcit_menu` VALUES ('31','2','会员管理','管理','2','Member','index','0','1','0','','','1','category_title,category_title1,category_bigpic,category_name2,category_content2,category_multipic','所属类别','标题名称','','','','','','','','','','','','','','','','详细内容','','','','','','上传图片','上传大图','','','','','','','','','','','','','','','浏览次数','0','类别名称','category_t','','','category_b','','','category_n','','category_c','category_m','姓名','单位','手机号','电话号码','传真','图片','电子邮件','邮编','地址','','','','','','','','','','','1','222','222','添加时间','0');/* MySQLReback Separation */
 /* 插入数据 `tcit_menu` */
 INSERT INTO `tcit_menu` VALUES ('32','3','在线反馈','管理','3','Message','index','0','0','0','','','1','created,huifu,uname,company,phone,tel,fax,pic,email,youbian,addr','','留言标题','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','','姓名','company','phone','tel','fax','pic','email','youbian','addr','','','','','','','','','','','','','','反馈时间','0');/* MySQLReback Separation */
 /* 创建表结构 `tcit_message` */
 DROP TABLE IF EXISTS `tcit_message`;/* MySQLReback Separation */ CREATE TABLE `tcit_message` (
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
  `re_content` text NOT NULL,
  `redate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `tcit_message` */
 INSERT INTO `tcit_message` VALUES ('1','3','0','51374572','','18180820312','','','','190296465@qq.com','0','','','1402285666','1402285808','','0'),('2','3','0','400288','','18180820312','','','','190296465@qq.com','0','','','1402285808','1402285808','','0'),('3','3','0','94721450','','18180820312','','','','190296465@qq.com','0','','','1402285808','1402285809','','0'),('4','3','0','58736047','','18180820312','','','','190296465@qq.com','0','','','1402285809','1402285809','','0'),('5','3','0','53937187','','18180820312','13888888888','','','190296465@qq.com','0','','','1402285809','1402303589','','0'),('6','3','0','53937187','','18180820312','','','','190296465@qq.com','0','','','1402285809','1402303890','sdf','0'),('7','3','0','53937187','','18180820312','13888888888','','','190296465@qq.com','0','','','1402285809','1402303894','sa','0'),('8','3','0','10948915','','18180820312','13888888888','','','190296465@qq.com','0','','','1402285845','1402303898','asd','0'),('9','3','0','101627617','','18180820312','','','','190296465@qq.com','0','11','','1402285845','0','','0'),('10','3','0','1111','','18180820312','','','','190296465@qq.com','0','','','1402285846','0','','0'),('11','3','0','7528066','','18180820312','','','','190296465@qq.com','0','','','1402285846','0','1212','0'),('12','3','0','58288798','','18180820312','','','','190296465@qq.com','0','','','1402286040','0','1212','0'),('13','3','0','102796105','','18180820312','','','','190296465@qq.com','0','','','1402303654','0','','0'),('14','3','0','43082336','','18180820312','','','','190296465@qq.com','0','','','1402303711','1402303712','','0'),('15','3','0','51443070','','18180820312','','','','190296465@qq.com','0','','','1402303721','1402303722','','0');/* MySQLReback Separation */
 /* 创建表结构 `tcit_news` */
 DROP TABLE IF EXISTS `tcit_news`;/* MySQLReback Separation */ CREATE TABLE `tcit_news` (
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
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `creater` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `tcit_news` */
 INSERT INTO `tcit_news` VALUES ('1','1','1','网站全局配置信息1','超凡知识产权代理有限公司','超凡知识产权代理有限公司','超凡知识产权代理有限公司','','','','','','','','','','','','','','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1394761713','0'),('2','1','1','作品展示1','','','','','','','','','','','','','','','','','','','','','','/photo/201403/20140319_164601_6741.jpg','','/wedding/201403/20140317_170047_8116.jpg','','','','','|/photo/201403/20140317_170053_7262.jpg||0

|/photo/201403/20140317_170055_6235.jpg||0','0','0','0','0','0','0','0','0','0','','','0','1395046325','0'),('3','1','1','梦幻场景1','','','','','','','','','','','当斯卡拉大剧院的爱情剧目一次次的上演。王子对公主的宠爱依然让人艳羡。在韩国艺匠，模特化身王室的公主，等候着她的勇敢王子来到她的身边。飘渺的蕾丝婚纱配上韩国最火热的。','','','','','','','','','','','/scene/201403/20140317_174228_4384.jpg','','','','','','','|/scene/201403/20140317_174240_1752.jpg||0','1','0','0','0','0','0','0','0','1','','','0','1395049312','0'),('4','1','1','场景梦幻1','','','','','','','','','','','场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻场景梦幻','','','','','','','','','','','/scene/201403/20140318_092059_1908.jpg','','','','','','','|/scene/201403/20140318_092106_6222.jpg||0
|/scene/201403/20140318_092107_5561.jpg||0
|/scene/201403/20140318_092110_7611.jpg||0','0','0','0','0','0','0','0','0','1','','','0','1395105635','0'),('5','1','1','梦幻套系1','12899','','','','','','','','','','','','','','','梦幻套系梦幻套系','','','','','','/price/201403/20140318_094224_2690.jpg','','','','','','','','0','0','0','0','0','0','0','0','1','','','0','1395106916','0'),('6','1','1','套餐名称21','2999','','','','','','','','','','','','','','','套餐名称2','','','','','','/price/201403/20140318_094258_2499.jpg','','','','','','','','0','0','0','0','0','0','0','0','2','','','0','1395106962','0'),('7','1','1','热门新闻测试11','','','','','','','','','','','','','','','','热门新闻测试','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395107585','0'),('8','1','1','热门新闻测试21','','','','','','','','','','','','','','','','热门新闻测试','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395107608','0'),('9','1','1','baidu一下你就知道1','','','','','','','','','','','','','','http://www.baidu.com','','','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395108397','0'),('10','1','1','链接标题1','','','','','','','','','','','','','','http://www.google.com.cn','','','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395108431','0'),('11','1','1','11','','','','','','','','','','','','','','#','','','','','','','','/201403/20140318_101341_8608.jpg','','','','','','','','0','0','0','0','0','0','0','0','1','','','0','1395108774','0'),('12','1','1','21','','','','','','','','','','','','','','#','','','','','','','','/201403/20140318_101358_1396.jpg','','','','','','','','0','0','0','0','0','0','0','0','2','','','0','1395108828','0'),('13','1','1','活动名称1','作品展示','作品展示','','','','','','','','','','','','','','标题名称标题名称','','','','','','/active/201403/20140318_103404_9798.jpg','/active/201403/20140318_103407_1370.jpg','/active/201403/20140318_103407_1370.jpg','','','','','','1','0','0','0','0','0','0','0','1','','','0','1395109976','0'),('14','1','1','关于我们1','','','','','','','','','','','','','','','','关于我们关于我们','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395110440','0'),('15','1','1','联系我们1','','','','','','','','','','','','','','','','联系我们','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395110504','0'),('16','1','1','活动名称1221','作品展示','作品展示','','','','','','','','','1212','','','','','活动名称122','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','12','','','0','1395110504','0'),('17','1','1','171','作品展示','作品展示','222','','','','','','','','111','','','','','','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','2014','0'),('18','1','1','real test data1','客片欣赏','作品展示','','','','','','','','','11','','','','','','','','','','','/test/201405/20140530_100755_6516.jpg','','','/test/201405/20140530_100757_1876.jpg','','','','|/test/201405/20140529_105441_8875.jpg||0
|/test/201405/20140529_105442_7765.jpg||0
|/test/201405/20140529_105443_1456.jpg||0','0','0','0','1','0','0','0','0','0','','','0','1395221486','0');/* MySQLReback Separation */
 /* 插入数据 `tcit_news` */
 INSERT INTO `tcit_news` VALUES ('19','1','1','12121','客片欣赏','客片欣赏','','','','','','','','','11','','','','','','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1395221486','0');/* MySQLReback Separation */
 /* 插入数据 `tcit_news` */
 INSERT INTO `tcit_news` VALUES ('20','1','2','12121','作品展示','作品展示','','','','','','','','','','','','','','','','','','','','','','','','','','','','0','0','0','0','0','0','0','0','0','','','0','1402303959','0');/* MySQLReback Separation */
 /* 创建表结构 `tcit_setting` */
 DROP TABLE IF EXISTS `tcit_setting`;/* MySQLReback Separation */ CREATE TABLE `tcit_setting` (
  `key` varchar(50) NOT NULL DEFAULT '',
  `text` varchar(10) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `tcit_setting` */
 INSERT INTO `tcit_setting` VALUES ('title','网站标题','超凡知识产权代理有限公司');/* MySQLReback Separation */
 /* 创建表结构 `tcit_user` */
 DROP TABLE IF EXISTS `tcit_user`;/* MySQLReback Separation */ CREATE TABLE `tcit_user` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `grant` varchar(255) NOT NULL COMMENT '权限',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0禁用 1正常',
  `created` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='用户表';/* MySQLReback Separation */
 /* 插入数据 `tcit_user` */
 INSERT INTO `tcit_user` VALUES ('1','cloud','85b789dd35ccd43710c905d097732af1','0','1','1391998314','1391998314','0'),('2','admin','21232f297a57a5a743894a0e4a801fc3','0','1','1391998314','1391998314','0');/* MySQLReback Separation */