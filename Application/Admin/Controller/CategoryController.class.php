<?php

/**
 * @Description:类别管理控制器
 * @author Cloud <190296465@qq.com>
 * @since 2014-5-27 16:40:45
 * @copyright ChofnERP
 */

namespace Admin\Controller;

class CategoryController extends AdminController {

	function index() {
		parent::indexInitialize();
		$this->order = 'sort asc';
		$model = new \Common\Model\CategoryModel();
		$data = $model->where($this->map)->order($this->order)->select();
		$treeModel = new \Common\Org\Tree($data);
		$data = $treeModel->getArray();
		$this->assign('data', $data);
		$this->display();
	}

}

?>