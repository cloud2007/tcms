<?php

/**
 * 验证是否登陆用户基类控制器 继承该类页面需要验证用户登录和权限(后台页面)
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class AdminController extends CommonController {

	protected $UserInfo;
	protected $menu_id;
	protected $lm_id;
	protected $map;
	protected $order;
	protected $pagesize;
	protected $url;

	function _initialize() {
		// 验证登录
		$userModel = new \Common\Model\UserModel ();
		$data = $userModel->checkLogin();
		if ($data === false) {
			$this->loginOut();
			exit();
		} else {
			$this->UserInfo = $data;
		}
		$this->assign('UserInfo', $this->UserInfo);
	}

	function indexInitialize() {
		//设置session
		session('menu_id', I('get.menu_id', '', 'intval') ? I('get.menu_id', '', 'intval') : session('menu_id'));
		session('lm_id', I('get.lm_id', '', 'intval') ? I('get.lm_id', '', 'intval') : session('lm_id'));
		$this->menu_id = session('menu_id');
		$this->lm_id = session('lm_id');
		if (!$this->menu_id && !$this->lm_id) {
			$this->loginOut();
			exit();
		}
		$map = array();
		$map['lm_id'] = array('EQ', $this->lm_id);
		$map['deleted'] = array('EQ', 0);
		$this->map = $map;
		$this->order = 'created desc';
		$this->pagesize = C('DEFAULT_PAGE_SIZE_10');
		$this->url = U(CONTROLLER_NAME . '/index');

		$menuModel = new \Common\Model\MenuModel();
		$menuData = $menuModel->find($this->menu_id);
		$this->assign('menuData', $menuData);
	}

	function commonIndex($model = '') {
		empty($model) && $model = D(CONTROLLER_NAME);
		$url = $this->url ? $this->url : U(CONTROLLER_NAME . '/index');
		$pageNo = I('get.PageNo', '1', 'intval');
		$pageNum = ($pageNo - 1) * $this->pagesize;
		$limit = "{$pageNum},{$this->pagesize}";

		if (I('get.category', '', 'intval'))
			$this->map['category'] = array('EQ', I('get.category'));
		if (I('get.wd', '', 'trim') && $model->_selectFields)
			$this->map[$model->_selectFields] = array('LIKE', '%' . I('get.wd') . '%');

		$count = $model->where($this->map)->count();

		$pager = new \Common\Org\Pager();
		$pagerData = $pager->getPagerData($count, $pageNo, $url, 2, $this->pagesize); //参数记录数 当前页数 链接地址 显示样式 每页数量

		$data = $model->where($this->map)->order($this->order)->limit($limit)->select();

		$this->assign('data', $data);
		$this->assign('pagerData', $pagerData);

		$this->display();
	}

	/**
	 * 增加、修改页面
	 */
	function commonAdd($model = '') {
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
	function commonSave($model = '') {
		empty($model) && $model = D(CONTROLLER_NAME);
		$url = $this->url ? $this->url : U(CONTROLLER_NAME . '/index');
		if ($model->create()) {
			$model->addSave();
			$this->success(L('OPRATION_SUCCESS'), $url);
		} else {
			$this->error($model->getError());
		}
	}

	public function commonDelete($model = '') {
		empty($model) && $model = D(CONTROLLER_NAME);
		$url = $this->url ? $this->url : U(CONTROLLER_NAME . '/index');
		$id = I('get.id') ? I('get.id') : implode(',', I('post.id'));
		if ($id) {
			$map['id'] = strpos($id, ',') ? array('IN', $id) : array('EQ', $id);
			$model->where($map)->setField('deleted', NOW_TIME);
			$this->success(L('DELETE_SUCCESS'), $url);
		} else {
			$this->error(L('PARAMS_ERROR'), $url);
		}
	}

	/**
	 * 退出登陆
	 */
	function loginOut() {
		$model = new \Common\Model\UserModel();
		$model->loginOut;
		$this->redirect(U('login/index', '', false));
	}

}

?>