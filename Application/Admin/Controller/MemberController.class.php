<?php

/**
 * 会员管理控制器
 * @author:Cloud <190296465@qq.com>
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Admin\Controller;

class MemberController extends AdminController {

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

    function opration() {
        $id = I('get.id', '', 'intval');
        $key = I('get.key', '', 'trim');
        $value = I('get.value', '', 'trim');
        if (\Common\Org\Util::isEmpty($id) || \Common\Org\Util::isEmpty($key) || \Common\Org\Util::isEmpty($value))
            $this->error(L('PARAMS_ERROR'));
        $model = new \Common\Model\MemberModel();
        $model->where('`id`=' . $id)->setField($key, $value);
        $this->success(L('OPRATION_SUCCESS'), U('Member/index'));
    }

}

?>