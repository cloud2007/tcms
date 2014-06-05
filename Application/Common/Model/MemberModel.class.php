<?php

/**
 * 用户模型  用于被继承或写模型通用方法
 * @author Cloud
 * @since 2014-05-12
 * @copyright TcitCMS
 */

namespace Common\Model;

class MemberModel extends CommonModel {

	private $userID = '';
	private $userCode = '';
	protected $_auto = array(
		array('created', 'time', 1, 'function'), //对created字段在新增的时候写入当前时间戳
		array('password', 'password', 3, 'callback'),
		array('password', '', 2, 'ignore'),
	);
	protected $_validate = array(
		array('username', 'require', '用户名不能为空'),
		array('username', '', '该用户名已存在', 1, 'unique', 3),
		array('password', 'require', '密码不能为空'),
	);

	/**
	 * 初始化
	 */
	public function _initialize() {
		$session_userid = session(C('SESSION_ID_HOME'));
		$cookie_userid = cookie(C('COOKIE_ID_HOME'));
		if (!$session_userid && !$cookie_userid && $session_userid != $cookie_userid) {
			$this->loginOut();
		}
		$this->userID = session(C('SESSION_ID_HOME'));
		$this->userCode = session(C('SESSION_CODE_HOME'));
	}

	/**
	 * 登陆
	 */
	function loginAction($username, $password) {
		if (!$username || !$password) {
			return '用户名密码不能为空！';
		} else {
			$map['username'] = array('EQ', $username);
			$map['status'] = array('EQ', 1);
			$map['deleted'] = array('EQ', 0);
			$res = $this->where($map)->find();
			if ($res) {
				if ($res['password'] == md5($password)) {
					session(C('SESSION_ID_HOME'), $res['id']);
					session(C('SESSION_CODE_HOME'), \Common\Org\Util::authcode(md5($res['id'] . $res['username'] . $res['password']), 'ENCODE'));
					cookie(C('COOKIE_ID_HOME'), $res['id'], time() + 3600 * 24, '/');
					cookie(C('COOKIE_CODE_HOME'), \Common\Org\Util::authcode(md5($res['id'] . $res['username'] . $res['password']), 'ENCODE'), time() + 3600 * 24, '/');
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
		session(C('SESSION_ID_HOME'), null);
		session(C('SESSION_CODE_HOME'), null);
		cookie(C('COOKIE_ID_HOME'), null);
		cookie(C('COOKIE_CODE_HOME'), null);
		return;
	}

	protected function _after_find(&$result, $options) {

	}

	protected function _before_write(&$data) {

	}

	function password($data) {
		return $data ? md5($data) : '';
	}

}

?>