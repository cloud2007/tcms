<?php

/**
 * @Description:类别管理控制器
 * @author Cloud <190296465@qq.com>
 * @since 2014-5-27 16:40:45
 * @copyright ChofnERP
 */

namespace Admin\Controller;

class NewsController extends AdminController {

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