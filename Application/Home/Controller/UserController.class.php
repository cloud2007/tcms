<?php

/**
 * 会员控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class UserController extends CommonController {

	function index() {
		if (cookie(C('COOKIE_ID_HOME')))
			$this->success('欢迎回来!', U('Member/index'));
		else
			$this->error('请登录!', U('User/login'));
	}

	function login() {
		if (IS_POST) {
			$username = I('post.username');
			$password = I('post.password');
			$model = new \Common\Model\MemberModel();
			$res = $model->LoginAction($username, $password);
			if ($res === true)
				$this->success('登录成功!', U('Member/index'));
			else
				$this->error($res);
		}
		$this->display();
	}

	function register() {
		if (IS_POST) {
			if (I('post.password', '', 'trim') != I('post.password2', '', 'trim'))
				$this->error('两次输入的密码不一致!');
			$model = new \Common\Model\MemberModel();
			if ($model->create()) {
				$id = $model->add();
				if (C('MEMBER_AUTH_CHECK') == 'email') {
					$data = $this->authCode($id);
					$this->success('用户注册成功,收到邮件' . (int) (C('MEMBER_AUTH_LIMIT') / 60) . '分钟内请激活!', U('Member/index'));
				} else {
					$model->where('`id`=' . $id)->setField('status', 1);
					$this->success('用户注册成功!', U('Member/index'));
				}
			} else {
				$this->error($model->getError());
			}
		}
		$this->display();
	}

	private function authCode($id) {
		$model = new \Common\Model\MemberModel();
		$data = $model->find($id);
		$id = $data['id'];
		$username = $data['username'];
		$email = $data['email'];
		$domain = $_SERVER['HTTP_HOST'];
		$param = \Common\Org\Util::authcode($id . '\t' . NOW_TIME, 'ENCODE');
		$url = $domain . U('Member/auth') . '?param=' . urlencode($param);
		\Common\Org\Util::SendMail($email, $username, '用户激活邮件', '请点击' . $url . ' 继续操作。<br/>如无法点击请复制链接到浏览器地址栏继续操作。<br/>该链接' . (int) (C('MEMBER_AUTH_LIMIT') / 60) . '分钟有效。');
		return;
	}

	function auth() {
		$param = I('get.param', '', 'trim');
		$param = urldecode(\Common\Org\Util::authcode($param, 'DECODE'));
		list($id, $time) = explode('\t', $param);
		if ($id && (NOW_TIME - $time) < C('MEMBER_AUTH_LIMIT')) {
			$model = new \Common\Model\MemberModel();
			$model->where('`id`=' . $id)->setField('status', 1);
			$this->success('用户激活成功!', U('Member/index'));
		}else
			$this->success('用户激活失败,可能链接已经失效,请重试!', U('Member/index'));
	}

}

?>