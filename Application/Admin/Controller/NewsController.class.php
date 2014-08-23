<?php

/**
 * @Description:类别管理控制器
 * @author Cloud <190296465@qq.com>
 * @since 2014-5-27 16:40:45
 * @copyright ChofnERP
 */

namespace Admin\Controller;

class NewsController extends AdminController {

    function index() {
        parent::indexInitialize();
        $categoryModel = new \Common\Model\CategoryModel();
        $cateData = $categoryModel->where($this->map)->order('sort asc')->select();
        $treeModel = new \Common\Org\Tree($cateData);
        $cateData = $treeModel->getArray();
        $this->assign('cateData', $cateData);
        parent::commonIndex();
    }

    function add() {
        parent::indexInitialize();
        $menuModel = new \Common\Model\MenuModel();
        $menuData = $menuModel->find($this->menu_id);
        if (in_array('noadd', $menuData['allow_field']) && !I('get.id'))
            $this->error('本栏目禁止添加新纪录!');
        if (in_array('nomod', $menuData['allow_field']))
            $this->error('本栏目禁止修改纪录!');
        parent::commonAdd();
    }

    function save() {
        parent::commonSave();
    }

    function delete() {
        parent::indexInitialize();
        $menuModel = new \Common\Model\MenuModel();
        $menuData = $menuModel->find($this->menu_id);
        if (in_array('nodel', $menuData['allow_field']))
            $this->error('本栏目禁止删除纪录!');
        parent::commonDelete();
    }

}

?>