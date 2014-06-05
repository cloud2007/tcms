<?php

/**
 * 缓存配置文件
 */
return array(
	/* 系统配置 */
	'HOME_THEME_PATH' => 'Home', //前台PUBLIC文件夹名称
	'UPLOAD_PATH' => '/Public/Uploads',
	'WATERMARK' => '', //text or image

	/* SYSTEM COMMON CONFIG */
	'TMPL_ACTION_ERROR' => 'Common:error', // 正确跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Common:success', // 错误跳转对应的模板文件
	'AUTHCODE_KEY' => 'www.tcit123.com', //加密狗
	'AUTO_TURN_PAGE_TIME' => '3000', // 自动跳转页面默认时间(单位S)

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
	'SESSION_ID_HOME' => 'uid',
	'SESSION_CODE_HOME' => 'ucode',
	'COOKIE_ID_HOME' => 'uid',
	'COOKIE_CODE_HOME' => 'ucode', //

	/* MEMBER AUTH */
	'MEMBER_AUTH_CHECK' => '', //email , ''
	'MEMBER_AUTH_LIMIT' => '600', // 激活邮件过期时间
);
?>