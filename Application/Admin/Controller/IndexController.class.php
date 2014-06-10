<?php

/**
 * 后台首页控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class IndexController extends AdminController {

	function index() {
		//dump(\Common\Org\Util::SendMail('190296465@qq.com','laven', 'testtiel','123test'));
		//echo \Common\Org\Util::guid('-');
		$this->assign('data', self::loadTcmsNews());
		$this->display();
	}

	function loadTcmsNews() {
		$postData = array('domain' => $_SERVER['SERVER_NAME'], 'code' => C('REMOTE_AUTH_CODE'));
		$url = curl_init("http://www.tcit123.com/Verify/index.php");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($url, CURLOPT_POST, 1);
		curl_setopt($url, CURLOPT_POSTFIELDS, $postData);
		$Authorize = curl_exec($url);
		curl_close($url);
		return json_decode($Authorize, true);
	}

	function welcome(){
		$str = '<p>欢迎使用Tcms,联系电话:18180820312!</p>';
		$str .= '<p>联系QQ:190296465!</p>';
		$this->assign('data',$str);
		$this->display('Common/show');
	}

}

?>