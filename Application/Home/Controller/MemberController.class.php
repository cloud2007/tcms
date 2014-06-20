<?php

/**
 * 会员控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class MemberController extends AdminController {

	function index() {
		echo cookie(C('COOKIE_ID_HOME'));
		$this->display();
	}

}

?>