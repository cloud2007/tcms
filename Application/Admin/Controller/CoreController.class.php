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
		$model = new \Common\Model\MenuModel();
		$data = $model->select();
		$this->assign('data', $data);
		$this->display();
	}

	function add() {
		$id = I('get.id', '', intval);
		if ($id) {
			$model = new \Common\Model\MenuModel();
			$data = $model->find($id);
			$this->assign('data', $data);
		}
		$this->display();
	}

	function save() {
		$model = new \Common\Model\MenuModel();
		if ($model->create()) {
			print_r($model);die;
			$model->save();
			$this->success('添加成功', U('Core/index'));
		} else {
			print_r($model);die;
			$this->error($model->getError());
		}
	}

}

?>