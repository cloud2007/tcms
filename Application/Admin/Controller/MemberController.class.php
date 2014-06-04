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
        $model = new \Common\Model\MenuModel();
        $map['id'] = array('GT', 10);
        $this->map = $map;
        $this->order = 'sort_no asc';
        $this->pagesize = C('DEFAULT_PAGE_SIZE_10');
        $this->url = U(CONTROLLER_NAME . '/index');
        parent::commonIndex($model);
    }

    function add() {
        $model = new \Common\Model\MenuModel();
        parent::commonAdd($model);
    }

    function save() {
        $model = new \Common\Model\MenuModel();
        parent::commonSave($model);
    }

    function delete() {
        $model = new \Common\Model\MenuModel();
        parent::commonDelete($model);
    }

}

?>