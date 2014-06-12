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
		//$this->lm_id=1;
		parent::_initialize();
	}

	function index() {
		//$this->assign('web_title','首页');
		//$this->assign('web_keywords','web_keywords');
		//$this->assign('web_description','web_description');
		$this->display();
	}

}

?>