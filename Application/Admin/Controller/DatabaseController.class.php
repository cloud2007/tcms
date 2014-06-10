<?php

/**
 * 后台首页控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class DatabaseController extends AdminController {

	function index() {
		$dirPath = APP_ROOT . '/Public/Backup/';
		$action = I('get.action', '', 'trim');
		$file = I('get.file', '', 'trim');
		if (!empty($action)) {
			$config = array(
				'host' => C('DB_HOST'),
				'port' => C('DB_PORT'),
				'userName' => C('DB_USER'),
				'userPassword' => C('DB_PWD'),
				'dbprefix' => C('DB_PREFIX'),
				'charset' => 'UTF8',
				'path' => $dirPath,
				'isCompress' => 0, //是否开启gzip压缩
				'isDownload' => 0
			);
			$mr = new \Common\Org\Database($config);
			$mr->setDBName(C('DB_NAME'));
			if ($action == 'backup') {
				$mr->backup();
				$this->success('数据库备份成功！');
			} elseif ($action == 'restore' && $file) {
				$mr->recover($file);
				$this->success('数据库还原成功！');
			} elseif ($action == 'del' && $file) {
				if (@unlink($dirPath . $file)) {
					$this->success('删除成功！');
				} else {
					$this->error('删除失败！');
				}
			}
			if ($action == 'dow') {
				\Common\Org\Util::DownloadFile($dirPath . $file);
				exit();
			}
		}
		$data = \Common\Org\Util::MyScandir($dirPath);
		unset($data[0]);
		unset($data[1]);
		$this->assign('data', $data);
		$this->assign('path', $dirPath);
		$this->display();
	}

	/**
	 * 系统初始化功能暂不开放
	 */
	function initialize() {
		$str = '此功能暂不开放,请联系管理员!';
		$this->assign('data', $str);
		$this->display('Common/show');
	}

}

?>