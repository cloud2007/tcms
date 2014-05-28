<?php

/**
 * 登陆控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class LoginController extends CommonController {

	/**
	 * 登录主页面
	 * @author Cloud
	 * @since 2014-05-12
	 * @copyright TcitCMS
	 */
	function index() {
		if (cookie(C('COOKIE_ID_ADMIN')))
			$this->success('欢迎回来！', '/');
		$this->display();
	}

	/**
	 * 登陆
	 */
	function LoginAction() {
		$username = I('post.username');
		$password = I('post.password');
		if (!$username || !$password) {
			$this->error('用户名密码不能为空！');
		} else {
			$model = new \Common\Model\UserModel();
			$res = $model->LoginAction($username, $password);
		}
		if ($res === true) {
			$this->success('登录成功！');
		} else {
			$this->error($res);
		}
	}

}

?>