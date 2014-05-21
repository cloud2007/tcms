<?php

/**
 * 通用控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class CommonController extends \Think\Controller {

	function _initialize() {
		S(C('MEMBERCACHE_OPTIONS')); // 初始化缓存
	}

	/**
	 * 退出登陆
	 */
	function LoginOut() {
		$model = new \Common\Model\UserModel();
		$model->loginOut;
		$this->redirect(U('login/index', '', false));
	}

}

?>