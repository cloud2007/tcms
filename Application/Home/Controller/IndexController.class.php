<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class IndexController extends CommonController {

	function _initialize() {
		parent::_initialize();
	}

	function index() {
		$model = new \Common\Model\NewsModel();
		$data = $model->where('`id`=1')->getField('content');
		$this->assign('data', $this->handle($data));
		$this->assign('web_title', '首页');
		$this->display();
	}

}

?>