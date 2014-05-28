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
	protected $_auto = array(
		array('created', 'time', 1, 'function'), //对created字段在新增的时候写入当前时间戳
		array('password', 'password', 3, 'callback'),
		array('password', '', 2, 'ignore'),
	);
	protected $_validate = array(
		array('username', 'require', '用户名不能为空'),
		array('username', '', '该用户名已存在', 1, 'unique', 3),
	);

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
			$map['username'] = array('EQ', $username);
			$map['status'] = array('EQ', 1);
			$map['deleted'] = array('EQ', 0);
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

	/**
	 * 查询数据成功后
	 * @author Cloud
	 * @since 2014-05-14
	 */
	protected function _after_select(&$resultSet, $options) {
		foreach ($resultSet as $key => $value) {
			$resultSet[$key]['statusHtml'] = $value['status'] ? '<a href="' . U('User/status', array('id' => $value['id'], 'status' => 0)) . '">禁用</a>' : '<a href="' . U('User/status', array('id' => $value['id'], 'status' => 1)) . '">启用</a>';
			$resultSet[$key]['grantArray'] = explode(',', $value['grant']);
			$grant = $value['grant'];
			if (\Common\Org\Util::notEmpty($grant)) {
				if ($grant == 0)
					$resultSet[$key]['grantHtml'] = '管理员';
				else {
					$model = new MenuModel();
					$data = $model->where('`id` in(' . $grant . ')')->getField('menu_name', TRUE);
					$resultSet[$key]['grantHtml'] = implode(',', $data);
				}
			}else
				$resultSet[$key]['grantHtml'] = '';
		}
	}

	protected function _after_find(&$result, $options) {
		if (\Common\Org\Util::notEmpty($result['grant']))
			$result['grantArray'] = explode(',', $result['grant']);
		else
			$result['grantArray'] = array();
	}

	protected function _before_write(&$data) {
		if ($data['grant']) {
			if (in_array('0', $data['grant']))
				$data['grant'] = 0;
			else
				$data['grant'] = implode(',', $data['grant']);
		}
		if (!$data['id'] && !$data['password'])
			$data['password'] = md5(C('DEFAULT_PASSWORD'));
	}

	function password($data) {
		return $data ? md5($data) : '';
	}

}

?>