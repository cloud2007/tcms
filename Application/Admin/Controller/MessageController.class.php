<?php

/**
 * 会员管理控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class MessageController extends AdminController {

	function index() {
		parent::indexInitialize();
		parent::commonIndex();
	}

	function add() {
		parent::indexInitialize();
		parent::commonAdd();
	}

	function save() {
		parent::commonSave();
	}

	function delete() {
		parent::commonDelete();
	}

}

?>