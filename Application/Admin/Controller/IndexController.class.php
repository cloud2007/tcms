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
		$this->assign('data', self::loadTcmsNews());
		$this->display();
	}

	function loadTcmsNews() {
		$url = curl_init("http://www.tcit123.com/Tcms/tcms_news.php");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($url, CURLOPT_POST, 1);
		curl_setopt($url, CURLOPT_POSTFIELDS, "Domain={$_SERVER['SERVER_NAME']}&Code=" . Config::item('Config.AUTHORIZECODE'));
		$Authorize = curl_exec($url);
		curl_close($url);
		return json_decode($Authorize,true);
	}

}

?>