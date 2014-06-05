<?php

/**
 * 缓存配置文件
 */
return array(
	/* 系统配置 */
	'ADMIN_THEME_PATH' => 'Admin', //后台PUBLIC文件夹名称
	'DEFAULT_PASSWORD' => '888888', //后台用户重置默认密码
	'UPLOAD_PATH' => '/Public/Uploads',
	'WATERMARK' => 'text', //text or image

	/* SYSTEM COMMON CONFIG */
	'TMPL_ACTION_ERROR' => 'Common:error', // 正确跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Common:success', // 错误跳转对应的模板文件
	'AUTHCODE_KEY' => 'www.tcit123.com', //加密狗
	'VERSOIN' => '1.0.0', // 系统版本
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
	'SESSION_ID_ADMIN' => 'id',
	'SESSION_CODE_ADMIN' => 'code',
	'COOKIE_ID_ADMIN' => 'id',
	'COOKIE_CODE_ADMIN' => 'code', //

	/* CopyRight */
	'DEFAUIT_SYSTEM_TITLE' => 'TcitCMS', // 默认的系统标题
	'DEFAUIT_SYSTEM_TARGET' => 'http://www.tcit123.com', // 默认的系统链接
);
?>