<?php

/**
 * 通用控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class CommonController extends \Think\Controller {

	function _initialize() {
		S(C('MEMBERCACHE_OPTIONS')); // 初始化缓存
	}

	/**
	 * 列表页面
	 * @param type $model
	 */
	function index($model = '') {

		$map = array();
		$map['deleted'] = array('EQ', 0);
		$order = 'created desc';
		empty($model) && $model = D(CONTROLLER_NAME);

		if (method_exists($this, '_filter')) {
			$this->_filter($map);
		}
		if (method_exists($this, '_order')) {
			$this->_order($order);
		}

		$pageSize = $this->pageSize;
		$pageNo = I('get.PageNo', '1', 'intval');
		$pageNum = ($pageNo - 1) * $pageSize;
		$limit = "{$pageNum},{$pageSize}";

		$order = 'sort asc';

		$count = $model->where($map)->count();

		$pager = new \Common\Org\Pager();
		$pagerData = $pager->getPagerData($count, $pageNo, U('Core/index'), 2, $pageSize); //参数记录数 当前页数 链接地址 显示样式 每页数量

		$data = $model->where($map)->order($order)->limit($limit)->select();

		$this->assign('data', $data);
		$this->assign('pagerData', $pagerData);

		$this->display();
	}

	/**
	 * 增加、修改页面
	 */
	function add($model = '') {
		empty($model) && $model = D(CONTROLLER_NAME);
		$id = I('get.id', '0', 'intval');
		if ($id) {
			$data = $model->find($id);
			$this->assign('data', $data);
		}
		$this->display();
	}

	/**
	 * 保存逻辑处理
	 * @param type $model
	 */
	function save($model = '', $url = '') {
		empty($model) && $model = D(CONTROLLER_NAME);
		empty($url) && $url = U(CONTROLLER_NAME . '/index');
		if ($model->create()) {
			$model->addSave();
			$this->success('添加成功', $url);
		} else {
			$this->error($model->getError());
		}
	}

	public function delete($model = '', $url = '') {
		empty($model) && $model = D(CONTROLLER_NAME);
		empty($url) && $url = U(CONTROLLER_NAME . '/index');
		$id = I('get.id') ? I('get.id') : implode(',', I('post.id'));
		if ($id) {
			$map['id'] = strpos($id, ',') ? array('IN', $id) : array('EQ', $id);
			$model->where($map)->setField('deleted', NOW_TIME);
			$this->success('删除成功', $url);
		} else {
			$this->error('参数错误', $url);
		}
	}

	/**
	 * 退出登陆
	 */
	function LoginOut() {
		$model = new \Common\Model\UserModel();
		$model->loginOut;
		$this->redirect(U('login/index', '', false));
	}

}

?>