<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class UserController extends AdminController {

	public $pageSize = 1;

	function index($model = '', $url = '') {
		$model = new \Common\Model\UserModel();
		parent::index($model, U('User/index'));
	}

	function _filter(&$map) {
		if (is_array($map))
			$map['id'] = array('GT', 1);
	}

	function _order(&$order) {
		$order = 'id asc';
	}

	function status() {
		$id = I('get.id', '0', 'intval');
		$status = I('get.status', '0', 'intval');
		$model = new \Common\Model\UserModel();
		$model->where('`id`=' . $id)->setField('status', $status);
		$this->success('删除成功', U('User/index'));
	}

	function reset() {
		$id = I('get.id', '0', 'intval');
		$model = new \Common\Model\UserModel();
		$model->where('`id`=' . $id)->setField('password', md5(C('DEFAULT_PASSWORD')));
		$this->success('删除成功', U('User/index'));
	}

	function grant() {
		$id = I('get.id', '0', 'intval');
		!$id && $this->error('参数错误', U('User/index'));
		$model = new \Common\Model\UserModel();
		$data = $model->find($id);
		$this->assign('data', $data);

		$model = new \Common\Model\MenuModel();
		$map = array();
		$map['deleted'] = array('EQ', 0);
		$map['use'] = array('EQ', 1);
		$map['id'] = array('GT', 7);
		$grantList = $model->where($map)->select();
		$this->assign('grantList', $grantList);

		$this->display();
	}

	function grantSave() {
		$id = I('post.id', '0', 'intval');
		!$id && $this->error('参数错误', U('User/index'));
		$grant = I('post.grant', '', 'intval');
		!$grant && $this->error('未分配权限');
		if (in_array('0', $grant))
			$grant = array(0);
		$model = new \Common\Model\UserModel();
		$model->where('`id`=' . $id)->setField('grant', implode(',', $grant));
		$this->success('权限分配成功', U('User/index'));
	}

	function add($model = '') {
		$model = new \Common\Model\UserModel();
		parent::add($model, U('User/index'));
	}

	function save($model = '', $url = '') {
		$model = new \Common\Model\UserModel();
		parent::save($model, U('User/index'));
	}

	function delete($model = '', $url = '') {
		$model = new \Common\Model\UserModel();
		parent::delete($model, U('User/index'));
	}

}

?>