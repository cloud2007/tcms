<?php

/**
 * 后台首页控制器
 * @author:Cloud
 * @copyright:TcitCMS
 * @since:2014-05-12
 */

namespace Home\Controller;

class StudyController extends CommonController {

    function _initialize() {
        $this->lm_id = 5;
        parent::_initialize();
    }

    function index() {
        parent::indexInitialize();
        $model = new \Common\Model\NewsModel();
        $menuData = $model->where($this->map)->order('hits asc')->select();
        $this->assign('menuData', $menuData);
        $id = I('get.id', '', 'intval');
        if ($id)
            $data = $model->where($this->map)->order('hits asc')->find($id);
        else
            $data = $model->where($this->map)->order('hits asc')->find();
        $this->assign('web_title', $data['title']);
        $this->assign('data', $data);
        $this->display();
    }

}

?>