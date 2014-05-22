<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class UserController extends AdminController {

	function index() {
		$model = new \Common\Model\UserModel();
		parent::index($model);
	}

	function _filter(&$map) {
		//if (is_array($map))
			//$map['id'] = array('GT', 10);
	}

	function _order(&$order) {
		$order = 'id asc';
	}

	function add($model = '') {
		$model = new \Common\Model\MenuModel();
		parent::add($model, U('User/index'));
	}

	function save($model = '', $url = '') {
		$model = new \Common\Model\MenuModel();
		parent::save($model, U('Core/index'));
	}

	function delete($model = '', $url = '') {
		$model = new \Common\Model\MenuModel();
		parent::delete($model, U('Core/index'));
	}

}

?>