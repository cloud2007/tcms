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
		if (I('get.category', '', 'intval'))
			$this->map['category'] = array('EQ', I('get.category'));
		if (I('get.wd', '', 'trim') && $model->_selectFields)
			$this->map[$model->_selectFields] = array('LIKE', '%' . I('get.wd') . '%');
		$data = $model->where($this->map)->order($this->order)->select();
		$treeModel = new \Common\Org\Tree($data);
		$data = $treeModel->getArray();
		$this->assign('data', $data);
		$this->display();
	}

	function add() {
		parent::indexInitialize();
		if (I('get.pid', '', 'intval'))
			$this->assign('selected', I('get.pid'));
		if (!I('get.id', '', 'intval')) {
			$model = new \Common\Model\CategoryModel();
			$sort = $model->where($this->map)->count();
			$this->assign('sort', $sort + 1);
		}
		parent::commonAdd();
	}

	function save() {
		parent::commonSave();
	}

	function sort() {
		parent::indexInitialize();
		$op = I('get.op', '', 'trim');
		$id = I('get.id', '', 'intval');
		if (!$op || !$id)
			$this->error(L('PARAMS_ERROR'));
		if ($op == 'up') {
			$model = new \Common\Model\CategoryModel();
			$oldData = $model->find($id);
			$map = $this->map;
			$map['sort'] = array('LT', $oldData['sort']);
			$order = 'sort desc';
			$newData = $model->where($map)->order($order)->find();
			if ($newData && $oldData) {
				$temp = $newData['sort'];
				$model->where('`id`=' . $newData['id'])->setField('sort', $oldData['sort']);
				$model->where('`id`=' . $oldData['id'])->setField('sort', $temp);
			}
		}
		if ($op == 'down') {
			$model = new \Common\Model\CategoryModel();
			$oldData = $model->find($id);
			$map = $this->map;
			$map['sort'] = array('GT', $oldData['sort']);
			$order = 'sort asc';
			$newData = $model->where($map)->order($order)->find();
			if ($newData && $oldData) {
				$temp = $newData['sort'];
				$model->where('`id`=' . $newData['id'])->setField('sort', $oldData['sort']);
				$model->where('`id`=' . $oldData['id'])->setField('sort', $temp);
			}
		}
		$this->success(L('OPRATION_SUCCESS'));
	}

	function delete() {
		parent::commonDelete();
	}

}

?>