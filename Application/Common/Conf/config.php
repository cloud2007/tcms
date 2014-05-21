<?php

return array(
	/* 覆盖惯例配置 */
	'MULTI_MODULE' => TRUE, // 是否允许多模块 如果为false 则必须设置 DEFAULT_MODULE
	'DEFAULT_MODULE' => 'Home', //默认配置

	/* 模块映射 */
	//'URL_MODULE_MAP' => array('manager' => 'admin'), //必须小写

	/* SYSTEM COMMON CONFIG */
	'TMPL_ACTION_ERROR' => 'Common:error', // 正确跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Common:success', // 错误跳转对应的模板文件
	'LOAD_EXT_CONFIG' => 'database,email,data', // 自动加载其他配置文件
	'AUTHCODE_KEY' => 'www.tcit123.com', //加密狗

	/* SYSTEM DEFAULET CONFIG */
	'ONLINE_LIMIT' => '999999', // 统计是否在线 超时时间(s)
	'PAGE_SIZE' => '20', // 默认分页尺寸
	'URL_CASE_INSENSITIVE' => true, // url 不区分大小写
	'URL_ROUTER_ON' => true, // 是否启用路由
	'URL_MODEL' => 2, // 如果你的环境不支持PATHINFO 请设置为3
	'URL_HTML_SUFFIX' => '.action', // url 路由页面后缀名
	'VERSOIN' => '1.0.0', // 系统版本
	'AUTO_TURN_PAGE_TIME' => '3000', // 自动跳转页面默认时间（单位S）
	'LANG_SWITCH_ON' => true, // 开启语言包功能
	'DOMAIN' => 'http://tcms.chofn.com', //站点的域名

	/* Cookie Session 设置 */
	'COOKIE_EXPIRE' => '', // Coodie有效期
	'COOKIE_DOMAIN' => '', // Cookie有效域名
	'COOKIE_PATH' => '/', // Cookie路径
	'COOKIE_PREFIX' => 'TCIT_', // Cookie前缀 避免冲突
	'SESSION_PREFIX' => 'TCIT_', // Session前缀 避免冲突

	/* 默认缓存设置 */
	'DATA_CACHE_TYPE' => 'file',
	'DATA_CACHE_PREFIX' => 'TCIT_',
	'DATA_CACHE_TIME' => 3600, //

	/* SYSTEM COOKIE SESSION */
	'SESSION_ID_ADMIN' => 'id',
	'SESSION_CODE_ADMIN' => 'code',
	'COOKIE_ID_ADMIN' => 'id',
	'COOKIE_CODE_ADMIN' => 'code', //

	/* CopyRight */
	'DEFAUIT_SYSTEM_TITLE' => 'TcitCMS', // 默认的系统标题
	'DEFAUIT_SYSTEM_TARGET' => 'http://www.tcit123.com', // 默认的系统链接
);
?>