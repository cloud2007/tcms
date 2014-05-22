<?php

/**
 * 用户模型  用于被继承或写模型通用方法
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class UserModel extends CommonModel {

	private $userID = '';
	private $userCode = '';

	/**
	 * 初始化
	 */
	public function _initialize() {
		$session_userid = session(C('SESSION_ID_ADMIN'));
		$cookie_userid = cookie(C('COOKIE_ID_ADMIN'));

		if (!$session_userid && !$cookie_userid && $session_userid != $cookie_userid) {
			$this->loginOut();
		}
		if ($session_userid) {
			$this->userID = session(C('SESSION_ID_ADMIN'));
			$this->userCode = session(C('SESSION_CODE_ADMIN'));
		}
		if ($cookie_userid) {
			$this->userID = cookie(C('COOKIE_ID_ADMIN'));
			$this->userCode = cookie(C('COOKIE_CODE_ADMIN'));
		}
	}

	/**
	 * 登陆
	 */
	function loginAction($username, $password) {
		if (!$username || !$password) {
			return '用户名密码不能为空！';
		} else {
			$map['username'] = array('eq', $username);
			$res = $this->where($map)->find();
			if ($res) {
				if ($res['password'] == md5($password)) {
					session(C('SESSION_ID_ADMIN'), $res['id']);
					session(C('SESSION_CODE_ADMIN'), \Common\Org\Util::authcode(md5($res['id'] . $res['username'] . $res['password']), 'ENCODE'));
					if ($_POST['remember'] == 1) {
						cookie(C('COOKIE_ID_ADMIN'), $res['id'], time() + 3600 * 24, '/');
						cookie(C('COOKIE_CODE_ADMIN'), \Common\Org\Util::authcode(md5($res['id'] . $res['username'] . $res['password']), 'ENCODE'), time() + 3600 * 24, '/');
					} else {
						cookie(C('COOKIE_ID_ADMIN'), null);
						cookie(C('COOKIE_CODE_ADMIN'), null);
					}
					return true;
				} else {
					return '密码错误！';
				}
			} else {
				$this->loginOut();
				return '无此用户!';
			}
		}
		return false;
	}

	/**
	 * 判断登陆信息是否合法
	 * @return array 用户信息
	 */
	function checkLogin() {
		$res = $this->find($this->userID);
		if (md5($res['id'] . $res['username'] . $res['password']) != \Common\Org\Util::authcode($this->userCode))
			return FALSE;
		if ($res['status'] != 1)
			return FALSE;
		return $res;
	}

	public function loginOut() {
		session(C('SESSION_ID_ADMIN'), null);
		session(C('SESSION_CODE_ADMIN'), null);
		cookie(C('COOKIE_ID_ADMIN'), null);
		cookie(C('COOKIE_CODE_ADMIN'), null);
		return;
	}

}

?>