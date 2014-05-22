<?php

/**
 * 日志类
 *
 * @author Andy
 * @since 2014-4-2 下午3:53:59
 * @copyright CHOFN
 */
namespace Common\Org;

class NLog {

	// 日志级别 从上到下，由低到高
	const EMERG = 'EMERG'; // 严重错误: 导致系统崩溃无法使用
	const ALERT = 'ALERT'; // 警戒性错误: 必须被立即修改的错误
	const CRIT = 'CRIT'; // 临界值错误: 超过临界值的错误，例如一天24小时，而输入的是25小时这样
	const ERR = 'ERR'; // 一般错误: 一般性错误
	const WARN = 'WARN'; // 警告性错误: 需要发出警告的错误
	const NOTICE = 'NOTIC'; // 通知: 程序可以运行但是还不够完美的错误
	const INFO = 'INFO'; // 信息: 程序输出信息
	const DEBUG = 'DEBUG'; // 调试: 调试信息
	const SQL = 'SQL'; // SQL：SQL语句 注意只在调试模式开启时有效

	// 日志记录方式
	const SYSTEM = 0;
	const MAIL = 1;
	const FILE = 3;
	const SAPI = 4;

	// 日志信息
	static $log = array ();

	// 日期格式
	static $format = '[Y-m-d H:s:i D]';

	/**
	 * 已文件形式记录日志
	 *
	 * @param unknown $message
	 *        	日志内容
	 * @param unknown $level
	 *        	日志级别
	 * @param string $extra
	 *        	额外参数
	 *
	 * @author Andy
	 * @since 2014-4-8 下午2:25:38
	 * @copyright CHOFN
	 */
	static function write($message, $destination = '', $level = self::ERR, $extra = '') {
		$now = date ( self::$format );

		if (empty ( $destination )) {
			$destination = C ( 'LOG_PATH' ) . date ( 'y_m_d' ) . '.log';
		} else {
			if (! preg_match ( '/$\//', $destination )) {
				$destination .= '/';
			}
			mkdir ( C ( 'LOG_PATH' ) . $destination );
			$destination = C ( 'LOG_PATH' ) . $destination . date ( 'y_m_d' ) . '.log';
		}
		if (! $level) {
			$level = self::INFO;
		}

		// 检测日志文件大小，超过配置大小则备份日志文件重新生成
		if (is_file ( $destination ) && floor ( C ( 'LOG_FILE_SIZE' ) ) <= filesize ( $destination )) {
			rename ( $destination, dirname ( $destination ) . '/' . time () . '-' . basename ( $destination ) );
		}
		error_log ( "{$now} {$level}: {$message}\r\n", self::FILE, $destination, $extra );
	}
}