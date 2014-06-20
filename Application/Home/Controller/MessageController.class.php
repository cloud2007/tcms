<?php

/**
 * 会员控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class MessageController extends CommonController {

	function index() {
		$this->display();
	}

	function add() {
		if (IS_POST) {
			$model = new \Common\Model\MessageModel();
			if ($model->create())
				$model->add();
			else
				$this->error($model->getError());
			$this->success(L('OPRATION_SUCCESS'), U('Message/index'));
		}
		$this->display();
	}

}

?>