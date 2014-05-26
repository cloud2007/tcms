<?php

/**
 * 菜单控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class MenuController extends AdminController {

	/**
	 * 主页面
	 */
	function index($model = '', $url = '') {
		$model = new \Common\Model\MenuModel();
		$MenuList = $model->createMenu($this->UserInfo);
		$this->assign('MenuList', $MenuList);
		$this->display();
	}

}

?>