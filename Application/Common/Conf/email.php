<?php
/**
 * 邮件配置
 */
return array (
		'THINK_EMAIL' => array (
				'SMTP_HOST' => 'smtp.qq.com', // SMTP服务器
				'SMTP_PORT' => '465', // SMTP服务器端口
				'SMTP_USER' => '@qq.com', // SMTP服务器用户名
				'SMTP_PASS' => '', // SMTP服务器密码
				'FROM_EMAIL' => '@qq.com', // 发件人EMAIL
				'FROM_NAME' => 'Cloud', // 发件人名称
				'REPLY_EMAIL' => '', // 回复EMAIL（留空则为发件人EMAIL）
				'REPLY_NAME' => ''  //回复名称（留空则为发件人名称）
    )
);
?>