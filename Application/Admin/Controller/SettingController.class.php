<?php

/**
 * @Description:系统设置控制器
 * @author Cloud <190296465@qq.com>
 * @since 2014-5-27 16:40:45
 * @copyright ChofnERP
 */

namespace Admin\Controller;

class SettingController extends AdminController {

	function index() {
		$model = new \Common\Model\MenuModel();
		if (IS_POST) {
			if ($model->create()) {
				$model->save();
			}
			$this->success(L('OPRATION_SUCCESS'));
		}
		parent::indexInitialize();
		$data = $model->find($this->menu_id);
		$this->assign('data', $data);
		$this->display();
	}

}

?>