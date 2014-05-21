<?php

/**
 * 验证是否登陆用户基类控制器 继承该类页面需要验证用户登录和权限(后台页面)
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class AdminController extends CommonController {

	protected $UserInfo;

	function _initialize() {
		// 验证是否登录
		$obj = new \Common\Model\UserModel ();
		$res = $obj->checkLogin();
		if ($res === false) {
			$this->loginOut();
			exit();
		} else {
			$this->UserInfo = $res;
		}
		$this->assign('UserInfo', $this->UserInfo); // 初始化的时候赋值UserInfo
	}

}

?>