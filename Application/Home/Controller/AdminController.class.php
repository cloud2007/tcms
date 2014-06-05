<?php

/**
 * 验证是否登陆用户基类控制器 继承该类页面需要验证用户登录和权限(后台页面)
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class AdminController extends CommonController {

	protected $MemberInfo;

	function _initialize() {
		// 验证登录
		$memberModel = new \Common\Model\MemberModel();
		$data = $memberModel->checkLogin();
		if ($data === false) {
			$this->loginOut();
			exit();
		} else {
			$this->MemberInfo = $data;
		}
		$this->assign('MemberInfo', $this->MemberInfo);
	}

	/**
	 * 退出登陆
	 */
	function loginOut() {
		$memberModel = new \Common\Model\MemberModel();
		$memberModel->loginOut;
		$this->redirect(U('User/login', '', false));
	}

}

?>