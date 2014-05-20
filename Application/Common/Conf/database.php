<?php

/**
 * 数据库连接配置文件
 */
return array(
	/* 数据库配置 */
	'DB_TYPE' => 'mysql', // 数据库类型
	'DB_HOST' => '127.0.0.1', // 服务器地址
	'DB_NAME' => 'korea', // 数据库名
	'DB_USER' => 'root', // 用户名
	'DB_PWD' => '', // 密码
	'DB_PORT' => '3306', // 端口
	'DB_PREFIX' => 'tcit_', // 数据库表前缀

	'LOCAL_MYSQL_CONNECTION' => array(
		'db_type' => 'mysql',
		'db_host' => '127.0.0.1',
		'db_port' => '3306',
		'db_user' => 'korea',
		'db_pwd' => 'root',
		'db_name' => ''
	),
	'SERVER_MYSQL_CONNECTION' => array(
		'db_type' => 'mysql',
		'db_host' => '127.0.0.1',
		'db_port' => '3306',
		'db_user' => 'root',
		'db_pwd' => 'korea',
		'db_name' => ''
	)
);
?>