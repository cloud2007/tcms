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
		$model = new \Common\Model\SettingModel();
		if (IS_POST) {
			$model->where('1')->delete();
			$key = I('post.key', '', 'trim');
			$value = I('post.value', '', 'trim');
			$text = I('post.text', '', 'trim');
			foreach ($key as $k => $v) {
				$data = array();
				$data['key'] = $key[$k];
				$data['value'] = $value[$k];
				$data['text'] = $text[$k];
				if ($model->create($data))
					$model->add();
				else
					$this->error($model->getError());
			}
			$this->success(L('OPRATION_SUCCESS'));
		}
		parent::indexInitialize();
		$data = $model->select();
		$this->assign('data', $data);
		$this->display();
	}

}

?>