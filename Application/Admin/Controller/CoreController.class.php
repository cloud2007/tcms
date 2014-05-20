<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class CoreController extends AdminController {

	function index() {
		$this->display();
	}

	function add() {
		$this->display();
	}

	function save() {
		$model = new \Common\Model\MenuModel();
		if ($model->create()) {
			$this->success('添加成功', U('Core/index'));
		} else {
			$this->error($model->getError());
		}
	}

}

?>