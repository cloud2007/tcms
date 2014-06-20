<?php

/**
 * 后台首页控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class UserController extends AdminController {

	function index() {
		$map['id'] = array('GT', 1);
		$map['deleted'] = array('EQ', 0);
		$this->map = $map;
		$this->order = 'id asc';
		$this->pagesize = C('DEFAULT_PAGE_SIZE_10');
		$this->url = U(CONTROLLER_NAME . '/index');
		parent::commonIndex();
	}

	function status() {
		$id = I('get.id', '0', 'intval');
		$status = I('get.status', '0', 'intval');
		$model = new \Common\Model\UserModel();
		$model->where('`id`=' . $id)->setField('status', $status);
		$this->success(L('OPRATION_SUCCESS'), U('User/index'));
	}

	function reset() {
		$id = I('get.id', '0', 'intval');
		$model = new \Common\Model\UserModel();
		$data['id'] = $id;
		$data['password'] = md5(C('DEFAULT_PASSWORD'));
		if ($model->create($data))
			$model->save();
		$this->success(L('OPRATION_SUCCESS'), U('User/index'));
	}

	function grant() {
		$id = I('get.id', '0', 'intval');
		!$id && $this->error(L('PARAMS_ERROR'), U('User/index'));
		$model = new \Common\Model\UserModel();
		$data = $model->find($id);
		$this->assign('data', $data);

		$model = new \Common\Model\MenuModel();
		$map = array();
		$map['deleted'] = array('EQ', 0);
		$map['use'] = array('EQ', 1);
		$map['id'] = array('NOT IN', array(1, 5));
		$grantList = $model->where($map)->select();
		$this->assign('grantList', $grantList);

		$this->display();
	}

	function grantSave() {
		$id = I('post.id', '0', 'intval');
		!$id && $this->error(L('PARAMS_ERROR'), U('User/index'));
		$grant = I('post.grant', '', 'intval');
		$model = new \Common\Model\UserModel();
		$data['id'] = $id;
		$data['grant'] = $grant;
		$model->data($data)->save();
		$this->success(L('OPRATION_SUCCESS'), U('User/index'));
	}

	function add() {
		$model = new \Common\Model\MenuModel();
		$map = array();
		$map['deleted'] = array('EQ', 0);
		$map['use'] = array('EQ', 1);
		$map['id'] = array('GT', 7);
		$grantList = $model->where($map)->select();
		$this->assign('grantList', $grantList);
		parent::commonAdd();
	}

	function save() {
		if (I('post.password') != I('post.password1'))
			$this->error(L('PASSWORD_NEQ_ERROR'));
		parent::commonSave();
	}

	function delete() {
		parent::commonDelete();
	}

	function password() {
		$model = new \Common\Model\UserModel();
		$id = $this->UserInfo['id'];
		$data = $model->find($id);
		$this->assign('data', $data);
		$this->display();
	}

	function passwordSave() {
		$id = I('post.id', '', 'intval');
		$oldpassword = I('post.oldpassword', '', 'trim');
		$password = I('post.password', '', 'trim');
		$password1 = I('post.password1', '', 'trim');
		!$id && $this->error(L('PARAMS_ERROR'));
		if (I('post.password') != I('post.password1'))
			$this->error(L('PASSWORD_NEQ_ERROR'));
		!$password && $this->success('密码未修改!');
		$model = new \Common\Model\UserModel();
		$data = $model->find($id);
		if ($data['password'] !== md5($oldpassword))
			$this->error(L('原密码输入错误!'));
		$model->where('`id`=' . $id)->setField('password', md5($password));
		$this->success(L('OPRATION_SUCCESS'));
	}

}

?>