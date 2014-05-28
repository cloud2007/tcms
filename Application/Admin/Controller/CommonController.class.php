<?php

/**
 * 通用控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class CommonController extends \Think\Controller {

	function _initialize() {
		S(C('MEMBERCACHE_OPTIONS')); // 初始化缓存
	}

}

?>